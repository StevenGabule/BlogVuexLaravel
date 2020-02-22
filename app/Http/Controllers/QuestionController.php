<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Question;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());   
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function store(Request $request)
    {
        // $q = auth()->user()->question()->create($request->all());
        $q = Question::create($request->all());
        if ($q) {
            return response()->json(['success' => $q]);
        }
        return response()->json(['failed' => $request->all()]);
    }

    public function update()
    {
        
    }

    public function destroy($slug)
    {
        $q = Question::whereSlug($slug);
        if($q->delete()) {
           return response()->json(['success' => 'Successfully deleted!']);
        }
        return response()->json(['failed' => 'Deleting a question failed to process!']);
    }
}
