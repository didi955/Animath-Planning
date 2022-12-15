<!-- TABLEAU UTILISATEURS  -->
<div class="table-responsive">
    <table class="table table-md caption-top table-striped table-bordered p-5 m-3">
        <caption>Liste des utilisateurs</caption>
        <thead>
        <tr>
            <th>UUID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Téléphone</th>
            <th>Role</th>
            <th>Active</th>
            <th>Crée le</th>
        </thead>
        <tbody>
        <?php foreach($users as $user):
            $obj = UserModel::getModel()->buildUser($user);
            ?>
            <tr>
                <td><?=e($obj->getUUID());?></td>
                <td><?=e($obj->getLastName());?></td>
                <td><?=e($obj->getFirstName());?></td>
                <td><?=e($obj->getEmail());?></td>
                <td><?=e($obj->getPhone());?></td>
                <td><?=e($obj->getRole()->name);?></td>
                <td><?=e(($obj->isActive() ? 'Oui' : 'Non'));?></td>
                <td><?=e($obj->getCreatedAt());?></td>
                <td>
                    <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
                    <button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<br>