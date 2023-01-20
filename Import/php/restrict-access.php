<?php

function CheckAccess()
{
  $allowedip1 = '::1';
  $allowedip2 = '127.0.0.1';

  $ip = $_SERVER['REMOTE_ADDR'];
  return ($ip == $allowedip1 OR $ip == $allowedip2);
}

  if (!CheckAccess())
{
  die('Access denied!');
  $conn->close();
}

?>