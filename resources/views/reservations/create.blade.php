@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@section('content')
    <form name="add_name" id="add_name" action="{{ route('restaurants.store') }}" method="post">
        @csrf
        <div>
            <div class="form-row d-flex justify-content-center">
                <h4 class="d-flex">Client</h4>
            </div>
            <div class="form-row d-flex justify-content-center">
                <div class="form-group col-md-3 m-1">
                    <label for="first_name">First Name</label>
                    <input required type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                </div>
                <div class="form-group col-md-3 m-1">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row d-flex justify-content-center pb-3">
                <div class="form-group col-md-3 m-1">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-3 m-1">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-row d-flex justify-content-center">
                <h4 class="d-flex">Restaurant</h4>
            </div>
            <div class="form-row d-flex justify-content-center pb-3">
                <div class="form-group col-md-6 pb-3">
                    <label for="restaurant">Restaurants</label>
                    <select required id="restaurant" name="restaurant" class="form-select" aria-label="Default select example">
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row d-flex justify-content-center">
                <h4 class="d-flex">Date</h4>
            </div>
            <div class="form-row d-flex justify-content-center pb-3 align-items-center">
                <div class="form-group col-md-3 m-1">
                    <label for="start_date">Datetime</label>
                    <input required class="form-control" type="datetime-local" name="start_date"
                           id="start_date" value="2022-02-22T19:30"
                           min="2022-02-22T19:30" max="2030-02-22T19:30">
                </div>
                <div class="form-group col-md-3 m-1">
                    <label for="duration">Duration(hours)</label>
                        <select id="duration" name="duration" class="form-select" aria-label="">
                            <option value="1" selected>1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                        </select>
                </div>
            </div>
            <div class="form-row d-flex justify-content-center">
                <h4 class="d-flex">Client List</h4>
            </div>
            <div class="form-row d-flex justify-content-center pb-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" name="first_name" placeholder="Enter first name" class="form-control" /></td>
                            <td><input type="text" name="last_name" placeholder="Enter last name" class="form-control" /></td>
                            <td><input type="email" name="email" placeholder="Enter email" class="form-control" /></td>
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Client</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-row d-flex justify-content-center">
                <button id="submit" class="btn btn-outline-primary">Submit</button>
            </div>

        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        let i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr>' +
                '<td><input required type="text" id="first_name' + i +' "  name="first_name" placeholder="Enter first name" class="form-control" /></td>' +
                '<td><input required type="text" id="last_name_' + i +' " name="last_name" placeholder="Enter last name" class="form-control" /></td>' +
                '<td><input required type="email" id="email_' + i +' " name="email" placeholder="Enter email" class="form-control" /></td>' +
                '<td><button required type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });

        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });



        function formClients()
        {
            let clients = []
            let table = $("#dynamicAddRemove")
            table.find('tr').each(function(index) {
                let obj = {}
                if(index !== 0)
                {
                    $(this).find("td").each(function(i){
                        if($(this).find("input").val() != null){
                            obj[$(this).find("input").attr('name')] = $(this).find("input").val()
                        }
                    })
                    clients.push(obj)
                }
            });
            return clients;
        }

        // CREATE
        $("#submit").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            let formData = {
                clients: formClients(),
                'first_name': $('#first_name').val(),
                'last_name': $('#last_name').val(),
                'email': $('#email').val(),
                'phone': $('#phone').val(),
                'restaurant_id': $('#restaurant option:selected').val(),
                'start_date': $('#start_date').val(),
                'duration': $('#duration option:selected').val(),
            }
            let type = "POST";
            let ajaxUrl = 'http://127.0.0.1:8000/reservations';
            $.ajax({
                type: type,
                url: ajaxUrl,
                data: formData,
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        });


    </script>
@endsection
