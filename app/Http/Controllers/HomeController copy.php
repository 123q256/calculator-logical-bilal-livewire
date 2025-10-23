<?php

namespace App\Http\Controllers;

use App\Models\Math;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
use Illuminate\Support\Str;

class HomeController extends Controller
{
	public $device;
    public $forCurrency;
    public $ad_text;
    public $allcategories;

	function __construct() {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){ 
            $this->device="mobile";
        }else{
            $this->device="desktop";
        }
        $this->forCurrency = [
			'material-calculator',
			'rebar-calculator',
			'square-yards-calculator',
			'brick-calculator',
			'cubic-yard-calculator',
			'salary-to-hourly-calculator',
			'hourly-to-salary-calculator',
			'plant-spacing-calculator',
			'stud-calculator',
			'price-per-square-foot-calculator',
			'wallpaper-calculator',
			'square-footage-calculator',
			'retaining-wall-calculator',
			'sonotube-calculator',
			'retaining-wall-calculator',
			'sonotube-calculator',
			'metal-roof-cost-calculator',
			'travel-time-calculator',
			'gas-calculator',
			'rent-split-calculator',
			'flooring-calculator',
			'mpg-calculator',
			'tile-calculator',
			'fence-calculator',
			'topsoil-calculator',
			'paver-calculator',
			'cubic-feet-calculator', 	
			'prorated-rent-calculator',
			'concrete-calculator',
			'sand-calculator',
			'mulch-calculator',
			'gravel-calculator',
			'tonnage-calculator',
			'drive-time-calculator',
			'botox-cost-calculator',
			'square-inches-calculator',
			'square-meter-calculator',
			'acreage-calculator',
			'tip-calculator',
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
			'commission-calculator',
			'money-counter-calculator',
			'ebitda-calculator',
			'ctr-calculator',
			'ebit-calculator',
			'vat-calculator',
			'tax-calculator',
			'comparative-advantage-calculator',
			'cpm-calculator',
			'cagr-calculator',
			'current-ratio-calculator',
			'roi-calculator',
			'price-elasticity-demand-calculator',
			'profit-margin-calculator',
			'employee-cost-calculator',
			'payback-period-calculator',
			'wacc-calculator',
			'basis-point-calculator',
			'car-depreciation-calculator',
			'property-depreciation-calculator',
			'depreciation-calculator',
            "food-cost-calculator",
			"dc-wire-size-calculator",
			'electricity-cost-calculator'
        ];
    }

    public function index($lang='en'){

		if (! in_array($lang, ['en', 'cs', 'ar', 'de', 'es', 'fi', 'fr', 'id', 'it', 'ja', 'ko', 'pl', 'pt', 'ru', 'tr', 'da', 'no'])) {
			return redirect(url('/'));
		}

		App::setLocale($lang);
		if ($lang!='en') {
			$data['lang_key']=$lang;
		}
	
		if (file_exists("lang/index.txt")) {
			$alter = file_get_contents("lang/index.txt");
			if ($alter) {
				$alter = explode('<United-Kingdom>', $alter);
				$hreflang = $alter[0];
				$local_lang = $alter[1];
				$data['hreflang'] = $hreflang;
				$data['local_lang'] = $local_lang;
			}
		}
		
		$data['calculators']=json_decode(file_get_contents('technical-online-calculators.txt'));
		$data['device']=$this->device;
        $data['meta_title'] = __('menu_lang.title');
        $data['meta_des'] = __('menu_lang.des');

		$allcategories = DB::table('categories')->select('cat_name','is_del', 'img', 'cat_time','cat_id')->where('is_del', 0)->get();
		$this->allcategories = $allcategories;

		$posts = DB::table('posts')->where('is_del' , 0)->where('show_hide' , 1)->where('knowledge' , 0)->where('is_aprove' , 1)->orderBy('post_id' , 'DESC')->limit(3)->get();
      
        $data['posts']=$posts;
		$data['device']=$this->device;
		$data['allcategories'] = $this->allcategories;
        return view('pages/index',$data);
    }

	public function category($category){
			// dd($category);
		if ($category=='health') {
			$meta_title = 'Fitness and Health Calculators';
			$meta_des = 'We are providing a simple and efficient range of fitness and health calculators. Determine your health status regularly using these calculators.';
			$des = " Health Is Wealth! Many people struggle with health issues such as heart disease, obesity, diabetes, mental health, etc. Our simple health calculators can help you monitor your health, track your progress, and make informed decisions about your healthcare. By using scientifically validated formulas and algorithms, these tools provide accurate insights into your health metrics. However, it's important to consult with a medical expert before relying solely on the results. Try our calculators today and take the first step towards improving your health.";
		}elseif($category=='math'){
			$meta_title = 'Math Calculators - Free Basics Educational Calculators';
			$meta_des = 'The calculator-online provides you free maths calculator for students and professionals to solve basic to advanced maths-related problems accurately.';
			$des = 'Not everyone is good at mathematics. But our collection of advanced math calculators makes math a fun activity for everyone. The collection covers various domains, including Geometry, Calculus, Algebra, Trigonometry, Arithmetic, etc. These tools are perfect for students and professionals alike, making math more approachable and easier to solve for them.';
		}elseif($category=='physics'){
			$meta_title = 'Physics Calculator To Solve Any Physics Equation';
			$meta_des = 'Try the free online Physics calculators that help students and professionals to solve from complicated to simplest physics-related equations accurately.';
			$des = 'Our physics calculators simplify complex equations and formulas, which help you solve problems related to various physical phenomena like mechanics, thermodynamics, electromagnetism, optics, etc. Use these tools to support your physical analysis with accurate calculations, both in academic and practical settings. Start exploring our physics calculators today.';
		}elseif($category=='chemistry'){
			$meta_title = 'Chemistry Calculator For Chemistry Chemical Formulas';
			$meta_des = 'The free online Chemistry calculators that programmed for students and professionals to solve the chemical equations and problems that are related to chemistry.';
			$des = 'As chemistry seems very frightening & illogical, it is a very interesting subject. And to make it even more engaging for you, we have developed different tools, which provide help in resolving chemistry problems instantly. By providing accurate calculations and visualizations, these calculators can help you understand extensive chemical reactions and properties. Master your chemical concepts with the calculators below and make your complex chemistry more comprehensible.';
		}elseif($category=='statistics'){
			$meta_title = 'Statistics Calculator For Stat Problems: (100% Free)';
			$meta_des = 'Get free online statistics calculator that helps you to solve your basics to advanced statistical data problems within a fraction of seconds. ';
			$des = "Our statistics calculators offer a user-friendly solution for anyone struggling with complex statistical calculations. These tools offer a wide range of statistical solutions, which helps you solve problems quickly and accurately. Not only will you find practical solutions, but you'll also gain valuable insights into the world of statistics. Start using the advanced statistical calculators below and make your data interpretation more authentic.";
		}elseif($category=='finance'){
			$meta_title = 'Financial Calculators - Free Online Home Finance Calculators';
			$meta_des = 'Explore the wide range of financial calculators from this platform; you can manage your savings, loans, and investments with the ease of these calculators.';
			$des = 'Whether you are a seasoned entrepreneur or a student just starting out, financial planning is essential. Our collection of calculators offers a comprehensive suite of tools to help you manage your finances effectively. From business planning and investments to tax calculations and debt management, we have got you covered. Our calculators simplify complex financial concepts making it easy to set and achieve your financial goals.';
		}elseif($category=='everyday-life'){
			$meta_title = 'Everyday Life Calculators - Free Informational Tools and Calculators';
			$meta_des = 'The accomplished team of calculator-online.net provided a wide range of interesting and Everyday Life calculators that you can utilize on a daily basis.';
			$des = 'Enhance your everyday life convenience with the collection of our everyday life calculators that offer assistance with various tasks, making daily life more convenient and efficient. From unit conversions to cooking time calculations, fuel efficiency, tip calculation, and distance calculation, these calculators can help you solve everyday problems. By saving time, improving accuracy, planning effectively, and simplifying tasks, everyday life calculators can help update your daily routines.';
		}elseif ($category == 'construction') {
			$meta_title = 'Construction Calculators';
			$meta_des = '';
			$des = 'Construction calculators are essential tools for professionals and DIY enthusiasts involved in various construction projects. Our variety of tools provide accurate calculations for different measurements, materials, and costs, streamlining the planning and execution of tasks. This page contains a wide range of calculators, including those for dimension and area, volume, material quantity, and construction projects.';
		} elseif ($category == 'pets') {
			$meta_title = 'Pets Calculators';
			$meta_des = '';
			$des = 'The following calculators are specialized tools designed to assist pet owners in various aspects of pet care. They offer calculations and estimates related to pet health, feeding, and other relevant factors. It is time to make informed decisions about your furry friends by using the tools below.';
		}elseif ($category == 'timedate') {
			$meta_title = 'Time & Date Calculators';
			$meta_des = '';
			$des = 'Plan your trips, schedule events, and understand different time zones with our optimized collection of time and date calculators. By providing accurate time and date information, these calculators can help you stay organized and informed. Simplify time-related tasks with calculators that compute date differences, world time conversions, and countdowns, perfect for planning events and managing schedules effectively.';
		}
		// dd($category);
		$categoryID = DB::table('categories')
		->where('cat_name', $category)
		->pluck('cat_id')
		->first();

	$subCategoriesName = DB::table('sub_categories')
		->select('cat_id', 'cat_name', 'cat_parent')
		->where('cat_parent', $categoryID)
		->get();

	$all_calc = DB::table('calculators')
		->select('cal_cat', 'cal_sub_cat', 'cal_title', 'cal_link', 'parent')
		->where('is_show', 0)
		->where('no_index', 0)
		->where('cal_cat', $category)
		->get();


		$allcalculator = DB::table('calculators')
		->where('is_show', 0)
		->where('no_index', 0)
		->where('show_hide',1)
		->get();



	$calculatorsWithoutSubCat = $all_calc->filter(function ($cal) {
		return empty($cal->cal_sub_cat);
	});

	$calculatorsGroupedBySubCat = $all_calc->groupBy('cal_sub_cat');

	$data['device'] = $this->device;
	$data['meta_title'] = $meta_title;
	$data['calculators'] = $allcalculator;
	$data['subCategoriesName'] = $subCategoriesName;
	$data['all_calc'] = $all_calc;
	$data['calculatorsWithoutSubCat'] = $calculatorsWithoutSubCat;
	$data['calculatorsGroupedBySubCat'] = $calculatorsGroupedBySubCat;
	$data['meta_des'] = $meta_des;
	$data['categoryID'] = $categoryID;
	$data['category'] = $category;
	$data['allcategories'] = $this->allcategories;
	$data['category_active'] = 1;
	$data['des'] = $des;
	// $data['calculators']=json_decode(file_get_contents('technical-online-calculators.txt'));
	// dd($data['all_calc']);
	

	// dd($data);
	if ($category=='health') {
	return view('pages/category/health', $data);
	}elseif($category=='math'){
		return view('pages/category/math', $data);
	}elseif($category=='physics'){
		return view('pages/category/physics', $data);
	}elseif($category=='chemistry'){
		return view('pages/category/chemistry', $data);
	}elseif($category=='statistics'){
		return view('pages/category/statistics', $data);
	}elseif($category=='finance'){
		return view('pages/category/finance', $data);
	}elseif($category=='everyday-life'){
		return view('pages/category/everyday-life', $data);
	}elseif($category=='construction'){
		return view('pages/category/construction', $data);
	}elseif($category=='pets'){
		return view('pages/category/pets', $data);
	}elseif($category=='timedate'){
		return view('pages/category/timedate', $data);
	}
}
	
	public function converter(){
		$converters = DB::table('calculators')->select('cal_link','cal_title','cal_cat','no_index')->where('is_calculator','Converter')->get();
		$data['converters']=$converters;
		$data['page']='unit-converter';
		$data['device']=$this->device;
		$data['category_active'] = 1;
		$data['meta_title']='Conversion Calculator - Metric Units Measurement Converter';
		$data['meta_des']="The unit conversion calculator for metric/imperial units converts between several units of measurement like length, weight, area, volume, and more.";
		return view('unit-converter',$data);
	}

	public function showPageEN($url){
		
		return $this->showPage(null,$url);
	}

    public function showPage($lang=null,$url){
		error_reporting(0);
		$request = request();
        $check=$_SERVER['REQUEST_URI'];
		// if (preg_match("/\/\//i", $check)) {
        //     return redirect(url()->current().'/',301);
		// }
		// if ($lang==null && $url=='age-calculator') {
		// 	abort(404);
		// }
        // if ($url=='cgpa-calculator') {
        //     return redirect(url('gpa-calculator').'/',301);
		// }elseif ($url=='factor-calculator') {
        //     return redirect(url('factoring-calculator').'/',301);
		// }elseif ($url=='calorie-calculator') {
        //     return redirect(url('weightloss-calculator').'/',301);
		// }elseif ($url=='it-ratio-calculator') {
        //     return redirect(url('it-ratio').'/',301);
		// }elseif ($url=='round-to-nearest-multiple-calculator' || $url==='car-loan-calculator' || $url==='emi-calculator' || $url==='loan-calculator' || $url==='mortgage-calculator' || $url==='personal-loan-calculator' || $url==='ltv-calculator' || $url==='angel-number-calculator' || $url==='name-numerology-calculator' || $url==='sample-calculator' || $url==='sgpa-to-cgpa-calculator') {
		// 	return redirect(url('/'),301);
		// }
        $file = $url;

		if ($lang!=null) {
			App::setLocale($lang);
			$file = $lang.'-'.$url;
		}
		// dd($file);
        if (file_exists("keys/".$file.".txt")) {
			$cal_data=file_get_contents("keys/".$file.".txt");
			$cal_data=json_decode($cal_data);
		}
		// dd($cal_data);
        if (isset($cal_data)) {
			if (isset($request->submit)) {
                $fun_name=explode('-', $url);
			    $fun=$fun_name[0];
                if($url=='ideal-gas-law-calculator'){
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
				}elseif($url=='on-base-percentage-calculator'){
					$fun='on_base';
				}elseif($url=='calculate-age'){
					$fun='age';
				}elseif($url=='weight-loss-calculator'){
					$fun='weightloss';
				}elseif($url=='wave-period-calculator'){
					$fun='wave_period';
				}elseif($url=='opportunity-cost-calculator'){
					$fun='opportunity';
				}elseif($url=='birth-year-calculator'){
					$fun='birthyear';
				}elseif($url=='partial-fraction-decomposition-calculator'){
					$fun='partial_fraction';
				}elseif($url=='critical-points-calculator'){
					$fun='stat_critical';
				}elseif($url=='days-until-calculator'){
					$fun='days_until';
				}elseif($url=='time-until-calculator'){
					$fun='time_until';
				}elseif($url=='week-calculator'){
					$fun='week_calc';
				}elseif($url=='days-from-today'){
					$fun='days_from';
				}elseif($url=='cat-age-calculator'){
					$fun='cat_age';
				}elseif($url=='salary-to-hourly-calculator'){
					$fun='salarytohur';
				}elseif($url=='weeks-from-today'){
				$fun='weeks_from';
				}elseif($url=='years-from-today'){
					$fun='years_from';
				}elseif($url=='rent-split-calculator'){
					$fun='rent_split';
				}elseif($url=='hours-from-now'){
					$fun='hours_from';
				}elseif($url=='weeks-ago-calculator'){
					$fun='weeks_ago';
				}elseif($url=='time-ago-calculator'){
					$fun='time_ago';
				}elseif($url=='years-ago-calculator'){
					$fun='year_ago';
				}



                $model = $cal_data->cal_cat;
				if($model == 'Everyday-Life'){
					$model = 'EverydayLife';
				}
                $model = "App\Models\\$model";
                $model = new $model();
				//dd($request);
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
				try {
					$response = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
				
					if ($response === false) {
						$data['currancy']='$';
					}
				
					$dataArray = json_decode($response, true);
					$data['currancy']=$dataArray["geoplugin_currencySymbol_UTF8"];
				
				} catch (\Exception $e) {
					$data['currancy']='$';
				}
				// $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip),true);
				// $data['currancy']=$dataArray["geoplugin_currencySymbol_UTF8"];
			}
            if ($cal_data->no_index=="1") {
                $data['noindex']='<meta name="robots" content="noindex">';
            }
            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone"); $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad"); $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
            $img_form='webp';
            if ($iphone || $ipad || $ipod  == true)  {
                $img_form='png';
            }
            $related=json_decode($cal_data->related_cal,true);
            if (isset($related['more'])) {
                $data['more_cal']=$related['more'];
            }
            $data['related']=$related;
            $keys=json_decode($cal_data->lang_keys,true);
            if (isset($cal_data->TOC) && !empty($cal_data->TOC)) {
                $data['TOC']=json_decode($cal_data->TOC,true);
            }
            $data['mathjax']=0;
            if (isset($cal_data->mathjax)) {
                $data['mathjax']=$cal_data->mathjax;
            }
			// dd($cal_data->parent);
            $parent=$cal_data->parent;
            $short_parent = [
                // Health URLS
                "tdee-calculator",	
                "bmi-calculator",	
                "bmr-calculator",	
                "rmr-calculator",	
                "bsa-calculator",	
                "alc-calculator",	
                "anc-calculator",	
                "apft-calculator",	
                "ffmi-calculator",	
                "ippt-calculator",	
                "acft-calculator",	
                "svr-calculator",	
                "vo2-max-calculator",	
                "ldl-calculator",	
                "nnt-calculator",	
                "it-ratio",	
                // Finance URLS
                "vat-calculator",	
                "ebit-calculator",	
                "ebitda-calculator",	
                "wacc-calculator",	
                "cpc-calculator",	
                "capm-calculator",	
                "roi-calculator",	
                "cpm-calculator",	
                "mpc-calculator",	
                "roas-calculator",	
                "agi-calculator",	
                "gdp-calculator",	
                "nps-calculator",	
                "gdp-per-capita-calculator",	
                "npv-calculator",	
                "arv-calculator",
                // Math URLS	
                "gpa-calculator",	
                "uc-gpa-calculator",	
                "csc-calculator",	
                "e-calculator",	
                "foil-calculator",	
                "lcd-calculator",	
                "rref-calculator",
                // Physics URLs	
                "dbm-to-watts",	
                "fpe-calculator",	
                "dc-wire-size-calculator",
                // Chemistry URLs	
                "ph-calculator",	
                "ppm-calculator",	
                "cfu-calculator",	
                "pka-to-ph-calculator",	
                "ml-to-moles-calculator",	
                "stp-calculator",
                // Statistics URLs		
                "rsd-calculator",	
                "sse-calculator",	
                "pert-calculator",	
                // Informative URLs
                "ppi-calculator",	
                "era-calculator",	
                "edpi-calculator",	
                "kd-calculator",	
                "ac-btu-calculator",	
                "gpm-calculator",	
            ];
            $brudcum_parent = "";
            if (in_array($url, $short_parent)) {
                $url_parts = explode("-",$url);
                for ($i=0; $i < count($url_parts); $i++) { 
                    if ($i === 0) {
                        $brudcum_parent .= strtoupper($url_parts[$i]);
                    } else {
                        $brudcum_parent .= " ".ucwords($url_parts[$i]);
                    }
                }
            } else {
                $url_convert = str_replace('-', ' ', $url);
                $brudcum_parent = ucwords($url_convert);
                if ($url === "weightloss-calculator") {
                    $brudcum_parent = "Weight Loss Calculator";
                }
            }
			if (file_exists("lang/" . $parent . ".txt")) {
				$alter = file_get_contents("lang/" . $parent . ".txt");
				if ($alter) {
					// $alter = str_replace('https://phpstack-210195-4448516.cloudwaysapps.com/','https://Logical-calculator.com/',$alter);
					// $alter = str_replace('http://phpstack-210195-4448516.cloudwaysapps.com/','https://Logical-calculator.com/',$alter);
					// $alter = str_replace('https://phpstack-210195-641321.cloudwaysapps.com/','https://Logical-calculator.com/',$alter);
					// $alter = str_replace('http://phpstack-210195-641321.cloudwaysapps.com/','https://Logical-calculator.com/',$alter);
					$alter = explode('<United-Kingdom>', $alter);
					$hreflang = $alter[0];
					$local_lang = $alter[1];
					$data['hreflang'] = $hreflang;
					$data['local_lang'] = $local_lang;
				}
			}
			$data['brudcum_parent'] = $brudcum_parent;
            $data['cal_cat']=$cal_data->cal_cat;
            $data['meta_title']=$cal_data->meta_title;
			if ($lang==null && $url=='tdee-calculator') {
				$data['meta_title']=$cal_data->meta_title.' 🔥';
			}elseif ($lang==null && $url=='age-calculator') {
				$data['meta_title']=$cal_data->meta_title.' 📆';
			}elseif ($lang==null && $url=='weightloss-calculator') {
				$data['meta_title']=$cal_data->meta_title.' 🏃';
			}

			$queryParams = $request->all();
			$baseUrl = url()->current();
			$queryString = http_build_query($queryParams);
			$shareURL = $baseUrl . '/?' . $queryString;
            $data['shareURL']=$shareURL;
		
            $data['brudcum_parent'] = $brudcum_parent;
            $data['cal_cat']=$cal_data->cal_cat;
            $data['meta_title']=$cal_data->meta_title;
            $data['cal_name']=$cal_data->cal_title;
            $data['cal_detail']=$cal_data->cal_detail;
            $data['content']=$cal_data->content;
            $data['meta_des']=$cal_data->meta_des;
            $data['cal_img']=$cal_data->cal_img;
            $data['cal_data']=$cal_data;
            $data['file']=$file;
            $data['lang']=$keys;
            $data['device']=$this->device;
            $data['parent']=$parent;
            $data['type']='calculator';

			
			// if ($url=='calculate-age') {
			// 	$data['page']='age-calculator';
			// }else{
				$data['page']=$url;
			// }
			$data['is_calculator']=$cal_data->is_calculator;
            if (isset($cal_data->is_calculator)) {
                if ($cal_data->is_calculator=='Calculator') {
                    return view('calculator',$data);
                }elseif ($cal_data->is_calculator=='Converter') {
					$url=explode('/', $url);
					if (count($url)>1) {
						$sub_con = $url[1];
					}else{
						$sub_con = $data['page'];
					}
					$sub_con=explode('-',$sub_con);
					$sub_cn='';
					foreach ($sub_con as $key => $value1) {
						$sub_cn.=ucfirst($value1).' ';
					}
					$where_con = array('cal_cat' => $sub_cn , 'is_show'=>'1');
					$all_sub = DB::table('calculators')->where($where_con)->select('cal_link')->get();
					$data['all_sub'] = $all_sub;

				
					
                    return view('converter',$data);
                }else{
                    return redirect(url('/'));
                }
            }
        }else{
            return redirect(url('/'));
        }
    }

	public function subConverterEN($category,$url){
		return $this->subConverter(null,$category,$url);
	}

	public function subConverter($lang,$category,$url){
		$file=$category.'-'.$url;
		if ($lang!=null) {
			App::setLocale($lang);
			$file=$lang.'-'.$category.'-'.$url;
		}
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
			// if ($url!='liter-to-kg') {
			// 	if ($papa!=$category) {
			// 		return redirect(url('/'));
			// 	}
			// }

			$keys=json_decode($cal_data->lang_keys,true);
			//dd($keys['unit1']);
	        $is_same=explode(' ', $keys['unit1']);
	        if (isset($cal_data->all_converter)) {
				$all_converter=$cal_data->all_converter;
				$data['all_converter']=$all_converter;
			}else{
				if (isset($is_same[1])) {
					$is_same=$is_same[1];
					if (isset($cal_data->is_same)) {
						$is_same = $cal_data->is_same;
					}
					$where=array('cal_cat' =>$cal_data->cal_cat , 'is_calculator'=>'Sub-Converter','is_same'=>$is_same);
					$all_converter = DB::table('calculators')->select('cal_cat','cal_title','is_calculator','is_same','cal_link')->where($where)->get()->toArray();
					$data['all_converter']=$all_converter;
				}
			}
			if (file_exists("lang/" . $parent . ".txt")) {
				$alter = file_get_contents("lang/" . $parent . ".txt");
				if ($alter) {
					$alter = explode('<United-Kingdom>', $alter);
					$hreflang = $alter[0];
					$local_lang = $alter[1];
					$data['hreflang'] = $hreflang;
					$data['local_lang'] = $local_lang;
				}
			}
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

		

			return view('sub-converter',$data);
		}else{
			return redirect(url('/'));
		}
	}

	public function search_unit(Request $request){
		$output='';
		$cal = $request->search;
		if ($cal!='') {
			$get = DB::table('calculators')->select('image_class','cal_link','cal_title','is_calculator')->where("image_class","like",'%'.$cal.'%')->where('is_calculator','Sub-Converter')->get();
			if($get){
				foreach ($get as $value) {
					$output.='<p class="py-2 font-s-14">
					<a href="'.url($value->cal_link).'/" class="text-back text-decoration-none" title="'.$value->cal_title.'">'.$value->cal_title.'</a>
				</p>';
				}
			}else{
				$output.='<p class="py-2 font-s-14">
					<a class="text-back text-decoration-none">Not Found</a>
				</p>';
			}
			return $output;
		}
	}

	public function search(Request $request){
			//dd($request->search_cal);
		if (isset($request->search_cal)) {
			$keys=trim($request->search_cal);
			$main=trim($request->search_cal);
			$keys=strtolower($keys);
			$keys=str_replace('calculator', '', $keys);
			$keys=str_replace('converter', '', $keys);

			$first = DB::table('calculators')
				->select('cal_title', 'meta_title', 'meta_des', 'cal_cat', 'cal_link', 'is_calculator')
				->where('cal_title', $main)
				->orWhere('image_class', $main)
				->orWhere('cal_title', $main)
				->orWhere('meta_title', $main)
				->orWhere('meta_des', $main)
				->get()
				->toArray();
			
			$second = DB::table('calculators')
				->select('cal_title', 'meta_title', 'meta_des', 'cal_cat', 'cal_link', 'is_calculator')
				->where('cal_title', 'like', '%' . $main)
				->orWhere('image_class', 'like', '%' . $keys)
				->orWhere('cal_title', 'like', '%' . $keys)
				->orWhere('meta_title', 'like', '%' . $keys)
				->orWhere('meta_des', 'like', '%' . $keys)
				->get()
				->toArray();
				// Merge the two arrays
			$result = array_merge($first, $second);

			$query = DB::table('calculators')
				->select('cal_title', 'meta_title', 'meta_des', 'cal_cat', 'cal_link', 'is_calculator')
				->where('cal_title', 'like', '%' . $main);

			// Explode keys and build query dynamically
			$keysArray = explode(' ', $keys);
			foreach ($keysArray as $key => $value) {
				if ((count($keysArray) - 1) != $key) {
					$query->orWhere('image_class', 'like', '%' . $value . ' ' . $keysArray[$key + 1]);
					$query->orWhere('cal_title', 'like', '%' . $value . ' ' . $keysArray[$key + 1]);
					$query->orWhere('meta_title', 'like', '%' . $value . ' ' . $keysArray[$key + 1]);
					$query->orWhere('meta_des', 'like', '%' . $value . ' ' . $keysArray[$key + 1]);
				}
			}
			$get2 = $query->get()->toArray();
			$get1=array_merge($result,$get2);
			function multi_unique($src){
				$output = array_map("unserialize",
				array_unique(array_map("serialize", $src)));
			  return $output;
		   }
		   $get=multi_unique($get1);
		   if (app()->getLocale()!='en') {
				foreach ($get as $key => $value) {
					$url=$value['cal_link'];
						$checkUrl=explode('/', $url);
						if (count($checkUrl)>1 && $checkUrl[0]==app()->getLocale()) {
							$link=$value->cal_link;
						}
				}
			}else{
				$link=$get[0]->cal_link;
			}

			$related = DB::table('calculators')
				->select('related_cal')
				->where('cal_link', $link)
				->first();
			$data['related']=json_decode($related->related_cal,true);
			$data['results']=$get;
			$data['keys']=$keys;
			$data['main']=$main;
			$data['noindex']='<meta name="robots" content="noindex">';
			$data['device']=$this->device;
			$data['meta_title']="Search Result";
			$data['meta_des']=__('menu_lang.des');
			$data['page'] = 'search';
			return view('search',$data);
		}
	}
	public function about(){
		$data['device']=$this->device;
		$data['meta_title']="About Us - Logical-calculator.com";
		$data['meta_des']="About Us - Logical-calculator.com";
		$data['page'] = 'about-us';
		return view('pages/about',$data);
	}

	// public function team(){
	// 	$data['device']=$this->device;
	// 	$data['meta_title']="Our Team - Logical-calculator.com";
	// 	$data['meta_des']="Our Team - Logical-calculator.com";
	// 	$data['page'] = 'our-team';
	// 	return view('pages/team',$data);
	// }
	public function editorial_Policies(){
		$data['device']=$this->device;
		$data['meta_title']="Privacy Policy And Cookies";
		$data['meta_des']="You need to agree with our privacy policy statement, if there are any questions and queries regarding this statement, feel free to contact us.";
		$data['page'] = 'privacy-policy';
		return view('pages/editorial',$data);
	}
	public function policy(){
		$data['device']=$this->device;
		$data['meta_title']="Privacy Policy And Cookies";
		$data['meta_des']="You need to agree with our privacy policy statement, if there are any questions and queries regarding this statement, feel free to contact us.";
		$data['page'] = 'privacy-policy';
		return view('pages/policy',$data);
	}
	public function terms(){
		$data['device']=$this->device;
		$data['meta_title']="Terms of Services - Logical-calculator.com";
		$data['meta_des']="When using Logical-calculator.com (website), you are supposed to be strongly tied up with the following terms and conditions.";
		$data['page'] = 'terms-of-service';
		return view('pages/terms',$data);
	}
	public function disclaimer(){
		$data['device']=$this->device;
		$data['meta_title']="Legal Content Disclaimer";
		$data['meta_des']="The use of this site is done at your own risk and even with your agreement that you will be only responsible for any conditions!";
		$data['page'] = 'content-disclaimer';
		return view('pages/disclaimer',$data);
	}
	// public function testimonials(){
	// 	$data['device']=$this->device;
	// 	$data['meta_title']="Testimonials - Logical-calculator.com";
	// 	$data['meta_des']="Testimonials - Logical-calculator.com";
	// 	$data['page'] = 'testimonials';
	// 	return view('pages/testimonials',$data);
	// }
	public function feedback(){
		$data['device']=$this->device;
		$data['meta_title']="Testimonials - Logical-calculator.com";
		$data['meta_des']="Testimonials - Logical-calculator.com";
		$data['page'] = 'testimonials';
		return view('pages/feedback',$data);
	}

	

	public function allcalculators(){
		$data['device']=$this->device;
		$data['meta_title']="All Calculators - Logical-calculator.com";
		$data['meta_des']="All Calculators - Logical-calculator.com";
		$data['page'] = 'All Calculators';

		$allcategories = DB::table('categories')->select('cat_name','is_del', 'img', 'cat_time','cat_id')->where('is_del', 0)->get();
		$this->allcategories = $allcategories;
		$data['allcategories'] = $this->allcategories;
		return view('pages/all_calculators',$data);
	}

	


	public function allcategory(){
		$data['device']=$this->device;
		$data['meta_title']="All Category - Logical-calculator.com";
		$data['meta_des']="All Category - Logical-calculator.com";
		$data['page'] = 'All Category';

		$allcategories = DB::table('categories')->select('cat_name','is_del', 'img', 'cat_time','cat_id')->where('is_del', 0)->get();
		$this->allcategories = $allcategories;

		$posts = DB::table('posts')->where('is_del' , 0)->where('show_hide' , 1)->where('knowledge' , 0)->where('is_aprove' , 1)->orderBy('post_id' , 'DESC')->limit(3)->get();
      
        $data['posts']=$posts;
		$data['device']=$this->device;
		$data['allcategories'] = $this->allcategories;
		return view('pages/all_category',$data);
	}

	public function faq(){
		$data['device']=$this->device;
		$data['meta_title']="faq - Logical-calculator.com";
		$data['meta_des']="faq - Logical-calculator.com";
		$data['page'] = 'faq';

	
		return view('pages/faq',$data);
	}
	

	public function contact(Request $request){


		if (isset($request['send'])) {
			if (!empty($request['name']) && !empty($request['email']) && !empty($request['subject']) && !empty($request['msg'])) {
					$name=$request['name'];
					$email=$request['email'];
					$subject=$request['subject'].' (Technical Calculator)';
					$msg=$request['msg'];
					$to_email='ranazaidmunawar106@gmail.com';
					Mail::send('email/contact', [
						'name'    => $name,
						'email'   => $email,
						'subject' => $subject,
						'comment' => $msg, ],
						function ($message) use($request){
							$message->from($request->email);
							$message->to('ranazaidmunawar106@gmail.com');
							$message->replyTo($request->email)
							->subject('Technical Calculator Contact Form ('.$request['subject'].')');
						}
					);
					$data['done'] = 'Thanks for Contact us. Our team will come back to you as soon as possible.';
			}else{
				$data['error'] = "Please! Check Your Input";
			}
		}
		$data['device']=$this->device;
		$data['meta_title']="Contact Us - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="Have questions or need assistance? We're here to help! Please fill out the form below, and our team at Calculator-Online will get back to you as soon as possible. We look forward to hearing from you!";
		$data['page'] = 'contact-us';
		return view('pages/contact',$data);
	}


	public function feedback_email(Request $request){

		if (isset($request['send'])) {
			if (!empty($request['name']) && !empty($request['email']) && !empty($request['subject']) && !empty($request['msg'])) {
					$name=$request['name'];
					$email=$request['email'];
					$subject=$request['subject'].' (Technical Calculator)';
					$msg=$request['msg'];
					$to_email='ranazaidmunawar106@gmail.com';
					Mail::send('email/contact', [
						'name'    => $name,
						'email'   => $email,
						'subject' => $subject,
						'comment' => $msg, ],
						function ($message) use($request){
							$message->from($request->email);
							$message->to('ranazaidmunawar106@gmail.com');
							$message->replyTo($request->email)
							->subject('Technical Calculator Contact Form ('.$request['subject'].')');
						}
					);
					$data['done'] = 'Thank you for reaching out! Our team will get back to you as soon as possible.';
			}else{
				$data['error'] = "Please! Check Your Input";
			}
		}
		$data['device']=$this->device;
		$data['meta_title']="Feedback - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="If you have any questions or need assistance with our content and calculators, the Calculator-Online team is here to help you 24/7. Feel free to reach out to us with any queries or comments. Please fill out the form below to share your thoughts or ask for support.";
		$data['page'] = 'Feed Back';
		return view('pages/feedback',$data);
	}


	public function register(Request $request){

		if (Auth::check()) {
			// Redirect to home page if already logged in
			return redirect('/')->with('status', 'You are already logged in.');
		}

		if (isset($request['name'])) {
			if (!empty($request['name']) && !empty($request['email']) && !empty($request['password'])) {
					$request->validate([
						'name' => 'required|string|max:250',
						'email' => 'required|email|max:250|unique:users',
						'password' => 'required|min:8|confirmed'
					]);
					User::create([
						'name' => $request->name,
						'email' => $request->email,
						'password' => Hash::make($request->password)
					]);
			
					$credentials = $request->only('email', 'password');
					Auth::attempt($credentials);
					$request->session()->regenerate();
					
					$data['done'] = 'You have successfully registered!.';
				
			}else{
				$data['error'] = "Please! Check Your Input";
			}
		}
		$data['device']=$this->device;
		$data['meta_title']="Feedback - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="If you have any questions or need assistance with our content and calculators, the Calculator-Online team is here to help you 24/7. Feel free to reach out to us with any queries or comments. Please fill out the form below to share your thoughts or ask for support.";
		$data['page'] = 'contact-us';
		return view('auth/register',$data);
	}

	public function login(Request $request){

		if (Auth::check()) {
			// Redirect to home page if already logged in
			return redirect('/')->with('status', 'You are already logged in.');
		}
	
		if (isset($request['email'])) {
			if (!empty($request['email']) && !empty($request['password'])) {

				$credentials = $request->validate([
					'email' => 'required|email',
					'password' => 'required'
				]);

				if(Auth::attempt($credentials))
				{
					if(Auth::user()->user_role == 'admin'){
						return redirect('admin/dashboard')->with('status','Welcome to Dashboard');
					}else{
						return redirect('/')->with('status','Login In Successfully');
					}
				}
					
					return back()->withErrors([
						$data['error'] = "Your provided credentials do not match in our records."
					])->onlyInput('error');

					
				
			}else{
				$data['error'] = "Please! Check Your Input";
			}
		}
		$data['device']=$this->device;
		$data['meta_title']="Feedback - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="If you have any questions or need assistance with our content and calculators, the Calculator-Online team is here to help you 24/7. Feel free to reach out to us with any queries or comments. Please fill out the form below to share your thoughts or ask for support.";
		$data['page'] = 'contact-us';
		return view('auth/login',$data);
	}

	public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
		return redirect('/')->withSuccess('You have logged out successfully!');

    }   


	public function submitForgetPasswordForm(Request $request){

		if (isset($request['email'])) {
			if ( !empty($request['email'])) {
				$request->validate([
					'email' => 'required|email|exists:users',
				]);
				$token = Str::random(64);
				DB::table('password_resets')->insert([
					'email' => $request->email, 
					'token' => $token, 
					'created_at' => Carbon::now()
				]);

				Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
					$message->to($request->email);
					$message->subject('Reset Password');
				});
					
				$data['done'] = 'A password reset link has been sent to your email address.';
			}else{
				$data['error'] = "Please! Check Your Input";
			}
		}
		$data['device']=$this->device;
		$data['meta_title']="Feedback - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="If you have any questions or need assistance with our content and calculators, the Calculator-Online team is here to help you 24/7. Feel free to reach out to us with any queries or comments. Please fill out the form below to share your thoughts or ask for support.";
		$data['page'] = 'contact-us';
		return view('auth/forgetPassword',$data);
	}
	public function showResetPasswordForm(Request $request , $token){

		if (isset($request['email'])) {
			if ( !empty($request['email'])) {
				$request->validate([
					'email' => 'required|email|exists:users',
					'password' => 'required|string|min:6|confirmed',
					'password_confirmation' => 'required'
				]);
				$updatePassword = DB::table('password_resets')
				->where([
				'email' => $request->email, 
				'token' => $request->token
				])
				->first();
				if(!$updatePassword){
				$data['error'] = 'Invalid token!!';
				}else{
					$user = User::where('email', $request->email)
								->update(['password' => Hash::make($request->password)]);
					DB::table('password_resets')->where(['email'=> $request->email])->delete();
					$data['done'] = 'Your password has been changed!';
				}
				

			}else{
				$data['error'] = "Please! Check Your Input";
			}
		}
		$data['device']=$this->device;
		$data['meta_title']="Feedback - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="If you have any questions or need assistance with our content and calculators, the Calculator-Online team is here to help you 24/7. Feel free to reach out to us with any queries or comments. Please fill out the form below to share your thoughts or ask for support.";
		$data['page'] = 'contact-us';
		$data['token'] = $token;
		return view('auth/forgetPasswordLink',$data );

	}
	public function showResetPasswordForms($token) { 

		$data['device']=$this->device;
		$data['meta_title']="Feedback - Get in Touch with Us Anytime, Anywhere";
		$data['meta_des']="If you have any questions or need assistance with our content and calculators, the Calculator-Online team is here to help you 24/7. Feel free to reach out to us with any queries or comments. Please fill out the form below to share your thoughts or ask for support.";
		$data['page'] = 'contact-us';
		$data['token'] = $token;
		return view('auth/forgetPasswordLink',$data );


		// return view('auth.forgetPasswordLink', ['token' => $token]);
	 }

	 public function submitResetPasswordForm(Request $request)

	 {
		 $request->validate([
			 'email' => 'required|email|exists:users',
			 'password' => 'required|string|min:6|confirmed',
			 'password_confirmation' => 'required'
		 ]);
		 $updatePassword = DB::table('password_resets')
					   ->where([
					   'email' => $request->email, 
					   'token' => $request->token
					   ])
					   ->first();
		 if(!$updatePassword){
			 return back()->withInput()->with('error', 'Invalid token!');
		 }
		 $user = User::where('email', $request->email)
					 ->update(['password' => Hash::make($request->password)]);
		 DB::table('password_resets')->where(['email'=> $request->email])->delete();

		 return redirect('/login')->with('message', 'Your password has been changed!');

	 }

	public function advertise(){
		$data['device']=$this->device;
		$data['meta_title']="Advertise with Us";
		$data['meta_des']="Finance calculator from Logical-calculator.com";
		$data['page'] = 'advertise';
		return view('pages/advertise',$data);
	}
	public function hire(){
		$data['device']=$this->device;
		$data['meta_title']="Hire Us | Logical-calculator.com";
		$data['meta_des']="Hire Us | Logical-calculator.com";
		$data['page'] = 'hire-us';
		return view('pages/hire',$data);
	}
	public function sitemap(){
		$calculators = DB::table('calculators')->select('cal_link','parent','show_hide')->where('is_calculator','Calculator')->where('show_hide', 1)->where('no_index',0)->get();
		$posts = DB::table('posts')->where('is_del' , 0)->where('show_hide', 1)->get();
        $data['posts'] = $posts;
        $data['calculators'] = $calculators;
        $contents = view('pages/sitemap')->with($data);

        return response($contents)->header('Content-Type', 'text/xml;charset=iso-8859-1');
	}

	public function calculate(Request $request)
    {

		$className = 'App\\Models\\' . ucfirst($request->calculatorType); // Assuming your models are named like 'Bradford', 'Bmi', etc.
		if (class_exists($className)) {
			
			$model = new $className();
			if (method_exists($model, $request->hidden_name_f)) {
				// Use the method name from the request dynamically
				$methodName = $request->hidden_name_f;
				$result = $model->$methodName($request);
				// Check if result contains an 'error' key
				if (isset($result['error'])) {
					return response()->json([
						'status' => 300,
						'error' => $result['error']
					]);
				} else {
					return response()->json([
						'status' => 200,
						'result' => $result
					]);
				}

			} else {
				return response()->json([
					'status' => 400,
					'error' => 'Calculate method not defined in the model'
				]);
			}
		} else {
			return response()->json(['error' => 'Calculator model not found'], 404);
		}

		
        // $className = 'App\\Models\\' . ucfirst($request->calculatorType); // Assuming your models are named like 'Bradford', 'Bmi', etc.
        // if (class_exists($className)) {
			
		// 	$model = new $className();
		// 	dd($request);
        //     if (method_exists($model, $request->hidden_name_f)) {
		// 		$result = $model->bradford($request);
		// 		  // Check if result contains an 'error' key
		// 		  if (isset($result['error'])) {
		// 			return response()->json([
		// 				'status' => 300,
		// 				'error' => $result['error']
		// 			]);
		// 		} else {
		// 			return response()->json([
		// 				'status' => 200,
		// 				'result' => $result
		// 			]);
		// 		}
			

        //     } else {
		// 		return response()->json([
		// 			'status' => 400,
		// 			'error' => 'Calculate method not defined in the model'
		// 		]);
        //         // return response()->json(['error' => 'Calculate method not defined in the model'], 400);
        //     }
        // } else {
        //     return response()->json(['error' => 'Calculator model not found'], 404);
        // }
    }

	
	public function weightlossMeals(Request $request)
    {
		$activeFoods = $request->input('activeFoods');
		$dietType = $request->input('dietType');
		$prompt = "Generate a JSON object containing a list of recipes. Each recipe should have the following attributes:
    		Give 3 BreakFast, 3 Lunch and 3 Dinner meals according to the $dietType meal type and use these ingredients:
    		every meal should have 3 meals in every category
    		$activeFoods
    		I need a response in JSON format that will give us the meal name, meal ingredients, and meal total calories and then all small and big ingredients including water and every ingredients that will be in meal and ingredients quantity and calories, long complete 8 to 10 lines detailed meal recipe, how to create it.
    		Don't send any extra text like explanation or headings, just the JSON code. I repeat, need only JSON.
    		The JSON format should be like that. No Extra Changes in json format. Just like that:
		".'{
				"breakfast": [
					{
						"meal_name": "Savory Lentil and Vegetable Bowl",
						"ingredients": [
							{
								"name": "Lentils",
								"quantity": "100g",
								"calories": "116 kcal"
							},
							{
								"name": "Cauliflower",
								"quantity": "100g",
								"calories": "25 kcal"
							},
							{
								"name": "Zucchini",
								"quantity": "100g",
								"calories": "17 kcal"
							},
							{
								"name": "Turnip",
								"quantity": "100g",
								"calories": "28 kcal"
							},
							{
								"name": "Olive oil",
								"quantity": "1 tbsp",
								"calories": "119 kcal"
							},
							{
								"name": "Thyme",
								"quantity": "1 tsp",
								"calories": "1 kcal"
							}
						],
						"total_calories": "306 kcal",
						"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
						"meal_time": "15 min"
					}
					//More Meals will be continue
				],
				"lunch": [
					{
						"meal_name": "Savory Lentil and Vegetable Bowl",
						"ingredients": [
							{
								"name": "Lentils",
								"quantity": "100g",
								"calories": "116 kcal"
							},
							{
								"name": "Cauliflower",
								"quantity": "100g",
								"calories": "25 kcal"
							},
							{
								"name": "Zucchini",
								"quantity": "100g",
								"calories": "17 kcal"
							},
							{
								"name": "Turnip",
								"quantity": "100g",
								"calories": "28 kcal"
							},
							{
								"name": "Olive oil",
								"quantity": "1 tbsp",
								"calories": "119 kcal"
							},
							{
								"name": "Thyme",
								"quantity": "1 tsp",
								"calories": "1 kcal"
							}
						],
						"total_calories": "306 kcal",
						"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
						"meal_time": "15 min"
					}
					//More Meals will be continue
				],
				"dinner": [
					{
						"meal_name": "Savory Lentil and Vegetable Bowl",
						"ingredients": [
							{
								"name": "Lentils",
								"quantity": "100g",
								"calories": "116 kcal"
							},
							{
								"name": "Cauliflower",
								"quantity": "100g",
								"calories": "25 kcal"
							},
							{
								"name": "Zucchini",
								"quantity": "100g",
								"calories": "17 kcal"
							},
							{
								"name": "Turnip",
								"quantity": "100g",
								"calories": "28 kcal"
							},
							{
								"name": "Olive oil",
								"quantity": "1 tbsp",
								"calories": "119 kcal"
							},
							{
								"name": "Thyme",
								"quantity": "1 tsp",
								"calories": "1 kcal"
							}
						],
						"total_calories": "306 kcal",
						"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
						"meal_time": "15 min"
					}
					//More Meals will be continue
				]
			}';
		$client = new Client();
		$response = $client->post('https://api.openai.com/v1/chat/completions', [
			'headers' => [
				// 'Authorization' => 'Bearer ' . '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',
				'Authorization' => 'Bearer ' . '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',
				'Content-Type' => 'application/json'
			],
			'json' => [
				"model" => "gpt-4o-mini",
				// "model" => "gpt-3.5-turbo",
				"response_format" => [
					"type" => "json_object"
				],
				"max_tokens" => 3000,
				"messages" => [
					[
						"role" => "user",
						"content" => $prompt
					]
				]
			]
		]);
		$data = json_decode($response->getBody()->getContents(), true);
		$dataArray = $data['choices'][0]['message']['content'];
		$dataArray = json_decode($dataArray, true);
		// dd($dataArray);
		return response()->json([
			'success' => true,
			'message' => 'Data received successfully',
			'response' => $dataArray,
		]);
    }

	public function mealPlanner(Request $request)
    {

		$activeFoods = $request->input('activeFoods');
		$dietType = $request->input('dietType');
		$meals_per_day = $request->input('meals_per_day');
		$eat_calories = $request->input('eat_calories');
		$check_days = $request->input('check_days');
		if($meals_per_day === "1"){
			$mealsType = '
				{
					"'.$check_days.'": [
						"lunch": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						]
					]
				}
			';
		}elseif($meals_per_day === "2"){
			$mealsType = '
				{
					"'.$check_days.'": [
						"breakfast": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"dinner": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						]
					]
				}
			';
		}elseif($meals_per_day === "3"){
			$mealsType = '
				{	
					"'.$check_days.'": [
						"breakfast": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"lunch": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"dinner": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						]
					]
				}
			';
		}elseif($meals_per_day === "4"){
			$mealsType = '
				{
					"'.$check_days.'": [
						"breakfast": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"lunch": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"dinner": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"snack": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						]
					]
				}
			';
		}else{
			$mealsType = '
				{
					"'.$check_days.'": [
						"breakfast": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"snack_1": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"lunch": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"snack_2": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						],
						"dinner": [
							{
								"meal_name": "Savory Lentil and Vegetable Bowl",
								"ingredients": [
									{
										"name": "Lentils",
										"quantity": "100g",
										"calories": "116 kcal"
									},
									{
										"name": "Cauliflower",
										"quantity": "100g",
										"calories": "25 kcal"
									},
									{
										"name": "Zucchini",
										"quantity": "100g",
										"calories": "17 kcal"
									},
									{
										"name": "Turnip",
										"quantity": "100g",
										"calories": "28 kcal"
									},
									{
										"name": "Olive oil",
										"quantity": "1 tbsp",
										"calories": "119 kcal"
									},
									{
										"name": "Thyme",
										"quantity": "1 tsp",
										"calories": "1 kcal"
									}
								],
								"total_calories": "306 kcal",
								"meal_recipe": "Cook lentils until tender. In another pan, sauté cauliflower, zucchini, and diced turnip in olive oil. Season with thyme, salt, and pepper. Combine with lentils.",
								"meal_time": "15 min",
								"cook_time": "15 min",
								"carbs": "11g",
								"fat": "14g",
								"protein": "17g",
							}
						]
					]
				}
			';
		}
		$prompt = "Generate a JSON object containing a list of recipes. Each recipe should have the following attributes:
    		Give me $check_days meal plan of $eat_calories calories per day in which i want to striclty $meals_per_day meals per day according to the $dietType meal type and use these ingredients:
    		$activeFoods
    		I need a response in JSON format that will give us the meal name, meal ingredients, and meal total calories and then all small and big ingredients including water and every ingredients that will be in meal and ingredients quantity and calories, long complete 8 to 10 lines detailed meal recipe, how to create it.
    		Don't send any extra text like explanation or headings, just the JSON code. I repeat, need only JSON.
    		The JSON format should be like that. No Extra Changes in json format. Just like that:
		".$mealsType;
		$client = new Client();
		$response = $client->post('https://api.openai.com/v1/chat/completions', [
			'headers' => [
				// 'Authorization' => 'Bearer ' . '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',
				'Authorization' => 'Bearer ' . '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',
				'Content-Type' => 'application/json'
			],
			'json' => [
				"model" => "gpt-4o-mini",
				// "model" => "gpt-3.5-turbo",
				"response_format" => [
					"type" => "json_object"
				],
				"max_tokens" => 16000,
				"messages" => [
					[
						"role" => "user",
						"content" => $prompt
					]
				]
			]
		]);
		$data = json_decode($response->getBody()->getContents(), true);
		$dataArray = $data['choices'][0]['message']['content'];
		$dataArray = json_decode($dataArray, true);
		return response()->json([
			'success' => true,
			'message' => 'Data received successfully',
			'response' => $dataArray,
		]);
    }

	public function mathSolver(Request $request){
		try {
			$file = $request->file('file');
			$time = $request->time;
			$name = pathinfo(preg_replace('/[^A-Za-z0-9\_\.]/', '_', $file->getClientOriginalName()), PATHINFO_FILENAME);
			$name = "$time-$name";
			$ext = $file->getClientOriginalExtension();
		
			$new_file_name = $name . '.' . $ext;
			$fromExt = $request->from;
			$fromExts = str_replace(' ', '', $fromExt);
			$fromExts = str_replace('.', '', $fromExts);
			$fromExts = explode(',', $fromExts);
			$toExt = $request->to;
			if ($ext == "webp" || $ext == "bmp") {
				$ext = "png";
			}  if ($ext == "heic" || $ext == "heif") {
				$ext = "jpg";
			}
			
			if (in_array($ext, $fromExts)) {
				// $file->move("source", "$name.$ext");
				$file->move(public_path("source"), "$name.$ext");
		
				if ($ext == "heic" || $ext == "heif") {
					$ext = "jpg";
					$cvt_file_name = $name . '.' . $ext;
					$source = public_path("source/$new_file_name");
					$destination = public_path("source/$cvt_file_name");
				}
				return response()->json(['file_name' => $new_file_name]);
			} else {
				return 'error';
			}
		} catch (\Exception $error) {
			return 'error';
		}	
	}

	public function imageCrop(Request $request)
	{
		$uploadFolder = 'source';
		$data = $request->image;
		$originalSrc = $request->originalSrc;
		$originalFileName = basename($originalSrc);
		// Generate a unique filename using a timestamp
		$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
		$uniqueFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_crop' . '.' . $fileExtension;
		$originalFilePath = public_path("$uploadFolder/$originalFileName");
		if (file_exists($originalFilePath)) {
			unlink($originalFilePath);
		}
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		file_put_contents("$uploadFolder/$uniqueFileName", $data);
		$file = url("/$uploadFolder/$uniqueFileName");
		return response()->json(['file' => $file, 'originalSrc' => $originalSrc]);
	} 

	public function cron(){
        if(File::exists(public_path('source/'))){
          	File::cleanDirectory(public_path('source/'));
        }
    }
	


	

}
