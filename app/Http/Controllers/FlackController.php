<?php

namespace App\Http\Controllers;

use App\Models\Flack;
use Illuminate\Http\Request;

class FlackController extends Controller
{
    public function index(Request $request)
    {
        $query = Flack::latest();

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('body', 'LIKE', '%' . $request->search . '%');
            });

            $history = session()->get('search_history', []);

            if (!in_array($request->search, $history)) {

                array_unshift($history, $request->search);

                $history = array_slice($history, 0, 8);

                session()->put('search_history', $history);
            }
        }

        if ($request->status) {

            $query->where('status', $request->status);
        }

        $flacks = $query->get();

        $totalFlacks = Flack::count();
        $draftFlacks = Flack::where('status', 'Draft')->count();
        $publishedFlacks = Flack::where('status', 'Published')->count();
        $searchHistory = session()->get('search_history', []);

        return view('flacks.index', compact(
            'flacks',
            'totalFlacks',
            'draftFlacks',
            'publishedFlacks',
            'searchHistory'
        ));
    }

    public function create()
    {
        return view('flacks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required'
        ]);

        Flack::create([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status
        ]);

        return redirect()->route('flacks.index')
            ->with('success', 'Flack created successfully!');
    }

    public function show($id)
    {
        $flack = Flack::findOrFail($id);

        return view('flacks.show', compact('flack'));
    }

    public function edit(Flack $flack)
    {
        return view('flacks.edit', compact('flack'));
    }

    public function update(Request $request, Flack $flack)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required'
        ]);

        $flack->update([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status
        ]);

        return redirect()->route('flacks.index')
            ->with('success', 'Flack updated successfully!');
    }

    public function destroy(Flack $flack)
    {
        $flack->delete();

        return redirect()->route('flacks.index')
            ->with('success', 'Flack deleted successfully!');
    }

    public function clearSearchHistory()
    {
        session()->forget('search_history');

        return redirect()->route('flacks.index');
    }
}