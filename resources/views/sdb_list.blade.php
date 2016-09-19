<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        @foreach($data as $domain => $items)
        <p>Domain: {{$domain}}
        <ul>
            @foreach($items as $item)
            <li>{{$item['Name']}} @foreach($item['Attributes'] as $attr) {{$attr['Name']}}={{$attr['Value']}} @endforeach </li>
            @endforeach
        </ul>
        @endforeach
    </body>
</html>