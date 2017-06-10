<?if ($data['id']):?>
    <h3>Изменение группы</h3>
<?else:?>
    <h3>Добавление группы</h3>
<?endif;?>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li>
                <a href="/profile/groups/"><i class="glyphicon glyphicon-arrow-left"></i> вернуться к списку</a>
            </li>
        </ol>

    </div>
</div>
<div class="row ">
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" action="/profile/addgroup/" method="POST">
            <!-- Наименование -->
            <div class="form-group">
                <label for="inputl" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputl" name="name" value="<?=$data['name']?>">
                </div>
            </div>
            <!-- Ссылка -->
            <div class="form-group">
                <label for="input2" class="col-sm-2 control-label">Ссылка на группу</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input2" placeholder="" name="link" value="<?=$data['link']?>">
                </div>
            </div>
            <!-- id_vk -->
            <div class="form-group">
                <label for="input3" class="col-sm-2 control-label">ID группы ВК</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input3" placeholder="" name="id_vk" value="<?=$data['id_vk']?>">
                </div>
            </div>
            <!-- chat_id_tg -->
            <div class="form-group">
                <label for="input4" class="col-sm-2 control-label">Чат Телеграм</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input4" placeholder="" name="chat_id_tg" value="<?=$data['chat_id_tg']?>">
                </div>
            </div>
            <!-- PASSWORD -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="notification" <?if ($data['notification'] != 0){echo 'checked';}?>> Получать оповещения от группы
                        </label>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" class="btn btn-primary" name="do_save_group">Сохранить</button>
                    <input type="hidden" class="form-control" placeholder="" name="id_profile" value="<?=$data['id_profile']?>">
                    <input type="hidden" class="form-control" placeholder="" name="id" value="<?=$data['id']?>">
                </div>
            </div>

            <!-- -->

        </form>
    </div>
</div>
