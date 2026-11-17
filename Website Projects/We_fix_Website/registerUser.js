const formRegister=document.getElementById('formCre');
const countryList = document.getElementById('country');
const townList = document.getElementById('town');

//Sundesh API gia tis xwres 
document.addEventListener('DOMContentLoaded',async()=> {


    try{
        
        const response = await fetch('https://countriesnow.space/api/v0.1/countries');
        const jdata = await response.json();

        const countries=jdata.data;

       countries.forEach(item => {//Ena option gia kathe xwra wste na emfanistei h lista me tis epiloges toy xrhsth

            const option = document.createElement('option');

            option.value = item.country; //Mpainei sto value gia na emfanizetai ston xrhsth
            option.textContent = item.country;  //H timh poy mpainei sth bash
            countryList.appendChild(option);

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης χωρών.');
    }

})

//Sundesh API gia tis poleis
countryList.addEventListener('change',async function(){

    try{
        
        const chosenCountry=this.value;//Pairnoume thn xwra poy dialeje o xrhsths
        
        
        while (townList.options.length > 0) { //Lathe fora poy epilegetai xwra diagrafontai oi proghoumenes
                           
            townList.remove(0);
        }        
    
        const response = await fetch('https://countriesnow.space/api/v0.1/countries/cities', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                country:chosenCountry
            })
        });

        const jdata = await response.json();

        const cityData=jdata.data;

       cityData.forEach(city => {//Ena option gia kathe polh ths xwras wste na emfanistei h lista me tis epiloges toy xrhsth

            const option2 = document.createElement('option');

            option2.value = city; //Mpainei sto value gia na emfanizetai ston xrhsth
            option2.textContent = city;  //H timh poy mpainei sth bash
            townList.appendChild(option2);

        });

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία φόρτωσης πόλεων.');
    }

})

formRegister.addEventListener('submit', async (event) => {

    //Stamataei thn selida apo to na kanei reload gia na mhn epireastei to fetch
    event.preventDefault();

    //Pairnw ola ta dedomena apo to html
    const Name = document.getElementById('name').value;
    const Surname = document.getElementById('surname').value;
    const Country = document.getElementById('country').value;
    const Town = document.getElementById('town').value;
    const Address = document.getElementById('address').value;
    const Email = document.getElementById('email').value;
    const Username = document.getElementById('user').value;
    const Password = document.getElementById('pass').value;

    try{
        
        const response = await fetch('http://localhost:3000/register', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                Name, Surname, Country, Town, Address, Email, Username, Password
            })
        });

        const data = await response.json();

        if (response.ok) {

            alert(data.message); 
            window.location.href = 'Login.php';

        } else {
            alert("Σφάλμα: " + data.message);
        }

    }catch (error){
        
        console.error('Error:', error);
        alert('Αποτυχία σύνδεσης με τον διακομιστή.');
    }

});

