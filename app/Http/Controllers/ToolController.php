<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToolController extends Controller
{
    // Tire Size Calculator API
    public function chukeyaTire(Request $request){
        try{
            if($request->{'api-name'} === 'sizes' || $request->{'api-name'} === 'calcinfo'){
                // $r = $client->request('GET', "https://tiresize.com/includes/".$request->{'api-name'}.".txt");
                $url = "https://tiresize.com/includes/".$request->{'api-name'}.".txt";
                $response = Http::timeout(120)->get($url);
            }elseif($request->{'api-name'} === 'sizes2' || $request->{'api-name'} === 'sizes3'){
                $url = "https://tiresize.com/".$request->url;
                // $r = $client->request('GET', $url, [$url]);
                $response = Http::timeout(120)->get($url, [$url]);
            }
            $buffer = $response->body();
            // $buffer =  $r->getBody();
            return $buffer;
        }catch(\Exception $r){
            if(isset($_COOKIE['united-kindom'])){
                return $r->getMessage();
            }
        }
    }
}
