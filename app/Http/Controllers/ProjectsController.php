<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use App\Sample;
use App\Label;
use App\User;
use App\Intermediate;
use Session;
use DB;
use Auth;



class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $project = $user->projects()->where('user_id', $user->id)->get();
        //$project = Project::all()->where('project_id', $id);

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

    public function getAmostras($id)
    {
      $project = Project::where('id', $id)->firstOrFail();
      $sample = DB::table('samples')
      ->select(DB::raw('id,ST_X(geom) as lng, ST_Y(geom) AS lat, date'))
      ->where('project_id', $id)
      ->get();

      return view('projects.samples.index')->withProjects($project)->withSamples($sample);
    }

    public function mapa()
    {

      $fileViewFinder = new FileViewFinder(new Filesystem,  [__DIR__ . '/src/views']);
      $fileViewFinder->addNamespace('googlmapper', [__DIR__ . '/src/views']);
      $engineResolver = new EngineResolver();
      $engineResolver->register(
          'blade',
          function () {
              return new CompilerEngine(new BladeCompiler(new Filesystem(), sys_get_temp_dir()));
          }
      );
      $viewFactory = new Factory($engineResolver, $fileViewFinder, new Dispatcher(new Container));
      $config = include_once __DIR__ . '/googlmapper.php';
      $mapper = new Mapper($viewFactory, $config);
      // Location
      $mapper->location('Sheffield')->streetview(1, 1, ['ui' => false]);
      // Map
      $mapper->map(53.3, -1.4, ['zoom' => 10, 'center' => false, 'markers' => ['title' => 'My Location', 'animation' => 'DROP']]);
      // Information window
      $mapper->informationWindow(53.4, -1.5, 'Content');
      $mapper->informationWindow(52.4, -1.0, 'Content');
      $mapper->informationWindow(51.4, -0.5, 'Content');
      // Render
      print $mapper->render();

    }
}
