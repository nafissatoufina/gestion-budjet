<?php require_once 'process.php'; ?>
<?php $con = new mysqli("localhost","root","","budget"); ?>
<?php  if(isset($_SESSION['message'])): ?>


<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">


</head>
<body>
  <nav>
  <div class="profile">
                    <img src="nafi.jpg" alt="profile photo" />
                    <h1>Nafissatou Ndiaye</h1>
                </div>
  
  </nav>
    <nav class="navbar navbar-dark bg-primary text-center">
    <span class="navbar-brand mb-0 h1 text-center">Système de gestion budgétaire</span>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-center">Ajouter une dépense</h2>
                <hr><br>
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="budgetTitle">Intitulé budgétaire</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="budget" class="form-control" id="budgetTitle" placeholder="Entrez le titre du budget" required autocomplete="off"  value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="
Entrer le montant" required  value="<?php echo $amount; ?>">
                    </div>
                    <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Modifier</button>
                    <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary btn-block">Enregistrer</button>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-md-8">
                <h2 class="text-center">Total Expenses : <?php echo $total;?>fcfa </h2>
                <hr>
                <br><br>

                <?php 

                    if(isset($_SESSION['massage'])){
                        echo    "<div class='alert alert-{$_SESSION['msg_type']} alert-dismissible fade show ' role='alert'>
                                    <strong> {$_SESSION['massage']} </storng>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                ";
                    }

                ?>
                <h2>Liste des dépenses</h2>

                <?php 
                    
                    $result = mysqli_query($con, "SELECT * FROM budget");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom du budget</th>
                                <th>Montant budgétaire</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td> $<?php echo $row['amount']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">Modifier</a>
                                    <a href="process.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                            

                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>