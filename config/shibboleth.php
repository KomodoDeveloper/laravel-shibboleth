<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Views / Endpoints
    |--------------------------------------------------------------------------
    |
    | Set your login page, or login routes, here. If you provide a view,
    | that will be rendered. Otherwise, it will redirect to a route.
    |
 */

    'idp_login' => '/Shibboleth.sso/Login',
    'idp_logout' => '/Shibboleth.sso/Logout',
    'authenticated' => '/',


    /*
    |--------------------------------------------------------------------------
    | Emulate an IdP
    |--------------------------------------------------------------------------
    |
    | In case you do not have access to your Shibboleth environment on
    | homestead or your own Vagrant box, you can emulate a Shibboleth
    | environment with the help of Shibalike.
    |
    | The password is the same as the username.
    |
    | Do not use this in production for literally any reason.
    |
     */

    'emulate_idp' => env('EMULATE_IDP', false),
    'emulate_idp_users' => [
        'admin' => [
            'cn' => 'Admin User',
            'mail' => 'admin@clemson.edu',
            'givenName' => 'Admin',
            'sn' => 'User',
            'emplId' => 'admin',
        ],
        'staff' => [
            'cn' => 'Staff User',
            'mail' => 'staff@clemson.edu',
            'givenName' => 'Staff',
            'sn' => 'User',
            'emplId' => 'staff',
        ],
        'user' => [
            'cn' => 'User User',
            'mail' => 'user@clemson.edu',
            'givenName' => 'User',
            'sn' => 'User',
            'emplId' => 'user',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Server Variable Mapping
    |--------------------------------------------------------------------------
    |
    | Change these to the proper values for your IdP.
    |
     */

    'entitlement' => 'edirgroup',

    'user' => [
        // fillable user model attribute => server variable
        'name' => 'cn',
        'first_name' => 'givenName',
        'last_name' => 'sn',
        'email' => 'mail',
        'emplid' => 'clemsonXID',
    ],

    //The user model field (from the user array above) that should be used for authentication
    'user_authentication_field' => 'email',

    /*
    |--------------------------------------------------------------------------
    | User Creation and Update Settings
    |--------------------------------------------------------------------------
    |
    | Allows you to change if / how new users are added
    |
     */

    'add_new_users' => true, // Should new users be added automatically if they do not exist?
    'update_users' => true, //should users be updated with data from the idp when they log in?

    /*
    |--------------------------------------------------------------------------
    | JWT Auth
    |--------------------------------------------------------------------------
    |
    | JWTs are for the front end to know it's logged in
    |
    | https://github.com/tymondesigns/jwt-auth
    | https://github.com/StudentAffairsUWM/Laravel-Shibboleth-Service-Provider/issues/24
    |
     */

    'jwtauth' => env('JWTAUTH', false),
];
