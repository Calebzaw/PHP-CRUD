<?php
    
    session_start();

    $nome = '';
    $telefone = '';
    $email = '';
    $update = false;
    $id = 0;

    $mysqli = new mysqli('localhost', 'root', '', 'curso_php') or die(mysqli_error($mysqli));
    
    if (isset($_POST['save'])){
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $mysqli->query("INSERT INTO clientes (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')") or die($mysqli->error);

        $_SESSION['message'] = "Dados salvos com sucesso!";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");
    }

    if (isset($_GET['delete'])){
        $id = $_GET['delete'];

        $mysqli->query("DELETE FROM clientes WHERE id=$id") or die($mysqli->error);

        $_SESSION['message'] = "Dados deletados com sucesso!";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");
    }
    
    if (isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM clientes WHERE id=$id") or die($mysqli->error);
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $telefone = $row['telefone'];
        $email = $row['email'];

    }
    
    if (isset($_POST['update'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $mysqli->query("UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id") or die ($mysqli->error);
    
        $_SESSION['message'] = "Dados atualizados com sucesso!";
        $_SESSION['msg_type'] = "warning";
    
        header("location: index.php");
    }
    
    
    
    
    // try {
    //     $conn = new PDO('mysql:host=localhost;dbname=curso_php', 'root', '');
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   } catch(PDOException $e) {
    //       echo 'ERROR: ' . $e->getMessage();
    //   }
?>