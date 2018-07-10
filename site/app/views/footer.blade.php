

    <script type="text/javascript">
            var base_url = "{{url('/')}}";
            var api_token = '{{Session::get('api_token')}}';
            console.log(api_token);
    </script>

        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <script src="../assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        {{HTML::script('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}
        
        {{HTML::script('assets/admin/scripts/jquery.easing.1.3.js')}}
        {{HTML::script('assets/admin/scripts/jquery.mousewheel.js')}}
        {{HTML::script('assets/admin/scripts/jquery.vaccordion.js')}}
        
        {{HTML::script('assets/admin/scripts/selectize.min.js')}}
        

        {{HTML::script('assets/global/plugins/js.cookie.min.js')}}

        {{HTML::script('assets/global/scripts/datatable.min.js')}}
        {{HTML::script('assets/global/plugins/datatables/datatables.min.js')}}
        {{HTML::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}

        {{HTML::script('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}
        {{HTML::script('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}

        {{HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}
        {{HTML::script('assets/global/plugins/select2/js/select2.full.min.js')}}
        {{HTML::script('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')}}
        {{HTML::script('assets/global/plugins/jquery-notific8/jquery.notific8.min.js')}}

        <!-- END CORE PLUGINS -->
        {{HTML::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}

        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {{HTML::script('assets/global/scripts/bootbox.min.js')}}
        {{HTML::script('assets/global/scripts/app.min.js')}}

        {{HTML::script('assets/scripts/ui-confirmations.min.js')}}

        {{HTML::script('assets/admin/scripts/accounting.min.js')}}

        <!-- END THEME GLOBAL SCRIPTS -->
        
        {{HTML::script('assets/layouts/layout/scripts/layout.min.js')}}

        <!-- BEGIN ANGULAR SCRIPTS -->
        {{HTML::script('assets/admin/scripts/angular.min.js')}}
        {{HTML::script('assets/admin/scripts/jcs-auto-validate.js')}}
        {{HTML::script('assets/admin/scripts/filter.js')}}
        {{HTML::script('assets/admin/scripts/spin.min.js')}}
        {{HTML::script('assets/admin/scripts/ladda.min.js')}}
        {{HTML::script('assets/admin/scripts/angular-ladda.min.js')}}
        {{HTML::script('assets/admin/scripts/angular-datatables.min.js')}}
        {{HTML::script('assets/admin/scripts/angular-tooltips.min.js')}}
        {{HTML::script('assets/admin/scripts/angular-popover.min.js')}}
        {{HTML::script('assets/admin/scripts/ng-img-crop.js')}}
        {{HTML::script('assets/admin/scripts/ng-file-upload-shim.min.js')}}
        {{HTML::script('assets/admin/scripts/ng-file-upload.min.js')}}
        {{HTML::script('assets/admin/scripts/multiple-select.min.js')}}
        {{HTML::script('assets/admin/scripts/isteven-multi-select.js')}}

        {{HTML::script('assets/admin/scripts/echarts.min.js?v=1.0.1')}}
        {{HTML::script('assets/admin/scripts/ng-echarts.min.js')}}

        {{HTML::script('assets/admin/scripts/angular-drag-and-drop-lists.js')}}
        {{HTML::script('assets/admin/scripts/dragular.min.js')}}

        {{HTML::script('assets/slider/rzslider.min.js')}}

        {{HTML::script('assets/admin/scripts/angular-selectize.js')}}
        {{HTML::script('assets/admin/scripts/angular-sanitize.js')}}

        {{HTML::script('assets/admin/scripts/app.js?v=1.7.2')}}

        {{HTML::script('//cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.js')}}
        {{HTML::script('assets/admin/scripts/angular-trix.min.js')}}

        {{HTML::script('assets/admin/scripts/custom.js?version=1.7.2')}}

        {{HTML::script('assets/admin/scripts/controllers/andorra.js?v=1.7.2')}}
        {{HTML::script('assets/admin/scripts/controllers/andorra_ques.js?v=1.7.2')}}
        {{HTML::script('assets/admin/scripts/controllers/andorra_results.js?v=1.7.2')}}

        {{HTML::script('assets/admin/scripts/services/andorra_service.js?v=1.7.2')}}

        <script type="text/javascript">
            @if(Session::has('success'))
                $.notific8('{{Session::get('success')}}',{life:4000,theme: 'lemon'});
            @endif
            @if(Session::has('failure'))
                $.notific8('{{Session::get('failure')}}',{life:4000,theme: 'ruby'});
            @endif
        </script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>