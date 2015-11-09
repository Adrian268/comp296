<?php
require_once 'Model.php';
require_once '../util/Database.php';

class model_name extends Model{

    protected $table = 'items';
    protected  $fillables = ['list_id', 'user_id', 'item_name', 'quantity', 'purchased'];
    protected  $values = [];

}

$item = new model_name();


$item->create('8', '1', 'Item Name', '0', '0');

$item->save();