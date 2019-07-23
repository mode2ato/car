<!-- Page Content -->
<form id="addFrm" action="<?php echo base_url('api/job/add')?>">
    <div class="card mb-3">
        <div class="card-header"> <i class="fas fa-car"></i> รับรถเข้าซ่อม</div>
        <div class="card-body">
            <div class="form-group col-4">
                <label for="plate">ทะเบียน</label>
                <div class="d-flex">
                    <input type="text" name="plate" class="form-control mr-1" id="plate">
                    <button type="button" name="button" class="btn btn-secondary btn-search">ค้นหา</button>
                    <input type="hidden" name="car_id" value="" id="car_id">
                </div>
            </div>
            <div class="car-detail" style="display:none">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="brand">ยี่ห้อ</label>
                        <input type="text" name="brand" class="form-control" id="brand">
                    </div>
                    <div class="form-group col">
                        <label for="model">รุ่น</label>
                        <input type="text" name="model" class="form-control" id="model">
                    </div>
                    <div class="form-group col">
                        <label for="body_number">เลขตัวถัง</label>
                        <input type="text" name="body_number" class="form-control" id="body_number">
                    </div>
                    <div class="form-group col">
                        <label for="year">ปี</label>
                        <input type="text" name="year" class="form-control" id="year">
                    </div>
                    <div class="form-group col">
                        <label for="cc">ซีซี</label>
                        <input type="text" name="cc" class="form-control" id="cc">
                    </div>
                    <div class="form-group col">
                        <label for="color">สี</label>
                        <input type="text" name="color" class="form-control" id="color">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header"> <i class="fas fa-list"></i> รายการซ่อม <button class="btn btn-sm btn-success float-right btn-add-work" type="button"> <i class="fa fa-plus"></i> เพิ่มรายการ </a></div>
        <div class="card-body">

            <div class="work-list">

            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header"> <i class="fas fa-info-circle "></i> รายละเอียด</div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col">
                    <label for="brand">เลขเครม</label>
                    <input type="text" name="brand" class="form-control" id="brand">
                </div>
                <div class="form-group col">
                    <label for="model">ตัวแทน</label>
                    <input type="text" name="model" class="form-control" id="model">
                </div>
                <div class="form-group col">
                    <label for="body_number">บริษัทประกัน</label>
                    <input type="text" name="body_number" class="form-control" id="body_number">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="year">Job NO.</label>
                    <input type="text" name="year" class="form-control" id="year">
                </div>
                <div class="form-group col">
                    <label for="cc">Key NO.</label>
                    <input type="text" name="cc" class="form-control" id="cc">
                </div>
                <div class="form-group col">
                    <label for="color">จำนวนเครม</label>
                    <input type="text" name="color" class="form-control" id="color">
                </div>
                <div class="form-group col">
                    <label for="insurance">DD</label>
                    <input type="text" name="insurance" class="form-control" id="insurance">
                </div>
            </div>
            <input type="hidden" name="act" value="new_ticket">
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
    </div>

</form>
        <script type="text/javascript">
        $(".btn-search").click(function(e) {
            showLoading();
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var url = "<?php echo base_url('api/car/search')?>";
            var plate = $('#plate').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {act:'search',plate:plate}, // serializes the form's elements.
                dataType:'json',
                success: function(res)
                {
                    hideLoading();
                    if(res.code == 0){
                        $('.car-detail').show();
                        $('#car_id').val(res.data.id);
                        $('#brand').val(res.data.brand);
                        $('#model').val(res.data.model);
                        $('#body_number').val(res.data.body_number);
                        $('#year').val(res.data.year);
                        $('#cc').val(res.data.cc);
                        $('#color').val(res.data.color);
                        $('#insurance').val(res.data.insurance);
                    }else{

                        swal({
                      title: 'ยืนยัน?',
                      text: "ไม่พบข้อมูลรถ ต้องการเพิ่มใหม่หรือไม่",
                      type: 'warning',
                      showCancelButton: true,
                    }).then((result) => {
                      if (result) {
                          $('.car-detail').show();
                          $('#car_id').val('');
                          $('#brand').val('');
                          $('#model').val('');
                          $('#body_number').val('');
                          $('#year').val('');
                          $('#cc').val('');
                          $('#color').val('');
                          $('#insurance').val('');
                      }
                    }).catch(swal.noop);
                    }
                },
                error:function(e){
                    hideLoading();
                    console.log(e);
                }
            });
        });
        $(".btn-add-work").click(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            clearModal();
            $('#addworkModal').modal('show');
        });
        function clearModal(){
            $('#work_id').val('');
            $('#employee_id').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            $('#cost').val('');
        }
        </script>


        <!-- Update Modal-->
        <div class="modal fade " id="addworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการซ่อม</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="work_id">งาน</label>
                          <select class="form-control" id="work_id">
                              <option value="">-- เลือกงาน --</option>
                              <?php foreach ($works as $key => $value): ?>
                                  <option value="<?php echo $value['id']?>"><?php echo $value['code'].' | '.$value['name']?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="employee_id">พนักงาน</label>
                          <select class="form-control" id="employee_id">
                              <option value="">-- เลือกพนักงาน --</option>
                              <?php foreach ($employees as $key => $value): ?>
                                  <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">วันที่เริ่ม</label>
                            <input type="date" class="form-control" id="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">วันที่เสร็จ</label>
                            <input type="date" class="form-control" id="end_date">
                        </div>
                        <div class="form-group">
                            <label for="cost">ราคา</label>
                            <input type="text" class="form-control" id="cost">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-sm float-right btn-work-save">เพิ่มงาน</button>
                    </div>
                </div>
            </div>
        </div>
