@extends('flacks.layout')

@section('title', 'Create Flack')

@section('content')

<div class="w-full md:w-2/5 mx-auto mt-10">

    <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-md">

        <form action="{{ route('flacks.store') }}" method="POST">

            @csrf

            <label class="text-slate-600 dark:text-slate-300 text-sm">Title</label>

            <input
                type="text"
                name="title"
                placeholder="Enter title"
                class="w-full p-3 mt-2 mb-5 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
            >

            <label class="text-slate-600 dark:text-slate-300 text-sm">Description</label>

            <textarea
                name="body"
                rows="6"
                placeholder="Enter description"
                class="w-full p-3 mt-2 mb-5 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
            ></textarea>

            <label class="text-slate-600 dark:text-slate-300 text-sm">Status</label>

            <select
                name="status"
                class="w-full p-3 mt-2 mb-5 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
            >
                <option value="Draft">Draft</option>
                <option value="Published">Published</option>
            </select>

            <button class="bg-gradient-to-r from-teal-400 to-purple-500 text-white px-5 py-3 rounded-full hover:scale-105 transition">
                Create Flack
            </button>

        </form>

        <a href="{{ route('flacks.index') }}" class="inline-block mt-4 text-slate-700 dark:text-slate-300">
            ← Back
        </a>

    </div>

</div>

@endsection