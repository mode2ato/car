</div>
<!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">ท่านมีความต้องการที่จะออกจากระบะใช่หรือไม่?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-primary" href="<?php echo base_url('logout')?>">ออกจากระบบ</a>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal-->
<div class="modal fade " id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">การอัพเดทระบบ</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">สถานะ : ปัจจุบัน (Beta 0.1)
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm float-right">ตรวจสอบอัพเดท</button>
            </div>
        </div>
    </div>
</div>


<!-- Custom scripts for all pages-->
<script src="<?php echo base_url();?>public/js/sb-admin.min.js"></script>
</body>

</html>
