<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Router Details</title>

        <!-- Fonts -->
            <meta charset="utf-8">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
             <!-- <script src="{{ URL::asset('js/cisco_routers.js')}}"></script> -->

  
    </head>
    <body>
        <div class="container">
             @if ($errors->any())
   <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
   </div>
   @endif
   @if(session('message'))
       <div class="container-fluid">
          <div class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('message') }}
          </div>
       </div>
   @endif
            <div class="row">
                <div class="col-md-12">
                    <h3>Router Details</h3>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <button id="add" class="btn btn-success" data-toggle="modal" style="margin-bottom: 10px;" data-target="#routeradd">Add</button>
                    <div class="modal fade" id="routeradd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Router</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                     <form id="addrouter">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Sapid:</label>
                                            <input type="text" class="form-control" name="Sapid" id="Sapid">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Host Name:</label>
                                            <input type="text" class="form-control" name="Hostname" id="Hostname">
                                        </div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">LoopBack:</label>
                                            <input type="text" class="form-control" name="LoopBack" id="LoopBack">
                                        </div>
                                        <input type="hidden" name="action" value="add"/>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Mac Address:</label>
                                            <input type="text" class="form-control" name="Mac_Address" id="Mac_Address">
                                        </div>
                                    </form>
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="router_opt(this,'ADD');">Add Router</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                
                <div class="col-md-12">
                    <table id="cisco_router" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sapid</th>
                            <th>Hostname</th>
                            <th>LoopBack</th>
                            <th>Mac_Address</th>
                            <th>Action</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($result))
                            @foreach($result as $key=>$val)
                                <tr>
                                    <td>{{$val->Sapid}}</td>
                                    <td>{{$val->Hostname}}</td>
                                    <td>{{$val->LoopBack}}</td>
                                    <td>{{$val->Mac_Address}}</td>
                                    <td><button id="edit" class="btn btn-success" data-toggle="modal" data-target="#router-{{$val->id}}" style="margin-right: 2%;">Edit</button><button id="{{$val->id}}" class="btn btn-primary" onclick="router_opt(this,'DELETE');" id="delete" lass="btn btn-warning">Delete</button></td>
                                </tr>
                                <div class="modal fade" id="router-{{$val->id}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit $val->Sapid</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editrouter_{{$val->id}}">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Sapid:</label>
                                                        <input type="text" class="form-control" name="Sapid" id="Sapid" value="{{$val->Sapid}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Host Name:</label>
                                                        <input type="text" value="{{$val->Hostname}}" class="form-control" name="Hostname" id="Hostname">
                                                    </div>
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                    <input type="hidden" name="id" id="id" value="{{ $val->id}}" />
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">LoopBack:</label>
                                                        <input type="text" value="{{$val->LoopBack}}" class="form-control" name="LoopBack" id="LoopBack">
                                                    </div>
                                                    <input type="hidden" name="action" value="edit"/>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Mac Address:</label>
                                                        <input type="text" value="{{$val->Mac_Address}}" class="form-control" name="Mac_Address" id="Mac_Address">
                                                    </div>
                                                </form>
                                            </div>
                                          <div class="modal-footer">
                                            <button type="button" id="edit-{{$val->id}}" class="btn btn-primary" onclick="router_opt(this,'EDIT');">Update Changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sapid</th>
                            <th>Hostname</th>
                            <th>LoopBack</th>
                            <th>Mac_Address</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
    </div>
</body>
           <script>
            var router_opt;

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#cisco_router").DataTable();
            var AppUrl = window.location.origin+'/'+window.location.pathname.split('/')[1];
            router_opt = function(obj,action){
                var id = $(obj).attr("id");
                var formId = "addrouter";
                 var data={"id":id,"action":"delete"};
                if(action.toLowerCase()=='edit'){
                var idArr = id.split('-');
                formId = "editrouter_"+idArr[1];
                data = $("#"+formId).serialize();
               }else if(action.toLowerCase()=='add'){
                  data = $("#"+formId).serialize();
               }
                $.ajax({
                    url:AppUrl+'/router/post_list',
                    data:data,
                    type:'POST',
                    success:function(res){
                        var res = JSON.parse(res);
                       if(res.status){
                          location.reload();
                       }
                    },
                    error:function(){

                    }
                })

            }
        })
    </script>
</html>
