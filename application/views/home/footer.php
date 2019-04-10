<!--<hr>-->
<!--<p>This is footer</p>-->
<!--<hr>-->
<script type="text/javascript" src="<?php echo base_url("public/js/jquery-3.3.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/datatables.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/jquery.dataTables.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/datatables.bootstrap4.min.js");?>"></script>
<script>
    $(document).ready(function() {
        $('#users').DataTable();
    } );</script>
<script>
    function deleteModal(name, deleteUrl) {
        $("#deleteBtn").attr("href", deleteUrl);
        $("#usernameSpan").text(name);
        $('#myModal').modal('toggle');
    }
</script>
</body>
</html>