@extends('user.layout.app')
@section('title')Edit Company @endsection
@section('contents')

    <style>
        .sales_blocks {
            display: flex;
            justify-content: space-between;
            background-color: #F3F3F3;
            border:1px solid grey;
            align-items: center;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .sales_blocks button {
            background-color: white;
        }

        .sales_blocks span {
            font-weight: 700;
        }

    </style>
    <div class="container-fluid mt-5">
        <div class="row">

            <div class="col-3">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div style="border-bottom: 1px solid lightgrey" class="pb-2">
                        <h4>{{$company_organization->name}}</h4>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                        <a class="btn btn-outline-danger" href="{{ route('delete_company', [$company_organization->id]) }}">Delete</a>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class=" company_info_btn" data-toggle="collapse" data-target="#company_info_btn">Company Information</div>
                    <div id="company_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Company name:</label>
                            <div>{{$company_organization->name}}</div>
                        </div>

                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Company owner:</label>
                            <div>{{$company_organization->ownerUser->name}}</div>
                        </div>

                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Phone:</label>
                            <div>{{$company_organization->company_phone}}</div>
                        </div>

                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="parent_account" class="mr-sm-2">Parent account:</label>
                            <div>{{$company_organization->companyTypes->name}}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Industry:</label>
                            <div>{{$company_organization->industriesTypes->name}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6  ">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <ul class="nav nav-tabs  center_nav_active_style">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#menu1">Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">Marketing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">Service</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane container active" id="menu1">
                            <div class="col-12 mt-3 px-3">
                                <ul class="nav nav-tabs ">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#menu1_1">Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu2_1">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu3_1">Sales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu4_1">Marketing</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane container active" id="menu1_1">
                                        <form action="">
                                            <div class="row mt-3">
                                                <div class="col-9">
                                                    <input required type="email" class="form-control mb-2 mr-sm-2" placeholder="Write an email..." name="email" value="" id="">
                                                </div>
                                                <div class="col-3">
                                                    <input type="submit" class="form-control mb-2 mr-sm-2 btn btn-primary"  name="submit" value="Compose" >
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-12 mt-3 px-3">
                                            <div class=" company_info_btn" data-toggle="collapse" data-target="#upcoming"> Upcoming & Overdue</div>
                                            <div id="upcoming" class="collapse">
                                                <div class="border-bottom mt-2 pt-1 px-2 pb-3">
                                                    <div class="text-center">No activities to show</div>
                                                    <div class="text-center">Get started by sending an email, scheduling a task, and more</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 px-3">
                                            <div class="text-center">No past activity. Past meetings and tasks marked as done show up here</div>
                                        </div>
                                    </div>

                                    <div class="tab-pane container fade" id="menu2_1">...</div>
                                    <div class="tab-pane container fade" id="menu3_1">...</div>
                                    <div class="tab-pane container fade" id="menu4_1">...</div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu2">
                            <div class="col-12 mt-3 px-3">
                                <div class=" company_info_btn" data-toggle="collapse" data-target="#additional_info">Additional Information</div>
                                <div id="additional_info" class="collapse show">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Website:</label>
                                                    <div>{{$company_organization->website}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Description:</label>
                                                    <div>{{$company_organization->description}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Phone</label>
                                                    <div>{{$company_organization->additional_phone}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Employees:</label>
                                                    <div>{{$company_organization->employees}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" company_info_btn mt-3" data-toggle="collapse" data-target="#address_info">Address Information</div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Address 1:</label>
                                                    <div>{{$company_organization->address_1_country}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Address 2</label>
                                                    <div>{{$company_organization->address_2_country}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" company_info_btn mt-3" data-toggle="collapse" data-target="#system_info">System Information</div>
                                <div id="system_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">

                                                    <div> Created By: {{ Auth::user()->name }}. {{$company_organization->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->name }}. {{$company_organization->updated_at}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu3">

                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Contacts ({{ $company_organization->contacts_count }})</span>
                                    <div>
                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create-contact">New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu4">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Campaigns (0)</span>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Campaign influence</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu5">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Cases (0)</span>
                                    <div>
                                        <button  class="btn btn-outline-primary" >Change Owner</button>
                                        <button class="btn btn-outline-primary" >New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 ">
                <div class="col-12 rounded bg-white py-3 px-3">

                </div>
            </div>
        </div>
    </div>

    <div class="modal edit_account" id="edit_account">
        <div class="modal-dialog  mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3" >
                        <button type="button" class="btn-close text-white close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Edit Companies & Organisation</h4>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="row">
                    </div>
                    <form class="" action="{{route('edit_company_organization',[$company_organization->id])}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Company name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Company name" name="name" value="{{$company_organization->name}}" id="" required>
                                </div>
                                <div class="col-6" id="parent_id_select_2">
                                    <label for="parent_account" class="mr-sm-2">Parent account:</label>
                                    <div>
                                        <select class="select2 form-control select2_styles" name="parent_id" >
                                            <option selected>Select Parent Company</option>
                                            @foreach($all_company_organizations as $comp)
                                                @if($comp->id === $company_organization->id)
                                                    @continue
                                                @endif
                                                <option value="{{$comp->id}}"
                                                @if(!empty($company_organization->parentCompany->id) && $comp->id == $company_organization->parentCompany->id) {{'selected'}} @else {{""}} @endif >{{$comp->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Company owner:</label>
                                    <select required class="select2 custom-select form-control" required name="owner_id">
                                        @if($users)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($user->id == $company_organization->ownerUser->id) {{'selected'}} @else {{""}} @endif>{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Type:</label>
                                    <select  class="select2 custom-select form-control" name="company_id" required>
                                        @foreach($company_types as  $company_type)
                                            <option value="{{$company_type->id}}" @if($company_type->id == $company_organization->companyTypes->id) {{'selected'}} @else {{""}} @endif>{{$company_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="{{$company_organization->company_phone}}" name="company_phone" required>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Industry:</label>
                                    <select  class="select2 custom-select form-control" name="industry_id" required>
                                        @foreach($industries_types as  $industries_type)
                                            <option value="{{$industries_type->id}}" @if($industries_type->id == $company_organization->industriesTypes->id) {{'selected'}} @else {{""}} @endif>{{$industries_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Website:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Website" value="{{$company_organization->website}}" name="website" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" required placeholder="Phone" value="{{$company_organization->additional_phone}}" name="additional_phone" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Description:</label>
                                    <textarea class="form-control" id="" rows="3"  name="description">{{$company_organization->description}}</textarea>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Employees:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" required value="{{$company_organization->employees}}" name="employees" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 Street:</label>
                                    <textarea class="form-control" id="" rows="3" name="address_1_street" >{{$company_organization->address_1_street}}</textarea>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 Street:</label>
                                    <textarea class="form-control" id="" rows="3" name="address_2_street" >{{$company_organization->address_2_street}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 Country:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_1_country}}" name="address_1_country" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 Country:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_2_country}}" name="address_2_country" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 City:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_1_city}}" name="address_1_city" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 City:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_2_city}}" name="address_2_city" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 State:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_1_state}}" name="address_1_state" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 State:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_2_state}}" name="address_2_state" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 zip code:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_1_zip_code}}" name="address_1_zip_code"  >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 zip code:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$company_organization->address_2_zip_code}}" name="address_2_zip_code" >
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

    <div class="modal " id="create-contact">

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
                                    <div>
                                        <label for="" class="mr-sm-2">Company Name:</label>
                                        <div>
                                            <select class="select2 select_company form-control" name="company_id">
                                                <option selected value="">Select Company</option>
                                                @foreach($all_company_organizations as $comp)
                                                    <option value="{{$comp->id}}" {{ $comp->id == $company_organization->id ? 'selected="selected"' : '' }}>{{$comp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Contact Owner:</label>
                                        <div>
                                            <select class="select2 select_owner form-control" name="owner_id">
                                                <option selected value="">Select Contact Owner</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"  >{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <label for="" class="mr-sm-2">Solution:</label>
                                    <select class=" form-control" name="solution">
                                        <option selected value="">Select Solution</option>
                                        <option  value="Mr">Mr.</option>
                                        <option  value="Ms">Ms.</option>
                                        <option  value="Mrs">Mrs.</option>
                                        <option  value="Dr">Dr.</option>
                                        <option  value="Prof">Prof.</option>
                                    </select>

                                    <label for="personal_name" class="mr-sm-2">First Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="first_name" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Middle Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="middle_name" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Last Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="last_name" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Suffix:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="suffix" value="" id="" required>


                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Title:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="title" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Email:</label>
                                    <input type="email" class="form-control mb-2 mr-sm-2" placeholder="" name="email" value="{{ Auth::user()->email }}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="phone" value="" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Additional Information</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Mobile:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mobile" value="" id="" >
                                    <label for="personal_name" class="mr-sm-2">Fax:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="fax" value="" id="" >
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Reports To:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control" required name="reports">
                                            <option selected value="">Select Reports address</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}"  >{{$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="personal_name" class="mr-sm-2">Department:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="department" value="" id="" >
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
                                        <label for="" class="mr-sm-2">Mailing address:</label>
                                        <div>
                                            <select class="select2 select_emails form-control" name="mailing_address">
                                                <option selected value="">Select Mailing address</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"  >{{$user->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label  class="mr-sm-2">Mailing Street:</label>
                                    <textarea  class="form-control" id="" rows="3" name="mailing_street"></textarea>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Mailing City:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_city" value="" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Mailing State:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_state" value="" id="" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Mailing Country:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_country" value="" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Mailing Zip :</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing__zip_code" value="" id="" >
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
@section('js')
    <script>

        $(document).ready(function() {
            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })
        });



    </script>
@endsection

@endsection