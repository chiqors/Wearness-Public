@extends('index')

@section('style')
  
@endsection

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Project add</a>    
@endsection

@section('content')
<div class="row">    
    <div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
        <div class="col-12">
            <h3 class="mb-0 float-left">Project add</h3>
            <a href="{{ url('student/project/create') }}" class="btn btn-success btn-sm float-right ml-3">Current list</a>
            <a href="{{ url('student/project') }}" class="btn btn-primary btn-sm float-right">List project</a>
        </div>              
        </div>
    </div>
    <div class="card-body">   
        @if (Session::has('errorss'))
            <div class="alert alert-danger">
                {{ Session::get('errorss') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('project.update', $project->id) }}" method="POST">
          @csrf            
          @method('PUT')
        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                <div class="form-gorup @error('category') has-danger @enderror">
                <div class="input-group input-group-alternative mb-3">                   
                    <select name="category" id="" class="form-control @error('category') is-invalid @enderror" required>
                        <option value="">Category project</option>
                        @foreach ($category as $key => $value)
                        <option value="{{ $value->id }}" {{ $value->id == $project->category_project_id ? 'selected' : false }}>{{ $value->category }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>    
                </div>  
                <div class="col-lg-6">
                <div class="form-group @error('url') has-danger @enderror">
                <div class="input-group input-group-alternative mb-3">                    
                    <input class="form-control @error('url') is-invalid @enderror" placeholder="Url youtube" name="url" type="url" value="{{ $project->url }}" required>

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div>
                </div>   
                <div class="col-lg-12">
                <div class="form-group @error('title') has-danger @enderror">
                <div class="input-group input-group-alternative mb-3">                    
                    <input class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" type="text" required value="{{ $project->title }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div>
                </div>   
                <div class="col-md-12">
                <div class="form-group @error('desc') has-danger @enderror">
                    <textarea class="form-control form-control-alternative" name="desc" rows="10" placeholder="Desc ...">{{ $project->desc }}</textarea>
                    @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                </div>
                <div class="col-lg-12">
                        <button type="submit" class="btn btn-danger btn-sm mt-4 float-right">Update</button>
                  </div>
            </div>        
        </div>               
        </form>
    </div>
    </div>
</div>                      
</div>

@endsection

@push('script')
    <!--   Core   -->
  <script src="/admin/assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="/admin/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>    
  <script src="/admin/assets/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="/admin/assets/js/argon-dashboard.min.js?v=1.1.0"></script>
 
@endpush