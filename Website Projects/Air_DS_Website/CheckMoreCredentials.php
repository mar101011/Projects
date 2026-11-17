<?php
    /*Ελέγχονται και εισάγονται τα στοιχεία όλων τον επιβατών της κράτησης στον πίνακα */

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $reservationNo=$_POST['noPassenger']??'';/*Τραβάει τον αριθμό επιβατών από το hidden πεδίο στον οποίο τον αποθηκεύσαμε */
      $res=$_SESSION['ReserveId'];
      $notvalid=false;
      $validpassengers=[];

      for ($i = 1; $i <= $reservationNo; $i++) {/*Για όλους τους επιβάτες  */
        $nameRes=$_POST['NAME'.$i]??'';/*Τραβάει τα ονόματα με βάση το id που αλλάζει ανάλογα με το i για να πάρουμε κάθε φορά ένα επιβάτη*/
        $surnameRes=$_POST['SURNAME'.$i]??'';/*Τραβάει τα επίθετα με βάση το id που αλλάζει ανάλογα με το i για να πάρουμε κάθε φορά ένα επιβάτη*/
             
               if (preg_match("/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/", $nameRes)) {/*Ελέγχει αν το όνομα έχει μόνο χαρακτήρες */
                 if (preg_match("/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/", $surnameRes)) {/*Ελέγχει αν το επίθετο έχει μόνο χαρακτήρες */
                    if(strlen($nameRes)>=3  && strlen($nameRes)<=20){/*Ελέγχει αν το όνομα έχει 3-20 χαρακτήρες */
                       if(strlen($surnameRes)>=3  && strlen($surnameRes)<=20){/*Ελέγχει αν το επίθετο έχει 3-20 χαρακτήρες */
                           $validpassengers[] = [ /*Αποθηκεύει τους έγκυρους χρήστες στον πίνακα για να τους εισάγουμε μετά στην βάση αν όλοι είναι έγκυροι */
                               'name' => $nameRes,
                               'surname' => $surnameRes
                           ];
                     }else{
                        $notvalid=true;
                        break;
                     }
                   }else{
                     $notvalid=true;
                     break;
                   }
                }else{
                  $notvalid=true;
                  break;
                }
            }else{
               $notvalid=true;
               break;
            }
      }
      
      if($notvalid==false){/*Eλέγχει αν όλοι οι χρήστες είναι έγκυροι*/
            
         try {
               $in = "INSERT INTO tickets (ticketId,ticketname, ticketsurname,resId) VALUES (:ticketID,:nameRes, :surnameRes,:res)";/*Εισάγει τα στοιχεία επιβατών στον πίνακα*/
               $stmt = $conn->prepare($in);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
               
               foreach($validpassengers as $pass){/*Παίρνει όλους τους έγκυρους χρήσετς που απουηκεύσαμε στον πίνακα */
                  
                  //Αποτρέπει την δημιουργία ίδιων id
                  do {
                     $number = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT); //Με το rand παράγει ένα αριθμό από 1 μέχρι 99999 και μετά βάζει μηδενικά αριστερά (STR_PAD_LEFT) για να αποτελείται ο κωδικός από συνολικά 5 αριθμούς  
                     $ticketID = 'DS' . $number;//Ενώνει το DS με τον τυχαίο αριθμό που φτάξαμε πάνω 
                     $stmt2 = $conn->prepare("SELECT COUNT(*) FROM tickets WHERE ticketId = :ticketID");/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
                     $stmt2->execute([':ticketID' => $ticketID]);/*Συνδέει τις μεταβλητές με την βάση */
                     $taken = $stmt2->fetchColumn();

                  } while ($taken > 0);

                  $stmt->execute([/*Συνδέει τις μεταβλητές με την βάση */
                     ':ticketID'=>$ticketID,
                     ':nameRes' => $pass['name'],
                     ':surnameRes' => $pass['surname'],
                     ':res' => $res
                     ]);
               }
               header("Location: airplaneSeats.php"); 
         } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
           echo "Connection failed: " . $e->getMessage();
         }
      }
   }   
?>