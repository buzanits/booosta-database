<?php
namespace booosta\database;

class Databaseclass
{
  static public function factory()
  {
    $module = \booosta\Framework::$CONFIG['db_module'];
    #\booosta\debug("module: $module");
    if($module != null) return "namespace booosta\\database; class DB extends \\booosta\\$module\\$module { use DBtrait; }";
    return '';
  }
}

eval(Databaseclass::factory());
