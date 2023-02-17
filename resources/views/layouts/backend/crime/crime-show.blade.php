@extends('layouts.backend.backend-app')

@section('content')
{{-- <div class="row"> --}}
    <div class="card mt-5">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('crime.index') }}">List</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Crime Details</li>
                </ol>
              </nav>
              <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                     <h3>Crime Details</h3>
                </div>
            </div>
            <table class="table table-bordered border-width-3">
                <tr>
                    <th> Crime Type</th>
                    <td>{{ $crime->crime_type }}</td>
                </tr>
                <tr>
                    <th>Crime Place</th>
                    <td>{{ $crime->crime_place }}</td>
                </tr>
                <tr>
                    <th>Crime Address Details</th>
                    <td>{!! $crime->crime_address_details !!}</td>
                </tr>
                <tr>
                    <th>Do U Know When Happened ?</th>
                    <td>{{ $crime->is_heppened  == 1 ? 'Yes' : 'No'  }}</td>
                </tr>
                <tr>
                    <th>When Happened</th>
                    <td>{{ $crime->heppened_time }}</td>
                </tr>
                <tr>
                    <th>Crime Details </th>
                    <td>{!! $crime->crime_details !!}</td>
                </tr>
                <tr>
                    <th>Criminal Details</th>
                    <td>{!! $crime->criminal_details !!}</td>
                </tr>
                <tr>
                    <th>Criminal Look Like</th>
                    <td>{{ $crime->criminal_look_like }}</td>
                </tr>
                <tr>
                    <th>Criminal Contact Details</th>
                    <td>{!! $crime->criminal_contact_details !!}</td>
                </tr>
                <tr>
                    <th>Criminal Has Vehicle</th>
                    <td>{{ $crime->has_vehicle == 1 ? 'Yes' : 'No'  }}</td>
                </tr>
                <tr>
                    <th>Criminal Has Weapon </th>
                    <td>{{ $crime->has_weapon  == 1 ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Would you like to keep in contact? </th>
                    <td>{{ $crime->keep_user_in_contact == 1 ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Agreement? </th>
                    <td>{{ $crime->agreement == 1 ? 'Agreed' : 'No' }}</td>
                </tr>
            </table>
        </div>
    </div>
{{-- </div> --}}
<div class="mt-5 mb-5">
    <a class="btn btn-info" href="{{ route('crime.index') }}">Back</a>
    <a class="btn btn-success" href="{{ route('crime.edit', $crime->id) }}">Edit Crime</a>
</div>
@endsection