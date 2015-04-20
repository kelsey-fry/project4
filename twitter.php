<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "17488836-XJl0HIJFqsa3MLlo8Yaw6ZEpNgYOSXEQ8Lq445r96",
    'oauth_access_token_secret' => "kTR8Uh6nqGrTj0ykgjDacQvnvDLjlzv3qXcj2utmmpAo8",
    'consumer_key' => "KYmHreNAjXn9R0qEN8RPtArdF",
    'consumer_secret' => "7wdhgkvVNiladR4MQcIpvRk2AAmt8fq3Y7Pg8bJyHSbBn1Kt7r"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'GET';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response 
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();
 **/
/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23orphanblack';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
/**echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(); **/
			 
$tweetData = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(), $assoc=TRUE);
			 
// echo $tweetData;
?>

<?php


foreach($tweetData['statuses'] as $items)
{
	$userArray = $items['user'];
	
	echo "<a href='https://twitter.com/" . $userArray['screen_name'] . "' target='_blank'><img src='" . $userArray['profile_image_url'] . "'>	@" . $userArray['screen_name'] . "</a></br>";
	// echo "<img src='" . $userArray['profile_image_url'] . "'>	" . $userArray['screen_name'] . "</br>";
	// echo $items['statuses'];
	// echo $items['text'] . "</br>";
	// echo $items['created_at'] . "</br>";
	// echo $items['statuses'];
	echo "<a href='https://twitter.com/" . $userArray['screen_name'] . "/status/" . $items['id'] . "' target='_blank'></br>" . $items['text'] . " " . $items['created_at'] . "</br></a>";
	// echo $items['text'] . "</br>";
	// echo $items['created_at'] . "</br></a></div>";
	
	
		// foreach ($items['user'] as $users)
		// {
		// echo "by" . $users['name'] . "<br>";
		// }
}

?>
