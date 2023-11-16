<!-- END CONTENT-->
<footer class="main-footer">
   <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
   </div>
   <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
   reserved.
</footer>
</div>
<script src="../public/jquery/jquery-3.7.0.min.js"></script>
<script src="../public/datatables/js/dataTables.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/dist/js/adminlte.min.js"></script>
<script>
   $(document).ready(function() {
      $('#myTable').DataTable();

      // Xử lý khi chọn checkbox ở thẻ th
      $(".select-all").click(function() {
         var isChecked = $(this).prop("checked");

         // Đặt trạng thái của tất cả các checkbox ở thẻ td giống với checkbox ở thẻ th
         $(".select-item").prop("checked", isChecked);

         // Cập nhật giá trị của input ẩn selectedIds
         updateSelectedIds();
      });

      // Xử lý khi chọn hoặc bỏ chọn checkbox ở thẻ td
      $(".select-item").click(function() {
         // Cập nhật giá trị của input ẩn selectedIds
         updateSelectedIds();
      });

      // Hàm cập nhật giá trị của input ẩn selectedIds
      function updateSelectedIds() {
         var selectedIds = [];

         $(".select-item:checked").each(function() {
            var id = $(this).data("id");
            if ($.inArray(id, selectedIds) === -1) {
               selectedIds.push(id);
            }
         });

         $("#selectedIds").val(selectedIds.join(',')); // Cập nhật giá trị của input ẩn
      }
   });
</script>

</body>

</html>