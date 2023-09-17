@extends('user.layout.app')
@section('title')Edit Account @endsection
@section('contents')
@php
  $file_1 = '';
        $file_2 = '';
        $file_3 = '';
        $file_4 = '';
        $doc_type_1 = '';
        $doc_type_2 = '';
        $doc_type_3 = '';
        $doc_type_4 = '';
        foreach ($account->companyFiles as $file) {
            if ($file->file_type == 'file_path_1') {
                $file_1 = $file->path;
                $doc_type_1 =$file->doc_type;
            }
            if ($file->file_type == 'file_path_2') {
                $file_2 = $file->path;
                $doc_type_2 =$file->doc_type;
            }
            if ($file->file_type == 'file_path_3') {
                $file_3 = $file->path;
                $doc_type_3 =$file->doc_type;
            }
            if ($file->file_type == 'file_path_4') {
                $file_4 = $file->path;
                $doc_type_4 =$file->doc_type;
            }
        }

        $doc_types_array = [
            1 => 'W7 Form',
            2 => 'EIN CP 565 A Issuance',
            3 => 'IRS Refusal Letter',
            4 => 'IRS Correction Request Letter'
        ];
@endphp
    <div class="container-fluid mt-5">
        <div class="row-with-float">
            <div class="col-3 px-2 sticky-top">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div class="pb-2 account_title_block">
                        <h4>{{$account->name}}</h4>
                        @if($account->google_drive && $account->account_personality_type != 1)
                            <div class="Google_Drive_img_big" >
                                <a href="{{$account->google_drive}}" class="Google_Drive_link" target="_blunk">
                                    <img src="{{url('image/Google_Drive.png')}}" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                        <a  class="btn btn-outline-danger data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_account', [$account->id]) }}">Delete</a>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class="account_info_btn collaps_show py-2 px-2" data-toggle="collapse" data-target="#account_info_btn">
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        Account Information                        
                    </div>
                    <div id="account_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Account Classification</label>
                            <div>{{$account->account_personality_type == 1 ? "Business" : "Individual"}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Account name</label>
                            <div>{{$account->name}}</div>
                        </div>
                        {{-- <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Account owner</label>
                            
                            <div>{{$account->ownerUser->first_name??""}} {{$account->ownerUser->last_name??""}}</div>
                        </div> --}}
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Phone 1</label>
                            <div>{{$account->account_phone}}</div>
                        </div>
                        {{-- <div class="border-bottom mt-2 pt-1 px-2 {{$account->account_personality_type == 1 ? "" : "d-none"}}">
                            <label for="parent_account" class="mr-sm-2">Parent account</label>
                            <div>{{$account->parentAccount->name ?? ""}}</div>
                        </div> --}}
                        {{-- <div class="border-bottom mt-2 pt-1 px-2 {{$account->account_personality_type == 1 ? "" : "d-none"}}">
                            <label  class="mr-sm-2">Industry</label>
                            <div>{{$account->industriesTypes->name}}</div>
                        </div> --}}
                        <div class="border-bottom mt-2 pt-1 px-2 {{$account->account_personality_type == 0 ? "" : "d-none"}}">
                            <label  class="mr-sm-2">Email</label>
                            <div>{{$account->email}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6  ">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <ul class="nav nav-tabs  center_nav_active_style">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#menu1">Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">Marketing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">Service</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @include('notifications.forms')
                        <div class="tab-pane container fade" id="menu2">
                            <div class="col-12 mt-3 px-3">
                                <div class="account_info_btn collaps_show py-2 px-2 mt-3" data-toggle="collapse" data-target="#PrimaryTaxRegistration">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Primary Tax Registration
                                </div>
                                <div id="PrimaryTaxRegistration" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Registration Status</label>
                                                    @php
                                                    $registration_status_array = [
                                                            1=> 'Not Registered for Tax',
                                                            2=> 'Registered for Tax',
                                                            3=> 'Submitted. Awaiting Tax ID',
                                                        ];
                                                    @endphp

                                                    <div>
                                                        @if($account->registration_status )
                                                            {{$registration_status_array[$account->registration_status]}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Tax ID</label>
                                                    <div>{{$account->tax_id}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Tax Filing Code</label>
                                                    <div>{{$account->tax_filing_code}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Tax ID Type</label>
                                                    <div>{{$account->tax_id_type}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Status Date</label>
                                                    <div>{{$account->status_date?substr($account->status_date,0,10):""}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">{{$doc_type_1?$doc_types_array[$doc_type_1] :''}}</label>
                                                    <div class="break-word">
                                                        @if($file_1)
                                                            <a class="text-succsess"  href="{{$file_1}}" target="_blank">open</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">{{$doc_type_2?$doc_types_array[$doc_type_2] :''}}</label>
                                                    <div class="break-word">
                                                        @if($file_2)
                                                            <a class="text-succsess"  href="{{$file_2}}" target="_blank">open</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">{{$doc_type_3?$doc_types_array[$doc_type_3] :''}}</label>
                                                    <div class="break-word">
                                                        @if($file_3)
                                                            <a class="text-succsess"  href="{{$file_3}}" target="_blank">open</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">{{$doc_type_4?$doc_types_array[$doc_type_4] :''}}</label>
                                                    <div class="break-word">
                                                        @if($file_4)
                                                            <a class="text-succsess"  href="{{$file_4}}" target="_blank">open</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$account->account_personality_type)
                                    <div class=" account_info_btn collaps_show py-2 px-2 mt-3" data-toggle="collapse" data-target="#personal_details" >
                                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                        Personal Details
                                    </div>
                                    <div id="personal_details" class="collapse ">
                                        <div class=" mt-2 pt-1 px-2 pb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="border-bottom mt-2 py-1 px-2">
                                                        <label for="personal_name" class="mr-sm-2">Date of Birth</label>
                                                        <div>{{substr($account->bday,0,10)}}</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="border-bottom mt-2 py-1 px-2">
                                                        <label for="personal_name" class="mr-sm-2">Country of Citizenship</label>
                                                        <div>{{!empty($account->country) && $account->country->name ? $account->country->name : ""}}</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="border-bottom mt-2 py-1 px-2">
                                                        {{-- <label for="personal_name" class="mr-sm-2">Disabled</label> --}}
                                                        <div>{{!empty($account->disabled_field) && $account->disabled_field ? 'Disabled': "No Disabled"}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class=" account_info_btn collaps_show py-2 px-2 mt-3" data-toggle="collapse" data-target="#additional_info" >
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Communication Details
                                </div>
                                <div id="additional_info" class="collapse ">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                {{-- <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Website</label>
                                                    <div>{{$account->website}}</div>
                                                </div> --}}
                                                {{-- <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Description</label>
                                                    <div>{{$account->description}}</div>
                                                </div> --}}
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Phone 1</label>
                                                    <div>{{$account->account_phone}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Phone 2</label>
                                                    <div>{{$account->additional_phone}}</div>
                                                </div>
                                                {{-- <div class="border-bottom mt-2 pt-1 px-2 {{$account->account_personality_type == 1 ? "" : "d-none"}}">
                                                    <label for="personal_name" class="mr-sm-2">Employees</label>
                                                    <div>{{$account->employees}}</div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label  class="mr-sm-2">Email</label>
                                                    <div>{{$account->email}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label  class="mr-sm-2">Email 1</label>
                                                    <div>{{$account->email_1}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label  class="mr-sm-2">Email 2</label>
                                                    <div>{{$account->email_2}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label  class="mr-sm-2">Email 3</label>
                                                    <div>{{$account->email_3}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 py-1 px-2">
                                                    <label  class="mr-sm-2">Email 4</label>
                                                    <div>{{$account->email_4}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class=" account_info_btn collaps_show mt-3 py-2 px-2" data-toggle="collapse" data-target="#address_info" style="">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Address Information
                                </div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Address 1</label>
                                                    <div>{{$account->address_1_country}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Address 2</label>
                                                    <div>{{$account->address_2_country}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class=" account_info_btn collaps_show mt-3 py-2 px-2" data-toggle="collapse" data-target="#system_info" >
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    System Information
                                </div>
                                <div id="system_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div> Created By: {{ Auth::user()->first_name }}. {{$account->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->first_name }}. {{$account->updated_at}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu3">
                            @include('notifications.sales_block')
                        </div>
                        <div class="tab-pane container fade" id="menu4">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Companies ({{ $companies_count->count()}})</span>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Campaign influence ()</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu5">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Cases (0)</span>
                                    <div>
                                        <button class="btn btn-outline-primary" >Change Owner</button>
                                        <button class="btn btn-outline-primary" >New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('notifications.notifications')
                </div>
            </div>
            <div class="col-3 px-2 sticky-top">
                @include('notifications.options')
            </div>
        </div>
    </div>

    <div class="modal edit_account" id="edit_account">
        <div class="modal-dialog  mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3" >
                        <button type="button" class="btn-close text-white close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Edit Account</h4>
                </div>
                <div class="modal-body" id="modal-body">
                    <form class="" action="{{route('edit_account',[$account->id])}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row mb-2">
                                <div class="bg-light p-3 h6">Account Information</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Category</label>
                                    <div class="col-12 d-lg-flex gap-20">
                                        <div>
                                            <input required type="radio" class="account_personality_type" name="account_personality_type" value="1" id="business_account" {{$account->account_personality_type == 1 ? "checked" : ""}} >
                                            <label for="business_account" class="mr-sm-2">Business</label>
                                        </div>
                                        <div>
                                            <input required type="radio" class="account_personality_type" name="account_personality_type" value="0" id="personal_account" {{$account->account_personality_type == 0 ? "checked" : ""}}>
                                            <label for="personal_account" class="mr-sm-2">Individual</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Type</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="account_type_id" >
                                            @foreach($company_types_account as  $account_type)
                                                <option value="{{$account_type->id}}" @if($account_type->id == $account->accountTypes->id) {{'selected'}} @else {{""}} @endif>{{$account_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6  {{$account->account_personality_type == 1 ? "" : "d-none"}}" id="business_account_name">
                                    <label for="personal_name" class="mr-sm-2">Account name</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Account name" name="name" value="{{$account->name}}"  id="account_name" required>
                                </div>
                                <div class="col-6  {{$account->account_personality_type == 0 ? "" : "d-none"}}" id="personal_account_name">
                                    @php
                                        if($account->account_personality_type == 0){
                                            $last_name = substr($account->name, 0, strpos($account->name, ',')); 
                                            $first_name = substr($account->name, strpos($account->name, ",") + 2);
                                        }
                                    @endphp
                                    <label for="personal_name" class="mr-sm-2">First name</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2 personal_account_name" placeholder="First name"  value="{{$first_name ?? ""}}" {{!empty($first_name) ? 'required' : ""}} id="first_name">
                                    <label for="personal_name" class="mr-sm-2">Last name</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2 personal_account_name" placeholder="Last name"  value="{{$last_name ?? ""}}" {{!empty($last_name) ? 'required' : ""}} id="last_name">
                                </div>
                                {{-- <div class="col-6 account_classification_bisnes {{$account->account_personality_type == 1 ? "" : "d-none"}}" id="parent_id_select_2">
                                    <label for="parent_account" class="mr-sm-2">Parent account</label>
                                    <div>
                                        <select class="select2 form-control select2_styles" name="parent_id" >
                                            <option value="0">Select Parent Account</option>
                                            @foreach($accounts as $comp)
                                                @if($comp->id === $account->id)
                                                    @continue
                                                @endif
                                                <option value="{{$comp->id}}"
                                                @if(
                                                    !empty($account->parentAccount->id)
                                                     && $comp->id == $account->parentAccount->id
                                                ) {{'selected'}} @else {{""}} @endif >{{$comp->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}


                            </div>
                            <div class="row mb-2">
                                <div class="bg-light p-3 h6">Communication Details</div>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex flex-column account_classification_indevidual">
                                    <label for="parent_account w-100" class="mr-sm-2">Email</label>
                                    <input type="email" name="email" id="" class="form-control" value="{{$account->email}}">
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Phone 1</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="{{$account->account_phone}}" name="account_phone" >
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Account owner</label>
                                    <div>
                                        <select class="select2 custom-select form-control"  name="owner_id">
                                            @if($users)
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" @if($user->id == $account->ownerUser->id) {{'selected'}} @else {{""}} @endif>{{$user->first_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 account_classification_bisnes {{$account->account_personality_type == 1 ? "" : "d-none"}}">
                                    <label class="mr-sm-2">Industry</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="industry_id" >
                                            @foreach($industries_types as  $industries_type)
                                                <option value="{{$industries_type->id}}" @if($industries_type->id == $account->industriesTypes->id) {{'selected'}} @else {{""}} @endif>{{$industries_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                {{-- <div class="col-6">
                                    <label  class="mr-sm-2">Website</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Website" value="{{$account->website}}" name="website" >
                                </div> --}}
                                <div class="col-6">
                                    <label class="mr-sm-2">Email 2</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->email_2 ?? ''}}" name="email_2" >
                                </div>
                                <div class="col-6 ">
                                    <label  class="mr-sm-2">Phone 2</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="" value="{{$account->additional_phone}}" name="additional_phone" >
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Description</label>
                                    <textarea class="form-control" id="" rows="3"  name="description">{{$account->description}}</textarea>
                                </div>
                                <div class="col-6 account_classification_bisnes {{$account->account_personality_type == 1 ? "" : "d-none"}}">
                                    <label  class="mr-sm-2">Employees</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees"  value="{{$account->employees}}" name="employees" >
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 Street</label>
                                    <textarea class="form-control" id="" rows="3" name="address_1_street" >{{$account->address_1_street}}</textarea>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 Street</label>
                                    <textarea class="form-control" id="" rows="3" name="address_2_street" >{{$account->address_2_street}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 Country</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_1_country}}" name="address_1_country" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 Country</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_2_country}}" name="address_2_country" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 City</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_1_city}}" name="address_1_city" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 City</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_2_city}}" name="address_2_city" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 State</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_1_state}}" name="address_1_state" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 State</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_2_state}}" name="address_2_state" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 zip code</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_1_zip_code}}" name="address_1_zip_code"  >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 zip code</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->address_2_zip_code}}" name="address_2_zip_code" >
                                </div> 
                            </div> --}}

                            <div class="row mb-2 mt-1">
                                <div class="col-6">
                                    <label class="mr-sm-2">Email 3</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->email_3 ?? ''}}" name="email_3" >
                                </div>
                                <div class="col-6 ">
                                    <label  class="mr-sm-2">Phone 3</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="" value="{{$account->phone_3}}" name="phone_3" >
                                </div>
                            </div>
                            <div class="row mb-2 mt-1">
                                <div class="col-6">
                                    <label class="mr-sm-2">Email 4</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$account->email_4 ?? ''}}" name="email_4" >
                                </div>
                                <div class="col-6 ">
                                    <label  class="mr-sm-2">Phone 4</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="" value="{{$account->phone_4}}" name="phone_4" >
                                </div>
                            </div>
                            <div class="Primary_Tax_Registration_block {{$account->account_personality_type == 0 ? "" : "d-none"}}">
                                <div class="row">
                                    <div class="col-12 mb-2 mt-3">
                                        <div class="bg-light p-3 h6">Personal Details</div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Date of Birth</label>
                                        <input  type="date" class="form-control mb-2 mr-sm-2"  value="{{substr($account->bday,0,10)}}" name="bday" >
                                    </div>
                                    <div class="col-6">
                                        <label class="mr-sm-2">Country of Citizenship</label>
                                        <div>
                                            <select class="select2 custom-select form-control" name="country_id" id=''>
                                                @foreach($countries as $coun)
                                                    <option value="{{$coun->id}}" {{$account->country_id && $account->country_id == $coun->id ? "selected" :""}}>{{$coun->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <div class="col-6">
                                        <input type="checkbox" name="desabled_field" id="desabled_account_new"  value="1" {{$account->disabled_field ? "checked" :""}}>
                                        <label for="desabled_account_new" class="mr-sm-2">Disabled</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2 mt-3">
                                        <div class="bg-light p-3 h6">Google Drive Company Folder</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input name="google_drive"class="form-control Google_Drive_text_account" value="{{$account->google_drive ?? ''}}">
                                        <div class="Google_Drive_img_big Google_Drive_img_account mt-2  {{$account->google_drive ? " " : "d-none"}}" >
                                            <a href="{{$account->google_drive ?? ''}}" class="Google_Drive_link_account" target="_blunk">
                                                <img src="{{url('image/Google_Drive.png')}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 mb-2">
                                        <div class="bg-light p-3 h6">Primary Tax Registration</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Registration Status</label>
                                        <div>
                                            <select class="select2 form-control" name="registration_status">
                                                <option selected value="">Select Registration Status</option>
                                                <option value="1" {{(!empty($account->registration_status) && $account->registration_status == '1') ? 'selected' : ''}} >Not Registered for Tax</option>
                                                <option value="2" {{(!empty($account->registration_status) && $account->registration_status == '2') ? 'selected' : ''}}>Registered for Tax </option>
                                                <option value="3" {{(!empty($account->registration_status) && $account->registration_status == '3') ? 'selected' : ''}}>Submitted. Awaiting Tax ID </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="">Tax ID Type</label>
                                        <div>
                                            <select class="select2 form-control" name="tax_id_type">
                                                <option value="1" {{(!empty($account->tax_id_type) && $account->tax_id_type == '1') ? 'selected' : ''}}>ITIN</option>
                                                <option value="2" {{(!empty($account->tax_id_type) && $account->tax_id_type == '2') ? 'selected' : ''}}>SSN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6"> 
                                        <label for="" class="">Tax ID</label>
                                        <input  class="form-control" id="" rows="3" name="tax_id" value="{{$account->tax_id}}">
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="">Status Date</label>
                                        <input type="date" class="status_date form-control" name="status_date" value="{{substr($account->status_date,0,10)}}">
                                        <button class="btn btn-primary today_button mt-2">Today</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Tax Filing Code</label>
                                        <input  class="form-control" id="" rows="3" name="tax_filing_code" value="{{$account->tax_filing_code}}">
                                    </div>
                                </div>
    
                                <div class="row mt-3">
                                    <div class="col-6"> 
                                        <label for="" class="">Link to Tax Registration 1</label>
                                        {{-- <input type="file" name="file_1" id="file_path_1" class="create_file form-control"> --}}
                                        {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                        <input name="file_path_1" class=" form-control link_file" id="" value="{{$file_1??''}}">
                                        <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_1") }}">
                                        <label for="" class="mt-3">Doc Type</label>
                                        <div class="mt-2">
                                            <select class="select2 form-control" name="doc_type_1">
                                                @foreach($doc_types_array as $key => $doc_types_value)
                                                    <option value="{{$key}}" {{$doc_type_1 && $doc_type_1 == $key ? "selected" : "" }}>{{$doc_types_value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6"> 
                                        <label for="" class="">Link to Tax Registration 2</label>
                                        {{-- <input type="file" name="file_2" id="file_path_2" class="create_file form-control"> --}}
                                        {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                        <input name="file_path_2" class=" form-control link_file" id="" value="{{$file_2??''}}">
                                        <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_2") }}">
                                        <label for="" class="mt-3">Doc Type</label>
                                        <div class="mt-2">
                                            <select class="select2 form-control" name="doc_type_2">
                                                @foreach($doc_types_array as $key => $doc_types_value)
                                                    <option value="{{$key}}" {{$doc_type_2 && $doc_type_2 == $key ? "selected" : "" }}>{{$doc_types_value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-6"> 
                                        <label for="" class="">Link to Tax Registration 3</label>
                                        {{-- <input type="file" name="file_3" id="file_path_3" class="create_file form-control"> --}}
                                        {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                        <input name="file_path_3" class=" form-control link_file" id="" value="{{$file_3??''}}">
                                        <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_3") }}">
                                        <label for="" class="mt-3">Doc Type</label>
                                        <div class="mt-2">
                                            <select class="select2 form-control" name="doc_type_3">
                                                @foreach($doc_types_array as $key => $doc_types_value)
                                                    <option value="{{$key}}" {{$doc_type_3 && $doc_type_3 == $key ? "selected" : "" }}>{{$doc_types_value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6"> 
                                        <label for="" class="">Link to Tax Registration 4</label>
                                        {{-- <input type="file" name="file_4" id="file_path_4" class="create_file form-control"> --}}
                                        {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                        <input name="file_path_4" class=" form-control link_file" id="" value="{{$file_4??''}}">
                                        <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_4") }}">
                                        <label for="" class="mt-3">Doc Type</label>
                                        <div class="mt-2">
                                            <select class="select2 form-control" name="doc_type_4">
                                                @foreach($doc_types_array as $key => $doc_types_value)
                                                    <option value="{{$key}}" {{$doc_type_4 && $doc_type_4 == $key ? "selected" : "" }}>{{$doc_types_value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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

    {{--@include('modals.corporate_appointments')--}}
    @include('modals.address')
    @include('modals.contact')
    @include('modals.company')
    @include('modals.notes')
    @include('modals.tax_returns_account')
    
    @include('modals.sales')
    @include('modals.files')    
    @section('js')
      <!-- Include the Quill library -->
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script>

        var toolbarOptions = [
          ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
          ['blockquote', 'code-block'],

          [{ 'header': 1 }, { 'header': 2 }],               // custom button values
          [{ 'list': 'ordered'}, { 'list': 'bullet' }],
          [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
          [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
          [{ 'direction': 'rtl' }],                         // text direction

          [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

          [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
          [{ 'font': [] }],
          [{ 'align': [] }],

          ['clean']                                         // remove formatting button
        ];

        $(document).ready(function() {
            $('.Google_Drive_text_account').on('input', function(){
                let value = $(this).val();
                $('.Google_Drive_link_account').attr('href', value);
                $('.Google_Drive_img_account').removeClass('d-none');
                if(value == ''){
                    $('.Google_Drive_img_account').addClass('d-none');
                }
            })


            $('#countries').change(function () {
                let state = $('#country_state')
                state.val("");
                $("#country_state option:selected").prop("selected", false)

                state.addClass('d-none');
                if($(this).find(':selected').val() == 4){
                    state.removeClass('d-none');
                }else{
                    state.val(0);
                }
            })

            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })
            $('.account_personality_type').change(()=>{
                    if( $('#personal_account').is(':checked') ){
                        $('#business_account_name').addClass('d-none');
                        $('#personal_account_name').removeClass('d-none');
                        // $('.account_classification_indevidual').removeClass('d-none');
                        // $('.account_classification_bisnes').addClass('d-none');
                        $('#last_name').attr('required', 'required');
                        $('#first_name').attr('required', 'required');
                        $('.Primary_Tax_Registration_block').removeClass('d-none');
                        // $('#account_name').removeAttr('required');
                        $('#account_name').val($('#last_name').val() + ", " + $('#first_name').val());
                        
                    }else{
                        $('#last_name').removeAttr('required');
                        $('#first_name').removeAttr('required');
                        // $('#account_name').attr('required', 'required');
                        // $('.account_classification_indevidual').addClass('d-none');
                        // $('.account_classification_bisnes').removeClass('d-none');
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

            $('#active_show_button').click(()=>{
                $('#active_show_button').remove();
                $("#activity_form").removeClass('d-none')
            })
        });
      </script>
    @endsection

@endsection