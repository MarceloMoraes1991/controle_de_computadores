<?php

$servidor   = "192.168.0.105";
$senha      = "652845";
$usuario    = "root";
$banco      = "tarefasdiarias";
$site       = "143.208.21.14/tarefasdiarias/";
$con = mysqli_connect($servidor,$usuario,$senha,$banco);
mysqli_set_charset ( $con , 'utf8' );
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_select_db($con,$banco);

?>