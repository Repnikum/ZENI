<footer>
			<div class="wrapper">
				<ul  class="widget-cols clearfix">
					<li class="first-col">
						<div class="widget-block">
							<h4>последние поступления</h4>
                          <?php 
                          
                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);          
 $dbc->query( "SET CHARSET utf8" );
                            $query = "SELECT product_id, name, cost, seller_id FROM product ORDER BY product_id DESC LIMIT 3";
                            $data = mysqli_query($dbc, $query);
                          
                            while ($row = mysqli_fetch_array($data)) {
                              
                              $query_seller = "SELECT avatar FROM sellers WHERE user_id = '". $row['seller_id'] ."'";
                              $seller_data = mysqli_query($dbc, $query_seller);
                                                            
                              echo '
                              <div class="recent-post"> ';
                              while ($avatar = mysqli_fetch_array($seller_data)) {
                                    echo '<a href="seller.php?seller_id='. $row['seller_id'] .'" class="thumb"><img width="54px" height="54px" src="img/avatars/'.  $avatar['avatar'] .'" alt="Post" /></a>';
                                  }
                            echo     '<div class="post-head">
                                      <a href="single.php?product_id='. $row['product_id'] .'">'. $row['name'] .'</a><span> '. $row['cost'] .' Р</span>
                                  </div>
							   </div>
                              ';
                              
                            }
                          
                          ?>
							
						</div>
					</li>
					
					<li class="second-col">
						
						<div class="widget-block">
							<h4>навигация</h4>
                            <ul>
                              <li type="disc"><a href="index.php">главная </a></li>
                              <li type="disc"><a href="portfolio.php?order=DESC">каталог </a></li>  
                              <li type="disc"><a href="loggin.php">войти </a></li>  
                            </ul>  
						</div>
						
					</li>
					
					<li class="third-col">
						
						<div class="widget-block">
							<div id="tweets" class="footer-col tweet">
                                <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
                                <!-- VK Widget -->
                                <div id="vk_groups"></div>
                                <script type="text/javascript">
                                VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "250", color1: '#ebebe8', color2: '2B587A', color3: '#323232'}, 20003922);
                                </script>
		         			</div>
		         		</div>
		         		
					</li>
					
					<li class="fourth-col">
						
						<div class="widget-block">
							<h4>платежные системы</h4>
							<p><img width="100" src="img/paypal.png"/></p>
                            <p><img width="100" src="img/visa.png"/></p>
                            <p><img width="100" src="img/mastercard.png"/></p>
						</div>
		         		
					</li>	
				</ul>				
				
				
				<div class="footer-bottom">
					<div class="left">© 2016 ETARA trade </div>
					<div class="right">
						<ul id="social-bar">
                          <!-- СОЦСЕТИ
							<li><a href=""  title="Вступить в сообщество" class="poshytip"><img src="img/social/facebook.png"  alt="Facebook" /></a></li>
                            <li><a href="" title="Смотреть фото" class="poshytip"><img height="36" width="36" src="img/social/instagram.png"  alt="Instagram" /></a></li>
							<li><a href="" title="Стать фоловером" class="poshytip"><img src="img/social/twitter.png"  alt="Twitter" /></a></li>
                            <li><a href="" title="Подписаться на канал" class="poshytip"><img src="img/social/youtube.png"  alt="Youtube" /></a></li>
                          -->
							<li><a href="https://github.com/Repnikum/ZENI"  title="Исходный код" class="poshytip"><img src="img/social/github.png" alt="Google plus" /></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>