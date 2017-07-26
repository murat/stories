<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use Illuminate\Http\Request;
use Auth;
use App\Story;
use App\Comment;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::with('comments')->orderBy('created_at', 'desc')->get();

        return view('stories.index', [
            'stories' => $stories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (Auth::check() && !array_key_exists('user_id', $data)) {
            $data['user_id'] = Auth::user()->id;
        }

        try {
            Story::create($data);

            return redirect()->action('StoriesController@index')
                             ->with('success', 'Story created!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_numeric($id)) {
            $story = Story::find($id)->with('comments');
        } else {
            $story = Story::with('comments')->where('slug', '=', $id)->first();
        }

        return view('stories.show', [
            'story' => $story,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
