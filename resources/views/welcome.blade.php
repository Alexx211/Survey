<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #000000;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            margin-top: 40px;
            position: relative;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 7rem;
            font-weight: bold;
        }

        .nav-bar {
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: #202020;
        }

        .nav-bar a {
            margin: 0 10px;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-bar a:hover {
            background-color: #ff6347;
        }

        .dashboard-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.1);
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dashboard-button:hover {
            background-color: #ff6347;
            color: #ffffff;
        }

        main {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #ffffff;
            color: #000000;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
        }

        .modal h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .close {
            color: #000000;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #ff6347;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ff6347;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #e55340;
        }


        .success-message {
            display: none;
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            text-align: center;
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        .toggle-link {
            margin-top: 15px;
            color: #ff6347;
            cursor: pointer;
            text-align: center;
        }

        .toggle-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Survey</h1>
    <a href="{{ route('dashboard') }}" id="dashboardBtn" class="dashboard-button">Dashboard</a>

    <div class="nav-bar">
        <nav>
            <a href="{{ route('login') }}" id="loginBtn">Log in</a>
            <a href="{{ route('register') }}" id="registerBtn">Register</a>
        </nav>
    </div>
</div>
<main>
</main>
<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="authModal">&times;</span>
        <div id="loginFormContainer">
            <h2>LOG IN</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="login-email">Email address:</label>
                <input type="text" id="login-email" name="email" placeholder="Enter your email address" required>
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                <input type="submit" value="Submit">
            </form>
            <div class="toggle-link" id="switchToRegister">Don't have an account? Sign up here.</div>
        </div>
        <div id="registerFormContainer" style="display: none;">
            <h2>CREATE ACCOUNT</h2>
            <form id="registerForm" action="{{ route('register') }}" method="POST">
                @csrf
                <label for="register-name">Name:</label>
                <input type="text" id="register-name" name="name" placeholder="Enter your name" required>
                <label for="register-email">Email address:</label>
                <input type="text" id="register-email" name="email" placeholder="Enter your email address" required>
                <label for="register-password">Password:</label>
                <input type="password" id="register-password" name="password" placeholder="Enter your password"
                       required>
                <label for="register-password-confirmation">Confirm Password:</label>
                <input type="password" id="register-password-confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                <input type="submit" value="SIGN UP">
            </form>
            <div class="success-message" id="successMessage">Registration successful! Log In...</div>
            <div class="toggle-link" id="switchToLogin">Already have an account? Log in here.</div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var loginBtn = document.getElementById("loginBtn");
        var registerBtn = document.getElementById("registerBtn");
        var closeButtons = document.querySelectorAll('.close');

        var authModal = document.getElementById("authModal");
        var loginFormContainer = document.getElementById("loginFormContainer");
        var registerFormContainer = document.getElementById("registerFormContainer");

        var registerForm = document.getElementById("registerForm");
        var successMessage = document.getElementById("successMessage");

        var switchToRegister = document.getElementById("switchToRegister");
        var switchToLogin = document.getElementById("switchToLogin");

        // Funcție pentru a afișa modalul de Log In
        function showLoginModal() {
            authModal.style.display = "block";
            loginFormContainer.style.display = "block";
            registerFormContainer.style.display = "none";
        }

        // Afișează modalul de Log In la apăsarea butoanelor Log In
        loginBtn.addEventListener('click', function (event) {
            event.preventDefault();
            showLoginModal();
        });

        // Afișează modalul de Register
        registerBtn.addEventListener('click', function (event) {
            event.preventDefault();
            authModal.style.display = "block";
            registerFormContainer.style.display = "block";
            loginFormContainer.style.display = "none";
        });

        // Schimbă la Register
        switchToRegister.addEventListener('click', function () {
            loginFormContainer.style.display = "none";
            registerFormContainer.style.display = "block";
        });

        // Schimbă la Log In
        switchToLogin.addEventListener('click', function () {
            registerFormContainer.style.display = "none";
            loginFormContainer.style.display = "block";
        });

        // Închide modalurile
        closeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var modalId = btn.getAttribute('data-modal');
                document.getElementById(modalId).style.display = "none";
            });
        });

        // Închide modalul dacă se face clic în afara acestuia
        window.addEventListener('click', function (event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        });

        // Afișează mesajul de succes la înregistrare
        registerForm.addEventListener('submit', function (event) {

            successMessage.style.display = "block";
            setTimeout(function () {
                successMessage.style.display = "none";
                registerFormContainer.style.display = "none";
                loginFormContainer.style.display = "block";
            }, 3000);
        });
    });
</script>
</body>

</html>
