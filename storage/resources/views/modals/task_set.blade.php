

<div class="modal " id="creat_new_task_set">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Create Task Set</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('create_task_set')}}" method="POST">
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
                                <a class="btn btn-primary select_task_template"  data-toggle="modal" data-target="#select_task_template" >Add Block</a>
                            </div>
                        </div>
                        <div class="sortable_section_block">
                              <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Duration</th>
                                        <th>Assigned to</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable-section">
                                </tbody>
                              </table>
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


<div class="modal " id="edit_task_set">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Task Set</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task_set')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" class="task_set_id">
                    <input type="hidden" name="page_id" class="task_set_page_id">
                    <div class="">
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Name</label>
                               <input type="text" class="form-control edit_task_set_name" name="name">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <a class="btn btn-primary select_task_template_edit"  data-toggle="modal" data-target="#select_task_template" >Add Block</a>
                            </div>
                        </div>
                        <div class="sortable_section_block">
                              <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Duration</th>
                                        <th>Assigned to</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable-section_edit">

                                </tbody>
                              </table>
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

<div class="modal " id="add_task_set_company">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Add Task Set</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_task_set_company')}}" method="POST">
                    @csrf
                    {{-- <input type="hidden" name="id" class="task_set_id"> --}}
                    <input type="hidden" name="page_id" value="{{!empty($id)? $id : ''}}">
                    <div class="">
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Name</label>
                               <input type="text" class="form-control add_task_set_name" name="name">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <a class="btn btn-primary select_task_template_add"  data-toggle="modal" data-target="#select_task_template" >Add Block</a>
                            </div>
                        </div>
                        <div class="sortable_section_block">
                              <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Duration</th>
                                        <th>Assigned to</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable-section_add">

                                </tbody>
                              </table>
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


<div class="modal " id="select_task_template">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Select Task Template</h3>
            </div>
            <div class="modal-body">
                
                <div class="">
                    <div class="row mt-2">
                        <div class="col-12">
                            <label  class="mr-sm-2">Task Templates</label>
                            <div>
                                <select  class="custom-select select2 task_template_data_all" name="" >
                                    @foreach($task_templates as  $task_template)
                                        <option value="{{$task_template['id']}}" data-template="{{ json_encode($task_template) }}">{{$task_template['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary selected_task_template">Ok</button>
                        <button type="button" class="btn btn-danger select_task_template_close" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal " id="select_task_set">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Select Task Set</h3>
            </div>
            <div class="modal-body">
                
                <div class="">
                    <div class="row mt-2">
                        <div class="col-12">
                            <label  class="mr-sm-2">Task Sets</label>
                            <div>
                                <select  class="custom-select select2 task_set_data_all" name="" >
                                    @foreach($task_sets as  $task_set)
                                        <option value="{{$task_set['id']}}" data-set="{{ json_encode($task_set) }}">{{$task_set['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary selected_task_set" data-toggle="modal" data-target="#add_task_set_company">Ok</button>
                        <button type="button" class="btn btn-danger select_task_set_close" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

@section('js')
<script>
    $(document).ready(function(){
        var periods = <?php echo json_encode($periods); ?>;
        var users = <?php echo json_encode($users); ?>;
        let action = 1;
        $('.select_task_template').click(function(e){
            e.preventDefault();
            action = 1;
        })
        $('.select_task_template_edit').click(function(e){
            e.preventDefault();
            action = 2;
        })
        $('.select_task_template_add').click(function(e){
            e.preventDefault();
            action = 3;
        })
       
        $('.selected_task_template').click(function(){     
            let task_template_data_all = $('.task_template_data_all').find(':selected').data('template');
            // console.log(action);
            addBlock(task_template_data_all, action);
            $('#select_task_template').find('.select_task_template_close').trigger('click');
        })

        var count = 0;
        function addBlock(data, action) {
            count++;

            var newBlockId = 'block' + ($('.sortable-block').length + 1);
            var newBlockContent = "";
            var newBlock = $('<tr>', { class: 'sortable-block', id: newBlockId, text: newBlockContent });
            var TaskName = $('<td>', {
                class: '',
            })

            var TaskNameinput = $('<input>', {
                class: 'TaskName form-control',
                value: data.name,
                name: `data[${count}][name]`
            })

            TaskName.append(TaskNameinput);
            newBlock.append(TaskName);

            var Duration = '<td><div class="df_jssb_amc">';
            Duration += `<div><select class="select2 custom-select form-control task_set_count" name="data[${count}][count]">`;

            for(let i = 1; i<=10; i++){
                if(data.count && i == data.count){
                    Duration += `<option value="${i}" selected>${i}</option>`;
                }else{
                    Duration += `<option value="${i}" >${i}</option>`;
                }
            }
            Duration += `</select></div>`;
            Duration += `<div><select class="select2 custom-select form-control task_set_period" name="data[${count}][period]">`;
            for(let period of periods){
                if(data.period && period == data.period){
                    Duration += `<option value="${period}" selected>${period}</option>`;
                }else{
                    Duration += `<option value="${period}" >${period}</option>`;
                }
            }
            Duration += `</select></div>`;
            Duration += `</div></td>`;
            newBlock.append(Duration);


            var Assigned_to = `<td><div><select class="select2 custom-select form-control task_set_user_id" name="data[${count}][user_id]">`;
            for(let user of users){
                if(data.user && user.id == data.user.id){
                    Assigned_to += `<option value="${user.id}" selected>${user.last_name??""} ${user.first_name??""}</option>`;
                }else{
                    Assigned_to += `<option value="${user.id}" >${user.last_name??''} ${user.first_name??''}</option>`;
                }
            }
            Assigned_to += `</select></div></td>`;
            newBlock.append(Assigned_to);
            let description = '';
            if(data.description){
                description = data.description
            }

            Description = `<td><textarea class="form-control task_set_description" name="data[${count}][description]">${description}</textarea> </td>`;
            newBlock.append(Description);

            var $deleteButton = $('<a> ', {
                class: 'delete-block-btn btn btn-danger',
                text: ' Delete'
                }).on('click', function() {
                $(this).parents('.sortable-block').remove();
            });

            let last_section = $('<td>', { class: '', })

            last_section.append($deleteButton);
            newBlock.append(last_section);

            if(action == 1){
                $('#sortable-section').append(newBlock);
            }else if(action == 2){
                $('#sortable-section_edit').append(newBlock);
            }else if(action == 3){
                $('#sortable-section_add').append(newBlock);
            }
        }

        $('#sortable-section').sortable({
            update: function(event, ui) {
                updateBlockIndexes(1);
            }
        });
        
        $('#sortable-section').disableSelection();

        $('#sortable-section_edit').sortable({
            update: function(event, ui) {
                updateBlockIndexes(2);
            } 
        });

        $('#sortable-section_add').sortable({
            update: function(event, ui) {
                updateBlockIndexes(3);
            } 
        });

        function updateBlockIndexes(action) {
            if(action == 1){
                $('#sortable-section .sortable-block').each(function(index) {
                    $(this).attr('id', 'block' + (index + 1));
                    $(this).find('.TaskName').attr('name', `data[`+(index + 1)+ `][name]`);
                    $(this).find('.task_set_count').attr('name', `data[`+(index + 1)+ `][count]`);
                    $(this).find('.task_set_period').attr('name', `data[`+(index + 1)+ `][period]`);
                    $(this).find('.task_set_user_id').attr('name', `data[`+(index + 1)+ `][user_id]`);
                    $(this).find('.task_set_description').attr('name', `data[`+(index + 1)+ `][description]`);
                });
            }else if(action == 2){
                $('#sortable-section_edit .sortable-block').each(function(index) {
                    $(this).attr('id', 'block' + (index + 1));
                    $(this).find('.TaskName').attr('name', `data[`+(index + 1)+ `][name]`);
                    $(this).find('.task_set_count').attr('name', `data[`+(index + 1)+ `][count]`);
                    $(this).find('.task_set_period').attr('name', `data[`+(index + 1)+ `][period]`);
                    $(this).find('.task_set_user_id').attr('name', `data[`+(index + 1)+ `][user_id]`);
                    $(this).find('.task_set_description').attr('name', `data[`+(index + 1)+ `][description]`);
                });
            }else if(action == 3){
                $('#sortable-section_add .sortable-block').each(function(index) {
                    $(this).attr('id', 'block' + (index + 1));
                    $(this).find('.TaskName').attr('name', `data[`+(index + 1)+ `][name]`);
                    $(this).find('.task_set_count').attr('name', `data[`+(index + 1)+ `][count]`);
                    $(this).find('.task_set_period').attr('name', `data[`+(index + 1)+ `][period]`);
                    $(this).find('.task_set_user_id').attr('name', `data[`+(index + 1)+ `][user_id]`);
                    $(this).find('.task_set_description').attr('name', `data[`+(index + 1)+ `][description]`);
                });
            }
        }


        $('#sortable-section_edit').disableSelection();
        $('#sortable-section_add').disableSelection();

        function getBlockPositions() {
            var positions = [];

            $('#sortable-section .sortable-block').each(function() {
            var blockId = $(this).attr('id');
            var position = $(this).index();

            positions.push({
                blockId: blockId,
                position: position
            });
            });

            return positions;
        }

        $( document).on('mousedown', '.sortable-block', function() {
            var blockPositions = getBlockPositions();
            console.log(blockPositions);
        });

        // $('#sortable-section').on("sortchange", function(){
        //     var blockPositions = getBlockPositions();
        //     console.log(blockPositions);
        // })


        $(document).on('click','.delete-block-btn', function() {
            $(this).closest('.sortable-block').remove();
        });


        $(document).on('click','.edit_task_set', function(){
            let data = $(this).data('all');
            console.log(data);

            let task_set_id = $('.task_set_id');
            let edit_task_set_name = $('.edit_task_set_name');
            let task_set_page_id = $('.task_set_page_id')

            task_set_id.val('');
            edit_task_set_name.val('');
            task_set_page_id.val('');

            if(data.id){
                task_set_id.val(data.id);
            }
            if(data.name){
                edit_task_set_name.val(data.name);
            }
            if(data.company_id){
                task_set_page_id.val(data.company_id);
            }

            $('#sortable-section_edit').empty();

            if(data.task_relation){
                add_task_relations(data.task_relation, 1)
            }
        })

        $('.selected_task_set').click(function(){
            let data = $('.task_set_data_all').find(':selected').data('set');

            $(this).parents('#select_task_set').find('.select_task_set_close').trigger('click');

            let add_task_set_name = $('.add_task_set_name');
            add_task_set_name.val('');

            if(data.name){
                add_task_set_name.val(data.name);
            }
            $('#sortable-section_add').empty();
            if(data.task_relation){
                add_task_relations(data.task_relation, 2)
            }
           
        })

        function add_task_relations(task_relations, action){ 
            console.log(task_relations);
            for(let key  in  task_relations){
                let task_relation = task_relations[key];
                key = parseInt(key) +1;
                count ++;
                let tr = `<tr class="sortable-block" id="block${key}">
                            <td class="">
                                <input class="TaskName form-control"  name="data[${key}][name]" value="${task_relation.name}">
                            </td>`;
                tr +=       `<td>
                                <div class="df_jssb_amc">
                                    <div>
                                        <select class="select2 custom-select form-control task_set_count" name="data[${key}][count]">`
                                            for(let i = 1; i<=10; i++){
                                                if(task_relation.count && i == task_relation.count){
                                                    tr += `<option value="${i}" selected>${i}</option>`;
                                                }else{
                                                    tr += `<option value="${i}" >${i}</option>`;
                                                }
                                            }
                tr +=                   `</select>
                                    </div>`;

                tr +=               `<div>
                                        <select class="select2 custom-select form-control task_set_period" name="data[${key}][period]">`;
                                            for(let period of periods){
                                                if(task_relation.period && period == task_relation.period){
                                                    tr += `<option value="${period}" selected>${period}</option>`;
                                                }else{
                                                    tr += `<option value="${period}" >${period}</option>`;
                                                }
                                            }
                tr +=                   `</select>
                                    </div>`;
                tr +=`          </div>
                            </td>`;
                tr +=       `<td>
                                <div>
                                    <select class="select2 custom-select form-control task_set_user_id" name="data[${key}][user_id]">`;
                                        for(let user of users){
                                            if(task_relation.user && user.id == task_relation.user.id){
                                                tr += `<option value="${user.id}" selected>${user.last_name??""} ${user.first_name??""}</option>`;
                                            }else{
                                                tr += `<option value="${user.id}" >${user.last_name??''} ${user.first_name??''}</option>`;
                                            }
                                        }
                tr +=               `</select>
                                </div> 
                            </td>`;

                tr +=       `<td>
                                <textarea class="form-control task_set_description" name="data[${key}][description]">${task_relation.description??''}</textarea>
                            </td>
                            <td class=""><a class="delete-block-btn btn btn-danger"> Delete</a></td>`
                tr += `</tr>`;

                
                if(action == 1){
                    $('#sortable-section_edit').append(tr);
                }else if(action == 2){
                    $('#sortable-section_add').append(tr);
                }     
            }
        }
    })
</script>
@endsection