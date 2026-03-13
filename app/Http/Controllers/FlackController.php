<?php

namespace App\Http\Controllers;

use App\Models\Flack;
use Illuminate\Http\Request;

class FlackController extends Controller
{
    public function index()
    {
        $flacks = Flack::latest()->get();

        return view('flacks.index', compact('flacks'));
    }

    public function create()
    {
        return view('flacks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        Flack::create([
            'title' => $request->title,
            'body' => $request->body
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
            'title' => 'required',
            'body' => 'required'
        ]);

        $flack->update([
            'title' => $request->title,
            'body' => $request->body
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
}