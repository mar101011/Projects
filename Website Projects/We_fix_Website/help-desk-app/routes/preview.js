const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/preview',(req,res)=>{// Dexetai post aithma sth diadromh

    const {user_id,username}=req.body;// Pairnei ta dedomena apo to swma tou aithmatos
    const query='SELECT * FROM users WHERE id=? AND Username=?';// Query gia na epibebaiwsei oti o xrhsths yparxei sth bash

    db.query(query,[user_id,username],(err,results)=>{

            if (err){
                res.status(500).send(err.message);
                return;
           }

           // Elegxei an brethike o xrhsths
           if(results.length>0){
                // Query gia na vrei ta energa aithmata 
               const queryReq='SELECT * FROM requests WHERE user_id=? AND Status!="Ολοκληρωμένη"';

               // Ektelesh tou deuterou query gia ta aithmata
               db.query(queryReq,[user_id],(err,results2)=>{
                  if (err){
                       res.status(500).send(err.message);
                       return;
                  }
                res.json(results2);
           })
        }else{

               return res.status(400).json({ message: 'Μη διαθέσιμες αιτήσεις για αυτόν τον χρήστη' });
       }
    })
})


module.exports = router;