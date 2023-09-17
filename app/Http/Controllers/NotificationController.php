<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LogCall;
use App\Models\Task;
use App\Models\Event;
use Auth;

class NotificationController extends Controller
{
    public function notifications($page_id, $id){
        $log_calls = LogCall::/*where('user_id', '=', Auth::user()->id)->*/where($page_id, '=', $id)->with('contacts')->with('contacts')->with('user:id,first_name,last_name')->with('updateUser:id,first_name,last_name')->orderBy('created_at', 'DESC')->get()->toArray();
        $tasks = Task::/*where('user_id', '=', Auth::user()->id)->*/where($page_id, '=', $id)->with('contacts')->with('contacts')->with('user:id,first_name,last_name')->with('updateUser:id,first_name,last_name')->orderBy('created_at', 'DESC')->get()->toArray();
        $events = Event::/*where('user_id', '=', Auth::user()->id)->*/where($page_id, '=', $id)
        ->with('contacts')
        ->with('user:id,first_name,last_name')
        ->with('updateUser:id,first_name,last_name')
        ->orderBy('created_at', 'DESC')->get()->toArray();


        $notifications_array = [];
        $months = array(
            1 => 'January',
            2 => 'February', 
            3 => 'March', 
            4 => 'April', 
            5 => 'May', 
            6 => 'June', 
            7 => 'July', 
            8 => 'August', 
            9 => 'September', 
            10 => 'October', 
            11 => 'November', 
            12 => 'December'
        );
        if(!empty($log_calls)){
            foreach($log_calls as $log_call){

                $log_call['notification'] = 'call';
                $data = "";
                if(substr($log_call['created_at'],5,1) == 0){
                    $date = $months[substr($log_call['created_at'],6,1)].'_'.substr($log_call['created_at'],0,4);
                }else if(substr($log_call['created_at'],5,1) == 1){
                    $date = $months[substr($log_call['created_at'],5,2)].'_'.substr($log_call['created_at'],0,4);
                }
                
                $log_call['created_at'] = substr($log_call['created_at'],0,10);
                $log_call['updated_at'] = substr($log_call['updated_at'],0,10);
                
                if(!isset($notifications_array[$date])){
                    $notifications_array[$date][] = $log_call;
                }
                else{
                    $notifications_array[$date] = array_merge($notifications_array[$date], [$log_call]);
                }
            }
        }
        if(!empty($tasks)){
            foreach($tasks as $task){
                $task['notification'] = 'task';
                $task['created_at'] = substr($task['created_at'],0,10);
                $task['updated_at'] = substr($task['updated_at'],0,10);
                $data = "";

                if(substr($task['created_at'],5,1) == 0){
                    $date = $months[substr($task['created_at'],6,1)].'_'.substr($task['created_at'],0,4);
                }else if(substr($task['created_at'],5,1) == 1){
                    $date = $months[substr($task['created_at'],5,2)].'_'.substr($task['created_at'],0,4);
                }
                if(!isset($notifications_array[$date])){
                    $notifications_array[$date][] = $task;
                }
                else{
                    $notifications_array[$date] = array_merge($notifications_array[$date], [$task]);
                }
            }
        }
        if(!empty($events)){
            foreach($events as $event){
                
                $event['notification'] = 'event';
                $data = "";
               
                if(substr($event['created_at'],5,1) == 0){
                    $date = $months[substr($event['created_at'],6,1)].'_'.substr($event['created_at'],0,4);
                }else if(substr($event['created_at'],5,1) == 1){
                    $date = $months[substr($event['created_at'],5,2)].'_'.substr($event['created_at'],0,4);
                }
                $event['created_at'] = substr($event['created_at'],0,10);
                $event['updated_at'] = substr($event['updated_at'],0,10);
                if(!isset($notifications_array[$date])){
                    $notifications_array[$date][] = $event;
                }
                else{
                    $notifications_array[$date] = array_merge($notifications_array[$date], [$event]);
                }
            }
        }

        return  $notifications_array;
    }
    


    public function UpcomingOverdue($page_id, $id){

        $tasks = Task::limit(3)->/*where('user_id', '=', Auth::user()->id)->*/where('date', '=', null)->where($page_id, '=', $id)->with('contacts')->with('user:id,first_name,last_name')->with('updateUser:id,first_name,last_name')->orderBy('date', 'DESC')->get()->toArray();
        $events = Event::limit(3)->/*where('user_id', '=', Auth::user()->id)->*/where($page_id, '=', $id)->with('contacts')->with('user:id,first_name,last_name')->with('updateUser:id,first_name,last_name')->orderBy('date', 'DESC')->get()->toArray();

        $upcoming_overdue = [];

        if(!empty($tasks)){
            foreach($tasks as $task){
                $task['created_at'] = substr($task['created_at'],0,10);
                $task['updated_at'] = substr($task['updated_at'],0,10);
                $task['notification'] = 'task';
            array_push($upcoming_overdue, $task);
            }
        }

        if(!empty($events)){
            foreach($events as $event){

                $event['created_at'] = substr($event['created_at'],0,10);
                $event['updated_at'] = substr($event['updated_at'],0,10);
                
                $event['notification'] = 'event';
               array_push($upcoming_overdue, $event);
            }
        }

        usort($upcoming_overdue, function ($element1, $element2){
            $date1 = strtotime($element1['date']);
            $date2 = strtotime($element2['date']);
            return $date1 - $date2;
        });

        return $upcoming_overdue;

    }

    // public function return_log_calls(){
    //     $log_calls = LogCall::where('user_id', '=', Auth::user()->id)->get();
        
    //     $log_calls_array = [];
    //     foreach($log_calls as $log_call){
    //         $data = [
    //             'subject' => $log_call->subject,
    //             'id' => $log_call->id,
    //             'user_id' => $log_call->user_id,
    //             'contact_id' => $log_call->contact_id,
    //             'comments' => $log_call->comments,
    //             'related_to' => $log_call->related_to,
    //             'assigned_to' => $log_call->assigned_to,
    //             'priority' => $log_call->priority,
    //             'status' => $log_call->status,
    //             'reminder_set' => $log_call->reminder_set,
    //             'create_recurring_series_of_tasks' => $log_call->create_recurring_series_of_tasks,
    //             'date' =>  $log_call->date,
    //             'created_at' =>  $log_call->created_at,
    //             'updated_at' =>  $log_call->updated_at,
    //             'call_contact_id' =>  $log_call->contacts->id,
    //             'call_contact_title' =>  $log_call->contacts->title,
    //         ];

    //         if(!isset($log_calls_array[$log_call->created_at->format('Y-m')])){
    //             $log_calls_array[$log_call->created_at->format('Y-m')][] = $data;
    //         }
    //         else{
    //             $log_calls_array[$log_call->created_at->format('Y-m')] = array_merge($log_calls_array[$log_call->created_at->format('Y-m')], [$data]);
    //         }
        
    //     }
    //     return $log_calls_array;
    // }

    // public function return_tasks(){
    //     $tasks = Task::where('user_id', '=', Auth::user()->id)->get();
    //     $tasks_array = [];
    //     foreach($tasks as $task){
    //         $data = [
    //             'id' => $task->id,
    //             'user_id' => $task->user_id,
    //             'subject' => $task->subject,
    //             'contact_id' => $task->contact_id,
    //             'assigned_to' => $task->assigned_to,
    //             'related_to' => $task->related_to,
    //             'comments' => $task->comments,
    //             'priority' => $task->priority,
    //             'status' => $task->status,
    //             'reminder_set' => $task->reminder_set,
    //             'create_recurring_series_of_tasks' => $task->create_recurring_series_of_tasks,
    //             'date' =>  $task->date,
    //             'created_at' =>  $task->created_at,
    //             'updated_at' =>  $task->updated_at,
    //             'task_contact_id' =>  $task->contacts->id,
    //             'task_contact_title' =>  $task->contacts->title,
    //         ];

    //         if(!isset($tasks_array[$task->created_at->format('Y-m')])){
    //             $tasks_array[$task->created_at->format('Y-m')][] = $data;
    //         }
    //         else{
    //             $tasks_array[$task->created_at->format('Y-m')] = array_merge($tasks_array[$task->created_at->format('Y-m')], [$data]);
    //         }
    //     }
    //     return $tasks_array;
    // }

    // public function return_events(){
    //     $events = Event::where('user_id', '=', Auth::user()->id)->get();
    //     $events_array = [];
    //     foreach($events as $event){
    //         $data = [
    //             'id' => $event->id,
    //             'user_id' => $event->user_id,
    //             'subject' => $event->subject,
    //             'contact_id' => $event->contact_id,
    //             'assigned_to' => $event->assigned_to,
    //             'related_to' => $event->related_to,
    //             'description' => $event->description,
    //             'location' => $event->location,
    //             'full_day_event' => $event->full_day_event,
    //             'reminder_set' => $event->reminder_set,
    //             'type' => $event->type,
    //             'start_date' =>  $event->start_date,
    //             'start_time' =>  $event->start_time,
    //             'end_date' =>  $event->end_date,
    //             'end_time' =>  $event->end_time,
    //             'created_at' =>  $event->created_at,
    //             'updated_at' =>  $event->updated_at,
    //             'event_contact_id' =>  $event->contacts->id,
    //             'event_contact_title' =>  $event->contacts->title,
    //         ];

    //         if(!isset($events_array[$event->created_at->format('Y-m')])){
    //             $events_array[$event->created_at->format('Y-m')][] = $data;
    //         }
    //         else{
    //             $events_array[$event->created_at->format('Y-m')] = array_merge($events_array[$event->created_at->format('Y-m')], [$data]);
    //         }
    //     }
    //     return $events_array;

    // }
}
