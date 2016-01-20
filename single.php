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

				<!-- posts list -->
	        	<div id="posts-list" class="single-post">
	        		
                  <?php
                        require_once('appvars.php');
                        require_once('connectvars.php');
                      
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);                     
                        $query = "SELECT * FROM product WHERE product_id='" . $_GET['product_id'] . "'";
                        $data = mysqli_query($dbc, $query);
                        $row = mysqli_fetch_array($data);
                        
                        $quer = "SELECT * FROM sellers WHERE user_id='" . $row['seller_id'] . "'";
                        $dat = mysqli_query($dbc, $quer);
                        $ro = mysqli_fetch_array($dat);
                        
	        		    echo '<h2 class="page-heading"><span>'. $row['name'] .'</span></h2>';
                      
                        mysqli_close($dbc);
                  ?>
	        		
					<article class="format-standard">
						<div class="entry-date">
                 <?php    echo    '<a href="seller.php?seller_id='. $ro['user_id'] .'"><img src="img/avatars/'. $ro['avatar'] .'" width="100" height="100" /></a>'  ?>
                        </div>
						<!-- СЛАЙДЕР -->
                      
                      <div class="project-slider">
				        <div class="flexslider">
						  <ul class="slides">
                      <?php
                        echo  '<li>' .
                                  '<a href="img/dummies/' . $row['picture'] .'" data-rel="prettyPhoto"><img src="img/dummies/' . $row['picture'] .'" alt="alt text" /></a>' .
                              '</li>' .
                              '<li>' .
                                  '<a href="img/dummies/' . $row['picone'] .'" data-rel="prettyPhoto"><img src="img/dummies/' . $row['picone'] .'" alt="alt text" /></a>' .
                              '</li>' .
                              '<li>' .
                                  '<a href="img/dummies/' . $row['pictwo'] .'" data-rel="prettyPhoto"><img src="img/dummies/' . $row['pictwo'] .'" alt="alt text" /></a>' .
                              '</li>';
                      ?>
                          </ul>
						</div>
					</div>
                    					
		        	<!-- конец слайдера -->
                      
                      <?php
				        
                      if (isset($_SESSION['buyer']))  
                      { 
                        
                        if ($row['residue'] > 0){
                        echo '<h2  class="post-heading"><a href="order.php?product_id='. $_GET['product_id'] . '&amp;seller_id=' . $row['seller_id'] . '">Заказать </a>'. $row['name'] .'</h2>'; 
                        } else { echo '<h2  class="post-heading">Товара '. $row['name'] .' временно нет в наличии</h2>'; }
                      
                      } 
                      else { echo '<h2  class="post-heading">'. $row['name'] .'</h2>'; }
                      
                    echo '<table class="new">';
                          
					echo '<tr><th>Техническое описание: </th><td> '. $row['description'] .' </td></tr>
                          <tr><th>Гарантия: </th><td> '. $row['guarantee'] .' </td></tr>
                          <tr><th>Цена: </th><td> '. $row['cost'] .' Р </td></tr>
						</div></table>';
                         
                      ?>
                      
						<div class="meta">
							<div class="comments"><a href="#">5 comments </a></div>
							<div class="user"><a href="#">By admin</a></div>
                            <div class="categories">In <a href="#">Category 1</a>, <a href="#">Category 2</a></div>
						</div>
					
					
					
	    				<!-- comments list -->
						<div id="comments-wrap">
                          
                          <?php
                            require_once('appvars.php');
                            require_once('connectvars.php');

                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);                     
                            $query = "SELECT product_id FROM comment";

                            $data = mysqli_query($dbc, $query);
                            $i = 0;
                            $et = $_GET['product_id'];              

                            while ($row = mysqli_fetch_array($data)) {
                                  $id = $row['product_id'];
                                  if(($id==$et)){
                                    $i++;
                                  } 
                            }                        
                            mysqli_close($dbc);
                            echo '<h3 class="heading">КОЛИЧЕСТВО ОТЗЫВОВ: '. $i .'</h3>';
                          ?>   
                          
                          <?php
                            require_once('appvars.php');
                            require_once('connectvars.php');

                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);                     
                            $query = "SELECT username, product_id, date, description FROM comment WHERE product_id = $et ORDER BY date ASC";
                            $data = mysqli_query($dbc, $query); 
                          
                            //далее в цикле - запрос имени по user_id

                            while ($row = mysqli_fetch_array($data)) {
                              $uname = $row['username'];
                              $query_picture = "SELECT avatar FROM users WHERE username = '$uname' ";
                              $data_picture = mysqli_query($dbc, $query_picture);
                                  
                              echo '<ol class="commentlist">
								          <li class="comment even thread-even depth-1" id="li-comment">
									         <div id="comment-1" class="comment-body clearfix">';
                                              
                                            if (mysqli_num_rows($data_picture) == 0) { 
                                                
                                            echo  ' <img alt="" src="img/avatars/joker.jpg" class="avatar avatar-35 photo" height="35" width="35" /><div class="comment-author vcard">'. $row['username'] .'</div>' ;
                                                
                                              } else { 
                                                
                                              while ($row_picture = mysqli_fetch_array($data_picture)) {
                                            echo  '<img alt="" src="img/avatars/'. $row_picture['avatar'] .'" class="avatar avatar-35 photo" height="35" width="35" /><div class="comment-author vcard">'. $row['username'] .'</div>' ;
                                              }
                                                
                                              }
                              
								    echo         '<div class="comment-meta commentmetadata">
									  		  <span class="comment-date">'. $row['date'] .'</span>
										      </div>
								  		      <div class="comment-inner">
									   		  <p>'. $row['description'] .'</p>
								 		      </div>
                                             </div>
								          </li>
							             </ol>
                                      ';
                            }  
                          
                            mysqli_close($dbc);
                          ?>
                          
						</div>
						
						<!-- Respond -->				
						<div id="respond">
							<div class="cancel-comment-reply"><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></div>
                          
                          <?php
                          if (isset($_SESSION['user_id']) && !isset($_SESSION['celler'])) {
                            require_once('comment.php');
                          } else if (isset($_SESSION['celler'])) {
                            echo '<h2  class="post-heading">Чтобы оставить отзыв / заказать товар, необходимо <a href="page.php">зарегистрироваться</a> или <a href="loggin.php">войти</a> как покупатель</h2>';                            
                          }
                          else {echo '<h2  class="post-heading">Чтобы оставить отзыв / заказать товар, необходимо <a href="page.php">зарегистрироваться</a> или <a href="loggin.php">войти</a></h2>';}
                          ?>
                          
						</div>
						<div class="clearfix"></div>
						<!-- ENDS Respond -->
			
		        		</article>
		        		
		        	</div>
		        	<!-- ENDS posts list -->
		
				<!-- sidebar -->
	        	<aside id="sidebar">
	        		
	        		<ul>
		        		<li class="block">
			        		<h4>Информация</h4>
							<ul>
								<li class="cat-item"><a href="#" title="View all posts">Описание</a></li>
								<li class="cat-item"><a href="#" title="View all posts">Гарантия</a></li>
								<li class="cat-item"><a href="#" title="View all posts">Цена</a></li>								
							</ul>
		        		</li>
		        		        		
	        		</ul>
	        		
	        		<em id="corner"></em>
	        	</aside>
				<!-- ENDS sidebar -->
	        	
			</div>
		</div>
		<!-- ENDS MAIN -->
		
		
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