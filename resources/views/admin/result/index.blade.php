@extends('layouts.admin')
@section('main_content')
<form action="{{route('admin.result.search')}}" method="POST">
  @csrf
  <legend class="text-white">Opcje wyszukiwania</legend>
  <fieldset>
      <div class="flex justify-content-space-between">
          <select name="searchType">
              <option value="id" {{ isset($data['searchType']) && $data['searchType'] === 'id' ? 'selected' : '' }}>Id</option>
              <option value="kwota" {{isset($data['searchType']) && $data['searchType'] === 'kwota' ? 'selected' : ''}}>Kwota</option>
              <option value="years" {{isset($data['searchType']) && $data['searchType'] === 'years' ? 'selected' : ''}}>Years</option>
              <option value="procent" {{isset($data['searchType']) && $data['searchType'] === 'procent' ? 'selected' : ''}}>Procent</option>
              <option value="wynik" {{isset($data['searchType']) && $data['searchType'] === 'wynik' ? 'selected' : ''}}>Wynik</option>
              <option value="phone" {{isset($data['searchType']) && $data['searchType'] === 'phone' ? 'selected' : ''}}>Numer telefonu</option>
              <option value="categories.name" {{isset($data['searchType']) && $data['searchType'] === 'categories.name' ? 'selected' : ''}}>Kategoria</option>
          </select>
          <input type="text" placeholder="..." name="searchForm" value="{{ isset($data['searchForm']) ? $data['searchForm'] : old('searchForm') }}">
          <button type="submit" class="btn btn-primary">Szukaj</button>
      </div>
  </fieldset>
</form>


<form action="{{route('admin.result.search')}}" method="POST">
  @csrf
  <legend class="text-white">Opcje sortowania</legend>
  <fieldset>
      <div class="flex justify-content-space-between">
          <select name="sortType">
              <option value="id" {{isset($data['sortType']) && $data['sortType'] === 'id' ? 'selected' : ''}}>Id</option>
              <option value="kwota" {{isset($data['sortType']) && $data['sortType'] === 'kwota' ? 'selected' : ''}}>Kwota</option>
              <option value="years" {{isset($data['sortType']) && $data['sortType'] === 'years' ? 'selected' : ''}}>Years</option>
              <option value="procent" {{isset($data['sortType']) && $data['sortType'] === 'procent' ? 'selected' : ''}}>Procent</option>
              <option value="wynik" {{isset($data['sortType']) && $data['sortType'] === 'wynik' ? 'selected' : ''}}>Wynik</option>
              <option value="data" {{isset($data['sortType']) && $data['sortType'] === 'data' ? 'selected' : ''}}>Data</option>
              <option value="phone" {{isset($data['sortType']) && $data['sortType'] === 'phone' ? 'selected' : ''}}>Numer telefonu</option>
              <option value="category_id" {{isset($data['sortType']) && $data['sortType'] === 'category_id' ? 'selected' : ''}}>Kategoria</option>
          </select>
          <select name="sortOrder">
              <option value="ASC" {{isset($data['sortOrder']) && $data['sortOrder'] === 'ASC' ? 'selected' : ''}}>Rosnąco</option>
              <option value="DESC" {{isset($data['sortOrder']) && $data['sortOrder'] === 'DESC' ? 'selected' : ''}}>Malejąco</option>
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
  @foreach ($results as $r)
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
                  <form action="{{route('admin.result.delete', $r->id)}}" method="POST">
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
  {{ $results->appends(request()->input())->links() }}
</div>
@endsection