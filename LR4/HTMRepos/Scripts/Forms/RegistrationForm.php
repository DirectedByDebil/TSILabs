<?php

$rg = new WorkWithRegistration();
?>


<!--Форма-->
<form action="Registration.php" method="post">

    <div class="container-lg text-center img-thumbnail text-bg-dark ">
        <div class="fs-6 ">
            <div class="d-inline-flex flex-column justify-content-sm-center rounded w-25">
                <div class="p-1 text-warning align-self-center "><?php $rg->CheckEssentials();?> </div>
                <div class="p-1">
                    <label for="login">Логин (email)</label>
                    <input type="email" name="login" id="login" placeholder="Логин или адрес электронной почты" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("login");?>" > </div>
                <div class="p-1">
                    <label for="password1">Пароль</label>
                    <input type="password" name="password1" id="password1" placeholder="Пароль" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("password1");?>" > </div>
                <div class="p-1">
                    <label for="password2">Пароль (Повторно)</label>
                    <input type="password" name="password2" id="password2" placeholder="Пароли должны совпадать" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("password2");?>" > </div>
                <div class="p-1">
                    <label for="fio">ФИО</label>
                    <input type="text" name="fio" id="fio" placeholder="ФИО полностью" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("fio");?>" > </div>
                <div class="p-1">
                    <label for="dateOfBirth">Дата рождения</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth" placeholder="dd-mm-yyyy" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("dateOfBirth");?>"> </div>
                <div class="p-1">
                    <label for="address">Адрес</label>
                    <input type="text" name="address" id="address" placeholder="Адрес" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("address");?>" > </div>
                <div class="p-1">
                    <label for="sex">Пол</label>
                    <select name="sex" id="sex">
                        <?php
                        $selectedSex = WorkWithPostAndGet::GetPostData("sex");;
                        ?>
                        <option value="M" <?php if( $selectedSex === "M") echo "selected" ?> >Мальчик</option>
                        <option value="F" <?php if( $selectedSex === "F") echo "selected" ?>>Девочка</option>
                    </select>
                </div>
                <div class="p-1">
                    <label for="hobby">Увлечения</label>
                    <textarea name="hobby" id="hobby" placeholder="Интересы" class="w-100" rows="4" cols="40"><?php echo WorkWithPostAndGet::GetPostData("hobby");?></textarea>
                </div>
                <div class="p-1">
                    <label for="url">Ссылка на профиль вк</label>
                    <input type="url" name="url" id="url" placeholder="Ссылка на профиль вк" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("url");?>"> </div>
                <div class="p-1">
                    <label for="bloodType">Группа крови</label>
                    <input type="text" name="bloodType" id="bloodType" placeholder="Группа крови" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("bloodType");?>"> </div>
                <div class="p-1">
                    <label for="rezus">Резус-фактор</label>
                    <input type="text" name="rezus" id="rezus" placeholder="Резус-фактор" class="w-100" value="<?php echo WorkWithPostAndGet::GetPostData("rezus");?>" > </div>

                <div class="p-1">
                    <input type="submit" value="Создать аккаунт)">
                </div>

                <div class="pb-3">
                    <div class="p-1 text-bg-light rounded-3">
                        <a href="Authorization.php">Авторизоваться</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>

