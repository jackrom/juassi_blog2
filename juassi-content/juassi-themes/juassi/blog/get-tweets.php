<?php
session_start();
require_once 'twitteroauth-master/twitteroauth/twitteroauth.php'; //Path to twitteroauth library
 
$twitteruser = "jcarlosreyesc";
$notweets = 30;
$consumerkey = "hQhJW2NKOrS9xqAGRpUXQ";
$consumersecret = "wl2jddaWUW8w7qxOQn7yu8egHJmReXExVGzs5WfCDIU";
$accesstoken = "371171362-3IpdpA5z5hVoDbBtdb5aUepMpbMvunLoZH2n9rCG";
$accesstokensecret = "KAGR4A0SOjfdZtxclXONh7qo8wPXol8b6ZgcKXkzs";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
 
echo json_encode($tweets);
?>