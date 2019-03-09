<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailers\AppMailer;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller {
    public function postComment(Request $request, AppMailer $mailer) {
        //validate the request
        $this->validate($request, [
            'comment'   => 'required'
        ]);

        //create a comment object

            $comment = Comment::create([
                'ticket_id' => $request->input('ticket_id'),
                'user_id'    => Auth::user()->id,
                'comment'    => $request->input('comment'),
            ]);

            // // send mail if the user commenting is not the ticket owner
            // if ($comment->ticket->user->id !== Auth::user()->id) {
            //     $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
            // }

            return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
