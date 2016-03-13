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
                      <h2 class="page-heading"><span>ОТМЕНА ЗАКАЗА</span></h2> 

                  <?php
                    require_once('appvars.php');
                    require_once('connectvars.php');
                       
                      $order_id = $_GET['order_id'];
                      $name = $_GET['name'];
                      $description = $_GET['description'];
                      $cost = $_GET['cost'];
                      $date = $_GET['date'];
                      $product_id = $_GET['product_id'];
                    
                    if (isset($_POST['submit'])) {
                      if ($_POST['confirm'] == 'Yes') {
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
                        
                        $order_id = $_GET['order_id'];
                        $name = $_GET['name'];
                        $product_id = $_GET['product_id'];
                        
                        $query = "DELETE FROM orders WHERE order_id = $order_id LIMIT 1";
                        mysqli_query($dbc, $query);
                        
                        $query = "UPDATE product SET residue = residue + 1 WHERE product_id = '$product_id'";
                        mysqli_query($dbc, $query);
                        
                        mysqli_close($dbc);

                        echo '<p>Заказ на '. $name .' был успешно отменен.';
                      }
                      else {
                        echo '<p class="error">Заказ не был отменен.</p>';
                      }
                    }
                    else if (isset($order_id) && isset($name) && isset($description) && isset($cost) && isset($date)) {
                      echo '<p>Вы уверены, что хотите отменить заказ?</p>';
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
                        <td>' . $cost . ' Р</td>
                      </tr>
                      <tr>
                        <th>Дата: </th>
                        <td>' . $date . '</td>
                      </tr>
                      <tr><th colspan="2">';
                      
                      ?>
                      
                      <style>
                          label {
                              display: inline-block;
                              cursor: pointer;
                              position: relative;
                              padding-left: 0px;
                              margin-right: 0px;
                              font-size: 13px;
                          }
                          
                          label:before {
                              content: "";
                              display: inline-block;

                              width: 16px;
                              height: 16px;

                              margin-right: 10px;
                              position: absolute;
                              left: 0;
                              bottom: 1px;
                              background-color: #aaa;
                              box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
                          }
                          .radio label:before {
                              border-radius: 8px;
                          }
                          input[type=radio]:checked + label:before {
                              content: "\2022";
                              color: #f3f3f3;
                              font-size: 30px;
                              text-align: center;
                              line-height: 18px;
                          }

                      </style>
                      
                      <?php                      
                      echo '<form enctype="multipart/form-data" method="post" action="buyer_orderremove.php?order_id=' . $order_id .  '&amp;name='. $name .  '&amp;product_id='. $product_id .' id="commentform"">';
                      echo '<input type="radio" name="confirm" value="Yes" /> Да ';
                      echo '<input type="radio" name="confirm" value="No" checked="checked" /> Нет ';
                      echo '<input type="submit" value="подтвердить" name="submit" />';
                      echo '</form></th></tr></table>';
                    }
                    echo '<br /><p><a href="basket.php">&lt;&lt; Вернуться в корзину</a></p>';
                  ?>
		<?php
          require_once('footer.php');  
        ?>