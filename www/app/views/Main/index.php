<?
/**
 * @var $posts
 */
?>
<?foreach ($posts as $post):?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?=$post['title']?></h3>
        </div>
        <div class="panel-body">
            <?=$post['text']?>
        </div>
    </div>
<?endforeach;?>
<hr>
<div id="one_post">

</div>

<button id="send">Тест ajax</button>

<script>

    $('#send').on('click',function () {
        $.ajax({
            url: '/main/testAjax',
            method : 'POST',
            data : {'id' : 2},
            success : function (data) {
                $('#one_post').html(data);
            }
        })
    })

</script>