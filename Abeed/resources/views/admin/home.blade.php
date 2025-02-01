@extends('admin.layout')

@section('content')

    <div class="jobs-container">
        @foreach ($jobs as $job)
            <div class="job-card">
                <div class="maincont">
                    <div class="jopdetals">
                        <h3>{{ $job->title }}</h3>
                        <p><strong>Company Name:</strong> {{ $job->user->company_name ?? 'N/A' }}</p>
                        <p><strong>Salary Min:</strong> {{ $job->salary_min }}</p>
                        <p><strong>Salary Max:</strong> {{ $job->salary_max }}</p>
                        <p><strong>Location:</strong> {{ $job->location }}</p>
                        <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}</p>
                    </div>
                    <div class="compimg">
                        <img src="{{ asset( $job->user->company_logo) }}" class="img-fluid rounded-start" alt="{{ $job->user->company_logo }}">
                    </div>


                </div>


                <div class="d-flex bttns justify-content-center gap-2 mt-3">
                    <form action="{{ route('admin.acceptJob', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="acceptbtn accept-btn">Accept</button>
                    </form>

                    <form action="{{ route('admin.rejectJob', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btndanger reject-btn">Reject</button>
                    </form>

                    <a class="viewbtn" href="{{ route('admin.viewJob', $job->id) }}" ><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        @endforeach
    </div>

@endsection

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .jobs-container {
        padding: 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    .bttns{
        align-self: center;

    }

    .job-card {
        background-color: #D9D9D9;
        border: 18px solid #B05476;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: start;
        border-radius: 25px;
        text-align: center;
        width: 450px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }
.maincont{
    display: flex;
}
.compimg{
    align-self: center;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;

}
    .jopdetals {
        text-align: left;
    }
    .job-card h3 {
        color: #8c7f7f;
    }

    .job-card p {
        color: #555;
    }

    .d-flex {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .btn {
        width: 100px;
        height: 40px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
    }

    .acceptbtn{
        border: none;
        background-color: #366D56;
        color: white;
        height: 40px;
        width: 100px;
        border-radius: 200px;
    }

    .reject-btn {
        border: none;
        background-color: #6D364C;
        color: white;
        height: 40px;
        width: 100px;
        border-radius: 200px;
    }

    .viewbtn {
        text-decoration: none;
        background-color: #5684ac;
        color: white;
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>
