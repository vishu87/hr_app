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

app.service('QuesService', function($http, $rootScope){
    

    this.initials = function(category_id){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/questions?category_id="+category_id,
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
    

    this.initials = function(){
    	var promise = $http({
			method: 'GET',
			url: base_url + "/api/user-dashboard",
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

    this.onSubmit = function(answers){
    	var promise = $http({
			method: 'POST',
			url: base_url + "/api/user-dashboard/submit",
			data : {
				answers : answers
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