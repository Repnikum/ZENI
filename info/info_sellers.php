<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ETARA - Просмотр продавцов</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>ETARA - Просмотр продавцов</h2>
  <hr />

<?php

  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $dbc->query( "SET CHARSET utf8" );

  $query = "SELECT * FROM sellers";
  $data = mysqli_query($dbc, $query);

  echo '<table class="new">';
  echo '<tr><th>имя продавца</th><th>email</th><th>телефон</th><th>выручка</th><th>дата регистрации</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    echo '<td>' . $row['username'] . '</td>';      
    echo '<td>' . $row['email'] . '</td>';      
    echo '<td>' . $row['phone'] . '</td>';     
    echo '<td>' . $row['profit'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';    
    echo '</td></tr>';
  }

  echo '</table>';

  mysqli_close($dbc);
?>
  <br /><p><a href="info.html">&lt;&lt; Вернуться</a></p>
</body> 
</html>