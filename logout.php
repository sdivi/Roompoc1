<?php
session_start();
session_unset();
session_destroy();
echo "session variable : " + $_SESSION['userId'];

?>