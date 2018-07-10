<!DOCTYPE html>

<html lang="en">
    
    <head>
        <meta charset="utf-8" />
        <title>AIFF | ADMINISTRATION</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        {{HTML::style('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}
       
        {{HTML::style('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}

        {{HTML::style('assets/global/css/components.min.css')}}
        {{HTML::style('assets/global/css/plugins.min.css')}}
        
        {{HTML::style('assets/admin/css/login.min.css')}}
        {{HTML::style('assets/global/css/owl.carousel.css')}}
        {{HTML::style('assets/global/css/owl.theme.css')}}
        {{HTML::style('assets/admin/css/custom.css?v=2.0.1')}}
        
        {{HTML::script('assets/global/plugins/jquery.min.js')}}

        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN LOGIN -->
        <div class="row" style="margin-top:80px">
            <div class="col-md-8 col-md-offset-2">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12 login-cont">
                            <div class="logo">
                                <img src="{{url('assets/img/logo.png')}}">
                            </div>
                            <!-- BEGIN LOGIN FORM -->
                            {{Form::open(["url"=>"/login","method"=>"post","class"=>"login-form"])}}
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <span> Enter any username and password. </span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                                    {{Form::text('username','',["class"=>"form-control form-control-solid placeholder-no-fix" , "placeholder" => "Username" , "autocomplete" => false])}}
                                </div>

                                <div class="form-group">
                                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                                    {{Form::password('password',["class"=>"form-control form-control-solid placeholder-no-fix" , "placeholder" => "Password" , "autocomplete" => false])}}
                                </div>

                                
                                <div class="form-actions">
                                    <button type="submit" class="btn green uppercase">Login</button>
                                    <label class="rememberme check mt-checkbox mt-checkbox-outline" style="display:none">
                                        <input type="checkbox" name="remember" value="1" />Remember
                                        <span></span>
                                    </label>
                                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                </div>
                                

                                <div class="login-options">
                                    <h4>Or login with</h4>
                                    <ul class="social-icons">
                                        <li>
                                            <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                                        </li>
                                    </ul>
                                </div>
                            {{Form::close()}}
                            <!-- END LOGIN FORM -->
                        </div>
                        <div class="col-md-8 slider-cont">
                            <div class="skewed-div"></div>
                            <div class="home-slider">

                                @if(isset($images))
                                    @foreach($images as $image)
                                    <div class="slider-img" style="background-image:url({{url($image->image_url)}})">
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function(){

            $(".home-slider").owlCarousel({
                items : 1,
                singleItem:true,
                loop:true,
                autoPlay:true,
                navigation:false
            });

        });
        </script>
        
        {{HTML::script('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}
        
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {{HTML::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}
        {{HTML::script('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {{HTML::script('assets/global/scripts/app.min.js')}}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {{HTML::script('assets/global/scripts/owl.carousel.min.js')}}
        {{HTML::script('assets/admin/scripts/login.min.js')}}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>