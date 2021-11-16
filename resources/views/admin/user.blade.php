@extends('layout.admin')
@section('content')

@isset($users)
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ url("/user/edit/{$user->id}")}}">Edit</a>
                    <a href="{{ url("/user/edit/{$user->id}")}}">Delete</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}

@endisset
@stop
