app.service('StrategyService', function($http, $rootScope){
    
    this.update = function(values, time_horizon_id, financial_return_id, risk_profile_id){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/strategy/risk-score",
			data : {
				values : values,
				time_horizon_id : time_horizon_id,
				financial_return_id : financial_return_id,
				risk_profile_id : risk_profile_id
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('TagService', function($http, $rootScope){
    

    this.initials = function(menu_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/tags?menu_id="+menu_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.storeTag = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/tags/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.storeSubTag = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/tags/subtags/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.updateSubTag = function(data,subtag_id){
    	console.log(base_url + "/api/tags/subtags/edit/"+subtag_id);
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/tags/subtags/edit/"+subtag_id,
			data:data
		})
		.then(function(response) {
			console.log(response);
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.getTag = function(id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/tags/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.subTags = function(tag_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/tags/subtags/"+tag_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.removeTag = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/tags/delete/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.removeSubTag = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/tags/subtags/delete/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

});

app.service('GraphService', function($http, $rootScope){
    
	this.getCall = function(route){
        var promise = $http({
            method: 'GET',
            url: base_url + route
        })
        .then(function(response) {
            console.log(response);
            if(response.status == 200){
                if(response.data.success){

                    return response.data;
                } else {
                    return response.data;
                }
            }
        });

        return promise;
    }

    this.postCall = function(data, route){
        console.log(data);
        var promise = $http({
            method: 'POST',
            url: base_url + route,
            data: data
        })
        .then(function(response) {
            if(response.status == 200){
                if(response.data.success){
                    return response.data;
                } else {
                    return response.data;
                }
            }
        });

        return promise;
    }
    

});


app.service('QuesService', function($http, $rootScope){
    

    this.initials = function(questionnaire_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions?questionnaire_id="+questionnaire_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }


    this.checkFilter = function(field_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions/checkFilter?field_id="+field_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }


    this.loadParentQuestions = function(category_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions/loadParentQuestions/"+category_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.loadParentOptions = function(question_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions/loadParentOptions/"+question_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.loadSubTags = function(tag_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions/loadSubTags/"+tag_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/questions/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.changeCategory = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/questions/changeCategory",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.editQuestion = function(ques_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions/"+ques_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.deleteQuestion = function(ques_id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/questions/delete/"+ques_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.savePageNos = function(questions){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/questions/save-order",
			data: {
				questions: questions
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	console.log(response.data);
	        	return response.data;
	        }
	    });

	    return promise;
    }

});


app.service('SidebarService', function($http, $rootScope){
    

    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/menu",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.storeMenu = function(menu_name){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/menu/add",
			data:{'menu_name':menu_name}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

});

app.service('RelationService', function($http, $rootScope){
    

    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/relations",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/relations/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.loadSubtags = function(tag_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/relations/subtags/"+tag_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.submitRelationLinks = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/relations/storeRelationLinks",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.getLinks = function(relation_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/relations/getRelationLinks/"+relation_id,

		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.deleteRelation = function(relation_id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/relations/delete/"+relation_id,

		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }
    
});

app.service('UserDashboardService', function($http, $rootScope){
    

    this.initials = function(type){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/user-dashboard/"+type,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(answers,questionnaire_id){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/user-dashboard/submit",
			data : {
				answers : answers,
				questionnaire_id : questionnaire_id
			}
		})
		.then(function(response) {
			console.log(response);
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

});

app.service('EntrepreneurService',function($http){

	this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/entrepreneur",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/entrepreneur/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.edit = function(entrepreneur_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/entrepreneur/edit/"+entrepreneur_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.delete = function(entrepreneur_id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/entrepreneur/delete/"+entrepreneur_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.deleteDocument = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/entrepreneur/deleteDocument/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('InvestmentService',function($http){

	this.initials = function(entrepreneur_id){
		console.log(entrepreneur_id);
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/investments?entrepreneur_id="+entrepreneur_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		console.log(response.data);
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.initialsSheet = function(investment_id, page_no, type, data){

    	console.log(data);
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/investments/sheet/"+investment_id+"/"+page_no+"/"+type,
			data: data
		})
		.then(function(response) {
			console.log(response);
	        if(response.status == 200){
	        	if(response.data.success){
	        		
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/investments/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.edit = function(investment_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/investments/edit/"+investment_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.delete = function(investment_id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/investments/delete/"+investment_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.deleteDocument = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/investments/deleteDocument/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.updateField = function(id, value, field_name){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/investments/update-field",
			data: {
				investment_id: id,
				value: value,
				field_name: field_name
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }



    this.updateMultiple = function(form_data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/investments/update-multiple",
			data: form_data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.fetchOptions = function(tag_id){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/investments/fetch-options",
			data: {
				tag_id: tag_id
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.fetchCompanyInformation = function(investment_id){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/investments/fetch-company-information",
			data: {
				investment_id: investment_id
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data;
	        	}
	        }
	    });

	    return promise;
    }

    this.investmentDetails = function(investment_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/investments/product/details/"+investment_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		console.log(response.data);
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

});

app.service('UserResultService', function($http, $rootScope){

    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/result",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.updateUser = function(field_name,value){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/investor/update/profile",
			data: {
				field_name: field_name,
				value : value
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.investmentDetails = function(investment_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/investments/details/"+investment_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    } 
});

app.service('ContinentService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/continents",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/continents/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.delete = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/continents/delete/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('CountryService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/countries",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/countries/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.delete = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/countries/delete/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('StateService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/states",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/states/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.delete = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/states/delete/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('CityService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/cities",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.onSubmit = function(data){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/cities/add",
			data:data
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.delete = function(id){
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/cities/delete/"+id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('FinancialReportService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/financial/report",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }
});

app.service('ImpactReportService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/impact/report",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }
});

app.service('CompareService', function($http, $rootScope){
    this.initials = function(type){

    	var url = base_url + "/investor/compare";
    	if(type){
    		url += '?type=1';
    	}

    	console.log(url);

    	var promise = $http({
			method: 'GET',
			url: url
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }
});

app.service('RecommendationService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/investor/recommendations",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }
});

app.service('PortfolioService', function($http, $rootScope){
    this.initials = function(type){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/investor/portfolio",
			data: {
				sorter : type
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.addPortfolio = function(investment_id, amount){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/investor/portfolio/add/"+investment_id,
			data: {
				amount : amount
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });
	    return promise;
    }

    this.removePortfolio = function(investment_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/portfolio/remove/"+investment_id
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });
	    return promise;
    }

    this.startInvest = function(investment_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/portfolio/start-invest/"+investment_id
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });
	    return promise;
    }

    this.sellInvestment = function(investment_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/portfolio/sell-invest/"+investment_id
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });
	    return promise;
    }

});

app.service('RecommendedService', function($http, $rootScope){
    this.initials = function(type){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/recommended-portfolio"
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

 });

app.service('OwnService', function($http, $rootScope){
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/own",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.compare = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/compare-non-andorra",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.addInvestment = function(investment){
    	console.log(investment);
    	var promise = $http({
			method: 'POST',
			url: base_url + "/investor/own/add",
			data: investment
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.removeInvestment = function(user_investment_id){
    	console.log(user_investment_id);
    	var promise = $http({
			method: 'POST',
			url: base_url + "/investor/own/remove",
			data: {
				user_investment_id : user_investment_id
			}
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }
});


app.service('BrokerService', function($http, $rootScope){
    

    this.initials = function(menu_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/advisor/initials",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }
});

app.service('HistoryService', function($http, $rootScope){
    

    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/history/initials",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.addHistory = function(formData){
    	console.log(formData);
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/history/add",
			data: formData
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.deleteHistory = function(history_id){
    	console.log(history_id);
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/history/delete/"+history_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }
});

app.service('GlossaryService', function($http, $rootScope){
    

    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/glossary/initials",
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.addGlossary = function(formData){
    	console.log(formData);
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/glossary/add",
			data: formData
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }

    this.deleteGlossary = function(glossary_id){
    	
    	var promise = $http({
			method: 'DELETE',
			url: base_url + "/api/glossary/delete/"+glossary_id,
		})
		.then(function(response) {
	        if(response.status == 200){
	        	if(response.data.success){
	        		return response.data;
	        	} else {
	        		return response.data.message;
	        	}
	        }
	    });

	    return promise;
    }
});

app.service('FeedbackService', function($http, $rootScope){
    
    this.store = function(formData){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/feedback/store",
			data: formData
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});

app.service('AnalyticsService', function($http, $rootScope){
    
    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/investment-analysis"
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

    this.fetch = function(vertical,horizontal){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/investor/investment-analysis/"+vertical+"/"+horizontal
		})
		.then(function(response) {
	        if(response.status == 200){
	        	return response.data;
	        }
	    });

	    return promise;
    }

});
