<?php
    /*Κλείνει το session και χάνoνται τα στοιχεία που ήταν αποθηκευμένα για μα διατηρείται η σύνδεση*/
    session_start(); 
    session_destroy();
    //Πηγαίνει στην σελίδα του login
    header("Location:Login.php");
?>