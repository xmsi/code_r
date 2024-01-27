<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Competition_table;
use App\Rank;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
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
        $competition = Competition::get();

        return view('admin.competition.index', compact('competition'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($workshop_id)
    {   
        $doctors = Doctor::pluck('name', 'id')->toArray();

        return view('admin.competition.create', compact('workshop_id', 'doctors'));
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

        $competition = Competition::create([
            'title' => $request->title,
            'workshop_id' => $request->workshop_id,
            'description' => $request->description,
            'images' => $images,
        ]);
        
        if ($request->members) {
            $request->members = array_filter($request->members);
            $save = [];
            foreach ($request->members as $member) {
                $save[] = new Competition_table(['competition_id' => $competition->id, 'doctor_id' => $member]);
            }

            $competition->competition_table()->saveMany($save);
        }

        return redirect('/admin/competition/'.$competition->id)->with('success', 'Конкурс успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        return view('admin.competition.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     * @author XMSI yeah baby 'Chem starshe tem xuje'
     */
    public function edit(Competition $competition)
    {
        return view('admin.competition.edit', compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $request->validate([
            'title' => 'required',
            'rank.*' => 'nullable|integer'
        ]);

        $competition->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if ($request->rank) {
         foreach ($request->rank as $docId => $rank) {
            $t = Competition_table::where('competition_id', $competition->id)->where('doctor_id', $docId)->update(['rank' => $rank]);
         } 
        }

        return redirect('/admin/competition/'.$competition->id)->with('success', 'Конкурс изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $photos = explode(';', $competition->images);
        foreach ($photos as $photo) {
            File::delete('images/'.$photo);
        }
        $competition->delete();

        return redirect('/admin/competition');
    }
}
