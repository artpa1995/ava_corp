@extends('user.layout.app')
@section('title')Addresse Providers @endsection
@section('contents')

<div class="container-fluid  rounded   px-3">
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2 text-end">
            <button class="btn btn-light " id="" data-toggle="modal" data-target="#create_address_roviders">New</button>
        </div>
    </div>
</div>
<div class="container mt-5 ">
    <div class="row">
        <div class="col-6 offset-3 rounded bg-white py-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($address_providers as  $value)
                    <tr >
                        <td><a >{{$value->title}}</a></td>
                        <td class="text-end">
                            <a class="edit_address_rovider"  data-toggle="modal" data-target="#edit_address_rovider" data-provider="{{$value}}">
                                <svg class="slds-edit__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg> 
                            </a>
                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_address_provider', [$value->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal " id="create_address_roviders">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Address Provider</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_address_providers')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <label  class="mr-sm-2">Title</label>
                            <input type="text" name="title" class="form-control  mr-sm-2" id="" required>
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

<div class="modal " id="edit_address_rovider">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">Edit Address Provider</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('update_address_provider')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" class="provider_id">
                    <div class="">
                        <div class="row">
                            <label  class="mr-sm-2">Title</label>
                            <input type="text" name="title" class="form-control  mr-sm-2 title" id="" required>
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

  <!-- Modal -->
  @include('modals.delete_modal')

@section('js')
    <script>
        $(document).ready(function(){
            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })

            $('.edit_address_rovider').on('click', function(){
                let data = $(this).data('provider');
                $('.provider_id').val(data.id);
                $('.title').val(data.title);
            })
        })

    </script>
@endsection

@endsection