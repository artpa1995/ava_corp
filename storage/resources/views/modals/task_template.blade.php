<div class="modal " id="creat_new_task_template">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Create Task Template</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('create_task_template')}}" method="POST">
                    @csrf
            
                    <div class="">
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Name</label>
                               <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Task Duration</label>
                                <div>
                                    <select name="count" class="custom-select select2">
                                        @for($i = 1; $i<=10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2"></label>
                                <div>
                                    <select name="period" class="custom-select select2">
                                        @foreach($periods as $key => $period)
                                            <option value="{{$period}}">{{$period}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Assigned to</label>
                                <div>
                                    <select  class="custom-select select2" name="user_id" >
                                        @foreach($users as  $user)
                                            <option value="{{$user['id']}}" >{{$user['last_name']}} {{$user['first_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Description</label>
                                <textarea name="description" id="" cols="20" rows="5" class="form-control"></textarea>
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

<div class="modal " id="edit_task_template">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Task Template</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task_template')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" class="task_template_id">
                    <div class="">
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Name</label>
                               <input type="text" class="form-control task_template_name" name="name">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Task Duration</label>
                                <div>
                                    <select name="count" class="custom-select select2 task_template_count">
                                        @for($i = 1; $i<=10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2"></label>
                                <div>
                                    <select name="period" class="custom-select select2 task_template_period">
                                        @foreach($periods as $key => $period)
                                            <option value="{{$period}}">{{$period}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Assigned to</label>
                                <div>
                                    <select  class="custom-select select2 task_template_user_id" name="user_id" >
                                        @foreach($users as  $user)
                                            <option value="{{$user['id']}}" >{{$user['last_name']}} {{$user['first_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Description</label>
                                <textarea  id="" cols="20" rows="5" class="form-control task_template_description" disabled></textarea>
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

@section('js')
<script>
    $(document).ready(function(){
        $(document).on('click', '.edit_task_template', function(){
            let data = $(this).data('all');
            console.log(data);

            let task_template_id = $('.task_template_id');
            let task_template_name = $('.task_template_name');
            let task_template_count = $('.task_template_count');
            let task_template_period = $('.task_template_period');
            let task_template_user_id = $('.task_template_user_id');
            let task_template_description = $('.task_template_description');

            task_template_id.val('');
            task_template_name.val('');
            task_template_description.val('');
            task_template_period.val(1).trigger('change.select2');
            task_template_user_id.val(1).trigger('change.select2');
            task_template_count.val(1).trigger('change.select2');

            if(data.id){
                task_template_id.val(data.id);
            }
            if(data.name){
                task_template_name.val(data.name);
            }
            if(data.description){
                task_template_description.val(data.description);
            }
            if(data.user){
                task_template_user_id.val(data.user.id).trigger('change.select2');
            }
            if(data.period){
                task_template_period.val(data.period).trigger('change.select2');
            }
            if(data.count){
                task_template_count.val(data.count).trigger('change.select2');
            }

        })
      
    })
</script>
@endsection