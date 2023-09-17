@extends('user.layout.app')
@section('title')Edit Address @endsection
@section('contents')

    <div class="container rounded bg-white">
        <div class="row rounded-top   py-3 px-3" style="background-color: #F3F3F3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Address Provider</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City </th>
                        <th>House Number</th>
                        <th>Street</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Post Code / ZIP</th>
                        @if($address->region)
                            <th>Region</th>
                        @endif
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td>{{$address->title}}</td>
                        <td>{{$address->addressProvider->title??''}}</td>
                        <td>{{$address->country->name ?? '' }}</td>
                        <td>{{$address->state->name ?? '' }}</td>
                        <td>{{$address->city ?? '' }}</td>
                        <td>{{$address->house_number}}</td>
                        <td>{{$address->street}}</td>
                        <td>{{$address->address_2}}</td>
                        <td>{{$address->address_3}}</td>
                        <td>{{$address->post_code_zip}}</td>
                        @if($address->region)
                        <td>{{$address->region}}</td>
                        @endif
                        <td>
                            <button class="btn" data-toggle="modal" data-target="#edit_address">Edit</button>
                            
                            <a class=" cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_address', [$address->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal " id="edit_address">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit address</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('update_address', [$address->id])}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$address->title}}">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address Provider</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="address_provider">
                                            @foreach($address_providers as $address_provider)
                                                <option value="{{$address_provider->id}}" {{$address->address_provider == $address_provider->id? 'selected' : ""}}>
                                                    {{$address_provider->title??""}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Country</label>
                                    <div>
                                        <select  class="select2 custom-select form-control countries" name="country_id" >
                                            @foreach($countries as $counrty)
                                                <option value="{{$counrty->id}}"  {{$address->country_id == $counrty->id? 'selected' : ""}}>{{$counrty->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              
                                <div class="col-6  state_block {{$address->state_id?"": "d-none"}}">
                                    <label class="mr-sm-2">State</label>
                                    <div class="state_block_select">
                                        <select  class="select2 custom-select form-control" name="state_id">
                                            @foreach($stateis as $sate)
                                                @if($address->country_id == $sate->country_id)
                                                    <option value="{{$sate->id}}" {{$address->state_id && $address->state_id == $sate->id ? 'selected' : ""}}>{{$sate->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">City</label>
                                    <input type="text" name="city" class="form-control  mr-sm-2" id="" value="{{$address->city}}">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Post Code / ZIP</label>
                                    <input type="text" name="post_code_zip" class="form-control  mr-sm-2" id="" value="{{$address->post_code_zip}}">
                                </div>
                            </div>    
                            <div class="row ">
                                <div class="col-6">
                                    <label class="mr-sm-2" >House Number</label>
                                    <input type="text" name="house_number" class="form-control" value="{{$address->house_number}}">
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2" >Street</label>
                                    <input type="text" name="street" class="form-control" value="{{$address->street}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 2</label>
                                    <input class="form-control" id="" rows="3" name="address_2" value="{{$address->address_2}}">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Address 3</label>
                                    <input class="form-control" id="" rows="3" name="address_3" value="{{$address->address_3}}">
                                </div>
                                @if($address->region)
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Region</label>
                                        <input class="form-control" id="" rows="3" name="region" value="{{$address->region}}">
                                    </div>
                                @endif
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

            $(".countries").on("change", function (e) {
                
                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                let state_items = $('.state_items');
                let state_block_select = $('.state_block_select');
                let state_block = $('.state_block');

                if(!state_block.hasClass('d-none')){
                    state_block.addClass('d-none');
                }
                state_block_select.empty();
                $.ajax({
                        url:'/get_states',
                        type:"post",
                        datatType : 'json',
                        data: {'id':select_val,  "_token": "{{ csrf_token() }}"}, 
                        datatType : 'json',
                        success: (response) => {
                            if (response.code == 400) {
                                
                            }else if(response.code == 200){
                                let states = response.msg;
                                let select = '<select  class="select2 custom-select form-control edit_address_state" name="state_id">';
                                states.map((v,i)=>{
                                    select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                                })
                                select += '</select>'
                                state_block_select.append(select);
                                state_block.removeClass('d-none');
                            }
                        }
                    })
            });
            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })
        })
    </script>

@endsection