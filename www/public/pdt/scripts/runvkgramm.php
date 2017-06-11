<?php
/**
*	Объект для взаимодействия с консолью - $PDT
*	Список методов:
*	$PDT->	getScriptList()				- возвращает массив с информацией о всех скриптах, которые есть в PDT
*			getScriptRAM($script)		- возвращает кол-во используемой памяти скриптом
*			getScriptConsole($script) 	- возвращает массив строк консоли скрипта
*			getScriptProgress($script)  - возвращает прогресс выполнения скрипта (если в скрипте предусмотрено)
*			running()					- возвращает false, если пользователь принудительно остановил выполнение скрипта
*			wait($ms)					- задержка выполнения скрипта, изменяет статус скрипта на "спящий / ожидающий"
*			scriptIsRunning($script)	- возвращает true, если скрипт запущен
*			action()					- обновляет статус скрипта (если скрипт выполняется долгое время без вывода данных в консоль)
*			clearMemory()				- очищает файловую память текущего скрипта (удаляет все переменные, установленые через write)
*			truncate(true)				- остановить выполнение скрипта
*			display($text, $type='text')- вывести в консоль сообщение, типы: input, text, warning, error, fade, success, shutdown, startup
*			progress($coefficient)		- установить прогресс выполнения скрипта (от 0 до 1)
*			write($var, $value)			- записать в файловую переменную текстовое значение. можно записать в переменную другого скрипта: $var = 'script_name.var_name'
*			read($var)					- прочитать файловую переменную. можно прочитать переменную другого скрипта: $var = 'script_name.var_name'
*			input()						- возвращает ввод из консоли, false если ввода не было
*			getVariableList($script)	- получить список переменных скрипта
**/


$delay = 500;
$sec = 30;
$start = time();
$startAlerts = time();
$secAlerts = 15 * 60;
$PDT->display('start');
$mainController = new \app\controllers\MainController(\vendor\core\Router::getRoute());
while($PDT->running()){
    //execute
    if ((time() - $start) > $sec){
        $start = time();
        //$PDT->display('execute');
        $mainController->run();
    }
    //alerts
    if ((time() - $startAlerts) > $secAlerts){
        $startAlerts = time();
        $PDT->display('work');
    }
    $PDT->wait($delay);
}
