<div class="row mt-4 px-5"  >
  <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#upcoming" style="">
      <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
      <b>Upcoming & Overdue</b>
   </div>
  <div id="upcoming" class="show collapse">
      <div class="row px-2 py-2 upov_max_height">
        @if(!empty($upcoming_overdues))
          @foreach($upcoming_overdues as $key => $upcoming_overdue)
            <div class="col-12 <?= $key > 2 ? 'hidden-event' : ''?>">
              @if($upcoming_overdue['notification'] == 'event')
                @php $event = $upcoming_overdue;  @endphp
                <div class="row mb-2 mt-2">
                  <div class="col-12">
                      <div class="row text-info">
                        <div class="col-1">
                          <div  class=" bg_c_event df_jsc_amc notification_icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m76 42h-52c-1.1 0-2 0.9-2 2v30c0 3.3 2.7 6 6 6h44c3.3 0 6-2.7 6-6v-30c0-1.1-0.9-2-2-2z m-36 28c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m4-30h-5v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-18v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-5c-3.3 0-6 2.7-6 6v2c0 1.1 0.9 2 2 2h52c1.1 0 2-0.9 2-2v-2c0-3.3-2.7-6-6-6z"/></svg>
                          </div>
                        </div>
                        <div class="col-10">
                          <a href="{{ route('event', [$event['id'], $url]) }}">{{$event['subject'] }}</a>
                        </div>
                        <div class="col-1">
                          <div class="dropdown">
                            <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                            <div class="dropdown-menu" x-placement="top-left">
                              <a class="dropdown-item" href="#">
                                <button class="btn edit_event" data-toggle="modal" data-target="#edit_event_" data-event="{{ json_encode($event)}}">Edit</button>
                              </a>
                              <a class="dropdown-item bg-danger text-white data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal"  data-href="{{route('delete_event',[$event['id'], $url])}}"><button class="btn text-white"> Delete</button></a>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-{{empty($event->contacts) ? '11' : 4}}">{{$event['created_at']}}</div>
                    </div>
                  </div>
                </div>
              @endif
              @if($upcoming_overdue['notification'] == 'task')
                <div class="row mb-2 mt-2">
                  <div class="">
                    @php $task = (object)$upcoming_overdue; @endphp
                    <div class="row">
                      <div class="col-1 df_jssb_amc">
                        <div class="collaps_show " data-toggle="collapse" data-target="#task_description{{$task->id}}" >
                          <svg class="slds-icon slds-icon-text-default slds-icon_x-small slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        </div>
                        <div  class=" bg_c_quotes df_jsc_amc notification_icons">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m46.6 23.7l-2.1-2.1c-0.6-0.6-1.5-0.6-2.1 0l-13.2 13.2-5.3-5.3c-0.6-0.6-1.5-0.6-2.1 0l-2.1 2.1c-0.6 0.6-0.6 1.5 0 2.1l7.4 7.4c0.6 0.6 1.4 0.9 2.1 0.9 0.8 0 1.5-0.3 2.1-0.9l15.3-15.3c0.5-0.5 0.5-1.5 0-2.1z m30.4 14.3h-26c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h26c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m-44 0h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m44 0h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z"/></svg>    
                        </div>
                      </div>
                      <div class="col-10 text-info">
                        {{-- <a href="{{ route('task', [$task->id, $url]) }}">{{$subject_tasks[$task->subject] }}</a> --}}
                        <a href="{{ route('task', [$task->id, $url]) }}">{{$task->subject}}</a>
                        {{-- {{$subject_tasks[$task->subject] }} --}}
                      </div>
                      <div class="col-1">
                        <div class="dropdown">
                          <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu">
                            {{-- <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_task_{{$task->id}}">Edit</button> </a> --}}
                            <a class="dropdown-item" href="#"><button class="btn edit_task" data-toggle="modal" data-target="#edit_task_" data-task="{{ json_encode($task)}}">Edit</button></a>
                          
                            {{-- <a class="data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('delete_account', [$value->id]) }}"> --}}
                            <a class="dropdown-item bg-danger text-white data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal"  data-href="{{route('delete_task',[$task->id, $url])}}"><button class="btn text-white">Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    @if(!empty($task->contacts))
                        <div class="col-6 offset-1">You logged a task with <a href="{{ route('edit_contact', [$task->contact_id]) }}">{{$task->contacts['last_name']}} {{$task->contacts['first_name']}}</a> </div>
                    @endif
                    {{--<div class="col-6 offset-1">You logged a task with <a href="{{ route('edit_contact', [$task->contact_id]) }}">{{$task->contacts['title']}}</a></div>--}}
                    <div class="col-{{empty($task->contacts) ? '11' : 4}}">{{$task->created_at}}</div>
                  </div>
                  <div  id="task_description{{$task->id}}" class=" collapse">
                    <textarea name="" class="form-control mt-2" >{{$task->comments}}</textarea>
                  </div>
                </div>
              @endif
            </div>
          @endforeach
        @else
          <div class="border-bottom mt-2 pt-1 px-2 pb-3">
              <div class="text-center">No activities to show</div>
              <div class="text-center">Get started by sending an email, scheduling a task, and more</div>
          </div>
        @endif
      </div>
      <div class="row">
          <div class="df_jsc_amc">
              <button class="btn btn btn-outline-success upov_max_height_button">Show More</button>
          </div>
      </div>
  </div>
</div>

<div class="row px-5 log_call_size">
  @foreach($notifications as $key => $notification)
    @php $notification = (object)$notification;  @endphp
    <div class=" account_info_btn collaps_show mt-3 py-2 px-2" data-toggle="collapse" data-target="#task_{{$key}}" >
      @php $key_text = $varToReplace = str_replace('_', ', ', $key); @endphp
      <svg class="slds-icon slds-icon-text-default slds-icon_x-small slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
      <b>{{$key_text}}</b>
    </div>
    <div id="task_{{$key}}" class="collapse">
       <div class="row">
        <div class="col-12">
          @foreach($notification as $key => $value)
            @if($value['notification'] == 'call')
              <div class="row mt-2">
                <div class="col-12">
                    @php $log_call = (object)$value;  @endphp
                      <div class="row">
                      <div class="col-1">
                        <div  class=" bg_c_call df_jsc_amc notification_icons">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m69.7 20h-37.6c-3.3 0-6.1 3-6.1 6v2h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v10h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v10h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v2c0 3 2.8 6 6.1 6h37.6c3.3 0 6.3-3 6.3-6.3v-48c0-3.3-3-5.7-6.3-5.7z m-3.6 40.3l-2.8 2.8c-0.6 0.6-1.5 1-2.3 0.9-6.6-0.4-12.8-3.4-17.2-7.7-4.4-4.4-7.4-10.6-7.7-17.2 0-0.9 0.3-1.7 0.9-2.3l2.8-2.8c1.3-1.3 3.5-1.2 4.6 0.3l2.6 3.2c0.9 1.1 0.9 2.6 0.1 3.8l-2.2 3.1c-0.3 0.4-0.3 1 0.1 1.3l4.6 5.1 5.1 4.6c0.4 0.4 0.9 0.4 1.3 0.1l3.1-2.2c1.1-0.8 2.7-0.8 3.8 0.1l3.2 2.6c1.2 0.8 1.3 3 0 4.3z"/></svg>
                        </div>
                      </div>
                      <div class="col-10 text-info">
                          {{-- <a href="{{ route('log_call', [$log_call->id, $url]) }}">{{$subject_calls[$log_call->subject] }}</a> --}}
                          <a href="{{ route('log_call', [$log_call->id, $url]) }}">{{$log_call->subject}}</a>
                      </div>
                      <div class="col-1">
                        <div class="dropdown">
                          <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><button class="btn edit_call" data-toggle="modal" data-target="#edit_call_" data-call="{{ json_encode($log_call)}}">Edit</button></a>
                            {{-- <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_call_{{$log_call->id}}">Edit</button> </a> --}}
                            <a class="dropdown-item bg-danger text-white data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal"  data-href="{{route('delete_call',[$log_call->id,$url])}}"><button class="btn text-white">Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        @if(!empty($log_call->contacts))
                          <div class="col-6 offset-1">You logged a call with <a href="{{ route('edit_contact', [$log_call->contact_id]) }}">{{$log_call->contacts['last_name']}} {{$log_call->contacts['first_name']}} </a></div>
                        @endif
                        <div class="col-{{empty($log_call->contacts) ? '11' : 4}}">{{$log_call->created_at}}</div>
                    </div>
                </div>
              </div>
            @endif
            @if($value['notification'] == 'event')
              <div class="row mb-2 mt-2">
                <div class="col-12">
                    @php $event = (object)$value; @endphp
                    <div class="row text-info">
                      <div class="col-1">
                        <div  class=" bg_c_event df_jsc_amc notification_icons">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m76 42h-52c-1.1 0-2 0.9-2 2v30c0 3.3 2.7 6 6 6h44c3.3 0 6-2.7 6-6v-30c0-1.1-0.9-2-2-2z m-36 28c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m4-30h-5v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-18v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-5c-3.3 0-6 2.7-6 6v2c0 1.1 0.9 2 2 2h52c1.1 0 2-0.9 2-2v-2c0-3.3-2.7-6-6-6z"/></svg>
                        </div>
                      </div>
                      <div class="col-10">
                        {{-- <a href="{{ route('event', [$event->id, $url]) }}">{{$subject_events[$event->subject] }}</a> --}}
                        <a href="{{ route('event', [$event->id, $url]) }}">{{$event->subject }}</a>
                      </div>
                      <div class="col-1">
                        <div class="dropdown">
                          <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                          <div class="dropdown-menu">
                            {{-- <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_event_{{$event->id}}">Edit</button> </a> --}}
                            <a class="dropdown-item" href="#">
                              <button class="btn edit_event" data-toggle="modal" data-target="#edit_event_" data-event="{{ json_encode($event)}}">Edit</button>
                            </a>
                            <a class="dropdown-item bg-danger text-white data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal"  data-href="{{route('delete_event',[$event->id, $url])}}"><button class="btn text-white"> Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @if(!empty($event->contacts))
                          <div class="col-6 offset-1">You had an event with <a href="{{ route('edit_contact', [$event->contact_id]) }}">{{$event->contacts['last_name']}} {{$event->contacts['first_name']}}</a> </div>
                      @endif
                      <div class="col-{{empty($event->contacts) ? '11' : 4}}">{{$event->created_at}}</div>
                    </div>
                </div>
              </div>
            @endif
            @if($value['notification'] == 'task')
              <div class="row mb-2 mt-2">
                <div class="col-12">
                  @php $task = (object)$value; @endphp
                  <div class="row">
                    <div class="col-1 df_jssb_amc">
                      <div class="collaps_show " data-toggle="collapse" data-target="#task_description{{$task->id}}" >
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                      </div>
                      <div  class=" bg_c_quotes df_jsc_amc notification_icons">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m46.6 23.7l-2.1-2.1c-0.6-0.6-1.5-0.6-2.1 0l-13.2 13.2-5.3-5.3c-0.6-0.6-1.5-0.6-2.1 0l-2.1 2.1c-0.6 0.6-0.6 1.5 0 2.1l7.4 7.4c0.6 0.6 1.4 0.9 2.1 0.9 0.8 0 1.5-0.3 2.1-0.9l15.3-15.3c0.5-0.5 0.5-1.5 0-2.1z m30.4 14.3h-26c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h26c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m-44 0h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m44 0h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z"/></svg>    
                      </div>
                    </div>
                    <div class="col-10 text-info">
                      {{-- <a href="{{ route('task', [$task->id, $url]) }}">{{$subject_tasks[$task->subject] }}</a> --}}
                      <a href="{{ route('task', [$task->id, $url]) }}">{{$task->subject}}</a>
                    </div>
                    <div class="col-1">
                      <div class="dropdown">
                        <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                        <div class="dropdown-menu">
                          {{-- <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_task_{{$task->id}}">Edit</button> </a> --}}
                          <a class="dropdown-item" href="#"><button class="btn edit_task" data-toggle="modal" data-target="#edit_task_" data-task="{{ json_encode($task)}}">Edit</button></a>
                          <a class="dropdown-item bg-danger text-white data_delete_href_from cursor-pointer" data-toggle="modal" data-target="#exampleModal"  data-href="{{route('delete_task',[$task->id, $url])}}"><button class="btn text-white">Delete</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      @if(!empty($task->contacts))
                        <div class="col-6 offset-1">You logged a task with <a href="{{ route('edit_contact', [$task->contact_id]) }}">{{$task->contacts['last_name']}} {{$task->contacts['first_name']}}</a></div>
                      @endif
                      <div class="col-{{empty($event->contacts) ? '11' : 4}}">{{$task->created_at}}</div>
                  </div>
                  <div  id="task_description{{$task->id}}" class=" collapse">
                    <textarea name="" class="form-control mt-2" >{{$task->comments}}</textarea>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  @endforeach
</div>

@include('modals.edit_call')
@include('modals.edit_task')
@include('modals.edit_event')
@include('modals.delete_modal')
