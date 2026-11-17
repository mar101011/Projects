const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/addUser',(req,res)=>{// Dexetai post aithma sth diadromh

        const {Name,Surname,Country,Town,Address,Email,Username,Password,Role,role}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
        if (role !== 'Admin') {//Elegxei an einai o admin
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        }   

        if (!Name||!Surname||!Country||!Town||!Address||!Email||!Username||!Password||!Role){//Elegxei an ta pedia einai gemata
              return res.status(400).json({ message: 'Παρακαλώ συμπληρώστε όλα τα πεδία!' });
        }
       //Query gia eiasagwgh dedomenwn sth bash
        const query = `
            INSERT INTO users (Name,Surname,Country,Town,Address,Email,Username,Password,Approved,Role) VALUES (?,?,?,?,?,?,?,?,1,?)
        `;
       //Ektelesh tou query
       db.query(query,[Name,Surname,Country,Town,Address,Email,Username,Password,Role],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Ο χρήστης προστέθηκε με επιτυχία'})
       })
    
        
})

module.exports = router;