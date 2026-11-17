<?php
    $usTaken='';
    $emailTaken='';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       //Παίρνει τις τιμές από τα πεδία
       $name=$_POST['Name']??'';
       $surname=$_POST['Surname']??'';
       $user=$_POST['username']??'';
       $pass=$_POST['passRe']??'';
       $useremail=$_POST['Email']??'';
  
       
       try {
        
           $checkUser="SELECT Username FROM users WHERE Username = :user";/*Παίρνουμε το username */
           $stmt = $conn->prepare($checkUser);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
           $stmt->execute([':user' => $user]);/*Συνδέει τις μεταβλητές με την βάση */
           $userT = $stmt->fetch(PDO::FETCH_ASSOC);/*Fetch*/

           $checkEmail="SELECT `E-mail` FROM users WHERE `E-mail` = :useremail";/*Παίρνουμε το email */
           $stmtt = $conn->prepare($checkEmail);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
           $stmtt->execute([':useremail' => $useremail]);/*Συνδέει τις μεταβλητές με την βάση */
           $emailT = $stmtt->fetch(PDO::FETCH_ASSOC);/*Fetch*/

           if ($userT) {//Εάν το username χρησιμοποιείται από άλλο εμφανίζεται μήνυμα
               $usTaken="To username χρησιμοποιείται από άλλο χρήστη!";
           }elseif ($emailT){//Εάν το email χρησιμοποιείται από άλλο εμφανίζεται μήνυμα
               $emailTaken="To email χρησιμοποιείται από άλλο χρήστη!";
           }else{
              if (preg_match("/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/", $name)) {/*Ελέγχεται αν έχει μόνο χαρακτήρες*/
                 if (preg_match("/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/", $surname)) {/*Ελέγχεται αν έχει μόνο χαρακτήρες*/
                    if(strlen($pass)>=4  && strlen($pass)<=10){/*Ελέγχεται αν το μήκος είναι μεταξύ των οριών */
                     if (preg_match("/\d/", $pass)) {/*Ελέγχεται αν το password έχει τουλάχιστον 1 αριθμό */
                       if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $useremail)) {/*Ελέγχεται αν το μειλ ακολουθεί το format*/
                         $in = "INSERT INTO users (Name, Surname, Username, Password, `E-mail`) VALUES (:name, :surname, :user, :pass, :useremail)";/*Εισάγονται τα στοιχεία στη βάση */
                         $stmt = $conn->prepare($in);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
                         $stmt->execute([/*Συνδέει τις μεταβλητές με την βάση */
                               ':name' => $name,
                               ':surname' => $surname,
                               ':user' => $user,
                               ':pass' => $pass,
                               ':useremail' => $useremail
                        ]);
                        header("Location: Login.php"); /*Πηγαίνει στη σελίδα login */
                        exit;
                      }
                    }
                   }
                }
            }
        }

        } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
           echo "Connection failed: " . $e->getMessage();
        }
   } 
?>