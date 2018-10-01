<?php

namespace app\components;

use Yii;
use yii\base\Behavior;

class SoftDeleteBehavior extends Behavior
{
    public $status_hapus;
    public $waktu_hapus;
    public $id_user_hapus;

    public function softDelete($hard = false)
    {
        if ($hard) {
            return $this->owner->delete();
        }

        $this->owner->status_hapus = 1;
        $this->owner->waktu_hapus = date('Y-m-d H:i:s');
        $this->owner->id_user_hapus = @Yii::$app->user->identity->id;
        return $this->owner->save();
    }
}
