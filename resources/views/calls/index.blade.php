<?php
/**
 * Created by PhpStorm.
 * Filename: import-form.blade.php
 * Author: Valentin Gjorgoski
 * Date: 5/15/2021
 * Time: 12:43 PM
 */
?>
@extends('layouts.layout')

@section('title', 'Calls')


@section('content')
    <a class="nav-item nav-link" href="{{ url('calls/create') }}"><button class="btn btn-primary" form="add_location">Add New Call</button></a>
    @if(Session::has('flash_success'))
        <div class="alert alert-block alert-success">
            <i class=" fa fa-check cool-green "></i>
            {{ nl2br(Session::get('flash_success')) }}
        </div>
    @endif
    <table class="table table-success table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Client</th>
            <th>Client Type</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Type of Call</th>
            <th>Score</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($calls as $call)
            <tr>
                <td>{{ $call->id }}</td>
                <td>{{ $call->user->name }}</td>
                <td>{{ $call->client }}</td>
                <td>{{ $call->clientType }}</td>
                <td>{{ $call->date }}</td>
                <td>{{ $call->duration }}</td>
                <td>{{ $call->typeOfCall }}</td>
                <td>{{ $call->externalCallScore }}</td>
                <td>
                    <a href="calls/{{ $call->id }}/edit"><button class="btn btn-primary"><i class="far fa-edit fa-lg"></i></button></a>
                    <a href="calls/{{ $call->id }}/delete"><button class="btn btn-danger"><i class="far fa-trash-alt fa-lg"></i></button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $calls->links() }}
    </div>
@endsection
