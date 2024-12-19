@extends('frontend.layout.app')

@section('content')
<section class="vh-80 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-light" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-md-5 mt-md-4 pb-5">
        
                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                        <p class=" mb-5">Please enter your login and password!</p>
        
                        <div class="form-outline form-white mb-4">
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required />
                            <label class="form-label" for="email">Email</label>
                        </div>
        
                        <div class="form-outline form-white mb-4">
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required />
                            <label class="form-label" for="password">Password</label>
                        </div>
        
                        <p class="small mb-5 pb-lg-2"><a class="" href="#!">Forgot password?</a></p>
        
                        <button class="btn btn_outline_secondary btn-lg px-5 w-100 d-flex justify-content-center" type="submit">Login</button>
        
                    </div>
        
                    <div>
                        <p class="mb-0">Don't have an account? <a href="#!" class=" fw-bold">Sign Up</a>
                        </p>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
