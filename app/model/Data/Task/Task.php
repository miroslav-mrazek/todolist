<?php

namespace Todolist;

use DateTime;


/**
 * @property Project  $project m:hasOne
 * 
 * @property int      $id
 * @property string   $title
 * @property string   $note
 * @property int      $priority
 * @property boolean  $done
 * @property DateTime $created
 */
class Task extends Entity
{
	
	/*
	 * Implementace rozhraní IResource
	 */
	public function getOwnerId()
	{
		return $this->project->user->id;
	}
	
	
	public function done()
	{
		$this->done = TRUE;
	}
	
	
	public function undone()
	{
		$this->done = FALSE;
	}
	
}
