<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ETARA - Продавец</title>
  
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
              
              <table cellspacing="0" class="lef">
                <tr>
                  <th width="200" height="200" >
                    <img src="img/avatars/' . $row['avatar'] .'" alt="alt text" />
                  </th>
                </tr>
                <tr>
                  <th>Имя: </th>
                  <td>' . $row['name'] .'</td>
                </tr>
                <tr>
                  <th>Дата регистрации: </th>
                  <td>' . $row['date'] .'</td>
                </tr>
                <tr>
                  <th>Заработал на сайте: </th>
                  <td>' . $row['profit'] .' р</td>
                </tr>
              </table>
              
              <table cellspacing="0" class="lef">
              ';
              
              //по-новой: если этот покупатель оценивал продавца - то отображается только рейтинг
              //если не оценивал - производится оценка и обновляется страница
              ?>
              
              <style>
                  .scale,
                  .meter {
                      height: 30px
                  }
                  .scale {
                      width: 550px;
                      background: #CCC;
                  }
                  

                  .meter:after{
                      content: "";
                      position: absolute;
                      top: 0;
                      height: 100%;
                      width: 100%;
                  }
                </style>
                            
              
              <?php
              /*    РЕЙТИНГОВАЯ СИСТЕМА              
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
                    
                    $rating = (($row['rating'] / $row['voices'])/5)*550;
                    echo 'Средняя оценка: '. $rating .'';
                    echo '
                    <style>
                      .meter {
                          width: ' . $rating .'px;
                          display: inline-block;
                          vertical-align: top;
                          background: #323232;
                      }
                    </style>

                    <div class="scale">
                        <div class="meter"></div>
                    </div>
                    ';
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
                  
                  $rating = (($row['rating'] / $row['voices'])/5)*550;
                  echo 'Средняя оценка: '. $rating .'';
                  echo '
                    <style>
                      .meter {
                          width: ' . $rating .'px;
                          display: inline-block;
                          vertical-align: top;
                          background:#323232;
                      }
                    </style>

                    <div class="scale">
                        <div class="meter"></div>
                    </div>
                    ';
                }
              } else { 
                if($row['voices']!=0){  
                  $rating = (($row['rating'] / $row['voices'])/5)*550;
                } else {$rating=0;}
                  echo 'Рейтинг продавца: ' . $rating .' Необходимо <a href="loggin.php">войти</a> как покупатель, чтобы выставить оценку продавцу<br/><br/>'; 
              }
              */    
                
              }
              
              $quer = "SELECT * FROM product WHERE seller_id = '" . $_GET['seller_id'] . "'";
              $dat = mysqli_query($dbc, $quer);
              
              echo '<tr><th>наименование</th><th>остаток</th><th>цена</th><th>гарантия</th></tr>';
              
              $i = 1;
              while ($ro = mysqli_fetch_array($dat)){
              if($i%2!=0){
              echo '
                  <tr>
                    <td><a href= "single.php?product_id=' . $ro['product_id'] . '">'. $ro['name'] .'</a></td><td>'. $ro['residue'] .'</td><td>'. $ro['cost'] .' р</td><td>'. $ro['guarantee'] .'</td>
                  </tr>
              ';
              $i++;
              } else {
                echo '
                  <tr class="even">
                    <td><a href= "single.php?product_id=' . $ro['product_id'] . '">'. $ro['name'] .'</a></td><td>'. $ro['residue'] .'</td><td>'. $ro['cost'] .' р</td><td>'. $ro['guarantee'] .'</td>
                  </tr>
              ';
                $i++;
              }
              }
                
              echo '</table>';  
              
              mysqli_close($dbc);
              ?>
            </div>
      </div>
		<?php
          require_once('footer.php');  
        ?>