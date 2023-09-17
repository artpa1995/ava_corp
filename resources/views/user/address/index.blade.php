@extends('user.layout.app')
@section('title')Addresses @endsection
@section('contents')

    <div class="container-fluid  rounded   px-3">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#create_address">New</button>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid mt-5 rounded bg-white py-3 px-3"> --}}
        <div class="container-fluid mt-5  DT_container">
        @if(1>4)
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $value)
                
                    <tr >
                        <td>
                            <a class="edit_address_once cursor-pointer" data-target="#edit_address" data-toggle="modal"  data-address_once="{{$value}}">
                                {{$value->title}}
                            </a>
                        </td>
                        <td>{{$value->addressProvider->title??""}}</td>
                        <td>{{ $value->country->name ?? '' }}</td>
                        <td>
                            @if(!empty($value->county))
                                {{$value->county->name ?? '' }}
                            @else
                                {{$value->state->name ?? '' }}
                            @endif
                        </td>
                        <td>{{$value->city ?? '' }}</td>
                        <td>{{$value->house_number}}</td>
                        <td>{{$value->street}}</td>
                        <td>{{$value->address_2}}</td>
                        <td>{{$value->address_3}}</td>
                        <td>{{$value->post_code_zip}}</td>
                        <td>
                            <div class="d-flex justify-content-end">
                                {{-- class=" " style="" href="{{ route('edit_address', [$value->id]) }}" --}}
                                <a class="edit_address_once cursor-pointer" data-target="#edit_address" data-toggle="modal"  data-address_once="{{$value}}">
                                    <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                </a>
                                <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_address', [$value->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <table class="table table-hover address_table mt-5">
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
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    @include('modals.address')
    <!-- Modal -->
    @include('modals.delete_modal')

    @section('js')
        <script>
             $(function () {
                var table = $('.address_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'type': 'GET',
                        'url': "{{ route('Dtall_addresses') }}",
                    },

                    columns: [
                        {data: 'title', name: 'title', render:(data, i, row)=>{
                           let name = `<a class="edit_address_once cursor-pointer" data-target="#edit_address" data-toggle="modal"  data-address_once='${JSON.stringify(row)}'>
                               ${row.title}
                            </a>`;
                            return name;
                        }},
                        {data: 'addressProvider_sort', name: 'addressProvider_sort', render:(data, i, row)=>{
                            console.log(row);
                           let name = ``;
                           if(row.address_provider){
                                name = row.address_provider.title;
                           }
                            return name;
                        }},
                        {data: 'country', name: 'country', render:(data, i, row)=>{
                            let name = '';
                            if(row.country){
                                name = row.country.name;
                            }
                            return name;
                        }},

                        {data: 'state_county', name: 'state_county', render:(data, i, row)=>{
                            let name = '';

                            if(row.county){
                                name = row.county.name;
                            }else if(row.state){
                                name = row.state.name;
                            }
                            return name;
                        }},
                        {data: 'city', name: 'city'},
                        {data: 'house_number', name: 'house_number'},
                        {data: 'street', name: 'street'},
                        {data: 'address_2', name: 'address_2'},
                        {data: 'address_3', name: 'address_3'},
                        {data: 'post_code_zip', name: 'post_code_zip'},
                        {data: 'action', name: 'action', orderable: false, searchable: false,render:(data, i, row)=>{
                            let name = `<div class="d-flex justify-content-end">
                                            <a class="edit_address_once cursor-pointer" data-target="#edit_address" data-toggle="modal"  data-address_once='${JSON.stringify(row)}'>
                                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                            </a>
                                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="/delete_address/${row.id}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                            </a>
                                        </div>`;
                            return name;
                        }},
                    ],
                    initComplete: function () {
                        var api = this.api();
                        
                        var recordsCount = api.page.info().recordsTotal;
                        if (recordsCount < 10) {
                            $('.dataTables_length').hide();
                            $('.dataTables_paginate').hide(); // Hide the pagination element
                        } else {
                            $('.dataTables_length').show();
                            $('.dataTables_paginate').show(); // Show the pagination element
                        }
                    },
                    language: {
                            processing: `<div class="DTloading"> <img src="{{url('image/loading.gif')}}" alt=""></div> `, // Custom loading message or indicator
                        },
                });
            });

        </script>
    @endsection


@endsection