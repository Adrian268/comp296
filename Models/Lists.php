<?php
require_once 'Model.php';

class Lists extends Model{

    public  $table = 'lists';
    protected  $fillables = ['user_id', 'list_name', 'editable'];
    protected  $values = [];

    function __construct(){
        parent::__construct();
    }
}
