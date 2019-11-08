<?php

use Illuminate\Http\Request;

/**
 * -------------------------------------------------------------------
 * API for Question
 * -------------------------------------------------------------------
 */

// Get All Question
Route::get('questions', 'QuestionController@index');

// Get Single Question with Answer
Route::get('questions/{question}', 'QuestionController@show');

// Store a Question
Route::post('questions', 'QuestionController@store');

// Update a Question
Route::put('questions/{question}', 'QuestionController@update');

// Get Answer against A Question
Route::get('questions/{question}/answer', 'QuestionController@answer');

/**
 * -------------------------------------------------------------------
 * API for Answer
 * -------------------------------------------------------------------
 */

// Get All Answer
Route::get('answers', 'AnswerController@index');

// Get Single Answer
Route::get('answers/{answer}', 'AnswerController@show');

// Store An Answer against A Question
Route::post('questions/{question}/answer', 'AnswerController@store');

// Update a Question
Route::put('answers/{answer}', 'AnswerController@update');
