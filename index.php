<?php
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function rgb2hex($rgb) {
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}

function HTMLToRGB($htmlCode)
  {
    if($htmlCode[0] == '#')
      $htmlCode = substr($htmlCode, 1);

    if (strlen($htmlCode) == 3)
    {
      $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    }
    
    $r = hexdec($htmlCode[0] . $htmlCode[1]);
    $g = hexdec($htmlCode[2] . $htmlCode[3]);
    $b = hexdec($htmlCode[4] . $htmlCode[5]);

    return $b + ($g << 0x8) + ($r << 0x10);
  }

  function RGBToHTML($RGB)
  {
    $r = 0xFF & ($RGB >> 0x10);
    $g = 0xFF & ($RGB >> 0x8);
    $b = 0xFF & $RGB;

    $r = dechex($r);
    $g = dechex($g);
    $b = dechex($b);
    
    return "#" . str_pad($r, 2, "0", STR_PAD_LEFT) . str_pad($g, 2, "0", STR_PAD_LEFT) . str_pad($b, 2, "0", STR_PAD_LEFT);
  }
  


  function RGBToHSL($RGB)
  {
    $r = 0xFF & ($RGB >> 0x10);
    $g = 0xFF & ($RGB >> 0x8);
    $b = 0xFF & $RGB;

    $r = ((float)$r) / 255.0;
    $g = ((float)$g) / 255.0;
    $b = ((float)$b) / 255.0;

    $maxC = max($r, $g, $b);
    $minC = min($r, $g, $b);

    $l = ($maxC + $minC) / 2.0;

    if($maxC == $minC)
    {
      $s = 0;
      $h = 0;
    }
    else
    {
      if($l < .5)
      {
        $s = ($maxC - $minC) / ($maxC + $minC);
      }
      else
      {
        $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
      }
      if($r == $maxC)
        $h = ($g - $b) / ($maxC - $minC);
      if($g == $maxC)
        $h = 2.0 + ($b - $r) / ($maxC - $minC);
      if($b == $maxC)
        $h = 4.0 + ($r - $g) / ($maxC - $minC);

      $h = $h / 6.0; 
    }

    $h = (int)round(255.0 * $h);
    $s = (int)round(255.0 * $s);
    $l = (int)round(255.0 * $l);

    $HSL = $l + ($s << 0x8) + ($h << 0x10);
    return $HSL;
  }
  
   function RGBToHSLA($RGB)
  {
    $r = 0xFF & ($RGB >> 0x10);
    $g = 0xFF & ($RGB >> 0x8);
    $b = 0xFF & $RGB;

    $r = ((float)$r) / 255.0;
    $g = ((float)$g) / 255.0;
    $b = ((float)$b) / 255.0;

    $maxC = max($r, $g, $b);
    $minC = min($r, $g, $b);

    $l = ($maxC + $minC) / 2.0;

    if($maxC == $minC)
    {
      $s = 0;
      $h = 0;
    }
    else
    {
      if($l < .5)
      {
        $s = ($maxC - $minC) / ($maxC + $minC);
      }
      else
      {
        $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
      }
      if($r == $maxC)
        $h = ($g - $b) / ($maxC - $minC);
      if($g == $maxC)
        $h = 2.0 + ($b - $r) / ($maxC - $minC);
      if($b == $maxC)
        $h = 4.0 + ($r - $g) / ($maxC - $minC);

      $h = $h / 6.0; 
    }

    $h = (int)round(255.0 * $h);
    $s = (int)round(255.0 * $s);
    $l = (int)round(255.0 * $l);

    $HSL['h'] = $h;
    $HSL['s'] = $s;
    $HSL['l'] = $l;
    return $HSL;
  }

  function HSLToRGB($HSL)
  {
    $h = 0xFF & ($HSL >> 0x10);
    $s = 0xFF & ($HSL >> 0x8);
    $l = 0xFF & $HSL;

    $h = ((float)$h) / 255.0;
    $s = ((float)$s) / 255.0;
    $l = ((float)$l) / 255.0;

    if($s == 0)
    {
      $r = $l;
      $g = $l;
      $b = $l;
    }
    else
    {
      if($l < .5)
      {
        $t2 = $l * (1.0 + $s);
      }
      else
      {
        $t2 = ($l + $s) - ($l * $s);
      }
      $t1 = 2.0 * $l - $t2;

      $rt3 = $h + 1.0/3.0;
      $gt3 = $h;
      $bt3 = $h - 1.0/3.0;

      if($rt3 < 0) $rt3 += 1.0;
      if($rt3 > 1) $rt3 -= 1.0;
      if($gt3 < 0) $gt3 += 1.0;
      if($gt3 > 1) $gt3 -= 1.0;
      if($bt3 < 0) $bt3 += 1.0;
      if($bt3 > 1) $bt3 -= 1.0;

      if(6.0 * $rt3 < 1) $r = $t1 + ($t2 - $t1) * 6.0 * $rt3;
      elseif(2.0 * $rt3 < 1) $r = $t2;
      elseif(3.0 * $rt3 < 2) $r = $t1 + ($t2 - $t1) * ((2.0/3.0) - $rt3) * 6.0;
      else $r = $t1;

      if(6.0 * $gt3 < 1) $g = $t1 + ($t2 - $t1) * 6.0 * $gt3;
      elseif(2.0 * $gt3 < 1) $g = $t2;
      elseif(3.0 * $gt3 < 2) $g = $t1 + ($t2 - $t1) * ((2.0/3.0) - $gt3) * 6.0;
      else $g = $t1;

      if(6.0 * $bt3 < 1) $b = $t1 + ($t2 - $t1) * 6.0 * $bt3;
      elseif(2.0 * $bt3 < 1) $b = $t2;
      elseif(3.0 * $bt3 < 2) $b = $t1 + ($t2 - $t1) * ((2.0/3.0) - $bt3) * 6.0;
      else $b = $t1;
    }

    $r = (int)round(255.0 * $r);
    $g = (int)round(255.0 * $g);
    $b = (int)round(255.0 * $b);

    $RGB = $b + ($g << 0x8) + ($r << 0x10);
    return $RGB;
  }

  function ChangeLuminosity($RGB, $LuminosityPercent, $Darkness, $Saturation=100)
  {
    $HSL = RGBToHSL($RGB);
    $NewHSL = (int)(((float)$LuminosityPercent/100) * $Darkness) + (0xFFFF00 & $HSL);
    
    if ($Saturation) {
    	$NewRGB = HSLToRGB($NewHSL);
    	$SHSL = RGBToHSLA($NewRGB);
    	
    	$s = (int)round($Saturation*(359/100));
    	    	
    	$NewHSL = $SHSL['l'] + ($Saturation << 0x8) + ($SHSL['h'] << 0x10);
    	
    }
    
    return HSLToRGB($NewHSL);
  }
  
  function GetComplementary($RGB) {
  	
  	$HSL = RGBToHSLA($RGB);
  	
  	$new_hue = $HSL['h']+127;
  	if ($new_hue > 255) {
  		$new_hue = $new_hue-255;
  	}
  	
  	$NewHSL = $HSL['l'] + ($HSL['s'] << 0x8) + ($new_hue << 0x10);
  	
  	return HSLToRGB($NewHSL);
  	
  }
  
  function GetHue($RGB, $pos) {
  	
  	$HSL = RGBToHSLA($RGB);
  	
  	$new_hue = $HSL['h']+$pos;
  	if ($new_hue > 255) {
  		$new_hue = $new_hue-255;
  	}
  	if ($new_hue < 0) {
  		$new_hue = $new_hue+255;
  	}
  	
  	
  	$NewHSL = $HSL['l'] + ($HSL['s'] << 0x8) + ($new_hue << 0x10);
  	
  	return HSLToRGB($NewHSL);
  	
  }  

		$base_color = HTMLToRGB("#".$_GET['color']);
		$hsla_base_color = RGBToHSLA($base_color);
		$hsl_base_color = RGBToHSL($base_color);
		
		$stepleft = $hsla_base_color['l']/6;
		$stepright = (100-$hsla_base_color['l'])/5;
		
		echo '
		<style>
		body { font-family: Arial; }
		div { padding: 10px; }
		</style>
		';
		
		// MONOCHROMATIC
		$colors = array();
		$colors['Base Color'] = RGBToHTML($base_color);
		$colors['Body Text Color'] = RGBToHTML(ChangeLuminosity($base_color, $stepleft, 255, 100));
		$colors['Background Color'] = RGBToHTML(ChangeLuminosity($base_color, 95, 255, 100));
		$colors['Accent Color #1'] = RGBToHTML(ChangeLuminosity($base_color, 40, 255, 100));
		$colors['Accent Color #2'] = RGBToHTML(ChangeLuminosity($base_color, 47, 255, 255));
		
		echo 'MONOCHROMATIC<br/>';
		foreach($colors as $key => $color) {
			echo "<div style=\"font-size:10px; color: #FFF; height: 100px; width: 100px; float: left; background-color: " . $color . ";\">".$key."</div>";	
		}
		
		
		
		// COMPLEMENTARY
		echo '<div style="clear: both;"></div><br/><br/>';
		$colors = array();
		$colors['Base Color'] = RGBToHTML($base_color);
		$colors['Main Darker'] = RGBToHTML(ChangeLuminosity($base_color, $stepleft*2, 255, 100));
		$colors['Main Lighter'] = RGBToHTML(ChangeLuminosity($base_color, 85, 255, 100));
		$colors['Complementary Color'] = RGBToHTML(GetComplementary($base_color));
		$colors['Complementary Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Complementary Color']), 70, 255, 100));
				
		echo 'COMPLEMENTARY<br/>';
		foreach($colors as $key => $color) {
			echo "<div style=\"font-size:10px; color: #FFF; height: 100px; width: 100px; float: left; background-color: " . $color . ";\">".$key."</div>";	
		}
		
		
		// SPLIT COMPLEMENTARY
		echo '<div style="clear: both;"></div><br/><br/>';
		$colors = array();
		$colors['Base Color'] = RGBToHTML($base_color);
		$colors['Left Complementary'] = RGBToHTML(getHue(GetComplementary($base_color), -20));
		$colors['Left Complementary Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Left Complementary']), 80, 255, 100));
		$colors['Right Complementary'] = RGBToHTML(getHue(GetComplementary($base_color), 20));
		$colors['Right Complementary Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Right Complementary']), 80, 255, 100));
		
				
		echo 'SPLIT COMPLEMENTARY<br/>';
		foreach($colors as $key => $color) {
			echo "<div style=\"font-size:10px; color: #FFF; height: 100px; width: 100px; float: left; background-color: " . $color . ";\">".$key."</div>";	
		}
		


		// ANALOGOUS
		$colors = array();
		$colors['Base Color'] = RGBToHTML($base_color);
		$colors['Left Color'] = RGBToHTML(getHue($base_color, -25));
		$colors['Left Color Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Left Color']), 70, 255, 100));
		$colors['Right Color'] = RGBToHTML(ChangeLuminosity(getHue($base_color, +25), 90, 200, 60));
		$colors['Right Color Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Right Color']), 90, 255, 60));
	
		echo '<div style="clear: both;"></div><br/><br/>';
		
		echo 'ANALOGOUS<br/>';
		foreach($colors as $key => $color) {
			echo "<div style=\"font-size:10px; color: #FFF; height: 100px; width: 100px; float: left; background-color: " . $color . ";\">".$key."</div>";	
		}
		
		
		// TRIADIC
		$colors = array();
		$colors['Base Color'] = RGBToHTML($base_color);
		$colors['Left Color'] = RGBToHTML(getHue($base_color, -85));
		$colors['Left Color Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Left Color']), 70, 255, 100));
		$colors['Right Color'] = RGBToHTML(getHue($base_color, +85));
		$colors['Right Color Lighter'] = RGBToHTML(ChangeLuminosity(HTMLToRGB($colors['Right Color']), 70, 255, 100));
	
		echo '<div style="clear: both;"></div><br/><br/>';
		
		echo 'TRIADIC<br/>';
		foreach($colors as $key => $color) {
			echo "<div style=\"font-size:10px; color: #FFF; height: 100px; width: 100px; float: left; background-color: " . $color . ";\">".$key."</div>";	
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		for($i = 1 ; $i <= 255; $i++) {
			$new_color = ChangeLuminosity($base_color, 40, 255, $i);
     	if ($base_color == RGBToHTML($new_color)) { $bordercolor = "#FFF"; } else { $bordercolor = RGBToHTML($new_color); }
     	echo "<div style=\"font-size:10px; color: #FFF; height: 2px; width: 100px; float: left; clear: left; background-color: " . RGBToHTML($new_color) . ";\">
     	
     	</div>";
			
		}
		*/
		/*
    echo "<html><body>";
    //for($j = 255; $j <= 255; $j++) {
    	for($i = 0; $i <= 100; $i++) {
    		$brightness = $i;
    		//$lightness = $j;
     		$new_color = ChangeLuminosity($base_color, $brightness, 255);
     		if ($base_color == RGBToHTML($new_color)) { $bordercolor = "#FFF"; } else { $bordercolor = RGBToHTML($new_color); }
     		echo "<div style=\"font-size:10px; color: #FFF; height: 20px; width: 10px; float: left; background-color: " . RGBToHTML($new_color) . ";\">
     		<div style='width: 8px; height: 18px; border: 1px solid ".$bordercolor.";'></div>
     		</div>";
    	}
    	echo "<div style='clear: both;'></div>";
    //}
    */



?>