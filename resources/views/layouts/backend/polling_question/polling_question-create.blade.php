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
              <li class="breadcrumb-item active" aria-current="page">Add Question</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add New Question</h3>
            </div>
            <form action="{{ route('polling_question.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Polling Category<span class="text-danger">*</span>(If no Category <a href="{{route('polling_category.create')}}">Create Category</a> Here:)</label>
                    <select name="polling_category_id" id="poll_cat" class="form-control">
                        <option selected value>--Selece One--</option>
                        @foreach ($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                        @endforeach  
                    </select>
                    @error('polling_category_id')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Sub Category<span class="text-danger">*</span>(If no Sub Category <a href="{{route('polling_sub_cat.create')}}">Create Sub Category</a> Here:)</label>
                    <select name="sub_category_id" class="form-control" id="sub_cat_dropdown">
                        <option value>--Selece One--</option>
                    </select>
                    @error('sub_category_id')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Question <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="question" name="question" placeholder="Question">
                    @error('question')
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

                {{-- <!-- Button trigger modal -->
                <div>
                    <button type="button" class="btn btn-dark mb-2" data-toggle="modal" data-target="#propertyModal">
                        Create Options <i class="fa fa-plus"></i>
                    </button>
                </div> --}}

                <!-- Modal -->
                {{-- <div class="modal fade" id="propertyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> --}}
                            <div class="body">
                                <label for="">Options</label>
                                <div class="row new_properties">
                                    <div class="col-10">
                                        <input type="text" name="option[]" class="form-control mb-1">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="close remove--new_properties">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="properties-container"></div>
                                <div class="btn btn-info mt-1" id="add_more">Add More</div>
                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Save Options</button>
                            </div> --}}
                        </div>
                    {{-- </div>
                </div> --}}

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Add Question">
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript"> 

    const title = document.querySelector("#question")
    const slug = document.querySelector("#slug")
    
    title.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 

</script>

@endsection

@section('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>


<script type="text/javascript">

    $(document).ready(function(){
       $('#poll_cat').change(function(){
        let cat_id = $(this).val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('category_dropdown') }}",
                type: "POST",
                data: {
                    cat_id : cat_id,
                },
                success: function(data){
                    $('#sub_cat_dropdown').html(data)
                },
            });

       }); 
    });



    $(document).ready(function () {
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
            $(this).closest(".new_properties").remove();
        });
        
    });

</script>


@endsection
