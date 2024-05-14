@extends('layouts.admin')
@section('main_content')

    <form action="{{route('admin.user.changedRole', $user->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-2">
                <p class="text-white">Wybierz role:</p>
            </div>
            <div class="col-md-10">
                @foreach ($roles as $role)
                    @if ($role->name != 'admin')
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox{{$role->id}}" value="{{$role->id}}" name="roles[]" {{$user->roles->contains($role->id) ? 'checked' : ''}}>
                            <label class="form-check-label text-white" for="inlineCheckbox{{$role->id}}">{{$role->name}}</label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Zapisz</button>
            <button type="button" class="btn btn-light" onclick="window.location.href='/admin/user'">Anuluj</button>
        </div>
    </form>

@endsection