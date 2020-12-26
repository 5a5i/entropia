@extends('layouts.app')
@push('styles')
<style>
tr.hide-table-padding td {
  padding: 0;
}

.expand-button {
	position: relative;
}

.accordion-toggle.expand-button:after
{
  position: absolute;
  left:.75rem;
  top: 50%;
  transform: translate(0, -50%);
  content: '-';
}
.accordion-toggle.collapsed.expand-button:after
{
  content: '+';
}
</style>
@endpush

@section('title', 'Entropia')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ ucfirst($role) }}
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

<div class="container my-4">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Sex</th>
          <th scope="col">DOB</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach($persons as $person)
        <tr class="">
          <td class="accordion-toggle collapsed expand-button" id="accordion{{ $person->id }}" data-rownumber="{{ $person->id }}" data-toggle="collapse" data-parent="#accordion{{ $person->id }}" href="#collapse0{{ $person->id }}"></td>
          <td class="accordion-toggle collapsed" id="accordion{{ $person->id }}" data-rownumber="{{ $person->id }}" data-toggle="collapse" data-parent="#accordion{{ $person->id }}" href="#collapse0{{ $person->id }}">{{ $person->name }}</td>
          <td class="accordion-toggle collapsed" id="accordion{{ $person->id }}" data-rownumber="{{ $person->id }}" data-toggle="collapse" data-parent="#accordion{{ $person->id }}" href="#collapse0{{ $person->id }}">{{ $person->sex === 1 ? 'Male' : 'Female'}}</td>
          <td class="accordion-toggle collapsed" id="accordion{{ $person->id }}" data-rownumber="{{ $person->id }}" data-toggle="collapse" data-parent="#accordion{{ $person->id }}" href="#collapse0{{ $person->id }}">{{ $person->dob }}</td>
          <td><a href="{{ route('person.edit', ['role' => $role, 'person' => $person->id] ) }}">
          <button href="{{ route('person.edit', ['role' => $role, 'person' => $person->id] ) }}" type="button" class="btn btn-primary">Edit</button></a></td>
          <td><button id="deletebutton{{ $person->id }}" class="btn btn-danger" data-personname="{{$person->name}}" data-roleid="{{$person->role}}" data-perid="{{$person->id}}" data-toggle="modal" data-target="#delete">Delete</button></td>
        </tr>
        <tr id="rownumber{{ $person->id }}" class="hide-table-padding hide">
          <!-- <td></td> -->
          <td colspan="4">
            <div id="collapse0{{ $person->id }}" class="collapse p-3">
              <!-- <div class="row"> -->
                <div class="col-8">{{ $person->bio }}</div>
              <!-- </div> -->
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div id="delete" class="modal modal-danger fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:55%;">
      <form action="{{ route('person.destroy', ['role' => $role, 'person' => 0] )}}" method="post" >
        {{method_field('delete')}}
        {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <h4>You Want You Sure Delete This {{ ucfirst($role) }}?</h4>
                <input type="hidden" name="person_id" id="per_id" value="">
                <input type="hidden" name="role" id="rol_id" value="">
                <input type="hidden" name="name" id="per_name" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Yes</button>
            </div>
        </div>
      </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("[id^=accordion]").click(function(){
      var rownumber = $(this).data('rownumber');
      console.log(rownumber);
      if($("#rownumber"+rownumber).hasClass("hide")){
          $("#rownumber"+rownumber).removeClass("hide");
      } else {
        setTimeout(
          function()
          {
            $("#rownumber"+rownumber).addClass("hide");
          }, 200);
      }
    });
    $('[id^=deletebutton]').click(function () {
        var button = $(this);
        var personid = button.data('perid');
        var roleid = button.data('rolid');
        var pername = button.data('personname');
        $('#per_id').val(personid);
        $('#rol_id').val(roleid);
        $('#per_name').val(pername);
    });
});
</script>
@endsection
