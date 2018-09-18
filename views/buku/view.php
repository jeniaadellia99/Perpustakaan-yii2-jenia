<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Penulis;
use app\models\Penerbit;
use app\models\Kategori;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = "Buku :" .$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Bukus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-view box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             [
                'label' => 'Nama (Tahun)',
                'value' => $model->nama .  '('. $model->tahun_terbit. ')'
            ],
            [
                'attribute' => 'tahun_terbit',
                'value' => $model->tahun_terbit. '  (Tahun)'
            ],
           [
               'attribute' =>'id_penulis',
               'headerOptions' => ['style' => 'text-align:center;'],
               'value' => function($data){
                return $data->penulis->nama;
               }
           ],
          [
               'attribute' =>'id_penerbit',
               'headerOptions' => ['style' => 'text-align:center;'],
               'value' => function($data){
                return $data->penerbit->nama;
               }
           ],
            [
               'attribute' =>'id_kategori',
               'headerOptions' => ['style' => 'text-align:center;'],
               'value' => function($data){
            return @$data->kategori->nama;
               }
           ],
            'sinopsis:ntext',
              [
              'attribute' => 'sampul',
              'format' =>'raw',
              'value' => function ($model){
                if ($model->sampul != '') {
                    return Html::img('@web/upload/sampul/'. $model->sampul,['class'=>'img-responsive','style' => 'height:200px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],
            [
                'label' => 'berkas',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->berkas != '') {
                        return '<a href="' . Yii::$app->homeUrl . '/../upload/berkas/' . $model->berkas . '"><button class="glyphicon glyphicon-download-alt" size= "20px" type="submit"></button></div></a>';
                    } else { 
                        return '<div align="center"><h1>No File</h1></div>';
                    }
                },
            ],
        ],
    ]) ?>

</div>

