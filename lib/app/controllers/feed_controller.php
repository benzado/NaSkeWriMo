<?php

class FeedController extends AppController
{
	var $uses = array('Profile', 'Sketch');

    function atom()
    {
    	$recent_sketches = $this->Sketch->find('all', array(
    		'fields' => array('Profile.*', 'Sketch.*', 'UNIX_TIMESTAMP(created) AS createdTime'),
    		'order' => 'Sketch.created DESC',
    		'limit' => 50,
    	));
    	$this->set('last_updated', $recent_sketches[0][0]['createdTime']);
    	$this->set('recent_sketches', $recent_sketches);
    	$this->layout = null;
		header('Content-Type: application/atom+xml');
    }
   	
}
