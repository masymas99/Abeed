<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
     @include('company.styles')
    <style>

.job-actions button i {
    color: black;
    
}

.job-actions button.delete-btn i {
    color: #852221;
}

.job-actions button:hover,.edit-btn:hover  {
    background-color: #4a7a90;
}

/* Edit Button */
/* .job-actions .edit-btn {
    background-color: #5E90A88F;
    border: none;
    cursor: pointer;
    font-size: 14px;
    padding: 8px;
    border-radius: 20px;
    transition: background 0.3s ease;
} */

/* .job-actions .edit-btn i {
    color: black;

} */

/* .job-actions .edit-btn:hover {
    background-color: #4a7a90;
} */


        /* Create Job Button */
        .create-job-btn {
            display: block;
            width: 200px;
            height: 60px;
            margin: 60px auto;
            background-color: #40366D;
            color: white;
            font-size: 20px;
            font-weight: bold;
            border-radius: 151px;
            border: none;
            cursor: pointer;
            text-align: center;
            line-height: 60px;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .create-job-btn:hover {
            background-color: #2e2550;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .modal-content {
            background-color: #D9D9D9;
            border: 20px solid #B05476;
            padding: 25px;
            border-radius: 15px;
            width: 60%;
            margin: 15% auto;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        }

        .modal-content h3 {
            color: #926464;
        }

        .modal-content p {
            color: #7A7A7A;
        }

        .close-btn {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
            cursor: pointer;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    

    <!-- Navbar -->
    <div class="navbar">
        <b>3BEED</b>
        <div>
            <a href="{{ route('company.home') }}" class="active">Home</a>
            <a href="{{ route('company.applications') }}">Applications</a>
            <a href="{{ route('company.accepted') }}">Accepted</a> 
        </div>
        <a href="{{ route('profile.edit') }}" class="company-name">
    <i class="bi bi-building"></i> 
    {{ auth()->user()->company_name }}
</a>

    </div>

    <!-- Jobs Section -->
    <div class="jobs-container">
        @foreach ($jobs as $job)
            <div class="job-card">
                <h3>{{ $job->title }}</h3>
                <p><strong>Salary:</strong> {{ $job->salary_min }} - {{ $job->salary_max }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Deadline:</strong> {{ $job->application_deadline }}</p>
                <div class="job-actions">
                <form action="{{ route('company.delete-job', $job->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-btn"><i class="bi bi-trash"></i></button>
    </form>

                    <a href="{{ route('company.edit-job', $job->id) }}">
    <button class="edit-btn"><i class="bi bi-pencil" style="font-size: 20px;"></i></button>
</a>


                    <!-- View Button -->
                    <button class="view-btn" data-id="{{ $job->id }}" data-title="{{ $job->title }}" 
                     data-description="{{ $job->description }}" data-skills="{{ $job->skills_required }}" 
                     data-benefits="{{ $job->benefits }}" data-salary-min="{{ $job->salary_min }}" 
                     data-salary-max="{{ $job->salary_max }}" data-location="{{ $job->location }}" 
                     data-deadline="{{ $job->application_deadline }}" data-work-type="{{ $job->work_type }}" 
                     data-status="{{ $job->status }}">
                     <i class="bi bi-arrow-right"></i>
</button>

                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal for Job Details -->
    <div id="jobModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h3 id="jobTitle"></h3>
            <p><strong>Salary:</strong> <span id="jobSalary"></span> EGP</p>
            <p><strong>Location:</strong> <span id="jobLocation"></span></p>
            <p><strong>Deadline:</strong> <span id="jobDeadline"></span></p>
            <p><strong>Description:</strong> <span id="jobDescription"></span></p>
            <p><strong>Skills Required:</strong> <span id="jobSkills"></span></p>
            <p><strong>Benefits:</strong> <span id="jobBenefits"></span></p>
            <p><strong>Work Type:</strong> <span id="jobWorkType"></span></p>
            <p><strong>Status:</strong> <span id="jobStatus"></span></p>
        </div>
    </div>

    <!-- Create New Job Button -->
    <a class="create-job-btn" href="{{ route('company.create-job') }}">Create New Job</a>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewButtons = document.querySelectorAll('.view-btn');
            const modal = document.getElementById('jobModal');
            const closeBtn = document.querySelector('.close-btn');

           
            modal.style.display = 'none';

           
            viewButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const jobTitle = this.getAttribute('data-title');
                    const jobDescription = this.getAttribute('data-description');
                    const jobSkills = this.getAttribute('data-skills');
                    const jobBenefits = this.getAttribute('data-benefits');
                    const jobSalaryMin = this.getAttribute('data-salary-min');
                    const jobSalaryMax = this.getAttribute('data-salary-max');
                    const jobLocation = this.getAttribute('data-location');
                    const jobDeadline = this.getAttribute('data-deadline');
                    const jobWorkType = this.getAttribute('data-work-type');
                    const jobStatus = this.getAttribute('data-status');

                
                    document.getElementById('jobTitle').textContent = jobTitle;
                    document.getElementById('jobSalary').textContent = `${jobSalaryMin} - ${jobSalaryMax}`;
                    document.getElementById('jobLocation').textContent = jobLocation;
                    document.getElementById('jobDeadline').textContent = jobDeadline;
                    document.getElementById('jobDescription').textContent = jobDescription;
                    document.getElementById('jobSkills').textContent = jobSkills;
                    document.getElementById('jobBenefits').textContent = jobBenefits;
                    document.getElementById('jobWorkType').textContent = jobWorkType;
                    document.getElementById('jobStatus').textContent = jobStatus;

                 
                    modal.style.display = 'flex';
                });
            });

          
            closeBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });

        
            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
