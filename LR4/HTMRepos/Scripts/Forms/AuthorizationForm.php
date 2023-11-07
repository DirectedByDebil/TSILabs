<?php
$authorization = new WorkWithAuthorization();
?>


<!--Форма-->
<form action="Authorization.php" method="post">

    <div class="container-lg text-center img-thumbnail text-bg-dark ">
        <div class="fs-6 ">
            <div class="d-inline-flex flex-column justify-content-sm-center rounded">
                <div class="text-warning"> <?php $authorization->GetWarning();?> </div>
                <div class="p-1">
                    <label for="login">Логин (email)</label>
                    <input type="email" name="login" id="login" placeholder="Логин или адрес электронной почты" class="w-100" autocomplete="on"
                           value="<?php echo WorkWithPostAndGet::GetPostData("login");?>" > </div>
                <div class="p-1">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="Пароль" class="w-100"
                           value="<?php echo WorkWithPostAndGet::GetPostData("password");?>" > </div>

                <div class="pb-3">
                    <div class="p-1">
                        <input type="submit" value="Зайти)">
                    </div>

                    <div class="p-1 text-bg-light rounded-3">
                        <a href="Registration.php">Зарегистрироваться</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>

