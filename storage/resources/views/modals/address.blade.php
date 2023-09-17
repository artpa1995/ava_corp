<div class="modal " id="create_address">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Address</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_address')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Title</label>
                                <input type="text" name="title" class="form-control  mr-sm-2" id="">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Address Provider</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="address_provider" required>
                                        @foreach($address_providers as $address_provider)
                                            <option value="{{$address_provider->id}}">{{$address_provider->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Country</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="country_id" id="address_countries" required>
                                        @foreach($countries as $counrty)
                                            <option value="{{$counrty->id}}">{{$counrty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 d-none state_block">
                                <label class="mr-sm-2 state_title_new">State</label>
                                <div class="state_block_select">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">City</label>
                                <input type="text" name="city" class="form-control  mr-sm-2" id="" required>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Post Code / ZIP</label>
                                <input type="text" name="post_code_zip" class="form-control  mr-sm-2" id="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">House Number</label>
                                <input class="form-control" id="" name="house_number">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Street</label>
                                <input class="form-control" id="" name="street" required>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address 2</label>
                                <input class="form-control" id="" name="address_2">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Address 3</label>
                                <input class="form-control" id="" name="address_3">
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

@if(
!Route::currentRouteNamed('addresses') && !Route::currentRouteNamed('address_by_url'))
    <div class="modal " id="chose_address">
        <div class="modal-dialog mt-5 modal-md">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Main Address</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('add_relation_address')}}" method="POST">
                        @csrf
                        <input type="hidden" name="page_url" value="{{$url}}" id="page_url">
                        <input type="hidden" name="page_id" value="{{$id}}"  id="page_id">
                        <input type="hidden" name="relation_address_id" class="relation_address_id">
                        <input type="hidden" name="entery_manual" id="entery_manual_address_type_main" value="">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <input type="radio" id="address_provider_entry_main" name="manual_entry_or_address_provider" value="1" class="entery_address_type_main" >
                                <label for="address_provider_entry_main" >Address Provider</label>
                            </div>
                            <div class="col-4 mb-2">
                                <input type="radio" id="manual_entry_main" name="manual_entry_or_address_provider" value="2" class="entery_address_type_main">
                                <label for="manual_entry_main" >Manual entry</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="address_provider_entered_block">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2">Address Provider</label>
                                        <div>
                                            <select class="select2 custom-select form-control " name="address_provider" id="address_provider_main">
                                                @foreach($address_providers as $address_provider)
                                                    <option value="{{$address_provider->id}}">{{$address_provider->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label  class="mr-sm-2">Address</label>
                                        <div>
                                            <select class="select2 custom-select form-control choose_address_data" name="address_id" id="main_address_id" required>
                                                <option value=""></option>
                                                @foreach($all_addresses as $key => $address)
                                                <option  value="{{$address->id}}" data-all_address_data="{{$address}}" >
                                                        {{$address->title??"Unknown name"}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 address_all_data_show">

                                    </div>
                                </div>
                            </div>
                            <div class="manual_entered_block">
                                {{-- <input type="hidden" name="entery_manual" id="entery_manual_address_type" value=""> --}}

                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >House Number</label>
                                        <input type="text" name="house_number" class="form-control manual_house_number">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Street</label>
                                        <input type="text" name="manual_street" class="form-control manual_street">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Address 2</label>
                                        <input type="text" name="manual_address2" class="form-control manual_address2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Address 3</label>
                                        <input type="text" name="manual_address3" class="form-control manual_address3">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >City</label>
                                        <input type="text" name="manual_city" class="form-control manual_city">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Post Code</label>
                                        <input type="text" name="manual_zip_code" class="form-control manual_zip_code">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Region</label>
                                        <input type="text" name="manual_region" class="form-control manual_region">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Country</label>
                                        <div>
                                            <select class="select2 custom-select form-control " name="country_id" id="address_countries_manual">
                                                @foreach($countries as $counrty)
                                                    <option value="{{$counrty->id}}">{{$counrty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-none state_block_main">
                                        <label class="mr-sm-2 state_title_new_main">State</label>
                                        <div class="state_block_select_main">
                                           
                                        </div>
                                    </div>
                                </div>
                                


                            </div>
                            <div class="row mb-3">
                                <div class="col-12 mb-2">
                                    <input type="checkbox" name="address_type" value="1" id="main_address_type">
                                    <label class="mr-sm-2" for="main_address_type">This is the main address</label>
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

    <div class="modal " id="use_address">
        <div class="modal-dialog mt-5 modal-md">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Use Address</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('new_relation_address')}}" method="POST">
                        @csrf
                        <input type="hidden" name="page_url" value="{{$url}}" id="page_url">
                        <input type="hidden" name="page_id" value="{{$id}}"  id="page_id">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <input type="radio" id="address_provider_entry" name="manual_entry_or_address_provider" value="1" class="entery_address_type" checked>
                                <label for="address_provider_entry" >Address Provider</label>
                            </div>
                            <div class="col-4 mb-2">
                                <input type="radio" id="manual_entry" name="manual_entry_or_address_provider" value="2" class="entery_address_type">
                                <label for="manual_entry" >Manual entry</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="manual_entry d-none ">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >House Number</label>
                                        <input type="text" name="house_number" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Street</label>
                                        <input type="text" name="manual_street" class="form-control manual_street_use">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Address 2</label>
                                        <input type="text" name="manual_address2" class="form-control manual_address2_use">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Address 3</label>
                                        <input type="text" name="manual_address3" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >City</label>
                                        <input type="text" name="manual_city" class="form-control manual_city_use">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Post Code</label>
                                        <input type="text" name="manual_zip_code" class="form-control manual_zip_code_use">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Region</label>
                                        <input type="text" name="manual_region" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2" >Country</label>
                                        <div>
                                            <select class="select2 custom-select form-control country_id_use" name="country_id" id="address_countries">
                                                <option value=""></option>
                                                @foreach($countries as $counrty)
                                                    <option value="{{$counrty->id}}">{{$counrty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-none state_block">
                                    <label class="mr-sm-2 state_title_new">State</label>
                                    <div class="state_block_select">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="entry_address_provider">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="mr-sm-2">Address Provider</label>
                                        <div>
                                            <select class="select2 custom-select form-control" name="address_provider" id="address_provider" required>
                                                @foreach($address_providers as $address_provider)
                                                    <option value="{{$address_provider->id}}">{{$address_provider->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label  class="mr-sm-2">Address</label>
                                        <div>
                                            <select class="select2 custom-select form-control choose_address_data" name="address_id" id="address_id" required>
                                            <option value=""></option>
                                            @foreach($all_addresses as $key => $all_address)
                                                @if(!$all_address->entery_type)
                                                    <option  value="{{$all_address->id}}" data-all_address_data="{{$all_address}}" >
                                                        {{$all_address->title??"Unknown name"}}
                                                        {{-- {{$all_address->address_1?$all_address->address_1."," :""}} 

                                                        {{$all_address->address_2?$all_address->address_2."," :""}} 
                                                        {{$all_address->address_3? $all_address->address_3.",":""}}
                                                        {{$all_address->post_code_zip? $all_address->post_code_zip." ":""}}
                                                        {{$all_address->city? $all_address->city.",":""}}
                                                        {{$all_address->state && $all_address->state->name? $all_address->state->name.',':""}}
                                                        {{$all_address->country && $all_address->country->name?$all_address->country->name.",":""}} --}}
                                                    </option>
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 address_all_data_show">

                                    </div>
                                </div>
                            </div>
                            
                           
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="checkbox" name="address_type" value="1" id="new_main_address_type">
                                    <label class="mr-sm-2" for="new_main_address_type">This is the main address</label>
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

@endif


<div class="modal " id="edit_address">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit address</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('update_address_edit')}}" method="POST">
                    @csrf
                    <input type="hidden" name="address_id" class="address_id">
                    <div class="">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label  class="mr-sm-2">Title</label>
                                <input type="text" class="form-control edit_address_title" name="title" value="">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Address Provider</label>
                                <div>
                                    <select class="select2 custom-select form-control edit_address_address_provider" name="address_provider" required>
                                        @foreach($address_providers as $address_provider)
                                            <option value="{{$address_provider->id}}" >
                                                {{$address_provider->title??""}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label  class="mr-sm-2">Country</label>
                                <div>
                                    <select  class="select2 custom-select form-control edit_address_country" name="country_id" required>
                                        @foreach($countries as $counrty)
                                            <option value="{{$counrty->id}}" >{{$counrty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6  edit_address_state_block d-none">
                                <label class="mr-sm-2 state_title_edit">State</label>
                                <div class="edit_state_block_select">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label  class="mr-sm-2">City</label>
                                <input type="text" name="city" class="form-control  mr-sm-2 edit_address_city" id="" value="" required>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Post Code / ZIP</label>
                                <input type="text" name="post_code_zip" class="form-control  mr-sm-2 edit_address_post_code_zip" id="" value="" required>
                            </div>
                        </div>    
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="mr-sm-2" >House Number</label>
                                <input type="text" name="house_number" class="form-control edit_address_house_number" value="">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2" >Street</label>
                                <input type="text" name="street" class="form-control edit_address_street" value="" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label  class="mr-sm-2">Address 2</label>
                                <input class="form-control edit_address_address_2" id="" name="address_2" value="">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Address 3</label>
                                <input class="form-control edit_address_address_3" id="" name="address_3" value="">
                            </div>
                            
                            <div class="col-6 edit_address_region_block d-none">
                                <label  class="mr-sm-2">Region</label>
                                <input class="form-control edit_address_region" id="" name="region" value="">
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


        $(document).on('click', '.edit_address_once', function () {
            let data =  $(this).data('address_once');

            $('.address_id').val('');
            if(data.id){
                $('.address_id').val(data.id); 
            }
            $('.edit_address_title').val('');
            if(data.title){
                $('.edit_address_title').val(data.title); 
            }

            $('.edit_address_city').val('');
            if(data.city){
                $('.edit_address_city').val(data.city); 
            }
            $('.edit_address_post_code_zip').val('');
            if(data.post_code_zip){
                $('.edit_address_post_code_zip').val(data.post_code_zip); 
            }

            $('.edit_address_house_number').val('');
            if(data.house_number){
                $('.edit_address_house_number').val(data.house_number); 
            }

            $('.edit_address_street').val('');
            if(data.street){
                $('.edit_address_street').val(data.street); 
            }

            $('.edit_address_address_2').val('');
            if(data.address_2){
                $('.edit_address_address_2').val(data.address_2); 
            }

            $('.edit_address_address_3').val('');
            if(data.address_3){
                $('.edit_address_address_3').val(data.address_3); 
            }

            $('.edit_address_region').val('');
            $('.edit_address_region_block').addClass('d-none')
            if(data.region){
                $('.edit_address_region').val(data.region); 
                $('.edit_address_region_block').removeClass('d-none')
            }

            $('.edit_address_address_provider').val(1).trigger('change.select2');
            if(data.address_provider){
                $('.edit_address_address_provider').val(data.address_provider.id).trigger('change.select2');
            }
            
            $('.edit_address_country').val(1).trigger('change.select2');
            if(data.country){
                $('.edit_address_country').val(data.country.id).trigger('change.select2');
                if(data.state_id || data.county_id ){
                    let state_id = data.state_id;
                    let county_id = data.county_id;
                    let state_block_select = $('.edit_state_block_select');
                    let state_block = $('.edit_address_state_block');

                    let country_id = data.country.id;
                    if(!state_block.hasClass('d-none')){
                        state_block.addClass('d-none');
                    }
                    $('.state_title_edit').html('');
                    state_block_select.empty();
                    $.ajax({
                        url:'/get_states',
                        type:"post",
                        datatType : 'json',
                        data: {'id':country_id,  "_token": "{{ csrf_token() }}"}, 
                        datatType : 'json',
                        success: (response) => {
                            if (response.code == 400) {

                            }else if(response.code == 200){
                                let states = response.msg;
                                let select = '<select  class="select_span_style select2 custom-select form-control state_select_ edit_address_state" name="state_id">';

                                if(country_id == 5){
                                    $('.state_title_edit').html('County');
                                    select = '<select  class="select_span_style select2 custom-select form-control state_select_ edit_address_state" name="county_id">';
                                    states.map((v,i)=>{
                                        select += `<optgroup label="${v.name}"> value="${v.id}" data-id="${v.country_id}" ">`;
                                            v.county.map((c,j)=>{
                                                select += `<option value="${c.id}" data-id="" class="state_items">${c.name}</option>`
                                            })

                                        select += `</optgroup>`;
                                    })
                                }else{
                                    $('.state_title_edit').html('State');
                                    states.map((v,i)=>{
                                    select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                                    })
                                }
                                select += '</select>'
                                
                                $('.state_select_').each(function(){
                                    $(this).select2({
                                        dropdownParent:  $(this).parent()
                                    });
                                })
                                state_block_select.append(select);
                                state_block.removeClass('d-none');
                                $('.edit_address_state').val(1).trigger('change.select2');
                                if(country_id == 5){
                                    $('.edit_address_state').val(county_id).trigger('change.select2');
                                }else{
                                    $('.edit_address_state').val(state_id).trigger('change.select2');
                                }
                                
                            }
                        }
                    })
                }
            }

        })

        $(".edit_address_country").on("change", function (e) {
                
                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                let state_block_select = $('.edit_state_block_select');
                let state_block = $('.edit_address_state_block');

                if(!state_block.hasClass('d-none')){
                    state_block.addClass('d-none');
                }
                state_block_select.empty();
                $.ajax({
                    url:'/get_states',
                    type:"post",
                    datatType : 'json',
                    data: {'id':select_val,  "_token": "{{ csrf_token() }}"}, 
                    datatType : 'json',
                    success: (response) => {
                        if (response.code == 400) {
                        }else if(response.code == 200){
                            let states = response.msg;
                            let select = '<select class="select_span_style select2 custom-select form-control state_select_" name="state_id">';
                            if(select_val == 5){
                                select = '<select class="select_span_style select2 custom-select form-control state_select_" name="county_id">';
                                states.map((v,i)=>{
                                    select += `<optgroup label="${v.name}"> value="${v.id}" data-id="${v.country_id}" ">`;

                                        v.county.map((c,j)=>{
                                            select += `<option value="${c.id}" data-id="" class="state_items">${c.name}</option>`
                                            
                                        })

                                    select += `</optgroup>`;
                                })
                            }else{
                                states.map((v,i)=>{
                                select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                                })
                            }
                            select += '</select>'
                            state_block_select.append(select);
                            state_block.removeClass('d-none')
                            $('.state_select_').each(function(){
                                $(this).select2({
                                    dropdownParent:  $(this).parent()
                                });
                            })
                        }
                    }
                })
            });

        $('.entery_address_type').on('click', function(){
            if( $(this).is(':checked') && $(this).val() == 2){
                $('.entry_address_provider').addClass('d-none');
                $('.manual_entry').removeClass('d-none');
                $('#address_id').removeAttr('required');
                $('.manual_street_use').attr('required', 'required');
                $('.manual_city_use').attr('required', 'required');
                $('.manual_zip_code_use').attr('required', 'required');
                $('.country_id_use').attr('required', 'required');
            }else{
                $('.entry_address_provider').removeClass('d-none');
                $('.manual_entry').addClass('d-none'); 
                $('#address_id').attr('required', 'required')
                $('.manual_street_use').removeAttr('required');
                $('.manual_city_use').removeAttr('required');
                $('.manual_zip_code_use').removeAttr('required');
                $('.country_id_use').removeAttr('required'); 
            }
        })
        
        $('.use_new_main_addres').on('click', function(){
            $('.address_all_data_show').empty();
            $('.state_block_select').empty();
        })

        $('.choose_address_data').on('change', function(){
            let all_data  = $(this).find(':selected').data('all_address_data');
            let country_id = all_data.country_id? all_data.country_id : '';
            let address_2 = all_data.address_2? all_data.address_2 : '';
            let address_3 = all_data.address_3? all_data.address_3 : '';
            let region = all_data.region? all_data.region : '';
            let country = all_data.country? all_data.country.name : '';
            let county = all_data.county? all_data.county.name : '';
            let state = all_data.state? all_data.state.abbreviation : '';
            let street = all_data.street? all_data.street : '';
            let post_code_zip = all_data.post_code_zip? all_data.post_code_zip : '';
            let city = all_data.city? all_data.city : '';
            let house_number = all_data.house_number? all_data.house_number : '';
            let uk_spec = [county,post_code_zip].join(" ");
            let german_spec = [post_code_zip, city].join(" ");
            let usa_spec = [state,post_code_zip].join(" ");

            let usa_array = [[house_number,street], address_2,address_3,city,usa_spec,country];
            let uk_array = [[house_number,street], address_2,address_3,city,uk_spec,country];
            let Germany_Switzerland_Austria_array = [[street,house_number], address_2,address_3,german_spec,country];
            let  All_other_countries = [[house_number,street], address_2, address_3, city, post_code_zip, country];

            let data = '';
            if(country_id && country_id == 4){
                data = get_address_data(usa_array);
            }else if(country_id && country_id == 5){
                data = get_address_data(uk_array);
            }else if(country_id && (country_id == 55 || country_id == 3 || country_id == 18)){
                data = get_address_data(Germany_Switzerland_Austria_array);
            }else{
                data = get_address_data(All_other_countries);
            }    

            $('.address_all_data_show').empty();
            $('.address_all_data_show').append('<p>'+data+'</p>');
        })

        function get_address_data(array){
           array =  array.filter(checkAdult);
            function checkAdult(item) {
                return item != '';
            }
            let first_path = array[0];
            let text = array.join(",");
            let fist_element = '';
            if(first_path.join(" ") != ' '){
                fist_element = first_path.join(" ")+', ';
            }
           return fist_element+array.slice(1).join(", ");

        }
        $('.entery_address_type_main').on('click', function (){
            // console.log($(this).val());
            // $('#entery_manual_address_type_main').val('')
            if( $(this).is(':checked') && $(this).val() == 2){
                $('.address_provider_entered_block').addClass('d-none');
                $('.manual_entered_block').removeClass('d-none');
                $('#address_id').removeAttr('required');
                $('.manual_street').attr('required', 'required');
                $('.manual_city').attr('required', 'required');
                $('.manual_zip_code').attr('required', 'required');
                $('.country_id').attr('required', 'required');
                // $('#entery_manual_address_type_main').val('2')
            }else{
                $('.address_provider_entered_block').removeClass('d-none');
                $('.manual_entered_block').addClass('d-none'); 
                $('#address_id').attr('required', 'required')
                $('.manual_street').removeAttr('required');
                $('.manual_city').removeAttr('required');
                $('.manual_zip_code').removeAttr('required');
                $('.country_id').removeAttr('required'); 
                // $('#entery_manual_address_type_main').val('1')
            }
        })

        $('.main_address').on('click',function(){
            let data =  $(this).data('all-data');
            let address_relation_id = $(this).data('address_relation_id');
            // console.log(data);
            $('#entery_manual_address_type').val('')

            $('#entery_manual_address_type_main').val('')
            let address_provider_entered_block = $('.address_provider_entered_block');
            let manual_entered_block = $('.manual_entered_block');

            let manual_street  = $('.manual_street');
            $('.manual_house_number').val('');
            $('.manual_address1').val('');
            $('.manual_address2').val('');
            $('.manual_address3').val('');
            $('.manual_city').val('');
            $('.manual_zip_code').val('');
            $('.manual_region').val('');
            $('#address_countries_manual').val(1).trigger('change.select2');
            $('.state_block_main').addClass('d-none');
            
            if(data.entery_type){
                $('#entery_manual_address_type_main').val('2')
                address_provider_entered_block.addClass('d-none');
                manual_entered_block.removeClass('d-none');
                $('#entery_manual_address_type').val('1');
                $('#manual_entry_main').trigger('click');

                let manual_street  = $('.manual_street');
                let house_number  = $('.manual_house_number');
                let manual_address1  = $('.manual_address1');
                let manual_address2 = $('.manual_address2');
                let manual_address3 = $('.manual_address3');
                let manual_city = $('.manual_city');
                let manual_zip_code = $('.manual_zip_code');
                let manual_region = $('.manual_region');
                let address_countries_manual = $('#address_countries_manual');
          
                if(data.country_id){
                    address_countries_manual.val(data.country_id).trigger('change.select2');
                    if(data.state_id || data.county_id ){
                        let state_id = data.state_id;
                        let county_id = data.county_id;
                        let state_block_select = $('.state_block_select_main');
                        let state_block = $('.state_block_main');

                        let country_id = data.country.id;
                        if(!state_block.hasClass('d-none')){
                            state_block.addClass('d-none');
                        }
                        $('.state_title_new_main').html('');
                        state_block_select.empty();
                        $.ajax({
                            url:'/get_states',
                            type:"post",
                            datatType : 'json',
                            data: {'id':country_id,  "_token": "{{ csrf_token() }}"}, 
                            datatType : 'json',
                            success: (response) => {
                                if (response.code == 400) {

                                }else if(response.code == 200){
                                    let states = response.msg;
                                    let select = '<select  class="select_span_style select2 custom-select form-control state_select_  address_state_main" name="state_id">';

                                    if(country_id == 5){
                                        $('.state_title_new_main').html('County');
                                        select = '<select  class="select_span_style select2 custom-select form-control state_select_  address_state_main" name="county_id">';
                                        states.map((v,i)=>{
                                            select += `<optgroup label="${v.name}"> value="${v.id}" data-id="${v.country_id}" ">`;
                                                v.county.map((c,j)=>{
                                                    select += `<option value="${c.id}" data-id="" class="state_items">${c.name}</option>`
                                                })

                                            select += `</optgroup>`;
                                        })
                                    }else{
                                        $('.state_title_new_main').html('State');
                                        states.map((v,i)=>{
                                        select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                                        })
                                    }
                                    select += '</select>'
                                    
                                    $('.state_select_').each(function(){
                                        $(this).select2({
                                            dropdownParent:  $(this).parent()
                                        });
                                    })
                                    state_block_select.append(select);
                                    state_block.removeClass('d-none');
                                    $('.address_state_main').val(1).trigger('change.select2');
                                    if(country_id == 5){
                                        $('.address_state_main').val(county_id).trigger('change.select2');
                                    }else{
                                        $('.address_state_main').val(state_id).trigger('change.select2');
                                    }
                                    
                                }
                            }
                        })
                    }
                }
                if(data.address_1){
                    manual_address1.val(data.address_1);
                }
                if(data.address_2){
                    manual_address2.val(data.address_2);
                }
                if(data.address_3){
                    manual_address3.val(data.address_3);
                }

                if(data.city){
                    manual_city.val(data.city);
                }
                if(data.post_code_zip){
                    manual_zip_code.val(data.post_code_zip);
                }
                if(data.region){
                    manual_region.val(data.region);
                }
                if(data.street){
                    manual_street.val(data.street);
                }
                if(data.house_number){
                    house_number.val(data.house_number);
                }


            }else{
                $('#entery_manual_address_type_main').val('1')
                $('#address_provider_entry_main').trigger('click');
                address_provider_entered_block.removeClass('d-none');
                manual_entered_block.addClass('d-none');
            }
            $('.relation_address_id').val('');

            if(address_relation_id){
                $('.relation_address_id').val(address_relation_id);
            }

            let page_id = $('#page_id').val();
            let page_url = $('#page_url').val()+'_id';
            // let address = $('#address_id');
            let address_provider = $('#address_provider');

            // address_provider.val(0).trigger('change.select2');
            // address.val(0).trigger('change.select2');
            // address_provider.val(data.address_provider).trigger('change.select2');

            if($('#address_provider_main') && data.address_provider){
                let address_provider_main = $('#address_provider_main');
                address_provider_main.val(0).trigger('change.select2');
                address_provider_main.val(data.address_provider).trigger('change.select2');
            }

            if($('#main_address_id') && data.id){
                let main_address_id = $('#main_address_id');
                main_address_id.val(0).trigger('change.select2');
                main_address_id.val(data.id).trigger('change.select2');
            }
            
            $('#main_address_type').removeAttr('checked')

            if(data.id){
                // address.val(data.id).trigger('change.select2');
            }

            if(data.address_relation){
                data.address_relation.map((v,i)=>{
                    if(v[page_url] == page_id){
                        if(v.address_type == 1){
                            $('#main_address_type').attr('checked', 'checked')
                        }
                    }
                })
            }
            let state_name = '';
            if(data.state && data.state.abbreviation){
                state_name = data.state.abbreviation+" ";
            }
            let country_name = '';
            if(data.country && data.country.name){
                country_name = data.country.name
            }

            let country_id = data.country_id? data.country_id : '';
            let address_2 = data.address_2? data.address_2 : '';
            let address_3 = data.address_3? data.address_3 : '';
            let region = data.region? data.region : '';
            let country = data.country? data.country.name : '';
            let county = data.county? data.county.name : '';
            let state = data.state? data.state.abbreviation : '';
            let street = data.street? data.street : '';
            let post_code_zip = data.post_code_zip? data.post_code_zip : '';
            let city = data.city? data.city : '';
            let house_number = data.house_number? data.house_number : '';
            let uk_spec = [county,post_code_zip].join(" ");
            let german_spec = [post_code_zip, city].join(" ");
            let usa_spec = [state,post_code_zip].join(" ");
            let usa_array = [[house_number,street], address_2,address_3,city,usa_spec,country];
            let uk_array = [[house_number,street], address_2,address_3,city,uk_spec,country];
            let Germany_Switzerland_Austria_array = [[street,house_number], address_2,address_3,german_spec,country];
            let  All_other_countries = [[house_number,street], address_2, address_3, city, post_code_zip, country];

            let data_text = '';
            if(country_id && country_id == 4){
                data_text = get_address_data(usa_array);
            }else if(country_id && country_id == 5){
                data_text = get_address_data(uk_array);
            }else if(country_id && (country_id == 54 || country_id == 3 || country_id == 17)){ // bazaneri 54 german 17 shwi
                data_text = get_address_data(Germany_Switzerland_Austria_array);
            }else{
                data_text = get_address_data(All_other_countries);
            }

            $('.address_all_data_show').empty();
            $('.address_all_data_show').append('<p>'+data_text+'</p>');
        })

        $("#address_countries, #address_countries_manual").on("change", function (e) {
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();
            let state_items = $('.state_items');
            let state_block = $('.state_block');
            let state_block_select = $('.state_block_select')
            $('.state_title_new').html('')

            state_block_select.empty();
            $.ajax({
                
                url:'/get_states',
                type:"post",
                datatType : 'json',
                data: {'id':select_val,  "_token": "{{ csrf_token() }}"}, 
                datatType : 'json',
                success: (response) => {
                        if (response.code == 400) {
                        }else if(response.code == 200){
                            let states = response.msg;
                            let select = '<div><select  class="select_span_style select2 custom-select form-control state_select_" name="state_id">';
                            if(select_val == 5){
                                $('.state_title_new').html('County')
                                select = '<div><select  class="select_span_style select2 custom-select form-control state_select_" name="county_id">';
                                states.map((v,i)=>{
                                    select += `<optgroup label="${v.name}"> value="${v.id}" data-id="${v.country_id}" ">`;

                                        v.county.map((c,j)=>{
                                            select += `<option value="${c.id}" data-id="" class="state_items">${c.name}</option>`
                                            
                                        })

                                    select += `</optgroup>`;
                                })
                            }else{
                                $('.state_title_new').html('State')
                                states.map((v,i)=>{
                                select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                                })
                            }
                            select += '</select></div>'
                            state_block_select.append(select);
                            state_block.removeClass('d-none')
                            $('.state_select_').each(function(){
                                $(this).select2({
                                    dropdownParent:  $(this).parent()
                                });
                            })
                        }
                    }
            })
        });
        $("#address_countries_manual").on("change", function (e) {
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();
            let state_items = $('.state_items_main');
            let state_block = $('.state_block_main');
            let state_block_select = $('.state_block_select_main')
            $('.state_title_new_main').html('')

            state_block_select.empty();
            $.ajax({
                
                url:'/get_states',
                type:"post",
                datatType : 'json',
                data: {'id':select_val,  "_token": "{{ csrf_token() }}"}, 
                datatType : 'json',
                success: (response) => {
                    if (response.code == 400) {
                    }else if(response.code == 200){
                        let states = response.msg;
                        let select = '<div><select  class="select_span_style select2 custom-select form-control state_select_" name="state_id">';
                        if(select_val == 5){
                            $('.state_title_new_main').html('County')
                            select = '<div><select  class="select_span_style select2 custom-select form-control state_select_" name="county_id">';
                            states.map((v,i)=>{
                                select += `<optgroup label="${v.name}"> value="${v.id}" data-id="${v.country_id}" ">`;

                                    v.county.map((c,j)=>{
                                        select += `<option value="${c.id}" data-id="" class="state_items">${c.name}</option>`
                                        
                                    })

                                select += `</optgroup>`;
                            })
                        }else{
                            $('.state_title_new_main').html('State')
                            states.map((v,i)=>{
                            select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                            })
                        }
                        select += '</select></div>'
                        state_block_select.append(select);
                        state_block.removeClass('d-none')
                        $('.state_select_').each(function(){
                            $(this).select2({
                                dropdownParent:  $(this).parent()
                            });
                        })
                    }
                }
            })
        });
        $('.select2').each(function(){
            $(this).select2({
                dropdownParent:  $(this).parent()
            });
        })
    })
</script>