<?php
// app/Http/Controllers/PollController.php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

class PollController extends Controller
{
    // Show all active polls
    public function index()
    {
        $polls = Poll::with('options')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layouts.newsDashboard.poll.index', compact('polls'));
    }

    // Show single poll
    public function showModal(Poll $poll)
    {
        // Debug: Check what data is available
        $poll->load(['options' => function ($query) {
            $query->withCount('votes');
        }, 'votes']);

        // Uncomment below to debug
        // dd($poll->toArray());

        return view('layouts.newsDashboard.poll.poll-content', compact('poll'));
    }

    // Submit vote
    public function vote(Request $request, $id)
    {
        $request->validate([
            'option_id' => 'required|exists:poll_options,id'
        ]);

        $poll = Poll::findOrFail($id);

        // Check if poll is expired
        if ($poll->isExpired()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'এই ভোট সমাপ্ত হয়ে গেছে'
                ], 400);
            }
            return back()->with('error', 'এই ভোট সমাপ্ত হয়ে গেছে');
        }

        // Check if IP already voted
        if ($poll->hasIpVoted($request->ip())) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'আপনি ইতিমধ্যে ভোট দিয়েছেন'
                ], 400);
            }
            return back()->with('error', 'আপনি ইতিমধ্যে ভোট দিয়েছেন');
        }

        // Verify option belongs to this poll
        $option = PollOption::where('id', $request->option_id)
            ->where('poll_id', $poll->id)
            ->firstOrFail();

        try {
            DB::beginTransaction();

            // Create vote (without user_id)
            PollVote::create([
                'poll_id' => $poll->id,
                'poll_option_id' => $option->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Increment vote count
            $option->increment('votes_count');

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'আপনার ভোট সফলভাবে জমা হয়েছে'
                ]);
            }
            return back()->with('success', 'আপনার ভোট সফলভাবে জমা হয়েছে');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'ভোট জমা দিতে সমস্যা হয়েছে'
                ], 500);
            }
            return back()->with('error', 'ভোট জমা দিতে সমস্যা হয়েছে');
        }
    }

    // Admin: Store new poll
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'question_bn' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expires_at'  => 'required|date|after:now',
            'options'     => 'required|array|min:2',
            'options.*.text_bn' => 'required|string|max:255',
            'options.*.text_en' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // ✅ Prepare poll data
            $pollData = [
                'question_bn' => $request->question_bn,
                'question_en' => $request->question_en,
                'expires_at'  => Carbon::parse($request->expires_at)->format('Y-m-d H:i:s'),
                'created_by'  => Auth::id(),
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => null,
            ];

            // ✅ Handle image upload
            if ($request->hasFile('image')) {
                $imageManager = new ImageManager(new Driver());

                $imageName = uniqid() . '_' . time() . '.' . $request->image->getClientOriginalExtension();
                $width  = 800;
                $height = 450;

                if (!file_exists(public_path('uploads/polls_photos'))) {
                    mkdir(public_path('uploads/polls_photos'), 0755, true);
                }

                // Crop or resize the image
                $pollImage = $imageManager->read($request->image)->cover($width, $height);
                $pollImage->save(public_path('uploads/polls_photos/' . $imageName), 95);

                $pollData['image'] = 'uploads/polls_photos/' . $imageName;
            }

            // ✅ Create poll
            $poll = Poll::create($pollData);

            // ✅ Create poll options
            foreach ($request->options as $optionData) {
                PollOption::create([
                    'poll_id'        => $poll->id,
                    'option_text_bn' => $optionData['text_bn'],
                    'option_text_en' => $optionData['text_en'],
                    'votes_count'    => 0,
                ]);
            }

            DB::commit();

            flash()->addSuccess('Poll created successfully', [
                'position' => 'bottom-center',
            ]);

            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Poll creation failed: ' . $e->getMessage());

            flash()->addError('Failed to create poll: ' . $e->getMessage(), [
                'position' => 'bottom-center',
            ]);

            return back()->withInput();
        }
    }

    // Admin: Edit And Update
    public function edit($id)
    {
        $poll = Poll::with('options')->findOrFail($id);

        // Check if poll is expired
        if ($poll->isExpired()) {
            flash()->addWarning('This poll has already expired', [
                'position' => 'bottom-center',
            ]);
        }

        return view('layouts.newsDashboard.poll.edit', compact('poll'));
    }

    public function update(Request $request, $id)
    {
        // Decode deleted_options if it's a JSON string
        if ($request->has('deleted_options') && is_string($request->deleted_options)) {
            $request->merge([
                'deleted_options' => json_decode($request->deleted_options, true) ?: []
            ]);
        }

        // Get the poll
        $poll = Poll::findOrFail($id);

        // Validation
        $request->validate([
            'question_bn'       => 'required|string|max:255',
            'question_en'       => 'required|string|max:255',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expires_at'        => 'nullable|date',
            'options'           => 'required|array|min:2',
            'options.*.id'      => 'nullable|exists:poll_options,id',
            'options.*.text_bn' => 'required|string|max:255',
            'options.*.text_en' => 'required|string|max:255',
            'deleted_options'   => 'nullable|array',
            'deleted_options.*' => 'exists:poll_options,id',
        ]);

        try {
            DB::beginTransaction();

            // Update poll fields
            $poll->question_bn = $request->question_bn;
            $poll->question_en = $request->question_en;

            // ✅ Only update expires_at if user explicitly provided a new value
            if ($request->filled('expires_at')) {
                $poll->expires_at = Carbon::parse($request->expires_at)->format('Y-m-d H:i:s');
            }
            // else: Don't touch expires_at - it will keep its current value automatically

            // Handle image upload and resize
            if ($request->hasFile('image')) {
                $imageManager = new ImageManager(new Driver());

                // Delete old image if exists
                if ($poll->image && file_exists(public_path($poll->image))) {
                    @unlink(public_path($poll->image));
                }

                $imageName = uniqid() . '_' . time() . '.' . $request->image->getClientOriginalExtension();

                $width = 800;
                $height = 450;

                if (!file_exists(public_path('uploads/polls_photos'))) {
                    mkdir(public_path('uploads/polls_photos'), 0755, true);
                }

                $pollImage = $imageManager->read($request->image)->cover($width, $height);
                $pollImage->save(public_path('uploads/polls_photos/' . $imageName), 95);

                $poll->image = 'uploads/polls_photos/' . $imageName;
            }

            $poll->save();

            // Delete removed options
            if ($request->filled('deleted_options') && is_array($request->deleted_options)) {
                PollOption::whereIn('id', $request->deleted_options)->delete();
            }

            // Update existing or create new options
            foreach ($request->options as $optionData) {
                if (!empty($optionData['id'])) {
                    PollOption::where('id', $optionData['id'])->update([
                        'option_text_bn' => $optionData['text_bn'],
                        'option_text_en' => $optionData['text_en'],
                    ]);
                } else {
                    PollOption::create([
                        'poll_id'        => $poll->id,
                        'option_text_bn' => $optionData['text_bn'],
                        'option_text_en' => $optionData['text_en'],
                        'votes_count'    => 0,
                    ]);
                }
            }

            DB::commit();

            flash()->addSuccess('Poll updated successfully', [
                'position' => 'bottom-center',
            ]);

            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Poll update failed: ' . $e->getMessage());

            return back()->withInput()
                ->withErrors(['error' => 'Failed to update poll: ' . $e->getMessage()]);
        }
    }



    // Admin: Delete poll
    public function destroy($id)
    {
        $poll = Poll::findOrFail($id);

        // Delete poll main image
        if (!empty($poll->image) && file_exists(public_path($poll->image))) {
            @unlink(public_path($poll->image));
        }

        // Delete images of all poll options
        foreach ($poll->options as $option) {
            if (!empty($option->image) && file_exists(public_path($option->image))) {
                @unlink(public_path($option->image));
            }
        }

        // Delete poll from DB
        $poll->delete();

        // Flash success message
        flash()->addSuccess('Poll এবং সংশ্লিষ্ট সব ইমেজ সফলভাবে মুছে ফেলা হয়েছে!', [
            'position' => 'bottom-center',
        ]);

        return back();
    }
}
