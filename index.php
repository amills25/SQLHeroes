<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heroes_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//create
function createHero($request)
{
    if (!isset($request['name'])) {
        echo 'ERROR 422: unprocessable entity, expecting name.';
        return;
    }
    if (!isset($request['about_me'])) {
        echo 'ERROR 422: unprocessable entity, expecting about me.';
        return;
    }
    if (!isset($request['biography'])) {
        echo 'ERROR 422: unprocessable entity, expecting biography.';
        return;
    }

    $name = $request['name'];
    $about_me = $request['about_me'];
    $biography = $request['biography'];
    $sql = "INSERT INTO heroes (name, about_me, biography) VALUES ('$name', '$about_me', '$biography')";

    global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//read -- WHY IS THIS BROKEN
function readAboutHeroes()
{
    // $name = $request['name'];
    // $about_me = $request['about_me'];
    $sql = "SELECT name, about_me FROM heroes";
    // echo $sql;
    // $sql = 'SELECT * FROM heroes';

    global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "Read about heroes successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function readAllHeroes()
{
    //output heroes from the array

}

if (isset($_GET['route'])) {
    switch ($_GET['route']) {
        case 'create':
            createHero($_POST);
            break;
        case 'read':
            readAboutHeroes();
            break;
        case 'update':
            //users();
            break;
        case 'delete':
            //users();
            break;
        default:
            echo 'ERROR 404: route not found.';
            break;
    }
    // readAllHeroes();
} else {
    echo 'Welcome to Herodex!';
}

$conn->close();
