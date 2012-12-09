<?php
// RESPONSIVE WEB DESIGN TESTER
// https://github.com/remi-grumeau/Responsive-Design-Tester
//

$dval = (isset($_GET['d']))?preg_split('/x/',$_GET['d']):array('320','480');
$dval[2]=$dval[0].'x'.$dval[1];

$url = (isset($_GET['url']))?$_GET['url']:'';
$scroll = (isset($_GET['scroll']))?$_GET['scroll']:'off';
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Responsive Design Tester</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="responsive-design-tester.css" media="screen">
	<script type="text/javascript" charset="utf-8">
		function gbi(a) { return document.getElementById(a); }

		window.rdt =
		{
			w : <?php echo $dval[0] ?>,
			h : <?php echo $dval[1] ?>,

			resizeView : function() {
				var a = gbi('dselect').value.split('x');
				rdt.w=a[0];
				rdt.h=a[1];
				gbi('icontent').style.width=gbi('icontentfoot').style.width = rdt.w+'px';
				gbi('icontent').style.height = rdt.h+'px';
			},

			updateUrl: function() {
				setTimeout(function() {
					if(gbi('icontent').src!=gbi('urlinput').value)
						gbi('icontent').src=gbi('urlinput').value;
				}, 300);
				rdt.resizeView();
			},

			updateScroll: function() {
				gbi('main').removeChild(gbi('icontent'));
				var ifr = document.createElement('iframe');
				ifr.id='icontent';
				ifr.src=gbi('urlinput').value;
				ifr.scrolling=(gbi('scrollit').value=='on')?'yes':'no';
				gbi('scroll_hid').value=(gbi('scrollit').value=='on')?'on':'off';
				gbi('main').appendChild(ifr);
				rdt.resizeView();

			},
			rotate: function() {
				rdt.w = parseInt(gbi('icontent').style.width);
				rdt.h = parseInt(gbi('icontent').style.height);
				gbi('icontent').style.width=gbi('icontentfoot').style.width = rdt.h+'px';
				gbi('icontent').style.height = rdt.w+'px';
			}
		}
	</script>
</head>

<body>
	<header>
		<form method="GET" action="">
			<a class="prev" onclick="icontent.history.go(-1)"><</a>
			<a class="next" onclick="icontent.history.go(-1)">></a>
			<input type="url" id="urlinput" placeholder="Type your url here" name="url" value="<?php echo $url ?>" onKeyUp="rdt.updateUrl()" />
			<select name="d" size="1" id="dselect" onchange="rdt.resizeView()">
				<optgroup label="Desktop">
					<option value="1024x768"  <?php if($dval[2]=='1024x768') echo 'selected' ?>>1024x768</option>
					<option value="1280x800"  <?php if($dval[2]=='1280x800') echo 'selected' ?>>1280x800</option>
					<option value="1600x1400" <?php if($dval[2]=='1600x1400') echo 'selected' ?>>1600x1400</option>
					<option value="800x600"	  <?php if($dval[2]=='800x600') echo 'selected' ?>>800x600</option>
				</optgroup>
				<optgroup label="Tablets">
					<option value="600x800" <?php if($dval[2]=='600x800') echo 'selected' ?>>Amazon Kindle HD</option>
					<option value="768x1024" <?php if($dval[2]=='768x1008') echo 'selected' ?>>iPad - portrait</option>
					<option value="1024x768" <?php if($dval[2]=='1024x674') echo 'selected' ?>>iPad - landscape</option>
					<option value="1024x600" <?php if($dval[2]=='1024x600') echo 'selected' ?>>Samsung Galaxy Tab</option>
					<option value="1024x800" <?php if($dval[2]=='1024x800') echo 'selected' ?>>Samsung Galaxy Tab II</option>
				</optgroup>
				<optgroup label="Smartphones">
					<option value="320x416" <?php if($dval[2]=='320x416') echo 'selected' ?>>iPhone/iPod</option>
					<option value="640x832" <?php if($dval[2]=='640x832') echo 'selected' ?>>iPhone/iPod Retina</option>
					<option value="480x800" <?php if($dval[2]=='480x800') echo 'selected' ?>>Google Nexus S</option>
					<option value="480x640" <?php if($dval[2]=='480x640') echo 'selected' ?>>Samsung Galaxy S2</option>
					<option value="720x1280" <?php if($dval[2]=='720x1280') echo 'selected' ?>>Samsung Galaxy S3</option>
					<option value="768x1165" <?php if($dval[2]=='768x1165') echo 'selected' ?>>Nokia Lumia 920</option>
					<option value="320x240" <?php if($dval[2]=='320x240') echo 'selected' ?>>Blackberry Curve</option>
					<option value="640x480" <?php if($dval[2]=='640x480') echo 'selected' ?>>Blackberry Bold Touch HD</option>
				</optgroup>
				<optgroup label="Mobile">
					<option value="176x144" <?php if($dval[2]=='176x144') echo 'selected' ?>>Samsung Corby (176x144)</option>
					<option value="360x640" <?php if($dval[2]=='360x640') echo 'selected' ?>>Nokia N97  (360x640)</option>
					<option value="240x320" <?php if($dval[2]=='240x320') echo 'selected' ?>>Samsung Player MTV (240x320)</option>
					<option value="360x640" <?php if($dval[2]=='360x640') echo 'selected' ?>>Samsung Omnia HD (360x640)</option>
				</optgroup>
			</select>
			<input type="hidden" name="scroll" id="scroll_hid" value="<?php echo $scroll ?>">
			<button type="submit">ok</button>
		</form>
	</header>

	<section id="main">
		<div id="icontentfoot">
			<input type="checkbox" id="scrollit" onclick="rdt.updateScroll()" <?php if($scroll!='off') echo ' checked' ?>><label for="scrollit">&nbsp;scrollbars</label>
			<a href="#" onclick="rdt.rotate()">rotate</a>
		</div>
		<iframe id="icontent" src="<?php echo $url ?>" border="0" scrolling="<?php echo ($scroll!='off')?'yes':'no'; ?>" onload="rdt.resizeView()"></iframe>
	</section>

	<footer>
		<p>&copy;2011 <a href="https://github.com/remi-grumeau/Responsive-Design-Tester">Remi Grumeau</a> - Tested ok on modern browsers (Safari, Chrome, Firefox, Opera)</p>
	</footer>

</body>
</html>