<div class="title">IMPACT INVESTING NEWS</div>
<?php
	$news = array(
		array(
			"title" => "Impact Alpha",
			"link" => "https://news.impactalpha.com/how-rise-of-the-rest-will-have-impact-and-why-its-not-an-impact-fund-27815f3531ec",
			"content" => "How Rise of the Rest will have impact — and why it’s not an impact fund"
		),
		array(
			"title" => "On Impact",
			"link" => "http://dukemagazine.duke.edu/article/case-in-the-business-of-bettering-the-world",
			"content" => "In the business of bettering the world?"
		),
		array(
			"title" => "Green Money Journal",
			"link" => "http://greenmoneyjournal.com/the-sri-conference-announces-2017-sri-service-award-winners/",
			"content" => "The SRI Conference Announces 2017 SRI Service Award Winners"
		),
		array(
			"title" => "B the Change",
			"link" => "https://bthechange.com/sell-office-supplies-build-community-grow-a-movement-fec51a86a164",
			"content" => "Sell Office Supplies, Build Community, Grow a Movement"
		),
		array(
			"title" => "Mission Throttle",
			"link" => "http://missionthrottle.com/portfolio/detroit-hispanic-growth-corporation/",
			"content" => "Creating life-changing opportunities for youth and families in Southwest Detroit"
		)
	);

?>
<ul>
	@foreach ($news as $new_item)
	<li>
		<div class="trending-item">
			<a class="head" href="<?php echo $new_item["link"]; ?>"><?php echo $new_item["title"]; ?></a>
			<div class="content">
				<a href="<?php echo $new_item["link"]; ?>" target="_blank"><?php echo $new_item["content"]; ?></a>
			</div>
		</div>
	</li>
	@endforeach
</ul>