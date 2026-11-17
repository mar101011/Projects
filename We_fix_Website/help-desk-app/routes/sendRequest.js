const express = require('express');
const router = express.Router();

const db = require('../database');
const multer = require('multer');
const path = require('path');

//Rythmiseis gia thn apothikeush twn arxeiwn
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        
        cb(null, path.join(__dirname, '../upload'));
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname));
    }
});

// Arxikopoihsh tou multer me tis rythmiseis pou orisame
const upload = multer({ storage: storage });

router.post('/sendRequest',upload.single('File'),(req,res)=>{
    const {Subject,Category,Description,user_id}=req.body;
    

    if (!Subject||!Category||!Description){
        return res.status(400).json({ message: 'Παρακαλώ συμπληρώστε όλα τα πεδία!' });
    }

    const strFile = req.file ? req.file.filename : null;

        const query = `
            INSERT INTO requests
            (Subject, Category, Description, File, Status,Date, user_id) 
         VALUES (?, ?, ?, ?,'Εκκρεμής',NOW(),?)
       `;

       db.query(query,[Subject,Category,Description,strFile,user_id],(err,results)=>{
           if (err){
               res.status(500).send(err.message);
               return;
           }
           res.json({message:'Το αίτημα σας καταγράφηκε με επιτυχία'})
       })


    })
    
module.exports = router;