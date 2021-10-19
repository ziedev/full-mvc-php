<h1>Annonces</h1>

<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Actif</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($annonces as $annonce) : ?>

            <tr>

            <td><?php echo $annonce->id; ?></td>
            <td><?php echo $annonce->titre; ?></td>
            <td><?php echo $annonce->description; ?></td>

            <td>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault<?php echo $annonce->id; ?> " <?php if ( $annonce->actif) {echo 'checked';} ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault<?php echo $annonce->id; ?>"></label>
                </div>
            </td>
            <td>

                <a href="/annonces/modifier/<?php echo $annonce->id; ?>" class="btn btn-warning">Modifier</a>
                <a href="/admin/supprimeannonce/<?php echo $annonce->id; ?>" class="btn btn-danger">Supprimer</a>
            </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>