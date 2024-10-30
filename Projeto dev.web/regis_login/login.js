const regis_btn = document.querySelector("#regis-btn");
const login_btn = document.querySelector("#login-btn");
const container = document.querySelector(".container");

regis_btn.addEventListener('click',() =>{
    container.classList.add("regis-mode")
});

login_btn.addEventListener('click',() =>{
    container.classList.remove("regis-mode")
});