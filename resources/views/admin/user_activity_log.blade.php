<!DOCTYPE html>
<html>
<head>
    <title>User Activity Logs</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function fetchLogs() {
            axios.get('/api/user-activity-logs')
                .then(response => {
                    const logs = response.data;
                    const tableBody = document.getElementById('logs-table-body');
                    tableBody.innerHTML = '';

                    logs.forEach(log => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${log.id}</td>
                            <td>${log.nipp}</td>
                            <td>${log.name}</td>
                            <td>${log.email}</td>
                            <td>${log.role}</td>
                            <td>${log.modify_user}</td>
                            <td>${log.date_time}</td>
                            <td>${log.action}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching logs:', error));
        }

        // Poll every 10 seconds
        setInterval(fetchLogs, 10000);

        // Initial fetch
        fetchLogs();
    </script>
</head>
<body>
    <h1>User Activity Logs</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIPP</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Modified By</th>
                <th>Date Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="logs-table-body">
            <!-- Log entries will be dynamically inserted here -->
        </tbody>
    </table>
</body>
</html>
