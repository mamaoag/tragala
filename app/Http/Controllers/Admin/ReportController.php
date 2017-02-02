<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ReportController extends Controller
{
    function __construct() {
        $this->middleware(['verify','admin'])->except(['send_report']);
    }

    public function reports()
    {
        return \App\Report::latest()->get();
    }

    public function no_action($id,Request $request)
    {
        $report = \App\Report::find($id);
        $report->status = 1;
        $report->save();

        \App\Audit::create([
                'admin_id' => Auth::user()->id,
                'action_code' => 31,
                'report_id' => $id
        ]);
        return 'ok';
    }

    public function infract_user($id,$rid,$pid)
    {
        $user = \App\User::find($id);

        if($user->warning >= 3){
            $reports = \App\Report::where('user_id',$id)->get();
            
            foreach($reports as $report)
            {
                $report->status = 3;
                $report->save();
            }

            $user->ban = 1;
            $user->save();
            return ['banned'];
        }

        $user->warning+=1;
        $repor = \App\Report::find($rid);
        $repor->status = 2;
        $repor->save();
        $user->save();
        
        $this->warnedPost($pid);

        \App\Audit::create([
                'admin_id' => Auth::user()->id,
                'action_code' => 32,
                'user_id' => $id,
                'report_id' => $rid
        ]);
        //\App\User::find($id)->notify(new \App\Notifications\Infraction(Auth::user()));
        return ['infracted'];
    }

    public function send_report($id, Request $request)
    {
        $post = \App\Post::find($id);

        return \App\Report::create([
            'post_id' => $id,
            'user_id' => $post->user_id,
            'type' => $request->type
        ]);


    }

    public function warnedPost($id)
    {
        $post = \App\Post::find($id);
        $post->description = 'This content has been removed';
        $post->filename = asset('/images/avatar.jpg');
        $post->save();

        return ['warned'];
    }
}
