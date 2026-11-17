<?php
include 'Connection.php';
session_start();//Ξεκινάω session για να πάρω το id κράτησης

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $res = $_SESSION['ReserveId']; // Παίρνω το cookie
    $seatsReserved = $_POST['seatsSelect'] ?? ''; // Παίρνει τις θέσεις
    $seatsArray = explode(',', $seatsReserved); // Χωρίζει τις τιμές για κάθε θέση
    
    try {
        $sql = "SELECT ticketId FROM tickets WHERE resId = :res";//Παίρνουμε όλα τα εισητήρια που ανήκουν στη συγκεκριμένη κράτηση
        $stmt = $conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
        $stmt->execute(['res' => $res]);/*Συνδέει τις μεταβλητές με την βάση */
        $ticketIDArr = $stmt->fetchAll(PDO::FETCH_COLUMN);
         
        $sql2 = "SELECT `Airport_departure`, `Airport_arrivals` FROM reservations WHERE resId = :res";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute(['res' => $res]);
        $details = $stmt2->fetch(PDO::FETCH_ASSOC);

        $airdepar = $details['Airport_departure'];
        $airarr= $details['Airport_arrivals'];

        // Φόρος αναχώρησης
        $sql3="SELECT Airport_tax FROM airports WHERE Airport_code = :airdepar";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(['airdepar' => $airdepar]);
        $tax1 = $stmt3->fetch(PDO::FETCH_ASSOC);

        // Φόρος άφιξης
        $sql4="SELECT Airport_tax FROM airports WHERE Airport_code = :airarr";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->execute(['airarr' => $airarr]);
        $tax2 = $stmt4->fetch(PDO::FETCH_ASSOC); 
        
        $tax=$tax1['Airport_tax']+$tax2['Airport_tax'];
        

        // Απόσταση του αεροδρομίου αναχώρησης
        $sql5="SELECT Geographical_Width,Geographical_Length FROM airports WHERE Airport_code = :airdepar";
        $stmt5 = $conn->prepare($sql5);
        $stmt5->execute(['airdepar' => $airdepar]);
        $fprice1 = $stmt5->fetch(PDO::FETCH_ASSOC);

        // Απόσταση του αεροδρομίου άξιξης
        $sql6="SELECT Geographical_Width,Geographical_Length FROM airports WHERE Airport_code = :airarr";
        $stmt6 = $conn->prepare($sql6);
        $stmt6->execute(['airarr' => $airarr]);
        $fprice2 = $stmt6->fetch(PDO::FETCH_ASSOC);
        
        $R=6371;
        //Μεταρτοπή των τιμών σε ακτίνια για την χρήση τους στον τύπο
        $width1 = deg2rad(floatval($fprice1['Geographical_Width']));
        $length1 = deg2rad(floatval($fprice1['Geographical_Length']));
        $width2 = deg2rad(floatval($fprice2['Geographical_Width']));
        $length2 = deg2rad(floatval($fprice2['Geographical_Length']));

        //Υπολογισμός απόστασης αεροδρομίου
        $d = pow(sin(($width1 - $width2)/2),2) + cos($width1) * cos($width2) * pow(sin(($length2 - $length1)/2),2);
        $atanD=asin(sqrt($d));
        $distance=2*$R*$atanD;
        $flightPrice=$distance/10;
        
        $finalPrice=0;

        foreach($seatsArray as $i => $seat){
            $ticketID = $ticketIDArr[$i] ?? null;//Παίρνει κάθε τιμή του πίνακα με τα εισητήρια
            $seatnumber = intval(substr($seat, 1));//Αφαιρώ το γράμμα για να κρατήσω τον αριθμό ώστε να πάρει τιμή ανα κατηγορία
             
            if($seatnumber===1 || $seatnumber===11 || $seatnumber===12){
                $seatPrice=20;
            }else if($seatnumber>=2 && $seatnumber<=10){
                $seatPrice=10;
            }else{
                $seatPrice=0;
            }

            //Υπολογισμός κόστους εισητηρίου
            $price=$tax+$flightPrice+$seatPrice;
            if ($ticketID) {
                $sql = "UPDATE tickets SET seat = :seat , ticketPrice=:price WHERE ticketId = :ticketID";// Κ΄΄άνει Update τον πίνακα και προσθέτει στη συγκεκριμένη σειρά την θέση
                $stmt = $conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
                $stmt->execute([/*Συνδέει τις μεταβλητές με την βάση */
                    ':seat' => $seat,
                    ':price'=>$price,
                    ':ticketID' => $ticketID
                ]);
            }
            //Υπολογισμός τελικού κόστους
            $finalPrice=$finalPrice+$price;
        }
        $sql7 = "UPDATE reservations SET resPrice = :finalPrice WHERE resId = :res";// Κ΄΄άνει Update τον πίνακα και προσθέτει στη συγκεκριμένη σειρά την τιμή κράτησης
                $stmt7 = $conn->prepare($sql7);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
                $stmt7->execute([/*Συνδέει τις μεταβλητές με την βάση */
                    ':finalPrice' => $finalPrice,
                    ':res'=>$res
                ]);
        
        header("Location:myTrip.php"); //Πηγαίνει στη σελίδα myTrip
        exit;

    } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
