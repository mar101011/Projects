const express = require('express');
const router = express.Router();

const db = require('../database');

router.get('/getTechs',(req,res)=>{//Dexetai get aithma sth diadromh
   
    //Trabaei ta dedomena 
    const techsQuery = 'SELECT * FROM users WHERE Role = "Technician"';

    //Ektelesh tou query
    db.query(techsQuery,(err,results)=>{

        if (err){
            res.status(500).send(err.message);
            return;
        }
        res.json(results);
    })
    
})

module.exports = router;