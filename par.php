<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        error_reporting('E_ALL');

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

        #заголовки
        $url = "https://www.ukr.net/";
        $headers = get_headers($url, 1);
        file_put_contents('headers.log',var_export($headers,true), FILE_APPEND);
        
        #парсинг
        $url = file_get_contents("https://www.ukr.net/ajax/news.json");
        $json = json_decode($url, true);
        $data = date("Y-m-d H:i:s");
        echo '<p class="data">' . $data . '</p>';
        $sectionCount = count($json['news']);
        for ($i=0; $i < $sectionCount; $i++) {
             $count = count($json['news'][$i]['items']);
             echo '<h3>' . $json['news'][$i]['title'] . '</h3>';
             echo '<h4>' . $json['news'][$i]['readMore'] . '</h4>';
             $htitle = $json['news'][$i]['title'];
            for ($j=0; $j < $count; $j++) { 
                $title = $json['news'][$i]['items'][$j]['title'];
                $url = $json['news'][$i]['items'][$j]['url'];
                echo "<p><a href='$url'>" . $title . '</a></p>';
                $query = $db->prepare("INSERT INTO news (title, url, data, htitle) VALUES(:title, :url, :data, :htitle)");
                $values = ['title' => $title, 'url' => $url, 'data' => $data, 'htitle' => $htitle];
                $query->execute($values);
            }
            echo '<hr>';
        }
?>
</body>
</html>
