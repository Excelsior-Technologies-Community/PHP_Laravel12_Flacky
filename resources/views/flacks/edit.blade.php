@extends('flacks.layout')

@section('title', 'Edit Flack')

@section('content')

<div class="w-full md:w-2/5 mx-auto mt-10">

    <div class="bg-white dark:bg-slate-800 p-8 rounded-xl shadow-md">

        <form action="{{ route('flacks.update', $flack->id) }}" method="POST">

            @csrf
            @method('PUT')

            <label class="text-slate-600 dark:text-slate-300 text-sm">Title</label>

            <input
                type="text"
                name="title"
                value="{{ $flack->title }}"
                class="w-full p-3 mt-2 mb-5 rounded-md border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
            >

            <label class="text-slate-600 dark:text-slate-300 text-sm">Description</label>

            <textarea
                name="body"
                rows="5"
                class="w-full p-3 mt-2 mb-5 rounded-md border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
            >{{ $flack->body }}</textarea>

            <label class="text-slate-600 dark:text-slate-300 text-sm">Status</label>

            <select
                name="status"
                class="w-full p-3 mt-2 mb-5 rounded-md border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
            >
                <option value="Draft" {{ $flack->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="Published" {{ $flack->status == 'Published' ? 'selected' : '' }}>Published</option>
            </select>

            <button class="bg-gradient-to-r from-orange-400 to-yellow-400 text-white px-5 py-2.5 rounded-full hover:scale-105 transition">
                Update Flack
            </button>

        </form>

        <a href="{{ route('flacks.index') }}" class="inline-block mt-3 text-slate-700 dark:text-slate-300">
            ← Back
        </a>

    </div>

</div>

@endsection