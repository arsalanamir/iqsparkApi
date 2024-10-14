<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAttempts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    public function attempt(Request $request, $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'selected_answer' => 'required|string|in:option_a,option_b,option_c,option_d,option_e,option_f',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        // Check if the selected answer is correct
        $isCorrect = $question->ans === $request->selected_answer;

        return response()->json([
            'question_id' => $id,
            'is_correct'  => $isCorrect,
            'correct_answer' => $question->ans
        ]);
    }

    public function calculatePercentage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attempts' => 'required|array',
            'attempts.*.question_id' => 'required|integer|exists:questions,id',
            'attempts.*.selected_answer' => 'required|string|in:option_a,option_b,option_c,option_d,option_e,option_f',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $correctAnswers = [];
        $correctCount = 0;
        $total = Question::get()->count();

        foreach ($request->attempts as $attempt) {
            $question = Question::find($attempt['question_id']);

            if ($question && $question->ans === $attempt['selected_answer']) {
                $correctAnswers[] = [
                    'question_id' => $attempt['question_id'],
                    'correct_answer' => $question->ans,
                ];
                $correctCount++;
            }
        }



        // Calculate the percentage based on a total of 40 questions
        $baseline_iq = 80;
        $desired_maximum_iq = 150;
        $percentage_correct = ($correctCount / $total);
        $percentage = $baseline_iq + $percentage_correct * ($desired_maximum_iq - $baseline_iq);

        return response()->json([
            'total_questions' => $total,
            'attempted_questions' => count($request->attempts),
            'correct_attempts' => $correctCount,
            'correct_answers' => $correctAnswers, // Returning correct answers array
            'percentage' => $percentage,
        ]);
    }

    public function saveUserData(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_attempts,email', // Ensure email is unique
            'total_questions' => 'required|integer',
            'attempted_questions' => 'required|integer',
            'correct_attempts' => 'required|integer',
            'percentage' => 'required|numeric|min:0|max:150', // Validate percentage range
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $total = Question::get()->count();
        // Prepare data to save
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'total_questions' => $total,
            'attempted_questions' => $request->attempted_questions,
            'correct_attempts' => $request->correct_attempts,
            'percentage' => $request->percentage,
        ];
        // Create a new user record
        UserAttempts::create($data);

        return response()->json([
            'message' =>
            'Data saved successfully.',
            'data' => $data
        ]);
    }
}
