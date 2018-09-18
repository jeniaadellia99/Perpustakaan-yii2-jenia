<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Penulis;
use app\models\Penerbit;
use app\models\Kategori;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buku-form box box-primary">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_terbit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kategori')->widget(Select2::classname(), [
            'data' =>  Kategori::getList(),
            'options' => [
              'placeholder' => '- Pilih Kategori -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'id_penulis')->widget(Select2::classname(), [
            'data' =>  Penulis::getList(),
            'options' => [
              'placeholder' => '- Pilih Penulis -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'id_penerbit')->widget(Select2::classname(), [
            'data' =>  Penerbit::getList(),
            'options' => [
              'placeholder' => '- Pilih Penerbit -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'sinopsis')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'es',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

   <?= $form->field($model, 'sampul')->widget(FileInput::classname(), [
        'data' => $model->sampul,
        'options' => ['multiple' => true],
        
    ]); ?>

    <?= $form->field($model, 'berkas')->widget(FileInput::classname(), [
        'data' => $model->berkas,
        'options' => ['multiple' => true],
       
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
