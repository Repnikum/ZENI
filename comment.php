<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>

<script type="text/javascript">
       function f() {
      var text = document.getElementById('comment');
      var content = text.value;
      var dlina = content.length;
      if(dlina > 256)
           text.value = content.substr(0,256);
      var poyasn = document.getElementById('d');
      var ostalos = 256 - dlina;
      if(ostalos < 0 )
       ostalos = 0;
      poyasn.innerHTML = 'Осталось символов ' + ostalos;
      }
 </script>

<?php
if (isset($_POST['submit'])) {
echo '<h3 class="heading">ВАШ ОТЗЫВ ПРИНЯТ В ОБРАБОТКУ</h3>';
  
require_once('startsession.php');
require_once('connectvars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$dbc->query( "SET CHARSET utf8" );
  
$comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];

$query = "INSERT INTO comment (user_id, product_id, date, description) VALUES ('$user_id', '$product_id', NOW(), '$comment')";
mysqli_query($dbc, $query);

} else {

echo '
<form name="ddd" action="'. $_SERVER['PHP_SELF'] .'?product_id='. $_GET['product_id'] .'" method="post" id="commentform">
  <h3 class="heading">ОСТАВИТЬ ОТЗЫВ</h3>

<h5><p id= "d">Осталось символов 256</p></h5>
<textarea name="comment" onclick="f()" onkeyup="f()" onKeyDown="f()" id="comment"  tabindex="1"></textarea>

  <p><input name="submit" type="submit" id="submit" tabindex="2" value="отправить" /></p>
</form>
';}
  
?>