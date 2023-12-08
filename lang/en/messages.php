<?php

declare(strict_types=1);

return [
    'user' => [
        'login' => [
            'email_does_not_exist' => 'User with this email does not exists',
            'incorrect_password' => 'Password is incorrect',
            'success' => 'You successfully logged in',
        ]
    ],

    'album'  => [
        'validation' => [
            'title' => 'Title',
            'artist' => 'Artist',
            'description' => 'Description',
            'cover_url' => 'Cover URL',
            'use_autocompletion' => 'Use autocompletion'
        ]
    ],

    'music_library_service' => [
        'errors' => [
            'album_name_does_not_exist' => 'Album title does not match any albums in last.fm library',
            'artist_does_not_exist' => 'Artist name does not match any artist in last.fm library',
            'cover_url_does_not_match' => 'Cover URL sent by user does not match with image in last.fm library',
            'combination_does_not_exist' => 'Combination of album and artist you filled does not exist',
        ]
    ]
];
