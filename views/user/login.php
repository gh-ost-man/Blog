<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <form action="" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$model->email?>" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" value="<?=$model->password?>" name="password">
            </div>
            <button type="submit" class="btn btn-success">SIGN IN</button>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>