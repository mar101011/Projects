<?php include 'Header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>We/fix -Announcements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.freepik.com/512/6672/6672004.png" type="image/icon type">
    <link rel="stylesheet" href="HelpDesk.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body class="mainBody">
       <div class="FormLayout" style="max-width: 900px; width: 90%;">
                
                <form id="formAnn" class="form" method="POST" action="" >
                    <h3 >Δημιουργία νέας ανακοίνωσης</h3>

                    <div>
                        <label for="title" >Τίτλος ανακοίνωσης</label><br>
                        <input type="text" id="title" name="title" class="inputs" value="" required style="margin-top:20px">
                    </div>

                    <label for="editor">Περιεχόμενο ανακοίνωσης</label>
                    <div id="editor" style="height: 200px; background: white; color: black;"></div>

                    <div class="FormBtn">
                        <button type="submit" class="buttons" >Καταχώρηση</button>
                        <button type="button" class="cancel" id="cancelAnn">Ακύρωση</button>
                    </div>
                </form>

            </div>
       </div>

 <script src="AnnouncementAdd.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
 <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

</body>
<?php include 'footer.php'; ?>
</html>