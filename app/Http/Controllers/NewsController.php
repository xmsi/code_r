<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsController extends Controller
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
        $news = News::get();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
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
            $imageName = 'new'.Carbon::now()->timestamp.$imageName;
            $image->move('images/', $imageName);
        }

        $date = Carbon::parse($request->date)->format("Y-m-d");


        $new = News::create([
            'title' => $request->title,
            'text' => $request->text,
            'image' => $imageName,
            'date' => $date,
        ]);

        return redirect('/admin/news/'.$new->id)->with('success', 'Успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\new  $new
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\new  $new
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\new  $new
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $news->fill($request->except(['date', 'image']));

        if ($request->hasFile('image')) {
            \File::delete(public_path().'/images/'.$news->image);
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = 'new'.Carbon::now()->timestamp.$imageName;
            $image->move('images/', $imageName);
            $news->image = $imageName;
        }

        if($request->date){
            $news->date = Carbon::parse($request->date)->format("Y-m-d");
        }

        $news->save();

        return redirect('/admin/news/'.$news->id)->with('success', 'Успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\new  $new
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        \File::delete(public_path().'/images/'.$news->image);
        $news->delete();

        return redirect('/admin/news');
    }
}
