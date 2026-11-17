document.addEventListener('DOMContentLoaded', () => {

       const storedDataStr = localStorage.getItem('currentUser');
    
        if (storedDataStr) {
            const storedData = JSON.parse(storedDataStr);
            const role = storedData.role; 

            const menuUser = document.querySelectorAll('.usersMenu,.usersfMenu'); //Emfanizei to swsto menu kai ston header kai ston footer
            const menuAdmin = document.querySelectorAll('.adminMenu,.adminfMenu');
            const menuTech = document.querySelectorAll('.techMenu,.techfMenu');

            if (role === 'Admin') {
                menuAdmin.forEach(adminItem => {
                
                   adminItem.style.display = 'block';
                
                });

                menuUser.forEach(userItem => {
                
                    userItem.style.display = 'none';
                
                });

                menuTech.forEach(techItem => {
                
                   techItem.style.display = 'none';
                
                });
            
            } else if(role === 'Technician'){

                menuTech.forEach(techItem => {
                
                   techItem.style.display = 'block';
                
                });

                menuAdmin.forEach(adminItem => {
                
                    adminItem.style.display = 'none';
                
                });

                menuUser.forEach(userItem => {
                
                    userItem.style.display = 'none';
                
                });


            }else {
                menuAdmin.forEach(adminItem => {
                
                   adminItem.style.display = 'none';
                
                });

                menuTech.forEach(techItem => {
                
                   techItem.style.display = 'none';
                
                });

                menuUser.forEach(userItem => {
                
                   userItem.style.display = 'block';
                
               });
           }
    }

    
});