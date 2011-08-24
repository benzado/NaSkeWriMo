<?php

class Profile extends AppModel
{
	var $name = 'Profile';
	var $displayField = 'display_name';
	var $scaffold;
    var $hasMany = array('Sketch');
    
    var $validate = array(
    	'email_address' => array(
    		'rule' => 'email',
    		'required' => true,
    		'allowEmpty' => false,
    		'on' => 'create',
    	),
    	'display_name' => array(
    		'rule' => array('minLength', 2),
    		'allowEmpty' => false,
    	),
    	'display_link' => array(
    		'rule' => 'url',
    		'allowEmpty' => true,
    	),
    );
    
    function image_url() {
    	// see http://en.gravatar.com/site/implement/url
    	$prefix = 'http://www.gravatar.com/avatar/';
    	$hash = md5(strtolower($this['Profile']['email_address']));
//  	$size = 80;
//    	$default_url = urlencode(null);
    	return $prefix . $hash . '.jpg'
    		// . '&s=' . $size 
    		// . '&d=' . $default_url
    		;
    }
    
}
