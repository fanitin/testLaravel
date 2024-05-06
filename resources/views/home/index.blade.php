@extends('layouts.layout')
@section('page_title')
    Strona główna
@endsection

@section('main_content')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="text-white display-4 fw-normal">Kalkulator kredytowy</h1>
    <p class="text-white fs-5">Przerobiłem ten program który robiliśmy na czystym PHPie za pomocą Laravel</p>
    <div class="flex justify-content-center">
        <button onclick="window.location.href='{{ route('calc.index') }}'" class="btn btn-success btn-as-link">Przejdź do kalkulatora</button>
        <button onclick="window.location.href='{{ route('result.index') }}'" class="btn btn-primary btn-as-link">Przejdź do poprzednich wyników</button>
    </div>
</div>
@endsection