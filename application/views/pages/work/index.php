
<!-- Page Content -->
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            ข้อมูลงาน <a href="<?php echo base_url('work/add')?>" class="btn btn-sm btn-outline-primary float-right"> <i class="fa fa-plus"></i> เพิ่มงาน </a> </div>
          <div class="card-body">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>รหัสซ่อม</th>
                      <th>ชื่องาน</th>
                      <th>ประเภทงาน</th>
                      <th>ประเภทรถ</th>
                      <th>จัดการ</th>
                  </tr>
              </thead>
              <tbody>

                  <?php if (isset($works) and !empty($works)): ?>
                      <?php foreach ($works as $key => $value): ?>
                          <tr data-id="<?php echo $value['id']?>">
                              <td><?php echo $value['code']?></td>
                              <td><?php echo $value['name']?></td>
                              <td><?php echo isset($work_type[$value['work_type_id']])?$work_type[$value['work_type_id']]['name']:'ไม่ระบุ'?></td>
                              <td><?php echo isset($car_type[$value['car_type_id']])?$car_type[$value['car_type_id']]['name']:'ไม่ระบุ'?></td>
                              <td> <a href="<?php echo base_url('work/'.$value['id'])?>" class="btn btn-sm btn-warning btn-edit">แก้ไข</a>  <button class="btn btn-sm btn-danger btn-del">ลบ</button></td>
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
        </div>
<script type="text/javascript">
$(".btn-del").click(function(e) {

    var id = $(this).closest('tr').attr('data-id');
    var url = "<?php echo base_url('api/work/del')?>";

    swal({
  title: 'ยืนยัน?',
  text: "ต้องการลบข้อมูลใช่หรือไม่",
  type: 'warning',
  showCancelButton: true,
}).then((result) => {
    console.log(result);
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
                      window.location.href="<?php echo base_url('works')?>";
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
