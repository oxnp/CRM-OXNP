<?php

namespace App\Http\Models\bugs;

use Illuminate\Database\Eloquent\Model;

class BugsAttachments extends Model
{
    protected $fillable =['bug_id','type_file','storage','updated_at'];
    /*get attachments files for bug by ID
    * @param  int $id
    * @return array
    */
    public static function getAttachmentsByBugId($id):array{
        $attachments = BugsAttachments::where('bug_id',$id)->get()->toArray();
        return $attachments;
    }
    /*set attachments files for bug by ID
    * @param  int $id, string $type file, string $storage
    * @return array or false
    */
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
