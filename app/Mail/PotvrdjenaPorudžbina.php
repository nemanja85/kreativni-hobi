<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PotvrdjenaPorudžbina extends Mailable {
	use Queueable, SerializesModels;
	public $message;
	public $baskets;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($message, $baskets) {
		$this->message = $message;
		$this->basket = $baskets;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown('emails.success');
	}
}
