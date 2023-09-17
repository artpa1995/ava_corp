<div class="modal " id="create_notes">

  <div class="modal-dialog mt-5 modal-lg">
      <div class="modal-content">
          <div class="">
              <div class="text-end pt-3 px-3">
                  <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
              </div>
              <h3 class="modal-title text-center" id="notes_modals_title">New Notes</h3>
          </div>
          <div class="modal-body">
            <form class="form-inline" action="{{route('add_notes')}}" method="POST" id="notes_form" enctype="multipart/form-data">
                @csrf
                <label for="" class="mr-sm-2">Title</label>
                <input type="text" name="title" class="form-control mb-2 mr-sm-2" id="notes_title" data-autofocus="autofocus" required>
                
                <textarea name="content" style="display:none" id="hiddenArea_notes"></textarea>

                <div id="editor-container"></div>
                <div class="row mt-2">
                    <div class="col-6">
                        <label for="" class="mr-sm-2">Note File</label>
                        <input type="file" name="note_file"   class="form-control mb-2 mr-sm-2 note_file_input" >
                    </div>
                    <div class="col-6 note_file_block d-none">
                        {{--<img src="{{ asset("storage/public/Files/$file_data->path") }}" width="40" height="40" alt="">--}}
                    </div>
                </div>
                <label for="" class="mr-sm-2">Related to {{$page_title}}</label>
                @php
                  $name = $url.'_id';
                @endphp
                <input type="text" class="d-none" value="{{$id}}" name="{{$name}}" >
                <div class="modal-footer bg-light d-flex align-items-center justify-content-center" id="notes_modal_buttons_section">
                    {{--<a class="btn btn-danger d-none" id="notes_delete_button" data-dismiss="">Delete</a>--}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
                </div>

            </form>  
          </div>
      </div>
  </div>
</div>


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>


var quill1 = new Quill('#editor-container', {
  modules: {
      // keyboard: {
      //     bindings: {
      //         tab: {
      //             key: 9,
      //             handler: function () {
      //                 let inputs = $(".ql-toolbar").closest('form').find(':input');
      //                 console.log(inputs);
      //                 inputs.eq(inputs.index(this) + 3).focus();
      //             }
      //         }
      //     }
      // },
    toolbar: [
          ['bold', 'italic', 'underline', 'strike'],
          [{ 'header': 1 }, { 'header': 2 }],
          ['blockquote', 'code-block'],
          [ 'link', 'image', 'formula' ],
          [{ 'list': 'ordered'}, { 'list': 'bullet' }],
          [{ 'script': 'sub'}, { 'script': 'super' }],
          [{ 'indent': '-1'}, { 'indent': '+1' }],
          [{ 'direction': 'rtl' }],
          [{ 'size': ['small', false, 'large', 'huge'] }],
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
          [{ 'color': [] }, { 'background': [] }],
          [{ 'font': [] }],
          [{ 'align': [] }],

          ['clean'] 
    ]
  },
  placeholder: 'Content ...',
  theme: 'snow'  // or 'bubble'
});

// quill1.keyboard.addBinding({ key: Keyboard.keys.BACKSPACE }, {
//     collapsed: true,
//     format: ['blockquote', 'list'],
//     offset: 0
// }, function(range, context) {
//     if (context.format.list) {
//         this.quill.format('list', false);
//     } else {
//         this.quill.format('blockquote', false);
//     }
// });

quill1.on('text-change', function(delta, source) {
	updateHtmlOutput()
})
$('#btn-convert').on('click', () => { updateHtmlOutput() })

function getQuillHtml() { return quill1.root.innerHTML; }

function updateHtmlOutput()
{
	let html = getQuillHtml();
    document.getElementById('hiddenArea_notes').innerText = html;
}

updateHtmlOutput()


$('.notes_title_content').on('click', function(){
        $('.note_file_block').empty();
        let origin = window.location.origin;
        let title = $(this).data('name');
        let content = $(this).parent().find('.notes_content').val();
        let action = $(this).parent().find('.notes_action').val();
        // let href = $(this).parent().find('.notes_delete_hreff').val();
        let file = $(this).data('file');
        if(file){

          $('.note_file_block').removeClass('d-none')
          $('.note_file_block').append(`<img width="60px" heigth="60px" src="${origin}/storage/public/Files/${file}">`)
        }
    // note_file_block
        $('#notes_modals_title').html('Edit Notes');
        $('#notes_title').val(title);
        setTimeout(function (){
            $('#notes_title').focus();
        }, 200);
        quill1.root.innerHTML = content;
        let html = getQuillHtml();
        document.getElementById('hiddenArea_notes').innerText = html;
        $('#notes_form').attr('action', action);
        // $('#notes_delete_button').attr('href', href);
        // $('#notes_delete_button').removeClass('d-none')

        // $('#notes_modal_buttons_section').append('<button class="btn btn-danger" data-dismiss="modal">Delete</button>')

    })

    $('.note_file_input').on('change', function(){
      $('.note_file_block').empty();
    })

    $('.clear_notes_form').on('click', function(){
      $('.note_file_block').empty();
      // $('#notes_delete_button').addClass('d-none')
      $('#notes_modals_title').html('New Notes');
      $('#notes_title').val("");
      quill1.root.innerHTML = "";
      let html = getQuillHtml();
      document.getElementById('hiddenArea_notes').innerText = html;
      let origin = window.location.origin;
      $('#notes_form').attr('action', origin+'/add_notes');
      // $('.notes_delete_button').attr('href', "")
    })

</script>
