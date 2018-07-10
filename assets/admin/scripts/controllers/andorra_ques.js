var auto_scroll = 0;
var window_mid= $(window).height()/2;
var offset = 100;

// $(".questions").css('padding',(window_mid-100)+'px 0');
// $(".questions").css('padding','50'+'px 0');

app.controller('UserDashboardCtrl',function($scope, $element, dragularService, $timeout, $interval,UserDashboardService, FeedbackService){
	$scope.questionnaire_id = 0;
	$scope.questions = [];
	$scope.answers = [];
	$scope.skipped = [];
	$scope.split_evenly = [];
	$scope.question_weight = [];
	$scope.ranks = [];
	$scope.option_ranks = [];
	$scope.error_questions = [];
	$scope.selected_countries = [];
	$scope.loading = true;

	$scope.answered_questions = 0;
	$scope.total_questions = 0;

	$scope.type = 0;
	$scope.search = {name : '', location_type : 1};

	$scope.feedbackData = {

	};

	$scope.onSubmitFeedback = function(){
		$scope.processing_feedback = true;
		FeedbackService.store($scope.feedbackData).then(function(data){
			if(data.success){
				$("#feebackModal").modal("hide");
			}
			bootbox.alert(data.message);
			$scope.processing_feedback = false;
		});
	}

	$scope.leaveFeedback = function(question_id){
		$("#feebackModal").modal('show');
		$scope.feedbackData= {};
		$scope.feedbackData.question_id = question_id;
	}

	$scope.openRemark = function(question, remark_type){
		if(question.open_remark == remark_type){
			question.open_remark = 0;
		} else {
			question.open_remark = remark_type;
		}
	}

	$scope.splitEvenly = function(question, value){
		question.split_evenly = value;
		if(value){
			$scope.split_evenly[question.id] = 1;
		} else {
			if($scope.split_evenly[question.id]){
				$scope.split_evenly[question.id] = null;
			}
		}
	}

	$scope.showChildQuestionId = function(question_id){

		for (var j = $scope.questions.length - 1; j >= 0; j--) {
			if($scope.questions[j].id == question_id){
				$scope.showChild($scope.questions[j]);
			}
		};
	}

	$scope.showChild = function(question, type){
		if(question.childs){

			for (var k = $scope.questions.length - 1; k >= 0; k--) {
				var idx = question.child_questions.indexOf($scope.questions[k].id);

				if(idx != -1){
					if($scope.answers[question.id] instanceof Array ){
						var flag = false;
						var selected_option = 0;
						for (var i = $scope.answers[question.id].length - 1; i >= 0; i--) {
							
							if($scope.answers[question.id][i] instanceof Object){
								selected_option =  $scope.answers[question.id][i].id;
							} else {
								selected_option =  $scope.answers[question.id][i];
							}
							
							if($scope.questions[k].open_options.indexOf(selected_option) != -1){
								flag = true;
								break;
							}
						};

						if(flag){
							$scope.questions[k].show = true;
						} else {
							$scope.questions[k].show = false;
							$("#question_"+$scope.questions[k].id).removeClass("active");
						}

					} else {
						var selected_option = $scope.answers[question.id];

						if($scope.questions[k].open_options.indexOf(selected_option) != -1){
							$scope.questions[k].show = true;
						} else {
							$scope.questions[k].show = false;
							$("#question_"+$scope.questions[k].id).removeClass("active");
						}
					}
				}
			}
		}
	}

	$scope.showNext = function(question){
		if(question.type == 1){
			return false;
		}

		if(!$scope.answers[question.id]){
			return false;	
		} else {
			if($scope.answers[question.id] instanceof Array){
				if ($scope.answers[question.id].length > 0){
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		}
		
	}

	$scope.hideAllChild = function(question){

		if(question.childs){
			for (var k = $scope.questions.length - 1; k >= 0; k--) {
				var idx = question.child_questions.indexOf($scope.questions[k].id);

				if(idx != -1){
					$scope.questions[k].open = false;
				}
			}
		}
	}

	$scope.chooseSingle = function(question, option_id){

		$scope.answers[question.id] = option_id;
		$scope.error_questions[question.id] = null;
		$scope.showChild(question);
		

		// $("#option_"+option_id).addClass("animated").addClass("pulse");
		$timeout(function(){
			$scope.goToNext(question);
		},300);
	}

	$scope.goToNext = function(question){
		var flag = false;
		var question_id = 0;
		var height = 0;
		var next_flag = false;

		var pre_question_id = question.id;

		for (var i = 0; i < $scope.questions.length; i++) {
			
			if(flag){
				if($scope.questions[i].show){

					next_flag = true;

					auto_scroll = 1;

					$("#question_"+$scope.questions[i].id).addClass("active").addClass("focus");

					$('html,body').animate({
				        scrollTop: $("#question_"+$scope.questions[i].id).offset().top - offset
				    }, 300, function(){	
				    	$timeout(function(){
				    		auto_scroll = 0;
				    	}, 300);
				    });

				    if($scope.questions[i].type == 4 || $scope.questions[i].type == 5){
				    	$("#question_"+$scope.questions[i].id).find('input').focus();
				    }

					break;
				} else {
					continue;
				}
			}

			if($scope.questions[i].id == question.id){
				flag = true;
				$("#question_"+$scope.questions[i].id).removeClass("focus");
				var height = $("#question_"+$scope.questions[i].id).height();
			}

		};

		if(!next_flag){
			$("#question_"+pre_question_id).addClass("focus");

			auto_scroll = 1;
			$('html,body').animate({
		        scrollTop: $("#submit_btn").offset().top
		    }, 300, function(){	
		    	$timeout(function(){
		    		auto_scroll = 0;
		    	}, 300);
		    });

		}
	}

	$scope.skipQuestion = function(question){
		$scope.skipped[question.id] = 1;
		$scope.goToNext(question,1);
	}

	$scope.chooseMultiple = function(question, option_id){
		if($scope.answers[question.id]){
			var idx = $scope.answers[question.id].indexOf(option_id);
			if(idx == -1){
				$scope.answers[question.id].push(option_id);
			} else {
				$scope.answers[question.id].splice(idx,1);
			}
		} else {
			$scope.answers[question.id] = [];
			$scope.answers[question.id].push(option_id);
		}

		$scope.error_questions[question.id] = null;

		$scope.showChild(question);
	}

	$scope.$watch('answers', function() {
	  $scope.showChildQuestionId(12);
	  $scope.calculateCompletion();
	}, true);

	$scope.$watch('skipped', function() {
	  $scope.calculateCompletion();
	}, true);

	$scope.calculateCompletion = function(){
		var total_questions = 0;
		var answered_questions = 0;
		for (var i = 0; i < $scope.questions.length; i++) {
			if($scope.questions[i].show){
				total_questions++;
			}
			// console.log($scope.skipped[$scope.questions[i].id]);
			if($scope.skipped[$scope.questions[i].id] == 1){
				answered_questions++;
			} else {
				if($scope.answers[$scope.questions[i].id] instanceof Array){
					if($scope.answers[$scope.questions[i].id].length > 0){
						answered_questions++;
					}
				} else if($scope.answers[$scope.questions[i].id]) {
					answered_questions++;
				}
			}
		}
		$scope.total_questions = total_questions;
		$scope.answered_questions = answered_questions;
	}


    $scope.initials = function(){
		UserDashboardService.initials($scope.questionnaire_id).then(function(data){
			
			if(data.success){
				$scope.loading = false;
				$scope.questions = data.questions;

			    $timeout(function(){
			    	var count = 0;

		    		for (var j = 0; j < $scope.questions.length ; j++) {

		    			if(j == 0){
		    				$("#question_"+$scope.questions[j].id).addClass("active").addClass("focus");
		    				auto_scroll = 1;
		    				$('html,body').animate({
						        scrollTop: $("#question_"+$scope.questions[j].id).offset().top - offset
						    }, 300, function(){	
						    	$timeout(function(){
						    		auto_scroll = 0;
						    	}, 300);
						    });
		    			}

		    			if($scope.questions[j].show){
		    				$scope.total_questions++;
		    			}
		    		}
				    
			    },1000);

			} else {
	    		bootbox.alert(data.message);
			}
		});
	}

	$scope.submit_response = function(){
		var final_answers = [];
		for (var i = $scope.answers.length - 1; i >= 0; i--) {
			if($scope.answers[i]){
				
				if($scope.answers[i] instanceof Array){
					if($scope.answers[i].length > 0){
						final_answers.push({
							question_id : i,
							answers : $scope.answers[i]
						});
					}
				} else {
					final_answers.push({
						question_id : i,
						answers : $scope.answers[i]
					});
				}
			}
		};
		$scope.submitting = true;
		UserDashboardService.onSubmit(final_answers,$scope.questionnaire_id).then(function(data){
			if(data.success){
				console.log(data);
				// location.href = base_url + '/investor/profile?ref=st';
			} else {
	    		bootbox.alert(data.message);
			}
			$scope.submitting = false;
		});
	}

});

$(document).ready(function(e){

	$(window).on("scroll",function(e){
		if(auto_scroll == 1) return;
		
		var scrollTop1 = $("body").scrollTop();
		var scrollTop2 = $("html").scrollTop();
		
		var scrollTop = (scrollTop1 > scrollTop2)?scrollTop1:scrollTop2;

		var count = 0;
		var total = $(".question.active").length;

		$(".question.active").each(function(e){
			
			if($(this).hasClass("focus")){
				var top = $(this).offset().top;
				var height = $(this).height();

				// console.log(top, height, window_mid, scrollTop);

				if( (top + height - window_mid) < scrollTop) {
					if(count + 1 == total) return;
					$(".question.active").eq(count + 1).addClass("focus");
					$(this).removeClass("focus");
				} else if( (scrollTop + window_mid) < top) {
					$(".question.active").eq(count - 1).addClass("focus");
					$(this).removeClass("focus");
				}
			}

			count++;
			// if(count == total) return;

			// var top = $(this).offset().top;
			// var height = $(this).height();

			
			// // if( (top + height - scrollTop) < (window_mid - 100)) {
			// if( (top + height - window_mid) > scrollTop && scrollTop) {
			// 	$(".question.active").removeClass("focus");
			// 	$(this).addClass("focus");
			// }
		});

	});

});