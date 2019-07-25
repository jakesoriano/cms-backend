<?php

namespace App\Http\Controllers\Api\CMS;

use App\Models\Page;
use App\Models\PagePanel;
use App\Models\Panel;
use App\Models\PanelContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Page $page, PagePanel $pagePanel, Panel $panel, PanelContent $panelContent) {
        $this->page = $page;
        $this->pagePanel = $pagePanel;
        $this->panel = $panel;
        $this->panelContent = $panelContent;
    }
    public function index($slug)
    {
        try {
            $data['page'] = $this->page != '[]' ? $this->page->find(1)->where('url', '/'.$slug)->first() : null;
            if($data['page'] != null) {
                $data['page_panels'] = $this->pagePanel->orderBy('sort', 'asc')->where('page_id', $data['page']->id)->get();
                $data['panels'] = [];
                $data['content'] = [];
                $data['webview'] = [];
                foreach($data['page_panels'] as $key => $page_panel) {
                    array_push($data['panels'], Panel::find(1)->where('id', $page_panel->panel_id)->first());
                    foreach($data['panels'] as $key => $pan) {
                        array_push($data['content'], PanelContent::find(1)->where('page_panel_id', $page_panel->id)->first());
                    }
                }
                foreach($data['page_panels'] as $pageKey => $page_panel) {
                    $panelz = (object) [];
                    foreach($data['panels'] as $panelKey => $pan) {
                        if($pan['id'] === $page_panel['panel_id']) {
                            $panelz->id = $page_panel->id;
                            $panelz->key = $pan->key;
                            foreach($data['content'] as $contentKey => $content) {
                                if($content['page_panel_id'] === $page_panel['id']) {
                                    $panelz->content = $content;
                                    unset($panelz->content->page_panel_id);
                                    unset($panelz->content->deleted_at);
                                    unset($panelz->content->created_at);
                                    unset($panelz->content->updated_at);
                                }
                            } 
                        }
                    }
                    array_push($data['webview'], $panelz);
                }
            
            }
            
            return $data;
        } catch (Exception $x) {
            return x;
        }
    }
}
