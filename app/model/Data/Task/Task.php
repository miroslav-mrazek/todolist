<?php

namespace Todolist;

use DateTime;


/**
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
