@extends('index')

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Feedback</a>    
@endsection

@section('content')
<div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">                  
                 Feedback
              </div>              
            </div>
          </div>
          <div class="card-body">
            @if (Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf              
                <!-- Address -->                
                  <div class="row">
                    <div class="col-md-12">
                    <div class="form-gorup @error('category') has-danger @enderror mt-4">                                  
                        <select name="category" id="" class="form-control border-0 shadow-sm @error('category') is-invalid @enderror" required>
                            <option value="">Category feedback</option>
                            @foreach ($category as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                    </div> 
                    <div class="col-md-12 mt-5">
                      <div class="form-group @error('feedback') has-danger @enderror">
                          <textarea class="form-control border-0 shadow-sm" name="feedback" rows="10" placeholder="Write a problem ..."></textarea>
                          @error('feedback')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                          <button type="submit" class="btn btn-primary mt-4 float-right">Send feedback</button>
                    </div>
                  </div>                
               </form>
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