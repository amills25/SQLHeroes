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

//CREATE
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

//READ
function readAboutHeroes()
{
    $sql = "SELECT name, about_me FROM heroes";

    global $conn;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['id'] . "Name: " . $row['name'] . ". <br/>About Me: " . $row['about_me'] . "<br/><br/>";
        }
    } else {
        echo "Error: " . $sql . "<br/>" . $conn->error;
    }
}

function readAllHeroes()
{
    //output heroes from the array

}

//UPDATE
function updateHero($id, $tagline)
{
    $sql = "UPDATE heroes SET tagline='$tagline' WHERE id=$id";

    global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

//DELETE
function deleteHero($id)
{
    $sql = "DELETE FROM heroes WHERE id='$id'";

    global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "Record id:$id deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
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
            deleteHero($_GET['id']);
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
