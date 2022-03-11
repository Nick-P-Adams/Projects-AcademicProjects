<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;

class ComicsController extends Controller
{
    public function index()
    {
        //$comics = Comic::all();
        $comics = Comic::sortable()->paginate(25);
        return view('comics.index', ['comics'=>$comics]);
    }

    public function create()
    {
        return view('comics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'volume' => 'required',
            'volume_id' => 'required',
            'issue_num' => 'required',
            'pub_date' => 'required',
            'condition' => 'required',
            'writer_name' => 'required',
            'artist_name' => 'required',
            'description' => 'required',
            'image_URL' => 'required'
        ]);

        Comic::create($request->all());
        return redirect()->route('comics.index')->with('success', 'Comic created successfully');
    }

    public function show(Comic $comic)
    {
        return view('comics.show', compact('comic'));
    }

    public function edit(Comic $comic)
    {
        return view('comics.edit', compact('comic'));
    }

    public function update(Request $request, Comic $comic)
    {
        $request->validate([
            'title' => 'required',
            'volume' => 'required',
            'volume_id' => 'required',
            'issue_num' => 'required',
            'pub_date' => 'required',
            'condition' => 'required',
            'writer_name' => 'required',
            'artist_name' => 'required',
            'description' => 'required',
            'image_URL' => 'required'
        ]);

        $comic->update($request->all());
        return redirect()->route('comics.index')->with('success', 'Comic updated successfully');
    }

    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('comics.index')->with('success','Comic deleted successfully');
    }
}
