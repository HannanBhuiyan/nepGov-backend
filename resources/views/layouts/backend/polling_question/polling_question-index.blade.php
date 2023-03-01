@extends('layouts.backend.backend-app')

@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        .close_btn{
            width: 120px;
            position: absolute;
            bottom: -10px;
            right: 20px;
        }
    </style>
@endsection


@section('content')
    <div class="row mt-5">
        <div class="col-md-12 m-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Questions</li>
                </ol>
            </nav>
            <div class="card p-3 mt-4">
                <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                    <h3>Questions List</h3>
                </div>
                <div class="right">
                    @can('live question create')
                    <a class="btn btn-primary" href="{{ route('polling_question.create') }}">Add New Questions</a>
                    @endcan
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                        <thead>
                        <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Question</th>
                            <th scope="col">Option</th>
                            <th scope="col"> Voting Percentage</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $question->question }}</td>
                                <td>
                                    <ul>
                                        @foreach ($question->poll_options as $item)
                                            <li>{{$item->option}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($question->poll_options as $item)
                                            @foreach ($sss as $it)
                                                @foreach ($it['optionsData'] as $i)
                                                    @if ($i->polling_option_id == $item->id)
                                                        <li>{{$item->option}} - <span  class="badge badge-light">{{  round(($i->count/ $it['totalCount'])* 100, 2)}}%</span> </li>
                                                    @endif
                                                @endforeach 
                                            @endforeach 
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @can('live question edit')
                                    <a href="{{ route('polling_question.edit', $question->id) }}" class="btn btn-success">Edit</a>
                                    @endcan
                                    @can('live question delete')
                                    <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$question->id}}">Delete</a>
                                    @endcan
                                </td>
                            </tr>

                            <!-- MODAL EDIT EFFECTS -->
                            <div class="modal fade" id="modaledit__{{$question->id}}">
                                <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row mt-5">
                                                <div class="col-md-12 m-auto">
                                                    <div class="card p-3 mt-4"> 
                                                        <div class="category_title my-3">
                                                            <h3>Edit Sub Category</h3>
                                                        </div>
                                                        <form action="{{ route('polling_question.update',$question->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method("PUT")
                                                            <div class="form-group">
                                                                <label>Polling SubCategory<span class="text-danger">*</span></label>
                                                                <select name="sub_category_id" class="form-control">
                                                                    @foreach ($sub_category as $cat)
                                                                        <option value="{{$cat->id}}" {{$cat->id==$question->sub_category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                                    @endforeach  
                                                                </select>
                                                                @error('sub_category_id')
                                                                    <span class="text-danger mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                            
                                                            <div class="form-group">
                                                                <label> Question <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="question" value="{{$question->question}}" name="question" placeholder="Question">
                                                                @error('question')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            @php
                                                                $que_opt = App\Models\QuestionOption::where('question_id', $question->id)->get();
                                                            @endphp
                                            
                                                            <div class="form-group">
                                                                <label> Options <span class="text-danger">*</span></label>
                                                                @foreach ($que_opt as $item)
                                                                <div class="row new_properties">
                                                                    <div class="col-10">
                                                                        <input type="text" class="form-control mb-1" value="{{$item->option}}" name="option[]" placeholder="">
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <button type="button" class="close remove--new_properties">
                                                                            <span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                <div class="properties-container"></div>
                                                                <div class="btn btn-info mt-1 add_more" id="add_more">Add More</div>
                                                            </div>
                                            
                                                            <div class="form-group">
                                                                <input type="submit" class="form-control btn btn-primary" value="Edit Question">
                                                            </div>
                                                            
                                                            <a class="close_btn btn btn-secondary" data-dismiss="modal">Close</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- MODAL delete EFFECTS -->
                            <div class="modal fade" id="modaldemo8__{{$question->id}}">
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
                                                    <a href="{{ route('polling_question.delete', $question->id) }}" class="btn btn-danger">Delete</a>
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
    {{-- <a href="{{route('download')}}">download</a> --}}
    
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.add_more').click(function (){
                // alert('hi');
                let new_properties_html =
                `<div class="row new_properties">
                    <div class="col-10">
                        <input type="text" name="option[]" class="form-control mb-1">
                    </div>
                    <div class="col-2">
                    <button type="button" class="close remove--new_properties">
                        <span>&times;</span>
                    </button>
                    </div>
                </div>`;
                $('.properties-container').append(new_properties_html);
            });
            $(document).on('click', '.remove--new_properties', function(){
                $(this).closest(".new_properties").remove();
            });
            
        });
    </script>
@endsection
