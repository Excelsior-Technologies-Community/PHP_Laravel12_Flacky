<!DOCTYPE html>
<html>

<head>

    <title>Create Flack</title>

    <style>

        body{
            font-family:Poppins;
            background:#eef2f7;
            margin:0;
        }

        .header{
            background:linear-gradient(45deg,#2c3e50,#4b6584);
            color:white;
            text-align:center;
            padding:20px;
        }

        .container{
            width:40%;
            margin:auto;
            margin-top:50px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:14px;
            box-shadow:0 6px 15px rgba(0,0,0,0.08);
        }

        input,
        textarea,
        select{
            width:100%;
            padding:12px;
            margin-top:10px;
            margin-bottom:20px;
            border-radius:8px;
            border:1px solid #ddd;
        }

        button{
            background:linear-gradient(45deg,#00c9a7,#845ec2);
            border:none;
            color:white;
            padding:12px 18px;
            border-radius:25px;
            cursor:pointer;
        }

        .back{
            display:inline-block;
            margin-top:15px;
            text-decoration:none;
            color:#2c3e50;
        }

    </style>

</head>

<body>

    <div class="header">

        <h2>Create Flack</h2>

    </div>

    <div class="container">

        <div class="card">

            <form action="{{ route('flacks.store') }}" method="POST">

                @csrf

                <label>Title</label>

                <input
                    type="text"
                    name="title"
                    placeholder="Enter title"
                >

                <label>Description</label>

                <textarea
                    name="body"
                    rows="6"
                    placeholder="Enter description"
                ></textarea>

                <label>Status</label>

                <select name="status">

                    <option value="Draft">
                        Draft
                    </option>

                    <option value="Published">
                        Published
                    </option>

                </select>

                <button>
                    Create Flack
                </button>

            </form>

            <a
                class="back"
                href="{{ route('flacks.index') }}"
            >
                ← Back
            </a>

        </div>

    </div>

</body>

</html>