<?php
	use yii\helpers\Html;
	use app\components\Helper;
?>

<table>
	<tr>
		<td class="tengah"><h2>Data Buku</h2></td>
	</tr>
	<tr>
		<td class="tengah"><h3>Perpustakaan Website</h3></td>
	</tr>
</table>

<br>
<table class="table-pdf" style="margin:auto; width:100%;">
	<thead>
		<tr>
			<th><?= strtoupper("No") ?></th>
			<th><?= strtoupper("Nama Buku") ?></th>
			<th><?= strtoupper("Tahun Terbit") ?></th>
			<th><?= strtoupper("Penulis") ?></th>
			<th><?= strtoupper("Penerbit") ?></th>
			<th><?= strtoupper("Kategori") ?></th>
			<th><?= strtoupper("Berkas") ?></th>
			<th><?= strtoupper("Sinopsis Detail") ?></th>
			<th><?= strtoupper("Sampul") ?></th>
			
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($model as $data) { ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $data->nama ?></td>
			<td><?= $data->tahun_terbit ?></td>
			<td><?= @$data->penulis->nama ?></td>
			<td><?= @$data->penerbit->nama ?></td>
			<td><?= @$data->kategori->nama ?></td>
			<td><?= $data->berkas ?></td>
			<td><?= $data->sinopsis ?></td>
			<td><img src="<?= Yii::$app->request->baseUrl.'/upload/sampul/'.$data['sampul'] ?>" width="20px"></td>

		</tr>
		<?php } ?>
	</tbody>
</table>