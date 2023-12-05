<?php
  // The global $_POST variable allows you to access the data sent with the POST method by name
  // To access the data sent with the GET method, you can use $_GET
  $uname = htmlspecialchars($_POST['uname']);
  $psw  = htmlspecialchars($_POST['psw']);
  
  echo '<html><body>';
  echo  'Username: ', $uname, '</p>', 'Password: ',$psw, '</p>';
  echo '<button type="submit" onclick="history.back()">Return to login</button>';
  echo '</body></html>';
?>
