function checkCredentials()
  {
    //Δέχεται όλες τις τιμές από τα αντίστοιχα πεδία
    var nameU=document.getElementById("Name").value;
    var surnameU=document.getElementById("Surname").value;
    var passwordU=document.getElementById("passRe").value;
    var emailU=document.getElementById("Email").value;

    //Ορίζει καινούργιες μεταβλήτες στις οποίες θα περαστούν τα μηνύματα ερρορ
    document.getElementById("nErr").innerHTML = "";
    document.getElementById("surErr").innerHTML = "";
    document.getElementById("pasE").innerHTML = "";
    document.getElementById("emailE").innerHTML = "";

    //Ελέγχει τα πεδία αν έχουν έγκυρες τιμές αλλιώς οι μεταβλητές για τα ερρορ παίρνουν τις αντίστοιχες τιμές
    if (!nameU.match(/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/)){//Ελέγχεται αν έχει μόνο χαρακτήρες
        document.getElementById("nErr").innerHTML="Μόνο χαρακτήρες"
        return false;
    }

     if (!surnameU.match(/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/)){//Ελέγχεται αν έχει μόνο χαρακτήρες
        document.getElementById("surErr").innerHTML="Μόνο χαρακτήρες"
        return false;
    }

    if(passwordU.length<4 || passwordU.length>10){//Ελέγχεται το μέγεθος να είναι εντός ορίων
        document.getElementById("pasE").innerHTML="Το password πρέπει να έχει μήκος 4-10 και να περιέχει τουλάχιστον ένα αριθμό"
        return false;
    }else{
        var num=/\d///Ελέγχεται αν περιέχει αριθμό
        val=num.test(passwordU);
        if(!val){
            document.getElementById("pasE").innerHTML="Το password πρέπει να έχει μήκος 4-10 και να περιέχει τουλάχιστον ένα αριθμό"
            return false;
        }
    }
    
    if(!emailU.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){//Ελέγχεται αν ικανοποιεί το format εν΄ός email
       document.getElementById("emailE").innerHTML="Το email πρέπει να περιέχει @"
       return false;
    }
    
    return true;//Αν όλα είναι καλά επιστρέφεται true για να γίνει υποβολή της φόρμας
  }
function airport(){
    //Δέχεται όλες τις τιμές από τα αντίστοιχα πεδία
    var airA=document.getElementById("AirA").value;
    var airB=document.getElementById("AirB").value;
    
    //Ορίζει καινούργια μεταβλητή στην οποία θα περαστεί μήνυμα ερρορ
    document.getElementById("airErr").innerHTML = "";

    if(airA===airB){//Εάν τα αεροδρόμια είναι ίδια εμφανίζεται μήνυμα λάθους
        document.getElementById("airErr").innerHTML="Το αεροδρόμιο προορισμού δεν μπορεί να είναι ίδιο με το αεροδρόμιο αναχώρησης!"
        return false;
    }
    return true;//Αν όλα είναι καλά επιστρέφεται true για να γίνει υποβολή της φόρμας
}

function checkMoreCredentials(noPerson){
    
    var noerror=true;
    
    for (let i = 2; i <= noPerson; i++) {//Για όλους τους επιβάτες εκτός από τον πρώτο ελέγχονται τα στοιχεία
       
        //Δέχεται όλες τις τιμές από τα αντίστοιχα πεδία
       var nameU=document.getElementById("NAME"+i).value;
       var surnameU=document.getElementById("SURNAME"+i).value;
    
       //Ορίζει καινούργιες μεταβλήτες στις οποίες θα περαστούν τα μηνύματα ερρορ για κάθε επιβάτη
       document.getElementById("name"+i+"Er").innerHTML = "";
       document.getElementById("surname"+i+"Er").innerHTML = "";
    
       if (!nameU.match(/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/)){//Ελέγχεται αν έχει μόνο χαρακτήρες
           document.getElementById("name"+i+"Er").innerHTML="Μόνο χαρακτήρες"
           noerror=false;
       }

       if (!surnameU.match(/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/)){//Ελέγχεται αν έχει μόνο χαρακτήρες
           document.getElementById("surname"+i+"Er").innerHTML="Μόνο χαρακτήρες"
           noerror=false;
       }
    }
    return noerror;//Αν όλα είναι καλά επιστρέφεται true για να γίνει υποβολή της φόρμας
  }
  
function seats(){

    //Παίρνουμε την τιμή από το κρυφό input που περνάνε οι θέσεις που επιλέγει ο χρήστης
    const seatsSelect=document.getElementById('seatsSelect');
    //Αποκτούμε πρόσβαση στα κουμπιά με κλάση seat για να παίρνουμε τις τιμές των θέσεων του αεροπλάνου και να συνδεθούν με τον event listener
    const eventSeats=document.querySelectorAll('button.seat');
    //Παίρνουμε την τιμή του κουμπιού για την υποβολή έτσι ώστε να το απενεργοποιούμε αν ο χρήστης δεν ολοκλήρωσε τις απαιτούμενες επιλογές
    const button=document.getElementById('submitSeats');
    //Δημιουργούμε ένα πίνακα για να αποθηκεύονται οι θέσεις που έχει πατήσει ο χρήστης μέχρι στιγμής
    let selectedArray=[];
    //Παίρνω και τον αριθμό των θέσεων από την php μέσω html
    const noOfPassengers=parseInt(document.getElementById('noOfPassengers').value);
   
    //Για κάθε θέση
    eventSeats.forEach(seat=>
         seat.addEventListener('click',()=>{
             let seatName=seat.value;
             let foundSeat=false;

             //Ελέγχω αν το στοιχείο βρίσκεται ήδη μέσα για να το βγάλω για να μην είναι πατημένο πια
             for(let i=0;i<selectedArray.length;i++){
                //Όταν βρούμε το στοιχείο τα πηγαίνουμε όλα μία θέση αριστερά και έτσι διαγράφεται η τιμή αυτή
                if(selectedArray[i]===seatName){
                      for (let k=i;k<selectedArray.length-1;k++){
                        selectedArray[k]=selectedArray[k+1];
                      }
                    //Μειώνουμε το μήκος του πίνακα αφού η τελευταία θέση είναι πλέον κενή
                    selectedArray.length--;
                    foundSeat=true;
                    break;
                }
             }
                
                //Αλλιώς το πατάω
                if(!foundSeat){
                    //Μόνο αν δεν έχει συμπληρωθεί ο αριθμός των θέσεων μπαίνει
                    if(selectedArray.length<noOfPassengers){
                        //Βάζω το στοιχείο στο τέλος του πίνακα που κρατάμε τις θέσεις
                        selectedArray.push(seatName); 
                    }else{
                        alert('Ο αριθμός θέσεων για την κράτηση σας συμπληρώθηκε!');
                    }
                }
                //Στέλνω τα νέα δεδομένα στο input της html
                seatsSelect.value = selectedArray.join(',');

                if(selectedArray.length===noOfPassengers){
                    button.disabled=false;
                }else{
                    button.disabled=true;
                }
                // Ενημέρωση των εμφανιζόμενων επιλεγμένων θέσεων
                selectedSeatsText.textContent = selectedArray.length > 0
                    ? `Επιλεγμένες θέσεις: ${selectedArray.join(', ')}`
                    : 'Επιλεγμένες θέσεις: -';

                // Ενημερώνει το χρώμα για κάθε θέση ανάλογα αν είναι επιλεγμένη ή όχι
                eventSeats.forEach(btn => {
                    if (selectedArray.includes(btn.value)) {
                        btn.classList.add('selected');
                    } else {
                        btn.classList.remove('selected');
                    }
                });
         })
    )
    
}
