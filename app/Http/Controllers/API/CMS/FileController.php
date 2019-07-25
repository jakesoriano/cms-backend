<?php

namespace App\Http\Controllers\Api\CMS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    public function index(Request $request)
    {
      try {
        $file = $request->file('file');
        $extension = $file->extension();
        $mimeType = $file->getMimeType();
        $filename = time().'.'.$extension;
        // $base = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().'/uploads/cms/';
        if(\Config::get('app.env') === 'local') {
          $path = Storage::disk('public')->putFileAs('uploads/cms', $file, $filename);
        } else {
          $path = Storage::disk('spaces')->putFileAs('uploads/cms', $file, $filename, 'public');
          $base = 'https://'.env('DO_SPACES_BUCKET').'.sgp1.digitaloceanspaces.com';
        }
        //Move Uploaded File
        return response()->json(['success' => true, 'path' => asset('storage/uploads/cms/'.$filename)]);
      } catch (Exception $x) {
        return response()->json(['success' => false, 'message' => $x, 'url' => $base]);
      }
    }

    public function get(Request $request) {
      return $request;
      
    }
}
