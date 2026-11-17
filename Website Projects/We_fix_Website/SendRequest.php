<?php include 'Header.php'; ?><!--Sundeoume ton Header-->
<!DOCTYPE html>
<html>
<head>
    <!--Sundeoume ta epimerous arxeia, orizoume ton titlo kai to eikonidio-->
    <title>We/fix -Αίτημα</title>
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


<body class="mainBody">

    <div class="FormLayout">
        
            <!--Forma gia to aithma me ta antistoixa pedia-->
            <form class="form" id="sendRequest" method="POST" action="" enctype="multipart/form-data">
               <h3>Αίτημα τεχνικής υποστήριξης</h3>

               <label for="subject">Θέμα</label>
               <input type="text" id="subject" name="subject" class="inputs" placeholder="Π.χ. Πρόβλημα με τα windows" required>

               <label for="category">Κατηγορία προβλήματος</label>
                        <select name="category" id="category" class="inputs">
                             <option value="">Επιλέξτε...</option>
                        </select>

               <label for="description">Περιγραφή Προβλήματος</label>
               <textarea id="description" name="description" class="inputs" rows="5" placeholder="Γράψτε εδώ αναλυτικά το πρόβλημα..." required></textarea>

               <label for="files">Επισύναψη </label>
               <input type="file" id="files" name="files">
            
               <div class="FormBtn">
                   <button type="submit" class="buttons">Καταχώρηση</button>
                   <button type="reset" class="cancel">Ακύρωση</button>
               </div>

            </form>
    </div>
   <script src="SendReqUser.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   <!--Sundeoume to js gia na parei ta dedomena apo ta pedia-->
 
</body>

<?php include 'footer.php'; ?><!--Sundeoume ton footer-->
</html>
