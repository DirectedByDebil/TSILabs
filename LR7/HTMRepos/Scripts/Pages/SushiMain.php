<?php
require_once("../.core/logic.php");
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Доставка суши">
    <title>Главная</title>

    <link rel="shortcut icon" href="../../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
</head>


<body class="text-bg-light">

<?php include("../.core/SushiHeader.php"); ?>


<!--Карусель-->
<div class="container-sm my_carousel w-75">

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="../../Images/05c9fa716f7a3ba4f95ebbc12d6b21f3.jpg" class="d-block w-50 rounded mx-auto" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../Images/icons8-день-и-ночь-48.png" class="d-block w-50 rounded mx-auto" alt="...">
            </div>
            <div class="carousel-item active img-thumbnail">
                <img src="../../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
                     class="d-block w-75 rounded mx-auto" alt="...">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>

</div>

<!--Время доставки, мин. сумма доставки-->
<div class="container-lg img-thumbnail ">
    <div class="fs-5">
        <div class="d-flex flex-row justify-content-center ">
            <div class="p-4">Время доставки</div>
            <div class="p-4">Мин. сумма заказа</div>
            <div class="p-4">Стоим. доставки</div>
            <div class="p-4">Беспл. доставка</div>
        </div>
    </div>
</div>

<!--Фильтры роллов-->
<div class="container-lg text-decoration-underline">
    <div class="fs-6">
        <div class="d-flex flex-row justify-content-sm-start ">
            <div class="p-3">Мы рекомендуем</div>
            <div class="p-3">Популярное</div>
            <div class="p-3">Фирменные роллы</div>
            <div class="p-3">Запеченные роллы</div>
            <div class="p-3">Классические роллы</div>
            <div class="p-3">Темпура</div>
            <div class="p-3">Сеты</div>
            <div class="p-3 me-auto">Суши</div>
            <div class="p-3">Ещё</div>
            <div class="p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!--Баллы-->
<div class="container-lg">
    <div class="fs-6 ">
        <div class="d-inline-flex text-bg-success flex-row justify-content-sm-start rounded">
            <div class="p-3 img-thumbnail"></div>
            <div class="p-3 ">11 бал</div>
            <div class="p-3">6 бал</div>
            <div class="p-3">10 бал</div>
            <div class="p-3">18 бал</div>
            <div class="p-3">14 бал</div>
            <div class="p-3">13 бал</div>
            <div class="p-3">12 бал</div>
            <div class="p-3">Новинка</div>
        </div>
    </div>
</div>

<!--Роллы-->
<div class="container-lg rounded img-thumbnail">
    <div class="fs-6 ">
        <div class="d-flex flex-row justify-content-center">
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Большой Куш
                </div>
                <div class="rounded float-start img-thumbnail">
                    <img src="../../Images/анекдот.jpeg" width="300" alt="Тут должен быть анекдот)">
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Карты, деньги, 2 ствола
                </div>

                <div class="rounded float-start img-thumbnail">
                    <img src="../../Images/анекдот.jpeg" width="300" alt="Тут должен быть анекдот)">
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Рок-н-рольщик
                </div>

                <div class="rounded float-start img-thumbnail">
                    <img src="../../Images/анекдот.jpeg" width="300" alt="Тут должен быть анекдот)">
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Шерлок Холмс
                </div>

                <div class="rounded float-start img-thumbnail">
                    <img src="../../Images/анекдот.jpeg" width="300" alt="Тут должен быть анекдот)">
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Шерлок Холмс: Игра теней
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Агенты А.Н.К.Л.
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Джентльмены
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Гнев человеческий
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Операция фортуна
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Переводчик (не смотрел)
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Револьвер
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Меч короля Артура
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Славные парни
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Казино
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Остров проклятых
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Таксист
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
        </div>

        <div class="d-flex flex-row justify-content-start">
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Заводной апельсин
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    Спартак
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
            <div class=" p-3 w-25  ">
                <div class="text-start text-decoration-underline">
                    2001 год: Космическая одиссея
                </div>
                <div class="small">
                    Филадельфия, Кани Бонито, Бостон, Океан, Блек Черри, Вегас, Шиитаки, Эби темпура с манго. Всего 64 ролла (приборов на 6 персон)<br>
                    <b>  2350 г.  </b>
                </div>
                <hr>
                <div class="text-success">
                    <strong> 2800 ₽  </strong>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include("../.core/SushiBottom.php"); ?>

</body>
</html>

