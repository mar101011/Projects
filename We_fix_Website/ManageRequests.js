const storedDataStr = localStorage.getItem('currentUser');
const reqForm = document.getElementById('newReqForm');
const cancelReq = document.getElementById('cancelReqBtn');
const submitReq = document.getElementById('submitReqBtn');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr);

const userId = storedData.id;
const userName = storedData.username;
const role = storedData.role;

if (role !== "Admin" && role !== "Technician") {
    alert("Η πρόσβαση απορρίφθηκε");
    window.location.href = 'Announcement.php';
}

let currentEditId = null;

const requestDetails = document.getElementById('reqEditDetails');
window.addEventListener('DOMContentLoaded', async () => {
    loadTech();
    Requests();               
});

async function Requests() {
    requestDetails.innerHTML = '';

    try {
        const response = await fetch('http://localhost:3000/manageRequests');
        const reqData = await response.json();

        reqData.forEach(item => {

            let color=''

            if(item.Status==='Εκκρεμής'){
                color="open"
            }else if(item.Status==='Σε εξέλιξη'){
                color="progress"
            }else{
                color="closed"
            }

            let file = 'Κανένα αρχείο';
            if (item.File) {
                file = `<a href="http://localhost:3000/upload/${item.File}" target="_blank">Προβολή Αρχείου</a>`;
            }
            const date = new Date(item.Date).toLocaleDateString('el-GR');

            const row = `
                 <tr>

                    <td>
                       <div class="FormBtn">
                          <button id="BtnER${item.req_id}" type="button" class="buttons" style="margin-right: 10px;">Επεξεργασία</button>
                       </div>
                    </td>
                    <td>${item.req_id}</td>
                    <td><span class="status ${color}">${item.Status}</span></td>
                    <td>${date}</td>
                    <td>${item.Technician || '-'}</td>
                    <td>${item.Subject}</td>
                    <td>${item.Category}</td>
                    <td>${item.Description}</td>
                    <td>${file}</td>
                    <td>${item.user_id}</td>
                
                 </tr>
            `;

            requestDetails.insertAdjacentHTML('beforeend', row);

            const editRequestBtn = document.getElementById(`BtnER${item.req_id}`);
            editRequestBtn.onclick = () => {

                currentEditId = item.req_id;

                reqForm.style.display = 'block';
                document.getElementById('reqSubject').value = item.Subject;
                document.getElementById('reqCategory').value = item.Category;
                document.getElementById('reqDesc').value = item.Description;
                document.getElementById('reqDate').value = date;
                document.getElementById('reqComments').value = item.Comments;
                document.getElementById('reqActions').value = item.Actions;
                document.getElementById('reqTech').value = item.Technician || "";
                document.getElementById('reqStatus').value = item.Status;

                document.getElementById('reqSubject').disabled = true; //Den allazei
                document.getElementById('reqCategory').disabled = true; //Den allazei
                document.getElementById('reqDesc').disabled = true; //Den allazei
                document.getElementById('reqDate').disabled = true; //Den allazei
            };

        });

    } catch (error) {
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης αιτημάτων.');
    }
}

cancelReq.addEventListener('click', () => {
    reqForm.style.display = 'none';
});

submitReq.addEventListener('click', async (e) => {
    e.preventDefault();

    const Comments = document.getElementById('reqComments').value;
    const Actions = document.getElementById('reqActions').value;
    const Technician = document.getElementById('reqTech').value;
    const Status = document.getElementById('reqStatus').value;

    try {
        const response = await fetch('http://localhost:3000/submitEditReq', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: currentEditId,
                Comments,
                Actions,
                Technician,
                Status,
                role
            })
        });
        
        if (response.ok) {

            reqForm.style.display = 'none';
            document.getElementById('reqComments').value = '';
            document.getElementById('reqActions').value = '';
            document.getElementById('reqTech').value = '';
            document.getElementById('reqStatus').value = '';
            Requests();
            
        } else {
            alert("Σφάλμα!!");
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
    }
});

const techList = document.getElementById('reqTech');
async function loadTech() {
    try{
        
        const response = await fetch('http://localhost:3000/getTechs');

        const techs = await response.json();
        techList.innerHTML = '<option value="">Επιλέξτε...</option>';

        techs.forEach(item => {//Ena option gia kathe texniko wste na emfanistei h lista me tis epiloges toy xrhsth

            const option = document.createElement('option');

            const fullName = item.Name + " " + item.Surname; 

            option.value = fullName; 
            option.textContent = fullName; 
            techList.appendChild(option);

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης τεχνικών.');
    }
}