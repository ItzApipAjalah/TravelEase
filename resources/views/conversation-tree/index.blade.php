<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Conversation Tree</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .child-row {
            background-color: #f8f9fa;
        }
        .child-indicator {
            border-left: 2px solid #dee2e6;
            padding-left: 15px;
        }
        .order-badge {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            background-color: #e9ecef;
            margin-right: 10px;
        }
        .parent-order {
            background-color: #0d6efd;
            color: white;
        }
        .child-order {
            background-color: #6c757d;
            color: white;
        }
        .tree-section {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }
        .tree-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .tree-content {
            padding: 0;
        }
        .table {
            margin-bottom: 0;
        }
        .action-buttons {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Conversation Tree</h2>
            <a href="{{ route('conversation-tree.create') }}" class="btn btn-primary">Add New Node</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @foreach($trees as $node)
            <div class="tree-section">
                <div class="tree-header">
                    <h5 class="mb-0">
                        <span class="order-badge parent-order">{{ $node->order }}</span>
                        {{ $node->button_text }}
                    </h5>
                </div>
                <div class="tree-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10%">Order</th>
                                <th style="width: 30%">Question</th>
                                <th style="width: 20%">Button Text</th>
                                <th style="width: 25%">Answer</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Parent row -->
                            <tr class="table-primary">
                                <td>
                                    <span class="order-badge parent-order">{{ $node->order }}</span>
                                </td>
                                <td><strong>{{ $node->question }}</strong></td>
                                <td>{{ $node->button_text }}</td>
                                <td>{{ Str::limit($node->answer, 50) }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('conversation-tree.edit', $node) }}"
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('conversation-tree.destroy', $node) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure? This will delete all child nodes as well.')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Child rows -->
                            @foreach($node->children as $child)
                                <tr class="child-row">
                                    <td>
                                        <span class="order-badge child-order">{{ $child->order }}</span>
                                    </td>
                                    <td class="child-indicator">{{ $child->question }}</td>
                                    <td>{{ $child->button_text }}</td>
                                    <td>{{ Str::limit($child->answer, 50) }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('conversation-tree.edit', $child) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('conversation-tree.destroy', $child) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this node?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
