<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" value="{{ csrf_token() }}">
    <title>Laravel</title>
    {!! Html::style('css/app.css') !!}
</head>
<body id="app-layout">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mail-box">
                <aside class="sm-side">
                    <div class="user-head">
                        <a class="inbox-avatar" href="javascript:;">
                            <img  width="64" hieght="60" src="http://bootsnipp.com/img/avatars/ebeb306fd7ec11ab68cbcaa34282158bd80361a7.jpg">
                        </a>
                        <div class="user-name">
                            <h5><a href="#">{{ Auth::user()->name }}</a></h5>
                            <span><a href="#">{{ Auth::user()->email }}</a></span>
                            <br>
                            <span>
                                <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                            </span>
                        </div>
                        <a class="mail-dropdown pull-right" href="javascript:;">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                    <div class="inbox-body">
                        <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
                            Compose
                        </a>
                        <!-- Modal -->
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Compose</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">To</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="" id="inputEmail1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Cc / Bcc</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="" id="cc" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Subject</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="" id="inputPassword1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Message</label>
                                                <div class="col-lg-10">
                                                    <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="files[]" multiple="">
                                                    </span>
                                                    <button class="btn btn-send" type="submit">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    <sidebar></sidebar>
                </aside>
                <aside class="lg-side">
                    <div class="inbox-head">
                        <h3>Inbox</h3>
                        <form action="#" class="pull-right position">
                            <div class="input-append">
                                <input type="text" class="sr-input" placeholder="Search Mail">
                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
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
