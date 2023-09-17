@extends('user.layout.app')
@section('title')Companies @endsection
@section('contents')

<div class="container-fluid mt-5 rounded bg-white py-3 px-3">
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2 text-end">
            <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#open_account">New</button>
        </div>
    </div>
</div>
<div class="container-fluid mt-5 rounded bg-white py-3 px-3">

    {{--<a href="#page_items" class="btn btn-primary" data-toggle="collapse">Companies</a>--}}


    {{--<div id="page_items" class="collapse py-3" style="padding:30px;">--}}
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Company name</th>
                <th>Parent Company</th>
                <th>Type</th>
                <th>Industry</th>
                <th>Company phone</th>
                <th>Company owner</th>
                  <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($company_organizations as  $value)
                <tr{{--id="" data-toggle="modal" data-target="#edit_account_{{$value->id}}"--}} >
                    <td><a href="{{ route('edit_company_organization', [$value->id]) }}">{{$value->name}}</a></td>
                    <td>{{ $value->parentCompany->name ?? '' }}</td>
                    <td>{{$value->companyTypes->name ?? '' }}</td>
                    <td>{{$value->industriesTypes->name ?? '' }}</td>
                    <td>{{$value->company_phone}}</td>
                    <td>{{$value->ownerUser->name}}</td>
                    <td>
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Edit</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-primary" href="{{ route('edit_company_organization', [$value->id]) }}">Edit</a>
                            <a class="dropdown-item text-danger" href="{{ route('delete_company', [$value->id]) }}">Delete</a>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>

    {{--</div>--}}
</div>


<div class="modal " id="open_account">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Companies & Organisation</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_account')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Company Information</div>
                            </div>
                            <div class="col-6 ">
                                <label for="personal_name" class="mr-sm-2">Company name:</label>
                                <input required type="text" class="form-control mb-2 mr-sm-2" placeholder="Company name" name="name" value="" id="">
                                {{--<input type="hidden" value="{{ Auth::user()->name }}" id=""  class="">--}}

                            </div>
                            <div class="col-6 d-flex flex-column">
                                <label for="parent_account w-100" class="mr-sm-2">Parent account:</label>
                                <select class="select2 form-control" name="parent_id">
                                    <option selected value="">Select Parent Company</option>
                                    @foreach($all_company_organizations as $comp)
                                        <option value="{{$comp->id}}"  >{{$comp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Company owner:</label>
                                <select required class="select2 custom-select form-control" name="owner_id">
                                    @if($users)
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Type:</label>
                                <select required class="select2 custom-select form-control" name="company_id">
                                    @foreach($company_types as  $company_type)
                                        <option value="{{$company_type->id}}" >{{$company_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Additional Information</div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Phone:</label>
                                <input required type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="" name="company_phone" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Industry:</label>
                                <select required class="select2 custom-select form-control" name="industry_id">
                                    @foreach($industries_types as  $industries_type)
                                        <option value="{{$industries_type->id}}">{{$industries_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Website:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Website" value="" name="website" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Phone:</label>
                                <input required type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="additional_phone" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Description:</label>
                                <textarea  class="form-control" id="" rows="3" name="description"></textarea>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Employees:</label>
                                <input required type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" value="" name="employees" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Address Information</div>
                            </div>
                            <div class="col-6">
                                <div class="w-100 fw-bold mb-2">Address</div>
                                <label  class="mr-sm-2">Address Street:</label>
                                <textarea  class="form-control" id="" rows="3" name="address_1_street"></textarea>
                            </div>
                            <div class="col-6">
                                <div class="w-100 fw-bold mb-2">Additional Address</div>
                                <label  class="mr-sm-2">Additional Address Street:</label>
                                <textarea  class="form-control" id="" rows="3" name="address_2_street"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Address Country:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_country" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Additional Address Country:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_country" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Address City:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_city" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Additional Address City:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_city" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Address State:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_state" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Additional Address State:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_state" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Address zip code:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_zip_code" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Additional Address zip code:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_zip_code" >
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

@foreach($company_organizations as  $value)
    <div class="modal edit_account" id="edit_account_{{$value->id}}">
        <div class="modal-dialog  mt-5 modal-lg">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3" >
                        <button type="button" class="btn-close text-white close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Edit Companies & Organisation</h4>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="row">

                        {{--<button class="btn btn-light mb-2" id="">Personal</button>--}}
                        {{--<button  class="btn btn-light mb-2" id="">Bissnes</button>--}}
                    </div>
                    <form class="" action="" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Company name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Company name" name="name" value="{{$value->name}}" id="" required>
                                </div>
                                <div class="col-6" id="parent_id_select_2">
                                    <label for="parent_account" class="mr-sm-2">Parent account:</label>
                                    <select class="select2_2" name="parent_id" >
                                        <option selected>Select Parent Company</option>
                                        @foreach($all_company_organizations as $comp)
                                            <option value="{{$comp->id}}"
                                            @if(!empty($value->parentCompany->id) && $comp->id == $value->parentCompany->id) {{'selected'}} @else {{""}} @endif >{{$comp->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Account owner:</label>
                                    <div> {{ Auth::user()->name }}</div>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Type:</label>
                                    <select  class="custom-select" name="company_id" required>
                                        @foreach($company_types as  $company_type)
                                            <option value="{{$company_type->id}}" @if($company_type->id == $value->companyTypes->id) {{'selected'}} @else {{""}} @endif>{{$company_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="{{$value->company_phone}}" name="company_phone" required>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Industry:</label>
                                    <select  class="custom-select" name="industry_id" required>
                                        @foreach($industries_types as  $industries_type)
                                            <option value="{{$industries_type->id}}" @if($industries_type->id == $value->industriesTypes->id) {{'selected'}} @else {{""}} @endif>{{$industries_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Website:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Website" value="{{$value->website}}" name="website" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" required placeholder="Phone" value="{{$value->additional_phone}}" name="additional_phone" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Description:</label>
                                    <textarea class="form-control" id="" rows="3"  name="description">{{$value->description}}</textarea>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Employees:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" required value="{{$value->employees}}" name="employees" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 Street:</label>
                                    <textarea class="form-control" id="" rows="3" name="address_1_street" >{{$value->address_1_street}}</textarea>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 Street:</label>
                                    <textarea class="form-control" id="" rows="3" name="address_2_street" >{{$value->address_2_street}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 Country:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_country}}" name="address_1_country" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 Country:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_country}}" name="address_2_country" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 City:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_city}}" name="address_1_city" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 City:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_city}}" name="address_2_city" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 State:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_state}}" name="address_1_state" >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 State:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_state}}" name="address_2_state" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 1 zip code:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_zip_code}}" name="address_1_zip_code"  >
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2 zip code:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_zip_code}}" name="address_2_zip_code" >
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
@endforeach


@section('js')
<script>
    $(document).ready(function(){
        $('#bissnes').click(function(){
            $('#personal_name').removeAttr('name');
            $('#personal_name').hide();
            $('#bissnes_name').attr('name', 'name');
        })

        $('#personal').click(function(){
            $('#personal_name').show();
            $('#personal_name').attr('name', 'name');
            $('#bissnes_name').removeAttr('name');
        })

    })
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