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
					'ba.book_id = bv.book_id',
					[],
				],
				[
					['a' => 'author'],
					'ba.author_id = a.author_id',
					['author_id'],
				],
			],
			'group'=>[
				'b.book_name', 'bv.book_date'
			],
		];

		if(!empty($findParams['book_name'])) {
			$params['where'][] = 'b.book_name like "%'.$findParams['book_name'].'%"';
		}

		if(!empty($findParams['author_name'])) {
			$params['where'][] = 'a.author_name like "%'.$findParams['author_name'].'%"';
		}

		return $this->findAll($params);
	}

}
