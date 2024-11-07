<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Conversation Node</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Conversation Node</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('conversation-tree.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Parent Node</label>
                                <select name="parent_id" id="parent_id" class="form-select">
                                    <option value="">Root Level (No Parent)</option>
                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}">
                                            {{ $parent->question }} ({{ $parent->button_text }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" class="form-control" id="question" name="question"
                                    value="{{ old('question') }}" required>
                                <small class="text-muted">The question that will be shown to the user</small>
                            </div>

                            <div class="mb-3">
                                <label for="button_text" class="form-label">Button Text</label>
                                <input type="text" class="form-control" id="button_text" name="button_text"
                                    value="{{ old('button_text') }}" required>
                                <small class="text-muted">The text that will appear on the button</small>
                            </div>

                            <div class="mb-3">
                                <label for="answer" class="form-label">Answer</label>
                                <textarea class="form-control" id="answer" name="answer" rows="3">{{ old('answer') }}</textarea>
                                <small class="text-muted">The response that will be shown when this option is selected (optional)</small>
                            </div>

                            <div class="mb-3">
                                <label for="order" class="form-label">Display Order</label>
                                <input type="number" class="form-control" id="order" name="order"
                                    value="{{ old('order', 0) }}" required>
                                <small class="text-muted">The order in which this option will appear (lower numbers appear first)</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('conversation-tree.index') }}" class="btn btn-secondary">Back to List</a>
                                <button type="submit" class="btn btn-primary">Create Node</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
