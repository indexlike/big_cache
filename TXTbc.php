<?php

/**
 * Class TXTbc
 * Сохранение и считывание кеша из файлов
 */
class TXTbc extends bc {
	private $lifetime;
	private $key;
	private $kat;
	private $type;

	const BC_PATH='assets/cache/big_cache/';

	/**
	 * @param string $key Ключ кеша
	 * @param $lifetime int Время жизни кеша
	 * @param $kat string Категория - куш быдет сложен в такую папку
	 * @param $type string Тип кеша, по умолчанию файлы
	 */
	function __construct($key, $lifetime, $kat, $type){
		$this->kat=$kat;
		$this->key=$key.'.txt';
		$this->lifetime=$lifetime;
		$this->type=$type;
	}
	/**
	 * Проверяет существует ли файл
	 *
	 * @return boolean
	 */
	public function exists(){ // файл существует и годный
		//echo 'bb='.MODX_BASE_PATH;
		$file=MODX_BASE_PATH . self::BC_PATH .$this->kat.'/'. $this->key;
		if(file_exists($file)){ // Файл существует!
			$ret=true;
		}
		else{// Файла нет!
			$ret=false;
		}
		return $ret;
	}

	/**
	 * Вычисляет не просрочен ли файл
	 *
	 * @return boolean
	 */
	public function time_old(){
		$file=MODX_BASE_PATH . self::BC_PATH . $this->kat.'/'.$this->key;
		$time= filemtime ($file);
		if ( $time+$this->lifetime<time() ){
			return false;
		}
		else {
			return true;
		}
	}
	/**
	 * Сохранение данных в кеш
	 *
	 * @param $data string - Сохраняемые в кеш данные
	 *
	 * @return boolean
	 */
	public function write($data)
	{
		if ($this->folder_exists (MODX_BASE_PATH . self::BC_PATH . $this->kat)){
			$file=MODX_BASE_PATH . self::BC_PATH . $this->kat.'/'. $this->key;
			if(!$handle=fopen($file, 'w+')){
				$ret=false; // Не могу открыть файл
			} else{
				if(fwrite($handle, $data) === FALSE){
					$ret=false; // Не могу открыть файл
				} else{
					fclose($handle);
					$ret=true; //Ура! Записали в файл
				}
			}
		}
		else {$ret=false;}
		return $ret;
	}
	/**
	 * Считываение данных из кеша
	 *
	 * @return boolean
	 */
	public function read()
	{
		if ($this->folder_exists (MODX_BASE_PATH . self::BC_PATH . $this->kat)){
			$file=MODX_BASE_PATH . self::BC_PATH . $this->kat . '/' . $this->key;

			//echo $file.'<br />';
			//$fp=fopen($file, "r"); // Открываем файл в режиме чтения
			$fp=readfile($file);
			if($fp){
				//return $fp;
			} else{
				return FALSE;
			}
		}

	}

	/**
	 * Проверяет существование папки, если нету, то создает её
	 * @param $folder - пусть к папке
	 * @return bool
	 */
	private function folder_exists ($folder){
		if(file_exists($folder)){
			if(is_dir($folder)){
				return TRUE;
			} else{
				if(mkdir($folder, 0777)){
					return TRUE;
				} else{
					return FALSE;
				}
			}
		}
		else{
			if(mkdir($folder, 0777)){
				return TRUE;
			} else{
				return FALSE;
			}
		}
	}




}
