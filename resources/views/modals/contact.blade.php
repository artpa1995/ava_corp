    <div class="modal" id="create_contact">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">New Contact</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('add_contact')}}" method="POST">
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
                                            <select class="select2  form-control" name="account_id">
                                                <option selected value="">Select Account</option>
                                                @foreach($accounts as $comp)
                                                    <option value="{{$comp->id}}"  >{{$comp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if(1>4)
                                    {{-- <div class="mt-2">
                                        <label for="" class="">Contact Owner:</label>
                                        <div>
                                            <select class="select2 select_owner form-control" name="owner_id">
                                                <option selected value="">Select Contact Owner</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"  >{{$user->first_name." ". $user->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    @endif
                                    <div class="mt-2">
                                        <label for="" class="">Salutation:</label>
                                        <select class=" form-control" name="solution">
                                            <option selected value="">Select Salutation</option>
                                            <option  value="Mr">Mr.</option>
                                            <option  value="Ms">Ms.</option>
                                            <option  value="Mrs">Mrs.</option>
                                            <option  value="Dr">Dr.</option>
                                            <option  value="Prof">Prof.</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <label for="personal_name" class="">Suffix:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="suffix" value="" id="" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-2">
                                        <label for="personal_name" class="">First Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="first_name" value="" id="" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="personal_name" class="">Middle Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="middle_name" value="" id="" >
                                    </div>
                                    <div class="mt-2">
                                        <label for="personal_name" class="">Last Name:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="last_name" value="" id="" required>
                                    </div>
                                    {{-- <div class="mt-2">
                                        <label for="personal_name" class="">Title:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="title" value="" id="" >
                                    </div> --}}
                                    {{-- <div class="mt-2">
                                        <label for="personal_name" class="">Email:</label>
                                        <input type="email" class="form-control mb-2 " placeholder="" name="email" value="" id="" >
                                    </div> --}}
                                    {{-- <div class="mt-2">
                                        <label for="personal_name" class="">Phone:</label>
                                        <input type="text" class="form-control mb-2 " placeholder="" name="phone" value="" id="" >
                                    </div> --}}
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="">Job Title:</label>
                                    <input name="job_title" class="form-control">
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
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="" name="email_1" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 1</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="phone_1" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 2</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="" name="email_2" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 2</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="phone_2" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 3</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="" name="email_3" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 3</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="phone_3" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Email 4</label>
                                    <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="" name="email_4" >
                                </div>
                                <div class="col-6 ">
                                    <label class="mr-sm-2">Phone 4</label>
                                    <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="phone_4" >
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Additional Information</div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-6">
                                    <label for="personal_name" class="">Mobile:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="mobile" value="" id="" >
                                    <label for="personal_name" class="">Fax:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="fax" value="" id="" >
                                </div> --}}
                                <div class="col-6">
                                    <label for="personal_name" class="">Reports To:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control"  name="reports">
                                            <option selected value="">Select Reports address</option>
                                            @foreach($contacts as $conta)
                                                <option value="{{$conta->id}}"  >{{$conta->last_name .' '. $conta->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="">Department:</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="department" value="" id="" >
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
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"  >{{$user->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label  class="">Mailing Street:</label>
                                    <textarea  class="form-control" id="" rows="3" name="mailing_street"></textarea>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="">Mailing City:</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing_city" value="" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="">Mailing State:</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing_state" value="" id="" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="">Mailing Country:</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing_country" value="" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="">Mailing Zip :</label>
                                            <input type="text" class="form-control mb-2 " placeholder="" name="mailing__zip_code" value="" id="" >
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