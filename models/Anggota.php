<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Anggota".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 * @property int $status_aktif
 */
class Anggota extends \yii\db\ActiveRecord
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
        return 'Anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['status_aktif'], 'integer'],
            [['nama', 'alamat'], 'string', 'max' => 255],
            [['telepon', 'email'], 'string', 'max' => 50],
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
            'status_aktif' => 'Status Aktif',
        ];
    }
    public function getAnggotaCount()
    {
        return static::find()->count();
    }
    public function getJumlahBuku()
    {
        return Buku::find()
    ->andWhere(['id_kategori' => $this->id])
    ->count();
    }
}
