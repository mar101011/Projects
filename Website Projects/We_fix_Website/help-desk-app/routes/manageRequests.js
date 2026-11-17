const express = require('express');
const router = express.Router();

const db = require('../database');

router.get('/manageRequests',(req,res)=>{

        
        const queryReq='SELECT * FROM requests ORDER BY Date DESC';

        db.query(queryReq,(err,results)=>{
             if (err){
                    res.status(500).send(err.message);
                    return;
                 }
            res.json(results);
        })
        
})

module.exports = router;