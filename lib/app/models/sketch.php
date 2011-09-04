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
    		'allowEmpty' => true,
			),
			'title' => array(
				'rule' => '/^[^"].*[^"]$/i',
				'message' => 'Title cannot start or end with quotes',
				'allowEmpty' => true
			)
    );
}
