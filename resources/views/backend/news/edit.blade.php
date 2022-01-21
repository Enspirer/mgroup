@extends('backend.layouts.app')

@section('title', __('Edit News'))

@section('content')

    <form action="{{route('admin.news.update')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{ $news->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" name="description" rows="4" required>{{ $news->description }}</textarea>
                        </div> 
                        <div class="form-group">
                            <label>Order <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="order" value="{{ $news->order }}" required>
                        </div>
                        <div class="form-group">
                            <label>Image
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                </div>
                                <div class="form-control file-amount">Choose File</div>
                                <input type="hidden" name="image" value="{{ $news->images }}" class="selected-files" >
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Featured <span class="text-danger">*</span></label>
                            <select class="form-control custom-select" name="featured" required>
                                <option value="Enabled" {{$news->featured == 'Enabled' ? "selected" : ""}}>Enable</option>   
                                <option value="Disabled" {{$news->featured == 'Disabled' ? "selected" : ""}}>Disable</option>                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="form-control custom-select" name="status" required>
                                <option value="Enabled" {{$news->status == 'Enabled' ? "selected" : ""}}>Enable</option>   
                                <option value="Disabled" {{$news->status == 'Disabled' ? "selected" : ""}}>Disable</option>                                
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="text-right">
                    <input type="hidden" name="hidden_id" value="{{ $news->id }}" />
                    <button type="submit" class="btn btn-success pull-right">Update News</button><br>
                </div>


            </div><br>
                      
        </div>

    </form>

    
<br><br>




@endsection
