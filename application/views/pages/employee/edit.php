<!-- Page Content -->
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            เพิ่มข้อมูลพนักงาน</div>
          <div class="card-body">
              <form id="editFrm" action="<?php echo base_url('api/employee/edit')?>">
                <div class="form-group">
                  <label for="id_card">เลขบัตรประชาชน</label>
                  <input type="text" name="id_card" class="form-control" id="id_card" value="<?php echo $employee['id_card']?>">
                </div>
                <div class="form-group">
                  <label for="name">ชื่อ - นามสกุล</label>
                  <input type="text" name="name" class="form-control" id="name" value="<?php echo $employee['name']?>">
                </div>
                <div class="form-group">
                  <label for="nickname">ขื่อเล่น</label>
                  <input type="text" name="nickname" class="form-control" id="nickname" value="<?php echo $employee['nickname']?>">
                </div>
                <div class="form-group">
                  <label for="address">ที่อยู่ปัจจุบัน</label>
                  <input type="text" name="address" class="form-control" id="address" value="<?php echo $employee['address']?>">
                </div>
                <div class="form-group">
                  <label for="phone">เบอร์โทรศัพท์</label>
                  <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $employee['phone']?>">
                </div>
                <div class="form-group">
                  <label for="work_type_id">ตำแหน่ง</label>
                  <select class="form-control" name="work_type_id" id="work_type_id">
                      <?php foreach ($work_type as $key => $value): ?>
                          <option value="<?php echo $value['id']?>" <?php echo ($value['id'] == $employee['work_type_id'])?'selected':''; ?>><?php echo $value['name']?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="social_insurance">ประกันสังคม - หักต่อเดือน, ถ้าไม่มีไม่ต้องระบุ</label>
                  <input type="text" name="social_insurance" class="form-control" id="social_insurance" value="<?php echo $employee['social_insurance']?>">
                </div>
                <div class="form-group">
                  <label for="salary_type">เงินเดือน,ค่าแรง</label>
                  <select class="form-control" name="salary_type" id="salary_type">
                      <option value="รายชิ้น" <?php echo ($employee['salary_type'] == 'รายชิ้น')?'selected':''; ?>>รายชิ้น</option>
                      <option value="รายวัน" <?php echo ($employee['salary_type'] == 'รายวัน')?'selected':''; ?>>รายวัน</option>
                      <option value="รายเดือน" <?php echo ($employee['salary_type'] == 'รายเดือน')?'selected':''; ?>>รายเดือน</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="payment">ช่องทางการชำระเงิน</label>
                  <select class="form-control" name="payment" id="payment">
                      <option value="โอนเงิน" <?php echo ($employee['payment'] == 'โอนเงิน')?'selected':''; ?>>โอนเงิน</option>
                      <option value="เงินสด" <?php echo ($employee['payment'] == 'เงินสด')?'selected':''; ?>>เงินสด</option>
                  </select>
                </div>
                <input type="hidden" name="act" value="edit">
                <input type="hidden" name="id" value="<?php echo $employee['id']?>">
                <button type="submit" class="btn btn-primary">บันทึก</button>
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
                        window.location.href="<?php echo base_url('employees')?>";
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
