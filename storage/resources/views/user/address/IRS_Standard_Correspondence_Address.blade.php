@extends('user.layout.app')
@section('title')IRS Standard Correspondence Address @endsection
@section('contents')


    <div class="container mt-5 rounded bg-white py-3 px-3">
        <div class="">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center" id="notes_modals_title">IRS Standard Correspondence Address</h3>
            </div>
            <div class="y">
              <form class="form-inline" action="{{route('user_update_options')}}" method="POST" id="notes_form" enctype="multipart/form-data">
                  @csrf
                  <div class="row mt-2">
                      <div class="col-6">
                          <label for="" class="">Address 1</label>
                          <input type="text" name="address_1" value="{{$options['address_1']}}"  class="form-control" >
                      </div>
                      <div class="col-6">
                        <label for="" class="">Address 2</label>
                        <input type="text" name="address_2" value="{{$options['address_2']}}"  class="form-control" >
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-6">
                        <label for="" class="">City</label>
                        <input type="text" name="city"  value="{{$options['city']}}" class="form-control"  >
                    </div>
                    <div class="col-6">
                      <label for="" class="">ZIP</label>
                      <input type="text" name="zip"  value="{{$options['zip']}}" class="form-control" >
                  </div>
                </div>
                <div class="row mt-2 mb-3">
                    <div class="col-6">
                        <label for="" class="">State</label>

                        <div>
                            <select  class="select2 custom-select form-control" name="state">
                                <option value=""></option>
                                @foreach($stateis as $state)
                                    <option value="{{$state->name}}" {{$state->name == $options['state'] ? 'selected' : ""}}>
                                        {{$state->name??""}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <textarea name="" class="form-control">{{$options['state']}}</textarea> --}}
                    </div>
                </div>

                  <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
  
              </form>  
            </div>
        </div>
    </div>


    @section('js')
        <script>
        
        </script>
    @endsection

@endsection