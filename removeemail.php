<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ZENI - Удалить email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    
  <p>Господин, выдели адреса, чтобы стереть их из списка.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php
  $dbc = mysqli_connect('localhost', 'root', 'root', 'shop')
    or die('Ошибка в подключении к серверу SQL.');

  // Delete the customer rows (only if the form has been submitted)
  if (isset($_POST['submit'])) {
    foreach ($_POST['todelete'] as $delete_id) {
      $query = "DELETE FROM users WHERE user_id = $delete_id";
      mysqli_query($dbc, $query)
        or die('Ошибка запроса в базу данных.');
    } 

    echo 'Подписчик(и) удалены.<br />';
  }

  // Display the customer rows with checkboxes for deleting
  $query = "SELECT * FROM users";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<input type="checkbox" value="' . $row['user_id'] . '" name="todelete[]" />';
    echo $row['username'];
    echo ' ' . $row['name'];
    echo ' ' . $row['email'];
    echo '<br />';
  }

  mysqli_close($dbc);
?>

    <input type="submit" name="submit" value="удалить" />
  </form>
</body>
</html>
