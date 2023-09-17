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
<div class="modal " id="create_sale_modal" style="">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button" class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Service</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('new_sales')}}" method="POST">
                    @csrf
                    <input type="hidden" name="page_id" value="{{$id}}">
                    <input type="hidden" name="page_type" value="{{$url}}">
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Service</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center gap-10">
                                            <input type="radio" name="periodical_one_off" class="form-check-input periodical_one_off" value="1"  id="periodical" checked>
                                            <label class="mr-sm-2 form-check-label periodical_one_off" for="periodical">Periodical</label>
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-flex-end gap-10">
                                            <input type="radio" name="periodical_one_off" class="form-check-input periodical_one_off" value="2" id="one_off">
                                            <label class="mr-sm-2 form-check-label" for="one_off">One-Off</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Quantity</label>
                                     <input type="number" step=".01" class="form-control" value="1" name="quantity">
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Service configurations</label>
                                    <div>
                                        <select class="select2 custom-select form-control service_configurations_id" name="service_configurations_id">
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" data-period="{{$service->period}}" data-price="{{$service->price}}">
                                                    {{$service->title.' - '. $currencies[$service->currency].' '. $service->price.' '.$periods[$service->period]}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Start Date</label>
                                     <input type="date" class="form-control for_start_date" name="start_date" value="{{$today}}">
                                </div>
                                <div class="col-6 one_off_hide_block">
                                    <label class="mr-sm-2">For</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <select class="select2 custom-select form-control for_counts" name="for_counts">  
                                                    @for($i = 1; $i<=50; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <select class="select2 custom-select form-control for_periods" name="for_periods">
                                                    @foreach($for_periods as $key => $for_period)
                                                        <option value="{{$key}}">{{$for_period}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Until Date</label>
                                    <p class="until_date_text"></p>
                                     <input type="hidden" class="form-control until_date" name="until_date">
                                </div>
                                <div class="col-6 manual_date_block d-none">
                                    <label class="mr-sm-2">Manual Date</label>
                                    <input type="date" class="form-control manual_date" name="manual_date" >
                                </div>
                            </div>

                            <div class=" renewal_section">
                                <div class="col-12 mb-2 mt-2">
                                    <div class="bg-light p-3 h6">Renewal</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center gap-10">
                                                <input type="radio" name="renew_indefinitely_renew_until" class="form-check-input renew_indefinitely_renew_until" value="1"  id="renew_indefinitely" checked>
                                                <label class="mr-sm-2 form-check-label" for="renew_indefinitely">Renew Indefinitely</label>
                                            </div>
                                            <div class="col-6 d-flex align-items-center justify-content-flex-end gap-10">
                                                <input type="radio" name="renew_indefinitely_renew_until" class="form-check-input renew_indefinitely_renew_until" value="2" id="renew_until">
                                                <label class="mr-sm-2 form-check-label" for="renew_until">Renew Until</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 renew_until_periods_block d-none">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Renew Until Periods</label>
                                        <div class="select_renew_until_periods">
                                            <select class="select2 custom-select form-control renew_until_periods" name="renew_until_periods">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Pricing</div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="row  mt-2 mb-3">
                                        <div class="col-6">
                                            <input type="radio" name="set_price_time_spent" class="form-check-input" value="1"  id="set_price" checked>
                                            <label class="mr-sm-2 form-check-label" for="set_price">Set Price</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="set_price_time_spent" class="form-check-input" value="2" id="time_spent">
                                            <label class="mr-sm-2 form-check-label" for="time_spent">Time Spent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="time_show">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Currency</label>
                                        <div>
                                            <select class="select2 custom-select form-control" name="currency">
                                                @foreach($currencies as $key => $currencie)
                                                    <option value="{{$key}}">{{$currencie}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row  mt-2">
                                            <div class="col-6">
                                                <input type="radio" name="price_calculated" class="form-check-input" value="1"  id="calculate_price" checked>
                                                <label class="mr-sm-2 form-check-label" for="calculate_price">Calculate Price</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="price_calculated" class="form-check-input" value="2" id="enter_manual_price">
                                                <label class="mr-sm-2 form-check-label" for="enter_manual_price">Enter Manual Price</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-2">
                                    <div class="col-6"> </div>
                                    <div class="col-6 price_per_period_block">
                                        <label class="mr-sm-2">Price per Period</label>
                                        <p class="price_per_period_text"></p>
                                        <input type="hidden" class="form-control  price_per_period" name="price_per_period">
                                    </div>
                                    <div class="col-6 enter_manual_price_block d-none">
                                        <label class="mr-sm-2">Enter Manual Price</label>
                                        <input type="text" class="form-control  enter_manual_price">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Overall Price</label>
                                        <p class="overall_price_text"></p>
                                        <input type="hidden" class="form-control  overall_price" name="overall_price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Comments</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <textarea class="form-control  " name="comment"></textarea>
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


<div class="modal " id="edit_sale_modal">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button" class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">Edit Service</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_sales')}}" method="POST">
                    @csrf
                    <input type="hidden" name="page_id" value="{{$id}}">
                    <input type="hidden" name="page_type" value="{{$url}}">
                    <input type="hidden" name="sale_id" id="sale_id" value="">
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Service</div>
                            </div>
                              <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center gap-10">
                                            <input type="radio" name="periodical_one_off" class="form-check-input edit_periodical_one_off" value="1"  id="edit_periodical" checked>
                                            <label class="mr-sm-2 form-check-label periodical_one_off" for="edit_periodical">Periodical</label>
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-flex-end gap-10">
                                            <input type="radio" name="periodical_one_off" class="form-check-input edit_periodical_one_off" value="2" id="edit_one_off">
                                            <label class="mr-sm-2 form-check-label" for="edit_one_off">One-Off</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Quantity</label>
                                     <input type="number" step=".01" class="form-control quantity" name="quantity">
                                </div>
                                <div class="col-6">
                                    <label class="mr-sm-2">Service configurations</label>
                                    <div>
                                        <select class="select2 custom-select form-control edit_service_configurations_id" name="service_configurations_id">
                                            <option value=""></option>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" data-period="{{$service->period}}" data-price="{{$service->price}}">
                                                    {{$service->title.' - '. $currencies[$service->currency].' '. $service->price.' '.$periods[$service->period]}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Start Date</label>
                                    <input type="date" class="form-control edit_for_start_date" name="start_date" value="{{$today}}">
                                </div>
                                <div class="col-6 edit_one_off_hide_block">
                                    <label class="mr-sm-2">For</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <select class="select2 custom-select form-control edit_for_counts" name="for_counts">  
                                                    @for($i = 1; $i<=50; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <select class="select2 custom-select form-control edit_for_periods" id="edit_for_periods" name="for_periods">  
                                                    @foreach($for_periods as $key => $for_period)
                                                        <option value="{{$key}}">{{$for_period}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mr-sm-2">Until Date</label>
                                    <p class="edit_until_date_text"></p>
                                     <input type="hidden" class="form-control edit_until_date" name="until_date" >
                                </div>
                                <div class="col-6 edit_manual_date_block d-none">
                                    <label class="mr-sm-2">Manual Date</label>
                                    <input type="date" class="form-control edit_manual_date" name="manual_date" >
                                </div>
                            </div>

                            <div class=" edit_renewal_section">
                                <div class="col-12 mb-2 mt-2">
                                    <div class="bg-light p-3 h6">Renewal</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center gap-10">
                                                <input type="radio" name="renew_indefinitely_renew_until" class="form-check-input edit_renew_indefinitely_renew_until" value="1"  id="edit_renew_indefinitely" checked>
                                                <label class="mr-sm-2 form-check-label" for="edit_renew_indefinitely">Renew Indefinitely</label>
                                            </div>
                                            <div class="col-6 d-flex align-items-center justify-content-flex-end gap-10">
                                                <input type="radio" name="renew_indefinitely_renew_until" class="form-check-input edit_renew_indefinitely_renew_until" value="2" id="edit_renew_until">
                                                <label class="mr-sm-2 form-check-label" for="edit_renew_until">Renew Until</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 edit_renew_until_periods_block d-none">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Renew Until Periods</label>
                                        <div class="edit_select_renew_until_periods">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Pricing</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row  mt-2 mb-3">
                                        <div class="col-6">
                                            <input type="radio" name="set_price_time_spent" class="form-check-input" value="1"  id="edit_set_price" checked>
                                            <label class="mr-sm-2 form-check-label" for="edit_set_price">Set Price</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="set_price_time_spent" class="form-check-input" value="2" id="edit_time_spent">
                                            <label class="mr-sm-2 form-check-label" for="edit_time_spent">Time Spent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edit_time_show">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Currency</label>
                                        <div>
                                            <select class="select2 custom-select form-control edit_currency" id="edit_currency" name="currency">
                                                @foreach($currencies as $key => $currencie)
                                                    <option value="{{$key}}">{{$currencie}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row  mt-2">
                                            <div class="col-6">
                                                <input type="radio" name="price_calculated" class="form-check-input" value="1"  id="edit_calculate_price" checked>
                                                <label class="mr-sm-2 form-check-label" for="edit_calculate_price">Calculate Price</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="price_calculated" class="form-check-input" value="2" id="edit_enter_manual_price">
                                                <label class="mr-sm-2 form-check-label" for="edit_enter_manual_price">Enter Manual Price</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-2">
                                    <div class="col-6"> </div>
                                    <div class="col-6 edit_price_per_period_block">
                                        <label class="mr-sm-2">Price per Period</label>
                                        <p class="edit_price_per_period_text"></p>
                                        <input type="hidden" class="form-control  edit_price_per_period" name="price_per_period">
                                    </div>
                                    <div class="col-6 edit_enter_manual_price_block d-none">
                                        <label class="mr-sm-2">Enter Manual Price</label>
                                        <input type="text" class="form-control  edit_enter_manual_price">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="mr-sm-2">Overall Price</label>
                                        <p class="edit_overall_price_text"></p>
                                        <input type="hidden" class="form-control  edit_overall_price" name="overall_price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Comments</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <textarea class="form-control  comment_show" name="" disabled ></textarea>
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



@include('modals.delete_modal')

<script>
        
    $(document).ready(function() {
        var renew_until = [];
        let select = '';
        var before_change_until_date = '';
        $('.create_sale_modal_button').click(function(){
            $('#periodical').trigger('click');
            $('#renew_indefinitely').trigger('click');
        })

        // for edit
        $('.edit_sale_modal_button').on('click',function(){


            let data =  $(this).data('sales');

            let sale_id = $('#sale_id');
            let quantity = $('.quantity')
            let edit_service_configurations_id = $('.edit_service_configurations_id');
            let edit_for_counts = $('.edit_for_counts');
            let edit_for_periods = $('.edit_for_periods');
            let edit_currency = $('#edit_currency');
            let edit_until_date = $('.edit_until_date');
            let edit_until_date_text = $('.edit_until_date_text');
            let edit_manual_date = $('.edit_manual_date');
            let edit_price_per_period = $('.edit_price_per_period');
            let edit_price_per_period_text = $('.edit_price_per_period_text');
            let edit_overall_price_text = $('.edit_overall_price_text');
            let edit_overall_price = $('.edit_overall_price');
            let edit_enter_manual_price = $('.edit_enter_manual_price');
            let edit_for_start_date = $('.edit_for_start_date');
            let comment_show = $('.comment_show');

            comment_show.val('');
            edit_overall_price_text.html('');
            edit_enter_manual_price.val('')
            edit_overall_price.val('');
            edit_price_per_period.val('');
            edit_price_per_period_text.html('');
            edit_until_date_text.html('');
            edit_manual_date.val('');
            edit_until_date.val('');
            quantity.val('');
            sale_id.val(' ')
            edit_for_start_date.val('');
            edit_currency.val('usd').trigger('change.select2');
            edit_service_configurations_id.val(1).trigger('change.select2');
            edit_for_counts.val(0).trigger('change.select2');
            edit_for_periods.val('day').trigger('change.select2');


            $('.edit_manual_date_block').addClass('d-none')
            $('.edit_enter_manual_price_block').addClass('d-none')
            $('.edit_price_per_period_block').removeClass('d-none')

            before_change_until_date = data.until_date.slice(0, 10);
            if(data.id){
                sale_id.val(data.id);
            }
            if(data.quantity){
                quantity.val(data.quantity);
            }
            if(data.comment){
                comment_show.val(data.comment);
            }
            if(data.currency){
                edit_currency.val(data.currency).trigger('change.select2');
            }
            if(data.for_periods){
                edit_for_periods.val(data.for_periods).trigger('change.select2');
            }
            if(data.for_counts){
                edit_for_counts.val(data.for_counts).trigger('change.select2');
            }
            if(data.services){
                edit_service_configurations_id.val(data.services.id).trigger('change.select2');
            }
            if(data.until_date){
                edit_until_date_text.html(data.until_date.slice(0, 10));
                edit_until_date.val(data.until_date.slice(0, 10));
            }
            if(data.start_date){
                edit_for_start_date.val(data.start_date.slice(0, 10));
            }
            if(data.for_periods && data.for_periods == "manual_date" && data.until_date){
                $('.edit_manual_date_block').removeClass('d-none');
                edit_manual_date.val(data.until_date.slice(0, 10));
            }
            if(data.price_calculated &&  data.price_calculated == 2){
                $('#edit_enter_manual_price').trigger('click');
                $('.edit_enter_manual_price_block').removeClass('d-none');
                $('.edit_price_per_period_block').addClass('d-none');
            }else{
                $('#edit_calculate_price').trigger('click');
                $('.edit_price_per_period_block').removeClass('d-none');
            }

            if(data.set_price_time_spent &&  data.set_price_time_spent == 1){
                $('#edit_set_price').trigger('click');
                $('.edit_time_show').removeClass('d-none');
            }else{
                $('#edit_time_spent').trigger('click');
                $('.edit_time_show').addClass('d-none');
            }

            if(data.price_per_period){
                edit_price_per_period.val(data.price_per_period);
                edit_price_per_period_text.html(data.price_per_period);
            }
         

            $('#edit_periodical').trigger('click')
            if(data.periodical_one_off && data.periodical_one_off == 1){
                $('#edit_periodical').trigger('click')
                $('.edit_renewal_section').removeClass('d-none')
            }else if(data.periodical_one_off && data.periodical_one_off == 2){
                $('#edit_one_off').trigger('click');
                $('.edit_renewal_section').addClass('d-none');
            }

            $('#edit_renew_indefinitely').trigger('click')
            if(data.renew_indefinitely_renew_until && data.renew_indefinitely_renew_until == 1){
                $('#edit_renew_indefinitely').trigger('click')
                $('.edit_renew_until_periods_block').addClass('d-none')
            }else if(data.renew_indefinitely_renew_until && data.renew_indefinitely_renew_until == 2){
                $('#edit_renew_until').trigger('click');
                if(data.renew_until_periods){
                    $('.edit_select_renew_until_periods').empty();
                    $('.edit_select_renew_until_periods').append(`
                    <select class="select2 custom-select form-control edit_renew_until_periods" name="renew_until_periods">
                        <option value="${data.renew_until_periods}">${data.renew_until_periods}</option>
                    </select>
                    `)

                }

                $('.edit_renew_until_periods_block').removeClass('d-none');
            }

            if(data.overall_price){
                edit_overall_price.val(data.overall_price);
                edit_overall_price_text.html(data.overall_price);
            } else {
                let price = get_price_by_period(data.services.period, data.for_periods, data.for_counts);
                edit_overall_price.val(price);
                edit_overall_price_text.html(price);
            }
            
        });
        var if_changed_from_date = false;
        $('.for_start_date').on('change', function(){
                if_changed_from_date = true;
                let result = '';
                let for_start_date = $(this).val()
                let service_configurations_period = $('.service_configurations_id').find(':selected').data('period');
                let for_counts = $('.for_counts ').find(':selected').val();
                let date = new Date(for_start_date); 
                let for_periods = $('.for_periods ').find(':selected').val();
                let period = service_configurations_period;

                if (!$('#one_off').prop('checked')) {
                    period = for_periods
                }else{
                    period = service_configurations_period;
                }

                if(period == 'year'){
                    date.setFullYear(date.getFullYear() + (1*for_counts), date.getMonth(), date.getDate() - 1);
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'month'){
                    date.setFullYear(date.getFullYear(), date.getMonth() + (1*for_counts), date.getDate() - 1);
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'day'){
                    date.setFullYear(date.getFullYear(), date.getMonth(), date.getDate() + (1*for_counts));
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'week'){
                    date.setFullYear(date.getFullYear(), date.getMonth() , date.getDate() + (7*for_counts));
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'quarter'){
                    date.setFullYear(date.getFullYear(), date.getMonth()+ (3*for_counts), date.getDate() -1);
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'half_year'){
                    date.setFullYear(date.getFullYear(), date.getMonth()+ (6*for_counts), date.getDate() -1);
                    result = date.toISOString().slice(0, 10)
                }else{
                    result = for_start_date;
                }
                
                $('.until_date_text').html(result);
                $('.until_date').val(result);
        })


        var if_changed_from_date_edit = false;
        $('.edit_for_start_date').on('change', function(){
            // if($('#edit_one_off').is(':checked')){
                if_changed_from_date_edit = true;

                let result = '';
                let for_start_date = $(this).val()
                let service_configurations_period = $('.edit_service_configurations_id').find(':selected').data('period');
                let for_counts = $('.edit_for_counts ').find(':selected').val();
                let date = new Date(for_start_date); 
                let for_periods = $('.edit_for_periods ').find(':selected').val();
                let period = service_configurations_period;

                if (!$('#edit_one_off').prop('checked')) {
                    period = for_periods
                }else{
                    period = service_configurations_period;
                }

                if(period == 'year'){
                    date.setFullYear(date.getFullYear() + (1*for_counts), date.getMonth(), date.getDate() - 1);
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'month'){
                    date.setFullYear(date.getFullYear(), date.getMonth() + (1*for_counts), date.getDate() - 1);
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'day'){
                    date.setFullYear(date.getFullYear(), date.getMonth(), date.getDate() + (1*for_counts));
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'week'){
                    date.setFullYear(date.getFullYear(), date.getMonth() , date.getDate() + (7*for_counts));
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'quarter'){
                    date.setFullYear(date.getFullYear(), date.getMonth()+ (3*for_counts), date.getDate() -1);
                    result = date.toISOString().slice(0, 10)
                }else if(period == 'half_year'){
                    date.setFullYear(date.getFullYear(), date.getMonth()+ (6*for_counts), date.getDate() -1);
                    result = date.toISOString().slice(0, 10)
                }else{
                    result = for_start_date;
                }


                $('#edit_sale_modal .edit_until_date_text').html(result);
                $('#edit_sale_modal .edit_until_date').val(result);

            // }
        })

        $('#edit_sale_modal .edit_periodical_one_off').on('change', function(){
            if($('#edit_periodical').is(':checked')){
                $('#edit_sale_modal .edit_until_date_text').html(before_change_until_date);
                $('#edit_sale_modal .edit_until_date').val(before_change_until_date);
            } else if(if_changed_from_date_edit){
                $('#edit_sale_modal .edit_until_date_text').html( $('.edit_for_start_date').val());
                $('#edit_sale_modal .edit_until_date').val( $('.edit_for_start_date').val());
            }
        })

        $('#edit_enter_manual_price').click(function(){
            $('.edit_price_per_period_block').addClass('d-none');
            $('.edit_enter_manual_price_block').removeClass('d-none');
            $('.edit_price_per_period').removeAttr('name');
            $('.edit_enter_manual_price').attr('name', 'price_per_period')
            let price =  $('.edit_enter_manual_price').val()
            let count = $('.edit_for_counts').val();
            if(count == 0){
                    count = 1;
                }
            $('.edit_overall_price_text').html(price*count)
            $('.edit_overall_price').val(price*count)
            
        })

        $('#edit_calculate_price').click(function(){
            $('.edit_price_per_period_block').removeClass('d-none')
            $('.edit_enter_manual_price_block').addClass('d-none');
            $('.edit_enter_manual_price').removeAttr('name');
            $('.edit_price_per_period').attr('name', 'price_per_period')
            let price =  $('.edit_price_per_period').val()
            let count = $('.edit_for_counts').val();
            if(count == 0){
                    count = 1;
                }
            $('.edit_overall_price_text').html(price*count)
            $('.edit_overall_price').val(price*count)
                
        })

        $('.edit_enter_manual_price').on('input', function(){
            let for_counts = $('.edit_for_counts').val();
            if(for_counts == 0){
                for_counts = 1;
                }
            $('.edit_overall_price_text').html($(this).val()*for_counts)
            $('.edit_overall_price').val($(this).val()*for_counts)

        })

        $(".edit_for_periods").select2().on("select2:select", function (e) {
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();
            let for_start_date = $('.edit_for_start_date').val();
            let for_counts = $('.edit_for_counts').val();

            
            let until_date =  get_until_date(for_start_date, select_val, for_counts);
            $('#edit_calculate_price').removeAttr('disabled')
            if(select_val == 'manual_date'){
                $('.edit_manual_date_block').removeClass('d-none')
                $('#edit_enter_manual_price').trigger('click')
                $('#edit_calculate_price').attr('disabled','disabled' )
                return;
            }

            let service_configurations_period = $('.edit_service_configurations_id').find(':selected').data('period');
            let service_configurations_price = $('.edit_service_configurations_id').find(':selected').data('price');
            let price_per_period = $('.edit_price_per_period');
            $('.edit_price_per_period_text').html('');

            let price = get_price_by_period(service_configurations_period, select_val, service_configurations_price)

            price_per_period.val(price);
            $('.edit_price_per_period_text').html(price)

            if ($('#edit_calculate_price').prop('checked')) {
                let count = for_counts
                if(count == 0){
                    count = 1;
                }
                $('.edit_overall_price_text').html(price*count)
                $('.edit_overall_price').val(price*count)
                
            }

            $('.edit_manual_date_block').addClass('d-none')
            if(until_date){
                $('.edit_until_date_text').html(until_date)
                $('.edit_until_date').val(until_date)
            }
            
            if ($('#edit_renew_indefinitely').prop('checked')) {
              
            }else{
                let renew_until_periods = `<select class="select2 custom-select form-control edit_renew_until_periods" name="renew_until_periods">`
                let select_renew_until_periods = $('.edit_select_renew_until_periods');
                select_renew_until_periods.empty();
                select = '';
                get_renew_until (for_start_date, for_counts, select_val,0);
                renew_until_periods = renew_until_periods+select+` </select>`;
                select_renew_until_periods.html(renew_until_periods);
            }
          
        });

        $(".edit_for_counts").select2().on("select2:select", function (e) {
            let selected_element = $(e.currentTarget);
            let for_counts = selected_element.val();
            let for_start_date = $('.edit_for_start_date').val();
            let select_val = $('.edit_for_periods').val();

            
           let until_date =  get_until_date(for_start_date, select_val, for_counts);

            if(select_val == 'manual_date'){
                $('.edit_manual_date_block').removeClass('d-none')
                return;
            }

            let count = for_counts
            if(count == 0){
                count = 1;
            }

            if ($('#edit_calculate_price').prop('checked')) {
                let price_per_period = $('.edit_price_per_period').val();
                $('.edit_overall_price_text').html(price_per_period*count)
                $('.edit_overall_price').val(price_per_period*count)
                
            }else{
                $('.edit_overall_price_text').html($('.edit_enter_manual_price').val()*count)
                $('.edit_overall_price').val($('.edit_enter_manual_price').val()*count)
            }

            $('.edit_manual_date_block').addClass('d-none')

            if(until_date){
                $('.edit_until_date_text').html(until_date)
                $('.edit_until_date').val(until_date)
            }
          
        });

        $('.edit_manual_date').on('change', function(){
            let val = $(this).val();
            $('.edit_until_date_text').html(val)
            $('.edit_until_date').val(val)
        })


        $('.edit_service_configurations_id').change(function (e) {
                
            let service_configurations_period = $(this).find(':selected').data('period');
            let service_configurations_price = $(this).find(':selected').data('price');
            let price_per_period = $('.edit_price_per_period');
            $('.edit_enter_manual_price').val(service_configurations_price);
            let for_start_date = $('.edit_for_start_date').val();
            let for_counts = $(".edit_for_counts").val();
            $('.edit_price_per_period_text').html('');

            if(
                service_configurations_period == 'day' || 
                service_configurations_period == 'quarter' || 
                service_configurations_period == 'week' || 
                service_configurations_period == 'month' ||
                service_configurations_period == 'half_year' || 
                service_configurations_period == 'year' ||
                service_configurations_period == 'hour' ||
                service_configurations_period == 'one_off' 
                )
            {
                $(".edit_for_periods").val(1).trigger('change.select2');
                $(".edit_for_periods").val(service_configurations_period).trigger('change.select2');
            }


            let for_periods =  $(".edit_for_periods").val();
            let price = get_price_by_period(service_configurations_period, for_periods, service_configurations_price);
            price_per_period.val(price);
            $('.edit_price_per_period_text').html(price)

            if ($('#edit_calculate_price').prop('checked')) {
                $('.edit_overall_price_text').html(price*for_counts)
                $('.edit_overall_price').val(price*for_counts)
            }
            
           let until_date =  get_until_date(for_start_date, service_configurations_period, for_counts);
          
           if(until_date){
                $('.edit_until_date_text').html(until_date)
                $('.edit_until_date').val(until_date)
            }
            $('.edit_renew_until_periods').empty();
            $('.edit_renew_until_periods').html('');

            if ($('#edit_renew_indefinitely').prop('checked')) {
              
            }else{
                let renew_until_periods = `<select class="select2 custom-select form-control edit_renew_until_periods" name="renew_until_periods">`
                let select_renew_until_periods = $('.edit_select_renew_until_periods');
                select_renew_until_periods.empty();
                select = '';
                get_renew_until (for_start_date, for_counts, for_periods,0);
                renew_until_periods = renew_until_periods+select+` </select>`;
                select_renew_until_periods.html(renew_until_periods);
            }

        })

        //for new

        $('#enter_manual_price').click(function(){
            $('.price_per_period_block').addClass('d-none');
            $('.enter_manual_price_block').removeClass('d-none');
            $('.price_per_period').removeAttr('name');
            $('.enter_manual_price').attr('name', 'price_per_period')
            let price =  $('.enter_manual_price').val()
            let count = $('.for_counts').val();
            if(count == 0){
                    count = 1;
                }
            $('.overall_price_text').html(price*count)
            $('.overall_price').val(price*count)
            
        })
        $('#calculate_price').click(function(){
            $('.price_per_period_block').removeClass('d-none')
            $('.enter_manual_price_block').addClass('d-none');
            $('.enter_manual_price').removeAttr('name');
            $('.price_per_period').attr('name', 'price_per_period')
            let price =  $('.price_per_period').val()
            let count = $('.for_counts').val();
            if(count == 0){
                    count = 1;
                }
            $('.overall_price_text').html(price*count)
            $('.overall_price').val(price*count)
                
        })

        $('.enter_manual_price').on('input', function(){
            let for_counts = $('.for_counts').val();
            if(for_counts == 0){
                for_counts = 1;
                }
            $('.overall_price_text').html($(this).val()*for_counts)
            $('.overall_price').val($(this).val()*for_counts)

        })
        
        $(".for_periods").select2().on("select2:select", function (e) {
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();
            let for_start_date = $('.for_start_date').val();
            let for_counts = $('.for_counts').val();

            
            let until_date =  get_until_date(for_start_date, select_val, for_counts);
            $('#calculate_price').removeAttr('disabled')
            if(select_val == 'manual_date'){
                $('.manual_date_block').removeClass('d-none')
                $('#enter_manual_price').trigger('click')
                $('#calculate_price').attr('disabled','disabled' )
                return;
            }

            let service_configurations_period = $('.service_configurations_id').find(':selected').data('period');
            let service_configurations_price = $('.service_configurations_id').find(':selected').data('price');
            let price_per_period = $('.price_per_period');
            $('.price_per_period_text').html('');

            let price = get_price_by_period(service_configurations_period, select_val, service_configurations_price)

            price_per_period.val(price);
            $('.price_per_period_text').html(price)

            if ($('#calculate_price').prop('checked')) {
                let count = for_counts
                if(count == 0){
                    count = 1;
                }
                $('.overall_price_text').html(price*count)
                $('.overall_price').val(price*count)
                
            }

            $('.manual_date_block').addClass('d-none')
            if(until_date){
                $('.until_date_text').html(until_date)
                $('.until_date').val(until_date)
            }

            if ($('#renew_indefinitely').prop('checked')) {
              
            }else{
                let renew_until_periods = `<select class="select2 custom-select form-control renew_until_periods" name="renew_until_periods">`
                let select_renew_until_periods = $('.select_renew_until_periods');
                select_renew_until_periods.empty();
                select = '';
                get_renew_until (for_start_date, for_counts, select_val,0);
                renew_until_periods = renew_until_periods+select+` </select>`;
                select_renew_until_periods.html(renew_until_periods);
            }
          

        });

        $(".for_counts").select2().on("select2:select", function (e) {
            let selected_element = $(e.currentTarget);
            let for_counts = selected_element.val();
            let for_start_date = $('.for_start_date').val();
            let select_val = $('.for_periods').val();
            
            let until_date =  get_until_date(for_start_date, select_val, for_counts);

            if(select_val == 'manual_date'){
                $('.manual_date_block').removeClass('d-none')
                return;
            }

            let count = for_counts
            if(count == 0){
                count = 1;
            }

            if ($('#calculate_price').prop('checked')) {
                let price_per_period = $('.price_per_period').val();

                
                $('.overall_price_text').html(price_per_period*count)
                $('.overall_price').val(price_per_period*count)
                
            }else{
                $('.overall_price_text').html($('.enter_manual_price').val()*count)
                $('.overall_price').val($('.enter_manual_price').val()*count)
            }

            $('.manual_date_block').addClass('d-none')

            if(until_date){
                $('.until_date_text').html(until_date)
                $('.until_date').val(until_date)
            }
          
        });



        $('.manual_date').on('change', function(){
            let val = $(this).val();
            $('.until_date_text').html(val)
            $('.until_date').val(val)
        })

        let service_configurations_period = $('.service_configurations_id').find(':selected').data('period');
        if(
            service_configurations_period == 'day' || 
            service_configurations_period == 'quarter' || 
            service_configurations_period == 'week' || 
            service_configurations_period == 'month' ||
            service_configurations_period == 'half_year' || 
            service_configurations_period == 'year' ||
            service_configurations_period == 'hour' ||
            service_configurations_period == 'one_off' 
            )
        {
            
            $(".for_periods").val(1).trigger('change.select2');
            $(".for_periods").val(service_configurations_period).trigger('change.select2');
        }
       
        let service_configurations_price = $('.service_configurations_id').find(':selected').data('price');
        let for_start_date = $('.for_start_date').val();
        let for_counts = $(".for_counts").val();
        $('.price_per_period_text').html('');
        let price_per_period = $('.price_per_period');
        let for_periods =  $(".for_periods").find(':selected').val();

        let price = get_price_by_period(service_configurations_period, for_periods, service_configurations_price);
        price_per_period.val(price);
        $('.price_per_period_text').html(price)
        let until_date =  get_until_date(for_start_date, service_configurations_period, for_counts);
        if(until_date){
                $('.until_date_text').html(until_date)
                $('.until_date').val(until_date)
        }
        $('.overall_price_text').html(price*for_counts)
        $('.overall_price').val(price*for_counts)


        $('.service_configurations_id').change(function (e) {
                
            let service_configurations_period = $(this).find(':selected').data('period');
            let service_configurations_price = $(this).find(':selected').data('price');
            let for_start_date = $('.for_start_date').val();
            let for_counts = $(".for_counts").val();
     
            $('.price_per_period_text').html('');

            $('.enter_manual_price').val(service_configurations_price);

            if(
                service_configurations_period == 'day' || 
                service_configurations_period == 'quarter' || 
                service_configurations_period == 'week' || 
                service_configurations_period == 'month' ||
                service_configurations_period == 'half_year' || 
                service_configurations_period == 'year' ||
                service_configurations_period == 'hour' ||
                service_configurations_period == 'one_off' 
                )
            {
                $(".for_periods").val(1).trigger('change.select2');
                $(".for_periods").val(service_configurations_period).trigger('change.select2');
            }
            let price_per_period = $('.price_per_period');
            let for_periods =  $(".for_periods").val();

            let price = get_price_by_period(service_configurations_period, for_periods, service_configurations_price);

            price_per_period.val(price);
            $('.price_per_period_text').html(price)

            if ($('#calculate_price').prop('checked')) {
                $('.overall_price_text').html(price*for_counts)
                $('.overall_price').val(price*for_counts)
            }
            
           let until_date =  get_until_date(for_start_date, service_configurations_period, for_counts);

           if(until_date){
                $('.until_date_text').html(until_date)
                $('.until_date').val(until_date)
            }
            $('.renew_until_periods').empty();
            $('.renew_until_periods').html('');

          
            

            if ($('#renew_indefinitely').prop('checked')) {
              
            }else{
                let renew_until_periods = `<select class="select2 custom-select form-control renew_until_periods" name="renew_until_periods">`
                let select_renew_until_periods = $('.select_renew_until_periods');
                select_renew_until_periods.empty();
                select = '';
                get_renew_until (for_start_date, for_counts, for_periods,0);
                renew_until_periods = renew_until_periods+select+` </select>`;
                select_renew_until_periods.html(renew_until_periods);
            }

        })

        $('#set_price').click(function(){
            $('.time_show').removeClass('d-none');     
        })

        $('#time_spent').click(function(){
            $('.time_show').addClass('d-none');  
        })

        $('#edit_set_price').click(function(){
            $('.edit_time_show').removeClass('d-none');     
        })

        $('#edit_time_spent').click(function(){
            $('.edit_time_show').addClass('d-none');  
        })

    
       
        $('.select2').each(function(){
            $(this).select2({
                dropdownParent:  $(this).parent()
            });
        })

        $('.periodical_one_off').on('click', function(){
           let select_renew_until_periods = $('.select_renew_until_periods');
           select_renew_until_periods.empty();
           $('#renew_indefinitely').trigger('click');
            if ($('#one_off').prop('checked')) {
                $('.renewal_section').addClass('d-none')
                $('.one_off_hide_block').addClass('d-none');
                $('.for_counts').val(1).trigger('change.select2');

                $('.until_date_text').html($('.for_start_date').val());
                $('.until_date').val($('.for_start_date').val());
                
            }else{
                $('.renewal_section').removeClass('d-none');
                $('.one_off_hide_block').removeClass('d-none');
            }
        })

        $('.edit_periodical_one_off').on('click', function(){
           let edit_select_renew_until_periods = $('.edit_select_renew_until_periods');
           edit_select_renew_until_periods.empty();
           $('#edit_renew_indefinitely').trigger('click');
            if ($('#edit_one_off').prop('checked')) {
                $('.edit_renewal_section').addClass('d-none')
                $('.edit_one_off_hide_block').addClass('d-none');
                $('.edit_for_counts').val(1).trigger('change.select2');
                $('.edit_until_date_text').html($('.edit_for_start_date').val());
                $('.edit_until_date').val($('.edit_for_start_date').val());
            }else{
                $('.edit_renewal_section').removeClass('d-none');
                $('.edit_one_off_hide_block').removeClass('d-none');
            }
        })
        
        $('.renew_indefinitely_renew_until').on('click', function(){
           let for_start_date = $('.for_start_date').val();
           let for_counts = $(".for_counts").val();
           let for_periods =  $(".for_periods").find(':selected').val();
            if ($('#renew_indefinitely').prop('checked')) {
                $('.renew_until_periods_block').addClass('d-none')
            }else{
               
                let renew_until_periods = `<select class="select2 custom-select form-control renew_until_periods" name="renew_until_periods">`
                let select_renew_until_periods = $('.select_renew_until_periods');
                select_renew_until_periods.empty();
                select = '';
                get_renew_until (for_start_date, for_counts, for_periods,0);
                renew_until_periods = renew_until_periods+select+` </select>`;
                select_renew_until_periods.html(renew_until_periods);
                $('.renew_until_periods_block').removeClass('d-none');
            }
        })

        $('.edit_renew_indefinitely_renew_until').on('click', function(){
           let for_start_date = $('.edit_for_start_date').val();
           let for_counts = $(".edit_for_counts").val();
           let for_periods =  $(".edit_for_periods").find(':selected').val();
            if ($('#edit_renew_indefinitely').prop('checked')) {
                $('.edit_renew_until_periods_block').addClass('d-none')
            }else{
               
                let renew_until_periods = `<select class="select2 custom-select form-control edit_renew_until_periods" name="renew_until_periods">`
                let select_renew_until_periods = $('.edit_select_renew_until_periods');
                select_renew_until_periods.empty();
                select = '';
                get_renew_until (for_start_date, for_counts, for_periods,0);
                renew_until_periods = renew_until_periods+select+` </select>`;
                select_renew_until_periods.html(renew_until_periods);
                $('.edit_renew_until_periods_block').removeClass('d-none');
            }
        })


        function get_until_date(for_start_date,for_periods,for_counts = 1){

            var date = new Date(for_start_date); 

            let period_days = {
                'manual_date':0,
                'day':1,
                'week':7,
                'month':30,
                'quarter':90,
                'half_year':182,
                'year':365
            }

            if(for_periods == 'year' ){
                date.setFullYear(date.getFullYear() + parseInt(for_counts), date.getMonth(), date.getDate() - 1);
            }
            if(for_periods == 'month' ){
                date.setFullYear(date.getFullYear() , date.getMonth() + parseInt(for_counts), date.getDate() - 1);
            }
            if(for_periods == 'day' ){
                date.setFullYear(date.getFullYear() , date.getMonth(), date.getDate() + parseInt(for_counts));
            }
            if(for_periods == 'week' ){
                date.setFullYear(date.getFullYear() , date.getMonth() , date.getDate() + parseInt(for_counts * 7));
            }
            if(for_periods == 'quarter' ){
                date.setFullYear(date.getFullYear() , date.getMonth()+ parseInt(for_counts * 3) , date.getDate() -1);
            }
            if(for_periods == 'half_year' ){
                date.setFullYear(date.getFullYear() , date.getMonth()+ parseInt(for_counts * 6) , date.getDate() -1);
            }
            return date.toISOString().slice(0, 10);

            // var D = new Date(for_start_date);
            // D.setDate(D.getDate() + until_date);
            // return D.toISOString().slice(0, 10);

        }

         function get_renew_until (for_start_date, for_counts, for_periods, flag){
            let minus_day = 1;
        
            if(flag > 0 ){
                    minus_day =0
            }
            if(flag <= 5){
                var date = new Date(for_start_date); 
                if(for_periods == 'year'){
                    date.setFullYear(date.getFullYear() + 1, date.getMonth(), date.getDate() - minus_day);
                }
                if(for_periods == 'month'){
                    date.setFullYear(date.getFullYear(), date.getMonth() + 1, date.getDate() - minus_day);
                }
                if(for_periods == 'day'){
                    date.setFullYear(date.getFullYear(), date.getMonth(), date.getDate() + 1);
                }
                if(for_periods == 'week'){
                    date.setFullYear(date.getFullYear(), date.getMonth() , date.getDate() + 7);
                }
                if(for_periods == 'quarter'){
                    date.setFullYear(date.getFullYear(), date.getMonth()+ 3 , date.getDate() -minus_day);
                }
                if(for_periods == 'half_year'){
                    date.setFullYear(date.getFullYear(), date.getMonth()+ 6 , date.getDate() -minus_day);
                }
                renew_until.push(date.toISOString().slice(0, 10))

                for_start_date = date.toISOString().slice(0, 10)
                flag++;
                select += `<option value="${for_start_date}" data-id="" class="state_items">${for_start_date}</option>`

                if(flag == 5){
                    return select;
                }
                get_renew_until(for_start_date, for_counts, for_periods, flag);
              
            }
         }

         function get_price_by_period(service_configurations_period, select_val, service_configurations_price){

            let price = 0;

            if(service_configurations_period == 'year'  && select_val == 'month'){
                price = service_configurations_price/12;
            }
            if(service_configurations_period == 'year'  && select_val == 'half_year'){
                price = service_configurations_price/2;
            }
            if(service_configurations_period == 'year'  && select_val == 'quarter'){
                price = service_configurations_price/4;
            }
            if(service_configurations_period == 'year'  && select_val == 'week'){
                price = service_configurations_price/52;
            }
            if(service_configurations_period == 'year'  && select_val == 'day'){
                price = service_configurations_price/365;
            }
            if(service_configurations_period == 'year'  && select_val == 'hour'){
                price = service_configurations_price/365/24;
            }
            if(service_configurations_period == 'year'  && select_val == 'year'){
                price = service_configurations_price;
            }

            if(service_configurations_period == 'half_year'  && select_val == 'day'){
                price = service_configurations_price/182;
            }
            if(service_configurations_period == 'half_year'  && select_val == 'hour'){
                price = service_configurations_price/182/24;
            }
            if(service_configurations_period == 'half_year'  && select_val == 'quarter'){
                price = service_configurations_price/2;
            }
            if(service_configurations_period == 'half_year'  && select_val == 'month'){
                price = service_configurations_price/6;
            }
            if(service_configurations_period == 'half_year'  && select_val == 'week'){
                price = service_configurations_price/26;
            }
            if(service_configurations_period == 'half_year'  && select_val == 'year'){
                price = service_configurations_price*2;
            }
            if(service_configurations_period == 'half_year'  && select_val == 'half_year'){
                price = service_configurations_price;
            }

            if(service_configurations_period == 'quarter'  && select_val == 'day'){
                price = service_configurations_price/90;
            }
            if(service_configurations_period == 'quarter'  && select_val == 'hour'){
                price = service_configurations_price/90/24;
            }
            if(service_configurations_period == 'quarter'  && select_val == 'month'){
                price = service_configurations_price/3;
            }
            if(service_configurations_period == 'quarter'  && select_val == 'quarter'){
                price = service_configurations_price;
            }
            if(service_configurations_period == 'quarter'  && select_val == 'week'){
                price = service_configurations_price/13;
            }
            if(service_configurations_period == 'quarter'  && select_val == 'half_year'){
                price = service_configurations_price*2;
            }
            if(service_configurations_period == 'quarter'  && select_val == 'year'){
                price = service_configurations_price*4;
            }

            if(service_configurations_period == 'month'  && select_val == 'year'){
                price = service_configurations_price*12;
            }
            if(service_configurations_period == 'month'  && select_val == 'half_year'){
                price = service_configurations_price*6;
            }
            if(service_configurations_period == 'month'  && select_val == 'quarter'){
                price = service_configurations_price*3;
            }
            if(service_configurations_period == 'month'  && select_val == 'month'){
                price = service_configurations_price
            }
            if(service_configurations_period == 'month'  && select_val == 'week'){
                price = service_configurations_price/4;
            }
            if(service_configurations_period == 'month'  && select_val == 'day'){
                price = service_configurations_price/30;
            }
            if(service_configurations_period == 'month'  && select_val == 'hour'){
                price = service_configurations_price/30/24;
            }

            if(service_configurations_period == 'week'  && select_val == 'year'){
                price = service_configurations_price*52;
            }
            if(service_configurations_period == 'week'  && select_val == 'half_year'){
                price = service_configurations_price*26;
            }
            if(service_configurations_period == 'week'  && select_val == 'quarter'){
                price = service_configurations_price*13;
            }
            if(service_configurations_period == 'week'  && select_val == 'month'){
                price = service_configurations_price*4;
            }
            if(service_configurations_period == 'week'  && select_val == 'week'){
                price = service_configurations_price;
            }
            if(service_configurations_period == 'week'  && select_val == 'day'){
                price = service_configurations_price/7;
            }
            if(service_configurations_period == 'week'  && select_val == 'hour'){
                price = service_configurations_price/7/24;
            }

            if(service_configurations_period == 'day'  && select_val == 'year'){
                price = service_configurations_price*365;
            }
            if(service_configurations_period == 'day'  && select_val == 'half_year'){
                price = service_configurations_price*182;
            }
            if(service_configurations_period == 'day'  && select_val == 'quarter'){
                price = service_configurations_price*90;
            }
            if(service_configurations_period == 'day'  && select_val == 'month'){
                price = service_configurations_price*30;
            }
            if(service_configurations_period == 'day'  && select_val == 'week'){
                price = service_configurations_price*7;
            }
            if(service_configurations_period == 'day'  && select_val == 'day'){
                price = service_configurations_price;
            }
            if(service_configurations_period == 'day' && select_val == 'hour'){
                price = service_configurations_price/24;
            }

            if(service_configurations_period == 'hour'  && select_val == 'hour'){
                price = service_configurations_price;
            }
            if(service_configurations_period == 'hour'  && select_val == 'year'){
                price = service_configurations_price*365*24;
            }
            if(service_configurations_period == 'hour'  && select_val == 'half_year'){
                price = service_configurations_price*182*24;
            }
            if(service_configurations_period == 'hour'  && select_val == 'quarter'){
                price = service_configurations_price*90*24;
            }
            if(service_configurations_period == 'hour'  && select_val == 'month'){
                price = service_configurations_price*30*24;
            }
            if(service_configurations_period == 'hour'  && select_val == 'week'){
                price = service_configurations_price*7*24;
            }
            if(service_configurations_period == 'hour'  && select_val == 'day'){
                price = service_configurations_price*24;
            }
            if(service_configurations_period == 'one_off'){
                price = service_configurations_price
            }

            return price;
            }



    });

</script>