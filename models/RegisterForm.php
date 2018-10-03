<?php

namespace app\models;

use Yii;
use yii\base\Model;


class RegisterForm extends Model

{
    // DEKLARASI DARI REGISTER //
    public $username;
    public $password;
    public $alamat;
    public $telepon;
    public $nama;
    public $email;
    public $verifyCode;

   
    public function rules()
    {
        return [
            [['username', 'password', 'nama', 'alamat', 'telepon', 'email'], 'required'],
            [['password'], 'string', 'min'=>6],
            [['telepon'], 'match', 'pattern'=>'/^[0-9]\w*$/i', 'message'=>'hanya nomor dari 0 s/d 9'],
            [['email'], 'unique', 'targetClass'=>'\app\models\Anggota'],

            ['verifyCode', 'captcha'],
          
        ];
    }
}
