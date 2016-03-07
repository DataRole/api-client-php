<?php

require_once '../vendor/autoload.php';

$datarole = new DataRole\API\Client(
    [
        'authorization' => '<YOUR_API_KEY_HERE>',
        'instance'      => 'default',
        'version'       => 'v1',
    ]
);

##
#   Data Preview of a Single Permit
##
$datarole->permit(2013)->preview();

##
#   Data Preview of a Multiple Permits
##
//$datarole->permit(['Region' => 'CA_Concord'])->preview();



##
#   Data Preview of a Single Property
##
//$datarole->property(1524)->preview();

##
#   Data Preview of a Multiple Properties
##
//$datarole->property(['Region' => 'CA_Concord'])->preview();



##
#   Data Preview of a Single Professional
##
//$datarole->professional(1052)->preview();

##
#   Data Preview of a Multiple Professionals
##
//$datarole->professional(['Region' => 'CA_Concord'])->preview();