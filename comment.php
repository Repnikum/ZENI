<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
if (isset($_POST['submit'])) {
echo '<h3 class="heading">ВАШ ОТЗЫВ ПРИНЯТ В ОБРАБОТКУ</h3>';
  
require_once('startsession.php');
require_once('connectvars.php');

$comment = $_POST['comment'];
$username = $_SESSION['username'];
$product_id = $_GET['product_id'];

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "INSERT INTO comment (username, product_id, date, description) VALUES ('$username', '$product_id', NOW(), '$comment')";
mysqli_query($dbc, $query);
mysqli_close($dbc);
} else {

echo '
<form action="'. $_SERVER['PHP_SELF'] .'?product_id='. $_GET['product_id'] .'" method="post" id="commentform">
  <h3 class="heading">ОСТАВИТЬ ОТЗЫВ</h3>
															
  <textarea name="comment" id="comment"  tabindex="1"></textarea>
									
  <p><input name="submit" type="submit" id="submit" tabindex="2" value="отправить" /></p>
</form>
';}
  
?>