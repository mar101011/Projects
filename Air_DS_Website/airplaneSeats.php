<?php
    include 'Connection.php';
    include 'Header.php';  
    include 'Reservations.php';
    include 'ticketDetails.php';

    $reservationNo='';

       try {
           $sql = "SELECT No_of_passengers FROM reservations WHERE resId = :res";//Παίρνει τον αριθμό των επιβατών
           $stmt = $conn->prepare($sql);/*Προετοιμάζει την μεταβλητή με το query για εκτέλεση */
           $stmt->execute([':res' => $res]);/*Συνδέει τις μεταβλητές με την βάση */

           $reserve = $stmt->fetch(PDO::FETCH_ASSOC);
           
           if ($reserve) {//Βάζει τον αριμθό των επιβατών σε μία μεταβλητή
                $reservationNo = $reserve['No_of_passengers'];

            } else {
                $wrong = 'Δεν βρέθηκε αριθμός επιβατών.';
            }

       } catch (PDOException $e) {/*Αν υπάρξει σφάλμα το πίανει το catch και εμφανίζει αποτυχία σύνδεσης*/
           echo "Connection failed: " . $e->getMessage();
       }
       if (isset($_SESSION['user'])) {
try {
    //Ανακτά δεδομένα μιας κράτησης και των σχετικών εισιτηρίων από τη βάση
    $res = $_SESSION['ReserveId'];
    $sql = "SELECT Airport_Departure, Airport_Arrivals, Flight_date, resId FROM reservations WHERE resId = :res";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['res' => $res]);
    $air = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Ανακτά δεδομένα εισιτηρίων από τη βάση
    $ticket=[];

    foreach ($air as $details) {
        $resId = $details['resId'];

        $sql2 = "SELECT ticketname, ticketsurname FROM tickets WHERE resId = :resId";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute(['resId' => $resId]);
        $tickets = $stmt2->fetchAll(PDO::FETCH_ASSOC);

         $ticket[] = [
            'reservation' => $details,
            'tickets' => $tickets
        ];

   }

   // Φέρνουμε τους φόρους αεροδρομίου για κάθε κράτηση
    $taxes = [];
    foreach ($air as $details) {
        $resId = $details['resId'];
        $airportA = $details['Airport_Departure'];
        $sql3 =  "SELECT Airport_tax FROM airports WHERE Airport_code = :code";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(['code' => $airportA]);
        $tax1 = $stmt3->fetch(PDO::FETCH_ASSOC);

        $airportB = $details['Airport_Arrivals'];
        $sql4 = "SELECT Airport_tax FROM airports WHERE Airport_code = :code";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->execute(['code' => $airportB]);
        $tax2 = $stmt4->fetch(PDO::FETCH_ASSOC);
        $taxes[$resId] = [
                        'departure' => (float)($tax1['Airport_tax'] ?? 0),
                        'arrival' => (float)($tax2['Airport_tax'] ?? 0),
          ];

       }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

}
?>
<!DOCTYPE html>
<html>
<head> 
    <!--Συνδέουμε τα επιμέρους αρχεία,ορίζουμε τον τίτλο και το εικονίδιο-->
    <title>Air Ds</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AirDs.css">
    <link rel="stylesheet" href="airplaneSeats.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/10030/10030373.png" type="image/icon type">
    
</head>

<body>
    
     <!--Έχουμε το μενού με την εξήγηση των κουμπιών σε μία κλάση-->
    <div class="btnInfo">
        <label id="normal">Standard</label>
        <button type="button" class="choice letter" id="normal" disabled></button>
        <label id="extraLegroom">Extra legroom</label>
        <button type="button" class="choice letter extraLegroom" id="extraLegroom" disabled></button>
        <label id="upFront">Up Front</label>
        <button  type="button"class=" choice letter upFront" id="upFront" disabled></button>

    </div>
   <form method="POST" action="ticketDetails2.php">

   <!--Πεδίο για την μεταφορά των πατημένων θέσεων στην Js-->
   <input type="hidden" name="seatsSelect" id="seatsSelect" >
   <!--Πεδίο για να πάει τον αριθμό επιβατών στην js-->
   <input type="hidden" name="noOfPassengers" id="noOfPassengers" value="<?php echo (int)$reservationNo; ?>">
   <!--Κλάση plane για το πλαίσιο του αερπλάνου που περιλαμβάνει όλα τα κουμπιά-->
   <div class="plane">
   
   <!-- Γραμμή F -->
   <div class="planeRow">
    <p>F</p>
    <?php for($i=1;$i<=31;$i++): ?><!--Δημιουργούνται τα κουμπιά της γραμμής F-->
        <?php
            $seatType = '';
            if ($i == 1 or $i == 11 or $i == 12) {//Ορίζονται οι τύποι των συγκεκριμένων κατηγοριών για να αλλάζει χρώμα
                $seatType = 'extraLegroom';
            } elseif ($i >=2 and $i<=10) {
                $seatType = ' upFront';
            } 
        ?>
        <!--Ορίζεται το κουμπί και οι κλάσεις στις οποίες ανήκει για να παίρνει την μορφή από CSS.Επίσης έχει τιμή το F ακολουθόμενο από τον αριθμό του κουμπιού-->
        <button type="button" class="seat letter <?php echo $seatType; ?>" value="<?php echo "F".$i?>"><?php echo "F".$i?></button>
    <?php endfor; ?>
  </div>

  <!--Αντίστοιχα και για τις υπόλοιπες γραμμές-->
    <!-- Γραμμή E -->
    <div class="planeRow">
    <p>E</p>
    <?php for($i=1;$i<=31;$i++): ?>
        <?php
            $seatType = '';
            if ($i == 1 or $i == 11 or $i == 12) {
                $seatType = 'extraLegroom';
            } elseif ($i >=2 and $i<=10) {
                $seatType = ' upFront';
            } 
        ?>
        <button type="button" class="seat letter <?php echo $seatType; ?>" value="<?php echo "E".$i?>"><?php echo "E".$i?></button>
    <?php endfor; ?>
  </div>

    <!-- Γραμμή D -->
    <div class="planeRow">
    <p>D</p>
    <?php for($i=1;$i<=31;$i++): ?>
        <?php
            $seatType = '';
            if ($i == 1 or $i == 11 or $i == 12) {
                $seatType = 'extraLegroom';
            } elseif ($i >=2 and $i<=10) {
                $seatType = ' upFront';
            } 
        ?>
        <button type="button" class="seat letter <?php echo $seatType; ?>" value="<?php echo "D".$i?>"><?php echo "D".$i?></button>
    <?php endfor; ?>
  </div>
 
  <!--Κενός διάδρομος-->
    <div class="planeRow noNum">
       <?php for($i=1;$i<=31;$i++):?>
          <button type="button" class="numbers" disabled></button><!--Κουμπί που δεν πατιέται απλά το δημιούργησα για να αφήσω τόσο χ΄΄ώρο στο διάδρομο όσο τα άλλα κουμπιά-->
       <?php endfor;?>
    </div>

    <!-- Γραμμή C -->
    <div class="planeRow">
    <p>C</p>
    <?php for($i=1;$i<=31;$i++): ?>
        <?php
            $seatType = '';
            if ($i == 1 or $i == 11 or $i == 12) {
                $seatType = 'extraLegroom';
            } elseif ($i >=2 and $i<=10) {
                $seatType = ' upFront';
            } 
        ?>
        <button type="button" class="seat letter <?php echo $seatType; ?>" value="<?php echo "C".$i?>"><?php echo "C".$i?></button>
    <?php endfor; ?>
  </div>
     
    <!-- Γραμμή B -->
    <div class="planeRow">
    <p>B</p>
    <?php for($i=1;$i<=31;$i++): ?>
        <?php
            $seatType = '';
            if ($i == 1 or $i == 11 or $i == 12) {
                $seatType = 'extraLegroom';
            } elseif ($i >=2 and $i<=10) {
                $seatType = ' upFront';
            } 
        ?>
        <button type="button" class="seat letter <?php echo $seatType; ?>" value="<?php echo "B".$i?>"><?php echo "B".$i?></button>
    <?php endfor; ?>
  </div>
    <!-- Γραμμή A -->
    <div class="planeRow">
    <p>A</p>
    <?php for($i=1;$i<=31;$i++): ?>
        <?php
            $seatType = '';
            if ($i == 1 or $i == 11 or $i == 12) {
                $seatType = 'extraLegroom';
            } elseif ($i >=2 and $i<=10) {
                $seatType = ' upFront';
            } 
        ?>
        
        <button type="button" class="seat letter <?php echo $seatType; ?>" value="<?php echo "A".$i?>"><?php echo "A".$i?></button>
    <?php endfor; ?>
  </div>
  
  </div>
 
  <button type="submit" id="submitSeats" disabled>Κράτηση</button><!--Κουμπί για υποβολή φόρμας το οποίο ενεργοποιείται μόνο όταν έχει επιλεγεί ο κατάλληλος αριθμός θέσεων-->
  <div id="selectedSeatsInfo" >
    
    <?php if (!empty($ticket)): ?>
    <?php foreach ($ticket as $details): ?>
        
            <!--Παίρνει τις επιλεγμένες θέσεις δυναμικά και εμφανίζει και τον αριθμό επιβατών-->
            <div class="ticket">
            <div id="selection" class="details">
            <p id="selectedSeatsText">Επιλεγμένες θέσεις:-</p>
            <p id="passengerCount">Αριθμός επιβατών: <?php echo (int)$reservationNo; ?></p>
     
  </div>     
            <!--Εμφανίζονται τα στοιχεία της κράτησης-->
            <h4>Πληροφορίες κράτησης</h4>
            <p>Αριθμός κράτησης: <?= htmlspecialchars($details['reservation']['resId']) ?></p>
            <p>Αεροδρόμιο αναχώρησης: <?= htmlspecialchars($details['reservation']['Airport_Departure']) ?></p>
            <p>Αεροδρόμιο άφιξης: <?= htmlspecialchars($details['reservation']['Airport_Arrivals']) ?></p>
            <p>Ημερομηνία πτήσης: <?= htmlspecialchars($details['reservation']['Flight_date']) ?></p>
            
            <hr><hr>
            <?php $i=0?>
            <?php foreach ($details['tickets'] as $ticket): ?>
                <?php $i++;?>
                <h4>Επιβάτης <?= $i ?></h4>
                <p>Όνομα: <?= htmlspecialchars($ticket['ticketname']) ?></p>
                <p>Επώνυμο: <?= htmlspecialchars($ticket['ticketsurname']) ?></p>
                <p>Φόρος αεροδρομίου αναχώρησης: <?= htmlspecialchars(number_format($taxes[$details['reservation']['resId']]['departure'], 2)) ?> €</p>
                <p>Φόρος αεροδρομίου άφιξης: <?= htmlspecialchars(number_format($taxes[$details['reservation']['resId']]['arrival'], 2)) ?> €</p>
                
                <hr>
                <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
  <?php endif; ?>
  </div>
</form>

</body>

<script>//Js για κάλεσμα php για έλεγχο και αλλαγή χρώματος κουμπιού κρατημένων θέσεων
    const unavailableSeats = <?php echo json_encode($unavailableSeats); ?>;//Δέχεται τις θέσεις από την php

    // Μόλις φορτωθεί η σελίδα εκτελείται το παρακάτω μπλοκ κώδικα
    window.addEventListener('DOMContentLoaded', () => {
        //Παίρνει κάθε τιμή του πίνακα με τις αποθηκευμένες θέσεις και τις βάζει στην μεταβλητή seatId
        seats();
        unavailableSeats.forEach(seatId => {
            
            //Επιλέγει το κουμπί με την αντίστοιχη θέση
            const seatBtn = document.querySelector(`button.seat[value='${seatId}']`);
            if (seatBtn) {
                seatBtn.classList.add('reservedSeat'); // Πρoσθέτει κλάση reservedSeat για να αλλάζει το χρώμα
                seatBtn.disabled = true; // Σταματάει να πατιέται το κουμπί
            }
        });
    });
    
</script>

<script src="CheckCredentials.js"></script> <!--Κάλεσμα JS-->
<?php
    include 'Footer.php'; 
    
?>
</html>
