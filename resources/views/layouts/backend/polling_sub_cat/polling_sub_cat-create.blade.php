@extends('layouts.backend.backend-app')


@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('polling_sub_cat.index')}}">Sub Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add Sub Category</h3>
            </div>
            <form action="{{ route('polling_sub_cat.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Polling Category<span class="text-danger">*</span>(If no Category <a href="{{route('polling_category.create')}}">Create Category</a> Here:)</label>
                    <select name="category_id" class="form-control">
                        <option selected value>--Selece One--</option>
                        @foreach ($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                        @endforeach  
                    </select>
                    @error('category_id')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Sub Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Sub Category Slug">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="checkbox"   name="need_registration" placeholder="">
                    <label> Need Registration ? <span class="text-danger">*</span></label>
                </div> 

                {{-- <div class="form-group">
                    <label>Status<span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option selected value="normal">Normal</option>   
                        <option value="live">Live</option>   
                    </select>
                    @error('status')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    <label>Country<span class="text-danger">*</span></label><br>
                    <button type="button" class="btn btn-dark" id="global_button">Global</button>
                    <button type="button" class="btn btn-dark" id="specific_button">Specific Country</button>
                    
                    <div class="mt-3" id="specific_country">
                        <select class="country_dropdown form-control" name="country[]" data-flag="true" id="country_dropdown" multiple="multiple" placeholder="C">
                            @foreach ($countries as $country)
                            <option value="{{$country->code}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>

                <div class="form-group mt-2">
                    <input type="submit" class="form-control btn btn-primary" value="Add Sub Category">
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript"> 

    const title = document.querySelector("#name")
    const slug = document.querySelector("#slug")
    
    title.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 

</script>



@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.country_dropdown').select2({
                placeholder: "Select",
                allowClear: true
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#specific_country').hide()

            $('#global_button').click(function(){
                $('#specific_country').hide()
                $('#global_button').addClass("btn btn-info")
                $('#specific_button').removeClass("btn-info")
                $('#specific_country').find('option').remove().end()
                // .append('<option value="whatever">text</option>').val('whatever');
                // alert('Please Clear the selected countries')
            })
            $('#specific_button').click(function(){
                $('#specific_country').show()
                $('#specific_button').addClass("btn btn-info")
                $('#global_button').removeClass("btn-info")
            })
            

    });
    </script>
@endsection
