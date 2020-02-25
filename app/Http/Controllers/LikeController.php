<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function like(Reply $reply)
    {
        $reply->like()->create(
            ['user_id' => '1']
        );  

        return response()->json(['success' => true]);
    }
    public function unlike(Reply $reply)
    {
        $reply->like()->where(['user_id' => '1'])->first()->delete();
        return response()->json(['success' => true]);
    }
}
