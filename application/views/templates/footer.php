<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistem Monitoring Tape <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin akan Logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('autentifikasi/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/dataTables.bootstrap4.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatable/buttons.colVis.min.js"></script>

<script src="<?= base_url('assets/highcharts/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts/exporting.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts/export-data.js'); ?>"></script>
<script src="<?= base_url('assets/highcharts/accessibility.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });


    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/ubahakses'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleakses/'); ?>" + roleId;
            }

        });
    });

    $('#example').DataTable();

    var table = $('#examples').DataTable({
        lengthChange: false,
        pageLength: 25,
        buttons: [{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [{
            visible: false
        }]
    });

    table.buttons().container()
        .appendTo('#examples_wrapper .col-md-6:eq(0)');
</script>