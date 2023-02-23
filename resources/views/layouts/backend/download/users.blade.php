<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> 
    <style>
        .user_section {
            width: 1100px;
            margin: auto; 
        }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
</head>
<body>
    <div class="user_section">
        <div class="category_title">
            <div class="left">
                <h3>Users List </h3>
            </div>
        </div>
        <div class="user_table">
            <table> 
                <tr>
                    <th scope="col">SL NO</th> 
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Political Support</th>
                    <th scope="col">Ethnicity</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Age</th>
                </tr>  
                @foreach ($users as $user)
                @php
                    $user_infos = App\Models\SurvayAnswer::where('user_id', $user->id)->first();
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td> 
                    <td > 
                        <label for="userCheck-{{$user->id}}" style="cursor: pointer">{{ $user->username ?? 'N/A' }}</label>
                    </td>
                    <td>{{ $user->email ?? '' }}</td>
                    <td>{{ Str::headline($user_infos->which_political_party_do_you_support ?? 'N/A') }}</td>
                    <td>{{ Str::headline($user_infos->what_is_your_ethnicity ?? 'N/A') }}</td>
                    <td>{{ Str::headline($user_infos->highest_educational_qualification_you_have ?? 'N/A') }}</td>
                    <td>{{ Carbon\Carbon::parse($user->date_of_birth)->age ?? 'N/A' }}</td> 
                </tr> 
                @endforeach  
            </table>
        </div>
    </div>
</body>
</html>



