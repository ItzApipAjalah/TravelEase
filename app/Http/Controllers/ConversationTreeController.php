<?php

namespace App\Http\Controllers;

use App\Models\ConversationTree;
use Illuminate\Http\Request;

class ConversationTreeController extends Controller
{
    public function index()
    {
        $trees = ConversationTree::whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return view('conversation-tree.index', compact('trees'));
    }

    public function create()
    {
        $parents = ConversationTree::all();
        return view('conversation-tree.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:conversation_trees,id',
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'button_text' => 'required|string',
            'order' => 'required|integer'
        ]);

        ConversationTree::create($validated);
        return redirect()->route('conversation-tree.index')->with('success', 'Node created successfully');
    }

    public function edit(ConversationTree $conversationTree)
    {
        $parents = ConversationTree::where('id', '!=', $conversationTree->id)->get();
        return view('conversation-tree.edit', compact('conversationTree', 'parents'));
    }

    public function update(Request $request, ConversationTree $conversationTree)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:conversation_trees,id',
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'button_text' => 'required|string',
            'order' => 'required|integer'
        ]);

        $conversationTree->update($validated);
        return redirect()->route('conversation-tree.index')->with('success', 'Node updated successfully');
    }

    public function destroy(ConversationTree $conversationTree)
    {
        $conversationTree->delete();
        return redirect()->route('conversation-tree.index')->with('success', 'Node deleted successfully');
    }
}
