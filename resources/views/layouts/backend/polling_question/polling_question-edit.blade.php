@extends('layouts.backend.backend-app')

@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('polling_question.index')}}">Question</a></li>
              <li class="breadcrumb-item"><a href="{{route('polling_question.create')}}">Add Question</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Question</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Edit Question</h3>
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
                    <input type="hidden" class="form-control" id="question_id" value="{{$question->id}}" name="question_id" placeholder="Question">
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
                            <input type="text" class="form-control mb-1 delete_option" value="{{$item->option}}" name="option[]" placeholder="">
                        </div>
                        <div class="col-2">
                            <button type="button" class="close remove--new_properties">
                                <span class="option_delete" data-id="{{ $item->id }}" >&times;</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    <div class="properties-container"></div>
                    <div class="btn btn-info mt-1" id="add_more">Add More</div>
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Edit Question">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<script>
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $(document).ready(function () {

        $(".option_delete").click(function(){
            let id = $(this).attr('data-id');
             
            $.ajax({
                type: "get",
                url: "/questionOption/delete"+'/'+id,
                success: function (data) {
                    console.log(data)
                },
                error: function (data) {
                    console.log('Error:', data);
            }
            })
        })


        $('#add_more').click(function (){
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
            // let vl = $('.delete_option').val()
            // alert(vl)
            $(this).closest(".new_properties").remove();
        });
        
    });
</script>
@endsection
