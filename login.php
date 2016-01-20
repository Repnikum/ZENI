<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submitBUY'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT user_id, username FROM users WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['buyer'] = '1';
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          setcookie('buyer', '1', time() + (60 * 60 * 24 * 30));
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/loggin.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Извините, Вы должны ввести действительные логин и пароль.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Извините, Вы должны ввести логин и пароль, чтобы войти.';
      }
    } else if (isset($_POST['submitCEL'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT user_id, username FROM sellers WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['seller'] = '1';
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          setcookie('seller', '1', time() + (60 * 60 * 24 * 30));
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/loggin.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Извините, Вы должны ввести действительные логин и пароль.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Извините, Вы должны ввести логин и пароль, чтобы войти.';
      }
    }
  }

  $page_title = 'Войти';
  require_once('header.php');

  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

			<div class="wrapper">
              <h2 class="page-heading"><span>ВОЙТИ</span></h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="commentform">
    <fieldset>
      
      <input type="username" name="username" id="author" value="<?php if (!empty($user_username)) echo $user_username; ?>" tabindex="1" />
      <label for="username">Логин <small>*</small></label><br/>
      
      <input type="password" name="password" id="author" value="" tabindex="2" />
      <label for="password">Пароль</label>
      
    </fieldset>
      <input type="submit" value="войти как покупатель" id="submitBUY" name="submitBUY" />
      <input type="submit" value="войти как продавец" id="submitCEL" name="submitCEL" />
  </form>
    <?php
    echo 'покупателям';
    require_once('indexVKbuy.php');
    
    echo 'продавцам';
    require_once('indexVKcel.php');
  }
  else {
   echo '<div id="main"><div class="wrapper"></p><h2 class="page-heading"><span>Вы вошли как ' . $_SESSION['username'] . '.</span></h2></div></div>';
  }
?>