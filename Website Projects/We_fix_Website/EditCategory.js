const storedDataStr = localStorage.getItem('currentUser');
const addCategory = document.getElementById('newCategory');
const catForm = document.getElementById('newCatForm');
const cancelCatAddBtn = document.getElementById('cancelCatAddBtn');
const submitBtn = document.getElementById('submitCatBtn');

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

const categoryDetails = document.getElementById('categoryEdit');

async function Categories() {
    categoryDetails.innerHTML = '';

    try {
        const response = await fetch('http://localhost:3000/category');
        const catData = await response.json();

        catData.forEach(item => {
            let color = '';
            if (item.Priority === 'Υψηλή') {
                color = "open";
            } else if (item.Priority === 'Μέτρια') {
                color = "progress";
            } else {
                color = "closed";
            }

            const row = `
                 <tr>
                    <td>${item.name}</td>
                    <td><span class="status ${color}">${item.Priority}</span></td>
                    <td>
                       <div class="FormBtn">
                          <button id="BtnE${item.cat_id}" type="button" class="buttons" style="margin-right: 10px;">Επεξεργασία</button>
                          <button id="BtnD${item.cat_id}" type="button" class="cancel">Διαγραφή</button>
                       </div>
                    </td>
                 </tr>
            `;

            categoryDetails.insertAdjacentHTML('beforeend', row);

            const editBtn = document.getElementById(`BtnE${item.cat_id}`);
            editBtn.onclick = () => {

                catForm.style.display = 'block';
                addCategory.style.display = 'none';
                document.getElementById('catName').value = item.name;
                document.getElementById('catPriority').value = item.Priority;

                cancelCatAddBtn.addEventListener('click', () => {
                    catForm.style.display = 'none';
                    addCategory.style.display = 'block';
                });

                submitBtn.onclick = async (e) => {
                    e.preventDefault();
                    
                    const Name = document.getElementById('catName').value;
                    const Priority = document.getElementById('catPriority').value;

                    try {
                        const response = await fetch('http://localhost:3000/editcat', {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                cat_id: item.cat_id,
                                Name,
                                Priority,
                                role
                            })
                        });
                        
                       
                        const data = await response.json();

                        if (response.ok) {
                            
                            catForm.style.display = 'none';
                            addCategory.style.display = 'block';
                            document.getElementById('catName').value = '';
                            Categories();
                            alert(data.message); 

                        } else {
                            alert("Σφάλμα!!");
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
                    }
                };
            };

            const deleteBtn = document.getElementById(`BtnD${item.cat_id}`);
            deleteBtn.addEventListener('click', async (event) => {
                if (!confirm(`Θέλετε να διαγράψετε την κατηγορία '${item.name}';`)) return;
                try {
                    const response = await fetch('http://localhost:3000/deleteCategory', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            cat_id: item.cat_id
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        Categories();
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
        alert('Αποτυχία φόρτωσης κατηγοριών.');
    }
}

window.addEventListener('DOMContentLoaded', Categories);


addCategory.onclick = () => {

    catForm.style.display = 'block';
    addCategory.style.display = 'none';

    submitBtn.onclick = async (e) => {
        e.preventDefault();
        
        const Name = document.getElementById('catName').value;
        const Priority = document.getElementById('catPriority').value;

        try {
            const response = await fetch('http://localhost:3000/addNewCategory', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Name,
                    Priority,
                    role
                })
            });

            const data = await response.json();

            if (response.ok) {

                alert(data.message);
                catForm.style.display = 'none';
                addCategory.style.display = 'block';
                document.getElementById('catName').value = '';
                Categories();

            } else {
                alert("Σφάλμα: " + data.message);
            }

        } catch (error) {

            console.error('Error:', error);
            alert('Αποτυχία σύνδεσης με τον διακομιστή.');
        }
    };
}; 

cancelCatAddBtn.addEventListener('click', () => {

    catForm.style.display = 'none';
    addCategory.style.display = 'block';

});