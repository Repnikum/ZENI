<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ETARA - Оплата заказа</title>
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
                    <h2 class="page-heading"><span>ОПЛАТА ЗАКАЗА</span></h2> 

                <?php
                  require_once('appvars.php');
                  require_once('connectvars.php');
                                                    
                    if(isset($_GET['key'])){
                      if( $_GET['key'] == $_COOKIE['key'] ){
                      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                      $dbc->query( "SET CHARSET utf8" );
                                      
                      $query = "SELECT * FROM orders WHERE order_id = ' ". $_GET['order_id'] ." ' ";
                      $data = mysqli_query($dbc, $query);
                      $row = mysqli_fetch_array($data);                      
                      
                      $order_id = $row['order_id'];
                      $seller_id = $row['seller_id'];
                      
                      $query = "SELECT cost FROM product WHERE product_id = ' ". $row['product_id'] ." ' ";
                      $data = mysqli_query($dbc, $query);
                      $row = mysqli_fetch_array($data);
                                            
                      $cost = $row['cost'];
                                          
                      $query_seller = "UPDATE sellers SET profit = profit + '$cost' WHERE user_id = '$seller_id'";
                      mysqli_query($dbc, $query_seller);
                      
                      $query_confirm = "UPDATE orders SET payed = 1 WHERE order_id = '$order_id'";
                      mysqli_query($dbc, $query_confirm);
                        
                      mysqli_close($dbc);
                        
                      setcookie('key', '', time() - (60 * 60));                      
                      
                      echo '<p>Заказ был успешно оплачен. </p>';
                      echo '<br /><p><a href="basket.php">&lt;&lt; Вернуться на страницу заказов</a></p>'; 
                      }  else {
                      echo '<p>Заказ уже был оплачен. </p>';
                      echo '<br /><p><a href="basket.php">&lt;&lt; Вернуться на страницу заказов</a></p>'; 
                      }                
                  } else {                                            
                                          
                      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                      $dbc->query( "SET CHARSET utf8" );                   
                                                                
                      $query = "SELECT product_id FROM orders WHERE order_id = ' ". $_GET['order_id'] ." ' ";
                      $data = mysqli_query($dbc, $query);
                      $row = mysqli_fetch_array($data);
                       
                      $query = "SELECT * FROM product WHERE product_id = ' ". $row['product_id'] ." ' ";
                      $data = mysqli_query($dbc, $query);
                      $row = mysqli_fetch_array($data);
                                            
                      $name = $row['name'];
                      $description = $row['description'];
                      $cost = $row['cost'];
                      $date =$row['date'];
                      $seller_id = $row['seller_id'];                                       
                                                              
                      $order_id = $_GET['order_id'];
                      $key = rand(5, 1055);
                      setcookie('key', $key, time() + (60 * 60));                                        
                      
                      mysqli_close($dbc);
                      
                      echo '<p>Вы уверены, что хотите оплатить заказ?</p>';
                        echo '<table class="lef">
                        <tr>
                          <th>Название: </th>
                          <td>' . $name . '</td>
                        </tr>
                        <tr>
                          <th>Описание: </th>
                          <td><h4>' . $description . '</h4></td>
                        </tr>
                        <tr>
                          <th>Цена: </th>
                          <td>' . $cost . '</td>
                        </tr>
                        <tr><th colspan="2">';
                      
                        echo '<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
                              <input type="hidden" name="receiver" value="41001787315278">
                              <input type="hidden" name="label" value="' . $order_id . '">
                              <input type="hidden" name="quickpay-form" value="donate">
                              <input type="hidden" name="targets" value="покупка товара ' . $name . '">
                              <input type="hidden" name="sum" value="' . $cost . '" data-type="number" >
                              <input type="hidden" name="successURL" value="http://etara.org/orderpayment.php?order_id='. $order_id .'&amp;key=' . $key . ' " >
                              <input type="hidden" name="comment" value=" " >
                              <input type="hidden" name="need-fio" value="false"> 
                              <input type="hidden" name="need-email" value="false" >
                              <input type="hidden" name="need-phone" value="false">
                              <input type="hidden" name="need-address" value="false">
                              <input type="radio" name="paymentType" value="PC">Яндекс.Деньгами</input>
                              <input type="radio" name="paymentType" value="AC">Банковской картой</input>
                              <input type="submit" name="submit-button" class="subm" value="Купить">';                          
                      echo '</form></th></tr></table>';  
                      
                      echo '<br /><p><a href="basket.php">&lt;&lt; Вернуться на страницу заказов</a></p>';  
                  }                                                 
                  require_once('footer.php');  
                  ?>