<?php

class ApiController extends ApiBaseController {

	public $defaultAction = 'index';

	// Пункт №1 - Получить перечень книг как результат поиска по названию, по автору, по соавторам.
	// Все параметры поиска передаются в виде ассоциированного массива, что дает некоторую универсальность метода.
	public function actionFind() {

		$findParams = Yii::app()->request->getQuery('findParams');

		$bookRepository = new BookRepository(
			Yii::app()->params->zend['db']
		);

		// возвращаем данные в виде JSON
		$this->renderJSON(
			$bookRepository->findByParams($findParams)
				->getArrayCopy()
		);
	}

	// Пункт №2 - Сформировать заказ (ID-книги, кол-во)
	public function actionSetOrder() {

		$orderAddParams = Yii::app()->request->getQuery('orderAddParams');

		$orderRepository = new OrderRepository(
			Yii::app()->params->zend['db']
		);

		// возвращаем данные в виде JSON
		$this->renderJSON(
			$orderRepository->newOrder($orderAddParams)
				->getArrayCopy()
		);
	}

	// Пункт №3 - Оформить заказ
	public function actionSetStatusOrder() {

		$orderAddParams = Yii::app()->request->getQuery('statusOrderParams');

		$orderRepository = new OrderRepository(
			Yii::app()->params->zend['db']
		);

		// возвращаем данные в виде JSON
		$this->renderJSON(
			$orderRepository->newOrder($orderAddParams)
				->getArrayCopy()
		);
	}

	// Метод возвращающий различные данные для заполнения формы
	public function actionIndex() {

		$bookRepository = new BookRepository(
			Yii::app()->params->zend['db']
		);

		$orderRepository = new OrderRepository(
			Yii::app()->params->zend['db']
		);

		$this->renderJSON([
			'books' => $bookRepository->getAll()->getArrayCopy(),
			'orders' => $orderRepository->getAll()->getArrayCopy(),
			'authors' => $bookRepository->getAllAuthors()->getArrayCopy()
		]);
	}

}
