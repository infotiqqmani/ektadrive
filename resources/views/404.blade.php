<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        .error-code {
            font-size: 10rem;
            font-weight: bold;
            color: #e63946;
        }
        .message {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 2rem;
        }
        .back-button {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <div class="message">Oops! Page not found</div>
        <div class="description">
            The page you are looking for doesn't exist or has been moved.
        </div>
        <a href="{{ url('/') }}" class="back-button">Go to Homepage</a>
    </div>
</body>
</html>
