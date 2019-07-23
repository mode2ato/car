<!-- Page Content -->
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            เพิ่มข้อมูลงาน</div>
          <div class="card-body">
              <form id="addFrm" action="<?php echo base_url('api/work/add')?>">
                <div class="form-group">
                  <label for="code">รหัสซ่อม</label>
                  <input type="text" name="code" class="form-control" id="code">
                </div>
                <div class="form-group">
                  <label for="name">ชื่องาน</label>
                  <input type="text" name="name" class="form-control" id="name">
                </div>

                <div class="form-group">
                  <label for="work_type_id">ประเภทงาน</label>
                  <select class="form-control" name="work_type_id" id="work_type_id">
                      <?php foreach ($work_type as $key => $value): ?>
                          <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="car_type_id">ประเภทรถ</label>
                  <select class="form-control" name="car_type_id" id="car_type_id">
                      <?php foreach ($car_type as $key => $value): ?>
                          <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cost">ราคาค่าแรง</label>
                  <input type="text" name="cost" class="form-control" id="cost">
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
