<?php $i = 1 ?>
<div class="row mt-3">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <table class="table  table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col">Text</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($records as $key => $value) : ?>
                <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?=  $authors[$value->id] ?></td>
                <td style="max-width:350px;"><?= $value->text ?></td>
                <td style="max-width:100px;"><?= (new DateTime($value->date ))->format("Y-m-d") ?></td>
                <td>
                    <div class="dropdown">
                        <button id="status-<?= $value->id ?>" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $value->status?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php foreach($statuses as $key_stastus => $status) : ?>   
                            <button id="status-sub-<?= $value->id ?>" class="dropdown-item status" value="<?= $value->id ?>"><?= $status ?></button>
                            <?php endforeach ?>   
                        </div>
                    </div>
                </td>
                <td>
                    <a id="delete-<?= $value->id ?>" href="/admin/deleteRecord?id=<?= $value->id ?>" <?= ($value->status == 'delete')? 'hidden': '' ?> class="btn btn-danger">Delete</a>
                </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-1"></div>
</div>