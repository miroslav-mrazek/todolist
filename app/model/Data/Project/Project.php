<?php

namespace Todolist;

use LeanModel\Entity;


/**
 * Entita reprezentující projekt
 * 
 * @property User   $user  m:hasOne
 * @property Task[] $tasks m:belongsToMany m:filter(undone)
 * 
 * @property int     $id
 * @property string  $title
 * @property string  $note
 * @property boolean $finishable
 */
class Project extends Entity
{
	
}
