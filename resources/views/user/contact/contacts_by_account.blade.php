@extends('user.layout.app')
@section('title')Companies @endsection
@section('contents')

    <div class="container-fluid rounded  px-3">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#create_contact">New</button>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 rounded bg-white py-3 px-3">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Account name</th>
                <th>Phone</th>
                <th>Email</th>
                {{-- <th>Contact Owner Alias</th> --}}
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($contacts as  $value)
                    <tr>
                        <td><a href="{{ route('edit_contact', [$value->id]) }}">{{$value->last_name.', '. $value->first_name}}</a></td>
                        <td>{{ $value->parentAccount->name ?? '' }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->email }}</td>
                        {{-- <td>{{ $value->ownerUser->first_name ?? '' }}</td> --}}
                        <td>
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Edit</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-primary" href="{{ route('edit_contact', [$value->id]) }}">Edit</a>
                                <a class="dropdown-item text-danger" href="{{ route('delete_contact', [$value->id]) }}">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('modals.contact')

    @section('js')
        <script>

            $(document).ready(function() {
                $('.select2').each(function(){
                    $(this).select2({
                        dropdownParent:  $(this).parent()
                    });
                })
            });

        </script>
    @endsection

@endsection