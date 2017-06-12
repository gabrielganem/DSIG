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

    public function getTodasAmostras(Request $request)
    {
        $labels = Label::all();

        $samplesdb = DB::table('samples')
        ->select(DB::raw('id,project_id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
        ->get();

        // $label = array();
        $amostras = array();
        $projetos = array();
        $campos = array();

        foreach ($labels as $label)
        {
          foreach ($label->projects as $project)
          {
            $projetos[] = $project;
            foreach ($project->samples as $sample)
            {
                foreach($samplesdb as $sampledb)
              {
                if ($sample->id == $sampledb->id)
                {
                  if(!in_array($sampledb,$amostras)){ $amostras[] = $sampledb;}
                  foreach ($sample->fields as $field)
                  {
                    $campos[] = $field;
                  }
                }
              }
            }
          }
      }

        $labels = Label::all();
        $projects = Project::all();
        $fields = Field::all();

        $data = array();
        $data["projetos"] = $projetos;
        $data["amostras"] = $amostras;
        $data["campos"] = $campos;
        $data["etiquetas"] = $labels;

        //dd($data);
        if ($request->json)
        {
            return $data;
        }
        else
        {
          return view('samples.index');
        }
      }
/*
      else
      {
        $labels = Label::all();
        $fields = Field::all();
        $samples = DB::table('samples')
        ->select(DB::raw('id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
        ->get();
        $projects = Project::all();

        return view('samples.index')->withSamples($samples)->withProjects($projects)->withLabels($labels)->withFields($fields);
      }*/

      public function getTodasAmostrasLocal(Request $request)
      {
          $labels = Label::all();

          $samplesdb = DB::table('samples')
          ->select(DB::raw('id,project_id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
          ->get();

          // $label = array();
          $amostras = array();
          $projetos = array();
          $campos = array();

          foreach ($labels as $label)
          {
            foreach ($label->projects as $project)
            {
              $projetos[] = $project;
              foreach ($project->samples as $sample)
              {
                  foreach($samplesdb as $sampledb)
                {
                  if ($sample->id == $sampledb->id)
                  {
                    if(!in_array($sampledb,$amostras)){ $amostras[] = $sampledb;}
                    foreach ($sample->fields as $field)
                    {
                      $campos[] = $field;
                    }
                  }
                }
              }
            }
        }

          $labels = Label::all();
          $projects = Project::all();
          $fields = Field::all();

          $data = array();
          $data["projetos"] = $projetos;
          $data["amostras"] = $amostras;
          $data["campos"] = $campos;
          $data["etiquetas"] = $labels;

          //dd($data);
          if ($request->json)
          {
              return $data;
          }
          else
          {
            return view('samples.index');
          }
        }

    public function getAmostraFiltrada(Request $request)
    {
      $label = Label::where('title','ilike', $request->label)->first();

      if($label)
      {
      //dd($requeist);
        $samplesdb = DB::table('samples')
        ->select(DB::raw('id,project_id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
        ->get();

            $amostras = array();
            $projetos = array();
            $campos = array();

              foreach ($label->projects as $project)
              {
                $projetos[] = $project;
                foreach ($project->samples as $sample)
                {
                    foreach($samplesdb as $sampledb)
                  {
                    if ($sample->id == $sampledb->id)
                    {
                      if(!in_array($sampledb,$amostras)) {$amostras[] = $sampledb;}
                      foreach ($sample->fields as $field)
                      {
                        $campos[] = $field;
                      }
                    }
                  }
                }
              }

              $labels = Label::all();
              $projects = Project::all();
              $fields = Field::all();

              $data = array();
              $data["projetos"] = $projetos;
              $data["amostras"] = $amostras;
              $data["campos"] = $campos;
              $data["etiquetas"] = $labels;

              if ($request->json)
              {
                  return $data;
              }
              else {
                return view('samples.index')->with(['samples' => $amostras])->withProjects($projects)->withLabels($labels)->withFields($fields);
              }
          }
        else
        {
          $projects = Project::all();
          $amostras = array();
          $amostras = null;

          $data = array();
          $data["projetos"] = $projects;
          $data["amostras"] = $amostras;

          if ($request->json)
          {
              return $data;
          }

          else
          {
            return view('samples.index')->with(['samples' => $amostras])->withProjects($projects);
          }
        }
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


      			return view('projects.index')->withProjects($projects)->withLabels($labels);
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

                  $array = ["date","ponto","latitude","longitude"];
                  foreach ($result as $key => $value)
                  {
                    if( !(in_array($key, $array)) )
                    {
                       $label = Label::where('title', $key)->first();
                       $field = New Field;
                       $field->label_id = $label->id;
                       $field->value = $value;
                       $sample->fields()->save($field);
                      // $field[0]->sample()->attach($sample);
                    }
                  }
            }
          });

        $project = Project::find($id);
        $labels = Label::all();
        $sample = DB::table('samples')
        ->select(DB::raw('id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
        ->where('project_id', $id)
        ->get();

        return view('projects.samples.index')->withProjects($project)->withSamples($sample)->withLabels($labels);
      }

    public function postExcelSet(Request $request, $id)
      {
          $project = Project::find($id);

          $npontos = $request->npontos;
          $data = array('numero' => $npontos);

          return view('projects.samples.setsheet')->with('npontos', $npontos)->withProjects($project);
        }

      public function postExcelExport(Request $request, $id)
      {
          $project = Project::find($id);
          $array = array();
          foreach ($project->labels as $label)
          {
            $arrayLabel[] = $label->title;
          }
          $npontos = $request->npontos;

          Excel::create('arquivo_X', function($excel) use($arrayLabel, $request, $npontos, $project)
          {
            // Set the title
            $excel->setTitle($project->title);
            $excel->sheet("sheet_1", function($sheet) use($arrayLabel, $npontos, $request)
            {
              $array = ["date","ponto","latitude","longitude"];
              $arrayLabel = array_merge($array, $arrayLabel);
              $sheet->row(1, $arrayLabel);

              for ($i=0; $i < $npontos; $i++)
              {
                for($j=0; $j < $request->n_coleta; $j++)
                {
                  $n_celula = (2 + ($i*$request->n_coleta)) + $j;
                  $celula = "A".$n_celula;
                  $date = new \DateTime($request->date);

                  $frequencia = ($request->frequencia*(($i*$request->n_coleta)+ $j))." days";
                  date_add($date, date_interval_create_from_date_string($frequencia));

                  $valor_celula = date_format($date, 'd-m-Y H:i');

                  $sheet->cell($celula, function($cell) use($j, $valor_celula) {
                      $cell->setValue($valor_celula);
                  });

                  $celula = "B".$n_celula;
                  $ponto = "name-".$i;

                  $valor_celula = $request->$ponto;
                  $sheet->cell($celula, function($cell) use($j, $valor_celula) {
                      $cell->setValue($valor_celula);
                  });

                  $celula = "C".$n_celula;
                  $ponto = "x-".$i;

                  $valor_celula = $request->$ponto;
                  $sheet->cell($celula, function($cell) use($j, $valor_celula) {
                      $cell->setValue($valor_celula);
                  });

                  $celula = "D".$n_celula;
                  $ponto = "y-".$i;

                  $valor_celula = $request->$ponto;
                  $sheet->cell($celula, function($cell) use($j, $valor_celula) {
                      $cell->setValue($valor_celula);
                  });
                }
              }
            });

          })->download('xls');
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
