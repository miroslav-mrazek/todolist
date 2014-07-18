<?php

namespace Todolist;


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
