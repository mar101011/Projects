<?php
include 'Header.php'; 
include 'Connection.php'; 
include 'deleteRes.php'; 

if (isset($_SESSION['user'])) {
try {
    $user = $_SESSION['user'];
    
    //Ανακτά δεδομένα μιας κράτησης και των σχετικών εισιτηρίων από τη βάση
    $sql = "SELECT Airport_Departure, Airport_Arrivals, Flight_date, resId ,resPrice FROM reservations WHERE UseRes = :user";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user' => $user]);
    $air = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Ανακτά δεδομένα εισιτηρίων από τη βάση
    $ticket=[];

    foreach ($air as $details) {
        $resId = $details['resId'];

        $sql2 = "SELECT ticketname, ticketsurname, seat, ticketprice FROM tickets WHERE resId = :resId";
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
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/10030/10030373.png" type="image/icon type">
</head>
<body>

<form class="formCre" method="POST" >
    <h3 >Ακύρωση κράτησης</h3> 
    <select name="cancel" id="cancel" class="inputs">
        <option disabled selected>--Επέλεξε κράτηση--</option>
        <?php foreach($air as $reservation):?>
             <option value="<?=htmlspecialchars($reservation['resId'])?>"><?=htmlspecialchars($reservation['resId'])?> </option>
            <?php endforeach; ?>
          </select><br>
    <button type="submit" class="buttons" >Ακύρωση κράτησης</button>
      
</form>

<?php if (!empty($ticket)): ?>
    <?php foreach ($ticket as $details): ?>
        
        <!--Εμφανίζονται τα στοιχεία της κράτησης-->
        <div class="ticket">
            <h4>Πληροφορίες κράτησης</h4>
            <p>Αριθμός κράτησης: <?= htmlspecialchars($details['reservation']['resId']) ?></p>
            <p>Αεροδρόμιο αναχώρησης: <?= htmlspecialchars($details['reservation']['Airport_Departure']) ?></p>
            <p>Αεροδρόμιο άφιξης: <?= htmlspecialchars($details['reservation']['Airport_Arrivals']) ?></p>
            <p>Ημερομηνία πτήσης: <?= htmlspecialchars($details['reservation']['Flight_date']) ?></p>
            <p>Συνολικό κόστος: <?= htmlspecialchars($details['reservation']['resPrice']) ?></p>
           
            <hr><hr>
            <?php $i=0?>
            <?php foreach ($details['tickets'] as $ticket): ?>
                <?php $i++;?>
                <h4>Επιβάτης <?= $i ?></h4>
                <p>Όνομα: <?= htmlspecialchars($ticket['ticketname']) ?></p>
                <p>Επώνυμο: <?= htmlspecialchars($ticket['ticketsurname']) ?></p>
                <p>Θέση: <?= htmlspecialchars($ticket['seat']) ?></p>
                <p>Τιμή: <?= htmlspecialchars($ticket['ticketprice']) ?> €</p>
                <p>Φόρος αεροδρομίου αναχώρησης: <?= htmlspecialchars(number_format($taxes[$details['reservation']['resId']]['departure'], 2)) ?> €</p>
                <p>Φόρος αεροδρομίου άφιξης: <?= htmlspecialchars(number_format($taxes[$details['reservation']['resId']]['arrival'], 2)) ?> €</p>
                
                <hr>
                <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>

<?php
    include 'Footer.php'; 
    
?>
</html>
