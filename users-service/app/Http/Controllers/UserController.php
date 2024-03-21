<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Validation\ValidationException;
use App\Jobs\UserCreated;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        Log::info('New user created:', $validatedData);

        UserCreated::dispatch(json_encode($validatedData));

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
