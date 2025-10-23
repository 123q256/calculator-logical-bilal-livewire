<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

	public $LoginUser;
	
	function __construct() {
        if (isset($_COOKIE['technical_calculator'])) {
            $login_id= $_COOKIE['technical_calculator'];
			$id = DB::table('login_table')->where('login_id',$login_id)->select('id')->first();
            if ($id) {
                $id=$id->id;
				$user = DB::table('admins')->where('admin_id',$id)->first();
				
                $this->LoginUser = (array)$user;
            }else{
                $this->LoginUser = '';
            }
        }else{
            $this->LoginUser = '';
        }
    }
	public function index(){
		if (!empty($this->LoginUser)) {
			return redirect(url("admin/calculators/"));
		}else{
			//dd('ff');
			return redirect(url('admin/login/'));
		}
	}
    public function login(Request $request){
	
    	if (isset($request->submit)) {
    		$request->validate([
			    'name' => 'required',
			    'pass' => 'required',
			]);
			$name=$request->name;
			$password=$request->pass;
			$user = DB::table('admins')->where([
                ['admin_name',$name],['admin_pass',$password]
            ])->first();
			
            if ($user) {
				$adminId = $user->admin_id;
				$login_id=md5($name.time());
				$data['login_id']=$login_id;
				$data['id']=$adminId;
                DB::table('login_table')->insert($data);
				// dd($login_id);

				setcookie("technical_calculator" , $login_id , time()+24*3600 ,"/");
                if (isset($_COOKIE['technical_calculator-last'])) {
					$last=$_COOKIE['technical_calculator-last'];
					return redirect (url($last));
				}else{
					return redirect(url("admin/calculators/"));
				}
            }else{
                return back()->with('admin_error',"User name or password not correct!");
            }
    	}else{
    		return view('admin/login');
    	}
    }

	public function logout(){
		$id=$this->LoginUser['admin_id'];
		//dd($id);
		DB::table('login_table')->where('id',$id)->delete();
		setcookie("technical_calculator" , 'logout' , time()-1 ,"/");
		// return redirect(url()->to('admin/login-admin'));
		redirect (url()."admin/login");
	}


	function slugify_string($text) {
		// replace non letter or digits by -
		$text = str_replace("'", '', $text);
		$text = str_replace("?", '', $text);
		$text = str_replace("%", '', $text);
		$text = str_replace(" ", '-', $text);
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// trim
		$text = trim($text, '-');
		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		// lowercase
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}
	function Combine($array1, $array2) {
		if(count($array1) == count($array2)) {
			$assArray = array();
			for($i=0;$i<count($array1);$i++) {
				if (!empty($array1[$i]) && !empty($array2[$i])) {
					$assArray[$array1[$i]] = ($array2[$i]);
				}
			}
			return $assArray;
		}else{
			// $check=false;
		}
	}
	public function saveCalculator($request,$id=null){
		$keysname=$request->keyname;
		$keyvalues=$request->keyvalue;
		$check=true;
		$key_values=$this->Combine($keysname,$keyvalues);
		$key_values=json_encode($key_values);
		// foreach ($_POST as $key => $value) {
		// 	if (empty($value)) {
		// 		if($key!='cal_des' && $key!='parent' && $key!='cal_cat' && $key!='count_rel' && $key!='TOC'){
		// 			$check=false;
		// 		}
		// 	}
		// }

		$desktop_ad = array();
		$mobile_ad = array();
		$noindex=0;
		if (isset($request->noindex)) {
			$noindex=1;
		}
		$show_hide=0;
		if (isset($request->show_hide)) {
			$show_hide=1;
		}

		if (is_null($id)) {
			$cal_link=$request->cal_url;
			$url_check = DB::table('calculators')->where('cal_link',$cal_link)->first();
			if ($url_check) {
				return back()->with('status',"This url is alreay takken.");
			}
		}
		

		if ($check=='true') {
			$cal_title=$request->cal_title;
			$cal_link=$request->cal_url;
			$is_calculator=$request->is_calculator;
			$cal_search=$request->cal_search;
			$meta_title=$request->meta_title;
			$meta_des=$request->meta_des;
			$cal_des=$request->cal_des;
			if (!empty($request->parent)){
				$parent=$request->parent;
			}else{
				$parent=$request->cal_title;
			}
			$cal_cat=$request->cal_cat;

			$img_base="Empty";
			$cal_sub_cat=$request->cal_sub_cat;
			if (!empty($_FILES['cal_img']['name'])) {
				$img_name=$_FILES['cal_img']['name'];
				$type=$_FILES['cal_img']['type'];
				$path=$_FILES['cal_img']['tmp_name'];
				$dir='assets/img/';
				$exp=explode('/', $type);
				if ($exp['0']!='image') {
					return back()->with('status',"Only Image can be uploded.");
				}
				$move=move_uploaded_file($path, $dir.$img_name);
				if (!$move) {
					return back()->with('status',"Image not uploded.");
				}
			}else{
				$img_name = 'Empty';
			}
			
			// if (is_null($id)) {
			// 	if(!empty($request->parent)){
			// 		$res = DB::table('calculators')->where('cal_title',$request->parent)->select('cal_img')->first();
			// 		dd($res);
			// 		$img_name=$res->cal_img;
			// 	}
			// }
			if ($is_calculator==='Calculator') {
				$related_cal=[];
				for ($i=1; $i <=$request->count_rel ; $i++) { 
					if (!empty($_POST['related_cal'.$i])) {
						$related_cal[]=$_POST['related_cal'.$i];
					}
				}
			}else{
				$related_cal=$request->related_cal;
			}
			$aprove=0;
			if (isset($request->aprove)) {
				$aprove=1;
			}
			$is_show=0;
			if (isset($request->is_show)) {
				$is_show=1;
			}
			$add_by=$this->LoginUser['admin_name'];
			$update_by=$this->LoginUser['admin_name'];
			$more = DB::table('calculators')->select('cal_link','cal_title','cal_cat','no_index')->where('cal_cat',$cal_cat)->limit(13)->get();
			$related_cal['more']=$more;
			$related_cal=json_encode($related_cal);
			$mathjax=0;
			if (isset($_POST['mathjax'])) {
				$mathjax=1;
			}
			$clarity=0;
			if (isset($_POST['clarity'])) {
				$clarity=1;
			}
			if(isset($request->cal_sub_cat)){
				$cal_sub_cat = $cal_sub_cat;
			}else{
				$cal_sub_cat = 0;
			}
			$data_array = array(
				'cal_title' => $cal_title,
				'cal_link' => $cal_link,
				'cal_detail' => $cal_des,
				'image_class' => $cal_search,
				'meta_title' => $meta_title,
				'meta_des'=> $meta_des,
				'content'=> $request->content,
				'clarity'=> $clarity,
				'is_calculator'=> $is_calculator,
				'img_base64' => $img_base,
				'lang_keys' => $key_values,
				'cal_sub_cat'=> $cal_sub_cat,
				'show_hide'=> $show_hide,
				'no_index' => $noindex,
				'related_cal' => $related_cal,
				'cal_cat' => $cal_cat,
				'desktop_ad' => '',
				'mobile_ad' => '',
				'parent' => $parent,
				'is_show' => $is_show,
				'is_aprove' => $aprove,
				'add_by' => $add_by,
				'update_by' => $update_by,
				'mathjax' => $mathjax,
			);
			if (is_null($id)) {
				$data_array['cal_img'] = $img_name;
				$data_array['img_name'] = $img_name;
			}
			if (!is_null($id) && $img_name!='not') {
				$data_array['cal_img'] = $img_name;
				$data_array['img_name'] = $img_name;
			}
			if (!empty($request->TOC)) {
				$TOC=$request->TOC;
				$tableOC=explode(PHP_EOL, $TOC);
				$final_TOC['by-default']=$TOC;
				foreach ($tableOC as $key => $value) {
					$index=$this->slugify_string($value);
					$final_TOC[$index]=$value;
				}
				$data_array['TOC']=json_encode($final_TOC);
			}
			if (!is_null($id)){
				$done = DB::table('calculators')->where('cal_id',$id)->update($data_array);
			}else{
				// dd($data_array);
				$done = DB::table('calculators')->insert($data_array);
			}
			if ($done) {
				if ($aprove===1) {
					$link=explode('/', $cal_link);
					if (count($link) > 1) {
						$file= $link[0]."-".$link[1];
						$hreflang='<link rel="alternate" hreflang="x-default" href="'.url("$link[1]").'/"/><link rel="alternate" hreflang="en" href="'.url("$link[1]").'/"/>';
						$local_lang='<li><a class="color_blue" href="'.url("$link[1]").'/">EN</a></li>';
						// $alter = DB::table('calculators')->where('cal_link',$cal_link)->select('parent')->first();
						// $parent=$alter->parent;
						$alter = DB::table('calculators')->select('parent','cal_link')->where('parent',$parent)->get();
						if ($alter) {
							foreach ($alter as $key => $value) {
								$value= (array)$value;
								$link_c=$value['cal_link'];
								$lang_type=explode('/', $link_c);
								if ($lang_type[0]=='iw') {
									$lang_type[0]='he';
								}
								if ($link_c!=$link[1]) {
									$hreflang.='<link rel="alternate" hreflang="'.$lang_type[0].'" href="'.url("$link_c").'/"/>';
									$local_lang.='<li><a class="color_blue" href="'.url("$link_c").'/">'.strtoupper($lang_type[0]).'</a></li>';
								}
							}
							$data=$hreflang;
							$data.="<United-Kingdom>";
							$data.=$local_lang;
							file_put_contents("lang/".$parent.".txt", $data);
						}
					}else{
						$file=$cal_link;
						
						$alter = DB::table('calculators')->select('parent','cal_link')->where('parent',$parent)->get();
						if ($alter && count($alter)>1){
							$hreflang='<link rel="alternate" hreflang="x-default" href="'.url("$cal_link").'/"/><link rel="alternate" hreflang="en" href="'.url("$cal_link").'/"/>';
							$local_lang='<li><a class="color_blue" href="'.url("$cal_link").'/">EN</a></li>';
							foreach ($alter as $key => $value) {
								$value= (array)$value;
								$link=$value['cal_link'];
								$lang_type=explode('/', $link);
								if ($lang_type[0]=='iw') {
									$lang_type[0]='he';
								}
								if ($link!=$cal_link) {
									$hreflang.='<link rel="alternate" hreflang="'.$lang_type[0].'" href="'.url("$link").'/"/>';
									$local_lang.='<li><a class="color_blue" href="'.url("$link").'/">'.strtoupper($lang_type[0]).'</a></li>';
								}
							}
							$data=$hreflang;
							$data.="<United-Kingdom>";
							$data.=$local_lang;
							file_put_contents("lang/".$parent.".txt", $data);
						}
					}
					$checking = DB::table('calculators')
					->select('cal_img','cal_title','cal_link','meta_title','meta_des','lang_keys','parent','no_index','related_cal','cal_cat','desktop_ad','mobile_ad','is_calculator','mathjax','TOC','is_same','content','clarity')
					->where('cal_link',$cal_link)->first();
					file_put_contents("keys/".$file.".txt", json_encode($checking));
					$search = DB::table('calculators')
					->select('cal_title','cal_link','is_calculator','image_class')->get();
					// ->where('is_calculator','!=','Sub-Converter')->get();
					$autoCom=[];
					foreach ($search as $key => $value) {
						$link=$value->cal_link;
						$checkUrl=explode('/', $link);
						if (count($checkUrl)>1) {
							if (strlen($checkUrl[0])==2) {
								$index=$checkUrl[0];
							}else{
								$index='en';
							}
						}else{
							$index='en';
						}
						$autoCom[$index][] = str_replace('Convert ','',$value->cal_title);
					}
					file_put_contents('autoCommmera-all.txt', json_encode($autoCom));
					file_put_contents('search-all-calculator.txt', json_encode($search));
					$calculators = DB::table('calculators')->select('cal_cat','cal_title','is_calculator','cal_detail','cal_link','cal_img','no_index')
					->where('is_calculator','Calculator')
					->get();
					file_put_contents('technical-online-calculators.txt', json_encode($calculators));
					if (!is_null($id)){
						$add = 'Update';
					}else{
						$add = 'Add';
					}
					return back()->with('status',"Calculator $add Successfully.");
				}else{
					if (!is_null($id)){
						$add = 'Update';
					}else{
						$add = 'Add';
					}
					return back()->with('status',"Calculator $add Successfully and Goes pending.");
				}
			} else {
				return back()->with('status',"Nothing to Update here");
			}
			
		} else {
			return back()->with('status',"Please fill all fields.");
		}
	}
	public function saveSubConverter($request,$id=null){
		$keysname=$request->keyname;
		$keyvalues=$request->keyvalue;
		$check=true;
		$key_values=$this->Combine($keysname,$keyvalues);
		$key_values=json_encode($key_values);
		// foreach ($_POST as $key => $value) {
		// 	if (empty($value)) {
		// 		if($key!='cal_des' && $key!='parent' && $key!='cal_cat' && $key!='count_rel' && $key!='TOC'){
		// 			$check=false;
		// 		}
		// 	}
		// }
		$desktop_ad = array();
		$mobile_ad = array();
		$noindex=0;
		if (isset($request->noindex)) {
			$noindex=1;
		}
		if (is_null($id)) {
			$cal_link=$request->cal_url;
			$url_check = DB::table('calculators')->where('cal_link',$cal_link)->first();
			if ($url_check) {
				return back()->with('status',"This url is alreay takken.");
			}
		}
		if ($check=='true') {
			$cal_title=$request->cal_title;
			$cal_link=$request->cal_url;
			$is_calculator=$request->is_calculator;
			$cal_search=$request->cal_search;
			$meta_title=$request->meta_title;
			$meta_des=$request->meta_des;
			$cal_des=$request->cal_des;
			if (!empty($request->parent)){
				$parent=$request->parent;
			}else{
				$parent=$request->cal_title;
			}
			$cal_sub_cat=$request->cal_sub_cat;
			$cal_cat=$request->cal_cat;
			$img_base="kuch ni";
			if (!empty($_FILES['cal_img']['name'])) {
				$img_name=$_FILES['cal_img']['name'];
				$type=$_FILES['cal_img']['type'];
				$path=$_FILES['cal_img']['tmp_name'];
				$dir='assets/img/';
				$exp=explode('/', $type);
				if ($exp['0']!='image') {
					return back()->with('status',"Only Image can be uploded.");
				}
				$move=move_uploaded_file($path, $dir.$img_name);
				if (!$move) {
					return back()->with('status',"Image not uploded.");
				}
			}else{
				$img_name = 'not';
			}
			if (is_null($id)) {
				if(!empty($request->parent)){
					$res = DB::table('calculators')->where('cal_title',$request->parent)->select('cal_img')->first();
					$img_name=$res->cal_img;
				}
			}
			if ($is_calculator==='Calculator') {
				$related_cal=[];
				for ($i=1; $i <=$request->count_rel ; $i++) { 
					if (!empty($_POST['related_cal'.$i])) {
						$related_cal[]=$_POST['related_cal'.$i];
					}
				}
			}else{
				$related_cal=$request->related_cal;
			}
			$aprove=0;
			if (isset($request->aprove)) {
				$aprove=1;
			}
			$is_show=0;
			if (isset($request->is_show)) {
				$is_show=1;
			}
			$add_by=$this->LoginUser['admin_name'];
			$update_by=$this->LoginUser['admin_name'];
			$related_cal=json_encode($related_cal);
			$mathjax=0;
			if (isset($_POST['mathjax'])) {
				$mathjax=1;
			}
			$clarity=0;
			if (isset($_POST['clarity'])) {
				$clarity=1;
			}
			if(!empty($cal_sub_cat)){
				$cal_sub_cat=$request->cal_sub_cat;

			}else{
				$cal_sub_cat= '';
			}
			$data_array = array(
				'cal_title' => $cal_title,
				'cal_link' => $cal_link,
				'cal_detail' => $cal_des,
				'image_class' => $cal_search,
				'meta_title' => $meta_title,
				'meta_des'=> $meta_des,
				'content'=> $request->content,
				'clarity'=> $clarity,
				'is_calculator'=> $is_calculator,
				'img_base64' => $img_base,
				'lang_keys' => $key_values,
				'no_index' => $noindex,
				'related_cal' => $related_cal,
				'cal_cat' => $cal_cat,
				'cal_sub_cat' => $cal_sub_cat,
				'desktop_ad' => '',
				'mobile_ad' => '',
				'parent' => $parent,
				'is_show' => $is_show,
				'is_aprove' => $aprove,
				'add_by' => $add_by,
				'update_by' => $update_by,
				'mathjax' => $mathjax,
			);
			if (is_null($id)) {
				$data_array['cal_img'] = $img_name;
				$data_array['img_name'] = $img_name;
			}
			if (!is_null($id) && $img_name!='not') {
				$data_array['cal_img'] = $img_name;
				$data_array['img_name'] = $img_name;
			}
			if (!empty($request->TOC)) {
				$TOC=$request->TOC;
				$tableOC=explode(PHP_EOL, $TOC);
				$final_TOC['by-default']=$TOC;
				foreach ($tableOC as $key => $value) {
					$index=$this->slugify_string($value);
					$final_TOC[$index]=$value;
				}
				$data_array['TOC']=json_encode($final_TOC);
			}
			if (!is_null($id)){
				$done = DB::table('calculators')->where('cal_id',$id)->update($data_array);
			}else{
				$done = DB::table('calculators')->insert($data_array);
			}
			if ($done) {
				if ($aprove===1) {
					$link=explode('/', $cal_link);
					if (count($link) > 2) {
						$file =str_replace('/','-',$cal_link);
						$link_=$link[1].'/'.$link[2];
						$hreflang='<link rel="alternate" hreflang="x-default" href="'.url("$link_").'/"/><link rel="alternate" hreflang="en" href="'.url("$link_").'/"/>';
						$local_lang='<li><a class="color_blue" href="'.url("$link_").'/">EN</a></li>';
						// $alter = DB::table('calculators')->where('cal_link',$cal_link)->select('parent')->first();
						// $parent=$alter->parent;
						$alter = DB::table('calculators')->select('parent','cal_link')->where('parent',$parent)->get();
						if ($alter) {
							foreach ($alter as $key => $value) {
								$value= (array)$value;
								$link=$value['cal_link'];
								$lang_type=explode('/', $link);
								if ($lang_type[0]=='iw') {
									$lang_type[0]='he';
								}
								if ($link!=$link_) {
									$hreflang.='<link rel="alternate" hreflang="'.$lang_type[0].'" href="'.url("$link").'/"/>';
									$local_lang.='<li><a class="color_blue" href="'.url("$link").'/">'.strtoupper($lang_type[0]).'</a></li>';
								}
							}
							$data=$hreflang;
							$data.="<United-Kingdom>";
							$data.=$local_lang;
							file_put_contents("lang/".$parent.".txt", $data);
						}
					}else{
						$file =str_replace('/','-',$cal_link);
						
						$alter = DB::table('calculators')->select('parent','cal_link')->where('parent',$parent)->get();
						if ($alter && count($alter)>1){
							$hreflang='<link rel="alternate" hreflang="x-default" href="'.url("$cal_link").'/"/><link rel="alternate" hreflang="en" href="'.url("$cal_link").'/"/>';
							$local_lang='<li><a class="color_blue" href="'.url("$cal_link").'/">EN</a></li>';
							foreach ($alter as $key => $value) {
								$value= (array)$value;
								$link=$value['cal_link'];
								$lang_type=explode('/', $link);
								if ($lang_type[0]=='iw') {
									$lang_type[0]='he';
								}
								if ($link!=$cal_link) {
									$hreflang.='<link rel="alternate" hreflang="'.$lang_type[0].'" href="'.url("$link").'/"/>';
									$local_lang.='<li><a class="color_blue" href="'.url("$link").'/">'.strtoupper($lang_type[0]).'</a></li>';
								}
							}
							$data=$hreflang;
							$data.="<United-Kingdom>";
							$data.=$local_lang;
							file_put_contents("lang/".$parent.".txt", $data);
						}
					}
					$checking = DB::table('calculators')
					->select('cal_img','cal_title','cal_link','meta_title','meta_des','lang_keys','parent','no_index','related_cal','cal_cat','desktop_ad','mobile_ad','is_calculator','mathjax','TOC','is_same','content','clarity')
					->where('cal_link',$cal_link)->first();
					file_put_contents("keys/".$file.".txt", json_encode($checking));
					if (!is_null($id)){
						$add = 'Update';
					}else{
						$add = 'Add';
					}
					return back()->with('status',"Converter $add Successfully.");
				}else{
					if (!is_null($id)){
						$add = 'Update';
					}else{
						$add = 'Add';
					}
					return back()->with('status',"Converter $add Successfully and Goes pending.");
				}
			} else {
				return back()->with('status',"Nothing to Update here");
			}
			
		} else {
			return back()->with('status',"Please fill all fields.");
		}
	}
	
	public function approve($id,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser) && $this->LoginUser['role']=='1') {
			$update_by=$this->LoginUser['admin_name'];
			DB::table('calculators')->where('cal_id',$id)->update(['is_aprove'=>1,'update_by'=>$update_by]);
			$calculator = DB::table('calculators')->where('cal_id',$id)->first();
			$parent=$calculator->parent;
			$cal_link=$calculator->cal_link;
			$link=explode('/', $cal_link);
			if (count($link) > 1) {
				$file= $link[0]."-".$link[1];
				$hreflang='<link rel="alternate" hreflang="x-default" href="'.url("$link[1]").'/"/><link rel="alternate" hreflang="en" href="'.url("$link[1]").'/"/>';
				$local_lang='<li><a class="color_blue" href="'.url("$link[1]").'/">EN</a></li>';
				// $alter = DB::table('calculators')->where('cal_link',$cal_link)->select('parent')->first();
				// $parent=$alter->parent;
				$alter = DB::table('calculators')->select('parent','cal_link')->where('parent',$parent)->get();
				if ($alter) {
					foreach ($alter as $key => $value) {
						$value= (array)$value;
						$link_c=$value['cal_link'];
						$lang_type=explode('/', $link_c);
						if ($lang_type[0]=='iw') {
							$lang_type[0]='he';
						}
						if ($link_c!=$link[1]) {
							$hreflang.='<link rel="alternate" hreflang="'.$lang_type[0].'" href="'.url("$link_c").'/"/>';
							$local_lang.='<li><a class="color_blue" href="'.url("$link_c").'/">'.strtoupper($lang_type[0]).'</a></li>';
						}
					}
					$data=$hreflang;
					$data.="<United-Kingdom>";
					$data.=$local_lang;
					file_put_contents("lang/".$parent.".txt", $data);
				}
			}else{
				$file=$cal_link;
				
				$alter = DB::table('calculators')->select('parent','cal_link')->where('parent',$parent)->get();
				if ($alter && count($alter)>1){
					$hreflang='<link rel="alternate" hreflang="x-default" href="'.url("$cal_link").'/"/><link rel="alternate" hreflang="en" href="'.url("$cal_link").'/"/>';
					$local_lang='<li><a class="color_blue" href="'.url("$cal_link").'/">EN</a></li>';
					foreach ($alter as $key => $value) {
						$value= (array)$value;
						$link=$value['cal_link'];
						$lang_type=explode('/', $link);
						if ($lang_type[0]=='iw') {
							$lang_type[0]='he';
						}
						if ($link!=$cal_link) {
							$hreflang.='<link rel="alternate" hreflang="'.$lang_type[0].'" href="'.url("$link").'/"/>';
							$local_lang.='<li><a class="color_blue" href="'.url("$link").'/">'.strtoupper($lang_type[0]).'</a></li>';
						}
					}
					$data=$hreflang;
					$data.="<United-Kingdom>";
					$data.=$local_lang;
					file_put_contents("lang/".$parent.".txt", $data);
				}
			}
			$checking = DB::table('calculators')
			->select('cal_img','cal_title','cal_link','meta_title','meta_des','lang_keys','parent','no_index','related_cal','cal_cat','desktop_ad','mobile_ad','is_calculator','mathjax','TOC')
			->where('cal_link',$cal_link)->first();
			file_put_contents("keys/".$file.".txt", json_encode($checking));
			$search = DB::table('calculators')
			->select('cal_title','cal_link','is_calculator','image_class')
			->where('is_calculator','!=','Sub-Converter')->get();
			file_put_contents('search-all-calculator.txt', json_encode($search));
			return back()->with('status',"Calculator approve Successfully.");
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function addCalculator(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->add_calculator)) {
				$data = $request->validate([
					'cal_cat' => 'required',
					'cal_title' => 'required',
					'cal_url' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
					// 'cal_sub_cat' => 'required',
				]);

				$this->saveCalculator($request);
			}
			$parent = DB::table('calculators')->where('is_calculator','Calculator')->select('cal_title','cal_link','cal_cat','cal_link','cal_img')->get();
			$get_cats = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->get();
			$get_subcats = DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent', 'cat_time')->get();
			return view('admin/temp/index',['parent'=>$parent,'get_cats'=>$get_cats,'get_subcats'=>$get_subcats,'LoginUser'=>$this->LoginUser]);

		}else{
			return redirect(url('admin/login/'));
		}
	
	}

	public function editCalculator($id,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->add_calculator)) {
				$data = $request->validate([
					'cal_cat' => 'required',
					'cal_title' => 'required',
					'cal_url' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',  
					// 'cal_sub_cat' => 'required',
				]);
				$this->saveCalculator($request,$id);
			}
			$page = DB::table('calculators')->where('cal_id',$id)->first();
			if(!empty($page->cal_sub_cat)){
				$get_sub= DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent', 'cat_time')->where('cat_id',$page->cal_sub_cat)->first();
				$get_subcats = DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent', 'cat_time')->where('cat_parent',$get_sub->cat_parent)->get();
			}else{
				$get_sub= DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent', 'cat_time')->where('cat_parent',0)->first();
				$categories = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->where('cat_name',$page->cal_cat)->first();
				$get_subcats = DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent', 'cat_time')->where('cat_parent',$categories->cat_id)->get();
			}
			$parent = DB::table('calculators')->where('is_calculator','Calculator')->select('cal_title','cal_link','cal_cat','cal_sub_cat','cal_link','cal_img')->get();
			$get_cats = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->get();
			return view('admin/temp/edit-calculator',['page'=>$page,'parent'=>$parent,'get_cats'=>$get_cats,'get_subcats'=>$get_subcats,'LoginUser'=>$this->LoginUser , 'subcategor_id'=>$page->cal_sub_cat ,'cal_cat'=>$page->cal_cat , 'get_sub'=>$get_sub]);
		}else{
			return redirect(url('admin/login/'));
		}
	}



	public function addConverter(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->add_calculator)) {
				$data = $request->validate([
					'cal_cat' => 'required',
					'cal_title' => 'required',
					'cal_url' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
				]);

				$this->saveCalculator($request);
			}
			$parent = DB::table('calculators')->where('is_calculator','Converter')->select('cal_title','cal_link','cal_cat','cal_link','cal_img')->get();
			return view('admin/temp/add-converter',['parent'=>$parent,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}
	public function editConverter($id,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->add_calculator)) {
				$data = $request->validate([
					'cal_cat' => 'required',
					'cal_title' => 'required',
					'cal_url' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
				]);
				$this->saveCalculator($request,$id);
			}
			$page = DB::table('calculators')->where('cal_id',$id)->first();
			$parent = DB::table('calculators')->where('is_calculator','Converter')->select('cal_title','cal_link','cal_cat','cal_link','cal_img')->get();
			return view('admin/temp/edit-converter',['page'=>$page,'parent'=>$parent,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function addSubConverter(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->add_calculator)) {
				$data = $request->validate([
					'cal_cat' => 'required',
					'cal_title' => 'required',
					'cal_url' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
				]);

				$this->saveSubConverter($request);
			}
			$parent = DB::table('calculators')->where('is_calculator','Sub-Converter')->orWhere('is_calculator','Converter')->select('cal_title','cal_link','cal_cat','cal_link','cal_img','is_calculator')->get();
			return view('admin/temp/add-sub-converter',['parent'=>$parent,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}
	public function editSubConverter($id,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->add_calculator)) {
				$data = $request->validate([
					'cal_cat' => 'required',
					'cal_title' => 'required',
					'cal_url' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
				]);

				$this->saveSubConverter($request,$id);
			}
			$page = DB::table('calculators')->where('cal_id',$id)->first();
			$parent = DB::table('calculators')->where('is_calculator','Sub-Converter')->orWhere('is_calculator','Converter')->select('cal_title','cal_link','cal_cat','cal_link','cal_img','is_calculator')->get();
			return view('admin/temp/edit-sub-converter',['parent'=>$parent,'page'=>$page,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}
	public function calculators(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			// $checking = DB::table('calculators')
			// ->select('cal_img','cal_title','cal_link','meta_title','meta_des','lang_keys','parent','no_index','related_cal','cal_cat','desktop_ad','mobile_ad','is_calculator','mathjax','TOC','is_same','content')->get();
			// foreach ($checking as $key => $value) {
			// 	$file = str_replace('/','-',$value->cal_link);	
			// 	file_put_contents("keys/".$file.".txt", json_encode($value));
			// }
			// $get_cal = DB::table('calculators')->select('cal_link','cal_id')->get();
			// foreach ($get_cal as $key => $value) {
			// 	$post_name = $value->cal_link;
			// 	$post_name = str_replace('/','-',$post_name);
			// 	$content = DB::table('wp_posts')->select('post_content')->where('post_name',$post_name)->first();
			// 	if (!is_null($content)) {
			// 		echo $value->cal_id.'<br>';
			// 		$id = $value->cal_id;
			// 		$data_array['content'] = $content->post_content;
			// 		$done = DB::table('calculators')->where('cal_id',$id)->update($data_array);
			// 	}
			// }
			$is = 'Calculator';
			if ($request->getRequestUri()=='/admin/converters' || $request->getRequestUri()=='/admin/converters/') {
				$is = 'Converter';
			}
			$get_cal = DB::table('calculators')->where('is_calculator',$is)->select('parent','cal_title','is_calculator','cal_id','cal_link','cal_cat','show_hide','no_index')->get();
			$total = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->get()->count();
			// Health count All 1
			$healthcount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Health')->get()->count();
			// Math count All 2
			$mathcount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Math')->get()->count();
				// Everyday-Life count All 3
				$everydayLifecount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Everyday-Life')->get()->count();
				// Finance count All 4
				$financecount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Finance')->get()->count();
				// Physics count All 5
	     	$physicscount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Physics')->get()->count();
			// Chemistry count All 6
			$chemistrycount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Chemistry')->get()->count();
			
			// statistics count All 7
			$statisticscount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Statistics')->get()->count();
			// Construction count All 8
			$Constructioncount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Construction')->get()->count();
					// Pets count All 9
			$petscount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Pets')->get()->count();
					// Timedate count All 10
			$timedatecount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('cal_cat','Timedate')->get()->count();
			
			// Index count All 0
			$indexcount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('no_index', 0)->get()->count();

			// noindex count All 1
			$noindexcount = DB::table('calculators')->select('parent')->groupBy('parent')->where('is_calculator',$is)->where('no_index', 1)->get()->count();


			return view('admin/temp/all-calculators',['pages'=>$get_cal,'is'=> $is,'LoginUser'=>$this->LoginUser,'total'=>$total,'healthcount'=>$healthcount,'mathcount'=>$mathcount,'everydayLifecount'=>$everydayLifecount,'financecount'=>$financecount,'physicscount'=>$physicscount,'chemistrycount'=>$chemistrycount,'statisticscount'=>$statisticscount,'Constructioncount'=>$Constructioncount,'petscount'=>$petscount,'timedatecount'=>$timedatecount,'indexcount'=>$indexcount,'noindexcount'=>$noindexcount]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function pendingCalculators(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$is = 'Calculator';
			if ($request->getRequestUri()=='/admin/pending-converters' || $request->getRequestUri()=='/admin/pending-converters/') {
				$is = 'Converter';
			}elseif ($request->getRequestUri()=='/admin/pending-sub-converters' || $request->getRequestUri()=='/admin/pending-sub-converters/') {
				$is = 'Sub-Converter';
			}
			$get_cal = DB::table('calculators')->where('is_calculator',$is)->where('is_aprove',0)->select('add_by','cal_title','update_by','cal_id')->get();
			return view('admin/temp/pending-pages',['pages'=>$get_cal,'is'=> $is,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function subCalculators(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$is = 'Sub-Converter';
			if (isset($request->cal_cat)) {
				$get_cal = DB::table('calculators')->where('is_calculator','Sub-Converter')->where('cal_cat',$request->cal_cat)->select('parent','cal_title','is_calculator','cal_cat','cal_id')->get();
			}else{
				$get_cal = DB::table('calculators')->where('is_calculator','Sub-Converter')->select('parent','cal_title','is_calculator','cal_cat','cal_id')->get();
			}
			return view('admin/temp/sub-calculators',['pages'=>$get_cal,'is'=> $is,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function keys(Request $request){
    	if (isset($request->data)) {
    		$parent=$request->data;
    		$keys=DB::table('calculators')->where(['cal_title'=>$parent])->select('lang_keys')->first();
    		if ($keys) {
				$keys=$keys->lang_keys;
				print_r($keys);
				die();
    		}
    	}
    }

	public function media(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			if (isset($request->upload)) {
				// dd($request);
				if (!empty($_FILES['image']['name'])) {
					$img_name=$_FILES['image']['name'];
					$path=$_FILES['image']['tmp_name'];
					$dir='images/';
					$move=move_uploaded_file($path, $dir.$img_name);
					if ($move) {
						return back()->with('status',"Image uploded. Link=" .url('images/'.$img_name));
					} else {
						return back()->with('status',"Image not upload.");
					}
				}else{
					
					return back()->with('status',"Please select an image.");
				}
			}

			$folderPath = public_path('images');

			// Get all files in the folder
			$files = scandir($folderPath);
			return view('admin/temp/media',['files'=>$files,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}


	public function viewInput($file,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$dir = public_path("inputs/$file.txt");
			if (file_exists($dir)) {
				$json_data = file_get_contents($dir);
				$data_array = json_decode($json_data, true);
			} else {
				$data_array = [];
			}
			return view('admin/temp/all-inputs',['data_array'=>$data_array,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function categories(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			// $get_cats = DB::table('categories')->where('is_del', 0)->select('cat_id', 'cat_name', 'is_del', 'cat_time')->get();
			$get_cats = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->get();
			return view('admin/temp/all-categories',['cats'=>$get_cats,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function addCategory(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$get_cats = DB::table('categories')
    ->select('cat_id', 'cat_name', 'img', 'is_del', 'cat_time')
    ->get();

	if (isset($request->addCategory)) {
		if (isset($request->cat_name)) {
			// Set is_del based on checkbox input
			$is_del = isset($request->is_del) ? 1 : 0;

			// Prepare data array to insert
				$data = [
					'cat_name' => $request->cat_name,
					'is_del' => $is_del,
				];

				// Check if category name already exists
				$name_check = DB::table('categories')->where('cat_name', $request->cat_name)->first();
				if ($name_check) {
					return view('admin/temp/add-category', [
						'cats' => $get_cats,
						'LoginUser' => $this->LoginUser,
						'error' => "This Category Name is already taken."
					]);
				}

				// Check if image is uploaded
				if (!empty($_FILES['img']['name'])) {
					$img_name = $_FILES['img']['name'];
					$type = $_FILES['img']['type'];
					$path = $_FILES['img']['tmp_name'];
					$dir = 'images/category/';
					$exp = explode('/', $type);

					// Validate the file type (must be an image)
					if ($exp[0] != 'image') {
						return back()->with('status', "Only images can be uploaded.");
					}

					// Generate a unique filename to prevent overwriting
					$unique_name = time() . '_' . $img_name;
					$move = move_uploaded_file($path, $dir . $unique_name);

					// Check if the image was successfully uploaded
					if (!$move) {
						return back()->with('status', "Image not uploaded.");
					}

					// Add the image path to the data array
					$data['img'] = $unique_name;
				} else {
					// Set a default image name if no image is uploaded
					$data['img'] = 'null';
				}

				// Insert the category into the database
				$done = DB::table('categories')->insert($data);

				// Fetch the updated category list
				$get_cats = DB::table('categories')
					->select('cat_id', 'cat_name', 'img', 'is_del', 'cat_time')
					->get();

				// Return the appropriate view based on success or failure
				if ($done) {
					return view('admin/temp/add-category', [
						'cats' => $get_cats,
						'LoginUser' => $this->LoginUser,
						'status' => "Category added successfully."
					]);
				} else {
					return view('admin/temp/add-category', [
						'cats' => $get_cats,
						'LoginUser' => $this->LoginUser,
						'error' => "Something went wrong."
					]);
				}
			} else {
				// Return an error if the category name is not provided
				return view('admin/temp/add-category', [
					'cats' => $get_cats,
					'LoginUser' => $this->LoginUser,
					'error' => "Please enter a category name."
				]);
			}
		}
			
			return view('admin/temp/add-category', [
				'cats' => $get_cats,
				'LoginUser' => $this->LoginUser
			]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function editCategory($id, Request $request)
{
    setcookie("technical_calculator-last", $request->getRequestUri(), time() + 24 * 3600 * 10, "/");

    if (!empty($this->LoginUser)) {
        // Fetch category details
        $cat_detail = DB::table('categories')->where('cat_id', $id)->first();
        $get_cats = DB::table('categories')
            ->select('cat_id', 'cat_name', 'is_del', 'cat_time')
            ->get();

        // If the form is submitted to update the category
        if (isset($request->updateCategory)) {
            if (isset($request->cat_name)) {
                $is_del = isset($request->is_del) ? 1 : 0;

                // Prepare data for update
                $data = [
                    'cat_name' => $request->cat_name,
                    'is_del' => $is_del,
                ];

                // Check if a new image is uploaded
                if (!empty($_FILES['img']['name'])) {
					$img_name = $_FILES['img']['name'];
					$type = $_FILES['img']['type'];
					$path = $_FILES['img']['tmp_name'];
					$dir = 'images/category/';
					$exp = explode('/', $type);
				
					// Validate the file type (must be an image)
					if ($exp[0] != 'image') {
						return back()->with('status', "Only images can be uploaded.");
					}
				
					// Generate a unique filename to prevent overwriting
					$unique_name = time() . '_' . $img_name;
				
					// Check if the old image exists before attempting to delete it
					if ($cat_detail->img != 'null' && !empty($cat_detail->img)) {
						$old_image_path = $dir . $cat_detail->img;
				
						// Ensure the old image exists in the folder
						if (file_exists($old_image_path)) {
							unlink($old_image_path); // Delete old image from directory
						}
					}
				
					// Move the new image to the directory
					$move = move_uploaded_file($path, $dir . $unique_name);
				
					// Check if the new image was successfully uploaded
					if (!$move) {
						return back()->with('status', "Image not uploaded.");
					}
				
					// Add the new image path to the data array
					$data['img'] = $unique_name;
				}
				

                // Update the category in the database
                $done = DB::table('categories')
                    ->where('cat_id', $id)
                    ->update($data);

                // Fetch the updated category list and the details of the current category
                $get_cats = DB::table('categories')
                    ->select('cat_id', 'cat_name', 'is_del', 'cat_time')
                    ->get();
                $cat_detail = DB::table('categories')->where('cat_id', $id)->first();

                // Check if the update was successful and return the appropriate response
                if ($done) {
                    return view('admin/temp/edit-category', [
                        'cats' => $get_cats,
                        'cat_detail' => $cat_detail,
                        'LoginUser' => $this->LoginUser,
                        'status' => "Category updated successfully."
                    ]);
                } else {
                    return view('admin/temp/edit-category', [
                        'cats' => $get_cats,
                        'cat_detail' => $cat_detail,
                        'LoginUser' => $this->LoginUser,
                        'error' => "Something went wrong."
                    ]);
                }
            } else {
                // Return an error if the category name is not provided
                return view('admin/temp/edit-category', [
                    'cats' => $get_cats,
                    'cat_detail' => $cat_detail,
                    'LoginUser' => $this->LoginUser,
                    'error' => "Please enter category name."
                ]);
            }
        }

        // Show the edit category page with category details
        return view('admin/temp/edit-category', [
            'cats' => $get_cats,
            'cat_detail' => $cat_detail,
            'LoginUser' => $this->LoginUser
        ]);
    } else {
        // If the user is not logged in, redirect to the login page
        return redirect(url('admin/login/'));
    }
}


public function deleteCategory($id, Request $request)
{
    setcookie("technical_calculator-last", $request->getRequestUri(), time() + 24 * 3600 * 10, "/");

    if (!empty($this->LoginUser)) {
        // Retrieve the category details to get the image filename
        $cat_detail = DB::table('categories')->where('cat_id', $id)->first();

        // Check if the category has an associated image and delete it from the directory
        if ($cat_detail && $cat_detail->img != 'null' && !empty($cat_detail->img)) {
            $img_path = 'images/category/' . $cat_detail->img;
            // Ensure the image exists in the directory before attempting to delete it
            if (file_exists($img_path)) {
                unlink($img_path);  // Delete the image file from the directory
            }
        }

        // Delete the category from the database
        $done = DB::table('categories')
            ->where('cat_id', $id)
            ->delete();

        // Check if the deletion was successful
        if ($done) {
            return redirect()->back()->with('status', "Category deleted successfully.");
        } else {
            return redirect()->back()->with('error', "Something went wrong.");
        }
    } else {
        // Redirect to login page if the user is not logged in
        return redirect(url('admin/login/'));
    }
}



	public function subCategories(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {    
				$get_cats = DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent', 'cat_time')->get();
				// $get_cats = DB::table('categories')
				// ->select('categories.cat_id as main_cat_id', 'categories.cat_name', 'categories.is_del', 'categories.cat_time', 
				// 		'sub_categories.cat_id as sub_cat_id', 'sub_categories.cat_name as sub_cat_name', 
				// 		'sub_categories.cat_parent', 'sub_categories.cat_time as sub_cat_time')
				// ->leftJoin('sub_categories', 'categories.cat_id', '=', 'sub_categories.cat_parent')
				// ->get();
				// dd($get_cats);
			return view('admin/temp/sub-categories',['cats'=>$get_cats,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function addsubCategories(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$get_cats = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->get();
			if (isset($request->subCategory)) {
				if(isset($request->cat_name)){
					$data = [
						'cat_name' => $request->cat_name,
						'cat_parent'   => $request->cat_parent,
					];
					$name_check = DB::table('sub_categories')->where('cat_name',$request->cat_name)->first();
					if ($name_check) {
						return view('admin/temp/add-sub-category', [
							'cats' => $get_cats,
							'LoginUser' => $this->LoginUser,
							'error' => "This Sub Category Name is alreay takken."
						]);
					}
					$done = DB::table('sub_categories')->insert($data);
					if (isset($done)) {
						return view('admin/temp/add-sub-category', [
							'cats' => $get_cats,
							'LoginUser' => $this->LoginUser,
							'status' => "Category added successfully."
						]);
					} else {
						return view('admin/temp/add-sub-category', [
							'cats' => $get_cats,
							'LoginUser' => $this->LoginUser,
							'error' => "Something went wrong."
						]);
					}
				}else{
					return view('admin/temp/add-sub-category', [
						'cats' => $get_cats,
						'LoginUser' => $this->LoginUser,
						'error' => "Please eneter category name."
					]);
				}
				
			}
			return view('admin/temp/add-sub-category', [
				'cats' => $get_cats,
				'LoginUser' => $this->LoginUser
			]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function deleteSubCategory($id,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$done = DB::table('sub_categories')
			->where('cat_id', $id)
			->delete();
			if ($done) {
				return redirect()->back()->with('status', "Sub Category deleted successfully.");
			} else {
				return redirect()->back()->with('error', "Something went wrong.");
			}
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function editSubCategory($id,Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$cat_detail = DB::table('sub_categories')->where('cat_id',$id)->first();
			$get_cats = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->get();
			if (isset($request->updateCategory)) {
				if(isset($request->cat_name)){
					$data = [
						'cat_name' => $request->cat_name,
						'cat_parent'   => $request->cat_parent,
					];
					$done = DB::table('sub_categories')
					->where('cat_id', $id)
					->update($data);
					$get_cats = DB::table('categories')
                    ->select('cat_id', 'cat_name', 'is_del', 'cat_time')
                    ->get();
					$cat_detail = DB::table('sub_categories')->where('cat_id',$id)->first();
					if (isset($done)) {
						return view('admin/temp/edit-sub-category', [
							'cats' => $get_cats,
							'cat_detail' => $cat_detail,
							'LoginUser' => $this->LoginUser,
							'status' => "Category updated successfully."
						]);
					} else {
						return view('admin/temp/edit-sub-category', [
							'cats' => $get_cats,
							'cat_detail' => $cat_detail,
							'LoginUser' => $this->LoginUser,
							'error' => "Something went wrong."
						]);
					}
				}else{
					return view('admin/temp/edit-sub-category', [
						'cats' => $get_cats,
						'cat_detail' => $cat_detail,
						'LoginUser' => $this->LoginUser,
						'error' => "Please eneter category name."
					]);
				}
				
			}
			return view('admin/temp/edit-sub-category', [
				'cats' => $get_cats,
				'cat_detail' => $cat_detail,
				'LoginUser' => $this->LoginUser
			]);
		}else{
			return redirect(url('admin/login/'));
		}
	}

	public function searchsubcategory(Request $request){

		$cat_parentid = $request->cal_id;
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {

			$categories = DB::table('categories')->select('cat_id', 'cat_name', 'is_del', 'cat_time')->where('cat_id', $cat_parentid)->first();
			$get_cats = DB::table('sub_categories')->select('cat_id', 'cat_name', 'cat_parent')->where('cat_parent', $cat_parentid)->get();
			// dd($get_cats);
			return response()->json([
				'status' => 'success',
				'data' => $get_cats,
				'categoriesName' => $categories->cat_name
			]);
			
		}else{
			return response()->json([
				'status' => 'error',
				'message' => 'User not logged in'
			]);
		}

	}



}
