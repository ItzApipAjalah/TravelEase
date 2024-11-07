<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationTree extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'question',
        'answer',
        'button_text',
        'order'
    ];

    public function parent()
    {
        return $this->belongsTo(ConversationTree::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ConversationTree::class, 'parent_id');
    }
}
