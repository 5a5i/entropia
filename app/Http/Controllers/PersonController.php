<?php


namespace App\Http\Controllers;

use App\persons;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Request as Requests;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
      $roles = [
        'producers' => 1,
        'actors' => 2
      ];
      // dd($role);
        // $producer= persons::select('id','name')->where('role', '1')->get();
        // $actor= persons::select('id','name')->where('role', '2')->get();
        // if($role == 'producer'){
        // $persons= persons::where('role', '1')->get();
        // } else {
        // $persons= persons::where('role', '2')->get();
        // }
        // dd($persons);

        $persons= persons::where('role', $roles[$role])->get();

        return view('persons',compact('persons','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($role)
    {
        return view('add',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $role)
    {
    //     if ($request->input('person_role') == 1){
    //     $this->validate($request, [
    //         'producer_name' => 'required',
    //         'producer_sex' => 'required',
    //         'producer_dob' => 'required',
    //         'producer_bio' => 'required'
    //     ]
    // );
    //     $persons = new persons();
    //
    // $persons->name = $request->input('producer_name');
    // $persons->sex = $request->input('producer_sex');
    // $persons->dob = $request->input('producer_dob');
    // $persons->bio = $request->input('producer_bio');
    // $persons->role = "1";
    // $persons->save();
    // if($request->input('producer_submit') == "add_producer"){
    //
    //   return redirect()->action('MovieController@create')->with('message','Producers Information Successfully Added !');
    // } else {
    //
    //   return Redirect::back()->with('message','Producers Information Successfully Added !');
    // }
    //
    // } elseif ($request->input('person_role') == 2){
    // dd($role);
      $this->validate($request, [
          'name' => 'required',
          'sex' => 'required',
          'dob' => 'required',
          'bio' => 'required'
      ]);

      $persons = new persons();
      $persons->name = $request->input('name');
      $persons->sex = $request->input('sex');
      $persons->dob = $request->input('dob');
      $persons->bio = $request->input('bio');
      $persons->role = $request->input('role');
      $persons->save();
      return redirect($role.'/person')->with('message',ucfirst($role).' Information Successfully Added !');
    // }

    /*return Redirect::to('/');*/

    /* return back()->withInput();*/
    /*return redirect('dashboard')->with('status', 'Profile updated!');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role,$id)
    {
        $person= persons::where('id', $id)->first();
        return view('edit',compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role, $id)
    {
      // dd($request);
      $this->validate($request, [
        'name' => 'required',
        'sex' => 'required',
        'dob' => 'required',
        'bio' => 'required'
      ]);
      persons::where('id', $id)
      ->update(['name' => $request->name,
                'sex' => $request->sex,
                'dob' => $request->dob,
                'bio' => $request->bio
                 ]);

       $rolename = $request->role === 1 ? 'producers' : 'actors';
       // $role = $request->role;
       // $persons= persons::where('role', $request->role)->get();

       return redirect($rolename.'/person')->with('message',ucfirst(substr($rolename, 0, -1)).' '.ucfirst($request->name).'\'s Information Updated Successfully !');
       // return view('persons',compact('persons','role'))->with('message','Updated Successfully !');
       // return route('persons',$role)->with('message','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $role, $id)
    {
      // dd($request);
      $person= persons::where('id', $request->person_id)->forceDelete();
      // $casts = casts::where('movie_id', $request->movie_id)->forceDelete();
      $rolename = $request->role === 1 ? 'producers' : 'actors';
      return redirect($rolename.'/person')->with('message',ucfirst(substr($rolename, 0, -1)).' '.ucfirst($request->name).' Deleted Successfully !');
      // return redirect()->action('MovieController@index')->with('message','Movie Deleted Successfully !');
    }
}
