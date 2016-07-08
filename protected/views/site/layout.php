<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>TEST</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css"></link>
	<script type="text/javascript" src="/js/jquery.min.js"></script>

	<script>
		$(document).ready(function(){
			$('#formFindBook').submit(function(e){
				alert('submit');
			});

		});
/*
		$('#find_button').click(function(){
			alert('find')
		});

		$('#addtoorder_button').click(function(){
			alert('addtoorder_button')
		});


		$('#initorder_button').click(function(){
			alert('initorder_button')
		});
*/
	</script>

</head>

<body>
<h1>TEST</h1>
<table>
<tr>
<td>
	<form action="/api/find" method="post" id="formFindBook">
	<div id="find-form" class="form">
		<h2>Поиск</h2>
		<label for="author">Поиск по названию:</label><input type="text" id="book_name" name="findParams[book_name]"/><br/>
		<label for="book_author">Поиск по автору:</label><input type="text" id="findParams[book_author]"/><br/>
		<label for="book_so_author">Поиск по со-автору:</label><input type="text" id="findParams[book_so_author]"/>&nbsp;<button id="find_button">Искать</button>
	</div>
	</form>
</td>
<td>
	<div id="find-result" class="result"></div>
</td></tr>
<tr><td>
	<form action="/api/add-order" method="post">
	<div id="addtoorder-form" class="form">
		<h2>Добавление в заказ</h2>
		<label for="book_id">ID-книги:</label><input type="text" id="book_id"/><br/>
		<label for="book_count">Количество:</label><input type="text" id="orderAddParams[book_count]"/>&nbsp;<button id="addtoorder_button">Добавить</button>
	</div>
	</form>
</td>
<td>
	<div id="addtoorder-form" class="result"></div>
</td>
</tr>
<tr><td>
	<form action="/api/status-order" method="post">
	<div id="initorder-form" class="form">
		<h2>Оформить заказ</h2>
		<label for="book_order_id">Номер заказа:</label><input type="text" id="book_order_id"/>&nbsp;<button id="initorder_button">Оформить</button>
	</div>
	</form>
</td>
<td>
	<div id="initorder-form" class="result"></div>
</td>
</tr>
</table>
</body>
</html>