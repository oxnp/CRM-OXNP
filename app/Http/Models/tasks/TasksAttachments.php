<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class TasksAttachments extends Model
{
    protected $fillable =['task_id','type_file','storage','updated_at'];

    public static function getAttachmentsByTaskId($id){
        $attachments = TasksAttachments::where('task_id',$id)->get()->toArray();
        return $attachments;
    }
    public static function setAttachmentsByTaskId($id,$type_file,$storage){

        $task_attach = TasksAttachments::create([
            'task_id'=>$id,
            'type_file'=>$type_file,
            'storage'=>$storage,
        ]);

        if($task_attach){
            return $task_attach->toArray();
        }else{
            return false;
        }
    }
}
