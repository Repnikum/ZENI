<div id="main">	
  <div class="wrapper clearfix">
    <h2 class="page-heading"><span>МОИ ЗАКАЗЫ</span></h2> 

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
  $uid = $_SESSION['user_id'];
    
  $query = "SELECT * FROM orders WHERE user_id = '$uid' ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);
    
  $query_user = "SELECT * FROM users WHERE user_id = '$uid'";
  $data_user = mysqli_query($dbc, $query_user);
  $row_user = mysqli_fetch_array($data_user);
  $balance = $row_user['balance'];

  echo '<table class="new">';
  echo '<tr><th>название</th><th>цена</th><th>дата</th><th>получение</th><th>статус</th><th>оплата</th><th>отмена</th></tr>';
    
  while ($row = mysqli_fetch_array($data)) {
    if (!$row['archive'] == 1){
    $product_id = $row['product_id'];
    $qery_product = "SELECT * FROM product WHERE product_id = '$product_id'";
    $data_product = mysqli_query($dbc, $qery_product);
    $row_product = mysqli_fetch_array($data_product);
    
    echo '<td>' . $row_product['name'] . '</td>';
    echo '<td>' . $row_product['cost'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['getting'] . '</td>';
    
    if ($row['approved'] == '0') {
      echo '<td>заказ не подтвержден продавцом</td>';
    } else if ($row['approved'] == '1') {
      echo '<td>заказ принят в обработку</td>';
    }
    
    if (($row['payed'] == '0') && ($balance >= $row_product['cost'])) {
      echo '<td><a href="orderpayment.php?order_id='. $row['order_id'] .'&amp;name=' . $row_product['name'] . '&amp;description=' . $row_product['description'] . '&amp;cost=' . $row_product['cost'] .  '&amp;date=' . $row['date'] .  '&amp;seller_id=' . $row['seller_id'] .'">оплатить заказ</a></td>';
    } else if (($row['payed'] == '0') && ($balance < $row_product['cost'])) {
      echo '<td>у Вас недостаточно средств для оплаты заказа</td>';
    } else if ($row['payed'] == '1') {
      echo '<td>заказ оплачен</td>';
    }
    
    echo '<td><a href="buyer_orderremove.php?order_id='. $row['order_id'] .'&amp;name=' . $row_product['name'] . '&amp;description=' . $row_product['description'] . '&amp;cost=' . $row_product['cost'] .  '&amp;date=' . $row['date'].  '&amp;product_id=' . $row['product_id'].'">отменить</a></td>';
    
    echo '</td></tr>';
    }
  }
  echo '</table><br/>';
    
?>