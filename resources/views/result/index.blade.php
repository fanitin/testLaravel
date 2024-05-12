@extends('layouts.layout')
@section('page_title')
    Poprzednie wyniki
@endsection
@section('main_content')
    <form action="{{route('result.search')}}" method="POST">
        @csrf
        <legend class="text-white">Opcje wyszukiwania</legend>
        <fieldset>
            <div class="flex justify-content-space-between">
                <input type="text" placeholder="Numer telefonu" name="searchForm" value="{{ old('searchForm') }}">
                <button type="submit" class="btn btn-primary">Szukaj</button>
            </div>
        </fieldset>
    </form>


    <form action="{{route('result.search')}}" method="POST">
        @csrf
        <legend class="text-white">Opcje sortowania</legend>
        <fieldset>
            <div class="flex justify-content-space-between">
                <select name="sortType">
                    <option value="id" @if ($sortType == 'id')selected @endif>Id</option>
                    <option value="kwota" @if ($sortType == 'kwota')selected @endif>Kwota</option>
                    <option value="years" @if ($sortType == 'years')selected @endif>Years</option>
                    <option value="procent" @if ($sortType == 'procent')selected @endif>Procent</option>
                    <option value="wynik" @if ($sortType == 'wynik')selected @endif>Wynik</option>
                    <option value="data" @if ($sortType == 'data')selected @endif>Data</option>
                    <option value="phone" @if ($sortType == 'phone')selected @endif>Phone</option>
                    <option value="category_id" @if ($sortType == 'category_id')selected @endif>Kategoria</option>
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
            <th>Kategoria</th>
            <th>Tag</th>
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
                    <td>@if (isset($r->updated_at))
                        {{$r->updated_at}}
                    @else
                        {{$r->created_at}}
                    @endif</td>
                    <td>{{ $r->phone }}</td>
                    <td>{{ $r->category->name}}</td>
                    <td>@foreach ($r->tags as $tag)
                        {{ ucfirst($tag->name) }}
                        @if (!$loop->last), @endif
                    @endforeach</td>
                    <td>
                        <form action="{{route('result.delete', $r->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Usuń">
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-warning"><a class="text-white" href="{{route('result.edit', $r->id)}}">Edytuj</a></button>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
    <div class="text-white mt-3">
        {{ $records->links() }}
    </div>
@endsection