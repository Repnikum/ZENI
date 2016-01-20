<div id="main">	
  <div class="wrapper clearfix">
    <h2 class="page-heading"><span>МОИ ЗАКАЗЫ</span></h2> 

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
  $sid = $_SESSION['user_id'];
    
  $query = "SELECT * FROM orders WHERE seller_id = '$sid' ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);

  echo '<table>';
  echo '<tr><th>название</th><th>цена</th><th>дата</th><th>способ получения</th><th>действие</th></tr>';
    
  while ($row = mysqli_fetch_array($data)) { 
    if ($row['payed'] == '1' && $row['archive'] == '0') {
    $product_id = $row['product_id'];
    $qery_product = "SELECT * FROM product WHERE product_id = '$product_id'";
    $data_product = mysqli_query($dbc, $qery_product);
    $row_product = mysqli_fetch_array($data_product);
    
    
    echo '<td>' . $row_product['name'] . '</td>';
    echo '<td>' . $row_product['cost'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['getting'] . '</td>';
    
    echo '<td><a href="orderremove.php?order_id='. $row['order_id'] .'&amp;name=' . $row_product['name'] . '&amp;description=' . $row_product['description'] . '&amp;cost=' . $row_product['cost'] .  '&amp;date=' . $row['date'] .'">товар продан</a>';
    if ($row['approved'] == '0') {
      echo ' / <a href="orderapprove.php?order_id='. $row['order_id'] .'&amp;name=' . $row_product['name'] . '&amp;description=' . $row_product['description'] . '&amp;cost=' . $row_product['cost'] .  '&amp;date=' . $row['date'] .'">подтвердить заказ</a>';
    }
    echo '</td></tr>';
    }
  }
  echo '</table><br/>';

  mysqli_close($dbc);
    
  echo '<h2 class="post-heading"><span>архив заказов</span></h2><br/>';
    
  require_once('appvars.php');
  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
  $sid = $_SESSION['user_id'];
    
  $query = "SELECT * FROM orders WHERE seller_id = '$sid' ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);

  echo '<table>';
  echo '<tr><th>название</th><th>цена</th><th>дата</th><th>способ получения</th><th>действие</th></tr>';
    
  while ($row = mysqli_fetch_array($data)) { 
    if ($row['payed'] == '1' && $row['archive'] == '1') {
    $product_id = $row['product_id'];
    $qery_product = "SELECT * FROM product WHERE product_id = '$product_id'";
    $data_product = mysqli_query($dbc, $qery_product);
    $row_product = mysqli_fetch_array($data_product);
    
    
    echo '<td>' . $row_product['name'] . '</td>';
    echo '<td>' . $row_product['cost'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['getting'] . '</td>';
    
    echo '<td><a href="orderrenove.php?order_id='. $row['order_id'] .'&amp;name=' . $row_product['name'] . '&amp;description=' . $row_product['description'] . '&amp;cost=' . $row_product['cost'] .  '&amp;date=' . $row['date'] .'">восстановить заказ</a>';
    
    echo '</td></tr>';
    }
  }
    mysqli_close($dbc);
  echo '</table><br/>';
?>