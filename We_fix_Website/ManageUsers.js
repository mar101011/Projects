const storedDataStr = localStorage.getItem('currentUser');
const addUser = document.getElementById('newUser');
const userForm = document.getElementById('newUserForm');
const cancelUser = document.getElementById('cancelUserBtn');
const submitUser = document.getElementById('submitUserBtn');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr);

const userId = storedData.id;
const userName = storedData.username;
const role = storedData.role;

if (role !== "Admin") {
    alert("Η πρόσβαση απορρίφθηκε");
    window.location.href = 'Announcement.php';
}

const userDetails = document.getElementById('userEditDetails');
window.addEventListener('DOMContentLoaded', async () => {
    await loadCountries(); 
    Users();               
});

async function Users() {
    userDetails.innerHTML = '';

    try {
        const response = await fetch('http://localhost:3000/manageUsers');
        const userData = await response.json();

        userData.forEach(item => {
            const row = `
                 <tr>

                    <td>
                       <div class="FormBtn">
                          <button id="BtnEU${item.id}" type="button" class="buttons" style="margin-right: 10px;">Επεξεργασία</button>
                          <button id="BtnDU${item.id}" type="button" class="cancel">Διαγραφή</button>
                       </div>
                    </td>
                    <td>${item.id}</td>
                    <td>${item.Name}</td>
                    <td>${item.Surname}</td>
                    <td>${item.Country}</td>
                    <td>${item.Town}</td>
                    <td>${item.Address}</td>
                    <td>${item.Email}</td>
                    <td>${item.Username}</td>
                    <td>${item.Role}</td>
                 </tr>
            `;

            userDetails.insertAdjacentHTML('beforeend', row);

            const editUserBtn = document.getElementById(`BtnEU${item.id}`);
            editUserBtn.onclick = async () => { 

                userForm.style.display = 'block';
                addUser.style.display = 'none';
                document.getElementById('userName').value = item.Name;
                document.getElementById('userSurname').value = item.Surname;
                document.getElementById('userCountry').value = item.Country;
                
                await Towns(item.Country); 
                
                document.getElementById('userTown').value = item.Town;
                document.getElementById('userAddress').value = item.Address;
                document.getElementById('userEmail').value = item.Email;
                document.getElementById('userUsername').value = item.Username;
                document.getElementById('userUsername').disabled = true; //Den allazei to username
                document.getElementById('userRole').value = item.Role;
                document.getElementById('passDetails').style.display = 'none';  //Den emfanizetai katholou to password
                

                cancelUser.addEventListener('click', () => {
                    userForm.style.display = 'none';
                    addUser.style.display = 'block';
                });

                submitUser.onclick = async (e) => {
                    e.preventDefault();
                    
                    
                    const Name = document.getElementById('userName').value;
                    const Surname = document.getElementById('userSurname').value;
                    const Country = document.getElementById('userCountry').value;
                    const Town = document.getElementById('userTown').value;
                    const Address = document.getElementById('userAddress').value;
                    const Email = document.getElementById('userEmail').value;
                    const Username = document.getElementById('userUsername').value;
                    const Role = document.getElementById('userRole').value;

                    try {
                        const response = await fetch('http://localhost:3000/editUser', {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: item.id,
                                Name,
                                Surname,
                                Country,
                                Town,
                                Address,
                                Email,
                                Username,
                                Role,
                                role
                            })
                        });
                        
                        if (response.ok) {

                            userForm.style.display = 'none';
                            addUser.style.display = 'block';
                            document.getElementById('userName').value = '';
                            document.getElementById('userSurname').value = '';
                            document.getElementById('userAddress').value = '';
                            document.getElementById('userEmail').value = '';
                            document.getElementById('userUsername').value = '';
                            Users();
                            
                        } else {
                            alert("Σφάλμα!!");
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
                    }
                };
            };

            const deleteBtn = document.getElementById(`BtnDU${item.id}`);
            deleteBtn.addEventListener('click', async (event) => {
                if (!confirm(`Θέλετε να διαγράψετε τον χρήστη '${item.Name}';`)) return;
                try {
                    const response = await fetch('http://localhost:3000/deleteUser', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: item.id
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        Users();
                    } else {
                        alert("Σφάλμα: " + data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Αποτυχία σύνδεσης με τον διακομιστή.');
                }
            });
        });

    } catch (error) {
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης χρηστών.');
    }
}


addUser.onclick = () => {
    userForm.style.display = 'block';
    addUser.style.display = 'none';
    document.getElementById('userName').value = '';
    document.getElementById('userSurname').value = '';
    document.getElementById('userAddress').value = '';
    document.getElementById('userEmail').value = '';
    document.getElementById('userUsername').value = '';
    document.getElementById('userCountry').value = '';
    document.getElementById('userTown').innerHTML = '<option value="">Επιλέξτε...</option>';
    document.getElementById('userUsername').disabled = false; //Mporei na epejergastei to pedio kai na prosthesei username 
    document.getElementById('passDetails').style.display = 'block'; //Emfanizetai pedio gia na prosthesei password
    
    submitUser.onclick = async (e) => {
        e.preventDefault();
        
        const Name = document.getElementById('userName').value;
        const Surname = document.getElementById('userSurname').value;
        const Country = document.getElementById('userCountry').value;
        const Town = document.getElementById('userTown').value;
        const Address = document.getElementById('userAddress').value;
        const Email = document.getElementById('userEmail').value;
        const Username = document.getElementById('userUsername').value;
        const Password = document.getElementById('userPassword').value;
        const Role = document.getElementById('userRole').value;

        try {
            const response = await fetch('http://localhost:3000/addUser', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Name,
                    Surname,
                    Country,
                    Town,
                    Address,
                    Email,
                    Username,
                    Password,
                    Role,
                    role
                })
            });

            const data = await response.json();

            if (response.ok) {
                alert(data.message);
                userForm.style.display = 'none';
                addUser.style.display = 'block';
                document.getElementById('userName').value = '';
                document.getElementById('userSurname').value = '';
                document.getElementById('userAddress').value = '';
                document.getElementById('userEmail').value = '';
                document.getElementById('userUsername').value = '';
                document.getElementById('userPassword').value = '';
                Users();

            } else {
                alert("Σφάλμα: " + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Αποτυχία σύνδεσης με τον διακομιστή.');
        }
    };
};

cancelUser.addEventListener('click', () => {
    userForm.style.display = 'none';
    addUser.style.display = 'block';
});

const countryList = document.getElementById('userCountry');
async function loadCountries() {
    try{
        
        const response = await fetch('https://countriesnow.space/api/v0.1/countries');
        const jdata = await response.json();

        const countries=jdata.data;

       countries.forEach(item => {//Ena option gia kathe xwra wste na emfanistei h lista me tis epiloges toy xrhsth

            const option = document.createElement('option');

            option.value = item.country; //Mpainei sto value gia na emfanizetai ston xrhsth
            option.textContent = item.country;  //H timh poy mpainei sth bash
            countryList.appendChild(option);

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης χωρών.');
    }
}

const townList = document.getElementById('userTown');
async function Towns(chosenCountry) { 

    try{
        
        while (townList.options.length > 0) { //Lathe fora poy epilegetai xwra diagrafontai oi proghoumenes
                           
            townList.remove(0);
        }        
    
        const response = await fetch('https://countriesnow.space/api/v0.1/countries/cities', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                country:chosenCountry 
            })
        });

        const jdata = await response.json();

        const cityData=jdata.data;

       cityData.forEach(city => {//Ena option gia kathe polh ths xwras wste na emfanistei h lista me tis epiloges toy xrhsth

            const option2 = document.createElement('option');

            option2.value = city; //Mpainei sto value gia na emfanizetai ston xrhsth
            option2.textContent = city;  //H timh poy mpainei sth bash
            townList.appendChild(option2);

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης πόλεων.');
    }

}

countryList.addEventListener('change', function() {
    Towns(this.value); 
});