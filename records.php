<?php
    include('connectDb.php');

    //criar o form que permite o usuário a difitar os valores a serem alterados
    function renderForm($first = "", $last = "", $error = "", $id = "")
    {?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>
                <?php 
                    //Se o $id NÃO for vazio significa que o usuario quer editar um ID existente
                    if($id != '')
                    {
                        echo "Edit Record";
                    }
                    //Se o $id NÃO for vazio significa que o usuario quer editar um ID existent
                    else
                    {
                        echo "New Record";
                    }
                ?>
            </title>
        </head>
        <body>
            <h1>
            <?php 
                if($id != '')
                {
                    echo "Edit Record";
                }
                else
                {
                    echo "New Record";
                }
            ?>
            </h1>

            <?php 
                if($error != '')
                {
                    echo "<div style='padding:4px; border:1px solid red; color: red'>".$error."</div>";
                    echo "<br>";
                }
            ?>
            <!-- Criaros campos para alterar ou criar item de acordo com o id -->
            <form action="" method="POST">
                <div>

                <?php
                    if ($id != '')
                    {?>
                        <input type='hidden' name='id' value="<?php echo $id; ?>">
                        <p>ID: <?php echo $id; ?></p>
                    <?php }
                ?>

                <strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $first; ?>"/></br>
                <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $last; ?>"/>
                <p>* required</p>
                <input type="submit" name="submit" value="Submit"/>
                </div>
            </form>

        </body>
        </html>   
    
    <?php }   

    if(isset($_GET['id']))
    {
        if(isset($_POST['submit']))
        {
            if(is_numeric($_POST['id']))
            {
                $id = $_POST['id'];
                $firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
                $lastname = htmlentities($_POST['lastname'], ENT_QUOTES);

                 //verificar se o usuario digitou valores para firstname e lastname
                if($firstname == '' || $lastname == '')
                {
                    $error = 'Error: Please fill in all required fields!';
                    renderForm($firstname, $lastname, $error, $id);
                }
                else
                {
                    if($stmt = $mysqli->prepare("UPDATE players SET firstname = ?, lastname = ? WHERE id=?"))
                    {
                        $stmt->bind_param("ssi",$firstname, $lastname, $id);
                        $stmt->execute();
                        $stmt->close();
                    }
                    else
                    {
                        echo "Erro couldn't prepare SQL statement.";
                    }
                    header("Location: view.php");
                }
            }
            else
            {
                echo "Error!";
            }
        } 
        else
        {
            //editar um campo existente
        if(is_numeric($_GET['id']) && $_GET['id'] > 0)
        {
            //query db
            $id = $_GET['id'];

            if($stmt = $mysqli->prepare("SELECT * FROM players WHERE id=?"))
            {
                $stmt->bind_param("i",$id);
                $stmt->execute();

                $stmt->bind_result($id, $firstname, $lastname);
                $stmt->fetch();

                renderForm($firstname, $lastname, NULL, $id);

                $stmt->close();
                
            }
            else
            {
                echo "Error: could not prepare SQL statement.";
            }
        }
        else
        {
            header("Location: view.php");
        }
        }  
        
    }
    else
    {
        //criar um campo novo
        if(isset($_POST['submit']))
        {
            $firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
            $lastname = htmlentities($_POST['lastname'], ENT_QUOTES);

            //verificar se o usuario digitou valores para firstname e lastname
            if ($firstname == '' || $lastname == '')
            {
                $error = 'Error: Please fill in all required fields!';
                renderForm($firstname, $lastname, $error);
            }
            else
            {
                if($stmt = $mysqli->prepare("INSERT players (firstname, lastname) VALUES (?,?)"))
                {
                    $stmt->bind_param("ss", $firstname, $lastname);
                    $stmt->execute();
                    $stmt->close();
                }
                else
                {
                    echo "ERROR: Could not prepare SQL statement.";
                }
                header("Location: view.php");
            }
        }
        else
        {
            renderForm();
        }        
    }
    $mysqli->close();
?>