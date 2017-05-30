<?
$user = \vendor\core\App::$app->user;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php \vendor\core\base\View::getMeta(); ?>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Korn framework</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?if ($user->isAuth()):?>
                    <li><a href="/pdt/index.php">Запуск фоновых</a></li>
                    <?endif;?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?if ($user->isAuth()):?>
                        <li><a href="#"><i class="glyphicon glyphicon-user"></i> <?=$user->getPerformance()?></a></li>
                        <li><a href="/user/logout/">Выйти</a></li>
                    <?else:?>
                        <li><a href="/user/login/">Войти</a></li>
                    <?endif;?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</header>
<div class="container">
    <?=$content?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/main.js"></script>

<?
//вывод скриптов
foreach ($scripts as $script) {
    echo $script;
}
?>

</body>
</html>