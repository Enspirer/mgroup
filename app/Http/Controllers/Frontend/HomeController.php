<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Projects;
use App\Models\Upload;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }


    public function get_all_news()
    {
        $all_news = News::where('status','Enabled')->get();
        // dd($all_news);
       
        if(count($all_news) != 0){

            $output = [];

            foreach($all_news as $key => $news){
                // dd($news);      
                
                $upload_image = Upload::where('id',$news->images)->first();  
                $upload_final_name = ltrim($upload_image->file_name, 'uploads/all');    

                $news_images = ['id' => "$upload_image->id",'image' => $upload_final_name];
                // dd($news_images);            

                $new_array = [
                    'id' => $news->id,
                    'headline' => $news->title,
                    'description' => $news->description,
                    'date' => $news->created_at->toDateString(),
                    'status' => "1",
                    'images' => [$news_images]
                ];
                array_push($output,$new_array);
            }
            // dd($output);

            $final_out = [
                'status' => 200, 
                'data' => $output
            ];
            
            return response()->json($final_out);

        }else{

            return null;    

        }

    }

    public function get_featured_news()
    {
        $featured_news = News::where('status','Enabled')->where('featured','Enabled')->first();
        // dd($featured_news);

        if($featured_news != null){

            $upload_image = Upload::where('id',$featured_news->images)->first();  
            $upload_final_name = ltrim($upload_image->file_name, 'uploads/all');    
    
            $news_images = ['id' => "$upload_image->id",'image' => $upload_final_name];
    
            $new_array = [
                'id' => $featured_news->id,
                'headline' => $featured_news->title,
                'description' => $featured_news->description,
                'date' => $featured_news->created_at->toDateString(),
                'status' => "1",
                'images' => $news_images
            ];
           
            // dd($new_array);
    
            $final_out = [
                'status' => 200, 
                'data' => $new_array
            ];    
            
            return response()->json($final_out); 

        }else{

            return null;    

        }        

    }





    public function get_all_projects()
    {
        $all_projects = Projects::where('status','Enabled')->get();
        // dd($all_projects);
       
        if(count($all_projects) != 0){

            $output = [];

            foreach($all_projects as $key => $project){
                // dd($news);     
            
                $new_array = [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'date' => $project->created_at->toDateString(),
                    'country' => $project->country,
                    'status' => "1"
                ];
                array_push($output,$new_array);
            }
            // dd($output);

            $final_out = [
                'status' => 200, 
                'data' => $output
            ];
            
            return response()->json($final_out);

        }else{

            return null;    

        }

    }

    










}
