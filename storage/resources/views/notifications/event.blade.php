@extends('user.layout.app')
@section('title')Event @endsection
@section('contents')
    <div class="container rounded bg-white">
        <div class="row rounded-top   py-3 px-3" style="background-color: #F3F3F3">
            <div class="col-10">
                <div class="row ">
                    <div class="col-1">
                        <div class=" bg_c_event df_jsc_amc notification_icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m76 42h-52c-1.1 0-2 0.9-2 2v30c0 3.3 2.7 6 6 6h44c3.3 0 6-2.7 6-6v-30c0-1.1-0.9-2-2-2z m-36 28c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m4-30h-5v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-18v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-5c-3.3 0-6 2.7-6 6v2c0 1.1 0.9 2 2 2h52c1.1 0 2-0.9 2-2v-2c0-3.3-2.7-6-6-6z"></path></svg>
                        </div>
                    </div>
                    <div class="col-6 ">
                        {{-- {{$subject_events[$event->subject] }} --}}
                        {{$event->subject}}
                    </div>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <button class="btn edit_event" data-toggle="modal" data-target="#edit_event_" data-event="{{$event}}">Edit</button>
                <a class="data_delete_href_from btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-href="{{route('delete_event',[$event->id, $url])}}">Delete</a>
                {{-- <a href="{{route('delete_event',[$event->id, $url])}}" class="btn btn-danger">Delete</a> --}}
             
                {{-- <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_event_date{{$event->id}}">Edit date</button> </a>
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_event_status{{$event->id}}">Edit status</button> </a>
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_event_priority{{$event->id}}">Edit priority</button> </a>
                </div> --}}
            </div>
        </div>
        <div class="row py-3 px-3" >
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4">
                                <div>Contact</div>
                                <div><a href="/contact/{{$event->contacts->id ?? "0"}}">{{$event->contacts->last_name??''}} {{$event->contacts->first_name??''}}</a> </div>
                            </div>
                            <div class="col-4">
                                <div>Account</div>
                                <div><a href="/account/{{$event->account->id ?? "0"}}">{{$event->account->name ?? ""}}</a> </div>
                            </div>
                            <div class="col-4">
                                <div>Company</div>
                                <div><a href="/company/{{$event->company->id ?? "0"}}">{{$event->company->name ?? ""}}</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 ">

                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <div class="container rounded bg-white mt-3 py-3">
        <div class="row rounded-top   py-3 px-3" >
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#details">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#related">Related</a>
                </li>

            </ul>
        </div>
        <div class="row">
            <div class="tab-content">
                <div class="tab-pane container active" id="details">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#call_info" style="">
                                <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                <b>Calendar Details</b>
                            </div>
                        </div>
                    </div>
                    <div id="call_info" class="show collapse px-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="notifications_view_blocks">
                                    <label for="" class="mr-sm-2">Subject</label>
                                    {{-- <p>{{$subject_events[$event->subject] }}</p> --}}
                                    <p>{{$event->subject}}</p>
                                    {{-- <div>
                                        @php
                                        $subject_options = [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'];
                                        @endphp
                                        <select class="select2 select_contact form-control" name="subject" required disabled>
                                            @foreach($subject_options as $key => $subject_option)
                                                <option value="{{$key}}" {{$event->subject == $key? "selected" : ""}}>{{$subject_option}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div  class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <p>{{$event->contacts?$event->contacts->title:""}}</p>
                                  <div> 
                                    <select class="select2 select_contact form-control" name="assigned_to" required disabled>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$event->user_id == $user->id? "selected" : ""}}>{{$user->email}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div> 
                            </div> --}}
                        </div>
                        <div class="row mt-2">
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Location</label>
                                <p>{{$event->location}}</p>
                                {{-- <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="location" value="{{$event->location}}" id="" disabled> --}}
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                
                                <p>{{$event->company?$event->company->name: ""}}</p>
                                {{-- <select class="select2 select_contact form-control" name="company_id" required disabled>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>

                        <div class=" mt-2">
                          
                            <div class="col-6 ">
                                <b>Start</b> 
                                <div class="row">
                                    <div class="notifications_view_blocks col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <p>{{ substr($event->start_date, 0, strpos($event->start_date, ' ')) }}</p>
                                        {{-- <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" disabled name="start_date" value="{{ substr($event->start_date, 0, strpos($event->start_date, ' ')) }}" id="" required> --}}
                                    </div>
                                    <div class="notifications_view_blocks col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <p>{{ $event->start_time}}</p>
                                        {{-- <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" disabled name="start_time" value="{{ $event->start_time}}" id="" required> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <b>End</b> 
                                <div class="row">
                                    <div class="notifications_view_blocks col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <p>{{ substr($event->end_date, 0, strpos($event->end_date, ' ')) }}</p>
                                        {{-- <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" disabled name="end_date" value="{{ substr($event->end_date, 0, strpos($event->end_date, ' ')) }}" id="" required> --}}
                                    </div>
                                    <div class="notifications_view_blocks col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <p>{{ $event->end_time}}{{ $event->end_time}}</p>
                                        {{-- <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" disabled name="end_time" value="{{ $event->end_time}}" id="" required> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <div  class="notifications_view_blocks">
                                    {{-- <input type="checkbox" class="form-check-input"  name="full_day_event"
                                    {{ $event->full_day_event?"checked" :""}} id="full_day_event"  disabled> --}}
                                    <label for="full_day_event" class="mr-sm-2">All-Day Event</label>
                                    <p>{{ $event->full_day_event?"YES" :"NO"}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="notifications_view_blocks col-6 " >
                                <label for="" class="mr-sm-2">Type</label>
                               
                                    @php
                                    $typies = [1 => 'Call', 2 => 'Email', 3 => 'Meeting',  4 => 'Other'];
                                    @endphp

                                    <p>{{$event->type? $typies[$event->type]:""}}</p>
                                    {{-- <div>
                                        <select class="select2 select_contact form-control" name="type" required disabled>
                                            @foreach($typies as $key => $type)
                                                <option value="{{$key}}" {{$event->type == $key? "selected" : ""}}>{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="notifications_view_blocks col-12 ">
                                <label for="" class="mr-sm-2">Description</label>
                                <p>{{$event->description}}</p>
                                {{-- <textarea name="description" id="" cols="20" rows="5" class="form-control" disabled>{{$event->description}}</textarea> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2 mt-2">
                        <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#call_add_info" style="">
                            <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                            <b>Related To</b>
                        </div>
                    </div>
                    <div id="call_add_info" class="show collapse px-2">
                        <div class="row mt2">
                            <div class="col-6">
                                <div class="notifications_view_blocks">
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <p>{{$event->contacts->last_name??''}} {{$event->contacts->first_name??''}}</p>
                                    {{-- <div>
                                        <select class="select2 select_emails form-control" name="contact_id" disabled>
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" {{$contact->id == $event->contact_id ? "selected" : "" }} >{{$contact->title}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Account To</label>
                                <p>{{$event->account->name??''}}</p>
                                {{-- <select class="select2 select_contact form-control" name="related_to" required disabled>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$event->related_to == $account->id? "selected" : ""}}>{{$account->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2 mt-2">
                        <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#call_other_info" style="">
                            <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                            <b>Other Information</b>
                        </div>
                    </div>
                    <div id="call_other_info" class="show collapse px-2">
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-6 ">
                                
                                    <label for="reminder_set_event" class="mr-sm-2">Reminder Set</label>
                                    <p>{{ $event->reminder_set?"YES" :"NO"}}</p>
                                    {{-- <input type="checkbox" class="form-check-input"  name="reminder_set"
                                           {{ $event->reminder_set?"checked" :""}} id="reminder_set_event"  disabled> --}}
                                
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <div>
                                    <label for="create_recurring_series_of_events_event" class="mr-sm-2">Create Recurring Series of events</label>
                                    <p>{{ $event->create_recurring_series_of_events?"YES" :"NO"}}</p>
                                    {{-- <input type="checkbox" class="form-check-input"  name="create_recurring_series_of_events"
                                           {{ $event->create_recurring_series_of_events?"checked" :""}} id="create_recurring_series_of_events_event" disabled> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6"> System Information</div>
                        </div>
                        <div class=" mt-2 pt-1 px-2 pb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div> Created By: {{ $event->user->last_name }} {{ $event->user->first_name }}. {{$event->created_at}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: {{!empty($event->updateUser)? $event->updateUser->last_name :''}} {{ !empty($event->updateUser)?$event->updateUser->first_name:'' }}. {{$event->updated_at}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane container " id="related">
                    <div class="col-12 sales_blocks">
                        <span>Attachments(0)</span>
                    </div>
                    @php $url = 'event' @endphp
                    <div class="col-12 rounded mt-3">
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
                                        <button class="btn btn-outline-primary clear_notes_form" data-toggle="modal" data-target="#create_notes">New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="notes" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                            <div class="  pt-1 px-2 pb-3">
                                @foreach($notes as $key => $not)
                                @php if($key > 2)continue; @endphp
                                <div class="mt-3 px-2 border-bottom">
                                    <a data-toggle="modal" data-target="#create_notes"  class="text-primary notes_title_content" id="">{{$not->title??"Untitled Note"}}</a>
                                    <p>{{$not->created_at}} by <span class="text-primary">{{Auth::user()->first_name}}</span></p>
                                    <p >{!! $not->content !!}</p>
                                    <input type="hidden" value="{{ $not->content }}" class="notes_content">
                                    <input type="hidden" value="{{route('edit_notes', [$not->id])}}" class="notes_action">
                                    <input type="hidden" value="{{ route('delete_notes', [$not->id]) }}" class="notes_delete_hreff">
                                </div> 
                            @endforeach
                            </div>
                            <div class="row text-center py-3">
                                <a href="{{ route('notes', [$url,$id]) }}" class=" text-primary">View All</a>
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
                                    <div class="mt-3 border-buttom">
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
                                                <p class="text-primary">{{$file_data->name??''}}</p>
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
                            <div class="row text-center py-3">
                                <a href="{{ route('files', [$url,$id]) }}" class=" text-primary">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.edit_event')
    @include('modals.delete_modal')
    @include('modals.notes')
    @include('modals.files')
    <div class="modal " id="edit_event_comment{{$event->id}}">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content  py-3" >
                <div class="modal_content_head ">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <div class="file_download_href">
                <a href="" download>Download</a>
                </div>
                <img src="" alt="" >
            </div>
        </div>
    </div>

@endsection