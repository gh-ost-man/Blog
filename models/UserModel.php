<?php
namespace models;

use core\BaseModel;

class UserModel extends BaseModel
{
    public $id;
    public $email;
    public $nick;
    public $password;
    public $url_avatar;
    public $role;

    static $table = 'users';

    const ROLE = ['administrator' => 'Administrator', 'follower' => 'Follower', 'author' => 'Author'];

    public function rules() 
    {
        return [
            'required' => ['email','nick','password'],
            'email'=> ['email'],
            'string' => ['nick','password','role']
        ];
    }

    static function getRoles()
    {
        return self::ROLE;
    }
    public function userValidate($model)
    {
        //  Стандартні валідації
        //  $this->validate();
        //  Додаткорві методи валідації
    }
}