@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h3>Add New Product:</h3>
        <hr>
        <form action="{{route('storeProduct')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Title:</label><br>
            <input type="text" name="title"><br>

            <label for="description">Description:</label><br>
            <textarea cols="50" rows="10" type="text" name="description"></textarea><br>

            <label for="price">Price:</label><br>
            <input type="number" name="price"><br>

            <label for="image">Image:</label><br>
            <input type="file" name="image"><br>

            <label for="categories">Categories: </label>
            <button onclick="addCategory()" type="button" class="add-tag-btn">Add</button>
            <div>
                <ol id="categories-ol">
                    <li>
                        <input type="text" name="categories[]">
                    </li>
                </ol>
            </div>

            {{--tag--}}
            <input type="submit" value="Add Post">
        </form>
    </div>
</div>

<script>
    function addCategory() {
        let ol = document.getElementById("categories-ol");
        let li = document.createElement("li");
        li.innerHTML = '<input type="text" name="categories[]">'
        ol.appendChild(li);
    }
</script>
@endsection
