<?php

function users()
{
    return 'ian, troy, chase';
}

function greeting($name)
{
    return 'Hello ' . $_GET['name'];
}

if (isset($_GET['route'])) {
    switch ($_GET['route']) {
        case 'users':
            echo users();
            break;
        case 'greeting':
            if (isset($_GET['name'])) {
                echo greeting($_GET['name']);
            } else {
                echo 'error 422, unprocessable entity, expecting name';
            }
            break;
        default:
            echo 'error 404, route not found';
            break;
    }
} else {
    echo 'welcome to the main page';
}
