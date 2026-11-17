<!DOCTYPE html>
<html>
<!--Ο header που περιλαμβάνει τα κουμπιά στο μενού-->
<header id="Home">
   
    <h2>We/fix<img src="https://cdn-icons-png.freepik.com/512/6672/6672004.png" alt="Tools Icon" width="30" height="30"></h2>
  

    <div class="menu">
      <nav>
        <ul>
          <!--Λίστα με κουμπιά μενού. Ελέγχει εάν η σελίδα που είναι ο χρήστης είναι αυτή και αν ναι υπογραμμίζει την κατάλληλη επιλογη του μενού-->
           <li class="usersMenu"><a href="http://localhost/Diadiktuakos_programmatismos/SendRequest.php">Αίτημα</a></li>
           <li class="usersMenu"><a href="http://localhost/Diadiktuakos_programmatismos/PreviewRequest.php">Προβολή αιτημάτων</a></li>
           <li class="usersMenu"><a href="http://localhost/Diadiktuakos_programmatismos/History.php">Ιστορικό</a></li>
           <li class="usersMenu"><a href="http://localhost/Diadiktuakos_programmatismos/Announcement.php">Ανακοινώσεις</a></li>


           <li class="adminMenu"><a href="http://localhost/Diadiktuakos_programmatismos/ManageRegister.php">Αιτήματα εγγραφών</a></li>
           <li class="adminMenu"><a href="http://localhost/Diadiktuakos_programmatismos/ManageUsers.php">Χρήστες</a></li>
           <li class="adminMenu"><a href="http://localhost/Diadiktuakos_programmatismos/EditCategory.php">Κατηγορίες</a></li>
           <li class="adminMenu"><a href="http://localhost/Diadiktuakos_programmatismos/ManageRequests.php">Αιτήματα υποστήριξης</a></li>
           <li class="adminMenu"><a href="http://localhost/Diadiktuakos_programmatismos/Announcement.php">Ανακοινώσεις</a></li>
           
           <li class="techMenu"><a href="http://localhost/Diadiktuakos_programmatismos/ManageRequests.php">Αιτήματα υποστήριξης</a></li>
           <li class="techMenu"><a href="http://localhost/Diadiktuakos_programmatismos/Announcement.php">Ανακοινώσεις</a></li>
           
           
        </ul>
        <button onclick="logout()" class="logoutbtn">
          <img src="https://cdn-icons-png.flaticon.com/512/5542/5542808.png" alt="Logout Icon" width="35" height="35">
  
        </button>
           
      </nav>
    </div>    
    <script src="menuOptions.js" defer></script> <!--Katebazei to arxeio alla den to trexei mexri na dhmiourghthei h selida-->
    <script>

      function logout() {
         localStorage.clear(); 
         window.location.href = 'Login.php'; 
      }

    </script>    
</header>
</html>
