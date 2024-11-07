<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConversationTree;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Get the initial conversation nodes (root level)
     */
    public function getInitialNodes()
    {
        $nodes = ConversationTree::whereNull('parent_id')
            ->orderBy('order')
            ->get(['id', 'question', 'button_text', 'answer']);

        return response()->json([
            'success' => true,
            'message' => 'Initial conversation nodes retrieved successfully',
            'data' => [
                'question' => 'Apa yang ingin Anda lakukan?',
                'nodes' => $nodes
            ]
        ]);
    }

    /**
     * Get child nodes for a specific parent node
     */
    public function getChildNodes($parentId)
    {
        $parent = ConversationTree::find($parentId);

        if (!$parent) {
            return response()->json([
                'success' => false,
                'message' => 'Parent node not found'
            ], 404);
        }

        $nodes = ConversationTree::where('parent_id', $parentId)
            ->orderBy('order')
            ->get(['id', 'question', 'button_text', 'answer']);

        return response()->json([
            'success' => true,
            'message' => 'Child nodes retrieved successfully',
            'data' => [
                'question' => $parent->question,
                'parent_answer' => $parent->answer,
                'nodes' => $nodes
            ]
        ]);
    }

    /**
     * Get a specific node's details
     */
    public function getNode($id)
    {
        $node = ConversationTree::find($id);

        if (!$node) {
            return response()->json([
                'success' => false,
                'message' => 'Node not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Node retrieved successfully',
            'data' => [
                'id' => $node->id,
                'question' => $node->question,
                'button_text' => $node->button_text,
                'answer' => $node->answer,
                'parent_id' => $node->parent_id
            ]
        ]);
    }

    /**
     * Get the entire conversation path for a node
     */
    public function getConversationPath($nodeId)
    {
        $node = ConversationTree::find($nodeId);

        if (!$node) {
            return response()->json([
                'success' => false,
                'message' => 'Node not found'
            ], 404);
        }

        $path = [];
        $currentNode = $node;

        // Build path from current node up to root
        while ($currentNode) {
            array_unshift($path, [
                'id' => $currentNode->id,
                'question' => $currentNode->question,
                'button_text' => $currentNode->button_text,
                'answer' => $currentNode->answer
            ]);
            $currentNode = $currentNode->parent;
        }

        return response()->json([
            'success' => true,
            'message' => 'Conversation path retrieved successfully',
            'data' => $path
        ]);
    }
}
