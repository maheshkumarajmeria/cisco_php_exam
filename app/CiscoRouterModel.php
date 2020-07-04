<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CiscoRouterModel extends Model
{
    
    use SoftDeletes; //add this line

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Sapid', 'Hostname', 'LoopBack','Mac_Address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'router_details';
    public function InsertRouter($data){
        $router = new CiscoRouterModel;
        $router->Sapid = $data['Sapid'];
        $router->Hostname = $data['Hostname'];
        $router->LoopBack = $data['LoopBack'];
        $router->Mac_Address = $data['Mac_Address'];
        $router->save();
        return true;

    }
    public function updateRouter($data){
        $status = true;
        if(!empty($data['id']) && $data['id']>0){
             $id= $data['id'];
            unset($data['id']);
            unset($data['_token']);
            unset($data['action']);
            $status = CiscoRouterModel::where("id",$id)->update($data);
        }
        return $status;
    }
    public function listRouter(){
        $data = null;
        $data = CiscoRouterModel::get();

        return $data;
    }
    public function deleteRouter($data){
        $status = true;
        if(!empty($data['id']) && $data['id']>0){
            $status = CiscoRouterModel::where("id",$data['id'])->delete();
        }

        return $status;
    }
}
