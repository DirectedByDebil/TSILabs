<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">
<head>
    <meta charset="UTF-8">

    <link rel="shortcut icon" href="../../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/MyStyles.css">
</head>


<body class="text-bg-light">

<!--Шапка-->
<header>
    <div class="text-bg-success rounded img-thumbnail">
        <div class="container-lg">
            <div class="fs-6 px-4">
                <div class="d-flex flex-row justify-content-sm-start align-items-center ">
                    <div class="p-3"> <a href="../Pages/SushiMain.php"> <img
                            src="../../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
                            height="auto" width="100" alt="Иконка лысенького Майка" /></div> </a>
                    <div class="p-3">Волгоград</div>
                    <div class="p-3">RU</div>
                    <div class="p-3 me-auto">Настройки</div>
                    <div class="p-3">+7 (961) 079-39-19</div>
                    <div class="p-3"><img
                                src="../../Images/icons8-день-и-ночь-48.png" height="30" width="auto" alt="Смени тему"/></div>
                    <div class="p-1 rounded-3">
                        <?php include("IsAuthorizedInfo.php") ?>
                         </div>
                </div>
            </div>


        </div>
    </div>
</header>

<!--Выберите район-->
<div class="container-sm  text-bg-dark rounded img-thumbnail">
    <div class="fs-5 px-4">
        <div class="d-flex flex-row justify-content-sm-start align-items-center ">
            <div class="p-3">
                <a style="color: #198754" href="../Pages/text.php"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg> </a>
            </div>
            <div class="p-3">Выберите район</div>
            <div class="p-3 me-auto"> <a style="color: #198754" href="../Pages/SecretPage.php">Секретная страница</a></div>
            <div class="p-3"><a style="color: #198754" href="../Pages/Import.php" >Изменить</a></div>
            <div class="p-3"><a style="color: #198754" href="../Pages/Export.php" >Доставка</a></div>
            <div class="p-3">Самовывоз</div>
        </div>
    </div>
</div>

<!--Главная, акции, отзывы, о нас-->
<div class="container-lg w-75 text-decoration-underline">
    <div class="fs-5">
        <div class="d-flex flex-row justify-content-sm-start ">
            <div class="p-3">Главная</div>
            <div class="p-3">Акции</div>
            <div class="p-3">Отзывы</div>
            <div class="p-3 me-auto">О нас</div>
            <div class="p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

</body>
</html>