<?php

class Sketch extends AppModel
{
	var $name = 'Sketch';
	var $scaffold;
    var $belongsTo = array('Profile');
    
    var $validate = array(
    	'url' => array(
    		'rule' => array('url', true),
    		'message' => 'Link must be a valid URL, e.g. http://example.com/sketch.html',
    		'allowEmpty' => true
		)
    );
    
    function beforeValidate()
    {
    	// If user surrounded title with double quotes, remove them.
    	$proposed_title = $this->data['Sketch']['title'];
    	$pattern = '/^["\x{201c}\x{201d}](.+)["\x{201c}\x{201d}]$/u';
    	if (preg_match($pattern, $proposed_title, $m) > 0) {
    		$this->data['Sketch']['title'] = $m[1];
    	}
    	return true;
    }

		function findYearsWithSketches($profile_id) {
			return $this->find('all', array(
				'fields' => array(
					'YEAR(Sketch.created) as Year',
					'COUNT(Sketch.id) as `NumSketches`'
				),
				'group' => 'YEAR(Sketch.created)',
				'conditions' => array(
					'Sketch.profile_id' => $profile_id
				),
				'order' => array('Sketch.created' => 'ASC')
			));
		}
}
