require('./bootstrap');
$(document).ready(function() {

    let collaps_show = $('.collaps_show');
    collaps_show.on('click', function(){
        let data =  $(this).data('target');
        let colapsed_icon = $(this).find('svg');
        if($( data ).hasClass( "show" )){
            colapsed_icon.css({ WebkitTransform: 'rotate(' + '-90' + 'deg)'});
            colapsed_icon.css({ '-moz-transform': 'rotate(' + '-90' + 'deg)'});
        }else{
            colapsed_icon.css({ WebkitTransform: 'rotate(' + '0' + 'deg)'});
            colapsed_icon.css({ '-moz-transform': 'rotate(' + '0' + 'deg)'});
        }

    })

    if($( '.upov_max_height > div' ).length < 4){
        $('.upov_max_height_button').hide();
    }
    $('.upov_max_height_button').click(()=>{
        $('.upov_max_height_button').hide();
        $('.upov_max_height .hidden-event').removeClass('hidden-event');
    })



});

$(document).ready(function(){
 
    // image preview
    $("#profile_image").change(function(){
        let reader = new FileReader();
 
        reader.onload = (e) => {
            $("#image_preview_container").attr('src', e.target.result);
            $("#header__user_avatar").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    })
 
    $("#profile_setup_frm").submit(function(e){
        e.preventDefault();
 
        var formData = new FormData(this);

        let password = formData.get('password');
        let con_passsword = formData.get('confirm_password')
        if(password !== con_passsword){
            $("#res").html('<span class="alert alert-danger">Passwords do not match</span>');
            $("#profile_btn").attr("disabled", false);
            $("#profile_btn").html("Save Profile");
            return ;
        }
     
    $("#res").html('');

 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#profile_btn").attr("disabled", true);
        $("#profile_btn").html("Updating...");
        $.ajax({
            type:"POST",
            url: this.action,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.code == 400) {
                    let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                    $("#res").html(error);
                    $("#profile_btn").attr("disabled", false);
                    $("#profile_btn").html("Save Profile");
                }else if(response.code == 200){
                    let success = '<span class="alert alert-success">'+response.msg+'</span>';
                    $("#res").html(success);
                    $("#profile_btn").attr("disabled", false);
                    $("#profile_btn").html("Save Profile");
                }
            }
        })
    });

    const copyToClipboard = str => {
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };
    $('.copy_button').on('click', function(){
        $('.myTooltip').html('Copy to clipboard');
        let copyText = $(this).parent().find(".file_link");
        $(this).find('#myTooltip').html('Copied')

        copyToClipboard( copyText.val() );
    })

    $(".address_type_select").select2().on("select2:select", function (e) {
        let selected_element = $(e.currentTarget);
        let select_val = selected_element.val();
        let type = $(this).parent().parent().parent().parent().find('.chack_relation_address');
        type.attr("data-address-type", select_val);

        let page_id = type.data('page-id');
        let page_url = type.data('page-url');
        let address_id = type.val();
        let address_type = type.data('address-type');

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            
            url:'/add_relation_address',
            type:"post",
            datatType : 'json',
            data: {
                "page_id":page_id,
                "page_url":page_url,
                "address_id": address_id,
                "address_type":address_type,
                "_token": _token
            }, 
            datatType : 'json',
            success: (response) => {
            }
        })
    });

    $('.chack_relation_address').on('change', function(){

        let page_id = $(this).data('page-id');
        let page_url = $(this).data('page-url');
        let address_id = $(this).val();

        let address_type = $(this).data('address-type');

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            
            url:'/add_relation_address',
            type:"post",
            datatType : 'json',
            data: {
                "page_id":page_id,
                "page_url":page_url,
                "address_id": address_id,
                "address_type":address_type,
                "_token": _token
            }, 
            datatType : 'json',
            success: (response) => {
            }
        })
    })

    $('.create_file').on('change', function(){
        let company_id = '<?= $company->id?>';
        let file_data = $(this).prop("files")[0];
        let form_data = new FormData(); 
        form_data.append("file", file_data);
        form_data.append("file_type", $(this).attr('id'));
        form_data.append("company_id",company_id)

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type:"POST",
            // url:'/update_file_company',
            url:'/uploade_file_company',
        
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, 
            success: (response) => {
                if (response.code == 400) {
                }else if(response.code == 200){
                    let text = response.msg;
                    $(this).parent().find('.link_file').val(text)
                    // let origin = window.location.origin; 
                    // $(this).parent().find('.file_link').val(origin+'/storage/public/Files/'+text)
                    // $(this).parent().find('p').removeClass('d-none')
                    // $(this).parent().find('p').text(text);
                }
            }
        })

    })

    $('#month').on('change', function () {

        $('.months_day').empty();
        let days_count = new Date( new Date().getFullYear(), $(this).val(), 0).getDate();
        let select = '<select  class="select2 custom-select form-control" name="day">';
        for (let i = 1; i <= days_count; i++) {
            select += `<option value="${i}">${i}</option>`
        }
        select += '</select>'
        $('.months_day').append(select);

    })

    $('.create_notes').on('click', function () {
        setTimeout(function (){
            $('#notes_title').focus();
        }, 200);
    })

    function get_prev_year_LLC_Tax_Status_for_This_Tax_Year(obj,tax_end){
        tax_end = tax_end.slice(0, 4);
        for(let years of obj){
            years.tax_end = years.tax_end.slice(0, 4); 
            if(tax_end>years.tax_end && (tax_end - years.tax_end) == 1){
                return years.LLC_Tax_Status_for_This_Tax_Year;
            }
        }
        return 0;
    }

    function disabled_tax_return_filds(){
        $('.generate_form_7004').attr('disabled', 'disabled');
        $('.Tax_Return_Status_new').attr('disabled', 'disabled');
        $('.generate_file').attr('disabled', 'disabled');
        $('.filing_extension_file_input').attr('disabled', 'disabled');
        $('.filing_extension_link').attr('disabled', 'disabled');
        $('.file_link_new_tax_file_input').attr('disabled', 'disabled');
        $('.file_link_new_tax').attr('disabled', 'disabled');

        $('.Tax_Return_Status_new').val(3).trigger('change.select2');
        $('.generate_file').val('')
        $('.filing_extension_file_input').val('')
        $('.filing_extension_link').val('')
        $('.file_link_new_tax_file_input').val('')
        $('.file_link_new_tax').val('')
    }

    function undisabled_tax_return_filds(){
        $('.generate_form_7004').removeAttr('disabled');
        $('.Tax_Return_Status_new').removeAttr('disabled');
        $('.filing_extension_link').removeAttr('disabled')
        $('.generate_file').removeAttr('disabled')
        $('.filing_extension_file_input').removeAttr('disabled')
        $('.filing_extension_link').removeAttr('disabled')
        $('.file_link_new_tax_file_input').removeAttr('disabled')
        $('.file_link_new_tax').removeAttr('disabled')
    }

    $('.LLC_Tax_Status_for_This_Tax_Year').on("change", function (e) {
                
        let selected_element = $(e.currentTarget);
        let select_val = selected_element.val();
        let company_type =  $('.company_type_for_tax_returns').val();
        let Company_Status_for_this_Tax_Year_new = $('.Company_Status_for_this_Tax_Year_new').val();

        if(select_val == 3){
            $('.tax_return_type').val(1).trigger('change.select2');
            undisabled_tax_return_filds()
        }
        if(select_val == 4){
            $('.tax_return_type').val(3).trigger('change.select2');
            undisabled_tax_return_filds()
        }
        if(select_val == 2){
            $('.tax_return_type').val(4).trigger('change.select2');
            disabled_tax_return_filds()
        }
        if(Company_Status_for_this_Tax_Year_new == 1 && select_val == 1){
            $('.tax_return_type').val(2).trigger('change.select2');
            undisabled_tax_return_filds()
        }
        if((Company_Status_for_this_Tax_Year_new == 2 || Company_Status_for_this_Tax_Year_new == 3) && select_val == 1){
            $('.tax_return_type').val(4).trigger('change.select2');
            disabled_tax_return_filds()
        }

    })
    $('.Company_Status_for_this_Tax_Year_new').on("change", function (e) {
                
        let selected_element = $(e.currentTarget);
        let select_val = selected_element.val();
        // console.log(select_val);
        let company_type =  $('.company_type_for_tax_returns').val();
        if(company_type == 3){
            if(select_val == 1 && $('.LLC_Tax_Status_for_This_Tax_Year').val() == 1){
            $('.tax_return_type').val(2).trigger('change.select2');
            undisabled_tax_return_filds()
            }
            if((select_val == 2 || select_val == 3) && $('.LLC_Tax_Status_for_This_Tax_Year').val() == 1){
                $('.tax_return_type').val(4).trigger('change.select2');
                disabled_tax_return_filds()
            } 
        }
    })
    
    $(document).on('click', '.create_new_tax_returns', function(){
        let page_id = $('#id').val();
        let tax_end = $('#tax_returns_years_block').find('.select2').val();
        let status_date = $('.status_date').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        let star_date = removeOneYear(tax_end);
        $.ajax({
            url:'/get_prev_year',
                type:"post",
                datatType : 'json',
                data: {
                "page_id":page_id,
                "tax_end":star_date,
                "_token": _token
            },

            success:function(data){
                data = data.msg;

                if(data!=''){
                    let triggerObj = {
                        1:2,
                        2:4,
                        3:1,
                        4:3,
                    };

                    $('.LLC_Tax_Status_for_This_Tax_Year').val(data.LLC_Tax_Status_for_This_Tax_Year).trigger('change.select2');

                    $('.Company_Status_for_this_Tax_Year_new').val(data.company_status).trigger('change.select2');

                    let triggerKey = 2;
                    if(data.LLC_Tax_Status_for_This_Tax_Year !=''){
                        triggerKey = triggerObj[data.LLC_Tax_Status_for_This_Tax_Year];
                    }
                    if($('.Company_Status_for_this_Tax_Year_new').val() == 1 && LLC_Tax_Status_for_This_Tax_Year == 1){
                        triggerKey = 2;
                    }

                    $('.tax_return_type').val(triggerKey).trigger('change.select2');
                }
            }
        })

        let company_country_for_tax_returns = $('.company_country_for_tax_returns').val()
        let tax_returns_start_date = $('#tax_returns_start_date');
        let all_tax_year_prev = $('.all_tax_year_prev');
        let obj = JSON.parse(all_tax_year_prev.val());
        let LLC_Tax_Status_for_This_Tax_Year =  get_prev_year_LLC_Tax_Status_for_This_Tax_Year(obj,tax_end);
        let company_type =  $('.company_type_for_tax_returns').val();
        $('.tax_returns_tax_end').val(tax_end);

        if(company_type == 3){
            $('.LLC_Tax_Status_for_This_Tax_Year_block').removeClass('d-none');
            $('.LLC_Tax_Status_for_This_Tax_Year_exist').val(1);
            $('.LLC_Tax_Status_for_This_Tax_Year').val(1).trigger('change.select2');
            $('.tax_return_type').val(2).trigger('change.select2');
            if(LLC_Tax_Status_for_This_Tax_Year){
                $('.LLC_Tax_Status_for_This_Tax_Year').val(LLC_Tax_Status_for_This_Tax_Year).trigger('change.select2');

                if(LLC_Tax_Status_for_This_Tax_Year == 3){
                    $('.tax_return_type').val(1).trigger('change.select2');
                    undisabled_tax_return_filds()
                }else if(LLC_Tax_Status_for_This_Tax_Year == 4){
                    $('.tax_return_type').val(3).trigger('change.select2');
                    undisabled_tax_return_filds()
                }else if(LLC_Tax_Status_for_This_Tax_Year == 2){
                    $('.tax_return_type').val(4).trigger('change.select2');
                    disabled_tax_return_filds()
                }else if($('.Company_Status_for_this_Tax_Year_new').val() == 1 && LLC_Tax_Status_for_This_Tax_Year == 1){
                    $('.tax_return_type').val(2).trigger('change.select2');
                    undisabled_tax_return_filds()
                }else{
                    $('.tax_return_type').val(2).trigger('change.select2');
                }
            }
        }

        let company_types = ['2','5','6'];
        if(jQuery.inArray(company_type, company_types) !== -1 && company_country_for_tax_returns == 5){
            const date = new Date(tax_end);
            const newDateaddOneYear = addOneYear(date);
            $('.tax_returns_due_date').val(newDateaddOneYear)
        }

        let tax_returns_due_date = '';
        let UK2 = [3,4];
        let tax_returns_due_date_start = parseInt(tax_end.slice(0, 4)) + 1;
        if(company_country_for_tax_returns == 4){
            tax_returns_due_date = tax_returns_due_date_start +'-04-15';
            $('.tax_returns_due_date').val(tax_returns_due_date)
        }else if (company_country_for_tax_returns == 5 && jQuery.inArray(company_type, UK2) !== -1) {
            tax_returns_due_date = tax_returns_due_date_start +'-01-31';
            $('.tax_returns_due_date').val(tax_returns_due_date)
        }



        tax_returns_start_date.val(star_date)
        if(status_date > star_date){
            tax_returns_start_date.val(status_date)
        }
        $('.close_modal_tax_returns').trigger('click');
        $('.newtax_returns_modal_open').trigger('click');

    })

    function removeOneYear(date) {
        const dateCopy = new Date(date);
        dateCopy.setFullYear(dateCopy.getFullYear() - 1, dateCopy.getMonth(), dateCopy.getDate() + 1);
        return dateCopy.toISOString().slice(0, 10);
    }
   
    function addOneYear(date) {
        const dateCopy = new Date(date);
        dateCopy.setFullYear(dateCopy.getFullYear() + 1);
        return dateCopy.toISOString().slice(0, 10);
    }

    $('.select2').each(function(){
        $(this).select2({
            dropdownParent:  $(this).parent()
        });
    })

    $('.Google_Drive_text').on('input', function(){
        let value = $(this).val();
        $('.Google_Drive_link').attr('href', value);
        $('.Google_Drive_img').removeClass('d-none');
        if(value == ''){
            $('.Google_Drive_img').addClass('d-none');
        }
    })


    $('.wrong_tax').addClass('d-none');
    $('.no_tax').addClass('d-none');
    $('.tax_years_select').addClass('d-none');


    let titles = {
        'call' :  ["Call","Send Letter","Send Quote","Other"],
        'task' :  ["Call","Send Letter","Send Quote","Other"],
        'event' :  ["Call","Email","Meeting", "Send Letter/Quote","Other"],
    }
    window.onclick = function(event) {
        var subject_autocomplete = $('.subject_autocomplete');
        let flag = true;
        for (const key of subject_autocomplete) {
           if (event.target == key) {
            flag = false;
            }
        }
        if(flag){
            $('.subject_autocomplete_titles').addClass('d-none');
        }
   
    }

    $(document).on('click', '.subject_autocomplete_items', function(){
        let val = $(this).find('span').html();
        $(this).parents('.subject_autocomplete_block').find('.subject_autocomplete').val(val);
        $(this).parents('.subject_autocomplete_titles').addClass('d-none');
    })

    $('.subject_autocomplete').on('keyup focus',function(){
        let type = $(this).data('type');
        if(!type){
            return;
        }
        let title_array = [];
        if(titles[type]){
            title_array = titles[type];
        }
        let keyword = $(this).val();
        let subject_autocomplete_titles = $(this).parent().find('.subject_autocomplete_titles');
        subject_autocomplete_titles.removeClass('d-none')
        let subject_autocomplete_titles_ul =  $(this).parent().find('.subject_autocomplete_titles>ul');

        let li = '';
        if(keyword == '') {
            title_array.map((v,i)=>{
                    li += `<li class="subject_autocomplete_items"><span>${v}</span></li>`
                })
            subject_autocomplete_titles_ul.html(li);
        }else{
            keyword = keyword.toLowerCase()
            let filter_array = title_array.filter(item => item.toLowerCase().indexOf(keyword) > -1);
            subject_autocomplete_titles_ul.html('');
            filter_array.map((v,i)=>{
                    if(!v){
                        return;
                    }
                    li += `<li class="subject_autocomplete_items"><span>${v}</span></li>`; 
                })
            subject_autocomplete_titles_ul.html(li);
        }
    });

})


