const express = require('express');
const router = express.Router();

const db = require('../database');

router.post('/addAnnouncement',(req,res)=>{// Dexetai post aithma sth diadromh
        
        const {Title,Message,role}=req.body;//Pairnei ta dedomena apo to swma tou aithmatos
        if (role !== 'Admin') {//Elegxei an einai o admin
       
              return res.status(403).send("Απαγορεύεται η πρόσβαση σε αυτή τη σελίδα!");
        }   

        if (!Title||!Message){//Elegxei an ta pedia einai gemata
              return res.status(400).json({ message: 'Παρακαλώ συμπληρώστε όλα τα πεδία!' });
        }
        //Query gia eiasagwgh dedomenwn sth bash
        const query = `
            INSERT INTO announcements (Title,Message,ann_date) VALUES (?, ?,NOW())
        `;

       //Ektelesh tou query
       db.query(query,[Title,Message],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Η ανακοίνωση καταγράφηκε με επιτυχία'})
       })
    
        
})

module.exports = router;