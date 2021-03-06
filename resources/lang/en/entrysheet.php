<?php

return [

    /*
    |--------------------------------------------------------------------------
    | entrysheet.show.blade.php
    |--------------------------------------------------------------------------
    |
    */

    'context' => 'Entry Sheet',

    'grid_context' => 'Entry Sheet Grid',

    'report' =>[

        'title' => 'Entry Sheet Report',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'generate' => 'Generate'

    ],


    'head' => [

        'serial' => 'Serial No',
        'furnisher' => 'Furnisher',
        'date' => 'Date',
        'comment' => 'Comment'

    ],

    'datasheet' => [

        'item' => 'Item',
        'total_no_vat' => 'Total no VAT',
        'discount' => 'Discount (%)',
        'total' => 'Total',
        'vat' => 'Vat'
    ],

    'total' => [

        'total' => 'Total',
        'discount' => 'Discount',
        'grand' => 'Grand Total'
    ],

    'tooltip' => [

        'add' => 'Add Item'
    ],

    'submit' => 'Submit'



];