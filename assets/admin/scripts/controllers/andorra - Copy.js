app.controller('strategyCtrl',function($scope , $http , StrategyService ){

	$scope.edit = function(time_horizon_id, financial_return_id, risk_profile_id){
		var div_class = ".rs_"+time_horizon_id+"_"+financial_return_id+"_"+risk_profile_id;
		$(div_class + " input").removeAttr("readonly");
		$(div_class + " button.edit").hide();
		$(div_class + " button.update").show();
	}

	$scope.update = function(time_horizon_id, financial_return_id, risk_profile_id){
		var div_class = ".rs_"+time_horizon_id+"_"+financial_return_id+"_"+risk_profile_id;
		var form = $(div_class).find("form:first");
		var dataString = form.serialize();
		
		StrategyService.update(dataString, time_horizon_id, financial_return_id, risk_profile_id).then(function(data){
			if(data.success){
				$(div_class + " input").attr("readonly","readonly");
				$(div_class + " button.edit").show();
				$(div_class + " button.update").hide();
			} else {
				bootbox.alert(data.message);
			}
		});
	}

});

app.controller('tagCtrl',function($scope , $http ,TagService){
	$scope.tags = [];
	$scope.tagData = {};
	$scope.subTagData = {};
	$scope.processing = false;
	$scope.tag_id = 0;
	$scope.menu_id = 0;
	$scope.subtags = [];
	$scope.tag_name = '';

    $scope.initials = function(){
		TagService.initials($scope.menu_id).then(function(data){
			if(data.success){
				$scope.tags = data.tags;
			}else{
	    		bootbox.alert(data.message);
			}
		});
	}

	$scope.addTag = function(){
		$scope.tagData = {};
		$scope.tag_id = 0;
		$scope.subTagData = {};
		$scope.subtags = [];
		$('#tags').modal("show");
	}

	$scope.addSubTag = function(tag_id,tag_name){
		$scope.tag_id = tag_id;
		// console.log(tag_id);
		$scope.tag_name = tag_name;
		TagService.subTags(tag_id).then(function(data){
			$scope.subtags = data.subtags;
			// console.log(data);
		});

		$('#subtags').modal("show");
	}

	$scope.updateSubtag = function(subtag){
		subtag.processing = true;
		TagService.updateSubTag(subtag,subtag.id).then(function(data){
			subtag.edit = false;
			subtag.processing = false;
		});
	}



	$scope.onSubmit = function(){
		$scope.processing  = true;
		$scope.tagData['menu_id'] = $scope.menu_id;
		if($scope.tag_id != 0){
			$scope.tagData['tag_id'] = $scope.tag_id;
		} 
		TagService.storeTag($scope.tagData).then(function(data){
			if(data.success){
				if($scope.tag_id != 0){
					for (var i = $scope.tags.length - 1; i >= 0; i--) {
						if($scope.tags[i]['id'] == data.tag.id){
							$scope.tags[i] = data.tag;
						}
					}
					$('#tags').modal("hide");
				} else{

					$scope.tags.push(data.tag);
				}
				$scope.tagData = {};
				$scope.TagForm.$setPristine();
				$scope.tag_id = 0;
			}else{
	    		bootbox.alert(data.message);
			}
			$scope.processing = false;
		});
	}

	$scope.storeSubTags = function(){
		$scope.processing  = true;
		$scope.subTagData['tag_id'] = $scope.tag_id;
		 
		TagService.storeSubTag($scope.subTagData).then(function(data){
			if(data.success){
				$scope.subtags.push(data.subtag);
				$scope.subTagData = {};
				$scope.subTagForm.$setPristine();
			}else{
	    		bootbox.alert(data.message);
			}
			$scope.processing = false;
		});
	}

	$scope.editTag = function(id){
		$('#tags').modal("show");
		$scope.tag_id = id;
		TagService.getTag(id).then(function(data){
			if(data.success){
				$scope.tagData = data.tag;
 			}else{
	    		bootbox.alert(data.message);
			}
			$scope.processing = false;
		});
	}
	
	$scope.deleteTag = function(id,index){
		bootbox.confirm("Are you sure?", function(result) {
	      	if(result) {

				$scope['processing_'+index] = true;
				TagService.removeTag(id).then(function(data){
					if(data.success){
						// console.log(index);
						// console.log($scope.tags);
						$scope.tags.splice(index , 1);
		 			}else{
			    		bootbox.alert(data.message);
					}
					$scope['processing_'+index] = false;
				});
			}
		})
	}

	$scope.deleteSubTag = function(id,index){
		bootbox.confirm("Are you sure?", function(result) {
	      	if(result) {

				$scope['processing_sub_'+index] = true;
				TagService.removeSubTag(id).then(function(data){
					if(data.success){
						$scope.subtags.splice(index , 1);
		 			}else{
			    		bootbox.alert(data.message);
					}
					$scope['processing_sub_'+index] = false;
				});
			}
		})
	}

	$("#tags").on("hidden.bs.modal", function () {
	    $scope.tagData = {};
		$scope.tag_id = 0;
		$scope.tag_name = '';
		$scope.subtags = [];
	});

});

app.controller('QuesCtrl',function($scope , $http ,QuesService,Upload){
	$scope.category_id = 0;
	$scope.questions = [];
	
	$scope.menus = [];
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
			{'option_name':'','weight':'','tag_id':''},
			{'option_name':'','weight':'','tag_id':''},
			{'option_name':'','weight':'','tag_id':''}
		]
	};
	
    $scope.initials = function(check){
		console.log($scope.category_id);
		QuesService.initials($scope.category_id).then(function(data){
			console.log(data);
			if(data.success){
				$scope.questions = data.questions;
				$scope.filters = data.filters;
				$scope.types = data.types;
				$scope.menus = data.menus;
			}else{
	    		bootbox.alert(data.message);
			}
		});
	}

	$scope.loadParentQuestions = function(){
		if($scope.quesData.follow_up == 1){
			QuesService.loadParentQuestions($scope.category_id).then(function(data){
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
		$scope.quesData.menus = JSON.parse(JSON.stringify($scope.menus));
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
		$scope.quesData['category_id'] = $scope.category_id;
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
				// console.log(data.question);
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

app.controller('UserDashboardCtrl',function($scope, $element, dragularService, $timeout, $interval,UserDashboardService){
	$scope.categories = [];
	$scope.open_category_id = 0;
	$scope.answers = [];
	$scope.split_evenly = [];
	$scope.question_weight = [];
	$scope.ranks = [];
	$scope.option_ranks = [];
	$scope.error_questions = [];
	$scope.selected_countries = [];

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
		UserDashboardService.initials().then(function(data){
			// console.log(data);
			if(data.success){
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

	$scope.submit_response = function(){
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
		UserDashboardService.onSubmit(final_answers).then(function(data){
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
	$scope.formData.InvestorMaterial = {};
	$scope.formData.financial = {};
	$scope.formData.andorra = {};

	$scope.managements = [];
	$scope.entrepreneurs = [];
	$scope.defaultManagement = {management_first_name:'',management_last_name:'',position:'',linkedin_profile:'',image:''};
	$scope.defaultArea = {type:'',geo_id:''};
	$scope.defaultSector = {sector_id:'',industry1_id:'',industry2_id:''};
	$scope.defaultGoal = {goal_id:''};
	$scope.years = [];
	$scope.entrepreneur_id = 0;
	$scope.InvestorMaterial = {};
	$scope.financial = {};
	$scope.andorra = {};

	$scope.initials = function(){
		$scope.managements.push($scope.defaultManagement);
		$scope.formData.managements = [JSON.parse(JSON.stringify($scope.defaultManagement))];

		// $scope.areas.push($scope.defaultManagement);
		$scope.formData.areas = [JSON.parse(JSON.stringify($scope.defaultArea))];
		$scope.formData.sectors = [JSON.parse(JSON.stringify($scope.defaultSector))];
		$scope.formData.goals = [JSON.parse(JSON.stringify($scope.defaultGoal))];

		EntrepreneurService.initials().then(function(data){
			// console.log(data);
			$scope.years = data.years;
			$scope.entrepreneurs = data.entrepreneurs;
			$scope.city_sub_tags = data.city_sub_tags;
			$scope.state_sub_tags = data.state_sub_tags;
			$scope.country_sub_tags = data.country_sub_tags;
			$scope.continent_sub_tags = data.continent_sub_tags;

			//prerequisites for impact form
			$scope.employees = data.employees;

			$scope.impact_sectors = data.impact_sectors;
			$scope.development_goals = data.development_goals;
			$scope.impact_industries = data.impact_industries;
			$scope.impact_objectives = data.impact_objectives;
			$scope.impact_focus = data.impact_focus;
			$scope.social_enterprises = data.social_enterprises;
			$scope.third_party_certifications = data.third_party_certifications;

			$scope.area_types = data.area_types;

			//prerequisites for financials
			$scope.financial_dropdowns = data.financial_dropdowns;

			//prerequisites for andorra
			$scope.andorra_dropdowns = data.andorra_dropdowns;

		});

		if($scope.entrepreneur_id != 0){
			EntrepreneurService.edit($scope.entrepreneur_id).then(function(data){
				$scope.formData = data.entrepreneur;
				$scope.InvestorMaterial = data.entrepreneur.InvestorMaterial;
				$scope.financial = data.entrepreneur.financial;
				$scope.andorra = data.entrepreneur.andorra;
				
				$scope.managements = data.entrepreneur.managements;
				if($scope.managements.length < 1){
					$scope.managements.push($scope.defaultManagement);

				}

				if(data.entrepreneur.areas.length >= 1){
					$scope.formData.areas = data.entrepreneur.areas;
				} else {
					$scope.formData.areas = [JSON.parse(JSON.stringify($scope.defaultArea))];
				}

				if(data.entrepreneur.sectors.length >= 1){
					$scope.formData.sectors = data.entrepreneur.sectors;
				} else {
					$scope.formData.sectors = [JSON.parse(JSON.stringify($scope.defaultSector))];
				}


				if(data.entrepreneur.goals.length >= 1){
					$scope.formData.goals = data.entrepreneur.goals;
				} else {
					$scope.formData.goals = [JSON.parse(JSON.stringify($scope.defaultGoal))];
				}

				// if(data.entrepreneur.headquarter){
				// 	$scope.initialize_map(data.entrepreneur.headquarter.latitude,data.entrepreneur.headquarter.longitude);
				// } else {
				// 	$scope.initialize_map(0,0);	
				// }
				// console.log(data);
			});
		} 
	}

	$scope.addMoreManagement = function(){
		$scope.managements.push(JSON.parse(JSON.stringify($scope.defaultManagement)));
	}

	$scope.addMoreImpactArea = function(){
		$scope.formData.areas.push(JSON.parse(JSON.stringify($scope.defaultArea)));
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

	$scope.onSubmit = function(){
		$scope.formData.InvestorMaterial = $scope.InvestorMaterial;
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
    	// console.log(object);
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

app.controller('resultCtrl',function($scope , $http, $interval, UserResultService, $timeout){

	$scope.profiles = [];
	$scope.tab_id = 1;

	$scope.colors = ['#0f66d6','#75cffb', '#a9e7fd', '#68fbb2', '#00eba3','#00eba3',  '#0a8a83', '#191851','#203f98', '#191851'];

	$scope.changeTab = function(tab_id) {
		$scope.tab_id = tab_id;

		if(tab_id == 2){
			$timeout(function() {

				var major_asset_class_allocation = {
			        title : {
				        text: 'Major Assets',
				        x: 'center',
				        y: 185
				    },
			        tooltip: {
				        trigger: 'item',
				        formatter: "{a} <br/>{b} - {d}%"
				    },
			        series : [
				        {
				            name:'Major Asset Class',
				            type:'pie',
				            radius : ['50%','70%'],
				            data: $scope.major_asset_class_allocation,
				            label: {
				                normal: {
				                    show: true,
				                    position: 'outside',
				                    formatter: "{b}",
				                    textStyle: {
				                        color: 'rgba(0, 0, 0, 0.9)',
				                        fontSize: 14
				                    }
				                },
				            },
				            labelLine: {
				                normal: {
				                    show: true
				                }
				            },
				            itemStyle: {
				                normal: {
				                    shadowBlur: 20,
				                    shadowColor: 'rgba(0, 0, 0, 0.1)'
				                }
				            },

				            animationType: 'scale',
				            animationEasing: 'elasticOut',
				            animationDelay: function (idx) {
				                return Math.random() * 200;
				            }
				        }
				    ],
				    color : $scope.colors
			    };

			    var myChart = echarts.init(document.getElementById('major_asset_class_allocation'));
			    myChart.setOption(major_asset_class_allocation);

			    var asset_class_allocation = {
			        title : {
				        text: 'Assets',
				        x: 'center',
				        y: 185
				    },
			        tooltip: {
				        trigger: 'item',
				        formatter: "{a} <br/>{b} - {d}%"
				    },
			        series : [
				        {
				            name:'Asset Class',
				            type:'pie',
				            radius : ['50%','70%'],
				            data: $scope.asset_class_allocation,
				            label: {
				                normal: {
				                    show: true,
				                    position: 'outside',
				                    formatter: "{b}",
				                    textStyle: {
				                        color: 'rgba(0, 0, 0, 0.9)',
				                        fontSize: 14
				                    }
				                },
				            },
				            labelLine: {
				                normal: {
				                    show: true
				                }
				            },
				            itemStyle: {
				                normal: {
				                    shadowBlur: 20,
				                    shadowColor: 'rgba(0, 0, 0, 0.1)'
				                }
				            },

				            animationType: 'scale',
				            animationEasing: 'elasticOut',
				            animationDelay: function (idx) {
				                return Math.random() * 200;
				            }
				        }
				    ],
				    color : $scope.colors
			    };

			    var myChart = echarts.init(document.getElementById('asset_class_allocation'));
			    myChart.setOption(asset_class_allocation);

				var sector_allocation_option = {
			        title : {
				        text: 'Impact Sector',
				        x: 'center',
				        y: 185
				    },
			        tooltip: {
				        trigger: 'item',
				        formatter: "{a} <br/>{b} - {d}%"
				    },
			        series : [
				        {
				            name:'Imapct Sector',
				            type:'pie',
				            radius : ['50%','70%'],
				            data: $scope.sector_allocation,
				            label: {
				                normal: {
				                    show: true,
				                    position: 'outside',
				                    formatter: "{b}",
				                    textStyle: {
				                        color: 'rgba(0, 0, 0, 0.9)',
				                        fontSize: 14
				                    }
				                },
				            },
				            labelLine: {
				                normal: {
				                    show: true
				                }
				            },
				            itemStyle: {
				                normal: {
				                    shadowBlur: 20,
				                    shadowColor: 'rgba(0, 0, 0, 0.1)'
				                }
				            },

				            animationType: 'scale',
				            animationEasing: 'elasticOut',
				            animationDelay: function (idx) {
				                return Math.random() * 200;
				            }
				        }
				    ],
				    color : $scope.colors
			    };

			    var myChart = echarts.init(document.getElementById('sector_allocation'));
			    myChart.setOption(sector_allocation_option);

				var industry_allocation_option = {
			        title : {
				        text: 'Impact Industry',
				        x: 'center',
				        y: 185
				    },
			        tooltip: {
				        trigger: 'item',
				        formatter: "{a} <br/>{b} - {d}%"
				    },
			        series : [
				        {
				            name:'Imapct Industry',
				            type:'pie',
				            radius : ['50%','70%'],
				            data: $scope.industry_allocation,
				            label: {
				                normal: {
				                    show: true,
				                    position: 'outside',
				                    formatter: "{b}",
				                    textStyle: {
				                        color: 'rgba(0, 0, 0, 0.9)',
				                        fontSize: 14
				                    }
				                },
				            },
				            labelLine: {
				                normal: {
				                    show: true
				                }
				            },
				            itemStyle: {
				                normal: {
				                    shadowBlur: 20,
				                    shadowColor: 'rgba(0, 0, 0, 0.1)'
				                }
				            },

				            animationType: 'scale',
				            animationEasing: 'elasticOut',
				            animationDelay: function (idx) {
				                return Math.random() * 200;
				            }
				        }
				    ],
				    color : $scope.colors
			    };

			    var myChart2 = echarts.init(document.getElementById('industry_allocation'));
			    myChart2.setOption(industry_allocation_option);

			    
			    var un_goals_allocation_option = {

			        title : {
				        text: 'UN Sustainable\n Development Goals',
				        x: 'center',
				        y: 175
				    },
			        tooltip: {
				        trigger: 'item',
				        formatter: "{a} <br/>{b} - {d}%"
				    },
			        series : [
				        {
				            name:'Imapct Industry',
				            type:'pie',
				            radius : ['50%','70%'],
				            data: $scope.un_goals_allocation,
				            label: {
				                normal: {
				                    show: true,
				                    position: 'outside',
				                    formatter: "{b}",
				                    textStyle: {
				                        color: 'rgba(0, 0, 0, 0.9)',
				                        fontSize: 14
				                    }
				                },
				            },
				            labelLine: {
				                normal: {
				                    show: true
				                }
				            },
				            itemStyle: {
				                normal: {
				                    shadowBlur: 20,
				                    shadowColor: 'rgba(0, 0, 0, 0.1)'
				                }
				            },

				            animationType: 'scale',
				            animationEasing: 'elasticOut',
				            animationDelay: function (idx) {
				                return Math.random() * 200;
				            }
				        }
				    ],
				    color : $scope.colors
			    };

			    var myChart3 = echarts.init(document.getElementById('un_goals_allocation'));
			    myChart3.setOption(un_goals_allocation_option);
			}, 500);
		}
	}

	$scope.initials = function(){
		UserResultService.initials().then(function(data){
			// console.log(data);
			$scope.profiles = data.profile;

			$scope.major_asset_class_allocation = [];

			for (var i = data.major_asset_class_allocation.length - 1; i >= 0; i--) {
				$scope.major_asset_class_allocation.push({
					value : data.major_asset_class_allocation[i].allocation,
					name : data.major_asset_class_allocation[i].major_asset_class,
				});
			}

			$scope.asset_class_allocation = [];

			for (var i = data.asset_class_allocation.length - 1; i >= 0; i--) {
				$scope.asset_class_allocation.push({
					value : data.asset_class_allocation[i].allocation,
					name : data.asset_class_allocation[i].asset_class.subtag_name,
				});
			}

			$scope.sector_allocation = [];

			for (var i = data.sector_allocation.length - 1; i >= 0; i--) {
				$scope.sector_allocation.push({
					value : data.sector_allocation[i].allocation,
					name : data.sector_allocation[i].sector.subtag_name,
				});
			}

		    $scope.industry_allocation = [];

			for (var i = data.industry_allocation.length - 1; i >= 0; i--) {
				for (var j = data.industry_allocation[i].industry_allocation.length - 1; j >= 0; j--) {
					$scope.industry_allocation.push({
						value : data.industry_allocation[i].industry_allocation[j].allocation,
						name : data.industry_allocation[i].industry_allocation[j].industry.subtag_name,
					});
				}
			}

			$scope.un_goals_allocation = [];

			for (var i = data.un_goals_allocation.length - 1; i >= 0; i--) {
				$scope.un_goals_allocation.push({
					value : data.un_goals_allocation[i].allocation,
					name : data.un_goals_allocation[i].goal,
				});
			}
			
			
		});
	}

	$scope.initials();
	

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