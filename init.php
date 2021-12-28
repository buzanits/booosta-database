<?php
namespace booosta\database;

#if(\booosta\Framework::$CONFIG['db_module'])
  \booosta\add_module_trait('base', 'database\base');

\booosta\add_module_trait('base', 'database\base_init');

trait Base_init
{
  protected function autorun_database()
  {
    $this->__get['DB'] = 'init_db';
  }
}

trait Base
{
  public function init_db($host = null, $user = null, $password = null, $db = null)
  {
    if(is_object($this->DB)) return $this->DB;
    if(is_object($this->parentobj) && is_object($this->DB = $this->parentobj->init_db($host, $user, $password, $db))) return $this->DB;

    return $this->DB = $this->makeInstance('\booosta\database\DB', $host, $user, $password, $db);
  }
}

trait DBtrait
{
  public function value($table, $id, $namefield = 'name', $idfield = 'id')
  {
    $result = $this->query_value("select `$namefield` from `$table` where `$idfield`='$id'");
    if($error = $this->get_error()) return "ERROR: $error";
    return $result;
  }

  public function make_search_clause($patterns, $fields, $operator = 'or')
  {
    if(!is_array($patterns)) $patterns = [$patterns];
    if(!is_array($fields)) $fields = [$fields];

    $result = [];
    foreach($patterns as $pattern):
      $subresult = '';

      foreach($fields as $field):
        if(strstr($field, '.')):
          list($a, $b) = explode('.', $field);
          $fieldstr = "`$a`.`$b`";
        else:
          $fieldstr = "`$field`";
        endif;
        $subresult[] = "$fieldstr like '%$pattern%'";
      endforeach;

      $result[] = '(' . implode(' or ', $subresult) . ')';
    endforeach;

    return '(' . implode(" $operator ", $result) . ')';
  }
}
?>
