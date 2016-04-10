<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ETARA - Просмотр товаров</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>ETARA - Просмотр товаров</h2>
  <hr />

<?php

  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $dbc->query( "SET CHARSET utf8" );

  $query = "SELECT * FROM product";
  $data = mysqli_query($dbc, $query);

  echo '<table class="new">';
  echo '<tr><th>наименование</th><th>описание</th><th>цена, руб</th><th>гарантия</th><th>продавец</th><th>остаток</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    echo '<td>' . $row['name'] . '</td>';     
    echo '<td>' . $row['description'] . '</td>';     
    echo '<td>' . $row['cost'] . '</td>';
    echo '<td>' . $row['guarantee'] . '</td>';
    $query_seller = "SELECT * FROM sellers WHERE user_id = ' ".  $row['seller_id'] ." ' ";
      $data_seller = mysqli_query($dbc, $query_seller);
      $row_seller = mysqli_fetch_array($data_seller);
    echo '<td>' . $row_seller['username'] . '</td>';
    echo '<td>' . $row['residue'] . '</td>';    
    echo '</td></tr>';
  }

  echo '</table>';

  mysqli_close($dbc);
?>
  <br /><p><a href="info.html">&lt;&lt; Вернуться</a></p>
</body> 
</html>