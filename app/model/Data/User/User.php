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
class User extends Entity implements IRole
{
	
	/*
	 * Implementace rozhraní IResource
	 */
	public function getOwnerId()
	{
		return $this->id;
	}
	
	
	/*
	 * Implementace rozhraní IRole
	 */
	public function getId()
	{
		return $this->row->id;
	}
	
	
	/*
	 * Implementace rozhraní IRole
	 */
	public function getRoleId()
	{
		return 'user'; //return $this->role;
	}
	
}
