<!-- Page Content -->
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            แก้ไขข้อมูลรถ</div>
          <div class="card-body">
              <form id="editFrm" action="<?php echo base_url('api/car/edit')?>">
                <div class="form-group">
                  <label for="plate">ทะเบียน</label>
                  <input type="text" name="plate" class="form-control" id="plate" value="<?php echo $car['plate']?>">
                </div>
                <div class="form-group">
                  <label for="brand">ยี่ห้อ</label>
                  <input type="text" name="brand" class="form-control" id="brand"value="<?php echo $car['brand']?>">
                </div>
                <div class="form-group">
                  <label for="model">รุ่น</label>
                  <input type="text" name="model" class="form-control" id="model"value="<?php echo $car['model']?>">
                </div>

                <div class="form-group">
                  <label for="body_number">เลขตัวถัง</label>
                  <input type="text" name="body_number" class="form-control" id="body_number" value="<?php echo $car['body_number']?>">
                </div>
                <div class="form-group">
                  <label for="year">ปี</label>
                  <input type="text" name="year" class="form-control" id="year" value="<?php echo $car['year']?>">
                </div>
                <div class="form-group">
                  <label for="cc">ซีซี</label>
                  <input type="text" name="cc" class="form-control" id="cc" value="<?php echo $car['cc']?>">
                </div>
                <div class="form-group">
                  <label for="color">สี</label>
                  <input type="text" name="color" class="form-control" id="color" value="<?php echo $car['color']?>">
                </div>
                <input type="hidden" name="act" value="edit">
                <input type="hidden" name="id" value="<?php echo $car['id']?>">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
              </form>
          </div>
        </div>
        <script type="text/javascript">
        $("#editFrm").submit(function(e) {
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
