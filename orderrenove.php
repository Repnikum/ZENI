
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
      
                <?php
                    require_once('startsession.php');
                    require_once('header.php');
                ?>

                <div id="main">	
                  <div class="wrapper clearfix">
                    <h2 class="page-heading"><span>ВОССТАНОВЛЕНИЕ ЗАКАКАЗА</span></h2> 

                <?php
                  require_once('appvars.php');
                  require_once('connectvars.php');

                  if (isset($_GET['order_id']) && isset($_GET['name']) && isset($_GET['description']) && isset($_GET['cost']) && isset($_GET['date'])) {    
                    $order_id = $_GET['order_id'];
                      $name = $_GET['name'];
                      $description = $_GET['description'];
                      $cost = $_GET['cost'];
                      $date = $_GET['date'];
                  }

                  if (isset($_POST['submit'])) {
                    if ($_POST['confirm'] == 'Yes') {
                      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

                      $order_id = $_GET['order_id'];
                      $name = $_GET['name'];
                      
                      $query = "UPDATE orders SET archive = 0 WHERE order_id = $order_id";
                      mysqli_query($dbc, $query);
                      mysqli_close($dbc);

                      echo '<p>Заказ на ' . $name .  ' был успешно восстановлен.';
                    }
                    else {
                      echo '<p class="error">Заказ не был восстановлен.</p>';
                    }
                  }
                  else if (isset($order_id) && isset($name) && isset($description) && isset($cost) && isset($date)) {
                    echo '<p>Вы уверены, что хотите восстановить заказ №' . $order_id . ' ?</p>';
                      echo '<p><strong>Название: </strong>' . $name . '<br /><strong>Описание: </strong>' . $description .
                        '<br /><strong>Цена: </strong>' . $cost . '<br /><strong>Дата: </strong>' . $date .
                        '</p>';

                      echo '<form method="post" action="orderrenove.php?order_id=' . $order_id .  '&amp;name='. $name .'">';    
                      echo '<input type="radio" name="confirm" value="Yes" /> Да ';
                      echo '<input type="radio" name="confirm" value="No" checked="checked" /> Нет <br />';

                    echo '<input type="submit" value="восстановить" name="submit" />';

                    echo '</form>';
                  }

                  echo '<p><a href="administration.php">&lt;&lt; Вернуться на страницу администратора</a></p>';
                ?>

                  </div>
                </div>

		              
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