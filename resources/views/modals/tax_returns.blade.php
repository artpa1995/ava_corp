<div class="modal " id="tax_returns_modal">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Tax Return</h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <label  class="mr-sm-2">Select the tax year end</label>
                            <div id="tax_returns_years_block" class="mt-2">

                                @if(!empty($tax_years) && $tax_years !== 'wrong')
                                <select  class="select2 custom-select form-control account_id" name="account_id">
                                    @foreach($tax_years as $tax_year)
                                        <option value="{{$tax_year}}"> {{$tax_year}}</option>
                                    @endforeach
                                </select>
                                @elseif(!empty($tax_years) && ($tax_years == 'wrong' || !$company->tax_id))
                                    <p class="text-danger">Please make sure that the Status date, Tax ID and Accounting reference date is set before creating a tax return.</p>
                                @else
                                    @if(empty($sort_by) || $sort_by !='missing-tax-returns')                                
                                        <p class="text-danger">There are no completed tax years. Please try again once the first tax year for the company has been completed.</p>
                                    @endif
                                @endif
                                <div class="tax_years_select">
                                    <select  class="select2 custom-select form-control  tax_years_account_id d-none " name="account_id"></select>
                                </div>
                                

                                <p class="text-danger d-none wrong_tax">Please make sure that the Status date, Tax ID and Accounting reference date is set before creating a tax return.</p>
                                <p class="text-danger d-none no_tax">There are no completed tax years. Please try again once the first tax year for the company has been completed.</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="" value="{{!empty($conpany) ? $company->id : ''}}"  id="company_id">
                    
                    <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary create_new_tax_returns">Save</button>
                        <button type="button" class="btn btn-danger close_modal_tax_returns" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="newtax_returns_modal_open" data-toggle="modal" data-target="#tax_returns_modal2">
<input type="hidden" class="company_type_for_tax_returns" value="{{$company->company_id??0}}">
<input type="hidden" class="company_country_for_tax_returns" value="{{$company->country_id??0}}">
<input type="hidden" class="all_tax_year_prev" value="{{ json_encode($all_tax_year_prev)}}">
{{-- @php
$tax_returns_due_date = '';
$UK2 = [3,4];
if(!empty($company->country_id)){
    if($company->country_id == 4){
        $tax_returns_due_date = date("Y").'-04-15';
    }elseif ($company->country_id == 5 &&  in_array($company->company_id, $UK2) ) {
        $tax_returns_due_date = date("Y").'-01-31';
    }


}

@endphp --}}

{{-- new_tax --}}
<div class="modal " id="tax_returns_modal2" style="">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">New Tax Return</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline tax_return_form" action="{{route('create_tax_returns')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" id="" value="{{!empty($id) ? $id : ''}}">
                    <input type="hidden" name="company_name" id="" value="{{!empty($page_title) ? $page_title : ''}}">
                    <div class="">
                        <div class="row mb-3 mt-2 p-events-n" >
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year Start Date</label>
                                <input type="date" class="form-control tax_returns_tax_start" value="" name="start_date" id="tax_returns_start_date" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year End Date</label>
                                <input type="date" class="form-control tax_returns_tax_end" value="" name="tax_end" >
                                <input type="hidden" value="" id="tax_returns_due_date">
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 LLC_Tax_Status_for_This_Tax_Year_block d-none" >
                            <div class="col-6">
                                <label class="mr-sm-2">LLC Tax Status for This Tax Year</label>
                                <div>
                                    <select class="select2 custom-select form-control LLC_Tax_Status_for_This_Tax_Year" name="LLC_Tax_Status_for_This_Tax_Year" id=''>
                                        <option value="1" >Single Member LLC with Non-US Owner</option>
                                        <option value="2" >Single Member LLC with US Owner</option>
                                        <option value="3" >Corporation</option>
                                        <option value="4" >Partnership</option>
                                    </select>
                                </div>
                                <input type="hidden" name="LLC_Tax_Status_for_This_Tax_Year_exist" class="LLC_Tax_Status_for_This_Tax_Year_exist" value="0">
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Company Status for this Tax Year</label>
                                <div>
                                    <select  class="select2 custom-select form-control Company_Status_for_this_Tax_Year_new" name="company_status" id=''>
                                        <option value="1">Active & Trading</option>
                                        <option value="2">Non Trading (Traded Before)</option>
                                        <option value="3">Dormant (Never Traded)</option>
                                        {{-- <option value="1">Dormant (never traded)</option>
                                        <option value="2">Non trading (but traded before)</option>
                                        <option value="3">Trading</option>
                                        <option value="4">Disregarded Entity</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 p-events-n">
                                <label  class="mr-sm-2">Tax Return Type</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_return_type" name="tax_return_type" id=''>
                                        <option value="1" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 1 ? "selected" :''}}>1120 (Corporation)</option>
                                        <option value="2" >1120 (Foreign Disregarded Entity)</option>
                                        <option value="3" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 4 ? "selected" :''}}>1065 (Partnership)</option>
                                        <option value="4" >No Return Due</option>
                                        @if(1>4)
                                            {{-- <option value="1" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 1 ? "selected" :''}}>1120 (Corporation)</option>
                                            <option value="2" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 3 ? "selected" :''}}>1120 (Foreign Disregarded Entity)</option>
                                            <option value="3" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 4 ? "selected" :''}}>1065 (Partnership)</option>
                                            <option value="4" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 4 ? "selected" :''}}>No Return Due</option> --}}
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Status</label>
                                <div>
                                    <select  class="select2 custom-select form-control Tax_Return_Status_new" name="status" id=''>
                                        <option value="1">Not Filed</option>
                                        <option value="2">Filed</option>
                                        <option value="3">NA</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Due Date</label>
                                <input type="date" class="form-control tax_returns_due_date" value="" name="due_date" data-addNewYear="">
                                <input type="hidden" value="" id="tax_returns_due_date">
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">
                                    {{-- <div class="col-12 form_7004_link"></div> --}}
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary generate_form_7004">Generate</button>
                                        <input type="hidden" name="generate_file" class="generate_file">
                                    </div>
                                    {{-- <div class="col-8">
                                        <input type="file" value="" name="generate_file_link" class="form-control ">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Filing Extension 7004; File Upload / Link </label>
                                {{-- <input type="file" name="filing_extension" id="" class="form-control filing_extension_file_input"> --}}
                                <input type="text" name="filing_extension_link" id="" class="form-control mt-2 filing_extension_link" >
                                <div class="col-12 form_7004_link"></div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Link; File Upload / Link</label>
                                {{-- <input type="file" name="file" id="" class="form-control file_link_new_tax_file_input"> --}}
                                <input type="text" name="file_link" id="" class="form-control mb-3 mt-2 file_link_new_tax">
                                <div class="col-12 file_link_href "></div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col-6">
                                <label  class="mr-sm-2">Submitted on</label>
                                <input type="date" name="file_date_1" id="" class="form-control ">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Submitted on</label>
                                <input type="date" name="file_date_2" id="" class="form-control ">
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

{{-- view_tax --}}
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
                <form class="form-inline tax_return_form" action="{{route('edit_tax_returns')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tax_id" id="tax_id">
                    <input type="hidden" name="company_name" id="" value="{{!empty($page_title) ? $page_title : ''}}">
                    <div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Year Start Date</label>
                                <input type="date" value="" name="start_date" class="form-control tax_returns_start_date_show " disabled>
                                <input type="hidden" value="" name="" class="form-control tax_returns_start_date_show tax_returns_tax_start" >
                                {{-- <p  class="form-control1 tax_returns_start_date_show" id=""></p> --}}
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Year End Date</label>
                                <input type="date" value="" name="tax_end" class="form-control tax_returns_end_date_show " disabled>
                                <input type="hidden" value=""  class="form-control tax_returns_end_date_show tax_returns_tax_end" >
                                {{-- <p  class="form-control1 tax_returns_end_date_show" id=""></p> --}}

                            </div>
                        </div>
                         <div class="row mb-3 mt-2 LLC_Tax_Status_for_This_Tax_Year_block_show d-none" >
                            <div class="col-6">
                                <label class="mr-sm-2">LLC Tax Status for This Tax Year</label>
                                <div>
                                    <select class="select2 custom-select form-control LLC_Tax_Status_for_This_Tax_Year_show" name="LLC_Tax_Status_for_This_Tax_Year" id=''>
                                        <option value="1" >Single Member LLC with Non-US Owner</option>
                                        <option value="2" >Single Member LLC with US Owner</option>
                                        <option value="3" >Corporation</option>
                                        <option value="4" >Partnership</option>
                                    </select>
                                </div>
                                <input type="hidden" name="LLC_Tax_Status_for_This_Tax_Year_exist" class="LLC_Tax_Status_for_This_Tax_Year_exist" value="0">
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Company Status for this Tax Year</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_returns_company_status_show" name="company_status" id=''>
                                        <option value="1">Active & Trading</option>
                                        <option value="2">Non Trading (Traded Before)</option>
                                        <option value="3">Dormant (Never Traded)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 p-events-n">
                                <label  class="mr-sm-2">Tax Return Type</label>
                                <div>
                                    <select  class="select2 custom-select form-control  tax_return_type_show" name="tax_return_type" id='tax_return_type'>
                                        <option value="1">1120 (Corporation)</option>
                                        <option value="2">1120 (Foreign Disregarded Entity)</option>
                                        <option value="3">1065 (Partnership)</option>
                                        <option value="4">No Return Due</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Return Status</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_returns_status_show"  name="status" id=''>
                                        <option value="1">Not Filed</option>
                                        <option value="2">Filed</option>
                                        <option value="3">NA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Return Due Date</label>
                                <input type="date" value="" name="due_date" class="form-control tax_returns_due_date_show">
                                {{-- <p class="form-control1 tax_returns_due_date_show" ></p> --}}
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary generate_form_7004 generate_form_7004_show">Generate</button>
                                        <input type="hidden" name="generate_file" class="generate_file generate_file_show">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                               <label class="mr-sm-2">Filing Extension 7004; File Upload / Link </label> 
                                {{-- <input type="file" name="filing_extension"  class="form-control filing_extension_show "> --}}
                               <input type="text" name="filing_extension_link" id="filing_extension_link" class="form-control mt-2 filing_extension_link filing_extension_link_show">
                                <div class="col-12 form_7004_link form_7004_link_edit"></div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2 ">Tax Return Link; File Upload / Link</label>
                                {{-- <input type="file" value="" name="file" class="form-control file_link_file_input_show"> --}}
                                <input type="text" value="" name="file_link" class="form-control tax_returns_file_path_show mt-2 file_link_view_tax">
                                <div class="col-12 file_link_href_view "></div>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col-6">
                                <label  class="mr-sm-2">Submitted on</label>
                                <input type="date" name="file_date_1" id="" class="form-control file_date_1_show">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Submitted on</label>
                                <input type="date" name="file_date_2" id="" class="form-control file_date_2_show">
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
            let data = $(this).data('tax_returns');
            undisabled_tax_return_filds_show();
            let tax_status = {'1':'Not Filed', '2':'Filed'};
            // let tax_company_status = {
            //     '1' : 'Dormant (never traded)',
            //     '2' : 'Non trading (but traded before)',
            //     '3' : 'Trading',
            //     '4' : 'Disregarded Entity',
            // };
            let tax_returns_start_date_show = $('.tax_returns_start_date_show');
            let tax_returns_end_date_show = $('.tax_returns_end_date_show');
            let tax_returns_due_date_show = $('.tax_returns_due_date_show');
            let tax_returns_status_show = $('.tax_returns_status_show');
            let tax_returns_company_status_show = $('.tax_returns_company_status_show');
            let tax_return_type = $('#tax_return_type');
            let tax_returns_file_path_show = $('.tax_returns_file_path_show');
            let tax_id = $('#tax_id');
            let Google_Drive_text_show = $('.Google_Drive_text_show');
            let Google_Drive_link_show = $('.Google_Drive_link_show');
            let Google_Drive_img_show = $('.Google_Drive_img_show');
            tax_returns_start_date_show.val('');
            tax_returns_end_date_show.val('');
            tax_returns_due_date_show.val('');
            tax_returns_file_path_show.val('');
            tax_id .val('');
            Google_Drive_text_show.val('');
            Google_Drive_link_show.removeAttr('href');
            Google_Drive_img_show.addClass('d-none');


            $('.link_of_generate').val('');

            tax_returns_status_show.val(1).trigger('change.select2');
            tax_returns_company_status_show.val(1).trigger('change.select2');

            if(data.status == 1){
               tax_returns_status_show.val(1).trigger('change.select2');
            }else if(data.status == 2){
                tax_returns_status_show.val(2).trigger('change.select2');
            }else if(data.status == 3){
                tax_returns_status_show.val(3).trigger('change.select2');
            }
            
            if(!data.due_date){
                tax_returns_status_show.val(3).trigger('change.select2');
            }

            if(data.google_drive){
                Google_Drive_text_show.val(data.google_drive);
                Google_Drive_link_show.attr('href', data.google_drive);
                Google_Drive_img_show.removeClass('d-none');
            }

            if(data.company_status){
               tax_returns_company_status_show.val(data.company_status).trigger('change.select2');
            }

          
            $('.form_7004_link_edit').empty();
            if(data.pdf_file){
                $('.link_of_generate').val(data.pdf_file.path);
            }

            $('.LLC_Tax_Status_for_This_Tax_Year_block_show').addClass('d-none');
            $('.LLC_Tax_Status_for_This_Tax_Year_show').val(1).trigger('change.select2');
            if(data.LLC_Tax_Status_for_This_Tax_Year && $('.company_type_for_tax_returns').val() == 3){
                $('.LLC_Tax_Status_for_This_Tax_Year_block_show').removeClass('d-none');
                $('.LLC_Tax_Status_for_This_Tax_Year_show').val(data.LLC_Tax_Status_for_This_Tax_Year).trigger('change.select2');
            }
            if($('.company_type_for_tax_returns').val() == 3){
                $('.LLC_Tax_Status_for_This_Tax_Year_block_show').removeClass('d-none');
            }

            $('.file_date_1_show').val('');
            $('.file_date_2_show').val('');

            if(data.file_date_1){
                $('.file_date_1_show').val(data.file_date_1);
            }

            if(data.file_date_2){
                $('.file_date_2_show').val(data.file_date_2);
            }

            tax_returns_start_date_show.val(data.tax_start);
            tax_returns_end_date_show.val(data.tax_end);
            tax_returns_due_date_show.val(data.due_date);
            tax_returns_file_path_show.val(data.file_path);
            $('#filing_extension_link').val('')
            // $('#filing_extension_link').parent().find('input').removeAttr('disabled')
            if(data.pdf_file && data.pdf_file.path){
                // $('#filing_extension_link').parent().find('input').attr('disabled', 'disabled')
                
                $('#filing_extension_link').val(data.pdf_file.path)
                $('#filing_extension').val(data.pdf_file.path)
                $('.form_7004_link_edit').append('<a href="'+data.pdf_file.path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
            }
            // $('.file_link_href_view').parent().find('input').removeAttr('disabled')
            $('.file_link_href_view').empty();
            if(data.file_path){
                // $('.file_link_href_view').parent().find('input').attr('disabled', 'disabled')
                $('.file_link_href_view').append('<a href="'+data.file_path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
            }

            if(data.tax_return_type){
                tax_return_type.val(data.tax_return_type).trigger('change.select2');
                if(data.tax_return_type == 4){
                    disabled_tax_return_filds_show();
                }
            }
            tax_id .val(data.id);
        })


        function disabled_tax_return_filds_show(){
            $('.filing_extension_show').prop("disabled", true);
            $('.filing_extension_link_show').attr('disabled', 'disabled');
            $('.file_link_file_input_show').attr('disabled', 'disabled');
            $('.tax_returns_file_path_show').attr('disabled', 'disabled');

            $('.tax_returns_status_show').val(3).trigger('change.select2');
            $('.tax_returns_status_show').attr('disabled', 'disabled');
            $('.generate_form_7004_show').attr('disabled', 'disabled');
            $('.generate_file_show').attr('disabled', 'disabled');
        }

        function undisabled_tax_return_filds_show(){
            $('.tax_returns_status_show').removeAttr('disabled');
            $('.generate_form_7004_show').removeAttr('disabled');
            $('.generate_file_show').removeAttr('disabled');
            $('.filing_extension_show').removeAttr('disabled');
            $('.filing_extension_link_show').removeAttr('disabled');
            $('.file_link_file_input_show').removeAttr('disabled');
            $('.tax_returns_file_path_show').removeAttr('disabled');
        }

        $('.LLC_Tax_Status_for_This_Tax_Year_show').on("change", function (e) {
                
                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                let company_type =  $('.company_type_for_tax_returns').val();
                let Company_Status_for_this_Tax_Year_new = $('.tax_returns_company_status_show').val();
        
                if(select_val == 3){
                    $('.tax_return_type_show').val(1).trigger('change.select2');
                  undisabled_tax_return_filds_show()
                }
                if(select_val == 4){
                    $('.tax_return_type_show').val(3).trigger('change.select2');
                  undisabled_tax_return_filds_show()
                }
                if(select_val == 2){
                    $('.tax_return_type_show').val(4).trigger('change.select2');
                  disabled_tax_return_filds_show();
                }
                if(Company_Status_for_this_Tax_Year_new == 1 && select_val == 1){
                    $('.tax_return_type_show').val(2).trigger('change.select2');
                  undisabled_tax_return_filds_show()
                }
                if((Company_Status_for_this_Tax_Year_new == 2 || Company_Status_for_this_Tax_Year_new == 3) && select_val == 1){
                    $('.tax_return_type_show').val(4).trigger('change.select2');
                  disabled_tax_return_filds_show();
                }
        
            })
            $('.tax_returns_company_status_show').on("change", function (e) {
                        
                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                // console.log(select_val);
                let company_type =  $('.company_type_for_tax_returns').val();
                if(company_type == 3){
                    if(select_val == 1 && $('.LLC_Tax_Status_for_This_Tax_Year_show').val() == 1){
                    $('.tax_return_type_show').val(2).trigger('change.select2');
                  undisabled_tax_return_filds_show()
                    }
                    if((select_val == 2 || select_val == 3) && $('.LLC_Tax_Status_for_This_Tax_Year_show').val() == 1){
                        $('.tax_return_type_show').val(4).trigger('change.select2');
                      disabled_tax_return_filds_show();
                    } 
                }
            })

        $('.generate_form_7004').on('click', function(){
            let tax_end = $(this).parents('.tax_return_form').find('.tax_returns_tax_end').val();
            let tax_start = $(this).parents('.tax_return_form').find('.tax_returns_tax_start').val()
            let company_id = '<?= !empty($company) ? $company->id : ''?>';
            let tax_return_type = $(this).parents('.tax_return_form').find('.tax_return_type').val();

            $(this).parent().find('.generate_file').val('');

            $(this).html('Loading ...')
            $(this).attr('disabled',true);
            $(this).parents('.tax_return_form').find('.form_7004_link').empty();

            $(this).parents('.tax_return_form').find('.filing_extension_link').val('');
            // return ;
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:'/edit_pdf',
                datatType : 'json',
                data: {company_id : company_id, tax_end : tax_end,tax_start:tax_start , tax_return_type: tax_return_type}, 
                success: (response) => {
                    if (response.code == 400) {
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

        // $('.Google_Drive_text').on('input', function(){
        //     let value = $(this).val();
        //     $('.Google_Drive_link').attr('href', value);
        //     $('.Google_Drive_img').removeClass('d-none');
        //     if(value == ''){
        //         $('.Google_Drive_img').addClass('d-none');
        //     }
        // })

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