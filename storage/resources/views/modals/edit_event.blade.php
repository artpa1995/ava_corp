{{-- <div class="modal " id="edit_event_">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Event</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_event', [$event->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Calendar Details</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 subject_autocomplete_block">
                                <label for="" class="mr-sm-2">Subject</label>
                                <input type="text" class="form-control subject_autocomplete" id="subject_autocomplete_event"  data-type="event" placeholder="subject" autocomplete="off" name="subject" required>
                                <div class="subject_autocomplete_titles d-none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$event->user_id == $user->id? "selected" : ""}}>{{$user->last_name}} {{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Location</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="location" value="{{$event->location}}" id="">
                            </div>
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" mt-2">
                          
                            <div class="col-6 ">
                                <b>Start</b> 
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="start_date" value="{{ substr($event->start_date, 0, strpos($event->start_date, ' ')) }}" id="" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="start_time" value="{{ $event->start_time}}" id="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <b>End</b> 
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="end_date" value="{{ substr($event->end_date, 0, strpos($event->end_date, ' ')) }}" id="" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="end_time" value="{{ $event->end_time}}" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <div>
                                    <input type="checkbox" class="form-check-input"  name="full_day_event"
                                    {{ $event->full_day_event?"checked" :""}} id="full_day_event" >
                                    <label for="full_day_event" class="mr-sm-2">All-Day Event</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Type</label>
                                <div>
                                    @php
                                    $typies = [1 => 'Call', 2 => 'Email', 3 => 'Meeting',  4 => 'Other'];
                                    @endphp
                                    <select class="select2 select_contact form-control" name="type" required>
                                        @foreach($typies as $key => $type)
                                            <option value="{{$key}}" {{$event->type == $key? "selected" : ""}}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Description</label>
                                <textarea name="description" id="" cols="20" rows="5" class="form-control">{{$event->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Related To</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <div>
                                        <select class="select2 select_emails form-control" name="contact_id">
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" {{$contact->id == $event->contact_id ? "selected" : "" }} >{{$contact->last_name.' '. $contact->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$event->related_to == $account->id? "selected" : ""}}>{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Other Information</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="reminder_set_event" class="mr-sm-2">Reminder Set</label>
                                    <input type="checkbox" class="form-check-input"  name="reminder_set"
                                     {{ $event->reminder_set?"checked" :""}} id="reminder_set_event"  >
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
                                        <div> Created By: {{ Auth::user()->first_name }}. {{$event->created_at}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: {{ Auth::user()->first_name }}. {{$event->updated_at}}</div>
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
</div> --}}


<div class="modal " id="edit_event_">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Event</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_event')}}" method="POST">
                    <input type="hidden" name="id" class="event_id">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Calendar Details</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 subject_autocomplete_block">
                                <label for="" class="mr-sm-2">Subject</label>
                                <input type="text" class="form-control subject_autocomplete" id="subject_autocomplete_event"  data-type="event" placeholder="subject" autocomplete="off" name="subject" required>
                                <div class="subject_autocomplete_titles d-none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control event_assigned_to" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" >{{$user->last_name}} {{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Location</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 event_location" placeholder="" name="location" value="" id="">
                            </div>
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control event_company" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" mt-2">
                          
                            <div class="col-6 ">
                                <b>Start</b> 
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        
                                        <input type="date" class="form-control mb-2 mr-sm-2 event_start_date" placeholder="" name="start_date" value="" id="" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2 event_start_time" placeholder="" name="start_time" value="" id="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <b>End</b> 
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2 event_end_date" placeholder="" name="end_date" value="" id="" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2 event_end_time" placeholder="" name="end_time" value="" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <div>
                                    <input type="checkbox" class="form-check-input full_day_event"  name="full_day_event"
                                     id="full_day_event" >
                                    <label for="full_day_event" class="mr-sm-2">All-Day Event</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Type</label>
                                <div>
                                    @php
                                    $typies = [1 => 'Call', 2 => 'Email', 3 => 'Meeting',  4 => 'Other'];
                                    @endphp
                                    <select class="select2 select_contact form-control event_type" name="type" required>
                                        @foreach($typies as $key => $type)
                                            <option value="{{$key}}" >{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Description</label>
                                <textarea name="description" id="" cols="20" rows="5" class="form-control event_description"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Related To</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <div>
                                        <select class="select2 select_emails form-control event_contact" name="contact_id">
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}">{{$contact->last_name.' '. $contact->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control event_account" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Other Information</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="reminder_set_event" class="mr-sm-2">Reminder Set</label>
                                    <input type="checkbox" class="form-check-input"  name="reminder_set" id="reminder_set_event"  >
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
                                        <div> Created By: <span class="created_by"></span></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: <span class="updated_by"></span></div>
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




<script>
    $(document).ready(function(){

        $('.edit_event').on('click', function(){
            let data = $(this).data('event');
            let typies = {'1':'Call', '2':'Email', '3': 'Meeting', '4': "Other" };

            console.log(data);
            let event_id = $('.event_id');
            let subject_autocomplete = $('.subject_autocomplete');
            let event_assigned_to = $('.event_assigned_to');
            let event_location = $('.event_location');
            let event_company = $('.event_company');
            let event_start_date = $('.event_start_date');
            let event_start_time = $('.event_start_time');
            let event_end_date = $('.event_end_date');
            let event_end_time = $('.event_end_time');
            let full_day_event = $('#full_day_event');
            let event_type = $('.event_type');
            let event_description = $('.event_description');
            let event_contact =$('.event_contact');
            let event_account =$('.event_account');
            let reminder_set_event =$('#reminder_set_event');
            let created_by =$('.created_by');
            let updated_by =$('.updated_by');

            full_day_event.prop('checked', false);
            reminder_set_event.prop('checked', false);

            event_id.val('');
            subject_autocomplete.val('');
            event_location.val('');
            event_start_date.val('');
            event_start_time.val('');
            event_end_date.val('');
            event_end_time.val('');
            event_description.val('');
            created_by.html('')
            updated_by.html('')

            event_assigned_to.val(1).trigger('change.select2');
            event_company.val(1).trigger('change.select2');
            event_type.val(1).trigger('change.select2');
            event_contact.val(1).trigger('change.select2');
            event_account.val(1).trigger('change.select2');

            if(data.id){
                event_id.val(data.id);
            }
            if(data.subject){
                subject_autocomplete.val(data.subject);
            }

            if(data.location){
                event_location.val(data.location);
            }

            if(data.description){
                event_description.val(data.description);
            }

            if(data.user && data.user.first_name && data.user.last_name){
                created_by.html(data.user.last_name+' '+ data.user.first_name )
            }

            if(data.update_user && data.update_user.first_name && data.update_user.last_name){
                updated_by.html(data.update_user.last_name+' '+ data.update_user.first_name )
            }

            if(data.company_id){
                event_company.val(data.company_id).trigger('change.select2');
            }

            if(data.contact_id){
                event_contact.val(data.contact_id).trigger('change.select2');
            }

            if(data.related_to){
                event_account.val(data.related_to).trigger('change.select2');
            }

            if(data.user_id){
                event_assigned_to.val(data.user_id).trigger('change.select2');
            }

            if(data.type){
                event_type.val(data.type).trigger('change.select2');
            }
            
            if(data.start_time){
                event_start_time.val(data.start_time);
            }

            if(data.start_date){
                event_start_date.val(data.start_date.slice(0, 10));
            }

            if(data.end_time){
                event_end_time.val(data.end_time);
            }

            if(data.end_date){
                event_end_date.val(data.end_date.slice(0, 10));
            }

            if(data.full_day_event && data.full_day_event != '0'){
                full_day_event.prop('checked', true);
            }

            if(data.reminder_set && data.reminder_set != '0'){
                reminder_set_event.prop('checked', true);
            }

        })


    })
</script>