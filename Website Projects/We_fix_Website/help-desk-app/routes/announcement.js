const express = require('express');
const router = express.Router();

const db = require('../database');

router.get('/announcement',(req,res)=>{// Dexetai get aithma sth diadromh

               //Trabaei tajinomhmena ta dedomena twn anakoikwsewn
               const queryReq='SELECT * FROM announcements ORDER BY ann_date DESC';

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