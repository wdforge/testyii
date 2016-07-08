<?php

class BookRepository extends AbstractRepository {

	public function __construct($config = []) {
		parent::__construct($config, 'BookItem');
	}

	public function getAll() {

		$this->setEntityClass('BookItem');
		return $this->findByParams([]);
	}

	// По хорошему у авторов должен быть свой репозиторий
	// Но в тестовом проекте можем нарушить концепцию
	public function getAllAuthors() {

		$this->setEntityClass('AuthorItem');

		$params = [
			'table' => ['authors'],
		];

		return $this->findAll($params);
	}

	public function findByParams($findParams) {

		$this->setEntityClass('BookItem');

		$params = [

			'table' => ['b' => 'book'],
			'join' => [
				[
					['bv' => 'book_version'],
					'b.book_id = bv.book_id',
					['book_version_id', 'book_date']
				],
				[
					['pv' => 'provider'],
					'pv.provider_id = bv.provider_id',
					['provider_name'],
				],
				[
					['ba' => 'book_author'],
					'ba.book_id = b.book_id',
					['book_id'],
				],
				[
					['a' => 'author'],
					'ba.author_id = a.author_id',
					['author_id'],
				],
			],
		];

		if(isset($findParams['book_name'])) {
			$params['where'][] = 'b.book_name = "%'.strval($findParams['book_name']).'%"';
		}

		if(isset($findParams['author_id'])) {
			$params['where'][] = 'a.author_id in ('.implode(',', $findParams['author_id']).')';
		}

		return $this->findAll($params);
	}

}
