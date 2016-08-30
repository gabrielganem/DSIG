<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\ProjectsController;

use App\Http\Requests;

use App\Project;
use App\Sample;
use App\Label;
use App\Intermediate;

use DB;

class SamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sample = Sample::all();
        $project = Project::all();

      return view('samples.index')->withSamples($sample)->withProjects($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function create()
    {
        return view('samples.create');
    }*/

    public function getAdiciona($id)
    {
      $projects = Project::findOrFail($id);
      return view ('projects.samples.create')->withProjects($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postArmazena(Request $request, $id)
    {
            $labels = Label::All();
            $projects = Project::All();

            $x = $request->longitude;
            $y = $request->latitude;

      			$sample = new Sample;
      			$sample->date = $request->date;
      			$sample->geom = DB::raw("ST_GeomFromText('POINT({$x} {$y})', 4326)");

            $project = Project::find($id);

      			$project->samples()->save($sample);

      			return view('projects.index')->withProjects($projects);
    }

    public function getExibeAmostra($ids, $idp)
    {
      $samples = Sample::findOrFail($ids);
      $projects = Project::findOrFail($idp);
      return view ('projects.samples.show')->withSamples($samples)->withProjects($projects);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
