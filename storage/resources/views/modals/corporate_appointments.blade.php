<div class="modal " id="create_corporate_appointments">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Corporate Appointments</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_corporate_appointments')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Corporate Title</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Corporate Title (CEO, COO, CTO etc)</label>
                                <input type="text" name="title" class="form-control  mr-sm-2" id="">
                            </div>
                          
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Appointee</div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-6">
                                <label  class="mr-sm-2">Account</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="account_id">
                                      <option value=""></option>
                                          @foreach($accounts as $account)
                                            <option value="{{$account->id}}" {{isset($company->account_id) && $company->account_id == $account->id ? "selected" : ""}}>{{$account->name}}</option>
                                          @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-6">
                                <label  class="mr-sm-2">Contact</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="contact_id">
                                      <option value=""></option>
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}">{{$contact->last_name .' '. $contact->first_name}}</option>
                                            @endforeach
                                            @foreach($individual_accounts as $individual_account)
                                                <option value="account {{$individual_account->id}}">{{$individual_account->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="company_id" value="{{$id}}">

                        {{-- <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Company</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="company_id">
                                      <option value=""></option>
                                          @foreach($companies as $comp)
                                            <option value="{{$comp->id}}" {{$url.'_id' == 'company_id' && $id == $comp->id ? "selected" : ""}}>{{$comp->name}}</option>
                                          @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Directorship</div>
                            </div>
                        </div>
                        <div class="d-flex gap-20 mt-3">
                            <div>
                                <input type="checkbox" name="position_1" class="" id="position_1" value="1">
                                <label for="position_1" class="mr-sm-2">Is Director</label>
                            </div>
                            <div>
                                <input type="checkbox" name="position_2" class="" id="position_2" value="1">
                                <label for="position_2" class="mr-sm-2">Is Manager</label>
                            </div>
                        </div>
                        {{-- <div class="col-12 mt-3">
                            <h5 class="mr-sm-2">Roles</h5>
                        </div> --}}
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Roles</div>
                            </div>
                        </div>
                        <div class="d-flex gap-20 mt-3 mb-3">
                            @foreach($appointments_roles as $appointments_role)
                                <div>
                                    <input type="checkbox" name="role_id[]" value="{{$appointments_role->id}}" id="appointments_role_{{$appointments_role->id}}">
                                    <label for="appointments_role_{{$appointments_role->id}}" class="mr-sm-2">{{$appointments_role->title}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Appointment Dates</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Appointed</label>
                                <input type="date" name="appointed_date" class="form-control  mr-sm-2" id="" max="{{date("Y-m-d")}}" value="{{substr($company->created_at,0,10)}}">
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Appointment Terminated</label>
                                <input type="date" name="appointment_terminated_date" class="form-control  mr-sm-2" id="" value="" max="{{date("Y-m-d")}}">
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

<div class="modal " id="edit_corporate_appointments" style="">
        <div class="modal-dialog mt-5 modal-lg">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit Corporate Appointments</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('update_corporate_appointments')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="corporate_appointment_id" value="">
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Corporate Title</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Corporate Title (CEO, COO, CTO etc)</label>
                                    <input type="text" name="title" class="form-control  mr-sm-2" id='corporate_appointment_title'>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Appointee</div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-6">
                                    <label  class="mr-sm-2">Account</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="account_id" id='corporate_appointment_account_id'>
                                          <option value=""></option>
                                          @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <label  class="mr-sm-2">Contact</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="contact_id" id='corporate_appointment_contact_id'>
                                            <option value=""></option>
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}">{{$contact->last_name.', '.$contact->first_name}}</option>
                                            @endforeach
                                            @foreach($individual_accounts as $individual_account)
                                                <option value="account {{$individual_account->id}}">{{$individual_account->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="company_id" value="{{$id}}">
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Directorship</div>
                                </div>
                            </div>
                            <div class="d-flex gap-20 mt-3">
                                <div>
                                    <input type="checkbox" name="position_1" class=""  value="1" id='corporate_appointment_position_1'>
                                    <label for="corporate_appointment_position_1" class="mr-sm-2">Is Director</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="position_2" class=""  value="1" id='corporate_appointment_position_2'>
                                    <label for="corporate_appointment_position_2" class="mr-sm-2">Is Manager</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Roles</div>
                                </div>
                            </div>
                            <div class="d-flex gap-20 mt-3 mb-3">
                                @foreach($appointments_roles as $appointments_role)
                                    <div>
                                        <input type="checkbox" name="role_id[]" class="appointments_role"  value="{{$appointments_role->id}}" id="cor_appointments_role_{{$appointments_role->id}}">
                                        <label for="cor_appointments_role_{{$appointments_role->id}}" class="mr-sm-2">{{$appointments_role->title}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Appointment Dates</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Appointed</label>
                                    <input type="date" name="appointed_date" class="form-control  mr-sm-2 appointed_date" id="" max="{{date("Y-m-d")}}"
                                           {{--value="{{substr($appointments_role->appointed_date,0,10)}}"--}}
                                    >
                                </div>
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Appointment Terminated</label>
                                    <input type="date" name="appointment_terminated_date" class="form-control  mr-sm-2 appointment_terminated_date" id=""
                                           {{--value="{{substr($appointments_role->appointment_terminated_date,0,10)}}" max="{{date("Y-m-d")}}"--}}
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Relates to</label>
                                    <p id="appointments_company_name"></p>
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

        $(".edit_corporate_appointments").on("click", function (e) {

            $('.appointed_date').val('');
            $('#corporate_appointment_title').val('');
            $('#corporate_appointment_id').val('');
            $('.appointment_terminated_date').val('');
            $('#corporate_appointment_position_1').removeAttr('checked')
            $('#corporate_appointment_position_2').removeAttr('checked')

            let $account =  $('#corporate_appointment_account_id');
            let $contact =  $('#corporate_appointment_contact_id');
            // let $company =  $('#corporate_appointment_company_id');

            // $account.val(1).trigger('change.select2');
            $contact.val(1).trigger('change.select2');
            // $company.val(1).trigger('change.select2');


            let data = $(this).data('corporate_appointments'); 
            console.log(data);
            let appointments_roles = $('.appointments_role');
            let corporate_appointment_title = $('#corporate_appointment_title').val(data.title); 
            let corporate_appointment_id = $('#corporate_appointment_id').val(data.id);

            for( let id in data.roles){
                $('#cor_appointments_role_'+ data.roles[id].id).attr('checked', 'checked');
            }

            if(data.appointed_date){
                $('.appointed_date').val(data.appointed_date.slice(0, 10));
            }

            if(data.appointment_terminated_date){
                $('.appointment_terminated_date').val(data.appointment_terminated_date.slice(0, 10));
            }

            if(data.position_1 == 1){
                $('#corporate_appointment_position_1').attr('checked', 'checked')
            }
            if(data.position_2 == 1){
                $('#corporate_appointment_position_2').attr('checked', 'checked')
            }

            if(data.account_id){
               $contact.val('account'+' '+data.account_id).trigger('change.select2');
            }

            if(data.contact_id){
                $contact.val(data.contact_id).trigger('change.select2');
            }

            if(data.company_id && data.company){
                $('#appointments_company_name').html(data.company.name)
                // $company.val(data.company_id).trigger('change.select2');
            }







            
        });
    })
</script>