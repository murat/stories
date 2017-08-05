<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Story;
use App\Comment;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user = null)
    {
        $stories = Story::with('comments')->orderBy('created_at', 'desc');
        if ($user) {
            if (is_numeric($user)) {
                $user = User::find($user);
            } else {
                $user = User::where('slug', '=', $user)->first();
            }
            $stories = $stories->where('user_id', '=', $user->id);
        }

        return view('stories.index', [
            'user' => $user,
            'stories' => $stories->get(),
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

    public function vote(Request $request, $id, $type = 'upvote')
    {
        $story = Story::find($id);
        $user = User::find($request->input('user'));

        try {
            if ($type == 'upvote') {
                $vote = \App\Vote::create(['user_id' => $user->id, 'story_id' => $story->id, 'vote_type' => 'up']);
                $story->upvote_count += 1;
            } else {
                $vote = \App\Vote::create(['user_id' => $user->id, 'story_id' => $story->id, 'vote_type' => 'down']);
                $story->downvote_count += 1;
            }

            $story->save();

            return response()->json([
                'status' => 'success',
                'message' => "You voted {$story->user->name}'s story. Thanks!",
                'data' => $story,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "We couldn't save your voting for {$story->user->name}'s story. Sorry!",
                'error' => $e->getMessage(),
            ]);
        }
    }
}
