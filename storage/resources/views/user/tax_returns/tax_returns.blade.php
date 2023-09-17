@extends('user.layout.app')
@section('title')Tax Returns @endsection
@section('contents')

    <div class="container-fluid  rounded   px-3">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#tax_returns_modal">New</button>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt-5 rounded bg-white py-3 px-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Tax Year Start Date</th>
                    <th>Tax Year End Date</th>
                    <th>Tax Return Due Date</th>
                    <th>Tax Return Type</th>
                    <th>Tax Return Status</th>
                    <th>Company Status for this Tax Year</th>
                    <th>Tax Return Link</th>
                    <th>Filing Extension 7004</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tax_returns as $tax_return)
                    <tr>
                        <td>
                            @if($tax_return->company)
                                <a href="/company/{{$tax_return->company->id}}">{{$tax_return->company->name??""}}</a>
                            @endif
                        </td>
                        <td>{{$tax_return->tax_start??""}}</td>
                        <td>{{$tax_return->tax_end?? '' }}</td>
                        <td>{{$tax_return->due_date?? '' }}</td>
                        <td>{{$tax_return->tax_return_type? $tax_return_type[$tax_return->tax_return_type] : ""}}</td>
                        <td>{{$tax_return->status? $tax_status[$tax_return->status] : ""}}</td>
                        <td>{{$tax_return->company_status ? $tax_company_status[$tax_return->company_status] : ""}}</td>
                        <td>
                            @if($tax_return->file_path)
                                <a href=" {{$tax_return->file_path}}">open</a>
                            @endif
                            
                            {{-- <div style="max-width: 200px; overflow-x: auto;">
                                {{$tax_return->file_path}}
                            </div> --}}
                        </td>
                        <td>
                            @if($tax_return->pdfFile && $tax_return->pdfFile->path )
                                <a href=" {{$tax_return->pdfFile->path}}">open</a>
                            @endif
                            {{-- <div style="max-width: 200px; overflow-x: auto;">
                                {{$tax_return->pdfFile && $tax_return->pdfFile->path?$tax_return->pdfFile->path: ""}}
                            </div> --}}
                        </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <a  class="col-10 show_tax_returns cursor-pointer text-primary" data-toggle="modal" data-target="#show_tax_returns"  data-tax_returns="{{ $tax_return}}">
                                    <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                </a>
                                <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_tax_returns', [$tax_return->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('modals.tax_returns')
    @include('modals.delete_modal')


@endsection