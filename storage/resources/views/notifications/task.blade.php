@extends('user.layout.app')
@section('title')Task @endsection
@section('contents')
    <div class="container rounded bg-white">
        <div class="row rounded-top   py-3 px-3" style="background-color: #F3F3F3">
            <div class="col-8">
                <div class="row ">
                    <div class="col-1">
                        <div  class=" bg_c_quotes df_jsc_amc notification_icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m46.6 23.7l-2.1-2.1c-0.6-0.6-1.5-0.6-2.1 0l-13.2 13.2-5.3-5.3c-0.6-0.6-1.5-0.6-2.1 0l-2.1 2.1c-0.6 0.6-0.6 1.5 0 2.1l7.4 7.4c0.6 0.6 1.4 0.9 2.1 0.9 0.8 0 1.5-0.3 2.1-0.9l15.3-15.3c0.5-0.5 0.5-1.5 0-2.1z m30.4 14.3h-26c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h26c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m-44 0h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m44 0h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z"></path></svg>
                        </div>
                    </div>
                    <div class="col-6 ">
                        {{-- {{$subject_tasks[$task->subject] }} --}}
                        {{$task->subject}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{-- <button class="btn" data-toggle="modal" data-target="#edit_task_{{$task->id}}">Edit</button> --}}
                <button class="btn edit_task" data-toggle="modal" data-target="#edit_task_" data-task="{{$task}}">Edit</button>
                <a class="data_delete_href_from btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-href="{{route('delete_task',[$task->id, $url])}}">Delete</a>
                <button class="btn" data-toggle="modal" data-target="#edit_task_comment{{$task->id}}">Edit Comment</button>

                <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_task_date{{$task->id}}">Edit date</button> </a>
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_task_status{{$task->id}}">Edit status</button> </a>
                    <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_task_priority{{$task->id}}">Edit priority</button> </a>
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
                                <div><a href="/contact/{{$task->contacts->id ?? "0"}}">{{$task->contacts->last_name ?? ""}} {{$task->contacts->first_name ?? ""}}</a> </div>
                            </div>
                            <div class="col-4">
                                <div>Account</div>
                                <div><a href="/account/{{$task->account->id ?? "0"}}">{{$task->account->name ?? ""}}</a> </div>
                            </div>
                            <div class="col-4">
                                <div>Company</div>
                                <div><a href="/company/{{$task->company->id ?? "0"}}">{{$task->company->name ?? ""}}</a> </div>
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
                                    {{-- @php
                                        $subject_options = [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'];
                                    @endphp --}}
                                    <p>
                                        {{-- {{$subject_options[$task->subject] }} --}}
                                         {{$task->subject}}
                                    </p>
                                    {{-- <div>
                                        <select class="select2 select_contact form-control" name="subject" required disabled>
                                            @foreach($subject_options as $key => $subject_option)
                                                <option value="{{$key}}" {{$task->subject == $key? "selected" : ""}}>{{$subject_option}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <p>{{$task->company->name??""}}</p>
                                {{-- <select class="select2 select_contact form-control" name="company_id" required disabled>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <p>{{$task->user->email}}</p>
                                {{-- <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required disabled>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$task->user_id == $user->id? "selected" : ""}}>{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <p>{{ substr($task->date, 0, strpos($task->date, ' ')) }}</p>
                                {{-- <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" disabled name="date" value="{{ substr($task->date, 0, strpos($task->date, ' ')) }}" id="" required> --}}
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-6 ">
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <p>{{$task->contacts->last_name ?? ""}} {{$task->contacts->first_name ?? ""}}</p>
                                    {{-- <div>
                                        <select class="select2 select_emails form-control" name="contact_id" disabled>
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" {{$contact->id == $task->contact_id ? "selected" : "" }} >{{$contact->title}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Account To</label>
                                <p>{{$task->account->name??""}}</p>
                                {{-- <select class="select2 select_contact form-control" name="related_to" required disabled>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$task->related_to == $account->id? "selected" : ""}}>{{$account->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-12 ">
                                <label for="" class="mr-sm-2">Comment</label>
                                <p>{{$task->comments??''}}</p>
                                {{-- <textarea name="comments" id="" cols="10" rows="3" class="form-control" disabled>{{$task->comments}}</textarea> --}}
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
                                <p>{{$task->priority == 1 ? "Normal" : "High"}}</p>
                                {{-- <div>
                                    <select class="select2 select_emails form-control" name="priority" disabled >
                                        <option value="1" {{ $task->priority == 1 ? "selected" : "" }} >Normal</option>
                                        <option value="2" {{$task->priority == 2 ? "selected" : "" }} >High</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="notifications_view_blocks col-6 ">
                                <label for="" class="mr-sm-2">Status</label>
                                <p>{{$task->status == 1 ? "Open" : "Completed"}}</p>
                                        {{-- <select class="select2 select_emails form-control" name="status" disabled >
                                            <option value="1" {{ $task->status == 1 ? "selected" : "" }} >Open</option>
                                            <option value="2" {{$task->status == 2 ? "selected" : "" }} >Completed</option>
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
                                    <label for="reminder_set_task" class="mr-sm-2">Reminder Set</label>
                                    <p>{{$task->reminder_set ? "YES" : "NO"}}</p>
                                    {{-- <input type="checkbox" class="form-check-input"  name="reminder_set"
                                           {{ $task->reminder_set?"checked" :""}} id="reminder_set_task"  disabled> --}}
                               
                            </div>
                            <div class="notifications_view_blocks col-6 ">
                                    <label for="create_recurring_series_of_tasks_task" class="mr-sm-2">Create Recurring Series of Tasks</label>
                                    <p>{{$task->create_recurring_series_of_tasks ? "YES" : "NO"}}</p>
                                    {{-- <input type="checkbox" class="form-check-input"  name="create_recurring_series_of_tasks"
                                           {{ $task->create_recurring_series_of_tasks?"checked" :""}} id="create_recurring_series_of_tasks_task" disabled> --}}
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6"> System Information</div>
                        </div>
                        <div class=" mt-2 pt-1 px-2 pb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div> Created By: {{ $task->user->last_name }} {{ $task->user->first_name }}. {{$task->created_at}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: {{!empty($task->updateUser)? $task->updateUser->last_name :''}} {{ !empty($task->updateUser)?$task->updateUser->first_name:'' }}. {{$task->updated_at}}</div>
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
    @include('modals.edit_task')
    @include('modals.delete_modal')

@endsection