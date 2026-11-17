<?php
    include 'Header.php'; 
    include 'Connection.php';
    include 'CheckCredentials.php';
?>

<!DOCTYPE html>
<html>
<head>
    <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://icons.veryicon.com/png/o/miscellaneous/domain-icons/my-account-login.png" type="image/icon type">
    <link rel="stylesheet" href="AirDs.css">
</head>
<body>
    <!--Φόρμα για υποβολή στοιχείων εγγραφής-->
   <form class="formCre" action="" method="POST" onsubmit="return checkCredentials()">
      <h3>Register</h3>
      <!--Ορίζεται το στυλ για τα μηνύματα ερρορ-->
      <?php if (!empty($usTaken)): ?>
          <p style="background-color:rgb(226, 106, 80,0.5); border:solid 1px rgb(160, 62, 40); font-size:15px;">
             <?php echo $usTaken;?><br>
          
          </p>
      <?php elseif (!empty($emailTaken)):?>
          <p style="background-color:rgb(226, 106, 80,0.5); border:solid 1px rgb(160, 62, 40); font-size:15px;">
            <?php echo $emailTaken;?><br>
          </p>
      <?php endif; ?>

      <!--Ορίζονται οι ετικέτες τα πεδία που δέχονται τις τιμές και οι κλάσεις που θα εμφανίζουν τα ερρορ-->
      <label for="Name">Όνομα</label><br>
      <input type="text" id="Name" name="Name" class="inputs" required><br><br><br>
      <div id="nErr" class="err"></div>

      <label for="Surname">Επώνυμο</label><br>
      <input type="text" id="Surname" name="Surname" class="inputs" required><br><br><br>
      <div id="surErr" class="err"></div>

      <label for="username">Username</label><br>
      <input type="text" id="username" name="username" class="inputs"  required><br><br><br>

      <label for="passRe">Password</label><br>
      <input type="password" id="passRe" name="passRe" class="inputs"  required><br><br><br>
      <div id="pasE" class="err"></div>

      <label for="Email">E-mail</label><br>
      <input type="email" id="Email" name="Email" class="inputs" required><br><br><br>
      <div id="emailE" class="err"></div>

      <span style="color:azure; margin-top:-20px;">Έχεις ήδη λογαριασμό?</span>
      <a href="http://localhost/AirDs/Login.php">Login</a><!--Λινκ για τη μεταφορά στο login αν ο χρήστης έχει ήδη λογαριασμό-->

      <!--Κουμπί για υποβολή φόρμας-->
      <button type="submit" class="buttons">Register</button>
  </form>
  <script src="CheckCredentials.js"></script><!--Κάλεσμα JS-->
  </body>
<?php
    include 'Footer.php'; 
    
?>
</html>