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

}
