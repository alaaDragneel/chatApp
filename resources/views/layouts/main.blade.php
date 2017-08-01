<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" value="{{ csrf_token() }}">
    <title>Chat App</title>
    {!! Html::style('css/app.css') !!}
</head>
<body id="app-layout">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mail-box">
                <aside class="lg-side">
                    <div class="inbox-head">
                        <div class="row">
                          <div class="col-md-4">
                              <h3>Real Time Chat App</h3>
                          </div>
                          <div class="col-md-8">
                              <ul class="nav nav-pills pull-right">
                                  <sidebar></sidebar>
                                  <li role="presentation" class="dropdown">
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                           {{ Auth::user()->name }} <span class="caret"></span>
                                      </a>
                                      <ul class="dropdown-menu" style="left: -138%;">
                                          <li>
                                              <a v-link="{name: '/profile', params:{user_id: {{Auth::user()->id}}, user_name: '{{Auth::user()->name}}'}}" style="background-color: transparent;">
                                                 <i class="fa fa-user"></i> Profile
                                              </a>
                                          </li>
                                          <li>
                                              <a style="background-color: transparent;"
                                                    href="{{ url('/logout') }}">
                                                  <i class="fa fa-sign-out"></i>
                                                  Logout
                                              </a>
                                          </li>
                                      </ul>
                                      <div class="clearfix"></div>
                                  </li>

                              </ul>
                          </div>
                        </div>
                    </div>
                    <div class="inbox-body">
                        @yield('content')
                    </div>
                </aside>
            </div>
        </div>
    </div>
{!! Html::script('js/libs.js') !!}
{!! Html::script('js/app.js') !!}
</body>
</html>
