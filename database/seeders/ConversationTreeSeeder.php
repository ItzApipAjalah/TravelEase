<?php

namespace Database\Seeders;

use App\Models\ConversationTree;
use Illuminate\Database\Seeder;

class ConversationTreeSeeder extends Seeder
{
    public function run()
    {
        // First level questions (Root)
        $ticketIssue = ConversationTree::create([
            'question' => 'Pertanyaan pertama: Apa yang ingin Anda lakukan?',
            'button_text' => 'Masalah pembelian tiket',
            'order' => 1,
        ]);

        $planeIssue = ConversationTree::create([
            'question' => 'Pertanyaan pertama: Apa yang ingin Anda lakukan?',
            'button_text' => 'Masalah pesawat',
            'order' => 2,
        ]);

        $travelEase = ConversationTree::create([
            'question' => 'Pertanyaan pertama: Apa yang ingin Anda lakukan?',
            'button_text' => 'Masalah Travel Ease',
            'order' => 3,
        ]);

        // Ticket Issues (Second Level)
        ConversationTree::create([
            'parent_id' => $ticketIssue->id,
            'question' => 'Masalah pembelian tiket apa yang ingin Anda tanyakan?',
            'button_text' => 'Tiket sudah dibeli tapi belum dapat kodenya',
            'answer' => 'Anda bisa menghubungi layanan pelanggan untuk mendapatkan kode tiket Anda.',
            'order' => 1,
        ]);

        ConversationTree::create([
            'parent_id' => $ticketIssue->id,
            'question' => 'Masalah pembelian tiket apa yang ingin Anda tanyakan?',
            'button_text' => 'Tiket tidak bisa dipakai',
            'answer' => 'Silahkan hubungi customer service kami untuk bantuan lebih lanjut.',
            'order' => 2,
        ]);

        // Plane Issues (Second Level)
        ConversationTree::create([
            'parent_id' => $planeIssue->id,
            'question' => 'Masalah pesawat apa yang ingin Anda tanyakan?',
            'button_text' => 'Kode tidak bisa dipakai',
            'answer' => 'Mohon periksa kembali kode Anda dan pastikan sudah dimasukkan dengan benar.',
            'order' => 1,
        ]);

        ConversationTree::create([
            'parent_id' => $planeIssue->id,
            'question' => 'Masalah pesawat apa yang ingin Anda tanyakan?',
            'button_text' => 'Kode salah padahal sudah benar isinya',
            'answer' => 'Silahkan hubungi customer service kami untuk verifikasi kode Anda.',
            'order' => 2,
        ]);

        ConversationTree::create([
            'parent_id' => $planeIssue->id,
            'question' => 'Masalah pesawat apa yang ingin Anda tanyakan?',
            'button_text' => 'Kode keterangan sudah dipakai padahal belum dipakai',
            'answer' => 'Kami akan membantu memeriksa status penggunaan kode Anda. Silahkan hubungi customer service.',
            'order' => 3,
        ]);

        // Travel Ease Issues (Second Level)
        ConversationTree::create([
            'parent_id' => $travelEase->id,
            'question' => 'Masalah Travel Ease apa yang ingin Anda tanyakan?',
            'button_text' => 'Cara mendapatkan Travel Ease',
            'answer' => 'Anda bisa mendapatkan Travel Ease dengan menghubungi customer support atau melalui aplikasi kami.',
            'order' => 1,
        ]);

        ConversationTree::create([
            'parent_id' => $travelEase->id,
            'question' => 'Masalah Travel Ease apa yang ingin Anda tanyakan?',
            'button_text' => 'Manfaat dari Travel Ease',
            'answer' => 'Travel Ease memberikan perlindungan perjalanan dan fasilitas tambahan.',
            'order' => 2,
        ]);

        ConversationTree::create([
            'parent_id' => $travelEase->id,
            'question' => 'Masalah Travel Ease apa yang ingin Anda tanyakan?',
            'button_text' => 'Masa berlaku Travel Ease',
            'answer' => 'Travel Ease berlaku selama satu tahun sejak pembelian.',
            'order' => 3,
        ]);
    }
}
