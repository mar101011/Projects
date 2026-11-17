<?php
    include 'Connection.php';
    include 'Header.php';  
    include 'Reservations.php';
?>
<!DOCTYPE html>
<html>
<head> 
  <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
    <title>Air Ds</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AirDs.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/10030/10030373.png" type="image/icon type">
</head>

<body>
    <!--Φόρμα με επιλογές κράτησης-->
    <form class="formCre" action="" method="POST" onsubmit="return airport()">

        <h3>Κάνε κράτηση εδώ</h3>
        <label for="AirA">Αεροδρόμιο Αναχώρησης</label> 
        <select name="AirA" id="AirA" class="inputs"><!--Dropdown μενου με αεροπλάνα-->
            <option disabled selected>--Επέλεξε αεροδρόμιο--</option>
            <?php 
               if(!empty ($airports)){
                   foreach($airports as $airport){
            ?>
                      <option value="<?=htmlspecialchars($airport['Airport_code'])?>"><!--Δέχεται τα δεδομένα αεροδρομίου που αποθηκεύτηκαν στη βάση και τα εμφανίζει ως επιλογές-->
                        <?=htmlspecialchars($airport['Airport_name'])?> (<?=htmlspecialchars($airport['Airport_code'])?>)
                      </option>
            <?php
                   }
               }
            ?>
          </select><br>

          <label for="AirB">Αεροδρόμιο Άφιξης</label>  
          <select name="AirB" id="AirB" class="inputs"><!--Dropdown μενου με αεροπλάνα-->
            <option disabled selected>--Επέλεξε αεροδρόμιο--</option>
            <?php 
               if(!empty ($airports)){
                   foreach($airports as $airport){
            ?>
                      <option value="<?=htmlspecialchars($airport['Airport_code'])?>"><!--Δέχεται τα δεδομένα αεροδρομίου που αποθηκεύτηκαν στη βάση και τα εμφανίζει ως επιλογές-->
                        <?=htmlspecialchars($airport['Airport_name'])?> (<?=htmlspecialchars($airport['Airport_code'])?>)
                      </option>
            <?php
                   }
               }
            ?>
            
          </select><br>
          <div id="airErr" class="err"></div><!--Εμφανίζει έρρορ για λάθος στοιχεία-->

          <label for="dateFly">Ημερομηνία πτήσης</label><br>
          <input type="date" id="dateFly" name="dateFly" class="inputs"><br>

          <label for="people">Πλήθος επιβατών</label><br>
          <input type="number" id="people" name="people" min="0" class="inputs"><br>
          <?php if (empty($_SESSION['user'])): ?><!--Ανάλογα με το αν είναι Logged in ο χρήστης ή όχι απενεργοποιείται ή όχι το κουμπί κράτησης-->
                <button type="submit" disabled>Κράτηση</button>
          <?php else: ?>
                <button type="submit" class="buttons" >Κράτηση</button>
          <?php endif; ?>
          
    </form>
    <script src="CheckCredentials.js"></script>             
</body>
<?php
    include 'Footer.php'; 
    
?>
</html>
