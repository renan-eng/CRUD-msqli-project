<?php

    include('connectDb.php');

    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $id = $_GET['id'];

        //Deletar o ID da DB
        if($stmt = $mysqli->prepare('DELETE FROM players WHERE id = ? LIMIT 1'))
        {
            //Binde id na função prepare() acima
            $stmt->bind_param('i',$id);
            //executa o que foi definido (deleta o ID do DB)
            $stmt->execute();
            //encerra conexão com o server
            $stmt->close();
        }
        else
        {
            echo "Error: could not prepare SQL statement.";
        }
        $mysqli->close();
        //retorna o usário para a pagina original após delete executado
        header("Location: view.php");        
    }
    else
    {
        header("Location: view.php");
    }

?>