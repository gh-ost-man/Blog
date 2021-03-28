<div class="row mt-5">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <form method="POST">
      <div class="form-group">
        <label class="text-white" for="exampleFormControlTextarea1" style="letter-spacing: 4px;">NEW RECORD</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" required rows="3" maxlength="1000" name="text" style="max-height: 300px; min-height:300px"><?= (isset($model))? $model->text: '' ?></textarea>
      </div>
      <button type="submit" class="btn btn-grad">
        <span></span>  
        <span></span>  
        <span></span>  
        <span></span>  
        SAVE
      </button>
    </form>
  </div>
  <div class="col-md-3"></div>
</div>