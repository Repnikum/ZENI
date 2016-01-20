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
		
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,300' rel='stylesheet' type='text/css'>
		
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
	
		<!-- ГЛАВНОЕ МЕНЮ -->
        <?php
          require_once('startsession.php');
          require_once('header.php');
        ?>
		
		
		<!-- MAIN -->
		<div id="main">	
			<div class="wrapper clearfix">
			
				
				<h2 class="page-heading"><span>РЕГИСТРАЦИЯ</span></h2>	
                
				<?php
  require_once('header.php');
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_POST['submitBUY'])) {
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $picture = mysqli_real_escape_string($dbc, trim($_FILES['picture']['name']));
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size'];

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) && !empty($email) && !empty($name) && !empty($phone) && !empty($picture)) {
    if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png')) && ($picture_size > 0) && ($picture_size <= GW_MAXFILESIZE)) {
    if ($_FILES['picture']['error'] == 0) {
      
      $target = GW_AVATARPATH . $picture;
      
      if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
      $query = "SELECT * FROM users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
       
        $query = "INSERT INTO users (username, password, email, name, phone, avatar) VALUES ('$username', SHA('$password1'), '$email', '$name', '$phone', '$picture')";
        
        mysqli_query($dbc, $query);
        
        $username = "";
        $password1 = "";
        $password2 = "";
        $email = "";
        $name = "";
        $phone = "";
        $picture = "";
        
        echo '<p>Ваш новый аккаунт был успешно создан. Вы готовы <a href="loggin.php">войти</a>.</p>';
               
        mysqli_close($dbc);
        exit();
      }
      else {echo '<p class="error">Аккаунт с таким именем уже существует. Пожалуйста, выберите другой логин.</p>'; $username = "";}
      }
      else {echo '<p class="error">Извините, возникла проблема с загрузкой Вашего фото.</p>';}
      }
      } else {echo '<p class="error">Фото должно быть GIF, JPEG, или PNG формата не больше, чем ' . (GW_MAXFILESIZE / 1024) . ' Кб.</p>';}
      @unlink($_FILES['picture']['tmp_name']);
  } else {echo '<p class="error">Вы должны ввести все данные, включая пароль дважды.</p>';}
} 
    else if (isset($_POST['submitCEL'])) {
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $picture = mysqli_real_escape_string($dbc, trim($_FILES['picture']['name']));
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size'];

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) && !empty($email) && !empty($name) && !empty($phone) && !empty($picture)) {
    if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png')) && ($picture_size > 0) && ($picture_size <= GW_MAXFILESIZE)) {
    if ($_FILES['picture']['error'] == 0) {
      
      $target = GW_AVATARPATH . $picture;
      
      if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
      $query = "SELECT * FROM users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
       
        $query = "INSERT INTO cellers (username, password, email, name, phone, avatar, date) VALUES ('$username', SHA('$password1'), '$email', '$name', '$phone', '$picture', NOW())";
        
        mysqli_query($dbc, $query);
        
        $username = "";
        $password1 = "";
        $password2 = "";
        $email = "";
        $name = "";
        $phone = "";
        $picture = "";
        
        echo '<p>Ваш новый аккаунт был успешно создан. Вы готовы <a href="loggin.php">войти</a>.</p>';
               
        mysqli_close($dbc);
        exit();
      }
      else {echo '<p class="error">Аккаунт с таким именем уже существует. Пожалуйста, выберите другой логин.</p>'; $username = "";}
      }
      else {echo '<p class="error">Извините, возникла проблема с загрузкой Вашего фото.</p>';}
      }
      } else {echo '<p class="error">Фото должно быть GIF, JPEG, или PNG формата не больше, чем ' . (GW_MAXFILESIZE / 1024) . ' Кб.</p>';}
      @unlink($_FILES['picture']['tmp_name']);
  } else {echo '<p class="error">Вы должны ввести все данные, включая пароль дважды.</p>';}
}
?>

        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="commentform">
          <fieldset>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />

            <input type="username" name="username" id="author" value="" tabindex="1" />
            <label for="username">Логин</label><br />

            <input type="password" name="password1" id="author" value="" tabindex="2" />
            <label for="password1">Пароль</label><br />

            <input type="password" name="password2" id="author" value="" tabindex="3" />
            <label for="password2">Пароль (повторите)</label><br />

            <input type="email" name="email" id="author" value="" tabindex="4" />
            <label for="email">E-mail</label><br />

            <input type="name" name="name" id="author" value="" tabindex="5" />
            <label for="name">Имя</label><br />

            <input type="phone" name="phone" id="author" value="" tabindex="6" />
            <label for="phone">Телефон</label><br />

            <label for="picture">аватар:</label><br />
            <input type="file" id="picture" name="picture" /><br />
            <?php    echo '<p class="error">Фото должно быть GIF, JPEG, или PNG формата не больше, чем ' . (GW_MAXFILESIZE / 1024000) . ' Мб.</p>'; ?>
        </fieldset>
          <input type="submit" value="зарегистрироваться как покупатель" name="submitBUY" />
          <input type="submit" value="зарегистрироваться как продавец" name="submitCEL" />
        </form>
              
		<footer>
			<div class="wrapper">
			
				<ul  class="widget-cols clearfix">
					<li class="first-col">
						
						<div class="widget-block">
							<h4>Recent posts</h4>
							<div class="recent-post">
								<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
								<div class="post-head">
									<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
								</div>
							</div>
							<div class="recent-post">
								<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
								<div class="post-head">
									<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
								</div>
							</div>
							<div class="recent-post">
								<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
								<div class="post-head">
									<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
								</div>
							</div>
						</div>
					</li>
					
					<li class="second-col">
						
						<div class="widget-block">
							<h4>Zeni Template</h4>
							<p>Hope you find this template useful you are free to use it on personal and commercial projects. See the full license at this </p>
						</div>
						
					</li>
					
					<li class="third-col">
						
						<div class="widget-block">
							<div id="tweets" class="footer-col tweet">
		         				<h4>Twitter widget</h4>
		         			</div>
		         		</div>
		         		
					</li>
					
					<li class="fourth-col">
						
						<div class="widget-block">
							<h4>Placeholder images</h4>
							<p>Thanks to for sharing his work as place holder images for this preview. Visit his and find more of his awesome work.</p>
						</div>
		         		
					</li>	
				</ul>				
				
				
				<div class="footer-bottom">
					<div class="left">Created by <a href="http://bayguzin.ru">bayguzin.ru</a></div>
					<div class="right">
						<ul id="social-bar">
							<li><a href=""  title="Become a fan" class="poshytip"><img src="img/social/facebook.png"  alt="Facebook" /></a></li>
							<li><a href="" title="Follow my tweets" class="poshytip"><img src="img/social/twitter.png"  alt="twitter" /></a></li>
							<li><a href=""  title="Add to the circle" class="poshytip"><img src="img/social/plus.png" alt="Google plus" /></a></li>
						</ul>
					</div>
				</div>
				
			</div>
		</footer>
					
	</body>
	
</html>