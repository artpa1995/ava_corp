@extends('user.layout.app')
@section('title')Log Call @endsection
@section('contents')
    <div class="container rounded bg-white">
        <div class="row rounded-top   py-3 px-3" style="background-color: #F3F3F3">
            <div class="col-8">
                <div class="row ">
                    <div class="col-1">
                        <div  class=" bg_c_call df_jsc_amc notification_icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m69.7 20h-37.6c-3.3 0-6.1 3-6.1 6v2h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v10h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v10h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v2c0 3 2.8 6 6.1 6h37.6c3.3 0 6.3-3 6.3-6.3v-48c0-3.3-3-5.7-6.3-5.7z m-3.6 40.3l-2.8 2.8c-0.6 0.6-1.5 1-2.3 0.9-6.6-0.4-12.8-3.4-17.2-7.7-4.4-4.4-7.4-10.6-7.7-17.2 0-0.9 0.3-1.7 0.9-2.3l2.8-2.8c1.3-1.3 3.5-1.2 4.6 0.3l2.6 3.2c0.9 1.1 0.9 2.6 0.1 3.8l-2.2 3.1c-0.3 0.4-0.3 1 0.1 1.3l4.6 5.1 5.1 4.6c0.4 0.4 0.9 0.4 1.3 0.1l3.1-2.2c1.1-0.8 2.7-0.8 3.8 0.1l3.2 2.6c1.2 0.8 1.3 3 0 4.3z"/></svg>
                        </div>
                    </div>
                    <div class="col-6 ">
                        {{-- {{$subject_calls[$log_call->subject] }} --}}
                        {{$log_call->subject}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{-- <button class="btn" data-toggle="modal" data-target="#edit_call_{{$log_call->id}}">Edit</button> --}}
                <button class="btn edit_call" data-toggle="modal" data-target="#edit_call_" data-call="{{$log_call}}">Edit</button>
                <a class="data_delete_href_from btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-href="{{route('delete_call',[$log_call->id, $url])}}">Delete</a>
                <button class="btn" data-toggle="modal" data-target="#edit_call_comment{{$log_call->id}}">Edit Comment</button>
                <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_call_date{{$log_call->id}}">Edit date</button> </a>
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_call_status{{$log_call->id}}">Edit status</button> </a>
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_call_priority{{$log_call->id}}">Edit priority</button> </a>
                </div>
            </div>
        </div>
        <div class="row py-3 px-3" >
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4">
                                <div>Contact</div>
                                <div><a href="/contact/{{$log_call->contacts->id ?? "0"}}">{{$log_call->contacts->last_name  ?? ""}} {{$log_call->contacts->first_name  ?? ""}}</a> </div>
                            </div>
                            <div class="col-4">
                                <div>Account</div>
                                <div><a href="/account/{{$log_call->account->id ?? "0"}}">{{$log_call->account->name ?? ""}}</a> </div>
                            </div>
                            <div class="col-4">
                                <div>Company</div>
                                <div><a href="/company/{{$log_call->company->id ?? "0"}}">{{$log_call->company->name ?? ""}}</a> </div>
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
                                <b>Call Information</b>
                            </div>
                        </div>
                    </div>
                    <div id="call_info" class="show collapse px-2">
                        <div class="row">
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Subject</label>
                                {{-- <p>{{$subject_calls[$log_call->subject] }}</p> --}}
                                <p>{{$log_call->subject }}</p>
                                        {{-- @php
                                            $subject_options = [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'];
                                        @endphp --}}
                                        {{-- <select class="select2 select_contact form-control" name="subject" required disabled>
                                            @foreach($subject_options as $key => $subject_option)
                                                <option value="{{$key}}" {{$log_call->subject == $key? "selected" : ""}}>{{$subject_option}}</option>
                                            @endforeach
                                        </select> --}}
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <p>{{$log_call->company->name??''}}</p>
                                {{-- <select class="select2 select_contact form-control" name="company_id" required disabled>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            {{-- <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                 <p>{{$log_call->contacts->title??''}} </p>
                                <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required disabled>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$log_call->user_id == $user->id? "selected" : ""}}>{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <p>{{ substr($log_call->date, 0, strpos($log_call->date, ' ')) }}</p>
                                {{-- <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" disabled name="date" value="{{ substr($log_call->date, 0, strpos($log_call->date, ' ')) }}" id="" required> --}}
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-6 ">
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <p>{{$log_call->contacts->last_name??''}} {{$log_call->contacts->first_name??''}} </p>
                                    {{-- <div>
                                        <select class="select2 select_emails form-control" name="contact_id" disabled>
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" {{$contact->id == $log_call->contact_id ? "selected" : "" }} >{{$contact->title}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Account To</label>
                                <p>{{$log_call->account->name??''}}</p>
                                {{-- <select class="select2 select_contact form-control" name="related_to" required disabled>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$log_call->related_to == $account->id? "selected" : ""}}>{{$account->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-12 ">
                                <label for="" class="mr-sm-2">Comment</label>
                                <p>{{$log_call->comments}}</p>
                                {{-- <textarea name="comments" id="" cols="10" rows="3" class="form-control" disabled>{{$log_call->comments}}</textarea> --}}
                            </div>
                        </div>
                     </div>
                    <div class="col-12 mb-2 mt-2">
                        <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#call_add_info" style="">
                            <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                            <b>Additional Informatio</b>
                        </div>
                    </div>
                    <div id="call_add_info" class="show collapse px-2">
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-6 ">
                                    <label for="" class="mr-sm-2">Priority</label>
                                    <p>{{$log_call->priority == 1 ? "Normal" : "High"}}</p>
                                    {{-- <div>
                                        <select class="select2 select_emails form-control" name="priority" disabled >
                                            <option value="1" {{ $log_call->priority == 1 ? "selected" : "" }} >Normal</option>
                                            <option value="2" {{$log_call->priority == 2 ? "selected" : "" }} >High</option>
                                        </select>
                                    </div> --}}
                                
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Status</label>
                                <p>{{$log_call->status == 1 ? "Open" : "Completed"}}</p>
                                    {{-- <div>
                                        <select class="select2 select_emails form-control" name="status" disabled >
                                            <option value="1" {{ $log_call->status == 1 ? "selected" : "" }} >Open</option>
                                            <option value="2" {{$log_call->status == 2 ? "selected" : "" }} >Completed</option>
                                        </select>
                                    </div> --}}
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
                                    <label for="reminder_set_call" class="mr-sm-2">Reminder Set</label>
                                    <p>{{$log_call->reminder_set ? "YES" : "NO"}}</p>
                                    {{-- <input type="checkbox" class="form-check-input"  name="reminder_set"
                                           {{ $log_call->reminder_set?"checked" :""}} id="reminder_set_call"  disabled> --}}
                               
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="create_recurring_series_of_tasks_call" class="mr-sm-2">Create Recurring Series of Tasks</label>
                                <p>{{$log_call->create_recurring_series_of_tasks ? "YES" : "NO"}}</p>
                                {{-- <input type="checkbox" class="form-check-input"  name="create_recurring_series_of_tasks"
                                        {{ $log_call->create_recurring_series_of_tasks?"checked" :""}} id="create_recurring_series_of_tasks_call" disabled> --}}
                            
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6"> System Information</div>
                        </div>
                        <div class=" mt-2 pt-1 px-2 pb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div> Created By: {{ $log_call->user->last_name }} {{ $log_call->user->first_name }}. {{$log_call->created_at}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: {{!empty($log_call->updateUser)? $log_call->updateUser->last_name :''}} {{ !empty($log_call->updateUser)?$log_call->updateUser->first_name:'' }}. {{$log_call->updated_at}}</div>
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
                </div>
            </div>
        </div>
    </div>
    @include('modals.edit_call')
    @include('modals.delete_modal')
@endsection