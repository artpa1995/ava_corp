
<div class="modal " id="disengage_company">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center" id="notes_modals_title">Disengage</h3>
            </div>
            <div class="modal-body">
              <form class="form-inline" action="{{route('disengage_company')}}" method="POST" id="" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{$id}}" name="id">
                  <div class="row">
                    <div class="col-12">
                        <label for="personal_name" class="">Disengagement Date</label>
                        <input type="date" class="form-control mb-2 " value="{{$company->engagement_end_date? substr($company->engagement_end_date,0,10): date("Y-m-d")}}" name="disengagement_date" max="{{date("Y-m-d")}}" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <label for="personal_name" class="">Disengagement Reason</label>
                        <div class="mt-2">
                            <select class="select2 form-control" name="disengagement_reason">
                                @foreach($disengagement_reasons as $key => $disengagement_reason)
                                    <option value="{{$key}}" {{$company->disengagement_reason && $company->disengagement_reason == $key ? "selected" : "" }}>{{$disengagement_reason}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                        <label for="personal_name" class="">Comments</label>
                        <textarea class="form-control mb-2 " name="comment">{{$company->disengagement_comment}}</textarea>
                    </div>
                  </div>                  
                  <div class="modal-footer bg-light d-flex align-items-center justify-content-center" id="notes_modal_buttons_section">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
              </form>  
            </div>
        </div>
    </div>
  </div>