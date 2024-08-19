<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Survey') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #000000;
            color: #ffffff;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #CECECE;
        }

        .navbar {
            background-color: #202020;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .navbar .navbar-brand {
            color: #ff6347;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar .navbar-brand:hover {
            color: #f0f0f0;
        }

        .navbar .navbar-nav {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            flex: 1;
        }

        .navbar .nav-item {
            margin-left: 20px;
        }

        .navbar .nav-link {
            padding: 10px 15px;
            color: #ffffff;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            opacity: 0;
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .navbar .nav-link:hover {
            background-color: #ff6347;
            transform: scale(1.1);
        }

        .container {
            margin-top: 80px;
            max-width: 1200px;
            padding: 20px;
            background-color: #202020;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #welcome-message {
            background-color: #EFF9F0;
            color: #F0A202;
            padding: 15px 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-out;
        }

        #close-message {
            background-color: #202020;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #close-message:hover {
            background-color: #e55340;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel Survey') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/surveys') }}">Surveys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div id="welcome-message" class="alert alert-info">
        <span>Good luck!</span>
        <button id="close-message">Închide</button>
    </div>
</div>

<script>
    // Sterge mesajul din localStorage la logare
    document.addEventListener('DOMContentLoaded', function() {
        localStorage.removeItem('welcomeMessageClosed');
    });

    // Verifică dacă mesajul a fost închis anterior
    if (localStorage.getItem('welcomeMessageClosed') === 'true') {
        document.getElementById('welcome-message').style.display = 'none';
    }

    // Eveniment pentru închiderea mesajului
    document.getElementById('close-message').addEventListener('click', function () {
        document.getElementById('welcome-message').style.display = 'none';
        localStorage.setItem('welcomeMessageClosed', 'true'); // Salvează starea în Local Storage
    });
</script>

<div class="container mt-5">
    @if(session('welcome_message'))
        <div id="welcome-message" class="alert alert-info">
            {{ session('welcome_message') }}
            <button id="close-message">Închide</button>
        </div>
    @endif

    @yield('content')
</div>
</body>

</html>
