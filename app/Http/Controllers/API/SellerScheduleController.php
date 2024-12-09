<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerSchedule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;


class SellerScheduleController extends Controller
{
    // Store a new schedule for the seller
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'schedule_date' => 'required|date', //('Y-m-d') 2024-12-24
            'seller_id' => 'required|exists:frontend_users,id', // Ensure seller exists in the users table
        ]);

        if ($validator->fails()) 
        {
            Log::error('Validation Errors:', $validator->errors()->toArray());

            return response()->json($validator->errors(), 422);
        }

        $schedule = SellerSchedule::create($request->only(['title', 'schedule_date', 'seller_id']));

        return response()->json(['message' => 'Schedule created successfully', 'data' => $schedule], 201);
    }

    // Get all schedules for a seller
    public function index($seller_id)
    {
        $schedules = SellerSchedule::where('seller_id', $seller_id)->get();

        if ($schedules->isEmpty()) {
            return response()->json(['message' => 'No schedules found for this seller'], 404);
        }

        return response()->json(['data' => $schedules], 200);
    }

    // Get a specific schedule
    public function show($id)
    {
        $schedule = SellerSchedule::where('seller_id', $id)->first();

        if (!$schedule) 
        {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        return response()->json(['data' => $schedule], 200);
    }

    // Update a seller's schedule
    public function update(Request $request, $id)
    {
        $schedule = SellerSchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'schedule_date' => 'sometimes|required|date',
            'seller_id' => 'sometimes|required|exists:users,id',
        ]);

        $schedule->update($request->only(['title', 'schedule_date', 'seller_id']));

        return response()->json(['message' => 'Schedule updated successfully', 'data' => $schedule], 200);
    }

    // Delete a schedule
    public function destroy($id)
    {
        $schedule = SellerSchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully'], 200);
    }
}