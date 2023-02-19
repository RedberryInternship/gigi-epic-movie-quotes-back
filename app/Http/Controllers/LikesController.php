<?php

namespace App\Http\Controllers;

use App\Events\SendNotification;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index()
    {
        return response()->json(['likes' => Like::all()]);
    }

    public function store(Request $request)
    {
        $like = Like::create([
            'user_id' => auth()->user()->id,
            'quote_id' =>  $request['quote_id'],
        ]);
        $notification = (object)[
            'user_id' => Quote::where('id', $like->quote_id)->pluck('user_id')->first(),
            'author' => auth()->user()->id,
            'author_profile_picture' => auth()->user()->profile_picture,
            'type' => 'like'
        ];
        event(new SendNotification($notification));
        return response()->json(['message' => $like->id]);
    }

    public function destroy(Request $request)
    {
        Like::where('id', $request['id'])->delete();
        return response()->json(['message' => 'unliked']);
    }
}