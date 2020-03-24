@extends('index')

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Modul</a>    
@endsection

@section('content')

<div class="row">
@foreach ($modul as $key => $value)    
<div class="col-xl-4 order-xl-1">
<div class="card bg-secondary shadow">
    <div class="card-header">
        <h5 class="mb-0 text-truncate tooltips" title="{{ $value->title }}">{{ $value->title }}</h5>        
    </div>  
    <div class="card-body" style="height: 200px;">           
        <p class="card-text tooltips">{{ Str::limit($value->desc, 150, '...') }}</p>        
    </div>
    <div class="card-footer">
        @if ($value->premium == 'false')
            <button type="button" onClick='pdfClick("{{ $dev->url }}/modulss/extra/{{ $value->file }}/index.html", "{{ $value->title }}", "{{ $value->desc }}")' data-toggle="modal" data-target="#learnNow" class="btn btn-primary btn-sm">Learn now</button>
        @elseif($value->premium == 'true' && Auth::user()->customer->premium == 'true')                
            <button type="button" onClick='pdfClick("{{ $dev->url }}/modulss/extra/{{ $value->file }}/index.html", "{{ $value->title }}")' data-toggle="modal" data-target="#learnNow" class="btn btn-success btn-sm">Learn now <i class="ni ni-key-25"></i></button>
        @else
            <button class="btn btn-success btn-sm" disabled data-toggle="tooltip" title="Buy premium now"><i class="ni ni-key-25"></i></button>
        @endif
    </div>
</div>
</div>
@endforeach
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
        <button class="btn btn-primary" onclick="GoInFullscreen('content')">Full screen <i class="fas fa-compress"></i></button>
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
      })
  </script>
@endpush