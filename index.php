<?php

namespace name\space;

use MockPDO;
use Model;
use ORM;

require 'vendor/autoload.php';
require 'mock-pdo.php';

class ShortTableName extends Model {
    public static $_table_use_short_name = true;
}

class LongTableName extends Model {
}

// Enable logging
ORM::configure('logging', true);

// Set up the dummy database connection
$db = new MockPDO('sqlite::memory:');
ORM::set_db($db);

\name\space\ShortTableName::find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

ShortTableName::find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

Model::factory('\\name\\space\\ShortTableName')->find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

// Invalid - there is no ShortTableName class. Namespace is required.
// Model::factory('ShortTableName')->find_many();

\name\space\LongTableName::find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

LongTableName::find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

Model::factory('\\name\\space\\LongTableName')->find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");


// Prefix
Model::$auto_prefix_models = '\\name\\space\\';

Model::factory('ShortTableName')->find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

Model::factory('LongTableName')->find_many();
fputs(STDOUT, ORM::get_last_query() . "\n");

// Invalid - looks for \name\space\name\space\User
// LongTableName::find_many();
