<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    public $param;

    public function distance($request)
	{
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
				return  $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return  $this->param;
			}
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
		$p_unit = str_replace($currancy.' ','', $p_unit);
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
						if ($bag_size1 === 'm³') {
							$bag_size = $bag_size * 35.315;
						}
						if ($bag_size1 === 'cu yd') {
							$bag_size = $bag_size * 27;
						}
						if ($bag_size1 === 'liters') {
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
						if ($bag_size1 === 'm³') {
							$bag_size = $bag_size * 35.315;
						}
						if ($bag_size1 === 'cu yd') {
							$bag_size = $bag_size * 27;
						}
						if ($bag_size1 === 'liters') {
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
					if ($bag_size1 == 'm³') {
						$bag_size = $bag_size * 35.315;
					}
					if ($bag_size1 == 'cu yd') {
						$bag_size = $bag_size * 27;
					}
					if ($bag_size1 == 'liters') {
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
					if ($bag_size1 == 'm³') {
						$bag_size = $bag_size * 35.315;
					}
					if ($bag_size1 == 'cu yd') {
						$bag_size = $bag_size * 27;
					}
					if ($bag_size1 == 'liters') {
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
		$hiddencurrancy = $request->input('hiddencurrancy');


		if($area_unit == 'mm²'){
		$area_unit = 'mm2';
		}else if($area_unit == 'cm²'){
		$area_unit = 'cm2';
		}else if($area_unit == 'm²'){
		$area_unit = 'mm2';
		}else if($area_unit == 'in²'){
		$area_unit = 'm2';
		}else if($area_unit == 'ft²'){
		$area_unit = 'in2';
		}else if($area_unit == 'yd²'){
		$area_unit = 'yd2';
		}else if($area_unit == 'hectares'){
		$area_unit = 'ha';
		}else if($area_unit == 'acres'){
		$area_unit = 'ac';
      	}else if($area_unit == 'soccer fields'){
		$area_unit = 'sf';
	   }


	   if($volume_unit == 'mm³'){
		$volume_unit = 'mm3';
		}else if($volume_unit == 'cm³'){
		$volume_unit = 'cm3';
		}else if($volume_unit == 'm³'){
		$volume_unit = 'm3';
		}else if($volume_unit == 'in³'){
		$volume_unit = 'in3';
		}else if($volume_unit == 'ft³'){
		$volume_unit = 'ft3';
		}else if($volume_unit == 'yd³'){
		$volume_unit = 'yd3';
		}

		if($density_unit == 'kg/m³'){
			$density_unit = 'kg_m3';
			}else if($density_unit == 't/m³'){
			$density_unit = 't_m3';
			}else if($density_unit == 'g/cm³'){
			$density_unit = 'g_cm3';
			}else if($density_unit == 'oz/in³'){
			$density_unit = 'oz_in3';
			}else if($density_unit == 'lb/in³'){
			$density_unit = 'lb_in3';
			}else if($density_unit == 'lb/ft³'){
			$density_unit = 'lb_ft3';
		   }else if($density_unit == 'lb/yd³'){
			$density_unit = 'lb_yd3';
			}


			if($mass_price_unit == $hiddencurrancy.'µg'){
				$mass_price_unit = 'ug';
				}else if($mass_price_unit == $hiddencurrancy.'mg'){
				$mass_price_unit = 'mg';
				}else if($mass_price_unit == $hiddencurrancy.'g'){
				$mass_price_unit = 'g';
				}else if($mass_price_unit == $hiddencurrancy.'kg'){
				$mass_price_unit = 'kg';
				}else if($mass_price_unit == $hiddencurrancy.'t'){
				$mass_price_unit = 't';
				}else if($mass_price_unit == $hiddencurrancy.'lb'){
				$mass_price_unit = 'lb';
			   }else if($mass_price_unit == $hiddencurrancy.'stone'){
				$mass_price_unit = 'stone';
				}else if($mass_price_unit == $hiddencurrancy.'US ton'){
					$mass_price_unit = $hiddencurrancy.'us_ton';
				}else if($mass_price_unit == 'Long ton'){
				$mass_price_unit = $hiddencurrancy.'long_ton';
				}

				if($volume_price_unit == $hiddencurrancy.'mm³'){
					$volume_price_unit = 'mm3';
					}else if($volume_price_unit == $hiddencurrancy.'cm³'){
					$volume_price_unit = 'cm3';
					}else if($volume_price_unit == $hiddencurrancy.'m³'){
					$volume_price_unit = 'm3';
					}else if($volume_price_unit == $hiddencurrancy.'in³'){
					$volume_price_unit = 'in3';
					}else if($volume_price_unit == $hiddencurrancy.'ft³'){
					$volume_price_unit = 'ft3';
			    	}else if($volume_price_unit == $hiddencurrancy.'yd³'){
					$volume_price_unit = 'yd3';
					}


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

		if($price_unit == 'ft³'){
			$price_unit = '1';
		}else if($price_unit == 'yd³'){
			$price_unit = '2';

		}else if($price_unit == 'ft³'){
			$price_unit = '3';

			}
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
		$currancy = $request->input('currancy');
		$price_unit = $request->input('price_unit');


		if($price_unit == $currancy.'ft²'){
			$price_unit = '1';
		}else if($price_unit == $currancy.'m²'){
			$price_unit = '2';
		}

		if($cost_unit == $currancy.'ft²'){
			$cost_unit = '1';
		}else if($cost_unit == $currancy.'m²'){
			$cost_unit = '2';
		}


		function unit_convertc($a, $b)
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
				$first = unit_convertc($first, $units1);
				$second = unit_convertc($second, $units2);
				$third = unit_convertc($third, $units3);
				$four = unit_convertc($four, $units4);
				$patio_area_ans = $third * $four;
				$area_ans = $first * $second;
				$area_ans = round($area_ans, 7);
				$patio_area_ans = round($patio_area_ans, 7);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($fiveb)) {
				$first = unit_convertc($first, $units1);
				$second = unit_convertc($second, $units2);
				$third = unit_convertc($third, $units3);
				$four = unit_convertc($four, $units4);
				$area_ans = $first * $second * $fiveb;
				$patio_area_ans = $third * $four;
				$area_ans = round($area_ans, 7);
				$patio_area_ans = round($patio_area_ans, 7);
			} else {
				return $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first)) {
				$first = unit_convertc($first, $units1);
				$sq_val = $first / 2;
				$final_val = $sq_val * $sq_val;
				$area_ans = 3.14 * $final_val;
				$third = unit_convertc($third, $units3);
				$four = unit_convertc($four, $units4);
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

	// fence calcualtor
	public function fence($request)
	{
		// dd($request->all());
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
	$price_unit = str_replace($currancy,'', $price_unit);
	if ($to_cal == 1) {
		if (is_numeric($length) && is_numeric($width)) {
			if ($width_unit==='cm') {
				$width=$width*0.01;
			}elseif ($width_unit==='in') {
				$width=$width*0.0254;
			}elseif ($width_unit==='ft') {
				$width=$width*0.3048;
			}elseif ($width_unit==='yd') {
				$width=$width*0.9144;
			}elseif($width_unit=='mm'){
				$width=$width*0.001;
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
			if ($width_unit==='cm') {
				$width=$width*0.01;
			}elseif ($width_unit==='in') {
				$width=$width*0.0254;
			}elseif ($width_unit==='ft') {
				$width=$width*0.3048;
			}elseif ($width_unit==='yd') {
				$width=$width*0.9144;
			}elseif($width_unit=='mm'){
				$width=$width*0.001;
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
			if ($length_unit==='cm') {
				$length=$length*0.01;
			}elseif ($length_unit==='in') {
				$length=$length*0.0254;
			}elseif ($length_unit==='ft') {
				$length=$length*0.3048;
			}elseif ($length_unit==='yd') {
				$length=$length*0.9144;
			}elseif($length_unit=='mm'){
				$length=$length*0.001;
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
	$currency = $request->input('currency');


	if($price_unit == $currency.'tile'){
		$price_unit = 'tile';
	} else if($price_unit == $currency.'box'){
		$price_unit = 'box';
	} else if($price_unit == $currency.'inch²'){
		$price_unit = 'in²';
	} else if($price_unit == $currency.'feet²'){
		$price_unit = 'ft²';
	} else if($price_unit == $currency.'yard²'){
		$price_unit = 'yd²';
	} else if($price_unit == $currency.'acre'){
		$price_unit = 'ac';
	} else if($price_unit == $currency.'meter²'){
		$price_unit = 'm²';
	}

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

	// brick calculator
	public function brick($request){
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
		$price_sand_volume_unit = str_replace($currancy.' ','', $price_sand_volume_unit);
		// dd($price_sand_volume_unit);
		function convert_to_meter($unit, $value){
			if ($unit == 'cm') {
				$ans = $value / 100;
			}elseif ($unit == 'm') {
				$ans = $value;
			}elseif ($unit == 'in') {
				$ans = $value / 39.37;
			}elseif ($unit == 'ft') {
				$ans = $value /  3.281;
			}elseif ($unit == 'yd') {
				$ans = $value /  1.094;
			}elseif ($unit == 'dm') {
				$ans = $value / 10;
			}elseif ($unit == 'mm') {
				$ans = $value / 1000;
			}
			return $ans;
		}
		function convert_to_millimeter($unit,$value){
			if($unit == 'cm'){
				$ans = $value * 10;
			}elseif($unit == 'm'){
				$ans = $value * 1000;
			}elseif($unit == 'in'){
				$ans = $value * 25.4;
			}elseif($unit == 'ft'){
				$ans = $value * 304.8;
			}elseif ($unit == 'yd') {
				$ans = $value * 914.4;
			}elseif ($unit == 'dm') {
				$ans = $value * 100;
			}elseif ($unit == 'mm') {
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_kilo($unit,$value){
			if($unit == 'g'){
				$ans = $value / 1000;
			}elseif($unit == 'lb'){
				$ans = $value / 2.205;
			}elseif($unit == 't'){
				$ans = $value * 1000;
			}elseif($unit == 'stone'){
				$ans = $value * 6.35029;
			}elseif($unit == 'kg'){
				$ans = $value;
			}
			return $ans;
		}
		function convert_to_meter_cube($unit,$value){
			if($unit == 'cm³'){
				$ans = $value / 1000000;
			}elseif($unit == 'cu_ft'){
				$ans = $value / 35.315;
			}elseif($unit == 'cu_yd'){
				$ans = $value / 1.308;
			}elseif($unit == 'm³'){
				$ans = $value;
			}
			return $ans;
		}
		if(is_numeric($wall_width) || is_numeric($mortar_joint_thickness) || is_numeric($wall_width) || is_numeric($brick_width)){
			if($wall_length>=0 && $wall_width>=0 && $wall_height>=0 && $mortar_joint_thickness>=0 && $brick_wastage>=0 && $brick_length>=0 && $brick_width>=0 && $brick_height>=0 && $price_per_brick>=0){
				// dd($wall_length_unit	);
				$wall_length = convert_to_meter($wall_length_unit,$wall_length);
				$wall_width = convert_to_meter($wall_width_unit,$wall_width);
				$wall_height = convert_to_meter($wall_height_unit,$wall_height);
				$mortar_joint_thickness = convert_to_meter($mortar_joint_thickness_unit,$mortar_joint_thickness);
				// -------------------------Wall Area---------------------------------------
				$wall_area = $wall_length * $wall_height;

				// -------------------------Brick Calculation----------------------------------
				if($brick_type==1){
					$brick_length = convert_to_meter($brick_length_unit,$brick_length);
					$brick_height = convert_to_meter($brick_height_unit,$brick_height);
					$brick_width = convert_to_meter($brick_width_unit,$brick_width);
				}else{
					$brick_array = explode('x',$brick_type);
					$brick_length = convert_to_meter('in',$brick_array[0]);
					$brick_height = convert_to_meter('in',$brick_array[1]);
				}
				// -------------------------Brick Area---------------------------------------
				$brick_sum = ($brick_length + $mortar_joint_thickness)*($brick_height+$mortar_joint_thickness);
				$no_of_bricks = ceil($wall_area/$brick_sum);
				$wastage = ceil(($brick_wastage*$no_of_bricks)/100);
				
				$no_of_bricks_with_wastage = round($no_of_bricks + $wastage);

				if($wall_type=='double'){
					$no_of_bricks = $no_of_bricks * 2;
					$no_of_bricks_with_wastage = $no_of_bricks_with_wastage * 2;
				}
				
				// ---------------------------Calculate Cost-----------------------------------
				$cost_of_bricks = $price_per_brick*$no_of_bricks_with_wastage;
				
				// ----------------------------With Mortar check -------------------------------
				if($with_motar=='no'){
					$this->param['wall_area']                 = $wall_area;
					$this->param['no_of_bricks']              = $no_of_bricks;
					$this->param['no_of_bricks_with_wastage'] = $no_of_bricks_with_wastage;
					$this->param['cost_of_bricks']            = $cost_of_bricks;
					$this->param['RESULT']                    = 1;

					return $this->param;
				}elseif($with_motar=='yes'){
					if(is_numeric($wet_volume) && is_numeric($mortar_wastage) && is_numeric($bag_size) && is_numeric($price_of_cement) && is_numeric($price_sand_per_volume)){
						if($wet_volume>=0 && $mortar_wastage>=0 && $bag_size>=0 && $price_of_cement>=0 && $price_sand_per_volume>=0){
							// --------------------------Mortar Needed----------------------------
							$wet_volume = convert_to_meter_cube($wet_volume_unit,$wet_volume);
							$dry_volume = $wet_volume + (52*$wet_volume/100);
							$dry_volume_wastage = ($mortar_wastage * $dry_volume)/100;
							$dry_volume_with_wastage = $dry_volume + $dry_volume_wastage;

							// ---------------------------Mortar Component------------------------

							$ratio = explode(':',$mortar_ratio);
							$cement_ratio = $ratio[0];
							$sand_ratio = $ratio[1];
							$total_ratio = $cement_ratio + $sand_ratio;

							$volume_of_cement = round(($dry_volume_with_wastage * $cement_ratio)/$total_ratio,4);
							$weight_of_cement = $volume_of_cement * 1440;
							$bag_size = convert_to_kilo($bag_size_unit,$bag_size);
							$number_of_bags = ceil($weight_of_cement / $bag_size);
							$volume_of_sand = round(($dry_volume_with_wastage * $sand_ratio)/$total_ratio,4);

							$price_sand_per_volume = convert_to_meter_cube($price_sand_volume_unit,$price_sand_per_volume);
							$price_of_sand = $price_sand_per_volume * $volume_of_sand;
							$price_for_cement = $number_of_bags*$price_of_cement;
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
						}else{
							$this->param['error'] = 'Please! Enter Positive Values';
							return $this->param;
						}
					}else{
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
				}
			}else{
				$this->param['error'] = 'Please! Enter Positive Values';
				return $this->param;
			}
		}else{
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

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

// Rebar calculator	
public function rebar($request){
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
	$units5 = str_replace($currancy.' ','', $units5);
	function cm_unit($a,$b){
		if($a == "cm"){
			$convert = $b * 1;
		}elseif ($a == "m") {
			$convert = $b * 100;
		}elseif ($a == "km") {
			$convert = $b * 100000;
		}elseif ($a == "in") {
			$convert = $b *  2.54;
		}elseif ($a == "ft") {
			$convert = $b * 30.48;
		}elseif ($a == "yd") {
			$convert = $b * 91.44;
		}elseif ($a == "mi") {
			$convert = $b * 30.48;
		}
		return $convert;
	}
	function cm_unit2($a,$b){
		if($a == "mm"){
			$convert2 = $b / 10;
		}elseif ($a == "cm") {
			$convert2 = $b * 1;
		}elseif ($a == "m") {
			$convert2 = $b * 100;
		}elseif ($a == "in") {
			$convert2 = $b *  2.54;
		}elseif ($a == "ft") {
			$convert2 = $b * 30.48;
		}elseif ($a == "yd") {
			$convert2 = $b * 91.44;
		}
		return $convert2;
	}
	function cm_unit3($a,$b){
		if($a == "cm"){
			$convert3 = $b * 1;
		}elseif ($a == "m") {
			$convert3 = $b * 100;
		}elseif ($a == "in") {
			$convert3 = $b * 2.54;
		}elseif ($a == "ft") {
			$convert3 = $b *  30.48;
		}elseif ($a == "yd") {
			$convert3 = $b * 91.44;
		}
		return $convert3;
	}
	
	if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five) && is_numeric($six)) {
		$first = cm_unit($units1,$first);
		$second = cm_unit($units2,$second);
		$third = cm_unit2($units3,$third);
		$four = cm_unit2($units4,$four);
		$five = cm_unit3($units5,$five);
		$six = cm_unit3($units6,$six);
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
	}else{
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

// Material Calculator   
public function material($request){
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
	$unit6 = str_replace($currancy.' ','', $unit6);
	$unit7 = str_replace($currancy.' ','', $unit7);
	// dd($unit7);
	function feet($unit, $value){
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
	function feet2($unit, $value){
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
	function lb($a,$b){
		if($a == "lb"){
			// dd($a,$b);
			$convert1 = $b * 1;
		}elseif ($a == "t"){
			$convert1 = $b * 2000;
		}elseif ($a == "long t"){
			$convert1 = $b * 2240;
		}elseif ($a == "kg"){
			$convert1 = $b * 2.205;
		}
		return $convert1;
	}
	if ($operations == "1") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third)) { 
			$first = feet($unit1,$first);
			$second = feet($unit2,$second);
			$third = feet($unit3,$third);
			$area = $first * $second; 
			$volume = $area * $third; 
			$weight =$ex_drop*($volume/1728);
			$this->param['area'] = $area;
			$this->param['volume'] = $volume;
		}else{
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param; 
		}
	}elseif ($operations == "2") {
		if (is_numeric($third) && is_numeric($four)) {
			$third = feet($unit3,$third);
			$four = feet($unit4,$four);
			$volume = $four * $third;                
			$weight = $ex_drop*($volume/1728);
			$this->param['volume'] = $volume;
		}else{
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param; 
		}
	}elseif ($operations == "3") {
		if (is_numeric($five)) {
			$five = feet2($unit5,$five);
			$volume = $five;
			$weight = $ex_drop*($volume/1728);
		}else{
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param; 
		}
	}
	if (is_numeric($six)) {
		$six = lb($unit6,$six);
		$this->param['cost_mass'] = $six * $weight;
	}
	if (is_numeric($seven)) {
		$seven = feet2($unit7,$seven);
		$this->param['cost_volume'] = $volume * $seven ;
		// dd($cost_volume);
	}
	$this->param['weight'] = $weight;
	$this->param['RESULT'] = 1;
	return $this->param;
}

	// Stud Calculator
	public function stud($request){
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

		function convert_to_in($unit, $value){
			if ($unit == 'in') {
				$ans = $value;
			}
			elseif ($unit == 'cm') {
				$ans = $value / 2.54;
			}
			elseif ($unit == 'ft') {
				$ans = $value * 12;
			}
			return $ans;
		}

		if(!empty($want) && is_numeric($wall_end_stud) && is_numeric($hight) && is_numeric($length) && is_numeric($stud_spacing)){
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

			if($want == 'sheet' || $want == 'all'){
				if(is_numeric($rim_joist_width) && is_numeric($subfloor_thickness)){
					$rim_joist_width_in    = convert_to_in($rim_joist_width_unit, $rim_joist_width);
					$subfloor_thickness_in = convert_to_in($subfloor_thickness_unit, $subfloor_thickness); 
					$extra                 = (($rim_joist_width_in + $subfloor_thickness_in) * $length_in) / 144 ; 
					$sheets_req            = round(($wall_area_ft + $extra) / 32, 3);

					$this->param['sheets_req'] = $sheets_req;
				}
				else{
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}

			if($want == 'board' || $want == 'all'){
				if(is_numeric($stud_width)){
					$stud_width_in = convert_to_in($stud_width_unit, $stud_width);
					$board_footage = ($stud_width_in * 96) / 12;

					$this->param['board_footage'] = $board_footage;
				}
				else{
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
		}
		else{
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}

	// Stone Calculator
	public function stone($request){
		$selection = trim( $request->input( 'selection'));
		$length = trim( $request->input( 'length'));
		$length_unit = trim( $request->input( 'length_unit'));
		$width = trim( $request->input( 'width'));
		$width_unit = trim( $request->input( 'width_unit'));
		$area = trim( $request->input( 'area'));
		$area_unit = trim( $request->input( 'area_unit'));
		$depth = trim( $request->input( 'depth'));
		$depth_unit = trim( $request->input( 'depth_unit'));
		$volume = trim( $request->input( 'volume'));
		$volume_unit = trim( $request->input( 'volume_unit'));
		$material = trim( $request->input( 'material'));
		$price = trim( $request->input( 'price'));
		$price_unit = trim( $request->input( 'price_unit'));
		$currancy = $request->input('currancy');
		$price_unit = str_replace($currancy . ' ', '', $price_unit);
		
	    function unit_ft($a,$b){
	        if($b == "cm"){
	            $ans1 = $a/30.48;
	        }elseif($b == "m"){
	            $ans1 = $a*3.281;
	        }elseif($b == "in"){
	            $ans1 = $a/12;
	        }elseif($b == "yd"){
	            $ans1 = $a*3;
	        }elseif($b == "ft"){
	            $ans1 = $a*1;
	        }
	        return $ans1;
	    }
	    function unit_area($aa,$bb){
	        if($bb =="ft²"){
	            $ans2 = $aa * 1;
	        }else if ($bb == "yd²"){
	            $ans2 = $aa*9;
	        }else if($bb == "m²"){
	            $ans2 = $aa*10.764;
	        }
	        return $ans2;
	    }
	    function unit_vol($a,$b){
	        if($b == "ft³"){
	            $ans3 = $a*1;
	        }else if($b == "yd³"){
	            $ans3 = $a*27;
	        }else if($b == "m³"){
	            $ans3 = $a*35.315;
	        }
	        return $ans3;
	    }
	    function material_val($a,$b){
	        if($b =="105"){
	            $tons1 = $a*1.4;
	            $tons2 = $a*1.7;
	        }else if($b == "150"){
	            $tons1 = $a*1.5;
	            $tons2 = $a*1.7;
	        }else if($b == "160"){
	            $tons1 = $a*1.5;
	            $tons2 = $a*1.7;
	        }else if ($b = "145"){
	            $tons1 = $a*1.3;
	            $tons2 = $a*1.5;
	        }else if($b = "168"){
	            $tons1 = $a*1.5;
	            $tons2 = $a*1.7;
	        }else if($b = "188"){
	            $tons1 = $a*1;
	            $tons2 = $a*1.3;
	        }else if ($b = "100"){
	            $tons1 = $a*1.7;
	            $tons2 = $a*2;
	        }
	        return array($tons1, $tons2);
	    }
	    function material_m($a,$b){
	        if($b =="105"){
	            $tons1 = $a*1.66;
	            $tons2 = $a*2.02;
	        }else if($b == "150"){
	            $tons1 = $a*1.78;
	            $tons2 = $a*2.02;
	        }else if($b == "160"){
	            $tons1 = $a*1;
	            $tons2 = $a*2.02;
	        }else if ($b = "145"){
	            $tons1 = $a*1.54;
	            $tons2 = $a*1.78;
	        }else if($b = "168"){
	            $tons1 = $a*1.78;
	            $tons2 = $a*2.02;
	        }else if($b = "188"){
	            $tons1 = $a*1.19;
	            $tons2 = $a*1.54;
	        }else if ($b = "100"){
	            $tons1 = $a*2.02;
	            $tons2 = $a*2.34;
	        }
	        return array($tons1, $tons2);
	    }
	    if($selection == "1"){
			if (is_numeric($length) && is_numeric($width) && is_numeric($depth)) {
				$length = unit_ft($length,$length_unit);
				$width = unit_ft($width,$width_unit);
				$depth = unit_ft($depth,$depth_unit);
	            $cubicyd = $length * $width * $depth;
	            $cubicyd1 = $cubicyd /27;
	            $array = material_val($cubicyd1 ,$material);
	            $this->param['cubicyd1'] = $cubicyd1;
	            $this->param['array'] = $array;
	        }else{
	           $this->param ['error'] = 'Please! Check Your Input';
	            return $this->param; 
	        }
	    }else if($selection == "2"){
	        if (is_numeric($area) && is_numeric($depth)) {
				$area = unit_area($area,$area_unit);
				$depth = unit_ft($depth,$depth_unit);
	            if($area_unit === "3" && $depth_unit === "m"){
	                $cubicyd = ($area / 10.764) * ($depth / 3.281);
	            }else{
	                $cubicyd =$area * $depth;
	            }
	            $cubicyd1 = $cubicyd/27;
	            $array = material_val($cubicyd1 ,$material);
	            $this->param['array'] = $array;
	            $this->param['cubicyd1'] = $cubicyd1;
	        }else{
	           $this->param ['error'] = 'Please! Check Your Input';
	            return $this->param; 
	        }
	    }else if($selection == "3"){
	        if (is_numeric($volume)) {
	            if($volume_unit === "1"){
	                $cubicyd1 = $volume / 27;
	                $array = material_val($cubicyd1,$material);
	            }else if($volume_unit === "2"){
	                $cubicyd1 = $volume;
	                $array = material_val($cubicyd1,$material);
	            }else{
	                $cubicyd1 = $volume;
	                $array =material_m($cubicyd1,$material);
	            }
	            $this->param['cubicyd1'] = $cubicyd1;
	            $this->param['array'] = $array;
	        }else{
	           $this->param ['error'] = 'Please! Check Your Input';
	            return $this->param; 
	        }
	    }
	    if (is_numeric($price)) {
	        if($price_unit == "per ton"){
	            array_walk($array, function(&$v) use($price) {$v *= $price;});
	            $price_ton = $array;
	            $this->param['price_ton'] = $price_ton;	
	        }else {
	            $price_cu = $price * $cubicyd1;
	            $this->param['price_cu'] = $price_cu;	
	        }
			$this->param['price'] = $price;	
	    }
	    $this->param[ 'RESULT' ] = 1;
	    return $this->param;
	}

/*******************
    	Concrete Block Calculator
	 *******************/
	public function concrete_block($request)
	{
		//  dd($request->all());
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

	// roof-pitch-calculator
	function roof($request)
		{
			// $submit = $request->submit;
			$rise = $request->x;
			$run = $request->y;
			$unit = $request->unit;
			$unit_r = $request->unit_r;
			$unit_a = $request->unit_a;
			$from = $request->from;

			if (is_numeric($rise) && is_numeric($run)) {
				if ($from == '1') {
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
				} elseif ($from == '2') {
					$rafter = $request->y;
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
				} elseif ($from == '3') {
					$run = $request->x;
					$rafter = $request->y;
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
				} elseif ($from == '4') {
					$pitch = $request->y;
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
				} elseif ($from == '5') {
					$angle = $request->y;
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
				} elseif ($from == '6') {
					$x = $request->y;
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
				} elseif ($from == '7') {
					$run = $request->x;
					$pitch = $request->y;
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
				} elseif ($from == '8') {
					$run = $request->x;
					$angle = $request->y;
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
				} elseif ($from == '9') {
					$run = $request->x;
					$x = $request->y;
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
				} elseif ($from == '10') {
					$rafter = $request->x;
					$pitch = $request->y;
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
		'1:12' => ["value" => "1.003"], '2:12' => ["value" => "1.014"], '3:12' => ["value" => "1.031"], '4:12' => ["value" => "1.054"],
		'5:12' => ["value" => "1.083"], '6:12' => ["value" => "1.118"], '7:12' => ["value" => "1.158"], '8:12' => ["value" => "1.202"],
		'9:12' => ["value" => "1.250"], '10:12' => ["value" => "1.302"], '11:12' => ["value" => "1.357"], '12:12' => ["value" => "1.414"],
		'13:12' => ["value" => "1.474"], '14:12' => ["value" => "1.537"], '15:12' => ["value" => "1.601"], '16:12' => ["value" => "1.667"],
		'17:12' => ["value" => "1.734"], '18:12' => ["value" => "1.803"], '19:12' => ["value" => "1.873"], '20:12' => ["value" => "1.944"],
		'21:12' => ["value" => "2.016"], '22:12' => ["value" => "2.088"], '23:12' => ["value" => "2.162"], '24:12' => ["value" => "2.236"],
		'25:12' => ["value" => "2.311"], '26:12' => ["value" => "2.386"], '27:12' => ["value" => "2.462"], '28:12' => ["value" => "2.539"],
		'29:12' => ["value" => "2.615"], '30:12' => ["value" => "2.693"],
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
				CURLOPT_SSL_VERIFYHOST => false,   // 🔥 add this line
	            CURLOPT_SSL_VERIFYPEER => false    // 🔥 add this line
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$resp = $response;
		if ($response === false) {
		$error = curl_error($curl);
		dd("cURL Error: " . $error);
		}
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

// cubic-feet-calculator
public function cubic($request)
{
	$length = $request->length;
	$width = $request->width;
	$height = $request->height;
	$length_unit = $request->length_unit;
	$width_unit = $request->width_unit;
	$height_unit = $request->height_unit;
	$weight = $request->weight;
	$weight_unit = $request->weight_unit;
	$quantity = $request->quantity;
	$price = $request->price;

	$price_unit = $request->price_unit;
	$room_unit = $request->room_unit;
	$area = $request->area;
	$area_unit = $request->area_unit;

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
			
			if ($price != 0 && $weight != "" && $price != "") {
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
			$this->param['room_unit'] = $room_unit;
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
			if ($price != 0 && $price != '') {
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
			$this->param['room_unit'] = $room_unit;
			
			$this->param['RESULT'] = 1;
			
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}
}

// feet-and-inches-calculator
public function feet($request)
{
	// dd($request);
	$feet1 = $request->feet1;
	$inches1 = $request->inches1;
	$operations = $request->operations;
	$feet2 = $request->feet2;
	$inches2 = $request->inches2;
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
		$this->param['operations'] = $operations;
		$this->param['RESULT'] = 1;
		return $this->param;
	} else {
		$this->param['error'] = 'Please! Check Your Inputs';
		return $this->param;
	}
}

// Cubic Yard calculator	
public function yard($request)
{
	$operations=$request->input('operations');
	$first=$request->input('first');
	$second=$request->input('second');
	$third=$request->input('third');
	$four=$request->input('four');
	$quantity=$request->input('quantity');
	$units1=$request->input('units1');
	$units2=$request->input('units2');
	$units3=$request->input('units3');
	$units4=$request->input('units4');
	$price_unit=$request->input('price_unit');
	$price=$request->input('price');
	$extra_area=$request->input('extra_area');
	$extra_units=$request->input('extra_units');
	$currancy = $request->input('currancy');
	$price_unit = str_replace($currancy,'', $price_unit);
	function calculate($a,$b){
		if($b=="ft"){
			$convert=$a*1;
		}elseif ($b=="in") {
			$convert=$a*0.0833333;	
		}elseif ($b=="yd") {
			$convert=$a*3;	
		}elseif ($b=="cm") {
			$convert=$a*0.0328084;	
		}elseif ($b=="m") {
			$convert=$a*3.28084;
		}
		return $convert;
	}
	function calculate_square($x,$y){
		// dd($x,$y);
		if($y=="ft²"){
			$squ=$x*1;
		}elseif ($y=="in²") {
			$squ=$x*0.00694444;	
		}elseif ($y=="yd²") {
			$squ=$x*9;	
		}elseif ($y=="cm²") {
			$squ=$x*0.00107639;	
		}elseif ($y=="m²") {
			$squ=$x*10.7639;
		}
		return $squ;
	}
	if ($operations=="3") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			$cubic_feet=$first * $second * $third;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="4") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$sq_val=pow($second, 2);
			$cubic_feet=$first * $sq_val;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="5") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			$four=calculate($four,$units4);
			$in_area=$second * $third;
			$sq_border=$four * 2;
			$a1=$second + $sq_border;
			$a2=$third + $sq_border;
			$total_area=$a1 * $a2;
			$a=$total_area - $in_area;
			$cubic_feet=$a * $first;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="6") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$sq_val=$second / 2;
			$final_val=pow($sq_val, 2);
			$area=3.14 * $final_val;
			$cubic_feet=$first * $area;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="7") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			$a=$third * 2;
			$outer_diameter=$second + $a;
			$sq_val=$outer_diameter / 2;
			$final_val=pow($sq_val, 2);
			$outer_area=3.14 * $final_val;
			$sq_val2=$second / 2;
			$final_val2=pow($sq_val2, 2);
			$inner_area=3.14 * $final_val2;
			$area=$outer_area - $inner_area;
			$cubic_feet=$first * $area;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="8") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			$sq_val=$second / 2;
			$final_val=pow($sq_val, 2);
			$outer_area=3.14 * $final_val;
			$sq_val2=$third / 2;
			$final_val2=pow($sq_val2, 2);
			$inner_area=3.14 * $final_val2;
			$area=$outer_area - $inner_area;
			$cubic_feet=$first * $area;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="9") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			$four=calculate($four,$units4);
			$first_ans=$second + $third + $four;
			$second_ans=$third + $four - $second;
			$third_ans=$four + $second - $third;
			$four_ans=$second + $third - $four;
			$final_ans=$first_ans * $second_ans * $third_ans * $four_ans;
			$final_ans2=sqrt($final_ans);
			$area=0.25 * $final_ans2;
			$cubic_feet=$first * $area;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="10") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			$four=calculate($four,$units4);
			$first_ans=($second + $third)/2;
			$area=$first_ans * $four;
			$cubic_feet=$first * $area;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="11") {
		if (is_numeric($first) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$area=pow($first, 3);
			$cubic_feet=$area;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if($operations=="12"){
		if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$sq_val=pow($first, 2);
			$cubic_feet=$sq_val * $second * 3.14;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="13") {
		// dd('not get answer');
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$third=calculate($third,$units3);
			if ($first > $second) {
				$sq_first=pow($first, 2);
				$sq_second=pow($second, 2);
				$final_answer=$sq_first - $sq_second;
				$area=3.14 * $final_answer;
				$cubic_feet=$third * $area;
				$cubic_yard=$cubic_feet / 27;
				$cubic_meter=$cubic_feet * 0.0283;
				$cubic_cm=$cubic_feet * 28317;
				$cubic_in=$cubic_feet * 1728;
			}else{
				$this->param['error'] = 'Outer Radius must be greater than Inner Radius';
					return $this->param;
			}
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="14") {
		if (is_numeric($first) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$r_cube=pow($first, 3);
			$final=2 * 3.14 * $r_cube;
			$cubic_feet=$final / 3;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="15") {
		if (is_numeric($first) && is_numeric($second) && is_numeric($quantity)) {
			$first=calculate($first,$units1);
			$second=calculate($second,$units2);
			$r_cube=pow($first, 2);
			$height_ans=$second / 3;
			$cubic_feet=3.14 * $r_cube * $height_ans;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="16") {
		if (is_numeric($extra_area) && is_numeric($second) && is_numeric($quantity)) {
			$extra_area=calculate_square($extra_area,$extra_units);
			$second=calculate($second,$units2);
			$v=$extra_area * $second;
			$cubic_feet=$v / 3;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}else if ($operations=="17") {
		if (is_numeric($extra_area) && is_numeric($second) && is_numeric($quantity)) {
			$extra_area=calculate_square($extra_area,$extra_units);
			$second=calculate($second,$units2);
			$cubic_feet=$extra_area * $second;
			$cubic_yard=$cubic_feet / 27;
			$cubic_meter=$cubic_feet * 0.0283;
			$cubic_cm=$cubic_feet * 28317;
			$cubic_in=$cubic_feet * 1728;
		}else{
			$this->param['error'] = 'Please check your input';
			return $this->param;
		}
	}
	if(isset($quantity)){
		$cubic_feet=$cubic_feet * $quantity;
		$cubic_yard=$cubic_yard * $quantity;
		$cubic_meter=$cubic_meter * $quantity;
		$cubic_cm=$cubic_cm * $quantity;
		$cubic_in=$cubic_in * $quantity;
	}
	if(is_numeric($price)){
		if ($price_unit=="ft³") {
			$ft_price=$cubic_feet * $price;
			$estimated_price= number_format($ft_price, 2);
		}else if ($price_unit=="yd³") {
			$yd_price=$cubic_yard * $price;
			$estimated_price= number_format($yd_price, 2);
		}else if ($price_unit=="m³") {
			$m_price=$cubic_meter * $price;
			$estimated_price=number_format($m_price, 2);
		}
	}
	if(is_float($cubic_feet)){
		$cubic_feet=number_format($cubic_feet, 2);
	}
	$cubic_meter=number_format($cubic_meter, 2);
	$cubic_yard=number_format($cubic_yard, 2);
	$cubic_cm=number_format($cubic_cm, 2);
	$cubic_in=number_format($cubic_in, 2);
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


	// wallpaper calculator
	public function wallpaper($request)
	{
		//  dd($request->all());
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

		// Square Yards Calculator
	function square($request){
		
		$first = $request->input('first');
		$unit1 = $request->input('unit1');
		$second = $request->input('second');
		$unit2 = $request->input('unit2');
		$unit3 = $request->input('unit3');
		$third = $request->input('third');
		$currancy = $request->input('currancy');
		$unit3 = str_replace($currancy.' ','', $unit3);
		// dd($request->input());
		function con_cm($a,$b){
			if($a == "mm"){
				$centi = $b / 10;
			}elseif ($a == "cm"){
				$centi = $b * 1;
			}elseif ($a == "m"){
				$centi = $b / 100;
			}elseif ($a == "in"){
				$centi = $b * 2.54;
			}elseif ($a == "ft"){
				$centi = $b * 30.48;
			}elseif ($a == "yd"){
				$centi = $b * 91.44;
			}
			return $centi;
		}
		function con_cm_sq($a,$b){
			// dd($a,$b);
			if($a == "mm²"){
				$foot = $b / 10;
			}elseif ($a == "cm²"){
				$foot = $b * 1;
			}elseif ($a == "dm"){
				$foot = $b * 10;
			}elseif ($a == "m²"){
				$foot = $b * 100;
			}elseif ($a == "km²"){
				$foot = $b * 100000;
			}elseif ($a == "in²"){
				$foot = $b * 2.54;
			}elseif ($a == "ft²"){
				$foot = $b * 30.48;
			}elseif ($a == "yd²"){
				$foot = $b * 91.44;
			}elseif ($a == "a"){
				$foot = $b * 1000000;
			}elseif ($a == "da"){
				$foot = $b * 1000;
			}elseif ($a == "ha"){
				$foot = $b * 100000000;
			}elseif ($a == "ac"){
				$foot = $b * 40468564.224;
			}
			return $foot;
		}
		if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
			// dd($unit1,$first);
			$first = con_cm($unit1,$first);
			$second = con_cm($unit2,$second);
			$third = con_cm_sq($unit3,$third);
			$yd_ans = $first * $second;
			$price = $yd_ans * $third;
		}else{
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['yd_ans'] = $yd_ans;
		$this->param['price'] = $price;
		$this->param['RESULT'] = 1;
		return $this->param;
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

		function meterconvert($a,$b){
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
			}else{
				$convert = $a;
			}
			return $convert;
		}

		$length = meterconvert($length,$l_units);
		$width = meterconvert($width,$w_units);
		$side = meterconvert($side,$s_usits);
		
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
		} elseif ($volume_select === 2)  {
				if (is_numeric($price)) {
					$res =	pow($width,2);
					$cost =	$price * $res;
				} else {
					$res =	pow($width,2);
					$res =	$res * $quantity;
				}
		}elseif ($volume_select === 3) {
			if (is_numeric($length)) {
				if (is_numeric($price)) {
					$radi =	$length / 2;
					$res = (3.1416) * pow($radi,2);
					$cost =	$price * $res;
				} else {
					$radi =	$length / 2;
					$res = (3.1416) * pow($radi,2);
					$res =	$res * $quantity;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Inputs';
				return $this->param;
			}
		}else{
			if (is_numeric($length) && is_numeric($width) && is_numeric($side)) {
				if (is_numeric($price)) {
					$res =	0.25 * sqrt(($length+$width+$side)* (-$length+$width+$side) * ($length-$width+$side) * ($length+$width-$side));
					$cost =	$price * $res;
				} else {
					$res =	0.25 * sqrt(($length+$width+$side)* (-$length+$width+$side) * ($length-$width+$side) * ($length+$width-$side));
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


	// ROOM SIZE CALCULATOR
	public function room($request)
    {
		$submit = trim( $request->input( 'name' ));
		$lenght_f = $request->input( 'lenght_f' );
		$lenght_in = $request->input( 'lenght_in' );
		$width_f = $request->input( 'width_f' );
		$width_in = $request->input( 'width_in' );
		$perce = $request->input( 'perce' );
		$lenght_m = $request->input( 'lenght_m' );
		$width_m = $request->input( 'width_m' );
		if($submit == 'feet'){
			$length1=count($lenght_f);
			$width1=count($width_f);
			$lenght_foot = 0;
			$length_foot_val =0;
			$width_foot_val =0;
			$i=0;
			while($i<$length1 && $i<$width1){	
				if (($lenght_f[$i] === "" && $lenght_in[$i] === "" ) || ($width_f[$i] === "" && $width_in[$i] === "")) {
					$this->param['error'] ='Please! Check Your Input';
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
				if(is_numeric($lenght_f[$i]) && is_numeric($lenght_in[$i]) || is_numeric($width_f[$i]) && is_numeric($width_in[$i])){
					$length = $lenght_in[$i] / 12;
					$width = $width_in[$i] / 12;
					$length_foot_val  = $lenght_f[$i] + $length;
					$width_foot_val  = $width_f[$i] + $width;
					$lenght_foot +=  $length_foot_val * $width_foot_val;
				}else {
					$this->param['error'] ='Please! Check Your Input';
					return $this->param;
				}
				$i++;
			}
			$f_r_s = $lenght_foot;
			if($perce != 0 && $f_r_s != 0){
				$p = ($perce / 100) * $f_r_s;
				$perc = $f_r_s + $p;
				$this->param[ 'perc' ] = $perc; 
			}
			$this->param[ 'f_r_s' ] = $f_r_s;

		}else if($submit == 'meter'){
			$c_lenght_m=count($lenght_m);
			$c_width_m=count($width_m);
			$m_lenght_sum = 0;
			$m=0;
			while($m<$c_lenght_m && $m<$c_width_m){	
				if(is_numeric($lenght_m[$m]) && is_numeric($width_m[$m])):
					$m_lenght_sum += $lenght_m[$m] * $width_m[$m];

				else:
					$this->param['error'] ='Please! Check Your Input';
					return $this->param;
				endif;
				$m++;
			}
			
			$m_r_s = $m_lenght_sum;
			if($perce != 0 && $m_r_s != 0){
				$p = ($perce / 100) * $m_r_s;
				$perc = $m_r_s + $p;
				$this->param[ 'perc' ] = $perc; 
			}
			$this->param[ 'm_r_s' ] = $m_r_s;

		}
		$this->param[ 'submit' ] = $submit;
		$this->param[ 'perce' ] = $perce; 
		$this->param[ 'RESULT' ] = 1;

		return $this->param;
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

}
