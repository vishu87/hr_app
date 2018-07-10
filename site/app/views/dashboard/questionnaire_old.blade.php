@include('header')
@include('navigation')
<main class="ng-cloak">
    <div ng-controller="UserDashboardCtrl" ng-init="type={{(isset($type))?$type:0}}; initials();" class="dashboard">
        <div class="loading" ng-show="loading" style="margin-top: 30px; text-align: center; font-size: 24px">
            Loading questions ...
        </div>
        <div class="tooltipMap" ng-show="displayTooltip"></div>
        @if(Input::has('show'))
        <pre>@{{answers}}</pre>
        @endif
        <div >
            <div class="container @if(!Input::has('show')) hidden @endif" ng-app="app" style="color:#FFF">
                <div class="header">
                    <ul>
                        <li ng-repeat="category in categories" ng-click="selectOpen(category)" ng-class="category.id == open_category_id ? 'active' : '' ">
                            <span>@{{$index + 1}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="background:#FFF">
            <div ng-repeat="category in categories" ng-show="category.id == open_category_id">
                
                <div class="cat-head" ng-show="type == 0">
                    <div class="container-fluid">
                        <h1>STEP @{{$index + 1}} - @{{category.name}}</h1>
                    </div>
                </div>

                <div class="cat-head" ng-show="type == 1">
                    <div class="container-fluid">
                        <h1>Optional Questions</h1>
                    </div>
                </div>

                <div class="questions container">
                    <div ng-repeat="question in category.questions" class="question" ng-hide="question.follow_up == 1 && !question.open">
                        <div class="title" ng-class="error_questions[question.id] == null ? '' : 'error' ">
                            @{{question.question}}
                            <span ng-if="question.remarks && question.remarks != ''" style="color: #AAA" tooltips tooltip-template="@{{question.remarks}}" tooltip-side="right">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </div>
                        <div ng-if="question.type == 4 || question.type == 5">
                            <input type="text" ng-model="answers[question.id]" ng-keyup="error_questions[question.id] = null" />
                        </div>
                        <div ng-repeat="option_group in question.option_groups" class="option-groups" ng-if="question.type != 4 && question.type != 5" ng-hide="question.option_group_type == 1 && !option_group.show" ng-class="question.option_direction == 2 ? 'horizontal' : '' ">

                            <div class="option-group" ng-hide="option_group.option_group_name == '' ">@{{option_group.option_group_name}}
                            </div>

                            <div ng-repeat="option in option_group.options" class="options" ng-if="question.type != 8">
                                <div ng-if="question.type == 1" ng-click="chooseSingle(question, option.id)" ng-class="answers[question.id] == option.id ? 'active' : '' ">
                                    @{{option.name}}
                                    <span ng-if="option.remarks && option.remarks != ''" style="color: #AAA" tooltips tooltip-template="@{{option.remarks}}" tooltip-side="right">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </div>

                                <div ng-if="question.type == 2" ng-click="chooseMultiple(question, option.id)" ng-class="answers[question.id] ? answers[question.id].indexOf(option.id) != -1 ? 'active' : '' : '' ">
                                    @{{option.name}}
                                    <span ng-if="option.remarks && option.remarks != ''" style="color: #AAA" tooltips tooltip-template="@{{option.remarks}}" tooltip-side="right">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </div>
                                <button class="andorra-btn" ng-if="question.type == 6" ng-click="chooseSingleGroup(question, option_group, option)" ng-class="answers[question.id] ? answers[question.id].indexOf(option.id) != -1 ? 'blue' : '' : '' " ng-disabled="option.hide">
                                    @{{option.name}}
                                    <span ng-if="option.remarks && option.remarks != ''" style="color: #AAA" tooltips tooltip-template="@{{option.remarks}}" tooltip-side="right">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </button>

                            </div>

                            <div class="" ng-if="question.type == 8">
                                
                                <div class='wrapper' >
                                    <div class='row'>
                                        <div class='containerVertical col-md-6'>
                                            <div ng-repeat="option in option_group.options">
                                                @{{option.name}}
                                                <span ng-if="option.remarks && option.remarks != ''" style="color: #AAA" tooltips tooltip-template="@{{option.remarks}}" tooltip-side="right">
                                                    <i class="fa fa-question-circle"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class='containerVertical result col-md-6'>
                                            <div ng-repeat="option in answers[question.id]"><span ng-show="!question.split_evenly">@{{$index + 1}} </span>@{{option.name}}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6"><input type="checkbox" ng-model="question.split_evenly" ng-click="splitEvenly(question)">Split Evenly</div>
                                    </div>
                                    <div class="tableRow hidden">
                                        <div class="container">
                                            <div>Items1:
                                                <br/>@{{option_group.options| json}}</div>
                                        </div>
                                        <div class="container">
                                            <div>Items2:
                                                <br/>@{{answers[question.id] | json}}</div>
                                        </div>
                                    </div>
                                </div>
           

                            </div>

                            <div ng-if="question.type == 7">
                                <!-- <multiple-autocomplete ng-model="answers[question.id]"
                                     object-property="name"
                                     suggestions-arr="option_group.options" >
                                </multiple-autocomplete> -->
                                <div
                                    isteven-multi-select
                                    input-model="option_group.options"
                                    output-model="answers[question.id]"
                                    button-label="icon name"
                                    item-label="icon name maker"
                                    tick-property="ticked"
                                    orientation="horizontal"
                                    translation="localLang"
                                >
                                </div>
                            </div>

                            <div ng-if="question.type == 3">
                                <div style="margin: 0 20px;"><rzslider 
                                    rz-slider-model="answers[question.id]"
                                    rz-slider-options="slider.options"></rzslider></div>
                            </div>

                            <!-- <div ng-if="question.type == 10">
                                <div style="position: relative;">
                                    
                                    <div svg-map-us question-id="@{{question.id}}"></div>
                                </div>
                            </div> -->
                            <!-- <div ng-if="question.type == 11">
                                <div svg-map-continent question-id="@{{question.id}}"></div>
                                <div style="text-align: center;">
                                    <input type="checkbox" name=""> No preference
                                    <button class="btn" ng-click="continentContinue()">Continue</button>
                                </div>
                            </div> -->
                            <div ng-if="question.type == 12">
                                <div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="map-options">
                                                <a href="javascript:;" ng-click="search.location_type = 1" ng-class="search.location_type == 1 ?'active':''">World</a> | <a href="javascript:;" ng-click="search.location_type = 2" ng-class="search.location_type == 2 ?'active':''">United States</a>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="dynamic-search">
                                                <input type="text" class="form-control" placeholder="@{{ search.location_type == 1 ? 'search for continents or countries' : 'search for US states or US cities' }}" ng-model="search.name">
                                                <ul ng-class="locations.length > 0 ? 'active':''">
                                                    <li ng-repeat="location in locations | filter:search | filter:countryFilter" ng-click="regionClick(location.name, location.id, question.id, location.div_id, location.type)">
                                                        <span>@{{location.name}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        Your selection
                                        <div class='row'>
                                            <div class='containerVertical col-md-6 hidden'>
                                                <div ng-repeat="option in option_group.options">@{{option.name}}</div>
                                            </div>
                                            <div class='containerVertical result col-md-12'>
                                                <div ng-repeat="option in answers[question.id]" ng-click="regionClick('', option.id, question.id, option.div_id, option.type)"><span ng-show="!question.split_evenly">@{{$index + 1}} </span>@{{option.name}} <i class="fa fa-remove"></i></div>
                                            </div>
                                            <input type="checkbox" ng-model="question.split_evenly" ng-click="splitEvenly(question)">Split Evenly
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-9" id="question_map">
                                        <div svg-map-world question-id="@{{question.id}}" ng-hide="search.location_type != 1"></div>
                                        <div svg-map-us question-id="@{{question.id}}" ng-hide="search.location_type != 2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-buttons">
                    @if($type == 0)
                    <div >
                        <button class="btn" ng-click="goToPrev()" ng-if="open_category_id != 1">Previous</button>
                        <button class="btn" ng-click="goToNext()" ng-if="open_category_id != 4">Next</button>
                        <button class="btn green" ladda="submitting1" ng-click="submit_response(0)" ng-if="open_category_id == 4">Submit</button>
                    </div>
                    @else
                    <div >
                        <button class="btn green" ladda="submitting1" ng-click="submit_response(1)">Submit</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@include('footer')