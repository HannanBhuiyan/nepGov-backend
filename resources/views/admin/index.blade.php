@extends('layouts.backend.backend-app')
<style>
    .close_btn{
        width: 120px;
        position: absolute;
        bottom: 10px;
        right: 20px;
    }
</style>
@section('content')

<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">

        </nav>

            <div class="card p-3 mt-4"> 
                <div class="category_title my-3 d-flex justify-content-between">
                   <div class="left">
                        <h3>Assignee List</h3>
                        <div id="down_btn"></div>
                   </div>
                   <div class="right">
                    @can('assign role to users')
                    <a class="btn btn-info" href="{{route('create_admin')}}">Admin Create</a>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#addusermodal_01">Assign Role to Users</a>
                    @endcan
                  </div>
                </div>
                <table class="text-center table table-bordered text-nowrap border-bottom" id="" >
                    <thead>
                      <tr>
                        <th scope="col">SL NO</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @php
                            $user_roles_exists = DB::table('model_has_roles')->where('model_id',$user->id)->exists();
                            $user_roles = DB::table('model_has_roles')->where('model_id',$user->id)->get();
                        @endphp
                        @if ($user->id !=1)
                        <tr>
                            <td>{{ $loop->index  }}</td>
                            <td >{{ $user->username ?? 'N/A' }}</td>
                            <td >{{ $user->email ?? 'N/A' }}</td>
                            <td>
                                @if($user_roles_exists)
                                    @foreach ($user_roles as $data)
                                    @php
                                        $role_name = Spatie\Permission\Models\Role::find($data->role_id);
                                    @endphp
                                        <ul>{{$role_name->name ?? ''}}{{ $loop->last?'':',' }}</ul>
                                    @endforeach                  
                                @endif
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#modaledit8__{{$user->id}}" class="btn btn-info">Edit</a>
                                @can('user delete')
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$user->id}}">Delete</a>
                                @endcan
                            </td>
                        </tr> 
                        @endif

                        <!-- Modal edit user-->
                        <div class="modal fade" id="modaledit8__{{$user->id}}"  aria-labelledby="modaledit8__{{$user->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content pb-5">
                                    
                                    <div class="modal-body">
                                        <form action="{{ route('user_assign.update',$user->id) }}" method="post">
                                            @csrf
                                            
                                            <div class="form-group">
                                                <h4>Role:-</h4>
                                                    @php
                                                         $user_roles = DB::table("model_has_roles")->where("model_has_roles.model_id",$user->id)->pluck('model_has_roles.role_id')->all();
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        <input type="checkbox" {{ in_array($role->id, $user_roles) ? 'checked' : '' }} name="role[]" value="{{ $role->name }}" multiple>
                                                        <label>{{ $role->name }} </label> <br>
                                                    @endforeach    
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="submit" class="form-control btn btn-primary" value="Update assign">
                                            </div>
                                        </form>
                                    </div>
                                    <a class="close_btn btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
    
                        <!-- MODAL DELETE EFFECTS -->
                        <div class="modal fade" id="modaldemo8__{{$user->id}}">
                          <div class="modal-dialog modal-dialog-centered text-center" role="document">
                              <div class="modal-content modal-content-demo">
                                  <div class="card-body text-center">
                                      <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24"><path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                      <h4 class="h4 mb-0 mt-3">Warning</h4>
                                      <p class="card-text">Are you sure you want to delete data?</p>
                                      <strong class="card-text text-red">Once deleted, you will not be able to recover this data!</strong>
                                  </div>
                                  <div class="card-footer text-center border-0 pt-0">
                                      <div class="row">
                                          <div class="text-center">
                                              <a href="javascript:void(0)" class="btn btn-white me-2" data-bs-dismiss="modal">Cancel</a>
                                              <a href="{{ route('user_admin.delete', $user->id) }}" class="btn btn-danger">Delete</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

    </div>
</div>

    <!-- Modal Add user assign role-->
    <div class="modal fade" id="addusermodal_01"  aria-labelledby="addusermodal_01" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-5">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Role</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user_admin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <h4>Role</h4>
                            @foreach ($roles as $role)
                                <input type="checkbox" id="role__{{ $role->id }}" name="role[]" value="{{ $role->name }}">
                                <label for="role__{{ $role->id }}" style="cursor: pointer">{{ $role->name }} </label> <br>
                            @endforeach    
                        </div>

                        <div class="form-group">
                            <h4>Users</h4>
                            <table class="text-center table table-bordered text-nowrap border-bottom" id="basic-datatable" >
                                <thead>
                                  <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">UserName</th>
                                    <th scope="col">Email</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_users as $user)
                                    <tr>
                                        <td><input id="userCheck-{{$user->id}}" type="radio" name="email" value="{{ $user->email }}"></td>
                                        <td ><label for="userCheck-{{$user->id}}" style="cursor: pointer">{{ $user->username ?? 'N/A' }}</label></td>
                                        <td><label for="userCheck-{{$user->id}}" style="cursor: pointer">{{ $user->email ?? '' }}</label></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>    
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Assign">
                        </div>
                    </form>
                </div>
                <a href="" class="close_btn btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>   
@endsection
