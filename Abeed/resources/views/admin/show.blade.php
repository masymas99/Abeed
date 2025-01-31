<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/adminhome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <title>Document</title>
</head>
<body>
hi admin SHOW -

<div class="big-container d-flex flex-column align-items-center bg-secondary w-25 rounded p-3 m-3">
    <div class="small-container w-75">
        <div class="top">
            <div class="details">
                {{-- show job details --}}
                <h1>{{$job->title}}</h1>
                <h3>{{$job->user->company_name}}</h3>
                <p>{{$job->email}}</p>
                <p>{{$job->salary_min}}</p>
                <p>{{$job->salary_max}}</p>
                <p>{{$job->location}}</p>
                <p>{{$job->application_deadline}}</p>


            </div>

            <div class="logo">

            </div>
        </div>
        <div class="bottoms d-flex justify-content-between align-items-center">
          <button class="btn btn-success w-50 m-3">Accept</button>
          <button class="btn btn-danger w-50 m-3">reject</button>

        </div>


    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

</body>
</html>
