<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{$polling->category_name}}</h1>
        <form action="{{ route('normar_poling_post') }}" method="post">
            @csrf
            <ul>
                @foreach ($single_normal_topic as $item)
                    
                    <li>Topic :{{$item->topic}}</li> 
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" value="1"  name="{{ $item->id }}" id="normal_vote"> 
                            {{-- <input type="text" name="topic_id" value="{{ $item->id }}"> --}}
                            <label class="form-check-label" for="normal_vote">
                                {{ $item->option_one }}  
                                {{-- app --}}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="{{ $item->id }}" id="normal_vote1">
                            {{-- <input type="text" name="topic_id" value="{{ $item->id }}"> --}}
                            <label class="form-check-label" for="normal_vote1">
                                {{ $item->option_two }}
                                {{-- dis --}}
                            </label>
                        </div> 
                    <hr>
                    
                @endforeach
            </ul>
            <input type="submit" class="btn btn-info" value="submit">
        </form>
    </div>
    


    {{-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
 
            <script>

                $(document).ready(function(){
                    $("input[type='radio']").click(function(){
                        var radioValue = $("input[name='normal_vote{{ $item->id }}']:checked").val();
                        if(radioValue){
                            alert("Your are a - " + radioValue);
                        }
                    });
                });
        
        
        
     </script> --}}
</body>
</html>