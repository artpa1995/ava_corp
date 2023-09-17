@extends('user.layout.app')
@section('title')Projected Revenues @endsection
@section('contents')

    <div class="container-fluid  rounded  px-3">
        <div class="row">
            <div class="col-10">
                <h3 class="text-white sales_page_tytle" >
                    @if(!empty($head_title))
                        {{$head_title}}
                    @endif
                </h3>
            </div>
            <div class="col-2 text-end">
                <select name="filter_date" id="filter_date" class="form-control">
                    <option value="all">Next 12 Months</option>
                    @foreach($sales_filters_dates_arrary as $sales_filters_dates)
                    @php
                        $month  = $months[substr($sales_filters_dates,5,7)];
                        $year = substr($sales_filters_dates,0,4);
                    @endphp
                        <option value="{{$sales_filters_dates}}">{{$month}}-{{$year}}</option>
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
                    <th>Company Name</th>
                    <th>Account</th>
                    <th>Service Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Revenue </th>
                </tr>
            </thead>
            <tbody class="sales_filter_block">
                @foreach($sales as $sale)
                    <tr>
                        <td>
                            @if(!empty($sale['company']))
                                <a href="{{$sale['company']['id']}}">{{$sale['company']['name']}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!empty($sale['account']))
                                <a href="{{$sale['account']['id']}}">{{$sale['account']['name']}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!empty($sale['services']))
                            
                                {{$sale['services']['title']}}
                            @endif
                        </td>
                        <td>
                            {{substr($sale['start_date'],0,10)}}
                        </td>
                        <td>
                            {{substr($sale['until_date'],0,10)}}
                        </td>
                        <td>
                            {{$sale['overall_price']}} $
                            
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
@endif
        <table class="table table-hover Dtinvoicings mt-5">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Account</th>
                    <th>Service Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Revenue </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@section('js')

<script>

    $(function () {
    var table = $('.Dtinvoicings').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            'type': 'GET',
            'url': "{{ route('Dtinvoicings') }}",
            data: function(d) {
                d.year = $('#filter_date').val();
                return d;
            },
        },

        columns: [
            {data: 'company_name', name: 'company_name', render:(data, i, row)=>{
                
                if(row.additional_value){
                    $('.sales_page_tytle').text(row.additional_value);
                }
                let name = ``;
                if((row.company)){
                    name = `<a href="/company/${row.company.id}"><div class="page_title_exchange_rate">${row.company.name}</a>`;
                }
                return name;
            }},
            
            {data: 'account_name', name: 'account_name', render:(data, i, row)=>{
                let name = '';
                if(row.account){
                    name = `<a href="/account/${row.account.id}">${row.account.name}</a>`;
                }
                return name;
            }},

            {data: 'service_name', name: 'service_name'},

            {data: 'start_date', name: 'start_date', render:(data, i, row)=>{
                let name = '';
                if(row.start_date){
                    name = row.start_date.slice(0, 10);
                }
                return name;
            }},

            {data: 'until_date', name: 'until_date', render:(data, i, row)=>{
                let name = '';
                if(row.until_date){
                    name = row.until_date.slice(0, 10);
                }
                return name;
            }},

            {data: 'overall_price', name: 'overall_price', render:(data, i, row)=>{
                let name = '';
                if(row.overall_price){
                    name = row.overall_price+' $';
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


$('#filter_date').on('change', function(){
    let year = $(this).val();

    $('.Dtinvoicings').DataTable().ajax.reload();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:"POST",
        url:'/sales_year_filter',
        datatType : 'json',
        data: {year : year}, 
        success: (response) => {
            if (response.code == 400) {
            }else if(response.code == 200){
              
                $('.sales_filter_block').empty();
                if(response.title){
                    $('.sales_page_tytle').empty();
                    $('.sales_page_tytle').html(response.title)
                }
                let tbody = response.msg;
                let tr = '';
                let origin = window.location.origin; 
                        
                tbody.map((v,i)=>{
                    let company = '';
                    let account = '';
                    let service = '';
                    let start_date = '';
                    let end_date = '';
                    let overall_price = '';
                    


                    if(v.company){
                        company = `<a href='/company/${v.company.id}'>${v.company.name}</a>`;  
                    }
                        
                    if(v.account){
                        account = `<a href='/account/${v.account.id}'>${v.account.name}</a>`;            
                    }

                    if(v.services){
                        service = v.services.title;
                    }

                    if(v.start_date){
                        start_date = v.start_date.slice(0, 10);
                    }

                    if(v.until_date){
                        end_date = v.until_date.slice(0, 10);
                    }

                    if(v.overall_price){
                        overall_price = v.overall_price;
                    }

                    tr += `<tr>
                                <td>${company}</td>
                                <td>${account}</td>                                                
                                <td>${service}</td>
                                <td>${start_date}</td>
                                <td>${end_date}</td>
                                <td>${overall_price} $</td>
                            </tr>`
                })
                
                $('.sales_filter_block').append(tr);
            }
        }
    })
})

})

</script>

@endsection

@endsection