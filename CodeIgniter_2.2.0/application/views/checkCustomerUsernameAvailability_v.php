<?php
if(!($row = mysql_fetch_array($resultSet['resultSet'])))
{
	echo'available';
}
else
{
	echo'unavailable';
}
?>