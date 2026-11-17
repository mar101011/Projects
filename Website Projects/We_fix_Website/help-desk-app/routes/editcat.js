const express = require('express');
const router = express.Router();

const db = require('../database');

router.put('/editcat',(req,res)=>{// Dexetai put aithma sth diadromh
    
        
        const {cat_id,Name,Priority,role}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
        if (role !== 'Admin') {//Elegxei an einai o admin
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        }   

        //Query gia enhmerwsh dedomenwn sth bash
       const query='UPDATE category SET name=? ,Priority=? WHERE cat_id=?';

       //Ektelesh tou query
       db.query(query,[Name,Priority,cat_id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Η κατηγορία ενημερώθηκε με επιτυχία'})
       })
    
        
})

module.exports = router;