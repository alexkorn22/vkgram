<?php
include('inc/Stock.php');
include('inc/PseudoDaemon.class.php');

include_once $_SERVER['DOCUMENT_ROOT'] . '/public/front_contoller.php';

error_reporting(0);

define("PDT_ROOT_LINK", PDT_GetRootLink());
define("PDT_WORKING_DIR", dirname(__FILE__));

$PDT = new PseudoDaemon();

if(isset($_POST['handler']) && $_POST['handler']){
	if(is_file(PDT_WORKING_DIR.'/handlers/'.$_POST['handler'].'.php')){
		include(PDT_WORKING_DIR.'/handlers/'.$_POST['handler'].'.php');
	}else{
		PDT_HandleError('Handler <b>'.$_POST['handler'].'</b> not found');
	}
}elseif($_POST){
	PDT_HandleError('Неверный запрос');
}else{
	include(PDT_WORKING_DIR.'/media/templates/pdt_index.html');
}
?>