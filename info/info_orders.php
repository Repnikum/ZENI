<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ETARA - Просмотр заказов</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>ETARA - Просмотр заказов</h2>
  <hr />

<?php

  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $dbc->query( "SET CHARSET utf8" );

  $query = "SELECT * FROM orders ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);

  echo '<table class="new">';
  echo '<tr><th>дата</th><th>имя покупателя</th><th>имя продавца</th><th>наименование товара</th><th>способ получения</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    echo '<td>' . $row['date'] . '</td>';
      $query_user = "SELECT * FROM users WHERE user_id = ' ".  $row['user_id'] ." ' ";
      $data_user = mysqli_query($dbc, $query_user);
      $row_user = mysqli_fetch_array($data_user);
    echo '<td>' . $row_user['username'] . '</td>';
      $query_seller = "SELECT * FROM sellers WHERE user_id = ' ".  $row['seller_id'] ." ' ";
      $data_seller = mysqli_query($dbc, $query_seller);
      $row_seller = mysqli_fetch_array($data_seller);
    echo '<td>' . $row_seller['username'] . '</td>';
      $query_product = "SELECT * FROM product WHERE product_id = ' ".  $row['product_id'] ." ' ";
      $data_product = mysqli_query($dbc, $query_product);
      $row_product = mysqli_fetch_array($data_product);
    echo '<td>' . $row_product['name'] . '</td>';
    echo '<td>' . $row['getting'] . '</td>';    
    echo '</td></tr>';
  }

  echo '</table>';

  mysqli_close($dbc);
?>
  <br /><p><a href="info.html">&lt;&lt; Вернуться</a></p>
</body> 
</html>