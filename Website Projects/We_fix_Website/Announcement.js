const storedDataStr = localStorage.getItem('currentUser');
const addAnnouncement= document.getElementById('newAnn');

if (!storedDataStr) {
    alert("Πρέπει να συνδεθείτε πρώτα!");
    window.location.href = 'Login.php';
}

const storedData = JSON.parse(storedDataStr); //Kanei to string antikeimeno gia na xrhsimopoihsw ta pedia

const userId = storedData.id;
const userName = storedData.username;

const announce = document.getElementById('announcement');

window.addEventListener('DOMContentLoaded',async()=> {

    announce.innerHTML = '';

    try{
        
        const response = await fetch('http://localhost:3000/announcement')

        const announceData = await response.json();

        announceData.forEach(item => {//Dhmiourgoume tis grammes tou pinaka

            const details = `
                         <div class="announceLayout" style="margin-bottom: 30px;">
                            <h5>${item.Title}</h5>
                            <p>${item.Message}</p>
                            <small>${new Date(item.ann_date).toLocaleDateString()}</small> 
                         </div>
                        `;

            announce.innerHTML += details;   

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης ανακοινώσεων.');
    }

})


addAnnouncement.addEventListener('click', async (event) => {

     window.location.href ="AnnouncementAdd.php"

});

