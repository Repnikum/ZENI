<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title> 
</head>

<?php
    require_once 'lib/SocialAuther/autoload.php';
    require_once('connectvars.php');
    require_once('appvars.php');

    $client_id = '5195426'; // ID приложения
    $client_secret = 'IwxgDT5XxJrM6UjEaXA0'; // Защищённый ключ
    $redirect_uri = 'http://localhost/www/zeni-files/indexVKbuy.php'; // Адрес сайта

    $url = 'http://oauth.vk.com/authorize';

    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'response_type' => 'code'
    );

    echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="img/social/vk.png"></a></p>';

if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token']
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    if ($result) {
        $url = pathinfo($userInfo['photo_big']);                                // получение URL аватарки в формате массива
        $target = GW_AVATARPATH . $url['basename'];                             // указание пути закачки файла
        file_put_contents($target, file_get_contents($userInfo['photo_big']));  // сохранение файла под названием picture.jpg
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT *  FROM users WHERE social_id = '{$userInfo['uid']}' LIMIT 1" ;
        $result2 = mysqli_query($dbc, $query);
      
        $record = mysqli_fetch_array($result2);
        if (!$record) {
            $social_id = $userInfo['uid'];
            $username = $userInfo['first_name'];
            $name = $userInfo['first_name'];
            $avatar = $url['basename'];
          
            $query = "INSERT INTO users (username, social_id, name, avatar) VALUES ('$username', '$social_id', '$name', '$avatar')";
            
            mysqli_query($dbc, $query);
          
            mysqli_close($dbc);
        } else {
            $social_id = $userInfo['uid'];
            $username = $userInfo['first_name'];
            $name = $userInfo['first_name'];
            $avatar = $url['basename'];

            $query = "UPDATE users SET `username` = '$username', `name` = '$username', `avatar` = '$avatar' WHERE `social_id`='$social_id'" ;

            mysqli_query($dbc, $query);

            mysqli_close($dbc);
        }
      
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $quer = "SELECT * FROM users WHERE social_id = '{$userInfo['uid']}' LIMIT 1" ;
        $data = mysqli_query($dbc, $quer);      
        
        while ($row = mysqli_fetch_array($data)) {
          $user_id = $row['user_id'];          
        }
      
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $userInfo['first_name'];
        $_SESSION['buyer'] = '1';
        setcookie('user_id', $user_id, time() + (60 * 60 * 24 * 30));    // expires in 30 days
        setcookie('username', $userInfo['first_name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
        setcookie('buyer', '1', time() + (60 * 60 * 24 * 30));
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
        header('Location: ' . $home_url);
    }
}
?>