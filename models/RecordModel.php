<?php
namespace models;

use core\BaseModel;

class RecordModel extends BaseModel
{
    public $id;
    public $id_user;
    public $date;
    public $status;
    public $text;
    public $like;
    public $dis_like;

    static $table = 'records';
    
    const STATUS = ['approved' => 'approved', 'not_approved' => 'not approved', 'delele' => 'delete'];


    public function rules() 
    {
        return [
             'required' => ['text'],
             'string' => ['text']
        ];
    }

    static function getStatuses()
    {
        return self::STATUS;
    }
}