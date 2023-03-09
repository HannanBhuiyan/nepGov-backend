@extends('layouts.backend.backend-app')

@section('content')
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Pages</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3 d-flex justify-content-between">
               <div class="left">
                    <h3>Pages List</h3>
               </div>
               <div class="right">
                @can('page create')
                <a class="btn btn-primary" href="{{ route('page.create') }}">Add New Page</a>
                @endcan
               </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                    <thead>
                    <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Page Title</th>
                        {{-- <th scope="col">Slug</th> --}}
                        <th scope="col">Placement</th>
                        {{-- <th scope="col">Description</th> --}}
                        <th scope="col">View Count</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $pages)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $pages->page_title ?? '' }}</td>
                            {{-- <td>{{ $pages->slug ?? '' }}</td> --}}
                            <td>{{ $pages->placement ?? '' }}</td>
                            {{-- <td>{!! substr($pages->description,0,200) ?? '' !!}</td> --}}
                            <td>{{ $pages->view_count ?? '0' }}</td>
                            <td>
                                @can('page edit')
                                <a href="{{ route('page.edit', $pages->id) }}" class="btn btn-success">Edit</a>
                                @endcan
                                @can('page view')
                                <a href="{{ route('page.show', $pages->id) }}" class="btn btn-info">View</a>
                                @endcan
                                @can('page delete')
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$pages->id}}">Delete</a>
                                @endcan
                            </td>
                        </tr>

                        <!-- MODAL EFFECTS -->
                        <div class="modal fade" id="modaldemo8__{{$pages->id}}">
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
                                                <a href="{{ route('page.delete', $pages->id) }}" class="btn btn-danger">Delete</a>
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
</div>

@endsection


