    <div class="tab-pane container active" id="menu1">
        <div class="col-12 mt-3 px-2">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link  d-none" data-toggle="tab" href="#menu1_1">Email</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" data-toggle="tab" href="#menu5_1">Activity</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " data-toggle="tab" href="#menu2_1">Log a call</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3_1">New Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4_1">New Event</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane container  d-none" id="menu1_1">
                    <div class="row mt-3" id="active_show_button">
                        <div class="col-12" >
                            <div class="row mt-3">
                                <div class="col-9" style="pointer-events: none;">
                                    <input required type="email" class="form-control mb-2 mr-sm-2" placeholder="Write an email..."  value="" id="" style="pointer-event:none">
                                </div>
                                <div class="col-3" style="pointer-events: none;">
                                    <input type="button" class="form-control mb-2 mr-sm-2 btn btn-primary"   value="Compose" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-none" id="activity_form">
                        <div class="col-12">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <form action="{{route('send_email')}}" method="POST" class="form-inline">
                                        @csrf
                                        <div class="col-12" >
                                            <label for="from" class="mr-sm-2 ">From</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="From" name="from" value="{{ Auth::user()->email }}" id="from"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="to" class="mr-sm-2">To</label>
                                            <input type="email" class="form-control mb-2 mr-sm-2" placeholder="To" name="to" value="" id="to"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="Bcc" class="mr-sm-2">Bcc</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Bcc" name="Bcc" value="" id="Bcc"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="Subject" class="mr-sm-2">Subject</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Subject" name="subject" value="" id="Subject"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="" class="mr-sm-2">Content</label>
                                            <div id="editor"> </div>
                                            <textarea name="content" style="display:none" id="hiddenArea"></textarea>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="related_to" class="mr-sm-2">Account To</label>
                                            <select class="select2 select_contact form-control" name="related_to" required>
                                                <option value="0" >None</option>
                                                @foreach($accounts as $acc)
                                                    <option value="{{$acc->id}}" >{{$acc->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-info mt-3 text-white" value="Send">
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3 emails_blocks_scroll">
                                @foreach($emails as $email)
                                    <div class="row mt-3">
                                        <div class="col-3">  {{$email->subject}}</div>
                                        <div class="col-3">  {{$email->to}}</div>
                                        <div class="col-3"> <a href="{{route('delete_email',[$email->id])}}" class="btn btn-outline-danger">Delete</a></div>
                                        <div class="col-3">  {{$email->created_at}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane container  mt-3 show active" id="menu5_1">
                    @if(!empty($company_task_sets))
                    <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#task_set_colaps" style="">
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        <b>Task Set</b>
                    </div>

                    <div id="task_set_colaps" class="show collapse">
                        <div class="row px-2 py-2">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Tasks</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach($company_task_sets as $company_task_set)
                                        <tbody>
                                            <tr>
                                                <td>{{$company_task_set['name']}}</td>
                                                <td>{{count($company_task_set['task_relation'])}}</td>
                                                <td> 
                                                    <div class="d-flex justify-content-end">
                                                        <a class="edit_task_set cursor-pointer" data-all="{{ json_encode($company_task_set) }}" data-toggle="modal" data-target="#edit_task_set" >
                                                            <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                                        </a>
                                                        <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_task_set', [$company_task_set['id']]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="tab-pane container  mt-3  " id="menu2_1">
                    <form action="{{route('add_log_call')}}" method="POST" class="form-inline">
                        @csrf
                        <div class="col-12 mt-3 subject_autocomplete_block">
                            <label for="" class="mr-sm-2">Subject</label>
                            <input type="text" class="form-control subject_autocomplete" data-type="call" id="subject_autocomplete_call" placeholder="subject" autocomplete="off" name="subject" required>
                            <div class="subject_autocomplete_titles d-none">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="comment" class="mr-sm-2">Comment</label>
                            <textarea name="comments" class="form-control"  ></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 mt-3">
                                <label for="contact_id" class="mr-sm-2">Contact</label>
                                <select class="select2 select_contact form-control" name="contact_id" required>
                                    <option value="0">None</option>
                                    @foreach($contacts as $contac)
                                        <option value="{{$contac->id}}" {{!empty($contact) && $contact->id == $contac->id ? "selected" : ""}}>{{$contac->last_name.', '. $contac->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="related_to" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $acco)
                                        <option value="{{$acco->id}}" {{!empty($account) && $account->id == $acco->id ? "selected" : ""}}>{{$acco->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $compan)
                                        <option value="{{$compan->id}}" {{!empty($company) && $company->id == $compan->id ? "selected" : ""}}>{{$compan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info mt-3 text-white" value="Save">
                    </form>
                </div>
                <div class="tab-pane container fade" id="menu3_1">
                    <form action="{{route('add_task')}}" method="POST" class="form-inline">
                        @csrf
                        <div class="col-12 mt-3 subject_autocomplete_block">
                            <label for="" class="mr-sm-2">Subject</label>
                            <input type="text" class="form-control subject_autocomplete"  data-type="task" id="subject_autocomplete_task" placeholder="subject" autocomplete="off" name="subject" required>
                            <div class="subject_autocomplete_titles d-none">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="date" value="" id="" >
                            </div>

                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                {{Auth::user()->id}}
                                <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ Auth::user()->id == $user->id? "selected" : ""}}>{{$user->last_name}} {{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 mt-3">
                                <label for="contact_id" class="mr-sm-2">Contact</label>
                                <select class="select2 select_contact form-control" name="contact_id" required>
                                    <option value="0">None</option>
                                    @foreach($contacts as $contac)
                                        <option value="{{$contac->id}}" {{!empty($contact) && $contact->id == $contac->id ? "selected" : ""}}>{{$contac->last_name.', '.$contac->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="related_to" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $acco)
                                        <option value="{{$acco->id}}" {{!empty($account) && $account->id == $acco->id ? "selected" : ""}}>{{$acco->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $compan)
                                        <option value="{{$compan->id}}" {{!empty($company) && $company->id == $compan->id ? "selected" : ""}}>{{$compan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info mt-3 text-white" value="Save">
                    </form>
                </div>
                <div class="tab-pane container fade" id="menu4_1">
                    <form action="{{route('add_event')}}" method="POST" class="form-inline">
                        @csrf
                        <div class="col-12 mt-3 subject_autocomplete_block">
                            <label for="" class="mr-sm-2">Subject</label>
                            <input type="text" class="form-control subject_autocomplete" id="subject_autocomplete_event"  data-type="event" placeholder="subject" autocomplete="off" name="subject" required>
                            <div class="subject_autocomplete_titles d-none">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="" class="mr-sm-2">Description</label>
                            <textarea name="description" class="form-control"  ></textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 mt-2 ">
                                <b>Start</b>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="start_date" value="" id="" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="start_time" value="" id="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2 ">
                                <b>End</b>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="end_date" value="" id="" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="end_time" value="" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Location</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Location" name="location" value="" id="">
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Contact</label>
                                <select class="select2 select_contact form-control" name="contact_id" required>
                                    <option value="0">None</option>
                                    @foreach($contacts as $contac)
                                        <option value="{{$contac->id}}" {{!empty($contact) && $contact->id == $contac->id ? "selected" : ""}}>{{$contac->last_name.', '.$contac->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6  ">
                                <label for="related_to" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $acco)
                                        <option value="{{$acco->id}}" {{!empty($account) && $account->id == $acco->id ? "selected" : ""}}>{{$acco->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $compan)
                                        {{--<option value="{{$company->id}}">{{$company->name}}</option>--}}
                                        <option value="{{$compan->id}}" {{!empty($company) && $company->id == $compan->id ? "selected" : ""}}>{{$compan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info mt-3 text-white" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('modals.delete_modal')
