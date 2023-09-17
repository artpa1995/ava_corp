@extends('user.layout.app')
@section('title')Emails @endsection
@section('contents')

    <div class="container-fluid  rounded   px-3">
        <div class="row ">
            <div class="col-10"></div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#tax_returns_modal">New</button>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5  py-3 px-3">
        <div class="row  rounded bg-white" style="min-height: 600px;">
            <div class="col-4  " style="border-right: 1px solid lightgrey;">
                @foreach($all_emails as $email_data)
                @php
                
                
                @endphp
                    <div class="row px-2 py-2 border-bottom email_conrtent_show cursor-pointer" data-content="{{$email_data['message']}} ">
                        <div class="col-10">
                            <div class="col-12">
                                From: {{ $email_data['from'][0]->personal ?? ""}} <a >{{ $email_data['from'][0]->mailbox.$email_data['from'][0]->host}}</a> 
                            </div>
                            <div class="col-12">
                                Subject: {{$email_data['subject']}}
                            </div>
                            <div class="col-12">
                                Date: {{ substr($email_data['date'],0,16)}}
                            </div>
                        </div>
                        <div class="col-2">
                            <a class="data_delete_email_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-msg="{{$email_data['msg']}}" data-to="{{$email_data['to']}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"></path><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-8">
                <div class="row email_content  d-none">

                </div>
            </div>
            </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="py-3"><h5 class="modal-title text-center" id="exampleModalLabel">Are you sure? </h5></div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <form class="form-inline" action="{{route('delete_mailbox_email')}}" method="POST">
                        @csrf
                        <input type="hidden" name="msg" value="" id="msg">
                        <input type="hidden" name="email_address" value="" id="email_address">
                        <button type="submit" class="btn btn-primary">Delete</button>
                
                </form>
            </div>
        </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(function(){

                $('.email_conrtent_show').on('click', function(){
                    $('.email_content').empty();
                    let content = $(this).data('content')

                    $('.email_content').removeClass('d-none');
                    $('.email_content').append('<div>'+ content +'</div>')
                })

                $('.data_delete_email_from').on('click',function(){
                    let msg = $(this).data('msg');
                    let to = $(this).data('to');
                    $('#email_address').val(to);
                    $('#msg').val(msg);
                })
            })
        </script>
    @endsection

@endsection