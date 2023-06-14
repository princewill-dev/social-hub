<x-layout>


    <div class="container py-md-5">
        <div class="row align-items-center">
          <div class="col-lg-7 py-3 py-md-5">
            <h1 class="display-3">Welcome to Naijapals</h1>
            <p class="lead text-muted">This social website is designed to bring people together around shared interests, hobbies, and passions. It allows users to create a profile, join or create groups, and connect with others who share similar interests.</p>
          </div>
          <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            <form action="/register" method="POST" id="registration-form">
              @csrf
              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>Username</small></label>
                <input name="username" id="username-register" class="form-control" type="text" placeholder="Pick a username" autocomplete="off" />
                @error('username')
                    <span class="mb-0 small alert alert-danger shadow-dm">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="phone-register" class="text-muted mb-1"><small>Phone</small></label>
                <input name="phone" id="phone-register" class="form-control" type="text" placeholder="Enter phone number" autocomplete="off" />
                @error('phone')
                    <span class="mb-0 small alert alert-danger shadow-dm">{{$message}}</span>
                @enderror
              </div>
  
              <div class="form-group">
                <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                <input name="email" id="email-register" class="form-control" type="text" placeholder="you@example.com" autocomplete="off" />
                @error('email')
                    <span class="mb-0 small alert alert-danger shadow-dm">{{$message}}</span>
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>Password</small></label>
                <input name="password" id="password-register" class="form-control" type="password" placeholder="Create a password" />
                @error('password')
                    <span class="mb-0 small alert alert-danger shadow-dm">{{$message}}</span>
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password-register-confirm" class="text-muted mb-1"><small>Confirm Password</small></label>
                <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Confirm password" />
                @error('password_confirmation')
                    <span class="mb-0 small alert alert-danger shadow-dm">{{$message}}</span>
                @enderror
              </div>
  
              <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Sign up for NaijaPals</button>
            </form>
          </div>
        </div>
      </div>


</x-layout>