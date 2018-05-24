<!DOCTYPE html>
<html>
<head>
  <title>Admin Area</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
  <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />
  <link rel="stylesheet" type="text/css" href="asset/css/core.css">
</head>
<body>
	<header>
		<div class="wrap">
			<!-- <div class="wrap-image">
				<img class="u-image" src="asset/img/user.png">
			</div> -->
			<div class="wrap-nav">
				<ul>
					<li><a href="#"><i style="inline-block" class="fa fa-home"></i> Hai</a></li>
					<li><a href="#"><i style="inline-block" class="fa fa-home"></i> Hai</a></li>
				</ul>
			</div>
			<div class="wrap-submenu">
					<table width="100%">
						<?php 
						define('MWB', NULL);
						function __($string) {
							return $string;
						}
						$menu[] = array('Header', __('Bibliographic'));
						$menu[] = array(__('Bibliographic List'), MWB.'bibliography/index.php', __('Show Existing Bibliographic Data'));
						$menu[] = array(__('Add New Bibliography'), MWB.'bibliography/index.php?action=detail', __('Add New Bibliographic Data/Catalog'));
						$menu[] = array('Header', __('Items'));
						$menu[] = array(__('Item List'), MWB.'bibliography/item.php', __('Show List of Library Items'));
						$menu[] = array(__('Checkout Items'), MWB.'bibliography/checkout_item.php', __('Show List of Checkout Items'));
						$menu[] = array('Header', __('Copy Cataloguing'));
						$menu[] = array(__('Z3950 SRU'), MWB.'bibliography/z3950sru.php', __('Grab Bibliographic Data from Z3950 SRU Web Services'));
						$menu[] = array(__('Z3950 Service'), MWB.'bibliography/z3950.php', __('Grab Bibliographic Data from Z3950 Web Services'));
						$menu[] = array(__('P2P Service'), MWB.'bibliography/p2p.php', __('Grab Bibliographic Data from Other SLiMS Web Services'));
						$menu[] = array('Header', __('Tools'));
						$menu[] = array(__('Slip Book'), MWB.'bibliography/slip_book.php', __('Print Slip Book'));
						$menu[] = array(__('Label Barcodes Printing'), MWB.'bibliography/label_barcode_generator.php', __('Print Label with Barcodes'));
						$menu[] = array(__('Label Barcodes Printing JS'), MWB.'bibliography/label_barcode_generator-js.php', __('Print Label with Barcodes JS'));
						$menu[] = array(__('Label Barcodes Printing JS Color'), MWB.'bibliography/label_barcode_generator_warna_js.php', __('Print Label with Barcodes JS'));
						$menu[] = array(__('Cetak QRcode Eksemplar'), MWB.'bibliography/item_qrcode_generator.php', __('Cetak QRCode Eksemplar'));
						$menu[] = array(__('Labels Printing'), MWB.'bibliography/dl_print.php', __('Print Document Labels'));
						$menu[] = array(__('Item Barcodes Printing'), MWB.'bibliography/item_barcode_generator.php', __('Print Item Barcodes'));
						$menu[] = array(__('Catalog Printing'), MWB.'bibliography/printed_card.php', __('Print Catalog Card'));
						$menu[] = array(__('MARC Import'), MWB.'bibliography/marcimport.php', __('Import Bibliographic Data from MARC file'));
						$menu[] = array(__('Data Export'), MWB.'bibliography/export.php', __('Export Bibliographic Data To CSV format'));
						$menu[] = array(__('Data Import'), MWB.'bibliography/import.php', __('Import Data to Bibliographic Database from CSV file'));
						$menu[] = array(__('Item Export'), MWB.'bibliography/item_export.php', __('Export Item/Copies data To CSV format'));
						$menu[] = array(__('Item Import'), MWB.'bibliography/item_import.php', __('Import Data to Item/Copies database from CSV file'));
						sort($menu);
						$menu = array_chunk($menu, 6);
						foreach ($menu as $value) {
							echo '<tr>';
							foreach ($value as $val) {
								if ($val[0] != 'Header') {
									echo "<td style=\"color: white;padding: 3px;\"><i class=\"fa fa-align-justify\"></i>&nbsp;".$val[0]."</td>";
								}
							}
							echo '</tr>';
						}
						?>
					</table>
			</div>
			<div class="loader">
				<?php $info = NULL; echo $info;?>
			</div>
			<div id="mainContent">
				
			</div>
		</div>
	</header>
	<footer>
		<span><img style="width: 33px;" src="asset/img/logo.png">&nbsp; AppName | Version</span>
	</footer>
</body> 
</html>