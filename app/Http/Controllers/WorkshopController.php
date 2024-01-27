<?php

namespace App\Http\Controllers;

use App\Workshop;
use App\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WorkshopController extends Controller
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
        $workshops = Workshop::get();

        return view('admin.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workshops.create');
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

        $workshop = Workshop::create([
            'title' => $request->title,
            'description' => $request->description,
            'images' => $images,
            'video' => $request->video,
            'comments' => $request->comments,
        ]);

        return redirect('/admin/workshops/'.$workshop->id)->with('success', 'Воркшоп успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        return view('admin.workshops.show', compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $workshop->update($request->all());

        return redirect('/admin/workshops/'.$workshop->id)->with('success', 'Воркшоп изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        if($workshop->competition){
            $compimg = $workshop->competition->images;
        
            if ($compimg) {
                $photos = explode(';', $compimg);
                foreach ($photos as $photo) {
                    File::delete('images/'.$photo);
                }
            }
        }

        $photos = explode(';', $workshop->images);
        foreach ($photos as $photo) {
            File::delete('images/'.$photo);
        }
        $workshop->delete();

        return redirect('/admin/workshops');
    }
}
