<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller {
	public function send(Request $request) {
		$title = 'allo'; //$request->input('title');
		$content = 'alo'; // $request->input('content');
		//	$attach = $request->file('file');
		Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) {
			$message->from('shop@kreativnihobi.com', 'Christian Nwamba');
			$message->to('labud888@gmail.com');
			//$message->attach($attach);
			$message->subject("Hello from Scotch");
		});
		return response()->json(['message' => 'Request completed']);
	}

	public function notify(Request $request) {
		//List ID from .env
		$listId = env('MAILCHIMP_LIST_ID');
		//Mailchimp instantiation with Key
		$mailchimp = new \Mailchimp(env('MAILCHIMP_KEY'));
		//Create a Campaign $mailchimp->campaigns->create($type, $options, $content)
		$campaign = $mailchimp->campaigns->create('regular', [
			'list_id' => $listId,
			'subject' => 'New Article from Scotch',
			'from_email' => 'pub@gmail.com',
			'from_name' => 'Scotch Pub',
			'to_name' => 'Scotch Subscriber',
		], [
			'html' => $request->input('content'),
			'text' => strip_tags($request->input('content')),
		]);
		//Send campaign
		$mailchimp->campaigns->send($campaign['id']);
		return response()->json(['status' => 'Success']);
	}
}