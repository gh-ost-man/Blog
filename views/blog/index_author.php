<div class="container">
    <div class="row">
        <div class="col-md-2"></div>

        <?php if(!isset($records) || count($records) == 0) { ?>
            <div class="col-md-8">
                <div style="margin: 0 auto; width: 50vw; heigth: 50vh;">
                    <img src="/avatar/blog_1.jpg" style="width: 100%; heigth: 100%;"  alt="">
                </div>
            </div>
        <?php } else {  ?>
            <div class="col-md-8">
                <?php  foreach($records as $key => $value) : 
                $date = new DateTime($value->date); ?>    
                <div class="jumbotron mt-5 block">
                    <p>Date:  <ins id="date-<?= $value->id ?>"><?= (new DateTime($value->date))->format('Y-m-d'); ?><ins> </p>
                    <p>Status: <ins id="status-<?= $value->id ?>"><?=$value->status ?><ins> </p>
                    <hr class="my-4">
                    <p class="text-justify"><?= $value->text?></p>
                    <div class="row">
                        <div class="col-md-6 ">
                            <button id="like-<?= $value->id ?>" disabled class="btn btn-lg like" role="button" value="<?= $value->id ?>">
                                <i class="fas fa-thumbs-up"></i>    
                                <span><?= $value->like ?></span>
                            </button>
                            <button id="dis_like-<?= $value->id ?>" disabled class="btn btn-lg dis_like" role="button" value="<?= $value->id ?>">
                                <i class="fas fa-thumbs-down"></i>
                                <span><?= $value->dis_like ?></span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <p class="d-block float-right">Comments: <span id="commets-<?= $value->id ?>"><?= $qty_comments[$value->id] ?></span></p>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-grad  float-right m-1"  href="/blog/authorItem?id=<?= $value->id ?>" role="button">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            View
                        </a>
                        <?php if ($value->status == 'delete') { ?>
                        <button id="update-<?= $value->id ?>" value="<?= $value->id ?>" class="btn btn-grad  float-right m-1 update" role="button">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Update
                        </button>
                        <?php } ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        <?php } ?>

        <div class="col-md-2"></div>
    </div>
</div>