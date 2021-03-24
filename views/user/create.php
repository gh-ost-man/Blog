<?php 
    $data;
    if(isset($_GET['id'])){
        $data = json_decode($_SESSION['user'],true);
    }
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 m-0">
                    <div class="card w-100" >
                        <img src="<?= (isset($_GET['id']))? "/" . $data['url_avatar'] : $data['url_avatar'] ?>" id="foto" class="card-img-top text-center" alt="Not Found">
                        <hr>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="avatar">
                                    <label class="custom-file-label" for="inputGroupFile02" >Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 m-0">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" required placeholder="email@gmail.com" aria-describedby="emailHelp" value="<?=$model->email?>" name="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nick</label>
                        <input class="form-control" type="text" placeholder="John" required value="<?=$model->nick?>" name="nick">
                    </div>
                
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" value="<?=$model->password?>" required name="password">
                    </div>
                    <button type="submit" class="btn btn-success">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $('#file').change(function(){
      var file = document.getElementById('file').files;
      if(file.length == 0) document.getElementById('foto').setAttribute("src", "/avatar/notAvatar.png");
      
      if(file.length > 0){
        var file_reader = new FileReader();
        file_reader.onload = function(){
          document.getElementById('foto').setAttribute("src", event.target.result);
        };
        file_reader.readAsDataURL(file[0]);
      }
    });
</script>