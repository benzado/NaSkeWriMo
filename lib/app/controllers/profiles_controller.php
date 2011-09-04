<?php

class ProfilesController extends AppController
{
	var $uses = array('Profile', 'Sketch');
    var $components = array('Session');

	
	function _current_year()
	{
		$month = date('n');
		$current_year = date('Y');
		if ($month < 8) {
			$current_year -= 1;
		}
		$this->set('current_year', $current_year);
		$this->set('all_years', range(2008, $current_year));
		return $current_year;
	}


	function edit($id)
	{
    	$current_profile = $this->Session->read('Profile');
    	if ($current_profile['id'] == $id) {
    		$current_profile['display_name'] = $this->data['Profile']['display_name'];
    		$current_profile['display_link'] = $this->data['Profile']['display_link'];
    		if ($this->Profile->save(array('Profile' => $current_profile))) {
				$this->Session->write('Profile', $current_profile);
				$this->Session->setFlash('Profile updated.');
			} else {
				$valErrs = join('<br />', $this->Profile->validationErrors);
				$this->Session->setFlash('Cannot update profile.<br />'.$valErrs);
			}
		}
		$this->redirect('/profiles/review/' . $current_profile['id']);
	}


	function review($id, $year = null)
	{
		$this->helpers[] = 'Gravatar';
		
		$current_year = $this->_current_year();
		if (empty($year)) {
			$year = $current_year;
		}
		$this->set('year', $year);
		
		$month = date('n');
		$this->set('show_add_form', $month == 9 || $month == 10);

    	$current_profile = $this->Session->read('Profile');
    	$review_profile = $this->Profile->findById($id);
    	$this->data['Profile'] = $review_profile['Profile'];
    	
    	$this->set('title_for_layout', 'NaSkeWriMo profile for ' . $review_profile['Profile']['display_name']);

    	$this->set('allow_changes', $current_profile['id'] == $id);

		$this->set('summary_day', date('F j'));

		if (empty($this->data['Profile']['display_link'])) {
			$this->set('summary_name_html', $this->data['Profile']['display_name']);
		} else {
			$this->set('summary_name_html', '<a href="'. $this->data['Profile']['display_link'] . '">' . $this->data['Profile']['display_name'] . '</a>');
		}
		
		$conditions = array(
			'Sketch.profile_id' => $id,
			'Sketch.created BETWEEN ? AND ?' => array($year.'-01-01', $year.'-12-31')
		);

    	$count_field = 'COUNT(*)';
    	$count_result = $this->Sketch->find('all', array(
			'conditions' => $conditions,
    		'fields' => array($count_field),
    		'recursive' => 0
    	));
    	$sketches_count = $count_result[0][0][$count_field];
    	if (empty($sketches_count)) {
	    	$this->set('summary_sketches_count', 0);
    	} else {
	    	$this->set('summary_sketches_count', $sketches_count);
	    }
    	
		$all_sketches = $this->Sketch->find('all', array(
			'conditions' => $conditions,
    		'order' => 'Sketch.created DESC'
    	));
    	$this->set('all_sketches', $all_sketches);
	}


	function index($year = null)
	{
		$this->helpers[] = 'Gravatar';

		$current_year = $this->_current_year();
		if (empty($year)) {
			// TODO: should redirect here
			$year = $current_year;
		}
		$this->set('year', $year);

    	$all_profiles = $this->Sketch->find('all', array(
    		'fields' => array('COUNT(*) AS Count', 'Profile.*'),
    		'order' => 'Profile.display_name',
    		'group' => array('Profile.id'),
    		'conditions' => array(
				'Sketch.created BETWEEN ? AND ?' => array($year.'-01-01', $year.'-12-31')
    		)
    	));
    	$this->set('all_profiles', $all_profiles);
	}

}
