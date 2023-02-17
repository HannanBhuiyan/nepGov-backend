@extends('layouts.backend.backend-app')

@section('content')
    
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('crime.index') }}">Crimes</a></li>
              <li class="breadcrumb-item"><a href="{{ route('crime.create') }}">Add Crime</a></li>
              <li class="breadcrumb-item active">Edit Crime</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add Crime</h3>
            </div>
            <form action="{{ route('crime.update',$crime->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Crime Type<span class="text-danger">*</span></label>
                    <select name="crime_type" class="form-control">
                        <option selected>--Choose Crime--</option>   
                        <option {{$crime->crime_type == 'Crime 1' ? 'selected' : ''}}>Crime 1</option>   
                        <option {{$crime->crime_type == 'Crime 2' ? 'selected' : ''}}>Crime 2</option>   
                        <option {{$crime->crime_type == 'Crime 3' ? 'selected' : ''}}>Crime 3</option>   
                    </select>
                    @error('crime_type')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Crime Place<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="crime_place" name="crime_place" value="{{$crime->crime_place}}" placeholder="Crime Place">
                    @error('crime_place')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Crime Address Details</label>
                    <textarea class="form-control ckeditor" name="crime_address_details" placeholder="">{{$crime->crime_address_details}}</textarea>
                    @error('crime_address_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Do U Know When Happened ?<span class="text-danger">*</span></label>
                    <select name="is_heppened" class="form-control">
                        <option value="1" {{$crime->is_heppened == 1 ? 'selected' : ''}}>Yes</option>   
                        <option value="0" {{$crime->is_heppened == 0 ? 'selected' : ''}}>No</option>   
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
                        <input class="form-control fc-datepicker" name="heppened_time" value="{{$crime->heppened_time}}" placeholder="MM/DD/YYYY" type="text">
                    </div>
                     
                    @error('heppened_time')  
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">
                    <label> Crime Details<span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor" name="crime_details" placeholder="SEO Desc">{{ $crime->crime_details }}</textarea>
                    @error('crime_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Criminal Details<span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor"  name="criminal_details" placeholder="SEO Desc">{{ $crime->criminal_details }}</textarea>
                    @error('criminal_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Criminal Look Like <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{$crime->criminal_look_like}}" name="criminal_look_like" placeholder="News Title">
                    @error('criminal_look_like')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div> 

                <div class="form-group">
                    <label> Criminal Contact Details<span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor"  name="criminal_contact_details" placeholder="SEO Desc">{{ $crime->criminal_contact_details }}</textarea>
                    @error('criminal_contact_details')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Has Vehicle<span class="text-danger">*</span></label>
                    <select name="has_vehicle" class="form-control">
                        <option value="1" {{$crime->has_vehicle == 1 ? 'selected' : ''}}>Yes</option>   
                        <option value="0" {{$crime->has_vehicle == 0 ? 'selected' : ''}}>No</option>   
                    </select>
                    @error('has_vehicle')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Has Weapon<span class="text-danger">*</span></label>
                    <select name="has_weapon" class="form-control">
                        <option value="1" {{$crime->has_weapon == 1 ? 'selected' : ''}}>Yes</option>   
                        <option value="0" {{$crime->has_weapon == 0 ? 'selected' : ''}}>No</option>   
                    </select>
                    @error('has_weapon')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Would you like to keep in contact?<span class="text-danger">*</span></label>
                    <select name="keep_user_in_contact" class="form-control">
                        <option value="1" {{$crime->keep_user_in_contact == 1 ? 'selected' : ''}}>Yes</option>   
                        <option value="0" {{$crime->keep_user_in_contact == 0 ? 'selected' : ''}}>No</option>   
                    </select>
                    @error('keep_user_in_contact')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="checkbox" {{ $crime->agreement==1?'checked':'' }} name="agreement" placeholder="News Title">
                    <label> Agreement <span class="text-danger">*</span></label>
                    @error('agreement')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Update Crime">
                </div>

            </form>
        </div>
    </div>
</div>

 

@endsection

@section('scripts')
<script type="text/javascript">


$("#newDateField").hide();
    
        CKEDITOR.replace('crime_address_details');
        CKEDITOR.replace('crime_details');
        CKEDITOR.replace('criminal_contact_details');
        CKEDITOR.replace('criminal_details');
</script>
@endsection
