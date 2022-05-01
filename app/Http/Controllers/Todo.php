<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Todo extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        
        $todos = DB::table('todos')->get();
        return view('home', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the form
        $request->validate([
            'todo' => 'required|max:200',
            'due_date' => 'required'
        ]);
    
        // store the data
        DB::table('todos')->insert([
            'todo' => $request->todo,
            'due_date'=> $request->due_date
        ]);
    
        // redirect
        return redirect('/')->with('status', 'todo added!');
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
    public function edit($id)
    {
        //
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
    // validate the form
    $request->validate([
        'todo' => 'required|max:200'
    ]);

    // update the data
    DB::table('todos')->where('id', $id)->update([
        'todo' => $request->todo
    ]);

    // redirect
    return redirect('/')->with('status', 'todo updated!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('todos')->where('id', $id)->delete();

        // redirect
        return redirect('/')->with('status', 'todo removed!');
        }
}
