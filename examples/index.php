<?php

require_once '../vendor/autoload.php';

$datarole = new DataRole\API\Client(
    [
        'account' => '__ACCOUNT__',
        'secret'  => '__SECRET__',
        'version' => 'v2',
    ]
);

##
#   Data Preview of an Address
##
$datarole
    ->lookupAddress('776+Buena+Vista+Ave+Alameda+CA+94501')
    ->printPreview();