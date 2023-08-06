<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NovoPedido extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     * @param
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user; // Atribua o valor recebido à propriedade $user
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Novo Pedido',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.novopedido',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
    {
        return $this->markdown('emails.novopedido')
            ->subject('Novo pedido de aprovação')
            ->with([
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
                'user_id' => $this->user->id,
            ]);

        return $this->view('emails.novo_pedido');
    }

}
