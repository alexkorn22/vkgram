<?
/**
 * @var array group $data
 * */
?>
<!--Шапка страницы-->
<ul class="nav nav-tabs">
    <li role="presentation" ><a href="/profile/">Профиль</a></li>
    <li role="presentation" class="active"><a href="/profile/groups/">Группы ВК</a></li>
</ul>

<div class="row">
    <div class="col-md-12">
        <a href="/profile/addgroup/" class="btn btn-primary">Добавить группу</a>
    </div>
</div>

<!--Таблица групп-->
<table class="table table-hover">
    <thead>
        <tr>
            <th>Название</th>
            <th>Ссылка</th>
            <th>ID</th>
            <th>Уведомления</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?foreach ($data as $group): ?>
            <tr>
                <td><?=$group->name?></td>
                <td><a href="<?=$group->link?>" target="_blank"><?=$group->link?></a></td>
                <td><?=$group->id_vk?></td>
                <td><?if ($group->notification):?><span class="glyphicon glyphicon-ok"></span><?endif;?> </td>
                <td>
                    <a class="btn btn-primary" href=""><i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn btn-danger" href=""><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
        <?endforeach;?>
    </tbody>
</table>