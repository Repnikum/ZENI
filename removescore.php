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

                    if (isset($_GET['product_id']) && isset($_GET['name']) && isset($_GET['description']) && isset($_GET['cost']) && isset($_GET['guarantee']) && isset($_GET['picture'])) {
                      // Grab the score data from the GET
                      $product_id = $_GET['product_id'];
                      $name = $_GET['name'];
                      $description = $_GET['description'];
                      $cost = $_GET['cost'];
                      $guarantee = $_GET['guarantee'];
                      $picture = $_GET['picture'];
                    }
                    else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
                      // Grab the score data from the POST
                      $product_id = $_POST['id'];
                      $name = $_POST['name'];
                      $cost = $_POST['score'];
                    }
                    else {
                      echo '<p class="error">Господин, ничего не было указано для удаления.</p>';
                    }

                    if (isset($_POST['submit'])) {
                      if ($_POST['confirm'] == 'Yes') {
                        // Delete the screen shot image file from the server
                        @unlink(GW_UPLOADPATH . $picture);
                        @unlink(GW_UPLOADPATH . $picone);
                        @unlink(GW_UPLOADPATH . $pictwo);

                        // Connect to the database
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

                        // Delete the score data from the database
                        $query = "DELETE FROM product WHERE product_id = $product_id LIMIT 1";
                        mysqli_query($dbc, $query);
                        mysqli_close($dbc);

                        // Confirm success with the user
                        echo '<div id="main"><div class="wrapper clearfix">';
                        echo '<p>Товар ' . $name .  ' был успешно удалён.';
                      }
                      else {
                        echo '<div id="main"><div class="wrapper clearfix">';
                        echo '<p class="error">Товар не был удалён.</p>';
                        echo '<p><a href="administration.php">&lt;&lt; Вернуться на страницу администратора</a></p>';
                      }
                    }
                    else if (isset($product_id) && isset($name) && isset($description) && isset($cost) && isset($guarantee)) {
                      
                      echo '<div id="main"><div class="wrapper clearfix">';
                      echo '<p>Вы уверены, что хотите удалить товар?</p>';
                      echo '<table class="lef">
                      <tr>
                        <th>Название: </th>
                        <td>' . $name . '</td>
                      </tr>
                      <tr>
                        <th>Описание: </th>
                        <td>' . $description . '</td>
                      </tr>
                      <tr>
                        <th>Цена: </th>
                        <td>' . $cost . '</td>
                      </tr>
                      <tr><th colspan="2">';
                      echo '<form method="post" action="removescore.php">';
                      echo '<input type="radio" name="confirm" value="Yes" /> Да ';
                      echo '<input type="radio" name="confirm" value="No" checked="checked" /> Нет <br />';
                      echo '<input type="submit" value="подтвердить" name="submit" />';
                      echo '<input type="hidden" name="id" value="' . $product_id . '" />';
                      echo '<input type="hidden" name="name" value="' . $name . '" />';
                      echo '<input type="hidden" name="score" value="' . $cost . '" />';
                      echo '</form></th></tr></table>';
                      echo '<br/><p><a href="administration.php">&lt;&lt; Вернуться на страницу администратора</a></p>';
                    }
?>
		              
		<?php
          require_once('footer.php');  
        ?>