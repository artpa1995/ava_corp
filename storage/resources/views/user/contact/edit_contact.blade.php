@extends('user.layout.app')
@section('title')Edit Contact @endsection
@section('contents')
    <div class="container-fluid mt-5">
        <div class="row-with-float">
            <div class="col-3 px-2 sticky-top">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div style="border-bottom: 1px solid lightgrey" class="pb-2">
                        <h4>{{$contact->last_name.', '. $contact->first_name}}</h4>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                        <a class="btn btn-outline-danger data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_contact', [$contact->id]) }}">Delete</a>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#contact_info_btn">
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small  " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        Contact Information 
                    </div>
                    <div id="contact_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="">Account name:</label>
                            <div>{{$contact->parentAccount->name ?? ''}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="">Contact name:</label>
                            <div>{{$contact->last_name.', '. $contact->first_name}}</div>
                        </div>

                        {{-- <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="">Contact owner:</label>
                            <div>{{$contact->ownerUser->first_name ?? ""}}</div>
                        </div> --}}
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="">Email:</label>
                            <div>{{$contact->email}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="">Phone:</label>
                            <div>{{$contact->phone}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="">Job Title:</label>
                            <div>{{$contact->job_title}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 px-2">
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

                                    Additional Information 
                                </div>
                                <div id="additional_info" class="collapse show">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Reports to</label>
                                                    <div>{{$contact->reportsTo->last_name ?? '' }} {{$contact->reportsTo->first_name ?? '' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Department</label>
                                                    <div>{{$contact->department}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#comunication_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Communication Details
                                </div>
                                <div id="comunication_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Email 1</label>
                                                    <div>{{$contact->email_1 ?? '' }} </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Email 2</label>
                                                    <div>{{$contact->email_2 ?? '' }} </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Email 3</label>
                                                    <div>{{$contact->email_3 ?? '' }} </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Email 4</label>
                                                    <div>{{$contact->email_4 ?? '' }} </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Phone 1</label>
                                                    <div>{{$contact->phone_1 ?? '' }} </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Phone 2</label>
                                                    <div>{{$contact->phone_2 ?? '' }} </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Phone 3</label>
                                                    <div>{{$contact->phone_3 ?? '' }} </div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Phone 4</label>
                                                    <div>{{$contact->phone_4 ?? '' }} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#address_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>

                                    Address Information
                                </div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="">Mailing Address:</label>
                                                    <div>{{$contact->mailingAddress->email ?? ''  }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#linked_companies">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Linked Companies
                                </div>
                                <div id="linked_companies" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <th>Account</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>Date Added</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    @if(!empty($following_companies))
                                                        @foreach($following_companies as $following_company)
                                                            @if($following_company['company'])
                                                                <tr>
                                                                    <td>
                                                                        @if(!empty($following_company['company']))
                                                                            <a href="/company/{{$following_company['company']['id']}}">{{$following_company['company']['name']}}</a>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if(!empty($following_company['company']['parent_account']))
                                                                            <a href="/account/{{$following_company['company']['parent_account']['id']}}">{{$following_company['company']['parent_account']['name']}}</a>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{!empty($following_company['company']['country']) ? $following_company['company']['country']['name'] : "" }}</td>
                                                                    <td>{{!empty($following_company['company']['state']) ? $following_company['company']['state']['name'] : "" }}</td>
                                                                    <td>{{substr($following_company['created_at'],0,10)}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#system_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>

                                    System Information
                                </div>
                                <div id="system_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">

                                                    <div> Created By: {{ Auth::user()->first_name }}. {{$contact->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->first_name }}. {{$contact->updated_at}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="tab-pane container fade" id="menu3">
                            <div class="row mt-3 px-3">
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
                            </div>
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
                             <div class="text-info px-2">Notes ({{$notes->count()}}) </div>
                         </div>
                     </div>
                 </div> --}}
               
                 {{-- <div class="col-12 rounded ">
                    <div class="  collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#contacts" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_contact" >
                                        <img src="{{url('image/contact_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Contacts ({{$contacts_count->count()}})</div>
                                </div>
                                <div class="col-4 text-right">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_contact">New</button> 
                                </div>

                            </div>
                        </div>
                        <div id="contacts" class="collapse bg-white">
                            <div class=" mt-2 pt-1 px-2 pb-3">
                                @foreach($contacts_count as $contact_)
                                    <div class="mt-3 df_jssb_amc">
                                        <a href="{{ route('edit_contact', [$contact_->id]) }}">{{$contact_->last_name}}, {{$contact_->first_name}}</a>   
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-12 rounded mt-3">
                    <div class="  collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#companies" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Companies ({{$companies_count->count()}})</div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_company">New</button> 
                                </div>

                            </div>
                        </div>
                        <div id="companies" class="collapse bg-white">
                            <div class="border-bottom mt-2 pt-1 px-2 pb-3">
                                @foreach($companies_count as $company)
                                    <div class="mt-3 df_jssb_amc">
                                        <a href="{{route('edit_company',  [$company->id]) }}">{{$company->name}}</a>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12 rounded ">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#notes" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_notes" >
                                        <img src="{{url('image/note_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Notes ({{$notes->count()}})</div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary create_notes clear_notes_form" data-toggle="modal" data-target="#create_notes">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="notes" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-2 pb-3">
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
                                    {{-- <div  class="icon_small ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" style="width: 3em; height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1"><path d="M414.3 181.7l-225.8 58.1v548.8l225.8-58.1 196 116.2L836 788.6V239.8l-193.1 48.8" fill="#FFF061"/><path d="M608.8 857.4L412.7 741.2l-234.2 60.3V232l233.3-60 5 19.3-218.3 56.2v528.2l217.3-55.9 196 116.1L826 780.8V252.6l-180.6 45.7-4.9-19.4 205.5-52v569.4z" fill="#6D5346"/><path d="M571.5 510.7l-68 126-64.4-126c-53.7-24.5-93.1-80.5-93.1-140 0-84 71.6-154 157.5-154s157.5 70 157.5 154c0 59.5-35.8 115.5-89.5 140z" fill="#BBE4FF"/><path d="M503.3 658.2l-71.5-139.9c-26.7-12.9-50.6-33.7-67.6-58.9-18.4-27.2-28.1-57.9-28.1-88.7 0-43.3 17.6-84.4 49.5-115.6 31.9-31.2 73.8-48.4 118-48.4s86.1 17.2 118 48.4c31.9 31.2 49.5 72.3 49.5 115.6 0 31.1-9.1 61.7-26.2 88.5-16.5 25.8-39.3 46.2-66.1 59.1l-75.5 139.9z m0.2-431.5c-38.9 0-75.8 15.1-104 42.6-28.1 27.4-43.5 63.4-43.5 101.4 0 26.8 8.5 53.6 24.7 77.5 15.6 23.2 37.9 42.1 62.5 53.4l3.2 1.4 57.4 112.2L564.3 503l3.1-1.4c50-22.8 83.6-75.4 83.6-130.9 0-37.9-15.5-73.9-43.5-101.4-28.1-27.5-65-42.6-104-42.6z" fill="#6D5346"/><path d="M512.3 365.4m-43.8 0a43.8 43.8 0 1 0 87.6 0 43.8 43.8 0 1 0-87.6 0Z" fill="#FFF061"/><path d="M512.3 419.2c-29.6 0-53.8-24.1-53.8-53.8s24.1-53.8 53.8-53.8c29.6 0 53.7 24.1 53.7 53.8s-24.1 53.8-53.7 53.8z m0-87.5c-18.6 0-33.8 15.1-33.8 33.8s15.1 33.8 33.8 33.8S546 384 546 365.4s-15.1-33.7-33.7-33.7z" fill="#6D5346"/><path d="M608.5 846.7v-350" fill="#FFF061"/><path d="M598.5 496.7h20v350h-20z" fill="#6D5346"/><path d="M416 248.7v-67" fill="#FFF061"/><path d="M406 181.7h20v67h-20z" fill="#6D5346"/><path d="M416 724.2V496.7" fill="#FFF061"/><path d="M406 496.7h20v227.5h-20z" fill="#6D5346"/><path d="M469.5 217.7l-62.2-37" fill="#FFF061"/><path d="M402.203 189.316l10.224-17.188 62.22 37.011-10.223 17.188z" fill="#6D5346"/></svg>
                                    </div> --}}
                                    <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Address ({{$address_relations->count()}})</div>
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
                                            @if($address_relation->addresses->entery_type !== 'manual')
                                                <b>{{ $address_relation->addresses->title??"Unknown name" }}:</b>
                                            @endif

                                            @php
                                                $show_country_id = $address_relation->addresses->country_id? $address_relation->addresses->country_id : '';
                                                $show_address_2 = $address_relation->addresses->address_2? $address_relation->addresses->address_2 : '';
                                                $show_address_3 = $address_relation->addresses->address_3? $address_relation->addresses->address_3 : '';
                                                $show_region = $address_relation->addresses->region? $address_relation->addresses->region : '';
                                                $show_country = $address_relation->addresses->country && $address_relation->addresses->country->name? $address_relation->addresses->country->name : '';
                                                $show_county = $address_relation->addresses->county? $address_relation->addresses->county->name : '';
                                                $show_state = $address_relation->addresses->state? $address_relation->addresses->state->name : '';
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
                                            {{-- {{$show_data}}  --}}
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
                        @if($addresses->count())
                            <div class="row text-center py-3">
                                <a href="{{ route('address_by_url', [$url,$id]) }}" class=" text-primary">View All</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal edit_account" id="edit_account">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit Contact</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('edit_contact',[$contact->id])}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Contact Information</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-2">
                                        <label for="" class="">Account Name:</label>
                                        <div>
                                            <select class="select2 select_contact form-control" name="account_id">
                                                <option  value="">Select contact</option>
                                                @foreach($accounts as $account)
                                                    <option  value="{{$account->id}}" @if(isset($contact->parentAccount->id) && $account->id == $contact->parentAccount->id) {{'selected'}} @else {{""}} @endif >{{$account->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if(1>4)
                                    {{-- <div class="mt-2">
                                        <label for="" class="">Contact Owner:</label>
                                        <div>
                                            <select class="select2 select_owner form-control" name="owner_id" >
                                                <option selected value="">Select Contact Owner</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" @if(!empty($contact->ownerUser->id) && $user->id == $contact->ownerUser->id) {{'selected'}} @else {{""}} @endif>{{$user->first_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    @endif
                                    <div class="mt-2">
                                        <label for="" class="">Salutation:</label>
                                        <select class=" form-control" name="solution">
                                            <option selected value="">Select Salutation</option>
                                            <option  value="Mr"  @if($contact->solution == 'Mr') {{'selected'}} @else {{""}} @endif>Mr.</option>
                                            <option  value="Ms" @if($contact->solution == 'Ms') {{'selected'}} @else {{""}} @endif>Ms.</option>
                                            <option  value="Mrs" @if($contact->solution == 'Mrs') {{'selected'}} @else {{""}} @endif>Mrs.</option>
                                            <option  value="Dr" @if($contact->solution == 'Dr') {{'selected'}} @else {{""}} @endif>Dr.</option>
                                            <option  value="Prof" @if($contact->solution == 'Prof') {{'selected'}} @else {{""}} @endif>Prof.</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <label for="personal_name" class="">Suffix:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="suffix" value="{{$contact->suffix}}" id="" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-2">
                                        <label for="personal_name" class="">First Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" required name="first_name" value="{{$contact->first_name}}" id="" >
                                    </div>
                                    <div class="mt-2">
                                        <label for="personal_name" class="">Middle Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="middle_name" value="{{$contact->middle_name}}" id="" >
                                    </div>
                                    <div class="mt-2">
                                        <label for="personal_name" class="">Last Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" required name="last_name" value="{{$contact->last_name}}" id="" >
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="">Job Title:</label>
                                    <input name="job_title" class="form-control" value="{{$contact->job_title}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Communication Details</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 1</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="{{$contact->email_1}}" name="email_1" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 1</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="{{$contact->phone_1}}" name="phone_1" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 2</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="{{$contact->email_2}}" name="email_2" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 2</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="{{$contact->phone_2}}" name="phone_2" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 3</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="{{$contact->email_3}}" name="email_3" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 3</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="{{$contact->phone_3}}" name="phone_3" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 4</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="{{$contact->email_4}}" name="email_4" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 4</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="{{$contact->phone_4}}" name="phone_4" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Additional Information</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="">Reports To:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control" name="reports" >
                                            <option selected value="">Select Reports address</option>
                                            @foreach($contacts as $conta)
                                                <option value="{{$conta->id}}" @if($conta->id == $contact->reports) {{'selected'}} @else {{""}} @endif>{{$conta->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    

                                    <label for="personal_name" class="">Department:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="department" value="{{$contact->department}}" id="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Address Information</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="">Mailing address:</label>
                                        <div>
                                            <select class="select2 select_emails form-control" name="mailing_address">
                                                <option selected value="">Select Mailing address</option>
                                                @foreach($users as $user2)
                                                    <option value="{{$user2->id}}" @if(!empty($contact->reports) && $user2->id == $contact->reports) {{'selected'}} @else {{""}} @endif>{{$user2->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label  class="">Mailing Street:</label>
                                    <textarea  class="form-control" id="" rows="3" name="mailing_street">{{$contact->mailing_street}}</textarea>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="">Mailing City:</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing_city" value="{{$contact->mailing_city}}" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="">Mailing State:</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing_state" value="{{$contact->mailing_state}}" id="" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="">Mailing Country:</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing_country" value="{{$contact->mailing_country}}" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="">Mailing Zip :</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing__zip_code" value="{{$contact->mailing__zip_code}}" id="" >
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
    @include('modals.address')
    @include('modals.contact')
    {{-- @include('modals.company') --}}
    @include('modals.notes')
    @include('modals.files')

    @section('js')
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

            var quill = new Quill('#editor', {
                modules: {
                toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            $(document).ready(function() {
                let editor = $('#editor')
                quill.on('text-change', function(delta, source) {
                    $("#hiddenArea").val($("#editor").html());
                    var delta = quill.getContents();
                });

                $('.select2').each(function(){
                    $(this).select2({
                        dropdownParent:  $(this).parent()
                    });
                })

                $('#active_show_button').click(()=>{
                    $('#active_show_button').remove();
                    $("#activity_form").removeClass('d-none')
                })
            });


        </script>
    @endsection

@endsection