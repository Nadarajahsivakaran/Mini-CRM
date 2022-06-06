@extends('layout')
@section('content')

    @if (\Session::has('success'))
        <div class="alert alert-success session-msg" style="width: 50%; margin:0 auto 15px auto; text-align:center;">
            <p>{{\Session::get('success')}}</p>
        </div>
    @endif

    <h1>Company</h1>

    <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#AddCompany">
        ADD
    </button>

    <table class="table">

        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Enail</th>
                <th scope="col">Logo</th>
                <th scope="col">Website</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($Companies as $item)
                <tr>
                    <td>{{ $item->Name }}</td>
                    <td>{{ $item->email }}</td>
                    <td><img src="{{ asset('storage/'.$item->logo) }}" alt="" class="image"></td>
                    <td>{{ $item->website }}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#AddCompany"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->Name }}"
                            data-email="{{ $item->email }}"
                            data-logo="{{ $item->logo }}"
                            data-website="{{ $item->website }}"
                            title="edit" class="btn btn-primary btn-edit"><i
                                class="far fa-edit"></i></button>
                        <a  class="btn btn-danger" href="/deleteCompany/{{$item->id}}" onclick="return confirm('Are you sure you want to delete this item')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

    {{ $Companies->links() }}


    {{--  modal --}}

    <div class="modal fade" id="AddCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Create Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/storeCompany" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="id" id="id">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" name="website" id="website" value="{{ old('website') }}">
                        </div>

                        <button class="btn btn-danger" id="reset" type="reset">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>

        $(function(){
            setTimeout(function(){
                $('.session-msg').slideUp();
            },5000);
        });

        $(document).ready(function() {
            if (!@json($errors->isEmpty())) {
                $('#AddCompany').modal('show');
            }
        });


        $('.btn-edit').on('click', function() {
            $('#ModalLabel').empty().append('Update Company');
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var email = $(this).attr('data-email');
            var logo = $(this).attr('data-logo');
            var website = $(this).attr('data-website');

            $('#id').val(id);
            $('#name').val(name);
            $('#email').val(email);
            $('#logo').val(logo);
            $('#website').val(website);

        });

        $('.add').on('click', function() {
            $('#ModalLabel').empty().append('Create Company');
            $('#id').val("");
            $('#name').val("");
            $('#email').val("");
            $('#logo').val("");
            $('#website').val("");

        });


    </script>

@endsection
