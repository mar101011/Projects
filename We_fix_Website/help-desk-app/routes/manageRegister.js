const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/manageRegister',(req,res)=>{//Dexetai post aithma sth diadromh

        const {role}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
        if (role !== 'Admin') {//Elegxei an einai o admin
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        } 
        
        //Trabaei ta dedomena 
        const queryReq='SELECT * FROM users WHERE Approved=0';

        //Ektelesh tou query
        db.query(queryReq,(err,results)=>{
             if (err){
                    res.status(500).send(err.message);
                    return;
                 }
            res.json(results);
        })
        
})

module.exports = router;