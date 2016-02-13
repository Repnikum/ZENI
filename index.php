<!doctype html>
<html class="no-js">

<head>
  <meta charset="utf-8" />
  <title>ZENI</title>

  <!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
  <link rel="stylesheet" media="all" href="css/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->


  <!-- JS -->
  <script src="js/jquery-1.6.4.min.js"></script>
  <script src="js/css3-mediaqueries.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/tabs.js"></script>

  <!-- Tweet -->
  <link rel="stylesheet" href="css/jquery.tweet.css" media="all" />
  <script src="js/tweet/jquery.tweet.js"></script>
  <!-- ENDS Tweet -->

  <!-- superfish -->
  <link rel="stylesheet" media="screen" href="css/superfish.css" />
  <script src="js/superfish-1.4.8/js/hoverIntent.js"></script>
  <script src="js/superfish-1.4.8/js/superfish.js"></script>
  <script src="js/superfish-1.4.8/js/supersubs.js"></script>
  <!-- ENDS superfish -->

  <!-- prettyPhoto -->
  <script src="js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
  <link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css" media="screen" />
  <!-- ENDS prettyPhoto -->

  <!-- poshytip -->
  <link rel="stylesheet" href="js/poshytip-1.1/src/tip-twitter/tip-twitter.css" />
  <link rel="stylesheet" href="js/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css" />
  <script src="js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
  <!-- ENDS poshytip -->

  <!-- Flex Slider -->
  <link rel="stylesheet" href="css/flexslider.css">
  <script src="js/jquery.flexslider-min.js"></script>
  <!-- ENDS Flex Slider -->

  <!-- Less framework -->
  <link rel="stylesheet" media="all" href="css/lessframework.css" />

  <!-- modernizr -->
  <script src="js/modernizr.js"></script>

  <!-- SKIN -->
  <link rel="stylesheet" media="all" href="css/skin.css" />

</head>

<body lang="en">

  <!-- ГЛАВНОЕ МЕНЮ -->
  <?php
          require_once('startsession.php');
          require_once('header.php');
        ?>

    <!-- MAIN -->
    <div id="main">
      <div class="wrapper">

        <!-- slider holder -->
        <div id="slider-holder" class="clearfix">

          <!-- slider -->
          <div class="flexslider home-slider">
            <ul class="slides">
              <li>
                <img src="img/slides/01.jpg" alt="alt text" />
                <p class="flex-caption">Весь декабрь!</p>
              </li>
              <li>
                <img src="img/slides/02.jpg" alt="alt text" />
                <p class="flex-caption">Успейте!</p>
              </li>
              <li>
                <img src="img/slides/03.jpg" alt="alt text" />
                <p class="flex-caption">Резкое падение цен!</p>
              </li>
            </ul>
          </div>
          <!-- ENDS slider -->

          <div class="home-slider-clearfix "></div>

          <!-- Headline -->
          <div id="headline">
            <h1>Акиции и скидки</h1>
            <p>Невероятные возможности</p>
            <em id="corner"></em>
          </div>
          <!-- ENDS headline -->


        </div>
        <!-- ENDS slider holder -->

        <!-- home-block -->
        <div class="home-block">
          <h2 class="home-block-heading"><span>ПОСЛЕДНИЕ ПОСТУПЛЕНИЯ</span></h2>
          <div class="one-third-thumbs clearfix">

            <!-- вывод 6 самых дорогих товаров на экран -->
            <?php
          require_once('appvars.php');
          require_once('connectvars.php');
                      
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);                     
          $query = "SELECT product_id, name, description, cost, guarantee, picture FROM product ORDER BY cost DESC LIMIT 6";
                      
          $data = mysqli_query($dbc, $query);
          $i = 1;            
                      
          while ($row = mysqli_fetch_array($data)) {            
                if(($i==3)){
                echo '<figure class="last">' . 
                    '<figcaption>' .
                      '<strong>'. $row['name'] .'</strong>' .
                      '<span>'. $row['description'] .'</span>' .
                      '<span>гарантия '. $row['guarantee'] .'</span>' .
                      '<em class="price">'. $row['cost'] .' Р</em>' .
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
                      '<em class="price">'. $row['cost'] .' Р</em>' .
                    '<a href="single.php?product_id=' . $row['product_id'] . '"  class="thumb">'.
                    '</figcaption>' .
                    '<img src="' . GW_UPLOADPATH . $row['picture'] . '" alt="Alt text" /></a>' .
                  '</figure>';
                  $i++;
                }
          }
                      
          mysqli_close($dbc);                
          ?>

          </div>
        </div>
        <!-- ENDS home-block -->


        <!-- ЛУЧШИЕ ПРОДАВЦЫ 
        <div class="home-block">
          <h2 class="home-block-heading"><span>ЛУЧШИЕ ПРОДАВЦЫ</span></h2>
          <div class="one-fourth-thumbs clearfix">

            <?php 
            /*
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
                        $query = "SELECT * FROM sellers ORDER BY profit DESC LIMIT 4";
                        $data = mysqli_query($dbc, $query);
            
                        $i = 1;
                        while ($row = mysqli_fetch_array($data)) {
                          if(($i==4)){
                          echo '
                          <figure class="last">
		        			<figcaption>
	        					<strong>'. $row['name'] .'</strong>
	        					<span>Поднял '. $row['profit'] .' р</span>
	        					<em>Дата регистрации: <br /><br />'. $row['date'] .'</em>
	        					<a href="seller.php?seller_id=' . $row['user_id'] . '" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="seller.php?seller_id=' . $row['user_id'] . '"  class="thumb" ><img src="img/avatars/'. $row['avatar'] .'" alt="Alt text" /></a>
		        		  </figure>
                          ';
                          $i=1;
                        }else{
                          echo '
                          <figure>
		        			<figcaption>
	        					<strong>'. $row['name'] .'</strong>
	        					<span>Поднял '. $row['profit'] .' р</span>
	        					<em>Дата регистрации: <br /><br />'. $row['date'] .'</em>
	        					<a href="seller.php?seller_id=' . $row['user_id'] . '" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="seller.php?seller_id=' . $row['user_id'] . '"  class="thumb"><img src="img/avatars/'. $row['avatar'] .'" alt="Alt text"  /></a>
		        		  </figure>
                          ';
                           $i++;
                         }
                        }
              */
              ?>

          </div>
          -->

        </div>
      </div>
      <!-- ENDS MAIN -->

      <?php
        require_once('footer.php');  
      ?>