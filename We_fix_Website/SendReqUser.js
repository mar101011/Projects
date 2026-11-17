const sendReqForm=document.getElementById('sendRequest'); //Briskoume tiw times apo ta pedia ths html

const categoryList = document.getElementById('category');

//Sundesh API gia tis kathgories
window.addEventListener('DOMContentLoaded',async()=> {

    try{
        
        const response = await fetch('http://localhost:3000/category'); //Kaloume to api gia na emfanistoun oi kathgories
        const categories = await response.json();

        categories.forEach(item => {//Ena option gia kathe kathgoria wste na emfanistei h lista me tis epiloges toy xrhsth

            const option = document.createElement('option');

            option.value = item.name; //Mpainei sto value gia na emfanizetai ston xrhsth
            option.textContent = item.name;  //H timh poy mpainei sth bash
            categoryList.appendChild(option);

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης κατηγοριών.');
    }

})

const storedDataStr = localStorage.getItem('currentUser');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr); //Kanei to string antikeimeno gia na xrhsimopoihsw ta pedia

const userId = storedData.id;

sendReqForm.addEventListener('submit', async (event) => {

    // Stamataei thn selida apo to na kanei reload gia na mhn epireastei to fetch
    event.preventDefault();

    // Δημιουργούμε το fData για να μπορούμε να στείλουμε το αρχείο
    const fData = new FormData();

    // Pairnw ola ta dedomena apo to html
    const Subject = document.getElementById('subject').value;
    const Description = document.getElementById('description').value;
    const Category = document.getElementById('category').value;
    const fileInput = document.getElementById('files'); // Το στοιχείο του αρχείου

    // Προσθέτουμε τα δεδομένα στο fData (το "πακέτο" που θα φύγει)
    fData.append('Subject', Subject);
    fData.append('Description', Description);
    fData.append('Category', Category);
    fData.append('user_id', userId);

    // Ελέγχουμε αν ο χρήστης επέλεξε αρχείο
    if (fileInput.files.length > 0) {
        // Προσθέτουμε το αρχείο στο fData με το όνομα 'File'
        fData.append('File', fileInput.files[0]); 
    }

    try {
        const response = await fetch('http://localhost:3000/sendRequest', {

            method: 'POST',
            // Giati alliws tha stelname mono to onoma tou arxeiou kai oxi to periexomeno
            // ΣΗΜΑΝΤΙΚΟ: Δεν βάζουμε headers εδώ, ο browser τα φτιάχνει μόνος του για το FormData
            body: fData 
        });

        const data = await response.json();

        if (response.ok) {

            alert(data.message); 
            window.location.href = 'PreviewRequest.php';

        } else {
            alert("Σφάλμα: " + data.message);
        }

    } catch (error) {
        
        console.error('Error:', error);
        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
    }

});