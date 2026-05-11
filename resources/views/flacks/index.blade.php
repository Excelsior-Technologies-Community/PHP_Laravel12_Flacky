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
            background: linear-gradient(45deg, #2c3e50, #4b6584);
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        /* Container */

        .container {
            width: 85%;
            margin: auto;
            margin-top: 40px;
        }

        /* Button */

        .create-btn {
            background: linear-gradient(45deg, #00c9a7, #845ec2);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
        }

        /* Message */

        .message {
            background: #d3f9d8;
            color: #2b8a3e;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Stats */

        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        }

        .stat-card h2 {
            margin: 0;
            color: #845ec2;
            font-size: 34px;
        }

        .stat-card p {
            margin-top: 10px;
            color: #555;
        }

        /* Search */

        .search-box {
            background: white;
            padding: 20px;
            border-radius: 14px;
            margin-bottom: 30px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        }

        .search-form {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .search-form input,
        .search-form select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            flex: 1;
        }

        /* Card */

        .card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 14px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
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
            color: #666;
            line-height: 1.6;
        }

        /* Status */

        .status {
            display: inline-block;
            margin-top: 12px;
            padding: 7px 16px;
            border-radius: 20px;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .draft {
            background: #f59f00;
        }

        .published {
            background: #40c057;
        }

        /* Buttons */

        .actions {
            margin-top: 18px;
        }

        .btn {
            color: white;
            padding: 9px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
            margin-right: 8px;
            transition: 0.3s;
        }

        .show-btn {
            background: linear-gradient(45deg, #20c997, #0ca678);
        }

        .edit-btn {
            background: linear-gradient(45deg, #4dabf7, #1c7ed6);
        }

        .delete-btn {
            background: linear-gradient(45deg, #ff6b6b, #e03131);
        }

        .show-btn:hover,
        .edit-btn:hover,
        .delete-btn:hover {
            transform: scale(1.05);
        }

        /* Empty */

        .empty {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 14px;
            color: #777;
        }

        @media(max-width:768px) {

            .stats {
                flex-direction: column;
            }

            .search-form {
                flex-direction: column;
            }

            .container {
                width: 95%;
            }
        }
    </style>

</head>

<body>

    <div class="navbar">

        <h2>Flacky Manager</h2>

        <a class="create-btn" href="{{ route('flacks.create') }}">
            + New Flack
        </a>

    </div>

    <div class="container">

        @if(session('success'))

            <div class="message">
                {{ session('success') }}
            </div>

        @endif

        <!-- Statistics -->

        <div class="stats">

            <div class="stat-card">
                <h2>{{ $totalFlacks }}</h2>
                <p>Total Flacks</p>
            </div>

            <div class="stat-card">
                <h2>{{ $draftFlacks }}</h2>
                <p>Draft Flacks</p>
            </div>

            <div class="stat-card">
                <h2>{{ $publishedFlacks }}</h2>
                <p>Published Flacks</p>
            </div>

        </div>

        <!-- Search -->

        <div class="search-box">

            <form method="GET" class="search-form">

                <input
                    type="text"
                    name="search"
                    placeholder="Search flacks..."
                    value="{{ request('search') }}"
                >

                <select name="status">

                    <option value="">All Status</option>

                    <option
                        value="Draft"
                        {{ request('status') == 'Draft' ? 'selected' : '' }}
                    >
                        Draft
                    </option>

                    <option
                        value="Published"
                        {{ request('status') == 'Published' ? 'selected' : '' }}
                    >
                        Published
                    </option>

                </select>

                <button class="btn show-btn">
                    Search
                </button>

            </form>

        </div>

        <!-- Cards -->

        @forelse($flacks as $flack)

            <div class="card">

                <h3>{{ $flack->title }}</h3>

                <p>
                    {{ Str::limit($flack->body, 150) }}
                </p>

                <span class="status {{ strtolower($flack->status) }}">
                    {{ $flack->status }}
                </span>

                <div class="actions">

                    <a
                        class="btn show-btn"
                        href="{{ route('flacks.show', $flack->id) }}"
                    >
                        Show
                    </a>

                    <a
                        class="btn edit-btn"
                        href="{{ route('flacks.edit', $flack->id) }}"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('flacks.destroy', $flack->id) }}"
                        method="POST"
                        style="display:inline"
                        onsubmit="return confirmDelete()"
                    >

                        @csrf
                        @method('DELETE')

                        <button class="btn delete-btn">
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                No flacks found.
            </div>

        @endforelse

    </div>

    <script>

        function confirmDelete() {

            return confirm(
                "Are you sure you want to delete this flack?"
            );
        }

    </script>

</body>

</html>