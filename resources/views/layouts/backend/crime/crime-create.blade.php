@extends('layouts.backend.backend-app')

@section('content')
    
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('crime.index') }}">Crimes</a></li>
              <li class="breadcrumb-item active">Add Crime</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add Crime</h3>
            </div>
            <form action="{{ route('crime.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Crime Type<span class="text-danger">*</span></label>
                    <select name="crime_type" class="form-control">
                        <option selected>--Choose Crime--</option>   
                        <option>Crime 1</option>   
                        <option>Crime 2</option>   
                        <option>Crime 3</option>   
                    </select>
                    @error('crime_type')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Crime Place<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="crime_place" name="crime_place" placeholder="Crime Place">
                    @error('crime_place')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Crime Address Details</label>
                    <textarea class="form-control ckeditor" name="crime_address_details" placeholder="">{{ old('crime_address_details') }}</textarea>
                    @error('crime_address_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Do U Know When Happened ?<span class="text-danger">*</span></label>
                    <select name="is_heppened" class="form-control">
                        <option selected>--Do U Know When Happened--</option>
                        <option value="1">Yes</option>   
                        <option value="0">No</option>   
                    </select>
                    @error('is_heppened')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>   

                <div class="form-group">
                    <label> When Happened </label>
                        
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                        </div>
                        <input class="form-control fc-datepicker" name="heppened_time" placeholder="MM/DD/YYYY" type="text">
                    </div>
                    
                    @error('heppened_time')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Crime Details<span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor" name="crime_details" placeholder="">{{ old('crime_details') }}</textarea>
                    @error('crime_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Criminal Details<span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor" name="criminal_details" placeholder="">{{ old('criminal_details') }}</textarea>
                    @error('criminal_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Criminal Look Like <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  name="criminal_look_like" placeholder="">
                    @error('criminal_look_like')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div> 

                <div class="form-group">
                    <label> Criminal Contact Details<span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor" name="criminal_contact_details" placeholder="">{{ old('criminal_contact_details') }}</textarea>
                    @error('criminal_contact_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Has Vehicle<span class="text-danger">*</span></label>
                    <select name="has_vehicle" class="form-control">
                        <option selected>--Choose One--</option>
                        <option value="1">Yes</option>   
                        <option value="0">No</option>   
                    </select>
                    @error('has_vehicle')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Has Weapon<span class="text-danger">*</span></label>
                    <select name="has_weapon" class="form-control">
                        <option selected>--Choose One--</option>
                        <option value="1">Yes</option>   
                        <option value="0">No</option>   
                    </select>
                    @error('has_weapon')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Would you like to keep in contact?<span class="text-danger">*</span></label>
                    <select name="keep_user_in_contact" class="form-control">
                        <option selected>--Choose One--</option>
                        <option value="1">Yes</option>   
                        <option value="0">No</option>   
                    </select>
                    @error('keep_user_in_contact')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="checkbox"   name="agreement" placeholder="News Title">
                    <label> Agreement <span class="text-danger">*</span></label>
                    @error('agreement')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div> 

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Add Crime">
                </div>

            </form>
        </div>
    </div>
</div>

 

@endsection


@section('scripts')
    <script type="text/javascript">
        CKEDITOR.replace('crime_address_details');
        CKEDITOR.replace('crime_details');
        CKEDITOR.replace('criminal_contact_details');
        CKEDITOR.replace('criminal_details');
    </script>
@endsection
