<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index box box-primary">

    <div class="box-header">
        <?= Html::a('Tambah Anggota', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

<div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
             [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.',
                'headerOptions' => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'text-align:center']
            ],
             [
               'attribute' =>'nama',
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
            ],
            [
               'attribute' =>'alamat',
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
            ],
            [
                'header'    => 'Jumlah Buku',
                'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
                'value'     => function($model){
                return $model->getJumlahBuku();
                }
            ], 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
