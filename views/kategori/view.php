<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kategori */

$this->title = "Kategori :" .$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-view box box-primary">

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
            'nama',
        ],
    ]) ?>

</div>

<div>&nbsp;</div>
<h1>Daftar Buku</h1>

<?= Html::a('TAMBAH BUKU', ['buku/create', 'id_kategori' => $model->id], ['class' => 'btn btn-primary']) ?>

<div>&nbsp;</div>

<table class="table box box-primary">
    <tr>
        <th>No.</th>
        <th>Nama Buku</th>
        <td>&nbsp;</td>
    </tr> 
    <?php $no=1; foreach ($model->findAllBuku() as $buku): ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= Html::a($buku->nama, ['buku/view','id'=>$buku->id]); ?></td>
            <td><?= Html::a("Edit", ["buku/update","id"=>$buku->id], ['class' => 'btn btn-primary']); ?> &nbsp;
                <?= Html::a("Hapus", ["buku/delete","id"=>$buku->id],['class' => 'btn btn-primary'], ['data-method'=>'post','data-confirm'=>'file akan di hapus?']); ?> &nbsp;
            </td>
        </tr>
        <?php $no++; endforeach ?>
</table>

