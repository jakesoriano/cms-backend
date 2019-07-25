<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\CMS\StorePageRequest;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Page;
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
    public function store(StorePageRequest $request)
    {
        $model = new Page;
        if($request->validator->fails()) {
            return response()->json(['errors' => $request->validator->errors()], 200);
        }
        $data = $request->all();

        $model->fill($data);

        $model->save();

        return response()->json(['success' => true, 'data' => $model->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new Page;
        $model = $model->findOrFail($id);
        $data = $request->all();

        $model->fill($data);

        $model->save();
        
        return response()->json(['success' => true, 'data' => $model->findOrFail($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $model = new Page;
        if($id != null) {
            $model = $model->findOrFail($id);
            $model->where('id', $id)->delete();
        }
        return response()->json(['success' => true, 'data' => Page::get()]);
    }
}
