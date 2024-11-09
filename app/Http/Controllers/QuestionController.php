<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\ContectUs;
use App\Models\UserAttempts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    // Get all questions
    public function index()
    {
        $questions = Question::all()->map(function ($question) {
            return [
                'id' => $question->id,
                'question_text' => $question->question_text,
                'question_image' => $question->question_image,
                'options' => [
                    'option_a' => $question->option_a,
                    'option_b' => $question->option_b,
                    'option_c' => $question->option_c,
                    'option_d' => $question->option_d,
                    'option_e' => $question->option_e,
                    'option_f' => $question->option_f,
                ],
                'ans' => $question->ans,
                'created_at' => $question->created_at,
                'updated_at' => $question->updated_at,
            ];
        });

        return response()->json([
            'questions' => $questions
        ]);
    }

    // Store a new question
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'question_text' => 'required|string', // Text of the question is required
            'question_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image of the question is required
            'option_a' => 'nullable|string',
            'option_a_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_b' => 'nullable|string',
            'option_b_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_c' => 'nullable|string',
            'option_c_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_d' => 'nullable|string',
            'option_d_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_e' => 'nullable|string',
            'option_e_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_f' => 'nullable|string',
            'option_f_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ans' => 'required|string|in:option_a,option_b,option_c,option_d,option_e,option_f', // Correct answer is required
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }

        // dd($request->all());

        // Save images if provided
        $questionImage = $request->file('question_image')->store('questions', 'public');

        $optionAImage = $request->hasFile('option_a_image')
            ? $request->file('option_a_image')->store('questions', 'public')
            : null;

        $optionBImage = $request->hasFile('option_b_image')
            ? $request->file('option_b_image')->store('questions', 'public')
            : null;

        $optionCImage = $request->hasFile('option_c_image')
            ? $request->file('option_c_image')->store('questions', 'public')
            : null;

        $optionDImage = $request->hasFile('option_d_image')
            ? $request->file('option_d_image')->store('questions', 'public')
            : null;

        $optionEImage = $request->hasFile('option_e_image')
            ? $request->file('option_e_image')->store('questions', 'public')
            : null;

        $optionFImage = $request->hasFile('option_f_image')
            ? $request->file('option_f_image')->store('questions', 'public')
            : null;


        // Create new question
        $question = Question::create([
            'question_text' => $request->question_text,
            'question_image' => $questionImage,
            'option_a' => $request->option_a ?? $optionAImage,
            'option_b' => $request->option_b ?? $optionBImage,
            'option_c' => $request->option_c ?? $optionCImage,
            'option_d' => $request->option_d ?? $optionDImage,
            'option_e' => $request->option_e ?? $optionEImage,
            'option_f' => $request->option_f ?? $optionFImage,

            'ans' => $request->ans,
        ]);

        return response()->json([
            'message' => 'Question created successfully!',
            'question' => $question,
        ]);
    }

    // Show a single question by ID
    public function show($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        return response()->json([
            'question' => [
                'id' => $question->id,
                'question_text' => $question->question_text,
                'question_image' => $question->question_image,
                'options' => [
                    'option_a' => $question->option_a,
                    'option_b' => $question->option_b,
                    'option_c' => $question->option_c,
                    'option_d' => $question->option_d,
                    'option_e' => $question->option_e,
                    'option_f' => $question->option_f,
                ],
                'ans' => $question->ans,
                'created_at' => $question->created_at,
                'updated_at' => $question->updated_at,
            ]
        ]);
    }

    // Update a question
    public function update(Request $request)
    {
        // Validate the incoming request

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'question_text' => 'required|string', // Text of the question is required
            'question_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image of the question is required
            'option_a' => 'nullable|string',
            'option_a_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_b' => 'nullable|string',
            'option_b_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_c' => 'nullable|string',
            'option_c_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_d' => 'nullable|string',
            'option_d_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_e' => 'nullable|string',
            'option_e_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_f' => 'nullable|string',
            'option_f_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ans' => 'required|string|in:option_a,option_b,option_c,option_d,option_e,option_f', // Correct answer is required
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $id = $request->id;
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        // Update question image if provided
        if ($request->hasFile('question_image')) {
            // Delete the old image
            if ($question->question_image && Storage::exists('public/' . $question->question_image)) {
                Storage::delete('public/' . $question->question_image);
            }
            $question->question_image = $request->file('question_image')->store('questions', 'public');
        }
        // Update option images if provided
        if ($request->hasFile('option_a_image')) {
            // Delete the old image
            if ($question->option_a_image && Storage::exists('public/' . $question->option_a_image)) {
                Storage::delete('public/' . $question->option_a_image);
            }
            $question->option_a = $request->hasFile('option_a_image')
                ? $request->file('option_a_image')->store('questions', 'public')
                : $request->option_a;
        } else {
            $question->option_a = $request->option_a;
        }

        if ($request->hasFile('option_b_image')) {
            // Delete the old image
            if ($question->option_b_image && Storage::exists('public/' . $question->option_b_image)) {
                Storage::delete('public/' . $question->option_b_image);
            }
            $question->option_b = $request->hasFile('option_b_image')
                ? $request->file('option_b_image')->store('questions', 'public')
                : $request->option_b;
        } else {
            $question->option_b = $request->option_b;
        }
        if ($request->hasFile('option_c_image')) {
            // Delete the old image
            if ($question->option_c_image && Storage::exists('public/' . $question->option_c_image)) {
                Storage::delete('public/' . $question->option_c_image);
            }
            $question->option_c = $request->hasFile('option_c_image')
                ? $request->file('option_c_image')->store('questions', 'public')
                : $request->option_c;
        } else {
            $question->option_c = $request->option_c;
        }
        if ($request->hasFile('option_d_image')) {
            // Delete the old image
            if ($question->option_d_image && Storage::exists('public/' . $question->option_d_image)) {
                Storage::delete('public/' . $question->option_c_image);
            }
            $question->option_d = $request->hasFile('option_d_image')
                ? $request->file('option_d_image')->store('questions', 'public')
                : $request->option_d;
        } else {
            $question->option_d = $request->option_d;
        }
        if ($request->hasFile('option_e_image')) {
            // Delete the old image
            if ($question->option_e_image && Storage::exists('public/' . $question->option_e_image)) {
                Storage::delete('public/' . $question->option_e_image);
            }
            $question->option_e = $request->hasFile('option_e_image')
                ? $request->file('option_e_image')->store('questions', 'public')
                : $request->option_e;
        } else {
            $question->option_e = $request->option_e;
        }
        if ($request->hasFile('option_f_image')) {
            // Delete the old image
            if ($question->option_f_image && Storage::exists('public/' . $question->option_f_image)) {
                Storage::delete('public/' . $question->option_f_image);
            }
            $question->option_f = $request->hasFile('option_f_image')
                ? $request->file('option_f_image')->store('questions', 'public')
                : $request->option_f;
        } else {
            $question->option_f = $request->option_f;
        }

        // Update the question text and options if provided
        $question->question_text = $request->question_text;
        $question->question_image = $question->question_image;
        $question->option_a = $question->option_a;
        $question->option_b = $question->option_b;
        $question->option_c = $question->option_c;
        $question->option_d = $question->option_d;
        $question->option_e = $question->option_e;
        $question->option_f = $question->option_f;

        $question->ans = $question->ans;

        // dd($request->hasFile('option_d_image'));
        $question->save();

        return response()->json([
            'message' => 'Question updated successfully!',
            'question' => $question,
        ]);
    }

    // Delete a question
    public function destroy($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted successfully']);
    }
    public function contectUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255',
            'comments' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        // dd($request->all());
        // Create a new contact record
        $contact = ContectUs::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'comments' => $request->comments,
        ]);
        // Admin email address
        $adminEmail = 'iqspark.org@gmail.com';  // Replace with your admin email

        // Send an email to the admin with contact details
        Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($adminEmail) {
            $message->to($adminEmail);
            $message->subject('You have a new Query');
        });

        return response()->json([
            'message' => 'Message sended successfully!',
            'contact' => $contact,
        ]);
    }
}
