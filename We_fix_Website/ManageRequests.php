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
                
                <h3>Διαχείρηση αιτημάτων</h3>
                
            </div>
            <div id="newReqForm" class="FormLayout" style="display: none; background-color: #bbc1f1;">
                <div class="form">
                     <h5>Πληροφορίες αιτήματος</h5>
    
                     <label for="reqSubject">Θέμα:</label>
                     <input type="text" id="reqSubject" name="reqSubject" class="inputs" value="" readonly>

                     <label for="reqCategory">Κατηγορία:</label>
                     <input type="text" id="reqCategory" name="reqCategory" class="inputs" value="" readonly>

                      <label for="reqDesc">Περιγραφή:</label>
                      <input type="text" id="reqDesc" name="reqDesc" class="inputs" value="" readonly>

                      <label for="reqDate">Ημερομηνία αιτήματος:</label>
                      <input type="text" id="reqDate" name="reqDate" class="inputs" value="" readonly>
                    
                       <h5>Επεξεργασία αιτήματος</h5>
    
                       <label for="reqComments">Σχόλια:</label>
                       <textarea id="reqComments" name="reqComments" class="inputs"></textarea>

                       <label for="reqActions">Ενέργειες:</label>
                       <textarea id="reqActions" name="reqActions" class="inputs"></textarea>

                       <label for="reqTech">Τεχνικός:</label>
                       <select id="reqTech" class="inputs ">
                            <option>Επιλέξτε...</option>
                       </select>

                       <label for="reqStatus">Κατάσταση:</label>
                       <select id="reqStatus" class="inputs ">
                            <option value="Εκκρεμής">Εκκρεμής</option>
                            <option value="Σε εξέλιξη">Σε εξέλιξη</option>
                            <option value="Ολοκληρωμένη">Ολοκληρωμένη</option>
                       </select>

                      <br>
                      <div class="FormBtn">
                           <button id="submitReqBtn" class="buttons">Αποθήκευση</button>
                          <button id="cancelReqBtn" class="cancel" style="margin-left: 10px;">Ακύρωση</button>
                      </div>
                </div>
            </div>
            <div class="tableScroll">
              <table class="tableScroll">
                
                <thead>
                    <tr class="Titles">

                        
                        <th>Ενέργειες</th>
                        <th>Id αίτησης</th>
                        <th>Κατάσταση</th>
                        <th>Ημερομηνία</th>
                        <th>Τεχνικός</th>
                        <th>Θέμα</th>
                        <th>Κατηγορία</th>
                        <th>Περιγραφή</th>
                        <th>Αρχείο</th>
                        <th>Id χρήστη</th>

                    </tr>
                </thead>

                <tbody id="reqEditDetails">
                </tbody>
             </table>
           </div>
        </div>
    </div>

    <script src="ManageRequests.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
   
</body>
<?php include 'footer.php'; ?>
</html>