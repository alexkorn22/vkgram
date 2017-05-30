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
<!-- Форма регистрации -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" action="/user/reg/" method="POST">
            <!-- Login -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="" name="login" value="<?=$data['login']?>">
                </div>
            </div>
            <!-- EMAIL -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="" name="email" value="<?=$data['email']?>">
                </div>
            </div>
            <!-- PASSWORD -->
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="" name="password" value="<?=$data['password']?>">
                </div>
            </div>
            <!-- PASSWORD CONFIRM -->
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Подтверждение пароля</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="" name="password_confirm" value="<?=$data['password_confirm']?>">
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="do_registration">Регистрация</button>
                </div>
            </div>
        </form>
    </div>
</div>
