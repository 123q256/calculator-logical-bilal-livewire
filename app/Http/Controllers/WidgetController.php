<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public $device;
    public $forCurrency;
	function __construct() {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){ 
            $this->device="mobile";
        }else{
            $this->device="desktop";
        }
        $this->forCurrency = [
            'payback-period-calculator',
            'asphalt-calculator',
            'cap-rate-calculator',
            'marginal-cost-calculator',
            'freight-class-calculator' ,
            'overtime-calculator' ,
            'board-foot-calculator' ,
            'discount-calculator' ,
            'pay-raise-calculator' ,
            "tesla-charging-calculator" ,
            'variable-cost-calculator' ,
            'lawn-mowing-cost-calculator' ,
            'labor-cost-calculator' ,
            'wedding-budget-calculator' ,
            'fuel-cost-calculator' ,
            'roas-calculator' ,
            'river-rock-calculator' ,
            'earnings-per-share-calculator' ,
            'gold-cost-per-pound-calculator' ,
            'cost-per-mile-driving-calculator' ,
            'cash-back-calculator' ,
            'water-bill-calculator' ,
            'sod-calculator' ,
            'marginal-revenue-calculator' ,
            'split-bill-calculator' ,
            'stone-calculator' ,
            'out-the-door-price-calculator' ,
            'reverse-sales-tax-calculator' ,
            'monthly-income-calculator' ,
            'actual-cash-value-calculator' ,
            'cross-price-elasticity-calculator' ,
            'buying-power-calculator' ,
            'price-calculator' ,
            'round-to-the-nearest-cent' ,
            'break-even-point-calculator' ,
            'real-estate-commission-calculator' ,
            'hourly-pay-calculator' ,
            'concrete-block-calculator' ,
            'rent-increase-calculator' ,
            'percent-of-sales-calculator' ,
            'cost-of-goods-sold-calculator' ,
            'youtube-revenue-calculator' ,
            'book-value-calculator' ,
            'carpet-calculator' ,
            'framing-calculator' ,
            'npv-calculator' ,
            'roofing-calculator' ,
            "cost-basis-calculator" ,
            "food-cost-calculator" ,
            "arv-calculator" ,
            "energy-cost-calculator" ,
            "bond-price-calculator" ,
            "average-down-stock-calculator" ,
            "decking-calculator" ,
            "contribution-margin-calculator" ,
            "net-worth-calculator" ,
            "discounted-cash-flow-calculator" ,
            "profitability-index-calculator" ,
            "dog-food-calculator" ,
            "pet-sitter-rates-calculator" ,
            "revenue-calculator" ,
            "real-gdp-calculator" ,
            "retained-earnings-calculator" ,
            "debt-to-income-ratio-calculator" ,
            "zakat-calculator" ,
             "scrap-gold-calculator" ,
            "va-disability-calculator" ,
            "cagr-calculator",
			"square-meter-calculator",
			"growth-rate-calculator",
			'options-profit-calculator',
			'dividend-yield-calculator',
			'agi-calculator',
			'mpc-calculator',
			'future-value-of-annuity',
			'maximum-profit-calculator',
			'income-elasticity-of-demand-calculator',
			'paypal-fee-calculator',
			'enterprise-value-calculator',
			'cpc-calculator',
			'macrs-depreciation-calculator',
			'markup-calculator',
			'capm-calculator',
			'cost-of-equity-calculator',
			'salary-calculator',
			'consumer-surplus-calculator',
			'stock-calculator',
			'markdown-calculator',
			'gross-income-calculator',
			'turo-calculator',
			'salestax-calculator',
			'commission-calculator'
        ];
    }

    public function preview($url){
		$request = request();
        $check=$_SERVER['REQUEST_URI'];
		$file = $url;
        if (file_exists("keys/".$file.".txt")) {
			$cal_data=file_get_contents("keys/".$file.".txt");
			$cal_data=json_decode($cal_data);
		}
        if (isset($cal_data)) {
            if (isset($request->submit)) {
                $fun_name=explode('-', $url);
			    $fun=$fun_name[0];
                if ($url=='twos-complement-calculator') {
					$fun='binary_add';
				}elseif($url=='ideal-gas-law-calculator'){
					$fun='gas';
				}elseif ($url=='waist-to-height-ratio-calculator') {
					$fun='waist_height';
				}elseif ($url=='6-minute-walk-test') {
					$fun='walk';
				}elseif($url=='percent-yield-calculator'){
					$fun='percent_yield';
				}elseif ($url=='body-shape-calculator') {
					$fun='body_shape';
				}elseif ($url=='distance-formula-calculator') {
					$fun='dis_formula';
				}elseif ($url=='average-velocity-calculator') {
					$fun='ave_vel';
				}elseif ($url=='fraction-simplifier-calculator') {
					$fun='simplify';
				}elseif ($url=='fraction-to-decimal-calculator' || $url=='fraction-to-percent-calculator') {
					$fun='frac_to_dec';
				}elseif($url=='percent-to-fraction-calculator'){
					$fun='per_to_frac';
				}elseif($url=='age-difference-calculator'){
					$fun='age_diff';
				}elseif($url=='slope-intercept-form-calculator'){
					$fun='slope_intercept';
				}elseif ($url=='standard-error-calculator') {
					$fun='standerror';
				}elseif($url=='linear-interpolation-calculator'){
					$fun='linear_interpolation';
				}elseif($url=='5-five-number-summary-calculator'){
					$fun='_5';
				}elseif($url=='instantaneous-rate-of-change-calculator'){
					$fun='i_r_o_c';
				}elseif($url=='law-of-sines-calculator'){
					$fun='law_of_sines';
				}elseif($url=='law-of-cosines-calculator'){
					$fun='law_of_cosines';
				}elseif($url=='tangent-line-calculator'){
					$fun='tangent_line';
				}elseif($url=='average-rate-of-change-calculator'){
					$fun='arocc';
				}elseif($url=='unit-tangent-vector-calculator'){
					$fun='utvc';
				}elseif($url=='remainder-theorem-calculator'){
					$fun='r_t';
				}elseif($url=='midpoint-rule-calculator'){
			        $fun='mid_rule';
		        }elseif($url=='inverse-laplace-transform-calculator'){
		        	$fun='inverse_lap';
		        }elseif($url=='coefficient-of-determination-calculator'){
		        	$fun='codc';
		        }elseif($url=='area-under-the-curve-calculator'){
		        	$fun='area_under';
		        }elseif($url=='double-integral-calculator'){
		        	$fun='double_int';
		        }elseif($url=='tangent-plane-calculator'){
		        	$fun='tpc';
		        }elseif($url=='mole-fraction-calculator'){
		        	$fun='mole_frac';
		        }elseif($url=='linear-independence-calculator'){
		        	$fun='independence';
		        }elseif($url=='unit-vector-calculator'){
		        	$fun='unit_vector';
		        }elseif($url=='power-series-calculator'){
					$fun='power_ser';
			    }elseif($url=='angle-of-elevation-calculator'){
					$fun='angle_of';
			    }elseif($url=='area-of-a-sector-calculator'){
		        	$fun='sector';
		        }elseif($url=='percentage-increase-calculator'){
		            $fun='per_inc';
		        }elseif($url=='percentage-decrease-calculator'){
		        	$fun='per_dec';
		        }elseif($url=='percentage-difference-calculator'){
		            $fun='per_dif';
		        }elseif($url=='standard-form-to-slope-intercept-form'){
		            $fun='stand_slope';
		        }elseif($url=='square-footage-calculator'){
					$fun='square_footage';
				}elseif($url=='improper-fractions-to-mixed-numbers'){
		        	$fun='improper_frac';
		        }elseif ($url=='mixed-numbers-to-improper-fractions') {
		        	$fun='mixed_frac';
		        }elseif ($url=='time-card-calculator') {
		        	$fun='time_card';
		        }elseif($url=='rational-or-irrational-calculator'){
		            $fun='irrational';
		        }elseif($url=='simplify-radicals-calculator'){
		            $fun='simplify_radicals';
		        }elseif($url=='unit-rate-calculator'){
		            $fun='rate';
		        }elseif($url=='equation-of-a-line-calculator'){
		            $fun='line';
		        }elseif($url=='final-grade-calculator'){
		            $fun='final_grade';
		        }elseif($url=='vector-projection-calculator'){
					$fun='vector_projection';
				}elseif($url=='fraction-exponent-calculator'){
		            $fun='frac_exp';
		        }elseif($url=='cubic-yard-calculator'){
		            $fun='yard';
		        }elseif ($url=='time-to-decimal-calculator') {
		        	$fun='time_decimal';
		        }elseif ($url=='percent-to-decimal-calculator') {
		        	$fun='per_deci';
		        }elseif ($url=='decimal-to-percent-calculator') {
		        	$fun='deci_per';
		        }elseif($url=='inverse-modulo-calculator'){
		        	$fun='inv_mod';
		        }elseif ($url=='probability-density-function-calculator') {
		        	$fun='pro_den';
		        }elseif ($url=='power-reducing-formula-calculator') {
		        	$fun='pow_red';
		        }elseif($url=='area-of-a-semicircle'){
		        	$fun='semicircle';
		        }elseif ($url=='equivalent-expressions-calculator') {
		        	$fun='equ_exp';
		        }elseif ($url=='ratio-to-fraction-calculator') {
		        	$fun='ratio_fraction';
		        }elseif($url=='inverse-matrix-calculator'){
		          	$fun='inv_mat';
		        }elseif($url=='matrix-transpose-calculator'){
		          	$fun='transpose';
		        }elseif($url=='grams-to-atoms-calculator'){
		          	$fun='gram_atm';
		        }elseif($url=='vector-addition-calculator'){
					$fun='vector_addition';
				}elseif($url=='mole-ratio-calculator'){
					$fun='molar_ratio';
				}elseif($url=='dog-pregnancy-calculator'){
		          	$fun='dog_pre';
		        }elseif($url=='volume-of-triangular-pyramid'){
					$fun='triangular_pyramid';
				}elseif($url=='area-calculator'){
		            $fun='areaa';
				}elseif ($url=='binomial-coefficient-calculator') {
		        	$fun='bin_cof';
		        }elseif($url=='angular-acceleration-calculator'){
				    $fun='angular_acceleration';
				}elseif ($url=='long-multiplication-calculator'){
		          	$fun='l_multiplication';
		        }elseif ($url=='average-value-of-function') {
		        	$fun='avg_fun';
		        }elseif ($url=='product-sum-calculator'){
					$fun='pro_sum';
				}elseif ($url=='percentile-rank-calculator') {
		        	$fun='per_rank';
		        }elseif ($url=='weight-percentile-calculator'){
					$fun='weight_per';
				}else if($url=='weight-watchers-points-calculator'){
					$fun='weight_watchers';
				}else if($url=='30-60-90-triangle-calculator'){
					$fun='thirty';
				}elseif($url=='calorie-deficit-calculator'){
					$fun='cal_deficit';
				}elseif($url=='height-calculator'){
					$fun='height_cal';
				}elseif ($url=='decimal-calculator') {
		        	$fun='decimalCal';
		        }elseif($url=='surface-area-calculator'){
					$fun='surface_area';
				}elseif($url=='grams-to-calories-calculator'){
					$fun='grams_to_calories';
				}elseif($url=='calories-burned-biking-calculator'){
					$fun='cal_bike';
				}elseif($url=='comparing-decimals-calculator'){
					$fun='compare_decimal';
				}elseif($url=='distance-between-two-points-calculator'){
					$fun='distance_point';
				}elseif($url=='pregnancy-weight-gain-calculator'){
					$fun='pre_weight';
				}elseif($url=='steps-to-miles-calculator'){
					$fun='steps_mi';
				}elseif($url=='log-base-2-calculator'){
				    $fun='log_two';
				}elseif($url=='radius-of-a-circle-calculator'){
					$fun='rad_cir';
				}elseif($url=='time-span-calculator'){
					$fun='timespan';
				}elseif($url=='rational-zeros-calculator'){
					$fun='rational_zero';
				}elseif($url=='weight-gain-calculator'){
					$fun='weightgain';
				}elseif($url=='point-of-intersection'){
					$fun='point_of_intersection';
				}elseif($url=='time-and-a-half'){
					$fun='time_and_half';
				}elseif($url=='time-duration-calculator'){
					$fun='time_duration';
				}elseif($url=='z-score-to-percentile'){
					$fun='z_score';
				}elseif($url=='exponential-function-calculator'){
					$fun='exponet_function';
				}elseif($url=='elementary-matrix-calculator'){
					$fun='elementary_matrix_function';
				}elseif($url=='square-meter-calculator'){
					$fun='square_meter';
				}elseif($url=='empirical-probability-calculator'){
					$fun='empirical_pro';
				}elseif($url=='dog-crate-size-calculator'){
					$fun='dog_crate_size';
				}elseif($url=='car-depreciation-calculator'){
					$fun='car_dep';
				}elseif($url=='roof-replacement-cost-calculator'){
					$fun='roof_replacement';
				}elseif($url=='45-45-90-triangle-calculator'){
					$fun='forty_five';
				}elseif($url=='date-duration-calculator'){
					$fun='date_duration';
				}elseif($url=='square-inches-calculator'){
					$fun='square_inches';
				}elseif($url=='yards-to-tons-calculator'){
					$fun='yards_to_tons';
				}elseif($url=='military-time-converter'){
					$fun='military_time';
				}elseif($url=='electric-flux-calculator'){
					$fun='electric_flux';
				}elseif($url=='angle-of-deviation-calculator'){
					$fun='angle_deviation';
				}elseif($url=='electric-potential-calculator'){
					$fun='electricPotential';
				}elseif($url=='cost-per-mile-driving-calculator'){
					$fun='driving_cost';
				}elseif($url=='wave-period-calculator'){
					$fun='wave_period';
				}elseif($url=='water-bill-calculator'){
					$fun='water_bill'; 
				}elseif($url=='angle-of-refraction-calculator'){
					$fun='angle_refraction'; 
				}elseif($url=='absolute-change-calculator'){
					$fun='absolute_change';
				}elseif($url=='power-of-10-calculator'){
					$fun='power_ten';
				}elseif($url=='marginal-revenue-calculator'){
					$fun='marginal_revenue';
				}elseif($url=='square-root-curve-calculator'){
					$fun='square_curve';
				}elseif($url=='sample-size-calculator'){
					$fun='sample_size';
				}elseif($url=='circumference-to-diameter-calculator'){
					$fun='circumference_diamter';
				}elseif($url=='relative-risk-calculator'){
					$fun='relative_risk';
				}elseif($url=='price-calculator'){
					$fun='price_cal';
				}elseif($url=='round-to-the-nearest-cent'){
					$fun='round_near';
				}elseif($url=='average-percentage-calculator'){
					$fun='avg_percentage';
				}elseif($url=='slope-percentage-calculator'){
					$fun='slope_percentage';
				}elseif($url=='error-propagation-calculator'){
					$fun='error_propagation';
				}elseif($url=='circle-diameter-to-circumference-calculator'){
					$fun='circle_diameter_to_circumference';
				}elseif($url=='percentage-change-calculator'){
					$fun='percentage_change';
				}elseif($url=='gdp-calculator'){
					$fun='gdp_cal';
				}elseif($url=='real-estate-commission-calculator'){
					$fun='real_estate';
				}elseif($url=='hourly-pay-calculator'){
					$fun='hourly_pay';
				}elseif($url=='concrete-block-calculator'){
					$fun='concrete_block';
				}elseif($url=='p-hat-calculator'){
					$fun='p_hat';
				}elseif($url=='cost-of-goods-sold-calculator'){
					$fun='cost_goods';
				}elseif($url=='friction-loss-calculator'){
					$fun='friction_loss';
				}elseif($url=='volume-calculator'){
					$fun='volume_cal';
				}elseif($url=='time-dilation-calculator'){
					$fun='time_dilation';
				}elseif($url=='cost-basis-calculator'){
					$fun='cost_basis';
				}elseif($url=='volume-of-a-rectangle'){
					$fun='rectangle_volume';
				}elseif($url=='volume-of-column'){
					$fun='column_volume';
				}elseif($url=='volume-of-square'){
					$fun='square_volume';
				}elseif($url=='volume-of-capsule'){
					$fun='capsule_volume';
				}elseif($url=='dc-wire-size-calculator'){
					$fun='dc_wire';
				}elseif($url=='t-statistic-calculator'){
					$fun='t_statistic';
				}elseif($url=='watt-hour-calculator'){
					$fun='watt_hour';
				}elseif($url=='dilution-factor-calculator'){
					$fun='dilution_factor';
				}elseif($url=='density-altitude-calculator'){
					$fun='density_altitude';
				}elseif($url=='speed-of-sound-calculator'){
					$fun='speed_of';
				}elseif($url=='pipe-weight-calculator'){
					$fun='pipe_weight';
				}elseif($url=='dog-food-calculator'){
					$fun='dog_food';
				}elseif($url=='specific-gravity-calculator'){
					$fun='specific_of';
				}elseif($url=='dog-heat-cycle-calculator'){
					$fun='dog_heat';
				}elseif($url=='real-gdp-calculator'){
					$fun='real_gdp';
				}elseif($url=='scrap-gold-calculator'){
					$fun='scrap_gold';
				}elseif($url=='adjusted-age-calculator'){
					$fun='adjusted_age';
				}
                $model = $cal_data->cal_cat;
                $model = "App\Models\\$model";
                $model = new $model();
                $detail = $model->$fun($request);
                if (isset($detail['error'])) {
                    $data['error'] = $detail['error'];
                }else{
                    $data['detail'] = $detail;
                }
            }
            if (in_array($url,$this->forCurrency)) {
	      	    $ip = '';
                if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                    $ip=$_SERVER['HTTP_CF_CONNECTING_IP'];
				}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			        $ip = $_SERVER['HTTP_CLIENT_IP'];
			    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
			        $ip = $_SERVER['HTTP_X_FORWARDED'];
			    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
			    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
			        $ip = $_SERVER['HTTP_FORWARDED'];
			    } else if (isset($_SERVER['REMOTE_ADDR'])) {
			        $ip = $_SERVER['REMOTE_ADDR'];
			    } else {
			        $ip = 'UNKNOWN';
			    }
				$dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip),true);
				$data['currancy']=$dataArray["geoplugin_currencySymbol_UTF8"];
			}
            if ($cal_data->no_index=="1") {
                $data['noindex']='<meta name="robots" content="noindex">';
            }
            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone"); $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad"); $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
            $img_form='webp';
            if ($iphone || $ipad || $ipod  == true)  {
                $img_form='png';
            }
            $keys=json_decode($cal_data->lang_keys,true);
            if (isset($cal_data->TOC) && !empty($cal_data->TOC)) {
                $data['TOC']=json_decode($cal_data->TOC,true);
            }
            $data['mathjax']=0;
            if (isset($cal_data->mathjax)) {
                $data['mathjax']=$cal_data->mathjax;
            }
            $parent=$cal_data->parent;
            $data['cal_cat']=$cal_data->cal_cat;
            $data['meta_title']=$cal_data->meta_title;
            $data['cal_name']=$cal_data->cal_title;
            $data['meta_des']=$cal_data->meta_des;
            $data['cal_img']=$cal_data->cal_img;
            $data['cal_data']=$cal_data;
            $data['lang']=$keys;
            $data['device']=$this->device;
            $data['parent']=$parent;
            $data['type']='widget';
            $data['page']=$url;
            if (isset($cal_data->is_calculator)) {
                $data['is_calculator']=$cal_data->is_calculator;
                if ($cal_data->is_calculator=='Calculator') {
                    return view('widget-preview',$data);
                }elseif ($cal_data->is_calculator=='Converter') {
                    return redirect(url('/'));
                }else{
                    return redirect(url('/'));
                }
            }
        }else{
            return redirect(url('/'));
        }
    }

	public function subConverter($category,$url){
		$file=$category.'-'.$url;
		if (file_exists("keys/".$file.".txt")) {
			$cal_data=file_get_contents("keys/".$file.".txt");
			$cal_data=json_decode($cal_data);
		}
		if (isset($cal_data)) {
			if (isset($lang)) {
				$parent=$cal_data->parent;
			}else{
				$parent=$cal_data->cal_title;
			}
			if ($cal_data->no_index=="1") {
				$data['noindex']='<meta name="robots" content="noindex">';
			}
			
			$papa=$cal_data->cal_cat;
			$papa=explode(' ', $papa);
		    $papa=strtolower($papa[0]);
			if ($papa!=$category) {
	        	abort(404);
	        }
			$keys=json_decode($cal_data->lang_keys,true);
			$related=json_decode($cal_data->related_cal,true);
			$data['related']=$related;
			$data['cal_cat']=$cal_data->cal_cat;
			$data['meta_title']=$cal_data->meta_title;
			$data['cal_name']=$cal_data->cal_title;
			$data['meta_des']=$cal_data->meta_des;
			$data['lang']=$keys;
			$data['device']=$this->device;
			$data['page']="$category/$url";
			$data['parent']=$parent;
			$data['file']=$file;
			$data['is_calculator']=$cal_data->is_calculator;
			return view('widget-sub-converter',$data);
		}else{
			abort(404);
		}
	}
}
