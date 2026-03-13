<!DOCTYPE html>
<html>

<head>

    <title>View Flack</title>

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
            width: 50%;
            margin: auto;
            margin-top: 60px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
        }

        .body {
            margin-top: 15px;
            color: #555;
            line-height: 1.6;
        }

        .info {
            margin-top: 20px;
            font-size: 13px;
            color: #888;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            background: linear-gradient(45deg, #00c9a7, #845ec2);
            color: white;
            padding: 10px 18px;
            border-radius: 25px;
            text-decoration: none;
        }
    </style>

</head>

<body>

    <div class="header">
        <h2>Flack Details</h2>
    </div>

    <div class="container">

        <div class="card">

            <div class="title">
                {{ $flack->title }}
            </div>

            <div class="body">
                {{ $flack->body }}
            </div>

            <div class="info">
                Created: {{ $flack->created_at->format('d M Y') }}
            </div>

            <a class="btn" href="{{ route('flacks.index') }}">Back to List</a>

        </div>

    </div>

</body>

</html>