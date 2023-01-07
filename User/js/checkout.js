const form = document.getElementById("checkoutForm")
const cardname = document.getElementById("name")
const cardnumber = document.getElementById("cardnumber")
const expiration = document.getElementById("expiration")
const cvc = document.getElementById("cvc")

const form2 = document.getElementById("deliveryForm")
const date = document.getElementById("date")

form2.addEventListener("submit", e => {
    checkInputs2(); 

    if(isFormValid2() === true){
        form2.submit();
    }
    else{
        e.preventDefault();
    }
});


form.addEventListener("submit", e => {
    checkInputs(); 

    if(isFormValid() === true){
        form.submit();
    }
    else{
        e.preventDefault();
    }
});



function isFormValid2(){
    const inputContainers = form2.querySelectorAll(".user_input");
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains("error")){
            result = false;
        }
    });
    return result;
}


function isFormValid(){
    const inputContainers = form.querySelectorAll(".user_input");
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains("error")){
            result = false;
        }
    });
    return result;
}

function checkInputs2(){

    const dateValue = date.value.trim();

    if(dateValue == ""){
        setErrorFor(date, "Date cannot be blank");
    }else{
        setSuccessFor(date);
    }

}



function checkInputs(){
    //get the values from the inputs
    const cardnameValue = cardname.value.trim();
    const cardnumberValue = cardnumber.value.trim();
    const expirationValue = expiration.value.trim();
    const cvcValue = cvc.value.trim();

    

    if(cardnameValue == ""){
        setErrorFor(cardname, "Name cannot be blank");
    }
    else if(!isCardname(cardnameValue)){
        setErrorFor(cardname, "Name is not valid");
    }
    else{
        setSuccessFor(cardname);
    }

    if(cardnumberValue == ""){
        setErrorFor(cardnumber, "Card number cannot be blank");
    }
    else if(!isCardnumber(cardnumberValue)){
        setErrorFor(cardnumber, "Card number is not valid");
    }
    else{
        setSuccessFor(cardnumber);
    }

    if(expirationValue == ""){
        setErrorFor(expiration, "Expiration date cannot be blank");
    }
    else if(!isExpiration(expirationValue)){
        setErrorFor(expiration, "Expiration date is not valid");
    }
    else{
        setSuccessFor(expiration);
    }

    if(cvcValue == ""){
        setErrorFor(cvc, "CVC cannot be blank");
    }
    else if(!isCvc(cvcValue)){
        setErrorFor(cvc, "CVC is not valid");
    }
    else{
        setSuccessFor(cvc);
    }

    

}





function setErrorFor(input, message){
    const user_input = input.parentElement; //.form-control
    const small = user_input.querySelector("small");

    //add error message inside small
    small.innerText = message;

    //add error class
    user_input.className = "user_input error";
}

function setSuccessFor(input){
    const user_input = input.parentElement;
    user_input.className = "user_input success";
}
 
function myReset(){
    document.getElementById("checkoutForm").reset();
    paymenttype.parentElement.className = "user_input";
    cardname.parentElement.className = "user_input";
    cardnumber.parentElement.className = "user_input";
    expiration.parentElement.className = "user_input";
    cvc.parentElement.className = "user_input";
}

function isCardname(cardname){
    return /^[A-Za-z ]+$/.test(cardname);
}

function isCardnumber(cardnumber){
    return /^([0-9]{4}-)([0-9]{4}-)([0-9]{4}-)([0-9]{4})$/.test(cardnumber);
}

function isExpiration(expiration){
    return /^([0-9]{2}-)([0-9]{2})$/.test(expiration);
}

function isCvc(cvc){
    return /^([0-9]{3})$/.test(cvc);
}