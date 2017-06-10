<h2>Профиль пользователя</h2>
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <?if(!empty($alerts)):?>
            <div class="alert alert-success" role="alert">
                <?foreach ($alerts as $alert):?>
                    <p><?= $alert?></p>
                <?endforeach;?>
            </div>
        <?endif;?>
    </div>
</div>

<!-- Форма профиля -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" action="/profile/" method="POST">
            <!-- Токен VK -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Токен ВК</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="" name="token_vk" value="<?=$data['token_vk']?>">
                </div>
            </div>
            <!-- Токен VK -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Чат Телеграм</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="" name="chat_id_tg" value="<?=$data['chat_id_tg']?>">
                </div>
            </div>
            <!-- PASSWORD -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="get_notification" <?if ($data['get_notification'] != 0){echo 'checked';}?>> Получать оповещения от групп
                        </label>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" class="btn btn-primary" name="do_save_profile">Сохранить</button>
                    <input type="hidden" class="form-control" placeholder="" name="user_id" value="<?=$data['user_id']?>">
                </div>
            </div>

            <!-- -->

        </form>
    </div>
</div>