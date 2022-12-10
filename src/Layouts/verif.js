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

