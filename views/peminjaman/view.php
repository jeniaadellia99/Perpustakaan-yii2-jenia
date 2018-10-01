<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title ="Nama Anggota: " . $model->anggota->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-view box box-view">



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
            'attribute' => "id_buku",
            'value' => function($data){
                return @$data->buku->nama;
            }
        ],
            
        [
            'attribute' => "id_anggota",
            'value' => function($data){
                return $data->anggota->nama;
            }
        ],
             [
                'attribute' => 'tanggal_pinjam',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tanggal_pinjam);
                },
            ],
           
             [
                'attribute' => 'tanggal_kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tanggal_kembali);
                },
            ],
           
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



