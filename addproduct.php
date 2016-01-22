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
    $picone_type = $_FILES['picone']['type'];
    $picone_size = $_FILES['picone']['size'];
    $pictwo = mysqli_real_escape_string($dbc, trim($_FILES['pictwo']['name']));
    $pictwo_type = $_FILES['pictwo']['type'];
    $pictwo_size = $_FILES['pictwo']['size'];
    
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    
    $query_user = "UPDATE sellers SET `email`='$email', `phone`='$phone' WHERE `user_id`='". $_SESSION['user_id'] ."'";
    mysqli_query($dbc, $query);
            
      if (!empty($name) && !empty($description) && is_numeric($cost) && !empty($guarantee) && !empty($picture) && !empty($picone) && !empty($pictwo)) {
        if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png')) && ($picture_size > 0) && ($picture_size <= GW_MAXFILESIZE)
           && (($picone_type == 'image/gif') || ($picone_type == 'image/jpeg') || ($picone_type == 'image/pjpeg') || ($picone_type == 'image/png')) && ($picone_size > 0) && ($picone_size <= GW_MAXFILESIZE)
           && (($pictwo_type == 'image/gif') || ($pictwo_type == 'image/jpeg') || ($pictwo_type == 'image/pjpeg') || ($pictwo_type == 'image/png')) && ($pictwo_size > 0) && ($pictwo_size <= GW_MAXFILESIZE)
           ) {
          if ($_FILES['picture']['error'] == 0) {
            // Move the file to the target upload folder
            $target = GW_UPLOADPATH . $picture;
            $targetone = GW_UPLOADPATH . $picone;
            $targettwo = GW_UPLOADPATH . $pictwo;
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target) && move_uploaded_file($_FILES['picone']['tmp_name'], $targetone) && move_uploaded_file($_FILES['pictwo']['tmp_name'], $targettwo)) {
              $uid = $_SESSION['user_id'];
              
              $query = "INSERT INTO product (name, description, cost, guarantee, picture, picone, pictwo, seller_id) VALUES ('$name', '$description', '$cost', '$guarantee', '$picture', '$picone', '$pictwo', '$uid')";
              mysqli_query($dbc, $query);

              echo '<div id="main">';
              echo '<h2>Новый товар добавлен!</h2><br/><h3><a href="index.php">вернуться на главную</a></h3>';
              echo '</div></div>';
              
              $name = "";
              $description = "";
              $cost = "";
              $guarantee = "";
              $picture = "";
              $picone = "";
              $pictwo = "";
              $uid = "";
              
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

  <h2 class="page-heading"><span>РАЗМЕЩЕНИЕ ТОВАРА</span></h2>

  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="commentform">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />

    <input type="text" id="name" name="name" value="" tabindex="1" />
    <label for="name">Наименование</label>
    <br />

    <input type="text" id="description" name="description" value="" tabindex="2" />
    <label for="description">Описание</label>
    <br />

    <input type="text" id="cost" name="cost" value="" tabindex="3" />
    <label for="cost">Цена</label>
    <br />

    <input type="text" id="guarantee" name="guarantee" value="" tabindex="4" />
    <label for="guarantee">Гарантия</label>
    <br />

    <input type="file" id="picture" name="picture" tabindex="5" />
    <label for="picture">Превью</label>
    <br />

    <input type="file" id="picone" name="picone" tabindex="6" />
    <label for="picone">Фото1</label>
    <br />

    <input type="file" id="pictwo" name="pictwo" tabindex="7" />
    <label for="pictwo">Фото2</label>
    <br />

    <?php    echo '<p class="error">Фото должно быть GIF, JPEG, или PNG формата не больше, чем ' . (GW_MAXFILESIZE / 1024000) . ' Мб.</p>'; 
  
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT * FROM sellers WHERE user_id = '". $_SESSION['user_id'] ."'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);
      
      $email = $row['email'];
      $phone = $row['phone'];
    
  echo '
    <input type="text" id="phone" name="phone" value="'. $phone .'" tabindex="8" />
    <label for="phone">Телефон</label><br />
  
    <input type="text" id="email" name="email" value="'. $email .'" tabindex="9" />
    <label for="email">E-mail</label><br />
    ';
    ?>
      <hr />
      <input type="submit" value="добавить" name="submit" />
  </form>

  </div>