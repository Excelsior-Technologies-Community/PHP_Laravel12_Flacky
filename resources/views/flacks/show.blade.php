@extends('flacks.layout')

@section('title', 'View Flack')

@section('content')

<div class="w-full md:w-1/2 mx-auto mt-10">

    <div class="bg-white dark:bg-slate-800 p-9 rounded-2xl shadow-md">

        <div class="text-2xl font-semibold text-slate-800 dark:text-white">
            {{ $flack->title }}
        </div>

        <div class="mt-5 text-slate-600 dark:text-slate-300 leading-loose">
            {{ $flack->body }}
        </div>

        <div class="mt-5 text-sm text-slate-500 dark:text-slate-400">
            Status:
            <span class="inline-block px-4 py-1.5 rounded-full text-white text-xs font-bold {{ $flack->status == 'Draft' ? 'bg-amber-500' : 'bg-green-500' }}">
                {{ $flack->status }}
            </span>
        </div>

        <div class="mt-3 text-sm text-slate-500 dark:text-slate-400">
            Created: {{ $flack->created_at->format('d M Y') }}
        </div>

        <a href="{{ route('flacks.index') }}" class="inline-block mt-6 bg-gradient-to-r from-teal-400 to-purple-500 text-white px-6 py-3 rounded-full hover:scale-105 transition">
            ← Back to List
        </a>

    </div>

</div>

@endsection