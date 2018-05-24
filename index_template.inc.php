<?php
/**
 * Yoha main index_template
 *
 * Copyright (C) 2018  Drajat Hasan (drajathasan20@gmail.com)
 *
 * proudly for Yohana Htp :)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
/* Version */
define('TEMName', 'Yoha Beta 5');
// Call function
include 'yoha_function.php';
// Var
$moduleData = getModule();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
  <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />
  <link rel="icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
  <link href="<?php echo SWB; ?>template/core.style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo JWB; ?>colorbox/colorbox.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo JWB; ?>chosen/chosen.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo JWB; ?>jquery.imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo AWB.'admin_template/yoha/'?>asset/css/core.css">
  <script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>updater.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>gui.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>form.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>calendar.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>keyboard.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>chosen/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>chosen/ajax-chosen.min.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>tooltipsy.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>webcam.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>scanner.js"></script>
</head>
<body>
	<header <?php echo $moduleData[0];?>>
		<div class="wrap">
			<!-- <div class="wrap-image">
				<img class="u-image" src="asset/img/user.png">
			</div> -->
			<div class="activeMenu" menu=""></div>
			<div class="wrap-nav">
				<ul>
					<?php echo $moduleData[1];?>
				</ul>
			</div>
			<div class="wrap-submenu" style="display: none;">
				    <?php echo yoha_menu();?>
			</div>
			<div class="loader" style="display: block;width: 100%;background: #0085ec;padding: 10px;color: white;margin-top: 12px;">
				<?php echo $info;?>
				<a class="notAJAX" href="logout.php" style="color:white; float: right; text-decoration: none;"><i class="fa fa-sign-out"></i> &nbsp;Keluar</a>
			</div>
			<div id="mainContent">
				<?php
	            if(isset($_GET['mod']) && ($_GET['mod'] == 'system')) {
	              include "modules/system/index.php";
	              echo "<script>$('#mainForm').attr('action','".AWB."modules/system/index.php');</script>";
	            }
	            ?>
			</div>
		</div>
		<script type="text/javascript">
			/* JS Area */
			$('.wrap-nav .click').click(function(){
				var wrap_submenu = $('.wrap-submenu');
				var wrap_submenu_data = $(this).attr('submenu');
				var show = $(this).attr('show');
				var activeMenu = $('.activeMenu');

				// Click with same value
				if (activeMenu.attr('menu') == wrap_submenu_data) {
					$(this).attr('show', 0);
					activeMenu.attr('menu', 'null');
					$('.submenu').attr('style', 'display: none;');
					wrap_submenu.slideUp('slow');
					return false;
				}
				
				// Click at first
				if (show == 0) {
					$('.submenu').attr('style', 'display: none;');
					$('.'+wrap_submenu_data).removeAttr('style');
					activeMenu.attr('menu', wrap_submenu_data);
					wrap_submenu.slideDown('slow');
					$(this).attr('show', 1);
				} else {
					wrap_submenu.slideDown();
					$('.'+activeMenu.attr('menu')).attr('style', 'display: none;');
					$('.'+wrap_submenu_data).removeAttr('style');
					activeMenu.attr('menu', wrap_submenu_data);
				}

				$('.menu').click(function(){
					activeMenu.attr('menu', 'null');
					$('.submenu').attr('style', 'display: none;');
					wrap_submenu.slideUp('slow');
				});
			});
			// Opac
			$('.opac').bind('click', function(evt) {
		    	evt.preventDefault();
		    	top.jQuery.colorbox({iframe:true,
		    	  href: $(this).attr('href'),
		          width: function() { return parseInt($(window).width())-50; },
		          height: function() { return parseInt($(window).height())-50; },
		          title: function() { return 'Online Public Access Catalog'; } }
		        );
		    });
		    // Dashboard
		    $('.dashboard').click(function(){
		    	window.location = $(this).attr('href');
		    });
		</script>
	</header>
	<div class="foot">
		<span style="float:left; padding-top: 5px;"><?php echo SENAYAN_VERSION;?></span>
		<span><img style="width: 33px;" src="<?php echo AWB;?>admin_template/yoha/asset/img/logo.png">&nbsp; <?php echo $sysconf['library_name'].' - '.$sysconf['library_subname']?> </span>
	</div>
	<iframe name="blindSubmit" style="display: none;"></iframe>
</body> 
</html>