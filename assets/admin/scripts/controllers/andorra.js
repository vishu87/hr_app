app.controller('QuesCtrl',function($scope , $http ,QuesService,Upload){
	$scope.questionnaire_id = 0;
	$scope.questions = [];
	
	$scope.parent_questions = [];
	$scope.parent_options = [];

	$scope.follow_up_types = [{id : 0, type : 'No' },{id : 1, type : 'Yes' }];
	$scope.quesData = {};

	$scope.processing = false;
	$scope.ques_id = 0;
	$scope.quesData.parent_options = [];
	$scope.types = [];
	$scope.part1 = true;
	$scope.part2 = false;

	$scope.option_group = {
		option_group_name : '',
		image : '',
		group_option_condition_id : '',
		options : [
			{'option_name':'','weight':'','tag_id':'','filters':[]},
			{'option_name':'','weight':'','tag_id':'','filters':[]},
			{'option_name':'','weight':'','tag_id':'','filters':[]}
		]
	};

	$scope.defaultFilter = {'demo':''};

	$scope.addOptionFilter = function(option){
		option.filters.push(JSON.parse(JSON.stringify($scope.defaultFilter)));
		console.log(option);
	}

	$scope.removeFilter = function(option,filter,index){
		filter.removing = true;
		option.filters.splice(index,1);
	}
	
	$scope.changeFilter = function(filter){
		filter.value = '';
		filter.subtag_id = 0;
		QuesService.checkFilter(filter.field_id).then(function(resp){
			if(resp.success){
				if(resp.subtags){
					filter.subtags = resp.subtags;
					filter.show_tag = true;
					filter.show_value = false;
				}else{
					filter.show_tag = false;
					filter.show_value = true;
				}
			}else{
				bootbox.alert(resp.message);
			}
		});
	}

    $scope.initials = function(check){
		console.log($scope.questionnaire_id);
		QuesService.initials($scope.questionnaire_id).then(function(data){
			console.log(data);
			if(data.success){
				$scope.questions = data.questions;
				$scope.filters = data.filters;
				$scope.question_categories = data.question_categories;
				$scope.types = data.types;
				$scope.menus = data.menus;
				$scope.operators = data.operators;
				$scope.investor_filters = data.investor_filters;
			}else{
	    		bootbox.alert(data.message);
			}
		});
	}

	$scope.loadParentQuestions = function(){
		if($scope.quesData.follow_up == 1){
			QuesService.loadParentQuestions($scope.questionnaire_id).then(function(data){
				$scope.parent_questions = data.parent_questions
			});
		}
	}

	$scope.loadParentOptions = function(){
		if($scope.quesData.parent_question_id != '' && $scope.quesData.parent_question_id != 0){
			QuesService.loadParentOptions($scope.quesData.parent_question_id).then(function(data){
				$scope.parent_options = data.parent_options
			});
		}
	}

	$scope.loadSubTags = function(menu){
		QuesService.loadSubTags(menu.tag_id).then(function(data){
			menu.subtags = data.subtags
		});
	}

	$scope.continue = function(){
		// console.log($scope.quesData);
		// console.log($scope.menus);
		$scope.part1 = false;
		$scope.part2 = true;
	}

	$scope.goback = function(){
		$scope.part1 = true;
		$scope.part2 = false;
	}

	$scope.addQues = function(){

		$scope.ques_id = 0;
		$scope.quesData = {};
		$scope.quesData.option_groups = [];
		$scope.quesData.option_groups.push(JSON.parse(JSON.stringify($scope.option_group)));
		$scope.parent_questions = [];
		$scope.parent_options = [];

		$scope.part1 = true;
		$scope.part2 = false;

		$('#questions').modal("show");
	}

	$scope.addOptionGroup = function(quesData){
		quesData.option_groups.push(JSON.parse(JSON.stringify($scope.option_group)));
		console.log($scope.options);
	}

	$scope.addOption = function(option_group){
		option_group.options.push({'option_name':'','weight':'','tag_id':''});
		console.log($scope.options);
	}

	$scope.uploadFile = function (file, name, option_group) {
		option_group.uploading = true;
		var url = base_url+'/api/upload/file';
        Upload.upload({
            url: url,
            data: {
            	media: file
            }
        }).then(function (resp) {
        	// console.log(resp);
            if(resp.data.success){
            	option_group.image = resp.data.media;
            } else {
            	alert(resp.data.message);
            }
            option_group.uploading = false;
        }, function (resp) {
            // console.log('Error status: ' + resp.status);
            option_group.uploading = false;
        }, function (evt) {
            // $scope.uploading_percentage = parseInt(100.0 * evt.loaded / evt.total) + '%';
        });
    }

    $scope.removeFile = function(option_group){
    	option_group.image = '';
    }


	$scope.onSubmit = function(){
		// console.log($scope.quesData);
		// console.log($scope.menus);
		$scope.processing = true;
		// console.log($scope.ques_id);
		$scope.quesData['questionnaire_id'] = $scope.questionnaire_id;
		if($scope.ques_id != 0){
			$scope.quesData['ques_id'] = $scope.ques_id;
		}
		QuesService.onSubmit($scope.quesData).then(function(data){
			if(data.success){
				// bootbox.alert(data.message);
				if($scope.ques_id != 0){
					for (var i = $scope.questions.length - 1; i >= 0; i--) {
						if($scope.questions[i]['id'] == data.question.id){
							$scope.questions[i] = data.question;
						}
					}
				}else{
					$scope.questions.push(data.question);
				}
				$("#questions").modal("hide");
				$scope.quesData = {no_option : 3};
			}else{
				
	    		bootbox.alert(data.message);
			}
			$scope.processing = false;
			$scope.part1 = true;
			$scope.part2 = false;
		});
	}

	$scope.editQues = function(ques){
		$scope.quesData = {};
		$scope.ques_id = ques.id;
		ques.process = true;
		QuesService.editQuestion(ques.id).then(function(data){
			if(data.success){
				ques.process = false;
				$("#questions").modal("show");
				$scope.quesData = data.question;
				$scope.parent_questions = data.parent_questions;
				$scope.parent_options = data.parent_options
				console.log(data);
				$scope.part1 = true;
				$scope.part2 = false;
			} else {
	    		bootbox.alert(data.message);
			}
		});
	}

	$scope.deleteQues = function(ques_id,index){
		bootbox.confirm("Are you sure?", function(result) {
	      	if(result) {
				$scope['processing_'+index] = true;
				QuesService.deleteQuestion(ques_id).then(function(data){
					if(data.success){
						$scope.questions.splice(index,1) ;
						
					}else{
			    		bootbox.alert(data.message);
					}
					$scope['processing_'+index] = false;
				});
	      	}
	    });
		
	}

	$("#questions").on("hidden.bs.modal", function () {
	    $scope.resetQuesData();
	});

	$scope.resetQuesData = function(){
		$scope.quesData = {};
	    $scope.options = [];
	    for (var i = 0; i < 3; i++) {
			$scope.options.push($scope.defaultOption);
		}
		$scope.ques_id = 0;
		$scope.part1 = true;
		$scope.part2 = false;
	}

	$scope.savePageNos = function(){
		$scope.page_no_saving = true;
		QuesService.savePageNos($scope.questions).then(function(data){
			if(data.success){
				bootbox.alert(data.message);
			}
			$scope.page_no_saving = false;
		});
	}

	$scope.changeQuestionCategory = function(question){
		$scope.current_question = question;
		$("#questionCategory").modal("show");
	}

	$scope.changeCategory = function(current_question){
		current_question.processing = true;
		QuesService.changeCategory(current_question).then(function(data){
			if(data.success){
				for (var i = $scope.questions.length - 1; i >= 0; i--) {
					if($scope.questions[i]['id'] == data.question.id){

						$scope.questions.splice(i,1);

					}
				}
				$("#questionCategory").modal("hide");
			}else{
				bootbox.alert(data.message);
			}
			current_question.processing = false;
		});
	}
});

app.controller('relationCtrl',function($scope, $http , RelationService){
	$scope.processing = false;
	$scope.relations = [];
	$scope.relationData = {};
	$scope.tags = [];
	$scope.relation_id = 0;
	$scope.relationLinks = {};
	$scope.relation_link_id = 0;
	$scope.initials = function(){
		RelationService.initials().then(function(data){
			$scope.relations = data.relations;
			$scope.tags = data.tags;
		});
	}

	$scope.addRelation = function(){
		$scope.relationData = {};
		$scope.relation_id = 0;
		$('#relations').modal("show");
	}

	$scope.onSubmit = function(){
		$scope.processing = true;
		// console.log($scope.relations);
		RelationService.onSubmit($scope.relationData).then(function(data){

			if(data.success){

				if($scope.relation_id != 0){
					for (var i = $scope.relations.length - 1; i >= 0; i--) {
						if($scope.relations[i]['id'] == data.relation.id){
							$scope.relations[i] = data.relation;
						}
					}
				}else{
					$scope.relations.push(data.relation);
				}
				$scope.relation_id = 0;
				$scope.relationData = {};
				$scope.RelationForm.$setPristine();
			}else{
				bootbox.alert(data.message);
			}
			$scope.processing = false;
		});
	}

	$scope.editRelation = function(relation){
		$scope.relationData = relation;
		$scope.relation_id = relation.id;
		$('#relations').modal("show");
	}

	$scope.addRelationLinks = function(relation_id){
		RelationService.getLinks(relation_id).then(function(data){
			if(data.relationLinks){
				$scope.relationLinks = data.relationLinks;
			}
			$scope.relationLinks.relation_id = relation_id;
		});
		$('#relationLinks').modal("show");
		// console.log($scope.relationLinks);

	}

	$scope.loadSelectSubtags = function(){
		
		if($scope.relationLinks.select_tag_id != 0){

			RelationService.loadSubtags($scope.relationLinks.select_tag_id).then(function(data){
				$scope.relationLinks.selecttags = data.subtags;
				// console.log($scope.relationLinks);
			});
		}
	}

	$scope.loadRelationSubtags = function(){
		// console.log('m dfa');
		if($scope.relationLinks.link_tag_id != 0 ){
			RelationService.loadSubtags($scope.relationLinks.link_tag_id).then(function(data){
				for (var i = $scope.relationLinks.selecttags.length - 1; i >= 0; i--) {
					$scope.relationLinks.selecttags[i]['linktags'] = data.subtags;
				}
				// console.log($scope.relationLinks);
			});
		}
	}

	$scope.submitRelationLinks = function(){
		// console.log($scope.relationLinks);
		$scope.processing = true;
		RelationService.submitRelationLinks($scope.relationLinks).then(function(data){
			if(data.success){
				$('#relationLinks').modal("hide");
			}
			$scope.processing = false;
			bootbox.alert(data.message);
		});
	}

	$scope.deleteRelation = function(relation,index){
		relation.processing = true;
		bootbox.confirm('Are you sure',function(result){
			if(result){

				RelationService.deleteRelation(relation.id).then(function(data){
					if(data.success){
						$scope.relations.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					relation.processing = false;
				});
			}
			else{
				relation.processing = false;
			}
		});

		 
	}

});

app.controller('UserDashboardCtrl_OLD',function($scope, $element, dragularService, $timeout, $interval,UserDashboardService){
	$scope.categories = [];
	$scope.open_category_id = 0;
	$scope.answers = [];
	$scope.split_evenly = [];
	$scope.question_weight = [];
	$scope.ranks = [];
	$scope.option_ranks = [];
	$scope.error_questions = [];
	$scope.selected_countries = [];
	$scope.loading = true;

	$scope.type = 0;

	$scope.search = {name : '', location_type : 1};

	$scope.show_map = 1;

	$scope.inter_us_id = 41;

	$scope.goToPrev = function(){
		$scope.open_category_id--;
	}

	$scope.goToNext = function(){
		var flag = false;
		var str = '';
		$scope.error_questions = [];
		for (var i = $scope.categories.length - 1; i >= 0; i--) {
			if($scope.categories[i].id == $scope.open_category_id){
				for (var j = $scope.categories[i].questions.length - 1; j >= 0; j--) {
					if($scope.categories[i].questions[j].open || $scope.categories[i].questions[j].follow_up != 1){
						// means main question or opened follow up quesiton
						if($scope.answers[$scope.categories[i].questions[j].id] instanceof Array){
							if($scope.answers[$scope.categories[i].questions[j].id].length == 0){
								flag = true;
								$scope.error_questions[$scope.categories[i].questions[j].id] = 1;
							}
						} else if($scope.answers[$scope.categories[i].questions[j].id] == null){
							flag = true;
							$scope.error_questions[$scope.categories[i].questions[j].id] = 1;
						}
					}
				};
			}
		};
		flag = false;
		if(!flag){
			$scope.open_category_id++;
		} else {
			// console.log("Please fill all the questions to continue");
		}
	}

	$scope.splitEvenly = function(question){
		if($scope.split_evenly[question.id]){
			$scope.split_evenly[question.id] = null;
		} else {
			$scope.split_evenly[question.id] = 1;
		}
	}

	$scope.regionClick = function(value, id, question_id, div_id, type){

		if(!$scope.answers[question_id]){
			$scope.answers[question_id] = [];
		}

		var idx = -1;
		for (var i = 0; i < $scope.answers[question_id].length; i++) {
			if($scope.answers[question_id][i].id == id && $scope.answers[question_id][i].type == type){
				idx = i;
			}
		};
		console.log(idx);
		console.log($scope.answers[question_id]);
		if(idx == -1){
			if($scope.answers[question_id].length >= 10){
				alert("You can make only 10 choices");
				return;
			}

			$scope.answers[question_id].push({
				id : id,
				type : type,
				name : value,
				div_id : div_id
			});

			if(type == 1){
				for (var i = $scope.continents.length - 1; i >= 0; i--) {
					if($scope.continents[i].id == id){
						$("#world-svg g path").each(function(e){
							var comp_id = $(this).attr("id");
							if($scope.continents[i].countries.indexOf(comp_id) > -1){
								$(this).addClass("selected");
							}
						});
					}
				};
			} else {
				if(type == 2){
					$scope.selected_countries.push(div_id);
				}
				$("#"+div_id).addClass("selected");
			}
		} else {
			$scope.answers[question_id].splice(idx,1);
			if(type == 1){
				
				for (var i = $scope.continents.length - 1; i >= 0; i--) {
					if($scope.continents[i].id == id){
						$("#world-svg g path").each(function(e){
							var comp_id = $(this).attr("id");
							if($scope.continents[i].countries.indexOf(comp_id) > -1){
								if($scope.selected_countries.indexOf(comp_id) == -1){
									$(this).removeClass("selected");
								}
							}
						});
					}
				};

			} else {
				if(type == 2){
					var idx = $scope.selected_countries.indexOf(div_id);
					if(idx != -1 ){
						$scope.selected_countries.splice(idx,1);
					}
				}
				$("#"+div_id).removeClass("selected");
			}
		}

	}

	$scope.regionHover = function(value){
		$scope.displayTooltip = true;
		// $(".tooltipMap").css({top:top, left: left});
	}

	$scope.regionLeave = function(value){
		$scope.displayTooltip = false;
		// $scope.displayTooltip = false;
	}

	$scope.localLang = {
	    selectAll       : "Tick all",
	    selectNone      : "Tick none",
	    reset           : "Undo all",
	    search          : "Type here to search...",
	    nothingSelected : "Nothing is selected"
	};

	$scope.slider = {
	    value: 51,
	    options: {
	   	floor: 0,
        ceil: 100,
        step: 1,
	    showTicksValues: false,
	    translate: function(value) {
	      return (100-value)+'% - '+value+'%';
	    },
	    onChange: function(sliderId,modelValue){
	    	if(modelValue == 100){
	    		$scope.openHideQuestion(29,1);
	    		$scope.openHideQuestion(38,0);
	    		$scope.openHideQuestion(30,1); //hide contries
	    	} else {
	    		$scope.openHideQuestion(29,0);
	    		$scope.openHideQuestion(38,1);
	    	}
	    }
	  }
	};

	$scope.continentContinue = function(){
		$scope.openHideQuestion(29,1); // hide continent
		$scope.openHideQuestion(30,0); //open countries
	}

	$scope.openHideQuestion = function(question_id, type){
		for (var i = $scope.categories.length - 1; i >= 0; i--) {
			for (var j = $scope.categories[i].questions.length - 1; j >= 0; j--) {
				if($scope.categories[i].questions[j].id == question_id){
					if(type == 1){
						$scope.categories[i].questions[j].open = false;
						$scope.hideAllChild($scope.categories[i].questions[j]);
					} else {
						$scope.categories[i].questions[j].open = true;
					}
				}
			};
		};
	}



	$scope.showChildQuestionId = function(question_id){

		for (var i = $scope.categories.length - 1; i >= 0; i--) {
			for (var j = $scope.categories[i].questions.length - 1; j >= 0; j--) {
				if($scope.categories[i].questions[j].id == question_id){
					$scope.showChild($scope.categories[i].questions[j]);
				}
			};
		};
	}

	// $interval(function(){
	// 	$scope.showChildQuestionId(12);
	// },1000)


	$scope.selectOpen = function(category){
		$scope.open_category_id = category.id;
		// if(category.id == 3){
		// 	$scope.showChildQuestionId();
		// }
	}

	$scope.chooseSingle = function(question, option_id){
		$scope.answers[question.id] = option_id;
		$scope.error_questions[question.id] = null;
		$scope.showChild(question);
	}

	$scope.showChild = function(question, type){
		if(question.childs){
			for (var j = $scope.categories.length - 1; j >= 0; j--) {
				if($scope.categories[j].id == question.category_id){
					for (var k = $scope.categories[j].questions.length - 1; k >= 0; k--) {
						var idx = question.child_questions.indexOf($scope.categories[j].questions[k].id);

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
									
									if($scope.categories[j].questions[k].open_options.indexOf(selected_option) != -1){
										flag = true;
										break;
									}
								};

								if(flag){
									$scope.categories[j].questions[k].open = true;

									if($scope.categories[j].questions[k].option_group_type == 1){


										for (var l = $scope.categories[j].questions[k].option_groups.length - 1; l >= 0; l--) {
											if(selected_option == $scope.categories[j].questions[k].option_groups[l].group_option_condition_id){

												$scope.categories[j].questions[k].option_groups[l].show = true;
											}
										}

									}

								} else {
									$scope.categories[j].questions[k].open = false;

									if($scope.categories[j].questions[k].option_group_type == 1){
										for (var l = $scope.categories[j].questions[k].option_groups.length - 1; l >= 0; l--) {
											$scope.categories[j].questions[k].option_groups[l].show = false;
											// $scope.resetRank($scope.categories[j].questions[k],$scope.categories[j].questions[k].option_groups[l]);
										}
									}

								}

							} else {
								var selected_option = $scope.answers[question.id];

								if($scope.categories[j].questions[k].open_options.indexOf(selected_option) != -1){

									$scope.categories[j].questions[k].open = true;
								} else {
									console.log($scope.categories[j].questions[k].open_options);
									$scope.categories[j].questions[k].open = false;
								}
							}
						}
					}
					break;
				}
			}
		}
	}

	$scope.hideAllChild = function(question){

		if(question.childs){
			for (var j = $scope.categories.length - 1; j >= 0; j--) {
				if($scope.categories[j].id == question.category_id){
					for (var k = $scope.categories[j].questions.length - 1; k >= 0; k--) {
						var idx = question.child_questions.indexOf($scope.categories[j].questions[k].id);

						if(idx != -1){
							$scope.categories[j].questions[k].open = false;
						}
					}
					break;
				}
			}
		}
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

	// $scope.chooseSingleGroup = function(question, option_group, option){

	// 	var option_id = option.id;
	// 	var option_weight = option.weight;

	// 	if(!$scope.question_weight[question.id]){
	// 		$scope.question_weight[question.id] = 0;
	// 	}

	// 	if($scope.answers[question.id]){

	// 		for (var i = option_group.options.length - 1; i >= 0; i--) {
	// 			var idx = $scope.answers[question.id].indexOf(option_group.options[i].id);
	// 			if(idx != -1 && option_id != option_group.options[i].id){
	// 				$scope.answers[question.id].splice(idx,1);
	// 				$scope.question_weight[question.id] -= parseInt(option_group.options[i].weight);
	// 			}
	// 		};

	// 		var idx = $scope.answers[question.id].indexOf(option_id);
	// 		if(idx == -1){
	// 			$scope.answers[question.id].push(option_id);
	// 			$scope.question_weight[question.id] += parseInt(option_weight);
	// 		} else {
	// 			$scope.answers[question.id].splice(idx,1);
	// 			$scope.question_weight[question.id] -= parseInt(option_weight);
	// 		}
	// 	} else {
	// 		$scope.answers[question.id] = [];
	// 		$scope.answers[question.id].push(option_id);
	// 		$scope.question_weight[question.id] = parseInt(option_weight);
	// 	}

	// 	for (var i = question.option_groups.length - 1; i >= 0; i--) {
	// 		var option_group_check = question.option_groups[i];

	// 		// if(option_group_check.id != option_group.id){
	// 			for (var j = option_group_check.options.length - 1; j >= 0; j--) {
	// 				var total_weight = parseInt(option_group_check.options[j].weight) + parseInt($scope.question_weight[question.id]);
	// 				if( total_weight > 8 && $scope.answers[question.id].indexOf(option_group_check.options[j].id) == -1 ){
	// 					option_group_check.options[j].hide = true;
	// 				} else {
	// 					option_group_check.options[j].hide = false;
	// 				}
	// 			};
	// 		// }

	// 	};

	// 	$scope.showChild(question);

	// }

	// $scope.chooseRank = function(question, option_group, option){

	// 	if(!$scope.answers[question.id]){
	// 		$scope.answers[question.id] = [];
	// 	}

	// 	if(option.weight > 0){
	// 		if(!$scope.ranks[option_group.id]){
	// 			$scope.ranks[option_group.id] = 0;
	// 		}
	// 		$scope.ranks[option_group.id]++;
	// 		$scope.option_ranks[option.id] = $scope.ranks[option_group.id];
	// 	} else {
	// 		$scope.resetRank(question, option_group);
	// 		$scope.option_ranks[option.id] = 1;
	// 		$scope.disableOtherOptions(option_group);
	// 	}

	// 	$scope.answers[question.id].push({
	// 		option_id : option.id,
	// 		option_group_id : option_group.id,
	// 		rank : $scope.option_ranks[option.id],
	// 	});

	// 	$scope.showChild(question);
	// }

	// $scope.resetRank = function(question, option_group){

	// 	$scope.ranks[option_group.id] = 0;

	// 	for (var i = $scope.answers[question.id].length - 1; i >= 0; i--) {
	// 		if($scope.answers[question.id][i].option_group_id = option_group.id){
	// 			$scope.answers[question.id].splice(i,1);
	// 		}
	// 	};

	// 	for (var i = option_group.options.length - 1; i >= 0; i--) {
	// 		$scope.option_ranks[option_group.options[i].id] = 0;
	// 		option_group.options[i].disabled = false;
	// 	};

	// 	$scope.showChild(question);
	// }

	// $scope.disableOtherOptions = function(option_group){
	// 	for (var i = option_group.options.length - 1; i >= 0; i--) {
	// 		if(option_group.options[i].weight > 0){
	// 			option_group.options[i].disabled = true;
	// 		}
	// 	};
	// }

	// $scope.writeText = function(question){
	// 	var object = {
	// 		question_id : question.id,
	// 		result : $scope.answers_load[question.id]
	// 	}
	// 	for (var i = 0; i < $scope.answers.length; i++) {
	// 		if($scope.answers[i].question_id == question.id){
	// 			$scope.answers.splice(i,1);
	// 		}
	// 	}
	// 	$scope.answers.push(object);
	// }
	$scope.countryFilter = function(item){
        if($scope.search.name == ''){
            return item.show == 1;
        } else {
            return true;
        }
    }

    $scope.initials = function(){
		UserDashboardService.initials($scope.type).then(function(data){
			
			if(data.success){
				$scope.loading = false;
				$scope.categories = data.categories;
				$scope.open_category_id = $scope.categories[0].id;
				// $scope.open_category_id = 3;

				$scope.locations = data.locations;
				$scope.continents = data.continents;

    			var containers = document.getElementsByClassName('containerVertical');
    
			    $timeout(function(){
			    	var count = 0;

			    	for (var i = 0; i < $scope.categories.length; i++) {
			    		for (var j = 0; j <$scope.categories[i].questions.length ; j++) {
			    			if($scope.categories[i].questions[j].type == 8){
			    				for (var k = 0; k < $scope.categories[i].questions[j].option_groups.length; k++) {
			    					$scope.answers[$scope.categories[i].questions[j].id] = [];
			    					dragularService([containers[count++],containers[count++]],{
								      	containersModel: [$scope.categories[i].questions[j].option_groups[k].options, $scope.answers[$scope.categories[i].questions[j].id]]
								    });
			    				}
			    			} else if($scope.categories[i].questions[j].type == 12){
			    				for (var k = 0; k < $scope.categories[i].questions[j].option_groups.length; k++) {
			    					$scope.answers[$scope.categories[i].questions[j].id] = [];
			    					dragularService([containers[count++],containers[count++]],{
								      	containersModel: [$scope.categories[i].questions[j].option_groups[k].options, $scope.answers[$scope.categories[i].questions[j].id]]
								    });
			    				}
			    			}
			    		}
			    	}

			    	// $scope.openHideQuestion(29,0);
				    
			    },1000);

			    // $scope.answers[$scope.inter_us_id] = 50;

			} else {
	    		bootbox.alert(data.message);
			}
		});
	}

	$scope.$watch('answers', function() {
	  $scope.showChildQuestionId(12);
	}, true); // watching properties

	$scope.submit_response = function(type){
		var final_answers = [];
		for (var i = $scope.answers.length - 1; i >= 0; i--) {
			if($scope.answers[i]){
				var split_evenly = 0;
				if($scope.split_evenly[i]){
					split_evenly = 1;
				}
				if($scope.answers[i] instanceof Array){
					if($scope.answers[i].length > 0){
						final_answers.push({
							question_id : i,
							answers : $scope.answers[i],
							split_evenly : split_evenly
						});
					}
				} else {
					final_answers.push({
						question_id : i,
						answers : $scope.answers[i],
						split_evenly : split_evenly
					});
				}
			}
		};
		$scope.submitting = true;
		UserDashboardService.onSubmit(final_answers,type).then(function(data){
			if(data.success){
				location.href = base_url + '/investor/result-page';
			} else {
	    		bootbox.alert(data.message);
			}
			$scope.submitting = false;
		});
	}

});

app.controller('entrepreneurCtrl',function($scope , $http , EntrepreneurService, Upload, $timeout){

	$scope.formData = {};
	$scope.formData.financial = {};
	$scope.formData.andorra = {};
	$scope.formData.documents = [];
	$scope.entrepreneurs = [];
	$scope.formData.managements = [];
	$scope.defaultManagement = {"demo":''};
	$scope.defaultSector = {sector_id:'',industry1_id:'',industry2_id:''};
	$scope.defaultGoal = {goal_id:''};
	$scope.years = [];
	$scope.entrepreneur_id = 0;
	$scope.InvestorMaterial = {'demo':''};
	$scope.financial = {};
	$scope.andorra = {};
	$scope.tempDocument = {};

	$scope.initials = function(){
		$scope.formData.managements.push(JSON.parse(JSON.stringify($scope.defaultManagement)));

		// $scope.areas.push($scope.defaultManagement);
		
		$scope.formData.sectors = [JSON.parse(JSON.stringify($scope.defaultSector))];
		$scope.formData.goals = [JSON.parse(JSON.stringify($scope.defaultGoal))];

		EntrepreneurService.initials().then(function(data){

			$scope.years = data.years;
			$scope.entrepreneurs = data.entrepreneurs;
			
			$scope.documents = data.documents;
			//prerequisites for impact form
			$scope.employees = data.employees;

			$scope.social_enterprises = data.social_enterprises;
			$scope.third_party_certifications = data.third_party_certifications;

			//prerequisites for andorra
			$scope.andorra_dropdowns = data.andorra_dropdowns;

		});

		if($scope.entrepreneur_id != 0){
			EntrepreneurService.edit($scope.entrepreneur_id).then(function(data){
				console.log(data);
				$scope.formData = data.entrepreneur;
				$scope.InvestorMaterial = data.entrepreneur.InvestorMaterial;
				$scope.financial = data.entrepreneur.financial;
				$scope.andorra = data.entrepreneur.andorra;
				$scope.formData.managements = data.entrepreneur.managements;
				if($scope.formData.managements.length < 1){
					$scope.formData.managements.push(JSON.parse(JSON.stringify($scope.defaultManagement)));

				}
			});
		} 
	}

	$scope.addMoreManagement = function(){
		$scope.formData.managements.push(JSON.parse(JSON.stringify($scope.defaultManagement)));
	}

	$scope.addMoreImpactSector = function(){
		$scope.formData.sectors.push(JSON.parse(JSON.stringify($scope.defaultSector)));
	}

	$scope.addMoreImpactGoal = function(){
		$scope.formData.goals.push(JSON.parse(JSON.stringify($scope.defaultGoal)));
	}

	$scope.storeProfile = function(){
		// console.log($scope.formData);
	}

	$scope.removeManagement = function(index){
		$scope.managements.splice(index,1);
	}

	$scope.addDocument = function(){
		$scope.tempDocument.adding = true;
		if($scope.tempDocument.document_id != '' && $scope.tempDocument.document != '' && $scope.tempDocument.document_id != null && $scope.tempDocument.document != null){
			for (var i = 0; i < $scope.documents.length; i++) {
				if($scope.documents[i]['id'] == $scope.tempDocument.document_id){
					$scope.tempDocument.document_name = $scope.documents[i]['document'];
				}
				
			}
			$scope.formData.documents.push($scope.tempDocument);
			console.log($scope.tempDocument);
			$scope.tempDocument = {};
		}else{
			bootbox.alert('Please select document and file');
			$scope.tempDocument.adding = false;

		}
	}

	$scope.deleteDocument = function(documentObj,index){
		$scope.formData.documents.splice(index,1);
	}

	$scope.onSubmit = function(){
		$scope.formData.financial = $scope.financial;
		$scope.formData.andorra = $scope.andorra;
		console.log($scope.formData);
		// $scope.processing = true;
		EntrepreneurService.onSubmit($scope.formData).then(function(data){
			// console.log(data);
			if(data.success){
				bootbox.alert(data.message,function(result){
					// window.location = data.redirect_link;

				});
				if($scope.entrepreneur_id == 0){
					$scope.formData.id = data.entrepreneur_id;	
				}
				
			}else{
				if(data.tab_id){
					$scope.tab_id = data.tab_id;
				}
				bootbox.alert(data.message);
				$scope.processing = false;
			}
		});
	}

	$scope.uploadFile = function (file, name, management) {
		management.uploading = true;
		var url = base_url+'/api/upload/file';
        Upload.upload({
            url: url,
            data: {
            	media: file
            }
        }).then(function (resp) {
            if(resp.data.success){
            	management.image = resp.data.media;
            } else {
            	alert(resp.data.message);
            }
        	// console.log($scope.formData);
            management.uploading = false;
        }, function (resp) {
            // console.log('Error status: ' + resp.status);
            management.uploading = false;
        }, function (evt) {
            // $scope.uploading_percentage = parseInt(100.0 * evt.loaded / evt.total) + '%';
        });
    }

    $scope.removeFile = function(inward){
    	management.image = '';
    }

    $scope.uploadInvestorFile = function (file, name, object) {
    	console.log(object);
    	var scope_val = name;
    	$scope[name] = true
		var url = base_url+'/api/upload/file';
        Upload.upload({
            url: url,
            data: {
            	media: file
            }
        }).then(function (resp) {
        	// console.log(resp);
            if(resp.data.success){
            	object[scope_val] = resp.data.media;
            } else {
            	alert(resp.data.message);
            }
            $scope[name] = false;
        }, function (resp) {
            // console.log('Error status: ' + resp.status);
            $scope[name] = false;
        }, function (evt) {
            // $scope.uploading_percentage = parseInt(100.0 * evt.loaded / evt.total) + '%';
        });
    }

    $scope.removeInvestorFile = function(object,file_name){
    	object[file_name] = '';
    	// console.log('me run');
    }

    $scope.delete = function(entrepreneur,index){
		bootbox.confirm('Are you sure',function(result){
			if(result){
				entrepreneur.deleting = true;
				EntrepreneurService.delete(entrepreneur.id).then(function(data){
					if(data.success){
						$scope.entrepreneurs.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					entrepreneur.deleting = false;
				});
			}
			else{
				entrepreneur.deleting = false;
			}
		});
	}


});

app.controller('investmentCtrl',function($scope , $http , EntrepreneurService,InvestmentService, Upload, $timeout){

	$scope.formData = {};
	$scope.formData.financial = {};
	$scope.formData.andorra = {};
	$scope.formData.documents = [];
	$scope.defaultArea = {type:'',geo_id:''};
	$scope.investments = [];
	$scope.defaultSector = {sector_id:'',industry1_id:'',industry2_id:''};
	$scope.defaultGoal = {goal_id:''};
	$scope.years = [];
	$scope.entrepreneur_id = 0;
	$scope.InvestorMaterial = {'demo':''};
	$scope.investment_id = 0;
	$scope.financial = {};
	$scope.andorra = {};
	$scope.tempDocument = {};

	$scope.initials = function(){

		// $scope.areas.push($scope.defaultManagement);
		$scope.formData.areas = [];
		$scope.formData.sectors = [JSON.parse(JSON.stringify($scope.defaultSector))];
		$scope.formData.goals = [JSON.parse(JSON.stringify($scope.defaultGoal))];

		InvestmentService.initials($scope.entrepreneur_id).then(function(data){
			console.log(data);
			$scope.years = data.years;
			$scope.investments = data.investments;
			$scope.documents = data.documents;
			//prerequisites for impact form
			$scope.employees = data.employees;
			$scope.area_types = data.area_types;
			$scope.impact_sectors = data.impact_sectors;
			$scope.development_goals = data.development_goals;
			$scope.impact_industries = data.impact_industries;
			$scope.impact_objectives = data.impact_objectives;
			$scope.impact_focus = data.impact_focus;
			$scope.social_enterprises = data.social_enterprises;

			$scope.city_sub_tags = data.city_sub_tags;
			$scope.state_sub_tags = data.state_sub_tags;
			$scope.country_sub_tags = data.country_sub_tags;
			$scope.continent_sub_tags = data.continent_sub_tags;

			//prerequisites for financials
			$scope.financial_dropdowns = data.financial_dropdowns;

			//prerequisites for impact
			$scope.impact_dropdowns = data.impact_dropdowns;

			//prerequisites for andorra
			$scope.andorra_dropdowns = data.andorra_dropdowns;

		});

		if($scope.investment_id != 0){
			InvestmentService.edit($scope.investment_id).then(function(data){
				console.log(data.investment);
				$scope.formData = data.investment;

				if(data.investment.sectors.length >= 1){
					$scope.formData.sectors = data.investment.sectors;
				} else {
					$scope.formData.sectors = [JSON.parse(JSON.stringify($scope.defaultSector))];
				}


				if(data.investment.goals.length >= 1){
					$scope.formData.goals = data.investment.goals;
				} else {
					$scope.formData.goals = [JSON.parse(JSON.stringify($scope.defaultGoal))];
				}

				if(data.investment.areas.length >= 1){
					$scope.formData.areas = data.investment.areas;
				}

			});
		}
	}

	$scope.addImpactArea = function(){
		console.log($scope.area_type);
		if($scope.area_type != 5){
			var geo_id = 0;
			var geo_name = 0;
			switch($scope.area_type){
				case 1:
					geo_id = $scope.continent_geo_id;
					for (var i = $scope.continent_sub_tags.length - 1; i >= 0; i--) {
						if($scope.continent_sub_tags[i].id == geo_id){
							geo_name = $scope.continent_sub_tags[i].name;
						}
					};
					break;
				case 2:
					geo_id = $scope.country_geo_id;
					for (var i = $scope.country_sub_tags.length - 1; i >= 0; i--) {
						if($scope.country_sub_tags[i].id == geo_id){
							geo_name = $scope.country_sub_tags[i].name;
						}
					};
					break;
				case 3:
					geo_id = $scope.state_geo_id;
					for (var i = $scope.state_sub_tags.length - 1; i >= 0; i--) {
						if($scope.state_sub_tags[i].id == geo_id){
							geo_name = $scope.state_sub_tags[i].name;
						}
					};
					break;
				case 4:
					geo_id = $scope.city_geo_id;
					for (var i = $scope.city_sub_tags.length - 1; i >= 0; i--) {
						if($scope.city_sub_tags[i].id == geo_id){
							geo_name = $scope.city_sub_tags[i].name;
						}
					};
					break;
			}
			$scope.formData.areas.push({
				type : $scope.area_type,
				geo_id : geo_id,
				geo_name : geo_name
			});
		} else {
			$scope.formData.areas.push({
				type : $scope.area_type,
				geo_id : 0,
				geo_name : geo_name,
				latitude : $("#lat").val(),
				longitude : $("#lng").val(),
				address : $("#address").val(),
			});
		}
	}

	$scope.addMoreImpactSector = function(){
		$scope.formData.sectors.push(JSON.parse(JSON.stringify($scope.defaultSector)));
	}

	// $scope.addMoreImpactArea = function(){
	// 	$scope.formData.areas.push(JSON.parse(JSON.stringify($scope.defaultArea)));
	// }

	$scope.addMoreImpactGoal = function(){
		$scope.formData.goals.push(JSON.parse(JSON.stringify($scope.defaultGoal)));
	}

	$scope.removeImpactArea = function(index){
		$scope.formData.areas.splice(index,1);
	}

	$scope.removeImpactSector = function(index){
		$scope.formData.sectors.splice(index,1);
	}

	$scope.removeImpactGoal = function(index){
		$scope.formData.goals.splice(index,1);
	}

	$scope.addDocument = function(){
		$scope.tempDocument.adding = true;
		if($scope.tempDocument.document_id != '' && $scope.tempDocument.document != '' && $scope.tempDocument.document_id != null && $scope.tempDocument.document != null){
			for (var i = 0; i < $scope.documents.length; i++) {
				if($scope.documents[i]['id'] == $scope.tempDocument.document_id){
					$scope.tempDocument.document_name = $scope.documents[i]['document'];
				}
				
			}
			$scope.formData.documents.push($scope.tempDocument);
			console.log($scope.tempDocument);
			$scope.tempDocument = {};
		}else{
			bootbox.alert('Please select document and file');
			$scope.tempDocument.adding = false;

		}
	}

	$scope.deleteDocument = function(documentObj,index){
		$scope.formData.documents.splice(index,1);
	}

	$scope.onSubmit = function(){
		$scope.formData['entrepreneur_id'] = $scope.entrepreneur_id;
		console.log($scope.formData);
		InvestmentService.onSubmit($scope.formData).then(function(data){
			console.log(data);
			if(data.success){
				bootbox.alert(data.message,function(result){
					// window.location = data.redirect_link;
				});
				if($scope.investment_id == 0){
					$scope.formData.id = data.investment_id;
				}
			}else{
				if(data.tab_id){
					$scope.tab_id = data.tab_id;
				}
				bootbox.alert(data.message);
				$scope.processing = false;
			}
		});
	}

	$scope.uploadFile = function (file, name) {
		$scope.formData.uploading = true;
		var url = base_url+'/api/upload/file';
        Upload.upload({
            url: url,
            data: {
            	media: file
            }
        }).then(function (resp) {
            if(resp.data.success){
            	$scope.formData.other_info = resp.data.media;
            	$scope.other_info = resp.data.media;
            } else {
            	alert(resp.data.message);
            }
        	// console.log($scope.formData);
            $scope.formData.uploading = false;
        }, function (resp) {
            // console.log('Error status: ' + resp.status);
            $scope.formData.uploading = false;
        }, function (evt) {
            // $scope.uploading_percentage = parseInt(100.0 * evt.loaded / evt.total) + '%';
        });
    }

    $scope.removeFile = function(file){
    	$scope.formData[file] = '';
    }

    $scope.uploadInvestorFile = function (file, name, object) {
    	console.log(object);
    	var scope_val = name;
    	$scope[name] = true
		var url = base_url+'/api/upload/file';
        Upload.upload({
            url: url,
            data: {
            	media: file
            }
        }).then(function (resp) {
        	// console.log(resp);
            if(resp.data.success){
            	object[scope_val] = resp.data.media;
            } else {
            	alert(resp.data.message);
            }
            $scope[name] = false;
        }, function (resp) {
            // console.log('Error status: ' + resp.status);
            $scope[name] = false;
        }, function (evt) {
            // $scope.uploading_percentage = parseInt(100.0 * evt.loaded / evt.total) + '%';
        });
    }

    $scope.removeInvestorFile = function(object,file_name){
    	object[file_name] = '';
    	// console.log('me run');
    }

    $scope.delete = function(investment,index){
		bootbox.confirm('Are you sure',function(result){
			if(result){
				investment.deleting = true;
				InvestmentService.delete(investment.id).then(function(data){
					if(data.success){
						$scope.investments.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					investment.deleting = false;
				});
			}
			else{
				investment.deleting = false;
			}
		});
	}
 	


});

app.controller('investmentSheetCtrl',function($scope, $http , InvestmentService){

	$scope.investments = [];
	$scope.searchFilter = {};
	$scope.formData = {};
	$scope.page_no = 1;
	$scope.data = {
		per_page : 50
	};
	$scope.area_form = {};

	$scope.loading = true;
	$scope.loading_company_information = false;
	$scope.changing_page = false;

	$scope.head_col = "";
	$scope.hover_investment_id = 0;

	$scope.defaultSector = {sector_id:'',industry1_id:'',industry2_id:''};
	$scope.defaultGoal = {goal_id:''};

	$scope.hoverItem = function(field, investment_id){
		$scope.head_col = field.slug;
		$scope.hover_investment_id = investment_id;
	}

	$scope.range = function(min, max, step) {
	    step = step || 1;
	    var input = [];
	    for (var i = min; i <= max; i += step) {
	        input.push(i);
	    }
	    return input;
	};

	$scope.changePage = function(page_no){
		if(page_no == $scope.page_no) return;

		$scope.page_no = page_no;
		$scope.changing_page = true;
		$scope.initials('page');
	}

	$scope.initials = function(type){
		if(type == 'filter'){
			$scope.filtering = true;
		}
		InvestmentService.initialsSheet(0,$scope.page_no,type, $scope.data).then(function(data){
			$scope.investments = data.investments;

			if(type == 'all'){
				$scope.fields = data.investment_map;

				$scope.area_types = data.area_types;
				$scope.city_sub_tags = data.city_sub_tags;
				$scope.state_sub_tags = data.state_sub_tags;
				$scope.country_sub_tags = data.country_sub_tags;
				$scope.continent_sub_tags = data.continent_sub_tags;

				$scope.impact_sectors = data.impact_sectors;
				$scope.impact_industries = data.impact_industries;
				$scope.development_goals = data.development_goals;

				$scope.data.filters = data.filters;

				$scope.total_pages = data.total_pages;
				$scope.total_investments = data.total_investments;
			}

			if(type == 'filter'){
				$scope.total_pages = data.total_pages;
				$scope.total_investments = data.total_investments;	
				$scope.filtering = false;
			}

			for (var i = $scope.investments.length - 1; i >= 0; i--) {
				for (var k = $scope.fields.length - 1; k >= 0; k--) {
					if(!$scope.investments[i][$scope.fields[k].slug]){
						$scope.investments[i][$scope.fields[k].slug] = '';
					}
					if(!$scope.investments[i][$scope.fields[k].slug_text]){
						$scope.investments[i][$scope.fields[k].slug_text] = '';
					}
				}
			}

			$scope.loading = false;
			$scope.changing_page = false;

		});
	}

	$scope.dblClick = function(investment, field){

		if(field.type == 'multiple'){
			$scope.formData = {};
			$scope.formData.id = investment.id;
			if(field.slug == 'impact_areas'){
				$("#impactAreaModal").modal("show");
				$scope.formData.areas = investment.areas;
			}

			if(field.slug == 'impact_sectors'){
				$("#impactSectorModal").modal("show");
				$scope.formData.sectors = investment.sectors;
			}

			if(field.slug == 'development_goals'){
				$("#impactGoalModal").modal("show");
				$scope.formData.goals = investment.goals;
			}

			if(field.slug == 'company_name'){
				$("#companyModal").modal("show");
				$scope.formData.loading_company_information = true;

				InvestmentService.fetchCompanyInformation(investment.id).then(function(data){
					$scope.formData.loading_company_information = false;
					$scope.social_enterprises = data.social_enterprises;
					$scope.third_party_certifications = data.third_party_certifications;
					$scope.formData.company_information = data.company_information;
				});
			}

		} else {
			if(!investment[field.slug+'_edit']){
				investment[field.slug+'_edit'] = {};
			}
			investment[field.slug+'_edit'].show = true;

			if(field.type == 'select'){
				if(!field.options){
					InvestmentService.fetchOptions(field.tag_id).then(function(data){
						console.log(data.options);
						field.options = data.options;
					});
				}
			}
		}
		
	}

	$scope.cancelClick = function(investment, field){
		investment[field.slug+'_edit'].show = false;
	}

	$scope.changeToNull = function(investment, field){
		
		var id = investment.id;
		var value = null;
		var my_field = field.slug;

		investment[field.slug+"_edit"].processing = true;
		InvestmentService.updateField(id, value, my_field).then(function(data){
			investment[field.slug+"_edit"].processing = false;
			investment[field.slug+"_edit"].show = false;
			investment[field.slug_text] = '';
		});
	}

	$scope.changeValue = function(investment, field, keyEvent){

		if(field.type == 'input'){

			if (keyEvent.which === 13){
				
				var id = investment.id;
				var value = investment[field.slug+"_edit"].value;
				var my_field = field.slug;

				if(value){
					investment[field.slug+"_edit"].processing = true;
					InvestmentService.updateField(id, value, my_field).then(function(data){
						investment[field.slug+"_edit"].processing = false;
						investment[field.slug+"_edit"].show = false;
						investment[field.slug_text] = investment[field.slug+"_edit"].value;
					});
				} else {
					investment[field.slug+"_edit"].show = false;
				}
			}

		} else if(field.type == 'select'){

			investment[field.slug+"_edit"].processing = true;
			var id = investment.id;
			var value = investment[field.slug];
			var my_field = field.slug;
			
			InvestmentService.updateField(id, value, my_field).then(function(data){
				investment[field.slug+"_edit"].processing = false;
				investment[field.slug+"_edit"].show = false;
				var new_text = '';
				for (var i = field.options.length - 1; i >= 0; i--) {
					if(field.options[i].id == value){
						new_text = field.options[i].name;
					}
				}
				investment[field.slug_text] = new_text;
			});
		}

	}

	$scope.fetchSubTags = function(filter){
		// if(filter.type == 'select'){
			if(!filter.options){
				InvestmentService.fetchOptions(filter.tag_id).then(function(data){
					console.log(data.options);
					filter.options = data.options;
				});
			}
		// }
	}

	$scope.clearAllFilters = function(){
		for (var i = $scope.data.filters.length - 1; i >= 0; i--) {
			$scope.data.filters[i].value = "";
		}
		$scope.initials('filter');
	}

	$scope.addImpactArea = function(area_type){
		console.log($scope.area_form);
		if($scope.area_form.area_type != 5){
			var geo_id = 0;
			var geo_name = 0;
			switch($scope.area_form.area_type){
				case 1:
					geo_id = $scope.area_form.continent_geo_id;
					for (var i = $scope.continent_sub_tags.length - 1; i >= 0; i--) {
						if($scope.continent_sub_tags[i].id == geo_id){
							geo_name = $scope.continent_sub_tags[i].name;
						}
					};
					break;
				case 2:
					geo_id = $scope.area_form.country_geo_id;
					for (var i = $scope.country_sub_tags.length - 1; i >= 0; i--) {
						if($scope.country_sub_tags[i].id == geo_id){
							geo_name = $scope.country_sub_tags[i].name;
						}
					};
					break;
				case 3:
					geo_id = $scope.area_form.state_geo_id;
					for (var i = $scope.state_sub_tags.length - 1; i >= 0; i--) {
						if($scope.state_sub_tags[i].id == geo_id){
							geo_name = $scope.state_sub_tags[i].name;
						}
					};
					break;
				case 4:
					geo_id = $scope.area_form.city_geo_id;
					for (var i = $scope.city_sub_tags.length - 1; i >= 0; i--) {
						if($scope.city_sub_tags[i].id == geo_id){
							geo_name = $scope.city_sub_tags[i].name;
						}
					};
					break;
			}
			$scope.formData.areas.push({
				type : $scope.area_form.area_type,
				geo_id : geo_id,
				geo_name : geo_name
			});
		} else {
			$scope.formData.areas.push({
				type : $scope.area_form.area_type,
				geo_id : 0,
				geo_name : geo_name,
				latitude : $("#lat").val(),
				longitude : $("#lng").val(),
				address : $("#address").val(),
			});
		}
	}

	$scope.addMoreImpactSector = function(){
		$scope.formData.sectors.push(JSON.parse(JSON.stringify($scope.defaultSector)));
	}

	$scope.addMoreImpactGoal = function(){
		$scope.formData.goals.push(JSON.parse(JSON.stringify($scope.defaultGoal)));
	}

	$scope.removeImpactArea = function(index){
		console.log(index);
		$scope.formData.areas.splice(index,1);
	}

	$scope.removeImpactSector = function(index){
		$scope.formData.sectors.splice(index,1);
	}

	$scope.removeImpactGoal = function(index){
		$scope.formData.goals.splice(index,1);
	}

	$scope.saveInvestment = function(){
		$scope.formData.processing = true;
		InvestmentService.updateMultiple($scope.formData).then(function(data){
			$scope.formData.processing = false;
			if(data.success){
				console.log($scope.formData.id, $scope.page_no, 'investment');
				InvestmentService.initialsSheet($scope.formData.id, $scope.page_no, 'investment', $scope.data).then(function(data){
					console.log(data);
					for (var i = $scope.investments.length - 1; i >= 0; i--) {
						if($scope.investments[i].id == data.investments[0].id){
							$scope.investments[i] = data.investments[0];
							$(".modal").modal("hide");
							break;
						}
					}
				});
			} else {
				alert('error');
			}
		});
	}

});

app.controller('ContinentCtrl',function($scope, $http , ContinentService){
	$scope.continents = [];
	$scope.formData = {};
	$scope.continent_id = 0;

	$scope.initials = function(){
		ContinentService.initials().then(function(data){
			$scope.continents = data.continents;
		});
	}

	$scope.add = function(){
		$scope.formData = {};
		$scope.continent_id = 0;
		$("#continents").modal("show");
	}

	$scope.edit = function(continent){
		$scope.formData = {};
		$scope.formData = continent;
		$scope.continent_id = continent.id;		
		$("#continents").modal("show");
	}

	$scope.onSubmit = function(){
		$scope.processing = true;
		// console.log($scope.formData);

		ContinentService.onSubmit($scope.formData).then(function(data){
			if(data.success){
				if($scope.continent_id != 0){
					for (var i = $scope.continents.length - 1; i >= 0; i--) {
						if($scope.continents[i]['id'] == data.continent.id){
							$scope.continents[i] = data.continent;
						}
					}
				}else{
					$scope.continents.push(data.continent);
				}
				$("#continents").modal("hide");
			}else{
				bootbox.alert(data.message);
			}
			$scope.processing  = false;
		});

	}

	$scope.delete = function(continent,index){
		bootbox.confirm("Are you sure ?",function(result){
			if(result){
				continent.delete = true;
				ContinentService.delete(continent.id).then(function(data){
					if(data.success){
						$scope.continents.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					continent.delete = false;
				});
			}
		});
	}

});

app.controller('CountryCtrl',function($scope, $http , CountryService){
	$scope.countries = [];
	$scope.formData = {};
	$scope.country_id = 0;

	$scope.initials = function(){
		CountryService.initials().then(function(data){
			$scope.countries = data.countries;
			$scope.continents = data.continents;
		});
	}

	$scope.add = function(){
		$scope.formData = {};
		$scope.continent_id = 0;
		$("#countries").modal("show");
	}

	$scope.edit = function(country){
		$scope.formData = {};
		$scope.formData = country;
		$scope.country_id = country.id;		
		$("#countries").modal("show");
	}

	$scope.onSubmit = function(){
		$scope.processing = true;
		// console.log($scope.formData);

		CountryService.onSubmit($scope.formData).then(function(data){
			if(data.success){
				if($scope.country_id != 0){
					for (var i = $scope.countries.length - 1; i >= 0; i--) {
						if($scope.countries[i]['id'] == data.country.id){
							$scope.countries[i] = data.country;
						}
					}
				}else{
					$scope.countries.push(data.country);
				}
				$("#countries").modal("hide");
			}else{
				bootbox.alert(data.message);
			}
			$scope.processing  = false;
		});

	}

	$scope.delete = function(country,index){
		bootbox.confirm("Are you sure ?",function(result){
			if(result){
				country.delete = true;
				CountryService.delete(country.id).then(function(data){
					if(data.success){
						$scope.countries.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					country.delete = false;
				});
			}
		});
	}

});

app.controller('StateCtrl',function($scope, $http , StateService){
	$scope.states = [];
	$scope.formData = {};
	$scope.state_id = 0;

	$scope.initials = function(){
		StateService.initials().then(function(data){
			$scope.states = data.states;
		});
	}

	$scope.add = function(){
		$scope.formData = {};
		$scope.state_id = 0;
		$("#states").modal("show");
	}

	$scope.edit = function(state){
		$scope.formData = {};
		$scope.formData = state;
		$scope.state_id = state.id;		
		$("#states").modal("show");
	}

	$scope.onSubmit = function(){
		$scope.processing = true;
		// console.log($scope.formData);

		StateService.onSubmit($scope.formData).then(function(data){
			if(data.success){
				if($scope.state_id != 0){
					for (var i = $scope.states.length - 1; i >= 0; i--) {
						if($scope.states[i]['id'] == data.state.id){
							$scope.states[i] = data.state;
						}
					}
				}else{
					$scope.states.push(data.state);
				}
				$("#states").modal("hide");
			}else{
				bootbox.alert(data.message);
			}
			$scope.processing  = false;
		});

	}

	$scope.delete = function(state,index){
		bootbox.confirm("Are you sure ?",function(result){
			if(result){
				state.delete = true;
				StateService.delete(state.id).then(function(data){
					if(data.success){
						$scope.states.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					state.delete = false;
				});
			}
		});
	}

});

app.controller('CityCtrl',function($scope, $http , CityService){
	$scope.cities = [];
	$scope.formData = {};
	$scope.city_id = 0;

	$scope.initials = function(){
		CityService.initials().then(function(data){
			// console.log(data);
			$scope.countries = data.countries;
			$scope.states = data.states;
			$scope.cities = data.cities;
		});
	}

	$scope.add = function(){
		$scope.formData = {};
		$scope.city_id = 0;
		$("#cities").modal("show");
	}

	$scope.edit = function(city){
		$scope.formData = {};
		$scope.formData = city;
		// console.log($scope.formData);
		$scope.city_id = city.id;		
		$("#cities").modal("show");
	}

	$scope.onSubmit = function(){
		$scope.processing = true;
		// console.log($scope.formData);

		CityService.onSubmit($scope.formData).then(function(data){
			if(data.success){
				if($scope.city_id != 0){
					for (var i = $scope.cities.length - 1; i >= 0; i--) {
						if($scope.cities[i]['id'] == data.city.id){
							$scope.cities[i] = data.city;
						}
					}
				}else{
					$scope.cities.push(data.city);
				}
				$("#cities").modal("hide");
			}else{
				bootbox.alert(data.message);
			}
			$scope.processing  = false;
		});

	}

	$scope.delete = function(city,index){
		bootbox.confirm("Are you sure ?",function(result){
			if(result){
				city.delete = true;
				CityService.delete(city.id).then(function(data){
					if(data.success){
						$scope.countries.splice(index,1);
					}else{
						bootbox.alert(data.message);
					}
					city.delete = false;
				});
			}
		});
	}

});

app.controller('brokerIndexCtrl',function($scope, $http , BrokerService){
	$scope.clients = [];
	
	$scope.initials = function(){
		BrokerService.initials().then(function(data){
			console.log(data);
			$scope.clients = data.clients;
		});
	}

	$scope.initials();

});

app.controller('historyCtrl',function($scope, $http , HistoryService){
	$scope.history_data = [];
	$scope.formData = {};
	$scope.editmode = false;
	
	$scope.initials = function(){
		HistoryService.initials().then(function(data){
			console.log(data);
			$scope.history_data = data.history_data;
		});
	}

	$scope.edit = function(history){
		$scope.editmode = true;
		$scope.formData.id = history.id;
		$scope.formData.year = history.year;
		$scope.formData.content = history.content;
		$scope.formData.size = history.size;
		$('html,body').scrollTop(0);
	}

	$scope.cancel = function(history){
		$scope.formData = {};
		$scope.editmode = false;
	}

	$scope.delete = function(history){
		$scope.formData = {};
		$scope.editmode = false;
		history.deleting = true;
		var history_id = history.id;
		HistoryService.deleteHistory(history_id).then(function(data){
			for (var i = 0; i < $scope.history_data.length; i++) {
				if($scope.history_data[i].id == history_id){
					$scope.history_data.splice(i,1);
				}
			};
			history.deleting = false;
		});
	}

	$scope.addHistory = function(){
		$scope.processing = true;
		HistoryService.addHistory($scope.formData).then(function(data){
			if($scope.editmode){
				for (var i = $scope.history_data.length - 1; i >= 0; i--) {
					if($scope.history_data[i].id == data.history.id){
						$scope.history_data[i] = data.history;
					}
				};
			} else {
				$scope.history_data.push(data.history);	
			}
			$scope.processing = false;
			$scope.formData = {};
			$scope.editmode = false;
		});
	}

	$scope.initials();

});


app.controller('glossaryCtrl',function($scope, $http , GlossaryService){
	$scope.glossary_data = [];
	$scope.formData = {};
	$scope.editmode = false;
	
	$scope.initials = function(){
		GlossaryService.initials().then(function(data){
			console.log(data);
			$scope.glossary_data = data.glossary_data;
		});
	}

	$scope.edit = function(glossary){
		$scope.editmode = true;
		$scope.formData.id = glossary.id;
		$scope.formData.name = glossary.name;
		$scope.formData.content = glossary.content;
		$('html,body').scrollTop(0);
	}

	$scope.cancel = function(glossary){
		$scope.formData = {};
		$scope.editmode = false;
	}

	$scope.delete = function(glossary){
		$scope.formData = {};
		$scope.editmode = false;
		glossary.deleting = true;
		var glossary_id = glossary.id;
		GlossaryService.deleteGlossary(glossary_id).then(function(data){
			for (var i = 0; i < $scope.glossary_data.length; i++) {
				if($scope.glossary_data[i].id == glossary_id){
					$scope.glossary_data.splice(i,1);
				}
			};
			glossary.deleting = false;
		});
	}

	$scope.addGlossary = function(){
		$scope.processing = true;
		GlossaryService.addGlossary($scope.formData).then(function(data){
			if($scope.editmode){
				for (var i = $scope.glossary_data.length - 1; i >= 0; i--) {
					if($scope.glossary_data[i].id == data.glossary.id){
						$scope.glossary_data[i] = data.glossary;
					}
				};
			} else {
				$scope.glossary_data.push(data.glossary);	
			}
			$scope.processing = false;
			$scope.formData = {};
			$scope.editmode = false;
		});
	}

	$scope.initials();

});