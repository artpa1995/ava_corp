{{-- <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a> --}}
{{-- <style>
    .header{
        text-align: center
    }
    .table{
        /* width: 100%;
        max-width: 80%; */
        margin: 0 auto;
    }
</style> --}}


{{-- Name: Company Name
Identifying Number: Tax ID
Number, street, and room or suite no. (If P.O. box, see instructions.): Address 1 plus Address 2 from above setting (the same for all companies)
City, town, state, and ZIP code: City, State, ZIP
Values for 1: 
If Tax Return type a or b : 12
If company type is c: 09
Values for 5a: Should be clear based on tax year
Values for 5b; If tax return period is less than 1 year, tick “Initial Return” --}}


{{-- @php
 
    $value1 = 0;
    if($company['tax_return_type'] == 1 || $company['tax_return_type'] == 3){
        $value1 = 12;
    }
    if($company['company_id'] == 4){
        $value1 = '09';
    }


@endphp

<h1 class="header">7004 Filing Extension {{ substr($company['tax_date'],0,4)}}</h1>

<table class="table">
    <tr>
        <td>Name: </td>
        <td>{{$company['name']}}</td>
    </tr>
    <tr>
        <td>Identifying Number: </td>
        <td>{{$company['tax_id']}}</td>
    </tr>
    <tr>
        <td>Number, street, and room or suite no. (If P.O. box, see instructions.): </td>
        <td>{{$company['address1']}}, {{$company['address2']}}</td>
    </tr>
    <tr>
        <td>City, town, state, and ZIP code: </td>
        <td>{{$company['city']}}, {{$company['correspondence_state']}}, {{$company['zip']}}</td>
    </tr>
    <tr>
        <td>Value: </td>
        <td>{{$value1}}</td>
    </tr>
</table> --}}