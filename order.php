<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ZENI</title>
		
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
		
		
		<!-- JS -->
		<script src="js/jquery-1.6.4.min.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/tabs.js"></script>
		
		<!-- Tweet -->
		<link rel="stylesheet" href="css/jquery.tweet.css" media="all"  /> 
		<script src="js/tweet/jquery.tweet.js" ></script> 
		<!-- ENDS Tweet -->
		
		<!-- superfish -->
		<link rel="stylesheet" media="screen" href="css/superfish.css" /> 
		<script  src="js/superfish-1.4.8/js/hoverIntent.js"></script>
		<script  src="js/superfish-1.4.8/js/superfish.js"></script>
		<script  src="js/superfish-1.4.8/js/supersubs.js"></script>
		<!-- ENDS superfish -->
		
		<!-- prettyPhoto -->
		<script  src="js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css"  media="screen" />
		<!-- ENDS prettyPhoto -->
		
		<!-- poshytip -->
		<link rel="stylesheet" href="js/poshytip-1.1/src/tip-twitter/tip-twitter.css"  />
		<link rel="stylesheet" href="js/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css"  />
		<script  src="js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
		<!-- ENDS poshytip -->
		
		<!-- Flex Slider -->
		<link rel="stylesheet" href="css/flexslider.css" >
		<script src="js/jquery.flexslider-min.js"></script>
		<!-- ENDS Flex Slider -->
		
		<!-- Less framework -->
		<link rel="stylesheet" media="all" href="css/lessframework.css"/>
		
		<!-- modernizr -->
		<script src="js/modernizr.js"></script>
		
		<!-- SKIN -->
		<link rel="stylesheet" media="all" href="css/skin.css"/>
		
		<!-- reply move form -->
		<script src="js/moveform.js"></script>
		

	</head>
	
	<body lang="en">
                      
                  <?php
      
  require_once('startsession.php');
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $product_id = $_GET['product_id'];
  $seller_id = $_GET['seller_id'];
  $server = $_SERVER['PHP_SELF'] . '?product_id=' . $product_id . '&amp;seller_id=' . $seller_id ;

if (isset($_POST['submit'])) {
    
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['product_id'];
    $seller_id = $_GET['seller_id'];
    $getting = mysqli_real_escape_string($dbc, trim($_POST['getting']));
  
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
  
  if (!empty($email) || !empty($phone)) {
  
    $query_user = "UPDATE users SET `email`='$email', `phone`='$phone' WHERE `user_id`='$user_id';"; 
    mysqli_query($dbc, $query_user);
    
        $query = "INSERT INTO orders (date, user_id, seller_id, product_id, getting) VALUES (NOW(), '$user_id', '$seller_id', '$product_id', '$getting')";
        mysqli_query($dbc, $query);
  
        $query = "UPDATE product SET residue = residue - 1 WHERE product_id = '$product_id'";
        mysqli_query($dbc, $query);
        
        echo '<div id="main">	
            <div class="wrapper">
            <h2>Ваш заказ принят в обработку.<br/><br/> Хотите ли Вы <a href="portfolio.php?order=DESC">выбрать что-нибудь ещё</a>?</h2>
            </div></div>
            ';
       
        require_once('footer.php');
        exit();
  } else {echo '<p class="error">Вы должны указать телефон или e-mail для связи</p>';}
  } 
  
  $query = "SELECT name, description, cost, guarantee, picture FROM product WHERE product_id = '" . $_GET['product_id'] . "'";
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    
    echo '<div id="main">	
            <div class="wrapper">
              <h2 class="home-block-heading"><span>ЗАКАЗ ТОВАРА</span></h2> ';
    
    echo '<table class="lef">';
    if (!empty($row['name'])) {
      echo '<tr><th>Название:</th><td>' . $row['name'] . '</td></tr>';
    }
    if (!empty($row['description'])) {
      echo '<tr><th>Описание:</th><td>' . $row['description'] . '</td></tr>';
    }
    if (!empty($row['cost'])) {
      echo '<tr><th>Цена:</th><td>' . $row['cost'] . '</td></tr>';
    }
    if (!empty($row['guarantee'])) {
      echo '<tr><th>Гарантия:</th><td>' . $row['guarantee'] . '</td></tr>';
    }
    if (!empty($row['picture'])) {
      echo '<tr><th colspan="2" class="pic"><img src="' . GW_UPLOADPATH . $row['picture'] .
        '" alt="Profile Picture" width="431" height="273"/></th></tr>';
    }
    echo '<tr><th colspan="2">';
    
    ?>

    <form enctype="multipart/form-data" method="post" action="<?php echo $server; ?>" id="commentform">  
    
    <fieldset>
      <legend>Способ получения:</legend><br />
                 
      <select id="getting" name="getting">
        <option value="самовывоз" >самовывоз</option>
        <option value="доставка на дом" >доставка</option>
      </select><br /><br />
      
      <?php
      $quer = "SELECT email, phone FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
      $dat = mysqli_query($dbc, $quer);
      $row = mysqli_fetch_array($dat);
    
      if ($row != NULL) {
      $email = $row['email'];
      $phone = $row['phone'];
        echo '
        <legend>Контактные данные</legend><br />
          <input type="text" name="phone" id="phone" value="'. $phone .'" />
          <label for="phone">Телефон</label><br/>
      
          <input type="text" name="email" id="email" value="'. $email .'" />
          <label for="email">Email</label>
        ';
      } else {    
        echo '
          <legend>Контактные данные</legend><br />
          <input type="text" name="phone" id="phone" value="" />
          <label for="phone">Телефон</label><br/>

          <input type="text" name="email" id="email" value="" />
          <label for="email">Email</label>
       ';    
        }
        
      ?>  
    </fieldset>
    <input type="submit" value="заказать" name="submit" />
  </form></th></tr></table>
      
    <?php
    
  } // End of check for a single row of user results
  else {
    echo '<p class="error">Возникла проблема с доступом к базе данных.</p>';
  }
  
  mysqli_close($dbc);
?>
		              
		<?php
          require_once('footer.php');  
        ?>