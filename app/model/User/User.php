<?php

/**
 * TODOLIST
 * Školní projekt k seznámení s Nette a ORM
 * 
 * @author MMR <miroslav.mrazek@gmail.com>
 */

namespace Todolist\Model;


/**
 * Entita reprezentující uživatele
 * 
 * @property Catalog[] $catalogs m:belongsToMany
 * 
 * @property int       $id
 * @property string    $username
 * @property string    $password
 * @property string    $name
 * @property string    $role
 */
class User extends Entity
{
	
}
