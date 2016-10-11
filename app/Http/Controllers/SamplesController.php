<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\ProjectsController;

use App\Http\Requests;

use App\Project;
use App\Sample;
use App\Label;
use App\Field;
use App\Intermediate;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;

class SamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodasAmostras()
    {
        $samples = DB::table('samples')
        ->select(DB::raw('id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
        ->get();
        $projects = Project::all();

      return view('samples.index')->withSamples($samples)->withProjects($projects);
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

            $input = $request->all();

      			$project->samples()->save($sample);


            foreach ($input as $key => $value)
            {
              if(is_numeric($key)){
                 //$label = Label::where('id','=', $value)->get();
                 $field = New Field;
                 $field->label_id = $key;
                 $field->value = $value;
                 $sample->fields()->save($field);
                // $field[0]->sample()->attach($sample);
               }
            }


      			return view('projects.index')->withProjects($projects);
    }

    public function postExcelArmazena($id)
    {
            $id1 = (int)$id;

            Excel::load(Input::file('datasheet'),function($reader) use($id1){

                $results = $reader->get();
                foreach ($results as $result)
                {
                  $x = $result->latitude;
                  $y = $result->longitude;

                  $sample = new Sample;
                  $sample->date = $result->date;
                  $sample->geom = DB::raw("ST_GeomFromText('POINT({$y} {$x})', 4326)");

                  $project = Project::find($id1);

                  $inputs = $results->all();

                  $project->samples()->save($sample);

                  foreach ($result as $key => $value)
                  {
                    if(is_numeric($key)){
                       //$label = Label::where('id','=', $value)->get();
                       $field = New Field;
                       $field->label_id = $key;
                       $field->value = $value;
                       $sample->fields()->save($field);
                      // $field[0]->sample()->attach($sample);
                     }
                  }
            }
          });

        $project = Project::find($id);
        $sample = DB::table('samples')
        ->select(DB::raw('id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
        ->where('project_id', $id)
        ->get();

        return view('projects.samples.index')->withProjects($project)->withSamples($sample);
      }

    public function postExcelSet(Request $request, $id)
      {
          $project = Project::find($id);

          $npontos = $request->npontos;
          $data = array('numero' => $npontos);

          return view('projects.samples.setsheet')->with('npontos', $npontos)->withProjects($project);
        }

/*
            $labels = Label::All();
            $projects = Project::All();

            foreach ($results as $result)
            {
              $x = $result->longitude;
              $y = $result->latitude;

        			$sample = new Sample;
        			$sample->date = $result->date;
        			$sample->geom = DB::raw("ST_GeomFromText('POINT({$x} {$y})', 4326)");

              $project = Project::find($id);

              $inputs = $request->all();

        			$project->samples()->save($sample);


              foreach ($inputs as $input)
              {
                if(is_numeric($key)){
                   //$label = Label::where('id','=', $value)->get();
                   $field = New Field;
                   $field->label_id = $key;
                   $field->value = $value;
                   $sample->fields()->save($field);
                  // $field[0]->sample()->attach($sample);
                 }
              }
            }


      			return view('projects.index')->withProjects($projects); */


    public function getExibeAmostra($ids, $idp)
    {
      $samples = Sample::findOrFail($ids);
      $projects = Project::findOrFail($idp);
      $fields = Field::all();
      return view ('projects.samples.show')->withProjects($projects)->withSamples($samples)->withFields($fields);
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
