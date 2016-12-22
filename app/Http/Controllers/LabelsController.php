<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Label;

use Session;

class LabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $label = Label::all();

        return view('labels.index')->withLabels($label);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labels.create');
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
            'title' => 'required|unique:labels',
            'unity' => 'required',
        ]);

        $input = $request->all();

        Label::create($input);

        Session::flash('flash_message', 'Etiqueta criada com Sucesso!');

        return redirect()->back();
    }

    public function getLabelsFiltrada(Request $request)
    {
      //$label = array();
      $void = array();
      $void[] = "";
      //$label = Label::where('title','ilike', "$request->label")->first();
      $label = Label::all();
      if($label)
      {
          //console.log($label);
          if ($request->json)
          {
              return $label;
          }
        }
      else
        {
              return "ola";//return $void;
        }
  }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $label = Label::findOrFail($id);

        return view('label.show')->withLabels($label);
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
