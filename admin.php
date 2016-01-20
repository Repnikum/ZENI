<?php
  require_once('authorize.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ZENI - Администрирование</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Зеленый гоблин - Удаление товаров</h2>
  <p>Ниже приведен список товаров. Используй эту страницу чтобы удалить необоходиоме.</p>
  <hr />

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM product ORDER BY cost DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  echo '<tr><th>наименование</th><th>описание</th><th>цена</th><th>гарантия</th><th>действие</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td>' . $row['cost'] . '</td>';
    echo '<td>' . $row['guarantee'] . '</td>';
    echo '<td><a href="removescore.php?product_id=' . $row['product_id'] . '&amp;description=' . $row['description'] . '&amp;name=' . $row['name'] . '&amp;cost=' . $row['cost'] .  '&amp;guarantee=' . $row['guarantee'] . '&amp;picture=' . $row['picture'] . '">удалить</a>';
    
    echo '</td></tr>';
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>
