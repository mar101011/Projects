<?php
    include 'Connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       $airportA=$_POST['AirA']??'';//Παίρνει τις τιμές των μεταβλητών από τη φόρμα που τα έστειλε με Post
       $airportB=$_POST['AirB']??'';
       $dateOfFlight=$_POST['dateFly']??'';
       $noPeople=$_POST['people']??'';
       $username = $_SESSION['user'];
       $number = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT); //Με το rand παράγει ένα αριθμό από 1 μέχρι 99999 και μετά βάζει μηδενικά αριστερά (STR_PAD_LEFT) για να αποτελείται ο κωδικός από συνολικά 5 αριθμούς  
       $id = $airportA . $number;  //Ενώνει τα γράμματα του αεροδρομίου Α με τον τυχαίο αριθμό που φτάξαμε πάνω 
       $_SESSION['ReserveId'] = $id; //Αποθηκεύουμε το id σε ένα session ReserveId

       
       try {
        
           if ($airportA!=$airportB) { //Μόνο αν τα αεροδρόμια προορισμού και αναχώρησης δεν είναι ίδια βάζει τα στοιχεία στον πίνακα με τις κρατήσεις
              $in = "INSERT INTO reservations (`Airport_Departure`, `Airport_Arrivals`, `Flight_date`,`No_of_passengers`,`resId`,`UseRes`) VALUES (:airportA, :airportB, :dateOfFlight, :noPeople,:id, :username)";
                         $stmt = $conn->prepare($in);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
                         $stmt->execute([/*Συνδέει τις μεταβλητές με την βάση */
                               ':airportA' => $airportA,
                               ':airportB' => $airportB,
                               ':dateOfFlight' => $dateOfFlight,
                               ':noPeople' => $noPeople,
                               ':id' => $id,
                               ':username' => $username,
                               
                        ]);
                        header("Location: BookFlight.php");  
                        exit;
                      
            }
                   
        } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
           echo "Connection failed: " . $e->getMessage();
        }
   } 
?>