
<?php
   //PHP για σύνδεση με την βάση

   //Ορίζουμε την βάση το username και το password για να μπορούμε να συνδεθούμε
   $servername= "mysql:host=localhost;dbname=air_ds";
   $dbusername= "root";
   $dbpassword="";

   try{

       //Δημιουργεί PDO instance
       $conn= new PDO($servername,$dbusername,$dbpassword);
       $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 
       $sql="SELECT * FROM airports";

       $stmt=$conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
       $stmt->execute();/*Συνδέει τις μεταβλητές με την βάση */

       //Fetch  
       $airports= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  }catch(PDOException $e){/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
         echo "Connection failed: " . $e->getMessage();
  }
?>
