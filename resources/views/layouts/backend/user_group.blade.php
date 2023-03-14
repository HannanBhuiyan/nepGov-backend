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
                            <span style="margin-right: 20px; cursor: pointer" class="delete_group" group-id="{{$group->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
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
            // alert(data_id)
            $('.groupwise').removeClass("btn-success text-white")
            $(this).addClass('btn-success text-white')

            $.ajax({
                url: "{{ route('groupwiseuser') }}",
                type: "POST",
                data: {
                    data_id: data_id,
                },
                success: function(response){
                    console.log(response);
                    $('#groupwiseusers').html(response.data)
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.delete_group').click(function () {
                let group_id = $(this).attr('group-id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('groupUserDelete')}}",
                    type: "post",
                    data:{
                        group_id:group_id,
                    },
                    success: function(data){
                        // console.log(data);
                        if(data.status == 200){
                            // toastr.success(data.message);
                        }
                        location.reload()
                    }
                })
            });
        });
    </script>
@endsection