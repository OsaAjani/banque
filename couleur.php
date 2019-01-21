<?php

// *************************************************** 
// ******************* Fonctions couleur *************
// *************************************************** 

function colorfct_css_from_rand_string($str)
{
	$res="#".substr(md5($str),0,6);
	$res=colorfct_parse_color($res);
	$res=colorfct_to_hsl($res);
	$res[2]=90.0;
	$res[3]=92.0;
	$res=colorfct_to_rgb($res);
	$res=colorfct_to_css($res);
	return $res;
}

function colorfct_parse_color($value)
{
	if(preg_match('@rgba\(([0-9]+),([0-9]+),([0-9]+),([0-9.]+)\)@',$value,$m))
	{
		return ['color',intval($m[1]),intval($m[2]),intval($m[3]),(float)($m[4])];
	}

	$c = array("color", 0, 0, 0);

	$colorStr = substr($value, 1);
	$num = hexdec($colorStr);
	$width = strlen($colorStr) == 3 ? 16 : 256;

	for ($i = 3; $i > 0; $i--) { // 3 2 1
		$t = $num % $width;
		$num /= $width;

		$c[$i] = $t * (256/$width) + $t * floor(16/$width);
	}
	return $c;
}




function colorfct_clamp($v, $max = 1, $min = 0) 
{
	return min($max, max($min, $v));
}

function colorfct_to_rgb($color) 
{
	if ($color[0] == 'color') return $color;

	$H = $color[1] / 360;
	$S = $color[2] / 100;
	$L = $color[3] / 100;

	if ($S == 0) {
		$r = $g = $b = $L;
	} else {
		$temp2 = $L < 0.5 ?
			$L*(1.0 + $S) :
			$L + $S - $L * $S;

		$temp1 = 2.0 * $L - $temp2;

		$r = colorfct_to_rgb_helper($H + 1/3, $temp1, $temp2);
		$g = colorfct_to_rgb_helper($H, $temp1, $temp2);
		$b = colorfct_to_rgb_helper($H - 1/3, $temp1, $temp2);
	}

	// $out = array('color', round($r*255), round($g*255), round($b*255));
	$out = array('color', $r*255, $g*255, $b*255);
	if (count($color) > 4) $out[] = $color[4]; // copy alpha
	return $out;
}

function colorfct_to_rgb_helper($comp, $temp1, $temp2) 
{
	if ($comp < 0) $comp += 1.0;
	elseif ($comp > 1) $comp -= 1.0;

	if (6 * $comp < 1) return $temp1 + ($temp2 - $temp1) * 6 * $comp;
	if (2 * $comp < 1) return $temp2;
	if (3 * $comp < 2) return $temp1 + ($temp2 - $temp1)*((2/3) - $comp) * 6;

	return $temp1;
}

function colorfct_to_hsl($color) 
{
	if ($color[0] == 'hsl') return $color;

	$r = $color[1] / 255;
	$g = $color[2] / 255;
	$b = $color[3] / 255;

	$min = min($r, $g, $b);
	$max = max($r, $g, $b);

	$L = ($min + $max) / 2;
	if ($min == $max) {
		$S = $H = 0;
	} else {
		if ($L < 0.5)
		$S = ($max - $min)/($max + $min);
		else
		$S = ($max - $min)/(2.0 - $max - $min);

		if ($r == $max) $H = ($g - $b)/($max - $min);
		elseif ($g == $max) $H = 2.0 + ($b - $r)/($max - $min);
		elseif ($b == $max) $H = 4.0 + ($r - $g)/($max - $min);

	}

	$out = array('hsl',
				 ($H < 0 ? $H + 6 : $H)*60,
				 $S*100,
				 $L*100,
				 );

	if (count($color) > 4) $out[] = $color[4]; // copy alpha
	return $out;
}

function colorfct_to_css($value)
{
	if ($value[0] == 'hsl'){$value=css_template_to_rgb($value);}

	list(, $r, $g, $b) = $value;
	$r = round($r);
	$g = round($g);
	$b = round($b);

	if (count($value) == 5 && $value[4] != 1) { // rgba
		return 'rgba('.$r.','.$g.','.$b.','.$value[4].')';
	}
	return sprintf("#%02x%02x%02x", $r, $g, $b);
	
}

?>
