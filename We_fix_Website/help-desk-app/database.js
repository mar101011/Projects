const express=require('express');
const mysql = require('mysql');

// Dhmiourgia tou antikeimenou sundeshs me tis aparaithtes rythmiseis
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',   
    database: 'helpdesk', 
    port:3306
});

// Anoigei th sundesh me th vash dedomenwn
db.connect((err)=>{
    if (err){
        console.error('Error connecting to MySQL'+err.stack);
        return;
    }
    console.log('Connected to MySQL database');
})

module.exports = db; // Ejagei to antikeimeno gia na mporei na xrhsimopoihthei apo ta upoloipa arxeia