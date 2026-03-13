<!DOCTYPE html>
<html>

<head>
    <title>Flacky Dashboard</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
            margin: 0;
        }

        /* Navbar */

        .navbar {
            background: #2c3e50;
            color: white;
            padding: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-weight: 500;
        }

        /* Container */

        .container {
            width: 80%;
            margin: auto;
            margin-top: 40px;
        }

        /* Create Button */

        .create-btn {
            background: linear-gradient(45deg, #00c9a7, #845ec2);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
        }

        /* Card */

        .card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .card h3 {
            margin: 0;
            color: #2c3e50;
        }

        .card p {
            color: #555;
            margin-top: 8px;
        }

        /* Buttons */

        .actions {
            margin-top: 15px;
        }

        /* Common Button Style */

        .btn {
            color: white;
            padding: 7px 14px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            margin-right: 8px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Show */

        .show-btn {
            background: linear-gradient(45deg, #20c997, #0ca678);
        }

        .show-btn:hover {
            background: linear-gradient(45deg, #12b886, #099268);
            transform: scale(1.05);
        }

        /* Edit */

        .edit-btn {
            background: linear-gradient(45deg, #4dabf7, #1c7ed6);
        }

        .edit-btn:hover {
            background: linear-gradient(45deg, #339af0, #1864ab);
            transform: scale(1.05);
        }

        /* Delete */

        .delete-btn {
            background: linear-gradient(45deg, #ff6b6b, #e03131);
        }

        .delete-btn:hover {
            background: linear-gradient(45deg, #fa5252, #c92a2a);
            transform: scale(1.05);
        }

        .message {
            background: #d3f9d8;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #2b8a3e;
        }
    </style>

</head>

<body>

    <div class="navbar">
        <h2>Flacky Manager</h2>

        <a class="create-btn" href="{{ route('flacks.create') }}">+ New Flack</a>
    </div>

    <div class="container">

        @if(session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        @foreach($flacks as $flack)

            <div class="card">

                <h3>{{ $flack->title }}</h3>

                <p>{{ $flack->body }}</p>

                <div class="actions">

                    <a class="btn show-btn" href="{{ route('flacks.show', $flack->id) }}">Show</a>

                    <a class="btn edit-btn" href="{{ route('flacks.edit', $flack->id) }}">Edit</a>

                    <form action="{{ route('flacks.destroy', $flack->id) }}" method="POST" style="display:inline"
                        onsubmit="return confirmDelete()">

                        @csrf
                        @method('DELETE')

                        <button class="btn delete-btn">Delete</button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Flack?");
        }
    </script>

</body>

</html>