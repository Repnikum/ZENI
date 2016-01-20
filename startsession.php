<?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['seller'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
      $_SESSION['seller'] = $_COOKIE['seller'];
    } else if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['buyer'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
      $_SESSION['buyer'] = $_COOKIE['buyer'];
    }
  }
?>