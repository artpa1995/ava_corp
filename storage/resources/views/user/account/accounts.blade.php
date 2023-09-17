@extends('user.layout.app')
@section('title')Account @endsection
@section('contents')

    <div class="container-fluid  rounded   px-3">
        <div class="row">
            <div class="col-10">
                <h3 class="text-white accaunt_page_title">
                    {{-- All Accounts ({{$accounts->count()}}) --}}
                </h3>
            </div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#open_account">New</button>
            </div>
        </div>
    </div>
    @if(1>4)
    <div class="container-fluid mt-5 rounded bg-white py-3 px-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Account name</th>
                    {{-- <th>Parent Account</th> --}}
                    <th>Type</th>
                    {{-- <th>Industry</th> --}}
                    <th>Account phone</th>
                    {{-- <th>Account owner</th> --}}
                    <th>Google Drive</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as  $value)
                <tr >
                    <td>
                        <a href="{{ route('edit_account', [$value->id]) }}">
                            <div class="page_title_exchange_rate">
                                {{$value->name}}
                                @if(!empty($value->salesPerodical))
                                    <div class="exchange_rate_img">
                                        <img src="{{url('image/exchange-rate.png')}}" alt="">
                                    </div>
                                @endif
                                
                            </div>
                        </a>
                    </td>
                    {{-- <td>{{ $value->parentAccount->name ?? '' }}</td> --}}
                    <td>{{$value->accountTypes->name ?? '' }}</td>
                    {{-- <td>{{$value->industriesTypes->name ?? '' }}</td> --}}
                    <td>{{$value->account_phone}}</td>
                    {{-- <td>{{$value->ownerUser->first_name}}</td> --}}
                    <td>
                        @if($value->google_drive && $value->account_personality_type != 1)
                            <div class="Google_Drive_img_small">
                                <a href="{{$value->google_drive}}" class="" target="_blunk">
                                    <img src="{{url('image/Google_Drive.png')}}" alt="">
                                </a>
                            </div> 
                        @endif
                    </td>
                    <td>
                        {{-- <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Edit</button>
                        <div class="dropdown-menu"> --}}
                        <div class="d-flex justify-content-end">
                            <a class=" " style="" href="{{ route('edit_account', [$value->id]) }}">
                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                            </a>
                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_account', [$value->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                         </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
    {{-- <div class="container-fluid mt-5 rounded bg-white py-3 px-3"> --}}
        <div class="container-fluid mt-5  DT_container">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-hover account_table">
                    <thead>
                        <tr>
                            <th>Account name</th>
                            <th>Type</th>
                            <th>Account phone</th>
                            <th>Google Drive</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @include('modals.account')
@if(1>4)
    @foreach($accounts as  $value)
        <div class="modal edit_account" id="edit_account_{{$value->id}}">
            <div class="modal-dialog  mt-5 modal-lg">
                <div class="modal-content">
                    <div class="">
                        <div class="text-end pt-3 px-3" >
                            <button type="button" class="btn-close text-white close" data-dismiss="modal"></button>
                        </div>
                        <h4 class="modal-title text-center">Edit Account</h4>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <form class="" action="" method="POST">
                            @csrf
                            <div class="">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="personal_name" class="mr-sm-2">Account name:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Account name" name="name" value="{{$value->name}}" id="" required>
                                    </div>
                                    {{-- <div class="col-6" id="parent_id_select_2">
                                        <label for="parent_account" class="mr-sm-2">Parent account:</label>
                                        <select class="select2_2" name="parent_id" >
                                            <option selected>Select Parent Account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}"
                                                @if(!empty($value->parentAccount->id) && $account->id == $value->parentAccount->id) {{'selected'}} @else {{""}} @endif >{{$account->name}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    {{-- <div class="col-6">
                                        <label  class="mr-sm-2">Account owner:</label>
                                        <div> {{ Auth::user()->first_name }}</div>
                                    </div> --}}
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Type:</label>
                                        <select  class="custom-select" name="account_type_id" required>
                                            @foreach($account_types as  $account_type)
                                                <option value="{{$account_type->id}}" @if($account_type->id == $value->accountTypes->id) {{'selected'}} @else {{""}} @endif>{{$account_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Phone 1</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="{{$value->account_phone}}" name="account_phone" required>
                                    </div>
                                    <div class="col-6">
                                        {{-- <label  class="mr-sm-2">Industry:</label>
                                        <div>
                                            <select  class="custom-select" name="industry_id" required>
                                                @foreach($industries_types as  $industries_type)
                                                    <option value="{{$industries_type->id}}" @if($industries_type->id == $value->industriesTypes->id) {{'selected'}} @else {{""}} @endif>{{$industries_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-6">
                                        <label  class="mr-sm-2">Website:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Website" value="{{$value->website}}" name="website" >
                                    </div> --}}
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Phone 2</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" required placeholder="Phone" value="{{$value->additional_phone}}" name="additional_phone" >
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Description:</label>
                                        <textarea class="form-control" id="" rows="3"  name="description">{{$value->description}}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Employees:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" required value="{{$value->employees}}" name="employees" >
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 1 Street:</label>
                                        <textarea class="form-control" id="" rows="3" name="address_1_street" >{{$value->address_1_street}}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 2 Street:</label>
                                        <textarea class="form-control" id="" rows="3" name="address_2_street" >{{$value->address_2_street}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 1 Country:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_country}}" name="address_1_country" >
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 2 Country:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_country}}" name="address_2_country" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 1 City:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_city}}" name="address_1_city" >
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 2 City:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_city}}" name="address_2_city" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 1 State:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_state}}" name="address_1_state" >
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 2 State:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_state}}" name="address_2_state" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 1 zip code:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_zip_code}}" name="address_1_zip_code"  >
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Address 2 zip code:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_zip_code}}" name="address_2_zip_code" >
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
    @endforeach
@endif

    
    <!-- Modal -->
    @include('modals.delete_modal')

    @section('js')
        <script>

            $(function () {
                var table = $('.account_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('Dtaccounts') }}",
                    columns: [

                        {data: 'name', name: 'name', render:(data, i, row)=>{
                            if(row.additional_value){
                                $('.accaunt_page_title').text(row.additional_value);
                            }
                            let name = `<a href="/account/${row.id}"><div class="page_title_exchange_rate">${row.name}`;
                            if((row.sales_perodical)){
                                name +=`  
                                <div class="exchange_rate_img">
                                    <img src="{{url('image/exchange-rate.png')}}" alt="">
                                </div>`;
                            }
                            name +=`</div></a>`;
                            return name;
                        }},
                        {data: 'accountTypes', name: 'accountTypes'},
                        {data: 'account_phone', name: 'account_phone'},
                        {data: 'Google_Drive', name: 'Google_Drive', searchable: false,render:(data, i, row)=>{;
                            let name = '';
                            if(row.google_drive && row.account_personality_type != 1){
                                name = ` <div class="Google_Drive_img_small">
                                            <a href="${row.google_drive}" class="" target="_blunk">
                                                <img src="{{url('image/Google_Drive.png')}}" alt="">
                                            </a>
                                        </div> `;
                            }
                            return name;
                        }},
                        {data: 'action', name: 'action', orderable: false, searchable: false,render:(data, i, row)=>{
                            let name = `  <div class="d-flex justify-content-end">
                            <a  href="/account/${row.id}">
                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                            </a>
                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="delete_account/${row.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                         </div>`;
                            return name;
                        }},
                    ],
                    initComplete: function () {
                        var api = this.api();
                        
                        var recordsCount = api.page.info().recordsTotal;
                        if (recordsCount < 10) {
                            $('.dataTables_length').hide();
                            $('.dataTables_paginate').hide(); // Hide the pagination element
                        } else {
                            $('.dataTables_length').show();
                            $('.dataTables_paginate').show(); // Show the pagination element
                        }
                    },
                    language: {
                            processing: `<div class="DTloading"> <img src="{{url('image/loading.gif')}}" alt=""></div> `, // Custom loading message or indicator
                        },
                  
                });
            });

            $(document).ready(function(){

                $('.account_personality_type').change(()=>{
                    if( $('#personal_account').is(':checked') ){
                        $('#business_account_name').addClass('d-none');
                        $('#personal_account_name').removeClass('d-none');
                        $('#last_name').attr('required', 'required');
                        $('#first_name').attr('required', 'required');
                        // $('.account_classification_indevidual').removeClass('d-none');
                        $('.account_classification_bisnes').addClass('d-none');
                        $('.Primary_Tax_Registration_block').removeClass('d-none'); 
                    }else{
                        $('#last_name').removeAttr('required');
                        $('#first_name').removeAttr('required');
                        // $('.account_classification_indevidual').addClass('d-none');
                        $('.account_classification_bisnes').removeClass('d-none');
                        $('#business_account_name').removeClass('d-none');
                        $('#personal_account_name').addClass('d-none'); 
                        $('#account_name').val('');
                        $('.Primary_Tax_Registration_block').addClass('d-none'); 
                        
                    }
                })
            
                $('.personal_account_name').change(()=>{
                    $('#account_name').val('');
                    $('#account_name').val($('#last_name').val() + ", " + $('#first_name').val());
                })
            })
            $(document).ready(function() {
                $('.select2').each(function(){
                    $(this).select2({
                        dropdownParent:  $(this).parent()
                    });
                })
            });

        </script>
    @endsection

@endsection