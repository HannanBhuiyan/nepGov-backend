@extends('layouts.backend.backend-app')

@section('content')
    
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('crime_question.index') }}">Questions</a></li>
              <li class="breadcrumb-item"><a href="{{ route('crime_question.create') }}">Add Questions</a></li>
              <li class="breadcrumb-item active">Edit Questions</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add Questions</h3>
            </div>
            <form action="{{ route('crime_question.update', $question->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label>Crime Type <span class="text-danger">*</span></label>
                    <select name="crime_type" class="form-control">  
                        <option {{$question->crime_type == 'Crime 1' ? 'selected' : ''}}>Crime 1</option>   
                        <option {{$question->crime_type == 'Crime 2' ? 'selected' : ''}}>Crime 2</option>   
                        <option {{$question->crime_type == 'Crime 3' ? 'selected' : ''}}>Crime 3</option>   
                    </select>
                    @error('crime_type')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                    
                </div>

                <div class="form-group">
                    <label> Question <span class="text-danger">*</span></label>
                    <input type="text" value="{{$question->question}}" class="form-control" id="question" name="question" placeholder="Question">
                    @error('question')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Answer Type <span class="text-danger">*</span></label>
                    <select name="answer_type" class="form-control">
                        <option value="input" {{$question->amswer_type == 'input' ? 'selected' : ''}}>Input</option>   
                        <option value="boolean" {{$question->amswer_type == 'boolean' ? 'selected' : ''}}>Boolean</option>   
                    </select>
                    @error('answer_type')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
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
    <script type="text/javascript">
        $(document).ready(function(){


    });
    </script>
@endsection
