<?php
    include 'Header.php'; 
    include 'Connection.php'; 
    $wrong='';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       $username=$_POST['user']??'';//Πα΄ίρνει το username από τη φόρμα
       $password=$_POST['pass']??'';//Παίρνει το password από τη φόρμα
       try {
        
           // Ψάχνει χρήστες με αυτά τα στοιχεία
           $sql = "SELECT Username, Password FROM users WHERE Username = :username AND Password = :password";
           $stmt = $conn->prepare($sql);
           $stmt->execute([':username' => $username, ':password' => $password]);

           $userPass = $stmt->fetch(PDO::FETCH_ASSOC);

           if ($userPass) {//Εάν βρει κάποιον ανήγει ένα session και ανακατευθύνει στο myTrip
               $_SESSION['user'] = $username;
               header("Location: myTrip.php");  
               exit;
           } else {
               $wrong="Λάθος στοιχεία:";
           }
       } catch (PDOException $e) {
           echo "Connection failed: " . $e->getMessage();
       }
   }
?>
<!DOCTYPE html>
<html>
<head>
    <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://icons.veryicon.com/png/o/miscellaneous/domain-icons/my-account-login.png" type="image/icon type">
    <link rel="stylesheet" href="AirDs.css">
    <style>
        
        label{
            text-align: left;
            margin-right: 130px;
        }
    
    </style>
</head>
<body>
     <!--Φόρμα για Login-->
  <form class="formCre" method="POST" action="" >
    <h3>Login</h3>
    <?php if (!empty($wrong)): ?><!--Ορίζει το στυλ για τα ερρορ και το εμφανίζει-->
          <p style="background-color:rgb(226, 106, 80,0.5); border:solid 1px rgb(160, 62, 40); font-size:20px;">
            <?php echo $wrong;?><br>
            <span style="font-size:15px;">Μη έγκυρο username η password</span> 
          
        </p>
    <?php endif; ?>

   
    <label for="user">Username</label><br>
    <input type="text" id="user" name="user" class="inputs" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>" required><br><br><br>
    <label for="pass">Password</label><br>
    <input type="password" id="pass" name="pass" class="inputs" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>" required><br><br><br>
    <span style="color:azure; margin-top:-20px;">Δεν έχεις λογαριαμό?</span>
    <a href="http://localhost/AirDs/Register.php">Register here</a><!--Ανακατεύθυνση σε Resgister-->
    <button type="submit" class="buttons">Login</button>

  </form>
 
</body>
<?php
    include 'Footer.php'; 
    
?>
</html>
