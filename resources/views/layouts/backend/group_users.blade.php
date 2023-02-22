<form action="{{ route('sendMailToUsers' )}}" method="POST">
    @csrf
    <div class="ml-2">
        <table class="table table-bordered">
            <tr>
                <th scope="col">SL NO</th>
                <th>Email</th>
                <th>Category Name</th>
            </tr>
            @if ($assign_user)
                @foreach ($assign_user as $assign_user)
                    <tr>
                        <input type="hidden" name="allEmails[]" value="{{$assign_user->users->email}}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$assign_user->users->email}}</td>
                        <td>{{ $assign_user->polling_category->category_name }}</td>
                        <input type="hidden" name="slug" value="{{ $assign_user->polling_category->slug }}">
                    </tr>
                    @error('allEmails')
                        <span class="text-danger">{{  $message }}</span>
                    @enderror
                @endforeach
            @endif
        </table>
    </div>
    @error('allEmails')
        <span class="text-danger">{{  $message }}</span><br>
    @enderror
    <button type="submit" class="btn btn-success">Send Mail</button>
</form>