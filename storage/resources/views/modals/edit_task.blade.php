 <div class="modal " id="edit_task_">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Task</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task')}}" method="POST">
                    <input type="hidden" name="id"  class="task_id">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Task Information</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 subject_autocomplete_block">
                                <label for="" class="mr-sm-2">Subject</label>
                                <input type="text" class="form-control subject_autocomplete" id=""  data-type="task" placeholder="subject" autocomplete="off" name="subject" required>
                                <div class="subject_autocomplete_titles d-none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <div>
                                    <select class="select2 select_emails form-control task_company" name="company_id">
                                         @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control task_assigned_to" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->last_name}} {{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2 task_due_date" placeholder="" name="date" value="" id="" >
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Name</label>
                                    <div>
                                        <select class="select2 select_emails form-control task_contact" name="contact_id">
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}">{{$contact->last_name.', '. $contact->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control task_account" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Comment</label>
                                <textarea name="comments" id="" cols="20" rows="5" class="form-control task_description" ></textarea>
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
                                        <select class="select2 select_emails form-control task_priority" name="priority" required>
                                            <option value="1"  >Normal</option>
                                            <option value="2">High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Status</label>
                                    <div>
                                        <select class="select2 select_emails form-control task_status" name="status" required>
                                            <option value="1">Open</option>
                                            <option value="2" >Completed</option>
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
                                    <input type="checkbox" class="form-check-inpu task_reminder_set"  name="reminder_set" id="reminder_set_task" >
                                     <label for="reminder_set_task" class="mr-sm-2">Reminder Set</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <input type="checkbox" class="form-check-input task_create_recurring_series_of_tasks"  name="create_recurring_series_of_tasks"  id="task_create_recurring_series_of_tasks" >
                                     <label for="create_recurring_series_of_tasks" class="mr-sm-2">Create Recurring Series of Tasks</label>
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
@if(!empty($task))
<div class="modal " id="edit_task_comment{{$task->id}}">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Comment</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Comment</label>
                                <textarea name="comments" id="" cols="20" rows="5" class="form-control">{{$task->comments}}</textarea>
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

<div class="modal " id="edit_task_date{{$task->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Date</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="date" value="{{ substr($task->date, 0, strpos($task->date, ' ')) }}" id="" >
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

<div class="modal " id="edit_task_status{{$task->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Status</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div>
                            <label for="" class="mr-sm-2">Status</label>
                            <div>
                                <select class="select2 select_emails form-control" name="status" >
                                    <option value="1" {{ $task->status == 1 ? "selected" : "" }} >Open</option>
                                    <option value="2" {{$task->status == 2 ? "selected" : "" }} >Completed</option>
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

<div class="modal " id="edit_task_priority{{$task->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Priority</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div>
                                <label for="" class="mr-sm-2">Priority</label>
                                <div>
                                    <select class="select2 select_emails form-control" name="priority" >
                                        <option value="1" {{ $task->priority == 1 ? "selected" : "" }} >Normal</option>
                                        <option value="2" {{$task->priority == 2 ? "selected" : "" }} >High</option>
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

        $('.edit_task').on('click', function(){
            let data = $(this).data('task');
            let typies = {'1':'Call', '2':'Email', '3': 'Meeting', '4': "Other" };

            console.log(data);
            let task_id = $('.task_id');
            let subject_autocomplete = $('.subject_autocomplete');
            let task_assigned_to = $('.task_assigned_to');
            let task_location = $('.task_location');
            let task_company = $('.task_company');
            let task_due_date = $('.task_due_date');
            let task_create_recurring_series_of_tasks = $('#task_create_recurring_series_of_tasks');
            let task_type = $('.task_type');
            let task_description = $('.task_description');
            let task_contact =$('.task_contact');
            let task_account =$('.task_account');
            let reminder_set_task =$('#reminder_set_task');
            let created_by =$('.created_by');
            let updated_by =$('.updated_by');
            let task_priority = $('.task_priority')
            let task_status = $('.task_status')

            task_create_recurring_series_of_tasks.prop('checked', false);
            reminder_set_task.prop('checked', false);

            task_id.val('');
            subject_autocomplete.val('');
            task_location.val('');
            task_due_date.val('');
            task_description.val('');
            created_by.html('')
            updated_by.html('')

            task_assigned_to.val(1).trigger('change.select2');
            task_company.val(1).trigger('change.select2');
            task_type.val(1).trigger('change.select2');
            task_contact.val(1).trigger('change.select2');
            task_account.val(1).trigger('change.select2');
            task_priority.val(1).trigger('change.select2');
            task_status.val(1).trigger('change.select2');

            if(data.id){
                task_id.val(data.id);
            }
            if(data.subject){
                subject_autocomplete.val(data.subject);
            }

            if(data.location){
                task_location.val(data.location);
            }

            if(data.comments){
                task_description.val(data.comments);
            }

            if(data.user && data.user.first_name && data.user.last_name){
                created_by.html(data.user.last_name+' '+ data.user.first_name )
            }

            if(data.update_user && data.update_user.first_name && data.update_user.last_name){
                updated_by.html(data.update_user.last_name+' '+ data.update_user.first_name )
            }

            if(data.company_id){
                task_company.val(data.company_id).trigger('change.select2');
            }

            if(data.priority){
                task_priority.val(data.priority).trigger('change.select2');
            }

            if(data.status){
                task_status.val(data.status).trigger('change.select2');
            }

            if(data.contact_id){
                task_contact.val(data.contact_id).trigger('change.select2');
            }

            if(data.related_to){
                task_account.val(data.related_to).trigger('change.select2');
            }

            if(data.user_id){
                task_assigned_to.val(data.user_id).trigger('change.select2');
            }
         
            if(data.date){
                task_due_date.val(data.date.slice(0, 10));
            }

            if(data.create_recurring_series_of_tasks && data.create_recurring_series_of_tasks != '0'){
                task_create_recurring_series_of_tasks.prop('checked', true);
            }

            if(data.reminder_set && data.reminder_set != '0'){
                reminder_set_task.prop('checked', true);
            }
        })
    })
</script>