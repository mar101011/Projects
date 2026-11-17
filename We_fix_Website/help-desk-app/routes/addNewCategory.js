const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/addNewCategory',(req,res)=>{// Dexetai post aithma sth diadromh
        
        const {Name,Priority,role}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
        if (role !== 'Admin') {//Elegxei an einai o admin
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        }   

        if (!Name||!Priority){//Elegxei an ta pedia einai gemata
              return res.status(400).json({ message: 'Παρακαλώ συμπληρώστε όλα τα πεδία!' });
        }
        //Query gia eiasagwgh dedomenwn sth bash
        const query = `
            INSERT INTO category (name,Priority) VALUES (?, ?)
        `;
        //Ektelesh tou query
       db.query(query,[Name,Priority],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Η κατηγορία προστέθηκε με επιτυχία'})
       })
    
        
})

module.exports = router;