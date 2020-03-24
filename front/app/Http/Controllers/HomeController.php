<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FrontendHome;
use App\Blog;
use App\FrontendProgram;
use App\FrontendTeacher;
use App\FrontendContact;
use App\DevTable;
use App\AppSetting;
use App\Event;
use App\EventInstructor;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['home'] = FrontendHome::first();
        $data['program'] = FrontendProgram::first();
        $data['teacher'] = FrontendTeacher::get();
        $data['contact'] = FrontendContact::first();
        $data['blog'] = Blog::orderBy('created_at', 'desc')->get();
        $data['dev'] = DevTable::first();
        $data['app'] = AppSetting::first();
        return view('front', $data);
    }

    public function blog($id)
    {
        $data['blog'] = Blog::orderBy('created_at', 'desc')->get();
        $data['blogDetail'] = Blog::where('id', $id)->first();
        $data['dev'] = DevTable::first();
        $data['app'] = AppSetting::first();
        $data['contact'] = FrontendContact::first();
        return view('blog', $data);        
    }

    public function dashboard()
    {
        $data['dev'] = DevTable::first();
        
        return view('page.dashboard', $data);
    }

    public function event()
    {
        $event = Event::all();
        return response()->json($event);
    }

    public function eventDetail(Request $request, $id)
    {
        $event = Event::find($id);
        $instructor = EventInstructor::where('event_id', $id)->get();
        $id = array();
        $name = array();
        foreach ($instructor as $key => $value) {
            array_push($id, $value->instructor_id);            
            array_push($name, $value->instructor->name);            
        }      
        $arrayName = array('event' => $event, 'instructor' => $id, 'instructor_name' => $name ,'end' => Carbon::parse($event->end)->addDays(-1)->format('Y-m-d'));

        echo json_encode($arrayName);
    }
}
