<div class="modal fade" id="create_following_company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="py-3"><h5 class="modal-title text-center" id="exampleModalLabel">Select a Contact to Link to Company</h5></div>

            <div class="modal-body">
                <form class="form-inline" action="{{route('following_company')}}" method="POST">
                    @csrf
                    <input type="hidden" name="company_id" id="" value="{{!empty($id) ? $id : ''}}">
                    <input type="hidden" name="page" id="" value="company_id">

                    <label for="" class="">Contacts</label>
                    <div>
                        <select class="select2  form-control" name="contact_id" id="countries" required>
                            @foreach($contacts_count as $contact)
                                <option value="{{$contact->id}}"  >{{$contact->last_name.', '.$contact->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">    
                        <a  class="btn btn-secondary cursor-pointer" data-dismiss="modal">NO</a>
                        <button type="submit" class="btn btn-danger " >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        
    $(document).ready(function() {

    });

</script>