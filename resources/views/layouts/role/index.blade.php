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
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Roles</li>  
            </ol>
        </nav>

            <div class="card p-3 mt-4"> 
                <div class="category_title my-3 d-flex justify-content-between">
                   <div class="left">
                        <h3>Role</h3>
                   </div>
                   <div class="right">
                    @can('role permission create')
                    <a class="btn btn-primary" data-toggle="modal" data-target="#addrolemodal_01">Add Role & Permission</a>
                    @endcan
                  </div>
                </div>
                <table class="text-center table table-bordered text-nowrap border-bottom" id="basic-datatable" >
                    <thead>
                      <tr>
                        <th scope="col">SL NO</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td >{{ $role->name ?? 'N/A' }}</td>
                            <td>
                                @can('permission edit',)
                                <a data-bs-toggle="modal" data-bs-target="#modaledit8__{{$role->id}}" class="btn btn-success">Edit Permission</a>
                                @endcan
                                
                                @can('role delete')
                                    @if ($role->id != 1)
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$role->id}}">Delete</a>
                                    @endif
                                @endcan
                            </td>
                        </tr> 

                        <!-- Modal edit role assign -->
                        <div class="modal fade" id="modaledit8__{{$role->id}}"  aria-labelledby="modaledit8__{{$role->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content pb-5">
                                    
                                    <div class="modal-body">
                                        <form action="{{ route('user_role.update',$role->id) }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label> Role:- </label>
                                                <h3>{{$role->name}}</h3>
                                                <input type="hidden" class="form-control" id="name" name="name" value="{{$role->name}}" placeholder="Role">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <h4>Permissions:-</h4>
                                                    @php
                                                        $role_permissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)->pluck('role_has_permissions.permission_id')->all();
                                                    @endphp
                                                    <input class="" type="checkbox" id="flexSwitchCheckDefault" onchange="checkAll(this)">
                                                    <label class="" for="flexSwitchCheckDefault"><h4>Select All</h4></label><br>
                                                    @foreach ($permissions as $permission)
                                                        <input id="perm__{{$role->id}}-{{$permission->id}}" class="inner-checkbox" type="checkbox" {{ in_array($permission->id, $role_permissions) ? 'checked' : '' }} name="permission[]" value="{{ $permission->name }}" multiple>
                                                        <label for="perm__{{$role->id}}-{{$permission->id}}" style="cursor: pointer">{{ $permission->name }} </label> <br>
                                                    @endforeach    
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="submit" class="form-control btn btn-primary" value="Update Permission">
                                            </div>
                                        </form>
                                    </div>
                                    <a class="close_btn btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL DELETE EFFECTS -->
                        <div class="modal fade" id="modaldemo8__{{$role->id}}">
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
                                              <a href="{{ route('user_role.delete', $role->id) }}" class="btn btn-danger">Delete</a>
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


    <!-- Modal Add role-->
    <div class="modal fade" id="addrolemodal_01"  aria-labelledby="addrolemodal_01" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-5">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user_role.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
        
                        <div class="form-group">
                            <label> <h3>Role<span class="text-danger">*</span></h3> </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Role">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h3>Permission <span class="text-danger">*</span></h3>
                            <input class="" type="checkbox" id="flexSwitchCheckDefault" onchange="checkAll(this)">
                            <label class="" for="flexSwitchCheckDefault"><h4>Select All</h4></label><br>
                            @foreach ($permissions as $permission)
                            <input class="inner-checkbox" id="perm__{{$permission->id}}" type="checkbox" name="permission[]" value="{{ $permission->name }}">
                            <label for="perm__{{$permission->id}}" style="cursor: pointer">{{ $permission->name }} </label> <br>
                            @endforeach    
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Save Role">
                        </div>
                    </form>
                </div>
                <a class="close_btn btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<script>
    function checkAll(myCheckbox){
    var checkboxes = document.querySelectorAll(".inner-checkbox");
    
        if(myCheckbox.checked){
            checkboxes.forEach(function(checkbox){
                checkbox.checked = true;
            });
        }
        else{
            checkboxes.forEach(function(checkbox){
                checkbox.checked = false;
            });
        }
    }
</script>

    
@endsection
