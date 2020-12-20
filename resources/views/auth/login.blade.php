@include('layouts.header')
<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

           <!-- Login form -->
           <form id="form-submit" class="login-form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Login Account</h5>
                        <span class="d-block text-muted">Enter you email and password.</span>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0px;list-style: none;padding-left: 0;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(Session::has('success-register'))

                    <div class="alert alert-success">
                        {{ Session::get('success-register') }}
                    </div>

                    @endif

                    @if(Session::has('success-change-password'))

                    <div class="alert alert-success">
                        {{ Session::get('success-change-password') }}
                    </div>

                    @endif

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="email" class="form-control {{ $errors->has('email')? 'border-danger' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" class="form-control {{ $errors->has('password')? 'border-danger' : '' }}" placeholder="Password" name="password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                        data-initial-text="Update <i class='icon-circle-right2 ml-2'></i>"
                        data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> Loading..."
                        class="btn btn-primary btn-block btn-loading button-submit mt-4"
                        >
                        Submit <i class="icon-circle-right2 ml-2"></i> </button>
                    </div>

                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">Don't have an account?</span>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('register') }}" class="btn btn-light btn-block">Sign up</a>
                    </div>

                </div>
            </div>
        </form>
        <!-- /login form -->
    </div>
    <!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        $('#form-submit').on('submit', function(e){

            var btn = $(this).find('button[type=submit]'),
            initialText = btn.data('initial-text'),
            loadingText = btn.data('loading-text');
            btn.html(loadingText).addClass('disabled').attr('disabled', true);

        });

    });
</script>
</html>