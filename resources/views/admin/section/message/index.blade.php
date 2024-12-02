@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Broadcast message</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">
                            Send message in your Area. All people in your local area will be notified.
                        </p>
                        <form method="POST" action="{{ route('admin.messages.send-email-everyone') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="smallSelect" class="form-label">Send By</label>
                                <select id="smallSelect" class="form-select form-select" required>
                                    <option value="1">Email</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="subject">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="write subject here" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="message">Message</label>
                                <textarea id="message" name="message" class="form-control" placeholder="Hi, write message here" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Recent messages</h5>

                    <div class="row">
                        <div class="col-md mb-4 mb-md-0">
                            <div class="accordion mt-3 accordion-without-arrow" id="accordionExample">
                                @forelse ($messages as $message)
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#accordionOne_{{ $message->id }}"
                                                aria-expanded="false" aria-controls="accordionOne_{{ $message->id }}">
                                                <div class="d-flex justify-content-between w-100">
                                                    <small class="mb-0">
                                                        <span class="rounded-pill p-1">
                                                            <i class="menu-icon tf-icons bx bx-user"></i>
                                                        </span>
                                                        {{ $message->email }} <span
                                                            class="d-none d-md-inline-block ms-2 text-muted">
                                                            &lpar;{{ $message->name }}&rpar;</span>
                                                    </small>
                                                    <small
                                                        class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                                </div>
                                            </button>
                                        </h2>

                                        <div id="accordionOne_{{ $message->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div
                                                    class="list-group-item list-group-item-action flex-column align-items-start">

                                                    <p class="small text-muted">Name: {{ $message->name }}</p>
                                                    <p class="small text-muted">Email: <a
                                                            href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                                    </p>

                                                    <p class="small text-muted"> Subject:
                                                        <strong>{{ $message->subject }}</strong>
                                                    </p>
                                                    <p class="small text-muted">{{ $message->message }}</p>
                                                </div>

                                                <div class="my-2">
                                                    <form class="d-inline-block"
                                                        action="{{ route('admin.messages.status', $message->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="Click to Change"
                                                            class="btn btn-sm {{ $message->status ? 'btn-outline-success' : 'btn-outline-danger' }}"><i
                                                                class="bx {{ $message->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form class="d-inline-block"
                                                        action="{{ route('admin.messages.destroy', $message->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure to delete?')"
                                                            class="btn btn-sm btn-outline-danger"><i
                                                                class="bx bx-trash me-1"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div class="alert alert-primary my-2">No messages</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
