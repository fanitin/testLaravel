@extends('layouts.layout')
@section('page_title')
    Kalkulator kredytowy
@endsection

@section('main_content')
<h1 class="text-white">Kalkulator kredytowy</h1>
<form action="/calc" method="post">
    @csrf
    <fieldset>
        <label for="id_kwota" class="text-white">Podaj kwotę:</label>
        <input id="id_kwota" type="text" placeholder="wartość kwoty" name="kwota" class="form-control">
        <label for="id_years" class="text-white">Podaj ilość lat:</label>
        <input id="id_years" type="text" placeholder="liczba lat" name="years" class="form-control">
        <label for="id_proc" class="text-white">Podaj oprocentowanie:</label>
        <input id="id_proc" type="text" placeholder="wartość oprocentowania" name="proc" class="form-control">
        <label for="id_phone" class="text-white">Podaj numer telefonu:</label>
        <input id="id_phone" type="text" placeholder="+48XXXXXXXXX" name="phone" class="form-control">
        <br>
        <button type="submit" class="btn btn-success">Oblicz</button>
    </fieldset>
</form>

@if (isset($result))
    <p class="text-white">Kwota: {{$form->kwota}}, lat: {{$form->years}}, oprocentowanie: {{$form->proc}}</p>
    <p class="text-white">Wynik: {{$result}}</p>
@endif
@endsection