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
            background: linear-gradient(45deg, #2c3e50, #4b6584);
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
            border-radius: 14px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
        }

        .body {
            margin-top: 20px;
            color: #555;
            line-height: 1.8;
            font-size: 16px;
        }

        .info {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .status {
            display: inline-block;
            margin-top: 10px;
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

        .btn {
            display: inline-block;
            margin-top: 25px;
            background: linear-gradient(45deg, #00c9a7, #845ec2);
            color: white;
            padding: 11px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        @media(max-width:768px) {

            .container {
                width: 92%;
            }

            .card {
                padding: 25px;
            }
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

                Status:

                <span class="status {{ strtolower($flack->status) }}">

                    {{ $flack->status }}

                </span>

            </div>

            <div class="info">

                Created:
                
                {{ $flack->created_at->format('d M Y') }}

            </div>

            <a
                class="btn"
                href="{{ route('flacks.index') }}"
            >
                ← Back to List
            </a>

        </div>

    </div>

</body>

</html>