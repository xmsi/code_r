<?php

namespace App\Http\Controllers;

use App\Interconf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;


class InterconfController extends Controller
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
        $interconfs = Interconf::get();

        return view('admin.interconf.index', compact('interconfs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.interconf.create');
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
            'start_date' => 'required',
            'image' => 'image|mimes:jpeg,png,bmp,gif,svg,webp',
        ]);

        $interconf = new Interconf();
        $interconf->fill($request->except('image'));
        $interconf->start_date = Carbon::parse($request->start_date)->format("Y-m-d");
        $interconf->end_date = Carbon::parse($request->end_date)->format("Y-m-d");

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = 'interconf'.Carbon::now()->timestamp.$imageName;
            $image->move('images/', $imageName);
            $interconf->image = $imageName;
        }

        $interconf->save();

        return redirect('/admin/interconfs/'.$interconf->id)->with('success', 'Cоздана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\interconf  $interconf
     * @return \Illuminate\Http\Response
     */
    public function show(Interconf $interconf)
    {
        return view('admin.interconf.show', compact('interconf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\interconf  $interconf
     * @return \Illuminate\Http\Response
     */
    public function edit(Interconf $interconf)
    {
        return view('admin.interconf.edit', compact('interconf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\interconf  $interconf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interconf $interconf)
    {
        $request->validate([
            'title' => 'required',
            'place' => 'required',
        ]);

        $interconf->update($request->all());

        return redirect('/admin/interconfs/'.$interconf->id)->with('success', 'изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\interconf  $interconf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interconf $interconf)
    {
        File::delete(public_path().'/images/'.$interconf->image);
        $interconf->delete();

        return redirect('/admin/interconfs');
    }
}
