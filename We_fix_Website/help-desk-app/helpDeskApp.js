const express = require('express'); /*Fortwnei to module Expess.js */
const app=express(); /*Orizoume ton arithmo ths portas sthn opoia akouei o server */
const port=3000;
const cors = require('cors'); 
const path = require('path');

app.use(cors());// Epitrepei thn epikoinwnia tou Frontend me to Backend 
app.use(express.json());// Epitrepei ston server na diabazei dedomena se morfh JSON
app.use('/upload', express.static(path.join(__dirname, 'upload'))); //O fakelos me tis eikones

// Edw eisagoume ta arxeia pou periexoun th logikh gia kathe leitourgia
const register=require('./routes/register');
const login=require('./routes/login');
const sendRequest=require('./routes/sendRequest');
const category=require('./routes/category');
const preview=require('./routes/preview');
const history=require('./routes/history');
const announcement=require('./routes/announcement');
const addAnnouncement=require('./routes/addAnnouncement');
const manageRegister=require('./routes/manageRegister');
const approveUser=require('./routes/approveUser');
const rejectUser=require('./routes/rejectUser');
const editcat=require('./routes/editcat');
const addNewCategory=require('./routes/addNewCategory');
const deleteCategory=require('./routes/deleteCategory');
const manageUsers=require('./routes/manageUsers');
const editUser=require('./routes/editUser');
const deleteUser=require('./routes/deleteUser');
const addUser=require('./routes/addUser');
const getTechs=require('./routes/getTechs');
const manageRequests=require('./routes/manageRequests');
const submitEditReq=require('./routes/submitEditReq');

// Kathe fora pou kaleitai ena path, analambanei to antistoixo arxeio
app.use('/',register);
app.use('/',login);
app.use('/',sendRequest);
app.use('/',category);
app.use('/',preview);
app.use('/',history);
app.use('/',announcement);
app.use('/',addAnnouncement);
app.use('/',manageRegister);
app.use('/',approveUser);
app.use('/',rejectUser);
app.use('/',editcat);
app.use('/',addNewCategory);
app.use('/',deleteCategory);
app.use('/',manageUsers);
app.use('/',editUser);
app.use('/',deleteUser);
app.use('/',addUser);
app.use('/',getTechs);
app.use('/',manageRequests);
app.use('/',submitEditReq);

app.listen(port,()=>{
  console.log('App is running at http://localhost:'+port)  /*Jekinaei ton server kai orizei oti tha dexetai sundeseis se sygkekrimenh thura */
})

app.get('/',(req,res)=>{ //orizei thn diadromh poy ua akouei ta aithmata HTTP GET

    res.send('Server is in state running')
})

