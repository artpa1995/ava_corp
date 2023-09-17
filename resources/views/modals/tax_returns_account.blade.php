<div class="modal " id="tax_returns_modal" style="">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">New Tax Return</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline tax_return_form" action="{{route('create_tax_returns_account')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="account_id" id="" value="{{$id}}">
                    <input type="hidden" name="account_name" id="" value="{{$page_title}}">
                    <div class="">
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year Start Date</label>
                                <a class="Set_to_Last_Year_new cursor-pointer" style="float:right">Set to Last Year</a>
                                <input type="date" class="form-control tax_returns_tax_start" value="" name="start_date" id="tax_returns_start_date" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year End Date</label>
                                <input type="date" class="form-control tax_returns_tax_end" value="" name="tax_end" required>
                                <input type="hidden" value="" id="tax_returns_due_date">
                            </div>
                        </div>
                        {{-- <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary Set_to_Last_Year_new">Set to Last Year</button>
                            </div>
                        </div> --}}
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2">Tax Return Type</label>
                                <div>
                                    <select class="select2 custom-select form-control tax_return_type" name="tax_return_type" id=''>
                                        <option value="1">Form 1040  (Standard Tax Return)</option>
                                        <option value="2">Form 1040-NR (Non Resident)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Tax Return Due Date</label>
                                <a  class=" Set_to_Last_Year_new_2 cursor-pointer" style="float:right">Set Date</a>
                                <input type="date" class="form-control tax_returns_due_date" value="" name="due_date" data-addNewYear="">
                                <input type="hidden" value="" id="tax_returns_due_date">
                            </div>
                        </div>
                        {{-- <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary Set_to_Last_Year_new_2">Set to Last Year</button>
                            </div>
                        </div> --}}

                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2">Tax Return Status</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="status" id=''>
                                        <option value="1">Not Filed</option>
                                        <option value="2">Filed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Filing Status</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="company_status" id='filing_status_new'>
                                        <option value="1">Single</option>
                                        <option value="2">Married Filing Jointly</option>
                                        <option value="3">Married Filing Separately</option>
                                        <option value="4">Head of Household</option>
                                        <option value="5">Qualifying Widow(er) with Dependent (edited)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary generate_form_7004">Generate</button>
                                        <input type="hidden" name="generate_file" class="generate_file">
                                    </div>
                                    <p class="generate_form_4868_error d-none text-danger mt-1"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Filing Extension 4868; File Upload / Link </label>
                                {{-- <input type="file" name="filing_extension" id="" class="form-control"> --}}
                                <input type="text" name="filing_extension_link" id="" class="form-control mb-3 mt-2 filing_extension_link" >
                                <div class="col-12 form_7004_link"></div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Link; File Upload / Link</label>
                                {{-- <input type="file" name="file" id="" class="form-control"> --}}
                                <input type="text" name="file_link" id="" class="form-control mb-3 mt-2 file_link_new_tax">
                                <div class="col-12 file_link_href "></div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col-12">
                                <label class="mr-sm-2">TR Google Drive Folder</label>
                                <input name="google_drive" id=""  class="form-control Google_Drive_text">
                                <div class="Google_Drive_img_big Google_Drive_img mt-2 d-none" >
                                    <a href="" class="Google_Drive_link" target="_blunk">
                                        <img src="{{url('image/Google_Drive.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="Spouse_Information_block d-none">
                            <div class="row mb-3 mt-2 px-2">
                                <div class="bg-light p-3 h6">Spouse Information</div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Full Name</label>
                                    <input type="text" name="fullname" id="fullname_new" class="form-control mb-3 mt-2 " >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">SSN or ITIN</label>
                                    <input type="text" name="SSN_or_ITIN" id="SSN_or_ITIN_new" class="form-control mb-3 mt-2 ">
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Date of Birth</label>
                                    <input type="date" name="bday" id="bday_new" class="form-control mb-3 mt-2">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Country of Citizenship</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="country_id" id='country_id_new'>
                                            @foreach($countries as $coun)
                                                <option value="{{$coun->id}}">{{$coun->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <input type="checkbox" name="desabled_field" id="desabled_new"  value="1">
                                    <label for="desabled_new" class="mr-sm-2">Disabled</label>
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


<div class="modal " id="show_tax_returns" style="">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Tax Return</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline tax_return_form" action="{{route('edit_tax_returns_account')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tax_id" id="tax_id">
                    <input type="hidden" name="account_name" id="" value="{{$page_title}}">
                    <div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Year Start Date</label>
                                <input type="date" value="" name="start_date" class="form-control tax_returns_start_date_show " disabled>
                                <input type="hidden" value="" name="" class="form-control tax_returns_start_date_show tax_returns_tax_start" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Year End Date</label>
                                <input type="date" value="" name="tax_end" class="form-control tax_returns_end_date_show " disabled>
                                <input type="hidden" value=""  class="form-control tax_returns_end_date_show tax_returns_tax_end" >

                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Type</label>
                                <div>
                                    <select  class="select2 custom-select form-control " name="tax_return_type" id='tax_return_type'>
                                        <option value="1">Form 1040  (Standard Tax Return)</option>
                                        <option value="2">Form 1040-NR (Non Resident)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Return Due Date</label>
                                <input type="date" value="" name="due_date" class="form-control tax_returns_due_date_show">
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary Set_to_Last_Year_new_2_show">Set to Last Year</button>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Return Status</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_returns_status_show"  name="status" id=''>
                                        <option value="1">Not Filed</option>
                                        <option value="2">Filed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Filing Status</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_returns_company_status_show" name="company_status" id=''>
                                        <option value="1">Single</option>
                                        <option value="2">Married Filing Jointly</option>
                                        <option value="3">Married Filing Separately</option>
                                        <option value="4">Head of Household</option>
                                        <option value="5">Qualifying Widow(er) with Dependent (edited)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary generate_form_7004">Generate</button>
                                        <input type="hidden" name="generate_file" class="generate_file">
                                    </div>
                                    <p class="generate_form_4868_error d-none text-danger mt-1"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Filing Extension 4868; File Upload / Link </label>
                                {{-- <input type="file" name="filing_extension" id="" class="form-control"> --}}
                                <input type="text" name="filing_extension_link" id="filing_extension_link" class="form-control mb-3 mt-2 filing_extension_link">
                                <div class="col-12 form_7004_link form_7004_link_edit"></div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2 ">Tax Return Link; File Upload / Link</label>
                                {{-- <input type="file" value="" name="file" class="form-control "> --}}
                                <input type="text" value="" name="file_link" class="form-control tax_returns_file_path_show mt-2 file_link_view_tax">
                                <div class="col-12 file_link_href_view "></div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col-12">
                                <label class="mr-sm-2">TR Google Drive Folder</label>
                                <input name="google_drive" id=""  class="form-control Google_Drive_text_show">
                                <div class="Google_Drive_img_big Google_Drive_img_show mt-2 d-none" >
                                    <a href="" class="Google_Drive_link_show" target="_blunk">
                                        <img src="{{url('image/Google_Drive.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="Spouse_Information_block_edit d-none">
                            <div class="row mb-3 mt-2 px-2">
                                <div class="bg-light p-3 h6">Spouse Information</div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Full Name</label>
                                    <input type="text" name="fullname" id="fullname_edit" class="form-control mb-3 mt-2 " >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">SSN or ITIN</label>
                                    <input type="text" name="SSN_or_ITIN" id="SSN_or_ITIN_edit" class="form-control mb-3 mt-2 ">
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Date of Birth</label>
                                    <input type="date" name="bday" id="bday_edit" class="form-control mb-3 mt-2">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Country of Citizenship</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="country_id" id='country_id_edit'>
                                            @foreach($countries as $coun)
                                                <option value="{{$coun->id}}">{{$coun->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <input type="checkbox" name="desabled_field" id="desabled_edit"  value="1">
                                    <label for="desabled_edit" class="mr-sm-2">Disabled</label>
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
    $(document).ready(function(){

        $('.show_tax_returns').on('click', function(){
            $('.generate_form_4868_error').addClass('d-none');
            let data = $(this).data('tax_returns');
            let tax_status = {'1':'Not Filed', '2':'Filed'};
            let tax_returns_start_date_show = $('.tax_returns_start_date_show');
            let tax_returns_end_date_show = $('.tax_returns_end_date_show');
            let tax_returns_due_date_show = $('.tax_returns_due_date_show');
            let tax_returns_status_show = $('.tax_returns_status_show');
            let tax_returns_company_status_show = $('.tax_returns_company_status_show');
            let tax_return_type = $('#tax_return_type');
            let Google_Drive_text_show = $('.Google_Drive_text_show');
            let Google_Drive_link_show = $('.Google_Drive_link_show');
            let Google_Drive_img_show = $('.Google_Drive_img_show');

            let tax_returns_file_path_show = $('.tax_returns_file_path_show');
            let tax_id = $('#tax_id');
            tax_returns_start_date_show.val('');
            tax_returns_end_date_show.val('');
            tax_returns_due_date_show.val('');
            tax_returns_file_path_show.val('');
            Google_Drive_text_show.val('');
            Google_Drive_link_show.removeAttr('href');
            Google_Drive_img_show.addClass('d-none');
            tax_id .val('');
            $('.Spouse_Information_block_edit').addClass('d-none')

            $('#fullname_edit').val('')
            $('#SSN_or_ITIN_edit').val('')
            $('#bday_edit').val('')
            $('#country_id_edit').val(1).trigger('change.select2');

            $('.link_of_generate').val('');

            tax_returns_status_show.val(1).trigger('change.select2');
            tax_returns_company_status_show.val(1).trigger('change.select2');
     
            if(data.fullname){
                $('#fullname_edit').val(data.fullname)
            }
            
            if(data.google_drive){
                Google_Drive_text_show.val(data.google_drive);
                Google_Drive_link_show.attr('href', data.google_drive);
                Google_Drive_img_show.removeClass('d-none');
            }

            if(data.SSN_or_ITIN){
                $('#SSN_or_ITIN_edit').val(data.SSN_or_ITIN)
            }

            if(data.country_id){
                $('#country_id_edit').val(data.country_id).trigger('change.select2');
            }

            if(data.bday){
                $('#bday_edit').val(data.bday.slice(0, 10));
            }
        
            if(data.disabled){
                $('#desabled_edit').attr('checked', true);
                $('#desabled_edit').prop('checked');
            }
            
            if(data.spouseed){
                $('.Spouse_Information_block_edit').removeClass('d-none')
            }

            if(data.status == 1){
               tax_returns_status_show.val(1).trigger('change.select2');
            }else{
                tax_returns_status_show.val(2).trigger('change.select2');
            }

            if(data.company_status){
               tax_returns_company_status_show.val(data.company_status).trigger('change.select2');
            }

            if(data.tax_return_type){
                tax_return_type.val(data.tax_return_type).trigger('change.select2');
            }
            $('.form_7004_link_edit').empty();
            if(data.pdf_file){
                $('.link_of_generate').val(data.pdf_file.path);
            }

            tax_returns_start_date_show.val(data.tax_start);
            tax_returns_end_date_show.val(data.tax_end);
            tax_returns_due_date_show.val(data.due_date);
            tax_returns_file_path_show.val(data.file_path);

            $('#filing_extension_link').val('')
            $('#filing_extension_link').parent().find('input').removeAttr('disabled')
            if(data.pdf_file && data.pdf_file.path){
                $('#filing_extension_link').parent().find('input').attr('disabled', 'disabled')
                $('#filing_extension_link').val(data.pdf_file.path)
                $('#filing_extension').val(data.pdf_file.path)
                $('.form_7004_link_edit').append('<a href="'+data.pdf_file.path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
            }
            $('.file_link_href_view').parent().find('input').removeAttr('disabled')
            $('.file_link_href_view').empty();
            if(data.file_path){
                $('.file_link_href_view').parent().find('input').attr('disabled', 'disabled')
                $('.file_link_href_view').append('<a href="'+data.file_path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
            }
           
            tax_id .val(data.id);
        })


        $('.generate_form_7004').on('click', function(){
            $('.generate_form_4868_error').addClass('d-none');
            let tax_end = $(this).parents('.tax_return_form').find('.tax_returns_tax_end').val();
            let tax_start = $(this).parent().parent().parent().parent().parent().parent('.tax_return_form').find('.tax_returns_tax_start').val()
            let account_id = '<?= $account->id?>';
            let tax_return_type = $(this).parent().parent().parent().parent().parent().parent('.tax_return_form').find('.tax_return_type').val()

            $(this).parent().find('.generate_file').val('');

            $(this).html('Loading ...')
            $(this).attr('disabled',true);
            $(this).parents('.tax_return_form').find('.form_7004_link').empty();

            $(this).parents('.tax_return_form').find('.filing_extension_link').val('');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:'/edit_pdf_4868',
                datatType : 'json',
                data: {account_id : account_id, tax_end : tax_end,tax_start:tax_start , tax_return_type: tax_return_type}, 
                success: (response) => {
                    if (response.code == 400) {
                        $('.generate_form_4868_error').removeClass('d-none');
                        $('.generate_form_4868_error').html(response.msg);
                        $(this).html('Generate')
                        $(this).attr('disabled',false);
                    }else if(response.code == 200){
                        let text = response.msg;
                        $(this).parents().find('.generate_file').val(text);
                        $(this).parents('.tax_return_form').find('.filing_extension_link').val(text);
                        $(this).parents('.tax_return_form').find('.form_7004_link').append('<a href="'+text+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                        $(this).html('Generate')
                        $(this).attr('disabled',false);
                    }
                }
            })
        })

        $('.filing_extension_link').on('input' , function(){
            $(this).parents('.tax_return_form').find('.form_7004_link').empty();
            $(this).parents('.tax_return_form').find('.form_7004_link').append('<a href="'+$(this).val()+'" target="_blank" class="text-succsess mb-2">Open File</a>');
        })
        $('.file_link_new_tax').on('input', function(){
            $(this).parents('.tax_return_form').find('.file_link_href').empty();
            $(this).parents('.tax_return_form').find('.file_link_href').append('<a href="'+$(this).val()+'" target="_blank" class="text-succsess mb-2">Open File</a>');
        })

        $('.Set_to_Last_Year_new').on('click', function(){
            let date = $('#tax_returns_start_date');
            let today = new Date();
            let year = today.getFullYear() -1;
            // let dd = String(today.getDate()).padStart(2, '0');
            // let mm = String(today.getMonth() + 1).padStart(2, '0');
            // let yy = today.getFullYear();
            // today = yy + '-' + mm + '-' + dd;

            let last_year_start = year + "-" + '01' + "-" + '01';
            date.val(last_year_start);

            let lastDay = year + "-" + 12 + "-" + 31;
            $('.tax_returns_tax_end').val(lastDay);
        })

        $('.Set_to_Last_Year_new_2').on('click', function(){

            let today = new Date();
            let year = today.getFullYear();
            let lastDay = '';
            $('.tax_returns_due_date').val('')
            if($('.tax_return_type').val() == 1){
                 lastDay = year + "-" + '04' + "-" + 15;
            }else if($('.tax_return_type').val() == 2){
                lastDay = year + "-" + '06' + "-" + 15;
            }
            $('.tax_returns_due_date').val(lastDay);
        })

        $('.Set_to_Last_Year_new_2_show').on('click', function(){

            let today = new Date();
            let year = today.getFullYear();
            let lastDay = '';
            $('.tax_returns_due_date_show').val('')
            if($('#tax_return_type').val() == 1){
                lastDay = year + "-" + '04' + "-" + 15;
            }else if($('#tax_return_type').val() == 2){
                lastDay = year + "-" + '06' + "-" + 15;
            }
            $('.tax_returns_due_date_show').val(lastDay);
        })

        $('#filing_status_new').on('change', function(e){
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();

            $('.Spouse_Information_block').addClass('d-none');

            if(select_val == 2 || select_val == 3){
                let account_id = '<?= $account->id?>';
                $('.Spouse_Information_block').removeClass('d-none');

               let tax_returns_tax_end = $('.tax_returns_tax_end').val();
              
               if(tax_returns_tax_end && tax_returns_tax_end != ''){

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        type:"POST",
                        url:'/get_prev_year_tax_return_account',
                        datatType : 'json',
                        data: {account_id : account_id, tax_end : tax_returns_tax_end}, 
                        success: (response) => {
                            if (response.code == 200) {
                                let data = response.msg;
                                console.log(data);
                                $('#fullname_new').val('')
                                $('#SSN_or_ITIN_new').val('')
                                $('#bday_new').val('')

                                $('#country_id_new').val(1).trigger('change.select2');
                                
                                if(data.fullname){
                                    $('#fullname_new').val(data.fullname)
                                }

                                if(data.SSN_or_ITIN){
                                    $('#SSN_or_ITIN_new').val(data.SSN_or_ITIN)
                                }

                                if(data.country_id){
                                    $('#country_id_new').val(data.country_id).trigger('change.select2');
                                }

                                if(data.bday){
                                    $('#bday_new').val(data.bday.slice(0, 10));
                                }
                                $('#desabled_new').removeAttr('checked')
                                if(data.disabled){
                                    $('#desabled_new').attr('checked', true);
                                    $('#desabled_new').prop('checked');
                                }

                            }
                        }
                    })
               }

            }
        })

        $('.tax_returns_company_status_show').on('change', function(e){
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();

            $('.Spouse_Information_block_edit').addClass('d-none');

            if(select_val == 2 || select_val == 3){
                let account_id = '<?= $account->id?>';
                $('.Spouse_Information_block_edit').removeClass('d-none');

               let tax_returns_tax_end = $('.tax_returns_end_date_show').val();
              
               if(tax_returns_tax_end && tax_returns_tax_end != ''){

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        type:"POST",
                        url:'/get_prev_year_tax_return_account',
                        datatType : 'json',
                        data: {account_id : account_id, tax_end : tax_returns_tax_end}, 
                        success: (response) => {
                            if (response.code == 200) {
                                let data = response.msg;
                                console.log(data);
                                $('#fullname_edit').val('')
                                $('#SSN_or_ITIN_edit').val('')
                                $('#bday_edit').val('')

                                $('#country_id_edit').val(1).trigger('change.select2');
                                
                                if(data.fullname){
                                    $('#fullname_edit').val(data.fullname)
                                }

                                if(data.SSN_or_ITIN){
                                    $('#SSN_or_ITIN_edit').val(data.SSN_or_ITIN)
                                }

                                if(data.country_id){
                                    $('#country_id_edit').val(data.country_id).trigger('change.select2');
                                }

                                if(data.bday){
                                    $('#bday_edit').val(data.bday.slice(0, 10));
                                }
                                $('#desabled_edit').removeAttr('checked')
                                if(data.disabled){
                                    $('#desabled_edit').attr('checked', true);
                                    $('#desabled_edit').prop('checked');
                                }
                            }
                        }
                    })
               }
            }
        })

        $('.Google_Drive_text_show').on('input', function(){
            let value = $(this).val();
            $('.Google_Drive_link_show').attr('href', value);
            $('.Google_Drive_img_show').removeClass('d-none');
            if(value == ''){
                $('.Google_Drive_img_show').addClass('d-none');
            }
        })
        

    })
</script>