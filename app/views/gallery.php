<div class="d-none comments row justify-content-center">
    <div class="form-control-feedback"></div>
    <div class=" mb-3">
        <form id="comments">
            <div class="mb-3">
                <label for="textcomment" class="form-label text">Оставьте комментарий</label>
                <textarea class="form-control" id="textcomment" rows="8" name="textcomment"></textarea>
                <textarea
                    hidden="hidden"
                    class=" form-control"
                    id="text_id_image"
                    name="text_id_image"></textarea>
            </div>
            <button type="submit" id="registr" class="col-12 btn btn-primary">Отправить</button>
        </form>
    </div>

</div>

<div class="d-none commentsDelete row justify-content-center">
    <div class="form-control-feedback"></div>
    <div class="mb-3">
        <form id="commentDelete">
            <div class=" mb-3">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="exampleCheck1"
                    name="checkbox">
                <label class="form-check-label text" for="exampleCheck1">Удалить</label>
            </div>
            <textarea
                hidden="hidden"
                class=" form-control"
                id="delete_id_image"
                name="delete_id_image"></textarea>
            <button type="submit" id="delete" class="col-12 btn btn-primary">Удалить</button>
        </form>
    </div>
</div>

<div class="row container containers pt-4">

    <div class="col-md-8 offset-md-4 form-control-feedback"></div>
    <form id="load" method="post" enctype="multipart/form-data">
        <div class="custom-file">
            <input
                type="file"
                class="form-control form-control-color "
                id="customFile"
                name="files[]"
                multiple="multiple"
                required="required">
            <label class="custom-file-label ml-5" for="customFile" data-browse="Выбрать"></label>
            <small class="form-text text-muted ">
                Максимальный размер файла:
                <?php echo UPLOAD_MAX_SIZE / 1000000; ?>Мб. Допустимые форматы:
                <?php echo implode(', ', ALLOWED_TYPES) ?>.
            </small>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary col-4">Загрузить</button>
        <a href='/galleryadd' class="btn btn-secondary ml-5 col-4">Сброс</a>
    </form>

    <button type="button" id="main" class=" col-4 btn btn-primary">На главную</button>
</div>