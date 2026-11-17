const express = require('express');
const router = express.Router();

const db = require('../database');

router.put('/editUser',(req,res)=>{// Dexetai put aithma sth diadromh

        const {id,Name,Surname,Country,Town,Address,Email,Username,Role,role}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
        if (role !== 'Admin') {//Elegxei an einai o admin
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        }   
        //Query gia enhmerwsh dedomenwn sth bash
       const query='UPDATE users SET Name=? ,Surname=?,Country=?,Town=?,Address=?,Email=?,Username=?,Role=? WHERE id=?';

       //Ektelesh tou query
       db.query(query,[Name,Surname,Country,Town,Address,Email,Username,Role,id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Ο χρήστης ενημερώθηκε με επιτυχία'})
       })
    
        
})

module.exports = router;