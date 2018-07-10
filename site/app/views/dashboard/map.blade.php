@include('header')
<style type="text/css">
    .echarts {
        width: 500px;
        height: 500px;
        background: #F00;
    }
</style>
<div ng-controller="mapCtrl" ng-init="initials()">
    <div id="main" style="width: 600px;height:400px;"></div>
</div>
@include('footer')