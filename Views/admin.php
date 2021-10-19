<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Mes Annonces</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Acceuil du site</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/admin">Acceuil l'admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/annonces">Liste des Annonces</a>
        </li>
       
        
      </ul>

      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <?php
          if (isset($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) : ?>
              <li class="nav-item">
              <a class="nav-link" href="/users/profile">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/users/logout">Déonnexion</a>
            </li>
          <?php else : ?>
              <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="/users/login">Connexion</a>
            </li>
          <?php endif; ?>
        
        
        
       
        
      </ul>
      
    </div>
  </div>
</nav>


<div class="container">

    <?php echo $contenu; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>