<?php

Route::get('/logout', function(){
	Auth::logout();
	Session::flush();
	return Redirect::to('/');
});

Route::get('/','FrontEndController@index');

Route::get('/login','UserController@login');
Route::post('/login','UserController@postLogin');

Route::group(["before"=>"auth","prefix"=>"users"],function(){
	// Route::get('/dashboard','UserDashboardController@index');

	// Route::get('/profile','UserDashboardController@profile');
	// Route::get('/strategy','UserDashboardController@strategy');
	// Route::get('/strategy/create-pdf','UserDashboardController@strategyPDF');
	// Route::get('/home','UserDashboardController@home');
	// Route::get('/recommendations','UserDashboardController@recommendations');
	// Route::get('/recommended-portfolio','AndorraRecommendedPortfolioController@recommendation');
	// Route::get('/search','UserDashboardController@search');
	// Route::get('/portfolio','UserDashboardController@portfolio');
	// Route::get('/impact-report','UserDashboardController@impactReport');
	// Route::get('/impact-report-new','UserDashboardController@impactReportBeta');
	// Route::get('/financial-report','UserDashboardController@financialReport');
	// Route::get('/compare-andorra','UserDashboardController@compare');
	// Route::get('/what-you-own','UserDashboardController@whatYouOwn');
	// Route::get('/andorra-recommended-portfolio','UserDashboardController@recommededPortfolio');

	// Route::post('/update/profile','UserController@updateProfile');

	Route::get('/questionnaire/{questionnaire_id}','UserDashboardController@questionnaire');

	// Route::get('/result','UserResultController@result');

	// Route::get('/graph-api','GraphApiController@result');

	// Route::get('/investment-analytics','UserDashboardController@investmentAnalytics');

	// Route::get('/investment-analysis','InvestmentAnalysisController@init');
	// Route::get('/investment-analysis/{vertical_axis}/{horizontal_axis}','InvestmentAnalysisController@result');
	
	// Route::get('/result-page','UserResultController@resultPage');
	
	// Route::get('/result_load','UserResultController@result_load');

	// Route::get('/compare','PortfolioCompareController@compare');
	// Route::get('/compare-non-andorra','CompareNonAndorraInvestmentsController@compare');

	// Route::post('/recommendations','UserRecommendationController@recommendations');

	// Route::post('/portfolio','UserPortfolioController@portfolio');

	// Route::post('/portfolio/add/{investment_id}','UserPortfolioController@addInPortfolio');
	// Route::get('/portfolio/remove/{investment_id}','UserPortfolioController@removeFromPortfolio');
	// Route::get('/portfolio/start-invest/{investment_id}','UserPortfolioController@startInvest');
	// Route::get('/portfolio/sell-invest/{investment_id}','UserPortfolioController@sellInvest');

	// Route::post('/filter/map','UserResultController@filterMap');

	// Route::get('/own','WhatYouOwnController@load');
	// Route::post('/own/add','WhatYouOwnController@addInvestment');
	// Route::post('/own/remove','WhatYouOwnController@removeInvestment');

});

Route::group(["before"=>"auth","prefix"=>"entrepreneur"],function(){
	Route::get('/dashboard','EntrepreneurDashboardController@index');
});

Route::group(["before"=>"auth","prefix"=>"broker"],function(){
	Route::get('/dashboard','BrokerDashboardController@index');
});

Route::group(["before"=>"auth"],function(){

	Route::group(['before' => 'admin'], function (){

		Route::get('/dashboard','AdminController@index');
		Route::get('/questionnaire','AdminController@questionnaire');
		Route::get('/jobs','AdminController@jobs');
		Route::group(["prefix"=>"questions"],function(){
			Route::get('/{questionnaire_id}','QuestionController@index');
		});

		Route::group(["prefix"=>"admin/settings"],function(){
			Route::get('/','SettingsController@index');
			Route::put('/','SettingsController@save');
		});

		


	});

});

Route::group(["prefix"=>"api"],function(){

	Route::post('/upload/file','AdminController@uploadFile');
	Route::post('/register','UserController@postRegister');
	Route::post('/login','UserController@postLogin');


	Route::group(["prefix"=>"questions"],function(){
		Route::get('/','QuestionController@initials');
		Route::get('/checkFilter','QuestionController@checkFilter');
		Route::get('/{question_id}','QuestionController@editQuestion');
		Route::delete('/delete/{question_id}','QuestionController@deleteQuestion');
		Route::post('/add','QuestionController@add');
		Route::get('/loadParentQuestions/{category_id}','QuestionController@loadParentQuestions');
		Route::get('/loadParentOptions/{question_id}','QuestionController@loadParentOptions');
		Route::get('/loadSubTags/{tag_id}','QuestionController@loadSubTags');
		Route::post('/save-order','QuestionController@savePageNos');
		Route::post('/changeCategory','QuestionController@changeCategory');
	});

	Route::group(["prefix"=>"relations"],function(){
		Route::get('/','RelationController@initials');
		Route::post('/add','RelationController@add');
		Route::get('/subtags/{tag_id}','RelationController@getSubTags');
		Route::post('/storeRelationLinks','RelationController@storeRelationLinks');
		Route::get('/getRelationLinks/{relation_id}','RelationController@getRelationLinks');
		Route::delete('/delete/{relation_id}','RelationController@deleteRelation');
	});

	Route::group(["prefix"=>"user-dashboard"],function(){
		Route::get('/{questionnaire_id}','UserDashboardController@load');
		Route::post('/submit','UserDashboardController@submitResponse');
	});

	Route::group(["prefix"=>"entrepreneur"],function(){
		Route::get('/','EntrepreneurController@initials');
		Route::post('/add','EntrepreneurController@addEntrepreneur');
		Route::get('/edit/{entrepreneur_id}','EntrepreneurController@editEntrepreneur');
		Route::delete('/delete/{entrepreneur_id}','EntrepreneurController@deleteEntrepreneur');
		Route::delete('/deleteDocument/{id}','EntrepreneurController@deleteDocument');

	});

	Route::group(["prefix"=>"investments"],function(){
		Route::get('/','InvestmentController@initials');
		Route::post('/sheet/{investment_id}/{page_no}/{type}','InvestmentController@initialsSheet');
		Route::post('/add','InvestmentController@addInvestment');
		Route::get('/edit/{investment_id}','InvestmentController@editInvestment');
		Route::delete('/delete/{investment_id}','InvestmentController@deleteInvestment');
		Route::delete('/deleteDocument/{id}','EntrepreneurController@deleteDocument');
		Route::get('/details/{investment_id}','InvestmentController@details');

		Route::post('/update-field','InvestmentController@updateField');
		Route::post('/update-multiple','InvestmentController@updateMultiple');
		Route::post('/fetch-options','InvestmentController@fetchOptions');

		Route::post('/fetch-company-information','InvestmentController@fetchCompanyInformation');

		Route::get('/product/details/{investment_id}','InvestmentController@productDetails');

	});

	Route::group(["prefix"=>"continents"],function(){
		Route::get('/','GeographicLocationController@initialsContinent');
		Route::post('/add','GeographicLocationController@addContinent');
		Route::delete('/delete/{continent_id}','GeographicLocationController@deleteContinent');
	});

	Route::group(["prefix"=>"countries"],function(){
		Route::get('/','GeographicLocationController@initialsCountry');
		Route::post('/add','GeographicLocationController@addCountry');
		Route::delete('/delete/{country_id}','GeographicLocationController@deleteCountry');
	});

	Route::group(["prefix"=>"states"],function(){
		Route::get('/','GeographicLocationController@initialsState');
		Route::post('/add','GeographicLocationController@addState');
		Route::delete('/delete/{state_id}','GeographicLocationController@deleteState');
	});

	Route::group(["prefix"=>"cities"],function(){
		Route::get('/','GeographicLocationController@initialsCity');
		Route::post('/add','GeographicLocationController@addCity');
		Route::delete('/delete/{city_id}','GeographicLocationController@deleteCity');
	});

	Route::group(["prefix"=>"strategy"],function(){
		Route::post('/risk-score','StrategyController@updateRiskScore');
	});

	Route::group(["prefix"=>"financial"],function(){
		Route::get('/report','FinancialReportController@report');
	});

	Route::group(["prefix"=>"impact"],function(){
		Route::get('/report','ImpactReportController@report');
	});


	Route::group(["prefix"=>"advisor"],function(){
		Route::get('/initials','BrokerDashboardController@initials');
	});

	Route::group(["prefix"=>"history"],function(){
		Route::get('/initials','HistoryController@initials');
		Route::post('/add','HistoryController@addHistory');
		Route::delete('/delete/{history_id}','HistoryController@deleteHistory');
	});

	Route::group(["prefix"=>"glossary"],function(){
		Route::get('/initials','GlossaryController@initials');
		Route::post('/add','GlossaryController@addGlossary');
		Route::delete('/delete/{glossary_id}','GlossaryController@deleteGlossary');
	});

	Route::group(["prefix"=>"feedback"],function(){
		Route::post('/store','FeedbackController@store');
	});

	Route::group(["prefix"=>"graphs"],function(){
		Route::get('/','GraphController@initials');
		Route::post('/add','GraphController@add');
		Route::get('/delete/{graph_id}','GraphController@delete');
	});

});