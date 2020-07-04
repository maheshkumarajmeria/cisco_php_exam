<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\CiscoRouterModel;
use App\AuthToken;
use Illuminate\Support\Str;
class APIRouterController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; 
    public function __construct(){
    	  // parent::__construct();
    	$this->RouterObj = new App\CiscoRouterModel;
    	$token = Str::random(60);
    	$this->AuthToken = new use App\AuthToken;
    	$this->AuthToken->token = $token;
    	$this->startTime = date('Y-m-d H:i:s');
    	$this->tokenAuthLimitInMins = 60;
    	$this->tokenAuthLimitInMins->save();
    }
    public function listRouterBySapid(new Request $request){
    	$data = $request->all();
    	$sapid = $data['sapid'];
    	$tokenDetails = AuthToken::get()->latest();

    	return ['token' => $token];
    }
    public function listRouterByIpRanges(){
    	return ['token' => $token];
    }
    public function deleteRouterByIp(){
    	return ['token' => $token];
    }
    public function AddRouter()){
	return ['token' => $token];
    }
    public function UpdateRouter()){
		return ['token' => $token];    	
    }
}
