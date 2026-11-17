 <?php include 'Header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>We/fix -Διαχείρηση χρηστών</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.freepik.com/512/6672/6672004.png" type="image/icon type">
    <link rel="stylesheet" href="HelpDesk.css">
</head>

<body class="mainBody">

    <div class="FormLayout" style="max-width: 900px; width: 90%;">
        <div class="form">
            
            <div class="details">
                
                <h3>Διαχείρηση χρηστών</h3>
                <button id="newUser" style="margin-left:360px; margin-top:30px" type="button" class="buttons">+Νέος χρήστης</button>

            </div>
            <div id="newUserForm" class="FormLayout" style="display: none; background-color: #bbc1f1;">
                <div class="form">
                     <h5>Προσθήκη χρήστη</h5>
    
                     <label for="userName">Όνομα:</label>
                     <input type="text" id="userName" name="userName" class="inputs" value="" required>

                     <label for="userSurname">Επώνυμο:</label>
                     <input type="text" id="userSurname" name="userSurname" class="inputs" value="" required>
    
                     <label for="userCountry">Χώρα:</label>
                     <select id="userCountry" class="inputs" >
                            <option value="">Επιλέξτε...</option>
                      </select>

                      <label for="userTown">Πόλη:</label>
                      <select id="userTown" class="inputs" >
                            <option value="">Επιλέξτε...</option>
                      </select>

                      <label for="userAddress">Διεύθυνση:</label>
                      <input type="text" id="userAddress" name="userAddress" class="inputs" value="" required>

                      <label for="userEmail">Email:</label>
                      <input type="text" id="userEmail" name="userEmail" class="inputs" value="" required>

                      <label for="userUsername">Username:</label>
                      <input type="text" id="userUsername" name="userUsername" class="inputs" value="" required>

                      <div id="passDetails">
                          <label for="userPassword">Password:</label>
                          <input type="password" id="userPassword" name="userPassword" class="inputs" value="" required>

                      </div>
                      
                      <label for="userRole">Ρόλος:</label>
                      <select id="userRole" class="inputs ">
                            <option value="User">Απλός Χρήστης</option>
                            <option value="Technician">Τεχνικός</option>
                            <option value="Admin">Διαχειριστής</option>
                    </select>

                      <br>
                      <div class="FormBtn">
                           <button id="submitUserBtn" class="buttons">Αποθήκευση</button>
                          <button id="cancelUserBtn" class="cancel" style="margin-left: 10px;">Ακύρωση</button>
                      </div>
                </div>
            </div>
            <div class="tableScroll">
              <table >
                
                <thead>
                    <tr class="Titles">

                        <th>Ενέργειες</th>
                        <th>Id</th>
                        <th>Όνομα</th>
                        <th>Επώνυμο</th>
                        <th>Χώρα</th>
                        <th>Πόλη</th>
                        <th>Διεύθυνση</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Ρόλος</th>

                    </tr>
                </thead>

                <tbody id="userEditDetails">
                </tbody>
             </table>
           </div>
        </div>
    </div>

    <script src="ManageUsers.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   
</body>
<?php include 'footer.php'; ?>
</html>