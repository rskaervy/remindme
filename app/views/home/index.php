<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RemindMe</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #fff;
            color: #333;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
            border-bottom: 1px solid #eee;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            color: #3F5BD8;
        }

        .nav-right a {
            margin-left: 25px;
            text-decoration: none;
            font-weight: 600;
            color: #000;
        }
        
        .btn-login{
            color: #000;
            padding: 10px 18px;
            transition:0.3s ease;
        }
        .btn-login:hover{
            background:#f2f3ff;
            border-radius:8px;
            transform:translateY(-2px);
        }

        .btn-register {
            background: #3F5BD8;
            color: white !important;
            padding: 10px 18px;
            border-radius: 8px;
            transition:0.3s ease;
        }
        .btn-register:hover{
            background: #2f46b8;
            transform:translateY(-2px);
        }
        .btn-login,
        .btn-register{
            display:inline-block;
        }

        /* HERO */
        .hero {
            height:calc(100vh - 90px);
            display: flex;
            flex-direction:column;
            justify-content: flex-start;
            align-items:center;
            text-align: center;
            padding-top: 0px;
            gap:0px;
        }

        .hero h1 {
            font-size: 56px;
            color: #3F5BD8;
            margin-bottom: 0;
        }

        .hero p {
            font-size: 18px;
            color: #888;
            max-width: 600px;
            margin-bottom: -30PX;
            margin-top:0;
        }

        .hero img {
            width: 300px;
            max-width: 90%;
            margin: 0 0 0px;
        }

        .btn-start {
            background: #3F5BD8;
            color: white;
            margin-top:-15px;
            padding: 16px 44px;
            border:none;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius:12px;
            display: inline-block;

            transition:0.3s ease;
        }
        .btn-start:hover{
            background: #2f46b8;
            transform:translateY(-2px);
        }

        @media (max-width: 768px) {

            body {
                padding: 0;
            }

            .container,
            .hero,
            .landing-container {
                padding: 20px;
                text-align: center;
            }

            h1 {
                font-size: 26px;
            }

            p {
                font-size: 14px;
            }

            .buttons,
            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .buttons a,
            .action-buttons a,
            .btn {
                width: 100%;
                text-align: center;
            }
        }

    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="brand">RemindMe</div>
    <div class="nav-right">
        <a href="index.php?c=auth&a=login" class="btn-login">Login</a>
        <a href="index.php?c=auth&a=register" class="btn-register">Register</a>
    </div>
</div>

<div class="hero">
    <h1>RemindMe</h1>
    <p>Manage tasks and receive timely <br> reminders directly via email.</p>

    <img src="images/alarm.png" alt="Alarm Icon">

    <br>
    <a href="index.php?c=auth&a=login" class="btn-start">Get Started</a>
</div>

</body>
</html>
