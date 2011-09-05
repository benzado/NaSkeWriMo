<?php
class AppModel extends Model {
		function beforeSave($options) {
			foreach($this->data[$this->name] as $key=>$value) {
				$this->data[$this->name][$key] = trim($value);
			}
			return true;
		}
}
