<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>{{(isset($title))?$title:'HR APP'}}</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{url('front-end/img/favicon.png')}}">

	{{HTML::style('front-end/css/bootstrap.min.css')}}
	{{HTML::style('front-end/css/owl.carousel.css')}}
	{{HTML::style('front-end/css/owl.theme.css')}}
	{{HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}
    {{HTML::style('front-end/css/ladda-themeless.min.css')}}
	{{HTML::style('front-end/css/main.css?v=1.0.4')}}
	{{HTML::style('front-end/css/responsive.css')}}

</head>
<body  ng-app="app">