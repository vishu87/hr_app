@include('header')
<main>
    <div class="container" style="min-height: 700px">
        <div class="dashboard-pre">
            <h1>Welcome to Andorra</h1>
            <p class="text1">
                Our mission is to make impact investing simple and easy so that any investor can support the ideas, people and companies changing the world.
            </p>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <section class="steps" style="margin-top: 20px">
                        <div class="row">
                            <div class="step col-md-4">
                                <a href="{{url('investor/questionnaire')}}">
                                    <div>
                                        <div class="image">
                                            <img src="{{url('assets/admin/images/planning.png')}}">
                                        </div>
                                        <div>
                                            <h4>iiPlanning<sup>TM</sup></h4>
                                            <ul>
                                                <li>Client Discovery</li>
                                                <li>Impact Strategy Advice</li>
                                                <li>Impact Investing Policy</li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="step col-md-4">
                                <a href="{{url('investor/search')}}">
                                    <div>
                                        <div class="image">
                                            <img src="{{url('assets/admin/images/database.png')}}">
                                        </div>
                                        <div>
                                            <h4>iiDatabase<sup>TM</sup></h4>
                                            <ul>
                                                <li>Deal Sourcing</li>
                                                <li>Due Diligence Support</li>
                                                <li>Profile Construction</li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="step col-md-4">
                                <a href="{{url('investor/impact-report')}}">
                                    <div>
                                        <div class="image">
                                            <img src="{{url('assets/admin/images/reporting.png')}}">
                                        </div>
                                        <div>
                                            <h4>iiReporting<sup>TM</sup></h4>
                                            <ul>
                                                <li>Financial Reporting</li>
                                                <li>Impact Reporting</li>
                                                <li>Impact Analytics</li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- <p class="text1 hidden">
                Take the questionnaire to discover what type of impact investor you are or start by assessing the impact created by your current investments!
            </p> -->
            <!-- <a class="btn" href="{{url('investor/questionnaire')}}">
                Take me to questionnaire <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
            <a class="btn assessment" href="{{url('investor/what-you-own')}}">
                Impact Assessment <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
            <br><br><br><br> -->
        </div>
    </div>
</main>
@include('footer')