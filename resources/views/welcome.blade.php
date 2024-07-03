<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event Handler</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .selection-bg {
            background-color: #FF2D20 !important;
            color: white !important;
        }
        .navbar {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="jumbotron text-center">
            <h1 class="display-4">Welcome to Event Handler</h1>
            <p class="lead">Your one-stop solution for managing and organizing events effortlessly.</p>
            <hr class="my-4">
            <p>Log in or register to start creating and managing your events now!</p>
            @auth
                <a class="btn btn-primary btn-lg" href="{{ url('/home') }}" role="button">Go to home page</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Log in</a>
                @if (Route::has('register'))
                    <a class="btn btn-secondary btn-lg" href="{{ route('register') }}" role="button">Register</a>
                @endif
            @endauth
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>Event Handler is a powerful tool designed to simplify the process of event management. Whether you are planning a small gathering or a large conference, our platform provides the tools you need to ensure your event runs smoothly.</p>
            </div>
            <div class="col-md-6">
                <h2>Features</h2>
                <ul>
                    <li>Easy event creation and management</li>
                    <li>Real-time updates and notifications</li>
                    <li>Comprehensive analytics and reports</li>
                    <li>Customizable event templates</li>
                    <li>Secure and reliable platform</li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="text-center py-4">
        <p class="text-muted">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
