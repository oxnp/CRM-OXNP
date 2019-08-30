<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class TasksAttachments extends Model
{
    protected $fillable =['task_id','type_file','storage','updated_at'];
    /*get attachments by task ID*/
    public static function getAttachmentsByTaskId($id):array{
        $attachments = TasksAttachments::where('task_id',$id)->get()->toArray();
        return $attachments;
    }
    /*set attachments by task ID*/
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
