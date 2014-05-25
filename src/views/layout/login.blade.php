<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>{{ trans('admin-panel::admin.title') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="{{asset('packages/nifus/admin-panel/style/bootstrap.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/font-awesome.css')}}">
  <link href="{{asset('packages/nifus/admin-panel/style/style.css')}}" rel="stylesheet">

  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="{{asset('packages/nifus/admin-panel/js/html5shim.js')}}"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('packages/nifus/admin-panel/img/favicon/favicon.png')}}">

    <script src="{{asset('packages/nifus/admin-panel/js/jquery.js')}}"></script>
    <script src="{{asset('packages/nifus/admin-panel/js/bootstrap.js')}}"></script>

</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="icon-lock"></i> {{ trans('admin-panel::admin.title') }}
              </div>

              <div class="widget-content">
                <div class="padd">
                    @if ( $form->error() )
                    <div class="alert alert-danger">{{$form->error()}}</div>
                    @endif
                    <!-- Login form -->
                  <form class="form-horizontal" method="post" id="auth_form">
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">{{ trans('admin-panel::admin.email') }}</label>
                      <div class="col-lg-9">
                          {{$form->field('email')}}
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">{{ trans('admin-panel::admin.pass') }}</label>
                      <div class="col-lg-9">
                          {{$form->field('pass')}}

                      </div>
                    </div>
                    <div class="form-group">
					<div class="col-lg-9 col-lg-offset-3">
                      <div class="checkbox">
                        <label>
                            {{$form->field('remember_me')}}
                        </label>
						</div>
					</div>
					</div>
                        <div class="col-lg-9 col-lg-offset-2">
							{{$form->field('button_input')}}
						</div>
                    <br />
                  </form>

				</div>
                </div>


            </div>
      </div>
    </div>
  </div>
</div>


{{$form->css()}}

{{$form->js()}}

</body>
</html>