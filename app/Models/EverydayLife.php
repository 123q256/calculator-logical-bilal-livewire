<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;
// class for age calculator
class Age
{
	var $age = '';

	function calculateAge($iTimestamp)
	{
		$iDiffYear  = date('Y') - date('Y', $iTimestamp);
		$iDiffMonth = date('n') - date('n', $iTimestamp);
		$iDiffDay   = date('j') - date('j', $iTimestamp);

		// If birthday has not happen yet for this year, subtract 1.
		if ($iDiffMonth < 0 || ($iDiffMonth == 0 && $iDiffDay < 0)) {
			$iDiffYear--;
		}

		$this->age = $iDiffYear;
	}

	function getAge()
	{
		return $this->age;
	}

	function get_rank($rank)
	{
		$last = substr($rank, -1);
		$seclast = substr($rank, -2, -1);
		if ($last > 3 || $last == 0) $ext = 'th';
		else if ($last == 3) $ext = 'rd';
		else if ($last == 2) $ext = 'nd';
		else $ext = 'st';

		if ($last == 1 && $seclast == 1) $ext = 'th';
		if ($last == 2 && $seclast == 1) $ext = 'th';
		if ($last == 3 && $seclast == 1) $ext = 'th';

		return $rank . $ext;
	}
}

class EverydayLife extends Model
{
	public $param;

	public function love($request)
	{
		$you = $request->input('you');
		$lover = $request->input('lover');
		if (empty($you) || empty($lover)) {
			if (empty($you) && empty($lover)) {
				$this->param['error'] = 'Please provide your name and your Partner\'s name.';
			} elseif (empty($you)) {
				$this->param['error'] = 'Please provide your name.';
			} else {
				$this->param['error'] = 'Please provide your Partner\'s name.';
			}
			return $this->param;
		}
		$ran = rand(20, 100);
		$this->param['RESULT'] = $ran;
		return $this->param;
	}

	// era calculator
	function era($request)
	{
		$x = $request->input('x');
		$y = $request->input('y');
		$z = $request->input('z');
		$g = $request->input('g');
		if (is_numeric($x) || is_numeric($y) || is_numeric($z)) {
			$earn_run = $x;
			$inning = $y;
			$game = 9;
			if (!empty($g)) {
				$game = $g;
			}
			if (!empty($z)) {
				$inning = $y + ($z / 3);
			}
			$era = round(($earn_run / $inning) * $game, 3);
			$this->param['era'] = $era;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
	}

	public function ppi($request)
	{
		$vertical = $request->input('v');
		$diagonal = $request->input('d');
		$horizontal = $request->input('h');
		$unit = $request->input('unit');

		if (!empty($diagonal) and !empty($horizontal) and !empty($vertical)) $fieldsDone = 1;
		if (is_numeric($diagonal) and is_numeric($horizontal) and is_numeric($vertical)) $numeric = 1;
		// alerts
		if (empty($fieldsDone)) {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
		if (empty($numeric)) {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
		if ($unit == 'm') {
			$diagonal = $diagonal * 39.37;
		}
		if ($unit == 'cm') {
			$diagonal = $diagonal / 2.54;
		}
		if ($unit == 'ft') {
			$diagonal = $diagonal * 12;
		}
		if ($unit == 'yd') {
			$diagonal = $diagonal * 36;
		}
		$dia = round(sqrt(pow($vertical, 2) + pow($horizontal, 2)), 2);
		$ppi = sqrt(($horizontal * $horizontal) + ($vertical * $vertical)) / $diagonal;
		$ppi = round($ppi, 2);
		$ppis = round($ppi * $ppi, 2);
		$pixls = $horizontal / ((sqrt(($horizontal * $horizontal) + ($vertical * $vertical)) / ($diagonal * 25.4))) / $horizontal;
		$pixls = round($pixls, 4);
		$mpx = $vertical * $horizontal / 1000000;
		function gcd($a, $b)
		{
			if ($a == 0 || $b == 0)
				return abs(max(abs($a), abs($b)));

			$r = $a % $b;
			return ($r != 0) ?
				gcd($b, $r) :
				abs($b);
		}

		$gcd = gcd($horizontal, $vertical);
		$ratio = $horizontal / $gcd . ':' . $vertical / $gcd;


		$over = $vertical / $horizontal;
		$xd = round(sqrt((pow($diagonal, 2) / (1 + pow($over, 2)))), 2);
		$yd = round($xd * $over, 2);
		$xdcm = round($xd * 2.54, 2);
		$ydcm = round($yd * 2.54, 2);
		$screen_size = round($xd * $yd, 2);
		$s_cm = round($screen_size * 6.452, 2);
		$screen_in = $xd . "'' x " . $yd . "'' = " . $screen_size . ' in²';
		$screen_cm = round($xd * 2.54, 2) . " cm x " . round($yd * 2.54, 2) . " cm = " . $s_cm . ' cm²';
		// return values
		$this->param['PPI'] = $ppi;
		$this->param['dia'] = $dia;
		$this->param['screen_in'] = $screen_in;
		$this->param['screen_cm'] = $screen_cm;
		$this->param['screen_size'] = $screen_size . ' in² ( ' . $s_cm . ' cm² )';
		$this->param['xd'] = $xd . '" ( ' . $xdcm . ' cm)';
		$this->param['yd'] = $yd . '" ( ' . $ydcm . ' cm)';
		$this->param['ratio'] = $ratio;
		$this->param['PPIS'] = $ppis;
		$this->param['Pixls'] = $pixls;
		$this->param['mpx'] = $mpx;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	function tip($request)
	{
		$for = $request->input('for');
		$bill = $request->input('x');
		$xs = $request->input('xs');
		$tip = $request->input('y');
		$person = $request->input('z');
		$round = $request->input('round');
		$rounds = $request->input('rounds');
		if ($for === 'single') {
			if (is_numeric($xs)) {
				$this->param['RESULT'] = 1;
				$this->param['single'] = 1;
				return true;
			} else {
				$this->param['error'] = 'Please! Fill all the Input Fields';
				return $this->param;
			}
		} else {
			if (is_numeric($bill) && is_numeric($tip) && is_numeric($person)) {
				if ($round == 'yes') {
					$a = round(($tip / 100) * $bill);
					$b = round($bill + $a);
					$c = round($a / $person);
					$d = round($b / $person);
				} else {
					$a = round(($tip / 100) * $bill, 2);
					$b = round($bill + $a, 2);
					$c = round($a / $person, 2);
					$d = round($b / $person, 2);
				}
				$this->param['a'] = $a;
				$this->param['b'] = $b;
				$this->param['c'] = $c;
				$this->param['d'] = $d;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Fill all the Input Fields';
				return $this->param;
			}
		}
	}

	function roof($request)
	{
		$submit = $request->input('submit');
		$rise = $request->input('x');
		$run = $request->input('y');
		$unit = $request->input('unit');
		$unit_r = $request->input('unit_r');
		$unit_a = $request->input('unit_a');
		$from = $request->input('from');

		if (is_numeric($rise) && is_numeric($run)) {
			if ($from === '1') {
				if ($unit === 'ft') {
					$rise = $rise / 3.281;
				}
				if ($unit_r === 'ft') {
					$run = $run / 3.281;
				}
				if ($unit === 'in') {
					$rise = $rise / 39.37;
				}
				if ($unit_r === 'in') {
					$run = $run / 39.37;
				}
				if ($unit === 'yd') {
					$rise = $rise / 1.094;
				}
				if ($unit_r === 'yd') {
					$run = $run / 1.094;
				}
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$pitch = round(($rise / $run) * 100, 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
				$x = round(($pitch / 100) * 12, 2);
			} elseif ($from === '2') {
				$rafter = $request->input('y');
				if ($unit === 'ft') {
					$rise = $rise / 3.281;
				}
				if ($unit_r === 'ft') {
					$rafter = $rafter / 3.281;
				}
				if ($unit === 'in') {
					$rise = $rise / 39.37;
				}
				if ($unit_r === 'in') {
					$rafter = $rafter / 39.37;
				}
				if ($unit === 'yd') {
					$rise = $rise / 1.094;
				}
				if ($unit_r === 'yd') {
					$rafter = $rafter / 1.094;
				}
				$run = round(sqrt(($rafter * $rafter) - ($rise * $rise)), 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$pitch = round(($rise / $run) * 100, 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
				$x = round(($pitch / 100) * 12, 2);
			} elseif ($from === '3') {
				$run = $request->input('x');
				$rafter = $request->input('y');
				if ($unit === 'ft') {
					$run = $run / 3.281;
				}
				if ($unit_r === 'ft') {
					$rafter = $rafter / 3.281;
				}
				if ($unit === 'in') {
					$run = $run / 39.37;
				}
				if ($unit_r === 'in') {
					$rafter = $rafter / 39.37;
				}
				if ($unit === 'yd') {
					$run = $run / 1.094;
				}
				if ($unit_r === 'yd') {
					$rafter = $rafter / 1.094;
				}
				$rise = round(sqrt(($rafter * $rafter) - ($run * $run)), 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$pitch = round(($rise / $run) * 100, 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
				$x = round(($pitch / 100) * 12, 2);
			} elseif ($from === '4') {
				$pitch = $request->input('y');
				if ($unit === 'ft') {
					$rise = $rise / 3.281;
				}
				if ($unit === 'in') {
					$rise = $rise / 39.37;
				}
				if ($unit === 'yd') {
					$rise = $rise / 1.094;
				}
				$run = round(($rise / $pitch) * 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
				$x = round(($pitch / 100) * 12, 2);
			} elseif ($from === '5') {
				$angle = $request->input('y');
				if ($unit === 'ft') {
					$rise = $rise / 3.281;
				}
				if ($unit === 'in') {
					$rise = $rise / 39.37;
				}
				if ($unit === 'yd') {
					$rise = $rise / 1.094;
				}
				if ($unit_a === 'deg') {
					$angle = deg2rad($angle);
				}
				$pitch = round(tan($angle) * 100, 2);
				$run = round(($rise / $pitch) * 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$x = round(($pitch / 100) * 12, 2);
				$angle = rad2deg($angle);
			} elseif ($from === '6') {
				$x = $request->input('y');
				if ($unit === 'ft') {
					$rise = $rise / 3.281;
				}
				if ($unit === 'in') {
					$rise = $rise / 39.37;
				}
				if ($unit === 'yd') {
					$rise = $rise / 1.094;
				}
				$pitch = round(($x * 100) / 12, 2);
				$run = round(($rise / $pitch) * 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
			} elseif ($from === '7') {
				$run = $request->input('x');
				$pitch = $request->input('y');
				if ($unit === 'ft') {
					$run = $run / 3.281;
				}
				if ($unit === 'in') {
					$run = $run / 39.37;
				}
				if ($unit === 'yd') {
					$run = $run / 1.094;
				}
				$rise = round(($run * $pitch) / 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
				$x = round(($pitch / 100) * 12, 2);
			} elseif ($from === '8') {
				$run = $request->input('x');
				$angle = $request->input('y');
				if ($unit === 'ft') {
					$run = $run / 3.281;
				}
				if ($unit === 'in') {
					$run = $run / 39.37;
				}
				if ($unit === 'yd') {
					$run = $run / 1.094;
				}
				if ($unit_a === 'deg') {
					$angle = deg2rad($angle);
				}
				$pitch = round(tan($angle) * 100, 2);
				$rise = round(($run * $pitch) / 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$x = round(($pitch / 100) * 12, 2);
				$angle = rad2deg($angle);
			} elseif ($from === '9') {
				$run = $request->input('x');
				$x = $request->input('y');
				if ($unit === 'ft') {
					$run = $run / 3.281;
				}
				if ($unit === 'in') {
					$run = $run / 39.37;
				}
				if ($unit === 'yd') {
					$run = $run / 1.094;
				}
				$pitch = round(($x * 100) / 12, 2);
				$rise = round(($run * $pitch) / 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
			} elseif ($from === '10') {
				$rafter = $request->input('x');
				$pitch = $request->input('y');
				if ($unit === 'ft') {
					$rafter = $rafter / 3.281;
				}
				if ($unit === 'in') {
					$rafter = $rafter / 39.37;
				}
				if ($unit === 'yd') {
					$rafter = $rafter / 1.094;
				}
				$rise = round(($run * $pitch) / 100, 2);
				$P = round($rise * 3.281) . "/" . round(($run * 3.281) * 2);
				$rafter = round(sqrt(($rise * $rise) + ($run * $run)), 2);
				$angle = round(atan($pitch / 100) * (180 / pi()), 2);
				$x = round(($pitch / 100) * 12, 2);
			}
			$this->param['pitch'] = $pitch;
			$this->param['rise'] = round($rise, 2);
			$this->param['run'] = round($run, 2);
			$this->param['rafter'] = $rafter;
			$this->param['angle'] = $angle;
			$this->param['x'] = $x;
			$this->param['P'] = $P;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
	}

	public function vorici($request)
	{
		//  dd($request->all());
		$submit = $request->input('submit');
		$s_f = trim($request->input('s_f'));
		$str_f = trim($request->input('str_f'));
		$dex_f = trim($request->input('dex_f'));
		$int_f = trim($request->input('int_f'));
		$r_f = trim($request->input('r_f'));
		$g_f = trim($request->input('g_f'));
		$b_f = trim($request->input('b_f'));

		if (isset($submit)) {
			$this->param['s_f'] = $s_f;
			$this->param['str_f'] = $str_f;
			$this->param['dex_f'] = $dex_f;
			$this->param['int_f'] = $int_f;
			$this->param['r_f'] = $r_f;
			$this->param['g_f'] = $g_f;
			$this->param['b_f'] = $b_f;
			$this->param['RESULT'] = 1;
			// dd($this->param);
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
	}

	public function freight($request)
	{
		$submit = $request->input('submit');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$height = $request->input('height');
		$height_unit = $request->input('height_unit');
		$weight = $request->input('weight');
		$weight_unit = $request->input('weight_unit');
		$pq = $request->input('pq');
		$fr = $request->input('fr');
		$fr_unit = $request->input('fr_unit');
		$currancy = $request->input('currancy');
		$fr_unit = str_replace($currancy . '/', '', $fr_unit);

		if (empty($length) || empty($width) || empty($height) || empty($weight) || empty($pq)) {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
		if (isset($submit)) {
			if ($pq < 1) {
				$this->param['error'] = 'Pallet Quantity cannot be zero or less.';
				return $this->param;
			}
			function sigFig($value, $digits)
			{
				if ($value === 0) {
					$decimalPlaces = $digits - 1;
				} elseif ($value < 0) {
					$decimalPlaces = $digits - floor(log10($value * -1)) - 1;
				} else {
					$decimalPlaces = $digits - floor(log10($value)) - 1;
				}
				$answer = round($value, $decimalPlaces);
				return $answer;
			}
			if (is_numeric($length)) {
				if ($length_unit === 'mm') {
					$length = $length / 25.4;
				} elseif ($length_unit === 'cm') {
					$length = $length / 2.54;
				} elseif ($length_unit === 'm') {
					$length = $length / 0.0254;
				} elseif ($length_unit === 'km') {
					$length = $length / 0.0000254;
				} elseif ($length_unit === 'ft') {
					$length = $length / 0.08333;
				} elseif ($length_unit === 'yd') {
					$length = $length / 0.02778;
				} elseif ($length_unit === 'mi') {
					$length = $length / 0.000015783;
				} elseif ($length_unit === 'nmi') {
					$length = $length / 0.000013715;
				}
			}
			if (is_numeric($width)) {
				if ($width_unit === 'mm') {
					$width = $width / 25.4;
				} elseif ($width_unit === 'cm') {
					$width = $width / 2.54;
				} elseif ($width_unit === 'm') {
					$width = $width / 0.0254;
				} elseif ($width_unit === 'km') {
					$width = $width / 0.0000254;
				} elseif ($width_unit === 'ft') {
					$width = $width / 0.08333;
				} elseif ($width_unit === 'yd') {
					$width = $width / 0.02778;
				} elseif ($width_unit === 'mi') {
					$width = $width / 0.000015783;
				} elseif ($width_unit === 'nmi') {
					$width = $width / 0.000013715;
				}
			}
			if (is_numeric($height)) {
				if ($height_unit === 'mm') {
					$height = $height / 25.4;
				} elseif ($height_unit === 'cm') {
					$height = $height / 2.54;
				} elseif ($height_unit === 'm') {
					$height = $height / 0.0254;
				} elseif ($height_unit === 'km') {
					$height = $height / 0.0000254;
				} elseif ($height_unit === 'ft') {
					$height = $height / 0.08333;
				} elseif ($height_unit === 'yd') {
					$height = $height / 0.02778;
				} elseif ($height_unit === 'mi') {
					$height = $height / 0.000015783;
				} elseif ($height_unit === 'nmi') {
					$height = $height / 0.000013715;
				}
			}
			if (is_numeric($weight)) {
				if ($weight_unit === 'ug') {
					$weight = $weight / 453592370;
				} elseif ($weight_unit === 'mg') {
					$weight = $weight / 453592;
				} elseif ($weight_unit === 'g') {
					$weight = $weight / 453.6;
				} elseif ($weight_unit === 'dag') {
					$weight = $weight / 45.36;
				} elseif ($weight_unit === 'kg') {
					$weight = $weight / 0.4536;
				} elseif ($weight_unit === 't') {
					$weight = $weight / 0.0004536;
				} elseif ($weight_unit === 'gr') {
					$weight = $weight / 7000;
				} elseif ($weight_unit === 'dr') {
					$weight = $weight / 256;
				} elseif ($weight_unit === 'oz') {
					$weight = $weight / 16;
				} elseif ($weight_unit === 'stone') {
					$weight = $weight / 0.07143;
				} elseif ($weight_unit === 'us_ton') {
					$weight = $weight / 0.0005;
				} elseif ($weight_unit === 'long_ton') {
					$weight = $weight / 0.0004464;
				} elseif ($weight_unit === 'earths') {
					$weight = $weight * 13166006297680889120775995;
				} elseif ($weight_unit === 'me') {
					$weight = $weight / 497939698128157422761985444381;
				} elseif ($weight_unit === 'u') {
					$weight = $weight / 273159675507180000000000000;
				} elseif ($weight_unit === 'oz t') {
					$weight = $weight / 14.583;
				}
			}
			if (is_numeric($fr)) {
				if ($fr_unit === 'ug') {
					$fr = $fr / 453592370;
				} elseif ($fr_unit === 'mg') {
					$fr = $fr / 453592;
				} elseif ($fr_unit === 'g') {
					$fr = $fr / 453.6;
				} elseif ($fr_unit === 'dag') {
					$fr = $fr / 45.36;
				} elseif ($fr_unit === 'kg') {
					$fr = $fr / 0.4536;
				} elseif ($fr_unit === 't') {
					$fr = $fr / 0.0004536;
				} elseif ($fr_unit === 'gr') {
					$fr = $fr / 7000;
				} elseif ($fr_unit === 'dr') {
					$fr = $fr / 256;
				} elseif ($fr_unit === 'oz') {
					$fr = $fr / 16;
				} elseif ($fr_unit === 'stone') {
					$fr = $fr / 0.07143;
				} elseif ($fr_unit === 'us_ton') {
					$fr = $fr / 0.0005;
				} elseif ($fr_unit === 'long_ton') {
					$fr = $fr / 0.0004464;
				} elseif ($fr_unit === 'earths') {
					$fr = $fr * 13166006297680889120775995;
				} elseif ($fr_unit === 'me') {
					$fr = $fr / 497939698128157422761985444381;
				} elseif ($fr_unit === 'u') {
					$fr = $fr / 273159675507180000000000000;
				} elseif ($fr_unit === 'oz t') {
					$fr = $fr / 14.583;
				}
			}
			$total = $length * $width * $height;
			$volume = $total / 1728 * $pq;
			$density = $weight / $volume;
			$weight = $weight / $pq;
			if ($density < 1) {
				$f_cls = 500;
			} elseif ($density < 2) {
				$f_cls = 400;
			} elseif ($density < 3) {
				$f_cls = 300;
			} elseif ($density < 4) {
				$f_cls = 250;
			} elseif ($density < 5) {
				$f_cls = 200;
			} elseif ($density < 6) {
				$f_cls = 175;
			} elseif ($density < 7) {
				$f_cls = 150;
			} elseif ($density < 8) {
				$f_cls = 125;
			} elseif ($density < 9) {
				$f_cls = 110;
			} elseif ($density < 10) {
				$f_cls = 100;
			} elseif ($density < 12) {
				$f_cls = 92.5;
			} elseif ($density < 13) {
				$f_cls = 85;
			} elseif ($density < 15) {
				$f_cls = 77.5;
			} elseif ($density < 22) {
				$f_cls = 70;
			} elseif ($density < 30) {
				$f_cls = 65;
			} elseif ($density < 35) {
				$f_cls = 60;
			} elseif ($density < 50) {
				$f_cls = 55;
			} else {
				$f_cls = 50;
			}
			if (is_numeric($fr)) {
				$fc = 936.96;
				$fc = $fr * $fc;
				$this->param['fc'] = $fc;
			}
			$this->param['weight'] = sigFig($weight, 4);
			$this->param['volume'] = sigFig($volume, 4);
			$this->param['density'] = sigFig($density, 4);
			$this->param['f_cls'] = sigFig($f_cls, 4);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Fill all the Input Fields';
			return $this->param;
		}
	}

	public function population($request)
	{
		$area = trim($request->input('area'));
		$no = trim($request->input('no'));

		if (is_numeric($area) && is_numeric($no)) {
			$ans = $no / $area;
			$this->param['ans'] = round($ans);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Input Fields';
			return $this->param;
		}
	}

	public function board($request)
	{
		//  dd($request->all());
		$submit = $request->input('submit');
		$length = trim($request->input('length'));
		$no = trim($request->input('no'));
		$length_unit = trim($request->input('length_unit'));
		$width = trim($request->input('width'));
		$width_unit = trim($request->input('width_unit'));
		$thickness = trim($request->input('thickness'));
		$thickness_unit = trim($request->input('thickness_unit'));
		$price = trim($request->input('price'));

		if (!empty($length) && !empty($no) && !empty($width) && !empty($thickness)) {
			if ($thickness_unit === 'cm') {
				$thickness = $thickness * 0.3937;
			} elseif ($thickness_unit === 'm') {
				$thickness = $thickness * 39.37;
			} elseif ($thickness_unit === 'ft') {
				$thickness = $thickness * 12;
			} elseif ($thickness_unit === 'yd') {
				$thickness = $thickness * 36;
			}
			if ($width_unit === 'cm') {
				$width = $width * 0.3937;
			} elseif ($width_unit === 'm') {
				$width = $width * 39.37;
			} elseif ($width_unit === 'ft') {
				$width = $width * 12;
			} elseif ($width_unit === 'yd') {
				$width = $width * 36;
			}
			if ($length_unit === 'cm') {
				$length = $length * 0.03281;
			} elseif ($length_unit === 'm') {
				$length = $length * 3.281;
			} elseif ($length_unit === 'in') {
				$length = $length / 12;
			} elseif ($length_unit === 'yd') {
				$length = $length * 3;
			}
			// dd($thickness);
			$ans = $length * $width * ($thickness / 12);
			$ans = $ans * $no;
			$this->param['ans'] = $ans;
			$this->param['RESULT'] = 1;
			//  dd($this->param);
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	public function visa($request)
	{
		//  dd($request->all());
		$name = $request->input('name');
		$resident = $request->input('resident');
		$nationality = $request->input('nationality');
		$travel = $request->input('travel');
		$submit = $request->input('submit');
		if (empty($travel) || empty($nationality) || empty($resident)) {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		if ($travel || $nationality || $resident) {
			$ec = [
				[],
				["Albania", "Algeria", "Andorra", "Argentina", "Australia", "Austria", "Bahamas", "Bahrain", "Barbados", "Belgium", "Bolivia", "Bosnia & herzegovina", "Brazil", "Brunei darussalam", "Bulgaria", "Canada", "Chile", "China", "Colombia", "Costa rica", "Croatia", "Cuba", "Cyprus", "Czech republic", "Denmark", "Djibouti", "Ecuador", "Estonia", "Finland", "France", "Germany", "Greece", "Guatemala", "Holy see (vatican)", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Korea", "Kuwait", "Latvia", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Malaysia", "Maldives", "Malta", "Mauritius", "Mexico", "Monaco", "Mongolia", "Montenegro", "Morocco", "Nepal", "Netherlands", "New zealand", "Norway", "Oman", "Pakistan", "Panama", "Paraguay", "Peru", "Poland", "Portugal", "Qatar", "Romania", "San marino", "Saudi arabia", "Serbia", "Seychelles", "Singapore", "Slovakia", "Slovenia", "South africa", "Spain", "Sri lanka", "Sweden", "Switzerland", "Thailand", "Trinidad and tobago", "Turkey", "Turkmenistan", "United arab emirates", "United kingdom", "United states of america", "Vietnam"],
				["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France, Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Ivory Coast", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kosovo", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia South Sandwich Islands", "South Sudan", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States minor outlying islands", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Zaire", "Zambia", "Zimbabwe"]
			];
			if (in_array($nationality, $ec[$travel])) {
				$ans = 'There are more likely 99% chances of your visa eligibility!';
			} else {
				$ans = 'There are more likely 50% chances of your visa eligibility!';
			}
			$this->param['ans'] = $ans;
			$this->param['RESULT'] = 1;
			//  dd($this->param);

			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	public function korean($request)
	{
		//  dd($request->all());
		$current_year = $request->input('current_year');
		$year = $request->input('year');
		$birthday_unit = $request->input('birthday_unit');
		$age = $request->input('age');
		$room_unit = $request->input('room_unit');
		if ($room_unit == "1") {
			if (is_numeric($year) && is_numeric($current_year)) {
				if ($year < $current_year) {
					$korean_age = ($current_year - $year) + 1;
				} else {
					$this->param['error'] = 'It is must that your birth year is earlier than current one in case you are from the future';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} elseif ($room_unit == "2") {
			if ($birthday_unit == "1") {
				if (is_numeric($age)) {
					if ($age > 0) {
						$korean_age = $age + 2;
						$this->param['korean_age'] = $korean_age;
						$this->param['RESULT'] = 1;
						return $this->param;
					} else {
						$this->param['error'] = 'Age Cannot be negitive';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Inputs';
					return $this->param;
				}
			} elseif ($birthday_unit == "2") {
				if (is_numeric($age)) {
					if ($age > 0) {
						$korean_age = $age + 1;
						$this->param['korean_age'] = $korean_age;
						$this->param['RESULT'] = 1;
						return $this->param;
					} else {
						$this->param['error'] = 'Age Cannot be negitive';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Inputs';
					return $this->param;
				}
			}
		}
		$this->param['korean_age'] = $korean_age;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function edpi($request)
	{
		// dd($request->all());
		function CalcSn($e, $game)
		{
			$n = "";
			$s = 1 * $e;
			$a = $game;
			switch ($a) {
				case 1:
					if ($s > 0 && $s < 700) {
						$n = "Low Sens";
					} elseif ($s >= 700 && $s < 1200) {
						$n = "Medium Sens";
					} elseif ($s >= 1200) {
						$n = "High Sens";
					}
					break;
				case 2:
					$n = "";
					break;
				case 3:
					if ($s > 0 && $s < 200) {
						$n = "Low Sens";
					} elseif ($s >= 200 && $s < 400) {
						$n = "Medium Sens";
					} elseif ($s >= 400) {
						$n = "High Sens";
					}
					break;
				case 4:
					if ($s > 0 && $s < 40) {
						$n = "Low Sens";
					} elseif ($s >= 40 && $s < 80) {
						$n = "Medium Sens";
					} elseif ($s >= 80) {
						$n = "High Sens";
					}
					break;
				case 5:
					if ($s > 0 && $s < 3e3) {
						$n = "Low Sens";
					} elseif ($s >= 3e3 && $s < 6e3) {
						$n = "Medium Sens";
					} elseif ($s >= 6e3) {
						$n = "High Sens";
					}
					break;
				case 6:
					if ($s > 0 && $s < 700) {
						$n = "Low Sens";
					} elseif ($s >= 700 && $s < 1200) {
						$n = "Medium Sens";
					} elseif ($s >= 1200) {
						$n = "High Sens";
					}
			}
			return $n;
		}
		function Calc360($e, $game)
		{
			$n = 0;
			$s = $game;
			switch ($s) {
				case 1:
					$n = (360 / (0.022 * $e)) * 2.54;
					break;
				case 2:
					$n = (360 / (0.0066 * $e)) * 2.54;
					break;
				case 3:
					$n = (360 / (0.07 * $e)) * 2.54;
					break;
				case 4:
					$n = (360 / (0.005555 * $e)) * 2.54;
					break;
				case 5:
					$n = (360 / (0.0066 * $e)) * 2.54;
					break;
				case 6:
					$n = (360 / (0.021999 * $e)) * 2.54;
			}
			return $n;
		}
		$dpi = trim($request->input('dpi'));
		$row = trim($request->input('row'));
		$sen = trim($request->input('sen'));
		$game = trim($request->input('game'));
		$win = trim($request->input('win'));
		$submit = $request->input('submit');
		if ($submit) {
			if ($game == '1') {
				$t = 1;
				if ($row == '0') {
					$t = $win;
				}
				$ans = $dpi * $sen * $t;
			} elseif ($game == '4') {
				$ans = ($dpi * $sen) / 100;
			} else {
				$ans = ($dpi * $sen);
			}
			$type = CalcSn($ans, $game);
			$cm = Calc360($ans, $game);
			$in = $cm / 2.54;
			$this->param['ans'] = round($ans, 2);
			$this->param['cm'] = round($cm, 2);
			$this->param['in'] = round($in, 2);
			$this->param['type'] = $type;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	public function water($request)
	{
		$from = $request->input('from');
		$vol = $request->input('vol');
		$temp = $request->input('temp');

		if (is_numeric($vol) && is_numeric($from) && is_numeric($temp)) {
			$ans = (1.0E+16 / ($from / $vol)) * $temp;
			$lbs = $ans * 0.0022;
			$onz = $ans * 0.03527396195;
			$kg = $ans * 0.001;
			$this->param['gram'] = $ans;
			$this->param['lbs'] = $lbs;
			$this->param['onz'] = $onz;
			$this->param['kg'] = $kg;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	// feet and inch calculator
	public function feet($request)
	{
		$feet1 = $request->input('feet1');
		$inches1 = $request->input('inches1');
		$operations = $request->input('operations');
		$feet2 = $request->input('feet2');
		$inches2 = $request->input('inches2');
		$ft_unit = "ft";
		$in_unit = "in";
		$baran = 12;
		if (is_numeric($feet1) && is_numeric($feet2) && !empty($inches1) && !empty($inches2)) {
			function calculation($inches1)
			{
				$int = 0;
				$float = 0;
				$parts = explode(' ', $inches1);
				if (count($parts) >= 1) {
					$int = $parts[0];
				}
				if (count($parts) >= 2) {
					$float_str = $parts[1];
					list($top, $bottom) = explode('/', $float_str);
					$float = $top / $bottom;
				}
				return $int + $float;
			}
			function convertToDecimal($inches1)
			{
				$numbers = explode("/", $inches1);
				return round($numbers[0] / $numbers[1], 6);
			}
			if (preg_match('/^(?:\d+\/\d+)$/', $inches1) && preg_match('/^(?:\d+\/\d+)$/', $inches2)) {
				$inches1 = convertToDecimal($inches1);
				$inches2 = convertToDecimal($inches2);
			} else if (preg_match('/^(\d+(?: \d+\/\d+)?)$/', $inches1) && preg_match('/^(\d+(?: \d+\/\d+)?)$/', $inches2)) {
				$inches1 = calculation($inches1);
				$inches2 = calculation($inches2);
			} else if (preg_match('/^(\d+(?: \d+\/\d+)?)$/', $inches1) && preg_match('/^(?:\d+\/\d+)$/', $inches2)) {
				$inches1 = calculation($inches1);
				$inches2 = convertToDecimal($inches2);
			} elseif (preg_match('/^(?:\d+\/\d+)$/', $inches1) && preg_match('/^(\d+(?: \d+\/\d+)?)$/', $inches2)) {
				$inches1 = convertToDecimal($inches1);
				$inches2 = calculation($inches2);
			}
			function float2rat($n, $tolerance = 1.e-6)
			{
				$h1 = 1;
				$h2 = 0;
				$k1 = 0;
				$k2 = 1;
				$b = 1 / $n;
				do {
					$b = 1 / $b;
					$a = floor($b);
					$aux = $h1;
					$h1 = $a * $h1 + $h2;
					$h2 = $aux;
					$aux = $k1;
					$k1 = $a * $k1 + $k2;
					$k2 = $aux;
					$b = $b - $a;
				} while (abs($n - $h1 / $k1) > $n * $tolerance);
				if ($k1 >= 2) {
					$div = $h1 / $k1;
					list($a1, $b1) = explode('.', $div);
					$mod = fmod($h1, $k1);
					if ($a1 >= 1) {
						return $a1 . " " . "$mod/$k1";
					} elseif ($a1 < 1) {
						return "$h1/$k1";
					}
				} else if ($k1 <= 1) {
					return "$h1";
				}
			}
			if ($operations == "1") {
				$in = trim($inches1) + trim($inches2);
				$ft = $feet1 + $feet2;
				$in = $in / $baran;
				if (!is_float($in)) {
					$ft = $ft + $in;
				} else if (is_float($in)) {
					list($f, $i) = explode(".", $in);
					$b = "0." . $i;
					$ft = $ft + $f;
					$in = $b * $baran;
					$in = (float2rat($in));
				}
			} elseif ($operations == "2") {
				if ($feet1 >= $feet2 && $inches1 >= $inches2) {
					$in = $inches1 - $inches2;
					$ft = $feet1 - $feet2;
					$in = $in / $baran;
					if (!is_float($in)) {
						$ft = $ft + $in;
					} else if (is_float($in)) {
						list($f, $i) = explode(".", $in);
						$b = "0." . $i;
						$ft = $ft + $f;
						$in = $b * $baran;
						$in = (float2rat($in));
					}
				} elseif ($feet1 <= $feet2 && $inches1 <= $inches2) {
					$in = $inches1 - $inches2;
					$ft = $feet1 - $feet2;
					$in = $in / $baran;
					if (!is_float($in)) {
						$ft = $ft + $in;
					} else if (is_float($in)) {
						list($f, $i) = explode(".", $in);
						$b = "0." . $i;
						$ft = $ft + $f;
						$in = $b * $baran;
						$in = (float2rat($in));
					} elseif ($feet1 >= $feet2 && $inches1 <= $inches2) {
						while ($inches1 < $inches2) {
							$inches2 = $inches2 - $baran;
							$feet2 = $feet2 + 1;
						}
						$in = $inches1 - $inches2;
						$ft = $feet1 - $feet2;
						$in = $in / $baran;
						if (!is_float($in)) {
							$ft = $ft + $in;
						} else if (is_float($in)) {
							list($f, $i) = explode(".", $in);
							$b = "0." . $i;
							$ft = $ft + $f;
							$in = $b * $baran;
							$in = (float2rat($in));
						}
					} elseif ($feet1 <= $feet2 && $inches1 >= $inches2) {
						while ($inches1 > $inches2) {
							$inches1 = $inches1 - $baran;
							$feet1 = $feet1 + 1;
						}
						while ($inches1 < $inches2) {
							$inches2 = $inches2 - $baran;
							$feet2 = $feet2 + 1;
						}
						$in = $inches1 - $inches2;
						$ft = $feet1 - $feet2;
						$in = $in / $baran;
						if (!is_float($in)) {
							$ft = $ft + $in;
						} else if (is_float($in)) {
							list($f, $i) = explode(".", $in);
							$b = "0." . $i;
							$ft = $ft + $f;
							$in = $b * $baran;
							$in = (float2rat($in));
						}
					}
				}
			} elseif ($operations == "3") {
				$ft1 = $feet1 * $baran;
				$ft2 = $feet2 * $baran;
				$fot1 = $ft1 + $inches1;
				$fot2 = $ft2 + $inches2;
				$ft2 = $fot1 * $fot2;
				$in1 = $inches1 / $baran;
				$in2 = $inches2 / $baran;
				$inc1 = $in1 + $feet1;
				$inc2 = $in2 + $feet2;
				$c = $inc1 * $inc2;
				$in2 = number_format($c, 4);
			} elseif ($operations == "4") {
				$ft1 = $feet1 * $baran;
				$ft21 = $feet2 * $baran;
				$fot1 = $ft1 + $inches1;
				$fot2 = $ft21 + $inches2;
				$a = $fot1 / $fot2;
				$ft_div = number_format($a, 4);
			}
			$this->param['ft_unit'] = $ft_unit;
			$this->param['in_unit'] = $in_unit;
			if (!empty($ft)) {
				$this->param['ft'] = $ft;
			}
			if (!empty($in)) {
				$this->param['in'] = $in;
			}
			if (!empty($ft2)) {
				$this->param['ft2'] = $ft2;
			}
			if (!empty($in2)) {
				$this->param['in2'] = $in2;
			}
			if (!empty($ft_div)) {
				$this->param['ft_div'] = $ft_div;
			}
			$this->param['RESULT'] = 1;
			//   dd($this->param);
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	// acreage calculator
	public function acreage($request)
	{
		$to_cal = $request->input('to_cal');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$area = $request->input('area');
		$area_unit = $request->input('area_unit');
		$price = $request->input('price');
		$price_unit = $request->input('price_unit');
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy, '', $price_unit);
		if ($to_cal == 1) {
			if (is_numeric($length) && is_numeric($width)) {
				if ($width_unit === 'cm') {
					$width = $width * 0.01;
				} elseif ($width_unit === 'in') {
					$width = $width * 0.0254;
				} elseif ($width_unit === 'ft') {
					$width = $width * 0.3048;
				} elseif ($width_unit === 'yd') {
					$width = $width * 0.9144;
				} elseif ($width_unit == 'mm') {
					$width = $width * 0.001;
				}
				$area = $width * $length;
				$perimeter = ($width * 2) + ($length * 2);
				if (is_numeric($price)) {
					if ($price_unit == '/mm²') {
						$ans = $area * 1000000;
					} elseif ($price_unit == '/cm²') {
						$ans = $area * 10000;
					} elseif ($price_unit == '/m²') {
						$ans = $area * 1;
					} elseif ($price_unit == '/in²') {
						$ans = $area * 1550.003;
					} elseif ($price_unit == '/ft²') {
						$ans = $area * 10.7639;
					} elseif ($price_unit == '/yd²') {
						$ans = $area * 1.19599;
					} elseif ($price_unit == '/ac') {
						$ans = $area * 0.0002471054;
					} elseif ($price_unit == '/ha') {
						$ans = $area * 0.0001;
					}
					$final_price = $ans * $price;
					$this->param['final_price'] = $final_price;
				}
				$this->param['area'] = $area;
				$this->param['perimeter'] = $perimeter;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} elseif ($to_cal == 2) {
			if (is_numeric($width) && is_numeric($area)) {
				if ($width_unit === 'cm') {
					$width = $width * 0.01;
				} elseif ($width_unit === 'in') {
					$width = $width * 0.0254;
				} elseif ($width_unit === 'ft') {
					$width = $width * 0.3048;
				} elseif ($width_unit === 'yd') {
					$width = $width * 0.9144;
				} elseif ($width_unit == 'mm') {
					$width = $width * 0.001;
				}
				if ($area_unit == 'mm²') {
					$area = $area * 0.000001;
				} elseif ($area_unit == 'cm²') {
					$area = $area * 0.0001;
				} elseif ($area_unit == 'm²') {
					$area = $area * 1;
				} elseif ($area_unit == 'in²') {
					$area = $area * 0.00064516;
				} elseif ($area_unit == 'ft²') {
					$area = $area * 0.092903;
				} elseif ($area_unit == 'yd²') {
					$area = $area * 0.836127;
				} elseif ($area_unit == 'ac') {
					$area = $area * 4046.86;
				} elseif ($area_unit == 'ha') {
					$area = $area * 10000;
				}
				$length = $area / $width;
				$perimeter = ($width * 2) + ($length * 2);
				if (is_numeric($price)) {
					if ($price_unit == '/mm²') {
						$ans = $area * 1000000;
					} elseif ($price_unit == '/cm²') {
						$ans = $area * 10000;
					} elseif ($price_unit == '/m²') {
						$ans = $area * 1;
					} elseif ($price_unit == '/in²') {
						$ans = $area * 1550.003;
					} elseif ($price_unit == '/ft²') {
						$ans = $area * 10.7639;
					} elseif ($price_unit == '/yd²') {
						$ans = $area * 1.19599;
					} elseif ($price_unit == '/ac') {
						$ans = $area * 0.0002471054;
					} elseif ($price_unit == '/ha') {
						$ans = $area * 0.0001;
					}
					$final_price = $ans * $price;
					$this->param['final_price'] = $final_price;
				}
				$this->param['length'] = $length;
				$this->param['perimeter'] = $perimeter;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} elseif ($to_cal == 3) {
			if (is_numeric($length) && is_numeric($area)) {
				if ($length_unit === 'cm') {
					$length = $length * 0.01;
				} elseif ($length_unit === 'in') {
					$length = $length * 0.0254;
				} elseif ($length_unit === 'ft') {
					$length = $length * 0.3048;
				} elseif ($length_unit === 'yd') {
					$length = $length * 0.9144;
				} elseif ($length_unit == 'mm') {
					$length = $length * 0.001;
				}
				if ($area_unit == 'mm²') {
					$area = $area * 0.000001;
				} elseif ($area_unit == 'cm²') {
					$area = $area * 0.0001;
				} elseif ($area_unit == 'm²') {
					$area = $area * 1;
				} elseif ($area_unit == 'in²') {
					$area = $area * 0.00064516;
				} elseif ($area_unit == 'ft²') {
					$area = $area * 0.092903;
				} elseif ($area_unit == 'yd²') {
					$area = $area * 0.836127;
				} elseif ($area_unit == 'ac') {
					$area = $area * 4046.86;
				} elseif ($area_unit == 'ha') {
					$area = $area * 10000;
				}
				$width = $area / $length;
				$perimeter = ($width * 2) + ($length * 2);
				if (is_numeric($price)) {
					if ($price_unit == '/mm²') {
						$ans = $area * 1000000;
					} elseif ($price_unit == '/cm²') {
						$ans = $area * 10000;
					} elseif ($price_unit == '/m²') {
						$ans = $area * 1;
					} elseif ($price_unit == '/in²') {
						$ans = $area * 1550.003;
					} elseif ($price_unit == '/ft²') {
						$ans = $area * 10.7639;
					} elseif ($price_unit == '/yd²') {
						$ans = $area * 1.19599;
					} elseif ($price_unit == '/ac') {
						$ans = $area * 0.0002471054;
					} elseif ($price_unit == '/ha') {
						$ans = $area * 0.0001;
					}
					$final_price = $ans * $price;
					$this->param['final_price'] = $final_price;
				}
				$this->param['width'] = $width;
				$this->param['perimeter'] = $perimeter;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		}
	}

	public function winning($request)
	{
		$win = $request->input('win');
		$loss = $request->input('loss');
		$tie = $request->input('tie');
		$value = $request->input('value');

		if (is_numeric($win) && is_numeric($loss)) {
			$no_games = $win * $loss;
			$total = $win + $loss;
			if (is_numeric($tie)) {
				$total = $total + $tie;
			}
			if (is_numeric($value) && $value != 0) {
				$ans = (($win + ($value * $tie)) / $total) * 100;
			} else {
				$ans = ($win / $total) * 100;
			}
			$this->param['ans'] = $ans;
			$this->param['no_games'] = $no_games;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	public function mcg($request)
	{
		$operations = $request->input('operations');
		$first = $request->input('first');
		if ($operations == "1") {
			if (is_numeric($first)) {
				$jawab = $first / 1000;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else if ($operations == "2") {
			if (is_numeric($first)) {
				$jawab = $first * 1000;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		}
		$this->param['jawab'] = $jawab;
		$this->param['operations'] = $operations;
		$this->param['RESULT'] = 1;

		return $this->param;
	}


	public function cat($request)
	{
		$year = $request->input('year');
		$month = $request->input('month');
		$method = $request->input('method');
		if (is_numeric($year) || is_numeric($month)) {
			$age = 0;
			if (is_numeric($year)) {
				$age = $year;
			}
			if (is_numeric($month) && $month != 0) {
				$age += $month / 12;
			}
			if ($method == 1) {
				if ($age >= 6) {
					$ans = round(40 + 4 * ($age - 6));
				} else {
					$ans = round(6.6666 * $age + 0.066666667);
				}
			} elseif ($method == 2) {
				if ($age >= 40) {
					$ans = round((0.25 * $age) - 4);
				} else {
					$ans = round(($age - 0.066666667) / 6.6666);
				}
			}
			$this->param['ans'] = $ans;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	// turky size calculator
	public function turkey($request)
	{
		$adults = $request->input('adults');
		$children = $request->input('children');
		$leftovers = $request->input('leftovers');
		function convertToHoursMins($time, $format = '%02d hrs %02d mins')
		{
			if ($time < 1) {
				return;
			}
			$hours = floor($time / 60);
			$minutes = ($time % 60);
			return sprintf($format, $hours, $minutes);
		}
		if (is_numeric($adults) && is_numeric($children)) {
			if ($adults >= 0) {
				if ($children >= 0) {
					if ($leftovers == "no") {
						$mul1 = $adults;
						$mul2 = 0.5 * $children;
						$turkey_weight = $mul1 + $mul2;
					} else {
						$mul1 = $adults * 1.5;
						$mul2 = 0.75 * $children;
						$turkey_weight = $mul1 + $mul2;
					}
					$inside_fridge = $turkey_weight * 5;
					$cold_water = $turkey_weight;
					$unstuffed_turkey = convertToHoursMins($turkey_weight * 15);
					$stuffed_turkey	= convertToHoursMins($turkey_weight * 17.5);
					// return values
					$this->param = array(
						"turkey_weight" => $turkey_weight,
						"inside_fridge" => $inside_fridge,
						"cold_water" => $cold_water,
						"unstuffed_turkey" => $unstuffed_turkey,
						"stuffed_turkey" => $stuffed_turkey,
					);
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Number of children cannot be lower than 0.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Number of adults cannot be lower than 0.';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	// squrare meter calculator
	public function square_meter($request)
	{
		$volume_select = $request->input('volume_select');
		$volume_select = (int)$volume_select;
		$length = trim($request->input('length'));
		$l_units = trim($request->input('l_units'));
		$width = trim($request->input('width'));
		$w_units = trim($request->input('w_units'));
		$side = trim($request->input('side'));
		$s_usits = trim($request->input('s_units'));
		$quantity = trim($request->input('quantity'));
		$quantity = isset($quantity) ? $quantity : 1;
		$price = trim($request->input('price'));

		function meterconvert($a, $b)
		{
			if ($b == 'mm') {
				$convert = $a / 1000;
			} else if ($b == 'cm') {
				$convert = $a / 100;
			} else if ($b == 'in') {
				$convert = $a / 39.37;
			} else if ($b == 'ft') {
				$convert = $a / 3.281;
			} else if ($b == 'yd') {
				$convert = $a / 1.094;
			} else {
				$convert = $a;
			}
			return $convert;
		}

		$length = meterconvert($length, $l_units);
		$width = meterconvert($width, $w_units);
		$side = meterconvert($side, $s_usits);

		if ($volume_select === 1) {
			if (is_numeric($length)) {
				if (is_numeric($price)) {
					$res =	$width * $length;
					$cost =	$price * $res;
				} else {
					$res =	$width * $length;
					$res =	$res * $quantity;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} elseif ($volume_select === 2) {
			if (is_numeric($price)) {
				$res =	pow($width, 2);
				$cost =	$price * $res;
			} else {
				$res =	pow($width, 2);
				$res =	$res * $quantity;
			}
		} elseif ($volume_select === 3) {
			if (is_numeric($length)) {
				if (is_numeric($price)) {
					$radi =	$length / 2;
					$res = (3.1416) * pow($radi, 2);
					$cost =	$price * $res;
				} else {
					$radi =	$length / 2;
					$res = (3.1416) * pow($radi, 2);
					$res =	$res * $quantity;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else {
			if (is_numeric($length) && is_numeric($width) && is_numeric($side)) {
				if (is_numeric($price)) {
					$res =	0.25 * sqrt(($length + $width + $side) * (-$length + $width + $side) * ($length - $width + $side) * ($length + $width - $side));
					$cost =	$price * $res;
				} else {
					$res =	0.25 * sqrt(($length + $width + $side) * (-$length + $width + $side) * ($length - $width + $side) * ($length + $width - $side));
					$res =	$res * $quantity;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		}
		if (is_numeric($price)) {
			$this->param['res'] = $res;
			$this->param['cost'] = $cost;
		} else {
			$this->param['res'] = $res;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// curtian size calculator
	public function curtain($request)
	{
		$type_curtain = trim($request->input('type_curtain'));
		$fullness = trim($request->input('fullness'));
		$w_height = trim($request->input('w_height'));
		$w_width = trim($request->input('w_width'));
		$wh_units = trim($request->input('wh_units'));
		$ww_units = trim($request->input('ww_units'));
		if (!empty($type_curtain)) {
			if (is_numeric($w_height) && is_numeric($w_width)) {
				if (isset($wh_units)) {
					if ($wh_units == 'mm') {
						$w_height = $w_height * 25.4;
					} else if ($wh_units == 'cm') {
						$w_height = $w_height * 2.54;
					} else if ($wh_units == 'm') {
						$w_height = $w_height / 39.37;
					} else if ($wh_units == 'ft') {
						$w_height = $w_height / 12;
					} else if ($wh_units == 'yd') {
						$w_height = $w_height / 36;
					}
				}
				if (isset($ww_units)) {
					if ($ww_units == 'mm') {
						$w_width = $w_width * 25.4;
					} else if ($ww_units == 'cm') {
						$w_width = $w_width * 2.54;
					} else if ($ww_units == 'm') {
						$w_width = $w_width / 39.37;
					} else if ($ww_units == 'ft') {
						$w_width = $w_width / 12;
					} else if ($ww_units == 'yd') {
						$w_width = $w_width / 36;
					}
				}

				if ($type_curtain == 'sill_lenght') {
					$c_lenght =	$w_height + 4;
				} else if ($type_curtain == 'cafe_length') {
					$c_lenght =	$w_height / 2;
				} else if ($type_curtain == 'extra_long') {
					$c_lenght =	$w_height + 4 + 6;
				}
				if ($fullness == 'std_full') {
					$c_width =	$w_width * 2;
				} else if ($fullness == 'del_full') {
					$c_width =	$w_width * 2.5;
				} else if ($fullness == 'ult_full') {
					$c_width =	$w_width * 3;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['type_curtain'] = $type_curtain;
		$this->param['w_height'] = $w_height;
		$this->param['w_width'] = $w_width;
		$this->param['c_lenght'] = $c_lenght;
		$this->param['c_width'] = $c_width;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function sleep($request)
	{
		$h = $request->input('h');
		$stype = $request->input('stype');
		if ($stype == 'bedtime') {
			date_default_timezone_set('Asia/Karachi');
			$timestamp = strtotime($h) + (((14 * 60) + 45) * 60);
			$timestamp2 = $timestamp  + 90 * 60;
			$timestamp3 = $timestamp2 + 90 * 60;
			$timestamp4 = $timestamp3 + 90 * 60;
			$timestamp5 = $timestamp4 + 90 * 60;
			$timestamp6 = $timestamp5 + 90 * 60;
			$time  = date('h:i:sa', $timestamp);
			$time2 = date('h:i:sa', $timestamp2);
			$time3 = date('h:i:sa', $timestamp3);
			$time4 = date('h:i:sa', $timestamp4);
			$time5 = date('h:i:sa', $timestamp5);
			$time6 = date('h:i:sa', $timestamp6);
		} elseif ($stype == 'wkup') {
			date_default_timezone_set('Asia/Karachi');
			$date = date('h:i:sa');
			$timestamp = strtotime($date) + ((465 + 90) * 60);
			$timestamp2 = $timestamp -  90 * 60;
			$timestamp3 = $timestamp2 -  90 * 60;
			$timestamp4 = $timestamp3 -  90 * 60;
			$timestamp5 = $timestamp4 -  90 * 60;
			$timestamp6 = $timestamp5 -  90 * 60;
			$time   = date('h:i:sa', $timestamp);
			$time2  = date('h:i:sa', $timestamp2);
			$time3  = date('h:i:sa', $timestamp3);
			$time4  = date('h:i:sa', $timestamp4);
			$time5  = date('h:i:sa', $timestamp5);
			$time6  = date('h:i:sa', $timestamp6);
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['time']	= $time;
		$this->param['time2']	= $time2;
		$this->param['time3']	= $time3;
		$this->param['time4']	= $time4;
		$this->param['time5']	= $time5;
		$this->param['time6']	= $time6;
		$this->param['stype']	= $stype;
		$this->param['RESULT'] 	= 1;
		return $this->param;
	}

	// height compression
	public function compression($request)
	{
		$height = trim($request->input('height'));
		$height_unit = trim($request->input('height_unit'));
		$stone = trim($request->input('stone'));
		$stone_unit = trim($request->input('stone_unit'));
		$length = trim($request->input('length'));
		$length_unit = trim($request->input('length_unit'));
		$deck = trim($request->input('deck'));
		$deck_unit = trim($request->input('deck_unit'));
		function unit_in($a, $b)
		{
			if ($b == "in") {
				$unit_unit = $a * 1;
			} else {
				$unit_unit = $a * 39.37;
			}
			return $unit_unit;
		}
		if (is_numeric($height) && is_numeric($height) && is_numeric($stone) && is_numeric($deck)) {
			$height = unit_in($height, $height_unit);
			$length = unit_in($length, $length_unit);
			$stone = unit_in($stone, $stone_unit);
			$deck = unit_in($deck, $deck_unit);
			$compression_val = $height - (0.5 * $stone) - $length - $deck;
			$compression_val_m = $compression_val / 39.37;
			$this->param['compression_val'] = $compression_val;
			$this->param['compression_val_m'] = $compression_val_m;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// dog crete size
	public function dog_crate_size($request)
	{
		$extra_lenght = trim($request->input('extra_lenght'));
		$height = trim($request->input('height'));
		$h_units = trim($request->input('h_units'));
		$length = trim($request->input('length'));
		$l_units = trim($request->input('l_units'));
		function unitConverter($input_value, $units)
		{
			if ($units == 'm') {
				$input_value = $input_value * 100;
			} else if ($units == 'in') {
				$input_value = $input_value * 2.54;
			} else if ($units == 'ft') {
				$input_value = $input_value * 30.48;
			}
			return $input_value;
		}
		if (is_numeric($height) && is_numeric($length)) {

			if (isset($l_units)) {
				$length = unitConverter($length, $l_units);
			}
			if (isset($h_units)) {
				$height = unitConverter($height, $h_units);
			}
			$c_height = $height + $extra_lenght;
			$c_lenght = $length + $extra_lenght;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		// dd($l_units);
		$this->param['c_height'] = $c_height;
		$this->param['c_lenght'] = $c_lenght;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// blind size calculator
	public function blind($request)
	{
		$type = trim($request->input('type'));
		$top = trim($request->input('top'));
		$t_units = trim($request->input('t_units'));
		$width = trim($request->input('width'));
		$w_units = trim($request->input('w_units'));
		$bottom = trim($request->input('bottom'));
		$b_units = trim($request->input('b_units'));
		$h_left = trim($request->input('h_left'));
		$l_units = trim($request->input('l_units'));
		$h_center = trim($request->input('h_center'));
		$c_units = trim($request->input('c_units'));
		$h_right = trim($request->input('h_right'));
		$r_units = trim($request->input('r_units'));
		if (!empty($type)) {
			if (
				is_numeric($top) && is_numeric($width) && is_numeric($bottom)
				&& is_numeric($h_left) && is_numeric($h_center) && is_numeric($h_right)
			) {
				if (isset($t_units)) {
					if ($t_units == 'mm') {
						$top = $top / 25.4;
					} else if ($t_units == 'cm') {
						$top = $top / 2.54;
					} else if ($t_units == 'ft') {
						$top = $top * 12;
					}
				}
				if (isset($w_units)) {
					if ($w_units == 'mm') {
						$width = $width / 25.4;
					} else if ($w_units == 'cm') {
						$width = $width / 2.54;
					} else if ($w_units == 'ft') {
						$width = $width * 12;
					}
				}
				if (isset($b_units)) {
					if ($b_units == 'mm') {
						$bottom = $bottom / 25.4;
					} else if ($b_units == 'cm') {
						$bottom = $bottom / 2.54;
					} else if ($b_units == 'ft') {
						$bottom = $bottom * 12;
					}
				}
				if (isset($l_units)) {
					if ($l_units == 'mm') {
						$h_left = $h_left / 25.4;
					} else if ($l_units == 'cm') {
						$h_left = $h_left / 2.54;
					} else if ($l_units == 'ft') {
						$h_left = $h_left * 12;
					}
				}
				if (isset($c_units)) {
					if ($c_units == 'mm') {
						$h_center = $h_center / 25.4;
					} else if ($c_units == 'cm') {
						$h_center = $h_center / 2.54;
					} else if ($c_units == 'ft') {
						$h_center = $h_center * 12;
					}
				}
				if (isset($r_units)) {
					if ($r_units == 'mm') {
						$h_right = $h_right / 25.4;
					} else if ($r_units == 'cm') {
						$h_right = $h_right / 2.54;
					} else if ($r_units == 'ft') {
						$h_right = $h_right * 12;
					}
				}
				$s_lenght = '';
				if ($type == 'inside') {
					$blind_width = min($top, $width, $bottom);
					$blind_lenght = min($h_left, $h_center, $h_right);
					$s_lenght = $blind_lenght - 0.25;
				} else if ($type == 'outside') {
					$smallest_width = min($top, $width, $bottom);
					$smallest_lenght = min($h_left, $h_center, $h_right);
					$blind_width = $smallest_width + 3;
					$blind_lenght = $smallest_lenght + 1.5;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['type'] = $type;
		$this->param['blind_width'] = $blind_width;
		$this->param['blind_lenght'] = $blind_lenght;
		$this->param['s_lenght'] = $s_lenght;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function tesla($request)
	{
		$main_unit = trim($request->input('main_unit'));
		$battery = trim($request->input('battery'));
		$electricity = trim($request->input('electricity'));
		$type = trim($request->input('type'));
		$price = trim($request->input('price'));
		$distance = trim($request->input('distance'));
		$units = trim($request->input('units'));
		if ($main_unit === "Full Capacity Charging Cost") {
			if (is_numeric($battery) && is_numeric($electricity)) {
				$cost = $battery * $electricity;
				$this->param['cost'] = $cost;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else if ($main_unit === "Custom Distance Charging Cost") {
			$Model = [
				'1' => ["name" => "Tesla Model S (2013 - 60D)", "capacity" => 60, "efficiency" => 35],
				'2' => ["name" => "Tesla Model S (2016 - 60D)", "capacity" => 62, "efficiency" => 32],
				'3' => ["name" => "Tesla Model S (2017 - 100D)", "capacity" => 95, "efficiency" => 33],
				'4' => ["name" => "Tesla Model 3 (2019)", "capacity" => 54, "efficiency" => 26],
				'5' => ["name" => "Tesla Model 3 (2021)", "capacity" => 82, "efficiency" => 29],
				'6' => ["name" => "Tesla Model X (2016 - 90D)", "capacity" => 90, "efficiency" => 34],
				'7' => ["name" => "Tesla Model X (2016 - P100D)", "capacity" => 100, "efficiency" => 38],
				'8' => ["name" => "Tesla Model Y (2021)", "capacity" => 75, "efficiency" => 24],
				'9' => ["name" => "Chevrolet Bolt (2016)", "capacity" => 60, "efficiency" => 20.8],
				'10' => ["name" => "Audi Q4 e-tron 50 quattro", "capacity" => 77, "efficiency" => 32],
				'11' => ["name" => "Nissan Leaf", "capacity" => 36, "efficiency" => 28],
				'12' => ["name" => "Hyundai IONIQ Electric", "capacity" => 38.3, "efficiency" => 24.5],
				'13' => ["name" => "Citroen e-C4", "capacity" => 45, "efficiency" => 29],
				'14' => ["name" => "Kia EV6", "capacity" => 58, "efficiency" => 26.5],
				'15' => ["name" => "Kia Soul EV", "capacity" => 64, "efficiency" => 28],
				'16' => ["name" => "BMW i3", "capacity" => 37.9, "efficiency" => 26],
				'17' => ["name" => "BMW i4", "capacity" => 80, "efficiency" => 29],
				'18' => ["name" => "Fiat 500e", "capacity" => 42, "efficiency" => 27.5],
				'19' => ["name" => "Hyundai Kona Electric", "capacity" => 64, "efficiency" => 26],
			];

			if (!empty($type)) {
				if (is_numeric($price) && is_numeric($distance)) {
					$modelDetail = $Model[$type];
					$name = $modelDetail['name'];
					$capacity = $modelDetail['capacity'];
					$efficiency = $modelDetail['efficiency'];

					if ($units == 'mi') {
						$distance = $distance * 1.609;
					}

					$efficiency = $efficiency * 0.621;
					$cost = $price * $capacity;
					$res = $price * $distance * $efficiency;
					$ec = $res / 100;

					$this->param['name'] = $name;
					$this->param['capacity'] = $capacity;
					$this->param['efficiency'] = $efficiency;
					$this->param['cost'] = $cost;
					$this->param['ec'] = $ec;
				} else {
					$this->param['error'] = 'Please! Check Your Inputs';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}

		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function swimming($request)
	{
		$weight      = trim($request->input('weight'));
		$weight_unit = trim($request->input('weight_unit'));
		$time        = trim($request->input('time'));
		$time_unit   = trim($request->input('time_unit'));
		$style       = trim($request->input('style'));
		function convert_to_kg($unit, $value)
		{
			if ($unit == 'lb') {
				$ans = $value / 2.205;
			} elseif ($unit == 'kg') {
				$ans = $value;
			} elseif ($unit == 'stone') {
				$ans = $value * 6.35;
			}
			return $ans;
		}

		function convert_to_min($unit, $value)
		{
			if ($unit == 'sec') {
				$ans = $value / 60;
			} elseif ($unit == 'min') {
				$ans = $value;
			} elseif ($unit == 'hrs') {
				$ans = $value * 60;
			}
			return $ans;
		}

		if (is_numeric($style) && is_numeric($weight) && !empty($weight_unit)) {
			if (!empty($time_unit)) {
				if (is_numeric($time)) {
					$final_min = convert_to_min($time_unit, $time);
				} else {
					$this->param['error'] = 'Please! Check Your Inputs';
					return $this->param;
				}
				$final_weight = convert_to_kg($weight_unit, $weight);


				$cal_burned_per_min = ($style * $final_weight * 3.5) / 200;

				$total_cal_burned = $cal_burned_per_min * $final_min;

				$this->param['cal_burned_per_min'] = round($cal_burned_per_min, 2);
				$this->param['total_cal_burned']   = round($total_cal_burned, 2);
				$this->param['RESULT']             = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	public function fuel($request)
	{

		$distance = trim($request->input('distance'));
		$d_units = trim($request->input('d_units'));
		$f_efficiency = trim($request->input('f_efficiency'));
		$f_eff_units = trim($request->input('f_eff_units'));
		$f_price = trim($request->input('f_price'));
		$f_p_units = trim($request->input('f_p_units'));
		$currancy = $request->input('currancy');
		$f_p_units = str_replace($currancy, '', $f_p_units);
		if (is_numeric($distance) && is_numeric($f_efficiency) && is_numeric($f_price)) {

			if (isset($d_units)) {
				if ($d_units == 'mi') {
					$distance = $distance * 1.6093;
				}
			}
			if (isset($f_eff_units)) {
				if ($f_eff_units == 'L/100km') {
					$f_efficiency = 100 / $f_efficiency;
				} else if ($f_eff_units == 'US mpg') {
					$f_efficiency = $f_efficiency * 0.425144;
				} else if ($f_eff_units == 'UK mpg') {
					$f_efficiency = $f_efficiency * 0.354006;
				} else if ($f_eff_units == 'lpm') {
					$eff = 1 / $f_efficiency;
					$f_efficiency = $eff * 1.6093;
				}
			}
			if (isset($f_p_units)) {
				if ($f_p_units == '/cl') {
					$f_price = $f_price * 100;
				} else if ($f_p_units == '/US gal') {
					$f_price = $f_price * 0.26;
				} else if ($f_p_units == '/UK gal') {
					$f_price = $f_price * 0.22;
				}
			}
			$fuel = $distance / $f_efficiency;
			$trip_cost = $fuel * $f_price;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['distance'] = $distance;
		$this->param['f_efficiency'] = $f_efficiency;
		$this->param['f_eff_units'] = $f_eff_units;
		$this->param['f_p_units'] = $f_p_units;
		$this->param['f_price'] = $f_price;
		$this->param['fuel'] = $fuel;
		$this->param['trip_cost'] = $trip_cost;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function roof_replacement($request)
	{
		$size2 = trim($request->input('size2'));
		$slop = trim($request->input('slop'));
		$difficulty = trim($request->input('difficulty'));
		$existing = trim($request->input('existing'));
		$floor = trim($request->input('floor'));
		$material = trim($request->input('material'));
		$region = trim($request->input('region'));
		$size1 = trim($request->input('size1'));

		if (is_numeric($size1) && is_numeric($size2)) {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://www.roofcalc.org/scripts/calc-widget-test.php',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => array('size1' => $size1, 'device' => 'desk', 'size2' => $size2, 'material' => $material, 'slop' => $slop, 'difficulty' => $difficulty, 'sky' => '', 'ridge' => '', 'floor' => $floor, 'existing' => $existing, 'region' => $region),
				CURLOPT_HTTPHEADER => array(
					'Cookie: PHPSESSID=9886c1db5ddcc7f383052a97e803ef26'
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$resp = $response;
			preg_match_all("/\\$[0-9]*/m", $resp, $matches);
			$result = $matches[0];
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['result'] = $result;
		$this->param['RESULT'] = 1;
		return  $this->param;
	}

	public function river($request)
	{
		$rock_type = trim($request->input('rock_type'));
		$density = trim($request->input('density'));
		$density_unit = trim($request->input('density_unit'));
		$length = trim($request->input('length'));
		$length_unit = trim($request->input('length_unit'));
		$width = trim($request->input('width'));
		$width_unit = trim($request->input('width_unit'));
		$depth = trim($request->input('depth'));
		$depth_unit = trim($request->input('depth_unit'));
		$wastage = trim($request->input('wastage'));
		$price = trim($request->input('price'));
		$price_unit = trim($request->input('price_unit'));
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy, '', $price_unit);
		function sigFig($value, $digits)
		{
			if ($value !== '') {
				if ($value === 0) {
					$decimalPlaces = $digits - 1;
				} elseif ($value < 0) {
					$decimalPlaces = $digits - floor(log10($value * -1)) - 1;
				} else {
					$decimalPlaces = $digits - floor(log10($value)) - 1;
				}
				$answer = round($value, $decimalPlaces);
				return $answer;
			}
		}

		if (is_numeric($length) && !empty($length_unit) && !empty($density) && is_numeric($width) && !empty($width_unit) && is_numeric($depth) && !empty($depth_unit)) {
			// Unit Conversion
			if ($length_unit === 'mm') {
				$length = $length / 1000;
			} elseif ($length_unit === 'cm') {
				$length = $length / 100;
			} elseif ($length_unit === 'in') {
				$length = $length / 39.3701;
			} elseif ($length_unit === 'ft') {
				$length = $length / 3.28084;
			} elseif ($length_unit === 'yd') {
				$length = $length / 1.093613;
			}
			if ($width_unit === 'mm') {
				$width = $width / 1000;
			} elseif ($width_unit === 'cm') {
				$width = $width / 100;
			} elseif ($width_unit === 'in') {
				$width = $width / 39.3701;
			} elseif ($width_unit === 'ft') {
				$width = $width / 3.28084;
			} elseif ($width_unit === 'yd') {
				$width = $width / 1.093613;
			}
			if ($depth_unit === 'mm') {
				$depth = $depth / 1000;
			} elseif ($depth_unit === 'cm') {
				$depth = $depth / 100;
			} elseif ($depth_unit === 'in') {
				$depth = $depth / 39.3701;
			} elseif ($depth_unit === 'ft') {
				$depth = $depth / 3.28084;
			} elseif ($depth_unit === 'yd') {
				$depth = $depth / 1.093613;
			}
			if ($density_unit === 't_m3' || $density_unit === 'g_cm3') {
				$density = $density / 0.001;
			} elseif ($density_unit === 'lb_cu_in') {
				$density = $density / 0.0000361273;
			} elseif ($density_unit === 'lb_cu_ft') {
				$density = $density / 0.062428;
			} elseif ($density_unit === 'lb_cu_yd') {
				$density = $density / 1.685555;
			}

			$area = $width * $length;
			$volume = ($area * $depth) * (1 + $wastage / 100);
			$weight = $volume * $density;
			$weight = $weight * 0.001;
			$price_v = '';
			$price_v_units = [];
			$total_cost = '';

			if (is_numeric($price) && !empty($price_unit)) {
				// Unit Conversion
				if ($price_unit === '/kg') {
					$price = $price * 1000;
				} elseif ($price_unit === '/lb') {
					$price = $price * 2204.62;
				} elseif ($price_unit === '/stone') {
					$price = $price * 157.47;
				} elseif ($price_unit === '/us_ton') {
					$price = $price * 1.10;
				} elseif ($price_unit === '/long_ton') {
					$price = $price * 0.98;
				}

				$price_v = $price * $density / 1000;
				$total_cost = $price * $weight;

				$price_v_cm3 = sigFig(($price_v / 1000000), 3) . '@@@cm³';
				$price_v_cu_in = sigFig(($price_v / 61023.74), 3) . '@@@cu in';
				$price_v_cu_ft = sigFig(($price_v * 0.03), 3) . '@@@cu ft';
				$price_v_cu_yd = sigFig(($price_v * 0.76), 3) . '@@@cu yd';

				$price_v_units = [$price_v_cm3, $price_v_cu_in, $price_v_cu_ft, $price_v_cu_yd];
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}

		// Other Units

		$volume_cm3 = number_format(sigFig(($volume * 1000000), 3)) . '@@@cm³';
		$volume_cu_in = sigFig(($volume * 61024), 3) . '@@@cu in';
		$volume_cu_ft = sigFig(($volume * 35.3), 3) . '@@@cu ft';
		$volume_cu_yd = sigFig(($volume * 1.308), 3) . '@@@cu yd';

		$weight_kg = sigFig(($weight * 1000), 3) . '@@@kg';
		$weight_lb = sigFig(($weight * 2205), 3) . '@@@lb';
		$weight_stone = sigFig(($weight * 157.5), 3) . '@@@stone';
		$weight_us_ton = sigFig(($weight * 1.102), 3) . '@@@US ton';
		$weight_long_ton = sigFig(($weight * 0.984), 3) . '@@@Long ton';

		$area_cm2 = number_format(sigFig(($area * 10000), 3)) . '@@@cm²';
		$area_km2 = sigFig(($area * 0.000001), 3) . '@@@km²';
		$area_in2 = sigFig(($area * 1550), 3) . '@@@in²';
		$area_ft2 = sigFig(($area * 10.76), 3) . '@@@ft²';
		$area_yd2 = sigFig(($area * 1.196), 3) . '@@@yd²';
		$area_mi2 = sigFig(($area * 0.000000386), 3) . '@@@mi²';

		$volume_units = [$volume_cm3, $volume_cu_in, $volume_cu_ft, $volume_cu_yd];
		$weight_units = [$weight_kg, $weight_lb, $weight_stone, $weight_us_ton, $weight_long_ton];
		$area_units = [$area_cm2, $area_km2, $area_in2, $area_ft2, $area_yd2, $area_mi2];

		$this->param['volume'] = sigFig($volume, 3);
		$this->param['volume_units'] = $volume_units;
		$this->param['weight'] = sigFig($weight, 3);
		$this->param['weight_units'] = $weight_units;
		$this->param['area'] = sigFig($area, 3);
		$this->param['area_units'] = $area_units;
		$this->param['price_v'] = sigFig($price_v, 3);
		$this->param['price_v_units'] = $price_v_units;
		$this->param['total_cost'] = sigFig($total_cost, 3);
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function circle($request)
	{
		$type           = $request->input('type');
		$length          = $request->input('length');
		$length_unit     = $request->input('length_unit');
		$waist           = $request->input('waist');
		$waist_unit      = $request->input('waist_unit');
		function convertToCm($value, $unit)
		{
			switch ($unit) {
				case 'mm':
					return $value * 0.1; // Millimeters to centimeters
				case 'cm':
					return $value; // Centimeters to centimeters (no conversion needed)
				case 'm':
					return $value * 100; // Meters to centimeters
				case 'in':
					return $value * 2.54; // Inches to centimeters
				case 'ft':
					return $value * 30.48; // Feet to centimeters
				default:
					return null; // Invalid unit
			}
		}


		if (is_numeric($length) && is_numeric($waist) && !empty($type)) {
			$length_cm = convertToCm($length, $length_unit);
			$waist_cm  = convertToCm($waist, $waist_unit);

			//  value of π = 3.14
			if ($type == 'full') {
				$radius_cm = $waist_cm / (2 * 3.14) - 2;       //for a full circle skirt;
			} else if ($type == 'three-quarter') {
				$radius_cm = 4 / 3 * $waist_cm / (2 * 3.14) - 2; //for a 3/4 circle skirt;
			} else if ($type == 'half') {
				$radius_cm = 2 * $waist_cm / (2 * 3.14) - 2;   //for a half circle skirt;
			} else if ($type == 'quarter') {
				$radius_cm = 4 * $waist_cm / (2 * 3.14) - 2;   //for a quarter circle skirt.
			}

			$radius_mm = $radius_cm * 10;
			$radius_m  = $radius_cm / 100;
			$radius_in = $radius_cm / 2.54;
			$radius_ft = $radius_cm / 30.48;

			$fabric_length_cm = $length_cm + $radius_cm + 2;
			$fabric_length_mm = $fabric_length_cm * 10;
			$fabric_length_m  = $fabric_length_cm / 100;
			$fabric_length_in = $fabric_length_cm / 2.54;
			$fabric_length_ft = $fabric_length_cm / 30.48;

			$this->param['radius_cm']     	 = round($radius_cm, 2);
			$this->param['radius_mm']     	 = round($radius_mm, 2);
			$this->param['radius_m']      	 = round($radius_m, 2);
			$this->param['radius_in']     	 = round($radius_in, 2);
			$this->param['radius_ft']     	 = round($radius_ft, 2);
			$this->param['fabric_length_cm'] = round($fabric_length_cm, 2);
			$this->param['fabric_length_mm'] = round($fabric_length_mm, 2);
			$this->param['fabric_length_m']  = round($fabric_length_m, 2);
			$this->param['fabric_length_in'] = round($fabric_length_in, 2);
			$this->param['fabric_length_ft'] = round($fabric_length_ft, 2);
			$this->param['RESULT']           = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
	}

	public function square_inches($request)
	{
		$lenght = trim($request->input('length'));
		$lenght_unit = trim($request->input('l_units'));
		$width = trim($request->input('width'));
		$width_unit = trim($request->input('w_units'));
		$price = trim($request->input('price'));
		function square_to_inches($lenght, $lenght_unit)
		{
			if ($lenght_unit == "ft") {
				$inches = $lenght * 12;
			} elseif ($lenght_unit == "in") {
				$inches = $lenght * 1;
			} elseif ($lenght_unit == "yd") {
				$inches = $lenght * 36;
			} elseif ($lenght_unit == "cm") {
				$inches = $lenght / 2.54;
			} elseif ($lenght_unit == "m") {
				$inches = $lenght * 39.37;
			} elseif ($lenght_unit == "mi") {
				$inches = $lenght / 1000;
			} elseif ($lenght_unit == "km") {
				$inches = $lenght * 39370;
			}
			return $inches;
		}
		if (is_numeric($lenght) && is_numeric($width)) {
			$lenght = square_to_inches($lenght, $lenght_unit);
			$width = square_to_inches($width, $width_unit);
			$square_inches = $lenght * $width;
			if (is_numeric($price)) {
				$cost = $square_inches * $price;
				$this->param['cost'] = $cost;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['square_inches'] = $square_inches;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function gpm($request)
	{

		$volume = trim($request->input('volume'));
		$vol_unit = trim($request->input('vol_unit'));
		$time = trim($request->input('time'));
		$time_unit = trim($request->input('time_unit'));
		$ans_unit = trim($request->input('ans_unit'));

		function volume_convert($a, $b)
		{
			if ($b === "mm³") {
				$vol_ans = $a * 0.00000026417;
			} elseif ($b === "cm³") {
				$vol_ans = $a * 0.00026417;
			} elseif ($b === "dm³") {
				$vol_ans = $a * 0.26417;
			} elseif ($b === "m³") {
				$vol_ans = $a * 264.17;
			} elseif ($b === "cu in") {
				$vol_ans = $a * 0.004329;
			} elseif ($b === "cu ft") {
				$vol_ans = $a * 7.48;
			} elseif ($b === "cu yd") {
				$vol_ans = $a * 201.97;
			} elseif ($b === "ml") {
				$vol_ans = $a * 0.00026417;
			} elseif ($b === "cl") {
				$vol_ans = $a * 0.0026417;
			} elseif ($b === "liters") {
				$vol_ans = $a * 0.26417;
			} elseif ($b === "US gal") {
				$vol_ans = $a * 1;
			} elseif ($b === "UK gal") {
				$vol_ans = $a * 1.201;
			} elseif ($b === "US fl oz") {
				$vol_ans = $a * 0.007813;
			} elseif ($b === "UK fl oz") {
				$vol_ans = $a * 0.007506;
			} elseif ($b === "cups") {
				$vol_ans = $a * 0.0625;
			} elseif ($b === "tbsp") {
				$vol_ans = $a * 0.0039626;
			} elseif ($b === "tsp") {
				$vol_ans = $a * 0.0013209;
			} elseif ($b === "US qt") {
				$vol_ans = $a * 0.25;
			} elseif ($b === "UK qt") {
				$vol_ans = $a * 0.30024;
			} elseif ($b === "US pt") {
				$vol_ans = $a * 0.125;
			} elseif ($b === "UK pt") {
				$vol_ans = $a * 0.15012;
			}
			return $vol_ans;
		}
		function time_convert($a, $b)
		{
			if ($b === "sec") {
				$time_ans = $a * 1;
			} elseif ($b === "min") {
				$time_ans = $a * 60;
			} elseif ($b === "hrs") {
				$time_ans = $a * 3600;
			} elseif ($b === "days") {
				$time_ans = $a * 86400;
			} elseif ($b === "wks") {
				$time_ans = $a * 604800;
			} elseif ($b === "mos") {
				$time_ans = $a * 2629800;
			} elseif ($b === "yrs") {
				$time_ans = $a * 31557600;
			}
			return $time_ans;
		}
		function ans_convert($a, $b)
		{
			if ($b === "1") {
				$ans = $a * 1;
				$answer_unit = "US gal/s";
			} elseif ($b === "2") {
				$ans = $a * 60;
				$answer_unit = "US gal/min";
			} elseif ($b === "3") {
				$ans = $a * 3600;
				$answer_unit = "US gal/h";
			} elseif ($b === "4") {
				$ans = $a * 86400;
				$answer_unit = "US gal/day";
			} elseif ($b === "5") {
				$ans = $a * 0.8327;
				$answer_unit = "UK gal/s";
			} elseif ($b === "6") {
				$ans = $a * 49.96;
				$answer_unit = "UK gal/min";
			} elseif ($b === "7") {
				$ans = $a * 2997.6;
				$answer_unit = "UK gal/h";
			} elseif ($b === "8") {
				$ans = $a * 71943;
				$answer_unit = "UK gal/day";
			} elseif ($b === "9") {
				$ans = $a * 0.13368;
				$answer_unit = "ft³/s";
			} elseif ($b === "10") {
				$ans = $a * 8.021;
				$answer_unit = "ft³/min";
			} elseif ($b === "11") {
				$ans = $a * 481.25;
				$answer_unit = "ft³/h";
			} elseif ($b === "12") {
				$ans = $a * 11550;
				$answer_unit = "ft³/day";
			} elseif ($b === "13") {
				$ans = $a * 3785410;
				$answer_unit = "mm³/s";
			} elseif ($b === "14") {
				$ans = $a * 0.0037854;
				$answer_unit = "m³/s";
			} elseif ($b === "15") {
				$ans = $a * 0.22712;
				$answer_unit = "m³/min";
			} elseif ($b === "16") {
				$ans = $a * 13.627;
				$answer_unit = "m³/h";
			} elseif ($b === "17") {
				$ans = $a * 327.06;
				$answer_unit = "m³/day";
			} elseif ($b === "18") {
				$ans = $a * 3.7854;
				$answer_unit = "L/s";
			} elseif ($b === "19") {
				$ans = $a * 227.12;
				$answer_unit = "L/min";
			} elseif ($b === "20") {
				$ans = $a * 13627;
				$answer_unit = "L/h";
			} elseif ($b === "21") {
				$ans = $a * 327059;
				$answer_unit = "L/day";
			} elseif ($b === "22") {
				$ans = $a * 227125;
				$answer_unit = "ml/min";
			} elseif ($b === "23") {
				$ans = $a * 13627476;
				$answer_unit = "ml/h";
			} elseif ($b === "24") {
				$ans = $a * 7680;
				$answer_unit = "US fl oz / min";
			} elseif ($b === "25") {
				$ans = $a * 460800;
				$answer_unit = "US fl oz / h";
			} elseif ($b === "26") {
				$ans = $a * 7994;
				$answer_unit = "UK fl oz / min";
			} elseif ($b === "27") {
				$ans = $a * 479620;
				$answer_unit = "UK fl oz / h";
			} elseif ($b === "28") {
				$ans = $a * 480;
				$answer_unit = "US pt / min";
			} elseif ($b === "29") {
				$ans = $a * 28800;
				$answer_unit = "US pt / h";
			} elseif ($b === "30") {
				$ans = $a * 399.7;
				$answer_unit = "UK pt / min";
			} elseif ($b === "31") {
				$ans = $a * 23981;
				$answer_unit = "UK pt / h";
			}
			$jawab = $ans . "@@" . $answer_unit;
			return $jawab;
		}
		if (is_numeric($volume) && is_numeric($time)) {
			$volume = volume_convert($volume, $vol_unit);
			$time = time_convert($time, $time_unit);
			$answer = $volume / $time;
			$main_ans = ans_convert($answer, $ans_unit);
			list($answers, $answer_unit) = explode("@@", $main_ans);
		} else {
			$this->param['error'] = 'Please! Check Your Inputs';
			return $this->param;
		}
		$this->param['main_ans'] = $answers;
		$this->param['answer_unit'] = $answer_unit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function dilution($request)
	{
		$final_volume = trim($request->input('final_volume'));
		$final_unit = trim($request->input('final_unit'));
		$dilution_ratio = trim($request->input('dilution_ratio'));
		$concentrate_volume = trim($request->input('concentrate_volume'));
		$concentrate_unit = trim($request->input('concentrate_unit'));
		$water_volume = trim($request->input('water_volume'));
		$water_unit = trim($request->input('water_unit'));
		function dilutionUnit($input, $unit)
		{
			if ($unit == 'cm³') {
				$input = $input * 0.001;
			} else if ($unit == 'dm³') {
				$input = $input * 1;
			} else if ($unit == 'm³') {
				$input = $input * 1000;
			} else if ($unit == 'cuin') {
				$input = $input * 0.016387;
			} else if ($unit == 'cuft') {
				$input = $input * 28.317;
			} else if ($unit == 'cuyd') {
				$input = $input * 764.6;
			} else if ($unit == 'ml') {
				$input = $input * 0.001;
			} else if ($unit == 'cl') {
				$input = $input * 0.01;
			} else if ($unit == 'USgal') {
				$input = $input * 3.7854;
			} else if ($unit == 'UKgal') {
				$input = $input * 4.546;
			}
			return $input;
		}
		if (is_numeric($final_volume) && is_numeric($dilution_ratio) && empty($concentrate_volume) && empty($water_volume)) {
			if (isset($final_unit)) {
				$final_volume = dilutionUnit($final_volume, $final_unit);
			}

			$cv = $final_volume / ($dilution_ratio + 1);
			$wv = $cv * $dilution_ratio;
			$this->param['res1'] = round($cv, 2) . ' liters';
			$this->param['res11'] = preg_replace('/\s*liters\s*/', '', $this->param['res1']);
			$this->param['res2'] = round($wv, 2) . ' liters';
			$this->param['res22'] = preg_replace('/\s*liters\s*/', '', $this->param['res2']);
			$this->param['name1'] = 'Concentrate volume';
			$this->param['name2'] = 'Water volume';
		} else if (is_numeric($final_volume) && empty($dilution_ratio) && is_numeric($concentrate_volume) && empty($water_volume)) {
			if (isset($final_unit)) {
				$final_volume = dilutionUnit($final_volume, $final_unit);
			}
			if (isset($concentrate_unit)) {
				$concentrate_volume = dilutionUnit($concentrate_volume, $concentrate_unit);
			}

			$dr = ($final_volume / $concentrate_volume) - 1;
			$wv = $dr * $concentrate_volume;
			$this->param['res1'] = round($dr, 1) . ' :1';
			$this->param['res11'] = preg_replace('/\s*:\d+/', '', $this->param['res1']);
			$this->param['res2'] = round($wv, 2) . ' liters';
			$this->param['res22'] = preg_replace('/\s*liters\s*/', '', $this->param['res2']);
			$this->param['name1'] = 'Dilution ratio';
			$this->param['name2'] = 'Water volume';
		} else if (is_numeric($final_volume) && empty($dilution_ratio) && empty($concentrate_volume) && is_numeric($water_volume)) {
			if (isset($final_unit)) {
				$final_volume = dilutionUnit($final_volume, $final_unit);
			}
			if (isset($water_unit)) {
				$water_volume = dilutionUnit($water_volume, $water_unit);
			}

			$cv = $final_volume - $water_volume;
			if ($cv == 0) {
				$this->param['error'] = 'Please! Division by zero chose other values';
				return $this->param;
			}
			$dr = $water_volume / $cv;
			$this->param['res1'] = round($dr, 2) . ' :1';
			$this->param['res11'] = preg_replace('/\s*:\d+/', '', $this->param['res1']);
			$this->param['res2'] = round($cv, 2) . ' liters';
			$this->param['res22'] = preg_replace('/\s*liters\s*/', '', $this->param['res2']);
			$this->param['name1'] = 'Dilution ratio';
			$this->param['name2'] = 'Concentrate volume';
		} else if (empty($final_volume) && is_numeric($dilution_ratio) && is_numeric($concentrate_volume) && empty($water_volume)) {

			if (isset($concentrate_unit)) {
				$concentrate_volume = dilutionUnit($concentrate_volume, $concentrate_unit);
			}

			$fv = $concentrate_volume * ($dilution_ratio + 1);
			$wv = $concentrate_volume * $dilution_ratio;
			$this->param['res1'] = round($fv, 2) . ' liters';
			$this->param['res11'] = preg_replace('/\s*liters\s*/', '', $this->param['res1']);
			$this->param['res2'] = round($wv, 2) . ' liters';
			$this->param['res22'] = preg_replace('/\s*liters\s*/', '', $this->param['res2']);
			$this->param['name1'] = 'Final volume';
			$this->param['name2'] = 'Water volume';
		} else if (empty($final_volume) && is_numeric($dilution_ratio) && empty($concentrate_volume) && is_numeric($water_volume)) {
			if (isset($water_unit)) {
				$water_volume = dilutionUnit($water_volume, $water_unit);
			}

			if ($dilution_ratio == 0) {
				$this->param['error'] = 'Please! Division by zero, chose other values';
				return $this->param;
			}
			$cv = $water_volume / $dilution_ratio;
			$fv = $cv * ($dilution_ratio + 1);

			$this->param['res1'] = round($fv, 2) . ' liters';
			$this->param['res11'] = preg_replace('/\s*liters\s*/', '', $this->param['res1']);
			$this->param['res2'] = round($cv, 2) . ' liters';
			$this->param['res22'] = preg_replace('/\s*liters\s*/', '', $this->param['res2']);
			$this->param['name1'] = 'Final volume';
			$this->param['name2'] = 'Concentrate volume';
		} else if (empty($final_volume) && empty($dilution_ratio) && is_numeric($concentrate_volume) && is_numeric($water_volume)) {

			if (isset($concentrate_unit)) {
				$concentrate_volume = dilutionUnit($concentrate_volume, $concentrate_unit);
			}
			if (isset($water_unit)) {
				$water_volume = dilutionUnit($water_volume, $water_unit);
			}

			$dr = $water_volume / $concentrate_volume;
			$fv = $concentrate_volume * ($dr + 1);

			$this->param['res1'] = round($dr, 2) . ' :1';
			$this->param['res11'] = preg_replace('/\s*:\d+/', '', $this->param['res1']);
			$this->param['res2'] = round($fv, 2) . ' liters';
			$this->param['res22'] = preg_replace('/\s*liters\s*/', '', $this->param['res2']);
			$this->param['name1'] = 'Dilution ratio';
			$this->param['name2'] = 'Final volume';
		} else {
			$this->param['error'] = 'Please! Enter only two values to get your result';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function yards_to_tons($request)
	{
		$density = trim($request['density']);
		$density_unit = trim($request['density_unit']);
		$cubic_yards = trim($request['cubic_yards']);
		function cubic_yard($density, $density_unit)
		{
			if ($density_unit == "lb/ft³") {
				$total_cubic_yard = $density / 74.074;
			} elseif ($density_unit == "kg/m³") {
				$total_cubic_yard = $density / 1187;
			}
			return $total_cubic_yard;
		}
		if (is_numeric($density) && is_numeric($cubic_yards)) {
			$density = cubic_yard($density, $density_unit);
			$tons = $density * $cubic_yards;
			$metric_tonnes = $tons * 0.907185;
			$pounds = $metric_tonnes * 2204.62;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['tons'] = $tons;
		$this->param['metric_tonnes'] = $metric_tonnes;
		$this->param['pounds'] = $pounds;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function military_time($request)
	{
		$conversion = trim($request->input('conversion'));
		$military_time = trim($request->input('military_time'));
		$hours = trim($request->input('hours'));
		$hur = trim($request->input('hur'));
		$min = trim($request->input('min'));
		$am_pm = trim($request->input('am_pm'));
		function eng_time($num)
		{
			$reading = [
				"zero ",
				"one ",
				"two ",
				"three ",
				"four ",
				"five ",
				"six ",
				"seven ",
				"eight ",
				"nine ",
				"ten ",
				"eleven ",
				"twelve ",
				"thirteen ",
				"fourteen ",
				"fifteen ",
				"sixteen ",
				"seventeen ",
				"eighteen ",
				"nineteen ",
				"twenty ",
				"twenty-one ",
				"twenty-two ",
				"twenty-three "
			];
			$prefix = [
				2 => "twenty",
				3 => "thirty",
				4 => "forty",
				5 => "fifty"
			];
			// for hours
			$f_two = substr($num, 0, 2);
			$zain = substr($f_two, 1);
			if ($f_two <= 9) {
				$hr = "zero " . $reading[$zain];
			} else {
				if ($f_two <= 23) {
					$hr = $reading[$f_two];
				} else {
					$f_alphabet = mb_substr($f_two, 0, 1);
					$l_alphabet = mb_substr($f_two, -1, 1);
					$hr = $prefix[$f_alphabet] . "-" . $reading[$l_alphabet];
				}
			}
			// for minutes
			$l_two = substr($num, -2, 2);
			$zain2 = substr($l_two, 1);
			if ($l_two <= 9) {
				$min = "zero " . $reading[$zain2];
			} else {
				if ($l_two <= 23) {
					$min = $reading[$l_two];
				} else {
					$f_alphabet_min = mb_substr($l_two, 0, 1);
					$l_alphabet_min = mb_substr($l_two, -1, 1);
					$min = $prefix[$f_alphabet_min] . "-" . $reading[$l_alphabet_min];
				}
			}
			$jawab = $hr . $min;
			return ($jawab);
		}
		if ($conversion === "1") {
			if (is_numeric($military_time)) {
				if (((int)substr($military_time, 0, 2)) < 0 || ((int)substr($military_time, 0, 2)) >= 24 || ((int)substr($military_time, -2, 2)) < 0 || ((int)substr($military_time, -2, 2)) >= 60) {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
				$f_two = substr($military_time, 0, 2);
				$l_two = substr($military_time, -2, 2);
				// answers
				$chubees_ghante = $f_two . ":" . $l_two;
				$bara_ghante  = date("g:i a", strtotime($chubees_ghante));
				$military_time = $military_time;
				$eng_word = eng_time($military_time);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($conversion === "2") {
			if (is_numeric($hur) && is_numeric($min)) {
				if ($hours === "24h") {
					$hur = sprintf("%02d", $hur);
					$min = sprintf("%02d", $min);
					$time = $hur . $min;
					// answers
					$chubees_ghante = $hur . ":" . $min;
					$bara_ghante  = date("g:i a", strtotime($chubees_ghante));
					$military_time = $time;
					$eng_word = eng_time($military_time);
				} elseif ($hours === "12h") {
					$hur = sprintf("%02d", $hur);
					$min = sprintf("%02d", $min);
					$time = $hur . ':' . $min . ' ' . $am_pm;
					// answers
					$bara_ghante  = $time;
					$hrs_ans  = date("H", strtotime($bara_ghante));
					$min_ans  = date("i", strtotime($bara_ghante));
					$chubees_ghante = $hrs_ans . ":" . $min_ans;
					$military_time = $hrs_ans . $min_ans;
					$eng_word = eng_time($military_time);
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['bara_ghante'] = $bara_ghante;
		$this->param['chubees_ghante'] = $chubees_ghante;
		$this->param['military_time'] = $military_time;
		$this->param['eng_word'] = $eng_word;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function botox($request)
	{
		//  dd($request->all());
		$solve = $request->input('solve');
		$input_f = $request->input('input_f');
		$input_s = $request->input('input_s');
		if (is_numeric($input_f) && is_numeric($input_s)) {
			if ($solve === "1" || $solve === "2") {
				$answer = $input_f / $input_s;
			} else {
				$answer = $input_f * $input_s;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function ceiling($request)
	{
		$room_width = $request->input('room_width');
		$room_length = $request->input('room_length');
		$ceiling_height = $request->input('ceiling_height');
		if (is_numeric($room_width) && is_numeric($room_length) && is_numeric($ceiling_height)) {
			// Calculate the square footage
			$squareFootage = $room_width * $room_length;
			// Determine the recommended fan size
			if ($squareFootage <= 75) {
				$fanSize = "29 to 36 inches";
			} elseif ($squareFootage <= 144) {
				$fanSize = "36 to 42 inches";
			} elseif ($squareFootage <= 225) {
				$fanSize = "44 to 50 inches";
			} else {
				$fanSize = "52 inches or larger";
			}
			// Determine the recommended downrod length
			$downrodLength = $ceiling_height >= 9 ? "6 inches" : "3 inches";
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['fanSize'] = $fanSize;
		$this->param['downrodLength'] = $downrodLength;
		$this->param['squareFootage'] = $squareFootage;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function driving_cost($request)
	{
		$cost_of_gas = trim($request->input('cost_of_gas'));
		$miles_per_gallon = trim($request->input('miles_per_gallon'));
		$car_value = trim($request->input('car_value'));

		if (is_numeric($cost_of_gas) && is_numeric($miles_per_gallon) && is_numeric($car_value)) {


			$car_value = $car_value / 25000;
			$total_car_value = $car_value * 0.03;
			$total_cost_mile = $cost_of_gas / $miles_per_gallon;
			$answer = $total_cost_mile + $total_car_value + 0.05;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['car_value'] = $car_value;
		$this->param['total_car_value'] = $total_car_value;
		$this->param['total_cost_mile'] = $total_cost_mile;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function gold($request)
	{
		$weight = $request->input('weight');
		$cost   = $request->input('cost');
		if (is_numeric($cost) && is_numeric($weight)) {
			$GCP = $cost / $weight;
			$this->param['GCP']    = number_format($GCP, 2);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	public function moisture($request)
	{
		$wet = $request->input('wet');
		$wet_unit = $request->input('wet_unit');
		$dry = $request->input('dry');
		$dry_unit = $request->input('dry_unit');
		if (is_numeric($wet) && is_numeric($dry)) {
			if ($wet_unit === 'mg') {
				$wet = $wet / 1000000;
			} elseif ($wet_unit === 'g') {
				$wet = $wet / 1000;
			} elseif ($wet_unit === 'oz') {
				$wet = $wet / 35.27396;
			} elseif ($wet_unit === 'lb') {
				$wet = $wet / 2.204623;
			}
			if ($dry_unit === 'mg') {
				$dry = $dry / 1000000;
			} elseif ($dry_unit === 'g') {
				$dry = $dry / 1000;
			} elseif ($dry_unit === 'oz') {
				$dry = $dry / 35.27396;
			} elseif ($dry_unit === 'lb') {
				$dry = $dry / 2.204623;
			}

			$mc = ($wet - $dry) / $wet * 100;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return  $this->param;
		}
		$this->param['mc'] = $mc;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function water_bill($request)
	{
		$water = trim($request->input('water'));
		$gallon = trim($request->input('gallon'));
		if (is_numeric($water) && is_numeric($gallon)) {
			$bill = $water * $gallon;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['bill'] = $bill;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function magnification($request)
	{
		$d = $request->input('d');
		$d_unit = $request->input('d_unit');
		$f = $request->input('f');
		$f_unit = $request->input('f_unit');
		function sigFig2($value, $digits)
		{
			if ($value === 0) {
				$decimalPlaces = $digits - 1;
			} elseif ($value < 0) {
				$decimalPlaces = $digits - floor(log10($value * -1)) - 1;
			} else {
				$decimalPlaces = $digits - floor(log10($value)) - 1;
			}
			$answer = round($value, $decimalPlaces);
			return $answer;
		}

		if (is_numeric($d) && is_numeric($f)) {
			// Unit Conversion
			if ($d_unit === 'mm') {
				$d = $d / 1000;
			} elseif ($d_unit === 'cm') {
				$d = $d / 100;
			} elseif ($d_unit === 'km') {
				$d = $d / 0.001;
			} elseif ($d_unit === 'in') {
				$d = $d / 39.3701;
			} elseif ($d_unit === 'ft') {
				$d = $d / 3.28084;
			} elseif ($d_unit === 'yd') {
				$d = $d / 1.093613;
			} elseif ($d_unit === 'mi') {
				$d = $d / 0.000621371;
			} elseif ($d_unit === 'nmi') {
				$d = $d / 0.000539957;
			}
			if ($f_unit === 'mm') {
				$f = $f / 1000;
			} elseif ($f_unit === 'cm') {
				$f = $f / 100;
			} elseif ($f_unit === 'km') {
				$f = $f / 0.001;
			} elseif ($f_unit === 'in') {
				$f = $f / 39.3701;
			} elseif ($f_unit === 'ft') {
				$f = $f / 3.28084;
			} elseif ($f_unit === 'yd') {
				$f = $f / 1.093613;
			}

			$k = (pow($d, 2) / 4 - $f * $d);
			if ($k < 0) {
				$this->param['error'] = 'Oops! Something Went Wrong';
				return $this->param;
			}
			$r = sqrt($k);
			$h = ($d / 2 - $r);
			$g = ($d / 2 + $r);
			$m = ($h / $g);
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['h'] = sigFig2($h, 5);
		$this->param['g'] = sigFig2($g, 5);
		$this->param['m'] = sigFig2($m, 5);
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function engine($request)
	{
		$f_input = $request->input('f_input');
		$s_input = $request->input('s_input');
		if (is_numeric($f_input) && is_numeric($s_input)) {
			$answer = $f_input * $s_input;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function shaded($request)
	{
		$solve = $request->input('solve');
		$input = $request->input('input');
		$in_unit = $request->input('in_unit');
		function inputconvet($input, $in_unit)
		{
			if ($in_unit === 'm') {
				$d = $input * 1;
			} elseif ($in_unit === 'AU') {
				$d = $input * 1.50E+11;
			} elseif ($in_unit === 'cm') {
				$d = $input * 0.001;
			} elseif ($in_unit === 'km') {
				$d = $input * 1000;
			} elseif ($in_unit === 'in') {
				$d = $input * 0.0254;
			} elseif ($in_unit === 'ft') {
				$d = $input * 0.3048;
			} elseif ($in_unit === 'mil') {
				$d = $input * 0.0000254;
			} elseif ($in_unit === 'mm') {
				$d = $input * 0.001;
			} elseif ($in_unit === 'nm') {
				$d = $input * 1.00E-09;
			} elseif ($in_unit === 'mile') {
				$d = $input * 1609.344;
			} elseif ($in_unit === 'parsec') {
				$d = $input * 3.08E+16;
			} elseif ($in_unit === 'pm') {
				$d = $input * 1.00E-12;
			} elseif ($in_unit === 'yd') {
				$d = $input * 0.9144;
			}
			return $d;
		}
		if (is_numeric($input)) {
			$input =  inputconvet($input, $in_unit);
			list($val, $unit) = explode("@@", $solve);
			$answer = pow($input, 2) - 3.14 * pow(($input / 2), 2) * $val;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['unit'] = $unit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// sod calculator
	public function sod($request)
	{
		$method = $request->input('method');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$area = $request->input('area');
		$area_unit = $request->input('area_unit');
		$price = $request->input('price');
		function sigFig3($value, $digits)
		{
			if ($value === 0) {
				$decimalPlaces = $digits - 1;
			} elseif ($value < 0) {
				$decimalPlaces = $digits - floor(log10($value * -1)) - 1;
			} else {
				$decimalPlaces = $digits - floor(log10($value)) - 1;
			}
			$answer = round($value, $decimalPlaces);
			return $answer;
		}

		if ($method === 'lw' && is_numeric($length) && is_numeric($width)) {
			// Unit Conversion
			if (is_numeric($length)) {
				if ($length_unit === 'cm') {
					$length = $length / 30.48;
				} elseif ($length_unit === 'm') {
					$length = $length / 0.3048;
				} elseif ($length_unit === 'km') {
					$length = $length / 0.0003048;
				} elseif ($length_unit === 'in') {
					$length = $length / 12;
				} elseif ($length_unit === 'yd') {
					$length = $length / 0.33333;
				} elseif ($length_unit === 'mi') {
					$length = $length / 0.0001894;
				}
			}
			if (is_numeric($width)) {
				if ($width_unit === 'cm') {
					$width = $width / 30.48;
				} elseif ($width_unit === 'm') {
					$width = $width / 0.3048;
				} elseif ($width_unit === 'km') {
					$width = $width / 0.0003048;
				} elseif ($width_unit === 'in') {
					$width = $width / 12;
				} elseif ($width_unit === 'yd') {
					$width = $width / 0.33333;
				} elseif ($width_unit === 'mi') {
					$width = $width / 0.0001894;
				}
			}

			if ($length_unit === 'm' && $width_unit === 'm') {
				$length = $length * 0.3048;
				$width = $width * 0.3048;

				$total_area = $length * $width;
				$rolls = $total_area + 1;
				$pallets = $total_area / 40;
				$acres = $total_area * 0.0001;
				$this->param['meter'] = 'meter';
			} else {
				$total_area = $length * $width;
				$rolls = $total_area / 10;
				$pallets = $total_area / 450;
				$acres = $total_area * 0.000022957;
			}
		} elseif ($method === 'area' && is_numeric($area)) {
			// Unit Conversion
			if (is_numeric($area)) {
				if ($area_unit === 'km²') {
					$area = $area / 0.0000000929;
				} elseif ($area_unit === 'yd²') {
					$area = $area / 0.1111;
				} elseif ($area_unit === 'mi²') {
					$area = $area / 0.00000003587;
				} elseif ($area_unit === 'a') {
					$area = $area / 0.000929;
				} elseif ($area_unit === 'da') {
					$area = $area / 0.0000929;
				} elseif ($area_unit === 'ha') {
					$area = $area / 0.0001;
				} elseif ($area_unit === 'ac') {
					$area = $area / 0.000022957;
				} elseif ($area_unit === 'soccer fields') {
					$area = $area / 0.000013012;
				}
			}

			if ($area_unit === 'm²' || $area_unit === 'ha') {
				$total_area = $area;
				$rolls = $total_area;
				$pallets = $total_area / 40;
				$acres = $total_area * 0.0001;
				$this->param['meter'] = 'meter';
			} else {
				$total_area = $area;
				$rolls = $total_area / 10;
				$pallets = $total_area / 450;
				$acres = $total_area * 0.000022957;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		if (is_numeric($price)) {
			$cost = $price * $rolls;
			$cost_ft2 = $cost / $total_area;

			$this->param['cost'] = number_format($cost, 2);
			$this->param['cost_ft2'] = number_format($cost_ft2, 2);
		}

		$this->param['total_area'] = number_format($total_area);
		$this->param['rolls'] = number_format($rolls);
		$this->param['pallets'] = number_format($pallets, 2);
		$this->param['acres'] = number_format($acres, 3);
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// split-bill-calculator
	public function split()
	{
		if (isset($_POST['submit'])) {
			$bill_amount = trim($_POST['bill_amount']);
			$split = trim($_POST['split']);
		} elseif (isset($_GET['res_link'])) {
			$bill_amount = trim($_GET['bill_amount']);
			$split = trim($_GET['split']);
		}
		if (is_numeric($bill_amount) && is_numeric($split)) {
			if ($split === "0") {
				$this->param['error'] = 'number of ways to split the bill value cannot be equal to zero.';
				return $this->param;
			}
			$answer = $bill_amount / $split;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// draw length calcualtor
	public function draw($request)
	{
		$lenght = trim($request->input('length'));
		if (is_numeric($lenght)) {
			$draw = $lenght / 2.5;
			$arrow  = $draw + 1.5;
			$draw_cm  = $draw * 2.54;
			$arrow_cm  = $arrow * 2.54;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['draw'] = $draw;
		$this->param['arrow'] = $arrow;
		$this->param['draw_cm'] = $draw_cm;
		$this->param['arrow_cm'] = $arrow_cm;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// on-base-percentage-calculator
	public function on_base($request)
	{
		$hits = trim($request->input('hits'));
		$bases = trim($request->input('bases'));
		$pitch = trim($request->input('pitch'));
		$bats = trim($request->input('bats'));
		$flies = trim($request->input('flies'));
		if (is_numeric($hits) && is_numeric($bases) && is_numeric($pitch) && is_numeric($bats) && is_numeric($flies)) {
			$answer = ($hits + $bases + $pitch) / ($bats + $bases + $pitch + $flies);
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// out-the-door-price-calculator
	public function out($request)
	{
		$car = trim($request->input('car'));
		$dealership = trim($request->input('dealership'));
		$taxes = trim($request->input('taxes'));
		if (is_numeric($car) && is_numeric($dealership) && is_numeric($taxes)) {
			$answer = $car + $dealership + $taxes;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['car'] = $car;
		$this->param['dealership'] = $dealership;
		$this->param['taxes'] = $taxes;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// struggling percentage calculator
	public function slugging($request)
	{
		$singles = trim($request->input('singles'));
		$doubles = trim($request->input('doubles'));
		$triples = trim($request->input('triples'));
		$home = trim($request->input('home'));
		$bats = trim($request->input('bats'));

		if (is_numeric($singles) && is_numeric($doubles) && is_numeric($triples) && is_numeric($home) && is_numeric($bats)) {
			if ($bats === "0") {
				$this->param['error'] = 'At Bats value cannot be equal to zero';
				return $this->param;
			}
			$answer = ($singles + 2 * $doubles + 3 * $triples + 4 * $home) / $bats;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['singles'] = $singles;
		$this->param['triples'] = $triples;
		$this->param['doubles'] = $doubles;
		$this->param['home'] = $home;
		$this->param['bats'] = $bats;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// month calcualtor
	public function month($request)
	{
		$start_date = trim($request->input('start_date'));
		$end_date = trim($request->input('end_date'));
		if ($start_date !== '' && $end_date !== '') {
			$datetime1 = new Carbon($start_date);
			$datetime2 = new Carbon($end_date);
			$interval = $datetime1->diff($datetime2);
			$months = ($interval->y * 12) + $interval->m;
			$days = $interval->d;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['months'] = $months;
		$this->param['days'] = $days;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// taper calcualtor
	public function taper($request)
	{
		$major = trim($request->input('major'));
		$major_unit = trim($request->input('major_unit'));
		$minor = trim($request->input('minor'));
		$minor_unit = trim($request->input('minor_unit'));
		$length = trim($request->input('length'));
		$length_unit = trim($request->input('length_unit'));

		function taper_unit($lenght, $lenght_unit)
		{
			if ($lenght_unit == "mm") {
				$inches = $lenght / 25.4;
			} elseif ($lenght_unit == "in") {
				$inches = $lenght * 1;
			} elseif ($lenght_unit == "cm") {
				$inches = $lenght / 2.54;
			} elseif ($lenght_unit == "m") {
				$inches = $lenght * 39.37;
			} elseif ($lenght_unit == "ft") {
				$inches = $lenght / 12;
			}
			return $inches;
		}
		if (is_numeric($major) && is_numeric($minor) && is_numeric($length)) {
			$length_main = taper_unit($length, $length_unit);
			$major_main = taper_unit($major, $major_unit);
			$minor_main = taper_unit($minor, $minor_unit);
			$taper = (($major_main - $minor_main) / $length_main);
			$main = $taper * 1;
			$main_cm = $taper / 2.54;
			$main_m = $taper * 39.37;
			$main_ft = $taper / 12;
			$main_mm = $taper / 25.4;

			$sub = $main / 2;
			$sudans = atan($sub);
			$angle = rad2deg($sudans);
			$answer = $angle * 1;
			$answer_rad = deg2rad($angle);
			$answer_gon = $angle ** 1.11111;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['main'] = $main;
		$this->param['main_cm'] = $main_cm;
		$this->param['main_m'] = $main_m;
		$this->param['main_ft'] = $main_ft;
		$this->param['main_mm'] = $main_mm;
		$this->param['answer'] = $answer;
		$this->param['answer_rad'] = $answer_rad;
		$this->param['answer_gon'] = $answer_gon;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Hourly Pay Calculator
	public function hourly_pay($request)
	{
		function calculateFederalTax($income, $filingStatus, $standardDeduction)
		{
			$federalTaxBrackets = [
				'single' => [
					[0, 11000, 0.10],
					[11000, 44725, 0.12],
					[44725, 95375, 0.22],
					[95375, 182100, 0.24],
					[182100, 231250, 0.32],
					[231250, 578125, 0.35],
					[578125, PHP_INT_MAX, 0.37],
				],
				'married' => [
					[0, 22000, 0.10],
					[22000, 89450, 0.12],
					[89450, 190750, 0.22],
					[190750, 364200, 0.24],
					[364200, 462500, 0.32],
					[462500, 693750, 0.35],
					[693750, PHP_INT_MAX, 0.37],
				],
				'head_of_household' => [
					[0, 15700, 0.10],
					[15700, 59850, 0.12],
					[59850, 95350, 0.22],
					[95350, 182100, 0.24],
					[182100, 231250, 0.32],
					[231250, 578100, 0.35],
					[578100, PHP_INT_MAX, 0.37],
				],
			];
			$taxableIncome = $income - $standardDeduction;
			$tax = 0;
			if ($taxableIncome <= 0) {
				return $tax;
			}
			foreach ($federalTaxBrackets[$filingStatus] as $bracket) {
				list($lowerBound, $upperBound, $rate) = $bracket;
				if ($taxableIncome > $lowerBound) {
					$amountInBracket = min($taxableIncome, $upperBound) - $lowerBound;
					$tax += $amountInBracket * $rate;
					if ($taxableIncome <= $upperBound) {
						break;
					}
				}
			}
			return $tax;
		}
		$paytype = $request->paytype;
		$status = $request->status;
		$paidtype = $request->paidtype;
		$working = $request->working;
		$grosspay = $request->grosspay;
		$wage = $request->wage;
		$overtimeType = $request->overtimeType;
		$h_over = $request->h_over;
		$w_over = $request->w_over;
		if (!empty($paytype) && !empty($status)) {
			for ($i = 0; $i < count($paidtype); $i++) {
				if ($paidtype[$i] === "hourly") {
					if (is_numeric($working[$i]) && is_numeric($wage[$i])) {
						$weekly_salary[] = $working[$i] * $wage[$i];
						$salaries[] = $working[$i] * $wage[$i];
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} else {
					if ($grosspay[$i] === "per_year") {
						if (is_numeric($wage[$i])) {
							$weekly_salary[] = $wage[$i] / $paytype;
							$salaries[] = $wage[$i] / $paytype;
						} else {
							$this->param['error'] = 'Please! Check Your Input.';
							return $this->param;
						}
					} else {
						if (is_numeric($wage[$i])) {
							$weekly_salary[] = $wage[$i];
							$salaries[] = $wage[$i];
						} else {
							$this->param['error'] = 'Please! Check Your Input.';
							return $this->param;
						}
					}
				}
			}
			for ($j = 0; $j < count($overtimeType); $j++) {
				if (!empty($overtimeType[$j]) && is_numeric($h_over[$j]) && is_numeric($w_over[$j])) {
					if ($overtimeType[$j] === "overtime") {
						$weekly_salary[] = $h_over[$j] * $w_over[$j] * 1.5;
						$overtimes[] = $h_over[$j] * $w_over[$j] * 1.5;
					} else {
						$weekly_salary[] = $h_over[$j] * $w_over[$j] * 2;
						$overtimes[] = $h_over[$j] * $w_over[$j] * 2;
					}
				}
			}
			$total_weekly_salary = array_sum($weekly_salary);
			$annualSalary = $total_weekly_salary * $paytype;
			$medicareTax = ($annualSalary * 0.0145) / ($annualSalary / $total_weekly_salary);
			$socialSecurityTax = min($annualSalary, 160200) * 0.062;
			$socialSecurityTax = $socialSecurityTax / ($annualSalary / $total_weekly_salary);
			$standardDeduction = 13850;
			$federalTax = calculateFederalTax($annualSalary, $status, $standardDeduction);
			$federalTax = ($federalTax / ($annualSalary / $total_weekly_salary));
			if ($federalTax > 2) {
				$federalTax = $federalTax - 2;
			}
			$total_tax = $medicareTax + $socialSecurityTax + $federalTax;
			$take_home = $total_weekly_salary - $total_tax;
			$this->param['salaries'] = $salaries;
			$this->param['overtimes'] = $overtimes;
			$this->param['weekly_salary'] = $weekly_salary;
			$this->param['total_weekly_salary'] = round($total_weekly_salary, 2);
			$this->param['annualSalary'] = round($annualSalary, 2);
			$this->param['medicareTax'] = round($medicareTax, 2);
			$this->param['socialSecurityTax'] = round($socialSecurityTax);
			$this->param['federalTax'] = round($federalTax, 2);
			$this->param['total_tax'] = round($total_tax, 2);
			$this->param['take_home'] = round($take_home, 2);
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input.';
			return $this->param;
		}
	}

	// Magic Number Calculator
	public function magic($request)
	{
		$win = trim($request->input('win'));
		$loss = trim($request->input('loss'));
		if (is_numeric($win) && is_numeric($loss)) {
			$answer = 162 - $win - $loss + 1;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['win'] = $win;
		$this->param['loss'] = $loss;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Deadline Calculator
	public function deadline($request)
	{
		$date = trim($request->input('date'));
		$period = trim($request->input('period'));
		$Number = trim($request->input('Number'));
		$before_after = trim($request->input('before_after'));
		if (empty($date) || !is_numeric($Number)) {
			$this->param['error'] = 'Please check your input.';
			return $this->param;
		}

		if (!strtotime($date)) {
			$this->param['error'] = 'Invalid date format. Please use YYYY-MM-DD.';
			return $this->param;
		}

		if ($period == "Days") {
			$interval = "days";
		} elseif ($period == "Weeks") {
			$interval = "weeks";
		} elseif ($period == "Years") {
			$interval = "years";
		} else {
			$this->param['error'] = 'Invalid period. Please select Days, Weeks, or Years.';
			return $this->param;
		}

		if ($before_after == "Before") {
			$result = date("Y-m-d", strtotime("-$Number $interval", strtotime($date)));
		} else {
			$result = date("Y-m-d", strtotime("+$Number $interval", strtotime($date)));
		}


		$timestamp = strtotime($result);
		$result = date("M d, Y", $timestamp);

		$this->param['answer'] = $result;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
		working days calculator
	 *******************/
	public function working($request)
	{
		$start_date = trim($request->input('start_date'));
		$end_date = trim($request->input('end_date'));
		$working_days = trim($request->input('working_days'));
		$include_end_date = trim($request->input('include_end_date'));
		function calculateWorkingDays($start_timestamp, $end_timestamp, $working_days)
		{
			$result = 0;
			while ($start_timestamp <= $end_timestamp) {
				$current_day = date('N', $start_timestamp);

				if ($working_days == "Exclude weekends" && $current_day != 6 && $current_day != 7) {
					$result++;
				} elseif ($working_days == "Exclude only Sunday" && $current_day != 7) {
					$result++;
				} elseif ($working_days == "Include all days") {
					$result++;
				}

				$start_timestamp = strtotime('+1 day', $start_timestamp);
			}

			return $result;
		}

		if (!empty($start_date) && !empty($end_date)) {
			$start_timestamp = strtotime($start_date);
			$end_timestamp = strtotime($end_date);

			if ($start_timestamp === false || $end_timestamp === false) {
				$this->param['error'] = 'Invalid date format';
				return $this->param;
			}

			$result = 0;

			if ($working_days == "Exclude weekends") {
				$start_timestamp = strtotime($start_date);
				$end_timestamp = strtotime($end_date);
				$working_days = "Exclude weekends";
				$result = calculateWorkingDays($start_timestamp, $end_timestamp, $working_days);
			} elseif ($working_days == "Exclude only Sunday") {
				$start_timestamp = strtotime($start_date);
				$end_timestamp = strtotime($end_date);
				$working_days = "Exclude only Sunday";
				$result = calculateWorkingDays($start_timestamp, $end_timestamp, $working_days);
			} else {
				$result = ceil(($end_timestamp - $start_timestamp) / (60 * 60 * 24));
			}

			if ($include_end_date == "No") {
				$result--;
			}

			$this->param['answer'] = $result;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please provide both the starting and ending dates';
			return $this->param;
		}
	}

	/*******************
    	Driving Time Calculator
	 *******************/
	public function drive($request)
	{
		$distance = $request->input("distance");
		$distance_unit = $request->input("distance_unit");
		$average_speed = $request->input("average_speed");
		$average_speed_unit = $request->input("average_speed_unit");
		$breaks = $request->input("breaks");
		$breaks_unit = $request->input("breaks_unit");
		$departure_time = $request->input("departure_time");
		$fuel_e = $request->input("fuel_e");
		$fuel_e_unit = $request->input("fuel_e_unit");
		$fuel_p = $request->input("fuel_p");
		$currancy = $request->input("currancy");
		$fuel_p = str_replace($currancy, '', $fuel_p);
		$fuel_p_unit = $request->input("fuel_p_unit");
		$passengers = $request->input("passengers");
		if (is_numeric($distance) && is_numeric($average_speed) && is_numeric($passengers) && is_numeric($fuel_p)) {
			if (isset($breaks_unit)) {
				if ($breaks_unit == 'sec') {
					$breaks = $breaks / 60;
				} elseif ($breaks_unit == 'hrs') {
					$breaks = $breaks * 60;
				} elseif ($breaks_unit == 'days') {
					$breaks = $breaks * 24 * 60;
				} elseif ($breaks_unit == 'wks') {
					$breaks = $breaks * 10080;
				}
			}
			if (isset($distance_unit)) {
				if ($distance_unit === 'km') {
					$distance = $distance;
				} elseif ($distance_unit === 'm') {
					$distance = $distance / 1000;
				} elseif ($distance_unit === 'mi') {
					$distance = round($distance * 1.609);
				} elseif ($distance_unit === 'nmi') {
					$distance = $distance * 1.852;
				}
			}
			if (isset($average_speed_unit)) {
				if ($average_speed_unit === 'km/h') {
					$average_speed = $average_speed;
				} elseif ($average_speed_unit === 'm/s') {
					$average_speed = $average_speed * 3.6;
				} elseif ($distance_unit === 'mph') {
					$average_speed = $average_speed * 1.609;
				}
			}
			if (isset($fuel_e_unit)) {
				if ($fuel_e_unit === 'L/100km') {
					$fuel_e = $fuel_e;
				} elseif ($fuel_e_unit === 'us mpg') {
					$fuel_e = 235.215 / $fuel_e;
				} elseif ($fuel_e_unit === 'uk mpg') {
					$fuel_e = 282.5 / $fuel_e;
				} elseif ($fuel_e_unit === 'km/L') {
					$fuel_e = 100 / $fuel_e;
				}
			}
			if (isset($fuel_p_unit)) {
				if ($fuel_p_unit === '/L') {
					$fuel_p = $fuel_p;
				} elseif ($fuel_p_unit === '/us gal') {
					$fuel_p = $fuel_p * 0.26;
				} elseif ($fuel_p_unit === '/uk gal') {
					$fuel_p = $fuel_p * 0.22;
				}
			}
			// Calculate total drive time
			$total_breaks_hours = $breaks / 60;
			$total_drive_hours = ($distance / $average_speed) + $total_breaks_hours;
			// Calculate arrival time
			if (!empty($departure_time)) {
				$departure_timestamp = strtotime($departure_time);
				$arrival_timestamp = $departure_timestamp + ($total_drive_hours * 3600);
				$arrival_time = date("d F Y, h:i A", $arrival_timestamp);
				$this->param['arrival_time'] = $arrival_time;
			}
			// Calculate total drive cost
			$total_drive_cost = ($distance / 100) * $fuel_e * $fuel_p;
			// Calculate drive cost per person
			$drive_cost_per_person = $total_drive_cost / $passengers;
			$this->param['total_drive_hours'] = $total_drive_hours;
			$this->param['total_drive_cost'] = $total_drive_cost;
			$this->param['drive_cost_per_person'] = $drive_cost_per_person;
		} else {
			$this->param['error'] = 'Please ! Fill all the Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Concrete Block Calculator
	 *******************/
	public function concrete_block($request)
	{
		$width = $request->input("width");
		$height = $request->input("height");
		$width_unit = $request->input("width_unit");
		$height_unit = $request->input("height_unit");
		$block_size = $request->input("block_size");
		$block_price = $request->input("block_price");
		if (isset($height_unit)) {
			if ($height_unit == 'cm') {
				$height = $height * 0.3937;
			} else if ($height_unit == 'mm') {
				$height = $height * 0.03937;
			} else if ($height_unit == 'm') {
				$height = $height * 39.37;
			} else if ($height_unit == 'in') {
				// Already in inches
			} else if ($height_unit == 'ft') {
				$height = $height * 12;
			}
		}
		if (isset($width_unit)) {
			if ($width_unit == 'cm') {
				$width = $width * 0.3937;
			} else if ($width_unit == 'mm') {
				$width = $width * 0.03937;
			} else if ($width_unit == 'm') {
				$width = $width * 39.37;
			} else if ($width_unit == 'in') {
				// Already in inches
			} else if ($width_unit == 'ft') {
				$width = $width * 12;
			}
		}

		if (is_numeric($width) && is_numeric($height) && is_numeric($block_price)) {
			$wall_area = $width * $height;
			if ($block_size === "16x8") {
				$block_area = 16 * 8;
			} elseif ($block_size === "8x8") {
				$block_area = 8 * 8;
			} elseif ($block_size === "12x8") {
				$block_area = 12 * 8;
			} elseif ($block_size === "8x4") {
				$block_area = 4 * 8;
			} elseif ($block_size === "12x4") {
				$block_area = 12 * 4;
			} elseif ($block_size === "16x4") {
				$block_area = 16 * 4;
			}
			// Calculate the number of blocks needed
			$blocks_needed = round($wall_area / $block_area);
			// Calculate total block cost
			$total_block_cost = $blocks_needed * $block_price;
			// Calculate mortar estimation
			$mortar_estimation = ceil($blocks_needed / 100) * 3;

			$this->param['wall_area'] = $wall_area;
			$this->param['blocks_needed'] = $blocks_needed;
			$this->param['total_block_cost'] = $total_block_cost;
			$this->param['mortar_estimation'] = $mortar_estimation;
		} else {
			$this->param['error'] = 'Please check input.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
		Fabric Calculator
	 *******************/
	public function fabric($request)
	{

		$fabric = trim($request->input('fabric'));
		$fabric_unit = trim($request->input('fabric_unit'));
		$width = trim($request->input('width'));
		$width_unit = trim($request->input('width_unit'));
		$length = trim($request->input('length'));
		$length_unit = trim($request->input('length_unit'));
		$piece = trim($request->input('piece'));
		$unit = trim($request->input('unit'));
		function unit($fabric, $fabric_unit)
		{
			if ($fabric_unit == "mm") {
				$fabric = $fabric * 1000;
			} elseif ($fabric_unit == "cm") {
				$fabric = $fabric * 100;
			} elseif ($fabric_unit == "m") {
				$fabric = $fabric;
			} elseif ($fabric_unit == "km") {
				$fabric = $fabric / 1000;
			} elseif ($fabric_unit == "in") {
				$fabric = $fabric * 39.37;
			} elseif ($fabric_unit == "ft") {
				$fabric = $fabric * 3.281;
			} elseif ($fabric_unit == "yd") {
				$fabric = $fabric * 1.094;
			}
			return $fabric;
		}
		if (is_numeric($fabric) && is_numeric($width) && is_numeric($length) && is_numeric($piece)) {

			$width = unit($width, $width_unit);
			$fabric = unit($fabric, $fabric_unit);
			if ($fabric === "0") {
				$this->param['error'] = 'fabric width cannot be equal to zero';
				return $this->param;
			}
			if ($width === "0") {
				$this->param['error'] = 'pieces to cut width cannot be equal to zero';
				return $this->param;
			}
			$sub_across = $fabric / $width;
			$across = round($sub_across); //ans
			if ($across == 0) {
				$this->param['error'] = 'across value cannot be equal to zero';
				return $this->param;
			}
			$sub_down = $piece / $across;
			$down = round($sub_down); //ans

			$length = unit($length, $length_unit);

			$sub_material = $length * $down;
			$material = round($sub_material);
			$unit_material = unit($material, $unit);
			$answer = round($unit_material); //answer
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['down'] = $down;
		$this->param['across'] = $across;
		$this->param['unit'] = $unit;
		$this->param['piece'] = $piece;
		$this->param['fabric'] = $fabric;
		$this->param['width'] = $width;
		$this->param['length'] = $length;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	/*******************
		Framing Calculator
	 *******************/
	public function framing($request)
	{
		$wall = trim($request->input('wall'));
		$wall_unit = trim($request->input('wall_unit'));
		$spacing = trim($request->input('spacing'));
		$spacing_unit = trim($request->input('spacing_unit'));
		$price = trim($request->input('price'));
		$estimated = trim($request->input('estimated'));
		function framing_units($wall, $wall_unit)
		{
			if ($wall_unit === "cm") {
				$wall = $wall / 100;
			} elseif ($wall_unit === "dm") {
				$wall = $wall / 10;
			} elseif ($wall_unit === "in") {
				$wall = $wall * 0.0254;
			} elseif ($wall_unit === "ft") {
				$wall = $wall * 0.3048;
			} elseif ($wall_unit === "yd") {
				$wall = $wall * 0.9144;
			} elseif ($wall_unit !== "m") {
				$wall = $wall;
			}
			return $wall;
		}

		if ((is_numeric($wall) && is_numeric($spacing) && is_numeric($price) && is_numeric($estimated))) {
			$wall = framing_units($wall, $wall_unit);
			$spacing = framing_units($spacing, $spacing_unit);
			if ($spacing === "0") {
				$this->param['error'] = 'oc spacing cannot be equal to zero';
				return $this->param;
			}
			$answer = ($wall / $spacing) + 1; //ans
			$wastages = ($answer) * ($estimated / 100);
			$wastage = $wastages * $price;
			$studs = $price * $answer;
			$sub_answer = $studs + $wastage; //ans

		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['sub_answer'] = $sub_answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Semester Grade Calculator
	 *******************/
	public function semester($request)
	{
		$f_grade = $request->input('f_grade');
		$f_weight = $request->input('f_weight');
		$s_grade = $request->input('s_grade');
		$s_weight = $request->input('s_weight');
		$l_grade = $request->input('l_grade');
		$l_weight = $request->input('l_weight');
		if (is_numeric($f_grade) && is_numeric($f_weight)  && is_numeric($s_grade)  && is_numeric($s_weight)  && is_numeric($l_grade)  && is_numeric($l_weight)) {
			$semesterGrade = ($f_grade * $f_weight) + ($s_grade * $s_weight) + ($l_grade * $l_weight);
			$this->param['semesterGrade'] = $semesterGrade / 100;
		} else {
			$this->param['error'] = 'Please check input.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	/*******************
		Cylinder Volume Calculator
	 *******************/
	public function cylinder($request)
	{
		$f_height = $request->input('f_height');
		$f_height_units = $request->input('f_height_units');
		$f_radius = $request->input('f_radius');
		$f_radius_units = $request->input('f_radius_units');
		$s_height = $request->input('s_height');
		$s_height_units = $request->input('s_height_units');
		$external = $request->input('external');
		$external_units = $request->input('external_units');
		$internal = $request->input('internal');
		$internal_units = $request->input('internal_units');

		function convert_unit($unit, $value)
		{
			if (isset($unit)) {
				if ($unit == 'cm') {
					return $value;
				} elseif ($unit == 'mm') {
					$value /= 0.1;
				} elseif ($unit == 'm') {
					$value *= 100;
				} elseif ($unit == 'km') {
					$value *= 100000;
				} elseif ($unit == 'in') {
					$value *= 2.54;
				} elseif ($unit == 'ft') {
					$value *= 30.48;
				} elseif ($unit == 'yd') {
					$value *= 91.44;
				} elseif ($unit == 'mi') {
					$value *= 160934.4;
				}
				return $value;
			}
		}
		if (is_numeric($f_height) && is_numeric($f_radius) && is_numeric($s_height) && is_numeric($external) && is_numeric($internal)) {
			$f_height = convert_unit($f_height_units, $f_height);
			$f_radius = convert_unit($f_radius_units, $f_radius);

			$s_height = convert_unit($s_height_units, $s_height);
			$external = convert_unit($external_units, $external);
			$internal = convert_unit($internal_units, $internal);

			$vol1 = pi() * pow($f_radius, 2) * $f_height;
			$vol2 = (pi() * $s_height * (pow($external, 2) - pow($internal, 2))) / 4;

			$this->param['vol1'] = $vol1;
			$this->param['vol2'] = $vol2;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Roofing Calculator
	 *******************/
	public function roofing($request)
	{
		$length = $request->input("length");
		$length_units = $request->input("length_units");
		$width = $request->input("width");
		$width_units = $request->input("width_units");
		$pitch = $request->input("pitch");
		$price = $request->input("price");
		$price_units = $request->input("price_units");
		function conversion($unit, $value)
		{
			if (isset($unit)) {
				if ($unit == 'cm') {
					return $value / 100;
				} elseif ($unit == 'm') {
					return $value;
				} elseif ($unit == 'in') {
					return $value * 0.0254;
				} elseif ($unit == 'ft') {
					return $value * 0.3048;
				} elseif ($unit == 'yd') {
					return $value * 0.9144;
				}
			}
			return $value;
		}

		if (isset($price_units)) {
			if ($price_units == 'm²') {
				$price = $price;
			} elseif ($price_units == 'mm²') {
				$price /= 0.000001;
			} elseif ($price_units == 'cm²') {
				$price /= 0.0001;
			} elseif ($price_units == 'in²') {
				$price /= 0.00064516;
			} elseif ($price_units == 'ft²') {
				// echo "ft";die;
				$price /= 0.09290304;
			} elseif ($price_units == 'yd²') {
				$price /= 0.83612736;
			}
		}

		if (is_numeric($length) && is_numeric($width)  && is_numeric($pitch)  && is_numeric($price)) {
			$length = conversion($length_units, $length);
			$width = conversion($width_units, $width);
			$house_area = $length * $width;
			$slop = ($pitch * 12) / 100;

			$pitch_rad = atan($pitch / 100);
			$pitch_deg = rad2deg($pitch_rad);
			$roof_area = ($house_area / cos(deg2rad($pitch_deg)));
			$cost =  $roof_area * $price;
			$this->param['house_area'] = $house_area;
			$this->param['slop'] = $slop;
			$this->param['pitch_deg'] = $pitch_deg;
			$this->param['roof_area'] = $roof_area;
			$this->param['cost'] = $cost;
		} else {
			$this->param['error'] = 'Please check input.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
		Dog Food Calculator
	 *******************/
	public function dog_food($request)
	{
		$type_unit = trim($request->input('type_unit'));
		$weight = trim($request->input('weight'));
		$weight_unit = trim($request->input('weight_unit'));
		if (is_numeric($weight)) {
			if ($weight <= 0) {
				$this->param['error'] = 'body weight should be an integer greater than 0';
				return $this->param;
			}
			if ($weight_unit == "g") {
				$weight = $weight / 1000;
			} elseif ($weight_unit == "dag") {
				$weight = $weight / 100;
			} elseif ($weight_unit == "kg") {
				$weight;
			} elseif ($weight_unit == "lb") {
				$weight = $weight / 2.20462;
			}

			$RER = 70 * pow($weight, 0.75);

			if ($type_unit === 'Puppy - 0 to 4 months') {
				$factor = 3.0;
			} elseif ($type_unit === 'Puppy - 4 months to adult') {
				$factor = 2.0;
			} elseif ($type_unit == 'Dog - inactive or obese prone') {
				$factor = 1.2;
			} elseif ($type_unit == 'Dog (neutered/spayed) - average activity') {
				$factor = 1.6;
			} elseif ($type_unit == 'Dog (intact) - average activity') {
				$factor = 1.8;
			} elseif ($type_unit == 'Dog - weight loss needed') {
				$factor = 1.0;
			} elseif ($type_unit == 'Dog - weight gain needed') {
				$factor = 1.7;
			} elseif ($type_unit == 'Working dog - light work') {
				$factor = 2.0;
			} elseif ($type_unit == 'Working dog - moderate work') {
				$factor = 3.0;
			} elseif ($type_unit == 'Working dog - heavy work') {
				$factor = 5.0;
			} elseif ($type_unit == 'Senior dog') {
				$factor = 1.1;
			} else {
			}


			$answer = $RER * $factor;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Dunk Calculator
	 *******************/
	public function dunk($request)
	{
		$height = $request->input("height");
		$height_unit = $request->input("height_unit");
		$mass = $request->input("mass");
		$mass_unit = $request->input("mass_unit");
		$acceleration = $request->input("acceleration");
		$acceleration_unit = $request->input("acceleration_unit");
		$palm_size = $request->input("palm_size");
		$palm_size_unit = $request->input("palm_size_unit");
		$standing = $request->input("standing");
		$standing_unit = $request->input("standing_unit");

		function UnitConvert($unit, $value)
		{
			if (isset($unit)) {
				if ($unit == 'm') {
					return $value * 100;  // Convert centimeters to inches
				} elseif ($unit == 'in') {
					return $value * 2.54; // Convert meters to inches
				} elseif ($unit == 'ft') {
					return $value * 30.48; // Already in inches
				} elseif ($unit == 'yd') {
					return $value * 91.44; // Convert feet to inches
				} elseif ($unit == 'mm') {
					return $value * 0.1; // Convert feet to inches
				} elseif ($unit == 'km') {
					return $value * 1; // Convert feet to inches
				} elseif ($unit == 'mi') {
					return $value * 2.54; // Convert feet to inches
				} elseif ($unit == 'nmi') {
					return $value * 2.54; // Convert feet to inches
				}
			}
			return $value; // Default to the same value if unit is not recognized
		}
		function massUnitConvert($unit, $value)
		{
			if (isset($unit)) {
				if ($unit == 'g') {
					return $value * 0.001;  // Convert centimeters to inches
				} elseif ($unit == 't') {
					return $value * 1000; // Convert meters to inches
				} elseif ($unit == 'lb') {
					return $value * 0.4536; // Already in inches
				} elseif ($unit == 'st') {
					return $value * 6.35; // Convert feet to inches
				} elseif ($unit == 'US ton') {
					return $value * 907.2; // Convert feet to inches
				} elseif ($unit == 'long ton') {
					return $value * 1016; // Convert feet to inches
				} elseif ($unit == 'Earths') {
					return $value * 5972200000000000000000000; // Convert feet to inches
				}
			}
			return $value; // Default to the same value if unit is not recognized
		}

		function GravUnitConvert($unit, $value)
		{
			if (isset($unit)) {
				if ($unit == 'g') {
					return $value * 9.807;  // Convert centimeters to inches
				} elseif ($unit == 'ft/s²') {
					return $value * 0.3048; // Convert meters to inches
				}
			}
			return $value; // Default to the same value if unit is not recognized
		}

		if (is_numeric($height) && is_numeric($mass) && is_numeric($acceleration) && is_numeric($palm_size) && is_numeric($standing)) {
			$height = UnitConvert($height_unit, $height);
			$mass = massUnitConvert($mass_unit, $mass);
			$acceleration = GravUnitConvert($acceleration_unit, $acceleration);
			$palm_size = UnitConvert($palm_size_unit, $palm_size);
			$standing = UnitConvert($standing_unit, $standing);

			$minimum_vertical_leap = $height - $standing + $palm_size;
			$hang_time = round(sqrt((8 * $minimum_vertical_leap / $acceleration)) / 10, 3);
			$jumping_energy = round($mass * $acceleration * $minimum_vertical_leap / 100, 3);
			$initial_jumping_speed = round(sqrt((2 * $acceleration * $minimum_vertical_leap)) / 10, 3);
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['minimum_vertical_leap'] = $minimum_vertical_leap;
		$this->param['hang_time'] = $hang_time;
		$this->param['jumping_energy'] = $jumping_energy;
		$this->param['initial_jumping_speed'] = $initial_jumping_speed;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	CFM Calculator
	 *******************/
	public function cfm($request)
	{
		$length = $request->input("length");
		$length_units = $request->input("length_units");
		$width = $request->input("width");
		$width_units = $request->input("width_units");
		$celling = $request->input("celling");
		$celling_units = $request->input("celling_units");
		$airflow = $request->input("airflow");
		function convertToMeters($value, $unit)
		{
			if ($unit == 'm') {
				return $value;
			} elseif ($unit == 'cm') {
				return $value * 0.01;
			} elseif ($unit == 'in') {
				return $value * 0.0254;
			} elseif ($unit == 'ft') {
				return $value * 0.3048;
			} elseif ($unit == 'yd') {
				return $value * 0.9144;
			} else {
				return null;
			}
		}
		if (is_numeric($length) && is_numeric($width) && is_numeric($celling) && is_numeric($airflow)) {
			$length = convertToMeters($length, $length_units);
			$width = convertToMeters($width, $width_units);
			$celling = convertToMeters($celling, $celling_units);
			$floorArea = $length * $width;
			$volume = $floorArea * $celling;

			$airflow_rate = $volume * $airflow;
			$requiredAirFlow = ($floorArea * $celling * $airflow) / 1.7;
			$this->param['floorArea'] = $floorArea;
			$this->param['volume'] = $volume;
			$this->param['airflow_rate'] = $airflow_rate;
			$this->param['requiredAirFlow'] = $requiredAirFlow;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Box Fill Calculator
	 *******************/
	public function box($request)
	{
		$conducting_wire_size = $request->input("conducting_wire_size");
		$clamps = $request->input("clamps");
		$conducting_wire = $request->input("conducting_wire");
		$fittings = $request->input("fittings");
		$devices = $request->input("devices");
		$grounding_conductor = $request->input("grounding_conductor");
		$largest_wire_size = $request->input("largest_wire_size");
		if (is_numeric($conducting_wire) && is_numeric($devices) && is_numeric($grounding_conductor)) {
			$conductor_fill_volume = $conducting_wire * $conducting_wire_size;
			if ($clamps == 'yes') {
				$clamp_vol_allownce = 1;
				$clamp_fill_vol = $conducting_wire_size;
			} else {
				$clamp_vol_allownce = 0;
				$clamp_fill_vol = 0;
			}
			if ($fittings == 'yes') {
				$fitt_vol_allownce = 1;
				$fitt_fill_vol = $conducting_wire_size;
			} else {
				$fitt_vol_allownce = 0;
				$fitt_fill_vol = 0;
			}
			$device_vol_allownce = $devices * 2;
			$device_fill_vol = $device_vol_allownce * $conducting_wire_size;
			$grounding_fill_vol_allownce = $grounding_conductor / 4;
			$grounding_fill_vol = $largest_wire_size * $grounding_fill_vol_allownce;
			$larg_cond_wire = $grounding_conductor + $device_vol_allownce + $clamp_vol_allownce + $fitt_vol_allownce;
			$total_box_vol = $conductor_fill_volume + $clamp_fill_vol + $fitt_fill_vol + $device_fill_vol + $grounding_fill_vol;
			$total_volume_allowance_needed = $conducting_wire + $clamp_vol_allownce + $fitt_vol_allownce + $device_vol_allownce + $grounding_fill_vol_allownce;

			$this->param['conducting_wire'] = $conducting_wire;
			$this->param['conducting_wire_size'] = $conducting_wire_size;
			$this->param['conductor_fill_volume'] = $conductor_fill_volume;
			$this->param['clamp_vol_allownce'] = $clamp_vol_allownce;
			$this->param['clamp_fill_vol'] = $clamp_fill_vol;
			$this->param['fitt_vol_allownce'] = $fitt_vol_allownce;
			$this->param['fitt_fill_vol'] = $fitt_fill_vol;
			$this->param['device_vol_allownce'] = $device_vol_allownce;
			$this->param['device_fill_vol'] = $device_fill_vol;
			$this->param['grounding_fill_vol_allownce'] = $grounding_fill_vol_allownce;
			$this->param['largest_wire_size'] = $largest_wire_size;
			$this->param['grounding_fill_vol'] = $grounding_fill_vol;
			$this->param['larg_cond_wire'] = $larg_cond_wire;
			$this->param['total_volume_allowance_needed'] = $total_volume_allowance_needed;
			$this->param['total_box_vol'] = $total_box_vol;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Tonnage Calculator
	 *******************/
	public function tonnage($request)
	{
		//  dd($request->all());
		$unit_weight = $request->input("unit_weight");
		$length = $request->input("length");
		$length_units = $request->input("length_units");
		$width = $request->input("width");
		$width_units = $request->input("width_units");
		$depth = $request->input("depth");
		$depth_units = $request->input("depth_units");
		$price_per = $request->input("price_per");
		$price_per_units = $request->input("price_per_units");
		$wastage = $request->input("wastage");

		if (isset($price_per_units)) {
			if ($price_per_units === 'kg') {
				$price_per = $price_per;
			} elseif ($price_per_units === 't') {
				$price_per = $price_per * 1000;
			} elseif ($price_per_units === 'lb') {
				$price_per = $price_per * 0.453592;
			} elseif ($price_per_units === 'st') {
				$price_per = $price_per * 6.35029;
			}
		}

		function convertToM($value, $unit)
		{
			if ($unit == 'm') {
				return $value;
			} elseif ($unit == 'cm') {
				return $value * 100;
			} elseif ($unit == 'in') {
				return $value * 39.37;
			} elseif ($unit == 'ft') {
				return $value * 3.281;
			} elseif ($unit == 'yd') {
				return $value * 1.094;
			} else {
				return null;
			}
		}

		if (is_numeric($length) && is_numeric($width) && is_numeric($depth) && is_numeric($price_per) && is_numeric($wastage)) {
			$width = convertToM($width, $width_units);
			$length = convertToM($length, $length_units);
			$depth = convertToM($depth, $depth_units);
			// Calculate area
			$area = $length * $width;

			// Calculate volume
			$volume = $area * $depth;

			// Calculate tonnage
			$tonnage = round($volume * $unit_weight * 0.001, 2);

			// Calculate weight needed considering wastage
			$weight_needed = round(round($tonnage) / (1 - $wastage / 100), 2);

			// Calculate total cost
			$total_cost = round($weight_needed, 5) * $price_per;

			$this->param['area'] = $area;
			$this->param['volume'] = $volume;
			$this->param['tonnage'] = $tonnage;
			$this->param['weight_needed'] = $weight_needed;
			$this->param['total_cost'] = $total_cost;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
		Log Weight Calculator
	 *******************/
	public function log($request)
	{
		$category = $request->input('category');
		$woodSelector = $request->input('woodSelector');
		$small_end = $request->input('small_end');
		$small_unit = $request->input('small_unit');
		$large_end = $request->input('large_end');
		$large_unit = $request->input('large_unit');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$stack_w = $request->input('stack_w');
		$stackw_unit = $request->input('stackw_unit');
		$stack_h = $request->input('stack_h');
		$stackh_unit = $request->input('stackh_unit');
		$custom = $request->input('custom');
		$custom_unit = $request->input('custom_unit');
		$submit = $request->input('submit');
		$woodSelector = str_replace('@', '', $woodSelector);

		if (isset($submit)) {
			function convert_to_sm($a, $b)
			{
				if ($b == 'cm') {
					return $conver = $a * 1;
				} else if ($b == 'm') {
					return $conver = $a * 100;
				} else if ($b == 'in') {
					return $conver = $a * 2.54;
				} else if ($b == 'ft') {
					return $conver = $a * 30.48;
				} else if ($b == 'yd') {
					return $conver = $a * 91.44;
				} else if ($b == 'mm') {
					return $conver = $a * 0.1;
				}
			}
			function calculate_to_lb($aa, $b)
			{
				if ($b == 'kg') {
					$convert1 = $aa * 2.20462;
				} else if ($b == 'lb') {
					$convert1 = $aa * 1;
				} else if ($b == 'st') {
					$convert1 = $aa * 14;
				} else if ($b == 'us_tom') {
					$convert1 = $aa * 2000;
				} else if ($b == 'l_ton') {
					$convert1 = $aa * 2240;
				}
				return $convert1;
			}


			function unit_to_ft($a, $b)
			{
				if ($b == 'kg/m³') {
					$convert2 = $a * 0.062428;
				} else if ($b == 'lb/ft') {
					$convert2 = $a * 1;
				} else if ($b == 'lb/yd') {
					$convert2 = $a * 0.037037037;
				} else if ($b == 'g/cm³') {
					$convert2 = $a * 62.427961;
				} else if ($b == 'kg/cm³') {
					$convert2 = $a * 62427.960591578;
				} else if ($b == 'g/m³') {
					$convert2 = $a * 0.000062427961;
				}
				return $convert2;
			}
			if ($category == 'log') {
				if (is_numeric($small_end)) {
					// $newValue = intval($woodSelector) + 4;
					$ds = convert_to_sm($small_end, $small_unit);
					$dl = convert_to_sm($large_end, $large_unit);
					$lenth = convert_to_sm($length, $length_unit);
					$custom_val = unit_to_ft($custom, $custom_unit);
					$stack_width = convert_to_sm($stack_w, $stackw_unit);
					$stack_height = convert_to_sm($stack_h, $stackh_unit);
					// diameter of mid section
					$dm_of_mid = ($ds + $ds) / 2;
					// volume is in -- cu ft
					$volume = $lenth * ((3.14 * $dm_of_mid * $dm_of_mid) / 4) * 0.000035315;
					$volume = round($volume, 7);
					// weight is in -- lb
					if ($woodSelector === 'custom') {
						$weight = $volume * $custom_val;
					} else {
						$weight = $volume * intval($woodSelector);
					}
					// stack calculation
					$stack_width = $stack_width / $ds;
					$stack_height = $stack_height / $dl;
					$quantity_stack = $stack_width * $stack_height;
					$weight_stack = $quantity_stack * $weight;
				} else {
					$this->param['error'] = 'Please check your input';
					return $this->param;
				}
			} else if ($category == 'board') {
				if (is_numeric($small_end) && is_numeric($large_end)) {
					// $newValue = intval($woodSelector) + 4;
					$ds = convert_to_sm($small_end, $small_unit);
					$dl = convert_to_sm($large_end, $large_unit);
					$lenth = convert_to_sm($length, $length_unit);
					$custom_val = unit_to_ft($custom, $custom_unit);
					$stack_width = convert_to_sm($stack_w, $stackw_unit);
					$stack_height = convert_to_sm($stack_h, $stackh_unit);
					// diameter of mid section
					$dm_of_mid = ($ds + $ds) / 2;
					$volume = ($lenth * $ds * $dl) * 0.000035315;
					$volume = round($volume, 7);
					//weight in -- lb
					if ($woodSelector === 'custom') {
						$weight = $volume * $custom_val;
					} else {
						$weight = $volume * intval($woodSelector);
					}
					// stack calculation
					$stack_width = $stack_width / $ds;
					$stack_height = $stack_height / $dl;

					$quantity_stack = $stack_width * $stack_height;
					$weight_stack = $quantity_stack * $weight;
				} else {
					$this->param['error'] = 'Please check your input';
					return $this->param;
				}
			}
			$this->param['dm_of_mid'] = $dm_of_mid;
			$this->param['volume'] = $volume;
			$this->param['weight'] = $weight;
			$this->param['quantity_stack'] = $quantity_stack;
			$this->param['weight_stack'] = $weight_stack;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}

	/*******************
    	Anniversary Calculator
	 *******************/
	public function anniversary($request)
	{
		$date = $request->input("date");
		$current_date = $request->input("current_date");
		$one = $request->input("one");
		if ($one === 'one') {
			if (!empty($date)) {
				$anniversaryDate = date("M d, Y", strtotime("+" . (date("Y") - date("Y", strtotime($date))) . " year", strtotime($date)));
				$anniversaryDate = date("M d, Y", strtotime($anniversaryDate . " + 365 days"));
				$today = date("Y-m-d");
				$daysUntilAnniversary = floor((strtotime($anniversaryDate) - strtotime($today)) / (60 * 60 * 24));

				// Calculate marriage age
				$marriageStartDate = new Carbon($date);
				$currentDate = new Carbon($current_date);

				$marriageAge = $marriageStartDate->diff($currentDate);

				$yearsMarried = $marriageAge->y;
				$monthsMarried = ($yearsMarried * 12) + $marriageAge->m;
				$daysMarried = $marriageAge->d;
				$this->param['anniversaryDate'] = $anniversaryDate;
				$this->param['daysUntilAnniversary'] = $daysUntilAnniversary;
				$this->param['yearsMarried'] = $yearsMarried;
				$this->param['monthsMarried'] = $monthsMarried;
				$this->param['daysMarried'] = $daysMarried;
				$this->param['marriage_age_weeks'] = ceil($marriageAge->days / 7);
				$this->param['marriage_age_days'] = $marriageAge->days;
			} else {
				$this->param['error'] = 'Please! Enter the date';
				return $this->param;
			}
		} else if ($one === 'two') {
			if (!empty($date)) {
				$anniversaryDate = date("M d, Y", strtotime("+" . (date("Y") - date("Y", strtotime($date))) . " year", strtotime($date)));
				$anniversaryDate = date("M d, Y", strtotime($anniversaryDate . " + 365 days"));
				$today = date("Y-m-d");
				$daysUntilAnniversary = floor((strtotime($anniversaryDate) - strtotime($today)) / (60 * 60 * 24));

				// Calculate marriage age
				$marriageStartDate = new Carbon($date);
				$currentDate = new Carbon($current_date);
				$marriageAge = $marriageStartDate->diff($currentDate);

				$yearsMarried = $marriageAge->y;
				$monthsMarried = ($yearsMarried * 12) + $marriageAge->m;
				$daysMarried = $marriageAge->d;
				$this->param['anniversaryDate'] = $anniversaryDate;
				$this->param['daysUntilAnniversary'] = $daysUntilAnniversary;
				$this->param['yearsMarried'] = $yearsMarried;
				$this->param['monthsMarried'] = $monthsMarried;
				$this->param['daysMarried'] = $daysMarried;
				$this->param['marriage_age_weeks'] = ceil($marriageAge->days / 7);
				$this->param['marriage_age_days'] = $marriageAge->days;
			} else {
				$this->param['error'] = 'Please! Enter the date';
				return $this->param;
			}
		} else if ($one === 'three') {
			if (!empty($date)) {
				$anniversaryDate = date("M d, Y", strtotime("+" . (date("Y") - date("Y", strtotime($date))) . " year", strtotime($date)));
				$anniversaryDate = date("M d, Y", strtotime($anniversaryDate . " + 365 days"));
				$today = date("Y-m-d");
				$daysUntilAnniversary = floor((strtotime($anniversaryDate) - strtotime($today)) / (60 * 60 * 24));

				// Calculate marriage age
				$marriageStartDate = new Carbon($date);
				$currentDate = new Carbon($current_date);
				$marriageAge = $marriageStartDate->diff($currentDate);

				$yearsMarried = $marriageAge->y;
				$monthsMarried = ($yearsMarried * 12) + $marriageAge->m;
				$daysMarried = $marriageAge->d;
				$this->param['anniversaryDate'] = $anniversaryDate;
				$this->param['daysUntilAnniversary'] = $daysUntilAnniversary;
				$this->param['yearsMarried'] = $yearsMarried;
				$this->param['monthsMarried'] = $monthsMarried;
				$this->param['daysMarried'] = $daysMarried;
				$this->param['marriage_age_weeks'] = ceil($marriageAge->days / 7);
				$this->param['marriage_age_days'] = $marriageAge->days;
			} else {
				$this->param['error'] = 'Please! Enter the date';
				return $this->param;
			}
		}

		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	recessed lighting Calculator
	 *******************/
	public function recessed($request)
	{
		$a = $request->input("a");
		$b = $request->input("b");
		$columns_fixture = $request->input("columns_fixture");
		$rows_fixture = $request->input("rows_fixture");
		if (is_numeric($a) && is_numeric($b)) {
			$a_not = $a / (2 * $rows_fixture);
			$a_i = $a / $rows_fixture;
			$b_not = $b / (2 * $columns_fixture);
			$b_i = $b / $columns_fixture;
			$y_not = $a / $rows_fixture;
			$y_i = $a / $rows_fixture;
			$x_not = $b / 2;
			$x_i = $b / 2;
			$this->param['a_not'] = $a_not;
			$this->param['a_i'] = $a_i;
			$this->param['b_not'] = $b_not;
			$this->param['b_i'] = $b_i;
			$this->param['y_not'] = $y_not;
			$this->param['y_i'] = $y_i;
			$this->param['x_not'] = $x_not;
			$this->param['x_i'] = $x_i;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Distance Calculator
	public function distance($request)
	{
		// dd($request->all());
		$submit = trim($request->input('submit'));
		$lat1 = trim($request->input('lat1'));
		$long1 = trim($request->input('long1'));
		$lat2 = trim($request->input('lat2'));
		$long2 = trim($request->input('long2'));
		$deg1 = trim($request->input('deg1'));
		$mint1 = trim($request->input('mint1'));
		$sec1 = trim($request->input('sec1'));
		$dir1 = trim($request->input('dir1'));
		$deg2 = trim($request->input('deg2'));
		$mint2 = trim($request->input('mint2'));
		$sec2 = trim($request->input('sec2'));
		$dir2 = trim($request->input('dir2'));
		$deg21 = trim($request->input('deg21'));
		$mint21 = trim($request->input('mint21'));
		$sec21 = trim($request->input('sec21'));
		$dir21 = trim($request->input('dir21'));
		$dir22 = trim($request->input('dir22'));
		$deg22 = trim($request->input('deg22'));
		$mint22 = trim($request->input('mint22'));
		$sec22 = trim($request->input('sec22'));
		$dir22 = trim($request->input('dir22'));
		$to_cal = trim($request->input('to_cal'));

		function find_distance($lat1, $lon1, $lat2, $lon2)
		{
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			// dd($dist);
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			return $miles;
		}
		function ConvertDMSToDD($degrees, $minutes, $seconds, $direction)
		{
			$dd = $degrees + (int)$minutes / 60 + (int)$seconds / (60 * 60);

			if ($direction == "S" || $direction == "W") {
				$dd = $dd * -1;
			}
			return $dd;
		}
		if ($to_cal === 'decimal') {
			if ($submit) {
				$miles = find_distance($lat1, $long1, $lat2, $long2);
				$this->param['mile'] = $miles;
				$this->param['km'] = $miles * 1.609344;
				$this->param['RESULT'] = 1;
				// dd($this->param);
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else {
			if ($submit) {
				$lat1 = ConvertDMSToDD($deg1, $mint1, $sec1, $dir1);
				$long1 = ConvertDMSToDD($deg2, $mint2, $sec2, $dir2);
				$lat2 = ConvertDMSToDD($deg21, $mint21, $sec21, $dir21);
				$long2 = ConvertDMSToDD($deg22, $mint22, $sec22, $dir22);
				$miles = find_distance($lat1, $long1, $lat2, $long2);
				$this->param['mile'] = $miles;
				$this->param['km'] = $miles * 1.609344;
				$this->param['RESULT'] = 1;
				// dd($this->param);
				return  $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		}
	}

	// Asphalt Calculator
	public function asphalt($request)
	{
		$submit = $request->input('submit');
		$cal = $request->input('cal');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$area = $request->input('area');
		$area_unit = $request->input('area_unit');
		$depth = $request->input('depth');
		$depth_unit = $request->input('depth_unit');
		$volume = $request->input('volume');
		$volume_unit = $request->input('volume_unit');
		$density = $request->input('density');
		$density_unit = $request->input('density_unit');
		$cs_depth = $request->input('cs_depth');
		$cs_depth_unit = $request->input('cs_depth_unit');
		$depth_dr = $request->input('depth_dr');
		$depth_dr_unit = $request->input('depth_dr_unit');
		$cost = $request->input('cost');
		$cost_unit = $request->input('cost_unit');
		if ($submit) {
			if (is_numeric($length)) {
				if ($length_unit === 'km') {
					$length = $length / 0.001;
				} elseif ($length_unit === 'ft') {
					$length = $length / 3.281;
				} elseif ($length_unit === 'yd') {
					$length = $length / 1.0936;
				} elseif ($length_unit === 'mi') {
					$length = $length / 0.0006214;
				}
			}
			if (is_numeric($width)) {
				if ($width_unit === 'km') {
					$width = $width / 0.001;
				} elseif ($width_unit === 'ft') {
					$width = $width / 3.281;
				} elseif ($width_unit === 'yd') {
					$width = $width / 1.0936;
				} elseif ($width_unit === 'mi') {
					$width = $width / 0.0006214;
				}
			}
			if (is_numeric($area)) {
				if ($area_unit === 'km2') {
					$area = $area / 0.000001;
				} elseif ($area_unit === 'in2') {
					$area = $area / 1550;
				} elseif ($area_unit === 'ft2') {
					$area = $area / 10.764;
				}
			}
			if (is_numeric($depth)) {
				if ($depth_unit === 'mm') {
					$depth = $depth / 10;
				} elseif ($depth_unit === 'm') {
					$depth = $depth / 0.01;
				} elseif ($depth_unit === 'in') {
					$depth = $depth / 0.3937;
				} elseif ($depth_unit === 'ft') {
					$depth = $depth / 0.03281;
				}
			}
			if (is_numeric($volume)) {
				if ($volume_unit === 'cu_ft') {
					$volume = $volume / 35.315;
				} elseif ($volume_unit === 'us_gal') {
					$volume = $volume / 264.17;
				} elseif ($volume_unit === 'uk_gal') {
					$volume = $volume / 219.97;
				}
			}
			if (is_numeric($density)) {
				if ($density_unit === 'lb_cu_ft') {
					$density = $density / 0.06243;
				}
			}
			if (is_numeric($cs_depth)) {
				if ($cs_depth_unit === 'mm') {
					$cs_depth = $cs_depth / 25.4;
				} elseif ($cs_depth_unit === 'cm') {
					$cs_depth = $cs_depth / 2.54;
				} elseif ($cs_depth_unit === 'm') {
					$cs_depth = $cs_depth / 0.0254;
				} elseif ($cs_depth_unit === 'ft') {
					$cs_depth = $cs_depth / 0.08333;
				}
			}
			if (is_numeric($depth_dr)) {
				if ($cs_depth_unit === 'mm') {
					$cs_depth = $cs_depth / 25.4;
				} elseif ($cs_depth_unit === 'cm') {
					$cs_depth = $cs_depth / 2.54;
				} elseif ($cs_depth_unit === 'm') {
					$cs_depth = $cs_depth / 0.0254;
				} elseif ($cs_depth_unit === 'ft') {
					$cs_depth = $cs_depth / 0.08333;
				}
			}
			if (is_numeric($cost)) {
				if ($cost_unit === 'kg') {
					$cost = $cost * 1000;
				} elseif ($cost_unit === 'lb') {
					$cost = $cost * 2204.62;
				} elseif ($cost_unit === 'us_ton') {
					$cost = $cost * 1.10;
				} elseif ($cost_unit === 'long_ton') {
					$cost = $cost * 0.98;
				}
			}
			if ($cal === 'lwt' && is_numeric($length) && is_numeric($width) && is_numeric($depth) && is_numeric($density)) {
				$area = $length * $width;
				$volume = ($area * $depth) / 100;
				$asphalt = ($volume * $density) * 0.001;
				$kg = $asphalt * 1000;
				$lb = $asphalt * 2204.6;
				$us_ton = $asphalt * 1.1023;
				$long_ton = $asphalt * 0.9842;
				if (is_numeric($cost)) {
					$total_cost = $cost * $asphalt;
					$this->param['total_cost'] = $total_cost;
				}
				$this->param['asphalt'] = round($asphalt, 5);
				$this->param['area'] = $area;
				$this->param['volume'] = $volume;
				$this->param['kg'] = $kg;
				$this->param['lb'] = $lb;
				$this->param['us_ton'] = $us_ton;
				$this->param['long_ton'] = $long_ton;
			} elseif ($cal === 'at' && is_numeric($area) && is_numeric($depth) && is_numeric($density)) {
				$volume = ($area * $depth) / 100;
				$asphalt = ($volume * $density) * 0.001;
				$kg = $asphalt * 1000;
				$lb = $asphalt * 2204.6;
				$us_ton = $asphalt * 1.1023;
				$long_ton = $asphalt * 0.9842;
				if (is_numeric($cost)) {
					$total_cost = $cost * $asphalt;
					$this->param['total_cost'] = $total_cost;
				}
				$this->param['asphalt'] = round($asphalt, 5);
				$this->param['volume'] = $volume;
				$this->param['kg'] = $kg;
				$this->param['lb'] = $lb;
				$this->param['us_ton'] = $us_ton;
				$this->param['long_ton'] = $long_ton;
			} elseif ($cal === 'vad' && is_numeric($volume) && is_numeric($density)) {
				$asphalt = ($volume * $density) * 0.001;
				$kg = $asphalt * 1000;
				$lb = $asphalt * 2204.6;
				$us_ton = $asphalt * 1.1023;
				$long_ton = $asphalt * 0.9842;
				if (is_numeric($cost)) {
					$total_cost = $cost * $asphalt;
					$this->param['total_cost'] = $total_cost;
				}
				$this->param['asphalt'] = round($asphalt, 5);
				$this->param['kg'] = $kg;
				$this->param['lb'] = $lb;
				$this->param['us_ton'] = $us_ton;
				$this->param['long_ton'] = $long_ton;
			} elseif ($cal === 'csn' && is_numeric($area) && is_numeric($depth) && is_numeric($cs_depth)) {
				$volume = ($area * $depth) / 100;
				$asphalt = ($volume * 2400) * 0.001;
				$area = $area / 0.0929;
				$stone = ($area * $cs_depth) / 180;
				$kg = $asphalt * 1000;
				$lb = $asphalt * 2204.6;
				$us_ton = $asphalt * 1.1023;
				$long_ton = $asphalt * 0.9842;
				if (is_numeric($cost)) {
					$total_cost = $cost * $asphalt;
					$this->param['total_cost'] = $total_cost;
				}
				$this->param['asphalt'] = round($asphalt, 5);
				$this->param['stone'] = round($stone, 5);
				$this->param['kg'] = $kg;
				$this->param['lb'] = $lb;
				$this->param['us_ton'] = $us_ton;
				$this->param['long_ton'] = $long_ton;
			} elseif ($cal === 'dtbr' && is_numeric($area) && is_numeric($depth) && is_numeric($depth_dr)) {
				$volume = ($area * $depth) / 100;
				$asphalt = ($volume * $density) * 0.001;
				$area = $area / 0.0929;
				$dirt = ($area * $depth_dr) / 320;
				$kg = $asphalt * 1000;
				$lb = $asphalt * 2204.6;
				$us_ton = $asphalt * 1.1023;
				$long_ton = $asphalt * 0.9842;
				if (is_numeric($cost)) {
					$total_cost = $cost * $asphalt;
					$this->param['total_cost'] = $total_cost;
				}
				$this->param['asphalt'] = round($asphalt, 5);
				$this->param['dirt'] = round($dirt, 5);
				$this->param['kg'] = $kg;
				$this->param['lb'] = $lb;
				$this->param['us_ton'] = $us_ton;
				$this->param['long_ton'] = $long_ton;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// gravel calculator
	public function gravel($request)
	{
		$from = $request->input('from');
		$to_calculate = $request->input('to_calculate');
		$length = $request->input('length');
		$l_unit = $request->input('l_unit');
		$volume = $request->input('volume');
		$v_unit = $request->input('v_unit');
		$width = $request->input('width');
		$w_unit = $request->input('w_unit');
		$area = $request->input('area');
		$a_unit = $request->input('a_unit');
		$depth = $request->input('depth');
		$d_unit = $request->input('d_unit');
		$density = $request->input('density');
		$dn_unit = $request->input('dn_unit');
		$price = $request->input('price');
		$p_unit = $request->input('p_unit');
		$currancy = $request->input('currancy');
		$p_unit = str_replace($currancy . ' ', '', $p_unit);
		$diameter = $request->input('diameter');
		$dia_unit = $request->input('dia_unit');
		if ($from === 'rec') {
			if ($to_calculate === '1') {
				if (is_numeric($length) && is_numeric($width) && is_numeric($depth) && is_numeric($density)) {
					$length = $length;
					$width = $width;
					$depth = $depth;
					$density = $density;
					if ($l_unit === 'in') {
						$length = $length / 12;
					} elseif ($l_unit === 'yd') {
						$length = $length * 3;
					} elseif ($l_unit === 'cm') {
						$length = $length / 30.48;
					} elseif ($l_unit === 'm') {
						$length = $length * 3.28084;
					}
					if ($w_unit === 'in') {
						$width = $width / 12;
					} elseif ($w_unit === 'yd') {
						$width = $width * 3;
					} elseif ($w_unit === 'cm') {
						$width = $width / 30.48;
					} elseif ($w_unit === 'm') {
						$width = $width * 3.28084;
					}
					if ($d_unit === 'in') {
						$depth = $depth / 12;
					} elseif ($d_unit === 'yd') {
						$depth = $depth * 3;
					} elseif ($d_unit === 'cm') {
						$depth = $depth / 30.48;
					} elseif ($d_unit === 'm') {
						$depth = $depth * 3.28084;
					}
					$area = round($length * $width, 3);
					$volume = round($depth * $area, 3); //cube yards
					if ($dn_unit === 'lb/yd³') {
						$density = $density / 27;
					} elseif ($dn_unit === 't/yd³') {
						$density = $density / 74.074;
					} elseif ($dn_unit === 'kg/m³') {
						$density = $density / 16.018;
					}
					$weight = round($density * $volume, 3);
					if (!empty($price)) {
						$p_weight = $weight;
						$price = $price;
						if ($p_unit === 'kg') {
							$p_weight = $p_weight / 2.205;
						} elseif ($p_unit === 'g') {
							$p_weight = $p_weight * 453.59;
						} elseif ($p_unit === 't') {
							$p_weight = $p_weight / 2205;
						}
						// $price = round($p_weight * $price, 3);
						$this->param['price'] = round($p_weight * $price, 3);
					}
					$this->param['area'] = $area;
					$this->param['weight'] = $weight;
					$this->param['volume'] = $volume;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return  $this->param;
				}
			} elseif ($to_calculate === '2') {
				if (is_numeric($area) && is_numeric($depth) && is_numeric($density)) {
					$area = $area;
					if ($a_unit == 'm²') {
						$area = $area * 10.764;
					} elseif ($a_unit == 'yd²') {
						$area = $area * 9;
					}
					$depth = $depth;
					if ($d_unit == 'in') {
						$depth = $depth / 12;
					} elseif ($d_unit == 'yd') {
						$depth = $depth * 3;
					} elseif ($d_unit == 'cm') {
						$depth = $depth / 30.48;
					} elseif ($d_unit == 'm') {
						$depth = $depth * 3.28084;
					}
					$volume = round($depth * $area, 3); //cube yards
					$density = $density;
					if ($dn_unit == 'lb/yd³') {
						$density = $density / 27;
					} elseif ($dn_unit == 't/yd³') {
						$density = $density / 74.074;
					} elseif ($dn_unit == 'kg/m³') {
						$density = $density / 16.018;
					}
					$weight = round($density * $volume, 3);
					if (!empty($price)) {
						$p_weight = $weight;
						$price = $price;
						if ($p_unit == 'kg') {
							$p_weight = $p_weight / 2.205;
						} elseif ($p_unit == 'g') {
							$p_weight = $p_weight * 453.59;
						} elseif ($p_unit == 't') {
							$p_weight = $p_weight / 2205;
						}
						$this->param['price'] = round($p_weight * $price, 3);
						// return $result;
					}
					$this->param['area'] = $area;
					$this->param['weight'] = $weight;
					$this->param['volume'] = $volume;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return  $this->param;
				}
			} elseif ($to_calculate === '3') {
				if (is_numeric($volume) && is_numeric($density)) {
					$volume = $volume;
					if ($v_unit === 'm³') {
						$volume = $volume * 35.315;
					} elseif ($v_unit === 'yd³') {
						$volume = $volume * 27;
					}
					$density = $density;
					if ($dn_unit === 'lb/yd³') {
						$density = $density / 27;
					} elseif ($dn_unit === 't/yd³') {
						$density = $density / 74.074;
					} elseif ($dn_unit === 'kg/m³') {
						$density = $density / 16.018;
					}
					$weight = round($density * $volume, 3);
					if (!empty($price)) {
						$p_weight = $weight;
						$price = $price;
						if ($p_unit === 'kg') {
							$p_weight = $p_weight / 2.205;
						} elseif ($p_unit === 'g') {
							$p_weight = $p_weight * 453.59;
						} elseif ($p_unit === 't') {
							$p_weight = $p_weight / 2205;
						}
						$this->param['price'] = round($p_weight * $price, 3);
					}
					$this->param['weight'] = $weight;
					$this->param['volume'] = $volume;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return  $this->param;
				}
			}
		} else {
			if (is_numeric($diameter) && is_numeric($density)) {
				$diameter = $diameter;
				$depth = $depth;
				$density = $density;
				if ($dia_unit === 'in') {
					$diameter = $diameter / 12;
				} elseif ($dia_unit === 'yd') {
					$diameter = $diameter * 3;
				} elseif ($dia_unit === 'cm') {
					$diameter = $diameter / 30.48;
				} elseif ($dia_unit === 'm') {
					$diameter = $diameter * 3.28084;
				}
				if ($d_unit === 'in') {
					$depth = $depth / 12;
				} elseif ($d_unit === 'yd') {
					$depth = $depth * 3;
				} elseif ($d_unit === 'cm') {
					$depth = $depth / 30.48;
				} elseif ($d_unit === 'm') {
					$depth = $depth * 3.28084;
				}
				$area = pi() * pow(($diameter / 2), 2);
				$volume = round($depth * $area, 3); //feet cube
				if ($dn_unit === 'lb/yd³') {
					$density = $density / 27;
				} elseif ($dn_unit === 't/yd³') {
					$density = $density / 74.074;
				} elseif ($dn_unit === 'kg/m³') {
					$density = $density / 16.018;
				}
				$weight = round($density * $volume, 3);
				if (!empty($price)) {
					$p_weight = $weight;
					$price = $price;
					if ($p_unit === 'kg') {
						$p_weight = $p_weight / 2.205;
					} elseif ($p_unit === 'g') {
						$p_weight = $p_weight * 453.59;
					} elseif ($p_unit === 't') {
						$p_weight = $p_weight / 2205;
					}
					$this->param['price'] = round($p_weight * $price, 3);
					// return $result;
				}
				$this->param['area'] = $area;
				$this->param['weight'] = $weight;
				$this->param['volume'] = $volume;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		}
	}

	public function mulch($request)
	{
		if ($request->input('m-shape') === '0') {
			$length = $request->input('length');
			$length_unit = $request->input('length1');
			$width = $request->input('width');
			$width_unit = $request->input('width1');
			$area = $request->input('sqr-ft');
			$area_unit = $request->input('sqr-ft1');
			$depth = $request->input('depth');
			$depth_unit = $request->input('depth1');
			$bag_size = $request->input('bag_size');
			$bag_size1 = $request->input('bag_size1');
			$price_bag = $request->input('price_bag');
			$m_type = $request->input('m-type');
			if ($request->input('check') === 'g1_value' || $request->input('g') === 'g1') {
				if (is_numeric($length) && is_numeric($width) && is_numeric($depth)) {
					if ($length_unit === 'in') {
						$length = $length / 12;
					}
					if ($length_unit === 'yd') {
						$length = $length * 3;
					}
					if ($length_unit === 'cm') {
						$length = $length / 30.48;
					}
					if ($length_unit === 'm') {
						$length = $length * 3.281;
					}
					if ($width_unit === 'in') {
						$width = $width / 12;
					}
					if ($width_unit === 'yd') {
						$width = $width * 3;
					}
					if ($width_unit === 'cm') {
						$width = $width / 30.48;
					}
					if ($width_unit === 'm') {
						$width = $width * 3.281;
					}
					if ($depth_unit === 'ft') {
						$depth = $depth * 12;
					}
					if ($depth_unit === 'yd') {
						$depth = $depth * 36;
					}
					if ($depth_unit === 'cm') {
						$depth = $depth / 2.54;
					}
					if ($depth_unit === 'm') {
						$depth = $depth * 39.37;
					}
					$garden_size = $length * $width;
					$cubic_yards = ($length * $width * $depth) / 324;
					$cubic_ft = $cubic_yards * 27;
					$cubic_meters = $cubic_yards / 1.308;
					$liters = $cubic_meters * 1000;
					if (!empty($bag_size)) {
						if ($bag_size1 === 'c_m') {
							$bag_size = $bag_size * 35.315;
						}
						if ($bag_size1 === 'c_y') {
							$bag_size = $bag_size * 27;
						}
						if ($bag_size1 === 'lit') {
							$bag_size = $bag_size / 28.317;
						}
						$size = $cubic_ft / $bag_size;
						$this->param['size'] = round($size, 2);
						if (!empty($price_bag)) {
							$total_cost = $price_bag * $size;
							$this->param['total_cost'] = round($total_cost, 2);
						}
					}
					if ($m_type === '6') {
						$size1 = $garden_size / 235 * $depth * 2;
						$this->param['size1'] = round($size1, 2);
						if (!empty($price_bag)) {
							$total_cost1 = $price_bag * $size1;
							$this->param['total_cost1'] = round($total_cost1, 2);
						}
					}
					if ($m_type === '10') {
						$size1 = $garden_size / 235 * $depth;
						$this->param['size1'] = round($size1, 2);
						if (!empty($price_bag)) {
							$total_cost1 = $price_bag * $size1;
							$this->param['total_cost1'] = round($total_cost1, 2);
						}
					}
					$this->param['garden_size'] = round($garden_size, 2);
					$this->param['cubic_yards'] = round($cubic_yards, 2);
					$this->param['cubic_ft'] = round($cubic_ft, 2);
					$this->param['cubic_meters'] = round($cubic_meters, 2);
					$this->param['liters'] = round($liters, 2);
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return  $this->param;
				}
			} else {
				if (is_numeric($length) && is_numeric($width) && is_numeric($depth)) {
					if ($area_unit === 'acres') {
						$area = $area * 43560;
					}
					$cubic_yards = ($area * $depth) / 324;
					$cubic_ft = $cubic_yards * 27;
					$cubic_meters = $cubic_yards / 1.308;
					$liters = $cubic_meters * 1000;
					if (is_numeric($bag_size)) {
						if ($bag_size1 === 'c_m') {
							$bag_size = $bag_size * 35.315;
						}
						if ($bag_size1 === 'c_y') {
							$bag_size = $bag_size * 27;
						}
						if ($bag_size1 === 'lit') {
							$bag_size = $bag_size / 28.317;
						}
						$size = $cubic_ft / $bag_size;
						$this->param['size'] = round($size, 2);
						if (!empty($price_bag)) {
							$total_cost = $price_bag * $size;
							$this->param['total_cost'] = round($total_cost, 2);
						}
					}
					if ($m_type === '6') {
						$size1 = $area / 235 * $depth * 2;
						$this->param['size1'] = round($size1, 2);
						if (is_numeric($price_bag)) {
							$total_cost1 = $price_bag * $size1;
							$this->param['total_cost1'] = round($total_cost1, 2);
						}
					}
					if ($m_type === '10') {
						$size1 = $area / 235 * $depth;
						$this->param['size1'] = round($size1, 2);
						if (is_numeric($price_bag)) {
							$total_cost1 = $price_bag * $size1;
							$this->param['total_cost1'] = round($total_cost1, 2);
						}
					}
					$this->param['garden_size'] = round($area, 2);
					$this->param['cubic_yards'] = round($cubic_yards, 2);
					$this->param['cubic_ft'] = round($cubic_ft, 2);
					$this->param['cubic_meters'] = round($cubic_meters, 2);
					$this->param['liters'] = round($liters, 2);
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return  $this->param;
				}
			}
		} elseif ($request->input('m-shape') === '1') {
			$diameter = $request->input('diameter');
			$diameter_unit = $request->input('diameter1');
			$depth = $request->input('depth');
			$depth_unit = $request->input('depth1');
			$m_type = $request->input('m-type');
			$bag_size = $request->input('bag_size');
			$bag_size1 = $request->input('bag_size1');
			$price_bag = $request->input('price_bag');

			if (is_numeric($diameter) && is_numeric($depth)) {
				if ($diameter_unit == 'in') {
					$diameter = $diameter / 12;
				}
				if ($diameter_unit == 'yd') {
					$diameter = $diameter * 3;
				}
				if ($diameter_unit == 'cm') {
					$diameter = $diameter / 30.48;
				}
				if ($diameter_unit == 'm') {
					$diameter = $diameter * 3.281;
				}
				if ($depth_unit == 'ft') {
					$depth = $depth * 12;
				}
				if ($depth_unit == 'yd') {
					$depth = $depth * 36;
				}
				if ($depth_unit == 'cm') {
					$depth = $depth / 2.54;
				}
				if ($depth_unit == 'm') {
					$depth = $depth * 39.37;
				}
				$radius = $diameter * 0.5;
				$garden_size = ($radius * $radius) * 3.1452;
				$cubic_yards = (($depth / 12) * $garden_size) / 27;
				$cubic_ft = $cubic_yards * 27;
				$cubic_meters = $cubic_yards / 1.308;
				$liters = $cubic_meters * 1000;
				if (is_numeric($bag_size)) {
					if ($bag_size1 == 'c_m') {
						$bag_size = $bag_size * 35.315;
					}
					if ($bag_size1 == 'c_y') {
						$bag_size = $bag_size * 27;
					}
					if ($bag_size1 == 'lit') {
						$bag_size = $bag_size / 28.317;
					}
					$size = $cubic_ft / $bag_size;
					$this->param['size'] = round($size, 2);
					if (is_numeric($price_bag)) {
						$total_cost = $price_bag * $size;
						$this->param['total_cost'] = round($total_cost, 2);
					}
				}
				if ($m_type === '6') {
					$size1 = $garden_size / 235 * $depth * 2;
					$this->param['size1'] = round($size1, 2);
					if (is_numeric($price_bag)) {
						$total_cost1 = $price_bag * $size1;
						$this->param['total_cost1'] = round($total_cost1, 2);
					}
				}
				if ($m_type === '10') {
					$size1 = $garden_size / 235 * $depth;
					$this->param['size1'] = round($size1, 2);
					if (!empty($price_bag)) {
						$total_cost1 = $price_bag * $size1;
						$this->param['total_cost1'] = round($total_cost1, 2);
					}
				}
				$this->param['garden_size'] = round($garden_size);
				$this->param['cubic_yards'] = round($cubic_yards, 2);
				$this->param['cubic_ft'] = round($cubic_ft, 2);
				$this->param['cubic_meters'] = round($cubic_meters, 2);
				$this->param['liters'] = round($liters, 2);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} elseif ($request->input('m-shape') === '2') {
			$side1 = $request->input('side1');
			$side1_unit = $request->input('side11');
			$side2 = $request->input('side2');
			$side2_unit = $request->input('side21');
			$depth = $request->input('depth');
			$depth_unit = $request->input('depth1');
			$m_type = $request->input('m-type');
			$bag_size = $request->input('bag_size');
			$bag_size1 = $request->input('bag_size1');
			if (is_numeric($side1) && is_numeric($side2) && is_numeric($depth)) {
				if ($side1_unit == 'in') {
					$side1 = $side1 / 12;
				}
				if ($side1_unit == 'yd') {
					$side1 = $side1 * 3;
				}
				if ($side1_unit == 'cm') {
					$side1 = $side1 / 30.48;
				}
				if ($side1_unit == 'm') {
					$side1 = $side1 * 3.281;
				}
				if ($side2_unit == 'in') {
					$side2 = $side2 / 12;
				}
				if ($side2_unit == 'yd') {
					$side2 = $side2 * 3;
				}
				if ($side2_unit == 'cm') {
					$side2 = $side2 / 30.48;
				}
				if ($side2_unit == 'm') {
					$side2 = $side2 * 3.281;
				}
				if ($depth_unit == 'ft') {
					$depth = $depth * 12;
				}
				if ($depth_unit == 'yd') {
					$depth = $depth * 36;
				}
				if ($depth_unit == 'cm') {
					$depth = $depth / 2.54;
				}
				if ($depth_unit == 'm') {
					$depth = $depth * 39.37;
				}
				$garden_size = $side1 * $side2 * 0.5;
				$cubic_yards = (($depth / 12) * $garden_size) / 27;;
				$cubic_ft = $cubic_yards * 27;
				$cubic_meters = $cubic_yards / 1.308;
				$liters = $cubic_meters * 1000;
				if (!empty($bag_size)) {
					if ($bag_size1 == 'c_m') {
						$bag_size = $bag_size * 35.315;
					}
					if ($bag_size1 == 'c_y') {
						$bag_size = $bag_size * 27;
					}
					if ($bag_size1 == 'lit') {
						$bag_size = $bag_size / 28.317;
					}
					$size = $cubic_ft / $bag_size;
					$this->param['size'] = round($size, 2);
					if (!empty($price_bag)) {
						$total_cost = $price_bag * $size;
						$this->param['total_cost'] = round($total_cost, 2);
					}
				}
				if ($m_type == 6) {
					$size1 = $garden_size / 235 * $depth * 2;
					$this->param['size1'] = round($size1, 2);
					if (!empty($price_bag)) {
						$total_cost1 = $price_bag * $size1;
						$this->param['total_cost1'] = round($total_cost1, 2);
					}
				}
				if ($m_type == 10) {
					$size1 = $garden_size / 235 * $depth;
					$this->param['size1'] = round($size1, 2);
					if (!empty($price_bag)) {
						$total_cost1 = $price_bag * $size1;
						$this->param['total_cost1'] = round($total_cost1, 2);
					}
				}
				$this->param['garden_size'] = round($garden_size, 2);
				$this->param['cubic_yards'] = round($cubic_yards, 2);
				$this->param['cubic_ft'] = round($cubic_ft, 2);
				$this->param['cubic_meters'] = round($cubic_meters, 2);
				$this->param['liters'] = round($liters, 2);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		}
	}

	// sand calculator
	public function sand($request)
	{
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$area = $request->input('area');
		$area_unit = $request->input('area_unit');
		$depth = $request->input('depth');
		$depth_unit = $request->input('depth_unit');
		$volume = $request->input('volume');
		$volume_unit = $request->input('volume_unit');
		$density = $request->input('density');
		$density_unit = $request->input('density_unit');
		$mass_price = $request->input('mass_price');
		$mass_price_unit = $request->input('mass_price_unit');
		$volume_price = $request->input('volume_price');
		$volume_price_unit = $request->input('volume_price_unit');
		$shape = $request->input('shape');
		$g = $request->input('g');
		$diameter = $request->input('diameter');
		$diameter_unit = $request->input('diameter_unit');
		$depth = $request->input('depth');
		$depth_unit = $request->input('depth_unit');
		$c_price = $request->input('c_price');

		if ($shape === '0') {
			// Storing input values in variables
			// Method 1
			if ($g == 'g1') {
				if (is_numeric($length) && is_numeric($width) && is_numeric($depth) && is_numeric($density)) {
					// Conversion of length units in feet
					if ($length_unit === 'mm') {
						$length = $length / 305;
					}
					if ($length_unit === 'cm') {
						$length = $length / 30.48;
					}
					if ($length_unit === 'm') {
						$length = $length * 3.281;
					}
					if ($length_unit === 'in') {
						$length = $length / 12;
					}
					if ($length_unit === 'yd') {
						$length = $length * 3;
					}
					// Conversion of width units in feet
					if ($width_unit === 'mm') {
						$width = $width / 305;
					}
					if ($width_unit === 'cm') {
						$width = $width / 30.48;
					}
					if ($width_unit === 'm') {
						$width = $width * 3.281;
					}
					if ($width_unit === 'in') {
						$width = $width / 12;
					}
					if ($width_unit === 'yd') {
						$width = $width * 3;
					}
					// Conversion of depth units in feet
					if ($depth_unit === 'in') {
						$depth = $depth / 12;
					}
					if ($depth_unit === 'yd') {
						$depth = $depth * 3;
					}
					if ($depth_unit === 'cm') {
						$depth = $depth / 30.48;
					}
					if ($depth_unit === 'm') {
						$depth = $depth * 3.281;
					}
					// Conversion of density units in pound/cubic feet
					if ($density_unit === 'kg_m3') {
						$density = $density * 0.062428;
					}
					if ($density_unit === 't_m3' || $density_unit === 'g_cm3') {
						$density = $density * 62.428;
					}
					if ($density_unit === 'oz_in3') {
						$density = $density * 108;
					}
					if ($density_unit === 'lb_in3') {
						$density = $density * 1728;
					}
					if ($density_unit === 'lb_yd3') {
						$density = $density * 0.037037;
					}
					// Calculation
					$area = $length * $width;
					$volume = $area * $depth;
					$weight = $volume * $density;
					$weight = $weight * 0.000453592;
					// Conversion of volume units for display
					$mm3 = $volume * 28316847;
					$cm3 = $volume * 28316.85;
					$m3 = $volume * 0.02831685;
					$in3 = $volume * 1728;
					$yd3 = $volume * 0.037037;
					// Conversion of weight units for display
					$g = $weight * 1000000;
					$kg = $weight * 1000;
					$oz = $weight * 35273.96;
					$lb = $weight * 2204.623;
					$stone = $weight * 157.473;
					$us_ton = $weight * 1.102311;
					$long_ton = $weight * 0.984207;
					$this->param = [
						'mm3' => round($mm3, 2),
						'cm3' => round($cm3, 2),
						'm3' => round($m3, 2),
						'in3' => round($in3, 2),
						'yd3' => round($yd3, 2),
						// Sending weight units
						'g' => round($g, 2),
						'kg' => round($kg, 2),
						'oz' => round($oz, 2),
						'lb' => round($lb, 2),
						'stone' => round($stone, 2),
						'us_ton' => round($us_ton, 2),
						'long_ton' => round($long_ton, 2),
						// Sending main results
						'volume' => round($volume, 4),
						'weight' => round($weight, 4),
					];
					if (is_numeric($mass_price)) {
						if ($mass_price_unit === 'ug') {
							$mass_price = $mass_price * 1000000000000;
						}
						if ($mass_price_unit === 'mg') {
							$mass_price = $mass_price * 1000000000;
						}
						if ($mass_price_unit === 'g') {
							$mass_price = $mass_price * 1000000;
						}
						if ($mass_price_unit === 'dag') {
							$mass_price = $mass_price * 100000;
						}
						if ($mass_price_unit === 'kg') {
							$mass_price = $mass_price * 1000;
						}
						if ($mass_price_unit === 'gr') {
							$mass_price = $mass_price * 15432358.35;
						}
						if ($mass_price_unit === 'dr') {
							$mass_price = $mass_price * 564383.39;
						}
						if ($mass_price_unit === 'oz') {
							$mass_price = $mass_price * 35273.96;
						}
						if ($mass_price_unit === 'lb') {
							$mass_price = $mass_price * 2204.62;
						}
						if ($mass_price_unit === 'stone') {
							$mass_price = $mass_price * 157.47;
						}
						if ($mass_price_unit === 'us_ton') {
							$mass_price = $mass_price * 1.10;
						}
						if ($mass_price_unit === 'long_ton') {
							$mass_price = $mass_price / 0.98;
						}
						// Calculation & Sending
						$cost = $mass_price * $weight;
						$this->param['cost'] = round($cost, 2);
						// dd($result,'end');
					}
					// Conversion of volume price units in feet
					if (is_numeric($volume_price)) {
						if ($volume_price_unit === 'mm3') {
							$volume_price = $volume_price * 764554857.98;
						}
						if ($volume_price_unit === 'cm3') {
							$volume_price = $volume_price * 764554.86;
						}
						if ($volume_price_unit === 'm3') {
							$volume_price = $volume_price * 0.76;
						}
						if ($volume_price_unit === 'in3') {
							$volume_price = $volume_price * 46656;
						}
						if ($volume_price_unit === 'yd3') {
							$volume_price = $volume_price * 27;
						}
						// Calculation & Sending
						$weight = $weight / 1.22;
						$cost = $volume_price * $weight;
						$this->param['cost'] = round($cost, 2);
					}
					return $this->param;
					// dd($result,'endif');
				} else {
					$this->param['error'] = 'please check your inputs...';
					return $this->param;
				}
				// Method 2
			} elseif ($g === 'g2') {
				if (is_numeric($area) && is_numeric($depth) && is_numeric($density)) {
					// Conversion of length units in square feet
					if ($area_unit === 'mm2') {
						$area = $area * 0.0000107639;
					}
					if ($area_unit === 'cm2') {
						$area = $area * 0.00107639;
					}
					if ($area_unit === 'm2') {
						$area = $area * 10.7639;
					}
					if ($area_unit === 'in2') {
						$area = $area * 0.00694444;
					}
					if ($area_unit === 'yd2') {
						$area = $area * 9;
					}
					if ($area_unit === 'ha') {
						$area = $area * 107639;
					}
					if ($area_unit === 'ac') {
						$area = $area * 43560;
					}
					if ($area_unit === 'sf') {
						$area = $area * 76854.3;
					}
					// Conversion of depth units in feet
					if ($depth_unit === 'in') {
						$depth = $depth / 12;
					}
					if ($depth_unit === 'yd') {
						$depth = $depth * 3;
					}
					if ($depth_unit === 'cm') {
						$depth = $depth / 30.48;
					}
					if ($depth_unit === 'm') {
						$depth = $depth * 3.281;
					}
					// Conversion of density units in pound/cubic feet
					if ($density_unit === 'kg_m3') {
						$density = $density * 0.062428;
					}
					if ($density_unit === 't_m3' || $density_unit === 'g_cm3') {
						$density = $density * 62.428;
					}
					if ($density_unit === 'oz_in3') {
						$density = $density * 108;
					}
					if ($density_unit === 'lb_in3') {
						$density = $density * 1728;
					}
					if ($density_unit === 'lb_yd3') {
						$density = $density * 0.037037;
					}
					// Calculation
					$volume = $area * $depth;
					$weight = $volume * $density;
					$weight = $weight * 0.000453592;
					// Conversion of volume units for display
					$mm3 = $volume * 28316847;
					$cm3 = $volume * 28316.85;
					$m3 = $volume * 0.02831685;
					$in3 = $volume * 1728;
					$yd3 = $volume * 0.037037;
					// Conversion of weight units for display
					$g = $weight * 1000000;
					$kg = $weight * 1000;
					$oz = $weight * 35273.96;
					$lb = $weight * 2204.623;
					$stone = $weight * 157.473;
					$us_ton = $weight * 1.102311;
					$long_ton = $weight * 0.984207;
					// Sending volume units
					$this->param = [
						'mm3' => round($mm3, 2),
						'cm3' => round($cm3, 2),
						'm3' => round($m3, 2),
						'in3' => round($in3, 2),
						'yd3' => round($yd3, 2),
						// Sending weight units
						'g' => round($g, 2),
						'kg' => round($kg, 2),
						'oz' => round($oz, 2),
						'lb' => round($lb, 2),
						'stone' => round($stone, 2),
						'us_ton' => round($us_ton, 2),
						'long_ton' => round($long_ton, 2),
						// Sending main results
						'volume' => round($volume, 4),
						'weight' => round($weight, 4),
					];
					// dd($this->param);
					// Conversion of mass price units in ton
					if (is_numeric($mass_price)) {
						if ($mass_price_unit === 'ug') {
							$mass_price = $mass_price * 1000000000000;
						}
						if ($mass_price_unit === 'mg') {
							$mass_price = $mass_price * 1000000000;
						}
						if ($mass_price_unit === 'g') {
							$mass_price = $mass_price * 1000000;
						}
						if ($mass_price_unit === 'dag') {
							$mass_price = $mass_price * 100000;
						}
						if ($mass_price_unit === 'kg') {
							$mass_price = $mass_price * 1000;
						}
						if ($mass_price_unit === 'gr') {
							$mass_price = $mass_price * 15432358.35;
						}
						if ($mass_price_unit === 'dr') {
							$mass_price = $mass_price * 564383.39;
						}
						if ($mass_price_unit === 'oz') {
							$mass_price = $mass_price * 35273.96;
						}
						if ($mass_price_unit === 'lb') {
							$mass_price = $mass_price * 2204.62;
						}
						if ($mass_price_unit === 'stone') {
							$mass_price = $mass_price * 157.47;
						}
						if ($mass_price_unit === 'us_ton') {
							$mass_price = $mass_price * 1.10;
						}
						if ($mass_price_unit === 'long_ton') {
							$mass_price = $mass_price / 0.98;
						}
						// Calculation & Sending
						$cost = $mass_price * $weight;
						$this->param['cost'] = round($cost, 2);
					}
					// Conversion of volume price units in feet
					if (is_numeric($volume_price)) {
						if ($volume_price_unit === 'mm3') {
							$volume_price = $volume_price * 764554857.98;
						}
						if ($volume_price_unit === 'cm3') {
							$volume_price = $volume_price * 764554.86;
						}
						if ($volume_price_unit === 'm3') {
							$volume_price = $volume_price * 0.76;
						}
						if ($volume_price_unit === 'in3') {
							$volume_price = $volume_price * 46656;
						}
						if ($volume_price_unit === 'yd3') {
							$volume_price = $volume_price * 27;
						}
						// Calculation & Sending
						$weight = $weight / 1.22;
						$cost = $volume_price * $weight;
						$this->param['cost'] = round($cost, 2);
					}
					return $this->param;
				} else {
					$this->param['error'] = 'please check your inputs...';
					return $this->param;
				}
				// Method 3				
			} else {
				if (is_numeric($volume) && is_numeric($density)) {
					// Conversion of volume units in cubic feet
					if ($volume_unit === 'mm3') {
						$volume = $volume * 0.0000000353147;
					}
					if ($volume_unit === 'cm3') {
						$volume = $volume * 0.0000353147;
					}
					if ($volume_unit === 'm3') {
						$volume = $volume * 35.3147;
					}
					if ($volume_unit === 'in3') {
						$volume = $volume * 0.000578704;
					}
					if ($volume_unit === 'yd3') {
						$volume = $volume * 27;
					}
					// Conversion of density units in pound/cubic feet
					if ($density_unit === 'kg_m3') {
						$density = $density * 0.062428;
					}
					if ($density_unit === 't_m3' || $density_unit === 'g_cm3') {
						$density = $density * 62.428;
					}
					if ($density_unit === 'oz_in3') {
						$density = $density * 108;
					}
					if ($density_unit === 'lb_in3') {
						$density = $density * 1728;
					}
					if ($density_unit === 'lb_yd3') {
						$density = $density * 0.037037;
					}
					// Calculation
					$weight = $volume * $density;
					$weight = $weight * 0.000453592;
					// Conversion of weight units for display
					$g = $weight * 1000000;
					$kg = $weight * 1000;
					$oz = $weight * 35273.96;
					$lb = $weight * 2204.623;
					$stone = $weight * 157.473;
					$us_ton = $weight * 1.102311;
					$long_ton = $weight * 0.984207;
					$this->param = [
						'g' => round($g, 2),
						'kg' => round($kg, 2),
						'oz' => round($oz, 2),
						'lb' => round($lb, 2),
						'stone' => round($stone, 2),
						'us_ton' => round($us_ton, 2),
						'long_ton' => round($long_ton, 2),
						// Sending main results
						'weight' => round($weight, 4),
					];
					// Sending weight units
					// Conversion of mass price units in ton
					if (is_numeric($mass_price)) {
						if ($mass_price_unit === 'ug') {
							$mass_price = $mass_price * 1000000000000;
						}
						if ($mass_price_unit === 'mg') {
							$mass_price = $mass_price * 1000000000;
						}
						if ($mass_price_unit === 'g') {
							$mass_price = $mass_price * 1000000;
						}
						if ($mass_price_unit === 'dag') {
							$mass_price = $mass_price * 100000;
						}
						if ($mass_price_unit === 'kg') {
							$mass_price = $mass_price * 1000;
						}
						if ($mass_price_unit === 'gr') {
							$mass_price = $mass_price * 15432358.35;
						}
						if ($mass_price_unit === 'dr') {
							$mass_price = $mass_price * 564383.39;
						}
						if ($mass_price_unit === 'oz') {
							$mass_price = $mass_price * 35273.96;
						}
						if ($mass_price_unit === 'lb') {
							$mass_price = $mass_price * 2204.62;
						}
						if ($mass_price_unit === 'stone') {
							$mass_price = $mass_price * 157.47;
						}
						if ($mass_price_unit === 'us_ton') {
							$mass_price = $mass_price * 1.10;
						}
						if ($mass_price_unit === 'long_ton') {
							$mass_price = $mass_price / 0.98;
						}
						// Calculation & Sending
						$cost = $mass_price * $weight;
						$this->param['cost'] = round($cost, 2);
					}
					// Conversion of volume in required units
					if (!empty($volume_price)) {
						if ($volume_price_unit === 'mm3') {
							$volume = $volume * 28316847;
						}
						if ($volume_price_unit === 'cm3') {
							$volume = $volume * 28316.85;
						}
						if ($volume_price_unit === 'm3') {
							$volume = $volume * 0.02831685;
						}
						if ($volume_price_unit === 'in3') {
							$volume = $volume * 1728;
						}
						if ($volume_price_unit === 'yd3') {
							$volume = $volume * 0.037037;
						}
						// Calculation & Sending
						$cost = $volume_price * $volume;
						$this->param['cost'] = round($cost, 2);
					}
					return $this->param;
				} else {
					$this->param['error'] = 'please check your inputs...';
					return $this->param;
				}
			}
		}
		// Cirlce Shape
		if ($shape === '1') {
			// Storing input values in variables
			// Conversion of diameter units in feet
			if (is_numeric($diameter) && is_numeric($depth)) {
				if ($diameter_unit === 'in') {
					$diameter = $diameter / 12;
				}
				if ($diameter_unit === 'yd') {
					$diameter = $diameter * 3;
				}
				if ($diameter_unit === 'cm') {
					$diameter = $diameter / 30.48;
				}
				if ($diameter_unit === 'm') {
					$diameter = $diameter * 3.281;
				}
				// Conversion of depth units in feet
				if ($depth_unit === 'in') {
					$depth = $depth * 0.0833333;
				}
				if ($depth_unit === 'yd') {
					$depth = $depth * 3;
				}
				if ($depth_unit === 'cm') {
					$depth = $depth * 0.0328084;
				}
				if ($depth_unit === 'm') {
					$depth = $depth * 3.28084;
				}
				// Calculation
				$radius = $diameter / 2;
				$diameter = pi() * pow($radius, 2);
				$volume = $diameter * $depth;
				$weight = $volume * 100;
				$weight = $weight * 0.000453592;
				// Conversion of volume units for display
				$mm3 = $volume * 28316847;
				$cm3 = $volume * 28316.85;
				$m3 = $volume * 0.02831685;
				$in3 = $volume * 1728;
				$yd3 = $volume * 0.037037;
				// Conversion of weight units for display
				$g = $weight * 1000000;
				$kg = $weight * 1000;
				$oz = $weight * 35274;
				$lb = $weight * 2204.62;
				$stone = $weight * 157.473;
				$us_ton = $weight * 1.10231;
				$long_ton = $weight * 0.984207;
				// Sending volume units
				$this->param = [
					'mm3' => round($mm3, 4),
					'cm3' => round($cm3, 4),
					'm3' => round($m3, 4),
					'in3' => round($in3, 4),
					'yd3' => round($yd3, 4),
					'g' => round($g, 2),
					// Sending weight units
					'kg' => round($kg, 2),
					'oz' => round($oz, 2),
					'lb' => round($lb, 2),
					'stone' => round($stone, 2),
					'us_ton' => round($us_ton, 2),
					'long_ton' => round($long_ton, 2),
					'volume' => round($volume, 4),
					// Sending main results
					'weight' => round($weight, 4),
				];
				// dd($result);
				// Calculation of price unit
				if (!empty($c_price)) {
					$cost = $c_price * $weight;
					$this->param['cost'] = round($cost, 2);
				}
				return $this->param;
			} else {
				$this->param['error'] = 'please check your inputs...';
				return $this->param;
			}
		}
	}

	// concrete calculator
	public function concrete($request)
	{
		$operations = $request->input('operations');
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$four = $request->input('four');
		$five = $request->input('five');
		$fiveb = $request->input('fiveb');
		$quantity = $request->input('quantity');
		$units1 = $request->input('units1');
		$units2 = $request->input('units2');
		$units3 = $request->input('units3');
		$units4 = $request->input('units4');
		$units5 = $request->input('units5');
		$price_unit = $request->input('price_unit');
		$price = $request->input('price');

		function calculate_con($a, $b)
		{
			if ($b == "ft") {
				$convert = $a * 1;
			} elseif ($b == "in") {
				$convert = $a * 0.0833333;
			} elseif ($b == "yd") {
				$convert = $a * 3;
			} elseif ($b == "cm") {
				$convert = $a * 0.0328084;
			} elseif ($b == "m") {
				$convert = $a * 3.28084;
			}
			return $convert;
		}
		if ($operations == "3") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$third = calculate_con($third, $units3);
				$cubic_feet = $first * $second * $third;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$sq_val = $second / 2;
				$final_val = $sq_val * $sq_val;
				$area = 3.14 * $final_val;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$third = calculate_con($third, $units3);
				$cubic_feet = $first * $second * $third;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "6") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$third = calculate_con($third, $units3);
				$cubic_feet = $first * $second * $third;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "7") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$third = calculate_con($third, $units3);
				$cubic_feet = $first * $second * $third;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "8") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$area = 3.14 * ($second / 2) ^ 2;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "9") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($fiveb) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$third = calculate_con($third, $units3);
				$four = calculate_con($four, $units4);
				$middle = $second * $fiveb;
				$step1 = $first * $middle * $four;
				$step2 = $third * $middle * $four;
				$cubic_feet = $step1 + $step2;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		} else if ($operations == "10") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($quantity)) {
				$first = calculate_con($first, $units1);
				$second = calculate_con($second, $units2);
				$third = calculate_con($third, $units3);
				$four = calculate_con($four, $units4);
				$five = calculate_con($five, $units5);
				$mid = $second + $four;
				$step1 = $first * $mid * $five;
				$step2 = $third * $four * $five;
				$cubic_feet = $step1 + $step2;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
		}
		if (isset($quantity)) {
			$cubic_feet = $cubic_feet * $quantity;
			$cubic_yard = $cubic_yard * $quantity;
			$cubic_meter = $cubic_meter * $quantity;
		}
		if (is_numeric($price)) {
			if ($price_unit == "1") {
				$ft_price = $cubic_feet * $price;
				$ft_price = number_format($ft_price, 2);
				$this->param['ft_price'] = $ft_price;
			} else if ($price_unit == "2") {
				$yd_price = $cubic_yard * $price;
				$yd_price = number_format($yd_price, 2);
				$this->param['yd_price'] = $yd_price;
			} else if ($price_unit == "3") {
				$m_price = $cubic_meter * $price;
				$m_price = number_format($m_price, 2);
				$this->param['m_price'] = $m_price;
			}
		}
		if (is_float($cubic_feet)) {
			$cubic_feet = number_format($cubic_feet, 2);
		}
		$cubic_yard = number_format($cubic_yard, 2);
		$cubic_meter = number_format($cubic_meter, 2);
		$lb = 133 * (int)$cubic_feet;
		$kg = (int)$cubic_meter * 2130;
		$lb_40 = $lb / 40;
		$lb_40 = number_format($lb_40, 2);
		$lb_60 = $lb / 60;
		$lb_60 = number_format($lb_60, 2);
		$lb_80 = $lb / 80;
		$lb_80 = number_format($lb_80, 2);
		$kg_40 = $kg / 40;
		$kg_40 = number_format($kg_40, 2);
		$kg_60 = $kg / 60;
		$kg_60 = number_format($kg_60, 2);
		$kg_80 = $kg / 80;
		$kg_80 = number_format($kg_80, 2);
		$this->param['lb'] = $lb;
		$this->param['kg'] = $kg;
		$this->param['lb_40'] = $lb_40;
		$this->param['lb_60'] = $lb_60;
		$this->param['lb_80'] = $lb_80;
		$this->param['kg_40'] = $kg_40;
		$this->param['kg_60'] = $kg_60;
		$this->param['kg_80'] = $kg_80;
		$this->param['cubic_feet'] = $cubic_feet;
		$this->param['cubic_yard'] = $cubic_yard;
		$this->param['cubic_meter'] = $cubic_meter;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Puppy Weight calculator
	public function puppy($request)
	{
		$weight = trim($request->input('weight'));
		$weight_selection = trim($request->input('weight_selection'));
		$age = trim($request->input('age'));
		$age_selection = trim($request->input('age_selection'));
		$type = $request->input('type');
		$select_breed = $request->input('select_breed');

		function get_value($breed)
		{
			if ($breed == "Affenpinscher") {
				$assign_one = "7-10 pounds";
				$assing_two = "1";
			} else if ($breed == "Afghan Hound") {
				$assign_one = "50-60 pounds";
				$assing_two = "1";
			} else if ($breed == "Airedale Terrier") {
				$assign_one = "50-70 pounds";
				$assing_two = "1";
			} else if ($breed == "Akita") {
				$assign_one = "100-130 pounds";
				$assing_two = "70-100 pounds";
			} else if ($breed == "Alaskan Malamute") {
				$assign_one = "85 pounds";
				$assing_two = "75 pounds";
			} else if ($breed == "American Cocker Spaniel") {
				$assign_one = "45-65 pounds";
				$assing_two = "1";
			} else if ($breed == "American Eskimo Dog (toy)") {
				$assign_one = "6-10 pounds";
				$assing_two = "1";
			} else if ($breed == "American Esmiko Dog (miniature)") {
				$assign_one = "10-20 pounds";
				$assing_two = "1";
			} else if ($breed == "American Esmiko Dog") {
				$assign_one = "25-35 pounds";
				$assing_two = "1";
			} else if ($breed == "American Foxhound") {
				$assign_one = "65-70 pounds";
				$assing_two = "60-65 pounds";
			} else if ($breed == "American Hairless Terrier") {
				$assign_one = "12-16 pounds";
				$assing_two = "1";
			} else if ($breed == "American Staffordshire Terrier") {
				$assign_one = "50-70 pounds";
				$assing_two = "40-55";
			} else if ($breed == "Anatolian Shepherd Dog") {
				$assign_one = "110-150 pounds";
				$assing_two = "80-120 pounds";
			} else if ($breed == "Australian Cattle Dog") {
				$assign_one = "35-50 pounds";
				$assing_two = "1";
			} else if ($breed == "Australian Shepherd") {
				$assign_one = "50-65 pounds";
				$assing_two = "40-55 pounds";
			} else if ($breed == "Basenji") {
				$assign_one = "24 pounds";
				$assing_two = "22 pounds";
			} else if ($breed == "Basset Hound") {
				$assign_one = "40-65 pounds";
				$assing_two = "1";
			} else if ($breed == "Beagle") {
				$assign_one = "20-30 pounds";
				$assing_two = "1";
			} else if ($breed == "Bearded Collie") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Beauceron") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Belgian Shepherd") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bedlington Terrier") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Belgian Shepherd Malinois") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bernese Mountain Dog") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bichon Frise") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Black and Tan Coonhound") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Black Russian Terrier") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bloodhound") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bluetick Coonhound") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Border Collie") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Border Terrier") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Borzoi") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Boston Terrier") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Briard") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bouvier des Flandres") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Boxer") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Boykin Spaniel") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Brittany") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bull Terrier") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bulldog") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Bullmastiff") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Cairn Terrier") {
				$assign_one = "14 pounds";
				$assing_two = "13 pounds";
			} else if ($breed == "Canaan Dog") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Cane Corso") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Cavalier King Charles Spaniel") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Cesky Terrier") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Chesapeake Bay Retriever") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Chihuahua") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Chinese Crested Dog") {
				$assign_one = "8-12 pounds";
				$assing_two = "1";
			} else if ($breed == "Chinese Shar-Pei") {
				$assign_one = "45-60 pounds";
				$assing_two = "1";
			} else if ($breed == "Chinook") {
				$assign_one = "55-90 pounds";
				$assing_two = "50-65";
			} else if ($breed == "Chow Chow") {
				$assign_one = "45-70 pounds";
				$assing_two = "1";
			} else if ($breed == "Collie") {
				$assign_one = "60-75 pounds";
				$assing_two = "50-65 pounds";
			} else if ($breed == "Coton de Tulear") {
				$assign_one = "9-15 pounds";
				$assing_two = "8-13 pounds";
			} else if ($breed == "Dachshund (miniature)") {
				$assign_one = "up to 11 pounds";
				$assing_two = "1";
			} else if ($breed == "Dachshund") {
				$assign_one = "16-32 pounds";
				$assing_two = "1";
			} elseif ($breed == "Dalmatian") {
				$assign_one = "45-70 pounds";
				$assing_two = "1";
			} else if ($breed == "Dandie Dinmont Terrier") {
				$assign_one = "18-24 pounds";
				$assing_two = "1";
			} else if ($breed == "Doberman Pinscher") {
				$assign_one = "16-32 pounds";
				$assing_two = "1";
			} else if ($breed == "Dogue de Bordeaux") {
				$assign_one = "75-100 pounds";
				$assing_two = "60-90";
			} else if ($breed == "English Foxhound") {
				$assign_one = "60-75 pounds";
				$assing_two = "1";
			} else if ($breed == "English Toy Spaniel") {
				$assign_one = "8-14 pounds";
				$assing_two = "1";
			} else if ($breed == "Entlebucher Mountain Dog") {
				$assign_one = "55-65 pounds";
				$assing_two = "1";
			} else if ($breed == "Finnish Lapphund") {
				$assign_one = "33-53 pounds";
				$assing_two = "1";
			} else if ($breed == "Finnish Spitz") {
				$assign_one = "25-33 pounds";
				$assing_two = "20-28";
			} else if ($breed == "French Bulldog") {
				$assign_one = "under 28 pounds";
				$assing_two = "1";
			} else if ($breed == "German Pinscher") {
				$assign_one = "25-45 pounds";
				$assing_two = "1";
			} else if ($breed == "German Shepherd Dog") {
				$assign_one = "65-90 pounds";
				$assing_two = "50-70 pounds";
			} else if ($breed == "Giant Schnauzer") {
				$assign_one = "60-85 pounds";
				$assing_two = "55-75 pounds";
			} else if ($breed == "Glen of Imaal Terrier") {
				$assign_one = "32-40 pounds";
				$assing_two = "1";
			} elseif ($breed == "Great Dane") {
				$assign_one = "140-175 pounds";
				$assing_two = "110-140 pounds";
			} elseif ($breed == "Great Pyrenee") {
				$assign_one = "100 pounds or more";
				$assing_two = "85 pounds or more";
			} elseif ($breed == "Greater Swiss Mountain Dog") {
				$assign_one = "115-140 pounds";
				$assing_two = "85-110 pounds";
			} elseif ($breed == "Greyhound") {
				$assign_one = "65-70 pounds";
				$assing_two = "60-65 pounds";
			} elseif ($breed == "Harrier") {
				$assign_one = "45-60 pounds";
				$assing_two = "1";
			} elseif ($breed == "Havanese") {
				$assign_one = "7-13 pounds";
				$assing_two = "1";
			} elseif ($breed == "Ibizan Hound") {
				$assign_one = "50 pounds";
				$assing_two = "45 pounds";
			} elseif ($breed == "Icelandic Sheepdog") {
				$assign_one = "30 pounds";
				$assing_two = "25 pounds";
			} elseif ($breed == "Irish Terrier") {
				$assign_one = "27 pounds";
				$assing_two = "25 pounds";
			} else if ($breed == "Irish Wolfhound") {
				$assign_one = "120 pounds";
				$assing_two = "105 pounds";
			} else if ($breed == "Italian Greyhound") {
				$assign_one = "7-14 pounds";
				$assing_two = "1";
			} else if ($breed == "Japanese Chin") {
				$assign_one = "7-11 pounds";
				$assing_two = "1";
			} else if ($breed == "Keeshonden") {
				$assign_one = "34-45 pounds";
				$assing_two = "1";
			} else if ($breed == "Kerry Blue Terrier") {
				$assign_one = "33-40 pounds";
				$assing_two = "30-37 pounds";
			} else if ($breed == "Komondorok") {
				$assign_one = "100 pounds or more";
				$assing_two = "30-37 pounds";
			} else if ($breed == "Kuvaszok") {
				$assign_one = "100-115 pounds";
				$assing_two = "70-90 pounds";
			} else if ($breed == "Lagottto Romagnoli") {
				$assign_one = "28.5-35 pounds";
				$assing_two = "24-31 pounds";
			} else if ($breed == "Lakeland Terrier") {
				$assign_one = "17 pounds";
				$assing_two = "16 pounds";
			} else if ($breed == "Leonberger") {
				$assign_one = "110-170 pounds";
				$assing_two = "90-140 pounds";
			} else if ($breed == "Lhasa Apso") {
				$assign_one = "12-18 pounds";
				$assing_two = "1";
			} else if ($breed == "Lowchen") {
				$assign_one = "15 pounds";
				$assing_two = "1";
			} else if ($breed == "Maltese") {
				$assign_one = "under 7 pounds";
				$assing_two = "1";
			} else if ($breed == "Manchester Terrier (Toy)") {
				$assign_one = "under 7 pounds";
				$assing_two = "1";
			} else if ($breed == "Manchester Terrier") {
				$assign_one = "12-22 pounds";
				$assing_two = "1";
			} else if ($breed == "Mastiff") {
				$assign_one = "160-230 pounds";
				$assing_two = "120-170 pounds";
			} else if ($breed == "Miniature Pinscher") {
				$assign_one = "8-10 pounds";
				$assing_two = "1";
			} else if ($breed == "Miniature Bull Terrier") {
				$assign_one = "18-28 pounds";
				$assing_two = "1";
			} else if ($breed == "Miniature Schnauzer") {
				$assign_one = "11-20 pounds";
				$assing_two = "1";
			} else if ($breed == "Neapolitan Mastiff") {
				$assign_one = "150 pounds";
				$assing_two = "110 pounds";
			} else if ($breed == "Newfoundland") {
				$assign_one = "130-150 pounds";
				$assing_two = "100-120 pounds";
			} else if ($breed == "Norfolk Terrier") {
				$assign_one = "11-12 pounds";
				$assing_two = "1";
			} else if ($breed == "Norwegian Buhund") {
				$assign_one = "31-40 pounds";
				$assing_two = "26-35 pounds";
			} else if ($breed == "Norwegian Elkhound") {
				$assign_one = "55 pounds";
				$assing_two = "48 pounds";
			} else if ($breed == "Norwegian Lundehund") {
				$assign_one = "20-30 pounds";
				$assing_two = "1";
			} else if ($breed == "Norwich Terrier") {
				$assign_one = "12 pounds";
				$assing_two = "1";
			} else if ($breed == "Old English Sheepdog") {
				$assign_one = "60-100 pounds";
				$assing_two = "1";
			} else if ($breed == "Otterhound") {
				$assign_one = "115 pounds";
				$assing_two = "80 pounds";
			} else if ($breed == "Papillon") {
				$assign_one = "5-10 pounds";
				$assing_two = "1";
			} else if ($breed == "Parson Russell Terrier") {
				$assign_one = "13-17 pounds";
				$assing_two = "1";
			} else if ($breed == "Pekingese") {
				$assign_one = "up to 14 pounds";
				$assing_two = "1";
			} else if ($breed == "Pembroke Welsh Corgi") {
				$assign_one = "up to 30 pounds";
				$assing_two = "up to 28 pounds";
			} else if ($breed == "Petit Basset Griffon Vendeen") {
				$assign_one = "25-40 pounds";
				$assing_two = "1";
			} else if ($breed == "Pharaoh Hound") {
				$assign_one = "45-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Plott") {
				$assign_one = "50-60 pounds";
				$assing_two = "40-55 pounds";
			} else if ($breed == "Polish Lowland Sheepdog") {
				$assign_one = "30-50 pounds";
				$assing_two = "1";
			} else if ($breed == "Pomeranian") {
				$assign_one = "3-7 pounds";
				$assign_two = "1";
			} else if ($breed == "Poodle") {
				$assign_one = "60-70 pounds";
				$assign_two = "40-50";
			} else if ($breed == "Portuguese Water Dog") {
				$assign_one = "60-70 pounds";
				$assign_two = "40-50";
			} else if ($breed == "Pug") {
				$assign_one = "42-60 pounds";
				$assign_two = "35-50 pounds";
			} else if ($breed == "Pulik") {
				$assign_one = "25-35 pounds";
				$assing_two = "1";
			} else if ($breed == "Redbone Coonhound") {
				$assign_one = "25-35 pounds";
				$assing_two = "1";
			} else if ($breed == "Retreiver (Chesapeake Bay)") {
				$assign_one = "65-80 pounds";
				$assing_two = "55-70 pounds";
			} else if ($breed == "Retreiver (Curly Coated)") {
				$assign_one = "60-95 pounds";
				$assing_two = "1 pounds";
			} else if ($breed == "Retreiver (Flat Coated)") {
				$assign_one = "60-70 pounds";
				$assing_two = "1";
			} else if ($breed == "Retreiver (Golden)") {
				$assign_one = "65-75 pounds";
				$assing_two = "55-65 pounds";
			} else if ($breed == "Retreiver (Labrador)") {
				$assign_one = "65-80 pounds";
				$assing_two = "55-70 pounds";
			} else if ($breed == "Rhodesian Ridgeback") {
				$assign_one = "85 pounds";
				$assing_two = "70 pounds";
			} else if ($breed == "Rottweiler") {
				$assign_one = "95-135 pounds";
				$assing_two = "80-100 pounds";
			} else if ($breed == "Russel Terrier") {
				$assign_one = "9-15 pounds";
				$assing_two = "1";
			} else if ($breed == "Saluki") {
				$assign_one = "40-65 pounds";
				$assing_two = "1";
			} else if ($breed == "Samoyed") {
				$assign_one = "45-65 pounds";
				$assing_two = "35-50 pounds";
			} else if ($breed == "Schipperke") {
				$assign_one = "10-16 pounds";
				$assing_two = "1";
			} else if ($breed == "Scottish Deerhound") {
				$assign_one = "85-110 pounds";
				$assing_two = "75-95";
			} else if ($breed == "Scottish Terrier") {
				$assign_one = "19-22 pounds";
				$assing_two = "18-21 pounds";
			} else if ($breed == "Sealyham Terrier") {
				$assign_one = "23-24 pounds";
				$assing_two = "20-23 pounds";
			} else if ($breed == "Setter (English)") {
				$assign_one = "65-80 pounds";
				$assing_two = "45-55 pounds";
			} else if ($breed == "Setter (Gordon)") {
				$assign_one = "55-80 pounds";
				$assing_two = "45-70 pounds";
			} else if ($breed == "Setter (Irish Red and White)") {
				$assign_one = "42-60 pounds";
				$assing_two = "35-50 pounds";
			} else if ($breed == "Setter (Irish)") {
				$assign_one = "70 pounds";
				$assing_two = "60 pounds";
			} else if ($breed == "Shedland Sheepdog") {
				$assign_one = "15-25 pounds";
				$assing_two = "1";
			} else if ($breed == "Shiba Inu") {
				$assign_one = "23 pounds";
				$assing_two = "17 pounds";
			} else if ($breed == "Shih Tzu") {
				$assign_one = "9-16 pounds";
				$assing_two = "1";
			} else if ($breed == "Siberian Huskie") {
				$assign_one = "45-60 pounds";
				$assing_two = "35-50 pounds";
			} else if ($breed == "Silky Terrier") {
				$assign_one = "8-10 pounds";
				$assing_two = "1";
			} else if ($breed == "Syke Terrier") {
				$assign_one = "35-45 pounds";
				$assing_two = "30-40 pounds";
			} else if ($breed == "Sloughi") {
				$assign_one = "35-50 pounds";
				$assing_two = "1";
			} else if ($breed == "Soft Coated Wheaten Terrier") {
				$assign_one = "35-50 pounds";
				$assing_two = "1";
			} else if ($breed == "Spaniel (American Water)") {
				$assign_one = "35-40 pounds";
				$assing_two = "30-35 pounds";
			} else if ($breed == "Spaniel (Boykin)") {
				$assign_one = "30-40 pounds";
				$assing_two = "25-35 pounds";
			} else if ($breed == "Spaniel (Clumber)") {
				$assign_one = "70-85 pounds";
				$assing_two = "55-70 pounds";
			} else if ($breed == "Spaniel (English Cocker)") {
				$assign_one = "28-34 pounds";
				$assing_two = "26-32 pounds";
			} else if ($breed == "Spaniel (English Springer)") {
				$assign_one = "50 pounds";
				$assing_two = "40 pounds";
			} else if ($breed == "Spaniel (Field)") {
				$assign_one = "35-50 pounds";
				$assing_two = "1";
			} else if ($breed == "Spaniel (Irish Water)") {
				$assign_one = "55-68 pounds";
				$assing_two = "45-58";
			} else if ($breed == "Spaniel (Sussex)") {
				$assign_one = "35-50 pounds";
				$assing_two = "1";
			} else if ($breed == "Spaniel (Welsh Springer)") {
				$assign_one = "35-45 pounds";
				$assing_two = "1";
			} else if ($breed == "Spaniel Water Dog") {
				$assign_one = "35-45 pounds";
				$assing_two = "1";
			} else if ($breed == "Spinoni Italiani") {
				$assign_one = "40-49 pounds";
				$assing_two = "31-40 pounds";
			} else if ($breed == "St. Bernard") {
				$assign_one = "140-180 pounds";
				$assing_two = "120-140 pounds";
			} else if ($breed == "Staffordshire Bull Terrier") {
				$assign_one = "28-38 pounds";
				$assing_two = "24-34 pounds";
			} else if ($breed == "Spinoni Italiani") {
				$assign_one = "55-60 pounds";
				$assing_two = "1";
			} else if ($breed == "Standard Schnauzer") {
				$assign_one = "35-50 pounds";
				$assing_two = "30-45 pounds";
			} else if ($breed == "Swedish Vallhund") {
				$assign_one = "20-35 pounds";
				$assing_two = "1";
			} else if ($breed == "Tibetan Mastiff") {
				$assign_one = "90-150 pounds";
				$assing_two = "70-120 pounds";
			} else if ($breed == "Tibetan Terrier") {
				$assign_one = "18-30 pounds";
				$assing_two = "15-25 pounds";
			} else if ($breed == "Tibetan Spaniel") {
				$assign_one = "18-30 pounds";
				$assing_two = "15-25 pounds";
			} else if ($breed == "Toy Fox Terrier") {
				$assign_one = "9-15 pounds";
				$assing_two = "1";
			} else if ($breed == "Treeing Walker Coonhound") {
				$assign_one = "50-70 pounds";
				$assing_two = "1";
			} else if ($breed == "Vizsla") {
				$assign_one = "55-60 pounds";
				$assing_two = "44-55 pounds";
			} else if ($breed == "Weimaraner") {
				$assign_one = "70-90 pounds";
				$assing_two = "55-75 pounds";
			} else if ($breed == "Welsh Terrier") {
				$assign_one = "20 pounds";
				$assing_two = "18-20 pounds";
			} else if ($breed == "West Highland White Terrier") {
				$assign_one = "15-20 pounds";
				$assing_two = "1";
			} else if ($breed == "Whippet") {
				$assign_one = "25-40 pounds";
				$assing_two = "1";
			} else if ($breed == "Wirehaired Pointing Griffon") {
				$assign_one = "50-70 pounds";
				$assing_two = "35-50 pounds";
			} else if ($breed == "Wirehaired Vizsla") {
				$assign_one = "55-65 pounds";
				$assing_two = "1";
			} else if ($breed == "Xoloitzcuintli") {
				$assign_one = "30-55 pounds";
				$assing_two = "1";
			} else if ($breed == "Yorkshire Terrier") {
				$assign_one = "7 pounds";
				$assing_two = "1";
			}
			return array($assign_one, $assing_two);
		}
		$names = get_value($select_breed);
		if ($type == "first") {
			if (is_numeric($weight) && is_numeric($age)) {
				if ($age_selection == "wks") {
					if ($age > 52) {
						$this->param['error'] = 'Dogs above 12 months of age are consisdered adults!';
						return $this->param;
					} else if ($age < 0) {
						$this->param['error'] = 'Age must be greater than zero';
						return $this->param;
					} else {
						$age_calculation = $age * 1;
					}
				} else if ($age_selection == "days") {
					if ($age > 365) {
						$this->param['error'] = 'Dogs above 12 months of age are consisdered adults!';
						return $this->param;
					} else if ($age < 0) {
						$this->param['error'] = 'Age must be greater than zero';
						return $this->param;
					} else {
						$age_calculation = $age * 0.14286;
					}
				} else if ($age_selection == "mon") {
					if ($age > 13) {
						$this->param['error'] = 'Dogs above 12 months of age are consisdered adults!';
						return $this->param;
					} else if ($age < 0) {
						$this->param['error'] = 'Age must be greater than zero';
						return $this->param;
					} else {
						$age_calculation = $age * 4.348;
					}
				}
				if ($weight > 0) {
					if ($weight_selection == "g") {
						$convert = $weight / 1000;
					} elseif ($weight_selection == "dag") {
						$convert = $weight / 100;
					} elseif ($weight_selection == "kg") {
						$convert = $weight;
					} elseif ($weight_selection == "oz") {
						$convert = $weight / 35.274;
					} elseif ($weight_selection == "lb") {
						$convert = $weight / 2.205;
					} elseif ($weight_selection == "stone") {
						$convert = $weight * 6.35;
					}
				} else {
					$this->param['error'] = 'Weight must be greater than zero';
					return $this->param;
				}
				$calculation = ($convert / $age_calculation) * 52;
				$calculate2 = $calculation / 10;
				$cal3 = $calculation + $calculate2;
				$cal4 = $calculation - $calculate2;
				if ($calculation >= "156.5") {
					$this->param['error'] = 'The heaviest dog ever weighted exactly 345 lb (156.5 kg). Try not to exceed it!';
					return $this->param;
				} else {
					$h1 = '';
					$h2 = '';
					$h3 = '';
					$h4 = '';
					$h5 = '';
					if ($calculation < "5.4") {
						$h1 = 'bg-gradient text-white';
					} elseif ($calculation >= "5.4" && $calculation <= "10") {
						$h2 = 'bg-gradient text-white';
					} elseif ($calculation > "10" && $calculation <= "25.9") {
						$h3 = 'bg-gradient text-white';
					} elseif ($calculation > "25.9" && $calculation <= "44.9") {
						$h4 = 'bg-gradient text-white';
					} elseif ($calculation >= "44.9") {
						$h5 = 'bg-gradient text-white';
					}
					$calculation2 = $calculation;
					$calculation3 = $calculation * 2.20462;
					$this->param['h1'] = $h1;
					$this->param['h2'] = $h2;
					$this->param['h3'] = $h3;
					$this->param['h4'] = $h4;
					$this->param['h5'] = $h5;
					$this->param['puppy1'] = $calculation2;
					$this->param['puppy2'] = $calculation3;
					$this->param['cal3'] = $cal3;
					$this->param['cal4'] = $cal4;
					$this->param['type'] = $type;
					$this->param['RESULT'] = 1;
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($type == "second") {
			if (is_numeric($weight) && is_numeric($age)) {
				if ($age_selection == "wks") {
					if ($age > 52) {
						$this->param['error'] = 'Dogs above 12 months of age are consisdered adults!';
						return $this->param;
					} else if ($age < 0) {
						$this->param['error'] = 'Age must be greater than zero';
						return $this->param;
					} else {
						$age_calculation = $age * 1;
					}
				} else if ($age_selection == "days") {
					if ($age > 365) {
						$this->param['error'] = 'Dogs above 12 months of age are consisdered adults!';
						return $this->param;
					} else if ($age < 0) {
						$this->param['error'] = 'Age must be greater than zero';
						return $this->param;
					} else {
						$age_calculation = $age * 0.14286;
					}
				} else if ($age_selection == "mon") {
					if ($age > 13) {
						$this->param['error'] = 'Dogs above 12 months of age are consisdered adults!';
						return $this->param;
					} else if ($age < 0) {
						$this->param['error'] = 'Age must be greater than zero';
						return $this->param;
					} else {
						$age_calculation = $age * 4.348;
					}
				}
				if ($weight > 0) {
					if ($weight_selection == "g") {
						$convert = $weight / 1000;
					} elseif ($weight_selection == "dag") {
						$convert = $weight / 100;
					} elseif ($weight_selection == "kg") {
						$convert = $weight;
					} elseif ($weight_selection == "oz") {
						$convert = $weight / 35.274;
					} elseif ($weight_selection == "lb") {
						$convert = $weight / 2.205;
					} elseif ($weight_selection == "stone") {
						$convert = $weight * 6.35;
					}
				} else {
					$this->param['error'] = 'Weight must be greater than zero';
					return $this->param;
				}
				$calculation = ($convert / $age_calculation) * 52;
				$calculate2 = $calculation / 10;
				$cal3 = $calculation + $calculate2;
				$cal4 = $calculation - $calculate2;
				if ($calculation >= "156.5") {
					$this->param['error'] = 'The heaviest dog ever weighted exactly 345 lb (156.5 kg). Try not to exceed it!';
					return $this->param;
				} else {
					$h1 = '';
					$h2 = '';
					$h3 = '';
					$h4 = '';
					$h5 = '';
					if ($calculation < "5.4") {
						$h1 = 'bg-gradient text-white';
					} elseif ($calculation >= "5.4" && $calculation <= "10") {
						$h2 = 'bg-gradient text-white';
					} elseif ($calculation > "10" && $calculation <= "25.9") {
						$h3 = 'bg-gradient text-white';
					} elseif ($calculation > "25.9" && $calculation <= "44.9") {
						$h4 = 'bg-gradient text-white';
					} elseif ($calculation >= "44.9") {
						$h5 = 'bg-gradient text-white';
					}
					$calculation2 = $calculation;
					$calculation3 = $calculation * 2.20462;
					$this->param['h1'] = $h1;
					$this->param['h2'] = $h2;
					$this->param['h3'] = $h3;
					$this->param['h4'] = $h4;
					$this->param['h5'] = $h5;
					$this->param['puppy1'] = $calculation2;
					$this->param['puppy2'] = $calculation3;
					$this->param['cal3'] = $cal3;
					$this->param['cal4'] = $cal4;
					$this->param['type'] = $type;
					$this->param['select_breed'] = $select_breed;
					$this->param['names_zero'] = $names[0];
					$this->param['names_one'] = $names[1];
					$this->param['RESULT'] = 1;
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
	}

	//  prorated rent calculator
	public function prorated($request)
	{
		$date = trim($request->input('date'));
		$rent = trim($request->input('rent'));
		$bill_on = trim($request->input('bill_on'));
		if (is_numeric($rent) && is_numeric($bill_on) && !empty($date)) {
			$year = date('Y', strtotime($date));
			$mon = date('m', strtotime($date));
			$day = date('d', strtotime($date));
			if ($bill_on >= $day || $bill_on == 1) {
				$res = 1;
				$d = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
				$per_day = $rent / $d;
				if ($bill_on <= $d) {
					if ($bill_on == 1) {
						$days_in_mon = ($d - $day) + 1;
						$pror = $per_day * $days_in_mon;
						$end_date = $d;
					} else {
						$days_in_mon = ($bill_on - $day);
						$pror = $per_day * $days_in_mon;
						$end_date = $bill_on - 1;
					}
				} elseif ($d < $bill_on) {
					$days_in_mon = 1;
					$pror = $per_day * $days_in_mon;
					$end_date = $d;
				}
				$end_date = $year . '-' . $mon . '-' . $end_date;
			} elseif ($bill_on < $day) {
				$res = 2;
				$d = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
				$per_day = $rent / $d;
				$days_in_mon = ($d - $day) + 1;
				$pror = $per_day * $days_in_mon;
				$mon1 = date('m', strtotime($date . " + 1 month"));
				$year1 = date('Y', strtotime($date . " + 1 month"));
				$d1 = cal_days_in_month(CAL_GREGORIAN, $mon1, $year);
				$per_day1 = $rent / $d1;
				$pror1 = $per_day1 * ($bill_on - 1);
				$end_date = $bill_on - 1;
				$end_date = $year1 . '-' . $mon1 . '-' . $end_date;
				$this->param['d1'] = $d1;
				$this->param['per_day1'] = $per_day1;
				$this->param['days_in_mon1'] = $bill_on - 1;
				$this->param['pror1'] = $pror1;
			}
			$this->param['date'] = $date;
			$this->param['d'] = $d;
			$this->param['per_day'] = $per_day;
			$this->param['days_in_mon'] = $days_in_mon;
			$this->param['pror'] = $pror;
			$this->param['end_date'] = $end_date;
			$this->param['res'] = $res;
			$this->param['RESULT'] = 1;
			//  dd($this->param);
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Cubic Feet Calculator
	public function cubic($request)
	{
		$length = $request->input('length');
		$width = $request->input('width');
		$height = $request->input('height');
		$length_unit = $request->input('length_unit');
		$width_unit = $request->input('width_unit');
		$height_unit = $request->input('height_unit');
		$weight = $request->input('weight');
		$weight_unit = $request->input('weight_unit');
		$quantity = $request->input('quantity');
		$price = $request->input('price');
		$price_unit = $request->input('price_unit');
		$room_unit = $request->input('room_unit');
		$area = $request->input('area');
		$area_unit = $request->input('area_unit');

		if ($room_unit == "1") {
			if (is_numeric($length) && is_numeric($height) && is_numeric($width)) {
				function calculate($a, $b)
				{
					if ($b == "ft") {
						$convert = $a * 1;
					} elseif ($b == "in") {
						$convert = $a * 0.0833333;
					} elseif ($b == "yd") {
						$convert = $a * 3;
					} elseif ($b == "cm") {
						$convert = $a * 0.0328084;
					} elseif ($b == "m") {
						$convert = $a * 3.28084;
					} elseif ($b == "mm") {
						$convert = $a * 0.003281;
					} elseif ($b == "km") {
						$convert = $a * 3281;
					} elseif ($b == "mi") {
						$convert = $a * 5280;
					} elseif ($b == "nmi") {
						$convert = $a * 6076;
					}
					return $convert;
				}
				function calculate2($a, $b)
				{
					if ($b == "ft") {
						$convert5 = $a * 1;
					} elseif ($b == "in") {
						$convert5 = $a * 0.0833333;
					} elseif ($b == "yd") {
						$convert5 = $a * 3;
					} elseif ($b == "cm") {
						$convert5 = $a * 0.0328084;
					} elseif ($b == "m") {
						$convert5 = $a * 3.28084;
					} elseif ($b == "mm") {
						$convert5 = $a * 0.003281;
					} elseif ($b == "km") {
						$convert5 = $a * 3281;
					} elseif ($b == "mi") {
						$convert5 = $a * 5280;
					} elseif ($b == "nmi") {
						$convert5 = $a * 6076;
					}
					return $convert5;
				}
				function converting($a, $b)
				{
					if ($b == "cm") {
						$convert3 = $a * 1;
					} elseif ($b == "ft") {
						$convert3 = $a * 30.48;
					} elseif ($b == "m") {
						$convert3 = $a * 100;
					} elseif ($b == "in") {
						$convert3 = $a * 2.54;
					} elseif ($b == "yd") {
						$convert3 = $a * 91.44;
					} elseif ($b == "km") {
						$convert3 = $a * 100000;
					} elseif ($b == "mm") {
						$convert3 = $a * 0.1;
					} elseif ($b == "mi") {
						$convert3 = $a * 160934;
					} elseif ($b == "nmi") {
						$convert3 = $a * 185200;
					}
					return $convert3;
				}
				$l = calculate($length, $length_unit);
				$w = calculate($width, $width_unit);
				$h = calculate($height, $height_unit);
				$volume = $l * $w * $h;
				$calculate_meter_cube = ($volume) / 35.3147;
				$calculate_cubic_yards = $volume * 0.03704;
				$calculate_cubic_inches = $volume / 0.0005787;
				$calculate_cubic_centimeters = $volume * 28317;
				$v1 = converting($length, $length_unit);
				$v2 = converting($width, $width_unit);
				$v3 = converting($height, $height_unit);
				$volumetric_weight = ($v1 * $v2 * $v3) / 5000;
				$volumetric_weight2 = $volumetric_weight * 2.205;
				$v4 = calculate2($length, $length_unit);
				$v5 = calculate2($width, $width_unit);
				$v6 = calculate2($height, $height_unit);
				$twenty_ft = 1165 / ($v4 * $v5 * $v6);
				$fourty_ft = 2350 / ($v4 * $v5 * $v6);
				$fourty_high_cube = 2694 / ($v4 * $v5 * $v6);
				if ($quantity != 0 && $quantity != "") {
					$volume = $volume * $quantity;
				}
				if ($weight != 0 && $weight != "") {
					if ($weight_unit == "lbs") {
						$this->param['weight_unit'] = $weight_unit;
						$weight_convert = $weight * 0.454;
						$this->param['weight'] = $weight;
						$this->param['weight_convert'] = $weight_convert;
					} elseif ($weight_unit == "kg") {
						$this->param['weight_unit'] = $weight_unit;
						$this->param['weight'] = $weight;
						$weight_convert = $weight * 2.205;
						$this->param['weight_convert'] = $weight_convert;
					}
				}
				if ($price != 0 && $weight != "") {
					if ($price_unit == "ft³") {
						$price = $price * 1;
					} elseif ($price_unit == "yd³") {
						$price = $price * 0.04;
					} elseif ($price_unit == "m³") {
						$price = $price * 0.03;
					} elseif ($price_unit == "cm³") {
						$price = $price * 28316.85;
					} elseif ($price_unit == "in³") {
						$price = $price * 1.728;
					}
					$volume = $volume * $price;
					$this->param['estimated_price'] = $price;
				}
				$this->param['volume'] = $volume;
				$this->param['cubic_meter'] = $calculate_meter_cube;
				$this->param['cubic_yards'] = $calculate_cubic_yards;
				$this->param['cubic_inches'] = $calculate_cubic_inches;
				$this->param['cubic_centimeters'] = $calculate_cubic_centimeters;
				$this->param['weight'] = $weight;
				$this->param['volumetric_weight'] = $volumetric_weight;
				$this->param['volumetric_weight2'] = $volumetric_weight2;
				$this->param['twenty_ft'] = $twenty_ft;
				$this->param['fourty_ft'] = $fourty_ft;
				$this->param['fourty_high_cube'] = $fourty_high_cube;
				//   input parameters
				$this->param['l'] = $l;
				$this->param['w'] = $w;
				$this->param['h'] = $h;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($room_unit == "2") {
			if (is_numeric($area) && is_numeric($height)) {
				if ($area_unit == "ft") {
					$convert13 = $area * 1;
				} elseif ($area_unit == "in") {
					$convert13 = $area * 0.00694444;
				} elseif ($area_unit == "yd") {
					$convert13 = $area * 9;
				} elseif ($area_unit == "cm") {
					$convert13 = $area * 0.00107639;
				} elseif ($area_unit == "m") {
					$convert13 = $area * 10.7639;
				}
				function calculate_three($a, $b)
				{
					if ($b == "ft") {
						$convert = $a * 1;
					} else if ($b == "in") {
						$convert = $a * 0.0833333;
					} else if ($b == "yd") {
						$convert = $a * 3;
					} else if ($b == "cm") {
						$convert = $a * 0.0328084;
					} else if ($b == "m") {
						$convert = $a * 3.28084;
					} else if ($b == "mm") {
						$convert = $a * 0.003281;
					} else if ($b == "km") {
						$convert = $a * 3281;
					} else if ($b == "mi") {
						$convert = $a * 5280;
					} else if ($b == "nmi") {
						$convert = $a * 6076.12;
					}
					return $convert;
				}
				$h1 = calculate_three($height, $height_unit);
				$volume = $convert13 * $h1;
				if ($price != 0) {
					if ($price_unit == "ft³") {
						$price = $price * 1;
					} elseif ($price_unit == "yd³") {
						$price = $price * 0.04;
					} elseif ($price_unit == "m³") {
						$price = $price * 0.03;
					} elseif ($price_unit == "cm³") {
						$price = $price * 28316.85;
					} elseif ($price_unit == "in³") {
						$price = $price * 1728;
					}
					$price = $volume * $price;
				}
				if ($quantity != 0 && $quantity != "") {
					$volume = $volume * $quantity;
				}
				$this->param['volume'] = $volume;
				$calculate_meter_cube = ($volume) / 35.3147;
				$calculate_cubic_yards = $volume * 27;
				$calculate_cubic_inches = $volume / 0.0005787;
				$calculate_cubic_centimeters = $volume * 28317;
				$this->param['cubic_meter'] = $calculate_meter_cube;
				$this->param['cubic_yards'] = $calculate_cubic_yards;
				$this->param['cubic_inches'] = $calculate_cubic_inches;
				$this->param['cubic_centimeters'] = $calculate_cubic_centimeters;
				$this->param['estimated_price'] = $price;
				$this->param['h1'] = $h1;
				$this->param['convert13'] = $convert13;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
	}

	// Paver calculator
	public function paver($request)
	{
		$operations = $request->input('operations');
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$four = $request->input('four');
		$fiveb = $request->input('fiveb');
		$units1 = $request->input('units1');
		$units2 = $request->input('units2');
		$units3 = $request->input('units3');
		$units4 = $request->input('units4');
		$price = $request->input('price');
		$cost = $request->input('cost');
		$cost_unit = $request->input('cost_unit');
		function unit_convert($a, $b)
		{
			if ($b == "ft") {
				$convert = $a * 1;
			} elseif ($b == "in") {
				$convert = $a * 0.0833333;
			} elseif ($b == "yd") {
				$convert = $a * 3;
			} elseif ($b == "cm") {
				$convert = $a * 0.0328084;
			} elseif ($b == "m") {
				$convert = $a * 3.28084;
			} elseif ($b == "mi") {
				$convert = $a * 5280;
			} elseif ($b == "km") {
				$convert = $a * 3281;
			}
			return $convert;
		}

		if ($operations == "3") {
			if (is_numeric($first) && is_numeric($second)) {
				$first = unit_convert($first, $units1);
				$second = unit_convert($second, $units2);
				$third = unit_convert($third, $units3);
				$four = unit_convert($four, $units4);
				$patio_area_ans = $third * $four;
				$area_ans = $first * $second;
				$area_ans = round($area_ans, 7);
				$patio_area_ans = round($patio_area_ans, 7);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($fiveb)) {
				$first = unit_convert($first, $units1);
				$second = unit_convert($second, $units2);
				$third = unit_convert($third, $units3);
				$four = unit_convert($four, $units4);
				$area_ans = $first * $second * $fiveb;
				$patio_area_ans = $third * $four;
				$area_ans = round($area_ans, 7);
				$patio_area_ans = round($patio_area_ans, 7);
			} else {
				return $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first)) {
				$first = unit_convert($first, $units1);
				$sq_val = $first / 2;
				$final_val = $sq_val * $sq_val;
				$area_ans = 3.14 * $final_val;
				$third = unit_convert($third, $units3);
				$four = unit_convert($four, $units4);
				$patio_area_ans = $third * $four;
				$area_ans = round($area_ans, 7);
			}
		}

		if (!empty($area_ans) && !empty($patio_area_ans)) {
			$no_p = $area_ans / $patio_area_ans;
			$no_paver = ceil($no_p);
		}
		$this->param = [
			'area_ans' => $area_ans,
			'patio_area_ans' => $patio_area_ans,
			'no_paver' => $no_paver,
		];
		if (!empty($price)) {
			$price_p = $price * $no_paver;
			$this->param['price_p'] = $price_p;

			if (!empty($price) && !empty($cost)) {
				if ($cost_unit == "1") {
					$cost_p = $cost * $area_ans * 1;
				} elseif ($cost_unit == "2") {
					$cost_p = $cost * $area_ans * 10.7639;
				}
				$cost_p = round($cost_p, 2);
				$this->param['cost_p'] = $cost_p;

				// Calculate total_cost only if both price_p and cost_p are present
				if (!empty($price_p)) {
					$total_cost = $price_p + $cost_p;
					$this->param['total_cost'] = $total_cost;
				}
			} else {
				$this->param['error'] = 'please entry both cost and price';
				return $this->param;
			}
		}
		return $this->param;
	}

	//  Top Soil Calculator
	public function topsoil($request)
	{
		$length = $request->input('length');
		$width = $request->input('width');
		$depth = $request->input('depth');
		$area = $request->input('area');
		$length_unit = $request->input('length_unit');
		$width_unit = $request->input('width_unit');
		$depth_unit = $request->input('depth_unit');
		$area_unit = $request->input('area_unit');
		$calculation_unit = $request->input('calculation_unit');
		$purchase_unit = $request->input('purchase_unit');
		$bag_size = $request->input('bag_size');
		$bag_size_unit = $request->input('bag_size_unit');
		$price_per_bag = $request->input('price_per_bag');
		$price_per_ton = $request->input('price_per_ton');
		$ton = 0.05;

		function calculate10($a, $b)
		{
			if ($b == "ft") {
				$convert = $a * 1;
			} elseif ($b == "in") {
				$convert = $a * 0.0833333;
			} elseif ($b == "yd") {
				$convert = $a * 3;
			} elseif ($b == "cm") {
				$convert = $a * 0.0328084;
			} elseif ($b == "m") {
				$convert = $a * 3.28084;
			} elseif ($b == "km") {
				$convert = $a * 3281;
			} elseif ($b == "mi") {
				$convert = $a * 5280;
			}
			return $convert;
		}
		function volume($c, $d)
		{
			if ($c == "sq ft") {
				$convert2 = $d * 1;
			} else if ($c == "sq yd") {
				$convert2 = $d * 9;
			} else if ($c == "sq m") {
				$convert2 = $d * 0.836127;
			}
			return $convert2;
		}
		function calculate_feet($e, $f)
		{
			if ($e == "cu ft") {
				$convert3 = $f * 1;
				$convert4 = 20.02;
			} else if ($e == "cu yd") {
				$convert3 = $f * 27;
				$convert4 = 0.74;
			} else if ($e == "cu m") {
				$convert3 = $f * 35.3147;
				$convert4 = 0.57;
			} else if ($e == "lbs") {
				$convert3 = $f * 0.016018614545451;
				$convert4 = 2000;
			} else if ($e == "kg") {
				$convert3 = $f * 0.035315;
				$convert4 = 907.18;
			} else if ($e == "liters") {
				$convert3 = $f * 0.0353147;
				$convert4 = 566.99;
			}
			return array($convert3, $convert4);
		}
		function tree($y, $z)
		{
			if ($y == "kg/m³") {
				$convert30 = $z * 0.001;
			} else if ($y == "kg/L") {
				$convert30 = $z * 1;
			} else if ($y == "t/m³") {
				$convert30 = $z * 1;
			} else if ($y == "g/cm³") {
				$convert30 = $z * 1;
			} else if ($y == "oz/cu in") {
				$convert30 = $z * 1.729994;
			} else if ($y == "lb cu/in") {
				$convert30 = $z * 27.6799;
			} else if ($y == "lb cu/ft") {
				$convert30 = $z * 0.01601846;
			} else if ($y == "lb cu/yd") {
				$convert30 = $z * 0.000593276;
			} else if ($y == "lb/US gal") {
				$convert30 = $z * 0.1198264;
			} else if ($y == "kg/L") {
				$convert30 = $z * 0.001;
			} else if ($y == "g/dL") {
				$convert30 = $z * 0.01;
			}
			return $convert30;
		}
		if ($calculation_unit == "1") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($depth)  && $length > 0 && $width > 0 && $depth > 0) {
				$length_value = calculate10($length, $length_unit);
				$width_value = calculate10($width, $width_unit);
				$depth_value = calculate10($depth, $depth_unit);
				$calculation = $length_value * $width_value * $depth_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		if ($calculation_unit == "2") {
			if (is_numeric($area) && is_numeric($depth) && $area > 0 && $depth > 0) {
				$depth_value = calculate10($depth, $depth_unit);
				$area_value = volume($area_unit, $area);
				$calculation = $depth_value * $area_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		if ($purchase_unit == "1") {
			if ($bag_size == "" && $price_per_bag == "") {
				$this->param['calculation'] = $calculation;
				$this->param['bag1'] = $calculation / 0.75;
				$this->param['bag2'] = $calculation / 1;
				$this->param['bag3'] = $calculation / 1.5;
				$this->param['bag4'] = $calculation / 2;
				$this->param['bag5'] = $calculation / 3;
				$this->param['bag6'] = $calculation / 25;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else if ($bag_size != "" && $price_per_bag == "") {
				if (is_numeric($bag_size) && $bag_size > 0) {
					$number_of_bags = calculate_feet($bag_size_unit, $bag_size);
					$calculate_number_of_bags = $calculation / $number_of_bags[0];
					$this->param['calculation'] = $calculation;
					$this->param['number_of_bags'] = $calculate_number_of_bags;
					$this->param['bag_size_unit'] = $bag_size_unit;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Enter Number Only Number';
					return $this->param;
				}
			} else if ($bag_size != "" && $price_per_bag != "") {
				if (is_numeric($bag_size) && is_numeric($price_per_bag) && $bag_size > 0 && $price_per_bag > 0) {
					$number_of_bags = calculate_feet($bag_size_unit, $bag_size);
					$calculate_number_of_bags = $calculation / $number_of_bags[0];
					$total_cost = $price_per_bag * $calculate_number_of_bags;
					//$price_per_cost=$number_of_bags[0]*$ton;
					$this->param['calculation'] = $calculation;
					$this->param['number_of_bags'] = $calculate_number_of_bags;
					$this->param['total_cost'] = $total_cost;
					$this->param['bag_size'] = $bag_size;
					$this->param['price_per_bag'] = $price_per_bag;
					$this->param['price_in_ton'] = ($price_per_bag * $number_of_bags[1]) / $bag_size;
					$this->param['bag_size_unit'] = $bag_size_unit;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Enter Number Only Number';
					return $this->param;
				}
			} else if ($price_per_bag != "" && $bag_size == "") {
				if (is_numeric($price_per_bag) && $price_per_bag > 0) {
					$this->param['calculation'] = $calculation;
					// $this->param['calculate_density'] = $calculate_density;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Enter Number Only Number';
					return $this->param;
				}
			}
		} else if ($purchase_unit == "2") {
			if (is_numeric($price_per_ton) && $price_per_ton > 0) {
				$calculate_cost = $calculation * $ton;
				$this->param['calculate_cost'] = $calculate_cost;
				$this->param['calculation'] = $calculation;
				$this->param['RESULT'] = 1;
				return $this->param;
			}
		}
	}

	// fence calcualtor
	public function fence($request)
	{
		$f_length = $request->input('f_length');
		$fl_units = $request->input('fl_units');
		$post_space = $request->input('post_space');
		$po_units = $request->input('po_units');
		$first = $request->input('first');
		$units1 = $request->input('units1');
		$second = $request->input('second');
		$p_width = $request->input('p_width');
		$pw_units = $request->input('pw_units');
		$p_spacing = $request->input('p_spacing');
		$ps_units = $request->input('ps_units');
		$third = $request->input('third');
		$units3 = $request->input('units3');
		$four = $request->input('four');
		$units4 = $request->input('units4');
		$drop1 = $request->input('drop1');
		$drop2 = $request->input('drop2');
		$drop3 = $request->input('drop3');
		// dd($request->input());
		function convert_units($a, $b)
		{
			if ($b == "ft") {
				$convert = $a * 1;
			} elseif ($b == "in") {
				$convert = $a * 0.0833333;
			} elseif ($b == "yd") {
				$convert = $a * 3;
			} elseif ($b == "cm") {
				$convert = $a * 0.0328084;
			} elseif ($b == "m") {
				$convert = $a * 3.28084;
			} elseif ($b == "mi") {
				$convert = $a * 5280;
			} elseif ($b == "km") {
				$convert = $a * 3281;
			}
			return $convert;
		}
		function fconvert_inches($a, $b)
		{
			if ($b == "ft") {
				$inches = $a * 12;
			} elseif ($b == "in") {
				$inches = $a * 1;
			} elseif ($b == "yd") {
				$inches = $a * 36;
			} elseif ($b == "cm") {
				$inches = $a / 2.54;
			} elseif ($b == "m") {
				$inches = $a * 39.37;
			} elseif ($b == "mi") {
				$inches = $a / 1000;
			} elseif ($b == "km") {
				$inches = $a * 39370;
			}
			return $inches;
		}
		if (is_numeric($f_length) && is_numeric($post_space)) {
			$f_length = convert_units($f_length, $fl_units);
			$post_space = convert_units($post_space, $po_units);
			$f_length = $f_length + 0.4;
			$post_space = $post_space + 0.4;
			$f_length = round($f_length);
			$post_space = round($post_space);
			$no_post = ($f_length / $post_space) + 1;

			$no_post = $no_post + 0.4;
			$no_post = round($no_post);
			$no_sections = $no_post - 1;
			// dd($no_post);
		} else {
			$this->param['error'] = 'Please! Enter the date';
			return $this->param;
		}
		if (is_numeric($first)) {
			if ($drop1 == "2") {
				$first = convert_units($first, $units1);
				$post_heigth = $first * 1.5;
				$post_heigth = number_format($post_heigth, 2);
			} else if ($drop1 == "1") {
				$first = convert_units($first, $units1);
				$post_heigth = $first;
				$post_heigth = number_format($post_heigth, 2);
				$fence_heigth = $first / 1.5;
				$fence_heigth = number_format($fence_heigth, 2);
			}
		} else {
			$this->param['error'] = 'Please! Enter the date';
			return $this->param;
		}
		if (is_numeric($second)) {
			if ($drop2 == "2") {
				$no_rails = $second * $no_sections;
			} else if ($drop2 == "1") {
				// dd($second);
				if ($no_sections == 0) {
					$this->param['error'] = 'Your answer is 0 and 0 cannot devided by a number';
					return $this->param;
				}
				$rails_section = $second / $no_sections;
			}
		} else {
			$this->param['error'] = 'Please! Enter the date';
			return $this->param;
		}
		if (is_numeric($p_width) && is_numeric($p_spacing)) {
			$p_width = fconvert_inches($p_width, $pw_units);
			$p_spacing = fconvert_inches($p_spacing, $ps_units);
			$f_length2 = $f_length * 12;
			$no_pickets = $f_length2 / ($p_width + $p_spacing);
			$no_pickets = $no_pickets + 0.4;
			$no_pickets = round($no_pickets);
		} else {
			$this->param['error'] = 'Please! Enter the date';
			return $this->param;
		}
		if ($drop3 == "1") {
			if (is_numeric($third) && is_numeric($four)) {
				$third = fconvert_inches($third, $units3);
				$four = fconvert_inches($four, $units4);
				$post_heigth2 = $post_heigth * 12;
				$buried = $post_heigth2 / 3;
				$p_volume = $third * $four * $buried;
				$h_volume = ($third * 3) * ($four * 3) * $buried;
				$c_volume = ($h_volume - $p_volume) * $no_post;
			} else {
				$this->param['error'] = 'Please! Enter the date';
				return $this->param;
			}
		} else if ($drop3 == "2") {
			if (is_numeric($third)) {
				$third = fconvert_inches($third, $units3);
				$post_heigth2 = $post_heigth * 12;
				$radius = $third / 2;
				$sq_radius = $radius * $radius;
				$buried = $post_heigth2 / 3;
				$p_volume = $sq_radius * $buried * 3.14;
				$c_radius = $radius * 3;
				$sq_cradius = $c_radius * $c_radius;
				$h_volume = $sq_cradius * $buried * 3.14;
				$c_volume = ($h_volume - $p_volume) * $no_post;
			} else {
				$this->param['error'] = 'Please! Enter the date';
				return $this->param;
			}
		}
		if (!empty($c_volume)) {
			$ft_volume = $c_volume / 1728;
			$ft_volume = number_format($ft_volume, 2);
			$yd_volume = $c_volume / 46656;
			$yd_volume = number_format($yd_volume, 2);
		}
		if (!empty($no_post)) {
			$this->param['no_post'] = $no_post;
		}
		if (!empty($no_sections)) {
			$this->param['no_sections'] = $no_sections;
		}
		if (!empty($post_heigth)) {
			$this->param['post_heigth'] = $post_heigth;
		}
		if (!empty($fence_heigth)) {
			$this->param['fence_heigth'] = $fence_heigth;
		}
		if (!empty($no_rails)) {
			$this->param['no_rails'] = $no_rails;
		}
		if (!empty($rails_section)) {
			$this->param['rails_section'] = $rails_section;
		}
		if (!empty($no_pickets)) {
			$this->param['no_pickets'] = $no_pickets;
		}
		if (!empty($c_volume)) {
			$this->param['c_volume'] = $c_volume;
		}
		if (!empty($ft_volume)) {
			$this->param['ft_volume'] = $ft_volume;
		}
		if (!empty($yd_volume)) {
			$this->param['yd_volume'] = $yd_volume;
		}
		return $this->param;
	}

	// stair calculator
	public function stair($request)
	{
		$type = $request->input('type');
		$f_input = $request->input('f_input');
		$f_units = $request->input('f_units');
		$s_input = $request->input('s_input');
		$s_units = $request->input('s_units');
		$rise = $request->input('rise');
		$t_input = $request->input('t_input');
		$t_units = $request->input('t_units');
		$tread = $request->input('tread');
		$tread_input = $request->input('tread_input');
		$tread_units = $request->input('tread_units');
		$headroom = $request->input('headroom');
		$f_opening = $request->input('f_opening');
		$fo_units = $request->input('fo_units');
		$f_thickness = $request->input('f_thickness');
		$ft_units = $request->input('ft_units');
		$h_req = $request->input('h_req');
		$hr_units = $request->input('hr_units');
		$mount = $request->input('mount');
		// dd($request->input());
		function stair_inches($a, $b)
		{
			if ($b == "ft") {
				$inches = $a * 12;
			} elseif ($b == "in") {
				$inches = $a * 1;
			} elseif ($b == "yd") {
				$inches = $a * 36;
			} elseif ($b == "cm") {
				$inches = $a / 2.54;
			} elseif ($b == "m") {
				$inches = $a * 39.37;
			}
			return $inches;
		}
		if ($type == "first") {
			$f_input = stair_inches($f_input, $f_units);
			$s_input = stair_inches($s_input, $s_units);
			$t_input = stair_inches($t_input, $t_units);
			$tread_input = stair_inches($tread_input, $tread_units);
			if ($f_input > 0 && $s_input > 0) {
				if ($rise == "1") {
					if ($t_input > 0) {
						$inch = $t_input;
						$inch = number_format($inch, 2);
						$no_stair = $s_input / $t_input;
						$stair_ans = round($no_stair);
						$total_run_ans = $f_input * ($stair_ans - 1);
						$total_run_ans = number_format($total_run_ans, 2);
						$run_ans = $f_input;
						$run_ans = number_format($run_ans, 2);
						$first_step = $s_input - $t_input;
						if ($first_step <= 0) {
							$step_ans = $s_input;
							$step_ans = number_format($step_ans, 2);
						} else if ($first_step > 0) {
							$step_ans = $first_step;
							$step_ans = number_format($step_ans, 2);
						}
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
					if ($tread == "2") {
						if ($tread_input > 0) {
							$f_step = $s_input - $t_input;
							if ($f_step <= 0) {
								$s_ans = $s_input;
								$s_ans = number_format($s_ans, 2);
							} else if ($f_step > 0) {
								$s_ans = $f_step;
								$s_ans = number_format($s_ans, 2);
							}
							$placement = $t_input + $tread_input;
							$placement = number_format($placement, 2);
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					}
				} else if ($rise == "2") {
					if ($t_input > 0) {
						$inch = $s_input / $t_input;
						$inch = number_format($inch, 2);
						$no_stair = $t_input;
						$stair_ans = round($no_stair);
						$total_run_ans = $f_input * $t_input;
						$total_run_ans = number_format($total_run_ans, 2);
						$run_ans = $f_input;
						$run_ans = number_format($run_ans, 2);
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
					if ($tread == "2") {
						if ($tread_input > 0) {
							$f_step = $s_input - $t_input;
							if ($f_step <= 0) {
								$s_ans = $s_input;
								$s_ans = number_format($s_ans, 2);
							} else if ($f_step > 0) {
								$s_ans = $f_step;
								$s_ans = number_format($s_ans, 2);
							}
							$placement = $tread_input;
							$placement = number_format($placement, 2);
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($type == "second") {
			$f_input = stair_inches($f_input, $f_units);
			$s_input = stair_inches($s_input, $s_units);
			$t_input = stair_inches($t_input, $t_units);
			$tread_input = stair_inches($tread_input, $tread_units);
			if ($f_input > 0 && $s_input > 0) {
				if ($rise == "1") {
					if ($t_input > 0) {
						$inch = $t_input;
						$inch = number_format($inch, 2);
						$no_stair = $s_input / $t_input;
						$stair_ans = round($no_stair);
						$total_run_ans = $f_input;
						$total_run_ans = number_format($total_run_ans, 2);
						$run_ans = $f_input / $stair_ans;
						$run_ans = number_format($run_ans, 2);
						$first_step = $s_input - $t_input;
						if ($first_step <= 0) {
							$step_ans = $s_input;
							$step_ans = number_format($step_ans, 2);
						} else if ($first_step > 0) {
							$step_ans = $first_step;
							$step_ans = number_format($step_ans, 2);
						}
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
					if ($tread == "2") {
						if ($tread_input > 0) {
							$f_step = $s_input - $t_input;
							if ($f_step <= 0) {
								$s_ans = $s_input;
								$s_ans = number_format($s_ans, 2);
							} else if ($f_step > 0) {
								$s_ans = $f_step;
								$s_ans = number_format($s_ans, 2);
							}
							$placement = $t_input + $tread_input;
							$placement = number_format($placement, 2);
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					}
				} else if ($rise == "2") {
					if ($t_input > 0) {
						$inch = $s_input / $t_input;
						$inch = number_format($inch, 2);
						$no_stair = $t_input;
						$stair_ans = round($no_stair);
						$total_run_ans = $f_input;
						$total_run_ans = number_format($total_run_ans, 2);
						return $this->param['total_run_ans'] = $total_run_ans;
						$run_ans = $f_input / $stair_ans;
						$run_ans = number_format($run_ans, 2);
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
					if ($tread == "2") {
						if ($tread_input > 0) {
							$f_step = $s_input - $t_input;
							if ($f_step <= 0) {
								$s_ans = $s_input;
								$s_ans = number_format($s_ans, 2);
							} else if ($f_step > 0) {
								$s_ans = $f_step;
								$s_ans = number_format($s_ans, 2);
							}
							$placement = $tread_input;
							$placement = number_format($placement, 2);
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		if ($mount == "1") {
			$mount_ans = $s_input - $t_input;
			$mount_ans = number_format($mount_ans, 2);
			if ($headroom == "2") {
				if (!empty($f_opening) && !empty($f_thickness) && !empty($h_req)) {
					$f_opening = stair_inches($f_opening, $fo_units);
					$f_thickness = stair_inches($f_thickness, $ft_units);
					$h_req = stair_inches($h_req, $hr_units);
					if ($f_opening > 0) {
						if ($f_opening > 0 && $f_opening < 5) {
							$answ = $inch - $f_thickness;
						} else {
							$answ = $inch - $f_thickness;
							for ($i = 0; $i <= $f_opening; $i++) {
								if ($i % 5 == 0) {
									$answ = $answ + $inch;
								}
							}
							if ($f_opening < 5) {
								$answ = $answ * 1;
							} else if ($f_opening > 5) {
								$answ = $answ - $inch;
							}
						}
					} else if ($f_opening < 0) {
						if ($f_opening < -1 && $f_opening > -5) {
							$answ = $f_thickness * -1;
						} else {
							$answ = $inch + $f_thickness;
							for ($i = -1; $i >= $f_opening; $i--) {
								if ($i % 5 == 0) {
									$answ = $answ + $inch;
								}
							}
							$answ = $answ * -1;
						}
						if ($f_opening > -5) {
							$answ = $answ * 1;
						} else if ($f_opening < -5) {
							$answ = $answ + $inch;
						}
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else if ($mount == "2") {
			$mount_ans = $s_input;
			if ($headroom == "2") {
				if (!empty($f_opening) && !empty($f_thickness) && !empty($h_req)) {
					$f_opening = stair_inches($f_opening, $fo_units);
					$f_thickness = stair_inches($f_thickness, $ft_units);
					$h_req = stair_inches($h_req, $hr_units);
					if ($f_opening > 0) {
						if ($f_opening >= 0 && $f_opening < 5) {
							$answ = $f_thickness * -1;
						} else {
							$answ = $inch - $f_thickness;
							for ($i = 0; $i < $f_opening; $i++) {
								if ($i % 5 == 0) {
									$answ = $answ + $inch;
								}
							}
							$answ = $answ - $inch;
						}
					} else if ($f_opening < 0) {
						if ($f_opening < -1 && $f_opening > -5) {
							$answ = $f_thickness + $inch;
							$answ = $answ * -1;
						} else {
							$answ = $inch + $f_thickness;
							for ($i = -1; $i > $f_opening; $i--) {
								if ($i % 5 == 0) {
									$answ = $answ + $inch;
								}
							}
							$answ = $answ * -1;
						}
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
		$str = pow($total_run_ans, 2) + pow($mount_ans, 2);
		$str = sqrt($str);
		$str = number_format($str, 2);
		if (!empty($str) || !empty($mount_ans)) {
			$angle = $mount_ans / $str;
			$angle = asin($angle);
			$angle_ans = rad2deg($angle);
			$angle_ans = number_format($angle_ans, 2);
		}
		if (!empty($inch)) {
			$this->param['inch'] = $inch;
		}
		if (!empty($total_run_ans)) {
			$this->param['total_run_ans'] = $total_run_ans;
		}
		if (!empty($run_ans)) {
			$this->param['run_ans'] = $run_ans;
		}
		if (!empty($stair_ans)) {
			$this->param['stair_ans'] = $stair_ans;
		}
		if (!empty($placement)) {
			$this->param['placement'] = $placement;
		}
		if (!empty($mount_ans)) {
			$this->param['mount_ans'] = $mount_ans;
		}
		if (!empty($str)) {
			$this->param['str'] = $str;
		}
		if (!empty($step_ans)) {
			$this->param['step_ans'] = $step_ans;
		}
		if (!empty($s_ans)) {
			$this->param['s_ans'] = $s_ans;
		}
		if (!empty($angle_ans)) {
			$this->param['angle_ans'] = $angle_ans;
		}
		if (!empty($answ)) {
			$this->param['answ'] = $answ;
		}
		return $this->param;
	}

	// tile calculator 
	public function tile($request)
	{
		$area_length = $request->input('area_length');
		$area_length_unit = $request->input('area_length_unit');
		$area_width = $request->input('area_width');
		$area_width_unit = $request->input('area_width_unit');
		$tile_length = $request->input('tile_length');
		$tile_length_unit = $request->input('tile_length_unit');
		$tile_width = $request->input('tile_width');
		$tile_width_unit = $request->input('tile_width_unit');
		$gap_size = $request->input('gap_size');
		$gap_size_unit = $request->input('gap_size_unit');
		$waste = $request->input('waste');
		$price = $request->input('price');
		$price_unit = $request->input('price_unit');
		$box_size = $request->input('box_size');
		$total_area = $request->input('total_area');
		$total_area_unit = $request->input('total_area_unit');
		$calculation_unit = $request->input('calculation_unit');
		function convert_inches($a, $b)
		{
			if ($b == "ft") {
				$convert2 = $a * 12;
			} elseif ($b == "in") {
				$convert2 = $a * 1;
			} elseif ($b == "yd") {
				$convert2 = $a * 36;
			} elseif ($b == "cm") {
				$convert2 = $a * 0.393701;
			} elseif ($b == "m") {
				$convert2 = $a * 39.3701;
			} elseif ($b == "mm") {
				$convert2 = $a * 0.0393701;
			}
			return $convert2;
		}
		function convert_feet($c, $d)
		{
			if ($c == "ft") {
				$convert = $d * 1;
			} elseif ($c == "in") {
				$convert = $d * 0.0833333;
			} elseif ($c == "yd") {
				$convert = $d * 3;
			} elseif ($c == "cm") {
				$convert = $d * 0.0328084;
			} elseif ($c == "m") {
				$convert = $d * 3.28084;
			} elseif ($c == "mm") {
				$convert = $d * 0.00328084;
			}
			return $convert;
		}
		function captain($q, $r)
		{
			if ($q == "sq ft") {
				$ans = $r * 144;
			} else if ($q == "sq m") {
				$ans = $r * 1550;
			} else if ($q == "sq yd") {
				$ans = $r * 9;
			} else if ($q == "sq in") {
				$ans = $r * 1;
			} else if ($q == "sq cm") {
				$ans = $r * 0.155;
			}
			return $ans;
		}
		if ($calculation_unit == "1") {
			if (is_numeric($area_length) && is_numeric($area_width)) {
				$area_length_value = convert_inches($area_length, $area_length_unit);
				$area_width_value = convert_inches($area_width, $area_width_unit);
				$a1 = $area_length_value * $area_width_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($calculation_unit == "2") {
			if (is_numeric($total_area)) {
				$area_length_value = captain($total_area_unit, $total_area);
				$area_width_value = 1;
				$a1 = $area_length_value * $area_width_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}

		if (is_numeric($tile_length) && is_numeric($tile_width) && is_numeric($gap_size) && is_numeric($waste)) {
			$tile_length_value = convert_inches($tile_length, $tile_length_unit);
			$tile_width_value = convert_inches($tile_width, $tile_width_unit);
			$gap_size_value = convert_inches($gap_size, $gap_size_unit);
			$a2 = ($tile_length_value + $gap_size_value) * ($tile_width_value + $gap_size_value);
			$formula = $a1 / $a2;
			if ($waste != "") {
				$diff = ($waste / 100) * $formula;
				$final_formula = $formula + $diff;
			}
			//Calculate Area Size
			$size1 = convert_feet($area_length_unit, $area_length);
			$size2 = convert_feet($area_width_unit, $area_width);
			$calculate_size = $size1 * $size2;
			if ($box_size != "") {
				if ($box_size < 0) {
					$this->param['error'] = 'Please! Enter Positive Value';
					return $this->param;
				} else if (is_numeric($box_size)) {
					$calculate_box_size = $final_formula / $box_size;
					$this->param['calculate_box_size'] = $calculate_box_size;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
			if ($price != "") {
				if ($price < 0) {
					$this->param['error'] = 'Please! Enter Positive Value';
					return $this->param;
				} else if (is_numeric($price)) {
					if ($price_unit == "tile") {
						$p = $final_formula * $price;
					} else if ($price_unit == "box") {
						if (is_numeric($box_size)) {
							if ($box_size != "") {
								$p = $final_formula / $box_size;
							} else {
								$p = 0;
							}
						} else {
							$this->param['error'] = 'Please Fill Box Value';
							return $this->param;
						}
					} else if ($price_unit == "in²") {
						$p = $price * 144;
					} else if ($price_unit == "ft²") {
						$p = $price * $calculate_size;
					} else if ($price_unit == "yd²") {
						$p = $price * 0.11;
					} else if ($price_unit == "ac") {
						$p = $price * 0.0000229568;
					} else if ($price_unit == "m²") {
						$p = $price * 0.09;
					}
					$this->param['price_per_tile'] = $p;
				} else {
					$this->param['error'] = 'Enter values greater than zero';
					return $this->param;
				}
			}
			$this->param['calculate_size'] = $calculate_size;
			$this->param['formula'] = $final_formula;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// download calculator
	public function download($request)
	{

		//    dd($request->all());
		$operations = $request->input('operations');
		$first = $request->input('first');
		$f_unit = $request->input('f_unit');
		$second = $request->input('second');
		$s_unit = $request->input('s_unit');
		$third = $request->input('third');
		$t_unit = $request->input('t_unit');

		function calculate($a, $b)
		{
			if ($a == "B") {
				$convert1 = $b / 1000000;
			} elseif ($a == "kB") {
				$convert1 = $b / 1000;
			} elseif ($a == "MB") {
				$convert1 = $b * 1;
			} elseif ($a == "GB") {
				$convert1 = $b * 1000;
			} elseif ($a == "TB") {
				$convert1 = $b * 1000000;
			} elseif ($a == "PB") {
				$convert1 = $b * 1000000000;
			} elseif ($a == "EB") {
				$convert1 = $b * 1000000000000;
			} elseif ($a == "ZB") {
				$convert1 = $b * 1000000000000000;
			} elseif ($a == "YB") {
				$convert1 = $b * 1000000000000000000;
			} elseif ($a == "bit") {
				$convert1 = $b / 8000000;
			} elseif ($a == "kbit") {
				$convert1 = $b * 0.000125;
			} elseif ($a == "Mbit") {
				$convert1 = $b / 8;
			} elseif ($a == "Gbits") {
				$convert1 = $b * 125;
			} elseif ($a == "Tbit") {
				$convert1 = $b * 125000;
			} elseif ($a == "KiB") {
				$convert1 = $b * 0.001024;
			} elseif ($a == "MiB") {
				$convert1 = $b * 1.0486;
			} elseif ($a == "GiB") {
				$convert1 = $b * 1073.7;
			} elseif ($a == "TiB") {
				$convert1 = $b * 1099512;
			} elseif ($a == "PiB") {
				$convert1 = $b * 1125899907;
			} elseif ($a == "EiB") {
				$convert1 = $b * 1152921504607;
			} elseif ($a == "ZiB") {
				$convert1 = $b * 1180591620717411;
			} elseif ($a == "YiB") {
				$convert1 = $b * 1208925819614629175;
			} elseif ($a == "Kibit") {
				$convert1 = $b * 0.000128;
			} elseif ($a == "Mibit") {
				$convert1 = $b * 0.13107;
			} elseif ($a == "Gibit") {
				$convert1 = $b * 134.22;
			} elseif ($a == "Tibit") {
				$convert1 = $b * 137439;
			}
			return $convert1;
		}
		function tim($a, $b)
		{
			if ($a == "sec") {
				$times = $b * 1;
			} elseif ($a == "min") {
				$times = $b * 60;
			} elseif ($a == "hrs") {
				$times = $b * 3600;
			} elseif ($a == "days") {
				$times = $b * 86400;
			} elseif ($a == "wks") {
				$times = $b * 604800;
			} elseif ($a == "mos") {
				$times = $b * 2629800;
			} elseif ($a == "yrs") {
				$times = $b * 31557600;
			}
			return $times;
		}
		if ($operations == "1") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($first > 0) {
					if ($second > 0) {
						$first = calculate($f_unit, $first);
						$second = calculate($s_unit, $second);
						$jawab = $first / $second;
						$bandwidth[0] = "28800";
						$bandwidth[1] = "56000";
						$bandwidth[2] = "256000";
						$bandwidth[3] = "512000";
						$bandwidth[4] = "1000000";
						$bandwidth[5] = "2000000";
						$bandwidth[6] = "8000000";
						$bandwidth[7] = "24000000";
						$bandwidth[8] = "10000000";
						$bandwidth[9] = "100000000";
						$bandwidth[10] = "7200000";
						$bandwidth[11] = "80000000";
						$bandwidth[12] = "1000000000";
						for ($x = 0; $x < count($bandwidth); $x++) {
							$filetime = (($first * 1024) * 8) / $bandwidth[$x];
							$hourmod = $filetime % 3600;
							$hour = floor($filetime / 3600);
							$minute = floor($hourmod / 60);
							$seconds = floor($filetime % 60);
							if ($hour <= 9) {
								$hour = "0" . $hour;
							}
							if ($minute <= 9) {
								$minute = "0" . $minute;
							}
							if ($seconds <= 9) {
								$seconds = "0" . $seconds;
							}
							$table_ans[] = $hour . ":" . $minute . ":" . $seconds . "";
						}
						$this->param['f1'] = $table_ans[0];
						$this->param['f2'] = $table_ans[1];
						$this->param['f3'] = $table_ans[2];
						$this->param['f4'] = $table_ans[3];
						$this->param['f5'] = $table_ans[4];
						$this->param['f6'] = $table_ans[5];
						$this->param['f7'] = $table_ans[6];
						$this->param['f8'] = $table_ans[7];
						$this->param['f9'] = $table_ans[8];
						$this->param['f10'] = $table_ans[9];
						$this->param['f11'] = $table_ans[10];
						$this->param['f12'] = $table_ans[11];
						$this->param['f13'] = $table_ans[12];
					} else {
						$this->param['error'] = 'Please enter a positive download speed.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please input a file size greater than 0.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "2") {
			if (is_numeric($first) && is_numeric($third)) {
				if ($first > 0) {
					if ($second > 0) {
						$first = calculate($f_unit, $first);
						$third = tim($t_unit, $third);
						$jawab = $first / $third;
					} else {
						$this->param['error'] = 'Please enter a download time greater than 0.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please input a file size greater than 0.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "3") {
			if (is_numeric($second) && is_numeric($third)) {
				if ($second > 0) {
					if ($third > 0) {
						$second = calculate($s_unit, $second);
						$third = tim($t_unit, $third);
						$jawab = $second * $third;
					} else {
						$this->param['error'] = 'Please enter a download time greater than 0.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please enter a positive download speed.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		}
		$jawab = round($jawab);
		$this->param['jawab'] = $jawab;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Tank Volume calculator
	public function tank($request)
	{
		$operations = $request->input('operations');
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$four = $request->input('four');
		$units1 = $request->input('units1');
		$units2 = $request->input('units2');
		$units3 = $request->input('units3');
		$units4 = $request->input('units4');
		$fill_units = $request->input('fill_units');
		$fill = $request->input('fill');
		// dd($request->input());
		function inches_con($a, $b)
		{
			if ($b == "ft") {
				$ins = $a * 12;
			} elseif ($b == "in") {
				$ins = $a * 1;
			} elseif ($b == "cm") {
				$ins = $a / 2.54;
			} elseif ($b == "m") {
				$ins = $a * 39.37;
			} elseif ($b == "mm") {
				$ins = $a / 25.4;
			}
			return $ins;
		}
		if ($operations == "3") {
			if (is_numeric($first) && is_numeric($second)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$r = $second / 2;
				$sq_r = pow($r, 2);
				$v_tank = 3.14 * $sq_r * $first;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					if ($fill <= $second) {
						$a_ans1 = $r - $fill;
						$f_ans1 = $a_ans1 / $r;
						$acoc_ans = acos($f_ans1);
						$angle_ans = 2 * $acoc_ans;
						$sin_ans = sin($angle_ans);
						$angle_sin = $angle_ans - $sin_ans;
						$v_fill = 0.5 * $sq_r * $angle_sin * $first;
						// if ($fill < $r) {
						// 	$v_fill=$v_segment;
						// }else if($fill > $r){
						// 	$v_fill=$v_tank - $v_segment;
						// }
						$per1 = $fill / $second;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] =  'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($second)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$r = $second / 2;
				$sq_r = pow($r, 2);
				$v_tank = 3.14 * $sq_r * $first;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					if ($fill <= $first) {
						$v_fill = 3.14 * $sq_r * $fill;
						$per1 = $fill / $first;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] = 'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				$v_tank = $first * $second * $third;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					if ($fill <= $first) {
						$v_fill = $second * $third * $fill;
						$per1 = $fill / $first;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] = 'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "6") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				if ($second > $first) {
					$r = $first / 2;
					$sq_r = pow($r, 2);
					$a = $second - $first;
					$w = $a - $first;
					$ra = 2 * $r * $a;
					$pi_sqr = 3.14 * $sq_r;
					$v_tank = ($pi_sqr + $ra) * $third;
					if (is_numeric($fill)) {
						$fill = inches_con($fill, $fill_units);
						if ($fill <= $first) {
							$a_ans1 = $r - $fill;
							$f_ans1 = $a_ans1 / $r;
							$acoc_ans = acos($f_ans1);
							$angle_ans = 2 * $acoc_ans;
							$sin_ans = sin($angle_ans);
							$angle_sin = $angle_ans - $sin_ans;
							$v_segment = 0.5 * $sq_r * $angle_sin * $third;
							$v_fill3 = $a * $third * $fill;
							$v_fill = $v_segment + $v_fill3;
							$per1 = $fill / $first;
							$per_ans = $per1 * 100;
						} else {
							$this->param['error'] = 'It seems your tank is over filled.';
							return $this->param;
						}
					}
				} else {
					$this->param['error'] = 'Width must be greater than height';
					return $this->param;
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "7") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				if ($first > $second) {
					$r = $second / 2;
					$sq_r = pow($r, 2);
					$a = $first - $second;
					$h_r = $first - $r;
					$ra = 2 * $r * $a;
					$pi_sqr = 3.14 * $sq_r;
					$v_tank = ($pi_sqr + $ra) * $third;
					if (is_numeric($fill)) {
						$fill = inches_con($fill, $fill_units);
						if ($fill <= $first) {
							if ($fill < $r) {
								$a_ans1 = $r - $fill;
								$f_ans1 = $a_ans1 / $r;
								$acoc_ans = acos($f_ans1);
								$angle_ans = 2 * $acoc_ans;
								$sin_ans = sin($angle_ans);
								$angle_sin = $angle_ans - $sin_ans;
								$v_segment = 0.5 * $sq_r * $angle_sin * $third;
								if ($fill < $r) {
									$v_fill = $v_segment;
								} else if ($fill > $r) {
									$v_fill = $v_tank - $v_segment;
								}
							} else if ($fill > $r && $fill < $a) {
								$f_r = $fill - $r;
								$v_fill_1 = 0.5 * 3.14 * $sq_r * $third;
								$v_fill_2 = $f_r * $third * $second;
								$v_fill = $v_fill_1 + $v_fill_2;
							} else if ($h_r < $first && $fill < $first) {
								$a_ans1 = $r - $fill;
								$f_ans1 = $a_ans1 / $r;
								$acoc_ans = acos($f_ans1);
								$angle_ans = 2 * $acoc_ans;
								$sin_ans = sin($angle_ans);
								$angle_sin = $angle_ans - $sin_ans;
								$v_segment = (3.14 * $sq_r * $third) - (0.5 * $sq_r * $angle_sin * $third);
								// $v_segment=0.5 * $sq_r * $angle_sin * $third;
								$v_fill = $v_tank - $v_segment;
							}
							$per1 = $fill / $first;
							$per_ans = $per1 * 100;
						} else {
							$this->param['error'] = 'It seems your tank is over filled.';
							return $this->param;
						}
					}
				} else {
					$this->param['error'] = 'Height must be greater than Width';
					return $this->param;
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "8") {
			if (is_numeric($first) && is_numeric($second)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$r = $second / 2;
				$sq_r = pow($r, 2);
				$pi_sqr = 3.14 * $sq_r;
				$ra = 1.33333333333 * $r;
				$ra_a = $ra + $first;
				$v_tank = $pi_sqr * $ra_a;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					if ($fill <= $second) {
						$a_ans1 = $r - $fill;
						$f_ans1 = $a_ans1 / $r;
						$acoc_ans = acos($f_ans1);
						$angle_ans = 2 * $acoc_ans;
						$sin_ans = sin($angle_ans);
						$angle_sin = $angle_ans - $sin_ans;
						$v_segment = 0.5 * $sq_r * $angle_sin * $first;
						if ($fill < $second) {
							$v_fill2 = $v_segment;
						} else if ($fill > $r) {
							$v_fill2 = $v_tank - $v_segment;
						}
						$sq_fill = pow($fill, 2);
						$pi_fill = 3.14 * $sq_fill;
						$step1_ans = $pi_fill / 3;
						$d1 = 1.5 * $second;
						$step2_ans = $d1 - $fill;
						$step_ans = $step1_ans * $step2_ans;
						$v_fill = $v_fill2 + $step_ans;
						$per1 = $fill / $second;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] = 'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "9") {
			if (is_numeric($first) && is_numeric($second)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$r = $second / 2;
				$sq_r = pow($r, 2);
				$pi_sqr = 3.14 * $sq_r;
				$ra = 1.33333333333 * $r;
				$ra_a = $ra + $first;
				$v_tank = $pi_sqr * $ra_a;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					$conditon = $first + $second;
					$r_length = $r + $first;
					if ($fill <= $conditon) {
						if ($fill < $r) {
							$sq_fill = pow($fill, 2);
							$pi_fill = 3.14 * $sq_fill;
							$step1_ans = $pi_fill / 3;
							$d1 = 1.5 * $second;
							$step2_ans = $d1 - $fill;
							$v_fill = $step1_ans * $step2_ans;
						} else if ($fill > $r && $fill < $r_length) {
							$sq_c = pow($r, 3);
							$stepans = $fill - $r;
							$v_fill = 0.6666666666 * 3.14 * $sq_c + 3.14 * $sq_r * $stepans;
						} else if ($r_length < $fill) {
							$sq_fill = pow($fill, 2);
							$pi_fill = 3.14 * $sq_fill;
							$step1_ans = $pi_fill / 3;
							$d1 = 1.5 * $second;
							$step_ans = $first + $second - $fill;
							$step3 = $d1 - $step_ans;
							$final_step = $step1_ans * $step3;
							$v_fill = $v_tank - $final_step;
						}
						$per1 = $fill / $conditon;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] = 'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "12") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				$h4 = $first / 4;
				$v_tank = 3.14 * $second * $third * $h4;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					if ($fill <= $first) {
						$w4 = $second / 4;
						$sq_fill = pow($fill, 2);
						$sq_h = pow($first, 2);
						$square_f = $fill / $first;
						$square_s = $sq_fill / $sq_h;
						$sq_ans = 4 * $square_f - 4 * $square_s;
						$square_ans = sqrt($sq_ans);
						$fh = 2 * $square_f;
						$ans_1 = 1 - $fh;
						$a_ans_1 = acos($ans_1);
						$answer1 = $a_ans_1 - $ans_1;
						$final_ans2 = $answer1 * $square_ans;
						$v_fill = $first * $third * $w4 * $final_ans2;
						if ($v_fill < 0) {
							$v_fill = $v_fill * -1;
						}
						$per1 = $fill / $first;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] = 'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "13") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				$four = inches_con($four, $units4);
				if ($first > $second) {

					// cylinder volume

					$R_top = $first / 2;
					$sq_Rtop = pow($R_top, 2);
					$v_cylinder = 3.14 * $sq_Rtop * $third;

					// volume frustum 

					$R_bot = $second / 2;
					$sq_Rbot = pow($R_bot, 2);
					$main_part = $sq_Rtop + $R_top * $R_bot + $sq_Rbot;
					$v_frustum = 0.3333333333 * 3.14 * $four * $main_part;

					// volume tank 

					$v_tank = $v_frustum + $v_cylinder;
					if (is_numeric($fill)) {
						if ($fill <= $four) {
							$diff = $first - $second;
							$z2 = $second / $diff;
							$z = $four * $z2;
							$fill_z = $fill + $z;
							$con_z = $four + $z;
							$diff2 = $fill_z / $con_z;
							$R = 0.5 * $first * $diff2;
							$square_R = pow($R, 2);
							$Answ = $square_R + $R * $R_bot + $sq_Rbot;
							$v_fill = 0.333333333 * 3.14 * $four * $Answ;
							$per1 = $fill / $four;
							$per_ans = $per1 * 100;
						} else if ($fill > $four) {
							$radi = $first - $second;
							$radius = $radi / 2;
							$radius_sq = pow($radius, 2);
							$ans1 = $fill - $four;
							$c_volume = 3.14 * $radius_sq * $ans1;
							$v_fill = $v_frustum + $c_volume;
						}
					}
				} else {
					$this->param['error'] = 'Top diameter should be bigger than bottom diameter.';
					return $this->param;
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "14") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				$four = inches_con($four, $units4);
				if ($second > $first) {
					$R_top = $first / 2;
					$sq_Rtop = pow($R_top, 2);
					$v_cylinder = 3.14 * $sq_Rtop * $third;
					$R_bot = $second / 2;
					$sq_Rbot = pow($R_bot, 2);
					$main_part = $sq_Rtop + $R_top * $R_bot + $sq_Rbot;
					$v_frustum = 0.3333333333 * 3.14 * $four * $main_part;
					$v_tank = $v_frustum + $v_cylinder;
					if (is_numeric($fill)) {
						if ($fill <= $four) {
							$diff = $first - $second;
							$z2 = $second / $diff;
							$z = $four * $z2;
							$fill_z = $fill + $z;
							$con_z = $four + $z;
							$diff2 = $fill_z / $con_z;
							$R = 0.5 * $first * $diff2;
							$square_R = pow($R, 2);
							$Answ = $square_R + $R * $R_bot + $sq_Rbot;
							$v_fill = 0.333333333 * 3.14 * $four * $Answ;
							$per1 = $fill / $four;
							$per_ans = $per1 * 100;
						} else if ($fill > $four) {
							$radi = $first - $second;
							$radius = $radi / 2;
							$radius_sq = pow($radius, 2);
							$ans1 = $fill - $four;
							$c_volume = 3.14 * $radius_sq * $ans1;
							$v_fill = $v_frustum + $c_volume;
						}
					}
				} else {
					$this->param['error'] = 'Bottom diameter should be bigger than top diameter.';
					return $this->param;
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "15") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$first = inches_con($first, $units1);
				$second = inches_con($second, $units2);
				$third = inches_con($third, $units3);
				if ($first > $second) {
					$R_top = $first / 2;
					$sq_Rtop = pow($R_top, 2);
					$R_bot = $second / 2;
					$sq_Rbot = pow($R_bot, 2);
					$main_part = $sq_Rtop + $R_top * $R_bot + $sq_Rbot;
					$v_tank = 0.3333333333 * 3.14 * $third * $main_part;
					if (is_numeric($fill)) {
						$fill = inches_con($fill, $fill_units);
						if ($fill <= $first) {
							$diff = $first - $second;
							$z2 = $second / $diff;
							$z = $third * $z2;
							$fill_z = $fill + $z;
							$con_z = $z + $third;
							$fill_con = $fill_z / $con_z;
							$R = 0.5 * $first * $fill_con;
							$square_R = pow($R, 2);
							$Answ = $square_R + $R * $R_bot + $sq_Rbot;
							$v_fill = 0.333333333 * 3.14 * $third * $Answ;
							$per1 = $fill / $four;
							$per_ans = $per1 * 100;
						} else {
							$this->param['error'] = 'It seems your tank is over filled.';
							return $this->param;
						}
					}
				} else {
					$this->param['error'] = 'Top diameter should be bigger than bottom diameter.';
					return $this->param;
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		} else if ($operations == "16") {
			if (is_numeric($first)) {
				$first = inches_con($first, $units1);
				$r = $first / 2;
				$cube_r = pow($r, 3);
				$v_tank = 1.333333333 * 3.14 * $cube_r;
				if (is_numeric($fill)) {
					$fill = inches_con($fill, $fill_units);
					if ($fill < $first) {
						$r2 = $fill / 2;
						$cube_r2 = pow($r2, 3);
						$v_fill = 1.333333333 * 3.14 * $cube_r2;
						// $v_fill=3.14 * $r * $fill;
						$per1 = $fill / $four;
						$per_ans = $per1 * 100;
					} else {
						$this->param['error'] = 'It seems your tank is over filled.';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] =  'It seems your tank is over filled.';
				return $this->param;
			}
		}
		if (!empty($v_tank)) {
			$v_liter = $v_tank / 61.024;
			$v_feet = $v_tank / 1728;
			$v_meter = $v_tank / 61024;
			$us_gallons = $v_tank / 231;
			$v_yard = $v_tank / 46656;
			$v_cm = $v_tank * 16.387;
		}
		if (!empty($v_fill)) {
			$v_liter_fill = $v_fill / 61.024;
			$v_feet_fill = $v_fill / 1728;
			$v_meter_fill = $v_fill / 61024;
			$us_gallons_fill = $v_fill / 231;
			$v_yard_fill = $v_fill / 46656;
			$v_cm_fill = $v_fill * 16.387;
		}
		if (!empty($v_tank)) {
			$this->param['v_tank'] = $v_tank;
			$this->param['v_feet'] = $v_feet;
			$this->param['v_liter'] = $v_liter;
			$this->param['v_meter'] = $v_meter;
			$this->param['us_gallons'] = $us_gallons;
			$this->param['v_yard'] = $v_yard;
			$this->param['v_cm'] = $v_cm;
		}
		if (!empty($v_fill)) {
			$this->param['v_fill'] = $v_fill;
			$this->param['v_feet_fill'] = $v_feet_fill;
			$this->param['v_liter_fill'] = $v_liter_fill;
			$this->param['v_meter_fill'] = $v_meter_fill;
			$this->param['us_gallons_fill'] = $us_gallons_fill;
			$this->param['v_yard_fill'] = $v_yard_fill;
			$this->param['v_cm_fill'] = $v_cm_fill;
			$this->param['per_ans'] = $per_ans;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Batting Average calculator
	public function batting($request)
	{
		$operations = $request->input('operations');
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$four = $request->input('four');
		$five = $request->input('five');
		$fiveb = $request->input('fiveb');
		$seven = $request->input('seven');
		$eight = $request->input('eight');
		$nine = $request->input('nine');
		$ten = $request->input('ten');
		$quantity = $request->input('quantity');

		if ($operations == "3") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$a1 = $second - $third;
				$batting = $first / $a1;
				$heading = "Cricket Batting Average";
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($first != 0) {
					$batting = $second / $first;
					$heading = "Batting Average";
				} else {
					$this->param['error'] = 'At Bats cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five)) {
				$a1_ans = $second + $third + $four;
				$a2_ans = $first + $third + $four + $five;
				if ($a2_ans != 0) {
					$batting = $a1_ans / $a2_ans;
					$heading = "On Base Percentage";
				} else {
					$batting = 0;
					$heading = "On Base Percentage";
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "6") {
			if (is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($first)) {
				if ($first != 0) {
					$d2 = $third * 2;
					$t3 = $four * 3;
					$h4 = $five * 4;
					$a1_ans = $second + $d2 + $t3 + $h4;
					$batting = $a1_ans / $first;
					$heading = "Slugging Percentage";
				} else {
					$this->param['error'] = 'At Bats cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "7") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($fiveb) && is_numeric($quantity) && is_numeric($seven) && is_numeric($eight)) {
				if ($eight != 0) {
					$d2 = $second * 2;
					$t3 = $third * 3;
					$h4 = $four * 4;
					$TB = $first + $d2 + $t3 + $h4;
					$SLG = $TB / $eight;
					$OBP_T = $five + $quantity + $seven;
					$OBP_D = $eight + $quantity + $fiveb + $seven;
					$OBP = $OBP_T / $OBP_D;
					if ($OBP_D != 0) {
						$batting = $OBP + $SLG;
						$heading = "On-Base Plus Slugging";
					} else {
						$batting = 0;
						$heading = "On-Base Plus Slugging";
					}
				} else {
					$this->param['error'] = 'At Bats cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "8") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($fiveb) && is_numeric($quantity) && is_numeric($seven)) {
				if ($first != 0) {
					$NIBB = $second * 0.72;
					$HBP = $third * 0.72;
					$B1 = $four * 0.90;
					$RBOE = $seven * 0.92;
					$B2 = $five * 1.24;
					$B3 = $quantity * 1.56;
					$HR = $fiveb * 1.95;
					$top_part = $NIBB + $HBP + $B1 + $RBOE + $B2 + $B3 + $HR;
					$batting = $top_part / $first;
					$heading = "Weighted On Base Average";
				} else {
					$this->param['error'] = 'Appearances cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "9") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five)) {
				$b_top = $second - $third;
				$b_down = $first - $five - $third + $four;
				if ($b_down != 0) {
					$batting = $b_top / $b_down;
					$heading = "Batting Average on Balls in Play";
				} else {
					$batting = 0;
					$heading = "Batting Average on Balls in Play";
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "10") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four)) {
				if ($first != 0) {
					$t2 = $third * 2;
					$h3 = $four * 3;
					$top_ans = $second + $t2 + $h3;
					$batting = $top_ans / $first;
					$heading = "Isolated Power";
				} else {
					$this->param['error'] = 'At Bats cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "11") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($quantity) && is_numeric($fiveb) && is_numeric($seven) && is_numeric($eight) && is_numeric($nine) && is_numeric($ten)) {
				$f_part = $second + $third - $ten + $five - $quantity;

				$s2_part = $third - $fiveb + $five;
				$s3_part = 0.26 * $s2_part;
				$s_part = $four + $s3_part;

				$t2_part = $seven + $eight + $nine;
				$t_part = 0.52 * $t2_part;

				$down_part = $first + $third + $five + $seven + $eight;
				$top_part = $f_part * $s_part + $t_part;
				if ($down_part != 0) {
					$batting = $top_part / $down_part;
					$heading = "Runs Created";
				} else {
					$batting = 0;
					$heading = "Runs Created";
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "12") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($quantity)) {
				if ($quantity != 0) {
					$f_part = $first - $second;
					$l_part = $four - $five;
					$top_part = $third + $f_part + $l_part;
					$batting = $top_part / $quantity;
					$heading = "Secondary Average";
				} else {
					$this->param['error'] = 'At Bats cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "13") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four)) {
				$d2 = $second * 2;
				$t3 = $third * 3;
				$h4 = $four * 4;
				$batting = $first + $d2 + $t3 + $h4;
				$heading = "Total Bases";
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "14") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($second != 0) {
					$batting = $first / $second;
					$heading = "At Bats per Home Run";
				} else {
					$this->param['error'] = 'Home Runs cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "15") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$top_part = $first + $second;
				$down_part = $first + $second + $third;
				if ($down_part != 0) {
					$batting = $top_part / $down_part;
					$heading = "Fielding Percentage";
				} else {
					$batting = 0;
					$heading = "Fielding Percentage";
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "16") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				if ($first != 0) {
					$top_part = $second + $third;
					$batting = $top_part / $first;
					$heading = "Range Factor Per Games Played";
				} else {
					$this->param['error'] = 'Games Played cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "17") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				if ($first != 0) {
					$t_part = $second + $third;
					$top_part = 9 * $t_part;
					$batting = $top_part / $first;
					$heading = "Range Factor Per 9 Innings";
				} else {
					$this->param['error'] = 'Innings Played cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "18") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($second != 0) {
					$top_part = 9 * $first;
					$batting = $top_part / $second;
					$heading = "ERA";
				} else {
					$this->param['error'] = 'Innings Pitched cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "19") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				if ($third != 0) {
					$top_part = $first + $second;
					$batting = $top_part / $third;
					$heading = "WHIP";
				} else {
					$this->param['error'] = 'Innings Pitched cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "20") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($first != 0) {
					$top_part = $second / $first;
					$batting = 9 * $top_part;
					$heading = "Hits Allowed Per 9 Innings";
				} else {
					$this->param['error'] = 'Innings Pitched cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "21") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($first != 0) {
					$top_part = $second / $first;
					$batting = 9 * $top_part;
					$heading = "Home Runs Allowed Per 9 Innings";
				} else {
					$this->param['error'] = 'Innings Pitched cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "22") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($first != 0) {
					$top_part = $second / $first;
					$batting = 9 * $top_part;
					$heading = "Strikeouts Per 9 Innings";
				} else {
					$this->param['error'] = 'Innings Pitched cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "23") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($first != 0) {
					$top_part = $second / $first;
					$batting = 9 * $top_part;
					$heading = "Walks Per 9 Innings";
				} else {
					$this->param['error'] = 'Innings Pitched cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "24") {
			if (is_numeric($first) && is_numeric($second)) {
				if ($second != 0) {
					$batting = $first / $second;
					$heading = "Strikeout-to-Walk Ratio";
				} else {
					$this->param['error'] = 'Walks cannot be zero';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		}
		$batting = number_format($batting, 3);
		$this->param['batting'] = $batting;
		$this->param['heading'] = $heading;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// data transfer calculator
	public function data($request)
	{
		// dd($request->all());
		$first = $request->input('first');
		$f_unit = $request->input('f_unit');
		$second = $request->input('second');
		$s_unit = $request->input('s_unit');
		$kilo = $request->input('kilo');
		$overhead = $request->input('overhead');

		function calculate_hazar($a, $b)
		{
			if ($a == "1") {
				$convert1 = $b / 1000000;
			} elseif ($a == "2") {
				$convert1 = $b / 1000;
			} elseif ($a == "3") {
				$convert1 = $b * 1;
			} elseif ($a == "4") {
				$convert1 = $b * 1000;
			} elseif ($a == "5") {
				$convert1 = $b * 1000000;
			} elseif ($a == "6") {
				$convert1 = $b * 1000000000;
			} elseif ($a == "7") {
				$convert1 = $b * 1000000000000;
			} elseif ($a == "8") {
				$convert1 = $b * 1000000000000000;
			} elseif ($a == "9") {
				$convert1 = $b * 1000000000000000000;
			} elseif ($a == "10") {
				$convert1 = $b / 8000000;
			} elseif ($a == "11") {
				$convert1 = $b * 0.000125;
			} elseif ($a == "12") {
				$convert1 = $b / 8;
			} elseif ($a == "13") {
				$convert1 = $b * 125;
			} elseif ($a == "14") {
				$convert1 = $b * 125000;
			} elseif ($a == "15") {
				$convert1 = $b * 0.001024;
			} elseif ($a == "16") {
				$convert1 = $b * 1.0486;
			} elseif ($a == "17") {
				$convert1 = $b * 1073.7;
			} elseif ($a == "18") {
				$convert1 = $b * 1099512;
			} elseif ($a == "19") {
				$convert1 = $b * 1125899907;
			} elseif ($a == "20") {
				$convert1 = $b * 1152921504607;
			} elseif ($a == "21") {
				$convert1 = $b * 1180591620717411;
			} elseif ($a == "22") {
				$convert1 = $b * 1208925819614629175;
			} elseif ($a == "23") {
				$convert1 = $b * 0.000128;
			} elseif ($a == "24") {
				$convert1 = $b * 0.13107;
			} elseif ($a == "25") {
				$convert1 = $b * 134.22;
			} elseif ($a == "26") {
				$convert1 = $b * 137439;
			}
			return $convert1;
		}
		function calculate_hazar24($a, $b)
		{
			if ($a == "1") {
				$convert1 = $b / 1000024;
			} elseif ($a == "2") {
				$convert1 = $b / 1024;
			} elseif ($a == "3") {
				$convert1 = $b * 1;
			} elseif ($a == "4") {
				$convert1 = $b * 1024;
			} elseif ($a == "5") {
				$convert1 = $b * 1000024;
			} elseif ($a == "6") {
				$convert1 = $b * 1000000024;
			} elseif ($a == "7") {
				$convert1 = $b * 1000000000024;
			} elseif ($a == "8") {
				$convert1 = $b * 1000000000000024;
			} elseif ($a == "9") {
				$convert1 = $b * 1000000000000000024;
			} elseif ($a == "10") {
				$convert1 = $b / 8000024;
			} elseif ($a == "11") {
				$convert1 = $b * 0.000125;
			} elseif ($a == "12") {
				$convert1 = $b / 8;
			} elseif ($a == "13") {
				$convert1 = $b * 125;
			} elseif ($a == "14") {
				$convert1 = $b * 125024;
			} elseif ($a == "15") {
				$convert1 = $b * 0.001024;
			} elseif ($a == "16") {
				$convert1 = $b * 1.0486;
			} elseif ($a == "17") {
				$convert1 = $b * 1073.7;
			} elseif ($a == "18") {
				$convert1 = $b * 1099512;
			} elseif ($a == "19") {
				$convert1 = $b * 1125899907;
			} elseif ($a == "20") {
				$convert1 = $b * 1152921504607;
			} elseif ($a == "21") {
				$convert1 = $b * 1180591620717411;
			} elseif ($a == "22") {
				$convert1 = $b * 1208925819614629175;
			} elseif ($a == "23") {
				$convert1 = $b * 0.000128;
			} elseif ($a == "24") {
				$convert1 = $b * 0.13107;
			} elseif ($a == "25") {
				$convert1 = $b * 134.22;
			} elseif ($a == "26") {
				$convert1 = $b * 137439;
			}
			return $convert1;
		}
		function format_time($t, $f = ':') // t = seconds, f = separator 
		{
			return sprintf("%02d%s%02d%s%02d", floor($t / 3600), $f, ($t / 60) % 60, $f, $t % 60);
		}
		if (is_numeric($first) && is_numeric($second)) {
			if ($kilo == "1") {
				$first = calculate_hazar24($f_unit, $first);
				$second = calculate_hazar24($s_unit, $second);
			} elseif ($kilo == "2") {
				$first = calculate_hazar($f_unit, $first);
				$second = calculate_hazar($s_unit, $second);
			}
			if ($overhead == "1") {
				$first = $first;
			} elseif ($overhead == "2") {
				$first = (0.05 * $first) + $first;
			} elseif ($overhead == "3") {
				$first = (0.1 * $first) + $first;
			} elseif ($overhead == "4") {
				$first = (0.2 * $first) + $first;
			} elseif ($overhead == "5") {
				$first = (0.3 * $first) + $first;
			} elseif ($overhead == "6") {
				$first = (0.4 * $first) + $first;
			} elseif ($overhead == "7") {
				$first = (0.5 * $first) + $first;
			}
			if ($first > 0) {
				if ($second > 0) {
					$jawab = $first / $second;
					$bandwidth[0] = "1.544";
					$bandwidth[1] = "10";
					$bandwidth[2] = "100";
					$bandwidth[3] = "1000";
					$bandwidth[4] = "10240";
					$bandwidth[5] = "480";
					$bandwidth[6] = "5120";
					$bandwidth[7] = "10240";
					$bandwidth[8] = "20480";
					for ($x = 0; $x < count($bandwidth); $x++) {
						$filetime = (($first * 1024) * 8) / ($bandwidth[$x] * 1024);
						$hourmod = $filetime % 3600;
						$hour = floor($filetime / 3600);
						$minute = floor($hourmod / 60);
						$seconds = floor($filetime % 60);
						if ($hour <= 9) {
							$hour = "0" . $hour;
						}
						if ($minute <= 9) {
							$minute = "0" . $minute;
						}
						if ($seconds <= 9) {
							$seconds = "0" . $seconds;
						}
						$table_ans[] = $hour . ":" . $minute . ":" . $seconds . " ";
					}
					$this->param['f1'] = $table_ans[0];
					$this->param['f2'] = $table_ans[1];
					$this->param['f3'] = $table_ans[2];
					$this->param['f4'] = $table_ans[3];
					$this->param['f5'] = $table_ans[4];
					$this->param['f6'] = $table_ans[5];
					$this->param['f7'] = $table_ans[6];
					$this->param['f8'] = $table_ans[7];
					$this->param['f9'] = $table_ans[8];
				} else {
					$this->session->set_flashdata('data', 'Please enter a positive download speed.');
					return $this->param;
				}
			} else {
				$this->session->set_flashdata('data', 'Please input a file size greater than 0.');
				return $this->param;
			}
		} else {
			$this->session->set_flashdata('data', 'Please check your input');
			return $this->param;
		}
		$jawab = round($jawab);
		$main_ans = format_time($jawab);
		$this->param['jawab'] = $jawab;
		$this->param['main_ans'] = $main_ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// kd calculator
	public function kd($request)
	{
		$kills = $request->input('kills');
		$deaths = $request->input('deaths');
		$assists = $request->input('assists');

		if (is_numeric($kills) && is_numeric($deaths)) {
			if ($kills > 0 && $deaths > 0) {
				$kd_ratio = $kills / $deaths;
				if ($assists != "") {
					if (is_numeric($assists)) {
						if ($assists > 0) {
							$kda_ratio = ($kills + $assists) / $deaths;
							$this->param['kda_ratio'] = $kda_ratio;
						} else {
							$this->param['error'] =  'Enter Positive Value';
							return $this->param;
						}
					} else {
						$this->param['error'] =  'Please! Check Your Input';
						return $this->param;
					}
				}
				$this->param['kd_ratio'] = $kd_ratio;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] =  'Enter Positive Value';
				return $this->param;
			}
		} else {
			$this->param['error'] =  'Please! Check Your Input';
			return $this->param;
		}
	}

	// MPG calculator	
	public function mpg($request)
	{

		$type = $request->input('type');
		$operations = $request->input('operations');
		$first = $request->input('first');
		$units1 = $request->input('units1');
		$second = $request->input('second');
		$units2 = $request->input('units2');
		$third = $request->input('third');
		$units3 = $request->input('units3');
		$four = $request->input('four');
		$units4 = $request->input('units4');
		$ad_first = $request->input('ad_first');
		$ad_second = $request->input('ad_second');
		$ad_third = $request->input('ad_third');
		$ad_units3 = $request->input('ad_units3');
		$ad_four = $request->input('ad_four');
		$ad_units4 = $request->input('ad_units4');
		$currancy = $request->input('currancy');



		if ($units1 == 'km') {
			$units1 = 1;
		} else if ($units1 == 'mi') {
			$units1 = 2;
		}

		if ($units2 == 'liters') {
			$units2 = 1;
		} else if ($units2 == 'US gal') {

			$units2 = 2;
		} else if ($units2 == 'UK gal') {
			$units2 = 3;
		}

		if ($units3 == 'L/100km') {
			$units3 = 1;
		} else if ($units3 == 'US mpg') {

			$units3 = 2;
		} else if ($units3 == 'UK mpg') {

			$units3 = 3;
		} else if ($units3 == 'kmpl') {
			$units3 = 4;
		}



		if ($units4 == $currancy . 'liters') {
			$units4 = 1;
		} else if ($units4 == 'US gal') {

			$units4 = 2;
		} else if ($units4 == 'UK gal') {
			$units4 = 2;
		}




		if ($ad_units3 == 'liters') {
			$ad_units3 = 1;
		} else if ($ad_units3 == 'US gal') {

			$ad_units3 = 2;
		} else if ($ad_units3 == 'UK gal') {
			$ad_units3 = 2;
		}

		if ($ad_units4 == $currancy . 'liters') {
			$ad_units4 = 1;
		} else if ($ad_units4 == $currancy . 'US gal') {

			$ad_units4 = 2;
		} else if ($ad_units4 == $currancy . 'UK gal') {
			$ad_units4 = 2;
		}



		function calculate1($a, $b)
		{
			if ($a == "1") {
				$convert1 = $b / 1.609;
			} elseif ($a == "2") {
				$convert1 = $b * 1;
			}
			return $convert1;
		}
		// dd($units2);
		function calculate2($a, $b)
		{

			if ($a == "1") {
				$times = $b / 3.785;
			} elseif ($a == "2") {
				$times = $b * 1;
			} elseif ($a == "3") {
				$times = $b * 1.20095;
			}
			return $times;
		}
		function calculate3($a, $b)
		{
			if ($a == "1") {
				$mahiya = $b / 235.215;
			} elseif ($a == "2") {
				$mahiya = $b * 1;
			} elseif ($a == "3") {
				$mahiya = $b * 1.201;
			} elseif ($a == "4") {
				$mahiya = $b *  2.352145;
			}
			return $mahiya;
		}
		$first = calculate1($units1, $first);
		$second = calculate2($units2, $second);
		$third = calculate3($units3, $third);
		$ad_third = calculate2($ad_units3, $ad_third);
		if ($type == "first") {
			if ($operations == "1") {
				if (is_numeric($second) && is_numeric($third)) {
					$petrol = $second;
					$jawab = $second * $third;
				} else {
					$this->param['error'] =  'Please check your input';
					return $this->param;
				}
			} else if ($operations == "2") {
				if (is_numeric($first) && is_numeric($third)) {
					if ($third != 0) {
						$jawab = $first / $third;
						$petrol = $jawab;
					} else {
						$this->param['error'] =  'Fuel economy cannot be 0';
						return $this->param;
					}
				} else {
					$this->param['error'] =  'Please check your input';
					return $this->param;
				}
			} else if ($operations == "3") {
				if (is_numeric($first) && is_numeric($second)) {
					if ($second != 0) {
						$jawab = $first / $second;
						$petrol = $second;
					} else {
						$this->param['error'] =  'Fuel used cannot be 0';
						return $this->param;
					}
				} else {
					$this->param['error'] =  'Please check your input';
					return $this->param;
				}
			}
			if (is_numeric($four)) {
				if ($units4 == "1") {
					$cost1 = $petrol * 3.785;
					$cost = $cost1 * $four;
				} else if ($units4 == "2") {
					$cost = $petrol * $four;
				} else if ($units4 == "3") {
					$cost1 = $petrol / 1.201;
					$cost = $cost1 * $four;
				}
				$cost = round($cost, 3);
				$this->param['cost'] = $cost;
			}
			$this->param['jawab'] = $jawab;
		} else if ($type == "second") {
			if (is_numeric($ad_first) && is_numeric($ad_second) && is_numeric($ad_third)) {
				if ($ad_second > $ad_first) {
					if ($ad_third != 0) {
						$ad_petrol = $ad_third;
						$distance = $ad_second - $ad_first;
						$mi_jawab = $distance / $ad_third;
						$km_dis = $distance / 1.609;
						$km_jawab = $km_dis / $ad_third;
					} else {
						$this->param['error'] = 'Fuel used cannot be 0';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'End Trip must be greater than Start Trip';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
			if (is_numeric($ad_four)) {
				if ($ad_units4 == "1") {
					$ad_cost1 = $ad_petrol * 3.785;
					$ad_cost = $ad_cost1 * $ad_four;
				} else if ($ad_units4 == "2") {
					$ad_cost = $ad_petrol * $ad_four;
				} else if ($ad_units4 == "3") {
					$ad_cost1 = $ad_petrol / 1.201;
					$ad_cost = $ad_cost1 * $ad_four;
				}
				$ad_cost = round($ad_cost, 3);
				$this->param['ad_cost'] = $ad_cost;
			}
			$this->param['distance'] = $distance;
			$this->param['km_dis'] = $km_dis;
			$this->param['mi_jawab'] = $mi_jawab;
			$this->param['km_jawab'] = $km_jawab;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// pipe volume calculator
	public function pipe($request)
	{
		$inner_diameter = $request->input('inner_diameter');
		$inner_diameter_unit = $request->input('inner_diameter_unit');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$density = $request->input('density');
		$density_unit = $request->input('density_unit');

		function convert_inches2($unit, $value)
		{
			if ($unit == "cm") {
				$val1 = $value * 0.393701;
			} else if ($unit == "m") {
				$val1 = $value * 39.3701;
			} else if ($unit == "in") {
				$val1 = $value * 1;
			} else if ($unit == "ft") {
				$val1 = $value * 12;
			} else if ($unit == "yd") {
				$val1 = $value * 36;
			} else if ($unit == "mm") {
				$val1 = $value * 0.0393701;
			}
			return $val1;
		}
		function convert_unit2($unit2, $value2)
		{
			if ($unit2 == "kg/m³") {
				$val2 = $value2 * 0.000036127;
			} else if ($unit2 == "kg/dm³") {
				$val2 = $value2 * 0.036127;
			} else if ($unit2 == "kg/L") {
				$val2 = $value2 * 0.036127292;
			} else if ($unit2 == "g/mL") {
				$val2 = $value2 * 0.036127292;
			} else if ($unit2 == "g/cm³") {
				$val2 = $value2 * 0.036127292;
			} else if ($unit2 == "oz/cu in") {
				$val2 = $value2 * 0.0625;
			} else if ($unit2 == "lb/cu in") {
				$val2 = $value2 * 1;
			} else if ($unit2 == "lb/cu ft") {
				$val2 = $value2 * 0.000578703704;
			} else if ($unit2 == "lb/US gal") {
				$val2 = $value2 * 0.00432900433;
			} else if ($unit2 == "g/L") {
				$val2 = $value2 * 0.00003612729;
			} else if ($unit2 == "g/dL") {
				$val2 = $value2 * 0.00036127292;
			} else if ($unit2 == "mg/L") {
				$val2 = $value2 * 3.6127292e-8;
			}
			return $val2;
		}
		if (is_numeric($inner_diameter) && is_numeric($length) && is_numeric($density)) {
			if ($inner_diameter > 0 && $length > 0) {
				$inv = convert_inches2($inner_diameter_unit, $inner_diameter);
				$lnv = convert_inches2($length_unit, $length);
				$k = $inv / 2;
				$volume = 3.14159265 * $k * $k * $lnv;
				$wv = convert_unit2($density_unit, $density);
				$weight = $volume * $wv;
				$this->param['volume'] = $volume;
				$this->param['weight'] = $weight;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Enter Positive Value';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}
	// quarium calculator
	public function aquarium($request)
	{
		$shape = $request->input('shape');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$height = $request->input('height');
		$height_unit = $request->input('height_unit');
		$fill_depth = $request->input('fill_depth');
		$fill_depth_unit = $request->input('fill_depth_unit');
		$front_pane = $request->input('front_pane');
		$front_pane_unit = $request->input('front_pane_unit');
		$end_pane = $request->input('end_pane');
		$end_pane_unit = $request->input('end_pane_unit');
		$radius = $request->input('radius');
		$radius_unit = $request->input('radius_unit');
		$radius_one = $request->input('radius_one');
		$radius_one_unit = $request->input('radius_one_unit');
		$radius_two = $request->input('radius_two');
		$radius_two_unit = $request->input('radius_two_unit');
		$long_side = $request->input('long_side');
		$long_side_unit = $request->input('long_side_unit');
		$short_side = $request->input('short_side');
		$short_side_unit = $request->input('short_side_unit');
		$len_one = $request->input('len_one');
		$len_one_unit = $request->input('len_one_unit');
		$len_two = $request->input('len_two');
		$len_two_unit = $request->input('len_two_unit');
		$wid_one = $request->input('wid_one');
		$wid_one_unit = $request->input('wid_one_unit');
		$wid_two = $request->input('wid_two');
		$wid_two_unit = $request->input('wid_two_unit');
		$full_width = $request->input('full_width');
		$full_width_unit = $request->input('full_width_unit');
		function convert_cm($value, $unit)
		{
			if ($unit == "cm") {
				$val1 = $value * 1;
			} else if ($unit == "m") {
				$val1 = $value * 100;
			} else if ($unit == "in") {
				$val1 = $value * 2.54;
			} else if ($unit == "ft") {
				$val1 = $value * 30.48;
			} else if ($unit == "yd") {
				$val1 = $value * 91.44;
			}
			return $val1;
		}
		if ($shape == "1") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($height)) {
				$lv = convert_cm($length, $length_unit);
				// dd($lv);
				$wv = convert_cm($width, $width_unit);
				$hv = convert_cm($height, $height_unit);
				$volume = $lv * $wv * $hv;
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = $lv * $wv * $fv;
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "2") {
			if (is_numeric($length)) {
				$lv = convert_cm($length, $length_unit);
				$volume = $lv * $lv * $lv;
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $length) {
							$this->param['error'] = 'The fill depth cannot be greater than the length of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = $lv * $lv * $fv;
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "3") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($height) && is_numeric($front_pane)) {
				$lv = convert_cm($length, $length_unit);
				$wv = convert_cm($width, $width_unit);
				$hv = convert_cm($height, $height_unit);
				$fr_pane = convert_cm($front_pane, $front_pane_unit);
				$volume = (($wv * $lv) - (($wv * ($lv - $fr_pane)) / 2)) * $hv;
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						echo "The value of fill depth is" . $fill_depth;
						echo "The value of height is" . $height;
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = (($wv * $lv) - (($wv * ($lv - $fr_pane)) / 2)) * $fv;
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "4" || $shape == "5") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($height) && is_numeric($front_pane) && is_numeric($end_pane)) {
				$lv = convert_cm($length, $length_unit);
				$wv = convert_cm($width, $width_unit);
				$hv = convert_cm($height, $height_unit);
				$fr_pane = convert_cm($front_pane, $front_pane_unit);
				$en_pane = convert_cm($end_pane, $end_pane_unit);
				if ($shape == "4") {
					$volume = (($wv * $lv - ($lv - $fr_pane) * ($wv - $en_pane) / 2) * $hv);
				} else if ($shape == "5") {
					$volume = 0.5 * (($wv * $lv) + ($wv * $fr_pane) + ($en_pane * $lv) - ($fr_pane * $en_pane)) * $hv;
				}
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							if ($shape == "4") {
								$filled_volume = (($wv * $lv - ($lv - $fr_pane) * ($wv - $en_pane) / 2) * $fv);
							} else if ($shape == "5") {
								$filled_volume = 0.5 * (($wv * $lv) + ($wv * $fr_pane) + ($en_pane * $lv) - ($fr_pane * $en_pane)) * $fv;
							}
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "6" || $shape == "7" || $shape == "8") {
			if (is_numeric($height) && is_numeric($radius)) {
				$hv = convert_cm($height, $height_unit);
				$ra = convert_cm($radius, $radius_unit);
				if ($shape == "6") {
					$volume = (3.1415926 * $ra * $ra) * $hv;
				} else if ($shape == "7") {
					$volume = (3.1415926 * $ra * $ra) * ($hv / 2);
				} else if ($shape == "8") {
					$volume = (3.1415926 * $ra * $ra) * ($hv / 4);
				}
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							if ($shape == "6") {
								$filled_volume = (3.1415926 * $ra * $ra) * $fv;
							} else if ($shape == "7") {
								$filled_volume = (3.1415926 * $ra * $ra) * ($fv / 2);
							} else if ($shape == "8") {
								$filled_volume = (3.1415926 * $ra * $ra) * ($fv / 4);
							}
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "9") {
			if (is_numeric($height) && is_numeric($radius_one) && is_numeric($radius_two)) {
				$hv = convert_cm($height, $height_unit);
				$r1 = convert_cm($radius_one, $radius_one_unit);
				$r2 = convert_cm($radius_two, $radius_two_unit);
				$volume = (3.14 * ($hv * $r1 * $r2));
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = (3.14 * ($r1 * $r2 * $fv));
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "10") {
			if (is_numeric($long_side) && is_numeric($short_side) && is_numeric($height)) {
				$hv = convert_cm($height, $height_unit);
				$l1 = convert_cm($long_side, $long_side_unit);
				$l2 = convert_cm($short_side, $short_side_unit);
				$volume = 0.5 * ($l1 * $l1 + 2 * $l2 * $l1 - $l2 * $l2) * $hv;
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = 0.5 * ($l1 * $l1 + 2 * $l2 * $l1 - $l2 * $l2) * $fv;
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "11") {
			if (is_numeric($len_one) && is_numeric($len_two) && is_numeric($wid_one) && is_numeric($wid_two) && is_numeric($height)) {
				$hv = convert_cm($height, $height_unit);
				$l1 = convert_cm($len_one, $len_one_unit);
				$l2 = convert_cm($len_two, $len_two_unit);
				$w1 = convert_cm($wid_one, $wid_one_unit);
				$w2 = convert_cm($wid_two, $wid_two_unit);
				$volume = ((($l1 - $w2) * $w1) + ($l2 * $w2)) * $hv;
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = ((($l1 - $w2) * $w1) + ($l2 * $w2)) * $fv;
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "12") {
			if (is_numeric($len_one) && is_numeric($len_two) && is_numeric($height)) {
				$hv = convert_cm($height, $height_unit);
				$l1 = convert_cm($len_one, $len_one_unit);
				$l2 = convert_cm($len_two, $len_two_unit);
				$volume = 0.5 * (($l1 * $l2) * $hv);
				if ($fill_depth != "") {
					if (is_numeric($fill_depth)) {
						if ($fill_depth > $height) {
							$this->param['error'] = 'The fill depth cannot be greater than the height of the aquarium.';
							return $this->param;
						} else {
							$fv = convert_cm($fill_depth, $fill_depth_unit);
							$filled_volume = 0.5 * (($l1 * $l2) * $fv);
							$this->param['filled_volume'] = $filled_volume;
						}
					} else {
						$this->param['error'] = 'Please! Check Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		} else if ($shape == "13") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($height) && is_numeric($full_width)) {
				if ($full_width > $width) {
					$lv = convert_cm($length, $length_unit);
					$wv = convert_cm($width, $width_unit);
					$hv = convert_cm($height, $height_unit);
					$fw = convert_cm($full_width, $full_width_unit);
					$lvd = $lv / 2;
					$diff = $fw - $wv;
					if ($diff <= $lvd) {
						$volume = (((3.141592653589793238 * ($lv / 2) * ($fw - $wv)) / 2) + ($lv * $wv)) * $hv;
					} else {
						$this->param['error'] = 'The difference between full width and width should be smaller or equal to half of aquarium length';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'The full width should be greater than width';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		}
		$this->param['volume'] = $volume;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Words per Minute Calculator
	public function words($request)
	{

		//   dd($request->all());
		$speak_speed = $_POST['speak_speed'];
		$ss = $_POST['ss'];
		$reading_speed = $_POST['reading_speed'];
		$rs = $_POST['rs'];
		$select = $_POST['select'];
		$words = $_POST['words'];
		$x = $_POST['x'];

		function format_time($t, $f = ':') // t = seconds, f = separator 
		{
			return sprintf("%02d%s%02d%s%02d", floor($t / 3600), $f, ($t / 60) % 60, $f, $t % 60);
		}
		if (is_numeric($ss) && is_numeric($rs)) {
			if ($ss > 0) {
				if ($rs > 0) {
					if ($select == "1") {
						if (is_numeric($words)) {
							if ($words > 0) {
								$speak_ans = $words / $ss;
								$read_ans = $words / $rs;
							} else {
								$this->param['error'] =  'The number of words must be more than 0.';
								return $this->param;
							}
						} else {
							$this->param['error'] =  'Please check your input';
							return $this->param;
						}
					} elseif ($select == "2") {
						if (!empty($x)) {
							if (str_word_count($x) > 0) {
								$para_words = str_word_count($x);
								$speak_ans = $para_words / $ss;
								$read_ans = $para_words / $rs;
								$this->param['para_words'] = $para_words;
							} else {
								$this->param['error'] =  'The number of words must be more than 0.';
								return $this->param;
							}
						} else {
							$this->param['error'] =  'Please check your input';
							return $this->param;
						}
					}
					$speak_time = format_time($speak_ans * 60);
					$read_time = format_time($read_ans * 60);
				} else {
					$this->param['error'] =  'The reading speed must be more than 0.';
					return $this->param;
				}
			} else {
				$this->param['error'] =  'The speaking speed must be more than 0.';
				return $this->param;
			}
		} else {
			$this->param['error'] =  'Please check your input';
			return $this->param;
		}
		$this->param['speak_ans'] = $speak_ans;
		$this->param['read_ans'] = $read_ans;
		$this->param['speak_time'] = $speak_time;
		$this->param['read_time'] = $read_time;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Dog Age calculator	
	public function dog($request)
	{
		$operations = $request->input('operations');
		$brd = $request->input('brd');
		$size = $request->input('size');
		$age = $request->input('age');
		$dogAge = $request->input('dogAge');
		$dogBreed = $request->input('dogBreed');
		$a = $request->input('a');
		$b = $request->input('b');
		$c = $request->input('c');

		// dd($request->input());
		if ($operations == "1") {
			if ($brd == "1") {
				if ($age > 0 && $age < 20) {
					$f_ans = 16 * log($age);
					$answer = $f_ans + 31;
				} else {
					$this->param['error'] = 'Please enter age between 1 and 20.';
					return $this->param;
				}
			} else if ($brd == "2") {
				$kuty = [
					[0, 0, 0],
					[15, 15, 15],
					[24, 24, 24],
					[28, 28, 28],
					[32, 32, 32],
					[36, 36, 36],
					[40, 42, 45],
					[44, 47, 50],
					[48, 51, 55],
					[52, 56, 61],
					[56, 60, 66],
					[60, 65, 72],
					[64, 69, 77],
					[68, 74, 82],
					[72, 78, 88],
					[76, 83, 93],
					[80, 87, 120],
					[84, 92, 120],
					[88, 96, 120],
					[92, 101, 120]
				];
				$y = [];
				if ($size == "1") {
					if ($age > 0 && $age < 20) {
						$y = explode(".", $age);
						if (count($y) == "1") {
							$dogi_age = $kuty[$age];
							$answer = $dogi_age[0];
						} else if (count($y) == "2") {
							$point = "0." . $y[1];
							$percent = $point * 100;
							$chuk = $y[0];
							$dogi_age1 = $kuty[$chuk];
							$dogi_age2 = $kuty[$chuk + 1];
							$show_baz1 = $dogi_age1[0];
							$show_baz2 = $dogi_age2[0];
							$diff = $show_baz2 - $show_baz1;
							$divide = $diff / 100;
							$multiply = $divide * $percent;
							$answer = $show_baz1 + $multiply;
						}
					} else {
						$this->param['error'] = 'Please enter age between 1 and 20.';
						return $this->param;
					}
				} else if ($size == "2") {
					if ($age > 0 && $age < 20) {
						$y = explode(".", $age);
						if (count($y) == "1") {
							$dogi_age = $kuty[$age];
							$answer = $dogi_age[1];
						} else if (count($y) == "2") {
							$point = "0." . $y[1];
							$percent = $point * 100;
							$chuk = $y[0];
							$dogi_age1 = $kuty[$chuk];
							$dogi_age2 = $kuty[$chuk + 1];
							$show_baz1 = $dogi_age1[1];
							$show_baz2 = $dogi_age2[1];
							$diff = $show_baz2 - $show_baz1;
							$divide = $diff / 100;
							$multiply = $divide * $percent;
							$answer = $show_baz1 + $multiply;
						}
					} else {
						$this->param['error'] = 'Please enter age between 1 and 20.';
						return $this->param;
					}
				} else if ($size == "3") {
					if ($age > 0 && $age < 20) {
						$y = explode(".", $age);
						if (count($y) == "1") {
							$dogi_age = $kuty[$age];
							$answer = $dogi_age[2];
						} else if (count($y) == "2") {
							$point = "0." . $y[1];
							$percent = $point * 100;
							$chuk = $y[0];
							$dogi_age1 = $kuty[$chuk];
							$dogi_age2 = $kuty[$chuk + 1];
							$show_baz1 = $dogi_age1[2];
							$show_baz2 = $dogi_age2[2];
							$diff = $show_baz2 - $show_baz1;
							$divide = $diff / 100;
							$multiply = $divide * $percent;
							$answer = $show_baz1 + $multiply;
						}
					} else {
						$this->param['error'] = 'Please enter age between 1 and 20.';
						return $this->param;
					}
				}
			}
		} else if ($operations == '2') {
			if ($dogAge != 0) {
				if ($dogBreed != "0") {
					if ($a >= 1) {
						if ($b >= 1) {
							if ($c >= 1) {
								list($dogBreed1, $dogBreed2) = explode("&&", $dogBreed);
								$breeds = [
									['Affenpinscher', 12, 14, 'affenpinscher', 'Small rodent hunting', 'Families', 'Moderate', '12-14 years', '25-27 cm', '3-4 kg', 'Curious, Playful, Active', 'Yes', 'Black, gray, silver, Black and Tan'],
									['Afghan Hound', 12, 14, 'afghan_hound', 'Coursing and hunting', 'Singles & Families', 'High', '12-14 years', '63-68 cm', '25-29 kg', 'Aloof, Happy, Independent', 'Yes', 'Black, Red, Cream'],
									['Airedale Terrier', 10, 12, 'airedale_terrier', 'Terrier Dogs', 'Small Families', 'High', '10-14 years', '58-61 cm', '23-29 kg', 'Active, Intelligent, Loyal, Hard-Working, Athletic, Confident, Proud', 'No', 'Black, Grey, White, Tan'],
									['Akita', 11, 15, 'akita', 'Working Dogs', 'Small Families, singles', 'High', '11-15 years', '61-70 cm', '38-54 kg', 'Active, loyal, willful, bold, courageous, intelligent, alert', 'No', 'Red, brindle, black, black brindle, blue brindle, brown, brown brindle, fawn, fawn brindle'],
									['Alaskan Malamute', 13, 16, 'alaskan_malamute', 'Working Dogs', 'Families', 'Medium', '12-16 years', '58-63 cm', '36-43 kg', 'Intelligent, Active, Affectionate, Gentle, Independent', 'No', 'Black, white'],
									['American Cocker Spaniel', 12, 15, 'american_cocker_spaniel', 'Sporting Group', 'Families, children', 'Medium', '12-15 years', '37-39 cm', '11-14 kg', 'Merry, Outgoing, Joyful, Trusing', 'No', 'Black, Red, Brown, Silver and Tan'],
									['American Eskimo Dog', 13, 15, 'american_eskimo', 'Circus performer', 'Families & Friends', 'High', '13-15 years', '38-48 cm', '8.2-16 kg', 'Intelligent, Protective, Reserved, Alert', 'No', 'White, Biscuit'],
									['American Foxhound', 10, 12, 'american_foxhound', 'Hound Group', 'Families', 'Low', '10-12 years', '56-64 cm', '29-34 kg', 'Kind, Loyal, Loving, Independent', 'No', 'White, White & cream, Red, Tri-color'],
									['American Staffordshire Terrier', 10, 12, 'american_staffordshire_terrier', 'Terrier Group', 'Families and children', 'Low', '12-16 years', '46-48 cm', '23-32 kg', 'Attentive, Devoted, Courageous, Loyal', 'No', 'Sable, Black, Blue, Brown'],
									['American Water Spaniel', 13, 15, 'default', 'Bird flushing and retrieving', 'Waterfowl hunters', 'Low', '13-15 years', '38-46 cm', '14-20 kg', 'Energetic, Intelligent, Protective', 'No', 'Solid liver, brown, dark chocolate'],
									['Anatolian Shepherd Dog', 13, 15, 'default', 'Working Group', 'Families and Small children', 'Low', '10-13 years', '74-81 cm', '41-68 kg', 'Steady, Bold, Confident, Proud', 'No', 'Blue Fawn, Red Fawn, White, Brindle'],
									['Australian Cattle Dog', 13, 15, 'australian_cattle_dog', 'Herding Dogs', 'Families with older children', 'High', '12-15 years', '43-51 cm', '18-22 kg', 'Loyal, Active', 'No', 'Red, Black, Chocolate, Blue, Grey'],
									['Australian Shepherd', 13, 15, 'australian_shepherd', 'Herding Dogs', 'Families', 'Medium', '13-15 years', '50 – 58 cm', '20 to 29kg', 'Affectionate, Intelligent, Protective, Good-natured, Active', 'No', 'Red merles,Black Tricolor'],
									['Australian Silky Terrier', 12, 15, 'australian_silky_terrier', 'Terrier Group', 'Person who wants adventure on a small scale', 'Moderate Maintenance', '14 – 16 years', '23 – 26cm', '3 – 5kg', 'Active, Lively, Stubborn, Mischievous', 'Yes', 'Black, Black and Tan, Blue, Blue and Tan, Blue Silver and tan, Cream, Grey, Fawn, Grey and Tan, Silver black and Tan, Silver and Platinum'],
									['Australian Terrier', 12, 15, 'australian_terrier', 'Terrier Dogs', 'Singles, families', 'Medium', 'Up to 15 years', '23 – 28 cm', '5.5 to 7 kg', 'Alert, Loyal, Spirited', 'Yes', 'Blue & Tan, Red, Sand'],
									['Basenji', 12, 16, 'basenji', 'Hound Dogs', 'Couples and singles', 'Low', '10-12 years', 'Up to 45cm', '12 kg', 'Alert, Playful, Energetic, Quiet', 'Yes', 'Black, Sand, Red, Tan'],
									['Basset Hound', 10, 12, 'basset_hound', 'Hound Dogs', 'Families, singles', 'Medium', '11-12 years', '30-38 cm', '18-27 kg', 'Intelligent, independent, social, sharp-tempered, excited', 'No', 'Black, white, brown, red'],
									['Beagle', 12, 15, 'beagle', 'Hound Dogs', 'Families', 'Medium', '12-15 years', '33-41 cm', '8-14 kg', 'Loyal, Gentle', 'Yes', 'White/brown'],
									['Bearded Collie', 14, 15, 'bearded_collie', 'Working Dog', 'Families', 'High Maintenance', '12 – 14 years', '50 – 56 cm', '20 – 25 kg', 'Self-confidence, Hardy, Lively, Alert, Intelligent, Active', 'No', 'Black, Blue, Brown, Fawn'],
									['Beauceron', 10, 12, 'default', 'Boar herding, hunting, guarding', 'Families and strangers', 'Low', '10-12 years', '63-66 cm', '32-45 kg', 'Calm, Protective, Fearless', 'No', 'Harlequin, Black with tan. Black, black and white'],
									['Belgian Shepherd', 10, 14, 'belgian_shepherd', 'Herding Group', 'Families', 'High', '10-14 years', '61-66 cm', '25-30 kg', 'Powerful, Intelligent, Affectionate', 'No', 'Fawn or grey with black overlay and a black mask'],
									['Bedlington Terrier', 12, 14, 'bedlington_terrier', 'Killing rat, badger, other vermin', 'Families', 'High', '	12-14 years', '41-44 cm', '7.7-10 kg', 'Loyal, energetic, friendly, headstrong', 'Yes', 'Sandy, Sandy & Tan, liver'],
									['Belgian Shepherd Malinois', 12, 14, 'default', 'Herding Group', 'Families and Strangers', 'High', '10-14 years', '61-66 cm', '25-30 kg', 'Watchful, Hard-Working, Confident, Active', 'No', 'Mathogany, Tan, Black-tipped Fawn'],
									['Bernese Mountain Dog', 7, 8, 'bernese_mountain_dog', 'Working Dogs', 'Families, singles', 'Medium', '6-8 years', '61-70 cm', '45-53 kg', 'Friendly, Easy-going, loving, alert, affectionate', 'No', 'Black, white'],
									['Bichon Frise', 12, 15, 'bichon_frise', 'Companion Dogs', 'Singles, small families', 'High', '12 to 15 years', '23 – 30 cm', '3 – 6 kg', 'Playful, Gentle, Cheerful, Sensitive', 'Yes', 'White, White & Apricot, White & Buff'],
									['Black and Tan Coonhound', 10, 12, 'default', 'Hunting raccoons, night hunting', 'Families and friendly', 'Low', '10 – 12 years', '64–69 cm', '29 – 34 kg', 'Even Tempered, Adaptable, Trusting, Easygoing', 'No', 'Black and tan'],
									['Black Russian Terrier', 10, 11, 'black_russian_terrier', 'Working Group', 'Families and Singles', 'Low', '10-11 years', '66-72 cm', '50-60 kg', 'Stable, Confident, Energetic, Brave', 'No', 'Black, Salt & Pepper'],
									['Bloodhound', 10, 12, 'bloodhound', 'Trailing', 'Children', 'High', '10-12 years', '64-69 cm', '33-50 kg', 'Stubborn, Affectionate, Even Tempered', 'No', 'Black and Tan, Liver and Tan, Red'],
									['Bluetick Coonhound', 11, 12, 'default', 'Hound', 'Children', 'Low', '11-12 years', '56-69 cm', '25-36 kg', 'Intelligent, Active, Friendly', 'No', 'Bluetick'],
									['Border Collie', 13, 16, 'border_collie', 'Herding Dogs', 'Families', 'Medium-High', '13-16 years', '48-56 cm', '17-20 kg', 'Intelligent, Obedient, Active', 'No', 'Red, Black, Chocolate, White, Merle'],
									['Border Terrier', 12, 15, 'border_terrier', 'Terrier Dogs', 'Families, excellent with young kids', 'Medium', '12-15 years', '33 – 41 cm', '5 -7 kg', 'Intelligent, Alert, Fearless, Obedient', 'Yes', 'Blue & Tan, Red, Wheaten'],
									['Borzoi', 7, 10, 'borzoi', 'Hound Group', 'Families', 'Moderate', '7-10 years', '81-86 cm', '34-47 kg', 'Quiet, Intelligent, Athletic, Respectful', 'No', 'Any color permissible'],
									['Boston Terrier', 13, 15, 'boston_terrier', 'Companion Dogs', 'Families', 'Medium-Low', '13-15 years', '40 – 45 cm', '6 to 11 kg', 'Friendly, Intelligent, Lively', 'No', 'Seal & White, Black & White'],
									['Briard', 10, 12, 'briard', 'Herding, guarding sheep', 'Families and Children', 'High', '10-12 years', '58-69 cm', '27-41 kg', 'Faithful, Intelligent, Obedient', 'No', 'Tawny, Grey, Black & grey'],
									['Bouvier des Flandres', 10, 12, 'default', 'Cattle herding', 'Families', 'High', '10-12 years', '62-68 cm', '35-40 kg', 'Rational, Familial, Protective', 'Yes', 'Fawn, Black, Gray, Brindle'],
									['Boxer', 10, 12, 'boxer', 'Working Dogs', 'Families', 'Medium', '10-12 years', '53-60 cm', '30-32 kg', 'Affectionate, active, watchful, alert, self-assured', 'No', 'Brown, red, white, black'],
									['Boykin Spaniel', 14, 16, 'default', 'Miscellaneous Class', 'Families and hunters', 'Moderate', '14-16 years', '39-46 cm', '14-18 kg', 'Eager, Trainable, Companionable', 'No', 'Liver, Brown, Chocolate'],
									['Brittany', 14, 15, 'brittany_spaniel', 'Sporting Group', 'Families', 'Moderate', '12-15 years', '47-52 cm', '16-19 kg', 'Attentive, Agile, Quick', 'No', 'Tri-color, Orange & White, Liver & White'],
									['Bull Terrier', 11, 14, 'bull_terrier', 'Terrier Dogs', 'Families with older children', 'Medium', '10-14 years', '51-60 cm', '20-33 kg', 'Affectionate, active, loyal, stubborn', 'No', 'Brown, white, black, red'],
									['Bulldog', 8, 12, 'default', 'Non-Sporting Group', 'Families and Children', 'Low', '8-10 years', '31-40 cm', '18-23 kg', 'Docile, Willful, Friendly', 'No', 'Piebald, White, Fawn and White'],
									['Bullmastiff', 8, 10, 'bullmastiff', 'Working Dogs', 'Families with older children', 'Medium', '8-10 years', '63-69 cm', '50-60 kg', 'Loyal, stubborn, fearless, confident, independent', 'Yes', 'Fawn, brindle with markings on head'],
									['Cairn Terrier', 12, 15, 'cairn_terrier', 'Terrier Dogs', 'Families', 'Low – medium', '13-14 years', '25 to 33 cm', '6 to 8 kg', 'Active, Hardy, Fearless, Gay, Intelligent', 'Yes', 'Black, Grey, Wheaten, Red'],
									['Canaan Dog', 12, 15, 'canaan_dog', 'Herding Group', 'Children', 'Low', '12-15 years', '51-61 cm', '18-25 kg', 'Quick, Devoted, Alert, Intelligent', 'No', 'Black, Tan, Golden, Liver'],
									['Cane Corso', 10, 11, 'cane_corso', 'Working Dogs', 'Families with young children', 'High', '10-11 years', '64-68 cm', '45-50 kg', 'Loyal, independent, Well-rounded, agile, energetic', 'No', 'black, grey and black, brindle'],
									['Cavalier King Charles Spaniel', 9, 14, 'cavalier_king_charles_spaniel', 'Companion Dogs', 'Families', 'Low – medium', '9-14 years', '30 to 33 cm', '5 to 8 kgs', 'Playful, Gentle, Fearless, Patient, Adaptable', 'No', 'Black & Tan, Ruby, Tri-color'],
									['Cesky Terrier', 12, 15, 'default', 'Miscellaneous Class', 'Families & Children', 'High', '12-15 years', '10 to 13 in', '5.9 – 10 kg', 'Cheerful, Calm, Reserved, Quiet', 'Yes', 'Grey blue, Light Cofee brown'],
									['Chesapeake Bay Retriever', 10, 12, 'default', 'Sporting Group', 'Families and Children', 'Moderate', '10-12 years', '58-66 cm', '29-36 kg', 'Dominant, Happy, Affectionate, Quiet', 'No', 'Light Brown, Dark Brown, Deadgrass, Tan, Sedge'],
									['Chihuahua', 10, 18, 'chihuahua', 'Companion Dogs', 'Singles, families with older Kids', 'Medium', '10-18 years', '15 – 23 cm', '1.5 – 3 kg', 'Devoted, Lively, Quick, Alert', 'No', 'Black, White, Fawn, Cream, Gold'],
									['Chinese Crested Dog', 13, 15, 'chinese_crested_dog', 'Toy dog', 'Children', 'High', '13-15 years', '28-33 cm', '3.2-5.4 kg', 'Sweet-Tempered, Lively, Happy, Playful', 'Yes', 'Tri-color, Chocolate, Apricot'],
									['Chow Chow', 9, 12, 'chow_chow', 'Working Dogs', 'Singles, small families', 'Medium', '9-12 years', '43-50 cm', '25-32 kg', 'Loyal, protective, reserved, aloof, dignified, stubborn, intelligent', 'No', 'black, blue, red faun, white coats'],
									['Clumber Spaniel', 10, 12, 'default', 'Sporting Group', 'Families', 'Moderate', '10-12 years', '46-51 cm', '25-39 kg', 'Dignified, Great-hearted, Affectionate', 'No', 'White, Lemon & White'],
									['Curly Coated Retriever', 9, 14, 'default', 'Sporting Group', 'Families, Children', 'High', '9-14 years', '64-69 cm', '32-41 kg', 'Clever, Intelligent, Sensitive, Trainable', 'No', 'Black, Liver'],
									['Dachshund', 14, 17, 'dachshund', 'Hound Dogs', 'Singles, families', 'Medium', '14-16 years', '20 – 27 cm', '4 – 5 kg', 'Clever, Devoted, Active, Playful', 'No', 'Black, Black & Tan, Blue & Tan, Chocolate & Tan'],
									['Dalmatian', 10, 13, 'dalmatian', 'Companion Dogs', 'Families with older children, Singles', 'Medium-high', '10-13 years', '50-55 cm', '23-25 kg', 'Energetic, Playful, Loyal', 'Yes', 'White with black spotted coat, brindle, mosaic, orange/lemon'],
									['Dandie Dinmont Terrier', 12, 15, 'dandie_dinmont_terrier', 'Terrier Group', 'Children', 'Moderate', '12-15 years', '8-11 ins', '8.2-11 kg', 'Fun-loving, Determined, Independent, Lively', 'Yes', 'Pepper, Mustard'],
									['Doberman Pinscher', 10, 11, 'doberman_pinscher', 'Working Dogs', 'Families', 'Low', '10 – 13 years', '60 – 70 cm', '35 – 42kg', 'Intelligent, Obedient, Fearless, Alert, Energetic, Loyal, Confident', 'No', 'White, Fawn, Black, Blue, Red, Black & Rust, Fawn'],
									['Dogue de Bordeaux', 10, 12, 'default', 'Working Dogs', 'Families', 'Medium', '10-12 years', '65-70 cm', '60-68 kg', 'Intelligent, loyal, Sensitive, Active', 'No', 'Dark red, Fawn, mahogany, golden fawn'],
									['English Bulldog', 8, 12, 'english_bulldog', 'Companion Dogs', 'Families', 'Medium', '8 to 12 years', '31 – 40cm', '0–25 kg', 'Gentle, affectionate, stubborn , Friendly. Docile. Devoted.', 'No', 'White, Fawn, Piebald, Brindle & White, Fawn & White, Red, Red Brindle, Red & White'],
									['English Cocker Spaniel', 12, 15, 'english_cocker_spaniel', 'Sporting Group', 'Families', 'High', '12-15 years', '38-43 cm', '13-14 kg', 'Affectionate, Friendly, Quiet, Faithful', 'No', 'Orange Roan, Liver Roan, Blue Roan, Black'],
									['English Coonhound', 11, 12, 'default', 'Scenthound', 'Families', 'Low', '11-12 years', '56-69 cm', '18-30 kg', 'High-Strung, Loyal, Energetic, Intelligent', 'No', 'Redtick, Red & White, Bluetick, Tricolor Ticked'],
									['English Foxhound', 10, 13, 'default', 'Hound Group', 'Hunters and Families', 'Low', '10-13 years', '56-63 cm', '29-34 kg', 'Tolerant, Sociable, Gentle, Friendly', 'No', 'Tricolor, Lemon & White, White'],
									['English Mastiff', 10, 12, 'english_mastiff', 'Working Group', 'Children', 'Moderate', '6-12 years', '70-91 cm', '73-100 kg', 'Good-natured, Dignified, Courageous, Calm', 'No', 'Fawn, Brindle, Apricot'],
									['English Setter', 10, 12, 'english_setter', 'Sporting Group', 'Children', 'High', '10-12 years', '25 to 27 in', '65 to 80 pounds', 'Strong Willed, Eager, Hard-Working, Gentle', 'No', 'Blue Belton, Tricolor, Orange Belton, Liver Belton'],
									['English Springer Spaniel', 12, 14, 'english_springer_spaniel', 'Spaniel group', 'Families', 'Moderate', '12-14 years', '48-56 cm', '20-25 kg', 'Affectionate, Attentive, Alert', 'No', 'Liver & White, Tricolor'],
									['Entlebucher Mountain Dog', 11, 15, 'default', 'Foundation Stock Service Program', 'Children', 'High', '11-15 years', '44-52 cm', '20-30 kg', 'Self-confidence, Agile, Independent, Loyal', 'No', 'Tri-color'],
									['Field Spaniel', 10, 12, 'default', 'Sporting Group, Bird flushing, retrieving', 'Families', 'Moderate', '10-12 years', '17-18 in', '16-20 kg', 'Adaptable, Sensitive, Sociable, Familial', 'No', 'Black, Blue Roan, Liver Roan, Liver'],
									['Finnish Lapphund', 12, 14, 'default', 'Foundation Stock Service Program', 'Families', 'Low', '12-14 years', '46-52 cm', '15-24 kg', 'Keen, Courageous, Faithful, Calm', 'No', 'Black, White, Wolf-Sable, Sable, Brown'],
									['Finnish Spitz', 12, 14, 'default', 'Non-Sporting Group, Hunting birds, small mammals', 'Families and Children', 'Moderate', '12-14 years', '44-50 cm', '12-14 kg', 'Vocal, Independent, Playful, Happy', 'No', 'Gold, Red Gold, Red'],
									['Flat-Coated Retriever', 8, 10, 'default', 'Sporting Group, Water retrieving', 'Families', 'Low', '8-14 years', '59-62 cm', '27-36 kg', 'Outgoing, Optimistic, Confident, Friendly', 'No', 'Black, Liver'],
									['French Bulldog', 10, 12, 'french_bulldog', 'Companion Dogs', 'Singles, families', 'Medium', '10-15 years', '28-30 cm', '10 – 13kgs', 'Playful, Lively, Affectionate, Bright, Keen, Athletic, Alert, Sociable, Patient, Easygoing', 'No', 'Brindle, Fawn, Pied'],
									['German Pinscher', 12, 14, 'default', 'Working Group', 'Children', 'High', '12-14 years', '25-30 cm', '11-20 kg', 'Spirited, Intelligent, Even Tempered', 'No', 'Black, Brown, Red, Blue'],
									['German Shepherd', 9, 13, 'german_shepherd', 'Herding Dogs', 'Families', 'Medium', '12-14 years', '60-65 cm', '30-40 kg', 'Intelligent, loyal, patient, active, aloof, reserved, protective', 'No', 'Mixture of gold and black'],
									['German Shorthaired Pointer', 12, 14, 'german_shorthaired_pointer', 'General hunting, Sporting Group', 'Hunters', 'Low', '12-14 years', '58-64 cm', '25-32 kg', 'Boisterous, Affectionate, Bold, Cooperative', 'No', 'Liver Roan, Liver, Black & White, White & Chocolate'],
									['German Wirehaired Pointer', 12, 14, 'german_wirehaired_pointer', 'Sporting Group, General hunting, watch dog', 'Gun Dog', 'Moderate', '12-14 years', '61-68 cm', '27-32 kg', 'Willful, Intelligent, Loyal, Active', 'No', 'Liver, Black & White, Roan, Liver & White'],
									['Giant Schnauzer', 12, 15, 'giant_schnauzer', 'Working Group, Herding, guarding', 'Herding Dog', 'Moderate', '12-15 years', '65-70 cm', '27-48 kg', 'King, Dominant, Loyal, Powerful, Strong Willed', 'Yes', 'Salt & Pepper, Black'],
									['Glen of Imaal Terrier', 13, 14, 'default', 'Terrier Group', 'Children', 'High', '10-14 years', '13-i4 in', '15-16 kg', 'Agile, Spirited, Loyal, Active', 'No', 'Blue Brindle, Wheaten'],
									['Golden Retriever', 10, 12, 'golden_retriever', 'Sporting Dogs', 'Families', 'Medium', '11-12 years', '58-61 cm', '29-34 kg', 'Intelligent, Gentle, Friendly', 'No', 'Gold, cream'],
									['Gordon Setter', 10, 12, 'gordon_setter', 'Sporting Group', 'Families and Children', 'Low', '10-12 years', '61-69 cm', '25-36 kg', 'Gay. Fearless, Confident, Active', 'No', 'Black & Tan'],
									['Great Dane', 6, 8, 'great_dane', 'Working Dogs', 'Families', 'Medium', '6-8 years', '76-86 cm', '54-91 kg', 'Devoted, Reserved, Loving, Gentle, Friendly, Confident', 'No', 'Brindle, Fawn, Black, Mantle, Blue, Harlequin'],
									['Great Pyrenees', 10, 12, 'great_pyrenees', 'Sheep guardian, Working Group', 'Families and Childrens', 'Moderate', '10-12 years', '70-82 cm', '45-73 kg', 'Gentle, Strong Willed, Patient, Fearless', 'No', 'Tan, White, Bedger, White'],
									['Greater Swiss Mountain Dog', 10, 11, 'greater_swiss', 'Working Group', 'Childrens', 'Low', '10-11 years', '65-72 cm', '55-65 kg', 'Self-confidence, Loyal, Devoted, Fearless', 'No', 'Tri-color'],
									['Greyhound', 10, 12, 'greyhound', 'Lapdog, Hound Group', 'Families', 'Low', '10-14 years', '71-76 cm', '27-40 kg', 'Even Tempered, Affectionate, Quiet, Intelligent', 'No', 'Brindle, Black, White, Fawn, Blue, Red'],
									['Griffon Bruxellois', 12, 15, 'griffon_bruxellois', 'Toy Dog', 'Kids', 'Low', '10-15 years', '9-11 inches', '8-10 pounds', 'Sensitive, Companionable, Watchful, Alert', 'Yes', 'Black, Black & Tan, Blue, Blege, Brown'],
									['Harrier', 10, 12, 'default', 'Hound Group', 'Childrens, Families', 'Low', '10-12 years', '19-21 inches', '20-30 kg', 'Outgoing, Cheerful, Active, Friendly', 'No', 'Lemon & white, Tri-color, White, Black & Tan'],
									['Havanese', 13, 15, 'havanese', 'Companion Dogs', 'Families', 'Low-medium', '13 – 15 years', '23 – 27 cm', '4.5 – 7.3 kg', 'Playful, Gentle, Intelligent, Responsive, Affectionate, Companionable', 'Yes', 'Black, White, Tobacco, Fawn'],
									['Ibizan Hound', 10, 12, 'ibizan_hound', 'Coursing rabbits, Hound Group', 'Families', 'Low', '10-12 years', '66-72 cm', '20-30 kg', 'Clownish, Stubborn, Independent, Active', 'No', 'White, Fawn, White & Red, Red'],
									['Icelandic Sheepdog', 12, 15, 'icelandic_sheepdog', 'Miscellaneous Class', 'Childrens', 'High', '12-15 years', '16.5-18 inches', '9.1-14 kg', 'Cheerful, Hardy, Agile, Alert', 'No', 'White & black, White & Cream, Gold & White, Grey & White'],
									['Irish Red and White Setter', 10, 13, 'default', 'Sporting Group', 'Small Kids', 'High', '10-13 years', '62-66 cm', '25-34 kg', 'Affectionate, Devoted, Loyal, Reliable', 'No', 'Red & White'],
									['Irish Setter', 12, 15, 'irish_setter', 'Sporting Dogs', 'Families', 'High', '10-14 years', '63-70 cm', '29-34 kg', 'Fun, Playful, Outgoing, Loving, Sporty', 'No', 'Mahogany and chestnut'],
									['Irish Soft-coated Wheaten Terrier', 12, 15, 'default', 'Terrier Group', 'Families', 'High', '12-15 years', '46-48 cm', '16-20 kg', 'Intelligent, Affectionate, Playful, Energetic, Spirited', 'Yes', 'Wheaten'],
									['Irish Terrier', 13, 15, 'irish_terrier', 'Terrier Dogs', 'Families, Singles', 'Low-Medium', '12-15 years', '40-46 cm', '10-12 kg', 'Lively, Gentle', 'Yes', 'Bright red, golden red, red wheaten, solid wheaten'],
									['Irish Water Spaniel', 10, 12, 'default', 'Water retrieving, Sporting Group', 'Families and Childrens', 'high', '10-12 years', '56-61 cm', '25-30 kg', 'Clownish, Quick, Intelligent, Alert, Active', 'Yes', 'Liver'],
									['Irish Wolfhound', 6, 10, 'irish_wolfhound', 'Coursing wolves, elk, Hound Group', 'Childrens', 'Moderate', '6-10 years', '30-32 inches', '120-155 lbs', 'Sweet-Tempered, Thoughtful, Loyal, Dignified, Genrous', 'No', 'Black, White, Brindle, Fawn, Grey'],
									['Italian Greyhound', 12, 15, 'italian_greyhound', 'Companion Dogs', 'Families with older kids', 'Medium – low', '12-15 years', '30 to 40 cm', '3 – 5 kg', 'Intelligent, Agile, Affectionate, Companionable, Athletic, Mischievous', 'Yes', 'Black, Fawn, Chocolate, Blue Fawn, Slate Grey, Red Fawn, Red, Blue, Tan, Sable, Yellow, Grey'],
									['Jack Russell Terrier', 13, 16, 'jack_russell_terrier', 'Terrier Dogs', 'Families with older children', 'Medium', '13-16 years', '25 to 38cm', '6 to 8kgs', 'Stubborn, Fearless, Intelligent, Athletic, Energetic, Vocal', 'No', 'White, Black & White, White & Tan'],
									['Japanese Chin', 12, 14, 'japanese_chin', 'Lapdog, Toy Dog', 'Childrens', 'Moderate', '12-14 years', '8-11 inches', '1.4-8.6 kg', 'Cat-like, Alert, Loyal, Intelligent, Independent', 'No', 'Tri-color, Black & White, Lemon & White, Sable & White'],
									['Keeshond', 13, 15, 'keeshounds', 'Barge watchdog, Non-Sporting Group', 'Families & Childrens', 'High', '13-15 years', '17-18 inches', '14-18 kg', 'Bright, Agile, Playful, Obedient', 'No', 'Black, Grey, Black & Silver, Silver'],
									['Kerry Blue Terrier', 13, 15, 'kerry_blue_terriers', 'Kerry Blue Terrier', 'Childrens', 'High', '13-15 years', '46-51 cm', '15-18 kg', 'Strong Willed, Alert, Loyal, Spirited', 'Yes', 'Black, Blue, Silver, Grey'],
									['King Charles Spaniel', 12, 14, 'king_charles_spaniel', 'Flushing small birds, companion, Toy Dog', 'Childrens, Families and Strangers', 'High', '9-14 years', '12-13 inches', '5.9-9.2 kg', 'Playful, Sociable, Gentle, Affectionate, Patient', 'No', 'Black & Tan, Tri-color, Ruby'],
									['Komondor', 10, 12, 'default', 'Sheep guardian, Working Group', 'Families', 'High', '10-12 years', '71-76 cm', '50-60 kg', 'Steady, Affectionate, fearless, Gentle', 'No', 'White, Black, Red, Green'],
									['Kuvasz', 10, 12, 'default', 'Guardian, hunting large game, Working Group', 'Families', 'Moderate', '10-12 years', '70-76 cm', '45-52 kg', 'Protective, Intelligent, Patient, Loyal', 'No', 'White, Black, Blue, Brown, Pink'],
									['Labrador Retriever', 12, 13, 'labrador_retriever', 'Water retrieving, Sporting Group', 'Kids and Families', 'Low', '10-12 years', '57-62 cm', '29-36 kg', 'Outgoing, Kind, Even Tempered, Agile', 'No', 'Black, Yellow, Chocolate'],
									['Lakeland Terrier', 12, 16, 'lakeland_terrier', 'Terrier Group', 'Kids & Families', 'Moderate', '12-16 years', '13.5-15 inches', '7-8 kg', 'Intelligent, Friendly, Independent, Bold', 'Yes', 'Black, Grizzle & Tan, Black & Tan, Wheaten'],
									['Leonberger', 8, 9, 'leonberger', 'Guardian, appearance, Miscellaneous Class', 'Kids', 'High', '8-9 years', '72-80 cm', '48-75 kg', 'Fearless, Loyal, Loving, Obedient', 'No', 'Red, Sandy, Yellow'],
									['Lhasa Apso', 12, 14, 'lhasa_apso', 'Companion Dogs', 'Singles, families', 'High', '13-15 years', '25 – 28 cm', '6 – 7 kg', 'Playful, Lively, Obedient, Devoted, Fearless, Intelligent, Spirited, Alert, Assertive, Energetic, Friendly, Steady', 'Yes', 'black, white, black and tan'],
									['Lowchen', 12, 14, 'default', 'Non-Sporting Group', 'Families and Childrens', 'Low', '12-14 years', '33-36 cm', '5-8 kg', 'Playful, Happy, Active, Intelligent', 'Yes', 'Black, Silver & Black, Cream, Black & Tan'],
									['Maltese', 12, 15, 'maltese_dog', 'Companion Dogs', 'Singles, families with older children', 'Low – medium', '12-15 years', '21 – 25 cm', '3 – 4 kg', 'Playful, Lively, Affectionate, Docile, Fearless', 'Yes', 'White, Black, Blue, Red, Green, Yellow'],
									['Manchester Terrier', 14, 16, 'default', 'Terrier Group', 'Families', 'Low', '14-16 years', '15-16 inches', '5.4-10 kg', 'Discerming, Keen, Active, Devoted', 'No', 'Black, Black & Tan, Tan, Blue'],
									['Mexican Hairless Dog', 12, 15, 'mexican_hairless', ' hairless Chinese, Foundation Stock Service Program', 'Families, Old Childrens', 'Low', '12-15 years', '28-33 cm', '4-25 kg', 'Cheerful, Calm, Alert, Intelligent, Protective', 'Yes', 'Black, Brindle, Brown, Fawn'],
									['Miniature Pinscher', 14, 15, 'miniature_pinscher', 'Companion Dogs', 'Families', 'Medium-high', '10 to 14 years', '25–30 cm', '4–5 kg', 'Playful, Outgoing, Responsive, Energetic, Friendly, Clever', 'No', 'Stag Red, Chocolate & Rust, Black & Tan, Red, Black & Rust, Chocolate & Tan'],
									[
										'Miniature Schnauzer',
										12,
										15,
										'mininature_schnauzer',
										'Ratting, Terrier Group',
										'Childrens',
										'Moderate',
										'12-15 years',
										'30-36 cm',
										'5.4-9.1 kg',
										'Intelligent, Fearless, Obedient, Friendly',
										'Yes',
										'Black, Salt & Pepper, White'
									],
									['Neapolitan Mastiff', 8, 10, 'default', 'Working Group', 'Old Childrens', 'Low', '8-10 years', '63-77 cm', '60-70 kg', 'Stubborn, Obedient, Dominant, Protective, Fearless', 'No', 'Black, Brindle, Tawny, Blue'],
									['Newfoundland', 8, 12, 'newfoundland', 'Working Dogs', 'Families', 'Medium', '8-10 years', '69 to 74cm', '65 to 69kgs', 'Trainable, Sweet-Tempered, Gentle', 'No', 'Black, Black & White, Brown, Grey'],
									['Norfolk Terrier', 12, 15, 'default', 'Ratting, fox bolting, Terrier Group', 'Childrens', 'Moderate', '12-15 years', '9-10 inches', '5-5.4 kg', 'Lovable, Fearless, Spirited, Happy', 'Yes', 'Grizzle, Black & Tan, Wheaten, Red'],
									['Norwegian Buhund', 13, 15, 'default', 'Miscellaneous Class', 'Families', 'Low', '13-15 years', '43-47 cm', '14-18 kg', 'Fun-loving, Friendly, Courageous, Energetic, Agile', 'No', 'Black, Red Wheaten, Wheaten'],
									['Norwegian Elkhound', 12, 15, 'default', 'Hunting elk, Hound Group', 'Kids', 'Moderate', '12-15 years', '19-21 inches', '22-25 kg', 'Hardy, Bold, Loyal, Alert, Strong Willed', 'No', 'Grey, Silver'],
									['Norwegian Lundehund', 12, 14, 'default', 'Northern Breed Group', 'Kids', 'Low', '12-14 years', '33-38 cm', '6-9 kg', 'Energetic, loyal, Protective, Alert', 'No', 'Black, White, Sable & White, Grey, Red'],
									['Norwich Terrier', 12, 14, 'norwich_terrier', 'Ratting, fox bolting', 'Families and Childrens', 'Moderate', '12-14 years', '8-10 inches', '5-5.4 kg', 'Hardy, Intelligent, Sensitive, Affectionate', 'Yes', 'Grizzle, Black & Tan, Red, Tan'],
									['Nova Scotia Duck Tolling Retriever', 12, 14, 'nova_scotia_duck_tolling_retriever', 'Sporting Group', 'Childrens', 'Low', '10-14 years', '45-54 cm', '20-23 kg', 'Intelligent, Alert, Loving', 'No', 'Copper, Red, Red Golden'],
									['Old English Sheepdog', 10, 12, 'old_english_sheepdog', 'Herding Group', 'Families', 'Medium – high', '10-12 years', '56 – 61cm', '38 – 45kg', 'Active, Intelligent, Loyal, Hard-Working, Athletic, Confident, Proud', 'No', 'Blue Merle, Blue, Grey, Grizzle'],
									['Otterhound', 10, 13, 'default', 'Hound Group', 'Small Childrens and Families', 'High', '10-13 years', '24-27 inches', '41-50 kg', 'Amiable, Even Tempered, Boisterous', 'No', 'Black, Liver & Tan, Wheaten, Grey'],
									['Papillon', 13, 15, 'papillon', 'Companion Dogs', 'Families', 'Medium', '13-15 Years', 'Up to 28 cm', 'Up to 5 kg', 'Intelligent, active', 'No', 'White and Brown'],
									['Parson Russell Terrier', 13, 15, 'default', 'Terrier Group', 'Childrens', 'Low', '13-15 years', '34-38 cm', '5.9-7.7 kg', 'Energetic, Bold, Obedient, Intelligent', 'No', 'White & Tan, Tri-color, Black & White'],
									['Pekingese', 12, 15, 'pekingese', 'Companion Dogs', 'Couples and singles', 'High', '13-15 Years', 'Up to 25 cm', 'Up to 6 kg', 'Confident, stubborn, Tough, Affectionate', 'No', 'Gold, sable, red, cream, tan, white'],
									['Pembroke Welsh Corgi', 12, 14, 'pembroke_welsh_corgi', 'Herding Group, Cattle drover', 'children', 'Low', '12-15 Years', '25-30 cm', '10-14 kg', 'Tanacious, Friendly, Playful, Outgoing, Bold', 'No', 'Fawn, Black & White, Red, Black & Tan'],
									['Petit Basset Griffon Vendeen', 12, 14, 'default', 'Hound Group', 'Childrens and families', 'High', '12-14 years', '13.5-15 inches', '15-20 kg', 'Extroverted, Lively, Independent, Friendly', 'No', 'Tri-color, Black & Tan, Fawn & White'],
									['Pharaoh Hound', 11, 14, 'default', 'Hunting rabbits, Hound Group', 'Childrens', 'Low', '11-14 years', '55-63 cm', '18-27 kg', 'Affectionate, Sociable, Playful, Intelligent', 'No', 'Rich Tan, Tan, Red Golden'],
									['Plott Hound', 12, 14, 'default', 'Hound Group', 'Childrens And Families', 'High', '12-14 years', '50-71 cm', '23-27 kg', 'Intelligent, Alert, Bold, Loyal', 'No', 'Black, Brown Brindle, Tan Brindle'],
									['Pointer', 12, 14, 'default', 'Sporting Group, General hunting, watch dog General hunting, watch dog', 'Childrens', 'Moderate', '12-17 years', '56-70 cm', '25-34 kg', 'Even Tempered, Affectionate, Loyal, Amiable', 'No', 'Black, Orange & White, Black & White, Liver'],
									['Polish Lowland Sheepdog', 12, 15, 'polish_lowland_sheepdog', 'Herding Group', 'Families', 'High', '12-15 years', '45-50 cm', '18-23 kg', 'Even Tempered, Lively, Self-confidence', 'Yes', 'Black, Tri-color, Black & White, Beige'],
									['Pomeranian', 12, 16, 'pomeranian', 'Companion Dogs', 'Families and singles', 'Medium', '12 – 16 Years', '13-28 cm', 'Up to 4 kg', 'Independent, Friendly', 'No', 'white, orange'],
									['Poodle', 12, 15, 'poodle', 'Companion Dogs', 'Families', 'Medium-high', '12-15 Years', '45-60 cm', '20-32 kg', 'Trainable, Intelligent, Faithful, Alert, Instinctual, Active', 'Yes', 'Apricot, Black, White, Black & Tan, Cream, Black & White, Red, Silver, Blue, Brown, Sable, Grey'],
									['Portuguese Water Dog', 12, 15, 'portuguese_water_dog', 'Fishing aid, Working Group', 'Families, Childrens', 'High', '12-15 years', '50-57 cm', '18-27 kg', 'Intelligent, Docile, Obedient, Brave, Impetuous', 'Yes', 'Black, White, White and Chocolate'],
									['Pug', 12, 15, 'pug', 'Companion Dogs', 'Families and singles', 'Low', '10-12 years', '30-36 cm', '6-9 kg', 'Playful, Loyal', 'Yes', 'Black, Apricot, Fawn'],
									['Puli', 12, 16, 'default', 'Herding', 'Childrens', 'High', '12-16 years', '39-45 cm', '10-11 kg', 'Intelligent, Loyal, Agile, Obedient', 'Yes', 'Black, White, Brindle, Cream'],
									['Pyrenean Shepherd', 15, 17, 'default', 'Miscellaneous Class', 'Childrens', 'High', '15-17 years', '40-50 cm', '20-25 kg', 'Dedicated, Watchful, Bossy, Clever', 'No', 'Black, White, Merle, Brindle, Fawn'],
									['Redbone Coonhound', 11, 12, 'default', 'Miscellaneous Class', 'Families', 'High', '11-12 years', '56-68 cm', '20-32 kg', 'Unflappable, Energetic, Companionable, Affectionate, Independent', 'No', 'Red & White, Red'],
									['Rhodesian Ridgeback', 10, 12, 'rhodesian_ridgeback', 'Hound Dogs', 'Families with older children', 'Medium – high', '10 – 12 years', '63–69 cm', '36–41 kg', 'Strong Willed, Intelligent, Mischievous, Loyal, Dignified, Sensitive', 'No', 'Red Wheaten, Wheaten, Light Wheaten'],
									['Rottweiler', 9, 10, 'rottweiler', 'Working Dogs', 'Families', 'Medium', '8 – 10 years', '61 – 69 cm', '42 and 50 kg', 'Obedient, Devoted, Fearless, Courageous, Alert, Self-assured, Good-natured, Calm, Steady, Confident', 'No', 'Black, Tan, Mahogany'],
									['Rough Collie', 14, 16, 'default', 'Herding, agility training, Herding Group', 'Childrens', 'Minimal—brushing once a week, bathing once a month, and twice a year they will blow their coat and need a little extra brushing during this time', '14-16 years', '56-61 cm', '20-34 kg', 'Intelligent, Loyal, Active, Gentle, Friendly', 'No', 'White, Blue Merle, Tri0-color, Sable Merle'],
									['Saluki', 12, 14, 'saluki', 'Coursing gazelle and hare, Hound Group', 'Childrens', 'Moderate', '12-14 years', '23-28 inches', '18-27 kg', 'Aloof, Intelligent, Quiet, Reserved', 'No', 'White, Cream, Gold, Tan, Red'],
									['Samoyed', 12, 14, 'samoyed_huskey', 'Working Dogs', 'Families', 'Medium', '12 – 13 years', '48 – 60 cm', '20–30 kg', 'Playful, Stubborn, Lively, Alert, Friendly, Sociable', 'Yes', 'White, Cream'],
									['Schipperke', 13, 15, 'default', 'Coursing deer, Non-Sporting Group', 'Childrens and Families', 'Low', '13-15 years', '28-33 cm', '3-9 kg', 'Curious, Fearless, Agile, Confident', 'No', 'Black, Apricot, Chocolate, Cream'],
									['Scottish Deerhound', 8, 11, 'default', 'Coursing deer, Hound Group', 'Older Childrens', 'Low', '8-11 years', '30-32 inches', '40-50 kg', 'Dignified, Docile, Gentle, Friendly', 'No', 'Brindle, Fawn, Red Fawn, Grey'],
									['Scottish Terrier', 12, 15, 'scottish_terrier', 'Terrier Dogs', 'Families with older children, singles', 'Medium', '11-13 years', 'up to 25 cm', '8-10 kg', 'Independent, Intelligent', 'No', 'Dark grey, bringle, black, brown, near-white, blonde'],
									['Sealyham Terrier', 12, 14, 'sealyham_terrier', 'Terrier Group', 'Families, older Childrens', 'Low', '12-14 years', '28-30 cm', '8-9 kg', 'Even Tempered, Fearless, Alert, Friendly', 'Yes', 'White, White & Chocolate, Badger & White'],
									['Shar Pei', 9, 11, 'shar_pei', 'Working Dogs', 'Families with older children', 'Medium', '9-11 years', '45-51 cm', '25-29 kg', 'Active, independent, happy', 'No', 'Black, red, Red-fawn, fawn, black-pointed cream, blue, sable'],
									['Shetland Sheepdog', 12, 13, 'shetland_sheepdog', 'Herding Dogs', 'Families', 'Medium-High', '12-14 years', '33-41 cm', '8-12 kg', 'Active, Loyal, Independent, Happy', 'No', 'Blue Merle, Sable, Tri-colour'],
									['Shiba Inu', 12, 15, 'shiba_inu', 'Non-Sporting Group', 'Families', 'Low', '12-15 years', '35-43 cm', '8-10 kg', 'Charming, Keen, Confident, Fearless', 'No', 'Red Sesame, Black Sesame, Black & Tan'],
									['Shih Tzu', 10, 16, 'shih_tzu', 'Companion Dogs', 'Families', 'Medium-High', '10-16 years', '20.3-27.9 cm', '4-7.5 kg', 'Intelligent', 'No', 'Black, Brown, Gold, Grey and Mixture'],
									['Siberian Huskie', 12, 15, 'siberian_husky', 'Working Dogs', 'Singles, families with older children', 'Medium', '12 to 15 years', '54–60 cm', '18–25 kg', 'Intelligent, Alert,Outgoing, Gentle, Friendly', 'No', 'Black, Agouti, Sable, Piebald, Black & Tan, Grey, Black & White, Splash, Brown,  Red, Silver, Copper'],
									['Skye Terrier', 12, 15, 'skye_terrier', 'Vermin hunting, Terrier group', 'Families, Childrens and Strangers', 'Moderate', '12-15 years', '24-25 cm', '16-18 kg', 'Good-Tempered, Friendly, Loyal, Intelligent', 'No', 'Black, Fawn, Blue, Light Grey'],
									['Smooth Fox Terrier', 12, 15, 'smooth_fox_terrier', 'Fox bolting, Terrier Group', 'Families', 'High', '12-15 years', '36-41 cm', '6.8-8.6 kg', 'Playful, Fearless, Affectionate, Active', 'No', 'White, White & Tan, Black & White, Tri-color'],
									['Spinone Italiano', 12, 14, 'default', 'Sporting Group', 'Families and Childrens', 'Low', '12-14 years', '60-70 cm', '34-39 kg', 'Patient, Docile, Friendly, Gentle', 'No', 'Orange & White, Orange Roan, Brown Roan'],
									['St. Bernard', 8, 10, 'saint_bernard', 'Working Group', 'Families', 'High', '8-10 years', '70-90 cm', '64-82 kg', 'Friendly, Gentle, Loyal, Calm', 'No', 'Red & White, Brownish-yellow, Reddish-brown-Mantle'],
									['Staffordshire Bull Terrier', 12, 14, 'default', 'Bull Terrier', 'Childrens and Families', 'Low', '12-14 years', '36-41 cm', '12-17 kg', 'Fearless, Reliable, Courageous, Loyal, Bold', 'No', 'Black, White, Brindle, Fawn & White'],
									['Standard Schnauzer', 12, 14, 'standard_schnnauzer', 'Working Group, Ratting, guarding', 'Childrens', 'High', '13-16 years', '47-50 cm', '14-20 kg', 'Trainable, Devoted, Good-natured, Lively', 'Yes', 'Black, Salt & Pepper'],
									['Sussex Spaniel', 12, 15, 'default', 'Sporting Group', 'Families', 'High', '12-15 years', '38-41 cm', '16-20 kg', 'Cheerful, Devoted, Calm, Friendly', 'No', 'Golden Liver'],
									['Swedish Vallhund', 12, 14, 'swedish_vallhund', 'Herding Group', 'Kids, Families and Strangers', 'Low', '12-15 years', '32-34 cm', '9-14 kg', 'Intelligent, Watchful, Fearless, Alert', 'No', 'Greyish Brown, Mahogany, Blue, Greyish Yellow'],
									['Tibetan Mastiff', 10, 12, 'tibetian_mastiff', 'Working Group', 'Childrens', 'Moderate', '12-15 years', '66-76 cm', '41-68 kg', 'Stubborn, Active, Strong Willed, Intelligent', 'No', 'Black, Brown & Tan, Blue Grey'],
									['Tibetan Spaniel', 12, 15, 'tibetan_spaniel', 'Non-Sporting Group, Watchdog', 'Childrens', 'Moderate', '12-15 years', '9-10 inches', '4.1-6.8 kg', 'Assertive, Willful, Intelligent, Playful', 'No', 'Sable, Black, White, Red, Black & Tan'],
									['Tibetan Terrier', 12, 15, 'tibetan_terrier', 'Non-Sporting Group', 'Families', 'Moderate', '12-15 years', '14-16 inches', '8-14 kg', 'Amiable, Energetic, Reserved, Sensitive, Gentle', 'Yes', 'Piebald, Black, White, Brindle, Tri-color'],
									['Toy Fox Terrier', 13, 14, 'toy_fox_terrier', 'Terrier Group, Toy Dog', 'Small Childrens', 'Low', '13-14 years', '8.5-11.5 inches', '3.5-7 pounds', 'Intelligent, Spirited, Loyal, Friendly, Playful', 'No', 'White & chocolate, White & Tan, Tri-color',],
									['Treeing Walker Coonhound', 12, 13, 'default', 'Foundation Stock Service Program, Hunters', 'Childrens', 'Low', '12-13 years', '56-69 cm', '23-32 kg', 'Trainable, Confident, Affectionate, Clever', 'No', 'Black, White, Tri-color'],
									['Tervuren', 12, 14, 'default', 'Herding Group', 'Childrens', 'Low', '12-14 years', '60-66 cm', '25-29 kg', 'Attentive, Loyal, Active, Protective', 'No', 'Black, Black & Cream, Fawn & Black, Brindle'],
									['Vizsla', 12, 15, 'vizsla', 'Sporting Group, Pointing and trailing', 'Families and small Children', 'High', '12-15 years', '56-64 cm', '20-30 kg', 'Quiet, Energetic, Loyal, Affectionate', 'No', 'Golden Rust, Red Golden, Golden'],
									['Weimaraner', 10, 12, 'weimaraner', 'Sporting Dogs', 'Families', 'Medium', '10 – 12 years', '64 – 69 cm', '32 – 36 kgs', 'Stubborn, Intelligent, Aloof, Alert, Energetic, Steady, Fast, Powerful', 'No', 'Mouse-gray, Silver, Silver-gray'],
									['Welsh Springer Spaniel', 12, 15, 'default', 'Flushing and retrieving birds, Sporting Group', 'Families and strangers', 'Moderate', '12-15 years', '46-48 cm', '16-20 kg', 'Active, Stubborn, Playful, Loyal', 'No', 'White & Red'],
									['Welsh Terrier', 12, 15, 'welsh_terrier', 'Terrier Dogs', 'Families & Singles', 'Low', '10 to 14 years', '30 – 40 cm', 'upto 9kg', 'Intelligent, Alert, Friendly, Spirited', 'Yes', 'Black & Tan, Grizzle & Tan'],
									['West Highland White Terrier', 12, 16, 'west_highland_white_terrier', 'Terrier Group', 'Families and Children', 'Low', '12-16 years', '25-30 cm', '6.8-9.1 kg', 'Intelligent, Courageous, Active, Alert, Loyal', 'Yes', 'Pink, Red, Blue, Black, White'],
									['Whippet', 12, 15, 'whippet', 'Hound Dogs', 'Families', 'Medium', '12-15 years', '47 – 56 cm', '10 to 13 kgs', 'Lively, Quiet, Friendly', 'No', 'Black, Brindle, White, Fawn'],
									['Wire Hair Fox Terrier', 13, 14, 'default', 'Terrier Group', 'Families and young Children', 'High', '13-14 years', '36-41 cm', '7-9.5 kg', 'Keen, Fearless, Active, Bold', 'Yes', 'White, White & Tan, Black & White, Tricolor'],
									['Wirehaired Pointing Griffon', 10, 12, 'default', 'Sporting Group', 'Children', 'High', '10-12 years', '55-60 cm', '23-27 kg', 'Proud, Trainable, Vigilant, Loyal', 'Yes', ';Grey & Tan, White & Chocolate, Chestnut, Liver'],
									['Xoloitzcuintle ', 12, 15, 'xoloitzcuintli', 'Non-Sporting Group', 'Families', 'Moderate', '12-15 years', '10-14 inches', '4-25 kg', 'Aloof, Cheerful, Active, Calm', 'Yes', 'Black, Dark Brown, Brindle, Cooper & White'],
									['Yorkshire Terrier', 13, 16, 'yorkshire_terrier', 'Companion Dogs', 'Families, Singles', 'Low-Medium', '12-15 years', '15-17.5 cm', 'Up to 3.2 kg', 'Loyal, Active', 'Yes, medium shedding', 'Blue and tan']
								];
								$data1 = $dogBreed1 - 1;
								$data = $breeds[$data1];
								//    $firstYearAge = 15;
								// $secondYearAge = 9;
								// $restHumanAge = 44;
								$firstYearAge = $a;
								$secondYearAge = $b;
								$restHumanAge = $c;
								$dogAverageAge = ($breeds[$dogBreed1 - 1][1] + $breeds[$dogBreed1 - 1][2]) / 2;
								$dogHumanAge = 0;
								if ($dogAge > 2) {
									$dogHumanAge = $firstYearAge + $secondYearAge + (($dogAge - 2) * ($restHumanAge / ($dogAverageAge - 2)));
								} else if ($dogAge > 1) {
									$dogHumanAge = $firstYearAge + (($dogAge - 1) * $secondYearAge);
								} else {
									$dogHumanAge = $dogAge * $firstYearAge;
								}
								if ($dogHumanAge > 44) {
									$type = " a Senior dog";
								} else if ($dogHumanAge > 18) {
									$type = " an Adult dog";
								} else {
									$type = " a Puppy dog";
								}
							} else {
								$this->param['error'] = 'Please enter Human Life Expectancy greater than 0.';
								return $this->param;
							}
						} else {
							$this->param['error'] = 'Please enter Second Year Aging greater than 0.';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Please enter First Year Aging greater than 0.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please select Dog Breed.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please select Dog Age.';
				return $this->param;
			}
			$name = $data[0];
			$f1 = $data[4];
			$f2 = $data[5];
			$f3 = $data[6];
			$f4 = $data[7];
			$f5 = $data[8];
			$f6 = $data[9];
			$f7 = $data[10];
			$f8 = $data[11];
			$f9 = $data[12];
			$images = $data[3];
		}
		// dd($answer);
		if ($operations == "1") {
			$z = [];
			$z = explode(".", $answer);
			if (count($z) == "1") {
				$answer = $answer;
			} else if (count($z) == "2") {
				$answer = number_format($answer, 3);
			}
			$this->param['answer'] = $answer;
		} else if ($operations == "2") {
			$this->param['dogHumanAge'] = $dogHumanAge;
			$this->param['type'] = $type;
			$this->param['data'] = $data;
			$this->param['name'] = $name;
			$this->param['dogAge'] = $dogAge;
			$this->param['a'] = $a;
			$this->param['b'] = $b;
			$this->param['c'] = $c;
			$this->param['images'] = $images;
			$this->param['f1'] = $f1;
			$this->param['f2'] = $f2;
			$this->param['f3'] = $f3;
			$this->param['f4'] = $f4;
			$this->param['f5'] = $f5;
			$this->param['f6'] = $f6;
			$this->param['f7'] = $f7;
			$this->param['f8'] = $f8;
			$this->param['f9'] = $f9;
		}
		$this->param['operations'] = $operations;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// House Age Calculator
	public function house($request)
	{
		$build_date     = $request->input('build_date');
		$structure_type = $request->input('structure_type');

		if (!empty($structure_type) && !empty($build_date)) {
			$date1 = new Carbon($build_date);
			$date2 = new Carbon();
			if ($date1 < $date2) {
				$calculated_age = $date1->diff($date2);

				if ($structure_type == 'concrete') {
					$predicted_age = '50-60';
				} else if ($structure_type == 'cement-bricks') {
					$predicted_age = '75-100';
				} else if ($structure_type == 'wooden') {
					$predicted_age = '100-150';
				} else if ($structure_type == 'stone') {
					$predicted_age = '150-200';
				}

				$this->param['predicted_age'] = $predicted_age;
				$this->param['years']         = $calculated_age->y;
				$this->param['months']        = $calculated_age->m;
				$this->param['days']          = $calculated_age->d;
				$this->param['RESULT'] 		  = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// flooring calculator
	public function flooring($request)
	{
		$room_length = $request->input('room_length');
		$room_length_unit = $request->input('room_length_unit');
		$room_width = $request->input('room_width');
		$room_width_unit = $request->input('room_width_unit');
		$cost = $request->input('cost');
		$cost_unit = $request->input('cost_unit');
		$waste_factor = $request->input('waste_factor');
		$currancy = $request->input('currancy');
		$cost_unit = str_replace($currancy, '', $cost_unit);
		// dd($cost_unit);

		function unit_convert1($unit, $value)
		{
			if ($unit == "cm") {
				$val1 = $value * 0.01;
			} else if ($unit == "m") {
				$val1 = $value * 1;
			} else if ($unit == "in") {
				$val1 = $value * 0.0254;
			} else if ($unit == "ft") {
				$val1 = $value * 0.3048;
			}
			return $val1;
		}

		function unit_convert2($unit, $value)
		{
			if ($unit == " ft²") {
				$val2 = 10.76 * $value;
			} else if ($unit == " yd²") {
				$val2 = 1.20 * $value;
			} else if ($unit == " m²") {
				$val2 = 1 * $value;
			}
			return $val2;
		}
		$sum = 0;
		$y = 0;
		while ($y < count($room_length_unit) && $y < count($room_width_unit)) {
			if ($room_length_unit[$y] == "cm" || $room_length_unit[$y] == "m" || $room_length_unit[$y] == "in" || $room_length_unit[$y] == "ft") {
				if (is_numeric($room_length[$y])) {
					$length_value = unit_convert1($room_length_unit[$y], $room_length[$y]);
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
			if ($room_width_unit[$y] == "cm" || $room_width_unit[$y] == "m" || $room_width_unit[$y] == "in" || $room_width_unit[$y] == "ft") {
				if (is_numeric($room_width[$y])) {
					$width_value = unit_convert1($room_width_unit[$y], $room_width[$y]);
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
			$y++;
			$sum = $sum + ($length_value * $width_value);
		}
		if (!empty($cost) && empty($waste_factor)) {
			if (is_numeric($cost)) {
				$cost_value = unit_convert2($cost_unit, $cost);
				$this->param['price'] = $cost_value * $sum;
				$this->param['area'] = $sum;
				$this->param['total_material'] = $sum;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if (!empty($cost) && !empty($waste_factor)) {
			if (is_numeric($cost) && is_numeric($waste_factor)) {
				$cost_value = unit_convert2($cost_unit, $cost);
				$waste_factorr = $sum * $waste_factor / 100;
				$this->param['area'] = $sum;
				$this->param['total_material'] = $sum + $waste_factorr;
				$this->param['price'] = $this->param['total_material'] * $cost_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			$this->param['area'] = $sum;
			$this->param['total_material'] = $sum;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}


	// Sobriety calculator
	public function sobriety($request)
	{
		$input = $request->input('input');
		$input2 = $request->input('input2');
		$submit = $request->input('submit');

		if ($submit) {
			$s_date = $input;
			$s_date = explode("-", $s_date);
			$e_date = $input2;
			$e_date = explode("-", $e_date);
			$s_hour = 0;
			$s_min = 0;
			$s_sec = 0;
			$e_hour = 0;
			$e_min = 0;
			$e_sec = 0;
			$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
			$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
			$diff = $to->diff($from);
			$years = $diff->y;
			$months = $diff->m;
			$days = $diff->d;
			$from = date('M d, Y', strtotime($input));
			$to = date('M d, Y', strtotime($input2));
			if ($input > $input2) {
				$new = $from;
				$from = $to;
				$to = $new;
			}
			$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
			$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);
			$diff = abs($d2 - $d1);
			$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)  / (60 * 60));
			$minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24  - $hours * 60 * 60) / 60);
			$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
			$day1 = $months * 30.417;
			$d1_ans = $day1 + $days;
			$months1 = $years * 12;
			$mon_ans = $months1 + $months;
			$startDate = new Carbon($input);
			$endDate = new Carbon($input2);
			$days_diff = $endDate->diff($startDate);
			$days_ans = $days_diff->format("%a");
			$hours_ans = $days_ans * 24;
			$weeks = floor($days_ans / 7);
			$w_days = $weeks * 7;
			$wd_ans = $days_ans - $w_days;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['from'] = $from;
		$this->param['diff'] = $diff;
		$this->param['to'] = $to;
		$this->param['years'] = $years;
		$this->param['months'] = $months;
		$this->param['hours'] = $hours;
		$this->param['days'] = $days;
		$this->param['d1_ans'] = $d1_ans;
		$this->param['mon_ans'] = $mon_ans;
		$this->param['days_ans'] = $days_ans;
		$this->param['hours_ans'] = $hours_ans;
		$this->param['weeks'] = $weeks;
		$this->param['wd_ans'] = $wd_ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// bike size calculator
	public function bike($request)
	{

		$bike_for           = $request->input('bike_for');
		$bike_type          = $request->input('bike_type');
		$kids_age           = $request->input('kids_age');
		$hight              = $request->input('hight');
		$hight_unit         = $request->input('hight_unit');
		$inseam_length      = $request->input('inseam_length');
		$inseam_length_unit = $request->input('inseam_length_unit');
		function convert_to_cm($unit, $value)
		{
			if ($unit == 'cm') {
				$ans = $value;
			} elseif ($unit == 'in') {
				$ans = $value * 2.54;
			} elseif ($unit == 'ft') {
				$ans = $value * 30.48;
			} elseif ($unit == 'mm') {
				$ans = $value / 10;
			}
			return $ans;
		}
		if (isset($bike_for)) {
			if ($bike_for == 'kids') {
				if (isset($kids_age)) {
					if ($kids_age == '2-3') {
						$wheel_size = 12;
						$hight      = '86-102';
					} else if ($kids_age == '2-4') {
						$wheel_size = 14;
						$hight      = '94-109';
					} else if ($kids_age == '4-6') {
						$wheel_size = 16;
						$hight      = '109-122';
					} else if ($kids_age == '5-8') {
						$wheel_size = 20;
						$hight      = '114-130';
					} else if ($kids_age == '8-11') {
						$wheel_size = 24;
						$hight      = '122-135';
					} else if ($kids_age == '11+') {
						$wheel_size = 26;
						$hight      = '135-145';
					}

					$wheel_in = $wheel_size;
					$wheel_cm = number_format($wheel_size * 2.54, 2);
					$wheel_mm = number_format($wheel_size *  25.4, 2);
					$wheel_ft = number_format($wheel_size / 12, 2);

					$this->param['wheel_mm'] = $wheel_mm;
					$this->param['wheel_cm'] = $wheel_cm;
					$this->param['wheel_in'] = $wheel_in;
					$this->param['wheel_ft'] = $wheel_ft;
					$this->param['hight']    = $hight;
					$this->param['kids_age'] = $kids_age;
					$this->param['RESULT']   = 1;

					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (isset($bike_type) && is_numeric($inseam_length) && is_numeric($hight)) {
					$inseam_length_cm = convert_to_cm($inseam_length_unit, $inseam_length);
					$hight_in_cm = convert_to_cm($hight_unit, $hight);

					if ($bike_type == 'trekking' || $bike_type == 'city' || $bike_type == 'hybrid') {
						$frame_size = $inseam_length_cm * 0.64;
					} else if ($bike_type == 'road') {
						$frame_size = $inseam_length_cm * 0.67;
					} else if ($bike_type == 'mountain') {
						$road_frame_size = $inseam_length_cm * 0.67;
						$frame_size = $road_frame_size - 11;
					}

					$frame_mm = number_format($frame_size * 10, 2);
					$frame_cm = number_format($frame_size, 2);
					$frame_in = number_format($frame_size / 2.54, 2);
					$frame_ft = number_format($frame_size / 30.48, 2);

					$inseam_mm = number_format($inseam_length_cm * 10, 2);
					$inseam_cm = number_format($inseam_length_cm, 2);
					$inseam_in = number_format($inseam_length_cm / 2.54, 2);
					$inseam_ft = number_format($inseam_length_cm / 30.48, 2);

					$hight_mm   = number_format($hight_in_cm * 10, 2);
					$hight_cm   = number_format($hight_in_cm, 2);
					$hight_in   = number_format($hight_in_cm / 2.54, 2);
					$hight_ft   = number_format($hight_in_cm / 30.48, 2);

					$crank_size_mm  = $inseam_length_cm * 1.25 + 65;  //ans (mm)

					$crank_mm   = number_format($crank_size_mm, 2);
					$crank_cm   = number_format($crank_size_mm / 10, 2);
					$crank_in   = number_format($crank_size_mm / 25.4, 2);
					$crank_ft   = number_format($crank_size_mm / 304.8, 2);

					$crank_dia_mm = number_format($crank_mm * 2, 2);
					$crank_dia_cm = number_format($crank_cm * 2, 2);
					$crank_dia_in = number_format($crank_in * 2, 2);
					$crank_dia_ft = number_format($crank_ft * 2, 2);

					$this->param['frame_mm']     = $frame_mm;
					$this->param['frame_cm']     = $frame_cm;
					$this->param['frame_in']     = $frame_in;
					$this->param['frame_ft']     = $frame_ft;
					$this->param['crank_mm']     = $crank_mm;
					$this->param['crank_cm']     = $crank_cm;
					$this->param['crank_in']     = $crank_in;
					$this->param['crank_ft']     = $crank_ft;
					$this->param['crank_dia_mm'] = $crank_dia_mm;
					$this->param['crank_dia_cm'] = $crank_dia_cm;
					$this->param['crank_dia_in'] = $crank_dia_in;
					$this->param['crank_dia_ft'] = $crank_dia_ft;
					$this->param['hight_mm']     = $hight_mm;
					$this->param['hight_cm']     = $hight_cm;
					$this->param['hight_in']     = $hight_in;
					$this->param['hight_ft']     = $hight_ft;
					$this->param['inseam_in']    = $inseam_in;
					$this->param['inseam_cm']    = $inseam_cm;
					$this->param['inseam_mm']    = $inseam_mm;
					$this->param['inseam_ft']    = $inseam_ft;
					$this->param['RESULT']       = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Pant Size Calculator
	public function pant($request)
	{
		$submit = trim($request->input('submit'));
		$weist = trim($request->input('weist'));
		$length = trim($request->input('length'));
		$gender = trim($request->input('gender'));
		$measure = trim($request->input('measure'));
		$measure_in_weiat = trim($request->input('measure_in_weiat'));
		$measure_in_length = trim($request->input('measure_in_length'));


		if ($measure_in_weiat == 'cm') {
			$measure_in_weiat = 'centimeter_weist';
		} else if ($measure_in_weiat == 'dm') {
			$measure_in_weiat = 'decimeter_weist';
		} else if ($measure_in_weiat == 'in') {
			$measure_in_weiat = 'inches_weist';
		}

		if ($measure_in_length == 'cm') {
			$measure_in_length = 'centimeter_length';
		} else if ($measure_in_length == 'dm') {
			$measure_in_length = 'decimeter_length';
		} else if ($measure_in_length == 'in') {
			$measure_in_length = 'inches_length';
		}


		if ($submit) {
			// -----------------------------------Womens table values ------------------------------------
			$waist_women = ['25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39'];
			$length_women = ['32', '32', '32', '32', '32', '32', '32', '32', '32', '32', '32', '32', '32', '32', '32'];
			$inda_women = ['26', '26', '28', '28', '30', '30', '32', '32', '34', '34', '36', '36', '38', '38', '40'];
			$usa_women = [
				'25/32, 0, or XXS',
				'26/32, 2, or XS',
				'27/32, 4, or XS',
				'28/32, 6, or S',
				'29/32, 8, or S',
				'30/32, 10, or M',
				'31/32, 12, or M',
				'32/32, 14, or L',
				'33/32, 16, or L',
				'34/32, 18, or XL',
				'35/32, 20, or XL',
				'36/32, 22, or XXL',
				'37/32, 24, or XXL',
				'38/32, 26, or XXXL',
				'39/32, 28, or XXXL'
			];
			$uk_women = ['4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32'];
			$eu_women = ['32', '34', '36', '38', '40', '42', '44', '46', '48', '50', '52', '54', '56', '58', '60'];
			$it_women = ['36', '38', '40', '42', '44', '46', '48', '50', '52', '54', '56', '58', '60', '62', '64'];
			$ru_women = ['38', '38/40', '40', '42/44', '46', '48', '50', '54', '58', '60/62', '64', '66/68', '70', 'Not Available', 'Not Available'];
			$ja_women = ['7', '7/9', '9', '9/11', '11', '11/13', '13', '13/15', '13/15', '15', '15/17', '17', 'Not Available', 'Not Available', 'Not Available'];
			//-------------------------------------------------------------------------------------------

			//-----------------------------------Mens table Values --------------------------------------

			$waist_men = ['28', '29', '30', '32', '33', '34', '36', '38', '40', '42', '44'];
			$length_men = ['30', '30', '32', '32', '32', '32', '34', '34', '34', '34', '34'];
			$inda_men = ['28', '30', '30', '32', '34', '34', '36', '38', '40', '42', '44'];
			$usa_men = [
				'28/30, 30, or XS',
				'29/30, 32, or XS',
				'30/32, 34, or S',
				'32/32, 36, or S',
				'33/32, 38, or M',
				'34/32, 40, or M',
				'36/34, 42, or L',
				'38/34, 44, or L',
				'40/34, 46, or XL',
				'42/34, 48, or XL',
				'44/34, 50, or XXL'
			];
			$uk_men = ['30', '32', '34', '36', '38', '40', '42', '44', '46', '48', '50'];
			$eu_men = ['40', '42', '44', '46', '48', '50', '52', '54', '56', '58', '60'];
			$it_men = ['30', '32', '34', '46', '48', '50', '52', '54', '56', '58', '60'];

			//-------------------------------------------------------------------------------------------  

			if (!empty($weist) && !empty($length)) {

				if ($measure == 'pair') {
					$weist = $weist * 2;
				}
				$result_weist = "";
				$result_length = "";
				$result_india = "";
				$result_us = "";
				$result_uk = "";
				$result_eu = "";
				$result_it = "";
				$result_ru = "";
				$result_ja = "";
				$check_length = false;
				$check_weist = false;

				// ---------------------------Women Portion-------------------------------
				if ($gender == 'female') {

					// ----------------------------------measure check wiest--------------------------------------------
					if ($measure_in_weiat == "centimeter_weist") {

						for ($i = 0; $i < sizeof($waist_women); $i++) {
							$waist_women[$i] = $waist_women[$i] * 2.54;
						}

						if ($weist < 7.5) {
							$check_weist = false;
							$this->param['error'] = 'Waist should be greater then 7.5';
							return $this->param;
						} else {
							$check_weist = true;
						}
					} else if ($measure_in_weiat == "decimeter_weist") {

						for ($i = 0; $i < sizeof($waist_women); $i++) {
							$waist_women[$i] = $waist_women[$i] * 0.254;
						}
						if ($weist < 7.5) {

							$check_weist = false;
							$this->param['error'] = 'Waist should be greater then 7.5';
							return $this->param;
						} else {
							$check_weist = true;
						}
					} else if ($measure_in_weiat == "inches_weist") {

						if ($weist < 15) {
							// echo "<script>alert('entered')</script>";
							$check_weist = false;
							$this->param['error'] = 'Waist should be greater then 15';
							return $this->param;
						} else {
							$check_weist = true;
						}
					}


					// -------------------------------------------------------------------------------------------------

					// ----------------------------------measure check length--------------------------------------------
					if ($measure_in_length == "centimeter_length") {
						for ($i = 0; $i < sizeof($length_women); $i++) {
							$length_women[$i] = $length_women[$i] * 2.54;
						}
						if ($length < 7.5) {
							$check_length = false;
							$this->param['error'] = 'Length should be greater then 7.5';
							return $this->param;
						} else {
							$check_length = true;;
						}
					} else if ($measure_in_length == "decimeter_length") {
						for ($i = 0; $i < sizeof($length_women); $i++) {
							$length_women[$i] = $length_women[$i] * 0.254;
						}
						if ($length < 7.5) {
							$check_length = false;
							$this->param['error'] = 'Length should be greater then 7.5';
							return $this->param;
						} else {
							$check_length = true;;
						}
					} else if ($measure_in_length == "inches_length") {
						if ($length < 15) {
							$check_length = false;
							$this->param['error'] = 'Length should be greater then 15';
							return $this->param;
						} else {
							$check_length = true;;
						}
					}

					// -------------------------------------------------------------------------------------------------
					if ($check_weist == true && $check_length == true) {


						for ($i = 0; $i < sizeof($waist_women); $i++) {

							if ($weist == $waist_women[$i] && $length == $length_women[$i]) {

								$result_weist = $i;
								$result_length = $i;
								break;
							} else if ($weist < $waist_women[$i] && $length < $length_women[$i]) {

								$result_weist = $i;
								$result_length = $i;
								break;
							} else if ($weist > $waist_women[$i]) {


								if ($length > $length_women[$i]) {
									$result_weist = "";
									$result_length = "";
								} else if ($length < $length_women[$i]) {
									$result_weist = "";
									$result_length = "";
								}
							} else {
								if ($length == $length_women[$i]) {
									$result_weist = $i;
									$result_length = $i;

									break;
								}
								if ($length < $length_women[$i]) {
									//    if($length+1==$length_men[$i])
									$result_weist = $i;
									$result_length = $i;

									break;
								} else {
									$result_weist = "";
									$result_length = "";

									break;
								}
							}
						}
						if (is_numeric($result_weist) && is_numeric($result_length)) {

							$result_india = $inda_women[$result_weist];
							$result_us = $usa_women[$result_weist];
							$result_uk = $uk_women[$result_weist];
							$result_eu = $eu_women[$result_weist];
							$result_it = $it_women[$result_weist];
							$result_ru = $ru_women[$result_weist];
							$result_ja = $ja_women[$result_weist];
						} else {

							$result_india = "";
							$result_us = "";
							$result_uk = "";
							$result_eu = "";
							$result_it = "";
							$result_ru = "";
							$result_ja = "";
							$this->param['error'] = 'Please Enter Correct Values!';
							return $this->param;

							// echo "<script>alert('entered check')</script>";
							//      die;

						}
					} else {
						$result_india = "";
						$result_us = "";
						$result_uk = "";
						$result_eu = "";
						$result_it = "";
						$result_ru = "";
						$result_ja = "";
						$this->param['error'] = 'Please Enter Correct Values!';
						return $this->param;
					}

					$this->param['result_india'] = $result_india;
					$this->param['result_us'] = $result_us;
					$this->param['result_uk'] = $result_uk;
					$this->param['result_eu'] = $result_eu;
					$this->param['result_it'] = $result_it;
					$this->param['result_ru'] = $result_ru;
					$this->param['result_ja'] = $result_ja;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else if ($gender == 'male') {
					// ----------------------------------measure check wiest--------------------------------------------
					if ($measure_in_weiat == "centimeter_weist") {

						for ($i = 0; $i < sizeof($waist_men); $i++) {
							$waist_men[$i] = $waist_men[$i] * 2.54;
						}
						if ($weist < 7.5) {
							$check_weist = false;
							$this->param['error'] = 'Waist should be greater then 7.5';
							return $this->param;
						} else {
							$check_weist = true;
							$flag = "";
						}
					} else if ($measure_in_weiat == "decimeter_weist") {
						for ($i = 0; $i < sizeof($waist_men); $i++) {
							$waist_men[$i] = $waist_men[$i] * 0.254;
						}
						if ($weist < 7.5) {
							$check_weist = false;
							$this->param['error'] = 'Waist should be greater then 7.5';
							return $this->param;
						} else {
							$check_weist = true;
							$flag = "";
						}
					} else if ($measure_in_weiat == "inches_weist") {
						if ($weist < 15) {
							$check_weist = false;
							$this->param['error'] = 'Waist should be greater then 15';
							return $this->param;
						} else {
							$check_weist = true;
							$flag = "";
						}
					}
					// -------------------------------------------------------------------------------------------------
					// ----------------------------------measure check length--------------------------------------------
					if ($measure_in_length == "centimeter_length") {
						for ($i = 0; $i < sizeof($length_men); $i++) {
							$length_men[$i] = $length_men[$i] * 2.54;
						}
						if ($length < 7.5) {
							$check_length = false;
							$this->param['error'] = 'Length should be greater then 7.5';
							return $this->param;
						} else {
							$check_length = true;;
						}
					} elseif ($measure_in_length == "decimeter_length") {
						for ($i = 0; $i < sizeof($length_men); $i++) {
							$length_men[$i] = $length_men[$i] * 0.254;
						}
						if ($length < 7.5) {
							$check_length = false;
							$this->param['error'] = 'Length should be greater then 7.5';
							return $this->param;
						} else {
							$check_length = true;;
						}
					} elseif ($measure_in_length == "inches_length") {
						if ($length < 15) {
							$check_length = false;
							$this->param['error'] = 'Length should be greater then 15';
							return $this->param;
						} else {
							$check_length = true;
						}
					}
					// -------------------------------------------------------------------------------------------------
					if ($check_weist == true && $check_length == true) {
						for ($i = 0; $i < sizeof($waist_men); $i++) {
							if ($weist == $waist_men[$i] && $length == $length_men[$i]) {

								$result_weist = $i;
								$result_length = $i;
								break;
							} else if ($weist < $waist_men[$i] && $length < $length_men[$i]) {
								// echo $weist.''.$waist_men[$i];

								$result_weist = $i;
								$result_length = $i;
								break;
							} else if ($weist > $waist_men[$i]) {


								if ($length > $length_men[$i]) {
									$result_weist = "";
									$result_length = "";
								} else if ($length < $length_men[$i]) {
									$result_weist = "";
									$result_length = "";
								}
							} else {
								if ($length == $length_men[$i]) {
									$result_weist = $i;
									$result_length = $i;
									break;
								}
								if ($length < $length_men[$i]) {

									//    if($length+1==$length_men[$i])
									$result_weist = $i;
									$result_length = $i;
									break;
								} else {
									$result_weist = "";
									$result_length = "";

									break;
								}
							}
						}

						if (is_numeric($result_weist) && is_numeric($result_length)) {

							$result_india = $inda_men[$result_weist];
							$result_us = $usa_men[$result_weist];
							$result_uk = $uk_men[$result_weist];
							$result_eu = $eu_men[$result_weist];
							$result_it = $it_men[$result_weist];
						} else {
							$result_india = "";
							$result_us = "";
							$result_uk = "";
							$result_eu = "";
							$result_it = "";
							$result_ru = "";
							$result_ja = "";
							$this->param['error'] = 'Please Enter Correct Values!';
							return $this->param;
						}
					} else {
						$result_india = "";
						$result_us = "";
						$result_uk = "";
						$result_eu = "";
						$result_it = "";
						$result_ru = "";
						$result_ja = "";
						$this->param['error'] = 'Please Enter Correct Values!';
						return $this->param;
					}
					$this->param['result_india'] = $result_india;
					$this->param['result_us'] = $result_us;
					$this->param['result_uk'] = $result_uk;
					$this->param['result_eu'] = $result_eu;
					$this->param['result_it'] = $result_it;
					$this->param['result_ru'] = $result_ru;
					$this->param['result_ja'] = $result_ja;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// shoe size calculator
	public function shoe($request)
	{

		// dd($request->all());
		$gen       = trim($request->input('gen'));
		$country   = trim($request->input('country'));
		$size      = trim($request->input('size'));
		// dd($request->input());
		if (!empty($size)) {
			if ($size >= 0) {
				if ($country == 'fcm') {
					$fcm = $size;
				} elseif ($country == 'fin') {
					$fcm = $size * 2.54;
				} elseif ($country == 'ko') {
					$fcm = ($size / 10);
				} elseif ($country == 'mj') {
					$fcm = $size;
				} elseif ($country == 'm') {
					$fcm = $size / 10;
				}
				if ($gen == 'ad') {
					if ($country == 'us') {
						$fcm = (($size + 24) * 0.847) - (2 * 0.847);
					} elseif ($country == 'uk') {
						$fcm = ((($size + 25) * 0.847) - (2 * 0.847));
					} elseif ($country == 'eu') {
						$fcm = (($size * 0.667) - (2 * 0.667));
					}
					$fcm = $fcm;
					$fin = $fcm / 2.54;
					$us =  (($fcm + (2 * 0.847)) / 0.847) - 24;
					$ko = (($us + 22) / 3) * 25.5;
					$wo =  (($fcm + (2 * 0.847)) / 0.847) - 23;
					$uk = (($fin * 3) - 23);
					$eu = floor(1.27 * (($uk + 23) + 2));
					$m = $fcm * 10;
					$mj = $fcm;
				} elseif ($gen == 'c') {
					if ($country == 'us') {
						$fcm = (($size + 11.5 - 0.4) * 0.847) / 1.08;
					} elseif ($country == 'uk') {
						$fcm = (($size + 12 - 0.4) * 0.847) / 1.08;
					} elseif ($country == 'eu') {
						$fcm = (($size * 0.667) / 1.08);
					}

					$ko = $fcm * 10;
					$fcm = $fcm;
					$fin = $fcm / 2.54;
					$us =  (($fcm * 1.08) / 0.847) - 11.5 + 0.4;
					$uk = (($fcm * 1.08) / 0.847) - 12 + 0.4;
					$eu =  ($fcm + (2 * 0.667)) / 0.667;
					$m = $fcm * 10;
					$mj = $fcm;
					$wo = 'not yest';
				}
			}
			$this->param['us']      	= $us;
			$this->param['fcm']     	= $fcm;
			$this->param['fin'] 		= $fin;
			$this->param['uk']       	= $uk;
			$this->param['eu']   		= $eu;
			$this->param['ko']   		= $ko;
			$this->param['wo']     		= $wo;
			$this->param['m']   		= $m;
			$this->param['mj']   		= $mj;
			// $this->param['al']   		= $al;
			$this->param['country']   		= $country;
			$this->param['gen']   		= $gen;
			$this->param['RESULT'] 	    = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Ring size Calculator
	public function ring($request)
	{
		$unit     = $request->input('unit');
		$cd       = $request->input('to_measure');
		$dia_mm		= $request->input('d_o_r_mm');
		$dia_in		= $request->input('d_o_r_in');
		$cir_mm		= $request->input('c_o_f_mm');
		$cir_in		= $request->input('c_o_f_in');
		if (is_numeric($cir_mm) && is_numeric($cir_in) && is_numeric($dia_mm) && is_numeric($dia_in) && !empty($cd) && !empty($unit)) {
			$pie = 3.14159;

			if ($cd == 'd_o_r') {
				if ($unit == 'millimeters') {
					$ring_size = round($dia_mm * $pie, 2);
				} elseif ($unit === 'inches') {
					$ring_size = round($dia_in * $pie, 2);
				}
			} elseif ($cd == 'c_o_f') {
				if ($unit == 'millimeters') {
					$ring_size = round($cir_mm / $pie, 2);
				} elseif ($unit === 'inches') {
					$ring_size = round($cir_in / $pie, 3);
				}
			}

			if ($ring_size == 9.91 or $ring_size == 0.388 or $ring_size == 31.13 or $ring_size == 1.23) {
				$us_ca = '0000';
				$uk_au = '-';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 10.72 or $ring_size == 0.442 or $ring_size == 33.68 or $ring_size == 1.39) {
				$us_ca = '00';
				$uk_au = '-';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 11.53 or $ring_size == 0.454 or $ring_size == 36.22 or $ring_size == 1.43) {
				$us_ca = '0';
				$uk_au = '-';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 11.95 or $ring_size == 0.474 or $ring_size == 37.54 or $ring_size == 1.49) {
				$us_ca = '1/2';
				$uk_au = 'A';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 12.18 or $ring_size == 0.482 or $ring_size == 38.26 or $ring_size == 1.51) {
				$us_ca = '3/4';
				$uk_au = 'A 1/2';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 12.37 or $ring_size == 0.487 or $ring_size == 38.86 or $ring_size == 1.53) {
				$us_ca = '1';
				$uk_au = 'B';
				$f = '-';
				$g = '-';
				$j = '1';
				$s = '-';
			} elseif ($ring_size == 12.60 or $ring_size == 0.496 or $ring_size == 39.58 or $ring_size == 1.56) {
				$us_ca = '1 1/4';
				$uk_au = 'B 1/2';
				$f = '-';
				$g = '-';
				$j = '1';
				$s = '-';
			} elseif ($ring_size == 12.78 or $ring_size == 0.503 or $ring_size == 40.15 or $ring_size == 1.58) {
				$us_ca = '1 1/2';
				$uk_au = 'C';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 13.00 or $ring_size == 0.512 or $ring_size == 40.84 or $ring_size == 1.61) {
				$us_ca = '1 3/4';
				$uk_au = 'C 1/2';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 13.21 or $ring_size == 0.520 or $ring_size == 41.50 or $ring_size == 1.63) {
				$us_ca = '2';
				$uk_au = 'D';
				$f = '41 1/2';
				$g = '13 1/2';
				$j = '2';
				$s = '1 1/2';
			} elseif ($ring_size == 13.41 or $ring_size == 0.528 or $ring_size == 42.13 or $ring_size == 1.66) {
				$us_ca = '2 1/4';
				$uk_au = 'D 1/2';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 13.61 or $ring_size == 0.536 or $ring_size == 42.76 or $ring_size == 1.68) {
				$us_ca = '2 1/2';
				$uk_au = 'E';
				$f = '42 3/4';
				$g = '13 3/4';
				$j = '3';
				$s = '2 3/4';
			} elseif ($ring_size == 13.83 or $ring_size == 0.544 or $ring_size == 43.45 or $ring_size == 1.71) {
				$us_ca = '2 3/4';
				$uk_au = 'E 1/2';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 14.05 or $ring_size == 0.553 or $ring_size == 44.14 or $ring_size == 1.74) {
				$us_ca = '3';
				$uk_au = 'F';
				$f = '44';
				$g = '14';
				$j = '4';
				$s = '4';
			} elseif ($ring_size == 14.15 or $ring_size == 0.557 or $ring_size == 44.45 or $ring_size == 1.75) {
				$us_ca = '3 1/8';
				$uk_au = 'F 1/2';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 14.25 or $ring_size == 0.561 or $ring_size == 44.77 or $ring_size == 1.76) {
				$us_ca = '3 1/4';
				$uk_au = 'F 3/4';
				$f = '-';
				$g = '-';
				$j = '-';
				$s = '-';
			} elseif ($ring_size == 14.36 or $ring_size == 0.565 or $ring_size == 45.11 or $ring_size == 1.77) {
				$us_ca = '3 1/2';
				$uk_au = 'G 1/4';
				$f = '45 1/4';
				$g = '-';
				$j = '5';
				$s = '5 1/4';
			} elseif ($ring_size == 14.45 or $ring_size == 0.569 or $ring_size == 45.40 or $ring_size == 1.79) {
				$us_ca = '3 3/4';
				$uk_au = 'H';
				$f = '46 1/2';
				$g = '-';
				$j = '-';
				$s = '6 1/2';
			} elseif ($ring_size == 14.56 or $ring_size == 0.573 or $ring_size == 45.74 or $ring_size == 1.80) {
				$us_ca = '4';
				$uk_au = 'H 1/2';
				$f = '-';
				$g = '15';
				$j = '7';
				$s = '-';
			} elseif ($ring_size == 14.65 or $ring_size == 0.577 or $ring_size == 46.02 or $ring_size == 1.81) {
				$us_ca = '4 1/4';
				$uk_au = 'I';
				$f = '47 3/4';
				$g = '-';
				$j = '-';
				$s = '7 3/4';
			} elseif ($ring_size == 14.86 or $ring_size == 0.585 or $ring_size == 46.68 or $ring_size == 1.84) {
				$us_ca = '4 1/2';
				$uk_au = 'I 1/2';
				$f = '-';
				$g = '15 1/4';
				$j = '8';
				$s = '-';
			} elseif ($ring_size == 15.04 or $ring_size == 0.592 or $ring_size == 47.25 or $ring_size == 1.86) {
				$us_ca = '4 5/8';
				$uk_au = 'J';
				$f = '49';
				$g = '15 1/2';
				$s = '9';
				$j = '-';
			} elseif ($ring_size == 15.27 or $ring_size == 0.601 or $ring_size == 47.97 or $ring_size == 1.89) {
				$us_ca = '5';
				$uk_au = 'J 1/2';
				$f = '-';
				$g = '15 3/4';
				$s = '-';
				$j = '9';
			} elseif ($ring_size == 15.40 or $ring_size == 0.606 or $ring_size == 48.38 or $ring_size == 1.90) {
				$us_ca = '5 1/8';
				$uk_au = 'K';
				$f = '50';
				$g = '-';
				$s = '10';
				$j = '-';
			} elseif ($ring_size == 15.53 or $ring_size == 0.611 or $ring_size == 48.79 or $ring_size == 1.92) {
				$us_ca = '4 3/4';
				$uk_au = 'J 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 15.70 or $ring_size == 0.618 or $ring_size == 49.32 or $ring_size == 1.94) {
				$us_ca = '3 3/8';
				$uk_au = 'G';
				$f = '-';
				$g = '14 1/2';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 15.80 or $ring_size == 0.622 or $ring_size == 49.64 or $ring_size == 1.95) {
				$us_ca = '5 3/8';
				$uk_au = 'K 1/2';
				$f = '-';
				$g = '10';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 15.90 or $ring_size == 0.626 or $ring_size == 49.95 or $ring_size == 1.97) {
				$us_ca = '5 1/4';
				$uk_au = 'K 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 16.00 or $ring_size == 0.630 or $ring_size == 50.27 or $ring_size == 1.98) {
				$us_ca = '5 3/8';
				$uk_au = 'K 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '10';
			} elseif ($ring_size == 16.10 or $ring_size == 0.634 or $ring_size == 50.58 or $ring_size == 1.99) {
				$us_ca = '5 1/2';
				$uk_au = 'L';
				$f = '51 3/4';
				$g = '16';
				$s = '11 3/4';
				$j = '-';
			} elseif ($ring_size == 16.30 or $ring_size == 0.642 or $ring_size == 51.21 or $ring_size == 2.02) {
				$us_ca = '5 3/4';
				$uk_au = 'L 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 16.41 or $ring_size == 0.646 or $ring_size == 51.55 or $ring_size == 2.03) {
				$us_ca = '5 7/8';
				$uk_au = 'L 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 16.51 or $ring_size == 0.650 or $ring_size == 51.87 or $ring_size == 2.04) {
				$us_ca = '6';
				$uk_au = 'M';
				$f = '52 3/4';
				$g = '16 1/2';
				$s = '12 3/4';
				$j = '12';
			} elseif ($ring_size == 16.71 or $ring_size == 0.658 or $ring_size == 51.50 or $ring_size == 2.07) {
				$us_ca = '6 1/4';
				$uk_au = 'M 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 16.92 or $ring_size == 0.666 or $ring_size == 53.16 or $ring_size == 2.09) {
				$us_ca = '6 1/2';
				$uk_au = 'N';
				$f = '54';
				$g = '17';
				$s = '14';
				$j = '13';
			} elseif ($ring_size == 17.13 or $ring_size == 0.674 or $ring_size == 53.82 or $ring_size == 2.12) {
				$us_ca = '6 3/4';
				$uk_au = 'N 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 17.35 or $ring_size == 0.683 or $ring_size == 54.51 or $ring_size == 2.15) {
				$us_ca = '7';
				$uk_au = 'O';
				$f = '55 1/4';
				$g = '17 1/4';
				$s = '15 1/4';
				$j = '14';
			} elseif ($ring_size == 17.45 or $ring_size == 0.687 or $ring_size == 54.82 or $ring_size == 2.16) {
				$us_ca = '7 1/4';
				$uk_au = 'O 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 17.75 or $ring_size == 0.699 or $ring_size == 55.76 or $ring_size == 2.20) {
				$us_ca = '7 1/2';
				$uk_au = 'P';
				$f = '56 1/2';
				$g = '17 3/4';
				$s = '16 1/2';
				$j = '15';
			} elseif ($ring_size == 17.97 or $ring_size == 0.707 or $ring_size == 56.45 or $ring_size == 2.22) {
				$us_ca = '7 3/4';
				$uk_au = 'P 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 18.19 or $ring_size == 0.716 or $ring_size == 57.15 or $ring_size == 2.25) {
				$us_ca = '8';
				$uk_au = 'Q';
				$f = '57 3/4';
				$g = '18';
				$s = '17 3/4';
				$j = '16';
			} elseif ($ring_size == 18.35 or $ring_size == 0.722 or $ring_size == 57.65 or $ring_size == 2.27) {
				$us_ca = '8 1/4';
				$uk_au = 'Q 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 18.53 or $ring_size == 0.729 or $ring_size == 58.21 or $ring_size == 2.29) {
				$us_ca = '8 1/2';
				$uk_au = 'Q 3/4';
				$f = '-';
				$g = '18 1/2';
				$s = '-';
				$j = '17';
			} elseif ($ring_size == 18.61 or $ring_size == 0.733 or $ring_size == 58.47 or $ring_size == 2.30) {
				$us_ca = '8 5/8';
				$uk_au = 'R';
				$f = '59';
				$g = '14 1/2';
				$s = '19';
				$j = '-';
			} elseif ($ring_size == 18.69 or $ring_size == 0.736 or $ring_size == 58.72 or $ring_size == 2.31) {
				$us_ca = '8 3/4';
				$uk_au = 'R 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 18.80 or $ring_size == 0.738 or $ring_size == 59.06 or $ring_size == 2.32) {
				$us_ca = '8 7/8';
				$uk_au = 'R 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 18.89 or $ring_size == 0.748 or $ring_size == 59.34 or $ring_size == 2.35) {
				$us_ca = '9';
				$uk_au = 'R 3/4';
				$f = '-';
				$g = '19';
				$s = '-';
				$j = '18';
			} elseif ($ring_size == 19.10 or $ring_size == 0.752 or $ring_size == 60.00 or $ring_size == 2.36) {
				$us_ca = '9 1/8';
				$uk_au = 'S';
				$f = '60 1/4';
				$g = '-';
				$s = '20 1/4';
				$j = '-';
			} elseif ($ring_size == 19.22 or $ring_size == 0.757 or $ring_size == 60.38 or $ring_size == 2.38) {
				$us_ca = '9 1/4';
				$uk_au = 'S 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 19.31 or $ring_size == 0.761 or $ring_size == 60.66 or $ring_size == 2.39) {
				$us_ca = '9 3/8';
				$uk_au = 'S 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 19.41 or $ring_size == 0.764 or $ring_size == 60.98 or $ring_size == 2.40) {
				$us_ca = '9 1/2';
				$uk_au = 'S 3/4';
				$f = '-';
				$g = '19 1/2';
				$s = '-';
				$j = '19';
			} elseif ($ring_size == 19.51 or $ring_size == 0.768 or $ring_size == 61.29 or $ring_size == 2.41) {
				$us_ca = '9 5/8';
				$uk_au = 'T';
				$f = '61 1/2';
				$g = '-';
				$s = '21 1/2';
				$j = '-';
			} elseif ($ring_size == 19.62 or $ring_size == 0.772 or $ring_size == 61.64 or $ring_size == 2.43) {
				$us_ca = '9 3/4';
				$uk_au = 'T 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 19.84 or $ring_size == 0.781 or $ring_size == 62.33 or $ring_size == 2.45) {
				$us_ca = '10';
				$uk_au = 'T 1/2';
				$f = '-';
				$g = '20';
				$s = '-';
				$j = '20';
			} elseif ($ring_size == 20.02 or $ring_size == 0.788 or $ring_size == 62.89 or $ring_size == 2.48) {
				$us_ca = '10 1/4';
				$uk_au = 'U';
				$f = '62 3/4';
				$g = '_';
				$s = '22 3/4';
				$j = '21';
			} elseif ($ring_size == 20.20 or $ring_size == 0.797 or $ring_size == 63.46 or $ring_size == 2.50) {
				$us_ca = '10 1/2';
				$uk_au = 'U 1/2';
				$f = '-';
				$g = '20 1/4';
				$s = '-';
				$j = '22';
			} elseif ($ring_size == 20.32 or $ring_size == 0.800 or $ring_size == 63.84 or $ring_size == 2.51) {
				$us_ca = '10 5/8';
				$uk_au = 'V';
				$f = '63';
				$g = '-';
				$s = '23 3/4';
				$j = '-';
			} elseif ($ring_size == 20.44 or $ring_size == 0.805 or $ring_size == 64.21 or $ring_size == 2.53) {
				$us_ca = '10 3/4';
				$uk_au = 'V 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 20.68 or $ring_size == 0.814 or $ring_size == 64.97 or $ring_size == 2.56) {
				$us_ca = '11';
				$uk_au = 'V 1/2';
				$f = '-';
				$g = '20 3/4';
				$s = '-';
				$j = '23';
			} elseif ($ring_size == 20.76 or $ring_size == 0.817 or $ring_size == 65.22 or $ring_size == 2.57) {
				$us_ca = '11 1/8';
				$uk_au = 'W';
				$f = '65';
				$g = '-';
				$s = '25';
				$j = '-';
			} elseif ($ring_size == 20.85 or $ring_size == 0.821 or $ring_size == 65.50 or $ring_size == 2.58) {
				$us_ca = '11 1/4';
				$uk_au = 'W 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 20.94 or $ring_size == 0.824 or $ring_size == 65.78 or $ring_size == 2.59) {
				$us_ca = '11 3/8';
				$uk_au = 'W 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 21.08 or $ring_size == 0.830 or $ring_size == 66.22 or $ring_size == 2.61) {
				$us_ca = '11 1/2';
				$uk_au = 'W 3/4';
				$f = '-';
				$g = '21';
				$s = '-';
				$j = '24';
			} elseif ($ring_size == 21.18 or $ring_size == 0.834 or $ring_size == 66.54 or $ring_size == 2.62) {
				$us_ca = '11 5/8';
				$uk_au = 'X';
				$f = '66 1/4';
				$g = '-';
				$s = '26 1/4';
				$j = '-';
			} elseif ($ring_size == 21.24 or $ring_size == 0.836 or $ring_size == 66.73 or $ring_size == 2.63) {
				$us_ca = '11 3/4';
				$uk_au = 'X 1/4';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 21.30 or $ring_size == 0.839 or $ring_size == 66.92 or $ring_size == 2.64) {
				$us_ca = '11 7/8';
				$uk_au = 'X 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 21.49 or $ring_size == 0.846 or $ring_size == 67.51 or $ring_size == 2.66) {
				$us_ca = '12';
				$uk_au = 'Y';
				$f = '67 1/2';
				$g = '21 1/4';
				$s = '27 1/2';
				$j = '25';
			} elseif ($ring_size == 21.69 or $ring_size == 0.854 or $ring_size == 68.14 or $ring_size == 2.68) {
				$us_ca = '12 1/4';
				$uk_au = 'Y 1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 21.89 or $ring_size == 0.862 or $ring_size == 68.77 or $ring_size == 2.71) {
				$us_ca = '12 1/2';
				$uk_au = 'Z';
				$f = '68 3/4';
				$g = '21 3/4';
				$s = '28 3/4';
				$j = '26';
			} elseif ($ring_size == 22.10 or $ring_size == 0.869 or $ring_size == 69.43 or $ring_size == 2.73) {
				$us_ca = '12 3/4';
				$uk_au = 'Z +1/2';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			} elseif ($ring_size == 22.33 or $ring_size == 0.879 or $ring_size == 70.15 or $ring_size == 2.76) {
				$us_ca = '13';
				$uk_au = 'Z+1';
				$f = '-';
				$g = '22';
				$s = '-';
				$j = '27';
			} elseif ($ring_size == 22.60 or $ring_size == 0.891 or $ring_size == 71 or $ring_size == 2.8) {
				$us_ca = '13 1/2';
				$uk_au = 'Z + 1.5';
				$f = '-';
				$g = '-';
				$s = '-';
				$j = '-';
			}
			$this->param['ring_size'] = $ring_size;
			$this->param['uk_au'] = $uk_au;
			$this->param['us_ca'] = $us_ca;
			$this->param['f'] = $f;
			$this->param['g'] = $g;
			$this->param['j'] = $j;
			$this->param['s'] = $s;
			$this->param['unit'] = $unit;
			$this->param['RESULT'] 	  = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// rent spiit
	public function rent($request)
	{
		$total_rent = $request->input('total_rent');
		// $currency   = $request->input('currency');
		$total_area = $request->input('total_area');
		$bedrooms   = $request->input('bedrooms');
		$room_area  = $request->input('room_area');
		$persons    = $request->input('persons');
		$bath       = $request->input('bath');
		// dd($request->input());
		if (is_numeric($total_rent) && is_numeric($total_area) && !empty($bedrooms) && !empty($persons) && !empty($room_area) && !empty($bath)) {
			if ($total_area >= array_sum($room_area)) {

				$common_area = $total_area - array_sum($room_area) - array_sum($bath);
				$rent_per_sq =  $total_rent / ($total_area - $common_area);

				for ($i = 1; $i <= $bedrooms; $i++) {
					$room_rent[$i] = (($room_area[$i] +  $bath[$i]) * $rent_per_sq) / $persons[$i];
				}
				$this->param['room_rent'] = $room_rent;
				$this->param['RESULT'] 	  = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Combined square footage of rooms should not exceed total square footage of house';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Gas Calculator
	public function gas($request)
	{
		$type              = $request->input('type');
		$week_day          = $request->input('week_day');
		$distance          = $request->input('distance');
		$distance_unit     = $request->input('distance_unit');
		$price             = $request->input('price');
		$price_unit        = $request->input('price_unit');
		$trip_type         = $request->input('trip_type');
		$peoples           = $request->input('peoples');
		$name_v1           = $request->input('name_v1');
		$fule_effi_v1      = $request->input('fule_effi_v1');
		$fule_effi_v1_unit = $request->input('fule_effi_v1_unit');
		$name_v2           = $request->input('name_v2');
		$fule_effi_v2      = $request->input('fule_effi_v2');
		$fule_effi_v2_unit = $request->input('fule_effi_v2_unit');
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy, '', $price_unit);
		// dd($price_unit);

		function convert_to_mile($unit, $value)
		{
			if ($unit == 'km') {
				$ans = $value / 1.609;
			} else {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_km($unit, $value)
		{
			if ($unit == 'mi') {
				$ans = $value * 1.609;
			} else {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_mpg($unit, $value)
		{
			if ($unit == 'kmpl') {
				$ans = $value * 2.352;
			} else {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_kmpl($unit, $value)
		{
			if ($unit == 'mpg') {
				$ans = $value / 2.352;
			} else {
				$ans = $value;
			}
			return $ans;
		}

		if (!empty($type) && !empty($trip_type) && !empty($name_v1) && is_numeric($fule_effi_v2) && !empty($name_v2) && is_numeric($distance) && is_numeric($week_day) && is_numeric($price) && is_numeric($fule_effi_v1)) {
			if ($distance_unit == 'km') {
				$distance_f     = convert_to_km($distance_unit, $distance);
				$fule_effi_v1_f = convert_to_kmpl($fule_effi_v1_unit, $fule_effi_v1);
				$fule_effi_v2_f = convert_to_kmpl($fule_effi_v2_unit, $fule_effi_v2);
				$price_f        = ($price_unit == " liter") ? $price : $price / 3.785;
			} else {
				$distance_f     = convert_to_mile($distance_unit, $distance);
				$fule_effi_v1_f = convert_to_mpg($fule_effi_v1_unit, $fule_effi_v1);
				$fule_effi_v2_f = convert_to_mpg($fule_effi_v2_unit, $fule_effi_v2);
				$price_f        = ($price_unit == " gallon") ? $price : $price * 3.785;
			}

			if ($type == "first") {
				$fule_req              = round($distance_f / $fule_effi_v1_f, 2);
				$fule_price_daily      = round($fule_req * $price_f, 2);

				$fule_req_weekly       = round($fule_req * $week_day, 2);
				$fule_price_weekly     = round($fule_price_daily * $week_day, 2);

				$fule_req_biweekly     = round($fule_req_weekly * 2, 2);
				$fule_price_biweekly   = round($fule_price_weekly * 2, 2);

				$fule_req_monthly      = round($fule_req_weekly * 4.345, 2);
				$fule_price_monthly    = round($fule_price_weekly * 4.345, 2);

				$fule_req_yearly       = round($fule_req_weekly * 52, 2);
				$fule_price_yearly     = round($fule_price_weekly * 52, 2);

				if (!empty($peoples)) {
					$each_pay = round($fule_price_daily / $peoples, 2);

					$this->param['each_pay']            = $each_pay;
				}

				$this->param['fule_req']            = $fule_req;
				$this->param['fule_req_weekly']     = $fule_req_weekly;
				$this->param['fule_req_biweekly']   = $fule_req_biweekly;
				$this->param['fule_req_monthly']    = $fule_req_monthly;
				$this->param['fule_req_yearly']     = $fule_req_yearly;
				$this->param['fule_price_daily']    = $fule_price_daily;
				$this->param['fule_price_weekly']   = $fule_price_weekly;
				$this->param['fule_price_biweekly'] = $fule_price_biweekly;
				$this->param['fule_price_monthly']  = $fule_price_monthly;
				$this->param['fule_price_yearly']   = $fule_price_yearly;
				$this->param['RESULT'] 	            = 1;
				return $this->param;
			} else {

				$fule_req_v1    = round(($distance_f * $trip_type) / $fule_effi_v1_f, 2);
				$price_price_v1 = round($fule_req_v1 * $price_f, 2);

				$fule_req_v2    = round(($distance_f * $trip_type) / $fule_effi_v2_f, 2);
				$price_price_v2 = round($fule_req_v2 * $price_f, 2);

				$diff           = abs($price_price_v1 - $price_price_v2);
				$weekly_saving  = round($diff * $week_day, 2);
				$monthly_saving = round($weekly_saving * 4.345, 2);
				$yearly_saving  = round($weekly_saving * 52, 2);

				$this->param['fule_req_v1']    = $fule_req_v1;
				$this->param['price_price_v1'] = $price_price_v1;
				$this->param['fule_req_v2']    = $fule_req_v2;
				$this->param['price_price_v2'] = $price_price_v2;
				$this->param['diff']           = $diff;
				$this->param['weekly_saving']  = $weekly_saving;
				$this->param['monthly_saving'] = $monthly_saving;
				$this->param['yearly_saving']  = $yearly_saving;
				$this->param['RESULT'] 	       = 1;
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Battery Life Calculator 
	public function battery($request)
	{
		$battery_capacity = $request->input('battery_capacity');
		$battery_units = $request->input('battery_units');
		$discharge_safety = $request->input('discharge_safety');
		$device_con1 = $request->input('device_con1');
		$device_con1_units = $request->input('device_con1_units');
		$awake_time = $request->input('awake_time');
		$awake_time_units = $request->input('awake_time_units');
		$device_con2 = $request->input('device_con2');
		$device_con2_units = $request->input('device_con2_units');
		$sleep_time = $request->input('sleep_time');
		$sleep_time_units = $request->input('sleep_time_units');

		if (is_numeric($battery_capacity) && is_numeric($discharge_safety) && is_numeric($device_con1) && is_numeric($awake_time) && is_numeric($device_con2) && is_numeric($sleep_time)) {
			if (isset($battery_units)) {
				if ($battery_units == 'Ah') {
					$battery_capacity = $battery_capacity * 1000;
				} else if ($battery_units == 'mAh') {
					$battery_capacity = $battery_capacity;
				}
			}
			if (isset($device_con1_units)) {
				if ($device_con1_units == 'A') {
					$device_con1 = $device_con1 * 1000;
				} else if ($device_con1_units == 'µA') {
					$device_con1 = $device_con1 * 1000;
				}
			}

			if (isset($awake_time_units)) {
				if ($awake_time_units == 'sec') {
					$awake_time = $awake_time;
				} else if ($awake_time_units == 'min') {
					$awake_time = $awake_time * 60;
				} else if ($awake_time_units == 'hrs') {
					$awake_time = $awake_time * 3600;
				} else if ($awake_time_units == 'days') {
					$awake_time = $awake_time * 86400;
				} else if ($awake_time_units == 'wks') {
					$awake_time = $awake_time * 604800;
				} else if ($awake_time_units == 'mos') {
					$awake_time = $awake_time * 2629800;
				} else if ($awake_time_units == 'yrs') {
					$awake_time = $awake_time * 31557600;
				}
			}

			if (isset($device_con2_units)) {
				if ($device_con1_units == 'A') {
					$device_con1 = $device_con1 * 0.001;
				} else if ($device_con1_units == 'µA') {
					$device_con1 = $device_con1 * 1000;
				} else if ($device_con1_units == 'mA') {
					$device_con1 = $device_con1;
				}
			}

			if (isset($sleep_time_units)) {
				if ($awake_time_units == 'sec') {
					$sleep_time = $sleep_time;
				} else if ($sleep_time == 'min') {
					$sleep_time = $sleep_time * 60;
				} else if ($sleep_time == 'hrs') {
					$sleep_time = $sleep_time * 3600;
				} else if ($sleep_time == 'days') {
					$sleep_time = $sleep_time * 86400;
				} else if ($sleep_time == 'wks') {
					$sleep_time = $sleep_time * 604800;
				} else if ($sleep_time == 'mos') {
					$sleep_time = $sleep_time * 2629800;
				} else if ($sleep_time == 'yrs') {
					$sleep_time = $sleep_time * 31557600;
				}
			}
			$per = $discharge_safety / 100;
			$x =  (1 - $per);
			$y = $battery_capacity / $device_con1;
			$Battery_life =  $y * $x;
			$Average_consumption = ($device_con1 * $awake_time + $device_con2 * $sleep_time) / ($awake_time + $sleep_time);
			$this->param['Battery_life'] = $Battery_life;
			$this->param['Average_consumption'] = $Average_consumption;
		} else {
			$this->param['error'] =  'Please ! Check Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	// Travel Time Calculator
	public function travel($request)
	{

		$distance       = $request->input('distance');
		$distance_unit  = $request->input('distance_unit');
		$speed          = $request->input('speed');
		$speed_unit     = $request->input('speed_unit');
		$break_hrs      = $request->input('break_hrs');
		$break_min      = $request->input('break_min');
		$dep_time       = $request->input('dep_time');
		$fule_effi      = $request->input('fule_effi');
		$fule_effi_unit = $request->input('fule_effi_unit');
		$price          = $request->input('price');
		$price_unit     = $request->input('price_unit');
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy, '', $price_unit);
		$passenger      = $request->input('passenger');
		function convert_to_km($unit, $value)
		{
			if ($unit == 'mi') {
				$ans = $value * 1.609;
			} else {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_kmpl($unit, $value)
		{
			if ($unit == 'mpg') {
				$ans = $value / 2.352;
			} else {
				$ans = $value;
			}
			return $ans;
		}
		if (is_numeric($distance) && is_numeric($speed) && is_numeric($break_hrs) && is_numeric($break_min) && is_numeric($fule_effi) && is_numeric($price) && is_numeric($passenger) && !empty($dep_time)) {
			// dd('$request->input()');

			$distance_f  = convert_to_km($distance_unit, $distance);
			$fule_effi_f = convert_to_kmpl($fule_effi_unit, $fule_effi);
			$speed_f     = convert_to_km($speed_unit, $speed);
			$price_f     = ($price_unit == " liter") ? $price : $price / 3.785;

			$break_hr    = (($break_hrs * 60) + $break_min) / 60;
			$travel_time = ($distance_f / $speed_f) + $break_hr;
			$time_array  = explode('.', $travel_time);
			$hours       = $time_array[0];
			$mins        = round(($travel_time - $hours) * 60);

			$tym        = date('Y-m-d H:i:s', strtotime("+" . $hours . " hours", strtotime($dep_time)));
			$arrival    = date('M d, Y h:i:s A', strtotime("+" . $mins . " minutes", strtotime($tym)));
			$depature   = date('M d, Y h:i:s A', strtotime($dep_time));

			$fule_req   = round($distance_f / $fule_effi_f, 2);
			$fule_price = round($fule_req * $price_f, 2);
			$per_person = round($fule_price / $passenger, 2);

			$this->param['hours']      = $hours;
			$this->param['mins']       = $mins;
			$this->param['depature']   = $depature;
			$this->param['arrival']    = $arrival;
			$this->param['fule_price'] = number_format($fule_price, 2);
			$this->param['per_person'] = number_format($per_person, 2);
			$this->param['RESULT']     = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Ramp Calculator
	public function ramp($request)
	{
		$appli = trim($request->input('appli'));
		$unit = trim($request->input('unit'));
		$unit0 = trim($request->input('unit0'));
		$unit1 = trim($request->input('unit1'));
		$unit2 = trim($request->input('unit2'));
		$r_type = trim($request->input('r_type'));
		$no = trim($request->input('no'));
		$no1 = trim($request->input('no1'));
		$no2 = trim($request->input('no2'));
		$width = trim($request->input('width'));
		$calc = trim($request->input('calc'));

		if ($calc == "one") {
			if (is_numeric($no)) {
				if ($appli == "a") {
					$r = 1 / 12;
					$ramplenght = $no * 12;
				} elseif ($appli == "b") {
					$r = 1 / 16;
					$ramplenght = $no * 16;
				} elseif ($appli == "c") {
					$r = 1 / 20;
					$ramplenght = $no * 20;
				} elseif ($appli == "d") {
					$r = 2 / 12;
					$ramplenght = ($no * 12) / 2;
				} elseif ($appli == "e") {
					$r = 3 / 12;
					$ramplenght = ($no * 12) / 3;
				}
				$grade = $r * 100;
				$rad = atan($r);
				$deg = $rad * 180 / pi();
				$runs = pow($ramplenght, 2) - pow($no, 2);
				$runs = sqrt($runs);


				$millirad = $rad * 1000;
				$microrad = $rad * 1000000;
				$minarc = $rad * ((60 * 180) / pi());
				$secarc = $rad * ((3600 * 180) / pi());
				$gradian = $rad * (200 / pi());
				$turns = $rad / (2 * pi());
				$pirad = $deg * (pi() / 180);
				$pirad = $pirad / (pi());

				$this->param['millirad']    = round($millirad, 1);
				$this->param['microrad']    = round($microrad);
				$this->param['secarc']     	= round($secarc);
				$this->param['gradian']     = round($gradian, 2);
				$this->param['turns']     	= round($turns, 5);
				$this->param['pirad']     	= round($pirad, 5);
				$this->param['minarc']     	= round($minarc);
				$this->param['grade']     	= round($grade, 2);
				$this->param['r_type']     	= $r_type;
				$this->param['appli']     = $appli;
				$this->param['runs']     	= round($runs, 3);
				$this->param['unit']     	= $unit;
				$this->param['deg']     	= round($deg, 2);
				$this->param['rad']    		= round($rad, 4);
				$this->param['ramplenght']    		= $ramplenght;
				$this->param['RESULT']      	= 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check your input';
				return $this->param;
			}
		} else {
			function ramp($a, $b)
			{
				if ($a == "mm") {
					$unit_v = $b / 10;
				} elseif ($a == "cm") {
					$unit_v = $b * 1;
				} elseif ($a == "m") {
					$unit_v = $b * 100;
				} elseif ($a == "in") {
					$unit_v = $b * 2.54;
				} elseif ($a == "ft") {
					$unit_v = $b * 30.48;
				}
				return $unit_v;
			}
			$no1 = ramp($unit0, $no1);
			$no2 = ramp($unit1, $no2);
			$width = ramp($unit2, $width);
			if (is_numeric($no) && is_numeric($no2) && is_numeric($width)) {
				$Hypotenuse1 = (pow($no1, 2)) + (pow($no2, 2));
				$Hypotenuse = sqrt($Hypotenuse1);
				$alpha1 = ((pow($no2, 2)) + (pow($Hypotenuse, 2))) - (pow($no1, 2));
				$alpha2 = $alpha1  / (2 * $no2 * $Hypotenuse);
				$alpha = acos($alpha2) * 180 / Pi();
				$beta = 90 - $alpha;
				$area = ($no1 * $no2) + ($width * ($no1 + $no2 + $Hypotenuse));
				$volume = ($no1 * $no2 * $width) / 2;
				$sv = $area / $volume;
				$this->param['unit']     		= $unit;
				$this->param['Hypotenuse']   	= round($Hypotenuse, 3);
				$this->param['Hypotenuse1']   	= $Hypotenuse1;
				$this->param['alpha']     		= round($alpha, 3);
				$this->param['alpha2']     		= round($alpha2, 3);
				$this->param['alpha1']     		= round($alpha1, 3);
				$this->param['beta']    		= round($beta, 4);
				$this->param['area']    		= round($area, 3);
				$this->param['volume']     		= round($volume, 3);
				$this->param['sv']    			= round($sv, 3);
				$this->param['no1']    			= $no1;
				$this->param['no2']    			= $no2;
				$this->param['width']    		= $width;
				$this->param['RESULT']      	= 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check your input';
				return $this->param;
			}
		}
	}

	// Decking Calculator
	public function decking($request)
	{
		$deck_length = trim($request->input('deck_length'));
		$deck_length_unit = trim($request->input('deck_length_unit'));
		$deck_width = trim($request->input('deck_width'));
		$deck_width_unit = trim($request->input('deck_width_unit'));
		$board_length = trim($request->input('board_length'));
		$board_length_unit = trim($request->input('board_length_unit'));
		$board_width = trim($request->input('board_width'));
		$board_width_unit = trim($request->input('board_width_unit'));
		$material = trim($request->input('material'));
		$Price = trim($request->input('price'));
		$Cost = trim($request->input('Cost'));
		function unit_change($deck_length, $deck_length_unit)
		{
			if ($deck_length_unit === "cm") {
				$deck_length = $deck_length * 30.48;
			} elseif ($deck_length_unit === "m") {
				$deck_length = $deck_length / 3.28084;
			} elseif ($deck_length_unit === "in") {
				$deck_length = $deck_length * 12;
			} elseif ($deck_length_unit === "ft") {
				$deck_length = $deck_length;
			}
			return $deck_length;
		}
		if (is_numeric($deck_length) && is_numeric($deck_width) && is_numeric($board_length) && is_numeric($board_width) && is_numeric($Price) && is_numeric($Cost)) {

			if ($deck_length == 0) {
				$this->param['error'] = 'length value cannot be equal to zero';
				return false;
			}

			if ($deck_width == 0) {
				$this->param['error'] = 'width value cannot be equal to zero';
				return false;
			}

			if ($board_length == 0) {
				$this->param['error'] = 'length value cannot be equal to zero';
				return false;
			}

			if ($board_width == 0) {
				$this->param['error'] = 'width value cannot be equal to zero';
				return false;
			}
			if ($Price == 0) {
				$this->param['error'] = 'price per board value cannot be equal to zero';
				return false;
			}
			if ($Cost == 0) {
				$this->param['error'] = 'cost of fasteners value cannot be equal to zero';
				return false;
			}


			$deck_length = unit_change($deck_length, $deck_length_unit);
			$deck_width = unit_change($deck_width, $deck_width_unit);
			$board_length = unit_change($board_length, $board_length_unit);
			$board_width = unit_change($board_width, $board_width_unit);
			$size_deck = $deck_length * $deck_width; //ans 1
			$size_board = $board_length * $board_width; //ans 2
			$numbers = round($size_deck / $size_board * 1.1); //ans 3
			$material = $size_deck / 100;
			$nails = $material * 350; //ans 4
			$clips = $nails / 2; //ans 5
			$price_boards = $numbers * $Price; //ans 6
			$Cost_boards = $price_boards + $Cost; //ans 7
		} else {
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
		$this->param['size_deck'] = $size_deck;
		$this->param['size_board'] = $size_board;
		$this->param['numbers'] = $numbers;
		$this->param['nails'] = $nails;
		$this->param['clips'] = $clips;
		$this->param['price_boards'] = $price_boards;
		$this->param['Cost_boards'] = $Cost_boards;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Screen Size Calculator
	public function screen($request)
	{
		//  dd($request->all());
		$screen = $request->input("screen");
		$ratio_1 = $request->input("ratio_1");
		$ratio_2 = $request->input("ratio_2");
		$type = $request->input("type");
		$curvature = $request->input("curvature");
		$radius = $request->input("radius");
		$radius_units = $request->input("radius_units");
		$select_one = $request->input("select_one");
		$select_two = $request->input("select_two");
		$curved_dimensions = $request->input("curved_dimensions");
		$curved_dimensions_units = $request->input("curved_dimensions_units");
		$flat_dimensions = $request->input("flat_dimensions");
		$flat_dimensions_units = $request->input("flat_dimensions_units");
		function conversion_screen($unit, $value)
		{
			if (isset($unit)) {
				if ($unit == 'cm') {
					return $value / 2.54;  // Convert centimeters to inches
				} elseif ($unit == 'm') {
					return $value / 0.0254; // Convert meters to inches
				} elseif ($unit == 'in') {
					return $value; // Already in inches
				} elseif ($unit == 'ft') {
					return $value * 12; // Convert feet to inches
				} elseif ($unit == 'yd') {
					return $value * 36; // Convert yards to inches
				} elseif ($unit == 'mm') {
					return $value / 25.4; // Convert millimeters to inches
				}
			}
			return $value; // Default to the same value if unit is not recognized
		}
		if ($type === "flat") {
			if (is_numeric($ratio_1) && is_numeric($ratio_2) && is_numeric($flat_dimensions)) {
				$flat_dimensions = conversion_screen($flat_dimensions_units, $flat_dimensions);
				if ($select_one === 'diagonal') {
					$width = ($ratio_1 / sqrt(pow($ratio_1, 2) + pow($ratio_2, 2))) * $flat_dimensions;
					$height = ($ratio_2 / sqrt(pow($ratio_1, 2) + pow($ratio_2, 2))) * $flat_dimensions;
					$screenArea = $width * $height;
					$this->param['screenArea'] = $screenArea;
					$this->param['width'] = $width;
					$this->param['height'] = $height;
				} elseif ($select_one === 'width') {
					$height = ($ratio_2 / $ratio_1) * $flat_dimensions;
					$diagonal = sqrt(pow($flat_dimensions, 2) + pow($height, 2));
					$screenArea = $flat_dimensions * $height;
					$this->param['screenArea'] = $screenArea;
					$this->param['diagonal'] = $diagonal;
					$this->param['height'] = $height;
				} elseif ($select_one === 'height') {
					$width = ($ratio_1 / $ratio_2) * $flat_dimensions;
					$diagonal = sqrt(pow($width, 2) + pow($flat_dimensions, 2));
					$screenArea = $width * $flat_dimensions;
					$this->param['screenArea'] = $screenArea;
					$this->param['width'] = $width;
					$this->param['diagonal'] = $diagonal;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if (is_numeric($ratio_1) && is_numeric($ratio_2) && is_numeric($curved_dimensions)) {
				if (isset($curvature)) {
					$radius1 = $curvature = $radius;
					$radius1 = $radius = $curvature;
				}
				$radius1 = conversion_screen($radius_units, $radius);
				$curved_dimensions = conversion_screen($curved_dimensions_units, $curved_dimensions);
				if ($select_two === 'Diagonal') {
					$height = ($ratio_2 / sqrt(pow($ratio_1, 2) + pow($ratio_2, 2))) * $curved_dimensions;
					$base_width = sqrt((pow($curved_dimensions, 2) - pow(round($height, 1), 2)));
					$screenArea = $base_width * $height;
					$screen_length = ($ratio_1 / $ratio_2) * $height;
					$base_depth = $radius1 * (1 - cos($screen_length / (2 * $radius1)));
					$this->param['screenArea'] = $screenArea;
					$this->param['base_width'] = $base_width;
					$this->param['height'] = $height;
					$this->param['base_depth'] = $base_depth;
					$this->param['screen_length'] = $screen_length;
				} elseif ($select_two === 'Width') {
					$height = $curved_dimensions / ($ratio_1 / $ratio_2);
					$diagonal = sqrt(pow($curved_dimensions, 2) + pow($height, 2));
					$screen_length = ($ratio_1 / $ratio_2) * $height;
					$screenArea = $curved_dimensions  * $height;
					$base_depth = $radius1 * (1 - cos($screen_length / (2 * $radius1)));
					$this->param['screenArea'] = $screenArea;
					$this->param['height'] = $height;
					$this->param['diagonal'] = $diagonal;
					$this->param['base_depth'] = $base_depth;
					$this->param['screen_length'] = $screen_length;
				} elseif ($select_two === 'Height') {
					$base_width = $curved_dimensions * ($ratio_1 / $ratio_2);
					$diagonal = sqrt(pow($base_width, 2) + pow($curved_dimensions, 2));
					$screenArea = $base_width  * $curved_dimensions;
					$screen_length = ($ratio_1 / $ratio_2) * $curved_dimensions;
					$base_depth = $radius1 * (1 - cos($screen_length / (2 * $radius1)));
					$this->param['base_width'] = $base_width;
					$this->param['diagonal'] = $diagonal;
					$this->param['screenArea'] = $screenArea;
					$this->param['base_depth'] = $base_depth;
					$this->param['screen_length'] = $screen_length;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	// elapsed-time-calculator
	public function elapsed($request)
	{
		$main_units = trim($request->input('main_units'));
		$elapsed_start = trim($request->input('elapsed_start'));
		$elapsed_start_one = trim($request->input('elapsed_start_one'));
		$elapsed_start_sec = trim($request->input('elapsed_start_sec'));
		$elapsed_start_three = trim($request->input('elapsed_start_three'));
		$elapsed_start_unit = trim($request->input('elapsed_start_unit'));
		$elapsed_end = trim($request->input('elapsed_end'));
		$elapsed_end_one = trim($request->input('elapsed_end_one'));
		$elapsed_end_sec = trim($request->input('elapsed_end_sec'));
		$elapsed_end_three = trim($request->input('elapsed_end_three'));
		$elapsed_end_unit = trim($request->input('elapsed_end_unit'));
		$clock_format = trim($request->input('clock_format'));
		$clock_hour = trim($request->input('clock_hour'));
		$clock_minute = trim($request->input('clock_minute'));
		$clock_second = trim($request->input('clock_second'));
		$clock_start_unit = trim($request->input('clock_start_unit'));
		$clock_hur = trim($request->input('clock_hur'));
		$clock_mints = trim($request->input('clock_mints'));
		$clock_secs = trim($request->input('clock_secs'));
		$clock_end_unit = trim($request->input('clock_end_unit'));
		function time_unit($elapsed_start, $elapsed_start_unit)
		{
			if ($elapsed_start_unit == "sec") {
				$elapsed_start = $elapsed_start;
			} elseif ($elapsed_start_unit == "mins") {
				$elapsed_start = $elapsed_start * 60;
			} elseif ($elapsed_start_unit == "hrs") {
				$elapsed_start = $elapsed_start * 3600;
			}
			return $elapsed_start;
		}
		function other_time($elapsed_start_one, $elapsed_start_sec, $elapsed_start_unit)
		{
			if ($elapsed_start_unit === "mins/sec") {
				$interval = ($elapsed_start_one * 60) + $elapsed_start_sec;
			} elseif ($elapsed_start_unit === "hrs/mins") {
				$interval = ($elapsed_start_one *  3600) + ($elapsed_start_sec * 60);
			}
			return $interval;
		}
		function other_time_sec($elapsed_start_one, $elapsed_start_sec, $elapsed_start_three, $elapsed_start_unit)
		{
			if ($elapsed_start_unit === "hrs/mins/sec") {
				$interval = ($elapsed_start_one *  3600) + ($elapsed_start_sec * 60) + $elapsed_start_three;
			}
			return $interval;
		}
		if ($main_units === 'elapsed') {
			if (is_numeric($elapsed_start) && is_numeric($elapsed_start_one) && is_numeric($elapsed_start_sec)  && is_numeric($elapsed_start_three) && is_numeric($elapsed_end) && is_numeric($elapsed_end_one) && is_numeric($elapsed_end_sec) && is_numeric($elapsed_end_three)) {
				if ($elapsed_start_unit === 'sec' || $elapsed_start_unit === 'mins'  || $elapsed_start_unit === 'hrs') {
					$elapsed_start = time_unit($elapsed_start, $elapsed_start_unit);
				} elseif ($elapsed_start_unit === "hrs/mins/sec") {
					$elapsed_start = other_time_sec($elapsed_start_one, $elapsed_start_sec, $elapsed_start_three, $elapsed_start_unit);
				} else {
					$elapsed_start = other_time($elapsed_start_one, $elapsed_start_sec, $elapsed_start_unit);
				}
				if ($elapsed_end_unit === 'sec' || $elapsed_end_unit === 'mins'  || $elapsed_end_unit === 'hrs') {
					$elapsed_end = time_unit($elapsed_end, $elapsed_end_unit);
				} elseif ($elapsed_end_unit === "hrs/mins/sec") {
					$elapsed_end = other_time_sec($elapsed_end_one, $elapsed_end_sec, $elapsed_end_three, $elapsed_end_unit);
				} else {
					$elapsed_end = other_time($elapsed_end_one, $elapsed_end_sec, $elapsed_end_unit);
				}
				if ($elapsed_end < $elapsed_start) {
					$this->param['error'] = 'the end time should be greater than the start time';
					return $this->param;
				}
				$answer = $elapsed_end - $elapsed_start;
				$this->param['answer'] = $answer;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if ($clock_format === "24") {
				if (is_numeric($clock_hour) && is_numeric($clock_minute) && is_numeric($clock_second) && is_numeric($clock_hur) && is_numeric($clock_mints) && is_numeric($clock_secs)) {
					if ($clock_hour >= 24) {
						$this->param['error'] =  'Start clock time hour should be less than 24';
						return $this->param;
					}
					if ($clock_minute >= 60) {
						$this->param['error'] =  'Start clock time minute should be less than 60';
						return $this->param;
					}
					if ($clock_second >= 60) {
						$this->param['error'] =  'Start clock time second should be less than 60';
						return $this->param;
					}
					if ($clock_hur >= 24) {
						$this->param['error'] =  'end clock time hour should be less than 24';
						return $this->param;
					}
					if ($clock_mints >= 60) {
						$this->param['error'] =  'end clock time minute should be less than 60';
						return $this->param;
					}
					if ($clock_secs >= 60) {
						$this->param['error'] =  'end clock time second should be less than 60';
						return $this->param;
					}
					$start_clock = ($clock_hour * 3600) + ($clock_minute * 60) + ($clock_second);
					$end_clock = ($clock_hur * 3600) + ($clock_mints * 60) + ($clock_secs);
					$answer = $end_clock - $start_clock;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($clock_hour) && is_numeric($clock_minute) && is_numeric($clock_second) && is_numeric($clock_hur) && is_numeric($clock_mints) && is_numeric($clock_secs)) {
					if ($clock_hour >= 12) {
						$this->param['error'] =  'start clock time hour should be less than 12';
						return $this->param;
					}
					if ($clock_minute >= 60) {
						$this->param['error'] =  'start clock minute hour should be less than 60';
						return $this->param;
					}
					if ($clock_second >= 60) {
						$this->param['error'] =  'start clock time second should be less than 60';
						return $this->param;
					}
					if ($clock_hur >= 12) {
						$this->param['error'] =  'end clock time hour should be less than 12';
						return $this->param;
					}
					if ($clock_mints >= 60) {
						$this->param['error'] =  'end clock minute hour should be less than 60';
						return $this->param;
					}
					if ($clock_secs >= 60) {
						$this->param['error'] =  'end clock time second should be less than 60';
						return $this->param;
					}

					// Convert 12-hour format to 24-hour format
					if ($clock_start_unit == 'PM' && $clock_hour != 12) {
						$clock_hour += 12;
					}

					if ($clock_end_unit == 'PM' && $clock_hur != 12) {
						$clock_hur += 12;
					}

					// Calculate the duration in seconds
					$start_time = strtotime("$clock_hour:$clock_minute:$clock_second");
					$end_time = strtotime("$clock_hur:$clock_mints:$clock_secs");
					$answer = $end_time - $start_time;

					// Handle negative answer (PM to AM)
					if ($answer < 0) {
						$answer += 24 * 60 * 60; // Add 24 hours in seconds
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// carpet-calculator
	public function carpet($request)
	{
		$shape = trim($request->input('shape'));
		$length = trim($request->input('length'));
		$length_unit = trim($request->input('length_unit'));
		$width = trim($request->input('width'));
		$width_unit = trim($request->input('width_unit'));
		$radius = trim($request->input('radius'));
		$radius_unit = trim($request->input('radius_unit'));
		$axis_a = trim($request->input('axis_a'));
		$axis_a_unit = trim($request->input('axis_a_unit'));
		$axis_b = trim($request->input('axis_b'));
		$axis_b_unit = trim($request->input('axis_b_unit'));
		$side = trim($request->input('side'));
		$side_unit = trim($request->input('side_unit'));
		$sides = trim($request->input('sides'));
		$sides_unit = trim($request->input('sides_unit'));
		$carpet = trim($request->input('carpet'));
		$carpet_unit = trim($request->input('carpet_unit'));
		$price = trim($request->input('price'));
		$price_unit = trim($request->input('price_unit'));
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy . ' ', '', $price_unit);
		function carpet_units($length, $length_unit)
		{
			if ($length_unit === "cm") {
				$length = $length / 100;
			} elseif ($length_unit === "dm") {
				$length = $length / 10;
			} elseif ($length_unit === "in") {
				$length = $length * 0.0254;
			} elseif ($length_unit === "ft") {
				$length = $length * 0.3048;
			} elseif ($length_unit === "yd") {
				$length = $length * 0.9144;
			} elseif ($length_unit !== "m") {
				$length = $length;
			}
			return $length;
		}


		function prices_units($price, $price_unit)
		{
			if ($price_unit === "cm²") {
				$price = $price / 10000;
			} elseif ($price_unit === "dm²") {
				$price = $price / 100;
			} elseif ($price_unit === "in²") {
				$price = $price / 1550.0031;
			} elseif ($price_unit === "ft²") {
				$price = $price / 10.7639;
			} elseif ($price_unit === "yd²") {
				$price = $price / 1.19599;
			} elseif ($price_unit !== "m²") {
				$price = $price;
			}

			return $price;
		}

		if ($shape === 'Rectangle') {
			if (is_numeric($length) && is_numeric($width) && is_numeric($price)) {
				$length = carpet_units($length, $length_unit);
				$width = carpet_units($width, $width_unit);
				$answer = $width * $length; //ans
				$sub_answer = $answer * $price; //ans
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($shape === "Circle") {
			if (is_numeric($radius) && is_numeric($price)) {
				$radius = carpet_units($radius, $radius_unit);
				$answer = pi() * pow($radius, 2); //ans
				$sub_answer = $answer * $price; //ans
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($shape === "Ellipse") {
			if (is_numeric($axis_a) && is_numeric($axis_b) && is_numeric($price)) {
				$axis_a = carpet_units($axis_a, $axis_a_unit);
				$axis_b = carpet_units($axis_b, $axis_b_unit);
				$answer = $axis_a * $axis_b * pi(); //ans
				$sub_answer = $answer * $price; //ans
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($shape === "Pentagon") {
			if (is_numeric($side) && is_numeric($price)) {
				$side = carpet_units($side, $side_unit);
				$answer = $side * $side * sqrt(25 + 10 * sqrt(5)) / 4; //ans
				$sub_answer = $answer * $price; //ans
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($shape === "Hexagon") {
			if (is_numeric($sides) && is_numeric($price)) {
				$sides = carpet_units($sides, $sides_unit);
				$answer = (3 / 2) * sqrt(3) * pow($sides, 2); //ans
				$sub_answer = $answer * $price; //ans
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if (is_numeric($carpet) && is_numeric($price)) {
				$answer = prices_units($carpet, $carpet_unit); //ans
				$sub_answer = $answer * $price; //ans
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['sub_answer'] = $sub_answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Metal Roof Cost Calculator
	public function metal($request)
	{
		$type = trim($request->input('type'));
		$r_length = trim($request->input('r_length'));
		$rl_units = trim($request->input('rl_units'));
		$r_width = trim($request->input('r_width'));
		$rw_units = trim($request->input('rw_units'));
		$roof_pitch = trim($request->input('roof_pitch'));
		$p_length = trim($request->input('p_length'));
		$pl_units = trim($request->input('pl_units'));
		$p_width = trim($request->input('p_width'));
		$pw_units = trim($request->input('pw_units'));
		$cost = trim($request->input('cost'));
		$roofPitch = [
			'1:12' => ["value" => "1.003"],
			'2:12' => ["value" => "1.014"],
			'3:12' => ["value" => "1.031"],
			'4:12' => ["value" => "1.054"],
			'5:12' => ["value" => "1.083"],
			'6:12' => ["value" => "1.118"],
			'7:12' => ["value" => "1.158"],
			'8:12' => ["value" => "1.202"],
			'9:12' => ["value" => "1.250"],
			'10:12' => ["value" => "1.302"],
			'11:12' => ["value" => "1.357"],
			'12:12' => ["value" => "1.414"],
			'13:12' => ["value" => "1.474"],
			'14:12' => ["value" => "1.537"],
			'15:12' => ["value" => "1.601"],
			'16:12' => ["value" => "1.667"],
			'17:12' => ["value" => "1.734"],
			'18:12' => ["value" => "1.803"],
			'19:12' => ["value" => "1.873"],
			'20:12' => ["value" => "1.944"],
			'21:12' => ["value" => "2.016"],
			'22:12' => ["value" => "2.088"],
			'23:12' => ["value" => "2.162"],
			'24:12' => ["value" => "2.236"],
			'25:12' => ["value" => "2.311"],
			'26:12' => ["value" => "2.386"],
			'27:12' => ["value" => "2.462"],
			'28:12' => ["value" => "2.539"],
			'29:12' => ["value" => "2.615"],
			'30:12' => ["value" => "2.693"],
		];
		function roofUnit($input, $unit)
		{
			if ($unit == 'cm') {
				$input = $input * 0.03281;
			} else if ($unit == 'dm') {
				$input = $input * 0.3281;
			} else if ($unit == 'm') {
				$input = $input * 3.281;
			} else if ($unit == 'in') {
				$input = $input * 0.08333;
			} else if ($unit == 'yd') {
				$input = $input * 3;
			}
			return $input;
		}
		if (is_numeric($r_length) && is_numeric($r_width) && is_numeric($p_length) && is_numeric($p_width) && is_numeric($cost)) {
			if (isset($rl_units)) {
				$r_length = roofUnit($r_length, $rl_units);
			}
			if (isset($rw_units)) {
				$r_width = roofUnit($r_width, $rw_units);
			}
			if (isset($pl_units)) {
				$p_length = roofUnit($p_length, $pl_units);
			}
			if (isset($pw_units)) {
				$p_width = roofUnit($p_width, $pw_units);
			}
			if ($type == 'yes') {
				$r_area = $r_length * $r_width;
				$p_area = $p_length * $p_width;
				$panel = round($r_area / $p_area, 0);
				$expense = $cost * $panel;
			}
			if ($type == 'no') {
				$Detail = $roofPitch[$roof_pitch];
				$value = $Detail['value'];
				$r_area = $r_length * $r_width * $value;
				$p_area = $p_length * $p_width;
				$panel = round($r_area / $p_area, 0);
				$expense = $cost * $panel;
				$this->param['roof_pitch'] = $roof_pitch;
				$this->param['value'] = $value;
			}
			$this->param['r_area'] = $r_area;
			$this->param['p_area'] = $p_area;
			$this->param['panel'] = $panel;
			$this->param['expense'] = $expense;
			$this->param['r_length'] = $r_length;
			$this->param['r_width'] = $r_width;
			$this->param['p_length'] = $p_length;
			$this->param['p_width'] = $p_width;
			$this->param['cost'] = $cost;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['type'] = $type;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Time Duration Calculator
	public function time_duration($request)
	{
		$t_start_h = trim($request->input('t_start_h'));
		$t_start_m = trim($request->input('t_start_m'));
		$t_start_s = trim($request->input('t_start_s'));
		$t_start_ampm = trim($request->input('t_start_ampm'));
		$t_end_h = trim($request->input('t_end_h'));
		$t_end_m = trim($request->input('t_end_m'));
		$t_end_s = trim($request->input('t_end_s'));
		$t_end_ampm = trim($request->input('t_end_ampm'));
		$start_date = trim($request->input('start_date'));
		$end_date = trim($request->input('end_date'));
		$d_start_h = trim($request->input('d_start_h'));
		$d_start_m = trim($request->input('d_start_m'));
		$d_start_s = trim($request->input('d_start_s'));
		$d_start_ampm = trim($request->input('d_start_ampm'));
		$d_end_h = trim($request->input('d_end_h'));
		$d_end_m = trim($request->input('d_end_m'));
		$d_end_s = trim($request->input('d_end_s'));
		$d_end_ampm = trim($request->input('d_end_ampm'));
		$submit = trim($request->input('submit'));
		$calculator_time = trim($request->input('calculator_time'));
		if ($calculator_time === "time_cal") {
			if ($t_start_h > 23 || $t_start_h < 0) {
				$this->param['error'] = 'Please enter a valid Start Hour.';
				return $this->param;
			}
			if ($t_end_h > 23 || $t_end_h < 0) {
				$$this->param['error'] = 'Please enter a valid End Hour.';
				return $this->param;
			}
			if ($t_start_m > 59 || $t_start_m < 0 || $t_start_m === "") {
				$$this->param['error'] = 'Please enter a valid Start Minute.';
				return $this->param;
			}
			if ($t_end_m > 59 || $t_end_m < 0 || $t_end_m === "") {
				$$this->param['error'] = 'Please enter a valid End Minute.';
				return $this->param;
			}
			if ($t_start_s > 59 || $t_start_s < 0  || $t_start_s === "") {
				$$this->param['error'] = 'Please enter a valid Start Second.';
				return $this->param;
			}
			if ($t_end_s > 59 || $t_end_s < 0 || $t_end_s === "") {
				$$this->param['error'] = 'Please enter a valid End Second.';
				return $this->param;
			}
			if (empty($t_start_h) || $t_start_h === "0") {
				$t_start_h = 12;
			}
			if (empty($t_end_h) || $t_end_h === "0") {
				$t_end_h = 12;
			}
			$t_start_h = sprintf("%02d", $t_start_h);
			$t_start_m = sprintf("%02d", $t_start_m);
			$t_start_s = sprintf("%02d", $t_start_s);
			if ($t_start_h <= 12) {
				$start_time = $t_start_h . ":" . $t_start_m . ":" . $t_start_s . " " . $t_start_ampm;
				$start_time_res = date('H:i:s', strtotime($start_time));
			} else {
				$start_time_res = $t_start_h . ":" . $t_start_m . ":" . $t_start_s;
			}
			$t_end_h = sprintf("%02d", $t_end_h);
			$t_end_m = sprintf("%02d", $t_end_m);
			$t_end_s = sprintf("%02d", $t_end_s);
			if ($t_end_h <= 12) {
				$end_time = $t_end_h . ":" . $t_end_m . ":" . $t_end_s . " " . $t_end_ampm;
				$end_time_res = date('H:i:s', strtotime($end_time));
			} else {
				$end_time_res = $t_end_h . ":" . $t_end_m . ":" . $t_end_s;
			}
			$day = "14";
			$start_unit = date('a', strtotime($start_time_res));
			$end_unit = date('a', strtotime($end_time_res));
			if ($start_unit === $end_unit) {
				$day = "15";
			}
			$start_time_res = new Carbon("2006-04-14 " . $start_time_res);
			$end_time_res = new Carbon("2006-04-" . $day . " " . $end_time_res);
			$days_ans = 0;
		} else {
			if ($d_start_h > 23 || $d_start_h < 0) {
				$$this->param['error'] = 'Please enter a valid Start Hour.';
				return $this->param;
			}
			if ($d_end_h > 23 || $d_end_h < 0) {
				$$this->param['error'] = 'Please enter a valid End Hour.';
				return $this->param;
			}
			if ($d_start_m > 59 || $d_start_m < 0 || $d_start_m === "") {
				$$this->param['error'] = 'Please enter a valid Start Minute.';
				return $this->param;
			}
			if ($d_end_m > 59 || $d_end_m < 0 || $d_end_m === "") {
				$$this->param['error'] = 'Please enter a valid End Minute.';
				return $this->param;
			}
			if ($d_start_s > 59 || $d_start_s < 0  || $d_start_s === "") {
				$$this->param['error'] = 'Please enter a valid Start Second.';
				return $this->param;
			}
			if ($d_end_s > 59 || $d_end_s < 0 || $d_end_s === "") {
				$$this->param['error'] = 'Please enter a valid End Second.';
				return $this->param;
			}
			if (empty($d_start_h) || $d_start_h === "0") {
				$d_start_h = 12;
			}
			if (empty($d_end_h) || $d_end_h === "0") {
				$d_end_h = 12;
			}
			$t_start_h = sprintf("%02d", $t_start_h);
			$t_start_m = sprintf("%02d", $t_start_m);
			$t_start_s = sprintf("%02d", $t_start_s);
			if ($t_start_h <= 12) {
				$start_time = $t_start_h . ":" . $t_start_m . ":" . $t_start_s . " " . $d_start_ampm;
				$start_time_res = date('H:i:s', strtotime($start_time));
			} else {
				$start_time_res = $t_start_h . ":" . $t_start_m . ":" . $t_start_s;
			}
			// echo date('h:i:s a', strtotime($start_time_res));
			$t_end_h = sprintf("%02d", $t_end_h);
			$t_end_m = sprintf("%02d", $t_end_m);
			$t_end_s = sprintf("%02d", $t_end_s);
			if ($t_end_h <= 12) {
				$end_time = $t_end_h . ":" . $t_end_m . ":" . $t_end_s . " " . $d_end_ampm;
				$end_time_res = date('H:i:s', strtotime($end_time));
			} else {
				$end_time_res = $t_end_h . ":" . $t_end_m . ":" . $t_end_s;
			}
			$start_time_res = new Carbon($start_date . " " . $start_time_res);
			$end_time_res = new Carbon($end_date . " " . $end_time_res);
			$dStart = new Carbon($start_date);
			$dEnd  = new Carbon($end_date);
			$dDiff = $dStart->diff($dEnd);
			$days_ans = $dDiff->days;
		}
		$bhaago = $start_time_res->diff($end_time_res);
		$hours =   $bhaago->format('%H');
		$minutes =   $bhaago->format('%I');
		$seconds =   $bhaago->format('%S');
		$total_days = round(($hours / 24) + ($minutes / 1440) + ($seconds / 86400) + $days_ans, 2);
		$total_hours = round($hours + ($minutes / 60) + ($seconds / 3600) + ($days_ans * 24), 2);
		$total_minutes = round(($hours * 60) + $minutes + ($seconds / 60) + ($days_ans * 1440), 2);
		$total_seconds = round(($hours * 3600) + ($minutes * 60) + $seconds + ($days_ans * 86400), 2);
		// dd($days_ans);
		$this->param['days_ans'] = $days_ans;
		$this->param['hours'] = $hours;
		$this->param['minutes'] = $minutes;
		$this->param['seconds'] = $seconds;
		$this->param['total_days'] = $total_days;
		$this->param['total_hours'] = $total_hours;
		$this->param['total_minutes'] = $total_minutes;
		$this->param['total_seconds'] = $total_seconds;
		$this->param['calculator_time'] = $submit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Date Duration Calculator
	public function date_duration($request)
	{
		$s_date = $request->input('s_date');
		$e_date = $request->input('e_date');
		if ($request->input('checkbox') != false) {
			$checkbox = $request->input('checkbox');
		} else {
			$checkbox = false;
		}
		if (!empty($s_date) && !empty($e_date)) {
			$ss_date = $s_date;
			$ee_date = $e_date;
			$s_date = explode("-", $s_date);
			if ($checkbox !== false) {
				$e_date = date('Y-m-d', strtotime("+1 day" . $e_date));
			}
			$e_date = explode("-", $e_date);
			$s_hour = 0;
			$s_min = 0;
			$s_sec = 0;
			$e_hour = 0;
			$e_min = 0;
			$e_sec = 0;
			$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
			$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
			$diff = $to->diff($from);
			$years = $diff->y;
			$months = $diff->m;
			$days = $diff->d;
			$from = date('M d, Y', strtotime($ss_date));
			$to = date('M d, Y', strtotime($ee_date));
			if (strtotime($ss_date) > strtotime($ee_date)) {
				$new = $from;
				$from = $to;
				$to = $new;
			}
			$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
			$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);
			$diff = abs($d2 - $d1);
			$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)  / (60 * 60));

			$minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24  - $hours * 60 * 60) / 60);

			$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
			$this->param['from'] = $from;
			$this->param['to'] = $to;
			$this->param['years'] = $years;
			$this->param['months'] = $months;
			$this->param['hours'] = $hours;
			$this->param['days'] = $days;
			$this->param['minutes'] = $minutes;
			$this->param['seconds'] = $seconds;
		} else {
			$this->param['error'] = 'Please! Check Your Input.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Date Calculator
	public function date($request)
	{
		if (app()->getLocale() !== "en") {
			$dateTypes = $request->dateTypes;
			if ($dateTypes === "date_duration") {
				$s_date = $request->s_date_duration;
				$e_date = $request->e_date_duration;
				if ($request->input('checkbox_duration') != false) {
					$checkbox = $request->input('checkbox_duration');
				} else {
					$checkbox = false;
				}
				if ($s_date !== "" && $e_date !== "") {
					$ss_date = $s_date;
					$ee_date = $e_date;
					$s_date = explode("-", $s_date);
					if ($checkbox !== false) {
						$e_date = date('Y-m-d', strtotime("+1 day" . $e_date));
					}
					$e_date = explode("-", $e_date);
					$s_hour = 0;
					$s_min = 0;
					$s_sec = 0;
					$e_hour = 0;
					$e_min = 0;
					$e_sec = 0;
					$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
					$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
					$diff = $to->diff($from);
					$years = $diff->y;
					$months = $diff->m;
					$days = $diff->d;
					$from = date('M d, Y', strtotime($ss_date));
					$to = date('M d, Y', strtotime($ee_date));
					if (strtotime($ss_date) > strtotime($ee_date)) {
						$new = $from;
						$from = $to;
						$to = $new;
					}
					$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
					$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);
					$diff = abs($d2 - $d1);
					$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)  / (60 * 60));

					$minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24  - $hours * 60 * 60) / 60);

					$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
					$this->param['from'] = $from;
					$this->param['to'] = $to;
					$this->param['years'] = $years;
					$this->param['months'] = $months;
					$this->param['hours'] = $hours;
					$this->param['days'] = $days;
					$this->param['minutes'] = $minutes;
					$this->param['seconds'] = $seconds;
				} else {
					$this->param['error'] = 'Please! Check Your Input.';
					return $this->param;
				}
				$this->param['RESULT'] = 1;
				return $this->param;
			} elseif ($dateTypes === "date_calculator") {
				$add_date = $request->input('add_date_date');
				$method = $request->input('date_method');
				$years = $request->input('date_years');
				$months = $request->input('date_months');
				$weeks = $request->input('date_weeks');
				$days = $request->input('date_days');
				$repeat = $request->input('repeat');
				$add_hrs_f = $request->input('add_hrs_f');
				$add_min_f = $request->input('add_min_f');
				$add_sec_f = $request->input('add_sec_f');
				$add_hrs_s = $request->input('add_hrs_s');
				$add_min_s = $request->input('add_min_s');
				$add_sec_s = $request->input('add_sec_s');
				if ($add_date !== "" && $method !== "") {
					$s_date = $add_date; // mmm,dd,yyyy
					$s_date = explode("-", $s_date);
					$date = "$s_date[0]-$s_date[1]-$s_date[2]";
					if (empty($days)) {
						$days = 0;
					}
					if (empty($weeks)) {
						$weeks = 0;
					}
					if (empty($months)) {
						$months = 0;
					}
					if (empty($years)) {
						$years = 0;
					}
					if (empty($repeat)) {
						$repeat = "1";
					}
					if (is_numeric($add_hrs_f) || is_numeric($add_min_f) || is_numeric($add_sec_f) || is_numeric($add_hrs_s) || is_numeric($add_min_s) || is_numeric($add_sec_s)) {
						if (empty($add_hrs_f)) {
							$add_hrs_f = 0;
						}
						if (empty($add_min_f)) {
							$add_min_f = 0;
						}
						if (empty($add_sec_f)) {
							$add_sec_f = 0;
						}
						if (empty($add_hrs_s)) {
							$add_hrs_s = 0;
						}
						if (empty($add_min_s)) {
							$add_min_s = 0;
						}
						if (empty($add_sec_s)) {
							$add_sec_s = 0;
						}
						$date = $date . " " . sprintf('%02d', $add_hrs_f) . ":" . sprintf('%02d', $add_min_f) . ":" . sprintf('%02d', $add_sec_f);
						$this->param['from'] = date('l, M d, Y h:i:s A', strtotime($date));
						$this->param['add_hrs_f'] = sprintf('%02d', $add_hrs_f);
						$this->param['add_min_f'] = sprintf('%02d', $add_min_f);
						$this->param['add_sec_f'] = sprintf('%02d', $add_sec_f);
						$this->param['add_hrs_s'] = sprintf('%02d', $add_hrs_s);
						$this->param['add_min_s'] = sprintf('%02d', $add_min_s);
						$this->param['add_sec_s'] = sprintf('%02d', $add_sec_s);
						for ($i = 0; $i < $repeat; $i++) {
							if ($method === 'add') {
								$date = date('l, M d, Y h:i:s A', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days' . ' + ' . $add_hrs_s . ' hours' . ' + ' . $add_min_s . ' minutes' . ' + ' . $add_sec_s . ' seconds'));
							} else {
								$date = date('l, M d, Y h:i:s A', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days' . ' - ' . $add_hrs_s . ' hours' . ' - ' . $add_min_s . ' minutes' . ' - ' . $add_sec_s . ' seconds'));
							}
							$ans[] = $date;
						}
					} else {
						$this->param['from'] = date('l, M d, Y', strtotime($date));
						for ($i = 0; $i < $repeat; $i++) {
							if ($method === 'add') {
								$date = date('l, M d, Y', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days'));
							} else {
								$date = date('l, M d, Y', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days'));
							}
							$ans[] = $date;
						}
					}
					$this->param['method'] = $method;
					$this->param['years'] = sprintf('%02d', $years);
					$this->param['months'] = sprintf('%02d', $months);
					$this->param['weeks'] = sprintf('%02d', $weeks);
					$this->param['days'] = sprintf('%02d', $days);
					$this->param['ans'] = $ans;
					$this->param['repeat'] = $repeat;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input.';
					return $this->param;
				}
			} else {
				$submitt = $request->input('sim_adv');
				$end_inc = $request->input('end_inc');
				$sat_inc = $request->input('sat_inc');
				$holiday_c = $request->input('holiday_c');
				$nyd = $request->input('nyd');
				$ind = $request->input('ind');
				$vetd = $request->input('vetd');
				$cheve = $request->input('cheve');
				$chirs = $request->input('chirs');
				$nye = $request->input('nye');
				$total_i = $request->input('total_i');
				$total_j = $request->input('total_j');
				$d = $request->input('d');
				$m = $request->input('m');
				$n = $request->input('n');
				$blkf = $request->input('blkf');
				$thankd = $request->input('thankd');
				$cold = $request->input('cold');
				$labd = $request->input('labd');
				$mlkd = $request->input('mlkd');
				$psd = $request->input('psd');
				$memd = $request->input('memd');
				$ex_in = $request->input('ex_in');
				$satting = $request->input('satting');
				$sun = $request->input('sun');
				$mon = $request->input('mon');
				$tue = $request->input('tue');
				$wed = $request->input('wed');
				$thu = $request->input('thu');
				$fri = $request->input('fri');
				$sat = $request->input('sat');
				$cal_bus = $request->input('cal_bus');
				$weekend_c = $request->input('weekend_c');
				$method = $request->input('method');
				$years = $request->input('years');
				$months = $request->input('months');
				$days = $request->input('days');
				$weeks = $request->input('weeks');

				$s_date = $request->input('s_date');
				$add_date = $request->input('add_date');
				$e_date = $request->input('e_date');
				function getWorkdays($date1, $date2, $workSat = FALSE, $patron = '', $fix_holiday = '', $display = '', $display_repeat = '')
				{
					if (!defined('SATURDAY')) define('SATURDAY', 6);
					if (!defined('SUNDAY')) define('SUNDAY', 0);

					// Array of all public festivities
					$publicHolidays = array();
					// The Patron day (if any) is added to public festivities
					if ($patron) {
						$publicHolidays[] = $patron;
					}
					$holi_arr = array();
					if ($fix_holiday) {
						$holi_arr[] = $fix_holiday;
					}
					$start = strtotime($date1);
					$end = strtotime($date2);
					if (!isset($end_inc)) {
						$end = strtotime("-1 day", $end);
					}
					if ($start > $end) {
						$new = $start;
						$start = $end;
						$end = $new;
					}
					$workdays = 0;
					$weekend = 0;
					$holidays = 0;
					$get_holi = array();
					$dis_holi = array();
					$count = 0;
					for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
						$day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
						$mmgg = date('m-d', $i);
						$mg = date('l, M d, Y', $i);
						if (($day == SATURDAY && $workSat == FALSE) || $day == SUNDAY) {
							$weekend++;
						} elseif (in_array($mg, $holi_arr)) {
							$get_holi[] = $mg;
							$holidays++;
							$dis_holi[] = $display[$count];
							$count++;
						} elseif (in_array($mmgg, $publicHolidays)) {
							$holidays++;
							$get_holi[] = $mg;
							$c = array_search($mmgg, $publicHolidays, true);
							$dis_holi[] = $display_repeat[$c];
						} elseif (
							$day != SUNDAY &&
							!in_array($mmgg, $publicHolidays) &&
							!($day == SATURDAY && $workSat == FALSE)
						) {
							$workdays++;
						}
					}
					$getdays = array('workdays' => $workdays, 'weekend' => $weekend, 'holidays' => $holidays, 'get_holi' => $get_holi, 'dis_holi' => $dis_holi);
					return $getdays;
				}
				if ($submitt === 'simple') {
					if ($e_date) {
						if (isset($end_inc)) {
							$e_date = date('Y-m-d', strtotime("+1 day" . $e_date));
						}
						// $e_date = explode("-", $e_date);
						if (isset($sat_inc)) {
							$check_sat = true;
						} else {
							$check_sat = false;
						}
						if ($holiday_c == 'yes') {
							$all_holiday = array();
							$repeat_holiday = array();
							$display_holiday = array();
							$display_repeat = array();
							if (isset($nyd)) {
								$repeat_holiday[] = '01-01';
								$display_repeat[] = "New Year's Day";
							}
							if (isset($ind)) {
								$repeat_holiday[] = '07-04';
								$display_repeat[] = "Independence Day";
							}
							if (isset($vetd)) {
								$repeat_holiday[] = '11-11';
								$display_repeat[] = "Veteran's Day";
							}
							if (isset($cheve)) {
								$repeat_holiday[] = '12-24';
								$display_repeat[] = "Christmas Eve";
							}
							if (isset($chirs)) {
								$repeat_holiday[] = '12-25';
								$display_repeat[] = "Christmas";
							}
							if (isset($nye)) {
								$repeat_holiday[] = '12-31';
								$display_repeat[] = "New Year's Eve";
							}
							for ($j = 0; $j <= $total_i; $j++) {
								if (is_numeric($d . $j) && is_numeric($m . $j)) {
									$repeat_holiday[] = $m . $j . '-' . $d . $j;
									$display_repeat[] = $n . $j;
								}
							}
							$yearStart = date('Y', strtotime($s_date));
							$yearEnd   = date('Y', strtotime($e_date));

							// $s_date_string = $s_date->format('Y-m-d');
							// $e_date_string = $e_date->format('Y-m-d');

							if ($yearEnd < $yearStart) {
								$start_m = $e_date['1'];
								$end_m = $s_date['1'];
								$start_d = $e_date['2'];
								$end_d = $s_date['2'];
								$yearStart = date('Y', strtotime($e_date));
								$yearEnd   = date('Y', strtotime($s_date));
							} else {
								$start_m = $s_date['1'];
								$end_m = $e_date['1'];
								$start_d = $s_date['2'];
								$end_d = $e_date['2'];
							}
							for ($i = $yearStart; $i <= $yearEnd; $i++) {
								if (isset($mlkd)) {
									if ($start_m == '1' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("january $i third monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
											$display_holiday[] = 'M. L. King Day';
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("january $i third monday"));
										if ($end_m > 1 || $end_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
											$display_holiday[] = 'M. L. King Day';
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
										$display_holiday[] = 'M. L. King Day';
									}
								}
								if (isset($psd)) {
									if ($start_m <= '2' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("february $i third monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
											$display_holiday[] = "President's Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("february $i third monday"));
										if (($end_m == 2 && $end_d >= $date_check) || $end_m > 2) {
											$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
											$display_holiday[] = "President's Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
										$display_holiday[] = "President's Day";
									}
								}
								if (isset($memd)) {
									if ($start_m <= '5' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("may $i first monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
											$display_holiday[] = "Memorial Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("may $i first monday"));
										if (($end_m == 5 && $end_d >= $date_check) || $end_m > 5) {
											$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
											$display_holiday[] = "Memorial Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
										$display_holiday[] = "Memorial Day";
									}
								}
								if (isset($labd)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("september $i first monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
											$display_holiday[] = "Labor Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("september $i first monday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
											$display_holiday[] = "Labor Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
										$display_holiday[] = "Labor Day";
									}
								}
								if (isset($cold)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("october $i third monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
											$display_holiday[] = "Columbus Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("october $i third monday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
											$display_holiday[] = "Columbus Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
										$display_holiday[] = "Columbus Day";
									}
								}
								if (isset($thankd)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth thursday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
											$display_holiday[] = "Thanksgiving";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth thursday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
											$display_holiday[] = "Thanksgiving";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
										$display_holiday[] = "Thanksgiving";
									}
								}
								if (isset($blkf)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth friday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
											$display_holiday[] = "Black Friday";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth friday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
											$display_holiday[] = "Black Friday";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
										$display_holiday[] = "Black Friday";
									}
								}
							}
							$getworkdays = getWorkdays($s_date, $e_date, $check_sat, $repeat_holiday, $all_holiday, $display_holiday, $display_repeat);
						} else {
							$getworkdays = getWorkdays($s_date, $e_date, $check_sat);
						}
						$s_hour = 0;
						$s_min = 0;
						$s_sec = 0;
						$e_hour = 0;
						$e_min = 0;
						$e_sec = 0;
						// $from = new Carbon($s_date);
						// $to = new Carbon($e_date);
						$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
						$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
						$diff = $to->diff($from);
						$years = $diff->y;
						$months = $diff->m;
						$days = $diff->d;
						$from = date('M d, Y', strtotime($s_date));
						$to = date('M d, Y', strtotime($e_date));
						if (strtotime($s_date) > strtotime($e_date)) {
							$new = $from;
							$from = $to;
							$to = $new;
						}
						$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
						$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);

						$diff = abs($d2 - $d1);

						// Calculate hours, minutes, and seconds from the difference
						$hours = floor($diff / (60 * 60));
						$minutes = floor(($diff % (60 * 60)) / 60);
						$seconds = $diff % 60;

						if ($holiday_c == "no") {
							// dd($holiday_c);
							if ($ex_in == "1") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $getworkdays['weekend'];
									$ans2 = $getworkdays['weekend'];
									$weekends_days = "Excluded " . $getworkdays['weekend'];
								} else if ($satting == "5") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									// dd($endDate);

									$sun_day2 = $resultDays['Sunday'];
									if (isset($sun)) {
										$sun_day = "Excluded " . $sun_day2 . " Sundays";
									}
									$mon_day2 = $resultDays['Monday'];
									if (isset($mon)) {
										$mon_day = "Excluded " . $mon_day2 . " Mondays";
									}
									$tue_day2 = $resultDays['Tuesday'];
									if (isset($tue)) {
										$tue_day = "Excluded " . $tue_day2 . " Tuesdays";
									}
									$wed_day2 = $resultDays['Wednesday'];
									if (isset($wed)) {
										$wed_day = "Excluded " . $wed_day2 . " Wednesdays";
									}
									$thu_day2 = $resultDays['Thursday'];
									if (isset($thu)) {
										$thu_day = "Excluded " . $thu_day2 . " Thursdays";
									}
									$fri_day2 = $resultDays['Friday'];
									if (isset($fri)) {
										$fri_day = "Excluded " . $fri_day2 . " Fridays";
									}
									$sat_day2 = $resultDays['Saturday'];
									if (isset($sat)) {
										$sat_day = "Excluded " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $days_sum;
									$ans2 = $days_sum;
								}
							} else if ($ex_in == "2") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $getworkdays['weekend'];
									$ans2 = $res_days2;
									$res_days = $getworkdays['weekend'];
									$weekends_days = "Included " . $getworkdays['weekend'];
								} else if ($satting == "4") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									$sun_day2 = $resultDays['Sunday'];
									if (isset($sun)) {
										$sun_day = "Included " . $sun_day2 . " Sundays";
									}
									$mon_day2 = $resultDays['Monday'];
									if (isset($mon)) {
										$mon_day = "Included " . $mon_day2 . " Mondays";
									}
									$tue_day2 = $resultDays['Tuesday'];
									if (isset($tue)) {
										$tue_day = "Included " . $tue_day2 . " Tuesdays";
									}
									$wed_day2 = $resultDays['Wednesday'];
									if (isset($wed)) {
										$wed_day = "Included " . $wed_day2 . " Wednesdays";
									}
									$thu_day2 = $resultDays['Thursday'];
									if (isset($thu)) {
										$thu_day = "Included " . $thu_day2 . " Thursdays";
									}
									$fri_day2 = $resultDays['Friday'];
									if (isset($fri)) {
										$fri_day = "Included " . $fri_day2 . " Fridays";
									}
									$sat_day2 = $resultDays['Saturday'];
									if (isset($sat)) {
										$sat_day = "Included " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $days_sum;
									$ans2 = $res_days2;
									$res_days = $days_sum;
								}
							}
						} else if ($holiday_c == "yes") {
							if ($ex_in == "1") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $getworkdays['weekend'];
									$ans2 = $getworkdays['weekend'];
									$weekends_days = $getworkdays['weekend'];
								} else if ($satting == "5") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									if (isset($sun)) {
										$sun_day2 = $resultDays['Sunday'];
										$sun_day = "Excluded " . $sun_day2 . " Sundays";
									}
									if (isset($mon)) {
										$mon_day2 = $resultDays['Monday'];
										$mon_day = "Excluded " . $mon_day2 . " Mondays";
									}
									if (isset($tue)) {
										$tue_day2 = $resultDays['Tuesday'];
										$tue_day = "Excluded " . $tue_day2 . " Tuesdays";
									}
									if (isset($wed)) {
										$wed_day2 = $resultDays['Wednesday'];
										$wed_day = "Excluded " . $wed_day2 . " Wednesdays";
									}
									if (isset($thu)) {
										$thu_day2 = $resultDays['Thursday'];
										$thu_day = "Excluded " . $thu_day2 . " Thursdays";
									}
									if (isset($fri)) {
										$fri_day2 = $resultDays['Friday'];
										$fri_day = "Excluded " . $fri_day2 . " Fridays";
									}
									if (isset($sat)) {
										$sat_day2 = $resultDays['Saturday'];
										$sat_day = "Excluded " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $days_sum;
									$ans2 = $days_sum;
								} else if ($satting == "1") {
									$f1_ans = array_sum($getworkdays);
									$weekends_days = $getworkdays['weekend'];
									$holi_days = $getworkdays['holidays'];
									$ans2 = $holi_days + $weekends_days;
									$res_days = $f1_ans - $ans2;
								} else if ($satting == "3") {
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $getworkdays['holidays'];
									$ans2 = $getworkdays['holidays'];
									$holi_days = $getworkdays['holidays'];
								}
							} else if ($ex_in == "2") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $getworkdays['weekend'];
									$ans2 = $res_days2;
									$res_days = $getworkdays['weekend'];
									$weekends_days = $getworkdays['weekend'];
								} else if ($satting == "4") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									if (isset($sun)) {
										$sun_day2 = $resultDays['Sunday'];
										$sun_day = "Included " . $sun_day2 . " Sundays";
									}
									if (isset($mon)) {
										$mon_day2 = $resultDays['Monday'];
										$mon_day = "Included " . $mon_day2 . " Mondays";
									}
									if (isset($tue)) {
										$tue_day2 = $resultDays['Tuesday'];
										$tue_day = "Included " . $tue_day2 . " Tuesdays";
									}
									if (isset($wed)) {
										$wed_day2 = $resultDays['Wednesday'];
										$wed_day = "Included " . $wed_day2 . " Wednesdays";
									}
									if (isset($thu)) {
										$thu_day2 = $resultDays['Thursday'];
										$thu_day = "Included " . $thu_day2 . " Thursdays";
									}
									if (isset($fri)) {
										$fri_day2 = $resultDays['Friday'];
										$fri_day = "Included " . $fri_day2 . " Fridays";
									}
									if (isset($sat)) {
										$sat_day2 = $resultDays['Saturday'];
										$sat_day = "Included " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $days_sum;
									$ans2 = $res_days2;
									$res_days = $days_sum;
								} else if ($satting == "1") {
									$f1_ans = array_sum($getworkdays);
									$weekends_days = $getworkdays['weekend'];
									$holi_days = $getworkdays['holidays'];
									$res_days = $holi_days + $weekends_days;
									$ans2 = $f1_ans - $res_days;
								} else if ($satting == "3") {
									$f1_ans = array_sum($getworkdays);
									$ans2 = $f1_ans - $getworkdays['holidays'];
									$res_days = $getworkdays['holidays'];
									$holi_days = $getworkdays['holidays'];
								}
							}
						}
						if (isset($days_sum)) {
							$this->param['days_sum'] = $days_sum;
						}
						if (isset($sun_day)) {
							$this->param['sun_day'] = $sun_day;
						}
						if (isset($mon_day)) {
							$this->param['mon_day'] = $mon_day;
						}
						if (isset($tue_day)) {
							$this->param['tue_day'] = $tue_day;
						}
						if (isset($wed_day)) {
							$this->param['wed_day'] = $wed_day;
						}
						if (isset($thu_day)) {
							$this->param['thu_day'] = $thu_day;
						}
						if (isset($fri_day)) {
							$this->param['fri_day'] = $fri_day;
						}
						if (isset($sat_day)) {
							$this->param['sat_day'] = $sat_day;
						}
						if (isset($days_sum)) {
							$this->param['days_sum'] = $days_sum;
						}
						if (isset($holi_days)) {
							$this->param['holi_days'] = $holi_days;
						}
						if (isset($weekends_days)) {
							$this->param['weekends_days'] = $weekends_days;
						}
						if (isset($f1_ans)) {
							$this->param['f1_ans'] = $f1_ans;
						}
						if (isset($res_days)) {
							$this->param['res_days'] = $res_days;
						}
						$this->param = [
							'from' => $from,
							'count_days' => 'active',
							'diff' => $diff,
							'to' => $to,
							'years' => $years,
							'getworkdays' => $getworkdays,
							'months' => $months,
							'hours' => $hours,
							'days' => $days,
							'minutes' => $minutes,
							'seconds' => $seconds,
							't_days' => $getworkdays['weekend'] + $getworkdays['workdays'] + $getworkdays['holidays'],
							'ans2' => $ans2,
						];
						return $this->param;
					} else {
						return ['error' => 'Please enter start and end date'];
					}
				} else {
					if (isset($cal_bus)) {
						// $this->load->library('form_validation');
						// $this->form_validation->set_rules('add_date', 'add_date', 'required|trim|htmlspecialchars|stripslashes');
						if (is_numeric($days)) {
							// $s_date = $_POST['add_date']; // mmm,dd,yyyy
							// $s_date = explode("-", $s_date);
							$s_date = $add_date; // mmm,dd,yyyy
							$s_date = explode("-", $s_date);
							$date = "$s_date[0]-$s_date[1]-$s_date[2]";
							$start = strtotime($date);
							$date1 = "$s_date[0]-$s_date[1]-$s_date[2]";
							$days = $days;
							$weekends = 0;
							$workdays = 0;
							$holidays = 0;
							if ($weekend_c == 'no') {
								if ($method == '+') {
									for ($i = 0; $i < $days; $i++) {
										if ($i != 0) {
											$start = strtotime("+1 days", $start);
										}
										$day = date('w', $start);
										if ($day == '0' || $day == '6') {
											$weekends++;
											$days++;
										}
									}
								} else {
									for ($i = $days; $i > 0; $i--) {
										$start = strtotime("-1 days", $start);
										$day = date('w', $start);
										if ($day == '0' || $day == '6') {
											$weekends++;
											$i++;
										}
									}
								}
							} else {
								$all_holiday = array();
								$repeat_holiday = array();
								$display_holiday = array();
								$display_repeat = array();
								$year = date('Y', $start);
								if (isset($mlkd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
									$display_holiday[] = 'M. L. King Day';
								}
								if (isset($psd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
									$display_holiday[] = "President's Day";
								}
								if (isset($memd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
									$display_holiday[] = "Memorial Day";
								}
								if (isset($labd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
									$display_holiday[] = "Labor Day";
								}
								if (isset($cold)) {
									$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
									$display_holiday[] = "Columbus Day";
								}
								if (isset($thankd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth thursday"));
									$display_holiday[] = "Thanksgiving";
								}
								if (isset($blkf)) {
									$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth friday"));
									$display_holiday[] = "Black Friday";
								}
								if (isset($nyd)) {
									$repeat_holiday[] = '01-01';
									$display_repeat[] = "New Year's Day";
								}
								if (isset($ind)) {
									$repeat_holiday[] = '07-04';
									$display_repeat[] = "Independence Day";
								}
								if (isset($vetd)) {
									$repeat_holiday[] = '11-11';
									$display_repeat[] = "Veteran's Day";
								}
								if (isset($cheve)) {
									$repeat_holiday[] = '12-24';
									$display_repeat[] = "Christmas Eve";
								}
								if (isset($chirs)) {
									$repeat_holiday[] = '12-25';
									$display_repeat[] = "Christmas";
								}
								if (isset($nye)) {
									$repeat_holiday[] = '12-31';
									$display_repeat[] = "New Year's Eve";
								}
								for ($j = 0; $j <= $total_j; $j++) {
									if (is_numeric($d . $j) && is_numeric($m . $j)) {
										$repeat_holiday[] = $m . $j . '-' . $d . $j;
										$display_repeat[] = $n . $j;
									}
								}
								if ($method == '+') {
									$count = 0;
									$get_holi = array();
									$dis_holi = array();
									for ($i = 0; $i < $days; $i++) {
										if ($i != 0) {
											$start = strtotime("+1 days", $start);
										}
										$day = date('w', $start);
										$year_c = date('Y', $start);
										if ($year != $year_c) {
											$year = $year_c;
											if (isset($mlkd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
												$display_holiday[] = 'M. L. King Day';
											}
											if (isset($psd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
												$display_holiday[] = "President's Day";
											}
											if (isset($memd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
												$display_holiday[] = "Memorial Day";
											}
											if (isset($labd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
												$display_holiday[] = "Labor Day";
											}
											if (isset($cold)) {
												$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
												$display_holiday[] = "Columbus Day";
											}
											if (isset($thankd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth thursday"));
												$display_holiday[] = "Thanksgiving";
											}
											if (isset($blkf)) {
												$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth friday"));
												$display_holiday[] = "Black Friday";
											}
										}
										$mmgg = date('m-d', $start);
										$mg = date('l, M d, Y', $start);
										if (in_array($mg, $all_holiday)) {
											$get_holi[] = $mg;
											$holidays++;
											$dis_holi[] = $display_holiday[$count];
											$count++;
											$days++;
										} elseif (in_array($mmgg, $repeat_holiday)) {
											$holidays++;
											$get_holi[] = $mg;
											$c = array_search($mmgg, $repeat_holiday, true);
											$dis_holi[] = $display_repeat[$c];
											$days++;
										} elseif ($day == '0' || $day == '6') {
											$weekends++;
											$days++;
										}
									}
								} else {
									$get_holi = array();
									$dis_holi = array();
									for ($i = $days; $i > 0; $i--) {
										$start = strtotime("-1 days", $start);
										$day = date('w', $start);
										$year_c = date('Y', $start);
										if ($year != $year_c) {
											$year = $year_c;
											if (isset($mlkd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
												$display_holiday[] = 'M. L. King Day';
											}
											if (isset($psd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
												$display_holiday[] = "President's Day";
											}
											if (isset($memd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
												$display_holiday[] = "Memorial Day";
											}
											if (isset($labd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
												$display_holiday[] = "Labor Day";
											}
											if (isset($cold)) {
												$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
												$display_holiday[] = "Columbus Day";
											}
											if (isset($thankd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("november $year first thursday"));
												$display_holiday[] = "Thanksgiving";
											}
										}
										$mmgg = date('m-d', $start);
										$mg = date('l, M d, Y', $start);
										if ($day == '0' || $day == '6') {
											$weekends++;
											$i++;
										} elseif (in_array($mg, $all_holiday)) {
											$get_holi[] = $mg;
											$holidays++;
											$c = array_search($mg, $all_holiday, true);
											$dis_holi[] = $display_holiday[$c];
											$i++;
										} elseif (in_array($mmgg, $repeat_holiday)) {
											$holidays++;
											$get_holi[] = $mg;
											$c = array_search($mmgg, $repeat_holiday, true);
											$dis_holi[] = $display_repeat[$c];
											$i++;
										}
									}
								}
							}
							if ($weekend_c == 'yes') {
								$this->param['get_holi'] = $get_holi;
								$this->param['dis_holi'] = $dis_holi;
							}
							$this->param = [
								'from' => date('l, M d, Y', strtotime($date1)),
								'from_s' => date('M d, Y', strtotime($date1)),
								'date' => date('l, M d, Y', $start),
								'date_e' => date('M d, Y', $start),
								'holidays' => $holidays,
								'weekends' => $weekends,
							];
							return $this->param;
						} else {
							return ['error' => 'Please Check Your Input'];
						}
					} else if ($submitt === 'advance') {
						// if(is_numeric($years) || is_numeric($months) || is_numeric($weeks) || is_numeric($days)){
						// 	return ['error'=>];
						// }
						if ((is_numeric($years) || is_numeric($months) || is_numeric($weeks) || is_numeric($days))) {
							// dd($s_date);
							$s_date = $add_date; // mmm,dd,yyyy
							$s_date = explode("-", $s_date);
							$date = "$s_date[0]-$s_date[1]-$s_date[2]";
							$date1 = "$s_date[0]-$s_date[1]-$s_date[2]";
							// $date = $s_date->format('y-m-d');
							// $date1 = $s_date->format('y-m-d');
							if ($method === '+') {
								$des = "Added ";
							} else {
								$des = "Subtracted ";
							}
							$days = 0;
							if (!empty($days)) {
								$days = $days;
							}
							$weeks = 0;
							if (!empty($weeks)) {
								$weeks = $weeks;
							}
							$months = 0;
							if (!empty($months)) {
								$months = $months;
							}
							$years = 0;
							if (!empty($years)) {
								$years = $years;
							}
							if ($method === '+') {
								$date = date('l, M d, Y', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days'));
							} else {
								$date = date('l, M d, Y', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days'));
							}
							$des .= $years . ' years' . ' , ' . $months . ' months' . ' , ' . $weeks . ' weeks' . ' , ' . $days . ' days';
							$this->param = [
								'from' => date('l, M d, Y', strtotime($date1)),
								'from_s' => date('M d, Y', strtotime($date1)),
								'add_days' => "active",
								'date' => $date,
								'des' => $des,
							];
							return $this->param;
						} else {
							return ['error' => 'Please Check Your Input'];
							// $this->param['add'] = "active";
							// return false;
						}
					}
				}
			}
		} else {
			$add_date = $request->input('add_date');
			$method = $request->input('method');
			$years = $request->input('years');
			$months = $request->input('months');
			$weeks = $request->input('weeks');
			$days = $request->input('days');
			$repeat = $request->input('repeat');
			$add_hrs_f = $request->input('add_hrs_f');
			$add_min_f = $request->input('add_min_f');
			$add_sec_f = $request->input('add_sec_f');
			$add_hrs_s = $request->input('add_hrs_s');
			$add_min_s = $request->input('add_min_s');
			$add_sec_s = $request->input('add_sec_s');
			if ($add_date !== "" && $method !== "") {
				$s_date = $add_date; // mmm,dd,yyyy
				$s_date = explode("-", $s_date);
				$date = "$s_date[0]-$s_date[1]-$s_date[2]";
				if (empty($days)) {
					$days = 0;
				}
				if (empty($weeks)) {
					$weeks = 0;
				}
				if (empty($months)) {
					$months = 0;
				}
				if (empty($years)) {
					$years = 0;
				}
				if (empty($repeat)) {
					$repeat = "1";
				}
				if (is_numeric($add_hrs_f) || is_numeric($add_min_f) || is_numeric($add_sec_f) || is_numeric($add_hrs_s) || is_numeric($add_min_s) || is_numeric($add_sec_s)) {
					if (empty($add_hrs_f)) {
						$add_hrs_f = 0;
					}
					if (empty($add_min_f)) {
						$add_min_f = 0;
					}
					if (empty($add_sec_f)) {
						$add_sec_f = 0;
					}
					if (empty($add_hrs_s)) {
						$add_hrs_s = 0;
					}
					if (empty($add_min_s)) {
						$add_min_s = 0;
					}
					if (empty($add_sec_s)) {
						$add_sec_s = 0;
					}
					$date = $date . " " . sprintf('%02d', $add_hrs_f) . ":" . sprintf('%02d', $add_min_f) . ":" . sprintf('%02d', $add_sec_f);
					$this->param['from'] = date('l, M d, Y h:i:s A', strtotime($date));
					$this->param['add_hrs_f'] = sprintf('%02d', $add_hrs_f);
					$this->param['add_min_f'] = sprintf('%02d', $add_min_f);
					$this->param['add_sec_f'] = sprintf('%02d', $add_sec_f);
					$this->param['add_hrs_s'] = sprintf('%02d', $add_hrs_s);
					$this->param['add_min_s'] = sprintf('%02d', $add_min_s);
					$this->param['add_sec_s'] = sprintf('%02d', $add_sec_s);
					for ($i = 0; $i < $repeat; $i++) {
						if ($method === 'add') {
							$date = date('l, M d, Y h:i:s A', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days' . ' + ' . $add_hrs_s . ' hours' . ' + ' . $add_min_s . ' minutes' . ' + ' . $add_sec_s . ' seconds'));
						} else {
							$date = date('l, M d, Y h:i:s A', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days' . ' - ' . $add_hrs_s . ' hours' . ' - ' . $add_min_s . ' minutes' . ' - ' . $add_sec_s . ' seconds'));
						}
						$ans[] = $date;
					}
				} else {
					$this->param['from'] = date('l, M d, Y', strtotime($date));
					for ($i = 0; $i < $repeat; $i++) {
						if ($method === 'add') {
							$date = date('l, M d, Y', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days'));
						} else {
							$date = date('l, M d, Y', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days'));
						}
						$ans[] = $date;
					}
				}
				$this->param['method'] = $method;
				$this->param['years'] = sprintf('%02d', $years);
				$this->param['months'] = sprintf('%02d', $months);
				$this->param['weeks'] = sprintf('%02d', $weeks);
				$this->param['days'] = sprintf('%02d', $days);
				$this->param['ans'] = $ans;
				$this->param['repeat'] = $repeat;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input.';
				return $this->param;
			}
		}
	}

	// Business Days caluclator
	public function business($request)
	{
		if (app()->getLocale() !== "en") {
			$dateTypes = $request->dateTypes;
			if ($dateTypes === "date_duration") {
				$s_date = $request->s_date_duration;
				$e_date = $request->e_date_duration;
				if ($request->input('checkbox_duration') != false) {
					$checkbox = $request->input('checkbox_duration');
				} else {
					$checkbox = false;
				}
				if ($s_date !== "" && $e_date !== "") {
					$ss_date = $s_date;
					$ee_date = $e_date;
					$s_date = explode("-", $s_date);
					if ($checkbox !== false) {
						$e_date = date('Y-m-d', strtotime("+1 day" . $e_date));
					}
					$e_date = explode("-", $e_date);
					$s_hour = 0;
					$s_min = 0;
					$s_sec = 0;
					$e_hour = 0;
					$e_min = 0;
					$e_sec = 0;
					$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
					$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
					$diff = $to->diff($from);
					$years = $diff->y;
					$months = $diff->m;
					$days = $diff->d;
					$from = date('M d, Y', strtotime($ss_date));
					$to = date('M d, Y', strtotime($ee_date));
					if (strtotime($ss_date) > strtotime($ee_date)) {
						$new = $from;
						$from = $to;
						$to = $new;
					}
					$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
					$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);
					$diff = abs($d2 - $d1);
					$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)  / (60 * 60));

					$minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24  - $hours * 60 * 60) / 60);

					$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
					$this->param['from'] = $from;
					$this->param['to'] = $to;
					$this->param['years'] = $years;
					$this->param['months'] = $months;
					$this->param['hours'] = $hours;
					$this->param['days'] = $days;
					$this->param['minutes'] = $minutes;
					$this->param['seconds'] = $seconds;
				} else {
					$this->param['error'] = 'Please! Check Your Input.';
					return $this->param;
				}
				$this->param['RESULT'] = 1;
				return $this->param;
			} elseif ($dateTypes === "date_calculator") {
				$add_date = $request->input('add_date_date');
				$method = $request->input('date_method');
				$years = $request->input('date_years');
				$months = $request->input('date_months');
				$weeks = $request->input('date_weeks');
				$days = $request->input('date_days');
				$repeat = $request->input('repeat');
				$add_hrs_f = $request->input('add_hrs_f');
				$add_min_f = $request->input('add_min_f');
				$add_sec_f = $request->input('add_sec_f');
				$add_hrs_s = $request->input('add_hrs_s');
				$add_min_s = $request->input('add_min_s');
				$add_sec_s = $request->input('add_sec_s');
				if ($add_date !== "" && $method !== "") {
					$s_date = $add_date; // mmm,dd,yyyy
					$s_date = explode("-", $s_date);
					$date = "$s_date[0]-$s_date[1]-$s_date[2]";
					if (empty($days)) {
						$days = 0;
					}
					if (empty($weeks)) {
						$weeks = 0;
					}
					if (empty($months)) {
						$months = 0;
					}
					if (empty($years)) {
						$years = 0;
					}
					if (empty($repeat)) {
						$repeat = "1";
					}
					if (is_numeric($add_hrs_f) || is_numeric($add_min_f) || is_numeric($add_sec_f) || is_numeric($add_hrs_s) || is_numeric($add_min_s) || is_numeric($add_sec_s)) {
						if (empty($add_hrs_f)) {
							$add_hrs_f = 0;
						}
						if (empty($add_min_f)) {
							$add_min_f = 0;
						}
						if (empty($add_sec_f)) {
							$add_sec_f = 0;
						}
						if (empty($add_hrs_s)) {
							$add_hrs_s = 0;
						}
						if (empty($add_min_s)) {
							$add_min_s = 0;
						}
						if (empty($add_sec_s)) {
							$add_sec_s = 0;
						}
						$date = $date . " " . sprintf('%02d', $add_hrs_f) . ":" . sprintf('%02d', $add_min_f) . ":" . sprintf('%02d', $add_sec_f);
						$this->param['from'] = date('l, M d, Y h:i:s A', strtotime($date));
						$this->param['add_hrs_f'] = sprintf('%02d', $add_hrs_f);
						$this->param['add_min_f'] = sprintf('%02d', $add_min_f);
						$this->param['add_sec_f'] = sprintf('%02d', $add_sec_f);
						$this->param['add_hrs_s'] = sprintf('%02d', $add_hrs_s);
						$this->param['add_min_s'] = sprintf('%02d', $add_min_s);
						$this->param['add_sec_s'] = sprintf('%02d', $add_sec_s);
						for ($i = 0; $i < $repeat; $i++) {
							if ($method === 'add') {
								$date = date('l, M d, Y h:i:s A', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days' . ' + ' . $add_hrs_s . ' hours' . ' + ' . $add_min_s . ' minutes' . ' + ' . $add_sec_s . ' seconds'));
							} else {
								$date = date('l, M d, Y h:i:s A', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days' . ' - ' . $add_hrs_s . ' hours' . ' - ' . $add_min_s . ' minutes' . ' - ' . $add_sec_s . ' seconds'));
							}
							$ans[] = $date;
						}
					} else {
						$this->param['from'] = date('l, M d, Y', strtotime($date));
						for ($i = 0; $i < $repeat; $i++) {
							if ($method === 'add') {
								$date = date('l, M d, Y', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days'));
							} else {
								$date = date('l, M d, Y', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days'));
							}
							$ans[] = $date;
						}
					}
					$this->param['method'] = $method;
					$this->param['years'] = sprintf('%02d', $years);
					$this->param['months'] = sprintf('%02d', $months);
					$this->param['weeks'] = sprintf('%02d', $weeks);
					$this->param['days'] = sprintf('%02d', $days);
					$this->param['ans'] = $ans;
					$this->param['repeat'] = $repeat;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input.';
					return $this->param;
				}
			} else {
				$submitt = $request->input('sim_adv');
				$end_inc = $request->input('end_inc');
				$sat_inc = $request->input('sat_inc');
				$holiday_c = $request->input('holiday_c');
				$nyd = $request->input('nyd');
				$ind = $request->input('ind');
				$vetd = $request->input('vetd');
				$cheve = $request->input('cheve');
				$chirs = $request->input('chirs');
				$nye = $request->input('nye');
				$total_i = $request->input('total_i');
				$total_j = $request->input('total_j');
				$d = $request->input('d');
				$m = $request->input('m');
				$n = $request->input('n');
				$blkf = $request->input('blkf');
				$thankd = $request->input('thankd');
				$cold = $request->input('cold');
				$labd = $request->input('labd');
				$mlkd = $request->input('mlkd');
				$psd = $request->input('psd');
				$memd = $request->input('memd');
				$ex_in = $request->input('ex_in');
				$satting = $request->input('satting');
				$sun = $request->input('sun');
				$mon = $request->input('mon');
				$tue = $request->input('tue');
				$wed = $request->input('wed');
				$thu = $request->input('thu');
				$fri = $request->input('fri');
				$sat = $request->input('sat');
				$cal_bus = $request->input('cal_bus');
				$weekend_c = $request->input('weekend_c');
				$method = $request->input('method');
				$years = $request->input('years');
				$months = $request->input('months');
				$days = $request->input('days');
				$weeks = $request->input('weeks');

				$s_date = $request->input('s_date');
				$add_date = $request->input('add_date');
				$e_date = $request->input('e_date');
				function getWorkdays($date1, $date2, $workSat = FALSE, $patron = '', $fix_holiday = '', $display = '', $display_repeat = '')
				{
					if (!defined('SATURDAY')) define('SATURDAY', 6);
					if (!defined('SUNDAY')) define('SUNDAY', 0);

					// Array of all public festivities
					$publicHolidays = array();
					// The Patron day (if any) is added to public festivities
					if ($patron) {
						$publicHolidays[] = $patron;
					}
					$holi_arr = array();
					if ($fix_holiday) {
						$holi_arr[] = $fix_holiday;
					}
					$start = strtotime($date1);
					$end = strtotime($date2);
					if (!isset($end_inc)) {
						$end = strtotime("-1 day", $end);
					}
					if ($start > $end) {
						$new = $start;
						$start = $end;
						$end = $new;
					}
					$workdays = 0;
					$weekend = 0;
					$holidays = 0;
					$get_holi = array();
					$dis_holi = array();
					$count = 0;
					for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
						$day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
						$mmgg = date('m-d', $i);
						$mg = date('l, M d, Y', $i);
						if (($day == SATURDAY && $workSat == FALSE) || $day == SUNDAY) {
							$weekend++;
						} elseif (in_array($mg, $holi_arr)) {
							$get_holi[] = $mg;
							$holidays++;
							$dis_holi[] = $display[$count];
							$count++;
						} elseif (in_array($mmgg, $publicHolidays)) {
							$holidays++;
							$get_holi[] = $mg;
							$c = array_search($mmgg, $publicHolidays, true);
							$dis_holi[] = $display_repeat[$c];
						} elseif (
							$day != SUNDAY &&
							!in_array($mmgg, $publicHolidays) &&
							!($day == SATURDAY && $workSat == FALSE)
						) {
							$workdays++;
						}
					}
					$getdays = array('workdays' => $workdays, 'weekend' => $weekend, 'holidays' => $holidays, 'get_holi' => $get_holi, 'dis_holi' => $dis_holi);
					return $getdays;
				}
				if ($submitt === 'simple') {
					if ($e_date) {
						if (isset($end_inc)) {
							$e_date = date('Y-m-d', strtotime("+1 day" . $e_date));
						}
						// $e_date = explode("-", $e_date);
						if (isset($sat_inc)) {
							$check_sat = true;
						} else {
							$check_sat = false;
						}
						if ($holiday_c == 'yes') {
							$all_holiday = array();
							$repeat_holiday = array();
							$display_holiday = array();
							$display_repeat = array();
							if (isset($nyd)) {
								$repeat_holiday[] = '01-01';
								$display_repeat[] = "New Year's Day";
							}
							if (isset($ind)) {
								$repeat_holiday[] = '07-04';
								$display_repeat[] = "Independence Day";
							}
							if (isset($vetd)) {
								$repeat_holiday[] = '11-11';
								$display_repeat[] = "Veteran's Day";
							}
							if (isset($cheve)) {
								$repeat_holiday[] = '12-24';
								$display_repeat[] = "Christmas Eve";
							}
							if (isset($chirs)) {
								$repeat_holiday[] = '12-25';
								$display_repeat[] = "Christmas";
							}
							if (isset($nye)) {
								$repeat_holiday[] = '12-31';
								$display_repeat[] = "New Year's Eve";
							}
							for ($j = 0; $j <= $total_i; $j++) {
								if (is_numeric($d . $j) && is_numeric($m . $j)) {
									$repeat_holiday[] = $m . $j . '-' . $d . $j;
									$display_repeat[] = $n . $j;
								}
							}
							$yearStart = date('Y', strtotime($s_date));
							$yearEnd   = date('Y', strtotime($e_date));

							// $s_date_string = $s_date->format('Y-m-d');
							// $e_date_string = $e_date->format('Y-m-d');

							if ($yearEnd < $yearStart) {
								$start_m = $e_date['1'];
								$end_m = $s_date['1'];
								$start_d = $e_date['2'];
								$end_d = $s_date['2'];
								$yearStart = date('Y', strtotime($e_date));
								$yearEnd   = date('Y', strtotime($s_date));
							} else {
								$start_m = $s_date['1'];
								$end_m = $e_date['1'];
								$start_d = $s_date['2'];
								$end_d = $e_date['2'];
							}
							for ($i = $yearStart; $i <= $yearEnd; $i++) {
								if (isset($mlkd)) {
									if ($start_m == '1' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("january $i third monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
											$display_holiday[] = 'M. L. King Day';
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("january $i third monday"));
										if ($end_m > 1 || $end_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
											$display_holiday[] = 'M. L. King Day';
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
										$display_holiday[] = 'M. L. King Day';
									}
								}
								if (isset($psd)) {
									if ($start_m <= '2' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("february $i third monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
											$display_holiday[] = "President's Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("february $i third monday"));
										if (($end_m == 2 && $end_d >= $date_check) || $end_m > 2) {
											$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
											$display_holiday[] = "President's Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
										$display_holiday[] = "President's Day";
									}
								}
								if (isset($memd)) {
									if ($start_m <= '5' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("may $i first monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
											$display_holiday[] = "Memorial Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("may $i first monday"));
										if (($end_m == 5 && $end_d >= $date_check) || $end_m > 5) {
											$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
											$display_holiday[] = "Memorial Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
										$display_holiday[] = "Memorial Day";
									}
								}
								if (isset($labd)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("september $i first monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
											$display_holiday[] = "Labor Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("september $i first monday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
											$display_holiday[] = "Labor Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
										$display_holiday[] = "Labor Day";
									}
								}
								if (isset($cold)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("october $i third monday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
											$display_holiday[] = "Columbus Day";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("october $i third monday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
											$display_holiday[] = "Columbus Day";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
										$display_holiday[] = "Columbus Day";
									}
								}
								if (isset($thankd)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth thursday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
											$display_holiday[] = "Thanksgiving";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth thursday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
											$display_holiday[] = "Thanksgiving";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
										$display_holiday[] = "Thanksgiving";
									}
								}
								if (isset($blkf)) {
									if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth friday"));
										if ($start_d <= $date_check) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
											$display_holiday[] = "Black Friday";
										}
									}
									if ($i == $yearEnd) {
										$date_check = date('d', strtotime("november $i fourth friday"));
										if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
											$display_holiday[] = "Black Friday";
										}
									}
									if ($i != $yearStart && $i != $yearEnd) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
										$display_holiday[] = "Black Friday";
									}
								}
							}
							$getworkdays = getWorkdays($s_date, $e_date, $check_sat, $repeat_holiday, $all_holiday, $display_holiday, $display_repeat);
						} else {
							$getworkdays = getWorkdays($s_date, $e_date, $check_sat);
						}
						$s_hour = 0;
						$s_min = 0;
						$s_sec = 0;
						$e_hour = 0;
						$e_min = 0;
						$e_sec = 0;
						// $from = new Carbon($s_date);
						// $to = new Carbon($e_date);
						$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
						$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
						$diff = $to->diff($from);
						$years = $diff->y;
						$months = $diff->m;
						$days = $diff->d;
						$from = date('M d, Y', strtotime($s_date));
						$to = date('M d, Y', strtotime($e_date));
						if (strtotime($s_date) > strtotime($e_date)) {
							$new = $from;
							$from = $to;
							$to = $new;
						}
						$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
						$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);

						$diff = abs($d2 - $d1);

						// Calculate hours, minutes, and seconds from the difference
						$hours = floor($diff / (60 * 60));
						$minutes = floor(($diff % (60 * 60)) / 60);
						$seconds = $diff % 60;

						if ($holiday_c == "no") {
							// dd($holiday_c);
							if ($ex_in == "1") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $getworkdays['weekend'];
									$ans2 = $getworkdays['weekend'];
									$weekends_days = "Excluded " . $getworkdays['weekend'];
								} else if ($satting == "5") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									// dd($endDate);

									$sun_day2 = $resultDays['Sunday'];
									if (isset($sun)) {
										$sun_day = "Excluded " . $sun_day2 . " Sundays";
									}
									$mon_day2 = $resultDays['Monday'];
									if (isset($mon)) {
										$mon_day = "Excluded " . $mon_day2 . " Mondays";
									}
									$tue_day2 = $resultDays['Tuesday'];
									if (isset($tue)) {
										$tue_day = "Excluded " . $tue_day2 . " Tuesdays";
									}
									$wed_day2 = $resultDays['Wednesday'];
									if (isset($wed)) {
										$wed_day = "Excluded " . $wed_day2 . " Wednesdays";
									}
									$thu_day2 = $resultDays['Thursday'];
									if (isset($thu)) {
										$thu_day = "Excluded " . $thu_day2 . " Thursdays";
									}
									$fri_day2 = $resultDays['Friday'];
									if (isset($fri)) {
										$fri_day = "Excluded " . $fri_day2 . " Fridays";
									}
									$sat_day2 = $resultDays['Saturday'];
									if (isset($sat)) {
										$sat_day = "Excluded " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $days_sum;
									$ans2 = $days_sum;
								}
							} else if ($ex_in == "2") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $getworkdays['weekend'];
									$ans2 = $res_days2;
									$res_days = $getworkdays['weekend'];
									$weekends_days = "Included " . $getworkdays['weekend'];
								} else if ($satting == "4") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									$sun_day2 = $resultDays['Sunday'];
									if (isset($sun)) {
										$sun_day = "Included " . $sun_day2 . " Sundays";
									}
									$mon_day2 = $resultDays['Monday'];
									if (isset($mon)) {
										$mon_day = "Included " . $mon_day2 . " Mondays";
									}
									$tue_day2 = $resultDays['Tuesday'];
									if (isset($tue)) {
										$tue_day = "Included " . $tue_day2 . " Tuesdays";
									}
									$wed_day2 = $resultDays['Wednesday'];
									if (isset($wed)) {
										$wed_day = "Included " . $wed_day2 . " Wednesdays";
									}
									$thu_day2 = $resultDays['Thursday'];
									if (isset($thu)) {
										$thu_day = "Included " . $thu_day2 . " Thursdays";
									}
									$fri_day2 = $resultDays['Friday'];
									if (isset($fri)) {
										$fri_day = "Included " . $fri_day2 . " Fridays";
									}
									$sat_day2 = $resultDays['Saturday'];
									if (isset($sat)) {
										$sat_day = "Included " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $days_sum;
									$ans2 = $res_days2;
									$res_days = $days_sum;
								}
							}
						} else if ($holiday_c == "yes") {
							if ($ex_in == "1") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $getworkdays['weekend'];
									$ans2 = $getworkdays['weekend'];
									$weekends_days = $getworkdays['weekend'];
								} else if ($satting == "5") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									if (isset($sun)) {
										$sun_day2 = $resultDays['Sunday'];
										$sun_day = "Excluded " . $sun_day2 . " Sundays";
									}
									if (isset($mon)) {
										$mon_day2 = $resultDays['Monday'];
										$mon_day = "Excluded " . $mon_day2 . " Mondays";
									}
									if (isset($tue)) {
										$tue_day2 = $resultDays['Tuesday'];
										$tue_day = "Excluded " . $tue_day2 . " Tuesdays";
									}
									if (isset($wed)) {
										$wed_day2 = $resultDays['Wednesday'];
										$wed_day = "Excluded " . $wed_day2 . " Wednesdays";
									}
									if (isset($thu)) {
										$thu_day2 = $resultDays['Thursday'];
										$thu_day = "Excluded " . $thu_day2 . " Thursdays";
									}
									if (isset($fri)) {
										$fri_day2 = $resultDays['Friday'];
										$fri_day = "Excluded " . $fri_day2 . " Fridays";
									}
									if (isset($sat)) {
										$sat_day2 = $resultDays['Saturday'];
										$sat_day = "Excluded " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $days_sum;
									$ans2 = $days_sum;
								} else if ($satting == "1") {
									$f1_ans = array_sum($getworkdays);
									$weekends_days = $getworkdays['weekend'];
									$holi_days = $getworkdays['holidays'];
									$ans2 = $holi_days + $weekends_days;
									$res_days = $f1_ans - $ans2;
								} else if ($satting == "3") {
									$f1_ans = array_sum($getworkdays);
									$res_days = $f1_ans - $getworkdays['holidays'];
									$ans2 = $getworkdays['holidays'];
									$holi_days = $getworkdays['holidays'];
								}
							} else if ($ex_in == "2") {
								if ($satting == "2") {
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $getworkdays['weekend'];
									$ans2 = $res_days2;
									$res_days = $getworkdays['weekend'];
									$weekends_days = $getworkdays['weekend'];
								} else if ($satting == "4") {
									$res_days = array_sum($getworkdays);
									$ans2 = "no days were skipped in this period";
								} else if ($satting == "6") {
									// input start and end date
									$startDate = $s_date;
									$endDate = $e_date;

									$resultDays = array(
										'Sunday' => 0,
										'Monday' => 0,
										'Tuesday' => 0,
										'Wednesday' => 0,
										'Thursday' => 0,
										'Friday' => 0,
										'Saturday' => 0
									);

									// change string to date time object
									$startDate = new Carbon($startDate);
									$endDate = new Carbon($endDate);

									// iterate over start to end date
									while ($startDate <= $endDate) {
										// find the timestamp value of start date
										$timestamp = strtotime($startDate->format('d-m-Y'));

										// find out the day for timestamp and increase particular day
										$weekDay = date('l', $timestamp);
										$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

										// increase startDate by 1
										$startDate->modify('+1 day');
									}
									if (isset($sun)) {
										$sun_day2 = $resultDays['Sunday'];
										$sun_day = "Included " . $sun_day2 . " Sundays";
									}
									if (isset($mon)) {
										$mon_day2 = $resultDays['Monday'];
										$mon_day = "Included " . $mon_day2 . " Mondays";
									}
									if (isset($tue)) {
										$tue_day2 = $resultDays['Tuesday'];
										$tue_day = "Included " . $tue_day2 . " Tuesdays";
									}
									if (isset($wed)) {
										$wed_day2 = $resultDays['Wednesday'];
										$wed_day = "Included " . $wed_day2 . " Wednesdays";
									}
									if (isset($thu)) {
										$thu_day2 = $resultDays['Thursday'];
										$thu_day = "Included " . $thu_day2 . " Thursdays";
									}
									if (isset($fri)) {
										$fri_day2 = $resultDays['Friday'];
										$fri_day = "Included " . $fri_day2 . " Fridays";
									}
									if (isset($sat)) {
										$sat_day2 = $resultDays['Saturday'];
										$sat_day = "Included " . $sat_day2 . " Saturday";
									}
									$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
									$f1_ans = array_sum($getworkdays);
									$res_days2 = $f1_ans - $days_sum;
									$ans2 = $res_days2;
									$res_days = $days_sum;
								} else if ($satting == "1") {
									$f1_ans = array_sum($getworkdays);
									$weekends_days = $getworkdays['weekend'];
									$holi_days = $getworkdays['holidays'];
									$res_days = $holi_days + $weekends_days;
									$ans2 = $f1_ans - $res_days;
								} else if ($satting == "3") {
									$f1_ans = array_sum($getworkdays);
									$ans2 = $f1_ans - $getworkdays['holidays'];
									$res_days = $getworkdays['holidays'];
									$holi_days = $getworkdays['holidays'];
								}
							}
						}
						if (isset($days_sum)) {
							$this->param['days_sum'] = $days_sum;
						}
						if (isset($sun_day)) {
							$this->param['sun_day'] = $sun_day;
						}
						if (isset($mon_day)) {
							$this->param['mon_day'] = $mon_day;
						}
						if (isset($tue_day)) {
							$this->param['tue_day'] = $tue_day;
						}
						if (isset($wed_day)) {
							$this->param['wed_day'] = $wed_day;
						}
						if (isset($thu_day)) {
							$this->param['thu_day'] = $thu_day;
						}
						if (isset($fri_day)) {
							$this->param['fri_day'] = $fri_day;
						}
						if (isset($sat_day)) {
							$this->param['sat_day'] = $sat_day;
						}
						if (isset($days_sum)) {
							$this->param['days_sum'] = $days_sum;
						}
						if (isset($holi_days)) {
							$this->param['holi_days'] = $holi_days;
						}
						if (isset($weekends_days)) {
							$this->param['weekends_days'] = $weekends_days;
						}
						if (isset($f1_ans)) {
							$this->param['f1_ans'] = $f1_ans;
						}
						if (isset($res_days)) {
							$this->param['res_days'] = $res_days;
						}
						$this->param = [
							'from' => $from,
							'count_days' => 'active',
							'diff' => $diff,
							'to' => $to,
							'years' => $years,
							'getworkdays' => $getworkdays,
							'months' => $months,
							'hours' => $hours,
							'days' => $days,
							'minutes' => $minutes,
							'seconds' => $seconds,
							't_days' => $getworkdays['weekend'] + $getworkdays['workdays'] + $getworkdays['holidays'],
							'ans2' => $ans2,
						];
						return $this->param;
					} else {
						return ['error' => 'Please enter start and end date'];
					}
				} else {
					if (isset($cal_bus)) {
						// $this->load->library('form_validation');
						// $this->form_validation->set_rules('add_date', 'add_date', 'required|trim|htmlspecialchars|stripslashes');
						if (is_numeric($days)) {
							// $s_date = $_POST['add_date']; // mmm,dd,yyyy
							// $s_date = explode("-", $s_date);
							$s_date = $add_date; // mmm,dd,yyyy
							$s_date = explode("-", $s_date);
							$date = "$s_date[0]-$s_date[1]-$s_date[2]";
							$start = strtotime($date);
							$date1 = "$s_date[0]-$s_date[1]-$s_date[2]";
							$days = $days;
							$weekends = 0;
							$workdays = 0;
							$holidays = 0;
							if ($weekend_c == 'no') {
								if ($method == '+') {
									for ($i = 0; $i < $days; $i++) {
										if ($i != 0) {
											$start = strtotime("+1 days", $start);
										}
										$day = date('w', $start);
										if ($day == '0' || $day == '6') {
											$weekends++;
											$days++;
										}
									}
								} else {
									for ($i = $days; $i > 0; $i--) {
										$start = strtotime("-1 days", $start);
										$day = date('w', $start);
										if ($day == '0' || $day == '6') {
											$weekends++;
											$i++;
										}
									}
								}
							} else {
								$all_holiday = array();
								$repeat_holiday = array();
								$display_holiday = array();
								$display_repeat = array();
								$year = date('Y', $start);
								if (isset($mlkd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
									$display_holiday[] = 'M. L. King Day';
								}
								if (isset($psd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
									$display_holiday[] = "President's Day";
								}
								if (isset($memd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
									$display_holiday[] = "Memorial Day";
								}
								if (isset($labd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
									$display_holiday[] = "Labor Day";
								}
								if (isset($cold)) {
									$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
									$display_holiday[] = "Columbus Day";
								}
								if (isset($thankd)) {
									$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth thursday"));
									$display_holiday[] = "Thanksgiving";
								}
								if (isset($blkf)) {
									$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth friday"));
									$display_holiday[] = "Black Friday";
								}
								if (isset($nyd)) {
									$repeat_holiday[] = '01-01';
									$display_repeat[] = "New Year's Day";
								}
								if (isset($ind)) {
									$repeat_holiday[] = '07-04';
									$display_repeat[] = "Independence Day";
								}
								if (isset($vetd)) {
									$repeat_holiday[] = '11-11';
									$display_repeat[] = "Veteran's Day";
								}
								if (isset($cheve)) {
									$repeat_holiday[] = '12-24';
									$display_repeat[] = "Christmas Eve";
								}
								if (isset($chirs)) {
									$repeat_holiday[] = '12-25';
									$display_repeat[] = "Christmas";
								}
								if (isset($nye)) {
									$repeat_holiday[] = '12-31';
									$display_repeat[] = "New Year's Eve";
								}
								for ($j = 0; $j <= $total_j; $j++) {
									if (is_numeric($d . $j) && is_numeric($m . $j)) {
										$repeat_holiday[] = $m . $j . '-' . $d . $j;
										$display_repeat[] = $n . $j;
									}
								}
								if ($method == '+') {
									$count = 0;
									$get_holi = array();
									$dis_holi = array();
									for ($i = 0; $i < $days; $i++) {
										if ($i != 0) {
											$start = strtotime("+1 days", $start);
										}
										$day = date('w', $start);
										$year_c = date('Y', $start);
										if ($year != $year_c) {
											$year = $year_c;
											if (isset($mlkd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
												$display_holiday[] = 'M. L. King Day';
											}
											if (isset($psd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
												$display_holiday[] = "President's Day";
											}
											if (isset($memd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
												$display_holiday[] = "Memorial Day";
											}
											if (isset($labd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
												$display_holiday[] = "Labor Day";
											}
											if (isset($cold)) {
												$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
												$display_holiday[] = "Columbus Day";
											}
											if (isset($thankd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth thursday"));
												$display_holiday[] = "Thanksgiving";
											}
											if (isset($blkf)) {
												$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth friday"));
												$display_holiday[] = "Black Friday";
											}
										}
										$mmgg = date('m-d', $start);
										$mg = date('l, M d, Y', $start);
										if (in_array($mg, $all_holiday)) {
											$get_holi[] = $mg;
											$holidays++;
											$dis_holi[] = $display_holiday[$count];
											$count++;
											$days++;
										} elseif (in_array($mmgg, $repeat_holiday)) {
											$holidays++;
											$get_holi[] = $mg;
											$c = array_search($mmgg, $repeat_holiday, true);
											$dis_holi[] = $display_repeat[$c];
											$days++;
										} elseif ($day == '0' || $day == '6') {
											$weekends++;
											$days++;
										}
									}
								} else {
									$get_holi = array();
									$dis_holi = array();
									for ($i = $days; $i > 0; $i--) {
										$start = strtotime("-1 days", $start);
										$day = date('w', $start);
										$year_c = date('Y', $start);
										if ($year != $year_c) {
											$year = $year_c;
											if (isset($mlkd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
												$display_holiday[] = 'M. L. King Day';
											}
											if (isset($psd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
												$display_holiday[] = "President's Day";
											}
											if (isset($memd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
												$display_holiday[] = "Memorial Day";
											}
											if (isset($labd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
												$display_holiday[] = "Labor Day";
											}
											if (isset($cold)) {
												$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
												$display_holiday[] = "Columbus Day";
											}
											if (isset($thankd)) {
												$all_holiday[] = date('l, M d, Y', strtotime("november $year first thursday"));
												$display_holiday[] = "Thanksgiving";
											}
										}
										$mmgg = date('m-d', $start);
										$mg = date('l, M d, Y', $start);
										if ($day == '0' || $day == '6') {
											$weekends++;
											$i++;
										} elseif (in_array($mg, $all_holiday)) {
											$get_holi[] = $mg;
											$holidays++;
											$c = array_search($mg, $all_holiday, true);
											$dis_holi[] = $display_holiday[$c];
											$i++;
										} elseif (in_array($mmgg, $repeat_holiday)) {
											$holidays++;
											$get_holi[] = $mg;
											$c = array_search($mmgg, $repeat_holiday, true);
											$dis_holi[] = $display_repeat[$c];
											$i++;
										}
									}
								}
							}
							if ($weekend_c == 'yes') {
								$this->param['get_holi'] = $get_holi;
								$this->param['dis_holi'] = $dis_holi;
							}
							$this->param = [
								'from' => date('l, M d, Y', strtotime($date1)),
								'from_s' => date('M d, Y', strtotime($date1)),
								'date' => date('l, M d, Y', $start),
								'date_e' => date('M d, Y', $start),
								'holidays' => $holidays,
								'weekends' => $weekends,
							];
							return $this->param;
						} else {
							return ['error' => 'Please Check Your Input'];
						}
					} else if ($submitt === 'advance') {
						// if(is_numeric($years) || is_numeric($months) || is_numeric($weeks) || is_numeric($days)){
						// 	return ['error'=>];
						// }
						if ((is_numeric($years) || is_numeric($months) || is_numeric($weeks) || is_numeric($days))) {
							// dd($s_date);
							$s_date = $add_date; // mmm,dd,yyyy
							$s_date = explode("-", $s_date);
							$date = "$s_date[0]-$s_date[1]-$s_date[2]";
							$date1 = "$s_date[0]-$s_date[1]-$s_date[2]";
							// $date = $s_date->format('y-m-d');
							// $date1 = $s_date->format('y-m-d');
							if ($method === '+') {
								$des = "Added ";
							} else {
								$des = "Subtracted ";
							}
							$days = 0;
							if (!empty($days)) {
								$days = $days;
							}
							$weeks = 0;
							if (!empty($weeks)) {
								$weeks = $weeks;
							}
							$months = 0;
							if (!empty($months)) {
								$months = $months;
							}
							$years = 0;
							if (!empty($years)) {
								$years = $years;
							}
							if ($method === '+') {
								$date = date('l, M d, Y', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days'));
							} else {
								$date = date('l, M d, Y', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days'));
							}
							$des .= $years . ' years' . ' , ' . $months . ' months' . ' , ' . $weeks . ' weeks' . ' , ' . $days . ' days';
							$this->param = [
								'from' => date('l, M d, Y', strtotime($date1)),
								'from_s' => date('M d, Y', strtotime($date1)),
								'add_days' => "active",
								'date' => $date,
								'des' => $des,
							];
							return $this->param;
						} else {
							return ['error' => 'Please Check Your Input'];
							// $this->param['add'] = "active";
							// return false;
						}
					}
				}
			}
		} else {
			$submitt = $request->input('sim_adv');
			$end_inc = $request->input('end_inc');
			$sat_inc = $request->input('sat_inc');
			$holiday_c = $request->input('holiday_c');
			$nyd = $request->input('nyd');
			$ind = $request->input('ind');
			$vetd = $request->input('vetd');
			$cheve = $request->input('cheve');
			$chirs = $request->input('chirs');
			$nye = $request->input('nye');
			$total_i = $request->input('total_i');
			$total_j = $request->input('total_j');
			$d = $request->input('d');
			$m = $request->input('m');
			$n = $request->input('n');
			$blkf = $request->input('blkf');
			$thankd = $request->input('thankd');
			$cold = $request->input('cold');
			$labd = $request->input('labd');
			$mlkd = $request->input('mlkd');
			$psd = $request->input('psd');
			$memd = $request->input('memd');
			$ex_in = $request->input('ex_in');
			$satting = $request->input('satting');
			$sun = $request->input('sun');
			$mon = $request->input('mon');
			$tue = $request->input('tue');
			$wed = $request->input('wed');
			$thu = $request->input('thu');
			$fri = $request->input('fri');
			$sat = $request->input('sat');
			$cal_bus = $request->input('cal_bus');
			$weekend_c = $request->input('weekend_c');
			$method = $request->input('method');
			$years = $request->input('years');
			$months = $request->input('months');
			$days = $request->input('days');
			$weeks = $request->input('weeks');

			$s_date = $request->input('s_date');
			$add_date = $request->input('add_date');
			$e_date = $request->input('e_date');
			function getWorkdays($date1, $date2, $workSat = FALSE, $patron = '', $fix_holiday = '', $display = '', $display_repeat = '')
			{
				if (!defined('SATURDAY')) define('SATURDAY', 6);
				if (!defined('SUNDAY')) define('SUNDAY', 0);

				// Array of all public festivities
				$publicHolidays = array();
				// The Patron day (if any) is added to public festivities
				if ($patron) {
					$publicHolidays[] = $patron;
				}
				$holi_arr = array();
				if ($fix_holiday) {
					$holi_arr[] = $fix_holiday;
				}
				$start = strtotime($date1);
				$end = strtotime($date2);
				if (!isset($end_inc)) {
					$end = strtotime("-1 day", $end);
				}
				if ($start > $end) {
					$new = $start;
					$start = $end;
					$end = $new;
				}
				$workdays = 0;
				$weekend = 0;
				$holidays = 0;
				$get_holi = array();
				$dis_holi = array();
				$count = 0;
				for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
					$day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
					$mmgg = date('m-d', $i);
					$mg = date('l, M d, Y', $i);
					if (($day == SATURDAY && $workSat == FALSE) || $day == SUNDAY) {
						$weekend++;
					} elseif (in_array($mg, $holi_arr)) {
						$get_holi[] = $mg;
						$holidays++;
						$dis_holi[] = $display[$count];
						$count++;
					} elseif (in_array($mmgg, $publicHolidays)) {
						$holidays++;
						$get_holi[] = $mg;
						$c = array_search($mmgg, $publicHolidays, true);
						$dis_holi[] = $display_repeat[$c];
					} elseif (
						$day != SUNDAY &&
						!in_array($mmgg, $publicHolidays) &&
						!($day == SATURDAY && $workSat == FALSE)
					) {
						$workdays++;
					}
				}
				$getdays = array('workdays' => $workdays, 'weekend' => $weekend, 'holidays' => $holidays, 'get_holi' => $get_holi, 'dis_holi' => $dis_holi);
				return $getdays;
			}
			if ($submitt === 'simple') {
				if ($e_date) {
					if (isset($end_inc)) {
						$e_date = date('Y-m-d', strtotime("+1 day" . $e_date));
					}
					// $e_date = explode("-", $e_date);
					if (isset($sat_inc)) {
						$check_sat = true;
					} else {
						$check_sat = false;
					}
					if ($holiday_c == 'yes') {
						$all_holiday = array();
						$repeat_holiday = array();
						$display_holiday = array();
						$display_repeat = array();
						if (isset($nyd)) {
							$repeat_holiday[] = '01-01';
							$display_repeat[] = "New Year's Day";
						}
						if (isset($ind)) {
							$repeat_holiday[] = '07-04';
							$display_repeat[] = "Independence Day";
						}
						if (isset($vetd)) {
							$repeat_holiday[] = '11-11';
							$display_repeat[] = "Veteran's Day";
						}
						if (isset($cheve)) {
							$repeat_holiday[] = '12-24';
							$display_repeat[] = "Christmas Eve";
						}
						if (isset($chirs)) {
							$repeat_holiday[] = '12-25';
							$display_repeat[] = "Christmas";
						}
						if (isset($nye)) {
							$repeat_holiday[] = '12-31';
							$display_repeat[] = "New Year's Eve";
						}
						for ($j = 0; $j <= $total_i; $j++) {
							if (is_numeric($d . $j) && is_numeric($m . $j)) {
								$repeat_holiday[] = $m . $j . '-' . $d . $j;
								$display_repeat[] = $n . $j;
							}
						}
						$yearStart = date('Y', strtotime($s_date));
						$yearEnd   = date('Y', strtotime($e_date));

						// $s_date_string = $s_date->format('Y-m-d');
						// $e_date_string = $e_date->format('Y-m-d');

						if ($yearEnd < $yearStart) {
							$start_m = $e_date['1'];
							$end_m = $s_date['1'];
							$start_d = $e_date['2'];
							$end_d = $s_date['2'];
							$yearStart = date('Y', strtotime($e_date));
							$yearEnd   = date('Y', strtotime($s_date));
						} else {
							$start_m = $s_date['1'];
							$end_m = $e_date['1'];
							$start_d = $s_date['2'];
							$end_d = $e_date['2'];
						}
						for ($i = $yearStart; $i <= $yearEnd; $i++) {
							if (isset($mlkd)) {
								if ($start_m == '1' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("january $i third monday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
										$display_holiday[] = 'M. L. King Day';
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("january $i third monday"));
									if ($end_m > 1 || $end_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
										$display_holiday[] = 'M. L. King Day';
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("january $i third monday"));
									$display_holiday[] = 'M. L. King Day';
								}
							}
							if (isset($psd)) {
								if ($start_m <= '2' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("february $i third monday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
										$display_holiday[] = "President's Day";
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("february $i third monday"));
									if (($end_m == 2 && $end_d >= $date_check) || $end_m > 2) {
										$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
										$display_holiday[] = "President's Day";
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("february $i third monday"));
									$display_holiday[] = "President's Day";
								}
							}
							if (isset($memd)) {
								if ($start_m <= '5' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("may $i first monday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
										$display_holiday[] = "Memorial Day";
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("may $i first monday"));
									if (($end_m == 5 && $end_d >= $date_check) || $end_m > 5) {
										$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
										$display_holiday[] = "Memorial Day";
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("may $i first monday"));
									$display_holiday[] = "Memorial Day";
								}
							}
							if (isset($labd)) {
								if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("september $i first monday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
										$display_holiday[] = "Labor Day";
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("september $i first monday"));
									if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
										$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
										$display_holiday[] = "Labor Day";
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("september $i first monday"));
									$display_holiday[] = "Labor Day";
								}
							}
							if (isset($cold)) {
								if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("october $i third monday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
										$display_holiday[] = "Columbus Day";
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("october $i third monday"));
									if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
										$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
										$display_holiday[] = "Columbus Day";
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("october $i third monday"));
									$display_holiday[] = "Columbus Day";
								}
							}
							if (isset($thankd)) {
								if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("november $i fourth thursday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
										$display_holiday[] = "Thanksgiving";
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("november $i fourth thursday"));
									if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
										$display_holiday[] = "Thanksgiving";
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth thursday"));
									$display_holiday[] = "Thanksgiving";
								}
							}
							if (isset($blkf)) {
								if ($start_m <= '9' && $i == $yearStart && $yearStart != $yearEnd) {
									$date_check = date('d', strtotime("november $i fourth friday"));
									if ($start_d <= $date_check) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
										$display_holiday[] = "Black Friday";
									}
								}
								if ($i == $yearEnd) {
									$date_check = date('d', strtotime("november $i fourth friday"));
									if (($end_m == 9 && $end_d >= $date_check) || $end_m > 9) {
										$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
										$display_holiday[] = "Black Friday";
									}
								}
								if ($i != $yearStart && $i != $yearEnd) {
									$all_holiday[] = date('l, M d, Y', strtotime("november $i fourth friday"));
									$display_holiday[] = "Black Friday";
								}
							}
						}
						$getworkdays = getWorkdays($s_date, $e_date, $check_sat, $repeat_holiday, $all_holiday, $display_holiday, $display_repeat);
					} else {
						$getworkdays = getWorkdays($s_date, $e_date, $check_sat);
					}
					$s_hour = 0;
					$s_min = 0;
					$s_sec = 0;
					$e_hour = 0;
					$e_min = 0;
					$e_sec = 0;
					// $from = new Carbon($s_date);
					// $to = new Carbon($e_date);
					$from = new Carbon($s_date[2] . '.' . $s_date[1] . '.' . $s_date[0]);
					$to = new Carbon($e_date[2] . '.' . $e_date[1] . '.' . $e_date[0]);
					$diff = $to->diff($from);
					$years = $diff->y;
					$months = $diff->m;
					$days = $diff->d;
					$from = date('M d, Y', strtotime($s_date));
					$to = date('M d, Y', strtotime($e_date));
					if (strtotime($s_date) > strtotime($e_date)) {
						$new = $from;
						$from = $to;
						$to = $new;
					}
					$d1 = mktime($s_hour, $s_min, $s_sec, $s_date[1], $s_date[2], $s_date[0]);
					$d2 = mktime($e_hour, $e_min, $e_sec, $e_date[1], $e_date[2], $e_date[0]);

					$diff = abs($d2 - $d1);

					// Calculate hours, minutes, and seconds from the difference
					$hours = floor($diff / (60 * 60));
					$minutes = floor(($diff % (60 * 60)) / 60);
					$seconds = $diff % 60;

					if ($holiday_c == "no") {
						// dd($holiday_c);
						if ($ex_in == "1") {
							if ($satting == "2") {
								$f1_ans = array_sum($getworkdays);
								$res_days = $f1_ans - $getworkdays['weekend'];
								$ans2 = $getworkdays['weekend'];
								$weekends_days = "Excluded " . $getworkdays['weekend'];
							} else if ($satting == "5") {
								$res_days = array_sum($getworkdays);
								$ans2 = "no days were skipped in this period";
							} else if ($satting == "6") {
								// input start and end date
								$startDate = $s_date;
								$endDate = $e_date;

								$resultDays = array(
									'Sunday' => 0,
									'Monday' => 0,
									'Tuesday' => 0,
									'Wednesday' => 0,
									'Thursday' => 0,
									'Friday' => 0,
									'Saturday' => 0
								);

								// change string to date time object
								$startDate = new Carbon($startDate);
								$endDate = new Carbon($endDate);

								// iterate over start to end date
								while ($startDate <= $endDate) {
									// find the timestamp value of start date
									$timestamp = strtotime($startDate->format('d-m-Y'));

									// find out the day for timestamp and increase particular day
									$weekDay = date('l', $timestamp);
									$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

									// increase startDate by 1
									$startDate->modify('+1 day');
								}
								// dd($endDate);

								$sun_day2 = $resultDays['Sunday'];
								if (isset($sun)) {
									$sun_day = "Excluded " . $sun_day2 . " Sundays";
								}
								$mon_day2 = $resultDays['Monday'];
								if (isset($mon)) {
									$mon_day = "Excluded " . $mon_day2 . " Mondays";
								}
								$tue_day2 = $resultDays['Tuesday'];
								if (isset($tue)) {
									$tue_day = "Excluded " . $tue_day2 . " Tuesdays";
								}
								$wed_day2 = $resultDays['Wednesday'];
								if (isset($wed)) {
									$wed_day = "Excluded " . $wed_day2 . " Wednesdays";
								}
								$thu_day2 = $resultDays['Thursday'];
								if (isset($thu)) {
									$thu_day = "Excluded " . $thu_day2 . " Thursdays";
								}
								$fri_day2 = $resultDays['Friday'];
								if (isset($fri)) {
									$fri_day = "Excluded " . $fri_day2 . " Fridays";
								}
								$sat_day2 = $resultDays['Saturday'];
								if (isset($sat)) {
									$sat_day = "Excluded " . $sat_day2 . " Saturday";
								}
								$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
								$f1_ans = array_sum($getworkdays);
								$res_days = $f1_ans - $days_sum;
								$ans2 = $days_sum;
							}
						} else if ($ex_in == "2") {
							if ($satting == "2") {
								$f1_ans = array_sum($getworkdays);
								$res_days2 = $f1_ans - $getworkdays['weekend'];
								$ans2 = $res_days2;
								$res_days = $getworkdays['weekend'];
								$weekends_days = "Included " . $getworkdays['weekend'];
							} else if ($satting == "4") {
								$res_days = array_sum($getworkdays);
								$ans2 = "no days were skipped in this period";
							} else if ($satting == "6") {
								// input start and end date
								$startDate = $s_date;
								$endDate = $e_date;

								$resultDays = array(
									'Sunday' => 0,
									'Monday' => 0,
									'Tuesday' => 0,
									'Wednesday' => 0,
									'Thursday' => 0,
									'Friday' => 0,
									'Saturday' => 0
								);

								// change string to date time object
								$startDate = new Carbon($startDate);
								$endDate = new Carbon($endDate);

								// iterate over start to end date
								while ($startDate <= $endDate) {
									// find the timestamp value of start date
									$timestamp = strtotime($startDate->format('d-m-Y'));

									// find out the day for timestamp and increase particular day
									$weekDay = date('l', $timestamp);
									$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

									// increase startDate by 1
									$startDate->modify('+1 day');
								}
								$sun_day2 = $resultDays['Sunday'];
								if (isset($sun)) {
									$sun_day = "Included " . $sun_day2 . " Sundays";
								}
								$mon_day2 = $resultDays['Monday'];
								if (isset($mon)) {
									$mon_day = "Included " . $mon_day2 . " Mondays";
								}
								$tue_day2 = $resultDays['Tuesday'];
								if (isset($tue)) {
									$tue_day = "Included " . $tue_day2 . " Tuesdays";
								}
								$wed_day2 = $resultDays['Wednesday'];
								if (isset($wed)) {
									$wed_day = "Included " . $wed_day2 . " Wednesdays";
								}
								$thu_day2 = $resultDays['Thursday'];
								if (isset($thu)) {
									$thu_day = "Included " . $thu_day2 . " Thursdays";
								}
								$fri_day2 = $resultDays['Friday'];
								if (isset($fri)) {
									$fri_day = "Included " . $fri_day2 . " Fridays";
								}
								$sat_day2 = $resultDays['Saturday'];
								if (isset($sat)) {
									$sat_day = "Included " . $sat_day2 . " Saturday";
								}
								$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
								$f1_ans = array_sum($getworkdays);
								$res_days2 = $f1_ans - $days_sum;
								$ans2 = $res_days2;
								$res_days = $days_sum;
							}
						}
					} else if ($holiday_c == "yes") {
						if ($ex_in == "1") {
							if ($satting == "2") {
								$f1_ans = array_sum($getworkdays);
								$res_days = $f1_ans - $getworkdays['weekend'];
								$ans2 = $getworkdays['weekend'];
								$weekends_days = $getworkdays['weekend'];
							} else if ($satting == "5") {
								$res_days = array_sum($getworkdays);
								$ans2 = "no days were skipped in this period";
							} else if ($satting == "6") {
								// input start and end date
								$startDate = $s_date;
								$endDate = $e_date;

								$resultDays = array(
									'Sunday' => 0,
									'Monday' => 0,
									'Tuesday' => 0,
									'Wednesday' => 0,
									'Thursday' => 0,
									'Friday' => 0,
									'Saturday' => 0
								);

								// change string to date time object
								$startDate = new Carbon($startDate);
								$endDate = new Carbon($endDate);

								// iterate over start to end date
								while ($startDate <= $endDate) {
									// find the timestamp value of start date
									$timestamp = strtotime($startDate->format('d-m-Y'));

									// find out the day for timestamp and increase particular day
									$weekDay = date('l', $timestamp);
									$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

									// increase startDate by 1
									$startDate->modify('+1 day');
								}
								if (isset($sun)) {
									$sun_day2 = $resultDays['Sunday'];
									$sun_day = "Excluded " . $sun_day2 . " Sundays";
								}
								if (isset($mon)) {
									$mon_day2 = $resultDays['Monday'];
									$mon_day = "Excluded " . $mon_day2 . " Mondays";
								}
								if (isset($tue)) {
									$tue_day2 = $resultDays['Tuesday'];
									$tue_day = "Excluded " . $tue_day2 . " Tuesdays";
								}
								if (isset($wed)) {
									$wed_day2 = $resultDays['Wednesday'];
									$wed_day = "Excluded " . $wed_day2 . " Wednesdays";
								}
								if (isset($thu)) {
									$thu_day2 = $resultDays['Thursday'];
									$thu_day = "Excluded " . $thu_day2 . " Thursdays";
								}
								if (isset($fri)) {
									$fri_day2 = $resultDays['Friday'];
									$fri_day = "Excluded " . $fri_day2 . " Fridays";
								}
								if (isset($sat)) {
									$sat_day2 = $resultDays['Saturday'];
									$sat_day = "Excluded " . $sat_day2 . " Saturday";
								}
								$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
								$f1_ans = array_sum($getworkdays);
								$res_days = $f1_ans - $days_sum;
								$ans2 = $days_sum;
							} else if ($satting == "1") {
								$f1_ans = array_sum($getworkdays);
								$weekends_days = $getworkdays['weekend'];
								$holi_days = $getworkdays['holidays'];
								$ans2 = $holi_days + $weekends_days;
								$res_days = $f1_ans - $ans2;
							} else if ($satting == "3") {
								$f1_ans = array_sum($getworkdays);
								$res_days = $f1_ans - $getworkdays['holidays'];
								$ans2 = $getworkdays['holidays'];
								$holi_days = $getworkdays['holidays'];
							}
						} else if ($ex_in == "2") {
							if ($satting == "2") {
								$f1_ans = array_sum($getworkdays);
								$res_days2 = $f1_ans - $getworkdays['weekend'];
								$ans2 = $res_days2;
								$res_days = $getworkdays['weekend'];
								$weekends_days = $getworkdays['weekend'];
							} else if ($satting == "4") {
								$res_days = array_sum($getworkdays);
								$ans2 = "no days were skipped in this period";
							} else if ($satting == "6") {
								// input start and end date
								$startDate = $s_date;
								$endDate = $e_date;

								$resultDays = array(
									'Sunday' => 0,
									'Monday' => 0,
									'Tuesday' => 0,
									'Wednesday' => 0,
									'Thursday' => 0,
									'Friday' => 0,
									'Saturday' => 0
								);

								// change string to date time object
								$startDate = new Carbon($startDate);
								$endDate = new Carbon($endDate);

								// iterate over start to end date
								while ($startDate <= $endDate) {
									// find the timestamp value of start date
									$timestamp = strtotime($startDate->format('d-m-Y'));

									// find out the day for timestamp and increase particular day
									$weekDay = date('l', $timestamp);
									$resultDays[$weekDay] = $resultDays[$weekDay] + 1;

									// increase startDate by 1
									$startDate->modify('+1 day');
								}
								if (isset($sun)) {
									$sun_day2 = $resultDays['Sunday'];
									$sun_day = "Included " . $sun_day2 . " Sundays";
								}
								if (isset($mon)) {
									$mon_day2 = $resultDays['Monday'];
									$mon_day = "Included " . $mon_day2 . " Mondays";
								}
								if (isset($tue)) {
									$tue_day2 = $resultDays['Tuesday'];
									$tue_day = "Included " . $tue_day2 . " Tuesdays";
								}
								if (isset($wed)) {
									$wed_day2 = $resultDays['Wednesday'];
									$wed_day = "Included " . $wed_day2 . " Wednesdays";
								}
								if (isset($thu)) {
									$thu_day2 = $resultDays['Thursday'];
									$thu_day = "Included " . $thu_day2 . " Thursdays";
								}
								if (isset($fri)) {
									$fri_day2 = $resultDays['Friday'];
									$fri_day = "Included " . $fri_day2 . " Fridays";
								}
								if (isset($sat)) {
									$sat_day2 = $resultDays['Saturday'];
									$sat_day = "Included " . $sat_day2 . " Saturday";
								}
								$days_sum = $sun_day2 + $mon_day2 + $tue_day2 + $wed_day2 + $thu_day2 + $fri_day2 + $sat_day2;
								$f1_ans = array_sum($getworkdays);
								$res_days2 = $f1_ans - $days_sum;
								$ans2 = $res_days2;
								$res_days = $days_sum;
							} else if ($satting == "1") {
								$f1_ans = array_sum($getworkdays);
								$weekends_days = $getworkdays['weekend'];
								$holi_days = $getworkdays['holidays'];
								$res_days = $holi_days + $weekends_days;
								$ans2 = $f1_ans - $res_days;
							} else if ($satting == "3") {
								$f1_ans = array_sum($getworkdays);
								$ans2 = $f1_ans - $getworkdays['holidays'];
								$res_days = $getworkdays['holidays'];
								$holi_days = $getworkdays['holidays'];
							}
						}
					}
					if (isset($days_sum)) {
						$this->param['days_sum'] = $days_sum;
					}
					if (isset($sun_day)) {
						$this->param['sun_day'] = $sun_day;
					}
					if (isset($mon_day)) {
						$this->param['mon_day'] = $mon_day;
					}
					if (isset($tue_day)) {
						$this->param['tue_day'] = $tue_day;
					}
					if (isset($wed_day)) {
						$this->param['wed_day'] = $wed_day;
					}
					if (isset($thu_day)) {
						$this->param['thu_day'] = $thu_day;
					}
					if (isset($fri_day)) {
						$this->param['fri_day'] = $fri_day;
					}
					if (isset($sat_day)) {
						$this->param['sat_day'] = $sat_day;
					}
					if (isset($days_sum)) {
						$this->param['days_sum'] = $days_sum;
					}
					if (isset($holi_days)) {
						$this->param['holi_days'] = $holi_days;
					}
					if (isset($weekends_days)) {
						$this->param['weekends_days'] = $weekends_days;
					}
					if (isset($f1_ans)) {
						$this->param['f1_ans'] = $f1_ans;
					}
					if (isset($res_days)) {
						$this->param['res_days'] = $res_days;
					}
					$this->param = [
						'from' => $from,
						'count_days' => 'active',
						'diff' => $diff,
						'to' => $to,
						'years' => $years,
						'getworkdays' => $getworkdays,
						'months' => $months,
						'hours' => $hours,
						'days' => $days,
						'minutes' => $minutes,
						'seconds' => $seconds,
						't_days' => $getworkdays['weekend'] + $getworkdays['workdays'] + $getworkdays['holidays'],
						'ans2' => $ans2,
					];
					return $this->param;
				} else {
					return ['error' => 'Please enter start and end date'];
				}
			} else {
				if (isset($cal_bus)) {
					// $this->load->library('form_validation');
					// $this->form_validation->set_rules('add_date', 'add_date', 'required|trim|htmlspecialchars|stripslashes');
					if (is_numeric($days)) {
						// $s_date = $_POST['add_date']; // mmm,dd,yyyy
						// $s_date = explode("-", $s_date);
						$s_date = $add_date; // mmm,dd,yyyy
						$s_date = explode("-", $s_date);
						$date = "$s_date[0]-$s_date[1]-$s_date[2]";
						$start = strtotime($date);
						$date1 = "$s_date[0]-$s_date[1]-$s_date[2]";
						$days = $days;
						$weekends = 0;
						$workdays = 0;
						$holidays = 0;
						if ($weekend_c == 'no') {
							if ($method == '+') {
								for ($i = 0; $i < $days; $i++) {
									if ($i != 0) {
										$start = strtotime("+1 days", $start);
									}
									$day = date('w', $start);
									if ($day == '0' || $day == '6') {
										$weekends++;
										$days++;
									}
								}
							} else {
								for ($i = $days; $i > 0; $i--) {
									$start = strtotime("-1 days", $start);
									$day = date('w', $start);
									if ($day == '0' || $day == '6') {
										$weekends++;
										$i++;
									}
								}
							}
						} else {
							$all_holiday = array();
							$repeat_holiday = array();
							$display_holiday = array();
							$display_repeat = array();
							$year = date('Y', $start);
							if (isset($mlkd)) {
								$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
								$display_holiday[] = 'M. L. King Day';
							}
							if (isset($psd)) {
								$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
								$display_holiday[] = "President's Day";
							}
							if (isset($memd)) {
								$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
								$display_holiday[] = "Memorial Day";
							}
							if (isset($labd)) {
								$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
								$display_holiday[] = "Labor Day";
							}
							if (isset($cold)) {
								$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
								$display_holiday[] = "Columbus Day";
							}
							if (isset($thankd)) {
								$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth thursday"));
								$display_holiday[] = "Thanksgiving";
							}
							if (isset($blkf)) {
								$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth friday"));
								$display_holiday[] = "Black Friday";
							}
							if (isset($nyd)) {
								$repeat_holiday[] = '01-01';
								$display_repeat[] = "New Year's Day";
							}
							if (isset($ind)) {
								$repeat_holiday[] = '07-04';
								$display_repeat[] = "Independence Day";
							}
							if (isset($vetd)) {
								$repeat_holiday[] = '11-11';
								$display_repeat[] = "Veteran's Day";
							}
							if (isset($cheve)) {
								$repeat_holiday[] = '12-24';
								$display_repeat[] = "Christmas Eve";
							}
							if (isset($chirs)) {
								$repeat_holiday[] = '12-25';
								$display_repeat[] = "Christmas";
							}
							if (isset($nye)) {
								$repeat_holiday[] = '12-31';
								$display_repeat[] = "New Year's Eve";
							}
							for ($j = 0; $j <= $total_j; $j++) {
								if (is_numeric($d . $j) && is_numeric($m . $j)) {
									$repeat_holiday[] = $m . $j . '-' . $d . $j;
									$display_repeat[] = $n . $j;
								}
							}
							if ($method == '+') {
								$count = 0;
								$get_holi = array();
								$dis_holi = array();
								for ($i = 0; $i < $days; $i++) {
									if ($i != 0) {
										$start = strtotime("+1 days", $start);
									}
									$day = date('w', $start);
									$year_c = date('Y', $start);
									if ($year != $year_c) {
										$year = $year_c;
										if (isset($mlkd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
											$display_holiday[] = 'M. L. King Day';
										}
										if (isset($psd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
											$display_holiday[] = "President's Day";
										}
										if (isset($memd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
											$display_holiday[] = "Memorial Day";
										}
										if (isset($labd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
											$display_holiday[] = "Labor Day";
										}
										if (isset($cold)) {
											$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
											$display_holiday[] = "Columbus Day";
										}
										if (isset($thankd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth thursday"));
											$display_holiday[] = "Thanksgiving";
										}
										if (isset($blkf)) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $year fourth friday"));
											$display_holiday[] = "Black Friday";
										}
									}
									$mmgg = date('m-d', $start);
									$mg = date('l, M d, Y', $start);
									if (in_array($mg, $all_holiday)) {
										$get_holi[] = $mg;
										$holidays++;
										$dis_holi[] = $display_holiday[$count];
										$count++;
										$days++;
									} elseif (in_array($mmgg, $repeat_holiday)) {
										$holidays++;
										$get_holi[] = $mg;
										$c = array_search($mmgg, $repeat_holiday, true);
										$dis_holi[] = $display_repeat[$c];
										$days++;
									} elseif ($day == '0' || $day == '6') {
										$weekends++;
										$days++;
									}
								}
							} else {
								$get_holi = array();
								$dis_holi = array();
								for ($i = $days; $i > 0; $i--) {
									$start = strtotime("-1 days", $start);
									$day = date('w', $start);
									$year_c = date('Y', $start);
									if ($year != $year_c) {
										$year = $year_c;
										if (isset($mlkd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("january $year third monday"));
											$display_holiday[] = 'M. L. King Day';
										}
										if (isset($psd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("february $year third monday"));
											$display_holiday[] = "President's Day";
										}
										if (isset($memd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("may $year first monday"));
											$display_holiday[] = "Memorial Day";
										}
										if (isset($labd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("september $year first monday"));
											$display_holiday[] = "Labor Day";
										}
										if (isset($cold)) {
											$all_holiday[] = date('l, M d, Y', strtotime("october $year third monday"));
											$display_holiday[] = "Columbus Day";
										}
										if (isset($thankd)) {
											$all_holiday[] = date('l, M d, Y', strtotime("november $year first thursday"));
											$display_holiday[] = "Thanksgiving";
										}
									}
									$mmgg = date('m-d', $start);
									$mg = date('l, M d, Y', $start);
									if ($day == '0' || $day == '6') {
										$weekends++;
										$i++;
									} elseif (in_array($mg, $all_holiday)) {
										$get_holi[] = $mg;
										$holidays++;
										$c = array_search($mg, $all_holiday, true);
										$dis_holi[] = $display_holiday[$c];
										$i++;
									} elseif (in_array($mmgg, $repeat_holiday)) {
										$holidays++;
										$get_holi[] = $mg;
										$c = array_search($mmgg, $repeat_holiday, true);
										$dis_holi[] = $display_repeat[$c];
										$i++;
									}
								}
							}
						}
						if ($weekend_c == 'yes') {
							$this->param['get_holi'] = $get_holi;
							$this->param['dis_holi'] = $dis_holi;
						}
						$this->param = [
							'from' => date('l, M d, Y', strtotime($date1)),
							'from_s' => date('M d, Y', strtotime($date1)),
							'date' => date('l, M d, Y', $start),
							'date_e' => date('M d, Y', $start),
							'holidays' => $holidays,
							'weekends' => $weekends,
						];
						return $this->param;
					} else {
						return ['error' => 'Please Check Your Input'];
					}
				} else if ($submitt === 'advance') {
					// if(is_numeric($years) || is_numeric($months) || is_numeric($weeks) || is_numeric($days)){
					// 	return ['error'=>];
					// }
					if ((is_numeric($years) || is_numeric($months) || is_numeric($weeks) || is_numeric($days))) {
						// dd($s_date);
						$s_date = $add_date; // mmm,dd,yyyy
						$s_date = explode("-", $s_date);
						$date = "$s_date[0]-$s_date[1]-$s_date[2]";
						$date1 = "$s_date[0]-$s_date[1]-$s_date[2]";
						// $date = $s_date->format('y-m-d');
						// $date1 = $s_date->format('y-m-d');
						if ($method === '+') {
							$des = "Added ";
						} else {
							$des = "Subtracted ";
						}
						$days = 0;
						if (!empty($days)) {
							$days = $days;
						}
						$weeks = 0;
						if (!empty($weeks)) {
							$weeks = $weeks;
						}
						$months = 0;
						if (!empty($months)) {
							$months = $months;
						}
						$years = 0;
						if (!empty($years)) {
							$years = $years;
						}
						if ($method === '+') {
							$date = date('l, M d, Y', strtotime($date . ' + ' . $years . ' years' . ' + ' . $months . ' months' . ' + ' . $weeks . ' weeks' . ' + ' . $days . ' days'));
						} else {
							$date = date('l, M d, Y', strtotime($date . ' - ' . $years . ' years' . ' - ' . $months . ' months' . ' - ' . $weeks . ' weeks' . ' - ' . $days . ' days'));
						}
						$des .= $years . ' years' . ' , ' . $months . ' months' . ' , ' . $weeks . ' weeks' . ' , ' . $days . ' days';
						$this->param = [
							'from' => date('l, M d, Y', strtotime($date1)),
							'from_s' => date('M d, Y', strtotime($date1)),
							'add_days' => "active",
							'date' => $date,
							'des' => $des,
						];
						return $this->param;
					} else {
						return ['error' => 'Please Check Your Input'];
						// $this->param['add'] = "active";
						// return false;
					}
				}
			}
		}
	}

	// Sonotube Calculator
	public function sonotube($request)
	{
		$size_unit = trim($request->input('size_unit'));
		$height = trim($request->input('height'));
		$height_unit = trim($request->input('height_unit'));
		$quantity = trim($request->input('quantity'));
		$concerete_mix_unit = trim($request->input('concerete_mix_unit'));
		$density = trim($request->input('density'));
		$density_unit = trim($request->input('density_unit'));
		$concrete_ratio_unit = trim($request->input('concrete_ratio_unit'));
		$bag_size = trim($request->input('bag_size'));
		$bag_size_unit = trim($request->input('bag_size_unit'));
		$waste = trim($request->input('waste'));
		$Cost_bag_mix = trim($request->input('Cost_bag_mix'));
		$Cost_of_cement = trim($request->input('Cost_of_cement'));
		$Cost_of_cement_unit = trim($request->input('Cost_of_cement_unit'));
		$Cost_of_sand = trim($request->input('Cost_of_sand'));
		$Cost_of_sand_unit = trim($request->input('Cost_of_sand_unit'));
		$Cost_of_gravel = trim($request->input('Cost_of_gravel'));
		$Cost_of_gravel_unit = trim($request->input('Cost_of_gravel_unit'));

		// dd($request->input());
		if ($size_unit === "6 (15.24 cm)") {
			$size = 6 / 2;
		} elseif ($size_unit === "8 (20.32 cm)") {
			$size = 8 / 2;
		} elseif ($size_unit === "10 (25.40 cm)") {
			$size = 10 / 2;
		} elseif ($size_unit === "12 (30.48 cm)") {
			$size = 12 / 2;
		} elseif ($size_unit === "14 (35.56 cm)") {
			$size = 14 / 2;
		} elseif ($size_unit === "16 (40.64 cm)") {
			$size = 16 / 2;
		} elseif ($size_unit === "18 (45.72 cm)") {
			$size = 18 / 2;
		} elseif ($size_unit === "20 (50.80 cm)") {
			$size = 20 / 2;
		} elseif ($size_unit === "22 (55.88 cm)") {
			$size = 22 / 2;
		} elseif ($size_unit === "24 (60.96 cm)") {
			$size = 24 / 2;
		} elseif ($size_unit === "26 (66.04 cm)") {
			$size = 26 / 2;
		} elseif ($size_unit === "28 (71.12 cm)") {
			$size = 28 / 2;
		} elseif ($size_unit === "30 (76.20 cm)") {
			$size = 30 / 2;
		} elseif ($size_unit === "32 (81.28 cm)") {
			$size = 32 / 2;
		} elseif ($size_unit === "34 (86.36 cm)") {
			$size = 34 / 2;
		} elseif ($size_unit === "36 (91.44 cm)") {
			$size = 36 / 2;
		} elseif ($size_unit === "40 (101.60 cm)") {
			$size = 40 / 2;
		} elseif ($size_unit === "42 (106.68 cm)") {
			$size = 42 / 2;
		} elseif ($size_unit === "48 (121.91 cm)") {
			$size = 48 / 2;
		} elseif ($size_unit === "54 (137.16 cm)") {
			$size = 54 / 2;
		} elseif ($size_unit === "60 (152.40 cm)") {
			$size = 60 / 2;
		}

		function section_height($height, $height_unit)
		{
			if ($height_unit === "cm") {
				$height = $height * 2.54;
			} elseif ($height_unit === "m") {
				$height = $height / 39.37;
			} elseif ($height_unit === "in") {
				$height = $height;
			} elseif ($height_unit === "ft") {
				$height = $height / 12;
			} elseif ($height_unit === "yd") {
				$height = $height / 36;
			}
			return $height;
		}


		function section_density($density, $density_unit)
		{
			if ($density_unit === "kg/m³") {
				$density = $density * 16.01846;
			} elseif ($density_unit === "lb/cu ft") {
				$density = $density;
			} elseif ($density_unit === "lb/cu yd") {
				$density = $density * 27;
			} elseif ($density_unit === "g/cm³") {
				$density = $density * 0.01601846;
			}
			return $density;
		}

		function section_bag_size($bag_size, $bag_size_unit)
		{
			if ($bag_size_unit === "kg") {
				// No conversion needed as it's already in kg
			} elseif ($bag_size_unit === "lb") {
				$bag_size = $bag_size * 2.205;
			}
			return $bag_size;
		}

		function section_two($Cost_of_cement, $Cost_of_cement_unit)
		{
			if ($Cost_of_cement_unit === "cm³") {
				$Cost_of_cement = $Cost_of_cement * 28320;
			} elseif ($Cost_of_cement_unit === "m³") {
				$Cost_of_cement = $Cost_of_cement / 35.315;
			} elseif ($Cost_of_cement_unit === "cu ft") {
				// No conversion needed as it's already in cu ft
			} elseif ($Cost_of_cement_unit === "cu yd") {
				$Cost_of_cement = $Cost_of_cement / 27;
			}
			return $Cost_of_cement;
		}

		if (is_numeric($height) && is_numeric($quantity)) {
			if ($height == 0) {
				return ['error' => 'height value cannot be equal to zero'];
			}
			if ($quantity == 0) {
				return ['error' => 'quantity value cannot be equal to zero'];
			}
			$height = section_height($height, $height_unit);
			$radus = $size * $size;
			$volume = (round(3.1415 * $radus * $height) / 1728) * $quantity; //ans cub ft unit

			if ($concerete_mix_unit === "I'll get pre-mixed concrete bags") {
				if (is_numeric($density) && is_numeric($bag_size) && is_numeric($waste) && is_numeric($Cost_bag_mix)) {
					if ($density == 0) {
						return ['error' => 'concrete density value cannot be equal to zero'];
					}
					if ($bag_size == 0) {
						return ['error' => 'bag size value cannot be equal to zero'];
					}
					if ($waste == 0) {
						return ['error' => 'waste value cannot be equal to zero'];
					}
					if ($Cost_bag_mix == 0) {
						return ['error' => 'Cost of each bag of pre-mix concrete value cannot be equal to zero'];
					}

					$densityz = section_density($density, $density_unit);
					$weghits = ($volume * $densityz); //ans lbs weghits unit

					$bag_sizez = section_bag_size($bag_size, $bag_size_unit);
					$bagesz = ($bag_sizez * (1 - ($waste / 100)));
					$bagsz = round(($weghits / 2.205) / $bagesz); //ans bages

					$costz_per_unit = $Cost_bag_mix * $bagsz;
					$per_units = round(($costz_per_unit / $volume), 2); //ans cu_ft  units

					$cost_per_colums = $per_units * $volume; //ans RS column 
					$total_costz = $cost_per_colums; //ans RS column 


					$this->param['weghits'] = $weghits;
					$this->param['bagsz'] = $bagsz;
					$this->param['per_units'] = $per_units;
					$this->param['cost_per_colums'] = $cost_per_colums;
					$this->param['total_costz'] = $total_costz;
				} else {
					return ['error' => 'Please! Check Your Input'];
				}
			} else {
				if (is_numeric($waste) && is_numeric($Cost_of_cement) && is_numeric($Cost_of_sand) && is_numeric($Cost_of_gravel)) {
					if ($waste == 0) {
						return ['error' => 'waste value cannot be equal to zero'];
					}
					if ($Cost_of_cement == 0) {
						return ['error' => 'cost of cement per volume value cannot be equal to zero'];
					}
					if ($Cost_of_sand == 0) {
						return ['error' => 'cost of sand per volume value cannot be equal to zero'];
					}
					if ($Cost_of_gravel == 0) {
						return ['error' => 'cost of gravel per volume value cannot be equal to zero'];
					}

					$total_volume = $volume * (1 + ($waste / 100)); //Answer p_2 units

					$value_cement = $total_volume * 1 / (($size * 2)); //Answer p_2 2

					if ($concrete_ratio_unit === "1:5:10 (5.0 MPa or 725 psi)") {
						$ratio_of_sand = 5;
					} elseif ($concrete_ratio_unit === "1:4:8 (7.5 MPa or 1085 psi)") {
						$ratio_of_sand = 4;
					} elseif ($concrete_ratio_unit === "1:3:6 (10.0 MPa or 1450 psi)") {
						$ratio_of_sand = 3;
					} elseif ($concrete_ratio_unit === "1:2:4 (15.0 MPa or 2175 psi)") {
						$ratio_of_sand = 2;
					} elseif ($concrete_ratio_unit === "1:1.5:3 (20.0 MPa or 2900 psi)") {
						$ratio_of_sand = 1.5;
					}
					$value_sand = $total_volume * $ratio_of_sand / (($size * 2)); //Answer p_2 3

					if ($concrete_ratio_unit === "1:5:10 (5.0 MPa or 725 psi)") {
						$ratio_of_gravel = 10;
					} elseif ($concrete_ratio_unit === "1:4:8 (7.5 MPa or 1085 psi)") {
						$ratio_of_gravel = 8;
					} elseif ($concrete_ratio_unit === "1:3:6 (10.0 MPa or 1450 psi)") {
						$ratio_of_gravel = 6;
					} elseif ($concrete_ratio_unit === "1:2:4 (15.0 MPa or 2175 psi)") {
						$ratio_of_gravel = 4;
					} elseif ($concrete_ratio_unit === "1:1.5:3 (20.0 MPa or 2900 psi)") {
						$ratio_of_gravel = 3;
					}
					$value_gravel = $total_volume * $ratio_of_gravel / (($size * 2)); //Answer p_2 4


					$cementzz = section_two($Cost_of_cement, $Cost_of_cement_unit);
					$total_cementzz = $cementzz * $value_cement; //Answer p_2 5

					$sandzz = section_two($Cost_of_sand, $Cost_of_sand_unit);
					$total_sandzz = $sandzz * $value_sand; //Answer p_2 6

					$gravelz = section_two($Cost_of_gravel, $Cost_of_gravel_unit);
					$total_gravelz = $gravelz * $value_gravel;

					$total_costszz = $total_cementzz + $total_sandzz + $total_gravelz; ///ans p -2 last 2

					$this->param['total_volume'] = $total_volume;
					$this->param['value_cement'] = $value_cement;
					$this->param['value_sand'] = $value_sand;
					$this->param['value_gravel'] = $value_gravel;
					$this->param['total_costszz'] = $total_costszz;
				} else {
					return ['error' => 'Please! Check Your Input'];
				}
			}
		} else {
			return ['error' => 'Please! Check Your Input'];
		}
		$this->param['volume'] = $volume;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Retaining Wall Calculator
	public function retaining($request)
	{
		$wall_length             = $request->input('wall_length');
		$wall_length_unit        = $request->input('wall_length_unit');
		$wall_height             = $request->input('wall_height');
		$wall_height_unit        = $request->input('wall_height_unit');
		$block_height            = $request->input('block_height');
		$block_height_unit       = $request->input('block_height_unit');
		$block_length            = $request->input('block_length');
		$block_length_unit       = $request->input('block_length_unit');
		$wall_block_price        = $request->input('wall_block_price');
		$cap_height              = $request->input('cap_height');
		$cap_height_unit         = $request->input('cap_height_unit');
		$cap_length              = $request->input('cap_length');
		$cap_length_unit         = $request->input('cap_length_unit');
		$cap_block_price         = $request->input('cap_block_price');
		$backfill_thickness      = $request->input('backfill_thickness');
		$backfill_thickness_unit = $request->input('backfill_thickness_unit');
		$backfill_length         = $request->input('backfill_length');
		$backfill_length_unit    = $request->input('backfill_length_unit');
		$backfill_height         = $request->input('backfill_height');
		$backfill_height_unit    = $request->input('backfill_height_unit');
		$backfill_price          = $request->input('backfill_price');
		$backfill_price_unit     = $request->input('backfill_price_unit');
		$currancy = $request->input('currancy');
		$backfill_price_unit = str_replace($currancy . ' ', '', $backfill_price_unit);
		function convert_to_meter($unit, $value)
		{
			if ($unit == 'cm') {
				$ans = $value / 100;
			} elseif ($unit == 'm') {
				$ans = $value;
			} elseif ($unit == 'in') {
				$ans = $value / 39.37;
			} elseif ($unit == 'ft') {
				$ans = $value /  3.281;
			} elseif ($unit == 'yd') {
				$ans = $value /  1.094;
			} elseif ($unit == 'dm') {
				$ans = $value / 10;
			}
			return $ans;
		}

		function convert_to_price_unit($unit, $value)
		{
			if ($unit == 'dag') {
				$ans = $value * 100;
			} elseif ($unit == 'lb') {
				$ans = $value *  2.205;
			} elseif ($unit == 'kg') {
				$ans = $value;
			} elseif ($unit == 't') {
				$ans = $value / 1000;
			} elseif ($unit == 'oz') {
				$ans = $value * 35.274;
			} elseif ($unit == 'stone') {
				$ans = $value / 6.35;
			} elseif ($unit == 'Us ton') {
				$ans = $value / 907.2;
			} elseif ($unit == 'Long ton') {
				$ans = $value / 1016;
			}
			return $ans;
		}

		if (
			is_numeric($wall_height) && is_numeric($block_height) && is_numeric($cap_length) && is_numeric($backfill_thickness)
			&& is_numeric($backfill_height) && is_numeric($backfill_length) && is_numeric($backfill_price) && is_numeric($block_length) && is_numeric($cap_block_price) && is_numeric($wall_block_price) && is_numeric($wall_length)
		) {
			$wall_height_m       = convert_to_meter($wall_height_unit, $wall_height);
			$block_height_m      = convert_to_meter($block_height_unit, $block_height);
			$wall_length_m       = convert_to_meter($wall_length_unit, $wall_length);
			$block_length_m      = convert_to_meter($block_length_unit, $block_length);
			$cap_length_m        = convert_to_meter($cap_length_unit, $cap_length);
			$backfill_thickness_m = convert_to_meter($backfill_thickness_unit, $backfill_thickness);
			$backfill_length_m   = convert_to_meter($backfill_length_unit, $backfill_length);
			$backfill_height_m   = convert_to_meter($backfill_height_unit, $backfill_height);
			$block_rows    = ceil($wall_height_m / $block_height_m);
			$block_columns = ceil($wall_length_m / $block_length_m);
			$blocks        = $block_columns * ($block_rows - 1);
			$blocks_price  = $blocks * $wall_block_price;
			$caps   	   = $wall_length_m / $cap_length_m;
			$caps_price    = $caps * $cap_block_price;
			$backfill_volume      = $backfill_thickness_m * $backfill_length_m * $backfill_height_m;
			$backfill_weight      = 1346 * $backfill_volume;
			$backfill_weight_unit = convert_to_price_unit($backfill_price_unit, $backfill_weight);
			$backfill_total_price = $backfill_weight_unit * $backfill_price;
			$total_cost           = $backfill_total_price + $blocks_price + $caps_price;
			$this->param['blocks']               = ceil($blocks);
			$this->param['blocks_price']         = ceil($blocks_price);
			$this->param['caps']                 = ceil($caps);
			$this->param['caps_price']           = ceil($caps_price);
			$this->param['backfill_volume']      = number_format($backfill_volume, 3);
			$this->param['backfill_weight']      = ceil($backfill_weight);
			$this->param['backfill_total_price'] = ceil($backfill_total_price);
			$this->param['total_cost']           = ceil($total_cost);
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// ms plate weight calculator
	public function ms($request)
	{
		$st_type = $request->input('st_type');
		$st_shape = $request->input('st_shape');
		$length = $request->input('length');
		$length_unit = $request->input('length_unit');
		$width = $request->input('width');
		$width_unit = $request->input('width_unit');
		$thickness = $request->input('thickness');
		$thickness_unit = $request->input('thickness_unit');
		$side = $request->input('side');
		$side_unit = $request->input('side_unit');
		$diameter = $request->input('diameter');
		$diameter_unit = $request->input('diameter_unit');
		$area = $request->input('area');
		$area_unit = $request->input('area_unit');
		$quantity = $request->input('quantity');
		// dd($request->input());
		function centi($unit3, $value3)
		{
			if ($unit3 == "mm²") {
				$val3 = $value3 * 0.01;
			} else if ($unit3 == "cm²") {
				$val3 = $value3 * 1;
			} else if ($unit3 == "m²") {
				$val3 = $value3 * 10000;
			} else if ($unit3 == "km²") {
				$val3 = $value3 * 10000000000;
			} else if ($unit3 == "in²") {
				$val3 = $value3 * 6.452;
			} else if ($unit3 == "ft²") {
				$val3 = $value3 * 929;
			} else if ($unit3 == "yd²") {
				$val3 = $value3 * 8361;
			} else if ($unit3 == "mi²") {
				$val3 = $value3 * 25899881103;
			}
			return $val3;
		}
		function convert_to_cmeter($value, $unit)
		{
			if ($unit == "cm") {
				$ans = $value * 1;
			} elseif ($unit == "mm") {
				$ans = $value * 0.1;
			} elseif ($unit == "in") {
				$ans = $value * 2.54;
			} elseif ($unit == "ft") {
				$ans = $value * 30.58;
			} elseif ($unit == "yd") {
				$ans = $value * 91.44;
			} elseif ($unit == "m") {
				$ans = $value * 100;
			}
			return $ans;
		}
		if ($st_shape == "1") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($thickness) && is_numeric($quantity)) {
				if ($length > 0 && $width > 0 && $thickness > 0 && $quantity > 0) {
					$lv = convert_to_cmeter($length, $length_unit);
					$wv = convert_to_cmeter($width, $width_unit);
					$thv = convert_to_cmeter($thickness, $thickness_unit);
					$area = $lv * $wv;
					$volume = $thv * $area;
					$weight = $quantity * $st_type * $volume;
				} else {
					$this->param['error'] = 'Please! Enter Positive Value';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($st_shape == "2") {
			if (is_numeric($thickness) && is_numeric($side) && is_numeric($quantity)) {
				if ($thickness > 0 && $side > 0 && $quantity > 0) {
					$area = convert_to_cmeter($side, $side_unit) * convert_to_cmeter($side, $side_unit);
					// dd($area);
					$thv = convert_to_cmeter($thickness, $thickness_unit);
					$volume = $thv * $area;
					$weight = $quantity * $st_type * $volume;
				} else {
					$this->param['error'] = 'Please! Enter Positive Value';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($st_shape == "3") {
			if (is_numeric($thickness) && is_numeric($diameter) && is_numeric($quantity)) {
				if ($thickness > 0 && $diameter > 0 && $quantity > 0) {
					$dv = convert_to_cmeter($diameter, $diameter_unit);
					$div = ($dv / 2) * ($dv / 2);
					$area = $div * 3.141592653;
					$thv = convert_to_cmeter($thickness, $thickness_unit);
					$volume = $thv * $area;
					$weight = $quantity * $st_type * $volume;
				} else {
					$this->param['error'] = 'Please! Enter Positive Value';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($st_shape == "4") {
			if (is_numeric($area) && is_numeric($thickness) && is_numeric($quantity)) {
				if ($area > 0 && $thickness > 0 && $quantity > 0) {
					$area_value = centi($area_unit, $area);
					$thv = convert_to_cmeter($thickness, $thickness_unit);
					$volume = $thv * $area;
					$weight = $quantity * $st_type * $volume;
				} else {
					$this->param['error'] = 'Please! Enter Positive Value';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['area'] = $area;
		$this->param['volume'] = $volume;
		$this->param['weight'] = $weight;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Nether Portal Calculator
	public function nether($request)
	{
		$submit = trim($request->input('submit'));
		$sim_adv = trim($request->input('sim_adv'));
		$cal = trim($request->input('cal'));
		$x = trim($request->input('x'));
		$y = trim($request->input('y'));
		$z = trim($request->input('z'));
		$x1 = trim($request->input('x1'));
		$y1 = trim($request->input('y1'));
		$z1 = trim($request->input('z1'));
		$x2 = trim($request->input('x2'));
		$y2 = trim($request->input('y2'));
		$z2 = trim($request->input('z2'));
		if ($submit) {
			if ($sim_adv === 'simple') {
				if ($cal === '1') {
					if (!is_numeric($x) && !is_numeric($y) && !is_numeric($z)) {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
					$ox = 0;
					$oy = 0;
					$oz = 0;
					if (is_numeric($x)) {
						$ox = $x;
					}
					if (is_numeric($y)) {
						$oy = $y;
					}
					if (is_numeric($z)) {
						$oz = $z;
					}
					$nx = floor($ox / 8);
					$ny = $oy;
					$nz = floor($oz / 8);
					if ($oy > 123 && $oy < 256) {
						$comment = "To correctly link your portal, it has to be placed on top of the Nether roof! The portal will, however, still work if it isn't on the roof.";
						$this->param['comment'] = $comment;
					}
					$this->param['x'] = $nx;
					$this->param['y'] = $ny;
					$this->param['z'] = $nz;
				} elseif ($cal === '2') {
					if (!is_numeric($x) && !is_numeric($y) && !is_numeric($z)) {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
					$nx = 0;
					$ny = 0;
					$nz = 0;
					if (is_numeric($x)) {
						$nx = $x;
					}
					if (is_numeric($y)) {
						$ny = $y;
					}
					if (is_numeric($z)) {
						$nz = $z;
					}
					$ox = $nx * 8;
					$oy = $ny;
					$oz = $nz * 8;
					if ($ny > 123 && $ny < 256) {
						$comment = "To correctly link your portal, it has to be placed on top of the Nether roof! The portal will, however, still work if it isn't on the roof.";
						$this->param['comment'] = $comment;
					}
					$this->param['x'] = $ox;
					$this->param['y'] = $oy;
					$this->param['z'] = $oz;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
				$this->param['share'] = 'share';
			} else {
				if (is_numeric($x1) && is_numeric($y1) && is_numeric($z1) && is_numeric($x2) && is_numeric($y2) && is_numeric($z2)) {
					$dx = $x2 - $x1;
					$dy = $y2 - $y1;
					$dz = $z2 - $z1;
					$distance = sqrt(pow($dx, 2) + pow($dy, 2) + pow($dz, 2));
					$this->param['distance'] = $distance;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// time calculator
	function time($request)
	{
		if (app()->getLocale() == "en") {
			$submitt = $request->input('sim_adv');
			if ($submitt === 'time_first') {
				$t_days = $request->input('t_days');
				$t_hours = $request->input('t_hours');
				$t_min = $request->input('t_min');
				$t_sec = $request->input('t_sec');
				$t_method = $request->input('t_method');
				$te_days = $request->input('te_days');
				$te_hours = $request->input('te_hours');
				$te_min = $request->input('te_min');
				$te_sec = $request->input('te_sec');
				if (!isset($t_days) && !isset($t_hours) && !isset($t_min) && !isset($t_sec)) {
					$this->param['error'] = 'Please enter any input at time 1';
					return $this->param;
				}
				if (empty($t_days)) {
					$t_days = 0;
				}
				if (empty($t_hours)) {
					$t_hours = 0;
				}
				if (empty($t_min)) {
					$t_min = 0;
				}
				if (empty($t_sec)) {
					$t_sec = 0;
				}
				if (!isset($te_days) && !isset($te_hours) && !isset($te_min) && !isset($te_sec)) {
					$this->param['error'] = 'Please enter any input at time 2';
					return $this->param;
				}
				if (empty($te_days)) {
					$te_days = 0;
				}
				if (empty($te_hours)) {
					$te_hours = 0;
				}
				if (empty($te_min)) {
					$te_min = 0;
				}
				if (empty($te_sec)) {
					$te_sec = 0;
				}
				if ($t_method === 'plus') {
					$seconds = $t_sec + $te_sec;
					$min = $t_min + $te_min;
					$hour = $t_hours + $te_hours;
					$days = $t_days + $te_days;
					while ($seconds >= 60) {
						$min = $min + 1;
						$seconds = $seconds - 60;
					}
					while ($min >= 60) {
						$hour = $hour + 1;
						$min = $min - 60;
					}
					while ($hour >= 24) {
						$days = $days + 1;
						$hour = $hour - 24;
					}
					$method = "+";
				} else {
					if ($t_days > $te_days) {
						if ($te_sec > $t_sec) {
							$t_sec = $t_sec + 60;
							$t_min = $t_min - 1;
						}
						if ($te_min > $t_min) {
							$t_min = $t_min + 60;
							$t_hours = $t_hours - 1;
						}
						if ($te_hours > $t_hours) {
							$t_hours = $t_hours + 24;
							$t_days = $t_days - 1;
						}
					}
					$seconds = $t_sec - $te_sec;
					$min = $t_min - $te_min;
					$hour = $t_hours - $te_hours;
					$days = $t_days - $te_days;
					while ($seconds >= 60) {
						$min = $min + 1;
						$seconds = $seconds - 60;
					}
					while ($min >= 60) {
						$hour = $hour + 1;
						$min = $min - 60;
					}
					while ($hour >= 24) {
						$days = $days + 1;
						$hour = $hour - 24;
					}
					$method = "-";
				}
				$totalDays = $min + ($seconds / 60);
				$totalDays = $hour + ($totalDays / 60);
				$totalDays = $days + ($totalDays / 24);
				$totalHours = ($totalDays * 24);
				$totalMin = $totalDays * 24 * 60;
				$totalSec = $totalDays * 24 * 60 * 60;
				$this->param = [
					'submit' => $submit,
					'submitt' => $submitt,
					't_method' => $method,
					't_sec' => $t_sec,
					't_min' => $t_min,
					't_hours' => $t_hours,
					't_days' => $t_days,
					'te_sec' => $te_sec,
					'te_min' => $te_min,
					'te_hours' => $te_hours,
					'te_days' => $te_days,
					'totalDays' => $totalDays,
					'totalHours' => $totalHours,
					'totalMin' => $totalMin,
					'totalSec' => $totalSec,
					'seconds' => $seconds,
					'min' => $min,
					'hour' => $hour,
					'days' => $days,
				];
				return $this->param;
			} elseif ($submitt === 'time_second') {
				$td_date = $request->input('td_date');
				$t_hours = $request->input('t_hours');
				$t_min = $request->input('t_min');
				$t_sec = $request->input('t_sec');
				$td_method = $request->input('td_method');
				$td_days = $request->input('td_days');
				$td_hours = $request->input('td_hours');
				$td_min = $request->input('td_min');
				$td_sec = $request->input('td_sec');
				$am_pm = $request->input('am_pm');

				if (is_numeric($t_hours) && is_numeric($t_min) && is_numeric($t_sec)) {
					if (!isset($td_days)) {
						$td_days = 0;
					}
					if (!isset($td_hours)) {
						$td_hours = 0;
					}
					if (!isset($td_min)) {
						$td_min = 0;
					}
					if (!isset($td_sec)) {
						$td_sec = 0;
					}
					if (!empty($td_date)) {
						if ($am_pm === "am" || $am_pm === "pm") {
							$time = $ts_hours . ":" . $ts_min . ":" . $ts_sec . " " . $am_pm;
						} else {
							$time = $ts_hours . ":" . $ts_min . ":" . $ts_sec;
						}
						$date = $td_date;
						$addSec = 0;
						$addMin = 0;
						$addHours = 0;
						$addDays = 0;
						$addSec = $td_sec;
						$addMin = $td_min;
						$addHours = $td_hours;
						$addDays = $td_days;
						$dateTime = $date;
						if ($td_method === "plus") {
							$method = "+";
						} else {
							$method = "-";
						}
						$resDate = date('M. d, Y h:i:s A', strtotime("$dateTime $time $method $addDays Days"));
						$resDate = date('M. d, Y h:i:s A', strtotime("$resDate $method $addHours Hours"));
						$resDate = date('M. d, Y h:i:s A', strtotime("$resDate $method $addMin Minutes"));
						$resDate = date('M. d, Y h:i:s A', strtotime("$resDate $method $addSec Seconds"));
						$finalDate = date('F, d, Y', strtotime("$resDate"));
						$resTime = date('h:i:s A', strtotime("$resDate"));
						$resDay = date('l', strtotime("$resDate"));
						if ($am_pm === "24") {
							$resTime = date("H:i:s", strtotime($resTime));
						}
						$this->param = [
							'finalDate' => $finalDate,
							'resTime' => $resTime,
							'resDay' => $resDay,
						];
						return $this->param;
					} else {
						$this->param['error'] = 'Please! Enter Start Date.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please provide a valid start time.';
					return $this->param;
				}
			} else {
				if ($submitt === 'time_third') {
					$submit = $request->input('submit');
					$input = $request->input('input');
					if (!empty($input)) {
						$components = preg_split('/\s*([\+\-\*\/])\s*/', $input, -1, PREG_SPLIT_DELIM_CAPTURE);

						$totalDuration = 0; // Total duration in seconds

						for ($i = 0; $i < count($components); $i++) {
							$part = $components[$i];
							if ($i % 2 === 0) {
								preg_match_all('/(\d+)([dhms])/', $part, $matches);

								$duration = 0;
								for ($j = 0; $j < count($matches[0]); $j++) {
									$value = (int)$matches[1][$j];
									$unit = $matches[2][$j];
									switch ($unit) {
										case 'd':
											$duration += $value * 86400;
											break;
										case 'h':
											$duration += $value * 3600;
											break;
										case 'm':
											$duration += $value * 60;
											break;
										case 's':
											$duration += $value;
											break;
									}
								}
								if ($i === 0 || $components[$i - 1] === '+') {
									$totalDuration += $duration;
								} elseif ($components[$i - 1] === '-') {
									$totalDuration -= $duration;
								} elseif ($components[$i - 1] = '*' || $components[$i - 1] = '/') {
									return ['error' => 'please check your input'];
								}
							}
						}


						// Convert the total duration to days, hours, minutes, and seconds
						$days = floor($totalDuration / 86400);
						$hours = floor(($totalDuration % 86400) / 3600);
						$minutes = floor(($totalDuration % 3600) / 60);
						$seconds = $totalDuration % 60;

						$totleresult = "{$days}d {$hours}h {$minutes}m {$seconds}s";
						$secondsResult = $totalDuration;
						$mintsResult = $totalDuration / 60;
						$hoursResult = $totalDuration / 3600;
						$daysResult = $totalDuration / 86400;
						$this->param = [
							'totleresult' => $totleresult,
							'days' => $days,
							'hours' => $hours,
							'minutes' => $minutes,
							'seconds' => $seconds,
							'secondsResult' => $secondsResult,
							'mintsResult' => $mintsResult,
							'hoursResult' => $hoursResult,
							'daysResult' => $daysResult,
						];
						return $this->param;
					} else {
						return ['error' => 'please check your input'];
					}
				} else {
					return ['error' => 'please check your input'];
				}
			}
		} else {
			$time_type = $request->time_type;
			$t_days = $request->input('t_days');
			$t_hours = $request->input('t_hours');
			$t_min = $request->input('t_min');
			$t_sec = $request->input('t_sec');
			$t_method = $request->input('t_method');
			$te_days = $request->input('te_days');
			$te_hours = $request->input('te_hours');
			$te_min = $request->input('te_min');
			$te_sec = $request->input('te_sec');
			$startTime = request()->input('s_time');
			$endTime = request()->input('e_time');
			$s_date = request()->input('s_date');
			$et_time = request()->input('et_time');

			if ($time_type == '1') {
				if (!isset($t_days) && !isset($t_hours) && !isset($t_min) && !isset($t_sec)) {
					$this->param['error'] = 'Please enter any input at time 1';
					return $this->param;
				}
				if (empty($t_days)) {
					$t_days = 0;
				}
				if (empty($t_hours)) {
					$t_hours = 0;
				}
				if (empty($t_min)) {
					$t_min = 0;
				}
				if (empty($t_sec)) {
					$t_sec = 0;
				}
				if (!isset($te_days) && !isset($te_hours) && !isset($te_min) && !isset($te_sec)) {
					$this->param['error'] = 'Please enter any input at time 2';
					return $this->param;
				}
				if (empty($te_days)) {
					$te_days = 0;
				}
				if (empty($te_hours)) {
					$te_hours = 0;
				}
				if (empty($te_min)) {
					$te_min = 0;
				}
				if (empty($te_sec)) {
					$te_sec = 0;
				}
				if ($t_method === 'plus') {
					$seconds = $t_sec + array_sum((array)$te_sec);
					$min = $t_min + array_sum((array)$te_min);
					$hour = $t_hours + array_sum((array)$te_hours);
					$days = $t_days + array_sum((array)$te_days);

					while ($seconds >= 60) {
						$min = $min + 1;
						$seconds = $seconds - 60;
					}
					while ($min >= 60) {
						$hour = $hour + 1;
						$min = $min - 60;
					}
					while ($hour >= 24) {
						$days = $days + 1;
						$hour = $hour - 24;
					}
					$method = "+";
				} else {
					if ($t_days > $te_days) {
						if ($te_sec > $t_sec) {
							$t_sec = $t_sec + 60;
							$t_min = $t_min - 1;
						}
						if (array_sum($te_min) > $t_min) {
							$t_min = $t_min + 60;
							$t_hours = $t_hours - 1;
						}
						if (array_sum($te_hours) > $t_hours) {
							$t_hours = $t_hours + 24;
							$t_days = $t_days - 1;
						}
					}
					$seconds = $t_sec - array_sum((array)$te_sec);
					$min = $t_min - array_sum((array)$te_min);
					$hour = $t_hours - array_sum((array)$te_hours);
					$days = $t_days - array_sum((array)$te_days);
					while ($seconds >= 60) {
						$min = $min + 1;
						$seconds = $seconds - 60;
					}
					while ($min >= 60) {
						$hour = $hour + 1;
						$min = $min - 60;
					}
					while ($hour >= 24) {
						$days = $days + 1;
						$hour = $hour - 24;
					}
					$method = "-";
				}
				$totalDays = $min + ($seconds / 60);
				$totalDays = $hour + ($totalDays / 60);
				$totalDays = $days + ($totalDays / 24);
				$totalHours = ($totalDays * 24);
				$totalMin = $totalDays * 24 * 60;
				$totalSec = $totalDays * 24 * 60 * 60;
				$this->param = [
					// 'submit' => $submit,
					// 'submitt' => $submitt,
					'te_hours' => $te_hours,
					't_method' => $method,
					't_sec' => $t_sec,
					't_min' => $t_min,
					't_hours' => $t_hours,
					't_days' => $t_days,
					'te_sec' => $te_sec,
					'te_min' => $te_min,
					'te_hours' => $te_hours,
					'te_days' => $te_days,
					'totalDays' => $totalDays,
					'totalHours' => $totalHours,
					'totalMin' => $totalMin,
					'totalSec' => $totalSec,
					'seconds' => $seconds,
					'min' => $min,
					'hour' => $hour,
					'days' => $days,
				];
				// dd($this->param);
				return $this->param;
			} elseif ($time_type == '2') {
				if (!empty($startTime) && !empty($endTime)) {
					$time_parts = explode(":", $startTime);
					$sHours = $time_parts[0];
					$sMin = $time_parts[1];
					$sSec = isset($time_parts[2]) ? $time_parts[2] : '00';
					$sAMPM = date("A", strtotime($startTime));


					$st_time_parts = explode(":", $endTime);
					$fHours = $st_time_parts[0];
					$fMin = $st_time_parts[1];
					$fSec = isset($st_time_parts[2]) ? $st_time_parts[2] : '00';
					$fAMPM = date("A", strtotime($endTime));
					$startTimeString = "$sHours:$sMin:$sSec";
					$endTimeString = "$fHours:$fMin:$fSec";

					$start = Carbon::createFromFormat('H:i:s', $startTimeString);
					$end = Carbon::createFromFormat('H:i:s', $endTimeString);

					$diff = $end->diff($start);
					$hours = $diff->h;
					$minutes = $diff->i;
					$seconds = $diff->s;
					if ($end->lessThan($start)) {
						$end->addDay();
						$diff = $end->diff($start);
						$hours = $diff->h;
						$minutes = $diff->i;
						$seconds = $diff->s;
					}
					$this->param = [
						'hours' => $hours,
						'minutes' => $minutes,
						'seconds' => $seconds
					];
					return $this->param;
				} else {
					$this->param['error'] = 'Please Add Both Time.';
					return $this->param;
				}
			} elseif ($time_type == '3') {
				if (!empty($s_date) && !empty($et_time)) {
					$startDate = Carbon::parse($request->input('s_date'));
					$startTime = Carbon::parse($request->input('et_time'));
					$startDate->setTime($startTime->hour, $startTime->minute, $startTime->second);

					$days = $request->input('st_days');
					$hours = $request->input('st_hours');
					$minutes = $request->input('st_min');
					$seconds = $request->input('st_sec');
					$method = $request->input('td_method', 'plus');
					if (is_numeric($days) && is_numeric($hours) && is_numeric($minutes) && is_numeric($seconds)) {

						if ($method === 'plus') {
							$newDateTime = $startDate->addDays($days)
								->addHours($hours)
								->addMinutes($minutes)
								->addSeconds($seconds);
						} else {
							$newDateTime = $startDate->subDays($days)
								->subHours($hours)
								->subMinutes($minutes)
								->subSeconds($seconds);
						}
						// Format the new date and time as needed
						$formattedDate = $newDateTime->format('Y-m-d');
						$formattedTime = $newDateTime->format('h:i:s A');
						$this->param = [
							'formattedDate' => $formattedDate,
							'formattedTime' => $formattedTime
						];
						return $this->param;
					} else {
						$this->param['error'] = 'Please Fill all the Input Fields.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please Enter Time.';
					return $this->param;
				}
			} else {
				if (!empty($request->input('fs_date')) && !empty($request->input('fe_date'))) {
					$fsDate = Carbon::parse($request->input('fs_date'));
					$fsTime = Carbon::parse($request->input('ft_time'));
					$fsDate->setTime($fsTime->hour, $fsTime->minute, $fsTime->second);

					$feDate = Carbon::parse($request->input('fe_date'));
					$feTime = Carbon::parse($request->input('fe_time'));
					$feDate->setTime($feTime->hour, $feTime->minute, $feTime->second);

					// Calculate the difference between the two Carbon instances
					$difference = $fsDate->diff($feDate);

					// Format the difference as needed
					$days = $difference->days;
					$hours = $difference->h;
					$minutes = $difference->i;
					$seconds = $difference->s;

					// Return the results
					$this->param = [
						'days' => $days,
						'hours' => $hours,
						'minutes' => $minutes,
						'seconds' => $seconds
					];
					// dd($this->param);
					return $this->param;
				} else {
					$this->param['error'] = 'Please Fill all the Fields.';
					return $this->param;
				}
			}
		}
	}

	// square footage calc
	public function square_footage($request)
	{
		$width = $request->input('width');
		$axisa = $request->input('axisa');
		$axisb = $request->input('axisb');
		$inner_length_unit = $request->input('inner_length_unit');
		$axisa_unit = $request->input('axisa_unit');
		$axisb_unit = $request->input('axisb_unit');
		$shape_unit = $request->input('shape_unit');
		$sidealength = $request->input('sidealength');
		$sideblength = $request->input('sideblength');
		$quantity = $request->input('quantity');
		$height = $request->input('height');
		$length = $request->input('length');
		$inner_length = $request->input('inner_length');
		$inner_width = $request->input('inner_width');
		$length_unit = $request->input('length_unit');
		$width_unit = $request->input('width_unit');
		$diameter = $request->input('diameter');
		$diameter_unit = $request->input('diameter_unit');
		$inner_diameter = $request->input('inner_diameter');
		$inner_diameter_unit = $request->input('inner_diameter_unit');
		$inner_width_unit = $request->input('inner_width_unit');
		$border_width = $request->input('border_width');
		$border_width_unit = $request->input('border_width_unit');
		$sidealength_unit = $request->input('sidealength_unit');
		$sideblength_unit = $request->input('sideblength_unit');
		$sideclength_unit = $request->input('sideclength_unit');
		$sideclength = $request->input('sideclength');
		$radius = $request->input('radius');
		$radius_unit = $request->input('radius_unit');
		$angle = $request->input('angle');
		$sides = $request->input('sides');
		$outer_diameter = $request->input('outer_diameter');
		$outer_diameter_unit = $request->input('outer_diameter_unit');
		$height_unit = $request->input('height_unit');
		$base_unit = $request->input('base_unit');
		$base = $request->input('base');
		$room_unit = $request->input('room_unit');
		$price = $request->input('price');
		$price_unit = $request->input('price_unit');
		// dd($inner_width[0]);


		function calculate($a, $b)
		{
			if ($a == "in") {
				$convert1 = $b * 0.0833333;
			} elseif ($a == "ft") {
				$convert1 = $b * 1;
			} elseif ($a == "yd") {
				$convert1 = $b * 3;
			} elseif ($a == "mm") {
				$convert1 = $b * 0.00328084;
			} elseif ($a == "cm") {
				$convert1 = $b * 0.0328084;
			} elseif ($a == "m") {
				$convert1 = $b * 3.28084;
			}
			return $convert1;
		}
		$i = 0;
		$sum = 0;
		if ($room_unit == "1" || $room_unit == "2") {
			while ($i < count($shape_unit)) {
				if ($shape_unit[$i] == "sq") {
					if (is_numeric($sidealength[$i]) && is_numeric($quantity)) {
						$conversion = calculate($sidealength_unit[$i], $sidealength[$i]);
						$area = $conversion * $conversion * $quantity;
					} else {
						// dd('s');
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} else if ($shape_unit[$i] == "rec") {
					if (is_numeric($length[$i]) && is_numeric($width[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($length_unit[$i], $length[$i]);
						$answer2 = calculate($width_unit[$i], $width[$i]);
						$area = $answer1 * $answer2 * $quantity;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "recbor") {
					if (is_numeric($inner_width[$i]) && is_numeric($inner_length[$i]) && is_numeric($border_width[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($inner_length_unit[$i], $length[$i]);
						$answer2 = calculate($inner_width_unit[$i], $inner_width[$i]);
						$answer3 = calculate($border_width_unit[$i], $border_width[$i]);
						$inner_area = $answer1 * $answer2;
						$total_area = ($answer1 + (2 * $answer3)) * (($answer2 + (2 * $answer3)));
						$area = $total_area - $inner_area;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "tra") {
					if (is_numeric($sidealength[$i]) && is_numeric($sideblength[$i]) && is_numeric($height[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($sidealength_unit[$i], $sidealength[$i]);
						$answer2 = calculate($sideblength_unit[$i], $sideblength[$i]);
						$answer3 = calculate($height_unit[$i], $height[$i]);
						$area = (($answer1 + $answer2) / 2) * ($answer3);
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "para") {
					if (is_numeric($base[$i]) && is_numeric($height[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($base_unit[$i], $base[$i]);
						$answer2 = calculate($height_unit[$i], $height[$i]);
						$area = $answer1 * $answer2;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "tri") {
					if (is_numeric($sidealength[$i]) && is_numeric($sideblength[$i]) && is_numeric($sideclength[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($sidealength_unit[$i], $sidealength[$i]);
						$answer2 = calculate($sideblength_unit[$i], $sideblength[$i]);
						$answer3 = calculate($sideclength_unit[$i], $sideclength[$i]);
						$area = (1 / 4) * sqrt(($answer1 + $answer2 + $answer3) * ($answer2 + $answer3 - $answer1) * ($answer3 + $answer1 - $answer2) * ($answer1 + $answer2 - $answer3));
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "cir") {
					if (is_numeric($diameter[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($diameter_unit[$i], $diameter[$i]);
						//Pi x (Diameter/2)^2
						$area = ((3.14 * (($answer1 / 2) * ($answer1 / 2))));
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "ell") {
					if (is_numeric($axisa[$i]) && is_numeric($axisb[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($axisa_unit[$i], $axisa[$i]);
						$answer2 = calculate($axisb_unit[$i], $axisb[$i]);
						$area = (($answer1 * $answer2) * 3.14);
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "sec") {
					if (is_numeric($radius[$i]) && is_numeric($angle[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($radius_unit[$i], $radius[$i]);
						$area = (3.14 * $answer1 * $answer1) * ($angle / 360);
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "hex") {
					if (is_numeric($sidealength[$i]) && is_numeric($quantity)) {
						//(3√3 s2)/2
						$answer1 = calculate($sidealength_unit[$i], $sidealength[$i]);
						$area = ((3 * sqrt(3)) * ($answer1 * $answer1) / 2);
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "oct") {
					if (is_numeric($sidealength[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($sidealength_unit[$i], $sidealength[$i]);
						$area = (2 * ($answer1 * $answer1) * (1 + sqrt(2)));
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "ann") {
					if (is_numeric($inner_diameter[$i]) && is_numeric($outer_diameter[$i]) && is_numeric($quantity)) {
						$an1 = calculate($outer_diameter_unit[$i], $outer_diameter[$i]);
						$an2 = calculate($inner_diameter_unit[$i], $inner_diameter[$i]);
						$outer_area = (3.14 * (($an1 / 2) * ($an1 / 2)));
						$inner_area = (3.14 * (($an2 / 2) * ($an2 / 2)));
						$area = $outer_area - $inner_area;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				} elseif ($shape_unit[$i] == "cirborder") {
					if (is_numeric($border_width[$i]) && is_numeric($inner_diameter[$i]) && is_numeric($quantity)) {
						$answer1 = calculate($inner_diameter_unit[$i], $inner_diameter[$i]);
						$answer2 = calculate($border_width_unit[$i], $border_width[$i]);
						$outer_diameter = $answer1 + (2 * $answer2);
						$outer_area = 3.14 * (($outer_diameter / 2) * ($outer_diameter / 2));
						$inner_area = 3.14 * (($answer1 / 2) * ($answer1 / 2));
						$area = $outer_area - $inner_area;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				}
				$i++;
				$sum = $sum + $area;
			}
			if ($price !== "") {
				if ($price_unit == "ft²") {
					$convert_price = $price * 1;
				} elseif ($price_unit == "yd²") {
					$convert_price = $price * 0.11;
				} elseif ($price_unit == "m²") {
					$convert_price = $price * 0.09;
				}
				$this->param['ans'] = $sum;
				$this->param['sqyards'] = $sum * 0.11111;
				$this->param['sqmeters'] = $sum * 0.092903;
				$this->param['acres'] = $sum * 0.0000229568;
				$this->param['cost'] = $sum * $convert_price;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['ans'] = $sum * $quantity;
				$this->param['sqyards'] = $sum * 0.11111;
				$this->param['sqmeters'] = $sum * 0.092903;
				$this->param['acres'] = $sum * 0.0000229568;
				$this->param['RESULT'] = 1;
				return $this->param;
			}
		}
	}

	// Time Card calculator
	public function time_card($request)
	{
		//    if (isset($_POST['submit'])) {
		$selection1 = $request->input('selection1');
		$selection2 = $request->input('selection2');
		$selection3 = $request->input('selection3');
		// table 1 variables
		$inhour = $request->input('inhour');
		$inmin = $request->input('inmin');
		$inampm = $request->input('inampm');
		$outhour = $request->input('outhour');
		$outmin = $request->input('outmin');
		$outampm = $request->input('outampm');
		$inhourl1 = $request->input('inhourl1');
		$inminl1 = $request->input('inminl1');
		$inampml1 = $request->input('inampml1');
		$outhourl1 = $request->input('outhourl1');
		$outminl1 = $request->input('outminl1');
		$outampml1 = $request->input('outampml1');
		$inhourl2 = $request->input('inhourl2');
		$inminl2 = $request->input('inminl2');
		$inampml2 = $request->input('inampml2');
		$outhourl2 = $request->input('outhourl2');
		$outminl2 = $request->input('outminl2');
		$outampml2 = $request->input('outampml2');

		// table 1 optional

		$in = $request->input('in');
		$out = $request->input('out');
		$inlunch1 = $request->input('inlunch1');
		$outlunch1 = $request->input('outlunch1');
		$inlunch2 = $request->input('inlunch2');
		$outlunch2 = $request->input('outlunch2');

		// table 2 variables
		$t2inhour = $request->input('t2inhour');
		$t2inmin = $request->input('t2inmin');
		$t2inampm = $request->input('t2inampm');
		$t2outhour = $request->input('t2outhour');
		$t2outmin = $request->input('t2outmin');
		$t2outampm = $request->input('t2outampm');
		$t2inhourl1 = $request->input('t2inhourl1');
		$t2inminl1 = $request->input('t2inminl1');
		$t2inampml1 = $request->input('t2inampml1');
		$t2outhourl1 = $request->input('t2outhourl1');
		$t2outminl1 = $request->input('t2outminl1');
		$t2outampml1 = $request->input('t2outampml1');
		$t2inhourl2 = $request->input('t2inhourl2');
		$t2inminl2 = $request->input('t2inminl2');
		$t2inampml2 = $request->input('t2inampml2');
		$t2outhourl2 = $request->input('t2outhourl2');
		$t2outminl2 = $request->input('t2outminl2');
		$t2outampml2 = $request->input('t2outampml2');

		// table 2 optional
		$t2in = $request->input('t2in');
		$t2out = $request->input('t2out');
		$t2inlunch1 = $request->input('t2inlunch1');
		$t2outlunch1 = $request->input('t2outlunch1');
		$t2inlunch2 = $request->input('t2inlunch2');
		$t2outlunch2 = $request->input('t2outlunch2');

		// table 3 variables
		$t3inhour = $request->input('t3inhour');
		$t3inmin = $request->input('t3inmin');
		$t3inampm = $request->input('t3inampm');
		$t3outhour = $request->input('t3outhour');
		$t3outmin = $request->input('t3outmin');
		$t3outampm = $request->input('t3outampm');
		$t3inhourl1 = $request->input('t3inhourl1');
		$t3inminl1 = $request->input('t3inminl1');
		$t3inampml1 = $request->input('t3inampml1');
		$t3outhourl1 = $request->input('t3outhourl1');
		$t3outminl1 = $request->input('t3outminl1');
		$t3outampml1 = $request->input('t3outampml1');
		$t3inhourl2 = $request->input('t3inhourl2');
		$t3inminl2 = $request->input('t3inminl2');
		$t3inampml2 = $request->input('t3inampml2');
		$t3outhourl2 = $request->input('t3outhourl2');
		$t3outminl2 = $request->input('t3outminl2');
		$t3outampml2 = $request->input('t3outampml2');

		// table 3 optional
		$t3in = $request->input('t3in');
		$t3out = $request->input('t3out');
		$t3inlunch1 = $request->input('t3inlunch1');
		$t3outlunch1 = $request->input('t3outlunch1');
		$t3inlunch2 = $request->input('t3inlunch2');
		$t3outlunch2 = $request->input('t3outlunch2');

		// table 4 variables
		$t4inhour = $request->input('t4inhour');
		$t4inmin = $request->input('t4inmin');
		$t4inampm = $request->input('t4inampm');
		$t4outhour = $request->input('t4outhour');
		$t4outmin = $request->input('t4outmin');
		$t4outampm = $request->input('t4outampm');
		$t4inhourl1 = $request->input('t4inhourl1');
		$t4inminl1 = $request->input('t4inminl1');
		$t4inampml1 = $request->input('t4inampml1');
		$t4outhourl1 = $request->input('t4outhourl1');
		$t4outminl1 = $request->input('t4outminl1');
		$t4outampml1 = $request->input('t4outampml1');
		$t4inhourl2 = $request->input('t4inhourl2');
		$t4inminl2 = $request->input('t4inminl2');
		$t4inampml2 = $request->input('t4inampml2');
		$t4outhourl2 = $request->input('t4outhourl2');
		$t4outminl2 = $request->input('t4outminl2');
		$t4outampml2 = $request->input('t4outampml2');

		// table 4 optional
		$t4in = $request->input('t4in');
		$t4out = $request->input('t4out');
		$t4inlunch1 = $request->input('t4inlunch1');
		$t4outlunch1 = $request->input('t4outlunch1');
		$t4inlunch2 = $request->input('t4inlunch2');
		$t4outlunch2 = $request->input('t4outlunch2');

		$lunch = $request->input('lunch');
		$advancedcheck = $request->input('advancedcheck');
		if (isset($advancedcheck)) {
			$advancedcheck = $request->input('advancedcheck');
		} else {
			$advancedcheck = false;
		}
		$paid_lunch1 = $request->input('paid_lunch1');
		$paid_lunch2 = $request->input('paid_lunch2');
		$hour_rate = $request->input('hour_rate');
		$overtime = $request->input('overtime');
		$overtime_pay = $request->input('overtime_pay');
		$table_selection = $request->input('table_selection');
		$sick_h = $request->input('sick_h');
		$sick_m = $request->input('sick_m');
		$v_h = $request->input('v_h');
		$v_m = $request->input('v_m');
		$t2sick_h = $request->input('t2sick_h');
		$t2sick_m = $request->input('t2sick_m');
		$t2v_h = $request->input('t2v_h');
		$t2v_m = $request->input('t2v_m');
		$t3sick_h = $request->input('t3sick_h');
		$t3sick_m = $request->input('t3sick_m');
		$t3v_h = $request->input('t3v_h');
		$t3v_m = $request->input('t3v_m');
		$t4sick_h = $request->input('t4sick_h');
		$t4sick_m = $request->input('t4sick_m');
		$t4v_h = $request->input('t4v_h');
		$t4v_m = $request->input('t4v_m');
		$naam = $request->input('naam');
		$naam2 = $request->input('naam2');
		$naam3 = $request->input('naam3');
		$naam4 = $request->input('naam4');
		$s_date = $request->input('s_date');
		$e_date = $request->input('e_date');
		$s2_date = $request->input('s2_date');
		$e2_date = $request->input('e2_date');
		$s3_date = $request->input('s3_date');
		$e3_date = $request->input('e3_date');
		$s4_date = $request->input('s4_date');
		$e4_date = $request->input('e4_date');

		function timeCal($selection3 = null, $selection1 = null, $inhour = null, $inmin = null, $inampm = null, $outhour = null, $outmin = null, $outampm = null, $in = null, $out = null, $inhourl1 = null, $inminl1 = null, $inampml1 = " ", $outhourl1 = null, $outminl1 = null, $outampml1 = null, $inlunch1 = null, $outlunch1 = null, $inhourl2 = null, $inminl2 = null, $inampml2 = null, $outhourl2 = null, $outminl2 = null, $outampml2 = null, $inlunch2 = null, $outlunch2 = null, $sick_h = null, $sick_m = null, $v_h = null, $v_m = null, $advancedcheck = null, $lunch = null, $paid_lunch1 = null, $paid_lunch2 = null, $hour_rate = null, $overtime = null, $overtime_pay = null)
		{
			$checkHour = true;
			$checkHourl = true;
			$checkHourl2 = true;
			$regular_time = false;
			$overtime2_first = false;
			$overtime3_first = false;
			$overtime4_first = false;
			$overtime5_first = false;
			$overtime6_first = false;
			$a = $b = $c = $d = $sick_pay = $sick_time = $total_pay = $vacation_pay = $v_time = $ans_arrt2 = $ansl1_arrt2 = $ansl21_arrt2 = $ansl2_arrt2 = $overall_timet2 = $regular_timet2 = $overtime2_firstt2 = $overtime3_firstt2 = $sick_payt2 = $t2sick_timet2 = $total_payt2 = $vacation_payt2 = $v_timet2 = $overtime4_firstt2 = $overtime5_firstt2 = $overtime6_firstt2 = $s_pay = $sickpay = $days = $dayst2 = $overtime_work1 = $ans_arrt3 = $ansl1_arrt3 = $ansl21_arrt3 = $ansl2_arrt3 = $overall_timet3 = $regular_timet3 = $overtime2_firstt3 = $overtime3_firstt3 = $sick_payt3 = $t3sick_timet3 = $total_payt3 = $vacation_payt3 = $v_timet3 = $overtime4_firstt3 = $overtime5_firstt3 = $overtime6_firstt3 = $s_pay = $sickpay = $days = $dayst3 = $ans_arrt4 = $ansl1_arrt4 = $ansl21_arrt4 = $ansl2_arrt4 = $overall_timet4 = $regular_timet4 = $overtime2_firstt4 = $overtime3_firstt4 = $sick_payt4 = $t4sick_timet4 = $total_payt4 = $vacation_payt4 = $v_timet4 = $overtime4_firstt4 = $overtime5_firstt4 = $overtime6_firstt4 = $s_pay = $sickpay = $days = $dayst4 = false;
			$ans_arr = [];
			$ansl1_arr = [];
			$ansl2_arr = [];
			$ansl21_arr = [];
			$checkHour = true;
			if ($selection3 == "1") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $inhour[$i];
					$hour1 = $outhour[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$day = 14;
						if ($inampm[$i] == $outampm[$i]) {
							$day = 15;
						}
						$hour = $inhour[$i];
						$min = $inmin[$i];
						$ampm = $inampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$inr1_res = $hour . ":" . $min . " " . $ampm;
						$inr1_time = date("H:i:s", strtotime($inr1_res));
						$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
						$hour = $outhour[$i];
						$min = $outmin[$i];
						$ampm = $outampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$outr1_res = $hour . ":" . $min . " " . $ampm;
						$outr1_time = date("H:i:s", strtotime($outr1_res));
						$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
					}
				}
			} else if ($selection3 == "2") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $in[$i];
					$hour1 = $out[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$ab1 = substr($hour, 2);
						$ab2 = substr($hour1, 2);
						if ($ab1 < 59 && $ab2 < 59) {
							$day = 14;
							if ($hour1 < $hour) {
								$day = 15;
							}
							$inr1_time = date("H:i:s", strtotime($hour));
							$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
							$outr1_time = date("H:i:s", strtotime($hour1));
							$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
						} else {
							return false;
						}
					}
				}
			}
			if ($checkHour == true) {
				for ($i = 0; $i < $selection1; $i++) {
					$rowans1 = $inr1_time->diff($outr1_time);
					$ans_arr5[] = $rowans1->format('%h : %i');
					foreach ($ans_arr5 as $value) {
						list($t1, $t2) = explode(':', $value);
						$t1 = sprintf("%02d", $t1);
						$t2 = sprintf("%02d", $t2);
					}
					$ans_arr[] = $t1 . ":" . $t2;
					$a = $ans_arr;
				}
				if ($lunch == "2") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
					}
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl1_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl1_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl1_arr[] = $t1 . ":" . $t2;
							$b = $ansl1_arr;
						}
					} else {
						return false;
					}
				}
				if ($lunch == "3") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inhourl2[$i];
							$hour1l2 = $outhourl2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl2 = $inhourl2[$i];
								$minl2 = $inminl2[$i];
								$ampml2 = $inampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$inr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
								$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
								$hourl2 = $outhourl2[$i];
								$minl2 = $outminl2[$i];
								$ampml2 = $outampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$outr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
								$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inlunch2[$i];
							$hour1l2 = $outlunch2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$x1y1 = substr($hourl2, 2);
								$x2y2 = substr($hour1l2, 2);
								if ($x1y1 < 59 && $x2y2 < 59) {
									$day = 14;
									if ($hour1l2 < $hourl2) {
										$day = 15;
									}
									$inr1l2_time = date("H:i:s", strtotime($hourl2));
									$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
									$outr1l2_time = date("H:i:s", strtotime($hour1l2));
									$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
								} else {
									return false;
								}
							}
						}
					}
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl21_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl21_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl21_arr[] = $t1 . ":" . $t2;
							$c = $ansl21_arr;
						}
					} else {
						return false;
					}
					if ($checkHourl2 == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							$rowans1l2 = $inr1l2_time->diff($outr1l2_time);
							$ansl2_arr5[] = $rowans1l2->format('%h : %i');
							foreach ($ansl2_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl2_arr[] = $t1 . ":" . $t2;
							$d = $ansl2_arr;
						}
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
			if ($lunch == "1") {
				if ($advancedcheck == true) {
					if (!empty($paid_lunch1) && !empty($paid_lunch2)) {
						$min1 = "00" . ":" . $paid_lunch1;
						$min2 = "00" . ":" . $paid_lunch2;
						function calculate_total_time()
						{
							$i = 0;
							foreach (func_get_args() as $time) {
								sscanf($time, '%d:%d', $hour, $min);
								$i += $hour * 60 + $min;
							}
							if ($h = floor($i / 60)) {
								$i %= 60;
							}
							return sprintf('%02d:%02d', $h, $i);
						}
						$paid_lunch = calculate_total_time($min1, $min2);
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$resultt2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $resultt2;
					} else if (!empty($paid_lunch1)) {
						$paid_lunch = "00" . ":" . $paid_lunch1;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result2;
					} else if (!empty($paid_lunch2)) {
						$paid_lunch = "00" . ":" . $paid_lunch2;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result3[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result3;
					}
				} else {
					$overall_time = $ans_arr;
				}
			}
			if ($lunch == "2") {
				foreach ($a as $key => $val1) {
					$val2 = $b[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$result20[] = date("H:i", strtotime($val11) + $secs);
					$overall_time = $result20;
				}
				if (!empty($paid_lunch1)) {
					$paid_lunch = "00" . ":" . $paid_lunch1;
					foreach ($result20 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result21[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result21;
					}
				}
			}
			if ($lunch == "3") {
				foreach ($a as $key => $val1) {
					$val2 = $c[$key];
					$val3 = $d[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					list($hl13, $ml13) = explode(":", $val3);
					if ($hl13 <= 9) {
						$hl13 = sprintf("%02d", $hl13);
					}
					if ($ml13 <= 9) {
						$ml13 = sprintf("%02d", $ml13);
					}
					$val13 = trim($hl13) . ":" . trim($ml13) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$secs2 = strtotime($val13) - strtotime("00:00:00");
					$result30[] = date("H:i", strtotime($val11) + $secs + $secs2);
					$overall_time = $result30;
				}
				if (!empty($paid_lunch2)) {
					$paid_lunch = "00" . ":" . $paid_lunch2;
					foreach ($result30 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result31[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result31;
					}
				}
			}
			function AddPlayTime($overall_time)
			{
				$minutes = 0;
				foreach ($overall_time as $value) {
					list($hour, $minute) = explode(':', $value);
					$minutes += trim($hour) * 60;
					$minutes += trim($minute);
				}
				$hours = floor($minutes / 60);
				$minutes -= $hours * 60;
				return sprintf('%02d:%02d', $hours, $minutes);
			}
			$table_ans = AddPlayTime($overall_time);
			$overtime3_first = $table_ans;
			if ($overtime == "0") {
				if (!empty($hour_rate)) {
					foreach ($overall_time as $key => $val) {
						$a1 = explode(":", $val);
						$a1_ans[] = $a1[0] . ":" . "00";
						$pay[] = trim($a1[0]) * $hour_rate;
						$pay2[] = $a1[1] / 60 * $hour_rate;
						$pay2_ans[] = "00" . ":" . $a1[1];
						$pay_sum = array_merge($pay, $pay2);
						$paysum = array_sum($pay_sum);
						$overtime3_first = $table_ans;
						$overtime6_first = $paysum;
					}
				}
				$overtime3_first = $table_ans;
			}
			if ($overtime == "1") {
				foreach ($overall_time as $key => $val) {
					list($overtime_h1, $overtime_m1) = explode(":", $val);
					if ($overtime_h1 >= 8) {
						$hour_res = trim($overtime_h1) - 8;
						$overtime_work1[] = $hour_res . ":" . $overtime_m1;
					} else {
						$overtime3_first = $table_ans;
					}
				}
				function calculate_overtime_one($overtime_work1)
				{
					$minutes = 0;
					if ($overtime_work1 != "") {
						foreach ($overtime_work1 as $value) {
							list($hour, $minute) = explode(':', $value);
							$minutes += trim($hour) * 60;
							$minutes += trim($minute);
						}
					}
					$hours = floor($minutes / 60);
					$minutes -= $hours * 60;
					return sprintf('%02d:%02d', $hours, $minutes);
				}
				$Ans1 = calculate_overtime_one($overtime_work1);
				list($Ans1_h, $Ans1_m) = explode(':', $Ans1);
				if ($Ans1_h <= 9) {
					$Ans1_h = sprintf("%02d", $Ans1_h);
				}
				if ($Ans1_m <= 9) {
					$Ans1_m = sprintf("%02d", $Ans1_m);
				}
				$Ans11 = trim($Ans1_h) . ":" . trim($Ans1_m) . ":" . "00";
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				if ($selection1 == "1") {
					$duty_time = 1 * 8;
				} else if ($selection1 == "2") {
					$duty_time = 2 * 8;
				} else if ($selection1 == "3") {
					$duty_time = 3 * 8;
				} else if ($selection1 == "4") {
					$duty_time = 4 * 8;
				} else if ($selection1 == "5") {
					$duty_time = 5 * 8;
				} else if ($selection1 == "6") {
					$duty_time = 6 * 8;
				} else if ($selection1 == "7") {
					$duty_time = 7 * 8;
				}
				$regular_time = $duty_time . ":" . "00";
				if (!empty($hour_rate)) {
					if (!empty($overtime_work1)) {
					}
					$pay_h = trim($duty_time) * $hour_rate;
					$pay_dutytime = $pay_h;
				}
				if (!empty($overtime_pay)) {
					list($overtimepay_h, $overtimepay_m) = explode(":", $Ans1);
					if (!empty($hour_rate)) {
						$overpay_h = trim($overtimepay_h) * trim($hour_rate) * trim($overtime_pay);
						$overpay_m = ($overtimepay_m / 60) * trim($hour_rate) * trim($overtime_pay);
						$overwork_pay = $overpay_h + $overpay_m;
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$total_pay = $overwork_pay + $pay_dutytime;
				}
				$overtime2_first = $Ans1;
				$overtime3_first = $table_ans;
				if (!empty($hour_rate)) {
					$overtime4_first = $pay_dutytime;
				}
				if (!empty($overwork_pay)) {
					$overtime5_first = $overwork_pay;
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$overtime6_first = $total_pay;
				}
			}
			if ($overtime == "2") {
				list($tableans_h, $tableans_m) = explode(":", $table_ans);
				if ($tableans_h >= 40) {
					$hour_res = trim($tableans_h) - 40;
					$overtime_work1 = $hour_res . ":" . $tableans_m;
					$overtime2_first = $overtime_work1;
				} else {
					$overtime3_first = $table_ans;
					$overtime2_first = "00";
				}
				if ($overtime_work1 != "") {
					list($Ans1_h, $Ans1_m) = explode(':', $overtime_work1);
					if ($Ans1_h <= 9) {
						$Ans1_h = sprintf("%02d", $Ans1_h);
					}
					if ($Ans1_m <= 9) {
						$Ans1_m = sprintf("%02d", $Ans1_m);
					}
					$Ans111 = trim($Ans1_h) . ":" . trim($Ans1_m);
				}
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				$tableans1 = trim($tableans_h) . ":" . trim($tableans_m) . ":" . "00";
				if ($overtime_work1 != "") {
					$duty_timet2 = 40;
					$regular_time = $duty_timet2 . ":" . "00";
				}
				if (!empty($hour_rate)) {
					if (!empty($duty_timet2)) {
						$pay_h = trim($duty_timet2) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					if (empty($overtime_work1)) {
						$regular_time = $table_ans;
						list($tableans_h, $tableans_m) = explode(':', $table_ans);
						$pay_h = trim($tableans_h) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					$overtime4_first = $pay_dutytimet1;
				}
				if (!empty($overtime_pay)) {
					if ($overtime_work1 != "") {
						list($overtimepay_h, $overtimepay_m) = explode(":", $overtime_work1);
					}
					if ($hour_rate != "" && $overtime_pay != "") {
						if (!empty($overtimepay_h)) {
							$overpay_h = trim($overtimepay_h) * $hour_rate * $overtime_pay;
							$overpay_m = ($overtimepay_m / 60) * $hour_rate * $overtime_pay;
							$overwork_payt1 = $overpay_h + $overpay_m;
							$overtime5_first = $overwork_payt1;
						}
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay) && !empty($pay_dutytimet1)) {
					if (!empty($overwork_payt1)) {
						$total_pay = $pay_dutytimet1 + $overwork_payt1;
						$overtime6_first = $total_pay;
					}
				}
				$overtime3_first = $table_ans;
			}
			if (!empty($sick_h) || !empty($sick_m)) {
				if ($sick_h <= 9) {
					$sick_h = sprintf("%02d", $sick_h);
				}
				if ($sick_m <= 9) {
					$sick_m = sprintf("%02d", $sick_m);
				}
				list($h, $m) = explode(":", $table_ans);
				$total_m = $sick_m + $m;
				$total_h = $sick_h + $h;
				$t_pay = $total_h . ":" . $total_m;
				$answer1 = trim($sick_h) . ":" . trim($sick_m);
				if (!empty($hour_rate)) {
					if (!empty($answer1)) {
						list($s_h, $s_m) = explode(":", $answer1);
						$sickpay_h = trim($s_h) * $hour_rate;
						$sickpay_m = ($s_m / 60) * $hour_rate;
						$s_pay = $sickpay_h + $sickpay_m;
					}
					$sick_pay = $s_pay;
					list($sick_hour, $sick_min) = explode(":", $t_pay);
					$pay_h = trim($sick_hour) * $hour_rate;
					$pay_m = ($sick_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
					$overtime6_first = $sickpay;
				}
				$sick_time = trim($sick_h) . ":" . trim($sick_m);
				$overtime3_first = $t_pay;
				if ($hour_rate != "") {
					$sick_pay = $s_pay;
					$overtime6_first = $sickpay;
				}
			}
			if (!empty($v_h) || !empty($v_m)) {
				if ($v_h <= 9) {
					$v_h = sprintf("%02d", $v_h);
				}
				if ($v_m <= 9) {
					$v_m = sprintf("%02d", $v_m);
				}
				$answer1 = trim($v_h) . ":" . trim($v_m);
				$secs = strtotime($answer1) - strtotime("00:00:00");
				if (!empty($sick_h) || !empty($sick_m)) {
					if ($sick_h <= 9) {
						$sick_h = sprintf("%02d", $sick_h);
					}
					if ($sick_m <= 9) {
						$sick_m = sprintf("%02d", $sick_m);
					}
					$answer2 = trim($sick_h) . ":" . trim($sick_m);
					$v_hours = date("H:i", strtotime($answer2) + $secs);
					list($hours, $minutes) = explode(":", $v_hours);
					list($h, $m) = explode(":", $table_ans);
					$total_m = $minutes + $m;
					$total_h = $hours + $h;
					$total_sick = $total_h . ":" . $total_m;
					$overtime3_first = $total_sick;
				} else {
					$v_hours = date("H:i", strtotime($table_ans) + $secs);
					$overtime3_first = $v_hours;
				}
				if (!empty($hour_rate)) {
					list($vacation_h, $vacation_m) = explode(":", $answer1);
					$sickpay_h = trim($vacation_h) * $hour_rate;
					$sickpay_m = ($vacation_m / 60) * $hour_rate;
					$v_pay = $sickpay_h + $sickpay_m;
					list($v_hour, $v_min) = explode(":", $total_sick);
					$pay_h = trim($v_hour) * $hour_rate;
					$pay_m = ($v_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
				}
				$v_time = trim($v_h) . ":" . trim($v_m);
				if ($hour_rate != "") {
					$vacation_pay = $v_pay;
					$overtime6_first = $sickpay;
				}
			}
			return array($ans_arr, $ansl1_arr, $ansl21_arr, $ansl2_arr, $overall_time, $regular_time, $overtime2_first, $overtime3_first, $sick_pay, $sick_time, $vacation_pay, $v_time, $overtime4_first, $overtime5_first, $overtime6_first);
		}
		function timeCal2($selection3 = null, $selection1 = null, $inhour = null, $inmin = null, $inampm = null, $outhour = null, $outmin = null, $outampm = null, $in = null, $out = null, $inhourl1 = null, $inminl1 = null, $inampml1 = " ", $outhourl1 = null, $outminl1 = null, $outampml1 = null, $inlunch1 = null, $outlunch1 = null, $inhourl2 = null, $inminl2 = null, $inampml2 = null, $outhourl2 = null, $outminl2 = null, $outampml2 = null, $inlunch2 = null, $outlunch2 = null, $sick_h = null, $sick_m = null, $v_h = null, $v_m = null, $advancedcheck = null, $lunch = null, $paid_lunch1 = null, $paid_lunch2 = null, $hour_rate = null, $overtime = null, $overtime_pay = null)
		{
			$checkHour = true;
			$checkHourl = true;
			$checkHourl2 = true;
			$regular_time = false;
			$overtime2_first = false;
			$overtime3_first = false;
			$overtime4_first = false;
			$overtime5_first = false;
			$overtime6_first = false;
			$a = $b = $c = $d = $sick_pay = $sick_time = $total_pay = $vacation_pay = $v_time = $ans_arrt2 = $ansl1_arrt2 = $ansl21_arrt2 = $ansl2_arrt2 = $overall_timet2 = $regular_timet2 = $overtime2_firstt2 = $overtime3_firstt2 = $sick_payt2 = $t2sick_timet2 = $total_payt2 = $vacation_payt2 = $v_timet2 = $overtime4_firstt2 = $overtime5_firstt2 = $overtime6_firstt2 = $s_pay = $sickpay = $days = $dayst2 = $overtime_work1 = $ans_arrt3 = $ansl1_arrt3 = $ansl21_arrt3 = $ansl2_arrt3 = $overall_timet3 = $regular_timet3 = $overtime2_firstt3 = $overtime3_firstt3 = $sick_payt3 = $t3sick_timet3 = $total_payt3 = $vacation_payt3 = $v_timet3 = $overtime4_firstt3 = $overtime5_firstt3 = $overtime6_firstt3 = $s_pay = $sickpay = $days = $dayst3 = $ans_arrt4 = $ansl1_arrt4 = $ansl21_arrt4 = $ansl2_arrt4 = $overall_timet4 = $regular_timet4 = $overtime2_firstt4 = $overtime3_firstt4 = $sick_payt4 = $t4sick_timet4 = $total_payt4 = $vacation_payt4 = $v_timet4 = $overtime4_firstt4 = $overtime5_firstt4 = $overtime6_firstt4 = $s_pay = $sickpay = $days = $dayst4 = false;
			$ans_arr = [];
			$ansl1_arr = [];
			$ansl2_arr = [];
			$ansl21_arr = [];
			$checkHour = true;
			if ($selection3 == "1") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $inhour[$i];
					$hour1 = $outhour[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$day = 14;
						if ($inampm[$i] == $outampm[$i]) {
							$day = 15;
						}
						$hour = $inhour[$i];
						$min = $inmin[$i];
						$ampm = $inampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$inr1_res = $hour . ":" . $min . " " . $ampm;
						$inr1_time = date("H:i:s", strtotime($inr1_res));
						$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
						$hour = $outhour[$i];
						$min = $outmin[$i];
						$ampm = $outampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$outr1_res = $hour . ":" . $min . " " . $ampm;
						$outr1_time = date("H:i:s", strtotime($outr1_res));
						$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
					}
				}
			} else if ($selection3 == "2") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $in[$i];
					$hour1 = $out[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$ab1 = substr($hour, 2);
						$ab2 = substr($hour1, 2);
						if ($ab1 < 59 && $ab2 < 59) {
							$day = 14;
							if ($hour1 < $hour) {
								$day = 15;
							}
							$inr1_time = date("H:i:s", strtotime($hour));
							$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
							$outr1_time = date("H:i:s", strtotime($hour1));
							$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
						} else {
							return false;
						}
					}
				}
			}
			if ($checkHour == true) {
				for ($i = 0; $i < $selection1; $i++) {
					// $day=14;
					// if ($inampm[$i]==$outampm[$i]) {
					// 	$day=15;
					// }
					// $hour=$inhour[$i];
					// $min=$inmin[$i];
					// $ampm=$inampm[$i];
					// if ($hour<=9) {
					// 	$hour=sprintf("%02d", $hour);
					// }
					// if ($min<=9) {
					// 	$min=sprintf("%02d", $min);
					// }
					// $inr1_res=$hour.":".$min." ".$ampm;
					// $inr1_time = date("H:i:s", strtotime($inr1_res));
					// $inr1_time = new Carbon("2006-04-14 ".$inr1_time);
					// $hour=$outhour[$i];
					// $min=$outmin[$i];
					// $ampm=$outampm[$i];
					// if ($hour<=9) {
					// 	$hour=sprintf("%02d", $hour);
					// }
					// if ($min<=9) {
					// 	$min=sprintf("%02d", $min);
					// }
					// $outr1_res=$hour.":".$min." ".$ampm;
					// $outr1_time = date("H:i:s", strtotime($outr1_res));
					// $outr1_time = new Carbon("2006-04-".$day." ".$outr1_time);
					$rowans1 = $inr1_time->diff($outr1_time);
					$ans_arr5[] = $rowans1->format('%h : %i');
					foreach ($ans_arr5 as $value) {
						list($t1, $t2) = explode(':', $value);
						$t1 = sprintf("%02d", $t1);
						$t2 = sprintf("%02d", $t2);
					}
					$ans_arr[] = $t1 . ":" . $t2;
					$a = $ans_arr;
				}
				if ($lunch == "2") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
					}
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// }
							// $hourl1=$inhourl1[$i];
							// $minl1=$inminl1[$i];
							// $ampml1=$inampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $inr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
							// $inr1l1_time = new Carbon("2006-04-14 ".$inr1l1_time);
							// $hourl1=$outhourl1[$i];
							// $minl1=$outminl1[$i];
							// $ampml1=$outampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $outr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
							// $outr1l1_time = new Carbon("2006-04-".$day." ".$outr1l1_time);
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl1_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl1_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl1_arr[] = $t1 . ":" . $t2;
							$b = $ansl1_arr;
						}
					} else {
						return false;
					}
				}
				if ($lunch == "3") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inhourl2[$i];
							$hour1l2 = $outhourl2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl2 = $inhourl2[$i];
								$minl2 = $inminl2[$i];
								$ampml2 = $inampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$inr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
								$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
								$hourl2 = $outhourl2[$i];
								$minl2 = $outminl2[$i];
								$ampml2 = $outampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$outr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
								$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inlunch2[$i];
							$hour1l2 = $outlunch2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$x1y1 = substr($hourl2, 2);
								$x2y2 = substr($hour1l2, 2);
								if ($x1y1 < 59 && $x2y2 < 59) {
									$day = 14;
									if ($hour1l2 < $hourl2) {
										$day = 15;
									}
									$inr1l2_time = date("H:i:s", strtotime($hourl2));
									$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
									$outr1l2_time = date("H:i:s", strtotime($hour1l2));
									$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
								} else {
									return false;
								}
							}
						}
					}
					// for ($i=0; $i < $selection1 ; $i++) {
					// 	$hourl1=$inhourl1[$i];
					// 	$hour1l1=$outhourl1[$i];
					// 	if (empty($hourl1) || empty($hour1l1)) {
					// 		$checkHourl=false;
					// 	}
					// }
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// }
							// $hourl1=$inhourl1[$i];
							// $minl1=$inminl1[$i];
							// $ampml1=$inampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $inr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
							// $inr1l1_time = new Carbon("2006-04-14 ".$inr1l1_time);
							// $hourl1=$outhourl1[$i];
							// $minl1=$outminl1[$i];
							// $ampml1=$outampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $outr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
							// $outr1l1_time = new Carbon("2006-04-".$day." ".$outr1l1_time);
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl21_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl21_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl21_arr[] = $t1 . ":" . $t2;
							$c = $ansl21_arr;
						}
					} else {
						return false;
					}
					// for ($i=0; $i < $selection1 ; $i++) {
					// 	$hourl2=$inhourl2[$i];
					// 	$hour1l2=$outhourl2[$i];
					// 	if (empty($hourl2) || empty($hour1l2)) {
					// 		$checkHourl2=false;
					// 	}
					// }
					if ($checkHourl2 == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// } 
							// $hourl2=$inhourl2[$i];
							// $minl2=$inminl2[$i];
							// $ampml2=$inampml2[$i];
							// if ($hourl2<=9) {
							// 	$hourl2=sprintf("%02d", $hourl2);
							// }
							// if ($minl2<=9) {
							// 	$minl2=sprintf("%02d", $minl2);
							// }
							// $inr1l2_res=$hourl2.":".$minl2." ".$ampml2;
							// $inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
							// $inr1l2_time = new Carbon("2006-04-14 ".$inr1l2_time);
							// $hourl2=$outhourl2[$i];
							// $minl2=$outminl2[$i];
							// $ampml2=$outampml2[$i];
							// if ($hourl2<=9) {
							// 	$hourl2=sprintf("%02d", $hourl2);
							// }
							// if ($minl2<=9) {
							// 	$minl2=sprintf("%02d", $minl2);
							// }
							// $outr1l2_res=$hourl2.":".$minl2." ".$ampml2;
							// $outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
							// $outr1l2_time = new Carbon("2006-04-".$day." ".$outr1l2_time);
							$rowans1l2 = $inr1l2_time->diff($outr1l2_time);
							$ansl2_arr5[] = $rowans1l2->format('%h : %i');
							foreach ($ansl2_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl2_arr[] = $t1 . ":" . $t2;
							$d = $ansl2_arr;
						}
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
			if ($lunch == "1") {
				if ($advancedcheck == true) {
					if (!empty($paid_lunch1) && !empty($paid_lunch2)) {
						$min1 = "00" . ":" . $paid_lunch1;
						$min2 = "00" . ":" . $paid_lunch2;
						function calculate_total_time2()
						{
							$i = 0;
							foreach (func_get_args() as $time) {
								sscanf($time, '%d:%d', $hour, $min);
								$i += $hour * 60 + $min;
							}
							if ($h = floor($i / 60)) {
								$i %= 60;
							}
							return sprintf('%02d:%02d', $h, $i);
						}
						$paid_lunch = calculate_total_time2($min1, $min2);
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$resultt2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $resultt2;
					} else if (!empty($paid_lunch1)) {
						$paid_lunch = "00" . ":" . $paid_lunch1;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result2;
					} else if (!empty($paid_lunch2)) {
						$paid_lunch = "00" . ":" . $paid_lunch2;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result3[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result3;
					}
				} else {
					$overall_time = $ans_arr;
				}
			}
			if ($lunch == "2") {
				foreach ($a as $key => $val1) {
					$val2 = $b[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$result20[] = date("H:i", strtotime($val11) + $secs);
					$overall_time = $result20;
				}
				if (!empty($paid_lunch1)) {
					$paid_lunch = "00" . ":" . $paid_lunch1;
					foreach ($result20 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result21[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result21;
					}
				}
			}
			if ($lunch == "3") {
				foreach ($a as $key => $val1) {
					$val2 = $c[$key];
					$val3 = $d[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					list($hl13, $ml13) = explode(":", $val3);
					if ($hl13 <= 9) {
						$hl13 = sprintf("%02d", $hl13);
					}
					if ($ml13 <= 9) {
						$ml13 = sprintf("%02d", $ml13);
					}
					$val13 = trim($hl13) . ":" . trim($ml13) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$secs2 = strtotime($val13) - strtotime("00:00:00");
					$result30[] = date("H:i", strtotime($val11) + $secs + $secs2);
					$overall_time = $result30;
				}
				if (!empty($paid_lunch2)) {
					$paid_lunch = "00" . ":" . $paid_lunch2;
					foreach ($result30 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result31[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result31;
					}
				}
			}
			function AddPlayTime2($overall_time)
			{
				$minutes = 0;
				foreach ($overall_time as $value) {
					list($hour, $minute) = explode(':', $value);
					$minutes += trim($hour) * 60;
					$minutes += trim($minute);
				}
				$hours = floor($minutes / 60);
				$minutes -= $hours * 60;
				return sprintf('%02d:%02d', $hours, $minutes);
			}
			$table_ans = AddPlayTime2($overall_time);
			$overtime3_first = $table_ans;
			if ($overtime == "0") {
				if (!empty($hour_rate)) {
					foreach ($overall_time as $key => $val) {
						$a1 = explode(":", $val);
						$a1_ans[] = $a1[0] . ":" . "00";
						$pay[] = trim($a1[0]) * $hour_rate;
						$pay2[] = $a1[1] / 60 * $hour_rate;
						$pay2_ans[] = "00" . ":" . $a1[1];
						$pay_sum = array_merge($pay, $pay2);
						$paysum = array_sum($pay_sum);
						$overtime3_first = $table_ans;
						$overtime6_first = $paysum;
					}
				}
				$overtime3_first = $table_ans;
			}
			if ($overtime == "1") {
				foreach ($overall_time as $key => $val) {
					list($overtime_h1, $overtime_m1) = explode(":", $val);
					if ($overtime_h1 >= 8) {
						$hour_res = trim($overtime_h1) - 8;
						$overtime_work1[] = $hour_res . ":" . $overtime_m1;
					} else {
						$overtime3_first = $table_ans;
					}
				}
				function calculate_overtime_one2($overtime_work1)
				{
					$minutes = 0;
					if ($overtime_work1 != "") {
						foreach ($overtime_work1 as $value) {
							list($hour, $minute) = explode(':', $value);
							$minutes += trim($hour) * 60;
							$minutes += trim($minute);
						}
					}
					$hours = floor($minutes / 60);
					$minutes -= $hours * 60;
					return sprintf('%02d:%02d', $hours, $minutes);
				}
				$Ans1 = calculate_overtime_one2($overtime_work1);
				list($Ans1_h, $Ans1_m) = explode(':', $Ans1);
				if ($Ans1_h <= 9) {
					$Ans1_h = sprintf("%02d", $Ans1_h);
				}
				if ($Ans1_m <= 9) {
					$Ans1_m = sprintf("%02d", $Ans1_m);
				}
				$Ans11 = trim($Ans1_h) . ":" . trim($Ans1_m) . ":" . "00";
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				if ($selection1 == "1") {
					$duty_time = 1 * 8;
				} else if ($selection1 == "2") {
					$duty_time = 2 * 8;
				} else if ($selection1 == "3") {
					$duty_time = 3 * 8;
				} else if ($selection1 == "4") {
					$duty_time = 4 * 8;
				} else if ($selection1 == "5") {
					$duty_time = 5 * 8;
				} else if ($selection1 == "6") {
					$duty_time = 6 * 8;
				} else if ($selection1 == "7") {
					$duty_time = 7 * 8;
				}
				$regular_time = $duty_time . ":" . "00";
				if (!empty($hour_rate)) {
					if (!empty($overtime_work1)) {
					}
					$pay_h = trim($duty_time) * $hour_rate;
					$pay_dutytime = $pay_h;
				}
				if (!empty($overtime_pay)) {
					list($overtimepay_h, $overtimepay_m) = explode(":", $Ans1);
					if (!empty($hour_rate)) {
						$overpay_h = trim($overtimepay_h) * trim($hour_rate) * trim($overtime_pay);
						$overpay_m = ($overtimepay_m / 60) * trim($hour_rate) * trim($overtime_pay);
						$overwork_pay = $overpay_h + $overpay_m;
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$total_pay = $overwork_pay + $pay_dutytime;
				}
				$overtime2_first = $Ans1;
				$overtime3_first = $table_ans;
				if (!empty($hour_rate)) {
					$overtime4_first = $pay_dutytime;
				}
				if (!empty($overwork_pay)) {
					$overtime5_first = $overwork_pay;
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$overtime6_first = $total_pay;
				}
			}
			if ($overtime == "2") {
				list($tableans_h, $tableans_m) = explode(":", $table_ans);
				if ($tableans_h >= 40) {
					$hour_res = trim($tableans_h) - 40;
					$overtime_work1 = $hour_res . ":" . $tableans_m;
					$overtime2_first = $overtime_work1;
				} else {
					$overtime3_first = $table_ans;
					$overtime2_first = "00";
				}
				if ($overtime_work1 != "") {
					list($Ans1_h, $Ans1_m) = explode(':', $overtime_work1);
					if ($Ans1_h <= 9) {
						$Ans1_h = sprintf("%02d", $Ans1_h);
					}
					if ($Ans1_m <= 9) {
						$Ans1_m = sprintf("%02d", $Ans1_m);
					}
					$Ans111 = trim($Ans1_h) . ":" . trim($Ans1_m);
				}
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				$tableans1 = trim($tableans_h) . ":" . trim($tableans_m) . ":" . "00";
				if ($overtime_work1 != "") {
					$duty_timet2 = 40;
					$regular_time = $duty_timet2 . ":" . "00";
				}
				if (!empty($hour_rate)) {
					if (!empty($duty_timet2)) {
						$pay_h = trim($duty_timet2) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					if (empty($overtime_work1)) {
						$regular_time = $table_ans;
						list($tableans_h, $tableans_m) = explode(':', $table_ans);
						$pay_h = trim($tableans_h) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					$overtime4_first = $pay_dutytimet1;
				}
				if (!empty($overtime_pay)) {
					if ($overtime_work1 != "") {
						list($overtimepay_h, $overtimepay_m) = explode(":", $overtime_work1);
					}
					if ($hour_rate != "" && $overtime_pay != "") {
						if (!empty($overtimepay_h)) {
							$overpay_h = trim($overtimepay_h) * $hour_rate * $overtime_pay;
							$overpay_m = ($overtimepay_m / 60) * $hour_rate * $overtime_pay;
							$overwork_payt1 = $overpay_h + $overpay_m;
							$overtime5_first = $overwork_payt1;
						}
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay) && !empty($pay_dutytimet1)) {
					if (!empty($overwork_payt1)) {
						$total_pay = $pay_dutytimet1 + $overwork_payt1;
						$overtime6_first = $total_pay;
					}
				}
				$overtime3_first = $table_ans;
			}
			if (!empty($sick_h) || !empty($sick_m)) {
				if ($sick_h <= 9) {
					$sick_h = sprintf("%02d", $sick_h);
				}
				if ($sick_m <= 9) {
					$sick_m = sprintf("%02d", $sick_m);
				}
				list($h, $m) = explode(":", $table_ans);
				$total_m = $sick_m + $m;
				$total_h = $sick_h + $h;
				$t_pay = $total_h . ":" . $total_m;
				$answer1 = trim($sick_h) . ":" . trim($sick_m);
				if (!empty($hour_rate)) {
					if (!empty($answer1)) {
						list($s_h, $s_m) = explode(":", $answer1);
						$sickpay_h = trim($s_h) * $hour_rate;
						$sickpay_m = ($s_m / 60) * $hour_rate;
						$s_pay = $sickpay_h + $sickpay_m;
					}
					$sick_pay = $s_pay;
					list($sick_hour, $sick_min) = explode(":", $t_pay);
					$pay_h = trim($sick_hour) * $hour_rate;
					$pay_m = ($sick_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
					$overtime6_first = $sickpay;
				}
				$sick_time = trim($sick_h) . ":" . trim($sick_m);
				$overtime3_first = $t_pay;
				if ($hour_rate != "") {
					$sick_pay = $s_pay;
					$overtime6_first = $sickpay;
				}
			}
			if (!empty($v_h) || !empty($v_m)) {
				if ($v_h <= 9) {
					$v_h = sprintf("%02d", $v_h);
				}
				if ($v_m <= 9) {
					$v_m = sprintf("%02d", $v_m);
				}
				$answer1 = trim($v_h) . ":" . trim($v_m);
				$secs = strtotime($answer1) - strtotime("00:00:00");
				if (!empty($sick_h) || !empty($sick_m)) {
					if ($sick_h <= 9) {
						$sick_h = sprintf("%02d", $sick_h);
					}
					if ($sick_m <= 9) {
						$sick_m = sprintf("%02d", $sick_m);
					}
					$answer2 = trim($sick_h) . ":" . trim($sick_m);
					$v_hours = date("H:i", strtotime($answer2) + $secs);
					list($hours, $minutes) = explode(":", $v_hours);
					list($h, $m) = explode(":", $table_ans);
					$total_m = $minutes + $m;
					$total_h = $hours + $h;
					$total_sick = $total_h . ":" . $total_m;
					$overtime3_first = $total_sick;
				} else {
					$v_hours = date("H:i", strtotime($table_ans) + $secs);
					$overtime3_first = $v_hours;
				}
				if (!empty($hour_rate)) {
					list($vacation_h, $vacation_m) = explode(":", $answer1);
					$sickpay_h = trim($vacation_h) * $hour_rate;
					$sickpay_m = ($vacation_m / 60) * $hour_rate;
					$v_pay = $sickpay_h + $sickpay_m;
					list($v_hour, $v_min) = explode(":", $total_sick);
					$pay_h = trim($v_hour) * $hour_rate;
					$pay_m = ($v_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
				}
				$v_time = trim($v_h) . ":" . trim($v_m);
				if ($hour_rate != "") {
					$vacation_pay = $v_pay;
					$overtime6_first = $sickpay;
				}
			}
			return array($ans_arr, $ansl1_arr, $ansl21_arr, $ansl2_arr, $overall_time, $regular_time, $overtime2_first, $overtime3_first, $sick_pay, $sick_time, $vacation_pay, $v_time, $overtime4_first, $overtime5_first, $overtime6_first);
		}
		function timeCal3($selection3 = null, $selection1 = null, $inhour = null, $inmin = null, $inampm = null, $outhour = null, $outmin = null, $outampm = null, $in = null, $out = null, $inhourl1 = null, $inminl1 = null, $inampml1 = " ", $outhourl1 = null, $outminl1 = null, $outampml1 = null, $inlunch1 = null, $outlunch1 = null, $inhourl2 = null, $inminl2 = null, $inampml2 = null, $outhourl2 = null, $outminl2 = null, $outampml2 = null, $inlunch2 = null, $outlunch2 = null, $sick_h = null, $sick_m = null, $v_h = null, $v_m = null, $advancedcheck = null, $lunch = null, $paid_lunch1 = null, $paid_lunch2 = null, $hour_rate = null, $overtime = null, $overtime_pay = null)
		{
			$checkHour = true;
			$checkHourl = true;
			$checkHourl2 = true;
			$regular_time = false;
			$overtime2_first = false;
			$overtime3_first = false;
			$overtime4_first = false;
			$overtime5_first = false;
			$overtime6_first = false;
			$a = $b = $c = $d = $sick_pay = $sick_time = $total_pay = $vacation_pay = $v_time = $ans_arrt2 = $ansl1_arrt2 = $ansl21_arrt2 = $ansl2_arrt2 = $overall_timet2 = $regular_timet2 = $overtime2_firstt2 = $overtime3_firstt2 = $sick_payt2 = $t2sick_timet2 = $total_payt2 = $vacation_payt2 = $v_timet2 = $overtime4_firstt2 = $overtime5_firstt2 = $overtime6_firstt2 = $s_pay = $sickpay = $days = $dayst2 = $overtime_work1 = $ans_arrt3 = $ansl1_arrt3 = $ansl21_arrt3 = $ansl2_arrt3 = $overall_timet3 = $regular_timet3 = $overtime2_firstt3 = $overtime3_firstt3 = $sick_payt3 = $t3sick_timet3 = $total_payt3 = $vacation_payt3 = $v_timet3 = $overtime4_firstt3 = $overtime5_firstt3 = $overtime6_firstt3 = $s_pay = $sickpay = $days = $dayst3 = $ans_arrt4 = $ansl1_arrt4 = $ansl21_arrt4 = $ansl2_arrt4 = $overall_timet4 = $regular_timet4 = $overtime2_firstt4 = $overtime3_firstt4 = $sick_payt4 = $t4sick_timet4 = $total_payt4 = $vacation_payt4 = $v_timet4 = $overtime4_firstt4 = $overtime5_firstt4 = $overtime6_firstt4 = $s_pay = $sickpay = $days = $dayst4 = false;
			$ans_arr = [];
			$ansl1_arr = [];
			$ansl2_arr = [];
			$ansl21_arr = [];
			$checkHour = true;
			if ($selection3 == "1") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $inhour[$i];
					$hour1 = $outhour[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$day = 14;
						if ($inampm[$i] == $outampm[$i]) {
							$day = 15;
						}
						$hour = $inhour[$i];
						$min = $inmin[$i];
						$ampm = $inampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$inr1_res = $hour . ":" . $min . " " . $ampm;
						$inr1_time = date("H:i:s", strtotime($inr1_res));
						$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
						$hour = $outhour[$i];
						$min = $outmin[$i];
						$ampm = $outampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$outr1_res = $hour . ":" . $min . " " . $ampm;
						$outr1_time = date("H:i:s", strtotime($outr1_res));
						$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
					}
				}
			} else if ($selection3 == "2") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $in[$i];
					$hour1 = $out[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$ab1 = substr($hour, 2);
						$ab2 = substr($hour1, 2);
						if ($ab1 < 59 && $ab2 < 59) {
							$day = 14;
							if ($hour1 < $hour) {
								$day = 15;
							}
							$inr1_time = date("H:i:s", strtotime($hour));
							$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
							$outr1_time = date("H:i:s", strtotime($hour1));
							$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
						} else {
							return false;
						}
					}
				}
			}
			if ($checkHour == true) {
				for ($i = 0; $i < $selection1; $i++) {
					// $day=14;
					// if ($inampm[$i]==$outampm[$i]) {
					// 	$day=15;
					// }
					// $hour=$inhour[$i];
					// $min=$inmin[$i];
					// $ampm=$inampm[$i];
					// if ($hour<=9) {
					// 	$hour=sprintf("%02d", $hour);
					// }
					// if ($min<=9) {
					// 	$min=sprintf("%02d", $min);
					// }
					// $inr1_res=$hour.":".$min." ".$ampm;
					// $inr1_time = date("H:i:s", strtotime($inr1_res));
					// $inr1_time = new Carbon("2006-04-14 ".$inr1_time);
					// $hour=$outhour[$i];
					// $min=$outmin[$i];
					// $ampm=$outampm[$i];
					// if ($hour<=9) {
					// 	$hour=sprintf("%02d", $hour);
					// }
					// if ($min<=9) {
					// 	$min=sprintf("%02d", $min);
					// }
					// $outr1_res=$hour.":".$min." ".$ampm;
					// $outr1_time = date("H:i:s", strtotime($outr1_res));
					// $outr1_time = new Carbon("2006-04-".$day." ".$outr1_time);
					$rowans1 = $inr1_time->diff($outr1_time);
					$ans_arr5[] = $rowans1->format('%h : %i');
					foreach ($ans_arr5 as $value) {
						list($t1, $t2) = explode(':', $value);
						$t1 = sprintf("%02d", $t1);
						$t2 = sprintf("%02d", $t2);
					}
					$ans_arr[] = $t1 . ":" . $t2;
					$a = $ans_arr;
				}
				if ($lunch == "2") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
					}
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// }
							// $hourl1=$inhourl1[$i];
							// $minl1=$inminl1[$i];
							// $ampml1=$inampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $inr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
							// $inr1l1_time = new Carbon("2006-04-14 ".$inr1l1_time);
							// $hourl1=$outhourl1[$i];
							// $minl1=$outminl1[$i];
							// $ampml1=$outampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $outr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
							// $outr1l1_time = new Carbon("2006-04-".$day." ".$outr1l1_time);
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl1_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl1_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl1_arr[] = $t1 . ":" . $t2;
							$b = $ansl1_arr;
						}
					} else {
						return false;
					}
				}
				if ($lunch == "3") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inhourl2[$i];
							$hour1l2 = $outhourl2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl2 = $inhourl2[$i];
								$minl2 = $inminl2[$i];
								$ampml2 = $inampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$inr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
								$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
								$hourl2 = $outhourl2[$i];
								$minl2 = $outminl2[$i];
								$ampml2 = $outampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$outr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
								$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inlunch2[$i];
							$hour1l2 = $outlunch2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$x1y1 = substr($hourl2, 2);
								$x2y2 = substr($hour1l2, 2);
								if ($x1y1 < 59 && $x2y2 < 59) {
									$day = 14;
									if ($hour1l2 < $hourl2) {
										$day = 15;
									}
									$inr1l2_time = date("H:i:s", strtotime($hourl2));
									$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
									$outr1l2_time = date("H:i:s", strtotime($hour1l2));
									$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
								} else {
									return false;
								}
							}
						}
					}













					// for ($i=0; $i < $selection1 ; $i++) {
					// 	$hourl1=$inhourl1[$i];
					// 	$hour1l1=$outhourl1[$i];
					// 	if (empty($hourl1) || empty($hour1l1)) {
					// 		$checkHourl=false;
					// 	}
					// }
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// }
							// $hourl1=$inhourl1[$i];
							// $minl1=$inminl1[$i];
							// $ampml1=$inampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $inr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
							// $inr1l1_time = new Carbon("2006-04-14 ".$inr1l1_time);
							// $hourl1=$outhourl1[$i];
							// $minl1=$outminl1[$i];
							// $ampml1=$outampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $outr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
							// $outr1l1_time = new Carbon("2006-04-".$day." ".$outr1l1_time);
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl21_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl21_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl21_arr[] = $t1 . ":" . $t2;
							$c = $ansl21_arr;
						}
					} else {
						return false;
					}
					// for ($i=0; $i < $selection1 ; $i++) {
					// 	$hourl2=$inhourl2[$i];
					// 	$hour1l2=$outhourl2[$i];
					// 	if (empty($hourl2) || empty($hour1l2)) {
					// 		$checkHourl2=false;
					// 	}
					// }
					if ($checkHourl2 == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// } 
							// $hourl2=$inhourl2[$i];
							// $minl2=$inminl2[$i];
							// $ampml2=$inampml2[$i];
							// if ($hourl2<=9) {
							// 	$hourl2=sprintf("%02d", $hourl2);
							// }
							// if ($minl2<=9) {
							// 	$minl2=sprintf("%02d", $minl2);
							// }
							// $inr1l2_res=$hourl2.":".$minl2." ".$ampml2;
							// $inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
							// $inr1l2_time = new Carbon("2006-04-14 ".$inr1l2_time);
							// $hourl2=$outhourl2[$i];
							// $minl2=$outminl2[$i];
							// $ampml2=$outampml2[$i];
							// if ($hourl2<=9) {
							// 	$hourl2=sprintf("%02d", $hourl2);
							// }
							// if ($minl2<=9) {
							// 	$minl2=sprintf("%02d", $minl2);
							// }
							// $outr1l2_res=$hourl2.":".$minl2." ".$ampml2;
							// $outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
							// $outr1l2_time = new Carbon("2006-04-".$day." ".$outr1l2_time);
							$rowans1l2 = $inr1l2_time->diff($outr1l2_time);
							$ansl2_arr5[] = $rowans1l2->format('%h : %i');
							foreach ($ansl2_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl2_arr[] = $t1 . ":" . $t2;
							$d = $ansl2_arr;
						}
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
			if ($lunch == "1") {
				if ($advancedcheck == true) {
					if (!empty($paid_lunch1) && !empty($paid_lunch2)) {
						$min1 = "00" . ":" . $paid_lunch1;
						$min2 = "00" . ":" . $paid_lunch2;
						function calculate_total_time3()
						{
							$i = 0;
							foreach (func_get_args() as $time) {
								sscanf($time, '%d:%d', $hour, $min);
								$i += $hour * 60 + $min;
							}
							if ($h = floor($i / 60)) {
								$i %= 60;
							}
							return sprintf('%02d:%02d', $h, $i);
						}
						$paid_lunch = calculate_total_time3($min1, $min2);
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$resultt2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $resultt2;
					} else if (!empty($paid_lunch1)) {
						$paid_lunch = "00" . ":" . $paid_lunch1;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result2;
					} else if (!empty($paid_lunch2)) {
						$paid_lunch = "00" . ":" . $paid_lunch2;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result3[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result3;
					}
				} else {
					$overall_time = $ans_arr;
				}
			}
			if ($lunch == "2") {
				foreach ($a as $key => $val1) {
					$val2 = $b[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$result20[] = date("H:i", strtotime($val11) + $secs);
					$overall_time = $result20;
				}
				if (!empty($paid_lunch1)) {
					$paid_lunch = "00" . ":" . $paid_lunch1;
					foreach ($result20 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result21[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result21;
					}
				}
			}
			if ($lunch == "3") {
				foreach ($a as $key => $val1) {
					$val2 = $c[$key];
					$val3 = $d[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					list($hl13, $ml13) = explode(":", $val3);
					if ($hl13 <= 9) {
						$hl13 = sprintf("%02d", $hl13);
					}
					if ($ml13 <= 9) {
						$ml13 = sprintf("%02d", $ml13);
					}
					$val13 = trim($hl13) . ":" . trim($ml13) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$secs2 = strtotime($val13) - strtotime("00:00:00");
					$result30[] = date("H:i", strtotime($val11) + $secs + $secs2);
					$overall_time = $result30;
				}
				if (!empty($paid_lunch2)) {
					$paid_lunch = "00" . ":" . $paid_lunch2;
					foreach ($result30 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result31[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result31;
					}
				}
			}
			function AddPlayTime3($overall_time)
			{
				$minutes = 0;
				foreach ($overall_time as $value) {
					list($hour, $minute) = explode(':', $value);
					$minutes += trim($hour) * 60;
					$minutes += trim($minute);
				}
				$hours = floor($minutes / 60);
				$minutes -= $hours * 60;
				return sprintf('%02d:%02d', $hours, $minutes);
			}
			$table_ans = AddPlayTime3($overall_time);
			$overtime3_first = $table_ans;
			if ($overtime == "0") {
				if (!empty($hour_rate)) {
					foreach ($overall_time as $key => $val) {
						$a1 = explode(":", $val);
						$a1_ans[] = $a1[0] . ":" . "00";
						$pay[] = trim($a1[0]) * $hour_rate;
						$pay2[] = $a1[1] / 60 * $hour_rate;
						$pay2_ans[] = "00" . ":" . $a1[1];
						$pay_sum = array_merge($pay, $pay2);
						$paysum = array_sum($pay_sum);
						$overtime3_first = $table_ans;
						$overtime6_first = $paysum;
					}
				}
				$overtime3_first = $table_ans;
			}
			if ($overtime == "1") {
				foreach ($overall_time as $key => $val) {
					list($overtime_h1, $overtime_m1) = explode(":", $val);
					if ($overtime_h1 >= 8) {
						$hour_res = trim($overtime_h1) - 8;
						$overtime_work1[] = $hour_res . ":" . $overtime_m1;
					} else {
						$overtime3_first = $table_ans;
					}
				}
				function calculate_overtime_one3($overtime_work1)
				{
					$minutes = 0;
					if ($overtime_work1 != "") {
						foreach ($overtime_work1 as $value) {
							list($hour, $minute) = explode(':', $value);
							$minutes += trim($hour) * 60;
							$minutes += trim($minute);
						}
					}
					$hours = floor($minutes / 60);
					$minutes -= $hours * 60;
					return sprintf('%02d:%02d', $hours, $minutes);
				}
				$Ans1 = calculate_overtime_one3($overtime_work1);
				list($Ans1_h, $Ans1_m) = explode(':', $Ans1);
				if ($Ans1_h <= 9) {
					$Ans1_h = sprintf("%02d", $Ans1_h);
				}
				if ($Ans1_m <= 9) {
					$Ans1_m = sprintf("%02d", $Ans1_m);
				}
				$Ans11 = trim($Ans1_h) . ":" . trim($Ans1_m) . ":" . "00";
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				if ($selection1 == "1") {
					$duty_time = 1 * 8;
				} else if ($selection1 == "2") {
					$duty_time = 2 * 8;
				} else if ($selection1 == "3") {
					$duty_time = 3 * 8;
				} else if ($selection1 == "4") {
					$duty_time = 4 * 8;
				} else if ($selection1 == "5") {
					$duty_time = 5 * 8;
				} else if ($selection1 == "6") {
					$duty_time = 6 * 8;
				} else if ($selection1 == "7") {
					$duty_time = 7 * 8;
				}
				$regular_time = $duty_time . ":" . "00";
				if (!empty($hour_rate)) {
					if (!empty($overtime_work1)) {
					}
					$pay_h = trim($duty_time) * $hour_rate;
					$pay_dutytime = $pay_h;
				}
				if (!empty($overtime_pay)) {
					list($overtimepay_h, $overtimepay_m) = explode(":", $Ans1);
					if (!empty($hour_rate)) {
						$overpay_h = trim($overtimepay_h) * trim($hour_rate) * trim($overtime_pay);
						$overpay_m = ($overtimepay_m / 60) * trim($hour_rate) * trim($overtime_pay);
						$overwork_pay = $overpay_h + $overpay_m;
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$total_pay = $overwork_pay + $pay_dutytime;
				}
				$overtime2_first = $Ans1;
				$overtime3_first = $table_ans;
				if (!empty($hour_rate)) {
					$overtime4_first = $pay_dutytime;
				}
				if (!empty($overwork_pay)) {
					$overtime5_first = $overwork_pay;
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$overtime6_first = $total_pay;
				}
			}
			if ($overtime == "2") {
				list($tableans_h, $tableans_m) = explode(":", $table_ans);
				if ($tableans_h >= 40) {
					$hour_res = trim($tableans_h) - 40;
					$overtime_work1 = $hour_res . ":" . $tableans_m;
					$overtime2_first = $overtime_work1;
				} else {
					$overtime3_first = $table_ans;
					$overtime2_first = "00";
				}
				if ($overtime_work1 != "") {
					list($Ans1_h, $Ans1_m) = explode(':', $overtime_work1);
					if ($Ans1_h <= 9) {
						$Ans1_h = sprintf("%02d", $Ans1_h);
					}
					if ($Ans1_m <= 9) {
						$Ans1_m = sprintf("%02d", $Ans1_m);
					}
					$Ans111 = trim($Ans1_h) . ":" . trim($Ans1_m);
				}
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				$tableans1 = trim($tableans_h) . ":" . trim($tableans_m) . ":" . "00";
				if ($overtime_work1 != "") {
					$duty_timet2 = 40;
					$regular_time = $duty_timet2 . ":" . "00";
				}
				if (!empty($hour_rate)) {
					if (!empty($duty_timet2)) {
						$pay_h = trim($duty_timet2) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					if (empty($overtime_work1)) {
						$regular_time = $table_ans;
						list($tableans_h, $tableans_m) = explode(':', $table_ans);
						$pay_h = trim($tableans_h) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					$overtime4_first = $pay_dutytimet1;
				}
				if (!empty($overtime_pay)) {
					if ($overtime_work1 != "") {
						list($overtimepay_h, $overtimepay_m) = explode(":", $overtime_work1);
					}
					if ($hour_rate != "" && $overtime_pay != "") {
						if (!empty($overtimepay_h)) {
							$overpay_h = trim($overtimepay_h) * $hour_rate * $overtime_pay;
							$overpay_m = ($overtimepay_m / 60) * $hour_rate * $overtime_pay;
							$overwork_payt1 = $overpay_h + $overpay_m;
							$overtime5_first = $overwork_payt1;
						}
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay) && !empty($pay_dutytimet1)) {
					if (!empty($overwork_payt1)) {
						$total_pay = $pay_dutytimet1 + $overwork_payt1;
						$overtime6_first = $total_pay;
					}
				}
				$overtime3_first = $table_ans;
			}
			if (!empty($sick_h) || !empty($sick_m)) {
				if ($sick_h <= 9) {
					$sick_h = sprintf("%02d", $sick_h);
				}
				if ($sick_m <= 9) {
					$sick_m = sprintf("%02d", $sick_m);
				}
				list($h, $m) = explode(":", $table_ans);
				$total_m = $sick_m + $m;
				$total_h = $sick_h + $h;
				$t_pay = $total_h . ":" . $total_m;
				$answer1 = trim($sick_h) . ":" . trim($sick_m);
				if (!empty($hour_rate)) {
					if (!empty($answer1)) {
						list($s_h, $s_m) = explode(":", $answer1);
						$sickpay_h = trim($s_h) * $hour_rate;
						$sickpay_m = ($s_m / 60) * $hour_rate;
						$s_pay = $sickpay_h + $sickpay_m;
					}
					$sick_pay = $s_pay;
					list($sick_hour, $sick_min) = explode(":", $t_pay);
					$pay_h = trim($sick_hour) * $hour_rate;
					$pay_m = ($sick_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
					$overtime6_first = $sickpay;
				}
				$sick_time = trim($sick_h) . ":" . trim($sick_m);
				$overtime3_first = $t_pay;
				if ($hour_rate != "") {
					$sick_pay = $s_pay;
					$overtime6_first = $sickpay;
				}
			}
			if (!empty($v_h) || !empty($v_m)) {
				if ($v_h <= 9) {
					$v_h = sprintf("%02d", $v_h);
				}
				if ($v_m <= 9) {
					$v_m = sprintf("%02d", $v_m);
				}
				$answer1 = trim($v_h) . ":" . trim($v_m);
				$secs = strtotime($answer1) - strtotime("00:00:00");
				if (!empty($sick_h) || !empty($sick_m)) {
					if ($sick_h <= 9) {
						$sick_h = sprintf("%02d", $sick_h);
					}
					if ($sick_m <= 9) {
						$sick_m = sprintf("%02d", $sick_m);
					}
					$answer2 = trim($sick_h) . ":" . trim($sick_m);
					$v_hours = date("H:i", strtotime($answer2) + $secs);
					list($hours, $minutes) = explode(":", $v_hours);
					list($h, $m) = explode(":", $table_ans);
					$total_m = $minutes + $m;
					$total_h = $hours + $h;
					$total_sick = $total_h . ":" . $total_m;
					$overtime3_first = $total_sick;
				} else {
					$v_hours = date("H:i", strtotime($table_ans) + $secs);
					$overtime3_first = $v_hours;
				}
				if (!empty($hour_rate)) {
					list($vacation_h, $vacation_m) = explode(":", $answer1);
					$sickpay_h = trim($vacation_h) * $hour_rate;
					$sickpay_m = ($vacation_m / 60) * $hour_rate;
					$v_pay = $sickpay_h + $sickpay_m;
					list($v_hour, $v_min) = explode(":", $total_sick);
					$pay_h = trim($v_hour) * $hour_rate;
					$pay_m = ($v_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
				}
				$v_time = trim($v_h) . ":" . trim($v_m);
				if ($hour_rate != "") {
					$vacation_pay = $v_pay;
					$overtime6_first = $sickpay;
				}
			}
			return array($ans_arr, $ansl1_arr, $ansl21_arr, $ansl2_arr, $overall_time, $regular_time, $overtime2_first, $overtime3_first, $sick_pay, $sick_time, $vacation_pay, $v_time, $overtime4_first, $overtime5_first, $overtime6_first);
		}
		function timeCal4($selection3 = null, $selection1 = null, $inhour = null, $inmin = null, $inampm = null, $outhour = null, $outmin = null, $outampm = null, $in = null, $out = null, $inhourl1 = null, $inminl1 = null, $inampml1 = " ", $outhourl1 = null, $outminl1 = null, $outampml1 = null, $inlunch1 = null, $outlunch1 = null, $inhourl2 = null, $inminl2 = null, $inampml2 = null, $outhourl2 = null, $outminl2 = null, $outampml2 = null, $inlunch2 = null, $outlunch2 = null, $sick_h = null, $sick_m = null, $v_h = null, $v_m = null, $advancedcheck = null, $lunch = null, $paid_lunch1 = null, $paid_lunch2 = null, $hour_rate = null, $overtime = null, $overtime_pay = null)
		{
			$checkHour = true;
			$checkHourl = true;
			$checkHourl2 = true;
			$regular_time = false;
			$overtime2_first = false;
			$overtime3_first = false;
			$overtime4_first = false;
			$overtime5_first = false;
			$overtime6_first = false;
			$a = $b = $c = $d = $sick_pay = $sick_time = $total_pay = $vacation_pay = $v_time = $ans_arrt2 = $ansl1_arrt2 = $ansl21_arrt2 = $ansl2_arrt2 = $overall_timet2 = $regular_timet2 = $overtime2_firstt2 = $overtime3_firstt2 = $sick_payt2 = $t2sick_timet2 = $total_payt2 = $vacation_payt2 = $v_timet2 = $overtime4_firstt2 = $overtime5_firstt2 = $overtime6_firstt2 = $s_pay = $sickpay = $days = $dayst2 = $overtime_work1 = $ans_arrt3 = $ansl1_arrt3 = $ansl21_arrt3 = $ansl2_arrt3 = $overall_timet3 = $regular_timet3 = $overtime2_firstt3 = $overtime3_firstt3 = $sick_payt3 = $t3sick_timet3 = $total_payt3 = $vacation_payt3 = $v_timet3 = $overtime4_firstt3 = $overtime5_firstt3 = $overtime6_firstt3 = $s_pay = $sickpay = $days = $dayst3 = $ans_arrt4 = $ansl1_arrt4 = $ansl21_arrt4 = $ansl2_arrt4 = $overall_timet4 = $regular_timet4 = $overtime2_firstt4 = $overtime3_firstt4 = $sick_payt4 = $t4sick_timet4 = $total_payt4 = $vacation_payt4 = $v_timet4 = $overtime4_firstt4 = $overtime5_firstt4 = $overtime6_firstt4 = $s_pay = $sickpay = $days = $dayst4 = false;
			$ans_arr = [];
			$ansl1_arr = [];
			$ansl2_arr = [];
			$ansl21_arr = [];
			$checkHour = true;
			if ($selection3 == "1") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $inhour[$i];
					$hour1 = $outhour[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$day = 14;
						if ($inampm[$i] == $outampm[$i]) {
							$day = 15;
						}
						$hour = $inhour[$i];
						$min = $inmin[$i];
						$ampm = $inampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$inr1_res = $hour . ":" . $min . " " . $ampm;
						$inr1_time = date("H:i:s", strtotime($inr1_res));
						$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
						$hour = $outhour[$i];
						$min = $outmin[$i];
						$ampm = $outampm[$i];
						if ($hour <= 9) {
							$hour = sprintf("%02d", $hour);
						}
						if ($min <= 9) {
							$min = sprintf("%02d", $min);
						}
						$outr1_res = $hour . ":" . $min . " " . $ampm;
						$outr1_time = date("H:i:s", strtotime($outr1_res));
						$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
					}
				}
			} else if ($selection3 == "2") {
				for ($i = 0; $i < $selection1; $i++) {
					$hour = $in[$i];
					$hour1 = $out[$i];
					if (empty($hour) || empty($hour1)) {
						$checkHour = false;
					} else {
						$ab1 = substr($hour, 2);
						$ab2 = substr($hour1, 2);
						if ($ab1 < 59 && $ab2 < 59) {
							$day = 14;
							if ($hour1 < $hour) {
								$day = 15;
							}
							$inr1_time = date("H:i:s", strtotime($hour));
							$inr1_time = new Carbon("2006-04-14 " . $inr1_time);
							$outr1_time = date("H:i:s", strtotime($hour1));
							$outr1_time = new Carbon("2006-04-" . $day . " " . $outr1_time);
						} else {
							return false;
						}
					}
				}
			}
			if ($checkHour == true) {
				for ($i = 0; $i < $selection1; $i++) {
					// $day=14;
					// if ($inampm[$i]==$outampm[$i]) {
					// 	$day=15;
					// }
					// $hour=$inhour[$i];
					// $min=$inmin[$i];
					// $ampm=$inampm[$i];
					// if ($hour<=9) {
					// 	$hour=sprintf("%02d", $hour);
					// }
					// if ($min<=9) {
					// 	$min=sprintf("%02d", $min);
					// }
					// $inr1_res=$hour.":".$min." ".$ampm;
					// $inr1_time = date("H:i:s", strtotime($inr1_res));
					// $inr1_time = new Carbon("2006-04-14 ".$inr1_time);
					// $hour=$outhour[$i];
					// $min=$outmin[$i];
					// $ampm=$outampm[$i];
					// if ($hour<=9) {
					// 	$hour=sprintf("%02d", $hour);
					// }
					// if ($min<=9) {
					// 	$min=sprintf("%02d", $min);
					// }
					// $outr1_res=$hour.":".$min." ".$ampm;
					// $outr1_time = date("H:i:s", strtotime($outr1_res));
					// $outr1_time = new Carbon("2006-04-".$day." ".$outr1_time);
					$rowans1 = $inr1_time->diff($outr1_time);
					$ans_arr5[] = $rowans1->format('%h : %i');
					foreach ($ans_arr5 as $value) {
						list($t1, $t2) = explode(':', $value);
						$t1 = sprintf("%02d", $t1);
						$t2 = sprintf("%02d", $t2);
					}
					$ans_arr[] = $t1 . ":" . $t2;
					$a = $ans_arr;
				}
				if ($lunch == "2") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
					}
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// }
							// $hourl1=$inhourl1[$i];
							// $minl1=$inminl1[$i];
							// $ampml1=$inampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $inr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
							// $inr1l1_time = new Carbon("2006-04-14 ".$inr1l1_time);
							// $hourl1=$outhourl1[$i];
							// $minl1=$outminl1[$i];
							// $ampml1=$outampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $outr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
							// $outr1l1_time = new Carbon("2006-04-".$day." ".$outr1l1_time);
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl1_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl1_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl1_arr[] = $t1 . ":" . $t2;
							$b = $ansl1_arr;
						}
					} else {
						return false;
					}
				}
				if ($lunch == "3") {
					if ($selection3 == "1") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inhourl1[$i];
							$hour1l1 = $outhourl1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl1 = $inhourl1[$i];
								$minl1 = $inminl1[$i];
								$ampml1 = $inampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$inr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
								$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
								$hourl1 = $outhourl1[$i];
								$minl1 = $outminl1[$i];
								$ampml1 = $outampml1[$i];
								if ($hourl1 <= 9) {
									$hourl1 = sprintf("%02d", $hourl1);
								}
								if ($minl1 <= 9) {
									$minl1 = sprintf("%02d", $minl1);
								}
								$outr1l1_res = $hourl1 . ":" . $minl1 . " " . $ampml1;
								$outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
								$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inhourl2[$i];
							$hour1l2 = $outhourl2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$day = 14;
								if ($inampm[$i] == $outampm[$i]) {
									$day = 15;
								}
								$hourl2 = $inhourl2[$i];
								$minl2 = $inminl2[$i];
								$ampml2 = $inampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$inr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
								$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
								$hourl2 = $outhourl2[$i];
								$minl2 = $outminl2[$i];
								$ampml2 = $outampml2[$i];
								if ($hourl2 <= 9) {
									$hourl2 = sprintf("%02d", $hourl2);
								}
								if ($minl2 <= 9) {
									$minl2 = sprintf("%02d", $minl2);
								}
								$outr1l2_res = $hourl2 . ":" . $minl2 . " " . $ampml2;
								$outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
								$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
							}
						}
					} else if ($selection3 == "2") {
						for ($i = 0; $i < $selection1; $i++) {
							$hourl1 = $inlunch1[$i];
							$hour1l1 = $outlunch1[$i];
							if (empty($hourl1) || empty($hour1l1)) {
								$checkHourl = false;
							} else {
								$xy1 = substr($hourl1, 2);
								$xy2 = substr($hour1l1, 2);
								if ($xy1 < 59 && $xy2 < 59) {
									$day = 14;
									if ($hour1l1 < $hourl1) {
										$day = 15;
									}
									$inr1l1_time = date("H:i:s", strtotime($hourl1));
									$inr1l1_time = new Carbon("2006-04-14 " . $inr1l1_time);
									$outr1l1_time = date("H:i:s", strtotime($hour1l1));
									$outr1l1_time = new Carbon("2006-04-" . $day . " " . $outr1l1_time);
								} else {
									return false;
								}
							}
						}
						for ($i = 0; $i < $selection1; $i++) {
							$hourl2 = $inlunch2[$i];
							$hour1l2 = $outlunch2[$i];
							if (empty($hourl2) || empty($hour1l2)) {
								$checkHourl2 = false;
							} else {
								$x1y1 = substr($hourl2, 2);
								$x2y2 = substr($hour1l2, 2);
								if ($x1y1 < 59 && $x2y2 < 59) {
									$day = 14;
									if ($hour1l2 < $hourl2) {
										$day = 15;
									}
									$inr1l2_time = date("H:i:s", strtotime($hourl2));
									$inr1l2_time = new Carbon("2006-04-14 " . $inr1l2_time);
									$outr1l2_time = date("H:i:s", strtotime($hour1l2));
									$outr1l2_time = new Carbon("2006-04-" . $day . " " . $outr1l2_time);
								} else {
									return false;
								}
							}
						}
					}


					// for ($i=0; $i < $selection1 ; $i++) {
					// 	$hourl1=$inhourl1[$i];
					// 	$hour1l1=$outhourl1[$i];
					// 	if (empty($hourl1) || empty($hour1l1)) {
					// 		$checkHourl=false;
					// 	}
					// }
					if ($checkHourl == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// }
							// $hourl1=$inhourl1[$i];
							// $minl1=$inminl1[$i];
							// $ampml1=$inampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $inr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $inr1l1_time = date("H:i:s", strtotime($inr1l1_res));
							// $inr1l1_time = new Carbon("2006-04-14 ".$inr1l1_time);
							// $hourl1=$outhourl1[$i];
							// $minl1=$outminl1[$i];
							// $ampml1=$outampml1[$i];
							// if ($hourl1<=9) {
							// 	$hourl1=sprintf("%02d", $hourl1);
							// }
							// if ($minl1<=9) {
							// 	$minl1=sprintf("%02d", $minl1);
							// }
							// $outr1l1_res=$hourl1.":".$minl1." ".$ampml1;
							// $outr1l1_time = date("H:i:s", strtotime($outr1l1_res));
							// $outr1l1_time = new Carbon("2006-04-".$day." ".$outr1l1_time);
							$rowans1l1 = $inr1l1_time->diff($outr1l1_time);
							$ansl21_arr5[] = $rowans1l1->format('%h : %i');
							foreach ($ansl21_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl21_arr[] = $t1 . ":" . $t2;
							$c = $ansl21_arr;
						}
					} else {
						return false;
					}
					// for ($i=0; $i < $selection1 ; $i++) {
					// 	$hourl2=$inhourl2[$i];
					// 	$hour1l2=$outhourl2[$i];
					// 	if (empty($hourl2) || empty($hour1l2)) {
					// 		$checkHourl2=false;
					// 	}
					// }
					if ($checkHourl2 == true) {
						$ansl1_arr = [];
						for ($i = 0; $i < $selection1; $i++) {
							// $day=14;
							// if ($inampm[$i]==$outampm[$i]) {
							// 	$day=15;
							// } 
							// $hourl2=$inhourl2[$i];
							// $minl2=$inminl2[$i];
							// $ampml2=$inampml2[$i];
							// if ($hourl2<=9) {
							// 	$hourl2=sprintf("%02d", $hourl2);
							// }
							// if ($minl2<=9) {
							// 	$minl2=sprintf("%02d", $minl2);
							// }
							// $inr1l2_res=$hourl2.":".$minl2." ".$ampml2;
							// $inr1l2_time = date("H:i:s", strtotime($inr1l2_res));
							// $inr1l2_time = new Carbon("2006-04-14 ".$inr1l2_time);
							// $hourl2=$outhourl2[$i];
							// $minl2=$outminl2[$i];
							// $ampml2=$outampml2[$i];
							// if ($hourl2<=9) {
							// 	$hourl2=sprintf("%02d", $hourl2);
							// }
							// if ($minl2<=9) {
							// 	$minl2=sprintf("%02d", $minl2);
							// }
							// $outr1l2_res=$hourl2.":".$minl2." ".$ampml2;
							// $outr1l2_time = date("H:i:s", strtotime($outr1l2_res));
							// $outr1l2_time = new Carbon("2006-04-".$day." ".$outr1l2_time);
							$rowans1l2 = $inr1l2_time->diff($outr1l2_time);
							$ansl2_arr5[] = $rowans1l2->format('%h : %i');
							foreach ($ansl2_arr5 as $value) {
								list($t1, $t2) = explode(':', $value);
								$t1 = sprintf("%02d", $t1);
								$t2 = sprintf("%02d", $t2);
							}
							$ansl2_arr[] = $t1 . ":" . $t2;
							$d = $ansl2_arr;
						}
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
			if ($lunch == "1") {
				if ($advancedcheck == true) {
					if (!empty($paid_lunch1) && !empty($paid_lunch2)) {
						$min1 = "00" . ":" . $paid_lunch1;
						$min2 = "00" . ":" . $paid_lunch2;
						function calculate_total_time4()
						{
							$i = 0;
							foreach (func_get_args() as $time) {
								sscanf($time, '%d:%d', $hour, $min);
								$i += $hour * 60 + $min;
							}
							if ($h = floor($i / 60)) {
								$i %= 60;
							}
							return sprintf('%02d:%02d', $h, $i);
						}
						$paid_lunch = calculate_total_time4($min1, $min2);
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$resultt2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $resultt2;
					} else if (!empty($paid_lunch1)) {
						$paid_lunch = "00" . ":" . $paid_lunch1;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result2[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result2;
					} else if (!empty($paid_lunch2)) {
						$paid_lunch = "00" . ":" . $paid_lunch2;
						foreach ($ans_arr as $key => $val) {
							list($h, $m) = explode(':', $val);
							if ($h <= 9) {
								$h = sprintf("%02d", $h);
							}
							if ($m <= 9) {
								$m = sprintf("%02d", $m);
							}
							$answer1 = trim($h) . ":" . trim($m) . ":" . "00";
							$secs = strtotime($paid_lunch) - strtotime("00:00:00");
							$result3[] = date("H:i", strtotime($answer1) - $secs);
						}
						$overall_time = $result3;
					}
				} else {
					$overall_time = $ans_arr;
				}
			}
			if ($lunch == "2") {
				foreach ($a as $key => $val1) {
					$val2 = $b[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$result20[] = date("H:i", strtotime($val11) + $secs);
					$overall_time = $result20;
				}
				if (!empty($paid_lunch1)) {
					$paid_lunch = "00" . ":" . $paid_lunch1;
					foreach ($result20 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result21[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result21;
					}
				}
			}
			if ($lunch == "3") {
				foreach ($a as $key => $val1) {
					$val2 = $c[$key];
					$val3 = $d[$key];
					list($hl1, $ml1) = explode(':', $val1);
					if ($hl1 <= 9) {
						$hl1 = sprintf("%02d", $hl1);
					}
					if ($ml1 <= 9) {
						$ml1 = sprintf("%02d", $ml1);
					}
					$val11 = trim($hl1) . ":" . trim($ml1) . ":" . "00";
					list($hl12, $ml12) = explode(':', $val2);
					if ($hl12 <= 9) {
						$hl12 = sprintf("%02d", $hl12);
					}
					if ($ml12 <= 9) {
						$ml12 = sprintf("%02d", $ml12);
					}
					$val12 = trim($hl12) . ":" . trim($ml12) . ":" . "00";
					list($hl13, $ml13) = explode(":", $val3);
					if ($hl13 <= 9) {
						$hl13 = sprintf("%02d", $hl13);
					}
					if ($ml13 <= 9) {
						$ml13 = sprintf("%02d", $ml13);
					}
					$val13 = trim($hl13) . ":" . trim($ml13) . ":" . "00";
					$secs = strtotime($val12) - strtotime("00:00:00");
					$secs2 = strtotime($val13) - strtotime("00:00:00");
					$result30[] = date("H:i", strtotime($val11) + $secs + $secs2);
					$overall_time = $result30;
				}
				if (!empty($paid_lunch2)) {
					$paid_lunch = "00" . ":" . $paid_lunch2;
					foreach ($result30 as $key => $val) {
						list($h, $m) = explode(':', $val);
						if ($h <= 9) {
							$h = sprintf("%02d", $h);
						}
						if ($m <= 9) {
							$m = sprintf("%02d", $m);
						}
						$answer1 = $h . ":" . $m . ":" . "00";
						$secs = strtotime($paid_lunch) - strtotime("00:00:00");
						$result31[] = date("H:i", strtotime($answer1) + $secs);
						$overall_time = $result31;
					}
				}
			}
			function AddPlayTime4($overall_time)
			{
				$minutes = 0;
				foreach ($overall_time as $value) {
					list($hour, $minute) = explode(':', $value);
					$minutes += trim($hour) * 60;
					$minutes += trim($minute);
				}
				$hours = floor($minutes / 60);
				$minutes -= $hours * 60;
				return sprintf('%02d:%02d', $hours, $minutes);
			}
			$table_ans = AddPlayTime4($overall_time);
			$overtime3_first = $table_ans;
			if ($overtime == "0") {
				if (!empty($hour_rate)) {
					foreach ($overall_time as $key => $val) {
						$a1 = explode(":", $val);
						$a1_ans[] = $a1[0] . ":" . "00";
						$pay[] = trim($a1[0]) * $hour_rate;
						$pay2[] = $a1[1] / 60 * $hour_rate;
						$pay2_ans[] = "00" . ":" . $a1[1];
						$pay_sum = array_merge($pay, $pay2);
						$paysum = array_sum($pay_sum);
						$overtime3_first = $table_ans;
						$overtime6_first = $paysum;
					}
				}
				$overtime3_first = $table_ans;
			}
			if ($overtime == "1") {
				foreach ($overall_time as $key => $val) {
					list($overtime_h1, $overtime_m1) = explode(":", $val);
					if ($overtime_h1 >= 8) {
						$hour_res = trim($overtime_h1) - 8;
						$overtime_work1[] = $hour_res . ":" . $overtime_m1;
					} else {
						$overtime3_first = $table_ans;
					}
				}
				function calculate_overtime_one4($overtime_work1)
				{
					$minutes = 0;
					if ($overtime_work1 != "") {
						foreach ($overtime_work1 as $value) {
							list($hour, $minute) = explode(':', $value);
							$minutes += trim($hour) * 60;
							$minutes += trim($minute);
						}
					}
					$hours = floor($minutes / 60);
					$minutes -= $hours * 60;
					return sprintf('%02d:%02d', $hours, $minutes);
				}
				$Ans1 = calculate_overtime_one4($overtime_work1);
				list($Ans1_h, $Ans1_m) = explode(':', $Ans1);
				if ($Ans1_h <= 9) {
					$Ans1_h = sprintf("%02d", $Ans1_h);
				}
				if ($Ans1_m <= 9) {
					$Ans1_m = sprintf("%02d", $Ans1_m);
				}
				$Ans11 = trim($Ans1_h) . ":" . trim($Ans1_m) . ":" . "00";
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				if ($selection1 == "1") {
					$duty_time = 1 * 8;
				} else if ($selection1 == "2") {
					$duty_time = 2 * 8;
				} else if ($selection1 == "3") {
					$duty_time = 3 * 8;
				} else if ($selection1 == "4") {
					$duty_time = 4 * 8;
				} else if ($selection1 == "5") {
					$duty_time = 5 * 8;
				} else if ($selection1 == "6") {
					$duty_time = 6 * 8;
				} else if ($selection1 == "7") {
					$duty_time = 7 * 8;
				}
				$regular_time = $duty_time . ":" . "00";
				if (!empty($hour_rate)) {
					if (!empty($overtime_work1)) {
					}
					$pay_h = trim($duty_time) * $hour_rate;
					$pay_dutytime = $pay_h;
				}
				if (!empty($overtime_pay)) {
					list($overtimepay_h, $overtimepay_m) = explode(":", $Ans1);
					if (!empty($hour_rate)) {
						$overpay_h = trim($overtimepay_h) * trim($hour_rate) * trim($overtime_pay);
						$overpay_m = ($overtimepay_m / 60) * trim($hour_rate) * trim($overtime_pay);
						$overwork_pay = $overpay_h + $overpay_m;
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$total_pay = $overwork_pay + $pay_dutytime;
				}
				$overtime2_first = $Ans1;
				$overtime3_first = $table_ans;
				if (!empty($hour_rate)) {
					$overtime4_first = $pay_dutytime;
				}
				if (!empty($overwork_pay)) {
					$overtime5_first = $overwork_pay;
				}
				if (!empty($hour_rate) && !empty($overtime_pay)) {
					$overtime6_first = $total_pay;
				}
			}
			if ($overtime == "2") {
				list($tableans_h, $tableans_m) = explode(":", $table_ans);
				if ($tableans_h >= 40) {
					$hour_res = trim($tableans_h) - 40;
					$overtime_work1 = $hour_res . ":" . $tableans_m;
					$overtime2_first = $overtime_work1;
				} else {
					$overtime3_first = $table_ans;
					$overtime2_first = "00";
				}
				if ($overtime_work1 != "") {
					list($Ans1_h, $Ans1_m) = explode(':', $overtime_work1);
					if ($Ans1_h <= 9) {
						$Ans1_h = sprintf("%02d", $Ans1_h);
					}
					if ($Ans1_m <= 9) {
						$Ans1_m = sprintf("%02d", $Ans1_m);
					}
					$Ans111 = trim($Ans1_h) . ":" . trim($Ans1_m);
				}
				list($tableans_h, $tableans_m) = explode(':', $table_ans);
				if ($tableans_h <= 9) {
					$tableans_h = sprintf("%02d", $tableans_h);
				}
				if ($tableans_m <= 9) {
					$tableans_m = sprintf("%02d", $tableans_m);
				}
				$tableans1 = trim($tableans_h) . ":" . trim($tableans_m) . ":" . "00";
				if ($overtime_work1 != "") {
					$duty_timet2 = 40;
					$regular_time = $duty_timet2 . ":" . "00";
				}
				if (!empty($hour_rate)) {
					if (!empty($duty_timet2)) {
						$pay_h = trim($duty_timet2) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					if (empty($overtime_work1)) {
						$regular_time = $table_ans;
						list($tableans_h, $tableans_m) = explode(':', $table_ans);
						$pay_h = trim($tableans_h) * $hour_rate;
						$pay_dutytimet1 = $pay_h;
					}
					$overtime4_first = $pay_dutytimet1;
				}
				if (!empty($overtime_pay)) {
					if ($overtime_work1 != "") {
						list($overtimepay_h, $overtimepay_m) = explode(":", $overtime_work1);
					}
					if ($hour_rate != "" && $overtime_pay != "") {
						if (!empty($overtimepay_h)) {
							$overpay_h = trim($overtimepay_h) * $hour_rate * $overtime_pay;
							$overpay_m = ($overtimepay_m / 60) * $hour_rate * $overtime_pay;
							$overwork_payt1 = $overpay_h + $overpay_m;
							$overtime5_first = $overwork_payt1;
						}
					}
				}
				if (!empty($hour_rate) && !empty($overtime_pay) && !empty($pay_dutytimet1)) {
					if (!empty($overwork_payt1)) {
						$total_pay = $pay_dutytimet1 + $overwork_payt1;
						$overtime6_first = $total_pay;
					}
				}
				$overtime3_first = $table_ans;
			}
			if (!empty($sick_h) || !empty($sick_m)) {
				if ($sick_h <= 9) {
					$sick_h = sprintf("%02d", $sick_h);
				}
				if ($sick_m <= 9) {
					$sick_m = sprintf("%02d", $sick_m);
				}
				list($h, $m) = explode(":", $table_ans);
				$total_m = $sick_m + $m;
				$total_h = $sick_h + $h;
				$t_pay = $total_h . ":" . $total_m;
				$answer1 = trim($sick_h) . ":" . trim($sick_m);
				if (!empty($hour_rate)) {
					if (!empty($answer1)) {
						list($s_h, $s_m) = explode(":", $answer1);
						$sickpay_h = trim($s_h) * $hour_rate;
						$sickpay_m = ($s_m / 60) * $hour_rate;
						$s_pay = $sickpay_h + $sickpay_m;
					}
					$sick_pay = $s_pay;
					list($sick_hour, $sick_min) = explode(":", $t_pay);
					$pay_h = trim($sick_hour) * $hour_rate;
					$pay_m = ($sick_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
					$overtime6_first = $sickpay;
				}
				$sick_time = trim($sick_h) . ":" . trim($sick_m);
				$overtime3_first = $t_pay;
				if ($hour_rate != "") {
					$sick_pay = $s_pay;
					$overtime6_first = $sickpay;
				}
			}
			if (!empty($v_h) || !empty($v_m)) {
				if ($v_h <= 9) {
					$v_h = sprintf("%02d", $v_h);
				}
				if ($v_m <= 9) {
					$v_m = sprintf("%02d", $v_m);
				}
				$answer1 = trim($v_h) . ":" . trim($v_m);
				$secs = strtotime($answer1) - strtotime("00:00:00");
				if (!empty($sick_h) || !empty($sick_m)) {
					if ($sick_h <= 9) {
						$sick_h = sprintf("%02d", $sick_h);
					}
					if ($sick_m <= 9) {
						$sick_m = sprintf("%02d", $sick_m);
					}
					$answer2 = trim($sick_h) . ":" . trim($sick_m);
					$v_hours = date("H:i", strtotime($answer2) + $secs);
					list($hours, $minutes) = explode(":", $v_hours);
					list($h, $m) = explode(":", $table_ans);
					$total_m = $minutes + $m;
					$total_h = $hours + $h;
					$total_sick = $total_h . ":" . $total_m;
					$overtime3_first = $total_sick;
				} else {
					$v_hours = date("H:i", strtotime($table_ans) + $secs);
					$overtime3_first = $v_hours;
				}
				if (!empty($hour_rate)) {
					list($vacation_h, $vacation_m) = explode(":", $answer1);
					$sickpay_h = trim($vacation_h) * $hour_rate;
					$sickpay_m = ($vacation_m / 60) * $hour_rate;
					$v_pay = $sickpay_h + $sickpay_m;
					list($v_hour, $v_min) = explode(":", $total_sick);
					$pay_h = trim($v_hour) * $hour_rate;
					$pay_m = ($v_min / 60) * $hour_rate;
					$sickpay = $pay_h + $pay_m;
				}
				$v_time = trim($v_h) . ":" . trim($v_m);
				if ($hour_rate != "") {
					$vacation_pay = $v_pay;
					$overtime6_first = $sickpay;
				}
			}
			return array($ans_arr, $ansl1_arr, $ansl21_arr, $ansl2_arr, $overall_time, $regular_time, $overtime2_first, $overtime3_first, $sick_pay, $sick_time, $vacation_pay, $v_time, $overtime4_first, $overtime5_first, $overtime6_first);
		}
		if ($table_selection == "1") {
			$ans_time = timeCal($selection3, $selection1, $inhour, $inmin, $inampm, $outhour, $outmin, $outampm, $in, $out, $inhourl1, $inminl1, $inampml1, $outhourl1, $outminl1, $outampml1, $inlunch1, $outlunch1, $inhourl2, $inminl2, $inampml2, $outhourl2, $outminl2, $outampml2, $inlunch2, $outlunch2, $sick_h, $sick_m, $v_h, $v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_time === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arr'] = $ans_time[0];
				$this->param['ansl1_arr'] = $ans_time[1];
				$this->param['ansl21_arr'] = $ans_time[2];
				$this->param['ansl2_arr'] = $ans_time[3];
				$this->param['overall_time'] = $ans_time[4];
				$this->param['regular_time'] = $ans_time[5];
				$this->param['overtime2_first'] = $ans_time[6];
				$this->param['overtime3_first'] = $ans_time[7];
				$this->param['sick_pay'] = $ans_time[8];
				$this->param['sick_time'] = $ans_time[9];
				$this->param['vacation_pay'] = $ans_time[10];
				$this->param['v_time'] = $ans_time[11];
				$this->param['overtime4_first'] = $ans_time[12];
				$this->param['overtime5_first'] = $ans_time[13];
				$this->param['overtime6_first'] = $ans_time[14];
				if ($selection2 == "1") {
					$days = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$days = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$days = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$from = date('M d, Y', strtotime($s_date));
				$to = date('M d, Y', strtotime($e_date));
				if (strtotime($s_date) > strtotime($e_date)) {
					$new = $from;
					$from = $to;
					$to = $new;
				}
				$this->param['from'] = $from;
				$this->param['to'] = $to;
				$this->param['days'] = $days;
			}
		} else if ($table_selection == "2") {
			$ans_time = timeCal($selection3, $selection1, $inhour, $inmin, $inampm, $outhour, $outmin, $outampm, $in, $out, $inhourl1, $inminl1, $inampml1, $outhourl1, $outminl1, $outampml1, $inlunch1, $outlunch1, $inhourl2, $inminl2, $inampml2, $outhourl2, $outminl2, $outampml2, $inlunch2, $outlunch2, $sick_h, $sick_m, $v_h, $v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_time === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arr'] = $ans_time[0];
				$this->param['ansl1_arr'] = $ans_time[1];
				$this->param['ansl21_arr'] = $ans_time[2];
				$this->param['ansl2_arr'] = $ans_time[3];
				$this->param['overall_time'] = $ans_time[4];
				$this->param['regular_time'] = $ans_time[5];
				$this->param['overtime2_first'] = $ans_time[6];
				$this->param['overtime3_first'] = $ans_time[7];
				$this->param['sick_pay'] = $ans_time[8];
				$this->param['sick_time'] = $ans_time[9];
				$this->param['vacation_pay'] = $ans_time[10];
				$this->param['v_time'] = $ans_time[11];
				$this->param['overtime4_first'] = $ans_time[12];
				$this->param['overtime5_first'] = $ans_time[13];
				$this->param['overtime6_first'] = $ans_time[14];
				if ($selection2 == "1") {
					$days = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$days = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$days = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$from = date('M d, Y', strtotime($s_date));
				$to = date('M d, Y', strtotime($e_date));
				if (strtotime($s_date) > strtotime($e_date)) {
					$new = $from;
					$from = $to;
					$to = $new;
				}
				$this->param['from'] = $from;
				$this->param['to'] = $to;
				$this->param['days'] = $days;
			}

			// for table 2 calculation

			$ans_timet2 = timeCal2($selection3, $selection1, $t2inhour, $t2inmin, $t2inampm, $t2outhour, $t2outmin, $t2outampm, $t2in, $t2out, $t2inhourl1, $t2inminl1, $t2inampml1, $t2outhourl1, $t2outminl1, $t2outampml1, $t2inlunch1, $t2outlunch1, $t2inhourl2, $t2inminl2, $t2inampml2, $t2outhourl2, $t2outminl2, $t2outampml2, $t2inlunch2, $t2outlunch2, $t2sick_h, $t2sick_m, $t2v_h, $t2v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_timet2 === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arrt2'] = $ans_timet2[0];
				$this->param['ansl1_arrt2'] = $ans_timet2[1];
				$this->param['ansl21_arrt2'] = $ans_timet2[2];
				$this->param['ansl2_arrt2'] = $ans_timet2[3];
				$this->param['overall_timet2'] = $ans_timet2[4];
				$this->param['regular_timet2'] = $ans_timet2[5];
				$this->param['overtime2_firstt2'] = $ans_timet2[6];
				$this->param['overtime3_firstt2'] = $ans_timet2[7];
				$this->param['sick_payt2'] = $ans_timet2[8];
				$this->param['sick_timet2'] = $ans_timet2[9];
				$this->param['vacation_payt2'] = $ans_timet2[10];
				$this->param['v_timet2'] = $ans_timet2[11];
				$this->param['overtime4_firstt2'] = $ans_timet2[12];
				$this->param['overtime5_firstt2'] = $ans_timet2[13];
				$this->param['overtime6_firstt2'] = $ans_timet2[14];
				if ($selection2 == "1") {
					$dayst2 = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$dayst2 = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$dayst2 = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$dayst2 = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$dayst2 = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$fromt2 = date('M d, Y', strtotime($s2_date));
				$tot2 = date('M d, Y', strtotime($e2_date));
				if (strtotime($s2_date) > strtotime($e2_date)) {
					$newt2 = $fromt2;
					$fromt2 = $tot2;
					$tot2 = $newt2;
				}
				$this->param['fromt2'] = $fromt2;
				$this->param['tot2'] = $tot2;
				$this->param['dayst2'] = $dayst2;
			}
		} else if ($table_selection == "3") {
			$ans_time = timeCal($selection3, $selection1, $inhour, $inmin, $inampm, $outhour, $outmin, $outampm, $in, $out, $inhourl1, $inminl1, $inampml1, $outhourl1, $outminl1, $outampml1, $inlunch1, $outlunch1, $inhourl2, $inminl2, $inampml2, $outhourl2, $outminl2, $outampml2, $inlunch2, $outlunch2, $sick_h, $sick_m, $v_h, $v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_time === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arr'] = $ans_time[0];
				$this->param['ansl1_arr'] = $ans_time[1];
				$this->param['ansl21_arr'] = $ans_time[2];
				$this->param['ansl2_arr'] = $ans_time[3];
				$this->param['overall_time'] = $ans_time[4];
				$this->param['regular_time'] = $ans_time[5];
				$this->param['overtime2_first'] = $ans_time[6];
				$this->param['overtime3_first'] = $ans_time[7];
				$this->param['sick_pay'] = $ans_time[8];
				$this->param['sick_time'] = $ans_time[9];
				$this->param['vacation_pay'] = $ans_time[10];
				$this->param['v_time'] = $ans_time[11];
				$this->param['overtime4_first'] = $ans_time[12];
				$this->param['overtime5_first'] = $ans_time[13];
				$this->param['overtime6_first'] = $ans_time[14];
				if ($selection2 == "1") {
					$days = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$days = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$days = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$from = date('M d, Y', strtotime($s_date));
				$to = date('M d, Y', strtotime($e_date));
				if (strtotime($s_date) > strtotime($e_date)) {
					$new = $from;
					$from = $to;
					$to = $new;
				}
				$this->param['from'] = $from;
				$this->param['to'] = $to;
				$this->param['days'] = $days;
			}

			// for table 2 calculation

			$ans_timet2 = timeCal2($selection3, $selection1, $t2inhour, $t2inmin, $t2inampm, $t2outhour, $t2outmin, $t2outampm, $t2in, $t2out, $t2inhourl1, $t2inminl1, $t2inampml1, $t2outhourl1, $t2outminl1, $t2outampml1, $t2inlunch1, $t2outlunch1, $t2inhourl2, $t2inminl2, $t2inampml2, $t2outhourl2, $t2outminl2, $t2outampml2, $t2inlunch2, $t2outlunch2, $t2sick_h, $t2sick_m, $t2v_h, $t2v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_timet2 === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arrt2'] = $ans_timet2[0];
				$this->param['ansl1_arrt2'] = $ans_timet2[1];
				$this->param['ansl21_arrt2'] = $ans_timet2[2];
				$this->param['ansl2_arrt2'] = $ans_timet2[3];
				$this->param['overall_timet2'] = $ans_timet2[4];
				$this->param['regular_timet2'] = $ans_timet2[5];
				$this->param['overtime2_firstt2'] = $ans_timet2[6];
				$this->param['overtime3_firstt2'] = $ans_timet2[7];
				$this->param['sick_payt2'] = $ans_timet2[8];
				$this->param['sick_timet2'] = $ans_timet2[9];
				$this->param['vacation_payt2'] = $ans_timet2[10];
				$this->param['v_timet2'] = $ans_timet2[11];
				$this->param['overtime4_firstt2'] = $ans_timet2[12];
				$this->param['overtime5_firstt2'] = $ans_timet2[13];
				$this->param['overtime6_firstt2'] = $ans_timet2[14];
				if ($selection2 == "1") {
					$dayst2 = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$dayst2 = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$dayst2 = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$dayst2 = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$dayst2 = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$fromt2 = date('M d, Y', strtotime($s2_date));
				$tot2 = date('M d, Y', strtotime($e2_date));
				if (strtotime($s2_date) > strtotime($e2_date)) {
					$newt2 = $fromt2;
					$fromt2 = $tot2;
					$tot2 = $newt2;
				}
				$this->param['fromt2'] = $fromt2;
				$this->param['tot2'] = $tot2;
				$this->param['dayst2'] = $dayst2;
			}

			// for table 3 calculation

			$ans_timet3 = timeCal3($selection3, $selection1, $t3inhour, $t3inmin, $t3inampm, $t3outhour, $t3outmin, $t3outampm, $t3in, $t3out, $t3inhourl1, $t3inminl1, $t3inampml1, $t3outhourl1, $t3outminl1, $t3outampml1, $t3inlunch1, $t3outlunch1, $t3inhourl2, $t3inminl2, $t3inampml2, $t3outhourl2, $t3outminl2, $t3outampml2, $t3inlunch2, $t3outlunch2, $t3sick_h, $t3sick_m, $t3v_h, $t3v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_timet2 === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arrt3'] = $ans_timet3[0];
				$this->param['ansl1_arrt3'] = $ans_timet3[1];
				$this->param['ansl21_arrt3'] = $ans_timet3[2];
				$this->param['ansl2_arrt3'] = $ans_timet3[3];
				$this->param['overall_timet3'] = $ans_timet3[4];
				$this->param['regular_timet3'] = $ans_timet3[5];
				$this->param['overtime2_firstt3'] = $ans_timet3[6];
				$this->param['overtime3_firstt3'] = $ans_timet3[7];
				$this->param['sick_payt3'] = $ans_timet3[8];
				$this->param['sick_timet3'] = $ans_timet3[9];
				$this->param['vacation_payt3'] = $ans_timet3[10];
				$this->param['v_timet3'] = $ans_timet3[11];
				$this->param['overtime4_firstt3'] = $ans_timet3[12];
				$this->param['overtime5_firstt3'] = $ans_timet3[13];
				$this->param['overtime6_firstt3'] = $ans_timet3[14];
				if ($selection2 == "1") {
					$dayst3 = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$dayst3 = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$dayst3 = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$dayst3 = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$dayst3 = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$fromt3 = date('M d, Y', strtotime($s3_date));
				$tot3 = date('M d, Y', strtotime($e3_date));
				if (strtotime($s3_date) > strtotime($e3_date)) {
					$newt3 = $fromt3;
					$fromt3 = $tot3;
					$tot3 = $newt3;
				}
				$this->param['fromt3'] = $fromt3;
				$this->param['tot3'] = $tot3;
				$this->param['dayst3'] = $dayst3;
			}
		} else if ($table_selection == "4") {
			$ans_time = timeCal($selection3, $selection1, $inhour, $inmin, $inampm, $outhour, $outmin, $outampm, $in, $out, $inhourl1, $inminl1, $inampml1, $outhourl1, $outminl1, $outampml1, $inlunch1, $outlunch1, $inhourl2, $inminl2, $inampml2, $outhourl2, $outminl2, $outampml2, $inlunch2, $outlunch2, $sick_h, $sick_m, $v_h, $v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_time === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arr'] = $ans_time[0];
				$this->param['ansl1_arr'] = $ans_time[1];
				$this->param['ansl21_arr'] = $ans_time[2];
				$this->param['ansl2_arr'] = $ans_time[3];
				$this->param['overall_time'] = $ans_time[4];
				$this->param['regular_time'] = $ans_time[5];
				$this->param['overtime2_first'] = $ans_time[6];
				$this->param['overtime3_first'] = $ans_time[7];
				$this->param['sick_pay'] = $ans_time[8];
				$this->param['sick_time'] = $ans_time[9];
				$this->param['vacation_pay'] = $ans_time[10];
				$this->param['v_time'] = $ans_time[11];
				$this->param['overtime4_first'] = $ans_time[12];
				$this->param['overtime5_first'] = $ans_time[13];
				$this->param['overtime6_first'] = $ans_time[14];
				if ($selection2 == "1") {
					$days = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$days = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$days = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$from = date('M d, Y', strtotime($s_date));
				$to = date('M d, Y', strtotime($e_date));
				if (strtotime($s_date) > strtotime($e_date)) {
					$new = $from;
					$from = $to;
					$to = $new;
				}
				$this->param['from'] = $from;
				$this->param['to'] = $to;
				$this->param['days'] = $days;
			}

			// for table 2 calculation

			$ans_timet2 = timeCal2($selection3, $selection1, $t2inhour, $t2inmin, $t2inampm, $t2outhour, $t2outmin, $t2outampm, $t2in, $t2out, $t2inhourl1, $t2inminl1, $t2inampml1, $t2outhourl1, $t2outminl1, $t2outampml1, $t2inlunch1, $t2outlunch1, $t2inhourl2, $t2inminl2, $t2inampml2, $t2outhourl2, $t2outminl2, $t2outampml2, $t2inlunch2, $t2outlunch2, $t2sick_h, $t2sick_m, $t2v_h, $t2v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_timet2 === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arrt2'] = $ans_timet2[0];
				$this->param['ansl1_arrt2'] = $ans_timet2[1];
				$this->param['ansl21_arrt2'] = $ans_timet2[2];
				$this->param['ansl2_arrt2'] = $ans_timet2[3];
				$this->param['overall_timet2'] = $ans_timet2[4];
				$this->param['regular_timet2'] = $ans_timet2[5];
				$this->param['overtime2_firstt2'] = $ans_timet2[6];
				$this->param['overtime3_firstt2'] = $ans_timet2[7];
				$this->param['sick_payt2'] = $ans_timet2[8];
				$this->param['sick_timet2'] = $ans_timet2[9];
				$this->param['vacation_payt2'] = $ans_timet2[10];
				$this->param['v_timet2'] = $ans_timet2[11];
				$this->param['overtime4_firstt2'] = $ans_timet2[12];
				$this->param['overtime5_firstt2'] = $ans_timet2[13];
				$this->param['overtime6_firstt2'] = $ans_timet2[14];
				if ($selection2 == "1") {
					$dayst2 = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$dayst2 = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$dayst2 = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$dayst2 = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$dayst2 = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$fromt2 = date('M d, Y', strtotime($s2_date));
				$tot2 = date('M d, Y', strtotime($e2_date));
				if (strtotime($s2_date) > strtotime($e2_date)) {
					$newt2 = $fromt2;
					$fromt2 = $tot2;
					$tot2 = $newt2;
				}
				$this->param['fromt2'] = $fromt2;
				$this->param['tot2'] = $tot2;
				$this->param['dayst2'] = $dayst2;
			}

			// for table 3 calculation

			$ans_timet3 = timeCal3($selection3, $selection1, $t3inhour, $t3inmin, $t3inampm, $t3outhour, $t3outmin, $t3outampm, $t3in, $t3out, $t3inhourl1, $t3inminl1, $t3inampml1, $t3outhourl1, $t3outminl1, $t3outampml1, $t3inlunch1, $t3outlunch1, $t3inhourl2, $t3inminl2, $t3inampml2, $t3outhourl2, $t3outminl2, $t3outampml2, $t3inlunch2, $t3outlunch2, $t3sick_h, $t3sick_m, $t3v_h, $t3v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_timet2 === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arrt3'] = $ans_timet3[0];
				$this->param['ansl1_arrt3'] = $ans_timet3[1];
				$this->param['ansl21_arrt3'] = $ans_timet3[2];
				$this->param['ansl2_arrt3'] = $ans_timet3[3];
				$this->param['overall_timet3'] = $ans_timet3[4];
				$this->param['regular_timet3'] = $ans_timet3[5];
				$this->param['overtime2_firstt3'] = $ans_timet3[6];
				$this->param['overtime3_firstt3'] = $ans_timet3[7];
				$this->param['sick_payt3'] = $ans_timet3[8];
				$this->param['sick_timet3'] = $ans_timet3[9];
				$this->param['vacation_payt3'] = $ans_timet3[10];
				$this->param['v_timet3'] = $ans_timet3[11];
				$this->param['overtime4_firstt3'] = $ans_timet3[12];
				$this->param['overtime5_firstt3'] = $ans_timet3[13];
				$this->param['overtime6_firstt3'] = $ans_timet3[14];
				if ($selection2 == "1") {
					$dayst3 = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$dayst3 = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$dayst3 = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$dayst3 = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$dayst3 = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$fromt3 = date('M d, Y', strtotime($s3_date));
				$tot3 = date('M d, Y', strtotime($e3_date));
				if (strtotime($s3_date) > strtotime($e3_date)) {
					$newt3 = $fromt3;
					$fromt3 = $tot3;
					$tot3 = $newt3;
				}
				$this->param['fromt3'] = $fromt3;
				$this->param['tot3'] = $tot3;
				$this->param['dayst3'] = $dayst3;
			}

			// for table 4 calculation

			$ans_timet4 = timeCal4($selection3, $selection1, $t4inhour, $t4inmin, $t4inampm, $t4outhour, $t4outmin, $t4outampm, $t4in, $t4out, $t4inhourl1, $t4inminl1, $t4inampml1, $t4outhourl1, $t4outminl1, $t4outampml1, $t4inlunch1, $t4outlunch1, $t4inhourl2, $t4inminl2, $t4inampml2, $t4outhourl2, $t4outminl2, $t4outampml2, $t4inlunch2, $t4outlunch2, $t4sick_h, $t4sick_m, $t4v_h, $t4v_m, $advancedcheck, $lunch, $paid_lunch1, $paid_lunch2, $hour_rate, $overtime, $overtime_pay);
			if ($ans_timet4 === false) {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			} else {
				$this->param['ans_arrt4'] = $ans_timet4[0];
				$this->param['ansl1_arrt4'] = $ans_timet4[1];
				$this->param['ansl21_arrt4'] = $ans_timet4[2];
				$this->param['ansl2_arrt4'] = $ans_timet4[3];
				$this->param['overall_timet4'] = $ans_timet4[4];
				$this->param['regular_timet4'] = $ans_timet4[5];
				$this->param['overtime2_firstt4'] = $ans_timet4[6];
				$this->param['overtime3_firstt4'] = $ans_timet4[7];
				$this->param['sick_payt4'] = $ans_timet4[8];
				$this->param['sick_timet4'] = $ans_timet4[9];
				$this->param['vacation_payt4'] = $ans_timet4[10];
				$this->param['v_timet4'] = $ans_timet4[11];
				$this->param['overtime4_firstt4'] = $ans_timet4[12];
				$this->param['overtime5_firstt4'] = $ans_timet4[13];
				$this->param['overtime6_firstt4'] = $ans_timet4[14];
				if ($selection2 == "1") {
					$dayst4 = ["1", "2", "3", "4", "5", "6", "7"];
				} elseif ($selection2 == "2") {
					$dayst4 = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				} elseif ($selection2 == "3") {
					$dayst4 = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
				} elseif ($selection2 == "4") {
					$dayst4 = ["M", "T", "W", "T", "F", "S", "S"];
				} elseif ($selection2 == "5") {
					$dayst4 = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
				}
				$fromt4 = date('M d, Y', strtotime($s4_date));
				$tot4 = date('M d, Y', strtotime($e4_date));
				if (strtotime($s4_date) > strtotime($e4_date)) {
					$newt4 = $fromt4;
					$fromt4 = $tot4;
					$tot4 = $newt4;
				}
				$this->param['fromt4'] = $fromt4;
				$this->param['tot4'] = $tot4;
				$this->param['dayst4'] = $dayst4;
			}
		}
		$this->param['table_selection'] = $table_selection;
		// dd($this->param);
		return $this->param;
	}

	// point buy calcualtor
	public function point($request)
	{
		$racial_choice = $request->input('racial_choice');
		$strength = $request->input('strength');
		$dexerity = $request->input('dexerity');
		$intelligence = $request->input('intelligence');
		$wisdom = $request->input('wisdom');
		$charisma = $request->input('charisma');
		$constitution = $request->input('constitution');
		$choice = $request->input('choice');
		$strength1 = $request->input('strength1');
		$dexerity1 = $request->input('dexerity1');
		$intelligence1 = $request->input('intelligence1');
		$wisdom1 = $request->input('wisdom1');
		$charisma1 = $request->input('charisma1');
		$points_budget = $request->input('points_budget');
		$smallest_score = $request->input('smallest_score');
		$largest_score = $request->input('largest_score');
		$constitution1 = $request->input('constitution1');
		$s1 = $request->input('s1');
		$s2 = $request->input('s2');
		$s3 = $request->input('s3');
		$s4 = $request->input('s4');
		$s5 = $request->input('s5');
		$s6 = $request->input('s6');
		$s7 = $request->input('s7');
		$s8 = $request->input('s8');
		$s9 = $request->input('s9');
		$s10 = $request->input('s10');
		$s11 = $request->input('s11');
		$x1 = $request->input('s12');
		$x2 = $request->input('s13');
		$x3 = $request->input('s14');
		$x4 = $request->input('s15');
		$x5 = $request->input('s16');

		function calculate_sum($val1)
		{
			if ($val1 == "8") {
				$sum2 = 0;
			} elseif ($val1 == "9") {
				$sum2 = 1;
			} elseif ($val1 == "10") {
				$sum2 = 2;
			} elseif ($val1 == "11") {
				$sum2 = 3;
			} elseif ($val1 == "12") {
				$sum2 = 4;
			} elseif ($val1 == "13") {
				$sum2 = 5;
			} elseif ($val1 == "14") {
				$sum2 = 7;
			} elseif ($val1 == "15") {
				$sum2 = 9;
			} else {
				$sum2 = 0;
			}
			return $sum2;
		}

		if ($choice == "1") {
			if ($racial_choice == "39") {
				if (is_numeric($strength) && is_numeric($dexerity) && is_numeric($intelligence) && is_numeric($wisdom) && is_numeric($charisma) && is_numeric($constitution) && is_numeric($strength1) && is_numeric($dexerity1) && is_numeric($intelligence1) && is_numeric($wisdom1) && is_numeric($charisma1) && is_numeric($constitution1)) {
					if (($strength >= 3 && $strength <= 15) && ($dexerity >= 3 && $dexerity <= 15) && ($intelligence >= 3 && $intelligence <= 15) && ($wisdom >= 3 && $wisdom <= 15) && ($charisma >= 3 && $charisma <= 15) && ($constitution >= 3 && $constitution <= 15)) {
						$strength_value = calculate_sum($strength);
						$dexerity_value = calculate_sum($dexerity);
						$intelligence_value = calculate_sum($intelligence);
						$wisdom_value = calculate_sum($wisdom);
						$charisma_value = calculate_sum($charisma);
						$constitution_value = calculate_sum($constitution);
						$sum = $strength_value + $dexerity_value + $intelligence_value + $wisdom_value + $charisma_value + $constitution_value;
						$total_sum = $sum - 27;
						if ($sum > 27) {
							$this->param['error'] =  'You are ' . $total_sum . ' points over budget';
							return $this->param;
						} else {
							$this->param['strength'] = $strength;
							$this->param['dexerity'] = $dexerity;
							$this->param['constitution'] = $constitution;
							$this->param['intelligence'] = $intelligence;
							$this->param['wisdom'] = $wisdom;
							$this->param['charisma'] = $charisma;
							$this->param['strength_racial_bonus'] = $strength1;
							$this->param['charisma_racial_bonus'] = $charisma1;
							$this->param['dexerity_racial_bonus'] = $dexerity1;
							$this->param['constitution_racial_bonus'] = $constitution1;
							$this->param['intelligence_racial_bonus'] = $intelligence1;
							$this->param['wisdom_racial_bonus'] = $wisdom1;
							$this->param['strength_value'] = $strength_value;
							$this->param['dexerity_value'] = $dexerity_value;
							$this->param['intelligence_value'] = $intelligence_value;
							$this->param['wisdom_value'] = $wisdom_value;
							$this->param['charisma_value'] = $charisma_value;
							$this->param['constitution_value'] = $constitution_value;
							$this->param['RESULT'] = 1;
							return $this->param;
						}
					}
				} else {
					$this->param['error'] =  'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($strength) && is_numeric($dexerity) && is_numeric($intelligence) && is_numeric($wisdom) && is_numeric($charisma) && is_numeric($constitution)) {
					if (($strength >= 3 && $strength <= 15) && ($dexerity >= 3 && $dexerity <= 15) && ($intelligence >= 3 && $intelligence <= 15) && ($wisdom >= 3 && $wisdom <= 15) && ($charisma >= 3 && $charisma <= 15) && ($constitution >= 3 && $constitution <= 15)) {
						$strength_value = calculate_sum($strength);
						$dexerity_value = calculate_sum($dexerity);
						$intelligence_value = calculate_sum($intelligence);
						$wisdom_value = calculate_sum($wisdom);
						$charisma_value = calculate_sum($charisma);
						$constitution_value = calculate_sum($constitution);
						$devillers = (explode(".", $racial_choice));
						$strength_racial_bounus = $devillers[0];
						$dexerity_racial_bonus = $devillers[1];
						$constitution_racial_bonus = $devillers[2];
						$intelligence_racial_bonus = $devillers[3];
						$wisdom_racial_bonus = $devillers[4];
						$charisma_racial_bonus = $devillers[5];
						$sum = $strength_value + $dexerity_value + $intelligence_value + $wisdom_value + $charisma_value + $constitution_value;
						$total_sum = $sum - 27;
						if ($sum > 27) {
							$this->param['error'] =  'You are ' . $total_sum . ' points over budget';
							return $this->param;
						} else {
							$this->param['strength'] = $strength;
							$this->param['dexerity'] = $dexerity;
							$this->param['constitution'] = $constitution;
							$this->param['intelligence'] = $intelligence;
							$this->param['wisdom'] = $wisdom;
							$this->param['charisma'] = $charisma;
							$this->param['strength_racial_bonus'] = $strength_racial_bounus;
							$this->param['charisma_racial_bonus'] = $charisma_racial_bonus;
							$this->param['dexerity_racial_bonus'] = $dexerity_racial_bonus;
							$this->param['constitution_racial_bonus'] = $constitution_racial_bonus;
							$this->param['intelligence_racial_bonus'] = $intelligence_racial_bonus;
							$this->param['wisdom_racial_bonus'] = $wisdom_racial_bonus;
							$this->param['strength_value'] = $strength_value;
							$this->param['dexerity_value'] = $dexerity_value;
							$this->param['intelligence_value'] = $intelligence_value;
							$this->param['wisdom_value'] = $wisdom_value;
							$this->param['charisma_value'] = $charisma_value;
							$this->param['constitution_value'] = $constitution_value;
							$this->param['RESULT'] = 1;
							return $this->param;
						}
					} else {
						$this->param['error'] =  'The score cannot be smaller than 3 and cannot larger than 18';
						return $this->param;
					}
				} else {
					$this->param['error'] =  'Please! Check Your Input';
					return $this->param;
				}
			}
		} elseif ($choice == "2") {
			if ($racial_choice == "39") {
				if (is_numeric($strength) && is_numeric($dexerity) && is_numeric($intelligence) && is_numeric($wisdom) && is_numeric($charisma) && is_numeric($constitution) && is_numeric($smallest_score) && is_numeric($largest_score) && is_numeric($points_budget) && is_numeric($s1) && is_numeric($s2) && is_numeric($s3) && is_numeric($s4) && is_numeric($s5) && is_numeric($s6) && is_numeric($strength1) && is_numeric($dexerity1) && is_numeric($intelligence1) && is_numeric($wisdom1) && is_numeric($charisma1) && is_numeric($constitution1) && is_numeric($s7) && is_numeric($s8) && is_numeric($s9) && is_numeric($s10) && is_numeric($s11) && is_numeric($x1) && is_numeric($x2) && is_numeric($x3) && is_numeric($x4) && is_numeric($x5)) {
					if ($smallest_score >= 3 && $smallest_score <= 8 && $largest_score >= 13 && $largest_score <= 18) {
						if (($strength >= 3 && $strength <= 18) && ($dexerity >= 3 && $dexerity <= 18) && ($intelligence >= 3 && $intelligence <= 18) && ($wisdom >= 8 && $wisdom <= 18) && ($charisma >= 8 && $charisma <= 18) && ($constitution >= 8 && $constitution <= 18)) {
							function calculate_sum2($val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9, $val10, $val11, $val12, $val13, $val14, $val15, $val16, $val17)
							{
								if ($val2 == "3") {
									$sum3 = $val13;
									echo $sum3;
								} elseif ($val2 = "4") {
									$sum3 = $val14;
								} elseif ($val2 = "5") {
									$sum3 = $val15;
								} elseif ($val2 = "6") {
									$sum3 = $val16;
								} elseif ($val2 = "7") {
									$sum3 = $val17;
								} else if ($val2 == "8") {
									$sum3 = $val3;
								} else if ($val2 == "9") {
									$sum3 = $val4;
								} else if ($val2 == "10") {
									$sum3 = $val5;
								} else if ($val2 == "11") {
									$sum3 = $val6;
								} else if ($val2 == "12") {
									$sum3 = $val7;
								} else if ($val2 == "13") {
									$sum3 = $val8;
								} else if ($val2 == "14") {
									$sum3 = $val9;
								} else if ($val2 == "15") {
									$sum3 = $val10;
								} else if ($val2 == "16") {
									$sum3 = $val11;
								} else if ($val2 == "17") {
									$sum3 = $val12;
								} else if ($val2 == "18") {
									$sum3 = $val13;
								}
								return $sum3;
							}
							$strength_value = calculate_sum2($strength, $x1, $x2, $x3, $x4, $x5, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11);
							$dexerity_value = calculate_sum2($dexerity, $x1, $x2, $x3, $x4, $x5, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11);
							$intelligence_value = calculate_sum2($intelligence, $x1, $x2, $x3, $x4, $x5, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11);
							$wisdom_value = calculate_sum2($wisdom, $x1, $x2, $x3, $x4, $x5, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11);
							$charisma_value = calculate_sum2($charisma, $x1, $x2, $x3, $x4, $x5, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11);
							$constitution_value = calculate_sum2($constitution, $x1, $x2, $x3, $x4, $x5, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11);
							$sum = $strength_value + $dexerity_value + $intelligence_value + $wisdom_value + $charisma_value + $constitution_value;
							$total_minus = $sum - $points_budget;
							if ($sum > $points_budget) {
								$this->param['error'] =  'You are ' . $total_minus . ' points over budget';
								return $this->param;
							} else {
								$this->param['strength'] = $strength;
								$this->param['dexerity'] = $dexerity;
								$this->param['constitution'] = $constitution;
								$this->param['intelligence'] = $intelligence;
								$this->param['wisdom'] = $wisdom;
								$this->param['charisma'] = $charisma;
								$this->param['strength_racial_bonus'] = $strength1;
								$this->param['charisma_racial_bonus'] = $charisma1;
								$this->param['dexerity_racial_bonus'] = $dexerity1;
								$this->param['constitution_racial_bonus'] = $constitution1;
								$this->param['intelligence_racial_bonus'] = $intelligence1;
								$this->param['wisdom_racial_bonus'] = $wisdom1;
								$this->param['strength_value'] = $strength_value;
								$this->param['dexerity_value'] = $dexerity_value;
								$this->param['intelligence_value'] = $intelligence_value;
								$this->param['wisdom_value'] = $wisdom_value;
								$this->param['charisma_value'] = $charisma_value;
								$this->param['constitution_value'] = $constitution_value;
								$this->param['RESULT'] = 1;
								return $this->param;
							}
						} else {
							$this->param['error'] =  'The base ability scores cannot be small than 8 and larger than 18';
							return $this->param;
						}
					} else {
						$this->param['error'] =  'The score cannot be smaller than 3 and cannot larger than 18';
						return $this->param;
					}
				} else {
					$this->param['error'] =  'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($strength) && is_numeric($dexerity) && is_numeric($intelligence) && is_numeric($wisdom) && is_numeric($charisma) && is_numeric($constitution) && is_numeric($smallest_score) && is_numeric($largest_score) && is_numeric($points_budget)  && is_numeric($s1) && is_numeric($s2) && is_numeric($s3) && is_numeric($s4) && is_numeric($s5) && is_numeric($s6) && is_numeric($s7) && is_numeric($s8)) {
					if ($smallest_score <= $strength && $smallest_score <= $dexerity && $smallest_score <= $intelligence && $smallest_score <= $wisdom && $smallest_score <= $constitution && $smallest_score <= $charisma && $smallest_score >= 3 && $smallest_score <= 18 && $largest_score >= 3 && $largest_score <= 18 && $smallest_score != $largest_score && $largest_score > $strength && $largest_score > $dexerity && $largest_score > $charisma && $largest_score > $wisdom && $largest_score > $intelligence && $largest_score > $constitution) {
						if (($strength >= 8 && $strength <= 15) && ($dexerity >= 8 && $dexerity <= 15) && ($intelligence >= 8 && $intelligence <= 15) && ($wisdom >= 8 && $wisdom <= 15) && ($charisma >= 8 && $charisma <= 15) && ($constitution >= 8 && $constitution <= 15)) {
							function calculate_sum2($val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9, $val10)
							{
								if ($val2 == "8") {
									$sum3 = $val3;
								} else if ($val2 == "9") {
									$sum3 = $val4;
								} else if ($val2 == "10") {
									$sum3 = $val5;
								} else if ($val2 == "11") {
									$sum3 = $val6;
								} else if ($val2 == "12") {
									$sum3 = $val7;
								} else if ($val2 == "13") {
									$sum3 = $val8;
								} else if ($val2 == "14") {
									$sum3 = $val9;
								} else if ($val2 == "15") {
									$sum3 = $val10;
								}
								return $sum3;
							}
							$strength_value = calculate_sum2($strength, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8);
							$dexerity_value = calculate_sum2($dexerity, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8);
							$intelligence_value = calculate_sum2($intelligence, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8);
							$wisdom_value = calculate_sum2($wisdom, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8);
							$charisma_value = calculate_sum2($charisma, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8);
							$constitution_value = calculate_sum2($constitution, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8);
							$sum = $strength_value + $dexerity_value + $intelligence_value + $wisdom_value + $charisma_value + $constitution_value;
							$devillers = (explode(".", $racial_choice));
							$strength_racial_bounus = $devillers[0];
							$dexerity_racial_bonus = $devillers[1];
							$constitution_racial_bonus = $devillers[2];
							$intelligence_racial_bonus = $devillers[3];
							$wisdom_racial_bonus = $devillers[4];
							$charisma_racial_bonus = $devillers[5];
							$total_minus = $sum - $points_budget;
							if ($sum > $points_budget) {
								$this->param['error'] =  'You are ' . $total_minus . ' points over budget';
								return $this->param;
							} else {
								$this->param['strength'] = $strength;
								$this->param['dexerity'] = $dexerity;
								$this->param['constitution'] = $constitution;
								$this->param['intelligence'] = $intelligence;
								$this->param['wisdom'] = $wisdom;
								$this->param['charisma'] = $charisma;
								$this->param['strength_racial_bonus'] = $strength_racial_bounus;
								$this->param['charisma_racial_bonus'] = $charisma_racial_bonus;
								$this->param['dexerity_racial_bonus'] = $dexerity_racial_bonus;
								$this->param['constitution_racial_bonus'] = $constitution_racial_bonus;
								$this->param['intelligence_racial_bonus'] = $intelligence_racial_bonus;
								$this->param['wisdom_racial_bonus'] = $wisdom_racial_bonus;
								$this->param['strength_value'] = $strength_value;
								$this->param['dexerity_value'] = $dexerity_value;
								$this->param['intelligence_value'] = $intelligence_value;
								$this->param['wisdom_value'] = $wisdom_value;
								$this->param['charisma_value'] = $charisma_value;
								$this->param['constitution_value'] = $constitution_value;
								$this->param['RESULT'] = 1;
								return $this->param;
							}
						} else {
							$this->param['error'] =  'The base ability scores cannot be small than 8 and larger than 18';
							return false;
						}
					} else {
						$this->param['error'] =  'The score cannot be smaller than 3 and cannot larger than 18';
						return $this->param;
					}
				} else {
					$this->param['error'] =  'Please! Check Your Input11';
					return $this->param;
				}
			}
		}
	}

	// wallpaper calculator
	public function wallpaper($request)
	{
		$type = $request->input('type');
		$room_length = $request->input('room_length');
		$room_length_unit = $request->input('room_length_unit');
		$room_width = $request->input('room_width');
		$room_width_unit = $request->input('room_width_unit');
		$room_height = $request->input('room_height');
		$room_height_unit = $request->input('room_height_unit');
		$door_height = $request->input('door_height');
		$door_height_unit = $request->input('door_height_unit');
		$door_width = $request->input('door_width');
		$door_width_unit = $request->input('door_width_unit');
		$no_of_doors = $request->input('no_of_doors');
		$window_height = $request->input('window_height');
		$window_height_unit = $request->input('window_height_unit');
		$window_width = $request->input('window_width');
		$window_width_unit = $request->input('window_width_unit');
		$no_of_windows = $request->input('no_of_windows');
		$roll_length = $request->input('roll_length');
		$roll_length_unit = $request->input('roll_length_unit');
		$roll_width = $request->input('roll_width');
		$roll_width_unit = $request->input('roll_width_unit');
		$cost = $request->input('cost');
		$pattern = $request->input('pattern');
		$pattern_unit = $request->input('pattern_unit');
		$wall_width = $request->input('wall_width');
		$wall_width_unit = $request->input('wall_width_unit');
		$wall_height = $request->input('wall_height');
		$wall_height_unit = $request->input('wall_height_unit');
		function unit_convert($unit, $value)
		{
			if ($unit == "cm") {
				$val1 = $value * 0.01;
			} else if ($unit == "m") {
				$val1 = $value * 1;
			} else if ($unit == "in") {
				$val1 = $value * 0.0254;
			} else if ($unit == "ft") {
				$val1 = $value * 0.3048;
			} else if ($unit == "yd") {
				$val1 = $value * 0.9144;
			}
			return $val1;
		}
		if ($type == "1") {
			if (is_numeric($wall_width) && is_numeric($wall_height) && $wall_width > 0 && $wall_height > 0) {
				$wall_width_value = unit_convert($wall_width_unit, $wall_width);
				$wall_height_value = unit_convert($wall_height_unit, $wall_height);
				$wall_area = $wall_height_value * $wall_width_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($type == "2") {
			if (is_numeric($room_length) && is_numeric($room_width) && is_numeric($room_height) && $room_length > 0 && $room_width > 0 && $room_height > 0) {
				$rlv = unit_convert($room_length_unit, $room_length);
				$rwv = unit_convert($room_width_unit, $room_width);
				$wall_height_value = unit_convert($room_height_unit, $room_height);
				$wall_area = (($rlv + $rwv) + ($rlv + $rwv)) * $wall_height_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		if (is_numeric($door_height) && is_numeric($door_width) && is_numeric($no_of_doors) && $door_height > 0 && $door_height > 0 && $no_of_doors > 0) {
			$door_width_value = unit_convert($door_width_unit, $door_width);
			$door_height_value = unit_convert($door_height_unit, $door_height);
			$door_area = $door_height_value * $door_width_value * $no_of_doors;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		if (is_numeric($window_height) && is_numeric($window_width) && is_numeric($no_of_doors) && $window_height > 0 && $window_height > 0 && $no_of_doors > 0) {
			$window_width_value = unit_convert($window_width_unit, $window_width);
			$window_height_value = unit_convert($window_height_unit, $window_height);
			$window_area = $window_height_value * $window_width_value * $no_of_windows;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		if (is_numeric($roll_length) && is_numeric($roll_width) && is_numeric($pattern)) {
			$roll_width_value = unit_convert($roll_width_unit, $roll_width);
			$roll_length_value = unit_convert($roll_length_unit, $roll_length);
			$roll_area = $roll_width_value * $roll_length_value;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$adjusted_wall_area = $wall_area - $door_area - $window_area;
		$this->param['area'] = $wall_area;
		$this->param['door_area'] = $door_area;
		$this->param['window_area'] = $window_area;
		$this->param['adjusted_height'] = round($wall_height_value, 2);
		$this->param['adjusted_wall_area'] = $adjusted_wall_area;
		$this->param['number_of_rolls'] = ($adjusted_wall_area / $roll_area);
		if ($cost != "") {
			if (is_numeric($cost)) {
				$costs = $this->param['number_of_rolls'] * $cost;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['costs'] = $costs;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// price per square foot calcualtor
	public function price($request)
	{
		$calculate = $request->input('calculate');
		$pp = $request->input('pp');
		$area_measure = $request->input('area_measure');
		$area_measure_unit = $request->input('area_measure_unit');
		$pp1 = $request->input('pp1');
		$area_measure1 = $request->input('area_measure1');
		$area_measure_unit1 = $request->input('area_measure_unit1');
		$pp2 = $request->input('pp2');
		$area_measure2 = $request->input('area_measure2');
		$area_measure_unit2 = $request->input('area_measure_unit2');
		$compare = $request->input('compare');
		$compare2 = $request->input('compare2');
		$pp_unit = $request->input('pp_unit');
		$pp1_unit = $request->input('pp1_unit');
		$pp2_unit = $request->input('pp2_unit');

		function unitconver($val1, $val2)
		{
			if ($val2 == 'ft²') {
				$funval = $val1 * 1;
			} else if ($val2 == 'm²') {
				$funval = $val1 * 10.764;
			} else if ($val2 == 'in²') {
				$funval = $val1 * 0.006944;
			} else {
				$funval = $val1 * 9;
			}
			return $funval;
		}

		if ($calculate == "1" || $calculate == "2" || $calculate == "3") {
			if (is_numeric($pp) && is_numeric($area_measure)) {
				if ($area_measure > 0) {
					$am = unitconver($area_measure, $area_measure_unit);
					if ($calculate == "1" || $calculate == "2") {
						$res = $pp / $am;
					} else if ($calculate == "3") {
						$res = $pp * $am;
					}
				} else {
					$this->param['error'] = 'Square Footage must greater be zero';
					return $this->param;
				}
				$this->param['pp_unit'] = $pp_unit;
			} else {
				$this->param['error'] = 'Please! Check Input';
				return $this->param;
			}
		}
		if ($compare == "2") {
			if ($calculate == "1" || $calculate == "2" || $calculate == "3") {
				if (is_numeric($pp1) && is_numeric($area_measure1)) {
					if ($area_measure1 > 0) {
						$am1 = unitconver($area_measure1, $area_measure_unit1);
						if ($calculate == "1" || $calculate == "2") {
							$res1 = $pp1 / $am1;
						} else if ($calculate == "3") {
							$res1 = $pp1 * $am1;
						}
						$this->param['pp1_unit'] = $pp1_unit;
						$this->param['res1'] = $res1;
						$this->param['compare'] = $compare;
					} else {
						$this->param['error'] = 'Square Footage must greater be zero';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Input';
					return $this->param;
				}
			}
		}
		if ($compare2 == "2") {
			if ($calculate == "1" || $calculate == "2" || $calculate == "3") {
				if (is_numeric($pp2) && is_numeric($area_measure2)) {
					if ($area_measure2 > 0) {
						$am2 = unitconver($area_measure2, $area_measure_unit2);
						if ($calculate == "1" || $calculate == "2") {
							$res2 = $pp2 / $am2;
						} else if ($calculate == "3") {
							$res2 = $pp2 * $am2;
						}
						$this->param['pp2_unit'] = $pp2_unit;
						$this->param['res2'] = $res2;
						$this->param['compare2'] = $compare2;
					} else {
						$this->param['error'] = 'Square Footage must greater be zero';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Input';
					return $this->param;
				}
			}
		}
		$this->param['res'] = $res;
		$this->param['calculate'] = $calculate;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// CBM Caluclator
	public function cbm($request)
	{
		$type       = $request->input('type');
		$width      = $request->input('width');
		$width_unit = $request->input('width_unit');
		$length     = $request->input('length');
		$length_unit = $request->input('length_unit');
		$heigth     = $request->input('heigth');
		$heigth_unit = $request->input('heigth_unit');
		$quantity   = $request->input('quantity');
		$weight     = $request->input('weight');
		$weight_unit = $request->input('weight_unit');

		function convert_to_cm($unit, $value)
		{
			if ($unit == 'm') {
				$ans = $value * 100;
			} elseif ($unit == 'mm') {
				$ans = $value / 10;
			} elseif ($unit == 'cm') {
				$ans = $value;
			} elseif ($unit == 'km') {
				$ans = $value * 100000;
			} elseif ($unit == 'in') {
				$ans = $value * 2.54;
			} elseif ($unit == 'ft') {
				$ans = $value * 30.48;
			} elseif ($unit == 'yd') {
				$ans = $value * 91.44;
			} elseif ($unit == 'mi') {
				$ans = $value * 160934;
			}
			return $ans;
		}
		function convert_to_meter($unit, $value)
		{
			if ($unit == 'cm') {
				$ans = $value / 100;
			} elseif ($unit == 'mm') {
				$ans = $value / 1000;
			} elseif ($unit == 'm') {
				$ans = $value;
			} elseif ($unit == 'km') {
				$ans = $value * 1000;
			} elseif ($unit == 'in') {
				$ans = $value / 39.37;
			} elseif ($unit == 'ft') {
				$ans = $value /  3.281;
			} elseif ($unit == 'yd') {
				$ans = $value / 1.094;
			} elseif ($unit == 'mi') {
				$ans = $value * 1609;
			}
			return $ans;
		}
		function convert_to_kg($unit, $value)
		{
			if ($unit == 'ug') {
				$ans = $value / 1000000000;
			} elseif ($unit == 'mg') {
				$ans = $value / 1000000;
			} elseif ($unit == 'g') {
				$ans = $value / 1000;
			} elseif ($unit == 'dag') {
				$ans = $value / 100;
			} elseif ($unit == 'lb') {
				$ans = $value /  2.205;
			} elseif ($unit == 'kg') {
				$ans = $value;
			} elseif ($unit == 't') {
				$ans = $value * 1000;
			} elseif ($unit == 'gr') {
				$ans = $value / 15432;
			} elseif ($unit == 'dr') {
				$ans = $value / 295;
			} elseif ($unit == 'oz') {
				$ans = $value / 35.274;
			} elseif ($unit == 'stone') {
				$ans = $value * 6.35;
			} elseif ($unit == 'us-ton') {
				$ans = $value * 907.2;
			} elseif ($unit == 'long-ton') {
				$ans = $value * 1016;
			} elseif ($unit == 'earths') {
				$ans = $value * 5972000000000000000000000;
			} elseif ($unit == 'me') {
				$ans = $value *  1098000000000000000000000000000;
			} elseif ($unit == 'u') {
				$ans = $value * 602200000000000000000000000;
			} elseif ($unit == 'oz-t') {
				$ans = $value / 32.151;
			}
			return $ans;
		}
		if (is_numeric($width) && is_numeric($length) && is_numeric($heigth) && is_numeric($quantity)) {
			$width_m = convert_to_meter($width_unit, $width);
			$length_m = convert_to_meter($length_unit, $length);
			$heigth_m = convert_to_meter($heigth_unit, $heigth);

			if ($type == 'basic') {
				$cbm = ($width_m * $length_m * $heigth_m) * $quantity;
				$this->param['cbm'] = number_format($cbm, 2);

				return $this->param;
			} elseif ($type == 'advance') {
				if (is_numeric($weight)) {
					$width_cm = convert_to_cm($width_unit, $width);
					$length_cm = convert_to_cm($length_unit, $length);
					$heigth_cm = convert_to_cm($heigth_unit, $heigth);
					$weight_kg = convert_to_kg($weight_unit, $weight);
					$cbm = $width_m * $length_m * $heigth_m;
					$total_cbm = $cbm * $quantity;
					$total_weight = $weight_kg * $quantity;
					$volumetric_weight = $width_cm * $length_cm * $heigth_cm / 5000;
					$total_volumetric_weight = $volumetric_weight *  $quantity;
					$size_20 = floor(33.2 / $cbm);
					$size_40 = floor(67.67 / $cbm);
					$size_40_hq = floor(76.3 / $cbm);
					$size_45_hq = floor(88.4 / $cbm);

					$this->param['cbm']    = number_format($cbm, 2);
					$this->param['total_cbm']    = number_format($total_cbm, 2);
					$this->param['total_weight']    = number_format($total_weight, 2);
					$this->param['total_volumetric_weight'] = number_format($total_volumetric_weight, 2);
					$this->param['size_20'] = $size_20;
					$this->param['size_40'] = $size_40;
					$this->param['size_40_hq'] = $size_40_hq;
					$this->param['size_45_hq'] = $size_45_hq;

					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Desk Height Calculator
	public function desk($request)
	{

		//  dd($request->all());
		$units = $request->input('units');
		$height = $request->input('height');
		$height2 = $request->input('height2');
		$position = $request->input('position');
		if ($units == "Centimeters") {
			$unit = 2.54;
			$height = $height;
		} else if ($units == "Feet and Inches") {
			$unit = 1;
			$height = $height2;
		}
		$seat_min = 0.3219306 * $height / 2.54 - 5.312559;
		$seat_max = 0.2715447 * $height / 2.54 - 0.1796748;
		$table_min = 0.4739837 * $height / 2.54 - 6.677846;
		$table_max = 0.5528455 * $height / 2.54 - 9.427033;
		$monitor_min = 0.7248521 * $height / 2.54 - 1.95858;
		$monitor_max = 0.7376726 * $height / 2.54 - 1.21499;
		$table_min_standing = 0.6005917 * $height / 2.54 + 0.02662722;
		$table_max_standing = 0.6656805 * $height / 2.54 - 1.044379;
		$monitor_min_standing = 0.9674556 * $height / 2.54 - 2.464497;
		$monitor_max_standing = 0.9349112 * $height / 2.54 + 1.071006;
		if ($position == "0") {
			$ans1 = round($seat_min * $unit * 2) / 2 . ' - ' . round($seat_max * $unit * 2) / 2;
			$ans2 = round($table_min * $unit * 2) / 2 . ' - ' . round($table_max * $unit * 2) / 2;
			$ans3 = round($monitor_min * $unit * 2) / 2 . ' - ' . round($monitor_max * $unit * 2) / 2;
		} else if ($position == "1") {
			$ans1 = "";
			$ans2 = (round($table_min_standing * $unit * 2) / 2) . " - " . (round($table_max_standing * $unit * 2) / 2);
			$ans3 = round($monitor_min_standing * $unit * 2) / 2 . ' - ' . round($monitor_max_standing * $unit * 2) / 2;
		}
		$this->param['units'] = $units;
		$this->param['position'] = $position;
		$this->param['ans1'] = $ans1;
		$this->param['ans2'] = $ans2;
		$this->param['ans3'] = $ans3;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Time Span Calculator
	public function timespan($request)
	{
		$clock_format = $request->input('clock_format');
		$s_hour       = $request->input('s_hour');
		$s_min        = $request->input('s_min');
		$s_sec        = $request->input('s_sec');
		$s_ampm       = $request->input('s_ampm');
		$e_hour       = $request->input('e_hour');
		$e_min        = $request->input('e_min');
		$e_sec        = $request->input('e_sec');
		$e_ampm       = $request->input('e_ampm');

		if (is_numeric($s_hour) && is_numeric($s_min) && is_numeric($s_sec) && is_numeric($e_hour) && is_numeric($e_min) && is_numeric($e_sec)) {
			if ($clock_format == 12) {
				$first  = new Carbon($s_hour . ':' . $s_min . ':' . $s_sec . '' . $s_ampm);
				$second = new Carbon($e_hour . ':' . $e_min . ':' . $e_sec . '' . $e_ampm);
				$difference = $first->diff($second);

				if (isset($s_ampm) && isset($e_ampm)) {
					if ($s_ampm == 'pm' && $e_ampm == 'am') {
						$hours12 = '-' . $difference->h;
						$min12   = $difference->i;
						$sec12   = $difference->s;

						$hours21 = $difference->h;
						$min21   = $difference->i;
						$sec21   = $difference->s;
					} else if ($s_ampm == 'pm' && $e_ampm == 'pm') {
						if ($s_hour > $e_hour) {
							$hours12 = '-' . $difference->h;
							$min12   = $difference->i;
							$sec12   = $difference->s;

							$hours21 = $difference->h;
							$min21   = $difference->i;
							$sec21   = $difference->s;
						} else {
							$hours12 = $difference->h;
							$min12   = $difference->i;
							$sec12   = $difference->s;

							$hours21 = '-' . $difference->h;
							$min21   = $difference->i;
							$sec21   = $difference->s;
						}
					} else if ($s_ampm == 'am' && $e_ampm == 'am') {
						if ($s_hour < $e_hour) {
							$hours12 = '-' . $difference->h;
							$min12   = $difference->i;
							$sec12   = $difference->s;

							$hours21 = $difference->h;
							$min21   = $difference->i;
							$sec21   = $difference->s;
						} else {
							$hours12 = $difference->h;
							$min12   = $difference->i;
							$sec12   = $difference->s;

							$hours21 = '-' . $difference->h;
							$min21   = $difference->i;
							$sec21   = $difference->s;
						}
					} else {
						$hours12 = $difference->h;
						$min12   = $difference->i;
						$sec12   = $difference->s;

						$hours21 = '-' . $difference->h;
						$min21   = $difference->i;
						$sec21   = $difference->s;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				$first  = new Carbon($s_hour . ':' . $s_min . ':' . $s_sec);
				$second = new Carbon($e_hour . ':' . $e_min . ':' . $e_sec);
				$difference = $first->diff($second);

				if ($s_hour < $e_hour) {
					$hours12 = '-' . $difference->h;
					$min12   = $difference->i;
					$sec12   = $difference->s;

					$hours21 = $difference->h;
					$min21   = $difference->i;
					$sec21   = $difference->s;
				} else {
					$hours12 = $difference->h;
					$min12   = $difference->i;
					$sec12   = $difference->s;

					$hours21 = '-' . $difference->h;
					$min21   = $difference->i;
					$sec21   = $difference->s;
				}
			}

			if ($hours12 < 0) {
				$new_hours12 = abs($hours12);

				$over_night12    = (86400 - ($new_hours12 * 3600) + ($min12 * 60) + $sec12);
				$over_night12_h  = $over_night12 / 3600;
				$over_night12_m  = $over_night12 / 60;
				$over_night12_s  = $over_night12;

				$midnight_hours12 = explode('.', $over_night12_h)[0];
				$midnight_min12   = explode('.', $over_night12_m)[0] - ($midnight_hours12 * 60);
				$midnight_sec12   = ($over_night12_s - ($midnight_hours12 * 3600) - ($midnight_min12 * 60));
			} else {
				$over_night12    = (86400 + ($hours12 * 3600) + ($min12 * 60) + $sec12);
				$over_night12_h  = $over_night12 / 3600;
				$over_night12_m  = $over_night12 / 60;
				$over_night12_s  = $over_night12;

				$midnight_hours12 = explode('.', $over_night12_h)[0];
				$midnight_min12   = explode('.', $over_night12_m)[0] - ($midnight_hours12 * 60);
				$midnight_sec12   = ($over_night12_s - ($midnight_hours12 * 3600) - ($midnight_min12 * 60));
			}

			if ($hours21 < 0) {
				$new_hours21 = abs($hours21);

				$over_night21    = (86400 - ($new_hours21 * 3600) + ($min21 * 60) + $sec21);
				$over_night21_h  = $over_night21 / 3600;
				$over_night21_m  = $over_night21 / 60;
				$over_night21_s  = $over_night21;

				$midnight_hours21 = explode('.', $over_night21_h)[0];
				$midnight_min21   = explode('.', $over_night21_m)[0] - ($midnight_hours21 * 60);
				$midnight_sec21   = ($over_night21_s - ($midnight_hours21 * 3600) - ($midnight_min21 * 60));
			} else {
				$over_night21    = (86400 + ($hours21 * 3600) + ($min21 * 60) + $sec21);
				$over_night21_h  = $over_night21 / 3600;
				$over_night21_m  = $over_night21 / 60;
				$over_night21_s  = $over_night21;

				$midnight_hours21 = explode('.', $over_night21_h)[0];
				$midnight_min21   = explode('.', $over_night21_m)[0] - ($midnight_hours21 * 60);
				$midnight_sec21   = ($over_night21_s - ($midnight_hours21 * 3600) - ($midnight_min21 * 60));
			}

			$first_to_second            = sprintf("%02d", $hours12) . ':' . sprintf("%02d", $min12) . ':' . sprintf("%02d", $sec12);
			$first_to_second_over_night = sprintf("%02d", $midnight_hours12) . ':' . sprintf("%02d", $midnight_min12) . ':' . sprintf("%02d", $midnight_sec12);
			$second_to_first            = sprintf("%02d", $hours21) . ':' . sprintf("%02d", $min21) . ':' . sprintf("%02d", $sec21);
			$second_to_first_over_night = sprintf("%02d", $midnight_hours21) . ':' . sprintf("%02d", $midnight_min21) . ':' . sprintf("%02d", $midnight_sec21);

			$this->param['first_to_second']            = $first_to_second;
			$this->param['first_to_second_over_night'] = $first_to_second_over_night;
			$this->param['second_to_first']            = $second_to_first;
			$this->param['second_to_first_over_night'] = $second_to_first_over_night;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Stud Calculator
	public function stud($request)
	{
		$want                    = $request->input('want');
		$wall_end_stud           = $request->input('wall_end_stud');
		$wall_on                 = $request->input('wall_on');
		$hight                   = $request->input('hight');
		$hight_unit              = $request->input('hight_unit');
		$length                  = $request->input('length');
		$length_unit             = $request->input('length_unit');
		$stud_spacing            = $request->input('stud_spacing');
		$stud_spacing_unit       = $request->input('stud_spacing_unit');
		$stud_width              = $request->input('stud_width');
		$stud_width_unit         = $request->input('stud_width_unit');
		$rim_joist_width         = $request->input('rim_joist_width');
		$rim_joist_width_unit    = $request->input('rim_joist_width_unit');
		$subfloor_thickness      = $request->input('subfloor_thickness');
		$subfloor_thickness_unit = $request->input('subfloor_thickness_unit');
		$estimated_waste         = $request->input('estimated_waste');
		$stud_price              = $request->input('stud_price');

		function convert_to_in($unit, $value)
		{
			if ($unit == 'in') {
				$ans = $value;
			} elseif ($unit == 'cm') {
				$ans = $value / 2.54;
			} elseif ($unit == 'ft') {
				$ans = $value * 12;
			}
			return $ans;
		}

		if (!empty($want) && is_numeric($wall_end_stud) && is_numeric($hight) && is_numeric($length) && is_numeric($stud_spacing)) {
			$length_in       = convert_to_in($length_unit, $length);
			$hight_in        = convert_to_in($hight_unit, $hight);
			$stud_spacing_in = convert_to_in($stud_spacing_unit, $stud_spacing);

			$studs       = ceil(($length_in / $stud_spacing_in) + 1 + $wall_end_stud);
			$studs_cost  = $studs * $stud_price;
			$total_cost  = $studs_cost + ($studs_cost * $estimated_waste / 100);


			$finished_length_of_studs = number_format(($hight_in - (2 * 2.75)) / 12, 2);

			$wall_area    = $hight_in * $length_in;
			$wall_area_ft = $wall_area / 144;

			$lumber8  = ceil(($length_in / 12) / 8);
			$lumber10 = ceil(($length_in / 12) / 10);
			$lumber12 = ceil(($length_in / 12) / 12);

			if ($want == 'sheet' || $want == 'all') {
				if (is_numeric($rim_joist_width) && is_numeric($subfloor_thickness)) {
					$rim_joist_width_in    = convert_to_in($rim_joist_width_unit, $rim_joist_width);
					$subfloor_thickness_in = convert_to_in($subfloor_thickness_unit, $subfloor_thickness);
					$extra                 = (($rim_joist_width_in + $subfloor_thickness_in) * $length_in) / 144;
					$sheets_req            = round(($wall_area_ft + $extra) / 32, 3);

					$this->param['sheets_req'] = $sheets_req;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}

			if ($want == 'board' || $want == 'all') {
				if (is_numeric($stud_width)) {
					$stud_width_in = convert_to_in($stud_width_unit, $stud_width);
					$board_footage = ($stud_width_in * 96) / 12;

					$this->param['board_footage'] = $board_footage;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}

			$this->param['studs'] 				  	 = $studs;
			$this->param['total_cost'] 				 = $total_cost;
			$this->param['finished_length_of_studs'] = $finished_length_of_studs;
			$this->param['wall_area_ft'] 			 = $wall_area_ft;
			$this->param['lumber8'] 				 = $lumber8;
			$this->param['lumber10'] 				 = $lumber10;
			$this->param['lumber12'] 				 = $lumber12;
			$this->param['RESULT'] 		             = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Plant Spacing Calculator
	public function plant($request)
	{
		$bed                = $request->input('bed');
		$grid               = $request->input('grid');
		$hedgerows          = $request->input('hedgerows');
		$length             = $request->input('length');
		$length_unit        = $request->input('length_unit');
		$width              = $request->input('width');
		$width_unit         = $request->input('width_unit');
		$want               = $request->input('want');
		$border             = $request->input('border');
		$border_unit        = $request->input('border_unit');
		$plant_spacing      = $request->input('plant_spacing');
		$plant_spacing_unit = $request->input('plant_spacing_unit');
		$row_spacing        = $request->input('row_spacing');
		$row_spacing_unit   = $request->input('row_spacing_unit');
		$hedge              = $request->input('hedge');
		$hedge_unit         = $request->input('hedge_unit');
		$total_plants       = $request->input('total_plants');
		$total_rows         = $request->input('total_rows');
		$no_of_plant        = $request->input('no_of_plant');
		$plant_price        = $request->input('plant_price');

		function convert_to_meter($unit, $value)
		{
			if ($unit == 'cm') {
				$ans = $value / 100;
			} elseif ($unit == 'm') {
				$ans = $value;
			} elseif ($unit == 'in') {
				$ans = $value / 39.37;
			} elseif ($unit == 'ft') {
				$ans = $value /  3.281;
			} elseif ($unit == 'yd') {
				$ans = $value /  1.094;
			} elseif ($unit == 'dm') {
				$ans = $value / 10;
			}
			return $ans;
		}

		if (is_numeric($no_of_plant) && is_numeric($plant_price)) {
			$total_plant_cost = $no_of_plant * $plant_price;

			$this->param['total_plant_cost'] = $total_plant_cost;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		if ($bed == 'grid') {
			if ($grid == 'square' || $grid == 'rectangular' || $grid == 'triangular') {
				if (is_numeric($length) && is_numeric($width) && is_numeric($border)) {
					$length_m        = convert_to_meter($length_unit, $length);
					$width_m         = convert_to_meter($width_unit, $width);
					$border_m        = convert_to_meter($border_unit, $border);
					$area            = $length_m * $width_m;

					if ($grid == 'square') {
						if (is_numeric($plant_spacing) && $plant_spacing != 0) {
							$plant_spacing_m = convert_to_meter($plant_spacing_unit, $plant_spacing);
							// $plant_rows 	 =  ceil(($length_m - ($border_m * 2)) / $plant_spacing_m);
							if ($plant_spacing_m != 0) {
								$plant_rows = ceil(($length_m - ($border_m * 2)) / $plant_spacing_m);
							} else {
								$plant_rows = 0; // Assign a fallback value or handle the error
							}

							if ($plant_spacing_m != 0) {
								$plant_cols = ceil(($width_m - ($border_m * 2)) / $plant_spacing_m);
							} else {
								$plant_cols = 0; // Assign a fallback value or handle the error
							}


							// $plant_cols 	 = ceil(($width_m -  ($border_m * 2)) / $plant_spacing_m);




							$plants     	 = $plant_rows * $plant_cols;

							$this->param['plant_rows'] = $plant_rows;
							$this->param['plant_cols'] = $plant_cols;
							$this->param['plants']     = $plants;
							return $this->param;
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					} else if ($grid == 'triangular') {
						if (is_numeric($plant_spacing) && $plant_spacing != 0) {
							$plant_spacing_m = convert_to_meter($plant_spacing_unit, $plant_spacing);
							$row_spacing     = $plant_spacing_m * 0.866;
							// $odd_num_plant   = floor(($length_m - ($border_m * 2)) / $plant_spacing_m);
							if ($plant_spacing_m != 0) {
								$odd_num_plant = floor(($length_m - ($border_m * 2)) / $plant_spacing_m);
							} else {
								$odd_num_plant = 0; // Assign a fallback value
							}

							// $evn_num_plant   = floor((($length_m - ($border_m * 2)) - ($plant_spacing_m * 0.5)) / $plant_spacing_m);

							if ($plant_spacing_m != 0) {
								$evn_num_plant = floor((($length_m - ($border_m * 2)) - ($plant_spacing_m * 0.5)) / $plant_spacing_m);
							} else {
								$evn_num_plant = 0; // Assign a fallback value
							}

							// $total_rows      = round(((($width_m - ($border_m * 2)) - $plant_spacing_m) / $row_spacing) + 1);

							if ($row_spacing != 0) {
								$total_rows = round(((($width_m - ($border_m * 2)) - $plant_spacing_m) / $row_spacing) + 1);
							} else {
								$total_rows = 0; // Assign a fallback value
							}


							$evn_rows        = floor($total_rows / 2);
							$odd_rows        = floor($total_rows - $evn_rows);
							$total_plants    = $evn_num_plant * $evn_rows + $odd_num_plant * $odd_rows;

							$this->param['total_plants'] 	= $total_plants;
							$this->param['total_rows']   	= $total_rows;
							$this->param['row_spacing']  	= round($row_spacing, 4);
							$this->param['plant_spacing_m'] = round($plant_spacing_m, 4);
							$this->param['evn_rows']     	= $evn_rows;
							$this->param['odd_rows']     	= $odd_rows;
							$this->param['odd_num_plant']	= $odd_num_plant;
							$this->param['evn_num_plant']	= $evn_num_plant;
							return $this->param;
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					} else if ($grid == 'rectangular') {
						if ($want == 'amount') {
							if (is_numeric($row_spacing) && is_numeric($plant_spacing) && $plant_spacing != 0) {
								$plant_spacing_m = convert_to_meter($plant_spacing_unit, $plant_spacing);
								$row_spacing_m   = convert_to_meter($row_spacing_unit, $row_spacing);
								// $plant_rows 	 =  ceil(($length_m - ($border_m * 2)) / $row_spacing_m);
								if ($row_spacing_m != 0) {
									$plant_rows = ceil(($length_m - ($border_m * 2)) / $row_spacing_m);
								} else {
									$plant_rows = 0; // Assign a fallback value
								}

								// $plant_cols 	 = ceil(($width_m -  ($border_m * 2)) / $plant_spacing_m);
								if ($plant_spacing_m != 0) {
									$plant_cols = ceil(($width_m - ($border_m * 2)) / $plant_spacing_m);
								} else {
									$plant_cols = 0; // Assign a fallback value or handle the case
								}

								$plants     	 = $plant_rows * $plant_cols;

								$this->param['plant_rows'] = $plant_rows;
								$this->param['plant_cols'] = $plant_cols;
								$this->param['plants'] 	   = $plants;
								return $this->param;
							} else {
								$this->param['error'] = 'Please! Check Your Input';
								return $this->param;
							}
						} else if ($want == 'arrange') {
							if (is_numeric($total_rows) && is_numeric($total_plants)) {
								$cols          = $total_plants / $total_rows;
								$row_space     =  ($length_m - ($border_m * 2)) / $total_rows;
								$plant_spacing = ($width_m -  ($border_m * 2)) / $cols;

								$this->param['cols']          = $cols;
								$this->param['row_space']     = round($row_space, 4);
								$this->param['plant_spacing'] = round($plant_spacing, 4);
								return $this->param;
							} else {
								$this->param['error'] = 'Please! Check Your Input';
								return $this->param;
							}
						}
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else {
			if ($want == 'amount') {
				if (is_numeric($hedge) && is_numeric($plant_spacing) && is_numeric($hedgerows)) {
					$plant_spacing_m = convert_to_meter($plant_spacing_unit, $plant_spacing);
					$hedge_m         = convert_to_meter($hedge_unit, $hedge);
					// $plant_per_row   = $hedge_m / $plant_spacing_m;
					if ($plant_spacing_m != 0) {
						$plant_per_row = $hedge_m / $plant_spacing_m;
					} else {
						$plant_per_row = 0; // Assign a fallback value
					}

					$total_plants    = round($plant_per_row * $hedgerows);

					$this->param['total_plants'] = $total_plants;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($hedge) && is_numeric($total_plants) && is_numeric($hedgerows)) {
					$hedge_m       = convert_to_meter($hedge_unit, $hedge);
					$plant_space   = $hedge_m / $total_plants;
					$plant_per_row = round($total_plants / $hedgerows);

					$this->param['plant_space']   = $plant_space;
					$this->param['plant_per_row'] = $plant_per_row;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
	}

	// Hourly to Salary Calculator
	public function hourly($request)
	{
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$car = $request->input('car');
		if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
			$annuly  =	$first * $second * $third;
			$weekly  = $first * $second;
			$monthly = $annuly / 12;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return  $this->param;
		}
		$this->param['annuly']	= $annuly;
		$this->param['weekly'] 	= $weekly;
		$this->param['monthly'] = $monthly;
		$this->param['car'] 	= $car;
		$this->param['RESULT'] 	= 1;
		return  $this->param;
	}

	// Salary to Hourly Calculator
	function salary($request)
	{
		$salary          	= $request->input('salary');
		$hweek           	= $request->input('hweek');
		$hyear				= $request->input('hyear');
		$type            	= $request->input('type');
		$currency           = $request->input('currency');
		if (is_numeric($salary) && is_numeric($hweek) && is_numeric($hyear) && !empty($type)) {
			if ($currency == '$') {
				$median_sal = 53924;
				$name = 'Of US Median';
			} else if ($currency == '£') {
				$median_sal = 31285;
				$name = 'Of UK Median';
			} else {
				$median_sal = 53924;
				$name = '';
			}
			if ($hweek > 0 && $hyear > 0 && $salary > 0) {
				if ($type == 'an') {
					$weekly_rate = ($salary / $hyear);
					$hourly_rate = ($weekly_rate / $hweek);
					$monthaly_rate = ($salary / 12);
					$mean = ($salary / $median_sal) * 100;
				} elseif ($type == 'mo') {
					$monthaly_rate = $salary;
					$hourly_rate = (($monthaly_rate * 12) / $hyear) / $hweek;
					$weekly_rate = ($hourly_rate * $hweek);
					$mean = ($salary / $median_sal) * 100;
				} elseif ($type == 'we') {
					$weekly_rate = $salary;
					$hourly_rate = $weekly_rate / $hweek;
					$monthaly_rate = (($hourly_rate * $hyear) * $hweek) / 12;
					$mean = ($salary / $median_sal) * 100;
				} elseif ($type == 'da') {
					$hourly_rate = $salary / ($hweek / 5);
					$weekly_rate = $hourly_rate * $hweek;
					$monthaly_rate = (($hourly_rate * $hyear) * $hweek) / 12;
					$mean = ($salary / $median_sal) * 100;
				}
			} else {
				$this->param['error'] = 'Please! Enter the Correct Value';
				return $this->param;
			}
			$this->param['hourly_rate']			= $hourly_rate;
			$this->param['weekly_rate'] 	  	= $weekly_rate;
			$this->param['monthaly_rate'] 	  = $monthaly_rate;
			$this->param['mean'] = $mean;
			$this->param['name'] = $name;
			$this->param['currency'] = $currency;
			$this->param['RESULT'] 	  = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// AC BTU Calculator
	public function ac($request)
	{
		$calculate            = $request->input('calculate');
		$height               = $request->input('height');
		$height_unit          = $request->input('height_unit');
		$width                = $request->input('width');
		$width_unit           = $request->input('width_unit');
		$length               = $request->input('length');
		$length_unit          = $request->input('length_unit');
		$temperature          = $request->input('temperature');
		$temperature_unit     = $request->input('temperature_unit');
		$peoples              = $request->input('peoples');
		$type                 = $request->input('type');
		$insulation_condition = $request->input('insulation_condition');
		$sun_exposure         = $request->input('sun_exposure');
		$climate              = $request->input('climate');
		function convert_to_ft($unit, $value)
		{
			if ($unit == 'm') {
				$ans = $value * 3.281;
			} else {
				$ans = $value;
			}
			return $ans;
		}

		if (is_numeric($height) && is_numeric($width) && is_numeric($length) && !empty($insulation_condition)) {
			$height_ft = convert_to_ft($height_unit, $height);
			$width_ft  = convert_to_ft($width_unit, $width);
			$length_ft = convert_to_ft($length_unit, $length);
			$area = $width_ft * $length_ft;

			if ($calculate == "ac") {
				if ($area <= 150) {
					$btu = 5000;
				} else if ($area > 150 && $area <= 250) {
					$btu = 6000;
				} else if ($area > 250 && $area <= 300) {
					$btu = 7000;
				} else if ($area > 300 && $area <= 350) {
					$btu = 8000;
				} else if ($area > 350 && $area <= 400) {
					$btu = 9000;
				} else if ($area > 400 && $area <= 450) {
					$btu = 10000;
				} else if ($area > 450 && $area <= 550) {
					$btu = 12000;
				} else if ($area > 550 && $area <= 700) {
					$btu = 14000;
				} else if ($area > 700 && $area <= 1000) {
					$btu = 18000;
				} else if ($area > 1000 && $area <= 1200) {
					$btu = 21000;
				} else if ($area > 1400 && $area <= 1500) {
					$btu = 24000;
				} else if ($area > 1500 && $area <= 2000) {
					$btu = 30000;
				} else if ($area > 2000 && $area <= 2500) {
					$btu = 34000;
				} else {
					$btu = $area * 20;
				}

				$total_btu = $btu;

				if ($height_ft > 8) {
					$extra_ft    = $height_ft - 8;
					$total_btu   = $total_btu + ($extra_ft * 1000);
				}

				if (!empty($type) && !empty($sun_exposure) && !empty($climate) && is_numeric($peoples)) {

					if ($peoples > 2) {
						$extra_peoples = $peoples - 2;
						$total_btu     = $total_btu + ($extra_peoples * 600);
					}

					if ($type == 'living-room') {
						$total_btu = $total_btu + 1000;
					} else if ($type == 'kitchen') {
						$total_btu = $total_btu + 4000;
					} else if ($type == 'above-floor') {
						$total_btu = $total_btu + ($btu * 0.10);
					}

					if ($insulation_condition == "good") {
						$total_btu = $total_btu - ($btu * 0.20);
					} else if ($insulation_condition == "poor") {
						$total_btu = $total_btu + ($btu * 0.20);
					} else {
						$total_btu = $total_btu;
					}

					if ($sun_exposure == "shaded") {
						$total_btu = $total_btu - ($btu * 0.10);
					} else if ($sun_exposure == "sunny") {
						$total_btu = $total_btu + ($btu * 0.10);
					} else {
						$total_btu = $total_btu;
					}

					if ($climate == "cold") {
						$total_btu = $total_btu - ($btu * 0.15);
					} else if ($climate == "hot") {
						$total_btu = $total_btu + ($btu * 0.20);
					} else {
						$total_btu = $total_btu;
					}
				} else {
					$this->param['error'] =  'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (!empty($temperature)) {
					if ($temperature_unit == "cel") {
						$temperature_f = ($temperature * 9 / 5) + 32;
					} else {
						$temperature_f = $temperature;
					}

					$final_temp = abs($temperature_f - 30);

					$btu       = ($area * $height_ft) * $final_temp * 0.135;
					$total_btu = $btu;

					if ($insulation_condition == "good") {
						$total_btu = $total_btu - ($btu * 0.40);
					} else if ($insulation_condition == "poor") {
						$total_btu = $btu * 2.1;
					} else {
						$total_btu = $total_btu;
					}
				} else {
					$this->param['error'] =  'Please! Check Your Input';
					return $this->param;
				}
			}

			$ton       = number_format($total_btu / 12000, 2);
			$watts     = number_format($total_btu * 0.29307107017222, 2);
			$kilowatts = number_format($total_btu * 0.00029307107017222, 2);
			$hp_i      = number_format($total_btu * 0.0003930147789222, 2);
			$hp_e      = number_format($total_btu * 0.0003930147789222, 2);

			$this->param['ton'] 	  = $ton;
			$this->param['watts'] 	  = $watts;
			$this->param['kilowatts'] = $kilowatts;
			$this->param['hp_i'] 	  = $hp_i;
			$this->param['hp_e'] 	  = $hp_e;
			$this->param['total_btu'] = $total_btu;
			$this->param['RESULT'] 	  = 1;
			return $this->param;
		} else {
			$this->param['error'] =  'Please! Check Your Input';
			return $this->param;
		}
	}

	// Lead Time Calculator
	public function lead($request)
	{
		$type = trim($request->input('type'));
		$pre_time = trim($request->input('pre_time'));
		$pre_units = trim($request->input('pre_units'));
		$p_time = trim($request->input('p_time'));
		$p_units = trim($request->input('p_units'));
		$post_time = trim($request->input('post_time'));
		$post_units = trim($request->input('post_units'));
		$place_time = trim($request->input('place_time'));
		$receive_time = trim($request->input('receive_time'));
		$s_delay = trim($request->input('s_delay'));
		$supply_units = trim($request->input('supply_units'));
		$r_delay = trim($request->input('r_delay'));
		$r_units = trim($request->input('r_units'));

		function convertToHoursMins1($time, $format = '%02d Hours %02d Minutes')
		{
			if ($time < 1) {
				return;
			}
			$hours = floor($time / 60);
			$minutes = ($time % 60);
			return sprintf($format, $hours, $minutes);
		}
		function convert($first_value, $units)
		{
			if ($units == 'sec') {
				$first_value = $first_value / 86400;
			} else if ($units == 'min') {
				$first_value = $first_value / 1440;
			} else if ($units == 'hrs') {
				$first_value = $first_value / 24;
			} else if ($units == 'wks') {
				$first_value = $first_value * 7;
			} else if ($units == 'mos') {
				$first_value = $first_value * 30.417;
			} else if ($units == 'yrs') {
				$first_value = $first_value * 365;
			}
			return $first_value;
		}
		if (!empty($type)) {
			if ($type == 'manufac') {
				if (is_numeric($pre_time) && is_numeric($p_time) && is_numeric($post_time)) {
					if (isset($pre_units)) {
						$pre_time = convert($pre_time, $pre_units);
					}
					if (isset($p_units)) {
						$p_time = convert($p_time, $p_units);
					}
					if (isset($post_units)) {
						$post_time = convert($post_time, $post_units);
					}
					$manufac = $pre_time + $p_time + $post_time;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($type == 'order') {
				if (!empty($place_time) && !empty($receive_time)) {
					$from_time = strtotime($place_time);
					$to_time = strtotime($receive_time);
					$diff_minutes = round(abs($from_time - $to_time) / 60);
					$timeDiff = convertToHoursMins1($diff_minutes);
					// dd($diff_minutes);
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($type == 'supply') {
				if (is_numeric($s_delay) && is_numeric($r_delay)) {
					if (isset($supply_units)) {
						$s_delay = convert($s_delay, $supply_units);
					}
					if (isset($r_units)) {
						$r_delay = convert($r_delay, $r_units);
					}
					$supply = $s_delay + $r_delay;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['type'] = $type;
		if ($type == 'manufac') {
			$this->param['pre_time'] = $pre_time;
			$this->param['p_time'] = $p_time;
			$this->param['post_time'] = $post_time;
			$this->param['manufac'] = $manufac;
		} else if ($type == 'order') {
			$this->param['timeDiff'] = $timeDiff;
			$this->param['diff_minutes'] = $diff_minutes;
		} else if ($type == 'supply') {
			$this->param['s_delay'] = $s_delay;
			$this->param['r_delay'] = $r_delay;
			$this->param['supply'] = $supply;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Stone Calculator
	public function stone($request)
	{
		$selection = trim($request->input('selection'));
		$length = trim($request->input('length'));
		$length_unit = trim($request->input('length_unit'));
		$width = trim($request->input('width'));
		$width_unit = trim($request->input('width_unit'));
		$area = trim($request->input('area'));
		$area_unit = trim($request->input('area_unit'));
		$depth = trim($request->input('depth'));
		$depth_unit = trim($request->input('depth_unit'));
		$volume = trim($request->input('volume'));
		$volume_unit = trim($request->input('volume_unit'));
		$material = trim($request->input('material'));
		$price = trim($request->input('price'));
		$price_unit = trim($request->input('price_unit'));
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy . ' ', '', $price_unit);

		function unit_ft($a, $b)
		{
			if ($b == "cm") {
				$ans1 = $a / 30.48;
			} elseif ($b == "m") {
				$ans1 = $a * 3.281;
			} elseif ($b == "in") {
				$ans1 = $a / 12;
			} elseif ($b == "yd") {
				$ans1 = $a * 3;
			} elseif ($b == "ft") {
				$ans1 = $a * 1;
			}
			return $ans1;
		}
		function unit_area($aa, $bb)
		{
			if ($bb == "ft²") {
				$ans2 = $aa * 1;
			} else if ($bb == "yd²") {
				$ans2 = $aa * 9;
			} else if ($bb == "m²") {
				$ans2 = $aa * 10.764;
			}
			return $ans2;
		}
		function unit_vol($a, $b)
		{
			if ($b == "ft³") {
				$ans3 = $a * 1;
			} else if ($b == "yd³") {
				$ans3 = $a * 27;
			} else if ($b == "m³") {
				$ans3 = $a * 35.315;
			}
			return $ans3;
		}
		function material_val($a, $b)
		{
			if ($b == "105") {
				$tons1 = $a * 1.4;
				$tons2 = $a * 1.7;
			} else if ($b == "150") {
				$tons1 = $a * 1.5;
				$tons2 = $a * 1.7;
			} else if ($b == "160") {
				$tons1 = $a * 1.5;
				$tons2 = $a * 1.7;
			} else if ($b = "145") {
				$tons1 = $a * 1.3;
				$tons2 = $a * 1.5;
			} else if ($b = "168") {
				$tons1 = $a * 1.5;
				$tons2 = $a * 1.7;
			} else if ($b = "188") {
				$tons1 = $a * 1;
				$tons2 = $a * 1.3;
			} else if ($b = "100") {
				$tons1 = $a * 1.7;
				$tons2 = $a * 2;
			}
			return array($tons1, $tons2);
		}
		function material_m($a, $b)
		{
			if ($b == "105") {
				$tons1 = $a * 1.66;
				$tons2 = $a * 2.02;
			} else if ($b == "150") {
				$tons1 = $a * 1.78;
				$tons2 = $a * 2.02;
			} else if ($b == "160") {
				$tons1 = $a * 1;
				$tons2 = $a * 2.02;
			} else if ($b = "145") {
				$tons1 = $a * 1.54;
				$tons2 = $a * 1.78;
			} else if ($b = "168") {
				$tons1 = $a * 1.78;
				$tons2 = $a * 2.02;
			} else if ($b = "188") {
				$tons1 = $a * 1.19;
				$tons2 = $a * 1.54;
			} else if ($b = "100") {
				$tons1 = $a * 2.02;
				$tons2 = $a * 2.34;
			}
			return array($tons1, $tons2);
		}
		if ($selection == "1") {
			if (is_numeric($length) && is_numeric($width) && is_numeric($depth)) {
				$length = unit_ft($length, $length_unit);
				$width = unit_ft($width, $width_unit);
				$depth = unit_ft($depth, $depth_unit);
				$cubicyd = $length * $width * $depth;
				$cubicyd1 = $cubicyd / 27;
				$array = material_val($cubicyd1, $material);
				$this->param['cubicyd1'] = $cubicyd1;
				$this->param['array'] = $array;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($selection == "2") {
			if (is_numeric($area) && is_numeric($depth)) {
				$area = unit_area($area, $area_unit);
				$depth = unit_ft($depth, $depth_unit);
				if ($area_unit === "3" && $depth_unit === "m") {
					$cubicyd = ($area / 10.764) * ($depth / 3.281);
				} else {
					$cubicyd = $area * $depth;
				}
				$cubicyd1 = $cubicyd / 27;
				$array = material_val($cubicyd1, $material);
				$this->param['array'] = $array;
				$this->param['cubicyd1'] = $cubicyd1;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($selection == "3") {
			if (is_numeric($volume)) {
				if ($volume_unit === "1") {
					$cubicyd1 = $volume / 27;
					$array = material_val($cubicyd1, $material);
				} else if ($volume_unit === "2") {
					$cubicyd1 = $volume;
					$array = material_val($cubicyd1, $material);
				} else {
					$cubicyd1 = $volume;
					$array = material_m($cubicyd1, $material);
				}
				$this->param['cubicyd1'] = $cubicyd1;
				$this->param['array'] = $array;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		if (is_numeric($price)) {
			if ($price_unit == "per ton") {
				array_walk($array, function (&$v) use ($price) {
					$v *= $price;
				});
				$price_ton = $array;
				$this->param['price_ton'] = $price_ton;
			} else {
				$price_cu = $price * $cubicyd1;
				$this->param['price_cu'] = $price_cu;
			}
			$this->param['price'] = $price;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Birthday calculator	
	public function birthday($request)
	{
		$next_birth = $request->input('next_birth');

		if (!empty($next_birth)) {
			$dob = $next_birth; // yyyy-mm-dd
			$date = date('Y-m-d'); // yyyy-mm-dd

			$date = explode("-", $date);
			$dob2 = explode("-", $dob);
			$birth_month = $dob2[1];
			$bday = new Carbon($dob2[2] . '.' . $dob2[1] . '.' . $dob2[0]); // Your date of birth
			$today = new Carbon($date[2] . '.' . $date[1] . '.' . $date[0]);
			$diff = $today->diff($bday);
			$age_years = $diff->y;
			$age_months = $diff->m;
			$age_days = $diff->d;

			$d = getdate();		// Current date

			$year = $d['year'];
			$mon = $d['mon'];
			$mday = $d['mday'];
			$hour = $d['hours'];
			$min = $d['minutes'];
			$sec = $d['seconds'];
			$dob_hour = $hour; // 24 hour format
			$dob_min = $min;
			$dob_sec = $sec;

			$d1 = mktime($dob_hour, $dob_min, $dob_sec, $dob2[1], $dob2[2], $dob2[0]);
			$d2 = mktime($hour, $min, $sec, $mon, $mday, $year);

			$obj = new Age;

			@$obj->calculateAge(mktime($dob_hour, $dob_min, $dob_sec, $dob2[1], $dob2[2], $dob2[0]));
			// Alert
			if (($d2 - $d1) <= 0) {
				$this->param['error'] = 'Invalid Date of Birth.';
				return $this->param;
			}
			$age = $obj->getAge();
			$rank = $obj->get_rank($age + 1);
			$Totalyears = floor(($d2 - $d1) / 31536000);
			$Total_months = floor(($d2 - $d1) / 2628000);
			$Total_weeks = floor(($d2 - $d1) / 604800);
			$Total_days = floor(($d2 - $d1) / 86400);
			$Total_hours = floor(($d2 - $d1) / 3600);
			$Total_minuts = floor(($d2 - $d1) / 60);
			$Total_seconds = ($d2 - $d1);
			$totalDays = [0, 0, 0, 0, 0, 0, 0];
			$daysName = [];
			for ($i = 0; $i < $age; $i++) {
				$day = date('w', strtotime("+$i years " . $dob));
				$dayName = date('l', strtotime("+$i years " . $dob));
				$totalDays[$day] = $totalDays[$day] + 1;
				$daysName[] = $dayName;
			}
			$nbday = new Carbon($mday . '.' . $mon . '.' . $year);
			if ($mon > $dob2[1] || $mon == $dob2[1]) {
				$year = $year + 1;
			}
			if ($mon == $dob2[1] && $mday < $dob2[2]) {
				$year = $year - 1;
			}
			$ntoday = new Carbon($dob2[2] . '.' . $dob2[1] . '.' . $year); // Your date of birth
			$ndiff = $ntoday->diff($nbday);
			$next_r_mon = $ndiff->m;
			$next_r_day = $ndiff->d;
			$remDays = $ndiff->days;
			$nextBirth = date('l, F d, Y', strtotime("+$next_r_mon months +$next_r_day days " . date('Y-m-d')));
			$n_brdy_days_per = ($remDays / 365) * 100;

			$current  = getdate(); // Current date 	 	
			$half     = date('Y-m-d', strtotime("+6 months", strtotime($dob)));
			$birthday = date('Y-m-d', strtotime($dob));

			$Q2   = explode("-", $half);
			$bday = explode("-", $birthday);

			if ($Q2[1] > $current['mon'] || ($Q2[1] == $current['mon'] && $Q2[2] > $current['mday'])) {
				$year_q2 = $current['year'];
				$mon_q2  = $Q2[1];
				$day_q2  = $Q2[2];
			} else {
				$year_q2 = $current['year'] + 1;
				$mon_q2  = $Q2[1];
				$day_q2  = $Q2[2];
			}
			if ($bday[1] > $current['mon'] || ($bday[1] == $current['mon'] && $bday[2] > $current['mday'])) {
				$bd_year = $current['year'];
				$bd_mon  = $bday[1];
				$bd_day  = $bday[2];
			} else {
				$bd_year = $current['year'] + 1;
				$bd_mon  = $bday[1];
				$bd_day  = $bday[2];
			}

			$next_bday = date('l, F d, Y', strtotime($bd_year . '-' . $bd_mon . '-' . $bd_day));
			$half_brdy = date('l, F d, Y', strtotime($year_q2 . '-' . $mon_q2 . '-' . $day_q2));

			$next   = new Carbon($day_q2 . '-' . $mon_q2 . '-' . $year_q2);
			$today  = new Carbon(date('d-m-Y'));

			$next_half_day = $today->diff($next);
			$n_half_brdy_days = round(($next_half_day->days / 365) * 100);
			// return values

			$this->param = array(
				"Age" => $age,
				"Age_months" => $age_months,
				"Age_days" => $age_days,
				"birth_month" => $birth_month,
				"N_r_months" => $next_r_mon,
				"N_r_days" => $next_r_day,
				"Years" => $Totalyears,
				"Months" => $Total_months,
				"Weeks" => $Total_weeks,
				"Days" => $Total_days,
				"Hours" => $Total_hours,
				"Min" => $Total_minuts,
				"nextBirth" => $nextBirth,
				"remDays" => $remDays,
				"totalDays" => $totalDays,
				"daysName" => $daysName,
				"n_brdy_days_per" => $n_brdy_days_per,
				"half_brdy" => $half_brdy,
				"next_half_r_days" => $next_half_day->days,
				"n_half_brdy_days" => $n_half_brdy_days,
			);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please Select Your Date of Birth.';
			return $this->param;
		}
	}

	// Half Birthday Calculator
	public function half($request)
	{
		$day = $request->input('day');
		$month = $request->input('month');
		$year = $request->input('year');
		$dob = sprintf('%04d-%02d-%02d', $year, $month, $day);
		if (!empty($dob) && $dob <= date("Y-m-d")) {
			$current  = getdate(); // Current date 	 	
			$first_q  = date('Y-m-d', strtotime("+3 months", strtotime($dob)));
			$half     = date('Y-m-d', strtotime("+6 months", strtotime($dob)));
			$third_q  = date('Y-m-d', strtotime("+9 months", strtotime($dob)));
			$birthday = date('Y-m-d', strtotime($dob));

			$Q1   = explode("-", $first_q);
			$Q2   = explode("-", $half);
			$Q3   = explode("-", $third_q);
			$bday = explode("-", $birthday);

			if ($Q1[1] > $current['mon'] || ($Q1[1] == $current['mon'] && $Q1[2] > $current['mday'])) {
				$year_q1 = $current['year'];
				$mon_q1  = $Q1[1];
				$day_q1  = $Q1[2];
			} else {
				$year_q1 = $current['year'] + 1;
				$mon_q1  = $Q1[1];
				$day_q1  = $Q1[2];
			}

			if ($Q2[1] > $current['mon'] || ($Q2[1] == $current['mon'] && $Q2[2] > $current['mday'])) {
				$year_q2 = $current['year'];
				$mon_q2  = $Q2[1];
				$day_q2  = $Q2[2];
			} else {
				$year_q2 = $current['year'] + 1;
				$mon_q2  = $Q2[1];
				$day_q2  = $Q2[2];
			}

			if ($Q3[1] > $current['mon'] || ($Q3[1] == $current['mon'] && $Q3[2] > $current['mday'])) {
				$year_q3 = $current['year'];
				$mon_q3  = $Q3[1];
				$day_q3  = $Q3[2];
			} else {
				$year_q3 = $current['year'] + 1;
				$mon_q3  = $Q3[1];
				$day_q3  = $Q3[2];
			}

			if ($bday[1] > $current['mon'] || ($bday[1] == $current['mon'] && $bday[2] > $current['mday'])) {
				$bd_year = $current['year'];
				$bd_mon  = $bday[1];
				$bd_day  = $bday[2];
			} else {
				$bd_year = $current['year'] + 1;
				$bd_mon  = $bday[1];
				$bd_day  = $bday[2];
			}

			$next_bday = date('l, F d, Y', strtotime($bd_year . '-' . $bd_mon . '-' . $bd_day));
			$next_half = date('l, F d, Y', strtotime($year_q2 . '-' . $mon_q2 . '-' . $day_q2));
			$first_Q   = date('l, F d, Y', strtotime($year_q1 . '-' . $mon_q1 . '-' . $day_q1));
			$third_Q   = date('l, F d, Y', strtotime($year_q3 . '-' . $mon_q3 . '-' . $day_q3));

			$next   = new Carbon($day_q2 . '-' . $mon_q2 . '-' . $year_q2);
			$Q1_day = new Carbon($day_q1 . '-' . $mon_q1 . '-' . $year_q1);
			$Q3_day = new Carbon($day_q3 . '-' . $mon_q3 . '-' . $year_q3);
			$today  = new Carbon(date('d-m-Y'));

			$next_half_day = $today->diff($next);
			$first_Q_day   = $today->diff($Q1_day);
			$third_Q_day   = $today->diff($Q3_day);
			$day_per       = $next_half_day->days * 100 / 365;

			$this->param['next_half']      = $next_half;
			$this->param['day_per']        = $day_per;
			$this->param['next_half_days'] = $next_half_day->days;
			$this->param['first_Q']        = $first_Q;
			$this->param['first_Q_days']   = $first_Q_day->days;
			$this->param['third_Q']        = $third_Q;
			$this->param['third_Q_days']   = $third_Q_day->days;
			$this->param['next_bday']      = $next_bday;
			$this->param['RESULT'] 	       = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Lawn Mowing Cost Calculator
	public function lawn($request)
	{

		$type = trim($request->input('type'));
		$charges = trim($request->input('charges'));
		$mow_price = trim($request->input('mow_price'));
		$m_p_units = trim($request->input('m_p_units'));
		$currancy = $request->input('currancy');
		$m_p_units = str_replace($currancy . ' ', '', $m_p_units);
		$area_mow = trim($request->input('area_mow'));
		$a_m_units = trim($request->input('a_m_units'));
		$hours_work = trim($request->input('hours_work'));
		$mow_speed = trim($request->input('mow_speed'));
		$mow_speed_units = trim($request->input('mow_speed_units'));
		$mow_width = trim($request->input('mow_width'));
		$mow_width_units = trim($request->input('mow_width_units'));
		$mow_pro = trim($request->input('mow_pro'));
		$to_mow = trim($request->input('to_mow'));
		$to_mow_units = trim($request->input('to_mow_units'));



		function perAreaUnit($input, $unit)
		{
			if ($unit == 'm²') {
				$input = $input / 1000000;
			} else if ($unit == 'ft²') {
				$input = $input / 10760000;
			} else if ($unit == 'yd²') {
				$input = $input / 1196000;
			} else if ($unit == 'a') {
				$input = $input * 0.0001;
			} else if ($unit == 'da') {
				$input = $input * 0.001;
			} else if ($unit == 'ha') {
				$input = $input / 100;
			} else if ($unit == 'ac') {
				$input = $input / 247.1;
			}
			return $input;
		}

		if ($type == 'lawn_mowed') {
			if ($charges == 'area') {
				if (is_numeric($mow_price) && is_numeric($area_mow)) {
					if (isset($m_p_units)) {
						$mow_price = perAreaUnit($mow_price, $m_p_units);
					}
					if (isset($a_m_units)) {
						$area_mow = perAreaUnit($area_mow, $a_m_units);
					}
					$total_cost = $mow_price * $area_mow;
					$this->param['mow_price'] = $mow_price;
					$this->param['area_mow'] = $area_mow;
					$this->param['total_cost'] = $total_cost;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($charges == 'hour') {
				if (is_numeric($mow_price) && is_numeric($hours_work)) {
					$total_cost = $mow_price * $hours_work;
					$this->param['mow_price'] = $mow_price;
					$this->param['hours_work'] = $hours_work;
					$this->param['total_cost'] = $total_cost;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
			$this->param['charges'] = $charges;
		} else if ($type == 'mowing_time') {
			if (is_numeric($mow_speed) && is_numeric($mow_width) && is_numeric($mow_pro)) {
				if (isset($mow_speed_units)) {
					if ($mow_speed_units == 'm/h') {
						$mow_speed = $mow_speed / 1000;
					} else if ($mow_speed_units == 'ft/h') {
						$mow_speed = $mow_speed / 3281;
					}
				}
				if (isset($mow_width_units)) {
					if ($mow_width_units == 'cm') {
						$mow_width = $mow_width / 100000;
					} else if ($mow_width_units == 'm') {
						$mow_width = $mow_width / 1000;
					} else if ($mow_width_units == 'in') {
						$mow_width = $mow_width / 39370;
					} else if ($mow_width_units == 'ft') {
						$mow_width = $mow_width / 3281;
					}
				}
				$res = $mow_speed * $mow_width;
				$per = $mow_pro / 100;
				$m_cost = $res * $per;
				$this->param['mow_speed'] = $mow_speed;
				$this->param['mow_width'] = $mow_width;
				$this->param['mow_pro'] = $mow_pro;
				$this->param['m_cost'] = $m_cost;
				if (!empty($to_mow)) {
					if (isset($to_mow_units)) {
						$to_mow = perAreaUnit($to_mow, $to_mow_units);
					}
					$m_time = $to_mow / $m_cost;
					$hours = floor($m_time);
					$minutes = floor(($m_time - $hours) * 60);
					$this->param['to_mow'] = $to_mow;
					$this->param['hours'] = $hours;
					$this->param['minutes'] = $minutes;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['type'] = $type;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// ROOM SIZE CALCULATOR
	public function room($request)
	{
		$submit = trim($request->input('name'));
		$lenght_f = $request->input('lenght_f');
		$lenght_in = $request->input('lenght_in');
		$width_f = $request->input('width_f');
		$width_in = $request->input('width_in');
		$perce = $request->input('perce');
		$lenght_m = $request->input('lenght_m');
		$width_m = $request->input('width_m');
		// dd($request->input());
		if ($submit == 'feet') {
			$length1 = count($lenght_f);
			$width1 = count($width_f);
			$lenght_foot = 0;
			$length_foot_val = 0;
			$width_foot_val = 0;
			$i = 0;
			while ($i < $length1 && $i < $width1) {
				if (($lenght_f[$i] === "" && $lenght_in[$i] === "") || ($width_f[$i] === "" && $width_in[$i] === "")) {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
				if ($lenght_f[$i] === "") {
					$lenght_f[$i] = 0;
				}
				if ($lenght_in[$i] === "") {
					$lenght_in[$i] = 0;
				}
				if ($width_f[$i] === "") {
					$width_f[$i] = 0;
				}
				if ($width_in[$i] === "") {
					$width_in[$i] = 0;
				}
				if (is_numeric($lenght_f[$i]) && is_numeric($lenght_in[$i]) || is_numeric($width_f[$i]) && is_numeric($width_in[$i])) {
					$length = $lenght_in[$i] / 12;
					$width = $width_in[$i] / 12;
					$length_foot_val  = $lenght_f[$i] + $length;
					$width_foot_val  = $width_f[$i] + $width;
					$lenght_foot +=  $length_foot_val * $width_foot_val;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
				$i++;
			}
			$f_r_s = $lenght_foot;
			if ($perce != 0 && $f_r_s != 0) {
				$p = ($perce / 100) * $f_r_s;
				$perc = $f_r_s + $p;
				$this->param['perc'] = $perc;
			}
			$this->param['f_r_s'] = $f_r_s;
		} else if ($submit == 'meter') {
			$c_lenght_m = count($lenght_m);
			$c_width_m = count($width_m);
			$m_lenght_sum = 0;
			$m = 0;
			while ($m < $c_lenght_m && $m < $c_width_m) {
				if (is_numeric($lenght_m[$m]) && is_numeric($width_m[$m])):
					$m_lenght_sum += $lenght_m[$m] * $width_m[$m];

				else:
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				endif;
				$m++;
			}

			$m_r_s = $m_lenght_sum;
			if ($perce != 0 && $m_r_s != 0) {
				$p = ($perce / 100) * $m_r_s;
				$perc = $m_r_s + $p;
				$this->param['perc'] = $perc;
			}
			$this->param['m_r_s'] = $m_r_s;
		}
		$this->param['submit'] = $submit;
		$this->param['perce'] = $perce;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Reading Time calculator
	public function reading($request)
	{
		$reading_speed = trim($request->input('reading_speed'));
		$read_pages = trim($request->input('read_pages'));
		$book_unit = trim($request->input('book_unit'));
		$book_leng = trim($request->input('book_leng'));
		$daily_reading = trim($request->input('daily_reading'));
		$total_unit = trim($request->input('total_unit'));
		$time_unit = trim($request->input('time_unit'));
		$reading_unit = trim($request->input('reading_unit'));
		$period_unit = trim($request->input('period_unit'));
		if (is_numeric($read_pages) && is_numeric($book_leng)) {
			if ($book_unit === "hr") {
				$read_pages = $read_pages / 60;
			}
			$answer = $book_leng / $read_pages;
			if ($total_unit === "min") {
				$answer_main = $answer . " min";
				$answer = $answer;
			} elseif ($total_unit === "hr") {
				$answer = $answer / 60;
				$answer_main = round($answer, 3) . " hrs";
				$answer = round($answer, 3);
			} elseif ($total_unit === "min/hr") {
				$hours = floor($answer / 60);
				$minutes = $answer % 60;
				$answer = $answer;
				$answer_main = $hours . " hrs " . $minutes . " min";
			}
			if (is_numeric($daily_reading)) {
				$dly_reading = $answer  / $book_leng;
				$dly_reading_min = $dly_reading * 1440;
				$total_daily_reading = $daily_reading / $dly_reading_min;
				$period_spent = $answer / $daily_reading * 1440;
				if ($reading_unit === "min") {
					$total_daily_reading = round($total_daily_reading, 3) . " min";
				} elseif ($reading_unit === "hr") {
					$total_daily_reading = $total_daily_reading * 60  . " hrs";
				} elseif ($reading_unit === "day") {
					$total_daily_reading = $total_daily_reading * 1440  . " days";
				} elseif ($reading_unit === "week") {
					$total_daily_reading = $total_daily_reading * 10080 . " wks";
				} elseif ($reading_unit === "month") {
					$total_daily_reading = $total_daily_reading * 43800 . " mons";
				} elseif ($reading_unit === "year") {
					$total_daily_reading = $total_daily_reading * 525600 . " yrs";
				}
				if ($period_unit === "min") {
					$period_spent = $period_spent . " min";
				} elseif ($period_unit === "hr") {
					$period_sp = $period_spent / 60;
					$period_spent = round($period_sp, 1) . " hrs";
				} elseif ($period_unit === "day") {
					$period_sp = $period_spent / 1440;
					$period_spent = round($period_sp, 1) . " day";
				} elseif ($period_unit === "week") {
					$period_sp = $period_spent / 10080;
					$period_spent = round($period_sp, 1) . " wks";
				} elseif ($period_unit === "month") {
					$period_sp = $period_spent / 43800;
					$period_spent = round($period_sp, 1) . " mons";
				} elseif ($period_unit === "year") {
					$period_sp = $period_spent /  525600;
					$period_spent = round($period_sp, 1) . " yrs";
				} elseif ($period_unit === "minutes/hour") {
					$hours = floor($period_spent / 60);
					$minutes = $period_spent % 60;
					$period_spent = $hours . "hr " . $minutes . "min";
				} elseif ($period_unit === "year/month/day") {
					$minutesPerYear = 365 * 24 * 60;
					$minutesPerMonth = 30 * 24 * 60;
					$minutesPerDay = 24 * 60;
					$years = floor($period_spent / $minutesPerYear);
					$remainingMinutes = $period_spent % $minutesPerYear;
					$months = floor($remainingMinutes / $minutesPerMonth);
					$remainingMinutes = $remainingMinutes % $minutesPerMonth;
					$days = floor($remainingMinutes / $minutesPerDay);
					$period_spent = $years . "year " . $months . "mon " . $days . "day ";
				} elseif ($period_unit === "week/day") {
					$minutesPerWeek = 7 * 24 * 60;
					$minutesPerDay = 24 * 60;
					$week = floor($period_spent / $minutesPerWeek);
					$days = floor(($period_spent % $minutesPerWeek) / $minutesPerDay);
					$period_spent = $week . "week " . $days . "day ";
				} elseif ($period_unit === "day/hour/minutes") {
					$minutesPerDay = 24 * 60;
					$minutesPerHour = 60;
					$days = floor($period_spent / $minutesPerDay);
					$remainingMinutes = $period_spent % $minutesPerDay;
					$hours = floor($remainingMinutes / $minutesPerHour);
					$minutes = $remainingMinutes % $minutesPerHour;
					$period_spent = $days . " day, " . $hours . " hr, " . $minutes . " min";
				}
				$this->param['total_daily_reading'] = $total_daily_reading;
				$this->param['period_spent'] = $period_spent;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer_main;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Age calculator	
	public function age($request)
	{
		$submit = $_POST['submit'];

		$day = $request->input('day');
		$month = $request->input('month');
		$year = $request->input('year');
		$dob = sprintf('%04d-%02d-%02d', $year, $month, $day);

		$day_sec = $request->input('day_sec');
		$month_sec = $request->input('month_sec');
		$year_sec = $request->input('year_sec');
		$e_date = sprintf('%04d-%02d-%02d', $year_sec, $month_sec, $day_sec);
		// $dob = $request->input('dob');
		// $e_date = $request->input('e_date');

		$orderdob = explode('-', $dob);
		$orderdate = explode('-', $e_date);
		$e_year = $orderdate[0];
		$e_month   = $orderdate[1];
		$e_day  = $orderdate[2];
		$dob_year = $orderdob[0];
		$dob_month   = $orderdob[1];
		$dob_day  = $orderdob[2];
		// dd($e_year);

		if (is_numeric($dob_day) && is_numeric($dob_month) && is_numeric($dob_year) && is_numeric($e_day) && is_numeric($e_month) && is_numeric($e_year)) {
			$dob_array[] = sprintf('%02d', $dob_year) . "-" . sprintf('%02d', $dob_month) . "-" . sprintf('%02d', $dob_day);
			$dates_array[] = sprintf('%02d', $e_year) . "-" . sprintf('%02d', $e_month) . "-" . sprintf('%02d', $e_day);
			// dd($dob_array,$dates_array);
			// dd($dates_array);
			for ($i = 0; $i < count($dob_array); $i++) {
				$dob = $dob_array[$i]; // yyyy-mm-dd
				$all_dob[] = date('l, F d, Y', strtotime($dob));
				$date = $dates_array[$i]; // yyyy-mm-dd
				$date = explode("-", $date);
				$dob2 = explode("-", $dob);
				$birth_month = $dob2[1];
				$bday = new Carbon($dob2[2] . '.' . $dob2[1] . '.' . $dob2[0]); // Your date of birth
				$today = new Carbon($date[2] . '.' . $date[1] . '.' . $date[0]);
				$diff = $today->diff($bday);
				$age_years[] = $diff->y;
				$age_months[] = $diff->m;
				$age_days[] = $diff->d;
				$all_users_days[] = $diff->days;
				$d = getdate();		// Current date
				$year = $d['year'];
				$mon = $d['mon'];
				$mday = $d['mday'];
				$hour = $d['hours'];
				$min = $d['minutes'];
				$sec = $d['seconds'];
				$dob_hour = $hour; // 24 hour format
				$dob_min = $min;
				$dob_sec = $sec;
				@$d1 = mktime($dob_hour, $dob_min, $dob_sec, $dob2[1], $dob2[2], $dob2[0]);
				$d2 = mktime($hour, $min, $sec, $mon, $mday, $year);
				$obj = new Age;
				@$obj->calculateAge(mktime($dob_hour, $dob_min, $dob_sec, $dob2[1], $dob2[2], $dob2[0]));
				// Alert
				// echo $d1.'<br>';
				// echo $d2.'<br>';
				// die;
				if (($d2 - $d1) <= 0) {
					$this->param['error'] = 'Invalid Date of Birth.';
					return $this->param;
				}
				$age = $obj->getAge();
				$rank = $obj->get_rank($age + 1);
				$totalyears = floor(($d2 - $d1) / 31536000);
				$Total_years[] = $totalyears;
				$Total_months[] = floor(($d2 - $d1) / 2628000);
				$Total_weeks[] = floor(($d2 - $d1) / 604800);
				$total_days = floor(($d2 - $d1) / 86400);
				$Total_days[] = $total_days;
				$Total_hours[] = floor(($d2 - $d1) / 3600);
				$total_minuts = floor(($d2 - $d1) / 60);
				$Total_minuts[] = $total_minuts;
				$Total_seconds[] = ($d2 - $d1);
				// Next Birthday
				// n for next
				// r for remaining
				$nbday = new Carbon($mday . '.' . $mon . '.' . $year);
				if ($mon > $dob2[1] || $mon == $dob2[1]) {
					$year = $year + 1;
				}
				if ($mon == $dob2[1] && $mday < $dob2[2]) {
					$year = $year - 1;
				}
				$ntoday = new Carbon($dob2[2] . '.' . $dob2[1] . '.' . $year); // Your date of birth
				$ndiff = $ntoday->diff($nbday);
				$N_r_days[] = $ndiff->days;
				$N_r_days_per[] = round(($ndiff->days / 365) * 100);
				$breath[] = round(0.5 * 15 * $total_minuts);
				$heartBeats[] = round(72 * $total_minuts);
				$sleeping[] = round($totalyears * 365.25 * 8 / (365.25 * 24), 1);
				$laughed[] = $total_days * 10;
				// Half birthDay


				$current  = getdate(); // Current date 	 	
				$half     = date('Y-m-d', strtotime("+6 months", strtotime($dob)));
				$birthday = date('Y-m-d', strtotime($dob));

				$Q2   = explode("-", $half);
				$bday = explode("-", $birthday);

				if ($Q2[1] > $current['mon'] || ($Q2[1] == $current['mon'] && $Q2[2] > $current['mday'])) {
					$year_q2 = $current['year'];
					$mon_q2  = $Q2[1];
					$day_q2  = $Q2[2];
				} else {
					$year_q2 = $current['year'] + 1;
					$mon_q2  = $Q2[1];
					$day_q2  = $Q2[2];
				}

				if ($bday[1] > $current['mon'] || ($bday[1] == $current['mon'] && $bday[2] > $current['mday'])) {
					$bd_year = $current['year'];
					$bd_mon  = $bday[1];
					$bd_day  = $bday[2];
				} else {
					$bd_year = $current['year'] + 1;
					$bd_mon  = $bday[1];
					$bd_day  = $bday[2];
				}

				$next_bday = date('l, F d, Y', strtotime($bd_year . '-' . $bd_mon . '-' . $bd_day));
				$half_brdy[] = date('l, F d, Y', strtotime($year_q2 . '-' . $mon_q2 . '-' . $day_q2));

				$next   = new Carbon($day_q2 . '-' . $mon_q2 . '-' . $year_q2);
				$today  = new Carbon(date('d-m-Y'));

				$next_half_day = $today->diff($next);
				$n_half_brdy_days[] = $next_half_day->days * 100 / 365;
				// blinking times calculation
				$blinking_times[] = $diff->days * 16800;
				// hair length calculation
				$hair_length_mm[] = $diff->days * 0.42;
				$hair_length_m[] = ($diff->days * 0.42) / 1000;
				// nail length calculation
				$nail_length_mm[] = $diff->days * 0.12;
				$nail_length_m[] = ($diff->days * 0.12) / 1000;
				// dog age calculation
				$dog_age[] = number_format($diff->days * 0.0004657534246575342, 2);
				// cat age calculation
				$cat_age[] = number_format($diff->days * 0.0005753424657534247, 2);
				// turtle age calculation
				$turtle_age[] = number_format($diff->days * 0.0068219178082192, 2);
				// horse age calculation
				$horse_age[] = number_format($diff->days * 0.001041095890411, 2);
				// cow age calculation
				$cow_age[] = number_format($diff->days * 0.0007671232876712329, 2);
				// elephant age calculation
				$elephant_age[] = number_format($diff->days * 0.0018630136986301, 2);
				// mercury age calculation
				$mercury_age[] = number_format($diff->days * 0.0113698630136986, 2);
				// venus age calculation
				$venus_age[] = number_format($diff->days * 0.0044383561643836, 2);
				// mars age calculation
				$mars_age[] = number_format($diff->days * 0.0014520547945205, 2);
				// jupiter age calculation
				$jupiter_age[] = number_format($diff->days * 0.0002191780821917808, 2);
				// saturn age calculation
				$saturn_age[] = number_format($diff->days * 0.00008219178082191781, 2);
			}
			// for combine years and days
			$sum_users_days = array_sum($all_users_days);
			$combine_years = $sum_users_days / 365.2425;
			$sep_years = explode(".", $combine_years);
			$combine_years_ans = $sep_years[0];
			$combine_days_ans = floor(fmod($sum_users_days, 365.2425));
			// for combine date and remaining days
			$combine_r_days = round((365 - $combine_days_ans) / count($dob_array));
			$aaj_ki_date = date('Y-m-d');
			$next_combine_brdy = date('F d, Y', strtotime("+$combine_r_days days", strtotime($aaj_ki_date)));
			$combine_r_days_per = round(($combine_r_days / 365) * 100);
			// all names 
			// $this->param['name_array'] = $name_array;
			$this->param['dob_array'] = $dob_array;
			$this->param['dates_array'] = $dates_array;
			// dd($this->param);
			// all dob 
			$this->param['all_dob'] = $all_dob;
			// next birthday remaining days
			$this->param['N_r_days'] = $N_r_days;
			// next birthday remaining days in percent
			$this->param['N_r_days_per'] = $N_r_days_per;
			// combine years and days
			$this->param['combine_years_ans'] = $combine_years_ans;
			$this->param['combine_days_ans'] = $combine_days_ans;
			// combine remaining days and next combine byrdy date
			$this->param['combine_r_days'] = $combine_r_days;
			$this->param['combine_r_days_per'] = $combine_r_days_per;
			$this->param['next_combine_brdy'] = $next_combine_brdy;
			// age in years, months, days 
			$this->param['age_years'] = $age_years;
			$this->param['age_months'] = $age_months;
			$this->param['age_days'] = $age_days;
			// half brdy
			$this->param['half_brdy'] = $half_brdy;
			// total years, total months, total days, etc
			$this->param['Total_years'] = $Total_years;
			$this->param['Total_months'] = $Total_months;
			$this->param['Total_weeks'] = $Total_weeks;
			$this->param['Total_days'] = $Total_days;
			$this->param['Total_hours'] = $Total_hours;
			$this->param['Total_minuts'] = $Total_minuts;
			$this->param['Total_seconds'] = $Total_seconds;
			// breath, sleeping, nail length etc 
			$this->param['breath'] = $breath;
			$this->param['heartBeats'] = $heartBeats;
			$this->param['sleeping'] = $sleeping;
			$this->param['laughed'] = $laughed;
			$this->param['blinking_times'] = $blinking_times;
			$this->param['hair_length_mm'] = $hair_length_mm;
			$this->param['hair_length_m'] = $hair_length_m;
			$this->param['nail_length_mm'] = $nail_length_mm;
			$this->param['nail_length_m'] = $nail_length_m;
			// animal age
			$this->param['dog_age'] = $dog_age;
			$this->param['cat_age'] = $cat_age;
			$this->param['turtle_age'] = $turtle_age;
			$this->param['horse_age'] = $horse_age;
			$this->param['cow_age'] = $cow_age;
			$this->param['elephant_age'] = $elephant_age;
			// planet age
			$this->param['mercury_age'] = $mercury_age;
			$this->param['venus_age'] = $venus_age;
			$this->param['mars_age'] = $mars_age;
			$this->param['jupiter_age'] = $jupiter_age;
			$this->param['saturn_age'] = $saturn_age;
			$this->param['submit'] = $submit;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please check your input.';
			return $this->param;
		}
	}

	// Age Difference calculator
	public function age_diff($request)
	{
		// dd($request->all());
		$submit = $request->input('selection');
		$dob_f = $request->input('dob_f');
		$dob_s = $request->input('dob_s');
		$year_1 = $request->input('year_1');
		$year_2 = $request->input('year_2');
		$age_1 = $request->input('age_1');
		$age_2 = $request->input('age_2');
		if ($submit === "1") {
			if (!empty($dob_f) && !empty($dob_s)) {
				$dob_f = new Carbon($dob_f);
				$dob_s = new Carbon($dob_s);
				$currentDate = date("Y-m-d");
				$currentDate = new Carbon($currentDate);
				$age_diff = $dob_f->diff($dob_s);
				$age_diff_Year = $age_diff->y;
				$age_diff_Month = $age_diff->m;
				$age_diff_Day = $age_diff->d;
				$age_diff_in_days = $age_diff->days;
				$age_diff_weeks = $age_diff_in_days / 7;
				$age_diff_remaining_days = $age_diff_in_days % 7;
				$age_f = $currentDate->diff($dob_f);
				$ageFYear = $age_f->y;
				$ageFMonth = $age_f->m;
				$ageFDay = $age_f->d;
				$age_s = $currentDate->diff($dob_s);
				$ageSYear = $age_s->y;
				$ageSMonth = $age_s->m;
				$ageSDay = $age_s->d;
				$this->param = [
					'submit' => $submit,
					'age_diff_Day' => $age_diff_Day,
					'age_diff_Month' => $age_diff_Month,
					'age_diff_Year' => $age_diff_Year,
					'age_diff_in_days' => $age_diff_in_days,
					'age_diff_weeks' => floor($age_diff_weeks),
					'age_diff_remaining_days' => $age_diff_remaining_days,

					'ageFYear' => $ageFYear,
					'ageFMonth' => $ageFMonth,
					'ageFDay' => $ageFDay,

					'ageSYear' => $ageSYear,
					'ageSMonth' => $ageSMonth,
					'ageSDay' => $ageSDay
				];
			} else {
				$this->param['error'] = 'Please! Select Correct Date';
				return $this->param;
			}
		} else if ($submit === "2") {
			if (!empty($year_1) && !empty($year_2)) {
				$dob_f = new Carbon("$year_1-01-01");
				$dob_s = new Carbon("$year_2-01-01");
				$age_diff = $dob_f->diff($dob_s);
				$age_diff_Year = $age_diff->y;
				$age_diff_Month = $age_diff->m;
				$age_diff_Day = $age_diff->d;
				$age_diff_in_days = $age_diff->days;
				$age_diff_weeks = $age_diff_in_days / 7;
				$age_diff_remaining_days = $age_diff_in_days % 7;
				$this->param = [
					'submit' => $submit,
					'age_diff_Day' => $age_diff_Day,
					'age_diff_Month' => $age_diff_Month,
					'age_diff_Year' => $age_diff_Year,
					'age_diff_in_days' => $age_diff_in_days,
					'age_diff_weeks' => floor($age_diff_weeks),
					'age_diff_remaining_days' => $age_diff_remaining_days,
				];
			} else {
				$this->param['error'] = 'Please! Select Correct Year';
				return $this->param;
			}
		} else {
			if (is_numeric($age_1) && is_numeric($age_2)) {
				$age_diff_Year = abs($age_2 - $age_1);
				$age_diff_in_days = $age_diff_Year * 365;
				$this->param = [
					'submit' => $submit,
					'age_diff_Year' => $age_diff_Year,
					'age_diff_in_days' => $age_diff_in_days,
				];
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Aspect Ratio Calculator
	public function aspect($request)
	{
		//  dd($request->all());
		$ratios = trim($request->input('ratios'));
		$w1 = trim($request->input('w1'));
		$h1 = trim($request->input('h1'));
		$w2 = trim($request->input('w2'));
		$h2 = trim($request->input('h2'));

		if (is_numeric($w1) && is_numeric($h1)) {
			function reduceRatio($numerator, $denominator)
			{
				$divisor = '';
				$left = '';
				$right = '';
				function gcd($a, $b)
				{
					if ($b === 0) {
						return $a;
					}
					return gmp_gcd($b, $a % $b);
				}
				if ($numerator === $denominator) {
					return '1 : 1';
				}
				$divisor = gcd($numerator, $denominator);
				$left = $numerator / $divisor;
				$right = $denominator / $divisor;
				if ($left == 8 && $right == 5) {
					$left = 16;
					$right = 10;
				}
				return "{$left} : {$right}";
			}
			function solve($width, $height, $numerator, $denominator)
			{
				if (is_numeric($width)) {
					// dd(round(''));
					return round($width) ? round($width / ($numerator / $denominator)) : $width / ($numerator / $denominator);
				} elseif (is_numeric($height)) {
					return round($height) ? round($height * ($numerator / $denominator)) : $height * ($numerator / $denominator);
				} else {
					return '';
				}
			}
			function ratio2css($numerator, $denominator)
			{
				$width = '';
				$height = '';
				if ($numerator > $denominator) {
					$width  = 200;
					$height = solve($width, '', $numerator, $denominator);
				} else {
					$height = 200;
					$width  = solve('', $height, $numerator, $denominator);
				}
				return "width:" . round($width) . "px;height:" . round($height) . "px;line-height:" . round($height) . "px";
			}

			$x1v = $w1;
			$y1v = $h1;
			$stop = 0;
			$maxIterations = 10;
			while (!is_int($x1v) || !is_int($y1v)) {
				$x1v *= 10;
				$y1v *= 10;
				++$stop;
				if ($stop > $maxIterations) {
					break;
				}
			}
			if (is_numeric($w2) && !is_numeric($h2)) {
				$h2 = ($h1 / $w1) * $w2;
				$this->param['check'] = 'h2';
				$this->param['ans'] = round($h2, 3);
			} elseif (!is_numeric($w2) && is_numeric($h2)) {
				$w2 = ($w1 / $h1) * $h2;
				$this->param['check'] = 'w2';
				$this->param['ans'] = round($w2, 3);
			} elseif (is_numeric($w2) && is_numeric($h2)) {
				$this->param['error'] = 'Please enter either W₂ or H₂ to find the other.';
				return $this->param;
			}
			if ($w1 >= $h1) {
				$mode = 'Landscape';
			} else {
				$mode = 'Portrait';
			}
			$this->param['asp_ratio'] = reduceRatio($w1, $h1);
			$this->param['vsl_ratio'] = ratio2css($x1v, $y1v);
			$this->param['pixels'] = number_format($w1 * $h1);
			$this->param['mode'] = $mode;
			$this->param['RESULT'] = 1;
			// dd($this->param);
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Cubic Yard calculator	
	public function yard($request)
	{
		$operations = $request->input('operations');
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$four = $request->input('four');
		$quantity = $request->input('quantity');
		$units1 = $request->input('units1');
		$units2 = $request->input('units2');
		$units3 = $request->input('units3');
		$units4 = $request->input('units4');
		$price_unit = $request->input('price_unit');
		$price = $request->input('price');
		$extra_area = $request->input('extra_area');
		$extra_units = $request->input('extra_units');
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy, '', $price_unit);
		function calculate($a, $b)
		{
			if ($b == "ft") {
				$convert = $a * 1;
			} elseif ($b == "in") {
				$convert = $a * 0.0833333;
			} elseif ($b == "yd") {
				$convert = $a * 3;
			} elseif ($b == "cm") {
				$convert = $a * 0.0328084;
			} elseif ($b == "m") {
				$convert = $a * 3.28084;
			}
			return $convert;
		}
		function calculate_square($x, $y)
		{
			// dd($x,$y);
			if ($y == "ft²") {
				$squ = $x * 1;
			} elseif ($y == "in²") {
				$squ = $x * 0.00694444;
			} elseif ($y == "yd²") {
				$squ = $x * 9;
			} elseif ($y == "cm²") {
				$squ = $x * 0.00107639;
			} elseif ($y == "m²") {
				$squ = $x * 10.7639;
			}
			return $squ;
		}
		if ($operations == "3") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				$cubic_feet = $first * $second * $third;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$sq_val = pow($second, 2);
				$cubic_feet = $first * $sq_val;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				$four = calculate($four, $units4);
				$in_area = $second * $third;
				$sq_border = $four * 2;
				$a1 = $second + $sq_border;
				$a2 = $third + $sq_border;
				$total_area = $a1 * $a2;
				$a = $total_area - $in_area;
				$cubic_feet = $a * $first;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "6") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$sq_val = $second / 2;
				$final_val = pow($sq_val, 2);
				$area = 3.14 * $final_val;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "7") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				$a = $third * 2;
				$outer_diameter = $second + $a;
				$sq_val = $outer_diameter / 2;
				$final_val = pow($sq_val, 2);
				$outer_area = 3.14 * $final_val;
				$sq_val2 = $second / 2;
				$final_val2 = pow($sq_val2, 2);
				$inner_area = 3.14 * $final_val2;
				$area = $outer_area - $inner_area;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "8") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				$sq_val = $second / 2;
				$final_val = pow($sq_val, 2);
				$outer_area = 3.14 * $final_val;
				$sq_val2 = $third / 2;
				$final_val2 = pow($sq_val2, 2);
				$inner_area = 3.14 * $final_val2;
				$area = $outer_area - $inner_area;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "9") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				$four = calculate($four, $units4);
				$first_ans = $second + $third + $four;
				$second_ans = $third + $four - $second;
				$third_ans = $four + $second - $third;
				$four_ans = $second + $third - $four;
				$final_ans = $first_ans * $second_ans * $third_ans * $four_ans;
				$final_ans2 = sqrt($final_ans);
				$area = 0.25 * $final_ans2;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "10") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				$four = calculate($four, $units4);
				$first_ans = ($second + $third) / 2;
				$area = $first_ans * $four;
				$cubic_feet = $first * $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "11") {
			if (is_numeric($first) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$area = pow($first, 3);
				$cubic_feet = $area;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "12") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$sq_val = pow($first, 2);
				$cubic_feet = $sq_val * $second * 3.14;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "13") {
			// dd('not get answer');
			if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$third = calculate($third, $units3);
				if ($first > $second) {
					$sq_first = pow($first, 2);
					$sq_second = pow($second, 2);
					$final_answer = $sq_first - $sq_second;
					$area = 3.14 * $final_answer;
					$cubic_feet = $third * $area;
					$cubic_yard = $cubic_feet / 27;
					$cubic_meter = $cubic_feet * 0.0283;
					$cubic_cm = $cubic_feet * 28317;
					$cubic_in = $cubic_feet * 1728;
				} else {
					$this->param['error'] = 'Outer Radius must be greater than Inner Radius';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "14") {
			if (is_numeric($first) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$r_cube = pow($first, 3);
				$final = 2 * 3.14 * $r_cube;
				$cubic_feet = $final / 3;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "15") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
				$first = calculate($first, $units1);
				$second = calculate($second, $units2);
				$r_cube = pow($first, 2);
				$height_ans = $second / 3;
				$cubic_feet = 3.14 * $r_cube * $height_ans;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "16") {
			if (is_numeric($extra_area) && is_numeric($second) && is_numeric($quantity)) {
				$extra_area = calculate_square($extra_area, $extra_units);
				$second = calculate($second, $units2);
				$v = $extra_area * $second;
				$cubic_feet = $v / 3;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "17") {
			if (is_numeric($extra_area) && is_numeric($second) && is_numeric($quantity)) {
				$extra_area = calculate_square($extra_area, $extra_units);
				$second = calculate($second, $units2);
				$cubic_feet = $extra_area * $second;
				$cubic_yard = $cubic_feet / 27;
				$cubic_meter = $cubic_feet * 0.0283;
				$cubic_cm = $cubic_feet * 28317;
				$cubic_in = $cubic_feet * 1728;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		}
		if (isset($quantity)) {
			$cubic_feet = $cubic_feet * $quantity;
			$cubic_yard = $cubic_yard * $quantity;
			$cubic_meter = $cubic_meter * $quantity;
			$cubic_cm = $cubic_cm * $quantity;
			$cubic_in = $cubic_in * $quantity;
		}
		if (is_numeric($price)) {
			if ($price_unit == "ft³") {
				$ft_price = $cubic_feet * $price;
				$estimated_price = number_format($ft_price, 2);
			} else if ($price_unit == "yd³") {
				$yd_price = $cubic_yard * $price;
				$estimated_price = number_format($yd_price, 2);
			} else if ($price_unit == "m³") {
				$m_price = $cubic_meter * $price;
				$estimated_price = number_format($m_price, 2);
			}
		}
		if (is_float($cubic_feet)) {
			$cubic_feet = number_format($cubic_feet, 2);
		}
		$cubic_meter = number_format($cubic_meter, 2);
		$cubic_yard = number_format($cubic_yard, 2);
		$cubic_cm = number_format($cubic_cm, 2);
		$cubic_in = number_format($cubic_in, 2);
		$this->param['cubic_feet'] = $cubic_feet;
		$this->param['cubic_yard'] = $cubic_yard;
		$this->param['cubic_meter'] = $cubic_meter;
		$this->param['cubic_cm'] = $cubic_cm;
		$this->param['cubic_in'] = $cubic_in;
		if (!empty($estimated_price)) {
			$this->param['estimated_price'] = $estimated_price;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// pearson age calculator
	public function pearson($request)
	{
		$dob = $request->input('date1');
		$date = $request->input('date');

		if (!empty($dob) && !empty($date)) {
			$date = explode("-", $date);
			$dob2 = explode("-", $dob);
			$birth_month = $dob2[1];
			$bday = new Carbon($dob2[2] . '.' . $dob2[1] . '.' . $dob2[0]); // Your date of birth
			$today = new Carbon($date[2] . '.' . $date[1] . '.' . $date[0]);
			$diff = $today->diff($bday);
			$age_years = $diff->y;
			$age_months = $diff->m;
			$age_days = $diff->d;

			$d = getdate();		// Current date

			$year = $d['year'];
			$mon = $d['mon'];
			$mday = $d['mday'];
			$hour = $d['hours'];
			$min = $d['minutes'];
			$sec = $d['seconds'];
			@$d1 = mktime($dob_hour, $dob_min, $dob_sec, $dob2[1], $dob2[2], $dob2[0]);
			$d2 = mktime($hour, $min, $sec, $mon, $mday, $year);
			$obj = new Age;
			@$obj->calculateAge(mktime($dob_hour, $dob_min, $dob_sec, $dob2[1], $dob2[2], $dob2[0]));
			// Alert
			if (($d2 - $d1) <= 0) {
				$this->param['error'] = 'Invalid Date of Birth.';
				return $this->param;
			}
			$age = $obj->getAge();
			$rank = $obj->get_rank($age + 1);
			$Totalyears = floor(($d2 - $d1) / 31536000);
			$Total_months = floor(($d2 - $d1) / 2628000);
			$Total_weeks = floor(($d2 - $d1) / 604800);
			$Total_days = floor(($d2 - $d1) / 86400);
			$Total_hours = floor(($d2 - $d1) / 3600);
			$Total_minuts = floor(($d2 - $d1) / 60);
			$Total_seconds = ($d2 - $d1);
			$nbday = new Carbon($mday . '.' . $mon . '.' . $year);
			if ($mon > $dob2[1] || $mon == $dob2[1]) {
				$year = $year + 1;
			}
			if ($mon == $dob2[1] && $mday < $dob2[2]) {
				$year = $year - 1;
			}
			$ntoday = new Carbon($dob2[2] . '.' . $dob2[1] . '.' . $year); // Your date of birth
			$ndiff = $ntoday->diff($nbday);
			$next_r_mon = $ndiff->m;
			$next_r_day = $ndiff->d;
			$this->param = array(
				"Age" => $age,
				"Age_years" => $age_years,
				"Age_months" => $age_months,
				"Age_days" => $age_days,
				"birth_month" => $birth_month,
				"N_r_months" => $next_r_mon,
				"N_r_days" => $next_r_day,
				"Years" => $Totalyears,
				"Months" => $Total_months,
				"Weeks" => $Total_weeks,
				"Days" => $Total_days,
				"Hours" => $Total_hours,
				"Min" => $Total_minuts,
				"Sec" => $Total_seconds
			);
			// dd($this->param);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please Select Your Date of Birth.';
			return $this->param;
		}
	}

	// brick calculator
	public function brick($request)
	{
		$wall_type                   = trim($request->input('wall_type'));
		$wall_length                 = trim($request->input('wall_length'));
		$wall_length_unit            = trim($request->input('wall_length_unit'));
		$wall_width                  = trim($request->input('wall_width'));
		$wall_width_unit             = trim($request->input('wall_width_unit'));
		$wall_height                 = trim($request->input('wall_height'));
		$wall_height_unit            = trim($request->input('wall_height_unit'));
		// --------------Brick Fields -------------------------
		$brick_type                  = trim($request->input('brick_type'));
		$brick_wastage               = trim($request->input('brick_wastage'));
		$mortar_joint_thickness      = trim($request->input('mortar_joint_thickness'));
		$mortar_joint_thickness_unit = trim($request->input('mortar_joint_thickness_unit'));
		$brick_length                = trim($request->input('brick_length'));
		$brick_length_unit           = trim($request->input('brick_length_unit'));
		$brick_width                 = trim($request->input('brick_width'));
		$brick_width_unit            = trim($request->input('brick_width_unit'));
		$brick_height                = trim($request->input('brick_height'));
		$brick_height_unit           = trim($request->input('brick_height_unit'));
		// --------------Mortar Fields -------------------------
		$with_motar                  = trim($request->input('with_motar'));
		$wet_volume                  = trim($request->input('wet_volume'));
		$wet_volume_unit             = trim($request->input('wet_volume_unit'));
		$mortar_wastage              = trim($request->input('mortar_wastage'));
		$mortar_ratio                = trim($request->input('mortar_ratio'));
		$bag_size                    = trim($request->input('bag_size'));
		$bag_size_unit               = trim($request->input('bag_size_unit'));
		// -------------Cost Fields ----------------------------
		$price_per_brick             = trim($request->input('price_per_brick'));
		$price_of_cement             = trim($request->input('price_of_cement'));
		$price_sand_per_volume       = trim($request->input('price_sand_per_volume'));
		$price_sand_volume_unit      = trim($request->input('price_sand_volume_unit'));
		$currancy = $request->input('currancy');
		$price_sand_volume_unit = str_replace($currancy . ' ', '', $price_sand_volume_unit);
		// dd($price_sand_volume_unit);
		function convert_to_meter($unit, $value)
		{
			if ($unit == 'cm') {
				$ans = $value / 100;
			} elseif ($unit == 'm') {
				$ans = $value;
			} elseif ($unit == 'in') {
				$ans = $value / 39.37;
			} elseif ($unit == 'ft') {
				$ans = $value /  3.281;
			} elseif ($unit == 'yd') {
				$ans = $value /  1.094;
			} elseif ($unit == 'dm') {
				$ans = $value / 10;
			} elseif ($unit == 'mm') {
				$ans = $value / 1000;
			}
			return $ans;
		}
		function convert_to_millimeter($unit, $value)
		{
			if ($unit == 'cm') {
				$ans = $value * 10;
			} elseif ($unit == 'm') {
				$ans = $value * 1000;
			} elseif ($unit == 'in') {
				$ans = $value * 25.4;
			} elseif ($unit == 'ft') {
				$ans = $value * 304.8;
			} elseif ($unit == 'yd') {
				$ans = $value * 914.4;
			} elseif ($unit == 'dm') {
				$ans = $value * 100;
			} elseif ($unit == 'mm') {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_kilo($unit, $value)
		{
			if ($unit == 'g') {
				$ans = $value / 1000;
			} elseif ($unit == 'lb') {
				$ans = $value / 2.205;
			} elseif ($unit == 't') {
				$ans = $value * 1000;
			} elseif ($unit == 'stone') {
				$ans = $value * 6.35029;
			} elseif ($unit == 'kg') {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_meter_cube($unit, $value)
		{
			if ($unit == 'cm³') {
				$ans = $value / 1000000;
			} elseif ($unit == 'cu_ft') {
				$ans = $value / 35.315;
			} elseif ($unit == 'cu_yd') {
				$ans = $value / 1.308;
			} elseif ($unit == 'm³') {
				$ans = $value;
			}
			return $ans;
		}
		if (is_numeric($wall_width) || is_numeric($mortar_joint_thickness) || is_numeric($wall_width) || is_numeric($brick_width)) {
			if ($wall_length >= 0 && $wall_width >= 0 && $wall_height >= 0 && $mortar_joint_thickness >= 0 && $brick_wastage >= 0 && $brick_length >= 0 && $brick_width >= 0 && $brick_height >= 0 && $price_per_brick >= 0) {
				// dd($wall_length_unit	);
				$wall_length = convert_to_meter($wall_length_unit, $wall_length);
				$wall_width = convert_to_meter($wall_width_unit, $wall_width);
				$wall_height = convert_to_meter($wall_height_unit, $wall_height);
				$mortar_joint_thickness = convert_to_meter($mortar_joint_thickness_unit, $mortar_joint_thickness);
				// -------------------------Wall Area---------------------------------------
				$wall_area = $wall_length * $wall_height;

				// -------------------------Brick Calculation----------------------------------
				if ($brick_type == 1) {
					$brick_length = convert_to_meter($brick_length_unit, $brick_length);
					$brick_height = convert_to_meter($brick_height_unit, $brick_height);
					$brick_width = convert_to_meter($brick_width_unit, $brick_width);
				} else {
					$brick_array = explode('x', $brick_type);
					$brick_length = convert_to_meter('in', $brick_array[0]);
					$brick_height = convert_to_meter('in', $brick_array[1]);
				}
				// -------------------------Brick Area---------------------------------------
				$brick_sum = ($brick_length + $mortar_joint_thickness) * ($brick_height + $mortar_joint_thickness);
				$no_of_bricks = ceil($wall_area / $brick_sum);
				$wastage = ceil(($brick_wastage * $no_of_bricks) / 100);

				$no_of_bricks_with_wastage = round($no_of_bricks + $wastage);

				if ($wall_type == 'double') {
					$no_of_bricks = $no_of_bricks * 2;
					$no_of_bricks_with_wastage = $no_of_bricks_with_wastage * 2;
				}

				// ---------------------------Calculate Cost-----------------------------------
				$cost_of_bricks = $price_per_brick * $no_of_bricks_with_wastage;

				// ----------------------------With Mortar check -------------------------------
				if ($with_motar == 'no') {
					$this->param['wall_area']                 = $wall_area;
					$this->param['no_of_bricks']              = $no_of_bricks;
					$this->param['no_of_bricks_with_wastage'] = $no_of_bricks_with_wastage;
					$this->param['cost_of_bricks']            = $cost_of_bricks;
					$this->param['RESULT']                    = 1;
					return $this->param;
				} elseif ($with_motar == 'yes') {
					if (is_numeric($wet_volume) && is_numeric($mortar_wastage) && is_numeric($bag_size) && is_numeric($price_of_cement) && is_numeric($price_sand_per_volume)) {
						if ($wet_volume >= 0 && $mortar_wastage >= 0 && $bag_size >= 0 && $price_of_cement >= 0 && $price_sand_per_volume >= 0) {
							// --------------------------Mortar Needed----------------------------
							$wet_volume = convert_to_meter_cube($wet_volume_unit, $wet_volume);
							$dry_volume = $wet_volume + (52 * $wet_volume / 100);
							$dry_volume_wastage = ($mortar_wastage * $dry_volume) / 100;
							$dry_volume_with_wastage = $dry_volume + $dry_volume_wastage;

							// ---------------------------Mortar Component------------------------

							$ratio = explode(':', $mortar_ratio);
							$cement_ratio = $ratio[0];
							$sand_ratio = $ratio[1];
							$total_ratio = $cement_ratio + $sand_ratio;

							$volume_of_cement = round(($dry_volume_with_wastage * $cement_ratio) / $total_ratio, 4);
							$weight_of_cement = $volume_of_cement * 1440;
							$bag_size = convert_to_kilo($bag_size_unit, $bag_size);
							$number_of_bags = ceil($weight_of_cement / $bag_size);
							$volume_of_sand = round(($dry_volume_with_wastage * $sand_ratio) / $total_ratio, 4);

							$price_sand_per_volume = convert_to_meter_cube($price_sand_volume_unit, $price_sand_per_volume);
							$price_of_sand = $price_sand_per_volume * $volume_of_sand;
							$price_for_cement = $number_of_bags * $price_of_cement;
							$mortar_cost = $price_for_cement + $price_of_sand;

							$total_cost = $cost_of_bricks + $mortar_cost;

							$this->param['wall_area']                 = $wall_area;
							$this->param['no_of_bricks']              = $no_of_bricks;
							$this->param['no_of_bricks_with_wastage'] = $no_of_bricks_with_wastage;
							$this->param['cost_of_bricks']            = $cost_of_bricks;
							$this->param['dry_volume']                = $dry_volume;
							$this->param['dry_volume_with_wastage']   = $dry_volume_with_wastage;
							$this->param['volume_of_cement']          = $volume_of_cement;
							$this->param['number_of_bags']            = $number_of_bags;
							$this->param['volume_of_sand']            = $volume_of_sand;
							$this->param['mortar_cost']               = $mortar_cost;
							$this->param['total_cost']                = $total_cost;
							$this->param['RESULT']                    = 1;
							return $this->param;
						} else {
							$this->param['error'] = 'Please! Enter Positive Values';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
				}
			} else {
				$this->param['error'] = 'Please! Enter Positive Values';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Tv Size Calculator
	public function tv($request)
	{
		$submit = trim($request->input('selection'));
		$size = trim($request->input('size'));
		$size_unit = trim($request->input('size_unit'));
		$resolution = trim($request->input('resolution'));
		$angle = trim($request->input('angle'));
		$angle_unit = trim($request->input('angle_unit'));
		$distance = trim($request->input('distance'));
		$distance_unit = trim($request->input('distance_unit'));


		function sigFig($value, $digits)
		{
			if ($value !== '') {
				if ($value === 0) {
					$decimalPlaces = $digits - 1;
				} elseif ($value < 0) {
					$decimalPlaces = $digits - floor(log10($value * -1)) - 1;
				} else {
					$decimalPlaces = $digits - floor(log10($value)) - 1;
				}
				$answer = round($value, $decimalPlaces);
				return $answer;
			}
		}

		if ($submit === 'size') {
			if (is_numeric($size) && !empty($size_unit) && !empty($resolution)) {
				if ($size_unit === 'cm') {
					$size = $size / 2.54;
				} elseif ($size_unit === 'm') {
					$size = $size / 0.0254;
				} elseif ($size_unit === 'ft') {
					$size = $size / 0.08333;
				}
				$width = (16 / sqrt(pow(16, 2) + (pow(9, 2))) * $size);
				$height = $size * 0.49;
				$pixels = (16 / 9) * (float)$resolution;
				$new_angle = $pixels / 60;
				$md = $width / (2 * tan(deg2rad($new_angle / 2)));
				$unit = $size_unit;

				$md_cm = $md * 2.54;
				$md_m = $md * 0.0254;
				$md_ft = $md * 0.08333;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($submit === 'distance') {
			if (is_numeric($distance) && !empty($distance_unit)) {
				if ($resolution === '480p') {
					$jugaad = 0.28616;
				} elseif ($resolution === '720p') {
					$jugaad = 0.4322;
				} elseif ($resolution === '1080p') {
					$jugaad = 0.658;
				} elseif ($resolution === 'ultra_hd') {
					$jugaad = 1.434;
				} elseif ($resolution === '4k') {
					$jugaad = 1.5556;
				} elseif ($resolution === '8k') {
					$jugaad = 4.705;
				}
				$pixels = (16 / 9) * (float)$resolution;
				$new_angle = $pixels / 60;
				$width = $distance * (2 * tan(deg2rad($new_angle / 2)));
				$width = $width / 0.08333;
				$size =  $distance * $jugaad;
				$size = $size / 0.08333;
				$height = $size * 0.49;
				$md = $distance;
				$unit = $distance_unit;

				$md_cm = $md * 30.5;
				$md_m = $md * 0.305;
				$md_ft = $md;
				$md = $md * 12;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$od = '';
		if (is_numeric($angle) && !empty($angle_unit)) {
			if ($angle_unit === 'deg') {
				$angle = deg2rad($angle);
			}
			if ($angle > 3.14159265358) {
				$this->param['error'] = "Flat screens have a 180° field of vision; you can't see beyond that angle (unless your nose is touching it 😉).";
				return $this->param;
			}
			$tan = tan($angle / 2);
			$od = 0.5 * $width / $tan;
		}

		// Units Conversion
		$size_cm = $size * 2.54;
		$size_m = $size * 0.0254;
		$size_ft = $size * 0.08333;

		$width_cm = $width * 2.54;
		$width_m = $width * 0.0254;
		$width_ft = $width * 0.08333;

		$height_cm = $height * 2.54;
		$height_m = $height * 0.0254;
		$height_ft = $height * 0.08333;

		if (!empty($od)) {
			$od_cm = $od * 2.54;
			$od_m = $od * 0.0254;
			$od_ft = $od * 0.08333;
		} else {
			$od_cm = '';
			$od_m = '';
			$od_ft = '';
		}

		$units_cm = [sigFig($size_cm, 4), sigFig($width_cm, 4), sigFig($height_cm, 4), sigFig($od_cm, 3), sigFig($md_cm, 3)];
		$units_m = [sigFig($size_m, 4), sigFig($width_m, 4), sigFig($height_m, 4), sigFig($od_m, 3), sigFig($md_m, 3)];
		$units_in = [sigFig($size, 4), sigFig($width, 4), sigFig($height, 4), sigFig($od, 3), sigFig($md, 3)];
		$units_ft = [sigFig($size_ft, 4), sigFig($width_ft, 4), sigFig($height_ft, 4), sigFig($od_ft, 3), sigFig($md_ft, 3)];
		$ans = [sigFig($size, 4), sigFig($width, 4), sigFig($height, 4), sigFig($od_ft, 3), sigFig($md_ft, 3)];

		$this->param['ans'] = $ans;
		$this->param['unit'] = $unit;
		$this->param['units_cm'] = $units_cm;
		$this->param['units_m'] = $units_m;
		$this->param['units_in'] = $units_in;
		$this->param['units_ft'] = $units_ft;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	// Rebar calculator	
	public function rebar($request)
	{
		$first = $request->input('first');
		$units1 = $request->input('units1');
		$second = $request->input('second');
		$units2 = $request->input('units2');
		$third = $request->input('third');
		$units3 = $request->input('units3');
		$four = $request->input('four');
		$units4 = $request->input('units4');
		$five = $request->input('five');
		$units5 = $request->input('units5');
		$six = $request->input('six');
		$units6 = $request->input('units6');
		$currancy = $request->input('currancy');
		$units5 = str_replace($currancy . ' ', '', $units5);
		function cm_unit($a, $b)
		{
			if ($a == "cm") {
				$convert = $b * 1;
			} elseif ($a == "m") {
				$convert = $b * 100;
			} elseif ($a == "km") {
				$convert = $b * 100000;
			} elseif ($a == "in") {
				$convert = $b *  2.54;
			} elseif ($a == "ft") {
				$convert = $b * 30.48;
			} elseif ($a == "yd") {
				$convert = $b * 91.44;
			} elseif ($a == "mi") {
				$convert = $b * 30.48;
			}
			return $convert;
		}
		function cm_unit2($a, $b)
		{
			if ($a == "mm") {
				$convert2 = $b / 10;
			} elseif ($a == "cm") {
				$convert2 = $b * 1;
			} elseif ($a == "m") {
				$convert2 = $b * 100;
			} elseif ($a == "in") {
				$convert2 = $b *  2.54;
			} elseif ($a == "ft") {
				$convert2 = $b * 30.48;
			} elseif ($a == "yd") {
				$convert2 = $b * 91.44;
			}
			return $convert2;
		}
		function cm_unit3($a, $b)
		{
			if ($a == "cm") {
				$convert3 = $b * 1;
			} elseif ($a == "m") {
				$convert3 = $b * 100;
			} elseif ($a == "in") {
				$convert3 = $b * 2.54;
			} elseif ($a == "ft") {
				$convert3 = $b *  30.48;
			} elseif ($a == "yd") {
				$convert3 = $b * 91.44;
			}
			return $convert3;
		}

		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($six)) {
			$first = cm_unit($units1, $first);
			$second = cm_unit($units2, $second);
			$third = cm_unit2($units3, $third);
			$four = cm_unit2($units4, $four);
			$five = cm_unit3($units5, $five);
			$six = cm_unit3($units6, $six);
			$mul1 = 2 * $four;
			$grid_len = $first - $mul1;
			$grid_wid = $second - $mul1;

			$rebar_col = $grid_len / $third;
			$rebar_row = $grid_wid / $third;
			$part1 = $rebar_col * $grid_wid;
			$part2 = $rebar_row * $grid_len;
			$trl = $part1 + $part2;
			$price_s = $five * $six;
			$rebar_pie = $trl / $six;
			$cost = round($rebar_pie) * $price_s;
		} else {
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
		$this->param['grid_len'] = $grid_len;
		$this->param['grid_wid'] = $grid_wid;
		$this->param['trl'] = $trl;
		$this->param['rebar_pie'] = $rebar_pie;
		$this->param['cost'] = $cost;
		$this->param['price_s'] = $price_s;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Average time Calculator
	public function average($request)
	{
		$count_val = $request->input('count_val');
		$inhour = $request->input('inhour');
		$inminutes = $request->input('inminutes');
		$inseconds = $request->input('inseconds');
		$inmiliseconds = $request->input('inmiliseconds');
		$checkbox1 = $request->input('checkbox1');
		$checkbox2 = $request->input('checkbox2');
		$checkbox3 = $request->input('checkbox3');
		$checkbox4 = $request->input('checkbox4');
		function calc_time(array $times)
		{
			$i = 0;
			foreach ($times as $time) {
				sscanf($time, '%d:%d:%d', $hour, $min, $sec);
				$i += $hour * 3600 + $min * 60 + $sec;
			}
			return $i;
		}
		function avg_time(array $times)
		{
			$i = calc_time($times);
			$i = round($i / count($times));
			if ($h = floor($i / 3600)) $i %= 3600;
			if ($m = floor($i / 60)) $i %= 60;
			$h = sprintf('%02d', $h);
			$m = sprintf('%02d', $m);
			$s = sprintf('%02d', $i);
			return array($h, $m, $s);
		}
		$i = 0;
		while ($i < $count_val) {
			if ($checkbox1 == false) {
				$inhour[$i] = 0;
			} else {
				if ($inhour[$i] === "") {
					$inhour[$i] = 0;
				}
			}
			if ($checkbox2 == false) {
				$inminutes[$i] = 0;
			} else {
				if ($inminutes[$i] === "") {
					$inminutes[$i] = 0;
				}
			}

			if ($checkbox3 == false) {
				$inseconds[$i] = 0;
			} else {
				if ($inseconds[$i] === "") {
					$inseconds[$i] = 0;
				}
			}
			if ($checkbox4 == false) {
				$inmiliseconds[$i] = 0;
			} else {
				if ($inmiliseconds[$i] === "") {
					$inmiliseconds[$i] = 0;
				}
			}
			if (is_numeric($inhour[$i]) && is_numeric($inminutes[$i]) && is_numeric($inseconds[$i]) && is_numeric($inmiliseconds[$i])) {
				$hour_list[] = $inhour[$i];
				$min_list[] = $inminutes[$i];
				$sec_list[] = $inseconds[$i];
				$mili_list[] = $inmiliseconds[$i];
				$total_seconds = ($inhour[$i] * 3600) + ($inminutes[$i] * 60) + $inseconds[$i];
				$hours = floor($total_seconds / 3600);
				$mins = floor($total_seconds / 60 % 60);
				$secs = floor($total_seconds % 60);
				$hoursminsandsecs[] = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
			} else {
				$this->param['error'] =  'Please! Check Your Input';
				return $this->param;
			}
			$i++;
		}
		list($hr, $min, $s) = avg_time($hoursminsandsecs);
		$totalo_milisec = array_sum($mili_list);
		$mili_jawab = $totalo_milisec / count($mili_list);
		$this->param['hour_list'] = $hour_list;
		$this->param['min_list'] = $min_list;
		$this->param['sec_list'] = $sec_list;
		$this->param['mili_list'] = $mili_list;
		$this->param['time_hour'] = sprintf('%02d', $hr);
		$this->param['time_seconds'] = sprintf('%02d', $s);
		$this->param['time_minutes'] = sprintf('%02d', $min);
		$this->param['time_miliseconds'] = $mili_jawab;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Material Calculator   
	public function material($request)
	{
		$operations = $request->input('operations');
		$ex_drop = $request->input('ex_drop');
		$first = $request->input('first');
		$unit1 = $request->input('units1');
		$second = $request->input('second');
		$unit2 = $request->input('units2');
		$third = $request->input('third');
		$unit3 = $request->input('units3');
		$four = $request->input('four');
		$unit4 = $request->input('units4');
		$five = $request->input('five');
		$unit5 = $request->input('units5');
		$six = $request->input('six');
		$unit6 = $request->input('units6');
		$seven = $request->input('seven');
		$unit7 = $request->input('units7');
		$currancy = $request->input('currancy');
		$unit6 = str_replace($currancy . ' ', '', $unit6);
		$unit7 = str_replace($currancy . ' ', '', $unit7);
		// dd($unit7);
		function feet($unit, $value)
		{
			if ($unit == "in") {
				return $value; // Already in inches
			} elseif ($unit == "ft") {
				return $value * 12; // Convert feet to inches
			} elseif ($unit == "cm") {
				return $value * 0.39370; // Convert centimeters to inches
			} elseif ($unit == "m") {
				return $value * 39.3701; // Convert meters to inches
			} elseif ($unit == "yd") {
				return $value * 36; // Convert yards to inches
			} else {
				return "Invalid unit";
			}
		}
		function feet2($unit, $value)
		{
			if ($unit == "in³") {
				return $value; // Already in inches
			} elseif ($unit == "ft³") {
				return $value * 12; // Convert feet to inches
			} elseif ($unit == "cm³") {
				return $value * 0.39370; // Convert centimeters to inches
			} elseif ($unit == "m³") {
				return $value * 39.3701; // Convert meters to inches
			} elseif ($unit == "yd³") {
				return $value * 36; // Convert yards to inches
			} else {
				return "Invalid unit";
			}
		}
		function lb($a, $b)
		{
			if ($a == "lb") {
				// dd($a,$b);
				$convert1 = $b * 1;
			} elseif ($a == "t") {
				$convert1 = $b * 2000;
			} elseif ($a == "long t") {
				$convert1 = $b * 2240;
			} elseif ($a == "kg") {
				$convert1 = $b * 2.205;
			}
			return $convert1;
		}
		if ($operations == "1") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$first = feet($unit1, $first);
				$second = feet($unit2, $second);
				$third = feet($unit3, $third);
				$area = $first * $second;
				$volume = $area * $third;
				$weight = $ex_drop * ($volume / 1728);
				$this->param['area'] = $area;
				$this->param['volume'] = $volume;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($operations == "2") {
			if (is_numeric($third) && is_numeric($four)) {
				$third = feet($unit3, $third);
				$four = feet($unit4, $four);
				$volume = $four * $third;
				$weight = $ex_drop * ($volume / 1728);
				$this->param['volume'] = $volume;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($operations == "3") {
			if (is_numeric($five)) {
				$five = feet2($unit5, $five);
				$volume = $five;
				$weight = $ex_drop * ($volume / 1728);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		if (is_numeric($six)) {
			$six = lb($unit6, $six);
			$this->param['cost_mass'] = $six * $weight;
		}
		if (is_numeric($seven)) {
			$seven = feet2($unit7, $seven);
			$this->param['cost_volume'] = $volume * $seven;
			// dd($cost_volume);
		}
		$this->param['weight'] = $weight;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Square Yards Calculator
	function square($request)
	{
		$first = $request->input('first');
		$unit1 = $request->input('unit1');
		$second = $request->input('second');
		$unit2 = $request->input('unit2');
		$unit3 = $request->input('unit3');
		$third = $request->input('third');
		$currancy = $request->input('currancy');
		$unit3 = str_replace($currancy . ' ', '', $unit3);
		// dd($request->input());
		function con_cm($a, $b)
		{
			if ($a == "mm") {
				$centi = $b / 10;
			} elseif ($a == "cm") {
				$centi = $b * 1;
			} elseif ($a == "m") {
				$centi = $b / 100;
			} elseif ($a == "in") {
				$centi = $b * 2.54;
			} elseif ($a == "ft") {
				$centi = $b * 30.48;
			} elseif ($a == "yd") {
				$centi = $b * 91.44;
			}
			return $centi;
		}
		function con_cm_sq($a, $b)
		{
			// dd($a,$b);
			if ($a == "mm²") {
				$foot = $b / 10;
			} elseif ($a == "cm²") {
				$foot = $b * 1;
			} elseif ($a == "dm") {
				$foot = $b * 10;
			} elseif ($a == "m²") {
				$foot = $b * 100;
			} elseif ($a == "km²") {
				$foot = $b * 100000;
			} elseif ($a == "in²") {
				$foot = $b * 2.54;
			} elseif ($a == "ft²") {
				$foot = $b * 30.48;
			} elseif ($a == "yd²") {
				$foot = $b * 91.44;
			} elseif ($a == "a") {
				$foot = $b * 1000000;
			} elseif ($a == "da") {
				$foot = $b * 1000;
			} elseif ($a == "ha") {
				$foot = $b * 100000000;
			} elseif ($a == "ac") {
				$foot = $b * 40468564.224;
			}
			return $foot;
		}
		if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
			// dd($unit1,$first);
			$first = con_cm($unit1, $first);
			$second = con_cm($unit2, $second);
			$third = con_cm_sq($unit3, $third);
			$yd_ans = $first * $second;
			$price = $yd_ans * $third;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['yd_ans'] = $yd_ans;
		$this->param['price'] = $price;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Add Time Calculator
	public function add()
	{
		if (isset($_POST['inhour'])) {
			$inhour = $_POST['inhour'];
		} else {
			$inhour = false;
		}
		if (isset($_POST['inminutes'])) {
			$inminutes = $_POST['inminutes'];
		} else {
			$inminutes = false;
		}
		if (isset($_POST['inseconds'])) {
			$inseconds = $_POST['inseconds'];
		} else {
			$inseconds = false;
		}
		if (isset($_POST['inmiliseconds'])) {
			$inmiliseconds = $_POST['inmiliseconds'];
		} else {
			$inmiliseconds = false;
		}
		if (isset($_POST['checkbox1'])) {
			$checkbox1 = $_POST['checkbox1'];
		} else {
			$checkbox1 = false;
		}
		if (isset($_POST['checkbox2'])) {
			$checkbox2 = $_POST['checkbox2'];
		} else {
			$checkbox2 = false;
		}
		if (isset($_POST['checkbox3'])) {
			$checkbox3 = $_POST['checkbox3'];
		} else {
			$checkbox3 = false;
		}
		if (isset($_POST['checkbox4'])) {
			$checkbox4 = $_POST['checkbox4'];
		} else {
			$checkbox4 = false;
		}

		function convertMilliseconds($milliseconds)
		{
			$seconds = 0;
			$minutes = 0;
			$hours = 0;

			if ($milliseconds >= 1000) {
				$seconds += floor($milliseconds / 1000);
				$milliseconds %= 1000;
			}

			if ($seconds >= 60) {
				$minutes += floor($seconds / 60);
				$seconds %= 60;
			}

			if ($minutes >= 60) {
				$hours += floor($minutes / 60);
				$minutes %= 60;
			}

			return array($hours, $minutes, $seconds, $milliseconds);
		}
		$count_val = $_POST['count_val'];
		$time_hour = 0;
		$time_minutes = 0;
		$time_seconds = 0;
		$time_miliseconds = 0;
		$i = 0;
		while ($i < $count_val) {
			// if ($inhour[$i] === "" && $inminutes[$i] === ""  && $inseconds[$i] === "" && $inmiliseconds[$i] === "") {
			// 	$this->session->set_flashdata('add', 'Please! Check Your Input');
			// 	return false;
			// }

			if ($checkbox1 == false) {
				$inhour[$i] = 0;
			} else {
				if ($inhour[$i] === "") {
					$inhour[$i] = 0;
				}
			}

			if ($checkbox2 == false) {
				$inminutes[$i] = 0;
			} else {
				if ($inminutes[$i] === "") {
					$inminutes[$i] = 0;
				}
			}

			if ($checkbox3 == false) {
				$inseconds[$i] = 0;
			} else {
				if ($inseconds[$i] === "") {
					$inseconds[$i] = 0;
				}
			}
			if ($checkbox4 == false) {
				$inmiliseconds[$i] = 0;
			} else {
				if ($inmiliseconds[$i] === "") {
					$inmiliseconds[$i] = 0;
				}
			}
			if (is_numeric($inhour[$i]) && is_numeric($inminutes[$i]) && is_numeric($inseconds[$i]) && is_numeric($inmiliseconds[$i])) {
				$time_hour +=  $inhour[$i];
				$hour_list[] = $inhour[$i];
				$time_minutes += $inminutes[$i];
				$min_list[] = $inminutes[$i];
				$time_seconds += $inseconds[$i];
				$sec_list[] = $inseconds[$i];
				$time_miliseconds += $inmiliseconds[$i];
				$mili_list[] = $inmiliseconds[$i];
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
			$i++;
		}
		list($hours, $minutes, $seconds, $remainingMilliseconds) = convertMilliseconds($time_miliseconds);
		$time_hour += $hours;
		$time_minutes += $minutes;
		$time_seconds += $seconds;
		$time_miliseconds = $remainingMilliseconds;
		if ($time_minutes >= 60) {
			$time_hour += floor($time_minutes / 60);
			$time_minutes %= 60;
		}
		if ($time_seconds >= 60) {
			$time_minutes += floor($time_seconds / 60);
			$time_seconds %= 60;
			if ($time_minutes >= 60) {
				$time_hour += floor($time_minutes / 60);
				$time_minutes %= 60;
			}
		}
		$this->param['hour_list'] = $hour_list;
		$this->param['min_list'] = $min_list;
		$this->param['sec_list'] = $sec_list;
		$this->param['mili_list'] = $mili_list;
		$this->param['time_hour'] = $time_hour;
		$this->param['time_seconds'] = $time_seconds;
		$this->param['time_minutes'] = $time_minutes;
		$this->param['time_miliseconds'] = $time_miliseconds;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// Retirement Age Calculator
	function retirement($request)
	{
		$age = $request->input("age");
		$data = [
			"1943" => [
				[
					[62, 75.0, 35.0],
					["62 + 1", 75.4, 35.2],
					["62 + 2", 75.8, 35.4],
					["62 + 3", 76.3, 35.6],
					["62 + 4", 76.7, 35.8],
					["62 + 5", 77.1, 36.0],
					["62 + 6", 77.5, 36.3],
					["62 + 7", 77.9, 36.5],
					["62 + 8", 78.3, 36.7],
					["62 + 9", 78.8, 36.9],
					["62 + 10", 79.2, 37.1],
					["62 + 11", 79.6, 37.3],
					[63, 80.0, 37.5],
					["63 + 1", 80.6, 37.8],
					["63 + 2", 81.1, 38.2],
					["63 + 3", 81.7, 38.5],
					["63 + 4", 82.2, 38.9],
					["63 + 5", 82.8, 39.2],
					["63 + 6", 83.3, 39.6],
					["63 + 7", 83.9, 39.9],
					["63 + 8", 84.4, 40.3],
					["63 + 9", 85.0, 40.6],
					["63 + 10", 85.6, 41.0],
					["63 + 11", 86.1, 41.3],
					[64, 86.7, 41.7],
					["64 + 1", 87.2, 42.0],
					["64 + 2", 87.8, 42.4],
					["64 + 3", 88.3, 42.7],
					["64 + 4", 88.9, 43.1],
					["64 + 5", 89.4, 43.4],
					["64 + 6", 90.0, 43.8],
					["64 + 7", 90.6, 44.1],
					["64 + 8", 91.1, 44.4],
					["64 + 9", 91.7, 44.8],
					["64 + 10", 92.2, 45.1],
					["64 + 11", 92.8, 45.5],
					[65, 93.3, 45.8],
					["65 + 1", 93.9, 46.2],
					["65 + 2", 94.4, 46.5],
					["65 + 3", 95.0, 46.9],
					["65 + 4", 95.6, 47.2],
					["65 + 5", 96.1, 47.6],
					["65 + 6", 96.7, 47.9],
					["65 + 7", 97.2, 48.3],
					["65 + 8", 97.8, 48.6],
					["65 + 9", 98.3, 49.0],
					["65 + 10", 98.9, 49.3],
					["65 + 11", 99.4, 49.7],
					[66, 100.0, 50.0]
				],
				"66 Years"
			],
			"1955" => [
				[
					[62, 74.2, 34.6],
					["62 + 1", 74.6, 34.8],
					["62 + 2", 75.0, 35.0],
					["62 + 3", 75.4, 35.2],
					["62 + 4", 75.8, 35.4],
					["62 + 5", 76.3, 35.6],
					["62 + 6", 76.7, 35.8],
					["62 + 7", 77.1, 36.0],
					["62 + 8", 77.5, 36.3],
					["62 + 9", 77.9, 36.5],
					["62 + 10", 78.3, 36.7],
					["62 + 11", 78.8, 36.9],
					[63, 79.2, 37.1],
					["63 + 1", 79.6, 37.3],
					["63 + 2", 80.0, 37.5],
					["63 + 3", 80.6, 37.8],
					["63 + 4", 81.1, 38.2],
					["63 + 5", 81.7, 38.5],
					["63 + 6", 82.2, 38.9],
					["63 + 7", 82.8, 39.2],
					["63 + 8", 83.3, 39.6],
					["63 + 9", 83.9, 39.9],
					["63 + 10", 84.4, 40.3],
					["63 + 11", 85.0, 40.6],
					[64, 85.6, 41.0],
					["64 + 1", 86.1, 41.3],
					["64 + 2", 86.7, 41.7],
					["64 + 3", 87.2, 42.0],
					["64 + 4", 87.8, 42.4],
					["64 + 5", 88.3, 42.7],
					["64 + 6", 88.9, 43.1],
					["64 + 7", 89.4, 43.4],
					["64 + 8", 90.0, 43.8],
					["64 + 9", 90.6, 44.1],
					["64 + 10", 91.1, 44.4],
					["64 + 11", 91.7, 44.8],
					[65, 92.2, 45.1],
					["65 + 1", 92.8, 45.5],
					["65 + 2", 93.3, 45.8],
					["65 + 3", 93.9, 46.2],
					["65 + 4", 94.4, 46.5],
					["65 + 5", 95.0, 46.9],
					["65 + 6", 95.6, 47.2],
					["65 + 7", 96.1, 47.6],
					["65 + 8", 96.7, 47.9],
					["65 + 9", 97.2, 48.3],
					["65 + 10", 97.8, 48.6],
					["65 + 11", 98.3, 49.0],
					[66, 98.9, 49.3],
					["66 + 1", 99.4, 49.7],
					["66 + 2", 100.0, 50.0]
				],
				"66 Years 2 Months",
			],
			"1956" => [
				[
					[62, 73.3, 34.2],
					["62 + 1", 73.8, 34.4],
					["62 + 2", 74.2, 34.6],
					["62 + 3", 74.6, 34.8],
					["62 + 4", 75.0, 35.0],
					["62 + 5", 75.4, 35.2],
					["62 + 6", 75.8, 35.4],
					["62 + 7", 76.3, 35.6],
					["62 + 8", 76.7, 35.8],
					["62 + 9", 77.1, 36.0],
					["62 + 10", 77.5, 36.3],
					["62 + 11", 77.9, 36.5],
					[63, 78.3, 36.7],
					["63 + 1", 78.8, 36.9],
					["63 + 2", 79.2, 37.1],
					["63 + 3", 79.6, 37.3],
					["63 + 4", 80.0, 37.5],
					["63 + 5", 80.6, 37.8],
					["63 + 6", 81.1, 38.2],
					["63 + 7", 81.7, 38.5],
					["63 + 8", 82.2, 38.9],
					["63 + 9", 82.8, 39.2],
					["63 + 10", 83.3, 39.6],
					["63 + 11", 83.9, 39.9],
					[64, 84.4, 40.3],
					["64 + 1", 85.0, 40.6],
					["64 + 2", 85.6, 41.0],
					["64 + 3", 86.1, 41.3],
					["64 + 4", 86.7, 41.7],
					["64 + 5", 87.2, 42.0],
					["64 + 6", 87.8, 42.4],
					["64 + 7", 88.3, 42.7],
					["64 + 8", 88.9, 43.1],
					["64 + 9", 89.4, 43.4],
					["64 + 10", 90.0, 43.8],
					["64 + 11", 90.6, 44.1],
					[65, 91.1, 44.4],
					["65 + 1", 91.7, 44.8],
					["65 + 2", 92.2, 45.1],
					["65 + 3", 92.8, 45.5],
					["65 + 4", 93.3, 45.8],
					["65 + 5", 93.9, 46.2],
					["65 + 6", 94.4, 46.5],
					["65 + 7", 95.0, 46.9],
					["65 + 8", 95.6, 47.2],
					["65 + 9", 96.1, 47.6],
					["65 + 10", 96.7, 47.9],
					["65 + 11", 97.2, 48.3],
					[66, 97.8, 48.6],
					["66 + 1", 98.3, 49.0],
					["66 + 2", 98.9, 49.3],
					["66 + 3", 99.4, 49.7],
					["66 + 4", 100.0, 50.0]
				],
				"66 Years 4 Months",
			],
			"1957" => [
				[
					[62, 72.5, 33.8],
					["62 + 1", 72.9, 34.0],
					["62 + 2", 73.3, 34.2],
					["62 + 3", 73.8, 34.4],
					["62 + 4", 74.2, 34.6],
					["62 + 5", 74.6, 34.8],
					["62 + 6", 75.0, 35.0],
					["62 + 7", 75.4, 35.2],
					["62 + 8", 75.8, 35.4],
					["62 + 9", 76.3, 35.6],
					["62 + 10", 76.7, 35.8],
					["62 + 11", 77.1, 36.0],
					[63, 77.5, 36.3],
					["63 + 1", 77.9, 36.5],
					["63 + 2", 78.3, 36.7],
					["63 + 3", 78.8, 36.9],
					["63 + 4", 79.2, 37.1],
					["63 + 5", 79.6, 37.3],
					["63 + 6", 80.0, 37.5],
					["63 + 7", 80.6, 37.8],
					["63 + 8", 81.1, 38.2],
					["63 + 9", 81.7, 38.5],
					["63 + 10", 82.2, 38.9],
					["63 + 11", 82.8, 39.2],
					[64, 83.3, 39.6],
					["64 + 1", 83.9, 39.9],
					["64 + 2", 84.4, 40.3],
					["64 + 3", 85.0, 40.6],
					["64 + 4", 85.6, 41.0],
					["64 + 5", 86.1, 41.3],
					["64 + 6", 86.7, 41.7],
					["64 + 7", 87.2, 42.0],
					["64 + 8", 87.8, 42.4],
					["64 + 9", 88.3, 42.7],
					["64 + 10", 88.9, 43.1],
					["64 + 11", 89.4, 43.4],
					[65, 90.0, 43.8],
					["65 + 1", 90.6, 44.1],
					["65 + 2", 91.1, 44.4],
					["65 + 3", 91.7, 44.8],
					["65 + 4", 92.2, 45.1],
					["65 + 5", 92.8, 45.5],
					["65 + 6", 93.3, 45.8],
					["65 + 7", 93.9, 46.2],
					["65 + 8", 94.4, 46.5],
					["65 + 9", 95.0, 46.9],
					["65 + 10", 95.6, 47.2],
					["65 + 11", 96.1, 47.6],
					[66, 96.7, 47.9],
					["66 + 1", 97.2, 48.3],
					["66 + 2", 97.8, 48.6],
					["66 + 3", 98.3, 49.0],
					["66 + 4", 98.9, 49.3],
					["66 + 5", 99.4, 49.7],
					["66 + 6", 100.0, 50.0]
				],
				"66 Years 6 Months"
			],
			"1958" => [
				[
					[62, 71.7, 33.3],
					["62 + 1", 72.1, 33.5],
					["62 + 2", 72.5, 33.8],
					["62 + 3", 72.9, 34.0],
					["62 + 4", 73.3, 34.2],
					["62 + 5", 73.8, 34.4],
					["62 + 6", 74.2, 34.6],
					["62 + 7", 74.6, 34.8],
					["62 + 8", 75.0, 35.0],
					["62 + 9", 75.4, 35.2],
					["62 + 10", 75.8, 35.4],
					["62 + 11", 76.3, 35.6],
					[63, 76.7, 35.8],
					["63 + 1", 77.1, 36.0],
					["63 + 2", 77.5, 36.3],
					["63 + 3", 77.9, 36.5],
					["63 + 4", 78.3, 36.7],
					["63 + 5", 78.8, 36.9],
					["63 + 6", 79.2, 37.1],
					["63 + 7", 79.6, 37.3],
					["63 + 8", 80.0, 37.5],
					["63 + 9", 80.6, 37.8],
					["63 + 10", 81.1, 38.2],
					["63 + 11", 81.7, 38.5],
					[64, 82.2, 38.9],
					["64 + 1", 82.8, 39.2],
					["64 + 2", 83.3, 39.6],
					["64 + 3", 83.9, 39.9],
					["64 + 4", 84.4, 40.3],
					["64 + 5", 85.0, 40.6],
					["64 + 6", 85.6, 41.0],
					["64 + 7", 86.1, 41.3],
					["64 + 8", 86.7, 41.7],
					["64 + 9", 87.2, 42.0],
					["64 + 10", 87.8, 42.4],
					["64 + 11", 88.3, 42.7],
					[65, 88.9, 43.1],
					["65 + 1", 89.4, 43.4],
					["65 + 2", 90.0, 43.8],
					["65 + 3", 90.6, 44.1],
					["65 + 4", 91.1, 44.4],
					["65 + 5", 91.7, 44.8],
					["65 + 6", 92.2, 45.1],
					["65 + 7", 92.8, 45.5],
					["65 + 8", 93.3, 45.8],
					["65 + 9", 93.9, 46.2],
					["65 + 10", 94.4, 46.5],
					["65 + 11", 95.0, 46.9],
					[66, 95.6, 47.2],
					["66 + 1", 96.1, 47.6],
					["66 + 2", 96.7, 47.9],
					["66 + 3", 97.2, 48.3],
					["66 + 4", 97.8, 48.6],
					["66 + 5", 98.3, 49.0],
					["66 + 6", 98.9, 49.3],
					["66 + 7", 99.4, 49.7],
					["66 + 8", 100.0, 50.0]
				],
				"66 Years 8 Months"
			],
			"1959" => [
				[
					[62, 70.8, 32.9],
					["62 + 1", 71.3, 33.1],
					["62 + 2", 71.7, 33.3],
					["62 + 3", 72.1, 33.5],
					["62 + 4", 72.5, 33.8],
					["62 + 5", 72.9, 34.0],
					["62 + 6", 73.3, 34.2],
					["62 + 7", 73.8, 34.4],
					["62 + 8", 74.2, 34.6],
					["62 + 9", 74.6, 34.8],
					["62 + 10", 75.0, 35.0],
					["62 + 11", 75.4, 35.2],
					[63, 75.8, 35.4],
					["63 + 1", 76.3, 35.6],
					["63 + 2", 76.7, 35.8],
					["63 + 3", 77.1, 36.0],
					["63 + 4", 77.5, 36.3],
					["63 + 5", 77.9, 36.5],
					["63 + 6", 78.3, 36.7],
					["63 + 7", 78.8, 36.9],
					["63 + 8", 79.2, 37.1],
					["63 + 9", 79.6, 37.3],
					["63 + 10", 80.0, 37.5],
					["63 + 11", 80.6, 37.8],
					[64, 81.1, 38.2],
					["64 + 1", 81.7, 38.5],
					["64 + 2", 82.2, 38.9],
					["64 + 3", 82.8, 39.2],
					["64 + 4", 83.3, 39.6],
					["64 + 5", 83.9, 39.9],
					["64 + 6", 84.4, 40.3],
					["64 + 7", 85.0, 40.6],
					["64 + 8", 85.6, 41.0],
					["64 + 9", 86.1, 41.3],
					["64 + 10", 86.7, 41.7],
					["64 + 11", 87.2, 42.0],
					[65, 87.8, 42.4],
					["65 + 1", 88.3, 42.7],
					["65 + 2", 88.9, 43.1],
					["65 + 3", 89.4, 43.4],
					["65 + 4", 90.0, 43.8],
					["65 + 5", 90.6, 44.1],
					["65 + 6", 91.1, 44.4],
					["65 + 7", 91.7, 44.8],
					["65 + 8", 92.2, 45.1],
					["65 + 9", 92.8, 45.5],
					["65 + 10", 93.3, 45.8],
					["65 + 11", 93.9, 46.2],
					[66, 94.4, 46.5],
					["66 + 1", 95.0, 46.9],
					["66 + 2", 95.6, 47.2],
					["66 + 3", 96.1, 47.6],
					["66 + 4", 96.7, 47.9],
					["66 + 5", 97.2, 48.3],
					["66 + 6", 97.8, 48.6],
					["66 + 7", 98.3, 49.0],
					["66 + 8", 98.9, 49.3],
					["66 + 9", 99.4, 49.7],
					["66 + 10", 100.0, 50.0]
				],
				"66 Years 10 Months"
			],
			"1960" => [
				[
					[62, 70.0, 32.5],
					["62 + 1", 70.4, 32.7],
					["62 + 2", 70.8, 32.9],
					["62 + 3", 71.3, 33.1],
					["62 + 4", 71.7, 33.3],
					["62 + 5", 72.1, 33.5],
					["62 + 6", 72.5, 33.8],
					["62 + 7", 72.9, 34.0],
					["62 + 8", 73.3, 34.2],
					["62 + 9", 73.8, 34.4],
					["62 + 10", 74.2, 34.6],
					["62 + 11", 74.6, 34.8],
					[63, 75.0, 35.0],
					["63 + 1", 75.4, 35.2],
					["63 + 2", 75.8, 35.4],
					["63 + 3", 76.3, 35.6],
					["63 + 4", 76.7, 35.8],
					["63 + 5", 77.1, 36.0],
					["63 + 6", 77.5, 36.3],
					["63 + 7", 77.9, 36.5],
					["63 + 8", 78.3, 36.7],
					["63 + 9", 78.8, 36.9],
					["63 + 10", 79.2, 37.1],
					["63 + 11", 79.6, 37.3],
					[64, 80.0, 37.5],
					["64 + 1", 80.6, 37.8],
					["64 + 2", 81.1, 38.2],
					["64 + 3", 81.7, 38.5],
					["64 + 4", 82.2, 38.9],
					["64 + 5", 82.8, 39.2],
					["64 + 6", 83.3, 39.6],
					["64 + 7", 83.9, 39.9],
					["64 + 8", 84.4, 40.3],
					["64 + 9", 85.0, 40.6],
					["64 + 10", 85.6, 41.0],
					["64 + 11", 86.1, 41.3],
					[65, 86.7, 41.7],
					["65 + 1", 87.2, 42.0],
					["65 + 2", 87.8, 42.4],
					["65 + 3", 88.3, 42.7],
					["65 + 4", 88.9, 43.1],
					["65 + 5", 89.4, 43.4],
					["65 + 6", 90.0, 43.8],
					["65 + 7", 90.6, 44.1],
					["65 + 8", 91.1, 44.4],
					["65 + 9", 91.7, 44.8],
					["65 + 10", 92.2, 45.1],
					["65 + 11", 92.8, 45.5],
					[66, 93.3, 45.8],
					["66 + 1", 93.9, 46.2],
					["66 + 2", 94.4, 46.5],
					["66 + 3", 95.0, 46.9],
					["66 + 4", 95.6, 47.2],
					["66 + 5", 96.1, 47.6],
					["66 + 6", 96.7, 47.9],
					["66 + 7", 97.2, 48.3],
					["66 + 8", 97.8, 48.6],
					["66 + 9", 98.3, 49.0],
					["66 + 10", 98.9, 49.3],
					["66 + 11", 99.4, 49.7],
					[67, 100.0, 50.0]
				],
				"67 Years"
			],
		];
		$table = $data[$age][0];
		$this->param['table'] = $table;
		$this->param['fullRetirementAge'] = $data[$age][1];
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	function  birthyear($request)
	{
		$date = $request->input('date');
		$age = $request->input('age');
		$ageUnit = $request->input('age_unit');
		$choose = $request->input('choose');
		$submit = $request->input('submit');


		if ($date && is_numeric($age) && $choose && $ageUnit && $choose) {


			if ($ageUnit == 'years') {


				$date = Carbon::parse($date);
				$newDate = $date->subYears($age);
				$newYear = $newDate->year;
			} elseif ($ageUnit == 'months') {

				$date = Carbon::parse($date);
				$newDate = $date->subMonths($age);
				$newYear = $newDate->year;
			} elseif ($ageUnit == 'weeks') {

				$date = Carbon::parse($date);
				$newDate = $date->subWeeks($age);
				$newYear = $newDate->year;
			} elseif ($ageUnit == 'days') {

				$date = Carbon::parse($date);
				$newDate = $date->subDays($age);
				$newYear = $newDate->year;
			} elseif ($ageUnit == 'hours') {

				$date = Carbon::parse($date);
				$newDate = $date->subHours($age);
				$newYear = $newDate->year;
			} elseif ($ageUnit == 'minutes') {

				$date = Carbon::parse($date);
				$newDate = $date->subMinutes($age);
				$newYear = $newDate->year;
			} elseif ($ageUnit == 'second') {

				$date = Carbon::parse($date);
				$newDate = $date->subSeconds($age);
				$newYear = $newDate->year;
			}
			if ($choose == 'before') {
				$newYear = $newYear - 1;
			}

			$this->param['newYear'] = $newYear;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Days until calculator
	function days_until($request)
	{
		$current = $request->input('current');
		$next = $request->input('next');
		$startEvent = $request->input('startEvent');
		$inc_all = $request->input('inc_all');
		$inc_day = $request->input('inc_day');
		$weekDay = $request->input('weekDay');

		if (!empty($current) && !empty($next)) {

			$date1 = Carbon::parse($request->input('current'));
			$date2 = Carbon::parse($request->input('next'));

			$diff = $date1->diff($date2);
			$totaldays = $diff->days;
			$months = $diff->m;
			$weeks = floor($totaldays / 7);
			$days = $totaldays % 7;

			if ($inc_day) {
				$days += 1; // Add one extra day
				$totaldays += 1; // Add one extra day
			}

			if ($inc_all == null) {
				if ($weekDay == null) {
					$days = 0;
					$hours = 0;
				} else {
					$selectedDays = $request->input('weekDay', []);
					$additionalDays = count($selectedDays); // Count selected weekdays
					// dd($additionalDays);
					if ($additionalDays > 0) {
						$days = $weeks * $additionalDays + $days;
						$hours = $days * 24;
					}
				}
			}

			// Prepare the result
			$this->param = [
				'totaldays' => $totaldays,
				'months' => $months,
				'weeks' => $weeks,
				'days' => $days,
				'hours' => $hours,
			];
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// time until calculateWorkingDays
	function time_until($request)
	{
		$currentInput = $request->input('current');
		$nextInput = $request->input('next');

		$currentTime = Carbon::parse($currentInput);
		$nextTime = Carbon::parse($nextInput);
		$today = Carbon::now();

		if (!$currentTime || !$nextTime) {
			$this->param['error'] = 'Please enter valid dates';
			return $this->param;
		}

		if ($nextTime->lessThan($today)) {
			$this->param['error'] = 'Next date cannot be less than today\'s date.';
			return $this->param;
		}

		$totalSeconds = $nextTime->diffInSeconds($currentTime);

		$years = floor($totalSeconds / (365 * 24 * 60 * 60));
		$months = floor(($totalSeconds % (365 * 24 * 60 * 60)) / (30 * 24 * 60 * 60));
		$days = floor(($totalSeconds % (30 * 24 * 60 * 60)) / (24 * 60 * 60));
		$hours = floor(($totalSeconds % (24 * 60 * 60)) / (60 * 60));
		$minutes = floor(($totalSeconds % (60 * 60)) / 60);
		$seconds = $totalSeconds % 60;

		$this->param = [
			'years' => $years,
			'months' => $months,
			'days' => $days,
			'hours' => $hours,
			'minutes' => $minutes,
			'seconds' => $seconds
		];
		return $this->param;
	}

	// week calculator
	function week_calc($request)
	{
		$current = $request->input('current');
		$next = $request->input('next');
		$number = $request->input('number');
		$stype = $request->input('stype');

		if ($stype == 's_date') {
			if (is_numeric($number)) {
				$date1 = Carbon::parse($current);
				$dateAfterAddingWeeks = $date1->copy()->addWeeks($number);
				$this->param['adding'] = $dateAfterAddingWeeks->format('F j, Y');
				return $this->param;
			} else {
				return ['error' => 'Please input Number of weeks'];
			}
		}
		if ($stype == 'e_date') {
			if (is_numeric($number)) {
				$date1 = Carbon::parse($current);
				$dateAfterSubtractingWeeks = $date1->copy()->subWeeks($number);
				$this->param['subbtract'] = $dateAfterSubtractingWeeks->format('F j, Y');
				return $this->param;
			} else {
				return ['error' => 'Please input Number of weeks'];
			}
		} else {
			$date1 = Carbon::parse($current);
			$date2 = Carbon::parse($request->next);
			$diff = $date1->diff($date2);
			$totaldays = $diff->days;
			$weeks = floor($totaldays / 7);
			$this->param['weeks'] = $weeks;
			return $this->param;
		}
	}

	// days form today
	function days_from($request)
	{
		// $current = $request->input('current');
		$number = $request->input('number');
		if (is_numeric($number)) {
			if ($number >= 1) {
				$date1 = Carbon::parse($request->input('current'));
				$dateAfterAddingDays = $date1->copy()->addDays($number);
				$this->param['date_name'] = $dateAfterAddingDays->dayName;
				$this->param['t_date'] = $dateAfterAddingDays->format('F j, Y');
				$this->param['uk_date'] = $dateAfterAddingDays->format('j F, Y');
				$this->param['number'] = $dateAfterAddingDays->format('d/m/y');
				$this->param['usa_num'] = $dateAfterAddingDays->format('m/d/y');
				$this->param['iso'] = $dateAfterAddingDays->format('Y-m-d');
				return $this->param;
			} elseif ($number <= -1) {
				$date2 = Carbon::parse($request->input('current'));
				$dateAfterSubtractingDays = $date2->copy()->subDays(abs($number));
				$this->param['date_name'] = $dateAfterSubtractingDays->dayName;
				$this->param['t_date'] = $dateAfterSubtractingDays->format('F j, Y');
				$this->param['uk_date'] = $dateAfterSubtractingDays->format('j F, Y');
				$this->param['number'] = $dateAfterSubtractingDays->format('d/m/y');
				$this->param['usa_num'] = $dateAfterSubtractingDays->format('m/d/y');
				$this->param['iso'] = $dateAfterSubtractingDays->format('Y-m-d');
				return $this->param;
			}
		} else {
			return ['error' => 'Please add Number of days'];
		}
	}

	// word counter
	function word_count($request){
		$page = $request->input('page');
		$size = $request->input('size');
		$font = $request->input('font');
		$space = $request->input('space');
		$page2 = $request->input('page2');
		$title = $request->input('title');
		$sp_title = $request->input('sp_title');
		$lang = $request->input('lang');
		$main = $request->input('main');

		if($main == 1){
			$fontSize = $request->input('size');
			$fontStyle = $request->input('font');
			$spacing = $request->input('space');
			$wordCount = 0;
			$data = [
				'Times' => [
					'10' => ['single' => 900, '1.5' => 600, 'double' => 400],
					'11' => ['single' => 650, '1.5' => 440, 'double' => 320],
					'12' => ['single' => 650, '1.5' => 400, 'double' => 300],
					'13' => ['single' => 470, '1.5' => 320, 'double' => 220],
					'14' => ['single' => 475, '1.5' => 300, 'double' => 230]
				],
				'Calibri' => [
					'10' => ['single' => 900, '1.5' => 560, 'double' => 400],
					'11' => ['single' => 600, '1.5' => 385, 'double' => 280],
					'12' => ['single' => 650, '1.5' => 400, 'double' => 300],
					'13' => ['single' => 435, '1.5' => 270, 'double' => 210],
					'14' => ['single' => 430, '1.5' => 300, 'double' => 200]
				],
				'Courier' => [
					'10' => ['single' => 650, '1.5' => 450, 'double' => 300],
					'12' => ['single' => 450, '1.5' => 310, 'double' => 250],
					'13' => ['single' => 325, '1.5' => 210, 'double' => 160],
					'14' => ['single' => 350, '1.5' => 220, 'double' => 170]
				],
				'Garamond' => [
					'10' => ['single' => 1000, '1.5' => 630, 'double' => 480],
					'11' => ['single' => 680, '1.5' => 460, 'double' => 320],
					'12' => ['single' => 700, '1.5' => 450, 'double' => 310],
					'13' => ['single' => 500, '1.5' => 320, 'double' => 220],
					'14' => ['single' => 500, '1.5' => 310, 'double' => 240]
				],
				'Verdana' => [
					'10' => ['single' => 750, '1.5' => 480, 'double' => 370],
					'11' => ['single' => 500, '1.5' => 325, 'double' => 220],
					'12' => ['single' => 500, '1.5' => 310, 'double' => 230],
					'13' => ['single' => 350, '1.5' => 220, 'double' => 170],
					'14' => ['single' => 370, '1.5' => 240, 'double' => 200]
				],
				'Arial' => [
					'10' => ['single' => 890, '1.5' => 600, 'double' => 400],
					'11' => ['single' => 600, '1.5' => 410, 'double' => 310],
					'12' => ['single' => 600, '1.5' => 360, 'double' => 260],
					'13' => ['single' => 430, '1.5' => 285, 'double' => 210],
					'14' => ['single' => 460, '1.5' => 280, 'double' => 200]
				],
				'Helvetica' => [
					'10' => ['single' => 750, '1.5' => 500, 'double' => 480],
					'11' => ['single' => 635, '1.5' => 440, 'double' => 320],
					'12' => ['single' => 560, '1.5' => 360, 'double' => 280],
					'13' => ['single' => 460, '1.5' => 320, 'double' => 220],
					'14' => ['single' => 400, '1.5' => 260, 'double' => 190]
				],
				'Century Gothic' => [
					'10' => ['single' => 600, '1.5' => 430, 'double' => 310],
					'11' => ['single' => 490, '1.5' => 360, 'double' => 220],
					'12' => ['single' => 560, '1.5' => 280, 'double' => 210],
					'13' => ['single' => 380, '1.5' => 220, 'double' => 190],
					'14' => ['single' => 315, '1.5' => 200, 'double' => 150]
				],
				'Candara' => [
					'10' => ['single' => 670, '1.5' => 460, 'double' => 350],
					'11' => ['single' => 550, '1.5' => 385, 'double' => 280],
					'12' => ['single' => 590, '1.5' => 315, 'double' => 220],
					'13' => ['single' => 420, '1.5' => 260, 'double' => 190],
					'14' => ['single' => 350, '1.5' => 220, 'double' => 170]
				],
				'Cambria' => [
					'10' => ['single' => 710, '1.5' => 490, 'double' => 360],
					'11' => ['single' => 590, '1.5' => 400, 'double' => 300],
					'12' => ['single' => 490, '1.5' => 320, 'double' => 220],
					'13' => ['single' => 435, '1.5' => 270, 'double' => 190],
					'14' => ['single' => 380, '1.5' => 220, 'double' => 170]
				]
			];
			if (isset($page)) {
				$wordCount = $data[$fontStyle][$fontSize][$spacing];
				$wordCount = $wordCount * $page;
			} else {
				$this->param['error'] = 'Please add Number of Pages';
			}
			$this->param['counter'] = $wordCount;
			return $this->param;
		}else if($main == 2){
			if($title != 'Empty' && $page2 != ''){
				$this->param['error'] = "Please choose either a title or a Enter length (not both).";
				return $this->param;
			}else{
				if($title == "Empty"){
					if(!isset($page2)){
						$this->param['error'] = "Please choose either a title or a Enter length (not both).";
						return $this->param;
					}else{
						$counter = $page2 * 242;
					}
				}elseif($title == 'Quran'){
					$counter = 77439;
				}elseif($title == 'Bible'){
					$counter = 783137;
				}elseif($title == 'Gatsby'){
					$counter = 47094;
				}elseif($title == 'Harry'){
					$counter = 1084170;
				}elseif($title == 'Av_noval'){
					$counter = 90000;
				}elseif($title == 'Hobbit'){
					$counter = 95022;
				}elseif($title == 'Rings'){
					$counter = 455125;
				}elseif($title == 'Peace'){
					$counter = 587287;
				}elseif($title == 'Pride'){
					$counter = 122204;
				}elseif($title == 'Rich'){
					$counter = 72000 ;
				}elseif($title == 'War'){
					$counter = 587287 ;
				}elseif($title == 'Great_Ex'){
					$counter = 132500  ;
				}elseif($title == 'Shakespearean'){
					$counter = 29551  ;
				}
			}
			// dd($counter , $title);
			$this->param['counter'] = number_format($counter);
			return $this->param;
		}else if($main == 3){
			$title == $sp_title;
			if($title != 'Empty' && $page2 != ''){
				$this->param['error'] = "Please choose either a title or a Enter length (not both).";
				return $this->param;
			}else{
				$title = $sp_title;
				if($title == "Empty"){
					if(!isset($page2)){
						$this->param['error'] = "Please choose either a title or a Enter length (not both).";
						return $this->param;
					}else{
						$counter = $page2 * 130;
					}
				}elseif($title == 'Perfect'){
					$counter = 4891;
				}elseif($title == 'Gettysburg'){
					$counter = 272;
				}elseif($title == 'Dream'){
					$counter = 1667;
				}elseif($title == 'Beaches'){
					$counter = 3855;
				}
			}
			$this->param['counter'] = number_format($counter);
			return $this->param;
		}else if($main == 4){
			if($lang == 'English'){
				$counter = 170000;
			}elseif($lang == 'French'){
				$counter = 70000;
			}elseif($lang == 'German'){
				$counter = 145000;
			}elseif($lang == 'Russian'){
				$counter = 150000;
			}elseif($lang == 'Spanish'){
				$counter = 93000;
			}elseif($lang == 'Japanese'){
				$counter = 500000;
			}elseif($lang == 'Korean'){
				$counter = 511282;
			}elseif($lang == 'Portuguese'){
				$counter = 818000;
			}elseif($lang == 'Swedish'){
				$counter = 600000;
			}elseif($lang == 'Italian'){
				$counter = 500000;
			}elseif($lang == 'Hindi'){
				$counter = 183175;
			}elseif($lang == 'Urdu'){
				$counter =  286563;
			}elseif($lang == 'Urdu'){
				$counter =  286563;
			}elseif($lang == 'Arabic'){
				$counter =  170000;
			}elseif($lang == 'Turkish'){
				$counter =  316000;
			}elseif($lang == 'Chinese'){
				$counter =  370000 ;
			}
			$this->param['counter'] = number_format($counter);
			return $this->param;
		}
	}

	// page counter
	function page_count($request){
		$page = $request->input('page');
		$size = $request->input('size');
		$font = $request->input('font');
		$space = $request->input('space');
		$page2 = $request->input('page2');
		$title = $request->input('title');
		$lang = $request->input('lang');
		$main = $request->input('main');
		if($main == 1){
			$fontSize = $request->input('size');
			$fontStyle = $request->input('font');
			$spacing = $request->input('space');
			$totalWords  = $request->input('page');
			
			$data = [
				'Times' => [
					'10' => ['single' => 900, '1.5' => 600, 'double' => 400],
					'11' => ['single' => 650, '1.5' => 440, 'double' => 320],
					'12' => ['single' => 650, '1.5' => 400, 'double' => 300],
					'13' => ['single' => 470, '1.5' => 320, 'double' => 220],
					'14' => ['single' => 475, '1.5' => 300, 'double' => 230]
				],
				'Calibri' => [
					'10' => ['single' => 900, '1.5' => 560, 'double' => 400],
					'11' => ['single' => 600, '1.5' => 385, 'double' => 280],
					'12' => ['single' => 650, '1.5' => 400, 'double' => 300],
					'13' => ['single' => 435, '1.5' => 270, 'double' => 210],
					'14' => ['single' => 430, '1.5' => 300, 'double' => 200]
				],
				'Courier' => [
					'10' => ['single' => 650, '1.5' => 450, 'double' => 300],
					'12' => ['single' => 450, '1.5' => 310, 'double' => 250],
					'13' => ['single' => 325, '1.5' => 210, 'double' => 160],
					'14' => ['single' => 350, '1.5' => 220, 'double' => 170]
				],
				'Garamond' => [
					'10' => ['single' => 1000, '1.5' => 630, 'double' => 480],
					'11' => ['single' => 680, '1.5' => 460, 'double' => 320],
					'12' => ['single' => 700, '1.5' => 450, 'double' => 310],
					'13' => ['single' => 500, '1.5' => 320, 'double' => 220],
					'14' => ['single' => 500, '1.5' => 310, 'double' => 240]
				],
				'Verdana' => [
					'10' => ['single' => 750, '1.5' => 480, 'double' => 370],
					'11' => ['single' => 500, '1.5' => 325, 'double' => 220],
					'12' => ['single' => 500, '1.5' => 310, 'double' => 230],
					'13' => ['single' => 350, '1.5' => 220, 'double' => 170],
					'14' => ['single' => 370, '1.5' => 240, 'double' => 200]
				],
				'Arial' => [
					'10' => ['single' => 890, '1.5' => 600, 'double' => 400],
					'11' => ['single' => 600, '1.5' => 410, 'double' => 310],
					'12' => ['single' => 600, '1.5' => 360, 'double' => 260],
					'13' => ['single' => 430, '1.5' => 285, 'double' => 210],
					'14' => ['single' => 460, '1.5' => 280, 'double' => 200]
				],
				'Helvetica' => [
					'10' => ['single' => 750, '1.5' => 500, 'double' => 480],
					'11' => ['single' => 635, '1.5' => 440, 'double' => 320],
					'12' => ['single' => 560, '1.5' => 360, 'double' => 280],
					'13' => ['single' => 460, '1.5' => 320, 'double' => 220],
					'14' => ['single' => 400, '1.5' => 260, 'double' => 190]
				],
				'Century Gothic' => [
					'10' => ['single' => 600, '1.5' => 430, 'double' => 310],
					'11' => ['single' => 490, '1.5' => 360, 'double' => 220],
					'12' => ['single' => 560, '1.5' => 280, 'double' => 210],
					'13' => ['single' => 380, '1.5' => 220, 'double' => 190],
					'14' => ['single' => 315, '1.5' => 200, 'double' => 150]
				],
				'Candara' => [
					'10' => ['single' => 670, '1.5' => 460, 'double' => 350],
					'11' => ['single' => 550, '1.5' => 385, 'double' => 280],
					'12' => ['single' => 590, '1.5' => 315, 'double' => 220],
					'13' => ['single' => 420, '1.5' => 260, 'double' => 190],
					'14' => ['single' => 350, '1.5' => 220, 'double' => 170]
				],
				'Cambria' => [
					'10' => ['single' => 710, '1.5' => 490, 'double' => 360],
					'11' => ['single' => 590, '1.5' => 400, 'double' => 300],
					'12' => ['single' => 490, '1.5' => 320, 'double' => 220],
					'13' => ['single' => 435, '1.5' => 270, 'double' => 190],
					'14' => ['single' => 380, '1.5' => 220, 'double' => 170]
				]
			];
		
			$wordsPerPage = $data[$fontStyle][$fontSize][$spacing];

			if (is_numeric($totalWords)) {
				$pages = ceil($totalWords / $wordsPerPage);
				$this->param['counter'] = $pages;
			} else {
				$this->param['error'] = 'Please add Number of Words';
			}
			return $this->param;
		}else{
			if($title != 'Empty' && $page2 != ''){
				$this->param['error'] = "Please choose either a title or a Enter length (not both).";
				return $this->param;
			}else{
				if($title == "Empty"){
					if(!isset($page2)){
						$this->param['error'] = "Please choose either a title or a Enter length (not both).";
						return $this->param;
					}else{
						$counter = $page2 / 242;
					}
				}elseif($title == 'Quran'){
					$counter = 604;
				}elseif($title == 'Bible'){
					$counter = 1120;
				}elseif($title == 'Gatsby'){
					$counter = 218;
				}elseif($title == 'Harry'){
					$counter = 3407;
				}elseif($title == 'Av_noval'){
					$counter = 300;
				}elseif($title == 'Hobbit'){
					$counter = 310;
				}elseif($title == 'Rings'){
					$counter = 1191;
				}elseif($title == 'Peace'){
					$counter = 1225;
				}elseif($title == 'Pride'){
					$counter = 248;
				}elseif($title == 'Rich'){
					$counter = 336 ;
				}elseif($title == 'War'){
					$counter = 1400 ;
				}elseif($title == 'Great_Ex'){
					$counter = 544  ;
				}elseif($title == 'Shakespearean'){
					$counter = 444  ;
				}
			}
			$this->param['counter'] = number_format($counter);
			return $this->param;
		}
	}
	

}
