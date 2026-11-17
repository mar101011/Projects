const storedDataStr = localStorage.getItem('currentUser');
const addAnnouncement= document.getElementById('newAnn');

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

const user = document.getElementById('userReq');

window.addEventListener('DOMContentLoaded',async()=> {

    user.innerHTML = '';

    try{
        
        const response = await fetch('http://localhost:3000/manageRegister', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                role
            })
        });

        const userData = await response.json();

        userData.forEach(item => {//Dhmiourgoume tis grammes tou pinaka

            const details = `
                         <div class="announceLayout" style="margin-bottom: 30px;">

                           <h5>Χρήστης: ${item.Username} <small class="fade">Id ${item.id}</small></h5>
                           <div class="userLayout">
                                <div>
                                    <p><strong>Όνομα: </strong>${item.Name}</p>
                                    <p><strong>Επώνυμο:</strong> ${item.Surname}</p>
                                    <p><strong>Χώρα:</strong> ${item.Country}</p>
                                </div>
                                <div style="margin-top:3px">
                                    <p><strong>Πόλη: </strong>${item.Town}</p>
                                    <p><strong>Διεύθυνση: </strong>${item.Address}</p>
                                    <p><strong>Email: </strong>${item.Email}</p>
                                </div>

                            <select id="role-${item.id}" class="inputs dropdown">
                                    <option value="User">Απλός Χρήστης</option>
                                    <option value="Technician">Τεχνικός</option>
                                    <option value="Admin">Διαχειριστής</option>
                            </select>

                            </div>
                            <div class="FormBtn">
                               <button id="BtnA${item.id}" type="button" class="buttons" style="margin-left:400px; margin-top:30px">Έγκριση</button>
                               <button id="BtnR${item.id}" style="margin-top:30px" type="button" class="cancel">Απόρριψη</button>
            
                            </div>
                        
                         </div>
                        `;

            user.insertAdjacentHTML('beforeend', details); //Giati an ebaza to allo tha diagrafontan ta stoixeia kai tha empainan apo thn arxh 
                                                           //Ara mono ta teleutaia koumpia tha leitourgousan 
            const approveBtn = document.getElementById(`BtnA${item.id}`);
            const rejectBtn = document.getElementById(`BtnR${item.id}`);

            approveBtn.addEventListener('click', async (event) => {
                const userRole = document.getElementById(`role-${item.id}`).value;

                if (!userRole) {
                    alert("Παρακαλώ επιλέξτε ρόλο πριν την έγκριση!");
                    return;
                }

                if (!confirm(`Θέλετε να εγκρίνετε τον χρήστη ως ${userRole};`)) return;
                
                try{
        
                    const response = await fetch('http://localhost:3000/approveUser', {

                          method: 'PUT',
                          headers: {
                                'Content-Type': 'application/json'
                          },
                          body: JSON.stringify({
                          id:item.id,role:userRole
                    })
                    });
                    if (response.ok) {
                    
                        event.target.closest('.announceLayout').remove();
                    } else {
                        alert("Σφάλμα!!");
                    }

                }catch (error){
        
                    console.error('Error:', error);
                    alert('Αποτυχία.');
                }
                
                
            });
            rejectBtn.addEventListener('click', async (event) => {
                if (!confirm(`Θέλετε να απορρίψετε τον χρήστη ${item.Username};`)) return;
                try{
        
                    const response = await fetch('http://localhost:3000/rejectUser', {

                          method: 'PUT',
                          headers: {
                                'Content-Type': 'application/json'
                          },
                          body: JSON.stringify({
                          id:item.id
                    })
                    });
                    if (response.ok) {
                    
                        event.target.closest('.announceLayout').remove();
                    } else {
                        alert("Σφάλμα!!");
                    }

                }catch (error){
        
                    console.error('Error:', error);
                    alert('Αποτυχία.');
                }

            });
        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης αιτημάτων για εγγραφή.');
    }

})


