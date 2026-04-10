<!DOCTYPE html>
<html>
<head>
    <title>Course Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font Cursive -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #1e3c72, #2a5298);
            color: white;
            padding-top: 20px;
            transition: 0.3s;
        }

        .sidebar h3 {
            text-align: center;
            font-family: 'Pacifico', cursive;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            padding-left: 30px;
        }

        .sidebar a.active {
            background: rgba(255,255,255,0.3);
        }

        /* CONTENT */
        .content {
            margin-left: 240px;
            padding: 20px;
        }

        /* CARD HOVER */
        .card {
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* TOAST */
        #toast {
            animation: slideIn 0.5s;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h3>CMS</h3>

    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
        🏠 Dashboard
    </a>

    <a href="/courses" class="{{ request()->is('courses*') ? 'active' : '' }}">
        📚 Courses
    </a>

    <a href="/lessons" class="{{ request()->is('lessons*') ? 'active' : '' }}">
        🎥 Lessons
    </a>

    <a href="/enrollments" class="{{ request()->is('enrollments*') ? 'active' : '' }}">
        👨‍🎓 Enrollments
    </a>
</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>


<x-alert />
</body>


<script>
setTimeout(() => {
    document.getElementById('toast')?.remove();
}, 3000);
</script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>