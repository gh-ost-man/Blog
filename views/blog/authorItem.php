<?php 
    if(isset($_SESSION['user'])) $user = json_decode($_SESSION['user'], true);
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php $date = new DateTime($record->date); ?>    
        <div class="jumbotron mt-5 block">
            <p>Date:  <ins><?= $date->format('Y-m-d'); ?><ins> </p>
            <p>Status: <ins><?= $record->status ?><ins> </p>
            <hr class="my-4">
            <p class="text-justify"><?= $record->text?></p>
            <div class="row ">
                <div class="col-md-6">
                    <button id="like-<?= $record->id ?>" disabled class="btn btn-lg text-white like" role="button" value="<?= $record->id ?>">
                        <i class="fas fa-thumbs-up"></i>    
                        <span><?= $record->like ?></span>
                    </button>
                    <button id="dis_like-<?= $record->id ?>" disabled class="btn btn-lg text-white dis_like" role="button" value="<?= $record->id ?>">
                        <i class="fas fa-thumbs-down"></i>
                        <span><?= $record->dis_like ?></span>
                    </button>
                </div>
                <div class="col-md-6">
                    <?php if ($record->status == 'not approved') : ?>
                    <a class="btn btn-primary float-right mb-5" href="/blog/edit?id=<?= $record->id ?>" role="button">Edit</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="jumbotron block">
        <p>COMMENTS: <span><?= count($comments) ?></span></p>
        <?php foreach($comments as $key => $value) : 
                $date = new DateTime($value->date); ?>    
                <p>Date:  <ins><?= $date->format('Y-m-d'); ?><ins> </p>
                <p>Status: <ins><?= $value->status ?><ins> </p>
                <hr class="my-4">
                <p class="text-justify"><?= $value->text?></p>
                <div class="row">
                    <div class="col-md-6">
                        <button id="comment_like-<?= $value->id ?>" disabled class="btn btn-lg text-white comment_like" role="button" value="<?= $value->id ?>">
                            <i class="fas fa-thumbs-up"></i>    
                            <span><?= $value->like ?></span>
                        </button>
                        <button id="comment_dis_like-<?= $value->id ?>" disabled class="btn btn-lg text-white comment_dis_like" role="button" value="<?= $value->id ?>">
                            <i class="fas fa-thumbs-down"></i>
                            <span><?= $value->dis_like ?></span>
                        </button>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            <hr class="hr-color">
        <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>