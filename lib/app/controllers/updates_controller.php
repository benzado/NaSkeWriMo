<?php

class UpdatesController extends AppController
{
	var $uses = array('Profile', 'Sketch');
    var $components = array('Session', 'Email');


    function home()
    {
    	$this->set('title_for_layout', 'National Sketch Writing Month');

		$this->helpers[] = 'Gravatar';

    	$current_profile = $this->Session->read('Profile');
    	$this->set('current_profile', $current_profile);
    	$this->data['Profile'] = $current_profile;

		$month = date('n');
		$year = date('Y');

		$result = $this->Sketch->find('all', array(
			'fields' => array('COUNT(DISTINCT Sketch.profile_id) AS count'),
			'conditions' => array('YEAR(Sketch.created)' => $year),
			'recursive' => -1,
		));
		$people_count = $result[0][0]['count'];
    	$this->set('summary_people_count', $people_count);
    	
		if ($month < 9) {
			$this->set('summary_mode', -1);
			$this->set('summary_days_left', date('z', mktime(0,0,0,9,1)) - date('z'));
		} else {
			$this->set('summary_mode', ($month == 9) ? 0 : 1);
			$this->set('summary_day', date('F j, Y'));
	
			$sketches_count = $this->Sketch->find('count', array(
				'conditions' => array('YEAR(Sketch.created)' => $year),
				'recursive' => -1,
			));
			if (empty($sketches_count)) {
				$this->set('summary_sketches_count', 0);
			} else {
				$this->set('summary_sketches_count', $sketches_count);
			}

			if ($current_profile) {
				$your_sketches_count = $this->Sketch->find('count', array(
					'conditions' => array(
						'Sketch.profile_id' => $current_profile['id'],
						'YEAR(Sketch.created)' => $year
					),
					'recursive' => -1,
				));
				if (empty($your_sketches_count)) {
					$this->set('your_sketches_count', 0);
				} else {
					$this->set('your_sketches_count', $your_sketches_count);
				}
			}
    	}
    	
    	$all_recent_updates = $this->Sketch->find('all', array(
            'fields' => array(
                'Sketch.*',
                'Profile.*',
                'UNIX_TIMESTAMP(Sketch.created) AS createdTime'
            ),
    		'order' => 'Sketch.created DESC',
    		'limit' => 20
    	));
    	$this->set('all_recent_updates', $all_recent_updates);

		if ($month < 9) {
			$year -= 1;
		}
		$this->set('year', $year);

    	$top_writers = $this->Sketch->find('all', array(
    		'fields' => array('COUNT(*) AS Count', 'Profile.*'),
    		'recursive' => 0,
    		'group' => array('Sketch.profile_id'),
    		'order' => 'Count DESC',
    		'limit' => 20,
    		'conditions' => array(
    			'Sketch.created BETWEEN ? AND ?' => array($year.'-09-01', $year.'-10-01')
			)
    	));
    	$this->set('top_writers', $top_writers);
	}

	function hour($group_key)
	{
        $this->helpers[] = 'Gravatar';

        $matches = array();
        $r = preg_match(
            '/^(\d{4})(\d{2})(\d{2})(\d{2})$/', $group_key, $matches
        );
        if ($r == 0) {
            return; // error!
        }
        $year = $matches[1];
        $month = $matches[2];
        $day = $matches[3];
        $hour = $matches[4];
        $datetime = mktime(
            $hour,
            0,
            0,
            $month,
            $day,
            $year
        );
        $sketches = $this->Sketch->find('all', array(
            'fields' => array(
                'Sketch.*',
                'Profile.*',
                'UNIX_TIMESTAMP(Sketch.created) AS createdTime'
            ),
            'order' => 'Sketch.created ASC',
            'conditions' => array(
                'Sketch.created >=' => date('Y-m-d H:00:00', $datetime),
                'Sketch.created <=' => date('Y-m-d H:59:59', $datetime),
            )
        ));
        $this->set('sketches', $sketches);
        $this->set('datetime', $datetime);
    }
   	
}
