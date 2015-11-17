<?php
require_once 'Model.php';


class Note extends Model{

    protected  $table = 'notes';
    protected  $fillables = ['item_id', 'user_id', 'content'];


}