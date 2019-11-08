<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Resources\Answer as AnswerResource;
use App\Http\Requests\Answer as AnswerRequest;

class AnswerController extends Controller
{
 
    /**
     * Return All Answer
     */
    public function index()
    {
        $user = auth()->user();
         // Return 2Question in One Page
        $data = $user->answers()->paginate(5);
        $response = new AnswerResource($data);

        return response()->json(['data' => $response], 200);


        // Return 5Answer in One Page
        $data = Answer::paginate(2);

        return response()->json($data, 200);
    }

    /**
     * Store An Answer in Database
     */
    public function store(AnswerRequest $request)
    {
        $validated = $request->all();
        $validated['user_id'] = auth()->id();

        $answer = Answer::create($validated);

        // Return The Data We have Send
        return response()->json($answer, 201);
    }

    /**
     * Return Single Question with Answer
     */
    public function show($id)
    {
        // return response()->json($answer, 200);

        $answer = Answer::findOrFail($id);

        $this->authorize('view', $answer);

        $response = new AnswerResource($answer, 200);

        return response()->json(['data' => $response], 200);
    }

    /**
     * Update An Answer in Database
     */
    public function update(AnswerRequest $request, Answer $answer)
    {
        $this->authorize('view', $answer);
        
        $answer->update($request->all());

        // Return The Updated Data We have Send
        return response()->json($answer, 200);
    }

    public function destroy(Answer $answer)
    {
        //
    }
}
