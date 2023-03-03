@extends('layouts.backend.backend-app')

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Users List</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User Details</li>
                </ol>
              </nav>
              <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                     <h3>User Details</h3>
                </div>
            </div>
            <div class="table-responsive">
                @php
                    $user_infos = App\Models\SurvayAnswer::where('user_id', $user->id)->first();
                @endphp
                <table class="table table-bordered border-width-3 mt-4">
                    <tr>
                        <th> Image</th>
                        <td><img src="{{ asset($user->image ) }}" alt="not found" width="200px"></td>
                    </tr>
                    <tr>
                        <th> First Name</th>
                        <td>{{ $user->first_name ??'' }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $user->last_name ??''}}</td>
                    </tr>
                    <tr>
                        <th>UserName</th>
                        <td>{{ $user->username ??'' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email ??'' }}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{ $user->country ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>{{ \Carbon\Carbon::parse($user->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years') }}</td>
                    </tr>
                    <h3>Survay Report</h3>
                    <tr>
                        <th>Why Choose NepGov ?</th>
                        <td>{{ Str::headline($user_infos->why_you_joined_nepGov ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <th>Political Support</th>
                        <td>{{ Str::headline($user_infos->which_political_party_do_you_support ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <th>Ethnicity</th>
                        <td>{{ Str::headline($user_infos->what_is_your_ethnicity ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <th>Qualification</th>
                        <td>{{ Str::headline($user_infos->highest_educational_qualification_you_have ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <th>Your Concern</th>
                        <td>{{ Str::headline($user_infos->your_concern_to_our_category ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <th>Extra Infos:-</th>
                        <td>
                            @if (!empty($user_infos->extra_questions) )
                                @foreach (json_decode($user_infos->extra_questions,true) as $item)
                                    <ul>
                                        <li>Question: {{$item['question']}}</li>
                                        <li>Answer: {{$item['answer']}}</li>
                                    </ul>
                                @endforeach
                         @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Created</th>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() ?? ''}}</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
{{-- </div> --}}
<div class="mt-5 mb-5">
    <a class="btn btn-info" href="{{ route('user.index') }}">Back</a>
    <a class="btn btn-success" href="{{ route('admin_edit_user',$user->id) }}">Edit User</a>
</div>
@endsection