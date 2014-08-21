<?php

namespace Todolist;

use LeanMapper\Filtering,
	LeanMapper\Fluent;


/**
 * Entita reprezentující projekt
 * 
 * @property User   $user  m:hasOne
 * @property Task[] $tasks m:belongsToMany m:filter(undone)
 * 
 * @property-read int $tasksCount m:useMethods
 * 
 * @property int     $id
 * @property string  $title
 * @property string  $note
 * @property boolean $finishable
 */
class Project extends Entity
{
	
	/*
	 * Implementace rozhraní IResource
	 */
	public function getOwnerId()
	{
		return $this->user->id;
	}
	
		
	public function getTasksCount()
	{
		$rows = $this->row->referencing('task', 'project_id', new Filtering(function (Fluent $statement) {
			$statement->removeClause('select')->select('COUNT(*) [count], [project_id]')
				->where(['done' => FALSE])
				->groupBy(['project_id']);
			}));
		return empty($rows) ? 0 : reset($rows)->count;
	}
	
}
