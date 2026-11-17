 <?php include 'Header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>We/fix -Ιστορικό</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.freepik.com/512/6672/6672004.png" type="image/icon type">
    <link rel="stylesheet" href="HelpDesk.css">
</head>

<body class="mainBody">

    <div class="FormLayout" style="max-width: 900px; width: 90%;">
        <div class="form">
            <h3>Ιστορικό Αιτημάτων</h3>
            
            <table >
                <thead>
                    <tr class="Titles">
                        <th>Θέμα</th>
                        <th>Κατηγορία</th>
                        <th>Περιγραφή</th>
                        <th>Κατάσταση</th>
                        <th>Αρχείο</th>
                        <th>Ημερομηνία</th>
                    </tr>
                </thead>
                <tbody id="historyData">  
                </tbody>
            </table>
    
        </div>
    </div>
 <script src="historyReq.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   
</body>
<?php include 'footer.php'; ?>
</html>