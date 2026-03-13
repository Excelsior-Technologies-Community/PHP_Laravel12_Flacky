<!DOCTYPE html>
<html>

<head>

    <title>Edit Flack</title>

    <style>
        body {
            font-family: Poppins;
            background: #eef2f7;
            margin: 0;
        }

        .header {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            width: 40%;
            margin: auto;
            margin-top: 60px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        button {
            background: linear-gradient(45deg, #ff9671, #ffc75f);
            border: none;
            color: white;
            padding: 10px 18px;
            border-radius: 25px;
            cursor: pointer;
        }

        .back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #2c3e50;
        }
    </style>

</head>

<body>

    <div class="header">
        <h2>Edit Flack</h2>
    </div>

    <div class="container">

        <div class="card">

            <form action="{{ route('flacks.update', $flack->id) }}" method="POST">

                @csrf
                @method('PUT')

                <label>Title</label>

                <input type="text" name="title" value="{{ $flack->title }}">

                <label>Description</label>

                <textarea name="body" rows="5">{{ $flack->body }}</textarea>

                <button>Update Flack</button>

            </form>

            <a class="back" href="{{ route('flacks.index') }}">← Back</a>

        </div>

    </div>

</body>

</html>