<?php

namespace Todolist;


/**
 * Entita reprezentující uživatele
 * 
 * @property Thing[]   $things m:belongsToMany
 * @property Project[] $projects m:belongsToMany
 * 
 * @property int       $id
 * @property string    $email
 * @property string    $password
 * @property string    $name
 */
class User extends Entity
{
	
}
