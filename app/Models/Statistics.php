<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
	public $param;

	function probability($request)
	{
		// dd($request->all());
		if ($request->for == '1') {
			if (is_numeric($request->nbr1) && is_numeric($request->event)) {
				$nbr1 = $request->nbr1;
				$event = $request->event;
				$put_input['for'] = $request->for;
				$put_input['nbr1'] = $request->nbr1;
				$put_input['event'] = $request->event;
				$event_occur = round($event / $nbr1, 3);
				$not_occur = round((1 - $event_occur), 3);
				// return values
				$this->param['event_occur'] = $event_occur;
				$this->param['not_occur'] = $not_occur;
				$this->param['Single'] = "active";
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill All fields.";
				return $this->param;
			}
		} elseif ($request->for == '2') {
			if (is_numeric($request->nbr2) && is_numeric($request->event_a) && is_numeric($request->event_b)) {
				$nbr2 = $request->nbr2;
				$event_a = $request->event_a;
				$event_b = $request->event_b;

				$put_input['for'] = $request->for;
				$put_input['nbr2'] = $request->nbr2;
				$put_input['event_a'] = $request->event_a;
				$put_input['event_b'] = $request->event_b;

				$event_a_occur = round($event_a / $nbr2, 4);
				$not_a_occur = round((1 - $event_a_occur), 4);
				$event_b_occur = round($event_b / $nbr2, 4);
				$not_b_occur = round((1 - $event_b_occur), 4);
				$both_events = round($event_a_occur * $event_b_occur, 4);
				$either_events = round(($event_a_occur + $event_b_occur) - $both_events, 4);
				$conditional = round($both_events / $event_b_occur, 4);
				// return values
				$this->param['event_a_occur'] = $event_a_occur;
				$this->param['not_a_occur'] = $not_a_occur;
				$this->param['event_b_occur'] = $event_b_occur;
				$this->param['not_b_occur'] = $not_b_occur;
				$this->param['both_events'] = $both_events;
				$this->param['either_events'] = $either_events;
				$this->param['conditional'] = $conditional;
				$this->param['Multiple'] = "active";
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill All fields.";
				return $this->param;
			}
		} elseif ($request->for == '3') {
			if (is_numeric($request->pro_a) && is_numeric($request->pro_b)) {
				$pro_a = $request->pro_a;
				$pro_b = $request->pro_b;

				$put_input['for'] = $request->for;
				$put_input['pro_a'] = $request->pro_a;
				$put_input['pro_b'] = $request->pro_b;
				$put_input['format'] = $request->format;

				if ($request->format == '2') {
					$pro_a = $pro_a / 100;
					$pro_b = $pro_b / 100;
				}
				$not_a_occur = round(1 - $pro_a, 4);
				$not_b_occur = round(1 - $pro_b, 4);
				$both_events = round($pro_a * $pro_b, 4);
				$either_events = round($pro_a + $pro_b - $both_events, 5);
				$conditional = round($both_events / $pro_b, 4);
				$not_both = round($pro_a + $pro_b - (2 * $both_events), 5);
				$nor_both = round(1 - $either_events, 5);
				$anotb = round($pro_a * (1 - $pro_b), 5);
				$bnota = round((1 - $pro_a) * $pro_b, 5);
				$this->param['not_a_occur'] = $not_a_occur;
				$this->param['not_b_occur'] = $not_b_occur;
				$this->param['both_events'] = $both_events;
				$this->param['either_events'] = $either_events;
				$this->param['conditional'] = $conditional;
				$this->param['not_both'] = $not_both;
				$this->param['nor_both'] = $nor_both;
				$this->param['anotb'] = $anotb;
				$this->param['bnota'] = $bnota;
				$this->param['pro_a'] = $pro_a;
				$this->param['pro_b'] = $pro_b;
				$this->param['Solver'] = "events";
				return $this->param;
			} else {
				$this->param['error'] = "Please fill All fields.";
				return $this->param;
			}
		} elseif ($request->for == '4') {
			if (is_numeric($request->eve_a) && is_numeric($request->rep_a) && is_numeric($request->eve_b) && is_numeric($request->rep_b)) {

				$put_input['for'] = $request->for;
				$put_input['eve_a'] = $request->eve_a;
				$put_input['rep_a'] = $request->rep_a;
				$put_input['eve_b'] = $request->eve_b;
				$put_input['rep_b'] = $request->rep_b;

				$this->param['Events'] = "events";
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill All fields.";
				return $this->param;
			}
		} elseif ($request->for == '5') {
			if (is_numeric($request->andb) && is_numeric($request->prob_b)) {

				$put_input['for'] = $request->for;
				$put_input['andb'] = $request->andb;
				$put_input['prob_b'] = $request->prob_b;

				$this->param['condi'] = round($request->andb / $request->prob_b, 4);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill All fields.";
				return $this->param;
			}
		}
	}

	function coefficient($request)
	{
		if (!empty($request->x)) {
			$x = $request->x;
			$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			while (strpos($x, ",,") !== false) {
				$x = str_replace(",,", ",", $x);
			}
			// $array = explode(',', $request->x);
			$array = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			$number = true;
			$i = 0;
			$count = count($array);
			$replace = str_replace(',', '+', $x);
			$this->param['count'] = $count;
			$this->param['arr'] = $array;
			$this->param['replace'] = $replace;
			foreach ($array as $key => $value) {
				$i++;
				if (!is_numeric($value)) {
					$number = false;
				}
			}
			if ($number == true) {
				$sum = array_sum($array);
				$m = round($sum / $i, 3);
				$d = 0;
				foreach ($array as $key => $value) {
					$d = $d + pow($value - $m, 2);
				}
				if ($request->type_ == '2') {
					$s_d = (1 / ($i)) * $d;
				} else {
					$s_d = (1 / ($i - 1)) * $d;
				}
				$s_d = round(sqrt($s_d), 4);
				$c = round($s_d / $m, 4);
				$this->param['sum'] = $sum;
				$this->param['m'] = $m;
				$this->param['d'] = $s_d;
				$this->param['c'] = $c;
				$this->param['t_n'] = $i;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please Enter Valid Input.";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please fill All fields.";
			return $this->param;
		}
	}

	function hypergeometric($request)
	{
		if (is_numeric($request->p) && is_numeric($request->sp) && is_numeric($request->s) && is_numeric($request->ss)) {
			$N = $request->p;
			$K = $request->sp;
			$n = $request->s;
			$k = $request->ss;
			$mean = round($n * $K / $N, 6);
			$variance = $n * ($K / $N) * (($N - $K) / $N) * (($N - $n) / ($N - 1));
			$sd = round(sqrt($variance), 6);
			if ($n > $N) {
				$this->param['error'] = "(N) Must be Greater Than (n).";
				return $this->param;
			}
			if ($K > $N) {
				$this->param['error'] = "(N) Must be Greater Than (K).";
				return $this->param;
			}
			if ($k > $n) {
				$this->param['error'] = "(n) Must be Greater Than (k).";
				return $this->param;
			}
			function factorial($n)
			{
				if ($n <= 1) {
					return 1;
				} else {
					$fact = gmp_fact($n);
					return gmp_strval($fact);
				}
			}

			function combinations($n, $k)
			{
				if ($n < $k) {
					return 0;
				} else {
					return factorial($n) / (factorial($k) * factorial(($n - $k)));
				}
			}
			if ($request->method == '1') {
				$first = combinations($K, $k);
				$second = combinations(($N - $K), ($n - $k));
				$third = combinations($N, $n);
				$a = round(($first * $second) / $third, 6);
				$b = 0;
				for ($i = 0; $i < $k; $i++) {
					$first = combinations($K, $i);
					$second = combinations(($N - $K), ($n - $i));
					$third = combinations($N, $n);
					$b += (($first * $second) / $third);
				}
				$c = 0;
				for ($i = 0; $i <= $k; $i++) {
					$first = combinations($K, $i);
					$second = combinations(($N - $K), ($n - $i));
					$third = combinations($N, $n);
					$c += (($first * $second) / $third);
				}
				$d = 0;
				for ($i = $n; $i > $k; $i--) {
					$first = combinations($K, $i);
					$second = combinations(($N - $K), ($n - $i));
					$third = combinations($N, $n);
					$d += (($first * $second) / $third);
				}
				$e = 0;
				for ($i = $n; $i >= $k; $i--) {
					$first = combinations($K, $i);
					$second = combinations(($N - $K), ($n - $i));
					$third = combinations($N, $n);
					$e += (($first * $second) / $third);
				}
				$this->param['a'] = $a;
				$this->param['mean'] = $mean;
				$this->param['b'] = round($b, 6);
				$this->param['variance'] = round($variance, 6);
				$this->param['sd'] = round($sd, 6);
				$this->param['c'] = round($c, 6);
				$this->param['d'] = round($d, 6);
				$this->param['e'] = round($e, 6);
				$this->param['RESULT'] = 1;
				$this->param['method'] = 1;
				return $this->param;
			} else {
				if (is_numeric($request->inc) && is_numeric($request->rep) && $request->rep <= 20) {
					$inc = $request->inc;
					$rep = $request->rep;
					$table = '';
					$chart = '';
					$xval = '';
					if ($request->fun == '1') {
						for ($i = 1; $i <= $rep; $i++) {
							$first = combinations($K, $k);
							$second = combinations(($N - $K), ($n - $k));
							$third = combinations($N, $n);
							$a = ($first * $second) / $third;
							$chart .= $a . ',';
							$xval .= $k . ',';
							$table .= '<tr><td class="py-2 border-b">' . $k . '</td><td class="py-2 border-b">' . $a . '</td><td class="py-2 border-b">' . ($a * 100) . '%</td></tr>';
							$k = $k + $inc;
						}
					}
					if ($request->fun == '2') {
						for ($j = 1; $j <= $rep; $j++) {
							$a = 0;
							for ($i = 0; $i <= $k; $i++) {
								$first = combinations($K, $i);
								$second = combinations(($N - $K), ($n - $i));
								$third = combinations($N, $n);
								$a += (($first * $second) / $third);
							}
							$chart .= $a . ',';
							$xval .= $k . ',';
							$table .= '<tr><td class="py-2 border-b">' . $k . '</td><td class="py-2 border-b">' . $a . '</td><td class="py-2 border-b">' . ($a * 100) . '%</td></tr>';
							$k = $k + $inc;
						}
					}
					if ($request->fun == '3') {
						for ($j = 1; $j < $rep; $j++) {
							$a = 0;
							for ($i = $n; $i >= $k; $i--) {
								$first = combinations($K, $i);
								$second = combinations(($N - $K), ($n - $i));
								$third = combinations($N, $n);
								$a += (($first * $second) / $third);
							}
							$chart .= $a . ',';
							$xval .= $k . ',';
							$table .= '<tr><td class="py-2 border-b">' . $k . '</td><td class="py-2 border-b">' . $a . '</td><td class="py-2 border-b">' . ($a * 100) . '%</td></tr>';
							$k = $k + $inc;
						}
					}
					$this->param['mean'] = $mean;
					$this->param['sd'] = round($sd, 6);
					$this->param['variance'] = round($variance, 6);
					$this->param['table'] = $table;
					$this->param['chart'] = $chart;
					$this->param['xval'] = $xval;
					$this->param['RESULT'] = 1;
					$this->param['method'] = 2;
					return $this->param;
				} else {
					$this->param['error'] = "Input Error";
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = "Please fill All fields.";
			return $this->param;
		}
	}

	public function covariance($request)
	{
		$set_x = $request->set_x;
		$set_y = $request->set_y;
		if ($request->formula == '1') {
			if (!empty($request->set_x) && !empty($request->set_y)) {
				$set_x = str_replace([" ", ",", "\n", "\r"], ",", $set_x);
				while (strpos($set_x, ",,") !== false) {
					$set_x = str_replace(",,", ",", $set_x);
				}
				$array = array_map('trim', array_filter(explode(',', $set_x), function ($value) {
					return $value !== '';
				}));
				$set_y = str_replace([" ", ",", "\n", "\r"], ",", $set_y);
				while (strpos($set_y, ",,") !== false) {
					$set_y = str_replace(",,", ",", $set_y);
				}
				$array1 = array_map('trim', array_filter(explode(',', $set_y), function ($value) {
					return $value !== '';
				}));
				$check = true;
				foreach ($array as $key => $value) {
					if (!is_numeric($value)) {
						$check = false;
					}
				}
				foreach ($array1 as $key => $value) {
					if (!is_numeric($value)) {
						$check = false;
					}
				}
				$nbr = count($array);
				if (count($array) != count($array1)) {
					$check = false;
				}
				if ($check == true) {
					$sum_x = array_sum($array);
					$sum_y = array_sum($array1);
					$mean_x = round($sum_x / $nbr, 2);
					$mean_y = round($sum_y / $nbr, 2);
					$total = '';
					for ($i = 0; $i < $nbr; $i++) {
						$X1 = $array[$i] - $mean_x;
						$Y1 = $array1[$i] - $mean_y;
						$total .= ($X1 * $Y1) . ",";
					}
					$total = explode(',', $total);
					$total = array_sum($total);
					$sample = round($total / $nbr, 2);
					$population = round($total / ($nbr - 1), 2);
					$this->param['nbr'] = $nbr;
					$this->param['mean_x'] = $mean_x;
					$this->param['mean_y'] = $mean_y;
					$this->param['sample'] = $sample;
					$this->param['population'] = $population;
					$this->param['formula'] = $request->formula;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = "Please Check Your Input";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please Enter all value";
				return $this->param;
			}
		}
		if ($request->formula == '2') {
			if (is_numeric($request->between) && is_numeric($request->devi_x) && is_numeric($request->devi_y)) {
				$this->param['ans_2'] = round($request->between * $request->devi_x * $request->devi_y, 2);
				$this->param['RESULT'] = 1;
				$this->param['formula'] = $request->formula;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill All fields.";
				return $this->param;
			}
		}
		if ($request->formula == '3') {
			if (!empty($request->matrix)) {
				$check = true;
				$matrix = explode(']', $request->matrix);
				$rows = count($matrix);
				$row = explode('[', $matrix[0]);
				$row = explode(',', $row[1]);
				$row_count = count($row);
				$arrayrow = array();
				for ($i = 0; $i < $row_count; $i++) {
					$arrayrow[$i] = '0';
					$arrayavg[$i] = '0';
				}
				for ($i = 0; $i < $rows - 1; $i++) {
					$row = explode('[', $matrix[$i]);
					// $total_row=explode(',', $row[1]);
					$total_row = array_map('trim', array_filter(explode(',', $row[1])));
					foreach ($total_row as $key => $value) {
						if (!is_numeric($value)) {
							$check = false;
						} else {
							$arrayrow[$key] += $value;
							$arrayavg[$key] += $value;
						}
					}
				}
				for ($i = 0; $i < $row_count; $i++) {
					$arrayavg[$i] = round($arrayavg[$i] / ($rows - 1), 2);
				}
				$final_rows = array(array());
				for ($i = 0; $i < $rows - 1; $i++) {
					$row = explode('[', $matrix[$i]);
					// $total_row=explode(',', $row[1]);
					$total_row = array_map('trim', array_filter(explode(',', $row[1])));
					foreach ($total_row as $key => $value) {
						$final_rows[$i][$key] = $value - $arrayavg[$key];
					}
				}
				$trans_rows = array(array());
				for ($i = 0; $i < $row_count; $i++) {
					for ($j = 0; $j < $rows - 1; $j++) {
						$trans_rows[$i][$j] = $final_rows[$j][$i];
					}
				}
				$result_rows = array(array());
				for ($i = 0; $i < $row_count; $i++) {
					for ($j = 0; $j < $row_count; $j++) {
						$result_rows[$i][$j] = 0;
						for ($k = 0; $k < $rows - 1; $k++)
							$result_rows[$i][$j] += $trans_rows[$i][$k] * $final_rows[$k][$j];
					}
				}

				$output = '';
				for ($i = 0; $i < $row_count; $i++) {
					$output .= '[ ';
					foreach ($result_rows[$i] as $key => $value) {
						if ($key == ($row_count - 1)) {
							$output .= (round($value / ($rows - 1), 5)) . " ] <br>";
						} else {
							$output .= (round($value / ($rows - 1), 5)) . " , ";
						}
					}
				}
				// $output.="</p>";
				if ($check == true) {
					$this->param['RESULT'] = 1;
					$this->param['output'] = $output;
					$this->param['formula'] = $request->formula;
					return $this->param;
				} else {
					$this->param['error'] = "Please Check Your Input";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please Enter Matrix";
				return $this->param;
			}
		}
	}

	public function empirical($request)
	{
		if ($request->form == 'summary') {
			if (is_numeric($request->mean) && is_numeric($request->deviation)) {
				$mean = $request->mean;
				$devi = $request->deviation;
				$first = round($mean - $devi, 2) . " & " . round($mean + $devi, 2);
				$second = round($mean - ($devi * 2), 2) . " & " . round($mean + ($devi * 2), 2);
				$third = round($mean - ($devi * 3), 2) . " & " . round($mean + ($devi * 3), 2);
				$jawab = [
					"mean" => $mean,
					"devi" => $devi,
					"first" => $first,
					"second" => $second,
					"third" => $third,
				];
				$this->param = $jawab;

				return $this->param;
			} else {
				$jawab = [
					"error" => "Please Fill All Fields",
				];
				$this->param = $jawab;
				return $this->param;
			}
		} else {
			if (!empty($request->x)) {
				$array = array_map('trim', array_filter(explode(',', $request->x)));
				$number = true;
				$i = 0;
				foreach ($array as $key => $value) {
					$i++;
					if (!is_numeric($value)) {
						$number = false;
					}
				}
				$count = count($array);
				if ($number == true) {
					$sum = array_sum($array);
					$mean = round($sum / $i, 3);
					$d = 0;
					foreach ($array as $key => $value) {
						$d = $d + pow($value - $mean, 2);
					}
					if ($request->type_r == '2') {
						$devi = round(sqrt((1 / ($i)) * $d), 4);
					} else {
						$devi = round(sqrt((1 / ($i - 1)) * $d), 4);
					}
					$first = round($mean - $devi, 2) . " & " . round($mean + $devi, 2);
					$second = round($mean - ($devi * 2), 2) . " & " . round($mean + ($devi * 2), 2);
					$third = round($mean - ($devi * 3), 2) . " & " . round($mean + ($devi * 3), 2);
					$jawab = [
						"count" => $count,
						"mean" => $mean,
						"devi" => $devi,
						"first" => $first,
						"second" => $second,
						"third" => $third,
					];
					$this->param = $jawab;

					return $this->param;
				} else {
					$jawab = [
						"error" => "Please Fill All Fields",
					];
					$this->param = $jawab;
					return $this->param;
				}
			} else {
				$jawab = [
					"error" => "Please Fill All Fields",
				];
				$this->param = $jawab;
				return $this->param;
			}
		}
	}

	public function mean($request)
	{
		$x = $request->x;
		$check = true;
		if (empty($x)) {
			$check = false;
		}
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			sort($numbers);
			$sum = array_sum($numbers);
			$count = count($numbers);
			$average = round($sum / $count, 4);
			if (($count % 2) != 0) {
				// $center = round($count / 2);
				// $median = $numbers[$center--];
				$center = floor($count / 2);
				$median = $numbers[$center];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($numbers[$center] + $numbers[$next]) / 2;
			}
			function interpolate($array, $position)
			{
				$floor_index = floor($position) - 1;
				$ceil_index = ceil($position) - 1;

				if ($floor_index == $ceil_index) {
					return $array[$floor_index];
				} else {
					return $array[$floor_index] + ($position - floor($position)) * ($array[$ceil_index] - $array[$floor_index]);
				}
			}
			// Calculate Q1 (Lower Quartile)
			$Q1_position = ($count + 1) / 4;
			$Q1 = interpolate($numbers, $Q1_position);

			// Calculate Q3 (Upper Quartile)
			$Q3_position = 3 * ($count + 1) / 4;
			$Q3 = interpolate($numbers, $Q3_position);
			// Calculate IQR (Interquartile Range)
			$IQR = $Q3 - $Q1;

			// dd($Q1,$Q3,$IQR);

			$m_array = array_count_values($numbers);
			$m_max = max($m_array);
			$mode = array();
			$has_repeating = false;
			foreach ($m_array as $key => $value) {
				if ($value > 1 && $value == $m_max) {
					$mode[] = $key;
					$has_repeating = true;
				}
			}
			if (!$has_repeating) {
				$mode[] = "No value appears more than once!";
			}
			$this->param['Q1'] = $Q1;
			$this->param['Q3'] = $Q3;
			$this->param['IQR'] = $IQR;
			$this->param['mode'] = $mode;
			$this->param['median'] = $median;
			$this->param['average'] = $average;
			$this->param['count'] = $count;
			$this->param['numbers'] = $numbers;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please enter numbers";
			return $this->param;
		}
	}


	public function quartile($request)
	{

		$check = true;
		if (empty($request->x)) {
			$check = false;
		}
		$seprate = $request->seprate;
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$values = array_map('trim', array_filter(explode($seprate, $request->x)));
		foreach ($values as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			sort($values);
			if (count($values) < 4) {
				$this->param['error'] = "Please! enter 4 or more numbers";
				return $this->param;
			}
			$count = count($values);
			$a1 = $values[0];
			$a2 = $values[$count - 1];
			function quartil($arr)
			{
				$count = count($arr);
				$middleval = floor(($count - 1) / 2);
				if ($count % 2) {
					$median = $arr[$middleval];
				} else {
					$low = $arr[$middleval];
					$high = $arr[$middleval + 1];
					$median = (($low + $high) / 2);
				}
				return number_format((float)$median, 1, '.', '');
			}
			$second = quartil($values);

			$tmp = array();
			foreach ($values as $key => $val) {
				if ($val > $second) {
					$tmp['third'][] = $val;
				} else if ($val < $second) {
					$tmp['first'][] = $val;
				}
			}

			$first = quartil($tmp['first']);
			$third = quartil($tmp['third']);
			$min = min($values);
			$max = max($values);
			$iter = $third - $first;
			$sum = array_sum($values);
			$count = count($values);
			$average = round($sum / $count, 4);
			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $values[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($values[$center] + $values[$next]) / 2;
			}
			$m_array = array_count_values($values);
			$m_max = max($m_array);
			$mode = array();
			foreach ($m_array as $key => $value) {
				if ($value == $m_max) {
					$mode[] = $key;
				}
			}
			$sum = array_sum($values);
			$m = round($sum / count($values), 3);
			$d = 0;
			foreach ($values as $key => $value) {
				$d = $d + pow($value - $m, 2);
			}
			$s_d_p = (1 / (count($values))) * $d;
			$s_d_s = (1 / (count($values) - 1)) * $d;
			$s_d_p = round(sqrt($s_d_p), 4);
			$s_d_s = round(sqrt($s_d_s), 4);
			$this->param['a1'] = $a1;
			$this->param['a2'] = $a2;
			$this->param['first'] = $first;
			$this->param['second'] = $second;
			$this->param['third'] = $third;
			$this->param['iter'] = $iter;
			$this->param['mode'] = $mode;
			$this->param['s_d_p'] = $s_d_p;
			$this->param['s_d_s'] = $s_d_s;
			$this->param['median'] = $median;
			$this->param['average'] = $average;
			$this->param['count'] = $count;
			$this->param['numbers'] = $values;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function geometric($request)
	{
		$check = true;
		if (empty($request->x)) {
			$check = false;
		}
		$seprate = $request->seprate;
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$x = $request->x;
		if (empty($x)) {
			$this->param['error'] = "Please Enter Your Values";
			return $this->param;
		}
		$cleaned_input = preg_replace('/[^0-9.\-%]/', ' ', $x);
		$numbers = preg_split('/(?<=\d)(?=-)|\s+/', $cleaned_input, -1, PREG_SPLIT_NO_EMPTY);
		$check = true;
		$type = 'number';

		foreach ($numbers as $value) {
			$clean_value = str_replace('%', '', $value);
			if (!is_numeric($clean_value)) {
				$check = false;
			}
			if (strpos($value, '-') !== false || strpos($value, '%') !== false) {
				$type = 'percentage';
			}
		}
		// dd($type);
		if ($check == true) {
			sort($numbers);
			$last_index = count($numbers) - 1;
			$sol = "(";
			// dd($type);
			if ($type == 'number') {
				foreach ($numbers as $key => $value) {
					if ($key != $last_index) {
						$sol .= " $value x";
					} else {
						$sol .= " $value )";
					}
				}
				if (array_product($numbers) < 0) {
					$this->param['error'] = "Please Check Your Input";
					return $this->param;
				}
			} else {
				$sol1 = "( ";
				$pro = 1;
				foreach ($numbers as $key => $value) {
					$value = str_replace('%', '', $value);
					$pro = $pro * (1 + ($value / 100));
					if ($key != $last_index) {
						$sol .= " (1 + $value/100) x";
						$sol1 .= (1 + ($value / 100)) . " x ";
					} else {
						$sol .= " (1 + $value/100) )";
						$sol1 .= (1 + ($value / 100)) . " )";
					}
				}
				$geo = round((pow($pro, (1 / count($numbers))) - 1) * 100, 4);
				// dd($geo);
				$this->param['textline'] = "aa gai value";
				$this->param['sol1'] = $sol1;
				$this->param['pro'] = $pro;
				$this->param['geo'] = $geo . "%";
			}
			$sum = array_sum($numbers);
			$count = count($numbers);
			$average = round($sum / $count, 4);
			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $numbers[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($numbers[$center] + $numbers[$next]) / 2;
			}
			$d = 1;
			foreach ($numbers as $key => $value) {
				$d = $d * $value;
				if (!is_numeric($value)) {
					$number = false;
				}
			}
			$m_array = array_count_values($numbers);
			$m_max = max($m_array);
			$mode = array();
			foreach ($m_array as $key => $value) {
				if ($value == $m_max) {
					$mode[] = $key;
				}
			}
			$sum = array_sum($numbers);
			$m = round($sum / count($numbers), 3);
			$this->param['mode'] = $mode;
			$this->param['sol'] = $sol;
			$this->param['median'] = $median;
			$this->param['average'] = $average;
			$this->param['count'] = $count;
			$this->param['numbers'] = $numbers;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = "Please Check Your Input";
			return $this->param;
		}
	}

	public function harmonic($request)
	{
		$check = true;
		if (empty($request->x)) {
			$check = false;
		}
		$seprate = $request->seprate;
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$numbers = array_map('trim', array_filter(explode($seprate, $request->x)));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			sort($numbers);
			$last_index = count($numbers) - 1;
			$sol = "(";
			$sol1 = "( ";
			$ans = 0;
			foreach ($numbers as $key => $value) {
				$ans = $ans + (1 / $value);
				if ($key != $last_index) {
					$sol .= " 1/$value +";
					$sol1 .= 1 / $value . " + ";
				} else {
					$sol1 .= 1 / $value . ")";
					$sol .= " 1/$value )";
				}
			}
			$sum = array_sum($numbers);
			$count = count($numbers);
			$ans = round($count / $ans, 5);
			$average = round($sum / $count, 4);
			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $numbers[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($numbers[$center] + $numbers[$next]) / 2;
			}
			$d = 1;
			foreach ($numbers as $key => $value) {
				$d = $d * $value;
				if (!is_numeric($value)) {
					$number = false;
				}
			}
			$m_array = array_count_values($numbers);
			$m_max = max($m_array);
			$mode = array();
			foreach ($m_array as $key => $value) {
				if ($value == $m_max) {
					$mode[] = $key;
				}
			}
			$sum = array_sum($numbers);
			$m = round($sum / count($numbers), 3);
			$this->param['mode'] = $mode;
			$this->param['sol'] = $sol;
			$this->param['sol1'] = $sol1;
			$this->param['ans'] = $ans;
			$this->param['median'] = $median;
			$this->param['average'] = $average;
			$this->param['count'] = $count;
			$this->param['numbers'] = $numbers;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please Check Your Input";
			return $this->param;
		}
	}

	public function interquartile($request)
	{
		$check = true;
		if (empty($request->x)) {
			$check = false;
		}
		$seprate = $request->seprate;
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$values = array_map('trim', array_filter(explode($seprate, $request->x)));
		foreach ($values as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			sort($values);
			if (count($values) < 4) {
				$this->param['error'] = "Please! enter 4 or more numbers";
				return $this->param;
			}
			$count = count($values);
			$a1 = $values[0];
			$a2 = $values[$count - 1];
			function quartil($arr)
			{
				$count = count($arr);
				$middleval = floor(($count - 1) / 2);
				if ($count % 2) {
					$median = $arr[$middleval];
				} else {
					$low = $arr[$middleval];
					$high = $arr[$middleval + 1];
					$median = (($low + $high) / 2);
				}
				return number_format((float)$median, 1, '.', '');
			}
			$second = quartil($values);

			$tmp = array();
			foreach ($values as $key => $val) {
				if ($val > $second) {
					$tmp['third'][] = $val;
				} else if ($val < $second) {
					$tmp['first'][] = $val;
				}
			}

			$first = quartil($tmp['first']);
			$third = quartil($tmp['third']);
			$min = min($values);
			$max = max($values);
			$iter = $third - $first;
			$sum = array_sum($values);
			$count = count($values);
			$average = round($sum / $count, 4);
			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $values[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($values[$center] + $values[$next]) / 2;
			}
			$m_array = array_count_values($values);
			$m_max = max($m_array);
			$mode = array();
			foreach ($m_array as $key => $value) {
				if ($value == $m_max) {
					$mode[] = $key;
				}
			}
			$sum = array_sum($values);
			$m = round($sum / count($values), 3);
			$d = 0;
			foreach ($values as $key => $value) {
				$d = $d + pow($value - $m, 2);
			}
			$s_d_p = (1 / (count($values))) * $d;
			$s_d_s = (1 / (count($values) - 1)) * $d;
			$s_d_p = round(sqrt($s_d_p), 4);
			$s_d_s = round(sqrt($s_d_s), 4);
			$this->param['a1'] = $a1;
			$this->param['a2'] = $a2;
			$this->param['first'] = $first;
			$this->param['second'] = $second;
			$this->param['third'] = $third;
			$this->param['iter'] = $iter;
			$this->param['mode'] = $mode;
			$this->param['s_d_p'] = $s_d_p;
			$this->param['s_d_s'] = $s_d_s;
			$this->param['median'] = $median;
			$this->param['average'] = $average;
			$this->param['count'] = $count;
			$this->param['numbers'] = $values;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function sum($request)
	{
		$check = true;
		if (empty($request->x)) {
			$check = false;
		}
		$seprate = $request->seprate;
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$numbers = array_map('trim', array_filter(explode($seprate, $request->x)));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			$ns = $numbers;
			$s = array_sum($ns) / count($ns);
			$n = count($ns);
			$sa = 0;
			foreach ($ns as $key => $value) {
				$sa += pow(($value - $s), 2);
			}
			$su = 0;
			foreach ($ns as $key => $value) {
				$su += pow($value, 2);
			}
			$so = 0;
			foreach ($ns as $key => $value) {
				$so += $value;
			}
			$sns = '';
			foreach ($ns as $key => $value) {
				if ($key == (count($ns) - 1)) {
					$sns .= "($value - $s)<sup>2</sup>";
				} else {
					$sns .= "($value - $s)<sup>2</sup> + ";
				}
			}
			$snns = '';
			foreach ($ns as $key => $value) {
				if ($key == (count($ns) - 1)) {
					$a = pow($value - $s, 2);
					$snns .= "$a";
				} else {
					$a = pow($value - $s, 2);
					$snns .= " $a+ ";
				}
			}
			$soa = '';
			foreach ($ns as $key => $value) {
				if ($key == (count($ns) - 1)) {
					$soa .= "($value)<sup>2</sup>";
				} else {
					$soa .= "($value)<sup>2</sup> + ";
				}
			}
			$soas = '';
			foreach ($ns as $key => $value) {
				if ($key == (count($ns) - 1)) {
					$a = pow($value, 2);
					$soas .= "$a";
				} else {
					$a = pow($value, 2);
					$soas .= " $a+ ";
				}
			}
			$this->param['soas'] = $soas;
			$this->param['soa'] = $soa;
			$this->param['snns'] = $snns;
			$this->param['sns'] = $sns;
			$this->param['s'] = $s;
			$this->param['so'] = $so;
			$this->param['n'] = $n;
			$this->param['su'] = $su;
			$this->param['ss'] = $sa;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function z($request)
	{
		$z_table = [
			'-4.0' => [9 => 0.00002, 8 => 0.00002, 7 => 0.00002, 6 => 0.00002, 5 => 0.00003, 4 => 0.00003, 3 => 0.00003, 2 => 0.00003, 1 => 0.00003, 0 => 0.00003],
			'-3.9' => [9 => 0.00003, 8 => 0.00003, 7 => 0.00004, 6 => 0.00004, 5 => 0.00004, 4 => 0.00004, 3 => 0.00004, 2 => 0.00004, 1 => 0.00005, 0 => 0.00005],
			'-3.8' => [9 => 0.00005, 8 => 0.00005, 7 => 0.00005, 6 => 0.00006, 5 => 0.00006, 4 => 0.00006, 3 => 0.00006, 2 => 0.00007, 1 => 0.00007, 0 => 0.00007],
			'-3.7' => [9 => 0.00008, 8 => 0.00008, 7 => 0.00008, 6 => 0.00008, 5 => 0.00009, 4 => 0.00009, 3 => 0.00010, 2 => 0.00010, 1 => 0.00010, 0 => 0.00011],
			'-3.6' => [9 => 0.00011, 8 => 0.00012, 7 => 0.00012, 6 => 0.00013, 5 => 0.00013, 4 => 0.00014, 3 => 0.00014, 2 => 0.00015, 1 => 0.00015, 0 => 0.00016],
			'-3.5' => [9 => 0.00017, 8 => 0.00017, 7 => 0.00018, 6 => 0.00019, 5 => 0.00019, 4 => 0.00020, 3 => 0.00021, 2 => 0.00022, 1 => 0.00022, 0 => 0.00023],
			'-3.4' => [9 => 0.00024, 8 => 0.00025, 7 => 0.00026, 6 => 0.00027, 5 => 0.00028, 4 => 0.00029, 3 => 0.00030, 2 => 0.00031, 1 => 0.00032, 0 => 0.00034],
			'-3.3' => [9 => 0.00035, 8 => 0.00036, 7 => 0.00038, 6 => 0.00039, 5 => 0.00040, 4 => 0.00042, 3 => 0.00043, 2 => 0.00045, 1 => 0.00047, 0 => 0.00048],
			'-3.2' => [9 => 0.00050, 8 => 0.00052, 7 => 0.00054, 6 => 0.00056, 5 => 0.00058, 4 => 0.00060, 3 => 0.00062, 2 => 0.00064, 1 => 0.00066, 0 => 0.00069],
			'-3.1' => [9 => 0.00071, 8 => 0.00074, 7 => 0.00076, 6 => 0.00079, 5 => 0.00082, 4 => 0.00084, 3 => 0.00087, 2 => 0.00090, 1 => 0.00094, 0 => 0.00097],
			'-3.0' => [9 => 0.00100, 8 => 0.00104, 7 => 0.00107, 6 => 0.00111, 5 => 0.00114, 4 => 0.00118, 3 => 0.00122, 2 => 0.00126, 1 => 0.00131, 0 => 0.00135],
			'-2.9' => [9 => 0.00139, 8 => 0.00144, 7 => 0.00149, 6 => 0.00154, 5 => 0.00159, 4 => 0.00164, 3 => 0.00169, 2 => 0.00175, 1 => 0.00181, 0 => 0.00187],
			'-2.8' => [9 => 0.00193, 8 => 0.00199, 7 => 0.00205, 6 => 0.00212, 5 => 0.00219, 4 => 0.00226, 3 => 0.00233, 2 => 0.00240, 1 => 0.00248, 0 => 0.00256],
			'-2.7' => [9 => 0.00264, 8 => 0.00272, 7 => 0.00280, 6 => 0.00289, 5 => 0.00298, 4 => 0.00307, 3 => 0.00317, 2 => 0.00326, 1 => 0.00336, 0 => 0.00347],
			'-2.6' => [9 => 0.00357, 8 => 0.00368, 7 => 0.00379, 6 => 0.00391, 5 => 0.00402, 4 => 0.00415, 3 => 0.00427, 2 => 0.00440, 1 => 0.00453, 0 => 0.00466],
			'-2.5' => [9 => 0.00480, 8 => 0.00494, 7 => 0.00508, 6 => 0.00523, 5 => 0.00539, 4 => 0.00554, 3 => 0.00570, 2 => 0.00587, 1 => 0.00604, 0 => 0.00621],
			'-2.4' => [9 => 0.00639, 8 => 0.00657, 7 => 0.00676, 6 => 0.00695, 5 => 0.00714, 4 => 0.00734, 3 => 0.00755, 2 => 0.00776, 1 => 0.00798, 0 => 0.00820],
			'-2.3' => [9 => 0.00842, 8 => 0.00866, 7 => 0.00889, 6 => 0.00914, 5 => 0.00939, 4 => 0.00964, 3 => 0.00990, 2 => 0.01017, 1 => 0.01044, 0 => 0.01072],
			'-2.2' => [9 => 0.01101, 8 => 0.01130, 7 => 0.01160, 6 => 0.01191, 5 => 0.01222, 4 => 0.01255, 3 => 0.01287, 2 => 0.01321, 1 => 0.01355, 0 => 0.01390],
			'-2.1' => [9 => 0.01426, 8 => 0.01463, 7 => 0.01500, 6 => 0.01539, 5 => 0.01578, 4 => 0.01618, 3 => 0.01659, 2 => 0.01700, 1 => 0.01743, 0 => 0.01786],
			'-2.0' => [9 => 0.01831, 8 => 0.01876, 7 => 0.01923, 6 => 0.01970, 5 => 0.02018, 4 => 0.02068, 3 => 0.02118, 2 => 0.02169, 1 => 0.02222, 0 => 0.02275],
			'-1.9' => [9 => 0.02330, 8 => 0.02385, 7 => 0.02442, 6 => 0.02500, 5 => 0.02559, 4 => 0.02619, 3 => 0.02680, 2 => 0.02743, 1 => 0.02807, 0 => 0.02872],
			'-1.8' => [9 => 0.02938, 8 => 0.03005, 7 => 0.03074, 6 => 0.03144, 5 => 0.03216, 4 => 0.03288, 3 => 0.03362, 2 => 0.03438, 1 => 0.03515, 0 => 0.03593],
			'-1.7' => [9 => 0.03673, 8 => 0.03754, 7 => 0.03836, 6 => 0.03920, 5 => 0.04006, 4 => 0.04093, 3 => 0.04182, 2 => 0.04272, 1 => 0.04363, 0 => 0.04457],
			'-1.6' => [9 => 0.04551, 8 => 0.04648, 7 => 0.04746, 6 => 0.04846, 5 => 0.04947, 4 => 0.05050, 3 => 0.05155, 2 => 0.05262, 1 => 0.05370, 0 => 0.05480],
			'-1.5' => [9 => 0.0559, 8 => 0.0571, 7 => 0.0582, 6 => 0.0594, 5 => 0.0606, 4 => 0.0618, 3 => 0.0630, 2 => 0.0643, 1 => 0.0655, 0 => 0.0668],
			'-1.4' => [9 => 0.0681, 8 => 0.0694, 7 => 0.0708, 6 => 0.0721, 5 => 0.0735, 4 => 0.0749, 3 => 0.0764, 2 => 0.0778, 1 => 0.0793, 0 => 0.0808],
			'-1.3' => [9 => 0.0823, 8 => 0.0838, 7 => 0.0853, 6 => 0.0869, 5 => 0.0885, 4 => 0.0901, 3 => 0.0918, 2 => 0.0934, 1 => 0.0951, 0 => 0.0968],
			'-1.2' => [9 => 0.0985, 8 => 0.1003, 7 => 0.1020, 6 => 0.1038, 5 => 0.1056, 4 => 0.1075, 3 => 0.1093, 2 => 0.1112, 1 => 0.1131, 0 => 0.1151],
			'-1.1' => [9 => 0.1170, 8 => 0.1190, 7 => 0.1210, 6 => 0.1230, 5 => 0.1251, 4 => 0.1271, 3 => 0.1292, 2 => 0.1314, 1 => 0.1335, 0 => 0.1357],
			'-1.0' => [9 => 0.1379, 8 => 0.1401, 7 => 0.1423, 6 => 0.1446, 5 => 0.1469, 4 => 0.1492, 3 => 0.1515, 2 => 0.1539, 1 => 0.1562, 0 => 0.1587],
			'-0.9' => [9 => 0.1611, 8 => 0.1635, 7 => 0.1660, 6 => 0.1685, 5 => 0.1711, 4 => 0.1736, 3 => 0.1762, 2 => 0.1788, 1 => 0.1814, 0 => 0.1841],
			'-0.8' => [9 => 0.1867, 8 => 0.1894, 7 => 0.1922, 6 => 0.1949, 5 => 0.1977, 4 => 0.2005, 3 => 0.2033, 2 => 0.2061, 1 => 0.2090, 0 => 0.2119],
			'-0.7' => [9 => 0.2148, 8 => 0.2177, 7 => 0.2206, 6 => 0.2236, 5 => 0.2266, 4 => 0.2296, 3 => 0.2327, 2 => 0.2358, 1 => 0.2389, 0 => 0.2420],
			'-0.6' => [9 => 0.2451, 8 => 0.2483, 7 => 0.2514, 6 => 0.2546, 5 => 0.2578, 4 => 0.2611, 3 => 0.2643, 2 => 0.2676, 1 => 0.2709, 0 => 0.2743],
			'-0.5' => [9 => 0.2776, 8 => 0.2810, 7 => 0.2843, 6 => 0.2877, 5 => 0.2912, 4 => 0.2946, 3 => 0.2981, 2 => 0.3015, 1 => 0.3050, 0 => 0.3085],
			'-0.4' => [9 => 0.3121, 8 => 0.3156, 7 => 0.3192, 6 => 0.3228, 5 => 0.3264, 4 => 0.3300, 3 => 0.3336, 2 => 0.3372, 1 => 0.3409, 0 => 0.3446],
			'-0.3' => [9 => 0.3483, 8 => 0.3520, 7 => 0.3557, 6 => 0.3594, 5 => 0.3632, 4 => 0.3669, 3 => 0.3707, 2 => 0.3745, 1 => 0.3783, 0 => 0.3821],
			'-0.2' => [9 => 0.3829, 8 => 0.3897, 7 => 0.3936, 6 => 0.3974, 5 => 0.4013, 4 => 0.4052, 3 => 0.4090, 2 => 0.4129, 1 => 0.4168, 0 => 0.4207],
			'-0.1' => [9 => 0.4247, 8 => 0.4286, 7 => 0.4325, 6 => 0.4364, 5 => 0.4404, 4 => 0.4443, 3 => 0.4483, 2 => 0.4522, 1 => 0.4562, 0 => 0.4602],
			'-0.0' => [9 => 0.4641, 8 => 0.4681, 7 => 0.4721, 6 => 0.4761, 5 => 0.4801, 4 => 0.4840, 3 => 0.4880, 2 => 0.4920, 1 => 0.4960, 0 => 0.5000],
			'0.0' => [0 => 0.50000, 1 => 0.50399, 2 => 0.50798, 3 => 0.51197, 4 => 0.51595, 5 => 0.51994, 6 => 0.52392, 7 => 0.52790, 8 => 0.53188, 9 => 0.53586],
			'0.1' => [0 => 0.53980, 1 => 0.54380, 2 => 0.54776, 3 => 0.55172, 4 => 0.55567, 5 => 0.55966, 6 => 0.56360, 7 => 0.56749, 8 => 0.57142, 9 => 0.57535],
			'0.2' => [0 => 0.57930, 1 => 0.58317, 2 => 0.58706, 3 => 0.59095, 4 => 0.59483, 5 => 0.59871, 6 => 0.60257, 7 => 0.60642, 8 => 0.61026, 9 => 0.61409],
			'0.3' => [0 => 0.61791, 1 => 0.62172, 2 => 0.62552, 3 => 0.62930, 4 => 0.63307, 5 => 0.63683, 6 => 0.64058, 7 => 0.64431, 8 => 0.64803, 9 => 0.65173],
			'0.4' => [0 => 0.65542, 1 => 0.65910, 2 => 0.66276, 3 => 0.66640, 4 => 0.67003, 5 => 0.67364, 6 => 0.67724, 7 => 0.68082, 8 => 0.68439, 9 => 0.68793],
			'0.5' => [0 => 0.69146, 1 => 0.69497, 2 => 0.69847, 3 => 0.70194, 4 => 0.70540, 5 => 0.70884, 6 => 0.71226, 7 => 0.71566, 8 => 0.71904, 9 => 0.72240],
			'0.6' => [0 => 0.72575, 1 => 0.72907, 2 => 0.73237, 3 => 0.73565, 4 => 0.73891, 5 => 0.74215, 6 => 0.74537, 7 => 0.74857, 8 => 0.75175, 9 => 0.75490],
			'0.7' => [0 => 0.75804, 1 => 0.76115, 2 => 0.76424, 3 => 0.76730, 4 => 0.77035, 5 => 0.77337, 6 => 0.77637, 7 => 0.77935, 8 => 0.78230, 9 => 0.78524],
			'0.8' => [0 => 0.78814, 1 => 0.79103, 2 => 0.79389, 3 => 0.79673, 4 => 0.79955, 5 => 0.80234, 6 => 0.80511, 7 => 0.80785, 8 => 0.81057, 9 => 0.81327],
			'0.9' => [0 => 0.81594, 1 => 0.81859, 2 => 0.82121, 3 => 0.82381, 4 => 0.82639, 5 => 0.82894, 6 => 0.83147, 7 => 0.83398, 8 => 0.83646, 9 => 0.83891],
			'1.0' => [0 => 0.84134, 1 => 0.84375, 2 => 0.84614, 3 => 0.84849, 4 => 0.85083, 5 => 0.85314, 6 => 0.85543, 7 => 0.85769, 8 => 0.85993, 9 => 0.86214],
			'1.1' => [0 => 0.86433, 1 => 0.86650, 2 => 0.86864, 3 => 0.87076, 4 => 0.87286, 5 => 0.87493, 6 => 0.87698, 7 => 0.87900, 8 => 0.88100, 9 => 0.88298],
			'1.2' => [0 => 0.88493, 1 => 0.88686, 2 => 0.88877, 3 => 0.89065, 4 => 0.89251, 5 => 0.89435, 6 => 0.89617, 7 => 0.89796, 8 => 0.89973, 9 => 0.90147],
			'1.3' => [0 => 0.90320, 1 => 0.90490, 2 => 0.90658, 3 => 0.90824, 4 => 0.90988, 5 => 0.91149, 6 => 0.91308, 7 => 0.91466, 8 => 0.91621, 9 => 0.91774],
			'1.4' => [0 => 0.91924, 1 => 0.92073, 2 => 0.92220, 3 => 0.92364, 4 => 0.92507, 5 => 0.92647, 6 => 0.92785, 7 => 0.92922, 8 => 0.93056, 9 => 0.93189],
			'1.5' => [0 => 0.93319, 1 => 0.93448, 2 => 0.93574, 3 => 0.93699, 4 => 0.93822, 5 => 0.93943, 6 => 0.94062, 7 => 0.94179, 8 => 0.94295, 9 => 0.94408],
			'1.6' => [0 => 0.94520, 1 => 0.94630, 2 => 0.94738, 3 => 0.94845, 4 => 0.94950, 5 => 0.95053, 6 => 0.95154, 7 => 0.95254, 8 => 0.95352, 9 => 0.95449],
			'1.7' => [0 => 0.95543, 1 => 0.95637, 2 => 0.95728, 3 => 0.95818, 4 => 0.95907, 5 => 0.95994, 6 => 0.96080, 7 => 0.96164, 8 => 0.96246, 9 => 0.96327],
			'1.8' => [0 => 0.96407, 1 => 0.96485, 2 => 0.96562, 3 => 0.96638, 4 => 0.96712, 5 => 0.96784, 6 => 0.96856, 7 => 0.96926, 8 => 0.96995, 9 => 0.97062],
			'1.9' => [0 => 0.97128, 1 => 0.97193, 2 => 0.97257, 3 => 0.97320, 4 => 0.97381, 5 => 0.97441, 6 => 0.97500, 7 => 0.97558, 8 => 0.97615, 9 => 0.97670],
			'2.0' => [0 => 0.97725, 1 => 0.97778, 2 => 0.97831, 3 => 0.97882, 4 => 0.97932, 5 => 0.97982, 6 => 0.98030, 7 => 0.98077, 8 => 0.98124, 9 => 0.98169],
			'2.1' => [0 => 0.98214, 1 => 0.98257, 2 => 0.98300, 3 => 0.98341, 4 => 0.98382, 5 => 0.98422, 6 => 0.98461, 7 => 0.98500, 8 => 0.98537, 9 => 0.98574],
			'2.2' => [0 => 0.98610, 1 => 0.98645, 2 => 0.98679, 3 => 0.98713, 4 => 0.98745, 5 => 0.98778, 6 => 0.98809, 7 => 0.98840, 8 => 0.98870, 9 => 0.98899],
			'2.3' => [0 => 0.98928, 1 => 0.98956, 2 => 0.98983, 3 => 0.99010, 4 => 0.99036, 5 => 0.99061, 6 => 0.99086, 7 => 0.99111, 8 => 0.99134, 9 => 0.99158],
			'2.4' => [0 => 0.99180, 1 => 0.99202, 2 => 0.99224, 3 => 0.99245, 4 => 0.99266, 5 => 0.99286, 6 => 0.99305, 7 => 0.99324, 8 => 0.99343, 9 => 0.99361],
			'2.5' => [0 => 0.99379, 1 => 0.99396, 2 => 0.99413, 3 => 0.99430, 4 => 0.99446, 5 => 0.99461, 6 => 0.99477, 7 => 0.99492, 8 => 0.99506, 9 => 0.99520],
			'2.6' => [0 => 0.99534, 1 => 0.99547, 2 => 0.99560, 3 => 0.99573, 4 => 0.99585, 5 => 0.99598, 6 => 0.99609, 7 => 0.99621, 8 => 0.99632, 9 => 0.99643],
			'2.7' => [0 => 0.99653, 1 => 0.99664, 2 => 0.99674, 3 => 0.99683, 4 => 0.99693, 5 => 0.99702, 6 => 0.99711, 7 => 0.99720, 8 => 0.99728, 9 => 0.99736],
			'2.8' => [0 => 0.99744, 1 => 0.99752, 2 => 0.99760, 3 => 0.99767, 4 => 0.99774, 5 => 0.99781, 6 => 0.99788, 7 => 0.99795, 8 => 0.99801, 9 => 0.99807],
			'2.9' => [0 => 0.99813, 1 => 0.99819, 2 => 0.99825, 3 => 0.99831, 4 => 0.99836, 5 => 0.99841, 6 => 0.99846, 7 => 0.99851, 8 => 0.99856, 9 => 0.99861],
			'3.0' => [0 => 0.99865, 1 => 0.99869, 2 => 0.99874, 3 => 0.99878, 4 => 0.99882, 5 => 0.99886, 6 => 0.99889, 7 => 0.99893, 8 => 0.99896, 9 => 0.99900],
			'3.1' => [0 => 0.99903, 1 => 0.99906, 2 => 0.99910, 3 => 0.99913, 4 => 0.99916, 5 => 0.99918, 6 => 0.99921, 7 => 0.99924, 8 => 0.99926, 9 => 0.99929],
			'3.2' => [0 => 0.99931, 1 => 0.99934, 2 => 0.99936, 3 => 0.99938, 4 => 0.99940, 5 => 0.99942, 6 => 0.99944, 7 => 0.99946, 8 => 0.99948, 9 => 0.99950],
			'3.3' => [0 => 0.99952, 1 => 0.99953, 2 => 0.99955, 3 => 0.99957, 4 => 0.99958, 5 => 0.99960, 6 => 0.99961, 7 => 0.99962, 8 => 0.99964, 9 => 0.99965],
			'3.4' => [0 => 0.99966, 1 => 0.99968, 2 => 0.99969, 3 => 0.99970, 4 => 0.99971, 5 => 0.99972, 6 => 0.99973, 7 => 0.99974, 8 => 0.99975, 9 => 0.99976],
			'3.5' => [0 => 0.99977, 1 => 0.99978, 2 => 0.99978, 3 => 0.99979, 4 => 0.99980, 5 => 0.99981, 6 => 0.99981, 7 => 0.99982, 8 => 0.99983, 9 => 0.99983],
			'3.6' => [0 => 0.99984, 1 => 0.99985, 2 => 0.99985, 3 => 0.99986, 4 => 0.99986, 5 => 0.99987, 6 => 0.99987, 7 => 0.99988, 8 => 0.99988, 9 => 0.99989],
			'3.7' => [0 => 0.99989, 1 => 0.99990, 2 => 0.99990, 3 => 0.99990, 4 => 0.99991, 5 => 0.99991, 6 => 0.99992, 7 => 0.99992, 8 => 0.99992, 9 => 0.99992],
			'3.8' => [0 => 0.99993, 1 => 0.99993, 2 => 0.99993, 3 => 0.99994, 4 => 0.99994, 5 => 0.99994, 6 => 0.99994, 7 => 0.99995, 8 => 0.99995, 9 => 0.99995],
			'3.9' => [0 => 0.99995, 1 => 0.99995, 2 => 0.99996, 3 => 0.99996, 4 => 0.99996, 5 => 0.99996, 6 => 0.99996, 7 => 0.99996, 8 => 0.99997, 9 => 0.99997],
			'4.0' => [0 => 0.99997, 1 => 0.99997, 2 => 0.99997, 3 => 0.99997, 4 => 0.99997, 5 => 0.99997, 6 => 0.99998, 7 => 0.99998, 8 => 0.99998, 9 => 0.99998],
		];
		if ($request->to_calculate == 'dp') {
			if (is_numeric($request->dsvalue) && is_numeric($request->pmvalue) && is_numeric($request->psdvalue)) {
				$x = $request->dsvalue;
				$u = $request->pmvalue;
				$o = $request->psdvalue;
				$ms = $x - $u;
				$rz = ($x - $u) / $o;
				$rz_check = str_split($rz);
				if (count($rz_check) > 1) {
					if ($rz < 0) {
						if (count($rz_check) == 2) {
							$rz_val1 = $rz_check;
							$rz_val1[2] = '.0';
							$rz_val1 = $rz_val1[0] . $rz_val1[1] . $rz_val1[2];
							$rz_val2 = 0;
						} else {
							if (strlen($rz) > 3) {
								$rz_val1 = $rz_check[0] . $rz_check[1] . $rz_check[2] . $rz_check[3];
							}
							if (strlen($rz) > 4) {
								$rz_val2 = $rz_check[4];
							} else {
								$rz_val2 = 0;
							}
						}
					} else {
						if (strlen($rz) > 2) {
							$rz_val1 = $rz_check[0] . $rz_check[1] . $rz_check[2];
						}
						if (strlen($rz) > 3) {
							$rz_val2 = $rz_check[3];
						} else {
							$rz_val2 = 0;
						}
					}
				} else {
					$rz_val1 = $rz_check;
					$rz_val1[1] = '.0';
					$rz_val1 = $rz_val1[0] . $rz_val1[1];
					$rz_val2 = 0;
				}
				if ($rz >= 4.1) {
					$ltpv = 1;
					$rtpv = 0;
				} elseif ($rz <= -4.1) {
					$ltpv = 0;
					$rtpv = 1;
				} else {
					$ltpv = number_format(($z_table[$rz_val1][$rz_val2]), 5);
					$rtpv = number_format((1 - $ltpv), 5);
				}
				$ttcl = $ltpv - $rtpv;
				$ttpv = 1 - abs($ttcl);
				$rz = trim($rz);
				if ($rz < -0.126 && $rz > -0.376) {
					$z_url = 'z_score_-0.25';
				} elseif ($rz < -0.375 && $rz > -0.626) {
					$z_url = 'z_score_-0.5';
				} elseif ($rz < -0.625 && $rz > -0.876) {
					$z_url = 'z_score_-0.75';
				} elseif ($rz < -0.875 && $rz > -1.126) {
					$z_url = 'z_score_-1';
				} elseif ($rz < -1.125 && $rz > -1.376) {
					$z_url = 'z_score_-1.25';
				} elseif ($rz < -1.375 && $rz > -1.626) {
					$z_url = 'z_score_-1.5';
				} elseif ($rz < -1.625 && $rz > -1.876) {
					$z_url = 'z_score_-1.75';
				} elseif ($rz < -1.875 && $rz > -2.126) {
					$z_url = 'z_score_-2';
				} elseif ($rz < -2.125 && $rz > -2.376) {
					$z_url = 'z_score_-2.25';
				} elseif ($rz < -2.375 && $rz > -2.626) {
					$z_url = 'z_score_-2.5';
				} elseif ($rz < -2.625 && $rz > -2.876) {
					$z_url = 'z_score_-2.75';
				} elseif ($rz < -2.875 && $rz > -3.126) {
					$z_url = 'z_score_-3';
				} elseif ($rz < -3.125 && $rz > -3.376) {
					$z_url = 'z_score_-3.25';
				} elseif ($rz < -3.375 && $rz > -3.626) {
					$z_url = 'z_score_-3.5';
				} elseif ($rz < -3.625 && $rz > -3.876) {
					$z_url = 'z_score_-3.75';
				} elseif ($rz < -3.875 && $rz > -4.126) {
					$z_url = 'z_score_-4';
				} elseif ($rz < -4.125) {
					$z_url = 'z_score_-4.25';
				} elseif ($rz > -0.126 && $rz < 0.125) {
					$z_url = 'z_score_0';
				} elseif ($rz > 0.124 && $rz < 0.375) {
					$z_url = 'z_score_0.25';
				} elseif ($rz > 0.374 && $rz < 0.625) {
					$z_url = 'z_score_0.5';
				} elseif ($rz > 0.624 && $rz < 0.875) {
					$z_url = 'z_score_0.75';
				} elseif ($rz > 0.874 && $rz < 1.125) {
					$z_url = 'z_score_1';
				} elseif ($rz > 1.124 && $rz < 1.375) {
					$z_url = 'z_score_1.25';
				} elseif ($rz > 1.374 && $rz < 1.625) {
					$z_url = 'z_score_1.5';
				} elseif ($rz > 1.624 && $rz < 1.875) {
					$z_url = 'z_score_1.75';
				} elseif ($rz > 1.874 && $rz < 2.125) {
					$z_url = 'z_score_2';
				} elseif ($rz > 2.124 && $rz < 2.375) {
					$z_url = 'z_score_2.25';
				} elseif ($rz > 2.374 && $rz < 2.625) {
					$z_url = 'z_score_2.5';
				} elseif ($rz > 2.624 && $rz < 2.875) {
					$z_url = 'z_score_2.75';
				} elseif ($rz > 2.874 && $rz < 3.125) {
					$z_url = 'z_score_3';
				} elseif ($rz > 3.124 && $rz < 3.375) {
					$z_url = 'z_score_3.25';
				} elseif ($rz > 3.374 && $rz < 3.625) {
					$z_url = 'z_score_3.5';
				} elseif ($rz > 3.624 && $rz < 3.875) {
					$z_url = 'z_score_3.75';
				} elseif ($rz > 3.874 && $rz < 4.125) {
					$z_url = 'z_score_4';
				} elseif ($rz > 4.124) {
					$z_url = 'z_score_4.25';
				}
				$this->param['z_url'] = $z_url;
				$this->param['ltpv'] = abs($ltpv);
				$this->param['rtpv'] = abs($rtpv);
				$this->param['ttpv'] = abs($ttpv);
				$this->param['ttcl'] = abs($ttcl);
				$this->param['ms'] = $ms;
				$this->param['rz'] = round($rz, 4);
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = "Please fill all fields.";
				return $this->param;
			}
		}
		if ($request->to_calculate == 'sm') {
			if (is_numeric($request->snvalue) && is_numeric($request->pmvalue) && is_numeric($request->psdvalue) && is_numeric($request->smvalue)) {
				$x = $request->smvalue;
				$n = $request->snvalue;
				$u = $request->pmvalue;
				$o = $request->psdvalue;
				$rz = ($x - $u) / ($o / sqrt($n));
				$ms = $x - $u;
				$sq = sqrt($n);
				$mv = $o / $sq;
				$this->param['ms'] = $ms;
				$this->param['mv'] = $mv;
				$this->param['sq'] = $sq;
				$this->param['rz'] = round($rz, 4);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill all fields.";
				return $this->param;
			}
		}
		if ($request->to_calculate == 'ds') {
			$check = true;
			if (empty($request->x) && empty($request->pmvalue) && empty($request->psdvalue)) {
				$check = false;
			}
			$numbers = array_map('trim', array_filter(explode(',', $request->x)));
			foreach ($numbers as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			if ($check == true) {
				$a = '';
				$n = count($numbers);
				$arr = $numbers;
				$sum = array_sum($arr);
				$avg = $sum / $n;
				$u = $request->pmvalue;
				$o = $request->psdvalue;
				$rz = ($avg - $u) / ($o / sqrt($n));
				foreach ($arr as $key => $value) {
					if ($key != (count($arr) - 1)) {
						$a .= " $value +";
					} else {
						$a .= " $value ";
					}
				}
				$sm = $avg - $u;
				$sq = sqrt($n);
				$dv = $o / $sq;
				$this->param['avg'] = $avg;
				$this->param['n'] = $n;
				$this->param['a'] = $a;
				$this->param['sum'] = $sum;
				$this->param['sm'] = $sm;
				$this->param['sq'] = $sq;
				$this->param['dv'] = $dv;
				$this->param['rz'] = round($rz, 4);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please fill all fields.";
				return $this->param;
			}
		}
		if ($request->to_calculate == 'p') {
			if (is_numeric($request->pvalue)) {
				$pva = $request->pvalue;
				if ($pva > 0 && $pva < 1) {
					$this->param['pva'] = $pva;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = "Please Input value from 0 to 1.";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please Put P Value.";
				return $this->param;
			}
			$this->param['RESULT'] = 1;

			return $this->param;
		}
	}
	public function standerror($request)
	{
		if ($request->form == 'raw') {
			$check = true;
			if (empty($request->x) && empty($request->pmvalue) && empty($request->psdvalue)) {
				$check = false;
			}
			$x = $request->x;
			$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			while (strpos($x, ",,") !== false) {
				$x = str_replace(",,", ",", $x);
			}
			$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			foreach ($numbers as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			if ($check == true) {
				$d = '';
				$v = '';
				$v1 = '';
				$v2 = '';
				$v3 = '';
				$v4 = '';
				$v5 = '';
				$rv = '';
				$v6 = '';
				$v7 = '';
				$arr1 = array();
				$arr = $numbers;
				$count = count($arr);
				$sum = array_sum($arr);
				$mean = $sum / $count;
				foreach ($arr as $key => $value) {
					$a = $value - $mean;
					$b = pow($a, 2);
					$arr1[] = $b;
					if ($key != (count($arr) - 1)) {
						$v3 .= " $b +";
						$v1 .= " ($value - $mean)² + ";
						$v .= " ( $a )² +";
					} else {
						$v1 .= " ($value - $mean)²  ";
						$v .= " ( $a )² ";
						$v3 .= " $b ";
					}
				}
				$c = array_sum($arr1);
				$v2 = $count - 1;
				$v4 = 1 / $v2;
				$v5 = $v4 * $c;
				$v6 = sqrt($count);
				$rv = round(sqrt($v5), 4);
				$d = sqrt(1 / ($count - 1) * $c);
				$e = round($d, 4);
				$v7 = round($e / $v6, 4);
				$se = round($d / sqrt($count), 4);
				$this->param['count'] = $count;
				$this->param['sum'] = $sum;
				$this->param['mean'] = $mean;
				$this->param['e'] = $e;
				$this->param['se'] = $se;
				$this->param['v'] = $v;
				$this->param['v1'] = $v1;
				$this->param['v2'] = $v2;
				$this->param['v3'] = $v3;
				$this->param['c'] = $c;
				$this->param['v4'] = $v4;
				$this->param['v5'] = $v5;
				$this->param['rv'] = $rv;
				$this->param['v6'] = $v6;
				$this->param['v7'] = $v7;
				$this->param['form'] = $request->form;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please Input Some Values.";
				return $this->param;
			}
		}
		if ($request->form == 'summary') {
			if (is_numeric($request->deviation) && is_numeric($request->sample)) {
				$de = $request->deviation;
				$n = $request->sample;
				$sn = round(sqrt($n), 4);
				$se = round($de / $sn, 4);
				$this->param['se'] = $se;
				$this->param['sn'] = $sn;
				$this->param['RESULT'] = 1;
				$this->param['form'] = $request->form;

				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
	}

	public function expected($request)
	{
		// dd($request->all());
		if ($request->check == 'txtar') {
			$check = true;
			if (empty($request->xx) || empty($request->px)) {
				$check = false;
			}
			$numbers = $request->xx;
			$numbers1 = $request->px;
			// $numbers = array_map('trim', array_filter(explode(',', $request->x)));
			// $numbers1 = array_map('trim', array_filter(explode(',', $request->x1)));
			// $x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			// while (strpos($x, ",,") !== false) {
			// 	$x = str_replace(",,", ",", $x);
			// }
			// $numbers = array_map('trim', array_filter(explode(',', $x), function($value) {
			// 	return $value !== '';
			// }));
			// $x1 = str_replace([" ", ",", "\n", "\r"], ",", $x1);
			// while (strpos($x1, ",,") !== false) {
			// 	$x1 = str_replace(",,", ",", $x1);
			// }
			// $numbers1 = array_map('trim', array_filter(explode(',', $x1), function($value) {
			// 	return $value !== '';
			// }));
			// dd($numbers,$numbers1);
			foreach ($numbers as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			foreach ($numbers1 as $value1) {
				if (!is_numeric($value1)) {
					$check = false;
				}
			}
			if ($check == true) {
				$n = count($numbers);
				$n1 = count($numbers1);
				$n1_sum = round(array_sum($numbers1), 1);
				if ($n == $n1) {
					if ($n1_sum != 1) {
						$this->param['error'] = "The sum of P(X) must be 1.";
						return $this->param;
					}
					$res = array();
					$show_res = '';
					$show_res1 = '';
					for ($i = 0; $i < $n; $i++) {
						$val = $numbers[$i];
						$val1 = $numbers1[$i];
						$res[$i] = $val * $val1;
						$plus = '+';
						if ($i + 1 == $n) {
							$plus = '';
						}
						$show_res .= '( ' . $val . ' ) * ( ' . $val1 . ' )' . $plus;
						$show_res1 .= '( ' . $val * $val1 . ' )' . $plus;
						$txt[$i] = "
							<tr class='bg-white'>
								<td class='border p-2'>" . "$numbers[$i]" . "</td>
								<td class='border p-2'>" . "$numbers1[$i]" . "</td>
								<td class='border p-2'>" . "$res[$i]" . "</td>
							</tr>
						";
						$this->param['show_val' . $i] = $txt[$i];
						$request->show_val++;
					}
					$sum1 = array_sum($numbers);
					$sum2 = array_sum($numbers1);
					$ress = array_sum($res);
					$this->param['show_res'] = $show_res;
					$this->param['show_res1'] = $show_res1;
					$this->param['sum1'] = $sum1;
					$this->param['sum2'] = $sum2;
					$this->param['ress'] = $ress;
					$this->param['RESULT'] = 1;
                     dd($this->param);

					return $this->param;
				} else {
					$this->param['error'] = "X and P(X) must have same number of elements.";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please fill all fields.";
				return $this->param;
			}
		} elseif ($request->check == 'table') {
			$td_value = $request->td_value;
			$numbers = array();
			$numbers1 = array();
			for ($i = 1; $i < $td_value; $i++) {
				if (is_numeric($request->a . $i)) {
					$numbers[] = $request->a . $i;
				}
				if (is_numeric($request->b . $i)) {
					$numbers1[] = $request->b . $i;
				}
			}
			$n = count($numbers);
			$n1 = count($numbers1);
			if ($n == $n1) {
				if (array_sum($numbers1) > 1 || array_sum($numbers1) < 1) {
					$this->param['error'] = "The sum of P(X) must be 1.";
					return $this->param;
				}
				$res = array();
				$show_res = '';
				$show_res1 = '';
				for ($i = 0; $i < $n; $i++) {
					$val = $numbers[$i];
					$val1 = $numbers1[$i];
					$res[$i] = $val * $val1;
					$plus = '+';
					if ($i + 1 == $n) {
						$plus = '';
					}
					$show_res .= '( ' . $val . ' ) * ( ' . $val1 . ' )' . $plus;
					$show_res1 .= '( ' . $val * $val1 . ' )' . $plus;
					$txt[$i] = "
						<tr class='bg-white'>
							<td class='border p-2'>" . "$numbers[$i]" . "</td>
							<td class='border p-2'>" . "$numbers1[$i]" . "</td>
							<td class='border p-2'>" . "$res[$i]" . "</td>
						</tr>
					";
					$this->param['show_val' . $i] = $txt[$i];
					$request->show_val++;
				}
				$sum1 = array_sum($numbers);
				$sum2 = array_sum($numbers1);
				$ress = array_sum($res);
				$this->param['show_res'] = $show_res;
				$this->param['show_res1'] = $show_res1;
				$this->param['sum1'] = $sum1;
				$this->param['sum2'] = $sum2;
				$this->param['ress'] = $ress;

				$this->param['RESULT'] = 1;
                   dd($this->param);

				return $this->param;
			} else {
				$this->param['error'] = "X and P(X) must have same number of elements.";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please fill all fields.";
			return $this->param;
		}
	}

	public function mad($request)
	{
		if (isset($request->submit)) {
			$x = $request->x;
			$method = $request->method;
			$m = $request->m;
		}
		$check = false;
		if (!empty($x)) {
			$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			while (strpos($x, ",,") !== false) {
				$x = str_replace(",,", ",", $x);
			}
			$data = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			$check = true;
		}
		foreach ($data as $key => $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			$this->param['m'] = $m;
			$this->param['x'] = $x;
			if ($method == 0) {
				$sum = array_sum($data);
				$n = count($data);
				$this->param['n'] = $n;
				$mean = $sum / $n;
				$diff = array();
				for ($i = 0; $i < $n; $i++) {
					$diff[] = abs($mean - $data[$i]);
				}
				$sum1 = array_sum($diff);
				$mad = $sum1 / $n;
				$this->param['sum1'] = $sum1;
				$this->param['diff'] = $diff;
				$this->param['mean'] = $mean;
				$this->param['method'] = $method;
				$this->param['mad'] = round($mad, 1);
				$this->param['RESULT'] = 1;
				return $this->param;
			} elseif ($method == 1) {
				sort($data);
				$n = count($data);
				if (($n % 2) != 0) {
					$center = round($n / 2);
					$median = $data[--$center];
				} else {
					$center = round($n / 2);
					$next = $center - 1;
					$median = ($data[$center] + $data[$next]) / 2;
				}
				$this->param['median'] = $median;
				$diff = array();
				for ($i = 0; $i < $n; $i++) {
					$diff[] = abs($median - $data[$i]);
				}
				$this->param['diff'] = $diff;
				sort($diff);
				$n1 = count($diff);
				if (($n % 2) != 0) {
					$center1 = round($n / 2);
					$median1 = $diff[--$center1];
				} else {
					$center1 = round($n / 2);
					$next1 = $center1 - 1;
					$median1 = ($diff[$center1] + $diff[$next1]) / 2;
				}
				$mad = round($median1);
				$this->param['diff1'] = $diff;
				$this->param['mad'] = round($mad, 1);
				$this->param['RESULT'] = 1;
				$this->param['method'] = $method;
				return $this->param;
			} else {
				$n = count($data);
				$diff = array();
				for ($i = 0; $i < $n; $i++) {
					$diff[] = abs($m - $data[$i]);
				}
				$sum = array_sum($diff);
				$mad = $sum / $n;
				$this->param['diff'] = $diff;
				$this->param['sum'] = $sum;
				$this->param['mad'] = round($mad, 1);
				$this->param['RESULT'] = 1;
				$this->param['method'] = $method;
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	function combination($request)
	{
		$n = $request->n;
		$r = $request->r;
		if (is_numeric($n) && is_numeric($r)) {
			if ($n > 999999) {
				$this->param['error'] = "n must be less than or equal to 999999";
				return $this->param;
			}
			if ($n < $r) {
				$this->param['error'] = "n must be Greater than r";
				return $this->param;
			}
			$step2 = "= " . $n . "! / (" . $r . "!(" . $n . " - " . $r . ")!)";
			$step3 = "= " . $n . "! / " . $r . "! x " . ($n - $r) . "!";
			$factn = gmp_fact($n);
			$factr = gmp_fact($r);
			$factnr = gmp_fact($n - $r);
			$rnr = gmp_mul($factr, $factnr);
			$answer =  gmp_div_q($factn, $rnr);
			$this->param['res-ans'] = $answer;
			$this->param['step2-res'] = $step2;
			$this->param['step3-res'] = $step3;
			$this->param['n-ans'] = $n;
			$this->param['r-ans'] = $r;
			return $this->param;
		} else {
			$this->param['error'] = "r needs to be less than or equal to n";
			return $this->param;
		}
		// dd($this->param);
	}

	public function permutation($request)
	{
		$n = $request->n;
		$r = $request->r;
		$find = $request->find;

		if (is_numeric($n) && is_numeric($r)) {
			// Main Start
			$this->param['r'] = $r;
			$this->param['n'] = $n;
			$this->param['find'] = $find;
			if (is_numeric($n) && is_numeric($r)) {
				if ($r <= $n) {
					// Calculating Factorials
					$n_fact = gmp_fact($n);
					$r_fact = gmp_fact($r);
					// Making Variables For Calculating Combination and Permutation
					$nr = $n - $r;
					$nr_fact = gmp_fact($nr);
					$nr_fact_prod = $r_fact * $nr_fact;
					// Making Variables For Calculating Combination Repetitions
					$nr1 = $n + $r - 1;
					$nr1_fact = gmp_fact($nr1);
					$n1 = $n - 1;
					$n1_fact = gmp_fact($n1);
					$nr1_fact_prod = $r_fact * $n1_fact;
					// Calculation
					$comb = $n_fact / $nr_fact_prod;
					$perm = $n_fact / $nr_fact;
					$comb_rep = $nr1_fact / $nr1_fact_prod;
					$perm_rep = pow($n, $r);
					if ($find === '2') {
						$this->param['perms'] = "perms";
					} else {
						$this->param['p_w_r'] = "p_w_r";
					}
					// Making Solution
					// Step 1
					$s1 = '';
					$mul = ' * ';
					for ($i = 1; $i <= $n; $i++) {
						if ($i > $n - 1) {
							$mul = '';
						}
						$s1 .= $i . $mul;
					}
					// Step 2
					$s2 = '';
					$mul = ' * ';
					for ($i = 1; $i <= $nr; $i++) {
						if ($i > $nr - 1) {
							$mul = '';
						}
						$s2 .= $i . $mul;
					}
					// Sending Results
					$this->param['comb'] = $comb;
					$this->param['perm'] = $perm;
					$this->param['s1'] = $s1;
					$this->param['s2'] = $s2;
					$this->param['nr'] = $nr;
					$this->param['n_fact'] = $n_fact;
					$this->param['r_fact'] = $r_fact;
					$this->param['nr_fact'] = $nr_fact;
					$this->param['comb_rep'] = $comb_rep;
					$this->param['perm_rep'] = $perm_rep;
					if ($n < 101) {
						$this->param['show_steps'] = "show_steps";
					}
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = "r needs to be less than or equal to n";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function standard($request)
	{

		function stdvScr($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$stdv_txt = stdvScr($request->stdv_txt);
		$stdv_txt = preg_replace("/\s+/", " ", $stdv_txt);
		$stdv_rad = stdvScr($request->stdv_rad);

		$check = true;

		if (empty($stdv_txt)) {
			$check = false;
		}

		$stdv_txt = str_replace([" ", ",", "\n", "\r"], ",", $stdv_txt);
		while (strpos($stdv_txt, ",,") !== false) {
			$stdv_txt = str_replace(",,", ",", $stdv_txt);
		}
		$stdv_txt = array_map('trim', array_filter(explode(',', $stdv_txt), function ($value) {
			return $value !== '';
		}));

		$i = 0;
		foreach ($stdv_txt as $value) {
			$i++;
			if (!is_numeric($value)) {
				$check = false;
			}
		}

		if (count($stdv_txt) < 2) {
			$check = false;
		}

		if ($check === true) {

			$sum = array_sum($stdv_txt);
			$m = round($sum / $i, 3);
			$d = 0;
			foreach ($stdv_txt as $key => $value) {
				$d = $d + pow($value - $m, 2);
			}
			if ($stdv_rad === "population") {
				$s_d = (1 / ($i)) * $d;
				$mSym = "μ";
			} else {
				$s_d = (1 / ($i - 1)) * $d;
				$mSym = "x̄";
			}

			$s_d = round(sqrt($s_d), 4);
			$v_2 = round(pow($s_d, 2), 2);
			$c = round($s_d / $m, 4);
			$s_e = $s_d / sqrt($i);
			$tablef = "";
			$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>xᵢ</th><th class='border p-2 text-center text-blue'>xᵢ - $mSym</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym)²</th></tr></thead><tbody>";
			$ar_2 = "";
			$arf_1 = "";
			for ($f = 0; $f < $i; $f++) {

				$ar_1 = pow(($stdv_txt[$f] - $m), 2) . ",";
				$ar_1 = str_replace(",", "", $ar_1);
				$ar_2 .= pow(($stdv_txt[$f] - $m), 2) . ",";
				$table .= "<tr class='bg-white'><td class='border p-2 text-center'>" . $stdv_txt[$f] . "</td><td class='border p-2 text-center'>" . ($stdv_txt[$f] - $m) . "</td><td class='border p-2 text-center'>" . $ar_1 . " </td></tr>";
				$ar_exp = explode(",", $ar_2);
				$arf_1 .= $stdv_txt[$f] . ",";
				$arf_2 = rtrim($arf_1, ",");
			}

			$ar_sum = array_sum($ar_exp);
			$table .= "<tr class='bg-gray'><th class='border p-2 text-center text-blue'>Σxᵢ = $sum </th><th class='p-2 border'> </th><th class='border p-2 text-center text-blue'>Σ(xᵢ - $mSym)² = $ar_sum</th></tr></tbody></table>";

			$arf_exp = explode(",", $arf_2);
			$arf_exp1 = array_count_values($arf_exp);
			foreach ($arf_exp1 as $key => $value) {
				$tablef .= "<tr><td class='py-2 border-b'>" . $key . "</td><td class='py-2 border-b'>" . $value . " (" . ((100 / $i) * $value) . "%)</td></tr>";
			}

			$mor = $s_d / sqrt($i);
			$put = $i;
			$put = ($put / 100) * (1 - ($put / 100));
			$this->param["put"] = $put;
			$this->param["i"] = $i;
			$this->param["mor"] = $mor;
			$this->param["d"] = round($s_d, 4);
			$this->param["m"] = $m;
			$this->param["c"] = $c;
			$this->param["t_n"] = $i;
			$this->param["v_2"] = $v_2;
			$this->param["sum"] = $sum;
			$this->param["s_e"] = $s_e;
			$this->param["table"] = $table;
			$this->param["tablef"] = $tablef;
			$this->param["ar_sum"] = $ar_sum;
			$this->param["stdv_rad"] = $stdv_rad;
			$this->param["RESULT"] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function _5($request)
	{
		$seprate = $request->seprateby;
		$x = $request->textarea;
		if (!empty($x)) {
			$check = true;
			if (empty($x)) {
				$check = false;
			}
			if ($seprate == "space") {
				$seprate = ' ';
			} else {
				$seprate = $request->seprateby;
			}
			$values = array_map('trim', array_filter(explode($seprate, $x)));
			foreach ($values as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			if ($check == true) {
				sort($values);
				if (count($values) < 2) {
					$this->param['error'] = "Please! enter 2 or more numbers";
					return $this->param;
				}
				$count = count($values);
				$a1 = $values[0];
				$a2 = $values[$count - 1];
				function quartil($arr)
				{
					$count = count($arr);
					$middleval = floor(($count - 1) / 2);
					if ($count % 2) {
						$median = $arr[$middleval];
					} else {
						$low = $arr[$middleval];
						$high = $arr[$middleval + 1];
						$median = (($low + $high) / 2);
					}
					return number_format((float)$median, 1, '.', '');
				}
				$second = quartil($values);
				$tmp = array();
				foreach ($values as $key => $val) {
					if ($val > $second) {
						$tmp['third'][] = $val;
					} elseif ($val < $second) {
						$tmp['first'][] = $val;
					}
				}
				$first = quartil($tmp['first']);
				$third = quartil($tmp['third']);
				$min = min($values);
				$max = max($values);
				$iter = $third - $first;
				$sum = array_sum($values);
				$count = count($values);
				$average = round($sum / $count, 4);
				if (($count % 2) != 0) {
					$center = round($count / 2);
					$median = $values[$center--];
				} else {
					$center = round($count / 2);
					$next = $center - 1;
					$median = ($values[$center] + $values[$next]) / 2;
				}
				$m_array = array_count_values($values);
				$m_max = max($m_array);
				$mode = array();
				foreach ($m_array as $key => $value) {
					if ($value == $m_max) {
						$mode[] = $key;
					}
				}
				$sum = array_sum($values);
				$m = round($sum / count($values), 3);
				$d = 0;
				foreach ($values as $key => $value) {
					$d = $d + pow($value - $m, 2);
				}
				$s_d_p = (1 / (count($values))) * $d;
				$s_d_s = (1 / (count($values) - 1)) * $d;
				$s_d_p = round(sqrt($s_d_p), 4);
				$s_d_s = round(sqrt($s_d_s), 4);
				$this->param['a1'] = $a1;
				$this->param['a2'] = $a2;
				$this->param['min'] = $min;
				$this->param['max'] = $max;
				$this->param['first'] = $first;
				$this->param['second'] = $second;
				$this->param['third'] = $third;
				$this->param['iter'] = $iter;
				$this->param['mode'] = $mode;
				$this->param['s_d_p'] = $s_d_p;
				$this->param['s_d_s'] = $s_d_s;
				$this->param['median'] = $median;
				$this->param['average'] = $average;
				$this->param['count'] = $count;
				$this->param['numbers'] = $values;
				rsort($values);
				$this->param['desc'] = $values;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function confidence($request)
	{
		$x = $request->x;
		$s = $request->s;
		$n = $request->n;
		$cl = $request->cl;
		$z = $request->z;
		if (is_numeric($x) && is_numeric($s) && is_numeric($n) && is_numeric($cl) && is_numeric($z)) {
			$z_table = [
				'-4.0' => [9 => 0.00002, 8 => 0.00002, 7 => 0.00002, 6 => 0.00002, 5 => 0.00003, 4 => 0.00003, 3 => 0.00003, 2 => 0.00003, 1 => 0.00003, 0 => 0.00003],
				'-3.9' => [9 => 0.00003, 8 => 0.00003, 7 => 0.00004, 6 => 0.00004, 5 => 0.00004, 4 => 0.00004, 3 => 0.00004, 2 => 0.00004, 1 => 0.00005, 0 => 0.00005],
				'-3.8' => [9 => 0.00005, 8 => 0.00005, 7 => 0.00005, 6 => 0.00006, 5 => 0.00006, 4 => 0.00006, 3 => 0.00006, 2 => 0.00007, 1 => 0.00007, 0 => 0.00007],
				'-3.7' => [9 => 0.00008, 8 => 0.00008, 7 => 0.00008, 6 => 0.00008, 5 => 0.00009, 4 => 0.00009, 3 => 0.00010, 2 => 0.00010, 1 => 0.00010, 0 => 0.00011],
				'-3.6' => [9 => 0.00011, 8 => 0.00012, 7 => 0.00012, 6 => 0.00013, 5 => 0.00013, 4 => 0.00014, 3 => 0.00014, 2 => 0.00015, 1 => 0.00015, 0 => 0.00016],
				'-3.5' => [9 => 0.00017, 8 => 0.00017, 7 => 0.00018, 6 => 0.00019, 5 => 0.00019, 4 => 0.00020, 3 => 0.00021, 2 => 0.00022, 1 => 0.00022, 0 => 0.00023],
				'-3.4' => [9 => 0.00024, 8 => 0.00025, 7 => 0.00026, 6 => 0.00027, 5 => 0.00028, 4 => 0.00029, 3 => 0.00030, 2 => 0.00031, 1 => 0.00032, 0 => 0.00034],
				'-3.3' => [9 => 0.00035, 8 => 0.00036, 7 => 0.00038, 6 => 0.00039, 5 => 0.00040, 4 => 0.00042, 3 => 0.00043, 2 => 0.00045, 1 => 0.00047, 0 => 0.00048],
				'-3.2' => [9 => 0.00050, 8 => 0.00052, 7 => 0.00054, 6 => 0.00056, 5 => 0.00058, 4 => 0.00060, 3 => 0.00062, 2 => 0.00064, 1 => 0.00066, 0 => 0.00069],
				'-3.1' => [9 => 0.00071, 8 => 0.00074, 7 => 0.00076, 6 => 0.00079, 5 => 0.00082, 4 => 0.00084, 3 => 0.00087, 2 => 0.00090, 1 => 0.00094, 0 => 0.00097],
				'-3.0' => [9 => 0.00100, 8 => 0.00104, 7 => 0.00107, 6 => 0.00111, 5 => 0.00114, 4 => 0.00118, 3 => 0.00122, 2 => 0.00126, 1 => 0.00131, 0 => 0.00135],
				'-2.9' => [9 => 0.00139, 8 => 0.00144, 7 => 0.00149, 6 => 0.00154, 5 => 0.00159, 4 => 0.00164, 3 => 0.00169, 2 => 0.00175, 1 => 0.00181, 0 => 0.00187],
				'-2.8' => [9 => 0.00193, 8 => 0.00199, 7 => 0.00205, 6 => 0.00212, 5 => 0.00219, 4 => 0.00226, 3 => 0.00233, 2 => 0.00240, 1 => 0.00248, 0 => 0.00256],
				'-2.7' => [9 => 0.00264, 8 => 0.00272, 7 => 0.00280, 6 => 0.00289, 5 => 0.00298, 4 => 0.00307, 3 => 0.00317, 2 => 0.00326, 1 => 0.00336, 0 => 0.00347],
				'-2.6' => [9 => 0.00357, 8 => 0.00368, 7 => 0.00379, 6 => 0.00391, 5 => 0.00402, 4 => 0.00415, 3 => 0.00427, 2 => 0.00440, 1 => 0.00453, 0 => 0.00466],
				'-2.5' => [9 => 0.00480, 8 => 0.00494, 7 => 0.00508, 6 => 0.00523, 5 => 0.00539, 4 => 0.00554, 3 => 0.00570, 2 => 0.00587, 1 => 0.00604, 0 => 0.00621],
				'-2.4' => [9 => 0.00639, 8 => 0.00657, 7 => 0.00676, 6 => 0.00695, 5 => 0.00714, 4 => 0.00734, 3 => 0.00755, 2 => 0.00776, 1 => 0.00798, 0 => 0.00820],
				'-2.3' => [9 => 0.00842, 8 => 0.00866, 7 => 0.00889, 6 => 0.00914, 5 => 0.00939, 4 => 0.00964, 3 => 0.00990, 2 => 0.01017, 1 => 0.01044, 0 => 0.01072],
				'-2.2' => [9 => 0.01101, 8 => 0.01130, 7 => 0.01160, 6 => 0.01191, 5 => 0.01222, 4 => 0.01255, 3 => 0.01287, 2 => 0.01321, 1 => 0.01355, 0 => 0.01390],
				'-2.1' => [9 => 0.01426, 8 => 0.01463, 7 => 0.01500, 6 => 0.01539, 5 => 0.01578, 4 => 0.01618, 3 => 0.01659, 2 => 0.01700, 1 => 0.01743, 0 => 0.01786],
				'-2.0' => [9 => 0.01831, 8 => 0.01876, 7 => 0.01923, 6 => 0.01970, 5 => 0.02018, 4 => 0.02068, 3 => 0.02118, 2 => 0.02169, 1 => 0.02222, 0 => 0.02275],
				'-1.9' => [9 => 0.02330, 8 => 0.02385, 7 => 0.02442, 6 => 0.02500, 5 => 0.02559, 4 => 0.02619, 3 => 0.02680, 2 => 0.02743, 1 => 0.02807, 0 => 0.02872],
				'-1.8' => [9 => 0.02938, 8 => 0.03005, 7 => 0.03074, 6 => 0.03144, 5 => 0.03216, 4 => 0.03288, 3 => 0.03362, 2 => 0.03438, 1 => 0.03515, 0 => 0.03593],
				'-1.7' => [9 => 0.03673, 8 => 0.03754, 7 => 0.03836, 6 => 0.03920, 5 => 0.04006, 4 => 0.04093, 3 => 0.04182, 2 => 0.04272, 1 => 0.04363, 0 => 0.04457],
				'-1.6' => [9 => 0.04551, 8 => 0.04648, 7 => 0.04746, 6 => 0.04846, 5 => 0.04947, 4 => 0.05050, 3 => 0.05155, 2 => 0.05262, 1 => 0.05370, 0 => 0.05480],
				'-1.5' => [9 => 0.0559, 8 => 0.0571, 7 => 0.0582, 6 => 0.0594, 5 => 0.0606, 4 => 0.0618, 3 => 0.0630, 2 => 0.0643, 1 => 0.0655, 0 => 0.0668],
				'-1.4' => [9 => 0.0681, 8 => 0.0694, 7 => 0.0708, 6 => 0.0721, 5 => 0.0735, 4 => 0.0749, 3 => 0.0764, 2 => 0.0778, 1 => 0.0793, 0 => 0.0808],
				'-1.3' => [9 => 0.0823, 8 => 0.0838, 7 => 0.0853, 6 => 0.0869, 5 => 0.0885, 4 => 0.0901, 3 => 0.0918, 2 => 0.0934, 1 => 0.0951, 0 => 0.0968],
				'-1.2' => [9 => 0.0985, 8 => 0.1003, 7 => 0.1020, 6 => 0.1038, 5 => 0.1056, 4 => 0.1075, 3 => 0.1093, 2 => 0.1112, 1 => 0.1131, 0 => 0.1151],
				'-1.1' => [9 => 0.1170, 8 => 0.1190, 7 => 0.1210, 6 => 0.1230, 5 => 0.1251, 4 => 0.1271, 3 => 0.1292, 2 => 0.1314, 1 => 0.1335, 0 => 0.1357],
				'-1.0' => [9 => 0.1379, 8 => 0.1401, 7 => 0.1423, 6 => 0.1446, 5 => 0.1469, 4 => 0.1492, 3 => 0.1515, 2 => 0.1539, 1 => 0.1562, 0 => 0.1587],
				'-0.9' => [9 => 0.1611, 8 => 0.1635, 7 => 0.1660, 6 => 0.1685, 5 => 0.1711, 4 => 0.1736, 3 => 0.1762, 2 => 0.1788, 1 => 0.1814, 0 => 0.1841],
				'-0.8' => [9 => 0.1867, 8 => 0.1894, 7 => 0.1922, 6 => 0.1949, 5 => 0.1977, 4 => 0.2005, 3 => 0.2033, 2 => 0.2061, 1 => 0.2090, 0 => 0.2119],
				'-0.7' => [9 => 0.2148, 8 => 0.2177, 7 => 0.2206, 6 => 0.2236, 5 => 0.2266, 4 => 0.2296, 3 => 0.2327, 2 => 0.2358, 1 => 0.2389, 0 => 0.2420],
				'-0.6' => [9 => 0.2451, 8 => 0.2483, 7 => 0.2514, 6 => 0.2546, 5 => 0.2578, 4 => 0.2611, 3 => 0.2643, 2 => 0.2676, 1 => 0.2709, 0 => 0.2743],
				'-0.5' => [9 => 0.2776, 8 => 0.2810, 7 => 0.2843, 6 => 0.2877, 5 => 0.2912, 4 => 0.2946, 3 => 0.2981, 2 => 0.3015, 1 => 0.3050, 0 => 0.3085],
				'-0.4' => [9 => 0.3121, 8 => 0.3156, 7 => 0.3192, 6 => 0.3228, 5 => 0.3264, 4 => 0.3300, 3 => 0.3336, 2 => 0.3372, 1 => 0.3409, 0 => 0.3446],
				'-0.3' => [9 => 0.3483, 8 => 0.3520, 7 => 0.3557, 6 => 0.3594, 5 => 0.3632, 4 => 0.3669, 3 => 0.3707, 2 => 0.3745, 1 => 0.3783, 0 => 0.3821],
				'-0.2' => [9 => 0.3829, 8 => 0.3897, 7 => 0.3936, 6 => 0.3974, 5 => 0.4013, 4 => 0.4052, 3 => 0.4090, 2 => 0.4129, 1 => 0.4168, 0 => 0.4207],
				'-0.1' => [9 => 0.4247, 8 => 0.4286, 7 => 0.4325, 6 => 0.4364, 5 => 0.4404, 4 => 0.4443, 3 => 0.4483, 2 => 0.4522, 1 => 0.4562, 0 => 0.4602],
				'-0.0' => [9 => 0.4641, 8 => 0.4681, 7 => 0.4721, 6 => 0.4761, 5 => 0.4801, 4 => 0.4840, 3 => 0.4880, 2 => 0.4920, 1 => 0.4960, 0 => 0.5000],
				'0.0' => [0 => 0.50000, 1 => 0.50399, 2 => 0.50798, 3 => 0.51197, 4 => 0.51595, 5 => 0.51994, 6 => 0.52392, 7 => 0.52790, 8 => 0.53188, 9 => 0.53586],
				'0.1' => [0 => 0.53980, 1 => 0.54380, 2 => 0.54776, 3 => 0.55172, 4 => 0.55567, 5 => 0.55966, 6 => 0.56360, 7 => 0.56749, 8 => 0.57142, 9 => 0.57535],
				'0.2' => [0 => 0.57930, 1 => 0.58317, 2 => 0.58706, 3 => 0.59095, 4 => 0.59483, 5 => 0.59871, 6 => 0.60257, 7 => 0.60642, 8 => 0.61026, 9 => 0.61409],
				'0.3' => [0 => 0.61791, 1 => 0.62172, 2 => 0.62552, 3 => 0.62930, 4 => 0.63307, 5 => 0.63683, 6 => 0.64058, 7 => 0.64431, 8 => 0.64803, 9 => 0.65173],
				'0.4' => [0 => 0.65542, 1 => 0.65910, 2 => 0.66276, 3 => 0.66640, 4 => 0.67003, 5 => 0.67364, 6 => 0.67724, 7 => 0.68082, 8 => 0.68439, 9 => 0.68793],
				'0.5' => [0 => 0.69146, 1 => 0.69497, 2 => 0.69847, 3 => 0.70194, 4 => 0.70540, 5 => 0.70884, 6 => 0.71226, 7 => 0.71566, 8 => 0.71904, 9 => 0.72240],
				'0.6' => [0 => 0.72575, 1 => 0.72907, 2 => 0.73237, 3 => 0.73565, 4 => 0.73891, 5 => 0.74215, 6 => 0.74537, 7 => 0.74857, 8 => 0.75175, 9 => 0.75490],
				'0.7' => [0 => 0.75804, 1 => 0.76115, 2 => 0.76424, 3 => 0.76730, 4 => 0.77035, 5 => 0.77337, 6 => 0.77637, 7 => 0.77935, 8 => 0.78230, 9 => 0.78524],
				'0.8' => [0 => 0.78814, 1 => 0.79103, 2 => 0.79389, 3 => 0.79673, 4 => 0.79955, 5 => 0.80234, 6 => 0.80511, 7 => 0.80785, 8 => 0.81057, 9 => 0.81327],
				'0.9' => [0 => 0.81594, 1 => 0.81859, 2 => 0.82121, 3 => 0.82381, 4 => 0.82639, 5 => 0.82894, 6 => 0.83147, 7 => 0.83398, 8 => 0.83646, 9 => 0.83891],
				'1.0' => [0 => 0.84134, 1 => 0.84375, 2 => 0.84614, 3 => 0.84849, 4 => 0.85083, 5 => 0.85314, 6 => 0.85543, 7 => 0.85769, 8 => 0.85993, 9 => 0.86214],
				'1.1' => [0 => 0.86433, 1 => 0.86650, 2 => 0.86864, 3 => 0.87076, 4 => 0.87286, 5 => 0.87493, 6 => 0.87698, 7 => 0.87900, 8 => 0.88100, 9 => 0.88298],
				'1.2' => [0 => 0.88493, 1 => 0.88686, 2 => 0.88877, 3 => 0.89065, 4 => 0.89251, 5 => 0.89435, 6 => 0.89617, 7 => 0.89796, 8 => 0.89973, 9 => 0.90147],
				'1.3' => [0 => 0.90320, 1 => 0.90490, 2 => 0.90658, 3 => 0.90824, 4 => 0.90988, 5 => 0.91149, 6 => 0.91308, 7 => 0.91466, 8 => 0.91621, 9 => 0.91774],
				'1.4' => [0 => 0.91924, 1 => 0.92073, 2 => 0.92220, 3 => 0.92364, 4 => 0.92507, 5 => 0.92647, 6 => 0.92785, 7 => 0.92922, 8 => 0.93056, 9 => 0.93189],
				'1.5' => [0 => 0.93319, 1 => 0.93448, 2 => 0.93574, 3 => 0.93699, 4 => 0.93822, 5 => 0.93943, 6 => 0.94062, 7 => 0.94179, 8 => 0.94295, 9 => 0.94408],
				'1.6' => [0 => 0.94520, 1 => 0.94630, 2 => 0.94738, 3 => 0.94845, 4 => 0.94950, 5 => 0.95053, 6 => 0.95154, 7 => 0.95254, 8 => 0.95352, 9 => 0.95449],
				'1.7' => [0 => 0.95543, 1 => 0.95637, 2 => 0.95728, 3 => 0.95818, 4 => 0.95907, 5 => 0.95994, 6 => 0.96080, 7 => 0.96164, 8 => 0.96246, 9 => 0.96327],
				'1.8' => [0 => 0.96407, 1 => 0.96485, 2 => 0.96562, 3 => 0.96638, 4 => 0.96712, 5 => 0.96784, 6 => 0.96856, 7 => 0.96926, 8 => 0.96995, 9 => 0.97062],
				'1.9' => [0 => 0.97128, 1 => 0.97193, 2 => 0.97257, 3 => 0.97320, 4 => 0.97381, 5 => 0.97441, 6 => 0.97500, 7 => 0.97558, 8 => 0.97615, 9 => 0.97670],
				'2.0' => [0 => 0.97725, 1 => 0.97778, 2 => 0.97831, 3 => 0.97882, 4 => 0.97932, 5 => 0.97982, 6 => 0.98030, 7 => 0.98077, 8 => 0.98124, 9 => 0.98169],
				'2.1' => [0 => 0.98214, 1 => 0.98257, 2 => 0.98300, 3 => 0.98341, 4 => 0.98382, 5 => 0.98422, 6 => 0.98461, 7 => 0.98500, 8 => 0.98537, 9 => 0.98574],
				'2.2' => [0 => 0.98610, 1 => 0.98645, 2 => 0.98679, 3 => 0.98713, 4 => 0.98745, 5 => 0.98778, 6 => 0.98809, 7 => 0.98840, 8 => 0.98870, 9 => 0.98899],
				'2.3' => [0 => 0.98928, 1 => 0.98956, 2 => 0.98983, 3 => 0.99010, 4 => 0.99036, 5 => 0.99061, 6 => 0.99086, 7 => 0.99111, 8 => 0.99134, 9 => 0.99158],
				'2.4' => [0 => 0.99180, 1 => 0.99202, 2 => 0.99224, 3 => 0.99245, 4 => 0.99266, 5 => 0.99286, 6 => 0.99305, 7 => 0.99324, 8 => 0.99343, 9 => 0.99361],
				'2.5' => [0 => 0.99379, 1 => 0.99396, 2 => 0.99413, 3 => 0.99430, 4 => 0.99446, 5 => 0.99461, 6 => 0.99477, 7 => 0.99492, 8 => 0.99506, 9 => 0.99520],
				'2.6' => [0 => 0.99534, 1 => 0.99547, 2 => 0.99560, 3 => 0.99573, 4 => 0.99585, 5 => 0.99598, 6 => 0.99609, 7 => 0.99621, 8 => 0.99632, 9 => 0.99643],
				'2.7' => [0 => 0.99653, 1 => 0.99664, 2 => 0.99674, 3 => 0.99683, 4 => 0.99693, 5 => 0.99702, 6 => 0.99711, 7 => 0.99720, 8 => 0.99728, 9 => 0.99736],
				'2.8' => [0 => 0.99744, 1 => 0.99752, 2 => 0.99760, 3 => 0.99767, 4 => 0.99774, 5 => 0.99781, 6 => 0.99788, 7 => 0.99795, 8 => 0.99801, 9 => 0.99807],
				'2.9' => [0 => 0.99813, 1 => 0.99819, 2 => 0.99825, 3 => 0.99831, 4 => 0.99836, 5 => 0.99841, 6 => 0.99846, 7 => 0.99851, 8 => 0.99856, 9 => 0.99861],
				'3.0' => [0 => 0.99865, 1 => 0.99869, 2 => 0.99874, 3 => 0.99878, 4 => 0.99882, 5 => 0.99886, 6 => 0.99889, 7 => 0.99893, 8 => 0.99896, 9 => 0.99900],
				'3.1' => [0 => 0.99903, 1 => 0.99906, 2 => 0.99910, 3 => 0.99913, 4 => 0.99916, 5 => 0.99918, 6 => 0.99921, 7 => 0.99924, 8 => 0.99926, 9 => 0.99929],
				'3.2' => [0 => 0.99931, 1 => 0.99934, 2 => 0.99936, 3 => 0.99938, 4 => 0.99940, 5 => 0.99942, 6 => 0.99944, 7 => 0.99946, 8 => 0.99948, 9 => 0.99950],
				'3.3' => [0 => 0.99952, 1 => 0.99953, 2 => 0.99955, 3 => 0.99957, 4 => 0.99958, 5 => 0.99960, 6 => 0.99961, 7 => 0.99962, 8 => 0.99964, 9 => 0.99965],
				'3.4' => [0 => 0.99966, 1 => 0.99968, 2 => 0.99969, 3 => 0.99970, 4 => 0.99971, 5 => 0.99972, 6 => 0.99973, 7 => 0.99974, 8 => 0.99975, 9 => 0.99976],
				'3.5' => [0 => 0.99977, 1 => 0.99978, 2 => 0.99978, 3 => 0.99979, 4 => 0.99980, 5 => 0.99981, 6 => 0.99981, 7 => 0.99982, 8 => 0.99983, 9 => 0.99983],
				'3.6' => [0 => 0.99984, 1 => 0.99985, 2 => 0.99985, 3 => 0.99986, 4 => 0.99986, 5 => 0.99987, 6 => 0.99987, 7 => 0.99988, 8 => 0.99988, 9 => 0.99989],
				'3.7' => [0 => 0.99989, 1 => 0.99990, 2 => 0.99990, 3 => 0.99990, 4 => 0.99991, 5 => 0.99991, 6 => 0.99992, 7 => 0.99992, 8 => 0.99992, 9 => 0.99992],
				'3.8' => [0 => 0.99993, 1 => 0.99993, 2 => 0.99993, 3 => 0.99994, 4 => 0.99994, 5 => 0.99994, 6 => 0.99994, 7 => 0.99995, 8 => 0.99995, 9 => 0.99995],
				'3.9' => [0 => 0.99995, 1 => 0.99995, 2 => 0.99996, 3 => 0.99996, 4 => 0.99996, 5 => 0.99996, 6 => 0.99996, 7 => 0.99996, 8 => 0.99997, 9 => 0.99997],
				'4.0' => [0 => 0.99997, 1 => 0.99997, 2 => 0.99997, 3 => 0.99997, 4 => 0.99997, 5 => 0.99997, 6 => 0.99998, 7 => 0.99998, 8 => 0.99998, 9 => 0.99998],
			];
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
			if ($n < 1 || $cl < 0 || $cl > 99.99) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			} else {
				$se = $s / sqrt($n);
				$ci = $x . ' ± ' . sigFIg(($z * $se), 4);
				$ci1 = $x - ($z * $se);
				$ci2 = $x + ($z * $se);
				$moe = $se * $z;
				$rtpv = ((100 - $cl) / 2) / 100;
				$this->param['se'] = sigFig($se, 5);
				$this->param['ci'] = $ci;
				$this->param['ci1'] = sigFig($ci1, 4);
				$this->param['ci2'] = sigFig($ci2, 4);
				$this->param['lb'] = sigFig($ci1, 6);
				$this->param['ub'] = sigFig($ci2, 6);
				$this->param['moe'] = sigFig($moe, 5);
				$this->param['rtpv'] = $rtpv;
				$this->param['zscore'] = sigFig($z, 7);
				$this->param['RESULT'] = 1;
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Fill All The Fields";
			return $this->param;
		}
	}
	public function central($request)
	{
		$u = $request->u;
		$o = $request->o;
		$n = $request->n;
		if (is_numeric($u) && is_numeric($o) && is_numeric($n)) {
			$s1 = sqrt($n);
			$s = $o / $s1;
			$x = $u;
			$this->param['s'] = $s;
			$this->param['x'] = $x;
			$this->param['s1'] = $s1;
			$this->param['o'] = $o;
			$this->param['n'] = $n;
			$this->param['u'] = $u;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function variance($request)
	{
		$cal_meth = $request->cal_meth;
		$set = $request->set;
		if (!empty($set) && !empty($cal_meth)) {
			$check = true;
			if (empty($set)) {
				$check = false;
			}
			$set = str_replace([" ", ",", "\n", "\r"], ",", $set);
			while (strpos($set, ",,") !== false) {
				$set = str_replace(",,", ",", $set);
			}
			$set = array_map('trim', array_filter(explode(',', $set), function ($value) {
				return $value !== '';
			}));
			$set = array_map('floatval', $set);
			sort($set);
			$array_set = $set;
			$i = 0;
			foreach ($set as $value) {
				$i++;
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			if (count($set) < 2) {
				$check = false;
			}
			if ($check === true) {
				$sum = array_sum($set);
				$mean = round($sum / $i, 3);
				$d = 0;
				foreach ($set as $value) {
					$d = $d + pow($value - $mean, 2);
				}
				if ($cal_meth === "population") {
					$s_d = (1 / ($i)) * $d;
					$mSym = "μ";
				} else {
					$s_d = (1 / ($i - 1)) * $d;
					$mSym = "x̄";
				}
				$s_d = round(sqrt($s_d), 4);
				$var = round(pow($s_d, 2), 2);
				$c_v = round($s_d / $mean, 4);
				$tablef = "";
				$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>xᵢ</th><th class='border p-2 text-center text-blue'>xᵢ - $mSym</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym)²</th></tr></thead><tbody>";
				$ar_2 = "";
				$arf_1 = "";
				for ($f = 0; $f < $i; $f++) {
					$ar_1 = pow(($set[$f] - $mean), 2) . ",";
					$ar_1 = str_replace(",", "", $ar_1);
					$ar_2 .= pow(($set[$f] - $mean), 2) . ",";
					$table .= "<tr class='bg-white'><td class='border p-2 text-center'>" . $set[$f] . "</td><td class='border p-2 text-center'>" . ($set[$f] - $mean) . "</td><td class='border p-2 text-center'>" . $ar_1 . " </td></tr>";
					$ar_exp = explode(",", $ar_2);
					$arf_1 .= $set[$f] . ",";
					$arf_2 = rtrim($arf_1, ",");
				}
				$ss = array_sum($ar_exp);
				$table .= "<tr class='bg-gray'><th class='border p-2 text-center text-blue'>Σxᵢ = $sum </th><th class='border p-2'> </th><th class='border p-2 text-center text-blue'>Σ(xᵢ - $mSym)² = $ss</th></tr></tbody></table>";
				$this->param["var"] = $var;
				$this->param["mean"] = $mean;
				$this->param["s_d"] = $s_d;
				$this->param["c_v"] = $c_v;
				$this->param["t_n"] = $i;
				$this->param["sum"] = $sum;
				$this->param["table"] = $table;
				$this->param["ss"] = $ss;
				$this->param["cal_meth"] = $cal_meth;
				$this->param["set"] = $set;
				$this->param["array_set"] = $array_set;
				$this->param["RESULT"] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please check your input.";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}

	public function codc($request)
	{
		$x = $request->x;
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}

		$y = $request->y;
		$y = str_replace([" ", ",", "\n", "\r"], ",", $y);
		while (strpos($y, ",,") !== false) {
			$y = str_replace(",,", ",", $y);
		}
		if (!empty($x) && !empty($y)) {
			$check = true;
			if (!empty($x) && !empty($y)) {
				$check = true;
			} else {
				$check = false;
			}
			$set1 = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			$set2 = array_map('trim', array_filter(explode(',', $y), function ($value) {
				return $value !== '';
			}));
			foreach ($set1 as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			foreach ($set2 as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
			}
			$nx = count($set1);
			$ny = count($set2);
			if ($nx != $ny) {
				$check = false;
			}
			if ($check === true) {
				$sumx = array_sum($set1);
				$sumy = array_sum($set2);
				$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>Obs.</th><th class='border p-2 text-center text-blue'>X</th><th class='border p-2 text-center text-blue'>Y</th><th class='border p-2 text-center text-blue'>Xᵢ²</th><th class='border p-2 text-center text-blue'>Yᵢ²</th><th class='border p-2 text-center text-blue'>Xᵢ⋅Yᵢ</th></tr></thead><tbody>";
				$xii = array();
				$yii = array();
				$xy = array();
				foreach ($set1 as $key => $value) {
					$xi = pow($value, 2);
					$yi = pow($set2[$key], 2);
					$x_y = $value * $set2[$key];
					$num = $key + 1;
					$table .= "<tr class='bg-white'><td class='border p-2 text-center'>$num</td><td class='border p-2 text-center'>$value</td><td class='border p-2 text-center'>" . $set2[$key] . "</td><td class='border p-2 text-center'>$xi</td><td class='border p-2 text-center'>$yi</td><td class='border p-2 text-center'>$x_y</td></tr>";
					$xii[] .= $xi;
					$yii[] .= $yi;
					$xy[] .= $x_y;
				}
				$sumxi = array_sum($xii);
				$sumyi = array_sum($yii);
				$sumxy = array_sum($xy);
				$table .= "<tr class='bg-gray'><th class='border p-2 text-center text-blue'>Sum = </th><th class='border p-2 text-center text-blue'>$sumx</th><th class='border p-2 text-center text-blue'>$sumy</th><th class='border p-2 text-center text-blue'>$sumxi</th><th class='border p-2 text-center text-blue'>$sumyi</th><th class='border p-2 text-center text-blue'>$sumxy</th></tr></tbody></table>";
				$sumx2 = pow($sumx, 2);
				$sumy2 = pow($sumy, 2);
				// Method 1
				$ssxx = $sumxi - (1 / $nx) * $sumx2;
				$ssyy = $sumyi - (1 / $ny) * $sumy2;
				$ssxy = $sumxy - (1 / $nx) * ($sumx * $sumy);
				$r = $ssxy / sqrt($ssxx * $ssyy);
				$r2 = pow($r, 2);
				// Method 2
				$meanx = $sumx / $nx;
				$meany = $sumy / $ny;
				$s1 = '';
				$rnd_meanx = round($meanx, 4);
				$rnd_meany = round($meany, 4);
				foreach ($set1 as $key => $value) {
					if (count($set1) === $key + 1) {
						$s1 .= '(' . $value . ' - ' . $rnd_meanx . ')(' . $set2[$key] . ' - ' . $rnd_meany . ')';
					} else {
						$s1 .= '(' . $value . ' - ' . $rnd_meanx . ')(' . $set2[$key] . ' - ' . $rnd_meany . ') + ';
					}
				}
				$s2 = '';
				foreach ($set1 as $key => $value) {
					$v1 = $value - $meanx;
					$v2 = $set2[$key] - $meany;
					if (count($set1) === $key + 1) {
						$s2 .= '(' . round($v1, 4) . '*' . round($v2, 4) . ')';
					} else {
						$s2 .= '(' . round($v1, 4) . '*' . round($v2, 4) . ') + ';
					}
				}
				$s3 = '';
				foreach ($set1 as $key => $value) {
					$v1 = $value - $meanx;
					$v2 = $set2[$key] - $meany;
					if (count($set1) === $key + 1) {
						$s3 .= '(' . round($v1 * $v2, 4) . ')';
					} else {
						$s3 .= '(' . round($v1 * $v2, 4) . ') + ';
					}
				}
				$d = 0;
				foreach ($set1 as $key => $value) {
					$d = $d + pow($value - $meanx, 2);
				}
				$s_d = sqrt((1 / ($nx - 1) * $d));
				$d = 0;
				foreach ($set2 as $key => $value) {
					$d = $d + pow($value - $meany, 2);
				}
				$s_d1 = sqrt((1 / ($ny - 1) * $d));
				$s11 = ($nx - 1) * $s_d * $s_d1;
				// Method 3
				$delta = $nx * $sumxi - pow($sumx, 2);
				$a = ($nx * $sumxy - $sumx * $sumy) / $delta;
				$b = ($sumxi * $sumy - $sumx * $sumxy) / $delta;
				$sst_arr = array();
				$sst_table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>i</th><th class='border p-2 text-center text-blue'>yᵢ</th><th class='border p-2 text-center text-blue'>ȳ</th><th class='border p-2 text-center text-blue'>(yᵢ - ȳ)²</th></tr></thead><tbody>";
				foreach ($set2 as $key => $value) {
					$sst_ = pow($value - $meany, 2);
					$sst_table .= "<tr class='bg-white'><td class='border p-2 text-center'>$key</td><td class='border p-2 text-center'>$value</td><td class='border p-2 text-center'>" . round($meany, 4) . "</td><td class='border p-2 text-center'>" . round($sst_, 4) . "</td></tr>";
					$sst_arr[] .= $sst_;
				}
				$sst_table .= "</tbody></table>";
				$sst = array_sum($sst_arr);
				$ssr_arr = array();
				$ssr_table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>i</th><th class='border p-2 text-center text-blue'>x̂ᵢ</th><th class='border p-2 text-center text-blue'>ȳ</th><th class='border p-2 text-center text-blue'>(x̂ᵢ - ȳ)²</th></tr></thead><tbody>";
				foreach ($set1 as $key => $value) {
					$yhat = $a * $value + $b;
					$ssr_ = pow($yhat - $meany, 2);
					$ssr_table .= "<tr class='bg-white'><td class='border p-2 text-center'>$key</td><td class='border p-2 text-center'>" . round($yhat, 4) . "</td><td class='border p-2 text-center'>" . round($meany, 4) . "</td><td class='border p-2 text-center'>" . round($ssr_, 4) . "</td></tr>";
					$ssr_arr[] .= $ssr_;
				}
				$ssr_table .= "</tbody></table>";
				$ssr = array_sum($ssr_arr);
				$sse_arr = array();
				$sse_table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>i</th><th class='border p-2 text-center text-blue'>yᵢ</th><th class='border p-2 text-center text-blue'>x̂ᵢ</th><th class='border p-2 text-center text-blue'>(yᵢ - x̂ᵢ)²</th></tr></thead><tbody>";
				foreach ($set2 as $key => $value) {
					$yhat = $a * $set1[$key] + $b;
					$sse_ = pow($value - $yhat, 2);
					$sse_table .= "<tr class='bg-white'><td class='border p-2 text-center'>$key</td><td class='border p-2 text-center'>$value</td><td class='border p-2 text-center'>" . round($yhat, 4) . "</td><td class='border p-2 text-center'>" . round($sse_, 4) . "</td></tr>";
					$sse_arr[] .= $sse_;
				}
				$sse_table .= "</tbody></table>";
				$sse = array_sum($sse_arr);
				$this->param["n"] = $nx;
				$this->param["r"] = round($r, 4);
				$this->param["r2"] = round($r2, 4);
				$this->param["sumx"] = round($sumx, 4);
				$this->param["sumy"] = round($sumy, 4);
				$this->param["sumxi"] = round($sumxi, 4);
				$this->param["sumyi"] = round($sumyi, 4);
				$this->param["sumxy"] = round($sumxy, 4);
				$this->param["sumx2"] = round($sumx2, 4);
				$this->param["sumy2"] = round($sumy2, 4);
				$this->param["ssxx"] = round($ssxx, 4);
				$this->param["ssyy"] = round($ssyy, 4);
				$this->param["ssxy"] = round($ssxy, 4);
				$this->param["s_d"] = round($s_d, 4);
				$this->param["s_d1"] = round($s_d1, 4);
				$this->param["s1"] = $s1;
				$this->param["s2"] = $s2;
				$this->param["s3"] = $s3;
				$this->param["s11"] = round($s11, 4);
				$this->param["meanx"] = round($meanx, 4);
				$this->param["meany"] = round($meany, 4);
				$this->param["table"] = $table;
				$this->param["sst"] = round($sst, 4);
				$this->param["ssr"] = round($ssr, 4);
				$this->param["sse"] = round($sse, 4);
				$this->param["a"] = round($a, 2);
				$this->param["b"] = round($b, 2);
				$this->param["sst_table"] = $sst_table;
				$this->param["ssr_table"] = $ssr_table;
				$this->param["sse_table"] = $sse_table;
				$this->param["RESULT"] = 1;

				return $this->param;
			} else {
				$this->param['error'] = "Please check your input.";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}

	public function point($request)
	{

		$success = trim($request->success);
		$trials = trim($request->trials);
		$ci = trim($request->ci);
		if (is_numeric($success) && is_numeric($trials) && is_numeric($ci)) {
			if ($success <= $trials) {
				$z_table = [
					'0.0' => [0 => 0.50000, 1 => 0.50399, 2 => 0.50798, 3 => 0.51197, 4 => 0.51595, 5 => 0.51994, 6 => 0.52392, 7 => 0.52790, 8 => 0.53188, 9 => 0.53586],
					'0.1' => [0 => 0.53980, 1 => 0.54380, 2 => 0.54776, 3 => 0.55172, 4 => 0.55567, 5 => 0.55966, 6 => 0.56360, 7 => 0.56749, 8 => 0.57142, 9 => 0.57535],
					'0.2' => [0 => 0.57930, 1 => 0.58317, 2 => 0.58706, 3 => 0.59095, 4 => 0.59483, 5 => 0.59871, 6 => 0.60257, 7 => 0.60642, 8 => 0.61026, 9 => 0.61409],
					'0.3' => [0 => 0.61791, 1 => 0.62172, 2 => 0.62552, 3 => 0.62930, 4 => 0.63307, 5 => 0.63683, 6 => 0.64058, 7 => 0.64431, 8 => 0.64803, 9 => 0.65173],
					'0.4' => [0 => 0.65542, 1 => 0.65910, 2 => 0.66276, 3 => 0.66640, 4 => 0.67003, 5 => 0.67364, 6 => 0.67724, 7 => 0.68082, 8 => 0.68439, 9 => 0.68793],
					'0.5' => [0 => 0.69146, 1 => 0.69497, 2 => 0.69847, 3 => 0.70194, 4 => 0.70540, 5 => 0.70884, 6 => 0.71226, 7 => 0.71566, 8 => 0.71904, 9 => 0.72240],
					'0.6' => [0 => 0.72575, 1 => 0.72907, 2 => 0.73237, 3 => 0.73565, 4 => 0.73891, 5 => 0.74215, 6 => 0.74537, 7 => 0.74857, 8 => 0.75175, 9 => 0.75490],
					'0.7' => [0 => 0.75804, 1 => 0.76115, 2 => 0.76424, 3 => 0.76730, 4 => 0.77035, 5 => 0.77337, 6 => 0.77637, 7 => 0.77935, 8 => 0.78230, 9 => 0.78524],
					'0.8' => [0 => 0.78814, 1 => 0.79103, 2 => 0.79389, 3 => 0.79673, 4 => 0.79955, 5 => 0.80234, 6 => 0.80511, 7 => 0.80785, 8 => 0.81057, 9 => 0.81327],
					'0.9' => [0 => 0.81594, 1 => 0.81859, 2 => 0.82121, 3 => 0.82381, 4 => 0.82639, 5 => 0.82894, 6 => 0.83147, 7 => 0.83398, 8 => 0.83646, 9 => 0.83891],
					'1.0' => [0 => 0.84134, 1 => 0.84375, 2 => 0.84614, 3 => 0.84849, 4 => 0.85083, 5 => 0.85314, 6 => 0.85543, 7 => 0.85769, 8 => 0.85993, 9 => 0.86214],
					'1.1' => [0 => 0.86433, 1 => 0.86650, 2 => 0.86864, 3 => 0.87076, 4 => 0.87286, 5 => 0.87493, 6 => 0.87698, 7 => 0.87900, 8 => 0.88100, 9 => 0.88298],
					'1.2' => [0 => 0.88493, 1 => 0.88686, 2 => 0.88877, 3 => 0.89065, 4 => 0.89251, 5 => 0.89435, 6 => 0.89617, 7 => 0.89796, 8 => 0.89973, 9 => 0.90147],
					'1.3' => [0 => 0.90320, 1 => 0.90490, 2 => 0.90658, 3 => 0.90824, 4 => 0.90988, 5 => 0.91149, 6 => 0.91308, 7 => 0.91466, 8 => 0.91621, 9 => 0.91774],
					'1.4' => [0 => 0.91924, 1 => 0.92073, 2 => 0.92220, 3 => 0.92364, 4 => 0.92507, 5 => 0.92647, 6 => 0.92785, 7 => 0.92922, 8 => 0.93056, 9 => 0.93189],
					'1.5' => [0 => 0.93319, 1 => 0.93448, 2 => 0.93574, 3 => 0.93699, 4 => 0.93822, 5 => 0.93943, 6 => 0.94062, 7 => 0.94179, 8 => 0.94295, 9 => 0.94408],
					'1.6' => [0 => 0.94520, 1 => 0.94630, 2 => 0.94738, 3 => 0.94845, 4 => 0.94950, 5 => 0.95053, 6 => 0.95154, 7 => 0.95254, 8 => 0.95352, 9 => 0.95449],
					'1.7' => [0 => 0.95543, 1 => 0.95637, 2 => 0.95728, 3 => 0.95818, 4 => 0.95907, 5 => 0.95994, 6 => 0.96080, 7 => 0.96164, 8 => 0.96246, 9 => 0.96327],
					'1.8' => [0 => 0.96407, 1 => 0.96485, 2 => 0.96562, 3 => 0.96638, 4 => 0.96712, 5 => 0.96784, 6 => 0.96856, 7 => 0.96926, 8 => 0.96995, 9 => 0.97062],
					'1.9' => [0 => 0.97128, 1 => 0.97193, 2 => 0.97257, 3 => 0.97320, 4 => 0.97381, 5 => 0.97441, 6 => 0.97500, 7 => 0.97558, 8 => 0.97615, 9 => 0.97670],
					'2.0' => [0 => 0.97725, 1 => 0.97778, 2 => 0.97831, 3 => 0.97882, 4 => 0.97932, 5 => 0.97982, 6 => 0.98030, 7 => 0.98077, 8 => 0.98124, 9 => 0.98169],
					'2.1' => [0 => 0.98214, 1 => 0.98257, 2 => 0.98300, 3 => 0.98341, 4 => 0.98382, 5 => 0.98422, 6 => 0.98461, 7 => 0.98500, 8 => 0.98537, 9 => 0.98574],
					'2.2' => [0 => 0.98610, 1 => 0.98645, 2 => 0.98679, 3 => 0.98713, 4 => 0.98745, 5 => 0.98778, 6 => 0.98809, 7 => 0.98840, 8 => 0.98870, 9 => 0.98899],
					'2.3' => [0 => 0.98928, 1 => 0.98956, 2 => 0.98983, 3 => 0.99010, 4 => 0.99036, 5 => 0.99061, 6 => 0.99086, 7 => 0.99111, 8 => 0.99134, 9 => 0.99158],
					'2.4' => [0 => 0.99180, 1 => 0.99202, 2 => 0.99224, 3 => 0.99245, 4 => 0.99266, 5 => 0.99286, 6 => 0.99305, 7 => 0.99324, 8 => 0.99343, 9 => 0.99361],
					'2.5' => [0 => 0.99379, 1 => 0.99396, 2 => 0.99413, 3 => 0.99430, 4 => 0.99446, 5 => 0.99461, 6 => 0.99477, 7 => 0.99492, 8 => 0.99506, 9 => 0.99520],
					'2.6' => [0 => 0.99534, 1 => 0.99547, 2 => 0.99560, 3 => 0.99573, 4 => 0.99585, 5 => 0.99598, 6 => 0.99609, 7 => 0.99621, 8 => 0.99632, 9 => 0.99643],
					'2.7' => [0 => 0.99653, 1 => 0.99664, 2 => 0.99674, 3 => 0.99683, 4 => 0.99693, 5 => 0.99702, 6 => 0.99711, 7 => 0.99720, 8 => 0.99728, 9 => 0.99736],
					'2.8' => [0 => 0.99744, 1 => 0.99752, 2 => 0.99760, 3 => 0.99767, 4 => 0.99774, 5 => 0.99781, 6 => 0.99788, 7 => 0.99795, 8 => 0.99801, 9 => 0.99807],
					'2.9' => [0 => 0.99813, 1 => 0.99819, 2 => 0.99825, 3 => 0.99831, 4 => 0.99836, 5 => 0.99841, 6 => 0.99846, 7 => 0.99851, 8 => 0.99856, 9 => 0.99861],
					'3.0' => [0 => 0.99865, 1 => 0.99869, 2 => 0.99874, 3 => 0.99878, 4 => 0.99882, 5 => 0.99886, 6 => 0.99889, 7 => 0.99893, 8 => 0.99896, 9 => 0.99900],
					'3.1' => [0 => 0.99903, 1 => 0.99906, 2 => 0.99910, 3 => 0.99913, 4 => 0.99916, 5 => 0.99918, 6 => 0.99921, 7 => 0.99924, 8 => 0.99926, 9 => 0.99929],
					'3.2' => [0 => 0.99931, 1 => 0.99934, 2 => 0.99936, 3 => 0.99938, 4 => 0.99940, 5 => 0.99942, 6 => 0.99944, 7 => 0.99946, 8 => 0.99948, 9 => 0.99950],
					'3.3' => [0 => 0.99952, 1 => 0.99953, 2 => 0.99955, 3 => 0.99957, 4 => 0.99958, 5 => 0.99960, 6 => 0.99961, 7 => 0.99962, 8 => 0.99964, 9 => 0.99965],
					'3.4' => [0 => 0.99966, 1 => 0.99968, 2 => 0.99969, 3 => 0.99970, 4 => 0.99971, 5 => 0.99972, 6 => 0.99973, 7 => 0.99974, 8 => 0.99975, 9 => 0.99976],
					'3.5' => [0 => 0.99977, 1 => 0.99978, 2 => 0.99978, 3 => 0.99979, 4 => 0.99980, 5 => 0.99981, 6 => 0.99981, 7 => 0.99982, 8 => 0.99983, 9 => 0.99983],
					'3.6' => [0 => 0.99984, 1 => 0.99985, 2 => 0.99985, 3 => 0.99986, 4 => 0.99986, 5 => 0.99987, 6 => 0.99987, 7 => 0.99988, 8 => 0.99988, 9 => 0.99989],
					'3.7' => [0 => 0.99989, 1 => 0.99990, 2 => 0.99990, 3 => 0.99990, 4 => 0.99991, 5 => 0.99991, 6 => 0.99992, 7 => 0.99992, 8 => 0.99992, 9 => 0.99992],
					'3.8' => [0 => 0.99993, 1 => 0.99993, 2 => 0.99993, 3 => 0.99994, 4 => 0.99994, 5 => 0.99994, 6 => 0.99994, 7 => 0.99995, 8 => 0.99995, 9 => 0.99995],
					'3.9' => [0 => 0.99995, 1 => 0.99995, 2 => 0.99996, 3 => 0.99996, 4 => 0.99996, 5 => 0.99996, 6 => 0.99996, 7 => 0.99996, 8 => 0.99997, 9 => 0.99997],
					'4.0' => [0 => 0.99997, 1 => 0.99997, 2 => 0.99997, 3 => 0.99997, 4 => 0.99997, 5 => 0.99997, 6 => 0.99998, 7 => 0.99998, 8 => 0.99998, 9 => 0.99998],
				];
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
				$z1 = (1 + ($ci / 100)) / 2;
				$zz = explode('.', $z1);
				$zz = strlen($zz[1]);
				$z = '';
				$old = 0.5;
				foreach ($z_table as $keys => $values) {
					foreach ($values as $key => $value) {
						if ($key > 0) {
							$old = $values[$key - 1];
						}
						if ($z1 === $value) {
							$k = $keys;
							$k1 = $key / 100;
							$z = $k + $k1;
							break;
						} elseif ($key == 0 && $value > $z1) {
							$k = $keys;
							$k1 = $key / 100;
							$z = $k + $k1;
							break;
						} elseif ($value > $z1) {
							$val = round($old, $zz);
							$k = $keys;
							$k1 = ($key - 1) / 100;
							$z = $k + $k1;
							break;
						}
					}
					if (is_numeric($z)) {
						break;
					}
				}
				$z_2 = pow($z, 2);
				$mle = $success / $trials;
				$laplace = ($success + 1) / ($trials + 2);
				$jeffrey = ($success + 0.5) / ($trials + 1);
				$wilson = ($success + ($z_2 / 2)) / ($trials + $z_2);
				if ($mle <= 0.5) {
					$pe = $wilson;
				} elseif ($mle > 0.5 && $mle < 0.9) {
					$pe = $mle;
				} elseif ($mle >= 0.9 && $mle < 1.0) {
					if ($jeffrey < $laplace) {
						$pe = $jeffrey;
					} else {
						$pe = $laplace;
					}
				} elseif ($mle === 1.0) {
					$pe = $laplace;
				}
				if ($ci > 0) {
					$z = $z * (-1);
				}
				$this->param["pe"] = sigFig($pe, 4);
				$this->param["z"] = sigFig($z, 4);
				$this->param["mle"] = sigFig($mle, 4);
				$this->param["laplace"] = sigFig($laplace, 4);
				$this->param["jeffrey"] = sigFig($jeffrey, 4);
				$this->param["wilson"] = sigFig($wilson, 4);
				$this->param["RESULT"] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "The number of trials must be greater than the number of successes";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}

	public function relative($request)
	{
		$data = $request->data;
		$freq = $request->freq;
		$k = $request->k;
		$st_val = $request->st_val;
		if (!empty($data)) {
			$check = true;
			if (!empty($data)) {
				$check = true;
			} else {
				$check = false;
			}
			$data = str_replace([" ", ",", "\n", "\r"], ",", $data);
			$data = preg_replace("/[a-zA-Z]/", "", $data);
			while (strpos($data, ",,") !== false) {
				$data = str_replace(",,", ",", $data);
			}
			$set = array_map('trim', array_filter(explode(',', $data), function ($value) {
				return $value !== '';
			}));

			foreach ($set as $value) {
				if (!is_numeric($value)) {
					$check = false;
				}
				if ($freq === 'grp' && $value < $st_val) {
					$this->param['error'] = "Number can't be less than the starting value of grouped data!";
					return $this->param;
				}
			}
			if ($freq === 'grp' && empty($k)) {
				$check = false;
			}
			if ($check === true) {
				$count = array_count_values($set);
				$n = count($set);
				if ($freq === 'ind') {
					$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>Element</th><th class='border p-2 text-center text-blue'>Frequency</th><th class='border p-2 text-center text-blue'>Relative Frequency</th><th class='border p-2 text-center text-blue'>Cumulative Relative Frequency</th></tr></thead><tbody>";
					// <th class='border p-2 text-center text-blue'>Cumulative Frequency</th>
					$cf = 0;
					$crf = 0;
					$rf_values = []; // Array to store all rf values
					foreach ($count as $key => $f) {
						$cf += $f;
						// <td class='border p-2 text-center'>$cf</td>
						$rf = $f / $n;
						$crf += $rf;
						$rf_values[] = $rf; // Store rf value in array
						$table .= "<tr class='bg-white'><td class='border p-2 text-center'>$key</td><td class='border p-2 text-center'>$f</td><td class='border p-2 text-center'>" . round($rf, 4) . "</td><td class='border p-2 text-center'>" . round($crf, 4) . "</td></tr>";
					}
					$table .= "</tbody></table>";
				}

				$ds = '';
				foreach ($set as $key => $value) {
					if ($n === $key + 1) {
						$ds .= $value;
					} else {
						$ds .= $value . ', ';
					}
				}
				sort($set);
				$sum = array_sum($set);
				$average = round($sum / $n, 4);
				$min = min($set);
				$max = max($set);
				$range = $max - $min;
				$mean = $sum / $n;
				if (($n % 2) != 0) {
					$center = round($n / 2);
					$median = $set[$center--];
				} else {
					$center = round($n / 2);
					$next = $center - 1;
					$median = ($set[$center] + $set[$next]) / 2;
				}
				$m_max = max($count);
				$mode = array();
				foreach ($count as $key => $value) {
					if ($value === $m_max) {
						$mode[] = $key;
					}
				}
				$ss = 0;
				$hm_sum = 0;
				$asum = 0;
				foreach ($set as $value) {
					$ss = $ss + pow($value - $mean, 2);
					$hm_sum += 1 / $value;
					$asum += abs($value);
				}
				$hm = $n / $hm_sum;
				$s_d = (1 / ($n)) * $ss;
				$s_d1 = (1 / ($n - 1)) * $ss;
				$s_d = sqrt($s_d);
				$s_d1 = sqrt($s_d1);
				$variance = pow($s_d, 2);
				$c_v = $s_d1 / $mean;
				$gm = pow(array_product($set), (1 / $n));
				$snr = $mean / $s_d1;
				$diff = array();
				for ($i = 0; $i < $n; $i++) {
					$diff[] = abs($set[$i] - $mean);
				}
				$sum1 = array_sum($diff);
				$ad = $sum1;
				$mad = $sum1 / $n;
				function Quartile($Array, $Quartile)
				{
					$pos = (count($Array) + 1) * $Quartile;
					// if the position is a whole number
					// return that number as the quarile placing
					if (fmod($pos, 1) === 0) {
						return $Array[$pos];
					} else {
						// get the decimal i.e. 5.25 = .25
						$fraction = $pos - floor($pos);
						// get the values in the array before and after position
						$lower_num = $Array[floor($pos) - 1];
						$upper_num = $Array[ceil($pos) - 1];
						// get the difference between the two
						$difference = $upper_num - $lower_num;
						// the quartile value is then the difference multipled by the decimal
						// add to the lower number
						return $lower_num + ($difference * $fraction);
					}
				}
				$q1 = Quartile($set, 0.25);
				$q2 = Quartile($set, 0.5);
				$q3 = Quartile($set, 0.75);
				$iqr = $q3 - $q1;
				$qd = ($q3 - $q1) / 2;
				$cqd = ($q3 - $q1) / ($q3 + $q1);
				$uf = $q1 - (1.5 * $iqr);
				$lf = $q3 + (1.5 * $iqr);
				$z = '';
				$sds = '';
				foreach ($set as $key => $value) {
					if ($n === $key + 1) {
						$sds .= $value;
						$z .= round((($value - $mean) / $s_d), 4);
					} else {
						$sds .= $value . ', ';
						$z .= round((($value - $mean) / $s_d), 4) . ', ';
					}
				}
				if ($freq === 'grp') {
					$ci = round(((($max - $min) / $k) + 1));
					$group = array();
					$group_count = array();
					for ($i = 0; $i < $k; $i++) {
						if ($i === 0) {
							$x = $set[$i];
						}
						$next = $x + $ci;
						if ($next > 10000000) {
							$this->param['error'] = "A number can't be Greater Than 10000000";
							return $this->param;
						}
						$rng = range($x, $next);
						$group[] = $x . " to " . $next;
						$x = $next + 1;
						$j = 0;
						foreach ($set as $key => $value) {
							if (in_array(trim($value), $rng)) {
								$j++;
							}
						}
						$group_count[] = $j;
					}
					$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>Group</th><th class='border p-2 text-center text-blue'>Frequency</th><th class='border p-2 text-center text-blue'>Relative Frequency</th><th class='border p-2 text-center text-blue'>Cumulative Relative Frequency</th></tr></thead><tbody>";
					$cf1 = 0;
					$crf1 = 0;
					$rf1_values = [];
					for ($i = 0; $i < $k; $i++) {
						$cf1 += $group_count[$i];
						$rf1 = $group_count[$i] / $n;
						$crf1 += $rf1;
						// <td class='border p-2 text-center'>$cf1</td>
						$rf1_values[] = $rf1;
						$table .= "<tr class='bg-white'><td class='border p-2 text-center'>" . $group[$i] . "</td><td class='border p-2 text-center'>" . $group_count[$i] . "</td><td class='border p-2 text-center'>" . round($rf1, 4) . "</td><td class='border p-2 text-center'>" . round($crf1, 4) . "</td></tr>";
					}
					$table .= "</tbody></table>";

					$this->param["group"] = $group;
					$this->param["group_count"] = $group_count;
				}
				$this->param["table"] = $table;
				$this->param["set"] = $set;
				$this->param["ds"] = $ds;
				$this->param["rf_values"] = $rf_values;
				$this->param["rf1_values"] = $rf1_values;
				$this->param["sds"] = $sds;
				$this->param["n"] = $n;
				$this->param["count"] = $count;
				$this->param["mean"] = $mean;
				$this->param["median"] = $median;
				$this->param["mode"] = $mode;
				$this->param["min"] = $min;
				$this->param["max"] = $max;
				$this->param["range"] = $range;
				$this->param["sum"] = $sum;
				$this->param["ss"] = $ss;
				$this->param["asum"] = $asum;
				$this->param["s_d"] = $s_d;
				$this->param["s_d1"] = $s_d1;
				$this->param["c_v"] = $c_v;
				$this->param["snr"] = $snr;
				$this->param["variance"] = $variance;
				$this->param["gm"] = $gm;
				$this->param["hm"] = $hm;
				$this->param["ad"] = $ad;
				$this->param["mad"] = $mad;
				$this->param["q1"] = $q1;
				$this->param["q2"] = $q2;
				$this->param["q3"] = $q3;
				$this->param["iqr"] = $iqr;
				$this->param["qd"] = $qd;
				$this->param["cqd"] = $cqd;
				$this->param["uf"] = $uf;
				$this->param["lf"] = $lf;
				$this->param["z"] = $z;
				$this->param["RESULT"] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please check your input.";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}
	public function correlation($request)
	{
		$x = $request->x;
		$method = $request->method;
		$y = $request->y;
		$check = true;
		if (empty($x) || empty($y)) {
			$check = false;
		}
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		$y = str_replace([" ", ",", "\n", "\r"], ",", $y);
		while (strpos($y, ",,") !== false) {
			$y = str_replace(",,", ",", $y);
		}
		$numbersy = array_map('trim', array_filter(explode(',', $y), function ($value) {
			return $value !== '';
		}));
		foreach ($numbersy as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
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
			if (count($numbers) == count($numbersy)) {
				if ($method == 1) {
					$countx = count($numbers);
					$county = count($numbersy);
					$meanx = array_sum($numbers) / $countx;
					$meany = array_sum($numbersy) / $county;
					$arr1 = [];
					$arr2 = [];
					$arr3 = [];
					$arr4 = [];
					$arr5 = [];
					for ($i = 0; $i < $countx; $i++) {
						$arr1[] = $numbers[$i] - $meanx;
						$arr2[] = pow($numbers[$i] - $meanx, 2);
						$arr3[] = $numbersy[$i] - $meany;
						$arr4[] = pow($numbersy[$i] - $meany, 2);
						$arr5[] = ($numbers[$i] - $meanx) * ($numbersy[$i] - $meany);
					}
					$sumx = array_sum($numbers);
					$sumy = array_sum($numbersy);
					$mx = sqrt(array_sum($arr2) / $countx);
					$my = sqrt(array_sum($arr4) / $countx);
					$final = (1 / $countx) * (array_sum($arr5) / ($mx * $my));
				} else {
					$rank1 = [];
					$rank2 = [];
					foreach ($numbers as $key => $value) {
						$count = count($numbers);
						foreach ($numbers as $key1 => $value1) {
							if ($value != $value1) {
								if ($value1 >= $value) {
									$count--;
								}
							}
						}
						$rank1[] = $count;
					}
					foreach ($numbersy as $key => $value) {
						$count = count($numbersy);
						foreach ($numbersy as $key1 => $value1) {
							if ($value != $value1) {
								if ($value1 >= $value) {
									$count--;
								}
							}
						}
						$rank2[] = $count;
					}
					$double = [];
					$div = [];
					$arrc = array_count_values($rank2);
					foreach ($arrc as $key => $value) {
						if ($value > 1) {
							for ($i = 0; $i < $value; $i++) {
								$new = $key - $i;
								$div[] = $new;
							}
							$double[$key] = array_sum($div) / $value;
						}
					}
					if (count($double) != 0) {
						$nrank2 = [];
						foreach ($double as $key1 => $value1) {
							foreach ($rank2 as $key => $value) {
								$nval = $value;
								if ($key1 == $value) {
									$nval = $value1;
								}
								$nrank2[$key] = $nval;
							}
						}
					}

					$double1 = [];
					$div1 = [];
					$arrc = array_count_values($rank1);
					foreach ($arrc as $key => $value) {
						if ($value > 1) {
							for ($i = 0; $i < $value; $i++) {
								$new = $key - $i;
								$div1[] = $new;
							}
							$double1[$key] = array_sum($div1) / $value;
						}
					}
					if (count($double1) != 0) {
						$nrank1 = [];
						foreach ($double1 as $key1 => $value1) {
							foreach ($rank1 as $key => $value) {
								$nval = $value;
								if ($key1 == $value) {
									$nval = $value1;
								}
								$nrank1[$key] = $nval;
							}
						}
					}
					$input1 = $rank1;
					$input2 = $rank2;
					if (isset($nrank1)) {
						$input1 = $nrank1;
					}
					if (isset($nrank2)) {
						$input2 = $nrank2;
					}
					$numbers = $input1;
					$numbersy = $input2;
					$countx = count($numbers);
					$county = count($numbersy);
					$meanx = array_sum($numbers) / $countx;
					$meany = array_sum($numbersy) / $county;
					$arr1 = [];
					$arr2 = [];
					$arr3 = [];
					$arr4 = [];
					$arr5 = [];
					for ($i = 0; $i < $countx; $i++) {
						$arr1[] = $numbers[$i] - $meanx;
						$arr2[] = pow($numbers[$i] - $meanx, 2);
						$arr3[] = $numbersy[$i] - $meany;
						$arr4[] = pow($numbersy[$i] - $meany, 2);
						$arr5[] = ($numbers[$i] - $meanx) * ($numbersy[$i] - $meany);
					}
					$sumx = array_sum($numbers);
					$sumy = array_sum($numbersy);
					$mx = sqrt(array_sum($arr2) / $countx);
					$my = sqrt(array_sum($arr4) / $countx);
					$final = (1 / $countx) * (array_sum($arr5) / ($mx * $my));
				}
				$this->param['numbers'] = $numbers;
				$this->param['numbersy'] = $numbersy;
				$this->param['method'] = $method;
				$this->param['meanx'] = $meanx;
				$this->param['meany'] = $meany;
				$this->param['countx'] = $countx;
				$this->param['arr1'] = $arr1;
				$this->param['arr2'] = $arr2;
				$this->param['arr3'] = $arr3;
				$this->param['arr4'] = $arr4;
				$this->param['arr5'] = $arr5;
				$this->param['final'] = $final;
				$this->param["x"] = $x;
				$this->param["y"] = $y;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Enter same number of scores for X and Y";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}

	// poisson-distribution-calculator
	public function poisson($request)
	{
		
		$x = $request->x;
		$mean = $request->mean;
		$con = $request->con;
		if ($x < 0 || $x > 440) {
			$this->param['error'] = "This calculator is work with 0 to 440 for variable (x)";
			return $this->param;
		}
		if (is_numeric($x) && is_numeric($mean) && is_numeric($con)) {
			$chart = '';
			$sum = '';
			if ($con === '1') {
				$fact = gmp_fact($x);
				$fact = gmp_strval($fact);
				$expo = round(exp(-1 * ($mean)), 4);
				$power = pow($mean, $x);
				$sumofex = $expo * $power;
				$ans = (exp(-1 * ($mean)) * pow($mean, $x)) / $fact;
				$this->param['fact'] = $fact;
			} elseif ($con === '2' || $con === '5') {
				$ans = 0;
				$sum = '';
				$this->param = [];

				for ($i = 0; $i < $x; $i++) {
					$fact = gmp_fact($i);
					$fact = gmp_strval($fact);
					if ($i == 0) {
						$this->param['first'] = (exp(-1 * ($mean)) * pow($mean, $i)) / $fact;
					}
					if ($i != ($x - 1)) {
						$sum .= (exp(-1 * ($mean)) * pow($mean, $i)) / $fact . ' + <br>';
					} else {
						$sum .= (exp(-1 * ($mean)) * pow($mean, $i)) / $fact;
					}
					$ans += (exp(-1 * ($mean)) * pow($mean, $i)) / $fact;
				}

				$this->param['ans'] = $ans;
				$this->param['sum'] = $sum;
				$this->param['details'] = [];
				if ($con == '2') {
					for ($currentX = 0; $currentX < $x; $currentX++) {
						$fact = gmp_fact($currentX);
						$fact = gmp_strval($fact);
						$expo = round(exp(-1 * ($mean)), 4);
						$power = pow($mean, $currentX);
						$sumofex = $expo * $power;

						$this->param['details'][$currentX] = [
							'fact' => $fact,
							'sumofex' => $sumofex,
							'power' => $power,
							'expo' => $expo,
							'value' => (exp(-1 * ($mean)) * pow($mean, $currentX)) / $fact,
						];
					}
				} elseif ($con == '5') {
					// for ($currentX = $x; $currentX >= 0; $currentX--) {
					for ($currentX = 0; $currentX <= $x - 1; $currentX++) {
						$fact = gmp_fact($currentX);
						$fact = gmp_strval($fact);
						$expo = round(exp(-1 * ($mean)), 4);
						$power = pow($mean, $currentX);
						$sumofex = $expo * $power;

						$this->param['details'][$currentX] = [
							'fact' => $fact,
							'sumofex' => $sumofex,
							'power' => $power,
							'expo' => $expo,
							'value' => (exp(-1 * ($mean)) * pow($mean, $currentX)) / $fact,
						];
					}
				}
				// echo '<pre>';
				// 	print_r($this->param['details']);
				// echo '</pre>';
			} elseif ($con === '3' || $con === '4') {
				$ans = 0;
				$sum = '';
				$this->param = [];

				// Loop for <= $x condition
				for ($i = 0; $i <= $x; $i++) {
					$fact = gmp_fact($i);
					$fact = gmp_strval($fact);
					if ($i == 0) {
						$this->param['first'] = (exp(-1 * ($mean)) * pow($mean, $i)) / $fact;
					}
					if ($i != $x) {
						$sum .= (exp(-1 * ($mean)) * pow($mean, $i)) / $fact . ' + <br>';
					} else {
						$sum .= (exp(-1 * ($mean)) * pow($mean, $i)) / $fact;
					}
					$ans += (exp(-1 * ($mean)) * pow($mean, $i)) / $fact;
				}

				$this->param['ans'] = $ans;
				$this->param['sum'] = $sum;
				$this->param['details'] = [];

				// Condition for $con == '3'
				if ($con == '3') {
					for ($currentX = 0; $currentX <= $x; $currentX++) {
						$fact = gmp_fact($currentX);
						$fact = gmp_strval($fact);
						$expo = round(exp(-1 * ($mean)), 4);
						$power = pow($mean, $currentX);
						$sumofex = $expo * $power;
						$this->param['details'][$currentX] = [
							'fact' => $fact,
							'sumofex' => $sumofex,
							'power' => $power,
							'expo' => $expo,
							'value' => (exp(-1 * ($mean)) * pow($mean, $currentX)) / $fact,
						];
					}
				} else {
					// Condition for $con == '4'
					for ($currentX = 0; $currentX <= $x; $currentX++) {
						$fact = gmp_fact($currentX);
						$fact = gmp_strval($fact);
						$expo = round(exp(-1 * ($mean)), 4);
						$power = pow($mean, $currentX);
						$sumofex = $expo * $power;
						$this->param['details'][$currentX] = [
							'fact' => $fact,
							'sumofex' => $sumofex,
							'power' => $power,
							'expo' => $expo,
							'value' => (exp(-1 * ($mean)) * pow($mean, $currentX)) / $fact,
						];
					}
				}

				$this->param['fact'] = $fact;
				$this->param['sum'] = $sum;
				// Passing the param array to the view
				$details = $this->param['details'];
			}
			for ($i = 0; $i <= 15; $i++) {
				$fact = gmp_fact($i);
				$fact = gmp_strval($fact);
				$chart .= (exp(-1 * ($mean)) * pow($mean, $i)) / $fact . ',';
			}

			$this->param['sumofex'] = $sumofex;
			$this->param['power'] = $power;
			$this->param['expo'] = $expo;
			$this->param['ans'] = $ans;
			$this->param['chart'] = $chart;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}

	public function invnorm($request)
	{
		$sd = $request->sd;
		$mean = $request->mean;
		$p = $request->p;
		if ($p < 0 || $p > 1) {
			$this->param['error'] = "The probability must be between 0 and 1";
			return $this->param;
		}
		if (is_numeric($sd) && is_numeric($mean) && is_numeric($p)) {
			function zinv($p)
			{
				$a1 = -39.6968302866538;
				$a2 = 220.946098424521;
				$a3 = -275.928510446969;
				$a4 = 138.357751867269;
				$a5 = -30.6647980661472;
				$a6 = 2.50662827745924;
				$b1 = -54.4760987982241;
				$b2 = 161.585836858041;
				$b3 = -155.698979859887;
				$b4 = 66.8013118877197;
				$b5 = -13.2806815528857;
				$c1 = -7.78489400243029E-03;
				$c2 = -0.322396458041136;
				$c3 = -2.40075827716184;
				$c4 = -2.54973253934373;
				$c5 = 4.37466414146497;
				$c6 = 2.93816398269878;
				$d1 = 7.78469570904146E-03;
				$d2 = 0.32246712907004;
				$d3 = 2.445134137143;
				$d4 = 3.75440866190742;
				$p_low = 0.02425;
				$p_high = 1 - $p_low;

				if (($p < 0) || ($p > 1)) {
					$err = "p out of range.";
					$retVal = 0;
				} elseif ($p < $p_low) {
					$q = sqrt(-2 * log($p));
					$retVal = ((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) / (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
				} elseif ($p <= $p_high) {
					$q = $p - 0.5;
					$r = $q * $q;
					$retVal = ((((($a1 * $r + $a2) * $r + $a3) * $r + $a4) * $r + $a5) * $r + $a6) * $q / ((((($b1 * $r + $b2) * $r + $b3) * $r + $b4) * $r + $b5) * $r + 1);
				} else {
					$q = sqrt(-2 * log(1 - $p));
					$retVal = - ((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) / (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
				}

				return $retVal;
			}
			function zProb($z)
			{
				if ($z < -7) {
					return 0.0;
				}
				if ($z > 7) {
					return 1.0;
				}


				if ($z < 0.0) {
					$flag = true;
				} else {
					$flag = false;
				}

				$z = abs($z);
				$b = 0.0;
				$s = sqrt(2) / 3 * $z;
				$HH = .5;
				for ($i = 0; $i < 12; $i++) {
					$a = exp(((-1) * $HH) * $HH / 9) * sin($HH * $s) / $HH;
					$b = $b + $a;
					$HH = $HH + 1.0;
				}
				$p = .5 - $b / pi();
				if (!$flag) {
					$p = 1.0 - $p;
				}
				return $p;
			}
			$x1 = zinv($p);
			$x1 = (-1 * $mean) + $sd * $x1;
			$ul = $mean + 3.1 * $sd;
			$ll = -1 * $x1;
			$above = round(1000000 * $ll) / 1000000;
			$x1 = zinv($p);
			$x1 = $mean + $sd * $x1;
			$ul = $x1;
			$blow = round(1000000 * $ul) / 1000000;


			$p2 = $p / 2;
			$x1 = zinv(0.5 - $p2);
			$ll = $x1;
			$ul = -1 * $x1;
			$ll = round(($mean + $sd * $ll) * 1000000) / 1000000;
			$ul = round(($mean + $sd * $ul) * 1000000) / 1000000;


			$p2 = $p / 2;
			$x1 = zinv($p2);
			$ll1 = $x1;
			$ul1 = -1 * $x1;
			$ll1 = round(($mean + $sd * $ll1) * 1000000) / 1000000;
			$ul1 = round(($mean + $sd * $ul1) * 1000000) / 1000000;

			$this->param['above'] = $above;
			$this->param['blow'] = $blow;
			$this->param['ll'] = $ll;
			$this->param['ul'] = $ul;
			$this->param['ll1'] = $ll1;
			$this->param['ul1'] = $ul1;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}
	public function p($request)
	{
		$tail = $request->tail;
		$with = $request->with;
		$score = $request->score;
		$deg = $request->deg;
		$deg2 = $request->deg2;
		$level = $request->level;
		$degree_freedom = $request->degree_freedom;
		// z-scope
		function zpval($score, $tail)
		{
			if ($tail === '0') {
				$pval = 2 * zcdf(abs($score) * (-1));
			} else if ($tail === '-1') {
				$pval = zcdf($score);
			} else if ($tail === '2') {
				$pval = 1 - zcdf($score);
			}
			return $pval;
		}
		function zcdf($z)
		{
			$y = '';
			$x = '';
			$w = '';

			if ($z === 0.0) {
				$x = 0.0;
			} else {
				$y = 0.5 * abs($z);
				if ($y > (6 * 0.5)) {
					$x = 1.0;
				} else if ($y < 1.0) {
					$w = $y * $y;
					$x = ((((((((0.000124818987 * $w
						- 0.001075204047) * $w + 0.005198775019) * $w
						- 0.019198292004) * $w + 0.059054035642) * $w
						- 0.151968751364) * $w + 0.319152932694) * $w
						- 0.531923007300) * $w + 0.797884560593) * $y * 2.0;
				} else {
					$y -= 2.0;
					$x = (((((((((((((-0.000045255659 * $y
						+ 0.000152529290) * $y - 0.000019538132) * $y
						- 0.000676904986) * $y + 0.001390604284) * $y
						- 0.000794620820) * $y - 0.002034254874) * $y
						+ 0.006549791214) * $y - 0.010557625006) * $y
						+ 0.011630447319) * $y - 0.009279453341) * $y
						+ 0.005353579108) * $y - 0.002141268741) * $y
						+ 0.000535310849) * $y + 0.999936657524;
				}
			}
			return $z > 0.0 ? ((($x + 1.0) * 0.5)) : (((1.0 - $x) * 0.5));
		}
		function tpval($t, $df, $alt)
		{
			if ($alt === '0') {
				$pval = 2 * tcdf(abs($t) * (-1), $df);
			} else if ($alt === '-1') {
				$pval = tcdf($t, $df);
			} else if ($alt === '2') {
				$pval = 1 - tcdf($t, $df);
			}
			return $pval;
		}
		function tcdf($x, $dof)
		{
			$dof2 = $dof / 2;
			return ibeta(($x + sqrt($x * $x + $dof)) / (2 * sqrt($x * $x + $dof)), $dof2, $dof2);
		}
		function ibeta($x, $a, $b)
		{
			$bt = ($x === 0 || $x === 1) ?  0 :
				exp(gammaln($a + $b) - gammaln($a) -
					gammaln($b) + $a * log($x) + $b *
					log(1 - $x));
			if ($x < 0 || $x > 1)
				return false;
			if ($x < ($a + 1) / ($a + $b + 2))
				return $bt * betacf($x, $a, $b) / $a;

			return 1 - $bt * betacf(1 - $x, $b, $a) / $b;
		}
		function gammaln($x)
		{
			$cof = [
				76.18009172947146,
				-86.50532032941677,
				24.01409824083091,
				-1.231739572450155,
				0.1208650973866179e-2,
				-0.5395239384953e-5
			];
			$ser = 1.000000000190015;
			$xx = '';
			$y = '';
			$tmp = '';
			$tmp = ($y = $xx = $x) + 5.5;
			$tmp -= ($xx + 0.5) * log($tmp);
			for ($j = 0; $j < 6; $j++)
				$ser += $cof[$j] / ++$y;
			return log(2.5066282746310005 * $ser / $xx) - $tmp;
		}
		function betacf($x, $a, $b)
		{
			$fpmin = 1e-30;
			$m = 1;
			$qab = $a + $b;
			$qap = $a + 1;
			$qam = $a - 1;
			$c = 1;
			$d = 1 - $qab * $x / $qap;
			$m2 = '';
			$aa = '';
			$del = '';
			$h = '';

			// These q's will be used in factors that occur in the coefficients
			if (abs($d) < $fpmin)
				$d = $fpmin;
			$d = 1 / $d;
			$h = $d;

			for ($m = 1; $m <= 100; $m++) {
				$m2 = 2 * $m;
				$aa = $m * ($b - $m) * $x / (($qam + $m2) * ($a + $m2));
				// One step (the even one) of the recurrence
				$d = 1 + $aa * $d;
				if (abs($d) < $fpmin)
					$d = $fpmin;
				$c = 1 + $aa / $c;
				if (abs($c) < $fpmin)
					$c = $fpmin;
				$d = 1 / $d;
				$h *= $d * $c;
				$aa = - ($a + $m) * ($qab + $m) * $x / (($a + $m2) * ($qap + $m2));
				// Next step of the recurrence (the odd one)
				$d = 1 + $aa * $d;
				if (abs($d) < $fpmin)
					$d = $fpmin;
				$c = 1 + $aa / $c;
				if (abs($c) < $fpmin)
					$c = $fpmin;
				$d = 1 / $d;
				$del = $d * $c;
				$h *= $del;
				if (abs($del - 1.0) < 3e-7)
					break;
			}

			return $h;
		}
		function chipval($chi, $df, $alt)
		{
			if ($alt == '0') {
				$x = chicdf($chi, $df);
				if ($x <= 0.5) {
					$pval = 2 * $x;
				} else {
					$pval = 2 * (1 - $x);
				}
			} else if ($alt <= '-1') {
				$pval = chicdf($chi, $df);
			} else if ($alt >= '1') {
				$pval = 1 - chicdf($chi, $df);
			}
			return $pval;
		}
		function chicdf($x, $dof)
		{
			if ($x < 0)
				return 0;
			return lowRegGamma($dof / 2, $x / 2);
		}
		function lowRegGamma($a, $x)
		{
			$aln = gammaln($a);
			$ap = $a;
			$sum = 1 / $a;
			$del = $sum;
			$b = $x + 1 - $a;
			$c = 1 / 1.0e-30;
			$d = 1 / $b;
			$h = $d;
			$i = 1;
			// calculate maximum number of itterations required for a
			$ITMAX = -~(log(($a >= 1) ? $a : 1 / $a) * 8.5 + $a * 0.4 + 17);
			$an = '';

			if ($x < 0 || $a <= 0) {
				return 0;
			} else if ($x < $a + 1) {
				for ($i = 1; $i <= $ITMAX; $i++) {
					$sum += $del *= $x / ++$ap;
				}
				return ($sum * exp($x * (-1) + $a * log($x) - ($aln)));
			}
			for (; $i <= $ITMAX; $i++) {
				$an = $i * (-1) * ($i - $a);
				$b += 2;
				$d = $an * $d + $b;
				$c = $b + $an / $c;
				$d = 1 / $d;
				$h *= $d * $c;
			}

			return (1 - $h * exp($x * (-1) + $a * log($x) - ($aln)));
		}

		function Fpval($F, $df1, $df2, $alt)
		{

			if ($alt == '0') {
				$x = Fcdf($F, $df1, $df2);
				if ($x <= 0.5) {
					$pval = 2 * $x;
				} else {
					$pval = 2 * (1 - $x);
				}
			} else if ($alt <= '-1') {
				$pval = Fcdf($F, $df1, $df2);
			} else if ($alt <= '1') {
				$pval = 1 - Fcdf($F, $df1, $df2);
			}
			return $pval;
		}
		function Fcdf($x, $df1, $df2)
		{
			if ($x < 0)
				return 0;
			return ibeta(($df1 * $x) / ($df1 * $x + $df2), $df1 / 2, $df2 / 2);
		}

		if ($level < 0 || $level > 1) {
			$this->param['error'] = "Significance level must be a number between 0 and 1";
			return $this->param;
		}
		// z-scope
		if ($with === 'z') {
			if (!is_numeric($score) && !is_numeric($level)) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
			$p = zpval($score, $tail);
		} elseif ($with === 't') {
			if (!is_numeric($score) && !is_numeric($deg) && !is_numeric($level)) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
			$p = tpval($score, $deg, $tail);
		} elseif ($with === 'chi') {
			if (!is_numeric($score) && !is_numeric($deg) && !is_numeric($level)) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
			$p = chipval($score, $deg, $deg);
		} elseif ($with === 'f') {
			if (!is_numeric($score) && !is_numeric($deg) && !is_numeric($deg2) && !is_numeric($level)) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
			if ($deg2 < 0) {
				$this->param['error'] = "Your values for degrees of freedom cannot be negative.";
				return $this->param;
			}
			$p = Fpval($score, $deg, $deg2, $level);
		} elseif ($with === 'r') {

			if (!is_numeric($score) && !is_numeric($deg) && !is_numeric($level)) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
			if ($score < -1 || $score > 1 || $deg <= 2) {
				$this->param['error'] = "score must be between -1 and 1 and deg must be greater than 2";
				return $this->param;
			}
			function calculateTStatistic($r, $n)
			{
				return ($r * sqrt($n - 2)) / sqrt(1 - $r * $r);
			}
			function betaIncomplete($x, $a, $b)
			{
				$bt = ($x == 0 || $x == 1) ? 0 :
					exp(gammalns($a + $b) - gammalns($a) - gammalns($b) + $a * log($x) + $b * log(1 - $x));
				if ($x < 0.0 || $x > 1.0) return 0.0;
				if ($x < ($a + 1.0) / ($a + $b + 2.0))
					return $bt * betacfs($x, $a, $b) / $a;
				else
					return 1.0 - $bt * betacfs(1.0 - $x, $b, $a) / $b;
			}
			function gammalns($x)
			{
				$cof = [
					76.18009172947146,
					-86.50532032941677,
					24.01409824083091,
					-1.231739572450155,
					0.1208650973866179e-2,
					-0.5395239384953e-5
				];
				$y = $x;
				$tmp = $x + 5.5;
				$tmp -= ($x + 0.5) * log($tmp);
				$ser = 1.000000000190015;
				for ($j = 0; $j < 6; $j++) $ser += $cof[$j] / ++$y;
				return -$tmp + log(2.5066282746310005 * $ser / $x);
			}
			function betacfs($x, $a, $b)
			{
				$MAXIT = 100;
				$EPS = 3.0e-7;
				$FPMIN = 1.0e-30;
				$qab = $a + $b;
				$qap = $a + 1.0;
				$qam = $a - 1.0;
				$c = 1.0;
				$d = 1.0 - $qab * $x / $qap;
				if (abs($d) < $FPMIN) $d = $FPMIN;
				$d = 1.0 / $d;
				$h = $d;
				for ($m = 1, $m2 = 2; $m <= $MAXIT; $m++, $m2 += 2) {
					$aa = $m * ($b - $m) * $x / (($qam + $m2) * ($a + $m2));
					$d = 1.0 + $aa * $d;
					if (abs($d) < $FPMIN) $d = $FPMIN;
					$c = 1.0 + $aa / $c;
					if (abs($c) < $FPMIN) $c = $FPMIN;
					$d = 1.0 / $d;
					$h *= $d * $c;
					$aa = - ($a + $m) * ($qab + $m) * $x / (($a + $m2) * ($qap + $m2));
					$d = 1.0 + $aa * $d;
					if (abs($d) < $FPMIN) $d = $FPMIN;
					$c = 1.0 + $aa / $c;
					if (abs($c) < $FPMIN) $c = $FPMIN;
					$d = 1.0 / $d;
					$h *= $d * $c;
				}
				return $h;
			}
			function tDistCDFs($t, $df)
			{
				$x = $df / ($df + $t * $t);
				$a = $df / 2.0;
				$b = 0.5;
				$betaIncompleteResult = betaIncomplete($x, $a, $b);
				return 1.0 - 0.5 * $betaIncompleteResult;
			}
			function calculatePValue($t, $df)
			{
				$pValue = 2 * (1 - tDistCDFs($t, $df));
				return $pValue;
			}
			function pValueFromPearson($r, $n)
			{
				$t = calculateTStatistic($r, $n);
				$df = $n - 2;
				return calculatePValue($t, $df);
			}
			$p = pValueFromPearson($score, $deg);
		} elseif ($with === 'q') {


			if (is_numeric($score) && is_numeric($deg) && is_numeric($degree_freedom) && !is_numeric($level)) {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
			if ($deg < 2 || $deg > 30) {
				$this->param['error'] = "Degree of freedom must be between 2 and 30.";
				return $this->param;
			}
			if ($degree_freedom < 3) {
				$this->param['error'] = "Degrees of freedom must be greater than or equal to 3.";
				return $this->param;
			}
			$this->param['score'] = $score;
			$this->param['deg'] = $deg;
			$this->param['degree_freedom'] = $degree_freedom;
			$this->param['level'] = $level;
		}

		if ($p <= $level) {
			$inter = '';
		} else {
			$inter = 'not';
		}

		if (strpos($p, '.') !== false) {
			$p = round($p, 7);
		} else {
			$p = $p;
		}
		$this->param['tail'] = $tail;
		$this->param['inter'] = $inter;
		$this->param['level'] = $level;
		$this->param['p'] = $p;
		$this->param['RESULT'] = 1;
		return $this->param;
	}


	public function linear($request)
	{

		$x = $request->x;
		$y = $request->y;
		$x = $request->x;
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		$y = str_replace([" ", ",", "\n", "\r"], ",", $y);
		while (strpos($y, ",,") !== false) {
			$y = str_replace(",,", ",", $y);
		}
		$estimate = $request->estimate;
		$check = true;
		if (empty($x) || empty($y)) {
			$check = false;
		}
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		foreach ($numbers as $value) {
			$value = trim($value);
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		$numbersy = array_map('trim', array_filter(explode(',', $y), function ($value) {
			return $value !== '';
		}));
		foreach ($numbersy as $value) {
			$value = trim($value);
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		$check_estamate = false;
		if (!empty($estimate)) {
			$check_estamate = true;
			$estimate = explode(',', $estimate);
			foreach ($estimate as $value) {
				$value = trim($value);
				if (!is_numeric($value)) {
					$check_estamate = false;
				}
			}
		}
		if ($check == true) {
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
			if (count($numbers) == count($numbersy)) {
				if (count($numbers) > 100) {
					$this->param['error'] = "This calculator support up to 100 number of values";
					return $this->param;
				}
				$countx = count($numbers);
				$county = count($numbersy);
				$meanx = array_sum($numbers) / $countx;
				$meany = array_sum($numbersy) / $county;
				$arr1 = [];
				$arr2 = [];
				$arr3 = [];
				$arr4 = [];
				$arr5 = [];
				for ($i = 0; $i < $countx; $i++) {
					$arr1[] = round($numbers[$i] - $meanx, 5);
					$arr2[] = round(pow($numbers[$i] - $meanx, 2), 5);
					$arr3[] = round($numbersy[$i] - $meany, 5);
					$arr4[] = round(pow($numbersy[$i] - $meany, 2), 5);
					$arr5[] = round(($numbers[$i] - $meanx) * ($numbersy[$i] - $meany), 5);
				}
				$ssx = array_sum($arr2);
				$sp = array_sum($arr5);
				$b = $sp / $ssx;
				$a = $meany - ($b * $meanx);
				$sumx = array_sum($numbers);
				$sumy = array_sum($numbersy);
				$linex = [];
				$liney = [];
				for ($i = 0; $i <= max($numbers) + 1; $i = $i + 0.1) {
					$linex[] = $i;
					$liney[] = round(($b * $i) + $a, 5);
				}
				if ($check_estamate == true) {
					$this->param['estimate'] = $estimate;
				}
				$this->param['a'] = round($a, 5);
				$this->param['b'] = round($b, 5);
				$this->param['meanx'] = $meanx;
				$this->param['meany'] = $meany;
				$this->param['arr1'] = $arr1;
				$this->param['arr2'] = $arr2;
				$this->param['arr3'] = $arr3;
				$this->param['arr5'] = $arr5;
				$this->param['ssx'] = $ssx;
				$this->param['sp'] = $sp;
				$this->param['numbers'] = $numbers;
				$this->param['numbersy'] = $numbersy;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Enter same number of values for X and Y";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function outlier($request)
	{
		$x = $request->x;
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$check = true;
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		$values = [];
		foreach ($numbers as $key => $value) {
			$value = trim($value);
			if (is_numeric($value)) {
				$values[] = $value;
			} else {
				$check = false;
			}
		}
		if ($check == true) {
			sort($values);
			if (count($values) < 4) {
				$this->param['error'] = "Please! enter 4 or more numbers";
				return $this->param;
			}
			$count = count($values);
			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $values[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($values[$center] + $values[$next]) / 2;
			}
			$a1 = $values[0];
			$a2 = $values[$count - 1];
			function quartil($arr)
			{
				$count = count($arr);
				$middleval = floor(($count - 1) / 2);
				if ($count % 2) {
					$median = $arr[$middleval];
				} else {
					$low = $arr[$middleval];
					$high = $arr[$middleval + 1];
					$median = (($low + $high) / 2);
				}
				return $median;
			}
			$second = quartil($values);

			$tmp = array();
			foreach ($values as $key => $val) {
				if ($val > $second) {
					$tmp['third'][] = $val;
				} else if ($val < $second) {
					$tmp['first'][] = $val;
				}
			}

			$first = quartil($tmp['first']);
			$third = quartil($tmp['third']);
			$inner = $third - $first;
			$in_f1 = $first - (1.5 * $inner);
			$in_f2 = $third + (1.5 * $inner);

			$out_f1 = $first - (3 * $inner);
			$out_f2 = $third + (3 * $inner);
			$outlier = [];
			$poutlier = [];
			foreach ($values as $key => $value) {
				if ($value < $in_f1) {
					$outlier[] = $value;
				}
				if ($value > $in_f2) {
					$outlier[] = $value;
				}
				if ($value < $out_f1) {
					$poutlier[] = $value;
				}
				if ($value > $out_f2) {
					$poutlier[] = $value;
				}
			}
			$this->param['values'] = $values;
			$this->param['first'] = $first;
			$this->param['third'] = $third;
			$this->param['inner'] = $inner;
			$this->param['in_f1'] = $in_f1;
			$this->param['in_f2'] = $in_f2;
			$this->param['out_f1'] = $out_f1;
			$this->param['out_f2'] = $out_f2;
			$this->param['outlier'] = $outlier;
			$this->param['poutlier'] = $poutlier;
			$this->param['median'] = $median;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function quadratic($request)
	{
		$x = $request->x;
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$numbersx = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		$y = $request->y;
		$y = str_replace([" ", ",", "\n", "\r"], ",", $y);
		while (strpos($y, ",,") !== false) {
			$y = str_replace(",,", ",", $y);
		}
		$numbersy = array_map('trim', array_filter(explode(',', $y), function ($value) {
			return $value !== '';
		}));
		$check = true;
		$xvalues = [];
		$yvalues = [];
		if (count($numbersx) !== count($numbersy)) {
			$this->param['error'] = "Please! Enter same number of values for X and Y";
			return $this->param;
		}
		foreach ($numbersx as $key => $value) {
			$value = trim($value);
			if (is_numeric($value)) {
				$xvalues[] = $value;
			} else {
				$check = false;
			}
		}
		foreach ($numbersy as $key => $value) {
			$value = trim($value);
			if (is_numeric($value)) {
				$yvalues[] = $value;
			} else {
				$check = false;
			}
		}
		if ($check == true) {
			$count = count($xvalues);
			$meanx = round(array_sum($xvalues) / $count, 3);
			$meany = round(array_sum($yvalues) / $count, 3);
			$x2 = [];
			for ($i = 0; $i < count($xvalues); $i++) {
				$x2[] = $xvalues[$i] * $xvalues[$i];
			}
			$meanx2 = round(array_sum($x2) / $count, 3);
			$Sxx = [];
			$Sxy = [];
			$Sxx2 = [];
			$Sx2x2 = [];
			$Sx2y = [];
			for ($i = 0; $i < count($xvalues); $i++) {
				$Sxx[] = ($xvalues[$i] - $meanx) * ($xvalues[$i] - $meanx);
				$Sxy[] = ($xvalues[$i] - $meanx) * ($yvalues[$i] - $meany);
				$Sxx2[] = ($xvalues[$i] - $meanx) * ($xvalues[$i] * $xvalues[$i] - $meanx2);
				$Sx2x2[] = ($xvalues[$i] * $xvalues[$i] - $meanx2) * ($xvalues[$i] * $xvalues[$i] - $meanx2);
				$Sx2y[] = ($xvalues[$i] * $xvalues[$i] - $meanx2) * ($yvalues[$i] - $meany);
			}
			$b = (array_sum($Sxy) * array_sum($Sx2x2) - array_sum($Sx2y) * array_sum($Sxx2)) / (array_sum($Sxx) * array_sum($Sx2x2) - array_sum($Sxx2) * array_sum($Sxx2));
			$c = (array_sum($Sx2y) * array_sum($Sxx) - array_sum($Sxy) * array_sum($Sxx2)) / (array_sum($Sxx) * array_sum($Sx2x2) - array_sum($Sxx2) * array_sum($Sxx2));
			$a = $meany - ($b * $meanx) - ($c * $meanx2);
			$SSE = [];
			$SST = [];
			for ($i = 0; $i < count($xvalues); $i++) {
				$SSE[] =  ($yvalues[$i] - $xvalues[$i] * $xvalues[$i] * $c - $xvalues[$i] * $b - $a) * ($yvalues[$i] - $xvalues[$i] * $xvalues[$i] * $c - $xvalues[$i] * $b - $a);
				$SST[] = ($yvalues[$i] - $meany) * ($yvalues[$i] - $meany);
			}
			$r2 = 1 - array_sum($SSE) / array_sum($SST);

			$this->param['xvalues'] = $xvalues;
			$this->param['yvalues'] = $yvalues;
			$this->param['meanx'] = $meanx;
			$this->param['meanx2'] = $meanx2;
			$this->param['meany'] = $meany;
			$this->param['Sxx'] = $Sxx;
			$this->param['Sxy'] = $Sxy;
			$this->param['Sxx2'] = $Sxx2;
			$this->param['Sx2x2'] = $Sx2x2;
			$this->param['Sx2y'] = $Sx2y;
			$this->param['SSE'] = $SSE;
			$this->param['SST'] = $SST;
			$this->param['a'] = $a;
			$this->param['b'] = $b;
			$this->param['c'] = $c;
			$this->param['r2'] = $r2;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function percentile($request)
	{
		$p = $request->p;
		$x = $request->x;
		$seprate = $request->seprate;
		if (isset($request->advancedcheck)) {
			$advancedcheck = $request->advancedcheck;
		} else {
			$advancedcheck = false;
		}
		if (empty($x)) {
			$check = false;
		}
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$check = true;
		$numbers = array_map('trim', array_filter(explode($seprate, $x)));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			sort($numbers);
			if (count($numbers) < 2) {
				$this->param['error'] = "Please! enter 2 or more numbers";
				return $this->param;
			}
			$n = count($numbers);
			if ($p >= 0 && $p <= 100) {
				$p_per = $p / 100;

				// Method 1

				$ab = $p_per * $n;
				$final_ans11 = ceil($ab);
				$xy = $final_ans11 - 1;
				$final_ans1 = $numbers[$xy];

				// Method 2

				$n_sum_method2 = $n - 1;
				$ans_method2 = ($p_per * $n_sum_method2) + 1;
				if (is_float($ans_method2)) {
					$yy = explode('.', $ans_method2);
					if (count($yy) == 2) {
						list($x1, $x2) = explode('.', $ans_method2);
						$ans2_method2 = "0." . $x2;
					} else {
						$ans2_method2 = $ans_method2;
					}
					// list($x1, $x2) = explode('.', $ans_method2);
					// $ans2_method2="0.".$x2;
					$ceil_ans2 = ceil($ans_method2) - 1;
					$floor_ans2 = floor($ans_method2) - 1;
					$diff2 = $numbers[$ceil_ans2] - $numbers[$floor_ans2];
					$b2 = $numbers[$floor_ans2];
					$ans_diff2 = $ans2_method2 * $diff2;
					$final_ans2 = $b2 + $ans_diff2;
				} else {
					$ans2_method2 = " ";
					$ceil_ans2 = " ";
					$floor_ans2 = " ";
					$diff2 = " ";
					$b2 = " ";
					$ans_diff2 = " ";
					if ($ans_method2 == 7) {
						$final_ans2 = $numbers[$ans_method2 - 1];
					} else {
						$final_ans2 = $numbers[$ans_method2];
					}
					// $final_ans2=$numbers[$ans_method2];
				}

				// Method 3

				$n_sum = $n + 1;
				$ans = $n_sum * $p_per;
				if (is_float($ans)) {
					$zz = explode('.', $ans);
					if (count($zz) == 2) {
						list($t1, $t2) = explode('.', $ans);
						$ans2 = "0." . $t2;
					} else {
						$ans2 = $ans;
					}
					// list($t1, $t2) = explode('.', $ans);
					// $ans2="0.".$t2;
					$ceil_ans = ceil($ans) - 1;
					$floor_ans = floor($ans) - 1;
					if ($ceil_ans >= 0 && $floor_ans >= 0) {
						if ($ceil_ans >= $n) {
							$ceil_ans = $ceil_ans - 1;
						}
						if ($floor_ans >= $n) {
							$floor_ans = $floor_ans - 1;
						}
						$diff = $numbers[$ceil_ans] - $numbers[$floor_ans];
						$b = $numbers[$floor_ans];
						$ans_diff = $ans2 * $diff;
						$final_ans = $b + $ans_diff;
					} else {
						$diff = "---";
						$b = "---";
						$ans_diff = "---";
						$final_ans = "---";
					}
				} else {
					$ans2 = " ";
					$ceil_ans = " ";
					$floor_ans = " ";
					$diff = " ";
					$b = " ";
					$ans_diff = " ";
					if ($ans == 7) {
						$final_ans = $numbers[$ans - 1];
					} else if ($ans < 7) {
						$final_ans = $numbers[$ans];
					} else if ($ans > 7) {
						$final_ans = "---";
					}
					// $final_ans=$numbers[$ans];
				}
				if ($advancedcheck == true) {
					for ($i = 0; $i <= 100; $i += 5) {
						$p_per3 = $i / 100;
						$n_sum_method3 = $n - 1;
						$ans_method3 = ($p_per3 * $n_sum_method3) + 1;
						$xx = explode('.', $ans_method3);
						if (count($xx) == 2) {
							list($x13, $x23) = explode('.', $ans_method3);
							$ans2_method3 = "0." . $x23;
						} else {
							$ans2_method3 = $ans_method3;
						}
						$ceil_ans3 = ceil($ans_method3) - 1;
						$floor_ans3 = floor($ans_method3) - 1;
						$diff3 = $numbers[$ceil_ans3] - $numbers[$floor_ans3];
						$b3 = $numbers[$floor_ans3];
						$ans_diff3 = $ans2_method3 * $diff3;
						$final_ans3[] = $b3 + $ans_diff3;
					}
				}
			} else {
				$this->param['error'] = "Please! Check Your Percentile percentage";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
		$this->param['final_ans'] = $final_ans;
		$this->param['final_ans2'] = $final_ans2;
		$this->param['final_ans1'] = $final_ans1;
		$this->param['p'] = $p;
		$this->param['n'] = $n;
		$this->param['b'] = $b;
		$this->param['ans'] = $ans;
		$this->param['ans2'] = $ans2;
		$this->param['n_sum'] = $n_sum;
		$this->param['p_per'] = $p_per;
		$this->param['numbers'] = $numbers;
		$this->param['diff'] = $diff;
		$this->param['ans_diff'] = $ans_diff;
		$this->param['n_sum_method2'] = $n_sum_method2;
		$this->param['ans_method2'] = $ans_method2;
		$this->param['ans2_method2'] = $ans2_method2;
		$this->param['ans_diff2'] = $ans_diff2;
		$this->param['ab'] = $ab;
		$this->param['final_ans11'] = $final_ans11;
		if (!empty($final_ans3)) {
			$this->param['final_ans3'] = $final_ans3;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function stem($request)
	{
		$x = $request->x;
		if (!empty($x)) {
			$check = true;
			$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			while (strpos($x, ",,") !== false) {
				$x = str_replace(",,", ",", $x);
			}
			$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			$values = [];
			foreach ($numbers as $key => $value) {
				$values[] = trim($value);
			}
			sort($values);
			if (count($values) > 1000) {
				$this->param['error'] = "You can enter up to 1000 numbers";
				return $this->param;
			}
			$new = [];
			foreach ($values as $key => $value) {
				if (!is_numeric($value)) {
					$this->param['error'] = "Please! Enter Valid Input";
					return $this->param;
					break;
				} elseif ($value > 9999) {
					$this->param['error'] = "Single data points limited to 4 digits. (from 1 to 9999)";
					return $this->param;
					break;
				} else {
					if (strlen($value) == 1) {
						$new[0][] = $value;
					} else {
						$new[substr($value, 0, -1)][] = substr($value, -1);
					}
				}
			}
			$min = min($values);
			$max = max($values);
			$count = count($values);
			$sum = array_sum($values);
			$range = $max - $min;
			$mean = round($sum / $count, 5);

			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $values[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($values[$center] + $values[$next]) / 2;
			}
			$m_array = array_count_values($values);
			$m_max = max($m_array);
			$mode = array();
			foreach ($m_array as $key => $value) {
				if ($value == $m_max) {
					$mode[] = $key;
				}
			}
			$d = 0;
			foreach ($values as $key => $value) {
				$d = $d + pow($value - $mean, 2);
			}
			$s_d = (1 / ($count - 1)) * $d;
			$var = $s_d;
			$SD = sqrt($s_d);
			$this->param['new'] = $new;
			$this->param['min'] = $min;
			$this->param['max'] = $max;
			$this->param['count'] = $count;
			$this->param['sum'] = $sum;
			$this->param['range'] = $range;
			$this->param['mean'] = $mean;
			$this->param['median'] = $median;
			$this->param['mode'] = $mode;
			$this->param['SD'] = $SD;
			$this->param['var'] = $var;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please check your input.";
			return $this->param;
		}
	}
	public function shannon($request)
	{
		$x = $request->x;
		$seprate = $request->seprate;
		if (empty($x)) {
			$check = false;
		}
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$check = true;
		$numbers = array_map('trim', array_filter(explode($seprate, $x)));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			$sum = 0;
			$sum_of_squares = 0;
			$sum3 = 0;
			$sum2 = 0;
			$count_number = count($numbers);
			$array_sum = array_sum($numbers);
			$array_sum2 = $array_sum * $array_sum - 1;
			$maximum = max($numbers);
			for ($i = 0; $i < $count_number; $i++) {
				$sum_of_squares = ($numbers[$i]) * ($numbers[$i] - 1);
				$take_log = log($numbers[$i] / $array_sum);
				$final_log = $take_log * ($numbers[$i] / $array_sum);
				$final_ans = $numbers[$i] / $array_sum;
				$sum = $sum + $final_log;
				$sum2 = $sum2 + $sum_of_squares;
				$calculate_d = (($numbers[$i] * $numbers[$i])) / ($array_sum * $array_sum);
				$sum3 = $sum3 + $calculate_d;
			}
			$simpson_index = $sum2 / $array_sum2;
			$this->param['shannon_diversity'] = $sum;
			$this->param['count_elements'] = log($count_number);
			$this->param['hitman'] = $count_number;
			$this->param['sum'] = $array_sum;
			$this->param['max'] = $maximum;
			$this->param['simpson_index'] = $simpson_index;
			$this->param['sum3'] = $sum3;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function midrange($request)
	{
		$x = $request->x;
		if (!empty($x)) {
			$check = true;
			$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			while (strpos($x, ",,") !== false) {
				$x = str_replace(",,", ",", $x);
			}
			$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			$values = [];
			foreach ($numbers as $key => $value) {
				$values[] = trim($value);
			}
			sort($values);
			$new = [];
			foreach ($values as $key => $value) {
				if (!is_numeric($value)) {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
					break;
				}
			}
			$min = min($values);
			$max = max($values);
			$count = count($values);
			$sum = array_sum($values);
			$range = $max - $min;
			$mean = round($sum / $count, 5);

			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $values[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($values[$center] + $values[$next]) / 2;
			}
			$m_array = array_count_values($values);
			$m_max = max($m_array);
			$mode = array();
			foreach ($m_array as $key => $value) {
				if ($value == $m_max) {
					$mode[] = $key;
				}
			}
			$d = 0;
			foreach ($values as $key => $value) {
				$d = $d + pow($value - $mean, 2);
			}
			$s_d = (1 / ($count - 1)) * $d;
			$var = $s_d;
			$SD = sqrt($s_d);
			$this->param['ans'] = ($max + $min) / 2;
			$this->param['min'] = $min;
			$this->param['max'] = $max;
			$this->param['count'] = $count;
			$this->param['sum'] = $sum;
			$this->param['range'] = $range;
			$this->param['mean'] = $mean;
			$this->param['median'] = $median;
			$this->param['mode'] = $mode;
			$this->param['SD'] = $SD;
			$this->param['var'] = $var;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	public function degrees($request)
	{
		//  dd($request->all());
		$sample_size = $request->sample_size;
		$sample_size_one = $request->sample_size_one;
		$sample_size_two = $request->sample_size_two;
		$variance_one = $request->variance_one;
		$variance_two = $request->variance_two;
		$c1 = $request->c1;
		$r1 = $request->r1;
		$k1 = $request->k1;
		$d1 = $request->d1;
		$d2 = $request->d2;
		$selection = $request->selection;
		$h = $request->h;
		$sample_mean = $request->sample_mean;
		$selection = $request->selection;
		$standard_deviation_three = $request->standard_deviation_three;
		if ($selection == "1") {
			if (is_numeric($sample_size) &&  !is_float($sample_size) && $sample_size > 0) {
				$degrees_of_freedom = $sample_size - 1;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($selection == "2") {
			if (is_numeric($sample_size_one) && is_numeric($sample_size_two) && $sample_size_one > 0 && $sample_size_two) {
				$degrees_of_freedom = ($sample_size_one + $sample_size_two) - 2;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($selection == "3") {
			if (is_numeric($sample_size_one) && is_numeric($sample_size_two) && $sample_size_one > 0 && $sample_size_two && is_numeric($variance_one) && is_numeric($variance_two)) {
				$d1 = (($variance_one / $sample_size_one) + ($variance_two / $sample_size_two));
				$d2 = pow($d1, 2);
				$d3 = (($variance_one * $variance_one) / ($sample_size_one * $sample_size_one * ($sample_size_one - 1)));
				$d4 = (($variance_two * $variance_two) / ($sample_size_two * $sample_size_two * ($sample_size_two - 1)));
				$degrees_of_freedom = $d2 / ($d3 + $d4);
				$this->param['v1'] = sqrt($variance_one);
				$this->param['v2'] = sqrt($variance_two);
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($selection == "4") { //Chi Square
			if (is_numeric($r1) && is_numeric($c1) && $r1 > 0 && $c1 > 0) {
				$degrees_of_freedom = ($r1 - 1) * ($c1 - 1);
				$this->param['degrees_of_freedom'] = $degrees_of_freedom;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($selection == "5") {
			if (is_numeric($sample_size) && is_numeric($k1) && $k1 > 0 && $sample_size > 0) {
				$d3 = $k1 - 1;
				$d2 = $sample_size - $k1;
				$degrees_of_freedom = $sample_size - 1;
				$this->param['d2'] = $d2;
				$this->param['d3'] = $d3;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($selection == "6") {
			if (is_numeric($sample_size) && is_numeric($h) && is_numeric($sample_mean) && is_numeric($standard_deviation_three) && is_numeric($sample_size) > 0 && is_numeric($standard_deviation_three)) {
				$t_statistic = (($sample_mean - $h)) / ($standard_deviation_three / (sqrt($sample_size)));
				$this->param['t_statistic'] = $t_statistic;
				$degrees_of_freedom = $sample_size - 1;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
		$this->param['degrees_of_freedom'] = $degrees_of_freedom;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	public function pro_den($request)
	{
		
		$select = $request->select;
		$a = $request->a;
		$b = $request->b;
		$c = $request->c;
		if ($select == 1) {
			if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
				if ($c < 0 || $c > 1) {
					$this->param['error'] = "x Must be greater than 0 and less than 1";
					return $this->param;
				}
				$parem = 't**(' . ($a - 1) . ')(1-t)**(' . ($b - 1) . ')';
				try {
					$client = new Client();
					$r = $client->post("http://167.172.134.148/only_integral", [
						'form_params' => [
							'equ' => $parem,
							'wrt' => 't',
							'lb' => 0,
							'ub' => 1,
						],
						'timeout' => 120,
					]);
					$buffer = $r->getBody();
					$buffer = json_decode($buffer, true);
					$B = $buffer[0];
					$ans = (1 / $B) * pow($c, ($a - 1))  * pow((1 - $c), ($b - 1));
					$this->param['ans'] = $ans;
					$this->param['RESULT'] = 1;
					return $this->param;
				} catch (\Exception $r) {
					$this->param['error'] = "Server Busy! Please try again later";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 2) {
			if (is_numeric($a) && is_numeric($b)) {
				$parem = 't**(' . (($a / 2) - 1) . ')exp(-t)';
				try {
					$client = new Client();
					$r = $client->post("http://167.172.134.148/only_integral", [
						'form_params' => [
							'equ' => $parem,
							'wrt' => 't',
							'lb' => 0,
							'ub' => 'oo',
						],
						'timeout' => 120,
					]);
					$buffer = $r->getBody();
					$buffer = json_decode($buffer, true);
					$B = $buffer[0];
					$ans = (1 / (pow(2, ($a / 2)) * $B)) * pow($b, (($a / 2) - 1)) * exp((-1 * ($b)) / 2);
					$this->param['ans'] = $ans;
					$this->param['RESULT'] = 1;
					return $this->param;
				} catch (\Exception $r) {
					$this->param['error'] = "Server Busy! Please try again later";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 3) {
			if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
				$parem = 't**(' . abs(($a / 2) - 1) . ')(1-t)**(' . abs(($b / 2) - 1) . ')';
				try {
					$client = new Client();
					$r = $client->post("http://167.172.134.148/only_integral", [
						'form_params' => [
							'equ' => $parem,
							'wrt' => 't',
							'lb' => 0,
							'ub' => '1',
						],
						'timeout' => 120,
					]);
					$buffer = $r->getBody();
					$buffer = json_decode($buffer, true);
					$B = $buffer[0];
					$ans = sqrt((pow($a * $c, $a) * pow($b, $b)) / pow($a * $c + $b, ($a + $b))) / ($c * $B);
					$this->param['ans'] = $ans;
					$this->param['RESULT'] = 1;
					return $this->param;
				} catch (\Exception $r) {
					$this->param['error'] = "Server Busy! Please try again later";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 4) {
			if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
				$parem = 't**(' . (($a / 2) - 1) . ')exp(-t)';
				$u = $b;
				$v = $a;
				$x = $c;
				$parem1 = 'y**' . ($v) . '*exp( -1/2 * ( y- ((' . ($u * $x) . ') / (sqrt(' . (pow($x, 2) + $v) . ') ) ))**2)';
				try {
					$client = new Client();
					$r = $client->post("http://167.172.134.148/only_integral", [
						'form_params' => [
							'equ' => $parem,
							'equ1' => $parem1,
							'wrt' => 't',
							'wrt1' => 'y',
							'lb' => 0,
							'ub' => 'oo',
						],
						'timeout' => 120,
					]);
					$buffer = $r->getBody();
					$buffer = json_decode($buffer, true);
					$B = $buffer[0];
					$int = $buffer[1];
					$up1 = pow($v, $v / 2) * exp(-1 * (($v * pow($u, 2)) / (2 * (pow($x, 2) + $v))));
					$btm = ($up1) / (sqrt(pi()) * $B * pow(2, (($v - 1) / 2)) * pow((pow($x, 2) + $v), (($v + 1) / 2)));
					$ans = $int * $btm;
					$this->param['ans'] = $ans;
					$this->param['RESULT'] = 1;
					return $this->param;
				} catch (\Exception $r) {
					$this->param['error'] = "Server Busy! Please try again later";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 5) {
			if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
				$ans = (1 / sqrt(2 * pi() * pow($b, 2))) * exp(-1 * (pow($c - $a, 2) / (2 * pow($b, 2))));
				$this->param['ans'] = $ans;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 6) {
			if (is_numeric($c)) {
				$ans = (1 / sqrt(2 * pi())) * exp((-1 / 2) * pow($c, 2));
				$this->param['ans'] = $ans;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 7) {
			if (is_numeric($a) && is_numeric($b)) {
				$parem = 't**(' . (($a / 2) - 1) . ')exp(-t)';
				$parem1 = 't**(' . ((($a + 1) / 2) - 1) . ')exp(-t)';
				try {
					$client = new Client();
					$r = $client->post("http://167.172.134.148/only_integral", [
						'form_params' => [
							'equ' => $parem,
							'equ1' => $parem1,
							'wrt' => 't',
							'lb' => 0,
							'ub' => 'oo',
						],
						'timeout' => 120,
					]);
					$buffer = $r->getBody();
					$buffer = json_decode($buffer, true);
					$B = $buffer[0];
					$B1 = $buffer[1];
					$ans = ($B1 / (sqrt($a * pi()) * $B)) * pow((1 + (pow($b, 2) / $a)), (-1 / 2 * ($a + 1)));
					$this->param['ans'] = $ans;
					$this->param['RESULT'] = 1;
					return $this->param;
				} catch (\Exception $r) {
					$this->param['error'] = "Server Busy! Please try again later";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($select == 8) {
			if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
				if ($c >= $a && $c <= $b) {
					$ans = 1 / ($b - $a);
				} else {
					$ans = 0;
				}
				$this->param['ans'] = $ans;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
	}
	public function gematria($request)
	{
		error_reporting(0);
		$input = $request->input;
		$English_Ordinal = array(
			'a' => '1',
			'b' => '2',
			'c' => '3',
			'd' => '4',
			'e' => '5',
			'f' => '6',
			'g' => '7',
			'h' => '8',
			'i' => '9',
			'j' => '10',
			'k' => '11',
			'l' => '12',
			'm' => '13',
			'n' => '14',
			'o' => '15',
			'p' => '16',
			'q' => '17',
			'r' => '18',
			's' => '19',
			't' => '20',
			'u' => '21',
			'v' => '22',
			'w' => '23',
			'x' => '24',
			'y' => '25',
			'z' => '26',


			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		$Full_Reduction = array(
			'a' => '1',
			'b' => '2',
			'c' => '3',
			'd' => '4',
			'e' => '5',
			'f' => '6',
			'g' => '7',
			'h' => '8',
			'i' => '9',
			'j' => '1',
			'k' => '2',
			'l' => '3',
			'm' => '4',
			'n' => '5',
			'o' => '6',
			'p' => '7',
			'q' => '8',
			'r' => '9',
			's' => '1',
			't' => '2',
			'u' => '3',
			'v' => '4',
			'w' => '5',
			'x' => '6',
			'y' => '7',
			'z' => '8',


			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		$Reverse_Ordinal = array(
			'a' => '26',
			'b' => '25',
			'c' => '24',
			'd' => '23',
			'e' => '22',
			'f' => '21',
			'g' => '20',
			'h' => '19',
			'i' => '18',
			'j' => '17',
			'k' => '16',
			'l' => '15',
			'm' => '14',
			'n' => '13',
			'o' => '12',
			'p' => '11',
			'q' => '10',
			'r' => '9',
			's' => '8',
			't' => '7',
			'u' => '6',
			'v' => '5',
			'w' => '4',
			'x' => '3',
			'y' => '2',
			'z' => '1',

			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		$Reverse_Full_Reduction = array(
			'a' => '8',
			'b' => '7',
			'c' => '6',
			'd' => '5',
			'e' => '4',
			'f' => '3',
			'g' => '2',
			'h' => '1',
			'i' => '9',
			'j' => '8',
			'k' => '7',
			'l' => '6',
			'm' => '5',
			'n' => '4',
			'o' => '3',
			'p' => '2',
			'q' => '1',
			'r' => '9',
			's' => '8',
			't' => '7',
			'u' => '6',
			'v' => '5',
			'w' => '4',
			'x' => '3',
			'y' => '2',
			'z' => '1',

			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		$Jewish_Gematria  = array(
			'a' => '1',
			'b' => '2',
			'c' => '3',
			'd' => '4',
			'e' => '5',
			'f' => '6',
			'g' => '7',
			'h' => '8',
			'i' => '9',
			'j' => '600',
			'k' => '10',
			'l' => '20',
			'm' => '30',
			'n' => '40',
			'o' => '50',
			'p' => '60',
			'q' => '70',
			'r' => '80',
			's' => '90',
			't' => '100',
			'u' => '200',
			'v' => '700',
			'w' => '900',
			'x' => '300',
			'y' => '400',
			'z' => '500',

			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		$English_Gematria  = array(
			'a' => '6',
			'b' => '12',
			'c' => '18',
			'd' => '24',
			'e' => '30',
			'f' => '36',
			'g' => '42',
			'h' => '48',
			'i' => '54',
			'j' => '60',
			'k' => '66',
			'l' => '72',
			'm' => '78',
			'n' => '84',
			'o' => '90',
			'p' => '96',
			'q' => '102',
			'r' => '108',
			's' => '114',
			't' => '120',
			'u' => '126',
			'v' => '132',
			'w' => '138',
			'x' => '144',
			'y' => '150',
			'z' => '156',

			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		$Hebrew  = array(
			'a' => '1',
			'b' => '2',
			'c' => '8',
			'd' => '4',
			'e' => '5',
			'f' => '80',
			'g' => '3',
			'h' => '5',
			'i' => '10',
			'j' => '10',
			'k' => '20',
			'l' => '30',
			'm' => '40',
			'n' => '50',
			'o' => '70',
			'p' => '80',
			'q' => '100',
			'r' => '200',
			's' => '60',
			't' => '9',
			'u' => '6',
			'v' => '6',
			'w' => '6',
			'x' => '60',
			'y' => '10',
			'z' => '7',

			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
		);
		function printDivisors($n)
		{
			for ($i = 1; $i <= $n; $i++) {
				if ($n % $i == 0)
					$divi[] = "$i ";
			}
			return ($divi);
		}
		function np($num)
		{
			$prev = '';
			$i = $num;
			$check_n = 0;
			while ($i < 10000000 && $check_n != 1) {
				$i++;
				$mm = 0;
				for ($j = 2; $j <= $i / 2; $j++) {
					if ($i % $j == 0) {
						$mm++;
						break;
					}
				}
				if ($mm == 0) {
					$next = $i;
					$check_n = 1;
				}
			}
			$i = $num;
			$check_n = 0;
			while ($i > 2 && $check_n != 1) {
				$i--;
				$mm = 0;
				for ($j = 2; $j <= $i / 2; $j++) {
					if ($i % $j == 0) {
						$mm++;
						break;
					}
				}
				if ($mm == 0) {
					$prev = $i;
					$check_n = 1;
				}
			}
			return array($prev, $next);
		}
		function factor($loop_eo)
		{
			$newtext_eo = "";
			$chk_eo = 2;
			$prime_eo = 0;
			while ($chk_eo * $chk_eo <= $loop_eo) : //10 => 4
				if ($loop_eo % $chk_eo == 0) { //10 % 2 = 0
					$newtext_eo = $newtext_eo . $chk_eo; // 0 +2 =2;
					$loop_eo = $loop_eo / $chk_eo; //10/2 = 5
					if ($loop_eo != 1) {   // 
						$newtext_eo = $newtext_eo . " × ";
					}
				} else {
					$chk_eo++;
				}
			endwhile;
			if ($loop_eo != 1) {
				$newtext_eo = $newtext_eo . $loop_eo;
			}
			if ($newtext_eo == "" . $loop_eo) {
				$newtext_eo = "1 " . $newtext_eo;
				$prime_eo = 1;
			}
			return $newtext_eo;
		}
		function total($num)
		{
			$list = '';
			$total = 0;
			for ($i = 2; $i <= $num; $i++) {
				$mm = 0;
				for ($j = 2; $j <= $i / 2; $j++) {
					//only not prime numbers
					if ($i % $j == 0) {
						$mm++;
						break;
					}
				}
				if ($mm == 0) {
					$total++;
					$list .= "$i, ";
				}
			}
			return $total;
		}
		function primeCheck($number)
		{
			if ($number == 1)
				return 0;
			for ($i = 2; $i <= $number / 2; $i++) {
				if ($number % $i == 0)
					return 0;
			}
			return 1;
		}
		for ($i = 2, $j = 1; $i < 10000; $i++) {
			$triangular[] = $j;
			$j += $i;
		}
		for ($i = 0; $i < 10000; $i++) {
			if ($i == 1 || $i == 0)
				continue;
			$f = 1;
			for ($j = 2; $j < intval($i / 2) + 1; $j++) {
				if ($i % $j == 0) {
					$f = 0;
					break;
				}
			}
			if ($f == 1)
				$prime_nums[] = $i;
		}
		$num1 = 0;
		$num2 = 1;
		$counter = 0;
		while ($counter < 1000) {
			$arr[] = $num1;
			$num3 = $num2 + $num1;
			$num1 = $num2;
			$num2 = $num3;
			$counter = $counter + 1;
		}
		if (!empty($input)) {
			// if (preg_match("/[a-zA-Z]+/", $input)) {
			if (empty($input)) {
				$this->param['error'] = "Please! Enter Your Input.";
				return $this->param;
			} else {
				$words1 = preg_replace("/[^a-zA-Z0-9]+/", " ", $input);
				// dd($words1);
				$alphabets = preg_replace("/[^a-zA-Z]+/", "", $input);
				$null_space = str_replace(' ', '', $input);
				$count_wrd = explode(" ", $words1);
				$num_agye = str_split($null_space);
				$words_ans = count($count_wrd);
				$count_ans = strlen($alphabets);
				$add_nums = array_sum($num_agye);
				$answer_eo = $add_nums;
				$answer_fr = $add_nums;
				$answer_ro = $add_nums;
				$answer_rfd = $add_nums;
				$answer_jg = $add_nums;
				$answer_eg = $add_nums;
				$answer_h = $add_nums;
				// dd('else');
				$small = strtolower($input);
				$null_space = str_replace(' ', '', $small);
				$alphabets = preg_replace("/[^a-zA-Z]+/", "", $null_space);
				$numbers = preg_replace("/[^0-9]+/", "", $null_space);
				$words1 = preg_replace("/[^a-zA-Z0-9]+/", " ", $small);
				$count_wrd = explode(" ", $words1);
				$words_ans = count($count_wrd);
				$count_ans = strlen($alphabets);
				$num_agye = str_split($numbers);
				$sum_num = array_sum($num_agye);
				$array_agai = str_split($alphabets);
				$nawa = explode(' ', $small);
				// dd('sdfs');
				foreach ($nawa as  $value) {
					$inner_alpha[] = str_split(trim($value));
				}
				for ($i = 0; $i < count($inner_alpha); $i++) {
					foreach ($inner_alpha[$i] as $value) {
						$inner_ans_eo[$i][] = $English_Ordinal[$value];
						$inner_ans_fr[$i][] = $Full_Reduction[$value];
						$inner_ans_ro[$i][] = $Reverse_Ordinal[$value];
						$inner_ans_rfd[$i][] = $Reverse_Full_Reduction[$value];
						$inner_ans_jg[$i][] = $Jewish_Gematria[$value];
						$inner_ans_eg[$i][] = $English_Gematria[$value];
						$inner_ans_h[$i][] = $Hebrew[$value];
					}
					$inner_sum_eo[] = array_sum($inner_ans_eo[$i]);
					$inner_sum_fr[] = array_sum($inner_ans_fr[$i]);
					$inner_sum_ro[] = array_sum($inner_ans_ro[$i]);
					$inner_sum_rfd[] = array_sum($inner_ans_rfd[$i]);
					$inner_sum_jg[] = array_sum($inner_ans_jg[$i]);
					$inner_sum_eg[] = array_sum($inner_ans_eg[$i]);
					$inner_sum_h[] = array_sum($inner_ans_h[$i]);
				}
				$this->param['inner_alpha'] = $inner_alpha;
				$this->param['inner_ans_eo'] = $inner_ans_eo;
				$this->param['inner_ans_fr'] = $inner_ans_fr;
				$this->param['inner_ans_ro'] = $inner_ans_ro;
				$this->param['inner_ans_rfd'] = $inner_ans_rfd;
				$this->param['inner_ans_jg'] = $inner_ans_jg;
				$this->param['inner_ans_eg'] = $inner_ans_eg;
				$this->param['inner_ans_h'] = $inner_ans_h;
				$this->param['inner_sum_eo'] = $inner_sum_eo;
				$this->param['inner_sum_fr'] = $inner_sum_fr;
				$this->param['inner_sum_ro'] = $inner_sum_ro;
				$this->param['inner_sum_rfd'] = $inner_sum_rfd;
				$this->param['inner_sum_jg'] = $inner_sum_jg;
				$this->param['inner_sum_eg'] = $inner_sum_eg;
				$this->param['inner_sum_h'] = $inner_sum_h;
				// dd($sum_num);

				for ($i = 0; $i < count($array_agai); $i++) {
					$value = $array_agai[$i];
					$sum_eo[] = $English_Ordinal[$value];
					$sum_fr[] = $Full_Reduction[$value];
					$sum_ro[] = $Reverse_Ordinal[$value];
					$sum_rfd[] = $Reverse_Full_Reduction[$value];
					$sum_jg[] = $Jewish_Gematria[$value];
					$sum_eg[] = $English_Gematria[$value];
					$sum_h[] = $Hebrew[$value];
				}
				// $answer_eo = array_sum($sum_eo) + $sum_num;
				// $answer_fr = array_sum($sum_fr) + $sum_num;
				// $answer_ro = array_sum($sum_ro) + $sum_num;
				// $answer_rfd = array_sum($sum_rfd) + $sum_num;
				// $answer_jg = array_sum($sum_jg) + $sum_num;
				// $answer_eg = array_sum($sum_eg) + $sum_num;
				// $answer_h = array_sum($sum_h) + $sum_num;
				// dd('s');

				// if(preg_match("/[^a-zA-Z]+/", $input) && preg_match('/\d/', $input)){
				if (preg_match('/\d/', $input)) {
					$answer_eo = $sum_num;
					$answer_fr = $sum_num;
					$answer_ro = $sum_num;
					$answer_rfd = $sum_num;
					$answer_jg = $sum_num;
					$answer_eg = $sum_num;
					$answer_h = $sum_num;
				} elseif (preg_match("/[a-zA-Z]+/", $input)) {
					$answer_eo = array_sum($sum_eo) + $sum_num;
					$answer_fr = array_sum($sum_fr) + $sum_num;
					$answer_ro = array_sum($sum_ro) + $sum_num;
					$answer_rfd = array_sum($sum_rfd) + $sum_num;
					$answer_jg = array_sum($sum_jg) + $sum_num;
					$answer_eg = array_sum($sum_eg) + $sum_num;
					$answer_h = array_sum($sum_h) + $sum_num;
				} else {
					$answer_eo = array_sum($sum_eo);
					$answer_fr = array_sum($sum_fr);
					$answer_ro = array_sum($sum_ro);
					$answer_rfd = array_sum($sum_rfd);
					$answer_jg = array_sum($sum_jg);
					$answer_eg = array_sum($sum_eg);
					$answer_h = array_sum($sum_h);
				}
			}
			$loop_eo = $answer_eo;
			$newtext_eo = factor($answer_eo);
			// $loop_fr=$answer_fr;
			$newtext_fr = factor($answer_fr);
			// $loop_ro=$answer_ro;
			$newtext_ro = factor($answer_ro);
			// $loop_rfd=$answer_rfd;
			$newtext_rfd = factor($answer_rfd);
			// $loop_jg=$answer_jg;
			$newtext_jg = factor($answer_jg);
			// $loop_eg=$answer_eg;
			$newtext_eg = factor($answer_eg);
			// $loop_h=$answer_h;
			$newtext_h = factor($answer_h);
			$eo_divi = printDivisors($answer_eo);
			$count_eodivi = count($eo_divi);
			$eodivi_sum = array_sum($eo_divi);
			$fr_divi = printDivisors($answer_fr);
			$count_frdivi = count($fr_divi);
			$frdivi_sum = array_sum($fr_divi);
			$ro_divi = printDivisors($answer_ro);
			$count_rodivi = count($ro_divi);
			$rodivi_sum = array_sum($ro_divi);
			$rfd_divi = printDivisors($answer_rfd);
			$count_rfddivi = count($rfd_divi);
			$rfddivi_sum = array_sum($rfd_divi);
			$jg_divi = printDivisors($answer_jg);
			$count_jgdivi = count($jg_divi);
			$jgdivi_sum = array_sum($jg_divi);
			$eg_divi = printDivisors($answer_eg);
			$count_egdivi = count($eg_divi);
			$egdivi_sum = array_sum($eg_divi);
			$h_divi = printDivisors($answer_h);
			$count_hdivi = count($h_divi);
			$hdivi_sum = array_sum($h_divi);
			$sq_root = sqrt(5);
			$add_pow = pow(1.61803, $answer_eo);
			$sub_pow = pow(-0.61803, $answer_eo);
			$sub = $add_pow - $sub_pow;
			$final_ans = $sub / $sq_root;
			$add_pow2 = pow(1.61803, $answer_fr);
			$sub_pow2 = pow(-0.61803, $answer_fr);
			$sub2 = $add_pow2 - $sub_pow2;
			$final_ans2 = $sub2 / $sq_root;
			$add_pow3 = pow(1.61803, $answer_ro);
			$sub_pow3 = pow(-0.61803, $answer_ro);
			$sub3 = $add_pow3 - $sub_pow3;
			$final_ans3 = $sub3 / $sq_root;
			$add_pow4 = pow(1.61803, $answer_rfd);
			$sub_pow4 = pow(-0.61803, $answer_rfd);
			$sub4 = $add_pow4 - $sub_pow4;
			$final_ans4 = $sub4 / $sq_root;
			$add_pow5 = pow(1.61803, $answer_jg);
			$sub_pow5 = pow(-0.61803, $answer_jg);
			$sub5 = $add_pow5 - $sub_pow5;
			$final_ans5 = $sub5 / $sq_root;
			$add_pow6 = pow(1.61803, $answer_eg);
			$sub_pow6 = pow(-0.61803, $answer_eg);
			$sub6 = $add_pow6 - $sub_pow6;
			$final_ans6 = $sub6 / $sq_root;
			$add_pow7 = pow(1.61803, $answer_h);
			$sub_pow7 = pow(-0.61803, $answer_h);
			$sub7 = $add_pow7 - $sub_pow7;
			$final_ans7 = $sub7 / $sq_root;
			$ap_eo = np($answer_eo);
			$apeo_p = $ap_eo[0];
			$apeo_n = $ap_eo[1];
			$ap_fr = np($answer_fr);
			$apfr_p = $ap_fr[0];
			$apfr_n = $ap_fr[1];
			$ap_ro = np($answer_ro);
			$apro_p = $ap_ro[0];
			$apro_n = $ap_ro[1];
			$ap_rfd = np($answer_rfd);
			$aprfd_p = $ap_rfd[0];
			$aprfd_n = $ap_rfd[1];
			$ap_jg = np($answer_jg);
			$apjg_p = $ap_jg[0];
			$apjg_n = $ap_jg[1];
			$ap_eg = np($answer_eg);
			$apeg_p = $ap_eg[0];
			$apeg_n = $ap_eg[1];
			$ap_h = np($answer_h);
			$aph_p = $ap_h[0];
			$aph_n = $ap_h[1];
			$previous_eo = total($answer_eo);
			$next_eo = $previous_eo + 1;
			$previous_fr = total($answer_fr);
			$next_fr = $previous_fr + 1;
			$previous_ro = total($answer_ro);
			$next_ro = $previous_ro + 1;
			$previous_rfd = total($answer_rfd);
			$next_rfd = $previous_rfd + 1;
			$previous_jg = total($answer_jg);
			$next_jg = $previous_jg + 1;
			$previous_eg = total($answer_eg);
			$next_eg = $previous_eg + 1;
			$previous_h = total($answer_h);
			$next_h = $previous_h + 1;
			$check_eo = primeCheck($answer_eo);
			$check_fr = primeCheck($answer_fr);
			$check_ro = primeCheck($answer_ro);
			$check_rfd = primeCheck($answer_rfd);
			$check_jg = primeCheck($answer_jg);
			$check_eg = primeCheck($answer_eg);
			$check_h = primeCheck($answer_h);
			$eo = array_search($answer_eo, $triangular);
			$fr = array_search($answer_fr, $triangular);
			$ro = array_search($answer_ro, $triangular);
			$rfd = array_search($answer_rfd, $triangular);
			$jg = array_search($answer_jg, $triangular);
			$eg = array_search($answer_eg, $triangular);
			$h = array_search($answer_h, $triangular);
			if (!empty($eo)) {
				$plus_eo = $eo;
				$index_eo = $plus_eo + 1;
				$this->param['index_eo'] = $index_eo;
			} else if (empty($eo)) {
				foreach ($triangular as  $value) {
					if ($answer_eo > $value) {
						$greater_eo[] = $value;
					} else if ($answer_eo < $value) {
						$less_eo[] = $value;
					}
				}
				$countg_eo = count($greater_eo);
				$countg_eo1 = $countg_eo + 1;
				$endg_eo = end($greater_eo);
				$fl_eo = $less_eo[0];
				$this->param['countg_eo'] = $countg_eo;
				$this->param['endg_eo'] = $endg_eo;
				$this->param['fl_eo'] = $fl_eo;
				$this->param['countg_eo1'] = $countg_eo1;
			}
			if (!empty($fr)) {
				$plus_fr = $fr;
				$index_fr = $plus_fr + 1;
				$this->param['index_fr'] = $index_fr;
			} else if (empty($fr)) {
				foreach ($triangular as  $value) {
					if ($answer_fr > $value) {
						$greater_fr[] = $value;
					} else if ($answer_fr < $value) {
						$less_fr[] = $value;
					}
				}
				$countg_fr = count($greater_fr);
				$countg_fr1 = $countg_fr + 1;
				$endg_fr = end($greater_fr);
				$fl_fr = $less_fr[0];
				$this->param['countg_fr'] = $countg_fr;
				$this->param['endg_fr'] = $endg_fr;
				$this->param['fl_fr'] = $fl_fr;
				$this->param['countg_fr1'] = $countg_fr1;
			}
			if (!empty($ro)) {
				$plus_ro = $ro;
				$index_ro = $plus_ro + 1;
				$this->param['index_ro'] = $index_ro;
			} else if (empty($ro)) {
				foreach ($triangular as  $value) {
					if ($answer_ro > $value) {
						$greater_ro[] = $value;
					} else if ($answer_ro < $value) {
						$less_ro[] = $value;
					}
				}
				$countg_ro = count($greater_ro);
				$countg_ro1 = $countg_ro + 1;
				$endg_ro = end($greater_ro);
				$fl_ro = $less_ro[0];
				$this->param['countg_ro'] = $countg_ro;
				$this->param['endg_ro'] = $endg_ro;
				$this->param['fl_ro'] = $fl_ro;
				$this->param['countg_ro1'] = $countg_ro1;
			}
			if (!empty($rfd)) {
				$plus_rfd = $rfd;
				$index_rfd = $plus_rfd + 1;
				$this->param['index_rfd'] = $index_rfd;
			} else if (empty($rfd)) {
				foreach ($triangular as  $value) {
					if ($answer_rfd > $value) {
						$greater_rfd[] = $value;
					} else if ($answer_rfd < $value) {
						$less_rfd[] = $value;
					}
				}
				$countg_rfd = count($greater_rfd);
				$countg_rfd1 = $countg_rfd + 1;
				$endg_rfd = end($greater_rfd);
				$fl_rfd = $less_rfd[0];
				$this->param['countg_rfd'] = $countg_rfd;
				$this->param['endg_rfd'] = $endg_rfd;
				$this->param['fl_rfd'] = $fl_rfd;
				$this->param['countg_rfd1'] = $countg_rfd1;
			}
			if (!empty($jg)) {
				$plus_jg = $jg;
				$index_jg = $plus_jg + 1;
				$this->param['index_jg'] = $index_jg;
			} else if (empty($jg)) {
				foreach ($triangular as  $value) {
					if ($answer_jg > $value) {
						$greater_jg[] = $value;
					} else if ($answer_jg < $value) {
						$less_jg[] = $value;
					}
				}
				$countg_jg = count($greater_jg);
				$countg_jg1 = $countg_jg + 1;
				$endg_jg = end($greater_jg);
				$fl_jg = $less_jg[0];
				$this->param['countg_jg'] = $countg_jg;
				$this->param['endg_jg'] = $endg_jg;
				$this->param['fl_jg'] = $fl_jg;
				$this->param['countg_jg1'] = $countg_jg1;
			}
			if (!empty($eg)) {
				$plus_eg = $eg;
				$index_eg = $plus_eg + 1;
				$this->param['index_eg'] = $index_eg;
			} else if (empty($eg)) {
				foreach ($triangular as  $value) {
					if ($answer_eg > $value) {
						$greater_eg[] = $value;
					} else if ($answer_eg < $value) {
						$less_eg[] = $value;
					}
				}
				$countg_eg = count($greater_eg);
				$countg_eg1 = $countg_eg + 1;
				$endg_eg = end($greater_eg);
				$fl_eg = $less_eg[0];
				$this->param['countg_eg'] = $countg_eg;
				$this->param['endg_eg'] = $endg_eg;
				$this->param['fl_eg'] = $fl_eg;
				$this->param['countg_eg1'] = $countg_eg1;
			}
			if (!empty($h)) {
				$plus_h = $h;
				$index_h = $plus_h + 1;
				$this->param['index_h'] = $index_h;
			} else if (empty($h)) {
				foreach ($triangular as  $value) {
					if ($answer_h > $value) {
						$greater_h[] = $value;
					} else if ($answer_h < $value) {
						$less_h[] = $value;
					}
				}
				$countg_h = count($greater_h);
				$countg_h1 = $countg_h + 1;
				$endg_h = end($greater_h);
				$fl_h = $less_h[0];
				$this->param['countg_h'] = $countg_h;
				$this->param['endg_h'] = $endg_h;
				$this->param['fl_h'] = $fl_h;
				$this->param['countg_h1'] = $countg_h1;
			}
			$dosra_eo = array_sum(str_split($answer_eo));
			$dosra_fr = array_sum(str_split($answer_fr));
			$dosra_ro = array_sum(str_split($answer_ro));
			$dosra_rfd = array_sum(str_split($answer_rfd));
			$dosra_jg = array_sum(str_split($answer_jg));
			$dosra_eg = array_sum(str_split($answer_eg));
			$dosra_h = array_sum(str_split($answer_h));
			$trelation_eo = $triangular[$answer_eo - 1];
			$trelation_fr = $triangular[$answer_fr - 1];
			$trelation_ro = $triangular[$answer_ro - 1];
			$trelation_rfd = $triangular[$answer_rfd - 1];
			$trelation_jg = $triangular[$answer_jg - 1];
			$trelation_eg = $triangular[$answer_eg - 1];
			$trelation_h = $triangular[$answer_h - 1];
			$prelation_eo = $prime_nums[$answer_eo - 1];
			$prelation_fr = $prime_nums[$answer_fr - 1];
			$prelation_ro = $prime_nums[$answer_ro - 1];
			$prelation_rfd = $prime_nums[$answer_rfd - 1];
			$prelation_jg = $prime_nums[$answer_jg - 1];
			$prelation_eg = $prime_nums[$answer_eg - 1];
			$prelation_h = $prime_nums[$answer_h - 1];
			$eo_fib = array_search($answer_eo, $arr);
			$fr_fib = array_search($answer_fr, $arr);
			$ro_fib = array_search($answer_ro, $arr);
			$rfd_fib = array_search($answer_rfd, $arr);
			$jg_fib = array_search($answer_jg, $arr);
			$eg_fib = array_search($answer_eg, $arr);
			$h_fib = array_search($answer_h, $arr);
			if (!empty($eo_fib)) {
				$fibplus_eo = $eo_fib;
				$fibindex_eo = $fibplus_eo + 1;
				$this->param['fibindex_eo'] = $fibindex_eo;
			} else if (empty($eo_fib)) {
				foreach ($arr as  $value5) {
					if ($answer_eo > $value5) {
						$fibgreater_eo[] = $value5;
					} else if ($answer_eo < $value5) {
						$fibless_eo[] = $value5;
					}
				}
				$fcountg_eo = count($fibgreater_eo);
				$fcountg_eo1 = $fcountg_eo + 1;
				$fendg_eo = end($fibgreater_eo);
				$ffl_eo = $fibless_eo[0];
				$this->param['fcountg_eo'] = $fcountg_eo;
				$this->param['fendg_eo'] = $fendg_eo;
				$this->param['ffl_eo'] = $ffl_eo;
				$this->param['fcountg_eo1'] = $fcountg_eo1;
			}
			if (!empty($fr_fib)) {
				$fplus_fr = $fr_fib;
				$findex_fr = $fplus_fr + 1;
				$this->param['findex_fr'] = $findex_fr;
			} else if (empty($fr_fib)) {
				foreach ($arr as  $value6) {
					if ($answer_fr > $value6) {
						$fgreater_fr[] = $value6;
					} else if ($answer_fr < $value6) {
						$fless_fr[] = $value6;
					}
				}
				$fcountg_fr = count($fgreater_fr);
				$fcountg_fr1 = $fcountg_fr + 1;
				$fendg_fr = end($fgreater_fr);
				$ffl_fr = $fless_fr[0];
				$this->param['fcountg_fr'] = $fcountg_fr;
				$this->param['fendg_fr'] = $fendg_fr;
				$this->param['ffl_fr'] = $ffl_fr;
				$this->param['fcountg_fr1'] = $fcountg_fr1;
			}
			if (!empty($ro_fib)) {
				$fplus_ro = $ro_fib;
				$findex_ro = $fplus_ro + 1;
				$this->param['findex_ro'] = $findex_ro;
			} else if (empty($ro_fib)) {
				foreach ($arr as  $value7) {
					if ($answer_ro > $value7) {
						$fgreater_ro[] = $value7;
					} else if ($answer_ro < $value7) {
						$fless_ro[] = $value7;
					}
				}
				$fcountg_ro = count($fgreater_ro);
				$fcountg_ro1 = $fcountg_ro + 1;
				$fendg_ro = end($fgreater_ro);
				$ffl_ro = $fless_ro[0];
				$this->param['fcountg_ro'] = $fcountg_ro;
				$this->param['fendg_ro'] = $fendg_ro;
				$this->param['ffl_ro'] = $ffl_ro;
				$this->param['fcountg_ro1'] = $fcountg_ro1;
			}
			if (!empty($rfd_fib)) {
				$fplus_rfd = $rfd_fib;
				$findex_rfd = $fplus_rfd + 1;
				$this->param['findex_rfd'] = $findex_rfd;
			} else if (empty($rfd_fib)) {
				foreach ($arr as  $value8) {
					if ($answer_rfd > $value8) {
						$fgreater_rfd[] = $value8;
					} else if ($answer_rfd < $value8) {
						$fless_rfd[] = $value8;
					}
				}
				$fcountg_rfd = count($fgreater_rfd);
				$fcountg_rfd1 = $fcountg_rfd + 1;
				$fendg_rfd = end($fgreater_rfd);
				$ffl_rfd = $fless_rfd[0];
				$this->param['fcountg_rfd'] = $fcountg_rfd;
				$this->param['fendg_rfd'] = $fendg_rfd;
				$this->param['ffl_rfd'] = $ffl_rfd;
				$this->param['fcountg_rfd1'] = $fcountg_rfd1;
			}
			if (!empty($jg_fib)) {
				$fplus_jg = $jg_fib;
				$findex_jg = $fplus_jg + 1;
				$this->param['findex_jg'] = $findex_jg;
			} else if (empty($jg_fib)) {
				foreach ($arr as  $value9) {
					if ($answer_jg > $value9) {
						$fgreater_jg[] = $value9;
					} else if ($answer_jg < $value9) {
						$fless_jg[] = $value9;
					}
				}
				$fcountg_jg = count($fgreater_jg);
				$fcountg_jg1 = $fcountg_jg + 1;
				$fendg_jg = end($fgreater_jg);
				$ffl_jg = $fless_jg[0];
				$this->param['fcountg_jg'] = $fcountg_jg;
				$this->param['fendg_jg'] = $fendg_jg;
				$this->param['ffl_jg'] = $ffl_jg;
				$this->param['fcountg_jg1'] = $fcountg_jg1;
			}
			if (!empty($eg_fib)) {
				$fplus_eg = $eg_fib;
				$findex_eg = $fplus_eg + 1;
				$this->param['findex_eg'] = $findex_eg;
			} else if (empty($eg_fib)) {
				foreach ($arr as  $value1) {
					if ($answer_eg > $value1) {
						$fgreater_eg[] = $value1;
					} else if ($answer_eg < $value1) {
						$fless_eg[] = $value1;
					}
				}
				$fcountg_eg = count($fgreater_eg);
				$fcountg_eg1 = $fcountg_eg + 1;
				$fendg_eg = end($fgreater_eg);
				$ffl_eg = $fless_eg[0];
				$this->param['fcountg_eg'] = $fcountg_eg;
				$this->param['fendg_eg'] = $fendg_eg;
				$this->param['ffl_eg'] = $ffl_eg;
				$this->param['fcountg_eg1'] = $fcountg_eg1;
			}
			if (!empty($h_fib)) {
				$fplus_h = $h_fib;
				$findex_h = $fplus_h + 1;
				$this->param['findex_h'] = $findex_h;
			} else if (empty($h_fib)) {
				foreach ($arr as  $value11) {
					if ($answer_h > $value11) {
						$fgreater_h[] = $value11;
					} else if ($answer_h < $value11) {
						$fless_h[] = $value11;
					}
				}
				$fcountg_h = count($fgreater_h);
				$fcountg_h1 = $fcountg_h + 1;
				$fendg_h = end($fgreater_h);
				$ffl_h = $fless_h[0];
				$this->param['fcountg_h'] = $fcountg_h;
				$this->param['fendg_h'] = $fendg_h;
				$this->param['ffl_h'] = $ffl_h;
				$this->param['fcountg_h1'] = $fcountg_h1;
			}
		} else {
			$this->param['error'] = "Please enter A-Z.";
			return $this->param;
		}
		// } else {
		// 	$this->param['error'] = "Please! Enter Your Input";
		// 	return $this->param;
		// }
		$this->param['answer_eo'] = $answer_eo;
		$this->param['answer_fr'] = $answer_fr;
		$this->param['answer_ro'] = $answer_ro;
		$this->param['answer_rfd'] = $answer_rfd;
		$this->param['answer_jg'] = $answer_jg;
		$this->param['answer_eg'] = $answer_eg;
		$this->param['answer_h'] = $answer_h;
		$this->param['count_ans'] = $count_ans;
		$this->param['words_ans'] = $words_ans;
		$this->param['input'] = $input;
		$this->param['final_ans'] = $final_ans;
		$this->param['final_ans2'] = $final_ans2;
		$this->param['final_ans3'] = $final_ans3;
		$this->param['final_ans4'] = $final_ans4;
		$this->param['final_ans5'] = $final_ans5;
		$this->param['final_ans6'] = $final_ans6;
		$this->param['final_ans7'] = $final_ans7;
		$this->param['eo_divi'] = $eo_divi;
		$this->param['count_eodivi'] = $count_eodivi;
		$this->param['fr_divi'] = $fr_divi;
		$this->param['count_frdivi'] = $count_frdivi;
		$this->param['ro_divi'] = $ro_divi;
		$this->param['count_rodivi'] = $count_rodivi;
		$this->param['rfd_divi'] = $rfd_divi;
		$this->param['count_rfddivi'] = $count_rfddivi;
		$this->param['jg_divi'] = $jg_divi;
		$this->param['count_jgdivi'] = $count_jgdivi;
		$this->param['eg_divi'] = $eg_divi;
		$this->param['count_egdivi'] = $count_egdivi;
		$this->param['h_divi'] = $h_divi;
		$this->param['count_hdivi'] = $count_hdivi;
		$this->param['eodivi_sum'] = $eodivi_sum;
		$this->param['frdivi_sum'] = $frdivi_sum;
		$this->param['rodivi_sum'] = $rodivi_sum;
		$this->param['rfddivi_sum'] = $rfddivi_sum;
		$this->param['jgdivi_sum'] = $jgdivi_sum;
		$this->param['egdivi_sum'] = $egdivi_sum;
		$this->param['hdivi_sum'] = $hdivi_sum;
		$this->param['newtext_eo'] = $newtext_eo;
		$this->param['newtext_fr'] = $newtext_fr;
		$this->param['newtext_ro'] = $newtext_ro;
		$this->param['newtext_rfd'] = $newtext_rfd;
		$this->param['newtext_jg'] = $newtext_jg;
		$this->param['newtext_eg'] = $newtext_eg;
		$this->param['newtext_h'] = $newtext_h;
		$this->param['apeo_p'] = $apeo_p;
		$this->param['apeo_n'] = $apeo_n;
		$this->param['apfr_p'] = $apfr_p;
		$this->param['apfr_n'] = $apfr_n;
		$this->param['apro_p'] = $apro_p;
		$this->param['apro_n'] = $apro_n;
		$this->param['aprfd_p'] = $aprfd_p;
		$this->param['aprfd_n'] = $aprfd_n;
		$this->param['apjg_p'] = $apjg_p;
		$this->param['apjg_n'] = $apjg_n;
		$this->param['apeg_p'] = $apeg_p;
		$this->param['apeg_n'] = $apeg_n;
		$this->param['aph_p'] = $aph_p;
		$this->param['aph_n'] = $aph_n;
		$this->param['previous_eo'] = $previous_eo;
		$this->param['next_eo'] = $next_eo;
		$this->param['previous_fr'] = $previous_fr;
		$this->param['next_fr'] = $next_fr;
		$this->param['previous_ro'] = $previous_ro;
		$this->param['next_ro'] = $next_ro;
		$this->param['previous_rfd'] = $previous_rfd;
		$this->param['next_rfd'] = $next_rfd;
		$this->param['previous_jg'] = $previous_jg;
		$this->param['next_jg'] = $next_jg;
		$this->param['previous_eg'] = $previous_eg;
		$this->param['next_eg'] = $next_eg;
		$this->param['previous_h'] = $previous_h;
		$this->param['next_h'] = $next_h;
		$this->param['check_eo'] = $check_eo;
		$this->param['check_fr'] = $check_fr;
		$this->param['check_ro'] = $check_ro;
		$this->param['check_rfd'] = $check_rfd;
		$this->param['check_jg'] = $check_jg;
		$this->param['check_eg'] = $check_eg;
		$this->param['check_h'] = $check_h;
		$this->param['eo'] = $eo;
		$this->param['fr'] = $fr;
		$this->param['ro'] = $ro;
		$this->param['rfd'] = $rfd;
		$this->param['jg'] = $jg;
		$this->param['eg'] = $eg;
		$this->param['h'] = $h;
		$this->param['dosra_eo'] = $dosra_eo;
		$this->param['dosra_fr'] = $dosra_fr;
		$this->param['dosra_ro'] = $dosra_ro;
		$this->param['dosra_rfd'] = $dosra_rfd;
		$this->param['dosra_jg'] = $dosra_jg;
		$this->param['dosra_eg'] = $dosra_eg;
		$this->param['dosra_h'] = $dosra_h;
		$this->param['trelation_eo'] = $trelation_eo;
		$this->param['trelation_fr'] = $trelation_fr;
		$this->param['trelation_ro'] = $trelation_ro;
		$this->param['trelation_rfd'] = $trelation_rfd;
		$this->param['trelation_jg'] = $trelation_jg;
		$this->param['trelation_eg'] = $trelation_eg;
		$this->param['trelation_h'] = $trelation_h;
		$this->param['prelation_eo'] = $prelation_eo;
		$this->param['prelation_fr'] = $prelation_fr;
		$this->param['prelation_ro'] = $prelation_ro;
		$this->param['prelation_rfd'] = $prelation_rfd;
		$this->param['prelation_jg'] = $prelation_jg;
		$this->param['prelation_eg'] = $prelation_eg;
		$this->param['prelation_h'] = $prelation_h;
		$this->param['eo_fib'] = $eo_fib;
		$this->param['fr_fib'] = $fr_fib;
		$this->param['ro_fib'] = $ro_fib;
		$this->param['rfd_fib'] = $rfd_fib;
		$this->param['jg_fib'] = $jg_fib;
		$this->param['eg_fib'] = $eg_fib;
		$this->param['h_fib'] = $h_fib;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function rsd($request)
	{
		$x = $request->x;
		$form = $request->form;
		$mean = $request->mean;
		$deviation = $request->deviation;
		if ($form == 'raw') {
			if (!empty($x)) {
				$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
				while (strpos($x, ",,") !== false) {
					$x = str_replace(",,", ",", $x);
				}
				$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
					return $value !== '';
				}));
				$values = [];
				foreach ($numbers as $key => $value) {
					$values[] = trim($value);
				}
				sort($values);
				foreach ($values as $key => $value) {
					if (!is_numeric($value)) {
						$this->param['error'] = "Please! Check Your Input";
						return $this->param;
						break;
					}
				}

				$min = min($values);
				$max = max($values);
				$count = count($values);
				$sum = array_sum($values);
				$range = $max - $min;
				$mean = round($sum / $count, 5);

				if (($count % 2) != 0) {
					$center = round($count / 2);
					$median = $values[$center--];
				} else {
					$center = round($count / 2);
					$next = $center - 1;
					$median = ($values[$center] + $values[$next]) / 2;
				}
				$m_array = array_count_values($values);
				$m_max = max($m_array);
				$mode = array();
				foreach ($m_array as $key => $value) {
					if ($value == $m_max) {
						$mode[] = $key;
					}
				}
				$d = 0;
				foreach ($values as $key => $value) {
					$d = $d + pow($value - $mean, 2);
				}
				$s_d = (1 / ($count - 1)) * $d;
				$psd = (1 / ($count)) * $d;
				$pvar = $psd;
				$svar = $s_d;
				$SD = sqrt($s_d);
				$PSD = sqrt($psd);
				$rsd = ($SD / $mean) * 100;
				$this->param['rsd'] = $rsd;
				$this->param['min'] = $min;
				$this->param['max'] = $max;
				$this->param['count'] = $count;
				$this->param['sum'] = $sum;
				$this->param['range'] = $range;
				$this->param['mean'] = $mean;
				$this->param['median'] = $median;
				$this->param['mode'] = $mode;
				$this->param['SD'] = $SD;
				$this->param['PSD'] = $PSD;
				$this->param['svar'] = $svar;
				$this->param['pvar'] = $pvar;
				$this->param['form'] = $form;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else {
			if (is_numeric($mean) && is_numeric($deviation)) {
				$rsd = ($deviation / $mean) * 100;
				$this->param['rsd'] = $rsd;
				$this->param['form'] = $form;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
	}
	public function chebyshevs($request)
	{
		$operations = $request->operations;
		$first = $request->first;
		$second = $request->second;
		if ($operations == 3) {
			if ($first > 1) {
				if ($second > 1) {
					$sq = pow($first, 2);
					$f_ans = $second / $sq;
					$final_fans = number_format($f_ans, 3);
					$s_ans = $f_ans * 100;
					if ($s_ans >= 100) {
						$final_sans = "100";
					} else if ($s_ans < 100) {
						$final_sans = number_format($s_ans, 2);
					}
					$pehla = $first;
				} else {
					$this->param['error'] = "Please variance enter greater than 1";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please bound enter greater than 1.";
				return $this->param;
			}
		} else if ($operations == 4) {
			if ($first > 1) {
				if ($second > 1) {
					$sq = pow($first, 2);
					$f_ans = $first * 4;
					$aja = 1 / $sq;
					$final_fans = number_format($aja, 3);
					$s_ans = $aja * 100;
					if ($s_ans >= 100) {
						$final_sans = "100";
					} else if ($s_ans < 100) {
						$final_sans = number_format($s_ans, 2);
					}
					$pehla = $f_ans;
				} else {
					$this->param['error'] = "Please variance enter greater than 1";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please bound enter greater than 1.";
				return $this->param;
			}
		} else if ($operations == 5) {
			if ($first > 1) {
				$pehla = pow($first, 2);
				$aja = 1 / $pehla;
				$final_fans = number_format($aja, 3);
				$final_sans = 1 - $final_fans;
			} else {
				$this->param['error'] = "Please bound enter greater than 1.";
				return $this->param;
			}
		} else if ($operations == 6) {
			if ($first > 1) {
				$pehla = 1 - $first;
				$aja = 1 / $pehla;
				$final_fans = number_format($aja, 3);
				if ($aja >= 0) {
					$final_sans = sqrt($aja);
				} else if ($aja < 0) {
					$final_sans = "NaN";
				}
			} else {
				$this->param['error'] = "Please bound enter greater than 1.";
				return $this->param;
			}
		}
		$this->param['operations'] = $operations;
		$this->param['pehla'] = $pehla;
		$this->param['final_fans'] = $final_fans;
		$this->param['final_sans'] = $final_sans;
		$this->param['RESULT'] = 1;

		return $this->param;
	}

	public function box($request)
	{
		$x = $request->x;
		$seprate = $request->seprate;
		function quartil($arr)
		{
			$count = count($arr);
			$middleval = floor(($count - 1) / 2);
			if ($count % 2) {
				$median = $arr[$middleval];
			} else {
				$low = $arr[$middleval];
				$high = $arr[$middleval + 1];
				$median = (($low + $high) / 2);
			}
			return number_format((float)$median, 1, '.', '');
		}
		if (empty($x)) {
			$check = false;
		}
		if (empty($seprate)) {
			$seprate = ' ';
		}
		$check = true;
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			sort($numbers);
			if (count($numbers) < 2) {
				$this->param['error'] = "Please! enter 2 or more numbers";
				return $this->param;
			}
			$maximum = max($numbers);
			$minimum = min($numbers);
			$second = quartil($numbers);
			$tmp = array();
			foreach ($numbers as $key => $val) {
				if ($val > $second) {
					$tmp['third'][] = $val;
				} else if ($val < $second) {
					$tmp['first'][] = $val;
				}
			}
			$first = quartil($tmp['first']);
			$third = quartil($tmp['third']);
			$count = count($numbers);
			if (($count % 2) != 0) {
				$center = round($count / 2);
				$median = $numbers[$center--];
			} else {
				$center = round($count / 2);
				$next = $center - 1;
				$median = ($numbers[$center] + $numbers[$next]) / 2;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['numbers'] = $numbers;
		$this->param['count'] = count($numbers);
		$this->param['third'] = $third;
		$this->param['first'] = $first;
		$this->param['median'] = $median;
		$this->param['maximum'] = $maximum;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function bin_cof($request)
	{
		$n = $request->n;
		$k = $request->k;
		if (is_numeric($n) && is_numeric($k)) {
			if ($k > $n) {
				$this->param['error'] = "n must be larger than or equal to k";
				return $this->param;
			}
			function factorial($n)
			{
				if ($n <= 1) {
					return 1;
				} else {
					try {
						$fact = gmp_fact($n);
						return gmp_strval($fact);
					} catch (\Exception $r) {
						return false;
					}
				}
			}
			if (factorial($n) && factorial($k)) {
				$ans = factorial($n) / (factorial($k) * factorial($n - $k));
				$this->param['ans'] = $ans;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Try a small number";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function per_rank($request)
	{
		$x = $request->x;
		$find = $request->find;
		$method = $request->method;
		if (!empty($x) && is_numeric($find)) {
			$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
			while (strpos($x, ",,") !== false) {
				$x = str_replace(",,", ",", $x);
			}
			$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
				return $value !== '';
			}));
			$values = [];
			$isNum = true;
			foreach ($numbers as $key => $value) {
				if (is_numeric(trim($value))) {
					$values[] = trim($value);
				} else {
					$isNum = false;
					break;
				}
			}
			if ($isNum == true) {
				$count = 0;
				$same = 0;
				sort($values);
				foreach ($values as $key => $value) {
					if ($value <= $find) {
						$count++;
					}
					if ($value == $find) {
						$same++;
					}
				}
				if ($method == 1) {
					$pr = ($count / count($values)) * 100;
				} else {
					$pr = (($count - 0.5 * $same) / count($values)) * 100;
				}
				$this->param['pr'] = $pr;
				$this->param['same'] = $same;
				$this->param['count'] = $count;
				$this->param['find'] = $find;
				$this->param['values'] = $values;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Enter only numbers";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function coin($request)
	{
		$flips = $request->flips;
		$heads = $request->heads;
		$probablity = $request->probablity;
		$type = $request->type;
		function factorial($num)
		{
			$factorial = 1;
			for ($x = $num; $x >= 1; $x--) {
				$factorial = $factorial * $x;
			}
			return $factorial;
		}
		function total_calculation($flips, $heads, $probablity2)
		{
			$sub2 = $flips - $heads;
			$f4 = factorial($flips);
			$f5 = factorial($heads);
			$f6 = factorial($sub2);
			$power = pow($probablity2, $heads);
			$power2 = pow(1 - $probablity2, $sub2);
			$ans2 = ($f4 / ($f5 * $f6)) * $power * $power2;
			return $ans2;
		}
		if ($type == "1") {
			if (is_numeric($flips) && is_numeric($heads) && is_numeric($probablity)) {
				if ($flips >= $heads) {
					if ($flips > 0 && $heads > 0) {
						if ($probablity >= 0 && $probablity <= 1) {
							$num = $flips;
							$num2 = $heads;
							$sub = $flips - $heads;
							$f1 = factorial($num);
							$f2 = factorial($num2);
							$f3 = factorial($sub);
							$power_p = pow($probablity, $heads);
							$power_p2 = pow(1 - $probablity, $sub);
							$ans = ($f1 / ($f2 * $f3)) * $power_p * $power_p2;
						} else {
							$this->param['error'] = "Probablity must be between 0 and 1 inclusive";
							return $this->param;
						}
					} else {
						$this->param['error'] = "Enter Value Greater than zero";
						return $this->param;
					}
				} else {
					$this->param['error'] = "The number of obtained heads cannot be greater than the number of tosses.";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($type == "2") {
			if (is_numeric($flips) && is_numeric($heads) && is_numeric($probablity)) {
				if ($flips >= $heads) {
					if ($flips >= 0 && $heads >= 0) {
						if ($probablity >= 0 && $probablity <= 1) {
							$num = $flips;
							$num2 = $heads;
							$sub = $flips - $heads;
							$f1 = factorial($num);
							$f2 = factorial($num2);
							$f3 = factorial($sub);
							$power_p = pow($probablity, $heads);
							$power_p2 = pow(1 - $probablity, $sub);
							$ans = ($f1 / ($f2 * $f3)) * $power_p * $power_p2;
							$heading = $heads + 1;
							for ($i = $heading; $i <= $flips; $i++) {
								$awa[] = total_calculation($flips, $heading, $probablity);
								$heading = $heading + 1;
								$summer = array_sum($awa);
							}
							$this->param['array_awa'] = $awa;
							$this->param['summer'] = $summer;
						} else {
							$this->param['error'] = "Probablity must be between 0 and 1 inclusive";
							return $this->param;
						}
					} else {
						$this->param['error'] = "Enter Value Greater than zero";
						return $this->param;
					}
				} else {
					$this->param['error'] = "The number of obtained heads cannot be greater than the number of tosses.";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($type == "3") {
			if (is_numeric($flips) && is_numeric($heads) && is_numeric($probablity)) {
				if ($flips >= $heads) {
					if ($flips >= 0 && $heads >= 0) {
						if ($probablity >= 0 && $probablity <= 1) {
							$num = $flips;
							$num2 = 0;
							$sub = $flips - 0;
							$f1 = factorial($num);
							$f2 = factorial($num2);
							$f3 = factorial($sub);
							$power_p = pow($probablity, $num2);
							$power_p2 = pow(1 - $probablity, $sub);
							$ans = ($f1 / ($f2 * $f3)) * $power_p * $power_p2;
							$heading = $heads + 1;
							for ($i = 0; $i <= $heads; $i++) {
								$awa[] = total_calculation($flips, $i, $probablity);
								$heading = $heading + 1;
								$summer = array_sum($awa);
							}
							$this->param['array_awa'] = $awa;
							$this->param['summer'] = $summer;
						} else {
							$this->param['error'] = "Probablity must be between 0 and 1 inclusive";
							return $this->param;
						}
					} else {
						$this->param['error'] = "Enter Value Greater than zero";
						return $this->param;
					}
				} else {
					$this->param['error'] = "The number of obtained heads cannot be greater than the number of tosses.";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
		$this->param['type'] = $type;
		$this->param['flips'] = $flips;
		$this->param['heads'] = $heads;
		$this->param['probablity'] = $probablity;
		$this->param['ans'] = $ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function z_score($request)
	{
		$z_score_table = [
			'-3.9' => [9 => 0.00003, 8 => 0.00003, 7 => 0.00004, 6 => 0.00004, 5 => 0.00004, 4 => 0.00004, 3 => 0.00004, 2 => 0.00004, 1 => 0.00005, 0 => 0.00005],
			'-3.8' => [9 => 0.00005, 8 => 0.00005, 7 => 0.00005, 6 => 0.00006, 5 => 0.00006, 4 => 0.00006, 3 => 0.00006, 2 => 0.00007, 1 => 0.00007, 0 => 0.00007],
			'-3.7' => [9 => 0.00008, 8 => 0.00008, 7 => 0.00008, 6 => 0.00008, 5 => 0.00009, 4 => 0.00009, 3 => 0.00010, 2 => 0.00010, 1 => 0.00010, 0 => 0.00011],
			'-3.6' => [9 => 0.00011, 8 => 0.00012, 7 => 0.00012, 6 => 0.00013, 5 => 0.00013, 4 => 0.00014, 3 => 0.00014, 2 => 0.00015, 1 => 0.00015, 0 => 0.00016],
			'-3.5' => [9 => 0.00017, 8 => 0.00017, 7 => 0.00018, 6 => 0.00019, 5 => 0.00019, 4 => 0.00020, 3 => 0.00021, 2 => 0.00022, 1 => 0.00022, 0 => 0.00023],
			'-3.4' => [9 => 0.00024, 8 => 0.00025, 7 => 0.00026, 6 => 0.00027, 5 => 0.00028, 4 => 0.00029, 3 => 0.00030, 2 => 0.00031, 1 => 0.00032, 0 => 0.00034],
			'-3.3' => [9 => 0.00035, 8 => 0.00036, 7 => 0.00038, 6 => 0.00039, 5 => 0.00040, 4 => 0.00042, 3 => 0.00043, 2 => 0.00045, 1 => 0.00047, 0 => 0.00048],
			'-3.2' => [9 => 0.00050, 8 => 0.00052, 7 => 0.00054, 6 => 0.00056, 5 => 0.00058, 4 => 0.00060, 3 => 0.00062, 2 => 0.00064, 1 => 0.00066, 0 => 0.00069],
			'-3.1' => [9 => 0.00071, 8 => 0.00074, 7 => 0.00076, 6 => 0.00079, 5 => 0.00082, 4 => 0.00084, 3 => 0.00087, 2 => 0.00090, 1 => 0.00094, 0 => 0.00097],
			'-3.0' => [9 => 0.00100, 8 => 0.00104, 7 => 0.00107, 6 => 0.00111, 5 => 0.00114, 4 => 0.00118, 3 => 0.00122, 2 => 0.00126, 1 => 0.00131, 0 => 0.00135],
			'-2.9' => [9 => 0.00139, 8 => 0.00144, 7 => 0.00149, 6 => 0.00154, 5 => 0.00159, 4 => 0.00164, 3 => 0.00169, 2 => 0.00175, 1 => 0.00181, 0 => 0.00187],
			'-2.8' => [9 => 0.00193, 8 => 0.00199, 7 => 0.00205, 6 => 0.00212, 5 => 0.00219, 4 => 0.00226, 3 => 0.00233, 2 => 0.00240, 1 => 0.00248, 0 => 0.00256],
			'-2.7' => [9 => 0.00264, 8 => 0.00272, 7 => 0.00280, 6 => 0.00289, 5 => 0.00298, 4 => 0.00307, 3 => 0.00317, 2 => 0.00326, 1 => 0.00336, 0 => 0.00347],
			'-2.6' => [9 => 0.00357, 8 => 0.00368, 7 => 0.00379, 6 => 0.00391, 5 => 0.00402, 4 => 0.00415, 3 => 0.00427, 2 => 0.00440, 1 => 0.00453, 0 => 0.00466],
			'-2.5' => [9 => 0.00480, 8 => 0.00494, 7 => 0.00508, 6 => 0.00523, 5 => 0.00539, 4 => 0.00554, 3 => 0.00570, 2 => 0.00587, 1 => 0.00604, 0 => 0.00621],
			'-2.4' => [9 => 0.00639, 8 => 0.00657, 7 => 0.00676, 6 => 0.00695, 5 => 0.00714, 4 => 0.00734, 3 => 0.00755, 2 => 0.00776, 1 => 0.00798, 0 => 0.00820],
			'-2.3' => [9 => 0.00842, 8 => 0.00866, 7 => 0.00889, 6 => 0.00914, 5 => 0.00939, 4 => 0.00964, 3 => 0.00990, 2 => 0.01017, 1 => 0.01044, 0 => 0.01072],
			'-2.2' => [9 => 0.01101, 8 => 0.01130, 7 => 0.01160, 6 => 0.01191, 5 => 0.01222, 4 => 0.01255, 3 => 0.01287, 2 => 0.01321, 1 => 0.01355, 0 => 0.01390],
			'-2.1' => [9 => 0.01426, 8 => 0.01463, 7 => 0.01500, 6 => 0.01539, 5 => 0.01578, 4 => 0.01618, 3 => 0.01659, 2 => 0.01700, 1 => 0.01743, 0 => 0.01786],
			'-2.0' => [9 => 0.01831, 8 => 0.01876, 7 => 0.01923, 6 => 0.01970, 5 => 0.02018, 4 => 0.02068, 3 => 0.02118, 2 => 0.02169, 1 => 0.02222, 0 => 0.02275],
			'-1.9' => [9 => 0.02330, 8 => 0.02385, 7 => 0.02442, 6 => 0.02500, 5 => 0.02559, 4 => 0.02619, 3 => 0.02680, 2 => 0.02743, 1 => 0.02807, 0 => 0.02872],
			'-1.8' => [9 => 0.02938, 8 => 0.03005, 7 => 0.03074, 6 => 0.03144, 5 => 0.03216, 4 => 0.03288, 3 => 0.03362, 2 => 0.03438, 1 => 0.03515, 0 => 0.03593],
			'-1.7' => [9 => 0.03673, 8 => 0.03754, 7 => 0.03836, 6 => 0.03920, 5 => 0.04006, 4 => 0.04093, 3 => 0.04182, 2 => 0.04272, 1 => 0.04363, 0 => 0.04457],
			'-1.6' => [9 => 0.04551, 8 => 0.04648, 7 => 0.04746, 6 => 0.04846, 5 => 0.04947, 4 => 0.05050, 3 => 0.05155, 2 => 0.05262, 1 => 0.05370, 0 => 0.05480],
			'-1.5' => [9 => 0.0559, 8 => 0.0571, 7 => 0.0582, 6 => 0.0594, 5 => 0.0606, 4 => 0.0618, 3 => 0.0630, 2 => 0.0643, 1 => 0.0655, 0 => 0.0668],
			'-1.4' => [9 => 0.0681, 8 => 0.0694, 7 => 0.0708, 6 => 0.0721, 5 => 0.0735, 4 => 0.0749, 3 => 0.0764, 2 => 0.0778, 1 => 0.0793, 0 => 0.0808],
			'-1.3' => [9 => 0.0823, 8 => 0.0838, 7 => 0.0853, 6 => 0.0869, 5 => 0.0885, 4 => 0.0901, 3 => 0.0918, 2 => 0.0934, 1 => 0.0951, 0 => 0.0968],
			'-1.2' => [9 => 0.0985, 8 => 0.1003, 7 => 0.1020, 6 => 0.1038, 5 => 0.1056, 4 => 0.1075, 3 => 0.1093, 2 => 0.1112, 1 => 0.1131, 0 => 0.1151],
			'-1.1' => [9 => 0.1170, 8 => 0.1190, 7 => 0.1210, 6 => 0.1230, 5 => 0.1251, 4 => 0.1271, 3 => 0.1292, 2 => 0.1314, 1 => 0.1335, 0 => 0.1357],
			'-1.0' => [9 => 0.1379, 8 => 0.1401, 7 => 0.1423, 6 => 0.1446, 5 => 0.1469, 4 => 0.1492, 3 => 0.1515, 2 => 0.1539, 1 => 0.1562, 0 => 0.1587],
			'-0.9' => [9 => 0.1611, 8 => 0.1635, 7 => 0.1660, 6 => 0.1685, 5 => 0.1711, 4 => 0.1736, 3 => 0.1762, 2 => 0.1788, 1 => 0.1814, 0 => 0.1841],
			'-0.8' => [9 => 0.1867, 8 => 0.1894, 7 => 0.1922, 6 => 0.1949, 5 => 0.1977, 4 => 0.2005, 3 => 0.2033, 2 => 0.2061, 1 => 0.2090, 0 => 0.2119],
			'-0.7' => [9 => 0.2148, 8 => 0.2177, 7 => 0.2206, 6 => 0.2236, 5 => 0.2266, 4 => 0.2296, 3 => 0.2327, 2 => 0.2358, 1 => 0.2389, 0 => 0.2420],
			'-0.6' => [9 => 0.2451, 8 => 0.2483, 7 => 0.2514, 6 => 0.2546, 5 => 0.2578, 4 => 0.2611, 3 => 0.2643, 2 => 0.2676, 1 => 0.2709, 0 => 0.2743],
			'-0.5' => [9 => 0.2776, 8 => 0.2810, 7 => 0.2843, 6 => 0.2877, 5 => 0.2912, 4 => 0.2946, 3 => 0.2981, 2 => 0.3015, 1 => 0.3050, 0 => 0.3085],
			'-0.4' => [9 => 0.3121, 8 => 0.3156, 7 => 0.3192, 6 => 0.3228, 5 => 0.3264, 4 => 0.3300, 3 => 0.3336, 2 => 0.3372, 1 => 0.3409, 0 => 0.3446],
			'-0.3' => [9 => 0.3483, 8 => 0.3520, 7 => 0.3557, 6 => 0.3594, 5 => 0.3632, 4 => 0.3669, 3 => 0.3707, 2 => 0.3745, 1 => 0.3783, 0 => 0.3821],
			'-0.2' => [9 => 0.3829, 8 => 0.3897, 7 => 0.3936, 6 => 0.3974, 5 => 0.4013, 4 => 0.4052, 3 => 0.4090, 2 => 0.4129, 1 => 0.4168, 0 => 0.4207],
			'-0.1' => [9 => 0.4247, 8 => 0.4286, 7 => 0.4325, 6 => 0.4364, 5 => 0.4404, 4 => 0.4443, 3 => 0.4483, 2 => 0.4522, 1 => 0.4562, 0 => 0.4602],
			'-0.0' => [9 => 0.4641, 8 => 0.4681, 7 => 0.4721, 6 => 0.4761, 5 => 0.4801, 4 => 0.4840, 3 => 0.4880, 2 => 0.4920, 1 => 0.4960, 0 => 0.5000],
			'0.0' => [0 => 0.50000, 1 => 0.50399, 2 => 0.50798, 3 => 0.51197, 4 => 0.51595, 5 => 0.51994, 6 => 0.52392, 7 => 0.52790, 8 => 0.53188, 9 => 0.53586],
			'0.1' => [0 => 0.53980, 1 => 0.54380, 2 => 0.54776, 3 => 0.55172, 4 => 0.55567, 5 => 0.55966, 6 => 0.56360, 7 => 0.56749, 8 => 0.57142, 9 => 0.57535],
			'0.2' => [0 => 0.57930, 1 => 0.58317, 2 => 0.58706, 3 => 0.59095, 4 => 0.59483, 5 => 0.59871, 6 => 0.60257, 7 => 0.60642, 8 => 0.61026, 9 => 0.61409],
			'0.3' => [0 => 0.61791, 1 => 0.62172, 2 => 0.62552, 3 => 0.62930, 4 => 0.63307, 5 => 0.63683, 6 => 0.64058, 7 => 0.64431, 8 => 0.64803, 9 => 0.65173],
			'0.4' => [0 => 0.65542, 1 => 0.65910, 2 => 0.66276, 3 => 0.66640, 4 => 0.67003, 5 => 0.67364, 6 => 0.67724, 7 => 0.68082, 8 => 0.68439, 9 => 0.68793],
			'0.5' => [0 => 0.69146, 1 => 0.69497, 2 => 0.69847, 3 => 0.70194, 4 => 0.70540, 5 => 0.70884, 6 => 0.71226, 7 => 0.71566, 8 => 0.71904, 9 => 0.72240],
			'0.6' => [0 => 0.72575, 1 => 0.72907, 2 => 0.73237, 3 => 0.73565, 4 => 0.73891, 5 => 0.74215, 6 => 0.74537, 7 => 0.74857, 8 => 0.75175, 9 => 0.75490],
			'0.7' => [0 => 0.75804, 1 => 0.76115, 2 => 0.76424, 3 => 0.76730, 4 => 0.77035, 5 => 0.77337, 6 => 0.77637, 7 => 0.77935, 8 => 0.78230, 9 => 0.78524],
			'0.8' => [0 => 0.78814, 1 => 0.79103, 2 => 0.79389, 3 => 0.79673, 4 => 0.79955, 5 => 0.80234, 6 => 0.80511, 7 => 0.80785, 8 => 0.81057, 9 => 0.81327],
			'0.9' => [0 => 0.81594, 1 => 0.81859, 2 => 0.82121, 3 => 0.82381, 4 => 0.82639, 5 => 0.82894, 6 => 0.83147, 7 => 0.83398, 8 => 0.83646, 9 => 0.83891],
			'1.0' => [0 => 0.84134, 1 => 0.84375, 2 => 0.84614, 3 => 0.84849, 4 => 0.85083, 5 => 0.85314, 6 => 0.85543, 7 => 0.85769, 8 => 0.85993, 9 => 0.86214],
			'1.1' => [0 => 0.86433, 1 => 0.86650, 2 => 0.86864, 3 => 0.87076, 4 => 0.87286, 5 => 0.87493, 6 => 0.87698, 7 => 0.87900, 8 => 0.88100, 9 => 0.88298],
			'1.2' => [0 => 0.88493, 1 => 0.88686, 2 => 0.88877, 3 => 0.89065, 4 => 0.89251, 5 => 0.89435, 6 => 0.89617, 7 => 0.89796, 8 => 0.89973, 9 => 0.90147],
			'1.3' => [0 => 0.90320, 1 => 0.90490, 2 => 0.90658, 3 => 0.90824, 4 => 0.90988, 5 => 0.91149, 6 => 0.91308, 7 => 0.91466, 8 => 0.91621, 9 => 0.91774],
			'1.4' => [0 => 0.91924, 1 => 0.92073, 2 => 0.92220, 3 => 0.92364, 4 => 0.92507, 5 => 0.92647, 6 => 0.92785, 7 => 0.92922, 8 => 0.93056, 9 => 0.93189],
			'1.5' => [0 => 0.93319, 1 => 0.93448, 2 => 0.93574, 3 => 0.93699, 4 => 0.93822, 5 => 0.93943, 6 => 0.94062, 7 => 0.94179, 8 => 0.94295, 9 => 0.94408],
			'1.6' => [0 => 0.94520, 1 => 0.94630, 2 => 0.94738, 3 => 0.94845, 4 => 0.94950, 5 => 0.95053, 6 => 0.95154, 7 => 0.95254, 8 => 0.95352, 9 => 0.95449],
			'1.7' => [0 => 0.95543, 1 => 0.95637, 2 => 0.95728, 3 => 0.95818, 4 => 0.95907, 5 => 0.95994, 6 => 0.96080, 7 => 0.96164, 8 => 0.96246, 9 => 0.96327],
			'1.8' => [0 => 0.96407, 1 => 0.96485, 2 => 0.96562, 3 => 0.96638, 4 => 0.96712, 5 => 0.96784, 6 => 0.96856, 7 => 0.96926, 8 => 0.96995, 9 => 0.97062],
			'1.9' => [0 => 0.97128, 1 => 0.97193, 2 => 0.97257, 3 => 0.97320, 4 => 0.97381, 5 => 0.97441, 6 => 0.97500, 7 => 0.97558, 8 => 0.97615, 9 => 0.97670],
			'2.0' => [0 => 0.97725, 1 => 0.97778, 2 => 0.97831, 3 => 0.97882, 4 => 0.97932, 5 => 0.97982, 6 => 0.98030, 7 => 0.98077, 8 => 0.98124, 9 => 0.98169],
			'2.1' => [0 => 0.98214, 1 => 0.98257, 2 => 0.98300, 3 => 0.98341, 4 => 0.98382, 5 => 0.98422, 6 => 0.98461, 7 => 0.98500, 8 => 0.98537, 9 => 0.98574],
			'2.2' => [0 => 0.98610, 1 => 0.98645, 2 => 0.98679, 3 => 0.98713, 4 => 0.98745, 5 => 0.98778, 6 => 0.98809, 7 => 0.98840, 8 => 0.98870, 9 => 0.98899],
			'2.3' => [0 => 0.98928, 1 => 0.98956, 2 => 0.98983, 3 => 0.99010, 4 => 0.99036, 5 => 0.99061, 6 => 0.99086, 7 => 0.99111, 8 => 0.99134, 9 => 0.99158],
			'2.4' => [0 => 0.99180, 1 => 0.99202, 2 => 0.99224, 3 => 0.99245, 4 => 0.99266, 5 => 0.99286, 6 => 0.99305, 7 => 0.99324, 8 => 0.99343, 9 => 0.99361],
			'2.5' => [0 => 0.99379, 1 => 0.99396, 2 => 0.99413, 3 => 0.99430, 4 => 0.99446, 5 => 0.99461, 6 => 0.99477, 7 => 0.99492, 8 => 0.99506, 9 => 0.99520],
			'2.6' => [0 => 0.99534, 1 => 0.99547, 2 => 0.99560, 3 => 0.99573, 4 => 0.99585, 5 => 0.99598, 6 => 0.99609, 7 => 0.99621, 8 => 0.99632, 9 => 0.99643],
			'2.7' => [0 => 0.99653, 1 => 0.99664, 2 => 0.99674, 3 => 0.99683, 4 => 0.99693, 5 => 0.99702, 6 => 0.99711, 7 => 0.99720, 8 => 0.99728, 9 => 0.99736],
			'2.8' => [0 => 0.99744, 1 => 0.99752, 2 => 0.99760, 3 => 0.99767, 4 => 0.99774, 5 => 0.99781, 6 => 0.99788, 7 => 0.99795, 8 => 0.99801, 9 => 0.99807],
			'2.9' => [0 => 0.99813, 1 => 0.99819, 2 => 0.99825, 3 => 0.99831, 4 => 0.99836, 5 => 0.99841, 6 => 0.99846, 7 => 0.99851, 8 => 0.99856, 9 => 0.99861],
			'3.0' => [0 => 0.99865, 1 => 0.99869, 2 => 0.99874, 3 => 0.99878, 4 => 0.99882, 5 => 0.99886, 6 => 0.99889, 7 => 0.99893, 8 => 0.99896, 9 => 0.99900],
			'3.1' => [0 => 0.99903, 1 => 0.99906, 2 => 0.99910, 3 => 0.99913, 4 => 0.99916, 5 => 0.99918, 6 => 0.99921, 7 => 0.99924, 8 => 0.99926, 9 => 0.99929],
			'3.2' => [0 => 0.99931, 1 => 0.99934, 2 => 0.99936, 3 => 0.99938, 4 => 0.99940, 5 => 0.99942, 6 => 0.99944, 7 => 0.99946, 8 => 0.99948, 9 => 0.99950],
			'3.3' => [0 => 0.99952, 1 => 0.99953, 2 => 0.99955, 3 => 0.99957, 4 => 0.99958, 5 => 0.99960, 6 => 0.99961, 7 => 0.99962, 8 => 0.99964, 9 => 0.99965],
			'3.4' => [0 => 0.99966, 1 => 0.99968, 2 => 0.99969, 3 => 0.99970, 4 => 0.99971, 5 => 0.99972, 6 => 0.99973, 7 => 0.99974, 8 => 0.99975, 9 => 0.99976],
			'3.5' => [0 => 0.99977, 1 => 0.99978, 2 => 0.99978, 3 => 0.99979, 4 => 0.99980, 5 => 0.99981, 6 => 0.99981, 7 => 0.99982, 8 => 0.99983, 9 => 0.99983],
			'3.6' => [0 => 0.99984, 1 => 0.99985, 2 => 0.99985, 3 => 0.99986, 4 => 0.99986, 5 => 0.99987, 6 => 0.99987, 7 => 0.99988, 8 => 0.99988, 9 => 0.99989],
			'3.7' => [0 => 0.99989, 1 => 0.99990, 2 => 0.99990, 3 => 0.99990, 4 => 0.99991, 5 => 0.99991, 6 => 0.99992, 7 => 0.99992, 8 => 0.99992, 9 => 0.99992],
			'3.8' => [0 => 0.99993, 1 => 0.99993, 2 => 0.99993, 3 => 0.99994, 4 => 0.99994, 5 => 0.99994, 6 => 0.99994, 7 => 0.99995, 8 => 0.99995, 9 => 0.99995],
			'3.9' => [0 => 0.99995, 1 => 0.99995, 2 => 0.99996, 3 => 0.99996, 4 => 0.99996, 5 => 0.99996, 6 => 0.99996, 7 => 0.99996, 8 => 0.99997, 9 => 0.99997],
			'4.0' => [0 => 0.99997, 1 => 0.99997, 2 => 0.99997, 3 => 0.99997, 4 => 0.99997, 5 => 0.99997, 6 => 0.99998, 7 => 0.99998, 8 => 0.99998, 9 => 0.99998],

		];

		$z_score = trim($request->z_score);

		function is_decimal($val)
		{
			return is_numeric($val) && floor($val) != $val;
		}

		if (is_numeric($z_score)) {
			$score = round($z_score, 1);
			$inner_score = round($z_score, 2);
			if (is_decimal($inner_score)) {
				if (($z_score >= (-3.9)) && ($z_score <= (4.0))) {
					$mera_jawab = explode(".", $inner_score);
					if (strlen($mera_jawab[1]) > 1) {
						$main_jawab = substr($mera_jawab[1], -1);
					} else {
						$main_jawab = "0";
					}
					$res_val = $z_score_table["$score"]["$main_jawab"];
				} else {
					if (($z_score < (-3.9))) {
						$res_val = "0";
					} elseif (($z_score > (4.0))) {
						$res_val = "1";
					}
				}
			} else {
				$z_score = $z_score . ".0";
				if (($z_score >= (-3.9)) && ($z_score <= (4.0))) {
					$mera_jawab = explode(".", $z_score);
					if (strlen($mera_jawab[1]) > 1) {
						$main_jawab = substr($mera_jawab[1], -1);
					} else {
						$main_jawab = "0";
					}
					$res_val = $z_score_table["$z_score"]["$main_jawab"];
				} else {
					if (($z_score < (-3.9))) {
						$res_val = "0";
					} elseif (($z_score > (4.0))) {
						$res_val = "1";
					}
				}
			}


			if ($score <= -3.8) {
				$img = "-3.5 equal & above.png";
			} elseif ($score == -3.7) {
				$img = "-3.5 equal & above.png";
			} elseif ($score == -3.6) {

				$img = "-3.5 equal & above.png";
			} elseif ($score == -3.5) {

				$img = "-3.5 equal & above.png";
			} elseif ($score == -3.4) {

				$img = "-3.4.png";
			} elseif ($score == -3.3) {

				$img = "-3.3.png";
			} elseif ($score == -3.2) {

				$img = "-3.2.png";
			} elseif ($score == -3.1) {

				$img = "-3.1.png";
			} elseif ($score == -3) {

				$img = "-3.0.png";
			} elseif ($score == -2.9) {

				$img = "-2.9.png";
			} elseif ($score == -2.8) {

				$img = "-2.8.png";
			} elseif ($score == -2.7) {

				$img = "-2.7.png";
			} elseif ($score == -2.6) {

				$img = "-2.6.png";
			} elseif ($score == -2.5) {

				$img = "-2.5.png";
			} elseif ($score == -2.4) {

				$img = "-2.4.png";
			} elseif ($score == -2.3) {

				$img = "-2.3.png";
			} elseif ($score == -2.2) {

				$img = "-2.2.png";
			} elseif ($score == -2.1) {

				$img = "-2.1.png";
			} elseif ($score == -2) {

				$img = "-2.0.png";
			} elseif ($score == -1.9) {

				$img = "-1.9.png";
			} elseif ($score == -1.8) {

				$img = "-1.8.png";
			} elseif ($score == -1.7) {

				$img = "-1.7.png";
			} elseif ($score == -1.6) {

				$img = "-1.6.png";
			} elseif ($score == -1.5) {

				$img = "-1.5.png";
			} elseif ($score == -1.4) {

				$img = "-1.4.png";
			} elseif ($score == -1.3) {

				$img = "-1.3.png";
			} elseif ($score == -1.2) {

				$img = "-1.2.png";
			} elseif ($score == -1.1) {

				$img = "-1.1.png";
			} elseif ($score == -1) {

				$img = "-1.0.png";
			} elseif ($score == -0.9) {

				$img = "-0.9.png";
			} elseif ($score == -0.8) {

				$img = "-0.8.png";
			} elseif ($score == -0.7) {

				$img = "-0.7.png";
			} elseif ($score == -0.6) {

				$img = "-0.6.png";
			} elseif ($score == -0.5) {

				$img = "-0.5.png";
			} elseif ($score == -0.4) {

				$img = "-0.4.png";
			} elseif ($score == -0.3) {

				$img = "-0.3.png";
			} elseif ($score == -0.2) {

				$img = "-0.2.png";
			} elseif ($score == -0.1) {

				$img = "-0.1.png";
			} elseif ($score == -0) {

				$img = "-0.png";
			} elseif ($score == 0) {

				$img = "0.png";
			} elseif ($score == 0.1) {

				$img = "0.1.png";
			} elseif ($score == 0.2) {

				$img = "0.2.png";
			} elseif ($score == 0.3) {

				$img = "0.3.png";
			} elseif ($score == 0.4) {

				$img = "0.4.png";
			} elseif ($score == 0.5) {

				$img = "0.5.png";
			} elseif ($score == 0.6) {

				$img = "0.6.png";
			} elseif ($score == 0.7) {

				$img = "0.7.png";
			} elseif ($score == 0.8) {

				$img = "0.8.png";
			} elseif ($score == 0.9) {

				$img = "0.9.png";
			} elseif ($score == 1) {

				$img = "1.0.png";
			} elseif ($score == 1.1) {

				$img = "1.1.png";
			} elseif ($score == 1.2) {

				$img = "1.2.png";
			} elseif ($score == 1.3) {

				$img = "1.3.png";
			} elseif ($score == 1.4) {

				$img = "1.4.png";
			} elseif ($score == 1.5) {

				$img = "1.5.png";
			} elseif ($score == 1.6) {

				$img = "1.6.png";
			} elseif ($score == 1.7) {

				$img = "1.7.png";
			} elseif ($score == 1.8) {

				$img = "1.8.png";
			} elseif ($score == 1.9) {

				$img = "1.9.png";
			} elseif ($score == 2) {

				$img = "2.0.png";
			} elseif ($score == 2.1) {

				$img = "2.1.png";
			} elseif ($score == 2.2) {

				$img = "2.2.png";
			} elseif ($score == 2.3) {

				$img = "2.3.png";
			} elseif ($score == 2.4) {

				$img = "2.4.png";
			} elseif ($score == 2.5) {

				$img = "2.5.png";
			} elseif ($score == 2.6) {

				$img = "2.6.png";
			} elseif ($score == 2.7) {

				$img = "2.7.png";
			} elseif ($score == 2.8) {

				$img = "2.8.png";
			} elseif ($score == 2.9) {

				$img = "2.9.png";
			} elseif ($score == 3) {

				$img = "3.0.png";
			} elseif ($score == 3.1) {

				$img = "3.1.png";
			} elseif ($score == 3.2) {

				$img = "3.2.png";
			} elseif ($score == 3.3) {

				$img = "3.3.png";
			} elseif ($score == 3.4) {

				$img = "3.4.png";
			} elseif ($score == 3.5) {

				$img = "3.5.png";
			} elseif ($score == 3.6) {

				$img = "3.5.png";
			} elseif ($score == 3.7) {

				$img = "3.5.png";
			} elseif ($score >= 3.8) {

				$img = "3.5.png";
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$this->param['z_score'] = $z_score;
		$this->param['score'] = $score;
		$this->param['res_val'] = $res_val;
		$this->param['img'] = $img;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function raw($request)
	{
		$mean = trim($request->mean);
		$standard_daviation = trim($request->standard_daviation);
		$z_score = trim($request->z_score);
		$type = trim($request->type);
		if (!empty($z_score)) {
			$res = $mean + $z_score * $standard_daviation;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$this->param['mean'] = $mean;
		$this->param['standard_daviation'] = $standard_daviation;
		$this->param['z_score'] = $z_score;
		$this->param['res'] = $res;
		$this->param['type'] = $type;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
        //  Effect Size Calculator
	public function effect($request)
	{
		$effect_type = trim($request->effect_type);
		$ronding = trim($request->ronding);
		$c_x1 = trim($request->c_x1);
		$c_s = trim($request->c_s);
		$c_pm = trim($request->c_pm);
		$x1 = trim($request->x1);
		$x2 = trim($request->x2);
		$n1 = trim($request->n1);
		$n2 = trim($request->n2);
		$s1 = trim($request->s1);
		$s2 = trim($request->s2);
		$p1 = trim($request->p1);
		$p2 = trim($request->p2);
		$ph_x2 = trim($request->ph_x2);
		$ph_n1 = trim($request->ph_n1);
		$cr_x2 = trim($request->cr_x2);
		$cr_n1 = trim($request->cr_n1);
		$row = trim($request->row);
		$col = trim($request->col);
		$ssr = trim($request->ssr);
		$sst = trim($request->sst);
		$ssg = trim($request->ssg);
		$et_sst = trim($request->et_sst);
		$r2f = trim($request->r2f);
		$f2r = trim($request->f2r);
		$t_value = trim($request->t_value);
		$df = trim($request->df);
		if (!empty($effect_type)) {
			if ($effect_type == 'cohen2e') {
				if (
					is_numeric($x1) && is_numeric($x2) && is_numeric($n1) && is_numeric($n2)
					&& is_numeric($s1) && is_numeric($s2)
				) {
					$s1pow = pow($s1, 2);
					$s2pow = pow($s2, 2);
					$res = ($n1 - 1) * pow($s1, 2) + ($n2 - 1) * pow($s2, 2);
					$res = ($n1 - 1) * pow($s1, 2) + ($n2 - 1) * pow($s2, 2);
					$res2 = $n1 + $n2 - 2;
					$sqr = $res / $res2;
					$sqrt = sqrt($sqr);
					$x1x2 = abs($x1 - $x2);
					$d = $x1x2 / $sqrt;
					$cohen2e = round($d, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'cohen2u') {
				if (
					is_numeric($x1) && is_numeric($x2) && is_numeric($n1) && is_numeric($n2)
					&& is_numeric($s1) && is_numeric($s2)
				) {
					$s1pow = pow($s1, 2);
					$s2pow = pow($s2, 2);
					$res = $s1pow + $s2pow;
					$sqr = $res / 2;
					$sqrt = sqrt($sqr);
					$x1x2 = abs($x1 - $x2);
					$d = abs($x1 - $x2) / $sqrt;
					$cohen2u = round($d, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'cohen') {
				if (is_numeric($c_x1) && is_numeric($c_s) && is_numeric($c_pm)) {
					$d = $c_x1 - $c_pm;
					$c = abs($d);
					$res = abs($d) / $c_s;
					$cohen = round($res, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'h') {
				if (is_numeric($p1) && is_numeric($p2)) {
					$p1sqr = sqrt($p1);
					$p2sqr = sqrt($p2);
					$arcp1 = asin($p1sqr);
					$arcp2 = asin($p2sqr);
					$res = 2 * (asin($p1sqr) - asin($p2sqr));
					$h = round($res, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'phi') {
				if (is_numeric($ph_x2) && is_numeric($ph_n1)) {
					$res = $ph_x2 / $ph_n1;
					$p = sqrt($res);
					$phi = round($p, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'cramer') {
				if (is_numeric($cr_x2) && is_numeric($cr_n1) && is_numeric($row) && is_numeric($col)) {
					$r = $row - 1;
					$c = $col - 1;
					$min = min($r, $c);
					$res = $cr_n1 * $min;
					$v = $cr_x2 / $res;
					$x = sqrt($v);
					$cramer = round($x, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'r2') {
				if (is_numeric($ssr) && is_numeric($sst)) {
					$r = $ssr / $sst;
					$res = 1 - $r;
					$f2 = $r / $res;
					$r2 = round($f2, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'eta2') {
				if (is_numeric($ssg) && is_numeric($et_sst)) {
					$et = $ssg / $et_sst;
					$res = 1 - $et;
					$e = $et / $res;
					$eta2 = round($e, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'r2f') {
				if (is_numeric($r2f)) {
					$res = 1 - $r2f;
					$r = $r2f / $res;
					$rf = round($r, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'f2r') {
				if (is_numeric($f2r)) {
					$res = 1 + $f2r;
					$f = $f2r / $res;
					$fr = round($f, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($effect_type == 'dr') {
				if (is_numeric($t_value) && is_numeric($df)) {
					$res = 2 * $t_value;
					$t = pow($t_value, 2);
					$res2 = $t + $df;
					$ry = $t / $res2;
					$ryres = sqrt($ry);
					$dfsqr = sqrt($df);
					$d = $res /   $dfsqr;
					$dr = round($d, $ronding);
					$r = round($ryres, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['effect_type'] = $effect_type;

		if ($effect_type == 'cohen2e') {
			$this->param['x1'] = $x1;
			$this->param['x2'] = $x2;
			$this->param['n1'] = $n1;
			$this->param['n2'] = $n2;
			$this->param['s1'] = $s1;
			$this->param['s2'] = $s2;
			$this->param['s1pow'] = $s1pow;
			$this->param['s2pow'] = $s2pow;
			$this->param['res'] = $res;
			$this->param['res2'] = $res2;
			$this->param['sqr'] = $sqr;
			$this->param['sqrt'] = $sqrt;
			$this->param['x1x2'] = $x1x2;
			$this->param['d'] = $d;
			$this->param['cohen2e'] = $cohen2e;
		} else if ($effect_type == 'cohen2u') {
			$this->param['x1'] = $x1;
			$this->param['x2'] = $x2;
			$this->param['n1'] = $n1;
			$this->param['n2'] = $n2;
			$this->param['s1'] = $s1;
			$this->param['s2'] = $s2;
			$this->param['s1pow'] = $s1pow;
			$this->param['s2pow'] = $s2pow;
			$this->param['res'] = $res;
			$this->param['sqr'] = $sqr;
			$this->param['sqrt'] = $sqrt;
			$this->param['x1x2'] = $x1x2;
			$this->param['d'] = $d;
			$this->param['cohen2u'] = $cohen2u;
		} else if ($effect_type == 'cohen') {
			$this->param['c_x1'] = $c_x1;
			$this->param['c_s'] = $c_s;
			$this->param['c_pm'] = $c_pm;
			$this->param['res'] = $res;
			$this->param['c'] = $c;
			$this->param['d'] = $d;
			$this->param['cohen'] = $cohen;
		} else if ($effect_type == 'h') {
			$this->param['p1'] = $p1;
			$this->param['p2'] = $p2;
			$this->param['p1sqr'] = $p1sqr;
			$this->param['p2sqr'] = $p2sqr;
			$this->param['arcp1'] = $arcp1;
			$this->param['arcp2'] = $arcp2;
			$this->param['h'] = $h;
		} else if ($effect_type == 'phi') {
			$this->param['ph_x2'] = $ph_x2;
			$this->param['ph_n1'] = $ph_n1;
			$this->param['res'] = $res;
			$this->param['p'] = $p;
			$this->param['phi'] = $phi;
		} else if ($effect_type == 'cramer') {
			$this->param['cr_x2'] = $cr_x2;
			$this->param['cr_n1'] = $cr_n1;
			$this->param['row'] = $row;
			$this->param['col'] = $col;
			$this->param['r'] = $r;
			$this->param['c'] = $c;
			$this->param['min'] = $min;
			$this->param['res'] = $res;
			$this->param['v'] = $v;
			$this->param['cramer'] = $cramer;
		} else if ($effect_type == 'r2') {
			$this->param['ssr'] = $ssr;
			$this->param['sst'] = $sst;
			$this->param['r'] = $r;
			$this->param['res'] = $res;
			$this->param['f2'] = $f2;
			$this->param['r2'] = $r2;
		} else if ($effect_type == 'eta2') {
			$this->param['ssg'] = $ssg;
			$this->param['et_sst'] = $et_sst;
			$this->param['et'] = $et;
			$this->param['res'] = $res;
			$this->param['eta2'] = $eta2;
		} else if ($effect_type == 'r2f') {
			$this->param['r2f'] = $r2f;
			$this->param['res'] = $res;
			$this->param['r'] = $r;
			$this->param['rf'] = $rf;
		} else if ($effect_type == 'f2r') {
			$this->param['f2r'] = $f2r;
			$this->param['res'] = $res;
			$this->param['f'] = $f;
			$this->param['fr'] = $fr;
		} else if ($effect_type == 'dr') {
			$this->param['t_value'] = $t_value;
			$this->param['df'] = $df;
			$this->param['res'] = $res;
			$this->param['d'] = $d;
			$this->param['dr'] = $dr;
			$this->param['dfsqr'] = $dfsqr;
			$this->param['t'] = $t;
			$this->param['res2'] = $res2;
			$this->param['ry'] = $ry;
			$this->param['r'] = $r;
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	// Pooled Variance Calculator
	public function pooled($request)
	{
		$type = trim($request->type);
		$ronding = trim($request->ronding);
		$option = trim($request->option);
		$s1 = trim($request->s1);
		$s2 = trim($request->s2);
		$n1 = trim($request->n1);
		$n2 = trim($request->n2);
		$g1 = trim($request->g1);
		$g2 = trim($request->g2);
		if (!empty($type)) {
			if ($type == 'equal') {
				if ($option == 'sum') {
					if (is_numeric($s1) && is_numeric($s2) && is_numeric($n1) && is_numeric($n2)) {
						$ps1 = pow($s1, 2);
						$ps2 = pow($s2, 2);
						$n1_1 = $n1 - 1;
						$devn1 = 1 / $n1;
						$devn2 = 1 / $n2;
						$devres = $devn1 + $devn2;
						$sqrdevres = sqrt($devres);
						$sqrdevres = round($sqrdevres, $ronding);
						$n1s1 = $n1_1 * $ps1;
						$n2_1 = $n2 - 1;
						$n2s2 = $n2_1 * $ps2;
						$res = $n1s1 + $n2s2;
						$devi = $n1 + $n2 - 2;
						$sp2  = $res / $devi;
						$sp2 = round($sp2, $ronding);
						$sqrsp2 = sqrt($sp2);
						$sqrsp2 = round($sqrsp2, $ronding);
						$sp = $sqrsp2 * $sqrdevres;
						$sp = round($sp, $ronding);
					} else {
						$this->param['error'] = "Please! Check Your Input";
						return $this->param;
					}
				} else if ($option == 'raw') {
					if (isset($g1)) {
						$check = true;
						$stdv_txt = array_map('trim', array_filter(explode(',', $g1)));
						$countn = count($stdv_txt);
						$i = 0;
						foreach ($stdv_txt as $value) {
							$i++;
							if (!is_numeric($value)) {
								$check = false;
							}
						}
						if (count($stdv_txt) < 2) {
							$check = false;
						}
						if ($check == true) {
							$sum = array_sum($stdv_txt);
							$m = round($sum / $i, 3);
							$d = 0;
							foreach ($stdv_txt as $key => $value) {
								$d = $d + pow($value - $m, 2);
							}
							if ($option === 'raw') {
								$s_d = (1 / ($i)) * $d;
								$mSym = 'x̄';
							}
							$s_d = round(sqrt($s_d), 4);
							$tablef = '';
							$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>xᵢ</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym)</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym)²</th></tr></thead><tbody>";
							$ar_2 = '';
							$arf_1 = '';
							for ($f = 0; $f < $i; $f++) {
								$ar_1 = pow(($stdv_txt[$f] - $m), 2) . ',';
								$ar_1 = str_replace(',', '', $ar_1);
								$ar_2 .= pow(($stdv_txt[$f] - $m), 2) . ',';
								$table .= '<tr class="bg-white"><td class="border p-2 text-center">' . $stdv_txt[$f] . '</td><td class="border p-2 text-center">' . ($stdv_txt[$f] - $m) . '</td><td class="border p-2 text-center">' . $ar_1 . ' </td></tr>';
								$ar_exp = explode(',', $ar_2);
								$arf_1 .= $stdv_txt[$f] . ',';
								$arf_2 = rtrim($arf_1, ',');
							}
							$ar_sum = array_sum($ar_exp);
							$table .= "<tr class='bg-gray'><th class='border p-2 text-center text-blue'>Σxᵢ = $sum </th><th class='border p-2 text-center text-blue'> </th><th class='border p-2 text-center text-blue'>Σ(xᵢ - $mSym)² = $ar_sum</th></tr></tbody></table>";
							$arf_exp = explode(',', $arf_2);
							$arf_exp1 = array_count_values($arf_exp);
							foreach ($arf_exp1 as $key => $value) {
								$tablef .= '<tr class="bg-white"><td class="border p-2 text-center">' . $key . '</td><td class="border p-2 text-center">' . $value . ' (' . ((100 / $i) * $value) . '%)</td></tr>';
							}
							$put = $i;
							$put = ($put / 100) * (1 - ($put / 100));
							$vrres = $i - 1;
							$v = $ar_sum / $vrres;
							$vsqrt = sqrt($v);
							$vsqrt = round($vsqrt, $ronding);
							$s12 = pow($vsqrt, 2);
							$ress12 = $vrres * $s12;
							$devn1 = 1 / $i;
						} else {
							$this->param['error'] = "Please! Check Your Input";
							return $this->param;
						}
					}
					if (isset($g2)) {
						$check = true;
						$stdv_txt1 = array_map('trim', array_filter(explode(',', $g2)));
						$countn1 = count($stdv_txt1);
						$i1 = 0;
						foreach ($stdv_txt1 as $value1) {
							$i1++;
							if (!is_numeric($value1)) {
								$check = false;
							}
						}
						if (count($stdv_txt1) < 2) {
							$check = false;
						}
						if ($check == true) {
							$sum1 = array_sum($stdv_txt1);
							$m1 = round($sum1 / $i1, 3);
							$d1 = 0;
							foreach ($stdv_txt1 as $key => $value1) {
								$d1 = $d1 + pow($value1 - $m1, 2);
							}
							if ($option === 'raw') {
								$s_d1 = (1 / ($i1)) * $d1;
								$mSym1 = 'x̄';
							}
							$s_d1 = round(sqrt($s_d1), 4);
							$tablef1 = '';
							$table1 = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>xᵢ</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym1)</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym1)²</th></tr></thead><tbody>";
							$ar_21 = '';
							$arf_11 = '';
							for ($f = 0; $f < $i1; $f++) {
								$ar_11 = pow(($stdv_txt1[$f] - $m1), 2) . ',';
								$ar_11 = str_replace(',', '', $ar_11);
								$ar_21 .= pow(($stdv_txt1[$f] - $m1), 2) . ',';
								$table1 .= '<tr class="bg-white"><td class="border p-2 text-center">' . $stdv_txt1[$f] . '</td><td class="border p-2 text-center">' . ($stdv_txt1[$f] - $m1) . '</td><td class="border p-2 text-center">' . $ar_11 . ' </td></tr>';
								$ar_exp1 = explode(',', $ar_21);
								$arf_11 .= $stdv_txt1[$f] . ',';
								$arf_21 = rtrim($arf_11, ',');
							}
							$ar_sum1 = array_sum($ar_exp1);
							$table1 .= "<tr class='bg-white'><th class='border p-2 text-center text-blue'>Σxᵢ = $sum1 </th><th class='border p-2 text-center text-blue'> </th><th class='border p-2 text-center text-blue'>Σ(xᵢ - $mSym1)² = $ar_sum1</th></tr></tbody></table>";
							$arf_exp1 = explode(',', $arf_21);
							$arf_exp1 = array_count_values($arf_exp1);
							foreach ($arf_exp1 as $key => $value1) {
								$tablef1 .= '<tr class="bg-white"><td class="border p-2 text-center">' . $key . '</td><td class="border p-2 text-center">' . $value1 . ' (' . ((100 / $i1) * $value1) . '%)</td></tr>';
							}
							$put1 = $i1;
							$put1 = ($put1 / 100) * (1 - ($put1 / 100));
							$vrres1 = $i1 - 1;
							$v1 = $ar_sum1 / $vrres1;
							$v1 = round($v1, $ronding);
							$vsqrt1 = sqrt($v1);
							$vsqrt1 = round($vsqrt1, $ronding);
							$s22 = pow($vsqrt1, 2);
							$ress22 = $vrres1 * $s22;
							$devn12 = 1 / $i1;
						} else {
							$this->param['error'] = "Please! Check Your Input";
							return $this->param;
						}
					}
					$pv = $ress12 + $ress22;
					$pvr = $i + $i1 - 2;
					$pvres = $pv / $pvr;
					$pvres = round($pvres, $ronding);
					$sqrpvres = sqrt($pvres);
					$sqrpvres = round($sqrpvres, $ronding);
					$resdev = $devn1 + $devn12;
					$sqrresdev = sqrt($resdev);
					$sqrresdev = round($sqrresdev, $ronding);
					$seres = $sqrpvres * $sqrresdev;
					$seres = round($seres, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($type == 'unequal') {
				if ($option == 'sum') {
					if (is_numeric($s1) && is_numeric($s2) && is_numeric($n1) && is_numeric($n2)) {
						$ps1 = pow($s1, 2);
						$pn1 = pow($n1, 2);
						$pn2 = pow($n2, 2);
						$ps14 = pow($s1, 4);
						$ps2 = pow($s2, 2);
						$ps24 = pow($s2, 4);
						$devn1 = $n1 - 1;
						$devn2 = $n2 - 1;
						$devs1n1 = $ps1 / $n1;
						$devs2n2 = $ps2 / $n2;
						$devpspn = $ps14 / $pn1;
						$mpndev = $pn2 * $devn2;
						$psmpn = $ps24 / $mpndev;
						$devpsmp = $devpspn + $psmpn;
						$se = $devs1n1  + $devs2n2;
						$devs1s2 = $devs1n1 + $devs2n2;
						$powdevs1s2 = pow($devs1s2, 2);
						$devs1sm = $powdevs1s2 / $devpsmp;
						$devs1sm = round($devs1sm, $ronding);
						$sqrse = sqrt($se);
						$seround = round($sqrse, $ronding);
					} else {
						$this->param['error'] = "Please! Check Your Input";
						return $this->param;
					}
				} else if ($option == 'raw') {
					if (isset($g1)) {
						$check = true;
						$stdv_txt = array_map('trim', array_filter(explode(',', $g1)));
						$countn = count($stdv_txt);
						$i = 0;
						foreach ($stdv_txt as $value) {
							$i++;
							if (!is_numeric($value)) {
								$check = false;
							}
						}
						if (count($stdv_txt) < 2) {
							$check = false;
						}
						if ($check == true) {
							$sum = array_sum($stdv_txt);
							$m = round($sum / $i, 3);
							$d = 0;
							foreach ($stdv_txt as $key => $value) {
								$d = $d + pow($value - $m, 2);
							}
							if ($option === 'raw') {
								$s_d = (1 / ($i)) * $d;
								$mSym = 'x̄';
							}
							$s_d = round(sqrt($s_d), 4);
							$tablef = '';
							$table = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>xᵢ</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym)</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym)²</th></tr></thead><tbody>";
							$ar_2 = '';
							$arf_1 = '';
							for ($f = 0; $f < $i; $f++) {
								$ar_1 = pow(($stdv_txt[$f] - $m), 2) . ',';
								$ar_1 = str_replace(',', '', $ar_1);
								$ar_2 .= pow(($stdv_txt[$f] - $m), 2) . ',';
								$table .= '<tr class="bg-white"><td class="border p-2 text-center">' . $stdv_txt[$f] . '</td><td class="border p-2 text-center">' . ($stdv_txt[$f] - $m) . '</td><td class="border p-2 text-center">' . $ar_1 . ' </td></tr>';
								$ar_exp = explode(',', $ar_2);
								$arf_1 .= $stdv_txt[$f] . ',';
								$arf_2 = rtrim($arf_1, ',');
							}
							$ar_sum = array_sum($ar_exp);
							$table .= "<tr class='bg-gray'><th class='border p-2 text-center text-blue'>Σxᵢ = $sum </th><th class='border p-2 text-center text-blue'> </th><th class='border p-2 text-center text-blue'>Σ(xᵢ - $mSym)² = $ar_sum</th></tr></tbody></table>";
							$arf_exp = explode(',', $arf_2);
							$arf_exp1 = array_count_values($arf_exp);
							foreach ($arf_exp1 as $key => $value) {
								$tablef .= '<tr class="bg-white"><td class="border p-2 text-center">' . $key . '</td><td class="border p-2 text-center">' . $value . ' (' . ((100 / $i) * $value) . '%)</td></tr>';
							}
							$put = $i;
							$put = ($put / 100) * (1 - ($put / 100));
							$vrres = $i - 1;
							$pi = pow($i, 2);
							$v = $ar_sum / $vrres;
							$vsqrt = sqrt($v);
							$vsqrt = round($vsqrt, $ronding);
							$s12 = pow($vsqrt, 2);
							$s124 = pow($vsqrt, 4);
							$vsqi = $s12 / $i;
							$ress12 = $vrres * $s12;
							$pivr = $pi * $vrres;
							$s124 / $ress12;
							$devn1 = $s124 / $pivr;
						} else {
							$this->param['error'] = "Please! Check Your Input";
							return $this->param;
						}
					}
					if (isset($g2)) {
						$check = true;
						$stdv_txt1 = array_map('trim', array_filter(explode(',', $g2)));
						$countn1 = count($stdv_txt1);
						$i1 = 0;
						foreach ($stdv_txt1 as $value1) {
							$i1++;
							if (!is_numeric($value1)) {
								$check = false;
							}
						}
						if (count($stdv_txt1) < 2) {
							$check = false;
						}
						if ($check == true) {
							$sum1 = array_sum($stdv_txt1);
							$m1 = round($sum1 / $i1, 3);
							$d1 = 0;
							foreach ($stdv_txt1 as $key => $value1) {
								$d1 = $d1 + pow($value1 - $m1, 2);
							}
							if ($option === 'raw') {
								$s_d1 = (1 / ($i1)) * $d1;
								$mSym1 = 'x̄';
							}
							$s_d1 = round(sqrt($s_d1), 4);
							$tablef1 = '';
							$table1 = "<table class='w-100 font-s-18' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='border p-2 text-center text-blue'>xᵢ</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym1)</th><th class='border p-2 text-center text-blue'>(xᵢ - $mSym1)²</th></tr></thead><tbody>";
							$ar_21 = '';
							$arf_11 = '';
							for ($f = 0; $f < $i1; $f++) {
								$ar_11 = pow(($stdv_txt1[$f] - $m1), 2) . ',';
								$ar_11 = str_replace(',', '', $ar_11);
								$ar_21 .= pow(($stdv_txt1[$f] - $m1), 2) . ',';
								$table1 .= '<tr class="bg-white"><td class="border p-2 text-center">' . $stdv_txt1[$f] . '</td><td class="border p-2 text-center">' . ($stdv_txt1[$f] - $m1) . '</td><td class="border p-2 text-center">' . $ar_11 . ' </td></tr>';
								$ar_exp1 = explode(',', $ar_21);
								$arf_11 .= $stdv_txt1[$f] . ',';
								$arf_21 = rtrim($arf_11, ',');
							}
							$ar_sum1 = array_sum($ar_exp1);
							$table1 .= "<tr class='bg-gray'><th class='border p-2 text-center text-blue'>Σxᵢ = $sum1 </th><th class='border p-2 text-center text-blue'> </th><th class='border p-2 text-center text-blue'>Σ(xᵢ - $mSym1)² = $ar_sum1</th></tr></tbody></table>";
							$arf_exp1 = explode(',', $arf_21);
							$arf_exp1 = array_count_values($arf_exp1);
							foreach ($arf_exp1 as $key => $value1) {
								$tablef1 .= '<tr class="bg-white"><td class="border p-2 text-center">' . $key . '</td><td class="border p-2 text-center">' . $value1 . ' (' . ((100 / $i1) * $value1) . '%)</td></tr>';
							}
							$put1 = $i1;
							$put1 = ($put1 / 100) * (1 - ($put1 / 100));
							$vrres1 = $i1 - 1;
							$pi1 = pow($i1, 2);
							$v1 = $ar_sum1 / $vrres1;
							$v1 = round($v1, $ronding);
							$vsqrt1 = sqrt($v1);
							$vsqrt1 = round($vsqrt1, $ronding);
							$s22 = pow($vsqrt1, 2);
							$vsqi1 = $s22 / $i1;
							$s224 = pow($vsqrt1, 4);
							$ress22 = $vrres1 * $s22;
							$pivr1 = $pi1 * $vrres1;
							$devn12 = $s224 / $pivr1;
						} else {
							$this->param['error'] = "Please! Check Your Input";
							return $this->param;
						}
					}
					$pv = $ress12 + $ress22;
					$pvr = $i + $i1 - 2;
					$pvres = $pv / $pvr;
					$powpv = pow($pv, 2);
					$pvres = round($pvres, $ronding);
					$sqrpvres = sqrt($pvres);
					$sqrpvres = round($sqrpvres, $ronding);
					$resdev = $vsqi + $vsqi1;
					$sqrresdev = sqrt($resdev);
					$sqrresdev = round($sqrresdev, $ronding);
					$seres = $sqrpvres * $sqrresdev;
					$seres = round($seres, $ronding);
					$dft = $vsqi + $vsqi1;
					$powdft = pow($dft, 2);
					$dft1 = $devn1 + $devn12;
					$dftres = $powdft / $dft1;
					$dftres = round($dftres, $ronding);
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['type'] = $type;
		$this->param['option'] = $option;
		if ($type == 'equal') {
			if ($option == 'sum') {
				$this->param['n1'] = $n1;
				$this->param['s1'] = $s1;
				$this->param['n2'] = $n2;
				$this->param['s2'] = $s2;
				$this->param['n1_1'] = $n1_1;
				$this->param['devn1'] = $devn1;
				$this->param['devn2'] = $devn2;
				$this->param['devres'] = $devres;
				$this->param['sqrdevres'] = $sqrdevres;
				$this->param['ps1'] = $ps1;
				$this->param['n2_1'] = $n2_1;
				$this->param['ps2'] = $ps2;
				$this->param['devi'] = $devi;
				$this->param['n1s1'] = $n1s1;
				$this->param['n2s2'] = $n2s2;
				$this->param['res'] = $res;
				$this->param['sp2'] = $sp2;
				$this->param['sp'] = $sp;
				$this->param['sqrsp2'] = $sqrsp2;
			} else if ($option == 'raw') {
				$this->param['i'] = $i;
				$this->param['v'] = $v;
				$this->param['sum'] = $sum;
				$this->param['table'] = $table;
				$this->param['ar_sum'] = $ar_sum;
				$this->param['vsqrt'] = $vsqrt;
				$this->param['vrres'] = $vrres;
				$this->param['s12'] = $s12;
				$this->param['ress12'] = $ress12;
				$this->param['devn1'] = $devn1;
				$this->param['countn'] = $countn;
				$this->param['i1'] = $i1;
				$this->param['v1'] = $v1;
				$this->param['sum1'] = $sum1;
				$this->param['table1'] = $table1;
				$this->param['ar_sum1'] = $ar_sum1;
				$this->param['vsqrt1'] = $vsqrt1;
				$this->param['vrres1'] = $vrres1;
				$this->param['s22'] = $s22;
				$this->param['ress22'] = $ress22;
				$this->param['pv'] = $pv;
				$this->param['pvres'] = $pvres;
				$this->param['sqrpvres'] = $sqrpvres;
				$this->param['devn12'] = $devn12;
				$this->param['resdev'] = $resdev;
				$this->param['sqrresdev'] = $sqrresdev;
				$this->param['seres'] = $seres;
				$this->param['countn1'] = $countn1;
			}
		} else if ($type == 'unequal') {
			if ($option == 'sum') {
				$this->param['n1'] = $n1;
				$this->param['pn1'] = $pn1;
				$this->param['pn2'] = $pn2;
				$this->param['s1'] = $s1;
				$this->param['n2'] = $n2;
				$this->param['s2'] = $s2;
				$this->param['ps1'] = $ps1;
				$this->param['ps14'] = $ps14;
				$this->param['ps2'] = $ps2;
				$this->param['ps24'] = $ps24;
				$this->param['devs1n1'] = $devs1n1;
				$this->param['devs2n2'] = $devs2n2;
				$this->param['se'] = $se;
				$this->param['sqrse'] = $sqrse;
				$this->param['seround'] = $seround;
				$this->param['devn1'] = $devn1;
				$this->param['devn2'] = $devn2;
				$this->param['devpspn'] = $devpspn;
				$this->param['mpndev'] = $mpndev;
				$this->param['psmpn'] = $psmpn;
				$this->param['devpsmp'] = $devpsmp;
				$this->param['devs1s2'] = $devs1s2;
				$this->param['devs1sm'] = $devs1sm;
				$this->param['powdevs1s2'] = $powdevs1s2;
			} else if ($option == 'raw') {
				$this->param['powpv'] = $powpv;
				$this->param['pvr'] = $pvr;
				$this->param['vsqi1'] = $vsqi1;
				$this->param['vsqi'] = $vsqi;
				$this->param['pi1'] = $pi1;
				$this->param['s224'] = $s224;
				$this->param['pi'] = $pi;
				$this->param['s124'] = $s124;
				$this->param['sqrresdev'] = $sqrresdev;
				$this->param['resdev'] = $resdev;
				$this->param['devn12'] = $devn12;
				$this->param['devn1'] = $devn1;
				$this->param['sqrpvres'] = $sqrpvres;
				$this->param['pv'] = $pv;
				$this->param['ress22'] = $ress22;
				$this->param['ress12'] = $ress12;
				$this->param['s22'] = $s22;
				$this->param['vrres1'] = $vrres1;
				$this->param['s12'] = $s12;
				$this->param['vrres'] = $vrres;
				$this->param['vsqrt1'] = $vsqrt1;
				$this->param['v1'] = $v1;
				$this->param['i1'] = $i1;
				$this->param['ar_sum1'] = $ar_sum1;
				$this->param['table1'] = $table1;
				$this->param['sum1'] = $sum1;
				$this->param['countn1'] = $countn1;
				$this->param['vsqrt'] = $vsqrt;
				$this->param['v'] = $v;
				$this->param['i'] = $i;
				$this->param['ar_sum'] = $ar_sum;
				$this->param['table'] = $table;
				$this->param['sum'] = $sum;
				$this->param['countn'] = $countn;
				$this->param['seres'] = $seres;
				$this->param['pvres'] = $pvres;
				$this->param['pivr'] = $pivr;
				$this->param['pivr1'] = $pivr1;
				$this->param['dft'] = $dft;
				$this->param['dft1'] = $dft1;
				$this->param['powdft'] = $powdft;
				$this->param['dftres'] = $dftres;
			}
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	public function empirical_pro($request)
	{

		$first = $request->first;
		$second = $request->second;
		if (is_numeric($first) && is_numeric($second)) {
			if ($second !== "0") {
				$answer = round($first / $second, 2);
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param = array(
			"answer" 			=> $answer,
			"RESULT" 			=> 1
		);
		return $this->param;
	}
	public function sse($request)
	{
		$x = $request->x;
		$y = $request->y;

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

		if (empty($x) && empty($y)) {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$x = array_map('trim', array_filter(explode(',', $x)));
		$y = array_map('trim', array_filter(explode(',', $y)));
		$n = count($x);
		$check = true;

		if ($n !== count($y)) {
			$this->param['error'] = "The number of values should be same in both sample data inputs.";
			return $this->param;
		}

		foreach ($x as $key => $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
			if (!is_numeric($y[$key])) {
				$check = false;
			}
		}

		if ($check === true) {
			$xi_sum = 0;
			$yi_sum = 0;
			$xy_sum = 0;

			foreach ($x as $key => $xi) {
				$yi = $y[$key];
				$xi_sum += pow($xi, 2);
				$yi_sum += pow($yi, 2);
				$xy_sum += $xi * $yi;
			}
			$x_sum = array_sum($x);
			$y_sum = array_sum($y);

			$ss_xx = $xi_sum - (pow($x_sum, 2) / $n);
			$ss_yy = $yi_sum - (pow($y_sum, 2) / $n);
			$ss_xy = $xy_sum - (($x_sum * $y_sum) / $n);
			$beta_1 = $ss_xy / $ss_xx;
			$beta_0 = ($y_sum / $n) - $beta_1 * ($x_sum / $n);
			$ss_r = ($beta_1 * $ss_xy);
			$ss_e = ($ss_yy - $ss_r);
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$this->param['x'] = $x;
		$this->param['y'] = $y;
		$this->param['n'] = $n;
		$this->param['x_sum'] = $x_sum;
		$this->param['xi_sum'] = $xi_sum;
		$this->param['y_sum'] = $y_sum;
		$this->param['yi_sum'] = $yi_sum;
		$this->param['xy_sum'] = $xy_sum;
		$this->param['ss_xx'] = $ss_xx;
		$this->param['ss_yy'] = $ss_yy;
		$this->param['ss_xy'] = $ss_xy;
		$this->param['beta_1'] = $beta_1;
		$this->param['beta_0'] = $beta_0;
		$this->param['ss_r'] = $ss_r;
		$this->param['ss_e'] = sigFig($ss_e, 5);
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function prediction($request)
	{
		$x           = $request->x;
		$y           = $request->y;
		$confidence  = $request->confidence;
		$prediction  = $request->prediction;
		$number    = true;
		$equal     = false;
		$array_num = 0;
		$x_sqr 	   = array();
		$y_sqr 	   = array();
		$x_sqr_sum = 0;
		$y_sqr_sum = 0;
		$x_mul_y   = array();
		$xy_sum	   = 0;
		$x_sum 	   = 0;
		$y_sum 	   = 0;
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$array_x = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		// $array_y   = explode(',', $y);
		$y = str_replace([" ", ",", "\n", "\r"], ",", $y);
		while (strpos($y, ",,") !== false) {
			$y = str_replace(",,", ",", $y);
		}
		$array_y = array_map('trim', array_filter(explode(',', $y), function ($value) {
			return $value !== '';
		}));

		$level = 1 - $confidence;
		$confidence_per = explode('.', $confidence)[1] . "%";

		foreach ($array_x as $key => $value) {
			if (!is_numeric($value)) {
				$number = false;
			}
		}
		foreach ($array_y as $key => $value) {
			if (!is_numeric($value)) {
				$number = false;
			}
		}

		if (count($array_x) == count($array_y)) {
			$equal = true;
		}

		if ($number == true && $equal == true && is_numeric($confidence) && is_numeric($prediction)) {
			// Count the element of array (n)
			$array_num = count($array_x);
			// Take the sum of array-X and array-Y
			$x_sum     = array_sum($array_x);
			$y_sum     = array_sum($array_y);
			// Make Suqare Arrays of array-X and array-Y
			foreach ($array_x as $num) $x_sqr[] = pow($num, 2);
			foreach ($array_y as $num) $y_sqr[] = pow($num, 2);
			// Make the sum of Square arrays
			$x_sqr_sum = array_sum($x_sqr);
			$y_sqr_sum = array_sum($y_sqr);
			// Make array of array_x Multiplay array_y (x.y)
			for ($i = 0; $i < $array_num; $i++) {
				$x_mul_y[$i] = $array_x[$i] * $array_y[$i];
			}
			// the sum of Square of xy arrays
			$xy_sum = array_sum($x_mul_y);
			// Find Sum of Square
			$ssxx = round($x_sqr_sum - (1 / $array_num) * pow($x_sum, 2), 4);
			$ssyy = round($y_sqr_sum - (1 / $array_num) * pow($y_sum, 2), 4);
			$ssxy = round($xy_sum - (1 / $array_num) * $x_sum * $y_sum, 4);
			// Find the Arithmetic Mean of X and Y
			$mean_x = round($x_sum / $array_num, 4);
			$mean_y = round($y_sum / $array_num, 4);
			// Find Beta 1 ans Beta 0
			$b1 = round($ssxy / $ssxx, 4);
			$b0 = round($mean_y - $b1 * $mean_x, 4);
			// Find Regression Equation
			$Y = round($b0 + $b1 * $prediction, 4);
			// Regression Sum of Square
			$ssRegression = round($b1 * $ssxy, 4);
			$ssError  = round($ssyy - $ssRegression, 4);
			$mse      = round($ssError / ($array_num - 2), 4);
			$errorEst = round(sqrt($mse), 4);
			$E        = round(2.16 * sqrt($mse * (1 + (1 / $array_num) + (pow($prediction - $mean_x, 2) / $ssxx))), 4);
			$piPov    = $Y - $E;
			$piNeg    = $Y + $E;

			$this->param['confidence_per'] = $confidence_per;
			$this->param['level']        = $level;
			$this->param['prediction']   = $prediction;
			$this->param['array_num']    = $array_num;
			$this->param['array_x']      = $array_x;
			$this->param['array_y']      = $array_y;
			$this->param['x_sum']        = $x_sum;
			$this->param['y_sum']        = $y_sum;
			$this->param['x_sqr']        = $x_sqr;
			$this->param['y_sqr']        = $y_sqr;
			$this->param['x_sqr_sum']    = $x_sqr_sum;
			$this->param['y_sqr_sum']    = $y_sqr_sum;
			$this->param['x_mul_y']      = $x_mul_y;
			$this->param['xy_sum']       = $xy_sum;
			$this->param['ssxx']         = $ssxx;
			$this->param['ssyy']         = $ssyy;
			$this->param['ssxy']         = $ssxy;
			$this->param['mean_x']       = $mean_x;
			$this->param['mean_y']       = $mean_y;
			$this->param['b1']           = $b1;
			$this->param['b0']           = $b0;
			$this->param['Y']            = $Y;
			$this->param['ssRegression'] = $ssRegression;
			$this->param['ssError']      = $ssError;
			$this->param['mse']          = $mse;
			$this->param['errorEst']     = $errorEst;
			$this->param['E']            = $E;
			$this->param['piPov']        = $piPov;
			$this->param['piNeg']        = $piNeg;
			$this->param['RESULT']       = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
	public function scatter($request)
	{
		$x = $request->x;
		$y = $request->y;
		$title = $request->title;
		$xaxis = $request->xaxis;
		$yaxis = $request->yaxis;
		$xmin = $request->xmin;
		$xmax = $request->xmax;
		$ymin = $request->ymin;
		$ymax = $request->ymax;
		$position = $request->position;
		$align = $request->align;

		if (empty($x) && empty($y)) {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$x = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		$y = str_replace([" ", ",", "\n", "\r"], ",", $y);
		while (strpos($y, ",,") !== false) {
			$y = str_replace(",,", ",", $y);
		}
		$y = array_map('trim', array_filter(explode(',', $y), function ($value) {
			return $value !== '';
		}));
		$n = count($x);
		$check = true;

		if ($n !== count($y)) {
			$this->param['error'] = "The number of values should be same in both sample data inputs.";
			return $this->param;
		}

		foreach ($x as $key => $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
			if (!is_numeric($y[$key])) {
				$check = false;
			}
		}

		if (empty($title)) {
			$title = 'Scatter Plot';
		}
		if (empty($xaxis)) {
			$xaxis = 'X';
		}
		if (empty($yaxis)) {
			$yaxis = 'Y';
		}

		$this->param['x'] = $x;
		$this->param['y'] = $y;
		$this->param['title'] = $title;
		$this->param['xaxis'] = $xaxis;
		$this->param['yaxis'] = $yaxis;
		$this->param['xmin'] = $xmin;
		$this->param['xmax'] = $xmax;
		$this->param['ymin'] = $ymin;
		$this->param['ymax'] = $ymax;
		$this->param['position'] = $position;
		$this->param['align'] = $align;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	public function residual($request)
	{
		$x = $request->x;
		$y = $request->y;

		if (empty($x) && empty($y)) {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$x = array_map('trim', array_filter(explode(',', $x)));
		$y = array_map('trim', array_filter(explode(',', $y)));
		$n = count($x);
		$check = true;

		if ($n !== count($y)) {
			$this->param['error'] = "The number of values should be same in both data inputs.";
			return $this->param;
		}

		foreach ($x as $key => $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
			if (!is_numeric($y[$key])) {
				$check = false;
			}
		}

		if ($check === true) {
			$xi_sum = 0;
			$yi_sum = 0;
			$xy_sum = 0;
			$y_bar = [];

			foreach ($x as $key => $xi) {
				$yi = $y[$key];
				$xi_sum += pow($xi, 2);
				$yi_sum += pow($yi, 2);
				$xy_sum += $xi * $yi;
			}
			$x_sum = array_sum($x);
			$y_sum = array_sum($y);

			$ss_xx = $xi_sum - (pow($x_sum, 2) / $n);
			$ss_yy = $yi_sum - (pow($y_sum, 2) / $n);
			$ss_xy = $xy_sum - (($x_sum * $y_sum) / $n);
			$beta_1 = $ss_xy / $ss_xx;
			$beta_0 = ($y_sum / $n) - $beta_1 * ($x_sum / $n);

			foreach ($x as $key => $xi) {
				$y_bar[] = $beta_0 + $beta_1 * $xi;
				$yy_bar[] = $y[$key] - $y_bar[$key];
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$this->param['x'] = $x;
		$this->param['y'] = $y;
		$this->param['n'] = $n;
		$this->param['x_sum'] = $x_sum;
		$this->param['xi_sum'] = $xi_sum;
		$this->param['y_sum'] = $y_sum;
		$this->param['yi_sum'] = $yi_sum;
		$this->param['xy_sum'] = $xy_sum;
		$this->param['ss_xx'] = $ss_xx;
		$this->param['ss_yy'] = $ss_yy;
		$this->param['ss_xy'] = $ss_xy;
		$this->param['beta_1'] = $beta_1;
		$this->param['beta_0'] = $beta_0;
		$this->param['y_bar'] = $y_bar;
		$this->param['yy_bar'] = $yy_bar;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function decile($request)
	{
		$x = $request->x;
		$decile = $request->decile;
		$check = true;
		if (empty($x)) {
			$check = false;
		}
		$x = str_replace([" ", ",", "\n", "\r"], ",", $x);
		while (strpos($x, ",,") !== false) {
			$x = str_replace(",,", ",", $x);
		}
		$numbers = array_map('trim', array_filter(explode(',', $x), function ($value) {
			return $value !== '';
		}));
		foreach ($numbers as $value) {
			if (!is_numeric($value)) {
				$check = false;
			}
		}
		if ($check == true) {
			// sort($numbers);
			$sort_array = array_chunk($numbers, "2");
			foreach ($sort_array as $value) {
				if (count($value) === 2) {
					$ans_list[] = $value[0] . "." . $value[1];
				} else {
					$ans_list[] = $value[0];
				}
			}
			$total_values = count($sort_array);
			$decile_pos = (($total_values + 1) * ($decile / 10));
			if (is_numeric($decile_pos) && floor($decile_pos) != $decile_pos) {
				$floor_val = floor($decile_pos);
				$ceil_val = ceil($decile_pos);
				$list_floor_val = $ans_list[($floor_val - 1)];
				$list_ceil_val = $ans_list[($ceil_val - 1)];
				$floor_minus = $decile_pos - $floor_val;
				$main_ans = $list_floor_val + $floor_minus * ($list_ceil_val - $list_floor_val);
				$this->param['floor_val'] = $floor_val;
				$this->param['ceil_val'] = $ceil_val;
				$this->param['list_floor_val'] = $list_floor_val;
				$this->param['list_ceil_val'] = $list_ceil_val;
				$this->param['floor_minus'] = $floor_minus;
			} else {
				$main_ans = $ans_list[($decile_pos - 1)];
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['main_ans'] = $main_ans;
		$this->param['total_values'] = $total_values;
		$this->param['ans_list'] = $ans_list;
		$this->param['decile_pos'] = $decile_pos;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	  // Sampling Distribution Calculator
	public function sample($request)
	{
		$mean = $request->mean;
		$deviation = $request->deviation;
		$size = $request->size;
		$probability = $request->probability;
		$x1 = $request->x1;
		$x2 = $request->x2;

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
		function erf($x)
		{
			$a1 =  0.254829592;
			$a2 = -0.284496736;
			$a3 =  1.421413741;
			$a4 = -1.453152027;
			$a5 =  1.061405429;
			$p  =  0.3275911;

			$sign = ($x >= 0) ? 1 : -1;
			$x = abs($x);

			$t = 1.0 / (1.0 + $p * $x);
			$y = ((((($a5 * $t + $a4) * $t) + $a3) * $t + $a2) * $t + $a1) * $t;
			$y = 1.0 - ($y * exp(-$x * $x));

			return $sign * $y;
		}
		function standardNormalCDF($z)
		{
			return 0.5 * (1 + erf($z / sqrt(2)));
		}

		if (is_numeric($mean) && is_numeric($deviation) && is_numeric($size) && !empty($probability) && is_numeric($x1)) {
			$zl = ($x1 - $mean) / ($deviation / sqrt($size));
			$standard_error = $deviation / sqrt($size);
			$standard_error = round($standard_error, 4);
			$sd = $deviation / sqrt($size);
			$pr2 = standardNormalCDF($zl);
			$a = $mean - 6 * $sd;
			$b = $mean + 6 * $sd;
			$chartData = [];
			$chartData2 = [];

			if ($probability === 'two_tailed') {
				if (is_numeric($x2)) {
					$zu = ($x2 - $mean) / ($deviation / sqrt($size));
					$pr1 = standardNormalCDF($zu);
					$pr = $pr1 - $pr2;

					if ($x1 > $b) {
						$x1 = $b;
					}
					if ($x1 < $a) {
						$x1 = $a;
					}
					if ($x2 > $b) {
						$x2 = $b;
					}
					if ($x2 < $a) {
						$x2 = $a;
					}
					if ($x1 <= $x2) {
						for ($i = $a; $i <= $x1; $i += 0.058) {
							$chartData[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi())), '', '', '', '', '', '', '', '', '']);
						}
						for ($i = $x1; $i <= $x2; $i += 0.058) {
							$chartData[] = ([sigFig($i, 5), '', '', '', '', '', '', '', '', '', exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
						}
						for ($i = $x2; $i <= $b; $i += 0.058) {
							$chartData[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi())), '', '', '', '', '', '', '', '', '']);
						}
						for ($i = $x1; $i <= $x2; $i += 0.058) {
							$chartData2[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi())), '', '', '', '', '', '', '', '', '']);
						}

						$this->param['zu'] = $zu;
						$this->param['pr'] = $pr;
						$this->param['pr1'] = $pr1;
					} else {
						$this->param['error'] = "X₂ must be greater than X₁";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				if ($probability === 'left_tailed') {
					if ($x1 > $b) {
						$x1 = $b;
					}
					if ($x1 < $a) {
						$x1 = $a;
					}
					for ($i = $a; $i <= $x1; $i += 0.058) {
						$chartData[] = ([(float)sigFig($i, 5), (float)exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
					}
					for ($i = $x1; $i <= $b; $i += 0.058) {
						$chartData[] = ([(float)sigFig($i, 5), (float)exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
					}
					for ($i = $a; $i <= $x1; $i += 0.058) {
						$chartData2[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
					}
				} else {
					if ($x1 > $b) {
						$x1 = $b;
					}
					if ($x1 < $a) {
						$x1 = $a;
					}
					for ($i = $a; $i <= $x1; $i += 0.058) {
						$chartData[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
					}
					for ($i = $x1; $i <= $b; $i += 0.058) {
						$chartData[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
					}
					for ($i = $a; $i <= $x1; $i += 0.058) {
						$chartData2[] = ([sigFig($i, 5), exp(-0.5 * pow((($i - $mean) / $sd), 2)) / ($sd * sqrt(2 * pi()))]);
					}
				}
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$this->param['standard_error'] = $standard_error;
		$this->param['mean'] = $mean;
		$this->param['deviation'] = $deviation;
		$this->param['probability'] = $probability;
		$this->param['size'] = $size;
		$this->param['x1'] = $x1;
		$this->param['x2'] = $x2;
		$this->param['sd'] = $sd;
		$this->param['zl'] = $zl;
		$this->param['pr2'] = $pr2;
		$this->param['chartData'] = $chartData;
		$this->param['chartData2'] = $chartData2;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function accuracy($request)
	{
		
		$true_postive = trim($request->true_postive);
		$false_negative = trim($request->false_negative);
		$false_positive = trim($request->false_positive);
		$true_negative = trim($request->true_negative);
		$prevalence = trim($request->prevalence);
		$sensitivity = trim($request->sensitivity);
		$specificity = trim($request->specificity);
		$observed_value = trim($request->observed_value);
		$accepted_value = trim($request->accepted_value);
		$method_unit = trim($request->method_unit);
		if ($method_unit == "Standard method") {
			if (is_numeric($true_postive) && is_numeric($false_negative) && is_numeric($false_positive) && is_numeric($true_negative)) {
				$accu_add_sec = $true_postive + $true_negative;
				$accu_add_all = $true_postive + $true_negative + $false_positive + $false_negative;
				$accu_div = $accu_add_sec / $accu_add_all;
				$answer = $accu_div * 100;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($method_unit == "Prevalence method") {
			if (is_numeric($prevalence) && is_numeric($sensitivity) && is_numeric($specificity)) {
				$prevalence = $prevalence / 100;
				$accu_se_pre = ($sensitivity * $prevalence) + ($specificity * (1 - $prevalence));
				$answer = $accu_se_pre;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else {
			if (is_numeric($observed_value) && is_numeric($accepted_value)) {
				if ($accepted_value === "0") {
					$this->param['error'] = "Accepted value cannot be equal to zero.";
					return $this->param;
				}
				$per_error = $observed_value - $accepted_value;
				$error_per = abs($per_error) / $accepted_value;
				$answer = $error_per * 100;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['method_unit'] = $method_unit;
		$this->param['method_unit'] = $method_unit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function class($request)
	{
		$minimum = trim($request->minimum);
		$maximum = trim($request->maximum);
		$number = trim($request->number);
		if (is_numeric($minimum) && is_numeric($maximum) && is_numeric($number)) {
			if ($minimum < $maximum) {
				$width = ($maximum - $minimum) / $number;
				$answer = abs($width);
				$this->param['answer'] = $answer;
			} else {
				$this->param['error'] = "The maximum value should greater than the minimum value.";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function relative_risk($request)
	{
		$e_disease = $request->e_disease;
		$e_no_disease = $request->e_no_disease;
		$c_disease = $request->c_disease;
		$c_no_disease = $request->c_no_disease;
		$confidenceLevel = $request->confidenceLevel;
		$z_score = $request->z_score;
		if (is_numeric($e_disease) && is_numeric($e_no_disease) && is_numeric($c_disease) && is_numeric($c_no_disease)) {
			$riskExposed = $e_disease / ($e_disease + $e_no_disease);
			$riskControl = $c_disease / ($c_disease + $c_no_disease);
			$relative = $riskExposed / $riskControl;
			$this->param['relative'] = $relative;
			$this->param['riskExposed'] = $riskExposed;
			$this->param['riskControl'] = $riskControl;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	public function error_propagation($request)
	{
		$x = $request->x;
		$y = $request->y;
		$delta_x = $request->delta_x;
		$delta_y = $request->delta_y;
		$optionSelect = $request->optionSelect;
		if (is_numeric($x) && is_numeric($y)) {
			if (isset($optionSelect)) {
				if ($optionSelect === 'addition') {
					$z = $x + $y;
					$delta_z = sqrt(pow($delta_x, 2) + pow($delta_y, 2));
					$this->param['z'] = $z;
					$this->param['delta_z'] =  $delta_z;
				} elseif ($optionSelect === 'subtraction') {
					$z = $x - $y;
					$delta_z = sqrt(pow($delta_x, 2) + pow($delta_y, 2));
					$this->param['z'] = $z;
					$this->param['delta_z'] =  $delta_z;
				} elseif ($optionSelect === 'multiplication') {
					$z = $x * $y;
					$delta_z = $z * sqrt(pow(($delta_x / $x), 2) + pow(($delta_y / $y), 2));
					$this->param['z'] = $z;
					$this->param['delta_z'] =  $delta_z;
				} elseif ($optionSelect === 'division') {
					$z = $x / $y;
					$delta_z = $z * sqrt(pow(($delta_x / $x), 2) + pow(($delta_y / $y), 2));
					$this->param['z'] = $z;
					$this->param['delta_z'] =  $delta_z;
				}
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function chi($request)
	{
		$observed = $request->observed;
		$expected = $request->expected;
		if (is_numeric($expected) && is_numeric($observed)) {

			$chiSquared = pow($observed - $expected, 2) / $expected;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['chiSquared'] =  $chiSquared;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function p_hat($request)
	{
		$sample_size = $request->sample_size;
		$occurrences = $request->occurrences;
		if (is_numeric($occurrences) && is_numeric($sample_size)) {
			$p_hat = $occurrences / $sample_size;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}

		$this->param['p_hat'] =  $p_hat;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function t_statistic($request)
	{
		
		$s_mean = $request->s_mean;
		$p_mean = $request->p_mean;
		$s_size = $request->s_size;
		$standard_daviation = $request->standard_daviation;
		if (is_numeric($s_mean) && is_numeric($p_mean) && is_numeric($s_size) && is_numeric($standard_daviation)) {
			$mean = $s_mean - $p_mean;
			$sq_s_size = sqrt($s_size);
			$size = $standard_daviation / $sq_s_size;
			$t =  $mean / $size;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['t'] =  $t;
		$this->param['mean'] =  $mean;
		$this->param['sq_s_size'] =  $sq_s_size;
		$this->param['size'] =  $size;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function critical($request)
	{
		$submit = $request->calculator_name;
		$first = $request->first;
		$second = $request->second;
		$third = $request->third;
		$Pi = 3.1415926535898;
		$PiD2 = $Pi / 2;
		$PiD4 = $Pi / 4;
		$Pi2 = 2 * $Pi;
		$pi2 = $Pi / 2;
		$e = 2.718281828459045235;
		$e10 = 1.105170918075647625;
		$Deg = 180 / $Pi;
		function resConvert($a)
		{
			return ($b = $a >= 0 ? $a + 0.0000 : $a - 0.0000);
		}
		function stuT($a, $b)
		{
			$a = abs($a);
			$c = $a / sqrt($b);
			$d = atan($c);
			$pi2 = 3.1415926535898 / 2;
			if (1 == $b) {
				return $d / $pi2;
			}
			$e = sin($d);
			$f = cos($d);
			$alpha = $b % 2 == 1 ? 1 - ($d + $e * $f * stuComp($f * $f, 2, $b - 3, -1)) / $pi2 : 1 - $e * stuComp($f * $f, 1, $b - 3, -1);
			$alpha2 = 1 - $alpha;
			return $alpha2;
		}
		function pStuT($a, $b)
		{
			for ($c = 0.5, $d = 0.5, $e = 0; $d > 0.000001;) {
				$e = 1 / $c - 1;
				$d /= 2;
				$qt = 1 - stuT($e, $b);
				$qt > $a ? ($c -= $d) : ($c += $d);
			}

			return $e;
		}
		function stuComp($a, $b, $c, $d)
		{
			for ($e = 1, $f = $e, $g = $b; $g <= $c;) {
				($e = ($e * $a * $g) / ($g - $d));
				($f += $e);
				($g += 2);
			}
			return $f;
		}
		function parseConv($a)
		{
			return floatval($a);
		}
		function easyRoundOf($a, $b)
		{
			if (is_nan($a)) return 0;
			$b = pow(10, parseConv($b));
			$c = round(parseConv($a) * $b) / $b;
			return is_nan($c) ? 0 : $c;
		}
		function tcritical($first, $third)
		{
			$a2b = $first * 2;
			$a1result = resConvert(pStuT($a2b, $third));
			$a2result = resConvert(pStuT($first, $third));
			$rloop = 15;
			if ($third < 15) {
				$rloop = $third;
			}
			// Number of Columns
			$nloop = ceil(($third / $rloop));
			$dat1 = " ";
			$dat2Cus = "";
			// One Tailed Table
			$a1tbl =
				'<p class="col-12 mt-2 font-s-18 text-blue"> One Tailed Probability of ' .
				$first .
				'</p> <div class="col-12 overflow-auto"><table class="w-100" style="border-collapse: collapse">';
			for ($i = 1; $i <= $rloop; $i++) {
				// Headings
				if ($i == 1) {
					$a1tbl .= "<tr class='bg-gray'>";
					for ($j = 1; $j <= $nloop; $j++) {
						$a1tbl .= "<td class='p-2 border text-center text-blue'> df </td> <th class='p-2 border text-center text-blue'> &alpha; </th>";
					}
					$a1tbl .= "</tr>";
				}
				// Table Calculation
				$a1tbl .= '<tr class="bg-white">';
				for ($j = 1; $j <= $nloop; $j++) {
					$df1 = ($j - 1) * 15 + $i;
					if ($df1 > $third) {
						$a1tbl .= "<td colspan='2' class='p-2 border text-center'> </td>";
					} else {
						$a1 = easyRoundOf(resConvert(pStuT($a2b, $df1)), 4);
						if ($rloop == $i && $nloop == $j) {
							$a1tbl .= "<th class='p-2 border text-center' style='background-color: #0072b7;color: white;'>" . $df1 . "</th> <td class='p-2 border text-center' style='background-color: #0072b7;color: white;'>" . $a1 . "</td>";
						} else {
							$a1tbl .= "<th class='p-2 border text-center'>" . $df1 . "</th> <td class='p-2 border text-center'>" . $a1 . "</td>";
						}
						if ($df1 == $third) {
							$dat1 = " " . $a1;
							$dat3 = " - " . $a1;
						}
					}
				}
				$a1tbl .= "</tr>";
			}
			$a1tbl .= "</table></div>";
			// Two Tailed Table
			$dat2 = "";
			$a2tbl =
				'<p class="col-12 mt-2 font-s-18 text-blue"> Two Tailed Probability of ' .
				$first .
				'</p> <div class="col-12 overflow-auto"><table class="w-100" style="border-collapse: collapse">';
			for ($i = 1; $i <= $rloop; $i++) {
				// Headings
				if ($i == 1) {
					$a2tbl .= "<tr class='bg-gray'>";
					for ($j = 1; $j <= $nloop; $j++) {
						$a2tbl .= "<td class='p-2 border text-center text-blue'> df </td> <td class='p-2 border text-center text-blue'> &alpha; </td>";
					}
					$a2tbl .= "</tr>";
				}
				// Table Calculation
				$a2tbl .= '<tr class="bg-white">';
				for ($j = 1; $j <= $nloop; $j++) {
					$df2 = ($j - 1) * 15 + $i;
					if ($df2 > $third) {
						$a2tbl .= "<td colspan='2' class='p-2 border text-center'> </td>";
					} else {
						$a1 = easyRoundOf(resConvert(pStuT($first, $df2)), 4);
						// $a2tbl .= "<th>" . $df2 . "</th> <td>" . $a1 . "</td>";
						if ($rloop == $i && $nloop == $j) {
							$a2tbl .= "<td class='p-2 border text-center' style='background-color: #0072b7;color: white;'>" . $df2 . "</td> <td class='p-2 border text-center' style='background-color: #0072b7;color: white;'>" . $a1 . "</td>";
						} else {
							$a2tbl .= "<td class='p-2 border text-center'>" . $df2 . "</td> <td class='p-2 border text-center'>" . $a1 . "</td>";
						}
						if ($df2 == $third) {
							$dat2 = " ± " . $a1;
							$dat2Cus = $a1;
						}
					}
				}
				$a2tbl .= "</tr>";
			}
			$a2tbl .= "</table></div>";
			return array($dat1, $dat3, $dat2, $a1tbl, $a2tbl);
		}

		// for z critical value

		function log_10($n)
		{
			return log($n) / log(10);
		}
		function round_to_precision($x, $p)
		{
			$x = $x * pow(10, $p);
			$x = round($x);
			return $x / pow(10, $p);
		}
		function integer($i)
		{
			if ($i > 0) return floor($i);
			else return ceil($i);
		}
		function precision($x)
		{
			$SIGNIFICANT = 8;
			return abs(integer(log_10(abs($x)) - $SIGNIFICANT));
		}
		function poz($z)
		{
			$Z_MAX = 6;
			if ($z == 0.0) {
				$x = 0.0;
			} else {
				$y = 0.5 * abs($z);
				if ($y > $Z_MAX * 0.5) {
					$x = 1.0;
				} else if ($y < 1.0) {
					$w = $y * $y;
					$x =
						((((((((0.000124818987 * $w - 0.001075204047) * $w +
							0.005198775019) *
							$w -
							0.019198292004) *
							$w +
							0.059054035642) *
							$w -
							0.151968751364) *
							$w +
							0.319152932694) *
							$w -
							0.5319230073) *
							$w +
							0.797884560593) *
						$y *
						2.0;
				} else {
					$y -= 2.0;
					$x =
						(((((((((((((-0.000045255659 * $y + 0.00015252929) * $y -
							0.000019538132) *
							$y -
							0.000676904986) *
							$y +
							0.001390604284) *
							$y -
							0.00079462082) *
							$y -
							0.002034254874) *
							$y +
							0.006549791214) *
							$y -
							0.010557625006) *
							$y +
							0.011630447319) *
							$y -
							0.009279453341) *
							$y +
							0.005353579108) *
							$y -
							0.002141268741) *
							$y +
							0.000535310849) *
						$y +
						0.999936657524;
				}
			}
			return $z > 0.0 ? ($x + 1.0) * 0.5 : (1.0 - $x) * 0.5;
		}
		function criva($p)
		{
			$Z_MAX = 6;
			$Z_EPSILON = 0.000001; /* Accuracy of z approximation */
			$minz = -$Z_MAX;
			$maxz = $Z_MAX;
			$zval = 0.0;
			$pval = '';
			if ($p < 0.0 || $p > 1.0) {
				return -1;
			}
			while ($maxz - $minz > $Z_EPSILON) {
				$pval = poz($zval);
				if ($pval > $p) {
					$maxz = $zval;
				} else {
					$minz = $zval;
				}
				$zval = ($maxz + $minz) * 0.5;
			}
			return $zval;
		}
		function erf($x)
		{
			$cof = [
				-1.3026537197817094,
				0.6419697923564902,
				0.019476473204185836,
				-0.00956151478680863,
				-0.000946595344482036,
				0.000366839497852761,
				42523324806907e-18,
				-20278578112534e-18,
				-1624290004647e-18,
				130365583558e-17,
				1.5626441722e-8,
				-8.5238095915e-8,
				6.529054439e-9,
				5.059343495e-9,
				-9.91364156e-10,
				-2.27365122e-10,
				96467911e-18,
				2394038e-18,
				-6886027e-18,
				894487e-18,
				313092e-18,
				-112708e-18,
				381e-18,
				7106e-18,
				-1523e-18,
				-94e-18,
				121e-18,
				-28e-18,
			];
			$j = count($cof) - 1;
			$isneg = false;
			$d = 0;
			$dd = 0;
			// $t, ty, tmp, res;
			if ($x < 0) {
				$x = -$x;
				$isneg = true;
			}
			$t = 2 / (2 + $x);
			$ty = 4 * $t - 2;
			for (; $j > 0; $j--) {
				$tmp = $d;
				$d = $ty * $d - $dd + $cof[$j];
				$dd = $tmp;
			}
			$res = $t * exp(-$x * $x + 0.5 * ($cof[0] + $ty * $d) - $dd);
			return $isneg ? $res - 1 : 1 - $res;
		}
		function erfc($x)
		{
			return 1 - erf($x);
		}
		function erfcinv($p)
		{
			$j = 0;
			// let x, err, t, pp;
			if ($p >= 2) return -100;
			if ($p <= 0) return 100;
			$pp = $p < 1 ? $p : 2 - $p;
			$t = sqrt(-2 * log($pp / 2));
			$x = -0.70711 *
				((2.30753 + $t * 0.27061) / (1 + $t * (0.99229 + $t * 0.04481)) - $t);
			for (; $j < 2; $j++) {
				$err = erfc($x) - $pp;
				$x += $err / (1.1283791670955126 * exp(-$x * $x) - $x * $err);
			}
			return $p < 1 ? $x : -$x;
		}
		function normal__inv($p, $mean, $std)
		{
			return -1.4142135623730951 * $std * erfcinv(2 * $p) + $mean;
		}
		function zcritical($first)
		{
			$left__z__val = normal__inv(1 - $first, 0, 1);
			$right__z__val = normal__inv($first, 0, 1);
			$z_two_tailed_value = normal__inv($first / 2, 0, 1);
			$z_two_tailed_neg_value = normal__inv(1 - $first / 2, 0, 1);
			$z_val = abs(criva($first));
			$answer = round_to_precision($z_two_tailed_value, precision($z_two_tailed_value)) . " & " . round_to_precision($z_two_tailed_neg_value, precision($z_two_tailed_neg_value));
			if ($first == 0) {
				$z_val = "-Inf";
			}
			if ($first == 1) {
				$z_val = "Inf";
			}
			return array($left__z__val, $right__z__val, $z_val, $answer);
		}
		if ($submit == "t_val") {
			if (is_numeric($first) && is_numeric($third)) {
				if ($first >= 0 && $first <= 0.5) {
					$t_jawab = tcritical($first, $third);
					$this->param['t_jawab'] = $t_jawab;
				} else {
					$this->param['error'] = "Enter Significant Level between 0 to 0.5";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($submit == "z_val") {
			if (is_numeric($first)) {
				if ($first >= 0 && $first <= 1) {
					$z_jawab = zcritical($first);
					$this->param['z_jawab'] = $z_jawab;
				} else {
					$this->param['error'] = "Enter Significant Level between 0 to 1";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($submit == "chi_val") {
			if (is_numeric($first) && is_numeric($third)) {
				if ($first >= 0 && $first <= 0.5) {
					$this->param['value'] = $first;
					$this->param['degree'] = $third;
				} else {
					$this->param['error'] = "Enter Significant Level between 0 to 0.5";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($submit == "f_val") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				if ($first >= 0 && $first <= 0.5) {
					if ($second > 0) {
						if ($third > 0) {
							$this->param['first'] = $first;
							$this->param['second'] = $second;
							$this->param['third'] = $third;
						} else {
							$this->param['error'] = "Degrees of Freedom Denominator greater than zero";
							return $this->param;
						}
					} else {
						$this->param['error'] = "Degrees of Freedom Numerator greater than zero";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Enter Significant Level between 0 to 0.5";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($submit == "r_val") {
			if (is_numeric($first) && is_numeric($third)) {
				if ($first >= 0 && $first <= 0.5) {
					$this->param['value'] = $first;
					$this->param['degree'] = $third;
				} else {
					$this->param['error'] = "Enter Significant Level between 0 to 0.5";
					return $this->param;
				}
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}
		$this->param['submit'] = $submit;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	// Normal Distribution Calculator 
	public function normal($request)
	{
		$operations = $request->operations;
		$find_compare = $request->find_compare;
		$f_first = $request->f_first;
		$f_second = $request->f_second;
		$f_third = $request->f_third;
		$mean = $request->mean;
		$deviation = $request->deviation;
		$a = $request->a;
		$b = $request->b;
		$c = $request->c;
		$d = $request->d;
		$e1 = $request->e1;
		$e2 = $request->e2;
		$f = $request->f;
		function zain($rz)
		{
			$z_table = [
				'-4.0' => [9 => 0.00002, 8 => 0.00002, 7 => 0.00002, 6 => 0.00002, 5 => 0.00003, 4 => 0.00003, 3 => 0.00003, 2 => 0.00003, 1 => 0.00003, 0 => 0.00003],
				'-3.9' => [9 => 0.00003, 8 => 0.00003, 7 => 0.00004, 6 => 0.00004, 5 => 0.00004, 4 => 0.00004, 3 => 0.00004, 2 => 0.00004, 1 => 0.00005, 0 => 0.00005],
				'-3.8' => [9 => 0.00005, 8 => 0.00005, 7 => 0.00005, 6 => 0.00006, 5 => 0.00006, 4 => 0.00006, 3 => 0.00006, 2 => 0.00007, 1 => 0.00007, 0 => 0.00007],
				'-3.7' => [9 => 0.00008, 8 => 0.00008, 7 => 0.00008, 6 => 0.00008, 5 => 0.00009, 4 => 0.00009, 3 => 0.00010, 2 => 0.00010, 1 => 0.00010, 0 => 0.00011],
				'-3.6' => [9 => 0.00011, 8 => 0.00012, 7 => 0.00012, 6 => 0.00013, 5 => 0.00013, 4 => 0.00014, 3 => 0.00014, 2 => 0.00015, 1 => 0.00015, 0 => 0.00016],
				'-3.5' => [9 => 0.00017, 8 => 0.00017, 7 => 0.00018, 6 => 0.00019, 5 => 0.00019, 4 => 0.00020, 3 => 0.00021, 2 => 0.00022, 1 => 0.00022, 0 => 0.00023],
				'-3.4' => [9 => 0.00024, 8 => 0.00025, 7 => 0.00026, 6 => 0.00027, 5 => 0.00028, 4 => 0.00029, 3 => 0.00030, 2 => 0.00031, 1 => 0.00032, 0 => 0.00034],
				'-3.3' => [9 => 0.00035, 8 => 0.00036, 7 => 0.00038, 6 => 0.00039, 5 => 0.00040, 4 => 0.00042, 3 => 0.00043, 2 => 0.00045, 1 => 0.00047, 0 => 0.00048],
				'-3.2' => [9 => 0.00050, 8 => 0.00052, 7 => 0.00054, 6 => 0.00056, 5 => 0.00058, 4 => 0.00060, 3 => 0.00062, 2 => 0.00064, 1 => 0.00066, 0 => 0.00069],
				'-3.1' => [9 => 0.00071, 8 => 0.00074, 7 => 0.00076, 6 => 0.00079, 5 => 0.00082, 4 => 0.00084, 3 => 0.00087, 2 => 0.00090, 1 => 0.00094, 0 => 0.00097],
				'-3.0' => [9 => 0.00100, 8 => 0.00104, 7 => 0.00107, 6 => 0.00111, 5 => 0.00114, 4 => 0.00118, 3 => 0.00122, 2 => 0.00126, 1 => 0.00131, 0 => 0.00135],
				'-2.9' => [9 => 0.00139, 8 => 0.00144, 7 => 0.00149, 6 => 0.00154, 5 => 0.00159, 4 => 0.00164, 3 => 0.00169, 2 => 0.00175, 1 => 0.00181, 0 => 0.00187],
				'-2.8' => [9 => 0.00193, 8 => 0.00199, 7 => 0.00205, 6 => 0.00212, 5 => 0.00219, 4 => 0.00226, 3 => 0.00233, 2 => 0.00240, 1 => 0.00248, 0 => 0.00256],
				'-2.7' => [9 => 0.00264, 8 => 0.00272, 7 => 0.00280, 6 => 0.00289, 5 => 0.00298, 4 => 0.00307, 3 => 0.00317, 2 => 0.00326, 1 => 0.00336, 0 => 0.00347],
				'-2.6' => [9 => 0.00357, 8 => 0.00368, 7 => 0.00379, 6 => 0.00391, 5 => 0.00402, 4 => 0.00415, 3 => 0.00427, 2 => 0.00440, 1 => 0.00453, 0 => 0.00466],
				'-2.5' => [9 => 0.00480, 8 => 0.00494, 7 => 0.00508, 6 => 0.00523, 5 => 0.00539, 4 => 0.00554, 3 => 0.00570, 2 => 0.00587, 1 => 0.00604, 0 => 0.00621],
				'-2.4' => [9 => 0.00639, 8 => 0.00657, 7 => 0.00676, 6 => 0.00695, 5 => 0.00714, 4 => 0.00734, 3 => 0.00755, 2 => 0.00776, 1 => 0.00798, 0 => 0.00820],
				'-2.3' => [9 => 0.00842, 8 => 0.00866, 7 => 0.00889, 6 => 0.00914, 5 => 0.00939, 4 => 0.00964, 3 => 0.00990, 2 => 0.01017, 1 => 0.01044, 0 => 0.01072],
				'-2.2' => [9 => 0.01101, 8 => 0.01130, 7 => 0.01160, 6 => 0.01191, 5 => 0.01222, 4 => 0.01255, 3 => 0.01287, 2 => 0.01321, 1 => 0.01355, 0 => 0.01390],
				'-2.1' => [9 => 0.01426, 8 => 0.01463, 7 => 0.01500, 6 => 0.01539, 5 => 0.01578, 4 => 0.01618, 3 => 0.01659, 2 => 0.01700, 1 => 0.01743, 0 => 0.01786],
				'-2.0' => [9 => 0.01831, 8 => 0.01876, 7 => 0.01923, 6 => 0.01970, 5 => 0.02018, 4 => 0.02068, 3 => 0.02118, 2 => 0.02169, 1 => 0.02222, 0 => 0.02275],
				'-1.9' => [9 => 0.02330, 8 => 0.02385, 7 => 0.02442, 6 => 0.02500, 5 => 0.02559, 4 => 0.02619, 3 => 0.02680, 2 => 0.02743, 1 => 0.02807, 0 => 0.02872],
				'-1.8' => [9 => 0.02938, 8 => 0.03005, 7 => 0.03074, 6 => 0.03144, 5 => 0.03216, 4 => 0.03288, 3 => 0.03362, 2 => 0.03438, 1 => 0.03515, 0 => 0.03593],
				'-1.7' => [9 => 0.03673, 8 => 0.03754, 7 => 0.03836, 6 => 0.03920, 5 => 0.04006, 4 => 0.04093, 3 => 0.04182, 2 => 0.04272, 1 => 0.04363, 0 => 0.04457],
				'-1.6' => [9 => 0.04551, 8 => 0.04648, 7 => 0.04746, 6 => 0.04846, 5 => 0.04947, 4 => 0.05050, 3 => 0.05155, 2 => 0.05262, 1 => 0.05370, 0 => 0.05480],
				'-1.5' => [9 => 0.0559, 8 => 0.0571, 7 => 0.0582, 6 => 0.0594, 5 => 0.0606, 4 => 0.0618, 3 => 0.0630, 2 => 0.0643, 1 => 0.0655, 0 => 0.0668],
				'-1.4' => [9 => 0.0681, 8 => 0.0694, 7 => 0.0708, 6 => 0.0721, 5 => 0.0735, 4 => 0.0749, 3 => 0.0764, 2 => 0.0778, 1 => 0.0793, 0 => 0.0808],
				'-1.3' => [9 => 0.0823, 8 => 0.0838, 7 => 0.0853, 6 => 0.0869, 5 => 0.0885, 4 => 0.0901, 3 => 0.0918, 2 => 0.0934, 1 => 0.0951, 0 => 0.0968],
				'-1.2' => [9 => 0.0985, 8 => 0.1003, 7 => 0.1020, 6 => 0.1038, 5 => 0.1056, 4 => 0.1075, 3 => 0.1093, 2 => 0.1112, 1 => 0.1131, 0 => 0.1151],
				'-1.1' => [9 => 0.1170, 8 => 0.1190, 7 => 0.1210, 6 => 0.1230, 5 => 0.1251, 4 => 0.1271, 3 => 0.1292, 2 => 0.1314, 1 => 0.1335, 0 => 0.1357],
				'-1.0' => [9 => 0.1379, 8 => 0.1401, 7 => 0.1423, 6 => 0.1446, 5 => 0.1469, 4 => 0.1492, 3 => 0.1515, 2 => 0.1539, 1 => 0.1562, 0 => 0.1587],
				'-0.9' => [9 => 0.1611, 8 => 0.1635, 7 => 0.1660, 6 => 0.1685, 5 => 0.1711, 4 => 0.1736, 3 => 0.1762, 2 => 0.1788, 1 => 0.1814, 0 => 0.1841],
				'-0.8' => [9 => 0.1867, 8 => 0.1894, 7 => 0.1922, 6 => 0.1949, 5 => 0.1977, 4 => 0.2005, 3 => 0.2033, 2 => 0.2061, 1 => 0.2090, 0 => 0.2119],
				'-0.7' => [9 => 0.2148, 8 => 0.2177, 7 => 0.2206, 6 => 0.2236, 5 => 0.2266, 4 => 0.2296, 3 => 0.2327, 2 => 0.2358, 1 => 0.2389, 0 => 0.2420],
				'-0.6' => [9 => 0.2451, 8 => 0.2483, 7 => 0.2514, 6 => 0.2546, 5 => 0.2578, 4 => 0.2611, 3 => 0.2643, 2 => 0.2676, 1 => 0.2709, 0 => 0.2743],
				'-0.5' => [9 => 0.2776, 8 => 0.2810, 7 => 0.2843, 6 => 0.2877, 5 => 0.2912, 4 => 0.2946, 3 => 0.2981, 2 => 0.3015, 1 => 0.3050, 0 => 0.3085],
				'-0.4' => [9 => 0.3121, 8 => 0.3156, 7 => 0.3192, 6 => 0.3228, 5 => 0.3264, 4 => 0.3300, 3 => 0.3336, 2 => 0.3372, 1 => 0.3409, 0 => 0.3446],
				'-0.3' => [9 => 0.3483, 8 => 0.3520, 7 => 0.3557, 6 => 0.3594, 5 => 0.3632, 4 => 0.3669, 3 => 0.3707, 2 => 0.3745, 1 => 0.3783, 0 => 0.3821],
				'-0.2' => [9 => 0.3829, 8 => 0.3897, 7 => 0.3936, 6 => 0.3974, 5 => 0.4013, 4 => 0.4052, 3 => 0.4090, 2 => 0.4129, 1 => 0.4168, 0 => 0.4207],
				'-0.1' => [9 => 0.4247, 8 => 0.4286, 7 => 0.4325, 6 => 0.4364, 5 => 0.4404, 4 => 0.4443, 3 => 0.4483, 2 => 0.4522, 1 => 0.4562, 0 => 0.4602],
				'-0.0' => [9 => 0.4641, 8 => 0.4681, 7 => 0.4721, 6 => 0.4761, 5 => 0.4801, 4 => 0.4840, 3 => 0.4880, 2 => 0.4920, 1 => 0.4960, 0 => 0.5000],
				'0.0' => [0 => 0.50000, 1 => 0.50399, 2 => 0.50798, 3 => 0.51197, 4 => 0.51595, 5 => 0.51994, 6 => 0.52392, 7 => 0.52790, 8 => 0.53188, 9 => 0.53586],
				'0.1' => [0 => 0.53980, 1 => 0.54380, 2 => 0.54776, 3 => 0.55172, 4 => 0.55567, 5 => 0.55966, 6 => 0.56360, 7 => 0.56749, 8 => 0.57142, 9 => 0.57535],
				'0.2' => [0 => 0.57930, 1 => 0.58317, 2 => 0.58706, 3 => 0.59095, 4 => 0.59483, 5 => 0.59871, 6 => 0.60257, 7 => 0.60642, 8 => 0.61026, 9 => 0.61409],
				'0.3' => [0 => 0.61791, 1 => 0.62172, 2 => 0.62552, 3 => 0.62930, 4 => 0.63307, 5 => 0.63683, 6 => 0.64058, 7 => 0.64431, 8 => 0.64803, 9 => 0.65173],
				'0.4' => [0 => 0.65542, 1 => 0.65910, 2 => 0.66276, 3 => 0.66640, 4 => 0.67003, 5 => 0.67364, 6 => 0.67724, 7 => 0.68082, 8 => 0.68439, 9 => 0.68793],
				'0.5' => [0 => 0.69146, 1 => 0.69497, 2 => 0.69847, 3 => 0.70194, 4 => 0.70540, 5 => 0.70884, 6 => 0.71226, 7 => 0.71566, 8 => 0.71904, 9 => 0.72240],
				'0.6' => [0 => 0.72575, 1 => 0.72907, 2 => 0.73237, 3 => 0.73565, 4 => 0.73891, 5 => 0.74215, 6 => 0.74537, 7 => 0.74857, 8 => 0.75175, 9 => 0.75490],
				'0.7' => [0 => 0.75804, 1 => 0.76115, 2 => 0.76424, 3 => 0.76730, 4 => 0.77035, 5 => 0.77337, 6 => 0.77637, 7 => 0.77935, 8 => 0.78230, 9 => 0.78524],
				'0.8' => [0 => 0.78814, 1 => 0.79103, 2 => 0.79389, 3 => 0.79673, 4 => 0.79955, 5 => 0.80234, 6 => 0.80511, 7 => 0.80785, 8 => 0.81057, 9 => 0.81327],
				'0.9' => [0 => 0.81594, 1 => 0.81859, 2 => 0.82121, 3 => 0.82381, 4 => 0.82639, 5 => 0.82894, 6 => 0.83147, 7 => 0.83398, 8 => 0.83646, 9 => 0.83891],
				'1.0' => [0 => 0.84134, 1 => 0.84375, 2 => 0.84614, 3 => 0.84849, 4 => 0.85083, 5 => 0.85314, 6 => 0.85543, 7 => 0.85769, 8 => 0.85993, 9 => 0.86214],
				'1.1' => [0 => 0.86433, 1 => 0.86650, 2 => 0.86864, 3 => 0.87076, 4 => 0.87286, 5 => 0.87493, 6 => 0.87698, 7 => 0.87900, 8 => 0.88100, 9 => 0.88298],
				'1.2' => [0 => 0.88493, 1 => 0.88686, 2 => 0.88877, 3 => 0.89065, 4 => 0.89251, 5 => 0.89435, 6 => 0.89617, 7 => 0.89796, 8 => 0.89973, 9 => 0.90147],
				'1.3' => [0 => 0.90320, 1 => 0.90490, 2 => 0.90658, 3 => 0.90824, 4 => 0.90988, 5 => 0.91149, 6 => 0.91308, 7 => 0.91466, 8 => 0.91621, 9 => 0.91774],
				'1.4' => [0 => 0.91924, 1 => 0.92073, 2 => 0.92220, 3 => 0.92364, 4 => 0.92507, 5 => 0.92647, 6 => 0.92785, 7 => 0.92922, 8 => 0.93056, 9 => 0.93189],
				'1.5' => [0 => 0.93319, 1 => 0.93448, 2 => 0.93574, 3 => 0.93699, 4 => 0.93822, 5 => 0.93943, 6 => 0.94062, 7 => 0.94179, 8 => 0.94295, 9 => 0.94408],
				'1.6' => [0 => 0.94520, 1 => 0.94630, 2 => 0.94738, 3 => 0.94845, 4 => 0.94950, 5 => 0.95053, 6 => 0.95154, 7 => 0.95254, 8 => 0.95352, 9 => 0.95449],
				'1.7' => [0 => 0.95543, 1 => 0.95637, 2 => 0.95728, 3 => 0.95818, 4 => 0.95907, 5 => 0.95994, 6 => 0.96080, 7 => 0.96164, 8 => 0.96246, 9 => 0.96327],
				'1.8' => [0 => 0.96407, 1 => 0.96485, 2 => 0.96562, 3 => 0.96638, 4 => 0.96712, 5 => 0.96784, 6 => 0.96856, 7 => 0.96926, 8 => 0.96995, 9 => 0.97062],
				'1.9' => [0 => 0.97128, 1 => 0.97193, 2 => 0.97257, 3 => 0.97320, 4 => 0.97381, 5 => 0.97441, 6 => 0.97500, 7 => 0.97558, 8 => 0.97615, 9 => 0.97670],
				'2.0' => [0 => 0.97725, 1 => 0.97778, 2 => 0.97831, 3 => 0.97882, 4 => 0.97932, 5 => 0.97982, 6 => 0.98030, 7 => 0.98077, 8 => 0.98124, 9 => 0.98169],
				'2.1' => [0 => 0.98214, 1 => 0.98257, 2 => 0.98300, 3 => 0.98341, 4 => 0.98382, 5 => 0.98422, 6 => 0.98461, 7 => 0.98500, 8 => 0.98537, 9 => 0.98574],
				'2.2' => [0 => 0.98610, 1 => 0.98645, 2 => 0.98679, 3 => 0.98713, 4 => 0.98745, 5 => 0.98778, 6 => 0.98809, 7 => 0.98840, 8 => 0.98870, 9 => 0.98899],
				'2.3' => [0 => 0.98928, 1 => 0.98956, 2 => 0.98983, 3 => 0.99010, 4 => 0.99036, 5 => 0.99061, 6 => 0.99086, 7 => 0.99111, 8 => 0.99134, 9 => 0.99158],
				'2.4' => [0 => 0.99180, 1 => 0.99202, 2 => 0.99224, 3 => 0.99245, 4 => 0.99266, 5 => 0.99286, 6 => 0.99305, 7 => 0.99324, 8 => 0.99343, 9 => 0.99361],
				'2.5' => [0 => 0.99379, 1 => 0.99396, 2 => 0.99413, 3 => 0.99430, 4 => 0.99446, 5 => 0.99461, 6 => 0.99477, 7 => 0.99492, 8 => 0.99506, 9 => 0.99520],
				'2.6' => [0 => 0.99534, 1 => 0.99547, 2 => 0.99560, 3 => 0.99573, 4 => 0.99585, 5 => 0.99598, 6 => 0.99609, 7 => 0.99621, 8 => 0.99632, 9 => 0.99643],
				'2.7' => [0 => 0.99653, 1 => 0.99664, 2 => 0.99674, 3 => 0.99683, 4 => 0.99693, 5 => 0.99702, 6 => 0.99711, 7 => 0.99720, 8 => 0.99728, 9 => 0.99736],
				'2.8' => [0 => 0.99744, 1 => 0.99752, 2 => 0.99760, 3 => 0.99767, 4 => 0.99774, 5 => 0.99781, 6 => 0.99788, 7 => 0.99795, 8 => 0.99801, 9 => 0.99807],
				'2.9' => [0 => 0.99813, 1 => 0.99819, 2 => 0.99825, 3 => 0.99831, 4 => 0.99836, 5 => 0.99841, 6 => 0.99846, 7 => 0.99851, 8 => 0.99856, 9 => 0.99861],
				'3.0' => [0 => 0.99865, 1 => 0.99869, 2 => 0.99874, 3 => 0.99878, 4 => 0.99882, 5 => 0.99886, 6 => 0.99889, 7 => 0.99893, 8 => 0.99896, 9 => 0.99900],
				'3.1' => [0 => 0.99903, 1 => 0.99906, 2 => 0.99910, 3 => 0.99913, 4 => 0.99916, 5 => 0.99918, 6 => 0.99921, 7 => 0.99924, 8 => 0.99926, 9 => 0.99929],
				'3.2' => [0 => 0.99931, 1 => 0.99934, 2 => 0.99936, 3 => 0.99938, 4 => 0.99940, 5 => 0.99942, 6 => 0.99944, 7 => 0.99946, 8 => 0.99948, 9 => 0.99950],
				'3.3' => [0 => 0.99952, 1 => 0.99953, 2 => 0.99955, 3 => 0.99957, 4 => 0.99958, 5 => 0.99960, 6 => 0.99961, 7 => 0.99962, 8 => 0.99964, 9 => 0.99965],
				'3.4' => [0 => 0.99966, 1 => 0.99968, 2 => 0.99969, 3 => 0.99970, 4 => 0.99971, 5 => 0.99972, 6 => 0.99973, 7 => 0.99974, 8 => 0.99975, 9 => 0.99976],
				'3.5' => [0 => 0.99977, 1 => 0.99978, 2 => 0.99978, 3 => 0.99979, 4 => 0.99980, 5 => 0.99981, 6 => 0.99981, 7 => 0.99982, 8 => 0.99983, 9 => 0.99983],
				'3.6' => [0 => 0.99984, 1 => 0.99985, 2 => 0.99985, 3 => 0.99986, 4 => 0.99986, 5 => 0.99987, 6 => 0.99987, 7 => 0.99988, 8 => 0.99988, 9 => 0.99989],
				'3.7' => [0 => 0.99989, 1 => 0.99990, 2 => 0.99990, 3 => 0.99990, 4 => 0.99991, 5 => 0.99991, 6 => 0.99992, 7 => 0.99992, 8 => 0.99992, 9 => 0.99992],
				'3.8' => [0 => 0.99993, 1 => 0.99993, 2 => 0.99993, 3 => 0.99994, 4 => 0.99994, 5 => 0.99994, 6 => 0.99994, 7 => 0.99995, 8 => 0.99995, 9 => 0.99995],
				'3.9' => [0 => 0.99995, 1 => 0.99995, 2 => 0.99996, 3 => 0.99996, 4 => 0.99996, 5 => 0.99996, 6 => 0.99996, 7 => 0.99996, 8 => 0.99997, 9 => 0.99997],
				'4.0' => [0 => 0.99997, 1 => 0.99997, 2 => 0.99997, 3 => 0.99997, 4 => 0.99997, 5 => 0.99997, 6 => 0.99998, 7 => 0.99998, 8 => 0.99998, 9 => 0.99998],
			];
			// function zain($rz){
			$rz_check = str_split($rz);
			if (count($rz_check) > 1) {
				if ($rz < 0) {
					if (count($rz_check) == 2) {
						$rz_val1 = $rz_check;
						$rz_val1[2] = '.0';
						$rz_val1 = $rz_val1[0] . $rz_val1[1] . $rz_val1[2];
						$rz_val2 = 0;
					} else {
						if (strlen($rz) > 3) {
							$rz_val1 = $rz_check[0] . $rz_check[1] . $rz_check[2] . $rz_check[3];
						}
						if (strlen($rz) > 4) {
							$rz_val2 = $rz_check[4];
						} else {
							$rz_val2 = 0;
						}
					}
				} else {
					if (strlen($rz) > 2) {
						$rz_val1 = $rz_check[0] . $rz_check[1] . $rz_check[2];
					}
					if (strlen($rz) > 3) {
						$rz_val2 = $rz_check[3];
					} else {
						$rz_val2 = 0;
					}
				}
			} else {
				$rz_val1 = $rz_check;
				$rz_val1[1] = '.0';
				$rz_val1 = $rz_val1[0] . $rz_val1[1];
				$rz_val2 = 0;
			}
			if ($rz >= 4.1) {
				$ltpv = 1;
				$rtpv = 0;
			} elseif ($rz <= -4.1) {
				$ltpv = 0;
				$rtpv = 1;
			} else {
				$ltpv = number_format(($z_table[$rz_val1][$rz_val2]), 5);
				$rtpv = number_format((1 - $ltpv), 5);
			}
			$ttcl = $ltpv - $rtpv;
			$ttpv = 1 - abs($ttcl);
			$z_url = 'z_score_';
			$rz = trim($rz);
			if ($rz < -0.126 && $rz > -0.376) {
				$z_url = 'z_score_-0.25';
			} elseif ($rz < -0.375 && $rz > -0.626) {
				$z_url = 'z_score_-0.5';
			} elseif ($rz < -0.625 && $rz > -0.876) {
				$z_url = 'z_score_-0.75';
			} elseif ($rz < -0.875 && $rz > -1.126) {
				$z_url = 'z_score_-1';
			} elseif ($rz < -1.125 && $rz > -1.376) {
				$z_url = 'z_score_-1.25';
			} elseif ($rz < -1.375 && $rz > -1.626) {
				$z_url = 'z_score_-1.5';
			} elseif ($rz < -1.625 && $rz > -1.876) {
				$z_url = 'z_score_-1.75';
			} elseif ($rz < -1.875 && $rz > -2.126) {
				$z_url = 'z_score_-2';
			} elseif ($rz < -2.125 && $rz > -2.376) {
				$z_url = 'z_score_-2.25';
			} elseif ($rz < -2.375 && $rz > -2.626) {
				$z_url = 'z_score_-2.5';
			} elseif ($rz < -2.625 && $rz > -2.876) {
				$z_url = 'z_score_-2.75';
			} elseif ($rz < -2.875 && $rz > -3.126) {
				$z_url = 'z_score_-3';
			} elseif ($rz < -3.125 && $rz > -3.376) {
				$z_url = 'z_score_-3.25';
			} elseif ($rz < -3.375 && $rz > -3.626) {
				$z_url = 'z_score_-3.5';
			} elseif ($rz < -3.625 && $rz > -3.876) {
				$z_url = 'z_score_-3.75';
			} elseif ($rz < -3.875 && $rz > -4.126) {
				$z_url = 'z_score_-4';
			} elseif ($rz < -4.125) {
				$z_url = 'z_score_-4.25';
			} elseif ($rz > -0.126 && $rz < 0.125) {
				$z_url = 'z_score_0';
			} elseif ($rz > 0.124 && $rz < 0.375) {
				$z_url = 'z_score_0.25';
			} elseif ($rz > 0.374 && $rz < 0.625) {
				$z_url = 'z_score_0.5';
			} elseif ($rz > 0.624 && $rz < 0.875) {
				$z_url = 'z_score_0.75';
			} elseif ($rz > 0.874 && $rz < 1.125) {
				$z_url = 'z_score_1';
			} elseif ($rz > 1.124 && $rz < 1.375) {
				$z_url = 'z_score_1.25';
			} elseif ($rz > 1.374 && $rz < 1.625) {
				$z_url = 'z_score_1.5';
			} elseif ($rz > 1.624 && $rz < 1.875) {
				$z_url = 'z_score_1.75';
			} elseif ($rz > 1.874 && $rz < 2.125) {
				$z_url = 'z_score_2';
			} elseif ($rz > 2.124 && $rz < 2.375) {
				$z_url = 'z_score_2.25';
			} elseif ($rz > 2.374 && $rz < 2.625) {
				$z_url = 'z_score_2.5';
			} elseif ($rz > 2.624 && $rz < 2.875) {
				$z_url = 'z_score_2.75';
			} elseif ($rz > 2.874 && $rz < 3.125) {
				$z_url = 'z_score_3';
			} elseif ($rz > 3.124 && $rz < 3.375) {
				$z_url = 'z_score_3.25';
			} elseif ($rz > 3.374 && $rz < 3.625) {
				$z_url = 'z_score_3.5';
			} elseif ($rz > 3.624 && $rz < 3.875) {
				$z_url = 'z_score_3.75';
			} elseif ($rz > 3.874 && $rz < 4.125) {
				$z_url = 'z_score_4';
			} elseif ($rz > 4.124) {
				$z_url = 'z_score_4.25';
			}
			$rz = round($rz, 4);
			return array($z_url, $ltpv, $rtpv, $ttpv, $ttcl, $rz);
		}
		function zinv($p)
		{
			$a1 = -39.6968302866538;
			$a2 = 220.946098424521;
			$a3 = -275.928510446969;
			$a4 = 138.357751867269;
			$a5 = -30.6647980661472;
			$a6 = 2.50662827745924;
			$b1 = -54.4760987982241;
			$b2 = 161.585836858041;
			$b3 = -155.698979859887;
			$b4 = 66.8013118877197;
			$b5 = -13.2806815528857;
			$c1 = -7.78489400243029E-03;
			$c2 = -0.322396458041136;
			$c3 = -2.40075827716184;
			$c4 = -2.54973253934373;
			$c5 = 4.37466414146497;
			$c6 = 2.93816398269878;
			$d1 = 7.78469570904146E-03;
			$d2 = 0.32246712907004;
			$d3 = 2.445134137143;
			$d4 = 3.75440866190742;
			$p_low = 0.02425;
			$p_high = 1 - $p_low;
			if (($p < 0) || ($p > 1)) {
				$err = "p out of range.";
				$retVal = 0;
			} elseif ($p < $p_low) {
				$q = sqrt(-2 * log($p));
				$retVal = ((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) / (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
			} elseif ($p <= $p_high) {
				$q = $p - 0.5;
				$r = $q * $q;
				$retVal = ((((($a1 * $r + $a2) * $r + $a3) * $r + $a4) * $r + $a5) * $r + $a6) * $q / ((((($b1 * $r + $b2) * $r + $b3) * $r + $b4) * $r + $b5) * $r + 1);
			} else {
				$q = sqrt(-2 * log(1 - $p));
				$retVal = - ((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) / (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
			}

			return $retVal;
		}
		function zProb($z)
		{
			if ($z < -7) {
				return 0.0;
			}
			if ($z > 7) {
				return 1.0;
			}


			if ($z < 0.0) {
				$flag = true;
			} else {
				$flag = false;
			}

			$z = abs($z);
			$b = 0.0;
			$s = sqrt(2) / 3 * $z;
			$HH = .5;
			for ($i = 0; $i < 12; $i++) {
				$a = exp(((-1) * $HH) * $HH / 9) * sin($HH * $s) / $HH;
				$b = $b + $a;
				$HH = $HH + 1.0;
			}
			$p = .5 - $b / pi();
			if (!$flag) {
				$p = 1.0 - $p;
			}
			return $p;
		}
		if ($operations == "3") {
			if ($find_compare == "1") {
				if (is_numeric($f_first) && is_numeric($f_second) && is_numeric($f_third)) {
					if ($f_first > 0 && $f_first < 1) {
						if ($f_third > 0) {
							$x1 = zinv($f_first);
							$x1 = (-1 * $f_second) + $f_third * $x1;
							$ul = $f_second + 3.1 * $f_third;
							$ll = -1 * $x1;
							$above = round(10000000 * $ll) / 10000000;
							$x1 = zinv($f_first);
							$x1 = $f_second + $f_third * $x1;
							$ul = $x1;
							$blow = round(10000000 * $ul) / 10000000;
							$f_first2 = $f_first / 2;
							$x1 = zinv(0.5 - $f_first2);
							$ll = $x1;
							$ul = -1 * $x1;
							$ll = round(($f_second + $f_third * $ll) * 100000000) / 100000000;
							$ul = round(($f_second + $f_third * $ul) * 100000000) / 100000000;
							$f_first2 = $f_first / 2;
							$x1 = zinv($f_first2);
							$ll1 = $x1;
							$ul1 = -1 * $x1;
							$ll1 = round(($f_second + $f_third * $ll1) * 100000000) / 100000000;
							$ul1 = round(($f_second + $f_third * $ul1) * 100000000) / 100000000;
							$option1 = 1;
							// $z_url='z_score_'.$f_first;
							$z_url = 'z_score_';
							$rz = trim($f_first);
							if ($rz < -0.126 && $rz > -0.376) {
								$z_url = 'z_score_-0.25';
							} elseif ($rz < -0.375 && $rz > -0.626) {
								$z_url = 'z_score_-0.5';
							} elseif ($rz < -0.625 && $rz > -0.876) {
								$z_url = 'z_score_-0.75';
							} elseif ($rz < -0.875 && $rz > -1.126) {
								$z_url = 'z_score_-1';
							} elseif ($rz < -1.125 && $rz > -1.376) {
								$z_url = 'z_score_-1.25';
							} elseif ($rz < -1.375 && $rz > -1.626) {
								$z_url = 'z_score_-1.5';
							} elseif ($rz < -1.625 && $rz > -1.876) {
								$z_url = 'z_score_-1.75';
							} elseif ($rz < -1.875 && $rz > -2.126) {
								$z_url = 'z_score_-2';
							} elseif ($rz < -2.125 && $rz > -2.376) {
								$z_url = 'z_score_-2.25';
							} elseif ($rz < -2.375 && $rz > -2.626) {
								$z_url = 'z_score_-2.5';
							} elseif ($rz < -2.625 && $rz > -2.876) {
								$z_url = 'z_score_-2.75';
							} elseif ($rz < -2.875 && $rz > -3.126) {
								$z_url = 'z_score_-3';
							} elseif ($rz < -3.125 && $rz > -3.376) {
								$z_url = 'z_score_-3.25';
							} elseif ($rz < -3.375 && $rz > -3.626) {
								$z_url = 'z_score_-3.5';
							} elseif ($rz < -3.625 && $rz > -3.876) {
								$z_url = 'z_score_-3.75';
							} elseif ($rz < -3.875 && $rz > -4.126) {
								$z_url = 'z_score_-4';
							} elseif ($rz < -4.125) {
								$z_url = 'z_score_-4.25';
							} elseif ($rz > -0.126 && $rz < 0.125) {
								$z_url = 'z_score_0';
							} elseif ($rz > 0.124 && $rz < 0.375) {
								$z_url = 'z_score_0.25';
							} elseif ($rz > 0.374 && $rz < 0.625) {
								$z_url = 'z_score_0.5';
							} elseif ($rz > 0.624 && $rz < 0.875) {
								$z_url = 'z_score_0.75';
							} elseif ($rz > 0.874 && $rz < 1.125) {
								$z_url = 'z_score_1';
							} elseif ($rz > 1.124 && $rz < 1.375) {
								$z_url = 'z_score_1.25';
							} elseif ($rz > 1.374 && $rz < 1.625) {
								$z_url = 'z_score_1.5';
							} elseif ($rz > 1.624 && $rz < 1.875) {
								$z_url = 'z_score_1.75';
							} elseif ($rz > 1.874 && $rz < 2.125) {
								$z_url = 'z_score_2';
							} elseif ($rz > 2.124 && $rz < 2.375) {
								$z_url = 'z_score_2.25';
							} elseif ($rz > 2.374 && $rz < 2.625) {
								$z_url = 'z_score_2.5';
							} elseif ($rz > 2.624 && $rz < 2.875) {
								$z_url = 'z_score_2.75';
							} elseif ($rz > 2.874 && $rz < 3.125) {
								$z_url = 'z_score_3';
							} elseif ($rz > 3.124 && $rz < 3.375) {
								$z_url = 'z_score_3.25';
							} elseif ($rz > 3.374 && $rz < 3.625) {
								$z_url = 'z_score_3.5';
							} elseif ($rz > 3.624 && $rz < 3.875) {
								$z_url = 'z_score_3.75';
							} elseif ($rz > 3.874 && $rz < 4.125) {
								$z_url = 'z_score_4';
							} elseif ($rz > 4.124) {
								$z_url = 'z_score_4.25';
							}
							$this->param['z_url'] = $z_url;
							$this->param['above_first'] = $above;
							$this->param['blow_first'] = $blow;
							$this->param['ll_first'] = $ll;
							$this->param['ul_first'] = $ul;
							$this->param['ll1_first'] = $ll1;
							$this->param['ul1_first'] = $ul1;
							$this->param['option1'] = $option1;
						} else {
							$this->param['error'] = "The standard deviation must be greater than zero.";
							return $this->param;
						}
					} else {
						$this->param['error'] = "Probability must be between 0 and 1.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else if ($find_compare == "2") {
				if (is_numeric($f_first) && is_numeric($f_second) && is_numeric($f_third)) {
					if ($f_third > 0) {
						$ms_first = $f_first - $f_second;
						$rz_first = ($f_first - $f_second) / $f_third;
						$zaini_first = zain($rz_first);
						$rz_first = trim($rz_first);
						$option2 = 2;
						$z_url = 'z_score_';
						$rz = trim(abs($zaini_first[1]));
						if ($rz < -0.126 && $rz > -0.376) {
							$z_url = 'z_score_-0.25';
						} elseif ($rz < -0.375 && $rz > -0.626) {
							$z_url = 'z_score_-0.5';
						} elseif ($rz < -0.625 && $rz > -0.876) {
							$z_url = 'z_score_-0.75';
						} elseif ($rz < -0.875 && $rz > -1.126) {
							$z_url = 'z_score_-1';
						} elseif ($rz < -1.125 && $rz > -1.376) {
							$z_url = 'z_score_-1.25';
						} elseif ($rz < -1.375 && $rz > -1.626) {
							$z_url = 'z_score_-1.5';
						} elseif ($rz < -1.625 && $rz > -1.876) {
							$z_url = 'z_score_-1.75';
						} elseif ($rz < -1.875 && $rz > -2.126) {
							$z_url = 'z_score_-2';
						} elseif ($rz < -2.125 && $rz > -2.376) {
							$z_url = 'z_score_-2.25';
						} elseif ($rz < -2.375 && $rz > -2.626) {
							$z_url = 'z_score_-2.5';
						} elseif ($rz < -2.625 && $rz > -2.876) {
							$z_url = 'z_score_-2.75';
						} elseif ($rz < -2.875 && $rz > -3.126) {
							$z_url = 'z_score_-3';
						} elseif ($rz < -3.125 && $rz > -3.376) {
							$z_url = 'z_score_-3.25';
						} elseif ($rz < -3.375 && $rz > -3.626) {
							$z_url = 'z_score_-3.5';
						} elseif ($rz < -3.625 && $rz > -3.876) {
							$z_url = 'z_score_-3.75';
						} elseif ($rz < -3.875 && $rz > -4.126) {
							$z_url = 'z_score_-4';
						} elseif ($rz < -4.125) {
							$z_url = 'z_score_-4.25';
						} elseif ($rz > -0.126 && $rz < 0.125) {
							$z_url = 'z_score_0';
						} elseif ($rz > 0.124 && $rz < 0.375) {
							$z_url = 'z_score_0.25';
						} elseif ($rz > 0.374 && $rz < 0.625) {
							$z_url = 'z_score_0.5';
						} elseif ($rz > 0.624 && $rz < 0.875) {
							$z_url = 'z_score_0.75';
						} elseif ($rz > 0.874 && $rz < 1.125) {
							$z_url = 'z_score_1';
						} elseif ($rz > 1.124 && $rz < 1.375) {
							$z_url = 'z_score_1.25';
						} elseif ($rz > 1.374 && $rz < 1.625) {
							$z_url = 'z_score_1.5';
						} elseif ($rz > 1.624 && $rz < 1.875) {
							$z_url = 'z_score_1.75';
						} elseif ($rz > 1.874 && $rz < 2.125) {
							$z_url = 'z_score_2';
						} elseif ($rz > 2.124 && $rz < 2.375) {
							$z_url = 'z_score_2.25';
						} elseif ($rz > 2.374 && $rz < 2.625) {
							$z_url = 'z_score_2.5';
						} elseif ($rz > 2.624 && $rz < 2.875) {
							$z_url = 'z_score_2.75';
						} elseif ($rz > 2.874 && $rz < 3.125) {
							$z_url = 'z_score_3';
						} elseif ($rz > 3.124 && $rz < 3.375) {
							$z_url = 'z_score_3.25';
						} elseif ($rz > 3.374 && $rz < 3.625) {
							$z_url = 'z_score_3.5';
						} elseif ($rz > 3.624 && $rz < 3.875) {
							$z_url = 'z_score_3.75';
						} elseif ($rz > 3.874 && $rz < 4.125) {
							$z_url = 'z_score_4';
						} elseif ($rz > 4.124) {
							$z_url = 'z_score_4.25';
						}
						$this->param['z_url'] = $z_url;
						$this->param['z_url_first'] = $zaini_first[0];
						$this->param['ltpv_first'] = abs($zaini_first[1]);
						$this->param['rtpv_first'] = abs($zaini_first[2]);
						$this->param['ttpv_first'] = abs($zaini_first[3]);
						$this->param['ttcl_first'] = abs($zaini_first[4]);
						$this->param['ms_first'] = $ms_first;
						$this->param['rz_first'] = round($rz_first, 4);
						$this->param['option2'] = $option2;
					} else {
						$this->param['error'] = "The standard deviation must be greater than zero.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
		} else if ($operations == "4") {
			if (is_numeric($a)) {
				if (is_numeric($mean) && is_numeric($deviation) && is_numeric($a)) {
					if ($deviation > 0) {
						$ms = $a - $mean;
						$rz = ($a - $mean) / $deviation;
						$zaini = zain($rz);
						// $rz=trim($rz);
						$z_url = 'z_score_';
						$rz = trim(abs($zaini[1]));
						if ($rz < -0.126 && $rz > -0.376) {
							$z_url = 'z_score_-0.25';
						} elseif ($rz < -0.375 && $rz > -0.626) {
							$z_url = 'z_score_-0.5';
						} elseif ($rz < -0.625 && $rz > -0.876) {
							$z_url = 'z_score_-0.75';
						} elseif ($rz < -0.875 && $rz > -1.126) {
							$z_url = 'z_score_-1';
						} elseif ($rz < -1.125 && $rz > -1.376) {
							$z_url = 'z_score_-1.25';
						} elseif ($rz < -1.375 && $rz > -1.626) {
							$z_url = 'z_score_-1.5';
						} elseif ($rz < -1.625 && $rz > -1.876) {
							$z_url = 'z_score_-1.75';
						} elseif ($rz < -1.875 && $rz > -2.126) {
							$z_url = 'z_score_-2';
						} elseif ($rz < -2.125 && $rz > -2.376) {
							$z_url = 'z_score_-2.25';
						} elseif ($rz < -2.375 && $rz > -2.626) {
							$z_url = 'z_score_-2.5';
						} elseif ($rz < -2.625 && $rz > -2.876) {
							$z_url = 'z_score_-2.75';
						} elseif ($rz < -2.875 && $rz > -3.126) {
							$z_url = 'z_score_-3';
						} elseif ($rz < -3.125 && $rz > -3.376) {
							$z_url = 'z_score_-3.25';
						} elseif ($rz < -3.375 && $rz > -3.626) {
							$z_url = 'z_score_-3.5';
						} elseif ($rz < -3.625 && $rz > -3.876) {
							$z_url = 'z_score_-3.75';
						} elseif ($rz < -3.875 && $rz > -4.126) {
							$z_url = 'z_score_-4';
						} elseif ($rz < -4.125) {
							$z_url = 'z_score_-4.25';
						} elseif ($rz > -0.126 && $rz < 0.125) {
							$z_url = 'z_score_0';
						} elseif ($rz > 0.124 && $rz < 0.375) {
							$z_url = 'z_score_0.25';
						} elseif ($rz > 0.374 && $rz < 0.625) {
							$z_url = 'z_score_0.5';
						} elseif ($rz > 0.624 && $rz < 0.875) {
							$z_url = 'z_score_0.75';
						} elseif ($rz > 0.874 && $rz < 1.125) {
							$z_url = 'z_score_1';
						} elseif ($rz > 1.124 && $rz < 1.375) {
							$z_url = 'z_score_1.25';
						} elseif ($rz > 1.374 && $rz < 1.625) {
							$z_url = 'z_score_1.5';
						} elseif ($rz > 1.624 && $rz < 1.875) {
							$z_url = 'z_score_1.75';
						} elseif ($rz > 1.874 && $rz < 2.125) {
							$z_url = 'z_score_2';
						} elseif ($rz > 2.124 && $rz < 2.375) {
							$z_url = 'z_score_2.25';
						} elseif ($rz > 2.374 && $rz < 2.625) {
							$z_url = 'z_score_2.5';
						} elseif ($rz > 2.624 && $rz < 2.875) {
							$z_url = 'z_score_2.75';
						} elseif ($rz > 2.874 && $rz < 3.125) {
							$z_url = 'z_score_3';
						} elseif ($rz > 3.124 && $rz < 3.375) {
							$z_url = 'z_score_3.25';
						} elseif ($rz > 3.374 && $rz < 3.625) {
							$z_url = 'z_score_3.5';
						} elseif ($rz > 3.624 && $rz < 3.875) {
							$z_url = 'z_score_3.75';
						} elseif ($rz > 3.874 && $rz < 4.125) {
							$z_url = 'z_score_4';
						} elseif ($rz > 4.124) {
							$z_url = 'z_score_4.25';
						}
						$this->param['z_url'] = $z_url;
						// $this->param['z_url'] = $zaini[0];
						$this->param['ltpv'] = abs($zaini[1]);
						$this->param['rtpv'] = abs($zaini[2]);
						$this->param['ttpv'] = abs($zaini[3]);
						$this->param['ttcl'] = abs($zaini[4]);
						$this->param['ms'] = $ms;
						$this->param['rz'] = round($rz, 4);
						$this->param['a'] = $a;
					} else {
						$this->param['error'] = "The standard deviation must be greater than zero.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
			if (is_numeric($b)) {
				if (is_numeric($mean) && is_numeric($deviation) && is_numeric($b)) {
					if ($deviation > 0) {
						$ms2 = $b - $mean;
						$rz2 = ($b - $mean) / $deviation;
						$zaini2 = zain($rz2);
						$rz2 = trim($rz2);
						$z_url = 'z_score_';
						$rz = trim(abs($zaini2[2]));
						if ($rz < -0.126 && $rz > -0.376) {
							$z_url = 'z_score_-0.25';
						} elseif ($rz < -0.375 && $rz > -0.626) {
							$z_url = 'z_score_-0.5';
						} elseif ($rz < -0.625 && $rz > -0.876) {
							$z_url = 'z_score_-0.75';
						} elseif ($rz < -0.875 && $rz > -1.126) {
							$z_url = 'z_score_-1';
						} elseif ($rz < -1.125 && $rz > -1.376) {
							$z_url = 'z_score_-1.25';
						} elseif ($rz < -1.375 && $rz > -1.626) {
							$z_url = 'z_score_-1.5';
						} elseif ($rz < -1.625 && $rz > -1.876) {
							$z_url = 'z_score_-1.75';
						} elseif ($rz < -1.875 && $rz > -2.126) {
							$z_url = 'z_score_-2';
						} elseif ($rz < -2.125 && $rz > -2.376) {
							$z_url = 'z_score_-2.25';
						} elseif ($rz < -2.375 && $rz > -2.626) {
							$z_url = 'z_score_-2.5';
						} elseif ($rz < -2.625 && $rz > -2.876) {
							$z_url = 'z_score_-2.75';
						} elseif ($rz < -2.875 && $rz > -3.126) {
							$z_url = 'z_score_-3';
						} elseif ($rz < -3.125 && $rz > -3.376) {
							$z_url = 'z_score_-3.25';
						} elseif ($rz < -3.375 && $rz > -3.626) {
							$z_url = 'z_score_-3.5';
						} elseif ($rz < -3.625 && $rz > -3.876) {
							$z_url = 'z_score_-3.75';
						} elseif ($rz < -3.875 && $rz > -4.126) {
							$z_url = 'z_score_-4';
						} elseif ($rz < -4.125) {
							$z_url = 'z_score_-4.25';
						} elseif ($rz > -0.126 && $rz < 0.125) {
							$z_url = 'z_score_0';
						} elseif ($rz > 0.124 && $rz < 0.375) {
							$z_url = 'z_score_0.25';
						} elseif ($rz > 0.374 && $rz < 0.625) {
							$z_url = 'z_score_0.5';
						} elseif ($rz > 0.624 && $rz < 0.875) {
							$z_url = 'z_score_0.75';
						} elseif ($rz > 0.874 && $rz < 1.125) {
							$z_url = 'z_score_1';
						} elseif ($rz > 1.124 && $rz < 1.375) {
							$z_url = 'z_score_1.25';
						} elseif ($rz > 1.374 && $rz < 1.625) {
							$z_url = 'z_score_1.5';
						} elseif ($rz > 1.624 && $rz < 1.875) {
							$z_url = 'z_score_1.75';
						} elseif ($rz > 1.874 && $rz < 2.125) {
							$z_url = 'z_score_2';
						} elseif ($rz > 2.124 && $rz < 2.375) {
							$z_url = 'z_score_2.25';
						} elseif ($rz > 2.374 && $rz < 2.625) {
							$z_url = 'z_score_2.5';
						} elseif ($rz > 2.624 && $rz < 2.875) {
							$z_url = 'z_score_2.75';
						} elseif ($rz > 2.874 && $rz < 3.125) {
							$z_url = 'z_score_3';
						} elseif ($rz > 3.124 && $rz < 3.375) {
							$z_url = 'z_score_3.25';
						} elseif ($rz > 3.374 && $rz < 3.625) {
							$z_url = 'z_score_3.5';
						} elseif ($rz > 3.624 && $rz < 3.875) {
							$z_url = 'z_score_3.75';
						} elseif ($rz > 3.874 && $rz < 4.125) {
							$z_url = 'z_score_4';
						} elseif ($rz > 4.124) {
							$z_url = 'z_score_4.25';
						}
						$this->param['z_url2'] = $z_url;
						// $this->param['z_url2'] = $zaini2[0];
						$this->param['ltpv2'] = abs($zaini2[1]);
						$this->param['rtpv2'] = abs($zaini2[2]);
						$this->param['ttpv2'] = abs($zaini2[3]);
						$this->param['ttcl2'] = abs($zaini2[4]);
						$this->param['ms2'] = $ms2;
						$this->param['rz2'] = round($rz2, 4);
						$this->param['b'] = $b;
					} else {
						$this->param['error'] = "The standard deviation must be greater than zero.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
			if (is_numeric($c)) {
				if (is_numeric($mean) && is_numeric($deviation) && is_numeric($c)) {
					if ($deviation > 0) {
						if ($c > 0 && $c < 1) {
							$x1 = zinv($c);
							$x1 = (-1 * $mean) + $deviation * $x1;
							$ul = $mean + 3.1 * $deviation;
							$ll = -1 * $x1;
							$above = round(10000000 * $ll) / 10000000;
							$x1 = zinv($c);
							$x1 = $mean + $deviation * $x1;
							$ul = $x1;
							$blow = round(10000000 * $ul) / 10000000;
							$c2 = $c / 2;
							$x1 = zinv(0.5 - $c2);
							$ll = $x1;
							$ul = -1 * $x1;
							$ll = round(($mean + $deviation * $ll) * 100000000) / 100000000;
							$ul = round(($mean + $deviation * $ul) * 100000000) / 100000000;
							$c2 = $c / 2;
							$x1 = zinv($c2);
							$ll1 = $x1;
							$ul1 = -1 * $x1;
							$ll1 = round(($mean + $deviation * $ll1) * 100000000) / 100000000;
							$ul1 = round(($mean + $deviation * $ul1) * 100000000) / 100000000;
							$z_url = 'z_score_';
							$rz = trim($c);
							if ($rz < -0.126 && $rz > -0.376) {
								$z_url = 'z_score_-0.25';
							} elseif ($rz < -0.375 && $rz > -0.626) {
								$z_url = 'z_score_-0.5';
							} elseif ($rz < -0.625 && $rz > -0.876) {
								$z_url = 'z_score_-0.75';
							} elseif ($rz < -0.875 && $rz > -1.126) {
								$z_url = 'z_score_-1';
							} elseif ($rz < -1.125 && $rz > -1.376) {
								$z_url = 'z_score_-1.25';
							} elseif ($rz < -1.375 && $rz > -1.626) {
								$z_url = 'z_score_-1.5';
							} elseif ($rz < -1.625 && $rz > -1.876) {
								$z_url = 'z_score_-1.75';
							} elseif ($rz < -1.875 && $rz > -2.126) {
								$z_url = 'z_score_-2';
							} elseif ($rz < -2.125 && $rz > -2.376) {
								$z_url = 'z_score_-2.25';
							} elseif ($rz < -2.375 && $rz > -2.626) {
								$z_url = 'z_score_-2.5';
							} elseif ($rz < -2.625 && $rz > -2.876) {
								$z_url = 'z_score_-2.75';
							} elseif ($rz < -2.875 && $rz > -3.126) {
								$z_url = 'z_score_-3';
							} elseif ($rz < -3.125 && $rz > -3.376) {
								$z_url = 'z_score_-3.25';
							} elseif ($rz < -3.375 && $rz > -3.626) {
								$z_url = 'z_score_-3.5';
							} elseif ($rz < -3.625 && $rz > -3.876) {
								$z_url = 'z_score_-3.75';
							} elseif ($rz < -3.875 && $rz > -4.126) {
								$z_url = 'z_score_-4';
							} elseif ($rz < -4.125) {
								$z_url = 'z_score_-4.25';
							} elseif ($rz > -0.126 && $rz < 0.125) {
								$z_url = 'z_score_0';
							} elseif ($rz > 0.124 && $rz < 0.375) {
								$z_url = 'z_score_0.25';
							} elseif ($rz > 0.374 && $rz < 0.625) {
								$z_url = 'z_score_0.5';
							} elseif ($rz > 0.624 && $rz < 0.875) {
								$z_url = 'z_score_0.75';
							} elseif ($rz > 0.874 && $rz < 1.125) {
								$z_url = 'z_score_1';
							} elseif ($rz > 1.124 && $rz < 1.375) {
								$z_url = 'z_score_1.25';
							} elseif ($rz > 1.374 && $rz < 1.625) {
								$z_url = 'z_score_1.5';
							} elseif ($rz > 1.624 && $rz < 1.875) {
								$z_url = 'z_score_1.75';
							} elseif ($rz > 1.874 && $rz < 2.125) {
								$z_url = 'z_score_2';
							} elseif ($rz > 2.124 && $rz < 2.375) {
								$z_url = 'z_score_2.25';
							} elseif ($rz > 2.374 && $rz < 2.625) {
								$z_url = 'z_score_2.5';
							} elseif ($rz > 2.624 && $rz < 2.875) {
								$z_url = 'z_score_2.75';
							} elseif ($rz > 2.874 && $rz < 3.125) {
								$z_url = 'z_score_3';
							} elseif ($rz > 3.124 && $rz < 3.375) {
								$z_url = 'z_score_3.25';
							} elseif ($rz > 3.374 && $rz < 3.625) {
								$z_url = 'z_score_3.5';
							} elseif ($rz > 3.624 && $rz < 3.875) {
								$z_url = 'z_score_3.75';
							} elseif ($rz > 3.874 && $rz < 4.125) {
								$z_url = 'z_score_4';
							} elseif ($rz > 4.124) {
								$z_url = 'z_score_4.25';
							}
							$this->param['z_urlc'] = $z_url;
							$this->param['above'] = $above;
							$this->param['blow'] = $blow;
							$this->param['ll'] = $ll;
							$this->param['ul'] = $ul;
							$this->param['ll1'] = $ll1;
							$this->param['ul1'] = $ul1;
							$this->param['c'] = $c;
						} else {
							$this->param['error'] = "Probability must be between 0 and 1.";
							return $this->param;
						}
					} else {
						$this->param['error'] = "The standard deviation must be greater than zero.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
			if (is_numeric($d)) {
				if (is_numeric($mean) && is_numeric($deviation) && is_numeric($d)) {
					if ($deviation > 0) {
						if ($d > 0 && $d < 1) {
							$x1 = zinv($d);
							$x1 = (-1 * $mean) + $deviation * $x1;
							$ul = $mean + 3.1 * $deviation;
							$ll = -1 * $x1;
							$above = round(10000000 * $ll) / 10000000;
							$x1 = zinv($d);
							$x1 = $mean + $deviation * $x1;
							$ul = $x1;
							$blow = round(10000000 * $ul) / 10000000;
							$d2 = $d / 2;
							$x1 = zinv(0.5 - $d2);
							$ll = $x1;
							$ul = -1 * $x1;
							$ll = round(($mean + $deviation * $ll) * 100000000) / 100000000;
							$ul = round(($mean + $deviation * $ul) * 100000000) / 100000000;
							$d2 = $d / 2;
							$x1 = zinv($d2);
							$ll1 = $x1;
							$ul1 = -1 * $x1;
							$ll1 = round(($mean + $deviation * $ll1) * 100000000) / 100000000;
							$ul1 = round(($mean + $deviation * $ul1) * 100000000) / 100000000;
							$z_url = 'z_score_';
							$rz = trim($d);
							if ($rz < -0.126 && $rz > -0.376) {
								$z_url = 'z_score_-0.25';
							} elseif ($rz < -0.375 && $rz > -0.626) {
								$z_url = 'z_score_-0.5';
							} elseif ($rz < -0.625 && $rz > -0.876) {
								$z_url = 'z_score_-0.75';
							} elseif ($rz < -0.875 && $rz > -1.126) {
								$z_url = 'z_score_-1';
							} elseif ($rz < -1.125 && $rz > -1.376) {
								$z_url = 'z_score_-1.25';
							} elseif ($rz < -1.375 && $rz > -1.626) {
								$z_url = 'z_score_-1.5';
							} elseif ($rz < -1.625 && $rz > -1.876) {
								$z_url = 'z_score_-1.75';
							} elseif ($rz < -1.875 && $rz > -2.126) {
								$z_url = 'z_score_-2';
							} elseif ($rz < -2.125 && $rz > -2.376) {
								$z_url = 'z_score_-2.25';
							} elseif ($rz < -2.375 && $rz > -2.626) {
								$z_url = 'z_score_-2.5';
							} elseif ($rz < -2.625 && $rz > -2.876) {
								$z_url = 'z_score_-2.75';
							} elseif ($rz < -2.875 && $rz > -3.126) {
								$z_url = 'z_score_-3';
							} elseif ($rz < -3.125 && $rz > -3.376) {
								$z_url = 'z_score_-3.25';
							} elseif ($rz < -3.375 && $rz > -3.626) {
								$z_url = 'z_score_-3.5';
							} elseif ($rz < -3.625 && $rz > -3.876) {
								$z_url = 'z_score_-3.75';
							} elseif ($rz < -3.875 && $rz > -4.126) {
								$z_url = 'z_score_-4';
							} elseif ($rz < -4.125) {
								$z_url = 'z_score_-4.25';
							} elseif ($rz > -0.126 && $rz < 0.125) {
								$z_url = 'z_score_0';
							} elseif ($rz > 0.124 && $rz < 0.375) {
								$z_url = 'z_score_0.25';
							} elseif ($rz > 0.374 && $rz < 0.625) {
								$z_url = 'z_score_0.5';
							} elseif ($rz > 0.624 && $rz < 0.875) {
								$z_url = 'z_score_0.75';
							} elseif ($rz > 0.874 && $rz < 1.125) {
								$z_url = 'z_score_1';
							} elseif ($rz > 1.124 && $rz < 1.375) {
								$z_url = 'z_score_1.25';
							} elseif ($rz > 1.374 && $rz < 1.625) {
								$z_url = 'z_score_1.5';
							} elseif ($rz > 1.624 && $rz < 1.875) {
								$z_url = 'z_score_1.75';
							} elseif ($rz > 1.874 && $rz < 2.125) {
								$z_url = 'z_score_2';
							} elseif ($rz > 2.124 && $rz < 2.375) {
								$z_url = 'z_score_2.25';
							} elseif ($rz > 2.374 && $rz < 2.625) {
								$z_url = 'z_score_2.5';
							} elseif ($rz > 2.624 && $rz < 2.875) {
								$z_url = 'z_score_2.75';
							} elseif ($rz > 2.874 && $rz < 3.125) {
								$z_url = 'z_score_3';
							} elseif ($rz > 3.124 && $rz < 3.375) {
								$z_url = 'z_score_3.25';
							} elseif ($rz > 3.374 && $rz < 3.625) {
								$z_url = 'z_score_3.5';
							} elseif ($rz > 3.624 && $rz < 3.875) {
								$z_url = 'z_score_3.75';
							} elseif ($rz > 3.874 && $rz < 4.125) {
								$z_url = 'z_score_4';
							} elseif ($rz > 4.124) {
								$z_url = 'z_score_4.25';
							}
							$this->param['z_urld'] = $z_url;
							$this->param['above2'] = $above;
							$this->param['blow2'] = $blow;
							$this->param['ll2'] = $ll;
							$this->param['ul2'] = $ul;
							$this->param['ll12'] = $ll1;
							$this->param['ul12'] = $ul1;
							$this->param['d'] = $d;
						} else {
							$this->param['error'] = "Probability must be between 0 and 1.";
							return $this->param;
						}
					} else {
						$this->param['error'] = "The standard deviation must be greater than zero.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
			if (is_numeric($e1) && is_numeric($e2)) {
				if ($e1 < $e2) {
					$ms_e1 = $e1 - $mean;
					$rz_e1 = ($e1 - $mean) / $deviation;
					$zaini_e1 = zain($rz_e1);
					$rz_e1 = trim($rz_e1);
					$this->param['z_url_e1'] = $zaini_e1[0];
					$this->param['ltpv_e1'] = abs($zaini_e1[1]);
					$this->param['rtpv_e1'] = abs($zaini_e1[2]);
					$this->param['ttpv_e1'] = abs($zaini_e1[3]);
					$this->param['ttcl_e1'] = abs($zaini_e1[4]);
					$this->param['ms_e1'] = $ms_e1;
					$this->param['rz_e1'] = round($rz_e1, 4);
					$ms_e2 = $e2 - $mean;
					$rz_e2 = ($e2 - $mean) / $deviation;
					$zaini_e2 = zain($rz_e2);
					$rz_e2 = trim($rz_e2);
					$this->param['z_url_e2'] = $zaini_e2[0];
					$this->param['ltpv_e2'] = abs($zaini_e2[1]);
					$this->param['rtpv_e2'] = abs($zaini_e2[2]);
					$this->param['ttpv_e2'] = abs($zaini_e2[3]);
					$this->param['ttcl_e2'] = abs($zaini_e2[4]);
					$this->param['ms_e2'] = $ms_e2;
					$this->param['rz_e2'] = round($rz_e2, 4);
					$this->param['e1'] = $e1;
					$this->param['e2'] = $e2;
					$ans_e1 = $e1 - $mean;
					$final_e1 = $ans_e1 / $deviation;
					$ans_e2 = $e2 - $mean;
					$final_e2 = $ans_e2 / $deviation;
					$main_ans = abs($zaini_e2[1]) - abs($zaini_e1[1]);
					$z_url = 'z_score_';
					$rz = trim($main_ans);
					if ($rz < -0.126 && $rz > -0.376) {
						$z_url = 'z_score_-0.25';
					} elseif ($rz < -0.375 && $rz > -0.626) {
						$z_url = 'z_score_-0.5';
					} elseif ($rz < -0.625 && $rz > -0.876) {
						$z_url = 'z_score_-0.75';
					} elseif ($rz < -0.875 && $rz > -1.126) {
						$z_url = 'z_score_-1';
					} elseif ($rz < -1.125 && $rz > -1.376) {
						$z_url = 'z_score_-1.25';
					} elseif ($rz < -1.375 && $rz > -1.626) {
						$z_url = 'z_score_-1.5';
					} elseif ($rz < -1.625 && $rz > -1.876) {
						$z_url = 'z_score_-1.75';
					} elseif ($rz < -1.875 && $rz > -2.126) {
						$z_url = 'z_score_-2';
					} elseif ($rz < -2.125 && $rz > -2.376) {
						$z_url = 'z_score_-2.25';
					} elseif ($rz < -2.375 && $rz > -2.626) {
						$z_url = 'z_score_-2.5';
					} elseif ($rz < -2.625 && $rz > -2.876) {
						$z_url = 'z_score_-2.75';
					} elseif ($rz < -2.875 && $rz > -3.126) {
						$z_url = 'z_score_-3';
					} elseif ($rz < -3.125 && $rz > -3.376) {
						$z_url = 'z_score_-3.25';
					} elseif ($rz < -3.375 && $rz > -3.626) {
						$z_url = 'z_score_-3.5';
					} elseif ($rz < -3.625 && $rz > -3.876) {
						$z_url = 'z_score_-3.75';
					} elseif ($rz < -3.875 && $rz > -4.126) {
						$z_url = 'z_score_-4';
					} elseif ($rz < -4.125) {
						$z_url = 'z_score_-4.25';
					} elseif ($rz > -0.126 && $rz < 0.125) {
						$z_url = 'z_score_0';
					} elseif ($rz > 0.124 && $rz < 0.375) {
						$z_url = 'z_score_0.25';
					} elseif ($rz > 0.374 && $rz < 0.625) {
						$z_url = 'z_score_0.5';
					} elseif ($rz > 0.624 && $rz < 0.875) {
						$z_url = 'z_score_0.75';
					} elseif ($rz > 0.874 && $rz < 1.125) {
						$z_url = 'z_score_1';
					} elseif ($rz > 1.124 && $rz < 1.375) {
						$z_url = 'z_score_1.25';
					} elseif ($rz > 1.374 && $rz < 1.625) {
						$z_url = 'z_score_1.5';
					} elseif ($rz > 1.624 && $rz < 1.875) {
						$z_url = 'z_score_1.75';
					} elseif ($rz > 1.874 && $rz < 2.125) {
						$z_url = 'z_score_2';
					} elseif ($rz > 2.124 && $rz < 2.375) {
						$z_url = 'z_score_2.25';
					} elseif ($rz > 2.374 && $rz < 2.625) {
						$z_url = 'z_score_2.5';
					} elseif ($rz > 2.624 && $rz < 2.875) {
						$z_url = 'z_score_2.75';
					} elseif ($rz > 2.874 && $rz < 3.125) {
						$z_url = 'z_score_3';
					} elseif ($rz > 3.124 && $rz < 3.375) {
						$z_url = 'z_score_3.25';
					} elseif ($rz > 3.374 && $rz < 3.625) {
						$z_url = 'z_score_3.5';
					} elseif ($rz > 3.624 && $rz < 3.875) {
						$z_url = 'z_score_3.75';
					} elseif ($rz > 3.874 && $rz < 4.125) {
						$z_url = 'z_score_4';
					} elseif ($rz > 4.124) {
						$z_url = 'z_score_4.25';
					}
					$this->param['z_urle'] = $z_url;
				} else {
					$this->param['error'] = "The left side of the interval has to be lesser than the right side.";
					return $this->param;
				}
			}
			if (is_numeric($f)) {
				if (is_numeric($mean) && is_numeric($deviation) && is_numeric($f)) {
					if ($deviation > 0) {
						if ($f > 0 && $f < 1) {
							$x1 = zinv($f);
							$x1 = (-1 * $mean) + $deviation * $x1;
							$ul = $mean + 3.1 * $deviation;
							$ll = -1 * $x1;
							$above = round(10000000 * $ll) / 10000000;
							$x1 = zinv($f);
							$x1 = $mean + $deviation * $x1;
							$ul = $x1;
							$blow = round(10000000 * $ul) / 10000000;
							$f2 = $f / 2;
							$x1 = zinv(0.5 - $f2);
							$ll = $x1;
							$ul = -1 * $x1;
							$ll = round(($mean + $deviation * $ll) * 100000000) / 100000000;
							$ul = round(($mean + $deviation * $ul) * 100000000) / 100000000;
							$f2 = $f / 2;
							$x1 = zinv($f2);
							$ll1 = $x1;
							$ul1 = -1 * $x1;
							$ll1 = round(($mean + $deviation * $ll1) * 100000000) / 100000000;
							$ul1 = round(($mean + $deviation * $ul1) * 100000000) / 100000000;
							$z_url = 'z_score_';
							$rz = trim($f);
							if ($rz < -0.126 && $rz > -0.376) {
								$z_url = 'z_score_-0.25';
							} elseif ($rz < -0.375 && $rz > -0.626) {
								$z_url = 'z_score_-0.5';
							} elseif ($rz < -0.625 && $rz > -0.876) {
								$z_url = 'z_score_-0.75';
							} elseif ($rz < -0.875 && $rz > -1.126) {
								$z_url = 'z_score_-1';
							} elseif ($rz < -1.125 && $rz > -1.376) {
								$z_url = 'z_score_-1.25';
							} elseif ($rz < -1.375 && $rz > -1.626) {
								$z_url = 'z_score_-1.5';
							} elseif ($rz < -1.625 && $rz > -1.876) {
								$z_url = 'z_score_-1.75';
							} elseif ($rz < -1.875 && $rz > -2.126) {
								$z_url = 'z_score_-2';
							} elseif ($rz < -2.125 && $rz > -2.376) {
								$z_url = 'z_score_-2.25';
							} elseif ($rz < -2.375 && $rz > -2.626) {
								$z_url = 'z_score_-2.5';
							} elseif ($rz < -2.625 && $rz > -2.876) {
								$z_url = 'z_score_-2.75';
							} elseif ($rz < -2.875 && $rz > -3.126) {
								$z_url = 'z_score_-3';
							} elseif ($rz < -3.125 && $rz > -3.376) {
								$z_url = 'z_score_-3.25';
							} elseif ($rz < -3.375 && $rz > -3.626) {
								$z_url = 'z_score_-3.5';
							} elseif ($rz < -3.625 && $rz > -3.876) {
								$z_url = 'z_score_-3.75';
							} elseif ($rz < -3.875 && $rz > -4.126) {
								$z_url = 'z_score_-4';
							} elseif ($rz < -4.125) {
								$z_url = 'z_score_-4.25';
							} elseif ($rz > -0.126 && $rz < 0.125) {
								$z_url = 'z_score_0';
							} elseif ($rz > 0.124 && $rz < 0.375) {
								$z_url = 'z_score_0.25';
							} elseif ($rz > 0.374 && $rz < 0.625) {
								$z_url = 'z_score_0.5';
							} elseif ($rz > 0.624 && $rz < 0.875) {
								$z_url = 'z_score_0.75';
							} elseif ($rz > 0.874 && $rz < 1.125) {
								$z_url = 'z_score_1';
							} elseif ($rz > 1.124 && $rz < 1.375) {
								$z_url = 'z_score_1.25';
							} elseif ($rz > 1.374 && $rz < 1.625) {
								$z_url = 'z_score_1.5';
							} elseif ($rz > 1.624 && $rz < 1.875) {
								$z_url = 'z_score_1.75';
							} elseif ($rz > 1.874 && $rz < 2.125) {
								$z_url = 'z_score_2';
							} elseif ($rz > 2.124 && $rz < 2.375) {
								$z_url = 'z_score_2.25';
							} elseif ($rz > 2.374 && $rz < 2.625) {
								$z_url = 'z_score_2.5';
							} elseif ($rz > 2.624 && $rz < 2.875) {
								$z_url = 'z_score_2.75';
							} elseif ($rz > 2.874 && $rz < 3.125) {
								$z_url = 'z_score_3';
							} elseif ($rz > 3.124 && $rz < 3.375) {
								$z_url = 'z_score_3.25';
							} elseif ($rz > 3.374 && $rz < 3.625) {
								$z_url = 'z_score_3.5';
							} elseif ($rz > 3.624 && $rz < 3.875) {
								$z_url = 'z_score_3.75';
							} elseif ($rz > 3.874 && $rz < 4.125) {
								$z_url = 'z_score_4';
							} elseif ($rz > 4.124) {
								$z_url = 'z_score_4.25';
							}
							$this->param['z_urlf'] = $z_url;
							$this->param['abovef'] = $above;
							$this->param['blowf'] = $blow;
							$this->param['llf'] = $ll;
							$this->param['ulf'] = $ul;
							$this->param['ll1f'] = $ll1;
							$this->param['ul1f'] = $ul1;
							$this->param['f'] = $f;
						} else {
							$this->param['error'] = "Probability must be between 0 and 1.";
							return $this->param;
						}
					} else {
						$this->param['error'] = "The standard deviation must be greater than zero.";
						return $this->param;
					}
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
		}
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	public function test($request)
	{
		//  dd($request->all());
		// check condition
		$test_radio = $request->test_radio;
		// section 1
		$row_data = $$request->row_data;
		$row_data1 = $$request->row_data1;
		// section 2
		// Group One Data
		$mean1 = $request->mean;
		$sem1 = $request->sem;
		$n1 = $request->n;
		// Group Two Data
		$mean2 = $request->mean1;
		$sem2 = $request->sem1;
		$n2 = $request->n1;
		// section 2
		$mean_sec = $request->mean_sec;
		$sd_sec = $request->sd_sec;
		$n_sec = $request->n_sec;
		$mean_sec1 = $request->mean_sec1;
		$sd_sec1 = $request->sd_sec1;
		$n_sec2 = $request->n_sec2;

		function standardDeviation($array)
		{
			$n = count($array);
			if ($n === 0) {
				return 0;
			}
			$mean = array_sum($array) / $n;
			$variance = 0.0;
			foreach ($array as $i) {
				$variance += pow($i - $mean, 2);
			}
			$variance /= $n;
			return sqrt($variance);
		}
		function convertToArray($string)
		{
			$values = preg_split('/\s+/', trim($string));
			return array_map('intval', $values);
		}

		if ($request->test_radio == "data") {
			if (!empty($request->row_data) && !empty($request->row_data1)) {

				// Given data
				// Clean up the string and convert it into an array
				$data_array = array_filter(array_map('trim', explode("\n", $request->row_data)));
				$data_array = array_map('intval', $data_array);

				$data_array1 = array_filter(array_map('trim', explode("\n", $request->row_data1)));
				$data_array1 = array_map('intval', $data_array1);

				$group1 = $data_array;
				$group2 = $data_array1;
				// Calculations for Group One
				$mean1 = array_sum($group1) / count($group1);
				$sd1 = sqrt(array_sum(array_map(function ($x) use ($mean1) {
					return pow($x - $mean1, 2);
				}, $group1)) / (count($group1) - 1));
				$sem1 = $sd1 / sqrt(count($group1));
				$n1 = count($group1);

				// Calculations for Group Two
				$mean2 = array_sum($group2) / count($group2);
				$sd2 = sqrt(array_sum(array_map(function ($x) use ($mean2) {
					return pow($x - $mean2, 2);
				}, $group2)) / (count($group2) - 1));
				$sem2 = $sd2 / sqrt(count($group2));
				$n2 = count($group2);

				// Degrees of Freedom (df)
				$df = $n1 + $n2 - 2;

				// Pooled Variance
				$variance1 = $sd1 * $sd1;
				$variance2 = $sd2 * $sd2;
				$pooledVariance = ((($n1 - 1) * $variance1) + (($n2 - 1) * $variance2)) / $df;

				// Standard Error of the Difference
				$standardError = sqrt($pooledVariance * (1 / $n1 + 1 / $n2));
				// t-Value
				$tValue = ($mean1 - $mean2) / $standardError;
				$tValue = abs($tValue);

				// Function to calculate the p-value
				function t_dist($t, $df)
				{
					$x = $df / ($t * $t + $df);
					$a = 0.5 * beta_inc($x, 0.5 * $df, 0.5);
					return 2 * $a;
				}

				// Beta incomplete function approximation
				function beta_inc($x, $a, $b)
				{
					$bt = ($x == 0 || $x == 1) ? 0 : exp(log_gamma($a + $b) - log_gamma($a) - log_gamma($b) + $a * log($x) + $b * log(1 - $x));
					if ($x < 0.5) {
						return $bt * beta_cf($x, $a, $b) / $a;
					} else {
						return 1 - $bt * beta_cf(1 - $x, $b, $a) / $b;
					}
				}

				// Beta continued fraction approximation
				function beta_cf($x, $a, $b)
				{
					$MAXIT = 100;
					$EPS = 3.0e-7;
					$FPMIN = 1.0e-30;
					$m2;
					$aa;
					$c;
					$d;
					$del;
					$h;
					$qab = $a + $b;
					$qap = $a + 1;
					$qam = $a - 1;
					$c = 1;
					$d = 1 - $qab * $x / $qap;
					if (abs($d) < $FPMIN) $d = $FPMIN;
					$d = 1 / $d;
					$h = $d;
					for ($m = 1; $m <= $MAXIT; $m++) {
						$m2 = 2 * $m;
						$aa = $m * ($b - $m) * $x / (($qam + $m2) * ($a + $m2));
						$d = 1 + $aa * $d;
						if (abs($d) < $FPMIN) $d = $FPMIN;
						$c = 1 + $aa / $c;
						if (abs($c) < $FPMIN) $c = $FPMIN;
						$d = 1 / $d;
						$h *= $d * $c;
						$aa = - ($a + $m) * ($qab + $m) * $x / (($a + $m2) * ($qap + $m2));
						$d = 1 + $aa * $d;
						if (abs($d) < $FPMIN) $d = $FPMIN;
						$c = 1 + $aa / $c;
						if (abs($c) < $FPMIN) $c = $FPMIN;
						$d = 1 / $d;
						$del = $d * $c;
						$h *= $del;
						if (abs($del - 1) < $EPS) break;
					}
					return $h;
				}

				// Log gamma function approximation
				function log_gamma($x)
				{
					$cof = [
						76.18009172947146,
						-86.50532032941677,
						24.01409824083091,
						-1.231739572450155,
						0.001208650973866179,
						-0.000005395239384953
					];
					$y = $x;
					$tmp = $x + 5.5;
					$tmp -= ($x + 0.5) * log($tmp);
					$ser = 1.000000000190015;
					for ($j = 0; $j < 6; $j++) {
						$ser += $cof[$j] / ++$y;
					}
					return -$tmp + log(2.5066282746310005 * $ser / $x);
				}

				$pValue = t_dist($tValue, $df);

				// Store the results
				$this->param['mean1'] = $mean1;
				$this->param['mean2'] = $mean2;
				$this->param['sd1'] = $sd1;
				$this->param['sd2'] = $sd2;
				$this->param['sem1'] = $sem1;
				$this->param['sem2'] = $sem2;
				$this->param['n1'] = $n1;
				$this->param['n2'] = $n2;
				$this->param['df'] = $df;
				$this->param['tValue'] = $tValue;
				$this->param['standardError'] = $standardError;
				$this->param['variance1'] = $variance1;
				$this->param['variance2'] = $variance2;
				$this->param['pooledVariance'] = $pooledVariance;
				$this->param['pValue'] = $pValue;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($request->test_radio == "sem") {
			if (is_numeric($mean1) && is_numeric($sem1) && is_numeric($n1) && is_numeric($mean2) && is_numeric($sem2) && is_numeric($n2)) {
				// Calculate Variances from SEM
				$variance1 = ($sem1 ** 2) * $n1;
				$variance2 = ($sem2 ** 2) * $n2;
				// Calculate Standard Deviations from Variances
				$sd1 = sqrt($variance1);
				$sd2 = sqrt($variance2);
				// Calculate SEM from SD
				$sem1_calculated = $sd1 / sqrt($n1);
				$sem2_calculated = $sd2 / sqrt($n2);
				// Pooled Variance
				$pooledVariance = (($n1 - 1) * $variance1 + ($n2 - 1) * $variance2) / ($n1 + $n2 - 2);
				// Standard Error of the Difference
				$standardError = sqrt($pooledVariance * (1 / $n1 + 1 / $n2));
				// T-Value
				$tValue = ($mean1 - $mean2) / $standardError;
				// Make tValue positive
				$tValue = abs($tValue);
				// Calculate Degrees of Freedom
				$numerator = ($variance1 / $n1 + $variance2 / $n2) ** 2;
				$denominator = (($variance1 / $n1) ** 2 / ($n1 - 1)) + (($variance2 / $n2) ** 2 / ($n2 - 1));
				// $df = $denominator != 0 ? $numerator / $denominator : 0;
				$df = $n1 + $n2 - 2;

				// Function to calculate the p-value
				function t_dist($t, $df)
				{
					$x = $df / ($t * $t + $df);
					$a = 0.5 * beta_inc($x, 0.5 * $df, 0.5);
					return 2 * $a;
				}
				// Beta incomplete function approximation
				function beta_inc($x, $a, $b)
				{
					$bt = ($x == 0 || $x == 1) ? 0 : exp(log_gamma($a + $b) - log_gamma($a) - log_gamma($b) + $a * log($x) + $b * log(1 - $x));
					if ($x < 0.5) {
						return $bt * beta_cf($x, $a, $b) / $a;
					} else {
						return 1 - $bt * beta_cf(1 - $x, $b, $a) / $b;
					}
				}
				// Beta continued fraction approximation
				function beta_cf($x, $a, $b)
				{
					$MAXIT = 100;
					$EPS = 3.0e-7;
					$FPMIN = 1.0e-30;
					$m2;
					$aa;
					$c;
					$d;
					$del;
					$h;
					$qab = $a + $b;
					$qap = $a + 1;
					$qam = $a - 1;
					$c = 1;
					$d = 1 - $qab * $x / $qap;
					if (abs($d) < $FPMIN) $d = $FPMIN;
					$d = 1 / $d;
					$h = $d;
					for ($m = 1; $m <= $MAXIT; $m++) {
						$m2 = 2 * $m;
						$aa = $m * ($b - $m) * $x / (($qam + $m2) * ($a + $m2));
						$d = 1 + $aa * $d;
						if (abs($d) < $FPMIN) $d = $FPMIN;
						$c = 1 + $aa / $c;
						if (abs($c) < $FPMIN) $c = $FPMIN;
						$d = 1 / $d;
						$h *= $d * $c;
						$aa = - ($a + $m) * ($qab + $m) * $x / (($a + $m2) * ($qap + $m2));
						$d = 1 + $aa * $d;
						if (abs($d) < $FPMIN) $d = $FPMIN;
						$c = 1 + $aa / $c;
						if (abs($c) < $FPMIN) $c = $FPMIN;
						$d = 1 / $d;
						$del = $d * $c;
						$h *= $del;
						if (abs($del - 1) < $EPS) break;
					}
					return $h;
				}
				// Log gamma function approximation
				function log_gamma($x)
				{
					$cof = [
						76.18009172947146,
						-86.50532032941677,
						24.01409824083091,
						-1.231739572450155,
						0.001208650973866179,
						-0.000005395239384953
					];
					$y = $x;
					$tmp = $x + 5.5;
					$tmp -= ($x + 0.5) * log($tmp);
					$ser = 1.000000000190015;
					for ($j = 0; $j < 6; $j++) {
						$ser += $cof[$j] / ++$y;
					}
					return -$tmp + log(2.5066282746310005 * $ser / $x);
				}
				$pValue = t_dist($tValue, $df);

				// Round to two decimal places
				$mean1 = number_format($mean1, 2);
				$mean2 = number_format($mean2, 2);
				$variance1 = number_format($variance1, 2);
				$variance2 = number_format($variance2, 2);
				$sd1 = number_format($sd1, 2);
				$sd2 = number_format($sd2, 2);
				$sem1_calculated = number_format($sem1_calculated, 2);
				$sem2_calculated = number_format($sem2_calculated, 2);
				$pooledVariance = number_format($pooledVariance, 2);
				$standardError = number_format($standardError, 2);
				$tValue = number_format($tValue, 2);
				$df = number_format($df, 2);
				$n1 = number_format($n1, 2);
				$n2 = number_format($n2, 2);

				$this->param['mean1'] = $mean1;
				$this->param['mean2'] = $mean2;
				$this->param['sd1'] = $sd1;
				$this->param['sd2'] = $sd2;
				$this->param['sem1'] = $sem1_calculated;
				$this->param['sem2'] = $sem2_calculated;
				$this->param['n1'] = $n1;
				$this->param['n2'] = $n2;
				$this->param['df'] = $df;
				$this->param['tValue'] = $tValue;
				$this->param['standardError'] = $standardError;
				$this->param['variance1'] = $variance1;
				$this->param['variance2'] = $variance2;
				$this->param['pooledVariance'] = $pooledVariance;
				$this->param['pValue'] = $pValue;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else if ($request->test_radio == "sd") {

			if (is_numeric($mean_sec) && is_numeric($sd_sec) && is_numeric($n_sec) && is_numeric($mean_sec1) && is_numeric($sd_sec1) && is_numeric($n_sec2)) {

				// Calculations
				$variance1 = $sd_sec * $sd_sec;
				$variance2 = $sd_sec1 * $sd_sec1;
				$sem1_calculated = $sd_sec / sqrt($n_sec);
				$sem2_calculated = $sd_sec1 / sqrt($n_sec2);
				$df = $n_sec + $n_sec2 - 2;
				$pooledVariance = (((($n_sec - 1) * $variance1) + (($n_sec2 - 1) * $variance2)) / $df);
				$standardError = sqrt($pooledVariance * (1 / $n_sec + 1 / $n_sec2));
				$tValue = ($mean_sec - $mean_sec1) / $standardError;
				$tValue = abs($tValue);

				// Function to calculate the p-value
				function t_dist($t, $df)
				{
					$x = $df / ($t * $t + $df);
					$a = 0.5 * beta_inc($x, 0.5 * $df, 0.5);
					return 2 * $a;
				}
				// Beta incomplete function approximation
				function beta_inc($x, $a, $b)
				{
					$bt = ($x == 0 || $x == 1) ? 0 : exp(log_gamma($a + $b) - log_gamma($a) - log_gamma($b) + $a * log($x) + $b * log(1 - $x));
					if ($x < 0.5) {
						return $bt * beta_cf($x, $a, $b) / $a;
					} else {
						return 1 - $bt * beta_cf(1 - $x, $b, $a) / $b;
					}
				}
				// Beta continued fraction approximation
				function beta_cf($x, $a, $b)
				{
					$MAXIT = 100;
					$EPS = 3.0e-7;
					$FPMIN = 1.0e-30;
					$m2;
					$aa;
					$c;
					$d;
					$del;
					$h;
					$qab = $a + $b;
					$qap = $a + 1;
					$qam = $a - 1;
					$c = 1;
					$d = 1 - $qab * $x / $qap;
					if (abs($d) < $FPMIN) $d = $FPMIN;
					$d = 1 / $d;
					$h = $d;
					for ($m = 1; $m <= $MAXIT; $m++) {
						$m2 = 2 * $m;
						$aa = $m * ($b - $m) * $x / (($qam + $m2) * ($a + $m2));
						$d = 1 + $aa * $d;
						if (abs($d) < $FPMIN) $d = $FPMIN;
						$c = 1 + $aa / $c;
						if (abs($c) < $FPMIN) $c = $FPMIN;
						$d = 1 / $d;
						$h *= $d * $c;
						$aa = - ($a + $m) * ($qab + $m) * $x / (($a + $m2) * ($qap + $m2));
						$d = 1 + $aa * $d;
						if (abs($d) < $FPMIN) $d = $FPMIN;
						$c = 1 + $aa / $c;
						if (abs($c) < $FPMIN) $c = $FPMIN;
						$d = 1 / $d;
						$del = $d * $c;
						$h *= $del;
						if (abs($del - 1) < $EPS) break;
					}
					return $h;
				}
				// Log gamma function approximation
				function log_gamma($x)
				{
					$cof = [
						76.18009172947146,
						-86.50532032941677,
						24.01409824083091,
						-1.231739572450155,
						0.001208650973866179,
						-0.000005395239384953
					];
					$y = $x;
					$tmp = $x + 5.5;
					$tmp -= ($x + 0.5) * log($tmp);
					$ser = 1.000000000190015;
					for ($j = 0; $j < 6; $j++) {
						$ser += $cof[$j] / ++$y;
					}
					return -$tmp + log(2.5066282746310005 * $ser / $x);
				}
				$pValue = t_dist($tValue, $df);

				// Store the results
				$this->param['mean1'] = $mean_sec;
				$this->param['mean2'] = $mean_sec1;
				$this->param['sd1'] = $sd_sec;
				$this->param['sd2'] = $sd_sec1;
				$this->param['sem1'] = $sem1_calculated;
				$this->param['sem2'] = $sem2_calculated;
				$this->param['n1'] = $n_sec;
				$this->param['n2'] = $n_sec2;
				$this->param['df'] = $df;
				$this->param['tValue'] = $tValue;
				$this->param['standardError'] = $standardError;
				$this->param['variance1'] = $variance1;
				$this->param['variance2'] = $variance2;
				$this->param['pooledVariance'] = $pooledVariance;
				$this->param['pValue'] = $pValue;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		}

		$this->param['test_radio'] = $test_radio;

		return $this->param;
	}
		// Sample Size Calculator
	public function sample_size($request)
	{
		$population = trim($request->population);
		$given_unit = trim($request->given_unit);
		$confidence_unit = trim($request->confidence_unit);
		$margin = trim($request->margin);
		$standard = trim($request->standard);
		$proportion = trim($request->proportion);
		$n_finite = trim($request->n_finite);
		if ($confidence_unit == "70%") {
			$confidence_unit = 1.04;
		} elseif ($confidence_unit == "75%") {
			$confidence_unit = 1.15;
		} elseif ($confidence_unit == "80%") {
			$confidence_unit = 1.28;
		} elseif ($confidence_unit == "85%") {
			$confidence_unit = 1.44;
		} elseif ($confidence_unit == "90%") {
			$confidence_unit = 1.65;
		} elseif ($confidence_unit == "95%") {
			$confidence_unit = 1.96;
		} elseif ($confidence_unit == "98%") {
			$confidence_unit = 2.33;
		} elseif ($confidence_unit == "99%") {
			$confidence_unit = 2.58;
		} elseif ($confidence_unit == "99.9%") {
			$confidence_unit = 3.29;
		} else {
			$confidence_unit = 4.42;
		}
		if ($margin === "0") {

			$this->param['error'] = "Accepted value cannot be equal to zero.";
			return $this->param;
		}
		if ($proportion === "0") {

			$this->param['error'] = "Accepted value cannot be equal to zero.";
			return $this->param;
		}
		if ($population == "sample") {
			if ($given_unit == "standard") {
				if (is_numeric($margin) && is_numeric($standard)) {
					$margin = $margin / 100;
					$multiply = $confidence_unit * $standard;
					$divide = $multiply / $margin;
					$sub_answer = $divide * $divide;
					$answer = round($sub_answer);

					$this->param['margin'] = $margin;
					$this->param['standard'] = $standard;
					$this->param['confidence_unit'] = $confidence_unit;
					$this->param['multiply'] = $multiply;
					$this->param['divide'] = $divide;
					$this->param['sub_answer'] = $sub_answer;
					$this->param['answer'] = $answer;
				} else {

					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				if (is_numeric($margin) && is_numeric($proportion)) {
					$margin = $margin / 100;
					$proportion = $proportion / 100;
					$con_unit = $confidence_unit * $confidence_unit;
					$minus = (1 - $proportion);
					$marg = $margin * $margin;
					$propro_sub = $con_unit * $proportion;
					$propro = $propro_sub * $minus;
					$propro_answer = $propro / $marg;
					$answer = round($propro_answer);
					$this->param['answer'] = $answer;
					$this->param['confidence_unit'] = $confidence_unit;
					$this->param['proportion'] = $proportion;
					$this->param['margin'] = $margin;
					$this->param['minus'] = $minus;
					$this->param['marg'] = $marg;
					$this->param['con_unit'] = $con_unit;
					$this->param['propro'] = $propro;
					$this->param['propro_answer'] = $propro_answer;
				} else {

					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
		} else {
			if ($given_unit == "standard") {
				if (is_numeric($margin) && is_numeric($standard) && is_numeric($n_finite)) {
					$margin = $margin / 100;
					$multiply = $confidence_unit * $standard;
					$divide = $multiply / $margin;
					$sub_answer = $divide * $divide;
					$n_answer = round($sub_answer);
					$a_answer = ($n_answer * $n_finite);
					$b_answer = ($n_answer + $n_finite - 1);
					$answer_s = $a_answer / $b_answer;
					$answer = round($answer_s);
					$this->param['n_finite'] = $n_finite;
					$this->param['margin'] = $margin;
					$this->param['standard'] = $standard;
					$this->param['confidence_unit'] = $confidence_unit;
					$this->param['multiply'] = $multiply;
					$this->param['divide'] = $divide;
					$this->param['sub_answer'] = $sub_answer;
					$this->param['a_answer'] = $a_answer;
					$this->param['b_answer'] = $b_answer;
					$this->param['answer'] = $answer;
				} else {

					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				if (is_numeric($margin) && is_numeric($proportion) && is_numeric($n_finite)) {
					$margin = $margin / 100;
					$proportion = $proportion / 100;
					$con_unit = $confidence_unit * $confidence_unit;
					$minus = (1 - $proportion);
					$marg = $margin * $margin;
					$propro_sub = $con_unit * $proportion;
					$propro = $propro_sub * $minus;
					$propro_answer = $propro / $marg;
					$sub_answer = round($propro_answer);
					$a_answer = ($sub_answer * $n_finite);
					$b_answer = ($sub_answer + $n_finite - 1);
					$answer_s = $a_answer / $b_answer;
					$answer = round($answer_s);
					$this->param['n_finite'] = $n_finite;
					$this->param['confidence_unit'] = $confidence_unit;
					$this->param['proportion'] = $proportion;
					$this->param['margin'] = $margin;
					$this->param['minus'] = $minus;
					$this->param['marg'] = $marg;
					$this->param['con_unit'] = $con_unit;
					$this->param['propro'] = $propro;
					$this->param['propro_answer'] = $propro_answer;
					$this->param['sub_answer'] = $sub_answer;
					$this->param['a_answer'] = $a_answer;
					$this->param['b_answer'] = $b_answer;
					$this->param['answer'] = $answer;
				} else {

					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function pert($request)
	{
		$optimistic = trim($request->optimistic);
		$optimistic_one = trim($request->optimistic_one);
		$optimistic_sec = trim($request->optimistic_sec);
		$optimistic_unit = trim($request->optimistic_unit);
		$pessimistic = trim($request->pessimistic);
		$pessimistic_one = trim($request->pessimistic_one);
		$pessimistic_sec = trim($request->pessimistic_sec);
		$pessimistic_unit = trim($request->pessimistic_unit);
		$most = trim($request->most);
		$most_one = trim($request->most_one);
		$most_sec = trim($request->most_sec);
		$most_unit = trim($request->most_unit);
		$desired = trim($request->desired);
		$desired_one = trim($request->desired_one);
		$desired_sec = trim($request->desired_sec);
		$desired_unit = trim($request->desired_unit);
		$output_unit = trim($request->output_unit);
		$deviation_unit = trim($request->deviation_unit);
		function time_unit($optimistic, $optimistic_unit)
		{
			if ($optimistic_unit == "hrs") {
				$optimistic = $optimistic * 24;
			} elseif ($optimistic_unit == "days") {
				$optimistic = $optimistic * 1;
			} elseif ($optimistic_unit == "wks") {
				$optimistic = $optimistic / 7;
			} elseif ($optimistic_unit == "mos") {
				$optimistic = $optimistic / 30.417;
			} elseif ($optimistic_unit == "yrs") {
				$optimistic = $optimistic / 365;
			}
			return $optimistic;
		}
		function other_time($optimistic_one, $optimistic_sec, $optimistic_unit)
		{
			if ($optimistic_unit === "yrs/mos") {
				$optimistic = ($optimistic_one * 365) + ($optimistic_sec * 30.417);
			} elseif ($optimistic_unit === "wks/days") {
				$optimistic = ($optimistic_one * 7) + $optimistic_sec;
			} elseif ($optimistic_unit === "days/hrs") {
				$optimistic = $optimistic_one + ($optimistic_sec / 24);
			}
			return $optimistic;
		}
		function secore($x)
		{
			$pi = 3.1415927;
			$a = (8 * ($pi - 3)) / (3 * $pi * (4 - $pi));
			$x2 = $x * $x;
			$ax2 = $a * $x2;
			$num = (4 / $pi) + $ax2;
			$denom = 1 + $ax2;
			$inner = (-$x2) * $num / $denom;
			$secore2 = 1 - exp($inner);
			return sqrt($secore2);
		}
		function cdf($n)
		{
			if ($n < 0) {
				return (1 - secore($n / sqrt(2))) / 2;
			} else {
				return (1 + secore($n / sqrt(2))) / 2;
			}
		}
		if (is_numeric($optimistic) && is_numeric($pessimistic) && is_numeric($most) && is_numeric($desired)) {

			if ($optimistic_unit === "yrs/mos" || $optimistic_unit === "wks/days" || $optimistic_unit === "days/hrs") {
				if (is_numeric($optimistic_one) && is_numeric($optimistic_sec)) {
					$optimistic = other_time($optimistic_one, $optimistic_sec, $optimistic_unit);
					$this->param['optimistic'] = $optimistic;
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				$optimistic = time_unit($optimistic, $optimistic_unit);
			}

			if ($pessimistic_unit === "yrs/mos" || $pessimistic_unit === "wks/days" || $pessimistic_unit === "days/hrs") {
				if (is_numeric($pessimistic_one) && is_numeric($pessimistic_sec)) {
					$pessimistic = other_time($pessimistic_one, $pessimistic_sec, $pessimistic_unit);
					$this->param['pessimistic'] = $pessimistic;
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				$pessimistic = time_unit($pessimistic, $pessimistic_unit);
			}

			if ($most_unit === "yrs/mos" || $most_unit === "wks/days" || $most_unit === "days/hrs") {
				if (is_numeric($most_one) && is_numeric($most_sec)) {
					$most = other_time($most_one, $most_sec, $most_unit);
					$this->param['most'] = $most;
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				$most = time_unit($most, $most_unit);
			}

			if ($desired_unit === "yrs/mos" || $desired_unit === "wks/days" || $desired_unit === "days/hrs") {
				if (is_numeric($desired_one) && is_numeric($desired_sec)) {
					$desired = other_time($desired_one, $desired_sec, $desired_unit);
					$this->param['desired'] = $desired;
				} else {
					$this->param['error'] = "Please! Check Your Input";
					return $this->param;
				}
			} else {
				$desired = time_unit($desired, $desired_unit);
			}

			$multi = 4 * $most;
			$add = $optimistic + $multi + $pessimistic;
			$sub = $add / 6;
			$main_answer = time_unit($sub, $output_unit);

			$standard = $pessimistic - $optimistic;
			if ($standard == 0) {
				$this->param['error'] = "Optimistic or Pessimistic value note same";
				return $this->param;
			} else {
				$sta_answer = $standard / 6;
				$sub_answer = time_unit($sta_answer, $deviation_unit);
				$score = $desired - $main_answer;
				$main_score = $score / $sub_answer;
				$ans = cdf($main_score) * 100;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['add'] = $add;
		$this->param['main_answer'] = $main_answer;
		$this->param['sub_answer'] = $sub_answer;
		$this->param['ans'] = $ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function pie($request)
	{
		$choices = $request->choices;
		$i = 0;
		if (is_numeric($choices[$i])) {
			// ==============Sum==========
			$sum = 0;
			foreach ($choices as $key => $value) {
				$sum = $value + $sum;
			}
			// ==========percentage===============
			$percentage = array();
			foreach ($choices as $value) {
				$per = round(($value / $sum) * 100, 2);
				array_push($percentage, $per);
			}
			// ==========angle===============
			$degree = array();
			foreach ($percentage as $key => $value) {
				$deg = round(($value / 100) * 360);
				array_push($degree, $deg);
			}
			$values = [];
			foreach ($choices as $value) {
				array_push($values, $value);
			}
			// =========letters=============
			$length = count($values) - 1;
			$letters = [];
			for ($i = 65; $i <= 65 + $length; $i++) {
				$letters[] = chr($i);
			}
			// Initialize an empty array to store the converted data
			$dataPoints = [];
			// Assuming both arrays have the same length
			for ($i = 0; $i < count($letters); $i++) {
				$dataPoints[] = [
					'y' => $values[$i],
					'label' => $letters[$i]
				];
			}
			$dataPoints = json_encode($dataPoints);
			$this->param['letters'] =  $letters;
			$this->param['values'] =  $values;
			$this->param['percentage'] =  $percentage;
			$this->param['degree'] =  $degree;
			$this->param['new_combine'] =  $dataPoints;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function anova($request)
	{
		//  dd($request->all());
		$submit = $request->type;
		if ($submit === 'one_way') {
			$k = $request->k;
			$check = true;
			for ($x = 1; $x <= $k; $x++) {
				$group = $_POST["group$x"];
				$groups = array_map("trim", explode(",", $group));
				foreach ($groups as $value) {
					if (!is_numeric($value)) {
						$check = false;
					}
				}
			}
			if ($check === true) {
				$alph = '';
				$alph2 = '';
				$alph_sum = '';
				$alph_sum2 = '';
				for ($i = 1; $i <= $k; $i++) {
					$alph .= "<th class='p-2 border text-center text-blue'>Group $i</th>";
					$alph2 .= "<th class='p-2 border text-center text-blue'>(Group " . $i . ")²</th>";
				}
				$table = "<table class='w-full' style='border-collapse: collapse'><thead><tr class='bg-sky'>$alph</tr></thead><tbody>";
				$table1 = "<table class='w-full' style='border-collapse: collapse'><thead><tr class='bg-sky'>" . $alph2 . "</tr></thead><tbody>";
				$table2 = "<table class='w-full' style='border-collapse: collapse'><thead><tr class='bg-sky'><th colspan='7' class='bb_1 p-2 border text-center text-blue'>Data Summary</th></tr></thead><thead><tr class='bg-gray'><th class='p-2 border text-center text-blue'>Groups</th><th class='p-2 border text-center text-blue'>N</th><th class='p-2 border text-center text-blue'>∑x</th><th class='p-2 border text-center text-blue'>Mean</th><th class='p-2 border text-center text-blue'>∑x²</th><th class='p-2 border text-center text-blue'>Std. Dev.</th><th class='p-2 border text-center text-blue'>Std. Error</th></tr></thead><tbody>";
				$v = 0;
				$std_dev = 0;
				$n_sum = 0;
				$mean_sum = 0;
				$total_sum = 0;
				$total_sum2 = 0;
				$trs[0] = '';
				$trs1[0] = '';
				for ($i = 1; $i <= $k; $i++) {
					$group = $_POST["group$i"];
					$groups = array_map("trim", explode(",", $group));
					$n = count($groups);
					$sum = array_sum($groups);
					$sum2 = 0;
					$mean = $sum / $n;
					foreach ($groups as $key => $value) {
						$v += pow($value - $mean, 2);
						$sum2 += pow($value, 2);
						if (isset($trs[$key])) {
							$td = $trs[$key];
						} else {
							$td = '';
						}
						$td .= "<td class='p-2 border text-center'>" . $value . "</td>";
						$trs[$key] = $td;
						if (isset($trs1[$key])) {
							$td1 = $trs1[$key];
						} else {
							$td1 = '';
						}
						$td1 .= "<td class='p-2 border text-center text-blue'>" . pow($value, 2) . "</td>";
						$trs1[$key] = $td1;
					}
					$std_dev = sqrt($v / ($n - 1));
					$std_error = $std_dev / sqrt($n);
					$table2 .= "<tr class='bg-white'><td class='p-2 border text-center'>Group $i</td><td class='p-2 border text-center'>$n</td><td class='p-2 border text-center'>$sum</td><td class='p-2 border text-center'>$mean</td><td class='p-2 border text-center'>$sum2</td><td class='p-2 border text-center'>" . round($std_dev, 4) . "</td><td class='p-2 border text-center'>" . round($std_error, 4) . "</td></tr>";
					$v = 0;
					$n_sum += $n;
					$mean_sum += $mean;
					$total_sum += $sum;
					$total_sum2 += $sum2;
					$alph_sum .= "<th class='p-2 border text-center text-blue'>∑Group $i = $sum</th>";
					$alph_sum2 .= "<th class='p-2 border text-center text-blue'>∑(Group" . $i . ")² = $sum2</th>";
				}
				for ($i = 0; $i < $n; $i++) {
					$table .= "<tr class='bg-white'>" . $trs[$i] . "</tr>";
					$table1 .= "<tr class='bg-white'>" . $trs1[$i] . "</tr>";
				}
				$mean_sum = $mean_sum / $k;
				$table .= "<tr class='bg-sky'>" . $alph_sum . "</tr></tbody></table>";
				$table1 .= "<tr class='bg-sky'>$alph_sum2</tr></tbody></table>";
				$table2 .= "<tr class='bg-sky'><th class='p-2 border text-center text-blue'>Total</th><th class='p-2 border text-center text-blue'>$n_sum</th><th class='p-2 border text-center text-blue'>$total_sum</th><th class='p-2 border text-center text-blue'>$mean_sum</th><th class='p-2 border text-center text-blue'>$total_sum2</th><th class='p-2 border text-center text-blue'>&nbsp;</th><th class='p-2 border text-center text-blue'>&nbsp;</th></tr></tbody></table>";

				$s1 = '';
				$s2 = '';
				$ssb = 0;
				$ssw = 0;
				for ($i = 1; $i <= $k; $i++) {
					$group = $_POST["group$i"];
					$groups = array_map("trim", explode(",", $group));
					$n = count($groups);
					$sum = array_sum($groups);
					$mean = $sum / $n;
					foreach ($groups as $key => $value) {
						$v += pow($value - $mean, 2);
					}
					$std_dev = sqrt($v / ($n - 1));
					if ($i < $k) {
						$s1 .= "$n * ($mean - $mean_sum)^2 + ";
						$s2 .= "($n - 1) * (" . round($std_dev, 4) . ")^2 + ";
					} else {
						$s1 .= "$n * ($mean - $mean_sum)^2";
						$s2 .= "$n * ($mean - $mean_sum)^2";
					}
					$ssb += $n * pow(($mean - $mean_sum), 2);
				}
				$ssw += ($n - 1) * pow($std_dev, 2);

				$this->param["k"] = $k;
				$this->param["N"] = $n_sum;
				$this->param["table"] = $table;
				$this->param["table1"] = $table1;
				$this->param["table2"] = $table2;
				$this->param["s1"] = $s1;
				$this->param["s2"] = $s2;
				$this->param["ssb"] = round($ssb, 4);
				$this->param["ssw"] = round($ssw, 4);
				$this->param["RESULT"] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} elseif ($submit === 'two_way') {
			$rows = $_POST['rows'];
			$columns = $_POST['columns'];

			$check = true;
			for ($i = 0; $i < $rows; $i++) {
				for ($j = 0; $j < $columns; $j++) {
					$input = $_POST['td_' . $i . '_' . $j];
					$inputs = array_map("trim", explode(",", $input));
					foreach ($inputs as $key => $values) {
						if (!is_numeric($values)) {
							$check = false;
						}
					}
				}
			}
			if ($check === true) {
				$head = '';
				$head2 = '';
				$head2 = '';
				$p3_s1 = '';
				$p3_s2 = '';
				$p3_s3 = '';
				$C = 0;
				$p4_s1 = '';
				$p4_s2 = '';
				$p4_s3 = '';
				$D = 0;
				$n = 0;
				$summ = 0;
				$sumxa = array();
				$table = "<table class='w-full' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='p-2 border text-center text-blue'>Observation</th>";
				$table1 = "<table class='w-full' style='border-collapse: collapse'><thead><tr class='bg-gray'><th class='p-2 border text-center text-blue'>Observation</th>";
				for ($i = 0; $i < $columns; $i++) {
					$table .= "<th class='p-2 border text-center text-blue'>Group " . ($i + 1) . "</th>";
					$table1 .= "<th class='p-2 border text-center text-blue'>Group " . ($i + 1) . "</th>";
				}
				$table .= "</tr></thead><tbody>";
				$table1 .= "<th class='p-2 border text-center text-blue'>Row Total</th></tr></thead><tbody>";
				$p5_s1 = '';
				$p5_s2 = '';
				$E = 0;
				for ($i = 0; $i < $rows; $i++) {
					$table .= "<tr class='bg-white'><td class='p-2 border text-center'>" . ($i + 1) . "</td>";
					$table1 .= "<tr class='bg-white'><td class='p-2 border text-center'>" . ($i + 1) . "</td>";
					$sum1 = 0;
					$nr = 0;
					$nc = 0;
					for ($j = 0; $j <= $columns; $j++) {
						if ($j != $columns) {
							$input = $_POST['td_' . $i . '_' . $j];
							$table .= "<td class='p-2 border text-center'>$input</td>";
							$inputs = array_map("trim", explode(",", $input));
							$sum = array_sum($inputs);
							$table1 .= "<td class='p-2 border text-center'>" . $sum  . "</td>";
							$sum1 += $sum;
							if (isset($sumxa[$j])) {
								$sumx = $sumxa[$j];
							} else {
								$sumx = 0;
							}
							$sumxa[$j] = $sumx + $sum;
							$nr += count($inputs);
							$nc = count($inputs);
							$n += count($inputs);
							$summ += $sum;
							if ($i === $rows - 1 && $j === $columns - 1) {
								$p4_s1 .= '\dfrac {(' . $sum . ')^2}{' . $nc . '}';
								$p4_s2 .= '\dfrac {' . pow($sum, 2) . '}{' . $nc . '}';
								$p4_s3 .= round(((pow($sum, 2)) / $nc), 4);
							} else {
								$p4_s1 .= '\dfrac {(' . $sum . ')^2}{' . $nc . '} + ';
								$p4_s2 .= '\dfrac {' . pow($sum, 2) . '}{' . $nc . '} + ';
								$p4_s3 .= round(((pow($sum, 2)) / $nc), 4) . ' + ';
							}
							$D += (pow($sum, 2)) / $nc;
						} else {
							if (isset($sumxa[$j])) {
								$sumx = $sumxa[$j];
							} else {
								$sumx = 0;
							}
							$sumxa[$j] = $sumx + $sum1;
							$table1 .= "<td class='p-2 border text-center'><b>$sum1</b></td>";
						}
					}
					if ($i === $rows - 1) {
						$p3_s1 .= '\dfrac {(' . $sum1 . ')^2}{' . $nr . '}';
						$p3_s2 .= '\dfrac {' . pow($sum1, 2) . '}{' . $nr . '}';
						$p3_s3 .= round(((pow($sum1, 2)) / $nr), 4);
					} else {
						$p3_s1 .= '\dfrac {(' . $sum1 . ')^2}{' . $nr . '} + ';
						$p3_s2 .= '\dfrac {' . pow($sum1, 2) . '}{' . $nr . '} + ';
						$p3_s3 .= round(((pow($sum1, 2)) / $nr), 4) . ' + ';
					}
					$C += (pow($sum1, 2)) / $nr;

					$table .= "</tr>";
					$table1 .= "</tr>";
				}

				$p5_s1 .= '\dfrac {(' . $summ . ')^2}{' . $n . '}';
				$p5_s2 .= '\dfrac {' . pow($summ, 2) . '}{' . $n . '}';
				$E += round(((pow($summ, 2)) / $n), 4);
				$table .= "</tbody></table>";
				$table1 .= "<tr class='bg-white'><td class='p-2 border text-center'><b>Col Total</b></td>";
				foreach ($sumxa as $key => $value) {
					$table1 .= "<td class='p-2 border text-center'><b>$value</b></td>";
				}
				$table1 .= "</tr></tbody></table>";

				$p1 = '';
				$p2_s1 = '';
				$p2_s2 = '';
				$p2_s3 = '';
				$A = 0;
				$B = 0;
				$plus = ' + ';
				for ($i = 0; $i < $columns; $i++) {
					$nc = 0;
					for ($j = 0; $j < $rows; $j++) {
						$input = $_POST['td_' . $j . '_' . $i];
						$inputs = array_map("trim", explode(",", $input));
						$nc += count($inputs);
					}
					if ($i === $columns - 1) {
						$p2_s1 .= '\dfrac {(' . $sumxa[$i] . ')^2}{' . $nc . '}';
						$p2_s2 .= '\dfrac {' . pow($sumxa[$i], 2) . '}{' . $nc . '}';
						$p2_s3 .= round(((pow($sumxa[$i], 2)) / $nc), 4);
					} else {
						$p2_s1 .= '\dfrac {(' . $sumxa[$i] . ')^2}{' . $nc . '} + ';
						$p2_s2 .= '\dfrac {' . pow($sumxa[$i], 2) . '}{' . $nc . '} + ';
						$p2_s3 .= round(((pow($sumxa[$i], 2)) / $nc), 4) . ' + ';
					}
					$B += (pow($sumxa[$i], 2)) / $nc;
				}
				for ($i = 0; $i < $rows; $i++) {
					for ($j = 0; $j < $columns; $j++) {
						$input = $_POST['td_' . $i . '_' . $j];
						$inputs = array_map("trim", explode(",", $input));
						foreach ($inputs as $key => $value) {
							$A += pow($value, 2);
							if ($i === $rows - 1 && $j === $columns - 1 && count($inputs) === $key + 1) {
								$plus = '';
							}
							if ($i === 0 && $j === 0) {
								$p1 .= $value . '^2' . $plus;
							}
							if ($i === $rows - 1 && $j === $columns - 1 && count($inputs) === $key + $rows) {
								$p1 .= '...' . $plus;
							}
							if ($i === $rows - 1 && $j === $columns - 1) {
								$p1 .= $value . '^2' . $plus;
							}
						}
					}
				}
				$this->param["rows"] = $rows;
				$this->param["columns"] = $columns;
				$this->param["table"] = $table;
				$this->param["table1"] = $table1;
				$this->param["p1"] = $p1;
				$this->param["A"] = $A;
				$this->param["p2_s1"] = $p2_s1;
				$this->param["p2_s2"] = $p2_s2;
				$this->param["p2_s3"] = $p2_s3;
				$this->param["B"] = $B;
				$this->param["p3_s1"] = $p3_s1;
				$this->param["p3_s2"] = $p3_s2;
				$this->param["p3_s3"] = $p3_s3;
				$this->param["C"] = $C;
				$this->param["p4_s1"] = $p4_s1;
				$this->param["p4_s2"] = $p4_s2;
				$this->param["p4_s3"] = $p4_s3;
				$this->param["D"] = $D;
				$this->param["p5_s1"] = $p5_s1;
				$this->param["p5_s2"] = $p5_s2;
				$this->param["E"] = $E;
				$this->param["n"] = $n;
				$this->param["RESULT"] = 1;
				return $this->param;
			} else {
				$this->param['error'] = "Please! Check Your Input";
				return $this->param;
			}
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}

	// Binomial Distribution Calculator
	public function binomial($request)
	{
		$x = $request->x;
		$n = $request->n;
		$con = $request->con;
		$p = $request->p;
		if ($n < 0 || $n > 440) {
			$this->param['error'] = "This calculator is work with 0 to 440 for Trials (n)";
			return $this->param;
		}
		if ($p < 0 || $p > 1) {
			$this->param['error'] = "The probability must be between 0 and 1";
			return $this->param;
		}
		if ($x > $n) {
			$this->param['error'] = "The number of successes must be less than or equal to the number of trials";
			return $this->param;
		}
		if (is_numeric($x) && is_numeric($n) && is_numeric($con) && is_numeric($p)) {
			if ($con === '1') {
				$fact = gmp_fact($n);
				$nf = gmp_strval($fact);

				$fact = gmp_fact($x);
				$xf = gmp_strval($fact);

				$fact = gmp_fact($n - $x);
				$nxf = gmp_strval($fact);
				$ans = ($nf / ($xf * $nxf)) * (pow($p, $x)) * (pow((1 - $p), ($n - $x)));
				$table = [];
				for ($i = 0; $i <= $n; $i++) {
					$fact = gmp_fact($n);
					$nf = gmp_strval($fact);

					$fact = gmp_fact($i);
					$if = gmp_strval($fact);

					$fact = gmp_fact($n - $i);
					$nxf = gmp_strval($fact);
					$table[] = ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
				}
			} elseif ($con === '2') {
				$table = [];
				$ans = 0;
				for ($i = 0; $i <= $n; $i++) {
					$fact = gmp_fact($n);
					$nf = gmp_strval($fact);

					$fact = gmp_fact($i);
					$if = gmp_strval($fact);

					$fact = gmp_fact($n - $i);
					$nxf = gmp_strval($fact);
					if ($i < $x) {
						$ans += ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
					}
					$table[] = ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
				}
			} elseif ($con === '3') {
				$table = [];
				$ans = 0;
				for ($i = 0; $i <= $n; $i++) {
					$fact = gmp_fact($n);
					$nf = gmp_strval($fact);

					$fact = gmp_fact($i);
					$if = gmp_strval($fact);

					$fact = gmp_fact($n - $i);
					$nxf = gmp_strval($fact);
					if ($i <= $x) {
						$ans += ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
					}
					$table[] = ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
				}
			} elseif ($con === '4') {
				$table = [];
				$ans = 0;
				for ($i = 0; $i <= $n; $i++) {
					$fact = gmp_fact($n);
					$nf = gmp_strval($fact);

					$fact = gmp_fact($i);
					$if = gmp_strval($fact);

					$fact = gmp_fact($n - $i);
					$nxf = gmp_strval($fact);
					$table[] = ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
				}
				for ($i = $x + 1; $i <= $n; $i++) {
					$ans += $table[$i];
				}
			} elseif ($con === '5') {
				$table = [];
				$ans = 0;
				for ($i = 0; $i <= $n; $i++) {
					$fact = gmp_fact($n);
					$nf = gmp_strval($fact);

					$fact = gmp_fact($i);
					$if = gmp_strval($fact);

					$fact = gmp_fact($n - $i);
					$nxf = gmp_strval($fact);
					$table[] = ($nf / ($if * $nxf)) * (pow($p, $i)) * (pow((1 - $p), ($n - $i)));
				}
				for ($i = $x; $i <= $n; $i++) {
					$ans += $table[$i];
				}
			}
			$this->param['ans'] = $ans;
			$this->param['table'] = $table;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please! Check Your Input";
			return $this->param;
		}
	}
}
