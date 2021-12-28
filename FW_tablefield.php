<?php
namespace booosta\database;

class FW_tablefield
{
  public $name, $autoval, $primarykey, $default, $type, $param, $null;

  public function __construct($name, $autoval, $primarykey, $default, $type = null, $param = null, $null = null)
  {
    $this->name = $name;
    $this->autoval = $autoval;
    $this->primarykey = $primarykey;
    $this->default = $default;
    $this->type = $type;
    $this->param = $param;
    $this->null = $null;
  }
}
