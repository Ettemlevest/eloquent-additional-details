<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table Names
    |--------------------------------------------------------------------------
    |
    | Table name configurations for ettemlevest/eloquent-additional-details.
    |
    */

    'table_names' => [

        /*
         * When using the "HasDetails" trait from this package, we need to know which
         * table should be used to retrieve possible details for Eloquent models.
         */
        'detail_definitions' => 'detail_definitions',

        /*
         * When using the "HasDetails" trait from this package, we need to know which
         * table should be used to retrive detail values for Eloquent models.
         */
        'details' => 'details',

    ],

];
