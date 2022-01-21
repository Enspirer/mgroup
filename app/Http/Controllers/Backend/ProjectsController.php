<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Projects;

class ProjectsController extends Controller
{
    
    public function index()
    {
        return view('backend.projects.index');
    }

    public function create()
    {
        return view('backend.projects.create');
    }

    public function getdetails(Request $request)
    {       
        $data = Projects::get();
        return DataTables::of($data)
            ->addColumn('status', function($data){
                if($data->status == 'Enabled'){
                    $status = '<span class="badge badge-success">Enabled</span>';
                }
                else{
                    $status = '<span class="badge badge-danger">Disabled</span>';
                }   
                return $status;
            })
            ->addColumn('action', function($data){
                $button1 = '<a href="'.route('admin.projects.edit',$data->id).'" name="edit" id="'.$data->id.'" class="edit btn btn-secondary text-dark btn-sm ml-3" style="margin-right: 10px"><i class="fas fa-edit"></i> Edit </a>';
                $button2 = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>';
                return $button1.$button2;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        
        return back();
    }

    public function store(Request $request)
    {        
        // dd($request);  
    
        $add = new Projects;

        $add->title = $request->title;        
        $add->description = $request->description;
        $add->country = $request->country;
        $add->order = $request->order;
        $add->status = $request->status;

        $add->save();

        return redirect()->route('admin.projects.index')->withFlashSuccess('Added Successfully');    
                    
    }

    public function edit($id)
    {
        $projects = Projects::where('id',$id)->first(); 

        return view('backend.projects.edit',[
            'projects' => $projects
        ]);
    }

    public function update(Request $request)
    {        
        // dd($request);                         
    
        $update = new Projects;

        $update->title = $request->title;        
        $update->description = $request->description;
        $update->country = $request->country;
        $update->order = $request->order;
        $update->status = $request->status;

        Projects::whereId($request->hidden_id)->update($update->toArray());

        return redirect()->route('admin.projects.index')->withFlashSuccess('Updated Successfully');            

    }

    public function destroy($id)
    {
        Projects::where('id', $id)->delete(); 
    }

}
