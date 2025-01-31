<style>
body {
            background-color: #111;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-color:#F1EAEA;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color:#454D8B;
            margin: 0 15px;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .navbar a:hover, .navbar .active {
            background-color: #3a9dd8;
            color: white;
        }

        .navbar .company-name {
            color: black;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .navbar .company-name i {
            font-size: 18px;
            color: #555;
        }

        .navbar b {
            color: #800020;
        }

        /* Jobs Container */
        .jobs-container {
            padding: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Job Card */
        .job-card {
            background-color: #D9D9D9;
            border: 20px solid #B05476;
            padding: 15px;
            border-radius: 38px;
            text-align: left;
            width: 250px;
            margin: 15px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        }

        .job-card h3 {
            color: #926464;
        }

        .job-card p {
            color: #7A7A7A;
        }

       /* Job Actions */
       .job-actions {
    display: flex;
    justify-content: space-evenly; 
    gap: 10px; 
}


.job-actions button , .edit-btn {
    background-color: #5E90A88F; 
    border: none;
    cursor: pointer;
    font-size: 18px;
    padding: 8px;
    border-radius: 20px;
    transition: background 0.3s ease;
}

</style>