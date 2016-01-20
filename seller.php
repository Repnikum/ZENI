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
          <?php require_once('startsession.php'); require_once('header.php'); ?>
      
          <div id="main">	
            <div class="wrapper">
              <h2 class="home-block-heading"><span>ПРОФИЛЬ ПРОДАВЦА</span></h2>            

              <?php
              require_once('appvars.php');
              require_once('connectvars.php');
              
              $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
              $query = "SELECT * FROM sellers WHERE user_id = '" . $_GET['seller_id'] . "'";
              $data = mysqli_query($dbc, $query);
              
              while ($row = mysqli_fetch_array($data)){
                
              echo '
              
              <table border="0" cellspacing="0" cellpadding="10" >
                <tr>
                  <td width="200" height="200" rowspan="3">
                    <img src="img/avatars/' . $row['avatar'] .'" alt="alt text" />
                    Имя: ' . $row['name'] .' <br/>
                    Дата регистрации: ' . $row['date'] .' <br/>
                    Заработал на сайте: ' . $row['profit'] .' р <br/>
                  </td>
                </tr>
              </table> 
              
              <table border="0" cellspacing="0" cellpadding="10" >
                  <tr><td width="700"><h3  class="post-heading">размещенные товары: </h2></td></tr> 
              ';
              
              //по-новой: если этот покупатель оценивал продавца - то отображается только рейтинг
              //если не оценивал - производится оценка и обновляется страница
              
              if(isset($_SESSION['buyer'])) {
                
                $query_ratings = "SELECT * FROM ratings WHERE buyer_id = '" . $_SESSION['user_id'] . "'";
                $data_ratings = mysqli_query($dbc, $query_ratings);
                $boolean = false;
                while ($r = mysqli_fetch_array($data_ratings)){
                  if($r['seller_id']==$_GET['seller_id']){ $boolean = true; }
                }
                
                if(!$boolean){
                  if (isset($_POST['submit'])) {
                    $rating = mysqli_real_escape_string($dbc, trim($_POST['rating']));
                    
                    $query_rating = "SELECT rating FROM sellers WHERE user_id = '" . $_GET['seller_id'] . "'";
                    $data_rating = mysqli_query($dbc, $query_rating);                    
                    while ($roww = mysqli_fetch_array($data_rating)){
                      $rat = $roww['rating'] + $rating; 
                    }
                    
                    $query_update = "UPDATE sellers SET rating = '$rat', voices = `voices` + 1 WHERE user_id = '". $_GET['seller_id'] ."'";
                     
                    mysqli_query($dbc, $query_update);
                    
                    //+занести оценку в реестр ratings
                    $query_up = "INSERT INTO ratings (`buyer_id`, `seller_id`) VALUES ('". $_SESSION['user_id'] ."', '". $_GET['seller_id'] ."')";
                    mysqli_query($dbc, $query_up);
                    
                    echo 'Средняя оценка: ' . $row['rating'] .'';
                  } else {

                    echo '   
                     <form enctype="multipart/form-data" method="post" action="seller.php?seller_id='. $_GET['seller_id'] . '">  
                     <fieldset>
                        <label for="rating">Оценка:</label>
                        <select id="rating" name="rating">
                          <option value="1" >1</option>
                          <option value="2" >2</option>
                          <option value="3" >3</option>
                          <option value="4" >4</option>
                          <option value="5" >5</option>
                        </select>
                      </fieldset>
                        <input type="submit" value="оценить" name="submit" />
                    </form>
                     '; 
                  }
              } else { 
                  
                  $rating = $row['rating'] / $row['voices'];
                  echo 'Средняя оценка: '. $rating .''; }
              } else { 
                               
                  $rating = $row['rating'] / $row['voices'];
                  echo 'Средняя оценка: ' . $rating .' Необходимо <a href="loggin.php">войти</a> как покупатель, чтобы выставить оценку продавцу<br/><br/>'; }
                
              }
              
              $quer = "SELECT * FROM product WHERE seller_id = '" . $_GET['seller_id'] . "'";
              $dat = mysqli_query($dbc, $quer);
              
              while ($ro = mysqli_fetch_array($dat)){
              echo '
                  <tr>
                    <td ><br/>наименование: '. $ro['name'] .'; остаток: '. $ro['residue'] .'; цена: '. $ro['cost'] .' р; гарантия: '. $ro['guarantee'] .'; <a href= "single.php?product_id=' . $ro['product_id'] . '">ссылка</a></td>
                  </tr>
              ';
              }
                
              echo '</table>';  
              
              mysqli_close($dbc);
              ?>
		              
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