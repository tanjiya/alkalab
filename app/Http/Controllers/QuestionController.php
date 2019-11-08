<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Resources\Question as QuestionResource;
use App\Http\Requests\Question as QuestionRequest;

use Mail;
use App\Mail\LastFiveAnswer;

class QuestionController extends Controller
{
    /**
     * Return All Question in A Paginated JSON response
     */
    public function index()
    {
        $user = auth()->user();
         // Return 2Question in One Page
        $data = $user->questions()->paginate(2);
        $response = new QuestionResource($data);

        return response()->json(['data' => $response], 200);
    }
    
    /**
     * Store A Question in Database
     */
    public function store(QuestionRequest $request)
    {
        $validated = $request->all();
        $validated['user_id'] = auth()->id();

        $question = Question::create($validated);

        // Send Mail to User After Creating A Question
        // Mail::to($question->user->email)->send(
        //     new LastFiveAnswer($question)
        // );

        // Return The Data We have Send
        return response()->json($question, 201);
    }

    /**
     * Return Single Question with Answer
     */
    public function show($id)
    {
        $question = Question::with('answer')->findOrFail($id);

        $this->authorize('view', $question);

        // Side Loaded Data from Two Different Model
        $response['question'] = $question;
        $response['answer'] = $question->answer;

        $response = new QuestionResource($question, 200);

        return response()->json(['data' => $response], 200);
    }

    /**
     * Update A Question in Database
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $this->authorize('view', $question);
        
        $question->update($request->all());

        // Return The Updated Data We have Send
        return response()->json($question, 200);
    }

    public function destroy(Question $question)
    {
        //
    }

    /**
     * Return Answer of A Specific Question Like: http://127.0.0.1:8000/api/questions/1/answer (1 is ID of Question)
     */
    public function answer(Question $question)
    {
        // Answer Method is Defined in Question Model
        $answer = $question->answer;

        return response()->json($answer, 200);
    }

    /**
     * Return The Number of Answer against A Question if The question_type == 'textarea'
     */
    public function countAnswer(Question $question)
    {
        // Answer Method is Defined in Question Model
        $answer = $question->answer;

        if($question->question_type == 'textarea')
        {
            return count($answer);
        }
    }
}
