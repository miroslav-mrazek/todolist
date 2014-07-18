<?php

namespace Todolist;

use LeanMapper\Repository as LeanRepository,
	LeanMapper\Entity,
	LeanMapper\Exception\InvalidValueException,
	Nette\Utils\Strings,
	Nette;


/**
 * Provádí operace nad datovým zdrojem.
 */
abstract class Repository extends LeanRepository
{

	/**
	 * Z pole výsledků vytvoří Collection
	 * 
	 * @param array $entites
	 * @return Collection
	 */
	protected function createCollection(array $entites)
	{
		return Collection::from($entites);
	}


	/**
	 * Vrátí záznam podle primárního klíče 'id'.
	 * 
	 * @param int|Entity $id
	 * @return Entity
	 * @throws InvalidValueException
	 */
	public function get($id)
	{
		if ($id instanceof Entity) {
			$id = $id->id;
		}

		$row = $this->connection->select('*')
			->from($this->getTable())
			->where('id = %i', $id)
			->fetch();

		if ($row === FALSE) {
			throw new InvalidValueException('Nepodařilo se získat data z databáze.', 404);
		}

		return $this->createEntity($row);
	}


	/**
	 * Vrátí právě jeden záznam podle podmínky.
	 * 
	 * @param string $by Podmínka
	 * @return Entity
	 * @throws InvalidValueException
	 */
	public function getBy($by)
	{
		$rows = $this->connection->select('*')
			->from($this->getTable())
			->where($by)
			->fetchAll();

		if (count($rows) === 1) {
			return $this->createEntity($rows[0]);
		}
		elseif (count($rows) > 1) {
			throw new InvalidValueException('Databáze vrátila více záznamů.');
		}
		else {
			throw new InvalidValueException('Nepodařilo se získat data z databáze.', 404);
		}
	}


	/**
	 * Vrátí kolekci všech entit.
	 * 
	 * @return Collection
	 */
	public function findAll()
	{
		$entities = $this->connection->select('*')
			->from($this->getTable())
			->fetchAll();

		return $this->createEntities($entities);
	}


	/**
	 * Vrátí kolekci entit podle podmínky.
	 * 
	 * @param array $by Podmínka
	 * @return Collection
	 */
	public function findBy($by)
	{
		$entities = $this->connection->select('*')
			->from($this->getTable())
			->where($by)
			->fetchAll();

		return $this->createEntities($entities);
	}


	/**
	 * Umožňuje volání metod getByFoo('foo') a findByFooAndBar('foo', 'bar').
	 * 
	 * @param string $method
	 * @param mixed  $args
	 * @return Entity|Collection
	 */
	public function __call($method, $args)
	{
		if (Strings::startsWith($method, 'findBy')) {
			$stringOfKeys = Strings::substring($method, 6);
			$arrayOfKeys = explode('And', $stringOfKeys);
			$arrayOfLowerKeys = array_map('self::firstLower', $arrayOfKeys);
			$arrayOfArgs = array_combine($arrayOfLowerKeys, $args);
			return call_user_func(array($this, 'findBy'), $arrayOfArgs);
		}
		elseif (Strings::startsWith($method, 'getBy')) {
			$stringOfKeys = Strings::substring($method, 5);
			$arrayOfKeys = explode('And', $stringOfKeys);
			$arrayOfLowerKeys = array_map('self::firstLower', $arrayOfKeys);
			$arrayOfArgs = array_combine($arrayOfLowerKeys, $args);
			return call_user_func(array($this, 'getBy'), $arrayOfArgs);
		}
		else {
			return Nette\ObjectMixin::call($this, $method, $args);
		}
	}


	/**
	 * Převede první znak na malé písmeno
	 * @todo: Tahle funkce by se měla přidat do Nette
	 * 
	 * @param  string  UTF-8 encoding
	 * @return string
	 */
	private static function firstLower($s)
	{
		return Strings::lower(Strings::substring($s, 0, 1)) . Strings::substring($s, 1);
	}

	
	
	#========== Zajištění kompatibilního chování s Nette\Object ===============#


	/**
	 * Access to reflection.
	 * @return Nette\Reflection\ClassType
	 */
	public static function getReflection()
	{
		return new Nette\Reflection\ClassType(get_called_class());
	}

	
//	/**
//	 * Call to undefined method.
//	 * @param  string  method name
//	 * @param  array   arguments
//	 * @return mixed
//	 * @throws Nette\MemberAccessException
//	 */
//	public function __call($name, $args)
//	{
//		return Nette\ObjectMixin::call($this, $name, $args);
//	}


	/**
	 * Call to undefined static method.
	 * @param  string  method name (in lower case!)
	 * @param  array   arguments
	 * @return mixed
	 * @throws Nette\MemberAccessException
	 */
	public static function __callStatic($name, $args)
	{
		return Nette\ObjectMixin::callStatic(get_called_class(), $name, $args);
	}


	/**
	 * Adding method to class.
	 * @param  string  method name
	 * @param  callable
	 * @return mixed
	 */
	public static function extensionMethod($name, $callback = NULL)
	{
		if (strpos($name, '::') === FALSE) {
			$class = get_called_class();
		}
		else {
			list($class, $name) = explode('::', $name);
			$rc = new \ReflectionClass($class);
			$class = $rc->getName();
		}
		if ($callback === NULL) {
			return Nette\ObjectMixin::getExtensionMethod($class, $name);
		}
		else {
			Nette\ObjectMixin::setExtensionMethod($class, $name, $callback);
		}
	}


	/**
	 * Returns property value. Do not call directly.
	 * @param  string  property name
	 * @return mixed   property value
	 * @throws Nette\MemberAccessException if the property is not defined.
	 */
	public function &__get($name)
	{
		return Nette\ObjectMixin::get($this, $name);
	}


	/**
	 * Sets value of a property. Do not call directly.
	 * @param  string  property name
	 * @param  mixed   property value
	 * @return void
	 * @throws Nette\MemberAccessException if the property is not defined or is read-only
	 */
	public function __set($name, $value)
	{
		return Nette\ObjectMixin::set($this, $name, $value);
	}


	/**
	 * Is property defined?
	 * @param  string  property name
	 * @return bool
	 */
	public function __isset($name)
	{
		return Nette\ObjectMixin::has($this, $name);
	}


	/**
	 * Access to undeclared property.
	 * @param  string  property name
	 * @return void
	 * @throws Nette\MemberAccessException
	 */
	public function __unset($name)
	{
		Nette\ObjectMixin::remove($this, $name);
	}

}
