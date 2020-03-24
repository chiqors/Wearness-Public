@extends('index')

@section('style')  
@endsection

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Project</a>    
@endsection

@section('content')
<div class="row">    
    <div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
        <div class="col-12">
            <h3 class="mb-0 float-left">Project</h3>
            <a class="btn btn-success btn-sm text-white float-right ml-2" href="{{ url('student/add') }}">Add</a>
            <a href="{{ url('student/project') }}" class="btn btn-primary btn-sm float-right">List project</a>
        </div>              
        </div>
    </div>
    <div class="card-body">               
        <h6 class="float-left heading-small text-muted">Current project</h6>
        <div class="pl-lg-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Category</th>
                        <th>Url youtube</th>
                        <th>Title</th>
                        <th>Desc</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($project as $key => $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->categoryProject->category }}</td>
                            <td>{{ $value->url }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->desc }}</td>
                            <td>
                                <a href="{{ route('project.edit', $value->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{route('project.destroy', $value->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                <button onclick="return confirm('Are you sure?')" id="btnDelete"class="btn btn-danger btn-sm">Delete</button>
                               </form>
                                <script type="javascript">
                                    document.onsubmit=function(){
                                        return confirm('Are you sure?');
                                    }
                                </script>                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $project->render() }}
            </div>           
        </div>               
    </div>
    </div>
</div>                      
</div>

<div class="modal fade" id="learnNow" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <iframe id="content" class="iframe" src="" frameborder="0" id="content" width="100%" style="height:90vh"></iframe>
        <p id="desc"></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
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