<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
</head>
<body>
    <h1>View Records</h1>
    <?php
    
        include('connectDb.php');
        $sql = "SELECT * FROM players ORDER BY id";
        $result = $mysqli->set_charset("utf8"); //This line was made so we can set accents correctly in all of the data (ex.: Aurélio)
        if($result = $mysqli->query($sql))
        {
            if($result->num_rows > 0)
            {
                echo "<table border='1' cellpadding='10'>";
                echo "<tr><th>ID</th><th>First name</th><th>Last Name</th></tr>";
                while ($row = $result->fetch_object())
                {
                    echo "<tr>";
                    echo "<td>".$row->id."</td>";
                    echo "<td>".$row->firstname."</td>";
                    echo "<td>".$row->lastname."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else
            {
                echo "No results to display!";
            }
        } else{ //if the query fails we get a msg error
            echo 'Error: '.$mysqli->error;
        };

        //cosing the connection
        $mysqli->close();
    
    ?>

    
</body>
</html>