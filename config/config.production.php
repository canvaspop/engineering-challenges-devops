<?php
return array(
    'db.host'        => '',   //create an RDS instance, update this configuration to point to it
    'db.basename'    => 'workshopx-engineering-challenges',
    'db.port'        => 3306,
    'db.user'        => 'devops',
    'db.password'    => '',  //create an RDS user with the name devops and a password, update this configuration to point to it

    'asset.path'     => '',  //create a cloudfront distribution, sync the contents of the public/static folder to it, update this configuration to point to it

    'memcached.host' => '',  //create a memcached instance, update this configuration to point to it
    'memcached.port' => 11211

);
