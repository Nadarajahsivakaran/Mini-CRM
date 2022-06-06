@extends('layout')
@section('content')

    <h1>Employee</h1>
    <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#Employee">
        ADD
    </button>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">firstName</th>
                <th scope="col">lastName</th>
                <th scope="col">Company</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($Employees as $item)
                <tr>
                    <td>{{ $item->firstName }}</td>
                    <td>{{ $item->lastName }}</td>
                    <td>{{ $item->Name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#Employee"
                            data-id="{{ $item->id }}"
                            data-firstName="{{ $item->firstName }}"
                            data-lastName="{{ $item->lastName }}"
                            data-email="{{ $item->email }}"
                            data-phone="{{ $item->phone }}"
                            data-Company ="{{ $item->Company  }}"
                            title="edit" class="btn btn-primary btn-edit"><i
                                class="far fa-edit"></i></button>
                        <a  class="btn btn-danger" href="/deleteEmployee/{{$item->id}}" onclick="return confirm('Are you sure you want to delete this item')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

    {{ $Employees->links() }}



    {{--  modal --}}

    <div class="modal fade" id="Employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Create Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/storeEmployee" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="id" id="id">

                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                        <label for="email" class="form-label">Company</label>
                        <select class="form-select" name="company" id="company">
                            <option value="" disabled selected>Please Select</option>
                            @foreach ($Companies as $Company )
                                <option value="{{ $Company->id }}">{{ $Company->Name }}</option>
                            @endforeach
                          </select>
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
                            <label for="logo" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
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
            $('#ModalLabel').empty().append('Update Employee');
            var id = $(this).attr('data-id');
            var firstName = $(this).attr('data-firstName');
            var lastName = $(this).attr('data-lastName');
            var email = $(this).attr('data-email');
            var phone = $(this).attr('data-phone');
            var Company = $(this).attr('data-Company');

            $('#id').val(id);
            $('#first_name').val(firstName);
            $('#last_name').val(lastName);
            $('#email').val(email);
            $('#phone').val(phone);
            $('#company').val(Company);

        });
    </script>

@endsection('content')
