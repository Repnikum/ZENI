<header class="clearfix">
			<div class="wrapper clearfix">
				<nav>
                    <ul id="nav" class="sf-menu">
                  <?php
                      if (isset($_SESSION['buyer'])) {
                        echo '<a href="index.php" id="logo"><img width="100" src="img/logo.png"/></a>';
                        echo '<li><a href="index.php">ГЛАВНАЯ</a>
                                    <ul>
                                      <li><a href="basket.php">КОРЗИНА</a></li>
                                      <li><a href="balance.php">БАЛАНС</a></li>
							       </ul>                      
                              </li>';
                        echo '<li><a href="portfolio.php?order=DESC">КАТАЛОГ</a>
                                <ul>
                                  <li><a href="portfolio.php?order=ASC">ПО ЦЕНЕ ^</a></li>
                                  <li><a href="portfolio.php?order=DESC">ПО ЦЕНЕ v</a></li>
							     </ul>
                              </li>';
                        echo '<li><a href="logout.php">ВЫЙТИ (' . $_SESSION['username'] . ')</a>';                        
                      }
                      else if (isset($_SESSION['seller'])) {
                        echo '<a href="index.php" id="logo"><img width="100" src="img/logo.png"/></a>';
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
                        echo '<li><a href="logout.php">ВЫЙТИ (' . $_SESSION['username'] . ')</a>';
                      }
                      else {
                        echo '<a href="index.php" id="logo"><img width="100" src="img/logo.png"/></a>';
                        echo '<li><a href="index.php">ГЛАВНАЯ</a></li>';
                        echo '<li><a href="portfolio.php?order=DESC">КАТАЛОГ</a>
                                <ul>
                                  <li><a href="portfolio.php?order=ASC">ПО ЦЕНЕ ^</a></li>
                                  <li><a href="portfolio.php?order=DESC">ПО ЦЕНЕ v</a></li>
							     </ul>
                              </li>';
                    /*    echo '<li><a href="page.php">РЕГИСТРАЦИЯ</a></li>'; */
                        echo '<li><a href="loggin.php">ВОЙТИ</a>';
                      }
                      echo '<hr />';
                  ?>
                    </ul>
				</nav>
			</div>
</header>
