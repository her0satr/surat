<?php
	preg_match('/([\d]+)$/i', $_SERVER['REQUEST_URI'], $match);
	$letter_id = (!empty($match[1])) ? $match[1] : 0;
	$letter = $this->Letter_New_model->get_by_id(array( 'id' => $letter_id ));
	if (count($letter) == 0) {
		show_404();
	}
?>

<style>
.clear { clear: both; }
.h-column { float: left; width: 33%; font-size: 13px; }
</style>

<div style="width: 1000px; margin: 0 auto;">
	<div style="float: left; width: 175px;">
		<img src="<?php echo base_url('static/img/logo.jpg'); ?>" style="width: 150px;" />
	</div>
	<div style="float: left; width: 825px;">
		<div style="font-size: 16px; font-weight: bold;">PPLP-PT PGRI MALANG</div>
		<div style="font-size: 12px; font-weight: bold;">Kepmenkumham RI No. C-55.HT.01.03.TH.2007</div>
		<div style="font-size: 20px; font-weight: bold;">UNIVERSITAS KANJURUHAN MALANG</div>
		<div style="padding: 0 0 5px 0;">
			<div class="h-column">FAKULTAS TEKNOLOGI INFORMASI</div>
			<div class="h-column">FAKULTAS EKONOMI</div>
			<div class="h-column">FAK. KEGURUAN DAN ILMU</div>
			<div class="h-column">FAKULTAS PETERNAKAN</div>
			<div class="h-column">FAKULTAS BAHASA & SASTRA</div>
			<div class="h-column">PROGRAM PASCASARJANA</div>
			<div class="h-column">FAKULTAS HUKUM</div>
			<div class="clear"></div>
		</div>
		<div style="font-size: 10px;">Jl. S. Supriadi No. 48 Telp. (0341) 801488, 803194, 805264 Malang Fax. 831532</div>
		<div style="font-size: 10px;">Website : http://www.ukanjuruhan.ac.id	Email : kanjuruhan@ukanjuruhan.ac.id</div>
	</div>
	<div class="clear"></div>
	<div style="border-top: 2px solid #000000;"><div style="margin: 2px 0 0 0; border-top: 1px solid #000000;">&nbsp;</div></div>
	
	<div style="float: right;"><?php echo GetFormatDate($letter['date_surat'], array( 'FormatDate' => 'j F Y', )); ?></div>
	<div>No Surat : <?php echo $letter['no_surat']; ?></div>
	<div style="font-size: 12px;"><?php echo $letter['desc']; ?></div>
</div>

<script>
// window.print();
</script>