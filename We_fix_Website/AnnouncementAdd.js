const storedDataStr = localStorage.getItem('currentUser');
const announcement= document.getElementById('cancelAnn');
const newAnnouncement= document.getElementById('formAnn');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr); //Kanei to string antikeimeno gia na xrhsimopoihsw ta pedia

const userId = storedData.id;
const userName = storedData.username;
const role= storedData.role;

if(role!=="Admin"){
    alert("Η πρόσβαση απορρίφθηκε");
    window.location.href = 'Announcement.php';
}

announcement.addEventListener('click', async (event) => {

     window.location.href ="Announcement.php"

});

newAnnouncement.addEventListener('submit', async (event) => {

    //Stamataei thn selida apo to na kanei reload gia na mhn epireastei to fetch
    event.preventDefault();

    //Pairnw ola ta dedomena apo to html
    const Title = document.getElementById('title').value;
    const Message = quill.root.innerHTML;

    try{
        
        const response = await fetch('http://localhost:3000/addAnnouncement', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                Title,Message,role
            })
        });

        const data = await response.json();

        if (response.ok) {

            alert(data.message); 
            window.location.href ="Announcement.php"

        } else {
            alert("Σφάλμα: " + data.message);
        }

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
    }


});


const quill = new Quill('#editor', {
    theme: 'snow' 
});