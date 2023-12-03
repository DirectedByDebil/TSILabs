
<form action="../Pages/Import.php" method="post">
    <div class="container-sm text-center">
        <div class="d-inline-flex flex-column justify-content-sm-center w-50">
            <label for="fileURL">Вставьте ссылку на файл <br>
                <input type="url" class="p-1 w-50 align-self-center" name="fileURL" placeholder="Ссылка на файл"
                value="<?php echo WorkWithPostAndGet::GetPostData("fileURL");?>">
            </label>

            <label>Файл будет импортирован в формат .csv</label>
            <input class="p-1 w-25 align-self-center" type="submit" value="Импорт">
        </div>
    </div>
</form>
