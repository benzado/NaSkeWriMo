<?php

class SketchesController extends AppController
{
	var $uses = array('Profile', 'Sketch');
    var $components = array('Session', 'Email');
    

	function add()
	{
    	$current_profile = $this->Session->read('Profile');
    	if (empty($current_profile)) {
            $this->redirect('/auth/login');
            exit();
    	}
    	
		$this->data['Sketch']['profile_id'] = $current_profile['id'];
		if ($this->Sketch->save($this->data)) {
			$this->Session->setFlash('Sketch count updated.');
    	} else {
			$valErrs = join('<br />', $this->Sketch->validationErrors);
			$this->Session->setFlash('Cannot update sketch count.<br />'.$valErrs);
		}
		$this->redirect('/profiles/review/' . $current_profile['id']);
	}
	
	
	function delete($id)
	{
    	$current_profile = $this->Session->read('Profile');
    	if (empty($current_profile)) {
            $this->redirect('/auth/login');
            exit();
    	}

		$sketch = $this->Sketch->findById($id);
		if (empty($sketch)) {
            $this->redirect('/');
            exit();
		}
		
		if ($current_profile['id'] == $sketch['Sketch']['profile_id']) {
			$this->Sketch->id = $id;
			$this->Sketch->delete();
		}
		
		$this->redirect('/profiles/review/' . $current_profile['id']);
	}
	
}
