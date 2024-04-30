@extends('layout')
@section('page_title')
    Strona główna
@endsection

@section('main_content')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="text-white display-4 fw-normal">Kalkulator kredytowy</h1>
    <p class="text-white fs-5">Przerobiłem ten program który robiliśmy na czystym PHPie za pomocą Laravel</p>
    <div class="flex justify-content-center">
        <button class="btn btn-success"><a href="/calc" class="nav-link px-2 link-secondary text-white">Przejdź do kalkulatora</a></button>
        <button class="btn btn-primary"><a href="/results" class="nav-link px-2 link-secondary text-white">Przejdź do tablicy wyników</a></button>
    </div>
</div>
@endsection