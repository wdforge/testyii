<?php

class BookRepository extends AbstractRepository {

	public function __construct($config = []) {
		parent::__construct($config, 'BookItem');
	}

	public function getBooksLikeName() {

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


		$result = $this->findAll($params);
	}

}
