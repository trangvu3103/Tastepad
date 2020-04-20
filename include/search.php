<?php 
$search = $_GET['search']
var_dump($search);

// Create connection
$DBConn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($DBConn->connect_error) {
    die("Connection failed: " . $DBConn->connect_error);
}


//sql line: search for recipe
$sql = "SELECT * FROM recipes r, users u where r.userID = u.userID and r.recipeName like '%$search%' or u.userName like '%$search%'";

//get query result for sql above
$result = $DBConn->query($sql);

//sql line: search for ingredients
$sql = "SELECT * FROM ingredients where ingredientNameAndAmoount like '%$search%'";

//get query result for sql above
$result = $DBConn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo `hello`;
    }
} else {
    echo "0 results";
}

$conn->close();

 ?>