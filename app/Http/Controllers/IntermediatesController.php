<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Project;
use App\User;
use Auth;
use App\Label;
use App\Http\Requests;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\LabelsController;
use DB;

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
            'department' => 'required'
        ]);
        //$project = new Project();
        $project->title = $request->titulo;
        $project->description = $request->description;
        $project->department = $request->department;

        //$input = $request->all();
        //Project::create($project);
        $project->save();

        Session::flash('flash_message', 'Projeto Atualizado!');

        return redirect()->back();
    }

    public function postAdiciona(Request $request)
    {
        $userId = Auth::user()->id;
        //$project = Project::findOrFail($id);
        $project = new Project;
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        //$project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->private = isset($request->private) ? 1 : 0;

        $input = $request->all();
        //Project::create($project);
        //$project->save();
        $project->save();
        $project->users()->attach([$userId => [ 'role' => 1] ]);

        Session::flash('flash_message', 'Projeto Adicionado com Sucesso!');

        //IntermediatesController::dunno($request, $project);

        foreach ($input as $key => $value)
        {
          if(strstr($key,'-')){
             $label = Label::where('id','=', $value)->get();
             $label[0]->projects()->attach($project);
           }
        }
        $user = Auth::user();

        $colaborador = DB::table('users')->where('email', $request->collaborator)->first();

        $project->users()->attach([ $colaborador->id => [ 'role' => 0] ]);

        $project = $user->projects()->where('user_id', $user->id)->get();
        return view('projects.index')->withProjects($project);
    }

  public function dunno(Request $params, Project $p){
      foreach ($params as $key=>$value) {
       if(strstr($key,'-')){
          $label = Label::where('id','=', '1')->get();
          $label[0]->projects()->attach($p);
        }
     }
    return;
  }

}
