const formLogin=document.getElementById('formCreLogin');

formLogin.addEventListener('submit', async (event) => {

    //Stamataei thn selida apo to na kanei reload gia na mhn epireastei to fetch
    event.preventDefault();

    //Pairnw ola ta dedomena apo to html

    const Username = document.getElementById('user').value;
    const Password = document.getElementById('pass').value;

    try{
        
        const response = await fetch('http://localhost:3000/login', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                Username, Password
            })
        });

        const data = await response.json();

        if (response.ok) {

            localStorage.setItem('currentUser', JSON.stringify(data.user));
            alert(data.message); 
            window.location.href = 'Announcement.php';

        } else {
            alert("Σφάλμα: " + data.message);
        }

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
    }
});

