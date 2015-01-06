<?php

error_reporting(-1);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$start = microtime(true);


include_once ('bc.class.php');
$cache=  bc::create('sl',10000);

// если файлу существует и время жизни кеша ещё не искекло
if ($cache->exists() and $cache->time_old()){
	$data= 'file_read='.$cache->read(); // получаем данные из кеша
}
else {
	// генерируем данные заново и заносим в кеш
	$data= '5345364';
	if ($cache->write ($data)){  //Записали

	}
	else {  //Не записали

	}
}
echo $data;

$end = microtime(true);
$runtime = $end - $start;
echo "<br/> Время выполнения php скрипта в микросекундах:". 10*round($runtime, 6) . " миллисекунд";




//var_dump($cache);
/*
echo '<br /><br /><br /><br />';
print_r (get_class_vars('bc'));
echo '<br /><br />';
print_r (get_class_methods('bc'));
*/
