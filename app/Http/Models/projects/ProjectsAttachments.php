<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsAttachments extends Model
{
    public static function getAttachmentsByProjectId($id){
       $attachments = ProjectsAttachments::where('project_id',$id)->get()->toArray();
        return $attachments;
    }
}
