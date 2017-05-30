<?
/**
 * @var array $data
 * @var array $errors
 * */
?>
<!-- Вывод ошибок -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <?if(!empty($errors)):?>
            <div class="alert alert-danger" role="alert">
                <?foreach ($errors as $error):?>
                    <p><?= $error?></p>
                <?endforeach;?>
            </div>
        <?endif;?>
    </div>
</div>
<!-- Форма авторизации -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" action="/user/login/" method="POST">
            <!-- Login -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="" name="login" value="<?=$data['login']?>">
                </div>
            </div>
            <!-- PASSWORD -->
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="" name="password" value="<?=$data['password']?>">
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" class="btn btn-primary" name="do_login">Войти</button>
                </div>
                <div class="col-sm-2">
                    <a href="/user/reg/" class="btn btn-default">Регистрация</a>
                </div>
            </div>

            <!-- -->

        </form>
    </div>
</div>