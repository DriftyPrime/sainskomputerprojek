<?php include 'header.php'; ?>
<html>
<link rel="stylesheet" href="css/style.css">
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Carian Peserta</h2>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <style>
        .custom-table {
            border-collapse: collapse;
            width: 100%;
            background-color: rgb(1, 33, 1);
        }
        
        .custom-table th, .custom-table td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
        }
        
        .custom-table th {
            background-color: #4CAF50;
            color: white;
        }
        
        .custom-table td a {
            color: white;
            text-decoration: none;
        }
    </style>
    
    <button class="return_button" onclick="goBack()">🔙</button>
    
    <form class="searchbar" onsubmit="return false;">
        <input type="text" id="search" name="search" placeholder="nama" onkeyup="searchResults()">
        <select id="table-query" name="table-query">
            <option value="peserta">Peserta</option>
            <option value="aktiviti">Aktiviti</option>
            <option value="guru">Guru</option>
            <option value="rumahsukan">Rumah Sukan</option>
        </select>
    </form>
    <button onclick="printTable()">Cetak</button>
    <div class="activity-container" id="activity-container">
        <!-- Initial data will be loaded here -->
    </div>
    
    <script>
        function searchResults() {
            const searchQuery = document.getElementById('search').value;
            const tableQuery = document.getElementById('table-query').value;
            const xhr = new XMLHttpRequest();
            
            xhr.open("POST", "search_results.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('activity-container').innerHTML = xhr.responseText;
                }
            };
            
            xhr.send("search=" + encodeURIComponent(searchQuery) + "&table-query=" + encodeURIComponent(tableQuery));
        }
        
        // Load all results on initial page load
        window.onload = function() {
            searchResults();
        };
        
        
    </script>
    <script>
        function printTable() {
            var printContents = document.getElementById('activity-container').innerHTML;
            var originalContents = document.body.innerHTML;
            
            // Create a new window object
            var printWindow = window.open('', '_blank');
            
            // Create a new HTML document in the new window
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>aktiviti_disertai</title>
                    <style>
                    table { width: 100%; border: 1px solid black; border-collapse: collapse; margin: 0 auto; }
                    th, td { border: 1px solid black; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
                    @page { size: auto; margin: 15mm; }
                    body { margin: 15mm; }
                    </style>
                </head>
                <body>
                    ${printContents}
                </body>
                </html>
            `);
            
            // Print the new window
            printWindow.print();
            
            // Close the new window
            printWindow.close();
            
            // Restore the original contents of the original window
            document.body.innerHTML = originalContents;
        }
    </script>
</div> 
</body>
</html>

