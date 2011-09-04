<?
class AppController extends Controller {
	var $components = array('RequestHandler');

	public function beforeFilter() {
		$this->set('isMobile', $this->RequestHandler->isMobile());
		return parent::beforeFilter();
	}
}
