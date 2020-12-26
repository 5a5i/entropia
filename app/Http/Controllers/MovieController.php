<?php

namespace App\Http\Controllers;

use App\movies;
use App\persons;
use App\casts;
use App\v_casts;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Storage;
use File;
use DB;
use Illuminate\Support\Facades\Input;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $movies= movies::join('persons', 'persons.id', '=', 'movies.producer_id')
          ->select('movies.*', 'persons.name as producer_name')->paginate(8);
      $casts = [];
      foreach ($movies as $movie) {
        // $cast = casts::where('casts.movie_id',$movies->id)->get();
        // $cast_ids = explode(',', $cast[0]->actor_id);
        $cast_ids = explode(',', $movie->actor_id);
        $casts[$movie->id] = persons::whereIn('persons.id',$cast_ids)->get();
      }
      return view('welcome',compact('movies','casts'));
    }

    public function fetch_data(Request $request)
    {
      if($request->ajax()){
      $movie= movies::join('persons', 'persons.id', '=', 'movies.producer_id')
          ->select('movies.*', 'persons.name as producer_name')->paginate(8);
      $casts= v_casts::select('movie_id','actor_id','name as cast_name')->get();
      return view('pagination',compact('movie','casts'))->render();
      }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producer= persons::select('id','name')->where('role', '1')->get();
        $actor= persons::select('id','name')->where('role', '2')->get();
        // dd($producer);
        return view('create',compact('producer','actor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->input('producer_submit'));
      if($request->input('producer_submit') == "add_producer"){
            self::addProducer($request);
          return redirect()->action('MovieController@create')->withInput(Input::all())->with('message','Producers Information Successfully Addeds !');
        } elseif($request->input('actor_submit') == "add_actor"){
            self::addActor($request);
        return redirect()->action('MovieController@create')->withInput(Input::all())->with('message','Actors Information Successfully Added !');
        } else {
          $this->validate($request, [
          'movie_name' => 'required',
          'year' => 'required',
          'plot' => 'required',
          'producer' => 'required',
          'actors' => 'required',
          'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      $movie = new movies();

      $movie->name = $request->input('movie_name');
      $movie->year = $request->input('year');
      $movie->plot = $request->input('plot');
      $movie->poster = $request->file('poster')->getClientOriginalExtension();
      $movie->producer_id = $request->input('producer');
      $movie->actor_id = implode(',',$request->input('actors'));
      $movie->save();

      // $casts = new casts();
      //
      // $casts->movie_id = $movie->id;
      // $casts->actor_id = implode(',',$request->input('actors'));
      // $casts->save();

      if ($request->hasFile('poster')) {
          $image = $request->file('poster');
          $name = $movie->id.'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/images');
          $image->move($destinationPath, $name);
      }
      return redirect()->action('MovieController@index')->with('message','Movie Successful !');


      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProducer(Request $request)
    {
      $this->validate($request, [
          'producer_name' => 'required',
          'producer_sex' => 'required',
          'producer_dob' => 'required',
          'producer_bio' => 'required'
        ]
      );
      $persons = new persons();
      $persons->name = $request->input('producer_name');
      $persons->sex = $request->input('producer_sex');
      $persons->dob = $request->input('producer_dob');
      $persons->bio = $request->input('producer_bio');
      $persons->role = "1";
      $persons->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addActor(Request $request)
    {
      $this->validate($request, [
        'actor_name' => 'required',
        'actor_sex' => 'required',
        'actor_dob' => 'required',
        'actor_bio' => 'required'
      ]);
      $persons = new persons();
      $persons->name = $request->input('actor_name');
      $persons->sex = $request->input('actor_sex');
      $persons->dob = $request->input('actor_dob');
      $persons->bio = $request->input('actor_bio');
      $persons->role = "2";
      $persons->save();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie= movies::join('persons', 'persons.id', '=', 'movies.producer_id')
            ->select('movies.*', 'persons.name as producer_name')
            ->where('movies.id', $id)
            ->first();
        // $actor= persons::join('v_casts', 'persons.id', '=', 'v_casts.actor_id')->select('persons.id','persons.name')->where('v_casts.movie_id', $id)->get();

          // $casts = [];

          $cast_ids = explode(',', $movie->actor_id);
          $casts = persons::whereIn('persons.id',$cast_ids)->get();

        return view('view',compact('movie','casts'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie= movies::select('*')->where('movies.id', $id)->first();
        // $casts= v_casts::select('movie_id','actor_id')->where('movie_id', $id)->get();
        $casts = explode(',', $movie->actor_id);
        // $casts = persons::whereIn('persons.id',$cast_ids)->get();
        $producers= persons::select('id','name')->where('role', '1')->get();
        $actors= persons::select('id','name')->where('role', '2')->get();
        return view('update',compact('movie','producers','actors','casts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // dd($request->input('producer_submit'));
      if($request->input('producer_submit') == "add_producer"){
            self::addProducer($request);
          return redirect()->action('MovieController@create')->withInput(Input::all())->with('message','Producers Information Successfully Addeds !');
        } elseif($request->input('actor_submit') == "add_actor"){
            self::addActor($request);
        return redirect()->action('MovieController@create')->withInput(Input::all())->with('message','Actors Information Successfully Added !');
        } else {
          if ($request->hasFile('poster')){
              $this->validate($request, [
              'movie_name' => 'required',
              'year' => 'required',
              'plot' => 'required',
              'producer' => 'required',
              'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);

              $image_path = 'images/'.$request->movie_id.'.'.$request->poster.'';
              if(File::exists($image_path)) {
              File::delete($image_path);

              $image = $request->file('poster');
              $name = $movie->id.'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/images');
              $image->move($destinationPath, $name);
          }
          movies::where('id', $id)
          ->update(['name' => $request->movie_name,
                    'year' => $request->year,
                    'plot' => $request->plot,
                    'poster' => $request->file('poster')->getClientOriginalExtension(),
                    'producer_id' => $request->producer,
                    'actor_id' => implode(',',$request->actors)
                     ]);
          } else {
              $this->validate($request, [
              'movie_name' => 'required',
              'year' => 'required',
              'plot' => 'required',
              'producer' => 'required'
          ]);

          movies::where('id', $id)
          ->update(['name' => $request->movie_name,
                    'year' => $request->year,
                    'plot' => $request->plot,
                    'producer_id' => $request->producer,
                    'actor_id' => implode(',',$request->actors)
                     ]);
          }
          // casts::where('movie_id', $id)
          // ->update(['actor_id' => implode(',',$request->actors)
          //            ]);
          return redirect()->action('MovieController@index')->with('message','Movie Updated Successfully !');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $movie= movies::where('id', $request->movie_id)->forceDelete();
      // $casts = casts::where('movie_id', $request->movie_id)->forceDelete();
      $image_path = 'images/'.$request->movie_id.'.'.$request->poster.'';
      if(File::exists($image_path)) {
      File::delete($image_path);
      }
      return redirect()->action('MovieController@index')->with('message','Movie Deleted Successfully !');
    }
}
