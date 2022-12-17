<?php

include_once 'Mastodon.php';

$token = ''; // Token of your Mastodon bot account
$baseURL = 'https://botsin.space'; // URL of your instance (Do not include '/' at the end.)
$privacy = 'private'; // "Direct" means sending message as a private message. The four tiers of privacy for toots are public , unlisted, private, and direct
$language = 'en'; // en for English, zh for Chinese, de for German etc.
$statusText = 'This is a status';

$statusData = [
    'status'      => $statusText,
    'privacy'     => $privacy,
    'language'    => $language,
];

$mastodon = new MastodonAPI($token, $baseURL);
$result = $mastodon->postStatus($statusData);

// Activate the next line if you want to print the result of the query
//var_dump($result);
