<?php
include_once ('TXTbc.php');

abstract class bc
{
	/**
	 * Создает экземпляр класса на основе его типа
	 *
	 * @param string $key Ключ кеша
	 * @param $lifetime int Время жизни кеша
	 * @param $kat string Категория - куш быдет сложен в такую папку
	 * @param $type string Тип кеша, по умолчанию файлы
	 *
	 * @return boolean
	 */
	static public function create ($key, $lifetime=10, $kat='default', $type='file')
	{
		if ($type=='file') {
			return new TXTbc($key, $lifetime, $kat, $type);
		}
	}

	/**
	 * Проверяет существует ли файл
	 *
	 * @return boolean
	 */
	abstract function exists();

	/**
	 * Вычисляет не просрочен ли файл
	 *
	 * @return boolean
	 */
	abstract function time_old();

	/**
	 * Сохранение данных в кеш
	 *
	 * @param $data string - Сохраняемые в кеш данные
	 *
	 * @return boolean
	 */
	abstract function write($data);

	/**
	 * Считываение данных из кеша
	 *
	 * @return boolean or string
	 */
	abstract function read();
}

