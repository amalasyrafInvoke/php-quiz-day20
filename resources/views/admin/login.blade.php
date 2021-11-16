@extends('layout.default')

@section('content')
<section class="vh-100" style="background-color: #9A616D;">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img
                  src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/img1.jpg"
                  alt="login form"
                  class="img-fluid" style="border-radius: 1rem 0 0 1rem;"
                />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form method="POST">
                    @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                    <div class="form-outline mb-4">
                      <input type="email" name="email" id="email" class="form-control form-control-lg" />
                      <label class="form-label" for="email">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" name="password"  id="password" class="form-control form-control-lg" />
                      <label class="form-label" for="password">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button id="loginBtn" class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@stop

@section('scripts')
<script>
    // Your custom JavaScript...
    $('#loginBtn').on('click', function(event) {

    });

    $(document).ready(function(){
    $("#loginBtn").click(function(){
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();

        if( email != "" && password != "" ){
            $.ajax({
                url:'/admin/login',
                type:'post',
                data:{email:email,password:password, _token:""},
                success:function(response){
                    var msg = "";
                    if(response == 1){
                        //window.location = "home.php";
                    }else{
                        //msg = "Invalid username and password!";
                    }
                    $("#message").html(msg);
                },
                error:function(error){
                    console.log(error);
                },
            });
        }
    });
});

</script>
@stop



