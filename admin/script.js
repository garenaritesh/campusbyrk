

// Use Javascript content here

const cls_form = document.getElementById("close_form"),
    add_form = document.getElementById("admin_form"),
    panel = document.querySelector(".panel"),
    nav = document.querySelector('nav'),
    admin_form = document.querySelector(".admin_form");


add_form.addEventListener('click', () => {
    admin_form.classList.add('active');
    nav.classList.add("blur");
    panel.classList.add("blur");
})

cls_form.addEventListener("click", () => {
    admin_form.classList.remove('active');
    nav.classList.remove("blur");
    panel.classList.remove("blur");
})



// Form Validation Script


function validateForm() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("passwordError");

    // Clear previous error messages
    usernameError.textContent = "";
    passwordError.textContent = "";

    let isValid = true;

    // Username validation: At least 8 characters
    if (username.length < 8) {
        usernameError.textContent = "Username must be at least 8 characters long.";
        isValid = false;
    }

    // Password validation: At least 8 characters, including uppercase, lowercase, number, and special character
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordRegex.test(password)) {
        passwordError.textContent = "Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.";
        isValid = false;
    }

    return isValid;
}
