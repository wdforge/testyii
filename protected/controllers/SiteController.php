<?php

class SiteController extends CController {

	public function actionIndex() {

		$this->render('layout', []);
	}
}
