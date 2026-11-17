const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/register',(req,res)=>{// Dexetai POST aithma gia nea eggrafh
    const {Name,Surname,Country,Town,Address,Email,Username,Password}=req.body;

    // Elegxei an ola ta pedia einai sumplhrwmena
    if (!Name||!Surname||!Country||!Town||!Address||!Email||!Username||!Password){
        return res.status(400).json({ message: 'Παρακαλώ συμπληρώστε όλα τα πεδία!' });
    }

    //Elegxei an exoun to swsto format
    if(Password.length<6){
        return res.status(400).json({ message: 'Ο κωδικός πρέπει να έχει τουλάχιστον 6 χαρακτήρες' });
    }

     if(!Email.includes('@')){
        return res.status(400).json({ message: 'To email πρέπει να περιέχει @' });
    }

    if (!Name.match(/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/)){//Ελέγχεται αν έχει μόνο χαρακτήρες
       return res.status(400).json({ message: 'Το πεδίο πρέπει να περιέχει μόνο γράμματα' });
    }

     if (!Surname.match(/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ\- ]+$/)){//Ελέγχεται αν έχει μόνο χαρακτήρες
       return res.status(400).json({ message: 'Το πεδίο πρέπει να περιέχει μόνο γράμματα' });
    }

    //Elegxos gia monadiko Username
    const usersQuery = 'SELECT * FROM users WHERE Username = ?';

    db.query(usersQuery,[Username,],(err,results)=>{

        if (err){
            res.status(500).send(err.message);
            return;
        }

        if(results.length>0){
          
            return res.status(400).json({ message: 'Μη διαθέσιμο όνομα χρήστη' });
           
        }else{
            
        //Eisagwgh Neou Xrhsth
        const query = `
            INSERT INTO users 
            (Name, Surname, Country, Town, Address, Email, Username, Password, Approved, Role) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 'Pending')
       `;

       db.query(query,[Name,Surname,Country,Town,Address,Email,Username,Password],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Το αίτημα εγγραφής καταγράφηκε με επιτυχία'})
       })
    }

    })
    
})

module.exports = router;