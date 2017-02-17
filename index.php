<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h1 class="title">Новини</h1>
			</div>
			<div class="col-md-6">
				<h1 class="title"></h1>
			</div>
			<div class="col-md-3">
				<button class="btn btn-success btn-lg button-update" onclick="fync();">
					Оновити
				</button>
			</div>
		
	</header>
	<section>
		<div class="container">
			<div id="news-block" class="news">
				<?php 
			        #массив заголовков новостей
			        $head = [
			            ['title' => 'Головне', 'subtitle' => 'всі головні події дня'],
			            ['title' => 'Політика', 'subtitle' => 'всі політичні новини України'],
			            ['title' => 'Економіка', 'subtitle' => 'всі новини економіки та фінансів'],
			            ['title' => 'Події', 'subtitle' => 'всі новини подій, аварій, катастроф'],
			            ['title' => 'Суспільство', 'subtitle' => 'всі новини розділу Суспільство'],
			            ['title' => 'Новини регіонів України', 'subtitle' => 'всі новини розділу'],
			            ['title' => 'Технології', 'subtitle' => 'всі новини інформаційних технологій'],
			            ['title' => 'Наука', 'subtitle' => 'всі новини науки'],
			            ['title' => 'Авто', 'subtitle' => 'всі автоновини'],
			            ['title' => 'Спорт', 'subtitle' => 'всі спортивні новини: футбол, бокс, хокей...'],
			            ['title' => 'Здоров\'я', 'subtitle' => 'всі новини медицини, краси та косметології'],
			            ['title' => 'Шоу-бізнес', 'subtitle' => 'всі новини розділу Шоу-бізнес'],
			            ['title' => 'За кордоном', 'subtitle' => 'всі новини з-за кордону'],
			            ['title' => 'Курйози', 'subtitle' => 'всі забавні, курйозні новини'],
			            ['title' => 'Фоторепортаж', 'subtitle' => 'всі фотоновини'],
			            ['title' => 'Відео', 'subtitle' => 'всі відео новини']
			        ];

					#соединение с базой данных
					$host = 'localhost';
					$db = 'newsSite';
					$charset = 'UTF8';
					$user = 'root';
					$pass = '';
					$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
					$opt = array(
					    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
					);
					$db = new PDO($dsn, $user, $pass, $opt);

					#вывод новостей из базы данных
					$query = $db->query("SELECT max(data) data FROM news");
					$row = $query->fetch();
					$data = $row['data'];
					echo '<p class="data">' . $data . '</p>';
					for ($i=0; $i < count($head); $i++) {
						echo '<h3>' . $head[$i]['title'] . '</h3>';
             			echo '<h4>' . $head[$i]['subtitle'] . '</h4>';
						$query = $db->prepare("SELECT title, url FROM news WHERE data = :data AND htitle = :htitle");
	        			$query->execute(array('data' => $data, 'htitle' => $head[$i]['title']));
			            while ($row = $query->fetch())
						{
							$url = $row['url'];
							echo "<p><a href='$url'>" . $row['title'] . '</a></p>';
						}
						echo '<hr>';
					}
				 ?>
			</div>
		</div>
	</section>
	<footer>
		<h3>2017</h3>		
	</footer>
	<script type="text/javascript">
		function fync() {
		$("#news-block").load("par.php", function() {
		});
		}; 
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
</body>
</html>