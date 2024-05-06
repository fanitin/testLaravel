@extends('layouts.layout')
@section('page_title')
    Edycja
@endsection

@section('main_content')
<h1 class="text-white">Edycja wpisu o id {{$result->id}}</h1>
<form action="{{route('result.edited')}}" method="POST">
    @csrf
    @method('patch')
    <input type="hidden" name="idEdit" value="{{$result->id}}">
    <fieldset>
        <div class="row g-3">
            <div class="col-md">
                <label for="id_kwota" class="text-white">Podaj kwotę:</label>
                <input id="id_kwota" type="text" placeholder="wartość kwoty" name="kwota" class="form-control" value="{{$result->kwota}}">
            </div>
            <div class="col-md">
                <label for="id_years" class="text-white">Podaj ilość lat:</label>
                <input id="id_years" type="text" placeholder="liczba lat" name="years" class="form-control" value="{{$result->years}}">
            </div>
            <div class="col-md">
                <label for="id_proc" class="text-white">Podaj oprocentowanie:</label>
                <input id="id_proc" type="text" placeholder="wartość oprocentowania" name="procent" class="form-control" value="{{$result->procent}}">
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md">
                <label for="id_phone" class="text-white">Podaj numer telefonu:</label>
                <input id="id_phone" type="text" placeholder="+48XXXXXXXXX" name="phone" class="form-control" value="{{$result->phone}}">
            </div>
            <div class="col-md">
                <label for="inputState" class="text-white">Podaj kategorię:</label>
                <select id="inputState" class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if ($result->category_id == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Zapisz</button>
        <button type="button" class="btn btn-light" onclick="window.location.href='/result'">Anuluj</button>
    </fieldset>
</form>

@endsection