<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <form action="" method="post">
            <?php if ($mode !== 3) { ?>
            <div class="form-group">
                <textarea class="form-control" name="text" id="" cols="30" rows="10"
                          placeholder="Введите текст здесь"></textarea>
                <?php } ?>
            </div>

            <div class="form-group">
                <input name="password" class="form-control" type="password" placeholder="Введите пароль">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary"><?= $button ?></button>
            </div>
        </form>
    </div>
</div>

