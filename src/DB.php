<?php
namespace booosta\database;

$module = \booosta\Framework::$CONFIG['db_module'];
if($module) include_once __DIR__ . "/../../$module/src/class.incl.php";
