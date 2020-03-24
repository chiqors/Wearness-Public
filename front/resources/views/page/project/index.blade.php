@php
    use App\Project;        
@endphp
@extends('index')

@section('style')
  <link href="/asset/css/owl.carousel.min.css" rel="stylesheet" />
  <link href="/asset/css/owl.theme.default.min.css" rel="stylesheet" />    
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
            <a href="{{ url('student/project/create') }}" class="btn btn-primary btn-sm float-right">Add project</a>
        </div>              
        </div>
    </div>
    <div class="card-body">               
        <h6 class="heading-small text-muted mb-4">Current project</h6>
        <div class="pl-lg-4">
            <div class="row owl-carousel">
                    
                @foreach ($current as $key => $value)
                <div class="item">
                    <div class="card">
                        <div class="card-body" style="height: 400px;">
                            <div class="card-title text-truncate tooltips" title="{{ $value->title }}">{{ $value->title }}</div>
                            <iframe width="100%" src="{{ $value->url }}"></iframe>
                            <p class="card-text mt-3">{{ $value->desc }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <div>
                                <button type="button" onClick='pdfClick("{{ $value->url }}", "sss" , "s")' data-toggle="modal" data-target="#learnNow" class="btn btn-success btn-sm">Detail</button>
                                </div>
                                <div class="ml-3">
                                <i class="ni ni-single-02"> {{ $value->user->name }}</i>
                                <i class="ni ni-calendar-grid-58"> {{ $value->created_at->format('D d M Y') }}</i>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>               
        </div>        
        @foreach ($category as $key => $value)
        @php
            $project = Project::where('category_project_id', $value->id)->get();
        @endphp
        
        <hr class="my-4" />
        <h6 class="heading-small text-muted mb-4">{{ $value->category }}</h6>
        <div class="pl-lg-4">
            <div class="row owl-carousel">
                @foreach ($project as $key1 => $value1)
                <div class="item">
                    <div class="card">
                        <div class="card-body" style="height: 400px;">
                            <div class="card-title text-truncate tooltips" title="{{ $value1->title }}">{{ $value1->title }}</div>
                            <iframe width="100%" src="{{ $value1->url }}"></iframe>
                            <p class="card-text mt-3">{{ $value1->desc }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <div>
                                <button type="button" onClick='pdfClick("{{ $value1->url }}", "sss" , "s")' data-toggle="modal" data-target="#learnNow" class="btn btn-success btn-sm">Detail</button>
                                </div>
                                <div class="ml-3">
                                <i class="ni ni-single-02"> {{ $value1->user->name }}</i>
                                <i class="ni ni-calendar-grid-58"> {{ $value1->created_at->format('D d M Y') }}</i>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach                   
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
  <script src="/asset/js/owl.carousel.min.js"></script>
  <script>
        function pdfClick(src, title, desc) {
            $('#desc').text(desc)            
            $('.modal-title').text(title)
            $('#modalPdf').modal('show')
            $('#content').attr('src', src)
        }

        function GoInFullscreen(element) {
            console.log(element)
            console.log($('#' + element))
            if (document.querySelector("#" + element).requestFullscreen)
                document.querySelector("#" + element).requestFullscreen();
            else if (document.querySelector("#" + element).mozRequestFullScreen)
                document.querySelector("#" + element).mozRequestFullScreen();
            else if (document.querySelector("#" + element).webkitRequestFullscreen)
                document.querySelector("#" + element).webkitRequestFullscreen();
            else if (document.querySelector("#" + element).msRequestFullscreen)
                document.querySelector("#" + element).msRequestFullscreen();
        }

      $(document).ready(function() {
        $('.tooltips').tooltip()
        $('.owl-carousel').owlCarousel({
            stagePadding: 50,
            // loop:true,
            margin:10,
            nav:false,
        })
      })
  </script>
@endpush