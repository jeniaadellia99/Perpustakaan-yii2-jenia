<?php

namespace app\components;

use yii\helpers\Html;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * Class BaseActiveRecord
 * @package app\components
 */

class BaseActiveRecord extends \yii\db\ActiveRecord
{

	public $controller;

	public function getAccessView() {
		return true;
	}

	public function getAccessUpdate() {

		if(User::isAdmin()) {
			return true;
		}

		return false;
	}

	public function getAccessDelete() {

		if(User::isAdmin()) {
			return true;
		}

		return false;
	}

	public function getLinkViewIcon()
	{
		if(@$this->accessView==true) {
			return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',[$this->controller.'/view','id'=>$this->id],['data-toggle'=>'tootltip','title'=>'Lihat']);
		}
	}

	public function getLinkUpdateIcon()
	{
		if(@$this->accessUpdate==true) {
			return Html::a('<i class="glyphicon glyphicon-pencil"></i>',[$this->controller.'/update','id'=>$this->id],['data-toggle'=>'tootltip','title'=>'Ubah']);	
		}		
	}

	public function getLinkDeleteIcon()
	{
		if(@$this->accessDelete==true) {
			return Html::a('<i class="glyphicon glyphicon-trash"></i>',[$this->controller.'/delete','id'=>$this->id],['data-toggle'=>'tootltip','title'=>'Hapus','data-confirm'=>'Yakin akan menghapus data?','data-method'=>'post']);
		}
	}

	public function getLinkViewNama()
	{
		if(@$this->accessView==true) {
			return Html::a($this->nama,[$this->controller.'/view','id'=>$this->id],['data-toggle'=>'tootltip','title'=>'Lihat']);
		}
	}

    public function getHoverNama($length=25)
    {
        return '<span data-toggle="tooltip" title="'.$this->nama.'">'.substr($this->nama, 0, $length).'..</span>';
    }

	public static function getList()
	{
		return ArrayHelper::map(self::find()->all(),'id','nama');
	}

	public function getLinkActionColumn() 
	{
		$output = '';
		$output .= $this->getLinkViewIcon().' ';
		$output .= $this->getLinkUpdateIcon().' ';
		$output .= $this->getLinkDeleteIcon().' ';

		return trim($output);

	}

    /**
     * @return null|string
     */
    public function getLinkUpdateButton($params=[])
    {
        if ($this->getAccessUpdate() == false) {
            return null;
        }

        $class = 'btn btn-success btn-flat';

        if (@$params['pull-right']) {
            $class .= ' pull-right';
        }

        if(@$this->getAccessUpdate() == true) {
            return Html::a('<i class="glyphicon glyphicon-pencil"></i> Ubah Data',[$this->controller.'/update','id'=>$this->id],['class'=>$class, 'data-toggle'=>'tootltip','title'=>'Ubah']);
        }
    }

    /**
     * @return bool
     */
    public static function getAccessCreate()
    {
        if(User::isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return null|string
     */
    public static function getLinkCreateButton()
    {
        if(self::getAccessCreate()) {
            return Html::a('<i class="fa fa-plus"></i> Tambah Data', [$this->controller.'/create'], ['class' => 'btn btn-success btn-flat']);
        }

        return null;

    }



}


?>