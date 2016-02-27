<?php
  session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ETARA - Добавить товар</title>
  
  <link rel="shortcut icon" href="img/mini.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>ZENI - Добавить товар</h2>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_POST['submit'])) {
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Grab the score data from the POST
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
    $cost = mysqli_real_escape_string($dbc, trim($_POST['cost']));
    $guarantee = mysqli_real_escape_string($dbc, trim($_POST['guarantee']));
    $picture = mysqli_real_escape_string($dbc, trim($_FILES['picture']['name']));
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size'];
    $picone = mysqli_real_escape_string($dbc, trim($_FILES['picone']['name']));
    $pictwo = mysqli_real_escape_string($dbc, trim($_FILES['pictwo']['name']));
            
      if (!empty($name) && !empty($description) && is_numeric($cost) && !empty($guarantee) && !empty($picture) && !empty($picone) && !empty($pictwo)) {
        if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png')) && ($picture_size > 0) && ($picture_size <= GW_MAXFILESIZE)) {
          if ($_FILES['picture']['error'] == 0) {
            // Move the file to the target upload folder
            $target = GW_UPLOADPATH . $picture;
            $targetone = GW_UPLOADPATH . $picone;
            $targettwo = GW_UPLOADPATH . $pictwo;
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target) && move_uploaded_file($_FILES['picone']['tmp_name'], $targetone) && move_uploaded_file($_FILES['pictwo']['tmp_name'], $targettwo)) {
              // Write the data to the database
              $query = "INSERT INTO product (name, description, cost, guarantee, picture, picone, pictwo) VALUES ('$name', '$description', '$cost', '$guarantee', '$picture', '$picone', '$pictwo')";
              mysqli_query($dbc, $query);

              // Confirm success with the user
              echo '<p>Новый товар добавлен!</p>';
              echo '<p><strong>Название:</strong> ' . $name . '<br />';
              echo '<p><strong>Описание:</strong> ' . $description . '<br />';
              echo '<p><strong>Цена:</strong> ' . $cost . '<br />';
              echo '<p><strong>Гарантия:</strong> ' . $guarantee . '<br />';
              echo '<img src="' . GW_UPLOADPATH . $picture . '" alt="Превью" /></p>';
              echo '<img src="' . GW_UPLOADPATH . $picone . '" alt="Фото1" /></p>';
              echo '<img src="' . GW_UPLOADPATH . $pictwo . '" alt="Фото2" /></p>';
              echo '<p><a href="index.php">&lt;&lt; Вернуться на главную</a></p>';

              // Clear the score data to clear the form
              $name = "";
              $description = "";
              $cost = "";
              $guarantee = "";
              $picture = "";
              $picone = "";
              $pictwo = "";
              
              mysqli_close($dbc);
            }
            else {
              echo '<p class="error">Извините, возникла проблема с загрузкой Вашего фото.</p>';
            }
          }
        }
        else {
          echo '<p class="error">Фото должно быть GIF, JPEG, или PNG формата не больше, чем ' . (GW_MAXFILESIZE / 1024) . ' Кб.</p>';
        }

        // Try to delete the temporary screen shot image file
        @unlink($_FILES['picture']['tmp_name']);
      }
      else {
        echo '<p class="error">Пожалуйста, введите всю информацию о товаре.</p>';
      }
    
  }
?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
    <label for="name">Наименование:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="description">Описание:</label>
    <input type="text" id="description" name="description" value="<?php if (!empty($description)) echo $description; ?>" /><br />
    <label for="cost">Цена:</label>
    <input type="text" id="cost" name="cost" value="<?php if (!empty($cost)) echo $cost; ?>" /><br />
    <label for="guarantee">Гарантия:</label>
    <input type="text" id="guarantee" name="guarantee" value="<?php if (!empty($guarantee)) echo $guarantee; ?>" /><br />
    <label for="picture">Превью:</label>
    <input type="file" id="picture" name="picture" /><br />
    <label for="picone">Фото1:</label>
    <input type="file" id="picone" name="picone" /><br />
    <label for="pictwo">Фото2:</label>
    <input type="file" id="pictwo" name="pictwo" /><br />
    
    <hr />
    <input type="submit" value="Добавить" name="submit" />
  </form>
</body> 
</html>
