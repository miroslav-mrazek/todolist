<?php

namespace Todolist;

use DateTime;


/**
 * Entita reprezentující úkol
 * 
 * @property Catalog  $catalog m:hasOne
 * 
 * @property int      $id
 * @property string   $text
 * @property boolean  $done
 * @property DateTime $created
 */
class Task extends Entity
{
	
}
