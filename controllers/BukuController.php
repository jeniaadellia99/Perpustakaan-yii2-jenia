<?php

namespace app\controllers;

use Yii;
use app\models\Buku;
use app\models\BukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ArrayHelper;
use PhpOffice\PhpWord\IOfactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * BukuController implements the CRUD actions for Buku model.
 */
class BukuController extends Controller
{
  public $layout = 'main';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Buku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Buku model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Buku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_kategori=null, $id_penulis=null, $id_penerbit=null)
    {
        $model = new Buku();
        $model->id_kategori = $id_kategori;
        $model->id_penulis = $id_penulis;
        $model->id_penerbit = $id_penerbit;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sampul = UploadedFile::getInstance($model,'sampul');
            $berkas = UploadedFile::getInstance($model,'berkas');

            $model->sampul = time().'_'.$sampul->name;
            $model->berkas = time().'_'.$berkas->name;

            $model->save(false);

            $sampul->saveAs(Yii::$app->basePath.'/web/upload/sampul/'.$model->sampul);
            $berkas->saveAs(Yii::$app->basePath.'/web/upload/berkas/'.$model->berkas);

            return $this->redirect(['view','id'=>$model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Buku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Buku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Buku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buku::findOne($id)) !== null) {
            return $model;
        }

        throw ('File yang anda cari tidak ditemukan.');
    }

public function actionJadwalPl()
{
    $phpWord = new phpWord();
       $phpWord->setDefaultFontSize(11);

       $section = $phpWord->addSection(
        [
            'marginTop' => Converter::cmTotwip(1.80),
            'marginBottom' => Converter::cmTotwip(1.80),
            'marginLeft' => Converter::cmTotwip(1.2),
            'marginRight' => Converter::cmTotwip(1.6),
        ]
       );

       $fontStyle = [
        'underline' => 'dash',
        'bold' => true,
        'italic' => true,
       ];

       $bgColor = [
        'bgColor' => '0000FF',
       ];

       $paragraphCenter = [
        'alignment'=>'center',

       ];

       $headerStyle = [
        'bold' => true,
       ];

      //  $addImages = [
      //   array(
      //   'width'         => 100,
      //   'height'        => 100,
      //   'marginTop'     => -1,
      //   'marginLeft'    => -1,
      //   'wrappingStyle' => 'behind'

      // )];
      // $footer = $section->addFooter();
      // $footer->addImage('@web/upload/sampul/');

       $section->addText(
                'PERPUSTAKAAN ONLINE',
                 $bgColor,
                $paragraphCenter,
               
                $headerStyle
                 
       );

       $section->addText(
        'Jenia Adellia Puspita',
        $headerStyle,
        $paragraphCenter,
        $fontStyle
       );

       $judul = $section->addTextRun($paragraphCenter);

       $judul->addText('Daftar Buku ', $fontStyle);
      $judul = $section->addTextRun($paragraphCenter);

       $judul->addText('jeniaaaa ', ['italic' =>true]);
        $section->addTextBreak(1);

       $judul->addText('Perpustakaan Jenia ', ['bold' =>true]);
        $section->addTextBreak(1);


       $table = $section->addTable([
        'alignment' => 'center',
        'bgColor'   => '000000',
        'borderSize'=> 6,
       ]);

       $table->addRow(null);
       $table->addCell(500)->addText('NO', $headerStyle, $paragraphCenter);
       $table->addCell(5000)->addText('Nama Buku', $headerStyle, $paragraphCenter);
       $table->addCell(5000)->addText('Tahun Terbit', $headerStyle, $paragraphCenter);
       $table->addCell(2000)->addText('Kategori', $headerStyle, $paragraphCenter);
       $table->addCell(2000)->addText('Penulis', $headerStyle, $paragraphCenter);
       $table->addCell(2000)->addText('Penerbit', $headerStyle, $paragraphCenter);
       $table->addCell(2000)->addText('Sampul', $headerStyle, $paragraphCenter);
      // ========SELECT * FROM ===============//
         $semuaBuku = Buku::find()->all(); $nomor = 1;
        foreach ($semuaBuku as $buku) {
        $table->addRow(null);
        $table->addCell(500)->addText($nomor++, null, $paragraphCenter);
        $table->addCell(5000)->addText($buku->nama, null, $paragraphCenter);
        $table->addCell(5000)->addText($buku->tahun_terbit,null, $paragraphCenter);
        $table->addCell(2000)->addText($buku->getKategori(), null, $paragraphCenter);
        $table->addCell(2000)->addText($buku->getPenulis(), null, $paragraphCenter);
        $table->addCell(2000)->addText($buku->getPenerbit(), null, $paragraphCenter);
        // $table->addCell(2000)->addImage($buku->sampul, null, $addImage);

}
       // $section->addText(
       //  'teks 1 2 3',
       //  ['bold' => true],
       //  ['alignment' => 'center']
       // );

//         $semuaBuku = Buku::find()->all();
//         foreach ($semuaBuku as $buku ) {
//         $section->addText($buku->nama);
// }

       // $section ->addListItem('List Item I', 0);
       // $section ->addListItem('List Item I.a', 1);
       // $section ->addListItem('List Item I.b', 1);
       // $section ->addListItem('List Item II', 0);


       $filename = time() . 'Jadwal-PL.docx';
       $path = 'exportfile/'. $filename;
       $xmlWriter = IOfactory::createWriter($phpWord,'Word2007');
       $xmlWriter -> save($path);
       return $this -> redirect($path);
    
}

    public function actionExportWord()
    {
       $phpWord = new phpWord();
       $phpWord->setDefaultFontSize(11);

       $section = $phpWord->addSection(
        [
            'marginTop' => Converter::cmTotwip(1.80),

            'marginBottom' => Converter::cmTotwip(1.80),
            'marginLeft' => Converter::cmTotwip(1.2),
            'marginRight' => Converter::cmTotwip(1.6),

        ]
       );

       $fontStyle = [
        'underline' => 'dash',
        'bold' => true,
        'italic' => true,
       ];

       $paragraphCenter = [
        'alignment'=>'center',

       ];

       $section->addText(
                'jadwal pengadaan langsung',
                $fontStyle,
                $paragraphCenter
       );

       $judul = $section->addTextRun($paragraphCenter);

       $judul -> addText('pengadaan jasa ', $fontStyle);
         $judul -> addText('Konsultasi ', ['italic' =>true]);
          $judul -> addText('Sistem Informasi ', ['bold' =>true]);

       $section->addText(
        'teks 1 2 3',
        ['bold' => true],
        ['alignment' => 'center']
       );

$semuaBuku = Buku::find()->all();
foreach ($semuaBuku as $buku ) {
    $section->addText($buku->nama);
}

       $section ->addListItem('List Item I', 0);
       $section ->addListItem('List Item I.a', 1);
       $section ->addListItem('List Item I.b', 1);
       $section ->addListItem('List Item II', 0);



       $filename = time() . 'test.docx';
       $path = 'exportfile/'. $filename;
       $xmlWriter = IOfactory::createWriter($phpWord,'Word2007');
       $xmlWriter -> save($path);
       return $this -> redirect($path);
    }


    public function actionExportExcel() {
     
    $spreadsheet = new PhpSpreadsheet\Spreadsheet();
    $worksheet   = $spreadsheet->getActiveSheet();
     
    //Menggunakan Model

    $database = Buku::find()
    ->select('nama, tahun_terbit')
    ->all();

    $worksheet->setCellValue('A1', 'Judul Buku');
    $worksheet->setCellValue('B1', 'Tahun Terbit');
     
    //JIka menggunakan DAO , gunakan QueryAll()
     
    /*
     
    $sql = "select kode_jafung,jenis_jafung from ref_jafung"
     
    $database = Yii::$app->db->createCommand($sql)->queryAll();
     
    */
     
    $database = \yii\helpers\ArrayHelper::toArray($database);
    $worksheet->fromArray($database, null, 'A2');
     
    $writer = new Xlsx($spreadsheet);
     
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="buku.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
     
    }
}










