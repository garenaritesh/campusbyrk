<!-- Databas Process -->

<?php

include("../admin/db.php");

if (isset($_REQUEST['register'])) {
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $password = $_REQUEST['password'];

    $sql = "insert into users(email,phone,password) values('$email','$phone','$password')";
    mysqli_query($db, $sql);
    header("location:login.php");

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SignUp | PassMate </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
    #email.valid {
        /* border-color: green; */
        border: 2px solid green;
    }

    #email.invalid {
        border-color: red;
    }

    #phone.valid {
        /* border-color: green; */
        border: 2px solid green;
    }

    #phone.invalid {
        border-color: red;
    }

    #password.valid {
        /* border-color: green; */
        border: 2px solid green;
    }

    #password.invalid {
        border-color: red;
    }

    .feedback-line.valid {
        color: green;
    }

    .feedback-line.invalid {
        color: red;
    }

    .term {
        font-size: 14px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: start;
    }

    .term input[type="checkbox"] {
        width: 8%;
        padding: 15px;
    }

    .term a {
        text-decoration: none;
        color: blue;
    }
</style>

<body>

    <!-- Body Content Here -->
    <div class="container">
        <h3>Pass<span>Mate</span></h3>
        <form action="#" method="post">
            <input type="text" name="email" id="email" placeholder="What's your e-mail?" required>
            <input type="number" name="phone" id="phone" placeholder="Phone no" required>
            <input type="text" name="password" id="password" placeholder="Create Password" required>
            <div class="password-feedback">
                <div id="length-feedback" class="feedback-line">At least 8 characters & contains both upper and lower
                    case letters</div>
                <div id="number-feedback" class="feedback-line">Contains at least one number</div>
                <div id="special-feedback" class="feedback-line">Contains at least one special character (e.g., @, #, $,
                    %, etc.)</div>
            </div>
            <div class="term">
                <input type="checkbox" id="terms-checkbox">
                I agree to the &nbsp; <a href="#" target="_blank">terms and conditions</a>.

            </div>
            <button name="register" id="submit-button" disabled>Sign Up</button>
            <div class="desc">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>



    <!-- Javascript file link here -->

    <!-- Validation Of Form -->
    <script>
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const passwordInput = document.getElementById('password');
        const submitButton = document.getElementById('submit-button');
        const termsCheckbox = document.getElementById('terms-checkbox');
        const lengthFeedback = document.getElementById('length-feedback');
        const numberFeedback = document.getElementById('number-feedback');
        const specialFeedback = document.getElementById('special-feedback');

        // Email validation regex
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^(\+?\d{1,3}[-\s]?)?\(?\d{3}\)?[-\s]?\d{3}[-\s]?\d{4}$/;

        // Password validation criteria
        const lengthRegex = /.{8,}/;
        const uppercaseRegex = /[A-Z]/;
        const lowercaseRegex = /[a-z]/;
        const numberRegex = /[0-9]/;
        const specialRegex = /[!@#$%^&*(),.?":{}|<>]/;

        function validateEmail() {
            const emailValue = emailInput.value;
            const isValid = emailRegex.test(emailValue);
            emailInput.classList.toggle('valid', isValid);
            emailInput.classList.toggle('invalid', !isValid);
            return isValid;
        }

        function validatePhone() {
            const phoneValue = phoneInput.value;
            const isValid = phoneRegex.test(phoneValue);
            phoneInput.classList.toggle('valid', isValid);
            phoneInput.classList.toggle('invalid', !isValid);
            return isValid;
        }

        function validatePassword() {
            const passwordValue = passwordInput.value;

            const isLengthValid = lengthRegex.test(passwordValue) && uppercaseRegex.test(passwordValue) && lowercaseRegex.test(passwordValue);
            const isNumberValid = numberRegex.test(passwordValue);
            const isSpecialValid = specialRegex.test(passwordValue);

            lengthFeedback.classList.toggle('valid', isLengthValid);
            lengthFeedback.classList.toggle('invalid', !isLengthValid);

            numberFeedback.classList.toggle('valid', isNumberValid);
            numberFeedback.classList.toggle('invalid', !isNumberValid);

            specialFeedback.classList.toggle('valid', isSpecialValid);
            specialFeedback.classList.toggle('invalid', !isSpecialValid);

            const isValid = isLengthValid && isNumberValid && isSpecialValid;
            passwordInput.classList.toggle('valid', isValid);
            passwordInput.classList.toggle('invalid', !isValid);
            return isValid;
        }

        function enableSubmitButton() {
            const isFormValid = validateEmail() && validatePhone() && validatePassword() && termsCheckbox.checked;
            submitButton.disabled = !isFormValid;
            submitButton.classList.toggle('enabled', isFormValid);
        }

        emailInput.addEventListener('input', () => {
            validateEmail();
            enableSubmitButton();
        });

        phoneInput.addEventListener('input', () => {
            validatePhone();
            enableSubmitButton();
        });

        passwordInput.addEventListener('input', () => {
            validatePassword();
            enableSubmitButton();
        });

        termsCheckbox.addEventListener('change', () => {
            enableSubmitButton();
        });
    </script>

</body>

</html>