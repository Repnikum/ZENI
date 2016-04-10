<?php
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$dbc->query( "SET CHARSET utf8" );

  // Retrieve the score data from MySQL
  $sid = $_SESSION['user_id'];
  $query = "SELECT * FROM product WHERE seller_id = '$sid' ORDER BY cost DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<div class="wrapper clearfix"><h2 class="page-heading"><span>УДАЛЕНИЕ ТОВАРА</span></h2>  ';
  echo '<table class="new">';
  echo '<tr><th>наименование</th><th>остаток</th><th>описание</th><th>цена</th><th>гарантия</th><th>действие</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['residue'] . '</td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td>' . $row['cost'] . '</td>';
    echo '<td>' . $row['guarantee'] . '</td>';
    
    $product_id = $row['product_id'];  
    $qery_order = "SELECT * FROM orders WHERE product_id = '$product_id'";
    $data_order = mysqli_query($dbc, $qery_order);
    $sum = 1;
    
    while ($row_order = mysqli_fetch_array($data_order)) { 
      $sum = $sum * $row_order['archive'];
    }
    
    if ($sum == 1){
        echo '<td><a href="removescore.php?product_id=' . $row['product_id'] . '&amp;description=' . $row['description'] . '&amp;name=' . $row['name'] . '&amp;cost=' . $row['cost'] .  '&amp;guarantee=' . $row['guarantee'] . '&amp;picture=' . $row['picture'] . '">удалить</a>';
    } else {
        echo '<td>завершите заказы<br>на этот товар';
    }
           
    echo '</td></tr>';
    echo '</div>';
  }
  echo '</table></div>';

  mysqli_close($dbc);
?>