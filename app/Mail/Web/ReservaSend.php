<?php

namespace App\Mail\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservaSend extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Pré-reserva: ' . $this->data['reply_name'],  
            from: new Address(env('MAIL_FROM_ADDRESS'), env('APP_NAME')), // Remetente
            to: [new Address('contato@pousadadotie.com.br', env('APP_NAME'))], // Destinatário                 
            replyTo: [
                new Address($this->data['reply_email'], $this->data['reply_name']),
            ],
            bcc: env('MAIL_FROM_ADDRESS'), // Cópia oculta (opcional)
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reserva',
            with:[
                'nome' => $this->data['reply_name'],
                'email' => $this->data['reply_email'],
                'telefone' => $this->data['telefone'],
                'checkin' => $this->data['checkin'],
                'checkout' => $this->data['checkout'],
                'adultos' => $this->data['adultos'],
                'criancas' => $this->data['criancas'],
                'codigo' => $this->data['codigo'],
                'mensagem' => $this->data['mensagem']
            ]
        );
    }
    
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->replyTo($this->data['reply_email'], $this->data['reply_name'])
    //         ->to($this->data['siteemail'], $this->data['sitename'])
    //         //->cc('')
    //         ->bcc('atendimento@ubatubatimes.com.br')
    //         ->from($this->data['siteemail'], $this->data['sitename'])
    //         ->subject('✔️ Pré-reserva: ' . $this->data['reply_name'])
    //         ->markdown('emails.reserva', [
    //             'nome' => $this->data['reply_name'],
    //             'email' => $this->data['reply_email'],
    //             'telefone' => $this->data['telefone'],
    //             'checkin' => $this->data['checkin'],
    //             'checkout' => $this->data['checkout'],
    //             'adultos' => $this->data['adultos'],
    //             'criancas' => $this->data['criancas'],
    //             'codigo' => $this->data['codigo'],
    //             'mensagem' => $this->data['mensagem']
    //     ]);
    // }
}
