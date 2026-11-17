const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/login',(req,res)=>{ // Dexetai post aithma sth diadromh

    const {Username,Password}=req.body;// Pairnei ta dedomena apo to swma tou aithmatos

    if (!Username||!Password){// Elegxei an ta pedia einai sumplhrwmena
        return res.status(400).json({ message: 'Παρακαλώ συμπληρώστε όλα τα πεδία!' });
    }

    // Query gia anazhthsh xrhsth sth bash me bash to onoma kai ton kwdiko
    const query='SELECT * FROM users WHERE Username=? AND Password=?'

    // Ektelesh tou query
    db.query(query,[Username,Password],(err,results)=>{
        if (err){
            res.status(500).send(err.message);
            return;
        }

        // Elegxei an brethike xrhsths sth bash
        if(results.length>0){
          
            const user = results[0];

            if (user.Approved===0){
            return res.status(400).json({ message: 'Ο διαχειριστής δεν έχει δεχτεί ακόμα το αίτημα σας' });
           }else if(user.Approved===-1){
            return res.status(400).json({ message: 'Ο διαχειριστής απέρριψε το αίτημα σας για εγγραφή' });
           }else{
            // Stelnei mhnyma epityxias kai ta stoixeia tou xrhsth
              res.json({message:'Επιτυχής σύνδεση στο σύστημα',
                        user:{
                             username:user.Username,
                             role:user.Role,
                             id:user.id

                        }
              })
           }
   
        }else{
            return res.status(400).json({ message: 'Λάθος όνομα χρήστη ή κωδικός πρόσβασης' });
   
        }
    })
})

module.exports = router;