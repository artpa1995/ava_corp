@extends('user.layout.app')
@section('title')Tax Returns @endsection
@section('contents')

    @php
    $company_tax_return_type = [
        "1" =>'1120 (Corporation)',
        "2" =>'1120 (Foreign Disregarded Entity)',
        "3" =>'1065 (Partnership)',
        "4" =>'No Return Due'
    ];

    $account_tax_return_type = [
        "1" =>'Form 1040  (Standard Tax Return)',
        "2" =>'Form 1040-NR (Non Resident)',                 
    ];

    $tax_return_statuses = [
        "1" =>' Not Filed',
        "2" =>'Filed',
        "3" =>'NA',
        ]

    @endphp

    <div class="container-fluid  rounded  px-3">
        <div class="row">
            <div class="col-11">
                <!--<button name="sort_by_name" id="sort_by_name" class=" btn btn btn-light ">A-Z</button>-->
                <h3 class="text-white tax_return_page_tytle" >
                    {{-- @if(!empty($head_title))
                        {{$head_title}}
                    @endif --}}
                </h3>
            </div>
            <div class="col-1 text-end">
                <select name="filter_date" id="filter_date" class="form-control">
                    @foreach($tax_return_array_years as $tax_return_array_year)
                        <option value="{{$tax_return_array_year}}">{{$tax_return_array_year}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid mt-5 rounded bg-white py-3 px-3 DT_container"> --}}
        <div class="container-fluid mt-5  DT_container">
        @if(1>4)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tax Payer</th>
                    <th>Account</th>
                    <th>Company Status</th>
                    <th>Type</th>
                    <th>TR Status</th>
                    <th>Extension</th>
                    <th>TR PDF</th>
                    <th>Google Drive</th>
                </tr>
            </thead>
            <tbody class="tax_returns_filter_block">
                @foreach($tax_returns as $tax_return)
                {{-- @php
                dump($tax_return)
                @endphp --}}
                    <tr>
                        <td>
                            @if($tax_return['notification'] && $tax_return['notification'] == 'account')
                                <a href="/account/{{$tax_return['account']['id']}}">{{$tax_return['account'] && $tax_return['account']['name'] ? $tax_return['account']['name']  : ""}}</a>
                            @elseif($tax_return['notification'] && $tax_return['notification'] == 'company')
                                <a href="/company/{{$tax_return['company_with_account']['id']}}">{{$tax_return['company_with_account'] && $tax_return['company_with_account']['name'] ? $tax_return['company_with_account']['name']  : ""}}</a>  
                            @endif
                        </td>
                        <td>
                            @if($tax_return['notification'] && $tax_return['notification'] == 'company')
                                <a href="/account/{{$tax_return['company_with_account']['parent_account']['id']}}">{{$tax_return['company_with_account']['parent_account'] && $tax_return['company_with_account']['parent_account']['name'] ? $tax_return['company_with_account']['parent_account']['name']  : ""}}</a>
                            @endif
                        </td>
                        <td>
                           @if($tax_return['notification'] && $tax_return['notification'] == 'company')
                                {{!empty($tax_return['company_status']) ? $tax_company_status[$tax_return['company_status']] : ""}}
                            @endif
                        </td>
                        <td>
                            @if($tax_return['notification'] && $tax_return['notification'] == 'account')
                                <a class=" show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                data-toggle="modal"
                                data-target="#show_tax_returns_account"
                                data-tax_returns="{{ json_encode($tax_return)}}">
                                {{ $tax_return['tax_return_type'] ?  $account_tax_return_type[$tax_return['tax_return_type']] : ""}}
                            </a>
                            @elseif($tax_return['notification'] && $tax_return['notification'] == 'company')
                                <a 
                                class=" show_tax_returns_company show_modal_by_type cursor-pointer text-primary"
                                        data-toggle="modal"
                                        data-target="#show_tax_returns_company"
                                        data-tax_returns="{{ json_encode($tax_return)}}"
                                        data-tax_returns="{{ json_encode($tax_return)}}">
                                 {{ $tax_return['tax_return_type'] ?  $company_tax_return_type[$tax_return['tax_return_type']] : ""}}</a>
                            @endif
                        </td>
                        <td>
                            {{ $tax_return['status']  ? $tax_return_statuses[$tax_return['status']]  : "NA"}}
                        </td>
                        <td>
                            @if($tax_return['notification'] && $tax_return['notification'] == 'account')
                                <div class="df_jsfs_amc gap-3">
                                    {{-- <div 
                                        class=" show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                        data-toggle="modal"
                                        data-target="#show_tax_returns_account"
                                        data-tax_returns="{{ json_encode($tax_return)}}
                                        ">
                                        4868
                                    </div> --}}
                                    @if(!empty($tax_return['pdf_file']) && !empty($tax_return['pdf_file']['path']))
                                        <div>
                                            <a href="{{!empty($tax_return['pdf_file']) && !empty($tax_return['pdf_file']['path'])?$tax_return['pdf_file']['path']:""}}" target="_blank">
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
                               
                            @elseif($tax_return['notification'] && $tax_return['notification'] == 'company')
                                <div class="df_jsfs_amc gap-3">
                                    {{-- <div 
                                        class=" show_tax_returns_company show_modal_by_type cursor-pointer text-primary"
                                        data-toggle="modal"
                                        data-target="#show_tax_returns_company"
                                        data-tax_returns="{{ json_encode($tax_return)}}
                                        ">
                                        7004
                                    </div> --}}
                                    @if(!empty($tax_return['pdf_file']) && !empty($tax_return['pdf_file']['path']))
                                        <div>
                                            <a href="{{!empty($tax_return['pdf_file']) && !empty($tax_return['pdf_file']['path'])?$tax_return['pdf_file']['path']:""}}" target="_blank">
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
                            @endif
                        </td>
                        <td>
                            {{-- @php dump($tax_return) @endphp --}}
                            @if(!empty($tax_return['file_path']) )
                                <a href="{{!empty($tax_return['file_path'])?$tax_return['file_path']:""}}" target="_blank">
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
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if(!empty($tax_return['google_drive']))
                                    <div class="Google_Drive_img_small text-center">
                                        <a href="{{$tax_return['google_drive']}}" class="" target="_blunk">
                                            <img src="{{url('image/Google_Drive.png')}}" alt="">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <table class="table table-hover tax_returns_table mt-5">
            <thead>
                <tr>
                    <th>Tax Payer</th>
                    <th>Account</th>
                    <th>Company Status</th>
                    <th>Type</th>
                    <th>TR Status</th>
                    <th>Extension</th>
                    <th>TR PDF</th>
                    <th>Google Drive</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>


    {{-- company modal start --}}
    <div class="modal " id="show_tax_returns_company" style="">
        <div class="modal-dialog mt-5 modal-lg">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Tax Return</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline tax_return_form" action="{{route('edit_tax_returns')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tax_id" id="tax_id">
                        <input type="hidden" name="company_name" id="company_name" value="">
                        <input type="hidden" name="company_id" id="company_id" value="">
                        <div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Year Start Date</label>
                                    <input type="date" value="" name="start_date" class="form-control tax_returns_start_date_show " disabled>
                                    <input type="hidden" value="" name="" class="form-control tax_returns_start_date_show tax_returns_tax_start" >
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Year End Date</label>
                                    <input type="date" value="" name="tax_end" class="form-control tax_returns_end_date_show " disabled>
                                    <input type="hidden" value=""  class="form-control tax_returns_end_date_show tax_returns_tax_end" >
                                </div>
                            </div>
                             <div class="row mb-3 mt-2 LLC_Tax_Status_for_This_Tax_Year_block_show d-none" >
                                <div class="col-6">
                                    <label class="mr-sm-2">LLC Tax Status for This Tax Year</label>
                                    <div>
                                        <select class="select2 custom-select form-control LLC_Tax_Status_for_This_Tax_Year_show" name="LLC_Tax_Status_for_This_Tax_Year" id=''>
                                            <option value="1" >Single Member LLC with Non-US Owner</option>
                                            <option value="2" >Single Member LLC with US Owner</option>
                                            <option value="3" >Corporation</option>
                                            <option value="4" >Partnership</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="LLC_Tax_Status_for_This_Tax_Year_exist" class="LLC_Tax_Status_for_This_Tax_Year_exist" value="0">
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Company Status for this Tax Year</label>
                                    <div>
                                        <select  class="select2 custom-select form-control tax_returns_company_status_show" name="company_status" id=''>
                                            <option value="1">Active & Trading</option>
                                            <option value="2">Non Trading (Traded Before)</option>
                                            <option value="3">Dormant (Never Traded)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 p-events-n">
                                    <label  class="mr-sm-2">Tax Return Type</label>
                                    <div>
                                        <select  class="select2 custom-select form-control tax_return_type tax_return_type_show" name="tax_return_type" id='tax_return_type'>
                                            <option value="1">1120 (Corporation)</option>
                                            <option value="2">1120 (Foreign Disregarded Entity)</option>
                                            <option value="3">1065 (Partnership)</option>
                                            <option value="4">No Return Due</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Return Status</label>
                                    <div>
                                        <select  class="select2 custom-select form-control tax_returns_status_show"  name="status" id=''>
                                            <option value="1">Not Filed</option>
                                            <option value="2">Filed</option>
                                            <option value="3">NA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Return Due Date</label>
                                    <input type="date" value="" name="due_date" class="form-control tax_returns_due_date_show">
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-primary generate_form_7004 generate_form_7004_show">Generate</button>
                                            <input type="hidden" name="generate_file" class="generate_file generate_file_show">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                   <label class="mr-sm-2">Filing Extension 7004; File Upload / Link </label> 
                                    {{-- <input type="file" name="filing_extension"  class="form-control filing_extension_show "> --}}
                                   <input type="text" name="filing_extension_link" id="filing_extension_link" class="form-control mt-2 filing_extension_link filing_extension_link_show">
                                    <div class="col-12 form_7004_link form_7004_link_edit"></div>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2 ">Tax Return Link; File Upload / Link</label>
                                    {{-- <input type="file" value="" name="file" class="form-control file_link_file_input_show"> --}}
                                    <input type="text" value="" name="file_link" class="form-control tax_returns_file_path_show mt-2 file_link_view_tax">
                                    <div class="col-12 file_link_href_view "></div>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Submitted on</label>
                                    <input type="date" name="file_date_1" id="" class="form-control file_date_1_show">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Submitted on</label>
                                    <input type="date" name="file_date_2" id="" class="form-control file_date_2_show">
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-12">
                                    <label class="mr-sm-2">TR Google Drive Folder</label>
                                    <input name="google_drive" id=""  class="form-control Google_Drive_text_show">
                                    <div class="Google_Drive_img_big Google_Drive_img_show mt-2 d-none" >
                                        <a href="" class="Google_Drive_link_show" target="_blunk">
                                            <img src="{{url('image/Google_Drive.png')}}" alt="">
                                        </a>
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
    {{-- company modal end --}}

    {{-- account modal start --}}

    <div class="modal " id="show_tax_returns_account" style="">
        <div class="modal-dialog mt-5 modal-lg">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Tax Return</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline tax_return_form" action="{{route('edit_tax_returns_account')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tax_id" id="tax_id_account">
                        <input type="hidden" name="account_name" id="account_name" value="">
                        <input type="hidden" name="account_id" id="account_id" value="">
                        <div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Year Start Date</label>
                                    <input type="date" value="" name="start_date" class="form-control tax_returns_start_date_show " disabled>
                                    <input type="hidden" value="" name="" class="form-control tax_returns_start_date_show tax_returns_tax_start" >
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Year End Date</label>
                                    <input type="date" value="" name="tax_end" class="form-control tax_returns_end_date_show " disabled>
                                    <input type="hidden" value=""  class="form-control tax_returns_end_date_show tax_returns_tax_end" >
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Return Due Date</label>
                                    <input type="date" value="" name="due_date" class="form-control tax_returns_due_date_show">
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Tax Return Type</label>
                                    <div>
                                        <select  class="select2 custom-select form-control " name="tax_return_type" id='tax_return_type'>
                                            <option value="1">Form 1040  (Standard Tax Return)</option>
                                            <option value="2">Form 1040-NR (Non Resident)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary Set_to_Last_Year_new_2_show">Set to Last Year</button>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Tax Return Status</label>
                                    <div>
                                        <select  class="select2 custom-select form-control tax_returns_status_show"  name="status" id=''>
                                            <option value="1">Not Filed</option>
                                            <option value="2">Filed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2 ">Filing Status</label>
                                    <div>
                                        <select  class="select2 custom-select form-control tax_returns_company_status_show" name="company_status" id=''>
                                            <option value="1">Single</option>
                                            <option value="2">Married Filing Jointly</option>
                                            <option value="3">Married Filing Separately</option>
                                            <option value="4">Head of Household</option>
                                            <option value="5">Qualifying Widow(er) with Dependent (edited)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-primary generate_form_7004">Generate</button>
                                            <input type="hidden" name="generate_file" class="generate_file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Filing Extension 7004; File Upload / Link </label>
                                    {{-- <input type="file" name="filing_extension" id="" class="form-control"> --}}
                                    <input type="text" name="filing_extension_link" id="filing_extension_link" class="form-control mb-3 mt-2 filing_extension_link">
                                    <div class="col-12 form_7004_link form_7004_link_edit"></div>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2 ">Tax Return Link; File Upload / Link</label>
                                    {{-- <input type="file" value="" name="file" class="form-control "> --}}
                                    <input type="text" value="" name="file_link" class="form-control tax_returns_file_path_show mt-2 file_link_view_tax">
                                    <div class="col-12 file_link_href_view "></div>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-12">
                                    <label class="mr-sm-2">TR Google Drive Folder</label>
                                    <input name="google_drive" id=""  class="form-control Google_Drive_text_show">
                                    <div class="Google_Drive_img_big Google_Drive_img_show mt-2 d-none" >
                                        <a href="" class="Google_Drive_link_show" target="_blunk">
                                            <img src="{{url('image/Google_Drive.png')}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="Spouse_Information_block_edit d-none">
                                <div class="row mb-3 mt-2 px-2">
                                    <div class="bg-light p-3 h6">Spouse Information</div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Full Name</label>
                                        <input type="text" name="fullname" id="fullname_edit" class="form-control mb-3 mt-2 " >
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">SSN or ITIN</label>
                                        <input type="text" name="SSN_or_ITIN" id="SSN_or_ITIN_edit" class="form-control mb-3 mt-2 ">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Date of Birth</label>
                                        <input type="date" name="bday" id="bday_edit" class="form-control mb-3 mt-2">
                                    </div>
                                    <div class="col-6">
                                        <label  class="mr-sm-2">Country of Citizenship</label>
                                        <div>
                                            <select class="select2 custom-select form-control" name="country_id" id='country_id_edit'>
                                                @foreach($countries as $coun)
                                                    <option value="{{$coun->id}}">{{$coun->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <div class="col-6">
                                        <input type="checkbox" name="desabled_field" id="desabled_edit"  value="1">
                                        <label for="desabled_edit" class="mr-sm-2">Disabled</label>
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

    {{-- account modal end --}}


    @include('modals.delete_modal')

    @section('js')
        <script>
            
            let company_tax_return_type = {
                    "1" :'1120 (Corporation)',
                    "2" :'1120 (Foreign Disregarded Entity)',
                    "3" :'1065 (Partnership)',
                    "4" :'No Return Due'
                };

                let account_tax_return_type = {
                    "1" :'Form 1040  (Standard Tax Return)',
                    "2" :'Form 1040-NR (Non Resident)',                 
                };

                let tax_company_status = {
                    // '1' : 'Dormant (never traded)',
                    // '2' : 'Non trading (but traded before)',
                    // '3' : 'Trading',
                    // '4' : 'Disregarded Entity',

                    '1' : 'Active & Trading',
                    '2' : 'Non Trading (Traded Before)',
                    '3' : 'Dormant (Never Traded)',
                };

                let tax_return_statuses = {
                    "1" :' Not Filed',
                    "2" :'Filed',
                    "3" :'NA',
                }


            $(function () {
                var table = $('.tax_returns_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'type': 'GET',
                        'url': "{{ route('DttaxReturnd') }}",
                        data: function(d) {
                            d.year = $('#filter_date').val();
                            return d;
                        },
                    },

                    columns: [
                        
                        {data: 'page_tite', name: 'page_tite', render:(data, i, row)=>{
                            // console.log(row);
                            if(row.TaxPayer == "company" && row.company_with_account){
                                name = `<a href='/company/${row.company_with_account.id}'>${row.company_with_account.name}</a>`;  
                            }

                            if(row.TaxPayer == "account" && row.account){
                                name = `<a href='/account/${row.account.id}'>${row.account.name}</a>`;  
                            }

                            if(row.additional_value){
                                $('.tax_return_page_tytle').text(row.additional_value);
                            }

                            return name;
                        }},
                        
                        {data: 'account_name', name: 'account_name', render:(data, i, row)=>{
                            let name = '';
                            if(row.company_with_account && row.company_with_account.parent_account){
                                name = `<a href="/account/${row.company_with_account.parent_account.id}">${row.company_with_account.parent_account.name}</a>`;
                            }
                            return name;
                        }},

                        {data: 'company_status', name: 'company_status', render:(data, i, row)=>{
                            let name = '';
                            if(row.company_status && tax_company_status[row.company_status]){
                                name = tax_company_status[row.company_status]
                            }
                            return name;
                        }},

                        {data: 'tax_return_type', name: 'tax_return_type', render:(data, i, row)=>{
                            let name = '';
                            if(row.TaxPayer == 'account' && account_tax_return_type[row.tax_return_type]){
                                name = `<a 
                                            class=" show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                            data-toggle="modal"
                                            data-target="#show_tax_returns_account"
                                            data-tax_returns='${JSON.stringify(row)}'>
                                                ${account_tax_return_type[row.tax_return_type]}
                                        </a>`;
                            }
                            if(row.TaxPayer == 'company' && company_tax_return_type[row.tax_return_type]){
                                name = `<a 
                                            class=" show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                            data-toggle="modal"
                                            data-target="#show_tax_returns_account"
                                            data-tax_returns='${JSON.stringify(row)}'>
                                                ${company_tax_return_type[row.tax_return_type]}
                                        </a>`;
                            }
                            return name;
                        }},
                        {data: 'status', name: 'status', render:(data, i, row)=>{
                            let name = '';
                            if(row.status && tax_return_statuses[row.status]){
                                name = tax_return_statuses[row.status]
                            }else{
                                name = 'NA';
                            }
                            return name;
                        }},

                        {data: 'pdf_file', name: 'pdf_file',  searchable: false, render:(data, i, row)=>{
                            let name = '';
                            if(row.pdf_file && row.pdf_file.path){
                                name =` <div>
                                               <a href="${row.pdf_file.path}" target="_blank">
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
                                           </div>`;
                            }
                            return name;
                        }},


                        {data: 'file_path', name: 'file_path',  searchable: false, render:(data, i, row)=>{
                            let name = '';
                            if(row.file_path){
                                name =` <div>
                                               <a href="${row.file_path}" target="_blank">
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
                                           </div>`;
                            }
                            return name;
                        }},


                        {data: 'google_drive', name: 'google_drive',  searchable: false, render:(data, i, row)=>{
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


            $(document).ready(function(){

                $(document).on('click', '.type_open_modal', function(){
                    let trigger_block = $(this).parents('tr').find('.show_modal_by_type');
                    trigger_block.trigger('click')
                    // console.log(trigger_block);
                })



                // year flter
                $('#filter_date').on('change', function(){
                    let year = $(this).val()
                    $('.tax_returns_table').DataTable().ajax.reload();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"POST",
                        url:'/year_filter_tax_returns',
                        datatType : 'json',
                        data: {year : year}, 
                        success: (response) => {
                            // console.log(response);
                            if (response.code == 400) {
                            }else if(response.code == 200){
                                $('.tax_returns_filter_block').empty();
                                if(response.title){
                                    $('.tax_return_page_tytle').empty();
                                    $('.tax_return_page_tytle').html(response.title)
                                }
                                let tbody = response.msg;
                                let tr = '';
                                let origin = window.location.origin; 
                                        
                                tbody.map((v,i)=>{
                                    let name = '';
                                    let type = '';
                                    let status = `Filed`;
                                    let extension = '';
                                    let google_drive = '';
                                    let company_type = '';
                                    let pdf_file = '';
                                    let company_account = '';
                                    
                                    if(v.status){
                                        status = tax_return_statuses[v.status];
                                    }else{
                                        status = 'NA';
                                    }

                                    if(v.google_drive ){
                                        google_drive = `<div class="d-flex justify-content-center">
                                                            <div class="Google_Drive_img_small text-center">
                                                                <a href="${v.google_drive}" class="" target="_blunk">
                                                                    <img src="${origin}/image/Google_Drive.png" alt="">
                                                                </a>
                                                            </div>
                                                        </div> `;
                                    }

                                    if(v.company_with_account){
                                        name = `<a href='/company/${v.company_with_account.id}'>${v.company_with_account.name}</a>`;  
                                        if(v.company_with_account.parent_account){
                                            company_account = `<a href='/account/${v.company_with_account.parent_account.id}'>${v.company_with_account.parent_account.name}</a>`;
                                        }
                                        if(v.company_status){
                                            company_type = tax_company_status[v.company_status];
                                        }
                                        type =  `<a 
                                                        class="show_tax_returns_company show_modal_by_type cursor-pointer text-primary"
                                                        data-toggle="modal"
                                                        data-target="#show_tax_returns_company"
                                                        data-tax_returns='${JSON.stringify(v)}'>
                                                            ${company_tax_return_type[v.tax_return_type]}
                                                    </a>`;

                                        extension = `<div class="df_jsfs_amc gap-3">`;
                                        
                                    }else if(v.account){
                                        
                                        name = `<a href='/account/${v.account.id}'>${v.account.name}</a>`;  
                                        type = `<a 
                                                        class=" show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                                        data-toggle="modal"
                                                        data-target="#show_tax_returns_account"
                                                        data-tax_returns='${JSON.stringify(v)}'>
                                                            ${account_tax_return_type[v.tax_return_type]}
                                                    </a>`;
                                        extension = `<div class="df_jsfs_amc gap-3">`
                                                    
                                    }

                                    if(v.pdf_file && v.pdf_file.path){
                                            extension += ` <div>
                                               <a href="${v.pdf_file.path}" target="_blank">
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
                                           </div>`;
                                    }
                                    if(v.company_with_account){
                                        extension += `</div>`;
                                    }else if(v.account){
                                        extension += `</div>`;
                                    }

                                  

                                    if(v.file_path ){
                                        pdf_file =  `<a href="${v.file_path}" target="_blank">
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
                                                    </a>`;

                                    }

                                    tr += `<tr>
                                                <td>${name}</td>
                                                <td>${company_account}</td>                                                
                                                <td>${company_type}</td>
                                                <td><a class="type_open_modal cursor-pointer">${type}</a></td>
                                                <td>${status}</td>
                                                <td>${extension}</td>
                                                <td>${pdf_file}</td>
                                                <td>${google_drive}</td>
                                            </tr>`
                                })
                                
                                $('.tax_returns_filter_block').append(tr);
                            }
                        }
                    })
                })



// company modal start
                $(document).on('click','.show_tax_returns_company', function(){
                    undisabled_tax_return_filds_show();
                    let data = $(this).data('tax_returns');
                    // console.log(data);
                    let tax_status = {'1':'Not Filed', '2':'Filed'};
                    let tax_returns_start_date_show = $('.tax_returns_start_date_show');
                    let tax_returns_end_date_show = $('.tax_returns_end_date_show');
                    let tax_returns_due_date_show = $('.tax_returns_due_date_show');
                    let tax_returns_status_show = $('.tax_returns_status_show');
                    let tax_returns_company_status_show = $('.tax_returns_company_status_show');
                    let tax_return_type = $('#tax_return_type');
                    let tax_returns_file_path_show = $('.tax_returns_file_path_show');
                    let tax_id = $('#tax_id');
                    let company_name = $('#company_name');
                    let company_id = $('#company_id');
                    let Google_Drive_text_show = $('.Google_Drive_text_show');
                    let Google_Drive_link_show = $('.Google_Drive_link_show');
                    let Google_Drive_img_show = $('.Google_Drive_img_show');
                    

                    company_name.val('');
                    company_id.val('');
                    tax_returns_start_date_show.val('');
                    tax_returns_end_date_show.val('');
                    tax_returns_due_date_show.val('');
                    tax_returns_file_path_show.val('');
                    tax_id .val('');
                    Google_Drive_text_show.val('');
                    Google_Drive_link_show.removeAttr('href');
                    Google_Drive_img_show.addClass('d-none');

                    $('.link_of_generate').val('');

                    tax_returns_status_show.val(1).trigger('change.select2');
                    tax_returns_company_status_show.val(1).trigger('change.select2');

                    // console.log(data.status);
                    if(data.status == 1){
                        tax_returns_status_show.val(1).trigger('change.select2');
                    }else if(data.status == 2){
                        tax_returns_status_show.val(2).trigger('change.select2');
                    }else if(data.status == 3){
                        tax_returns_status_show.val(3).trigger('change.select2');
                    }
                    
                    if(!data.due_date){
                        tax_returns_status_show.val(3).trigger('change.select2');
                    }

                    if(data.google_drive){
                        Google_Drive_text_show.val(data.google_drive);
                        Google_Drive_link_show.attr('href', data.google_drive);
                        Google_Drive_img_show.removeClass('d-none')
                    }

                    if(data.company_with_account){
                    tax_returns_company_status_show.val(data.company_status).trigger('change.select2');
                    }
                
                    if(data.company_with_account){
                        if(data.company_with_account.name){
                            company_name.val(data.company_with_account.name);
                        }
                        company_id.val(data.company_with_account.id);
                    }
                    $('.form_7004_link_edit').empty();
                    if(data.pdf_file){
                        $('.link_of_generate').val(data.pdf_file.path);
                    }

                    $('.LLC_Tax_Status_for_This_Tax_Year_block_show').addClass('d-none');
                    $('.LLC_Tax_Status_for_This_Tax_Year_show').val(1).trigger('change.select2');
                    if(data.LLC_Tax_Status_for_This_Tax_Year && data.company_with_account.company_id == 3){
                        // console.log(data.company_with_account.company_id);
                        $('.LLC_Tax_Status_for_This_Tax_Year_block_show').removeClass('d-none');
                        $('.LLC_Tax_Status_for_This_Tax_Year_show').val(data.LLC_Tax_Status_for_This_Tax_Year).trigger('change.select2');
                    }
                    // console.log(data.company_with_account.company_id);
                    if(data.company_with_account.company_id == 3){
                        $('.LLC_Tax_Status_for_This_Tax_Year_block_show').removeClass('d-none');
                    }

                    $('.file_date_1_show').val('');
                    $('.file_date_2_show').val('');

                    if(data.file_date_1){
                        $('.file_date_1_show').val(data.file_date_1);
                    }

                    if(data.file_date_2){
                        $('.file_date_2_show').val(data.file_date_2);
                    }

                    tax_returns_start_date_show.val(data.tax_start);
                    tax_returns_end_date_show.val(data.tax_end);
                    tax_returns_due_date_show.val(data.due_date);
                    tax_returns_file_path_show.val(data.file_path);
                    $('#filing_extension_link').val('')
                    // $('#filing_extension_link').parent().find('input').removeAttr('disabled')
                    if(data.pdf_file && data.pdf_file.path){
                        // $('#filing_extension_link').parent().find('input').attr('disabled', 'disabled')
                        
                        $('#filing_extension_link').val(data.pdf_file.path)
                        $('#filing_extension').val(data.pdf_file.path)
                        $('.form_7004_link_edit').append('<a href="'+data.pdf_file.path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                    }
                    // $('.file_link_href_view').parent().find('input').removeAttr('disabled')
                    $('.file_link_href_view').empty();
                    if(data.file_path){
                        // $('.file_link_href_view').parent().find('input').attr('disabled', 'disabled')
                        $('.file_link_href_view').append('<a href="'+data.file_path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                    }

                    if(data.tax_return_type){
                        tax_return_type.val(data.tax_return_type).trigger('change.select2');
                        if(data.tax_return_type == 4){
                            disabled_tax_return_filds_show();
                        }
                    }
                    tax_id .val(data.id);
                })


                function disabled_tax_return_filds_show(){
                    $('.filing_extension_show').prop("disabled", true);
                    $('.filing_extension_link_show').attr('disabled', 'disabled');
                    $('.file_link_file_input_show').attr('disabled', 'disabled');
                    $('.tax_returns_file_path_show').attr('disabled', 'disabled');
                    $('.tax_returns_status_show').val(3).trigger('change.select2');
                    $('.tax_returns_status_show').attr('disabled', 'disabled');
                    $('.generate_form_7004_show').attr('disabled', 'disabled');
                    $('.generate_file_show').attr('disabled', 'disabled');
                }

                function undisabled_tax_return_filds_show(){
                    $('.tax_returns_status_show').removeAttr('disabled');
                    $('.generate_form_7004_show').removeAttr('disabled');
                    $('.generate_file_show').removeAttr('disabled');
                    $('.filing_extension_show').removeAttr('disabled');
                    $('.filing_extension_link_show').removeAttr('disabled');
                    $('.file_link_file_input_show').removeAttr('disabled');
                    $('.tax_returns_file_path_show').removeAttr('disabled');
                }

                $(document).on("change",'.LLC_Tax_Status_for_This_Tax_Year_show', function (e) {
                        
                    let selected_element = $(e.currentTarget);
                    let select_val = selected_element.val();
                    let company_type =  $('.company_type_for_tax_returns').val();
                    let Company_Status_for_this_Tax_Year_new = $('.tax_returns_company_status_show').val();
            
                    if(select_val == 3){
                        $('.tax_return_type_show').val(1).trigger('change.select2');
                    undisabled_tax_return_filds_show()
                    }
                    if(select_val == 4){
                        $('.tax_return_type_show').val(3).trigger('change.select2');
                    undisabled_tax_return_filds_show()
                    }
                    if(select_val == 2){
                        $('.tax_return_type_show').val(4).trigger('change.select2');
                    disabled_tax_return_filds_show();
                    }
                    if(Company_Status_for_this_Tax_Year_new == 1 && select_val == 1){
                        $('.tax_return_type_show').val(2).trigger('change.select2');
                    undisabled_tax_return_filds_show()
                    }
                    if((Company_Status_for_this_Tax_Year_new == 2 || Company_Status_for_this_Tax_Year_new == 3) && select_val == 1){
                        $('.tax_return_type_show').val(4).trigger('change.select2');
                    disabled_tax_return_filds_show();
                    }
            
                })

                $(document).on("change",'.tax_returns_company_status_show' , function (e) {
                            
                    let selected_element = $(e.currentTarget);
                    let select_val = selected_element.val();
                    // console.log(select_val);
                    let company_type =  $('.company_type_for_tax_returns').val();
                    if(company_type == 3){
                        if(select_val == 1 && $('.LLC_Tax_Status_for_This_Tax_Year_show').val() == 1){
                        $('.tax_return_type_show').val(2).trigger('change.select2');
                    undisabled_tax_return_filds_show()
                        }
                        if((select_val == 2 || select_val == 3) && $('.LLC_Tax_Status_for_This_Tax_Year_show').val() == 1){
                            $('.tax_return_type_show').val(4).trigger('change.select2');
                        disabled_tax_return_filds_show();
                        } 
                    }
                })

                $(document).on('click','.generate_form_7004', function(){
                    let tax_end = $(this).parents('.tax_return_form').find('.tax_returns_tax_end').val()
                    let tax_start = $(this).parents('.tax_return_form').find('.tax_returns_tax_start').val()
                    let company_id = $('#company_id').val();
                    let tax_return_type = $(this).parents('.tax_return_form').find('.tax_return_type').val();

                    $(this).parent().find('.generate_file').val('');
                    $(this).html('Loading ...')
                    $(this).attr('disabled',true);
                    $(this).parents('.tax_return_form').find('.form_7004_link').empty();
                    $(this).parents('.tax_return_form').find('.filing_extension_link').val('');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"POST",
                        url:'/edit_pdf',
                        datatType : 'json',
                        data: {company_id : company_id, tax_end : tax_end,tax_start:tax_start , tax_return_type: tax_return_type}, 
                        success: (response) => {
                            if (response.code == 400) {
                            }else if(response.code == 200){
                                let text = response.msg;
                                $(this).parents().find('.generate_file').val(text);
                                $(this).parents('.tax_return_form').find('.filing_extension_link').val(text);
                                $(this).parents('.tax_return_form').find('.form_7004_link').append('<a href="'+text+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                                $(this).html('Generate')
                                $(this).attr('disabled',false);
                            }
                        }
                    })
                })

                $(document).on('input' ,'.filing_extension_link', function(){
                    $(this).parents('.tax_return_form').find('.form_7004_link').empty();
                    $(this).parents('.tax_return_form').find('.form_7004_link').append('<a href="'+$(this).val()+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                })
                $(document).on('input','.file_link_new_tax', function(){
                    $(this).parents('.tax_return_form').find('.file_link_href').empty();
                    $(this).parents('.tax_return_form').find('.file_link_href').append('<a href="'+$(this).val()+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                })

                $(document).on('input','.Google_Drive_text', function(){
                    let value = $(this).val();
                    $('.Google_Drive_link').attr('href', value);
                    $('.Google_Drive_img').removeClass('d-none');
                    if(value == ''){
                        $('.Google_Drive_img').addClass('d-none');
                    }
                })

                $(document).on('input','.Google_Drive_text_show', function(){
                    let value = $(this).val();
                    $('.Google_Drive_link_show').attr('href', value);
                    $('.Google_Drive_img_show').removeClass('d-none');
                    if(value == ''){
                        $('.Google_Drive_img_show').addClass('d-none');
                    }
                })

                // company modal end


                //account modal start

                $(document).on('click','.Set_to_Last_Year_new', function(){
                    let date = $('#tax_returns_start_date');
                    let today = new Date();
                    let year = today.getFullYear();
                    let dd = String(today.getDate()).padStart(2, '0');
                    let mm = String(today.getMonth() + 1).padStart(2, '0');
                    let yy = today.getFullYear();
                    today = yy + '-' + mm + '-' + dd;
                    date.val(today);

                    let lastDay = year + "-" + 12 + "-" + 31;
                    $('.tax_returns_tax_end').val(lastDay);
                })

                $(document).on('click','.Set_to_Last_Year_new_2', function(){

                    let today = new Date();
                    let year = today.getFullYear();
                    let lastDay = '';
                    $('.tax_returns_due_date').val('')
                    if($('.tax_return_type').val() == 1){
                        lastDay = year + "-" + '04' + "-" + 15;
                    }else if($('.tax_return_type').val() == 2){
                        lastDay = year + "-" + '06' + "-" + 15;
                    }
                    $('.tax_returns_due_date').val(lastDay);
                })

                $(document).on('click','.Set_to_Last_Year_new_2_show', function(){

                    let today = new Date();
                    let year = today.getFullYear();
                    let lastDay = '';
                    $('.tax_returns_due_date_show').val('')
                    if($('#tax_return_type').val() == 1){
                        lastDay = year + "-" + '04' + "-" + 15;
                    }else if($('#tax_return_type').val() == 2){
                        lastDay = year + "-" + '06' + "-" + 15;
                    }
                    $('.tax_returns_due_date_show').val(lastDay);
                })

                $(document).on('click','.show_tax_returns_account', function(){
                    let data = $(this).data('tax_returns');
                    // console.log(data);
                    let tax_status = {'1':'Not Filed', '2':'Filed'};
                    let tax_returns_start_date_show = $('.tax_returns_start_date_show');
                    let tax_returns_end_date_show = $('.tax_returns_end_date_show');
                    let tax_returns_due_date_show = $('.tax_returns_due_date_show');
                    let tax_returns_status_show = $('.tax_returns_status_show');
                    let tax_returns_company_status_show = $('.tax_returns_company_status_show');
                    let tax_return_type = $('#tax_return_type');
                    let account_name = $('#account_name');
                    let account_id = $('#account_id');
                    let tax_returns_file_path_show = $('.tax_returns_file_path_show');
                    let tax_id = $('#tax_id_account');3
                    let Google_Drive_text_show = $('.Google_Drive_text_show');
                    let Google_Drive_link_show = $('.Google_Drive_link_show');
                    let Google_Drive_img_show = $('.Google_Drive_img_show');

                    tax_returns_start_date_show.val('');
                    tax_returns_end_date_show.val('');
                    tax_returns_due_date_show.val('');
                    tax_returns_file_path_show.val('');
                    Google_Drive_text_show.val('');
                    Google_Drive_link_show.removeAttr('href');
                    Google_Drive_img_show.addClass('d-none');
                    tax_id .val('');
                    account_name.val('');
                    account_id.val('');
                    $('.Spouse_Information_block_edit').addClass('d-none')

                    $('#fullname_edit').val('')
                    $('#SSN_or_ITIN_edit').val('')
                    $('#bday_edit').val('')
                    $('#country_id_edit').val(1).trigger('change.select2');

                    $('.link_of_generate').val('');

                    tax_returns_status_show.val(1).trigger('change.select2');
                    tax_returns_company_status_show.val(1).trigger('change.select2');

                    if(data.fullname){
                        $('#fullname_edit').val(data.fullname)
                    }
                    
                    if(data.google_drive){
                        Google_Drive_text_show.val(data.google_drive);
                        Google_Drive_link_show.attr('href', data.google_drive);
                        Google_Drive_img_show.removeClass('d-none');
                    }

                    if(data.SSN_or_ITIN){
                        $('#SSN_or_ITIN_edit').val(data.SSN_or_ITIN)
                    }

                    if(data.country_id){
                        $('#country_id_edit').val(data.country_id).trigger('change.select2');
                    }

                    if(data.bday){
                        $('#bday_edit').val(data.bday.slice(0, 10));
                    }
                
                    if(data.disabled){
                        $('#desabled_edit').attr('checked', true);
                        $('#desabled_edit').prop('checked');
                    }
                    
                    if(data.spouseed){
                        $('.Spouse_Information_block_edit').removeClass('d-none')
                    }
                    //   console.log(data.status);
                    if(data.status){
                        tax_returns_status_show.val(data.status).trigger('change.select2');
                    }else{
                        tax_returns_status_show.val(2).trigger('change.select2');
                    }

                    if(data.account){
                        account_id.val(data.account.id)
                        if(data.account.name){
                            account_name.val(data.account.name);
                        }
                    }

                    if(data.company_status){
                    tax_returns_company_status_show.val(data.company_status).trigger('change.select2');
                    }

                    if(data.tax_return_type){
                        tax_return_type.val(data.tax_return_type).trigger('change.select2');
                    }
                    $('.form_7004_link_edit').empty();
                    if(data.pdf_file){
                        $('.link_of_generate').val(data.pdf_file.path);
                    }

                    tax_returns_start_date_show.val(data.tax_start);
                    tax_returns_end_date_show.val(data.tax_end);
                    tax_returns_due_date_show.val(data.due_date);
                    tax_returns_file_path_show.val(data.file_path);

                    $('#filing_extension_link').val('')
                    $('#filing_extension_link').parent().find('input').removeAttr('disabled')
                    if(data.pdf_file && data.pdf_file.path){
                        $('#filing_extension_link').parent().find('input').attr('disabled', 'disabled')
                        $('#filing_extension_link').val(data.pdf_file.path)
                        $('#filing_extension').val(data.pdf_file.path)
                        $('.form_7004_link_edit').append('<a href="'+data.pdf_file.path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                    }
                    $('.file_link_href_view').parent().find('input').removeAttr('disabled')
                    $('.file_link_href_view').empty();
                    if(data.file_path){
                        $('.file_link_href_view').parent().find('input').attr('disabled', 'disabled')
                        $('.file_link_href_view').append('<a href="'+data.file_path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                    }
                
                    tax_id .val(data.id);
                })

                $(document).on('change', '.tax_returns_company_status_show', function(e){
                    let selected_element = $(e.currentTarget);
                    let select_val = selected_element.val();

                    $('.Spouse_Information_block_edit').addClass('d-none');

                    if(select_val == 2 || select_val == 3){
                        let account_id = $(this).parents('.tax_return_form').find('#account_id').val();
                        $('.Spouse_Information_block_edit').removeClass('d-none');

                    let tax_returns_tax_end = $('.tax_returns_end_date_show').val();
                    
                    if(tax_returns_tax_end && tax_returns_tax_end != ''){

                            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            });
                            $.ajax({
                                type:"POST",
                                url:'/get_prev_year_tax_return_account',
                                datatType : 'json',
                                data: {account_id : account_id, tax_end : tax_returns_tax_end}, 
                                success: (response) => {
                                    if (response.code == 200) {
                                        let data = response.msg;
                                        // console.log(data);
                                        $('#fullname_edit').val('')
                                        $('#SSN_or_ITIN_edit').val('')
                                        $('#bday_edit').val('')

                                        $('#country_id_edit').val(1).trigger('change.select2');
                                        
                                        if(data.fullname){
                                            $('#fullname_edit').val(data.fullname)
                                        }

                                        if(data.SSN_or_ITIN){
                                            $('#SSN_or_ITIN_edit').val(data.SSN_or_ITIN)
                                        }

                                        if(data.country_id){
                                            $('#country_id_edit').val(data.country_id).trigger('change.select2');
                                        }

                                        if(data.bday){
                                            $('#bday_edit').val(data.bday.slice(0, 10));
                                        }
                                        $('#desabled_edit').removeAttr('checked')
                                        if(data.disabled){
                                            $('#desabled_edit').attr('checked', true);
                                            $('#desabled_edit').prop('checked');
                                        }

                                    }
                                }
                            })
                    }

                    }
                })

                //account modal end

                                //sort_by_name

                                $('#sort_by_name').on('click', function(){
                    $(this).toggleClass('sort_active');
                    let sort = 'ASC';
                    let year = $('#filter_date').val();

                    if($(this).hasClass('sort_active')){
                        $(this).html('Z-A');
                        sort = 'DESC';
                    }
                    // console.log(sort);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:"POST",
                        url:'/sort_by_name_tax_returns',
                        datatType : 'json',
                        data: {year : year, sort:sort}, 
                        success: (response) => {
                            if (response.code == 400) {
                            }else if(response.code == 200){
                                $('.tax_returns_filter_block').empty();
                                let tbody = response.msg;
                                let tr = '';
                                let origin = window.location.origin; 
                                        
                                tbody.map((v,i)=>{
                                    let name = '';
                                    let type = '';
                                    let status = `Not Filed`;
                                    let extension = '';
                                    let google_drive = '';
                                    let company_type = '';
                                    let pdf_file = '';
                                    let company_account = '';
                                    
                                    if(v.status){
                                        status = tax_return_statuses[v.status];
                                    }else{
                                        status = 'Filed';
                                    }

                                    if(v.google_drive ){
                                        google_drive = `<div class="d-flex justify-content-center">
                                                            <div class="Google_Drive_img_small text-center">
                                                                <a href="${v.google_drive}" class="" target="_blunk">
                                                                    <img src="${origin}/image/Google_Drive.png" alt="">
                                                                </a>
                                                            </div>
                                                        </div> `;
                                    }

                                    if(v.company_with_account){
                                        name = `<a href='/company/${v.company_with_account.id}'>${v.company_with_account.name}</a>`;  
                                        if(v.company_with_account.parent_account){
                                            company_account = `<a href='/account/${v.company_with_account.parent_account.id}'>${v.company_with_account.parent_account.name}</a>`;
                                        }
                                        type = `<a 
                                                        class="show_tax_returns_company show_modal_by_type cursor-pointer text-primary"
                                                        data-toggle="modal"
                                                        data-target="#show_tax_returns_company"
                                                        data-tax_returns='${JSON.stringify(v)}'>
                                                            ${company_tax_return_type[v.tax_return_type]}
                                                    </a>`;
                                        
                                        extension = `<div 
                                                        class="col-12 show_tax_returns_company show_modal_by_type cursor-pointer text-primary"
                                                        data-toggle="modal"
                                                        data-target="#show_tax_returns_company"
                                                        data-tax_returns='${JSON.stringify(v)}'>
                                                            7004
                                                    </div>`;
                                        
                                    }else if(v.account){
                                        name = `<a href='/account/${v.account.id}'>${v.account.name}</a>`;  
                                        type =`<a 
                                                        class=" show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                                        data-toggle="modal"
                                                        data-target="#show_tax_returns_account"
                                                        data-tax_returns='${JSON.stringify(v)}'>
                                                            ${account_tax_return_type[v.tax_return_type]}
                                                    </a>`;
                                        
                                        // account_tax_return_type[v.tax_return_type];
                                        extension = `<div 
                                                        class="col-12 show_tax_returns_account show_modal_by_type cursor-pointer text-primary"
                                                        data-toggle="modal"
                                                        data-target="#show_tax_returns_account"
                                                        data-tax_returns='${JSON.stringify(v)}'>
                                                            4868
                                                    </div>`
                                    }
                                    if(v.company_status){
                                        company_type = tax_company_status[v.company_status];
                                    }

                                    if(v.file_path ){
                                        pdf_file =  `<a href="${v.file_path}" target="_blank">
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
                                                    </a>`;

                                    }

                                    tr += `<tr>
                                                <td>${name}</td>
                                                <td>${company_account}</td>   
                                                <td>${company_type}</td>
                                                <td>${type}</td>
                                                <td>${status}</td>
                                                <td>${extension}</td>
                                                <td>${pdf_file}</td>
                                                <td>${google_drive}</td>
                                            </tr>`
                                })
                                
                                $('.tax_returns_filter_block').append(tr);
                            }
                        }
                    })

                })

            })

        </script>
    @endsection

@endsection