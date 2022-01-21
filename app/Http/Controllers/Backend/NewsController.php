<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\News;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        return view('backend.news.index');
    }

    public function create()
    {
        return view('backend.news.create');
    }

    public function getdetails(Request $request)
    {       
        $data = News::get();
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
            ->addColumn('featured', function($data){
                if($data->featured == 'Enabled'){
                    $featured = '<span class="badge badge-success">Enabled</span>';
                }
                else{
                    $featured = '<span class="badge badge-danger">Disabled</span>';
                }   
                return $featured;
            })
            ->addColumn('images', function($data){
                $img = '<img src="'.uploaded_asset($data->images).'" style="width: 80%">';
                 
                return $img;
            })
            ->addColumn('action', function($data){
                $button1 = '<a href="'.route('admin.news.edit',$data->id).'" name="edit" id="'.$data->id.'" class="edit btn btn-secondary text-dark btn-sm ml-3" style="margin-right: 10px"><i class="fas fa-edit"></i> Edit </a>';
                $button2 = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>';
                return $button1.$button2;
            })
            ->rawColumns(['action','status','images','featured'])
            ->make(true);
        
        return back();
    }

    public function store(Request $request)
    {        
        // dd($request);  
    
        if($request->get('image') == null){
            return back()->withErrors('Please Add an Image');
        }         

        if($request->featured == 'Enabled')
        {            
            DB::table('news')->where('featured','Enabled')->update(array('featured' => 'Disabled'));           
        } 

        $add = new News;

        $add->title = $request->title;        
        $add->description = $request->description;
        $add->images = $request->image;
        $add->order = $request->order;
        $add->featured = $request->featured;
        $add->status = $request->status;

        $add->save();

        return redirect()->route('admin.news.index')->withFlashSuccess('Added Successfully');    
                    
    }

    public function edit($id)
    {
        $news = News::where('id',$id)->first(); 

        return view('backend.news.edit',[
            'news' => $news
        ]);
    }

    public function update(Request $request)
    {        
        // dd($request);                              
      
        if($request->get('image') == null){
            return back()->withErrors('Please Add an Image');
        }    

        if($request->featured == 'Enabled')
        {            
            DB::table('news')->where('featured','Enabled')->update(array('featured' => 'Disabled'));           
        } 

        $update = new News;

        $update->title = $request->title;        
        $update->description = $request->description;
        $update->images = $request->image;
        $update->order = $request->order;
        $update->featured = $request->featured;
        $update->status = $request->status;

        News::whereId($request->hidden_id)->update($update->toArray());

        return redirect()->route('admin.news.index')->withFlashSuccess('Updated Successfully');            

    }

    public function destroy($id)
    {
        News::where('id', $id)->delete(); 
    }
    

}
