<!DOCTYPE html>
<html>
<head>
    <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
    <title>We/fix -Login</title>
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
             <span>Login to make your life easier</span>
        </div>
        <div>
            <!--Φόρμα για Login-->
            <form id="formCreLogin" class="formCreLogin" method="POST" action="" >
               <h3>Σύνδεση</h3>
               <label for="user">Username</label><br>
               <input type="text" id="user" name="user" class="inputs" value="" required><br><br><br>
               <label for="pass">Password</label><br>
               <input type="password" id="pass" name="pass" class="inputs" value="" required><br><br><br>
               <span style="color:azure; margin-top:-20px;">Δεν έχεις λογαριασμό?</span><br>

               <a href="http://localhost/Diadiktuakos_programmatismos/Register.php">Εγγραφή</a><!--Ανακατεύθυνση σε Resgister-->
               <br><br><br><button type="submit" class="buttons">Σύνδεση</button>

            </form>
        </div>
    </div>
    <script src="loginUser.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   
 
</body>
</html>
