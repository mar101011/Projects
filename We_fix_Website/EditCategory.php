 <?php include 'Header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>We/fix -Διαχείρηση κατηγοριών</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.freepik.com/512/6672/6672004.png" type="image/icon type">
    <link rel="stylesheet" href="HelpDesk.css">
</head>

<body class="mainBody">

    <div class="FormLayout" style="max-width: 900px; width: 90%;">
        <div class="form">
            
            <div class="details">
                
                <h3>Διαχείρηση κατηγοριών</h3>
                <button id="newCategory" style="margin-left:360px; margin-top:30px" type="button" class="buttons">+Νέα κατηγορία</button>

            </div>
            <div id="newCatForm" class="FormLayout" style="display: none; background-color: #bbc1f1;">
                <div class="form">
                     <h5>Προσθήκη Κατηγορίας</h4>
    
                     <label>Όνομα Κατηγορίας:</label>
                     <input type="text" id="catName" class="inputs" >
    
                     <label>Προτεραιότητα:</label>
                     <select id="catPriority" class="inputs" >
                            <option value="Χαμηλή">Χαμηλή</option>
                            <option value="Μέτρια">Μέτρια</option>
                            <option value="Υψηλή">Υψηλή</option>
                      </select>
                      <br>
                      <div class="FormBtn">
                           <button id="submitCatBtn" class="buttons">Αποθήκευση</button>
                          <button id="cancelCatAddBtn" class="cancel" style="margin-left: 10px;">Ακύρωση</button>
                      </div>
                      </div>
                </div>
            <table >
                <thead>
                    <tr class="Titles">
                        <th>Κατηγορία</th>
                        <th>Προτεραιότητα</th>
                        <th>Ενέργειες</th>

                    </tr>
                </thead>

                <tbody id="categoryEdit">
                </tbody>
            </table>
    
        </div>
    </div>

    <script src="EditCategory.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   
</body>
<?php include 'footer.php'; ?>
</html>