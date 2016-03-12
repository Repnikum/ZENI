<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ETARA - Каталог</title>
  
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
				<h2 class="page-heading"><span>КАТАЛОГ ТОВАРОВ</span></h2>	
      
        <?php
          require_once('appvars.php');
          require_once('connectvars.php');
              
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 $dbc->query( "SET CHARSET utf8" );
            
            $order = $_GET['order'];
            
            if ($order == 'SELLER'){
              $query = "SELECT * FROM product WHERE seller_id = '". $_SESSION['user_id'] ."'";
            } else { $query = "SELECT * FROM product ORDER BY cost $order"; }
              
            $data = mysqli_query($dbc, $query);
            $i = 1;            

            echo '<div class="portfolio-thumbs clearfix" >';
              
            while ($row = mysqli_fetch_array($data)) {            
                  if(($i==3)){
                  echo '<figure class="last">' . 
                      '<figcaption>' .
                        '<strong>'. $row['name'] .'</strong>' .
                        '<span>'. $row['description'] .'</span>' .
                        '<span>гарантия '. $row['guarantee'] .'</span>' .
                        '<em>'. $row['cost'] .' Р</em>' .
                      '<a href="single.php?product_id=' . $row['product_id'] . '"  class="thumb">'.
                      '</figcaption>' .
                    '<img src="' . GW_UPLOADPATH . $row['picture'] . '" alt="Alt text" /></a>' .
                    '</figure>';
                    $i=1;
                  } else{
                    echo '<figure>' . 
                      '<figcaption>' .
                        '<strong>'. $row['name'] .'</strong>' .
                        '<span>'. $row['description'] .'</span>' .
                        '<span>гарантия '. $row['guarantee'] .'</span>' .
                        '<em>'. $row['cost'] .' Р</em>' .
                      '<a href="single.php?product_id=' . $row['product_id'] . '"  class="thumb">'.
                      '</figcaption>' .
                      '<img src="' . GW_UPLOADPATH . $row['picture'] . '" alt="Alt text" /></a>' .
                    '</figure>';
                    $i++;
                  }
            }

            mysqli_close($dbc);  
          ?>
				
				<!-- переключатель между страницами
        		<ul class="pager">
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
				</ul>
				<div class="clearfix"></div>
	        	ENDS pager -->
	        	
			</div>
		</div>
		<!-- ENDS MAIN -->
		
		<?php
          require_once('footer.php');  
        ?>