<?php
function dbconnection(){
$conn=mysql_connect("localhost","root","password");
mysql_select_db("pocdb");
return $conn;
}
?>