<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Penerbit".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 */
class Penerbit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
      public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
    public static function tableName()
    {
        return 'Penerbit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['nama', 'telepon'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 2555],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'email' => 'Email',
        ];
    }
      public function getPenerbitCount()
    {
        return static::find()->count();
    }
    public function getJumlahBuku()
    {
    return Buku::find()
    ->andWhere(['id_kategori' => $this->id])
    ->count();
    }
    public function findAllBuku()
    {
    return Buku::find()
    ->andWhere(['id_kategori' => $this->id])
    ->orderBy(['nama'=> SORT_DESC])
    ->all();
    }
}
