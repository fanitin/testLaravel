@extends('layouts.layout')
@section('page_title')
    Kalkulator kredytowy
@endsection

@section('main_content')
<h1 class="text-white">Kalkulator kredytowy</h1>
<form action="{{ route('result.save')}}" method="post">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="id_kwota" class="text-white">Podaj kwotę:</label>
                <input id="id_kwota" type="text" placeholder="Wartość kwoty" name="kwota" class="form-control" value="{{old('kwota')}}">
            </div>
            <div class="col-md-4">
                <label for="id_years" class="text-white">Podaj ilość lat:</label>
                <input id="id_years" type="text" placeholder="Liczba lat" name="years" class="form-control" value="{{old('years')}}">
            </div>
            <div class="col-md-4">
                <label for="id_procent" class="text-white">Podaj oprocentowanie:</label>
                <input id="id_procent" type="text" placeholder="Wartość oprocentowania" name="procent" class="form-control" value="{{old('procent')}}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="id_phone" class="text-white">Podaj numer telefonu:</label>
                <input id="id_phone" type="text" placeholder="+48XXXXXXXXX" name="phone" class="form-control" value="{{old('phone')}}">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="text-white">Podaj kategorię:</label>
                <select id="inputState" class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p class="text-white">Wybierz tagi:</p>
            </div>
            <div class="col-md-10">
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox{{$tag->id}}" value="{{$tag->id}}" name="tags[]" 
                        @if (is_array(old('tags')) && in_array($tag->id, old('tags'))) checked @endif>
                        <label class="form-check-label text-white" for="inlineCheckbox{{$tag->id}}">{{$tag->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Oblicz</button>
            </div>
        </div>
    </div>
</form>

@if (isset($data['wynik']))
    <p class="text-white">Kwota: {{$data['kwota']}}, lat: {{$data['years']}}, oprocentowanie: {{$data['procent']}}</p>
    <p class="text-white">Wynik: {{$data['wynik']}}</p>
@endif
@endsection