<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        .bg-img {
            background-image: url('./media/Groceries-ThinkstockPhotos-836782690.jpg');
            filter: blur(9px);
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        hr {
            width: 50%;
            border: none;
            height: 1px;
            background-color: white;
            margin: 2rem auto;
        }

        .text-center {
            text-align: center;
        }

        a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            padding: 0.5rem 1rem;
            background-color: #555;
            border-radius: 5px;
            box-shadow: 10px 10px 10px rgba(0,0,0,0.5);
        }

        a:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="bg-img"></div>
    <div class="bg-text">
        <div class="w-50">
            <h1>Grocery Management System</h1>
            <hr>
            <div class="text-center">
                <a href="login/index.php">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
