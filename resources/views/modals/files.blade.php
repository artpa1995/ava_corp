<div class="modal " id="create_files">
  <div class="modal-dialog mt-5 modal-xl">
      <div class="modal-content">
          <div class="">
              <div class="text-end pt-3 px-3">
                <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
              </div>
              <h3 class="modal-title text-center" id="">New File</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-5 border-right" >
                <form class="form-inline" action="{{route('add_files')}}" method="POST" id="" enctype="multipart/form-data">
                  @csrf
                  <label for="" class="mr-sm-2">File</label>
                  @php $name = $url.'_id';@endphp
                  <input type="text" class="d-none" value="{{$id}}" name="{{$name}}" >
                  <div class=" d-flex align-items-center justify-content-center" id="">
                    <input type="file" name="file" class="form-control  mr-sm-2" id="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>  
              </div>
              <div class="col-7">
                <div class="row">
                  <div class=" d-flex align-items-center justify-content-center mb-3" id="">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="search_icon_label" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><path d="M46.599 40.236L36.054 29.691C37.89 26.718 39 23.25 39 19.5 39 8.73 30.27 0 19.5 0S0 8.73 0 19.5 8.73 39 19.5 39c3.75 0 7.218-1.11 10.188-2.943l10.548 10.545a4.501 4.501 0 0 0 6.363-6.366zM19.5 33C12.045 33 6 26.955 6 19.5S12.045 6 19.5 6 33 12.045 33 19.5 26.955 33 19.5 33z"/></svg>
                        </span>
                      </div>
                      <input type="text" class="form-control" placeholder="Search" id="files_search">
                      <input type="hidden" value="{{$url.'_id'}}" id="url">
                      <input type="hidden" value="{{$id}}" id="id">
                    </div>
                  </div>
                </div>
                <form class="form-inline" action="{{route('edit_files')}}" method="POST" id="" enctype="multipart/form-data">
                  @csrf
                  <div class="file_form_data">
                    @foreach($files_data as $file_)
                      @php $file_data = $file_->file @endphp
                      <div class="row">
                        <div class="col-4 ">
                          <div class="row">
                            <div class="col-3"> <input type="checkbox" class="" value="{{$file_data->id}}" name="file[]" ></div>
                            <div class="col-9">
                              @if(strtok($file_data->type, '/') == 'image')
                                <a  data-toggle="modal" data-target="#files_show" class="show_img_full">
                                  <img src="{{ asset("storage/public/Files/$file_data->path") }}" width="40" height="40" alt="" data-path="{{ asset("storage/public/Files/$file_data->path") }}">
                                </a>
                              @else
                                <a href="{{ asset("storage/public/Files/$file_data->path") }}"  download>
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="#7F8DE1" width="40" height="40" viewBox="0 0 22 22" id="memory-file"><path d="M13 1V2H14V3H15V4H16V5H17V6H18V7H19V20H18V21H4V20H3V2H4V1H13M13 4H12V8H16V7H15V6H14V5H13V4M5 3V19H17V10H11V9H10V3H5Z"/></svg>
                                </a>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="row"><p class="text-primary">{{$file_data->name}}</p></div>
                          <div class="row">
                            <div class="col-4">{{$file_data->created_at}}</div>
                            <div class="col-4">{{$file_data->size}}/b</div>
                            <div class="col-4">{{$file_data->type ? substr($file_data->type, ($a = strrpos($file_data->type, '/') +1)) : ""}}</div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="file_form_data_search"></div>
                    @php $name = $url.'_id'; @endphp
                    <input type="text" class="d-none" value="{{$id}}" name="{{$name}}" >
                    <div class="modal-footer  d-flex align-items-center justify-content-center" id="">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>  
              </div>
            </div>
            <div class="modal-footer bg-light d-flex align-items-center justify-content-center" id="">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button class="btn btn-outline-primary " data-toggle="modal" data-target="#files_show">New</button>
            </div>
          </div>
      </div>
  </div>
</div>

<div class="modal " id="files_show">
  <div class="modal-dialog mt-5 modal-xl">
    <div class="modal-content files_modal-content py-3" >
      <div class="d-flex justify-content-end px-2">
        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
      </div>
      <div class="file_download_href">
        <a href="" download>Download</a>
      </div>
      <img src="" alt="" >
  </div>
</div>

<script>
    $(document).ready(function(){

      $('.show_img_full').on('click', function(){
        let src = $(this).find('img').attr('src');
        $('.files_modal-content').find('img').attr('src', src);
        $('.file_download_href').find('a').attr('href', src);
      })

      $('#files_search').keyup(function(){
        let value = $(this).val();
        let id = $(this).parent().find('#id').val();
        let url = $(this).parent().find('#url').val();
        var origin = window.location.origin; 

        $.ajax({
            url:'/search_file',
            type:"post",
            datatType : 'json',
            data: {"id" : id, 'url': url, 'value' : value, "_token": "{{ csrf_token() }}"},
          
          success: function(response){
            $('.file_form_data').empty();
            for (let res in response) {
              let id = response[res].id;
              let type = response[res].file.type.split('/')[1];
              let file_type  = response[res].file.type.split('/')[0];
              let file = '';
              if(file_type == 'image'){
                file = '<img src="'+origin+'/storage/public/Files/'+response[res].file.path+'" width="40" height="40" alt="">'
              }else{
                file = '<svg xmlns="http://www.w3.org/2000/svg" fill="#7F8DE1" width="40" height="40" viewBox="0 0 22 22" id="memory-file"><path d="M13 1V2H14V3H15V4H16V5H17V6H18V7H19V20H18V21H4V20H3V2H4V1H13M13 4H12V8H16V7H15V6H14V5H13V4M5 3V19H17V10H11V9H10V3H5Z"/></svg>'
              }
              let size = response[res].file.size;
              let name = response[res].file.name;
              let time = response[res].file.created_at;
              $('.file_form_data').append('<div class="row"><div class="col-4 "><div class="row"><div class="col-3"> <input type="checkbox" class="" value="'+id+'" name="file[]"></div><div class="col-9">'+file+'</div></div></div><div class="col-8"><div class="row"><p class="text-primary">'+name+'</p></div><div class="row"><div class="col-4">'+time+'</div><div class="col-4">'+size+'/b</div><div class="col-4">'+type+'</div></div></div></div>')
            }
          },
        })
      })
    })
</script>