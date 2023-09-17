@extends('user.layout.app')
@section('title')Email Notifications @endsection
@section('contents')

    <div class="container-fluid mt-5  py-3 px-3">
        <div class="row  rounded bg-white" style="min-height: 600px;">
            <div class="col-6  " style="border-right: 1px solid lightgrey;">
                <h3 class="text-center mt-3">New Company Added</h3>

                <form action="{{route('save_email_notafication')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <input type="hidden" name="email_name" value="New Company Added">
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <label class="mr-sm-2">To</label>
                            <input  type="text" class="form-control "  value="{{$add_company->to??''}}" name="to" >
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <input  type="checkbox" value="1" name="status" {{!empty($add_company->status) && $add_company->status ? 'checked' : ""}}>
                            <label class="mr-sm-2">Enable</label>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <label class="mr-sm-2">Subject</label>
                            <input  type="text" class="form-control "  value="{{$add_company->subject??''}}" name="subject" >
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Company name</th>
                                        <th>User who created the company</th>
                                        <th>Link to company</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>[company]</td>
                                        <td>[user]</td>
                                        <td>[link]</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <label class="mr-sm-2">Body</label>
                            <textarea name="body" class="form-control ">{{$add_company->body??''}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1 text-center" >
                        <div class="col-2">
                            <button name="submit" type="submit" class="form-control btn btn-danger">Save</button>
                        </div>
                    </div>
                </form>
            </div>




            <div class="col-6">
                <h3 class="text-center mt-3">Company Disengaged / Engaged</h3>
                <form action="{{route('save_email_notafication')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="2">
                    <input type="hidden" name="email_name" value="Company Disengaged / Engaged">
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <label class="mr-sm-2">To</label>
                            <input  type="text" class="form-control "  value="{{$company_disengaged->to??''}}" name="to" >
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <input  type="checkbox" value="1" name="status" {{!empty($company_disengaged->status) && $company_disengaged->status ? 'checked': "" }}>
                            <label class="mr-sm-2">Enable</label>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <label class="mr-sm-2">Subject</label>
                            <input  type="text" class="form-control "  value="{{$company_disengaged->subject??''}}" name="subject" >
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Company name</th>
                                        <th>User who created the company</th>
                                        <th>Link to company</th>
                                        <th>Engagement Status</th>
                                        <th>Reason</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>[company]</td>
                                        <td>[user]</td>
                                        <td>[link]</td>
                                        <td>[status]</td>
                                        <td>[reason_for_disengagement]</td>
                                        <td>[comment]</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <div class="col-12">
                            <label class="mr-sm-2">Body</label>
                            <textarea name="body" class="form-control ">{{$company_disengaged->body??''}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1 text-center" >
                        <div class="col-2">
                            <button name="submit" type="submit" class="form-control btn btn-danger">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @section('js')
        <script>
            $(document).ready(function(){

            })
        </script>
    @endsection

@endsection