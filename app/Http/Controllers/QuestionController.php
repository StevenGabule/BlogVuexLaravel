<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Question;
use App\Http\Resources\QuestionResource;
use App\Http\Controllers\Response;
use Symfony\Component\HttpFoundation\Response as Responses;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

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
        $q = auth()->user()->question()->create($request->all());
        if ($q) {
            return response()->json(['success' => $q], Responses::HTTP_CREATED);
        }
        return response()->json(['failed' => $request->all()]);
    }

    public function update(Request $request, Question $question)
    {
        $question->update($request->all());
        return response('Updated', 200);
    }

    public function destroy($slug)
    {
        $q = Question::whereSlug($slug);
        if ($q->delete()) {
            return response()->json(['success' => 'Successfully deleted!']);
        }
        return response()->json(['failed' => 'Deleting a question failed to process!']);
    }
}
