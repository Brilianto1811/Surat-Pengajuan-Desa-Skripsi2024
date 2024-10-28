<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
        }

        h3 {
            color: #333333;
        }

        h4 {
            color: #555555;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .button:hover {
            background-color: #218838;
        }

        p {
            color: #555555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>{{ $data['title'] }}</h3>
        <h4>{{ $data['body'] }}</h4>

        <p>Silahkan klik link dibawah ini untuk verifikasi login anda:</p>

        <a href="https://manajemen-suratdesa.bogorkab.online/{{ $data['token'] }}">Verifikasi Akun</a>

        <p>Terimakasih</p>
    </div>
</body>

</html>
