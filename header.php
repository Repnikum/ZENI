<header class="clearfix">
					
			<div id="top-widget-holder">
				<div class="wrapper">
					<div id="top-widget">
						<div class="padding">
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
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
									
								</li>
								
								<li class="third-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
					         		
								</li>
								
								<li class="fourth-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
					         		
								</li>	
							</ul>				
						</div>
					</div>
				</div>
				<a href="#" id="top-open">Menu</a>
			</div>
			
		
			<div class="wrapper clearfix">
				
				<a href="index.php" id="logo"><img  src="img/logo.png" alt="Zeni"></a>
				
				<nav>
                    <ul id="nav" class="sf-menu">
                  <?php
                      if (isset($_SESSION['buyer'])) {
                        echo '<li><a href="index.php">ГЛАВНАЯ</a>
                                    <ul>
                                      <li><a href="basket.php">КОРЗИНА</a></li>
							       </ul>                      
                              </li>';
                        echo '<li><a href="portfolio.php?order=DESC">КАТАЛОГ</a>
                                <ul>
                                  <li><a href="portfolio.php?order=ASC">ПО ЦЕНЕ ^</a></li>
                                  <li><a href="portfolio.php?order=DESC">ПО ЦЕНЕ v</a></li>
							     </ul>
                              </li>';
                        echo '<li><a href="contact.php">КОНТАКТЫ</a>';
                        echo '<li><a href="logout.php">Выйти (' . $_SESSION['username'] . ')</a>';                        
                      }
                      else if (isset($_SESSION['seller'])) {
                        echo '<li><a href="index.php">ГЛАВНАЯ</a>
                                <ul>
                                  <li><a href="administration.php">АДМИН ПАНЕЛЬ</a></li>
                                </ul>
                              </li>';
                        echo '<li><a href="portfolio.php?order=DESC">КАТАЛОГ</a>
                                <ul>
                                  <li><a href="portfolio.php?order=ASC">ПО ЦЕНЕ ^</a></li>
                                  <li><a href="portfolio.php?order=DESC">ПО ЦЕНЕ v</a></li>
                                  <li><a href="portfolio.php?order=SELLER">МОИ ТОВАРЫ</a></li>
							     </ul>
                              </li>';
                        echo '<li><a href="contact.php">КОНТАКТЫ</a>';
                        echo '<li><a href="logout.php">Выйти (' . $_SESSION['username'] . ')</a>';
                      }
                      else {
                        echo '<li><a href="index.php">ГЛАВНАЯ</a></li>';
                        echo '<li><a href="portfolio.php?order=DESC">КАТАЛОГ</a>
                                <ul>
                                  <li><a href="portfolio.php?order=ASC">ПО ЦЕНЕ ^</a></li>
                                  <li><a href="portfolio.php?order=DESC">ПО ЦЕНЕ v</a></li>
							     </ul>
                              </li>';
                        echo '<li><a href="page.php">РЕГИСТРАЦИЯ</a></li>';
                        echo '<li><a href="contact.php">КОНТАКТЫ</a>';
                        echo '<li><a href="loggin.php">ВОЙТИ</a>';
                      }
                      echo '<hr />';
                  ?>
                    
                    </ul>
				</nav>
			</div>
</header>