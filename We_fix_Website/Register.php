<!DOCTYPE html>
<html>
<head>
    <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
    <title>We/fix -Εγγραφή</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.freepik.com/512/6672/6672004.png" type="image/icon type">
    <link rel="stylesheet" href="HelpDesk.css">
    <style>
        
        label{
            text-align: left;
            margin-right: 130px;
        }
    
    </style>
</head>
<body class="LoginBody">

    <div class="LoginLayout">
        <div class="LoginLeft">
             <h3>Welcome to We/fix</h3>
             <span>Register to make your life easier</span>
        </div>
        <div>
            <!--Φόρμα για Login-->
            <form id="formCre" class="formCre" method="POST" action="" >
               <h3>Εγγραφή</h3>

               <div>
                   <label for="name">Όνομα</label><br>
                   <input type="text" id="name" name="name" class="inputs" value="" required>
               </div>

               <div>
                    <label for="surname">Επώνυμο</label><br>
                    <input type="text" id="surname" name="surname" class="inputs" value="" required>
               </div>

               <div>
                    <label for="country">Χώρα</label><br>
                        <select name="country" id="country">
                             <option value="">Επιλέξτε...</option>
                        </select>
               </div>

               <div>
                    <label for="town">Πόλη</label><br>
                        <select name="town" id="town">
                             <option value="">Επιλέξτε...</option>
                        </select>
               </div>

               <div>
                    <label for="address">Διεύθυνση</label><br>
                    <input type="text" id="address" name="address" class="inputs" value="" required>
               </div>

               <div>
                    <label for="email">Email</label><br>
                    <input type="text" id="email" name="email" class="inputs" value="" required>
               </div>

               <div>
                    <label for="user">Username</label><br>
                    <input type="text" id="user" name="user" class="inputs" value="" required>
               </div>

               <div>
                   <label for="pass">Password</label><br>
                   <input type="password" id="pass" name="pass" class="inputs" value="" required>
               </div><br><br>

               <span style="color:azure; margin-top:-20px;">Έχεις ήδη λογαριασμό?</span>

               <a href="http://localhost/Diadiktuakos_programmatismos/Login.php">Σύνδεση</a><!--Ανακατεύθυνση σε Resgister-->
               <button type="submit" class="buttons">Εγγραφή</button>

            </form>
        </div>
    </div>
    <script src="registerUser.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   
</body>
</html>
