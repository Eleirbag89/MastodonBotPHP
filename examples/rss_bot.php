<?php

    include_once 'Mastodon.php';

    $token = 'XXXXX'; // Token of your Mastodon welcome bot account
    $base_url = 'https://botsin.space'; // URL of your instance (Do not include '/' at the end.)
    $visibility = 'private'; // "Direct" means sending welcome message as a private message. The four tiers of visibility for toots are Public , Unlisted, Private, and Direct (default)
    $language = 'en'; // en for English, zh for Chinese, etc.
    $feed_url = 'https://wordpressblog.com/feed/';
    $file = 'data.txt';

    if (!($rss = simplexml_load_file($feed_url))) {
        exit('Error loading the feed url');
    }

    $first_article = false;

    $lastDate = '';

    if ($f = fopen($file, 'r')) {
        $lastDate = fgets($f);
        fclose($f);
    }

    $statuses = [];

    foreach ($rss->channel->item as $item) {
        $ts = strtotime($item->pubDate);
        if ($lastDate == '' || $ts > $lastDate) {
            $post = new BlogPost();
            $post->link = (string) $item->link;
            $post->title = (string) $item->title;

            $post->category = $item->category;

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
        $statusText = $s->title.' leggi su '.$s->link.' ';

        foreach ($s->category as $c) {
            $statusText = $statusText.'#'.formatHashTag($c).' ';
        }

        $status_data = [
            'status'     => $statusText,
            'visibility' => $visibility,
            'language'   => $language,
        ];

        $mastodon->postStatus($status_data);
    }

    function formatHashTag($category)
    {
        $filtered = str_replace('/', ' ', $category);
        $upper = ucwords($filtered);

        return str_replace(' ', '', $upper);
    }

    class BlogPost
    {
        public $ts;
        public $link;
        public $category;
        public $title;
    }
