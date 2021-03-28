<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <?php if(!isset($model) || count($model) == 0 ) { ?>
            <div class="col-md-8">
                <div style="margin: 0 auto; width: 50vw; heigth: 50vh;">
                    <img src="/avatar/blog_1.jpg" style="width: 100%; heigth: 100%;"  alt="">
                </div>
            </div>
        <?php } else { ?>
                <div class="col-md-8">
                    <?php  foreach($model as $key => $value) : 
                    $date = new DateTime($value->date); ?>    
                    <div class="jumbotron mt-5 block">
                        <p>Autor: <ins><?= $authorNicks[$value->id] ?><ins> </p>
                        <p>Date:  <ins><?= $date->format('Y-m-d'); ?><ins> </p>
                        <hr class="my-4">
                        <p class="text-justify"><?= $value->text?></p>
                        <div class="row">
                            <div class="col-6">
                                <button id="like-<?= $value->id ?>" class="btn btn-lg text-white like" role="button" value="<?= $value->id ?>">
                                    <i class="fas fa-thumbs-up"></i>    
                                    <span><?= $value->like ?></span>
                                </button>
                                <button id="dis_like-<?= $value->id ?>" class="btn btn-lg text-white dis_like" role="button" value="<?= $value->id ?>">
                                    <i class="fas fa-thumbs-down"></i>
                                    <span><?= $value->dis_like ?></span>
                                </button>
                            </div>
                            <div class="col-6">
                                <p class="d-block p-0 m-0 float-right">Comments: <span><?= $qty_comments[$value->id]?></span></p>
                            </div>
                            <div class ="col-12">
                            <a class="btn btn-grad btn-lg float-right" enabled href="/blog/item?id=<?= $value->id ?>" role="button">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                View
                            </a>
                        </div>
                        </div>
                    
                    </div>
                    <?php endforeach ?>
                </div>
        <?php } ?>
        <div class="col-md-2"></div>
    </div>
</div>