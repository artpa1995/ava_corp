@extends('user.layout.app')
@section('title')Files @endsection
@section('contents')

    <div class="container-fluid  rounded-top bg-white pt-3 px-3">
        <div class="row">
            <div class="col-10">
                <a href="{{route('edit_'.$url, $id)}}">{{$page_title}}</a>
            </div>
            <div class="col-2 text-end">
                <button class="btn btn-light " data-toggle="modal" data-target="#create_files">New</button>
            </div>
        </div>
    </div>
    <div class="container-fluid  rounded-bottom bg-white py-3 px-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Owner</th>
                    <th>Last Modified</th>
                    <th>Size</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as  $file)
                @php $file_data = $file->file  @endphp
                <tr >
                    <td><a class="text-primary " href="{{ $file_data->path }}" download>{{$file_data->name??"Untitled Note"}}</a></td>
                    <td><a href="{{route('profile')}}">{{ Auth::user()->first_name }}</a></td>
                    <td>{{$file_data->updated_at}}</td>
                    <td>{{ $file_data->size.' b'?? '' }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <div class="tooltipblock">
                                <button class="copy_button">
                                    <span class="tooltiptext" id="myTooltip" class="myTooltip">Copy to clipboard</span>
                                    <svg style="fill: #6AB559" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 24 24" version="1.1">
                                        <title>ic_fluent_copy_link_24_filled</title>
                                        <desc>Created with Sketch.</desc>
                                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ic_fluent_copy_link_24_filled" fill="#212121" fill-rule="nonzero">
                                                <path d="M13.7533481,6.49330383 L10.2466519,6.49330383 C9.46988587,6.49330383 8.78519098,6.09910034 8.38170952,5.49983563 L6.25,5.5 C5.87030423,5.5 5.55650904,5.78215388 5.50684662,6.14822944 L5.5,6.25 L5.5,19.754591 C5.5,20.1342868 5.78215388,20.448082 6.14822944,20.4977444 L6.35177056,20.5114376 C6.71784612,20.5611 7,20.8748952 7,21.254591 C7,21.6688046 6.66421356,22.004591 6.25,22.004591 C5.05913601,22.004591 4.08435508,21.0794294 4.00519081,19.9086398 L4,19.754591 L4,6.25 C4,5.05913601 4.92516159,4.08435508 6.09595119,4.00519081 L6.25,4 L8.01344395,3.9994587 C8.13651196,2.8749731 9.08940148,2 10.2466519,2 L13.7533481,2 C14.9105985,2 15.863488,2.8749731 15.9865561,3.9994587 L17.75,4 C18.940864,4 19.9156449,4.92516159 19.9948092,6.09595119 L20,6.25 L20,11.75425 C20,12.1684635 19.6642136,12.50425 19.25,12.50425 C18.8703042,12.50425 18.556509,12.2220961 18.5068466,11.8560205 L18.5,11.75425 L18.5,6.25 C18.5,5.87030423 18.2178461,5.55650904 17.8517706,5.50684662 L17.75,5.5 L15.6182905,5.49983563 C15.214809,6.09910034 14.5301141,6.49330383 13.7533481,6.49330383 Z M16.9999998,13.9975257 L17.9999998,13.9975257 C20.209139,13.9975257 21.9999998,15.7883867 21.9999998,17.9975257 C21.9999998,20.1397211 20.3160315,21.8886046 18.2038265,21.9926208 L18.004591,21.9975151 L17.004591,22.0021276 C16.452312,22.0046417 16.0025461,21.5589866 15.9999891,21.0067076 C15.9976554,20.4938772 16.3817517,20.069438 16.87882,20.0093903 L16.995409,20.0021272 L17.9999998,19.9975257 C19.1045695,19.9975257 19.9999998,19.1020952 19.9999998,17.9975257 C19.9999998,16.9431639 19.1841222,16.0793606 18.1492621,16.0030114 L17.9999998,15.9975257 L16.9999998,15.9975257 C16.4477153,15.9975257 15.9999891,15.5498104 15.9999891,14.9975257 C15.9999891,14.4846898 16.3860402,14.0620185 16.8833787,14.0042534 L16.9999998,13.9975257 L17.9999998,13.9975257 L16.9999998,13.9975257 Z M12.5,14.0021167 L13.5,14.0021167 C14.0522847,14.0021167 14.5,14.4498319 14.5,15.0021167 C14.5,15.5149525 14.1139598,15.9376238 13.6166211,15.9953889 L13.5,16.0021167 L12.5,16.0021167 C11.3954305,16.0021167 10.5,16.8975472 10.5,18.0021167 C10.5,19.0564785 11.3158778,19.9202818 12.3507377,19.9966309 L12.5,20.0021167 L13.5,20.0021167 C14.0522847,20.0021167 14.5,20.4498319 14.5,21.0021167 C14.5,21.5149525 14.1139598,21.9376238 13.6166211,21.9953889 L13.5,22.0021167 L12.5,22.0021167 C10.290861,22.0021167 8.5,20.2112557 8.5,18.0021167 C8.5,15.8599213 10.1839685,14.1110378 12.3003597,14.007012 L12.5,14.0021167 L13.5,14.0021167 L12.5,14.0021167 Z M12.4985614,16.9998212 L18,16.9998212 C18.5522847,16.9998212 19,17.4475364 19,17.9998212 C19,18.512657 18.6139598,18.9353283 18.1166211,18.9930934 L18,18.9998212 L12.4985614,18.9998212 C11.9462767,18.9998212 11.4985614,18.5521059 11.4985614,17.9998212 C11.4985614,17.4869853 11.8846016,17.064314 12.3819403,17.0065489 L12.4985614,16.9998212 L18,16.9998212 L12.4985614,16.9998212 Z M13.7533481,3.5 L10.2466519,3.5 C9.83428745,3.5 9.5,3.83428745 9.5,4.24665191 C9.5,4.65901638 9.83428745,4.99330383 10.2466519,4.99330383 L13.7533481,4.99330383 C14.1657126,4.99330383 14.5,4.65901638 14.5,4.24665191 C14.5,3.83428745 14.1657126,3.5 13.7533481,3.5 Z" id="🎨-Color">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                                <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_data->path") }}">
                            </div>
                            <a class="" href="{{ $file_data->path }}" download>
                                <svg style="fill: #6AB559" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
                                    <path d="M12.5 4V17M12.5 17L7 12.2105M12.5 17L18 12.2105" stroke="#6AB559" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 21H19" stroke="#6AB559" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_files', [$file->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('modals.delete_modal')
    @include('modals.files')
@endsection