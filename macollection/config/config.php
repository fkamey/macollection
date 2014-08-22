<?php

// include our libraries
include '../lib/tmhOAuth.php';
include '../lib/TwitterApp.php';

// set the consumer key and secret
define('CONSUMER_KEY',      'uzacU5csSox7r6ajYVuR1FJZ9');
define('CONSUMER_SECRET',   'akRgDvL6J6XCVH9B5jFtST054e58afQumdNmnCpsmPm4JXwGDH');

// our tmhOAuth settings
$config = array(
    'consumer_key'      => CONSUMER_KEY,
    'consumer_secret'   => CONSUMER_SECRET
);