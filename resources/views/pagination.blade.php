<?php
$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
?>

        <div class="row thumbnail">
          @foreach($movies as $movie)
            <div class="col-lg-3 thumbnail">
                <a href="{{ route('movies.show', $movie->id) }}">
                    <img class="img-rounded" style="width:300px; height:200px; " src="images/{{ $movie->id }}.{{ $movie->poster }}" alt="">
                <h3>
                {{ $movie->name }}
                </h3>
                </a>
                <h4>
                  {{ $movie->year }}
                </h4>
            <h5>
              Producer: {{ $movie->producer_name }}
            </h5>
            <h5>
              Cast:
            </h5>
              <ul>
              @foreach($casts[$movie->id] as $cast)
                <li> {{ $cast->name }}</li>
              @endforeach
              </ul>
                <a href="{{ route('movies.edit', $movie->id ) }}">
                <button href="{{ route('movies.edit', $movie->id) }}" type="button" class="btn btn-primary">Edit</button></a>
                <button id="deletebutton" class="btn btn-danger" data-movid="{{$movie->id}}" data-posid="images/{{ $movie->id }}.{{ $movie->poster }}" data-toggle="modal" data-target="#delete">Delete</button>
            </div>
<?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row thumbnail">';
?>
          @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: center;">
              {{ $movies->links() }}
            </div>
        </div>
