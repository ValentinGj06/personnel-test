@extends('layouts.layout')

@section('title', 'Create Call')

@section('content')
<div class="container">
    <h1 class="title">Create New Call</h1>
    <form method="POST" action="{{ url('calls')}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mt-lg-4">
                    <select class="selectpicker" data-live-search="true" title="User" name="user_id" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-lg-4">
                    <select class="selectpicker" data-live-search="true" title="Client" name="client" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->client }}">{{ $client->client }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-lg-4">
                    <div class="form-floating col-md-5">
                        <input type="number" min="0" class="form-control" placeholder="Duration" name="duration" id="duration" value="{{ old('duration') }}" required></input>
                        <label for="duration">Duration</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mt-lg-4">
                    <select class="selectpicker" data-live-search="true" title="Client Type" name="clientType" required>
                        @foreach($clientType as $clientType)
                            <option value="{{ $clientType->clientType }}">{{ $clientType->clientType }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-lg-4">
                    <select class="selectpicker" data-live-search="true" title="Type of Call" name="typeOfCall" required>
                        @foreach($callType as $callType)
                            <option value="{{ $callType->typeOfCall }}">{{ $callType->typeOfCall }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-lg-4">
                    <div class="form-floating col-md-5">
                        <input type="number" min="0" max="100" class="form-control" placeholder="External Call Score" name="externalCallScore" id="externalCallScore" value="{{ old('externalCallScore') }}" required></input>
                        <label for="externalCallScore">External Call Score</label>
                    </div>
                </div>
                <div class="form-group mt-lg-4">
                    <div class="form-floating col-md-5">
                        <input class="form-control" placeholder="Date" name="date" id="floatingInput" value="{{ date('Y-m-d H:i:s') }}" required data-provide="datepicker">
                        <label for="floatingInput">Date & Time</label>
                    </div>
                </div>
            </div>
            <div class="form-group mt-lg-4">
                <div class="col-sm-2 mt-md-5 float-end">
                    <button type="submit" class="btn btn-primary">Create Call</button>
                </div>
            </div>
        </div>
    @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection
