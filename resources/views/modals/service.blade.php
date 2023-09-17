<div class="modal " id="add_new_service">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button" class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Service Configuration</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('new_service')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Service Details</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Title</label>
                                     <input type="text" class="form-control" name="title">
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Status</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0"> Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Pricing</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Currency</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="currency">
                                            @foreach($currencies as $key => $currency)
                                                <option value="{{$key }}">{{$currency}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Price</label>
                                     <input type="number" class="form-control" name="price">
                                </div>
                            </div>
                            <div class="row  mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2">Period</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="period">
                                            @foreach($periods as $key => $period)
                                                <option value="{{$key }}">{{$period}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <label class="mr-sm-2">Invoice Description</label>
                                    <textarea name="invoice_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2 mb-3">
                                <div class="col-12">
                                    <label class="mr-sm-2">Comments</label>
                                    <textarea name="comments" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal " id="edit_service">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button" class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">Edit Service Configuration</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_service')}}" method="POST">
                    <input type="hidden" name="id" value="" id="sevice_id">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Service Details</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Title</label>
                                     <input type="text" class="form-control service_title" name="title">
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Status</label>
                                    <div>
                                        <select class="select2 custom-select form-control service_status" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Pricing</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Currency</label>
                                    <div>
                                        <select class="select2 custom-select form-control service_currency" name="currency">
                                            @foreach($currencies as $key => $currency)
                                                <option value="{{$key }}">{{$currency}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Price</label>
                                     <input type="number" class="form-control service_price" name="price">
                                </div>
                            </div>
                            <div class="row  mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2">Period</label>
                                    <div>
                                        <select class="select2 custom-select form-control service_period" name="period">
                                            @foreach($periods as $key => $period)
                                                <option value="{{$key }}">{{$period}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <label class="mr-sm-2">Invoice Description</label>
                                    <textarea name="invoice_description" class="form-control service_invoice_description"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2 mb-3">
                                <div class="col-12">
                                    <label class="mr-sm-2">Comments</label>
                                    <textarea name="comments" class="form-control service_comments"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        
    $(document).ready(function() {
        $('.data_delete_href_from').on('click',function(){
            let href = $(this).data('href');
            $('.data_delete_href_to').attr('href',href);
        })
        $('.select2').each(function(){
            $(this).select2({
                dropdownParent:  $(this).parent()
            });
        })

       

        $(document).on('click','.edit_servise_button', function(){
            let data =  $(this).data('val');
            let id = $('#sevice_id');
            let title = $('.service_title')
            let status = $('.service_status')
            let currency = $('.service_currency')
            let price = $('.service_price')
            let period = $('.service_period')
            let invoice_description = $('.service_invoice_description')
            let comments = $('.service_comments')

            title.val('');
            price.val('');
            id.val('');
            invoice_description.html('');
            comments.html('');
            if(data.id){
                id.val(data.id);
            }
            if(data.title){
                title.val(data.title);
            }
            if(data.price){
                price.val(data.price);
            }
            if(data.invoice_description){
                invoice_description.html(data.invoice_description);
            }
            if(data.comments){
                comments.html(data.comments);
            }
            status.val(1).trigger('change.select2');
            currency.val(1).trigger('change.select2');
            period.val(1).trigger('change.select2');

            if(data.status){
                status.val(data.status).trigger('change.select2');
            }
            if(data.currency){
                currency.val(data.currency).trigger('change.select2');
            }
            if(data.period){
                period.val(data.period).trigger('change.select2');
            }

        })

    });

</script>