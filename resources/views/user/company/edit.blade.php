@extends('user.layout.app')
@section('title')Edit Company @endsection
@section('contents')
    @php
        $periods = [
            'Day', 'Week', 'Month', 'Year'
        ];
        $file_1 = '';
        $file_2 = '';
        $file_3 = '';
        $file_4 = '';
        $doc_type_1 = '';
        $doc_type_2 = '';
        $doc_type_3 = '';
        $doc_type_4 = '';
        foreach ($company->companyFiles as $file) {
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
            1 => 'SS4 Form',
            2 => 'EIN CP 575 A Issuance',
            3 => 'IRS Refusal Letter',
            4 => 'IRS Correction Request Letter'
        ];

        $company->month = $company->month ?? 1;
        $data_month = cal_days_in_month(CAL_GREGORIAN, $company->month, date("Y"));

        $month = $company->month;
        if (strlen($month)<2) {
            $month ="0".$month; 
        }
       
        $day = '';
        if(!empty($company->day)){
            $day = $company->day;
            if(strlen($day)<2){
                $day = "0".$day;
            }
        }else{
            $day = '01';   
        }

        $tax_status = ['1'=>'Not Filed', '2'=>'Filed', '3'=> 'NA'];
        $tax_company_status = [
            '1' => 'Dormant (never traded)',
            '2' => 'Non trading (but traded before)',
            '3' => 'Trading',
            '4' => 'Disregarded Entity',

        ];
        $company_type_countries = [16,3,114,54];
        $company_types_countries = json_encode($company_types);     
    @endphp
    @if(!$company->status)
        <div class="container-fluid mt-5">
            <div class="row-with-float">
                <h2 style="color: red; text-align:center">DISENGAGED CLIENT</h2>
            </div>
        </div>
    @endif
    <div class="container-fluid mt-5">
        <div class="row-with-float">
            <div class="col-3 px-2 sticky-top">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div style="" class="pb-2 company_title_block">
                        <h4>{{$company->name}}</h4>
                        @if($company->google_drive)
                            <div class="Google_Drive_img_big" >
                                <a href="{{$company->google_drive}}" class="Google_Drive_link" target="_blunk">
                                    <img src="{{url('image/Google_Drive.png')}}" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 df_jssb_amc">
                        <div>
                            <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                            <a class="btn btn-outline-danger data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('destroy_company', [$company->id]) }}">Delete</a>
                        </div>
                        <div>
                            <div class="dropdown">
                                <button type="button" class="btn btn-light text-primary" data-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><g fill="currentColor" fill-rule="evenodd"><circle cx="5" cy="12" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle></g></svg>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#disengage_company">Disengage</a>
                                  <a class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#select_task_set">Add Task Set</a>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#contact_info_btn">
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small  " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        Company Details
                    </div>
                    <div id="contact_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="">Company name:</label>
                            <div>{{$company->name}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="">Filing:</label>
                            <div>{{$company->filing}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="">Filing Status:</label>
                            <div>{{$company->filing_status ? 'Active' : 'Dissolved'}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="">Country:</label>
                            <div>{{$company->country->name ?? ''}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2 {{empty($company->state->name) ? 'd-none' : ''}}">
                            <label for="personal_name" class="">State:</label>
                            <div>{{$company->state->name ?? ''}} </div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="">Company Type:</label>
                            <div>{{$company->companyTypes->name ?? ''}} </div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="">Incorporation date:</label>
                            <div>{{$company->incorporation_date ?? ''}} </div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class=""> Accounting Reference Date:</label>
                            <div>{{$company->day ? $company->day :'1'}}, {{$company->month ? $months[$company->month -1] :''}}  </div>
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
                                <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#additional_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Account Details
                                </div>
                                <div id="additional_info" class="collapse show">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Account:</label>
                                                    <div>
                                                        <a href="/account/{{$company->parentAccount->id ?? ''}}"> {{$company->parentAccount->name ?? ''}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Contact:</label>
                                                    <div>
                                                        <a href="/contact/{{$company->contacts->id ?? ''}}">{{$company->contacts->title ?? ''}}</a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#company_activity">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Company Activity
                                </div>
                                <div id="company_activity" class="collapse ">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                {{$company->company_activity ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#address_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                     Engagement
                                </div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Type:</label>
                                                    <div>{{$company->type}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Division:</label>
                                                    <div>{{$company->division}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Status:</label>
                                                    <div>{{$company->status ? "Active" : "Disengaged"}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Sub Status:</label>
                                                    <div><span class="{{$company->sub_status ? '' : 'd-none'}}">Disengagement Pending</span></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Engagement Start Date:</label>
                                                    <div>{{ substr($company->engagement_start_date,0,10)}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Engagement End Date:</label>
                                                    <div>{{ substr($company->engagement_end_date,0,10)}}</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#previous_name">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Previous Names
                                </div>
                                <div id="previous_name" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Previous name 1:</label>
                                                    <div>{{$company->previous_name1}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Previous name 2:</label>
                                                    <div>{{$company->previous_name2}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Previous name 3:</label>
                                                    <div>{{$company->previous_name3}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Previous name 4:</label>
                                                    <div>{{$company->previous_name4}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Previous name 5:</label>
                                                    <div>{{$company->previous_name5}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#PrimaryTaxRegistration">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Primary Tax Registration
                                </div>
                                <div id="PrimaryTaxRegistration" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Registration Status:</label>
                                                    @php
                                                    $registration_status_array = [
                                                            1=> 'Not Registered for Tax',
                                                            2=> 'Registered for Tax',
                                                            3=> 'Submitted. Awaiting Tax ID',
                                                        ];
                                                    @endphp

                                                    <div>
                                                        @if($company->registration_status )
                                                            {{$registration_status_array[$company->registration_status]}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Tax ID:</label>
                                                    <div>{{$company->tax_id}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Tax Filing Code:</label>
                                                    <div>{{$company->tax_filing_code}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Tax ID Type:</label>
                                                    <div>{{$company->tax_id_type}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Status Date:</label>
                                                    <div>{{$company->status_date?substr($company->status_date,0,10):""}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                @if($file_1)
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">{{$doc_type_1?$doc_types_array[$doc_type_1] :''}}</label>
                                                        <div class="break-word">
                                                            <a class="text-succsess"  href="{{$file_1}}" target="_blank">Open</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($file_2)
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">{{$doc_type_2?$doc_types_array[$doc_type_2] :''}}</label>
                                                        <div class="break-word">
                                                            <a class="text-succsess"  href="{{$file_2}}" target="_blank">Open</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                @if($file_3)
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">{{$doc_type_3?$doc_types_array[$doc_type_3] :''}}</label>
                                                        <div class="break-word">
                                                            <a class="text-succsess"  href="{{$file_3}}" target="_blank">Open</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($file_4)
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">{{$doc_type_4?$doc_types_array[$doc_type_4] :''}}</label>
                                                        <div class="break-word">
                                                            <a class="text-succsess"  href="{{$file_4}}" target="_blank">Open</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(1>4)
                                    <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#IRS_standard">
                                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                        IRS Standard Correspondence Address
                                    </div>
                                    <div id="IRS_standard" class="collapse">
                                        <div class=" mt-2 pt-1 px-2 pb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">Address 1:</label>
                                                        <div>{{$company->address1??""}}</div>
                                                    </div>
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">Address 2:</label>
                                                        <div>{{$company->address2??""}}</div>
                                                    </div>
                                                
                                                </div>
                                                <div class="col-6">
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">City:</label>
                                                        <div>{{$company->city?? ""}}</div>
                                                    </div>
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">ZIP:</label>
                                                        <div>{{$company->zip?? ""}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="border-bottom mt-2 pt-1 px-2">
                                                        <label for="personal_name" class="">State:</label>
                                                        <div class="break-word">{{$company->correspondence_state?? ""}}</div>
                                                    </div>
                                                
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#forms_7004">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Form 7004
                                </div>
                                
                                <div id="forms_7004" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            @if($company->pdf_fils)
                                                @foreach($company->pdf_fils as $pdf_fils)
                                                <div class="col-12">
                                                    <a class="text-succsess" target="_blank" href="{{$pdf_fils->path}}">{{$pdf_fils->year}}</a>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}



                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#system_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    System Information
                                </div>
                                <div id="system_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div> Created By: {{ Auth::user()->first_name }}. {{$company->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->first_name }}. {{$company->updated_at}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu3">
                            @include('notifications.sales_block')

                            {{-- <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Opportunities (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Contacts ({{$contacts_count->count()}})</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Orders (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Partners (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="tab-pane container fade" id="menu4">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Companies ({{$companies_count->count()}})</span>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Campaign influence</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu5">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Cases (0)</span>
                                    <div>
                                        <button  class="btn btn-outline-primary" >Change Owner</button>
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
                {{-- <div class="col-12 rounded bg-white py-3 px-3">
                    <div class="row mt-3">
                        <div class="col-5  df_jsfs_amc">
                            <div  class="icon_small bg_c_tag" >
                                <img src="{{url('image/opportunity_120.png')}}" alt="">
                            </div>
                            <div class="text-info px-2">Opportunities (0)</div>
                        </div>
                        <div class="col-7  df_jsfs_amc">
                           <div  class="icon_small bg_c_quotes" >
                               <img src="{{url('image/quotes_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Quotes (0)</div>
                       </div>
                   </div>
                   <div class="row mt-3">
                       <div class="col-5  df_jsfs_amc">
                           <div  class="icon_small bg_c_cases" >
                               <img src="{{url('image/case_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Cases (0)</div>
                       </div>
                        <div class="col-7  df_jsfs_amc">
                           <div  class="icon_small bg_c_campaign" >
                               <img src="{{url('image/campaign_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Campaign Influence (0)</div>
                        </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-5  df_jsfs_amc">
                           <div  class="icon_small bg_c_file" >
                               <img src="{{url('image/file_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Files (0)</div>
                       </div>
                        <div class="col-7  df_jsfs_amc">
                            <div  class="icon_small bg_c_notes" >
                                <img src="{{url('image/note_120.png')}}" alt="">
                            </div>
                            <div class="text-info px-2">Notes ({{$notes->count()}})</div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12 rounded mt-">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  cursor-pointer" data-toggle="collapse" data-target="#notes" >
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_notes" >
                                        <img src="{{url('image/note_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Notes ({{$notes->count()}})</div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary clear_notes_form create_notes" data-toggle="modal" data-target="#create_notes">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="notes" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="pt-1 px-2 pb-3">
                            @foreach($notes as $key => $not)
                                @php if($key > 2)continue; @endphp
                                <div class="mt-3 px-2 border-bottom">
                                    <a data-toggle="modal" data-target="#create_notes"  class="text-primary notes_title_content" id="" data-name="{{$not->title??"Untitled Note"}}" data-file="{{$not->note_file}}">{{$not->title??"Untitled Note"}}</a>
                                    <p>{{$not->created_at}} by <span class="text-primary">{{Auth::user()->first_name}}</span></p>
                                    <p >{!! $not->content !!}</p>
                                    <input type="hidden" value="{{ $not->content }}" class="notes_content">
                                    <input type="hidden" value="{{route('edit_notes', [$not->id])}}" class="notes_action">
                                    <input type="hidden" value="{{ route('delete_notes', [$not->id]) }}" class="notes_delete_hreff">
                                </div> 
                            @endforeach
                        </div>
                        @if($notes->count())
                            <div class="row text-center py-3">
                                <a href="{{ route('notes', [$url, $id]) }}" class=" text-primary">View All</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 rounded   mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#contacts" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_contact" >
                                        <img src="{{url('image/contact_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Contacts ({{count($following_companies)}})</div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_following_company">New</button> 
                                </div>
                            </div>
                        </div>
                        <div id="contacts" class="collapse bg-white">
                            <div class=" mt-2 pt-1 px-2 pb-3">
                                @if(!empty($following_companies))
                                    @foreach($following_companies as $following_company)
                                        @if(!empty($following_company['contact']))
                                            <div class="row mt-3 df_jssb_amc">
                                                <div class=" col-8">
                                                    <a href="{{ route('edit_contact', [$following_company['contact']['id']]) }}">{{$following_company['contact']['last_name'].', '.$following_company['contact']['first_name']}}</a>   
                                                </div>
                                                <div class="col-2 text-center">
                                                    <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_following_company', [$following_company['id']]) }}" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#files" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_file" >
                                        <img src="{{url('image/file_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Files
                                         ({{$files->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary " data-toggle="modal" data-target="#create_files">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="files" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-2 pb-3">
                            @foreach($files as $key => $file)
                                @php if($key > 2)continue; @endphp
                                @php $file_data = $file->file @endphp
                                <div class="mt-3 border-bottom">
                                    <div class="row">
                                        <div class="col-2 ">
                                        <div class="row">
                                            <div class="col-9">
                                                @if(strtok($file_data->type, '/') == 'image')
                                                    <a  data-toggle="modal" data-target="#files_show" class="show_img_full">
                                                        <img src="{{ asset("storage/public/Files/$file_data->path") }}" width="40" height="40" alt="">
                                                        <input type="hidden" class="file_path_for_download" value="{{ asset("storage/public/Files/$file_data->path") }}">
                                                    </a>
                                                @else
                                                    <a href="{{ asset("storage/public/Files/$file_data->path") }}" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7F8DE1" width="40" height="40" viewBox="0 0 22 22" id="memory-file"><path d="M13 1V2H14V3H15V4H16V5H17V6H18V7H19V20H18V21H4V20H3V2H4V1H13M13 4H12V8H16V7H15V6H14V5H13V4M5 3V19H17V10H11V9H10V3H5Z"/></svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-10">
                                        <div class="row">
                                            <div class="tooltipblock">
                                                <button class="copy_button">
                                                    <span class="tooltiptext myTooltip" id="myTooltip" >Copy to clipboard</span>
                                                    <p class="text-primary">{{$file_data->name}}</p>
                                                </button>
                                                <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_data->path") }}">
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">{{$file_data->created_at}}</div>
                                            <div class="col-4">{{$file_data->size}}/b</div>
                                            <div class="col-4">{{$file_data->type ? substr($file_data->type, ($a = strrpos($file_data->type, '/') +1)) : ""}}</div>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                        @if($files->count())
                            <div class="row text-center py-3">
                                <a href="{{ route('files', [$url,$id]) }}" class=" text-primary">View All</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#address" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    {{-- <div  class="icon_small " >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" style="width: 3em; height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1"><path d="M414.3 181.7l-225.8 58.1v548.8l225.8-58.1 196 116.2L836 788.6V239.8l-193.1 48.8" fill="#FFF061"/><path d="M608.8 857.4L412.7 741.2l-234.2 60.3V232l233.3-60 5 19.3-218.3 56.2v528.2l217.3-55.9 196 116.1L826 780.8V252.6l-180.6 45.7-4.9-19.4 205.5-52v569.4z" fill="#6D5346"/><path d="M571.5 510.7l-68 126-64.4-126c-53.7-24.5-93.1-80.5-93.1-140 0-84 71.6-154 157.5-154s157.5 70 157.5 154c0 59.5-35.8 115.5-89.5 140z" fill="#BBE4FF"/><path d="M503.3 658.2l-71.5-139.9c-26.7-12.9-50.6-33.7-67.6-58.9-18.4-27.2-28.1-57.9-28.1-88.7 0-43.3 17.6-84.4 49.5-115.6 31.9-31.2 73.8-48.4 118-48.4s86.1 17.2 118 48.4c31.9 31.2 49.5 72.3 49.5 115.6 0 31.1-9.1 61.7-26.2 88.5-16.5 25.8-39.3 46.2-66.1 59.1l-75.5 139.9z m0.2-431.5c-38.9 0-75.8 15.1-104 42.6-28.1 27.4-43.5 63.4-43.5 101.4 0 26.8 8.5 53.6 24.7 77.5 15.6 23.2 37.9 42.1 62.5 53.4l3.2 1.4 57.4 112.2L564.3 503l3.1-1.4c50-22.8 83.6-75.4 83.6-130.9 0-37.9-15.5-73.9-43.5-101.4-28.1-27.5-65-42.6-104-42.6z" fill="#6D5346"/><path d="M512.3 365.4m-43.8 0a43.8 43.8 0 1 0 87.6 0 43.8 43.8 0 1 0-87.6 0Z" fill="#FFF061"/><path d="M512.3 419.2c-29.6 0-53.8-24.1-53.8-53.8s24.1-53.8 53.8-53.8c29.6 0 53.7 24.1 53.7 53.8s-24.1 53.8-53.7 53.8z m0-87.5c-18.6 0-33.8 15.1-33.8 33.8s15.1 33.8 33.8 33.8S546 384 546 365.4s-15.1-33.7-33.7-33.7z" fill="#6D5346"/><path d="M608.5 846.7v-350" fill="#FFF061"/><path d="M598.5 496.7h20v350h-20z" fill="#6D5346"/><path d="M416 248.7v-67" fill="#FFF061"/><path d="M406 181.7h20v67h-20z" fill="#6D5346"/><path d="M416 724.2V496.7" fill="#FFF061"/><path d="M406 496.7h20v227.5h-20z" fill="#6D5346"/><path d="M469.5 217.7l-62.2-37" fill="#FFF061"/><path d="M402.203 189.316l10.224-17.188 62.22 37.011-10.223 17.188z" fill="#6D5346"/></svg>
                                    </div> --}}
                                    <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Address
                                         ({{$address_relations->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary use_new_main_addres" data-toggle="modal" data-target="#use_address">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="address" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-3 pb-3">
                            @php
                                function get_address_data($array){
                                    $array_end = array_shift($array);
                                    $start = ''; 
                                
                                    if(join(" ",$array_end) != ' '){
                                        $start =  join(" ",array_filter($array_end)).', '; 
                                    }
                                    echo $start.join(", ",array_filter($array));
                                }

                            @endphp

                            @foreach($address_relations as $key => $address_relation)
                                <div class="mt-3 border-bottom">
                                    <div class="row main_address cursor-pointer" data-toggle="modal" data-target="#chose_address" data-all-data="{{$address_relation->addresses}}" data-address_relation_id="{{$address_relation->id}}">
                                        <div class="col-8">
                                            <b>{{ $address_relation->addresses->title??"Unknown name" }}:</b>

                                            @php
                                                $show_country_id = $address_relation->addresses->country_id? $address_relation->addresses->country_id : '';
                                                $show_address_2 = $address_relation->addresses->address_2? $address_relation->addresses->address_2 : '';
                                                $show_address_3 = $address_relation->addresses->address_3? $address_relation->addresses->address_3 : '';
                                                $show_region = $address_relation->addresses->region? $address_relation->addresses->region : '';
                                                $show_country = $address_relation->addresses->country && $address_relation->addresses->country->name? $address_relation->addresses->country->name : '';
                                                $show_county = $address_relation->addresses->county? $address_relation->addresses->county->name : '';
                                                $show_state = $address_relation->addresses->state && $address_relation->addresses->state->abbreviation? $address_relation->addresses->state->abbreviation : '';
                                                $show_street = $address_relation->addresses->street? $address_relation->addresses->street : '';
                                                $show_post_code_zip = $address_relation->addresses->post_code_zip? $address_relation->addresses->post_code_zip : '';
                                                $show_city = $address_relation->addresses->city? $address_relation->addresses->city : '';
                                                $show_house_number = $address_relation->addresses->house_number? $address_relation->addresses->house_number : '';

                                                $Greter_array = [17,18];
                                                if($address_relation->addresses->county && in_array($address_relation->addresses->county->id, $Greter_array)){
                                                   $show_county = mb_substr($show_county, mb_strpos($show_county, ' '));
                                                }
                                                // $uk_spec = join(" ",[$show_county, $show_post_code_zip]);
                                                // $german_spec = join(" ",[ $show_post_code_zip, $show_city]);
                                                // $usa_spec = join(" ",[$show_state, $show_post_code_zip]);

                                                // $show_usa_array = [[$show_house_number,$show_street], $show_address_2,$show_address_3,$show_city,$usa_spec,$show_country];
                                                // $show_uk_array = [[$show_house_number,$show_street], $show_address_2,$show_address_3,$show_city,$uk_spec,$show_country];
                                                // $show_Germany_Switzerland_Austria_array = [[$show_street,$show_house_number], $show_address_2,$show_address_3,$german_spec,$show_country];
                                                // $show_All_other_countries = [[$show_house_number,$show_street], $show_address_2, $show_address_3, $show_city, $show_post_code_zip, $show_country];

                                                // $show_data = '';

                                                // if($show_country_id && $show_country_id == 4){
                                                //     $show_data = get_address_data($show_usa_array);
                                                // }elseif($show_country_id && $show_country_id == 5){
                                                //     $show_data = get_address_data($show_uk_array);
                                                // }elseif($show_country_id && ($show_country_id == 55 || $show_country_id == 3 || $show_country_id == 18)){
                                                //     $show_data = get_address_data($show_Germany_Switzerland_Austria_array);
                                                // }else{
                                                //     $show_data = get_address_data($show_All_other_countries);
                                                // }

                                            @endphp
                                            @if($show_country_id && $show_country_id == 4)
                                                <div>{{$show_house_number}} {{$show_street}}</div>
                                                <div>{{$show_address_2}}</div>
                                                <div>{{$show_address_3}}</div>
                                                <div>{{$show_city?$show_city.',':""}} {{$show_state}} {{$show_post_code_zip}}</div>
                                                <div>USA</div>
                                            @elseif($show_country_id && $show_country_id == 5)
                                            <div>{{$show_house_number}} {{$show_street}}</div>
                                                <div>{{$show_address_2}}</div>
                                                <div>{{$show_address_3}}</div>
                                                <div>{{$show_city?$show_city.',':""}} {{$show_county}} {{$show_post_code_zip}}</div>
                                                <div>{{$show_country}}</div>
                                            @elseif($show_country_id && ($show_country_id == 54 || $show_country_id == 3 || $show_country_id == 17))
                                                <div>{{$show_street}} {{$show_house_number}}</div>
                                                <div>{{$show_address_2}}</div>
                                                <div>{{$show_address_3}}</div>
                                                <div>{{$show_post_code_zip}} {{$show_city}}</div>
                                                <div>{{$show_country}}</div>
                                            @else
                                                <div>{{$show_house_number}} {{$show_street}}</div>
                                                <div>{{$show_address_2}}</div>
                                                <div>{{$show_address_3}}</div>
                                                <div>{{$show_city}} {{$show_post_code_zip}}</div>
                                                <div>{{$show_country}}</div>
                                            @endif


                                            {{-- {{$show_data}}  --}}
                                        </div>
                                        <div class="col-4">
                                                @if(!empty($address_relation->address_type))
                                                    <span class="bg_c_quotes badge badge-success">Main Address</span>
                                                @endif
                                         
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                        @if($address_relations->count())
                            <div class="row text-center py-3">
                                <a href="{{ route('address_by_url', [$url,$id]) }}" class=" text-primary">View All</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#corporate_appointments" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    {{-- <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div> --}}
                                    <div  class="icon_small bg_c_tag" >
                                        <img src="{{url('image/opportunity_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Appointments
                                         ({{$corporate_appointments->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary " data-toggle="modal" data-target="#create_corporate_appointments">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="corporate_appointments" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-3 pb-3">
                            @foreach($corporate_appointments as $key => $cor_app)
                                <div class="mt-3 border-bottom">
                                    <div class="row pb-1">
                                        <div class="col-8 edit_corporate_appointments cursor-pointer text-primary" data-toggle="modal" data-target="#edit_corporate_appointments" data-corporate_appointments="{{$cor_app}}">

                                            @if(!empty($cor_app->contact))
                                                {{$cor_app->contact->last_name ? $cor_app->contact->last_name.', ' : ""}} {{$cor_app->contact->first_name ?$cor_app->contact->first_name:""}} -
                                            @elseif(!empty($cor_app->account))
                                            {{$cor_app->account->name ? $cor_app->account->name: ""}} -
                                            @endif
                                            {{$cor_app->title}}
                                          
                                        </div>
                                        <div class="col-2">
                                            @if(!empty($cor_app->appointment_terminated_date) && strtotime($cor_app->appointment_terminated_date) < time())
                                                <span class="bg-danger badge badge-success">Ceased</span>
                                            @else
                                                <span class="bg-success badge badge-success">Active</span>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center">
                                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_corporate_appointments', [$cor_app->id]) }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#tax_returns" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div class="icon_small bg_c_cases">
                                        <img src="{{url('image/case_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Tax Returns
                                        ({{$tax_returns->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary newtax_returns" data-toggle="modal" data-target="#tax_returns_modal">New</button>
                                    <input type="hidden" name="" value="{{'-'.$month.'-'.$day}}" class="accounting_reference_date">
                                    <input type="hidden" name="" value="{{$company->incorporation_date}}" class="incorporation_date_for_tax">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tax_returns" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-3 pb-3"> 
                            @foreach($tax_returns as $key => $tax_return)
                                <div class="row  border-bottom" style="height: 40px">
                                    <div 
                                        class="col-6 show_tax_returns cursor-pointer text-primary d-flex align-items-center"
                                        data-toggle="modal"
                                        data-target="#show_tax_returns"
                                        data-tax_returns="{{ $tax_return}}">
                                        {{$tax_return->tax_end? substr($tax_return->tax_end,0,4)  : ''}} 
                                    </div>
                                  
                                        <div class=" col-6 d-flex justify-content-end gap-2 align-items-center" >
                                            @if($tax_return->google_drive)
                                                <div class="Google_Drive_img_small">
                                                    <a href="{{$tax_return->google_drive}}" class="" target="_blunk">
                                                        <img src="{{url('image/Google_Drive.png')}}" alt="">
                                                    </a>
                                                </div> 
                                            @endif
                                            @if(!empty($tax_return->pdfFile) && !empty($tax_return->pdfFile->path))
                                                <div class="extention_icon_orange extr_icons">
                                                    <a href="{{$tax_return->pdfFile->path}}" class="" target="_blunk">E</a>
                                                </div> 
                                            @endif
                                            @if($tax_return->file_path)
                                                <div class="tr_icon_red extr_icons">
                                                    <a href="{{$tax_return->file_path}}" class="" target="_blunk">R</a>
                                                </div> 
                                            @endif
                                        </div>
                                    
                                                                           
                                    {{-- <div class="col-2 text-center">
                                        <a href="{{ route('delete_tax_returns', [$tax_return->id]) }}" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                        </a>
                                    </div> --}}
                                </div>
                            @endforeach
                        </div>
                        @if($tax_returns->count())
                            <div class="row text-center py-3">
                                <a href="{{ route('tax_returns_by_url', [$url,$id]) }}" class=" text-primary">View All</a>
                            </div>
                         @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal edit_account " id="edit_account">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit Company</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('edit-company',[$company->id])}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Company Details</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="col-12">
                                        <label for="personal_name" class=""> Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="name" value="{{$company->name}}" id="" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="personal_name" class=""> Filing No:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="filing" value="{{$company->filing}}" id="" >
                                    </div>
                                    <div class="col-12">
                                        <label for="personal_name" class="">Incorporation date</label>
                                        <input type="date" class="form-control mb-2 " placeholder="" name="incorporation_date" value="{{$company->incorporation_date}}" id="" required> 
                                    </div>
                                    <div class="row">
                                        <div class="col-12"><label for="personal_name" class="">Accounting Reference Date</label></div>
                                        <div class="col-6">
                                            <div>
                                                <select class="select2  form-control  " name="month" id="month">
                                                    @foreach($months as $key =>$month)
                                                        <option value="{{$key+1}}" {{$company->month == $key+1 ?"selected" : ""}}  >{{$month}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="months_day">
                                                <select class="select2 custom-select form-control" name="day">
                                                    @for($i=1; $i<= $data_month; $i++)
                                                        <option value="{{$i}}"  {{$company->day == $i ?"selected" : ""}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <label for="" class="">Country:</label>
                                        <div>
                                            <select class="select2  form-control" name="country_id" id="countries" required>
                                                <option selected value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{($country->id == $company->country_id) ? 'selected' : ''}}  >{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2 {{(!empty($company->state_id) || $company->country_id ==4 ) ? '' : 'd-none'}}  " id="country_state">
                                        <label for="" class="">State:</label>
                                        <div >
                                            <select class="select2  form-control" name="state_id">
                                                <option selected value="">Select State</option>
                                                @foreach($countries as $country)
                                                    @if($country->states->count())
                                                        @foreach($country->states as $state)
                                                            @if($state->country_id == 4)
                                                                <option value="{{$state->id}}" {{(!empty($company->state_id) && $company->state_id == $state->id) ? 'selected' : ''}} >{{$state->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="">Company Type:</label>
                                        <div class="company_type_block">
                                            <select  class="select2 custom-select form-control" name="company_id" required>
                                                <option selected value="">Select Company Type</option>
                                                @foreach($company_types as  $company_type)
                                                    @if(in_array($company->country_id, $company_type_countries))
                                                        @if(!empty($company_type->countries))
                                                            <option 
                                                                value="{{$company_type->id}}"
                                                                {{(!empty($company->company_id) && $company->company_id == $company_type->id) ? 'selected' : ''}}
                                                            >
                                                                {{$company_type->name}}
                                                            </option>
                                                        @endif
                                                    @else
                                                        @if(empty($company_type->countries))
                                                            <option 
                                                                value="{{$company_type->id}}"
                                                                {{(!empty($company->company_id) && $company->company_id == $company_type->id) ? 'selected' : ''}}
                                                            >
                                                                {{$company_type->name}}
                                                            </option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mt-2">Filing Status:</label>
                                        <div>
                                            <select class="select2  form-control" name="filing_status" required>
                                                <option selected value="">Select Filing Status </option>
                                                <option value="1" {{$company->filing_status ? 'selected' : ''}} >Active</option>
                                                <option value="0" {{!$company->filing_status ? 'selected' : ''}} >Dissolved</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2 mt-3">
                                    <div class="bg-light p-3 h6">Google Drive Company Folder</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input name="google_drive"class="form-control Google_Drive_text_company" value="{{$company->google_drive ?? ''}}">
                                    <div class="Google_Drive_img_big Google_Drive_img_company mt-2 {{$company->google_drive ? " " : "d-none"}}" >
                                        <a href="{{$company->google_drive ?? ''}}" class="Google_Drive_link_company" target="_blunk">
                                            <img src="{{url('image/Google_Drive.png')}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2 mt-3">
                                    <div class="bg-light p-3 h6">Company Activity</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea name="company_activity"class="form-control" >{{$company->company_activity ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2 mt-3">
                                    <div class="bg-light p-3 h6">Account Details</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="">Account:</label>
                                        <div>
                                            <select  class="select2 custom-select form-control" name="account_id" required>
                                                <option  value="">Select Account </option>
                                                @foreach($accounts as $account)
                                                    <option value="{{$account->id}}"  {{(!empty($account->id) && $company->account_id == $account->id) ? 'selected' : ''}}>{{$account->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <label for="personal_name" class="">Contact:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control"  name="contact_id">
                                            <option selected value="">Select Contact </option>
                                                @foreach($contacts as $contact)
                                                    <option value="{{$contact->id}}"  {{(!empty($contact->id) && $company->contact_id == $contact->id) ? 'selected' : ''}}>{{$contact->title}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Engagement</div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="">Type:</label>
                                        <div>
                                            <select class="select2 form-control" name="type">
                                                <option selected value="">Select Types</option>
                                                <option value="Client" {{(!empty($company->type) && $company->type == 'Client') ? 'selected' : ''}}>Client</option>
                                                <option value="Readymade" {{(!empty($company->type) && $company->type == 'Readymade') ? 'selected' : ''}}>Readymade</option>
                                                <option value="Group" {{(!empty($company->type) && $company->type == 'Group') ? 'selected' : ''}}>Group</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="">Division :</label>
                                        <div>
                                            <select class="select2 form-control" name="division">
                                                <option selected value="" >Select Division</option>
                                                <option value="STM Corporate Group" {{(!empty($company->division) && $company->division == 'STM Corporate Group') ? 'selected' : ''}}>STM Corporate Group</option>
                                                <option value="Mount Bonnell Advisors" {{(!empty($company->division) && $company->division == 'Mount Bonnell Advisors') ? 'selected' : ''}}>Mount Bonnell Advisors</option>
                                                <option value="US Corporation & Trust Services" {{(!empty($company->division) && $company->division == 'US Corporation & Trust Services') ? 'selected' : ''}}>US Corporation & Trust Services</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <label for="" class="">Status:</label>
                                        <div>
                                            <select class="select2 form-control" name="status">
                                                <option selected value="">Select Status</option>
                                                <option value="1" {{$company->status ? 'selected' : ''}}>Active</option>
                                                <option value="0" {{!$company->status ? 'selected' : ''}}>Disengaged</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="">Sub Status:</label>
                                        <div>
                                            <input type="checkbox" value="1" {{$company->sub_status ? 'checked' : ''}} name="sub_status" id="sub_status">
                                            <label for="sub_status">Disengagement Pending</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="engagement_start_date" class="">Engagement Start Date</label>
                                    <input type="date" class="form-control mb-2 " placeholder="" name="engagement_start_date" value="{{substr($company->engagement_start_date,0,10)}}" id="engagement_start_date">
                                </div>
                                <div class="col-6">
                                    <label for="engagement_end_date" class="">Engagement End Date</label>
                                    <input type="date" class="form-control mb-2 " placeholder="" name="engagement_end_date" value="{{substr($company->engagement_end_date,0,10)}}" id="engagement_end_date">
                                </div>
                            </div>
                            @if(!$company->status)
                                <div class="row mt-2">
                                    <div class="col-6 "></div>
                                    <div class="col-6 ">
                                        <label for="engagement_end_date" class="">Disengagement Reason</label>
                                        <div class="mt-2">
                                            <select class="select2 form-control" name="disengagement_reason">
                                                @foreach($disengagement_reasons as $key => $disengagement_reason)
                                                    <option value="{{$key}}" {{$company->disengagement_reason && $company->disengagement_reason == $key ? "selected" : "" }}>{{$disengagement_reason}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Previous Names</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class=""> Previous name 1:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="previous_name1" value="{{$company->previous_name1}}" id="" >
                                    <label for="personal_name" class=""> Previous name 2:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="previous_name2" value="{{$company->previous_name2}}" id="" >
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class=""> Previous name 3:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="previous_name3" value="{{$company->previous_name3}}" id="" >
                                    <label for="personal_name" class=""> Previous name 4:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="previous_name4" value="{{$company->previous_name4}}" id="" >
                                    <label for="personal_name" class=""> Previous name 5:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="previous_name5" value="{{$company->previous_name5}}" id="" >
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
                                            <option value="1" {{(!empty($company->registration_status) && $company->registration_status == '1') ? 'selected' : ''}} >Not Registered for Tax</option>
                                            <option value="2" {{(!empty($company->registration_status) && $company->registration_status == '2') ? 'selected' : ''}}>Registered for Tax </option>
                                            <option value="3" {{(!empty($company->registration_status) && $company->registration_status == '3') ? 'selected' : ''}}>Submitted. Awaiting Tax ID </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="" class="">Tax ID Type</label>
                                    <input type="text" class="tax_id_type form-control" name=""  value="{{$company->tax_id_type}}" disabled>
                                    <input type="hidden" class="tax_id_type form-control" name="tax_id_type"  value="{{$company->tax_id_type}}">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6"> 
                                    <label for="" class="">Tax ID</label>
                                    <input  class="form-control" id="" rows="3" name="tax_id" value="{{$company->tax_id}}">
                                </div>
                                <div class="col-6">
                                    <label for="" class="">Status Date</label>
                                    <input type="date" class="status_date form-control" name="status_date" value="{{substr($company->status_date,0,10)}}">
                                    <button class="btn btn-primary today_button mt-2">Today</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="">Tax Filing Code</label>
                                    <input  class="form-control" id="" rows="3" name="tax_filing_code" value="{{$company->tax_filing_code}}">
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
                            {{-- <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">IRS Standard Correspondence Address</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6"> 
                                    <label for="" class="">Address 1</label>
                                    <input type="text" name="address1" id="" class=" form-control" value="{{$company->address1}}">
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="">Address 2</label>
                                    <input type="text" name="address2" id="" class=" form-control" value="{{$company->address2}}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6"> 
                                    <label for="" class="">City</label>
                                    <input type="text" name="city" id="" class=" form-control" value="{{$company->city}}">
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="">ZIP</label>
                                    <input type="text" name="zip" id="" class=" form-control" value="{{$company->zip}}">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-6"> 
                                    <label for="" class="">State </label>
                                    <textarea name="correspondence_state" class="form-control">{{$company->correspondence_state}}</textarea>
                                </div>
                            </div> --}}

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
    @include('modals.task_set')
    @include('modals.disengage_company')
    @include('modals.contact_following_company')
    @include('modals.tax_returns')
    @include('modals.corporate_appointments')
    @include('modals.address')
    @include('modals.notes')
    @include('modals.sales')
    @include('modals.files')
    @section('js')
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
            var quill = new Quill('#editor', {
                modules: {
                toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            $(document).ready(function() {
                $('.select2').each(function(){
                    $(this).select2({
                        dropdownParent:  $(this).parent()
                    });
                })
            });

            let editor = $('#editor')
            quill.on('text-change', function(delta, source) {
                $("#hiddenArea").val($("#editor").html());
                var delta = quill.getContents();
            });

            var company_types_countries = <?php echo $company_types_countries ?>;

            $('#countries').change(function (e) {
                let state = $('#country_state')
                state.val("");
                $("#country_state option:selected").prop("selected", false)
                state.addClass('d-none');
                if($(this).find(':selected').val() == 4){
                    state.removeClass('d-none');
                }else{
                    state.val(0);
                }

                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                let tax_id_data = {4:"EIN", 5:"UTR", 6:"Tax Reference"};
                let tax_id_type = $('.tax_id_type')
                if(tax_id_data[select_val]){
                    tax_id_type.val(tax_id_data[select_val])
                }else{
                    tax_id_type.val('Other')
                }

                const countries = ['16','3','114','54'];
                $('.company_type_block').empty();

                let select = ` <select  class="select2 select_span_style custom-select form-control  typeof_company" name="company_id" required>`;

                if (countries.includes(select_val)) {
                    for(let type of company_types_countries){
                        if(type.countries  &&  type.countries == '[16,3,114,54]'){
                            select += `<option value="${type.id}" >${type.name}</option>`;
                        }
                    } 
                }else{
                    for(let type of company_types_countries){
                        if(!type.countries){
                            select += `<option value="${type.id}" >${type.name}</option>`;
                        }
                    } 
                }

                select += `</select>`;

                $('.company_type_block').append(select);

                $('.typeof_company').each(function(){
                    $(this).select2({
                        dropdownParent:  $(this).parent()
                    });
                })
            })

            $('.Google_Drive_text_company').on('input', function(){
                let value = $(this).val();
                $('.Google_Drive_link_company').attr('href', value);
                $('.Google_Drive_img_company').removeClass('d-none');
                if(value == ''){
                    $('.Google_Drive_img_company').addClass('d-none');
                }
            })


            $(document).ready(function(){

                // $('.create_file').on('change', function(){
                //     let company_id = '<?= $company->id?>';
                //     let file_data = $(this).prop("files")[0];
                //     let form_data = new FormData(); 
                //     form_data.append("file", file_data);
                //     form_data.append("file_type", $(this).attr('id'));
                //     form_data.append("company_id",company_id)

                //     $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                //     });
                //     $.ajax({
                //         type:"POST",
                //         // url:'/update_file_company',
                //         url:'/uploade_file_company',
                    
                //         cache: false,
                //         contentType: false,
                //         processData: false,
                //         data: form_data, 
                //         success: (response) => {
                //             if (response.code == 400) {
                //             }else if(response.code == 200){
                //                 let text = response.msg;
                //                 $(this).parent().find('.link_file').html(text)
                //                 // let origin = window.location.origin; 
                //                 // $(this).parent().find('.file_link').val(origin+'/storage/public/Files/'+text)
                //                 // $(this).parent().find('p').removeClass('d-none')
                //                 // $(this).parent().find('p').text(text);
                //             }
                //         }
                //     })

                // })

                const copyToClipboard = str => {
                    const el = document.createElement('textarea');
                    el.value = str;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                };
                // $('.link_file').on('click', function(){
                //     let copyText = $(this).parent().find(".file_link");
                //     copyToClipboard( copyText.val() );
                // })

                $('.today_button').on('click', function(e){
                    e.preventDefault();
                    let date = $('.status_date');
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yy = today.getFullYear();
                    today = yy + '-' + mm + '-' + dd;
                    date.val(today)
                })
            })

        </script>
    @endsection

@endsection