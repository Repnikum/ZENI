<footer>
			<div class="wrapper">
			
				<ul  class="widget-cols clearfix">
					<li class="first-col">
						
						<div class="widget-block">
							<h4>Последние поступления</h4>
                          <?php 
                          
                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);                     
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