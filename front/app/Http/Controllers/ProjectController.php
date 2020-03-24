<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DevTable;
use App\CategoryProject;
use App\Project;
use Validator;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['dev'] = DevTable::first();
        $data['current'] = Project::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        $data['category'] = CategoryProject::get();        
        return view('page.project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['dev'] = DevTable::first();        
        $data['project'] = Project::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('page.project.create', $data);
    }

    public function add()
    {
        $data['dev'] = DevTable::first();
        $data['category'] = CategoryProject::all();
        return view('page.project.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'category' => 'required|max:150',            
            'url' => 'required',           
            'desc' => 'required',           
        ]);


        if ($v->fails()) {        
            return back()->withInput()->withErrors($v);
        }else{
            $url = str_replace("watch?v=","embed/",$request->url);
            $url2 = $url;
            if (strpos($url, '&') !== false) {
                $url2 = substr($url, 0 , strpos($url, '&'));
            }
            Project::create([
                'category_project_id' => $request->category,
                'user_id' => Auth::user()->id,
                'url' => $url2,
                'title' => $request->title,
                'desc' => $request->desc
            ]);
                    
            return back()->with('success', 'Your project has been submit !!');   
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['dev'] = DevTable::first();
        $data['category'] = CategoryProject::all();
        $data['project'] = Project::where('id', $id)->first();
        return view('page.project.edit', $data);
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
        $v = Validator::make($request->all(), [
            'category' => 'required|max:150',            
            'url' => 'required',           
            'desc' => 'required',           
        ]);


        if ($v->fails()) {        
            return back()->withInput()->withErrors($v);
        }else{
            $url = str_replace("watch?v=","embed/",$request->url);
            $url2 = $url;
            if (strpos($url, '&') !== false) {
                $url2 = substr($url, 0 , strpos($url, '&'));
            }
            Project::where('id', $id)->update([
                'category_project_id' => $request->category,
                'url' => $url2,
                'title' => $request->title,
                'desc' => $request->desc
            ]);
                    
            return back()->with('success', 'Your project has been update !!');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        return back()->with('success', 'Your project has been delete !!');   
    }
}
