@extends('layouts.app')

@section('title', 'Entropia')

@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                  <small>Movie Details</small>
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
          <div class="row thumbnail">
            <div class="col-lg-3 thumbnail">
                <img class="img-rounded" style="width:300px; height:200px; " src="{{ asset('images/'.$movie->id.'.'.$movie->poster.'') }}" alt="">
            </div>
            <div class="col-lg-9">
            <h3>{{ $movie->name}}</h3>
            <h4>
              {{ $movie->year}}
            </h4>
            <p>{{ $movie->plot}}</p>
            <h5>
              Producer: {{ $movie->producer_name }}
            </h5>
            <h5>
              Cast:
            </h5>
              <ul>
                @foreach($casts as $cast)
                  <li> {{ $cast->name}}</li>
                @endforeach
              </ul>
          </div>
        </div>
      </div>
    </div>
@endsection
