@extends('layout')
@section('page_title')
    Poprzednie wyniki
@endsection
@section('main_content')
    <form action="/results" method="POST">
        @csrf
        <legend class="text-white">Opcje wyszukiwania</legend>
        <fieldset>
            <div class="flex justify-content-space-between">
                <input type="text" placeholder="Numer telefonu" name="searchForm" value="{{ old('searchForm') }}">
                <button type="submit" class="btn btn-primary">Szukaj</button>
            </div>
        </fieldset>
    </form>


    <form action="/results" method="POST">
        @csrf
        <legend class="text-white">Opcje sortowania</legend>
        <fieldset>
            <div class="flex justify-content-space-between">
                <select name="sortType">
                    <option value="id_wynik" @if ($sortType == 'id')selected @endif>Id</option>
                    <option value="kwota" @if ($sortType == 'kwota')selected @endif>Kwota</option>
                    <option value="years" @if ($sortType == 'years')selected @endif>Years</option>
                    <option value="procent" @if ($sortType == 'procent')selected @endif>Procent</option>
                    <option value="wynik" @if ($sortType == 'wynik')selected @endif>Wynik</option>
                    <option value="data" @if ($sortType == 'data')selected @endif>Data</option>
                    <option value="phone" @if ($sortType == 'phone')selected @endif>Phone</option>
                </select>
                <select name="sortOrder">
                    <option value="ASC" @if ($sortOrder == 'ASC')selected @endif>Rosnąco</option>
                    <option value="DESC" @if ($sortOrder == 'DESC')selected @endif>Malejąco</option>
                </select>
                <button type="submit" class="btn btn-primary">Sortuj</button>
            </div>
            </fieldset>
    </form>


    <table class="table table-dark border border-light">
        <tr>
            <th>Id_wynik</th>
            <th>Kwota</th>
            <th>Years</th>
            <th>Procent</th>
            <th>Wynik</th>
            <th>Data</th>
            <th>Phone</th>
            <th>Usuwanie</th>
            <th>Edycja</th>
        <tr>
        @foreach ($records as $r)
            @if ($r->deleted_at == null)
                <tr>
                    <td>{{ $r->id}}</td>
                    <td>{{ $r->kwota }}</td>
                    <td>{{ $r->years }}</td>
                    <td>{{ $r->procent }}</td>
                    <td>{{ $r->wynik }}</td>
                    <td>{{ $r->data }}</td>
                    <td>{{ $r->phone }}</td>
                    <td>
                        <form action="/result/delete" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" value="{{$r->id}}" name="idDelete">Usuń</button>
                        </form>
                    </td>
                    <td>
                        <form action="/result/edit" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning" value="{{$r->id}}" name="idEdit">Zmień</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
@endsection