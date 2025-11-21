<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hoyo Piloting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <!-- Header Navigation -->
    <x-admin.header />

    <main class="dashboard-container">
        <!-- Sidebar Navigation -->
        <x-admin.sidebar />

        <!-- Main Content Area -->
        {{ $slot }}
    </main>

    <!-- Add Agent Modal -->
    {{-- <div id="addAgentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Agent</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="addAgentForm" class="modal-form">
                <div class="form-group">
                    <label>Agent Name</label>
                    <input type="text" id="agentName" required>
                </div>
                <div class="form-group">
                    <label>Agent ID</label>
                    <input type="text" id="agentId" placeholder="#0000" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="agentEmail" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn-primary">Add Agent</button>
                </div>
            </form>
        </div>
    </div> --}}

    <x-footer />

    <script src="js/admin-dashboard.js"></script>
</body>
</html>
