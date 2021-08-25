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
    <p><b>View all</b> | <a href='view-paginated.php'>View Paginated: </a></p>
    <?php
    
        include('connectDb.php');
        $sql = "SELECT * FROM players ORDER BY id";
        
        //corrige problemas de acentuação
        $result = $mysqli->set_charset("utf8"); 
        
        //verifica se o acesso ao DB foi bem sucedida
        if($result = $mysqli->query($sql))
        {
            //verifica se há dados na tabela
            if($result->num_rows > 0)
            {
                echo "<table border='1' cellpadding='10'>";
                echo "<tr><th>ID</th><th>First name</th><th>Last Name</th><th></th><th></th></tr>";
                while ($row = $result->fetch_object())
                {
                    echo "<tr>";
                    echo "<td>".$row->id."</td>";
                    echo "<td>".$row->firstname."</td>";
                    echo "<td>".$row->lastname."</td>";
                    echo "<td><a href='records.php?id=".$row->id."'>Edit</a></td>";
                    echo "<td><a href='delete.php?id=".$row->id."'>Delete</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } 
            //não há nada na tabela para ser exibido
            else 
            {
                echo "No results to display!";
            }
        } 
        //neste caso ocorreu erro, logo exibe o erro
        else
        { 
            echo 'Error: '.$mysqli->error;
        };

        //cosing the connection
        $mysqli->close();
    
    ?>
    <a href="records.php">Add New Record</a>
    
</body>
</html>