<h1> Liste des Annonces </h1>

<?php 
foreach($annonces as $annonce) : ?>
<Article>
    <h2><a href="annonces/lire/<?php echo $annonce->id; ?>"><?php echo $annonce->titre; ?></a></h2>
    <p><?php echo $annonce->description; ?></p>

</Article>
<?php endforeach; ?>