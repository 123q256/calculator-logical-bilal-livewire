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

	public function age($request)
	{
		// dd($request);
		$day   = $request->day;
		$month = $request->month;
		$year  = $request->year;
		$dob = sprintf('%04d-%02d-%02d', $year, $month, $day);

		$day_sec   = $request->day_sec;
		$month_sec = $request->month_sec;
		$year_sec  = $request->year_sec;
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
				// dd($diff);
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
			$this->param['RESULT'] = 1;
			// dd($this->param);
			return $this->param;
		} else {
			$this->param['error'] = 'Please check your input.';
			return $this->param;
		}
	}


}
