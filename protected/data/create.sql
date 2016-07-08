drop database testyii;
create database testyii;
use testyii;

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(45) DEFAULT NULL COMMENT 'Название книги',
  PRIMARY KEY (`book_id`)
) COMMENT = 'Книги' ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(45) DEFAULT NULL COMMENT 'Название автора',
  PRIMARY KEY (`author_id`)
) COMMENT = 'Авторы книг' ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `book_version` (
  `book_version_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL COMMENT 'Книга',
  `provider_id` int(11) DEFAULT NULL COMMENT 'Поставщик',
  `book_date` date DEFAULT NULL  COMMENT 'Дата (для наглядности)',
  PRIMARY KEY (`book_version_id`)
) COMMENT = 'Версии книг [издания]' ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `book_author` (
  `book_author_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL  COMMENT 'Книга',
  `author_id` int(11) DEFAULT NULL  COMMENT 'Автор',
  PRIMARY KEY (`book_author_id`)
) COMMENT = 'Связь автор - [версия - книга]' ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `provider_order` (
  `provider_order_id` INT NOT NULL AUTO_INCREMENT,  
  `book_version_id` INT NULL COMMENT 'Версия книги со стороны авторов',
  `provider_order_count` int(11) DEFAULT NULL COMMENT 'Количество в заказе',
  `order_id` int(11) DEFAULT NULL COMMENT 'Указатель на заказ клиента',
  `order_status_id` int(11) DEFAULT NULL COMMENT 'Статус заказа поставщика',
  PRIMARY KEY (`provider_order_id`))
COMMENT = 'Связь поставщик - [версия - книга]' ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `order` (
  `order_id` INT NOT NULL AUTO_INCREMENT,  
  `order_fio` VARCHAR(40) NULL COMMENT 'ФИО заказчика',
  `order_status_id` INT NULL COMMENT 'Статус заказа',
  `order_ts` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Метка времени',
  PRIMARY KEY (`order_id`))
COMMENT = 'Клиентские заказы' ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(45) DEFAULT NULL  COMMENT 'Название статуса',
  PRIMARY KEY (`order_status_id`)
) COMMENT = 'Статусы заказа' ENGINE=InnoDB DEFAULT CHARSET=utf8;

