<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'goal' => 'required|in:rental,capital,vacation',
        ]);

        // Assign user_id only if the user is authenticated, otherwise set to null
        $validated['user_id'] = auth()->check() ? auth()->id() : null;

        Interest::create($validated);

        // Set session to prevent modal from reappearing
        session(['has_filled_form' => true]);

        
        return response()->json(['success' => true]);
    }
}