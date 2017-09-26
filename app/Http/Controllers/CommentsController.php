<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Muratbsts\MailTemplate\MailTemplate as MailTemplate;
use \App\Story;
use \App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $story = Story::where('id', '=', $id)
            ->orWhere('slug', '=', $id)
            ->with('comments')
            ->first();

        try {
            \Validator::make($request->all(), [
                'email' => 'required|email',
                'comment' => 'required',
            ])->validate();

            $data = array();
            $data['story_id'] = $story->id;
            $data['reply_id'] = $request->input('reply_id') ?: null;
            $data['user_id'] = $request->input('user_id') ?: null;
            $data['email'] = $request->input('email');
            $data['comment'] = $request->input('comment');

            $comment = Comment::create($data);

            $story->comments()->save($comment);

            if ($story->has('user')) {

                $mailer = app()->make(MailTemplate::class);

                $mailer->send('emails.notification', [
                    'story' => $story,
                    'comment' => $comment
                ], function ($message) use ($story) {
                    $message->to($story->user->email, $story->user->name)->subject('You have a new notification!');
                });

            }

            return redirect()->back()->with('success', 'Comment created!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Could not create comment because ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
