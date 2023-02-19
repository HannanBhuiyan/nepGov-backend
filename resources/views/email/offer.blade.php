<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .btnoffer {
            background-color: red;
            padding: 20px;
            color: #000;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    
    <h1>hi-- {{$slug}}</h1>

    

    {{-- <a class="btnoffer" href="https://nepgov.vercel.app/normal_voting/{{ $slug }}">Click Here</a> --}}
    <a class="btnoffer" href="{{route('normal_voting', $slug)}}">Click Here</a>
    
</body>
</html>