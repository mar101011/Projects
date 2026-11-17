<?php
    include 'Connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       $delRes=$_POST['cancel']??'';//Πα΄ίρνει την κράτηση που επέλεξε ο χρήστης για διαγραφ΄ή
       try {

            $sql = "SELECT Flight_date FROM reservations WHERE resId=:delRes;";//Παίρνει την ημερομηνία που αντιστοιχεί στην κράτηση
            $stmtt = $conn->prepare($sql);
            $stmtt->execute([':delRes' => $delRes]);
            $date = $stmtt->fetch(PDO::FETCH_ASSOC);
            
            if($date){//Μόνο αν υπάρχουν εγγαφές
            $flightDay=new DateTime($date['Flight_date']);//Παίρνει την ημερομηνία με σωστό format
            $currentDay=new Datetime();//Παίρνει την σημερινή ημερομηνία
            $difference=$currentDay->diff($flightDay);//Βρίσκει την διαφορά τον ημερών
            $intDiff = (int)$difference->format('%r%a'); // %r για πρόσημο, %a για συνολικές ημέρες

            if ($intDiff>=30){
               $stmt2 = $conn->prepare("DELETE FROM tickets WHERE resId=:delRes;");/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
               /*Συνδέει τις μεταβλητές με την βάση */
               $stmt2->execute([':delRes' => $delRes]);

               $stmt = $conn->prepare("DELETE FROM reservations WHERE resId=:delRes;");/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
               /*Συνδέει τις μεταβλητές με την βάση */
               $stmt->execute([':delRes' => $delRes]); 
                echo "<script>alert('Η κράτηση σας διαγράφηκε με επιτυχία');</script>"; //Εμφανίζει μήνυμα alert με την βοήθεια echo 
            }else{
                echo "<script>alert('Αδυναμία ακύρωσης.Το περιθώριο ακύρωσης έχει παρέλθει. Μπορείτε να ακυρώσετε μέχρι και 30 μέρες πριν την κράτηση!');</script>";//Εμφανίζει μήνυμα alert με την βοήθεια echo
        
            }
        }
                   
        } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
           echo "Connection failed: " . $e->getMessage();
        }
   } 
?>