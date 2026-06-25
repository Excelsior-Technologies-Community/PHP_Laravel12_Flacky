@extends('flacks.layout')

@section('title', 'Flacky Dashboard')

@section('content')

@if(session('success'))
<div class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 p-4 rounded-lg mb-5">
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-md">
        <h2 class="text-purple-500 dark:text-purple-400 text-4xl font-bold">{{ $totalFlacks }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Total Flacks</p>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-md">
        <h2 class="text-amber-500 dark:text-amber-400 text-4xl font-bold">{{ $draftFlacks }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Draft Flacks</p>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-md">
        <h2 class="text-green-500 dark:text-green-400 text-4xl font-bold">{{ $publishedFlacks }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Published Flacks</p>
    </div>

</div>

<div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-md mb-8 relative">

    <form method="GET" class="flex flex-col md:flex-row gap-4 items-center" id="search-form">

        <div class="relative flex-1 w-full">

            <input
                type="text"
                name="search"
                id="search-input"
                placeholder="Search flacks..."
                value="{{ request('search') }}"
                autocomplete="off"
                class="w-full p-3 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-400"
                onfocus="showHistory()"
            >

            @if(count($searchHistory) > 0)
            <div
                id="search-history-dropdown"
                class="hidden absolute left-0 right-0 top-full mt-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg z-10 max-h-52 overflow-y-auto"
            >

                <div class="flex justify-between items-center px-4 py-2 border-b border-slate-100 dark:border-slate-700">
                    <span class="text-xs text-slate-400">Recent Searches</span>

                    <form action="{{ route('search.history.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-500">Clear</button>
                    </form>
                </div>

                @foreach($searchHistory as $term)
                <div
                    class="px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer"
                    onclick="selectHistory('{{ $term }}')"
                >
                    🕒 {{ $term }}
                </div>
                @endforeach

            </div>
            @endif

        </div>

        <select
            name="status"
            class="p-3 rounded-lg border border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-400"
        >
            <option value="">All Status</option>
            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
            <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
        </select>

        <button class="bg-gradient-to-r from-teal-400 to-teal-600 text-white px-6 py-3 rounded-lg font-medium hover:scale-105 transition">
            Search
        </button>

    </form>

</div>

@forelse($flacks as $flack)

<div class="bg-white dark:bg-slate-800 p-6 mb-5 rounded-2xl shadow-md hover:-translate-y-1 transition">

    <h3 class="text-slate-800 dark:text-white text-lg font-semibold">{{ $flack->title }}</h3>

    <p class="text-slate-500 dark:text-slate-400 leading-relaxed mt-2">
        {{ Str::limit($flack->body, 150) }}
    </p>

    <span class="inline-block mt-3 px-4 py-1.5 rounded-full text-white text-xs font-bold {{ $flack->status == 'Draft' ? 'bg-amber-500' : 'bg-green-500' }}">
        {{ $flack->status }}
    </span>

    <div class="mt-4 flex gap-2">

        <a href="{{ route('flacks.show', $flack->id) }}" class="bg-gradient-to-r from-emerald-400 to-emerald-600 text-white px-4 py-2 rounded-full text-xs font-medium hover:scale-105 transition">
            Show
        </a>

        <a href="{{ route('flacks.edit', $flack->id) }}" class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-full text-xs font-medium hover:scale-105 transition">
            Edit
        </a>

        <form action="{{ route('flacks.destroy', $flack->id) }}" method="POST" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button class="bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-full text-xs font-medium hover:scale-105 transition">
                Delete
            </button>
        </form>

    </div>

</div>

@empty

<div class="text-center bg-white dark:bg-slate-800 p-8 rounded-2xl text-slate-500 dark:text-slate-400">
    No flacks found.
</div>

@endforelse

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this flack?");
    }

    function showHistory() {
        const dropdown = document.getElementById('search-history-dropdown');
        if (dropdown) dropdown.classList.remove('hidden');
    }

    function selectHistory(term) {
        document.getElementById('search-input').value = term;
        document.getElementById('search-form').submit();
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('search-history-dropdown');
        const input = document.getElementById('search-input');

        if (dropdown && !dropdown.contains(e.target) && e.target !== input) {
            dropdown.classList.add('hidden');
        }
    });
</script>

@endsection