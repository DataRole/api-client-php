<?php

require_once '../vendor/autoload.php';

$datarole = new DataRole\API\Client(
    [
        'authorization' => '__INSERT_API_KEY_HERE__',
        'instance'      => 'default',
        'version'       => 'v1',
    ]
);

##
#   Data Preview of a Single Permit
##
$datarole->permit(2013)->preview();


##
#   Data Preview of a Single Property
##
//$datarole->property(1524)->preview();


##
#   Data Preview of a Single Professional
##
//$datarole->professional(1052)->preview();
