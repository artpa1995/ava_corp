<div class="modal " id="edit_call_">

    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Call</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_call')}}" method="POST">
                    <input type="hidden" name="id"  class="call_id">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Call Information</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 subject_autocomplete_block">
                                <label for="" class="mr-sm-2">Subject</label>
                                <input type="text" class="form-control subject_autocomplete" data-type="call" placeholder="subject" autocomplete="off" name="subject" required>
                                <div class="subject_autocomplete_titles d-none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control call_company" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                  
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control call_assigned_to" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->last_name}} {{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2 call_due_date" placeholder="" name="date" value="" id="" required>
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <div>
                                        <select class="select2 select_emails form-control call_contact" name="contact_id">
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" >{{$contact->last_name.', '. $contact->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control call_account" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" >{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Comment</label>
                                <textarea name="comments" id="" cols="20" rows="5" class="form-control call_description"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Additional Information</div>
                        </div>

                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Priority</label>
                                    <div>
                                        <select class="select2 select_emails form-control all_priority" name="priority" >
                                            <option value="1">Normal</option>
                                            <option value="2">High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2 ">Status</label>
                                    <div>
                                        <select class="select2 select_emails form-control call_status" name="status" >
                                            <option value="1">Open</option>
                                            <option value="2">Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Other Information</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="reminder_set_call" class="mr-sm-2">Reminder Set</label>
                                    <input type="checkbox" class="form-check-input"  name="reminder_set" id="reminder_set_call" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label for="create_recurring_series_of_calls_call" class="mr-sm-2">Create Recurring Series of calls</label>
                                    <input type="checkbox" class="form-check-input"  name="create_recurring_series_of_calls" id="create_recurring_series_of_calls_call" >
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
@if(!empty($log_call))
<div class="modal " id="edit_call_comment{{$log_call->id}}">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Comment</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_call', [$log_call->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Comment</label>
                                <textarea name="comments" id="" cols="20" rows="5" class="form-control">{{$log_call->comments}}</textarea>
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


<div class="modal " id="edit_call_date{{$log_call->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Date</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_call', [$log_call->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="date" value="{{ substr($log_call->date, 0, strpos($log_call->date, ' ')) }}" id="" required>
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

<div class="modal " id="edit_call_status{{$log_call->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Status</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_call', [$log_call->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div>
                            <label for="" class="mr-sm-2">Status</label>
                            <div>
                                <select class="select2 select_emails form-control" name="status" >
                                    <option value="1" {{ $log_call->status == 1 ? "selected" : "" }} >Open</option>
                                    <option value="2" {{$log_call->status == 2 ? "selected" : "" }} >Completed</option>
                                </select>
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

<div class="modal " id="edit_call_priority{{$log_call->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Priority</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_call', [$log_call->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div>
                                <label for="" class="mr-sm-2">Priority</label>
                                <div>
                                    <select class="select2 select_emails form-control" name="priority" >
                                        <option value="1" {{ $log_call->priority == 1 ? "selected" : "" }} >Normal</option>
                                        <option value="2" {{$log_call->priority == 2 ? "selected" : "" }} >High</option>
                                    </select>
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
@endif


<script>
    $(document).ready(function(){

        $('.edit_call').on('click', function(){
            let data = $(this).data('call');
            let typies = {'1':'Call', '2':'Email', '3': 'Meeting', '4': "Other" };

            console.log(data);
            let call_id = $('.call_id');
            let subject_autocomplete = $('.subject_autocomplete');
            let call_assigned_to = $('.call_assigned_to');
            let call_location = $('.call_location');
            let call_company = $('.call_company');
            let call_due_date = $('.call_due_date');
            let call_create_recurring_series_of_calls = $('#call_create_recurring_series_of_calls');
            let call_type = $('.call_type');
            let call_description = $('.call_description');
            let call_contact =$('.call_contact');
            let call_account =$('.call_account');
            let reminder_set_call =$('#reminder_set_call');
            let created_by =$('.created_by');
            let updated_by =$('.updated_by');
            let call_priority = $('.call_priority')
            let call_status = $('.call_status')

            call_create_recurring_series_of_calls.prop('checked', false);
            reminder_set_call.prop('checked', false);

            call_id.val('');
            subject_autocomplete.val('');
            call_location.val('');
            call_due_date.val('');
            call_description.val('');
            created_by.html('')
            updated_by.html('')

            call_assigned_to.val(1).trigger('change.select2');
            call_company.val(1).trigger('change.select2');
            call_type.val(1).trigger('change.select2');
            call_contact.val(1).trigger('change.select2');
            call_account.val(1).trigger('change.select2');
            call_priority.val(1).trigger('change.select2');
            call_status.val(1).trigger('change.select2');

            if(data.id){
                call_id.val(data.id);
            }
            if(data.subject){
                subject_autocomplete.val(data.subject);
            }

            if(data.location){
                call_location.val(data.location);
            }

            if(data.comments){
                call_description.val(data.comments);
            }

            if(data.user && data.user.first_name && data.user.last_name){
                created_by.html(data.user.last_name+' '+ data.user.first_name )
            }

            if(data.update_user && data.update_user.first_name && data.update_user.last_name){
                updated_by.html(data.update_user.last_name+' '+ data.update_user.first_name )
            }

            if(data.company_id){
                call_company.val(data.company_id).trigger('change.select2');
            }

            if(data.priority){
                call_priority.val(data.priority).trigger('change.select2');
            }

            if(data.status){
                call_status.val(data.status).trigger('change.select2');
            }

            if(data.contact_id){
                call_contact.val(data.contact_id).trigger('change.select2');
            }

            if(data.related_to){
                call_account.val(data.related_to).trigger('change.select2');
            }

            if(data.user_id){
                call_assigned_to.val(data.user_id).trigger('change.select2');
            }
         
            if(data.date){
                call_due_date.val(data.date.slice(0, 10));
            }

            if(data.create_recurring_series_of_calls && data.create_recurring_series_of_calls != '0'){
                call_create_recurring_series_of_calls.prop('checked', true);
            }

            if(data.reminder_set && data.reminder_set != '0'){
                reminder_set_call.prop('checked', true);
            }
        })
    })
</script>