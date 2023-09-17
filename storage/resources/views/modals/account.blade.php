<div class="modal " id="open_account">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button" class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Account</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_account')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Account Information</div>
                            </div>
                            <div class="col-6">
                                <label for="personal_name" class="mr-sm-2">Category:</label>
                                <div class="col-12 d-lg-flex gap-20">
                                    <div>
                                        <input required type="radio" class="account_personality_type" name="account_personality_type" value="1" id="business_account" checked>
                                        <label for="business_account" class="mr-sm-2">Business</label>
                                    </div>
                                    <div>
                                        <input required type="radio" class="account_personality_type" name="account_personality_type" value="0" id="personal_account">
                                        <label for="personal_account" class="mr-sm-2">Individual</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-6 d-flex flex-column account_classification_bisnes">
                                <label for="parent_account w-100" class="mr-sm-2">Parent account:</label>
                                <select class="select2 form-control" name="parent_id">
                                    <option selected value="">Select Parent Account</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="col-6">
                                <label class="mr-sm-2">Type:</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="account_type_id">
                                        @foreach($account_types as  $account_type)
                                            <option value="{{$account_type->id}}" {{$account_type->name == 'Client' ? "selected" : ""}}>{{$account_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 " id="business_account_name">
                                <label for="personal_name" class="mr-sm-2">Account name:</label>
                                <input required type="text" class="form-control mb-2 mr-sm-2" placeholder="Account name" name="name" value="" id="account_name">
                            </div>
                            
                            <div class="col-6 d-none " id="personal_account_name">
                                <label for="personal_name" class="mr-sm-2">First name:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2 personal_account_name" placeholder="First name"  value="" id="first_name">
                                <label for="personal_name" class="mr-sm-2">Last name:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2 personal_account_name" placeholder="Last name"  value="" id="last_name">
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Account owner:</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="owner_id">
                                        @if($users)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{ Auth::user()->id == $user->id? 'selected': '' }} >{{$user->first_name. ' ' . $user->last_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row mb-2">
                            <div class="bg-light p-3 h6">Communication Details</div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex flex-column account_classification_indevidual ">
                                <label for="parent_account w-100" class="mr-sm-2">Email 1</label>
                                <input type="email" name="email" id="" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Phone 1</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="" name="account_phone" >
                            </div>
                            {{-- <div class="col-6 account_classification_bisnes">
                                <label class="mr-sm-2">Industry:</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="industry_id">
                                        @foreach($industries_types as  $industries_type)
                                            <option value="{{$industries_type->id}}" {{$industries_type->name == 'Other' ? "selected" : ""}}>{{$industries_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            {{-- <div class="col-6">
                                <label class="mr-sm-2">Website:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Website" value="" name="website" >
                            </div> --}}
                            <div class="col-6 ">
                                <label class="mr-sm-2">Email 2</label>
                                <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="Email" value="" name="email_2" >
                            </div>
                            <div class="col-6 ">
                                <label class="mr-sm-2">Phone 2</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="additional_phone" >
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Description:</label>
                                <textarea class="form-control" id="" rows="3" name="description"></textarea>
                            </div>
                            <div class="col-6 account_classification_bisnes">
                                <label class="mr-sm-2">Employees:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" value="" name="employees" >
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Address Information</div>
                            </div>
                            <div class="col-6">
                                <div class="w-100 fw-bold mb-2">Address</div>
                                <label class="mr-sm-2">Address Street:</label>
                                <textarea class="form-control" id="" rows="3" name="address_1_street"></textarea>
                            </div>
                            <div class="col-6">
                                <div class="w-100 fw-bold mb-2">Additional Address</div>
                                <label class="mr-sm-2">Additional Address Street:</label>
                                <textarea class="form-control" id="" rows="3" name="address_2_street"></textarea>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address Country:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_country" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address Country:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_country" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address City:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_city" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address City:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_city" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address State:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_state" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address State:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_state" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address zip code:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_zip_code" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address zip code:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_zip_code" >
                            </div>
                        </div> --}}
                        <div class="row mb-2 mt-1">
                            <div class="col-6">
                                <label class="mr-sm-2">Email 3</label>
                                <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="email_3" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Phone 3</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="phone_3" >
                            </div>
                          
                        </div>
                        <div class="row mb-2 mt-1">
                            <div class="col-6">
                                <label class="mr-sm-2">Email 4</label>
                                <input  type="email" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="email_4" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Phone 4</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="phone_4" >
                            </div>
                            
                        </div>
                        

                        <div class="Primary_Tax_Registration_block d-none">
                            <div class="row">
                                <div class="col-12 mb-2 mt-3">
                                    <div class="bg-light p-3 h6">Personal Details</div>
                                </div>
                            </div>
                            <div class="row mb-2 mt-1">
                                <div class="col-6">
                                    <label class="mr-sm-2">Date of Birth</label>
                                    <input  type="date" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="bday" >
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Country of Citizenship</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="country_id" id=''>
                                            @foreach($countries as $coun)
                                                <option value="{{$coun->id}}">{{$coun->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <input type="checkbox" name="desabled_field" id="desabled_account_new"  value="1">
                                    <label for="desabled_account_new" class="mr-sm-2">Disabled</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2 mt-3">
                                    <div class="bg-light p-3 h6">Google Drive Company Folder</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input name="google_drive"class="form-control Google_Drive_text" >
                                    <div class="Google_Drive_img_big Google_Drive_img mt-2 d-none" >
                                        <a href="" class="Google_Drive_link" target="_blunk">
                                            <img src="{{url('image/Google_Drive.png')}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Primary Tax Registration</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="">Registration Status</label>
                                    <div>
                                        <select class="select2 form-control" name="registration_status">
                                            <option selected value="">Select Registration Status</option>
                                            <option value="1">Not Registered for Tax</option>
                                            <option value="2">Registered for Tax </option>
                                            <option value="3">Submitted. Awaiting Tax ID </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="" class="">Tax ID Type</label>
                                    <div>
                                        <select class="select2 form-control" name="tax_id_type">
                                            <option value="1">ITIN</option>
                                            <option value="2">SSN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6"> 
                                    <label for="" class="">Tax ID</label>
                                    <input  class="form-control" id="" rows="3" name="tax_id">
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="">Status Date</label>
                                    <input type="date" class="status_date form-control" name="status_date" >
                                    <button class="btn btn-primary today_button mt-2">Today</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="">Tax Filing Code</label>
                                    <input  class="form-control" id="" rows="3" name="tax_filing_code">
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-6"> 
                                    <label for="" class="">Link to Tax Registration 1</label>
                                    {{-- <input type="file" name="file_1" id="file_1" class="create_file form-control"> --}}
                                    {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                    <input name="file_path_1" class=" form-control link_file" id="" >
                                    <input type="hidden" class="file_link" value="">
                                    <label for="" class="mt-3">Doc Type</label>
                                    <div class="mt-2">
                                        <select class="select2 form-control" name="doc_type_1">
                                            <option value="1">W7 Form</option>
                                            <option value="2">EIN CP 565 A Issuance</option>
                                            <option value="3">IRS Refusal Letter</option>
                                            <option value="4">IRS Correction Request Letter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="">Link to Tax Registration 2</label>
                                    {{-- <input type="file" name="file_2" id="file_2" class="create_file form-control"> --}}
                                    {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                    <input name="file_path_2" class=" form-control link_file" id="">
                                    <input type="hidden" class="file_link" value="">
                                    <label for="" class="mt-3">Doc Type</label>
                                    <div class="mt-2">
                                        <select class="select2 form-control" name="doc_type_2">
                                            <option value="1">W7 Form</option>
                                            <option value="2">EIN CP 565 A Issuance</option>
                                            <option value="3">IRS Refusal Letter</option>
                                            <option value="4">IRS Correction Request Letter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-6"> 
                                    <label for="" class="">Link to Tax Registration 3</label>
                                    {{-- <input type="file" name="file_3" id="file_3" class="create_file form-control"> --}}
                                    {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                    <input name="file_path_3" class=" form-control link_file" id="">
                                    <input type="hidden" class="file_link" value="">
                                    <label for="" class="mt-3">Doc Type</label>
                                    <div class="mt-2">
                                        <select class="select2 form-control" name="doc_type_3">
                                            <option value="1">W7 Form</option>
                                            <option value="2">EIN CP 565 A Issuance</option>
                                            <option value="3">IRS Refusal Letter</option>
                                            <option value="4">IRS Correction Request Letter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="">Link to Tax Registration 4</label>
                                    {{-- <input type="file" name="file_4" id="file_4" class="create_file form-control"> --}}
                                    {{-- <p class=" text-primary">Upload the file or paste the link below</p> --}}
                                    <input name="file_path_4" class=" form-control link_file" id="">
                                    <input type="hidden" class="file_link" value="">
                                    <label for="" class="mt-3">Doc Type</label>
                                    <div class="mt-2">
                                        <select class="select2 form-control" name="doc_type_4">
                                            <option value="1">W7 Form</option>
                                            <option value="2">EIN CP 565 A Issuance</option>
                                            <option value="3">IRS Refusal Letter</option>
                                            <option value="4">IRS Correction Request Letter</option>
                                        </select>
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