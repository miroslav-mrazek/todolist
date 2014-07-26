<?php

namespace Todolist;

use DateTime;


/**
 * @property Project  $project m:hasOne
 * 
 * @property int      $id
 * @property string   $text
 * @property boolean  $done
 * @property DateTime $created
 */
class Task extends Entity
{
	
}
