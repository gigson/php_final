<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div>

    <div>

        <img style="max-height: 200px" src="{{asset('images')."/".$product->image}}">

        <div>
            {{$product->title}}
        </div>
        <div>
            {{$product->description}}
        </div>
        <div>
            {{$product->price}}$
        </div>
        <div>
            {{$product->creadted_at}}
        </div>
        <div>
            @foreach($product->categories as $category)
                <span>&nbsp</span><i>{{$category->name}}</i>
            @endforeach
        </div>

    </div>

    <div>
        <h3>Like Product:</h3>
        <div>
            <span>{{$like_count}} &nbsp likes</span>
        </div>
        <div>
            @if($liked)
                <form action="{{route('unlikeProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="product_id" value="{{$product->id}}" hidden>
                    <input type="submit" value="unlike">
                </form>
            @else
                <form action="{{route('likeProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="product_id" value="{{$product->id}}" hidden>
                    <input type="submit" value="Like">
                </form>
            @endif

        </div>
    </div>

    <div>
        <h3>Add Comment:</h3>
        <form action="{{route('storeComment')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="comment">comment:</label><br>
            <input type="text" name="comment"><br>

            <input type="text" name="product_id" value="{{$product->id}}" hidden>
            <input type="submit" value="Add Comment">
        </form>
    </div>

    <div>
        <h3>Comments:</h3>
        <div>
            @foreach($product->comments as $comment)
                <div style="margin-bottom: 15px">
                    <div>
                        {{$comment->user->name}}
                    </div>
                    <div>
                        {{$comment->text}}
                    </div>
                </div>
            @endforeach>

        </div>
    </div>

</div>
</body>
</html>
