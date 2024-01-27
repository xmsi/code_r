<?php

namespace App\Http\Controllers;

use App\Development;
use App\Rank;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DevelopmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developments = Development::get();

        return view('admin.developments.index', compact('developments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.developments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $images = Rank::imageUpload($request);

        $development = Development::create([
            'title' => $request->title,
            'description' => $request->description,
            'images' => $images,
        ]);

        return redirect('/admin/developments/'.$development->id)->with('success', 'Зазработка успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Development  $development
     * @return \Illuminate\Http\Response
     */
    public function show(Development $development)
    {
        return view('admin.developments.show', compact('development'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Development  $development
     * @return \Illuminate\Http\Response
     */
    public function edit(Development $development)
    {
        return view('admin.developments.edit', compact('development'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Development  $development
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Development $development)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $development->update($request->all());

        return redirect('/admin/developments/'.$development->id)->with('success', 'Разработка изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Development  $development
     * @return \Illuminate\Http\Response
     */
    public function destroy(Development $development)
    {
        $photos = explode(';', $development->images);
        foreach ($photos as $photo) {
            File::delete('images/'.$photo);
        }
        $development->delete();

        return redirect('/admin/developments');
    }
}
