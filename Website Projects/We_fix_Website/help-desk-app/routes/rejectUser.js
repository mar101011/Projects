const express = require('express');
const router = express.Router();

const db = require('../database');

router.put('/rejectUser',(req,res)=>{
    const {id}=req.body;

       const query='UPDATE users SET Approved=-1,Role="Rejected" WHERE id=?';
       db.query(query,[id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
          res.json({
            message: 'Το αίτημα απορρίφθηκε με επιτυχία!',
            user: {

                id: id
            }
        });
       })


    })
    
module.exports = router;