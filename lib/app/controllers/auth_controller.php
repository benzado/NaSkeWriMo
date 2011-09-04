<?php
class AuthController extends AppController
{
	var $name = 'Auth';
	var $uses = array('Profile');
	var $components = array('Session', 'Email');

	function login()
	{
		if (!empty($this->data)) {
			$email_address = $this->data['email_address'];
			$passcode = $this->data['passcode'];
			
			$someone = $this->Profile->findByEmailAddress($email_address);
			if (!empty($someone['Profile']['passcode']) && $someone['Profile']['passcode'] == $passcode) {
				$this->Session->write('Profile', $someone['Profile']);
				$this->redirect('/profiles/review/' . $someone['Profile']['id']);
			} else {
				$this->Session->setFlash('Incorrect email or passcode.');
			}
		}
	}
	
	function logout()
	{
		$this->Session->delete('Profile');
		$this->redirect('/');
	}
	
	function _send_passcode($someone) 
	{
		$this->Email->to = $someone['Profile']['email_address'];
		$this->Email->subject = 'Your NaSkeWriMo Passcode'; 
		$this->Email->from = 'NaSkeWriMoBot <naskewrimobot@benzado.com>';
		$this->Email->bcc = array('naskewrimobot@benzado.com');
		$this->Email->sendAs = 'text'; // or html or both
		$body = array(
			'Hello ' . $someone['Profile']['display_name'] . ',',
			'',
			'Your passcode is ' . $someone['Profile']['passcode'] . '.',
			'',
			'Sincerely,',
			'The NaSkeWriMoBot',
			'http://www.naskewrimo.org/',
		);
		return $this->Email->send($body);
	}
	
	function _generate_passcode()
	{
		$passcode = '';
		while (strlen($passcode) < 4) {
			$passcode .= strval(rand(0,9));
		}
		return $passcode;
	}
	
	function passcode()
	{
		if (!empty($this->data)) {
			$email_address = $this->data['email_address'];
			
			$someone = $this->Profile->findByEmailAddress($email_address);
			if (empty($someone)) {
				$at_index = strpos($email_address, '@');
				$passcode = $this->_generate_passcode();
				$display_name = substr($email_address, 0, $at_index);
				$someone = array(
					'Profile' => array(
						'email_address' => $email_address,
						'passcode' => $passcode,
						'display_name' => $display_name,
					)
				);
				if (! $this->Profile->save($someone)) {
					$this->Session->setFlash('Please enter a valid email address.');
					return;
				}
			}

			// send an email
			if ($this->_send_passcode($someone)) {
				$this->Session->setFlash('A passcode has been sent to your email address.'); 
				$this->redirect('login');
			} else {
				$this->Session->setFlash('We tried to email you but there was an error.'); 
			}
		}
	}

}
