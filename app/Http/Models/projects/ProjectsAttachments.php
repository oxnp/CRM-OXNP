<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsAttachments extends Model
{
    protected $fillable =['project_id','type_file','storage','updated_at'];
    public static function getAttachmentsByProjectId($id){
       $attachments = ProjectsAttachments::where('project_id',$id)->get()->toArray();
        return $attachments;
    }
    public static function setAttachmentsByProjectId($id,$type_file,$storage){
        $project_attach = ProjectsAttachments::create([
            'project_id'=>$id,
            'type_file'=>$type_file,
            'storage'=>$storage,
        ]);
        if($project_attach){
            return $project_attach->toArray();
        }else{
            return false;
        }
    }
}
