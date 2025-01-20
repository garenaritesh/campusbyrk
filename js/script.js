// Javascript 

const forms = document.getElementById("forms");
const ExtraNav = document.getElementById("extra_nav");

forms.addEventListener("mousemove", () => {
    ExtraNav.style.opacity = '10';
    ExtraNav.style.zIndex = '99';
})

ExtraNav.addEventListener("mouseleave", () => {
    ExtraNav.style.opacity = "0";
    ExtraNav.style.zIndex = "-1";
})


// Calendar Script Here

// For Edit Form

// Change Form Script

const NoneForm = document.getElementById("none_form");
const ChangeForm = document.getElementById("change_form");
const XCallBTN = document.getElementById("cls_update_form");
const CallBTN = document.getElementById("user_edt");
const Inputs = document.querySelectorAll("input");

XCallBTN.style.display = "none";
ChangeForm.style.display = "none";

CallBTN.addEventListener("click", () => {
    ChangeForm.style.display = "block";
    NoneForm.style.display = "none";
    CallBTN.style.display = "none";
    XCallBTN.style.display = "block";
    Inputs.forEach(input => {
        input.style.border = "1px solid blue";
        input.readOnly = false;
    })
})


XCallBTN.addEventListener("click", () => {
    ChangeForm.style.display = "none";
    NoneForm.style.display = "block";
    CallBTN.style.display = "block";
    XCallBTN.style.display = "none";
    Inputs.forEach(input => {
        input.style.border = "1px solid #ddd";
        input.readOnly = true;
        input.style.userSelect = 'flex';
    })
})
