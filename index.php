<?php 
include('functions.php');
?>
<html>
	<head>
		<title>Color themes generator</title>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<style>
			body {
				font-family: Roboto;
				font-weight: 400;
				background: #333;
				color: #FFF;
				padding: 0px;
				margin: 0;
			}
			
			header {
				background: #111;
				padding: 10px 0 10px 30px;
			}
			
			header a {
				color: #ccc;
				font-size: 12px;
			}
			
			section {
				padding: 0 30px 30px;
			}
			
			h1 {
				font-size: 60px;
				font-weight: 300;
				margin-bottom: 20px;
			}
			
			h2 { 
				font-size: 22px;
				font-weight: 400;
				margin: 40px 0px 10px;
		  }
		  
			p {
				font-weight: 300;
				font-style: italic;
				text-align: center;
				line-height: 1.6em;
				width: 90%;
				display: block;
				margin: 0 auto;
				color: #CCC;
			}
			
			p a {
				color: #CCC;
			}
		  
		  .color {
		  	display: inline-block;
		  	width: 20%;
		  	max-width: 150px;
		  	height: 20%;
		  	min-height: 70px;
		  	max-height: 150px;
		  	position: relative;
		  	-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
		  }
		  
		  .color label {
		  	font-size: 10px;
		  	text-align: center;
		  	display: block;
		  	padding: 5px;
		  	position: absolute;
		  	bottom: 0;
		  	width: 100%;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;		  
				background: rgba(0,0,0,0.2);	
		  }
		  
		  .examples {
		  	list-style-type: none;
		  	padding: 0;
		  	margin: 0;
		  }
		  
		  .examples li {
		  	display: inline-block;
		  }
		  .examples li a {
		  	display: block;
		  	width: 30px;
		  	height: 30px;
		  }
		</style>
	</head>
	<body>
		<header><a href="http://wpfw.net">Back to wpfw.net website</a></header>
		<section>
			<h1>Color Themer</h1>
			<ul class="examples">
				<?php 
				$excolors = array('16a085', '27ae60', '2980b9', '8e44ad', 'e67e22', 'd35400', 'e74c3c');
				foreach($excolors as $color): ?>
				<li><a href="?color=<?php echo $color; ?>" style="background-color: #<?php echo $color; ?>"></a></li>
				<?php endforeach; ?>
			</ul>
			<?php
	
				$base_color = isset($_GET['color']) ? hex2rgb("#".$_GET['color']) : hex2rgb('#16a085');
				
				$hsla_base_color = rgb2hsla($base_color);
				$hsl_base_color = rgb2hsl($base_color);
				$stepleft = $hsla_base_color['l']/6;
				$stepright = (100-$hsla_base_color['l'])/5;
	
				// MONOCHROMATIC
				$colors = array();
				$colors['Base Color'] = rgb2hex($base_color);
				$colors['Body Text Color'] = rgb2hex(ChangeLuminosity($base_color, $stepleft, 255, 100));
				$colors['Background Color'] = rgb2hex(ChangeLuminosity($base_color, 95, 255, 100));
				$colors['Accent Color #1'] = rgb2hex(ChangeLuminosity($base_color, 40, 255, 100));
				$colors['Accent Color #2'] = rgb2hex(ChangeLuminosity($base_color, 47, 255, 255));
				?>
				<h2>MONOCHROMATIC</h2>
				<?php
				$nr = 1;
				foreach($colors as $key => $color) {
					?><div style="background-color: <?php echo $color; ?>" class="color c<?php echo $nr; ?>"><label><?php echo $key; ?></label></div><?php
					$nr++;
				}
				
				// COMPLEMENTARY
				$colors = array();
				$colors['Base Color'] = rgb2hex($base_color);
				$colors['Main Darker'] = rgb2hex(ChangeLuminosity($base_color, $stepleft*2, 255, 100));
				$colors['Main Lighter'] = rgb2hex(ChangeLuminosity($base_color, 85, 255, 100));
				$colors['Complementary Color'] = rgb2hex(GetComplementary($base_color));
				$colors['Complementary Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Complementary Color']), 70, 255, 100));
						
				?>
				<h2>COMPLEMENTARY</h2>
				<?php
				$nr = 1;
				foreach($colors as $key => $color) {
					?><div style="background-color: <?php echo $color; ?>" class="color c<?php echo $nr; ?>"><label><?php echo $key; ?></label></div><?php
					$nr++;
				}
				
				
				// SPLIT COMPLEMENTARY
				$colors = array();
				$colors['Base Color'] = rgb2hex($base_color);
				$colors['Left Complementary'] = rgb2hex(getHue(GetComplementary($base_color), -20));
				$colors['Left Complementary Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Left Complementary']), 80, 255, 100));
				$colors['Right Complementary'] = rgb2hex(getHue(GetComplementary($base_color), 20));
				$colors['Right Complementary Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Right Complementary']), 80, 255, 100));
				
				?>
				<h2>SPLIT COMPLEMENTARY</h2>
				<?php		
				$nr = 1;
				foreach($colors as $key => $color) {
					?><div style="background-color: <?php echo $color; ?>" class="color c<?php echo $nr; ?>"><label><?php echo $key; ?></label></div><?php
					$nr++;
				}
				
		
		
				// ANALOGOUS
				$colors = array();
				$colors['Base Color'] = rgb2hex($base_color);
				$colors['Left Color'] = rgb2hex(getHue($base_color, -25));
				$colors['Left Color Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Left Color']), 70, 255, 100));
				$colors['Right Color'] = rgb2hex(ChangeLuminosity(getHue($base_color, +25), 90, 200, 60));
				$colors['Right Color Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Right Color']), 90, 255, 60));
			
				?>
				<h2>ANALOGOUS</h2>
				<?php
				$nr = 1;
				foreach($colors as $key => $color) {
					?><div style="background-color: <?php echo $color; ?>" class="color c<?php echo $nr; ?>"><label><?php echo $key; ?></label></div><?php
					$nr++;
				}
				
				
				// TRIADIC
				$colors = array();
				$colors['Base Color'] = rgb2hex($base_color);
				$colors['Left Color'] = rgb2hex(getHue($base_color, -85));
				$colors['Left Color Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Left Color']), 70, 255, 100));
				$colors['Right Color'] = rgb2hex(getHue($base_color, +85));
				$colors['Right Color Lighter'] = rgb2hex(ChangeLuminosity(hex2rgb($colors['Right Color']), 70, 255, 100));
	
				?>
				<h2>TRIADIC</h2>
				<?php
				$nr = 1;
				foreach($colors as $key => $color) {
					?><div style="background-color: <?php echo $color; ?>" class="color c<?php echo $nr; ?>"><label><?php echo $key; ?></label></div><?php
					$nr++;
				}
				
				
				
				?>
		</section>
	</body>
</html>