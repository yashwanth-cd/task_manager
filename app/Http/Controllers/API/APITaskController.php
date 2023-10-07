<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\TaskManager;
use Illuminate\Http\Request;

class APITaskController extends Controller
{
    public function create(Request $request) {
        $data = new TaskManager();
        $data->task_description = $request->get('task_description');
        $data->task_owner = $request->get('task_owner');
        $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        if($data->save()) {
            dispatch(new SendEmailJob($data));
            return "Data saved successfully";
        } else {
            return "Something went wrong";
        }
    }
  
    public function index() {
        $data = TaskManager::get();
        return $data;
    }
  
    public function getTaskById($id) {
        $data = TaskManager::find($id);
        return $data;
    }

    public function update(Request $request, $id) {
        $data = TaskManager::find($id);
        $data->task_description = $request->get('task_description');
        $data->task_owner = $request->get('task_owner');
        $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        if($data->save()) {
            return "Data Updated successfully";
        } else {
            return "Something went wrong";
        }
    }

    public function markAsDone($id) {
        $data = TaskManager::find($id);
        $data->status = 1;
        $data->save();
        if($data->save()) {
            dispatch(new SendEmailJob($data));
            return "Record marked as Done successfully";
        } else {
            return "Something went wrong";
        }
    }

    public function delete($id) {
        $data = TaskManager::find($id);
        if($data->delete()) {
            return "Task Deleted successfully";
        } else {
            return "Something went wrong";
        }

    }
}
  

