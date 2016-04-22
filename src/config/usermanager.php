<?php
	return [
        "message" => "Welcome! Nice to know that your using the Users Manager package made by Gertjan Roke",
        
        /**
         * Multiple roles per user
         */
        'multiple' => false,
        /**
         * Prefix your url (The route would look something like this 'cms/users')
         *
         * @note add a '/' at the end of the prefix
         */
        'prefix' => 'cms/',
        /**
         * Add all the roles that have access to the users table and role table
         */
        'middleware' => ['auth', 'onlyAdmin'],
	];
