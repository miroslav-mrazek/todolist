<?php

namespace Todolist;


final class InboxPresenter extends SecuredPresenter
{
	
	use TInjectThingRepository;
	use TInjectThingFormFactory;
	
	public function renderList()
	{
		$this->template->things = $this->userEntity->things;
	}
	
	
	/**
	 * Signál, který smaže záležitost
	 * 
	 * @param int $thingId
	 */
	public function handleDelete($thingId)
	{
		$this->thingRepository->delete($thingId);
		$this->redirect('this');
	}
	
	
	/**
	 * @return ProjectForm
	 */
	public function createComponentThingForm()
	{
		$form = $this->thingFormFactory->create($this->user->id);
		$form->onSuccess[] = function() {
			$this->redirect('this');
		};
		return $form;
	}

}
