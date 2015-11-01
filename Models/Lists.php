<?php
require_once 'Model.php';

class Lists extends Model{

    public $table = 'lists';
    public $fillables = ['user_id', 'list_name', 'editable'];
    public $values = [];

    function __construct(){
        parent::__construct();

    }


}

$list = new Lists;

$list->create('1', 'new list', '1');
$list->save();
