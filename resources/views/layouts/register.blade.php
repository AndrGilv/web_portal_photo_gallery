
<div class="wrapper row3">
    <main class="hoc container clear">
        <div class="content">
            <div id="gallery">
                <figure>
                    <div class="row align-items-center">
                        <div class="col-4 mx-auto" >
                            <form method="post" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="name" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control p_input">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
                                </div>

                                <p class="sign-up text-center">Already have an Account?<a href="{{ route('login') }}"> Sign In</a></p>
                            </form>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </main>
</div>





