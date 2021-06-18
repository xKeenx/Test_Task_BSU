<!doctype html>
<html lang="en">
<head>
    <title>Тестовое задание</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://www.jqueryscript.net/demo/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel/src/jquery.table2excel.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 1270px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }
    </style>
</head>

<body>
<div class="container box">
    <h1 align="center">Admin Panel</h1>

    <div align="right">
        <button type="button" id="modal_button" class="btn btn-info">Добавить запись</button>
    </div>
    <div id="result" class="table-responsive"></div>
    <div id="customerModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавить запись</h4>

                </div>
                <div class="modal-body">
                    <label>Введите фамилию</label>
                    <input type="text" name="surname" id="surname" class="form-control"/>
                    <label>Введите имя</label>
                    <input type="text" name="name" id="name" class="form-control"/>
                    <label>Введите отчество</label>
                    <input type="text" name="midname" id="midname" class="form-control"/>
                    <label>Введите Email</label>
                    <input type="text" name="email" id="email" class="form-control"/>
                    <label>Введите страну</label>
                    <input type="text" name="country" id="country" class="form-control"/>
                    <label>Введите город</label>
                    <input type="text" name="city" id="city" class="form-control"/>
                    <label>Логин</label>
                    <input type="text" name="login" id="login"
                           placeholder="Необязательно для заполнения, генерируется автоматически" class="form-control"/>
                    <label>Пароль</label>
                    <input type="text" name="password" id="password"
                           placeholder="Необязательно для заполнения, генерируется автоматически" class="form-control"/>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id"/>
                    <input type="submit" name="action" id="action" class="btn btn-success"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>

    </div>
</div>

<button type="button" class="btn btn-info export">Export</button>

<form mehtod="post" id="export_excel">
    <input type="file" name="excel_file" id="excel_file"/>
</form>
</body>
<script>


    $(document).ready(function(){
        $('#excel_file').change(function(){
            $('#export_excel').submit();
        });
        $('#export_excel').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"file-upload.php",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data){
                    $('#result').html(data);
                    $('#excel_file').val('');
                }
            });
        });
    });

    $(function () {
        $(".export").click(function () {
            $("#result").table2excel({

                exclude: ".xls",
                name: "UserData"

            });
        });
    });

    function makeLogin() {

        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (let i = 0; i < 10; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;

    }

    function getRandomPassword(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }


    $(document).ready(function () {
        fetchUser();

        function fetchUser() {
            let action = "Load";
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {action: action},
                success: function (data) {
                    $('#result').html(data);
                }
            });
        }


        $('#modal_button').click(function () {
            $('#customerModal').modal('show');
            $('#surname').val("");
            $('#name').val("");
            $('#midname').val("");
            $('#email').val("");
            $('#country').val("");
            $('#city').val("");
            $('#login').val("");
            $('#password').val("");
            $('.modal-title').text("Добавление новой записи");
            $('#action').val('Добавить');
        })

        $('#action').click(function () {
            let id = $('#id').val();
            let surname = $('#surname').val();
            let name = $('#name').val();
            let midname = $('#midname').val();
            let email = $('#email').val();
            let country = $('#country').val();
            let city = $('#city').val();
            let login = makeLogin();
            let password = getRandomPassword(10000000, 99999999);
            let action = $('#action').val();
            if (surname !== "" && name !== "" && midname !== "" && email !== "" && country !== "" && city !== "") {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        id: id,
                        surname: surname,
                        name: name,
                        midname: midname,
                        email: email,
                        country: country,
                        city: city,
                        login: login,
                        password: password,
                        action: action
                    },
                    success: function (data) {

                        $('#customerModal').modal('hide');
                        fetchUser();
                    }
                });
            } else {
                alert("Все поля должны быть заполнены!");
            }
        });

        $(document).on('click', '.update', function () {
            let id = $(this).attr("id");
            let action = "Select";
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {id: id, action: action},
                dataType: "json",
                success: function (data) {
                    $('#customerModal').modal('show');
                    $('.modal-title').text("Обновить записи");
                    $("#action").val("Обновить");
                    $("#id").val(id);
                    $("#surname").val(data.surname);
                    $("#name").val(data.name);
                    $("#midname").val(data.midname);
                    $("#email").val(data.email);
                    $("#country").val(data.country);
                    $("#city").val(data.city);
                    $("#login").val(data.login);
                    $("#password").val(data.password);
                }
            });
        });

        $(document).on('click', '.delete', function () {
            let id = $(this).attr('id');
            if (confirm("Вы уверенны что хотите удалить эти данные?")) {
                let action = "Delete";
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {id: id, action: action},
                    success: function (data) {
                        fetchUser();

                    }
                })
            } else {
                return false;
            }
        });
    });

    $('button[data-dismiss="modal"]').click(function () {
        $(this).parent().parent().parent().parent().modal('hide');
    })


</script>
</html>


