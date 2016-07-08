<?php

class ApiBaseController extends CController {

	public $layout = false;
	public $format = 'json';

	public function behaviors() {
		ob_clean();
		header('Content-type: application/json');
		return parent::behaviors();
	}

	/**
	 * Возвращает JSON данные и останавливает приложение.
	 * @param array $data
	 */
	protected function renderJSON($data) {
		echo CJSON::encode($data);
		Yii::app()->end();
	}

}
