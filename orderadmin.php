<?php
  require_once('authorize.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ZENI - Администрирование заказов</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>ZENI - Администрирование заказов</h2>
  <p>Ниже приведен список заказов. Исплользуй эту страницу, чтоб удалить/подтвердить заказы.</p>
  <hr />

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM orders ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  echo '<tr><th>дата</th><th>ID пользователя</th><th>ID товара</th><th>способ получения</th><th>действие</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['user_id'] . '</td>';
    echo '<td>' . $row['product_id'] . '</td>';
    echo '<td>' . $row['getting'] . '</td>';
    echo '<td><a href="orderremove.php?order_id=' . $row['order_id'] . '&amp;date=' . $row['date'] .
      '&amp;user_id=' . $row['user_id'] . '&amp;product_id=' . $row['product_id'] . '&amp;getting=' . $row['getting'] . '">Удалить</a>';
    if ($row['approved'] == '0') {
      echo ' / <a href="orderapprove.php?order_id=' . $row['order_id'] . '&amp;date=' . $row['date'] .
        '&amp;user_id=' . $row['user_id'] . '&amp;product_id=' . $row['product_id'] . '&amp;getting=' . $row['getting'] . '">Подтвердить</a>';
    }
    echo '</td></tr>';
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>