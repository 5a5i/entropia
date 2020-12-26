@extends('layouts.app')

@section('title', 'Entropia')

@section('content')
        <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                  <small>Edit Movie</small>
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
        <form enctype="multipart/form-data" method="post" action="{{ route('movies.update', $movie->id)}}">
            {{method_field('patch')}}
          {{ csrf_field() }}
        <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      @csrf
                      <label for="movie_name">Movie Name:</label>
                      <input type="text" class="form-control" name="movie_name" value="{{ $movie->name}}" />
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                      <label for="year">Year of release :</label><br>
                      <select name="year" class="form-control">
                        <?php for ($year=date("Y"); $year >=1900; $year--): ?>
                          <option value="<?=$year;?>" @if($movie->year == $year) selected @endif><?=$year;?></option>
                        <?php endfor; ?>
                      </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                      <label for="poster">Poster:</label>
                      <input type="file" class="form-control" name="poster" />
                  </div>
                </div>
                </div>
          <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                      <label for="plot">Plot:</label>
                      <textarea class="form-control" name="plot">{{ $movie->plot}}</textarea>
                  </div>
                </div>
                </div>

          <input type="hidden" id="person_role" name="person_role" value="0" />
        <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label for="producer">Producer:</label>
                      <select name="producer" class="form-control">
                        @foreach($producers as $producer)
                         <option value="{{ $producer->id}}" @if($movie->producer_id == $producer->id) selected @endif>{{ $producer->name}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-lg-6">
                   <label for="new_producer">New Producer?</label><br>
                   <button href="" type="button" data-toggle="collapse" data-target="#new_producer_modal" class="btn btn-default">Add</button>
                </div>
            </div>
        <div id="new_producer_modal" class="collapse">
            <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label for="producer_name">Producer Name:</label>
                      <input type="text" class="form-control" name="producer_name"/>
                  </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label for="producer_sex">Sex:</label>
                      <select name="producer_sex" class="form-control">
                          <option value="">Please select</option>
                          <option value="1">Male</option>
                          <option value="0">Female</option>
                      </select>
                  </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label for="producer_dob">DOB:</label>
                      <input type="date" class="form-control" name="producer_dob"/>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                      <label for="producer_bio">Bio:</label>
                      <textarea class="form-control" name="producer_bio"></textarea>
                  </div>
                </div>
              </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                <span class="pull-right">
                <button type="submit" id="producer_submit" name="producer_submit" class="btn btn-primary" value="add_producer">Add Producer</button>
              </span>
                  </div>
                </div>
              </div>
          </div>
        <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label for="actors">Actors:</label>
                      <select name="actors[]" multiple="multiple" class="form-control">
                        @foreach($actors as $actor)
                         <option value="{{$actor->id}}"
                        @if (in_array($actor->id, $casts)) selected="selected" @endif
                         >{{$actor->name}}</option>
                        @endforeach
                      </select>
                      <small id="actors_help" class="form-text text-muted">Press and hold Ctrl button to select multiple actors.</small>
                  </div>
                </div>
                <div class="col-lg-6">
                   <label for="new_actors">New Actor?</label><br>
                   <button href="" type="button" data-toggle="collapse" data-target="#new_actors_modal" class="btn btn-default">Add</button>
                </div>
          </div>
        <div id="new_actors_modal" class="collapse">
            <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label for="actor_name">Actor Name:</label>
                      <input type="text" class="form-control" name="actor_name"/>
                  </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label for="actor_sex">Sex:</label>
                      <select name="actor_sex" class="form-control">
                          <option value="">Please select</option>
                          <option value="1">Male</option>
                          <option value="0">Female</option>
                      </select>
                  </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label for="actor_dob">DOB:</label>
                      <input type="date" class="form-control" name="actor_dob"/>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                      <label for="actor_bio">Bio:</label>
                      <textarea class="form-control" name="actor_bio"></textarea>
                  </div>
                </div>
              </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                <span class="pull-right">
                <button type="submit" id="actor_submit" name="actor_submit" class="btn btn-primary" value="add_actor">Add Actor</button>
              </span>
                  </div>
                </div>
              </div><br>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                <span class="pull-right">
                  <button type="submit" class="btn btn-primary">Update Movie</button>
              </span>
                </div>
              </div>
            </div></form>
        </div>
@endsection
    <script>
        $("#producer_submit").click(function() {
        $('#person_role').val('1');
        $('input[name=_method]').val('post');
        $(this).closest("form").attr("action", "{{ route('person.store') }}");
    });
        $("#actor_submit").click(function() {
        $('#person_role').val('2');
        $('input[name=_method]').val('post');
        $(this).closest("form").attr("action", "{{ route('person.store') }}");
    });
    </script>
