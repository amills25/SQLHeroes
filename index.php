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

    $hero_id = -1;
    global $conn;
    if ($conn->query($sql) === TRUE) {
        $hero_id = $conn->insert_id;
        echo "New hero created successfully. ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if (isset($request['ability_id'])) {
        $ability_id = $request['ability_id'];
        $sql2 = "INSERT INTO abilities (hero_id, ability_id) VALUES ('$hero_id', '$ability_id')";
    } else {
        echo 'ERROR 422: unprocessable entity, expecting biography.';
    }

    if ($conn->query($sql2) === TRUE) {
        echo "New ability also created successfully.";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
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
    $sql = "SELECT heroes.name, heroes.about_me, GROUP_CONCAT(ability_type.ability separator ', ') AS abilities
    FROM heroes
    INNER JOIN abilities ON abilities.hero_id = heroes.id  
    INNER JOIN ability_type ON ability_type.id = abilities.ability_id
    GROUP BY heroes.name";

    global $conn;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['id'] . "Name: " . $row['name'] . ". <br/>About Me: " . $row['about_me'] . "<br/>Abilities: " . json_encode($row['abilities']) . "<br/><br/>";
        }
    } else {
        echo "Error: " . $sql . "<br/>" . $conn->error;
    }
}

//UPDATE
function updateAbility($id, $ability_id)
{
    if (!isset($id)) {
        echo 'ERROR 422: unprocessable entity, expecting id.';
        return;
    }
    if (!isset($ability_id)) {
        echo 'ERROR 422: unprocessable entity, expecting ability id.';
        return;
    }

    $sql = "UPDATE abilities SET ability_id='$ability_id' WHERE id=$id";

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
        case 'readAll':
            readAllHeroes();
            break;
        case 'update':
            updateAbility($_GET['id'], $_GET['ability_id']);
            break;
        case 'delete':
            deleteHero($_GET['id']);
            break;
        default:
            echo 'ERROR 404: route not found.';
            break;
    }
} else {
    echo 'Welcome to Herodex!';
}

$conn->close();
