<?php

namespace Todolist;


/**
 * Entita reprezentující seznam úkolů
 * 
 * @property User   $user  m:hasOne
 * @property Task[] $tasks m:belongsToMany
 * 
 * @property int    $id
 * @property string $title
 */
class Catalog extends Entity
{
	
}
