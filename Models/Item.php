<?php
require_once 'Model.php';


class Item extends Model{

    protected $table = 'items';
    protected  $fillables = ['list_id', 'user_id', 'item_name', 'quantity', 'purchased'];
    protected  $values = [];

}
