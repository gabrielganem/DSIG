<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

use App\Sample;

use App\Label;

use Session;

use App\Intermediate;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();

        return view('projects.index')->withProjects($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $label = Label::all();

        return view('projects.create')->withLabels($label);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'institute' => 'required',
            'department' => 'required'
        ]);

        $input = $request->all();

        Project::create($input);

        Session::flash('flash_message', 'Projeto Criado com Sucesso!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $labels = Label::All();

        return view('projects.show')->withProjects($project)->withLabels($labels);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit')->withProjects($project);
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
        $project = Project::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'institute' => 'required',
            'department' => 'required'
        ]);
        //$p = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->institute = $request->institute;
        $project->department = $request->department;

        //$input = $request->all();

        $project->save();

        Session::flash('flash_message', 'Projeto Atualizado!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        Session::flash('flash_message', 'Projeto excluído!');

        return redirect()->route('projects.index');
    }
}
