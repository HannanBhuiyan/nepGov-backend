@extends('layouts.backend.backend-app')

@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .close_btn{
            width: 120px;
            position: absolute;
            bottom: 10px;
            right: 20px;
        }
    </style>
@endsection

@section('content')
<!-- Modal Add Question-->
<div class="modal fade" id="addquestionmodal_01"  aria-labelledby="addquestionmodal_01" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content pb-5">
            <div class="modal-header">
                <h5 class="modal-title">Add Question</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('survay_question.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Survay Question <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="survay_question" name="survay_question" placeholder="Survay Question">
                        @error('survay_question')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label> Question Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Category Slug">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3 mb-3" class="specific_country">
                        <label> Answer Type <span class="text-danger">*</span></label>
                        <select class="answer_dropdown form-control" name="answer_type" data-flag="true" placeholder="C">
                            <option value disabled selected>--Select Answer Type--</option>
                            <option class="textType" value="text">Text</option>
                            <option class="booleanType" value="boolean">Boolean</option>
                            <option class="selectType" value="select">Select</option>
                        </select>
                    </div>
    
                    <div class="form-group selType">
                        <label> Options <span class="text-danger">*</span></label>
                        {{-- <div class="row new_properties mb-1">
                            <div class="col-10">
                                <input type="text" class="form-control" name="options[]" placeholder="">
                            </div>
                            <div class="col-2">
                                <button type="button" class="close remove--new_properties">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div> --}}
                        <div class="properties-container"></div>
                        <div class="btn btn-info mt-1" id="add_more">Add Option</div>
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="Save Question">
                    </div>
                </form>
            </div>
            <a href="" class="close_btn btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
    </div>
</div> 

<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Servay Question</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3 d-flex justify-content-between">
               <div class="left">
                    <h3>Questions List</h3>
               </div>
               <div class="right">
                <a class="btn btn-primary" href="" data-toggle="modal" data-target="#addquestionmodal_01">Add Question</a>
           </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap text-center border-bottom" id="basic-datatable">
                    <thead>
                        <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Questions</th>
                            <th scope="col">Answer Type</th>
                            <th scope="col">options</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($survay_questions as $survay)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $survay->survay_question ?? '' }}</td>
                            <td>
                                @php
                                    $sur_ans_type = App\Models\SurvayOption::where('survay_question_id',$survay->id)->first()
                                @endphp
                                {{ Str::headline($sur_ans_type->answer_type ?? '') }}    
                            </td>
                            <td>
                                <ul>
                                    @php
                                    $sur_ans = App\Models\SurvayOption::where('survay_question_id', $survay->id)->first();
                                    @endphp
                                    @if ($sur_ans->options)
                                        @foreach (json_decode($sur_ans->options) as $item)
                                            <li>{{$item ?? ''}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaledit__{{$survay->id}}">Edit</a>
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$survay->id}}">Delete</a>
                            </td>
                        </tr>
                        @push('modals')
                        <!--Edit MODAL EFFECTS -->
                        <div class="modal fade" id="modaledit__{{$survay->id}}">
                            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="card-body text-center">
                                        <form action="{{ route('survay_question.update', $survay->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method("PUT")
                                            <div class="form-group">
                                                <label> <h5>Survay Question <span class="text-danger">*</span></h5> </label>
                                                <input type="text" value="{{$survay->survay_question}}" class="form-control" id="survay_question" name="survay_question" placeholder="Survay Questionn">
                                                @error('category_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                            
                                            <div class="form-group mb-2">
                                                <input type="submit" class="form-control btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$survay->id}}" value="Edit Survay Question">
                                            </div>
                                        </form>
                                        <a href="" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Delete MODAL EFFECTS -->
                        <div class="modal fade" id="modaldemo8__{{$survay->id}}">
                            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="card-body text-center">
                                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24">
                                        <path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                        <h4 class="h4 mb-0 mt-3">Warning</h4>
                                            <p class="card-text">Are you sure you want to delete data?</p>
                                            <strong class="card-text text-red">Once deleted, you will not be able to recover this data!</strong>
                                    </div>
                                    <div class="card-footer text-center border-0 pt-0">
                                        <div class="row">
                                            <div class="text-center">
                                                <a href="javascript:void(0)" class="btn btn-white me-2" data-bs-dismiss="modal">Cancel</a>
                                                <a href="{{ route('survay_question.delete', $survay->id) }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endpush
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>


@endsection

@section('scripts')
    <script type="text/javascript"> 

        const survay_question = document.querySelector("#survay_question")
        const slug = document.querySelector("#slug")
        
        survay_question.addEventListener('keyup', function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
        }) 

        // answer dropdown
        $(document).ready(function(){ 

            $('.answer_dropdown').select2({
                width: '100%',
                placeholder: "Select",
                allowClear: false
            });

        });

        $(document).ready(function(){
            $('.selType').hide();
            $('.answer_dropdown').change(function(){
                let valu = $(this).val()
                if(valu == 'select'){
                    $('.selType').show();
                }else{
                    $('.selType').hide();
                }
            }); 
             
        });

        $(document).ready(function () {
            $('#add_more').click(function (){
                // alert('hi');
                let new_properties_html =
                `<div class="row new_properties">
                    <div class="col-10">
                        <input type="text" name="options[]" class="form-control mb-1">
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
 
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
@endsection
