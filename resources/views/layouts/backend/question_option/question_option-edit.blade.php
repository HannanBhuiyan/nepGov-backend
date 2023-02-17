@extends('layouts.backend.backend-app')


@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('question_option.index')}}">Options</a></li>
              <li class="breadcrumb-item"><a href="{{route('question_option.create')}}">Add Options</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Options</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add New Options</h3>
            </div>
            <form action="{{ route('question_option.update' , $option->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="form-group">
                    <label>Polling Question<span class="text-danger">*</span></label>
                    <select name="question_id" class="form-control">
                        @foreach ($questions as $question)
                            <option value="{{$question->id}}" {{$question->id == $option->question_id ? 'selected' : ''}}>{{$question->question}}</option>
                        @endforeach  
                    </select>
                    @error('question_id')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Options <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="option" value="{{$option->option}}" name="option" placeholder="Option">
                    @error('option')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Edit Option">
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('scripts')

@endsection
