@extends('layouts.base')

@section('title', 'Management User')

@section('content')
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <div class="row g-5 g-xl-8">
        <div class="col-xxl-4">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#add-user" data-bs-toggle="modal" class="btn btn-lg btn-dark text-white"><i
                                    class="mdi mdi-account-multiple-plus mdi-lg"></i> Add User</a>
                        </div>
                        <div class="col-sm-12">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>NO.</th>
                                        <th>USERNAME</th>
                                        <th>NAME</th>
                                        <th>TYPE AKUN</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->auth_group == 1)
                                                    Super Admin
                                                @elseif($item->auth_group == 2)
                                                    Data Entry
                                                @else
                                                    Manager
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-lg btn-info"
                                                    onclick="showUuser('{{ $item->id }}')"><i
                                                        class="mdi mdi-note-edit-outline"></i> Edit
                                                </a>
                                                <a href="{{ url('master/deleteUser/' . $item->id) }}"
                                                    class="btn btn-lg btn-danger"><i class="mdi mdi-delete-circle"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ url('master/post_user') }}" method="post" id="post_user">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control mt-4" name="username" id=""
                                        aria-describedby="helpId" placeholder="Masukan Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-4" name="name" id=""
                                        aria-describedby="helpId" placeholder="Masukan Nama" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control mt-4" name="password" id=""
                                        aria-describedby="helpId" placeholder="Masukan Password" required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <select class="form-control mt-4" name="auth_group" id="" required>
                                        <option value="" disabled selected>TYPE AKUN</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Data Entry</option>
                                        <option value="3">Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btnSave"><i class="fas fa-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="show-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ url('master/updateUser') }}" method="post" id="updateUser">
                    @csrf
                    <input type="hidden" name="id_user" class="idUserValue">
                    <div class="modal-body">
                        <div class="row appendUser">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btnUpdate"><i class="fas fa-save"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function showUuser(id) {
            $.ajax({
                url: "{{ url('master/showUser') }}/" + id,
                type: "GET",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#show-user').modal('show');
                    $('.idUserValue').val(response.data.id);
                    $('.appendUser').html("");
                    $('.appendUser').append(`
                      <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control mt-4" name="username" id=""
                                        aria-describedby="helpId" placeholder="Masukan Username" required value=${response.data.username}>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-4" name="name" id=""
                                        aria-describedby="helpId" placeholder="Masukan Nama" required value="${response.data.name}">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <select class="form-control mt-4" name="auth_group" id="" required>
                                        <option value="${response.data.auth_group}" selected>${response.data.group_name}</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Data Entry</option>
                                        <option value="3">Manager</option>
                                    </select>
                                </div>
                                <hr>
                                <a href="{{ url('master/resetPassword/${response.data.id}') }}" class="btn btn-lg btn-dark mt-4"> Reset Password</a>
                            </div>
                    `);
                }
            });
        }

        $('#post_user').on('submit', function() {
            $('.btnSave').html('<i class="mdi mdi-spin"></i> Saving...');
            $('.btnSave').attr('disabled', true);
        });

        $('#updateUser').on('submit', function() {
            $('.btnUpdate').html('<i class="mdi mdi-spin"></i> Saving...');
            $('.btnUpdate').attr('disabled', true);
        });
    </script>
@endsection
