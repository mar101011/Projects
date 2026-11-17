function count(){

    let yIncome=Number(document.getElementById("yIncome").value);
    let numChild=Number(document.getElementById("numChild").value);
    let dOBirth=document.getElementById("dOBirth").value;
    let incomeTax=0;
    let tax=0;
    let finalTax=0;
    let discount=0;
    let age=0;
    let clearIncome=0;

    let curDate = new Date();
    age=getDateDiff(curDate,dOBirth);
    if(numChild<5) {
    if (yIncome>=0 && yIncome<8000){
        incomeTax=yIncome-6000;
        tax=incomeTax*(10/100);
        if(age>65 || age<25 ){
           discount=(20/100)+(5/100)*numChild;
        }else{
            discount=(5/100)*numChild;
        }
        
    }else if(yIncome>=8000 && yIncome<15000){
        incomeTax=yIncome-6500;
        tax=incomeTax*(20/100);
        if(age>65 || age<25 ){
            discount=(10/100)+(5/100)*numChild;
        }else{
            discount=(5/100)*numChild;
        }
        
    }else if(yIncome>=15000 && yIncome<40000){
        incomeTax=yIncome-4000;
        tax=incomeTax*(32/100);
        if(age>65 || age<25 ){
            discount=(10/100)+(5/100)*numChild;
        }else{
            discount=(5/100)*numChild;
        }
       
    }else if(yIncome>=40000){
        incomeTax=yIncome-2000;
        tax=incomeTax*(40/100);
        if(age>65 || age<25 ){
             discount=(5/100)+(5/100)*numChild;
        }else{
            discount=(5/100)*numChild;
        }    
        
    }

    if (yIncome>=0){
         finalTax=tax-tax*discount;
         clearIncome=yIncome-finalTax;
    }else {
        alert("They is no negative income. Try again...");

    }
    document.getElementById("clearIncome").innerText = clearIncome;
    document.getElementById("incomeTax").innerText = incomeTax;
    document.getElementById("tax").innerText = tax;
    document.getElementById("discount").innerText = (discount * 100);
    document.getElementById("finalTax").innerText = finalTax;
    }else{
         alert("The max children value can be 4.Try again...");
    }
}

function getDateDiff(curDate,dOBirth){

    dOBirth = new Date(dOBirth);
    let age=curDate.getFullYear()-dOBirth.getFullYear();
    let month=curDate.getMonth()-dOBirth.getMonth();
    let date=curDate.getDate()-dOBirth.getDate();

    if(month<0 || (month==0 && date<0)){
        age--;
    }      
    console.log(age);             
    return age;
}
function changeColor(){
    let btn = document.getElementById("colorBtn");
    
    btn.style.backgroundColor = "#e0d68d";  
    btn.style.color = "white"; 

    setTimeout(() => {
        btn.style.backgroundColor = "";   
        btn.style.color = "";
    }, 200);
}