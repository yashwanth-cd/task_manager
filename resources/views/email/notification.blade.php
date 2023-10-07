Dear {{$data->task_owner}}, <br> <br>
Task Status: {{ $data->task_status }}

The Task {{$data->task_description}}, <br><br> {{$data->task_status == 0 ? 'has been added to Task Manager' : 'has been marked as complete' }} <br><br>

@if($data->task_status == 0)
Kindly Complete within {{$data->task_eta}}, <br><br>
@endif

Thank You!!