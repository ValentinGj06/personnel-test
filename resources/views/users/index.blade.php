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

@section('title', 'Users')

@section('content')
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
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <a href="users/{{ $user->id }}"><button class="btn btn-primary"><i class="far fa-eye fa-lg"></i></button></a>
                    <a href="users/{{ $user->id }}/delete"><button class="btn btn-danger"><i class="far fa-trash-alt fa-lg"></i></button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $users->links() }}
    </div>
@endsection
