@extends('layouts.admin')
@section('main_content')

<table class="table table-dark border border-light">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Role</th>
        <th>Email</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Updated_by</th>
        <th></th>
    <tr>
    @foreach ($users as $user)
            <tr>
                <td>{{ $user->id}}</td>
                <td>{{ $user->name }}</td>
                <td>@foreach ($user->roles as $role)
                    {{ $role->name }}
                @endforeach</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>{{ $user->editor_id }}</td>
                <td>
                    <button class="btn btn-warning"><a class="text-white" href="{{route('admin.user.changeRole', $user->id)}}">Change role</a></button>
                </td>
            </tr>
    @endforeach
  </table>

    <div class="text-white mt-3">
        {{ $users->appends(request()->input())->links() }}
    </div>
@endsection