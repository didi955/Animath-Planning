console.log("Loaded")
let mails = document.querySelectorAll(".verifmail")
 for (let mail of mails){
     mail.addEventListener("keyup",(e)=>{
        if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(e.target.value)){
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
