<!-- Page Content -->
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            แก้ไขข้อมูลงาน</div>
          <div class="card-body">
              <form id="editFrm" action="<?php echo base_url('api/work/edit')?>">
                <div class="form-group">
                  <label for="code">รหัสซ่อม</label>
                  <input type="text" name="code" class="form-control" id="code" value="<?php echo $work['code']?>">
                </div>
                <div class="form-group">
                  <label for="name">ชื่องาน</label>
                  <input type="text" name="name" class="form-control" id="name" value="<?php echo $work['name']?>">
                </div>

                <div class="form-group">
                  <label for="work_type_id">ประเภทงาน</label>
                  <select class="form-control" name="work_type_id" id="work_type_id">
                      <?php foreach ($work_type as $key => $value): ?>
                          <option <?php echo $value['id'] == $work['work_type_id']?'selected':'' ?> value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="car_type_id">ประเภทรถ</label>
                  <select class="form-control" name="car_type_id" id="car_type_id">
                      <?php foreach ($car_type as $key => $value): ?>
                          <option <?php echo $value['id'] == $work['car_type_id']?'selected':'' ?> value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cost">ราคาค่าแรง</label>
                  <input type="text" name="cost" class="form-control" id="cost" value="<?php echo $work['cost']?>">
                </div>
                <input type="hidden" name="act" value="edit">
                <input type="hidden" name="id" value="<?php echo $work['id']?>">
                <button type="submit" class="btn btn-primary">บัน่ทึกข้อมูล</button>
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
                        window.location.href="<?php echo base_url('works')?>";
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
