<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ETARA - Отменить заказ</title>
  
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
                
                  <?php
                      require_once('startsession.php');
                      require_once('header.php');
                  ?>

                  <div id="main">	
                    <div class="wrapper clearfix">
                      <h2 class="page-heading"><span>ПОПОЛНЕНИЕ БАЛАНСА</span></h2> 

                  <?php
                    require_once('appvars.php');
                    require_once('connectvars.php');
                                      
                    
                    if (isset($_POST['submit'])) {
                      if ($_POST['confirm'] == 'Yes') {
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
                         $dbc->query( "SET CHARSET utf8" );                                          
                                                
                        $query = "UPDATE users SET balance = balance + ' ". $_POST['sum'] ." ' WHERE user_id = ' ". $_SESSION['user_id'] ." ' " ;                                            
                        mysqli_query($dbc, $query);                        
                        mysqli_close($dbc);

                        echo '<p>Баланс был успешно пополнен.';
                      }
                      else {
                        echo '<p class="error">Баланс не был пополнен.</p>';
                      }
                    }
                    else {
                      echo '<p>Вы уверены, что хотите пополнить баланс?</p>';
                      echo '<table class="lef"><tr>';                    
                      
                      ?>
                                                              
                                 
                     <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <?php 
                      echo '<input type="text" id="sum" name="sum" value="100" />
                      <label for="sum">сумма(рубли)</label><br />';
                      echo '<input type="radio" name="confirm" value="Yes" /> Да ';
                      echo '<input type="radio" name="confirm" value="No" checked="checked" /> Нет ';
                      echo '<input type="submit" value="подтвердить" name="submit" />';
                      echo '</form></tr></table>';
                    }
                    echo '<br /><p><a href="balance.php">&lt;&lt; Вернуться</a></p>';
                  ?>
		<?php
          require_once('footer.php');  
        ?>