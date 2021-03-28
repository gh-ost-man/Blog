<?php
namespace models;

use core\BaseModel;

class CommentModel extends BaseModel
{
    public $id;
    public $id_user;
    public $id_record;
    public $date;
    public $status;
    public $text;
    public $like;
    public $dis_like;

    static $table = 'comments';
    const STATUS = ['approved' => 'approved', 'not_approved' => 'not approved'];

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