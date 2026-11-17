<?php include 'Header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>We/fix -Announcements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.freepik.com/512/6672/6672004.png" type="image/icon type">
    <link rel="stylesheet" href="HelpDesk.css">
</head>

<body class="mainBody">

    <div class="FormLayout" style="max-width: 900px; width: 90%;">
        <div class="form">
            <div class="details">
                
                <img src="https://cdn-icons-png.freepik.com/512/8905/8905508.png" alt="Announcement icon" width="50" height="50">
                <h3 style="margin-top:40px">Ανακοινώσεις</h3>
                <button id="newAnn" style="margin-left:400px; margin-top:30px" type="button" class="buttons">+Νέα ανακοίνωση</button>
            
            </div>

            <div id="announcement">
            </div>
        </div>
    </div>
 <script src="Announcement.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
 <script src="Hide.js" defer></script> <!--Krubei koumbia pou den xreiazontai-->

</body>
<?php include 'footer.php'; ?>
</html>