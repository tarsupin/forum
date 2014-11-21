<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/****** Page Configuration ******/
$config['canonical'] = "/communities";
$config['pageTitle'] = "UniFaction";		// Up to 70 characters. Use keywords.
Metadata::$index = false;
Metadata::$follow = false;
// Metadata::openGraph($title, $image, $url, $desc, $type);		// Title = up to 95 chars.

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Display Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

echo '
<div id="panel-right"></div>
<div id="content" style="overflow:hidden;">' . Alert::display();

echo '
<style>
	.entry-row { float:left; padding:6px; max-width:170px; height:315px; }
	.entry-row img { max-width:100%; }
	.entry-left { text-align:center; }
	.entry-right { text-align:center; }
	.entry-right a { font-size:1.5em; }
</style>';

echo '
<h3>Entertainment Communities</h3>';

$community = array(
	"avatar"	=> array("Avatars", "Equip your virtual avatar with new gear and clothing.", "/assets/images/comm-icons/avatar.jpg")
,	"books"		=> array("Books", "A community of book enthusiasts, discussing books of all kinds.", "/assets/images/comm-icons/books.jpg")
,	"fashion"	=> array("Fashion", "Discuss the latest trends, products, and fashion advice.", "/assets/images/comm-icons/fashion.jpg")
,	"fitness"	=> array("Fitness", "Discuss nutrition, workouts, strategies for fitness, and more!", "/assets/images/comm-icons/fitness.jpg")
,	"food"	=> array("Food", "Find new recipes and diets, and advance your cooking skills.", "/assets/images/comm-icons/food.jpg")
,	"gaming"	=> array("Gaming", "Find new games, reviews, guilds, strategies, and gaming news.", "/assets/images/comm-icons/gaming.jpg")
,	"humor"	=> array("Humor", "Share and discuss funny videos, pictures, jokes, and stories.", "/assets/images/comm-icons/humor.jpg")
,	"movies"	=> array("Movies", "Like movies? So does everyone here. Talk about your favorites.", "/assets/images/comm-icons/movies.jpg")
,	"music"		=> array("Music", "Love music? Find great music, reviews, and discuss albums.", "/assets/images/comm-icons/music.jpg")
,	"pets"	=> array("Pets", "Your pets deserve the best! Get pet advice, pet health, etc.", "/assets/images/comm-icons/pets.jpg")
,	"relationships"	=> array("Relationships", "Get relationship advice, improve your social skills, etc.", "/assets/images/comm-icons/relationships.jpg")
,	"travel"	=> array("Travel", "Planning a trip? Come here to get advice and find great spots.", "/assets/images/comm-icons/travel.jpg")
,	"shows"		=> array("Shows", "Find and discuss new shows, reviews, trivia, and best lists.", "/assets/images/comm-icons/shows.jpg")
);

foreach($community as $key => $val)
{
	echo '
	<div class="entry-row"><div class="entry-left"><a href="http://' . $key . '.unifaction.community"><img src="' . $val[2] . '"></a></div><div class="entry-right"><strong><a href="http://' . $key . '.unifaction.community">' . $val[0] . '</a></strong><br />' . $val[1] . '</div></div>';
}

echo '
<div style="clear:both;"></div>
<h3 style="margin-top:32px;">Information Communities</h3>';

$community = array(
	"news"	=> array("News", "Business, politics, new tech, and the current events of the world.", "/assets/images/comm-icons/news.jpg")
,	"politics"	=> array("Politics", "Debate and discuss politics and its impact on the world.", "/assets/images/comm-icons/politics.jpg")
,	"science"		=> array("Science", "All of the science news and discussion you can handle.", "/assets/images/comm-icons/science.jpg")
,	"tech"		=> array("Tech", "Gadgets, phones, software help, career advice, and more tech.", "/assets/images/comm-icons/tech.jpg")
);

foreach($community as $key => $val)
{
	echo '
	<div class="entry-row"><div class="entry-left"><a href="http://' . $key . '.unifaction.community"><img src="' . $val[2] . '"></a></div><div class="entry-right"><strong><a href="http://' . $key . '.unifaction.community">' . $val[0] . '</a></strong><br />' . $val[1] . '</div></div>';
}

echo '
<div id="sports-communities" style="clear:both;"></div>
<h3 style="margin-top:32px;">Sports Communities</h3>';

$community = array(
	"mlb"		=> array("MLB", "Baseball fans to discuss MLB teams, players, stats, and more!", "/assets/images/comm-icons/mlb.jpg")
,	"nba"	=> array("NBA", "The season's best players, surprise teams, highlights, and more!", "/assets/images/comm-icons/nba.jpg")
,	"ncaaf"	=> array("NCAAF", "The best teams, the Heisman race, the new NCAAF Playoff and more!", "/assets/images/comm-icons/ncaaf.jpg")
,	"ncaam"	=> array("NCAAM", "Discuss top teams, top conferences and March Madness hopes!", "/assets/images/comm-icons/ncaam.jpg")
,	"nfl"	=> array("NFL", "The best fan-to-fan info and discussions for America's game!", "/assets/images/comm-icons/nfl.jpg")
,	"nhl"	=> array("NHL", "Need fewer teeth and more ice-time? This community is for you!", "/assets/images/comm-icons/nhl.jpg")
);

foreach($community as $key => $val)
{
	echo '
	<div class="entry-row"><div class="entry-left"><a href="http://' . $key . '.unifaction.community"><img src="' . $val[2] . '"></a></div><div class="entry-right"><strong><a href="http://' . $key . '.unifaction.community">' . $val[0] . '</a></strong><br />' . $val[1] . '</div></div>';
}


echo '
<div style="clear:both;"></div>
<h3 style="margin-top:32px;">Content Communities</h3>';

$community = array(
	"art"		=> array("Art", "Join up with artists and designers to discuss arts and crafts.", "/assets/images/comm-icons/art.jpg")
,	"programming"	=> array("Programming", "Share tips, get help, and advance your development skills.", "/assets/images/comm-icons/programming.jpg")
,	"webdev"	=> array("Web Development", "Discuss tips, advice, and strategies with other web developers.", "/assets/images/comm-icons/webdev.jpg")
,	"writers"	=> array("Writing", "Share your writing with other writers, get feedback, and more!", "/assets/images/comm-icons/writers.jpg")
);

foreach($community as $key => $val)
{
	echo '
	<div class="entry-row"><div class="entry-left"><a href="http://' . $key . '.unifaction.community"><img src="' . $val[2] . '"></a></div><div class="entry-right"><strong><a href="http://' . $key . '.unifaction.community">' . $val[0] . '</a></strong><br />' . $val[1] . '</div></div>';
}

echo '
<div style="clear:both;"></div>
<h3 style="margin-top:32px;">DIY Communities</h3>';

$community = array(
	"diyauto"		=> array("DIY: Auto", "How-to's, advice, and discussion on auto repair and maintenance.", "/assets/images/comm-icons/diyauto.jpg")
,	"diyhome"	=> array("DIY: Home Improvement", "How-to's, advice, and discussion on home improvement projects.", "/assets/images/comm-icons/diyhome.jpg")
,	"intdesign"	=> array("Interior Design", "Discuss and get advice on interior design, and find DIY projects.", "/assets/images/comm-icons/intdesign.jpg")
);

foreach($community as $key => $val)
{
	echo '
	<div class="entry-row"><div class="entry-left"><a href="http://' . $key . '.unifaction.community"><img src="' . $val[2] . '"></a></div><div class="entry-right"><strong><a href="http://' . $key . '.unifaction.community">' . $val[0] . '</a></strong><br />' . $val[1] . '</div></div>';
}

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
