const storedDataStr = localStorage.getItem('currentUser');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr); //Kanei to string antikeimeno gia na xrhsimopoihsw ta pedia

const userId = storedData.id;
const userName = storedData.username;

const tableDetails = document.getElementById('reqData');

window.addEventListener('DOMContentLoaded',async()=> {

    tableDetails.innerHTML = '';

    try{
        
        const response = await fetch('http://localhost:3000/preview',{

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({

                user_id:userId,
                username:userName
            })

        }); //Mono tou xrhsth autou ta aithmata

        const reqData = await response.json();

        reqData.forEach(item => {//Dhmiourgoume tiw grammes toy pinaka

            let color=''

            if(item.Status==='Εκκρεμής'){
                color="open"
            }else if(item.Status==='Σε εξέλιξη'){
                color="progress"
            }

            let file = 'Κανένα αρχείο';
            if (item.File) {
                file = `<a href="http://localhost:3000/upload/${item.File}" target="_blank">Προβολή Αρχείου</a>`;
            }

            const row = `
                         <tr>
                            <td>${item.Subject}</td>
                            <td>${item.Category}</td>
                            <td>${item.Description}</td>
                            <td><span class="status ${color}">${item.Status}</span></td>
                            <td>${file}</td> 
                            <td>${new Date(item.Date).toLocaleDateString()}</td> 
                         </tr>
                        `;

            tableDetails.innerHTML += row;
            

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης μη ολοκληρωμένων αιτήσεων.');
    }

})