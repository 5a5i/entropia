@extends('layouts.app')

@section('title', 'Entropia')

@section('content')
        <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                  <small>Edit {{ $person->role === 1 ? 'Producer' : 'Actor' }}</small>
              </h1>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning">
                    {{ session()->get('error') }}
                </div>
            @endif
            </div>
        </div>

        <div class="row">
        <div class="col-lg-6 error"><font color="red">
                @foreach($errors->all() as $error)
                    {{$error}}<br>
                @endforeach
        </font></div>
    </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('person.update', ['role' => ($person->role === 1 ? 'producers' : 'actors') , 'person' => $person->id])}}">
            {{method_field('patch')}}
          {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label for="name">{{ $person->role === 1 ? 'Producer' : 'Actor' }} Name:</label>
                      <input type="text" class="form-control" name="name" value="{{ $person->name }}" />
                  </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label for="sex">Sex:</label>
                      <select name="sex" class="form-control">
                          <option value="">Please select</option>
                          <option value="1" {{ $person->sex == 1 ? 'selected' : '' }}>Male</option>
                          <option value="0" {{ $person->sex == 0 ? 'selected' : '' }}>Female</option>
                      </select>
                  </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label for="dob">DOB:</label>
                      <input type="date" class="form-control" name="dob" value="{{ $person->dob }}" />
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                      <label for="bio">Bio:</label>
                      <textarea class="form-control" name="bio">{{ $person->bio }}</textarea>
                  </div>
                </div>
              </div>
              <input type="hidden" id="role" name="role" value="{{ $person->role === 1 ? 'Producer' : 'Actor' }}" />
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                <span class="pull-right">
                  <button type="submit" class="btn btn-primary">Update {{ $person->role === 1 ? 'Producer' : 'Actor' }}</button>
              </span>
                </div>
              </div>
            </div></form>
        </div>
@endsection
