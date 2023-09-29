function validate(){
    let user =  document.registration.user.value;
    let depart =  document.registration.depart.value;
    let name = document.registration.name.value;
    let email= document.registration.email.value;
    let pw = document.registration.pw.value;
    let cpw = document.registration.cpw.value;

    if(user.trim()== ""){
        alert("Select user");
        document.registration.user.focus();
        return false;

    }
    if(depart.trim()== ""){
        alert("Select depart");
        document.registration.depart.focus();
        return false;

    }

    let namePattern = /^([A-Z])([a-zA-Z\s])+$/;
    if(name.trim()== ""){
        alert("Enter your name");
        document.registration.name.focus();
        return false;

    }
    else if(!namePattern.test(name)){
        alert("enter valid name");
        document.registration.name.focus();
        return false;
    }

    let emailPattern = /^[\w_\-\.]+[@][a-z]+[\.][a-z]{2,3}$/;
    if(email.trim()== ""){
        alert("Enter your email");
        document.registration.email.focus();
        return false;
    }
    else if(!emailPattern.test(email)){
        alert("invalid email");
        document.registration.email.focus();
        return false;
    }

    if(pw.trim()==''){
        alert("Enter password");
        document.registration.pw.focus();
        return false;
    }
    if(cpw.trim()==''){
        alert("enter confirm password");
        document.registration.cpw.focus();
        return false;
    }

    if(pw.trim()!= cpw.trim()){
        alert("password doesnot match.");
        document.registration.cpw.focus();
        return false;
    }

   

}


    


