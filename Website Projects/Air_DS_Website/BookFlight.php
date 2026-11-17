<?php
    include 'Header.php'; 
    include 'Connection.php'; 
    include 'CheckMoreCredentials.php';

     $wrong='';
     $userName='';
     $userSurname='';
     $reservationNo='';

     $username = $_SESSION['user'];
     $res=$_SESSION['ReserveId'];

       try {
        
           
           $sql = "SELECT Name, Surname FROM users WHERE Username = :username";//Παίρνουμε όνομα και επίθετο
           $stmt = $conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
           $stmt->execute([':username' => $username]);/*Συνδέει τις μεταβλητές με την βάση */

           $user = $stmt->fetch(PDO::FETCH_ASSOC);
           
           if ($user) { //Εάν εντοπίσει user β΄άζει τα στοιχεία σε μεταβλητές
                $userName = $user['Name'];
                $userSurname=$user['Surname'];

            } else {//Αλλιώς εμφανίζει μήνυμα
                $wrong = 'Δεν βρέθηκε χρήστης.';
            }

           $sql2 = "SELECT No_of_passengers FROM reservations WHERE resId = :res";//Παίρνουμε αριθμό επιβατών συγκεκριμένης κράτησης
           $stmt2 = $conn->prepare($sql2);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
           $stmt2->execute([':res' => $res]);/*Συνδέει τις μεταβλητές με την βάση */

           $reserve = $stmt2->fetch(PDO::FETCH_ASSOC);
           
           if ($reserve) {//Εάν βρει αριθμό βάζει την τιμή σε μεταβλητή
                $reservationNo = $reserve['No_of_passengers'];

            } else {//Αλλιώς εμφανίζει μήνυμα
                $wrong = 'Δεν βρέθηκε αριθμός επιβατών.';
            }

       } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
           echo "Connection failed: " . $e->getMessage();
       }
   
?>

<!DOCTYPE html>
<html>
    <head>
        <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
        <script src="CheckCredentials.js" defer></script>
        <title>Book flight</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/68/68395.png" type="image/icon type">
        <link rel="stylesheet" href="AirDs.css">
</head>

<body>
    <form action="" method="POST" onsubmit="return checkMoreCredentials(<?php echo (int)$reservationNo ?>)">
     <!--Φτιάχνω ένα fieldset που θα περιέχει όλες τις φόρμες για να συμπληρωθούν τα στοιχεία των επιβατών--> 
    <fieldset>
        <br>
       <h3>Στοιχεία επιβατών</h3>
       <ul> 
            <!--Για τον πρώτο επιβάτη παίρνει τα στοιχεία από τη βάση-->
            <li class="users">
                <p>Επιβάτης 1</p>
                <label for="NAME1">Όνομα:</label><br>
                <input type="text" id="NAME1" name="NAME1" value="<?php echo htmlspecialchars($userName);?> " readonly class="inputs"><br>                <label for="SURNAME">Επώνυμο:</label><br>
                <input type="text" id="SURNAME1" name="SURNAME1" value="<?php echo htmlspecialchars($userSurname);?> " readonly class="inputs">
            </li>
            
            <!--Τρέχει για όλους τους υπόλοιπους-->
            <?php for($i=2;$i<=(int)$reservationNo;$i++):?>
            <!--Δέχεται όνομα και επίθετο για κάθε επιβάτη και παράγει έρρορ αν υπάρξει μη έγκυρη τιμή-->
            <li class="users">
                <p>Επιβάτης <?php echo $i; ?></p>
                <label for="NAME<?php echo $i; ?>">Όνομα:</label><br>
                <input type="text" id="NAME<?php echo $i; ?>" name="NAME<?php echo $i; ?>" class="inputs" minlength="3" maxlength="20"><br>
                <div id="name<?php echo $i; ?>Er" class="errDes"></div>
                <label for="SURNAME<?php echo $i; ?>">Επώνυμο:</label><br>
                <input type="text" id="SURNAME<?php echo $i; ?>" name="SURNAME<?php echo $i; ?>" class="inputs" minlength="3" maxlength="20" >
                <div id="surname<?php echo $i; ?>Er" class="errDes"></div>
           </li>
            
            <?php endfor;?>
        </ul>
        <!--Παίρνει τον αριθμό των επιβατών σε ένα κρυφό πεδίο-->
        <input type="hidden" name="noPassenger" value="<?php echo (int)$reservationNo; ?>">
         
        <!--Κουμπί για την υποβολή της φόρμας-->
        <button type="submit" class="buttonReserve" >Υποβολή</button>
        
      </fieldset>
    </form>
    
</body>
<?php
    include 'Footer.php'; 
    
?>
</html>
