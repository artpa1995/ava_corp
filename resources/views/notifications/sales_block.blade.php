<div class="row mt-3 px-3">
    <div class="col-12 text-end">
        <button class="btn btn-outline-primary create_sale_modal_button" data-toggle="modal" data-target="#create_sale_modal">New</button>
    </div>
</div>
@if(!empty($sales))
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

    $for_periods =[
        'day' => 'Day(s)',
        'week' => 'Week(s)',
        'month' => 'Month(s)', 
        'quarter' => 'Quarter(s)', 
        'half_year' => 'Half-Year(s)', 
        'year' => 'Year(s)', 
        'manual_date' => 'Manual Date'
    ];
    $today = date("Y-m-d");
    @endphp

    @foreach($sales as $sale_data)
        @php
            $servise_title = !empty($sale_data->services) && !empty($sale_data->services->title)? $sale_data->services->title:'';
            $currency_ = $sale_data->currency;
            $overall_price = $sale_data->overall_price;
            if($currency_){
                $currency_  = $currencies[$sale_data->currency];
            }
            $gcik = '-';
            if($sale_data->set_price_time_spent && $sale_data->set_price_time_spent == 2){
                $currency_ = '';
                $overall_price = '';
                $gcik = '';
            }

        @endphp
        <div class="col-12 sales_blocks mt-3 py-2 px-2">
            <div>
                <p class="px-2 mb-1"><b>{{$servise_title.$gcik. $currency_ .' '. $overall_price}}</b></p>  
                <p class="px-2 mb-1"> <b>{{str_replace('-','/',substr($sale_data->start_date,0,10)).' - '.str_replace('-','/',substr($sale_data->until_date,0,10))}}</b></p>
            </div>
            <div class="d-flex align-items-center justify-content-flex-end px-2 py-2 gap-10">
                <a class="cursor-pointer  edit_sale_modal_button" data-target="#edit_sale_modal" data-toggle="modal"  data-sales="{{$sale_data}}">
                    <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                </a>
                <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_sales', [$sale_data->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                </a>
            </div>
        </div>
    @endforeach
    {{-- {{ app()->version() }} --}}
    @if(!empty($Expired_Entrie_sales) && !$Expired_Entrie_sales->isEmpty())


    <div class="col-12  mt-3 py-2 px-2">
        <h3 class="text-center mt-2">Expired Entries</h3>
    </div>
        
        @foreach($Expired_Entrie_sales as $Expired_Entrie_sale)

            @php
            $servise_title = !empty($Expired_Entrie_sale->services) && !empty($Expired_Entrie_sale->services->title)? $Expired_Entrie_sale->services->title:'';
            $currency_ = $Expired_Entrie_sale->currency;
            $overall_price = $Expired_Entrie_sale->overall_price;
            if($currency_){
                $currency_  = $currencies[$Expired_Entrie_sale->currency];
            }
            $gcik = '-';
            if($Expired_Entrie_sale->set_price_time_spent && $Expired_Entrie_sale->set_price_time_spent == 2){
                $currency_ = '';
                $overall_price = '';
                $gcik = '';
            }

            @endphp
        <div class="col-12 sales_blocks mt-3 py-2 px-2">
            <div>
                <p class="px-2 mb-1"><b>{{$servise_title.$gcik. $currency_ .' '. $overall_price}}</b></p>  
                <p class="px-2 mb-1"> <b>{{str_replace('-','/',substr($Expired_Entrie_sale->start_date,0,10)).' - '.str_replace('-','/',substr($Expired_Entrie_sale->until_date,0,10))}}</b></p>
            </div>
            <div class="d-flex align-items-center justify-content-flex-end px-2 py-2 gap-10">
                <a class="cursor-pointer  edit_sale_modal_button" data-target="#edit_sale_modal" data-toggle="modal"  data-sales="{{$Expired_Entrie_sale}}">
                    <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg>
                </a>
                <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_sales', [$Expired_Entrie_sale->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                </a>
            </div>
        </div>

        @endforeach

   @endif

@endif
