<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    @include('company.styles')
    <style>

        /* Form Section */
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #222;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-container h2 {
            color: #b05476;
            text-align: center;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #333;
            color: white;
            border: 1px solid #444;
            box-sizing: border-box;
        }

        .form-container input[type="date"] {
            padding: 8px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #5E90A88F;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background-color: #4a7a90;
        }

        .deadline-section input {
            width: 90%;
        }

        .form-container input, .form-container textarea, .form-container select {
            height: 40px;
        }

        .form-container textarea {
            height: 100px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <b>3BEED</b>
        <div>
            <a href="{{ route('company.home') }}">Home</a>
            <a href="{{ route('company.applications') }}">Applications</a>
            <a href="{{ route('company.accepted') }}">Accepted</a>  

        </div>
        <a href="{{ route('profile.edit') }}" class="company-name">
    <i class="bi bi-building"></i> 
    {{ auth()->user()->company_name }}
</a>
    </div>

    <!-- Form to Edit Job -->
    <div class="form-container">
        <h2>Edit Job</h2>
        <form action="{{ route('company.update-job', $job->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" id="title" name="title" placeholder="Job Title" value="{{ $job->title }}" required>

            <textarea id="description" name="description" placeholder="Job Description" required>{{ $job->description }}</textarea>

            <input type="text" id="skills_required" name="skills_required" placeholder="Skills Required" value="{{ $job->skills_required }}" required>

            <textarea id="benefits" name="benefits" placeholder="Job Benefits" required>{{ $job->benefits }}</textarea>

            <input type="number" id="salary_min" name="salary_min" placeholder="Salary Min" value="{{ $job->salary_min }}" required>

            <input type="number" id="salary_max" name="salary_max" placeholder="Salary Max" value="{{ $job->salary_max }}" required>

            <input type="text" id="location" name="location" placeholder="Location" value="{{ $job->location }}" required>

            <select id="work_type" name="work_type" required>
                <option value="remote" {{ $job->work_type == 'remote' ? 'selected' : '' }}>Remote</option>
                <option value="on-site" {{ $job->work_type == 'on-site' ? 'selected' : '' }}>On-site</option>
            </select>

            <div class="deadline-section">
                <label for="application_deadline">Deadline:</label>
                <input type="date" id="application_deadline" name="application_deadline" value="{{ $job->application_deadline }}" required>
            </div>

            <button type="submit">Update Job</button>
        </form>
    </div>

</body>
</html>
