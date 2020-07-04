<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\CiscoRouterModel;
use Illuminate\Support\Facades\Validator;

class RouterController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
    	  // parent::__construct();
    	$this->RouterObj = new App\CiscoRouterModel;
    }
    public function list(){
    	$result = $this->RouterObj->listRouter();

    	return view('router_details')->with(["result"=>$result]);
    }
    public function post_list(Request $request){
    	$data = $request->all();
    	$action = $data['action'];
    	$respdata = ["status"=>true,"value"=>"","msg"=>""];
    	
    	if(!empty($action)){
    		$action = strtolower($action);
    		switch($action){
    			case 'add':
    			  $valStatus = $this->validateData($data);

                  if($valStatus->fails()){

                  	 $respdata['value'] = $valStatus->errors();
                  }else{

                  	$result = $this->RouterObj->InsertRouter($data);

                  	$respdata['msg'] = "Insert Successfull";
                  	if(!$result){
                  		$respdata['msg'] = "Insert UnSuccessfull";
                  	}
              	  }
    			  break;
    			case 'edit':
    				$valStatus = $this->validateData($data);
                     if($valStatus->fails()){
                  	 $respdata['value'] = $valStatus->errors();
                  }else{

                  	 $result = $this->RouterObj->updateRouter($data);
                  	$respdata['msg'] = "Update Successfull";
                  	if(!$result){
                  		$respdata['msg'] = "Update UnSuccessfull";
                  	}
              	  }
    			  
    			   break;
    			case 'delete':
    			   $result = $this->RouterObj->deleteRouter($data);
    			   $respdata['msg'] = "Delete Successfull";
                  	if(!$result){
                  		$respdata['msg'] = "Delete UnSuccessfull";
                  	}
    			   break;
    		}
    	}
    	echo json_encode($respdata);

    }
    public function validateData($data){
    	 $requiredField = array(
            'Sapid' => 'required|string|max:18',
            'Hostname' =>  'required|string|max:14',
            'LoopBack' =>  'required|ipv4',
            'Mac_Address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/');
             
        $validator = Validator::make($data, $requiredField);
        return $validator;
    }
}
