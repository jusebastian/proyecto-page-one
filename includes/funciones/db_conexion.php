<?php

  try {
    $con = new mysqli('localhost','root','','gdlwecam');
  } catch (Exception $e) {
    $error = $e->getMessage();
  }



 ?>
