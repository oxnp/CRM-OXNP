<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsAttachments extends Model
{
    protected $fillable = ['project_id','type_file','storage','updated_at'];

    /*get attachments by project ID
    * @param int $id
    * @return array
    */
    public static function getAttachmentsByProjectId($id):array{
       $attachments = ProjectsAttachments::where('project_id',$id)->get()->toArray();
        return $attachments;
    }
    /*set attachments by project ID
    * @param int $id,string $type_file, string $storage
    * @return array or false
    */
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
