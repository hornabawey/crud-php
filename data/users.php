<?php

const USERS_URL = __DIR__ . "\users.json";
// ##################### createUser ###############################
function createUser($user)
{
    // get all users
    $all_users = file_get_contents(USERS_URL);
    $all_users = json_decode($all_users, true);

    // last user 
	$all_users[] = $user;
    $last_user = end($all_users);
    $last_user_id = $last_user['id'] ?? 0;

    // add id to user
    $user['id'] = $last_user_id + 1;

    // add new user to all users
    

    // save all data 
    $all_users = json_encode($all_users);
    file_put_contents(USERS_URL, $all_users);
}
// ##############################################################


// ##################### login function ###############################
function login($email, $password)
{
    // get all users
    $all_users = file_get_contents(USERS_URL);
    $all_users = json_decode($all_users, true);

    foreach ($all_users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            return true;
        }
    }

    return false;
}
// ##############################################################