<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\PagePanel;
use App\Models\Panel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagePanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new PagePanel;
        return response()->json(['success' => true, 'data' => $model->all()]);
    }
    
    public function getById($id)
    {
        $model = new PagePanel;
        $data = $model->orderBy('sort')->where('page_id', $id)->get();
        foreach($data as $key => $panel) {
            $data[$key]['panel'] = Panel::find(1)->where('id', $panel->panel_id)->get();
        }
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
        $model = new PagePanel;
        if($request->has('id')) {
            
            $model->onlyTrashed()->findOrFail($request->id)->restore();
            $model = $model->findOrFail($request->id);
        }
        
        $data = $request->all();

        $model->fill($data);

        $model->save();

        return response()->json(['success' => true, 'data' => $model->onlyTrashed()->where('page_id', $request->id)->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PagePanel  $pagePanel
     * @return \Illuminate\Http\Response
     */
    public function show(PagePanel $pagePanel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PagePanel  $pagePanel
     * @return \Illuminate\Http\Response
     */
    public function edit(PagePanel $pagePanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PagePanel  $pagePanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new PagePanel;
        $model = $model->findOrFail($id);
        $data = $request->all();

        $model->fill($data);

        $model->save();
        
        return response()->json(['success' => true, 'data' => $model->onlyTrashed()->where('page_id', $request->id)->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PagePanel  $pagePanel
     * @return \Illuminate\Http\Response
     */
    public function destroy($page_id)
    {
        //
        $model = new PagePanel;
        if($page_id != null) {
            $model->where('page_id', $page_id)->delete();
        }
        return response()->json(['success' => true, 'data' => $model->where('page_id', $page_id)->get()]);
    }
}
