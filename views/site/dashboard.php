<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Buku;
use app\models\Anggota;
use app\models\Penulis;
use app\models\Penerbit;
use app\models\Kategori;
use app\models\Peminjaman;
use miloschuman\highcharts\Highcharts;
use yiier\chartjs\ChartJs;
use app\models\User;
// use dosamigos\chartjs\ChartJs;
/* @var $this yii\web\View */

$this->title = "Halaman Dashboard";
?>

<?php if (User::isAdmin()) {?>
 <div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <p><b>Jumlah Buku</b></p>

                <h3><?= Yii::$app->formatter->asInteger(Buku::getBukuCount()); ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="<?=Url::to(['buku/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
                <p><b>Jumlah Peminjaman</b></p>


                <h3><?= Yii::$app->formatter->asInteger(Peminjaman::getPeminjamanCount()); ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-comments-o"></i>
            </div>
            <a href="<?=Url::to(['peminjaman/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

     <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-teal">
            <div class="inner">
                <p><b>Jumlah Anggota</b></p>


                <h3><?= Yii::$app->formatter->asInteger(Anggota::getAnggotaCount()); ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="<?=Url::to(['peminjaman/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

     <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-lime">
            <div class="inner">
                <p><b>Jumlah Penerbit</b></p>


                <h3><?= Yii::$app->formatter->asInteger(Penerbit::getPenerbitCount()); ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?=Url::to(['penerbit/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
  </div>

 
    <!-- ====GRAFIK=== -->
<div class="row">
  <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Buku Berdasarkan Kategori</h3>
            </div>
            <div class="box-body">
                <?=Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'KATEGORI BUKU'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                                'type' => 'pie',
                                'name' => 'Kategori',
                                'data' => Kategori::getGrafikList(),
                            ],
                        ],
                    ],
                ]);?>
            </div>
        </div>
    </div>

<!-- GRAFIKKKKKKKK -->
  <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Buku Berdasarkan Penulis</h3>
            </div>
            <div class="box-body">
                <?=Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'PENULIS BUKU'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                                'type' => 'pie',
                                'name' => 'Penulis',
                                'data' => Penulis::getGrafikList(),
                            ],
                        ],
                    ],
                ]);?>
        </div>
    </div>
</div>
</div>

<?php } elseif (User::isAnggota()) { ?>
    <div class="row">
  <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Buku Berdasarkan Kategori</h3>
            </div>
            <div class="box-body">
                <?=Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'KATEGORI BUKU'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'line' => [
                                'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                                'type' => 'line',
                                'name' => 'Kategori',
                                'data' => Kategori::getGrafikList(),
                            ],
                        ],
                    ],
                ]);?>
            </div>
        </div>
    </div>
</div>

<?php } elseif (User::isPetugas()) { ?>
    <div class="row">
  <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Buku Berdasarkan Kategori</h3>
            </div>
            <div class="box-body">
                <?=Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'KATEGORI BUKU'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'line' => [
                                'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                                'type' => 'line',
                                'name' => 'Kategori',
                                'data' => Kategori::getGrafikList(),
                            ],
                        ],
                    ],
                ]);?>
            </div>
        </div>
    </div>
</div>
<?php } ?>