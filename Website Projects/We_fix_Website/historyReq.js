const storedDataStr = localStorage.getItem('currentUser');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr); //Kanei to string antikeimeno gia na xrhsimopoihsw ta pedia

const userId = storedData.id;
const userName = storedData.username;

const tablehistDetails = document.getElementById('historyData');

window.addEventListener('DOMContentLoaded',async()=> {

    tablehistDetails.innerHTML = '';

    try{
        
        const response = await fetch('http://localhost:3000/history',{

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({

                user_id:userId,
                username:userName
            })

        }); //Mono tou xrhsth autou ta aithmata

        const historyData = await response.json();

        historyData.forEach(item => {//Dhmiourgoume tiw grammes toy pinaka
            const row = `
                         <tr>
                            <td>${item.Subject}</td>
                            <td>${item.Category}</td>
                            <td>${item.Description}</td>
                            <td><span class="status closed">${item.Status}</span></td>
                            <td>${item.File ? item.File : 'Κανένα αρχείο'}</td> 
                            <td>${new Date(item.Date).toLocaleDateString()}</td> 
                         </tr>
                        `;

            tablehistDetails.innerHTML += row;
            

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης μη ολοκληρωμένων αιτήσεων.');
    }

})