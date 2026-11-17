
<?php
  session_start();//Ανοίγει ένα session
  include 'Connection.php';//Συμπεριλαμβάνεται τα αρχεία για να τρέξουμε οι διαδικασίες που περιέχουν
  include 'CheckCredentials.php';
?>
<!DOCTYPE html>
<html>
<head> <!--Ορίζουμε τον τίτλο της σελίδας, την εικόνα και συμπεριλαμβάνουμε το αρχείο css -->
    <title>Air Ds</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AirDs.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/10030/10030373.png" type="image/icon type">
</head>

<!--Ο header που περιλαμβάνει τα κουμπιά στο μενού-->
<header id="Home">
   
    <h2>Air Ds<img src="https://cdn-icons-png.flaticon.com/512/4524/4524198.png" alt="plane icon" width="30" height="30">
    </h2>
    <button class="hamburger" onclick="menuAction()"><img src="https://cdn-icons-png.flaticon.com/128/216/216676.png" ></button>
    <div class="menu">
      <nav>
        <ul>
          <!--Λίστα με κουμπιά μενού-->
           <li><a href="http://localhost/AirDs/Interface1.php" class="air">Home</a></li>
           <li><a href="http://localhost/AirDs/myTrip.php" class="air">My Trips</a></li>

            <?php if (empty($_SESSION['user'])): ?><!--Ανάλογα με το αν είναι Logged in ο χρήστης ή όχι μπαίνει το κατάλληλο λινκ-->
                <li><a href="http://localhost/AirDs/Login.php" class="air air-login">Login</a></li>
            <?php else: ?>
                <li><a href="http://localhost/AirDs/Logout.php" class="air air-login">Logout</a></li>
            <?php endif; ?>
        </ul>
      </nav>
    </div>            
 </header>

  <!--Τρέχουμε μια συνάρτηση Js για να εμφανίζεται και να εξαφανίζεται το μενού όταν πατιέται-->
  <script >
      function menuAction() {
      const menu = document.querySelector('.menu');
      menu.classList.toggle('show');}
  </script> 

 
</html>
