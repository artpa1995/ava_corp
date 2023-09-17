@extends('user.layout.app')
@section('title')Companies @endsection
@section('contents')
@php 

$company_type_abbreviation = [
         "1" => "C-Corp",
         "2" => "LBG",
         "3" => "LLC",
         "4" => "LP",
         "5" => "LTD",
         "6" => "PLC",
];

$tax_column = 'Tax ID';
if($page_by == 'awaiting-Tax-ID'){
    $tax_column = 'Tax Reg';
}

@endphp
    <div class="container-fluid  rounded  px-3">
        <div class="row">
            <div class="col-10">
                <h3 class="text-white companies_page_tytle" data-sort_by ="{{$sort_by}}">
                    {{-- All Active Client Companies ({{$companies->count()}}) --}}
                    {{$head_title}}
                </h3>
            </div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#create_company">New</button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-10"></div>
            <div class="col-2">
                @if(!empty($company_isset_divisoins))
                    <select  id="filter_division" class="form-control">
                        @foreach($company_isset_divisoins as $company_isset_divisoin)
                            <option value="{{$company_isset_divisoin['division']}}">{{$company_isset_divisoin['division']}}</option>
                        @endforeach
                        {{-- <option value="STM Corporate Group">STM Corporate Group</option>
                        <option value="Mount Bonnell Advisors">Mount Bonnell Advisors</option>
                        <option value="US Corporation & Trust Services">US Corporation & Trust Services</option> --}}
                    </select>
                @endif
            </div>
        </div>
    {{-- <div class="container-fluid mt-5 rounded bg-white py-3 px-3"> --}}
        <div class="container-fluid mt-5  DT_container">
        @if(1>4)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Account</th>
                    <th>Type</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Inc Date</th>
                    <th>Tax Reg Date</th>
                    @if($page_by != 'awaiting-Tax-ID')
                        <th>
                            Tax ID
                            {{-- {{$tax_column}} --}}
                        </th>
                    @endif
                    {{-- <th>Filing</th> --}}
                    {{-- <th>Division</th> --}}
                    {{-- <th class="text-end">Status</th> --}}
                    @if($page_by == 'awaiting-Tax-ID')
                        <th>Tax Reg PDF</th>
                    @endif
                    <th>Google Drive</th>
                  
                    <th>
                        {{-- <div class="d-flex justify-content-end">
                            <button class="companies_sorting companies_sorting_ASC btn btn-light ">A-Z</button>
                        </div> --}}
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="companies_sorting_block_ASC">
                @if($companies)
                    @foreach($companies as  $value)
                        <tr>
                            <td>
                                <a href="{{ route('edit_company', [$value->id]) }}">
                                    <div class="page_title_exchange_rate">
                                        {{$value->name}}
                                        @if(!empty($value->salesPerodical))
                                            <div class="exchange_rate_img">
                                                <img src="{{url('image/exchange-rate.png')}}" alt="">
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </td>
                            <td>
                                @if($value->parentAccount && $value->parentAccount->name)
                                <a href="{{ route('edit_account', [$value->parentAccount->id]) }}">{{$value->parentAccount->name}}</a>
                                @endif
                            </td>
                            <td>
                                @if($value->companyTypes )
                                    {{$value->companyTypes->abbreviation}} 
                                @endif
                            </td>
                            <td>{{$value->country  && $value->country->code ? $value->country->code : "" }}</td>
                            <td>{{$value->state  && $value->state->abbreviation ?  $value->state->abbreviation :"" }}</td>
                            <td>{{$value->incorporation_date  ?? "" }}</td>
                            <td>{{$value->status_date  ? substr($value->status_date,0,10) : "" }}</td>
                            @if($page_by != 'awaiting-Tax-ID')
                                <td>{{$value->tax_id  ?? "" }}</td>
                            @endif
                            {{-- <td>{{$value->filing}}</td> --}}
                            {{-- <td>{{$value->division}}</td> --}}
                            {{-- <td>{{$value->division}}</td> --}}
                            {{-- <td>
                                <div class="d-flex justify-content-end">
                                    <span class=" badge badge-success {{$value->status ? 'bg-success' : 'bg-danger'}}">{{$value->status ? 'Active' : 'Inactive'}}</span>
                                </div>
                            </td> --}}
                            @if($page_by == 'awaiting-Tax-ID')
                                <td>
                                    <div class="df_jsfs_amc gap-3">
                                        @if(!empty($value->companyFiles)  && !empty($value->companyFiles1[0]->path))
                                            <div>
                                                <a href="{{$value->companyFiles1[0]->path}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30" width="30" version="1.1" id="Layer_1" viewBox="0 0 303.188 303.188" xml:space="preserve">
                                                        <g>
                                                            <polygon style="fill:#E8E8E8;" points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525  "/>
                                                            <path style="fill:#FB3449;" d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936   c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202   c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251   c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594   c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603   c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02   c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024   c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387   c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205   c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119   c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57   C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041   c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065   c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918   c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985   c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993   c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883   c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265   c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197   c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z    M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542   c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275   c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z"/>
                                                            <polygon style="fill:#FB3449;" points="227.64,25.263 32.842,25.263 32.842,0 219.821,0  "/>
                                                            <g>
                                                                <path style="fill:#A4A9AD;" d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643    v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z     M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857    h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z"/>
                                                                <path style="fill:#A4A9AD;" d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979    h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324    c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43    C160.841,257.523,161.76,254.028,161.76,249.324z"/>
                                                                <path style="fill:#A4A9AD;" d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374    L196.579,273.871L196.579,273.871z"/>
                                                            </g>
                                                            <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0  "/>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            @endif
                            <td >
                                <div class="d-flex justify-content-center">
                                    @if($value->google_drive)
                                        <div class="Google_Drive_img_small text-center">
                                            <a href="{{$value->google_drive}}" class="" target="_blunk">
                                                <img src="{{url('image/Google_Drive.png')}}" alt="">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a  href="{{ route('edit_company', [$value->id]) }}">
                                        <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                    </a>
                                    <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('destroy_company', [$value->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                    </a>
                                </div>
                            </td>
                            @if($sort_by == 'missing-tax-returns')
                                <td>
                                    <button class="btn btn-outline-primary open_newtax_returns" data-id="{{$value->id}}" >New</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
            {{-- <tbody class="companies_sorting_block_DESC d-none">
                @foreach($companies_DESC as  $value)
                    <tr>
                        <td><a href="{{ route('edit_company', [$value->id]) }}">{{$value->name}}</a></td>
                        <td>{{$value->parentAccount->name ?? ''}}</td>
                        <td>{{$value->companyTypes  && $value->companyTypes->name ? $value->companyTypes->name : "" }}</td>
                        <td>{{$value->country  && $value->country->name ? $value->country->name : "" }}</td>
                        <td>{{$value->state  && $value->state->name ? $value->state->name : "" }}</td>
                        <td>{{$value->incorporation_date  ?? "" }}</td>
                        <td>{{$value->tax_id  ?? "" }}</td>

                        <td>
                            <div class="d-flex justify-content-end">
                                <span class=" badge badge-success {{$value->status ? 'bg-success' : 'bg-danger'}}">{{$value->status ? 'Active' : 'Inactive'}}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <a  href="{{ route('edit_company', [$value->id]) }}">
                                    <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                </a>
                                <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('destroy_company', [$value->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody> --}}
            <tbody class="companies_sorting_block_DESC d-none">
            </tbody>
        </table>
        @endif
        <table class="table table-hover company_table mt-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Account</th>
                    <th>Type</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Inc Date</th>
                    <th>Tax Reg Date</th>
                    @if($page_by != 'awaiting-Tax-ID')
                        <th>Tax ID</th>
                    @else
                        <th>Tax Reg PDF</th>
                    @endif
                    <th>Google Drive</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    @include('modals.company')

    @include('modals.delete_modal')
    @include('modals.tax_returns')

    @section('js')
        <script>
            let company_type_abbreviation = {
                                    1 : "C-Corp",
                                    2 : "LBG",
                                    3 : "LLC",
                                    4 : "LP",
                                    5 : "LTD",
                                    6 : "PLC",
                            };

            $(function () {
                var table = $('.company_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'type': 'GET',
                        'url': "{{ route('Dtcompanies') }}",
                        data: function(d) {
                            d.sort_by = $('.companies_page_tytle').data('sort_by');
                            d.division = $("#filter_division").val();
                            return d;
                        },
                    },

                    columns: [
                        {data: 'name', name: 'name', render:(data, i, row)=>{
                            if(row.additional_value){
                                $('.companies_page_tytle').text(row.additional_value);
                            }
                            let name = `<a href="/company/${row.id}"><div class="page_title_exchange_rate">${row.name}`;
                            if((row.sales_perodical)){
                                name +=`  
                                <div class="exchange_rate_img">
                                    <img src="{{url('image/exchange-rate.png')}}" alt="">
                                </div>`;
                            }
                            name +=`</div></a>`;
                            return name;
                        }},
                        
                        {data: 'account_name', name: 'account_name', render:(data, i, row)=>{
                            let name = '';
                            if(row.parent_account){
                                name = `<a href="/account/${row.parent_account.id}">${row.parent_account.name}</a>`;
                            }
                            return name;
                        }},

                        {data: 'company_types', name: 'company_types', render:(data, i, row)=>{
                            let name = '';
                            if(row.company_types){
                                name = row.company_types.abbreviation;
                            }
                            return name;
                        }},

                        {data: 'country_code', name: 'country_code', render:(data, i, row)=>{
                            let name = '';
                            if(row.country){
                                name = row.country.code;
                            }
                            return name;
                        }},

                        {data: 'state', name: 'state', render:(data, i, row)=>{
                            let name = '';
                            if(row.state){
                                name = row.state.code;
                            }
                            return name;
                        }},

                        {data: 'incorporation_date', name: 'incorporation_date'},
                        
                        {data: 'status_date', name: 'status_date', render:(data, i, row)=>{
                            let name = '';
                            if(row.status_date){
                                name = row.status_date;
                            }
                            return name.slice(0, 10);
                        }},

                        {data: 'tax_id', name: 'tax_id',render:(data, i, row)=>{
                            let name = row.tax_id;
                            if(row.company_files1 && row.company_files1[0] && row.company_files1[0].path){
                                name = ` <div class="df_jsfs_amc gap-3">
                                                <div>
                                                    <a href="${row.company_files1[0].path}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30" width="30" version="1.1" id="Layer_1" viewBox="0 0 303.188 303.188" xml:space="preserve">
                                                            <g>
                                                                <polygon style="fill:#E8E8E8;" points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525  "/>
                                                                <path style="fill:#FB3449;" d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936   c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202   c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251   c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594   c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603   c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02   c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024   c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387   c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205   c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119   c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57   C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041   c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065   c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918   c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985   c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993   c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883   c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265   c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197   c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z    M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542   c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275   c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z"/>
                                                                <polygon style="fill:#FB3449;" points="227.64,25.263 32.842,25.263 32.842,0 219.821,0  "/>
                                                                <g>
                                                                    <path style="fill:#A4A9AD;" d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643    v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z     M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857    h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z"/>
                                                                    <path style="fill:#A4A9AD;" d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979    h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324    c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43    C160.841,257.523,161.76,254.028,161.76,249.324z"/>
                                                                    <path style="fill:#A4A9AD;" d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374    L196.579,273.871L196.579,273.871z"/>
                                                                </g>
                                                                <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0  "/>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>`;
                                }

                            return name;
                        }},

                        {data: 'google_drive', name: 'google_drive', render:(data, i, row)=>{
                            let name = '';
                            if(row.google_drive){
                                name =  `<div class="d-flex justify-content-center">
                                            <div class="Google_Drive_img_small text-center">
                                                <a href="${row.google_drive}" class="" target="_blunk">
                                                    <img src="{{url('image/Google_Drive.png')}}" alt="">
                                                </a>
                                            </div>
                                        </div> `;
                            }
                            return name;
                        }},
                      
                        {data: 'action', name: 'action', orderable: false, searchable: false,render:(data, i, row)=>{
                            let name = `<div class="d-flex justify-content-end">
                                            <a  href="/company/${row.id}">
                                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                            </a>
                                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="delete_company/${row.id}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                            </a>
                                        </div>`;
                            return name;
                        }},

                        {data: 'open_newtax_returns', name: 'open_newtax_returns', orderable: false, searchable: false,render:(data, i, row)=>{
                            let name = ``;
                            if($('.companies_page_tytle').data('sort_by') == 'missing-tax-returns'){
                                name = `<button class="btn btn-outline-primary open_newtax_returns" data-id="${row.id}" >New</button>`
                            }
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

                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                $('#filter_division').on('change', function(){
                    $('.company_table').DataTable().ajax.reload();
                  
                    let division = $(this).val();
                    let sort_by = $('.companies_page_tytle').data('sort_by');

                    $('.companies_sorting_block_ASC').empty();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"POST",
                        url:'/filter_companies_by_division',
                        datatType : 'json',
                        data: {division : division, sort_by: sort_by}, 
                        success: (response) => {
                            if (response.code == 400) {
                            }else if(response.code == 200){
                                $('.tax_returns_filter_block').empty();
                                let tbody = response.msg;
                                let tr = '';
                                let origin = window.location.origin; 
                                // console.log(tbody);
                                // $('#filter_division').empty();
                                // var division_options = '';
                                // response.divisions.map((i,j)=>{
                                //     division_options += `<option value="${i.division}"  ${i.division == division ? 'selected' : '' }  >${i.division}</option>`;
                                // })

                                // $('#filter_division').html(division_options);

                                        
                                tbody.map((v,i)=>{
                                    let id = v.id
                                    let account = '';
                                    let country = '';
                                    let type = '';
                                    let state = '';
                                    let incorporation_date = '';
                                    let tax_id = '';
                                    let pdf = '';

                                    // let status = ` <div class="d-flex justify-content-end">
                                    //                     <span class=" badge badge-success bg-danger">Inactive</span>
                                    //                 </div>`;
                                    let last_part = `  <div class="d-flex justify-content-end">
                                                        <a  href="${origin+'/company/'+id}">
                                                            <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                                        </a>
                                                        <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="${origin+'/destroy_company/'+id}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                                        </a>
                                                    </div>`;
                                    let status_date = "";
                                    let google_drive = '';

                                    if(v.parent_account){
                                        account = `<a href="${origin}/account/${v.parent_account.id}">${v.parent_account.name}</a>`;
                                    }
                                    if(v.country){
                                        country = v.country.code;
                                    }
                                    if(v.company_types){
                                        type =  v.company_types.abbreviation
                                    }
                                    if(v.state){
                                        state = v.state.name;
                                        if(v.state.abbreviation){
                                            state = v.state.abbreviation;
                                        }
                                    }
                                    if(v.incorporation_date){
                                        incorporation_date = v.incorporation_date;
                                    }
                                    if(v.tax_id){
                                        tax_id = v.tax_id;
                                    }
                                    if(v.tax_id){
                                        tax_id = v.tax_id;
                                    }
                                    if(v.status_date){
                                        status_date = v.status_date.slice(0, 10);
                                    }
                                    if(v.company_files1 && v.company_files1[0] && v.company_files1[0].path){
                                        pdf = ` <div class="df_jsfs_amc gap-3">
                                                    <div>
                                                        <a href="${v.company_files1[0].path}" target="_blank">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30" width="30" version="1.1" id="Layer_1" viewBox="0 0 303.188 303.188" xml:space="preserve">
                                                                <g>
                                                                    <polygon style="fill:#E8E8E8;" points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525  "/>
                                                                    <path style="fill:#FB3449;" d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936   c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202   c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251   c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594   c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603   c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02   c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024   c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387   c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205   c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119   c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57   C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041   c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065   c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918   c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985   c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993   c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883   c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265   c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197   c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z    M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542   c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275   c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z"/>
                                                                    <polygon style="fill:#FB3449;" points="227.64,25.263 32.842,25.263 32.842,0 219.821,0  "/>
                                                                    <g>
                                                                        <path style="fill:#A4A9AD;" d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643    v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z     M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857    h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z"/>
                                                                        <path style="fill:#A4A9AD;" d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979    h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324    c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43    C160.841,257.523,161.76,254.028,161.76,249.324z"/>
                                                                        <path style="fill:#A4A9AD;" d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374    L196.579,273.871L196.579,273.871z"/>
                                                                    </g>
                                                                    <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0  "/>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>`;
                                    }
                                    

                                    if(v.google_drive){
                                        google_drive =   `<div class="d-flex justify-content-center">
                                                            <div class="Google_Drive_img_small text-center">
                                                                <a href="${v.google_drive}" class="" target="_blunk">
                                                                    <img src="${origin}/image/Google_Drive.png" alt="">
                                                                </a>
                                                            </div>
                                                        </div> `;
                                    }
                                    let division = '';

                                    if(v.division){
                                        division = v.division;
                                    }
                                    
                                    let first_column = `<div class="page_title_exchange_rate">${v.name}`;
                                    if(v.sales_perodical){
                                        first_column +=` <div class="exchange_rate_img">
                                                            <img src="${origin}/image/exchange-rate.png" alt="">
                                                        </div>`;
                                    }

                                    first_column += `</div>`

                                 

                                    if(sort_by = 'awaiting-Tax-ID'){
                                        tr += `<tr data-division="${division}">
                                                    <td><a href="${origin+'/company/'+id}">${first_column}</a></td>
                                                    <td>${account}</td>
                                                    <td>${type}</td>
                                                    <td>${country}</td>
                                                    <td>${state}</td>
                                                    <td>${incorporation_date}</td>
                                                    <td>${status_date}</td>
                                                    <td>${pdf}</td>
                                                    <td>${google_drive}</td>
                                                    <td>${last_part}</td>`;
                                    }else{
                                        tr += `<tr data-division="${division}">
                                                    <td><a href="${origin+'/company/'+id}">${first_column}</a></td>
                                                    <td>${account}</td>
                                                    <td>${type}</td>
                                                    <td>${country}</td>
                                                    <td>${state}</td>
                                                    <td>${incorporation_date}</td>
                                                    <td>${status_date}</td>
                                                    <td>${tax_id}</td>
                                                    <td>${google_drive}</td>
                                                    <td>${last_part}</td>`;
                                    }
                                                    if(sort_by = 'missing-tax-returns'){
                                                    tr+= `<td>
                                                            <button class="btn btn-outline-primary open_newtax_returns" data-id="${id}" >New</button>
                                                        </td>`;
                                                    }
                                                    
                                    tr+= `</tr>`
                                    
                                })
                                
                                $('.companies_sorting_block_ASC').append(tr);
                                let count = tbody.length;
                                let page_title = 'All '+division+` (${count})`
                                $('.companies_page_tytle').html(page_title);
                            }
                        }
                    })
                })

                $('.companies_sorting').on('click',function(){
                    $('.companies_sorting').toggleClass("companies_sorting_ASC");
                    if($(this).hasClass('companies_sorting_ASC')){
                        $(this).html('A-Z')
                        $('.companies_sorting_block_ASC').removeClass('d-none')
                        $('.companies_sorting_block_DESC').addClass('d-none')
                    }else{
                        $(this).html('Z-A')
                        $('.companies_sorting_block_ASC').addClass('d-none')
                        let companies_sorting_block_DESC = $('.companies_sorting_block_DESC');
                        companies_sorting_block_DESC.empty();
                        $.ajax({
                            url:'/get_sorting_companies',
                            type:"post",
                            datatType : 'json',
                            data: {'id':true,  "_token": "{{ csrf_token() }}"}, 
                            datatType : 'json',
                            success: (response) => {
                                if (response.code == 403) {

                                }else if(response.code == 200){
                                    let tr = response.msg;
                                    let tbody = '';
                                    let origin = window.location.origin; 
                                        
                                    tr.map((v,i)=>{
                                        let id = v.id
                                        let account = '';
                                        let country = '';
                                        let type = '';
                                        let state = '';
                                        let incorporation_date = '';
                                        let tax_id = '';
                                        let status = ` <div class="d-flex justify-content-end">
                                                            <span class=" badge badge-success bg-danger">Inactive</span>
                                                        </div>`;
                                        let last_part = `  <div class="d-flex justify-content-end">
                                                            <a  href="${origin+'/company/'+id}">
                                                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                                                            </a>
                                                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="${origin+'/destroy_company/'+id}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                                            </a>
                                                        </div>`;
                                        if(v.parent_account){
                                            account = `<a href="${origin}/account/${v.parent_account.id}">${v.parent_account.name}</a>`;
                                        }
                                        if(v.country){
                                            country = v.country.name;
                                        }
                                        if(v.company_types){
                                            type = v.company_types.name;
                                        }
                                        if(v.state){
                                            state = v.state.name;
                                        }
                                        if(v.incorporation_date){
                                            incorporation_date = v.incorporation_date;
                                        }
                                        if(v.tax_id){
                                            tax_id = v.tax_id;
                                        }
                                        if(v.status != 0){
                                            status = ` <div class="d-flex justify-content-end">
                                                            <span class=" badge badge-success bg-success">Active</span>
                                                        </div>`;
                                        }
                                        tbody += `<tr>
                                                    <td><a href="${origin+'/company/'+id}">${v.name}</a></td>
                                                    <td>${account}</td>
                                                    <td>${type}</td>
                                                    <td>${country}</td>
                                                    <td>${state}</td>
                                                    <td>${incorporation_date}</td>
                                                    <td>${tax_id}</td>
                                                    <td>${status}</td>
                                                    <td>${last_part}</td>
                                                </tr>`
                                    })
                                    
                                    companies_sorting_block_DESC.append(tbody);
                                    companies_sorting_block_DESC.removeClass('d-none');
                                }
                            }
                        })
                    }
                })

                $('.select2').each(function(){
                    $(this).select2({
                        dropdownParent:  $(this).parent()
                    });
                })
            });

            $('#countries').change(function () {
                console.log(444444444);
                let state = $('#country_state')
                state.val("");
                $("#country_state option:selected").prop("selected", false)

                state.addClass('d-none');
                if($(this).find(':selected').val() == 4){
                    state.removeClass('d-none');
                }else{
                    state.val(0);
                }
            });



            $(document).on('click','.open_newtax_returns', function(){
                let company_id = $(this).data('id');
                $('.wrong_tax').addClass('d-none');
                $('.no_tax').addClass('d-none');
                $('.tax_years_select').addClass('d-none');
                $.ajax({
                        type:"POST",
                        url:'/prepare_tax_return_modal',
                        datatType : 'json',
                        data: {company_id : company_id},
                        
                        success:function(response){
                            let tax_years = response.tax_years;
                            $('#tax_returns_modal #company_id').val(response.msg.id);
                            if(tax_years !='' && tax_years !='wrong' && tax_years!=null){

                                $('.tax_years_select').removeClass('d-none');
                                $('.tax_years_select .tax_years_account_id').empty();
                                    let options = '';
                                    tax_years.map((i,j)=>{
                                        options += `<option value="${i}">${i}</option>`;
                                    })
                                $('.tax_years_select .tax_years_account_id').html(options);
                            }else if(tax_years !='' && tax_years == 'wrong'){
                                $('.wrong_tax').removeClass('d-none');
                            }else{
                                $('.no_tax').removeClass('d-none');
                            }

                            $('#tax_returns_modal').modal('show');

                            $('#tax_returns_modal2 input[name="company_id"]').val(response.msg.id);
                            $('#tax_returns_modal2 input[name="company_name"]').val(response.msg.name);
                        }
                })
            })

            $("#tax_returns_modal").on('hide.bs.modal', function(){
                $('.wrong_tax').addClass('d-none');
                $('.no_tax').addClass('d-none');
                $('.tax_years_select').addClass('d-none');
            
            });

        </script>
    @endsection

@endsection