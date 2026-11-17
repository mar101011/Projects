document.addEventListener('DOMContentLoaded', () => {
    
    const storedDataStr = localStorage.getItem('currentUser');
    
    if (storedDataStr) {
        const storedData = JSON.parse(storedDataStr);
        const role = storedData.role; 

        const newA = document.getElementById('newAnn');

        if (role === 'Admin') {
            newA.style.display = 'block';
        } else {
            newA.style.display = 'none'; 
        }
    }
});