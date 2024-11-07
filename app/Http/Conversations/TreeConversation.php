<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use App\Models\ConversationTree;

class TreeConversation extends Conversation
{
    protected $currentNode = null;

    public function run()
    {
        $this->askQuestion();
    }

    public function askQuestion($parentId = null)
    {
        $nodes = ConversationTree::where('parent_id', $parentId)
            ->orderBy('order')
            ->get();

        if ($nodes->isEmpty()) {
            if ($this->currentNode && $this->currentNode->answer) {
                $this->bot->typesAndWaits(1);
                $this->say($this->currentNode->answer);
            }
            $this->askQuestion(null); // Return to root
            return;
        }

        $question = Question::create($parentId === null ? 'Apa yang ingin Anda lakukan?' : $nodes->first()->question)
            ->fallback('Tidak bisa memahami pilihan Anda')
            ->callbackId('ask_question');

        foreach ($nodes as $node) {
            $question->addButton(Button::create($node->button_text)->value($node->id));
        }

        $question->addButton(Button::create('Kembali')->value('kembali'));

        $this->ask($question, function ($answer) {
            $response = $answer->getValue();

            if ($response === 'kembali') {
                $parentId = $this->currentNode ? $this->currentNode->parent_id : null;
                $this->currentNode = null;
                $this->askQuestion($parentId);
                return;
            }

            $this->currentNode = ConversationTree::find($response);
            if ($this->currentNode) {
                $this->askQuestion($this->currentNode->id);
            } else {
                $this->say('Pilihan tidak valid. Coba lagi.');
                $this->repeat();
            }
        });
    }
}
