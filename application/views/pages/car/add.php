<!-- Page Content -->
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            เพิ่มข้อมูลรถ</div>
          <div class="card-body">
              <form id="addFrm" action="<?php echo base_url('api/car/add')?>">
                <div class="form-group">
                  <label for="plate">ทะเบียน</label>
                  <input type="text" name="plate" class="form-control" id="plate">
                </div>
                <div class="form-group">
                  <label for="brand">ยี่ห้อ</label>
                  <input type="text" name="brand" class="form-control" id="brand">
                </div>
                <div class="form-group">
                  <label for="model">รุ่น</label>
                  <input type="text" name="model" class="form-control" id="model">
                </div>

                <div class="form-group">
                  <label for="body_number">เลขตัวถัง</label>
                  <input type="text" name="body_number" class="form-control" id="body_number">
                </div>
                <div class="form-group">
                  <label for="year">ปี</label>
                  <input type="text" name="year" class="form-control" id="year">
                </div>
                <div class="form-group">
                  <label for="cc">ซีซี</label>
                  <input type="text" name="cc" class="form-control" id="cc">
                </div>
                <div class="form-group">
                  <label for="color">สี</label>
                  <input type="text" name="color" class="form-control" id="color">
                </div>
                <input type="hidden" name="act" value="add">
                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
              </form>
          </div>
        </div>
        <script type="text/javascript">
        $("#addFrm").submit(function(e) {
            showLoading();
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                dataType:'json',
                success: function(res)
                {
                    if(res.code == 0){
                        window.location.href="<?php echo base_url('cars')?>";
                    }else{
                        hideLoading();
                        swal({
                            type: 'error',
                            title: 'ผิดพลาด !!!',
                            text: res.msg,
                        });
                    }
                },
                error:function(e){
                    hideLoading();
                    console.log(e);
                }
            });
        });
        </script>
