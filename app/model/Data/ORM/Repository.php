<?php

namespace Todolist;

use LeanMapper\Repository as LeanRepository,
	LeanMapper\Entity,
	LeanMapper\Exception\InvalidValueException,
	Nette\Utils\Strings,
	BadMethodCallException;


/**
 * Provádí operace nad datovým zdrojem.
 */
abstract class Repository extends LeanRepository
{

	/**
	 * Vrátí záznam podle primárního klíče 'id'.
	 * 
	 * @param int|Entity $id
	 * @return Entity
	 * @throws InvalidValueException
	 */
	public function get($id)
	{
		return $this->getBy(['id' => $id]);
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
			$arrayOfLowerKeys = array_map('lcFirst', $arrayOfKeys);
			$arrayOfArgs = array_combine($arrayOfLowerKeys, $args);
			return call_user_func([$this, 'findBy'], $arrayOfArgs);
		}
		elseif (Strings::startsWith($method, 'getBy')) {
			$stringOfKeys = Strings::substring($method, 5);
			$arrayOfKeys = explode('And', $stringOfKeys);
			$arrayOfLowerKeys = array_map('lcFirst', $arrayOfKeys);
			$arrayOfArgs = array_combine($arrayOfLowerKeys, $args);
			return call_user_func([$this, 'getBy'], $arrayOfArgs);
		}
		else {
			$class = get_class($this);
			throw new BadMethodCallException("Call to undefined method $class::$method().");
		}
	}

}
