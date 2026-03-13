# PHP_Laravel12_Flacky

A simple CRUD web application built with Laravel 12 that allows users to create, view, edit, and delete flack records.

---



## Project Description

PHP_Laravel12_Flacky is a simple CRUD (Create, Read, Update, Delete) web application built using the Laravel 12 framework.
The project allows users to create, view, update, and delete flack records through a clean and user-friendly interface.

This application demonstrates how to implement a complete Laravel CRUD workflow using models, controllers, migrations, routes, and Blade templates. It is designed for learning purposes and helps developers understand how Laravel applications are structured and how different components interact with each other.

The system stores flack information in a database and displays it dynamically using Laravel's Eloquent ORM and Blade templating engine.


## Key Features

- Create new flack records with title and description
- View all flacks in a clean dashboard layout
- Display detailed information for a specific flack
- Edit and update existing flack records
- Delete flacks with confirmation popup
- Success message notifications after operations
- Modern card-based user interface design
- Simple navigation between pages
- Responsive and clean layout using CSS



## Application Workflow

- User opens the application dashboard.

- The dashboard displays a list of all flacks stored in the database.

- Users can create a new flack by entering a title and description.

- Each flack can be viewed, edited, or deleted from the dashboard.

- All data operations are processed through Laravel controllers and stored in the database.

- The system updates the interface dynamically using Blade templates.


## Technologies Used

1. Laravel 12 – Backend framework used to build the application logic.

2. PHP – Used for server-side development.

3. MySQL – Used to store flack data in the database.

4. HTML – Used to structure the web pages.

5. CSS – Used to design and style the user interface.

6. JavaScript – Used for small interactive features like delete confirmation.



---



## Installation Steps


---


## STEP 1: Create Laravel 12 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel12_Flacky "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_Flacky

```

#### Explanation:

This command installs a fresh Laravel 12 application using Composer.

It creates a new project folder named PHP_Laravel12_Flacky and prepares the basic Laravel structure.




## STEP 2: Database Setup 

### Update database details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_Flacky
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel12_Flacky

```

### Then Run:

```
php artisan migrate

```


#### Explanation:

In this step, the .env file is updated with MySQL connection details.

Running php artisan migrate creates Laravel's default database tables inside the database.





## STEP 3: Install Auth Scaffolding   (Optional)

### Laravel 12 doesn’t ship UI by default — we install:

```
composer require laravel/breeze --dev

php artisan breeze:install

```

### Compile assets:

```
npm install 

npm run dev

```


#### Explanation:

This installs Laravel Breeze, which provides simple login and registration functionality.

npm install and npm run dev compile frontend assets like CSS and JavaScript.







## STEP 4: Create Model and Migration

### Run:

```
php artisan make:model Flack -m

```

### This creates

```
app/Models/Flack.php

database/migrations/create_flacks_table.php

```

#### Explanation:


The command php artisan make:model Flack -m generates a Model and a Migration file.

The model represents the database table, and the migration defines the table structure.





## STEP 5: Migration Setup

### Open migration: database/migrations/create_flacks_table.php

```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('flacks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flacks');
    }
};

```

### Then Run:

```
php artisan migrate

```

#### Explanation:

The migration file defines the database columns (title, body, timestamps) for the flacks table.

Running php artisan migrate creates this table in the database.





## STEP 6: Set Model Relationships

### app/Models/Flack.php

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flack extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

```


### app/Models/User.php

#### Add:

```
public function flacks()
{
    return $this->hasMany(Flack::class);
}

```

#### Explanation:

Relationships are defined between User and Flack models using Eloquent ORM.

A user can have many flacks (hasMany), and each flack belongs to a user (belongsTo).





## STEP 7: Create Controller

### Run:

```
php artisan make:controller FlackController

```

### Open: app/Http/Controllers/FlackController.php

```
<?php

namespace App\Http\Controllers;

use App\Models\Flack;
use Illuminate\Http\Request;

class FlackController extends Controller
{
    public function index()
    {
        $flacks = Flack::latest()->get();

        return view('flacks.index', compact('flacks'));
    }

    public function create()
    {
        return view('flacks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        Flack::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('flacks.index')
            ->with('success', 'Flack created successfully!');
    }

    public function show($id)
    {
        $flack = Flack::findOrFail($id);

        return view('flacks.show', compact('flack'));
    }

    public function edit(Flack $flack)
    {
        return view('flacks.edit', compact('flack'));
    }

    public function update(Request $request, Flack $flack)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $flack->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('flacks.index')
            ->with('success', 'Flack updated successfully!');
    }

    public function destroy(Flack $flack)
    {
        $flack->delete();

        return redirect()->route('flacks.index')
            ->with('success', 'Flack deleted successfully!');
    }
}

```

#### Explanation:

The controller handles the application logic and manages CRUD operations (Create, Read, Update, Delete).

It connects the Model and Views to process user requests.





## STEP 8: Setup Routes

### routes/web.php

```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlackController;

Route::get('/', function () {
    return redirect()->route('flacks.index');
});

Route::resource('flacks', FlackController::class);

```

#### Explanation:

Routes define the URLs of the application and connect them to controller methods.

Route::resource() automatically creates all CRUD routes for the Flack module.





## STEP 9: Create Blade Views

### Create folder:

```
resources/views/flacks/

```

### resources/views/flacks/index.blade.php

```
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

```



### resources/views/flacks/create.blade.php 

```
<!DOCTYPE html>
<html>

<head>

    <title>Create Flack</title>

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
            background: linear-gradient(45deg, #00c9a7, #845ec2);
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
        <h2>Create Flack</h2>
    </div>

    <div class="container">

        <div class="card">

            <form action="{{ route('flacks.store') }}" method="POST">

                @csrf

                <label>Title</label>

                <input type="text" name="title" placeholder="Enter title">

                <label>Description</label>

                <textarea name="body" rows="5" placeholder="Enter description"></textarea>

                <button>Create Flack</button>

            </form>

            <a class="back" href="{{ route('flacks.index') }}">← Back</a>

        </div>

    </div>

</body>

</html>

```


### resources/views/flacks/edit.blade.php 

```
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

```



### resources/views/flacks/show.blade.php

```
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

```

#### Explanation:

Blade templates are used to build the user interface of the application.

These views display data and forms for creating, editing, viewing, and listing flacks.





## STEP 10:  Test the Application

### Open a new terminal inside your project directory:

```
npm run dev

```

### Start Laravel dev server:

```
php artisan serve

```

### Open in browser:

```
http://127.0.0.1:8000

```

#### Explanation:

npm run dev compiles frontend assets and php artisan serve starts the Laravel development server.

Opening the browser URL loads the application so you can test CRUD functionality.





## Expected Output:

### Home Page:


<img src="screenshots/Screenshot 2026-03-13 110107.png" width="900">


### Create Flack Page:


<img src="screenshots/Screenshot 2026-03-13 110132.png" width="900">


### Successfully Created Flack:


<img src="screenshots/Screenshot 2026-03-13 110140.png" width="900">


### Edit Flack Page:


<img src="screenshots/Screenshot 2026-03-13 110152.png" width="900">


### Successfully Edit Flack:


<img src="screenshots/Screenshot 2026-03-13 110204.png" width="900">


### Show Flack Page:


<img src="screenshots/Screenshot 2026-03-13 110417.png" width="900">


### Delete Flack:


<img src="screenshots/Screenshot 2026-03-13 110356.png" width="900">


---

# Project Folder Structure:

```
PHP_Laravel12_Flacky
│
├── app
│   │
│   ├── Http
│   │   └── Controllers
│   │        └── FlackController.php
│   │
│   └── Models
│        ├── Flack.php
│        └── User.php
│
├── bootstrap
│
├── config
│
├── database
│   │
│   ├── factories
│   │
│   ├── migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   └── xxxx_xx_xx_create_flacks_table.php
│   │
│   └── seeders
│
├── public
│   └── index.php
│
├── resources
│   │
│   ├── views
│   │   │
│   │   ├── flacks
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   │
│   │   └── welcome.blade.php
│   │
│   ├── css
│   │   └── app.css
│   │
│   └── js
│        └── app.js
│
├── routes
│   └── web.php
│
├── storage
│
├── tests
│
├── vendor
│
├── .env
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── vite.config.js
└── README.md

```
