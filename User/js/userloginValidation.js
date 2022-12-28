const form = document.getElementById("form")
const email = document.getElementById("email")
const password = document.getElementById("pass")

form.addEventListener("submit", e => {
    checkInputs(); 

    if(isFormValid() === true){
        form.submit();
    }
    else{
        e.preventDefault();
    }
});

function isFormValid(){
    const inputContainers = form.querySelectorAll(".form-control");
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains("error")){
            result = false;
        }
    });
    return result;
}

function checkInputs(){
    //get the values from the inputs
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    if(emailValue == ""){
        setErrorFor(email, "Email cannot be blank");
    }
    else if(!isEmail(emailValue)){
        setErrorFor(email, "Email is not valid");
    }
    else{
        setSuccessFor(email);
    }

    if(passwordValue == ""){
        setErrorFor(password, "Password cannot be blank");
    }
    else{
        setSuccessFor(password);
    }
}

function setErrorFor(input, message){
    const formControl = input.parentElement; //.form-control
    const small = formControl.querySelector("small");

    //add error message inside small
    small.innerText = message;

    //add error class
    formControl.className = "form-control error";
}

function setSuccessFor(input){
    const formControl = input.parentElement;
    formControl.className = "form-control success";
}
 
function myReset(){
    document.getElementById("form").reset();
    email.parentElement.className = "form-control";
    password.parentElement.className = "form-control";
}

function isEmail(email){
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function togglePassword(){
    var password = document.getElementById("pass")
    if(password.type ==='password'){
        password.type = "text";
        document.getElementById("togglePassword").style.color='#8c8c8c';
    }
    else{
        password.setAttribute('type', 'password');
        document.getElementById("togglePassword").style.color='black';
    }
}