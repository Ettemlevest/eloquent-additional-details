<?php

return [

    'table_names' => [

        /*
         * When using the "HasDetails" trait from this package, we need to know which
         * table should be used to retrieve possible details for Eloquent models.
         *
         */
        'detail_definition' => 'detail_defs',

        /*
         * When using the "HasDetails" trait from this package, we need to know which
         * table should be used to retrive detail values for Eloquent models.
         */
        'detail' => 'details',

    ],

];
