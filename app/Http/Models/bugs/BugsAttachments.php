<?php

namespace App\Http\Models\bugs;

use Illuminate\Database\Eloquent\Model;

class BugsAttachments extends Model
{
    protected $fillable =['bug_id','type_file','storage','updated_at'];
    public static function getAttachmentsByBugId($id){
        $attachments = BugsAttachments::where('bug_id',$id)->get()->toArray();
        return $attachments;
    }

    public static function setAttachmentsByBugId($id,$type_file,$storage){
        $bug_attach = BugsAttachments::create([
            'bug_id'=>$id,
            'type_file'=>$type_file,
            'storage'=>$storage,
        ]);
        if($bug_attach){
            return $bug_attach->toArray();
        }else{
            return false;
        }
    }
}
