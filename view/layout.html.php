<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?= $pageContent ?>
    <div style="height: 200px;"></div>
</body>
<footer class="footer">
    <div class="waves">
        <div class="wave" id="wave1"></div>
        <div class="wave" id="wave2"></div>
        <div class="wave" id="wave3"></div>
        <div class="wave" id="wave4"></div>
    </div>
    <ul class="social-icon">
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-facebook"></ion-icon>
            </a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-twitter"></ion-icon>
            </a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-linkedin"></ion-icon>
            </a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a></li>
    </ul>
    <ul class="menu">
        <li class="menu__item"><a class="menu__link" href="#">Accueil</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Boxs</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Offrir</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Panier</a></li>
        <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>

    </ul>
    <p>&copy;2023 Omnesbox | All Rights Reserved</p>
</footer>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .footer {
        position: relative;
        width: 100%;
        background: #FF41C6;
        min-height: 100px;
        padding: 20px 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .social-icon,
    .menu {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
        flex-wrap: wrap;
    }

    .social-icon__item,
    .menu__item {
        list-style: none;
    }

    .social-icon__link {
        font-size: 2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
    }

    .social-icon__link:hover {
        transform: translateY(-10px);
    }

    .menu__link {
        font-size: 1.2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
        text-decoration: none;
        opacity: 0.75;
        font-weight: 300;
    }

    .menu__link:hover {
        opacity: 1;
    }

    .footer p {
        color: #fff;
        margin: 15px 0 10px 0;
        font-size: 1rem;
        font-weight: 300;
    }

    .wave {
        position: absolute;
        top: -100px;
        left: 0;
        width: 100%;
        height: 100px;
        background: url("public/wave.png");
        background-size: 1000px 100px;
    }

    .wave#wave1 {
        z-index: 1000;
        opacity: 1;
        bottom: 0;
        animation: animateWaves 4s linear infinite;
    }

    .wave#wave2 {
        z-index: 999;
        opacity: 0.5;
        bottom: 10px;
        animation: animate 4s linear infinite !important;
    }

    .wave#wave3 {
        z-index: 1000;
        opacity: 0.2;
        bottom: 15px;
        animation: animateWaves 3s linear infinite;
    }

    .wave#wave4 {
        z-index: 999;
        opacity: 0.7;
        bottom: 20px;
        animation: animate 3s linear infinite;
    }

    @keyframes animateWaves {
        0% {
            background-position-x: 1000px;
        }

        100% {
            background-positon-x: 0px;
        }
    }

    @keyframes animate {
        0% {
            background-position-x: -1000px;
        }

        100% {
            background-positon-x: 0px;
        }
    }
</style>