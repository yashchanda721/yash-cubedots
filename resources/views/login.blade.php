<div class="col-sm-6 col-md-6 login-form-2">
    <h3 class="text-center text-white">Sign in</h3>
    <form id="loginForm" action="{{url('api/auth/login')}}" method="post" autocomplete="off">
        <div class="form-group">
            <input type="email" id="l_aUser_email" name="email" required class="form-control input-lg" placeholder="Your Email *" value="" />
            @csrf
            <p id="errorr" style="color:red"></p>
        </div>
        <div class="form-group pt-sm">
            <input type="password" id="l_aUser_pwd" name="password" required class="form-control input-lg" placeholder="Your Password *" value="" />
        </div>
        <div class="form-group pt-sm">
            <button type="submit" id="button" class="btnSubmit pull-left">Sign In</button>
        </div>



    </form>
</div>
