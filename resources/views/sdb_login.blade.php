<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form method="POST" action="/sdb_list">
        {{ csrf_field() }}
         Account name:<br>
         <input type="text" name="name"><br>
         Password:<br>
         <input type="password" name="psw"><br>
         <input type="submit" value="Submit">
        </form>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </body>
</html>