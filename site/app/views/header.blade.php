<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Andorra</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Andorra" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        {{HTML::style('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}
        {{HTML::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}
        {{HTML::style('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}
        <!-- END GLOBAL MANDATORY STYLES -->

        {{HTML::style('assets/global/plugins/datatables/datatables.min.css')}}
        {{HTML::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}
        {{HTML::style('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}
        <!-- BEGIN THEME GLOBAL STYLES -->
        {{HTML::style('assets/global/css/components.min.css')}}
        {{HTML::style('assets/global/css/plugins.min.css')}}
        <!-- END THEME GLOBAL STYLES -->

        {{HTML::style('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}
        {{HTML::style('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}

        {{HTML::style('assets/global/plugins/select2/css/select2.min.css')}}
        {{HTML::style('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}
        {{HTML::style('assets/global/plugins/jquery-notific8/jquery.notific8.min.css')}}
        <!-- BEGIN THEME LAYOUT STYLES -->

        {{HTML::style('assets/layouts/layout/css/layout.min.css')}}
        {{HTML::style('assets/layouts/layout/css/themes/sass/layouts/layout/themes/blue.css')}}
        {{HTML::style('assets/layouts/layout/css/custom.min.css')}}
        {{HTML::style('assets/admin/css/ladda-themeless.min.css')}}
        {{HTML::style('assets/admin/css/angular-datatables.min.css')}}
        {{HTML::style('assets/admin/css/angular-tooltips.min.css')}}

        {{HTML::style('assets/admin/css/angular-popover.css')}}

        <!--{{HTML::style('assets/admin/css/multiple-select.min.css')}}-->
        {{HTML::style('assets/admin/css/isteven-multi-select.css')}}
        
        {{HTML::style('assets/admin/css/dragular.min.css')}}

        {{HTML::style('assets/slider/rzslider.min.css')}}

        {{HTML::style('assets/admin/css/ng-img-crop.css')}}
        {{HTML::style('assets/admin/css/spinner.css')}}

        {{HTML::style('assets/admin/css/selectize.bootstrap3.css')}}  

        <!-- {{HTML::style('assets/admin/css/magic.min.css')}} -->
        {{HTML::style('assets/admin/css/animate.css')}}  
        {{HTML::style('assets/admin/css/va-style.css')}}  
        
        {{HTML::style('https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.css')}}

        {{HTML::style('assets/admin/css/custom.css?v=1.4.6')}}

        {{HTML::script('assets/global/plugins/jquery.min.js')}}

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ3wn5xfgtSDRim3DZGBEq-YYTUn6MXVE&libraries=places"></script>

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{url('favicon.ico')}}" />
    </head>
    <!-- END HEAD -->

    @if(!isset($default_header))
        <body class="page-header-fixed page-sidebar-closed-hide-logo" ng-app="app">
    @else
        <body class="white" ng-app="app">
    @endif