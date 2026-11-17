const express = require('express');
const router = express.Router();

const db = require('../database');

router.get('/manageUsers',(req,res)=>{//Dexetai get aithma sth diadromh
    
    //Trabaei ta dedomena 
    const query='SELECT * FROM users WHERE Approved=1';

    //Ektelesh tou query
    db.query(query,(err,results)=>{
        if (err){
            res.status(500).send(err.message);
            return;
        }
        res.json(results);
    })
})

module.exports = router;