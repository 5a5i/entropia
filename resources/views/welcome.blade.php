@extends('layouts.app')

@section('title', 'Entropia')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Movies
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
    <div  id="movie_list">
          @include('pagination')
    </div>
    <div id="delete" class="modal modal-danger fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" >
        <div class="modal-dialog" style="width:55%;">
          <form action="{{ route('movies.destroy', 'test')}}" method="post" >
            {{method_field('delete')}}
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <h4>You Want You Sure Delete This Movie?</h4>
                    <input type="hidden" name="movie_id" id="mov_id" value="">
                    <input type="hidden" name="poster" id="pos_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Yes</button>
                </div>
            </div>
          </form>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

      $(document).on('click','.pagination a', function(event){
        /*event.preventDefault();*/
        var page =$(this).attr('href').split('page=')[1];
        fetch_data(page);
      });
      function fetch_data(page)
      {
        $.ajax({
          url:"../public/fatch_data?page="+page,
          success:function(movie)
          {
              $('#movie_list').html(movie);
              $('#movie_list').html(casts);
          }
        });
      }
      $('#delete').on('show.bs.modal', function (event) {
          var button = $(this);
          // var mov_id = button.data('movid');
          // var pos_id = button.data('posid');
          var modal = $('show.bs.modal');
          // console.log(mov_id);
          // modal.find('.modal-body #mov_id').val(mov_id);
          // modal.find('.modal-body #pos_id').val(pos_id);
      });
      $('#deletebutton').click(function (event) {
          // console.log(event);
          var button = $(this);
          var mov_id = button.data('movid');
          var pos_id = button.data('posid');
          // var modal = $('show.bs.modal');
              // console.log(modal);x
          $('#mov_id').val(mov_id);
          $('#pos_id').val(pos_id);
      });
    });
    </script>
