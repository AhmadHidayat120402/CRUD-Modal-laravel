@extends('app')

@section('content')
    <h1 class="page-header text-center">CRUD Laravel Modal</h1>
    <div class="d-flex justify-content-between">
        <h3>member table</h3>
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNew">
            member add</button>
    </div>
    <div class="table">
        <table class="table table-bordered table-striped" id="table-member">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member as $item)
                    <tr>
                        <td>{{ $item->firstname }}</td>
                        <td>{{ $item->lastname }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2"></div>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}"
                                class="btn btn-warning">Edit</button>
                                <form action="/member/{{ $item->id }}" method="post" class="delete-form">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button class="btn btn-danger btn-sm m-0 delete-button"
                                        type="submit">
                                        <i class="fa-solid fa-trash-can"></i> Hapus</button>
                                </form>
                        </td>
                    </tr>

                    <!-- edit Modal -->
                    <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/member/{{ $item->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                required value="{{ $item->firstname }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastname">lastname</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname"
                                                required value="{{ $item->lastname }}">
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                @endforeach
                <script>
                    const deleteButtons = document.querySelectorAll('.delete-button');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();

                            const id = this.parentNode.querySelector('input[name="id"]').value;

                            Swal.fire({
                                title: 'Hapus Data?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Hapus',
                                cancelButtonText: 'Batal',
                                showCloseButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                customClass: {
                                    container: 'my-swal'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.parentNode.action = '/member/' + id;
                                    this.parentNode.submit();
                                }
                            });
                        });
                    });
                </script>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/save" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="firstname">firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Ahmad"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname">lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Hidayat"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#table-member').DataTable();
        });
    </script>
@endpush
