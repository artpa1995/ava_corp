@extends('user.layout.app')
@section('title')Task Template @endsection
@section('contents')

    <div class="container-fluid  rounded   px-3">
        <div class="row">
            <div class="col-10">
            </div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="" data-toggle="modal" data-target="#creat_new_task_template">New</button>
            </div>
        </div>
    </div>

   
    {{-- <div class="container-fluid mt-5 rounded bg-white py-3 px-3 DT_container"> --}}
    <div class="container-fluid mt-5  DT_container">
        {{-- <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Task Duration</th>
                    <th></th>
                    <th>Assigned to</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               @foreach($task_templates as $task_template)
                <tr>
                    <td>{{$task_template['name']??''}}</td>
                    <td>{{$task_template['count']??''}}</td>
                    <td>{{$task_template['period']??''}}</td>
                    <td>{{$task_template['user']?$task_template['user']['last_name'].' '.$task_template['user']['first_name'] :''}}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a class="edit_task_template cursor-pointer" data-all="{{ json_encode($task_template) }}" data-toggle="modal" data-target="#edit_task_template" >
                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                            </a>
                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_task_template', [$task_template['id']]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                        </div>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table> --}}

        <table class="table table-hover template_table mt-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Task Duration</th>
                    <th></th>
                    <th>Assigned to</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- Modal -->
    @include('modals.task_template')
    @include('modals.delete_modal')

    <script>
        $(function () {
            var table = $('.template_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'type': 'GET',
                    'url': "{{ route('Dtask_template') }}",
                },

                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'count', name: 'count'},
                    {data: 'period', name: 'period'},                
                    {data: 'Assigned_to', name: 'Assigned_to', render:(data, i, row)=>{
                        if(row.user){
                            let ln = row.user.last_name??'';
                            let fn = row.user.first_name??'';
                            return ln + " " + fn
                        }
                        return '';
                    }},                     
                    {data: 'action', name: 'action', orderable: false, searchable: false,render:(data, i, row)=>{
                        let name = `<div class="d-flex justify-content-end">
                                        <a class="edit_task_template cursor-pointer" data-all='${JSON.stringify(row)}' data-toggle="modal" data-target="#edit_task_template" >
                                            <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                        </a>
                                        <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="/delete_task_template/${row.id}">
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