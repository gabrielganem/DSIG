<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Project;
use App\Label;
use App\Http\Requests;
use App\Http\Controllers\IntermediatesController;
use Session;

class IntermediatesController extends Controller
{
    public function getIndex()
    {
        echo 'teste';
        return;
    }

  public function etiqueta ()
  {

  }
   
    public function postAtualiza(Request $request, $id)
    {
        //$project = Project::findOrFail($id);
        $project = new Project;
        $this->validate($request, [
            'titulo' => 'required',
            'description' => 'required',
            'institute' => 'required',
            'department' => 'required'
        ]);
        //$project = new Project();
        $project->title = $request->titulo;
        $project->description = $request->description;
        $project->institute = $request->institute;
        $project->department = $request->department;

        //$input = $request->all();
        //Project::create($project);
        $project->save();

        Session::flash('flash_message', 'Projeto Atualizado!');

        return redirect()->back();
    }

    public function postAdiciona(Request $request)
    {
        //$project = Project::findOrFail($id);
        $project = new Project;
        $this->validate($request, [
            'titulo' => 'required',
            'description' => 'required',
            'institute' => 'required',
            'department' => 'required'
        ]);
        //$project = new Project();
        $project->title = $request->titulo;
        $project->description = $request->description;
        $project->institute = $request->institute;
        $project->department = $request->department;

        //$input = $request->all();
        //Project::create($project);
        $project->save();

        Session::flash('flash_message', 'Projeto Atualizado!');

        return redirect()->back();
    }
}