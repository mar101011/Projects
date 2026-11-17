const express = require('express');
const router = express.Router();

const db = require('../database');

router.delete('/deleteUser',(req,res)=>{// Dexetai delete aithma sth diadromh
        
        const {id}=req.body; //Pairnei ta dedomena apo to swma tou aithmatos

         //Diagrafei thn epilegmenh kathgoria 
        const query = "DELETE FROM users WHERE id=?";

        //Ektelesh tou query
       db.query(query,[id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Ο χρήστης διαγράφηκε με επιτυχία'})
       })
    
        
})

module.exports = router;