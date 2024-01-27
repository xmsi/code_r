<?php

namespace App\Http\Controllers;

use App\VideoBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class VideoblogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoblogs = VideoBlog::get();

        return view('admin.videoblog.index', compact('videoblogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videoblog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,bmp,gif,svg,webp',
        ]);

        $videoblog = new VideoBlog();
        $videoblog->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = 'videoblog'.Carbon::now()->timestamp.$imageName;
            $image->move('images/', $imageName);
            $videoblog->image = $imageName;
        }

        $videoblog->save();

        return redirect('/admin/videoblogs/'.$videoblog->id)->with('success', 'Cоздана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\videoblog  $videoblog
     * @return \Illuminate\Http\Response
     */
    public function show(VideoBlog $videoblog)
    {
        return view('admin.videoblog.show', compact('videoblog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\videoblog  $videoblog
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoBlog $videoblog)
    {
        return view('admin.videoblog.edit', compact('videoblog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\videoblog  $videoblog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoBlog $videoblog)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $videoblog->update($request->all());

        return redirect('/admin/videoblogs/'.$videoblog->id)->with('success', 'изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\videoblog  $videoblog
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoBlog $videoblog)
    {
        File::delete(public_path().'/images/'.$videoblog->image);
        $videoblog->delete();

        return redirect('/admin/videoblogs');
    }
}
