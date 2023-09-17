@extends('user.layout.app')
@section('title')Service Configuration @endsection
@section('contents')
@php
$periods = [
    'one_off' => 'One-Off',
    'hour' => 'per Hour',
    'day' => 'per Day', 
    'week' => 'per Week', 
    'month' => 'per Month', 
    'quarter' => 'per Quarter', 
    'half_year' => 'per Half-Year',
    'year' => 'per Year'
];
$currencies = [
    'usd' => 'USD',
    'eur' => 'EUR',
    'gbp' => 'GBP'
];

@endphp
    <div class="container-fluid  rounded   px-3">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_service_button" data-toggle="modal" data-target="#add_new_service">New</button>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid mt-5 rounded bg-white py-3 px-3 DT_container"> --}}
        <div class="container-fluid mt-5  DT_container">
        @if(1>4)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Currency</th>
                    <th>Price</th>
                    <th>Period</th>
                    <th>Invoice Description</th>
                    <th>Comment</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sevices as  $value)
                <tr >
                    <td><a >{{$value->title}}</a></td>
                    <td>{{ $value->status ?"Active" : 'Inactive' }}</td>
                    <td>{{$value->currency ? $currencies[$value->currency]: '' }}</td>
                    <td>{{$value->price ?? '' }}</td>
                    <td>{{$value->period ? $periods[$value->period] : ''}}</td>
                    <td>{{$value->invoice_description?? ''}}</td>
                    <td>{{$value->comments?? ''}}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a class="edit_servise_button cursor-pointer " data-toggle="modal" data-target="#edit_service" data-val="{{$value}}">
                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                            </a>
                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_service', [$value->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                         </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <table class="table table-hover service_table mt-5">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Currency</th>
                    <th>Price</th>
                    <th>Period</th>
                    <th>Invoice Description</th>
                    <th>Comment</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
  
    <!-- Modal -->
    @include('modals.delete_modal')
    @include('modals.service')
    @section('js')
        <script>
              $(function () {
                var table = $('.service_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'type': 'GET',
                        'url': "{{ route('Dtservice') }}",
                    },

                    columns: [
                        {data: 'title', name: 'title'},
                    
                        {data: 'status', name: 'status', render:(data, i, row)=>{
                           console.log(row);
                            return row.status != 0?"Active" : 'Inactive';
                        }},

                        {data: 'currency', name: 'currency', render:(data, i, row)=>{
                            return row.currency.toUpperCase();
                        }},
                        {data: 'price', name: 'price'},
                        {data: 'period', name: 'period'},
                        {data: 'invoice_description', name: 'invoice_description'},
                        {data: 'comments', name: 'comments'},                       
                        {data: 'action', name: 'action', orderable: false, searchable: false,render:(data, i, row)=>{
                            let name = `<div class="d-flex justify-content-end">
                                            <a class="edit_servise_button cursor-pointer " data-toggle="modal" data-target="#edit_service" data-val='${JSON.stringify(row)}'>
                                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                            </a>
                                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="/delete_service/${row.id}">
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