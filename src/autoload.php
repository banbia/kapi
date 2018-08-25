<?php

  // Load configurations
  require "config/config.php";
  // Load authentication
  //require "libs/auth.php";
  // Load database connection
  require "libs/connection.php";
  // Load api
  require "routes/api.php";
  // Load ProUser user functions
  require "routes/proUsers.php";
  //Load History log functions
  require "routes/historiqueLog.php";
  //Load clients  functions
  require "routes/clients.php";
?>
