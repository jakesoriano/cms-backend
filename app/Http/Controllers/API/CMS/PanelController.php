<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\Panel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\Transformer as TransformerResource;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Panel;
        return response()->json(['success' => true, 'data' => $model->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Panel;
        $data = $request->all();

        $model->fill($data);

        $model->save();

        return response()->json(['success' => true, 'data' => $model->all()]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function show(Panel $panel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function edit(Panel $panel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new Panel;
        $model = $model->findOrFail($id);
        $data = $request->all();

        $model->fill($data);

        $model->save();
        
        return response()->json(['success' => true, 'data' => $model->findOrFail($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $model = new Panel;
        if($id != null) {
            $model = $model->findOrFail($id);
            $model->where('id', $id)->delete();
        }
        return response()->json(['success' => true, 'data' => Panel::get()]);
    }
}
