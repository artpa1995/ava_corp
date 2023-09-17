<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="py-3"><h5 class="modal-title text-center" id="exampleModalLabel">Are you sure? </h5></div>
            <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <a href="" class="btn btn-danger data_delete_href_to" >YES</a>
            </div>
        </div>
    </div>
</div>

<script>
        
    $(document).ready(function() {
        $(document).on('click', '.data_delete_href_from', function(){
            let href = $(this).data('href');
            $('.data_delete_href_to').attr('href',href);
        })
    });

</script>