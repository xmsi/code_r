<?php

namespace App\Http\Controllers;

use App\Smi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;

class SmiController extends Controller
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
        $smis = Smi::get();

        return view('admin.smi.index', compact('smis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.smi.create');
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
            'text' => 'required',
            'image' => 'image|mimes:jpeg,png,bmp,gif,svg,webp',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = 'smi'.Carbon::now()->timestamp.$imageName;
            $image->move('images/', $imageName);
        }

        $smi = Smi::create([
            'title' => $request->title,
            'url' => $request->url,
            'video' => $request->video,
            'text' => $request->text,
            'image' => $imageName,
        ]);

        return redirect('/admin/smis/'.$smi->id)->with('success', 'Cоздана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\smi  $smi
     * @return \Illuminate\Http\Response
     */
    public function show(Smi $smi)
    {
        return view('admin.smi.show', compact('smi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\smi  $smi
     * @return \Illuminate\Http\Response
     */
    public function edit(Smi $smi)
    {
        return view('admin.smi.edit', compact('smi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\smi  $smi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Smi $smi)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $smi->update($request->all());

        return redirect('/admin/smis/'.$smi->id)->with('success', 'Книга изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\smi  $smi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Smi $smi)
    {
        File::delete(public_path().'/images/'.$smi->image);
        File::delete(public_path().'/smi/'.$smi->file);
        $smi->delete();

        return redirect('/admin/smis');
    }
}
