<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtkazanaPorudžbina extends Mailable {
	use Queueable, SerializesModels;
	public $message;
	public $allInBaskets;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($message, $allInBaskets) {
		$this->message = $message;
		$this->allInBaskets = $allInBaskets;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown('emails.fail');
	}
}
