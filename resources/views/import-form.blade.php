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

@section('title', 'Home')

@section('content')
    <form id="import-csv-form" method="POST"  action="{{ url('import') }}" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="formFileLg" class="form-label">Import .csv file to insert data in database</label>
                    <input class="form-control form-control-lg" id="formFileLg" name="file" type="file">
                </div>
                @error('file')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 my-auto text-center">
                <button type="submit" class="btn btn-primary" id="submit">Upload</button>
            </div>
        </div>
    </form>
    @if(Session::has('status'))
        <div class="alert alert-block alert-success">
            <i class=" fa fa-check cool-green "></i>
            {{ nl2br(Session::get('status')) }}
        </div>
    @endif
@endsection
