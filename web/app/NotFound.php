<?php

class NotFound {
  public static function display() {
    header("HTTP/1.1 404 Not Found");

    echo <<<EOD
<html><head>
<title>404 Not Found</title>
</head>
<body>
  <h1>Not Found</h1>
  <p>The requested URL was not found on this server.</p>
  </body>
</html>
EOD;
  }
}

?>
