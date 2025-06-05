@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-2">Welcome, {{ Auth::user()->name }}</h2>
            <p class="text-gray-700 mb-4">Here's an overview of your account and recent activity.</p>
            <a href="{{ route('profile') }}" class="text-blue-500 hover:underline">View Profile</a>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-2">Statistics</h2>
            <ul class="text-gray-700 list-disc list-inside">
                <li>Total Projects: {{ $totalProjects ?? 0 }}</li>
                <li>Pending Tasks: {{ $pendingTasks ?? 0 }}</li>
                <li>Completed Tasks: {{ $completedTasks ?? 0 }}</li>
            </ul>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-2">Recent Activity</h2>
            <ul class="text-gray-700 list-disc list-inside max-h-48 overflow-y-auto">
                @forelse($recentActivities ?? [] as $activity)
                    <li>{{ $activity }}</li>
                @empty
                    <li>No recent activity.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

