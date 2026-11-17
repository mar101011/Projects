const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/history',(req,res)=>{//Dexetai post aithma sth diadromh

    const {user_id,username}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
    const query='SELECT * FROM users WHERE id=? AND Username=?';//Trabaei ta dedomena 

    db.query(query,[user_id,username],(err,results)=>{//Ektelesh tou query

            if (err){
                res.status(500).send(err.message);
                return;
           }

           if(results.length>0){//An uparxoun aithmata gia auton ton xrhsth
 
               //Trabaei ta dedomena 
               const queryReq='SELECT * FROM requests WHERE user_id=? AND Status="Ολοκληρωμένη"';

               //Ektelesh tou query
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