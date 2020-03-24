@extends('index')

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">User Profile</a>    
@endsection

@section('content')
<div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">My account</h3>
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
            <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">                  
                  <div class="col-lg-6">
                    <div class="form-group @error('email') has-danger @enderror">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" type="email" value="{{ Auth::user()->email }}" required>
    
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group @error('name') has-danger @enderror">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                        </div>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" placeholder="Name" type="text" required>
    
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group @error('birth_date') has-danger @enderror">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker @error('birth_date') is-invalid @enderror " placeholder="Birth date" name="birth_date" type="text" value="{{ Auth::user()->customer->birth_date }}" required>
    
                        @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group @error('job') has-danger @enderror">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-ruler-pencil"></i></span>
                        </div>
                        <input class="form-control @error('job') is-invalid @enderror" name="job" value="{{ Auth::user()->customer->job }}" placeholder="Job" type="text" required>
    
                        @error('job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group @error('institution') has-danger @enderror">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-briefcase-24"></i></span>
                        </div>
                        <input class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ Auth::user()->customer->institution }}" placeholder="Institution" type="text" required>
    
                        @error('institution')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group row">
                        <span class="col-md-12">Gender</span>
                        <div class="custom-control custom-radio ml-3 col-md-6">
                            <input name="gender" class="custom-control-input" id="male" type="radio" {{ Auth::user()->customer->gender == "Male" ? 'checked' : false }} value="Male">
                            <label class="custom-control-label" for="male">Male</label>
                            </div>
                            <div class="custom-control custom-radio col-md-5">
                            <input name="gender" class="custom-control-input" id="female" type="radio" {{ Auth::user()->customer->gender == "Female" ? 'checked' : false }} value="Female">
                            <label class="custom-control-label" for="female">Female</label>
                            </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group @error('photo') has-danger @enderror">
                    <span>Change photo</span>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-image"></i></span>
                        </div>
                        <input class="form-control @error('photo') is-invalid @enderror" name="photo" placeholder="Phone number" type="file">
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                  </div>    
                  <div class="col-lg-6">
                    <div class="form-gorup @error('religion') has-danger @enderror mt-4">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-istanbul"></i></span>
                        </div>
                        <select name="religion" id="" class="form-control @error('religion') is-invalid @enderror" required>
                            <option value=""  {{ Auth::user()->customer->religion == 'null' ? 'selected' : false }}>Agama</option>
                            <option value="Islam" {{ Auth::user()->customer->religion == 'Islam' ? 'selected' : false }}>Islam</option>
                            <option value="Kristen Protestan" {{ Auth::user()->customer->religion == 'Kristen Protestan' ? 'selected' : false }}>Kristen Protestan</option>
                            <option value="Kristen Katolik" {{ Auth::user()->customer->religion == 'Kristen Katolik' ? 'selected' : false }}>Kristen Katolik</option>
                            <option value="Hindu" {{ Auth::user()->customer->religion == 'Hindu' ? 'selected' : false }}>Hindu</option>
                            <option value="Buddha" {{ Auth::user()->customer->religion == 'Buddha' ? 'selected' : false }}>Buddha</option>
                            <option value="Konghucu" {{ Auth::user()->customer->religion == 'Konghucu' ? 'selected' : false }}>Konghucu</option>
                            <option value="Others" {{ Auth::user()->customer->religion == 'Others' ? 'selected' : false }}>Others</option>
                        </select>
                        @error('religion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>    
                  </div>              
                </div>               
              </div>
              <hr class="my-4" />
              <!-- Address -->
              <h6 class="heading-small text-muted mb-4">Contact information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group @error('phone_number') has-danger @enderror">
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                        </div>
                        <input class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ Auth::user()->customer->phone_number }}" placeholder="Phone number" type="text" required>
    
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group @error('address') has-danger @enderror">
                        <textarea class="form-control border-0 shadow-sm" name="address" rows="3" placeholder="Address ...">{{ Auth::user()->customer->address }}</textarea>
                        @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                  </div>
                  <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary mt-4 float-right">Update</button>
                  </div>
                </div>                
              </div>
             </form>
              <hr class="my-4" />
              <!-- Description -->
              <h6 class="heading-small text-muted mb-4">Change password</h6>
              <form action="{{ route('setting.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT')
              <div class="pl-lg-4">
                    <div class="form-group @error('password_now') has-danger @enderror">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control @error('password_now') is-invalid @enderror" placeholder="Old Password" type="password" name="password_now" required >
    
                        @error('password_now')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>      
                    <div class="form-group @error('password') has-danger @enderror">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control @error('password') is-invalid @enderror" placeholder="New Password" type="password" name="password" required>    

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror  
                    </div>
                    </div>               
                    <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control"  placeholder="Password confirmation" type="password" name="password_confirmation" required >
                    </div>
                    </div>
                    <div class="col-lg-12">
                            <button type="submit" class="btn btn-success mt-4 float-right">Change password</button>
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