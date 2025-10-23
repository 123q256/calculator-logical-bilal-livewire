<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GuzzleHttp\Client;
class Physics extends Model
{
	public $param;

	// Ohm's law calculator
	function ohms($request)
	{
	
		if (is_numeric($request->voltage) && is_numeric($request->current)) {
			if (empty($request->resistance) && empty($request->power)) {
				$voltage = $request->voltage;
				$current = $request->current;
				if ($request->unit_v === "KV") {
					$voltage = $voltage * 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage * 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current / 1000;
				}
				$resistance = round($voltage / $current, 5);
				$power = round($voltage * $current, 5);
				if ($request->unit_r === 'kΩ') {
					$resistance = $resistance * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power / 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage / 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage / 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current * 1000;
				}
				$this->param['voltage'] = ($voltage) . " " . $request->unit_v;
				$this->param['current'] = ($current) . " " . $request->unit_i;
				$this->param['resistance'] = ($resistance) . " " . $request->unit_r;
				$this->param['power'] = ($power) . " " . $request->unit_p;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please enter two values.';
				return $this->param;
			}
		} elseif (is_numeric($request->voltage) && is_numeric($request->resistance)) {
			if (empty($request->current) && empty($request->power)) {
				$voltage = $request->voltage;
				$resistance = $request->resistance;
				if ($request->unit_r === "kΩ") {
					$resistance = $resistance * 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage * 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage * 0.001;
				}
				$current = round($voltage / $resistance, 5);
				$power = round(pow($voltage, 2) / $resistance, 5);
				if ($request->unit_r === 'kΩ') {
					$resistance = $resistance * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power / 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage / 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage / 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current * 1000;
				}
				$this->param['voltage'] = ($voltage) . " " . $request->unit_v;
				$this->param['current'] = ($current) . " " . $request->unit_i;
				$this->param['resistance'] = ($resistance) . " " . $request->unit_r;
				$this->param['power'] = ($power) . " " . $request->unit_p;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please enter two values.';
				return $this->param;
			}
		} elseif (is_numeric($request->voltage) && is_numeric($request->power)) {
			if (empty($request->current) && empty($request->resistance)) {
				$voltage = $request->voltage;
				$power = $request->power;
				if ($request->unit_v === "KV") {
					$voltage = $voltage * 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power * 1000;
				}
				$current = round($power / $voltage, 5);
				$resistance = round($voltage / $current, 5);
				if ($request->unit_r === 'kΩ') {
					$resistance = $resistance * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power / 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage / 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage / 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current * 1000;
				}
				$this->param['voltage'] = ($voltage) . " " . $request->unit_v;
				$this->param['current'] = ($current) . " " . $request->unit_i;
				$this->param['resistance'] = ($resistance) . " " . $request->unit_r;
				$this->param['power'] = ($power) . " " . $request->unit_p;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please enter two values.';
				return $this->param;
			}
		} elseif (is_numeric($request->current) && is_numeric($request->resistance)) {
			if (empty($request->voltage) && empty($request->power)) {
				$resistance = $request->resistance;
				$current = $request->current;
				if ($request->unit_r === "kΩ") {
					$resistance = $resistance * 1000;
				}
				if ($request->unit_i === 'mA') {
					$current = $current / 1000;
				}
				$voltage = round($resistance * $current, 5);
				$power = round(pow($current, 2) * $resistance, 5);
				if ($request->unit_r === 'kΩ') {
					$resistance = $resistance * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power / 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage / 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage / 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current * 1000;
				}
				$this->param['voltage'] = ($voltage) . " " . $request->unit_v;
				$this->param['current'] = ($current) . " " . $request->unit_i;
				$this->param['resistance'] = ($resistance) . " " . $request->unit_r;
				$this->param['power'] = ($power) . " " . $request->unit_p;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please enter two values.';
				return $this->param;
			}
		} elseif (is_numeric($request->current) && is_numeric($request->power)) {
			if (empty($request->voltage) && empty($request->resistance)) {
				$power = $request->power;
				$current = $request->current;
				if ($request->unit_i === 'mA') {
					$current = $current / 1000;
				}
				if ($request->unit_p === 'kW') {
					$power = $power * 1000;
				}
				$voltage = round($power / $current, 5);
				$resistance = round($voltage / $current, 5);
				if ($request->unit_r === 'kΩ') {
					$resistance = $resistance * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power / 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage / 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage / 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current * 1000;
				}
				$this->param['voltage'] = ($voltage) . " " . $request->unit_v;
				$this->param['current'] = ($current) . " " . $request->unit_i;
				$this->param['resistance'] = ($resistance) . " " . $request->unit_r;
				$this->param['power'] = ($power) . " " . $request->unit_p;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please enter two values.';
				return $this->param;
			}
		} elseif (is_numeric($request->power) && is_numeric($request->resistance)) {
			if (empty($request->voltage) && empty($request->current)) {
				$resistance = $request->resistance;
				$power = $request->power;
				if ($request->unit_r === "kΩ") {
					$resistance = $resistance * 1000;
				}
				if ($request->unit_p === 'kW') {
					$power = $power * 1000;
				}
				$voltage = round(sqrt($resistance * $power), 5);
				$current = round($voltage / $resistance, 5);
				if ($request->unit_r === 'kΩ') {
					$resistance = $resistance * 0.001;
				}
				if ($request->unit_p === 'kW') {
					$power = $power / 1000;
				}
				if ($request->unit_v === "KV") {
					$voltage = $voltage / 1000;
				}
				if ($request->unit_v === "mV") {
					$voltage = $voltage / 0.001;
				}
				if ($request->unit_i === 'mA') {
					$current = $current * 1000;
				}
				$this->param['voltage'] = ($voltage) . " " . $request->unit_v;
				$this->param['current'] = ($current) . " " . $request->unit_i;
				$this->param['resistance'] = ($resistance) . " " . $request->unit_r;
				$this->param['power'] = ($power) . " " . $request->unit_p;
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please enter two values.';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please enter two values.';
			return $this->param;
		}
	}

	// cross product calculator
	function cross($request)
	{
		//  dd($request->all());
		if ($request->a_rep === 'coor') {
			if (is_numeric($request->ax) && is_numeric($request->ay) && is_numeric($request->az)) {
				$check = true;
			} else {
				$check = false;
			}
		} else {
			if (is_numeric($request->a1) && is_numeric($request->a2) && is_numeric($request->a3)  && is_numeric($request->b1)  && is_numeric($request->b2)  && is_numeric($request->b3)) {
				$check = true;
			} else {
				$check = false;
			}
		}
		if ($request->b_rep === 'coor') {
			if (is_numeric($request->bx) && is_numeric($request->by) && is_numeric($request->bz)) {
				$check = true;
			} else {
				$check = false;
			}
		} else {
			if (is_numeric($request->aa1) && is_numeric($request->aa2) && is_numeric($request->aa3)  && is_numeric($request->bb1)  && is_numeric($request->bb2)  && is_numeric($request->bb3)) {
				$check = true;
			} else {
				$check = false;
			}
		}
		if ($check === true) {
			$this->param['cross'] = "active";
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	// Average Velocity Calculator
	function ave_vel($request)
	{
		if (is_numeric($request->x) && is_numeric($request->y)) {
			$velocity_a = $request->x;
			if ($request->iv == 'ft/s') {
				$velocity_a = $velocity_a / 3.281;
			}
			if ($request->iv == 'km/h') {
				$velocity_a = $velocity_a / 3.6;
			}
			if ($request->iv == 'km/s') {
				$velocity_a = $velocity_a * 1000;
			}
			if ($request->iv == 'mi/s') {
				$velocity_a = $velocity_a * 1609.35;
			}
			if ($request->iv == 'mph') {
				$velocity_a = $velocity_a / 2.237;
			}
			$velocity_b = $request->y;
			if ($request->fv == 'ft/s') {
				$velocity_b = $velocity_b / 3.281;
			}
			if ($request->fv == 'km/h') {
				$velocity_b = $velocity_b / 3.6;
			}
			if ($request->fv == 'km/s') {
				$velocity_b = $velocity_b * 1000;
			}
			if ($request->fv == 'mi/s') {
				$velocity_b = $velocity_b * 1609.35;
			}
			if ($request->fv == 'mph') {
				$velocity_b = $velocity_b / 2.237;
			}
			if ($request->method == '1') {
				$iv = $request->x . ' ' . $request->iv;
				$fv = $request->y . ' ' . $request->fv;
				$ave = round(($velocity_a + $velocity_b) / 2, 5) . ' m/s';
			} elseif ($request->method == '2') {
				$ave = $request->x . ' ' . $request->iv;
				$fv = $request->y . ' ' . $request->fv;
				$iv = round(($velocity_a * 2) - $velocity_b, 5) . ' m/s';
			} elseif ($request->method == '3') {
				$ave = $request->x . ' ' . $request->iv;
				$iv = $request->y . ' ' . $request->fv;
				$fv = round(($velocity_a * 2) - $velocity_b, 5) . ' m/s';
			} elseif ($request->method == '4') {
				$iv = $request->x . ' ' . $request->iv;
				$fv = $request->y . ' ' . $request->fv;
				$ave = round((2 * $velocity_a * $velocity_b) / ($velocity_a + $velocity_b), 5) . ' m/s';
			}
			$this->param['iv'] = $iv;
			$this->param['fv'] = $fv;
			$this->param['ave'] = $ave;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}
	// Torque-calculator
	function torque($request)
	{
		// dd($request->all());
		if ($request->to == 1) {
			if (is_numeric($request->distance) && is_numeric($request->force) && is_numeric($request->angle)) {
				if (empty($request->torque)) {
					$dis = $request->distance;
					if ($request->dis_u == 'mm') {
						$dis = $dis / 1000;
					} elseif ($request->dis_u == 'cm') {
						$dis = $dis / 100;
					} elseif ($request->dis_u == 'km') {
						$dis = $dis * 1000;
					} elseif ($request->dis_u == 'ft') {
						$dis = $dis * 0.3048;
					} elseif ($request->dis_u == 'yd') {
						$dis = $dis * 0.9144;
					} elseif ($request->dis_u == 'in') {
						$dis = $dis / 39.37;
					}
					$force = $request->force;
					if ($request->for_u == 'kN') {
						$force = $force * 1000;
					} elseif ($request->for_u == 'MN') {
						$force = $force * 1000000;
					} elseif ($request->for_u == 'GN') {
						$force = $force * 1000000000;
					} elseif ($request->for_u == 'TN') {
						$force = $force * 1000000000000;
					}
					$angle = $request->angle;
					if ($request->ang_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->ang_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->ang_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->ang_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->ang_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->ang_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->ang_u == 'μrad') {
						$angle = $angle * 0.000001;
					}
					$tor = $dis * $force * sin($angle);
					if ($request->tor_u == 'kg-cm') {
						$tor = round($tor * 10.19716, 5);
					} elseif ($request->tor_u == 'J/rad' || $request->tor_u == 'Nm') {
						$tor = round($tor, 5);
					} elseif ($request->tor_u == 'ft-lb') {
						$tor = round($tor * 0.737562, 5);
					}
					$this->param['dis'] = $request->distance . ' ' . $request->dis_u;
					$this->param['force'] = $request->force . ' ' . $request->for_u;
					$this->param['angle'] = $request->angle . ' ' . $request->ang_u;
					$this->param['tor'] = $tor . ' ' . $request->tor_u;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any three values';
					return $this->param;
				}
			} elseif (is_numeric($request->torque) && is_numeric($request->force) && is_numeric($request->angle)) {
				if (empty($request->distance)) {
					$tor = $request->torque;
					if ($request->tor_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->tor_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}
					$force = $request->force;
					if ($request->for_u == 'kN') {
						$force = $force * 1000;
					} elseif ($request->for_u == 'MN') {
						$force = $force * 1000000;
					} elseif ($request->for_u == 'GN') {
						$force = $force * 1000000000;
					} elseif ($request->for_u == 'TN') {
						$force = $force * 1000000000000;
					}
					$angle = $request->angle;
					if ($request->ang_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->ang_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->ang_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->ang_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->ang_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->ang_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->ang_u == 'μrad') {
						$angle = $angle * 0.000001;
					}
					$dis = $tor / ($force * sin($angle));
					if ($request->dis_u == 'mm') {
						$dis = round($dis * 1000, 5);
					} elseif ($request->dis_u == 'cm') {
						$dis = round($dis * 100, 5);
					} elseif ($request->dis_u == 'km') {
						$dis = round($dis / 1000, 5);
					} elseif ($request->dis_u == 'ft') {
						$dis = round($dis / 0.3048, 5);
					} elseif ($request->dis_u == 'yd') {
						$dis = round($dis / 0.9144, 5);
					} elseif ($request->dis_u == 'in') {
						$dis = round($dis * 39.37, 5);
					}
					$this->param['tor'] = $request->torque . ' ' . $request->tor_u;
					$this->param['force'] = $request->force . ' ' . $request->for_u;
					$this->param['angle'] = $request->angle . ' ' . $request->ang_u;
					$this->param['dis'] = $dis . ' ' . $request->dis_u;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any three values';
					return $this->param;
				}
			} elseif (is_numeric($request->distance) && is_numeric($request->torque) && is_numeric($request->angle)) {
				if (empty($request->force)) {
					$dis = $request->distance;
					if ($request->dis_u == 'mm') {
						$dis = $dis / 1000;
					} elseif ($request->dis_u == 'cm') {
						$dis = $dis / 100;
					} elseif ($request->dis_u == 'km') {
						$dis = $dis * 1000;
					} elseif ($request->dis_u == 'ft') {
						$dis = $dis * 0.3048;
					} elseif ($request->dis_u == 'yd') {
						$dis = $dis * 0.9144;
					} elseif ($request->dis_u == 'in') {
						$dis = $dis / 39.37;
					}
					$tor = $request->torque;
					if ($request->tor_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->tor_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}
					$angle = $request->angle;
					if ($request->ang_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->ang_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->ang_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->ang_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->ang_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->ang_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->ang_u == 'μrad') {
						$angle = $angle * 0.000001;
					}
					$force = $tor / ($dis * sin($angle));
					if ($request->for_u == 'kN') {
						$force = round($force / 1000, 5);
					} elseif ($request->for_u == 'MN') {
						$force = round($force / 1000000, 7);
					} elseif ($request->for_u == 'GN') {
						$force = $force / 1000000000;
					} elseif ($request->for_u == 'TN') {
						$force = $force / 1000000000000;
					}
					$this->param['dis'] = $request->distance . ' ' . $request->dis_u;
					$this->param['force'] = $force . ' ' . $request->for_u;
					$this->param['angle'] = $request->angle . ' ' . $request->ang_u;
					$this->param['tor'] = $request->torque . ' ' . $request->tor_u;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any three values';
					return $this->param;
				}
			} elseif (is_numeric($request->distance) && is_numeric($request->torque) && is_numeric($request->force)) {
				if (empty($request->angle)) {
					$dis = $request->distance;
					if ($request->dis_u == 'mm') {
						$dis = $dis / 1000;
					} elseif ($request->dis_u == 'cm') {
						$dis = $dis / 100;
					} elseif ($request->dis_u == 'km') {
						$dis = $dis * 1000;
					} elseif ($request->dis_u == 'ft') {
						$dis = $dis * 0.3048;
					} elseif ($request->dis_u == 'yd') {
						$dis = $dis * 0.9144;
					} elseif ($request->dis_u == 'in') {
						$dis = $dis / 39.37;
					}
					$tor = $request->torque;
					if ($request->tor_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->tor_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}
					$force = $request->force;
					if ($request->for_u == 'kN') {
						$force = $force * 1000;
					} elseif ($request->for_u == 'MN') {
						$force = $force * 1000000;
					} elseif ($request->for_u == 'GN') {
						$force = $force * 1000000000;
					} elseif ($request->for_u == 'TN') {
						$force = $force * 1000000000000;
					}
					$angle = asin($tor / ($dis * $force));
					if ($request->ang_u == 'deg') {
						$angle = round(rad2deg($angle), 5);
					} elseif ($request->ang_u == 'gon') {
						$angle = $angle * 63.662;
					} elseif ($request->ang_u == 'tr') {
						$angle = $angle * 0.159155;
					} elseif ($request->ang_u == 'arcmin') {
						$angle = $angle * 3437.75;
					} elseif ($request->ang_u == 'arcsec') {
						$angle = $angle * 206265;
					} elseif ($request->ang_u == 'mrad') {
						$angle = $angle / 0.001;
					} elseif ($request->ang_u == 'μrad') {
						$angle = $angle * 1000000;
					}
					$this->param['dis'] = $request->distance . ' ' . $request->dis_u;
					$this->param['force'] = $request->force . ' ' . $request->for_u;
					$this->param['angle'] = $angle . ' ' . $request->ang_u;
					$this->param['tor'] = $request->torque . ' ' . $request->tor_u;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any three values';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! enter any three values';
				return $this->param;
			}
		} elseif ($request->to == 2) {
			if (is_numeric($request->loop) && is_numeric($request->angle_c) && is_numeric($request->current) && is_numeric($request->area) && is_numeric($request->mag)) {
				if (empty($request->tor)) {
					$angle = $request->angle_c;
					if ($request->angc_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->angc_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->angc_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->angc_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->angc_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->angc_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->angc_u == 'μrad') {
						$angle = $angle * 0.000001;
					}

					if ($request->cur_u == 'A') {
						$cur_u = '1@A';
					} else if ($request->cur_u == 'mA') {
						$cur_u = '0.001@mA';
					} else if ($request->cur_u == 'kA') {
						$cur_u = '1000@kA';
					} else if ($request->cur_u == 'μA') {
						$cur_u = '0.000001@μA';
					} else if ($request->cur_u == 'boit') {
						$cur_u = '10@boi';
					}

					if ($request->area_u == 'm²') {
						$area_u = '1@m²';
					} else if ($request->area_u == 'km²') {
						$area_u = '1000000@km²';
					} else if ($request->area_u == 'Mile²') {
						$area_u = '2589988.1103@Mile²';
					} else if ($request->area_u == 'ac') {
						$area_u = '4046.8564224@ac';
					} else if ($request->area_u == 'yd²') {
						$area_u = '0.83612735998838@yd²';
					} else if ($request->area_u == 'ft²') {
						$area_u = '0.0929030399987@ft²';
					} else if ($request->area_u == 'n²') {
						$area_u = '0.000645156@in²';
					} else if ($request->area_u == 'cm²') {
						$area_u = '0.0001@cm²';
					} else if ($request->area_u == 'mm²') {
						$area_u = '0.000001@mm²';
					}

					if ($request->mag_u == 'T') {
						$mag_u = '1@T';
					} else if ($request->mag_u == 'mT') {
						$mag_u = '0.001@mT';
					} else if ($request->mag_u == 'μT') {
						$mag_u = '0.000001@μT';
					}

					$loop = $request->loop;
					$cur_u = explode('@', $cur_u);
					
					$current = $request->current * floatval($cur_u[0]);
					
					$area_u = explode('@', $area_u);
					$area = $request->area * floatval($area_u[0]);
					$mag_u = explode('@', $request->mag_u);
					$mag = $request->mag * floatval($mag_u[0]);

					$tor=$loop*$current*$request->mag*$area*sin($angle);
					if ($_POST['torc_u']=='kg-cm') {
						$tor=round($tor*10.19716,5);
					}elseif ($_POST['torc_u']=='J/rad' || $_POST['torc_u']=='Nm') {
						$tor=round($tor,5);
					}elseif ($_POST['torc_u']=='ft-lb') {
						$tor=round($tor*0.737562,5);
					}
				
					$this->param['tor'] = $tor . ' ' . $request->torc_u;
					$this->param['loop'] = $loop;
					$this->param['angle'] = $request->angle_c . ' ' . $request->angc_u;
					$this->param['area'] = $request->area . ' ' . $area_u[1];
					$this->param['mag'] = $request->mag . ' ' . $mag_u[0];
					$this->param['current'] = $request->current . ' ' . $cur_u[1];
					$this->param['RESULT'] = 1;
					
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any five values';
					return $this->param;
				}
			} elseif (is_numeric($request->tor) && is_numeric($request->angle_c) && is_numeric($request->current) && is_numeric($request->area) && is_numeric($request->mag)) {
				if (empty($request->loop)) {
					$angle = $request->angle_c;
					if ($request->angc_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->angc_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->angc_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->angc_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->angc_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->angc_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->angc_u == 'μrad') {
						$angle = $angle * 0.000001;
					}
					$tor = $request->tor;
					if ($request->torc_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->torc_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}

					if ($request->cur_u == 'A') {
						$cur_u = '1@A';
					} else if ($request->cur_u == 'mA') {
						$cur_u = '0.001@mA';
					} else if ($request->cur_u == 'kA') {
						$cur_u = '1000@kA';
					} else if ($request->cur_u == 'μA') {
						$cur_u = '0.000001@μA';
					} else if ($request->cur_u == 'boit') {
						$cur_u = '10@boi';
					}

					if ($request->area_u == 'm²') {
						$area_u = '1@m²';
					} else if ($request->area_u == 'km²') {
						$area_u = '1000000@km²';
					} else if ($request->area_u == 'Mile²') {
						$area_u = '2589988.1103@Mile²';
					} else if ($request->area_u == 'ac') {
						$area_u = '4046.8564224@ac';
					} else if ($request->area_u == 'yd²') {
						$area_u = '0.83612735998838@yd²';
					} else if ($request->area_u == 'ft²') {
						$area_u = '0.0929030399987@ft²';
					} else if ($request->area_u == 'n²') {
						$area_u = '0.000645156@in²';
					} else if ($request->area_u == 'cm²') {
						$area_u = '0.0001@cm²';
					} else if ($request->area_u == 'mm²') {
						$area_u = '0.000001@mm²';
					}

					if ($request->mag_u == 'T') {
						$mag_u = '1@T';
					} else if ($request->mag_u == 'mT') {
						$mag_u = '0.001@mT';
					} else if ($request->mag_u == 'μT') {
						$mag_u = '0.000001@μT';
					}

					$cur_u = explode('@', $cur_u);
					$current = $request->current * $cur_u[0];
					$area_u = explode('@', $area_u);
					$area = $request->area * $area_u[0];
					$mag_u = explode('@', $mag_u);

					$mag = $request->mag * $mag_u[0];
					$loop = round($tor / ($current * $mag * $area * sin($angle)), 6);
					$this->param['tor'] = $request->tor . ' ' . $request->torc_u;
					$this->param['loop'] = $loop;
					$this->param['angle'] = $request->angle_c . ' ' . $request->angc_u;
					$this->param['area'] = $request->area . ' ' . $area_u[1];
					$this->param['mag'] = $request->mag . ' ' . $mag_u[0];
					$this->param['current'] = $request->current . ' ' . $cur_u[1];
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any five values';
					return $this->param;
				}
			} elseif (is_numeric($request->loop) && is_numeric($request->angle_c) && is_numeric($request->tor) && is_numeric($request->area) && is_numeric($request->mag)) {
				if (empty($request->current)) {
					$angle = $request->angle_c;
					if ($request->angc_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->angc_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->angc_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->angc_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->angc_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->angc_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->angc_u == 'μrad') {
						$angle = $angle * 0.000001;
					}
					$loop = $request->loop;
					$tor = $request->tor;
					if ($request->torc_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->torc_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}




					if ($request->cur_u == 'A') {
						$cur_u = '1@A';
					} else if ($request->cur_u == 'mA') {
						$cur_u = '0.001@mA';
					} else if ($request->cur_u == 'kA') {
						$cur_u = '1000@kA';
					} else if ($request->cur_u == 'μA') {
						$cur_u = '0.000001@μA';
					} else if ($request->cur_u == 'boit') {
						$cur_u = '10@boi';
					}

					if ($request->area_u == 'm²') {
						$area_u = '1@m²';
					} else if ($request->area_u == 'km²') {
						$area_u = '1000000@km²';
					} else if ($request->area_u == 'Mile²') {
						$area_u = '2589988.1103@Mile²';
					} else if ($request->area_u == 'ac') {
						$area_u = '4046.8564224@ac';
					} else if ($request->area_u == 'yd²') {
						$area_u = '0.83612735998838@yd²';
					} else if ($request->area_u == 'ft²') {
						$area_u = '0.0929030399987@ft²';
					} else if ($request->area_u == 'n²') {
						$area_u = '0.000645156@in²';
					} else if ($request->area_u == 'cm²') {
						$area_u = '0.0001@cm²';
					} else if ($request->area_u == 'mm²') {
						$area_u = '0.000001@mm²';
					}

					if ($request->mag_u == 'T') {
						$mag_u = '1@T';
					} else if ($request->mag_u == 'mT') {
						$mag_u = '0.001@mT';
					} else if ($request->mag_u == 'μT') {
						$mag_u = '0.000001@μT';
					}



					$area_u = explode('@', $area_u);
					$area = $request->area * $area_u[0];
					$mag_u = explode('@', $mag_u);
					$mag = $request->mag * $mag_u[0];
					$current = $tor / ($loop * $mag * $area * sin($angle));
					$cur_u = explode('@', $cur_u);
					$current = round($current / $cur_u[0], 7);
					$this->param['tor'] = $request->tor . ' ' . $request->torc_u;
					$this->param['loop'] = $loop;
					$this->param['angle'] = $request->angle_c . ' ' . $request->angc_u;
					$this->param['area'] = $request->area . ' ' . $area_u[1];
					$this->param['mag'] = $request->mag . ' ' . $mag_u[0];
					$this->param['current'] = $current . ' ' . $cur_u[1];
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any five values';
					return $this->param;
				}
			} elseif (is_numeric($request->loop) && is_numeric($request->angle_c) && is_numeric($request->current) && is_numeric($request->tor) && is_numeric($request->mag)) {
				if (empty($request->area)) {
					$angle = $request->angle_c;
					if ($request->angc_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->angc_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->angc_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->angc_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->angc_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->angc_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->angc_u == 'μrad') {
						$angle = $angle * 0.000001;
					}

					if ($request->cur_u == 'A') {
						$cur_u = '1@A';
					} else if ($request->cur_u == 'mA') {
						$cur_u = '0.001@mA';
					} else if ($request->cur_u == 'kA') {
						$cur_u = '1000@kA';
					} else if ($request->cur_u == 'μA') {
						$cur_u = '0.000001@μA';
					} else if ($request->cur_u == 'boit') {
						$cur_u = '10@boi';
					}

					if ($request->area_u == 'm²') {
						$area_u = '1@m²';
					} else if ($request->area_u == 'km²') {
						$area_u = '1000000@km²';
					} else if ($request->area_u == 'Mile²') {
						$area_u = '2589988.1103@Mile²';
					} else if ($request->area_u == 'ac') {
						$area_u = '4046.8564224@ac';
					} else if ($request->area_u == 'yd²') {
						$area_u = '0.83612735998838@yd²';
					} else if ($request->area_u == 'ft²') {
						$area_u = '0.0929030399987@ft²';
					} else if ($request->area_u == 'n²') {
						$area_u = '0.000645156@in²';
					} else if ($request->area_u == 'cm²') {
						$area_u = '0.0001@cm²';
					} else if ($request->area_u == 'mm²') {
						$area_u = '0.000001@mm²';
					}

					if ($request->mag_u == 'T') {
						$mag_u = '1@T';
					} else if ($request->mag_u == 'mT') {
						$mag_u = '0.001@mT';
					} else if ($request->mag_u == 'μT') {
						$mag_u = '0.000001@μT';
					}



					$loop = $request->loop;
					$cur_u = explode('@', $cur_u);
					$current = $request->current * $cur_u[0];
					$tor = $request->tor;
					if ($request->torc_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->torc_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}
					$mag_u = explode('@', $mag_u);
					$mag = $request->mag * $mag_u[0];
					$area = $tor / ($loop * $current * $mag * sin($angle));
					$area_u = explode('@', $request->area_u);
					$area = round($area / $area_u[0], 7);
					$this->param['tor'] = $request->tor . ' ' . $request->torc_u;
					$this->param['loop'] = $loop;
					$this->param['angle'] = $request->angle_c . ' ' . $request->angc_u;
					$this->param['area'] = $area . ' ' . $area_u[1];
					$this->param['mag'] = $request->mag . ' ' . $mag_u[0];
					$this->param['current'] = $request->current . ' ' . $cur_u[1];
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any five values';
					return $this->param;
				}
			} elseif (is_numeric($request->loop) && is_numeric($request->angle_c) && is_numeric($request->current) && is_numeric($request->area) && is_numeric($request->tor)) {
				if (empty($request->mag)) {
					$angle = $request->angle_c;
					if ($request->angc_u == 'deg') {
						$angle = deg2rad($angle);
					} elseif ($request->angc_u == 'gon') {
						$angle = $angle * 0.01570796;
					} elseif ($request->angc_u == 'tr') {
						$angle = $angle * 6.28319;
					} elseif ($request->angc_u == 'arcmin') {
						$angle = $angle * 0.000290888;
					} elseif ($request->angc_u == 'arcsec') {
						$angle = $angle * 0.00000484814;
					} elseif ($request->angc_u == 'mrad') {
						$angle = $angle * 0.001;
					} elseif ($request->angc_u == 'μrad') {
						$angle = $angle * 0.000001;
					}
					$loop = $request->loop;
					$tor = $request->tor;
					if ($request->torc_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->torc_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}

					if ($request->cur_u == 'A') {
						$cur_u = '1@A';
					} else if ($request->cur_u == 'mA') {
						$cur_u = '0.001@mA';
					} else if ($request->cur_u == 'kA') {
						$cur_u = '1000@kA';
					} else if ($request->cur_u == 'μA') {
						$cur_u = '0.000001@μA';
					} else if ($request->cur_u == 'boit') {
						$cur_u = '10@boi';
					}

					if ($request->area_u == 'm²') {
						$area_u = '1@m²';
					} else if ($request->area_u == 'km²') {
						$area_u = '1000000@km²';
					} else if ($request->area_u == 'Mile²') {
						$area_u = '2589988.1103@Mile²';
					} else if ($request->area_u == 'ac') {
						$area_u = '4046.8564224@ac';
					} else if ($request->area_u == 'yd²') {
						$area_u = '0.83612735998838@yd²';
					} else if ($request->area_u == 'ft²') {
						$area_u = '0.0929030399987@ft²';
					} else if ($request->area_u == 'n²') {
						$area_u = '0.000645156@in²';
					} else if ($request->area_u == 'cm²') {
						$area_u = '0.0001@cm²';
					} else if ($request->area_u == 'mm²') {
						$area_u = '0.000001@mm²';
					}

					if ($request->mag_u == 'T') {
						$mag_u = '1@T';
					} else if ($request->mag_u == 'mT') {
						$mag_u = '0.001@mT';
					} else if ($request->mag_u == 'μT') {
						$mag_u = '0.000001@μT';
					}



					$cur_u = explode('@', $cur_u);
					$current = $request->current * $cur_u[0];
					$area_u = explode('@', $area_u);
					$area = $request->area * $area_u[0];
					$mag = $tor / ($loop * $current * $area * sin($angle));
					$mag_u = explode('@', $mag_u);
					// $mag=round($mag/$mag_u[0],7);
					$this->param['tor'] = $request->tor . ' ' . $request->torc_u;
					$this->param['loop'] = $loop;
					$this->param['angle'] = $request->angle_c . ' ' . $request->angc_u;
					$this->param['area'] = $request->area . ' ' . $area_u[1];
					$this->param['mag'] = $mag . ' ' . $mag_u[1];
					$this->param['current'] = $request->current . ' ' . $cur_u[1];
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any five values';
					return $this->param;
				}
			} elseif (is_numeric($request->loop) && is_numeric($request->tor) && is_numeric($request->current) && is_numeric($request->area) && is_numeric($request->mag)) {
				if (empty($request->angle_c)) {
					$tor = $request->tor;
					if ($request->torc_u == 'kg-cm') {
						$tor = $tor / 10.19716;
					} elseif ($request->torc_u == 'ft-lb') {
						$tor = $tor / 0.737562;
					}
					$loop = $request->loop;
					$cur_u = explode('@', $request->cur_u);
					$current = $request->current * $cur_u[0];
					$area_u = explode('@', $request->area_u);
					$area = $request->area * $area_u[0];
					$mag_u = explode('@', $request->mag_u);
					$mag = $request->mag * $mag_u[0];
					$angle = asin($tor / ($loop * $current * $mag * $area));
					if ($request->angc_u == 'deg') {
						$angle = round(rad2deg($angle), 5);
					} elseif ($request->angc_u == 'gon') {
						$angle = $angle * 63.662;
					} elseif ($request->angc_u == 'tr') {
						$angle = $angle * 0.159155;
					} elseif ($request->angc_u == 'arcmin') {
						$angle = $angle * 3437.75;
					} elseif ($request->angc_u == 'arcsec') {
						$angle = $angle * 206265;
					} elseif ($request->angc_u == 'mrad') {
						$angle = $angle / 0.001;
					} elseif ($request->angc_u == 'μrad') {
						$angle = $angle * 1000000;
					}
					$this->param['tor'] = $request->tor . ' ' . $request->torc_u;
					$this->param['loop'] = $loop;
					$this->param['angle'] = $angle . ' ' . $request->angc_u;
					$this->param['area'] = $request->area . ' ' . $area_u[1];
					$this->param['mag'] = $request->mag . ' ' . $mag_u[1];
					$this->param['current'] = $request->current . ' ' . $cur_u[1];
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! enter any five values';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! enter any five values';
				return $this->param;
			}
		} elseif ($request->to == 3) {
			if (is_numeric($request->ax) && is_numeric($request->ay) && is_numeric($request->az) && is_numeric($request->bx) && is_numeric($request->by) && is_numeric($request->bz)) {
				$ax = $request->ax;
				$ay = $request->ay;
				$az = $request->az;
				$bx = $request->bx;
				$by = $request->by;
				$bz = $request->bz;
				$ans_a1 = ($ay * $bz) - ($by * $az);
				$ans_a2 = (($ax * $bz) - ($bx * $az)) * (-1);
				$ans_a3 = ($ax * $by) - ($bx * $ay);
				$ans = $ans_a1 . 'i ' . (($ans_a2 < 0) ? $ans_a2 : "+" . $ans_a2) . 'j ' . (($ans_a3 < 0) ? $ans_a3 : "+" . $ans_a3) . 'k ';
				$this->param['ans'] = $ans;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Distance Vector & Force Vector';
				return $this->param;
			}
		}
	}

	// Horsepower Calculator
	function horsepower($request)
	{
		
		if ($request->method == 1) {
			if (is_numeric($request->weight) && is_numeric($request->time)) {
				$weight = $request->weight;
				if ($request->unit_w == 'kg') {
					$weight = $weight * 2.2046;
				}
				$time = $request->time;
				if ($request->unit_t == 'min') {
					$time = $time * 60;
				} elseif ($request->unit_t == 'h') {
					$time = $time * 60 * 60;
				}
				$hp = $weight / pow(($time / 5.825), 3);
				$value_exp = explode(".", $hp);
				$hpm = floatval($value_exp[0] . '.' . substr($value_exp[1], 0, 1));
				$hpmet = round($hpm * 1.01387, 1);
				$hpkw = round(($hpm * 0.746), 1);
				$hpw = round(($hpm * 746), 1);
				$this->param['hpm'] = $hpm;
				$this->param['hpmet'] = $hpmet;
				$this->param['hpkw'] = $hpkw;
				$this->param['hpw'] = $hpw;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! fill all fields';
				return $this->param;
			}
		} elseif ($request->method == 2) {
			if (is_numeric($request->weight) && is_numeric($request->speed)) {
				$weight = $request->weight;
				if ($request->unit_w == 'kg') {
					$weight = $weight * 2.2046;
				}
				$speed = $request->speed;
				if ($request->unit_s == 'km/h') {
					$speed = $speed / 0.621371;
				} elseif ($request->unit_s == 'km/s') {
					$speed = $speed * 2236.94;
				} elseif ($request->unit_s == 'm/s') {
					$speed = $speed * 2.237;
				}
				$hp = $weight * pow(($speed / 234), 3);
				$value_exp = explode(".", $hp);
				$hpm = floatval($value_exp[0] . '.' . substr($value_exp[1], 0, 1));
				$hpmet = round($hpm * 1.01387, 1);
				$hpkw = round(($hpm * 0.746), 1);
				$hpw = round(($hpm * 746), 1);
				$this->param['hpm'] = $hpm;
				$this->param['hpmet'] = $hpmet;
				$this->param['hpkw'] = $hpkw;
				$this->param['hpw'] = $hpw;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! fill all fields';
				return $this->param;
			}
		} elseif ($request->method == 4) {
			if (is_numeric($request->force) && is_numeric($request->distance) && is_numeric($request->btime)) {
				$force = $request->force;
				$dis = $request->distance;
				$time = $request->btime;
				if ($request->dis_u == 'mm') {
					$dis = $dis / 1000;
				} elseif ($request->dis_u == 'cm') {
					$dis = $dis / 100;
				} elseif ($request->dis_u == 'km') {
					$dis = $dis * 1000;
				} elseif ($request->dis_u == 'ft') {
					$dis = $dis * 0.3048;
				} elseif ($request->dis_u == 'yd') {
					$dis = $dis * 0.9144;
				}
				if ($request->for_u == 'kN') {
					$force = $force * 1000;
				} elseif ($request->for_u == 'MN') {
					$force = $force * 1000000;
				} elseif ($request->for_u == 'GN') {
					$force = $force * 1000000000;
				} elseif ($request->for_u == 'TN') {
					$force = $force * 1000000000000;
				}
				$hp = $force * ($dis / $time);
				$this->param['hp'] = $hp;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! fill all fields';
				return $this->param;
			}
		} elseif ($request->method == 3) {
			if ($request->to == 1) {
				if (is_numeric($request->rpm) && is_numeric($request->tor)) {
					$rpm = $request->rpm;
					$tor = $request->tor;
					$hp = ($rpm * $tor) / 5252;
					$value_exp = explode(".", $hp);

					// Check if $value_exp has a decimal part
					if (isset($value_exp[1])) {
						$hpm = floatval($value_exp[0] . '.' . substr($value_exp[1], 0, 2));
					} else {
						// If no decimal part, just use the integer part
						$hpm = floatval($value_exp[0]);
					}

					$hpmet = round($hpm * 1.01387, 1);
					$hpkw = round(($hpm * 0.746), 1);
					$hpw = round(($hpm * 746), 1);
					$this->param['hpm'] = $hpm;
					$this->param['hpmet'] = $hpmet;
					$this->param['hpkw'] = $hpkw;
					$this->param['hpw'] = $hpw;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! fill all fields';
					return $this->param;
				}
			} elseif ($request->to == 2) {
				if (is_numeric($request->rpm) && is_numeric($request->hors)) {
					$rpm = $request->rpm;
					$hp = $request->hors;
					$tor = round(($hp * 5252) / $rpm, 4);
					$this->param['tor'] = number_format($tor, 4);
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! fill all fields';
					return $this->param;
				}
			}
		}
	}

	// photon energy calculator
	function photon($request)
	{
		$put_input['wave']=$request->wave;
		$put_input['freq']=$request->freq;
		date_default_timezone_set('Asia/Karachi');
		$put_input['time']=date('j-m-Y, H:i:s');
		$save_input[]=$put_input;
		
			if (is_numeric($request->wave)) {
				$wave=$request->wave;
				if ($request->unit_w=='Å') {
					$wave=$wave/1e+10;
				}elseif ($request->unit_w=='nm') {
					$wave=$wave/1e+9;
				}elseif ($request->unit_w=='mm') {
					$wave=$wave/1000;
				}elseif ($request->unit_w=='km') {
					$wave=$wave*1000;
				}elseif ($request->unit_w=='μm') {
					$wave=$wave/1000000;
				}
				$energy= ((6.6260695729 * pow(10, -34)) * (2.99792458 * pow(10, 8)))/$wave;
				$en= ((6.6260695729 * pow(10, -34)) * (2.99792458 * pow(10, 8)))/$wave;
				$frequency=round($energy/(6.6260695729 * pow(10, -34)),3);
				$energy_=explode('E', $energy);
				if (count($energy_)>1) {
					$energy=round($energy_[0],4)." x 10<sup>".$energy_[1]."</sup>";
				}
				$this->param['energy'] = $energy;
				$this->param['en'] = $en;
				$this->param['frequency'] = $frequency;
				$this->param['RESULT'] = 1;
				return $this->param;
			}elseif (is_numeric($request->freq)) {
				$freq=$request->freq;
				if($request->unit_f=='kHz'){
					$freq=$freq*1000;
				}elseif($request->unit_f=='MHz'){
					$freq=$freq*1000000;
				}elseif($request->unit_f=='GHz'){
					$freq=$freq*1e+9;
				}elseif($request->unit_f=='THz'){
					$freq=$freq*1e+12;
				}elseif($request->unit_f=='RPM'){
					$freq=$freq/60;
				}
				$energy=(6.6260695729 * pow(10, -34))*$freq;
				$wave= round(((6.6260695729 * pow(10, -34)) * (2.99792458 * pow(10, 8)))/$energy,3);
				$en=(6.6260695729 * pow(10, -34))*$freq;
				$energy_=explode('E', $energy);
				if (count($energy_)>1) {
					$energy=round($energy_[0],4)." x 10^".$energy_[1];
				}
				$this->param['energy'] = $energy;
				$this->param['en'] = $en;
				$this->param['wave'] = $wave;
				$this->param['RESULT'] = 1;
				return $this->param;
			}else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}


	}
	// Dimensional Analysis Calculator
	public function dimensional($request)
	{
		$pq1 = $request->pq1;
		$pq1_unit = $request->pq1_unit;
		$pq2 = $request->pq2;
		$pq2_unit = $request->pq2_unit;

		if ($pq1_unit == 'mm') {
			$pq1_unit = '1.0E+34@1';
		} elseif ($pq1_unit == 'cm') {
			$pq1_unit = '1.0E+33@2';
		} elseif ($pq1_unit == 'm') {
			$pq1_unit = '1.0E+31@5';
		} elseif ($pq1_unit == 'km') {
			$pq1_unit = '1.0E+28@8';
		} elseif ($pq1_unit == 'in') {
			$pq1_unit = '3.9370078740157E+32@3';
		} elseif ($pq1_unit == 'ft') {
			$pq1_unit = '3.2808398950131E+31@4';
		} elseif ($pq1_unit == 'yd') {
			$pq1_unit = '1.0936132983377E+31@6';
		} elseif ($pq1_unit == 'mi') {
			$pq1_unit = '6.2136994949495E+27@9';
		} elseif ($pq1_unit == 'fur') {
			$pq1_unit = '4.9709595959596E+28@7';
		}

		if ($pq2_unit == 'mm') {
			$pq2_unit = '1.0E+34@1';
		} elseif ($pq2_unit == 'cm') {
			$pq2_unit = '1.0E+33@2';
		} elseif ($pq2_unit == 'm') {
			$pq2_unit = '1.0E+31@5';
		} elseif ($pq2_unit == 'km') {
			$pq2_unit = '1.0E+28@8';
		} elseif ($pq2_unit == 'in') {
			$pq2_unit = '3.9370078740157E+32@3';
		} elseif ($pq2_unit == 'ft') {
			$pq2_unit = '3.2808398950131E+31@4';
		} elseif ($pq2_unit == 'yd') {
			$pq2_unit = '1.0936132983377E+31@6';
		} elseif ($pq2_unit == 'mi') {
			$pq2_unit = '6.2136994949495E+27@9';
		} elseif ($pq2_unit == 'fur') {
			$pq2_unit = '4.9709595959596E+28@7';
		}


		if (is_numeric($pq1) && !empty($pq1_unit) && is_numeric($pq2) && !empty($pq2_unit)) {

			$put_input['pq1'] = $pq1;
			$put_input['pq1_unit'] = $pq1_unit;
			$put_input['pq2'] = $pq2;
			$put_input['pq2_unit'] = $pq2_unit;
			date_default_timezone_set('Asia/Karachi');
			$put_input['time'] = date('j-m-Y, H:i:s');
			$save_input[] = $put_input;

			if (is_numeric($pq1) && is_numeric($pq2)) {
				function gcd($a, $b)
				{
					$a = abs($a);
					$b = abs($b);
					if ($a < $b) {
						list($b, $a) = array($a, $b);
					}
					if ($b == 0) {
						return 1;
					}
					$r = $a % $b;
					while ($r > 0) :
						$a = $b;
						$b = $r;
						$r = $a % $b;
					endwhile;
					return $b;
				}
				function reduce($num, $den)
				{
					$g = gcd($num, $den);
					return array($num / $g, $den / $g);
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
				$pq1_unit = preg_replace('/plus/', '+', $pq1_unit);
				$pq2_unit = preg_replace('/plus/', '+', $pq2_unit);
				$pq1_exp = explode('@', $pq1_unit);
				$pq2_exp = explode('@', $pq2_unit);
				if ($pq1_unit === $pq2_unit) {
					list($upr, $btm) = reduce($pq1, $pq2);
					$this->param['check'] = 'check';
				} elseif ($pq1_exp[1] > $pq2_exp[1]) {
					$cnvrt = $pq2_exp[0] / ($pq1_exp[0] / $pq1);
					list($upr, $btm) = reduce($cnvrt, $pq2);
					$this->param['cnvrt1'] = sigFig($cnvrt, 8);
				} else {
					$cnvrt = $pq1_exp[0] / ($pq2_exp[0] / $pq2);
					list($upr, $btm) = reduce($pq1, $cnvrt);
					$this->param['cnvrt2'] = sigFig($cnvrt, 8);
				}
				$res = $upr / $btm;
				$res1 = $btm / $upr;
				$this->param['upr'] = sigFig($upr, 8);
				$this->param['btm'] = sigFig($btm, 8);
				$this->param['res'] = sigFig($res, 8);
				$this->param['res1'] = sigFig($res1, 8);
				$this->param['pq1'] = sigFig($pq1, 8);
				$this->param['pq2'] = sigFig($pq2, 8);
				$this->param['upr'] = sigFig($upr, 8);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	// Projectile Motion Calculator
	public function projectile($request)
	{
		$method = trim($request->method);
		$a = trim($request->a);
		$a_unit = trim($request->a_unit);
		$h = trim($request->h);
		$h_unit = trim($request->h_unit);
		$v = trim($request->v);
		$v_unit = trim($request->v_unit);
		$g = trim($request->g);
		$g_unit = trim($request->g_unit);
		$t = trim($request->t);
		$t_unit = trim($request->t_unit);


		if (is_numeric($a) && is_numeric($h) && is_numeric($v) && is_numeric($g)  &&  !empty($a_unit) && !empty($h_unit) && !empty($v_unit) && !empty($g_unit)) {
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
			if (is_numeric($h)) {
				if ($h_unit === 'cm') {
					$h = $h / 100;
				} elseif ($h_unit === 'km') {
					$h = $h / 0.001;
				} elseif ($h_unit === 'in') {
					$h = $h / 39.37;
				} elseif ($h_unit === 'ft') {
					$h = $h / 3.281;
				} elseif ($h_unit === 'yd') {
					$h = $h / 1.0936;
				} elseif ($h_unit === 'mi') {
					$h = $h / 0.0006214;
				}
			}
			if (is_numeric($v)) {
				if ($v_unit === 'kmh') {
					$v = $v / 3.6;
				} elseif ($v_unit === 'fts') {
					$v = $v / 3.28;
				} elseif ($v_unit === 'mph') {
					$v = $v / 2.237;
				}
			}
			if (is_numeric($t)) {
				if ($t_unit === 'min') {
					$t = $t * 60;
				} elseif ($t_unit === 'hrs') {
					$t = $t * 3600;
				}
			}
			if ($a_unit === 'deg') {
				$vx = $v * cos(deg2rad($a));
				$vy = $v * sin(deg2rad($a));
			} else {
				$vx = $v * cos($a);
				$vy = $v * sin($a);
			}
			if (is_numeric($g)) {
				if ($g_unit === 'g') {
					$g = $g * 9.807;
				}
			}
			if ($method === 'tof') {
				if ($h == 0) {
					$tof = 2 * $vy / $g;
				} else {
					$tof = ($vy + (sqrt(pow($vy, 2) + 2 * $g * $h))) / $g;
				}
				$this->param['check'] = 'tof';
				$this->param['tof'] = sigFig($tof, 4);
			} elseif ($method === 'range') {
				if ($h == 0) {
					$r = 2 * $vx * $vy / $g;
				} else {
					$r = $vx * (($vy + (sqrt(pow($vy, 2) + 2 * $g * $h))) / $g);
				}
				$this->param['check'] = 'range';
				$this->param['r'] = sigFig($r, 4);
			} elseif ($method === 'mh') {
				if ($h == 0) {
					$hmax = pow($vy, 2) / (2 * $g);
				} else {
					$hmax = $h + pow($vy, 2) / (2 * $g);
				}
				$this->param['check'] = 'mh';
				$this->param['hmax'] = sigFig($hmax, 4);
			} elseif ($method === 'fp' && is_numeric($t)) {
				$x = $vx * $t;
				$y = $h + $vy * $t - $g * pow($t, 2) / 2;
				$hv = $vx;
				$vv = $vy - $g * $t;
				$vel = sqrt(pow($hv, 2) + pow($vv, 2));
				// echo $vv;die;
				$this->param['check'] = 'fp';
				$this->param['x'] = sigFig($x, 4);
				$this->param['y'] = sigFig($y, 4);
				$this->param['hv'] = sigFig($hv, 4);
				$this->param['vv'] = sigFig($vv, 4);
				$this->param['vel'] = sigFig($vel, 4);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['g'] = sigFig($g, 4);
			$this->param['vx'] = sigFig($vx, 4);
			$this->param['vy'] = sigFig($vy, 4);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}
	//  water viscosity Calculator
	function water($request)
	{
		$temp = $request->temp;
		$unit = $request->unit;

		if (is_numeric($temp)) {
			if ($unit == 'f') {
				$temp = ($temp - 32) * 5 / 9;
			} elseif ($unit == 'k') {
				$temp = $temp - 273.15;
			}
			if ($temp < 0 || $temp > 370) {
				$this->param['error'] = 'This calculator only works up to 698°F or 370°C.';
				return $this->param;
			}
			if ($temp >= 0 && $temp <= 2) {
				$ans = (1.7880 + ($temp - 0) * -0.05725);
			} else if ($temp > 2 && $temp <= 3) {
				$ans = (1.6735 + ($temp - 2) * -0.05450);
			} else if ($temp > 3 && $temp <= 4) {
				$ans = (1.6190 + ($temp - 3) * -0.05170);
			} else if ($temp > 4 && $temp <= 5) {
				$ans = (1.5673 + ($temp - 4) * -0.04909);
			} else if ($temp > 5 && $temp <= 6) {
				$ans = (1.5182 + ($temp - 5) * -0.04670);
			} else if ($temp > 6 && $temp <= 7) {
				$ans = (1.4715 + ($temp - 6) * -0.04440);
			} else if ($temp > 7 && $temp <= 8) {
				$ans = (1.4271 + ($temp - 7) * -0.04240);
			} else if ($temp > 8 && $temp <= 9) {
				$ans = (1.3847 + ($temp - 8) * -0.04030);
			} else if ($temp > 9 && $temp <= 10) {
				$ans = (1.3444 + ($temp - 9) * -0.03850);
			} else if ($temp > 10 && $temp <= 11) {
				$ans = (1.3059 + ($temp - 10) * -0.03670);
			} else if ($temp > 11 && $temp <= 12) {
				$ans = (1.2692 + ($temp - 11) * -0.03520);
			} else if ($temp > 12 && $temp <= 13) {
				$ans = (1.2340 + ($temp - 12) * -0.03350);
			} else if ($temp > 13 && $temp <= 14) {
				$ans = (1.2005 + ($temp - 13) * -0.03220);
			} else if ($temp > 14 && $temp <= 15) {
				$ans = (1.1683 + ($temp - 14) * -0.03080);
			} else if ($temp > 15 && $temp <= 16) {
				$ans = (1.1375 + ($temp - 15) * -0.02940);
			} else if ($temp > 16 && $temp <= 17) {
				$ans = (1.1081 + ($temp - 16) * -0.02830);
			} else if ($temp > 17 && $temp <= 18) {
				$ans = (1.0798 + ($temp - 17) * -0.02720);
			} else if ($temp > 18 && $temp <= 19) {
				$ans = (1.0526 + ($temp - 18) * -0.02600);
			} else if ($temp > 19 && $temp <= 20) {
				$ans = (1.0266 + ($temp - 19) * -0.02500);
			} else if ($temp > 20 && $temp <= 21) {
				$ans = (1.0016 + ($temp - 20) * -0.02410);
			} else if ($temp > 21 && $temp <= 22) {
				$ans = (0.9775 + ($temp - 21) * -0.02310);
			} else if ($temp > 22 && $temp <= 23) {
				$ans = (0.9544 + ($temp - 22) * -0.02230);
			} else if ($temp > 23 && $temp <= 24) {
				$ans = (0.9321 + ($temp - 23) * -0.02140);
			} else if ($temp > 24 && $temp <= 25) {
				$ans = (0.9107 + ($temp - 24) * -0.02070);
			} else if ($temp > 25 && $temp <= 26) {
				$ans = (0.8900 + ($temp - 25) * -0.01990);
			} else if ($temp > 26 && $temp <= 27) {
				$ans = (0.8701 + ($temp - 26) * -0.01920);
			} else if ($temp > 27 && $temp <= 28) {
				$ans = (0.8509 + ($temp - 27) * -0.01850);
			} else if ($temp > 28 && $temp <= 29) {
				$ans = (0.8324 + ($temp - 28) * -0.01790);
			} else if ($temp > 29 && $temp <= 30) {
				$ans = (0.8145 + ($temp - 29) * -0.01730);
			} else if ($temp > 30 && $temp <= 31) {
				$ans = (0.7972 + ($temp - 30) * -0.01670);
			} else if ($temp > 31 && $temp <= 32) {
				$ans = (0.7805 + ($temp - 31) * -0.01610);
			} else if ($temp > 32 && $temp <= 33) {
				$ans = (0.7644 + ($temp - 32) * -0.01560);
			} else if ($temp > 33 && $temp <= 34) {
				$ans = (0.7488 + ($temp - 33) * -0.01510);
			} else if ($temp > 34 && $temp <= 35) {
				$ans = (0.7337 + ($temp - 34) * -0.01460);
			} else if ($temp > 35 && $temp <= 36) {
				$ans = (0.7191 + ($temp - 35) * -0.01410);
			} else if ($temp > 36 && $temp <= 37) {
				$ans = (0.7050 + ($temp - 36) * -0.01370);
			} else if ($temp > 37 && $temp <= 38) {
				$ans = (0.6913 + ($temp - 37) * -0.01330);
			} else if ($temp > 38 && $temp <= 39) {
				$ans = (0.6780 + ($temp - 38) * -0.01280);
			} else if ($temp > 39 && $temp <= 40) {
				$ans = (0.6652 + ($temp - 39) * -0.01250);
			} else if ($temp > 40 && $temp <= 45) {
				$ans = (0.6527 + ($temp - 40) * -0.01138);
			} else if ($temp > 45 && $temp <= 50) {
				$ans = (0.5958 + ($temp - 45) * -0.00986);
			} else if ($temp > 50 && $temp <= 55) {
				$ans = (0.5465 + ($temp - 50) * -0.00858);
			} else if ($temp > 55 && $temp <= 60) {
				$ans = (0.5036 + ($temp - 55) * -0.00752);
			} else if ($temp > 60 && $temp <= 65) {
				$ans = (0.4660 + ($temp - 60) * -0.00662);
			} else if ($temp > 65 && $temp <= 70) {
				$ans = (0.4329 + ($temp - 65) * -0.00558);
			} else if ($temp > 70 && $temp <= 75) {
				$ans = (0.4035 + ($temp - 70) * -0.00522);
			} else if ($temp > 75 && $temp <= 80) {
				$ans = (0.3774 + ($temp - 75) * -0.00468);
			} else if ($temp > 80 && $temp <= 90) {
				$ans = (0.3540 + ($temp - 80) * -0.00391);
			} else if ($temp > 90 && $temp <= 100) {
				$ans = (0.3149 + ($temp - 90) * -0.00324);
			} else if ($temp > 100 && $temp <= 110) {
				$ans = (0.2825 + ($temp - 100) * -0.00235);
			} else if ($temp > 110 && $temp <= 120) {
				$ans = (0.2590 + ($temp - 110) * -0.00216);
			} else if ($temp > 120 && $temp <= 130) {
				$ans = (0.2374 + ($temp - 120) * -0.00196);
			} else if ($temp > 130 && $temp <= 140) {
				$ans = (0.2178 + ($temp - 130) * -0.00167);
			} else if ($temp > 140 && $temp <= 150) {
				$ans = (0.2011 + ($temp - 140) * -0.00147);
			} else if ($temp > 150 && $temp <= 160) {
				$ans = (0.1864 + ($temp - 150) * -0.00128);
			} else if ($temp > 160 && $temp <= 170) {
				$ans = (0.1736 + ($temp - 160) * -0.00108);
			} else if ($temp > 170 && $temp <= 180) {
				$ans = (0.1628 + ($temp - 170) * -0.00098);
			} else if ($temp > 180 && $temp <= 190) {
				$ans = (0.1530 + ($temp - 180) * -0.00088);
			} else if ($temp > 190 && $temp <= 200) {
				$ans = (0.1442 + ($temp - 190) * -0.00078);
			} else if ($temp > 200 && $temp <= 210) {
				$ans = (0.1364 + ($temp - 200) * -0.00059);
			} else if ($temp > 210 && $temp <= 220) {
				$ans = (0.1305 + ($temp - 210) * -0.00059);
			} else if ($temp > 220 && $temp <= 230) {
				$ans = (0.1246 + ($temp - 220) * -0.00049);
			} else if ($temp > 230 && $temp <= 240) {
				$ans = (0.1197 + ($temp - 230) * -0.00049);
			} else if ($temp > 240 && $temp <= 250) {
				$ans = (0.1148 + ($temp - 240) * -0.00049);
			} else if ($temp > 250 && $temp <= 260) {
				$ans = (0.1099 + ($temp - 250) * -0.00040);
			} else if ($temp > 260 && $temp <= 270) {
				$ans = (0.1059 + ($temp - 260) * -0.00039);
			} else if ($temp > 270 && $temp <= 280) {
				$ans = (0.1020 + ($temp - 270) * -0.00039);
			} else if ($temp > 280 && $temp <= 290) {
				$ans = (0.0981 + ($temp - 280) * -0.00039);
			} else if ($temp > 290 && $temp <= 300) {
				$ans = (0.0942 + ($temp - 290) * -0.00030);
			} else if ($temp > 300 && $temp <= 310) {
				$ans = (0.0912 + ($temp - 300) * -0.00029);
			} else if ($temp > 310 && $temp <= 320) {
				$ans = (0.0883 + ($temp - 310) * -0.00030);
			} else if ($temp > 320 && $temp <= 330) {
				$ans = (0.0853 + ($temp - 320) * -0.00039);
			} else if ($temp > 330 && $temp <= 340) {
				$ans = (0.0814 + ($temp - 330) * -0.00039);
			} else if ($temp > 340 && $temp <= 350) {
				$ans = (0.0775 + ($temp - 340) * -0.00049);
			} else if ($temp > 350 && $temp <= 360) {
				$ans = (0.0726 + ($temp - 350) * -0.00059);
			} else if ($temp > 360 && $temp <= 370) {
				$ans = (0.0667 + ($temp - 360) * -0.00098);
			}

			// 
			if ($temp >= 0 && $temp <= 2) {
				$ans1 = ((1.7880 + ($temp - 0) * -0.05725) / (0.9999 + ($temp - 0) * -0.0000));
			} else if ($temp > 2 && $temp <= 3) {
				$ans1 = ((1.6735 + ($temp - 2) * -0.05450) / (0.9999 + ($temp - 2) * -0.0001));
			} else if ($temp > 3 && $temp <= 4) {
				$ans1 = ((1.6190 + ($temp - 3) * -0.05170) / (1.0000 + ($temp - 3) * -0.0000));
			} else if ($temp > 4 && $temp <= 5) {
				$ans1 = ((1.5673 + ($temp - 4) * -0.04909) / (1.0000 + ($temp - 4) * -0.0000));
			} else if ($temp > 5 && $temp <= 6) {
				$ans1 = ((1.5182 + ($temp - 5) * -0.04670) / (1.0000 + ($temp - 5) * -0.0001));
			} else if ($temp > 6 && $temp <= 7) {
				$ans1 = ((1.4715 + ($temp - 6) * -0.04440) / (0.9999 + ($temp - 6) * -0.0000));
			} else if ($temp > 7 && $temp <= 8) {
				$ans1 = ((1.4271 + ($temp - 7) * -0.04240) / (0.9999 + ($temp - 7) * -0.0000));
			} else if ($temp > 8 && $temp <= 9) {
				$ans1 = ((1.3847 + ($temp - 8) * -0.04030) / (0.9999 + ($temp - 8) * -0.0001));
			} else if ($temp > 9 && $temp <= 10) {
				$ans1 = ((1.3444 + ($temp - 9) * -0.03850) / (0.9998 + ($temp - 9) * -0.0001));
			} else if ($temp > 10 && $temp <= 11) {
				$ans1 = ((1.3059 + ($temp - 10) * -0.03670) / (0.9997 + ($temp - 10) * -0.0001));
			} else if ($temp > 11 && $temp <= 12) {
				$ans1 = ((1.2692 + ($temp - 11) * -0.03520) / (0.9996 + ($temp - 11) * -0.0001));
			} else if ($temp > 12 && $temp <= 13) {
				$ans1 = ((1.2340 + ($temp - 12) * -0.03350) / (0.9995 + ($temp - 12) * -0.0001));
			} else if ($temp > 13 && $temp <= 14) {
				$ans1 = ((1.2005 + ($temp - 13) * -0.03220) / (0.9994 + ($temp - 13) * -0.0002));
			} else if ($temp > 14 && $temp <= 15) {
				$ans1 = ((1.1683 + ($temp - 14) * -0.03080) / (0.9992 + ($temp - 14) * -0.0001));
			} else if ($temp > 15 && $temp <= 16) {
				$ans1 = ((1.1375 + ($temp - 15) * -0.02940) / (0.9991 + ($temp - 15) * -0.0002));
			} else if ($temp > 16 && $temp <= 17) {
				$ans1 = ((1.1081 + ($temp - 16) * -0.02830) / (0.9989 + ($temp - 16) * -0.0001));
			} else if ($temp > 17 && $temp <= 18) {
				$ans1 = ((1.0798 + ($temp - 17) * -0.02720) / (0.9988 + ($temp - 17) * -0.0002));
			} else if ($temp > 18 && $temp <= 19) {
				$ans1 = ((1.0526 + ($temp - 18) * -0.02600) / (0.9986 + ($temp - 18) * -0.0002));
			} else if ($temp > 19 && $temp <= 20) {
				$ans1 = ((1.0266 + ($temp - 19) * -0.02500) / (0.9984 + ($temp - 19) * -0.0002));
			} else if ($temp > 20 && $temp <= 21) {
				$ans1 = ((1.0016 + ($temp - 20) * -0.02410) / (0.9982 + ($temp - 20) * -0.0002));
			} else if ($temp > 21 && $temp <= 22) {
				$ans1 = ((0.9775 + ($temp - 21) * -0.02310) / (0.9980 + ($temp - 21) * -0.0002));
			} else if ($temp > 22 && $temp <= 23) {
				$ans1 = ((0.9544 + ($temp - 22) * -0.02230) / (0.9978 + ($temp - 22) * -0.0003));
			} else if ($temp > 23 && $temp <= 24) {
				$ans1 = ((0.9321 + ($temp - 23) * -0.02140) / (0.9975 + ($temp - 23) * -0.0002));
			} else if ($temp > 24 && $temp <= 25) {
				$ans1 = ((0.9107 + ($temp - 24) * -0.02070) / (0.9973 + ($temp - 24) * -0.0003));
			} else if ($temp > 25 && $temp <= 26) {
				$ans1 = ((0.8900 + ($temp - 25) * -0.01990) / (0.9970 + ($temp - 25) * -0.0002));
			} else if ($temp > 26 && $temp <= 27) {
				$ans1 = ((0.8701 + ($temp - 26) * -0.01920) / (0.9968 + ($temp - 26) * -0.0003));
			} else if ($temp > 27 && $temp <= 28) {
				$ans1 = ((0.8509 + ($temp - 27) * -0.01850) / (0.9965 + ($temp - 27) * -0.0003));
			} else if ($temp > 28 && $temp <= 29) {
				$ans1 = ((0.8324 + ($temp - 28) * -0.01790) / (0.9962 + ($temp - 28) * -0.0003));
			} else if ($temp > 29 && $temp <= 30) {
				$ans1 = ((0.8145 + ($temp - 29) * -0.01730) / (0.9959 + ($temp - 29) * -0.0003));
			} else if ($temp > 30 && $temp <= 31) {
				$ans1 = ((0.7972 + ($temp - 30) * -0.01670) / (0.9956 + ($temp - 30) * -0.0003));
			} else if ($temp > 31 && $temp <= 32) {
				$ans1 = ((0.7805 + ($temp - 31) * -0.01610) / (0.9953 + ($temp - 31) * -0.0003));
			} else if ($temp > 32 && $temp <= 33) {
				$ans1 = ((0.7644 + ($temp - 32) * -0.01560) / (0.9950 + ($temp - 32) * -0.0003));
			} else if ($temp > 33 && $temp <= 34) {
				$ans1 = ((0.7488 + ($temp - 33) * -0.01510) / (0.9947 + ($temp - 33) * -0.0003));
			} else if ($temp > 34 && $temp <= 35) {
				$ans1 = ((0.7337 + ($temp - 34) * -0.01460) / (0.9944 + ($temp - 34) * -0.0004));
			} else if ($temp > 35 && $temp <= 36) {
				$ans1 = ((0.7191 + ($temp - 35) * -0.01410) / (0.9940 + ($temp - 35) * -0.0003));
			} else if ($temp > 36 && $temp <= 37) {
				$ans1 = ((0.7050 + ($temp - 36) * -0.01370) / (0.9937 + ($temp - 36) * -0.0004));
			} else if ($temp > 37 && $temp <= 38) {
				$ans1 = ((0.6913 + ($temp - 37) * -0.01330) / (0.9933 + ($temp - 37) * -0.0003));
			} else if ($temp > 38 && $temp <= 39) {
				$ans1 = ((0.6780 + ($temp - 38) * -0.01280) / (0.9930 + ($temp - 38) * -0.0004));
			} else if ($temp > 39 && $temp <= 40) {
				$ans1 = ((0.6652 + ($temp - 39) * -0.01250) / (0.9926 + ($temp - 39) * -0.0004));
			} else if ($temp > 40 && $temp <= 45) {
				$ans1 = ((0.6527 + ($temp - 40) * -0.01138) / (0.9922 + ($temp - 40) * -0.0004));
			} else if ($temp > 45 && $temp <= 50) {
				$ans1 = ((0.5958 + ($temp - 45) * -0.00986) / (0.9902 + ($temp - 45) * -0.00044));
			} else if ($temp > 50 && $temp <= 55) {
				$ans1 = ((0.5465 + ($temp - 50) * -0.00858) / (0.9880 + ($temp - 50) * -0.00046));
			} else if ($temp > 55 && $temp <= 60) {
				$ans1 = ((0.5036 + ($temp - 55) * -0.00752) / (0.9857 + ($temp - 55) * -0.00050));
			} else if ($temp > 60 && $temp <= 65) {
				$ans1 = ((0.4660 + ($temp - 60) * -0.00662) / (0.9832 + ($temp - 60) * -0.00052));
			} else if ($temp > 65 && $temp <= 70) {
				$ans1 = ((0.4329 + ($temp - 65) * -0.00558) / (0.9806 + ($temp - 65) * -0.00056));
			} else if ($temp > 70 && $temp <= 75) {
				$ans1 = ((0.4035 + ($temp - 70) * -0.00522) / (0.9778 + ($temp - 70) * -0.00060));
			} else if ($temp > 75 && $temp <= 80) {
				$ans1 = ((0.3774 + ($temp - 75) * -0.00468) / (0.9748 + ($temp - 75) * -0.00060));
			} else if ($temp > 80 && $temp <= 90) {
				$ans1 = ((0.3540 + ($temp - 80) * -0.00391) / (0.9718 + ($temp - 80) * -0.00065));
			} else if ($temp > 90 && $temp <= 100) {
				$ans1 = ((0.3149 + ($temp - 90) * -0.00324) / (0.9653 + ($temp - 90) * -0.00069));
			} else if ($temp > 100 && $temp <= 110) {
				$ans1 = ((0.2825 + ($temp - 100) * -0.00235) / (0.9584 + ($temp - 100) * -0.00074));
			} else if ($temp > 110 && $temp <= 120) {
				$ans1 = ((0.2590 + ($temp - 110) * -0.00216) / (0.9510 + ($temp - 110) * -0.00079));
			} else if ($temp > 120 && $temp <= 130) {
				$ans1 = ((0.2374 + ($temp - 120) * -0.00196) / (0.9431 + ($temp - 120) * -0.00083));
			} else if ($temp > 130 && $temp <= 140) {
				$ans1 = ((0.2178 + ($temp - 130) * -0.00167) / (0.9348 + ($temp - 130) * -0.00087));
			} else if ($temp > 140 && $temp <= 150) {
				$ans1 = ((0.2011 + ($temp - 140) * -0.00147) / (0.9261 + ($temp - 140) * -0.00091));
			} else if ($temp > 150 && $temp <= 160) {
				$ans1 = ((0.1864 + ($temp - 150) * -0.00128) / (0.9170 + ($temp - 150) * -0.00096));
			} else if ($temp > 160 && $temp <= 170) {
				$ans1 = ((0.1736 + ($temp - 160) * -0.00108) / (0.9074 + ($temp - 160) * -0.00101));
			} else if ($temp > 170 && $temp <= 180) {
				$ans1 = ((0.1628 + ($temp - 170) * -0.00098) / (0.8973 + ($temp - 170) * -0.00104));
			} else if ($temp > 180 && $temp <= 190) {
				$ans1 = ((0.1530 + ($temp - 180) * -0.00088) / (0.8869 + ($temp - 180) * -0.00109));
			} else if ($temp > 190 && $temp <= 200) {
				$ans1 = ((0.1442 + ($temp - 190) * -0.00078) / (0.8760 + ($temp - 190) * -0.00130));
			} else if ($temp > 200 && $temp <= 210) {
				$ans1 = ((0.1364 + ($temp - 200) * -0.00059) / (0.8630 + ($temp - 200) * -0.00102));
			} else if ($temp > 210 && $temp <= 220) {
				$ans1 = ((0.1305 + ($temp - 210) * -0.00059) / (0.8528 + ($temp - 210) * -0.00125));
			} else if ($temp > 220 && $temp <= 230) {
				$ans1 = ((0.1246 + ($temp - 220) * -0.00049) / (0.8403 + ($temp - 220) * -0.00130));
			} else if ($temp > 230 && $temp <= 240) {
				$ans1 = ((0.1197 + ($temp - 230) * -0.00049) / (0.8273 + ($temp - 230) * -0.00137));
			} else if ($temp > 240 && $temp <= 250) {
				$ans1 = ((0.1148 + ($temp - 240) * -0.00049) / (0.8136 + ($temp - 240) * -0.00146));
			} else if ($temp > 250 && $temp <= 260) {
				$ans1 = ((0.1099 + ($temp - 250) * -0.00040) / (0.7990 + ($temp - 250) * -0.00150));
			} else if ($temp > 260 && $temp <= 270) {
				$ans1 = ((0.1059 + ($temp - 260) * -0.00039) / (0.7840 + ($temp - 260) * -0.00161));
			} else if ($temp > 270 && $temp <= 280) {
				$ans1 = ((0.1020 + ($temp - 270) * -0.00039) / (0.7679 + ($temp - 270) * -0.00172));
			} else if ($temp > 280 && $temp <= 290) {
				$ans1 = ((0.0981 + ($temp - 280) * -0.00039) / (0.7507 + ($temp - 280) * -0.00184));
			} else if ($temp > 290 && $temp <= 300) {
				$ans1 = ((0.0942 + ($temp - 290) * -0.00030) / (0.7323 + ($temp - 290) * -0.00198));
			} else if ($temp > 300 && $temp <= 310) {
				$ans1 = ((0.0912 + ($temp - 300) * -0.00029) / (0.7125 + ($temp - 300) * -0.00214));
			} else if ($temp > 310 && $temp <= 320) {
				$ans1 = ((0.0883 + ($temp - 310) * -0.00030) / (0.6911 + ($temp - 310) * -0.00240));
			} else if ($temp > 320 && $temp <= 330) {
				$ans1 = ((0.0853 + ($temp - 320) * -0.00039) / (0.6671 + ($temp - 320) * -0.00269));
			} else if ($temp > 330 && $temp <= 340) {
				$ans1 = ((0.0814 + ($temp - 330) * -0.00039) / (0.6402 + ($temp - 330) * -0.00301));
			} else if ($temp > 340 && $temp <= 350) {
				$ans1 = ((0.0775 + ($temp - 340) * -0.00049) / (0.6101 + ($temp - 340) * -0.00357));
			} else if ($temp > 350 && $temp <= 360) {
				$ans1 = ((0.0726 + ($temp - 350) * -0.00059) / (0.5744 + ($temp - 350) * -0.00464));
			} else if ($temp > 360 && $temp <= 370) {
				$ans1 = ((0.0667 + ($temp - 360) * -0.00098) / (0.4505 + ($temp - 360) * -0.00775));
			}


			if ($temp >= 0 && $temp <= 2) {
				$ans3 = (0.9999 + ($temp - 0) * -0.0000);
			} else if ($temp > 2 && $temp <= 3) {
				$ans3 = (0.9999 + ($temp - 2) * -0.0001);
			} else if ($temp > 3 && $temp <= 4) {
				$ans3 = (1.0000 + ($temp - 3) * -0.0000);
			} else if ($temp > 4 && $temp <= 5) {
				$ans3 = (1.0000 + ($temp - 4) * -0.0000);
			} else if ($temp > 5 && $temp <= 6) {
				$ans3 = (1.0000 + ($temp - 5) * -0.0001);
			} else if ($temp > 6 && $temp <= 7) {
				$ans3 = (0.9999 + ($temp - 6) * -0.0000);
			} else if ($temp > 7 && $temp <= 8) {
				$ans3 = (0.9999 + ($temp - 7) * -0.0000);
			} else if ($temp > 8 && $temp <= 9) {
				$ans3 = (0.9999 + ($temp - 8) * -0.0001);
			} else if ($temp > 9 && $temp <= 10) {
				$ans3 = (0.9998 + ($temp - 9) * -0.0001);
			} else if ($temp > 10 && $temp <= 11) {
				$ans3 = (0.9997 + ($temp - 10) * -0.0001);
			} else if ($temp > 11 && $temp <= 12) {
				$ans3 = (0.9996 + ($temp - 11) * -0.0001);
			} else if ($temp > 12 && $temp <= 13) {
				$ans3 = (0.9995 + ($temp - 12) * -0.0001);
			} else if ($temp > 13 && $temp <= 14) {
				$ans3 = (0.9994 + ($temp - 13) * -0.0002);
			} else if ($temp > 14 && $temp <= 15) {
				$ans3 = (0.9992 + ($temp - 14) * -0.0001);
			} else if ($temp > 15 && $temp <= 16) {
				$ans3 = (0.9991 + ($temp - 15) * -0.0002);
			} else if ($temp > 16 && $temp <= 17) {
				$ans3 = (0.9989 + ($temp - 16) * -0.0001);
			} else if ($temp > 17 && $temp <= 18) {
				$ans3 = (0.9988 + ($temp - 17) * -0.0002);
			} else if ($temp > 18 && $temp <= 19) {
				$ans3 = (0.9986 + ($temp - 18) * -0.0002);
			} else if ($temp > 19 && $temp <= 20) {
				$ans3 = (0.9984 + ($temp - 19) * -0.0002);
			} else if ($temp > 20 && $temp <= 21) {
				$ans3 = (0.9982 + ($temp - 20) * -0.0002);
			} else if ($temp > 21 && $temp <= 22) {
				$ans3 = (0.9980 + ($temp - 21) * -0.0002);
			} else if ($temp > 22 && $temp <= 23) {
				$ans3 = (0.9978 + ($temp - 22) * -0.0003);
			} else if ($temp > 23 && $temp <= 24) {
				$ans3 = (0.9975 + ($temp - 23) * -0.0002);
			} else if ($temp > 24 && $temp <= 25) {
				$ans3 = (0.9973 + ($temp - 24) * -0.0003);
			} else if ($temp > 25 && $temp <= 26) {
				$ans3 = (0.9970 + ($temp - 25) * -0.0002);
			} else if ($temp > 26 && $temp <= 27) {
				$ans3 = (0.9968 + ($temp - 26) * -0.0003);
			} else if ($temp > 27 && $temp <= 28) {
				$ans3 = (0.9965 + ($temp - 27) * -0.0003);
			} else if ($temp > 28 && $temp <= 29) {
				$ans3 = (0.9962 + ($temp - 28) * -0.0003);
			} else if ($temp > 29 && $temp <= 30) {
				$ans3 = (0.9959 + ($temp - 29) * -0.0003);
			} else if ($temp > 30 && $temp <= 31) {
				$ans3 = (0.9956 + ($temp - 30) * -0.0003);
			} else if ($temp > 31 && $temp <= 32) {
				$ans3 = (0.9953 + ($temp - 31) * -0.0003);
			} else if ($temp > 32 && $temp <= 33) {
				$ans3 = (0.9950 + ($temp - 32) * -0.0003);
			} else if ($temp > 33 && $temp <= 34) {
				$ans3 = (0.9947 + ($temp - 33) * -0.0003);
			} else if ($temp > 34 && $temp <= 35) {
				$ans3 = (0.9944 + ($temp - 34) * -0.0004);
			} else if ($temp > 35 && $temp <= 36) {
				$ans3 = (0.9940 + ($temp - 35) * -0.0003);
			} else if ($temp > 36 && $temp <= 37) {
				$ans3 = (0.9937 + ($temp - 36) * -0.0004);
			} else if ($temp > 37 && $temp <= 38) {
				$ans3 = (0.9933 + ($temp - 37) * -0.0003);
			} else if ($temp > 38 && $temp <= 39) {
				$ans3 = (0.9930 + ($temp - 38) * -0.0004);
			} else if ($temp > 39 && $temp <= 40) {
				$ans3 = (0.9926 + ($temp - 39) * -0.0004);
			} else if ($temp > 40 && $temp <= 45) {
				$ans3 = (0.9922 + ($temp - 40) * -0.0004);
			} else if ($temp > 45 && $temp <= 50) {
				$ans3 = (0.9902 + ($temp - 45) * -0.00044);
			} else if ($temp > 50 && $temp <= 55) {
				$ans3 = (0.9880 + ($temp - 50) * -0.00046);
			} else if ($temp > 55 && $temp <= 60) {
				$ans3 = (0.9857 + ($temp - 55) * -0.00050);
			} else if ($temp > 60 && $temp <= 65) {
				$ans3 = (0.9832 + ($temp - 60) * -0.00052);
			} else if ($temp > 65 && $temp <= 70) {
				$ans3 = (0.9806 + ($temp - 65) * -0.00056);
			} else if ($temp > 70 && $temp <= 75) {
				$ans3 = (0.9778 + ($temp - 70) * -0.00060);
			} else if ($temp > 75 && $temp <= 80) {
				$ans3 = (0.9748 + ($temp - 75) * -0.00060);
			} else if ($temp > 80 && $temp <= 90) {
				$ans3 = (0.9718 + ($temp - 80) * -0.00065);
			} else if ($temp > 90 && $temp <= 100) {
				$ans3 = (0.9653 + ($temp - 90) * -0.00069);
			} else if ($temp > 100 && $temp <= 110) {
				$ans3 = (0.9584 + ($temp - 100) * -0.00074);
			} else if ($temp > 110 && $temp <= 120) {
				$ans3 = (0.9510 + ($temp - 110) * -0.00079);
			} else if ($temp > 120 && $temp <= 130) {
				$ans3 = (0.9431 + ($temp - 120) * -0.00083);
			} else if ($temp > 130 && $temp <= 140) {
				$ans3 = (0.9348 + ($temp - 130) * -0.00087);
			} else if ($temp > 140 && $temp <= 150) {
				$ans3 = (0.9261 + ($temp - 140) * -0.00091);
			} else if ($temp > 150 && $temp <= 160) {
				$ans3 = (0.9170 + ($temp - 150) * -0.00096);
			} else if ($temp > 160 && $temp <= 170) {
				$ans3 = (0.9074 + ($temp - 160) * -0.00101);
			} else if ($temp > 170 && $temp <= 180) {
				$ans3 = (0.8973 + ($temp - 170) * -0.00104);
			} else if ($temp > 180 && $temp <= 190) {
				$ans3 = (0.8869 + ($temp - 180) * -0.00109);
			} else if ($temp > 190 && $temp <= 200) {
				$ans3 = (0.8760 + ($temp - 190) * -0.00130);
			} else if ($temp > 200 && $temp <= 210) {
				$ans3 = (0.8630 + ($temp - 200) * -0.00102);
			} else if ($temp > 210 && $temp <= 220) {
				$ans3 = (0.8528 + ($temp - 210) * -0.00125);
			} else if ($temp > 220 && $temp <= 230) {
				$ans3 = (0.8403 + ($temp - 220) * -0.00130);
			} else if ($temp > 230 && $temp <= 240) {
				$ans3 = (0.8273 + ($temp - 230) * -0.00137);
			} else if ($temp > 240 && $temp <= 250) {
				$ans3 = (0.8136 + ($temp - 240) * -0.00146);
			} else if ($temp > 250 && $temp <= 260) {
				$ans3 = (0.7990 + ($temp - 250) * -0.00150);
			} else if ($temp > 260 && $temp <= 270) {
				$ans3 = (0.7840 + ($temp - 260) * -0.00161);
			} else if ($temp > 270 && $temp <= 280) {
				$ans3 = (0.7679 + ($temp - 270) * -0.00172);
			} else if ($temp > 280 && $temp <= 290) {
				$ans3 = (0.7507 + ($temp - 280) * -0.00184);
			} else if ($temp > 290 && $temp <= 300) {
				$ans3 = (0.7323 + ($temp - 290) * -0.00198);
			} else if ($temp > 300 && $temp <= 310) {
				$ans3 = (0.7125 + ($temp - 300) * -0.00214);
			} else if ($temp > 310 && $temp <= 320) {
				$ans3 = (0.6911 + ($temp - 310) * -0.00240);
			} else if ($temp > 320 && $temp <= 330) {
				$ans3 = (0.6671 + ($temp - 320) * -0.00269);
			} else if ($temp > 330 && $temp <= 340) {
				$ans3 = (0.6402 + ($temp - 330) * -0.00301);
			} else if ($temp > 340 && $temp <= 350) {
				$ans3 = (0.6101 + ($temp - 340) * -0.00357);
			} else if ($temp > 350 && $temp <= 360) {
				$ans3 = (0.5744 + ($temp - 350) * -0.00464);
			} else if ($temp > 360 && $temp <= 370) {
				$ans3 = (0.4505 + ($temp - 360) * -0.00775);
			}

			$this->param['ans'] = $ans;
			$this->param['ans1'] = $ans1;
			$this->param['ans2'] = $ans3;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Enter Water temperature';
			return $this->param;
		}
	}

	// Potential Energy Calculator
	public function potential($request)
	{
		$cal = trim($request->cal);
		$mass = trim($request->mass);
		$mass_unit = trim($request->mass_unit);
		$gravity = trim($request->gravity);
		$gravity_unit = trim($request->gravity_unit);
		$height = trim($request->height);
		$height_unit = trim($request->height_unit);
		$pe = trim($request->pe);
		$pe_unit = trim($request->pe_unit);

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
		if (is_numeric($mass)) {
			if ($mass_unit === 'ug') {
				$mass = $mass / 1000000000;
			} elseif ($mass_unit === 'mg') {
				$mass = $mass * 1000000;
			} elseif ($mass_unit === 'g') {
				$mass = $mass / 1000;
			} elseif ($mass_unit === 'dag') {
				$mass = $mass / 100;
			} elseif ($mass_unit === 't') {
				$mass = $mass / 0.001;
			} elseif ($mass_unit === 'gr') {
				$mass = $mass / 15432;
			} elseif ($mass_unit === 'dr') {
				$mass = $mass / 564.4;
			} elseif ($mass_unit === 'oz') {
				$mass = $mass / 35.274;
			} elseif ($mass_unit === 'lb') {
				$mass = $mass / 2.2046;
			} elseif ($mass_unit === 'stone') {
				$mass = $mass / 0.15747;
			} elseif ($mass_unit === 'us_ton') {
				$mass = $mass / 0.0011023;
			} elseif ($mass_unit === 'long_ton') {
				$mass = $mass / 0.0009842;
			} elseif ($mass_unit === 'earths') {
				$mass = $mass * 5972000000000000000000000;
			} elseif ($mass_unit === 'me') {
				$mass = $mass / 1097769122809886380500592292548;
			} elseif ($mass_unit === 'u') {
				$mass = $mass / 602214000000000000000000000;
			} elseif ($mass_unit === 'oz_t') {
				$mass = $mass / 32.15075;
			}
		}
		if (is_numeric($gravity)) {
			if ($gravity_unit === 'cm_s2') {
				$gravity = $gravity * 0.01;
			} elseif ($gravity_unit === 'in_s2') {
				$gravity = $gravity / 39.370078740157;
			} elseif ($gravity_unit === 'mi_h_s') {
				$gravity = $gravity / 2.24;
			} elseif ($gravity_unit === 'g') {
				$gravity = $gravity / 0.10193679918451;
			}
		}
		if (is_numeric($height)) {
			if ($height_unit === 'mm') {
				$height = $height / 1000;
			} elseif ($height_unit === 'cm') {
				$height = $height / 100;
			} elseif ($height_unit === 'km') {
				$height = $height / 0.001;
			} elseif ($height_unit === 'in') {
				$height = $height / 39.37;
			} elseif ($height_unit === 'ft') {
				$height = $height / 3.281;
			} elseif ($height_unit === 'yd') {
				$height = $height / 1.0936;
			} elseif ($height_unit === 'mi') {
				$height = $height / 0.0006214;
			} elseif ($height_unit === 'nmi') {
				$height = $height / 0.00054;
			}
		}
		if ($cal === 'mass' && is_numeric($gravity) && is_numeric($height) && is_numeric($pe)) {
			$mass = $gravity * $height * $pe;
			$this->param['ans'] = $mass;
			$this->param['unit'] = 'kg';
			$this->param['g'] = $gravity;
			$this->param['h'] = $height;
			$this->param['pe'] = $pe;
		} elseif ($cal === 'gravity' && is_numeric($mass) && is_numeric($height) && is_numeric($pe)) {
			$gravity = $mass * $height * $pe;
			$this->param['ans'] = $gravity;
			$this->param['unit'] = 'm/s²';
			$this->param['m'] = $mass;
			$this->param['h'] = $height;
			$this->param['pe'] = $pe;
		} elseif ($cal === 'height' && is_numeric($mass) && is_numeric($gravity) && is_numeric($pe)) {
			$height = $mass * $gravity * $pe;
			$this->param['ans'] = $height;
			$this->param['unit'] = 'm';
			$this->param['m'] = $mass;
			$this->param['g'] = $gravity;
			$this->param['pe'] = $pe;
		} elseif ($cal === 'pe' && is_numeric($mass) && is_numeric($gravity) && is_numeric($height)) {
			$pe = $mass * $gravity * $height;
			$this->param['ans'] = $pe;
			$this->param['unit'] = 'J';
			$this->param['m'] = $mass;
			$this->param['g'] = $gravity;
			$this->param['h'] = $height;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		$this->param['cal'] = $cal;
		$this->param['mass'] = $mass;

		return $this->param;
	}

	// Wavelength Calculator
	function wavelength($request)
	{
		$find = trim($request->find);
		$velocity = trim($request->velocity);
		$velocity_unit = trim($request->velocity_unit);
		$frequency = trim($request->frequency);
		$frequency_unit = trim($request->frequency_unit);
		$wavelength = trim($request->wavelength);
		$wavelength_unit = trim($request->wavelength_unit);

		if (is_numeric($wavelength)) {
			if ($wavelength_unit === 'nm') {
				$wavelength = $wavelength / 1000000000;
			} elseif ($wavelength_unit === 'um') {
				$wavelength = $wavelength / 1000000;
			} elseif ($wavelength_unit === 'mm') {
				$wavelength = $wavelength / 1000;
			} elseif ($wavelength_unit === 'cm') {
				$wavelength = $wavelength / 100;
			} elseif ($wavelength_unit === 'km') {
				$wavelength = $wavelength / 0.001;
			} elseif ($wavelength_unit === 'in') {
				$wavelength = $wavelength / 39.3701;
			} elseif ($wavelength_unit === 'ft') {
				$wavelength = $wavelength / 3.28084;
			} elseif ($wavelength_unit === 'yd') {
				$wavelength = $wavelength / 1.093613;
			} elseif ($wavelength_unit === 'mi') {
				$wavelength = $wavelength / 0.000621371;
			}
		}
		if (is_numeric($frequency)) {
			if ($frequency_unit === 'khz') {
				$frequency = $frequency / 0.001;
			} elseif ($frequency_unit === 'mhz') {
				$frequency = $frequency / 0.000001;
			} elseif ($frequency_unit === 'ghz') {
				$frequency = $frequency / 0.000000001;
			} elseif ($frequency_unit === 'thz') {
				$frequency = $frequency / 0.000000000001;
			}
		}
		if (is_numeric($velocity)) {
			if ($velocity_unit === 'cms') {
				$velocity = $velocity / 100;
			} elseif ($velocity_unit === 'kmh') {
				$velocity = $velocity / 3.6;
			} elseif ($velocity_unit === 'fts') {
				$velocity = $velocity / 3.28084;
			} elseif ($velocity_unit === 'mph') {
				$velocity = $velocity / 2.236936;
			} elseif ($velocity_unit === 'knots') {
				$velocity = $velocity / 1.943844;
			} elseif ($velocity_unit === 'c') {
				$velocity = $velocity / 0.00000000333564;
			}
		}
		if ($find === 'wavelength' && is_numeric($frequency) && is_numeric($velocity)) {
			$wavelength = $velocity / $frequency;
			$wavenumber = $frequency / $velocity;
			$this->param['unit'] = 'm';
			$this->param['ans'] = $wavelength;
			$this->param['wn'] = number_format($wavenumber, 12);
			$this->param['frequency'] = $frequency;
			$this->param['velocity'] = $velocity;
		} elseif ($find === 'frequency' && is_numeric($wavelength) && is_numeric($velocity)) {
			$frequency = $velocity / $wavelength;
			$wavenumber = $frequency / $velocity;
			$this->param['unit'] = 'Hz';
			$this->param['ans'] = $frequency;
			$this->param['wn'] = number_format($wavenumber, 12);
			$this->param['wavelength'] = $wavelength;
			$this->param['velocity'] = $velocity;
		} elseif ($find === 'velocity' && is_numeric($wavelength) && is_numeric($frequency)) {
			$velocity = $frequency * $wavelength;
			$wavenumber = $frequency / $velocity;
			$this->param['unit'] = 'm/s';
			$this->param['ans'] = $velocity;
			$this->param['wn'] = number_format($wavenumber, 12);
			$this->param['wavelength'] = $wavelength;
			$this->param['frequency'] = $frequency;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		$this->param['find'] = $find;

		return $this->param;
	}

	// Spring Constant Calculator
	function spring($request)
	{
		$selection = trim($request->selection);
		$val1 = trim($request->spring_constant);
		$val2 = trim($request->spring_displacement);
		$val3 = trim($request->spring_force);
		$spring_displacement_unit = trim($request->spring_displacement_unit);

		//Calculate Force && Selection 1 Coding
		if ($selection == "1") {
			if (is_numeric($val1) && is_numeric($val2)) {
				if ($spring_displacement_unit == "m") {
					$calculate_force1 = $val2 / 1;
				} else if ($spring_displacement_unit == "mm") {
					$calculate_force1 = $val2 / 1000;
				} else if ($spring_displacement_unit == "cm") {
					$calculate_force1 = $val2 / 100;
				} else if ($spring_displacement_unit == "inches") {
					$calculate_force1 = $val2 / 39.3701;
				} else if ($spring_displacement_unit == "feet") {
					$calculate_force1 = $val2 / 3.28084;
				} else if ($spring_displacement_unit == "yards") {
					$calculate_force1 = $val2 / 1.093613;
				}
				$final_value = (-1) * $calculate_force1 * $val1;
				$this->param['fahad1'] = $final_value;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($selection == "2") {
			if (is_numeric($val2) && is_numeric($val3)) {
				$calculate_spring1 = ($val3 / $val2);
				if ($spring_displacement_unit == "m") {
					$calculate_force2 = $calculate_spring1 * 1;
				} else if ($spring_displacement_unit == "mm") {
					$calculate_force2 = $calculate_spring1 * 1000;
				} else if ($spring_displacement_unit == "cm") {
					$calculate_force2 = $calculate_spring1 * 100;
				} else if ($spring_displacement_unit == "inches") {
					$calculate_force2 = $calculate_spring1 * 39.3701;
				} else if ($spring_displacement_unit == "feet") {
					$calculate_force2 = $calculate_spring1 * 3.28084;
				} else if ($spring_displacement_unit == "yards") {
					$calculate_force2 = $calculate_spring1 * 1.093613;
				}
				$calculate_force3 = (-1) * $calculate_force2;
				$this->param['fahad2'] = $calculate_force3;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($selection == "3") {
			if (is_numeric($val1) && is_numeric($val3)) {
				$an = $val3 / $val1;
				$ans = (-1) * ($an * 1000);
				$ans1 = (-1) * ($an * 100);
				$ans2 = (-1) * ($an * 39.3701);
				$ans3 = (-1) * ($an * 3.28084);
				$ans4 = (-1) * ($an * 1.093613);
				$this->param['an'] = $an;
				$this->param['ans'] = $ans;
				$this->param['ans1'] = $ans1;
				$this->param['ans2'] = $ans2;
				$this->param['ans3'] = $ans3;
				$this->param['ans4'] = $ans4;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
	}
	// Free Fall Calculator
	function free($request)
	{
		$acceleration = $request->acceleration;
		$a_unit = $request->a_unit;
		$height = $request->height;
		$velocity = $request->velocity;
		$v_unit = $request->v_unit;
		$height = $request->height;
		$h_unit = $request->h_unit;
		$time = $request->time;
		$t_unit = $request->t_unit;
		$velocity_one = $request->velocity_one;
		$v_one_unit = $request->v_one_unit;
		$selection = $request->selection;
		if ($v_unit == 'm/s²') {
			$v_unit = '1';
		} else if ($v_unit = 'km/h') {
			$v_unit = '2';
		} else if ($v_unit = 'ft/s') {
			$v_unit = '3';
		} else if ($v_unit = 'mph') {
			$v_unit = '4';
		} else if ($v_unit = 'knots') {
			$v_unit = '5';
		} else if ($v_unit = 'km/s') {
			$v_unit = '6';
		} else if ($v_unit = 'mi/s') {
			$v_unit = '7';
		} else if ($v_unit = 'ft/min') {
			$v_unit = '8';
		} else if ($v_unit = 'm/min') {
			$v_unit = '9';
		}

		if ($a_unit == 'm/s²') {
			$a_unit = '1';
		} else if ($a_unit = 'g') {
			$a_unit = '2';
		} else if ($a_unit = 'ft/s²') {
			$a_unit = '3';
		}

		if ($h_unit == 'cm') {
			$h_unit = '1';
		} else if ($h_unit = 'm') {
			$h_unit = '2';
		} else if ($h_unit = 'km') {
			$h_unit = '3';
		} else if ($h_unit = 'in') {
			$h_unit = '4';
		} else if ($h_unit = 'ft') {
			$h_unit = '5';
		} else if ($h_unit = 'yd') {
			$h_unit = '6';
		} else if ($h_unit = 'mi') {
			$h_unit = '7';
		}

		if ($t_unit == 'sec') {
			$t_unit = '1';
		} else if ($t_unit = 'min') {
			$t_unit = '2';
		} else if ($t_unit = 'hrs') {
			$t_unit = '3';
		}


		if ($v_one_unit == 'cm') {
			$v_one_unit = '1';
		} else if ($v_one_unit = 'km/h') {
			$v_one_unit = '2';
		} else if ($v_one_unit = 'ft/s') {
			$v_one_unit = '3';
		} else if ($v_one_unit = 'mph') {
			$v_one_unit = '4';
		} else if ($v_one_unit = 'knots') {
			$v_one_unit = '5';
		} else if ($v_one_unit = 'km/s') {
			$v_one_unit = '6';
		} else if ($v_one_unit = 'mi/s') {
			$v_one_unit = '7';
		} else if ($v_one_unit = 'ft/min') {
			$v_one_unit = '8';
		} else if ($v_one_unit = 'm/min') {
			$v_one_unit = '9';
		}

		if ($selection == "1") {
			if (is_numeric($acceleration) && is_numeric($velocity) && is_numeric($height) && $acceleration > 0 && $height > 0) {
				if ($a_unit == "1") {
					$convert = $acceleration * 1;
				} elseif ($a_unit == "2") {
					$convert = $acceleration * 9.80665;
				} elseif ($a_unit == "3") {
					$convert = $acceleration * 0.3048;
				}
				if ($v_unit == "1") {
					$convert1 = $velocity * 1;
				} elseif ($v_unit == "2") {
					$convert1 = $velocity * 0.2778;
				} elseif ($v_unit == "3") {
					$convert1 = $velocity * 0.3048;
				} elseif ($v_unit == "4") {
					$convert1 = $velocity * 0.447;
				} elseif ($v_unit == "5") {
					$convert1 = $velocity * 0.5144;
				} elseif ($v_unit == "6") {
					$convert1 = $velocity * 1000;
				} elseif ($v_unit == "7") {
					$convert1 = $velocity * 1609.3;
				} elseif ($v_unit == "8") {
					$convert1 = $velocity * 0.00508;
				} elseif ($v_unit == "9") {
					$convert1 = $velocity * 0.016667;
				}
				if ($h_unit == "1") {
					$convert2 = $height * 0.01;
				} elseif ($h_unit == "2") {
					$convert2 = $height * 1;
				} elseif ($h_unit == "3") {
					$convert2 = $height * 1000;
				} elseif ($h_unit == "4") {
					$convert2 = $height * 0.0254;
				} elseif ($h_unit == "5") {
					$convert2 = $height * 0.3048;
				} elseif ($h_unit == "6") {
					$convert2 = $height * 0.9144;
				} elseif ($h_unit == "7") {
					$convert2 = $height * 1609.344;
				}

				$t = sqrt((2 * $convert2) / ($convert));
				$v = sqrt(2 * $convert * $convert2);
				$this->param['answer1'] = $t;
				$this->param['answer2'] = $v;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($selection == "2") {
			if (is_numeric($acceleration) && is_numeric($velocity) && is_numeric($time) && $acceleration > 0 && $time > 0) {
				if ($a_unit == "1") {
					$convert = $acceleration * 1;
				} elseif ($a_unit == "2") {
					$convert = $acceleration * 9.80665;
				} elseif ($a_unit == "3") {
					$convert = $acceleration * 0.3048;
				}
				if ($v_unit == "1") {
					$convert1 = $velocity * 1;
				} elseif ($v_unit == "2") {
					$convert1 = $velocity * 0.2778;
				} elseif ($v_unit == "3") {
					$convert1 = $velocity * 0.3048;
				} elseif ($v_unit == "4") {
					$convert1 = $velocity * 0.447;
				} elseif ($v_unit == "5") {
					$convert1 = $velocity * 0.5144;
				} elseif ($v_unit == "6") {
					$convert1 = $velocity * 1000;
				} elseif ($v_unit == "7") {
					$convert1 = $velocity * 1609.3;
				} elseif ($v_unit == "8") {
					$convert1 = $velocity * 0.00508;
				} elseif ($v_unit == "9") {
					$convert1 = $velocity * 0.016667;
				}
				if ($t_unit == "1") {
					$convert3 = $time * 1;
				} elseif ($t_unit == "2") {
					$convert3 = $time * 60;
				} elseif ($t_unit == "3") {
					$convert3 = $time * 3600;
				}
				$h = ((1 / 2) * ($convert * $convert3 * $convert3));
				$v = $convert1 + ($convert * $convert3);
				$this->param['answer3'] = $h;
				$this->param['answer4'] = $v;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($selection == "3") {
			if (is_numeric($acceleration) && is_numeric($velocity) && is_numeric($velocity_one) && $acceleration > 0 && $velocity > 0) {
				if ($a_unit == "1") {
					$convert = $acceleration * 1;
				} elseif ($a_unit == "2") {
					$convert = $acceleration * 9.80665;
				} elseif ($a_unit == "3") {
					$convert = $acceleration * 0.3048;
				}
				if ($v_unit == "1") {
					$convert1 = $velocity * 1;
				} elseif ($v_unit == "2") {
					$convert1 = $velocity * 0.2778;
				} elseif ($v_unit == "3") {
					$convert1 = $velocity * 0.3048;
				} elseif ($v_unit == "4") {
					$convert1 = $velocity * 0.447;
				} elseif ($v_unit == "5") {
					$convert1 = $velocity * 0.5144;
				} elseif ($v_unit == "6") {
					$convert1 = $velocity * 1000;
				} elseif ($v_unit == "7") {
					$convert1 = $velocity * 1609.3;
				} elseif ($v_unit == "8") {
					$convert1 = $velocity * 0.00508;
				} elseif ($v_unit == "9") {
					$convert1 = $velocity * 0.016667;
				}
				if ($v_one_unit == "1") {
					$convert4 = $velocity_one * 1;
				} elseif ($v_one_unit == "2") {
					$convert4 = $velocity_one * 0.2778;
				} elseif ($v_one_unit == "3") {
					$convert4 = $velocity_one * 0.3048;
				} elseif ($v_one_unit == "4") {
					$convert4 = $velocity_one * 0.447;
				} elseif ($v_one_unit == "5") {
					$convert4 = $velocity_one * 0.5144;
				} elseif ($v_one_unit == "6") {
					$convert4 = $velocity_one * 1000;
				} elseif ($v_one_unit == "7") {
					$convert4 = $velocity_one * 1609.3;
				} elseif ($v_one_unit == "8") {
					$convert4 = $velocity_one * 0.00508;
				} elseif ($v_one_unit == "9") {
					$convert4 = $velocity_one * 0.016667;
				}
				if ($convert4 > $convert1) {
					$t = (($convert4 - $convert1) / $convert);
					$h = (($convert1 * $t) + (0.5 * $convert * ($t * $t)));
					$this->param['answer5'] = $t;
					$this->param['answer6'] = $h;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Time of Fall Should Have a Positive Value.Height should have a positive value';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
	}

	//Scale Factor Calculator
	function scale($request)
	{
		$scaled_length = $request->scaled_length;
		$scaled_length_unit = $request->scaled_length_unit;
		$real_length = $request->real_length;
		$real_length_unit = $request->real_length_unit;
		$choice = $request->choice;
		$y1 = $request->y1;
		$y2 = $request->y2;
		
		function calculate($a, $b)
		{
			if ($b == "ft") {
				$convert = $a * 304.8;
			} elseif ($b == "in") {
				$convert = $a * 25.4;
			} elseif ($b == "yd") {
				$convert = $a * 914.4;
			} elseif ($b == "cm") {
				$convert = $a * 10;
			} elseif ($b == "m") {
				$convert = $a * 1000;
			} elseif ($b == "mm") {
				$convert = $a * 1;
			} elseif ($b == "km") {
				$convert = $a * 1000000 ;
			} elseif ($b == "mi") {
				$convert = $a * 1609344;
			}
			return $convert;
		}

		function calculate2($a, $b)
		{
			if ($b == "ft") {
				$convert2 = $a * 304.8;
			} elseif ($b == "in") {
				$convert2 = $a * 25.4;
			} elseif ($b == "yd") {
				$convert2 = $a * 914.4;
			} elseif ($b == "cm") {
				$convert2 = $a * 10;
			} elseif ($b == "m") {
				$convert2 = $a * 1000;
			} elseif ($b == "mm") {
				$convert2 = $a * 1;
			} elseif ($b == "km") {
				$convert2 = $a * 1000000 ;
			} elseif ($b == "mi") {
				$convert2 = $a * 1609344;
			}
			return $convert2;
		}

		function answer1($val1, $val1_unit, $val2, $val2_unit)
		{
			$v1 = calculate($val1, $val1_unit);
			$v2 = calculate($val2, $val2_unit);
			if ($v2 >= $v1) {
				$v3 = $v2 / $v1;
				$v4 = $v2 / $v2;
				$v5 = $v4 . ":" . $v3;
				$v6 = $v4 / $v3;
			} elseif ($v1 >= $v2) {
				$v3 = $v1 / $v2;
				$v4 = $v1 / $v1;
				$v5 = $v3 . ":" . $v4;
				$v6 = $v3 / $v4;
			}
			return array($v5, $v6);
		}

		function calculate33($a, $b)
		{
			if ($b == "ft") {
				$convert2 = $a * 1;
			} elseif ($b == "in") {
				$convert2 = $a * 12;
			} elseif ($b == "yd") {
				$convert2 = $a / 0.333333;
			} elseif ($b == "cm") {
				$convert2 = $a * 30.48;
			} elseif ($b == "m") {
				$convert2 = $a / 3.281;
			} elseif ($b == "mm") {
				$convert2 = $a * 1304.8;
			} elseif ($b == "km") {
				$convert2 = $a / 3281 ;
			} elseif ($b == "mi") {
				$convert2 = $a / 5280;
			}
			return $convert2;
		}


		if($choice == '1'){
			if (is_numeric($scaled_length) && is_numeric($real_length) && $scaled_length > 0 && $real_length > 0) {
				$ch = answer1(
					$scaled_length,
					$scaled_length_unit,
					$real_length,
					$real_length_unit
				);
				$this->param['v5'] = $ch[0];
				$this->param['v6'] = $ch[1];
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}elseif($choice == '2'){
			if (is_numeric($y1) && is_numeric($y2) && is_numeric($real_length) ) {
				$z = $y1 / $y2;
				$answer = $z * $real_length;
				$this->param['answer'] = $answer;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}else{
			if (is_numeric($y1) && is_numeric($y2) && is_numeric($real_length) ) {
				$z = $y1 / $y2;
				$answer = $real_length / $z;
				$this->param['answer'] = $answer;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
	}
	
	//Dew Point Calculator
	public function dew($request)
	{
		$to_cal = $request->to_cal;
		$temp = $request->temp;
		$temp_unit = $request->temp_unit;
		$hum = $request->hum;
		$dew = $request->dew;
		$dew_unit = $request->dew_unit;

		if ($temp_unit == "°C") {
			$temp_unit = 1;
		} else if ($temp_unit == "°F") {
			$temp_unit = 2;
		} else if ($temp_unit == "K") {
			$temp_unit = 3;
		}

		if ($dew_unit == "°C") {
			$dew_unit = 1;
		} else if ($dew_unit == "°F") {
			$dew_unit = 2;
		} else if ($dew_unit == "K") {
			$dew_unit = 3;
		}


		$a = 17.62;
		$b = 243.12;
		if ($to_cal === '1') {
			if (is_numeric($temp) && is_numeric($hum)) {
				if ($temp_unit === '2') {
					$temp = ($temp - 32) * 5 / 9;
				} elseif ($temp_unit === '3') {
					$temp = ($temp) - 273.15;
				}
				if ($temp < -45) {
					$this->param['error'] = 'Temperature should be greater than or equal to -45 °C (-49 °F)';
					return $this->param;
				} else {
					$afun = log($hum / 100) + ($a * $temp / ($b + $temp));
					$dp = ($b * $afun) / ($a - $afun);
					$this->param['dew'] = $dp;
					$this->param['RESULT'] = 1;
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($to_cal == '2') {
			if (is_numeric($dew) && is_numeric($temp)) {
				if ($temp_unit === '2') {
					$temp = ($temp - 32) * 5 / 9;
				} elseif ($temp_unit === '3') {
					$temp = ($temp) - 273.15;
				}
				if ($dew_unit === '2') {
					$dew = ($dew - 32) * 5 / 9;
				} elseif ($dew_unit === '3') {
					$dew = ($dew) - 273.15;
				}
				
				if ($temp < -45) {
					$this->param['error'] = 'Temperature should be greater than or equal to -45 °C (-49 °F)';
					return $this->param;
				}
				if ($dew < -45) {
					$this->param['error'] = 'Temperature should be greater than or equal to -45 °C (-49 °F)';
					return $this->param;
				}
				$rh_numer = 100.0 * exp(($a * $dew) / ($dew + $b));
				$rh_denom = exp(($a * $temp) / ($temp + $b));
				$hum = $rh_numer / $rh_denom;
				$this->param['hum'] = $hum;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($to_cal == '3') {
			if (is_numeric($hum) && is_numeric($dew)) {
				if ($dew_unit === '2') {
					$dew = ($dew - 32) * 5 / 9;
				} elseif ($dew_unit === '3') {
					$dew = ($dew) - 273.15;
				}
				if ($dew < -45) {
					$this->param['error'] = 'Temperature should be greater than or equal to -45 °C (-49 °F)';
					return $this->param;
				}
				$gamma = ($a * $dew) / ($b + $dew);
				$temp_numer = $b * ($gamma - log($hum / 100.0));
				$temp_denom = $a + log($hum / 100.0) - $gamma;
				$temp = $temp_numer / $temp_denom;
				$this->param['temp'] = $temp;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
	}
	//Wet Bulb Calculator
	function wet($request)
	{
		$temp = $request->temp;
		$temp_unit = $request->temp_unit;
		$temp1 = $request->temp1;
		$temp1_unit = $request->temp1_unit;
		$hum = $request->hum;


		if ($temp_unit == "°C") {
			$temp_unit = 1;
		} else if ($temp_unit == "°F") {
			$temp_unit = 2;
		} else if ($temp_unit == "K") {
			$temp_unit = 3;
		}

		if ($temp1_unit == "°C") {
			$temp1_unit = 1;
		} else if ($temp1_unit == "°F") {
			$temp1_unit = 2;
		} else if ($temp1_unit == "K") {
			$temp1_unit = 3;
		}


		if (is_numeric($temp) && is_numeric($hum)) {
			if ($temp_unit == '2') {
				$temp = ($temp - 32) * 5 / 9;
			} elseif ($temp_unit == '3') {
				$temp = ($temp) - 273.15;
			}
			if ($temp < -20 || $temp > 50) {
				$this->param['error'] = 'This calculator is only work for temperatures between -20 °C and 50 °C.';
				return $this->param;
			}
			$ans = $temp * atan(0.151977 * pow(($hum + 8.313659), (1 / 2))) + atan($temp + $hum) - atan($hum - 1.676331) + 0.00391838 * pow(($hum), (3 / 2)) * atan(0.023101 * $hum) - 4.686035;
			$indoor = 0.7 * $ans + 0.3 * $temp;
			if (is_numeric($temp1)) {
				if ($temp1_unit === '2') {
					$temp1 = ($temp1 - 32) * 5 / 9;
				} elseif ($temp1_unit === '3') {
					$temp1 = ($temp1) - 273.15;
				}
				$outdoor = 0.7 * $ans + 0.2 * $temp1 + 0.1 * $temp;
				$this->param['outdoor'] = $outdoor;
			}
			$this->param['ans'] = $ans;
			$this->param['indoor'] = $indoor;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	//Power To Weight Ratio Calculator
	function power($request)
	{
		// dd($request->all());
		$power = $request->power;
		$power_unit = $request->power_unit;
		$weight = $request->weight;
		$weight_unit = $request->weight_unit;

		function convert_power($a, $b)
		{
			if ($a = "w") {
				$convert = $b * 0.001;
			} else if ($a = "kw") {
				$convert = $b * 1;
			} else if ($a = "hpl") {
				$convert = $b * 0.7457;
			} else if ($a = "hpm") {
				$convert = $b * 0.7355;
			} else if ($a = "js") {
				$convert = $b * 0.001;
			} else if ($a = "kjs") {
				$convert = $b * 1;
			} else if ($a = "nms") {
				$convert = $b * 0.001;
			}
			return $convert;
		}
		function convert_weight($c, $d)
		{
			if ($c == "kg") {
				$convert2 = $d * 1;
			} else if ($c = "g") {
				$convert2 = $d * 0.001;
			} else if ($c = "t") {
				$convert2 = $d * 1000;
			} else if ($c = "lb") {
				$convert2 = $d * 0.4536;
			} else if ($c = "oz") {
				$convert2 = $d * 0.02835;
			} else if ($c = "us") {
				$convert2 = $d * 907.2;
			} else if ($c = "long") {
				$convert2 = $d * 1016;
			} else if ($c = "mg") {
				$convert2 = $d * 0.000001;
			} else if ($c == "gr") {
				$convert2 = $d * 0.00006479891;
			}
			return $convert2;
		}
		if (is_numeric($power) && is_numeric($weight)) {
			$power_value = convert_power($power_unit, $power);
			$weight_value = convert_weight($weight_unit, $weight);
			$power_weight_formula = $power_value / $weight_value;
			$this->param['answer'] = $power_weight_formula;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/*******************
        speed distance time Calculator
	 *******************/
	public function speed($request)
	{
		$operations = $request->operations;
		$first = $request->first;
		$second = $request->second;
		$third = $request->third;
		$f_unit = $request->f_unit;
		$s_unit = $request->s_unit;
		$t_unit = $request->t_unit;

		function distance($a, $b)
		{
			if ($b == "inch") {
				$ins = $a / 39.37;
			} elseif ($b == "foot") {
				$ins = $a / 3.281;
			} elseif ($b == "yard") {
				$ins = $a / 1.094;
			} elseif ($b == "mile") {
				$ins = $a * 1609;
			} elseif ($b == "centimeter") {
				$ins = $a / 100;
			} elseif ($b == "meter") {
				$ins = $a * 1;
			} elseif ($b == "kilometer") {
				$ins = $a * 1000;
			} elseif ($b == "nautical mile") {
				$ins = $a * 1852;
			}
			return $ins;
		}
		function time2($x, $y)
		{
			if ($y = "year") {
				$tim = $x * 31540000;
			} elseif ($y = "day") {
				$tim = $x * 86400;
			} elseif ($y = "hour") {
				$tim = $x * 3600;
			} elseif ($y = "minute") {
				$tim = $x * 60;
			} elseif ($y = "second") {
				$tim = $x * 1;
			}
			// elseif ($y=="hhmmss") {
			//     // $tim=$x / 1609; 
			// }
			return $tim;
		}
		function speed($w, $t)
		{
			if ($t == "inch per second") {
				$sp = $w / 39.37;
			} elseif ($t == "inch per minute") {
				$sp = $w * 0.000423333;
			}
			// elseif ($t=="inch per hour") {
			//     $sp=$w / 1760;   
			// }
			elseif ($t == "foot per second") {
				$sp = $w * 0.3048;
			} elseif ($t == "foot per minute") {
				$sp = $w * 0.00508;
			} elseif ($t == "foot per hour") {
				$sp = $w * 0.0000846667;
			} elseif ($t == "yard per second") {
				$sp = $w * 0.9144;
			} elseif ($t == "yard per minute") {
				$sp = $w * 0.01524;
			} elseif ($t == "yard per hour") {
				$sp = $w * 0.000254;
			} elseif ($t == "centimeter per second") {
				$sp = $w * 0.01;
			} elseif ($t == "centimeter per minute") {
				$sp = $w * 0.0001667;
			} elseif ($t == "meter per second") {
				$sp = $w * 1;
			} elseif ($t == "meter per minute") {
				$sp = $w * 0.01667;
			} elseif ($t == "meter per hour") {
				$sp = $w * 0.0002777778;
			} elseif ($t == "mile per second") {
				$sp = $w * 1609.344;
			} elseif ($t == "mile per minute") {
				$sp = $w * 26.8224;
			} elseif ($t == "mile per hour") {
				$sp = $w * 0.44704;
			} elseif ($t == "kilometer per second") {
				$sp = $w * 1000;
			}
			// elseif ($t=="kilometer per minute") {
			//     $sp=$w / 1760;   
			// }
			elseif ($t == "kilometer per hour") {
				$sp = $w * 0.2777778;
			} elseif ($t == "knot (nautical mi/h)") {
				$sp = $w * 0.5144444;
			}
			return $sp;
		}
		if ($operations == "3") {
			if ($t_unit == "hhmmss") {
				if (is_numeric($second) && !empty($third)) {
					$first = speed($first, $f_unit);
					$second = distance($second, $s_unit);
					if ($third != 0) {
						$pace = explode(':', $third);
						$pace_check = true;
						foreach ($pace as $key => $value) {
							if (!is_numeric($value)) {
								$pace_check = false;
							}
						}
						if ($pace_check == false) {
							$this->param['error'] = 'Please fill all fields.';
							return $this->param;
						} else if ($pace_check == true) {
							if (count($pace) === 3) {
								$hour = $pace[0];
								$min = $pace[1];
								$sec = $pace[2];
								$tsec = ($hour * 60 * 60) + ($min * 60) + $sec;
							} elseif (count($pace) === 2) {
								$min = $pace[0];
								$sec = $pace[1];
								$tsec = ($min * 60) + $sec;
							} elseif (count($pace) === 1) {
								$sec = $pace[0];
								$tsec = $sec;
							}
							$answer = $second / $tsec;
							$select = $operations;
						}
					} else {
						$this->param['error'] = 'Time cannot be 0.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else {
				if (is_numeric($second) && is_numeric($third)) {
					$first = speed($first, $f_unit);
					$second = distance($second, $s_unit);
					$third = time2($third, $t_unit);
					if ($third != 0) {
						$answer = $second / $third;
						$select = $operations;
					} else {
						$this->param['error'] = 'Time cannot be 0.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please check your input';
					return $this->param;
				}
			}
		} else if ($operations == "4") {
			if (is_numeric($first) && is_numeric($third)) {
				$first = speed($first, $f_unit);
				// $second=distance($second,$s_unit);
				$third = time2($third, $t_unit);
				$answer = $first * $third;
				$select = $operations;
			} else {
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		} else if ($operations == "5") {
			if (is_numeric($first) && is_numeric($second)) {
				$first = speed($first, $f_unit);
				$second = distance($second, $s_unit);
				// $third=time2($third,$t_unit);
				if ($first != 0) {
					$answer = $second / $first;
					$clock = round($answer);
					$time_show = sprintf('%02d:%02d:%02d', ($clock / 3600), ($clock / 60 % 60), $clock % 60);
					$hours = sprintf('%02d', ($clock / 3600));
					$min = sprintf('%02d', ($clock / 60 % 60));
					$sec = sprintf('%02d', ($clock % 60));
					$select = $operations;
					$this->param['time_show'] = $time_show;
					$this->param['hours'] = $hours;
					$this->param['min'] = $min;
					$this->param['sec'] = $sec;
				} else {
					$this->param['error'] = 'Please check your input';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! check your input.';
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['select'] = $select;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
        Constant of Proportionality Calculator
	 *******************/
	function constant($request)
	{
		$y = trim($request->y);
		$x = trim($request->x);
		if (is_numeric($y) && is_numeric($x)) {
			$this->param['ans'] = round($y / $x, 5);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}
	/*******************
        Quarter Mile Calculator
	 *******************/
	function quarter($request)
	{
		$equation = $request->equation;
		$weight = $request->weight;
		$weight_unit = $request->weight_unit;
		$power = $request->power;
		$power_unit = $request->power_unit;
		$sample_unit = $request->sample_unit;
		$trap = $request->trap;
		$et = $request->et;
		$selection = $request->selection;

		function weight($unit, $value)
		{
			if ($unit = "(kg)") {
				$value1 = $value * 2.2046;
			} else if ($unit = "(t)") {
				$value1 = $value * 2204.6;
			} else if ($unit = "(lb)") {
				$value1 = $value * 1;
			} else if ($unit = "4") {
				$value1 = $value * 2000;
			} else if ($unit = "5") {
				$value1 = $value * 2240;
			}
			return $value1;
		}
		function power($unit2, $value2)
		{
			if ($unit2 = "watts (W)") {
				$value3 = $value2 * 0.001341;
			} else if ($unit2 = "kilowatts (kW") {
				$value3 = $value2 * 1.341;
			} else if ($unit2 = "megawatts (mW)") {
				$value3 = $value2 * 0.0007457;
			} else if ($unit2 = "mechanical horsepowers hp (l)") {
				$value3 = $value2 * 1;
			} else if ($unit2 = "metric horsepowers hp (M)") {
				$value3 = $value2 * 0.9863;
			}
			return $value3;
		}

		if ($equation == "1") { //Huntington
			if ($selection == "1") { //Find Trap Speed and Elapsed Time
				if (is_numeric($weight) && is_numeric($power)) {
					$w_value = weight($weight_unit, $weight);
					$p_value = power($power_unit, $power);
					$elapsed_time = 6.290 * pow($w_value / $p_value, 1 / 3);
					$trap_speed = 224 * pow($p_value / $w_value, 1 / 3);
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection == "2") { //Find PowerHorse and Elapsed Time
				if (is_numeric($weight) && is_numeric($trap)) {
					$trap_value = $trap / 224;
					$w_value = weight($weight_unit, $weight);
					$weight_value = pow($trap_value, 3) * $w_value;
					$elapsed_time = 6.269 * pow($w_value / $weight_value, 1 / 3);
					$this->param['elapsed_time'] = $elapsed_time;
					$this->param['final_value'] = $weight_value;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection == "3") { //Find PowerHorse and Trap speed
				if (is_numeric($weight) && is_numeric($et)) {
					$trap_value = $et / 6.290;
					$w_value = weight($weight_unit, $weight);
					$weight_value = $w_value / pow($trap_value, 3);
					$trap_speed = 224 * pow($weight_value / $w_value, 1 / 3);
					$this->param['final_value'] = $weight_value;
					$this->param['trap_speed'] = $trap_speed;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}

			$this->param['elapsed_time'] = @$elapsed_time;
			$this->param['trap_speed'] = @$trap_speed;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else if ($equation == "2") {
			if ($selection == "1") {
				if (is_numeric($weight) && is_numeric($power)) { //Calculate Elapsed Time and Trap Speed
					$w_value = weight($weight_unit, $weight);
					$p_value = power($power_unit, $power);
					$elapsed_time = 6.269 * pow($w_value / $p_value, 1 / 3);
					$trap_speed = 230 * pow($p_value / $w_value, 1 / 3);
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection == "2") { //Find PowerHorse && Elapsed Time
				if (is_numeric($weight) && is_numeric($trap)) {
					$trap_value = $trap / 230;
					$w_value = weight($weight_unit, $weight);
					$weight_value = pow($trap_value, 3) * $w_value;
					$elapsed_time = 6.269 * pow($w_value / $weight_value, 1 / 3);
					$this->param['elapsed_time'] = $elapsed_time;
					$this->param['final_value'] = $weight_value;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection == "3") { //Find PowerHorse
				if (is_numeric($weight) && is_numeric($et)) {
					$trap_value = $et / 6.269;
					$w_value = weight($weight_unit, $weight);
					$weight_value = $w_value / pow($trap_value, 3);
					$trap_speed = 230 * pow($weight_value / $w_value, 1 / 3);
					$this->param['final_value'] = $weight_value;
					$this->param['trap_speed'] = $trap_speed;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
			$this->param['elapsed_time'] = @$elapsed_time;
			$this->param['trap_speed'] = @$trap_speed;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else if ($equation == "3") {
			if ($selection == "1") { //Calculate Elapsed Time and Power
				if (is_numeric($weight) && is_numeric($power)) {
					if ($sample_unit = "kilowatts (kW)") { //Wheel horsepower
						$w_value = weight($weight_unit, $weight);
						$p_value = power($power_unit, $power);
						$elapsed_time = 5.825 * pow($w_value / $p_value, 1 / 3);
						$trap_speed = 246 * pow($p_value / $w_value, 1 / 3);
					} else if ($sample_unit = "megawatts (mW)") { //Flywheel horsepower
						$w_value = weight($weight_unit, $weight);
						$p_value = power($power_unit, $power);
						$elapsed_time = 5.825 * pow($w_value / ($p_value * .89), 1 / 3);
						$trap_speed = 246 * pow(($p_value * .89) / $w_value, 1 / 3);
					}
					$one_eight = ($elapsed_time * .695 - .22);
					$sixty = ($elapsed_time * .138 + .17);
					$this->param['one_eight'] = $one_eight;
					$this->param['sixty'] = $sixty;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection == "2") { //Find HorsePower
				if (is_numeric($weight) && is_numeric($trap)) {
					$w_value = weight($weight_unit, $weight);
					$trap_value = $trap / 234;
					$weight_value = pow($trap_value, 3) * $w_value;
					$elapsed_time = 5.825 * pow($w_value / $weight_value, 1 / 3);
					$this->param['elapsed_time'] = $elapsed_time;
					$this->param['final_value'] = $weight_value;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection == "3") { //Find HorsePower
				if (is_numeric($weight) && is_numeric($et)) {
					$w_value = weight($weight_unit, $weight);
					$trap_value = $et / 5.825;
					$weight_value = $w_value / pow($trap_value, 3);
					$trap_speed = 246 * pow($weight_value / $w_value, 1 / 3);
					$this->param['trap_speed'] = $trap_speed;
					$this->param['final_value'] = $weight_value;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
			$this->param['elapsed_time'] = @$elapsed_time;
			$this->param['trap_speed'] = @$trap_speed;
			$this->param['RESULT'] = 1;

			return $this->param;
		}
	}
	/*******************
        Quarter Mile Calculator
	 *******************/
	function friction($request)
	{
		$calculate = $request->calculate;
		$fr_co = $request->fr_co;
		$force = $request->force;
		$force_unit = $request->force_unit;
		$fr = $request->fr;
		$fr_unit = $request->fr_unit;
		$mass = $request->mass;
		$plane = $request->plane;
		$gravity = $request->gravity;

		function friction_unit($unit, $value)
		{
			if ($unit == "N") {
				$value3 = $value * 1;
			} else if ($unit == "kN") {
				$value3 = $value * 1000;
			} else if ($unit == "MN") {
				$value3 = $value * 1000000;
			} else if ($unit == "GN") {
				$value3 = $value * 1000000000;
			} else if ($unit == "TN") {
				$value3 = $value * 1000000000000;
			}
			return $value3;
		}
		if ($calculate == "1") { //Calculate Friction Coefficient
			if (is_numeric($force) && is_numeric($fr) && $force > 0 && $fr > 0) {
				$fr_value = friction_unit($fr_unit, $fr);
				$force_value = friction_unit($force_unit, $force);
				$friction_coefficient = $fr_value / $force_value;
				$this->param['friction_coefficient'] = $friction_coefficient;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "2") { //Calculate Normal Force
			if (is_numeric($fr) && is_numeric($fr_co) && $fr > 0 && $fr_co > 0) {
				$force_value = friction_unit($fr_unit, $fr);
				$calculate_force = $force_value / $fr_co;
				$this->param['calculate_force'] = $calculate_force;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "3") { //Friction
			if (is_numeric($force) && is_numeric($fr_co) && $force > 0 && $fr_co > 0) {
				$force_value = friction_unit($force_unit, $force);
				$friction = $force_value * $fr_co;
				$this->param['friction'] = $friction;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "4") {
			if (is_numeric($mass) && is_numeric($plane) && is_numeric($fr_co) && is_numeric($gravity) && $mass > 0) {
				if ($fr_co > 0 && $fr_co < 1) {
					$read = cos(deg2rad($plane));
					$force_value = $fr_co * $mass * $gravity * $read;
					$this->param['friction2'] = $force_value;
				} else {
					$this->param['error'] = 'Please ! Coefficient of fraction should be in the range between 0 and 1';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	/*******************
        Coulomb's Law Calculator
	 *******************/
	function coulombs($request)
	{
		$selection1 = $request->selection1;
		$selection2 = $request->selection2;
		$charge_one = $request->charge_one;
		$charge_one_unit = $request->charge_one_unit;
		$charge_two = $request->charge_two;
		$charge_two_unit = $request->charge_two_unit;
		$distance = $request->distance;
		$distance_unit = $request->distance_unit;
		$force = $request->force;
		$force_unit = $request->force_unit;
		$constant = $request->constant;
		$choose = $request->choose;
		$charge_three = $request->charge_three;
		$charge_three_unit = $request->charge_three_unit;

		function force_convert($unit,$value){
			if($unit=="mN"){
				$val1=$value*0.001;
			}else if($unit=="N"){
				$val1=$value*1;
			}else if($unit=="kN"){
				$val1=$value*1000;
			}else if($unit=="MN"){
				$val1=$value*1000000;
			}else if($unit=="GN"){
				$val1=$value*1000000000;
			}else if($unit=="TN"){
				$val1=$value*1000000000000;
			}else if($unit=="pdl"){
				$val1=$value*0.138255;
			}else if($unit=="lbf"){
				$val1=$value*4.44822;
			}
			return $val1;
		}
		function charge_convert($unit2,$value2){
			if($unit2=="pC"){
				$val2=$value2*0.000000000001;
			}else if($unit2=="nC"){
				$val2=$value2*0.000000001;
			}else if($unit2=="μC"){
				$val2=$value2*0.000001;
			}else if($unit2=="mC"){
				$val2=$value2*0.001;
			}else if($unit2=="C"){
				$val2=$value2*1;
			}else if($unit2=="e"){
				$val2=$value2*1000000000000;
			}else if($unit2=="Ah"){
				$val2=$value2*3600;
			}else if($unit2=="mAh"){
				$val2=$value2*3.6;
			}
			return $val2;	
		}
		function distance_convert($unit3,$value3){
			
			if($unit3=="nm"){
				$val3=$value3*0.000000001;
			}else if($unit3=="μm"){
				$val3=$value3*0.000001;
			}else if($unit3=="mm"){
				$val3=$value3*0.001;
			}else if($unit3=="cm"){
				$val3=$value3*0.01;
			}else if($unit3=="m"){
				$val3=$value3*1;
			}else if($unit3=="km"){
				$val3=$value3*1000;
			}else if($unit3=="in"){
				$val3=$value3*0.0254;
			}else if($unit3=="ft"){
				$val3=$value3*0.3048;
			}else if($unit3=="yd"){
				$val3=$value3*0.9144;
			}
			return $val3;
		}
		$brendon = $constant * 1000000000;
		if ($choose == "1") {
			if ($selection2 == "1") { //Find Force
				if (is_numeric($charge_three) && is_numeric($distance) && is_numeric($constant)) {
					if ($distance > 0) {
						$charge_three_value = charge_convert($charge_three_unit, $charge_three);
						$distance_value = distance_convert($distance_unit, $distance);
						$force = $brendon * ($charge_three_value * $charge_three_value) / ($distance_value * $distance_value);
						$this->param['force'] = $force;
					} else {
						$this->param['error'] = 'Distance must be a positive value greater than 0';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection2 == "2") { //Find Charge 
				if (is_numeric($force) && is_numeric($constant) && is_numeric($distance)) {
					if ($distance > 0) {
						$force_value = force_convert($force_unit, $force);
						$distance_value = distance_convert($distance_unit, $distance);
						$charge = ($force_value * $distance_value * $distance_value) / ($brendon);
						$charging = sqrt($charge);
						$this->param['charging'] = $charging;
					} else {
						$this->param['error'] = 'Distance must be a positive value greater than 0';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection2 == "3") { //distance
				if (is_numeric($force) && is_numeric($constant) && is_numeric($charge_three)) {
					$force_value = force_convert($force_unit, $force);
					$charge_three_value = charge_convert($charge_three_unit, $charge_three);
					$distance = $brendon * ($charge_three_value * $charge_three_value) / ($force_value);
					$distancing = sqrt($distance);
					$this->param['distancing'] = $distancing;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
		} else if ($choose == "2") {
			if ($selection1 == "1") { //Find Force
				if (is_numeric($charge_one) && is_numeric($charge_two) && is_numeric($constant) && is_numeric($distance)) {
					if ($distance > 0) {
						$charge_one_value = charge_convert($charge_one_unit, $charge_one);
						$charge_two_value = charge_convert($charge_two_unit, $charge_two);
						$distance_value = distance_convert($distance_unit, $distance);
						$force = $brendon * ($charge_one_value * $charge_two_value) / ($distance_value * $distance_value);
						$this->param['force'] = $force;
					} else {
						$this->param['error'] = 'Distance must be a positive value greater than 0';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection1 == "2") { //Find Charge One
				if (is_numeric($force) && is_numeric($charge_two) && is_numeric($constant) && is_numeric($distance)) {
					$method = 1;
					if ($distance > 0) {
						$charge_two_value = charge_convert($charge_two_unit, $charge_two);
						$force_value = force_convert($force_unit, $force);
						$distance_value = distance_convert($distance_unit, $distance);
						$chargo = ($force_value * $distance_value * $distance_value) / ($brendon * $charge_two_value);
						$this->param['charge_one'] = $chargo;
						$this->param['method'] = 1;
					} else {
						$this->param['error'] = 'Distance must be a positive value greater than 0';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection1 == "3") { //Find Charge Two
				if (is_numeric($force) && is_numeric($charge_one) && is_numeric($constant) && is_numeric($distance)) {
					if ($distance > 0) {
						$charge_one_value = charge_convert($charge_one_unit, $charge_one);
						$force_value = force_convert($force_unit, $force);
						$distance_value = distance_convert($distance_unit, $distance);
						$chargo = ($force_value * $distance_value * $distance_value) / ($brendon * $charge_one_value);
						$this->param['charge_one'] = $chargo;
						$this->param['method'] = 2;
					} else {
						$this->param['error'] = 'Distance must be a positive value greater than 0';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($selection1 == "4") { //Find Distance
				if (is_numeric($force) && is_numeric($charge_one) && is_numeric($constant) && is_numeric($charge_two)) {
					$charge_one_value = charge_convert($charge_one_unit, $charge_one);
					$charge_two_value = charge_convert($charge_two_unit, $charge_two);
					$force_value = force_convert($force_unit, $force);
					$distance = $brendon * ($charge_one_value * $charge_two_value) / ($force_value);
					$distancing = sqrt($distance);
					$this->param['distancing'] = $distancing;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	/*******************
         Gravitational Force Calculator
	 *******************/
	function gravity($request)
	{
		
		$calculate = $request->calculate;
		$mass_one = $request->mass_one;
		$mass_one_unit = $request->mass_one_unit;
		$mass_two = $request->mass_two;
		$mass_two_unit = $request->mass_two_unit;
		$gravitational_force = $request->gravitational_force;
		$gravitational_force_unit = $request->gravitational_force_unit;
		$distance = $request->distance;
		$distance_unit = $request->distance_unit;
		$constant = $request->constant;
		$latitude = $request->latitude;
		$height = $request->height;
		$height_unit = $request->height_unit;

		function distance_converts($unit3, $value3)
		{
			if ($unit3 == "nm") {
				$val3 = $value3 * 0.000000001;
			} else if ($unit3 == "μm") {
				$val3 = $value3 * 0.000001;
			} else if ($unit3 == "mm") {
				$val3 = $value3 * 0.001;
			} else if ($unit3 == "cm") {
				$val3 = $value3 * 0.01;
			} else if ($unit3 == "m") {
				$val3 = $value3 * 1;
			} else if ($unit3 == "km") {
				$val3 = $value3 * 1000;
			} else if ($unit3 == "in") {
				$val3 = $value3 * 0.0254;
			} else if ($unit3 == "ft") {
				$val3 = $value3 * 0.3048;
			} else if ($unit3 == "yd") {
				$val3 = $value3 * 0.9144;
			}
			return $val3;
		}
		function mass_convert($unit2, $value2)
		{
			if ($unit2 == "g") {
				$val3 = $value2 * 0.001;
			} else if ($unit2 == "kg") {
				$val3 = $value2 * 1;
			} else if ($unit2 == "t") {
				$val3 = $value2 * 1000;
			} else if ($unit2 == "oz") {
				$val3 = $value2 * 0.0283495;
			} else if ($unit2 == "lb") {
				$val3 = $value2 * 0.453592;
			} else if ($unit2 == "stone") {
				$val3 = $value2 * 6.35029;
			} else if ($unit2 == "US ton") {
				$val3 = $value2 * 907.185;
			} else if ($unit2 == "Long ton") {
				$val3 = $value2 * 1016.047;
			} else if ($unit2 == "Earths") {
				$val3 = $value2 * 5972200000000000000000000;
			} else if ($unit2 == "Suns") {
				$val3 = $value2 * 1989000000000000000000000000000;
			} else if ($unit2 == "me") {
				$val3 = $value2 * 0;
			} else if ($unit2 == "mp") {
				$val3 = $value2 * 0;
			} else if ($unit2 == "mn") {
				$val3 = $value2 * 0;
			}
			return $val3;
		}
		function force_converts($unit, $value)
		{
			if ($unit == "mN") {
				$val1 = $value * 0.001;
			} else if ($unit == "N") {
				$val1 = $value * 1;
			} else if ($unit == "kN") {
				$val1 = $value * 1000;
			} else if ($unit == "MN") {
				$val1 = $value * 1000000;
			} else if ($unit == "GN") {
				$val1 = $value * 1000000000;
			} else if ($unit == "TN") {
				$val1 = $value * 1000000000000;
			} else if ($unit == "pdl") {
				$val1 = $value * 0.138255;
			} else if ($unit == "lbf") {
				$val1 = $value * 4.44822;
			}
			return $val1;
		}
		function height_u($unit4, $value4)
		{
			if ($unit4 == "ft") {
				$val10 = $value4 * 1;
			} else if ($unit4 == "m") {
				$val10 = $value4 * 3.28084;
			}
			return $val10;
		}
		$buttler = $constant * 0.00000000001;
		if ($calculate == "1") { //Find Gravitational force
			if (is_numeric($mass_one) && is_numeric($mass_two) && is_numeric($distance) && $mass_one > 0 && $mass_two > 0 && $distance > 0) {
				$mass_one_value = mass_convert($mass_one_unit, $mass_one);
				$mass_two_value = mass_convert($mass_two_unit, $mass_two);
				$distance_value = distance_converts($distance_unit, $distance);
				$calculate_force = ($buttler * $mass_one_value * $mass_two_value) / ($distance_value * $distance_value);
				$this->param['force'] = $calculate_force;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "2") { //Find mass 1
			if (is_numeric($mass_two) && is_numeric($distance) && is_numeric($gravitational_force) && $mass_two > 0 && $distance > 0) {
				$force_value = force_converts($gravitational_force_unit, $gravitational_force);
				$mass_two_value = mass_convert($mass_two_unit, $mass_two);
				$distance_value = distance_converts($distance_unit, $distance);
				$first_mass = ($force_value * $distance_value * $distance_value) / ($buttler * $mass_two_value);
				$this->param['first_mass'] = $first_mass;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "3") { //Find mass 2
			if (is_numeric($mass_one) && is_numeric($distance) && is_numeric($gravitational_force) && $mass_one > 0 && $distance > 0) {
				$force_value = force_converts($gravitational_force_unit, $gravitational_force);
				$mass_one_value = mass_convert($mass_one_unit, $mass_one);
				$distance_value = distance_converts($distance_unit, $distance);
				$second_mass = ($force_value * $distance_value * $distance_value) / ($buttler * $mass_one_value);
				$this->param['second_mass'] = $second_mass;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "4") { //Distance
			if (is_numeric($mass_one) && is_numeric($mass_two) && is_numeric($gravitational_force) && $mass_one > 0 && $mass_two > 0) {
				$force_value = force_converts($gravitational_force_unit, $gravitational_force);
				$mass_one_value = mass_convert($mass_one_unit, $mass_one);
				$mass_two_value = mass_convert($mass_two_unit, $mass_two);
				// dd($buttler,$mass_one_value,$mass_two_value,$force_value);
				$find_distance = ($buttler * $mass_one_value * $mass_two_value) / ($force_value);
				$this->param['distance'] = $find_distance;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "5") {
			if (is_numeric($latitude) && is_numeric($height)) {
				$height_value = height_u($height_unit, $height);
				$first_bracket = 0.0053024 * sin(pow(deg2rad($latitude), 2));
				$second_bracket = 0.0000058 * sin(pow(2 * deg2rad($latitude), 2));
				$IGF = 9.780327 * (1 + $first_bracket - $second_bracket);
				$FAC = -3.086 * 0.000001 * $height_value;
				$calculate_g = $IGF + $FAC;
				$this->param['g'] = $calculate_g;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		Solar Panel calculator
	 ************************/
	function solar($request)
	{
		$first = $request->first;
		$units1 = $request->units1;
		$operations1 = $request->operations1;
		$operations2 = $request->operations2;
		$operations3 = $request->operations3;
		$operations4 = $request->operations4;
		$second = $request->second;
		$third = $request->third;
		$four = $request->four;
		$five = $request->five;
		$units5 = $request->units5;
		$six = $request->six;
		$units6 = $request->units6;
		$seven = $request->seven;
		$units7 = $request->units7;

		function calculate1($a, $b)
		{
			if ($a == "yr") {
				$convert1 = $b * 1;
			} elseif ($a == "mon") {
				$convert1 = $b * 12;
			}
			return $convert1;
		}
		function calculate22($a, $b)
		{
			if ($a == "m²") {
				$times = $b * 1;
			} elseif ($a == "km²") {
				$times = $b * 1000000;
			} elseif ($a == "ft²") {
				$times = $b / 10.764;
			} elseif ($a == "yd²") {
				$times = $b /  1.196;
			} elseif ($a == "mi²") {
				$times = $b * 2590000;
			}
			return $times;
		}
		function calculate3($a, $b)
		{
			if ($a == "cm²") {
				$magr = $b / 10000;
			} elseif ($a == "m²") {
				$magr = $b * 1;
			} elseif ($a == "in²") {
				$magr = $b / 1550;
			} elseif ($a == "ft²") {
				$magr = $b /  10.764;
			}
			return $magr;
		}
		function calculate4($a, $b)
		{
			if ($a == "W") {
				$mahiya = $b * 1;
			} elseif ($a == "kW") {
				$mahiya = $b * 1000;
			}
			return $mahiya;
		}

		$first = calculate1($units1, $first);
		$five = calculate22($units5, $five);
		$six = calculate3($units6, $six);
		$seven = calculate4($units7, $seven);
		$DATA = [
			["Afghanistan (Kabul)", "3991871818", "5"],
			["Albania (Tirane)", "610081066", "4"],
			["Algeria (Algiers)", "3846714522", "4.3"],
			["Am. Samoa (Pago Pago)", "3469450532", "3.9"],
			["Andorra (Andorra la Vella)", "4235243971", "3.9"],
			["Angola (Luanda)", "2309985589", "4.3"],
			["Antigua and Barbuda (W. Indies)", "2798681724", "5"],
			["Argentina (Buenos Aires)", "3131707929", "4.5"],
			["Armenia (Yerevan)", "3031656872", "4.3"],
			["Aruba (Oranjestad)", "1000404369", "4.8"],
			["Australia (Canberra)", "1343256469", "4.5"],
			["Austria (Vienna)", "2566595460", "3.2"],
			["Azerbaijan (Baku)", "970496281", "3.8"],
			["Bahamas (Nassau)", "3661532231", "4.6"],
			["Bahrain (Manama)", "1607956302", "4.9"],
			["Bangladesh (Dhaka)", "3652811140", "3.8"],
			["Barbados (Bridgetown)", "3590402118", "4.8"],
			["Belarus (Minsk)", "3722655827", "2.9"],
			["Belgium (Brussels)", "1299554482", "2.9"],
			["Belize (Belmopan)", "256266363", "4.2"],
			["Benin (Porto-Novo)", "865682789", "3.8"],
			["Bhutan (Thimphu)", "3295512309", "4.1"],
			["Bolivia (La Paz)", "3386483712", "5.2"],
			["Bosnia and Herzegovina (Sarajevo)", "1254960087", "3.5"],
			["Botswana (Gaborone)", "674609032", "5"],
			["Brazil (Brasilia)", "1095373230", "4.5"],
			["British Virgin Islands (Road Town)", "2994264545", "4.6"],
			["Brunei Darussalam (Bandar Seri Begawan)", "2563478298", "4"],
			["Bulgaria (Sofia)", "3589381075", "3.7"],
			["Burkina Faso (Ouagadougou)", "833105926", "4.6"],
			["Burundi (Bujumbura)", "2732860778", "4.3"],
			["Cambodia (Phnom Penh)", "1414021081", "4.3"],
			["Cameroon (Yaounde)", "1831675825", "3.9"],
			["Canada", "1711396312", "3.2"],
			["Cape Verde (Praia)", "1149614655", "4.8"],
			["Cayman Islands (George Town)", "216077578", "4.6"],
			["Central African Republic (Bangui)", "2456381780", "4.3"],
			["Chad (N'Djamena)", "3698166179", "4.7"],
			["Chile (Santiago)", "3289191001", "4.8"],
			["China (Beijing)", "827779408", "3.7"],
			["Colombia (Bogota)", "1726653727", "3.9"],
			["Comros (Moroni)", "195680681", "4"],
			["Congo (Brazzaville)", "2289137567", "4"],
			["Congo (Kinshasa)", "2209700001", "3.8"],
			["Costa Rica (San Jose)", "2859341299", "4"],
			["Cote d'Ivoire (Yamoussoukro)", "1977815041", "3.9"],
			["Croatia (Zagreb)", "3003063492", "3.4"],
			["Cuba (Havana)", "4071425341", "4.5"],
			["Cyprus (Nicosia)", "204841218", "4.7"],
			["Czech Republic (Prague)", "996478966", "3"],
			["Denmark (Copenhagen)", "764509872", "2.9"],
			["Djibouti (Djibouti)", "329371752", "5"],
			["Dominica (Roseau)", "3292674871", "4.7"],
			["Dominica Republic (Santo Domingo)", "197838988", "4.4"],
			["East Timor (Dili)", "1431618658", "4.9"],
			["Ecuador (Quito)", "553239032", "4.5"],
			["Egypt (Cairo)", "1381863594", "4.9"],
			["El Salvador (San Salvador)", "1003348054", "4.8"],
			["Equatorial Guinea (Malabo)", "1047691502", "3.6"],
			["Eritrea (Asmara)", "2179093092", "5.4"],
			["Estonia (Tallinn)", "2514150519", "2.9"],
			["Ethiopia (Addis Ababa)", "3699252067", "4.6"],
			["Falkland Islands (Stanley)", "3740070421", "4"],
			["Faroe Islands (Torshavn)", "11434331", "2"],
			["Fiji (Suva)", "3207488962", "3.4"],
			["Finland (Helsinki)", "2606916439", "2.5"],
			["France (Paris)", "3023064619", "3.1"],
			["Gabon (Libreville)", "3968687439", "3.9"],
			["Gambia (Banjul)", "2171881135", "4.7"],
			["Georgia (Tbilisi)", "2710156945", "3.8"],
			["Germany (Berlin)", "1573821537", "2.9"],
			["Ghana (Accra)", "3843936568", "4.2"],
			["Greece (Athens)", "1301321358", "4.4"],
			["Greenland (Nuuk)", "2912615512", "2"],
			["Guadeloupe (Basse-Terre)", "2654694218", "3.6"],
			["Guatemala (Guatemala)", "1356714202", "4.5"],
			["Guernsey (St. Peter Port)", "1682628571", "3.2"],
			["Guiana (Cayenne)", "2606409875", "4.3"],
			["Guinea (Conakry)", "915998772", "4.3"],
			["Guinea-Bissau (Bissau)", "795049445", "4.5"],
			["Guyana (Georgetown)", "2009679134", "4.4"],
			["Haiti (Port-au-Prince)", "3095822688", "4.7"],
			["Heard and McDonald Islands()", "4221146578", "1.9"],
			["Honduras (Tegucigalpa)", "2347237514", "4.4"],
			["Hungary (Budapest)", "2362275024", "3.4"],
			["Iceland (Reykjavik)", "2052092450", "1.5"],
			["India (New Delhi)", "720672287", "4"],
			["Indonesia (Jakarta)", "1381773541", "3.7"],
			["Iran (Tehran)", "3133000988", "4.8"],
			["Iraq (Baghdad)", "3554251891", "4.6"],
			["Ireland (Dublin)", "2296089771", "2.6"],
			["Israel (Jerusalem)", "3556052957", "5.1"],
			["Italy (Rome)", "1276344126", "4.2"],
			["Jamaica (Kingston)", "3633754639", "4.7"],
			["Jordan (Amman)", "1034068660", "5.1"],
			["Kazakhstan (Astana)", "3076808606", "3.5"],
			["Kenya (Nairobi)", "722935436", "4.2"],
			["Kiribati (Tarawa)", "1002242718", "4.5"],
			["Kuwait (Kuwait)", "3048930687", "4.8"],
			["Kyrgyzstan (Bishkek)", "717666272", "4"],
			["Laos (Vientiane)", "136466098", "3.9"],
			["Latvia (Riga)", "1009138951", "2.9"],
			["Lebanon (Beirut)", "1374067137", "4.6"],
			["Lesotho (Maseru)", "2667881322", "5.1"],
			["Liberia (Monrovia)", "1968781200", "3.9"],
			["Libya (Tripoli)", "4257803592", "4.7"],
			["Liechtenstein (Vaduz)", "121291457", "3.2"],
			["Lithuania (Vilnius)", "3887877908", "2.8"],
			["Luxembourg (Luxembourg City)", "2989898092", "3"],
			["Macao, China (Macau)", "84436167", "3.4"],
			["Macedonia (Skopje)", "282587261", "3.8"],
			["Madagascar (Antananarivo)", "1607417683", "4.7"],
			["Malawi (Lilongwe)", "1077346167", "4.7"],
			["Malaysia (Kuala Lumpur)", "2556432463", "3.6"],
			["Maldives (Male)", "3520300004", "4.5"],
			["Mali (Bamako)", "2041362033", "4.6"],
			["Malta (Valletta)", "1973061101", "4.5"],
			["Martinique (Fort-de-France)", "2610122375", "4.6"],
			["Mauritania (Nouakchott)", "4152331390", "4.9"],
			["Mayotte (Mamoudzou)", "2884156795", "4.6"],
			["Mexico (Mexico City)", "1546145819", "5"],
			["Micronesia (Palikir)", "341419522", "3.6"],
			["Moldova (Chisinau)", "2987065369", "3.5"],
			["Mozambique (Maputo)", "3698439937", "4.3"],
			["Myanmar (Yangon)", "4045074134", "4"],
			["Namibia (Windhoek)", "787293352", "5.4"],
			["Nepal (Kathmandu)", "1673272026", "4.3"],
			["Netherlands (Amsterdam)", "1374142707", "2.9"],
			["Netherlands Antilles (Willemstad)", "450066022", "4.8"],
			["New Caledonia (Noumea)", "3460824970", "4.4"],
			["New Zealand (Wellington)", "3751197466", "3.6"],
			["Nicaragua (Managua)", "2257579921", "4.5"],
			["Niger (Niamey)", "3581953643", "4.6"],
			["Nigeria (Abuja)", "1504549367", "4.1"],
			["Norfolk Island (Kingston)", "3623646402", "4.2"],
			["North Korea (Pyongyang)", "2189793320", "3.9"],
			["Northern Mariana Islands (Saipan)", "895647190", "4.7"],
			["Norway (Oslo)", "201239791", "2.8"],
			["Oman (Muscat)", "220380149", "5"],
			["Pakistan (Islamabad)", "2664544349", "4.2"],
			["Palau (Koror)", "4072701490", "4"],
			["Panama (Panama City)", "4036959384", "3.9"],
			["Papua New Guinea (Port Moresby)", "3255397662", "4.4"],
			["Paraguay (Asuncion)", "1478565796", "4.3"],
			["Peru (Lima)", "3504549447", "3.9"],
			["Philippines (Manila)", "115412715", "3.8"],
			["Poland (Warsaw)", "1658193578", "3"],
			["Polynesia (Papeete)", "2148674221", "4.6"],
			["Portugal (Lisbon)", "3840916265", "4.4"],
			["Puerto Rico (San Juan)", "3137840658", "4.5"],
			["Qatar (Doha)", "4239190508", "4.8"],
			["Rawanda (Kigali)", "1892921828", "4.2"],
			["Romania (Bucharest)", "3434379517", "3.6"],
			["Russia(Moscow)", "3298823943", "2.9"],
			["Saint Kitts and Nevis (Basseterre)", "3521668174", "4.8"],
			["Saint Lucia (Castries)", "1125842730", "4.5"],
			["Saint Pierre and Miquelon (Saint-Pierre)", "2334458601", "3.1"],
			["Saint vincent and the Grenadines (Kingstown)", "3052485915", "4.8"],
			["Samoa (Apia)", "248727382", "4.3"],
			["San Marino (San Marino)", "3605759662", "3.8"],
			["Sao Tome and Principe (Sao Tome)", "1200290637", "3.2"],
			["Saudi Arabia (Riyadh)", "1663068746", "5.1"],
			["Senegal (Dakar)", "1652783615", "4.8"],
			["Serbia (Belgrade)", "892945963", "3.5"],
			["Sierra Leone (Freetown)", "2465024753", "4.1"],
			["Slovakia (Bratislava)", "1727188336", "3.3"],
			["Slovenia (Ljubljana)", "1318894682", "3.4"],
			["Solomon Islands (Honiara)", "1964117431", "4"],
			["Somalia (Mogadishu)", "4104232972", "4.9"],
			["South Africa (Pretoria)", "107408729", "4.9"],
			["South Korea (Seoul)", "3688100084", "3.8"],
			["Spain (Madrid)", "4228850213", "4.5"],
			["Sudan (Khartoum)", "2332764244", "4.9"],
			["Suriname (Paramaribo)", "2487072959", "4.2"],
			["Swaziland (Mbabane)", "2904932956", "4.4"],
			["Sweden (Stockholm)", "717713027", "2.9"],
			["Switzerland (Bern)", "2257415609", "3.5"],
			["Syria (Damascus)", "2035327206", "5.2"],
			["Tajikistan (Dushanbe)", "2206761006", "4.3"],
			["Tanzania (Dodoma)", "3399419241", "5"],
			["Thailand (Bangkok)", "1907461772", "3.9"],
			["Togo (Lome)", "178080526", "4.1"],
			["Tonga (Nuku'alofa)", "2771626202", "4"],
			["Tunisia (Tunis)", "3500410102", "4.3"],
			["Turkey (Ankara)", "3456977417", "4.2"],
			["Turkmenistan (Ashgabat)", "3070535762", "4.1"],
			["Tuvalu (Funafuti)", "2661233985", "4.1"],
			["Uganda (Kampala)", "2240997522", "4.2"],
			["Ukraine (Kiev)", "3697749896", "3.2"],
			["United Arab Emirates (Abu Dhabi)", "2636792982", "5"],
			["United Kingdom (London)", "3752346309", "2.8"],
			["Uruguay (Montevideo)", "4204565486", "4.3"],
			["US of Virgin Islands (Charlotte Amalie)", "2572039332", "4.7"],
			["USA", "4229717202", "4.6"],
			["Uzbekistan (Tashkent)", "2948553792", "4.2"],
			["Vanuatu (Port-Vila)", "679793930", "3.8"],
			["Venezuela (Caracas)", "1062949898", "4.4"],
			["Viet Nam (Hanoi)", "2678485620", "2.9"],
			["Zambia (Lusaka)", "3678211569", "4.9"],
			["Zimbabwe (Harare)", "2976182253", "4.9"],
		];
		$DATA_Canada = [
			["Alberta (Calgary)", "239695018", "4.1"],
			["Alberta (Edmonton)", "1192758017", "3.9"],
			["British Columbia (Nelson)", "3429941298", "3.1"],
			["British Columbia (Vancouver)", "818410939", "3.4"],
			["British Columbia (Victoria)", "385806281", "3.7"],
			["Manitoba (Winnipeg)", "2428951261", "4"],
			["New Brunswick (Fredericton)", "1842276924", "3.7"],
			["Newfoundland (St. John's)", "996453466", "3.1"],
			["Northwest Territories (Yellowknife)", "3629411594", "3.1"],
			["Nova Scotia (Halifax)", "271236675", "3.6"],
			["Nunavut (Iqaluit)", "312101358", "3"],
			["Ontario (Kingston)", "2143505671", "3.7"],
			["Ontario (London)", "324522438", "3.6"],
			["Ontario (Ottawa)", "1615532888", "3.8"],
			["Ontario (Toronto)", "3641369057", "3.7"],
			["Quebec (Montreal)", "3969240345", "3.7"],
			["Quebec (Quebec)", "3557161857", "3.7"],
			["Saskatchewan (Moose Jaw)", "3772090893", "4.2"],
			["Yukon (Whitehorse)", "1482142919", "2.5"],
		];
		$DATA_USA = [
			["Alaska (Anchorage)", "4135142354", "2.5"],
			["Alaska (Juneau)", "3567611943", "2.4"],
			["Alaska (Sitka)", "282885990", "2.5"],
			["Alabama (Birmingham)", "2935373997", "4.2"],
			["Alabama (Mobile)", "2957510412", "4.4"],
			["Alabama (Montgomery)", "4037531327", "4.3"],
			["Alaska (Nome)", "1605565051", "2.5"],
			["Arizona (Flagstaff)", "3326595849", "5.2"],
			["Arizona (Phoenix)", "4290516658", "5.2"],
			["Arkansas (Hot Springs)", "532292244", "4.1"],
			["California (El Centro)", "3961047602", "5.3"],
			["California (Fresno)", "973820569", "4.9"],
			["California (Long Beach)", "2539053497", "4.9"],
			["California (Los Angeles)", "2318008416", "5"],
			["California (Oakland)", "2489059847", "4.8"],
			["California (Sacramento)", "2638060327", "4.8"],
			["California (San Diego)", "2647141316", "4.9"],
			["California (San Francisco)", "406059073", "4.8"],
			["California (San Jose)", "4029578609", "4.9"],
			["Colorado (Denver)", "3687682113", "4.7"],
			["Colorado (Grand Junction)", "1335943443", "4.7"],
			["Connecticut (New Haven)", "36738583", "4"],
			["D.C. (Washington)", "3719346", "4"],
			["Florida (Jacksonville)", "3920459310", "4.4"],
			["Florida (Key West)", "2960020496", "4.8"],
			["Florida (Miami)", "1432328791", "4.5"],
			["Florida (Tampa)", "550749899", "4.6"],
			["Georgia (Atlanta)", "1664661147", "4.3"],
			["Georgia (Savannah)", "2937334420", "4.4"],
			["Hawaii (Honolulu)", "3766290767", "4.8"],
			["Idaho (Boise)", "2641863014", "4.3"],
			["Idaho (Idaho Falls)", "3493397125", "4.3"],
			["Idaho (Lewiston)", "1255609491", "3.9"],
			["Illinois (Chicago)", "1826265227", "3.8"],
			["Illinois (Springfield)", "2837119342", "4"],
			["Indiana (Indianapolis)", "2103264087", "3.9"],
			["Iowa (Des Moines)", "3656095951", "4"],
			["Iowa (Dubuque)", "2121687642", "3.9"],
			["Kansas (Wichita)", "2087743131", "4.4"],
			["Kentucky (Louisville)", "376431321", "3.9"],
			["Louisiana (New Orleans)", "1519673836", "4.3"],
			["Louisiana (Shreveport)", "1279592367", "4.2"],
			["Maine (Bangor)", "3308637761", "3.8"],
			["Maine (Eastport)", "3642634395", "3.7"],
			["Maine (Portland)", "3882219611", "3.9"],
			["Maryland (Baltimore)", "1032825865", "4"],
			["Massachusetts (Boston)", "3277586614", "4"],
			["Massachusetts (Springfield)", "479413252", "3.9"],
			["Michigan (Detroit)", "1899119109", "3.7"],
			["Michigan (Grand Rapids)", "3859683753", "3.6"],
			["Minnesota (Duluth)", "207643724", "3.8"],
			["Minnesota (Minneapolis)", "3651222668", "3.9"],
			["Mississippi (Jackson)", "2093733510", "4.2"],
			["Missouri (Kansas City)", "256734123", "4.2"],
			["Missouri (Springfield)", "4208371662", "4.2"],
			["Missouri (St. Louis)", "2756189513", "4"],
			["Montana (Havre)", "4287468968", "4.2"],
			["Montana (Helena)", "3777891619", "4"],
			["Nebraska (Lincoln)", "2762107793", "4.2"],
			["Nebraska (Omaha)", "3390856537", "4.1"],
			["Nevada (Las Vegas)", "1117405525", "5.2"],
			["Nevada (Reno)", "2555244568", "5"],
			["New Hampshire (Manchester)", "3992825310", "3.9"],
			["New Jersey (Newark)", "1217007721", "3.9"],
			["New Mexico (Albuquerque)", "1621290412", "5.2"],
			["New Mexico (Carlsbad)", "2415518855", "5.1"],
			["New Mexico (Santa Fe)", "2805863579", "5.1"],
			["New York (Albany)", "1340824682", "3.8"],
			["New York (Buffalo)", "754074823", "3.6"],
			["New York (New York)", "20791028", "3.9"],
			["New York (Syracuse)", "763931607", "3.5"],
			["North Carolina (Charlotte)", "3186558084", "4.2"],
			["North Carolina (Raleigh)", "2259750002", "4.2"],
			["North Carolina (Wilmington)", "4277570694", "4.3"],
			["North Dakota (Bismarck)", "3181259271", "4.1"],
			["North Dakota (Fargo)", "4193613631", "3.9"],
			["Ohio (Cincinnati)", "1422758227", "3.8"],
			["Ohio (Cleveland)", "1861861379", "3.6"],
			["Ohio (Columbus)", "3164563067", "3.7"],
			["Ohio (Toledo)", "2550438542", "3.7"],
			["Oklahoma (Oklahoma City)", "1681490500", "4.5"],
			["Oklahoma (Tulsa)", "4206178633", "4.3"],
			["Oregon (Baker)", "729822444", "4.3"],
			["Oregon (Eugene)", "2170094742", "3.7"],
			["Oregon (Klamath Falls)", "3402233410", "4.6"],
			["Oregon (Portland)", "3363193965", "3.4"],
			["Pennsylvania (Philadelphia)", "1299423297", "3.9"],
			["Pennsylvania (Pittsburgh)", "970297448", "3.5"],
			["Puerto Rico (San Juan)", "1539437238", "4.5"],
			["Rhode Island (Providence)", "3911276065", "4"],
			["South Carolina (Charleston)", "3182739933", "4.4"],
			["South Carolina (Columbia)", "762574785", "4.3"],
			["South Dakota (Pierre)", "2689947897", "4.1"],
			["South Dakota (Sioux Falls)", "2048851752", "4.1"],
			["Tennessee (Knoxville)", "433533562", "4.1"],
			["Tennessee (Memphis)", "1651492633", "4.1"],
			["Tennessee (Nashville)", "671663705", "4"],
			["Texas (Amarillo)", "2866585036", "5"],
			["Texas (Austin)", "2243588821", "4.2"],
			["Texas (Dallas)", "1479087934", "4.3"],
			["Texas (El Paso)", "1637142286", "5.4"],
			["Texas (Fort Worth)", "3843654916", "4.4"],
			["Texas (Houston)", "2127765283", "4.1"],
			["Texas (San Antonio)", "81106563", "4.2"],
			["Utah (Richfield)", "4165216658", "4.7"],
			["Utah (Salt Lake City)", "4025123996", "4.3"],
			["Vermont (Montpelier)", "302888773", "3.6"],
			["Virginia (Richmond)", "3822420444", "4.1"],
			["Virginia (Roanoke)", "3108219435", "4.1"],
			["Virginia (Virginia Beach)", "1286211148", "4.2"],
			["Washington (Seattle)", "629060436", "3.4"],
			["Washington (Spokane)", "555339570", "3.7"],
			["West Virginia (Charleston)", "228560527", "3.7"],
			["Wisconsin (Milwaukee)", "1549092292", "3.9"],
			["Wyoming (Cheyenne)", "2049746331", "4.6"],
		];

		if ($first > 0) {
			if ($second > 0) {
				if ($third > 0 && $four > 0) {
					if ($third <= 100 && $four <= 100) {
						if ($five > 0) {
							if (is_numeric($six)) {
								if (is_numeric($seven)) {
									if ($operations1 == 1) {
										$div1 = 365 * $second;
									} else if ($operations1 == 2) {
										list($c_value, $c_name) = explode("&&", $operations2);
										$data1 = $c_value - 1;
										$c_array = $DATA[$data1];

										if ($c_array[1] = "1711396312") { //for canda country
											list($can_value, $can_name) = explode("&&", $operations3);
											$can_data1 = $can_value - 1;
											$can_array = $DATA[$can_data1];

											$div1 = 365 * $can_array[2];
											$shph = $can_array[2];
										} else if ($c_array[1] = "4229717202") { //for USA country

											list($usa_value, $usa_name) = explode("&&", $operations4);
											$usa_data1 = $usa_value - 1;
											$usa_array = $DATA_USA[$usa_data1];
											$div1 = 365 * $usa_array[2];
											$shph = $usa_array[2];
										} else { //for other country

											$div1 = 365 * $c_array[2];
											$shph = $c_array[2];
										}

										$this->param['shph'] = $shph;
									}
									// $div1 = 365 * $second;
									$sao = $first / $div1;
									$div2 = $third / $four;
									$sas_ans = $sao * $div2;
									$sas_ans = round($sas_ans, 2);
									$mul1 = $sas_ans * 1000;
									$mul2 = $second * $seven;
									if ($mul2 == 0) {
										$panels_ans = 0;
									} else {
										$panels_ans = $mul1 / $mul2;
									}
									$area_ans = $six * round($panels_ans);
									if ($five >= $area_ans) {
										$line = "You have sufficient space for your solar panel system! ☀️";
									} else if ($five < $area_ans) {
										$line = "Oops! You don't seem to have enough space for your solar panel system! 😰";
									}
								} else {
									$this->param['error'] = 'Please check your input';
									return $this->param;
								}
							} else {
								$this->param['error'] = 'Please check your input';
								return $this->param;
							}
						} else {
							$this->param['error'] = 'Area cannot be negative!';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Percentage cannot be greater than 100!';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Percentage must be greater than zero!';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'No. of hours cannot be negative!';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Electricity consumption cannot be negative!';
			return $this->param;
		}
		$this->param['sas_ans'] = $sas_ans;
		$this->param['panels_ans'] = round($panels_ans);
		$this->param['area_ans'] = $area_ans;
		$this->param['line'] = $line;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	/************************
		Centripetal Force Calculator
	 ************************/
	function centripetal($request)
	{
		$find = $request->find;
		$mass = $request->mass;
		$mass_unit = $request->mass_unit;
		$radius = $request->radius;
		$radius_unit = $request->radius_unit;
		$t_velocity = $request->t_velocity;
		$t_velocity_unit = $request->t_velocity_unit;
		$c_force = $request->c_force;
		$c_force_unit = $request->c_force_unit;
		$angular_velocity = $request->angular_velocity;
		$angular_velocity_unit = $request->angular_velocity_unit;
		$centripetal_acceleration = $request->centripetal_acceleration;
		$centripetal_acceleration_unit = $request->centripetal_acceleration_unit;


		if ($mass_unit == 'g') {
			$mass_unit =  0.001;
		} elseif ($mass_unit == 'kg') {
			$mass_unit =  1;
		} elseif ($mass_unit == 't') {
			$mass_unit = 1000;
		} elseif ($mass_unit == 'oz') {
			$mass_unit = 0.02835;
		} elseif ($mass_unit == 'lb') {
			$mass_unit =  0.4536;
		} elseif ($mass_unit == 'stone') {
			$mass_unit =  6.35;
		} elseif ($mass_unit == 'US ton') {
			$mass_unit =  907.2;
		} elseif ($mass_unit == 'Long ton') {
			$mass_unit =  1016;
		} elseif ($mass_unit == 'Earths') {
			$mass_unit =  5972200000000000000000000;
		} elseif ($mass_unit == 'Suns') {
			$mass_unit =  1989000000000000000000000000000;
		}

		if ($radius_unit == 'mm') {
			$radius_unit = 0.001;
		} elseif ($radius_unit == 'cm') {
			$radius_unit = 0.01;
		} elseif ($radius_unit == 'm') {
			$radius_unit = 1;
		} elseif ($radius_unit == 'km') {
			$radius_unit = 1000;
		} elseif ($radius_unit == 'in') {
			$radius_unit = 0.0254;
		} elseif ($radius_unit == 'ft') {
			$radius_unit = 0.3048;
		} elseif ($radius_unit == 'yd') {
			$radius_unit = 0.9144;
		} elseif ($radius_unit == 'mi') {
			$radius_unit = 1609.3;
		} elseif ($radius_unit == 'ly') {
			$radius_unit = 9460700000000000;
		} elseif ($radius_unit == 'au') {
			$radius_unit = 149597870700;
		}



		if ($t_velocity_unit == 'm/s') {
			$t_velocity_unit = 1;
		} elseif ($t_velocity_unit == 'km/h') {
			$t_velocity_unit = 0.2778;
		} elseif ($t_velocity_unit == 'ft/s') {
			$t_velocity_unit = 0.3048;
		} elseif ($t_velocity_unit == 'mph') {
			$t_velocity_unit = 1.6093;
		} elseif ($t_velocity_unit == 'ft/min') {
			$t_velocity_unit = 0.00508;
		} elseif ($t_velocity_unit == 'm/min') {
			$t_velocity_unit = 0.016667;
		}


		// Force unit conversion
		if ($c_force_unit == 'N') {
			$c_force_unit = 1;
		} elseif ($c_force_unit == 'kN') {
			$c_force_unit = 1000;
		} elseif ($c_force_unit == 'pdl') {
			$c_force_unit = 0.13826;
		} elseif ($c_force_unit == 'lbf') {
			$c_force_unit = 4.448;
		}


		if ($angular_velocity_unit == 'rpm') {
			$angular_velocity_unit = 0.10472;
		} elseif ($angular_velocity_unit == 'rad/s') {
			$angular_velocity_unit = 1;
		} elseif ($angular_velocity_unit == 'Hz') {
			$angular_velocity_unit = 6.283;
		}



		if ($centripetal_acceleration_unit == 'm/s²') {
			$centripetal_acceleration_unit = 1;
		} elseif ($centripetal_acceleration_unit == 'g') {
			$centripetal_acceleration_unit = 9.807;
		} elseif ($centripetal_acceleration_unit == 'm/s²') {
			$centripetal_acceleration_unit = 0.3048;
		}







		if ($find == "1") { //Mass
			if (is_numeric($c_force) && is_numeric($radius) && is_numeric($t_velocity) && $c_force > 0 && $radius > 0 && $t_velocity > 0) {
				$c_force_value = $c_force_unit * $c_force;
				$radius_value = $radius_unit * $radius;
				$t_velocity_value = $t_velocity_unit * $t_velocity;
				$find_mass = ($c_force_value * $radius_value) / ($t_velocity_value * $t_velocity_value);
				$this->param['mass'] = $find_mass;
				$this->param['r'] = $radius_value;
				$this->param['c'] = $c_force_value;
				$this->param['v'] = $t_velocity_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "2") { //Radius
			if (is_numeric($c_force) && is_numeric($mass) && is_numeric($t_velocity) && $c_force > 0 && $mass > 0 && $t_velocity > 0) {
				$c_force_value = $c_force_unit * $c_force;
				$mass_value = $mass_unit * $mass;
				$t_velocity_value = $t_velocity_unit * $t_velocity;
				$find_radius = ($mass_value * $t_velocity_value * $t_velocity_value) / ($c_force_value);
				$this->param['radius'] = $find_radius;
				$this->param['m'] = $mass_value;
				$this->param['c'] = $c_force_value;
				$this->param['v'] = $t_velocity_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "3") { //Tangential Velocity
			if (is_numeric($c_force) && is_numeric($mass) && is_numeric($radius) && $c_force > 0 && $mass > 0 && $radius > 0) {
				$c_force_value = $c_force_unit * $c_force;
				$mass_value = $mass_unit * $mass;
				$radius_value = $radius * $radius_unit;
				$find_velocity = sqrt(($radius_value * $c_force_value) / ($mass_value));
				$this->param['velocity'] = $find_velocity;
				$this->param['m'] = $mass_value;
				$this->param['c'] = $c_force_value;
				$this->param['r'] = $radius_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "4") { //Centripetal Force
			if (is_numeric($t_velocity) && is_numeric($mass) && is_numeric($radius) && $t_velocity > 0 && $mass > 0 && $radius > 0) {
				$t_velocity_value = $t_velocity_unit * $t_velocity;
				$mass_value = $mass_unit * $mass;
				$radius_value = $radius * $radius_unit;
				$find_centripetal_force = ($mass_value * $t_velocity_value * $t_velocity_value) / ($radius_value);
				$this->param['centripetal_force'] = $find_centripetal_force;
				$this->param['m'] = $mass_value;
				$this->param['v'] = $t_velocity_value;
				$this->param['r'] = $radius_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "5") { //Angular Velocity
			if (is_numeric($c_force) && is_numeric($mass) && is_numeric($radius) && $c_force > 0 && $mass > 0 && $radius > 0) {
				$c_force_value = $c_force_unit * $c_force;
				$mass_value = $mass_unit * $mass;
				$radius_value = $radius * $radius_unit;
				$angular_velocity = sqrt(($c_force_value) / ($mass_value * $radius_value));
				$this->param['angular_velocity'] = $angular_velocity;
				$this->param['m'] = $mass_value;
				$this->param['c'] = $c_force_value;
				$this->param['r'] = $radius_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "6") { //Angular Acceleration
			if (is_numeric($t_velocity) && is_numeric($radius) && $t_velocity > 0 && $radius > 0) {
				$t_velocity_value = $t_velocity_unit * $t_velocity;
				$radius_value = $radius * $radius_unit;
				$find_angular_acceleration = ($t_velocity_value * $t_velocity_value) / ($radius_value);
				$this->param['ac'] = $find_angular_acceleration;
				$this->param['v'] = $t_velocity_value;
				$this->param['r'] = $radius_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		Arrow Speed Calculator
	 ************************/
	function arrow($request)
	{
	
		$first = $request->first;
		$units1 = $request->units1;
		$second = $request->second;
		$units2 = $request->units2;
		$third = $request->third;
		$units3 = $request->units3;
		$four = $request->four;
		$units4 = $request->units4;
		$five = $request->five;
		$units5 = $request->units5;

		function unit1($a, $b)
		{
			if ($a == "m/s") {
				$convert = $b * 3.281;
			} elseif ($a == "km/h") {
				$convert = $b / 1.097;
			} elseif ($a == "ft/s") {
				$convert = $b * 1;
			} elseif ($a == "mph") {
				$convert = $b *  1.467;
			} elseif ($a == "knots") {
				$convert = $b * 1.688;
			}
			return $convert;
		}

		function unit2($a, $b)
		{
			if ($a == "mm") {
				$convert2 = $b / 25.4;
			} elseif ($a == "cm") {
				$convert2 = $b / 2.54;
			} elseif ($a == "m") {
				$convert2 = $b * 39.37;
			} elseif ($a == "km") {
				$convert2 = $b *  39370;
			} elseif ($a == "in") {
				$convert2 = $b * 1;
			} elseif ($a == "ft") {
				$convert2 = $b * 12;
			} elseif ($a == "yd") {
				$convert2 = $b * 36;
			} elseif ($a == "mi") {
				$convert2 = $b * 63360;
			} elseif ($a == "nmi") {
				$convert2 = $b * 72910;
			}
			return $convert2;
		}
		function unit3($a, $b)
		{
			if ($a == "g") {
				$convert3 = $b / 453.6;
			} elseif ($a == "kg") {
				$convert3 = $b * 2.205;
			} elseif ($a == "gr") {
				$convert3 = $b / 7000;
			} elseif ($a == "oz") {
				$convert3 = $b / 16;
			} elseif ($a == "lb") {
				$convert3 = $b * 1;
			} elseif ($a == "stone") {
				$convert3 = $b * 14;
			}
			return $convert3;
		}

		function unit4($a, $b)
		{
			if ($a == "mg") {
				$convert4 = $b / 64.799;
			} elseif ($a == "g") {
				$convert4 = $b * 15.432;
			} elseif ($a == "dag") {
				$convert4 = $b * 154.3;
			} elseif ($a == "kg") {
				$convert4 = $b *  15430;
			} elseif ($a == "gr") {
				$convert4 = $b * 1;
			} elseif ($a == "dr") {
				$convert4 = $b * 60;
			} elseif ($a == "oz") {
				$convert4 = $b * 437.5;
			} elseif ($a == "lb") {
				$convert4 = $b * 7000;
			} elseif ($a == "stone") {
				$convert4 = $b * 98000;
			}
			return $convert4;
		}
		$first = unit1($units1, $first);
		$second = unit2($units2, $second);
		$third = unit3($units3, $third);
		$four = unit4($units4, $four);
		$five = unit4($units5, $five);
		if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five)) {
			$minus1 = $second - 30;
			$mul1 = $minus1 * 10;
			$div1 = $five / 3;
			$part1 = $first + $mul1 - $div1;
			$mul2 = 5 * $third;
			$minus2 = $four - $mul2;
			$div2 = $minus2 / 3;
			$minus_mul = $div2 * (-1);
			$part2 = min(0, $minus_mul);
			$speed = $part1 + $part2;
			$s_ms = $speed / 3.281;
			$w_kg = $four / 15430;
			$momentum = $s_ms * $w_kg;
			$sq_speed = pow($s_ms, 2);
			$last_mul = $w_kg * $sq_speed;
			$k_energy = $last_mul / 2;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['speed'] = $speed;
		$this->param['momentum'] = $momentum;
		$this->param['k_energy'] = $k_energy;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		Air Density Calculator
	 ************************/
	function air($request)
	{
		$first = $request->first;
		$unit1 = $request->unit1;
		$second = $request->second;
		$unit2 = $request->unit2;
		$operations1 = $request->operations1;
		$third = $request->third;


		function pascal($a, $b)
		{
			if ($a = "Pa") {
				$convert1 = $b * 1;
			} elseif ($a = "mb") {
				$convert1 = $b * 100;
			} elseif ($a = "bar") {
				$convert1 = $b * 100000;
			} elseif ($a = "psi") {
				$convert1 = $b * 6895;
			} elseif ($a = "atm") {
				$convert1 = $b * 101325;
			} elseif ($a = "torr") {
				$convert1 = $b * 133.32;
			} elseif ($a = "hPa") {
				$convert1 = $b * 100;
			} elseif ($a = "kPa") {
				$convert1 = $b * 1000;
			} elseif ($a = "inHg") {
				$convert1 = $b * 3386.4;
			} elseif ($a = "mmHg") {
				$convert1 = $b * 133.32;
			}
			return $convert1;
			
		}
	

		function kelvin_c($a, $b)
		{
			if ($a = "°C") {
				$convert2 = $b * 1;
			} elseif ($a = "°F") {
				$convert2 = ($b - 32) * 0.55555555555555555555555555555556;
			} elseif ($a = "K") {
				$convert2 = $b - 273.15;
			}
			return $convert2;
		}
		function kelvin_k($a, $b)
		{
			if ($a = "°C") {
				$convert2 = $b + 274.15;
			} elseif ($a = "°F") {
				$convert2 = ($b - 32) * 0.55555555555555555555555555555556 + 273.15;
			} elseif ($a = "K") {
				$convert2 = $b * 1;
			}
			return $convert2;
		}
		if ($operations1 == "1") {
			$first = pascal($unit1, $first);
			$second = kelvin_k($unit2, $second);
			// dd($first,$second);
			if (is_numeric($first) && is_numeric($second)) {
				$mul = $second * 287.05;
				$air_density = $first / $mul;
				$this->param['air_density'] = $air_density;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($operations1 == "2") {
			$first = pascal($unit1, $first);
			$second = kelvin_c($unit2, $second);
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				if ($third > 0) {
					$P = $first / 6895;
					$T = ($second * 1.8 + 32) + 459.67;
					$psi = $third / 100;
					$Md = 28.97;
					$Mw = 18.00;
					$Rbar = 1545;
					$ps = 0.08865 * exp((-0.002369 * ($T - 8375.65) * ($T - 491.67)) / ($T - 28.818));
					$air_density =  ($P * $Md + $psi * $ps * ($Mw - $Md)) / $Rbar / $T / 12.0 / 32.174 * 12 * 12 * 12;
					$add = $second + 237.3;
					$mul1 = 7.5 * $second;
					$div = $mul1 / $add;
					$base = pow(10, $div);
					$p1 = $base * 6.1078;
					$pv = $p1 * $third;
					$pd = $first - $pv;
					$d_mul1 = 287.058 * $first;
					$d_mul2 = $third * $first;

					if ($d_mul1 == 0) {
						$l_div = 0;
					} else {
						$l_div = $pd / $d_mul1;
					}

					if ($d_mul2 == 0) {
						$r_div = 0;
					} else {
						$r_div = $pv / $d_mul2;
					}

					$p = $l_div + $r_div;
					$a_ln = log10($third / 100);
					$a = $a_ln + 17.62 * $second / (243.12 + $second);
					$dp = 243.12 * $a / (17.62 - $a);
					$this->param['dp'] = $dp;
					$this->param['pv'] = $pv;
					$this->param['pd'] = $pd;
					$this->param['air_density'] = $air_density;
				} else {
					$this->param['error'] = 'Relative humidity must be greater than zero!';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['operations1'] = $operations1;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/**********************
		Reynolds Number Calculator
	 **********************/
	function reynolds($request)
	{
		$fluid_substance       = $request->fluid_substance;
		$fluid_velocity        = $request->fluid_velocity;
		$fluid_velocity_unit   = $request->fluid_velocity_unit;
		$linear_dimension      = $request->linear_dimension;
		$linear_dimension_unit = $request->linear_dimension_unit;
		$dynamic_velocity      = $request->dynamic_velocity;
		$dynamic_velocity_unit = $request->dynamic_velocity_unit;
		$fluid_density         = $request->fluid_density;
		$fluid_density_unit    = $request->fluid_density_unit;

		function convert_to_meter($unit, $value){
			if ($unit == 'mm') {
				$ans1 = $value / 100;
			}
			elseif ($unit == 'cm') {
				$ans1 = $value / 1000;
			}
			elseif ($unit == 'm') {
				$ans1 = $value;
			}
			elseif ($unit == 'km') {
				$ans1 = $value * 1000;
			}
			elseif ($unit == 'in') {
				$ans1 = $value / 39.37;
			}
			elseif ($unit == 'ft') {
				$ans1 = $value /  3.281;
			}
			elseif ($unit == 'yd') {
				$ans1 = $value / 1.094;
			}
			elseif ($unit == 'mi') {
				$ans1 = $value * 1609;
			}
			return $ans1;
		}

		function convert_to_meter_per_sec($unit, $value){
			if ($unit == 'm-s') {
				$ans2 = $value;
			}
			elseif ($unit == 'km-h') {
				$ans2 = $value / 3.6;
			}
			elseif ($unit == 'ft-s') {
				$ans2 = $value / 3.281;
			}
			elseif ($unit == 'mi-h') {
				$ans2 = $value / 2.237;
			}
			return $ans2;
		}


		function convert_to_kg_m3($unit, $value){

			if ($unit == 'kg/m³') {
				$ans3 = $value;
			}
			else if($unit == 'kg/dm³'){
				$ans3 = $value * 1000;
			}
			else if($unit == 't/m³'){
				$ans3 = $value * 1000;
			}
			else if($unit == 'g/cm³'){
				$ans3 = $value * 1000;
			}
			else if($unit == 'oz/cu in'){
				$ans3 = $value * 1730;
			}
			else if($unit == 'lb/cu in'){
				$ans3 = $value * 27680;
			}
			else if($unit == 'lb/cu ft'){
				$ans3 = $value * 16.02;
			}
			else if($unit == 'lb/cu yd'){
				$ans3 = $value * 0.5933;
			}
			return $ans3;
		}

		function convert_to_kg_m_s($unit, $value){

			if ($unit == 'kg-m-s') {
				$ans = $value;
			}
			else if($unit == 'p'){
				$ans = $value * 0.1;
			}
			else if($unit == 'cp'){
				$ans = $value * 0.001;
			}
			else if($unit == 'mpas'){
				$ans = $value * 0.001;
			}
			else if($unit == 'pas'){
				$ans = $value * 1;
			}
			else if($unit == 'slug'){
				$ans = $value * 47.88;
			}
			else if($unit == 'lbfs-ft2'){
				$ans = $value * 47.88;
			}
			else if($unit == 'lb-fts'){
				$ans = $value * 1.4882;
			}
			else if($unit == 'dynas-cm2'){
				$ans = $value * 0.1;
			}
			else if($unit == 'g-cms'){
				$ans = $value * 0.1;
			}
			else if($unit == 'reyn'){
				$ans = $value * 6890;
			}
			return $ans;
		}

		if (isset($fluid_substance) && is_numeric($fluid_velocity) && is_numeric($linear_dimension)) {
			if ($fluid_substance == 'custom') {
				if (is_numeric($dynamic_velocity) && is_numeric($fluid_density) && $fluid_density > 0) {
					$density   = convert_to_kg_m3($fluid_density_unit, $fluid_density);
					$dynamic   = convert_to_kg_m_s($dynamic_velocity_unit, $dynamic_velocity);
					$kinematic = $dynamic / $density;
					// dd($kinematic);
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else {
				$array     = explode("|", $fluid_substance);
				$density   = $array[0];
				$dynamic   = $array[1];
				$kinematic = $array[2];
			}
			$linear_dimension_m = convert_to_meter($linear_dimension_unit, $linear_dimension);
			$fluid_velocity_m   = convert_to_meter_per_sec($fluid_velocity_unit, $fluid_velocity);
			$reynolds           = round(($fluid_velocity_m * $linear_dimension_m) / $kinematic);
			$this->param['kinematic'] = $kinematic;
			$this->param['reynolds']  = $reynolds;
			$this->param['RESULT']    = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}


	/*******************
    	Time of Flight Calculator
	 *******************/
	function time($request)
	{
		$a = trim($request->a);
		$a_unit = trim($request->a_unit);
		$h = trim($request->h);
		$h_unit = trim($request->h_unit);
		$v = trim($request->v);
		$v_unit = trim($request->v_unit);
		$g = trim($request->g);
		$g_unit = trim($request->g_unit);

		if (is_numeric($a) && is_numeric($h) && !empty($v) && !empty($g) && !empty($a_unit) && !empty($h_unit) && !empty($v_unit) && !empty($g_unit)) {

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
			if (is_numeric($h)) {
				if ($h_unit === 'cm') {
					$h = $h / 100;
				} elseif ($h_unit === 'km') {
					$h = $h / 0.001;
				} elseif ($h_unit === 'in') {
					$h = $h / 39.37;
				} elseif ($h_unit === 'ft') {
					$h = $h / 3.281;
				} elseif ($h_unit === 'yd') {
					$h = $h / 1.0936;
				} elseif ($h_unit === 'mi') {
					$h = $h / 0.0006214;
				}
			}
			if (is_numeric($v)) {
				if ($v_unit === 'kmh') {
					$v = $v / 3.6;
				} elseif ($v_unit === 'fts') {
					$v = $v / 3.28;
				} elseif ($v_unit === 'mph') {
					$v = $v / 2.237;
				}
			}
			if ($a_unit === 'deg') {
				$vx = $v * cos(deg2rad($a));
				$sin = sin(deg2rad($a));
				$vy = $v * sin(deg2rad($a));
			} else {
				$vx = $v * cos($a);
				$sin = sin($a);
				$vy = $v * sin($a);
			}
			if (is_numeric($g)) {
				if ($g_unit === 'g') {
					$g = $g * 9.807;
				}
			}
			if ($h == 0) {
				$res = 2 * $vy;
				$tof = 2 * $vy / $g;
				$this->param['res'] = sigFig($res, 4);
			} else {
				$gh = 2 * $g * $h;
				$pvy = pow($vy, 2);
				$vs2gh = $pvy + $gh;
				$sqrvs2gh = sqrt($vs2gh);
				$vysqrt = $vy + $sqrvs2gh;
				$tof = ($vy + (sqrt(pow($vy, 2) + 2 * $g * $h))) / $g;
				$this->param['pvy'] = $pvy;
				$this->param['gh'] = $gh;
				$this->param['vs2gh'] = $vs2gh;
				$this->param['sqrvs2gh'] = $sqrvs2gh;
				$this->param['vysqrt'] = sigFig($vysqrt, 4);
			}

			$this->param['h'] = $h;
			$this->param['a'] = $a;
			$this->param['sin'] = sigFig($sin, 4);
			$this->param['v'] = sigFig($v, 4);

			$this->param['tof'] = sigFig($tof, 4);
			$this->param['check'] = 'tof';
			$this->param['g'] = sigFig($g, 4);
			$this->param['vx'] = sigFig($vx, 4);
			$this->param['vy'] = sigFig($vy, 4);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/*******************
    Frictional Force Calculator
	 *******************/
	function frictional($request)
	{
		$calculate = $request->calculate;
		$fr_co = $request->fr_co;
		$force = $request->force;
		$force_unit = $request->force_unit;
		$fr = $request->fr;
		$fr_unit = $request->fr_unit;
		$mass = $request->mass;
		$plane = $request->plane;
		$gravity = $request->gravity;

		function frictional_unit($unit, $value)
		{
			if ($unit == "N") {
				$value3 = $value * 1;
			} else if ($unit == "kN") {
				$value3 = $value * 1000;
			} else if ($unit == "MN") {
				$value3 = $value * 1000000;
			} else if ($unit == "GN") {
				$value3 = $value * 1000000000;
			} else if ($unit == "TN") {
				$value3 = $value * 1000000000000;
			}
			return $value3;
		}
		if ($calculate == "1") { //Calculate Friction Coefficient
			if (is_numeric($force) && is_numeric($fr) && $force > 0 && $fr > 0) {
				$fr_value = frictional_unit($fr_unit, $fr);
				$force_value = frictional_unit($force_unit, $force);
				$friction_coefficient = $fr_value / $force_value;
				$this->param['friction_coefficient'] = $friction_coefficient;
				$this->param['fr_value'] = $fr_value;
				$this->param['force_value'] = $force_value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "2") { //Calculate Normal Force
			if (is_numeric($fr) && is_numeric($fr_co) && $fr > 0 && $fr_co > 0) {
				$force_value = frictional_unit($fr_unit, $fr);
				$calculate_force = $force_value / $fr_co;
				$this->param['calculate_force'] = $calculate_force;
				$this->param['force_value'] = $force_value;
				$this->param['fr_co'] = $fr_co;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "3") { //Friction
			if (is_numeric($force) && is_numeric($fr_co) && $force > 0 && $fr_co > 0) {
				$force_value = frictional_unit($force_unit, $force);
				$friction = $force_value * $fr_co;
				$this->param['friction'] = $friction;
				$this->param['force_value'] = $force_value;
				$this->param['fr_co'] = $fr_co;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculate == "4") {
			if (is_numeric($mass) && is_numeric($plane) && is_numeric($fr_co) && is_numeric($gravity) && $mass > 0) {
				if ($fr_co > 0 && $fr_co < 1) {
					$read = cos(deg2rad($plane));
					$force_value = $fr_co * $mass * $gravity * $read;
					$this->param['friction2'] = $force_value;
					$this->param['mass'] = $mass;
					$this->param['fr_co'] = $fr_co;
					$this->param['plane'] = $plane;
					$this->param['read'] = $read;
					$this->param['gravity'] = $gravity;
				} else {
					$this->param['error'] = 'Please ! Coefficient of fraction should be in the range between 0 and 1';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Quantum Number Calculator
	 *******************/
	function quantum($request)
	{

		$type = $request->type;
		$value = $request->value;
		if ($type == 'principal') {
			if (is_numeric($value)) {
				$angular_momentum = '';
				for ($i = 0; $i < $value; $i++) {
					$angular_momentum .= $i;
				}
				$table = "<table class='w-100 font-s-18'><tr><td class='py-2 border-b'><strong>Principal quantum number (𝑛)</strong></td><td class='py-2 border-b'><strong>Angular momentum quantum number (𝑙)</strong></td><td class='py-2 border-b'><strong>Magnetic quantum number (𝘮ₗ)</strong></td></tr>";
				for ($i = 0; $i < $value; $i++) {
					$inner = $i * (-1);
					for ($j = $inner; $j <= $i; $j++) {
						$table .= '<tr><td class="py-2 border-b">' . $value . '</td><td class="py-2 border-b">' . $i . '</td><td class="py-2 border-b">' . $j . ' </td></tr>';
					}
				}
				$table .= '</table>';

				$this->param['table'] = $table;
				$this->param['angular_momentum'] = $angular_momentum;
				$this->param['value'] = $value;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($type == 'angular') {
			if (is_numeric($value)) {
				$result = '';
				$k = $value * (-1);
				for ($j = $k; $j <= $value; $j++) {
					$result .= ',' . $j;
					$magnetic = preg_replace('/^,/', '', $result);
				}
				$num_orbital = 2 * $value + 1;
				$this->param['magnetic'] = $magnetic;
				$this->param['num_orbital'] = $num_orbital;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['type'] = $type;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
		Mechanical Energy Calculator
	 *******************/
	public function mechanical($request)
	{
		// $selection = trim($request->selection);
		$mass = trim($request->mass);
		$mass_unit = trim($request->mass_unit);
		$velocity = trim($request->velocity);
		$velocity_unit = trim($request->velocity_unit);
		$height = trim($request->height);
		$height_unit = trim($request->height_unit);
		$engergyunit = trim($request->engergyunit);

		function unit_kg($a, $b)
		{
			if ($b == "kg") {
				$mass_val = $a * 1;
			} else if ($b == "g") {
				$mass_val = $a / 1000;
			} else if ($b == "mg") {
				$mass_val = $a / 1000000;
			} else if ($b == "mu-gr") {
				$mass_val = $a / 1000000000;
			} else if ($b == "ct") {
				$mass_val = $a / 5000;
			} else if ($b == "lbs") {
				$mass_val = $a / 2.205;
			} else if ($b == "troy") {
				$mass_val = $a * 0.0311;
			} else if ($b == "ozm") {
				$mass_val = $a * 0.02834952;
			} else if ($b == "slug") {
				$mass_val = $a * 14.594;
			} else if ($b == "ton(short)") {
				$mass_val = $a * 907.2;
			}
			return $mass_val;
		}

		function unit_ms($a, $b)
		{
			if ($b == "m/s") {
				$velocity_ms = $a * 1;
			} else if ($b == "ft/min") {
				$velocity_ms = $a / 196.9;
			} else if ($b == "ft/s") {
				$velocity_ms = $a / 3.281;
			} else if ($b == "km/hr") {
				$velocity_ms = $a / 3.6;
			} else if ($b == "knot (int'l)") {
				$velocity_ms = $a / 1.944;
			} else if ($b == "mph") {
				$velocity_ms = $a / 2.237;
			} else if ($b == "miles/hr") {
				$velocity_ms = $a / 1.151;
			} else if ($b == "miles/min") {
				$velocity_ms = $a * 0.447 * 60;
			} else if ($b == "miles/s") {
				$velocity_ms = $a / 1609;
			} else if ($b == "speed of light") {
				$velocity_ms = $a * 299800000;
			}
			return $velocity_ms;
		}
		function unit_m($a, $b)
		{
			if ($b == "m") {
				$height_m = $a * 1;
			} else if ($b == "AU") {
				$height_m = $a * 149600000000;
			} else if ($b == "cm") {
				$height_m = $a / 100;
			} else if ($b == "km") {
				$height_m = $a * 1000;
			} else if ($b == "ft") {
				$height_m = $a / 3.281;
			} else if ($b == "in") {
				$height_m = $a / 39.37;
			} else if ($b == "mil") {
				$height_m = $a / 39370;
			} else if ($b == "mm") {
				$height_m = $a / 1000;
			} else if ($b == "nm") {
				$height_m = $a / 1000000000;
			} else if ($b == "mile") {
				$height_m = $a * 1609;
			} else if ($b == "parsec") {
				$height_m = $a * 30860000000000000;
			} else if ($b == "pm") {
				$height_m = $a / 1000000000000;
			} else if ($b == "yd") {
				$height_m = $a / 1.094;
			}
			return $height_m;
		}
		function energy_unit($a, $b)
		{
			if ($b == "1") {
				$engunit = $a * 1;
			} else if ($b == "2") {
				$engunit = $a / 1055;
			} else if ($b == "3") {
				$engunit = $a / 1055;
			} else if ($b == "4") {
				$engunit = $a * 0.239006;
			} else if ($b == "5") {
				$engunit = $a * 6242000000000000000;
			} else if ($b == "6") {
				$engunit = $a * 10000000;
			} else if ($b == "7") {
				$engunit = $a / 1.356;
			} else if ($b == "8") {
				$engunit = $a * 23.73036;
			} else if ($b == "9") {
				$engunit = $a * 0.0000003725061361;
			} else if ($b == "10") {
				$engunit = $a / 4184;
			} else if ($b == "11") {
				$engunit = $a / 3600000;
			} else if ($b == "12") {
				$engunit = $a / 4184000000;
			} else if ($b == "13") {
				$engunit = $a * 1;
			} else if ($b == "14") {
				$engunit = $a / 3600;
			} else if ($b == "15") {
				$engunit = $a * 1;
			}
			return $engunit;
		}
		if (is_numeric($mass) && is_numeric($velocity) && is_numeric($height)) {
			$mass = unit_kg($mass, $mass_unit);
			$velocity = unit_ms($velocity, $velocity_unit);
			$height = unit_m($height, $height_unit);
			$kinatic_eng = 0.5 * $mass * (pow($velocity, 2));
			$potentional_eng = $mass * 9.8 * $height;
			$mechanical_eng = $kinatic_eng + $potentional_eng;
			$mechanical_energy = energy_unit($mechanical_eng, $engergyunit);
			$kinatic_engrgy = energy_unit($kinatic_eng, $engergyunit);
			$potentional_engergy = energy_unit($potentional_eng, $engergyunit);
			$this->param['mass'] = $mass;
			$this->param['velocity'] = $velocity;
			$this->param['height'] = $height;
			$this->param['kinatic_eng'] = $kinatic_eng;
			$this->param['potentional_eng'] = $potentional_eng;
			$this->param['mechanical_eng'] = $mechanical_eng;
			$this->param['mechanical_energy'] = $mechanical_energy;
			$this->param['kinatic_engrgy'] = $kinatic_engrgy;
			$this->param['potentional_engergy'] = $potentional_engergy;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	/*******************
    Index of Refraction Calculator
	 *******************/
	function index($request)
	{
		// dd($request->all());
		$selection = trim($request->selection);
		$medium_v = trim($request->medium_v);
		$medium_value = trim($request->medium_value);
		$medium_value_unit = trim($request->medium_value_unit);
		$medium_value_unit1 = trim($request->medium_value_unit1);
		$medium_v2 = trim($request->medium_v2);
		$medium_value2 = trim($request->medium_value2);

		function speed_unit($a, $b)
		{
			if ($b = "m/s") {
				$speed_u = $a / 1000;
			} else if ($b = "km/s") {
				$speed_u = $a * 1;
			} else if ($b = "mi/s") {
				$speed_u = $a * 1.609;
			} else if ($b = "c") {
				$speed_u = $a * 299800;
			}
			return $speed_u;
		}
		if ($selection == "1") {
			if (is_numeric($medium_value) && is_numeric($medium_value2)) {
				$medium_value = speed_unit($medium_value, $medium_value_unit);
				$index_of_refrection = 299792.46 / $medium_value;
				$this->param['index_of_refrection'] = $index_of_refrection;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($selection == "2") {
			if (is_numeric($medium_value) && is_numeric($medium_value2)) {
				$medium_value = speed_unit($medium_value, $medium_value_unit);
				$medium_value2 = speed_unit($medium_value2, $medium_value_unit1);
				$index_of_refrection = 299792.46 / $medium_value;
				$index_of_refrection2 = 299792.46 / $medium_value2;
				$reflective_index = $index_of_refrection2 / $index_of_refrection;
				$this->param['reflective_index'] = $reflective_index;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		// dd($this->param);
		return $this->param;
	}

	/*******************
		Change of Momentum Calculator
	 *******************/
	function change($request)
	{  
		$operations = trim($request->operation);
		$mass = trim($request->mass);
		$mass_unit = trim($request->mass_unit);
		$i_velocity = trim($request->i_velocity);
		$i_velocity_unit = trim($request->i_velocity_unit);
		$f_velocity = trim($request->f_velocity);
		$f_velocity_unit = trim($request->f_velocity_unit);
		$c_velocity = trim($request->c_velocity);
		$c_velocity_unit = trim($request->c_velocity_unit);
		$force = trim($request->force);
		$force_unit = trim($request->force_unit);
		$time = trim($request->time);
		$time_unit = trim($request->time_unit);


		function m_unit($a, $b)
		{
			// Ensure $a is treated as a numeric value
			$a = (float)$a;

			if ($b == "kg") {
				$m_val = $a * 1;
			} else if ($b == "g") {
				$m_val = $a / 1000;
			} else if ($b == "mg") {
				$m_val = $a / 0.000001;
			} else if ($b == "µg") {
				$m_val = $a / 1000000000;
			} else if ($b == "tons(t)") {
				$m_val = $a * 1000;
			} else if ($b == "US ton") {
				$m_val = $a * 907.2;
			} else if ($b == "long ton") {
				$m_val = $a * 1016;
			} else if ($b == "oz") {
				$m_val = $a / 35.274;
			} else if ($b == "lb") {
				$m_val = $a / 2.205;
			} else if ($b == "stone") {
				$m_val = $a * 6.35;
			} else if ($b == "me") {
				$m_val = $a / 1098000000000000000000000000000;
			} else if ($b == "u") {
				$m_val = $a / 602200000000000000000000000;
			} else {
				$m_val = null; // Return null for unsupported units
			}

			return $m_val;
		}


		function v_unit($a, $b)
		{
			// Ensure $a is treated as a numeric value
			$a = (float)$a;

			if ($b == "m/s") {
				$v_value = $a * 1;
			} else if ($b == "km/h") {
				$v_value = $a / 3.6;
			} else if ($b == "ft/s") {
				$v_value = $a / 3.281;
			} else if ($b == "mph") {
				$v_value = $a / 2.237;
			} else if ($b == "knots") {
				$v_value = $a * 1.944;
			} else if ($b == "ft/min") {
				$v_value = $a / 196.9;
			} else {
				$v_value = null; // Return null for unsupported units
			}

			return $v_value;
		}

		function f_unit($a, $b)
		{
			// Ensure $a is treated as a numeric value
			$a = (float)$a;

			if ($b == "N") {
				$force_val = $a * 1;
			} else if ($b == "KN") {
				$force_val = $a * 1000;
			} else if ($b == "MN") {
				$force_val = $a * 1000000;
			} else if ($b == "4GN") { // Assuming you meant "GN" instead of "4GN"
				$force_val = $a * 1000000000;
			} else if ($b == "TN") {
				$force_val = $a * 1000000000000;
			} else {
				$force_val = null; // Return null for unsupported units
			}

			return $force_val;
		}


		function t_unit($a, $b)
		{
			// Ensure $a is treated as a numeric value
			$a = (float)$a;

			if ($b == "sec") {
				$time_val = $a * 1;
			} else if ($b == "min") {
				$time_val = $a * 60;
			} else if ($b == "hr") {
				$time_val = $a * 3600;
			} else {
				$time_val = null; // Return null for unsupported units
			}

			return $time_val;
		}


		$mass = m_unit($mass, $mass_unit);
		$i_velocity = v_unit($i_velocity, $i_velocity_unit);
		$f_velocity = v_unit($f_velocity, $f_velocity_unit);
		$c_velocity = v_unit($c_velocity, $c_velocity_unit);
		$force = f_unit($force, $force_unit);
		$time = t_unit($time, $time_unit);
		if ($operations == "1") {
			if (is_numeric($mass) && is_numeric($i_velocity) && is_numeric($f_velocity)) {
				$initial_momentum = $mass * $i_velocity;
				$final_momentum = $mass * $f_velocity;
				$change_velocity_val = $f_velocity - $i_velocity;
				$change_momentum_val = $mass * $change_velocity_val;
				$this->param['initial_momentum'] = $initial_momentum;
				$this->param['final_momentum'] = $final_momentum;
				$this->param['change_velocity_val'] = $change_velocity_val;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($operations == "2") {
			if (is_numeric($mass) && is_numeric($c_velocity)) {
				$change_momentum_val = $mass * $c_velocity;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($operations == "3") {
			if (is_numeric($force) && is_numeric($time)) {
				$change_momentum_val = $force * $time;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['change_momentum_val'] = $change_momentum_val;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	CC to HP Calculator
	 *******************/
	function cc($request)
	{
		$solve = trim($request->solve);
		$input = trim($request->input);

		if (is_numeric($input)) {
			if ($solve === "1") {
				$answer = $input / 15;
			} else {
				$answer = $input * 15;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Impulse Calculator
	 *******************/
	function impulse($request)
	{

		$calculation = trim($request->calculation);
		$impulse = trim($request->impulse);
		$j_units = trim($request->j_units);
		$force = trim($request->force);
		$f_units = trim($request->f_units);
		$time = trim($request->time);
		$t_units = trim($request->t_units);
		$impulse_ans_units = trim($request->impulse_ans_units);
		$force_ans_units = trim($request->force_ans_units);
		$time_ans_units = trim($request->time_ans_units);

		function imp_units($a, $b)
		{
			if ($b == "dyn·s") {
				$imp_unit = $a * 0.00001;
			} else if ($b == "dyn·min") {
				$imp_unit = $a * 0.0006;
			} else if ($b == "dyn·h") {
				$imp_unit = $a * 0.036;
			} else if ($b == "kg·m/s") {
				$imp_unit = $a * 1;
			} else if ($b == "N·s") {
				$imp_unit = $a * 1;
			} else if ($b == "N·min") {
				$imp_unit = $a * 60;
			} else if ($b == "N·h") {
				$imp_unit = $a * 3600;
			} else if ($b == "mN·s") {
				$imp_unit = $a * 0.001;
			} else if ($b == "mN·min") {
				$imp_unit = $a * 0.06;
			} else if ($b == "kN·s") {
				$imp_unit = $a * 1000;
			} else if ($b == "kN·min") {
				$imp_unit = $a * 60000;
			}
			return $imp_unit;
		}
		function force_units($a, $b)
		{
			if ($b == "dyn") {
				$force_unit = $a * 0.00001;
			} else if ($b == "kgf") {
				$force_unit = $a * 9.80665;
			} else if ($b == "N") {
				$force_unit = $a * 1;
			} else if ($b == "kN") {
				$force_unit = $a * 1000;
			} else if ($b == "kip") {
				$force_unit = $a * 4448.222;
			} else if ($b == "lbf") {
				$force_unit = $a * 4.448222;
			} else if ($b == "ozf") {
				$force_unit = $a * 0.2780139;
			} else if ($b == "pdl") {
				$force_unit = $a * 0.138255;
			}
			return $force_unit;
		}
		function time_units($a, $b)
		{
			if ($b == "sec") {
				$time_unit = $a * 1;
			} else if ($b == "min") {
				$time_unit = $a * 60;
			} else if ($b == "hr") {
				$time_unit = $a * 3600;
			}
			return $time_unit;
		}
		$impulse = imp_units($impulse, $j_units);
		$force = force_units($force, $f_units);
		$time = time_units($time, $t_units);
		if ($calculation === "1") {
			if (is_numeric($force) && is_numeric($time)) {
				$imp_jawab = $force * $time;
				if ($impulse_ans_units == "dyn·s") {
					$answer = $imp_jawab * 100000;
				} else if ($impulse_ans_units == "dyn·min") {
					$answer = $imp_jawab * 1666.666666667;
				} else if ($impulse_ans_units == "dyn·h") {
					$answer = $imp_jawab * 27.77777777778;
				} else if ($impulse_ans_units == "kg·m/s") {
					$answer = $imp_jawab * 1;
				} else if ($impulse_ans_units == "N·s") {
					$answer = $imp_jawab * 1;
				} else if ($impulse_ans_units == "N·min") {
					$answer = $imp_jawab * 0.01666666666667;
				} else if ($impulse_ans_units == "N·h") {
					$answer = $imp_jawab * 0.0002777777777778;
				} else if ($impulse_ans_units == "mN·s") {
					$answer = $imp_jawab * 1000;
				} else if ($impulse_ans_units == "mN·min") {
					$answer = $imp_jawab * 16.66666666667;
				} else if ($impulse_ans_units == "kN·s") {
					$answer = $imp_jawab * 0.001;
				} else if ($impulse_ans_units == "kN·min") {
					$answer = $imp_jawab * 0.00001666666666667;
				}
				$unit_ans = $impulse_ans_units;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($calculation === "2") {
			if (is_numeric($impulse) && is_numeric($time)) {
				$force_jawab = $impulse / $time;
				if ($force_ans_units == "dyn") {
					$answer = $force_jawab * 100000;
				} else if ($force_ans_units == "kgf") {
					$answer = $force_jawab * 0.1019716213;
				} else if ($force_ans_units == "N") {
					$answer = $force_jawab * 1;
				} else if ($force_ans_units == "kN") {
					$answer = $force_jawab * 0.001;
				} else if ($force_ans_units == "kip") {
					$answer = $force_jawab * 0.0002248089237;
				} else if ($force_ans_units == "lbf") {
					$answer = $force_jawab * 0.2248089237;
				} else if ($force_ans_units == "ozf") {
					$answer = $force_jawab * 3.596942455;
				} else if ($force_ans_units == "pdl") {
					$answer = $force_jawab *  7.233011464;
				}
				$unit_ans = $force_ans_units;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else {
			if (is_numeric($impulse) && is_numeric($force)) {
				$time_jawab = $impulse / $force;
				if ($time_ans_units == "sec") {
					$answer = $time_jawab * 1;
				} else if ($time_ans_units == "min") {
					$answer = $time_jawab / 60;
				} else if ($time_ans_units == "hr") {
					$answer = $time_jawab / 3600;
				}
				$unit_ans = $time_ans_units;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['unit_ans'] = $unit_ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
    	Average Speed Calculator
	 *******************/
	function average($request)
	{
		$t_hours = trim($request->t_hours);
		$t_min = trim($request->t_min);
		$t_sec = trim($request->t_sec);
		$distance = trim($request->distance);
		$distance_unit = trim($request->distance_unit);
		
		function speed_units($a, $b)
		{
			
			if ($b == "miles") {
				$speed_u = $a * 1609;
			} else if ($b == "km") {
				$speed_u = $a * 1000;
			} else if ($b == "yards") {
				$speed_u = $a / 1.094;
			} else if ($b == "foot") {
				$speed_u = $a / 3.281;
			} else if ($b == "meters") {
				$speed_u = $a * 1;
			}
			return $speed_u;
		}
		if (is_numeric($t_hours) && is_numeric($t_min) && is_numeric($t_sec) && is_numeric($distance)) {

			$dis_val = speed_units($distance, $distance_unit);
			$total_seconds = ($t_hours * 3600) + ($t_min * 60) + $t_sec;
			$ans_mps = $dis_val / $total_seconds;
			$ans_mphh = $ans_mps * 3600;
			$ans_ydph = $ans_mps * 3937;
			$ans_ftph = $ans_mps * 11810;
			$ans_mph = $ans_mps * 2.237;
			$ans_kmh = $ans_mps * 3.6;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['ans_mps'] = $ans_mps;
		$this->param['ans_mph'] = $ans_mph;
		$this->param['ans_kmh'] = $ans_kmh;
		$this->param['ans_mphh'] = $ans_mphh;
		$this->param['ans_ydph'] = $ans_ydph;
		$this->param['ans_ftph'] = $ans_ftph;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		 Snell's Law Calculator
	 ************************/
	function snells($request)
	{
		$calculation = $request->calculation;
		$medium1 = $request->medium1;
		$n1 = $request->n1;
		$medium2 = $request->medium2;
		$n2 = $request->n2;
		$angle_first = $request->angle_first;
		$angle_f_unit = $request->angle_f_unit;
		$angle_second = $request->angle_second;
		$angle_s_unit = $request->angle_s_unit;

		function convert_angle($a, $b)
		{
			if ($a === "deg") {
				$converted = $b * 0.0174533;
			} elseif ($a === "rad") {
				$converted = $b * 1;
			} elseif ($a === "gon") {
				$converted = $b * 0.01570796;
			} elseif ($a === "tr") {
				$converted = $b * 6.28319;
			} elseif ($a === "arcmin") {
				$converted = $b * 0.000290888;
			} elseif ($a === "arcsec") {
				$converted = $b * 0.00000484814;
			} elseif ($a === "mrad") {
				$converted = $b * 0.001;
			} elseif ($a === "μrad") {
				$converted = $b * 0.000001;
			} elseif ($a === "* π rad") {
				$converted = $b * 3.14159;
			}
			return $converted;
		}
		$angle_first = convert_angle($angle_f_unit, $angle_first);
		$angle_second = convert_angle($angle_s_unit, $angle_second);
		if ($calculation === "from1") {
			if (!empty($medium2) && is_numeric($n2) && is_numeric($angle_first) && !empty($angle_f_unit) && is_numeric($angle_second) && !empty($angle_s_unit)) {
				$jawab = ($n2 * sin($angle_second)) / sin($angle_first);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($calculation === "from2") {
			if (!empty($medium1) && is_numeric($n1) && is_numeric($angle_first) && !empty($angle_f_unit) && is_numeric($angle_second) && !empty($angle_s_unit)) {
				$jawab = ($n1 * sin($angle_first)) / sin($angle_second);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($calculation === "from3") {
			if (!empty($medium1) && is_numeric($n1) && !empty($medium2) && is_numeric($n2) && is_numeric($angle_second) && !empty($angle_s_unit)) {
				$jawab = asin(($n2 * sin($angle_second)) / $n1);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($calculation === "from4") {
			if (!empty($medium1) && is_numeric($n1) && !empty($medium2) && is_numeric($n2) && is_numeric($angle_first) && !empty($angle_f_unit)) {
				$jawab = asin(($n1 * sin($angle_first)) / $n2);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['angle_first'] = $angle_first;
		$this->param['angle_second'] = $angle_second;
		$this->param['calculation'] = $calculation;
		$this->param['jawab'] = $jawab;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Watts to Amps Calculator
	function watts($request)
	{  
		$current_type = $request->current_type;
		$power = $request->power;
		$power_unit = $request->power_unit;
		$voltage_type = $request->voltage_type;
		$voltage = $request->voltage;
		$voltage_unit = $request->voltage_unit;
		$power_factor = $request->power_factor;
		function convert_b($a, $b)
		{
			if ($b === "mW" || $b === "mV") {
				$amp_ans = $a / 1000;
			} else if ($b === "W" || $b === "V") {
				$amp_ans = $a * 1;
			} else {
				$amp_ans = $a * 1000;
			}
			return $amp_ans;
		}
		if (is_numeric($power) && is_numeric($voltage)) {
			$power = convert_b($power, $power_unit);
			$voltage = convert_b($voltage, $voltage_unit);
			if ($current_type === "DC") {
				$amps_ans = $power / $voltage;
			} else if ($current_type === "AC") {
				if (is_numeric($power)) {
					$amps_ans = $power / ($voltage * $power_factor);
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($power)) {
					if ($voltage_type === "ltl") {
						$amps_ans = $power / (1.73205080 * $voltage * $power_factor);
					} else {
						$amps_ans = $power / (3 * $voltage * $power_factor);
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['amps_ans'] = $amps_ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Amps to Watts Calculator
	public function amps($request)
	{
		$current_type = $request->current_type;
		$current = $request->current;
		$current_unit = $request->current_unit;
		$voltage_type = $request->voltage_type;
		$voltage = $request->voltage;
		$voltage_unit = $request->voltage_unit;
		$power = $request->power;
		function convert_v($a, $b)
		{
			if ($b == "mV") {
				$amp_ans = $a / 1000
				;
			} else if ($b == "V") {
				$amp_ans = $a;
			} else {
				$amp_ans = $a * 1000;
			}
			return $amp_ans;
		}
		function convert_a($a, $b)
		{
			if ($b == "mA") {
				$amp_ans = $a / 1000;
			} else if ($b == "A") {
				$amp_ans = $a;
			} else {
				$amp_ans = $a * 1000;
			}
			return $amp_ans;
		}
		if (is_numeric($current) && is_numeric($voltage)) {
			$current = convert_a($current, $current_unit);
			$voltage = convert_v($voltage, $voltage_unit);
			if ($current_type === "DC") {
				$power_ans = $current * $voltage;
			} else if ($current_type === "AC") {
				if (is_numeric($power)) {
					$power_ans = $current * $voltage * $power;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($power)) {
					if ($voltage_type === "ltl") {
						$power_ans = 1.7320508 * $current * $voltage * $power;
					} else {
						$power_ans = 3 * $current * $voltage * $power;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['power_ans'] = $power_ans;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Density Altitude Calculator
	public function density_altitude($request)
	{
		$air_temp = $request->air_temp;
		$air_temp_unit = $request->air_temp_unit;
		$dewpoint = $request->dewpoint;
		$dewpoint_unit = $request->dewpoint_unit;
		$altimeter_setting = $request->altimeter_setting;
		$altimeter_setting_unit = $request->altimeter_setting_unit;
		$station_elevation = $request->station_elevation;
		$station_elevation_unit = $request->station_elevation_unit;
		function roundArray($ogArray, $roundTo = 2)
		{
			foreach ($ogArray as &$innerArray) {
				foreach ($innerArray as &$value) {
					$value = round($value, $roundTo);
				}
			}
			return $ogArray;
		}

		function linespace($nPoints, $initValue, $endValue)
		{
			if (!isset($initValue)) {
				$initValue = 0;
			}
			if (!isset($endValue)) {
				$endValue = $nPoints;
			}

			if ($endValue < $initValue) {
				$temp = $endValue;
				$endValue = $initValue;
				$initValue = $temp;
			}

			$myArray = [];
			$stepSize = ($endValue - $initValue) / $nPoints;

			for ($i = $initValue; $i <= $endValue; $i += $stepSize) {
				$myArray[] = $i;
			}

			return $myArray;
		}

		function dataToChart($xValues, $whichFunction, $relative_humidity, $station_elevation, $altimeter_setting)
		{
			$whichFunction = $whichFunction ?: 0;
			$chartData = [];

			switch ($whichFunction) {
				case 1:
					foreach ($xValues as $x) {
						$chartData[] = [$x, densityAltitude($x, $relative_humidity, $station_elevation, $altimeter_setting)];
					}
					break;
				default:
					foreach ($xValues as $x) {
						$chartData[] = [$x, efofex($x)];
					}
					break;
			}

			return $chartData;
		}

		function densityAltitude($x, $relative_humidity, $station_elevation, $altimeter_setting)
		{
			// Get inputs from calculator
			$RH = $relative_humidity;
			$stationElevation = $station_elevation;
			$altimeterSetting = $altimeter_setting;


			$P = pow(pow($altimeterSetting, 0.190263) - 8.417286e-5 * $stationElevation, 1 / 0.190263);
			$alpha = log($RH) + (17.62 * $x) / (243.12 + $x);
			$dewPoint = (243.12 * $alpha) / (17.62 - $alpha);
			$Pv_corrections =
				$dewPoint *
				(0.43884187e-8 +
					$dewPoint *
					(-0.29883885e-10 +
						$dewPoint *
						(0.21874425e-12 +
							$dewPoint *
							(-0.17892321e-14 +
								$dewPoint * (0.11112018e-16 + $dewPoint * -0.30994571e-19)))));
			$Pv =
				6.1078 /
				pow(
					0.99999683 +
						$dewPoint *
						(-0.90826951e-2 +
							$dewPoint *
							(0.78736169e-4 + $dewPoint * (-0.61117958e-6 + $Pv_corrections))),
					8
				);
			$Pd = $P - $Pv;
			$airDensity =
				($Pd / (287.0531 * ($x + 273.15)) + $Pv / (461.4964 * ($x + 273.15))) * 100;
			$altitudeGeopotential =
				(44.3308 - 42.2665 * pow($airDensity, 0.234969)) * 1000;

			return $altitudeGeopotential;
		}
		function efofex($x)
		{
			return cos($x) * $x;
		}

		function tempUnitConvert($unit, $value)
		{
			if ($unit == "°F") {
				$value = ($value - 32) / 1.8;
			} else if ($unit == "K") {
				$value = $value  - 273.15;
			}
			return $value;
		}
		function alt_pascal($a, $b)
		{
			if ($a == "mb") {
				$value = $b * 1;
			} else if ($a == "hpa") {
				$value = $b * 1;
			} else if ($a == "inHg") {
				$value = $b * 33.864;
			} else if ($a == "mmHg") {
				$value = $b * 1.3332;
			}
			return $value;
		}

		function stationConvert($unit, $value)
		{
			if ($unit == "in") {
				$value = $value * 0.0254;
			} else if ($unit == "ft") {
				$value = $value * 0.3048;
			} else if ($unit == "yd") {
				$value = $value * 0.9144;
			} else if ($unit == "mi") {
				$value = $value * 133.32;
			}
			return $value;
		}

		if (is_numeric($air_temp) && is_numeric($dewpoint) && is_numeric($altimeter_setting) && is_numeric($station_elevation)) {
			if ($air_temp >= $dewpoint) {
				$temperature = tempUnitConvert($air_temp_unit, $air_temp);
				$point = tempUnitConvert($dewpoint_unit, $dewpoint);
				$Pws = 6.112 * exp((17.67 * $temperature) / ($temperature + 243.5));
				$Pw = 6.112 * exp((17.67 * $point) / ($point + 243.5));
				// $relative_humidity =  ($Pw / $Pws) * 100;
                  $relative_humidity = ($Pws == 0) ? 0 : ($Pw / $Pws) * 100;

				$altimeter_setting = alt_pascal($altimeter_setting_unit, $altimeter_setting);
				if ($altimeter_setting >= 800 && $altimeter_setting <= 1200) {
					$station_elevation = stationConvert($station_elevation_unit, $station_elevation);
					if ($station_elevation >= -500 && $station_elevation <= 10000) {

						$absolute_pressure = pow((pow($altimeter_setting, 0.190263) - (8.417286 * pow(10, -5) * $station_elevation)), 1 / 0.190263);

						$rh = round($relative_humidity / 100, 2);
						$tpow = (7.5 * $temperature) / ($temperature + 273.3);
						$pow = pow(10, $tpow);
						$pv = $rh * 6.1078 * $pow;
						// $pv = 20.62;
						$pd = $absolute_pressure - $pv;
						$ltp = $pd * 100;
						$lbp = 287.058 * ($temperature + 273.15);
						$p1 = $ltp / $lbp;
						$rtp = $pv * 100;
						$rbp = 461.495 * ($temperature + 273.15);
						$p2 = $rtp / $rbp;
						$air_density = $p1 + $p2;

						$density_altitude = 44.3308 - 42.2665 * pow($air_density, 0.234969);
						$relative_density = ($air_density / 1.225) * 100;

						$nPoints = 61;
						$initialX = -18;
						$finalX = 43;
						if ($finalX > $initialX && $nPoints > 1) {
							$xValues = linespace($nPoints, $initialX, $finalX);
							$chartData = dataToChart($xValues, 1, $rh, $station_elevation, $altimeter_setting);
							$chartData = roundArray($chartData, 1);
						}
					} else {
						$this->param['error'] = 'Station elevation should be between -500 and 10,000 m (1,640 and 32,808 ft).';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'The altimeter setting should be between 800 and 1200 mb (23.6 to 35.4 inHg).';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'DewPoint Cannot be greater than air temperature';
				return $this->param;
			}
		}else{
			$this->param['error'] = 'Please Check Your Input.';
			return $this->param;
		}

		$this->param['relative_humidity'] = $relative_humidity;
		$this->param['air_density'] = $air_density;
		$this->param['relative_density'] = $relative_density;
		$this->param['absolute_pressure'] = $absolute_pressure;
		$this->param['density_altitude'] = $density_altitude;
		$this->param['chartData'] = json_encode($chartData);

		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Specific Gravity Calculator
	public function specific_of($request)
	{
		$t_fluid = $request->t_fluid;
		$density = $request->density;
		$density_unit = $request->density_unit;
		if (isset($_POST['submit']) || isset($_GET['res_link'])) {

			function central_unit($density, $density_unit)
			{
				if ($density_unit == "kg/m³") {
					$density = $density;
				} elseif ($density_unit == "lb/ft³") {
					$density = $density * 16.0185;
				} elseif ($density_unit == "lb/yd³") {
					$density = $density * 0.593276;
				} elseif ($density_unit == "g/cm³") {
					$density = $density * 1000;
				} elseif ($density_unit == "kg/cm³") {
					$density = $density / 1000000;
				} elseif ($density_unit == "mg/cm³") {
					$density = $density * 0.001;
				} elseif ($density_unit == "g/m³") {
					$density = $density * 1000;
				} elseif ($density_unit == "g/dm³") {
					$density = $density * 100;
				}
				return $density;
			}

			if ($t_fluid == 'ls') {
				if (is_numeric($density)) {
					$dens = central_unit($density, $density_unit);
					$gravity = round($dens / 1000, 5);
					$this->param['gravity'] = $gravity;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else {
				if (is_numeric($density)) {
					$dens = $density;
					$gs_gravity = round($dens / 28.96469, 5);
					$this->param['gs_gravity'] = $gs_gravity;
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
	// Speed of Sound Calculator
	public function speed_of($request)
	{
		$temperature_air_units = $request->temperature_air_units;
		$temperature_air = $request->temperature_air;
		$select_unit = $request->select_unit;
		$f_values = $request->f_values;
		$c_values = $request->c_values;
		if (isset($temperature_air_units)) {
			if ($temperature_air_units == '°C') {
				$temperature_air = $temperature_air * 1;
			} elseif ($temperature_air_units == '°F') {
				$temperature_air = ($temperature_air - 32) * 5 / 9;
			} elseif ($temperature_air_units == 'K') {
				$temperature_air =  $temperature_air - 273.15;
			}
		}
		if (is_numeric($temperature_air)) {
			$gamma = 1.4;
			$specificGasConstant = 287;
			$temperatureKelvin = $temperature_air + 273.15;
			$speedOfSound = sqrt($gamma * $specificGasConstant * $temperatureKelvin);
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['speedOfSound'] = number_format($speedOfSound, 2);
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	// Watt Hour Calculator
	public function watt_hour($request)
	{
		$volt = $request->volt;
		$volt_unit = $request->volt_unit;
		$charge = $request->charge;
		$charge_unit = $request->charge_unit;
		$power = $request->power;
		$power_unit = $request->power_unit;
		$hour = $request->hour;
		$hour_unit = $request->hour_unit;
		function convert_volt($a, $b)
		{
			if ($b == "nv") {
				$convert =  $a * 0.000000001;
			} else if ($b == "μV") {
				$convert = $a *  0.000001;
			} else if ($b == "mV") {
				$convert = $a * 0.001;
			} else if ($b == "kV") {
				$convert = $a * 0.001;
			} else if ($b == "MV") {
				$convert = $a * 1000000;
			} else if ($b == "V") {
				$convert = $a * 1;
			}
			return $convert;
		}
		function convert_watt($a, $b)
		{
			if ($b == "mW") {
				$convert =  $a * 0.001;
			} else if ($b == "W") {
				$convert = $a * 1;
			} else if ($b == "kW") {
				$convert = $a * 1000;
			} else if ($b == "MW") {
				$convert = $a * 1000000;
			} else if ($b == "BTU/h") {
				$convert = $a * 0.293071;
			} else if ($b == "hp(I)") {
				$convert = $a * 745.7;
			} else if ($b == "hp(E)") {
				$convert = $a * 746;
			}
			return $convert;
		}
		function convert_sec($a, $b)
		{
			// ["ms", "sec", "min","hrs","dys","wks","mns","yrs"];
			if ($b == "ms") {
				$convert =  $a / 3600000;
			} else if ($b == "sec") {
				$convert = $a / 3600;
			} else if ($b == "min") {
				$convert = $a / 60;
			} else if ($b == "hrs") {
				$convert = $a * 1;
			} else if ($b == "dys") {
				$convert = $a * 24;
			} else if ($b == "wks") {
				$convert = $a * 604800;
			} else if ($b == "m") {
				$convert = $a * 2628000;
			} else if ($b == "yrs") {
				$convert = $a * 31536000;
			}
			return $convert;
		}
		function convert_ampir($a, $b)
		{
			if ($b == 'C') {
				$convert = $a / 3600;
			} else if ($b == 'Ah') {
				$convert = $a * 1;
			} else if ($b == 'mAh') {
				$convert = $a / 3600000;
			}

			return $convert;
		}
		if (empty($volt) && empty($charge) && empty($power) && empty($hour)) {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		if (is_numeric($volt) && is_numeric($charge)) {
			$volt = convert_volt($volt, $volt_unit);
			$charge = convert_ampir($charge, $charge_unit);
			$energy = $volt * $charge;
			$energy_k = ($volt * $charge) / 1000;
			$this->param['type'] = "energy";
			$this->param['energy'] = $energy;
			$this->param['energy_k'] = $energy_k;
		}
		if (is_numeric($power) && is_numeric($hour)) {
			$power = convert_watt($power, $power_unit);
			$hour = convert_sec($hour, $hour_unit);
			$watt_h = $power * $hour;
			$watt_h = round($watt_h, 5);
			$watt_hk = ($power * $hour) / 1000;
			$watt_hk = round($watt_hk, 5);
			$this->param['type2'] = "watt";
			$this->param['watt_h'] = $watt_h;
			$this->param['watt_hk'] = $watt_hk;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// DC Wire Size Calculator
	public function dc_wire($request)
	{
		$submit = trim($request->wire);
		$type = trim($request->type);
		$s_voltage = trim($request->s_voltage);
		$sv_units = trim($request->sv_units);
		$voltage_drop = trim($request->voltage_drop);
		$c_units = trim($request->c_units);
		$current = trim($request->current);
		$current_unit = trim($request->current_unit);
		$wire_length = trim($request->wire_length);
		$wl_units = trim($request->wl_units);
		$w_temp = trim($request->w_temp);
		$wt_units = trim($request->wt_units);
		$wire_gauge = trim($request->wire_gauge);
		$wire_diameter = trim($request->wire_diameter);
		$wd_units = trim($request->wd_units);

		$AWG = [
			'0000 (4/0)' => ["inches" => 0.46, "mm" => 11.684, "kcmil" => 211.6, "mm²" => 107, "ft" => 0.049, "m" => 0.1608],
			'000 (3/0)' => ["inches" => 0.4096, "mm" => 10.405, "kcmil" => 167.81, "mm²" => 85, "ft" => 0.0618, "m" => 0.2028],
			'00 (2/0)' => ["inches" => 0.3648, "mm" => 9.266, "kcmil" => 133.08, "mm²" => 67.4, "ft" => 0.0779, "m" => 0.2557],
			'0 (1/0)' => ["inches" => 0.3249, "mm" => 8.251, "kcmil" => 105.53, "mm²" => 53.5, "ft" => 0.0983, "m" => 0.3224],
			'1' => ["inches" => 0.2893, "mm" => 7.348, "kcmil" => 83.693, "mm²" => 42.4, "ft" => 0.1239, "m" => 0.4066],
			'2' => ["inches" => 0.2576, "mm" => 6.544, "kcmil" => 66.371, "mm²" => 33.6, "ft" => 0.1563, "m" => 0.5127],
			'3' => ["inches" => 0.2294, "mm" => 5.827, "kcmil" => 52.635, "mm²" => 26.7, "ft" => 0.197, "m" => 0.6464],
			'4' => ["inches" => 0.2043, "mm" => 5.189, "kcmil" => 41.741, "mm²" => 21.1, "ft" => 0.2485, "m" => 0.8152],
			'5' => ["inches" => 0.1819, "mm" => 4.621, "kcmil" => 33.102, "mm²" => 16.8, "ft" => 0.3133, "m" => 1.028],
			'6' => ["inches" => 0.162, "mm" => 4.115, "kcmil" => 26.251, "mm²" => 13.3, "ft" => 0.3951, "m" => 1.296],
			'7' => ["inches" => 0.1443, "mm" => 3.665, "kcmil" => 20.818, "mm²" => 10.5, "ft" => 0.4982, "m" => 1.634],
			'8' => ["inches" => 0.1285, "mm" => 3.264, "kcmil" => 16.51, "mm²" => 8.36, "ft" => 0.6282, "m" => 1.634],
			'9' => ["inches" => 0.1144, "mm" => 2.906, "kcmil" => 13.093, "mm²" => 6.63, "ft" => 0.7921, "m" => 2.599],
			'10' => ["inches" => 0.1019, "mm" => 2.588, "kcmil" => 10.383, "mm²" => 5.26, "ft" => 0.9988, "m" => 3.277],
			'11' => ["inches" => 0.0907, "mm" => 2.305, "kcmil" => 8.234, "mm²" => 4.17, "ft" => 1.26, "m" => 4.132],
			'12' => ["inches" => 0.0808, "mm" => 2.053, "kcmil" => 6.53, "mm²" => 3.31, "ft" => 1.588, "m" => 5.211],
			'13' => ["inches" => 0.072, "mm" => 1.828, "kcmil" => 5.178, "mm²" => 2.62, "ft" => 2.003, "m" => 6.571],
			'14' => ["inches" => 0.0641, "mm" => 1.628, "kcmil" => 4.107, "mm²" => 2.08, "ft" => 2.525, "m" => 8.285],
			'15' => ["inches" => 0.0571, "mm" => 1.45, "kcmil" => 3.257, "mm²" => 1.65, "ft" => 3.184, "m" => 10.448],
			'16' => ["inches" => 0.0508, "mm" => 1.291, "kcmil" => 2.583, "mm²" => 1.31, "ft" => 4.015, "m" => 13.174],
			'17' => ["inches" => 0.0453, "mm" => 1.15, "kcmil" => 2.048, "mm²" => 1.04, "ft" => 5.063, "m" => 16.612],
			'18' => ["inches" => 0.0403, "mm" => 1.024, "kcmil" => 1.624, "mm²" => 0.823, "ft" => 6.385, "m" => 20.948],
			'19' => ["inches" => 0.0403, "mm" => 1.024, "kcmil" => 1.624, "mm²" => 0.653, "ft" => 6.385, "m" => 20.948],
			'20' => ["inches" => 0.032, "mm" => 0.8118, "kcmil" => 1.022, "mm²" => 0.518, "ft" => 10.152, "m" => 33.308],
			'21' => ["inches" => 0.0285, "mm" => 0.7229, "kcmil" => 0.8101, "mm²" => 0.410, "ft" => 12.802, "m" => 42.001],
			'22' => ["inches" => 0.0253, "mm" => 0.6438, "kcmil" => 0.6424, "mm²" => 0.326, "ft" => 16.143, "m" => 52.962],
			'23' => ["inches" => 0.0226, "mm" => 0.5733, "kcmil" => 0.5095, "mm²" => 0.258, "ft" => 20.356, "m" => 66.784],
			'24' => ["inches" => 0.0201, "mm" => 0.5106, "kcmil" => 0.404, "mm²" => 0.205, "ft" => 25.668, "m" => 84.213],
			'25' => ["inches" => 0.0179, "mm" => 0.4547, "kcmil" => 0.3204, "mm²" => 0.162, "ft" => 32.367, "m" => 106.19],
			'26' => ["inches" => 0.0159, "mm" => 0.4049, "kcmil" => 0.2541, "mm²" => 0.129, "ft" => 40.814, "m" => 133.9],
			'27' => ["inches" => 0.0142, "mm" => 0.3606, "kcmil" => 0.2015, "mm²" => 0.102, "ft" => 51.466, "m" => 168.85],
			'28' => ["inches" => 0.0126, "mm" => 0.3211, "kcmil" => 0.1598, "mm²" => 0.0810, "ft" => 64.897, "m" => 212.92],
			'29' => ["inches" => 0.0113, "mm" => 0.2859, "kcmil" => 0.1267, "mm²" => 0.0642, "ft" => 81.833, "m" => 268.48],
			'30' => ["inches" => 0.01, "mm" => 0.2546, "kcmil" => 0.1005, "mm²" => 0.0509, "ft" => 103.19, "m" => 338.55],
			'31' => ["inches" => 0.008928, "mm" => 0.2268, "kcmil" => 0.0797, "mm²" => 0.0404, "ft" => 130.12, "m" => 426.9],
			'32' => ["inches" => 0.00795, "mm" => 0.2019, "kcmil" => 0.0632, "mm²" => 0.0320, "ft" => 164.08, "m" => 538.32],
			'33' => ["inches" => 0.00708, "mm" => 0.1798, "kcmil" => 0.0501, "mm²" => 0.0254, "ft" => 206.9, "m" => 678.8],
			'34' => ["inches" => 0.006305, "mm" => 0.006305, "kcmil" => 0.0398, "mm²" => 0.0201, "ft" => 260.9, "m" => 260.9],
			'35' => ["inches" => 0.005615, "mm" => 0.1426, "kcmil" => 0.0315, "mm²" => 0.0160, "ft" => 328.98, "m" => 1079.3],
			'36' => ["inches" => 0.005, "mm" => 0.127, "kcmil" => 0.025, "mm²" => 0.0127, "ft" => 414.84, "m" => 1361],
			'37' => ["inches" => 0.004453, "mm" => 0.1131, "kcmil" => 0.0198, "mm²" => 0.0100, "ft" => 523.1, "m" => 1716.2],
			'38' => ["inches" => 0.003965, "mm" => 0.1007, "kcmil" => 0.0157, "mm²" => 0.007967, "ft" => 659.62, "m" => 2164.1],
			'39' => ["inches" => 0.003531, "mm" => 0.0897, "kcmil" => 0.0125, "mm²" => 0.00632, "ft" => 831.77, "m" => 2728.9],
			'40' => ["inches" => 0.003145, "mm" => 0.0799, "kcmil" => 0.009888, "mm²" => 0.00501, "ft" => 1048.8, "m" => 3441.1],
		];
		function munits($unit)
		{
			$result = array();
			if ($unit == 'copper') {
				$result['unit'] = 1.68;
				$result['tempCoefficient'] = 0.00404;
			} else if ($unit == 'aluminum') {
				$result['unit'] = 2.65;
				$result['tempCoefficient'] = 0.0039;
			} else if ($unit == 'gold') {
				$result['unit'] = 2.44;
				$result['tempCoefficient'] = 0;
			} else if ($unit == 'silver') {
				$result['unit'] = 1.59;
				$result['tempCoefficient'] = 0;
			} else if ($unit == 'nickel') {
				$result['unit'] = 6.99;
				$result['tempCoefficient'] = 0;
			} else if ($unit == 'steel') {
				$result['unit'] = 1;
				$result['tempCoefficient'] = 0;
			}
			return $result;
		}
		function getNearestValue($arr, $target)
		{
			$nearest = null;
			$minDiff = PHP_INT_MAX;
			foreach ($arr as $key => $value) {
				$mm_val = $value['mm²'];
				$diff = abs($mm_val - $target);
				if ($diff < $minDiff) {
					$minDiff = $diff;
					$nearest = $mm_val;
					$index = $key;
					$return_val = $value;
				}
			}

			return [$nearest, $index, $return_val];
		}
		function getNearestValueDiameter($arr, $diameter)
		{
			$nearest = null;
			$minDiff = PHP_INT_MAX;
			foreach ($arr as $key => $value) {
				$mm_val = $value['inches'];
				$diff = abs($mm_val - $diameter);
				if ($diff < $minDiff) {
					$minDiff = $diff;
					$nearest = $mm_val;
					$index = $key;
					$return_val = $value;
				}
			}

			return [$nearest, $index, $return_val];
		}

		if ($submit == 'wire_size') {
			if (is_numeric($s_voltage) && is_numeric($voltage_drop) && is_numeric($current) && is_numeric($wire_length) && is_numeric($w_temp)) {
				if (isset($sv_units)) {
					if ($sv_units == 'mV') {
						$s_voltage = $s_voltage * 0.001;
					} else if ($sv_units == 'kV') {
						$s_voltage = $s_voltage * 1000;
					} else if ($sv_units == 'MV') {
						$s_voltage = $s_voltage * 1000000;
					}
				}
				if (isset($current_unit)) {
					if ($current_unit == 'mA') {
						$current = $current * 0.001;
					} else if ($current_unit == 'µA') {
						$current = $current * 0.000001;
					}
				}
				if (isset($wl_units)) {
					if ($wl_units == 'cm') {
						$wire_length = $wire_length * 0.01;
					} else if ($wl_units == 'km') {
						$wire_length = $wire_length * 1000;
					} else if ($wl_units == 'in') {
						$wire_length = $wire_length * 0.0254;
					} else if ($wl_units == 'ft') {
						$wire_length = $wire_length * 0.3048;
					} else if ($wl_units == 'yd') {
						$wire_length = $wire_length * 0.9144;
					} else if ($wl_units == 'mi') {
						$wire_length = $wire_length * 1609.3;
					}
				}
				if (isset($wt_units)) {
					if ($wt_units == '°F') {
						$w_temp = ($w_temp * 9 / 5) + 32;
					} else if ($wt_units == 'K') {
						$w_temp = $w_temp + 273.15;
					}
				}
				if ($type == 'single_phase') {
					$result  = munits($c_units);
					$metalunit = $result['unit'];
					$tempCoefficient = $result['tempCoefficient'];
					if ($w_temp >= 50) {
						$metalunit = $metalunit * (1 + $tempCoefficient * ($w_temp - 20));
					}
					$pow = pow(10, -8);
					$res = $current * $metalunit * $pow * (2 * $wire_length);
					$v_d = $voltage_drop / 100;
					$v = $v_d * $s_voltage;
					$am = $res / $v;
					$single_phase = $am * 1000000;
					$s_data = getNearestValue($AWG, $single_phase);
					$this->param['single_phase'] = $single_phase;
					$this->param['s_data'] = $s_data;
				} else if ($type == 'three_phase') {
					$result  = munits($c_units);
					$metalunit = $result['unit'];
					if ($w_temp >= 50) {
						$tempCoefficient = $result['tempCoefficient'];
						$metalunit = $metalunit * (1 + $tempCoefficient * ($w_temp - 20));
					}
					$sqrt = sqrt(3);
					$pow = pow(10, -8);
					$res = $sqrt * $current * $metalunit * $pow * $wire_length;
					$v_d = $voltage_drop / 100;
					$v = $v_d * $s_voltage;
					$am = $res / $v;
					$three_phase = round($am *  1000000, 2);
					$t_data = getNearestValue($AWG, $three_phase);
					$this->param['three_phase'] = $three_phase;
					$this->param['t_data'] = $t_data;
					$this->param['sqrt'] = $sqrt;
				}
				$this->param['type'] = $type;
				$this->param['res'] = $res;
				$this->param['s_voltage'] = $s_voltage;
				$this->param['voltage_drop'] = $voltage_drop;
				$this->param['current'] = $current;
				$this->param['metalunit'] = $metalunit;
				$this->param['wire_length'] = $wire_length;
				$this->param['c_units'] = $c_units;
				$this->param['am'] = $am;
				$this->param['v'] = $v;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($submit == 'wire_diameter') {
			if (substr($wire_gauge, -6) === "-kcmil") {
				$parts = explode("-", $wire_gauge);
				$new_string = $parts[0];
				$kcmil = $new_string;
				$sd_in = $new_string / 1000;
				$inches = sqrt($sd_in);
				$mm = $inches * 25.4;
				$p = pow($mm, 2);
				$pai = 3.14 / 4;
				$sqinches = $pai * $sd_in;
				$mm2 = $pai * $p;
			} else {
				$modelDetail = $AWG[$wire_gauge];
				$inches = $modelDetail['inches'];
				$mm = $modelDetail['mm'];
				$kcmil = $modelDetail['kcmil'];
				$in = $kcmil / 1000;
				$pai = 3.14 / 4;
				$sqinches = $pai * $in;
				$mm2 = $modelDetail['mm²'];
			}
			$this->param['inches'] = $inches;
			$this->param['sqinches'] = $sqinches;
			$this->param['mm'] = $mm;
			$this->param['kcmil'] = $kcmil;
			$this->param['mm2'] = $mm2;
		} else if ($submit == 'wire_gauge') {
			if (is_numeric($wire_diameter)) {
				if (isset($wd_units)) {
					if ($wd_units == 'mm') {
						$wire_diameter = $wire_diameter / 25.4;
					} else if ($wd_units == 'cm') {
						$wire_diameter = $wire_diameter / 2.54;
					}
				}
				$d_data = getNearestValueDiameter($AWG, $wire_diameter);
				$p = pow($wire_diameter, 2);
				$kcmil = $p * 1000;
				$pai = 22 / 7;
				$dpai = $pai / 4;
				$inches = $kcmil / 1000;
				$square_in = $inches * $dpai;
				$this->param['d_data'] = $d_data;
				$this->param['square_in'] = $square_in;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['submit'] = $submit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
		// Newton's Law of Cooling Calculator
	function newtons($request)
	{
		$ambient = $request->ambient;
		$ambient_units = $request->ambient_units;
		$initial_temperature = $request->initial_temperature;
		$initial_temp_units = $request->initial_temp_units;
		$area = $request->area;
		$area_units = $request->area_units;
		$heat_capacity = $request->heat_capacity;
		$heat_capacity_units = $request->heat_capacity_units;
		$heat_transfer_co = $request->heat_transfer_co;
		$heat_transfer_co_units = $request->heat_transfer_co_units;
		$temp_after = $request->temp_after;
		$temp_after_units = $request->temp_after_units;
		if (isset($ambient_units)) {
			if ($ambient_units == '°C') {
				$ambient = $ambient;
			} elseif ($ambient_units == '°F') {
				$ambient = ($ambient - 32) * 5 / 9;
			} elseif ($ambient_units == 'K') {
				$ambient =  $ambient - 273.15;
			}
		}
		if (isset($initial_temp_units)) {
			if ($initial_temp_units == '°C') {
				$initial_temperature = $initial_temperature;
			} elseif ($initial_temp_units == '°F') {
				$initial_temperature = ($initial_temperature - 32) * 5 / 9;
			} elseif ($initial_temp_units == 'K') {
				$initial_temperature =  $initial_temperature - 273.15;
			}
		}
		if (isset($heat_capacity_units)) {
			if ($heat_capacity_units == 'J/K') {
				$heat_capacity = $heat_capacity;
			} elseif ($heat_capacity_units == 'J/°C') {
				$heat_capacity = $heat_capacity;
			} elseif ($heat_capacity_units == 'BTU/°F') {
				$heat_capacity =  $heat_capacity / 0.0005266;
			}
		}
		if (isset($temp_after_units)) {
			if ($temp_after_units == 'sec') {
				$temp_after = $temp_after;
			} elseif ($temp_after_units == 'min') {
				$temp_after = $temp_after * 60;
			} elseif ($temp_after_units == 'hrs') {
				$temp_after =  $temp_after * 3600;
			}
		}
		if (isset($heat_transfer_co_units)) {
			if ($heat_transfer_co_units == 'W/(m²·K)') {
				$heat_transfer_co = $heat_transfer_co;
			} elseif ($heat_transfer_co_units == 'BTU/(h·ft²·°F)') {
				$heat_transfer_co = $heat_transfer_co * 0.1761;
			}
		}
		if (isset($area_units)) {
			if ($area_units == 'mm²') {
				$area = $area / 1000000;
			} elseif ($area_units == 'cm²') {
				$area = $area / 10000;
			} elseif ($area_units == 'm²') {
				$area = $area;
			} elseif ($area_units == 'km²') {
				$area = $area * 1000000;
			} elseif ($area_units == 'in²') {
				$area = $area * 0.00064516;
			} elseif ($area_units == 'ft²') {
				$area = $area * 0.092903;
			} elseif ($area_units == 'yd²') {
				$area = $area * 0.836127;
			}
		}
		if (is_numeric($ambient) && is_numeric($initial_temperature) && is_numeric($area) && is_numeric($heat_capacity) && is_numeric($heat_transfer_co) && is_numeric($temp_after)) {
			// first find k
			$k  = ($heat_transfer_co * $area) / $heat_capacity;
			// echo number_format($k,10);die;
			$temperature = $ambient + ($initial_temperature - $ambient) * exp(-$k * $temp_after);
			$this->param['k'] = $k;
			$this->param['temperature'] = $temperature;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Normal Force Calculator
	public function normal($request)
	{
		$surface = $request->surface;
		$external = $request->external;
		$angle = $request->angle;
		$angle_units = $request->angle_units;
		$outside_force = $request->outside_force;
		$outside_force_units = $request->outside_force_units;
		$mass = $request->mass;
		$mass_units = $request->mass_units;
		if (isset($mass_units)) {
			if ($mass_units == 'µg') {
				$mass = $mass / 1000000000; // Convert micrograms to kilograms
			} elseif ($mass_units == 'mg') {
				$mass = $mass / 1000000; // Convert milligrams to kilograms
			} elseif ($mass_units == 'g') {
				$mass = $mass / 1000;
			} elseif ($mass_units == 'dag') {
				$mass = $mass / 100; // Convert decagrams to kilograms
			} elseif ($mass_units == 'kg') {
				// Mass is already in kilograms, no conversion needed
			} elseif ($mass_units == 't') {
				$mass = $mass / 0.001; // Convert metric tons to kilograms
			} elseif ($mass_units == 'gr') {
				$mass = $mass / 15432; // Convert grains to kilograms
			} elseif ($mass_units == 'dr') {
				$mass = $mass / 564.4; // Convert drams to kilograms
			} elseif ($mass_units == 'oz') {
				$mass = $mass / 35.274; // Convert ounces to kilograms
			} elseif ($mass_units == 'lb') {
				$mass = $mass / 2.2046; // Convert pounds to kilograms
			}
		}
		if (isset($angle_units)) {
			if ($angle_units == 'deg') {
				$angle = $angle;
			} elseif ($angle_units == 'ran') {
				$angle = $angle * 0.017453;
			} elseif ($angle_units == 'gon') {
				$angle = $angle * 1.111;
			} elseif ($angle_units == 'tr') {
				$angle = $angle * 0.002778;
			}
		}
		if (isset($outside_force_units)) {
			if ($outside_force_units == 'N') {
				$outside_force = $outside_force;
			} elseif ($outside_force_units == 'KN') {
				$outside_force = $outside_force * 0.001;
			} elseif ($outside_force_units == 'MN') {
				$outside_force = $outside_force * 0.000001;
			} elseif ($outside_force_units == 'GN') {
				$outside_force = $outside_force * 0.000000001;
			} elseif ($outside_force_units == 'TN') {
				$outside_force = $outside_force * 0.000000000001;
			}
		}
		if ($surface === 'inclined') {
			if (is_numeric($mass) && is_numeric($angle)) {
				$normal_force = $mass * 9.80665 * cos(deg2rad($angle));
				$this->param['normal_force'] = $normal_force;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if ($external === 'no') {
				if (is_numeric($mass)) {
					$normal_force = $mass * 9.80665;
					$this->param['normal_force'] = $normal_force;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($external === 'downward') {
				if (is_numeric($mass) && is_numeric($angle) && is_numeric($outside_force)) {
					$angle = deg2rad($angle);
					$normal_force = ($mass * 9.80665) + ($outside_force * sin($angle));
					$this->param['normal_force'] = $normal_force;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($external === 'upward') {
				if (is_numeric($mass) && is_numeric($angle) && is_numeric($outside_force)) {
					$angle = deg2rad($angle);
					$normal_force = ($mass * 9.80665) - ($outside_force * sin($angle));
					$this->param['normal_force'] = $normal_force;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Orbital Period Calculator
	public function orbital($request)
	{
		$density = trim($request->density);
		$density_unit = trim($request->density_unit);
		$Semi = trim($request->Semi);
		$Semi_unit = trim($request->Semi_unit);
		$first = trim($request->first);
		$first_unit = trim($request->first_unit);
		$second = trim($request->second);
		$second_unit = trim($request->second_unit);

		function central_unit($density, $density_unit)
		{
			if ($density_unit == "kg/m³") {
				$density = $density * 1000;
			} elseif ($density_unit == "lb/ft³") {
				$density = $density * 62.428;
			} elseif ($density_unit == "lb/yd³") {
				$density = $density * 1686;
			} elseif ($density_unit == "g/cm³") {
				$density = $density;
			} elseif ($density_unit == "kg/cm³") {
				$density = $density / 1000;
			} elseif ($density_unit == "mg/cm³") {
				$density = $density * 1000;
			} elseif ($density_unit == "g/m³") {
				$density = $density * 1e+6;
			}
			return $density;
		}
		function mass_unit($first, $first_unit)
		{
			if ($first_unit === "kg") {
				$first = $first;
			} elseif ($first_unit === "t") {
				$first = $first / 1000;
			} elseif ($first_unit === "lb") {
				$first = $first * 2.205;
			} elseif ($first_unit === "st") {
				$first = $first / 6.35;
			} elseif ($first_unit === "US ton") {
				$first = $first / 907.2;
			} elseif ($first_unit === "long ton") {
				$first = $first / 1016;
			} elseif ($first_unit === "earth") {
				$first = $first * 5972000000000000000000;
			} elseif ($first_unit === "sun") {
				$first = $first / 1e+6;
			}
			return $first;
		}



		function major_unit($Semi, $Semi_unit)
		{
			if ($Semi_unit == "m") {
				$Semi = $Semi;
			} elseif ($Semi_unit == "km") {
				$Semi = $Semi / 1000;
			} elseif ($Semi_unit == "yd") {
				$Semi = $Semi / 0.9144;
			} elseif ($Semi_unit == "mi") {
				$Semi = $Semi / 1609.34;
			} elseif ($Semi_unit == "nmi") {
				$Semi = $Semi / 1852;
			} elseif ($Semi_unit == "Ro") {
				$Semi = $Semi / 1.36e+7;
			} elseif ($Semi_unit == "ly") {
				$Semi = $Semi / 9.461e+15;
			} elseif ($Semi_unit == "au") {
				$Semi = $Semi / 149597870700;
			} elseif ($Semi_unit == "pcs") {
				$Semi = $Semi / 20626480624740;
			}
			return $Semi;
		}

		if (is_numeric($density) && is_numeric($Semi) && is_numeric($first) && is_numeric($second)) {

			if ($density == 0) {
				$this->param['error'] = 'central body density value cannot be equal to zero';
				return $this->param;
			}

			if ($Semi == 0) {
				$this->param['error'] = 'semi-major axis value cannot be equal to zero';
				return $this->param;
			}

			if ($first == 0) {
				$this->param['error'] = 'first body mass value cannot be equal to zero';
				return $this->param;
			}

			if ($second == 0) {
				$this->param['error'] = 'second body mass value cannot be equal to zero';
				return $this->param;
			}


			$G = 6.67430e-11;

			$density = central_unit($density, $density_unit);

			$Semi =  major_unit($Semi, $Semi_unit);


			$first =  mass_unit($first, $first_unit);
			$second =  mass_unit($second, $second_unit);


			$density_si = $density * 1000;
			$orbital_period = sqrt(3 * pi() / ($G * $density_si));
			$orbital_period_hours = $orbital_period / 3600;
			$answer = $orbital_period_hours * 1000;

			$tbinary = 2 * M_PI * sqrt(pow($Semi, 3) / ($G * ($first + $second)));
			$hours = $tbinary / 3600;
			$sub_answer = $hours;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}

		$this->param['sub_answer'] = $sub_answer;
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Energy Cost Calculator
	public function energy($request)
	{  
		//  dd($request->all());
		$hours_per_day = $request->hours_per_day;
		$power = $request->power;
		$power_units = $request->power_units;
		$cost = $request->cost;
		$cost_units = $request->cost_units;
		$currancy = $request->currancy;
		if (isset($power_units)) {
			if ($power_units == 'watts (W)') {
				$power = $power;
			} elseif ($power_units == 'kilowatts (kW)') {
				$power = $power * 1000;
			}
		}
		$cost_units = str_replace($currancy . '/', '', $cost_units);
		if (isset($cost_units)) {
			if ($cost_units == 'rupee') {
				$cost = $cost * 100;
			} elseif ($cost_units == 'peso') {
				$cost = $cost * 100;
			} elseif ($cost_units == 'pence') {
				$cost = $cost;
			} elseif ($cost_units == 'cent') {
				$cost = $cost;
			}
		}
		if (is_numeric($hours_per_day) && is_numeric($power) && is_numeric($cost)) {
			if ($power == 0 || $hours_per_day == 0) {
				$this->param['error'] = 'Value cannot be zero ! Check Input';
				return $this->param;
			} else {

				$energy_consumed_per_day = ($power * $hours_per_day) / 1000;

				// dd($energy_consumed_per_day,$cost);
				$energy_cost_per_day = $energy_consumed_per_day * $cost / 100;
				$energy_cost_per_month = $energy_cost_per_day * 30;

				$energy_cost_per_year = $energy_cost_per_day * 365;

				$this->param['energy_cost_per_day'] = $energy_cost_per_day;
				$this->param['energy_cost_per_month'] = $energy_cost_per_month;
				$this->param['energy_cost_per_year'] = $energy_cost_per_year;

				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Time Dilation Calculator
	public function time_dilation($request)
	{
		$interval = trim($request->interval);
		$interval_one = trim($request->interval_one);
		$interval_sec = trim($request->interval_sec);
		$interval_unit = trim($request->interval_unit);
		$velocity = trim($request->velocity);
		$velocity_unit = trim($request->velocity_unit);

		function speed_unit1($velocity, $velocity_unit)
		{
			if ($velocity_unit == "m/s") {
				$velocity =  $velocity / 1000;
			} elseif ($velocity_unit == "km/s") {
				$velocity = $velocity;
			} elseif ($velocity_unit == "mi/s") {
				$velocity = $velocity * 0.621371;
			} elseif ($velocity_unit == "c") {
				$velocity = $velocity * 0.00000333564;
			}
			return $velocity;
		}

		function time_unit($interval, $interval_unit)
		{
			if ($interval_unit == "sec") {
				$interval = $interval;
			} elseif ($interval_unit == "mins") {
				$interval = $interval * 60;
			} elseif ($interval_unit == "hrs") {
				$interval = $interval * 3600;
			} elseif ($interval_unit == "days") {
				$interval = $interval * 86400;
			} elseif ($interval_unit == "wks") {
				$interval = $interval * 604800;
			} elseif ($interval_unit == "mos") {
				$interval = $interval * 2629800;
			} elseif ($interval_unit == "yrs") {
				$interval = $interval * 31557600;
			}
			return $interval;
		}
		function other_time($interval_one, $interval_sec, $interval_unit)
		{
			if ($interval_unit === "mins/sec") {
				$interval = ($interval_one * 60) + $interval_sec;
			} elseif ($interval_unit === "hrs/mins") {
				$interval = ($interval_one *  3600) + ($interval_sec * 60);
			} elseif ($interval_unit === "yrs/mos") {
				$interval = ($interval_one *  31557600) + ($interval_sec *  2629800);
			} elseif ($interval_unit === "wks/days") {
				$interval = ($interval_one * 604800) + ($interval_sec * 86400);
			}
			return $interval;
		}
		if ($interval_unit === 'mins/sec' || $interval_unit === 'hrs/mins' || $interval_unit === 'yrs/mos' || $interval_unit === 'wks/days') {
			if (empty($workde_one) && empty($interval_sec)) {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
			if (empty($interval_one)) {
				$interval_one = 0;
			}
			if (empty($interval_sec)) {
				$interval_sec = 0;
			}
			if (is_numeric($interval_one) && is_numeric($interval_sec) && is_numeric($velocity)) {

				$interval = other_time($interval_one, $interval_sec, $interval_unit);
				$velocity = speed_unit1($velocity, $velocity_unit);
				$observer_velocity_m_s = $velocity * 1000;
				$speed_of_light = 299792458;
				$lorentz_factor = 1 / sqrt(1 - (($observer_velocity_m_s ** 2) / ($speed_of_light ** 2)));
				$answer = $lorentz_factor * $interval;
				$this->param['answer'] = $answer;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if (is_numeric($interval) && is_numeric($velocity)) {
				$interval = time_unit($interval, $interval_unit);
				$velocity = speed_unit1($velocity, $velocity_unit);
				$observer_velocity_m_s = $velocity * 1000;
				$speed_of_light = 299792458;
				$lorentz_factor = 1 / sqrt(1 - (($observer_velocity_m_s ** 2) / ($speed_of_light ** 2)));
				$answer = $lorentz_factor * $interval;
				$this->param['answer'] = $answer;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Friction Loss Calculator
	public function friction_loss($request)
	{
		$pipe_diameter = trim($request->pipe_diameter);
		$pipe_diameter_unit = trim($request->pipe_diameter_unit);
		$pipe_length = trim($request->pipe_length);
		$pipe_length_unit = trim($request->pipe_length_unit);
		$volumetric = trim($request->volumetric);
		$volumetric_unit = trim($request->volumetric_unit);
		$material = trim($request->material);
		function pipe_convert($a, $b)
		{
			if ($b === "mm") {
				$pipe_ans = $a / 1000;
			} else if ($b === "cm") {
				$pipe_ans = $a / 100;
			} else if ($b === "m") {
				$pipe_ans = $a * 1;
			} else if ($b === "in") {
				$pipe_ans = $a / 39.37;
			} else {
				$pipe_ans = $a / 3.281;
			}
			return $pipe_ans;
		}
		function volumetric_convert($a, $b)
		{
			if ($b === "1") {
				$volumetric_ans = $a * 0.0037854;
			} else if ($b === "2") {
				$volumetric_ans = $a * 0.00006309;
			} else if ($b === "3") {
				$volumetric_ans = $a * 0.0000010515;
			} else if ($b === "4") {
				$volumetric_ans = $a * 0.004546;
			} else if ($b === "5") {
				$volumetric_ans = $a * 0.00007577;
			} else if ($b === "6") {
				$volumetric_ans = $a * 0.0000012628;
			} else if ($b === "7") {
				$volumetric_ans = $a * 0.028317;
			} else if ($b === "8") {
				$volumetric_ans = $a * 0.00047195;
			} else if ($b === "9") {
				$volumetric_ans = $a * 0.000007866;
			} else if ($b === "10") {
				$volumetric_ans = $a * 1;
			} else if ($b === "11") {
				$volumetric_ans = $a * 0.016667;
			} else if ($b === "12") {
				$volumetric_ans = $a * 0.0002778;
			} else if ($b === "13") {
				$volumetric_ans = $a * 0.001;
			} else if ($b === "14") {
				$volumetric_ans = $a * 0.000016667;
			} else if ($b === "15") {
				$volumetric_ans = $a * 0.0000002778;
			} else if ($b === "16") {
				$volumetric_ans = $a * 0.000000016667;
			} else {
				$volumetric_ans = $a * 0.0000000002778;
			}
			return $volumetric_ans;
		}
		if (is_numeric($pipe_diameter) && is_numeric($pipe_length) && is_numeric($volumetric)) {
			$pipe_diameter = pipe_convert($pipe_diameter, $pipe_diameter_unit);
			$pipe_length = pipe_convert($pipe_length, $pipe_length_unit);
			$name = ["US gal/s", "US gal/min", "US gal/hr", "UK gal/s", "UK gal/min", "UK gal/hr", "ft³/s", "ft³/min", "ft³/hr", "m³/s", "m³/min", "m³/hr", "L/s", "L/min", "L/hr", "ml/min", "ml/hr"];
			$volumetric_unit = array_search($volumetric_unit, $name);
			$volumetric_unit++;
			$volumetric = volumetric_convert($volumetric, $volumetric_unit);
			// dd($volumetric,$material);
			$up_div = pow(($volumetric / $material), 1.852);
			$head_loss = (10.67 * $pipe_length * $up_div) / pow($pipe_diameter, 4.87);
			$pressure_loss = ($head_loss * 9810) / 100000;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['head_loss'] = $head_loss;
		$this->param['pressure_loss'] = $pressure_loss;
		$this->param['material'] = $request->material;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	// Relative Humidity Calculator
	public function relative($request)
	{
		//  dd($request->all());
		$temperature = trim($request->temperature);
		$temperature_unit = trim($request->temperature_unit);
		$point = trim($request->point);
		$point_unit = trim($request->point_unit);
		function framing_units($temperature, $temperature_unit)
		{
			if ($temperature_unit === "°F") {
				$temperature = ($temperature - 32) * 5 / 9;
			} elseif ($temperature_unit === "K") {
				$temperature = $temperature - 273.15;
			} else {
				$temperature = $temperature;
			}
			return $temperature;
		}
		if ($temperature_unit === "°C") {
			if ($temperature >= 61) {
				$this->param['error'] = 'temperature should be 60 °C equal or lower';
				return $this->param;
			}
		} elseif ($temperature_unit === "°F") {
			if ($temperature >= 141) {
				$this->param['error'] = 'Temperature should be lower 140 °F equal or lower';
				return $this->param;
			}
		} elseif ($temperature_unit === "K") {
			if ($temperature == 0) {
				$this->param['error'] = 'Temperature should be 273.15 k equal or upper';
				return $this->param;
			}
		}
		if (is_numeric($temperature) && is_numeric($point)) {
			$temperature = framing_units($temperature, $temperature_unit);
			$point = framing_units($point, $point_unit);

			
			
			$Pws = 6.112 * exp((17.67 * $temperature) / ($temperature + 243.5));
			$Pw = 6.112 * exp((17.67 * $point) / ($point + 243.5));
			$answer =  ($Pw / $Pws) * 100;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
		// Watt Calculator
	public function watt($request)
	{
		$resistance = trim($request->resistance);
		$resistance_unit = trim($request->resistance_unit);
		$current = trim($request->current);
		$current_unit = trim($request->current_unit);
		$voltage = trim($request->voltage);
		$voltage_unit = trim($request->voltage_unit);
		$power = trim($request->power);
		$power_unit = trim($request->power_unit);
		function Resistance_Unit($resistance, $unit)
		{
			if ($unit == "kΩ") {
				$resistance *= 1000;
			}
			if ($unit == "MΩ") {
				$resistance *= 1000000;
			}
			return $resistance;
		}
		function Current_Unit($current, $unit)
		{
			if ($unit == "μA") {
				$current *= 0.000001;
			}
			if ($unit == "mA") {
				$current *= 0.001;
			}
			if ($unit == "kA") {
				$current *= 1000;
			}
			if ($unit == "MA") {
				$current *= 1000000;
			}
			return $current;
		}
		function Voltage_Unit($voltage, $unit)
		{
			if ($unit == "μV") {
				$voltage *= 0.000001;
			}
			if ($unit == "mV") {
				$voltage *= 0.001;
			}
			if ($unit == "kV") {
				$voltage *= 1000;
			}
			if ($unit == "MV") {
				$voltage *= 1000000;
			}
			return $voltage;
		}
		function Power_Unit($power, $unit)
		{
			if ($unit == "μW") {
				$power *= 0.000001;
			} elseif ($unit == "mW") {
				$power *= 0.001;
			} elseif ($unit == "kW") {
				$power *= 1000;
			} elseif ($unit == "MW") {
				$power *= 1000000;
			}
			return $power;
		}
		$filledCount = 0;
		if (!empty($resistance)) {
			$filledCount++;
		}
		if (!empty($current)) {
			$filledCount++;
		}
		if (!empty($voltage)) {
			$filledCount++;
		}
		if (!empty($power)) {
			$filledCount++;
		}
		if ($filledCount == 2) {
			if (!empty($resistance) && !empty($current)) {
				$resistance =  Resistance_Unit($resistance, $resistance_unit);
				$current  =  Current_Unit($current,  $current_unit);
				$voltage = $current * $resistance;
				$power = $current * $voltage;
				$this->param['voltage'] = $voltage;
				$this->param['power'] = $power;
			} elseif (!empty($resistance) && !empty($voltage)) {
				$resistance =  Resistance_Unit($resistance, $resistance_unit);
				$voltage =  Voltage_Unit($voltage, $voltage_unit);
				$current = $voltage / $resistance;
				$power = $current * $voltage;
				$this->param['current'] = $current;
				$this->param['power'] = $power;
			} elseif (!empty($resistance) && !empty($power)) {
				$resistance =  Resistance_Unit($resistance, $resistance_unit);
				$power =  Power_Unit($power, $power_unit);
				$current = sqrt($power / $resistance);
				$voltage = $current * $resistance;
				$this->param['current'] = $current;
				$this->param['voltage'] = $voltage;
			} elseif (!empty($current) && !empty($voltage)) {
				$current  =  Current_Unit($current,  $current_unit);
				$voltage =  Voltage_Unit($voltage, $voltage_unit);
				$resistance = $voltage / $current;
				$power = $voltage * $current;
				$this->param['resistance'] = $resistance;
				$this->param['power'] = $power;
			} elseif (!empty($current) && !empty($power)) {
				$current  =  Current_Unit($current,  $current_unit);
				$power =  Power_Unit($power, $power_unit);
				$resistance = $power / ($current * $current);
				$voltage = $power / $current;
				$this->param['resistance'] = $resistance;
				$this->param['voltage'] = $voltage;
			} else {
				$power =  Power_Unit($power, $$power_unit);
				$voltage =  Voltage_Unit($voltage, $voltage_unit);
				$current = $power / $voltage;
				$resistance = $voltage / $current;
				$this->param['current'] = $current;
				$this->param['resistance'] = $resistance;
			}
		} else {
			$this->param['error'] = 'Please fill exactly 2 input fields.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// FPE Calculator
	public function fpe($request)
	{
		$velocity = trim($request->velocity);
		$weight = trim($request->weight);
		if (is_numeric($velocity) && is_numeric($weight)) {
			$answer = $velocity * $velocity * $weight / 450240;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Buoyancy Calculator
	public function buoyancy($request)
	{
		$density = trim($request->density);
		$volume = trim($request->volume);
		$gravity = trim($request->gravity);
		if (is_numeric($density) && is_numeric($volume) && is_numeric($gravity)) {
			$answer = $density * $volume * $gravity;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Volts To Joules Calculator
	public function volts($request)
	{ 
		$volts = trim($request->volts);
		$coulombs = trim($request->coulombs);
		$joules = trim($request->joules);
		$Solve_unit = trim($request->Solve_unit);

		function solve_values($Solve_unit, $volts, $coulombs, $joules)
		{
			if ($Solve_unit == "Joules") {
				$answer = $volts * $coulombs;
			} elseif ($Solve_unit == "Volts") {
				$answer = $joules / $coulombs;
			} elseif ($Solve_unit == "Coulombs") {
				$answer = $joules / $volts;
			}
			return $answer;
		}
		if (is_numeric($volts) && is_numeric($joules) && is_numeric($coulombs)) {
			$answer = solve_values($Solve_unit, $volts, $coulombs, $joules);
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Efficiency Calculator
	public function efficiency($request)
	{
	
		$solve = trim($request->solve);
		$en_ou = trim($request->en_ou);
		$en_ou_unit = trim($request->en_ou_unit);
		$en_in = trim($request->en_in);
		$en_in_unit = trim($request->en_in_unit);
		$en_ef = trim($request->en_ef);
		function en_convert($a, $b)
		{
			if ($b === "J") {
				$en_ans = $a * 1;
			} else if ($b === "kJ") {
				$en_ans = $a * 1000;
			} else if ($b === "MJ") {
				$en_ans = $a * 1000000;
			} else if ($b === "Wh") {
				$en_ans = $a * 3600;
			} else if ($b === "kWh") {
				$en_ans = $a * 3600000;
			} else if ($b === "ft-lbs") {
				$en_ans = $a * 1.3558;
			} else if ($b === "kcal") {
				$en_ans = $a * 4184;
			} else {
				$en_ans = $a / 6242000000000000000;
			}
			return $en_ans;
		}
		$en_ou = en_convert($en_ou, $en_ou_unit);
		$en_in = en_convert($en_in, $en_in_unit);
		if ($solve === "1") {
			if (is_numeric($en_ou) && is_numeric($en_in)) {
				$answer = ($en_ou / $en_in) * 100;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($solve === "2") {
			if (is_numeric($en_ou) && is_numeric($en_ef)) {
				$answer = ($en_ou * 100) / $en_ef;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if (is_numeric($en_in) && is_numeric($en_ef)) {
				$answer = ($en_ef / 100) * $en_in;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Joules Calculator
	public function joule($request)
	{
		$mass = trim($request->mass);
		$mass_unit = trim($request->mass_unit);
		$velocity = trim($request->velocity);
		$velocity_unit = trim($request->velocity_unit);
		$joule_unit = trim($request->joule_unit);

		function joule_unit($energy, $joule_unit)
		{
			if ($joule_unit == "Joule (J)") {
				$unit = $energy / 1;
			} elseif ($joule_unit == "BTU (mean)") {
				$unit = $energy / 1055.87;
			} elseif ($joule_unit == "BTU (thermochemical)") {
				$unit = $energy / 1054.35;
			} elseif ($joule_unit == "Calorie (SI) (cal)") {
				$unit = $energy / 4.1868;
			} elseif ($joule_unit == "Electron volt (eV)") {
				$unit = $energy / 0.000000000000000000160;
			} elseif ($joule_unit == "Erg (erg)") {
				$unit = $energy / 0.0000001;
			} elseif ($joule_unit == "Foot-pound force") {
				$unit = $energy / 1.355818;
			} elseif ($joule_unit == "Foot-poundal") {
				$unit = $energy / 0.0421;
			} elseif ($joule_unit == "Horsepower-hour") {
				$unit = $energy / 2684077.3;
			} elseif ($joule_unit == "Kilocalorie (SI)(kcal)") {
				$unit = $energy / 4186.8;
			} elseif ($joule_unit == "Kilowatt-hour (kW hr)") {
				$unit = $energy / 3600000;
			} elseif ($joule_unit == "Ton of TNT") {
				$unit = $energy / 4200000000;
			} elseif ($joule_unit == "Volt-coulomb (V Cb)") {
				$unit = $energy / 1;
			} elseif ($joule_unit == "Watt-hour (W hr)") {
				$unit = $energy / 3600;
			} elseif ($joule_unit == "Watt-second (W sec)") {
				$unit = $energy / 1;
			}
			return $unit;
		}
		if (is_numeric($mass) && is_numeric($velocity)) {
			$mas = $mass * $mass_unit;
			$velcity = $velocity * $velocity_unit;
			$velocity = $velcity * $velcity;
			$energy = $mas * $velocity;
			$main = joule_unit($energy, $joule_unit);
			$answer = 0.5 * $main;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Resultant Force Calculator
	public function resultant($request)
	{
		$forces = $request->force;
		$angle = $request->angle;

		function calculateResultantForce($forces, $angle)
		{
			$Fx = $Fy = 0;
			for ($i = 0; $i < count($forces); $i++) {
				$Fx += $forces[$i] * cos(deg2rad($angle[$i]));
				$Fy += $forces[$i] * sin(deg2rad($angle[$i]));
			}
			$magnitude = sqrt($Fx ** 2 + $Fy ** 2);
			$direction = rad2deg(atan2($Fy, $Fx));
			$result = array(
				'Fx' => $Fx,
				'Fy' => $Fy,
				'magnitude' => $magnitude,
				'direction' => $direction
			);

			return $result;
		}
		if ($forces != null) {
			if (is_array($forces) && is_array($angle)) {
				// Check if the number of forces and angle match
				if (count($forces) !== count($angle)) {
					$this->param['error'] = 'Number of forces and angle must be the same.';
					return $this->param;
				}
				$result = calculateResultantForce($forces, $angle);

				$this->param['Horizontal'] = $result['Fx'];
				$this->param['Vertical'] = $result['Fy'];
				$this->param['Magnitude'] = $result['magnitude'];
				$this->param['Direction'] = $result['direction'];
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Angle of Refraction Calculator
	public function angle_refraction($request)
	{
		
		$calculation = $request->calculation;
		$medium1 = $request->medium1;
		$n1 = $request->n1;
		$medium2 = $request->medium2;
		$n2 = $request->n2;
		$angle_first = $request->angle_first;
		$angle_f_unit = $request->angle_f_unit;
		$angle_second = $request->angle_second;
		$angle_s_unit = $request->angle_s_unit;
		function convert_angle1($a, $b)
		{
			if ($a === "deg") {
				$converted = $b * 0.0174533;
			} elseif ($a === "rad") {
				$converted = $b * 1;
			} elseif ($a === "gon") {
				$converted = $b * 0.01570796;
			} elseif ($a === "tr") {
				$converted = $b * 6.28319;
			} elseif ($a === "arcmin") {
				$converted = $b * 0.000290888;
			} elseif ($a === "arcsec") {
				$converted = $b * 0.00000484814;
			} elseif ($a === "mrad") {
				$converted = $b * 0.001;
			} elseif ($a === "μrad") {
				$converted = $b * 0.000001;
			} elseif ($a === "* π rad") {
				$converted = $b * 3.14159;
			}
			return $converted;
		}
		$angle_first = convert_angle1($angle_f_unit, $angle_first);
		$angle_second = convert_angle1($angle_s_unit, $angle_second);
		if ($calculation === "from1") {
			if (!empty($medium2) && is_numeric($n2) && is_numeric($angle_first) && !empty($angle_f_unit) && is_numeric($angle_second) && !empty($angle_s_unit)) {
				$jawab = ($n2 * sin($angle_second)) / sin($angle_first);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($calculation === "from2") {
			if (!empty($medium1) && is_numeric($n1) && is_numeric($angle_first) && !empty($angle_f_unit) && is_numeric($angle_second) && !empty($angle_s_unit)) {
				$jawab = ($n1 * sin($angle_first)) / sin($angle_second);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($calculation === "from3") {
			if (!empty($medium1) && is_numeric($n1) && !empty($medium2) && is_numeric($n2) && is_numeric($angle_second) && !empty($angle_s_unit)) {
				$jawab = asin(($n2 * sin($angle_second)) / $n1);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($calculation === "from4") {
			if (!empty($medium1) && is_numeric($n1) && !empty($medium2) && is_numeric($n2) && is_numeric($angle_first) && !empty($angle_f_unit)) {
				$jawab = asin(($n1 * sin($angle_first)) / $n2);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['angle_first'] = $angle_first;
		$this->param['angle_second'] = $angle_second;
		$this->param['calculation'] = $calculation;
		$this->param['jawab'] = $jawab;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Electric Potential Calculator
	public function electricPotential($request)
	{
		$potential_type = $request->potential_type;
		$points         = $request->points;
		$Q              = $request->Q;
		$unit_Q         = $request->unit_Q;
		$charge         = $request->charge;
		$charge_unit    = $request->charge_unit;
		$R              = $request->R;
		$unit_R         = $request->unit_R;
		$distance       = $request->distance;
		$distance_unit  = $request->distance_unit;
		$E              = $request->E;
		$U              = $request->U;
		$U_unit         = $request->U_unit;


		function convertToCoulomb($value, $unit)
		{
			if ($unit === 'C') {
				return $value;
			} elseif ($unit == 'e') {
				return $value * 1.6022e-19;
			} elseif ($unit == 'mC') {
				return $value * 0.001;
			} elseif ($unit == 'μC' || $unit == 'μC') {
				return $value * 1e-6;
			} elseif ($unit == 'nC') {
				return $value * 1e-9;
			} elseif ($unit == 'PC') {
				return $value * 1e-12;
			}
		}

		function convertToMeter($value, $unit)
		{

			if ($unit ==  'm') {
				return $value;
			} elseif ($unit == 'cm') {
				return $value * 0.01;
			} elseif ($unit == 'mm') {
				return $value * 0.001;
			} elseif ($unit == 'μm') {
				return $value * 1e-6;
			} elseif ($unit == 'nm') {
				return $value * 1e-9;
			} elseif ($unit == 'in') {
				return $value * 0.0254;
			} elseif ($unit == 'ft') {
				return $value * 0.3048;
			} elseif ($unit == 'yd') {
				return $value * 0.9144;
			}
		}

		function convertToJoules($value, $unit)
		{
			if ($unit == 'J') {
				return $value;
			} elseif ($unit == 'kJ') {
				return $value * 1000.0;
			} elseif ($unit == 'MJ') {
				return $value * 1e6;
			} elseif ($unit == 'Wh') {
				return $value * 3600.0;
			} elseif ($unit == 'kWh') {
				return $value * 3.6e6;
			} elseif ($unit == 'kcal') {
				return $value * 4184.0;
			} elseif ($unit == 'eV') {
				return $value * 1.60218e-19;
			}
		}

		if ($potential_type == 'single-point') {
			if (is_numeric($charge) && is_numeric($distance) && isset($charge_unit) && isset($distance_unit)) {

				$coulombs = convertToCoulomb($charge, $charge_unit);
				$meters   = convertToMeter($distance, $distance_unit);

				$v = ((8.99 * pow(10, 9) * $coulombs) / $meters) / $E;

				// Convert to scientific notation
				$scientificNotation = sprintf('%.3e', $v);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($potential_type == 'multi-point') {

			
			if (isset($Q) && isset($R) && isset($unit_Q) && isset($unit_R) && is_numeric($points)) {


				for ($i = 0; $i < $points; $i++) {
					$coulombs = convertToCoulomb($Q[$i], $unit_Q[$i]);
					$meters   = convertToMeter($R[$i], $unit_R[$i]);
					if ($meters > 0) {
						$QR[$i] = ($coulombs / $meters);
					} else {
						$QR[$i] = 0;
					}
				}
				$QRSum = array_sum($QR);
				$v     = (8.99 * pow(10, 9) * $QRSum) / $E;

				// Convert to scientific notation
				$scientificNotation = sprintf('%.3e', $v);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else if ($potential_type == 'difference') {
			if (is_numeric($U) && isset($U_unit) && is_numeric($charge) && isset($charge_unit)) {
				$coulombs = convertToCoulomb($charge, $charge_unit);
				$joules   = convertToJoules($U, $U_unit);

				$v = $joules / $coulombs;

				// Convert to scientific notation
				$scientificNotation = sprintf('%.3e', $v);
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$abc = explode('e', $scientificNotation);
		$answer =  $abc[0] . ' X 10<sup>' . $abc[1] . '</sup>';
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Angle of Deviation Calculator
	public function angle_deviation($request)
	{
		$incidence = trim($request->incidence);
		$incidence_unit = trim($request->incidence_unit);
		$emergence = trim($request->emergence);
		$emergence_unit = trim($request->emergence_unit);
		$prism = trim($request->prism);
		$prism_unit = trim($request->prism_unit);
		$deviation_unit = trim($request->deviation_unit);
		function units_of_deviation($incidence, $incidence_unit)
		{
			if ($incidence_unit === "circle") {
				$deviations = $incidence * 360;
			} elseif ($incidence_unit === "cycle") {
				$deviations = $incidence * 359.8981;
			} elseif ($incidence_unit === "degree") {
				$deviations = $incidence * 1;
			} elseif ($incidence_unit === "gon") {
				$deviations = $incidence * 0.9;
			} elseif ($incidence_unit === "gradian") {
				$deviations = $incidence * 0.9;
			} elseif ($incidence_unit === "mil") {
				$deviations = $incidence * 0.05625;
			} elseif ($incidence_unit === "milliradian") {
				$deviations = $incidence * 0.057296;
			} elseif ($incidence_unit === "minute") {
				$deviations = $incidence * 0.016667;
			} elseif ($incidence_unit === "minutes of arc") {
				$deviations = $incidence * 0.016667;
			} elseif ($incidence_unit === "point") {
				$deviations = $incidence * 11.25;
			} elseif ($incidence_unit === "quadrant") {
				$deviations = $incidence * 90;
			} elseif ($incidence_unit === "quartercircle") {
				$deviations = $incidence * 90;
			} elseif ($incidence_unit === "radian") {
				$deviations = $incidence * 57.29578;
			} elseif ($incidence_unit === "revolution") {
				$deviations = $incidence * 360;
			} elseif ($incidence_unit === "right angle") {
				$deviations = $incidence * 90;
			} elseif ($incidence_unit === "second") {
				$deviations = $incidence * 0.000278;
			} elseif ($incidence_unit === "semicircle") {
				$deviations = $incidence * 180;
			} elseif ($incidence_unit === "sextant") {
				$deviations = $incidence * 60;
			} elseif ($incidence_unit === "sign") {
				$deviations = $incidence * 30;
			} elseif ($incidence_unit === "turn") {
				$deviations = $incidence * 360;
			}
			return $deviations;
		}
		if (is_numeric($incidence) && is_numeric($emergence) && is_numeric($prism)) {
			$incidence = units_of_deviation($incidence, $incidence_unit);
			$emergence = units_of_deviation($emergence, $emergence_unit);
			$prism = units_of_deviation($prism, $prism_unit);
			$deviation = $incidence + $emergence - $prism;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['deviation'] = $deviation;
		$this->param['incidence'] = $incidence;
		$this->param['emergence'] = $emergence;
		$this->param['prism'] = $prism;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Electric Flux calculator
	public function electric_flux($request)
	{
		$electric = trim($request->electric);
		$surface = trim($request->surface);
		$degree = trim($request->degree);
		$charge = trim($request->charge);
		$unit = trim($request->unit);
		$const = trim($request->const);
		$power = trim($request->power);
		function sigFig1($value, $digits)
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
		if (is_numeric($electric) && is_numeric($surface) && is_numeric($degree) && is_numeric($charge) && is_numeric($const) && is_numeric($power)) {
			if (isset($unit) && isset($charge)) {
				if ($unit === 'picocoulomb') {
					$charge = $charge * 0.001;
				} elseif ($unit === 'microcoulomb') {
					$charge = $charge * 1000;
				} elseif ($unit === 'millicoulomb') {
					$charge = $charge * 1000000;
				} elseif ($unit === 'coulomb') {
					$charge = $charge * 1000000000;
				} elseif ($unit === 'elementry') {
					$charge = $charge * 0.0000000001602;
				} elseif ($unit === 'ampere') {
					$charge = $charge * 3600000000000;
				} elseif ($unit === 'milliampere') {
					$charge = $charge * 3600000000;
				}
			}
			// Gauss Law calculations 
			$pow = pow(10, (int) $power);
			$total = $const * $pow;
			$flux = $charge / $total;
			// $flux = number_format($fluxx, 0, '', '');
			// Inward flux calculation 
			$x = $electric * $surface;
			$sum = 180 - $degree;
			$cos = cos(deg2rad($sum));
			$inward = $x * $cos;
			// Outward flux calculation 
			$y = $electric * $surface;
			$cosoutward = cos(deg2rad($degree));
			$outward = $y * $cosoutward;
			$this->param['flux'] = $flux;
			$this->param['inward'] = sigfig1($inward, 6);
			$this->param['cosoutward'] = sigfig1($cosoutward, 5);
			$this->param['outward'] = sigfig1($outward, 6);
			$this->param['electric'] = $electric;
			$this->param['surface'] = $surface;
			$this->param['degree'] = $degree;
			$this->param['charge'] = $charge;
			$this->param['const'] = $const;
			$this->param['power'] = $power;
			$this->param['cos'] = sigfig1($cos, 4);
			$this->param['sum'] = $sum;
			$this->param['RESULT'] = 1;

			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}
	// Capacitance Calculator
	public function capacitance($request)
	{
		$area = trim($request->area);
		$area_unit = trim($request->area_unit);
		$permittivity = trim($request->permittivity);
		$distance = trim($request->distance);
		$dis_unit = trim($request->dis_unit);
		function area_convert($a, $b)
		{
			if ($b === "mm²") {
				$area_ans = $a * 1;
			} else if ($b === "cm²") {
				$area_ans = $a * 100;
			} else if ($b === "m²") {
				$area_ans = $a * 1000000;
			} else if ($b === "in²") {
				$area_ans = $a * 645.16;
			} else if ($b === "ft²") {
				$area_ans = $a * 92900;
			} else {
				$area_ans = $a * 836100;
			}
			return $area_ans;
		}
		function dis_convert($a, $b)
		{
			if ($b === "mm") {
				$dis_ans = $a * 1;
			} else if ($b === "cm") {
				$dis_ans = $a * 10;
			} else if ($b === "m") {
				$dis_ans = $a * 1000;
			} else if ($b === "in") {
				$dis_ans = $a * 25.4;
			} else if ($b === "ft") {
				$dis_ans = $a * 304.8;
			} else {
				$dis_ans = $a * 914.4;
			}
			return $dis_ans;
		}
		$area = area_convert($area, $area_unit);
		$distance = dis_convert($distance, $dis_unit);
		if (is_numeric($area) && is_numeric($distance) && is_numeric($permittivity)) {
			if ($permittivity <= 0) {
				$this->param['error'] = 'Capacitance should be greater than 0';
				return $this->param;
			}
			$mf_ans = ($permittivity * $area) / $distance;
			$f_ans = 0.001 * $mf_ans;
			$microf_ans = 1000 * $mf_ans;
			$nf_ans = 1000000 * $mf_ans;
			$pf_ans = 1000000000 * $mf_ans;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['mf_ans'] = $mf_ans;
		$this->param['f_ans'] = $f_ans;
		$this->param['microf_ans'] = $microf_ans;
		$this->param['nf_ans'] = $nf_ans;
		$this->param['pf_ans'] = $pf_ans;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	// dBm to Watts Calculator
	public function dbm($request)
	{
		$calculation = trim($request->calculation);
		$input = trim($request->input);
		if (is_numeric($input)) {
			if ($calculation === "1") {
				$divide = $input / 10;
				$pow = pow(10, $divide);
				$answer = $pow / 1000;
				$unit = "W";
			} else if ($calculation === "2") {
				$divide = $input / 10;
				$pow = pow(10, $divide);
				$watts = $pow / 1000;
				$answer = $watts * 1000;
				$unit = "mW";
			} else if ($calculation === "3") {
				$answer = (10 * log10($input)) + 30;
				$unit = "dBm";
			} else {
				$miliwatts = $input * 1000;
				$answer = (10 * log10($miliwatts));
				$unit = "dBm";
			}
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['unit'] = $unit;
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// Wave Speed Calculator
	public function wave($request)
	{
		$frequency = $request->frequency;
		$f_unit = $request->f_unit;
		$wavelength = $request->wavelength;
		$w_units = $request->w_units;

		if (is_numeric($frequency) && is_numeric($wavelength)) {
			if ($f_unit == 'kHz') {
				$frequency = $frequency * 1000;
			} else if ($f_unit == 'MHz') {
				$frequency = $frequency * 1000000;
			} else if ($f_unit == 'GHz') {
				$frequency = $frequency * 1000000000;
			} else if ($f_unit == 'THz') {
				$frequency = $frequency * 1000000000000;
			}

			if ($w_units == 'nm') {
				$wavelength = $wavelength * 0.000000001;
			} else if ($w_units == 'μm') {
				$wavelength = $wavelength * 0.000001;
			} else if ($w_units == 'mm') {
				$wavelength = $wavelength * 0.001;
			} else if ($w_units == 'cm') {
				$wavelength = $wavelength * 0.01;
			} else if ($w_units == 'km') {
				$wavelength = $wavelength * 1000;
			} else if ($w_units == 'in') {
				$wavelength = $wavelength * 0.0254;
			} else if ($w_units == 'ft') {
				$wavelength = $wavelength * 0.3048;
			} else if ($w_units == 'yd') {
				$wavelength = $wavelength * 0.9144;
			} else if ($w_units == 'mi') {
				$wavelength = $wavelength * 1609.344;
			}

			$t = 1 / $frequency;
			$vn = 1 / $wavelength;
			$v = $frequency * $wavelength;

			$this->param['frequency'] = $frequency;
			$this->param['wavelength'] = $wavelength;
			$this->param['t'] = $t;
			$this->param['vn'] = $vn;
			$this->param['v'] = $v;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
	}
	// WHP to HP Calculator
	public function whp($request)
	{
		$submit        = $request->type;
		$dt            = $request->dt;
		$whp           = $request->whp;
		$dtlf          = $request->dtlf;
		$ehp           = $request->ehp;
		if ($submit == 'whpToHp') {
			if (isset($dt) && is_numeric($whp)) {
				$hp = $whp * 1 / (1 - $dt);
				$this->param['submit'] = $submit;
				$this->param['whp']    = $whp;
				$this->param['dt']     = $dt;
				$this->param['hp']     = number_format($hp, 2);
				$this->param['RESULT'] = 1;

				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if (isset($dtlf) && is_numeric($ehp)) {
				$whp = $ehp / $dtlf;

				$this->param['submit'] = $submit;
				$this->param['ehp']    = $ehp;
				$this->param['dtlf']   = $dtlf;
				$this->param['whp']    = number_format($whp, 2);
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
	}
	// Beam Deflection Calculator
	public function beam($request)
	{
		$operations = $request->operations;
		$shape_1 = $request->shape_1;
		$shape_2 = $request->shape_2;
		$first = $request->first;
		$second = $request->second;
		$third = $request->third;
		$four = $request->four;
		$five = $request->five;
		$six = $request->six;
		$seven = $request->seven;
		$unit1 = $request->unit1;
		$unit2 = $request->unit2;
		$unit3 = $request->unit3;
		$unit4 = $request->unit4;
		$unit5 = $request->unit5;
		$unit6 = $request->unit6;
		$unit7 = $request->unit7;
		$shape1_extra = $request->shape1_extra;
		function m($a, $b)
		{
			if ($a == "cm") {
				$convert1 = $b / 100;
			} elseif ($a == "mm") {
				$convert1 = $b / 1000;
			} elseif ($a == "m") {
				$convert1 = $b * 1;
			} elseif ($a == "in") {
				$convert1 = $b / 39.37;
			} elseif ($a == "ft") {
				$convert1 = $b / 3.281;
			} elseif ($a == "yd") {
				$convert1 = $b / 1.094;
			}
			return $convert1;
		}
		function kn($a, $b)
		{
			if ($a == "N") {
				$convert1 = $b / 1000;
			} elseif ($a == "kN") {
				$convert1 = $b * 1;
			} elseif ($a == "MN") {
				$convert1 = $b * 1000;
			} elseif ($a == "GN") {
				$convert1 = $b * 1000000;
			} elseif ($a == "TN") {
				$convert1 = $b * 1000000000;
			} elseif ($a == "ibf") {
				$convert1 = $b * 0.004448;
			} elseif ($a == "kip") {
				$convert1 = $b * 4.448;
			}
			return $convert1;
		}
		function mpa($a, $b)
		{
			if ($a == "Pa") {
				$convert1 = $b * 0.000001;
			} elseif ($a == "psi") {
				$convert1 = $b * 0.006895;
			} elseif ($a == "kPa") {
				$convert1 = $b * 0.001;
			} elseif ($a == "MPa") {
				$convert1 = $b * 1;
			} elseif ($a == "GPa") {
				$convert1 = $b * 1000;
			} elseif ($a == "kN/m²") {
				$convert1 = $b * 0.001;
			}
			return $convert1;
		}
		function m4($a, $b)
		{
			if ($a == "m⁴") {
				$convert1 = $b * 1;
			} elseif ($a == "cm⁴") {
				$convert1 = $b * 0.00000001;
			} elseif ($a == "mm⁴") {
				$convert1 = $b * 0.000000000001;
			} elseif ($a == "in⁴") {
				$convert1 = $b * 0.0000004162;
			} elseif ($a == "ft⁴") {
				$convert1 = $b * 0.008631;
			}
			return $convert1;
		}
		function nm($a, $b)
		{
			if ($a == "N/m") {
				$convert1 = $b * 1;
			} elseif ($a == "kN/m") {
				$convert1 = $b * 1000;
			} elseif ($a == "ibf/in") {
				$convert1 = $b * 175.13;
			} elseif ($a == "ibf/ft") {
				$convert1 = $b * 14.594;
			} elseif ($a == "dyn/cm") {
				$convert1 = $b * 0.001;
			} elseif ($a == "kip/ft") {
				$convert1 = $b * 14594;
			} elseif ($a == "kip/in") {
				$convert1 = $b * 175128;
			}
			return $convert1;
		}
		function dnm($a, $b)
		{
			if ($a == "N.m") {
				$convert1 = $b * 1;
			} elseif ($a == "kgf.cm") {
				$convert1 = $b * 0.09807;
			} elseif ($a == "J/rad") {
				$convert1 = $b * 1;
			} elseif ($a == "ibf.ft") {
				$convert1 = $b * 1.3558;
			} elseif ($a == "ibf.in") {
				$convert1 = $b * 0.11298;
			}
			return $convert1;
		}
		$first = m($unit1, $first);
		$second = kn($unit2, $second);
		$third = mpa($unit3, $third);
		$four = m4($unit4, $four);
		$five = m($unit5, $five);
		$six = nm($unit6, $six);
		$seven = dnm($unit7, $seven);
		if ($operations == "1") {
			if ($shape_1 == "1") {
				if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four)) {
					$l_cube = pow($first, 3);
					$upper_mul = $second * $l_cube;
					$lower_mul = 48 * $third * $four;
					$stiffness = $third * $four;
					$max_def = $upper_mul / $lower_mul;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_1 == "2") {
				if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five)) {
					if ($five < $first) {
						$distance_b = $first - $five;
						$stiffness = $third * $four;
						$lower_mul = 48 * $third * $four;
						$up_minus = (3 * pow($first, 2)) - (4 * pow($distance_b, 2));
						$up_mul = $second * $distance_b * $up_minus;
						$max_def = $up_mul / $lower_mul;
						$this->param['distance_b'] = $distance_b;
					} else {
						$this->param['error'] = 'Please input a value for "a" that is smaller than the span length, "L".';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_1 == "3") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					$l_four = pow($first, 4);
					$upper_mul = 5 * $six * $l_four;
					$lower_mul = 384 * $third * $four;
					$stiffness = $third * $four;
					$max_def = $upper_mul / $lower_mul;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_1 == "4") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					if ($shape1_extra == "1") {
						$l_four = pow($first, 4);
						$upper_mul = 0.00652 * $six * $l_four;
						$stiffness = $third * $four;
						$max_def = ($upper_mul / $stiffness) / 1000;
					} elseif ($shape1_extra == "2") {
						$l_four = pow($first, 4);
						$upper_mul = 0.00652 * $six * $l_four;
						$stiffness = $third * $four;
						$max_def = ($upper_mul / $stiffness) / 1000;
						$x = $first / 1.9256;
						$this->param['x'] = $x;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_1 == "5") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					$l_four = pow($first, 4);
					$upper_mul = $six * $l_four;
					$lower_mul = 120 * $third * $four;
					$stiffness = $third * $four;
					$max_def = $upper_mul / $lower_mul;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_1 == "6") {
				if (is_numeric($first) && is_numeric($seven) && is_numeric($third) && is_numeric($four)) {
					if ($shape1_extra == "1") {
						$l_sq = pow($first, 2);
						$upper_mul = $seven * $l_sq;
						$lower_mul = 9 * sqrt(3) * $seven * $l_sq;
						$stiffness = $third * $four;
						$max_def = ($upper_mul / $lower_mul) / 1000;
					} elseif ($shape1_extra == "2") {
						$l_sq = pow($first, 2);
						$upper_mul = $seven * $l_sq;
						$lower_mul = 9 * sqrt(3) * $seven * $l_sq;
						$stiffness = $third * $four;
						$max_def = ($upper_mul / $lower_mul) / 1000;
						$x = $first / 1.7230;
						$this->param['x'] = $x;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} elseif ($operations == "2") {
			if ($shape_2 == "1") {
				if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four)) {
					$l_cube = pow($first, 3);
					$upper_mul = $second * $l_cube;
					$lower_mul = 3 * $third * $four;
					$stiffness = $third * $four;
					$max_def = $upper_mul / $lower_mul;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_2 == "2") {
				if (is_numeric($first) && is_numeric($second) && is_numeric($third) && is_numeric($four) && is_numeric($five)) {
					if ($five < $first) {
						$distance_b = $first - $five;
						$upper_mul = $second * pow($five, 2) * ((3 * $first) - $five);
						$lower_mul = 6 * $third * $four;
						$stiffness = $third * $four;
						$max_def = $upper_mul / $lower_mul;
						$this->param['distance_b'] = $distance_b;
					} else {
						$this->param['error'] = 'Please input a value for "a" that is smaller than the span length, "L".';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_2 == "3") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					$upper_mul = $six * pow($first, 4);
					$lower_mul = 8 * $third * $four;
					$stiffness = $third * $four;
					$max_def = ($upper_mul / $lower_mul) / 1000;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_2 == "4") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					$upper_mul = $six * pow($first, 4);
					$lower_mul = 30 * $third * $four;
					$stiffness = $third * $four;
					$max_def = ($upper_mul / $lower_mul) / 1000;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_2 == "5") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					$upper_mul = 11 * $six * pow($first, 4);
					$lower_mul = 120 * $third * $four;
					$stiffness = $third * $four;
					$max_def = ($upper_mul / $lower_mul) / 1000;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($shape_2 == "6") {
				if (is_numeric($first) && is_numeric($six) && is_numeric($third) && is_numeric($four)) {
					$upper_mul = $six * pow($first, 4);
					$lower_mul = 8 * $third * $four;
					$stiffness = $third * $four;
					$max_def = ($upper_mul / $lower_mul) / 1000;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
		$this->param['stiffness'] = $stiffness;
		$this->param['max_def'] = $max_def;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	/*******************
    	Wire Size Calculator
	 *******************/
	function wire($request)
	{
	
		$submit = trim($request->unit_type);
		$type = trim($request->type);
		$s_voltage = trim($request->s_voltage);
		$sv_units = trim($request->sv_units);
		$voltage_drop = trim($request->voltage_drop);
		$c_units = trim($request->c_units);
		$current = trim($request->current);
		$current_unit = trim($request->current_unit);
		$wire_length = trim($request->wire_length);
		$wl_units = trim($request->wl_units);
		$w_temp = trim($request->w_temp);
		$wt_units = trim($request->wt_units);
		$wire_gauge = trim($request->wire_gauge);
		$wire_diameter = trim($request->wire_diameter);
		$wd_units = trim($request->wd_units);



		$AWG = [
			'0000 (4/0)' => ["inches" => 0.46, "mm" => 11.684, "kcmil" => 211.6, "mm²" => 107, "ft" => 0.049, "m" => 0.1608],
			'000 (3/0)' => ["inches" => 0.4096, "mm" => 10.405, "kcmil" => 167.81, "mm²" => 85, "ft" => 0.0618, "m" => 0.2028],
			'00 (2/0)' => ["inches" => 0.3648, "mm" => 9.266, "kcmil" => 133.08, "mm²" => 67.4, "ft" => 0.0779, "m" => 0.2557],
			'0 (1/0)' => ["inches" => 0.3249, "mm" => 8.251, "kcmil" => 105.53, "mm²" => 53.5, "ft" => 0.0983, "m" => 0.3224],
			'1' => ["inches" => 0.2893, "mm" => 7.348, "kcmil" => 83.693, "mm²" => 42.4, "ft" => 0.1239, "m" => 0.4066],
			'2' => ["inches" => 0.2576, "mm" => 6.544, "kcmil" => 66.371, "mm²" => 33.6, "ft" => 0.1563, "m" => 0.5127],
			'3' => ["inches" => 0.2294, "mm" => 5.827, "kcmil" => 52.635, "mm²" => 26.7, "ft" => 0.197, "m" => 0.6464],
			'4' => ["inches" => 0.2043, "mm" => 5.189, "kcmil" => 41.741, "mm²" => 21.1, "ft" => 0.2485, "m" => 0.8152],
			'5' => ["inches" => 0.1819, "mm" => 4.621, "kcmil" => 33.102, "mm²" => 16.8, "ft" => 0.3133, "m" => 1.028],
			'6' => ["inches" => 0.162, "mm" => 4.115, "kcmil" => 26.251, "mm²" => 13.3, "ft" => 0.3951, "m" => 1.296],
			'7' => ["inches" => 0.1443, "mm" => 3.665, "kcmil" => 20.818, "mm²" => 10.5, "ft" => 0.4982, "m" => 1.634],
			'8' => ["inches" => 0.1285, "mm" => 3.264, "kcmil" => 16.51, "mm²" => 8.36, "ft" => 0.6282, "m" => 1.634],
			'9' => ["inches" => 0.1144, "mm" => 2.906, "kcmil" => 13.093, "mm²" => 6.63, "ft" => 0.7921, "m" => 2.599],
			'10' => ["inches" => 0.1019, "mm" => 2.588, "kcmil" => 10.383, "mm²" => 5.26, "ft" => 0.9988, "m" => 3.277],
			'11' => ["inches" => 0.0907, "mm" => 2.305, "kcmil" => 8.234, "mm²" => 4.17, "ft" => 1.26, "m" => 4.132],
			'12' => ["inches" => 0.0808, "mm" => 2.053, "kcmil" => 6.53, "mm²" => 3.31, "ft" => 1.588, "m" => 5.211],
			'13' => ["inches" => 0.072, "mm" => 1.828, "kcmil" => 5.178, "mm²" => 2.62, "ft" => 2.003, "m" => 6.571],
			'14' => ["inches" => 0.0641, "mm" => 1.628, "kcmil" => 4.107, "mm²" => 2.08, "ft" => 2.525, "m" => 8.285],
			'15' => ["inches" => 0.0571, "mm" => 1.45, "kcmil" => 3.257, "mm²" => 1.65, "ft" => 3.184, "m" => 10.448],
			'16' => ["inches" => 0.0508, "mm" => 1.291, "kcmil" => 2.583, "mm²" => 1.31, "ft" => 4.015, "m" => 13.174],
			'17' => ["inches" => 0.0453, "mm" => 1.15, "kcmil" => 2.048, "mm²" => 1.04, "ft" => 5.063, "m" => 16.612],
			'18' => ["inches" => 0.0403, "mm" => 1.024, "kcmil" => 1.624, "mm²" => 0.823, "ft" => 6.385, "m" => 20.948],
			'19' => ["inches" => 0.0403, "mm" => 1.024, "kcmil" => 1.624, "mm²" => 0.653, "ft" => 6.385, "m" => 20.948],
			'20' => ["inches" => 0.032, "mm" => 0.8118, "kcmil" => 1.022, "mm²" => 0.518, "ft" => 10.152, "m" => 33.308],
			'21' => ["inches" => 0.0285, "mm" => 0.7229, "kcmil" => 0.8101, "mm²" => 0.410, "ft" => 12.802, "m" => 42.001],
			'22' => ["inches" => 0.0253, "mm" => 0.6438, "kcmil" => 0.6424, "mm²" => 0.326, "ft" => 16.143, "m" => 52.962],
			'23' => ["inches" => 0.0226, "mm" => 0.5733, "kcmil" => 0.5095, "mm²" => 0.258, "ft" => 20.356, "m" => 66.784],
			'24' => ["inches" => 0.0201, "mm" => 0.5106, "kcmil" => 0.404, "mm²" => 0.205, "ft" => 25.668, "m" => 84.213],
			'25' => ["inches" => 0.0179, "mm" => 0.4547, "kcmil" => 0.3204, "mm²" => 0.162, "ft" => 32.367, "m" => 106.19],
			'26' => ["inches" => 0.0159, "mm" => 0.4049, "kcmil" => 0.2541, "mm²" => 0.129, "ft" => 40.814, "m" => 133.9],
			'27' => ["inches" => 0.0142, "mm" => 0.3606, "kcmil" => 0.2015, "mm²" => 0.102, "ft" => 51.466, "m" => 168.85],
			'28' => ["inches" => 0.0126, "mm" => 0.3211, "kcmil" => 0.1598, "mm²" => 0.0810, "ft" => 64.897, "m" => 212.92],
			'29' => ["inches" => 0.0113, "mm" => 0.2859, "kcmil" => 0.1267, "mm²" => 0.0642, "ft" => 81.833, "m" => 268.48],
			'30' => ["inches" => 0.01, "mm" => 0.2546, "kcmil" => 0.1005, "mm²" => 0.0509, "ft" => 103.19, "m" => 338.55],
			'31' => ["inches" => 0.008928, "mm" => 0.2268, "kcmil" => 0.0797, "mm²" => 0.0404, "ft" => 130.12, "m" => 426.9],
			'32' => ["inches" => 0.00795, "mm" => 0.2019, "kcmil" => 0.0632, "mm²" => 0.0320, "ft" => 164.08, "m" => 538.32],
			'33' => ["inches" => 0.00708, "mm" => 0.1798, "kcmil" => 0.0501, "mm²" => 0.0254, "ft" => 206.9, "m" => 678.8],
			'34' => ["inches" => 0.006305, "mm" => 0.006305, "kcmil" => 0.0398, "mm²" => 0.0201, "ft" => 260.9, "m" => 260.9],
			'35' => ["inches" => 0.005615, "mm" => 0.1426, "kcmil" => 0.0315, "mm²" => 0.0160, "ft" => 328.98, "m" => 1079.3],
			'36' => ["inches" => 0.005, "mm" => 0.127, "kcmil" => 0.025, "mm²" => 0.0127, "ft" => 414.84, "m" => 1361],
			'37' => ["inches" => 0.004453, "mm" => 0.1131, "kcmil" => 0.0198, "mm²" => 0.0100, "ft" => 523.1, "m" => 1716.2],
			'38' => ["inches" => 0.003965, "mm" => 0.1007, "kcmil" => 0.0157, "mm²" => 0.007967, "ft" => 659.62, "m" => 2164.1],
			'39' => ["inches" => 0.003531, "mm" => 0.0897, "kcmil" => 0.0125, "mm²" => 0.00632, "ft" => 831.77, "m" => 2728.9],
			'40' => ["inches" => 0.003145, "mm" => 0.0799, "kcmil" => 0.009888, "mm²" => 0.00501, "ft" => 1048.8, "m" => 3441.1],
		];
		function munits($unit)
		{
			$result = array();
			if ($unit == 'copper') {
				$result['unit'] = 1.68;
				$result['tempCoefficient'] = 0.00404;
			} else if ($unit == 'aluminum') {
				$result['unit'] = 2.65;
				$result['tempCoefficient'] = 0.0039;
			} else if ($unit == 'gold') {
				$result['unit'] = 2.44;
				$result['tempCoefficient'] = 0;
			} else if ($unit == 'silver') {
				$result['unit'] = 1.59;
				$result['tempCoefficient'] = 0;
			} else if ($unit == 'nickel') {
				$result['unit'] = 6.99;
				$result['tempCoefficient'] = 0;
			} else if ($unit == 'steel') {
				$result['unit'] = 1;
				$result['tempCoefficient'] = 0;
			}
			return $result;
		}
		function getNearestValue($arr, $target)
		{
			$nearest = null;
			$minDiff = PHP_INT_MAX;
			foreach ($arr as $key => $value) {
				$mm_val = $value['mm²'];
				$diff = abs($mm_val - $target);
				if ($diff < $minDiff) {
					$minDiff = $diff;
					$nearest = $mm_val;
					$index = $key;
					$return_val = $value;
				}
			}

			return [$nearest, $index, $return_val];
		}
		function getNearestValueDiameter($arr, $diameter)
		{
			$nearest = null;
			$minDiff = PHP_INT_MAX;
			foreach ($arr as $key => $value) {
				$mm_val = $value['inches'];
				$diff = abs($mm_val - $diameter);
				if ($diff < $minDiff) {
					$minDiff = $diff;
					$nearest = $mm_val;
					$index = $key;
					$return_val = $value;
				}
			}

			return [$nearest, $index, $return_val];
		}

		if ($submit == 'wire_size') {
			if (is_numeric($s_voltage) && is_numeric($voltage_drop) && is_numeric($current) && is_numeric($wire_length) && is_numeric($w_temp)) {
				if (isset($sv_units)) {
					if ($sv_units == 'mV') {
						$s_voltage = $s_voltage * 0.001;
					} else if ($sv_units == 'kV') {
						$s_voltage = $s_voltage * 1000;
					} else if ($sv_units == 'MV') {
						$s_voltage = $s_voltage * 1000000;
					}
				}
				if (isset($current_unit)) {
					if ($current_unit == 'mA') {
						$current = $current * 0.001;
					} else if ($current_unit == 'µA') {
						$current = $current * 0.000001;
					}
				}
				if (isset($wl_units)) {
					if ($wl_units == 'cm') {
						$wire_length = $wire_length * 0.01;
					} else if ($wl_units == 'km') {
						$wire_length = $wire_length * 1000;
					} else if ($wl_units == 'in') {
						$wire_length = $wire_length * 0.0254;
					} else if ($wl_units == 'ft') {
						$wire_length = $wire_length * 0.3048;
					} else if ($wl_units == 'yd') {
						$wire_length = $wire_length * 0.9144;
					} else if ($wl_units == 'mi') {
						$wire_length = $wire_length * 1609.3;
					}
				}
				if (isset($wt_units)) {
					if ($wt_units == '°F') {
						$w_temp = ($w_temp * 9 / 5) + 32;
					} else if ($wt_units == 'K') {
						$w_temp = $w_temp + 273.15;
					}
				}
				if ($type == 'single_phase') {
					$result  = munits($c_units);

					$metalunit = $result['unit'];
					$tempCoefficient = $result['tempCoefficient'];
					if ($w_temp >= 50) {
						$metalunit = $metalunit * (1 + $tempCoefficient * ($w_temp - 20));
					}
					$pow = pow(10, -8);
					$res = $current * $metalunit * $pow * (2 * $wire_length);
					$v_d = $voltage_drop / 100;
					$v = $v_d * $s_voltage;
					$am = $res / $v;
					$single_phase = $am * 1000000;
					$s_data = getNearestValue($AWG, $single_phase);
					$this->param['single_phase'] = $single_phase;
					$this->param['s_data'] = $s_data;
				} else if ($type == 'three_phase') {
					$result  = munits($c_units);
					$metalunit = $result['unit'];
					if ($w_temp >= 50) {
						$tempCoefficient = $result['tempCoefficient'];
						$metalunit = $metalunit * (1 + $tempCoefficient * ($w_temp - 20));
					}
					$sqrt = sqrt(3);
					$pow = pow(10, -8);
					$res = $sqrt * $current * $metalunit * $pow * $wire_length;
					$v_d = $voltage_drop / 100;
					$v = $v_d * $s_voltage;
					$am = $res / $v;
					$three_phase = round($am *  1000000, 2);
					$t_data = getNearestValue($AWG, $three_phase);
					$this->param['three_phase'] = $three_phase;
					$this->param['t_data'] = $t_data;
					$this->param['sqrt'] = $sqrt;
				}
				$this->param['type'] = $type;
				$this->param['res'] = $res;
				$this->param['s_voltage'] = $s_voltage;
				$this->param['voltage_drop'] = $voltage_drop;
				$this->param['current'] = $current;
				$this->param['metalunit'] = $metalunit;
				$this->param['wire_length'] = $wire_length;
				$this->param['c_units'] = $c_units;
				$this->param['am'] = $am;
				$this->param['v'] = $v;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($submit == 'wire_diameter') {
			if (substr($wire_gauge, -6) === "-kcmil") {
				$parts = explode("-", $wire_gauge);
				$new_string = $parts[0];
				$kcmil = $new_string;
				$sd_in = $new_string / 1000;
				$inches = sqrt($sd_in);
				$mm = $inches * 25.4;
				$p = pow($mm, 2);
				$pai = 3.14 / 4;
				$sqinches = $pai * $sd_in;
				$mm2 = $pai * $p;
			} else {
				$modelDetail = $AWG[$wire_gauge];
				$inches = $modelDetail['inches'];
				$mm = $modelDetail['mm'];
				$kcmil = $modelDetail['kcmil'];
				$in = $kcmil / 1000;
				$pai = 3.14 / 4;
				$sqinches = $pai * $in;
				$mm2 = $modelDetail['mm²'];
			}
			$this->param['inches'] = $inches;
			$this->param['sqinches'] = $sqinches;
			$this->param['mm'] = $mm;
			$this->param['kcmil'] = $kcmil;
			$this->param['mm2'] = $mm2;
		} else if ($submit == 'wire_gauge') {
			if (is_numeric($wire_diameter)) {
				if (isset($wd_units)) {
					if ($wd_units == 'mm') {
						$wire_diameter = $wire_diameter / 25.4;
					} else if ($wd_units == 'cm') {
						$wire_diameter = $wire_diameter / 2.54;
					}
				}
				$d_data = getNearestValueDiameter($AWG, $wire_diameter);
				$p = pow($wire_diameter, 2);
				$kcmil = $p * 1000;
				$pai = 22 / 7;
				$dpai = $pai / 4;
				$inches = $kcmil / 1000;
				$square_in = $inches * $dpai;
				$this->param['d_data'] = $d_data;
				$this->param['square_in'] = $square_in;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['submit'] = $submit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		kinematics Calculator
	 ************************/
	function kinematics($request) {
		// $kin;
		$check=false;
		if (is_numeric($request->iv) && is_numeric($request->fv) && is_numeric($request->ct)) {
			if (!empty($request->cac) || $request->cac=='0' || !empty($request->cdis) || $request->cdis=='0') {
                $this->param['error'] = 'Please enter any three values';
				return $this->param;
			} else {
				$check=true;
				$iv=$request->iv;
				if ($request->ivU=='ft/s') {
					$iv=$iv/3.281;
				}
				if ($request->ivU=='km/h') {
					$iv=$iv/3.6;
				}
				if ($request->ivU=='km/s') {
					$iv=$iv*1000;
				}
				if ($request->ivU=='mi/s') {
					$iv=$iv*1609.35;
				}
				if ($request->ivU=='mph') {
					$iv=$iv/2.237;
				}
				$fv=$request->fv;
				if ($request->fvU=='ft/s') {
					$fv=$fv/3.281;
				}
				if ($request->fvU=='km/h') {
					$fv=$fv/3.6;
				}
				if ($request->fvU=='km/s') {
					$fv=$fv*1000;
				}
				if ($request->fvU=='mi/s') {
					$fv=$fv*1609.35;
				}
				if ($request->fvU=='mph') {
					$fv=$fv/2.237;
				}

				$time=$request->ct;
				if ($request->ctU=='min') {
					$time=$time*60;
				}
				if ($request->ctU=='h') {
					$time=$time*60*60;
				}
				$a=round(($fv-$iv)/$time,4);
				$dis=($iv*$time) + (0.5*$a*pow($time, 2));
				$iv=$request->iv.' '.$request->ivU;
				$fv=$request->fv.' '.$request->fvU;
				$time=$request->ct.' '.$request->ctU;
				if ($request->cacU=='ft/s²') {
					$a=round($a*3.2808399,4);
				}
				$a=$a.' '.$request->cacU;
				if ($request->cdisU=='cm') {
					$dis=round($dis*100,4);
				}
				if ($request->cdisU=='in') {
					$dis=round($dis*39.37,4);
				}
				if ($request->cdisU=='ft') {
					$dis=round($dis*3.281,4);
				}
				if ($request->cdisU=='km') {
					$dis=round($dis*1000,4);
				}
				if ($request->cdisU=='mi') {
					$dis=round($dis/1609.35,4);
				}
				if ($request->cdisU=='yd') {
					$dis=round($dis*1.094,4);
				}
				$dis=$dis.' '.$request->cdisU;
			}
		} elseif (is_numeric($request->iv) && is_numeric($request->fv) && is_numeric($request->cac)) {
			if (!empty($request->ct) || $request->ct=='0' || !empty($request->cdis) || $request->cdis=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$iv=$request->iv;
				if ($request->ivU=='ft/s') {
					$iv=$iv/3.281;
				}
				if ($request->ivU=='km/h') {
					$iv=$iv/3.6;
				}
				if ($request->ivU=='km/s') {
					$iv=$iv*1000;
				}
				if ($request->ivU=='mi/s') {
					$iv=$iv*1609.35;
				}
				if ($request->ivU=='mph') {
					$iv=$iv/2.237;
				}
				$fv=$request->fv;
				if ($request->fvU=='ft/s') {
					$fv=$fv/3.281;
				}
				if ($request->fvU=='km/h') {
					$fv=$fv/3.6;
				}
				if ($request->fvU=='km/s') {
					$fv=$fv*1000;
				}
				if ($request->fvU=='mi/s') {
					$fv=$fv*1609.35;
				}
				if ($request->fvU=='mph') {
					$fv=$fv/2.237;
				}
				$a=$request->cac;
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$time=round(($fv-$iv)/$a,4);
				$dis=($iv*$time) + (0.5*$a*pow($time, 2));
				$iv=$request->iv.' '.$request->ivU;
				$fv=$request->fv.' '.$request->fvU;
				$a=$request->cac.' '.$request->cacU;
				if ($request->ctU=='min') {
					$time=round($time/60,4);
				}
				if ($request->ctU=='h') {
					$time=round($time/60/60,4);
				}
				$time=$time.' '.$request->ctU;
				if ($request->cdisU=='cm') {
					$dis=round($dis*100,4);
				}
				if ($request->cdisU=='in') {
					$dis=round($dis*39.37,4);
				}
				if ($request->cdisU=='ft') {
					$dis=round($dis*3.281,4);
				}
				if ($request->cdisU=='km') {
					$dis=round($dis*1000,4);
				}
				if ($request->cdisU=='mi') {
					$dis=round($dis/1609.35,4);
				}
				if ($request->cdisU=='yd') {
					$dis=round($dis*1.094,4);
				}
				$dis=$dis.' '.$request->cdisU;
			}
		} elseif (is_numeric($request->ct) && is_numeric($request->fv) && is_numeric($request->cac)) {
			if (!empty($request->iv) || $request->iv=='0' || !empty($request->cdis) || $request->cdis=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$time=$request->ct;
				if ($request->ctU=='min') {
					$time=$time*60;
				}
				if ($request->ctU=='h') {
					$time=$time*60*60;
				}
				$fv=$request->fv;
				if ($request->fvU=='ft/s') {
					$fv=$fv/3.281;
				}
				if ($request->fvU=='km/h') {
					$fv=$fv/3.6;
				}
				if ($request->fvU=='km/s') {
					$fv=$fv*1000;
				}
				if ($request->fvU=='mi/s') {
					$fv=$fv*1609.35;
				}
				if ($request->fvU=='mph') {
					$fv=$fv/2.237;
				}
				$a=$request->cac;
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$iv=round($fv-($a*$time),4);
				$dis=($iv*$time) + (0.5*$a*pow($time, 2));
				$time=$time.' '.$request->ctU;
				$fv=$request->fv.' '.$request->fvU;
				$a=$request->cac.' '.$request->cacU;
				if ($request->ivU=='ft/s') {
					$iv=round($iv*3.281,4);
				}
				if ($request->ivU=='km/h') {
					$iv=round($iv*3.6,4);
				}
				if ($request->ivU=='km/s') {
					$iv=round($iv/1000,4);
				}
				if ($request->ivU=='mi/s') {
					$iv=round($iv/1609.35,4);
				}
				if ($request->ivU=='mph') {
					$iv=round($iv*2.237,4);
				}
				$iv=$iv.' '.$request->ivU;
				if ($request->cdisU=='cm') {
					$dis=round($dis*100,4);
				}
				if ($request->cdisU=='in') {
					$dis=round($dis*39.37,4);
				}
				if ($request->cdisU=='ft') {
					$dis=round($dis*3.281,4);
				}
				if ($request->cdisU=='km') {
					$dis=round($dis*1000,4);
				}
				if ($request->cdisU=='mi') {
					$dis=round($dis/1609.35,4);
				}
				if ($request->cdisU=='yd') {
					$dis=round($dis*1.094,4);
				}
				$dis=$dis.' '.$request->cdisU;
			}
		}elseif (is_numeric($request->ct) && is_numeric($request->iv) && is_numeric($request->cac)) {
			if (!empty($request->fv) || $request->fv=='0' || !empty($request->cdis) || $request->cdis=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$time=$request->ct;
				if ($request->ctU=='min') {
					$time=$time*60;
				}
				if ($request->ctU=='h') {
					$time=$time*60*60;
				}
				$iv=$request->iv;
				if ($request->ivU=='ft/s') {
					$iv=$iv/3.281;
				}
				if ($request->ivU=='km/h') {
					$iv=$iv/3.6;
				}
				if ($request->ivU=='km/s') {
					$iv=$iv*1000;
				}
				if ($request->ivU=='mi/s') {
					$iv=$iv*1609.35;
				}
				if ($request->ivU=='mph') {
					$iv=$iv/2.237;
				}
				$a=$request->cac;
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$fv=round(($a*$time)+$iv,4);
				$dis=($iv*$time) + (0.5*$a*pow($time, 2));
				$iv=$request->iv.' '.$request->ivU;
				$time=$request->ct.' '.$request->ctU;
				$a=$request->cac.' '.$request->cacU;
				if ($request->fvU=='ft/s') {
					$fv=round($fv*3.281,4);
				}
				if ($request->fvU=='km/h') {
					$fv=round($fv*3.6,4);
				}
				if ($request->fvU=='km/s') {
					$fv=round($fv/1000,4);
				}
				if ($request->fvU=='mi/s') {
					$fv=round($fv/1609.35,4);
				}
				if ($request->fvU=='mph') {
					$fv=round($fv*2.237,4);
				}
				$fv=$fv.' '.$request->fvU;
				if ($request->cdisU=='cm') {
					$dis=round($dis*100,4);
				}
				if ($request->cdisU=='in') {
					$dis=round($dis*39.37,4);
				}
				if ($request->cdisU=='ft') {
					$dis=round($dis*3.281,4);
				}
				if ($request->cdisU=='km') {
					$dis=round($dis*1000,4);
				}
				if ($request->cdisU=='mi') {
					$dis=round($dis/1609.35,4);
				}
				if ($request->cdisU=='yd') {
					$dis=round($dis*1.094,4);
				}
				$dis=$dis.' '.$request->cdisU;
			}
		}elseif (is_numeric($request->cdis) && is_numeric($request->iv) && is_numeric($request->ct)) {
			if (!empty($request->fv) || $request->fv=='0' || !empty($request->cac) || $request->cac=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$dis=$request->cdis;
				if ($request->cdisU=='cm') {
					$dis=$dis/100;
				}
				if ($request->cdisU=='in') {
					$dis=$dis/39.37;
				}
				if ($request->cdisU=='ft') {
					$dis=$dis/3.281;
				}
				if ($request->cdisU=='km') {
					$dis=$dis/1000;
				}
				if ($request->cdisU=='mi') {
					$dis=$dis*1609.35;
				}
				if ($request->cdisU=='yd') {
					$dis=$dis/1.094;
				}
				$time=$request->ct;
				if ($request->ctU=='min') {
					$time=$time*60;
				}
				if ($request->ctU=='h') {
					$time=$time*60*60;
				}
				$iv=$request->iv;
				if ($request->ivU=='ft/s') {
					$iv=$iv/3.281;
				}
				if ($request->ivU=='km/h') {
					$iv=$iv/3.6;
				}
				if ($request->ivU=='km/s') {
					$iv=$iv*1000;
				}
				if ($request->ivU=='mi/s') {
					$iv=$iv*1609.35;
				}
				if ($request->ivU=='mph') {
					$iv=$iv/2.237;
				}
				$a=round(2*($dis-($iv*$time))/pow($time, 2),4);
				$fv=round(($a*$time)+$iv,4);
				$iv=$request->iv.' '.$request->ivU;
				$time=$request->ct.' '.$request->ctU;
				$dis=$request->cdis.' '.$request->cdisU;
				if ($request->cacU=='ft/s²') {
					$a=round($a*3.2808399,4);
				}
				$a=$a.' '.$request->cacU;
				if ($request->fvU=='ft/s') {
					$fv=round($fv*3.281,4);
				}
				if ($request->fvU=='km/h') {
					$fv=round($fv*3.6,4);
				}
				if ($request->fvU=='km/s') {
					$fv=round($fv/1000,4);
				}
				if ($request->fvU=='mi/s') {
					$fv=round($fv/1609.35,4);
				}
				if ($request->fvU=='mph') {
					$fv=round($fv*2.237,4);
				}
				$fv=$fv.' '.$request->fvU;
			}
		}elseif (is_numeric($request->cdis) && is_numeric($request->fv) && is_numeric($request->ct)) {
			if (!empty($request->iv) || $request->iv=='0' || !empty($request->cac) || $request->cac=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$dis=$request->cdis;
				if ($request->cdisU=='cm') {
					$dis=$dis/100;
				}
				if ($request->cdisU=='in') {
					$dis=$dis/39.37;
				}
				if ($request->cdisU=='ft') {
					$dis=$dis/3.281;
				}
				if ($request->cdisU=='km') {
					$dis=$dis/1000;
				}
				if ($request->cdisU=='mi') {
					$dis=$dis*1609.35;
				}
				if ($request->cdisU=='yd') {
					$dis=$dis/1.094;
				}
				$time=$request->ct;
				if ($request->ctU=='min') {
					$time=$time*60;
				}
				if ($request->ctU=='h') {
					$time=$time*60*60;
				}
				$fv=$request->fv;
				if ($request->fvU=='ft/s') {
					$fv=$fv/3.281;
				}
				if ($request->fvU=='km/h') {
					$fv=$fv/3.6;
				}
				if ($request->fvU=='km/s') {
					$fv=$fv*1000;
				}
				if ($request->fvU=='mi/s') {
					$fv=$fv*1609.35;
				}
				if ($request->fvU=='mph') {
					$fv=$fv/2.237;
				}
				$iv=round(((2*$dis)/$time)-$fv,4);
				$a=round(2*($dis-($iv*$time))/pow($time, 2),4);
				$fv=$request->fv.' '.$request->fvU;
				$time=$request->ct.' '.$request->ctU;
				$dis=$request->cdis.' '.$request->cdisU;
				if ($request->cacU=='ft/s²') {
					$a=round($a*3.2808399,4);
				}
				$a=$a.' '.$request->cacU;
				if ($request->ivU=='ft/s') {
					$iv=round($iv*3.281,4);
				}
				if ($request->ivU=='km/h') {
					$iv=round($iv*3.6,4);
				}
				if ($request->ivU=='km/s') {
					$iv=round($iv/1000,4);
				}
				if ($request->ivU=='mi/s') {
					$iv=round($iv/1609.35,4);
				}
				if ($request->ivU=='mph') {
					$iv=round($iv*2.237,4);
				}
				$iv=$iv.' '.$request->ivU;
			}
		}elseif (is_numeric($request->cdis) && is_numeric($request->iv) && is_numeric($request->cac)) {
			if (!empty($request->fv) || $request->fv=='0' || !empty($request->ct) || $request->ct=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$dis=$request->cdis;
				if ($request->cdisU=='cm') {
					$dis=$dis/100;
				}
				if ($request->cdisU=='in') {
					$dis=$dis/39.37;
				}
				if ($request->cdisU=='ft') {
					$dis=$dis/3.281;
				}
				if ($request->cdisU=='km') {
					$dis=$dis/1000;
				}
				if ($request->cdisU=='mi') {
					$dis=$dis*1609.35;
				}
				if ($request->cdisU=='yd') {
					$dis=$dis/1.094;
				}
				$iv=$request->iv;
				if ($request->ivU=='ft/s') {
					$iv=$iv/3.281;
				}
				if ($request->ivU=='km/h') {
					$iv=$iv/3.6;
				}
				if ($request->ivU=='km/s') {
					$iv=$iv*1000;
				}
				if ($request->ivU=='mi/s') {
					$iv=$iv*1609.35;
				}
				if ($request->ivU=='mph') {
					$iv=$iv/2.237;
				}
				$a=$request->cac;
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$time=round(sqrt(2*$dis/$a),4);
				$fv=round(sqrt(pow($iv, 2)+(2*$a*$dis)),4);
				$iv=$request->iv.' '.$request->ivU;
				$dis=$request->cdis.' '.$request->cdisU;
				$a=$request->cac.' '.$request->cacU;
				if ($request->fvU=='ft/s') {
					$fv=round($fv*3.281,4);
				}
				if ($request->fvU=='km/h') {
					$fv=round($fv*3.6,4);
				}
				if ($request->fvU=='km/s') {
					$fv=round($fv/1000,4);
				}
				if ($request->fvU=='mi/s') {
					$fv=round($fv/1609.35,4);
				}
				if ($request->fvU=='mph') {
					$fv=round($fv*2.237,4);
				}
				$fv=$fv.' '.$request->fvU;
				if ($request->ctU=='min') {
					$time=round($time/60,4);
				}
				if ($request->ctU=='h') {
					$time=round($time/60/60,4);
				}
				$time=$time.' '.$request->ctU;
			}
		}elseif (is_numeric($request->cdis) && is_numeric($request->fv) && is_numeric($request->cac)) {
			if (!empty($request->iv) || $request->iv=='0' || !empty($request->ct) || $request->ct=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$dis=$request->cdis;
				if ($request->cdisU=='cm') {
					$dis=$dis/100;
				}
				if ($request->cdisU=='in') {
					$dis=$dis/39.37;
				}
				if ($request->cdisU=='ft') {
					$dis=$dis/3.281;
				}
				if ($request->cdisU=='km') {
					$dis=$dis/1000;
				}
				if ($request->cdisU=='mi') {
					$dis=$dis*1609.35;
				}
				if ($request->cdisU=='yd') {
					$dis=$dis/1.094;
				}
				$fv=$request->fv;
				if ($request->fvU=='ft/s') {
					$fv=$fv/3.281;
				}
				if ($request->fvU=='km/h') {
					$fv=$fv/3.6;
				}
				if ($request->fvU=='km/s') {
					$fv=$fv*1000;
				}
				if ($request->fvU=='mi/s') {
					$fv=$fv*1609.35;
				}
				if ($request->fvU=='mph') {
					$fv=$fv/2.237;
				}
				$a=$request->cac;
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$iv=round(sqrt(pow($fv,2) - (2*$a*$dis)),4);
				$time_=round(sqrt(2*$dis/$a),4);
				$time=round(($fv-$iv)/$a,4);
				$fv=$request->fv.' '.$request->fvU;
				$dis=$request->cdis.' '.$request->cdisU;
				$a=$request->cac.' '.$request->cacU;
				if ($request->ivU=='ft/s') {
					$iv=round($iv*3.281,4);
				}
				if ($request->ivU=='km/h') {
					$iv=round($iv*3.6,4);
				}
				if ($request->ivU=='km/s') {
					$iv=round($iv/1000,4);
				}
				if ($request->ivU=='mi/s') {
					$iv=round($iv/1609.35,4);
				}
				if ($request->ivU=='mph') {
					$iv=round($iv*2.237,4);
				}
				$iv=$iv.' '.$request->ivU;
				if ($request->ctU=='min') {
					$time=round($time/60,4);
				}
				if ($request->ctU=='h') {
					$time=round($time/60/60,4);
				}
				$time=$time.' '.$request->ctU;
			}
		} elseif (is_numeric($request->cdis) && is_numeric($request->iv) && is_numeric($request->fv)) {
			if (!empty($request->cac) || $request->cac=='0' || !empty($request->ct) || $request->ct=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$dis=$request->cdis;
				if ($request->cdisU=='cm') {
					$dis=$dis/100;
				}
				if ($request->cdisU=='in') {
					$dis=$dis/39.37;
				}
				if ($request->cdisU=='ft') {
					$dis=$dis/3.281;
				}
				if ($request->cdisU=='km') {
					$dis=$dis/1000;
				}
				if ($request->cdisU=='mi') {
					$dis=$dis*1609.35;
				}
				if ($request->cdisU=='yd') {
					$dis=$dis/1.094;
				}
				$iv=$request->iv;
				if ($request->ivU=='ft/s') {
					$iv=$iv/3.281;
				}
				if ($request->ivU=='km/h') {
					$iv=$iv/3.6;
				}
				if ($request->ivU=='km/s') {
					$iv=$iv*1000;
				}
				if ($request->ivU=='mi/s') {
					$iv=$iv*1609.35;
				}
				if ($request->ivU=='mph') {
					$iv=$iv/2.237;
				}
				$fv=$request->fv;
				if ($request->fvU=='ft/s') {
					$fv=$fv/3.281;
				}
				if ($request->fvU=='km/h') {
					$fv=$fv/3.6;
				}
				if ($request->fvU=='km/s') {
					$fv=$fv*1000;
				}
				if ($request->fvU=='mi/s') {
					$fv=$fv*1609.35;
				}
				if ($request->fvU=='mph') {
					$fv=$fv/2.237;
				}
				$a=round((pow($fv,2) - pow($iv,2))/(2*$dis),4);
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$time=round(($fv - $iv) / $a,4);
				if ($request->ctU=='min') {
					$time=round($time/60,4);
				}
				if ($request->ctU=='h') {
					$time=round($time/60/60,4);
				}
				$time=$time.' '.$request->ctU;
				$a=$a.' '.$request->cacU;
				$iv=$request->iv.' '.$request->ivU;
				$fv=$request->fv.' '.$request->fvU;
				$dis=$request->cdis.' '.$request->cdisU;
			}
		} elseif (is_numeric($request->cdis) && is_numeric($request->ct) && is_numeric($request->cac)) {
			if (!empty($request->iv) || $request->iv=='0' || !empty($request->fv) || $request->fv=='0') {
                $this->param['error'] = 'Please fill all fields.';
                return $this->param;
			} else {
				$check=true;
				$dis=$request->cdis;
				if ($request->cdisU=='cm') {
					$dis=$dis/100;
				}
				if ($request->cdisU=='in') {
					$dis=$dis/39.37;
				}
				if ($request->cdisU=='ft') {
					$dis=$dis/3.281;
				}
				if ($request->cdisU=='km') {
					$dis=$dis/1000;
				}
				if ($request->cdisU=='mi') {
					$dis=$dis*1609.35;
				}
				if ($request->cdisU=='yd') {
					$dis=$dis/1.094;
				}
				$time=$request->ct;
				if ($request->ctU=='min') {
					$time=$time*60;
				}
				if ($request->ctU=='h') {
					$time=$time*60*60;
				}
				$a=$request->cac;
				if ($request->cacU=='ft/s²') {
					$a=$a/3.2808399;
				}
				$iv=round(($dis-(0.5*$a*pow($time,2)))/$time,4);
				if ($request->ivU=='ft/s') {
					$iv=round($iv*3.281,4);
				}
				if ($request->ivU=='km/h') {
					$iv=round($iv*3.6,4);
				}
				if ($request->ivU=='km/s') {
					$iv=round($iv/1000,4);
				}
				if ($request->ivU=='mi/s') {
					$iv=round($iv/1609.35,4);
				}
				if ($request->ivU=='mph') {
					$iv=round($iv*2.237,4);
				}
				$fv=round($iv+($a*$time),4);
				if ($request->fvU=='ft/s') {
					$fv=round($fv*3.281,4);
				}
				if ($request->fvU=='km/h') {
					$fv=round($fv*3.6,4);
				}
				if ($request->fvU=='km/s') {
					$fv=round($fv/1000,4);
				}
				if ($request->fvU=='mi/s') {
					$fv=round($fv/1609.35,4);
				}
				if ($request->fvU=='mph') {
					$fv=round($fv*2.237,4);
				}
				$fv=$fv.' '.$request->fvU;
				$iv=$iv.' '.$request->ivU;
				$dis=$request->cdis.' '.$request->cdisU;
				$a=$request->cac.' '.$request->cacU;
				$time=$request->ct.' '.$request->ctU;
			}
		}
		if ($check==true) {
			$this->param['iv'] = $iv;
			$this->param['fv'] = $fv;
			$this->param['time'] = $time;
			$this->param['dis'] = $dis;
			$this->param['a'] = $a;
			$this->param['RESULT'] = 1;

            return $this->param;
		}else{
            $this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/*******************
         Displacement Calculator
	 *******************/
	function displacement($request)
	{

		$disp_known = $request->known;
		$check = false;
		if (isset($disp_known)) {
			if (($disp_known) === "1") {
				$sldsp = $request->sldsp;
				$avg = $request->av;
				$slav = $request->slav;
				$tme = $request->tm;
				$sltm = $request->sltm;
				$check = true;

				$this->param["avg"] = $avg . " " . $slav;

				if ($slav === "ft/s") {
					$avg = $avg * 0.3048;
				}
				if ($slav === "km/h") {
					$avg = $avg * 0.277778;
				}
				if ($slav === "km/s") {
					$avg = $avg * 1000;
				}
				if ($slav === "mi/s") {
					$avg = $avg * 1609.34;
				}
				if ($slav === "mph") {
					$avg = $avg / 2.237;
				}

				$this->param["tme"] = $tme . " " . $sltm;

				if ($sltm === "min") {
					$tme = $tme * 60;
				}
				if ($sltm === "h") {
					$tme = $tme * 60 * 60;
				}

				$dsp = $avg * $tme;

				if ($sldsp === "cm") {
					$dsp = $dsp * 100;
				}
				if ($sldsp === "in") {
					$dsp = $dsp * 39.37;
				}
				if ($sldsp === "ft") {
					$dsp = $dsp * 3.281;
				}
				if ($sldsp === "km") {
					$dsp = $dsp / 1000;
				}
				if ($sldsp === "mi") {
					$dsp = $dsp / 1609.35;
				}

				$this->param["dsp"] = round($dsp, 4) . " " . $sldsp;
			} elseif (($disp_known) === "2") {

				$sldsp = $request->sldsp;
				$tme = $request->tm;
				$sltm = $request->sltm;
				$iv = $request->iv;
				$sliv = $request->sliv;
				$acce = $request->acc;
				$slacc = $request->slacc;

				$check = true;

				$this->param["ivs"] = $iv . " " . $sliv;
				if ($sliv === "ft/s") {
					$iv = $iv * 0.3048;
				}
				if ($sliv === "km/h") {
					$iv = $iv * 0.277778;
				}
				if ($sliv === "km/s") {
					$iv = $iv * 1000;
				}
				if ($sliv === "mi/s") {
					$iv = $iv * 1609.34;
				}
				if ($sliv === "mph") {
					$iv = $iv / 2.237;
				}

				$this->param["tme"] = $tme . " " . $sltm;

				if ($sltm === "min") {
					$tme = $tme * 60;
				}
				if ($sltm === "h") {
					$tme = $tme * 60 * 60;
				}

				$this->param["acce"] = $acce . " " . $slacc;
				if ($slacc === "ft/s²") {
					$acce = $acce * 0.3048;
				}

				$dsp = ($iv * $tme) + (0.5 * ($acce * pow($tme, 2)));
				if ($sldsp === "cm") {
					$dsp = $dsp * 100;
				}
				if ($sldsp === "in") {
					$dsp = $dsp * 39.37;
				}
				if ($sldsp === "ft") {
					$dsp = $dsp * 3.281;
				}
				if ($sldsp === "km") {
					$dsp = $dsp / 1000;
				}
				if ($sldsp === "mi") {
					$dsp = $dsp / 1609.35;
				}

				$this->param["dsp"] = round($dsp, 4) . " " . $sldsp;
			} elseif (($disp_known) === "3") {

				$sldsp = $request->sldsp;
				$tme = $request->tm;
				$sltm = $request->sltm;
				$iv = $request->iv;
				$sliv = $request->sliv;
				$fv = $request->fv;
				$slfv = $request->slfv;
				$check = true;

				$this->param["ivs"] = $iv . " " . $sliv;
				if ($sliv === "ft/s") {
					$iv = $iv * 0.3048;
				}
				if ($sliv === "km/h") {
					$iv = $iv * 0.277778;
				}
				if ($sliv === "km/s") {
					$iv = $iv * 1000;
				}
				if ($sliv === "mi/s") {
					$iv = $iv * 1609.34;
				}
				if ($sliv === "mph") {
					$iv = $iv / 2.237;
				}

				$this->param["tme"] = $tme . " " . $sltm;
				if ($sltm === "min") {
					$tme = $tme * 60;
				}
				if ($sltm === "h") {
					$tme = $tme * 60 * 60;
				}

				$this->param["fvs"] = $fv . " " . $slfv;
				if ($slfv === "ft/s") {
					$fv = $fv * 0.3048;
				}
				if ($slfv === "km/h") {
					$fv = $fv * 0.277778;
				}
				if ($slfv === "km/s") {
					$fv = $fv * 1000;
				}
				if ($slfv === "mi/s") {
					$fv = $fv * 1609.34;
				}
				if ($slfv === "mph") {
					$fv = $fv / 2.237;
				}

				$dsp = 0.5 * ($fv + $iv) * $tme;
				if ($sldsp === "cm") {
					$dsp = $dsp * 100;
				}
				if ($sldsp === "in") {
					$dsp = $dsp * 39.37;
				}
				if ($sldsp === "ft") {
					$dsp = $dsp * 3.281;
				}
				if ($sldsp === "km") {
					$dsp = $dsp / 1000;
				}
				if ($sldsp === "mi") {
					$dsp = $dsp / 1609.35;
				}

				$this->param["dsp"] = round($dsp, 4) . " " . $sldsp;
			} elseif (($disp_known) === "4") {
				$check = true;


				$vlocInpAr = array();
				$vlocSlcAr = array();
				$timiInpAr = array();
				$timiSlcAr = array();
				$vloReslt  = array();

				for ($i = 0; $i < 10; $i++) {
					$vloIn = $request->input('vloc_' . $i);
					$vloSl = $request->input('slvloc_' . $i);
					// dd($vloSl);
					if ($vloSl === "ft/s") {
						$vloIn = $vloIn * 0.3048;
					}
					if ($vloSl === "km/h") {
						$vloIn = $vloIn * 0.277778;
					}
					if ($vloSl === "km/s") {
						$vloIn = $vloIn * 1000;
					}
					if ($vloSl === "mi/s") {
						$vloIn = $vloIn * 1609.34;
					}
					if ($vloSl === "mph") {
						$vloIn = $vloIn / 2.237;
					}
					$vlocInpAr[] = $vloIn;
					$vlocSlcAr[] = $vloSl;

					$timIn = $request->timi_ . $i;
					$timSl = $request->sltimi_ . $i;
					if ($timSl === "min") {
						$timIn = $timIn * 60;
					}
					if ($timSl === "h") {
						$timIn = $timIn * 60 * 60;
					}
					$timiInpAr[] = $timIn;
					$timiSlcAr[] = $timSl;

					$vloReslt[] = $vlocInpAr[$i] * $timiInpAr[$i];
				}

				$sldsp = $request->sldsp;
				// if (!is_numeric($sldsp)) {
				// 	$check=false;
				// }
				$dsp = array_sum($vloReslt);
				if ($sldsp === "cm") {
					$dsp = $dsp * 100;
				}
				if ($sldsp === "in") {
					$dsp = $dsp * 39.37;
				}
				if ($sldsp === "ft") {
					$dsp = $dsp * 3.281;
				}
				if ($sldsp === "km") {
					$dsp = $dsp / 1000;
				}
				if ($sldsp === "mi") {
					$dsp = $dsp / 1609.35;
				}

				$this->param["dsp"]   = round($dsp, 4) . " " . $sldsp;
				$this->param["dspft"] = round(array_sum($vloReslt) * 3.281, 4);
				$this->param["dspkm"] = round(array_sum($vloReslt) / 1000, 4);
				$this->param["dspmi"] = round(array_sum($vloReslt) / 1609.35, 4);
			}
		}

		if ($check === true) {
			$this->param["RESULT"] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/*******************
        Instantaneous Rate of Change Calculator
	 *******************/
	function i_r_o_c($request)
	{
		$EnterEq = $request->EnterEq;
		$x = $request->x;

		if (preg_match("/\<|\>|\&|php|print_r|print|echo|script|&|%/i", $EnterEq)) {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($x) && !empty($EnterEq)) {
			$parem = $EnterEq;
			$parem = str_replace('M(x) =', '', $parem);
			$parem = str_replace('f(x) =', '', $parem);
			$parem = str_replace('Square root', 'sqrt', $parem);
			$parem = str_replace('√', 'sqrt', $parem);
			$parem = str_replace(' ', '', $parem);
			$parem = str_replace('y=', '', $parem);
			$parem = str_replace('+', 'plus', $parem);
			$parem = str_replace('%20', '', $parem);
			$parem = str_replace('{', '(', $parem);
			$parem = str_replace('}', ')', $parem);
			$parem = str_replace('e^', 'exp', $parem);
			$parem = str_replace('exp^', 'exp', $parem);
			$parem = str_replace('^', '**', $parem);
			$parem = str_replace('e^sqrt(x)', 'exp(2*x)', $parem);
			$command = "python3 application/models/python/i_r_o_c.py $parem $x";
			require __DIR__ . '/../../vendor/autoload.php';
			$client = new \GuzzleHttp\Client();
			try {
				$r = $client->request(
					'POST',
					"http://167.172.134.148/new-i_r_o_c",
					['form_params' => [
						'equ' => $parem,
						'x' => $x,
					]],
					['timeout' => 120],
				);
				$buffer =  $r->getBody();
				$buffer = json_decode($buffer, true);
				$this->param['equation'] = $buffer[2];
				$this->param['deriv'] = round($buffer[0],7);
				$this->param['steps'] = $buffer[1];
				$this->param['RESULT'] = 1;
				return $this->param;
			} catch (Exception $r) {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/*******************
         vector  Calculator
	 *******************/
	function vector($request)
	{
		$dem = trim($request->dem);
		$rep = trim($request->a_rep);
		$ax = trim($request->ax);
		$ay = trim($request->ay);
		$az = trim($request->az);
		$w = trim($request->w);
		$t = trim($request->t);
		$a1 = trim($request->a1);
		$a2 = trim($request->a2);
		$a3 = trim($request->a3);
		$a4 = trim($request->a4);
		$a5 = trim($request->a5);
		$b1 = trim($request->b1);
		$b2 = trim($request->b2);
		$b3 = trim($request->b3);
		$b4 = trim($request->b4);
		$b5 = trim($request->b5);
		if ($rep =='coor') {
			if ($dem == '2') {
				if (is_numeric($ax) && is_numeric($ay)) {
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}elseif ($dem == '3') {
				if (is_numeric($ax) && is_numeric($ay) && is_numeric($az)) {
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2) + pow($az, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}elseif ($dem == '4') {
				if (is_numeric($ax) && is_numeric($ay) && is_numeric($az) && is_numeric($w)) {
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2) + pow($az, 2) + pow($w, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}elseif ($dem == '5') {
				if (is_numeric($ax) && is_numeric($ay) && is_numeric($az) && is_numeric($w) && is_numeric($t)) {
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2) + pow($az, 2) + pow($w, 2) + pow($t, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}
		}else{
			if ($dem == '2') {
				if (is_numeric($a1) && is_numeric($a2) && is_numeric($b1) && is_numeric($b2)) {
					$ax=$b1-$a1;
					$ay=$b2-$a2;
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}elseif ($dem == '3') {
				if (is_numeric($a1) && is_numeric($a2) && is_numeric($b1) && is_numeric($b2) && is_numeric($a3) && is_numeric($b3)) {
					$ax=$b1-$a1;
					$ay=$b2-$a2;
					$az=$b3-$a3;
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2) + pow($az, 2)),5);					
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}elseif ($dem == '4') {
				if (is_numeric($a1) && is_numeric($a2) && is_numeric($b1) && is_numeric($b2) && is_numeric($a3) && is_numeric($b3) && is_numeric($a4) && is_numeric($b4)) {
					$ax=$b1-$a1;
					$ay=$b2-$a2;
					$az=$b3-$a3;
					$w=$b4-$a4;
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2) + pow($az, 2) + pow($w, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}elseif ($dem == '5') {
				if (is_numeric($a1) && is_numeric($a2) && is_numeric($b1) && is_numeric($b2) && is_numeric($a3) && is_numeric($b3) && is_numeric($a4) && is_numeric($b4) && is_numeric($a5) && is_numeric($b5)) {
					$ax=$b1-$a1;
					$ay=$b2-$a2;
					$az=$b3-$a3;
					$w=$b4-$a4;
					$t=$b5-$a5;
					$mag=round(sqrt(pow($ax, 2) + pow($ay, 2) + pow($az, 2) + pow($w, 2) + pow($t, 2)),5);
					$this->param['mag'] = $mag;
				    $this->param['RESULT'] = 1;
					return  $this->param;
				}else{
					 $this->param['error'] = 'Please! Check Your Input';
        			return  $this->param;
				}
			}
		}
	}

	// Force Calculator
	function force($request)
	{

		$submit = trim($request->unit_type);
		if ($submit === 'm1') {
			$cal = trim($request->cal);
			$f = trim($request->f);
			$f_unit = trim($request->f_unit);
			$m = trim($request->m);
			$m_unit = trim($request->m_unit);
			$a = trim($request->a);
			$a_unit = trim($request->a_unit);
			$sigfig = trim($request->sigfig);
		} elseif ($submit === 'm2') {
			$question = trim($request->question);
			$a_f = trim($request->a_f);
			$g_f = trim($request->g_f);
			$f_v = trim($request->f_v);
		}
		if ($submit === 'm1') {
			if (is_numeric($f) && is_numeric($m) && is_numeric($a)  && !empty($f_unit) && !empty($m_unit) && !empty($a_unit) && !empty($sigfig) && !empty($cal)) {
				$check = true;
			} else {
				$check = false;
			}
		} else {
			if (is_numeric($a_f) && is_numeric($g_f) && !empty($f_v) && !empty($question)) {
				$check = true;
			} else {
				$check = false;
			}
		}

		if ($check === true) {
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
			if ($submit === 'm1') {
				// Unit Conversion
				if (is_numeric($f)) {
					if ($f_unit === 'dyn') {
						$f = $f / 100000;
					} elseif ($f_unit === 'kgf') {
						$f = $f * 9.80665;
					} elseif ($f_unit === 'kn') {
						$f = $f / 0.001;
					} elseif ($f_unit === 'mn') {
						$f = $f / 0.000001;
					} elseif ($f_unit === 'gn') {
						$f = $f / 0.000000001;
					} elseif ($f_unit === 'tn') {
						$f = $f / 0.000000000001;
					} elseif ($f_unit === 'kip') {
						$f = $f * 4448.222;
					} elseif ($f_unit === 'ibf') {
						$f = $f * 4.44822;
					} elseif ($f_unit === 'ozf') {
						$f = $f * 0.2780139;
					} elseif ($f_unit === 'pdl') {
						$f = $f * 0.138255;
					}
				}
				if (is_numeric($m)) {
					if ($m_unit === 'ug') {
						$m = $m / 1000000000;
					} elseif ($m_unit === 'mg') {
						$m = $m * 1000000;
					} elseif ($m_unit === 'g') {
						$m = $m / 1000;
					} elseif ($m_unit === 'dag') {
						$m = $m / 100;
					} elseif ($m_unit === 't') {
						$m = $m / 0.001;
					} elseif ($m_unit === 'gr') {
						$m = $m / 15432;
					} elseif ($m_unit === 'dr') {
						$m = $m / 564.4;
					} elseif ($m_unit === 'oz') {
						$m = $m / 35.274;
					} elseif ($m_unit === 'lb') {
						$m = $m / 2.2046;
					} elseif ($m_unit === 'stone') {
						$m = $m / 0.15747;
					} elseif ($m_unit === 'us_ton') {
						$m = $m / 0.0011023;
					} elseif ($m_unit === 'long_ton') {
						$m = $m / 0.0009842;
					} elseif ($m_unit === 'earths') {
						$m = $m * 5972000000000000000000000;
					}
				}
				if (is_numeric($a)) {
					if ($a_unit === 'in_s2') {
						$a = $a / 39.370078740157;
					} elseif ($a_unit === 'ft_s2') {
						$a = $a / 3.2808398950131;
					} elseif ($a_unit === 'cm_s2') {
						$a = $a * 0.01;
					} elseif ($a_unit === 'mi_s2') {
						$a = $a / 0.00062137119223733;
					} elseif ($a_unit === 'mi_hs') {
						$a = $a / 2.236936292054;
					} elseif ($a_unit === 'km_s2') {
						$a = $a / 0.001;
					} elseif ($a_unit === 'km_hs') {
						$a = $a / 3.6;
					}
				}
				if ($cal === 'f' && is_numeric($m) && is_numeric($a)) {
					$f = $m * $a;
					if ($sigfig !== 'auto') {
						$f = sigFig($f, $sigfig);
					}
					$this->param['ans'] = $f . ' N';
					$this->param['m'] = $m;
					$this->param['a'] = $a;
				} elseif ($cal === 'm' && is_numeric($f) && is_numeric($a)) {
					$m = $f / $a;
					$this->param['ans'] = $m . ' kg';
					$this->param['f'] = $f;
					$this->param['a'] = $a;
				} elseif ($cal === 'a' && is_numeric($f) && is_numeric($m)) {
					$a = $f / $m;
					$this->param['ans'] = $a . ' m/s²';
					$this->param['f'] = $f;
					$this->param['m'] = $m;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
				$this->param['share'] = 'share';
			} elseif ($submit === 'm2') {

				if ($question === 'yes' && is_numeric($a_f) && is_numeric($g_f)) {

					$nf = $a_f + $g_f;
					$this->param['nf'] = sigFig($nf, 4);
				} elseif ($question === 'no' && !empty($f_v)) {
					$f_v = array_map("trim", array_filter(explode(",", $f_v)));
					foreach ($f_v as $value) {
						if (!is_numeric($value)) {
							$this->param['error'] = 'Please fill all fields.';
							return $this->param;
						}
					}
					$nf = array_sum($f_v);

					$ex = '';
					foreach ($f_v as $key => $value) {
						if ($key === count($f_v) - 1) {
							$ex .= $value;
						} else {
							$ex .= $value . ' + ';
						}
					}

					$this->param['nf'] = sigFig($nf, 4);

					$this->param['ex'] = $ex;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	// unit vector Calculator

	function unit_vector($request)
	{
		$method = trim($request->method);
		$dimen = trim($request->dimen);
		$find = trim($request->find);
		$find1 = trim($request->find1);
		$x = trim($request->x);
		$y = trim($request->y);
		$z = trim($request->z);
		$fx = trim($request->fx);
		$fy = trim($request->fy);
		$fz = trim($request->fz);

		if (is_numeric($x) && is_numeric($y) && is_numeric($z)  && !empty($method) && !empty($dimen)) {

			if ($method === 'normalize') {
				if ($dimen === '2d') {
					if (is_numeric($x) && is_numeric($y)) {
						$magnitude = sqrt(pow($x, 2) + pow($y, 2));
						$vx = $x / $magnitude;
						$vy = $y / $magnitude;
						$this->param['vx'] = $vx;
						$this->param['vy'] = $vy;
						$this->param['magnitude'] = $magnitude;
					} else {
						$this->param['error'] = 'Please fill all fields.';
						return $this->param;
					}
				} elseif ($dimen === '3d') {
					if (is_numeric($x) && is_numeric($y) && is_numeric($z)) {
						$magnitude = sqrt(pow($x, 2) + pow($y, 2) + pow($z, 2));
						$vx = $x / $magnitude;
						$vy = $y / $magnitude;
						$vz = $z / $magnitude;
						$this->param['vx'] = $vx;
						$this->param['vy'] = $vy;
						$this->param['vz'] = $vz;
						$this->param['magnitude'] = $magnitude;
					} else {
						$this->param['error'] = 'Please fill all fields.';
						return $this->param;
					}
				}
			} elseif ($method === 'find') {
				if ($dimen === '2d') {
					if ($find === 'x') {
						if (is_numeric($fy)) {
							$fx = sqrt(1 - pow($fy, 2));
							$check = round(pow($fx, 2) + (pow($fy, 2)));
							if ($fy > 1) {
								$this->param['error'] = 'Unit vector components must be less than or equal to 1';
								return $this->param;
							}
							if ($check != 1) {
								$this->param['error'] = 'It is not possible to create unit vector';
								return $this->param;
							}
							$this->param['fx'] = $fx;
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					} elseif ($find === 'y') {
						if (is_numeric($fx)) {
							$fy = sqrt(1 - pow($fx, 2));
							$check = round(pow($fx, 2) + (pow($fy, 2)));
							if ($fx > 1) {
								$this->param['error'] = 'Unit vector components must be less than or equal to 1';
								return $this->param;
							}
							if ($check != 1) {
								$this->param['error'] = 'It is not possible to create unit vector';
								return $this->param;
							}
							$this->param['fy'] = $fy;
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					}
				} elseif ($dimen === '3d') {
					if ($find1 === 'x') {
						if (is_numeric($fy) && is_numeric($fz)) {
							$fx = sqrt(1 - (pow($fy, 2) + pow($fz, 2)));
							$check = round(pow($fx, 2) + pow($fy, 2) + (pow($fz, 2)));
							if ($fy > 1 || $fz > 1) {
								$this->param['error'] = 'Unit vector components must be less than or equal to 1';
								return $this->param;
							}
							if ($check != 1) {
								$this->param['error'] = 'It is not possible to create unit vector';
								return $this->param;
							}
							$this->param['fx'] = $fx;
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					} elseif ($find1 === 'y') {
						if (is_numeric($fx) && is_numeric($fz)) {
							$fy = sqrt(1 - (pow($fx, 2) + pow($fz, 2)));
							$check = round(pow($fx, 2) + pow($fy, 2) + (pow($fz, 2)));
							if ($fx > 1 || $fz > 1) {
								$this->param['error'] = 'Unit vector components must be less than or equal to 1';
								return $this->param;
							}
							if ($check != 1) {
								$this->param['error'] = 'It is not possible to create unit vector';
								return $this->param;
							}
							$this->param['fy'] = $fy;
						} else {
							$this->param['error'] = 'Please! Check Your Input';
							return $this->param;
						}
					} elseif ($find1 === 'z') {
						if (is_numeric($fx) && is_numeric($fy)) {
							$fz = sqrt(1 - (pow($fx, 2) + pow($fy, 2)));
							$check = round(pow($fx, 2) + pow($fy, 2) + (pow($fz, 2)));
							if ($fx > 1 || $fy > 1) {
								$this->param['error'] = 'Unit vector components must be less than or equal to 1';
								return $this->param;
							}
							if ($check != 1) {
								$this->param['error'] = 'It is not possible to create unit vector';
								return $this->param;
							}
							$this->param['fz'] = $fz;
						} else {
							$this->param['error'] = 'Please fill all fields.';
							return $this->param;
						}
					}
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			if ($dimen === '2d') {
				if ($method === 'normalize') {
					if ($x >= 0 && $y >= 0) {
						$deg = atan($y / $x);
					} elseif ($x >= 0 && $y < 0) {
						$deg = pi() * 2 + atan($y / $x);
					} elseif ($x < 0 && $y >= 0) {
						$deg = pi() + atan($y / $x);
					} elseif ($x < 0 && $y < 0) {
						$deg = pi() + atan($y / $x);
					}
				} elseif ($method === 'find') {
					if ($fx >= 0 && $fy >= 0) {
						$deg = atan($fy / $fx);
					} elseif ($fx >= 0 && $fy < 0) {
						$deg = pi() * 2 + atan($fy / $fx);
					} elseif ($fx < 0 && $fy >= 0) {
						$deg = pi() + atan($fy / $fx);
					} elseif ($fx < 0 && $fy < 0) {
						$deg = pi() + atan($fy / $fx);
					}
				}
				$this->param['deg'] = rad2deg($deg);
			}
			$this->param['RESULT'] = 1;
			$this->param['x'] = $request->x;
			$this->param['y'] = $request->y;
			$this->param['z'] = $request->z;
			$this->param['fx'] = $request->fx;
			$this->param['fy'] = $request->fy;
			$this->param['fz'] = $request->fz;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}
	//Moment of inertia
	function moment($request)
	{

		$selection = $request->selection;
		$b_width = $request->b_width;
		$height = $request->height;
		$dis_to_height = $request->dis_to_height;
		$rad = $request->radius;
		$tfw = $request->tfw;
		$tft = $request->tft;
		$bfw = $request->bfw;
		$bft = $request->bft;
		$wh = $request->wh;
		$wt = $request->wt;
		$r = $request->r;
		$h1 = $request->h1;
		$b1 = $request->b1;
		$lft = $request->lft;
		$lfh = $request->lfh;
		$rad2 = $request->radius2;
		$unit = $request->unit;

		$this->param['m2'] = "$unit<sup>2</sup>";
		$this->param['m4'] = "$unit<sup>4</sup>";;
		$this->param['m'] = "$unit";
		$this->param['m3'] = "$unit<sup>3</sup>";
		if (is_numeric($b_width) && is_numeric($height) && is_numeric($dis_to_height) && ($b_width > 0) && ($height > 0) && ($dis_to_height > 0)) {
			if ($selection == "1") {
				//Triangle
				$calculate_ix = (($b_width) * ($height * $height * $height) / (36));
				$calculate_iy = (($height) * ($b_width * $b_width * $b_width) - ($height * $dis_to_height * ($b_width * $b_width)) + ($b_width * $height * ($dis_to_height * $dis_to_height)) / (36));
				$calculate_area = ($b_width * $height) / 2;
				$elastic_section_modulus1 = ($b_width * $height * $height) / 24;
				$elastic_section_modulus2 = ($b_width * $b_width * $b_width) / 24;
				$calculate_cy = ($height) / 3;
				$calculate_cx = ($height) / 2;
				$this->param['answer1'] = $calculate_ix;
				$this->param['answer2'] = $calculate_iy;
				$this->param['answer3'] = $calculate_cy;
				$this->param['answer4'] = $calculate_cx;
				$this->param['answer5'] = $calculate_area;
				$this->param['answer6'] = $elastic_section_modulus1;
				$this->param['answer7'] = $elastic_section_modulus1;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($b_width) && is_numeric($height)  && ($b_width > 0) && ($height > 0)) {
			if ($selection == "2") {
				//Rectangle
				$calculate_ix = ($b_width * $height * $height * $height) / 12;
				$calculate_iy = ($height * $b_width * $b_width * $b_width) / 12;
				$calculate_cy = ($height) / 2;
				$calculate_cx = ($b_width) / 2;
				$calculate_area = ($b_width * $height);
				$elastic_section_modulus1 = $calculate_ix / $calculate_cy;
				$elastic_section_modulus2 = $calculate_iy / $calculate_cx;
				$jc = (1 / 12 * ($b_width * $height)) * ($b_width * $b_width) + ($height * $height);
				$this->param['answer1'] = $calculate_ix;
				$this->param['answer2'] = $calculate_iy;
				$this->param['answer3'] = $calculate_cy;
				$this->param['answer4'] = $calculate_cx;
				$this->param['answer5'] = $calculate_area;
				$this->param['answer6'] = $elastic_section_modulus1;
				$this->param['answer7'] = $elastic_section_modulus2;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($rad) && is_numeric($rad2) && ($rad > 0) && ($rad2 > 0)) {
			if ($selection == "3") {
				if ($rad > $rad2) {
					$calculate_ix = ((3.14 / 64) * ($rad * $rad * $rad * $rad)) - ((3.14 / 64) * ($rad2 * $rad2 * $rad2 * $rad2));
					$calculate_iy = ((3.14 / 64) * ($rad * $rad * $rad * $rad)) - ((3.14 / 64) * ($rad2 * $rad2 * $rad2 * $rad2));
					$d1 = $rad / 2;
					$d2 = $rad2 / 2;
					$calculate_area = (($d1 * $d1) - ($d2 * $d2)) * 3.14;
					$calculate_cy = ($rad / 2);
					$calculate_cx = ($rad / 2);
					$elastic_section_modulus1 = ($calculate_ix / $calculate_cy);
					$elastic_section_modulus2 = ($calculate_iy / $calculate_cx);
					$this->param['answer1'] = $calculate_ix;
					$this->param['answer2'] = $calculate_iy;
					$this->param['answer3'] = $calculate_cy;
					$this->param['answer4'] = $calculate_cx;
					$this->param['answer5'] = $calculate_area;
					$this->param['answer6'] = $elastic_section_modulus1;
					$this->param['answer7'] = $elastic_section_modulus2;
					$this->param['RESULT'] = 1;
					
					return $this->param;
				} else {
					$this->param['error'] = 'D must be larger than d';
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($rad)) {
			if ($selection == "4") {
				//Circle
				$calculate_ix = (3.14 / 64) * $rad * $rad * $rad * $rad;
				$calculate_iy = (3.14 / 64) * $rad * $rad * $rad * $rad;
				$calculate_area = (3.14 * $rad * $rad) / 4;
				$calculate_cy = ($rad) / 2;
				$calculate_cx = ($rad) / 2;
				$elastic_section_modulus1 = ($calculate_ix / $calculate_cy);
				$elastic_section_modulus2 = ($calculate_iy / $calculate_cx);
				$this->param['answer1'] = $calculate_ix;
				$this->param['answer2'] = $calculate_iy;
				$this->param['answer3'] = $calculate_cy;
				$this->param['answer4'] = $calculate_cx;
				$this->param['answer5'] = $calculate_area;
				$this->param['answer6'] = $elastic_section_modulus1;
				$this->param['answer7'] = $elastic_section_modulus2;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($b_width) && is_numeric($height) && is_numeric($h1) && is_numeric($b1) && ($b_width) > 0 && ($height) > 0 && ($h1) > 0 && $b1 > 0) {
			if ($selection == "7") {
				if ($b_width > $h1 && $height > $b1) {
					//Hollow Rectangular
					$calculate_area = ($b_width * $height) - ($h1 * $b1);
					$calculate_ix = (($b_width * $height * $height * $height) / 12) - (($b1 * $h1 * $h1 * $h1) / 12);
					$calculate_iy = (($b_width * $b_width * $b_width * $height) / 12) - (($b1 * $b1 * $b1 * $h1) / 12);
					$calculate_cy = ($b_width) / 2;
					$calculate_cx = ($height) / 2;
					$section_modulus1 = ($calculate_ix / $calculate_cx);
					$section_modulus2 = ($calculate_iy / $calculate_cy);
					$this->param['answer1'] = $calculate_ix;
					$this->param['answer2'] = $calculate_iy;
					$this->param['answer3'] = $calculate_cy;
					$this->param['answer4'] = $calculate_cx;
					$this->param['answer5'] = $calculate_area;
					$this->param['answer6'] = $section_modulus1;
					$this->param['answer7'] = $section_modulus2;
					$this->param['RESULT'] = 1;
					
					return $this->param;
				} else {
					$this->param['error'] = 'h1 must be larger than h and b must be larger than b1';
					return $this->param;
				}
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($bfw) && is_numeric($bft) && is_numeric($tft) && is_numeric($tfw) && is_numeric($wt) && is_numeric($wh) && $bfw > 0 && $bft > 0 && $tft > 0 && $tfw > 0 && $wh > 0 && $wt > 0) {
			if ($selection == "8") {
				//I-Beam
				$a1 = ($bfw * $bft);
				$a2 = ($wt * $wh);
				$a3 = ($tfw * $tft);
				$total_area = $a1 + $a2 + $a3;
				$x1 = $x2 = $x3 = $tfw;
				$y1 = ($bft / 2);
				$y2 = $bft + ($wh / 2);
				$y3 = $bft + $wh + ($tft / 2);
				$y_dash = (($a1 * $y1) + ($a2 * $y2) + ($a3 * $y3)) / ($a1 + $a2 + $a3);
				$x_dash = $tfw;
				$hy1 = $y_dash - $y1;
				$xx1 = ((($bfw * $bft * $bft * $bft) / 12)) + (($a1) * ($hy1 * $hy1));
				$hy2 = $y_dash - $y2;
				$xx2 = ((($wt * $wh * $wh * $wh) / 12)) + (($a2) * ($hy2 * $hy2));
				$hy3 = $y_dash - $y3;
				$hy4 = $hy1 + $hy2 + $hy3;
				$xx3 = ((($tfw * $tft * $tft * $tft) / 12)) + (($a3) * ($hy3 * $hy3));
				$total_x = $xx1 + $xx2 + $xx3;
				$hx1 = $x_dash - $x1;
				$hx2 = $x_dash - $x2;
				$hx3 = $x_dash - $x3;
				$ans1 = ($bfw * $bfw * $bfw * $bft) / 12;
				$ans2 = ($wt * $wt * $wt * $wh) / 12;
				$ans3 = ($tfw * $tfw * $tfw * $tft) / 12;
				$ans_y = $ans1 + $ans2 + $ans3;
				$section_modulus1 = ($total_x / $y_dash);
				$section_modulus2 = ($ans_y / $x_dash);
				$this->param['answer1'] = $total_x;
				$this->param['answer2'] = $ans_y;
				$this->param['answer3'] = $y_dash;
				$this->param['answer4'] = $x_dash;
				$this->param['answer5'] = $total_area;
				$this->param['answer6'] = $section_modulus1;
				$this->param['answer7'] = $section_modulus2;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($bfw) && is_numeric($bft) && is_numeric($lfh) && is_numeric($lft) && $bfw > 0 && $bft > 0 && $lfh > 0 && $lft > 0) {
			if ($selection == "9") {
				//L-Beam
				$a1 = ($bfw * $bft);
				$a2 = ($lfh * $lft);
				$total_area = $a1 + $a2;
				$x1 = ($bfw / 2);
				$x2 = ($bft / 2);
				$y1 = ($lft / 2);
				$y2 = ($lft + ($lfh / 2));
				$x_dash = (($a1 * $x1) + ($a2 * $x2)) / ($a1 + $a2);
				$y_dash = (($a1 * $y1) + ($a2 * $y2)) / ($a1 + $a2);
				$hy1 = $y_dash - $y1;
				$xx1 = (($bfw * $bft * $bft * $bft) / 12) + ($a1) * ($hy1 * $hy1);
				$hy2 = $y_dash - $y2;
				$xx2 = (($lft * $lfh * $lfh * $lfh) / 12) + ($a2) * ($hy2 * $hy2);
				$xxx = $xx1 + $xx2;
				$hx1 = $x_dash - $x1;
				$yy1 = (($bft * $bfw * $bfw * $bfw) / 12) + ($a1) * ($hx1 * $hx1);
				$hx2 = $x_dash - $x2;
				$yy2 = (($lfh * $lft * $lft * $lft) / 12) + (($a2) * ($hx2 * $hx2));
				$yyy = $yy1 + $yy2;
				$section_modulus1 = $xxx / $y_dash;
				$section_modulus2 = $yyy / $x_dash;
				$this->param['answer1'] = $xxx;
				$this->param['answer2'] = $yyy;
				$this->param['answer3'] = $y_dash;
				$this->param['answer4'] = $x_dash;
				$this->param['answer5'] = $total_area;
				$this->param['answer6'] = $section_modulus1;
				$this->param['answer7'] = $section_modulus2;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($tfw) && is_numeric($tft) && is_numeric($wh) && is_numeric($wt) && $tfw > 0 && $tft > 0 && $wh > 0 && $wh > 0) {
			if ($selection == "10") {
				//T-Beam
				$a1 = $tft * $tfw;
				$a2 = $wh * $wt;
				$area = $a1 + $a2;
				$y1 = $tfw + ($tft / 2);
				$y2 = ($wh / 2);
				$x_bar = ($wh / 2);
				$x1 = ($tfw / 2);
				$x2 = ($tfw / 2);
				$x_bar = (($a1 * $x1) + ($a2 * $x2)) / ($a1 + $a2);
				$y_bar = (($a1 * $y1) + ($a2 * $y2)) / ($a1 + $a2);
				$xx1 = (($tfw * $tft * $tft * $tft) / 12) + $a1 * (($y_bar - $y1) * ($y_bar - $y1));
				$xx1;
				$h2 = $y_bar - $y2;
				$xx2 = (($wh * $wh * $wh * $wt) / 12) + $a2 * ($h2 * $h2);
				$xxx = $xx1 + $xx2;
				$hx1 = $x_bar - $x1;
				$yy1 = (($wh * $wh * $wh * $wt) / 12) + $a1 * ($hx1 - $hx1);
				$hx2 = $x_bar - $x2;
				$yy2 = (($wh * $wt * $wt * $wt) / 12) + $a2 * ($hx2 - $hx2);
				$yyy = $yy1 + $yy2;
				$this->param['answer1'] = $xxx;
				$this->param['answer2'] = $yyy;
				$this->param['answer3'] = $y_bar;
				$this->param['answer4'] = $x_bar;
				$this->param['answer5'] = $area;
				$this->param['answer6'] = $xxx / $y_bar;
				$this->param['answer7'] = $yyy / $x_bar;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		if (is_numeric($bfw) && is_numeric($bft) && is_numeric($tfw) && is_numeric($tft) && is_numeric($wt) && is_numeric($h1) && $bfw > 0 && $bft > 0 && $tfw > 0 && $tft > 0 && is_numeric($tfw) > 0 && is_numeric($wt) > 0 && is_numeric($h1) > 0) {
			if ($selection == "11") {
				//Channel
				$a1 = ($bfw * $bft);
				$a2 = ($wt * $h1);
				$a3 = ($tfw * $tft);
				$total_area = $a1 + $a2 + $a3;
				$x1 = ($bfw / 2);
				$x2 = ($wt / 2);
				$x3 = ($tfw) / 2;
				$x_dash = (($a1 * $x1) + ($a2 * $x2) + ($a3 * $x3)) / (($a1 + $a2 + $a3));
				$y1 = ($bft / 2);
				$y2 = ($bft + ($h1 / 2));
				$y3 = ($bft + $h1 + ($wt / 2));
				$y_dash = (($a1 * $y1) + ($a2 * $y2) + ($a3 * $y3)) / (($a1 + $a2 + $a3));
				$hy1 = $y_dash - $y1;
				$xx1 = (($bfw * $bft * $bft * $bft) / 12) + ($a1 * ($hy1 * $hy1));
				$hy2 = $y_dash - $y2;
				$xx2 = (($wt * $h1 * $h1 * $h1) / 12) + ($a2 * ($hy2 * $hy2));
				$hy3 = $y_dash - $y3;
				$xx3 = (($tfw * $tft * $tft * $tft) / 12) + ($a3 * ($hy3 * $hy3));
				$calculate_ix = $xx1 + $xx2 + $xx3;
				$hx1 = $x_dash - $x1;
				$yy1 = (($bft * $bfw * $bfw * $bfw) / 12) + ($a1 * ($hx1 * $hx1));
				$hx2 = $x_dash - $x2;
				$yy2 = (($wt * $wt * $wt * $h1) / 12) + ($a2 * ($hx2 * $hx2));
				$hx3 = $x_dash - $x3;
				$yy3 = (($tfw * $tfw * $tfw * $tft) / 12) + ($a3 * ($hx3 * $hx3));
				$yyy = $yy1 + $yy2 + $yy3;
				$this->param['answer1'] = $calculate_ix;
				$this->param['answer2'] = $yyy;
				$this->param['answer3'] = $y_dash;
				$this->param['answer4'] = $x_dash;
				$this->param['answer5'] = $total_area;
				$this->param['answer6'] = $calculate_ix / $y_dash;
				$this->param['answer7'] = $yyy / $x_dash;
				$this->param['RESULT'] = 1;
				
				return $this->param;
			}
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/************************
		Parallel Resistor Calculator
	 ************************/
	function parallel($request)
	{
		// dd($request->all());
		$mode = $request->mode;
		$res_val = $request->res_val;
		$unit = $request->unit;
		$missing = $request->missing;
		$mis_unit = $request->mis_unit;

		$y = 0;

		if ($mis_unit = "nm") {
			$mis_unit = 0.001;
		} else if ($mis_unit = "μm") {
			$mis_unit = 1;
		} else if ($mis_unit = "mm") {
			$mis_unit = 1000;
		} else if ($mis_unit = "cm") {
			$mis_unit = 1000000;
		}

		while ($y < count($res_val)) {
			if (is_numeric($res_val[$y])) {
				if ($res_val[$y] != "0") {
					$array[] = 1 / ($res_val[$y] * $unit[$y]);
				} else {
					$this->param['error'] = 'Resistor value greater than zero.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$y++;
		}
		$lcm = array_sum($array);
		if ($mode == "1") {
			$main_ans = 1 / $lcm;
		} elseif ($mode == "2") {
			$missing = $missing * $mis_unit;
			if (is_numeric($missing)) {
				if ($missing >= "0") {
					$main_ans = 1 / (1 / $missing - $lcm);
				} else {
					$this->param['error'] = 'Desired Total Resistance cannot be negative..';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		if ($main_ans > 1000) {
			$answer = $main_ans / 1000;
			$unit = "kΩ";
		} else {
			$answer = $main_ans;
			$unit = "Ω";
		}
		$this->param['mode'] = $mode;
		$this->param['answer'] = $answer;
		$this->param['unit'] = $unit;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		Electricity Cost calculator
	 ************************/
	function electricity($request)
	{

		$type = $request->unit_type;
		$f_first = $request->f_first;
		$f_second = $request->f_second;
		$f_third = $request->f_third;
		$first = $request->first;
		$units1 = $request->units1;
		$second = $request->second;
		$third = $request->third;
		$units3 = $request->units3;

		function watt($a, $b)
		{
			if ($a == "mW") {
				$bijli = $b / 1000;
			} elseif ($a == "W") {
				$bijli = $b * 1;
			} elseif ($a == "kW") {
				$bijli = $b * 1000;
			} elseif ($a == "MW") {
				$bijli = $b * 1000000;
			} elseif ($a == "GW") {
				$bijli = $b * 1000000000;
			} elseif ($a == "BTU") {
				$bijli = $b * 0.293071;
			} elseif ($a == "hp(l)") {
				$bijli = $b * 745.7;
			}
			return $bijli;
		}

		function mont($a, $b)
		{
			if ($a == "days") {
				$mah = $b * 30.4375;
			} elseif ($a == "wks") {
				$mah = $b * 4.34821;
			} elseif ($a == "mons") {
				$mah = $b * 1;
			} elseif ($a == "yrs") {
				$mah = $b * 0.0833333;
			}
			return $mah;
		}
		$first = watt($units1, $first);
		$third = mont($units3, $third);
		if ($type == "simple") {
			if (is_numeric($first) && is_numeric($second) && is_numeric($third)) {
				$multiply = $first * $third;
				$answer = $multiply / 1000;
				$cost = $answer * $second;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($type == "advance") {
			if (is_numeric($f_first) && is_numeric($f_second) && is_numeric($f_third)) {
				$mul1 = $f_second * 30;
				$mul2 = $mul1 * $f_first;
				$answer = $mul2 / 1000;
				$cost = $answer * $f_third;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['answer'] = $answer;
		$this->param['cost'] = $cost;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/************************
		Escape Velocity Calculator
	 ************************/
	function escape($request)
	{
		$planet = $request->planet;
		$mass = $request->mass;
		$mass_unit = $request->mass_unit;
		$radius = $request->radius;
		$radius_unit = $request->radius_unit;
		$orbit = $request->orbit;
		$gravity = $request->gravity;
		$galaxy_mass = $request->galaxy_mass;
		$find = $request->find;
		$escape_velocity = $request->escape_velocity;
		$escape_unit = $request->escape_unit;

		function planet_unit($unit, $value)
		{
			if ($unit == "kg") {
				$ret1 = $value * 1;
			} else if ($unit == "t") {
				$ret1 = $value * 1000;
			} else if ($unit == "lb") {
				$ret1 = $value * 0.453592;
			} else if ($unit == "oz") {
				$ret1 = $value * 0.0283495;
			}
			return $ret1;
		}
		function escape_unit($unit2, $value2)
		{
			if ($unit2 == "m/s") {
				$ret2 = $value2 * 1;
			} else if ($unit2 == "km/h") {
				$ret2 = $value2 * 0.277778;
			} else if ($unit2 == "mph") {
				$ret2 = $value2 * 0.44704;
			} else if ($unit2 == "km/s") {
				$ret2 = $value2 * 1000;
			}
			return $ret2;
		}
		if ($find == "1") { //Find Escape Velocity
			if (is_numeric($mass) && is_numeric($radius) && is_numeric($orbit) && is_numeric($gravity) && is_numeric($galaxy_mass)) {
				$method = 1;
				$mass_value = planet_unit($mass_unit, $mass);
				$first = (2 * $gravity * $mass_value / $radius);
				$escape_velocity = (sqrt($first / 1000)) / 1000;
				$second = ($gravity * $mass_value / $radius);
				$first_cosmic_velocity = (sqrt($second / 1000)) / 1000;
				$third = $orbit * 1.496e+11;
				$orbital_speed = sqrt($gravity * $galaxy_mass / $third);
				$orbit_period = sqrt($orbit * $orbit * $orbit);
				$this->param['escape_velocity'] = $escape_velocity;
				$this->param['first_cosmic_velocity'] = $first_cosmic_velocity;
				$this->param['orbital_speed'] = $orbital_speed;
				$this->param['orbital_period'] = $orbit_period;
				$this->param['method'] = $method;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "2") { //Find Mass
			if (is_numeric($escape_velocity) && is_numeric($radius) && is_numeric($orbit) && is_numeric($gravity) && is_numeric($galaxy_mass)) {
				$method = 2;
				$escape_value = escape_unit($escape_unit, $escape_velocity);
				$find_mass = ($escape_value * $escape_value * $radius) / (2 * $gravity);
				$first_cosmic_velocity = (sqrt(2) / $escape_value);
				$third = $orbit * 1.496e+11;
				$orbital_speed = sqrt($gravity * $galaxy_mass / $third);
				$orbit_period = sqrt($orbit * $orbit * $orbit);
				$this->param['method'] = $method;
				$this->param['escape_velocity'] = $escape_velocity;
				$this->param['first_cosmic_velocity'] = $first_cosmic_velocity;
				$this->param['orbital_speed'] = $orbital_speed;
				$this->param['mass_value'] = $find_mass;
				$this->param['orbital_period'] = $orbit_period;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($find == "3") { //Find Radius
			if (is_numeric($escape_velocity) && is_numeric($mass) && is_numeric($orbit) && is_numeric($gravity) && is_numeric($galaxy_mass)) {
				$method = 3;
				$escape_value = escape_unit($escape_unit, $escape_velocity);
				$mass_value = planet_unit($mass_unit, $mass);
				$find_radius = (2 * $gravity * $mass_value) / ($escape_value * $escape_value);
				$radius_value = $find_radius / 1000;
				$first_cosmic_velocity = sqrt(2) / $escape_value;
				$third = $orbit * 1.496e+11;
				$orbital_speed = sqrt($gravity * $galaxy_mass / $third);
				$orbit_period = sqrt($orbit * $orbit * $orbit);
				$this->param['method'] = $method;
				$this->param['escape_velocity'] = $escape_velocity;
				$this->param['mass_value'] = $radius_value;
				$this->param['first_cosmic_velocity'] = $first_cosmic_velocity;
				$this->param['orbital_speed'] = $orbital_speed;
				$this->param['orbital_period'] = $orbit_period;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}


	/*******************
       Transformer Calculator
	 *******************/
	function transformer($request)
	{
		$phase_unit = $request->phase_unit;
		$transformer_rating = $request->transformer_rating;
		$transformer_rating_unit = $request->transformer_rating_unit;
		$primary_transformer_voltage = $request->primary_transformer_voltage;
		$primary_transformer_unit = $request->primary_transformer_unit;
		$secondary_transformer_voltage = $request->secondary_transformer_voltage;
		$secondary_transformer_unit = $request->secondary_transformer_unit;
		$primary_current = $request->primary_current;
		$secondary_current = $request->secondary_current;
		$primary_winding = $request->primary_winding;
		$secondary_winding = $request->secondary_winding;
		$calculation_unit = $request->calculation_unit;
		$kva = $request->kva;
		$volts = $request->volts;
		$amperes = $request->amperes;
		$impedance = $request->impedance;
		$eddy_current = $request->eddy_current;
		$thickness = $request->thickness;
		$flux_density = $request->flux_density;
		$frequency = $request->frequency;
		$hysteresis_constant = $request->hysteresis_constant;
		$number_of_turns = $request->number_of_turns;

		function rating_unit($a, $b)
		{
			if ($a = "VA") {
				$convert1 = $b * 1000;
			} else if ($a = "kVA") {
				$convert1 = $b * 1;
			} else if ($a = "MVA") {
				$convert1 = $b * 1000;
			}
			return $convert1;
		}

		function transformer_unit($c, $d)
		{
			if ($c = "V") {
				$convert2 = $d * 1;
			} else if ($c = "kV") {
				$convert2 = $d * 1000;
			} else if ($c = "MV") {
				$convert2 = $d * 1000000;
			}
			return $convert2;
		}
		if ($calculation_unit == "1") { //Find Secondary Voltage
			if (is_numeric($primary_winding) && is_numeric($secondary_winding) && is_numeric($primary_transformer_voltage)) {
				$primary_voltage_value = transformer_unit($primary_transformer_unit, $primary_transformer_voltage);
				$calculate_secondary_voltage = $primary_transformer_voltage * ($secondary_winding / $primary_winding);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['secondary_voltage'] = $calculate_secondary_voltage;
		} else if ($calculation_unit == "2") { //Find Primary Voltage
			if (is_numeric($primary_winding) && is_numeric($secondary_winding) && is_numeric($secondary_transformer_voltage)) {
				$secondary_voltage_value = transformer_unit($secondary_transformer_unit, $secondary_transformer_voltage);
				$calculate_primary_voltage = $secondary_voltage_value * ($primary_winding / $secondary_winding);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['primary_voltage'] = $calculate_primary_voltage;
		} else if ($calculation_unit == "3") { //Find Secondary Winding
			if (is_numeric($primary_winding) && is_numeric($secondary_transformer_voltage) && is_numeric($primary_transformer_voltage)) {
				$secondary_voltage_value = transformer_unit($secondary_transformer_unit, $secondary_transformer_voltage);
				$primary_voltage_value = transformer_unit($primary_transformer_unit, $primary_transformer_voltage);
				$calculate_secondary_winding = $secondary_voltage_value * ($primary_winding / $primary_voltage_value);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['secondary_winding'] = $calculate_secondary_winding;
		} else if ($calculation_unit == "4") { //Find Primary Winding
			if (is_numeric($secondary_winding) && is_numeric($secondary_transformer_voltage) && is_numeric($primary_transformer_voltage)) {
				$secondary_voltage_value = transformer_unit($secondary_transformer_unit, $secondary_transformer_voltage);
				$primary_voltage_value = transformer_unit($primary_transformer_unit, $primary_transformer_voltage);
				$calculate_primary_winding = $primary_voltage_value * ($primary_winding / $secondary_voltage_value);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['primary_winding'] = $calculate_primary_winding;
		} else if ($calculation_unit == "5") { //Secondary Current
			if (is_numeric($primary_current) && is_numeric($primary_winding) && is_numeric($secondary_winding)) {
				$calculate_secondary_current = $primary_current * ($primary_winding / $secondary_winding);
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['secondary_current'] = $calculate_secondary_current;
		} else if ($calculation_unit == "6") { //Primary Current
			if (is_numeric($secondary_current) && is_numeric($primary_winding) && is_numeric($secondary_winding)) {
				$calculate_primary_current = ($secondary_current * $secondary_winding) / $primary_winding;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['primary_current'] = $calculate_primary_current;
		} else if ($calculation_unit == "7") { //Secondary Winding 
			if (is_numeric($secondary_current) && is_numeric($primary_current) && is_numeric($primary_winding)) {
				$calculate_secondary_winding = ($primary_current * $primary_winding) / $secondary_current;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['secondary_winding'] = $calculate_secondary_winding;
		} else if ($calculation_unit == "8") { //Primary Winding
			echo "Eight Condition";
			if (is_numeric($secondary_current) && is_numeric($primary_current) && is_numeric($secondary_winding)) {
				$calculate_primary_winding = ($secondary_current * $secondary_winding) / $primary_current;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['primary_winding'] = $calculate_primary_winding;
		} else if ($calculation_unit == "9") {
			if (is_numeric($transformer_rating) && is_numeric($primary_transformer_voltage) && is_numeric($secondary_transformer_voltage) && is_numeric($impedance)) {
				$transformer_rating_value = rating_unit($transformer_rating_unit, $transformer_rating);
				$primary_transformer_voltage_value = transformer_unit($primary_transformer_unit, $primary_transformer_voltage);
				$secondary_transformer_voltage_value = transformer_unit($secondary_transformer_unit, $secondary_transformer_voltage);
				if ($phase_unit == "1") {
					$primary_full_load_current = ($transformer_rating_value * 1000) / $primary_transformer_voltage_value;
					$secondary_full_load_current = ($transformer_rating_value * 1000) / $secondary_transformer_voltage_value;
					$turn_ratio = $primary_transformer_voltage_value / $secondary_transformer_voltage_value;
					$type = "Single Phase Step Up Transformer";
					$this->param['type'] = $type;
					if ($impedance == 0) {
						$impdedance_value = "INF";
					} else {
						$impdedance_value = ($secondary_full_load_current / ($impedance * 10));
					}
					$this->param['impedance_value'] = $impdedance_value;
				} else if ($phase_unit == "3") {
					$primary_full_load_current = ($transformer_rating_value * 1000) / ($primary_transformer_voltage_value * 1.732);
					$secondary_full_load_current = ($transformer_rating_value * 1000) / ($secondary_transformer_voltage_value * 1.732);
					$turn_ratio = $primary_transformer_voltage_value / $secondary_transformer_voltage_value;
					$type = "Three Phase Step Up Transformer";
					$this->param['type'] = $type;
					if ($impedance == 0) {
						$impdedance_value = "INF";
					} else {
						$impdedance_value = ($secondary_full_load_current / ($impedance * 10));
					}
					$this->param['impedance_value'] = $impdedance_value;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['primary_full_load_current'] = $primary_full_load_current;
			$this->param['secondary_full_load_current'] = $secondary_full_load_current;
			$this->param['turn_ratio'] = $turn_ratio;
		} else if ($calculation_unit == "10") { //Calculate Amperes
			if (is_numeric($volts) && is_numeric($kva)) {
				if ($phase_unit == "1") {
					$calculate_amps = ($kva / $volts) * 1000;
				} else if ($phase_unit == "3") {
					$calculate_amps = $kva / $volts / 1.732 * 1000;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['calculate_amps'] = $calculate_amps;
		} else if ($calculation_unit == "11") { //Calculate KVA
			if (is_numeric($volts) && is_numeric($amperes)) {
				if ($phase_unit == "1") {
					$calculate_kva = ($volts * $amperes) / 1000;
				} else if ($phase_unit == "3") {
					$calculate_kva = ($volts * $amperes * 1.732 / 1000);
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['calculate_kva'] = $calculate_kva;
		} else if ($calculation_unit == "12") { //Calculate volts
			if (is_numeric($kva) && is_numeric($amperes)) {
				if ($phase_unit == "1") {
					$calculate_volts = $kva / ($amperes / 1000);
				} else if ($phase_unit == "3") {
					$calculate_volts = $kva / ($amperes * 1.732 / 1000);
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['calculate_volts'] = $calculate_volts;
		} else if ($calculation_unit == "13") {
			if (is_numeric($primary_current) && is_numeric($secondary_current) && is_numeric($primary_winding) && is_numeric($secondary_winding) && is_numeric($eddy_current) && is_numeric($thickness) && is_numeric($flux_density) && is_numeric($frequency) && is_numeric($hysteresis_constant)) {
				$total_copper = (($primary_current * $primary_current) * $primary_winding) + (($secondary_current * $secondary_current) * $secondary_winding);
				$eddy_current_loss = ($eddy_current * ($thickness * $thickness)) * (($flux_density * $flux_density) * ($frequency * $frequency));
				$hysteresis_loss = ($hysteresis_constant * $frequency * (pow($flux_density, 1.6)));
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['total_copper'] = $total_copper;
			$this->param['eddy_current_loss'] = $eddy_current_loss;
			$this->param['hysteresis_loss'] = $hysteresis_loss;
		} else if ($calculation_unit == "14") {
			if (is_numeric($frequency) && is_numeric($number_of_turns) && is_numeric($flux_density)) {
				$e1 = 4.44;
				$rms_value = (4.44) * $frequency * $number_of_turns * $flux_density;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
			$this->param['rms'] = $rms_value;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}


	/*******************
       Voltage Drop Calculator
	 *******************/
	function voltage($request){
			$phase_unit=$request->phase_unit;
			$wire_material_unit=$request->wire_material_unit;
			$wire_size_unit=$request->wire_size_unit;
			$wire_length=$request->wire_length;
			$wire_length_unit=$request->wire_length_unit;
			$load_current=$request->load_current;
			$conductors=$request->conductors;
			$voltage=$request->voltage;
			$calculate_unit=$request->calculate_unit;
			$power_voltage=$request->power_voltage;
			$wire_resistance=$request->wire_resistance;
			$wire_resistance_unit=$request->wire_resistance_unit;
			$wire_diameter_size_unit=$request->wire_diameter_size_unit;
			$wire_diameter_size=$request->wire_diameter_size;
			$cable_length=$request->cable_length;
			$cable_length_unit=$request->cable_length_unit;
			$load_current_unit=$request->load_current_unit;
			$resistivity=$request->resistivity;
			$wire_material_unit_two=$request->wire_material_unit_two;
			$gauge=$request->gauge;
			$find_unit=$request->find_unit;
			$max_voltage_drop=$request->max_voltage_drop;
			$voltage_unit=$request->voltage_unit;
			$raceway=$request->raceway;
			$insulation=$request->insulation;
			
		$amps60 =array("15","20","30","40","55","70","85","95","110","125","145","165","195","215","240","260", "280","320","355","385","400", "410","435","455","495","520","545","560");
		$amps75 =array("20","25","35","50","65","85","100", "115", "130", "150", "175", "200", "230", "255", "285", "310", "335", "380", "420", "460", "475", "490", "520", "545", "590", "625", "650", "665");
		$amps90 = array("25","30","40","55","75","95","115", "130", "145", "170", "195", "225", "260", "290", "320", "350", "380", "430", "475", "520", "535", "555", "585", "615", "665", "705", "735","750");
		$amps60al = array("0", "20", "25", "30", "40", "55", "65", "75", "85", "100", "115", "130", "150", "170", "190", "210", "225", "260", "285", "310", "320", "330", "355", "375", "405", "435", "455", "470");
		$amps75al = array("0", "20", "30", "40", "50", "65", "75", "90", "100", "120", "135", "155", "180", "205", "230", "250", "270", "310", "340", "375", "385", "395", "425", "445", "485", "520", "545","560");
		$amps90al = array("0","25","35","45","60","75","85", "100", "115", "135", "150", "175", "205", "230", "255", "280", "305", "350", "385", "420", "435", "450", "480", "500", "545", "585", "615","630");
		$fa60 = array("25", "30", "40", "60", "80", "105", "120", "140", "165", "195", "225", "260", "300", "340", "375", "420", "455", "515", "575", "630", "655", "680", "730", "780", "890", "980","1070","1155");
		$fa75 = array("30", "35", "50", "70", "95", "125", "145", "170", "195", "230", "265", "310", "360", "405", "445", "505", "545", "620", "690", "755", "785", "815", "870", "935", "1065", "1175", "1280", "1385");
		$fa90 = array("35","40","55","80","105", "140", "165", "190", "220", "260", "300", "350", "405", "455", "505", "570", "615", "700", "780", "855", "885", "920", "985","1055","1200","1325","1445","1560");
		$fa60al = array("0", "25", "35", "45", "60", "80", "95", "110", "130", "150", "175", "200", "235", "265", "290", "330", "355", "405", "455", "500", "515", "535", "580", "625", "710", "795", "875", "960");
		$fa75al = array("0","30","40","55","75", "100", "115", "135", "155", "180", "210", "240", "280", "315", "350", "395", "425", "485", "540", "595", "620", "645","700","750","855","950","1050","1150");
		$fa90al = array("0","35","40","60","80","110","130","150","175","205","235","275","315","355","395","445", "480","545","615","675","700","725","785","845","960","1075","1185","1335");
		$kcmil = array("4110","6530","10380","16510","26240","41740","52620","66360","83690","105600","133100", "167800", "211600", "250000", "300000", "350000", "400000", "500000", "600000", "700000", "750000", "800000","900000", "1000000", "1250000", "1500000", "1750000", "2000000");
		$wires = array("14 AWG","12 AWG", "10 AWG", "8 AWG", "6 AWG", "4 AWG", "3 AWG", "2 AWG", "1 AWG", "1/0 AWG", "2/0 AWG", "3/0 AWG", "4/0 AWG",
				"250 kcmil", "300 kcmil", "350 kcmil", "400 kcmil", "500 kcmil", "600 kcmil", "700 kcmil", "750 kcmil", "800 kcmil", "900 kcmil", 
				"1000 kcmil", "1250 kcmil", "1500 kcmil", "1750 kcmil", "2000 kcmil");
		$corr60 = array("1.08","1","0.91","0.82","0.71","0.58","0.41","0","0","0");
		$corr75 = array("1.05","1","0.94","0.88","0.82","0.75","0.67","0.58","0.33","0");
		$corr90 = array("1.04","1","0.96","0.91","0.87","0.82","0.76","0.71","0.58","0.41");
		$numcon = array("1","0.80","0.70","0.50","0.45","0.40","0.35");
		$ans60 = 0;
		$ans75 = 0;
		$ans90 = 0;
		$sizevd = 0;
		$sizevs = 0;
		function convert_voltage($c,$d){
			if($c=="volts"){
				$cc=$d*1;
			}else if($c=="kilovolts"){
				$cc=$d*0.001;
			}
			return $cc;
		}
		function convert_impedance($c,$d){
			if($c=="km"){//Ω/km
				$convert8=3280.839895;
			}else if($c=="m"){//Ω/m
				$convert8=$d*3.28084;
			}else if($c=="tft"){//Ω/1000ft
				$convert8=1000;
			}else if($c=="hft"){//Ω/ft
				$convert8=$d*0.001;
			}else if($c=="mqm"){//mΩ/m
				$convert8=$d*3280839.895;
			}else if($c=="mqm"){//mΩ/ft
				$convert8=$d*1000000;
			}
			return $convert8;
		}
		function calculates($a,$b){
			if($a=="in"){
				$convert1=$b*0.0833333;
			}elseif ($a=="ft") {
				$convert1=$b*1;
			}elseif ($a=="yd") {
				$convert1=$b*3;
			}elseif ($a=="mm") {
				$convert1=$b*0.00328084;
			}elseif ($a=="cm") {
				$convert1=$b*0.0328084;
			}elseif ($a=="m") {
				$convert1=$b*3.28084;	
			}
			return $convert1;
		}
		function convert_current($c,$d,$phase_current,$voltage){
			if($phase_current=="1"){//DC
				if($c=="am"){
				$converting=$d*1;
				}else if($c=="mi"){
					$converting=$d*0.001;
				}else if($c=="wa"){
					$converting=($d/$voltage);
				}else if($c=="kva"){
					$converting=($d*1000)/$voltage;
				}else if($c=="kW"){
					$converting=($d*1000)/$voltage;
				}else if($c=="hp"){
					$converting=(746)/($voltage*(95*100));
				}	
			}else if($phase_current=="2"){//AC Single Phase
				if($c=="am"){
				$converting=$d*1;
				}else if($c=="mi"){
					$converting=$d*0.001;
				}else if($c=="wa"){
					$converting=($d/$voltage);
				}else if($c=="kva"){
					$converting=($d*1000)/$voltage;
				}
				else if($c=="kW"){
					$converting=($d*1000)/$voltage;
				}
				else if($c=="hp"){
					$converting=(746)/($voltage*(95*100));
				}
			}
				else if($phase_current=="3"){//AC Three Phase
				if($c=="am"){
				$converting=$d*1;
				}else if($c=="mi"){
					$converting=$d*0.001;
				}else if($c=="wa"){
					$converting=($d)/($voltage);
				}else if($c=="kva"){
					$converting=($d*1000)/(sqrt(3)*$voltage);
				}
				else if($c=="kW"){
					$converting=($d*1000)/(sqrt(3)*$voltage);
				}
				else if($c=="hp"){
					$converting=(746)/((sqrt(3))*$voltage*(95*100));
				}
			}
			
			return $converting;
		}
		if($calculate_unit=="1"){
			if(is_numeric($load_current) && is_numeric($voltage) && is_numeric($conductors) && is_numeric($power_voltage) && is_numeric($cable_length) && is_numeric($wire_diameter_size) && is_numeric($resistivity)){
				if($conductors<0){
					$this->param['error'] = 'Number of conductors must be greater than zero';
					return $this->param;
				}
				if($wire_material_unit=="cu"){
					$resisvity_value=1.72e-8;
				}elseif($wire_material_unit=="al"){
					$resisvity_value=2.82e-8;
				}elseif($wire_material_unit=="cs"){
					$resisvity_value=1.43e-7;
				}elseif($wire_material_unit=="es"){
					$resisvity_value=4.6e-7;
				}elseif($wire_material_unit=="go"){
					$resisvity_value=2.44e-8;
				}elseif($wire_material_unit=="ni"){
					$resisvity_value=1.1e-6;
				}elseif($wire_material_unit=="nic"){
					$resisvity_value=6.99e-8;
				}elseif($wire_material_unit=="si"){
					$resisvity_value=1.59e-8;
				}
				if($wire_diameter_size_unit=="AWG"){//AWG
					if($wire_diameter_size=="000000" || $wire_diameter_size=="6/0" ) $wire_diameter_size=-5;
					if( $wire_diameter_size=="00000" || $wire_diameter_size=="5/0" ) $wire_diameter_size=-4;
					if( $wire_diameter_size=="0000" || $wire_diameter_size=="4/0" ) $wire_diameter_size=-3;
					if( $wire_diameter_size=="000" || $wire_diameter_size=="3/0" ) $wire_diameter_size=-2;
					if( $wire_diameter_size=="00" || $wire_diameter_size=="2/0" ) $wire_diameter_size=-1;
					if( $wire_diameter_size>40 ) {
						$this->param['error'] = 'AWG>40 is not valid';
						return $this->param;
					}
						$d=0.127e-3*pow(92,((36-$wire_diameter_size)/39));
						//Math.pow(92,((36-n)/39));
					}elseif($wire_diameter_size_unit=="inch"){//inch
						$d = 25.4*$wire_diameter_size/1000;
					}elseif($wire_diameter_size_unit=="mm"){//mm
						$d = $wire_diameter_size_unit/1000;
					}
					if($cable_length_unit=="ft"){
						$cable_length=$cable_length*0.3048;
					}
					$a=3.14*$d*$d/4.0;
					$r=2*$resisvity_value*$cable_length/$a;
					$convert_voltage=convert_voltage($voltage_unit,$voltage);
					$load_current_value=convert_current($load_current_unit,$load_current,$phase_unit,$convert_voltage);
					$vd=$load_current_value*$r;
					if($phase_unit=="3"){
						$vd=$vd*(1.732/2);
					}
					$vdp = $vd/($voltage*100);
					$this->param['wire_resistance']=$r;
			}else{
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}else if($calculate_unit=="2"){
			if(is_numeric($load_current) && is_numeric($voltage) && is_numeric($conductors) && is_numeric($wire_length) && is_numeric($resistivity) && is_numeric($gauge)){
				if($wire_material_unit_two=="0"){
					$wire_value=12.9;
				}else if($wire_material_unit_two=="1"){
						$wire_value=21.2;
				}
				if( $gauge=="000000" || $gauge=="6/0" ) $gauge=-5;
				if( $gauge=="00000" || $gauge=="5/0" ) $gauge=-4;
				if( $gauge=="0000" || $gauge=="4/0" ) $gauge=-3;
				if( $gauge=="000" || $gauge=="3/0" ) $gauge=-2;
				if( $gauge=="00" || $gauge=="2/0" ) $gauge=-1;
				$din = 0.005*pow(92,((36-$gauge)/39));
				$dmm = 0.127*pow(92,((36-$gauge)/39));
				$amil = (1000*$din*$din);
				$ain = 3.14/4*$din*$din;
				$amm = 3.14/4*$dmm*$dmm;
				$rft = 0.3048e9*$resistivity/(25.4*25.4*$ain);
			    $rm = 1e9*$resistivity/$amm;
			    $save_amil=$amil*1000;
				if($find_unit=="1"){
					if($phase_unit=="1" || $phase_unit=="2"){
						$wire_length_value=calculates($wire_length_unit,$wire_length);
						$convert_current=convert_current($load_current_unit,$load_current,$phase_unit,$voltage);
						$vd=(2*$wire_value*$convert_current*$wire_length_value)/$save_amil;
						$vdp=$vd/$voltage;
					}else if($phase_unit=="3"){
						$wire_size_value=$wire_size_unit;
						$wire_length_value=calculates($wire_length_unit,$wire_length);
						$convert_current=convert_current($load_current_unit,$load_current,$phase_unit,$voltage);
						$vd=(sqrt(3)*$wire_value*$convert_current*$wire_length_value)/$wire_size_value;
						$vdp=$vd/$voltage;
					}

					
					$this->param['din']=$din;
					$this->param['dmm']=$dmm;
					$this->param['amil']=$amil;
					$this->param['ain']=$ain;
					$this->param['amm']=$amm;
					// dd($this->param);

				}
				if($find_unit=="2"){//Mimimum Conductor Size
					if(is_numeric($max_voltage_drop)){
						if($wire_material_unit_two=="0"){
							$wire_value=12.9;
					}else if($wire_material_unit_two=="1"){
							$wire_value=21.2;
					}
					if ($load_current > 0 && $voltage > 0 && $cable_length > 0) {
						 $Vd = $voltage * $max_voltage_drop;
						 $Cm = $phase_unit*$wire_value*$cable_length*$load_current/$Vd;	
						 echo"The value of cm is".$Cm*1000;
						for ($i = 0; $i <count($kcmil); $i++) {
							if ($kcmil[$i] >= $Cm) {
								$sizevd = $i;
								break;
							} else if ($Cm > 2000000) {
								$sizevd = 30;
							}
						}
						if ($wire_material_unit_two== 0 && $raceway == 0) {
							if ($insulation == 0) {
								$ans60 = $load_current;
								for ($i = 0; $i < count($amps60); $i++) {
									if ($amps60[$i] > $ans60) {
										$sizevs = $i;
										break;
									} else if ($load_current > 560) {
										$sizevs = 30;
									}
								}
							} else if ($insulation == 1) {
							$ans75 = $load_current;
								for ($i = 0; $i < count($amps75); $i++) {
									if ($amps75[$i] > $ans75) {
										$sizevs = $i;
										break;
									} else if ($load_current > 665) {
										$sizevs = 30;
									}
								}
							} else if ($insulation == 2) {
								$ans90 = $load_current;
									for ($i = 0; $i < count($amps90); $i++) {
										if ($amps90[$i] > $ans90) {
											$sizevs = $i;
											break;
										} else if ($load_current > 750) {
											$sizevs = 30;
										}
									}
								}
							} else if ($wire_material_unit_two == 1 && $raceway == 0) {
								if ($insulation == 0) {
									$ans60 = $load_current;
									for ($i = 0; $i < count($amps60al); $i++) {
										if ($amps60al[$i] > $ans60) {
											$sizevs = $i;
											break;
										} else if ($load_current > 470) {
											$sizevs = 30;
										}
									}
								} else if ($insulation == 1) {
									$ans75 = $load_current;
									for ($i = 0; $i < count($amps75al); $i++) {
										if ($amps75al[$i] > $ans75) {
											$sizevs = $i;
											break;
										} else if ($amps > 560) {
											$sizevs = 30;
										}
									}
								} else if ($insulation == 2) {
									$ans90 = $load_current;
									for ($i = 0; $i < count($amps90al); $i++) {
										if ($amps90al[$i] > $ans90) {
											$sizevs = $i;
											break;
										} else if ($amps > 630) {
											$sizevs = 30;
										}
									}
								}
							} else if ($wire_material_unit_two == 0 && $raceway == 1) {
								if ($insulation == 0) {
									$ans60 = $load_current;
									for ($i = 0; $i < count($fa60); $i++) {
										if ($fa60[$i] > $ans60) {
											$sizevs = $i;
											break;
										} else if ($amps > 1155) {
											$sizevs = 30;
										}
									}
								} else if ($insulation == 1) {
									$ans75 = $load_current;
									for ($i = 0; $i < count($fa75); $i++) {
										if ($fa75[$i] > $ans75) {
											$sizevs = $i;
											break;
										} else if ($load_current > 1385) {
											$sizevs = 30;
										}
									}
								} else if ($insulation == 2) {
									$ans90 = $amps;
									for ($i = 0; $i < count($fa90); $i++) {
										if ($fa90[$i] > $ans90) {
											$sizevs = i;
											break;
										} else if ($load_current > 1560) {
											$sizevs = 30;
										}
									}
								}
							} else if ($wire_material_unit_two == 1 && $raceway == 1) {
								if ($ins == 0) {
									$ans60 = $load_current;
									for ($i = 0; $i < count($fa60al); $i++) {
										if ($fa60al[$i] > $ans60) {
											$sizevs = $i;
											break;
										} else if ($load_current > 1155) {
											$sizevs = 30;
										}
									}
								}else if ($insulation == 1) {
									$ans75 = $load_current;
									for ($i = 0; $i < count($fa75al); $i++) {
										if ($fa75al[$i] > $ans75) {
											$sizevs = $i;
											break;
										} else if ($load_current > 1385) {
											$sizevs = 30;
										}
									}
								} else if ($insulation == 2) {
									$ans90 = $load_current;
									for ($i = 0; $i < count($fa90al); $i++) {
										if ($fa90al[$i] > $ans90) {
											$sizevs = $i;
											break;
										} else if ($amps > 1560) {
											$sizevs = 30;
										}
									}
								}
						}
						if ($sizevd == 30 || $sizevs == 30) {
							$wire_size=">2000kmcil";
							$calculate_voltage_drop=($max_voltage_drop/100)*$voltage;
							$final=$voltage-$calculate_voltage_drop;

							echo $final." V";
							
						} else if ($sizevd >= $sizevs) {
							$wire_size=$wires[$sizevd];
							$calculate_voltage_drop=($max_voltage_drop/100)*$voltage;
							$final=$voltage-$calculate_voltage_drop."V";
						}
						else {
							$wire_size=$wires[$sizevs];
							$calculate_voltage_drop=($max_voltage_drop/100)*$voltage;
							$final=$voltage-$calculate_voltage_drop."V";
						}
						$this->param['wire_size']=$wire_size;
						$this->param['final']=$final;

					}
					else {
						$this->param['error'] = 'Please fill all fields.';
						return $this->param;
					}
						}else{
							$this->param['error'] = 'Please fill all fields.';
							return $this->param;
							 }
				}else if($find_unit=="3"){//Maximum Circuit Distance
					if(is_numeric($max_voltage_drop)){
						if($phase_unit=="1" || $phase_unit=="2"){
							$convert_current=convert_current($load_current_unit,$load_current,$phase_unit,$voltage);
							$wire_length_value=calculates($wire_length_unit,$wire_length);
							$voltagee=($max_voltage_drop*$voltage)/100;
							$vd=($voltagee*$amil*1000);
							$vg=(2*$wire_value*$convert_current);
							$vv=$vd/$vg;	
						}else if($phase_unit=="3"){
							$convert_current=convert_current($load_current_unit,$load_current,$phase_unit,$voltage);
							$wire_length_value=calculates($wire_length_unit,$wire_length);
							$voltagee=($max_voltage_drop*$voltage)/100;
							$vd=($voltagee*$amil*1000);
							$vg=(sqrt(3)*$wire_value*$convert_current);
							$vv=$vd/$vg;
							
						}
						
						$this->param['vv']=$vv;
						$this->param['RESULT'] = 1;
						return $this->param;
					}else{
						$this->param['error'] = 'Please fill all fields.';
						return $this->param;
					}
				}
			}else{
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}

		}else if($calculate_unit=="3"){
			if(is_numeric($wire_resistance) && is_numeric($voltage) && is_numeric($load_current)){
				if($phase_unit=="1" || $phase_unit=="2"){
					$wire_resistance_value=convert_impedance($wire_resistance_unit,$wire_resistance);
					$wire_length_value=calculates($wire_length_unit,$wire_length);
					$convert_current=convert_current($load_current_unit,$load_current,$phase_unit,$voltage);
					$vd=(2*$wire_resistance*$convert_current*$wire_length_value)/$wire_resistance_value;
					$vd = $vd*100;
					$vdp=$vd/$voltage;
				}else if($phase_unit=="3"){
					$wire_resistance_value=convert_impedance($wire_resistance_unit,$wire_resistance);
					$convert_current=convert_current($load_current_unit,$load_current,$phase_unit,$voltage);
					$wire_length_value=calculates($wire_length_unit,$wire_length);
					$vd=(2*$wire_resistance*$convert_current*$wire_length_value)/$wire_resistance_value;
					$vdp=$vd/$voltage;
					$vd = $vd*100;

				}
			}else{
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}
			$this->param['voltage_drop_formula']=$vd/$conductors;
			$this->param['voltage_drop_percentage']=$vdp;
			$this->param['voltage']=$voltage;
			$this->param['RESULT'] = 1;
			return $this->param;

	}


	public function vector_projection($request)
	{
		//error_reporting (0);
		$ax = $request['ax'];
		$ay = $request['ay'];
		$az = $request['az'];
		$bx = $request['bx'];
		$by = $request['by'];
		$bz = $request['bz'];
		$dem = $request['dem'];
		$vector_representation = $request['vector_representation'];
		$vector_b = $request['vector_b'];
		$first_aa = $request['1aa'];
		$second_aa = $request['2aa'];
		$third_aa = $request['3aa'];
		$first_bb = $request['1bb'];
		$second_bb = $request['2bb'];
		$third_bb = $request['3bb'];
		$first_a = $request['1a'];
		$second_a = $request['2a'];
		$third_a = $request['3a'];
		$first_b = $request['1b'];
		$second_b = $request['2b'];
		$third_b = $request['3b'];
		function global_function($vector_unit, $vector_u)
		{
			function gcd($a, $b)
			{
				$a = abs($a);
				$b = abs($b);

				if ($a < $b) {
					list($b, $a) = array($a, $b);
				}
				if ($b == 0) {
					return 1;
				}
				$r = $a % $b;
				while ($r > 0) :
					$a = $b;
					$b = $r;
					$r = $a % $b;
				endwhile;
				return $b;
			}
			function reduce($num, $den)
			{
				$g = gcd($num, $den);
				return array($num / $g, $den / $g);
			}
			$g = gcd($vector_unit, $vector_u);
			list($upr, $btm) = reduce($vector_unit, $vector_u);
			$up = $upr;
			$bm = $btm;
			return array($up, $bm);
		}
		if ($dem == "3") {
			if ($vector_representation == "coor" && $vector_b == "coor") { //Coor Coor
				if (is_numeric($ax) && is_numeric($ay) && is_numeric($az) && is_numeric($bx) && is_numeric($by) && is_numeric($bz)) {
					$vector_unit = ($ax * $bx) + ($ay * $by) + ($az * $bz);
					$vector_u = ($bx * $bx) + ($by * $by) + ($bz * $bz);
					$combined_vector = $vector_unit / $vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $bx;
					$this->param['ay'] = $by;
					$this->param['az'] = $bz;
					$this->param['f1'] = $ax;
					$this->param['f2'] = $ay;
					$this->param['f3'] = $az;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['dem'] = $dem;
					$this->param['RESULT'] = 1;
					return $this->param;
				}
			} else if ($vector_representation == "coor" && $vector_b == "point") {
				if (is_numeric($first_aa) && is_numeric($second_aa) && is_numeric($third_aa) && is_numeric($first_bb) && is_numeric($second_bb) && is_numeric($third_bb) && is_numeric($ax) && is_numeric($ay) && is_numeric($az)) {
					$bx = $first_bb - $first_aa;
					$by = $second_bb - $second_aa;
					$bz = $third_bb - $third_aa;
					$vector_unit = ($ax * $bx) + ($ay * $by) + ($az * $bz);
					$vector_unit;
					$vector_u = ($bx * $bx) + ($by * $by) + ($bz * $bz);
					$vector_u;
					$combined_vector = $vector_unit / $vector_u;

					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $bx;
					$this->param['ay'] = $by;
					$this->param['az'] = $bz;
					$this->param['f1'] = $ax;
					$this->param['f2'] = $ay;
					$this->param['f3'] = $az;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['first_aa'] = $first_aa;
					$this->param['second_aa'] = $second_aa;
					$this->param['third_aa'] = $third_aa;
					$this->param['first_bb'] = $first_bb;
					$this->param['second_bb'] = $second_bb;
					$this->param['third_bb'] = $third_bb;
					$this->param['dem'] = $dem;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($vector_representation == "point" && $vector_b == "coor") {
				if (is_numeric($first_a) && is_numeric($second_a) && is_numeric($third_a) && is_numeric($first_b) && is_numeric($second_b) && is_numeric($third_b) && is_numeric($bx) && is_numeric($by) && is_numeric($bz)) {
					$cx = $first_b - $first_a;
					$cy = $second_b - $second_a;
					$cz = $third_b - $third_a;
					$vector_unit = ($bx * $cx) + ($by * $cy) + ($cz * $bz);
					$vector_unit;
					$vector_u = ($bx * $bx) + ($by * $by) + ($bz * $bz);
					$vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $cx;
					$this->param['ay'] = $cy;
					$this->param['az'] = $cz;
					$this->param['bx'] = $bx;
					$this->param['by'] = $by;
					$this->param['bz'] = $bz;
					$this->param['dem'] = $dem;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($vector_representation == "point" && $vector_b == "point") {
				if (is_numeric($first_a) && is_numeric($second_a) && is_numeric($third_a) && is_numeric($first_b) && is_numeric($second_b) && is_numeric($third_b) && is_numeric($first_aa) && is_numeric($second_aa) && is_numeric($third_aa) && is_numeric($first_bb) && is_numeric($second_bb) && is_numeric($third_bb)) {
					$cx = $first_b - $first_a;
					$cy = $second_b - $second_a;
					$cz = $third_b - $third_a;
					$dx = $first_bb - $first_aa;
					$dy = $second_bb - $second_aa;
					$dz = $third_bb - $third_aa;
					$vector_unit = ($dx * $cx) + ($dy * $cy) + ($dz * $cz);
					$vector_unit;
					$vector_u = ($dx * $dx) + ($dy * $dy) + ($dz * $dz);
					$vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $cx;
					$this->param['ay'] = $cy;
					$this->param['az'] = $cz;
					$this->param['ex'] = $dx;
					$this->param['ey'] = $dy;
					$this->param['ez'] = $dz;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['dem'] = $dem;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else if ($dem == "2") {
			if ($vector_representation == "coor" && $vector_b == "coor") { //Coor Coor
				if (is_numeric($ax) && is_numeric($ay) &&  is_numeric($bx) && is_numeric($by)) {
					$vector_unit = ($ax * $bx) + ($ay * $by);
					$vector_u = ($bx * $bx) + ($by * $by);
					$combined_vector = $vector_unit / $vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $bx;
					$this->param['ay'] = $by;
					$this->param['bx'] = $ax;
					$this->param['by'] = $ay;
					$this->param['dem'] = $dem;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($vector_representation == "coor" && $vector_b == "point") {
				if (is_numeric($first_aa) && is_numeric($second_aa)  && is_numeric($first_bb) && is_numeric($second_bb)  && is_numeric($ax) && is_numeric($ay)) {
					$bx = $first_bb - $first_aa;
					$by = $second_bb - $second_aa;
					$vector_unit = ($ax * $bx) + ($ay * $by);
					$vector_u = ($bx * $bx) + ($by * $by);
					$combined_vector = $vector_unit / $vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $bx;
					$this->param['ay'] = $by;
					$this->param['ex'] = $ax;
					$this->param['ey'] = $ay;
					$this->param['dem'] = $dem;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($vector_representation == "point" && $vector_b == "coor") {
				if (is_numeric($first_a) && is_numeric($second_a) && is_numeric($first_b) && is_numeric($second_b) && is_numeric($bx) && is_numeric($by)) {
					$cx = $first_b - $first_a;
					$cy = $second_b - $second_a;
					$vector_unit = ($bx * $cx) + ($by * $cy);
					$vector_u = ($bx * $bx) + ($by * $by);
					$combined_vector = $vector_unit / $vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $bx;
					$this->param['ay'] = $by;
					$this->param['cx'] = $cx;
					$this->param['cy'] = $cy;
					$this->param['dem'] = $dem;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($vector_representation == "point" && $vector_b == "point") {
				if (is_numeric($first_a) && is_numeric($second_a)  && is_numeric($first_b) && is_numeric($second_b)  && is_numeric($first_aa) && is_numeric($second_aa)  && is_numeric($first_bb) && is_numeric($second_bb)) {
					$cx = $first_b - $first_a;
					$cy = $second_b - $second_a;
					$dx = $first_bb - $first_aa;
					$dy = $second_bb - $second_aa;
					$vector_unit = ($dx * $cx) + ($dy * $cy);
					$vector_u = ($dx * $dx) + ($dy * $dy);
					$combined_vector = $vector_unit / $vector_u;
					if (ceil(sqrt($vector_u)) == floor(sqrt($vector_u))) {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
					} else {
						$first_vector = $vector_unit;
						$second_vector = $vector_u;
						$calling = global_function($vector_unit, $vector_u);
						$call0 = $calling[0];
						$call1 = $calling[1];
					}
					$this->param['vector_representation'] = $vector_representation;
					$this->param['vector_b'] = $vector_b;
					$this->param['vector_unit'] = $first_vector;
					$this->param['vector_u'] = $second_vector;
					$this->param['ax'] = $cx;
					$this->param['ay'] = $cy;
					$this->param['dx'] = $dx;
					$this->param['dy'] = $dy;
					$this->param['dem'] = $dem;
					$this->param['call0'] = $call0;
					$this->param['call1'] = $call1;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
	}
	// density-altitude-calculator
	public function kinetic($request)
	{
		if ($request['submit'] === 'linear') {
			if ($request['to_cal'] === 'velo') {
				if (is_numeric($request['kin']) && is_numeric($request['mass'])) {
					$kin = $request['kin'];
					$mass = $request['mass'];
					if ($request['unit_k'] === 'kJ') {
						$kin = $kin * 1000;
					}
					if ($request['unit_k'] === 'MJ') {
						$kin = $kin * 1000000;
					}
					if ($request['unit_k'] === 'Wh') {
						$kin = $kin * 3600;
					}
					if ($request['unit_k'] === 'kWh') {
						$kin = $kin * 3.6e+6;
					}
					if ($request['unit_m'] === 'mg') {
						$mass = $mass / 1e+6;
					}
					if ($request['unit_m'] === 'g') {
						$mass = $mass / 1000;
					}
					if ($request['unit_m'] === 'lbs') {
						$mass = $mass / 2.205;
					}
					$velocity = round(sqrt(($kin * 2) / $mass), 4);
					$this->param['velocity'] = $velocity;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_cal'] === 'mass') {
				if (is_numeric($request['kin']) && is_numeric($request['velocity'])) {
					$kin = $request['kin'];
					$velocity = $request['velocity'];
					if ($request['unit_k'] === 'kJ') {
						$kin = $kin * 1000;
					}
					if ($request['unit_k'] === 'MJ') {
						$kin = $kin * 1000000;
					}
					if ($request['unit_k'] === 'Wh') {
						$kin = $kin * 3600;
					}
					if ($request['unit_k'] === 'kWh') {
						$kin = $kin * 3.6e+6;
					}
					if ($request['unit_v'] === 'miles/s') {
						$velocity = $velocity * 1609;
					}
					if ($request['unit_v'] === 'km/s') {
						$velocity = $velocity * 1000;
					}
					if ($request['unit_v'] === 'ft/s') {
						$velocity = $velocity / 3.281;
					}
					if ($request['unit_v'] === 'in/s') {
						$velocity = $velocity / 39.37;
					}
					if ($request['unit_v'] === 'yd/s') {
						$velocity = $velocity / 1.094;
					}
					if ($request['unit_v'] === 'km/h') {
						$velocity = $velocity / 3.6;
					}
					if ($request['unit_v'] === 'm/h') {
						$velocity = $velocity / 2.237;
					}
					$mass = round((2 * $kin) / pow($velocity, 2), 4);
					$this->param['mass'] = $mass;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_cal'] === 'kin') {
				if (is_numeric($request['velocity']) && is_numeric($request['mass'])) {
					$velocity = $request['velocity'];
					$mass = $request['mass'];
					if ($request['unit_v'] === 'miles/s') {
						$velocity = $velocity * 1609;
					}
					if ($request['unit_v'] === 'km/s') {
						$velocity = $velocity * 1000;
					}
					if ($request['unit_v'] === 'ft/s') {
						$velocity = $velocity / 3.281;
					}
					if ($request['unit_v'] === 'in/s') {
						$velocity = $velocity / 39.37;
					}
					if ($request['unit_v'] === 'yd/s') {
						$velocity = $velocity / 1.094;
					}
					if ($request['unit_v'] === 'km/h') {
						$velocity = $velocity / 3.6;
					}
					if ($request['unit_v'] === 'm/h') {
						$velocity = $velocity / 2.237;
					}
					if ($request['unit_m'] === 'mg') {
						$mass = $mass / 1e+6;
					}
					if ($request['unit_m'] === 'g') {
						$mass = $mass / 1000;
					}
					if ($request['unit_m'] === 'lbs') {
						$mass = $mass / 2.205;
					}
					$kin = round(($mass * pow($velocity, 2)) / 2, 4);
					$this->param['kin'] = $kin;
					$this->param['RESULT'] = 1;
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} else {
			if ($request['to_calr'] === 'a_v') {
				if (is_numeric($request['r_kin']) && is_numeric($request['moment'])) {
					$kin = $request['r_kin'];
					$mass = $request['moment'];
					if ($request['unit_k'] === 'kJ') {
						$kin = $kin * 1000;
					}
					if ($request['unit_k'] === 'MJ') {
						$kin = $kin * 1000000;
					}
					if ($request['unit_k'] === 'Wh') {
						$kin = $kin * 3600;
					}
					if ($request['unit_k'] === 'kWh') {
						$kin = $kin * 3.6e+6;
					}
					if ($request['unit_i'] === 'lbs*ft²') {
						$mass = $mass * 0.04214;
					}
					$a_velocity = round(sqrt(($kin * 2) / $mass), 4);
					$this->param['a_velocity'] = $a_velocity;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_calr'] === 'moi') {
				if (is_numeric($request['r_kin']) && is_numeric($request['a_velocity'])) {
					$kin = $request['r_kin'];
					$velocity = $request['a_velocity'];
					if ($request['unit_k'] === 'kJ') {
						$kin = $kin * 1000;
					}
					if ($request['unit_k'] === 'MJ') {
						$kin = $kin * 1000000;
					}
					if ($request['unit_k'] === 'Wh') {
						$kin = $kin * 3600;
					}
					if ($request['unit_k'] === 'kWh') {
						$kin = $kin * 3.6e+6;
					}
					if ($request['unit_v_r'] === 'rpm') {
						$velocity = $velocity * 0.10472;
					}
					if ($request['unit_v_r'] === 'Hz') {
						$velocity = $velocity * 6.283;
					}
					$moment = round((2 * $kin) / pow($velocity, 2), 4);
					$this->param['moment'] = $moment;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_calr'] === 'r_kin') {
				if (is_numeric($request['a_velocity']) && is_numeric($request['moment'])) {
					$velocity = $request['a_velocity'];
					$mass = $request['moment'];
					// if ($request['unit_v_r']==='rpm') {
					// 	$velocity=$velocity*0.10472;
					// }
					if ($request['unit_i'] === 'lbs*ft²') {
						$mass = $mass * 0.04214;
					}
					$kin = round(($mass * pow($velocity, 2)) / 2, 4);
					$this->param['r_kin'] = $kin;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
	}
	// Momentum Calculator
	public function momentum($request)
	{
	
		if ($request['type'] == 'velocity') {
			if ($request['to_cal'] == 'mom') {
				if (is_numeric($request['mass']) && is_numeric($request['velocity'])) {
					$velocity = $request['velocity'];
					if ($request['unit_v'] == 'miles/s') {
						$velocity = $velocity * 1609;
					}
					if ($request['unit_v'] == 'km/s') {
						$velocity = $velocity * 1000;
					}
					if ($request['unit_v'] == 'ft/s') {
						$velocity = $velocity / 3.281;
					}
					if ($request['unit_v'] == 'in/s') {
						$velocity = $velocity / 39.37;
					}
					if ($request['unit_v'] == 'yd/s') {
						$velocity = $velocity / 1.094;
					}
					if ($request['unit_v'] == 'km/h') {
						$velocity = $velocity / 3.6;
					}
					if ($request['unit_v'] == 'm/h') {
						$velocity = $velocity / 2.237;
					}
					$mass = $request['mass'];
					if ($request['unit_m'] == 'mg') {
						$mass = $mass / 1e+6;
					}
					if ($request['unit_m'] == 'g') {
						$mass = $mass / 1000;
					}
					if ($request['unit_m'] == 'lbs') {
						$mass = $mass / 2.205;
					}
					$mom = round($mass * $velocity, 5);
					$this->param['mom'] = $mom;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_cal'] == 'mass') {
				if (is_numeric($request['velocity']) && is_numeric($request['mom'])) {
					$mom = $request['mom'];
					if ($request['unit_k'] == 'Nm') {
						$mom = $mom / 0.01666667;
					} elseif ($request['unit_k'] == 'Nh') {
						$mom = $mom / 0.000277778;
					} elseif ($request['unit_k'] == 'lb-ft') {
						$mom = $mom / 0.22482;
					}
					$velocity = $request['velocity'];
					if ($request['unit_v'] == 'miles/s') {
						$velocity = $velocity * 1609;
					} elseif ($request['unit_v'] == 'km/s') {
						$velocity = $velocity * 1000;
					} elseif ($request['unit_v'] == 'ft/s') {
						$velocity = $velocity / 3.281;
					} elseif ($request['unit_v'] == 'in/s') {
						$velocity = $velocity / 39.37;
					} elseif ($request['unit_v'] == 'yd/s') {
						$velocity = $velocity / 1.094;
					} elseif ($request['unit_v'] == 'km/h') {
						$velocity = $velocity / 3.6;
					} elseif ($request['unit_v'] == 'm/h') {
						$velocity = $velocity / 2.237;
					}
					$mass = round($mom / $velocity, 5);
					$this->param['mass'] = $mass;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_cal'] == 'velo') {
				if (is_numeric($request['mom']) && is_numeric($request['mass'])) {
					$mom = $request['mom'];
					if ($request['unit_k'] == 'Nm') {
						$mom = $mom / 0.01666667;
					} elseif ($request['unit_k'] == 'Nh') {
						$mom = $mom / 0.000277778;
					} elseif ($request['unit_k'] == 'lb-ft') {
						$mom = $mom / 0.22482;
					}
					$mass = $request['mass'];
					if ($request['unit_m'] == 'mg') {
						$mass = $mass / 1e+6;
					} elseif ($request['unit_m'] == 'g') {
						$mass = $mass / 1000;
					} elseif ($request['unit_m'] == 'lbs') {
						$mass = $mass / 2.205;
					}
					$velo = round($mom / $mass, 5);
					$this->param['velo'] = $velo;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		} else {
			if ($request['to_calr'] == 'mom_t') {
				if (is_numeric($request['force']) && is_numeric($request['time'])) {
					$force = $request['force'];
					if ($request['unit_f'] == 'KN') {
						$force = $force * 1000;
					} elseif ($request['unit_f'] == 'MN') {
						$force = $force * 1000000;
					}
					$time = $request['time'];
					if ($request['unit_t'] == 'min') {
						$time = $time * 60;
					} elseif ($request['unit_t'] == 'h') {
						$time = $time * 60 * 60;
					}
					$momt = round($force * $time, 5);
					$this->param['momt'] = $momt;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_calr'] == 'force') {
				if (is_numeric($request['mom_t']) && is_numeric($request['time'])) {
					$mom = $request['mom_t'];
					if ($request['unit_mt'] == 'Nm') {
						$mom = $mom / 0.01666667;
					} elseif ($request['unit_mt'] == 'Nh') {
						$mom = $mom / 0.000277778;
					} elseif ($request['unit_mt'] == 'lb-ft') {
						$mom = $mom / 0.22482;
					}
					$time = $request['time'];
					if ($request['unit_t'] == 'min') {
						$time = $time * 60;
					} elseif ($request['unit_t'] == 'h') {
						$time = $time * 60 * 60;
					}
					$forcet = round($mom / $time, 5);
					$this->param['forcet'] = $forcet;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($request['to_calr'] == 'time_c') {
				if (is_numeric($request['mom_t']) && is_numeric($request['force'])) {
					$mom = $request['mom_t'];
					if ($request['unit_mt'] == 'Nm') {
						$mom = $mom / 0.01666667;
					} elseif ($request['unit_mt'] == 'Nh') {
						$mom = $mom / 0.000277778;
					} elseif ($request['unit_mt'] == 'lb-ft') {
						$mom = $mom / 0.22482;
					}
					$force = $request['force'];
					if ($request['unit_f'] == 'KN') {
						$force = $force * 1000;
					} elseif ($request['unit_f'] == 'MN') {
						$force = $force * 1000000;
					}
					$time = round($mom / $force, 5);
					$this->param['time'] = $time;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
	}
	// Angular Velocity Calculator
	public function angular($request)
	{
		$method = trim($request['method']);
		$g = trim($request['g']);
		$gg = trim($request['gg']);
		$check = trim($request['check']);
		$ac = trim($request['ac']);
		$ac1 = trim($request['ac1']);
		$t = trim($request['t']);
		$t1 = trim($request['t1']);
		$av = trim($request['av']);
		$av1 = trim($request['av1']);
		$vel = trim($request['vel']);
		$vel1 = trim($request['vel1']);
		$rad = trim($request['rad']);
		$rad1 = trim($request['rad1']);
		$rpm = trim($request['rpm']);
		$rds_m = trim($request['rds_m']);
		$rds_m1 = trim($request['rds_m1']);
		function sigFigA($value, $digits)
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
		if (is_numeric($ac)) {
			if ($ac1 == 'deg') {
				$ac = $ac / 57.3;
			} elseif ($ac1 == 'gon') {
				$ac = $ac / 63.66;
			} elseif ($ac1 == 'tr') {
				$ac = $ac / 0.15915;
			} elseif ($ac1 == 'arcmin') {
				$ac = $ac / 3438;
			} elseif ($ac1 == 'arcsec') {
				$ac = $ac / 206265;
			} elseif ($ac1 == 'mrad') {
				$ac = $ac / 1000;
			} elseif ($ac1 == 'urad') {
				$ac = $ac / 1000000;
			} elseif ($ac1 == 'pirad') {
				$ac = $ac / 0.3183;
			}
		}
		if (is_numeric($t)) {
			if ($t1 == 'min') {
				$t = $t / 0.016667;
			} elseif ($t1 == 'hrs') {
				$t = $t / 0.0002778;
			} elseif ($t1 == 'days') {
				$t = $t / 0.000011574;
			} elseif ($t1 == 'weeks') {
				$t = $t / 0.0000016534;
			} elseif ($t1 == 'months') {
				$t = $t / 0.00000038026;
			} elseif ($t1 == 'year') {
				$t = $t / 0.00000003169;
			}
		}
		if (is_numeric($av)) {
			if ($av1 == 'rpm') {
				$av = $av / 9.55;
			} elseif ($av1 == 'hz') {
				$av = $av / 0.15915;
			}
		}
		if (is_numeric($vel)) {
			if ($vel1 == 'km/s') {
				$vel = $vel / 0.001;
			} elseif ($vel1 == 'km/h') {
				$vel = $vel / 3.6;
			} elseif ($vel1 == 'ft/s') {
				$vel = $vel / 3.281;
			} elseif ($vel1 == 'mi/s') {
				$vel = $vel / 0.000621371;
			} elseif ($vel1 == 'mi/h') {
				$vel = $vel / 2.237;
			} elseif ($vel1 == 'knots') {
				$vel = $vel / 1.944;
			}
		}
		if (is_numeric($rad)) {
			if ($rad1 == 'mm') {
				$rad = $rad / 1000;
			} elseif ($rad1 == 'cm') {
				$rad = $rad / 100;
			} elseif ($rad1 == 'km') {
				$rad = $rad * 0.001;
			} elseif ($rad1 == 'in') {
				$rad = $rad / 39.37;
			} elseif ($rad1 == 'ft') {
				$rad = $rad * 3.281;
			} elseif ($rad1 == 'yd') {
				$rad = $rad * 1.0936;
			} elseif ($rad1 == 'mi') {
				$rad = $rad * 0.0006214;
			} elseif ($rad1 == 'nmi') {
				$rad = $rad * 0.00054;
			}
		}
		if (is_numeric($rds_m)) {
			if ($rds_m1 == 'ft') {
				$rds_m = $rds_m / 3.281;
			} elseif ($rds_m1 == 'cm') {
				$rds_m = $rds_m / 100;
			} elseif ($rds_m1 == 'in') {
				$rds_m = $rds_m / 39.37;
			} elseif ($rds_m1 == 'yd') {
				$rds_m = $rds_m / 1.094;
			}
		}
		if ($method === '0') {
			if ($check === 'g1_value' || $g === 'ang_vel') {
				if (is_numeric($ac) && is_numeric($t)) {
					$ang_vel = $ac / $t;
					$ang_vel_hertz = $ang_vel * 0.15915;
					$ang_vel_rpm = $ang_vel_hertz * 60;
					$this->param['ang_vel'] = 'ang_vel';
					$this->param['res_unit'] = 'rad/s';
					$this->param['ans'] = sigFigA($ang_vel, 4);
					$this->param['ang_vel_rpm'] = sigFigA($ang_vel_rpm, 4);
					$this->param['ang_vel_hertz'] = sigFigA($ang_vel_hertz, 4);
					$this->param['ac'] = $ac;
					$this->param['t'] = $t;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($check === 'g2_value' || $g === 'ang_chnge') {
				if (is_numeric($t) && is_numeric($av)) {
					$ang_chnge = $t * $av;
					$ang_chnge_deg = $ang_chnge * 57.3;
					$ang_chnge_gon = $ang_chnge * 63.66;
					$ang_chnge_tr = $ang_chnge * 0.15915;
					$ang_chnge_arcmin = $ang_chnge * 3438;
					$ang_chnge_arcsec = $ang_chnge * 206265;
					$ang_chnge_mrad = $ang_chnge * 1000;
					$ang_chnge_urad = $ang_chnge * 1000000;
					$ang_chnge_pirad = $ang_chnge * 0.3183;
					$this->param['ang_chnge'] = 'ang_chnge';
					$this->param['res_unit'] = 'rad';
					$this->param['ans'] = sigFigA($ang_chnge, 4);
					$this->param['ang_chnge_deg'] = sigFigA($ang_chnge_deg, 4);
					$this->param['ang_chnge_gon'] = sigFigA($ang_chnge_gon, 4);
					$this->param['ang_chnge_tr'] = sigFigA($ang_chnge_tr, 4);
					$this->param['ang_chnge_arcmin'] = sigFigA($ang_chnge_arcmin, 4);
					$this->param['ang_chnge_arcsec'] = sigFigA($ang_chnge_arcsec, 4);
					$this->param['ang_chnge_mrad'] = sigFigA($ang_chnge_mrad, 4);
					$this->param['ang_chnge_urad'] = sigFigA($ang_chnge_urad, 4);
					$this->param['ang_chnge_pirad'] = sigFigA($ang_chnge_pirad, 4);
					$this->param['av'] = $av;
					$this->param['t'] = $t;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($check === 'g3_value' || $g === 'time') {
				if (is_numeric($ac) && is_numeric($av)) {
					$t = $ac / $av;
					$t_min = $t * 0.016667;
					$t_hrs = $t * 0.0002778;
					$t_days = $t * 0.000011574;
					$t_wks = $t * 0.0000016534;
					$t_mos = $t * 0.00000038026;
					$t_yrs = $t * 0.00000003169;
					$this->param['time'] = 'time';
					$this->param['res_unit'] = 'secs';
					$this->param['ans'] = sigFigA($t, 4);
					$this->param['t_min'] = sigFigA($t_min, 4);
					$this->param['t_hrs'] = sigFigA($t_hrs, 4);
					$this->param['t_days'] = sigFigA($t_days, 4);
					$this->param['t_wks'] = sigFigA($t_wks, 4);
					$this->param['t_mos'] = sigFigA($t_mos, 4);
					$this->param['t_yrs'] = sigFigA($t_yrs, 4);
					$this->param['ac'] = $ac;
					$this->param['av'] = $av;
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
		} elseif ($method === '1') {
			if ($check === 'g11_value' || $gg === 'angle_vel1') {
				if (is_numeric($vel) && is_numeric($rad)) {
					$ang_vel = $vel / $rad;
					$ang_vel_hertz = $ang_vel * 0.15915;
					$ang_vel_rpm = $ang_vel_hertz * 60;
					$this->param['ang_vel1'] = 'ang_vel1';
					$this->param['res_unit'] = 'rad/s';
					$this->param['ans'] = sigFigA($ang_vel, 4);
					$this->param['ang_vel_rpm'] = sigFigA($ang_vel_rpm, 4);
					$this->param['ang_vel_hertz'] = sigFigA($ang_vel_hertz, 4);
					$this->param['vel'] = $vel;
					$this->param['rad'] = $rad;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($check === 'g12_value' || $gg === 'velocity') {
				if (is_numeric($av) && is_numeric($rad)) {
					$vel = $rad * $av;
					$vel_kmps = $vel * 0.001;
					$vel_kmph = $vel * 3.6;
					$vel_ftps = $vel * 3.281;
					$vel_mips = $vel * 0.000621371;
					$vel_miph = $vel * 2.237;
					$vel_knots = $vel * 1.944;
					$this->param['velocity'] = 'velocity';
					$this->param['res_unit'] = 'm/s';
					$this->param['ans'] = sigFigA($vel, 4);
					$this->param['vel_kmps'] = sigFigA($vel_kmps, 4);
					$this->param['vel_kmph'] = sigFigA($vel_kmph, 4);
					$this->param['vel_ftps'] = sigFigA($vel_ftps, 4);
					$this->param['vel_mips'] = sigFigA($vel_mips, 4);
					$this->param['vel_miph'] = sigFigA($vel_miph, 4);
					$this->param['vel_knots'] = sigFigA($vel_knots, 4);
					$this->param['av'] = $av;
					$this->param['rad'] = $rad;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} elseif ($check === 'g13_value' || $gg === 'radius') {
				if (is_numeric($av) && is_numeric($vel)) {
					$rad = $vel / $av;
					$rad_mm = $rad * 1000;
					$rad_cm = $rad * 100;
					$rad_km = $rad * 0.001;
					$rad_in = $rad * 39.37;
					$rad_ft = $rad * 3.281;
					$rad_yd = $rad * 1.0936;
					$rad_mi = $rad * 0.0006214;
					$rad_nmi = $rad * 0.00054;
					$this->param['radius'] = 'radius';
					$this->param['res_unit'] = 'm';
					$this->param['ans'] = sigFigA($rad, 4);
					$this->param['rad_mm'] = sigFigA($rad_mm, 4);
					$this->param['rad_cm'] = sigFigA($rad_cm, 4);
					$this->param['rad_km'] = sigFigA($rad_km, 4);
					$this->param['rad_in'] = sigFigA($rad_in, 4);
					$this->param['rad_ft'] = sigFigA($rad_ft, 4);
					$this->param['rad_yd'] = sigFigA($rad_yd, 4);
					$this->param['rad_mi'] = sigFigA($rad_mi, 4);
					$this->param['rad_nmi'] = sigFigA($rad_nmi, 4);
					$this->param['av'] = $av;
					$this->param['vel'] = $vel;
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
		} elseif ($method === '2') {
			if (is_numeric($rpm) && is_numeric($rds_m)) {
				$ang_vel = (2 * pi() * $rpm) / 60;
				$l_v = $ang_vel * $rds_m;
				$ang_vel_hertz = $ang_vel * 0.15915;
				$ang_vel_rpm = $ang_vel_hertz * 60;
				$vel_kmps = $l_v * 0.001;
				$vel_kmph = $l_v * 3.6;
				$vel_ftps = $l_v * 3.281;
				$vel_mips = $l_v * 0.000621371;
				$vel_miph = $l_v * 2.237;
				$vel_knots = $l_v * 1.944;
				$this->param['rpm'] = 'rpm';
				$this->param['res_unit'] = 'rad/s';
				$this->param['ans'] = sigFigA($ang_vel, 4);
				$this->param['ang_vel_rpm'] = sigFigA($ang_vel_rpm, 4);
				$this->param['ang_vel_hertz'] = sigFigA($ang_vel_hertz, 4);
				$this->param['l_v'] = sigFigA($l_v, 4);
				$this->param['vel_kmps'] = sigFigA($vel_kmps, 4);
				$this->param['vel_kmph'] = sigFigA($vel_kmph, 4);
				$this->param['vel_ftps'] = sigFigA($vel_ftps, 4);
				$this->param['vel_mips'] = sigFigA($vel_mips, 4);
				$this->param['vel_miph'] = sigFigA($vel_miph, 4);
				$this->param['vel_knots'] = sigFigA($vel_knots, 4);
				$this->param['rpm'] = $rpm;
				$this->param['rds_m'] = $rds_m;
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
	}
	public function specific($request)
	{
		$find = $request['find'];
		$by = $request['by'];
		$q = $request['q'];
		$q_unit = $request['q_unit'];
		$it = $request['it'];
		$it_unit = $request['it_unit'];
		$ft = $request['ft'];
		$ft_unit = $request['ft_unit'];
		$dt = $request['dt'];
		$dt_unit = $request['dt_unit'];
		$m = $request['m'];
		$m_unit = $request['m_unit'];
		$c = $request['c'];
		$c_unit = $request['c_unit'];
		$sub = $request['sub'];
		if ($by === 'change' && $dt === '0' || $by === 'i_f_t' && ($ft - $it) === 0) {
			$this->param['error'] = 'Change of temperature cannot be zero!';
			return $this->param;
		}
		// Unit Conversion
		if (is_numeric($q)) {
			if ($q_unit === 'kJ') {
				$q = $q / 0.001;
			} elseif ($q_unit === 'mJ') {
				$q = $q / 0.000001;
			} elseif ($q_unit === 'Wh') {
				$q = $q / 0.000277778;
			} elseif ($q_unit === 'kWh') {
				$q = $q / 0.000000277778;
			} elseif ($q_unit === 'ft-lbs') {
				$q = $q / 0.737562;
			} elseif ($q_unit === 'kcal') {
				$q = $q / 0.0002390057;
			} elseif ($q_unit === 'eV') {
				$q = $q / 6241534918267100245;
			}
		}
		if (is_numeric($it)) {
			if ($it_unit === '°F') {
				$it = $it / 1.8;
			}
		}
		if (is_numeric($ft)) {
			if ($ft_unit === '°F') {
				$ft = $ft / 1.8;
			}
		}
		if (is_numeric($dt)) {
			if ($dt_unit === '°F') {
				$dt = $dt / 1.8;
			}
		}
		if (is_numeric($m)) {
			if ($m_unit === 'µg') {
				$m = $m / 1000000000;
			} elseif ($m_unit === 'mg') {
				$m = $m / 1000000;
			} elseif ($m_unit === 'g') {
				$m = $m / 1000;
			} elseif ($m_unit === 't') {
				$m = $m / 0.001;
			} elseif ($m_unit === 'oz') {
				$m = $m / 35.27396;
			} elseif ($m_unit === 'lb') {
				$m = $m / 2.204623;
			} elseif ($m_unit === 'stone') {
				$m = $m / 0.157473;
			} elseif ($m_unit === 'US ton') {
				$m = $m / 0.001102311;
			} elseif ($m_unit === 'Long ton') {
				$m = $m / 0.000984207;
			} elseif ($m_unit === 'Earths') {
				$m = $m * 5972000000000000000000000;
			} elseif ($m_unit === 'me') {
				$m = $m / 1097769122809886380500592292548;
			} elseif ($m_unit === 'u') {
				$m = $m / 602214000000000000000000000;
			} elseif ($m_unit === 'oz t') {
				$m = $m / 32.15075;
			}
		}
		if (is_numeric($c)) {
			if ($c_unit === 'J/(g·K)' || $c_unit === 'J/(g·°C)') {
				$c = $c / 0.001;
			} elseif ($c_unit === 'cal/(kg·K)' || $c_unit === 'cal/(kg·°C)') {
				$c = $c / 0.2388915;
			} elseif ($c_unit === 'cal/(g·K)' || $c_unit === 'kcal/(kg·K)' || $c_unit === 'cal/(g·°C)' || $c_unit === 'kcal/(kg·°C)') {
				$c = $c / 0.0002388915;
			}
		}
		if ($find === 'energy' && $by === 'change' && is_numeric($dt) && is_numeric($m) && is_numeric($c)) {
			$s = $m * $c;
			$q = $s * $dt;
			$this->param['s'] = $s;
			$this->param['q'] = round($q, 3);
		} elseif ($find === 'energy' && $by === 'i_f_t' && is_numeric($it) && is_numeric($ft) && is_numeric($m) && is_numeric($c)) {
			$dt = $ft - $it;
			$s = $m * $c;
			$q = $s * $dt;
			$this->param['check'] = 'q_i_f';
			$this->param['s'] = $s;
			$this->param['q'] = round($q, 3);
		} elseif ($find === 'specific_heat' && $by === 'change' && is_numeric($q) && is_numeric($dt) && is_numeric($m)) {
			$s = $m * $dt;
			$c = $q / $s;
			$this->param['s'] = $s;
			$this->param['c'] = round($c, 3);
		} elseif ($find === 'specific_heat' && $by === 'i_f_t' && is_numeric($q) && is_numeric($it) && is_numeric($ft) && is_numeric($m)) {
			$dt = $ft - $it;
			$s = $m * $dt;
			$c = $q / $s;
			$this->param['check'] = 'c_i_f';
			$this->param['s'] = $s;
			$this->param['c'] = round($c, 3);
		} elseif ($find === 'mass' && $by === 'change' && is_numeric($q) && is_numeric($dt) && is_numeric($c)) {
			$s = $c * $dt;
			$m = $q / $s;
			$this->param['s'] = $s;
			$this->param['m'] = round($m, 3);
		} elseif ($find === 'mass' && $by === 'i_f_t' && is_numeric($q) && is_numeric($it) && is_numeric($ft) && is_numeric($c)) {
			$dt = $ft - $it;
			$s = $c * $dt;
			$m = $q / $s;
			$this->param['check'] = 'm_i_f';
			$this->param['s'] = $s;
			$this->param['m'] = round($m, 3);
		} elseif ($find === 'itemp' && is_numeric($q) && is_numeric($ft) && is_numeric($m) && is_numeric($c)) {
			$s = $m * $c;
			$s1 = $q / ($s);
			$it = $s1 - $ft;
			$this->param['s'] = $s;
			$this->param['s1'] = $s1;
			$this->param['it'] = round($it, 3);
		} elseif ($find === 'ftemp' && is_numeric($q) && is_numeric($it) && is_numeric($m) && is_numeric($c)) {
			$s = $m * $c;
			$s1 = $q / ($s);
			$ft = $s1 + $it;
			$this->param['s'] = $s;
			$this->param['s1'] = $s1;
			$this->param['ft'] = round($ft, 3);
		} else {
			$this->param['error'] = 'Please! Fill All The Fields!';
			return $this->param;
		}
		if ($sub != 'select') {
			$subs = explode('@', $sub);
			$sub_val = $subs[0];
			$sub_name = $subs[1];
		}
		if (isset($sub_val)) {
			$this->param['sub'] = $sub_val;
			$this->param['sub1'] = $sub_name;
		}
		$this->param['q1'] = $q;
		$this->param['it1'] = $it;
		$this->param['ft1'] = $ft;
		$this->param['dt1'] = $dt;
		$this->param['m1'] = $m;
		$this->param['c1'] = $c;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	public function instantaneous($request)
	{
		$i_d = trim($request['i_d']);
		$i_d_unit = trim($request['i_d_unit']);
		$f_d = trim($request['f_d']);
		$f_d_unit = trim($request['f_d_unit']);
		$i_tt = trim($request['i_tt']);
		$i_tt_unit = trim($request['i_tt_unit']);
		$f_tt = trim($request['f_tt']);
		$f_tt_unit = trim($request['f_tt_unit']);



		if (is_numeric($i_d)) {
			if ($i_d_unit === 'cm') {
				$i_d = $i_d / 100;
			} elseif ($i_d_unit === 'km') {
				$i_d = $i_d / 0.001;
			} elseif ($i_d_unit === 'in') {
				$i_d = $i_d / 39.37;
			} elseif ($i_d_unit === 'ft') {
				$i_d = $i_d / 3.281;
			} elseif ($i_d_unit === 'yd') {
				$i_d = $i_d / 1.0936;
			} elseif ($i_d_unit === 'mi') {
				$i_d = $i_d / 0.0006214;
			}
		}

		if (is_numeric($f_d)) {
			if ($f_d_unit === 'cm') {
				$f_d = $f_d / 100;
			} elseif ($f_d_unit === 'km') {
				$f_d = $f_d / 0.001;
			} elseif ($f_d_unit === 'in') {
				$f_d = $f_d / 39.37;
			} elseif ($f_d_unit === 'ft') {
				$f_d = $f_d / 3.281;
			} elseif ($f_d_unit === 'yd') {
				$f_d = $f_d / 1.0936;
			} elseif ($f_d_unit === 'mi') {
				$f_d = $f_d / 0.0006214;
			}
		}

		if (is_numeric($i_tt)) {
			if ($i_tt_unit === 'min') {
				$i_tt = $i_tt / 0.016667;
			} elseif ($i_tt_unit === 'hrs') {
				$i_tt = $i_tt / 0.0002778;
			}
		}
		if (is_numeric($f_tt)) {
			if ($f_tt_unit === 'min') {
				$f_tt = $f_tt / 0.016667;
			} elseif ($f_tt_unit === 'hrs') {
				$f_tt = $f_tt / 0.0002778;
			}
		}

		if (is_numeric($i_d) && is_numeric($f_d) && is_numeric($i_tt) && is_numeric($f_tt)) {
			// $f_t = ($i_d,$i_d_unit)
			$s1 = $f_d - $i_d;
			$s2 = $f_tt - $i_tt;
			$iv = ($s1) / ($s2);
			$this->param['method'] = 'iv';
			$this->param['iv'] = round($iv, 5);
			$this->param['id'] = round($i_d, 5);
			$this->param['fd'] = round($f_d, 5);
			$this->param['itt'] = round($i_tt, 5);
			$this->param['ftt'] = round($f_tt, 5);
			$this->param['s1'] = round($s1, 5);
			$this->param['s2'] = round($s2, 5);
		} else {
			$this->param['error'] = 'Please! Fill All The Fields!';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// public function instantaneous($request)
	// {
	// 	$position = $request->position;
	// 	$time = $request->time;
	// 	if (!empty($position) || $time === 0) {
	// 		$format = '{
	// 			"steps": [
	// 				"<p>steps here</p>",
	// 				// continue for more steps
	// 			]
	// 		}';
	// 		$prompt = "Use the instantaneous velocity calculator to find the instantaneous velocity of an object step-by-step when the position function is: $position at time: $time.
	// 		Note:
	// 		Provide short steps having small headings, and each step must be formatted properly in KaTeX for a better understanding. 
	// 		Don't provide additional explanations of steps! Also give me the answer's m/s.
	// 		";
	// 		$client = new Client();
	// 		$response = $client->post('https://api.openai.com/v1/chat/completions', [
	// 			'headers' => ['Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
	// 				'Content-Type' => 'application/json'
	// 			],
	// 			'json' => [
	// 				"model" => "gpt-4o-mini",
	// 				"response_format" => [
	// 					"type" => "text"
	// 				],
	// 				"max_tokens" => 3000,
	// 				"messages" => [
	// 					[
	// 						"role" => "user",
	// 						"content" => $prompt
	// 					]
	// 				]
	// 			]
	// 		]);

	// 		$data = json_decode($response->getBody()->getContents(), true);
	// 		$dataArray = $data['choices'][0]['message']['content'];
	// 		$this->param['dataArray'] = $dataArray;
	// 		return $this->param;
	// 	}else{
	// 		$this->param['error'] = 'Please! Enter Input.';
	// 		return $this->param;
	// 	}

	// }


	public function electric($request)
	{
	
		$charge = $request['charge'];
		$c_unit = trim($request['c_unit']);
		$distance = $request['distance'];
		$d_unit = trim($request['d_unit']);
		$selection = $request['selection'];
		$per = $request['per'];
		$distance1 = $request['distance1'];
		$charge1 = $request['charge1'];
		$selection3 = $request['selection3'];
		$field = $request['electric_field'];
		$charge_unit = ($request['charge_unit']);
		$distance_unit = ($request['distance_unit']);
		$d_unit_name = ["nm", "μm", "mm", "cm", "m", "km", "in", "ft", "yd", "mi"];
		$c_unit_name = ["PC", "NC", "μC", "mC", "C", "e"];
		$d_unit = array_search($d_unit, $d_unit_name);
		$d_unit++;
		$c_unit = array_search($c_unit, $c_unit_name);
		$c_unit++;
		if (is_numeric($charge) && is_numeric($distance) && is_numeric($per) && $charge != 0 && $distance > 0 && $per != 0) {
			if ($selection == "1") {
				if ($selection3 == "1") {
					if ($c_unit == "1") {
						$convert = $charge * 0.000001;
					} else if ($c_unit == "2") {
						$convert = $charge * 0.000000001;
					} else if ($c_unit == "3") {
						$convert = $charge * 0.000001;
					} else if ($c_unit == "4") {
						$convert = $charge * 0.001;
					} else if ($c_unit == "5") {
						$convert = $charge * 1;
					} else if ($c_unit == "6") {
						$convert = $charge * 1.60218e-19;
					}
					//Convert Distance Unit
					if ($d_unit == "1") {
						$convert2 = $distance * 0.000000001;
					} else if ($d_unit == "2") {
						$convert2 = $distance * 0.000001;
					} else if ($d_unit == "3") {
						$convert2 = $distance * 0.001;
					} else if ($d_unit == "4") {
						$convert2 = $distance * 0.01;
					} else if ($d_unit == "5") {
						$convert2 = $distance * 1;
					} else if ($d_unit == "6") {
						$convert2 = $distance * 1000;
					} else if ($d_unit == "7") {
						$convert2 = $distance * 0.0254;
					} else if ($d_unit == "8") {
						$convert2 = $distance * 0.3048;
					} else if ($d_unit == "9") {
						$convert2 = $distance * 0.9144;
					} else if ($d_unit == "10") {
						$convert2 = $distance * 1609.3;
					}
					$field3 = (8.9875517923e9 * $convert) / ($convert2 * $convert2) / ($per);
					$this->param['answer'] = $field3;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else if ($selection3 == "2") {
					if ($c_unit == "1") {
						$convert = $charge * 0.000001;
					} else if ($c_unit == "2") {
						$convert = $charge * 0.000000001;
					} else if ($c_unit == "3") {
						$convert = $charge * 0.000001;
					} else if ($c_unit == "4") {
						$convert = $charge * 0.001;
					} else if ($c_unit == "5") {
						$convert = $charge * 1;
					} else if ($c_unit == "6") {
						$convert = $charge * 1.60218e-19;
					}
					$distance_formula = (((8.9875517923e9 * $convert) / ($field)) / ($per));
					$sqrt = sqrt($distance_formula);
					$this->param['answer1'] = $sqrt;
					$this->param['RESULT'] = 1;
					return $this->param;
				} else if ($selection3 == "3") {
					if ($d_unit == "1") {
						$convert2 = $distance * 0.000000001;
					} else if ($d_unit == "2") {
						$convert2 = $distance * 0.000001;
					} else if ($d_unit == "3") {
						$convert2 = $distance * 0.001;
					} else if ($d_unit == "4") {
						$convert2 = $distance * 0.01;
					} else if ($d_unit == "5") {
						$convert2 = $distance * 1;
					} else if ($d_unit == "6") {
						$convert2 = $distance * 1000;
					} else if ($d_unit == "7") {
						$convert2 = $distance * 0.0254;
					} else if ($d_unit == "8") {
						$convert2 = $distance * 0.3048;
					} else if ($d_unit == "9") {
						$convert2 = $distance * 0.9144;
					} else if ($d_unit == "10") {
						$convert2 = $distance * 1609.3;
					}
					$charge_formula = ((($field) * ($convert2 * $convert2) / (8.9875517923e9)) / ($per));
					$this->param['answer2'] = $charge_formula;
					$this->param['RESULT'] = 1;
					return $this->param;
				}
			} //Selection 1 Condition End

		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		if ($selection == "2") {
			$formula2 = 0;
			$sum = 0;
			$sum2 = 0;
			$i = 0;
			$final_answer = 0;
			$c1 = count($charge1);
			$d1 = count($distance1);
			while ($i < $c1 && $i < $d1) {
				if (is_numeric($charge1[$i]) && is_numeric($distance1[$i]) && $charge1[$i] > 0 && $distance1[$i] > 0) {
					$value1 = $charge1[$i];
					$value2 = $charge_unit[$i];
					$value2 = array_search($value2, $c_unit_name);
					$value2++;
					if ($value2 == "1") {
						$con = $value1 * 0.000001;
					} else if ($value2 == "2") {
						$con = $value1 * 0.000000001;
					} else if ($value2 == "3") {
						$con = $value1 * 0.000001;
					} else if ($value2 == "4") {
						$con = $value1 * 0.001;
					} else if ($value2 == "5") {
						$con = $value1 * 1;
					} else if ($value2 == "6") {
						$con = $value1 * 1.60218e-19;
					}
					$value3 = $distance1[$i];
					$value4 = $distance_unit[$i];
					$value4 = array_search($value4, $d_unit_name);
					$value4++;
					if ($value4 == "1") {
						$con2 = $value3 * 0.000000001;
					} else if ($value4 == "2") {
						$con2 = $value3 * 0.000001;
					} else if ($value4 == "3") {
						$con2 = $value3 * 0.001;
					} else if ($value4 == "4") {
						$con2 = $value3 * 0.01;
					} else if ($value4 == "5") {
						$con2 = $value3 * 1;
					} else if ($value4 == "6") {
						$con2 = $value3 * 1000;
					} else if ($value4 == "7") {
						$con2 = $value3 * 0.0254;
					} else if ($value4 == "8") {
						$con2 = $value3 * 0.3048;
					} else if ($value4 == "9") {
						$con2 = $value3 * 0.9144;
					} else if ($value4 == "10") {
						$con2 = $value3 * 1609.3;
					}
					$i++;
					$formula2 = $formula2 + ((8.9875517923e9 * $con) / ($con2 * $con2));
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
			if (is_numeric($charge) && is_numeric($distance) && is_numeric($per) && $charge > 0 && $distance > 0 && $per > 0) {
				if ($c_unit == "1") {
					$convert = $charge * 0.000001;
				} else if ($c_unit == "2") {
					$convert = $charge * 0.000000001;
				} else if ($c_unit == "3") {
					$convert = $charge * 0.000001;
				} else if ($c_unit == "4") {
					$convert = $charge * 0.001;
				} else if ($c_unit == "5") {
					$convert = $charge * 1;
				} else if ($c_unit == "6") {
					$convert = $charge * 1.60218e-19;
				}
				//Convert Distance Unit
				if ($d_unit == "1") {
					$convert2 = $distance * 0.000000001;
				} else if ($d_unit == "2") {
					$convert2 = $distance * 0.000001;
				} else if ($d_unit == "3") {
					$convert2 = $distance * 0.001;
				} else if ($d_unit == "4") {
					$convert2 = $distance * 0.01;
				} else if ($d_unit == "5") {
					$convert2 = $distance * 1;
				} else if ($d_unit == "6") {
					$convert2 = $distance * 1000;
				} else if ($d_unit == "7") {
					$convert2 = $distance * 0.0254;
				} else if ($d_unit == "8") {
					$convert2 = $distance * 0.3048;
				} else if ($d_unit == "9") {
					$convert2 = $distance * 0.9144;
				} else if ($d_unit == "10") {
					$convert2 = $distance * 1609.3;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
			$convert = $sum + $convert;
			$convert2 = $sum2 + $convert2;
			$field2 = ((8.9875517923e9 * $convert) / ($convert2 * $convert2) / ($per)) + $formula2;
			//echo"The value of the field is".$field2;
			$this->param['answer3'] = $field2;
			$this->param['RESULT'] = 1;
			return $this->param;
		}
	}
	// Gear Ratio Calculator
	public function gear($request)
	{
		$type = $request['type'];
		$f_first = $request['f_first'];
		$f_second = $request['f_second'];
		$f_third = $request['f_third'];
		$ft_unit = $request['ft_unit'];
		$f_four = $request['f_four'];
		$ff_unit = $request['ff_unit'];
		$transmissions = $request['transmissions'];
		$s_first = $request['s_first'];
		$s_second = $request['s_second'];
		$s_third = $request['s_third'];
		$s_four = $request['s_four'];
		$s_five = $request['s_five'];
		$s_six = $request['s_six'];
		function round_num($n, $places)
		{
			$tens = 1;
			while ($places > 0) {
				$tens = $tens * 10;
				$places--;
			}
			$n = $n * ($tens);
			$n = round($n);
			$n = $n / ($tens);
			return $n;
		}
		function GetNumber($n)
		{
			if ($n > 0) {
				return $n;
			} else {
				return '0';
			}
		}
		function rotation($a, $b)
		{
			if ($a == "rpm") {
				$convert1 = $b * 1;
			} elseif ($a == "rad/s") {
				$convert1 = $b * 9.55;
			} elseif ($a == "Hz") {
				$convert1 = $b * 60;
			}
			return $convert1;
		}
		function torque($a, $b)
		{
			if ($a == "Nm") {
				$convert2 = $b * 1;
			} elseif ($a == "kg-cm") {
				$convert2 = $b * 0.09807;
			} elseif ($a == "J/rad") {
				$convert2 = $b * 1;
			} elseif ($a == "ft-lb") {
				$convert2 = $b * 1.3558;
			}
			return $convert2;
		}
		$f_third = rotation($ft_unit, $f_third);
		$f_four = torque($ff_unit, $f_four);
		if ($type == "first") {
			if (is_numeric($f_first) && is_numeric($f_second) && is_numeric($f_third) && is_numeric($f_four)) {
				if ($f_first >= 3) {
					if ($f_second >= 3) {
						$gear_ratio = $f_first / $f_second;
						$mechanical = $f_second / $f_first;
						$output_rot = $gear_ratio * $f_third;
						$output_tor = $mechanical * $f_four;
						$this->param['gear_ratio'] = $gear_ratio;
						$this->param['mechanical'] = $mechanical;
						$this->param['output_rot'] = $output_rot;
						$this->param['output_tor'] = $output_tor;
					} else {
						$this->param['error'] = 'This calculator only determines gear ratios for gears with 3 or more teeth.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'This calculator is limited to gears with 3 or more teeth.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($type == "second") {
			if (is_numeric($s_first) && is_numeric($s_second) && is_numeric($s_third) && is_numeric($s_four) && is_numeric($s_five) && is_numeric($s_six)) {
				if ($transmissions == 'T-5 2.95 - .63') {
					$transratio1_value = '2.95';
					$transratio2_value = '1.94';
					$transratio3_value = '1.34';
					$transratio4_value = '1.00';
					$transratio5_value = '.63';
					$transratio6_value = '';
				} else if ($transmissions == 'Magnum XL 2.66 - .50') {
					$transratio1_value = '2.66';
					$transratio2_value = '1.78';
					$transratio3_value = '1.30';
					$transratio4_value = '1.00';
					$transratio5_value = '.74';
					$transratio6_value = '.50';
				} else if ($transmissions == 'Magnum XL 2.97 - .63') {
					$transratio1_value = '2.97';
					$transratio2_value = '2.10';
					$transratio3_value = '1.46';
					$transratio4_value = '1.00';
					$transratio5_value = '.80';
					$transratio6_value = '.63';
				} else if ($transmissions == 'Magnum 2.66 - .63') {
					$transratio1_value = '2.66';
					$transratio2_value = '1.78';
					$transratio3_value = '1.30';
					$transratio4_value = '1.00';
					$transratio5_value = '.80';
					$transratio6_value = '.63';
				} else if ($transmissions == 'Magnum 2.97 - .50') {
					$transratio1_value = '2.97';
					$transratio2_value = '2.10';
					$transratio3_value = '1.46';
					$transratio4_value = '1.00';
					$transratio5_value = '.74';
					$transratio6_value = '.50';
				} else if ($transmissions == 'Magnum-F 2.66 - .63') {
					$transratio1_value = '2.66';
					$transratio2_value = '1.78';
					$transratio3_value = '1.30';
					$transratio4_value = '1.00';
					$transratio5_value = '.80';
					$transratio6_value = '.63';
				} else if ($transmissions == 'Magnum-F 2.97 - .63') {
					$transratio1_value = '2.97';
					$transratio2_value = '2.10';
					$transratio3_value = '1.46';
					$transratio4_value = '1.00';
					$transratio5_value = '.80';
					$transratio6_value = '.63';
				} else if ($transmissions == 'Magnum-F 2.66 - .50') {
					$transratio1_value = '2.66';
					$transratio2_value = '1.78';
					$transratio3_value = '1.30';
					$transratio4_value = '1.00';
					$transratio5_value = '.74';
					$transratio6_value = '.50';
				} else if ($transmissions == 'Magnum-F 2.97 - .50') {
					$transratio1_value = '2.97';
					$transratio2_value = '2.10';
					$transratio3_value = '1.46';
					$transratio4_value = '1.00';
					$transratio5_value = '.74';
					$transratio6_value = '.50';
				} else if ($transmissions == 'TKO-500 3.27 - .68') {
					$transratio1_value = '3.27';
					$transratio2_value = '1.98';
					$transratio3_value = '1.34';
					$transratio4_value = '1.00';
					$transratio5_value = '.68';
					$transratio6_value = '';
				} else if ($transmissions == 'TKO-600 2.87 - .64') {
					$transratio1_value = '2.87';
					$transratio2_value = '1.89';
					$transratio3_value = '1.28';
					$transratio4_value = '1.00';
					$transratio5_value = '.64';
					$transratio6_value = '';
				} else if ($transmissions == 'TKO-600 2.87 - .82') {
					$transratio1_value = '2.87';
					$transratio2_value = '1.89';
					$transratio3_value = '1.28';
					$transratio4_value = '1.00';
					$transratio5_value = '.82';
					$transratio6_value = '';
				} else if ($transmissions == 'TKX 3.27 - .72') {
					$transratio1_value = '3.27';
					$transratio2_value = '1.98';
					$transratio3_value = '1.34';
					$transratio4_value = '1.00';
					$transratio5_value = '.72';
					$transratio6_value = '';
				} else if ($transmissions == 'TKX 2.87 - .81') {
					$transratio1_value = '2.87';
					$transratio2_value = '1.89';
					$transratio3_value = '1.28';
					$transratio4_value = '1.00';
					$transratio5_value = '.81';
					$transratio6_value = '';
				} else if ($transmissions == 'TKX 2.87 - .68') {
					$transratio1_value = '2.87';
					$transratio2_value = '1.89';
					$transratio3_value = '1.28';
					$transratio4_value = '1.00';
					$transratio5_value = '.68';
					$transratio6_value = '';
				} else if ($transmissions == 'GM Muncie 2.20 - 1.00') {
					$transratio1_value = '2.20';
					$transratio2_value = '1.64';
					$transratio3_value = '1.28';
					$transratio4_value = '1.00';
					$transratio5_value = '';
					$transratio6_value = '';
				} else if ($transmissions == 'Ford Toploader 2.32 - 1.00') {
					$transratio1_value = '2.32';
					$transratio2_value = '1.69';
					$transratio3_value = '1.29';
					$transratio4_value = '1.00';
					$transratio5_value = '';
					$transratio6_value = '';
				} else if ($transmissions == 'Ford Toploader 2.78 - 1.00') {
					$transratio1_value = '2.78';
					$transratio2_value = '1.93';
					$transratio3_value = '1.36';
					$transratio4_value = '1.00';
					$transratio5_value = '';
					$transratio6_value = '';
				} else if ($transmissions == 'A-833 HEMI 4-Speed 2.44 - 1.00') {
					$transratio1_value = '2.44';
					$transratio2_value = '1.77';
					$transratio3_value = '1.34';
					$transratio4_value = '1.00';
					$transratio5_value = '';
					$transratio6_value = '';
				}
				$GearFactor = ($s_first * $s_third * 0.002975) / $s_second;
				$mph1 = GetNumber(round_num($GearFactor / $transratio1_value, 2));
				$mph2 = GetNumber(round_num($GearFactor / $transratio2_value, 2));
				$mph3 = GetNumber(round_num($GearFactor / $transratio3_value, 2));
				$mph4 = GetNumber(round_num($GearFactor / $transratio4_value, 2));
				$mph5 = GetNumber(round_num($GearFactor / $transratio5_value, 2));
				$mph6 = GetNumber(round_num($GearFactor / $transratio6_value, 2));
				$mph1_value = $mph1;
				if (GetNumber($mph2) > 0) {
					$mph2_value = $mph2;
				} else {
					$mph2_value = '';
				}
				if (GetNumber($mph3) > 0) {
					$mph3_value = $mph3;
				} else {
					$mph3_value = '';
				}
				if (GetNumber($mph4) > 0) {
					$mph4_value = $mph4;
				} else {
					$mph4_value = '';
				}
				if (GetNumber($mph5) > 0) {
					$mph5_value = $mph5;
				} else {
					$mph5_value = '';
				}
				if (GetNumber($mph6) > 0) {
					$mph6_value = $mph6;
				} else {
					$mph6_value = '';
				}
				$height = $s_four / 25.4 * $s_six / 100 * 2 + $s_five;
				$width = $s_four / 25.4;
				$this->param['height'] = $height;
				$this->param['width'] = $width;
				$this->param['mph1_value'] = $mph1_value;
				$this->param['mph2_value'] = $mph2_value;
				$this->param['mph3_value'] = $mph3_value;
				$this->param['mph4_value'] = $mph4_value;
				$this->param['mph5_value'] = $mph5_value;
				$this->param['mph6_value'] = $mph6_value;
				$this->param['transratio1_value'] = $transratio1_value;
				$this->param['transratio2_value'] = $transratio2_value;
				$this->param['transratio3_value'] = $transratio3_value;
				$this->param['transratio4_value'] = $transratio4_value;
				$this->param['transratio5_value'] = $transratio5_value;
				$this->param['transratio6_value'] = $transratio6_value;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
		$this->param['type'] = $type;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function tension($request)
	{
		$type = $request['type'];
		$operations1 = $request['operations1'];
		$operations2 = $request['operations2'];
		$first = $request['first'];
		$unit1 = $request['unit1'];
		$second = $request['second'];
		$unit2 = $request['unit2'];
		$third = $request['third'];
		$unit3 = $request['unit3'];
		$four = $request['four'];
		$unit4 = $request['unit4'];
		$five = $request['five'];
		$unit5 = $request['unit5'];
		$six = $request['six'];
		$unit6 = $request['unit6'];
		$seven = $request['seven'];
		$unit7 = $request['unit7'];
		function kilo($a, $b)
		{
			if ($a == "mg") {
				$convert = $b / 1000000;
			} elseif ($a == "g") {
				$convert = $b / 1000;
			} elseif ($a == "kg") {
				$convert = $b * 1;
			} elseif ($a == "t") {
				$convert = $b *  1000;
			} elseif ($a == "oz") {
				$convert = $b / 35.274;
			} elseif ($a == "lb") {
				$convert = $b / 2.205;
			}
			return $convert;
		}
		function meter($a, $b)
		{
			if ($a == "m/s²") {
				$convert2 = $b * 1;
			} elseif ($a == "g") {
				$convert2 = $b * 9.807;
			} elseif ($a == "ft/s²") {
				$convert2 = $b * 0.3048;
			}
			return $convert2;
		}
		function degree($a, $b)
		{
			if ($a == "deg") {
				$convert3 = $b * 1;
			} elseif ($a == "rad") {
				$convert3 = $b * 57.296;
			} elseif ($a == "gon") {
				$convert3 = $b * 0.9;
			}
			return $convert3;
		}
		function newton($a, $b)
		{
			if ($a == "N") {
				$convert4 = $b * 1;
			} elseif ($a == "kN") {
				$convert4 = $b * 1000;
			} elseif ($a == "MN") {
				$convert4 = $b * 1000000;
			} elseif ($a == "lbf") {
				$convert4 = $b * 4.44822;
			} elseif ($a == "kip") {
				$convert4 = $b * 4448.2216;
			}
			return $convert4;
		}
		$first = kilo($unit1, $first);
		$second = kilo($unit2, $second);
		$third = kilo($unit3, $third);
		$four = meter($unit4, $four);
		$five = degree($unit5, $five);
		$six = degree($unit6, $six);
		$seven = newton($unit7, $seven);
		if ($type == "1") {
			if ($operations1 == "1") {
				if (is_numeric($first) && is_numeric($four)) {
					if ($first > 0) {
						if ($four > 0) {
							$weight = $first * $four;
							$t_ans = $weight;
							$this->param['weight'] = $weight;
							$this->param['t_ans'] = $t_ans;
						} else {
							$this->param['error'] = 'Please input a gravitational acceleration that is greater than 0.';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Please input a positive value for the object\'s mass.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($operations1 == "2") {
				$answer1 = $first * $four;
				$cos_a = cos(deg2rad($five));
				$sin_b = sin(deg2rad($six));
				$cos_b = cos(deg2rad($six));
				$sin_a = sin(deg2rad($five));
				$multiply = $cos_a * $sin_b;
				$divide = $multiply / $cos_b;
				$t1 = $divide + $sin_a;
				$t1_ans = $answer1 / $t1;
				$multiply2 = $cos_b * $sin_a;
				$divide2 = $multiply2 / $cos_a;
				$t2 = $divide2 + $sin_b;
				$t2_ans = $answer1 / $t2;
				$this->param['weight2'] = $answer1;
				$this->param['t1_ans'] = $t1_ans;
				$this->param['t2_ans'] = $t2_ans;
			}
		} elseif ($type == "2") {
			if ($operations2 == "1") {
				if (is_numeric($first) && is_numeric($five) && is_numeric($seven)) {
					if ($first > 0) {
						if ($five > 0 && $five < 90) {
							if ($seven > 0) {
								$cos = cos(deg2rad($five));
								$mul = $cos * $seven;
								$ans = $mul / $first;
								$answer2 = $seven;
								$this->param['ans'] = $ans;
								$this->param['op21'] = $answer2;
							} else {
								$this->param['error'] = 'Acceleration must be of positive value.';
								return $this->param;
							}
						} else {
							$this->param['error'] = 'Please enter a positive value for angle θ that is also less than 90 degrees.';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Please enter a positive value for mass.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($operations2 == "2") {
				if (is_numeric($first) && is_numeric($second) && is_numeric($five) && is_numeric($seven)) {
					if ($first > 0) {
						if ($second > 0) {
							if ($five > 0 && $five < 90) {
								if ($seven > 0) {
									$both_add = $first + $second;
									$answer2 = $seven;
									$cos = cos(deg2rad($five));
									$mul = $cos * $seven;
									$ans = $mul / $both_add;
									$answer = $seven;
									$answer2 = $ans * $second;
									$this->param['ans'] = $ans;
									$this->param['op22'] = $answer;
									$this->param['answer2'] = $answer2;
								} else {
									$this->param['error'] = 'Acceleration must be of positive value.';
									return $this->param;
								}
							} else {
								$this->param['error'] = 'Please enter a positive value for angle θ that is also less than 90 degrees.';
								return $this->param;
							}
						} else {
							$this->param['error'] = 'Please enter a positive value for second mass';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Please enter a positive value for first mass.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			} else if ($operations2 == "3") {
				if (is_numeric($first) && is_numeric($third) && is_numeric($second) && is_numeric($five) && is_numeric($seven)) {
					if ($first > 0) {
						if ($second > 0) {
							if ($five > 0 && $five < 90) {
								if ($seven > 0) {
									if ($third > 0) {
										$both_add = $first + $second + $third;
										$answer2 = $seven;
										$cos = cos(deg2rad($five));
										$mul = $cos * $seven;
										$ans = $mul / $both_add;
										$answer2 = $seven;
										$answer3 = $ans * ($second + $third);
										$answer4 = $ans * $third;
										$this->param['ans'] = $ans;
										$this->param['answer2'] = $answer2;
										$this->param['op23'] = $answer3;
										$this->param['answer4'] = $answer4;
									} else {
										$this->param['error'] = 'Please enter a positive value for third mass.';
										return $this->param;
									}
								} else {
									$this->param['error'] = 'Acceleration must be of positive value.';
									return $this->param;
								}
							} else {
								$this->param['error'] = 'Please enter a positive value for angle θ that is also less than 90 degrees.';
								return $this->param;
							}
						} else {
							$this->param['error'] = 'Please enter a positive value for second mass';
							return $this->param;
						}
					} else {
						$this->param['error'] = 'Please enter a positive value for first mass.';
						return $this->param;
					}
				} else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	public function terminal($request)
	{
		
		$shapes = $request['shapes'];
		$mass = $request['mass'];
		$mass_unit = $request['mass_unit'];
		$area = $request['area'];
		$area_unit = $request['area_unit'];
		$drag_coefficient = $request['drag_coefficient'];
		$density = $request['density'];
		$density_unit = $request['density_unit'];
		$gravity = $request['gravity'];
		$gravity_unit = $request['gravity_unit'];
		function mass($mass_value, $mass_unit)
		{
			if ($mass_unit == "mg") {
				$value1 = $mass_value * 0.000001;
			} else if ($mass_unit == "g") {
				$value1 = $mass_value * 0.001;
			} else if ($mass_unit == "kg") {
				$value1 = $mass_value * 1;
			} else if ($mass_unit == "t") {
				$value1 = $mass_value * 1000;
			} else if ($mass_unit == "gr") {
				$value1 = $mass_value * 0.0000648;
			} else if ($mass_unit == "oz") {
				$value1 = $mass_value * 0.02835;
			} else if ($mass_unit == "lb") {
				$value1 = $mass_value * 0.4536;
			}
			return $value1;
		}
		function area($area_value, $area_unit)
		{
			if ($area_unit == "mm²") {
				$value2 = $area_value * 0.000001;
			} else if ($area_unit == "cm²") {
				$value2 = $area_value * 0.001;
			} else if ($area_unit == "m²") {
				$value2 = $area_value * 1;
			} else if ($area_unit == "in²") {
				$value2 = $area_value * 1000;
			} else if ($area_unit == "yd²") {
				$value2 = $area_value * 0.0000648;
			}
			return $value2;
		}
		function fluid($fluid_value, $fluid_unit)
		{
			if ($fluid_unit == "kg/m³") {
				$value3 = $fluid_value * 1;
			} else if ($fluid_unit == "lb cu/ft") {
				$value3 = $fluid_value * 16.02;
			} else if ($fluid_unit == "g/cm³") {
				$value3 = $fluid_value * 1000;
			} else if ($fluid_unit == "kg/cm³") {
				$value3 = $fluid_value * 1000000;
			}
			return $value3;
		}
		function gravitys($gravity_value, $gravity_unit)
		{
			if ($gravity_unit == "m/s²") {
				$value4 = $gravity_value * 1;
			} else if ($gravity_unit == "ft/s²") {
				$value4 = $gravity_value * 0.3048;
			}
			return $value4;
		}
		if (is_numeric($mass) && is_numeric($area) && is_numeric($drag_coefficient) && is_numeric($density) && is_numeric($gravity) && $mass > 0 && $area > 0 && $drag_coefficient > 0 && $density > 0 && $gravity > 0) {
			$m = mass($mass, $mass_unit);
			$a = area($area, $area_unit);
			$f = fluid($density, $density_unit);
			$d = gravitys($gravity, $gravity_unit);
			$terminal_velocity = sqrt((2 * $m * $d) / ($f * $a * $drag_coefficient));
			$drag_coefficient_area = $a * $drag_coefficient;
		} else {
			$this->param['error'] = 'Please! Check Your Input';
			return $this->param;
		}
		$this->param['terminal_velocity'] = $terminal_velocity;
		$this->param['drag_coefficient_area'] = $drag_coefficient_area;
		$this->param['RESULT'] = 1;
		return $this->param;
	}
	// velocity calculator
	function velocity($request){
		$velo_value = $request['velo_value'];
		$dem = $request['dem'];
		$collection = $request['collection'];
		$dis1_unit = $request['dis_unit'];
		$time_unit = $request['time_unit'];
		$val_unit = $request['val_unit'];
		$val_units = $request['val_units'];
		
		$iv_unit = $request['iv_unit'];
		$acc_unit = $request['acc_unit'];
		$atime_unit = $request['atime_unit'];
		$fv_unit = $request['fv_unit'];
		if($velo_value == '1'){
			$distance = $request['x'];
			$time = $request['y'];
			$velocity = $request['vel'];
			function velocityfun($velocity, $units) {
				if ($units == 'km/h') {
					$converted_velocities = $velocity / 3.6;
				} elseif ($units == 'ft/s') {
					$converted_velocities = $velocity / 3.28084;
				} elseif ($units == 'mph') {
					$converted_velocities = $velocity / 2.23694;
				} elseif ($units == 'kn') {
					$converted_velocities = $velocity /  1.94384;
				} elseif ($units == 'ft/m') {
					$converted_velocities = $velocity /  196.8504;
				}elseif ($units == 'cm/s') {
					$converted_velocities = $velocity / 100;
				}elseif ($units == 'm/min') {
					$converted_velocities = $velocity / 60;
				}else {
					$converted_velocities = $velocity;
				}
				
				return $converted_velocities;
			}
			function convertTime($time, $units) {
				if ($units === 'min') {
					$converted_times = $time * 60; // Convert minutes to seconds
				} elseif ($units === 'hrs') {
					$converted_times = $time * 3600; // Convert hours to seconds
				}elseif ($units === 'days') {
					$converted_times = $time * 86400; // Convert hours to seconds
				}elseif ($units === 'wks') {
					$converted_times = $time * 604800; // Convert hours to seconds
				}elseif ($units === 'mon') {
					$converted_times = $time * 2.628e+6; // Convert hours to seconds
				}elseif ($units === 'yrs') {
					$converted_times = $time * 3.154e+7; // Convert hours to seconds
				}else {
					$converted_times = $time;
				}
				return $converted_times ;
			}
			function distancefun($a, $b) {
				if ($b == "cm") {
					$distances = $a / 100; // Convert cm to meters
				} elseif ($b == "km") {
					$distances = $a * 1000; // Convert km to meters
				} elseif ($b == "in") {
					$distances = $a * 0.0254; // Convert inches to meters
				} elseif ($b == "ft") {
					$distances = $a * 0.3048; // Convert feet to meters
				} elseif ($b == "yd") {
					$distances = $a * 0.9144; // Convert yards to meters
				} elseif ($b == "mi") {
					$distances = $a * 1609.34; // Convert miles to meters
				} else {
					$distances = $a; // Assume meters
				}
				return (int)$distances;
			}

			$distances = distancefun($distance, $dis1_unit);
			$velocitys = velocityfun($velocity, $val_units);
			$times = convertTime($time, $time_unit);
			if ($dem == 'dc') { // Distance Calculation
				$ans = round($velocitys * $times, 4);
				$this->param['ans_t'] = "Distance";
			} elseif ($dem == 'av') {
				if ($times == 0) {
					$ans = 0; 
				} else {
					$ans = round($distances / $times, 4);
				}
				$this->param['ans_t'] = "Velocity";
			} else { 
				if ($velocitys == 0) {
					$ans = "Infinity"; 
				} else {
					$ans = round($distances / $velocitys, 4);
				}
				$this->param['ans_t'] = "Time";
			}
			$this->param['ans'] = $ans;
			return $this->param;
		}elseif($velo_value == '3'){
			$vs = $request->z;
			$vs_unit = $request->val_unit;
			$avt = $request->aty;
			$avt_unit = $request->ytime_unit;

			function velocity($velocities, $units) {
				$converted_velocities = [];
				foreach ($velocities as $index => $value) {
					$unit = isset($units[$index]) ? $units[$index] : '';
					if ($unit == 'km/h') {
						$converted_velocities[] = $value / 3.6;
					} elseif ($unit == 'ft/s') {
						$converted_velocities[] = $value / 3.28084;
					} elseif ($unit == 'mph') {
						$converted_velocities[] = $value / 2.23694;
					} elseif ($unit == 'kn') {
						$converted_velocities[] = $value /  1.94384;
					} elseif ($unit == 'ft/m') {
						$converted_velocities[] = $value /  196.8504;
					}elseif ($unit == 'cm/s') {
						$converted_velocities[] = $value / 100;
					}elseif ($unit == 'm/min') {
						$converted_velocities[] = $value / 60;
					}else {
						$converted_velocities[] = $value;
					}
				}
				
				return $converted_velocities;
			}
		
			$vs = velocity($vs, $vs_unit);

			function convertTime($times, $units) {
				$converted_times = [];
				
				foreach ($times as $index => $value) {
					$unit = isset($units[$index]) ? $units[$index] : '';

					if ($unit === 'min') {
						$converted_times[] = $value * 60; // Convert minutes to seconds
					} elseif ($unit === 'hrs') {
						$converted_times[] = $value * 3600; // Convert hours to seconds
					}elseif ($unit === 'days') {
						$converted_times[] = $value * 86400; // Convert hours to seconds
					}elseif ($unit === 'wks') {
						$converted_times[] = $value * 604800; // Convert hours to seconds
					}elseif ($unit === 'mon') {
						$converted_times[] = $value * 2.628e+6; // Convert hours to seconds
					}elseif ($unit === 'yrs') {
						$converted_times[] = $value * 3.154e+7; // Convert hours to seconds
					}
					else {
						$converted_times[] = $value;
					}
				}
				
				return $converted_times;
			}

			$avt = convertTime($avt, $avt_unit);


			if (is_array($vs) && is_array($avt)) {
				$total_time = array_sum($avt);
				$weighted_sum = 0;
				
				foreach ($vs as $key => $velocity) {
					// dd($vs,$avt);
					if (is_numeric((int)$velocity) && is_numeric((int)$avt[$key])) {
						$weighted_sum += $velocity * $avt[$key];
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
				}

				if ($total_time > 0) {
					$average_velocity = $weighted_sum / $total_time;
					$ans = round($average_velocity,4);
					$unit = "m/s";
				} else {
					$this->param['error'] = 'Total time must be greater than zero';
					return $this->param;
				}
				$this->param['unit'] = $unit;
				$this->param['ans_t'] = "Avrage Velocity";
			}
			$this->param['ans'] = $ans;
			return $this->param;
		}elseif($velo_value == '2'){
			if($collection == '1'){
				$a = $request['acc'];
				if ($acc_unit === "ft/s²") {
					$a = $a * 0.3048;
				}
				if ($acc_unit === "in/s²") {
					$a = $a * 0.0254;
				}
				if ($acc_unit === "cm/s²") {
					$a = $a * 0.01;
				}
				if ($acc_unit === "mi/s²") {
					$a = $a * 1609.344;
				}
				if ($acc_unit === "mi/s²") {
					$a = $a * 1609.344;
				}
				if ($acc_unit === "km/s²") {
					$a = $a * 100;
				}
				if ($acc_unit === "g") {
					$a = $a * 0.10197162129779;
				}
				$time = $request['y1'];
				if ($atime_unit === 'min') {
					$time = $time * 60;
				}
				if ($atime_unit === 'hrs') {
					$time = $time * 3600;
				}
				if ($atime_unit === 'days') {
					$time = $time * 86400;
				}
				if ($atime_unit === 'wks') {
					$time = $time * 604800;
				}
				if ($atime_unit === 'mos') {
					$time = $time *  2.628e+6;
				}
				if ($atime_unit === 'yrs') {
					$time = $time * 3.154e+7;
				}
				$fv = $request['z1'];
				if ($fv_unit === 'm/s') {
					$fv = $fv ;
				}
				if ($fv_unit === 'km/h') {
					$fv = $fv / 3.6;
				}
				if ($fv_unit === 'ft/s') {
					$fv = $fv / 3.28084;
				}
				if ($fv_unit === 'mph') {
					$fv = $fv / 2.23694;
				}
				if ($fv_unit === 'kn') {
					$fv = $fv / 1.94384;
				}
				if ($fv_unit === 'ft/m') {
					$fv = $fv / 196.8504;
				}
				if ($fv_unit === 'cm/s') {
					$fv = $fv / 100;
				}
				if ($fv_unit === 'm/min') {
					$fv = $fv / 60;
				}
				$this->param['ans_t'] = "Velocity";
				$ans = round(($fv - ($a * $time)), 4);
				$unit = "m/s";
			}elseif($collection == '2'){
				$time = $request['y1'];
				if ($atime_unit === 'min') {
					$time = $time * 60;
				}
				if ($atime_unit === 'hrs') {
					$time = $time * 3600;
				}
				if ($atime_unit === 'days') {
					$time = $time * 86400;
				}
				if ($atime_unit === 'wks') {
					$time = $time * 604800;
				}
				if ($atime_unit === 'mos') {
					$time = $time *  2.628e+6;
				}
				if ($atime_unit === 'yrs') {
					$time = $time * 3.154e+7;
				}
				$iv = $request['x1'];
				if ($iv_unit === 'km/h') {
					$iv = $iv / 3.6;
				}
				if ($iv_unit === 'ft/s') {
					$iv = $iv / 3.28084;
				}
				if ($iv_unit === 'mph') {
					$iv = $iv / 2.23694;
				}
				if ($iv_unit === 'kn') {
					$iv = $iv / 1.94384;
				}
				if ($iv_unit === 'ft/m') {
					$iv = $iv / 196.8504;
				}
				if ($iv_unit === 'cm/s') {
					$iv = $iv / 100;
				}
				if ($iv_unit === 'm/min') {
					$iv = $iv / 60;
				}
				$a = $request['acc'];
				if ($acc_unit === "ft/s²") {
					$a = $a * 0.3048;
				}
				if ($acc_unit === "in/s²") {
					$a = $a * 0.0254;
				}
				if ($acc_unit === "cm/s²") {
					$a = $a * 0.01;
				}
				if ($acc_unit === "mi/s²") {
					$a = $a * 1609.344;
				}
				if ($acc_unit === "mi/s²") {
					$a = $a * 1609.344;
				}
				if ($acc_unit === "km/s²") {
					$a = $a * 100;
				}
				$this->param['ans_t'] = "Velocity";
				$ans = round($iv + ($a * $time), 4);
				$unit = "m/s";
			}elseif($collection == '3'){
				$time = $request['y1'];
				if ($atime_unit === 'min') {
					$time = $time * 60;
				}
				if ($atime_unit === 'hrs') {
					$time = $time * 3600;
				}
				if ($atime_unit === 'days') {
					$time = $time * 86400;
				}
				if ($atime_unit === 'wks') {
					$time = $time * 604800;
				}
				if ($atime_unit === 'mos') {
					$time = $time *  2.628e+6;
				}
				if ($atime_unit === 'yrs') {
					$time = $time * 3.154e+7;
				}
				$iv = $request['x1'];
				if ($iv_unit === 'km/h') {
					$iv = $iv / 3.6;
				}
				if ($iv_unit === 'ft/s') {
					$iv = $iv / 3.28084;
				}
				if ($iv_unit === 'mph') {
					$iv = $iv / 2.23694;
				}
				if ($iv_unit === 'kn') {
					$iv = $iv / 1.94384;
				}
				if ($iv_unit === 'ft/m') {
					$iv = $iv / 196.8504;
				}
				if ($iv_unit === 'cm/s') {
					$iv = $iv / 100;
				}
				if ($iv_unit === 'm/min') {
					$iv = $iv / 60;
				}
				$fv = $request['z1'];
				if ($fv_unit === 'km/h') {
					$fv = $fv / 3.6;
				}
				if ($fv_unit === 'ft/s') {
					$fv = $fv / 3.28084;
				}
				if ($fv_unit === 'mph') {
					$fv = $fv / 2.23694;
				}
				if ($fv_unit === 'kn') {
					$fv = $fv / 1.94384;
				}
				if ($fv_unit === 'ft/m') {
					$fv = $fv / 196.8504;
				}
				if ($fv_unit === 'cm/s') {
					$fv = $fv / 100;
				}
				if ($fv_unit === 'm/min') {
					$fv = $fv / 60;
				}
				$this->param['ans_t'] = "Acceleration";
				$ans = round(($fv - $iv) / $time, 4);
				$unit = 'm/s²';
			}else{
				$a = $request['acc'];
				if ($acc_unit === "ft/s²") {
					$a = $a * 0.3048;
				}
				if ($acc_unit === "in/s²") {
					$a = $a * 0.0254;
				}
				if ($acc_unit === "cm/s²") {
					$a = $a * 0.01;
				}
				if ($acc_unit === "mi/s²") {
					$a = $a * 1609.344;
				}
				if ($acc_unit === "mi/s²") {
					$a = $a * 1609.344;
				}
				if ($acc_unit === "km/s²") {
					$a = $a * 100;
				}
				if ($acc_unit === "g") {
					$a = $a * 0.10197162129779;
				}
				$iv = $request['x1'];
				if ($iv_unit === 'km/h') {
					$iv = $iv / 3.6;
				}
				if ($iv_unit === 'ft/s') {
					$iv = $iv / 3.28084;
				}
				if ($iv_unit === 'mph') {
					$iv = $iv / 2.23694;
				}
				if ($iv_unit === 'kn') {
					$iv = $iv / 1.94384;
				}
				if ($iv_unit === 'ft/m') {
					$iv = $iv / 196.8504;
				}
				if ($iv_unit === 'cm/s') {
					$iv = $iv / 100;
				}
				if ($iv_unit === 'm/min') {
					$iv = $iv / 60;
				}
				$fv = $request['z1'];
				if ($fv_unit === 'km/h') {
					$fv = $fv / 3.6;
				}
				if ($fv_unit === 'ft/s') {
					$fv = $fv / 3.28084;
				}
				if ($fv_unit === 'mph') {
					$fv = $fv / 2.23694;
				}
				if ($fv_unit === 'kn') {
					$fv = $fv / 1.94384;
				}
				if ($fv_unit === 'ft/m') {
					$fv = $fv / 196.8504;
				}
				if ($fv_unit === 'cm/s') {
					$fv = $fv / 100;
				}
				if ($fv_unit === 'm/min') {
					$fv = $fv / 60;
				}
				$this->param['ans_t'] = "Time";
				$ans = round(($fv - $iv) / $a, 4);
				$unit = "s";
			}
			$this->param['ans'] = $ans;
			return $this->param;
		}
	}
	function old_velocity($request)
	{
		$velo_value = $request['velo_value'];
		if ($velo_value  === '5') {
			if (is_numeric($request['x']) && is_numeric($request['y'] ) || is_numeric($request['z'] ) ) {
				$dis1_unit = $request['dis_unit'];
				$dis_unit = $request['dist_unit'];
				$time_unit = $request['time_unit'];
				$val_unit = $request['val_unit'];
				if (empty($request['z'])) {
					$distance = $request['x'];
					$time = $request['y'];
					if ($dis1_unit === "cm") {
						$distance = $distance / 100;
					}
					if ($dis1_unit === "km") {
						$distance = $distance * 1000;
					}
					if ($dis1_unit === "in") {
						$distance = $distance / 39.37;
					}
					if ($dis1_unit === "ft") {
						$distance = $distance / 3.281;
					}
					if ($dis1_unit === "yd") {
						$distance = $distance / 1.094;
					}
					if ($dis1_unit === "mi") {
						$distance = $distance * 1609.34;
					}
					if ($dis1_unit === "m") {
						$distance = $distance ;
					}

					if ($time_unit === 'sec') {
						$time = $time;
					}
					if ($time_unit === 'min') {
						$time = $time * 60;
					}
					if ($time_unit === 'hrs') {
						$time = $time * 3600;
					}
					if ($time_unit === 'days') {
						$time = $time * 86400;
					}
					if ($time_unit === 'wks') {
						$time = $time * 604800;
					}
					if ($time_unit === 'mos') {
						$time = $time *  2.628e+6;
					}
					if ($time_unit === 'yrs') {
						$time = $time * 3.154e+7;
					}

					$ans = round($distance / $time, 10);
					$ans = $ans;
					$unit = "m/s";
					$this->param['ans_t'] = "Velocity";
				}
				if (empty($request['y'])) {
					$distance = $request['x'];
					$velocity = $request['z'];
					if ($dis_unit === "cm") {
						$distance = $distance / 100;
					}
					if ($dis_unit === "km") {
						$distance = $distance * 1000;
					}
					if ($dis_unit === "in") {
						$distance = $distance / 39.37;
					}
					if ($dis_unit === "ft") {
						$distance = $distance / 3.281;
					}
					if ($dis_unit === "yd") {
						$distance = $distance / 1.094;
					}
					if ($dis_unit === "mi") {
						$distance = $distance * 1609.34;
					}

					if ($val_unit === 'm/s') {
						$velocity = $velocity ;
					}
					if ($val_unit === 'km/h') {
						$velocity = $velocity / 3.6;
					}
					if ($val_unit === 'ft/s') {
						$velocity = $velocity / 3.28084;
					}
					if ($val_unit === 'mph') {
						$velocity = $velocity / 2.23694;
					}
					if ($val_unit === 'kn') {
						$velocity = $velocity / 1.94384;
					}
					if ($val_unit === 'ft/m') {
						$velocity = $velocity / 196.8504;
					}
					if ($val_unit === 'cm/s') {
						$velocity = $velocity / 100;
					}
					if ($val_unit === 'm/min') {
						$velocity = $velocity / 60;
					}

					$ans = round($distance / $velocity, 10);
					$ans = $ans;
					$unit = "s";

					$this->param['ans_t'] = "Time";
				}
				if (empty($request['x'])) {
					$time = $request['y'];
					$velocity = $request['z'];
					if ($time_unit === 'min') {
						$time = $time * 60;
					}
					if ($time_unit === 'hrs') {
						$time = $time * 3600;
					}
					if ($time_unit === 'days') {
						$time = $time * 86400;
					}
					if ($time_unit === 'wks') {
						$time = $time * 604800;
					}
					if ($time_unit === 'mos') {
						$time = $time *  2.628e+6;
					}
					if ($time_unit === 'yrs') {
						$time = $time * 3.154e+7;
					}

					if ($val_unit === 'm/s') {
						$velocity = $velocity ;
					}
					if ($val_unit === 'km/h') {
						$velocity = $velocity / 3.6;
					}
					if ($val_unit === 'ft/s') {
						$velocity = $velocity / 3.28084;
					}
					if ($val_unit === 'mph') {
						$velocity = $velocity / 2.23694;
					}
					if ($val_unit === 'kn') {
						$velocity = $velocity / 1.94384;
					}
					if ($val_unit === 'ft/m') {
						$velocity = $velocity / 196.8504;
					}
					if ($val_unit === 'cm/s') {
						$velocity = $velocity / 100;
					}
					if ($val_unit === 'm/min') {
						$velocity = $velocity / 60;
					}
					$ans = round($time * $velocity, 10);
					$ans = $ans;
					$unit = "m";
					$this->param['ans_t'] = "Distance";

				}
				if(empty($request['z'])){
					$request['ans'] == "Velocity";
				}elseif(empty($request['y'])){
					$request['ans'] == "Time";
				}else{
					$request['ans'] == "Distance";
				}
				$this->param['ans'] = $ans;
				$this->param['unit'] = $unit;
				$this->param['Add'] = "active";
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		} elseif ($velo_value  === '3') {
			if (is_numeric($request['x1']) && is_numeric($request['y1']) && is_numeric($request['z1']) || is_numeric($request['acc'])) {
				// dd('ss');
				$method = $request['type'];
				$x1= $request['x1'];
				$y1= $request['y1'];
				$z1= $request['z1'];
				$acc= $request['acc'];
				$iv_unit = $request['iv_unit'];
				$acc_unit = $request['acc_unit'];
				$atime_unit = $request['atime_unit'];
				$fv_unit = $request['fv_unit'];
				if (empty($x1)) {
					$a = $request['acc'];
					if ($acc_unit === "ft/s²") {
						$a = $a * 0.3048;
					}
					if ($acc_unit === "in/s²") {
						$a = $a * 0.0254;
					}
					if ($acc_unit === "cm/s²") {
						$a = $a * 0.01;
					}
					if ($acc_unit === "mi/s²") {
						$a = $a * 1609.344;
					}
					if ($acc_unit === "mi/s²") {
						$a = $a * 1609.344;
					}
					if ($acc_unit === "km/s²") {
						$a = $a * 100;
					}
					if ($acc_unit === "g") {
						$a = $a * 0.10197162129779;
					}
					$time = $request['y1'];
					if ($atime_unit === 'min') {
						$time = $time * 60;
					}
					if ($atime_unit === 'hrs') {
						$time = $time * 3600;
					}
					if ($atime_unit === 'days') {
						$time = $time * 86400;
					}
					if ($atime_unit === 'wks') {
						$time = $time * 604800;
					}
					if ($atime_unit === 'mos') {
						$time = $time *  2.628e+6;
					}
					if ($atime_unit === 'yrs') {
						$time = $time * 3.154e+7;
					}
					$fv = $request['z1'];
					if ($fv_unit === 'm/s') {
						$fv = $fv ;
					}
					if ($fv_unit === 'km/h') {
						$fv = $fv / 3.6;
					}
					if ($fv_unit === 'ft/s') {
						$fv = $fv / 3.28084;
					}
					if ($fv_unit === 'mph') {
						$fv = $fv / 2.23694;
					}
					if ($fv_unit === 'kn') {
						$fv = $fv / 1.94384;
					}
					if ($fv_unit === 'ft/m') {
						$fv = $fv / 196.8504;
					}
					if ($fv_unit === 'cm/s') {
						$fv = $fv / 100;
					}
					if ($fv_unit === 'm/min') {
						$fv = $fv / 60;
					}
					$ans = round(($fv - ($a * $time)), 4);
					$unit = "m/s";
				}
				if (empty($y1)) {
					$a = $request['acc'];
					if ($acc_unit === "ft/s²") {
						$a = $a * 0.3048;
					}
					if ($acc_unit === "in/s²") {
						$a = $a * 0.0254;
					}
					if ($acc_unit === "cm/s²") {
						$a = $a * 0.01;
					}
					if ($acc_unit === "mi/s²") {
						$a = $a * 1609.344;
					}
					if ($acc_unit === "mi/s²") {
						$a = $a * 1609.344;
					}
					if ($acc_unit === "km/s²") {
						$a = $a * 100;
					}
					if ($acc_unit === "g") {
						$a = $a * 0.10197162129779;
					}
					$iv = $request['x1'];
					if ($iv_unit === 'km/h') {
						$iv = $iv / 3.6;
					}
					if ($iv_unit === 'ft/s') {
						$iv = $iv / 3.28084;
					}
					if ($iv_unit === 'mph') {
						$iv = $iv / 2.23694;
					}
					if ($iv_unit === 'kn') {
						$iv = $iv / 1.94384;
					}
					if ($iv_unit === 'ft/m') {
						$iv = $iv / 196.8504;
					}
					if ($iv_unit === 'cm/s') {
						$iv = $iv / 100;
					}
					if ($iv_unit === 'm/min') {
						$iv = $iv / 60;
					}
					$fv = $request['z1'];
					if ($fv_unit === 'km/h') {
						$fv = $fv / 3.6;
					}
					if ($fv_unit === 'ft/s') {
						$fv = $fv / 3.28084;
					}
					if ($fv_unit === 'mph') {
						$fv = $fv / 2.23694;
					}
					if ($fv_unit === 'kn') {
						$fv = $fv / 1.94384;
					}
					if ($fv_unit === 'ft/m') {
						$fv = $fv / 196.8504;
					}
					if ($fv_unit === 'cm/s') {
						$fv = $fv / 100;
					}
					if ($fv_unit === 'm/min') {
						$fv = $fv / 60;
					}
					$ans = round(($fv - $iv) / $a, 4);
					$unit = "s";
				}
				if (empty($acc)) {
					$time = $request['y1'];
					if ($atime_unit === 'min') {
						$time = $time * 60;
					}
					if ($atime_unit === 'hrs') {
						$time = $time * 3600;
					}
					if ($atime_unit === 'days') {
						$time = $time * 86400;
					}
					if ($atime_unit === 'wks') {
						$time = $time * 604800;
					}
					if ($atime_unit === 'mos') {
						$time = $time *  2.628e+6;
					}
					if ($atime_unit === 'yrs') {
						$time = $time * 3.154e+7;
					}
					$iv = $request['x1'];
					if ($iv_unit === 'km/h') {
						$iv = $iv / 3.6;
					}
					if ($iv_unit === 'ft/s') {
						$iv = $iv / 3.28084;
					}
					if ($iv_unit === 'mph') {
						$iv = $iv / 2.23694;
					}
					if ($iv_unit === 'kn') {
						$iv = $iv / 1.94384;
					}
					if ($iv_unit === 'ft/m') {
						$iv = $iv / 196.8504;
					}
					if ($iv_unit === 'cm/s') {
						$iv = $iv / 100;
					}
					if ($iv_unit === 'm/min') {
						$iv = $iv / 60;
					}
					$fv = $request['z1'];
					if ($fv_unit === 'km/h') {
						$fv = $fv / 3.6;
					}
					if ($fv_unit === 'ft/s') {
						$fv = $fv / 3.28084;
					}
					if ($fv_unit === 'mph') {
						$fv = $fv / 2.23694;
					}
					if ($fv_unit === 'kn') {
						$fv = $fv / 1.94384;
					}
					if ($fv_unit === 'ft/m') {
						$fv = $fv / 196.8504;
					}
					if ($fv_unit === 'cm/s') {
						$fv = $fv / 100;
					}
					if ($fv_unit === 'm/min') {
						$fv = $fv / 60;
					}
					$ans = round(($fv - $iv) / $time, 4);
					$unit = 'm/s²';
				}
				if (empty($z1)) {
					$time = $request['y1'];
					if ($atime_unit === 'min') {
						$time = $time * 60;
					}
					if ($atime_unit === 'hrs') {
						$time = $time * 3600;
					}
					if ($atime_unit === 'days') {
						$time = $time * 86400;
					}
					if ($atime_unit === 'wks') {
						$time = $time * 604800;
					}
					if ($atime_unit === 'mos') {
						$time = $time *  2.628e+6;
					}
					if ($atime_unit === 'yrs') {
						$time = $time * 3.154e+7;
					}
					$iv = $request['x1'];
					if ($iv_unit === 'km/h') {
						$iv = $iv / 3.6;
					}
					if ($iv_unit === 'ft/s') {
						$iv = $iv / 3.28084;
					}
					if ($iv_unit === 'mph') {
						$iv = $iv / 2.23694;
					}
					if ($iv_unit === 'kn') {
						$iv = $iv / 1.94384;
					}
					if ($iv_unit === 'ft/m') {
						$iv = $iv / 196.8504;
					}
					if ($iv_unit === 'cm/s') {
						$iv = $iv / 100;
					}
					if ($iv_unit === 'm/min') {
						$iv = $iv / 60;
					}
					$a = $request['acc'];
					if ($acc_unit === "ft/s²") {
						$a = $a * 0.3048;
					}
					if ($acc_unit === "in/s²") {
						$a = $a * 0.0254;
					}
					if ($acc_unit === "cm/s²") {
						$a = $a * 0.01;
					}
					if ($acc_unit === "mi/s²") {
						$a = $a * 1609.344;
					}
					if ($acc_unit === "mi/s²") {
						$a = $a * 1609.344;
					}
					if ($acc_unit === "km/s²") {
						$a = $a * 100;
					}
					$ans = round($iv + ($a * $time), 4);
					$unit = "m/s";
				}
				$ans_t = '';
				if(empty($x1)){
					$ans_t = "Initial Velocity";
				}
				if(empty($y1)){
					$ans_t = "Time";
				}
				if(empty($z1)){
					$ans_t = "Final Velocity";
				}
				if (empty($acc)){
					$ans_t = "Acceleration";
				}

				$this->param['unit'] = $unit;
				$this->param['ans'] = $ans;
				$this->param['Sub'] = "active";
				$this->param['ans_t'] = $ans_t;
				$this->param['RESULT'] = 1;
				return $this->param;
			} else {
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}else{
			$vs = $request->vs;
			$vs_unit = $request->vs_unit;
			$avt = $request->avt;
			$avt_unit = $request->avt_unit;

			function velocity($velocities, $units) {
				$converted_velocities = [];
				foreach ($velocities as $index => $value) {
					$unit = isset($units[$index]) ? $units[$index] : '';
			
					if ($unit == 'km/h') {
						$converted_velocities[] = $value / 3.6;
					} elseif ($unit == 'ft/s') {
						$converted_velocities[] = $value / 3.28084;
					} elseif ($unit == 'mph') {
						$converted_velocities[] = $value / 2.23694;
					} elseif ($unit == 'kn') {
						$converted_velocities[] = $value /  1.94384;
					} elseif ($unit == 'ft/m') {
						$converted_velocities[] = $value /  196.8504;
					}elseif ($unit == 'cm/s') {
						$converted_velocities[] = $value / 100;
					}elseif ($unit == 'm/min') {
						$converted_velocities[] = $value / 60;
					}else {
						$converted_velocities[] = $value;
					}
				}
				
				return $converted_velocities;
			}
			
			$vs = velocity($vs, $vs_unit);
			// Should output 0.625

			function convertTime($times, $units) {
				$converted_times = [];
				
				foreach ($times as $index => $value) {
					$unit = isset($units[$index]) ? $units[$index] : '';
					if ($unit === 'min') {
						$converted_times[] = $value * 60; // Convert minutes to seconds
					} elseif ($unit === 'hrs') {
						$converted_times[] = $value * 3600; // Convert hours to seconds
					}elseif ($unit === 'days') {
						$converted_times[] = $value * 86400; // Convert hours to seconds
					}elseif ($unit === 'wks') {
						$converted_times[] = $value * 604800; // Convert hours to seconds
					}elseif ($unit === 'mon') {
						$converted_times[] = $value * 2.628e+6; // Convert hours to seconds
					}elseif ($unit === 'yrs') {
						$converted_times[] = $value * 3.154e+7; // Convert hours to seconds
					}
					 else {
						$converted_times[] = $value;
					}
				}
				
				return $converted_times;
			}
			$avt = convertTime($avt, $avt_unit);

			if (is_array($vs) && is_array($avt)) {
				$total_time = array_sum($avt);
				$weighted_sum = 0;

				foreach ($vs as $key => $velocity) {
					if (is_numeric($velocity) && is_numeric($avt[$key])) {
						$weighted_sum += $velocity * $avt[$key];
					} else {
						$this->param['error'] = 'Please! Check Your Input';
						return $this->param;
					}
				}

				if ($total_time > 0) {
					$average_velocity = $weighted_sum / $total_time;
					$average_velocity = round($average_velocity,4);
					$unit = "m/s";
				} else {
					$this->param['error'] = 'Total time must be greater than zero';
					return $this->param;
				}
				$this->param['unit'] = $unit;
				$this->param['ans_t'] = "Avrage Velocity";
				$this->param['ans'] = $average_velocity;
				$this->param['RESULT'] = 1;
				return $this->param;
			}else{
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;
			}
		}
	}
	
	/*******************
       Flow Rate Calculator
	 *******************/
	function flow($request)
	{
		$diameter = $request->diameter;
		$diameter_unit = $request->diameter_unit;
		$velocity = $request->velocity;
		$velocity_unit = $request->velocity_unit;
		$density = $request->density;
		$density_unit = $request->density_unit;
		$filled = $request->filled;
		$filled_unit = $request->filled_unit;
		$height = $request->height;
		$height_unit = $request->height_unit;
		$width = $request->width;
		$width_unit = $request->width_unit;
		$cross = $request->cross;
		$cross_unit = $request->cross_unit;
		$choice_unit = $request->choice_unit;
		$top_width = $request->top_width;
		$top_width_unit = $request->top_width_unit;
		$bottom_width = $request->bottom_width;
		$bottom_width_unit = $request->bottom_width_unit;
		$dynamic_viscosity_unit = $request->dynamic_viscosity_unit;
		$dynamic_viscosity = $request->dynamic_viscosity;
		$pipe_length = $request->pipe_length;
		$pipe_length_unit = $request->pipe_length_unit;
		$pressure_end = $request->pressure_end;
		$pressure_end_unit = $request->pressure_end_unit;
		$pressure_start = $request->pressure_start;
		$pressure_start_unit = $request->pressure_start_unit;
		$conversion_type = $request->conversion_type;
		$volume = $request->volume;
		$volume_unit = $request->volume_unit;
		$time = $request->time;
		$time_unit = $request->time_unit;

		function convert_centimeter($a, $b)
		{
			if ($a = "cm") {
				$convert4 = $b * 0.01;
			} elseif ($a = "m") {
				$convert4 = $b * 1;
			} elseif ($a = "in") {
				$convert4 = $b * 0.0254;
			} elseif ($a = "ft") {
				$convert4 = $b * 0.3048;
			} elseif ($a = "yd") {
				$convert4 = $b * 0.9144;
			} elseif ($a = "mm") {
				$convert4 = $b * 0.001;
			}
			return $convert4;
		}
		function convert_unit1($c, $d)
		{
			if ($c = "ms") {
				$convert5 = $d * 1;
			} else if ($c = "fts") {
				$convert5 = $d * 0.3048;
			}
			return $convert5;
		}
		function convert_density($c, $d)
		{
			if ($c = "kg") {
				$convert6 = $d * 1;
			} else if ($c = "lb1") {
				$convert6 = $d * 16.02;
			} else if ($c = "lb2") {
				$convert6 = $d * 0.5933;
			} else if ($c = "g") {
				$convert6 = $d * 1000;
			}
			return $convert6;
		}
		function convert_cross($c, $d)
		{
			if ($c = "m²") {
				$convert7 = $d * 1;
			} else if ($c = "cm²") {
				$convert7 = $d * 0.0001;
			} else if ($c = "in²") {
				$convert7 = $d * 0.0006452;
			} else if ($c = "ft²") {
				$convert7 = $d * 0.0929;
			} else if ($c = "yd²") {
				$convert7 = $d * 0.8361;
			}
			return $convert7;
		}
		function convert_pascal($e, $f)
		{
			if ($e = "Pa") {
				$convert8 = $f * 1;
			} else if ($e = "kPa") {
				$convert8 = $f * 1000;
			} else if ($e = "MPa") {
				$convert8 = $f * 1000000;
			} else if ($e = "GPa") {
				$convert8 = $f * 1000000000;
			} else if ($e = "mbar") {
				$convert8 = $f * 100;
			} else if ($e = "bar") {
				$convert8 = $f * 100000;
			} else if ($e = "atm") {
				$convert8 = $f * 101325;
			} else if ($e = "mmHg") {
				$convert8 = $f * 133.322;
			} else if ($e = "mmH2O") {
				$convert8 = $f * 9.80665;
			} else if ($e = "psi") {
				$convert8 = $f * 6894.76;
			}
			return $convert8;
		}
		function convert_dynamic_viscosity($g, $h)
		{
			if ($g = "kgms") {
				$convert9 = $h * 1;
			} else if ($g = "nsm2") {
				$convert9 = $h * 1;
			} else if ($g = "pas") {
				$convert9 = $h * 1;
			} else if ($g = "cp") {
				$convert9 = $h * 0.001;
			}
			return $convert9;
		}
		function convert_volume($e, $f)
		{
			if ($e = "fluid-ounce") {
				$convert10 = $f * 0.0078125;
			} else if ($e = "quart") {
				$convert10 = $f * 0.25;
			} else if ($e = "pint") {
				$convert10 = $f * 0.150119;
			} else if ($e = "gallon") {
				$convert10 = $f * 1;
			} else if ($e = "milliliter") {
				$convert10 = $f * 0.000264172;
			} else if ($e = "liter") {
				$convert10 = $f * 0.264172;
			} else if ($e = "cubic-foot") {
				$convert10 = $f * 7.48052;
			} else if ($e = "cubic-inch") {
				$convert10 = $f * 0.004329;
			} else if ($e = "cubic-centimeter") {
				$convert10 = $f * 0.000264172;
			} else if ($e = "cubic-meter") {
				$convert10 = $f * 264.172;
			}
			return $convert10;
		}
		function convert_time($e, $f)
		{
			if ($e = "second") {
				$convert11 = $f * 0.0166667;
			} else if ($e = "minute") {
				$convert11 = $f * 1;
			} else if ($e = "hour") {
				$convert11 = $f * 60;
			} else if ($e = "day") {
				$convert11 = $f * 1440;
			}
			return $convert11;
		}

		if ($conversion_type = "1") {
			if ($choice_unit = "cp") {
				if (is_numeric($density) && is_numeric($diameter) && is_numeric($velocity)) {
					//π  (d/2)²  v
					$diameter_value = convert_centimeter($diameter_unit, $diameter);
					$velocity_value = convert_unit1($velocity_unit, $velocity);
					$density_value = convert_density($density_unit, $density);
					$volumetric_flow_rate = ((3.141592) * (($diameter_value / 2) * ($diameter_value / 2)) * $velocity_value);
					$mass_flow_rate = $volumetric_flow_rate * $density_value;
					$this->param['mass_flow_rate'] = $mass_flow_rate;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($choice_unit = "cpf") {
				if (is_numeric($density) && is_numeric($diameter) && is_numeric($velocity) && is_numeric($filled)) {
					//π  (d/2)²  v
					$diameter_value = convert_centimeter($diameter_unit, $diameter);
					$velocity_value = convert_unit1($velocity_unit, $velocity);
					$filled_value = convert_centimeter($filled_unit, $filled);
					$density_value = convert_density($density_unit, $density);
					$volumetric_flow_rate = ((3.141592) * (($diameter_value / 2) * ($diameter_value / 2)) * $velocity_value * $filled_value);
					$mass_flow_rate = $volumetric_flow_rate * $density_value;
					$this->param['mass_flow_rate'] = $mass_flow_rate;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($choice_unit = "rec") {
				if (is_numeric($height) && is_numeric($width) && is_numeric($density) && is_numeric($velocity)) {
					$height_value = convert_centimeter($height_unit, $height);
					$width_value = convert_centimeter($width_unit, $width);
					$velocity_value = convert_unit1($velocity_unit, $velocity);
					$density_value = convert_density($density_unit, $density);
					$volumetric_flow_rate = ($height_value * $width_value * $velocity_value);
					$mass_flow_rate = $volumetric_flow_rate * $density_value;
					$this->param['mass_flow_rate'] = $mass_flow_rate;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else if ($choice_unit = "trap") {
				if (is_numeric($top_width) && is_numeric($bottom_width) && is_numeric($width) && is_numeric($velocity) && is_numeric($density)) {
					$top_width_value = convert_centimeter($top_width_unit, $top_width);
					$bottom_width_value = convert_centimeter($bottom_width_unit, $bottom_width);
					$width_value = convert_centimeter($width_unit, $width);
					$velocity_value = convert_unit1($velocity_unit, $velocity);
					$density_value = convert_density($density_unit, $density);
					$volumetric_flow_rate = $velocity_value * $width_value * ($top_width_value + $bottom_width_value) / 2;

					$mass_flow_rate = $volumetric_flow_rate * $density_value;
					$this->param['mass_flow_rate'] = $mass_flow_rate;
				} else {
					$this->session->set_flashdata('flow', 'Check Input');
					return false;
				}
			} else if ($choice_unit = "other") {
				if (is_numeric($density) && is_numeric($velocity) && is_numeric($cross)) {
					$cross_value = convert_cross($cross_unit, $cross);
					$velocity_value = convert_unit1($velocity_unit, $velocity);
					$density_value = convert_density($density_unit, $density);
					$volumetric_flow_rate = $cross_value * $velocity_value * $cross_value;
					$mass_flow_rate = $volumetric_flow_rate * $density_value;
					$this->param['mass_flow_rate'] = $mass_flow_rate;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
		} else if ($conversion_type = "2") {
			if (is_numeric($diameter) && is_numeric($pipe_length) && is_numeric($pressure_start) && is_numeric($pressure_end) && is_numeric($dynamic_viscosity) && is_numeric($density)) {
				$diameter_value = convert_centimeter($diameter_unit, $diameter);
				$pipe_length_value = convert_centimeter($pipe_length_unit, $pipe_length);
				$pressure_start_value = convert_pascal($pressure_start_unit, $pressure_start);
				$pressure_end_value = convert_pascal($pressure_end_unit, $pressure_end);
				$density_value = convert_density($density_unit, $density);
				$viscosity_value = convert_dynamic_viscosity($dynamic_viscosity_unit, $dynamic_viscosity);
				$volumetric_flow_rate = (3.14 * (pow($diameter_value / 2, 4) * ($pressure_start_value - $pressure_end_value)) / (8 * $viscosity_value * $pipe_length_value));
				$mass_flow_rate = $volumetric_flow_rate * $density_value;
				$this->param['mass_flow_rate'] = $mass_flow_rate;
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} else if ($conversion_type = "3") {
			if (is_numeric($time) && is_numeric($volume)) {
				$time_value = convert_time($time_unit, $time);
				$volume_value = convert_volume($volume_unit, $volume);
				$volumetric_flow_rate = ($volume_value / $time_value) * 6.30902e-5;
				$this->param['mass_flow_rate'] = "";
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		}

		$this->param['volumetric_flow_rate'] = $volumetric_flow_rate;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	/*******************
       Center of Mass Calculator
	 *******************/
	function center($request)
	{
		$i = 1; 
		$how = trim($request->how);
		$dem = trim($request->dem);
		$mass = [];
		$xs = [];
		$ys = [];
		$zs = [];
		$check = true;
	
		for ($i = 1; $i <= $how; $i++) {
			$m = $request->input('m' . $i);
			$x = $request->input('x' . $i);
	
			if (is_numeric($m) && is_numeric($x)) {
				// Convert mass units
				$mUnit = $request->input('m' . $i . '_unit');
				if ($mUnit == 'lbs') {
					$m *= 0.4536;
				} elseif ($mUnit == 'g') {
					$m *= 0.001;
				}
				$mass[] = $m;
				// Convert x units
				$xUnit = $request->input('x' . $i . '_unit');
				if ($xUnit == 'm') {
					$x *= 100;
				} elseif ($xUnit == 'in') {
					$x *= 2.54;
				} elseif ($xUnit == 'ft') {
					$x *= 30.48;
				} elseif ($xUnit == 'yd') {
					$x *= 91.44;
				}
				$xs[] = $x;
			} else {
				$check = false;
				break;
			}
	
			if ($dem == 2 || $dem == 3) {
				$y = $request->input('y' . $i);
	
				if (is_numeric($y)) {
					// Convert y units
					$yUnit = $request->input('y' . $i . '_unit');
					if ($yUnit == 'm') {
						$y *= 100;
					} elseif ($yUnit == 'in') {
						$y *= 2.54;
					} elseif ($yUnit == 'ft') {
						$y *= 30.48;
					} elseif ($yUnit == 'yd') {
						$y *= 91.44;
					}
					$ys[] = $y;
				} else {
					$check = false;
					break;
				}
			}
	
			if ($dem == 3) {
				$z = $request->input('z' . $i);
	
				if (is_numeric($z)) {
					// Convert z units
					$zUnit = $request->input('z' . $i . '_unit');
					if ($zUnit == 'm') {
						$z *= 100;
					} elseif ($zUnit == 'in') {
						$z *= 2.54;
					} elseif ($zUnit == 'ft') {
						$z *= 30.48;
					} elseif ($zUnit == 'yd') {
						$z *= 91.44;
					}
					$zs[] = $z;
				} else {
					$check = false;
					break;
				}
			}
		}
		if ($check == true) {
			
			$xcm = 0;
			foreach ($mass as $key => $value) {
				$xcm = $xcm + ($value*$xs[$key]);
			}
			$ansx = $xcm / array_sum($mass);
			if ($request->res_unit == 'm') {
				$ansx = $ansx * 0.01;
			} elseif ($request->res_unit =='in') {
				$ansx = $ansx * 0.3937;
			} elseif ($request->res_unit =='ft') {
				$ansx = $ansx * 0.03281;
			} elseif ($request->res_unit =='yd') {
				$ansx = $ansx * 0.010936;
			}

			if ($dem == 2 || $dem == 3) {
				$ycm = 0;
				foreach ($mass as $key => $value) {
					$ycm = $ycm + ($value * $ys[$key]);
				}
				$ansy = $ycm / array_sum($mass);
				if ($request->res_unit =='m') {
					$ansy = $ansy * 0.01;
				} elseif ($request->res_unit =='in') {
					$ansy = $ansy * 0.3937;
				} elseif ($request->res_unit =='ft') {
					$ansy = $ansy * 0.03281;
				} elseif ($request->res_unit =='yd') {
					$ansy = $ansy * 0.010936;
				}
				$this->param['ansy'] = $ansy;
			}
			if ($dem == 3) {
				$zcm = 0;
				foreach ($mass as $key => $value) {
					$zcm = $zcm + ($value * $zs[$key]);
				}
				$ansz = $zcm / array_sum($mass);
				if ($request->res_unit == 'm') {
					$ansz = $ansz * 0.01;
				} elseif ($request->res_unit =='in') {
					$ansz = $ansz * 0.3937;
				} elseif ($request->res_unit =='ft') {
					$ansz = $ansz * 0.03281;
				} elseif ($request->res_unit =='yd') {
					$ansz = $ansz * 0.010936;
				}
				$this->param['ansz'] = $ansz;
			}
			$this->param['ansx'] = $ansx;
			$this->param['unit'] = $request->res_unit;
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
	}

	/*******************
       dot product calcuator
	 *******************/
	function dot($request)
	{
		$input1 = $request->input('input1');
		$components = explode(',', $input1);
		$input2 = $request->input('input2');
		$components2 = explode(',', $input2);

		if (array_filter($components, function($value) { return !is_numeric($value); }) || array_filter($components2, function($value) { return !is_numeric($value); })) {
			$this->param['error'] = 'Sets may contain only integers and decimals';
			return $this->param;
		}

		if (count($components) !== count($components2)) {
			$this->param['error'] = 'The input arrays must have the same length.';
			return $this->param;
		}

		if (!empty($input1) && !empty($input2)) {
			$length = min(count($components), count($components2));
			$products = array();
			for ($i = 0; $i < $length; $i++) {
				$products[] = $components[$i] * $components2[$i];
			}
			$this->param['components'] = $components;
			$this->param['components2'] = $components2;
			$prod = array_sum($products);

			$sum_of_squares = 0;
			foreach ($components as $value) {
				$sum_of_squares += pow($value, 2); // Square each value and add to the sum
			}
			$sum_of_squares2 = 0;
			foreach ($components2 as $value2) {
				$sum_of_squares2 += pow($value2, 2); // Square each value and add to the sum
			}
			$mgntd_a = round(sqrt($sum_of_squares), 2);
			$mgntd_b = round(sqrt($sum_of_squares2), 2);
			$angle = $prod / ($mgntd_a * $mgntd_b);
			$theta = acos($angle);
			$deg = $theta * 180 / pi();
			$this->param['mgntd_a'] = $mgntd_a;
			$this->param['mgntd_b'] = $mgntd_b;
			$this->param['prod'] = $prod;
			$this->param['angle'] = round($angle, 7);
			$this->param['deg'] = round($deg, 5);
			$this->param['RESULT'] = 1;
			return $this->param;
		} else {
			$this->param['error'] = 'Please Fill All The Fields';
			return $this->param;
		}
	}

	/*******************
      Enthalpy Calculator
	 *******************/
	function enthalpy($request)
	{

		$DATA_A =  [
			"None" => "0",
			"Custom" => "0",
			"Ag(s)" => "0",
			"Ag⁺(aq)" => "105.58",
			"Ag₂O(s)" => "-31.05",
			"Ag₂S(s)" => "-31.8",
			"AgBr(aq)" => "-15.98",
			"AgBr(s)" => "-100.37",
			"AgCl(aq)" => "-61.58",
			"AgCl(s)" => "-127.7",
			"AgI(aq)" => "50.38",
			"AgI(s)" => "-61.84",
			"AgNO₃(s)" => "-124.39",
			"Al(s)" => "0",
			"Al₂O₃(s)" => "-1669.8",
			"Al³⁺(aq)" => "-524.7",
			"AlCl₃(s)" => "-704.2",
			"As(s) " => "0",
			"As₂S₃(s) " => "-169",
			"AsO₄³⁻(aq)" => "-888.14",
			"B(s)" => "0",
			"B₂O₃(s)" => "-1272.8",
			"Ba(s)" => "0",
			"Ba²⁺(aq)" => "-537.64",
			"BaCl₂(s)" => "-860.1",
			"BaCO₃(aq)" => "-1214.78",
			"BaCO₃(s)" => "-1218.8",
			"BaO(s)" => "-558.1",
			"BaSO₄(s)" => "-1465.2",
			"BF₃(g)" => "-1137",
			"Br⁻(aq)" => "-121.55",
			"Br(g)" => "111.88",
			"Br₂(g)" => "30.907",
			"Br₂(l)" => "0",
			"C(g)" => "716.68",
			"C(s) - Diamond" => "1.88",
			"C(s) - Graphite" => "0",
			"CH₃CHO(g)" => "-166.19",
			"CH₃CHO(l) - Acetaldehyde" => "-192.3",
			"CH₃COCH₃(l) - Acetone" => "-248.1",
			"CH₃COOH(aq)" => "-485.76",
			"CH₃COOH(l) - Acetic acid" => "-484.5",
			"CH₃NH₂(g) - Methylamine" => "-22.97",
			"CH₃OH(g)" => "-200.66",
			"CH₃OH(l) - Methanol" => "-238.6",
			"CH₄(g) - Methane" => "-74.81",
			"CHCl₃(l)" => "-131.8",
			"(COOH)₂(s) - Oxalic acid" => "-827.2",
			"C₂H₂(g) - Acetylene" => "226.73",
			"C₂H₄(g) - Ethylene" => "52.28",
			"C₂H₅OH(g)" => "-235.1",
			"C₂H₅OH(l) - Ethanol" => "-277.69",
			"C₂H₆(g) - Ethane" => "-84.68",
			"C₃H₆(g) - Cyclopropane " => "53.3",
			"C₃H₆(g) - Propylene" => "20.42",
			"C₃H₈(g) - Propane" => "-103.8",
			"C₄H₁₀(g) - Butane" => "-126.15",
			"C₅H₁₂(g) - Pentane" => "-146.44",
			"C₆H₁₂(l) - Cyclohexane" => "-156.4",
			"C₆H₁₂O₆(s) - Fructose" => "-1266",
			"C₆H₁₂O₆(s) - Glucose" => "-1273",
			"C₆H₁₄(l) - Haxane" => "-198.7",
			"C₆H₅COOH(s) - Benzoic acid" => "-385.1",
			"C₆H₅NH₂(l) - Aniline" => "31.6",
			"C₆H₅OH(s) - Phenol" => "-164.6",
			"C₆H₆(l) - Benzene" => "49.03",
			"C₇H₈(l) - Toluene" => "12",
			"C₈H₁₈(l) - Octane" => "-250.1",
			"C₁₂H₂₂O₁₁(s) - Sucrose" => "-2220",
			"CO(g)" => "-110.5",
			"CO(NH₂)₂(s) - Urea" => "-333.51",
			"CO₂(g)" => "-393.5",
			"CO₃²⁻(aq)" => "-677.14",
			"CCl₄(g)" => "-102.9",
			"CCl₄(l)" => "-139.5",
			"Ca(g)" => "178.2",
			"Ca(OH)₂(aq)" => "-1002.82",
			"Ca(OH)₂(s)" => "-986.6",
			"Ca(s)" => "0",
			"Ca²⁺(aq)" => "-542.83",
			"CaBr₂(s)" => "-682.8",
			"CaC₂(s)" => "-59.8",
			"CaCl₂(aq)" => "-877.1",
			"CaCl₂(s)" => "-795",
			"CaCO₃(aq)" => "-1219.97",
			"CaCO₃(s)" => "-1207.1",
			"CaF₂(aq)" => "-1208.09",
			"CaF₂(s)" => "-1219.6",
			"CaO(s)" => "-635.5",
			"CaSO₄(aq)" => "-1452.1",
			"CaSO₄(s)" => "-1432.7",
			"Ce(s)" => "0",
			"Ce³⁺(aq)" => "-696.2",
			"Ce⁴⁺(aq)" => "-537.2",
			"Cl(g)" => "121.68",
			"Cl⁻(aq)" => "-167.16",
			"Cl₂(g)" => "0",
			"CoO(s)" => "-239.3",
			"Cr₂O₃(s)" => "-1128.4",
			"CS₂(l)" => "89.7",
			"Cu(s)" => "0",
			"Cu⁺(aq)" => "71.67",
			"Cu²⁺(aq)" => "64.77",
			"Cu₂O(s)" => "-168.6",
			"CuO(s)" => "-157.3",
			"CuS(s)" => "-48.5",
			"CuSO₄(s)" => "-771.36",
			"D₂(g)" => "0",
			"D₂O(l)" => "-294.6",
			"D₂O(g)" => "-249.2",
			"F⁻(aq)" => "-332.63",
			"F₂(g)" => "0",
			"Fe(s)" => "0",
			"Fe²⁺(aq)" => "-89.1",
			"Fe³⁺(aq)" => "-48.5",
			"FeO(s)" => "-272.04",
			"Fe₂O₃(s) - Hematite" => "-824.2",
			"Fe₃O₄(s) - Magnetite" => "-1118.4",
			"FeS(s) - α" => "-100",
			"FeS₂(s) " => "-178.2",
			"H(g)" => "217.97",
			"H⁺(aq)" => "0",
			"H₂(g)" => "0",
			"H₂O(g) - Water vapor" => "-241.8",
			"H₂O(l) - Water" => "-285.83",
			"H₂O₂(aq)" => "-191.17",
			"H₂O₂(l)" => "-187.8",
			"H₂S(aq)" => "-39.7",
			"H₂S(g)" => "-20.63",
			"H₂SO₄(aq)" => "-909.27",
			"H₂SO₄(l)" => "-813.99",
			"H₃PO₃(aq)" => "-964",
			"H₃PO₄(aq)" => "-277.4",
			"H₃PO₄(l)" => "-1266.9",
			"HBr(g)" => "-36.23",
			"HCHO(g) - Formaldehyde" => "-108.57",
			"HCl(aq)" => "-167.16",
			"HCl(g)" => "-92.31",
			"HCN(g)" => "135.1",
			"HCN(l)" => "108.87",
			"HCOOH(l) - Formic acid" => "-424.72",
			"HF(aq)" => "-332.36",
			"HF(g)" => "-271.1",
			"Hg(g)" => "61.32",
			"Hg(l)" => "0",
			"Hg₂Cl₂(s)" => "-265.22",
			"HgO(s)" => "-90.83",
			"HgS(s)" => "-58.2",
			"HI(g)" => "26.48",
			"HN₃(g)" => "294.1",
			"HNO₃(aq)" => "-207.36",
			"HNO₃(l)" => "-174.1",
			"I⁻(aq)" => "-55.19",
			"I₂(g)" => "62.44",
			"I₂(s)" => "0",
			"K(g)" => "89.24",
			"K(s)" => "0",
			"K⁺(aq)" => "-252.38",
			"K₂S(aq)" => "-471.5",
			"K₂S(s)" => "-380.7",
			"KBr(s)" => "-393.8",
			"KCl(s)" => "-436.75",
			"KClO₃(s)" => "-397.73",
			"KClO₄(s)" => "-432.75",
			"KF(s)" => "-567.27",
			"KI(s)" => "-327.9",
			"KOH(aq)" => "-482.37",
			"KOH(s)" => "-424.76",
			"Mg(g)" => "147.7",
			"Mg(OH)₂(s)" => "-924.7",
			"Mg(s)" => "0",
			"Mg²⁺(aq)" => "-466.85",
			"MgBr₂(s)" => "-524.3",
			"MgCl₂(s)" => "-641.8",
			"MgCO₃(s)" => "-1095.8",
			"MgO(s)" => "-601.7",
			"MgSO₄(s)" => "-1278.2",
			"MnO(s)" => "-384.9",
			"MnO₂(s)" => "-519.7",
			"N₂(g)" => "0",
			"N₂H₄(g)" => "95.4",
			"N₂H₄(l)" => "50.63",
			"N₂O(g)" => "82.05",
			"N₂O₄(g)" => "9.16",
			"N₂O₄(l)" => "-19.5",
			"Na(g)" => "107.32",
			"Na(s)" => "0",
			"Na⁺(aq)" => "-240.12",
			"Na₂CO₃(s)" => "-1130.9",
			"NaBr(s)" => "-361.06",
			"NaCl(s)" => "-411.15",
			"NaF(s)" => -569,
			"NaHCO₃(s)" => "-947.7",
			"NaI(s)" => "-287.78",
			"NaOH(aq)" => "-470.11",
			"NaOH(s)" => "-425.61",
			"NH₂CH₂COOH(s) - Glycine" => "-532.9",
			"NH₂OH(s)" => "-114.2",
			"NH₃(aq)" => "-80.29",
			"NH₃(g) - Ammonia" => "-46.11",
			"NH₄⁺(aq)" => "-132.51",
			"NH₄Cl(s)" => "-314.43",
			"NH₄ClO₄(s)" => "-295.31",
			"NH₄NO₃(s)" => "-365.56",
			"NiO(s)" => "-244.3",
			"NO(g)" => "90.25",
			"NO₂(g)" => "33.18",
			"NO₃⁻(aq)" => "-205",
			"O₂(g)" => "0",
			"O₃(g)" => "142.7",
			"OH⁻(aq)" => "-229.99",
			"P(s)" => "0",
			"P₄(g)" => "58.91",
			"P₄O₁₀(s)" => "-2984",
			"Pb(s)" => "0",
			"Pb²⁺(aq)" => "-1.7",
			"Pb₃O₄(s)" => "-734.7",
			"PbBr₂(aq)" => "-244.8",
			"PbBr₂(s)" => "-278.7",
			"PbCl₂(s)" => "-359.2",
			"PbO(s)" => "-217.9",
			"PbO₂(s)" => "-277.4",
			"PbSO₄(s)" => "-919.94",
			"PCl₃(g)" => "-287",
			"PCl₃(l)" => "-319.7",
			"PCl₅(g)" => "-374.9",
			"PCl₅(s)" => "-443.5",
			"PH₃(g)" => "5.4",
			"S(s) - Monoclinic" => "0.33",
			"S(s) - Rhombic" => "0",
			"S²⁻(aq)" => "33.1",
			"SbCl₃(g)" => "-313.8",
			"SbCl₅(g) " => "-394.34",
			"SbH₃(g) " => "145.11",
			"SF₆(g)" => "-1209",
			"Si(s)" => "0",
			"SiO₂(s)" => "-859.4",
			"SiO₂(s) - α" => "-910.94",
			"Sn(s) - Gray" => "-2.09",
			"Sn(s) - White" => "0",
			"SnCl₂(s)" => "-349.8",
			"SnCl₄(l)" => "-545.2",
			"SnO(s)" => "-285.8",
			"SnO₂(s)" => "-580.7",
			"SO₂(g)" => "-296.83",
			"SO₃(g)" => "-395.72",
			"SO₄²⁻(aq)" => "-909.27",
			"Zn(s)" => "0",
			"Zn²⁺(aq)" => "-153.89",
			"ZnO(s)" => "-348.28",
			"ZnS(s)" => "-202.9"
		];

		$calEnthalpy = trim($request->calEnthalpy);
		$calFrom = trim($request->calFrom);
		$calFrom1 = trim($request->calFrom1);
		$q1 = trim($request->q1);
		$q1_unit = trim($request->q1_unit);
		$q2 = trim($request->q2);
		$q2_unit = trim($request->q2_unit);
		$v1 = trim($request->v1);
		$v1_unit = trim($request->v1_unit);
		$v2 = trim($request->v2);
		$v2_unit = trim($request->v2_unit);
		$p = trim($request->p);
		$p_unit = trim($request->p_unit);
		$changeQ = trim($request->changeQ);
		$changeQ_unit = trim($request->changeQ_unit);
		$changeV = trim($request->changeV);
		$changeV_unit = trim($request->changeV_unit);
		$a_n = trim($request->a_n);
		$rA = trim($request->rA);
		$rA_val = trim($request->rA_val);
		$rA_values = trim($request->rA_values);
		$b_n = trim($request->b_n);
		$rB = trim($request->rB);
		$rB_val = trim($request->rB_val);
		$rB_values = trim($request->rB_values);
		$c_n = trim($request->c_n);
		$rC = trim($request->rC);
		$rC_val = trim($request->rC_val);
		$rC_values = trim($request->rC_values);
		$d_n = trim($request->d_n);
		$pD = trim($request->pD);
		$pD_val = trim($request->pD_val);
		$pD_values = trim($request->pD_values);
		$e_n = trim($request->e_n);
		$pE = trim($request->pE);
		$pE_val = trim($request->pE_val);
		$pE_values = trim($request->pE_values);
		$f_n = trim($request->f_n);
		$pF = trim($request->pF);
		$pF_val = trim($request->pF_val);
		$pF_values = trim($request->pF_values);
		$rA_values_val = $DATA_A[$rA_values];
		$rB_values_val = $DATA_A[$rB_values];
		$rC_values_val = $DATA_A[$rC_values];
		$pD_values_val = $DATA_A[$pD_values];
		$pE_values_val = $DATA_A[$pE_values];
		$pF_values_val = $DATA_A[$pF_values];



		// dd($request->all());



		function sigFigs($value, $digits)
		{
			if ($value === 0.0) {
				$decimalPlaces = $digits - 1;
			} elseif ($value < 0) {
				$decimalPlaces = $digits - floor(log10($value * -1)) - 1;
			} else {
				$decimalPlaces = $digits - floor(log10($value)) - 1;
			}
			$decimalPlaces = (int) $decimalPlaces; // Ensure $decimalPlaces is an integer
			$answer = round($value, $decimalPlaces);
			return $answer;
		}

		// if (is_numeric($p)) {
			if (is_numeric($p)) {
				if ($p_unit === 'bar') {
					$p = $p / 0.00001;
				} elseif ($p_unit === 'psi') {
					$p = $p / 0.00014504;
				} elseif ($p_unit === 'at') {
					$p = $p / 0.000010197;
				} elseif ($p_unit === 'atm') {
					$p = $p / 0.00000987;
				} elseif ($p_unit === 'torr') {
					$p = $p / 0.0075;
				} elseif ($p_unit === 'hpa') {
					$p = $p / 0.01;
				} elseif ($p_unit === 'kpa') {
					$p = $p / 0.001;
				} elseif ($p_unit === 'mpa') {
					$p = $p / 0.000001;
				} elseif ($p_unit === 'gpa') {
					$p = $p / 0.000000001;
				} elseif ($p_unit === 'in_hg') {
					$p = $p / 0.0002953;
				} elseif ($p_unit === 'mmhg') {
					$p = $p / 0.0075;
				}
			}
		// } elseif (is_numeric($q1)) {
			if (is_numeric($q1)) {
				if ($q1_unit === 'J') {
					$q1 = $q1 ;
				}elseif ($q1_unit === 'kJ') {
					$q1 = $q1 * 1000;;
				} elseif ($q1_unit === 'MJ') {
					$q1 = $q1 / 1e-6;
				} elseif ($q1_unit === 'Wh') {
					$q1 = $q1 / 0.0002778;
				} elseif ($q1_unit === 'kWh') {
					$q1 = $q1 / 3.6e+6;
				} elseif ($q1_unit === 'ft_lbs') {
					$q1 = $q1 *  1.356 ;
				} elseif ($q1_unit === 'kcal') {
					$q1 = $q1* 4184 ;
				} elseif ($q1_unit === 'eV') {
					$q1 = $q1 /  6.242e+18;
				}
			}
		// } elseif (is_numeric($q2)) {
			if (is_numeric($q2)) {
				if ($q2_unit === 'J') {
					$q2 = $q2 ;
				}elseif ($q2_unit === 'kJ') {
					$q2 = $q2 * 1000;
				} elseif ($q2_unit === 'MJ') {
					$q2 = $q2 / 1e-6;
				} elseif ($q2_unit === 'Wh') {
					$q2 = $q2 / 0.0002778;
				} elseif ($q2_unit === 'kWh') {
					$q2 = $q2 / 3.6e+6;
				} elseif ($q2_unit === 'ft_lbs') {
					$q2 = $q2 *  1.356 ;
				} elseif ($q2_unit === 'kcal') {
					$q2 = $q2 * 4184;
				} elseif ($q2_unit === 'eV') {
					$q2 = $q2 /  6.242e+18;
				}
				// dd($q2);
			}
		// } elseif (is_numeric($changeQ)) {
			if (is_numeric($changeQ)) {
				if ($changeQ_unit === 'J') {
					$changeQ = $changeQ ;
				}elseif ($changeQ_unit === 'KJ') {
					$changeQ = $changeQ / 0.001;
				} elseif ($changeQ_unit === 'MJ') {
					$changeQ = $changeQ / 0.000001;
				} elseif ($changeQ_unit === 'Wh') {
					$changeQ = $changeQ / 0.0002778;
				} elseif ($changeQ_unit === 'kWh') {
					$changeQ = $changeQ / 3.6e+6;
				} elseif ($changeQ_unit === 'ft_lbs') {
					$changeQ = $changeQ *  1.356 ;
				} elseif ($changeQ_unit === 'kcal') {
					$changeQ = $changeQ / 0.000239;
				} elseif ($changeQ_unit === 'eV') {
					$changeQ = $changeQ / 6241534918267100245;
				}
			}
		// } elseif (is_numeric($v1)) {
			if (is_numeric($v1)) {
				if ($v1_unit === 'mm3') {
					$v1 = $v1 / 1000000000;
				} elseif ($v1_unit === 'cm3') {
					$v1 = $v1 / 1000000;
				} elseif ($v1_unit === 'dm3') {
					$v1 = $v1 / 1000;
				} elseif ($v1_unit === 'm3') {
					$v1 = $v1 ;
				} elseif ($v1_unit === 'cu_in') {
					$v1 = $v1 / 61024;
				} elseif ($v1_unit === 'cu_ft') {
					$v1 = $v1 / 35.315;
				} elseif ($v1_unit === 'cu_yd') {
					$v1 = $v1 / 1.308;
				} elseif ($v1_unit === 'ml') {
					$v1 = $v1 / 1000000;
				} elseif ($v1_unit === 'cl') {
					$v1 = $v1 / 100000;
				} elseif ($v1_unit === 'liters') {
					$v1 = $v1 / 1000;
				} elseif ($v1_unit === 'us_gal') {
					$v1 = $v1 / 264.17;
				} elseif ($v1_unit === 'uk_gal') {
					$v1 = $v1 / 219.97;
				} elseif ($v1_unit === 'us_fl_oz') {
					$v1 = $v1 / 33814;
				} elseif ($v1_unit === 'uk_fl_oz') {
					$v1 = $v1 / 35195;
				} elseif ($v1_unit === 'cups') {
					$v1 = $v1 / 4227;
				} elseif ($v1_unit === 'tbsp') {
					$v1 = $v1 / 66667;
				} elseif ($v1_unit === 'tsp') {
					$v1 = $v1 / 200000;
				} elseif ($v1_unit === 'us_qt') {
					$v1 = $v1 / 1056.7;
				} elseif ($v1_unit === 'uk_qt') {
					$v1 = $v1 / 879.9;
				} elseif ($v1_unit === 'us_pt') {
					$v1 = $v1 / 2113.4;
				} elseif ($v1_unit === 'uk_pt') {
					$v1 = $v1 / 1759.8;
				}
			}
		// } elseif (is_numeric($v2)) {
			if (is_numeric($v2)) {
				if ($v2_unit === 'mm3') {
					$v2 = $v2 / 1000000000;
				} elseif ($v2_unit === 'cm3') {
					$v2 = $v2 / 1000000;
				} elseif ($v2_unit === 'dm3') {
					$v2 = $v2 / 1000;
				} elseif ($v2_unit === 'm3') {
					$v2 = $v2 ;
				} elseif ($v2_unit === 'cu_in') {
					$v2 = $v2 / 61024;
				} elseif ($v2_unit === 'cu_ft') {
					$v2 = $v2 / 35.315;
				} elseif ($v2_unit === 'cu_yd') {
					$v2 = $v2 / 1.308;
				} elseif ($v2_unit === 'ml') {
					$v2 = $v2 / 1000000;
				} elseif ($v2_unit === 'cl') {
					$v2 = $v2 / 100000;
				} elseif ($v2_unit === 'liters') {
					$v2 = $v2 / 1000;
				} elseif ($v2_unit === 'us_gal') {
					$v2 = $v2 / 264.17;
				} elseif ($v2_unit === 'uk_gal') {
					$v2 = $v2 / 219.97;
				} elseif ($v2_unit === 'us_fl_oz') {
					$v2 = $v2 / 33814;
				} elseif ($v2_unit === 'uk_fl_oz') {
					$v2 = $v2 / 35195;
				} elseif ($v2_unit === 'cups') {
					$v2 = $v2 / 4227;
				} elseif ($v2_unit === 'tbsp') {
					$v2 = $v2 / 66667;
				} elseif ($v2_unit === 'tsp') {
					$v2 = $v2 / 200000;
				} elseif ($v2_unit === 'us_qt') {
					$v2 = $v2 / 1056.7;
				} elseif ($v2_unit === 'uk_qt') {
					$v2 = $v2 / 879.9;
				} elseif ($v2_unit === 'us_pt') {
					$v2 = $v2 / 2113.4;
				} elseif ($v2_unit === 'uk_pt') {
					$v2 = $v2 / 1759.8;
				}
			}
		// } elseif (is_numeric($changeV)) {
			if (is_numeric($changeV)) {
				if ($changeV_unit === 'mm3') {
					$changeV = $changeV / 1000000000;
				} elseif ($changeV_unit === 'cm3') {
					$changeV = $changeV / 1000000;
				} elseif ($changeV_unit === 'dm3') {
					$changeV = $changeV / 1000;
				} elseif ($changeV_unit === 'cu_in') {
					$changeV = $changeV / 61024;
				} elseif ($changeV_unit === 'cu_ft') {
					$changeV = $changeV / 35.315;
				} elseif ($changeV_unit === 'cu_yd') {
					$changeV = $changeV / 1.308;
				} elseif ($changeV_unit === 'ml') {
					$changeV = $changeV / 1000000;
				} elseif ($changeV_unit === 'cl') {
					$changeV = $changeV / 100000;
				} elseif ($changeV_unit === 'liters') {
					$changeV = $changeV / 1000;
				} elseif ($changeV_unit === 'us_gal') {
					$changeV = $changeV / 264.17;
				} elseif ($changeV_unit === 'uk_gal') {
					$changeV = $changeV / 219.97;
				} elseif ($changeV_unit === 'us_fl_oz') {
					$changeV = $changeV / 33814;
				} elseif ($changeV_unit === 'uk_fl_oz') {
					$changeV = $changeV / 35195;
				} elseif ($changeV_unit === 'cups') {
					$changeV = $changeV / 4227;
				} elseif ($changeV_unit === 'tbsp') {
					$changeV = $changeV / 66667;
				} elseif ($changeV_unit === 'tsp') {
					$changeV = $changeV / 200000;
				} elseif ($changeV_unit === 'us_qt') {
					$changeV = $changeV / 1056.7;
				} elseif ($changeV_unit === 'uk_qt') {
					$changeV = $changeV / 879.9;
				} elseif ($changeV_unit === 'us_pt') {
					$changeV = $changeV / 2113.4;
				} elseif ($changeV_unit === 'uk_pt') {
					$changeV = $changeV / 1759.8;
				}
			} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}

		if ($calEnthalpy === 'enthalpyFormula') {
			if ($calFrom === 'byStandard') {
				if (is_numeric($q1) && is_numeric($q2) && is_numeric($v1) && is_numeric($v2) && is_numeric($p)) {
					$changeH = ($q2 - $q1) + $p * ($v2 - $v1);
					$initial_enth = $q1 + ($v1 * $p) ;
					$Final_enth = $q2 + ($v2 * $p) ;
					$this->param['check'] = 'byStandard';
					$this->param['ans'] = sigFigs($changeH, 4);
					$this->param['initial_enth'] = $initial_enth;
					$this->param['Final_enth'] = $Final_enth;
					$this->param['q1'] = $q1;
					$this->param['q2'] = $q2;
					$this->param['v1'] = $v1;
					$this->param['v2'] = $v2;
					$this->param['p'] = $p;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} elseif ($calFrom === 'byChange') {
				if (is_numeric($changeQ) && is_numeric($changeV) && is_numeric($p)) {
					$changeH = $changeQ + $p * $changeV;
					$this->param['check'] = 'byChange';
					$this->param['ans'] = sigFigs($changeH, 4);
					$this->param['changeQ'] = $changeQ;
					$this->param['changeV'] = $changeV;
					$this->param['p'] = $p;
				} else {
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			} else {
				$this->param['error'] = 'Please fill all fields.';
				return $this->param;
			}
		} elseif ($calEnthalpy === 'reactionScheme') {
			// if ($calFrom1 === '2') {

			// 	$explode = explode('@@@', $rA_val);
			// 	if (count($explode) > 1) {
			// 		$rA_text = $explode[0];
			// 		$rA_value = $explode[1];
			// 	}
			// 	$explode = explode('@@@', $rB_val);
			// 	if (count($explode) > 1) {
			// 		$rB_text = $explode[0];
			// 		$rB_value = $explode[1];
			// 	}
			// 	$explode = explode('@@@', $pD_val);
			// 	if (count($explode) > 1) {
			// 		$pD_text = $explode[0];
			// 		$pD_value = $explode[1];
			// 	}

			// 	$explode = explode('@@@', $pE_val);
			// 	if (count($explode) > 1) {
			// 		$pE_text = $explode[0];
			// 		$pE_value = $explode[1];
			// 	}


			// 	if (is_numeric($a_n) && is_numeric($b_n)) {
			// 		if (($a_n <= 0 && $b_n <= 0) || ($rA_text === 'None' && $rB_text === 'None')) {
			// 			$this->param['error'] = 'Reaction requires atleast one reactant.';
			// 			return $this->param;
			// 		}
			// 	} else {
			// 		$this->param['error'] = 'Please fill all fields.';
			// 		return $this->param;
			// 	}
			// 	if (is_numeric($d_n) && is_numeric($e_n)) {
			// 		if (($d_n <= 0 && $e_n <= 0) || ($pD_text === 'None' && $pE_text === 'None')) {
			// 			$this->param['error'] = 'Reaction requires atleast one product.';
			// 			return $this->param;
			// 		}
			// 	} else {
			// 		$this->param['error'] = 'Please fill all fields.';
			// 		return $this->param;
			// 	}
			// 	$equation = '';
			// 	$text = '';
			// 	$text_vals = '';
			// 	$reactants = '';
			// 	if ($a_n !== '0' && $rA_text !== 'None') {
			// 		$equation = $a_n . ' ' . $rA_text;
			// 		$reactants = $a_n * $rA_value;
			// 		$text .= $rA_text . '@@@';
			// 		$text_vals .= $rA_value . '@@@';
			// 	}


			// 	if ($b_n !== '0' && $rB_text !== 'None') {
			// 		if (!empty($equation)) {
			// 			$equation .= ' + ' . $b_n . ' ' . $rB_text;
			// 			$reactants = $reactants + $b_n * $rB_value;
			// 		} else {
			// 			$equation .= $b_n . ' ' . $rB_text;
			// 			$reactants = $b_n * $rB_value;
			// 		}
			// 		$text .= $rB_text . '@@@';
			// 		$text_vals .= $rB_value . '@@@';
			// 	}
			// 	$equation1 = '';
			// 	$products = 0;

			// 	if ($d_n !== '0' && $pD_text !== 'None') {
			// 		$equation1 = $d_n . ' ' . $pD_text;
			// 		$products = $d_n * $pD_value;
			// 		$text .= $pD_text . '@@@';
			// 		$text_vals .= $pD_value . '@@@';
			// 	}

			// 	if ($e_n !== '0' && $pE_text !== 'None') {
			// 		if (!empty($equation1)) {
			// 			$equation1 .= ' + ' . $e_n . ' ' . $pE_text;
			// 			$products = $products + $e_n * $pE_value;
			// 		} else {
			// 			$equation1 .= $e_n . ' ' . $pE_text;
			// 			$products = $e_n * $pE_value;
			// 		}
			// 		$text .= $pE_text . '@@@';
			// 		$text_vals .= $pE_value . '@@@';
			// 	}
			// 	$reaction = $equation . ' → ' . $equation1;
			// 	$ans = $products - $reactants;
			// 	$text = explode('@@@', $text);
			// 	$text_vals = explode('@@@', $text_vals);
			// 	$this->param['ans'] = $ans;
			// 	$this->param['reaction'] = $reaction;
			// 	$this->param['text'] = $text;
			// 	$this->param['text_vals'] = $text_vals;
			// } else
			// if ($calFrom1 === '3') {
				$rA_text = $rA_values;
				$rA_value = $rA_values_val;
				
				$rB_text = $rA_values;
				$rB_value = $rB_values_val;

				$rC_text = $rC_values;
				$rC_value = $rC_values_val;

				$pD_text = $pD_values;
				$pD_value = $pD_values_val;

				$pE_text = $pE_values;
				$pE_value = $pE_values_val;
				
				$pF_text = $pF_values;
				$pF_value = $pF_values_val;
				if (($a_n <= 0 && $b_n <= 0 && $c_n <= 0) ||
					($rA_text === 'None' && $rB_text === 'None' && $rC_text === 'None')
				) {
					$this->param['error'] = 'Reaction requires at least one reactant.';
					return $this->param;
				}
				if (($d_n <= 0 && $e_n <= 0 && $f_n <= 0) ||
					($pD_text === 'None' && $pE_text === 'None' && $pF_text === 'None')
				) {
					$this->param['error'] = 'Reaction requires at least one product.';
					return $this->param;
				}
				$equation = '';
				$text = '';
				$text_vals = '';
				$reactants = '';

				if ($a_n !== '0' && $rA_text !== 'None') {
					$equation = $a_n . ' ' . $rA_text;
					$reactants = $a_n * $rA_value;
					$text .= $rA_text . '@@@';
					$text_vals .= $rA_value . '@@@';
				}
				if ($b_n !== '0' && $rB_text !== 'None') {
					if (!empty($equation)) {
						$equation .= ' + ' . $b_n . ' ' . $rB_text;
						$reactants = $reactants + $b_n * $rB_value;
					} else {
						$equation .= $b_n . ' ' . $rB_text;
						$reactants = $b_n * $rB_value;
					}
					$text .= $rB_text . '@@@';
					$text_vals .= $rB_value . '@@@';
				}
				if ($c_n !== '0' && $rC_text !== 'None') {
					if (!empty($equation)) {
						$equation .= ' + ' . $c_n . ' ' . $rC_text;
						$reactants = $reactants + $c_n * $rC_value;
					} else {
						$equation .= $c_n . ' ' . $rC_text;
						$reactants = $c_n * $rC_value;
					}
					$text .= $rC_text . '@@@';
					$text_vals .= $rC_value . '@@@';
				}
				$equation1 = '';
				$products = 0;
				if ($d_n !== '0' && $pD_text !== 'None') {
					$equation1 = $d_n . ' ' . $pD_text;
					$products = $d_n * $pD_value;
					$text .= $pD_text . '@@@';
					$text_vals .= $pD_value . '@@@';
				}
				if ($e_n !== '0' && $pE_text !== 'None') {
					if (!empty($equation1)) {
						$equation1 .= ' + ' . $e_n . ' ' . $pE_text;
						$products = $products + $e_n * $pE_value;
					} else {
						$equation1 .= $e_n . ' ' . $pE_text;
						$products = $e_n * $pE_value;
					}
					$text .= $pE_text . '@@@';
					$text_vals .= $pE_value . '@@@';
				}
				if ($f_n !== '0' && $pF_text !== 'None') {
					if (!empty($equation1)) {
						$equation1 .= ' + ' . $f_n . ' ' . $pF_text;
						$products = $products + $f_n * $pF_value;
					} else {
						$equation1 .= $f_n . ' ' . $pF_text;
						$products = $f_n * $pF_value;
					}
					$text .= $pF_text . '@@@';
					$text_vals .= $pF_value . '@@@';
				}
				$reaction = $equation . ' → ' . $equation1;
				$ans = $products - $reactants;
				$text = explode('@@@', $text);
				$text_vals = explode('@@@', $text_vals);
				// echo $text.'<br>';
				// die;
				// dd($equation);
				$this->param['ans'] = $ans;
				$this->param['reaction'] = $reaction;
				$this->param['text'] = $text;
				$this->param['text_vals'] = $text_vals;
			// } else {
			// 	$this->param['error'] = 'Please fill all fields.';
			// 	return $this->param;
			// }
		} else {
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
		}
		$this->param['RESULT'] = 1;
		return $this->param;
	}

	// amp hour calculator
	function amp($request){
		$find=$request->input('find');
		$vol=$request->input('vol');
		$bc=$request->input('bc');
		$bc_unit=$request->input('bc_unit');
		$wt_hour=$request->input('wt_hour');
		$wt_hour_unit=$request->input('wt_hour_unit');
		$c_rate=$request->input('c_rate');
		$type=$request->input('type');
		$load_size=$request->input('load_size');
		$load_duration=$request->input('load_duration');
		$tempchk=$request->input('temp_chk');
		$agechk=$request->input('age_chk');
		$batteries=$request->input('batteries');

		if($bc_unit == 'Ah'){
			$bc_unit = '1';
		}else if($bc_unit == 'mAh'){
			$bc_unit = '0.001';
		}

		if($wt_hour_unit == 'kJ'){
			$wt_hour_unit = '0.2778';
		}else if($wt_hour_unit == 'MJ'){
			$wt_hour_unit = '277.8';
		}else if($wt_hour_unit == 'Wh'){
			$wt_hour_unit = '1';
		}else if($wt_hour_unit == 'kWh'){
			$wt_hour_unit = '1000';
		}
		if($type=="first"){
			if($find=="1"){
				if(is_numeric($vol) && is_numeric($wt_hour) && is_numeric($c_rate)){
					$wt_val=$wt_hour*$wt_hour_unit;
					$ans=$wt_val/$vol;
					$bc_val=$ans;
					$dc=$c_rate*$bc_val;
				}else{
					$this->param['error'] = 'Please! Check Input';
					return $this->param;	
				}
			}else if($find=="2"){
				if(is_numeric($bc) && is_numeric($wt_hour) && is_numeric($c_rate)){
					$wt_val=$wt_hour*$wt_hour_unit;
					$bc_val=$bc*$bc_unit;
					$ans=$wt_val/$bc_val;
					$dc=$c_rate*$bc_val;
				}else{
					$this->param['error'] = 'Please! Check Input';
					return $this->param;	
				}
			}else if($find=="3"){
				if(is_numeric($bc) && is_numeric($vol) && is_numeric($c_rate)){
					$bc_val=$bc*$bc_unit;
					$ans=$bc_val*$vol;
					$dc=$c_rate*$bc_val;
				}else{
					$this->param['error'] = 'Please! Check Input';
					return $this->param;	
				}
			}
			$this->param['find']=$find;
			$this->param['dc']=$dc;
			$this->param['c_rate']=$c_rate;
			
		}else if($type=="second"){
			if(is_numeric($load_size) && is_numeric($load_duration)){
				$E3 =$load_size;
				$E4 =$load_duration;
				if($agechk=="checked"){
					$E9 = .05;	
				}else{
					$E9 = 0; 
				} 
				if($tempchk=="checked"){
					$E14 = .1;
				}else{
						$E14 = 0;
				}
				if($batteries=="gel"){
					$typeValue=1.15;
				}else if($batteries=="agm"){
					$typeValue=1.1;
				}else if($batteries=="flooded"){
					$typeValue=1.4;
				}
				$E25 = $E3*20;
				$E26 = $E4/20;
				$E27 = $E9+$E14+$typeValue;
				$E28 = pow($E25,$E27);
				$E29 = $E28*$E26;
				$E30 = log($E29,2.718281828);
				$E31 = $E30/$E27;
				$ans = ceil(pow(2.718281828,$E31))*2;
			}else{
				$this->param['error'] = 'Please! Check Input';
				return $this->param;	
			}
		}
		$this->param['type']=$type;
		$this->param['ans']=$ans;
		$this->param['RESULT'] = 1;

		return $this->param;
	}
	/*******************
      Angular Acceleration Calculator
    *******************/
	function angular_acceleration($request){
			$find=$request->find;
			$select1=$request->select1;
			$ta=$request->ta;
			$ta_unit=$request->ta_unit;
			$ra=$request->ra;
			$ra_unit=$request->ra_unit;
			$aa=$request->aa;
			$select2=$request->select2;
			$torque=$request->torque;
			$moment=$request->moment;
			$select3=$request->select3;
			$inv=$request->inv;
			$inv_unit=$request->inv_unit;
			$fnv=$request->fnv;
			$fnv_unit=$request->fnv_unit;
			$time=$request->time;
			$time_unit=$request->time_unit;
		

			if($ta_unit="m/s²"){
				$ta_unit=1;
			}else if($ta_unit="g"){
				$ta_unit=9.807;
			}

			if($inv_unit="rad/s"){
				$inv_unit=1;
			}else if($inv_unit="rpm"){
				$inv_unit=0.10472;
			}else if($inv_unit="Hz"){
				$inv_unit=6.283;
			}

			if($fnv_unit="rad/s"){
				$fnv_unit=1;
			}else if($fnv_unit="rpm"){
				$fnv_unit=0.10472;
			}else if($fnv_unit="Hz"){
				$fnv_unit=6.283;
			}
			
			if($time_unit="sec"){
				$time_unit=1;
			}else if($time_unit="min"){
				$time_unit=60;
			}else if($time_unit="hrs"){
				$time_unit=3600;
			}else if($time_unit="days"){
				$time_unit=86400;
			}else if($time_unit="wks"){
				$time_unit=604800;
			}else if($time_unit="mos"){
				$time_unit=2629800;
			}else if($time_unit="yrs"){
				$time_unit=31557600;
			}
			
		function radius_convert($unit3,$value3){
			if($unit3=="mm"){
				$val3=$value3*0.001;
			}else if($unit3=="cm"){
				$val3=$value3*0.01;
			}else if($unit3=="m"){
				$val3=$value3*1;
			}else if($unit3=="km"){
				$val3=$value3*1000;
			}else if($unit3=="in"){
				$val3=$value3*0.0254;
			}else if($unit3=="ft"){
				$val3=$value3*0.3048;
			}else if($unit3=="yd"){
				$val3=$value3*0.9144;
			}else if($unit3=="mi"){
				$val3=$value3*1609.3;
			}
			return $val3;
		}
		if($find=="0"){
			if($select1="angular_acceleration"){
				$method=1;
				if(is_numeric($ta) && is_numeric($ra)){//Angular Acceleration
					$ta_value=$ta*$ta_unit;
					$ra_value=radius_convert($ra_unit,$ra);
					$ans=$ta_value/$ra_value;
					$this->param['first_value']=$ta_value;
					$this->param['second_value']=$ra_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select1="radius"){//Radius
				$method=2;
				if(is_numeric($ta) && is_numeric($aa)){
					$ta_value=$ta*$ta_unit;
					$aa_value=$aa;
					$ans=$ta_value/$aa_value;
					$this->param['first_value']=$aa_value;
					$this->param['second_value']=$ta_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select1="tangential_acceleration"){//Tangential acceleration
				$method=3;
				if(is_numeric($ra) && is_numeric($aa)){
					$aa_value=$aa;
					$ra_value=radius_convert($ra_unit,$ra);
					$ans=$ra_value*$aa_value;
					$this->param['first_value']=$aa_value;
					$this->param['second_value']=$ra_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
		}else if($find="1"){
			if($select3=="angular_acceleration_three"){
				$method=4;
				if(is_numeric($time) && is_numeric($inv) && is_numeric($fnv)){
					$inv_value=$inv*$inv_unit;
					$fnv_value=$fnv*$fnv_unit;
					$time_value=$time*$time_unit;
					$ans=($fnv_value-$inv_value)/$time_value;
					$this->param['first_value']=$inv_value;
					$this->param['second_value']=$fnv_value;
					$this->param['third_value']=$time_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select3=="time"){
				$method=5;
				if(is_numeric($aa) && is_numeric($inv) && is_numeric($fnv)){
					$inv_value=$inv*$inv_unit;
					$fnv_value=$fnv*$fnv_unit;
					$aa_value=$aa;
					$ans=($fnv_value-$inv_value)/$aa_value;
					$this->param['first_value']=$inv_value;
					$this->param['second_value']=$fnv_value;
					$this->param['third_value']=$aa_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select3=="inv"){
				$method=6;
				if(is_numeric($time) && is_numeric($aa) && is_numeric($fnv)){
					$time_value=$time*$time_unit;
					$fnv_value=$fnv*$fnv_unit;
					$aa_value=$aa;
					$ans=$fnv_value-($time_value*$aa_value);
					$this->param['first_value']=$fnv_value;
					$this->param['second_value']=$time_value;
					$this->param['third_value']=$aa_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select3=="fnv"){
				$method=7;
				if(is_numeric($time) && is_numeric($aa) && is_numeric($inv)){
					$time_value=$time*$time_unit;
					$inv_value=$inv*$inv_unit;
					$aa_value=$aa;
					$ans=($time_value*$aa_value)+$inv_value;
					$this->param['first_value']=$inv_value;
					$this->param['second_value']=$time_value;
					$this->param['third_value']=$aa_value;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
		}else if($find="2"){
			if($select2=="angular_acceleration_two"){
				$method=8;
				if(is_numeric($torque) && is_numeric($moment)){
					$ans=$torque/$moment;
					$this->param['first_value']=$torque;
					$this->param['second_value']=$moment;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select2=="mass"){
				$method=9;
				if(is_numeric($torque) && is_numeric($aa)){
					$ans=$torque/$aa;
					$this->param['first_value']=$torque;
					$this->param['second_value']=$aa;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}else if($select2=="total_torque_two"){
				$method=10;
				if(is_numeric($aa) && is_numeric($moment)){
					$ans=$aa*$moment;
					$this->param['first_value']=$moment;
					$this->param['second_value']=$aa;
				}else{
					$this->param['error'] = 'Please fill all fields.';
					return $this->param;
				}
			}
		}
		$this->param['method']=$method;
		$this->param['ans']=$ans;
		$this->param['RESULT'] = 1;
		return $this->param;

	}

	/*******************
      Density Calculator Calculator
    *******************/
	function density($request) {
		$to_cals = $request->input('to_cals');
		$calc = $request->input('calc');

		$check = false;

		if ($calc == 'simple') {

			$check=true;

			if ($to_cals === "density") {
				$dens_unt = $request->input("dens_unt");
				$volOrg = $request->input("vol");
				$vol = $request->input("vol");
				$slvol = $request->input("slvol");
				$masOrg = $request->input("mas");
				$mas = $request->input("mas");
				$slmas = $request->input("slmas");

				if(!is_numeric($vol) || !is_numeric($mas)){
					$this->param['error'] = "Please check your input";
					return $this->param;
				}


				if ($slmas === "µg") {
					$mas = $mas / 1000000000;
				} else if ($slmas === "mg") {
					$mas = $mas / 1000000;
				} else if ($slmas === "g") {
					$mas = $mas / 1000;
				} else if ($slmas === "dag") {
					$mas = $mas / 100;
				} else if ($slmas === "t") {
					$mas = $mas * 1000;
				} else if ($slmas === "gr") {
					$mas = $mas / 15432.36;
				} else if ($slmas === "dr") {
					$mas = $mas / 564.383;
				} else if ($slmas === "oz") {
					$mas = $mas / 35.27396;
				} else if ($slmas === "lb") {
					$mas = $mas / 2.204623;
				} else if ($slmas === "stone") {
					$mas = $mas / 0.157473;
				} else if ($slmas === "US_ton") {
					$slmas = "US ton";
					$mas = $mas / 0.001102311;
				} else if ($slmas === "Long_ton") {
					$slmas = "Long ton";
					$mas = $mas / 0.000984207;
				} else if ($slmas === "Earths") {
					$mas = $mas * 5972000000000000000000000;
				} else if ($slmas === "Suns") {
					$mas = $mas * 1989000000000000000000000000000;
				} else if ($slmas === "me") {
					$mas = $mas / 1097769122809886380500592292548;
				} else if ($slmas === "mp") {
					$mas = $mas / 597863320194489720965829062;
				} else if ($slmas === "mn") {
					$mas = $mas / 597040375333014195351371993;
				} else if ($slmas === "u") {
					$mas = $mas / 602214000000000000000000000;
				} else if ($slmas === "oz_t") {
					$slmas = "oz t";
					$mas = $mas / 32.15075;
				}

				if ($slvol === "mm³") {
					$vol = $vol / 1000000000;
				} else if ($slvol === "cm³") {
					$vol = $vol / 1000000;
				} else if ($slvol === "dm³") {
					$vol = $vol / 1000;
				} else if ($slvol === "cu_in") {
					$slvol = "cu in";
					$vol = $vol / 61024;
				} else if ($slvol === "cu_ft") {
					$slvol = "cu ft";
					$vol = $vol / 35.315;
				} else if ($slvol === "cu_yd") {
					$slvol = "cu yd";
					$vol = $vol / 1.308;
				} else if ($slvol === "ml") {
					$vol = $vol / 1000000;
				} else if ($slvol === "cl") {
					$vol = $vol / 100000;
				} else if ($slvol === "liters") {
					$vol = $vol / 1000;
				} else if ($slvol === "hl") {
					$vol = $vol / 10;
				} else if ($slvol === "US_gal") {
					$slvol = "US gal";
					$vol = $vol / 264.17;
				} else if ($slvol === "UK_gal") {
					$slvol = "UK gal";
					$vol = $vol / 219.97;
				} else if ($slvol === "US_fl_oz") {
					$slvol = "US fl oz";
					$vol = $vol / 33814;
				} else if ($slvol === "UK_fl_oz") {
					$slvol = "UK fl oz";
					$vol = $vol / 35195;
				} else if ($slvol === "cups") {
					$vol = $vol / 4227;
				} else if ($slvol === "tbsp") {
					$vol = $vol / 66667;
				} else if ($slvol === "tsp") {
					$vol = $vol / 200000;
				} else if ($slvol === "US_qt") {
					$slvol = "US qt";
					$vol = $vol / 1056.7;
				} else if ($slvol === "UK_qt") {
					$slvol = "UK qt";
					$vol = $vol / 879.9;
				} else if ($slvol === "US_pt") {
					$slvol = "US pt";
					$vol = $vol / 2113.4;
				} else if ($slvol === "UK_pt") {
					$slvol = "UK pt";
					$vol = $vol / 1759.8;
				}

				$dnsCal = $mas / $vol;

				if ($dens_unt === "kg/dm³" || $dens_unt === "kg/L" || $dens_unt === "g/mL" || $dens_unt === "t/m³" || $dens_unt === "g/cm³") {
					$dnsCal = $dnsCal / 1000;
				} else if ($dens_unt === "oz/cu_in") {
					$dens_unt = "oz/cu in";
					$dnsCal = $dnsCal / 1730;
				} else if ($dens_unt === "lb/cu_in") {
					$dens_unt = "lb/cu in";
					$dnsCal = $dnsCal / 27680;
				} else if ($dens_unt === "lb/cu_ft") {
					$dens_unt = "lb/cu ft";
					$dnsCal = $dnsCal / 16.018;
				} else if ($dens_unt === "lb/cu_yd") {
					$dens_unt = "lb/cu yd";
					$dnsCal = $dnsCal * 1.6855549959513;
				} else if ($dens_unt === "lb/us_gal") {
					$dens_unt = "lb/US gal";
					$dnsCal = $dnsCal / 120;
				} else if ($dens_unt === "g/l") {
					$dnsCal = $dnsCal;
				} else if ($dens_unt === "g/dl") {
					$dnsCal = $dnsCal / 10;
				} else if ($dens_unt === "mg/l") {
					$dnsCal = $dnsCal * 1000;
				}

				$this->param["anstitle"] = "d";
				$this->param["ansval"] = $dnsCal . " " . $dens_unt;
				$this->param["anstitle1"] = "m";
				$this->param["ansval1"] = $masOrg . " " . $slmas;
				$this->param["anstitle2"] = "v";
				$this->param["ansval2"] = $volOrg . " " . $slvol;

				$this->param["ansval3"] = pow($volOrg,1/3) . " " . $slvol;
				
			} elseif ($to_cals === "volume") {
				$volu_unt = $request->input("volu_unt");
				$dnsOrg = $request->input("dns");
				$dns = $request->input("dns");
				$sldns = $request->input("sldns");
				$masOrg = $request->input("mas");
				$mas = $request->input("mas");
				$slmas = $request->input("slmas");

				if(!is_numeric($dns) || !is_numeric($mas)){
					$this->param['error'] = "Please check your input";
					return $this->param;
				}

				if ($slmas === "µg") {
					$mas = $mas / 1000000000;
				} else if ($slmas === "mg") {
					$mas = $mas / 1000000;
				} else if ($slmas === "g") {
					$mas = $mas / 1000;
				} else if ($slmas === "dag") {
					$mas = $mas / 100;
				} else if ($slmas === "t") {
					$mas = $mas * 1000;
				} else if ($slmas === "gr") {
					$mas = $mas / 15432.36;
				} else if ($slmas === "dr") {
					$mas = $mas / 564.383;
				} else if ($slmas === "oz") {
					$mas = $mas / 35.27396;
				} else if ($slmas === "lb") {
					$mas = $mas / 2.204623;
				} else if ($slmas === "stone") {
					$mas = $mas / 0.157473;
				} else if ($slmas === "US_ton") {
					$slmas = "US ton";
					$mas = $mas / 0.001102311;
				} else if ($slmas === "Long_ton") {
					$slmas = "Long ton";
					$mas = $mas / 0.000984207;
				} else if ($slmas === "Earths") {
					$mas = $mas * 5972000000000000000000000;
				} else if ($slmas === "Suns") {
					$mas = $mas * 1989000000000000000000000000000;
				} else if ($slmas === "me") {
					$mas = $mas / 1097769122809886380500592292548;
				} else if ($slmas === "mp") {
					$mas = $mas / 597863320194489720965829062;
				} else if ($slmas === "mn") {
					$mas = $mas / 597040375333014195351371993;
				} else if ($slmas === "u") {
					$mas = $mas / 602214000000000000000000000;
				} else if ($slmas === "oz_t") {
					$slmas = "oz t";
					$mas = $mas / 32.15075;
				}

				if ($sldns === "kg/dm³" || $sldns === "kg/L" || $sldns === "g/mL" || $sldns === "t/m³" || $sldns === "g/cm³") {
					$dns = $dns * 1000;
				} else if ($sldns === "oz/cu_in") {
					$sldns = "oz/cu in";
					$dns = $dns * 1730;
				} else if ($sldns === "lb/cu_in") {
					$sldns = "lb/cu in";
					$dns = $dns * 27680;
				} else if ($sldns === "lb/cu_ft") {
					$sldns = "lb/cu ft";
					$dns = $dns * 16.018;
				} else if ($sldns === "lb/cu_yd") {
					$sldns = "lb/cu yd";
					$dns = $dns / 1.6855549959513;
				} else if ($sldns === "lb/us_gal") {
					$sldns = "lb/us gal";
					$dns = $dns * 120;
				} else if ($sldns === "g/l") {
					$dns = $dns;
				} else if ($sldns === "g/dl") {
					$dns = $dns * 10;
				} else if ($sldns === "mg/l") {
					$dns = $dns / 1000;
				}

				$vol = $mas / $dns;
				if ($volu_unt === "mm³") {
					$vol = $vol * 1000000000;
				} else if ($volu_unt === "cm³") {
					$vol = $vol * 1000000;
				} else if ($volu_unt === "dm³") {
					$vol = $vol * 1000;
				} else if ($volu_unt === "cu_in") {
					$volu_unt = "cu in";
					$vol = $vol * 61024;
				} else if ($volu_unt === "cu_ft") {
					$volu_unt = "cu ft";
					$vol = $vol * 35.315;
				} else if ($volu_unt === "cu_yd") {
					$volu_unt = "cu yd";
					$vol = $vol * 1.308;
				} else if ($volu_unt === "ml") {
					$vol = $vol * 1000000;
				} else if ($volu_unt === "cl") {
					$vol = $vol * 100000;
				} else if ($volu_unt === "liters") {
					$vol = $vol * 1000;
				} else if ($volu_unt === "hl") {
					$vol = $vol * 10;
				} else if ($volu_unt === "US_gal") {
					$volu_unt = "US gal";
					$vol = $vol * 264.17;
				} else if ($volu_unt === "UK_gal") {
					$volu_unt = "UK gal";
					$vol = $vol * 219.97;
				} else if ($volu_unt === "US_fl_oz") {
					$volu_unt = "US fl oz";
					$vol = $vol * 33814;
				} else if ($volu_unt === "UK_fl_oz") {
					$volu_unt = "UK fl oz";
					$vol = $vol * 35195;
				} else if ($volu_unt === "cups") {
					$vol = $vol * 4227;
				} else if ($volu_unt === "tbsp") {
					$vol = $vol * 66667;
				} else if ($volu_unt === "tsp") {
					$vol = $vol * 200000;
				} else if ($volu_unt === "US_qt") {
					$volu_unt = "US qt";
					$vol = $vol * 1056.7;
				} else if ($volu_unt === "UK_qt") {
					$volu_unt = "UK qt";
					$vol = $vol * 879.9;
				} else if ($volu_unt === "US_pt") {
					$volu_unt = "US pt";
					$vol = $vol * 2113.4;
				} else if ($volu_unt === "UK_pt") {
					$volu_unt = "UK pt";
					$vol = $vol * 1759.8;
				}

				$this->param["anstitle"] = "v";
				$this->param["ansval"] = $vol . " " . $volu_unt;
				$this->param["anstitle2"] = "d";
				$this->param["ansval2"] = $dnsOrg . " " . $sldns;
				$this->param["anstitle1"] = "m";
				$this->param["ansval1"] = $masOrg . " " . $slmas;
				$this->param["ansval3"] = pow($vol,1/3) . " " . $volu_unt;

			} elseif ($to_cals === "mass") {
				$mass_unt = $request->input("mass_unt");
				$dnsOrg = $request->input("dns");
				$dns = $request->input("dns");
				$sldns = $request->input("sldns");
				$volOrg = $request->input("vol");
				$vol = $request->input("vol");
				$slvol = $request->input("slvol");

				if(!is_numeric($dns) || !is_numeric($vol)){
					$this->param['error'] = "Please check your input";
					return $this->param;
				}

				if ($sldns === "kg/dm³" || $sldns === "kg/L" || $sldns === "g/mL" || $sldns === "t/m³" || $sldns === "g/cm³") {
					$dns = $dns * 1000;
				} else if ($sldns === "oz/cu_in") {
					$sldns = "oz/cu in";
					$dns = $dns * 1730;
				} else if ($sldns === "lb/cu_in") {
					$sldns = "lb/cu in";
					$dns = $dns * 27680;
				} else if ($sldns === "lb/cu_ft") {
					$sldns = "lb/cu ft";
					$dns = $dns * 16.018;
				} else if ($sldns === "lb/cu_yd") {
					$sldns = "lb/cu yd";
					$dns = $dns / 1.6855549959513;
				} else if ($sldns === "lb/us_gal") {
					$sldns = "lb/us gal";
					$dns = $dns * 120;
				} else if ($sldns === "g/l") {
					$dns = $dns;
				} else if ($sldns === "g/dl") {
					$dns = $dns * 10;
				} else if ($sldns === "mg/l") {
					$dns = $dns / 1000;
				}

				if ($slvol === "mm³") {
					$vol = $vol / 1000000000;
				} else if ($slvol === "cm³") {
					$vol = $vol / 1000000;
				} else if ($slvol === "dm³") {
					$vol = $vol / 1000;
				} else if ($slvol === "cu_in") {
					$slvol = "cu in";
					$vol = $vol / 61024;
				} else if ($slvol === "cu_ft") {
					$slvol = "cu ft";
					$vol = $vol / 35.315;
				} else if ($slvol === "cu_yd") {
					$slvol = "cu yd";
					$vol = $vol / 1.308;
				} else if ($slvol === "ml") {
					$vol = $vol / 1000000;
				} else if ($slvol === "cl") {
					$vol = $vol / 100000;
				} else if ($slvol === "liters") {
					$vol = $vol / 1000;
				} else if ($slvol === "hl") {
					$vol = $vol / 10;
				} else if ($slvol === "US_gal") {
					$slvol = "US gal";
					$vol = $vol / 264.17;
				} else if ($slvol === "UK_gal") {
					$slvol = "UK gal";
					$vol = $vol / 219.97;
				} else if ($slvol === "US_fl_oz") {
					$slvol = "US fl oz";
					$vol = $vol / 33814;
				} else if ($slvol === "UK_fl_oz") {
					$slvol = "UK fl oz";
					$vol = $vol / 35195;
				} else if ($slvol === "cups") {
					$vol = $vol / 4227;
				} else if ($slvol === "tbsp") {
					$vol = $vol / 66667;
				} else if ($slvol === "tsp") {
					$vol = $vol / 200000;
				} else if ($slvol === "US_qt") {
					$slvol = "US qt";
					$vol = $vol / 1056.7;
				} else if ($slvol === "UK_qt") {
					$slvol = "UK qt";
					$vol = $vol / 879.9;
				} else if ($slvol === "US_pt") {
					$slvol = "US pt";
					$vol = $vol / 2113.4;
				} else if ($slvol === "UK_pt") {
					$slvol = "UK pt";
					$vol = $vol / 1759.8;
				}

				$mas = $dns * $vol;
				if ($mass_unt === "µg") {
					$mas = $mas * 1000000000;
				} else if ($mass_unt === "mg") {
					$mas = $mas * 1000000;
				} else if ($mass_unt === "g") {
					$mas = $mas * 1000;
				} else if ($mass_unt === "dag") {
					$mas = $mas * 100;
				} else if ($mass_unt === "t") {
					$mas = $mas / 1000;
				} else if ($mass_unt === "gr") {
					$mas = $mas * 15432.36;
				} else if ($mass_unt === "dr") {
					$mas = $mas * 564.383;
				} else if ($mass_unt === "oz") {
					$mas = $mas * 35.27396;
				} else if ($mass_unt === "lb") {
					$mas = $mas * 2.204623;
				} else if ($mass_unt === "stone") {
					$mas = $mas * 0.157473;
				} else if ($mass_unt === "US_ton") {
					$mass_unt = "US ton";
					$mas = $mas * 0.001102311;
				} else if ($mass_unt === "Long_ton") {
					$mass_unt = "Long ton";
					$mas = $mas * 0.000984207;
				} else if ($mass_unt === "Earths") {
					$mas = $mas / 5972000000000000000000000;
				} else if ($mass_unt === "Suns") {
					$mas = $mas / 1989000000000000000000000000000;
				} else if ($mass_unt === "me") {
					$mas = $mas * 1097769122809886380500592292548;
				} else if ($mass_unt === "mp") {
					$mas = $mas * 597863320194489720965829062;
				} else if ($mass_unt === "mn") {
					$mas = $mas * 597040375333014195351371993;
				} else if ($mass_unt === "u") {
					$mas = $mas * 602214000000000000000000000;
				} else if ($mass_unt === "oz_t") {
					$mass_unt = "oz t";
					$mas = $mas * 32.15075;
				}

				$this->param["anstitle"] = "m";
				$this->param["ansval"] = $mas . " " . $mass_unt;
				$this->param["anstitle2"] = "d";
				$this->param["ansval2"] = $dnsOrg . " " . $sldns;
				$this->param["anstitle1"] = "v";
				$this->param["ansval1"] = $volOrg . " " . $slvol;
				$this->param["ansval3"] = pow($volOrg,1/3) . " " . $slvol;

			}

		} else {
			$check = true;
			$dens_unt = $request->input("dens_unt");
			$sladvol = $request->input("sladvol");
			$masOrg = $request->input("mas");
			$mas = $request->input("mas");
			$slmas = $request->input("slmas");
			$lgnOrg = $request->input("lgn");
			$lgn = $request->input("lgn");
			$sllgn = $request->input("sllgn");
			$wdtOrg = $request->input("wdt");
			$wdt = $request->input("wdt");
			$slwdt = $request->input("slwdt");
			$hgtOrg = $request->input("hgt");
			$hgt = $request->input("hgt");
			$slhgt = $request->input("slhgt");

			if(!is_numeric($lgn) || !is_numeric($wdt) || !is_numeric($hgt) || !is_numeric($mas)){
				$this->param['error'] = "Please check your input";
				return $this->param;
			}

			if ($slmas === "µg") {
				$mas = $mas / 1000000000;
			} else if ($slmas === "mg") {
				$mas = $mas / 1000000;
			} else if ($slmas === "g") {
				$mas = $mas / 1000;
			} else if ($slmas === "dag") {
				$mas = $mas / 100;
			} else if ($slmas === "t") {
				$mas = $mas * 1000;
			} else if ($slmas === "gr") {
				$mas = $mas / 15432.36;
			} else if ($slmas === "dr") {
				$mas = $mas / 564.383;
			} else if ($slmas === "oz") {
				$mas = $mas / 35.27396;
			} else if ($slmas === "lb") {
				$mas = $mas / 2.204623;
			} else if ($slmas === "stone") {
				$mas = $mas / 0.157473;
			} else if ($slmas === "US_ton") {
				$slmas = "US ton";
				$mas = $mas / 0.001102311;
			} else if ($slmas === "Long_ton") {
				$slmas = "Long ton";
				$mas = $mas / 0.000984207;
			} else if ($slmas === "Earths") {
				$mas = $mas * 5972000000000000000000000;
			} else if ($slmas === "Suns") {
				$mas = $mas * 1989000000000000000000000000000;
			} else if ($slmas === "me") {
				$mas = $mas / 1097769122809886380500592292548;
			} else if ($slmas === "mp") {
				$mas = $mas / 597863320194489720965829062;
			} else if ($slmas === "mn") {
				$mas = $mas / 597040375333014195351371993;
			} else if ($slmas === "u") {
				$mas = $mas / 602214000000000000000000000;
			} else if ($slmas === "oz_t") {
				$slmas = "oz t";
				$mas = $mas / 32.15075;
			}

			if ($sllgn === "mm") {
				$lgn = $lgn / 10;
			} else if ($sllgn === "m") {
				$lgn = $lgn * 100;
			} else if ($sllgn === "in") {
				$lgn = $lgn * 2.54;
			} else if ($sllgn === "ft") {
				$lgn = $lgn * 30.48;
			} else if ($sllgn === "yd") {
				$lgn = $lgn * 91.44;
			}

			if ($slwdt === "mm") {
				$wdt = $wdt / 10;
			} else if ($slwdt === "m") {
				$wdt = $wdt * 100;
			} else if ($slwdt === "in") {
				$wdt = $wdt * 2.54;
			} else if ($slwdt === "ft") {
				$wdt = $wdt * 30.48;
			} else if ($slwdt === "yd") {
				$wdt = $wdt * 91.44;
			}

			if ($slhgt === "mm") {
				$hgt = $hgt / 10;
			} else if ($slhgt === "m") {
				$hgt = $hgt * 100;
			} else if ($slhgt === "in") {
				$hgt = $hgt * 2.54;
			} else if ($slhgt === "ft") {
				$hgt = $hgt * 30.48;
			} else if ($slhgt === "yd") {
				$hgt = $hgt * 91.44;
			}

			$vol = ($lgn * $wdt * $hgt)/1000000;
			if ($sladvol === "mm³") {
				$vol = $vol * 1000000000;
			} else if ($sladvol === "cm³") {
				$vol = $vol * 1000000;
			} else if ($sladvol === "dm³") {
				$vol = $vol * 1000;
			} else if ($sladvol === "cu_in") {
				$vol = $vol * 61024;
			} else if ($sladvol === "cu_ft") {
				$vol = $vol * 35.315;
			} else if ($sladvol === "cu_yd") {
				$vol = $vol * 1.308;
			} else if ($sladvol === "ml") {
				$vol = $vol * 1000000;
			} else if ($sladvol === "cl") {
				$vol = $vol * 100000;
			} else if ($sladvol === "liters") {
				$vol = $vol * 1000;
			} else if ($sladvol === "hl") {
				$vol = $vol * 10;
			} else if ($sladvol === "US_gal") {
				$vol = $vol * 264.17;
			} else if ($sladvol === "UK_gal") {
				$vol = $vol * 219.97;
			} else if ($sladvol === "US_fl_oz") {
				$vol = $vol * 33814;
			} else if ($sladvol === "UK_fl_oz") {
				$vol = $vol * 35195;
			} else if ($sladvol === "cups") {
				$vol = $vol * 4227;
			} else if ($sladvol === "tbsp") {
				$vol = $vol * 66667;
			} else if ($sladvol === "tsp") {
				$vol = $vol * 200000;
			} else if ($sladvol === "US_qt") {
				$vol = $vol * 1056.7;
			} else if ($sladvol === "UK_qt") {
				$vol = $vol * 879.9;
			} else if ($sladvol === "US_pt") {
				$vol = $vol * 2113.4;
			} else if ($sladvol === "UK_pt") {
				$vol = $vol * 1759.8;
			}

			$volss = $vol;
			if ($sladvol === "mm³") {
				$volss = $volss / 1000000000;
			} else if ($sladvol === "cm³") {
				$volss = $volss / 1000000;
			} else if ($sladvol === "dm³") {
				$volss = $volss / 1000;
			} else if ($sladvol === "cu_in") {
				$sladvol = "cu in";
				$volss = $volss / 61024;
			} else if ($sladvol === "cu_ft") {
				$sladvol = "cu ft";
				$volss = $volss / 35.315;
			} else if ($sladvol === "cu_yd") {
				$sladvol = "cu yd";
				$volss = $volss / 1.308;
			} else if ($sladvol === "ml") {
				$volss = $volss / 1000000;
			} else if ($sladvol === "cl") {
				$volss = $volss / 100000;
			} else if ($sladvol === "liters") {
				$volss = $volss / 1000;
			} else if ($sladvol === "hl") {
				$volss = $volss / 10;
			} else if ($sladvol === "US_gal") {
				$sladvol = "US gal";
				$volss = $volss / 264.17;
			} else if ($sladvol === "UK_gal") {
				$sladvol = "UK gal";
				$volss = $volss / 219.97;
			} else if ($sladvol === "US_fl_oz") {
				$sladvol = "US fl oz";
				$volss = $volss / 33814;
			} else if ($sladvol === "UK_fl_oz") {
				$sladvol = "UK fl oz";
				$volss = $volss / 35195;
			} else if ($sladvol === "cups") {
				$volss = $volss / 4227;
			} else if ($sladvol === "tbsp") {
				$volss = $volss / 66667;
			} else if ($sladvol === "tsp") {
				$volss = $volss / 200000;
			} else if ($sladvol === "US_qt") {
				$sladvol = "US qt";
				$volss = $volss / 1056.7;
			} else if ($sladvol === "UK_qt") {
				$sladvol = "UK qt";
				$volss = $volss / 879.9;
			} else if ($sladvol === "US_pt") {
				$sladvol = "US pt";
				$volss = $volss / 2113.4;
			} else if ($sladvol === "UK_pt") {
				$sladvol = "UK pt";
				$volss = $volss / 1759.8;
			}

			$dnsCal = $mas / $volss;

			if ($dens_unt === "kg/dm³" || $dens_unt === "kg/L" || $dens_unt === "g/mL" || $dens_unt === "t/m³" || $dens_unt === "g/cm³") {
				$dnsCal = $dnsCal / 1000;
			} else if ($dens_unt === "oz/cu_in") {
				$dens_unt = "oz/cu in";
				$dnsCal = $dnsCal / 1730;
			} else if ($dens_unt === "lb/cu_in") {
				$dens_unt = "lb/cu in";
				$dnsCal = $dnsCal / 27680;
			} else if ($dens_unt === "lb/cu_ft") {
				$dens_unt = "lb/cu ft";
				$dnsCal = $dnsCal / 16.018;
			} else if ($dens_unt === "lb/cu_yd") {
				$dens_unt = "lb/cu yd";
				$dnsCal = $dnsCal * 1.6855549959513;
			} else if ($dens_unt === "lb/us_gal") {
				$dens_unt = "lb/US gal";
				$dnsCal = $dnsCal / 120;
			} else if ($dens_unt === "g/l") {
				$dnsCal = $dnsCal;
			} else if ($dens_unt === "g/dl") {
				$dnsCal = $dnsCal / 10;
			} else if ($dens_unt === "mg/l") {
				$dnsCal = $dnsCal * 1000;
			}

			$this->param["anstitle"] = "d";
			$this->param["ansval"] = $dnsCal . " " . $dens_unt;
			$this->param["vlme"] = $vol . " " . $sladvol;
			$this->param["mass"] = $masOrg . " " . $slmas;
			$this->param["lngt"] = $lgnOrg . " " . $sllgn;
			$this->param["wdth"] = $wdtOrg . " " . $slwdt;
			$this->param["hgth"] = $hgtOrg . " " . $slhgt;
			$this->param["ansval3"] = pow($vol,1/3) . " " . $sladvol;

		}

		if ($check === true) {
			$this->param["RESULT"] = 1;
			return $this->param;
		} else {
			$this->param['error'] = "Please check your input";
			return $this->param;
		}

	}

	/*******************
      Work Calculator Calculator
    *******************/
	function work($request){
		$method=$_POST['method'];
		$method1=$_POST['method1'];
		$find=$_POST['find'];
		$find1=$_POST['find1'];
		$find2=$_POST['find2'];
		$f=$_POST['f'];
		$f_unit=$_POST['f_unit'];
		$d=$_POST['d'];
		$d_unit=$_POST['d_unit'];
		$w=$_POST['w'];
		$w_unit=$_POST['w_unit'];
		$p=$_POST['p'];
		$p_unit=$_POST['p_unit'];
		$t=$_POST['t'];
		$t_unit=$_POST['t_unit'];
		$m=$_POST['m'];
		$m_unit=$_POST['m_unit'];
		$v0=$_POST['v0'];
		$v0_unit=$_POST['v0_unit'];
		$v1=$_POST['v1'];
		$v1_unit=$_POST['v1_unit'];
	
		if(is_numeric($f)){
		if($f_unit==='kn'){
			$f=$f/0.001;
		}elseif($f_unit==='mn'){
			$f=$f/0.000001;
		}elseif($f_unit==='gn'){
			$f=$f/0.000000001;
		}elseif($f_unit==='tn'){
			$f=$f/0.000000000001;
		}
		}
		if(is_numeric($d)){
		if($d_unit==='mm'){
			$d=$d/1000;
		}elseif($d_unit==='cm'){
			$d=$d/100;
		}elseif($d_unit==='km'){
			$d=$d/0.001;
		}elseif($d_unit==='in'){
			$d=$d/39.37;
		}elseif($d_unit==='ft'){
			$d=$d/3.281;
		}elseif($d_unit==='yd'){
			$d=$d/1.0936;
		}elseif($d_unit==='mi'){
			$d=$d/0.0006214;
		}elseif($d_unit==='nmi'){
			$d=$d/0.00054;
		}
		}
		if(is_numeric($v0)){
		if($v0_unit==='kmh'){
			$v0=$v0/3.6;
		}elseif($v0_unit==='fts'){
			$v0=$v0/3.281;
		}elseif($v0_unit==='mph'){
			$v0=$v0/2.237;
		}elseif($v0_unit==='knots'){
			$v0=$v0/1.944;
		}elseif($v0_unit==='ftmin'){
			$v0=$v0/196.85;
		}
		}
		if(is_numeric($v1)){
		if($v1_unit==='kmh'){
			$v1=$v1/3.6;
		}elseif($v1_unit==='fts'){
			$v1=$v1/3.281;
		}elseif($v1_unit==='mph'){
			$v1=$v1/2.237;
		}elseif($v1_unit==='knots'){
			$v1=$v1/1.944;
		}elseif($v1_unit==='ftmin'){
			$v1=$v1/196.85;
		}
		}
		if(is_numeric($w)){
		if($w_unit==='kj'){
			$w=$w/0.001;
		}elseif($w_unit==='mj'){
			$w=$w/0.000001;
		}elseif($w_unit==='wh'){
			$w=$w/0.0002778;
		}elseif($w_unit==='kwh'){
			$w=$w/0.0000002778;
		}elseif($w_unit==='ft_lbs'){
			$w=$w/0.7376;
		}elseif($w_unit==='kcal'){
			$w=$w/0.000239;
		}elseif($w_unit==='ev'){
			$w=$w/6241534918267100245;
		}
		}
		if(is_numeric($m)){
		if($m_unit==='mg'){
			$m=$m/1000000;
		}elseif($m_unit==='g'){
			$m=$m/1000;
		}elseif($m_unit==='t'){
			$m=$m/0.001;
		}elseif($m_unit==='oz'){
			$m=$m/35.274;
		}elseif($m_unit==='lb'){
			$m=$m/2.2046;
		}elseif($m_unit==='stone'){
			$m=$m/0.15747;
		}elseif($m_unit==='us_ton'){
			$m=$m/0.0011023;
		}elseif($m_unit==='long_ton'){
			$m=$m/0.0009842;
		}
		}
		if(is_numeric($p)){
		if($p_unit==='mW'){
			$p=$p/1000;
		}elseif($p_unit==='kw'){
			$p=$p/0.001;
		}elseif($p_unit==='MW'){
			$p=$p/0.000001;
		}elseif($p_unit==='gw'){
			$p=$p/0.000000001;
		}elseif($p_unit==='btu_h'){
			$p=$p/3.412;
		}elseif($p_unit==='hp_l'){
			$p=$p/0.001341;
		}
		}
		if(is_numeric($t)){
		if($t_unit==='min'){
			$t=$t/0.016667;
		}elseif($t_unit==='hrs'){
			$t=$t/0.0002778;
		}elseif($t_unit==='days'){
			$t=$t/0.000011574;
		}elseif($t_unit==='wks'){
			$t=$t/0.0000016534;
		}elseif($t_unit==='mos'){
			$t=$t/0.00000038026;
		}elseif($t_unit==='yrs'){
			$t=$t/0.00000003169;
		}
		}
		if($method==='work' && $method1==='fnd' && $find==='work' && is_numeric($f) && is_numeric($d)){
		$w=$f*$d;
		$this->param['work']='work';
		$this->param['w']=round($w,4);
		$this->param['f']=$f;
		$this->param['d']=$d;
		}elseif($method==='work' && $method1==='fnd' && $find==='force' && is_numeric($w) && is_numeric($d)){
		$f=$w/$d;
		$this->param['force']='force';
		$this->param['f']=round($f,4);
		$this->param['w']=$w;
		$this->param['d']=$d;
		}elseif($method==='work' && $method1==='fnd' && $find==='dsplcmnt' && is_numeric($w) && is_numeric($f)){
		$d=$w/$f;
		$this->param['dsplcmnt']='dsplcmnt';
		$this->param['d']=round($d,4);
		$this->param['w']=$w;
		$this->param['f']=$f;
		}elseif($method==='work' && $method1==='velocity' && $find2==='work2' && is_numeric($m) && is_numeric($v0) && is_numeric($v1)){
		$s1=$m/2;
		$s2=pow($v1,2);
		$s3=pow($v0,2);
		$s4=$s2-$s3;
		$w=$s1*$s4;
		$this->param['work1']='work1';
		$this->param['w']=round($w,4);
		$this->param['m']=$m;
		$this->param['v0']=$v0;
		$this->param['v1']=$v1;
		$this->param['s1']=$s1;
		$this->param['s2']=$s2;
		$this->param['s3']=$s3;
		$this->param['s4']=$s4;
		}elseif($method==='work' && $method1==='velocity' && $find2==='v0' && is_numeric($m) && is_numeric($w) && is_numeric($v1)){
		$s1=pow($v1,2);
		$s2=2/$m;
		$s3=$s2*$w;
		$s4=$s1-$s3;
		$v0=sqrt($s4);
		$this->param['i_v']='i_v';
		$this->param['v0']=round($v0,4);
		$this->param['w']=$w;
		$this->param['m']=$m;
		$this->param['v1']=$v1;
		$this->param['s1']=$s1;
		$this->param['s2']=$s2;
		$this->param['s3']=$s3;
		$this->param['s4']=$s4;
		}elseif($method==='work' && $method1==='velocity' && $find2==='v1' && is_numeric($m) && is_numeric($w) && is_numeric($v0)){
		$s1=pow($v0,2);
		$s2=2/$m;
		$s3=$s2*$w;
		$s4=$s1+$s3;
		$v1=sqrt($s4);
		$this->param['f_v']='f_v';
		$this->param['v1']=round($v1,4);
		$this->param['w']=$w;
		$this->param['m']=$m;
		$this->param['v0']=$v0;
		$this->param['s1']=$s1;
		$this->param['s2']=$s2;
		$this->param['s3']=$s3;
		$this->param['s4']=$s4;
		}elseif($method==='work' && $method1==='velocity' && $find2==='mass' && is_numeric($w) && is_numeric($v0) && is_numeric($v1)){
		$s1=2*$w;
		$s2=pow($v1,2);
		$s3=pow($v0,2);
		$s4=$s2-$s3;
		if($s4 == '0'){
			$m=0;
		}else{
			$m=$s1/$s4;
		}
		$this->param['mass']='mass';
		$this->param['m']=round($m,4);
		$this->param['w']=$w;
		$this->param['v0']=$v0;
		$this->param['v1']=$v1;
		$this->param['s1']=$s1;
		$this->param['s2']=$s2;
		$this->param['s3']=$s3;
		$this->param['s4']=$s4;
		}elseif($method==='power' && $find1==='power' && is_numeric($w) && is_numeric($t)){
		$p=$w/$t;
		$this->param['power']='power';
		$this->param['p']=round($p,4);
		$this->param['w']=$w;
		$this->param['t']=$t;
		}elseif($method==='power' && $find1==='work1' && is_numeric($p) && is_numeric($t)){
		$w=$p*$t;
		$this->param['work2']='work2';
		$this->param['w']=round($w,4);
		$this->param['p']=$p;
		$this->param['t']=$t;
		}elseif($method==='power' && $find1==='time' && is_numeric($w) && is_numeric($p)){
		$t=$w/$p;
		$this->param['time']='time';
		$this->param['t']=round($t,4);
		$this->param['p']=$p;
		$this->param['w']=$w;
		}else{
		$this->param['error'] = 'Please fill all fields.';
		return $this->param;
		}
		$this->param['RESULT'] = 1;
		$this->param['f'] = $f;

		return $this->param;
	
	}

	// Resistance Calculator	
	function resistance($request){
		$operations = $request->input('operations');
		$band = $request->input('band');
		$first = $request->input('first');
		$second = $request->input('second');
		$third = $request->input('third');
		$multi = $request->input('multi');
		$tolerance = $request->input('tolerance');
		$temp = $request->input('temp');
		$x = $request->input('x');
		$length = $request->input('length');
		$l_unit = $request->input('l_unit');
		$diameter = $request->input('diameter');
		$d_unit = $request->input('d_unit');
		$conductivity = $request->input('conductivity');

		function con($a,$b){
			if($a == "ft"){
				$convert2 = $b / 3.281;
			}elseif ($a == "yd") {
				$convert2 = $b / 1.094;
			}elseif ($a == "in") {
				$convert2 = $b / 39.37;
			}elseif ($a == "mile") {
				$convert2 = $b * 1609;
			}elseif ($a == "m") {
				$convert2 = $b * 1;
			}elseif ($a == "km") {
				$convert2 = $b * 1000;
			}elseif ($a == "cm") {
				$convert2 = $b / 100;
			}
			return $convert2;
		}
		
		$bands = [
			'black' => [ 0, 1, ' Ω','0','250ppm/K (U)'],
			'brown' => [1, 10, ' Ω','±1% (F)','100ppm/K (S)'],
			'red' => [2, 100, ' Ω','±2% (G)','50ppm/K (R)'],
			'orange' => [3, 1, ' kΩ','±0.05% (W)','15ppm/K (P)'],
			'yellow' => [4, 10, ' kΩ','±0.02% (P)','25ppm/K (Q)'],
			'green' => [5, 100, ' kΩ','±0.5% (D)','20ppm/K (Z)'],
			'blue' => [6, 1, ' MΩ','±0.25% (C)','10ppm/K (Z)'],
			'violet' => [7, 10, ' MΩ','±0.1% (B)','5ppm/K (M)'],
			'grey' => [8, 100, ' MΩ','±0.01% (L)','1ppm/K (K)'],
			'white' => [9, 1, ' GΩ','0',0],
			'gold' => [0 , 0.1, ' Ω','±5% (J)',0],
			'silver' => [0, 0.01, ' Ω','±10% (K)',0]
		];
		if ($operations == "1") {
			if ($band == "3") {
				$first_data = $bands[$first];
				$second_data = $bands[$second];
				$multi_data = $bands[$multi];
				$answer = (($first_data[0].$second_data[0]) * $multi_data[1]).$multi_data[2]." ±20% (M)";
			}elseif ($band == "4") {
				$first_data = $bands[$first];
				$second_data = $bands[$second];
				$multi_data = $bands[$multi];
				$tol_data = $bands[$tolerance];
				$answer = (($first_data[0].$second_data[0]) * $multi_data[1]).$multi_data[2]." $tol_data[3]";
			}elseif ($band == "5") {
				$first_data = $bands[$first];
				$second_data = $bands[$second];
				$third_data = $bands[$third];
				$multi_data = $bands[$multi];
				$tol_data = $bands[$tolerance];
				if ($multi_data[1] == 10 || $multi_data[1] == 0.01) {
					$divide = 100;
				}elseif ($multi_data[1] == 100 || $multi_data[1] == 0.1) {
					$divide = 10;
				}else{
					$divide = $multi_data[1];
				}
				$answer = (($first_data[0].$second_data[0].$third_data[0]) / $divide).$multi_data[2]." $tol_data[3]";
			}elseif ($band == "6") {
				$first_data = $bands[$first];
				$second_data = $bands[$second];
				$third_data = $bands[$third];
				$multi_data = $bands[$multi];
				$tol_data = $bands[$tolerance];
				$temp_data = $bands[$temp];
				if ($multi_data[1] == 10 || $multi_data[1] == 0.01) {
					$divide = 100;
				}elseif ($multi_data[1] == 100 || $multi_data[1] == 0.1) {
					$divide = 10;
				}else{
					$divide = $multi_data[1];
				}
				$answer = (($first_data[0].$second_data[0].$third_data[0]) / $divide).$multi_data[2]." $tol_data[3] $temp_data[4]";
			}
		}elseif ($operations == "2") {
			if(!empty($x)){
				$check=true;
				$numbers=array_map('trim',array_filter(explode(',',$x)));
				foreach ($numbers as $value) {
					if (!is_numeric($value)) {
						$check=false;
					}
				}
				if ($check==true) {
					$answer = array_sum($numbers);
				}else {
					$this->param['error'] = 'Please! Check Your Input';
					return $this->param;
				}
			}else{
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;       
			}
		}elseif ($operations == "3") {
			if(is_numeric($length) && is_numeric($diameter) && is_numeric($conductivity)){
				$length = con($l_unit,$length);
		$diameter = con($d_unit,$diameter);
				$divide = ($diameter/2);
				$radius = 3.14 * pow($divide, 2);
				$mul = $radius * $conductivity;
				$answer = $length / $mul;
			}else{
				$this->param['error'] = 'Please! Check Your Input';
				return $this->param;       
			}
		}
		$this->param['operations'] = $operations;
		$this->param['answer'] = $answer;
		$this->param['RESULT'] = 1;
		return $this->param;
	}

		/*******************
     Acceleration Calculator
    *******************/
	function acceleration($request){
		
		if ($request->with==='1') {
			$check=false;
			if (isset($request->to_cal)) {
				if ($request->to_cal==='acc') {
					if (is_numeric($request->is) && is_numeric($request->fs) && is_numeric($request->time)) {
						$vi=$request->is;
						if ($request->isU==='ft/s') {
							$vi=$vi/3.281;
						}
						if ($request->isU==='km/h') {
							$vi=$vi/3.6;
						}
						if ($request->isU==='km/s') {
							$vi=$vi*1000;
						}
						if ($request->isU==='mi/s') {
							$vi=$vi*1609.35;
						}
						if ($request->isU==='mph') {
							$vi=$vi/2.237;
						}
						$vf=$request->fs;
						if ($request->fsU==='ft/s') {
							$vf=$vf/3.281;
						}
						if ($request->fsU==='km/h') {
							$vf=$vf/3.6;
						}
						if ($request->fsU==='km/s') {
							$vf=$vf*1000;
						}
						if ($request->fsU==='mi/s') {
							$vf=$vf*1609.35;
						}
						if ($request->fsU==='mph') {
							$vf=$vf/2.237;
						}
						$time=$request->time;
						if ($request->tU==='min') {
							$time=$time*60;
						}
						if ($request->tU==='h') {
							$time=$time*60*60;
						}
						$check=true;
						$a=round(($vf-$vi)/$time,4);
						$vi=$request->is." ".$request->isU;
						$vf=$request->fs." ".$request->fsU;
						$time=$request->time." ".$request->tU;
						if ($request->acU==='ft/s²') {
							$a=round($a*3.2808399,4);
						}
						$a=$a." ".$request->acU;
					}else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				}elseif ($request->to_cal==='time') {
					if (is_numeric($request->is) && is_numeric($request->fs) && is_numeric($request->ac)) {
						$vi=$request->is;
						if ($request->isU==='ft/s') {
							$vi=$vi/3.281;
						}
						if ($request->isU==='km/h') {
							$vi=$vi/3.6;
						}
						if ($request->isU==='km/s') {
							$vi=$vi*1000;
						}
						if ($request->isU==='mi/s') {
							$vi=$vi*1609.35;
						}
						if ($request->isU==='mph') {
							$vi=$vi/2.237;
						}
						$vf=$request->fs;
						if ($request->fsU==='ft/s') {
							$vf=$vf/3.281;
						}
						if ($request->fsU==='km/h') {
							$vf=$vf/3.6;
						}
						if ($request->fsU==='km/s') {
							$vf=$vf*1000;
						}
						if ($request->fsU==='mi/s') {
							$vf=$vf*1609.35;
						}
						if ($request->fsU==='mph') {
							$vf=$vf/2.237;
						}
						$a=$request->ac;
						if ($request->acU==='ft/s²') {
							$a=$a/3.2808399;
						}
						$check=true;
						$time=round(($vf-$vi)/$a,4);
						$vi=$request->is." ".$request->isU;
						$vf=$request->fs." ".$request->fsU;
						$a=$request->ac." ".$request->acU;
						if ($request->tU==='min') {
							$time=round($time/60,4);
						}
						if ($request->tU==='h') {
							$time=round($time/60/60,4);
						}
						$time=$time." ".$request->tU;
					}else{
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				}elseif ($request->to_cal==='fs') {
					if (is_numeric($request->is) && is_numeric($request->time) && is_numeric($request->ac)) {
						$vi=$request->is;
						if ($request->isU==='ft/s') {
							$vi=$vi/3.281;
						}
						if ($request->isU==='km/h') {
							$vi=$vi/3.6;
						}
						if ($request->isU==='km/s') {
							$vi=$vi*1000;
						}
						if ($request->isU==='mi/s') {
							$vi=$vi*1609.35;
						}
						if ($request->isU==='mph') {
							$vi=$vi/2.237;
						}
						$a=$request->ac;
						if ($request->acU==='ft/s²') {
							$a=$a/3.2808399;
						}
						$time=$request->time;
						if ($request->tU==='min') {
							$time=$time*60;
						}
						if ($request->tU==='h') {
							$time=$time*60*60;
						}
						$check=true;
						$vf=round(($a*$time)+$vi,4);
						$vi=$request->is." ".$request->isU;
						$time=$request->time." ".$request->tU;
						$a=$request->ac." ".$request->acU;
						if ($request->fsU==='ft/s') {
							$vf=round($vf*3.281,4);
						}
						if ($request->fsU==='km/h') {
							$vf=round($vf*3.6,4);
						}
						if ($request->fsU==='km/s') {
							$vf=round($vf/1000,4);
						}
						if ($request->fsU==='mi/s') {
							$vf=round($vf/1609.35,4);
						}
						if ($request->fsU==='mph') {
							$vf=round($vf/2.237,4);
						}
						$vf=$vf." ".$request->fsU;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				}elseif ($request->to_cal==='is') {
					if (is_numeric($request->fs) && is_numeric($request->time) && is_numeric($request->ac)) {
						$vf=$request->fs;
						if ($request->fsU==='ft/s') {
							$vf=$vf/3.281;
						}
						if ($request->fsU==='km/h') {
							$vf=$vf/3.6;
						}
						if ($request->fsU==='km/s') {
							$vf=$vf*1000;
						}
						if ($request->fsU==='mi/s') {
							$vf=$vf*1609.35;
						}
						if ($request->fsU==='mph') {
							$vf=$vf/2.237;
						}
						$a=$request->ac;
						if ($request->acU==='ft/s²') {
							$a=$a/3.2808399;
						}
						$time=$request->time;
						if ($request->tU==='min') {
							$time=$time*60;
						}
						if ($request->tU==='h') {
							$time=$time*60*60;
						}
						$check=true;
						$vi=round($vf-($a*$time),4);
						$vf=$request->fs." ".$request->fsU;
						$time=$request->time." ".$request->tU;
						$a=$request->ac." ".$request->acU;
						if ($request->isU==='ft/s') {
							$vi=round($vi*3.281,4);
						}
						if ($request->isU==='km/h') {
							$vi=round($vi*3.6,4);
						}
						if ($request->isU==='km/s') {
							$vi=round($vi/1000,4);
						}
						if ($request->isU==='mi/s') {
							$vi=round($vi/1609.35,4);
						}
						if ($request->isU==='mph') {
							$vi=round($vi/2.237,4);
						}
						$vi=$vi." ".$request->isU;
					} else {
						$this->param['error'] = 'Please enter any three values.';
						return $this->param;
					}	
				}
			} else {
				if (is_numeric($request->is) && is_numeric($request->fs) && is_numeric($request->time)) {
					if (is_numeric($request->ac)) {
						$this->param['error'] = 'Please enter any three values.';
						return $this->param;
					}else{
						$vi=$request->is;
						if ($request->isU==='ft/s') {
							$vi=$vi/3.281;
						}
						if ($request->isU==='km/h') {
							$vi=$vi/3.6;
						}
						if ($request->isU==='km/s') {
							$vi=$vi*1000;
						}
						if ($request->isU==='mi/s') {
							$vi=$vi*1609.35;
						}
						if ($request->isU==='mph') {
							$vi=$vi/2.237;
						}
						$vf=$request->fs;
						if ($request->fsU==='ft/s') {
							$vf=$vf/3.281;
						}
						if ($request->fsU==='km/h') {
							$vf=$vf/3.6;
						}
						if ($request->fsU==='km/s') {
							$vf=$vf*1000;
						}
						if ($request->fsU==='mi/s') {
							$vf=$vf*1609.35;
						}
						if ($request->fsU==='mph') {
							$vf=$vf/2.237;
						}
						$time=$request->time;
						if ($request->tU==='min') {
							$time=$time*60;
						}
						if ($request->tU==='h') {
							$time=$time*60*60;
						}
						$check=true;
						$a=round(($vf-$vi)/$time,4);
						$vi=$request->is." ".$request->isU;
						$vf=$request->fs." ".$request->fsU;
						$time=$request->time." ".$request->tU;
						if ($request->acU==='ft/s²') {
							$a=round($a*3.2808399,4);
						}
						$a=$a." ".$request->acU;
					}
				}
				elseif (is_numeric($request->is) && is_numeric($request->fs) && is_numeric($request->ac)) {
					if (!empty($request->time) || $request->time==='0') {
						$this->param['error'] = 'Please enter any three values.';
						return $this->param;
					}else{
						$vi=$request->is;
						if ($request->isU==='ft/s') {
							$vi=$vi/3.281;
						}
						if ($request->isU==='km/h') {
							$vi=$vi/3.6;
						}
						if ($request->isU==='km/s') {
							$vi=$vi*1000;
						}
						if ($request->isU==='mi/s') {
							$vi=$vi*1609.35;
						}
						if ($request->isU==='mph') {
							$vi=$vi/2.237;
						}
						$vf=$request->fs;
						if ($request->fsU==='ft/s') {
							$vf=$vf/3.281;
						}
						if ($request->fsU==='km/h') {
							$vf=$vf/3.6;
						}
						if ($request->fsU==='km/s') {
							$vf=$vf*1000;
						}
						if ($request->fsU==='mi/s') {
							$vf=$vf*1609.35;
						}
						if ($request->fsU==='mph') {
							$vf=$vf/2.237;
						}
						$a=$request->ac;
						if ($request->acU==='ft/s²') {
							$a=$a/3.2808399;
						}
						$check=true;
						$time=round(($vf-$vi)/$a,4);
						$vi=$request->is." ".$request->isU;
						$vf=$request->fs." ".$request->fsU;
						$a=$request->ac." ".$request->acU;
						if ($request->tU==='min') {
							$time=round($time/60,4);
						}
						if ($request->tU==='h') {
							$time=round($time/60/60,4);
						}
						$time=$time." ".$request->tU;
					}
				}
				elseif (is_numeric($request->is) && is_numeric($request->time) && is_numeric($request->ac)) {
					if (!empty($request->fs) || $request->fs==='0') {
						$this->param['error'] = 'Please enter any three values.';
						return $this->param;
					}else{
						$vi=$request->is;
						if ($request->isU==='ft/s') {
							$vi=$vi/3.281;
						}
						if ($request->isU==='km/h') {
							$vi=$vi/3.6;
						}
						if ($request->isU==='km/s') {
							$vi=$vi*1000;
						}
						if ($request->isU==='mi/s') {
							$vi=$vi*1609.35;
						}
						if ($request->isU==='mph') {
							$vi=$vi/2.237;
						}
						$a=$request->ac;
						if ($request->acU==='ft/s²') {
							$a=$a/3.2808399;
						}
						$time=$request->time;
						if ($request->tU==='min') {
							$time=$time*60;
						}
						if ($request->tU==='h') {
							$time=$time*60*60;
						}
						$check=true;
						$vf=round(($a*$time)+$vi,4);
						$vi=$request->is." ".$request->isU;
						$time=$request->time." ".$request->tU;
						$a=$request->ac." ".$request->acU;
						if ($request->fsU==='ft/s') {
							$vf=round($vf*3.281,4);
						}
						if ($request->fsU==='km/h') {
							$vf=round($vf*3.6,4);
						}
						if ($request->fsU==='km/s') {
							$vf=round($vf/1000,4);
						}
						if ($request->fsU==='mi/s') {
							$vf=round($vf/1609.35,4);
						}
						if ($request->fsU==='mph') {
							$vf=round($vf/2.237,4);
						}
						$vf=$vf." ".$request->fsU;
					}
				}
				elseif (is_numeric($request->fs) && is_numeric($request->time) && is_numeric($request->ac)) {
					if (!empty($request->is) || $request->is==='0') {
						$this->param['error'] = 'Please enter any three values';
						return $this->param;
						
					}else{
						$vf=$request->fs;
						if ($request->fsU==='ft/s') {
							$vf=$vf/3.281;
						}
						if ($request->fsU==='km/h') {
							$vf=$vf/3.6;
						}
						if ($request->fsU==='km/s') {
							$vf=$vf*1000;
						}
						if ($request->fsU==='mi/s') {
							$vf=$vf*1609.35;
						}
						if ($request->fsU==='mph') {
							$vf=$vf/2.237;
						}
						$a=$request->ac;
						if ($request->acU==='ft/s²') {
							$a=$a/3.2808399;
						}
						$time=$request->time;
						if ($request->tU==='min') {
							$time=$time*60;
						}
						if ($request->tU==='h') {
							$time=$time*60*60;
						}
						$check=true;
						$vi=round($vf-($a*$time),4);
						$vf=$request->fs." ".$request->fsU;
						$time=$request->time." ".$request->tU;
						$a=$request->ac." ".$request->acU;
						if ($request->isU==='ft/s') {
							$vi=round($vi*3.281,4);
						}
						if ($request->isU==='km/h') {
							$vi=round($vi*3.6,4);
						}
						if ($request->isU==='km/s') {
							$vi=round($vi/1000,4);
						}
						if ($request->isU==='mi/s') {
							$vi=round($vi/1609.35,4);
						}
						if ($request->isU==='mph') {
							$vi=round($vi/2.237,4);
						}
						$vi=$vi." ".$request->isU;
					}
				}
			}
			
			if ($check===true) {
				$this->param['vi'] = $vi;
				$this->param['vf'] = $vf;
				$this->param['time'] = $time;
				$this->param['a'] = $a;
				$this->param['RESULT'] = 1;
			return $this->param;
			}else{
			$this->param['error'] = 'Please fill all fields.';
			return $this->param;
			}
		}elseif ($request->with==='2') {
			// dd($request->ac);
			$check=false;
			if (is_numeric($request->is) && is_numeric($request->dis) && is_numeric($request->time)) {
				if (!empty($request->ac) || $request->ac===0) {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
				}else{
					$dis=$request->dis;
					if ($request->disU==='cm') {
						$dis=$dis/100;
					}
					if ($request->disU==='in') {
						$dis=$dis/39.37;
					}
					if ($request->disU==='ft') {
						$dis=$dis/3.281;
					}
					if ($request->disU==='km') {
						$dis=$dis/1000;
					}
					if ($request->disU==='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->disU==='yd') {
						$dis=$dis/1.094;
					}
					$vi=$request->is;
					if ($request->isU==='ft/s') {
						$vi=$vi/3.281;
					}
					if ($request->isU==='km/h') {
						$vi=$vi/3.6;
					}
					if ($request->isU==='km/s') {
						$vi=$vi*1000;
					}
					if ($request->isU==='mi/s') {
						$vi=$vi*1609.35;
					}
					if ($request->fsU==='mph') {
						$vi=$vi/2.237;
					}
					$time=$request->time;
					if ($request->tU==='min') {
						$time=$time*60;
					}
					if ($request->tU==='h') {
						$time=$time*60*60;
					}
					$check=true;
					$a=round(2*($dis-$vi*$time)/pow($time, 2),4);
					$vi=$request->is." ".$request->isU;
					$time=$request->time." ".$request->tU;
					$dis=$request->dis." ".$request->disU;
					if ($request->acU==='ft/s²') {
						$a=round($a*3.2808399,4);
					}
					$a=$a." ".$request->acU;
				}
			}
			elseif (is_numeric($request->is) && is_numeric($request->time) && is_numeric($request->ac)) {
				if (!empty($request->dis) || $request->dis===0) {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				}else{
					$vi=$request->is;
					if ($request->isU==='ft/s') {
						$vi=$vi/3.281;
					}
					if ($request->isU==='km/h') {
						$vi=$vi/3.6;
					}
					if ($request->isU==='km/s') {
						$vi=$vi*1000;
					}
					if ($request->isU==='mi/s') {
						$vi=$vi*1609.35;
					}
					if ($request->isU==='mph') {
						$vi=$vi/2.237;
					}
					$time=$request->time;
					if ($request->tU==='min') {
						$time=$time*60;
					}
					if ($request->tU==='h') {
						$time=$time*60*60;
					}
					$a=$request->ac;
					if ($request->acU==='ft/s²') {
						$a=$a/3.2808399;
					}
					$check=true;
					$dis=round(($vi*$time)+(0.5*$a*pow($time,2)),4);
					$vi=$request->is." ".$request->isU;
					$time=$request->time." ".$request->tU;
					$a=$request->ac." ".$request->acU;
					if ($request->disU==='cm') {
						$dis=round($dis*100,4);
					}
					if ($request->disU==='in') {
						$dis=round($dis*39.37,4);
					}
					if ($request->disU==='ft') {
						$dis=round($dis*3.281,4);
					}
					if ($request->disU==='km') {
						$dis=round($dis*1000,4);
					}
					if ($request->disU==='mi') {
						$dis=round($dis/1609.35,4);
					}
					if ($request->disU==='yd') {
						$dis=round($dis*1.094,4);
					}
					$dis=$dis." ".$request->disU;
				}
			}
			elseif (is_numeric($request->dis) && is_numeric($request->time) && is_numeric($request->ac)) {
				if (!empty($request->is) || $request->is===0) {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				}else{
					$dis=$request->dis;
					if ($request->disU==='cm') {
						$dis=$dis/100;
					}
					if ($request->disU==='in') {
						$dis=$dis/39.37;
					}
					if ($request->disU==='ft') {
						$dis=$dis/3.281;
					}
					if ($request->disU==='km') {
						$dis=$dis/1000;
					}
					if ($request->disU==='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->disU==='yd') {
						$dis=$dis/1.094;
					}
					$a=$request->ac;
					if ($request->acU==='ft/s²') {
						$a=$a/3.2808399;
					}
					$time=$request->time;
					if ($request->tU==='min') {
						$time=$time*60;
					}
					if ($request->tU==='h') {
						$time=$time*60*60;
					}
					$check=true;
					$vi=round(($dis-(0.5*$a*pow($time,2)))/$time,4);
					$dis=$request->dis." ".$request->disU;
					$time=$request->time." ".$request->tU;
					$a=$request->ac." ".$request->acU;
					if ($request->isU==='ft/s') {
						$vi=round($vi*3.281,4);
					}
					if ($request->isU==='km/h') {
						$vi=round($vi*3.6,4);
					}
					if ($request->isU==='km/s') {
						$vi=round($vi/1000,4);
					}
					if ($request->isU==='mi/s') {
						$vi=round($vi/1609.35,4);
					}
					if ($request->isU==='mph') {
						$vi=round($vi/2.237,4);
					}
					$vi=$vi." ".$request->isU;
				}
			}
			elseif (is_numeric($request->is) && is_numeric($request->dis) && is_numeric($request->ac)) {
				if (!empty($request->time) || $request->time===0) {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				}else{
					$dis=$request->dis;
					if ($request->disU==='cm') {
						$dis=$dis/100;
					}
					if ($request->disU==='in') {
						$dis=$dis/39.37;
					}
					if ($request->disU==='ft') {
						$dis=$dis/3.281;
					}
					if ($request->disU==='km') {
						$dis=$dis/1000;
					}
					if ($request->disU==='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->disU==='yd') {
						$dis=$dis/1.094;
					}
					$vi=$request->is;
					if ($request->isU==='ft/s') {
						$vi=$vi/3.281;
					}
					if ($request->isU==='km/h') {
						$vi=$vi/3.6;
					}
					if ($request->isU==='km/s') {
						$vi=$vi*1000;
					}
					if ($request->isU==='mi/s') {
						$vi=$vi*1609.35;
					}
					if ($request->isU==='mph') {
						$vi=$vi/2.237;
					}
					$a=$request->ac;
					if ($request->acU==='ft/s²') {
						$a=$a/3.2808399;
					}
					$check=true;
					$vf=(2*$a*$dis) + $vi;
					$time=round(($vf-$vi)/$a,4);
					$time_=round(((2*$dis)/($vf+$vi)),4);
					$vi=$request->is." ".$request->isU;
					$dis=$request->dis." ".$request->disU;
					$a=$request->ac." ".$request->acU;
					if ($request->tU==='min') {
						$time=round($time/60,4);
					}
					if ($request->tU==='h') {
						$time=round($time/60/60,4);
					}
					$time=$time." ".$request->tU;
				}
			}
			if ($check==true) {
				$this->param['vi'] = $vi;
				$this->param['dis'] = $dis;
				$this->param['time'] = $time;
				$this->param['a'] = $a;
				$this->param['RESULT'] = 1;
				return $this->param;
			}else{
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		}elseif ($request->with==='3') {
			$check=false;
			
			if (is_numeric($request->mass) && is_numeric($request->force)) {
				
				if (!empty($request->fac) || $request->fac===0) {
					
					$this->param['error'] = 'Please enter any two values';
					return $this->param;
				}else{
				
					$check=true;
					$mass=$request->mass;
					if ($request->masU==='g') {
						$mass=$mass/1000;
					}
					if ($request->masU==='mg') {
						$mass=$mass/1000000;
					}
					if ($request->masU==='lbs') {
						$mass=$mass/2.205;
					}
					$force=$request->force;
					if ($request->forceU==='KN') {
						$force=$force*1000;
					}
					if ($request->forceU==='MN') {
						$force=$force*1000000;
					}
					$a=round($force/$mass,4);
					$mass=$request->mass.' '.$request->masU;
					$force=$request->force.' '.$request->forceU;
					if ($request->facU==='ft/s²') {
						$a=round($a*3.2808399,4);
					}
					$a=$a.' '.$request->facU;
					// dd($check); 
				}
			}
			elseif (is_numeric($request->fac) && is_numeric($request->force)) {
				if (!empty($request->mass) || $request->mass===0) {

					$this->param['error'] = 'Please enter any two values';
					return $this->param;
				}else{
					$check=true;
					$a=$request->fac;
					if ($request->facU==='ft/s²') {
						$a=round($a/3.2808399,4);
					}
					$force=$request->force;
					if ($request->forceU==='KN') {
						$force=$force*1000;
					}
					if ($request->forceU==='MN') {
						$force=$force*1000000;
					}
					$mass=round($force/$a,4);
					$force=$request->force.' '.$request->forceU;
					$a=$request->fac.' '.$request->facU;
					if ($request->masU==='g') {
						$mass=round($mass*1000,4);
					}
					if ($request->masU==='mg') {
						$mass=round($mass*1000000,4);
					}
					if ($request->masU==='lbs') {
						$mass=round($mass*2.205,4);
					}
					$mass=$mass.' '.$request->masU;
				}
			}
			elseif (is_numeric($request->fac) && is_numeric($request->mass)) {
				if (!empty($request->force) || $request->force===0) {
					$this->param['error'] = 'Please enter any two values';
					return $this->param;
				}else{
					$check=true;
					$a=$request->fac;
					if ($request->facU==='ft/s²') {
						$a=round($a/3.2808399,4);
					}
					$mass=$request->mass;
					if ($request->masU==='g') {
						$mass=$mass/1000;
					}
					if ($request->masU==='mg') {
						$mass=$mass/1000000;
					}
					if ($request->masU==='lbs') {
						$mass=$mass/2.205;
					}
					$force=round($mass*$a,4);
					$mass=$request->mass.' '.$request->masU;
					$a=$request->fac.' '.$request->facU;
					if ($request->forceU==='KN') {
						$force=round($force/1000,4);
					}
					if ($request->forceU==='MN') {
						$force=round($force/1000000,4);
					}
					$force=$force.' '.$request->forceU;
				}
			}
			
			if ($check==true) {
		

				$this->param['force'] = $force;
				$this->param['mass'] = $mass;
				$this->param['a'] = $a;
				$this->param['RESULT'] = 1;
				return $this->param;
			}else{
				$this->param['error'] = 'Please check your input';
				return $this->param;

			}
		}elseif ($request->with==='4') {
			$check=false;
			if (is_numeric($request->iv) && is_numeric($request->fv) && is_numeric($request->ct)) {
				if (!empty($request->cac) || $request->cac=='0' || !empty($request->cdis) || $request->cdis=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$iv=$request->iv;
					if ($request->ivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->ivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->ivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->ivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->ivU=='mph') {
						$iv=$iv/2.237;
					}
					$fv=$request->fv;
					if ($request->fvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->fvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->fvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->fvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->fvU=='mph') {
						$fv=$fv/2.237;
					}
					$time=$request->ct;
					if ($request->ctU=='min') {
						$time=$time*60;
					}
					if ($request->ctU=='h') {
						$time=$time*60*60;
					}
					$a=round(($fv-$iv)/$time,4);
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$dis=($iv*$time) + (0.5*$a*pow($time, 2));
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					$iv=$request->iv.' '.$request->ivU;
					$fv=$request->fv.' '.$request->fvU;
					$time=$request->ct.' '.$request->ctU;
					if ($request->cacU=='ft/s²') {
						$a=round($a*3.2808399,4);
					}
					$a=$a.' '.$request->cacU;
					if ($request->cdisU=='cm') {
						$dis=round($dis*100,4);
					}
					if ($request->cdisU=='in') {
						$dis=round($dis*39.37,4);
					}
					if ($request->cdisU=='ft') {
						$dis=round($dis*3.281,4);
					}
					if ($request->cdisU=='km') {
						$dis=round($dis*1000,4);
					}
					if ($request->cdisU=='mi') {
						$dis=round($dis/1609.35,4);
					}
					if ($request->cdisU=='yd') {
						$dis=round($dis*1.094,4);
					}
					$dis=$dis.' '.$request->cdisU;
				}
			}
			elseif (is_numeric($request->iv) && is_numeric($request->fv) && is_numeric($request->cac)) {
				if (!empty($request->ct) || $request->ct=='0' || !empty($request->cdis) || $request->cdis=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$iv=$request->iv;
					if ($request->ivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->ivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->ivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->ivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->ivU=='mph') {
						$iv=$iv/2.237;
					}
					$fv=$request->fv;
					if ($request->fvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->fvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->fvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->fvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->fvU=='mph') {
						$fv=$fv/2.237;
					}
					$a=$request->cac;
					if ($request->cacU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$time=round(($fv-$iv)/$a,4);
					$dis=($iv*$time) + (0.5*$a*pow($time, 2));
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$iv=$request->iv.' '.$request->ivU;
					$fv=$request->fv.' '.$request->fvU;
					$a=$request->cac.' '.$request->cacU;
					if ($request->ctU=='min') {
						$time=round($time/60,4);
					}
					if ($request->ctU=='h') {
						$time=round($time/60/60,4);
					}
					$time=$time.' '.$request->ctU;
					if ($request->cdisU=='cm') {
						$dis=round($dis*100,4);
					}
					if ($request->cdisU=='in') {
						$dis=round($dis*39.37,4);
					}
					if ($request->cdisU=='ft') {
						$dis=round($dis*3.281,4);
					}
					if ($request->cdisU=='km') {
						$dis=round($dis*1000,4);
					}
					if ($request->cdisU=='mi') {
						$dis=round($dis/1609.35,4);
					}
					if ($request->cdisU=='yd') {
						$dis=round($dis*1.094,4);
					}
					$dis=$dis.' '.$request->cdisU;
				}
			}
			elseif (is_numeric($request->ct) && is_numeric($request->fv) && is_numeric($request->cac)) {
				if (!empty($request->iv) || $request->iv=='0' || !empty($request->cdis) || $request->cdis=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$time=$request->ct;
					if ($request->ctU=='min') {
						$time=$time*60;
					}
					if ($request->ctU=='h') {
						$time=$time*60*60;
					}
					$fv=$request->fv;
					if ($request->fvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->fvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->fvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->fvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->fvU=='mph') {
						$fv=$fv/2.237;
					}
					$a=$request->cac;
					if ($request->cacU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$iv=round($fv-($a*$time),4);
					$dis=($iv*$time) + (0.5*$a*pow($time, 2));
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$fv=$request->fv.' '.$request->fvU;
					$a=$request->cac.' '.$request->cacU;
					if ($request->ivU=='ft/s') {
						$iv=round($iv*3.281,4);
					}
					if ($request->ivU=='km/h') {
						$iv=round($iv*3.6,4);
					}
					if ($request->ivU=='km/s') {
						$iv=round($iv/1000,4);
					}
					if ($request->ivU=='mi/s') {
						$iv=round($iv/1609.35,4);
					}
					if ($request->ivU=='mph') {
						$iv=round($iv*2.237,4);
					}
					$iv=$iv.' '.$request->ivU;
					if ($request->cdisU=='cm') {
						$dis=round($dis*100,4);
					}
					if ($request->cdisU=='in') {
						$dis=round($dis*39.37,4);
					}
					if ($request->cdisU=='ft') {
						$dis=round($dis*3.281,4);
					}
					if ($request->cdisU=='km') {
						$dis=round($dis*1000,4);
					}
					if ($request->cdisU=='mi') {
						$dis=round($dis/1609.35,4);
					}
					if ($request->cdisU=='yd') {
						$dis=round($dis*1.094,4);
					}
					$dis=$dis.' '.$request->cdisU;
				}
			}elseif (is_numeric($request->ct) && is_numeric($request->iv) && is_numeric($request->cac)) {
				if (!empty($request->fv) || $request->fv=='0' || !empty($request->cdis) || $request->cdis=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$time=$request->ct;
					if ($request->ctU=='min') {
						$time=$time*60;
					}
					if ($request->ctU=='h') {
						$time=$time*60*60;
					}
					$iv=$request->iv;
					if ($request->ivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->ivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->ivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->ivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->ivU=='mph') {
						$iv=$iv/2.237;
					}
					$a=$request->cac;
					if ($request->cacU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$fv=round(($a*$time)+$iv,4);
					$dis=($iv*$time) + (0.5*$a*pow($time, 2));
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}


					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$iv=$request->iv.' '.$request->ivU;
					$time=$request->ct.' '.$request->ctU;
					$a=$request->cac.' '.$request->cacU;
					if ($request->fvU=='ft/s') {
						$fv=round($fv*3.281,4);
					}
					if ($request->fvU=='km/h') {
						$fv=round($fv*3.6,4);
					}
					if ($request->fvU=='km/s') {
						$fv=round($fv/1000,4);
					}
					if ($request->fvU=='mi/s') {
						$fv=round($fv/1609.35,4);
					}
					if ($request->fvU=='mph') {
						$fv=round($fv*2.237,4);
					}
					$fv=$fv.' '.$request->fvU;
					if ($request->cdisU=='cm') {
						$dis=round($dis*100,4);
					}
					if ($request->cdisU=='in') {
						$dis=round($dis*39.37,4);
					}
					if ($request->cdisU=='ft') {
						$dis=round($dis*3.281,4);
					}
					if ($request->cdisU=='km') {
						$dis=round($dis*1000,4);
					}
					if ($request->cdisU=='mi') {
						$dis=round($dis/1609.35,4);
					}
					if ($request->cdisU=='yd') {
						$dis=round($dis*1.094,4);
					}
					$dis=$dis.' '.$request->cdisU;
				}
			}elseif (is_numeric($request->cdis) && is_numeric($request->iv) && is_numeric($request->ct)) {
				if (!empty($request->fv) || $request->fv=='0' || !empty($request->cac) || $request->cac=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$dis=$request->cdis;
					if ($request->cdisU=='cm') {
						$dis=$dis/100;
					}
					if ($request->cdisU=='in') {
						$dis=$dis/39.37;
					}
					if ($request->cdisU=='ft') {
						$dis=$dis/3.281;
					}
					if ($request->cdisU=='km') {
						$dis=$dis/1000;
					}
					if ($request->cdisU=='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->cdisU=='yd') {
						$dis=$dis/1.094;
					}
					$time=$request->ct;
					if ($request->ctU=='min') {
						$time=$time*60;
					}
					if ($request->ctU=='h') {
						$time=$time*60*60;
					}
					$iv=$request->iv;
					if ($request->ivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->ivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->ivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->ivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->ivU=='mph') {
						$iv=$iv/2.237;
					}
					$a=round(2*($dis-($iv*$time))/pow($time, 2),4);
					$fv=round(($a*$time)+$iv,4);
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$iv=$request->iv.' '.$request->ivU;
					$time=$request->ct.' '.$request->ctU;
					$dis=$request->cdis.' '.$request->cdisU;
					if ($request->cacU=='ft/s²') {
						$a=round($a*3.2808399,4);
					}
					$a=$a.' '.$request->cacU;
					if ($request->fvU=='ft/s') {
						$fv=round($fv*3.281,4);
					}
					if ($request->fvU=='km/h') {
						$fv=round($fv*3.6,4);
					}
					if ($request->fvU=='km/s') {
						$fv=round($fv/1000,4);
					}
					if ($request->fvU=='mi/s') {
						$fv=round($fv/1609.35,4);
					}
					if ($request->fvU=='mph') {
						$fv=round($fv*2.237,4);
					}
					$fv=$fv.' '.$request->fvU;
				}
			}elseif (is_numeric($request->cdis) && is_numeric($request->fv) && is_numeric($request->ct)) {
				if (!empty($request->iv) || $request->iv=='0' || !empty($request->cac) || $request->cac=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$dis=$request->cdis;
					if ($request->cdisU=='cm') {
						$dis=$dis/100;
					}
					if ($request->cdisU=='in') {
						$dis=$dis/39.37;
					}
					if ($request->cdisU=='ft') {
						$dis=$dis/3.281;
					}
					if ($request->cdisU=='km') {
						$dis=$dis/1000;
					}
					if ($request->cdisU=='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->cdisU=='yd') {
						$dis=$dis/1.094;
					}
					$time=$request->ct;
					if ($request->ctU=='min') {
						$time=$time*60;
					}
					if ($request->ctU=='h') {
						$time=$time*60*60;
					}
					$fv=$request->fv;
					if ($request->fvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->fvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->fvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->fvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->fvU=='mph') {
						$fv=$fv/2.237;
					}
					$iv=round(((2*$dis)/$time)-$fv,4);
					$a=round(2*($dis-($iv*$time))/pow($time, 2),4);
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$fv=$request->fv.' '.$request->fvU;
					$time=$request->ct.' '.$request->ctU;
					$dis=$request->cdis.' '.$request->cdisU;
					if ($request->cacU=='ft/s²') {
						$a=round($a*3.2808399,4);
					}
					$a=$a.' '.$request->cacU;
					if ($request->ivU=='ft/s') {
						$iv=round($iv*3.281,4);
					}
					if ($request->ivU=='km/h') {
						$iv=round($iv*3.6,4);
					}
					if ($request->ivU=='km/s') {
						$iv=round($iv/1000,4);
					}
					if ($request->ivU=='mi/s') {
						$iv=round($iv/1609.35,4);
					}
					if ($request->ivU=='mph') {
						$iv=round($iv*2.237,4);
					}
					$iv=$iv.' '.$request->ivU;
				}
			}elseif (is_numeric($request->cdis) && is_numeric($request->iv) && is_numeric($request->cac)) {
				if (!empty($request->fv) || $request->fv=='0' || !empty($request->ct) || $request->ct=='0') {
					$this->session->set_flashdata('acc','Please enter any three values');
					return false;
				} else {
					$check=true;
					$dis=$request->cdis;
					if ($request->cdisU=='cm') {
						$dis=$dis/100;
					}
					if ($request->cdisU=='in') {
						$dis=$dis/39.37;
					}
					if ($request->cdisU=='ft') {
						$dis=$dis/3.281;
					}
					if ($request->cdisU=='km') {
						$dis=$dis/1000;
					}
					if ($request->cdisU=='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->cdisU=='yd') {
						$dis=$dis/1.094;
					}
					$iv=$request->iv;
					if ($request->ivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->ivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->ivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->ivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->ivU=='mph') {
						$iv=$iv/2.237;
					}
					$a=$request->cac;
					if ($request->cacU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$time=round(sqrt(2*$dis/$a),4);
					$fv=round(($a*$time)+$iv,4);
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$iv=$request->iv.' '.$request->ivU;
					$dis=$request->cdis.' '.$request->cdisU;
					$a=$request->cac.' '.$request->cacU;
					if ($request->fvU=='ft/s') {
						$fv=round($fv*3.281,4);
					}
					if ($request->fvU=='km/h') {
						$fv=round($fv*3.6,4);
					}
					if ($request->fvU=='km/s') {
						$fv=round($fv/1000,4);
					}
					if ($request->fvU=='mi/s') {
						$fv=round($fv/1609.35,4);
					}
					if ($request->fvU=='mph') {
						$fv=round($fv*2.237,4);
					}
					$fv=$fv.' '.$request->fvU;
					if ($request->ctU=='min') {
						$time=round($time/60,4);
					}
					if ($request->ctU=='h') {
						$time=round($time/60/60,4);
					}
					$time=$time.' '.$request->ctU;
				}
			}elseif (is_numeric($request->cdis) && is_numeric($request->fv) && is_numeric($request->cac)) {
				if (!empty($request->iv) || $request->iv=='0' || !empty($request->ct) || $request->ct=='0') {
					$this->param['error'] = 'Please enter any three values';
					return $this->param;
				} else {
					$check=true;
					$dis=$request->cdis;
					if ($request->cdisU=='cm') {
						$dis=$dis/100;
					}
					if ($request->cdisU=='in') {
						$dis=$dis/39.37;
					}
					if ($request->cdisU=='ft') {
						$dis=$dis/3.281;
					}
					if ($request->cdisU=='km') {
						$dis=$dis/1000;
					}
					if ($request->cdisU=='mi') {
						$dis=$dis*1609.35;
					}
					if ($request->cdisU=='yd') {
						$dis=$dis/1.094;
					}
					$fv=$request->fv;
					if ($request->fvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->fvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->fvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->fvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->fvU=='mph') {
						$fv=$fv/2.237;
					}
					$a=$request->cac;
					if ($request->cacU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$iv=round(sqrt(pow($fv,2) - (2*$a*$dis)),4);
					$time_=round(sqrt(2*$dis/$a),4);
					$time=round(($fv-$iv)/$a,4);
					if($time = "0.0"){
						$avev=0;
					}else{
						$avev=round($dis/$time,4);
					}
					$i=0;
					if ($time>0 && $time<1) {
						$in=0.1;
					}else{
						$in=1;
					}
					$graph="[ $i , $iv ] , ";
					$graph2="[ $i , 0 ] , ";
					while ($i<=$time) {
						$fv_=round(($a*$i)+$iv,4);
						$dis_=($iv*$i) + (0.5*$a*pow($i, 2));
						$graph.="[ $i , $fv_ ] ,";
						$graph2.="[ $i , $dis_ ] ,";
						if ($i==0 && (strpos($time,'.') !== false)) {
							$t1=sprintf("%.1f", $time);
							if ($time<0) {
								$i=$time + $t1;
							}else{
								$i=$time - $t1;
							}
						}
						if ($time<0) {
							$i=$i-$in;
						}else{
							$i=$i+$in;
						}
					}
					$this->param['graph'] = $graph;
					$this->param['graph2'] = $graph2;
					$fv=$request->fv.' '.$request->fvU;
					$dis=$request->cdis.' '.$request->cdisU;
					$a=$request->cac.' '.$request->cacU;
					if ($request->ivU=='ft/s') {
						$iv=round($iv*3.281,4);
					}
					if ($request->ivU=='km/h') {
						$iv=round($iv*3.6,4);
					}
					if ($request->ivU=='km/s') {
						$iv=round($iv/1000,4);
					}
					if ($request->ivU=='mi/s') {
						$iv=round($iv/1609.35,4);
					}
					if ($request->ivU=='mph') {
						$iv=round($iv*2.237,4);
					}
					$iv=$iv.' '.$request->ivU;
					if ($request->ctU=='min') {
						$time=round($time/60,4);
					}
					if ($request->ctU=='h') {
						$time=round($time/60/60,4);
					}
					$time=$time.' '.$request->ctU;
				}
			}
			if ($check==true) {
				$this->param['iv'] = $iv;
				$this->param['fv'] = $fv;
				$this->param['time'] = $time;
				$this->param['dis'] = $dis;
				$this->param['avev'] = $avev." m/s";
				$this->param['a'] = $a;
				$this->param['RESULT'] = 1;
				return $this->param;
			}else{
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
		}elseif ($request->with=='5') {
			$check=false;
			if (is_numeric($request->aiv) && is_numeric($request->afv) && is_numeric($request->itime) && is_numeric($request->ftime)) {
				if (!empty($request->avc) || $request->avc=='0') {
					$this->param['error'] = 'Please enter any four values';
					return $this->param;
				} else {
					$check=true;
					$iv=$request->aiv;
					if ($request->aivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->aivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->aivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->aivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->aivU=='mph') {
						$iv=$iv/2.237;
					}
					$fv=$request->afv;
					if ($request->afvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->afvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->afvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->afvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->afvU=='mph') {
						$fv=$fv/2.237;
					}
					$itime=$request->itime;
					if ($request->itU=='min') {
						$itime=$itime*60;
					}
					if ($request->itU=='h') {
						$itime=$itime*60*60;
					}
					$ftime=$request->ftime;
					if ($request->ftU=='min') {
						$ftime=$ftime*60;
					}
					if ($request->ftU=='h') {
						$ftime=$ftime*60*60;
					}
					$a=round(($fv-$iv)/($ftime-$itime),4);
					$iv=$request->aiv.' '.$request->aivU;
					$fv=$request->afv.' '.$request->afvU;
					$itime=$request->itime.' '.$request->itU;
					$ftime=$request->ftime.' '.$request->ftU;
					if ($request->avcU=='ft/s²') {
						$a=round($a*3.2808399,4);
					}
					$a=$a.' '.$request->avcU;
				}
			}
			elseif (is_numeric($request->avc) && is_numeric($request->afv) && is_numeric($request->itime) && is_numeric($request->ftime)) {
				if (!empty($request->aiv) || $request->aiv=='0') {
				$this->param['error'] = 'Please enter any four values';
				return $this->param;
				} else {
					$check=true;
					$a=$request->avc;
					if ($request->avcU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$fv=$request->afv;
					if ($request->afvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->afvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->afvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->afvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->afvU=='mph') {
						$fv=$fv/2.237;
					}
					$itime=$request->itime;
					if ($request->itU=='min') {
						$itime=$itime*60;
					}
					if ($request->itU=='h') {
						$itime=$itime*60*60;
					}
					$ftime=$request->ftime;
					if ($request->ftU=='min') {
						$ftime=$ftime*60;
					}
					if ($request->ftU=='h') {
						$ftime=$ftime*60*60;
					}
					$iv=round($fv-(($ftime-$itime)*$a),4);
					$a=$request->avc.' '.$request->avcU;
					$fv=$request->afv.' '.$request->afvU;
					$itime=$request->itime.' '.$request->itU;
					$ftime=$request->ftime.' '.$request->ftU;
					if ($request->aivU=='ft/s') {
						$vi=round($vi*3.281,4);
					}
					if ($request->aivU=='km/h') {
						$vi=round($vi*3.6,4);
					}
					if ($request->aivU=='km/s') {
						$vi=round($vi/1000,4);
					}
					if ($request->aivU=='mi/s') {
						$vi=round($vi/1609.35,4);
					}
					if ($request->aivU=='mph') {
						$vi=round($vi*2.237,4);
					}
					$iv=$iv.' '.$request->aivU;
				}
			}elseif (is_numeric($request->avc) && is_numeric($request->aiv) && is_numeric($request->itime) && is_numeric($request->ftime)) {
				if (!empty($request->afv) || $request->afv=='0') {
				$this->param['error'] = 'Please enter any four values';
				return $this->param;
				} else {
					$check=true;
					$a=$request->avc;
					if ($request->avcU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$iv=$request->aiv;
					if ($request->aivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->aivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->aivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->aivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->aivU=='mph') {
						$iv=$iv/2.237;
					}
					$itime=$request->itime;
					if ($request->itU=='min') {
						$itime=$itime*60;
					}
					if ($request->itU=='h') {
						$itime=$itime*60*60;
					}
					$ftime=$request->ftime;
					if ($request->ftU=='min') {
						$ftime=$ftime*60;
					}
					if ($request->ftU=='h') {
						$ftime=$ftime*60*60;
					}
					$fv=round((($ftime-$itime)*$a)+$iv,4);
					$a=$request->avc.' '.$request->avcU;
					$iv=$request->aiv.' '.$request->aivU;
					$itime=$request->itime.' '.$request->itU;
					$ftime=$request->ftime.' '.$request->ftU;
					if ($request->afvU=='ft/s') {
						$fv=round($fv*3.281,4);
					}
					if ($request->afvU=='km/h') {
						$fv=round($fv*3.6,4);
					}
					if ($request->afvU=='km/s') {
						$fv=round($fv/1000,4);
					}
					if ($request->afvU=='mi/s') {
						$fv=round($fv/1609.35,4);
					}
					if ($request->afvU=='mph') {
						$fv=round($fv*2.237,4);
					}
					$fv=$fv.' '.$request->afvU;
				}
			}elseif (is_numeric($request->aiv) && is_numeric($request->afv) && is_numeric($request->avc) && is_numeric($request->ftime)) {
				if (!empty($request->itime) || $request->itime=='0') {
				$this->param['error'] = 'Please enter any four values';
				return $this->param;
				} else {
					$check=true;
					$iv=$request->aiv;
					if ($request->aivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->aivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->aivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->aivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->aivU=='mph') {
						$iv=$iv/2.237;
					}
					$fv=$request->afv;
					if ($request->afvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->afvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->afvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->afvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->afvU=='mph') {
						$fv=$fv/2.237;
					}
					$a=$request->avc;
					if ($request->avcU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$ftime=$request->ftime;
					if ($request->ftU=='min') {
						$ftime=$ftime*60;
					}
					if ($request->ftU=='h') {
						$ftime=$ftime*60*60;
					}
					$itime=round($ftime-(($fv-$iv)/$a),4);
					$iv=$request->aiv.' '.$request->aivU;
					$fv=$request->afv.' '.$request->afvU;
					$a=$request->aiv.' '.$request->aivU;
					$ftime=$request->ftime.' '.$request->ftU;
					if ($request->itU=='min') {
						$itime=$itime*60;
					}
					if ($request->itU=='h') {
						$itime=$itime*60*60;
					}
					$itime=$itime.' '.$request->itU;
				}
			}elseif (is_numeric($request->aiv) && is_numeric($request->afv) && is_numeric($request->avc) && is_numeric($request->itime)) {
				if (!empty($request->ftime) || $request->ftime=='0') {
				$this->param['error'] = 'Please enter any four values';
				return $this->param;
				} else {
					$check=true;
					$iv=$request->aiv;
					if ($request->aivU=='ft/s') {
						$iv=$iv/3.281;
					}
					if ($request->aivU=='km/h') {
						$iv=$iv/3.6;
					}
					if ($request->aivU=='km/s') {
						$iv=$iv*1000;
					}
					if ($request->aivU=='mi/s') {
						$iv=$iv*1609.35;
					}
					if ($request->aivU=='mph') {
						$iv=$iv/2.237;
					}
					$fv=$request->afv;
					if ($request->afvU=='ft/s') {
						$fv=$fv/3.281;
					}
					if ($request->afvU=='km/h') {
						$fv=$fv/3.6;
					}
					if ($request->afvU=='km/s') {
						$fv=$fv*1000;
					}
					if ($request->afvU=='mi/s') {
						$fv=$fv*1609.35;
					}
					if ($request->afvU=='mph') {
						$fv=$fv/2.237;
					}
					$a=$request->avc;
					if ($request->avcU=='ft/s²') {
						$a=$a/3.2808399;
					}
					$itime=$request->itime;
					if ($request->itU=='min') {
						$itime=$itime*60;
					}
					if ($request->itU=='h') {
						$itime=$itime*60*60;
					}
					$ftime=round((($fv-$iv)/$a)+$itime,4);
					$iv=$request->aiv.' '.$request->aivU;
					$fv=$request->afv.' '.$request->afvU;
					$a=$request->aiv.' '.$request->aivU;
					$itime=$request->itime.' '.$request->ftU;
					if ($request->ftU=='min') {
						$ftime=$ftime*60;
					}
					if ($request->ftU=='h') {
						$ftime=$ftime*60*60;
					}
					$itime=$itime.' '.$request->itU;
				}
			}
			if ($check==true) {
				$this->param['iv'] = $iv;
				$this->param['fv'] = $fv;
				$this->param['itime'] = $itime;
				$this->param['ftime'] = $ftime;
				$this->param['a'] = $a;
				$this->param['RESULT'] = 1;
				return $this->param;
			}else{
				$this->param['error'] = 'Please check your input';
				return $this->param;
			}
			
		}
	}

	    /************************
		heat Calculator
	************************/	
    // Heat Index Calculator
    function heat($request){

        $find=$request->find;
        $temp=$request->temp;
        $temp_unit=$request->temp_unit;
        $hum=$request->hum;
        $hum_unit=$request->hum_unit;
        $dew_point=$request->dew_point;
        $dew_point_unit=$request->dew_point_unit;
	

        if ($temp_unit == '°C') {
            $temp_unit = "1";
        }
        elseif ($temp_unit == '°F') {
            $temp_unit = "2";
        }
        elseif ($temp_unit == '°K') {
            $temp_unit = "3";
        }

        if ($hum_unit == '%') {
            $hum_unit = "1";
        }
        elseif ($hum_unit == '‰') {
            $hum_unit ="0.1";
        }
        elseif ($hum_unit == '‱') {
            $hum_unit = "0.0001";
        }

        if ($dew_point_unit == '°C') {
            $dew_point_unit = "1";
        }
        elseif ($dew_point_unit == '°F') {
            $dew_point_unit = "2";
        }
        elseif ($dew_point_unit == '°K') {
            $dew_point_unit = "3";
        }
		$a=17.62;
		$b = 243.12;
		$tmv=$temp;
		if ($find==='1') {
			if($temp_unit=="1"){
				if(is_numeric($temp) && is_numeric($hum)){
					$tmp=$temp;
					$temp=($temp*9/5) + 32;
					if($hum > 100){
                        $this->param['error'] = 'Relative humidity cannot exceed 100%.';
				        return $this->param;
			    	}else if ($hum < 0) {
                        $this->param['error'] = 'Relative humidity cannot be less than 0%.';
				        return $this->param;
			    	}else if ($temp <= 40.0) {
				        $hi = $temp;
				    }else{
				       $hum=$hum*$hum_unit; 
			           $hitemp = 61.0+(($temp-68.0)*1.2)+($hum*0.094);
			           $fptemp = $temp;
			           $hifinal = 0.5*($fptemp+$hitemp);
				        if($hifinal > 79){
				            $hi = -42.379 + 2.04901523 * $temp + 10.14333127 * $hum - 0.22475541 * $temp * $hum - 6.83783 * (pow(10, -3)) * (pow($temp, 2)) - 5.481717 * (pow(10, -2)) * (pow($hum, 2)) + 1.22874 * (pow(10, -3)) * (pow($temp, 2)) * $hum + 8.5282 * (pow(10, -4)) * $temp * (pow($hum, 2)) - 1.99 * (pow(10, -6)) * (pow($temp, 2)) * (pow($hum,2));
				            if(($hum <= 13) && ($temp >= 80) && ($temp <= 112)) {
				                $adj1 = (13.0-$hum)/4.0;
				                $adj2 = sqrt((17.0-abs($temp-95.0))/17.0);
				                $adj = $adj1 * $adj2;
				                $hi = $hi - $adj;
				            }
				            else if (($hum > 85) && ($temp >= 80) && ($temp <= 87)) {
				                $adj1 = ($hum-85.0)/10.0;
				                $adj2 = (87.0-$temp)/5.0;
				                $adj = $adj1 * $adj2;
				                $hi = $hi + $adj;
				            }
				        }
				        else{
				            $hi = $hifinal;
				        }
			    	}
				}else{
                    $this->param['error'] = 'Please fill all fields.';
                    return $this->param;
				}
			}else if($temp_unit=="2"){
				$tmp=$temp;
				if (is_numeric($temp) && is_numeric($hum)) {
	  				if($hum > 100){
                        $this->param['error'] = 'Relative humidity cannot exceed 100%.';
                        return $this->param;
				    }
				    else if ($hum < 0) {
                        $this->param['error'] = 'Relative humidity cannot be less than 0%.';
                        return $this->param;
				    }
				    else if ($temp <= 40.0) {
				        $hi = $temp;
				    }
				    else{
				    	$hum=$hum*$hum_unit;
				    	$hitemp = 61.0+(($temp-68.0)*1.2)+($hum*0.094);
				        $fptemp = $temp;
				        $hifinal = 0.5*($fptemp+$hitemp);
				        if($hifinal > 79){
				            $hi = -42.379 + 2.04901523 * $temp + 10.14333127 * $hum - 0.22475541 * $temp * $hum - 6.83783 * (pow(10, -3)) * (pow($temp, 2)) - 5.481717 * (pow(10, -2)) * (pow($hum, 2)) + 1.22874 * (pow(10, -3)) * (pow($temp, 2)) * $hum + 8.5282 * (pow(10, -4)) * $temp * (pow($hum, 2)) - 1.99 * (pow(10, -6)) * (pow($temp, 2)) * (pow($hum,2));
				            if(($hum <= 13) && ($temp >= 80.0) && ($temp <= 112.0)) {
				               	$adj1 = (13.0-$hum)/4.0;
				                $adj2 = sqrt((17.0-abs($temp-95.0))/17.0);
				                $adj = $adj1 * $adj2;
				                $hi = $hi - $adj;
				            }
				            else if (($hum > 85) && ($temp >= 80) && ($temp <= 87)) {
				               	$adj1 = ($hum-85.0)/10.0;
				                $adj2 = (87.0-$temp)/5.0;
				                $adj = $adj1 * $adj2;
				                $hi = $hi + $adj;
				            }
				        }
				        else{
				            $hi = $hifinal;
				        }
					}
				}else{
                    $this->param['error'] = 'Please fill all fields.';
                    return $this->param;
				}
			}else if($temp_unit=="3"){
				$tmp=$temp;
				if(is_numeric($temp) && is_numeric($hum)){
					$hi=($temp-273.15)*9/5+32.0;
				}else{
                    $this->param['error'] = 'Please fill all fields.';
                    return $this->param;
				}
			}
			if ($temp_unit==='2') {
	  			$tmp=($tmp - 32) * 5/9;
	  		}elseif ($temp_unit==='3') {
	  			$tmp=($tmp) - 273.15;
	  		}
	  		$afun=log($hum/100) + ($a*$tmp/($b+$tmp));
		  	$dp=($b*$afun) / ($a-$afun);
		  	$this->param['dp']=$dp;
		}else if($find=="2"){
			if($temp_unit=="1" || $temp_unit=="2" && $dew_point_unit=="1" || $dew_point_unit=="2" || $dew_point_unit=="3"){
				if(is_numeric($temp) && is_numeric($dew_point)){
					$tmp=$temp;
					$dew=$dew_point;
					if($temp_unit=="1"){
						$temp=($temp*9/5) + 32;
					}if($dew_point_unit=="1"){
						$dew_point=($dew_point*9/5) + 32;
					}
				    $tc2 = ($temp-32) * .556;
				    $tdc2 = ($dew_point -32)* .556;
				    if ($tc2 < $tdc2){
                        $this->param['error'] = 'Dew Point temperature cannot be greater than the air temperature.';
                        return $this->param;
				    }
				    else if ($temp <= 40.0) {
				         $hi = $temp;
				    }else{
				    	$vaporpressure = 6.11*(pow(10,7.5*($tdc2/(237.7+$tdc2))));
				        $satvaporpressure = 6.11*(pow(10,7.5*($tc2/(237.7+$tc2))));
				        $RHumidity2 = round(100.0*($vaporpressure/$satvaporpressure));
				        $hitemp = 61.0+(($temp-68.0)*1.2)+($RHumidity2*0.094);
				        $fptemp = $temp;
				         $hifinal = 0.5*($fptemp+$hitemp);  
				        if($hifinal > 79.0){
				            $hi = -42.379+2.04901523*$temp+10.14333127*$RHumidity2-0.22475541*$temp*$RHumidity2-6.83783*(pow(10, -3))*(pow($temp, 2))-5.481717*(pow(10, -2))*(pow($RHumidity2, 2))+1.22874*(pow(10, -3))*(pow($temp, 2))*$RHumidity2+8.5282*(pow(10, -4))*$temp*(pow($RHumidity2, 2))-1.99*(pow(10, -6))*(pow($temp, 2))*(pow($RHumidity2,2));

				            if(($RHumidity2 <= 13.0) && ($temp >= 80.0) && ($temp<= 112.0)) {
				                $adj1 = (13.0-$RHumidity2)/4.0;
				                $adj2 = sqrt((17.0-abs($temp-95.0))/17.0);
				                $adj = $adj1 * $adj2;
				                $hi = $hi - $adj;
				            }
				            else if(($RHumidity2 > 85.0) && ($temp >= 80.0) && ($temp <= 87.0)) {
				                $adj1 = ($RHumidity2-85.0)/10.0;
				                $adj2 = (87.0-$temp)/5.0;
				                $adj = $adj1 * $adj2;
				                $hi = $hi + $adj; 
				            } 
				        }
				        else {
				             $hi = $hifinal;
				        }
				    }
				   
				    if ($temp_unit=='2') {
		  				$tmp=($tmp - 32) * 5/9;
		  			}elseif ($temp_unit=='3') {
		  				$tmp=($tmp) - 273.15;
		  			}
		  			if ($dew_point_unit=='2') {
		  				$dew=($dew - 32) * 5/9;
		  			}elseif ($dew_point_unit=='3') {
		  				$dew=($dew) - 273.15;
		  			}
		  			$rh_numer = 100.0*exp(($a*$dew)/($dew+$b));
		            $rh_denom = exp(($a*$tmp)/($tmp+$b));
		            $hum = $rh_numer/$rh_denom;
		            $this->param['hum']=$hum;
				}else{
                    $this->param['error'] = 'Please fill all fields.';
                    return $this->param;
				}
			}else{
				if(is_numeric($temp) && is_numeric($dew_point)){
					$hi=($temp-273.15)*1.8+32;
					$tmp=$temp;
					if ($temp_unit=='3') {
		  				$tmp=($tmp) - 273.15;
		  			}
		  			$rh_numer = 100.0*exp(($a*$dew_point)/($dew_point+$b));
		            $rh_denom = exp(($a*$tmp)/($tmp+$b));
		            $hum = $rh_numer/$rh_denom;
		            $this->param['hum']=$hum;
				}else{
                    $this->param['error'] = 'Please! Check Your Input';
                    return $this->param;
				}
			}
		}else if($find=="3"){
          
			if($dew_point_unit=="1" || $dew_point_unit=="2"){
				if(is_numeric($hum) && is_numeric($dew_point)){
					if($hum > 100){
                        $this->param['error'] = 'Relative humidity cannot exceed 100%.';
			        	return $this->param;
					}
				    else if ($hum <= 0) {
                        $this->param['error'] = 'Relative humidity must be greater than 0%';
			        	return $this->param;
				    }else{
						if ($dew_point_unit==='2') {
		  					$dew_point=($dew_point - 32) * 5/9;
			  			}elseif ($dew_point_unit==='3') {
			  				$dew_point=($dew_point) - 273.15;
			  			}
			  			$gamma = ($a*$dew_point)/($b+$dew_point);
			            $temp_numer = $b*($gamma-log($hum/100.0));
			            $temp_denom = $a+log($hum/100.0)-$gamma;
			            $temp = round($temp_numer/$temp_denom);
                       
			            $this->param['temp']=$temp;
			            $temp=($temp*9/5) + 32;
			            $tmp=$temp;
			            if ($temp <= 40.0) {
					        $hi = $temp;
					    }else{
					       $hum=$hum*$hum_unit; 
				           $hitemp = 61.0+(($temp-68.0)*1.2)+($hum*0.094);
				           $fptemp = $temp;
				           $hifinal = 0.5*($fptemp+$hitemp);
					        if($hifinal > 79){
					            $hi = -42.379 + 2.04901523 * $temp + 10.14333127 * $hum - 0.22475541 * $temp * $hum - 6.83783 * (pow(10, -3)) * (pow($temp, 2)) - 5.481717 * (pow(10, -2)) * (pow($hum, 2)) + 1.22874 * (pow(10, -3)) * (pow($temp, 2)) * $hum + 8.5282 * (pow(10, -4)) * $temp * (pow($hum, 2)) - 1.99 * (pow(10, -6)) * (pow($temp, 2)) * (pow($hum,2));
					            if(($hum <= 13) && ($temp >= 80) && ($temp <= 112)) {
					                $adj1 = (13.0-$hum)/4.0;
					                $adj2 = sqrt((17.0-abs($temp-95.0))/17.0);
					                $adj = $adj1 * $adj2;
					                $hi = $hi - $adj;
					            }
					            else if (($hum > 85) && ($temp >= 80) && ($temp <= 87)) {
					                $adj1 = ($hum-85.0)/10.0;
					                $adj2 = (87.0-$temp)/5.0;
					                $adj = $adj1 * $adj2;
					                $hi = $hi + $adj;
					            }
					        }
					        else{
					            $hi = $hifinal;
					        }
			    		}			    	
					}
				}else{
                    $this->param['error'] = 'Please fill all fields.';
                    return $this->param;
				}
			}
		}
		$ans=log($hum/100) + $a*$tmp/($b+$tmp);
		$this->param['tmv']=$tmv;
		$this->param['temp_unit']=$temp_unit;
		$this->param['ans']=$ans;
		$this->param['hi']=$hi;
		$this->param['humm']=$hum;
		$this->param['RESULT'] = 1;

        return $this->param;

	}
		// wave_period caluclator
		public function wave_period($request)
		{
			//dd($request->all());
			$dateTypes=$request->sim_adv;
			$frequency=$request->frequency;
			$frequency_sec=$request->frequency_sec;
			$wavelength=$request->wavelength;
			$wave_speed=$request->wave_speed;

				if($dateTypes === "simple"){
					if(is_numeric($frequency)){
							if ($frequency > 0) {
								$wavePeriod = 1 / $frequency;
							} else {
								$this->param['error'] = 'Frequency must be greater than zero.';  
							}
							$this->param['wavePeriod'] = $wavePeriod;
							$this->param['sim_adv'] = $dateTypes;
						} else {
							$this->param['error'] = 'Please! Check Your Input.';
							return $this->param;
						}
					$this->param['RESULT'] = 1;
					return $this->param;
	
				}elseif($dateTypes === "advance"){
					if(is_numeric($wavelength)  && is_numeric($wave_speed) ){

						$wave_period = $wavelength / $wave_speed;
						$this->param['wave_period'] = $wave_period;
						$this->param['sim_adv'] = $dateTypes;
						$this->param['RESULT'] = 1;
						return $this->param;
					} else {
						$this->param['error'] = 'Please! Check Your Input.';
						return $this->param;
					}
				}
			
		}

}
