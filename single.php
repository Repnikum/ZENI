<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ETARA</title>
  
  <link rel="shortcut icon" href="img/mini.png" type="image/png">
		
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
  
    <!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter36018200 = new Ya.Metrika({
                    id:36018200,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/36018200" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	
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
 $dbc->query( "SET CHARSET utf8" );
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
                      <style>                           
                              a.knopkaBUY {
                                color: #fff; /* цвет текста */
                                text-decoration: none; /* убирать подчёркивание у ссылок */
                                user-select: none; /* убирать выделение текста */
                                background: #323232; /* фон кнопки */
                                padding: 0.1em 0.5em; /* отступ от текста */
                                outline: none; /* убирать контур в Mozilla */
                              } 
                              a.knopkaBUY:hover { background: #8b1124; color: white;} /* при наведении курсора мышки */
                              a.knopkaBUY:active { background: #c0392b; } /* при нажатии */
                          </style>
                      <?php
				        
                      if (isset($_SESSION['buyer']))  
                      { 
                        
                        if ($row['residue'] > 0){
                        echo '<h2  class="post-heading"><a class="knopkaBUY" href="order.php?product_id='. $_GET['product_id'] . '&amp;seller_id=' . $row['seller_id'] . '">Заказать </a>'. $row['name'] .'</h2>'; 
                        } else { echo '<h2  class="post-heading">Товара '. $row['name'] .' временно нет в наличии</h2>'; }
                      
                      } 
                      else { echo '<h2  class="post-heading">'. $row['name'] .'</h2>'; }
                      
                    echo '<table class="info">';
                          
					echo '<tr><th>Описание: </th><td><h4> '. $row['description'] .' </h4></td></tr>
                          <tr><th>Гарантия: </th><td> '. $row['guarantee'] .' </td></tr>
                          <tr><th>Цена: </th><td> '. $row['cost'] .' Р </td></tr>
						</div></table>';
                         
                      ?>
					
	    				<!-- comments list -->
						<div id="comments-wrap">
                          
                          <?php
                            require_once('appvars.php');
                            require_once('connectvars.php');

                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);   
 $dbc->query( "SET CHARSET utf8" );
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
 $dbc->query( "SET CHARSET utf8" );
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
                          ?>
                          
						</div>
						
						<!-- Respond -->				
						<div id="respond">
							<div class="cancel-comment-reply"><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></div>
                          
                          <style>                           
                              a.knopka {
                                color: #fff; /* цвет текста */
                                text-decoration: none; /* убирать подчёркивание у ссылок */
                                user-select: none; /* убирать выделение текста */
                                background: #323232; /* фон кнопки */
                                padding: 0.1em 0.5em; /* отступ от текста */
                                outline: none; /* убирать контур в Mozilla */
                              } 
                              a.knopka:hover { background: #597ca0; color: white;} /* при наведении курсора мышки */
                              a.knopka:active { background: #4d6e92; } /* при нажатии */
                          </style>
                          
                          <?php
                          if (isset($_SESSION['user_id']) && !isset($_SESSION['celler'])) {
                            require_once('comment.php');
                          } else if (isset($_SESSION['celler'])) {
                            echo '<h2  class="post-heading"><a class="knopka" href="loggin.php">войти через вконтакте</a> как покупатель, чтобы оставить отзыв или заказать товар</h2>';                            
                          }
                          else {echo '<h2  class="post-heading"><a class="knopka" href="loggin.php">войти через вконтакте</a> чтобы оставить отзыв или заказать товар</h2>';}
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
			        		<h4>другие товары</h4>
							<ul>
                                <?php
                                  $query = "SELECT product_id, name FROM product";
 $dbc->query( "SET CHARSET utf8" );
                                  $data = mysqli_query($dbc, $query); 

                                  while ($row = mysqli_fetch_array($data)) {
                                    echo '<li class="cat-item"><a href="single.php?product_id='. $row['product_id'] .'" title="View all posts">'. $row['name'] .'</a></li>';                                    
                                  }
                                  
                                  mysqli_close($dbc);
                                ?>
                              
							</ul>
		        		</li>
		        		        		
	        		</ul>
	        		
	        		<em id="corner"></em>
	        	</aside>
				<!-- ENDS sidebar -->
		
          </div>
		<!-- ENDS MAIN -->
		
		<?php
          require_once('footer.php');  
        ?>