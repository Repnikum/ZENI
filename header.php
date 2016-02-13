
<header class="clearfix">
			<div class="wrapper clearfix">
		<!--		<a href="index.php" id="logo"><img  src="img/logo.png" alt="Zeni"></a> -->
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
                        echo '<li><a href="logout.php">ВЫЙТИ (' . $_SESSION['username'] . ')</a>';                        
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
                        echo '<li><a href="logout.php">ВЫЙТИ (' . $_SESSION['username'] . ')</a>';
                      }
                      else {
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
