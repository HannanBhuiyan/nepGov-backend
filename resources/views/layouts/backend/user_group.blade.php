@extends('layouts.backend.backend-app')

<style>
    .groupWiseUser{
        margin-left: 20px
    } 

</style>

@section('content')
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Users</li> 
            </ol>
        </nav>

        <div class="card p-3 mt-4"> 
            <div class="category_title my-3 d-flex justify-content-between">
               <div class="left">
                    <h3>Users List</h3>
               </div>
            </div>

            <div class="col-9">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <div>
                        @foreach ($groups as $group)
                            <a type="radio" class="btn btn-outline-warning groupwise text-dark" data-id="{{$group->id}}">{{ $group->group_name }}</a>
                        @endforeach
                    </div>
                   
                </ul>
            </div>

            
            <div id="groupwiseusers" class="groupWiseUser">
                @include('layouts.backend.group_users')
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
    function openCity(cityName) {
      var i;
      var x = document.getElementsByClassName("city");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
      }
      document.getElementById(cityName).style.display = "block";  
    }


    $('.groupwise').on('click', function (){
        let data_id = $(this).attr('data-id');
        $('.groupwise').removeClass("btn-success text-white")
        $(this).addClass('btn-success text-white')

        $.ajax({
            url: "{{ route('groupwiseuser') }}",
            type: "POST",
            data: {
                data_id: data_id,
            },
            success: function(response){
                $('#groupwiseusers').html(response.data)
            }
        });
    });
    </script>
@endsection