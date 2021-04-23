<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP form</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <?php if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
        <div class="container">
        <?php 
            $mysqli = new mysqli('localhost', 'root', '', 'curso_php') or die(mysqli_error($mysqli));
            $consulta = $mysqli->query("SELECT * FROM clientes") or die($mysqli->error);
        ?>

        <div class="">
            <table class="table table-light table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <?php  while($row = $consulta->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nome']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['telefone']?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Editar</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </table>    
        </div>
        </div>
        <div class="container p-5">            
            <div class="row px-5">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3 form-group">
                        <label>Nome: </label>
                        <input type="text" class="form-control" required name="name" placeholder="Digite seu nome" value="<?php echo $nome ?>">
                    </div>
                    <div class="mb-3 form-group">
                        <label>Email: </label>
                        <input type="text" class="form-control" required name="email" placeholder="Digite seu email" value="<?php echo $email ?>">
                    </div>
                    <div class="mb-3 form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control" required name="telefone" placeholder="Digite seu telefone" value="<?php echo $telefone ?>">
                    </div>
                    <div class="mb-3 text-center">
                        <?php if ($update == true): ?>
                            <button type="submit" class="btn btn-info" name="update">Atualizar</button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary" name="save">Salvar</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </div>
</body>
</html> 