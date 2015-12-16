<?php

/*
 * Author: Dipesh Rijal
 * Date-Created: 2015-12-14
*/
namespace blogCms\Http\Controllers\Backend;

use blogCms\Page;
use blogCms\Http\Requests;
use Baum\MoveNotPossibleException;
use Illuminate\Http\Request;
class PagesController extends Controller
{
    protected $page;
    
    function __construct(Page $page) 
    {
        $this->page = $page;
        
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $pages = $this->page->all();
        
        return view('backend.pages.index', compact('pages'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page) 
    {
        $templates = $this->getPageTemplates();
        
        $orderPages = $this->page->where('hidden', false)->orderBy('lft', 'asc')->get();
        
        return view('backend.pages.form', compact('page', 'templates', 'orderPages'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Page\StorePageRequest $request) 
    {
        $page = $this->page->create($request->only('name', 'title', 'content', 'uri', 'template', 'hidden'));
        
        $this->updatePageOrder($page, $request);
        
        return redirect()->route('backend.pages.index')->withStatus('Page has been created');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $page = $this->page->findOrFail($id);
        
        $templates = $this->getPageTemplates();
        
        $orderPages = $this->page->where('hidden', false)->orderBy('lft', 'asc')->get();
        
        return view('backend.pages.form', compact('page', 'templates', 'orderPages'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Page\UpdatePageRequest $request, $id) 
    {
        $page = $this->page->findOrFail($id);
        
        if ($response = $this->updatePageOrder($page, $request)) 
        {
            return $response;
        }
        
        $page->fill($request->only('name', 'title', 'uri', 'content', 'template', 'hidden'))->save();
        
        return redirect()->route('backend.pages.edit', $id)->withStatus('Page has been updated');
    }
    
    public function confirm($id) 
    {
        $page = $this->page->findOrFail($id);
        
        return view('backend.pages.confirm', compact('page'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $page = $this->page->findOrFail($id);
        
        foreach ($page->children as $child) 
        {
            $child->makeRoot();
        }
        
        $page->delete();
        
        return redirect()->route('backend.pages.index')->withStatus('Page has been deleted');
    }
    
    protected function getPageTemplates() 
    {
        $templates = config('cms.templates');
        
        return ['' => ''] + array_combine(array_keys($templates) , array_keys($templates));
    }
    
    protected function updatePageOrder(Page $page, Request $request) 
    {
        if ($request->has('order', 'orderPage')) 
        {
            try
            {
                $page->updateOrder($request->input('order') , $request->input('orderPage'));
            }
            catch(MoveNotPossibleException $e) 
            {
                return redirect(route('backend.pages.edit', $page->id))->withInput()->withErrors(['error' => 'Cannot make a page a child of itself.']);
            }
        }
    }
}
