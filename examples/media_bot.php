<?php

    include_once 'Mastodon.php';

    $token = 'XXXXX'; // Token of your Mastodon welcome bot account
    $base_url = 'https://botsin.space'; // URL of your instance (Do not include '/' at the end.)
    $visibility = 'private'; // "Direct" means sending welcome message as a private message. The four tiers of visibility for toots are Public , Unlisted, Private, and Direct (default)
    $language = 'en'; // en for English, zh for Chinese, etc.

    $mastodon = new MastodonAPI($token, $base_url);

    $curl_file = curl_file_create('./imageOnServer.jpg', 'image/jpg', 'imagename.jpg');
    $body = [
        'file' => $curl_file,
    ];

    $response = $mastodon->uploadMedia($body);

    $file_id = $response->id;

    $statusText = 'This is a status';

    $status_data = [
        'status'      => $statusText,
        'visibility'  => $visibility,
        'language'    => $language,
        'media_ids[]' => $file_id,
    ];

    $mastodon->postStatus($status_data);
