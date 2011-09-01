<?php

define('DATEGROUP_FORMAT', 'YmdH'); // determines how sketches are batched
// DATEGROUP_FORMAT is duplicated in updates_controller.php

class FeedController extends AppController
{
    var $uses = array('Profile', 'Sketch');

    function atom()
    {
        $this->helpers[] = 'Gravatar';

        $now = time();
        $then = $now - (60 * 60 * 24 * 7); // one week

        $recent_sketches = $this->Sketch->find('all', array(
            'fields' => array(
                'Profile.*',
                'Sketch.*',
                'UNIX_TIMESTAMP(created) AS createdTime'
            ),
            'order' => 'Sketch.created DESC',
            'conditions' => array('Sketch.created >=' => date('Y-m-d', $then))
        ));

        $current_dategroup = date(DATEGROUP_FORMAT, $now);

        $last_updated = null;
        $groups = array();
        foreach ($recent_sketches as $sketch) {
            $dategroup = date(DATEGROUP_FORMAT, $sketch[0]['createdTime']);
            if ($dategroup == $current_dategroup) {
                continue;
            }
            if ($last_updated == null) {
                $last_updated = $sketch[0]['createdTime'];
            }
            if (isset($groups[$dategroup])) {
                $groups[$dategroup]['sketches'][] = $sketch;
            } else {
                $groups[$dategroup] = array(
                    'time' => $sketch[0]['createdTime'],
                    'sketches' => array($sketch)
                );
            }
        }

        $this->set('last_updated', $last_updated);
        $this->set('groups', $groups);
        $this->layout = null;
        header('Content-Type: application/atom+xml');
    }

}
