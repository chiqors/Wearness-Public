@extends('index')

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Curiculum</a>    
@endsection

@section('content')
<div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">                  
                  @isset($curiculum)                      
                  <h3 class="mb-0">{{ $curiculum->title }}</h3>
                  @endisset
              </div>              
            </div>
          </div>
          <div class="card-body">
            @isset($curiculum)
            <iframe id="content" class="iframe" src="{{ $dev->url.'/curiculums/extra/'.$curiculum->file.'/index.html' }}" frameborder="0" id="content" width="100%" style="height:90vh"></iframe>
            @else
            <h1>Curiculum not found</h1>
            @endisset
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