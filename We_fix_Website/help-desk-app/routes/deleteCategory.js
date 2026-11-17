const express = require('express');
const router = express.Router();

const db = require('../database');

router.delete('/deleteCategory',(req,res)=>{// Dexetai delete aithma sth diadromh
        
        const {cat_id}=req.body; //Pairnei ta dedomena apo to swma tou aithmatos

        //Diagrafei thn epilegmenh kathgoria 
        const query = "DELETE FROM category WHERE cat_id=?";

        //Ektelesh tou query
       db.query(query,[cat_id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Η κατηγορία διαγράφηκε με επιτυχία'})
       })
    
        
})

module.exports = router;