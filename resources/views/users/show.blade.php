@extends('layouts.layout')

@section('title', 'User')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1 class="title">{{ $user->name }}</h1>
        </div>
        <div class="col-md-6">
            <h2 class="score">AVG SCORE: {{ $user->score }}</h2>
        </div>

    </div>

    @if ($user)

    <table class="table table-striped">
         <thead>
         <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Date</th>
            <th>Score</th>
         </tr>
         </thead>
         <tbody>
            @foreach($user->calls as $value)
                <tr>
                   <td>{{ $value->id }}</td>
                   <td>{{ $value->client }}</td>
                   <td>{{ $value->date }}</td>
                   <td>{{ $value->externalCallScore }}</td>
                </tr>
            @endforeach
         </tbody>
      </table>
    @endif
@endsection
