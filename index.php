<?php
require "vendor/autoload.php";

use Calendar\Calendar;

$now = getdate(time());
$calendar = new Calendar($now["mon"], $now["year"]);
echo $calendar->getTable();