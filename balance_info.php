<div id="main">	
  <div class="wrapper clearfix">
    <h2 class="page-heading"><span>БАЛАНС СЧЕТА</span></h2> 

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$dbc->query( "SET CHARSET utf8" );
      
  $uid = $_SESSION['user_id'];
    
  $query = "SELECT * FROM orders WHERE user_id = '$uid' ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);
    
  $query_user = "SELECT * FROM users WHERE user_id = '$uid'";
  $data_user = mysqli_query($dbc, $query_user);
  $row_user = mysqli_fetch_array($data_user);
  $balance = $row_user['balance'];

  echo '<table class="new">';
  echo '<tr><th>остаток</th><th>пополнить</th></tr>';
    
echo '<td>'. $balance .' Р</td>';
echo '<td><a href="balance_app.php">перейти к оплате</a></td>';
    
    echo '</td></tr>';
    echo '</table><br/>';
    
?>