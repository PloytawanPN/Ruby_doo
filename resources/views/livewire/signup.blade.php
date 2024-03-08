<div>
    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <div class="auth-brand text-center text-lg-left logo_image">
                        <i class='bx bxl-graphql'></i>
                        <h1>RubyDoo</h1>
                    </div>

                    <div class="space"></div>

                    <h4 class="mt-0">Sign Up</h4>
                    <p class="text-muted mb-4">Enter your username and password to create account.</p>


                        <div class="form-group">

                            <label for="emailaddress">Username</label>
                            <input class="form-control" type="text" placeholder="Enter your username" wire:model='username'>
                            @error('username')
                                <label class="error">{{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" placeholder="Enter your password" wire:model='password'>
                            @error('password')
                                <label class="error">{{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input class="form-control" type="password" placeholder="Confirm your password" wire:model='confirm_password'>
                            @error('confirm_password')
                                <label class="error">{{$message}}</label>
                            @enderror
                        </div>

                        <div class="form-group mb-0 text-center" style="margin-top: 30px">
                            <button class="btn btn-primary btn-block" wire:click='register'><i class="mdi mdi-login"></i>
                                Register </button>
                        </div>


                    <footer class="footer footer-alt">
                        <p class="text-muted">Already have an account?<a href="/signin" class="text-muted ml-1"><b>Sign
                                    IN</b></a></p>
                    </footer>

                </div>
            </div>
        </div>

        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Rubydoo.com</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Register your information to join us.
                    <i class="mdi mdi-format-quote-close"></i>
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
</div>
