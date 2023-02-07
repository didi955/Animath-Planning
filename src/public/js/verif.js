console.log("Loaded")

let mails = document.querySelectorAll(".verifmail")
 for (let mail of mails){
     mail.addEventListener("keyup",(e)=>{
        if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,6}$/g.test(e.target.value)){
            e.target.classList.remove("is-invalid")
        }
        else{
            e.target.classList.add("is-invalid")
        }
    })
}

 let passwords = document.querySelectorAll(".verifpass")
 for (let pass of passwords){
    pass.addEventListener("keyup",(e)=>{
        if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm.test(e.target.value)){
            e.target.classList.remove("is-invalid")
        }
        else{
            e.target.classList.add("is-invalid")
        }
    })
}

let names = document.querySelectorAll(".verifname")
for (let name of names){
    name.addEventListener("keyup",(e)=>{
        if(/^([a-zA-Z]+)$/.test(e.target.value)){
            e.target.classList.remove("is-invalid")
        }
        else{
            e.target.classList.add("is-invalid")
        }
    })
}

let phones = document.querySelectorAll(".verifphone")
for (let phone of phones){
    phone.addEventListener("keyup",(e)=>{
        if(/^((\+)33|0)[1-9](\d{2}){4}$/.test(e.target.value)){
            e.target.classList.remove("is-invalid")
        }
        else{
            e.target.classList.add("is-invalid")
        }
    })
}

let checked = document.querySelectorAll(".check-must-valid")
for (let check of checked){
    check.addEventListener("change",(e)=>{
        if(e.target.checked){
            e.target.classList.remove("is-invalid")
        }
        else{
            e.target.classList.add("is-invalid")
        }
    })
}

(() => {
    'use strict'
    
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        let pass = form.querySelector(".verifpass")
        let passconfirm = form.querySelector(".verifpassconfirm")
        if(pass && passconfirm){
            passconfirm.addEventListener("keyup",(e)=>{
                if(pass.value !== passconfirm.value){
                    passconfirm.classList.add("is-invalid")
                }
                else{
                    passconfirm.classList.remove("is-invalid")
                }
            })
        }
        form.addEventListener('submit', event => {
            let inputs = form.querySelectorAll(".form-control,.form-check-input")
            inputs.forEach(input => {
                if(input.classList.contains("is-invalid")){
                    event.preventDefault()
                    event.stopPropagation()
                }
            })
            let hcaptcha = form.querySelector('[name=h-captcha-response]')
            if (hcaptcha.value === "") {
                form.querySelector('.h-captcha').classList.add("is-invalid")
                event.preventDefault();
                event.stopPropagation();
            }
            else {
                form.querySelector('.h-captcha').classList.remove("is-invalid")
            }
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

