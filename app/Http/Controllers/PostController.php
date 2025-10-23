<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
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

    public function savePost($request,$id=null){
        if (is_null($id)) {
            $post_url=$request->post_url;
            $url_check = DB::table('posts')->where('post_url',$post_url)->first();
            if ($url_check) {
                return back()->with('status',"This url is alreay takken.");
            }
        }
        if (!empty($_FILES['post_img']['name'])) {
            $img_name=$_FILES['post_img']['name'];
            $type=$_FILES['post_img']['type'];
            $path=$_FILES['post_img']['tmp_name'];
            $dir='images/';
            $exp=explode('/', $type);
            if ($exp['0']!='image') {
                return back()->with('status',"Only Image can be uploded.");
            }
            $move=move_uploaded_file($path, $dir.$img_name);
            if (!$move) {
                return back()->with('status',"Image not uploded.");
            }
        }

        $show_hide=0;
		if (isset($request->show_hide)) {
			$show_hide=1;
		}
        // $related_cal=json_encode($_POST['related_cal']);
        $aprove=0;
        if (isset($request->aprove) && $this->LoginUser['role']=='1') {
            $aprove=1;
        }
        $author = [
            ["Aaron Lewis", "https://www.facebook.com/profile.php?id=100087131577064", "https://www.pinterest.com/Aaron_lewis73/","Aaron Lewis is an accomplished writer; He has done MS-Business Management and is a professional Research analyst and writer. He is too aggressive to write articles regarding Digital Marketing, Business, Health, and Mathematics. He is ready every time to collect information that can convey her experience on related topics.","aaron_lewis"],
            ["Jacquelin Smith", "https://www.facebook.com/profile.php?id=100087438732905", "https://www.pinterest.com/Jacquelin_smith45/","Jacquelin Smith is an accomplished writer and a Researcher; She has done MS(Computer Science) and doing content writing for since 2019. She is an ardent writer and expert in Niches like Digital Marketing, Social media, Mathematics, etc. She is an expert writer and commentator at the same time.","jacquelin_smith"],
            ["Shelby Steve", "https://www.facebook.com/profile.php?id=100087550837444", "https://www.pinterest.com/Shelby_Steve95/","Shelby Steve is a skillful writer and an Engineer; He has taken a degree in Electrical Engineering and is a professional Research analyst and writer. He is a passionate writer and expert in Niches like Mathematics, Physics, Chemistry, etc. He is an expert in communicating his point of view in the most descriptive manner.","shelby_steve"]
        ];
        $rand_author = array_rand($author);
        $author_details = json_encode($author[$rand_author]);
        $add_by=$this->LoginUser['admin_name'];
        $update_by=$this->LoginUser['admin_name'];

        $data = array (
            "post_title" => htmlspecialchars($request->title , ENT_QUOTES),
            "post_des" => $request->des,
            "post_cat" => $request->cat,
            "post_url" => $request->post_url,
            "meta_title" => $request->meta_title,
            "short_des" => $request->short_des,
            // "related_cal" => $related_cal,
			'show_hide'=> $show_hide,
            "meta_des" => $request->meta_des,
            'is_aprove' => $aprove,
            'add_by' => $add_by,
            'update_by' => $update_by,
            'author_details' => $author_details,
        );
        if (isset($img_name)) {
            $data['post_img'] = $img_name;
        }
        if (isset($request->knowledge)) {
            $data['knowledge']=1;
        }
        if (!is_null($id)) {
            $done = DB::table('posts')->where('post_id',$id)->update($data);
            $add = 'update';
        }else{
            $done = DB::table('posts')->insert($data);
            $add = 'add';
        }
        if($done){
            if ($aprove===1) {
                return back()->with('status',"Post $add Successfully.");
            }else{
                return back()->with('status',"Post $add Successfully and Goes Pending.");
            }
        }else{
            return back()->with('status',"<strong>Error!</strong> in post adding");
        }
    }

    public function addPost(Request $request){
        setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
        if (!empty($this->LoginUser)) {
            if (isset($request->add_post)) {
				$data = $request->validate([
					'title' => 'required',
					'post_url' => 'required',
					'des' => 'required',
					'short_des' => 'required',
					'cat' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
					'post_img' => 'required',
				]);

				$this->savePost($request);
			}
            $calculators = DB::table('calculators')->where('is_calculator','Calculator')->select('cal_title','cal_link','cal_cat','cal_link','cal_img')->get();
			return view('admin/temp/add-post',['calculators'=>$calculators,'LoginUser'=>$this->LoginUser]);
        }else{
            return redirect(url('admin/login/'));
        }
    }

    public function editPost($id,Request $request){
        setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
        if (!empty($this->LoginUser)) {
            if (isset($request->add_post)) {
				$data = $request->validate([
					'title' => 'required',
					'post_url' => 'required',
					'des' => 'required',
					'short_des' => 'required',
					'cat' => 'required',
					'meta_title' => 'required',
					'meta_des' => 'required',
				]);

				$this->savePost($request,$id);
			}
            $post = DB::table('posts')->where('post_id',$id)->first();
            $calculators = DB::table('calculators')->where('is_calculator','Calculator')->select('cal_title','cal_link','cal_cat','cal_link','cal_img')->get();
			return view('admin/temp/edit-post',['calculators'=>$calculators,'LoginUser'=>$this->LoginUser,'post'=>$post]);
        }else{
            return redirect(url('admin/login/'));
        }
    }

    public function posts(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$posts = DB::table('posts')->where('is_del',0)->where('is_aprove',1)->orderBy('post_id','DESC')->get();
			return view('admin/temp/posts',['posts'=>$posts,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}
    public function pending(Request $request){
		setcookie("technical_calculator-last" , $request->getRequestUri(), time()+24*3600*10 ,"/");
		if (!empty($this->LoginUser)) {
			$posts = DB::table('posts')->where('is_del',0)->where('is_aprove',0)->orderBy('post_id','DESC')->get();
			return view('admin/temp/posts',['posts'=>$posts,'LoginUser'=>$this->LoginUser]);
		}else{
			return redirect(url('admin/login/'));
		}
	}
    public function deletePost($id){
        if (!empty($this->LoginUser)) {
			$posts = DB::table('posts')->where('post_id',$id)->update(['is_del'=>1]);
			return back()->with('status',"Post Delete Successfully.");
		}else{
			return redirect(url('admin/login/'));
		}
    }
    
}
