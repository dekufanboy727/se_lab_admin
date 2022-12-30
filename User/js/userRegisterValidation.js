const form = document.getElementById("form")
const fullname = document.getElementById("name")
const email = document.getElementById("email")
const phone = document.getElementById("phone")
const address = document.getElementById("address")
const password = document.getElementById("password")
const password2 = document.getElementById("password2")

form.addEventListener("submit", e => {
    checkInputs(); 

    if(isFormValid() === true){
        alert("Account successfully created, redirecting to login page");
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
    const nameValue = fullname.value.trim();
    const emailValue = email.value.trim();
    const phoneValue = phone.value.trim();
    const addressValue = address.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();


    if(nameValue == ""){
        setErrorFor(fullname, "Name cannot be blank");
    }else{
        setSuccessFor(fullname);
    }

    if(emailValue == ""){
        setErrorFor(email, "Email cannot be blank");
    }
    else if(!isEmail(emailValue)){
        setErrorFor(email, "Email is not valid");
    }
    else{
        setSuccessFor(email);
    }

    

    if(phoneValue == ""){
        setErrorFor(phone, "Phone number cannot be blank");
    }else{
        setSuccessFor(phone);
    }

    if(addressValue == ""){
        setErrorFor(address, "Address cannot be blank");
    }else{
        setSuccessFor(address);
    }
    

    if(passwordValue == ""){
        setErrorFor(password, "Password cannot be blank");
    }else{
        setSuccessFor(password);
    }

    if(password2Value == ""){
        setErrorFor(password2, "Please re-enter your password");
    }else if(password2Value != passwordValue){
        setErrorFor(password2, "Passwords do not match");
    }else{
        setSuccessFor(password2);
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
        var password = document.getElementById("password")
        if(password.type ==='password'){
            password.type = "text";
            document.getElementById("togglePassword").style.color='#8c8c8c';
        }
        else{
            password.setAttribute('type', 'password');
            document.getElementById("togglePassword").style.color='black';
        }
    }

    function togglePassword2(){
        var password2 = document.getElementById("password2")
        if(password2.type ==='password'){
            password2.type = "text";
            document.getElementById("togglePassword2").style.color='#8c8c8c';
        }
        else{
            password2.setAttribute('type', 'password');
            document.getElementById("togglePassword2").style.color='black';
        }
    }
