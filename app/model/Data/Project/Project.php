<?php

namespace Todolist;


/**
 * Entita reprezentující projekt
 * 
 * @property User   $user  m:hasOne
 * @property Task[] $tasks m:belongsToMany
 * 
 * @property int    $id
 * @property string $title
 */
class Project extends Entity
{
	
}
