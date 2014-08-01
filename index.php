<?php

namespace testing;

use MockPDO;
use Model;
use ORM;

require 'vendor/autoload.php';
require 'mock-pdo.php';

class User extends Model {
    public static $_table_use_short_name = true;
}

class Other extends Model {
}

// Enable logging
ORM::configure('logging', true);

// Set up the dummy database connection
$db = new MockPDO('sqlite::memory:');
ORM::set_db($db);

User::find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

Other::find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");
