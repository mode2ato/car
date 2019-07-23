
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            ข้อมูลพนักงาน <a href="<?php echo base_url('employee/add')?>" class="btn btn-sm btn-outline-primary float-right"> <i class="fa fa-plus"></i> เพิ่มพนักงาน </a> </div>
          <div class="card-body">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>ขื่อ - นามสกุล</th>
                      <th>ตำแหน่ง</th>
                      <th>เบอร์โทรศัพท์</th>
                      <th>จัดการ</th>
                  </tr>
              </thead>
              <tbody>
                  <?php if (!empty($employees)): ?>
                      <?php foreach ($employees as $key => $value): ?>
                          <tr data-id="<?php echo $value['id']?>">
                              <td><?php echo $value['name']?></td>
                              <td><?php echo $work_type[$value['work_type_id']]['name']?></td>
                              <td><?php echo $value['phone']?></td>
                              <td> <a href="<?php echo base_url('employee/'.$value['id'])?>" class="btn btn-sm btn-warning btn-edit">แก้ไข</a>  <button class="btn btn-sm btn-danger btn-del">ลบ</button></td>
                          </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4" class="text-center">ไม่พบข้อมูล</td>
                      </tr>
                  <?php endif; ?>
              </tbody>
          </table>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <script type="text/javascript">
        $(".btn-del").click(function(e) {

            var id = $(this).closest('tr').attr('data-id');
            var url = "<?php echo base_url('api/employee/del')?>";

            swal({
          title: 'ยืนยัน?',
          text: "ต้องการลบข้อมูลใช่หรือไม่",
          type: 'warning',
          showCancelButton: true,
        }).then((result) => {
          if (result) {
              showLoading();
              $.ajax({
                  type: "POST",
                  url: url,
                  data: {act:'del',id:id},
                  dataType:'json',
                  success: function(res)
                  {
                      hideLoading();
                      if(res.code == 0){
                          swal({
                              type: 'success',
                              title: 'สำเร็จ !!!',
                              text: 'ลบข้อมูลสำเร็จ',
                          }).then(function(){
                              window.location.href="<?php echo base_url('employees')?>";
                          });
                      }else{

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
          }
        }).catch(swal.noop);

        });
        </script>
