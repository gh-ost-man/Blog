<?php $i = 1 ?>
<div class="row mt-3">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Avatar</th>
                <th scope="col">Nick</th>
                <th scope="col">@Email</th>
                <th scope="col">Role</th>
                <th scope="col">Confirm</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $key => $value) : ?>
                <tr>
                <th scope="row"><?= $i++ ?></th>
                <th scope="row">
                    <img src="/<?= $value->url_avatar ?>" class="rounded-circle " style="max-width: 50x; max-height: 50px;" alt="...">
                </th>
                <td id='nick-<?= $value->id ?>'><?= $value->nick ?></td>
                <td style="max-width:350px;"><?= $value->email ?></td>
                <td>
                    <div class="dropdown">
                        <button id="role-user-<?= $value->id ?>" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $value->role  ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php foreach($roles as $key_role => $role) : ?>   
                            <button class="dropdown-item role-user" value="<?= $value->id ?> "><?= $role ?></button>
                            <?php endforeach ?>   
                        </div>
                    </div>
                </td>
                <td style="max-width:100px;"><?= ($value->confirm == 0)? 'not confirmed' : 'confirmed' ?></td>
                <td>
                    <a id="delete-user-<?= $value->id ?>" href="/admin/deleteUser?id=<?= $value->id ?>" class="btn btn-danger">Delete</a>
                </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-1"></div>
</div>