const express = require('express');
const router = express.Router();

const db = require('../database');

router.put('/submitEditReq',(req,res)=>{
    
        
        const {id,Comments,Actions,Technician,Status,role}=req.body;

        if (role !== 'Admin' && role !== 'Technician') {
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        }   

       const query='UPDATE requests SET Comments=? ,Actions=?, Technician=?,Status=? WHERE req_id=?';

       db.query(query,[Comments,Actions,Technician,Status,id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Το αίτημα ενημερώθηκε με επιτυχία'})
       })
    
        
})

module.exports = router;