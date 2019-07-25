<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\PanelContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new PanelContent;
        return response()->json(['success' => true, 'data' => $model->all()]);
    }
    
    public function getById($id)
    {
        $model = new PanelContent;
        $data = $model->where('page_panel_id', $id)->first();
        // array_push($data[], $panel);      // foreach($data as $key => $panel) {
        //     $data[$key]['panel'] = PanelContent::find(1)->where('id', $panel->panel_id)->get();
        // }
        return response()->json(['success' => true, 'data' => $data]);
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
        $model = new PanelContent;
        $data = $request->all();

        $model->fill($data);

        $model->save();

        return response()->json(['success' => true, 'data' => $model->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PanelContent  $panelContent
     * @return \Illuminate\Http\Response
     */
    public function show(PanelContent $panelContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PanelContent  $panelContent
     * @return \Illuminate\Http\Response
     */
    public function edit(PanelContent $panelContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PanelContent  $panelContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new PanelContent;
        $model = $model->findOrFail($id);
        $data = $request->all();

        $model->fill($data);

        if($model->save()) {
            return response()->json(['success' => true, 'data' => $model->findOrFail($id)]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PanelContent  $panelContent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $model = new PanelContent;
        if($id != null) {
            $model = $model->findOrFail($id);
            $model->where('id', $id)->delete();
        }
        return response()->json(['success' => true, 'data' => PanelContent::get()]);
    }
}
