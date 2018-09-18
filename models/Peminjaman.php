<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Peminjaman".
 *
 * @property int $id
 * @property int $id_buku
 * @property int $id_anggota
 * @property string $tanggal_pinjam
 * @property string $tanggal_kembali
 */
class Peminjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Peminjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_anggota', 'tanggal_pinjam', 'tanggal_kembali'], 'required'],
            [['id_buku', 'id_anggota'], 'integer'],
            [['tanggal_pinjam', 'tanggal_kembali'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_buku' => 'Nama Buku',
            'id_anggota' => 'Nama Anggota',
            'tanggal_pinjam' => 'Tanggal Pinjam',
            'tanggal_kembali' => 'Tanggal Kembali',
        ];
    }
     public function getBuku()
    {
        return $this->hasOne(Buku::className(), ['id' => 'id_buku']);
    } 
    public function getAnggota()
    {
        return $this->hasOne(Anggota::className(), ['id' => 'id_anggota']);
    }
    public function getPeminjamanCount()
    {
        return static::find()->count();
    }
    public function findAllBuku()
    {
        return Buku::find()
    ->andWhere(['id_kategori' => $this->id])
    ->orderBy(['nama'=> SORT_DESC])
    ->all();
    }

}
