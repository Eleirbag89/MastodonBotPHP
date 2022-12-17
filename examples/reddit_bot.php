<?php

    include_once 'Mastodon.php';

    $token = 'XXXXX'; // Token of your Mastodon bot account
    $base_url = 'https://botsin.space'; // URL of your instance (Do not include '/' at the end.)
    $visibility = 'private'; // "Direct" means sending welcome message as a private message. The four tiers of visibility for toots are Public , Unlisted, Private, and Direct (default)
    $language = 'en'; // en for English, zh for Chinese, etc.
    $feed_url = 'https://www.reddit.com/r/Subreddit.json'; // the subreddit url ending in *.json
    $file = 'dataSubreddit.txt';
    $tagline = ' check out on ';

    if (!($jsonTxt = file_get_contents($feed_url))) {
        exit('Error loading the feed url');
    }

    $json = json_decode($jsonTxt, true);
    $first_article = false;

    $lastDate = '';

    if ($f = fopen($file, 'r')) {
        $lastDate = fgets($f);
        fclose($f);
    }

    $statuses = [];

    foreach ($json['data']['children'] as $item) {
        $itemData = $item['data'];
        $ts = $itemData['created_utc'];
        if (($lastDate == '' || $ts > $lastDate) && !$itemData['is_self']) {
            $post = new BlogPost();
            $post->link = $itemData['url'];
            $post->title = $itemData['title'];
            $post->category = $itemData['subreddit'];
            $post->nsfw = $itemData['over_18'];

            array_push($statuses, $post);
            if (!$first_article) {
                $myfile = fopen($file, 'w') or exit('Unable to open file!');
                fwrite($myfile, $ts);
                fclose($myfile);
                $first_article = true;
            }
        }
    }

    $statuses = array_reverse($statuses);
    $mastodon = new MastodonAPI($token, $base_url);

    foreach ($statuses as $s) {
        $status_data = [
            'visibility' => $visibility,
            'language'   => $language,
        ];

        $statusText = $s->title.$tagline.$s->link.' ';

        if ($s->nsfw) {
            $status_data['status'] = 'NSFW';
            $status_data['spoiler_text'] = $statusText;
        } else {
            $status_data['status'] = $statusText;
        }

        $mastodon->postStatus($status_data);
    }

    class BlogPost
    {
        public $ts;
        public $link;
        public $category;
        public $title;
        public $nsfw;
    }
