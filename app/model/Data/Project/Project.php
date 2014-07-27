<?php

namespace Todolist;


/**
 * Entita reprezentující projekt
 * 
 * @property User   $user  m:hasOne
 * @property Task[] $tasks m:belongsToMany
 * 
 * @property int     $id
 * @property string  $title
 * @property string  $note
 * @property boolean $finishable
 */
class Project extends Entity
{
	
}
