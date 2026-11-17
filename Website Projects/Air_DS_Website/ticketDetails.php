<?php
//PHP για την εύρεση κρατημένων θέσεων
include 'Connection.php';

$unavailableSeats = [];

if (isset($_SESSION['ReserveId'])) {
    $res = $_SESSION['ReserveId'];//Παίρνω το cookie
    
    try {
        $sql = "SELECT Flight_date FROM reservations WHERE resId = :res"; 
        $stmt = $conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
        $stmt->execute(['res' => $res]);/*Συνδέει τις μεταβλητές με την βάση */
        $flightDate = $stmt->fetchColumn();
        
        /*Επιστρέφει τις θέσεις από τον πίνακα tickets αφού τον ενώσει με τον reservations για να συγκρίνει τα βρει θέσεις ίδιας ημερομηνίας με την κράτηση*/
        $sql = "
                SELECT t.seat 
                FROM tickets t
                JOIN reservations r ON t.resId = r.resId
                WHERE r.Flight_date = :flightDate
            ";
        $stmt = $conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
        $stmt->execute(['flightDate' => $flightDate]);/*Συνδέει τις μεταβλητές με την βάση */
        $unavailableSeats = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
    } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
        echo "DB error: " . $e->getMessage();
    }
}

?>
