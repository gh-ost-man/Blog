<style>
    body
    {
        background:white !important;
    }
</style>

<div class="row mt-5">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <p class="text-center" style="font-size:30px">SIGN IN TO BLOG </p>
        <form class="text-dark" action="" method="POST">
            <div class="form-group">
                <label class="text-dark" for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$model->email?>" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label class="text-dark"  for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" value="<?=$model->password?>" name="password">
            </div>
            <button type="submit" class="btn btn-outline-success">SIGN IN</button>
        </form>
    </div>
    <div class="col-lg-3"></div>
</div>